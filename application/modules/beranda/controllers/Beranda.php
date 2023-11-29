<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends Authenticated_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_viewdata['js'] = '';
        
        $this->twig->display('beranda/views/beranda', $this->_viewdata);
    }

}