<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $data['total_proyectos_aprobados'] = $this->Reportes_model->total_proyectos_aprobados(); 
        $data['total_proyectos_evaluacion'] = $this->Reportes_model->total_proyectos_evaluacion(); 
        $data['presupuestos'] = $this->Ventas_model->getPresupuestos(); 
        $data['reporte_gancias'] = $this->Reportes_model->reporte_ganacias();
         $this->loadView("Dashboard", "dashboard", $data);
    }
}
