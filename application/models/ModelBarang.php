<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelBarang extends CI_Model
{
    public function getBarang()
    {
        $this->db->select('barang.*, kategori.kategori_nama, user1.username AS inputBy, user2.username AS last_inputBy');
        $this->db->from('barang');
        $this->db->join('kategori', 'barang.kategori_id = kategori.id', 'left');
        $this->db->join('user AS user1', 'barang.user_id = user1.user_id', 'left'); // Untuk user yang menginput barang
        $this->db->join('user AS user2', 'barang.user_id_last_updated = user2.user_id', 'left'); // Untuk user yang terakhir menginput barang
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getWhereBarang($data)
    {
        return $this->db->get_where('barang', $data);
    }
    public function addBarang($data)
    {
        $this->db->insert('barang', $data);
    }
    public function updateBarang($data, $where)
    {
        $this->db->update('barang', $data, $where);
    }
    public function updateBarangBatch($data)
    {
        $this->db->update_batch('barang', $data, 'kode');
    }
    public function deleteBarang($id)
    {
        $this->db->delete('barang', $id);
    }
}
