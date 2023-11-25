<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        _cekRole();
        $data['title'] = 'Mitra Cell | Dashboard';
        $data['active_navbar'] = 'dashboard';
        // penjualan bulan ini
        $data['jual'] = $this->ModelJual->getWhereJual([
            'MONTH(createdAt)' => date('m'),
            'YEAR(createdAt)' => date('Y'),
        ]);
        $nofakArray = [];
        $data['totalPenjualan'] = 0;
        foreach ($data['jual'] as $jual) {
            $data['totalPenjualan'] += (int) $jual['total'];
            $nofakArray[] = $jual['nofak'];
        }
        $data['detail_jual'] = $this->ModelJual->getDetailJual($nofakArray, 'in');
        $data['total_penjualan'] = $data['totalPenjualan'];
        $data['jumlahData'] = count($data['jual']);
        $data['totalQty'] = 0;
        foreach ($data['detail_jual'] as $item) {
            $data['totalQty'] += (int) $item['qty'];
        }
        // pembelian bulan ini
        $data['beli'] = $this->ModelBeli->getWhereBeli([
            'MONTH(createdAt)' => date('m'),
            'YEAR(createdAt)' => date('Y'),
        ]);
        $beli_nofakArray = [];
        $data['totalBeli'] = 0;
        foreach ($data['beli'] as $beli) {
            $data['totalBeli'] += (int) $beli['total'];
            $beli_nofakArray[] = $beli['nofak'];
        }
        $data['detail_beli'] = $this->ModelBeli->getDetailBeli($beli_nofakArray, 'in');
        $data['total_pembelian'] = $data['totalBeli'];
        $data['jumlahDataBeli'] = count($data['beli']);
        $data['totalQtyBeli'] = 0;
        foreach ($data['detail_beli'] as $item) {
            $data['totalQtyBeli'] += (int) $item['jumlah'];
        }
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    public function coba()
    {
        // $data['jual'] = $this->ModelJual->getWhereJual([
        //     'MONTH(createdAt)' => date('m'),
        //     'YEAR(createdAt)' => date('Y'),
        // ]);
        // $nofakArray = [];
        // $data['totalPenjualan'] = 0;
        // foreach ($data['jual'] as $jual) {
        //     $data['totalPenjualan'] += (int) $jual['total'];
        //     $nofakArray[] = $jual['nofak'];
        // }
        // $data['detail_jual'] = $this->ModelJual->getDetailJual($nofakArray, 'in');
        // $data['total_penjualan'] = $data['totalPenjualan'];
        // $data['jumlahData'] = count($data['jual']);
        // $data['totalQty'] = 0;
        // foreach ($data['detail_jual'] as $item) {
        //     $data['totalQty'] += (int) $item['qty'];
        // }
        // $this->load->view('dashboard/coba', $data);
        // Dalam view atau file tampilan CodeIgniter
        redirect("controller/method", 'Tautan ke Halaman Baru', ['target' => '_blank']);

    }
}
