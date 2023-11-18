<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jual extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['title'] = 'Mitra Cell | Jual';
        $data['active_navbar'] = 'jual';
        $data['barang'] = $this->ModelBarang->getBarang();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/jual', $data);
        $this->load->view('templates/footer');
    }

    public function addJual()
    {
        $this->form_validation->set_rules(
            'kode[]',
            'Kode',
            'required',
            [
                'required' => 'Tidak Ada Barang Di Table Jual',
            ]
        );
        $this->form_validation->set_rules(
            'diskon[]',
            'diskon',
            'required',
            [
                'required' => 'Masukan Diskon Setidaknya 0 Atau Lebih',
            ]
        );
        $this->form_validation->set_rules(
            'qty[]',
            'qty',
            'required',
            [
                'required' => 'Masukan Qty Setidaknya 1',
            ]
        );
        $this->form_validation->set_rules(
            'intTotalHarga',
            'total harga',
            'required',
            [
                'required' => 'Total Harga Harus Ada',
            ]
        );

        $this->form_validation->set_rules(
            'intKembalian',
            'kembalian',
            'required',
            [
                'required' => 'Kembalian Harus Ada',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
            $kode_values = $this->input->post('kode');
            $nama_barang_values = $this->input->post('namaBarang');
            $harpok_values = $this->input->post('harpok');
            $harjul_values = $this->input->post('harjul');
            $stok_values = $this->input->post('stok');
            $qty_values = $this->input->post('qty');
            $diskon_values = $this->input->post('diskon');
            $total_values = $this->input->post('total');
            $total_harga = $this->input->post('intTotalHarga');
            $jumlah_uang = $this->input->post('intJumlahUang');
            $kembalian = $this->input->post('intKembalian');
            $tanggal_sekarang = date('YmdHis');
            $data_detail_jual = [];
            $data_stok = [];

            if ($jumlah_uang < $total_harga) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">Jumlah Uang Kurang<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                return redirect('jual');
            }
            $data_jual = [
                'nofak' => $tanggal_sekarang . $getId->user_id,
                'total' => $total_harga,
                'jml_uang' => $jumlah_uang,
                'kembalian' => $kembalian,
                'user_id' => $getId->user_id
            ];

            foreach ($kode_values as $index => $kode) {
                $nama_barang = $nama_barang_values[$index];
                $harpok = $harpok_values[$index];
                $harjul = $harjul_values[$index];
                $stok = $stok_values[$index];
                $qty = $qty_values[$index];
                $diskon = $diskon_values[$index];
                $total = $total_values[$index];
                $data_detail_jual[] = [
                    'jual_nofak' => $tanggal_sekarang . $getId->user_id,
                    'barang_kode' => $kode,
                    'nama' => $nama_barang,
                    'harpok' => $harpok,
                    'harjul' => $harjul,
                    'qty' => $qty,
                    'diskon' => $diskon,
                    'total' => $total,
                ];
                if ($stok < $qty) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">Qty Melebihi Stok<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                    return redirect('jual');
                }
                if ($qty == 0) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible text-center fade show" role="alert">Qty Tidak Boleh 0<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                    return redirect('jual');
                }
                $data_stok[] = [
                    'stok' => $stok - $qty,
                    'kode' => $kode,
                ];
            }
            $this->ModelBarang->updateBarangBatch($data_stok);
            $this->ModelJual->addJual($data_jual);
            $this->ModelJual->addDetailJual($data_detail_jual);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Jual<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('detail_jual/pdf/' . $data_jual['nofak']);
        }
    }
}