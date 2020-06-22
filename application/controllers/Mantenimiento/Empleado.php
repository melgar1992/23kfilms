<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empleado extends BaseController
{

    public function index()
    {

        $data = array(
            'Empleados' => $this->Empleado_model->getEmpleados(),
            'tipodocumentos'=>$this->Empleado_model->getTipoDocumentos(),
        );

        $this->loadView('Empleados', '/form/admin/empleado/list', $data);
    }
    public function guardarEmpleado()
    {
        $nombres = $this->input->post('nombre');
        $apellidos = $this->input->post('apellidos');
        $telefono1 = $this->input->post('telefono1');
        $telefono2 = $this->input->post('telefono2');
        $direccion = $this->input->post('direccion');
        $tipodocumento = $this->input->post('tipodocumento');
        $num_documento = $this->input->post('num_documento');
       

        $this->form_validation->set_rules("nombre", "Nombre", "required");
        $this->form_validation->set_rules("apellidos", "Apellidos", "required");
        $this->form_validation->set_rules(
            'num_documento',
            'num_documento',
            array(
                'required',
                array('validarCi', array($this->Empleado_model, 'validarCi'))
            ),
            array('validarCi' => 'Carnet de identidad ya esta siendo ocupado')
        );
        $this->form_validation->set_rules("telefono1", "telefono1", "required");       
        $this->form_validation->set_rules("direccion", "direccion", "required");      
        $this->form_validation->set_rules('tipodocumento', 'tipodocumento', 'required');


        if ($this->form_validation->run()) {
            $datosEmpleado = array(
                'id_tipo_documento'=>$tipodocumento,
                'nombre' => $nombres,
                'apellidos' => $apellidos,
                'telefono_01' => $telefono1,
                'telefono_02' => $telefono2,
                'direccion' => $direccion,   
                'num_documento' => $num_documento,
                'estado' => '1',
            );
            if ($this->Empleado_model->guardarEmpleado($datosEmpleado)) {
                redirect(base_url() . 'Mantenimiento/Empleado');
            } else {
                $this->session->set_flashdata("error", "No se pudo guardar los datos del empleado");
            }
        } else {
            $this->session->set_flashdata("error", "No se pudo guardar los datos del empleado");
            redirect(base_url() . 'Mantenimiento/Empleado');
        }
    }
    public function editar($id_empleados)
    {
        $data = array(
            'Empleado' => $this->Empleado_model->getEmpleado($id_empleados),
            'tipodocumentos'=>$this->Empleado_model->getTipoDocumentos(),
        );

        $this->loadView('Empleados', '/form/admin/empleado/editar', $data);
    }
    public function actualizarEmpleado()
    {
        $id_empleados = $this->input->post('id_empleados');
        $nombres = $this->input->post('nombre');
        $apellidos = $this->input->post('apellidos');
        $telefono1 = $this->input->post('telefono1');
        $telefono2 = $this->input->post('telefono2');
        $direccion = $this->input->post('direccion');
        $tipodocumento = $this->input->post('tipodocumento');
        $num_documento = $this->input->post('num_documento');
       

        $empleado_actual = $this->Empleado_model->getEmpleado($id_empleados);

        $this->form_validation->set_rules("nombre", "Nombre", "required");
        $this->form_validation->set_rules("apellidos", "Apellidos", "required");
        if ($num_documento == $empleado_actual->num_documento) {
        } else {
            $this->form_validation->set_rules(
                'num_documento',
                'num_documento',
                array(
                    'required',
                    array('validarCi', array($this->Empleado_model, 'validarCi'))
                ),
                array('validarCi' => 'Carnet de identidad ya esta siendo ocupado')
            );
        }
       
        $this->form_validation->set_rules("telefono1", "telefono1", "required");       
        $this->form_validation->set_rules("direccion", "direccion", "required");      
        $this->form_validation->set_rules('tipodocumento', 'tipodocumento', 'required');

        if ($this->form_validation->run()) {
            $datos= array(
                'id_tipo_documento'=>$tipodocumento,
                'nombre' => $nombres,
                'apellidos' => $apellidos,
                'telefono_01' => $telefono1,
                'telefono_02' => $telefono2,
                'direccion' => $direccion,   
                'num_documento' => $num_documento,
                'estado' => '1',
            );
            
            if ($this->Empleado_model->actualizar($id_empleados, $datos)) {
                redirect(base_url() . "Mantenimiento/Empleado");

            } else {
                $this->session->set_flashdata("error", "No se pudo actualizar la informacion");
                redirect(base_url() . "/form/admin/empleado/editar" . $id_empleados);
            }
        } else {
            
            $this->editar($id_empleados);
        }
    }
    public function borrar($id_empleados)
    {

        $datos = array(
            'estado' => '0',
        );
        $this->Empleado_model->borrar($id_empleados, $datos);
        echo 'Mantenimiento/Empleado';
    }
}