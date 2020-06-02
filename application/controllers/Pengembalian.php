<?php

class Pengembalian extends CI_Controller{
    public function __construct(){
        parent::__construct();

    }

    public function index(){
        $this->read();
    }

    public function read(){

        $data = array(
            'judul' => 'Pengembalian',
            'theme_page' => 'pengembalian/read_pengembalian'
        );

        $this->load->view('theme/index', $data);
    }
}