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
        $data['tahun_query'] = $this->input->get('tahun');
        $data['bulan_query'] = $this->input->get('bulan');
        $tahun = $data['tahun_query'];
        $bulan = $data['bulan_query'];
        if ($tahun !== null && $bulan !== null) {
            $data['jual'] = $this->ModelJual->getWhereJual(["YEAR(createdAt)" => $tahun, "MONTH(createdAt)" => $bulan]);
        } elseif ($tahun !== null && $bulan === null) {
            $data['jual'] = $this->ModelJual->getWhereJual(["YEAR(createdAt)" => $tahun]);
        } elseif ($tahun === null && $bulan !== null) {
            $data['jual'] = $this->ModelJual->getWhereJual(["MONTH(createdAt)" => $bulan]);
        } else {
            $data['jual'] = $this->ModelJual->getJual();
        }
        $getTahun = $this->ModelJual->getJual();
        $data['tahun'] = [];
        $data['bulan'] = [];
        foreach ($getTahun as $jual) {
            $tahun = date('Y', strtotime($jual['createdAt']));
            $bulan = date('m', strtotime($jual['createdAt']));
            if (!in_array($tahun, $data['tahun'])) {
                $data['tahun'][] = $tahun;
            }
            if (!in_array($bulan, $data['bulan'])) {
                $data['bulan'][] = $bulan;
            }
        }
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
        $data['jual'] = $this->ModelJual->getWhereJual(['nofak' => $id]);
        $data['detail_jual'] = $this->ModelJual->getDetailJual(['jual_nofak' => $id]);
        $data['title'] = "Faktur-Jual/" . $data['jual'][0]['nofak'];
        $data['nofak'] = $data['jual'][0]['nofak'];
        $data['tanggal'] = $data['jual'][0]['createdAt'];
        $this->load->view('pdf_jual', $data);
    }

    function laporanPdf($tahun, $bulan = null)
    {
        if ($bulan !== null) {
            $data['title'] = 'Laporan Jual Tahun ' . $tahun . ' Bulan ' . date('F', mktime(0, 0, 0, $bulan, 1));
            $data['jual'] = $this->ModelJual->getWhereJual(["YEAR(createdAt)" => $tahun, "MONTH(createdAt)" => $bulan]);
            $jual_nofakArray = [];
            $data['totalJual'] = 0;
            foreach ($data['jual'] as $jual) {
                $data['totalJual'] += (int) $jual['total'];
                $jual_nofakArray[] = $jual['nofak'];
            }
            $data['detail_jual'] = $this->ModelJual->getDetailJual($jual_nofakArray, 'in');
        } else {
            $data['title'] = 'Laporan Jual Tahun ' . $tahun;
            $data['jual'] = $this->ModelJual->getWhereJual(["YEAR(createdAt)" => $tahun]);
            $jual_nofakArray = [];
            $data['totalJual'] = 0;
            foreach ($data['jual'] as $jual) {
                $data['totalJual'] += (int) $jual['total'];
                $jual_nofakArray[] = $jual['nofak'];
            }
            $data['detail_jual'] = $this->ModelJual->getDetailJual($jual_nofakArray, 'in');
        }
        $this->load->view('laporan_jual', $data);
    }
}