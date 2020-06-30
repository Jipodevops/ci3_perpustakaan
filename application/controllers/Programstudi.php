<?php 
    class Programstudi extends CI_Controller{
        public function __construct(){
            parent::__construct();

            if(empty($this->session->userdata('id_petugas'))) {
                redirect('login');
            }

            $this->load->model(array('programstudi_model', 'fakultas_model'));
        }

        public function index() {
            
            $data = array(
                'theme_page' => 'programstudi/programstudi',
                'judul' => 'Program Studi',
            );      

            $this->load->view('theme/index', $data);
        }

        public function datatables() {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        //sleep(3000);

        //memanggil fungsi model datatables
        $list = $this->programstudi_model->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field['kode_prodi'];
            $row[] = $field['nama_prodi'];
            $row[] = $field['nama_fakultas'];
            $row[] = '<a href="'.site_url('programstudi/update/'.$field['kode_prodi']).'" class="btn btn-warning btn-circle">
            <i class="fas fa-edit"></i>
            </a>
            <a href="'.site_url('programstudi/delete/'.$field['kode_prodi']).'" onclick="return confirm("Apakah anda yakin akan menghapus data ini?")" class="btn btn-danger btn-circle">
            <i class="fas fa-trash"></i>
            </a>
            <a href="'.site_url('programstudi/export/'.$field['kode_prodi']).'" class="btn btn-success btn-circle">
            <i class="fas fa-download"></i>
            </a>
            ';

            $data[] = $row;
        }
    
        //mengirim data json
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->programstudi_model->count_all(),
            "recordsFiltered" => $this->programstudi_model->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
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

        public function export() {
            //function read berfungsi mengambil/read data dari table provinsi di database
            $id = $this->uri->segment(3);
    
            $data_prodi = $this->programstudi_model->read_mahasiswa($id);
            
            //load library excel
            $this->load->library('excel');
            $excel = $this->excel;
    
            //judul sheet excel
            $excel->setActiveSheetIndex(0)->setTitle('Export Data');
    
            //header table
            $excel->getActiveSheet()->setCellValue( 'A1', 'Kode Prodi');
            $excel->getActiveSheet()->setCellValue( 'B1', 'Nama Prodi');
            $excel->getActiveSheet()->setCellValue( 'C1', 'NIM');
            $excel->getActiveSheet()->setCellValue( 'D1', 'Nama');
    
            //baris awal data dimulai baris 2 (baris 1 digunakan header)
            $baris = 2;
    
            foreach($data_prodi as $data) {
    
                //mengisi data ke excel per baris
                $excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['kode_prodi']);
                $excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['nama_prodi']);
                $excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['NIM']);
                $excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['nama']);
    
    
                //increment baris untuk data selanjutnya
                $baris++;
            }
    
            //nama file excel
            $filename='export_mahasiswa_per_prodi.xls';
    
            //konfigurasi file excel
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            $objWriter->save('php://output');
        }
    }