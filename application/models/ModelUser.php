<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    public function getUser()
    {
        $this->db->select('user.*, staff.nama');
        $this->db->from('user');
        $this->db->join('staff', 'user.staff_id = staff.id', 'left');

        return $this->db->get()->result_array();
    }
    public function addUser($data)
    {
        return $this->db->insert('user', $data);
    }
    public function updateUser($data, $where)
    {
        return $this->db->update('user', $data, $where);
    }
    public function deleteUser($id)
    {
        $this->db->delete('user', $id);
    }
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