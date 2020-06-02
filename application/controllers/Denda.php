<?php 
    class Denda extends CI_Controller{
        public function __construct(){
            parent::__construct();

            $this->load->model(array('denda_model'));
        }

        public function index(){
            $this->read();
        }

        private function read(){
            $data_denda = $this->denda_model->read();
            $data = array(
                'theme_page' => 'denda/read_denda',
                'judul' => 'Denda',
                'data_denda' => $data_denda
            );

            $this->load->view('theme/index', $data);
        }

        public function insert(){
            $data = array(
                'theme_page' => 'denda/insert_denda',
                'judul' => 'Denda'
            );

            $this->load->view('theme/index', $data);
        }

        public function insert_submit(){
            $keterangan = $this->input->post('keterangan');
            $jum_denda = $this->input->post('jum_denda');

            $data = array(
                'keterangan' => $keterangan,
                'jumlah_denda' => $jum_denda,
            );

            $this->denda_model->insert($data);
            redirect('denda');
        }

        public function update(){
            $id = $this->uri->segment(3);
            $data_denda = $this->denda_model->rowRead($id);


            $data = array(
                'theme_page' => 'denda/update_denda',
                'judul' => 'Data Petugas',
                'data_denda' => $data_denda
            );
            $this->load->view('theme/index', $data);
        }

        public function update_submit(){
            $id = $this->uri->segment(3);

            $keterangan = $this->input->post('keterangan');
            $jum_denda = $this->input->post('jum_denda');

            $data = array(
                'keterangan' => $keterangan,
                'jumlah_denda' => $jum_denda,
            );

            $data_denda = $this->denda_model->update($data, $id);

            redirect('denda');
        }

        public function delete(){
            $id = $this->uri->segment(3);

            $data_petugas = $this->denda_model->delete($id);
            redirect('denda');
        }
    }