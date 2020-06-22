<?php

class Productos extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'productos' => $this->Productos_model->getProductos(),
            'categorias' => $this->Categorias_model->getCategorias(),
        );

        $this->loadView('Productos', '/form/admin/productos/list', $data);
    }
    public function guardarProducto()
    {
        $codigo = $this->input->post("codigo");
        $nombre = $this->input->post("nombre");
        $descripcion = $this->input->post("descripcion");
        $precio = $this->input->post("precio");
        $precio_compra = $this->input->post("precio_compra");
        $stock = $this->input->post("stock");
        $categoria = $this->input->post("categoria");
        $lugar_almacenado = $this->input->post("lugar_almacenado");
        $color = $this->input->post("color");
        $talla = $this->input->post("talla");
        $marca = $this->input->post("marca");
        $fecha_ini = $this->input->post("fecha_ini");


        $this->form_validation->set_rules("codigo", "Codigo", "required|is_unique[productos.codigo]");
        $this->form_validation->set_rules("nombre", "Nombre", "required");
        $this->form_validation->set_rules("precio", "Precio", "required");
        $this->form_validation->set_rules("stock", "Stock", "required");
        $this->form_validation->set_rules("precio_compra", "precio_compra", "required");
        $this->form_validation->set_rules("color", "color", "required");
        $this->form_validation->set_rules("talla", "talla", "required");
        $this->form_validation->set_rules("marca", "marca", "required");
        $this->form_validation->set_rules("fecha_ini", "Fecha que ingresa el producto", "required");

        if ($this->form_validation->run()) {
            $data = array(

                'id_categorias' => $categoria,
                'codigo' => $codigo,
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio_compra' => $precio_compra,
                'precio' => $precio,
                'lugar_almacenado' => $lugar_almacenado,
                'stock' => $stock,
                'color' => $color,
                'talla' => $talla,
                'marca' => $marca,
                'fecha_registro' => $fecha_ini,
                'estado' => "1"
            );

            if ($this->Productos_model->guardarProd($data)) {
                redirect(base_url() . "Mantenimiento/productos");
            } else {
                $this->session->set_flashdata("error", "No se pudo guardar la informacion");
            }
        } else {
            $this->index();
        }
    }
    public function editar($id_producto)
    {
        $data = array(
            'producto' => $this->Productos_model->getProducto($id_producto),
            'categorias' => $this->Categorias_model->getCategorias(),
        );
        $this->loadView('Productos', '/form/admin/productos/editar', $data);
    }
    public function actualizarProducto()
    {
        $id_producto = $this->input->post("id_producto");
        $codigo = $this->input->post("codigo");
        $nombre = $this->input->post("nombre");
        $descripcion = $this->input->post("descripcion");
        $precio = $this->input->post("precio");
        $precio_compra = $this->input->post("precio_compra");
        $stock = $this->input->post("stock");
        $categoria = $this->input->post("categoria");
        $lugar_almacenado = $this->input->post("lugar_almacenado");
        $color = $this->input->post("color");
        $talla = $this->input->post("talla");
        $marca = $this->input->post("marca");
        $fecha_ini = $this->input->post("fecha_ini");


        $productoActual = $this->Productos_model->getProducto($id_producto);
        if ($codigo == $productoActual->codigo) {
            $unique = '';
        } else {
            $unique = '|is_unique[productos.codigo]';
        }

        $this->form_validation->set_rules("codigo", "Codigo", "required" . $unique);
        $this->form_validation->set_rules("nombre", "Nombre", "required");
        $this->form_validation->set_rules("precio", "Precio", "required");
        $this->form_validation->set_rules("stock", "Stock", "required");
        $this->form_validation->set_rules("precio_compra", "precio_compra", "required");
        $this->form_validation->set_rules("color", "color", "required");
        $this->form_validation->set_rules("talla", "talla", "required");
        $this->form_validation->set_rules("marca", "marca", "required");
        $this->form_validation->set_rules("fecha_ini", "Fecha que ingresa el producto", "required");

        if ($this->form_validation->run()) {
            $data = array(

                'id_productos' => $id_producto,
                'id_categorias' => $categoria,
                'codigo' => $codigo,
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio_compra' => $precio_compra,
                'precio' => $precio,
                'lugar_almacenado' => $lugar_almacenado,
                'stock' => $stock,
                'color' => $color,
                'talla' => $talla,
                'marca' => $marca,
                'fecha_registro' => $fecha_ini,

                'estado' => "1"
            );

            if ($this->Productos_model->actualizar($id_producto, $data)) {
                redirect(base_url() . "Mantenimiento/productos");
            } else {
                $this->session->set_flashdata("error", "No se pudo guardar la informacion");
            }
        } else {
            $this->editar($id_producto);
        }
    }
    public function vista($id_producto)

    {
        $data = array(
            'producto' => $this->Productos_model->getProducto($id_producto),

        );

        $this->load->view("/form/admin/Productos/vista", $data);
    }
    public function borrar($id_producto)
    {
        $data = array(
            'estado' => "0",
        );

        if ($this->Productos_model->actualizar($id_producto, $data)) {
            redirect(base_url() . "Mantenimiento/productos");
        } else {
            $this->session->set_flashdata("error", "No se pudo guardar la informacion");
        }
    }
}
