<?php 
    class Buku extends CI_Controller{
        public function __construct(){
            parent::__construct();

            if(empty($this->session->userdata('id_petugas'))) {
                redirect('login');
            }

            $this->load->model(array('buku_model', 'kategoribuku_model', 'rakbuku_model'));
        }

        public function index(){
            $this->read();
        }

        public function read(){
            //$data_buku = $this->buku_model->read();

            $data = array(
                'theme_page' => 'buku/read_buku',
                'judul' => 'Buku',
                //'data_buku' => $data_buku
            );

            $this->load->view('theme/index', $data);
        }

        public function datatables() {
            //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
            //sleep(3000);
    
            //memanggil fungsi model datatables
            $list = $this->buku_model->get_datatables();
            $data = array();
            $no = $this->input->post('start');
    
            //mencetak data json
            foreach ($list as $field) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $field['id_buku'];
                $row[] = $field['judul'];
                $row[] = $field['penulis'];
                $row[] = $field['penerbit'];
                $row[] = $field['tahun_terbit'];
                $row[] = $field['jumlah'];
                $row[] = $field['kategori_buku'];
                $row[] = 'Rak '.$field['kode_rak'].' - '.$field['kategori'];
                $row[] = '<img height="50" alt="" class="zoom" src="'.site_url('../upload_folder/'.$field['foto_sampul']).'" style="width:50px;"> ';
                $row[] = '<a href="'.site_url('buku/update/'.$field['id_buku']).'" class="btn btn-warning btn-circle">
                <i class="fas fa-edit"></i>
                </a>
                <a href="'.site_url('buku/delete/'.$field['id_buku']).'" onclick="return confirm("Apakah anda yakin akan menghapus data ini?")" class="btn btn-danger btn-circle">
                <i class="fas fa-trash"></i>
                </a>';
    
                $data[] = $row;
            }
        
            //mengirim data json
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->buku_model->count_all(),
                "recordsFiltered" => $this->buku_model->count_filtered(),
                "data" => $data,
            );
    
            //output dalam format JSON
            echo json_encode($output);
        }

        public function insert(){
            $kat_buku = $this->kategoribuku_model->read();
            $rak_buku = $this->rakbuku_model->read();

            $data = array(
                'theme_page' => 'buku/insert_buku',
                'judul' => 'Buku',
                'kategori' => $kat_buku,
                'rak_buku' => $rak_buku
            );

            $this->load->view('theme/index', $data);
        }

        public function insert_submit(){
            $config['upload_path']          = './upload_folder/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 10000;
            $this->load->library('upload', $config);

            $judul = $this->input->post('judul');
            $penulis = $this->input->post('penulis');
            $penerbit = $this->input->post('penerbit');
            $dateTerbit = $this->input->post('dateTerbit');
            $jum_buku = $this->input->post('jum_buku');
            $kat_buku = $this->input->post('kat_buku');
            $rak_buku = $this->input->post('rak_buku');

            if (!$this->upload->do_upload('foto_sampul')) {
                //respon alasan kenapa gagal upload
                $response = $this->upload->display_errors();
                $output = array(
								'theme_page' => 'buku/insert_buku',
                				'judul' => 'Buku',
                                'response' => $response
                            );
                $this->load->view('theme/index', $output);

            //jika gagal berhasil
            } else {
                
                //respon upload berhasil 
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];

                //mengirim data ke model
				$data = array(
							//format : nama field/kolom table => data input dari view
                            'judul' => $judul,
                            'penulis' => $penulis,
                            'penerbit' => $penerbit,
                            'tahun_terbit' => $dateTerbit,
                            'jumlah' => $jum_buku,
                            'id_kategoribuku' => $kat_buku,
                            'kode_rak' => $rak_buku,
							'foto_sampul'=> $file_name
						);

				//memanggil function insert pada provinsi model
				//function insert berfungsi menyimpan/create data ke table provinsi di database
				$this->buku_model->insert($data);
				
				//mengembalikan halaman ke function read
				redirect('buku');

            }
        }

        public function update(){
            $id = $this->uri->segment(3);

            $data_buku = $this->buku_model->rowRead($id);
            $kat_buku = $this->kategoribuku_model->read();
            $rak_buku = $this->rakbuku_model->read();
            
            $data = array(
                'theme_page' => 'buku/update_buku',
                'judul' => 'Buku',
                'data_buku' => $data_buku,
                'kategori' => $kat_buku,
                'rak_buku' => $rak_buku
            );

            $this->load->view('theme/index', $data);
        }

        public function update_submit(){
            $id = $this->uri->segment(3);

            $judul = $this->input->post('judul');
            $penulis = $this->input->post('penulis');
            $penerbit = $this->input->post('penerbit');
            $dateTerbit = $this->input->post('dateTerbit');
            $jum_buku = $this->input->post('jum_buku');
            $kat_buku = $this->input->post('kat_buku');
            $rak_buku = $this->input->post('rak_buku');

            if($_FILES['foto_sampul']['name']!=""){
                //Aturan gambar yang bisa diupload 
                $config['upload_path'] = './upload_folder/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 10000;
    
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto_sampul')){
                    $response =  $this->upload->display_errors();
                    $output = array(
                                    'theme_page' => 'buku/update_buku',
                                    'judul' => 'Buku',
                                    'response' => $response
                                );
                    $this->load->view('theme/index', $output);
                }else{
                    $upload_data=$this->upload->data();
                    $image_name=$upload_data['file_name'];
                    $oldImg=$this->input->post('old');


    
                    //mengirim data ke model
                    $data = array(
                        //format : nama field/kolom table => data input dari view
                        'judul' => $judul,
                        'penulis' => $penulis,
                        'penerbit' => $penerbit,
                        'tahun_terbit' => $dateTerbit,
                        'jumlah' => $jum_buku,
                        'id_kategoribuku' => $kat_buku,
                        'kode_rak' => $rak_buku,
                        'foto_sampul'=> $image_name
                    );
    
                    //memanggil function insert pada buku model
                    //function insert berfungsi menyimpan/create data ke table buku di database
                    $data_buku = $this->buku_model->update($data, $id);
                    if ($data_buku) {
                        $oldImg=$this->input->post('old');
                        unlink('./upload_folder/'.$oldImg);
                    }
                    
    
                    //mengembalikan halaman ke function read
                    redirect('buku');
                   }
               //kondisi bila tidak terdapat pada gambar
            }

        }

        public function delete(){
            $id = $this->uri->segment(3);

            $data_buku = $this->buku_model->rowRead($id);
            
            $oldImg = $data_buku['foto_sampul'];
            unlink('./upload_folder/'.$oldImg);


            $data_kota = $this->buku_model->delete($id);
            redirect('buku');
        }

        public function export(){
            $data_buku = $this->buku_model->export_all();
                
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
        
                foreach($data_buku as $data) {
        
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
                $filename='export_semua_daftar_buku.xls';
        
                //konfigurasi file excel
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                $objWriter->save('php://output');
        }
    }