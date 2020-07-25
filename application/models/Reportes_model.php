<?php
class Reportes_model extends CI_Model
{

    public function total_proyectos_aprobados()
    {
        $this->db->select('sum(facturaTotal) as Total, count(id_ventas) as cantidad_aprobados');
        $this->db->from('ventas');
        $this->db->where('estado', '1');
        $this->db->where('id_presupuesto is null');
        $this->db->where('fase_proyecto','Aprobado');
        return $this->db->get()->row_array();
    }
    public function total_proyectos_evaluacion()
    {
        $this->db->select('sum(facturaTotal) as Total, count(id_ventas) as cantidad_aprobados');
        $this->db->from('ventas');
        $this->db->where('estado', '1');
        $this->db->where('id_presupuesto is null');
        $this->db->where('fase_proyecto','Evaluacion del presupuesto');
        return $this->db->get()->row_array();
    }
    public function reporte_ganacias()
    {
        $this->db->select('v.id_ventas, v.proyecto, v.fecha, c.nombres as nombre_cliente, 
        (select facturaTotal from ventas p where p.id_ventas = v.id_presupuesto) as ingreso_bruto,
        (select honorarios_agencia from ventas p where p.id_ventas = v.id_presupuesto) as honorarios_agencia,
        v.costo_produccion');
        $this->db->from('ventas v');
        $this->db->join('clientes c','c.id_clientes = v.id_clientes');
        $this->db->where('v.estado', '1');
        $this->db->where('v.id_presupuesto !=','null');
        return $this->db->get()->result_array();
    }

}