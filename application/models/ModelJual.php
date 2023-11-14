<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelJual extends CI_Model
{
    public function addJual($data)
    {
        return $this->db->insert('jual', $data);
    }
    public function addDetailJual($data)
    {
        return $this->db->insert_batch('detail_jual', $data);
    }
}