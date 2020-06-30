<?php 
    class Peminjaman extends CI_Controller{
        public function __construct(){
            parent::__construct();

            if(empty($this->session->userdata('id_petugas'))) {
                redirect('login');
            }

            $this->load->model(array('peminjaman_model', 'mahasiswa_m', 'buku_model', 'tmp_model', 'detailpeminjaman_model', 'pengembalian_model', 'notifikasi_model'));
        }

        public function index(){

            //$data_peminjaman = $this->peminjaman_model->read();

            $data = array(
                'theme_page' => 'peminjaman/read_peminjaman',
                'judul' => 'Peminjaman',
               // 'data_peminjaman' => $data_peminjaman
            );

            $this->load->view('theme/index', $data);
        }

        public function datatables() {
            //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
            //sleep(3000);
    
            //memanggil fungsi model datatables
            $list = $this->peminjaman_model->get_datatables();
            $data = array();
            $no = $this->input->post('start');
    
            //mencetak data json
            foreach ($list as $field) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $field['kode_peminjaman'];
                $row[] = $field['NIM'].' - '.$field['nama'];
                $row[] = date("l, d-m-Y", strtotime($field['tanggal_pinjam']));
                $row[] = date("l, d-m-Y", strtotime($field['jatuh_tempo']));
                if ($field['status'] == "N") {
                    $row[] ='
                            <div class="btn btn-warning btn-icon-split btn-sm">
                                <span class="icon text-white-40">
                                <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="text">Belum dikembalikan</span>
                            </div>
                    ';
                }else if($field['status'] == "Y"){
                    $row[] = '
                            <div class="btn btn-primary btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Sudah dikembalikan</span>
                            </div>
                    ';
                }
                $row[] = '<a href="'.site_url('detail_peminjaman/read/'.$field['kode_peminjaman']).'" class="btn btn-info btn-icon-split btn-sm">
                <span class="icon text-white-50">
                <i class="fas fa-search"></i>
                </span>
                </a>
                <a href="'.site_url('peminjaman/delete/'.$field['kode_peminjaman']).'" onclick="return confirm("Apakah anda yakin akan menghapus data ini?")" class="btn btn-danger btn-icon-split btn-sm">
                <span class="icon text-white-50">
                <i class="fas fa-trash"></i>
                </span>
                </a>';
    
                $data[] = $row;
            }
        
            //mengirim data json
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->peminjaman_model->count_all(),
                "recordsFiltered" => $this->peminjaman_model->count_filtered(),
                "data" => $data,
            );
    
            //output dalam format JSON
            echo json_encode($output);
        }

       

        public function insert(){
            $tglpinjam = date('Y-m-d');
            $noUrut = $this->peminjaman_model->Auto_PK();
            $status = $this->peminjaman_model->read();
            

            $data_mahasiswa = $this->mahasiswa_m->cekNIM();

            $data = array(
                'theme_page' => 'peminjaman/insert_peminjaman',
                'judul' => 'Transaksi Peminjaman',
                'noUrut' => $noUrut,
                'tglpinjam' => $tglpinjam,
                'tglkembali' => date('Y-m-d', strtotime('+4 day', strtotime($tglpinjam))),
                'data_mahasiswa' => $data_mahasiswa
            );

            $this->load->view('theme/index', $data);
        }

        public function insert_submit(){
            $petugas = $this->session->userdata('id_petugas');
            $kd_peminjaman = $this->input->post('kd_peminjaman');
            $tgl_peminjaman = $this->input->post('tgl_peminjaman');
            $jatuh_tempo = $this->input->post('jatuh_tempo');
            $nim = $this->input->post('nim');

            $data = array(
                'kode_peminjaman' => $kd_peminjaman,
                'tanggal_pinjam' => $tgl_peminjaman,
                'jatuh_tempo' => $jatuh_tempo,
                'NIM' => $nim,
                'id_petugas' => $petugas
            );
            $this->peminjaman_model->insert($data);

            $data1 = array(
                'NIM' => $nim,
                'kode_peminjaman' => $kd_peminjaman,
                'keterangan'=> 'Peminjaman dengan kode : '.$kd_peminjaman.'<br>Jatuh tempo peminjaman buku anda sampai tanggal '.$jatuh_tempo
            );

            $this->notifikasi_model->insert($data1);

        }

        public function delete(){
            $id = $this->uri->segment(3);

            $this->peminjaman_model->delete($id);
            $this->detailpeminjaman_model->delete($id);

            $this->pengembalian_model->delete($id);

            redirect('peminjaman');
        }

        //mencari nim untuk disesuaikan dengan form nama 
        public function search_nim(){
                $nim = $this->input->post('nim');
                $mhs = $this->mahasiswa_m->searchNIM($nim);


                echo $mhs['nama'];
        }

        public function cari_buku(){
            $data_buku = $this->buku_model->cariBuku();

            $data = array(
                'data_buku' => $data_buku
            );
            $this->load->view('peminjaman/searchbuku_peminjaman', $data);
        }

        public function insert_tmp(){
            $kode_buku = $this->input->post('kode_buku');
            $judul     = $this->input->post('judul');
            $pengarang = $this->input->post('pengarang');
            
            $checkTmp = $this->tmp_model->checkTmp($kode_buku);

            if($checkTmp < 1){
                $data = array(
                    'id_buku' => $kode_buku,
                    'judul' => $judul,
                    'pengarang' => $pengarang
                );
                $this->tmp_model->insert($data);
            }
           
            
        }

        public function read_tmp(){
            $data_tmp = $this->tmp_model->read();
            $count_tmp = $this->tmp_model->countTmp();

            $data = array(
                'data_tmp' => $data_tmp,
                'count_tmp' => $count_tmp
            );

            $this->load->view('peminjaman/readtmp_peminjaman', $data);
        }

        public function delete_tmp(){
            $kode_buku = $this->input->post('kode_buku');
            $this->tmp_model->delete($kode_buku);
        }

        public function insert_transaksi(){
            $data_tmp = $this->tmp_model->getTmp();
            $kd_peminjaman = $this->input->post('kd_peminjaman');

            foreach ($data_tmp as $data) {
                $buku = $data['id_buku'];
                
                $data = array(
                    'kode_peminjaman' => $kd_peminjaman,
                    'id_buku' => $data['id_buku']

                );
                //menyimpan data kedalam database detail peminjaman
                $this->detailpeminjaman_model->insert($data);

                //hapus otomatis jika data berhasil disimpan
                $this->tmp_model->delete($buku);
            }

            $status = array(
                'status' => "N"
            );

            $this->peminjaman_model->update_status($status, $kd_peminjaman);
        }

        public function export_all(){
            //$id = $this->uri->segment(3);
    
            $data_peminjaman = $this->peminjaman_model->export();
    
            //function read berfungsi mengambil/read data dari table provinsi di database
            //load library excel
            $this->load->library('excel');
            $excel = $this->excel;
    
            //judul sheet excel
            $excel->setActiveSheetIndex(0)->setTitle('Laporan Transaksi Peminjaman');
    
            //header table
            $excel->getActiveSheet()->setCellValue( 'A1', 'Kode Peminjaman');
            $excel->getActiveSheet()->setCellValue( 'B1', 'Tanggal Transaksi');
            $excel->getActiveSheet()->setCellValue( 'C1', 'NIM');
            $excel->getActiveSheet()->setCellValue( 'D1', 'Nama');
            $excel->getActiveSheet()->setCellValue( 'E1', 'Buku');
            $excel->getActiveSheet()->setCellValue( 'F1', 'Petugas');
    
    
    
            //baris awal data dimulai baris 2 (baris 1 digunakan header)
            $baris = 2;
    
            foreach($data_peminjaman as $data) {
    
                //mengisi data ke excel per baris
                $excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['kode_peminjaman']);
                $excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['tanggal_pinjam']);
                $excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['NIM']);
                $excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['mhs']);
                $excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['judul']);
                $excel->getActiveSheet()->setCellValue( 'F'.$baris, $data['ptgs']);
    
    
                //increment baris untuk data selanjutnya
                $baris++;
            }
    
            //nama file excel
            $filename='laporan_transaksi_peminjaman.xls';
    
            //konfigurasi file excel
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            $objWriter->save('php://output');
    
        }
    }