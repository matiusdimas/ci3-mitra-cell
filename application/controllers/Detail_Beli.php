<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_Beli extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        _cekRole();
    }

    public function index()
    {
        $data['title'] = 'Mitra Cell | Pembelian';
        $data['active_navbar'] = 'pembelian';
        $data['beli'] = $this->ModelBeli->getBeli();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/detail/beli', $data);
        $this->load->view('templates/footer');
    }
    public function detail($id)
    {
        $data['title'] = 'Mitra Cell | Detail Beli';
        $data['active_navbar'] = 'pembelian';
        $data['beli'] = $this->ModelBeli->getDetailBeli(['beli_nofak' => $id]);
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/detail/detail_beli', $data);
        $this->load->view('templates/footer');
    }
}