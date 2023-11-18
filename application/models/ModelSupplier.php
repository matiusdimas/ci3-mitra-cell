<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelSupplier extends CI_Model
{
    public function getSupplier()
    {
        $this->db->select('supplier.*, user.username AS username');
        $this->db->from('supplier');
        $this->db->join('user as user', 'supplier.user_id = user.user_id', 'left');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getWhereSupplier($data)
    {
        $this->db->select('supplier.*, user.username AS username');
        $this->db->from('supplier');
        $this->db->where($data);
        $this->db->join('user as user', 'supplier.user_id = user.user_id', 'left');
        return $this->db->get();
    }
    public function addSupplier($data)
    {
        return $this->db->insert('supplier', $data);
    }
    public function deleteSupplier($data)
    {
        $this->db->delete('supplier', $data);
    }
    public function updateSupplier($data, $where)
    {
        $this->db->update('supplier', $data, $where);
    }
}
