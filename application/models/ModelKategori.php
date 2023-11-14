<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelKategori extends CI_Model
{
    public function getKategori()
    {
        $query = $this->db->get('kategori');
        return $query->result_array();
    }
    public function addKategori($data)
    {
        $this->db->insert('kategori', $data);
    }
    public function updateKategori($data, $where)
    {
        $this->db->update('kategori', $data, $where);
    }
    public function deleteKategori($id)
    {
        $this->db->delete('kategori', $id);
    }
}
