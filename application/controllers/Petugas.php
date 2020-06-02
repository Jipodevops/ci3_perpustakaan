<?php 
    class Petugas extends CI_Controller{
        public function __construct(){
            parent::__construct();

            $this->load->model(array('petugas_model'));
        }

        public function index(){
            $this->read();
        }

        private function read(){
            $data_petugas = $this->petugas_model->read();
            $data = array(
                'theme_page' => 'petugas/read_petugas',
                'judul' => 'Data Petugas',
                'data_petugas' => $data_petugas
            );

            $this->load->view('theme/index', $data);
        }

        public function insert(){
            $data = array(
                'theme_page' => 'petugas/insert_petugas',
                'judul' => 'Data Petugas'
            );

            $this->load->view('theme/index', $data);
        }

        public function insert_submit(){
            $nama = $this->input->post('nama');
            $jenkel = $this->input->post('jenkel');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');

            $data = array(
                'nama' => $nama,
                'jenis_kelamin' => $jenkel,
                'alamat' => $alamat,
                'no_telepon' => $no_hp
            );

            $this->petugas_model->insert($data);
            redirect('petugas');
        }

        public function update(){
            $id = $this->uri->segment(3);
            $data_petugas = $this->petugas_model->rowRead($id);


            $data = array(
                'theme_page' => 'petugas/update_petugas',
                'judul' => 'Data Petugas',
                'data_petugas' => $data_petugas
            );
            $this->load->view('theme/index', $data);
        }

        public function update_submit(){
            $id = $this->uri->segment(3);

            $nama = $this->input->post('nama');
            $jenkel = $this->input->post('jenkel');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');

            $data = array(
                'nama' => $nama,
                'jenis_kelamin' => $jenkel,
                'alamat' => $alamat,
                'no_telepon' => $no_hp
            );

            $data_mahasiswa = $this->petugas_model->update($data, $id);

            redirect('petugas');
        }

        public function delete(){
            $id = $this->uri->segment(3);

            $data_petugas = $this->petugas_model->delete($id);
            redirect('petugas');
        }
    }