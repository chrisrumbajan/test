<?php

defined('BASEPATH') OR exit('Direct access script is not allowed');

// Pagination Admin LTE 3
$config['pagination'] = [
    'first_link'       => FALSE,
    'last_link'        => FALSE,
    'full_tag_open'    => '<ul class="pagination pagination-sm m-0 float-right">',
    'full_tag_close'   => '</ul>',
    'next_link'        => '&raquo;',
    'cur_tag_open'     => '<li class="page-item active"><a class="page-link" href="#">',
    'cur_tag_close'    => '</a></li>',
    'num_tag_open'     => '<li class="page-item">',
    'num_tag_close'    => '</li>',
    'next_tag_open'    => '<li class="page-item">',
    'next_tag_close'   => '</li>',
    'prev_link'        => '&laquo;',
    'prev_tag_open'    => '<li class="page-item">',
    'prev_tag_close'   => '</li>',
    'attributes'       => ['class' => 'page-link']
    'page_query_string' => TRUE,
    'query_string_segment' => 'page'
];