<?php

class Ventas extends BaseController
{

    function __construct()
    {

        parent::__construct();
        $this->load->model("Ventas_model");
    }

    public function index()
    {
        $data = array(
            'ventas' => $this->Ventas_model->getVentas(),
        );
        $this->loadView('Ventas', '/form/admin/ventas/list', $data);
    }

    public function add()
    {
        $data = array(
            "tipocomprobantes" => $this->Ventas_model->getComprobantes(),
            "clientes" => $this->Clientes_model->getClientes(),
            "servicios" => $this->Servicios_model->getServicios(),
            "empleados" => $this->Empleado_model->getEmpleados(),
            "categoria_servicios" => $this->Categorias_model->getCategorias(),
        );
        $this->loadView('Ventas', '/form/admin/ventas/add', $data);
    }
    public function getProductos()
    {
        $valor = $this->input->post("valor");
        $productos = $this->Ventas_model->getProductos($valor);
        echo json_encode($productos);
    }
    public function getProductosCodigo()
    {
        $valor = $this->input->post("valor");
        $productos = $this->Ventas_model->getProductosCodigo($valor);
        echo json_encode($productos);
    }
    public function guardar()
    {
        $fecha = $this->input->post('fecha');
        $subtotal = $this->input->post('subtotal');
        $igv = $this->input->post('igv');
        $descuento = $this->input->post('descuento');
        $total = $this->input->post('total');
        $idcomprobante = $this->input->post('idcomprobante');
        $idcliente = $this->input->post('idcliente');
        $idusuario = $this->session->userdata('id_usuarios');
        $num_documento = $this->input->post('numero');
        $serie = $this->input->post('serie');
        $idempleado = $this->input->post('idempleado');
        $proyecto = $this->input->post('proyecto');
        $fase_proyecto = $this->input->post('fase_proyecto');
        $idproductos = $this->input->post('idproductos');
        $precios = $this->input->post('precios');
        $cantidades = $this->input->post('cantidades');
        $importes = $this->input->post('importes');

        $this->form_validation->set_rules('fecha', 'Fecha de la salida de inventario', 'required');
        $this->form_validation->set_rules('idcliente', 'idcliente', 'required');
        $this->form_validation->set_rules('idempleado', 'idempleado', 'required');



        if ($this->form_validation->run()) {
            //Se obtione el id de los datos de la empresa que este en vigencia.
            $datosEmpresa = $this->Empresa_model->getEmpresa();
            if (isset($datosEmpresa)) {
                $id_empresa = $datosEmpresa->id_empresa;
                $data = array(
                    'id_usuarios' => $idusuario,
                    'id_clientes' => $idcliente,
                    'id_tipo_comprobante' => $idcomprobante,
                    'id_empresa' => $id_empresa,
                    'id_empleados' => $idempleado,
                    'subTotal' => $subtotal,
                    'importeTotal' => $subtotal,
                    'proyecto' => $proyecto,
                    'fecha' => $fecha,
                    'iva' => $igv,
                    'descuentoTotal' => $descuento,
                    'num_documento' => $num_documento,
                    'serie' => $serie,
                    'fase_proyecto' => $fase_proyecto,
                    'estado' => '1',
                );

                if ($this->Ventas_model->guardarVentas($data)) {

                    $idVenta = $this->Ventas_model->ultimoID();
                    $this->actualizarComprobante($idcomprobante);
                    $this->guardar_detalle($idproductos, $idVenta, $precios, $cantidades, $importes);
                    redirect(base_url() . 'Movimientos/ventas');
                } else {
                    redirect(base_url() . 'Movimientos/ventas/add');
                }
            } else {
                $this->session->set_flashdata('error', 'Tiene que configurar los datos de la empresa primero!');
                redirect(base_url() . 'Movimientos/ventas/add');
            }
        } else {
            $this->session->set_flashdata('error', 'Tiene que llenar los datos correctamente');
            redirect(base_url() . 'Movimientos/ventas/add');
        }
    }
    public function editar($id_ventas)
    {
        $data = array(
            "tipocomprobantes" => $this->Ventas_model->getComprobantes(),
            "clientes" => $this->Clientes_model->getClientes(),
            "productos" => $this->Ventas_model->getProcutosTodos(),
            "empleados" => $this->Empleado_model->getEmpleados(),
            "venta" => $this->Ventas_model->getVenta($id_ventas),
            "detalle_ventas" => $this->Ventas_model->getDetalle($id_ventas),
        );
        $this->loadView('Ventas', '/form/admin/ventas/editar', $data);
    }
    public function actualizar()
    {
        $idVenta = $this->input->post('id_ventas');
        $fecha = $this->input->post('fecha');
        $subtotal = $this->input->post('subtotal');
        $igv = $this->input->post('igv');
        $descuento = $this->input->post('descuento');
        $total = $this->input->post('total');
        $idcomprobante = $this->input->post('idcomprobante');
        $idcliente = $this->input->post('idcliente');
        $idusuario = $this->session->userdata('id_usuarios');
        $num_documento = $this->input->post('numero');
        $serie = $this->input->post('serie');
        $idempleado = $this->input->post('idempleado');
        $proyecto = $this->input->post('proyecto');
        $fase_proyecto = $this->input->post('fase_proyecto');
        $idproductos = $this->input->post('idproductos');
        $precios = $this->input->post('precios');
        $cantidades = $this->input->post('cantidades');
        $importes = $this->input->post('importes');

        $this->form_validation->set_rules('fecha', 'Fecha de la salida de inventario', 'required');
        $this->form_validation->set_rules('idcliente', 'idcliente', 'required');
        $this->form_validation->set_rules('idempleado', 'idempleado', 'required');



        if ($this->form_validation->run()) {
            if ($fase_proyecto != 'Completado') {



                $data = array(
                    'id_usuarios' => $idusuario,
                    'id_clientes' => $idcliente,
                    'id_tipo_comprobante' => $idcomprobante,
                    'id_empleados' => $idempleado,
                    'subTotal' => $subtotal,
                    'importeTotal' => $total,
                    'proyecto' => $proyecto,
                    'fecha' => $fecha,
                    'iva' => $igv,
                    'descuentoTotal' => $descuento,
                    'num_documento' => $num_documento,
                    'serie' => $serie,
                    'fase_proyecto' => $fase_proyecto,
                    'estado' => '1',
                );

                if ($this->Ventas_model->actualizarVentas($idVenta, $data)) {
                    $this->borrar_detalle($idVenta);
                    $this->guardar_detalle($idproductos, $idVenta, $precios, $cantidades, $importes);
                    redirect(base_url() . 'Movimientos/ventas');
                } else {
                    redirect(base_url() . 'Movimientos/ventas/editar/' + $idVenta);
                }
            } else {

                $data = array(
                    'id_usuarios' => $idusuario,
                    'id_clientes' => $idcliente,
                    'id_tipo_comprobante' => $idcomprobante,
                    'id_empleados' => $idempleado,
                    'subTotal' => $subtotal,
                    'importeTotal' => $total,
                    'proyecto' => $proyecto,
                    'fecha' => $fecha,
                    'iva' => $igv,
                    'descuentoTotal' => $descuento,
                    'num_documento' => $num_documento,
                    'serie' => $serie,
                    'fase_proyecto' => $fase_proyecto,
                    'estado' => '1',
                );

                if ($this->Ventas_model->actualizarVentas($idVenta, $data)) {

                    $this->borrar_detalle($idVenta);
                    $this->guardar_detalle($idproductos, $idVenta, $precios, $cantidades, $importes);
                    $detalle_actual = $this->Ventas_model->getDetalle($idVenta);
                    foreach ($detalle_actual as $detalle) {
                        $this->reponerProducto($detalle->id_productos, $detalle->cantidad);
                    }
                    redirect(base_url() . 'Movimientos/ventas');
                } else {
                    redirect(base_url() . 'Movimientos/ventas/editar/' + $idVenta);
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Tiene que llenar los datos correctamente');
            redirect(base_url() . 'Movimientos/ventas/add');
        }
    }
    public function borrar($idVenta)
    {
        $this->borrar_detalle($idVenta);
        if ($this->Ventas_model->borrar($idVenta)) {
            echo "Movimientos/ventas";
        } else {
            $this->session->set_flashdata('error', 'Hubo un problema al borrar la venta');
            echo "Movimientos/ventas";
        }
    }
    protected function actualizarComprobante($idcomprobante)
    {
        $comprobanteActual = $this->Ventas_model->getComprobante($idcomprobante);
        $data = array(
            'cantidad' => $comprobanteActual->cantidad + 1,
        );
        $this->Ventas_model->actualizarComprobante($idcomprobante, $data);
    }
    protected function guardar_detalle($idproductos, $idVenta, $precios, $cantidades, $importes)
    {
        for ($i = 0; $i < count($idproductos); $i++) {
            $data = array(
                'id_ventas' => $idVenta,
                'id_productos' => $idproductos[$i],
                'precio' => $precios[$i],
                'cantidad' => $cantidades[$i],
                'importe' => $importes[$i],
            );
            $this->Ventas_model->guardar_detalle($data);
            $this->actualizarProducto($idproductos[$i], $cantidades[$i]);
        }
    }
    protected function borrar_detalle($idVenta)
    {
        $detalle_actual = $this->Ventas_model->getDetalle($idVenta);
        foreach ($detalle_actual as $detalle) {
            $this->reponerProducto($detalle->id_productos, $detalle->cantidad);
            $this->Ventas_model->borrar_detalle($detalle->id_detalle_ventas);
        }
    }
    protected function reponerProducto($idproducto, $cantidad)
    {
        $productoActual = $this->Productos_model->getProducto($idproducto);
        $data = array(
            'stock' => $productoActual->stock + $cantidad,
        );
        $this->Productos_model->actualizar($idproducto, $data);
    }
    protected function actualizarProducto($idproducto, $cantidad)
    {
        $productoActual = $this->Productos_model->getProducto($idproducto);
        $data = array(
            'stock' => $productoActual->stock - $cantidad,
        );
        $this->Productos_model->actualizar($idproducto, $data);
    }

    public function vista()
    {
        $id_venta = $this->input->post('id');
        $data = array(
            "venta" => $this->Ventas_model->getVenta($id_venta),
            "detalles" => $this->Ventas_model->getDetalle($id_venta),
            'Configuracion' => $this->Empresa_model->getEmpresa(),
            'encargado' => $this->Ventas_model->getEncargado($id_venta),
        );
        $this->load->view('form/admin/ventas/view', $data);
    }
}
