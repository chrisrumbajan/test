<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_user extends Authenticated_Controller
{

    public function __construct() 
    {
        parent::__construct();

        $this->_authorize(['modul' => 'manajemen_user']);

        $this->load->model('Manajemen_user_model', 'manajemen_user');
    }

    public function user()
    {
        $this->_viewdata['user'] = $this->manajemen_user->get_user();
        $this->_viewdata['ref_grup'] = $this->manajemen_user->get_ref_grup();
        $this->_viewdata['js'] = 'manajemen_user/views/user.js';
        
        $this->twig->display('manajemen_user/views/user', $this->_viewdata);
    }

    public function grup()
    {
        $this->_viewdata['grup'] = $this->manajemen_user->get_grup();
        $this->_viewdata['ref_modul'] = $this->manajemen_user->get_ref_modul();
        $this->_viewdata['ref_prodi'] = $this->manajemen_user->get_ref_prodi();
        $this->_viewdata['js'] = 'manajemen_user/views/grup.js';
        
        $this->twig->display('manajemen_user/views/grup', $this->_viewdata);
    }

    public function tambah_user()
    {
        $this->_validate_tambah_user();

        $data = [
            'userUsername'  => $this->input->post('username'),
            'userDeskripsi' => $this->input->post('deskripsi'),
            'userPassword'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'userGrup'      => $this->input->post('grup'),
        ];

        if ($this->manajemen_user->tambah_user($data)) {
            echo json_encode(['status' => TRUE, 'message' => 'Berhasil tambah user']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Gagal tambah user']);
        }
    }

    public function edit_user()
    {
        $this->_validate_edit_user();

        $user_id = $this->input->post('id');
        $data = [
            'userUsername'  => $this->input->post('username'),
            'userDeskripsi' => $this->input->post('deskripsi'),
            'userGrup'      => $this->input->post('grup'),
        ];

        // set password jika dikirim oleh user
        if ( ! empty($this->input->post('password'))) {
            $data['userPassword'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        if ($this->manajemen_user->edit_user($user_id, $data)) {
            echo json_encode(['status' => TRUE, 'message' => 'Berhasil edit data user']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Gagal edit data user']);
        }
    }

    public function hapus_user()
    {
        $this->_validate_hapus_user();

        $user_id = $this->input->post('id');

        if ($this->manajemen_user->hapus_user($user_id)) {
            echo json_encode(['status' => TRUE, 'message' => 'Berhasil hapus data user']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Gagal hapus data user']);
        }
    }

    public function tambah_grup()
    {
        $this->_validate_tambah_grup();

        $data = [
            'grupNama'  => $this->input->post('nama'),
        ];

        if ($this->manajemen_user->tambah_grup($data)) {
            echo json_encode(['status' => TRUE, 'message' => 'Berhasil tambah grup']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Gagal tambah grup']);
        }
    }

    public function edit_grup()
    {
        $this->_validate_edit_grup();

        $grup_id = $this->input->post('id');
        $data = [
            'grupNama'  => $this->input->post('nama'),
        ];

        if ($this->manajemen_user->edit_grup($grup_id, $data)) {
            echo json_encode(['status' => TRUE, 'message' => 'Berhasil edit data grup']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Gagal edit data grup']);
        }
    }

    public function hapus_grup()
    {
        $this->_validate_hapus_grup();

        $grup_id = $this->input->post('id');

        if ($this->manajemen_user->hapus_grup($grup_id)) {
            echo json_encode(['status' => TRUE, 'message' => 'Berhasil hapus data grup']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Gagal hapus data grup']);
        }
    }

    public function tambah_grup_modul()
    {
        $this->_validate_tambah_grup_modul();

        $data = [
            'grupmodulGrup'     => $this->input->post('grup'),
            'grupmodulModul'    => $this->input->post('modul')
        ];

        if ($this->manajemen_user->tambah_grup_modul($data)) {
            echo json_encode(['status' => TRUE, 'message' => 'Berhasil tambah modul']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Gagal tambah modul']);
        }
    }

    public function hapus_grup_modul()
    {
        $this->_validate_hapus_grup_modul();

        $grup_id = $this->input->post('grup');
        $modul_id = $this->input->post('modul');

        if ($this->manajemen_user->hapus_grup_modul($grup_id, $modul_id)) {
            echo json_encode(['status' => TRUE, 'message' => 'Berhasil hapus modul']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Gagal hapus modul']);
        }
    }

    public function tambah_grup_prodi()
    {
        $this->_validate_tambah_grup_prodi();

        $data = [
            'grupprodiGrup'     => $this->input->post('grup'),
            'grupprodiProdi'    => $this->input->post('prodi')
        ];

        if ($this->manajemen_user->tambah_grup_prodi($data)) {
            echo json_encode(['status' => TRUE, 'message' => 'Berhasil tambah prodi']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Gagal tambah prodi']);
        }
    }

    public function hapus_grup_prodi()
    {
        $this->_validate_hapus_grup_prodi();

        $grup_id = $this->input->post('grup');
        $prodi_id = $this->input->post('prodi');

        if ($this->manajemen_user->hapus_grup_prodi($grup_id, $prodi_id)) {
            echo json_encode(['status' => TRUE, 'message' => 'Berhasil hapus prodi']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => 'Gagal hapus prodi']);
        }
    }


    /** FORM VALIDATION */

    private function _validate_tambah_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[50]', [
            'required'      => '%s required',
            'max_length'    => '%s maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|max_length[255]', [
            'max_length'    => '%s maksimal 255 karakter',
        ]);
        $this->form_validation->set_rules('grup', 'Grup', 'required|trim|is_natural_no_zero|callback_is_id_grup_exists', [
            'required'              => '%s required',
            'ís_natural_no_zero'    => 'Format %s salah',
            'is_id_grup_exists'     => '%s tidak ditemukan'
        ]);
        if ( ! empty($this->input->post('deskripsi'))) {
            $this->form_validation->set_rules('deskripsi', 'Deskipsi User', 'required|trim|max_length[100]', [
                'max_length'    => '%s maksimal 100 karakter'
            ]);
        }

        if ($this->form_validation->run() != TRUE) {
            echo json_encode(['status' => FALSE, 'message' => $this->form_validation->error_string()]);
            exit();
        }
    }

    private function _validate_edit_user()
    {
        $this->form_validation->set_rules('id', 'ID User', 'required|trim|callback_is_id_user_exists', [
            'required'          => '%s required',
            'is_id_user_exists' => '%s tidak ditemukan'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[50]', [
            'max_length'        => '%s maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules('grup', 'Grup', 'required|trim|is_natural_no_zero|callback_is_id_grup_exists', [
            'required'          => '%s required',
            'ís_natural_no_zero' => 'Format %s salah',
            'is_id_grup_exists'    => '%s tidak ditemukan'
        ]);
        if ( ! empty($this->input->post('deskripsi'))) {
            $this->form_validation->set_rules('deskripsi', 'Deskipsi User', 'required|trim|max_length[100]', [
                'max_length'    => '%s maksimal 100 karakter'
            ]);
        }

        if ($this->form_validation->run() != TRUE) {
            echo json_encode(['status' => FALSE, 'message' => $this->form_validation->error_string()]);
            exit();
        }
    }

    private function _validate_hapus_user()
    {
        $this->form_validation->set_rules('id', 'ID User', 'required|trim|callback_is_id_user_exists', [
            'required'          => '%s required',
            'is_id_user_exists' => '%s tidak ditemukan'
        ]);

        if ($this->form_validation->run() != TRUE) {
            echo json_encode(['status' => FALSE, 'message' => $this->form_validation->error_string()]);
            exit();
        }
    }

    private function _validate_tambah_grup()
    {
        $this->form_validation->set_rules('nama', 'Nama Grup', 'required|trim|max_length[100]', [
            'required'      => '%s required',
            'max_length'    => '%s maksimal 100 karakter'
        ]);

        if ($this->form_validation->run() != TRUE) {
            echo json_encode(['status' => FALSE, 'message' => $this->form_validation->error_string()]);
            exit();
        }
    }

    private function _validate_edit_grup()
    {
        $this->form_validation->set_rules('id', 'ID Grup', 'required|trim|callback_is_id_grup_exists', [
            'required'      => '%s required',
            'max_length'    => '%s maksimal 100 karakter',
            'is_id_grup_exists' => '%s tidak ditemukan'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Grup', 'required|trim|max_length[100]', [
            'required'      => '%s required',
            'max_length'    => '%s maksimal 100 karakter'
        ]);

        if ($this->form_validation->run() != TRUE) {
            echo json_encode(['status' => FALSE, 'message' => $this->form_validation->error_string()]);
            exit();
        }
    }

    private function _validate_hapus_grup()
    {
        $this->form_validation->set_rules('id', 'ID Grup', 'required|trim|callback_is_id_grup_exists', [
            'required'          => '%s required',
            'is_id_grup_exists' => '%s tidak ditemukan'
        ]);

        if ($this->form_validation->run() != TRUE) {
            echo json_encode(['status' => FALSE, 'message' => $this->form_validation->error_string()]);
            exit();
        }
    }

    private function _validate_tambah_grup_modul()
    {
        $this->form_validation->set_rules('grup', 'ID Grup', 'required|trim|callback_is_id_grup_exists', [
            'required'          => '%s required',
            'is_id_grup_exists' => '%s tidak ditemukan'
        ]);
        $this->form_validation->set_rules('modul', 'ID Modul', 'required|trim|callback_is_id_modul_exists', [
            'required'          => '%s required',
            'is_id_modul_exists' => '%s tidak ditemukan'
        ]);

        if ($this->form_validation->run() != TRUE) {
            echo json_encode(['status' => FALSE, 'message' => $this->form_validation->error_string()]);
            exit();
        }
    }

    private function _validate_hapus_grup_modul()
    {
        $this->form_validation->set_rules('grup', 'ID Grup', 'required|trim|callback_is_id_grup_exists', [
            'required'          => '%s required',
            'is_id_grup_exists' => '%s tidak ditemukan'
        ]);
        $this->form_validation->set_rules('modul', 'ID Modul', 'required|trim|callback_is_id_modul_exists', [
            'required'          => '%s required',
            'is_id_modul_exists' => '%s tidak ditemukan'
        ]);

        if ($this->form_validation->run() != TRUE) {
            echo json_encode(['status' => FALSE, 'message' => $this->form_validation->error_string()]);
            exit();
        }
    }

    private function _validate_tambah_grup_prodi()
    {
        $this->form_validation->set_rules('grup', 'ID Grup', 'required|trim|callback_is_id_grup_exists', [
            'required'          => '%s required',
            'is_id_grup_exists' => '%s tidak ditemukan'
        ]);
        $this->form_validation->set_rules('prodi', 'ID Prodi', 'required|trim|callback_is_id_prodi_exists', [
            'required'          => '%s required',
            'is_id_prodi_exists' => '%s tidak ditemukan'
        ]);

        if ($this->form_validation->run() != TRUE) {
            echo json_encode(['status' => FALSE, 'message' => $this->form_validation->error_string()]);
            exit();
        }
    }

    private function _validate_hapus_grup_prodi()
    {
        $this->form_validation->set_rules('grup', 'ID Grup', 'required|trim|callback_is_id_grup_exists', [
            'required'          => '%s required',
            'is_id_grup_exists' => '%s tidak ditemukan'
        ]);
        $this->form_validation->set_rules('prodi', 'ID Prodi', 'required|trim|callback_is_id_prodi_exists', [
            'required'          => '%s required',
            'is_id_prodi_exists' => '%s tidak ditemukan'
        ]);

        if ($this->form_validation->run() != TRUE) {
            echo json_encode(['status' => FALSE, 'message' => $this->form_validation->error_string()]);
            exit();
        }
    }

    public function is_id_user_exists($user_id)
    {
        return $this->manajemen_user->is_user_exists($user_id);
    }

    public function is_id_grup_exists($grup_id)
    {
        return $this->manajemen_user->is_grup_exists($grup_id);
    }

    public function is_id_modul_exists($modul_id)
    {
        return $this->manajemen_user->is_modul_exists($modul_id);
    }

    public function is_id_prodi_exists($prodi_id)
    {
        return $this->manajemen_user->is_prodi_exists($prodi_id);
    }

}