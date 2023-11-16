<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelBeli extends CI_Model
{
    public function addBeli($data)
    {
        return $this->db->insert('beli', $data);
    }
    public function addDetailBeli($data)
    {
        return $this->db->insert_batch('detail_beli', $data);
    }
}