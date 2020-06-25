<?php

class Servicios extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['servicios'] = $this->Servicios_model->getServicios();
        $data['categoria_servicios'] = $this->Categorias_model->getCategorias();
        $this->loadView('Servicios', '/form/admin/servicios/list', $data);
    }
    public function guardarServicio()
    {
        $id_categoria_servicios = $this->input->post('id_categoria_servicios');
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');

        $servicioActual = $this->Servicios_model->getServicioNombre($nombre);

        if ($nombre == $servicioActual['nombre']) {
            $unique = '';
            $this->form_validation->set_rules("nombre", "Nombre", "required" . $unique);
            if ($this->form_validation->run()) {
                $this->editarFuncion($servicioActual['id_servicio'], $id_categoria_servicios, $nombre, $descripcion);
               
            } else {
                $this->index();
            }
        } else {
            $unique = '|is_unique[servicio.nombre]';
            $this->form_validation->set_rules("nombre", "Nombre", "required" . $unique);
            if ($this->form_validation->run()) {
                $this->guardar($id_categoria_servicios, $nombre, $descripcion);
            } else {
                $this->index();
            }
        }
    }
    public function editar($id_servicio)
    {
        $data['servicio'] = $this->Servicios_model->getServicio($id_servicio);
        $data['categoria_servicios'] = $this->Categorias_model->getCategorias();
        $this->loadView('Servicios', '/form/admin/servicios/editar', $data);
    }
    public function actualizarServicio()
    {
        $id_servicio = $this->input->post('id_servicio');
        $id_categoria_servicios = $this->input->post('id_categoria_servicios');
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');

        $servicioActual = $this->Servicios_model->getServicio($id_servicio);

        if ($nombre == $servicioActual['nombre']) {
            $unique = '';
        } else {
            $unique = '|is_unique[servicio.nombre]';
        }

        $this->form_validation->set_rules("nombre", "Nombre", "required" . $unique);
        if ($this->form_validation->run()) {

            $this->editarFuncion($id_servicio, $id_categoria_servicios, $nombre, $descripcion);

        } else {
            $this->session->set_flashdata("error", "No se pudo actualizar la informacion");
            redirect(base_url() . "Mantenimiento/servicios/editar" . $id_servicio);
        }
    }
    public function borrar($id_servicio)
    {
        $data = array(
            'estado' => "0",
        );
        $this->Servicios_model->actualizar($id_servicio, $data);
        echo "Mantenimiento/Servicios";
    }
    private function guardar($id_categoria_servicios, $nombre, $descripcion)
    {
        $data = array(
            'id_categoria_servicios' => $id_categoria_servicios,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'estado' => "1"
        );
        if ($this->Servicios_model->guardarServicios($data)) {
            redirect(base_url() . "Mantenimiento/Servicios");
        } else {
            $this->session->set_flashdata("error", "No se pudo guardar la informacion");
            redirect(base_url() . "Mantenimiento/Servicios");
        }
    }
    private function editarFuncion($id_servicio, $id_categoria_servicios, $nombre, $descripcion)
    {
        $data = array(
            'id_categoria_servicios' => $id_categoria_servicios,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'estado' => '1',
        );
        if ($this->Servicios_model->actualizar($id_servicio, $data)) {
            redirect(base_url() . "Mantenimiento/servicios");
        } else {
            $this->session->set_flashdata("error", "No se pudo actualizar la informacion");
            redirect(base_url() . "Mantenimiento/servicios/editar" . $id_servicio);
        }
    }
}
