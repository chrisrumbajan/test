<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . 'libraries/Tik_upload.php';

class Contoh extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function upload()
    {
        $this->load->view('contoh_upload');
    }

    public function do_upload()
    {
        $config['upload_path']      = 'uploads/'; 
        $config['allowed_types']    = 'jpg|jpeg|png|pdf';
        $config['max_size']         = '5000';
        
        $dokumen_1 = new Tik_upload('dokumen_1', $config);
        // $dokumen_1->set_old_file_name('file_lama.jpeg');
        // $dokumen_1->set_file_name('dokumen_1');
        $dokumen_1->upload();

        $dokumen_2 = new Tik_upload('dokumen_2', $config);
        // $dokumen_2->set_file_name('dokumen_2');
        $dokumen_2->upload();

        // echo '<pre>'; 
        // print_r($dokumen_1->upload_data);
        // print_r($dokumen_2->upload_data);
        // exit();

        // $dokumen_1->batal_upload();
        // $dokumen_2->batal_upload();

        if ($dokumen_1->status != TRUE OR $dokumen_2->status != TRUE) {
            echo 'Error dokumen 1 : ' . $dokumen_1->error_message . '<br />';
            echo 'Error dokumen 2 : ' . $dokumen_2->error_message;
        } else {
            echo 'Berhasil upload data';
        }
    }

}