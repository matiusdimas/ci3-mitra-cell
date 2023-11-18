<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
            $data['kategori'] = $this->ModelKategori->getWhereKategori(['id' => $query_param]);
        } else {
            $data['kategori'] = $this->ModelKategori->getKategori();
        }
        $data['title'] = 'Mitra Cell | Kategori';
        $data['active_navbar'] = 'kategori';
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/kategori', $data);
        $this->load->view('templates/footer');
    }
    public function addKategori()
    {
        $this->form_validation->set_rules(
            'nama_kategori',
            'nama kategori',
            'required|min_length[3]|is_unique[kategori.kategori_nama]',
            [
                'required' => 'Nama Kategori Harus diisi',
                'min_length' => 'Nama Kategori terlalu pendek',
                'is_unique' => 'Nama Kategori Sudah Ada'
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $data = [
                'kategori_nama' => $this->input->post('nama_kategori')
            ];
            $this->ModelKategori->addKategori($data);
            $this->session->set_flashdata('pesan_tambah', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menambah Kategori<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
            redirect('kategori');
        }
    }

    public function updateKategori()
    {
        $this->form_validation->set_rules(
            'update_nama_kategori',
            'nama kategori',
            'required|min_length[3]|is_unique[kategori.kategori_nama]',
            [
                'required' => 'Nama Kategori Harus diisi',
                'min_length' => 'Nama Kategori terlalu pendek',
                'is_unique' => 'Nama Kategori Sudah Ada'
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $data = [
                'kategori_nama' => $this->input->post('update_nama_kategori')
            ];
            $this->ModelKategori->updateKategori($data, ['id' => $this->input->post('id')]);
            $this->session->set_flashdata('pesan_update', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Mengubah Kategori <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
            redirect('kategori');
        }
    }

    public function hapusKategori($id)
    {
        $this->ModelKategori->deleteKategori(['id' => $id]);
        $this->session->set_flashdata('pesan_delete', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menghapus Kategori<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
        redirect('kategori');
    }
}