<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Blank_fix extends Authenticated_Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->load->config('pagination');
            $this->load->library('pagination');
        }

        public function index()
        {
            // flashdata
            $this->session->set_flashdata('message', alert('gagal', 'Flashdata gagal'));
            
            /* pagination */
            $pagination_config = $this->config->item('pagination');
            $pagination_config['base_url']   = base_url() . "beranda/blank_fix/index/"; // sesuaikan dengan url controller pagination
            $pagination_config['total_rows'] = 100; // total rows diambil dari count seleurh record yang akan di-paginate
            $pagination_config['per_page']   = 30;
            
            $this->pagination->initialize($pagination_config);

            $this->_viewdata['pagination'] = $this->pagination->create_links();

            $page = ( ! empty($this->input->get('page'))) ? $this->input->get('page') : 0;
            $limit = $pagination_config['per_page'];
            /* // pagination */

            $this->_viewdata['js'] = '';
            
            $this->twig->display('templates/blank_fix', $this->_viewdata);
        }

        public function get_data_select2_ajax()
        {
            $search = $this->input->get('search');

            $this->db->select("
                modulId AS id,
                modulNama AS nama
            ");

            if ( ! empty($search)) {
                $this->db->like('modulNama', $search);
                $this->db->or_like('modulDeskripsi', $search);
            }

            $result = $this->db->get('modul')->result_array();
            echo json_encode($result);
        }

    }