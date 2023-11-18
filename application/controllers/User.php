<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
            $data['user'] = $this->ModelUser->cekData(['user_id' => $query_param])->result_array();
        } else {
            $data['user'] = $this->ModelUser->getUser();
        }
        $data['title'] = 'Mitra Cell | User';
        $data['active_navbar'] = 'user';
        $data['staff'] = $this->ModelStaff->getStaff();
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/user', $data);
        $this->load->view('templates/footer');
    }
    public function addUser()
    {
        $this->form_validation->set_rules(
            'username',
            'username',
            'required|trim|min_length[3]|is_unique[user.username]',
            [
                'required' => 'Username Harus Ada',
                'min_length' => 'Username Terlalu Pendek',
                'is_unique' => 'Username Sudah Ada',
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'password',
            'required|trim',
            [
                'required' => 'Passoword Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'role',
            'role',
            'required|min_length[3]',
            [
                'required' => 'Role Harus Ada',
                'min_length' => 'Role Harus Ada',
            ]
        );
        $this->form_validation->set_rules(
            'staffId',
            'staff Id',
            'required|numeric|is_unique[user.staff_id]',
            [
                'required' => 'Staff Id Harus Ada',
                'numeric' => 'Staff Id Harus Ada',
                'is_unique' => 'Staff Sudah Punya Akun'
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role'),
                'staff_id' => $this->input->post('staffId'),
            ];
            $this->ModelUser->addUser($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Tambah User<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('User');
        }
    }
    public function resetUser($id)
    {
        $this->ModelUser->updateUser(['password' => 'mitra123'], ['user_id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Reset Password<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('User');
    }
    public function updateUser()
    {
        $this->form_validation->set_rules(
            'user_id',
            'user id',
            'required',
            [
                'required' => 'User Id Harus Ada',
            ]
        );
        $username = $this->input->post('username-old');
        $usernameCheck = $this->ModelUser->cekData(['username' => $username])->row()->username;
        $usernameCheck != $this->input->post('upt_username') && $this->form_validation->set_rules(
            'upt_username',
            'Username',
            'required|trim|min_length[3]|is_unique[user.username]',
            [
                'required' => 'Username Harus Ada',
                'is_unique' => 'Username Sudah Ada',
                'min_length' => 'Username Terlalu Pendek',
            ]
        );
        $this->form_validation->set_rules(
            'upt_role',
            'Role',
            'required|min_length[3]',
            [
                'required' => 'Role Harus Ada',
                'min_length' => 'Role Harus Ada',
            ]
        );
        if ($this->form_validation->run() != true) {
            $this->index();
        } else {
            $data = [
                'username' => $this->input->post('upt_username'),
                'role' => $this->input->post('upt_role')
            ];
            $this->ModelUser->updateUser($data, ['user_id' => $this->input->post('user_id')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Update User<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('User');
        }
    }
    public function deleteUser($id)
    {
        $this->ModelUser->deleteUser(['user_id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible text-center fade show" role="alert">Berhasil Delete User<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('User');
    }
}