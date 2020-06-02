<?php 
    class RakBuku extends CI_Controller{
        public function __construct(){
            parent::__construct();

            $this->load->model(array('rakbuku_model'));
        }

        public function index(){
            $this->read();
        }

        private function read(){
            $data_rak = $this->rakbuku_model->read();
            $data = array(
                'theme_page' => 'rak_buku/read_rakbuku',
                'judul' => 'Rak Buku',
                'data_rak' => $data_rak
            );

            $this->load->view('theme/index', $data);
        }

        public function insert(){
            $data = array(
                'theme_page' => 'rak_buku/insert_rakbuku',
                'judul' => 'Rak Buku'
            );

            $this->load->view('theme/index', $data);
        }

        public function insert_submit(){
            $kategori = $this->input->post('kategori');
            $lokasi_rak = $this->input->post('lokasi_rak');

            $data = array(
                'kategori' => $kategori,
                'lokasi' => $lokasi_rak,
            );
            $this->rakbuku_model->insert($data);
            redirect('rakbuku');
        }

        public function update(){
            $id = $this->uri->segment(3);
            $data_rak = $this->rakbuku_model->rowRead($id);


            $data = array(
                'theme_page' => 'rak_buku/update_rakbuku',
                'judul' => 'Rak Buku',
                'data_rak' => $data_rak
            );

            $this->load->view('theme/index', $data);
        }

        public function update_submit(){
            $id = $this->uri->segment(3);

            $kategori = $this->input->post('kategori');
            $lokasi_rak = $this->input->post('lokasi_rak');
           

            $data = array('kategori' => $kategori,
                          'lokasi' => $lokasi_rak
            );

            $data_mahasiswa = $this->rakbuku_model->update($data, $id);

            redirect('rakbuku');
        }

        public function delete(){
            $id = $this->uri->segment(3);

            $data_rakbuku = $this->rakbuku_model->delete($id);
            redirect('rakbuku');
        }
    }