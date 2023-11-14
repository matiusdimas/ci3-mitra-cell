<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function login()
    {
        if ($this->session->userdata('username')) {
            redirect('dashboard');
        }
        $this->form_validation->set_rules(
            'username',
            'username',
            'required|trim',
            [
                'required' => 'username Harus diisi',
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'password',
            'required|trim',
            [
                'required' => 'password Harus diisi',
            ]
        );
        if ($this->form_validation->run() != true) {
            $data['title'] = 'Mitra Cell | Login';
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $username = htmlspecialchars(
            $this->input->post(
                'username',
                true
            )
        );
        $password = $this->input->post('password', true);
        $user = $this->ModelUser->cekData(['username' => $username, 'password' => $password])->row_array();
        //jika usernya ada
        if ($user) {
            $data = [
                'username' => $user['username'],
                'role' => $user['role']
            ];
            $this->session->set_userdata($data);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('pesan', '<div
            class="alert alert-danger alert-message" role="alert">Username Atau Password Salah</div>');
            redirect('/');
        }
    }

    public function logout (){
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        redirect('/');
    }
}

