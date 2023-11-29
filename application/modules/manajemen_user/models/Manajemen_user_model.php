<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_user_model extends MY_Model
{

    public function __construct() 
    {
        parent::__construct();
    }

    public function get_user()
    {
        $this->db->select('
            userId AS user_id,
            userUsername AS user_username,
            userDeskripsi AS user_deskripsi,
            grupId AS grup_id,
            grupNama AS grup_nama
        ');
        $this->db->join('grup', 'userGrup = grupId', 'left');
        $this->db->order_by('userUsername');
        $result = $this->db->get('user')->result_array();

        return $result;
    }

    public function get_ref_grup()
    {
        $this->db->select('
            grupId AS grup_id,
            grupNama AS grup_nama
        ');
        $this->db->order_by('grupNama');
        $result = $this->db->get('grup')->result_array();

        return $result;
    }

    public function get_ref_modul()
    {
        $this->db->select('
            modulId AS modul_id,
            modulNama AS modul_nama,
            modulDeskripsi AS modul_deskripsi
        ');
        $this->db->order_by('modulDeskripsi');
        $result = $this->db->get('modul')->result_array();

        return $result;
    }

    public function get_ref_prodi()
    {
        $this->db->select("
            prodiKode AS id,
            prodiNamaResmi AS nama,
            prodiNamaJenjang AS jenjang,
            CONCAT(prodiNamaJenjang, ' - ', prodiNamaResmi) AS nama_lengkap
        ");
        $result = $this->db->get('program_studi')->result_array();

        return $result;
    }

    public function is_user_exists($user_id)
    {
        $this->db->where('userId', $user_id);
        $result = $this->db->count_all_results('user');

        return $result > 0;
    }

    public function is_grup_exists($grup_id)
    {
        $this->db->where('grupId', $grup_id);
        $result = $this->db->count_all_results('grup');

        return $result > 0;
    }

    public function is_modul_exists($modul_id)
    {
        $this->db->where('modulId', $modul_id);
        $result = $this->db->count_all_results('modul');

        return $result > 0;
    }

    public function tambah_user($data)
    {
        $this->db->insert('user', $data);
        $result = $this->db->affected_rows() > 0;

        return $result;
    }

    public function edit_user($user_id, $data)
    {
        $this->db->set($data);
        $this->db->where('userId', $user_id);
        $result = $this->db->update('user');

        return $result;
    }

    public function hapus_user($user_id)
    {
        $this->db->where('userId', $user_id);
        $this->db->delete('user');
        $result = $this->db->affected_rows() > 0;

        return $result;
    }

    public function get_grup()
    {
        $this->db->select('
            grupId AS id,
            grupNama AS nama
        ');
        $this->db->order_by('grupNama');
        $result = $this->db->get('grup')->result_array();

        if ( ! $result) {
            return $result;
        }

        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['modul'] = $this->get_modul_by_grup($result[$i]['id']);
        }

        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['prodi'] = $this->get_prodi_by_grup($result[$i]['id']);
        }

        return $result;
    }

    public function get_modul_by_grup($grup_id)
    {
        $this->db->select('
            modulId AS id,
            modulNama AS nama,
            modulDeskripsi AS deskripsi
        ');
        $this->db->join('modul', 'grupmodulModul = modulId');
        $this->db->where('grupmodulGrup', $grup_id);
        $this->db->order_by('modulNama');
        $result = $this->db->get('grup_modul')->result_array();

        return $result;
    }

    public function get_prodi_by_grup($grup_id)
    {
        $this->db->select("
            prodiKode AS id,
            prodiNamaResmi AS nama,
            prodiNamaJenjang AS jenjang,
            CONCAT(prodiNamaJenjang, ' - ', prodiNamaResmi) AS nama_lengkap
        ");
        $this->db->join('program_studi', 'grupprodiProdi = prodiKode');
        $this->db->where('grupprodiGrup', $grup_id);
        $this->db->order_by('prodiFakKode, prodiLabelNim_old');
        $result = $this->db->get('grup_prodi')->result_array();

        return $result;
    }

    public function tambah_grup($data)
    {
        $this->db->insert('grup', $data);
        $result = $this->db->affected_rows() > 0;

        return $result;
    }

    public function edit_grup($grup_id, $data)
    {
        $this->db->set($data);
        $this->db->where('grupId', $grup_id);
        $result = $this->db->update('grup');

        return $result;
    }

    public function hapus_grup($grup_id)
    {
        $this->db->where('grupId', $grup_id);
        $this->db->delete('grup');
        $result = $this->db->affected_rows() > 0;

        return $result;
    }

    public function tambah_grup_modul($data)
    {
        $this->db->insert('grup_modul', $data);
        $result = $this->db->affected_rows() > 0;

        return $result;
    }

    public function hapus_grup_modul($grup_id, $modul_id)
    {
        $this->db->where('grupmodulGrup', $grup_id);
        $this->db->where('grupmodulModul', $modul_id);
        $this->db->delete('grup_modul');
        $result = $this->db->affected_rows() > 0;

        return $result;
    }

    public function is_prodi_exists($prodi_id)
    {
        $this->db->where('prodiKode', $prodi_id);
        $result = $this->db->count_all_results('program_studi');

        return $result > 0;
    }

    public function tambah_grup_prodi($data)
    {
        $this->db->insert('grup_prodi', $data);
        $result = $this->db->affected_rows() > 0;

        return $result;
    }

    public function hapus_grup_prodi($grup_id, $prodi_id)
    {
        $this->db->where('grupprodiGrup', $grup_id);
        $this->db->where('grupprodiProdi', $prodi_id);
        $this->db->delete('grup_prodi');
        $result = $this->db->affected_rows() > 0;

        return $result;
    }
    

}