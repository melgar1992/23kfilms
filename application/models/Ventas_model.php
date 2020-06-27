<?php
class Ventas_model extends CI_Model
{
    public function getVentas()
    {
        $this->db->select('v.*, c.nombres');
        $this->db->from('ventas v');
        $this->db->join('clientes c', 'v.id_clientes = c.id_clientes');
        $resultado = $this->db->get();

        if ($resultado->num_rows() > 0) {

            return $resultado->result();
        } else {
            return false;
        }
    }
    public function getVentasporFecha($fechainicio, $fechafin)
    {

        $this->db->select('v.*, c.nombres');
        $this->db->from('ventas v');
        $this->db->join('clientes c', 'v.id_clientes = c.id_clientes');
        $this->db->where("v.fecha >=", $fechainicio);
        $this->db->where("v.fecha <=", $fechafin);

        $resultado = $this->db->get();

        if ($resultado->num_rows() > 0) {

            return $resultado->result();
        } else {
            return false;
        }
    }
    public function getVenta($id)
    {
        $this->db->select('v.*, c.nombres, c.direccion, c.telefono, c.num_documento as documento, c.nombres as nombre_cliente, e.nombre as nombre_empleado, e.apellidos as apellidos_empleado');
        $this->db->from('ventas v');
        $this->db->join('clientes c', 'v.id_clientes = c.id_clientes');
        $this->db->join('empleados e', 'v.id_empleados = e.id_empleados');
        $this->db->where("v.id_ventas", $id);
        $resultado = $this->db->get();
        return $resultado->row();
    }
    public function getDetalle($id)
    {
        $this->db->select('dt.*, p.codigo, p.nombre, p.stock');
        $this->db->from('detalle_ventas dt');
        $this->db->join('productos p', 'dt.id_productos=p.id_productos');
        $this->db->where("dt.id_ventas", $id);
        $resultados = $this->db->get();
        return $resultados->result();
    }
    public function getComprobantes()
    {
        $this->db->where('estado', '1');
        $resultados = $this->db->get("tipo_comprobante");
        return $resultados->result();
    }
    public function getComprobante($idcomprobante)
    {
        $this->db->where('id_tipo_comprobante', $idcomprobante);
        $resultado = $this->db->get('tipo_comprobante');
        return $resultado->row();
    }
    public function guardarVentas($data)
    {
        return $this->db->insert('ventas', $data);
    }
    public function actualizarVentas($id_venta, $data)
    {
        $this->db->where('id_ventas', $id_venta);
        return $this->db->update('ventas', $data);
    }
    public function ultimoID()
    {
        return $this->db->insert_id();
    }
    public function actualizarComprobante($idcomprobante, $data)
    {
        $this->db->where('id_tipo_comprobante', $idcomprobante);
        $this->db->update('tipo_comprobante', $data);
    }
    public function guardar_detalle($data)
    {
        $this->db->insert('detalle_ventas', $data);
    }
    public function borrar_detalle($id_detalle_venta)
    {
        $this->db->where('id_detalle_ventas', $id_detalle_venta);
        $this->db->delete('detalle_ventas');
    }
    public function borrar($id_ventas)
    {
        $this->db->where('id_ventas', $id_ventas);
        return $this->db->delete('ventas');
    }
    public function valorItemsProyectos()
    {

        $this->db->select_sum('importeTotal', 'valorTotal');
        $this->db->where('estado', '1');
        $this->db->where('fase_proyecto', 'En ejecucion');
        $valorTotal = $this->db->get('ventas')->row_array();
        $this->db->select_sum('cantidad', 'cantidad');
        $this->db->from('ventas v, detalle_ventas d');
        $this->db->where('v.id_ventas = d.id_ventas');
        $this->db->where('v.estado', '1');
        $this->db->where('v.fase_proyecto', 'En ejecucion');
        $cantidad = $this->db->get()->row_array();

        $resultado = array(
            'valorTotal' => $valorTotal['valorTotal'],
            'cantidad' => $cantidad['cantidad'],
        );
        return $resultado;
    }
    public function getEncargado($id)
    {
        $this->db->select('e.nombre, e.num_documento');
        $this->db->from('empleados e');
        $this->db->join('ventas v', 'v.id_empleados = e.id_empleados');
        $this->db->where("v.id_ventas", $id);
        $resultado = $this->db->get();
        return $resultado->row();
    }
}
