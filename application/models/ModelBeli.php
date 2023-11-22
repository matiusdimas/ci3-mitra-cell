<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelBeli extends CI_Model
{
    public function getBeli()
    {
        $this->db->select('beli.*, user.username');
        $this->db->from('beli');
        $this->db->join('user', 'beli.user_id = user.user_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getWhereBeli($where)
    {
        $this->db->select('beli.*, user.username');
        $this->db->from('beli');
        $this->db->where($where);
        $this->db->join('user', 'beli.user_id = user.user_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function addBeli($data)
    {
        return $this->db->insert('beli', $data);
    }

    public function getDetailBeli($where, $in = null)
    {
        if ($in) {
            $this->db->where_in('beli_nofak', $where);
            return $this->db->get('detail_beli')->result_array();
        } else {
            return $this->db->get_where('detail_beli', $where)->result_array();
        }
    }
    public function addDetailBeli($data)
    {
        return $this->db->insert_batch('detail_beli', $data);
    }
}