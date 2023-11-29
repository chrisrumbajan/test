<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_manajemen_user_model extends MY_Model
{

    public function __construct() 
    {
        parent::__construct();
    }

    public function get_modul_by_user($user_id)
    {
        $this->db->select('
            modulId AS id,
            modulNama AS nama,
            modulDeskripsi deskripsi
        ');
        $this->db->join('grup', 'userGrup = grupId');
        $this->db->join('grup_modul', 'grupId = grupmodulGrup');
        $this->db->join('modul', 'grupmodulModul = modulId');
        $this->db->where('userId', $user_id);
        $result = $this->db->get('user')->result_array();
        // hanya ambil kolom  berisi modulNama dan buat jadi array 1 dimensi
        $result = array_column($result, 'nama');

        return $result;
    }

    public function authorize_modul($user_id, $modul_nama)
    {
        $this->db->join('grup', 'userGrup = grupId');
        $this->db->join('grup_modul', 'grupId = grupmodulGrup');
        $this->db->join('modul', 'grupmodulModul = modulId');
        $this->db->where('userId', $user_id);
        $this->db->where('modulNama', $modul_nama);
        $result = $this->db->count_all_results('user');
        
        return $result > 0;
    }

    public function authorize_prodi($user_id, $prodi_id)
    {
        $this->db->join('grup', 'userGrup = grupId');
        $this->db->join('grup_prodi', 'grupId = grupprodiGrup');
        $this->db->where('userId', $user_id);
        $this->db->where('grupprodiProdi', $prodi_id);
        $result = $this->db->count_all_results('user');
        
        return $result > 0;
    }

}