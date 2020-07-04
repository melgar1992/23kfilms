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
        $this->loadView('Presupuesto','/form/admin/presupuesto/list');
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



}