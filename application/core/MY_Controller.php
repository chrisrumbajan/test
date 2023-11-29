<?php
defined('BASEPATH') or exit('Direct access script is not allowed');

class MY_Controller extends CI_Controller
{

    protected $_viewdata;

    public function __construct() 
    {
        parent::__construct();

        $this->load->library('twig', [
            // 'cache' => 'application/cache/twig',
            'cache' => FALSE,
            'paths' => [
                'application/views',
                'application/modules'
            ],
            'functions_safe' => [
                'pre', 
                'arrow_back', 
                'indonesian_date',
                'default_date',
                'default_datetime',
                'number_to_rupiah',
                'rupiah_to_number',
                'array_intersect'
            ]
        ]);

        $this->_viewdata = [
            // konfigurasi website
            'logo_unsrat'       => $this->config->item('resource_url') . 'img/logo-unsrat-mosaic.png',
            'foto_profil_default' => $this->config->item('resource_url') . 'img/user.png',
            'pas_foto_default'  => $this->config->item('resource_url') . 'img/pas_foto_default.jpg',
            'default_img'       => $this->config->item('resource_url') . 'img/default.jpg',
            'resource_url'      => $this->config->item('resource_url'),
            'website_title'     => $this->config->item('theme')['website_title'],
            'login_app_name'    => $this->config->item('theme')['login_app_name'], 
            'app_name'          => $this->config->item('theme')['app_name'],
            'app_logo'          => $this->config->item('theme')['app_logo'],
            'website_footer'    => $this->config->item('theme')['website_footer'],
            'version_number'    => $this->config->item('theme')['version_number'],
            // flashdata
            'flashdata'         => $this->session->flashdata()
        ];

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters(' ', '<br />');

        if ( ! $this->input->is_ajax_request()) {
            $this->output->enable_profiler($this->config->item('enable_profiler'));
        }
    }

}

class Authenticated_Controller extends MY_Controller
{

    protected $_sessdata;

    public function __construct() 
    {
        parent::__construct();

        $this->_sessdata = $this->session->userdata($this->config->item('session_name'));

        $this->_authenticate();

        $this->load->model('Base_manajemen_user_model', 'base_manajemen_user');

        // informasi user
        $this->_viewdata['user_username'] = $this->_sessdata['username'];
        $this->_viewdata['user_deskripsi'] = $this->_sessdata['deskripsi'];

        // layout dan sidebar
        $this->_viewdata['layout'] = 'templates/layout.twig';
        $this->_viewdata['sidebar'] = 'templates/sidebar.twig';
        
        // modul berhak
        $this->_viewdata['modul_berhak'] = $this->base_manajemen_user->get_modul_by_user($this->_sessdata['id']);
        
        $this->_viewdata['menu_tree'] = [
            'modul_1' => array_intersect($this->_viewdata['modul_berhak'], [
                'sub_modul_1a', 'sub_modul_1b'
            ]),
        ];
    }

    public function logout()
    {
        $this->session->unset_userdata($this->config->item('session_name'));

        redirect('login');
    }

    private function _authenticate()
    {
        if (empty($this->_sessdata['username']) OR $this->_sessdata['username'] == '') {
            $this->logout();
        }
    }

    protected function _authorize($data)
    {
        if ( ! empty($data['modul'])) {
            if ( ! $this->base_manajemen_user->authorize_modul($this->_sessdata['id'], $data['modul'])) {
                $this->logout();
            }
        }
        
        if ( ! empty($data['prodi'])) {
            if ( ! $this->base_manajemen_user->authorize_prodi($this->_sessdata['id'], $data['prodi'])) {
                $this->logout();
            }
        }
    }

}