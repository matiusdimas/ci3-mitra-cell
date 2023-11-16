<?php
function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda belum login!!</div>');
        redirect('/');
    } else {
        $username = $ci->session->userdata('username');
        $ci->db->where('username', $username);
        $user = $ci->db->get('user')->row();
        if (!$user) {
            $ci->session->unset_userdata('username');
            $ci->session->unset_userdata('role');
            $ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akses ditolak. Username tidak valid!</div>');
            redirect('/');
        } else {
            $data = [
                'username' => $user->username,
                'role' => $user->role,
            ];
            $ci->session->set_userdata($data);
        }
    }
}

function _cekRole()
{
    $ci = get_instance();
    if ($ci->session->userdata('role') === 'STAFF') {
        redirect('dashboard/jual');
    }
}