<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
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
            $data['supplier'] = $this->ModelSupplier->getWhereSupplier(['kode' => $query_param])->result_array();
        } else {
            $data['supplier'] = $this->ModelSupplier->getSupplier();
        }
        $data['title'] = 'Mitra Cell | Supplier';
        $data['active_navbar'] = 'supplier';
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/supplier', $data);
        $this->load->view('templates/footer');
    }
    public function addSupplier()
    {
        $this->form_validation->set_rules(
            'kode',
            'Kode',
            'required|min_length[3]|is_unique[supplier.kode]',
            [
                'required' => 'Kode Harus diisi',
                'min_length' => 'Kode terlalu pendek',
                'is_unique' => 'Kode Sudah Ada'
            ]
        );
        $this->form_validation->set_rules(
            'nama_supplier',
            'Nama Supplier',
            'required|min_length[3]|is_unique[supplier.nama]',
            [
                'required' => 'Nama Supplier Harus diisi',
                'min_length' => 'Nama Supplier terlalu pendek',
                'is_unique' => 'Nama Suplier Sudah Ada'
            ]
        );
        $this->form_validation->set_rules(
            'alamat',
            'alamat',
            'required|min_length[3]',
            [
                'required' => 'Alamat Harus diisi',
                'min_length' => 'Alamat terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'no_telp',
            'No Telp',
            'required|min_length[3]|numeric',
            [
                'required' => 'No Telp Harus diisi',
                'min_length' => 'No Telp terlalu pendek',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama_supplier'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'user_id' => $getId->user_id,
            ];
            $this->ModelSupplier->addSupplier($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menambah Supplier<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('supplier');
        }
    }
    public function updateSupplier()
    {
        $kode = $this->input->post('kode-old');
        $nama_supplier = $this->input->post('nama-old');
        $query_kode = $this->ModelSupplier->getWhereSupplier(['kode' => $kode])->row()->kode;
        $query_nama_supplier = $this->ModelSupplier->getWhereSupplier(['nama' => $nama_supplier])->row()->nama;
        $query_kode != $this->input->post('kode') &&
            $this->form_validation->set_rules(
                'kode',
                'Kode',
                'required|min_length[3]|is_unique[supplier.kode]',
                [
                    'required' => 'Kode Harus diisi',
                    'min_length' => 'Kode terlalu pendek',
                    'is_unique' => 'Kode Sudah Ada'
                ]
            );
        $query_nama_supplier != $this->input->post('nama_supplier') &&
            $this->form_validation->set_rules(
                'nama_supplier',
                'Nama Supplier',
                'required|min_length[3]|is_unique[supplier.nama]',
                [
                    'required' => 'Nama Supplier Harus diisi',
                    'min_length' => 'Nama Supplier terlalu pendek',
                    'is_unique' => 'Nama Supplier Sudah Ada'
                ]
            );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required|min_length[3]',
            [
                'required' => 'Alamat Harus diisi',
                'min_length' => 'Alamat terlalu pendek',
            ]
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required|min_length[3]',
            [
                'required' => 'Alamat Harus diisi',
                'min_length' => 'Alamat terlalu pendek',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama_supplier'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'updatedAt' => date("Y-m-d H:i:s"),
            ];
            $this->ModelSupplier->updateSupplier($data, ['kode' => $this->input->post('kode-old')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Mengubah Supplier <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
            redirect('supplier');
        }
    }
    public function deleteSupplier($kode)
    {
        $this->ModelSupplier->deleteSupplier(['kode' => $kode]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Menghapus Supplier<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
        redirect('supplier');
    }
}