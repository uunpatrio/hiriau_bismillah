<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
    }

    public function index()
    {
        $session = $this->session->userdata('status');

        if ($session == '') {
            $this->load->view('vlogin');
        } else {
            redirect('Home');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $data = $this->M_login->cek_login($username, $password);
            // var_dump($data);
            // die();
            if ($data->username != $username || $data->password != $password) {
                $this->session->set_flashdata('error_msg', 'Username dan Password Salah');
                redirect('C_admin');
            } else {
                $session = [
                    'userdata' => $data,
                    'status' => "rahasia"
                ];
                $this->session->set_userdata($session);
                redirect('Home');
            }
        } else {
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('C_admin');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('C_admin');
    }
}
