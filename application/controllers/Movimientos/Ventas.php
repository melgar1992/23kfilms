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
            "empleados" => $this->Empleado_model->getEmpleados(),
            "categoria_servicios" => $this->Categorias_model->getCategorias(),
            'presupuestos' => $this->Ventas_model->getPresupuestos(),
        );
        $this->loadView('Ventas', '/form/admin/ventas/add', $data);
    }
    public function getServiciosCategoria()
    {
        $id_categoria = $this->input->post("id_categoria");
        $servicios = $this->Servicios_model->getServiciosCategoria($id_categoria);
        echo json_encode($servicios);
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
        //Valores de ventas
        $id_clientes = $this->input->post('id_cliente');
        $id_presupuesto = $this->input->post('id_presupuesto');
        $id_tipo_comprobante = $this->input->post('id_tipo_comprobante');
        $fecha = $this->input->post('fecha');
        $proyecto = $this->input->post('proyecto');
        $fase_proyecto = $this->input->post('fase_proyecto');
        $id_empleados = $this->input->post('id_empleado');
        $importeTotal = $this->input->post('importeTotal');
        $facturaTotal = $this->input->post('facturaTotal');
        $iva = $this->input->post('iva');
        $idusuario = $this->session->userdata('id_usuarios');

        // Datos de detalle de venta de servicio
        $id_categoria = $this->input->post('id_categoria');
        $nombre = $this->input->post('nombre');
        $cantidad = $this->input->post('cantidad');
        $dias = $this->input->post('dias');
        $costo = $this->input->post('costo');
        $total = $this->input->post('total');
        $facturado = $this->input->post('facturado');
        $observaciones = $this->input->post('observaciones');

        try {
            $this->form_validation->set_rules('fecha', 'Fecha de la salida de inventario', 'required');
            $this->form_validation->set_rules('id_cliente', 'idcliente', 'required');
            $this->form_validation->set_rules('id_presupuesto', 'id_presupuesto', 'required');
            $this->form_validation->set_rules('id_tipo_comprobante', 'id_tipo_comprobante', 'required');
            $this->form_validation->set_rules('id_empleado', 'idempleado', 'required');
            $this->form_validation->set_rules('proyecto', 'proyecto', 'required');
            $this->form_validation->set_rules('fase_proyecto', 'fase_proyecto', 'required');

            if ($this->form_validation->run()) {
                //Se obtione el id de los datos de la empresa que este en vigencia.
                $datosEmpresa = $this->Empresa_model->getEmpresa();
                if (isset($datosEmpresa)) {
                    $id_empresa = $datosEmpresa->id_empresa;
                    $data = array(
                        'id_usuarios' => $idusuario,
                        'id_clientes' => $id_clientes,
                        'id_presupuesto' => $id_presupuesto,
                        'id_tipo_comprobante' => $id_tipo_comprobante,
                        'id_empresa' => $id_empresa,
                        'id_empleados' => $id_empleados,
                        'importeTotal' => $importeTotal,
                        'facturaTotal' => $facturaTotal,
                        'proyecto' => $proyecto,
                        'fecha' => $fecha,
                        'iva' => $iva,
                        'fase_proyecto' => $fase_proyecto,
                        'estado' => '1',
                    );

                    if ($this->Ventas_model->guardarVentas($data)) {
                        $idVenta = $this->Ventas_model->ultimoID();
                        $this->guardar_detalle($idVenta, $id_categoria, $nombre, $cantidad, $dias, $costo, $total, $facturado, $observaciones);
                        $respuesta = array(
                            'tipo' => 'Exitoso',
                            'respuesta' => '',
                        );
                    } else {
                        $error = 'Ups, ocurrio un error al guardar los datos!, llamar a atencion al cliente 69050005.!!';
                        $respuesta = array(
                            'tipo' => 'Error',
                            'respuesta' => $error
                        );
                    }
                } else {
                    $error = 'Datos de la empresa no han sido guardados!.';
                    $respuesta = array(
                        'tipo' => 'Error',
                        'respuesta' => $error
                    );
                }
            } else {
                $error = 'Error al validar los datos';
                $respuesta = array(
                    'tipo' => 'Error',
                    'respuesta' => $error
                );
            }
        } catch (\Throwable $th) {
            $respuesta = array(
                'tipo' => 'Error',
                'respuesta' => 'Ups un terrible error paso, llamar a atencion al cliente 69050005.' . $th,
            );
        }



        echo json_encode($respuesta);
    }
    public function editar($id_ventas)
    {
        $data = array(
            "tipocomprobantes" => $this->Ventas_model->getComprobantes(),
            "clientes" => $this->Clientes_model->getClientes(),
            "empleados" => $this->Empleado_model->getEmpleados(),
            "categoria_servicios" => $this->Categorias_model->getCategorias(),
            "proyecto" => $this->Ventas_model->getProyecto($id_ventas),
            "detalle_ventas" => $this->Ventas_model->getDetalles($id_ventas),
            'cant_categoria_detalle' => $this->Ventas_model->getCategoriaServicioDetalleVenta($id_ventas),
            'presupuestos' => $this->Ventas_model->getPresupuestos(),
        );
        $this->loadView('Ventas', '/form/admin/ventas/editar', $data);
    }
    public function actualizar()
    {
        //Valores de ventas
        $id_ventas = $this->input->post('id_ventas');
        $id_presupuesto = $this->input->post('id_presupuesto');
        $id_tipo_comprobante = $this->input->post('id_tipo_comprobante');
        $id_clientes = $this->input->post('id_cliente');
        $fecha = $this->input->post('fecha');
        $proyecto = $this->input->post('proyecto');
        $fase_proyecto = $this->input->post('fase_proyecto');
        $id_empleados = $this->input->post('id_empleado');
        $importeTotal = $this->input->post('importeTotal');
        $facturaTotal = $this->input->post('facturaTotal');
        $iva = $this->input->post('iva');
        $idusuario = $this->session->userdata('id_usuarios');

        // Datos de detalle de venta de servicio
        $id_categoria = $this->input->post('id_categoria');
        $nombre = $this->input->post('nombre');
        $cantidad = $this->input->post('cantidad');
        $dias = $this->input->post('dias');
        $costo = $this->input->post('costo');
        $total = $this->input->post('total');
        $facturado = $this->input->post('facturado');
        $observaciones = $this->input->post('observaciones');

        try {
            $this->form_validation->set_rules('fecha', 'Fecha de la salida de inventario', 'required');
            $this->form_validation->set_rules('id_cliente', 'idcliente', 'required');
            $this->form_validation->set_rules('id_presupuesto', 'id_presupuesto', 'required');
            $this->form_validation->set_rules('id_tipo_comprobante', 'id_tipo_comprobante', 'required');
            $this->form_validation->set_rules('id_empleado', 'idempleado', 'required');
            $this->form_validation->set_rules('proyecto', 'proyecto', 'required');
            $this->form_validation->set_rules('fase_proyecto', 'fase_proyecto', 'required');

            if ($this->form_validation->run()) {
                //Se obtione el id de los datos de la empresa que este en vigencia.
                $datosEmpresa = $this->Empresa_model->getEmpresa();
                if (isset($datosEmpresa)) {
                    $id_empresa = $datosEmpresa->id_empresa;
                    $data = array(
                        'id_usuarios' => $idusuario,
                        'id_clientes' => $id_clientes,
                        'id_presupuesto' => $id_presupuesto,
                        'id_tipo_comprobante' => $id_tipo_comprobante,
                        'id_empresa' => $id_empresa,
                        'id_empleados' => $id_empleados,
                        'importeTotal' => $importeTotal,
                        'facturaTotal' => $facturaTotal,
                        'proyecto' => $proyecto,
                        'fecha' => $fecha,
                        'iva' => $iva,
                        'fase_proyecto' => $fase_proyecto,
                        'estado' => '1',
                    );

                    if ($this->Ventas_model->actualizarVentas($id_ventas, $data)) {

                        $this->Ventas_model->borrar_detalle_completo($id_ventas);
                        $this->guardar_detalle($id_ventas, $id_categoria, $nombre, $cantidad, $dias, $costo, $total, $facturado, $observaciones);
                        $respuesta = array(
                            'tipo' => 'Exitoso',
                            'respuesta' => '',
                        );
                    } else {
                        $error = 'Ups, ocurrio un error al guardar los datos!, consultar con nanda!!';
                        $respuesta = array(
                            'tipo' => 'Error',
                            'respuesta' => $error
                        );
                    }
                } else {
                    $error = 'Datos de la empresa no han sido guardados!.';
                    $respuesta = array(
                        'tipo' => 'Error',
                        'respuesta' => $error
                    );
                }
            } else {
                $error = 'Error al validar los datos';
                $respuesta = array(
                    'tipo' => 'Error',
                    'respuesta' => $error
                );
            }
        } catch (\Throwable $th) {
            $respuesta = array(
                'tipo' => 'Error',
                'respuesta' => 'Ups un terrible error paso, llamar a atencion al cliente 69050005.' . $th,
            );
        }



        echo json_encode($respuesta);
    }
    public function borrar($idVenta)
    {
        $data = array(
            'estado' => "0",

        );
        $this->Ventas_model->actualizarVentas($idVenta, $data);
        $this->Ventas_model->borrar_detalle_completo($idVenta);
        echo "Movimientos/Ventas";
    }
    protected function actualizarComprobante($idcomprobante)
    {
        $comprobanteActual = $this->Ventas_model->getComprobante($idcomprobante);
        $data = array(
            'cantidad' => $comprobanteActual->cantidad + 1,
        );
        $this->Ventas_model->actualizarComprobante($idcomprobante, $data);
    }
    private function guardar_detalle($idVenta, $id_categoria, $nombre, $cantidad, $dias, $costo, $total, $facturado, $observaciones)
    {
        for ($i = 0; $i < count($cantidad); $i++) {
            $data = array(
                'id_ventas' => $idVenta,
                'id_categoria_servicios' => $id_categoria[$i],
                'nombre' => $nombre[$i],
                'cantidad' => $cantidad[$i],
                'dias' => $dias[$i],
                'costo' => $costo[$i],
                'total' => $total[$i],
                'facturado' => $facturado[$i],
                'observaciones' => $observaciones[$i],

            );
            $this->Ventas_model->guardar_detalle($data);
        }
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
            "detalle_ventas" => $this->Ventas_model->getDetalles($id_venta),
            'cant_categoria_detalle' => $this->Ventas_model->getCategoriaServicioDetalleVenta($id_venta),
        );
        $this->load->view('form/admin/ventas/view', $data);
    }
    public function obtenerDetallePresupuesto()
    {
        $id_presupuesto = $this->input->post('id_presupuesto');
        $data['detallePresupuesto'] = $this->Ventas_model->getDetalles($id_presupuesto);
        $data['cant_categoria_detalle'] = $this->Ventas_model->getCategoriaServicioDetalleVenta($id_presupuesto);
        echo json_encode($data);
    }
}
