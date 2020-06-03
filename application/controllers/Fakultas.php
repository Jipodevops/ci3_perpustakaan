<?php

class Fakultas extends CI_Controller{
    
    public function __construct(){
        parent::__construct();

        if(empty($this->session->userdata('id_petugas'))) {
        	redirect('login');
		}

        $this->load->model(array('fakultas_model'));
    }

    public function index(){
        $this->read();
    }

    public function read(){
        $data_fakultas = $this->fakultas_model->read();
            $data = array(
                'theme_page' => 'fakultas/fakultas',
                'judul' => 'Fakultas',
                'data_fakultas' => $data_fakultas
            );

            $this->load->view('theme/index', $data);
    }

    public function insert(){
        $data_fakultas = $this->fakultas_model->read();

        $data = array(
            'theme_page' => 'fakultas/insert_fakultas',
            'judul' => 'Fakultas',
            'data_fakultas' => $data_fakultas
        );

        $this->load->view('theme/index', $data);
    }

    public function insert_submit(){
        $nama_fakultas = $this->input->post('nama_fakultas');

        $data = array(
            'nama_fakultas' => $nama_fakultas
           
        );
        $this->fakultas_model->insert($data);
        redirect('fakultas');
    }

    public function update(){
        $id = $this->uri->segment(3);

        $single_row = $this->fakultas_model->rowRead($id);

        $data = array(
            'judul' => 'Fakultas',
            'theme_page' => 'fakultas/update_fakultas',
            'single_row' => $single_row
        );

        $this->load->view('theme/index', $data);
        
    }

    public function insert_update(){
        $id = $this->uri->segment(3);

        $nama_fakultas = $this->input->post('nama_fakultas');

        $data = array(
            'nama_fakultas' => $nama_fakultas
           
        );
        $this->fakultas_model->update($data, $id);
        redirect('fakultas');
    }

    public function delete(){
        $id = $this->uri->segment(3);
        $this->fakultas_model->delete($id);

        redirect('fakultas');
    }

    public function export(){
        $data_fakultas = $this->fakultas_model->export_all();
            
            //load library excel
            $this->load->library('excel');
            $excel = $this->excel;
    
            //judul sheet excel
            $excel->setActiveSheetIndex(0)->setTitle('Export Data');
    
            //header table
            $excel->getActiveSheet()->setCellValue( 'A1', 'Kode Fakultas');
            $excel->getActiveSheet()->setCellValue( 'B1', 'Nama Fakultas');
            $excel->getActiveSheet()->setCellValue( 'C1', 'Nama Program Studi');
            $excel->getActiveSheet()->setCellValue( 'D1', 'NIM');
            $excel->getActiveSheet()->setCellValue( 'E1', 'Nama Mahasiswa');
    
            //baris awal data dimulai baris 2 (baris 1 digunakan header)
            $baris = 2;
    
            foreach($data_fakultas as $data) {
    
                //mengisi data ke excel per baris
                $excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['kode_fakultas']);
                $excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['nama_fakultas']);
                $excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['nama_prodi']);
                $excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['NIM']);
                $excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['nama']);
    
    
                //increment baris untuk data selanjutnya
                $baris++;
            }
    
            //nama file excel
            $filename='export_data_mahasiswa_fakultas.xls';
    
            //konfigurasi file excel
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            $objWriter->save('php://output');
    }
}