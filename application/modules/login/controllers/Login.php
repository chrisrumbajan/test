<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Login_model', 'login');

        $this->output->enable_profiler(FALSE);
    }

    public function index()
    {
        $this->twig->display('login/views/login', $this->_viewdata);
    }

    public function autentikasi()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $result = $this->login->authenticate($username, $password);

        if ( ! $result) {
            $this->session->set_flashdata('message', 'Username atau Password salah');

            redirect('login');
        } else {
            $this->session->set_userdata($this->config->item('session_name'), [
                'id'        => $result['id'],
                'username'  => $result['username'],
                'deskripsi' => $result['deskripsi']
            ]);
            
            redirect('beranda');
        }
    }

}