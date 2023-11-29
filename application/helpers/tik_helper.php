<?php

/**
 * Untuk debugging variable dengan tag <pre>
 * 
 * @param   p   variabel
 */
if (!function_exists('pre')) {
    function pre($p)
    {
        echo "<pre>";
        print_r($p);
        exit();
    }
}

/**
 * Generate alert style
 * 
 * @param   type    tipe alert  ('berhasil', 'mengubah', 'menghapus', 'gagal')
 * @param   text    pesan alert
 */
if (!function_exists('alert')) {
    function alert($type, $text)
    {
        $style = '';

        switch ($type) {
            case 'berhasil':
                $style = "
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fas fa-check'></i> " . $text . "</h5>
                    </div>
                    ";
                break;
            case 'peringatan':
                $style = "
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fas fa-exclamation-triangle'></i> " . $text . "</h5>
                    </div>
                    ";
                break;
            case 'gagal':
                $style = "
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fas fa-ban'></i> " . $text . "</h5>
                    </div>
                    ";
                break;
        }

        return $style;
    }
}

/**
 * Genereate arrow back
 * 
 * @param   path    url arrow back
 */
if (!function_exists('arrow_back')) {
    function arrow_back($path)
    {
        return '
                <a href="' . base_url() . $path . '">
                    <button class="btn btn-sm btn-flat bg-navy" title="kembali"><i class="fa fa-arrow-left"></i></button>
                </a>&nbsp;
            ';
    }
}

/**
 * Translasi mysql datetime format
 * 
 * @param   datetime    mysql datetime format
 */
if (!function_exists('indonesian_date')) {
    function indonesian_date($datetime)
    {
        $datetime = explode(' ', $datetime);

        $date = (isset($datetime[0])) ? $datetime[0] : NULL;
        $time = (isset($datetime[1])) ? $datetime[1] : NULL;

        // konversi bulan
        $date = explode('-', $date);
        $indonesian_date = $date[2];

        switch ($date[1]) {
            case '01':
                $indonesian_date .= ' Januari ';
                break;
            case '02':
                $indonesian_date .= ' Februari ';
                break;
            case '03':
                $indonesian_date .= ' Maret ';
                break;
            case '04':
                $indonesian_date .= ' April ';
                break;
            case '05':
                $indonesian_date .= ' Mei ';
                break;
            case '06':
                $indonesian_date .= ' Juni ';
                break;
            case '07':
                $indonesian_date .= ' Juli ';
                break;
            case '08':
                $indonesian_date .= ' Agustus ';
                break;
            case '09':
                $indonesian_date .= ' September ';
                break;
            case '10':
                $indonesian_date .= ' Oktober ';
                break;
            case '11':
                $indonesian_date .= ' November ';
                break;
            case '12':
                $indonesian_date .= ' Desember ';
                break;
        }

        $indonesian_date .= $date[0];

        if ($time) {
            $indonesian_date .= ' ' . $time;
        }

        return $indonesian_date;
    }
}

/**
 * Lihat file berdasarkan path file
 * 
 * @param   string      $path       path file (tidak sampai ke file, hanya folder saja)
 * @param   string      $filename   nama file yang ingin dilihat
 * @param   boolean     $download   TRUE jika download file, FALSE jika hanya preview
 */
if ( ! function_exists('lihat_file')) {
    function lihat_file($path, $filename, $download = FALSE)
    {
        $full_path = $path . $filename;
        $mime = mime_content_type($full_path);

        $content_disposition = $download ? 'attachment' : 'inline';

        header('Content-type: ' . $mime);
        header('Content-Disposition: ' . $content_disposition . '; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($full_path));
        header('Accept-Ranges: bytes');

        @readfile($full_path);
    }
}

/**
 * Lihat file berdasarkan URL
 * 
 * @param   string      $url        url lengkap file
 * @param   boolean     $download   TRUE jika download file, FALSE jika hanya preview
 */
if  ( ! function_exists('lihat_file_url')) {
    function lihat_file_url($url, $download = FALSE) 
    {
        $mime = get_headers($url, 1)["Content-Type"];
        $content_disposition = $download ? 'attachment' : 'inline';

        header('Content-type: ' . $mime);
        header('Content-Disposition: ' . $content_disposition);
        
        echo file_get_contents($url);
    }
}

if (!function_exists('default_date')) {
    function default_date($raw_date)
    {
        $raw_date = strtotime($raw_date);
        $formatted_date = date('Y-m-d', $raw_date);

        return $formatted_date;
    }
}

if (!function_exists('default_datetime')) {
    function default_datetime($raw_date)
    {
        $raw_date = strtotime($raw_date);
        $formatted_date = date('Y-m-d H:i:s', $raw_date);

        return $formatted_date;
    }
}

if (!function_exists('rupiah_to_number')) {
    function rupiah_to_number($rupiah)
    {
        return preg_replace("/[^0-9]/", "", $rupiah);
    }
}

if (!function_exists('number_to_rupiah')) {
    function number_to_rupiah($number, $decimal_place = 0)
    {
        $rupiah = 'Rp ' . number_format($number, $decimal_place);

        return $rupiah;
    }
}

/**
 * Generate random string
 * 
 * @param   chars   karakter yang diinginkan untuk muncul
 * @param   length  panjang random string yang diinginkan
 */
if (!function_exists('random_string')) {
    function random_string($chars, $length)
    {
        return substr(str_shuffle(str_repeat($chars, $length)), 0, $length);
    }
}
