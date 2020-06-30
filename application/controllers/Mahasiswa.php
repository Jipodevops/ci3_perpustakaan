<?php 
    class Mahasiswa extends CI_Controller{
        public function __construct(){
            parent::__construct();

            if(empty($this->session->userdata('id_petugas'))) {
                redirect('login');
            }

            $this->load->model(array('mahasiswa_m', 'programstudi_model'));
        }

        public function index(){
            $grafikProdi = $this->mahasiswa_m->grafikProdi();
            $grafikFakultas = $this->mahasiswa_m->grafikFakultas();

            $data = array(
                'theme_page' => 'mahasiswa/mahasiswa',
                'judul' => 'Mahasiswa',
                'grafikProdi' => $grafikProdi,
                'grafikFakultas' => $grafikFakultas
            );

            $this->load->view('theme/index', $data);
        }

        //fungsi menampilkan data dalam bentuk json
	public function datatables() {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        //sleep(3000);

        //memanggil fungsi model datatables
        $list = $this->mahasiswa_m->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field['NIM'];
            $row[] = $field['nama'];
            $row[] = $field['jenis_kelamin'];
            $row[] = $field['alamat'];
            $row[] = $field['no_telepon'];
            $row[] = $field['agama'];
            $row[] = $field['nama_prodi'];
            $row[] = $field['status_mahasiswa'];
            $row[] = '<a href="'.site_url('mahasiswa/update/'.$field['NIM']).'" class="btn btn-warning btn-circle">
            <i class="fas fa-edit"></i>
            </a>
            <a href="'.site_url('mahasiswa/delete/'.$field['NIM']).'" onclick="return confirm("Apakah anda yakin akan menghapus data ini?")" class="btn btn-danger btn-circle">
            <i class="fas fa-trash"></i>
            </a>';

            $data[] = $row;
        }
    
        //mengirim data json
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->mahasiswa_m->count_all(),
            "recordsFiltered" => $this->mahasiswa_m->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

        public function insert(){
            $data_prodi = $this->programstudi_model->read();

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

            $data_prodi = $this->programstudi_model->read();

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

        public function export_all(){
            $data_mahasiswa = $this->mahasiswa_m->export_all();
            
            //load library excel
            $this->load->library('excel');
            $excel = $this->excel;
    
            //judul sheet excel
            $excel->setActiveSheetIndex(0)->setTitle('Export Data');
    
            //header table
            $excel->getActiveSheet()->setCellValue( 'A1', 'NIM');
            $excel->getActiveSheet()->setCellValue( 'B1', 'Nama');
            $excel->getActiveSheet()->setCellValue( 'C1', 'Jenis Kelamin');
            $excel->getActiveSheet()->setCellValue( 'D1', 'Alamat');
            $excel->getActiveSheet()->setCellValue( 'E1', 'Nomor HP');
            $excel->getActiveSheet()->setCellValue( 'F1', 'Agama');
            $excel->getActiveSheet()->setCellValue( 'G1', 'Status');
            $excel->getActiveSheet()->setCellValue( 'H1', 'Program Studi');
            $excel->getActiveSheet()->setCellValue( 'I1', 'Fakultas');
    
            //baris awal data dimulai baris 2 (baris 1 digunakan header)
            $baris = 2;
    
            foreach($data_mahasiswa as $data) {
    
                //mengisi data ke excel per baris
                $excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['NIM']);
                $excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['nama']);
                $excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['jenis_kelamin']);
                $excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['alamat']);
                $excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['no_telepon']);
                $excel->getActiveSheet()->setCellValue( 'F'.$baris, $data['agama']);
                $excel->getActiveSheet()->setCellValue( 'G'.$baris, $data['status_mahasiswa']);
                $excel->getActiveSheet()->setCellValue( 'H'.$baris, $data['nama_prodi']);
                $excel->getActiveSheet()->setCellValue( 'I'.$baris, $data['nama_fakultas']);
    
    
                //increment baris untuk data selanjutnya
                $baris++;
            }
    
            //nama file excel
            $filename='export_mahasiswa.xls';
    
            //konfigurasi file excel
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            $objWriter->save('php://output');
        }
    }