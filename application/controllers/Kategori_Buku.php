<?php 
    class Kategori_Buku extends CI_Controller{
        public function __construct(){
            parent::__construct();

            $this->load->model(array('kategoribuku_model'));
        }

        public function index(){
            $this->read();
        }

        private function read(){
            $data_kategori = $this->kategoribuku_model->read();
            $data = array(
                'theme_page' => 'kategori_buku/read_kategori',
                'judul' => 'Kategori buku',
                'data_kategori' => $data_kategori
            );

            $this->load->view('theme/index', $data);
        }

        public function insert(){
            $data = array(
                'theme_page' => 'kategori_buku/insert_kategori',
                'judul' => 'Kategori Buku'
            );

            $this->load->view('theme/index', $data);
        }

        public function insert_submit(){
            $kategori = $this->input->post('kategori');
        
            $data = array(
                'kategori_buku' => $kategori
            );
            $this->kategoribuku_model->insert($data);
            redirect('kategori_buku');
        }

        public function update(){
            $id = $this->uri->segment(3);
            $data_kategori = $this->kategoribuku_model->rowRead($id);


            $data = array(
                'theme_page' => 'kategori_buku/update_kategori',
                'judul' => 'Kategori Buku',
                'data_kategori' => $data_kategori
            );

            $this->load->view('theme/index', $data);
        }

        public function update_submit(){
            $id = $this->uri->segment(3);

            $kategori = $this->input->post('kategori');
           

            $data = array('kategori_buku' => $kategori );

            $data_mahasiswa = $this->kategoribuku_model->update($data, $id);

            redirect('kategori_buku');
        }

        public function delete(){
            $id = $this->uri->segment(3);

            $data_rakbuku = $this->kategoribuku_model->delete($id);
            redirect('kategori_buku');
        }
    }