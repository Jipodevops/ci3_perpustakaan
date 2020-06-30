<?php 
    class Denda extends CI_Controller{
        public function __construct(){
            parent::__construct();

            if(empty($this->session->userdata('id_petugas'))) {
                redirect('login');
            }

            $this->load->model(array('denda_model'));
        }

        public function index(){
            $this->read();
        }

        private function read(){
            $chart = $this->denda_model->chart();
            
            $data = array(
                'theme_page' => 'denda/read_denda',
                'judul' => 'Denda',
                'chart' => $chart
            );

            $this->load->view('theme/index', $data);
        }

        public function datatables() {
            //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
            //sleep(3000);
    
            //memanggil fungsi model datatables
            $list = $this->denda_model->get_datatables();
            $data = array();
            $no = $this->input->post('start');
    
            //mencetak data json
            foreach ($list as $field) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $field['kode_denda'];
                $row[] = $field['keterangan'];
                $row[] = $field['jumlah_denda'];
                $row[] = '<a href="'.site_url('denda/update/'.$field['kode_denda']).'" class="btn btn-warning btn-circle">
                <i class="fas fa-edit"></i>
                </a>
                <a href="'.site_url('denda/delete/'.$field['kode_denda']).'" class="btn btn-danger btn-circle">
                <i class="fas fa-trash"></i>
                </a>';
                $data[] = $row;
            }
        
            //mengirim data json
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->denda_model->count_all(),
                "recordsFiltered" => $this->denda_model->count_filtered(),
                "data" => $data,
            );
    
            //output dalam format JSON
            echo json_encode($output);
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