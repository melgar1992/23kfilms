<?php
class Descarte_producto_model extends CI_Model
{
    public function getDescartesProductos()
    {
        $this->db->select('d.*, p.nombre as nombre_producto, p.descripcion, p.precio, p.codigo, c.nombre as categorias_producto');
        $this->db->from('descarte_producto d');
        $this->db->join('productos p', 'p.id_productos = d.id_productos');
        $this->db->join('categorias c', 'c.id_categorias = p.id_categorias');
        $this->db->where('p.estado', '1');
        return $this->db->get()->result();
    }
    public function guardar($datos)
    {
        return $this->db->insert('descarte_producto', $datos);
    }
    public function getDescartesProducto($id_descarte_producto)
    {
        $this->db->select('d.*, p.nombre as nombre_producto, p.descripcion, p.precio, p.codigo, p.stock, c.nombre as categorias_producto');
        $this->db->from('descarte_producto d');
        $this->db->join('productos p', 'p.id_productos = d.id_productos');
        $this->db->join('categorias c', 'c.id_categorias = p.id_categorias');
        $this->db->where('p.estado', '1');
        $this->db->where('d.id_descarte_producto', $id_descarte_producto);
        return $this->db->get()->row();
    }
    public function actualizar($id_descarte_producto, $datos)
    {
        $this->db->where('id_descarte_producto', $id_descarte_producto);
        return $this->db->update('descarte_producto', $datos);
    }
    public function borrar($id_descarte_producto)
    {
        $this->db->where('id_descarte_producto', $id_descarte_producto);
        $this->db->delete('descarte_producto');
    }
    public function valorProductosDescartados()
    {
        $this->db->select('sum(d.cantidad * p.precio) as valor_descarte, sum(cantidad) as cantidad');
        $this->db->from('descarte_producto d, productos p');
        $this->db->where('d.id_productos = p.id_productos');
        return $this->db->get()->row_array();
    }
}
