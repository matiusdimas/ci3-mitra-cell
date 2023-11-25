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
        $data['tahun_query'] = $this->input->get('tahun');
        $data['bulan_query'] = $this->input->get('bulan');
        $tahun = $data['tahun_query'];
        $bulan = $data['bulan_query'];
        if ($tahun !== null && $bulan !== null) {
            $data['beli'] = $this->ModelBeli->getWhereBeli(["YEAR(createdAt)" => $tahun, "MONTH(createdAt)" => $bulan]);
        } elseif ($tahun !== null && $bulan === null) {
            $data['beli'] = $this->ModelBeli->getWhereBeli(["YEAR(createdAt)" => $tahun]);
        } elseif ($tahun === null && $bulan !== null) {
            $data['beli'] = $this->ModelBeli->getWhereBeli(["MONTH(createdAt)" => $bulan]);
        } else {
            $data['beli'] = $this->ModelBeli->getBeli();
        }
        $getTahun = $this->ModelBeli->getBeli();
        $data['tahun'] = [];
        $data['bulan'] = [];
        foreach ($getTahun as $beli) {
            $tahun = date('Y', strtotime($beli['createdAt']));
            $bulan = date('m', strtotime($beli['createdAt']));
            if (!in_array($tahun, $data['tahun'])) {
                $data['tahun'][] = $tahun;
            }
            if (!in_array($bulan, $data['bulan'])) {
                $data['bulan'][] = $bulan;
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/detail/beli', $data);
        $this->load->view('templates/footer');
    }
    public function detail($id)
    {
        $data['title'] = 'Mitra Cell | Detail Beli';
        $data['active_navbar'] = 'pembelian';
        $data['nofak'] = $id;
        $data['beli'] = $this->ModelBeli->getDetailBeli(['beli_nofak' => $id]);
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/detail/detail_beli', $data);
        $this->load->view('templates/footer');
    }

    function pdf($id)
    {
        $data['beli'] = $this->ModelBeli->getWhereBeli(['nofak' => $id]);
        $data['detail_beli'] = $this->ModelBeli->getDetailBeli(['beli_nofak' => $id]);
        $data['title'] = "Faktur-Beli/" . $data['beli'][0]['nofak'];
        $data['nofak'] = $data['beli'][0]['nofak'];
        $data['tanggal'] = $data['beli'][0]['createdAt'];
        $data['supplier_kode'] = $data['beli'][0]['supplier_kode'];
        $this->load->view('pdf_beli', $data);
    }

    function laporanPdf($tahun, $bulan = null)
    {
        if ($bulan !== null) {
            $data['title'] = 'Laporan Beli Tahun ' . $tahun . ' Bulan ' . date('F', mktime(0, 0, 0, $bulan, 1));
            $data['beli'] = $this->ModelBeli->getWhereBeli(["YEAR(createdAt)" => $tahun, "MONTH(createdAt)" => $bulan]);
            $beli_nofakArray = [];
            $data['totalBeli'] = 0;
            foreach ($data['beli'] as $beli) {
                $data['totalBeli'] += (int) $beli['total'];
                $beli_nofakArray[] = $beli['nofak'];
            }
            $data['detail_beli'] = $this->ModelBeli->getDetailBeli($beli_nofakArray, 'in');
        } else {
            $data['title'] = 'Laporan Beli Tahun ' . $tahun;
            $data['beli'] = $this->ModelBeli->getWhereBeli(["YEAR(createdAt)" => $tahun]);
            $beli_nofakArray = [];
            $data['totalBeli'] = 0;
            foreach ($data['beli'] as $beli) {
                $data['totalBeli'] += (int) $beli['total'];
                $beli_nofakArray[] = $beli['nofak'];
            }
            $data['detail_beli'] = $this->ModelBeli->getDetailBeli($beli_nofakArray, 'in');
        }
        $this->load->view('laporan_beli', $data);
    }
}