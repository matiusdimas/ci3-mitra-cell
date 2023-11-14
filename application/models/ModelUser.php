<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    public function cekData($where = null)
    {
        return $this->db->get_where('user', $where);
    }
    public function getId($where = null)
    {
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }
}
?>