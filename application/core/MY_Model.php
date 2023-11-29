<?php
defined('BASEPATH') or exit('Direct access script is not allowed');

class MY_Model extends CI_Model 
{ 
    private $example_db; 

    public function __construct() { 
        $this->example_db = $this->load->database('', TRUE); 

        // Pass reference of database to the CI-instance 
        $CI =& get_instance(); 
        $CI->example_db =& $this->example_db; 
    } 
}