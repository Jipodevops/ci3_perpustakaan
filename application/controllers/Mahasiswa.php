<?php 
    class Mahasiswa extends CI_Controller{
        public function __construct(){
            parent::__construct();

            $this->load->model(array('mahasiswa_m', 'prodi_model'));
        }

        public function index(){
            $data_mahasiswa = $this->mahasiswa_m->read();
            $data = array(
                'theme_page' => 'mahasiswa/mahasiswa',
                'judul' => 'Mahasiswa',
                'data_mahasiswa' => $data_mahasiswa
            );

            $this->load->view('theme/index', $data);
        }

        public function insert(){
            $data_prodi = $this->prodi_model->read();

            $data = array(
                'theme_page' => 'mahasiswa/insert_mahasiswa',
                'judul' => 'Mahasiswa',
                'data_prodi' => $data_prodi
            );

            $this->load->view('theme/index', $data);
        }

        public function insert_submit(){
            $nim = $this->input->post('nim');
            $nama = $this->input->post('nama');
            $jenkel = $this->input->post('jenkel');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');
            $agama = $this->input->post('agama');
            $status_mhs = $this->input->post('status_mhs');
            $prodi = $this->input->post('prodi');

            $data = array(
                'NIM' => $nim,
                'nama' => $nama,
                'jenis_kelamin' => $jenkel,
                'alamat' => $alamat,
                'no_telepon' => $no_hp,
                'agama' => $agama,
                'status_mahasiswa' => $status_mhs,
                'kode_prodi' => $prodi
            );
            $this->mahasiswa_m->insert($data);
            redirect('mahasiswa');
        }

        public function update(){
            $id = $this->uri->segment(3);
            $data_mahasiswa = $this->mahasiswa_m->readRow($id);

            $data_prodi = $this->prodi_model->read();

            $data = array(
                'theme_page' => 'mahasiswa/update_mahasiswa',
                'judul' => 'Mahasiswa',
                'data_mahasiswa' => $data_mahasiswa,
                'data_prodi' => $data_prodi
            );

            $this->load->view('theme/index', $data);
        }

        public function update_submit(){
            $id = $this->uri->segment(3);

            $nama = $this->input->post('nama');
            $jenkel = $this->input->post('jenkel');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');
            $agama = $this->input->post('agama');
            $status_mhs = $this->input->post('status_mhs');
            $prodi = $this->input->post('prodi');

            $data = array('nama' => $nama,
                          'jenis_kelamin' => $jenkel,
                          'alamat' => $alamat,
                          'no_telepon' => $no_hp,
                          'agama' => $agama,
                          'status_mahasiswa' => $status_mhs,
                          'kode_prodi' => $prodi
            );

            $data_mahasiswa = $this->mahasiswa_m->update($data, $id);

            redirect('mahasiswa');
        }

        public function delete(){
            $id = $this->uri->segment(3);

            $data_kota = $this->mahasiswa_m->delete($id);
            redirect('mahasiswa');
        }
    }