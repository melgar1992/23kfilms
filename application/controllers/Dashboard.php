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

        $data = array(
            'productos' => $this->Productos_model->getProductos(),
            'valor_inventario' => $this->Productos_model->valorInventario(),
            'ventas' => $this->Ventas_model->getVentas(),
            'valor_inventario_proyectos' => $this->Ventas_model->valorItemsProyectos(),
            'descarte_productos' => $this->Descarte_producto_model->getDescartesProductos(),
            'valor_productos_descartados' => $this->Descarte_producto_model->valorProductosDescartados(),
        );
       
      
         $this->loadView("Dashboard", "dashboard", $data);
    }
}
