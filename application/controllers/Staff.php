<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
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
            $data['staff'] = $this->ModelStaff->getWhereStaff(['id' => $query_param])->result_array();
        } else {
            $data['staff'] = $this->ModelStaff->getStaff();
        }
        $data['title'] = 'Mitra Cell | Staff';
        $data['active_navbar'] = 'staff';
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/staff', $data);
        $this->load->view('templates/footer');
    }
    public function addStaff()
    {
        $this->form_validation->set_rules(
            'nama',
            'nama',
            'required|min_length[3]',
            [
                'required' => 'Nama Harus Ada',
                'min_length' => 'Nama Terlalu Pendek',
            ]
        );
        $this->form_validation->set_rules(
            'noKtp',
            'No Ktp',
            'required|trim|is_unique[staff.no_ktp]',
            [
                'required' => 'No Ktp Harus Ada',
                'is_unique' => 'No Ktp Sudah Ada',
            ]
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required|min_length[3]',
            [
                'required' => 'Alamat Harus Ada',
                'min_length' => 'Alamat Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'noHp',
            'No Hp',
            'required|numeric',
            [
                'required' => 'No Hp Harus Ada',
                'numeric' => 'No Hp Tidak Benar',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'no_ktp' => $this->input->post('noKtp'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('noHp'),
                'createdAt' => date('YmdHis'),
            ];
            $this->ModelStaff->addStaff($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Tambah Staff<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('staff');
        }
    }
    public function updateStaff()
    {
        $this->form_validation->set_rules(
            'upt_nama',
            'nama',
            'required|min_length[3]',
            [
                'required' => 'Nama Harus Ada',
                'min_length' => 'Nama Terlalu Pendek',
            ]
        );
        $no_ktp = $this->input->post('noKtp-old');
        $no_ktpCheck = $this->ModelStaff->getWhereStaff(['no_ktp' => $no_ktp])->row()->no_ktp;
        $no_ktpCheck != $this->input->post('upt_noKtp') && $this->form_validation->set_rules(
            'upt_noKtp',
            'No Ktp',
            'required|trim|is_unique[staff.no_ktp]',
            [
                'required' => 'No Ktp Harus Ada',
                'is_unique' => 'No Ktp Sudah Ada',
            ]
        );
        $this->form_validation->set_rules(
            'upt_alamat',
            'alamat',
            'required|min_length[3]',
            [
                'required' => 'Alamat Harus Ada',
                'min_length' => 'Alamat Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'upt_noHp',
            'No Hp',
            'required|numeric',
            [
                'required' => 'No Hp Harus Ada',
                'numeric' => 'No Hp Tidak Benar',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $data = [
                'nama' => $this->input->post('upt_nama'),
                'no_ktp' => $this->input->post('upt_noKtp'),
                'alamat' => $this->input->post('upt_alamat'),
                'no_hp' => $this->input->post('upt_noHp'),
                'updatedAt' => date('YmdHis'),
            ];
            $this->ModelStaff->updateStaff($data, ['no_ktp' => $no_ktpCheck]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Update Staff<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('staff');
        }
    }
    public function deleteStaff($id)
    {
        $this->ModelStaff->deleteStaff(['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Delete Staff<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('staff');
    }
}