<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_Jual extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        _cekRole();
    }

    public function index()
    {
        $data['title'] = 'Mitra Cell | Penjualan';
        $data['active_navbar'] = 'penjualan';
        $data['jual'] = $this->ModelJual->getJual();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/detail/jual', $data);
        $this->load->view('templates/footer');
    }
    public function detail($id)
    {
        $data['title'] = 'Mitra Cell | Detail Jual';
        $data['active_navbar'] = 'penjualan';
        $data['jual'] = $this->ModelJual->getDetailJual(['jual_nofak' => $id]);
        $data['nofak'] = $id;
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/detail/detail_jual', $data);
        $this->load->view('templates/footer');
    }
    function pdf($id)
    {
        $this->load->library('pdf');
        $data['jual'] = $this->ModelJual->getWhereJual(['nofak' => $id]);
        $data['detail_jual'] = $this->ModelJual->getDetailJual(['jual_nofak' => $id]);
        $data['title'] = "Faktur Jual" . $data['jual'][0]['nofak'];
        $data['nofak'] = $data['jual'][0]['nofak'];
        $data['tanggal'] = $data['jual'][0]['createdAt'];
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('pdf_jual', $data, TRUE);
        $this->pdf->generate($html, $file_pdf, $paper, $orientation);
    }
}