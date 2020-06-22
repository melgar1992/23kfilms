<?php

class Descarte extends BaseController
{

    function __construct()
    {

        parent::__construct();
        $this->load->model("Ventas_model");
    }

    public function index()
    {
        $data = array(
            'descarte_productos' => $this->Descarte_producto_model->getDescartesProductos(),
            "productos" => $this->Ventas_model->getProcutosTodos(),
        );
        $this->loadView('Descarte', '/form/admin/descarte/list', $data);
    }
    public function guardar()
    {
        $id_productos = $this->input->post('id_productos');
        $tipo_falla = $this->input->post('tipo_falla');
        $fecha = $this->input->post('fecha');
        $cantidad = $this->input->post('cantidad');

        $this->form_validation->set_rules('producto', 'producto seleccionado', 'required');
        $this->form_validation->set_rules('tipo_falla', 'Descripcion del tipo de falla del producto ', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha de la falla', 'required');
        $this->form_validation->set_rules('cantidad', 'cantidad de producto con fallas', 'required');

        if ($this->form_validation->run()) {
            $datos = array(
                'id_productos' => $id_productos,
                'tipo_falla' => $tipo_falla,
                'fecha' => $fecha,
                'cantidad' => $cantidad,
            );
            $this->actualizarProducto($id_productos, $cantidad);
            if ($this->Descarte_producto_model->guardar($datos)) {
                redirect(base_url() . 'Movimientos/Descarte');
            } else {
                $this->session->set_flashdata('error', 'No se pudo guardar la informacion');
                redirect(base_url() . 'Movimientos/Descarte');
            }
        } else {
            $this->session->set_flashdata('error', 'No se pudo guardar la informacion, faltan campos completados');
            redirect(base_url() . 'Movimientos/Descarte');
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
    public function editar($id_descarte_producto)
    {
        $data = array(
            'descarte_producto' => $this->Descarte_producto_model->getDescartesProducto($id_descarte_producto),
            "productos" => $this->Ventas_model->getProcutosTodos(),
        );
        $this->loadView('Descarte', '/form/admin/descarte/editar', $data);
    }
    public function actualizar()
    {
        $id_descarte_producto = $this->input->post('id_descarte_producto');
        $id_productos = $this->input->post('id_productos');
        $tipo_falla = $this->input->post('tipo_falla');
        $fecha = $this->input->post('fecha');
        $cantidad = $this->input->post('cantidad');

        $this->form_validation->set_rules('producto', 'producto seleccionado', 'required');
        $this->form_validation->set_rules('tipo_falla', 'Descripcion del tipo de falla del producto ', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha de la falla', 'required');
        $this->form_validation->set_rules('cantidad', 'cantidad de producto con fallas', 'required');
        $descarteActual = $this->Descarte_producto_model->getDescartesProducto($id_descarte_producto);

        if ($this->form_validation->run()) {
            if ($descarteActual->id_productos == $id_productos) {
                $datos = array(
                    'id_productos' => $id_productos,
                    'tipo_falla' => $tipo_falla,
                    'fecha' => $fecha,
                    'cantidad' => $cantidad,
                );
                $cantidad = $cantidad - $descarteActual->cantidad;
                $this->actualizarProducto($id_productos, $cantidad);
                if ($this->Descarte_producto_model->actualizar($id_descarte_producto, $datos)) {
                    redirect(base_url() . 'Movimientos/Descarte');
                } else {
                    $this->session->set_flashdata('error', 'No se pudo editar la informacion');
                    redirect(base_url() . 'Movimientos/Descarte');
                }
            } else {
                $datos = array(
                    'id_productos' => $id_productos,
                    'tipo_falla' => $tipo_falla,
                    'fecha' => $fecha,
                    'cantidad' => $cantidad,
                );
                $this->actualizarProducto($descarteActual->id_productos, -$descarteActual->cantidad);
                $this->actualizarProducto($id_productos, $cantidad);
                if ($this->Descarte_producto_model->actualizar($id_descarte_producto, $datos)) {
                    redirect(base_url() . 'Movimientos/Descarte');
                } else {
                    $this->session->set_flashdata('error', 'No se pudo editar la informacion');
                    redirect(base_url() . 'Movimientos/Descarte');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'No se pudo editar la informacion, faltan campos completados');
            redirect(base_url() . 'Movimientos/Descarte');
        }
    }
    public function borrar($id_descarte_producto)
    {
        $descarteActual = $this->Descarte_producto_model->getDescartesProducto($id_descarte_producto);
        $this->actualizarProducto($descarteActual->id_productos, -$descarteActual->cantidad);
        $this->Descarte_producto_model->borrar($id_descarte_producto);
        echo "Movimientos/Descarte";
    }
}
