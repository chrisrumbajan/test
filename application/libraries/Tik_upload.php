<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tik_upload
{

    public $status;
    public $error_message;
    public $upload_data;

    private $_name;
    private $_config;

    public function __construct($name, $config)
    {
        $this->CI =& get_instance();

        $this->_name = $name;
        $this->_config = $config;

        if ( ! isset($this->_config['create_folder'])) {
            $this->_config['create_folder'] = FALSE;
        }

        if ( ! isset($this->_config['folder_permission'])) {
            $this->_config['folder_permission'] = 0775;
        }
    }

    public function set_file_name($file_name)
    {
        $this->_config['file_name'] = $file_name;
    }

    public function set_old_file_name($old_file_name)
    {
        $this->_config['old_file_name'] = $old_file_name;
    }

    public function upload()
    {
        // cek jika variable global $_FILES exists
        if ( ! isset($_FILES[$this->_name]['name'])) {
            $this->status = FALSE;
            $this->error_message = 'Tidak ada file yang diupload';
            return $this;
        }

        // cek jika upload path exists
        if ( ! file_exists($this->_config['upload_path'])) {
            // jika config create folder TRUE, maka buat folder
            if ($this->_config['create_folder'] == TRUE) {
                if ( ! mkdir($this->_config['upload_path'], $this->_config['folder_permission'])) {
                    $this->status = FALSE;
                    $this->error_message = 'Gagal buat folder baru';
                    return $this;
                }
            } else {
                $this->status = FALSE;
                $this->error_message = 'Folder untuk upload tidak ditemukan';
                return $this;
            }
        }

        // cek jika upload path writable
        if ( ! is_writable($this->_config['upload_path'])) {
            $this->status = FALSE;
            $this->error_message = 'Folder untuk upload tidak writable';
            return $this;
        }
        
        // lakukan upload file
        $this->CI->load->library('upload');
        $this->CI->upload->initialize($this->_config);
        if ( ! $this->CI->upload->do_upload($this->_name)) {
            $this->status = FALSE;
            $this->error_message = $this->CI->upload->display_errors();
            return $this;
        }
        $this->status = TRUE;
        $this->upload_data = $this->CI->upload->data();

        // hapus file lama jika disertakan
        if (isset($this->_config['old_file_name'])) {
            $fullpath_old_file = $this->_config['upload_path'] . $this->_config['old_file_name'];

            unlink($fullpath_old_file);
        }

        return $this;
    }

    public function batal_upload()
    {
        if (isset($this->upload_data['full_path'])) {
            if (file_exists($this->upload_data['full_path'])) {
                unlink($this->upload_data['full_path']);
            }
        }
    }

}