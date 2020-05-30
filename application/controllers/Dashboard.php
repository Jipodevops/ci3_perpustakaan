<?php 
    class Dashboard extends CI_Controller{
        public function __construct(){
            parent::__construct();
        }

        public function index(){
            $data = array(
                'theme_page' => 'dashboard',
                'judul' => 'Halaman Utama'
            );

            $this->load->view('theme/index', $data);
        }
    }