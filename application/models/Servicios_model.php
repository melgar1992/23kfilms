<?php
class Servicios_model extends CI_Model
{

    public function getServicios()
    {
        $this->db->select('s.*, cs.nombre as categoria, cs.descripcion as categoria_descripcion');
        $this->db->from('servicio s');
        $this->db->join('categoria_servicios cs','cs.id_categoria_servicios = s.id_categoria_servicios');
        $this->db->where('s.estado','1');
        return $this->db->get()->result_array();
    }
    public function getServicio($id_servicio)
    {
        $this->db->select('s.*, cs.nombre as categoria, cs.descripcion as categoria_descripcion');
        $this->db->from('servicio s');
        $this->db->join('categoria_servicios cs','cs.id_categoria_servicios = s.id_categoria_servicios');
        $this->db->where('s.estado','1');
        $this->db->where('s.id_servicio',$id_servicio);
        return $this->db->get()->row_array();
    }
    public function getServicioNombre($nombre)
    {
        $this->db->select('s.*, cs.nombre as categoria, cs.descripcion as categoria_descripcion');
        $this->db->from('servicio s');
        $this->db->join('categoria_servicios cs','cs.id_categoria_servicios = s.id_categoria_servicios');
        $this->db->where('s.nombre',$nombre);
        return $this->db->get()->row_array();
    }
    public function getServiciosCategoria($id_categoria)
    {
        $this->db->select('s.*, cs.nombre as categoria, cs.descripcion as categoria_descripcion');
        $this->db->from('servicio s');
        $this->db->join('categoria_servicios cs','cs.id_categoria_servicios = s.id_categoria_servicios');
        $this->db->where('s.id_categoria_servicios',$id_categoria);
        return $this->db->get()->result_array();
    }
    public function actualizar($id_servicio, $data)
    {
        $this->db->where('id_servicio', $id_servicio);
        return $this->db->update('servicio', $data);
    }
    public function guardarServicios($data)
    {
        $this->db->insert('servicio', $data);
        return $this->db->insert_id();
    }



}