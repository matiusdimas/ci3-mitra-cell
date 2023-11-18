<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelJual extends CI_Model
{
    public function getJual()
    {
        $this->db->select('jual.*, user.username');
        $this->db->from('jual');
        $this->db->join('user', 'jual.user_id = user.user_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getWhereJual($where)
    {
        $this->db->select('jual.*, user.username');
        $this->db->from('jual');
        $this->db->where($where);
        $this->db->join('user', 'jual.user_id = user.user_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function addJual($data)
    {
        return $this->db->insert('jual', $data);
    }
    public function getDetailJual($where)
    {
        return $this->db->get_where('detail_jual', $where)->result_array();
    }
    public function addDetailJual($data)
    {
        return $this->db->insert_batch('detail_jual', $data);
    }
}