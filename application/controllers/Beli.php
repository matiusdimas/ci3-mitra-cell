<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beli extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        _cekRole();
    }
    public function index()
    {
        $data['title'] = 'Mitra Cell | Beli';
        $data['active_navbar'] = 'beli';
        $data['supplier'] = $this->ModelSupplier->getSupplier();
        $data['barang'] = $this->ModelBarang->getBarang();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/beli', $data);
        $this->load->view('templates/footer');
    }
    public function addBeli()
    {
        $this->form_validation->set_rules(
            'kodeSupplier[]',
            'Kode Supplier',
            'required',
            [
                'required' => 'Kode Supplier Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'kodeBarang[]',
            'Kode Barang',
            'required',
            [
                'required' => 'Kode Barang Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'harga[]',
            'Harga Barang',
            'required',
            [
                'required' => 'Harga Barang Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'jumlah[]',
            'Jumlah Barang',
            'required',
            [
                'required' => 'Jumlah Barang Harus Ada',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
            $kode_supplier_values = $this->input->post('kodeSupplier');
            $kode_barang_values = $this->input->post('kodeBarang');
            $nama_barang_values = $this->input->post('namaBarang');
            $harga_values = $this->input->post('harga');
            $jumlah_values = $this->input->post('jumlah');
            $total_values = $this->input->post('total');
            $total_values = $this->input->post('total');
            $total_harga = $this->input->post('intTotalHarga');
            $tanggal_sekarang = date('YmdHis');
            $data_detail_beli = [];
            $data_stok = [];

            if ($total_harga < 1) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">Total Tidak Boleh 0<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                return redirect('beli');
            }
            $data_beli = [
                'nofak' => 'B' . $tanggal_sekarang . $kode_supplier_values[0] . $getId->user_id,
                'createdAt' => $tanggal_sekarang,
                'supplier_kode' => $kode_supplier_values[0],
                'user_id' => $getId->user_id,
                'total' => $total_harga,
            ];
            foreach ($kode_supplier_values as $index => $kode) {
                $beli_nofak = 'B' . $tanggal_sekarang . $kode_supplier_values[0] . $getId->user_id;
                $barang_id = $kode_barang_values[$index];
                $nama_barang = $nama_barang_values[$index];
                $harga = $harga_values[$index];
                $jumlah = $jumlah_values[$index];
                $total = $total_values[$index];
                if ($jumlah < 1) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">Jumlah Tidak Boleh 0<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                    return redirect('beli');
                }
                $data_detail_beli[] = [
                    'beli_nofak' => $beli_nofak,
                    'barang_kode' => $barang_id,
                    'nama' => $nama_barang,
                    'harga' => $harga,
                    'jumlah' => $jumlah,
                    'total' => $total,
                ];
                $stok = $this->ModelBarang->getWhereBarang(['kode' => $barang_id])->row()->stok;
                $harpok = $this->ModelBarang->getWhereBarang(['kode' => $barang_id])->row()->harpok;
                if ($harpok == 0 || $stok == 0) {
                    $harpok_new = $harga;
                    $harjul_new = intval(ceil($harga + ($harga * (20 / 100))));
                } else {
                    $modal = intval($harpok * $stok + $total);
                    $harpok_new = intval(ceil(($modal) / ($stok + $jumlah)));
                    $harjul_new = intval(ceil(($modal + ($modal * (20 / 100))) / ($stok + $jumlah)));
                }
                $data_stok[] = [
                    'harjul' => $harjul_new,
                    'harpok' => $harpok_new,
                    'stok' => $stok + $jumlah,
                    'kode' => $barang_id,
                ];
            }
            $this->ModelBarang->updateBarangBatch($data_stok);
            $this->ModelBeli->addBeli($data_beli);
            $this->ModelBeli->addDetailBeli($data_detail_beli);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Beli<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('detail_beli/pdf/' . $data_beli['nofak']);
        }
    }
}