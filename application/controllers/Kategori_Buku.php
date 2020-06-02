<?php 
    class Kategori_Buku extends CI_Controller{
        public function __construct(){
            parent::__construct();

            if(empty($this->session->userdata('id_petugas'))) {
                redirect('login');
            }

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

        public function export_single(){
            $id = $this->uri->segment(3);
       
            $data_kategori = $this->kategoribuku_model->exportRow($id);
       
            //function read berfungsi mengambil/read data dari table provinsi di database
            //load library excel
            $this->load->library('excel');
            $excel = $this->excel;
    
            //judul sheet excel
            $excel->setActiveSheetIndex(0)->setTitle('Laporan Transaksi Peminjaman');
    
            //header table
            $excel->getActiveSheet()->setCellValue( 'A1', 'No.');
            $excel->getActiveSheet()->setCellValue( 'B1', 'Kategori Buku');
            $excel->getActiveSheet()->setCellValue( 'C1', 'Judul');
            $excel->getActiveSheet()->setCellValue( 'D1', 'Penulis');
            $excel->getActiveSheet()->setCellValue( 'E1', 'Penerbit');
            $excel->getActiveSheet()->setCellValue( 'F1', 'Tahun Terbit');
            $excel->getActiveSheet()->setCellValue( 'G1', 'Jumlah');
    
    
    
            //baris awal data dimulai baris 2 (baris 1 digunakan header)
            $baris = 2;
            $no = 1;
            foreach($data_kategori as $data) {
    
                //mengisi data ke excel per baris
                $excel->getActiveSheet()->setCellValue( 'A'.$baris, $no++);
                $excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['kategori_buku']);
                $excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['judul']);
                $excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['penulis']);
                $excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['penerbit']);
                $excel->getActiveSheet()->setCellValue( 'F'.$baris, $data['tahun_terbit']);
                $excel->getActiveSheet()->setCellValue( 'G'.$baris, $data['jumlah']);
    
    
                //increment baris untuk data selanjutnya
                $baris++;
            }
    
            //nama file excel
            $filename='laporan_buku_per_kategori.xls';
    
            //konfigurasi file excel
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            $objWriter->save('php://output');
       }

    }