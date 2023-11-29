<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends MY_Model
{

    public function __construct() 
    {
        parent::__construct();
    }

    public function authenticate($username, $password)
    {
        $this->db->select('
            userId AS id,
            userUsername AS username,
            userDeskripsi AS deskripsi,
            userPassword AS password
        ');
        $this->db->where('userUsername', $username);
        $result = $this->db->get('user')->row_array();
        
        if ( ! password_verify($password, $result['password'])) {
            return FALSE;
        } else {
            return $result;
        }
    }

}