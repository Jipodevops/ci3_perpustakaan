<?php 
    class Buku extends CI_Controller{
        public function __construct(){
            parent::__construct();

            $this->load->model(array('buku_model', 'kategoribuku_model', 'rakbuku_model'));
        }

        public function index(){
            $this->read();
        }

        public function read(){
            $data_buku = $this->buku_model->read();

            $data = array(
                'theme_page' => 'buku/read_buku',
                'judul' => 'Buku',
                'data_buku' => $data_buku
            );

            $this->load->view('theme/index', $data);
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
    
                    //mengembalikan halaman ke function read
                    redirect('buku');
                   }
               //kondisi bila tidak terdapat pada gambar
            }else{
                    $image_name=$this->input->post('old');
                    //mengembalikan halaman ke function read
                    redirect('buku');
            }

        }

        public function delete(){
            $id = $this->uri->segment(3);

            $data_kota = $this->buku_model->delete($id);
            redirect('buku');
        }
    }