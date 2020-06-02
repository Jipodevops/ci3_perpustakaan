<?php

class Detail_peminjaman extends CI_Controller{
    public function __construct(){
        parent::__construct();

        if(empty($this->session->userdata('id_petugas'))) {
        	redirect('login');
		}

        $this->load->model('detailpeminjaman_model');

    }

    public function index(){
        $this->read();
    }

    public function read(){
        $id = $this->uri->segment(3);

        $data_detail = $this->detailpeminjaman_model->rowRead($id);

        $data = array(
            'theme_page' => 'detail_peminjaman/read_det_peminjaman',
            'judul' => 'Detail Peminjaman',
            'data_detail' => $data_detail,
            'id' => $id
        );

        $this->load->view('theme/index', $data);
    }
}