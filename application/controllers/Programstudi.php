<?php 
    class Programstudi extends CI_Controller{
        public function __construct(){
            parent::__construct();

            $this->load->model(array('programstudi_model', 'fakultas_model'));
        }

        public function index() {
            $data_prodi = $this->programstudi_model->read();
            
            $data = array(
                'theme_page' => 'programstudi/programstudi',
                'judul' => 'Program Studi',

                'data_prodi' => $data_prodi
            );      

            $this->load->view('theme/index', $data);
        }

        public function insert() {
            $data_fakultas = $this->fakultas_model->read();

            $data = array(
                'theme_page' => 'programstudi/insert_programstudi',
                'judul' => 'Tambah Program Studi',
                
                'data_fakultas' => $data_fakultas
            );

            $this->load->view('theme/index', $data);
        }

        public function insert_submit() {
            $nama_prodi = $this->input->post('nama_prodi');
            $kode_fakultas = $this->input->post('kode_fakultas');

            $data = array(
                'nama_prodi' => $nama_prodi,
                'kode_fakultas' => $kode_fakultas
            );
            $data_prodi = $this->programstudi_model->insert($data);
           
            redirect('programstudi/index');
        }

        public function update() {
            
            $id= $this->uri->segment(3);

            $data_prodi = $this->programstudi_model->read_single($id);
            $data_fakultas = $this->fakultas_model->read();
            
            $data = array(
                'theme_page' => 'programstudi/update_programstudi',
                'judul' => 'Ubah Program Studi',
                'data_fakultas' => $data_fakultas,
                'data_prodi' => $data_prodi
            );
    
            //memanggil file view
            $this->load->view('theme/index', $data);
        }

        public function update_submit() {

            $id = $this->uri->segment(3);
    
            $nama_prodi = $this->input->post('nama_prodi');
            $kode_fakultas = $this->input->post('kode_fakultas');
    
            $data = array(
                            'nama_prodi' => $nama_prodi,
                            'kode_fakultas' => $kode_fakultas
                        );

            $data_prodi = $this->programstudi_model->update($data, $id);
    
            redirect('programstudi/index');
        }

        public function delete() {

            $id = $this->uri->segment(3);

            $data_prodi = $this->programstudi_model->delete($id);

            redirect('programstudi');
        }
    }