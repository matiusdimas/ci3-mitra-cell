<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        _cekRole();
    }

    public function index()
    {
        $query_param = $this->input->get('query');
        if ($query_param !== null) {
            $data['barang'] = $this->ModelBarang->getwhereBarang(['kode' => $query_param])->result_array();
        } else {
            $data['barang'] = $this->ModelBarang->getBarang();
        }
        $data['title'] = 'Mitra Cell | Barang';
        $data['active_navbar'] = 'barang';
        $data['kategori'] = $this->ModelKategori->getKategori();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/barang', $data);
        $this->load->view('templates/footer');
    }
    public function addBarang()
    {
        $this->form_validation->set_rules(
            'kode',
            'Kode',
            'required|min_length[3]|is_unique[barang.kode]',
            [
                'required' => 'Kode Harus diisi',
                'min_length' => 'Kode terlalu pendek',
                'is_unique' => 'Kode Sudah Ada'
            ]
        );
        $this->form_validation->set_rules(
            'nama_barang',
            'nama barang',
            'required|min_length[3]|is_unique[barang.nama]',
            [
                'required' => 'Nama Barang Harus diisi',
                'min_length' => 'Nama Barang terlalu pendek',
                'is_unique' => 'Nama Barang Sudah Ada'
            ]
        );
        $this->form_validation->set_rules(
            'id_kategori',
            'Kategori',
            'required|min_length[1]|numeric',
            [
                'required' => 'Kategori Harus diisi',
                'min_length' => 'Kategori terlalu pendek',
                'numeric' => 'Kategori Harus diisi'
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama_barang'),
                'harpok' => 0,
                'harjul' => 0,
                'stok' => 0,
                'kategori_id' => $this->input->post('id_kategori'),
                'user_id' => $getId->user_id,

            ];
            $this->ModelBarang->addBarang($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menambah Barang<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
            redirect('barang');
        }
    }

    public function updateBarang()
    {
        $kode = $this->input->post('kode-old');
        $nama_barang = $this->input->post('nama-old');
        $query_kode = $this->ModelBarang->getWhereBarang(['kode' => $kode])->row()->kode;
        $query_nama_barang = $this->ModelBarang->getWhereBarang(['nama' => $nama_barang])->row()->nama;
        $query_kode != $this->input->post('kode') &&
            $this->form_validation->set_rules(
                'kode',
                'Kode',
                'required|min_length[3]|is_unique[barang.kode]',
                [
                    'required' => 'Kode Harus diisi',
                    'min_length' => 'Kode terlalu pendek',
                    'is_unique' => 'Kode Sudah Ada'
                ]
            );

        $query_nama_barang != $this->input->post('nama_barang') &&
            $this->form_validation->set_rules(
                'nama_barang',
                'nama barang',
                'required|min_length[3]|is_unique[barang.nama]',
                [
                    'required' => 'Nama Barang Harus diisi',
                    'min_length' => 'Nama Barang terlalu pendek',
                    'is_unique' => 'Nama Barang Sudah Ada'
                ]
            );
        $this->form_validation->set_rules(
            'harjul',
            'harga Jual',
            'required|min_length[1]|numeric',
            [
                'required' => 'Harga Jual Harus diisi',
                'min_length' => 'Harga Jual terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'harpok',
            'Harga Pokok',
            'required|min_length[1]|numeric',
            [
                'required' => 'Harga Pokok Harus diisi',
                'min_length' => 'Harga Pokok terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'id_kategori',
            'Kategori',
            'required|min_length[1]|numeric',
            [
                'required' => 'Kategori Harus diisi',
                'min_length' => 'Kategori terlalu pendek',
                'numeric' => 'Kategori Harus diisi'
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama_barang'),
                'harpok' => $this->input->post('harpok'),
                'harjul' => $this->input->post('harjul'),
                'kategori_id' => $this->input->post('id_kategori'),
                'user_id_last_updated' => $getId->user_id,
                'updatedAt' => date("Y-m-d H:i:s"),
            ];
            $this->ModelBarang->updateBarang($data, ['kode' => $kode]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Update Barang<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('barang');
        }
    }

    public function deleteBarang($kode)
    {
        $this->ModelBarang->deleteBarang(['kode' => $kode]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Hapus Barang<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('barang');
    }
}