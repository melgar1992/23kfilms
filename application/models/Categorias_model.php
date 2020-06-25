<?php
class Categorias_model extends CI_Model
{

    public function getCategorias()
    {
        $this->db->where("estado", "1");
        $resultados = $this->db->get("categoria_servicios");
        return $resultados->result();
    }

    public function guardarCat($data)
    {
        return $this->db->insert("categoria_servicios", $data);
    }
    public function getCategoria($id_categoria_servicios)
    {
        $this->db->where("id_categoria_servicios", $id_categoria_servicios);
        $resultado = $this->db->get("categoria_servicios");
        return $resultado->row();
    }
    public function actualizar($id_categoria_servicios, $data)
    {
        $this->db->where("id_categoria_servicios", $id_categoria_servicios);
        return $this->db->update("categoria_servicios", $data);
    }
}
