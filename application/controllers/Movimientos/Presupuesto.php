<?php

class Presupuesto extends BaseController
{
    function __construct()
    {

        parent::__construct();
    }
    public function index()
    {
        $data['presupuestos'] = $this->Ventas_model->getPresupuestos();
        $this->loadView('Presupuesto', '/form/admin/presupuesto/list',$data);
    }
    public function add()
    {
        $data = array(
            "tipocomprobantes" => $this->Ventas_model->getComprobantes(),
            "clientes" => $this->Clientes_model->getClientes(),
            "empleados" => $this->Empleado_model->getEmpleados(),
            "categoria_servicios" => $this->Categorias_model->getCategorias(),
        );
        $this->loadView('Presupuesto', '/form/admin/presupuesto/add', $data);
    }
    public function guardar()
    {
        //Valores de ventas
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
                    'id_tipo_comprobante' => 3,
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
}
