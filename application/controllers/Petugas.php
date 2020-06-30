<?php 
    class Petugas extends CI_Controller{
        public function __construct(){
            parent::__construct();

            if(empty($this->session->userdata('id_petugas'))) {
                redirect('login');
            }

            $this->load->model(array('petugas_model'));
        }

        public function index(){
            $this->read();
        }

        private function read(){
            $data = array(
                'theme_page' => 'petugas/read_petugas',
                'judul' => 'Data Petugas'
            );

            $this->load->view('theme/index', $data);
        }

        public function datatables() {
            //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
            //sleep(3000);
    
            //memanggil fungsi model datatables
            $list = $this->petugas_model->get_datatables();
            $data = array();
            $no = $this->input->post('start');
    
            //mencetak data json
            foreach ($list as $field) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $field['id_petugas'];
                $row[] = $field['nama'];
                $row[] = $field['username'];
                $row[] = $field['jenis_kelamin'];
                $row[] = $field['alamat'];
                $row[] = $field['no_telepon'];
                $row[] = '<a href="'.site_url('petugas/update/'.$field['id_petugas']).'" class="btn btn-warning btn-circle">
                <i class="fas fa-edit"></i>
                </a>
                <a href="'.site_url('petugas/delete/'.$field['id_petugas']).'" class="btn btn-danger btn-circle">
                <i class="fas fa-trash"></i>
                </a>';
                $data[] = $row;
            }
        
            //mengirim data json
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->petugas_model->count_all(),
                "recordsFiltered" => $this->petugas_model->count_filtered(),
                "data" => $data,
            );
    
            //output dalam format JSON
            echo json_encode($output);
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

            $username = $this->input->post('username');
            $psw = $this->input->post('psw');

            $pswenc = $this->encryption->encrypt($psw);

            $data = array(
                'nama' => $nama,
                'jenis_kelamin' => $jenkel,
                'alamat' => $alamat,
                'no_telepon' => $no_hp,
                'username' => $username,
                'psw' => $pswenc
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
            $username = $this->input->post('username');

            $data = array(
                'nama' => $nama,
                'jenis_kelamin' => $jenkel,
                'alamat' => $alamat,
                'no_telepon' => $no_hp,
                'username' => $username
            );

            $data_mahasiswa = $this->petugas_model->update($data, $id);

            redirect('petugas');
        }

        public function delete(){
            $id = $this->uri->segment(3);

            $data_petugas = $this->petugas_model->delete($id);
            redirect('petugas');
        }

        public function export_single(){
            $id = $this->uri->segment(3);
    
            $data_petugas = $this->petugas_model->read_export($id);
    
            //function read berfungsi mengambil/read data dari table provinsi di database
            //load library excel
            $this->load->library('excel');
            $excel = $this->excel;
    
            //judul sheet excel
            $excel->setActiveSheetIndex(0)->setTitle('Export Data');
    
            //header table
            $excel->getActiveSheet()->setCellValue( 'A1', 'Nama Petugas');
            $excel->getActiveSheet()->setCellValue( 'B1', 'Kode Peminjaman');
            $excel->getActiveSheet()->setCellValue( 'C1', 'Tanggal Transaksi');
            $excel->getActiveSheet()->setCellValue( 'D1', 'NIM');
            $excel->getActiveSheet()->setCellValue( 'E1', 'Nama Mahasiswa');
    
    
    
            //baris awal data dimulai baris 2 (baris 1 digunakan header)
            $baris = 2;
    
            foreach($data_petugas as $data) {
    
                //mengisi data ke excel per baris
                $excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['ptgs']);
                $excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['kode_peminjaman']);
                $excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['tanggal_pinjam']);
                $excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['NIM']);
                $excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['mhs']);
    
    
                //increment baris untuk data selanjutnya
                $baris++;
            }
    
            //nama file excel
            $filename='laporan_petugas.xls';
    
            //konfigurasi file excel
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            $objWriter->save('php://output');
    
        }
    }