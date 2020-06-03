<?php 
    class RakBuku extends CI_Controller{
        public function __construct(){
            parent::__construct();

            if(empty($this->session->userdata('id_petugas'))) {
                redirect('login');
            }

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
        public function export(){
            $id = $this->uri->segment(3);
            $data_rakbuku = $this->rakbuku_model->export($id);
                
                //load library excel
                $this->load->library('excel');
                $excel = $this->excel;
        
                //judul sheet excel
                $excel->setActiveSheetIndex(0)->setTitle('Export Data');
        
                //header table
                $excel->getActiveSheet()->setCellValue( 'A1', 'Kode Buku');
                $excel->getActiveSheet()->setCellValue( 'B1', 'Judul');
                $excel->getActiveSheet()->setCellValue( 'C1', 'Penulis');
                $excel->getActiveSheet()->setCellValue( 'D1', 'Penerbit');
                $excel->getActiveSheet()->setCellValue( 'E1', 'Tahun Terbit');
                $excel->getActiveSheet()->setCellValue( 'F1', 'Jumlah');
                $excel->getActiveSheet()->setCellValue( 'G1', 'Kategori');
                $excel->getActiveSheet()->setCellValue( 'H1', 'Rak Buku');
        
                //baris awal data dimulai baris 2 (baris 1 digunakan header)
                $baris = 2;
        
                foreach($data_rakbuku as $data) {
        
                    //mengisi data ke excel per baris
                    $excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['id_buku']);
                    $excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['judul']);
                    $excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['penulis']);
                    $excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['penerbit']);
                    $excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['tahun_terbit']);
                    $excel->getActiveSheet()->setCellValue( 'F'.$baris, $data['jumlah']);
                    $excel->getActiveSheet()->setCellValue( 'G'.$baris, $data['kategori_buku']);
                    $excel->getActiveSheet()->setCellValue( 'H'.$baris, $data['kode_rak'].' - '.$data['lokasi']);
        
        
                    //increment baris untuk data selanjutnya
                    $baris++;
                }
        
                //nama file excel
                $filename='export_data_buku_per_rakbuku.xls';
        
                //konfigurasi file excel
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                $objWriter->save('php://output');
        }
    }