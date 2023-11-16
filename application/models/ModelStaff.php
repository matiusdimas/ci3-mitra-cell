<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelStaff extends CI_Model
{
    public function getStaff()
    {
        return $this->db->get('staff')->result_array();
    }
    public function getWhereStaff($where = null)
    {
        return $this->db->get_where('staff', $where);
    }
    public function addStaff($data)
    {
        return $this->db->insert('staff', $data);
    }
    public function updateStaff($data, $where)
    {
        return $this->db->update('staff', $data, $where);
    }
    public function deleteStaff($where)
    {
        return $this->db->delete('staff', $where);
    }
}
?>