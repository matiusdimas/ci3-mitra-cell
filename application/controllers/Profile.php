<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['title'] = 'Mitra Cell | Profile';
        $data['active_navbar'] = 'profile';
        $data['profile'] = $this->ModelUser->cekData(['username' => $this->session->userdata('username')])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/profile', $data);
        $this->load->view('templates/footer');
    }
    public function updateProfile()
    {
        $getId = $this->ModelUser->getId(['username' => $this->session->userdata('username')]);
        $username_old = $this->session->userdata('username');
        $username_new = $this->input->post('username');
        $username_old != $username_new && $this->form_validation->set_rules(
            'username',
            'username',
            'required|trim|min_length[3]|is_unique[user.username]',
            [
                'required' => 'Username Harus Ada',
                'min_length' => 'Username Tidak Boleh Pendek',
                'is_unique' => 'Username Telah Ada',
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'password',
            'required|trim|min_length[3]',
            [
                'required' => 'Password Harus Ada',
                'min_length' => 'Password Tidak Boleh Pendek',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $data = [
                'username' => $username_new,
                'password' => $this->input->post('password')
            ];
            $this->session->set_userdata(['username' => $username_new]);
            $this->ModelUser->updateUser($data, ['user_id' => $getId->user_id]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Update Profile<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('profile');
        }
    }
}