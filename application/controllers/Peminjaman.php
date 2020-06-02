<?php 
    class Peminjaman extends CI_Controller{
        public function __construct(){
            parent::__construct();

            $this->load->model(array('peminjaman_model', 'mahasiswa_m', 'buku_model', 'tmp_model', 'detailpeminjaman_model'));
        }

        public function index(){

            $data_peminjaman = $this->peminjaman_model->read();

            $data = array(
                'theme_page' => 'peminjaman/read_peminjaman',
                'judul' => 'Peminjaman',
                'data_peminjaman' => $data_peminjaman
            );

            $this->load->view('theme/index', $data);
        }

       

        public function insert(){
            $tglpinjam = date('Y-m-d');
            $noUrut = $this->peminjaman_model->Auto_PK();
            $data_mahasiswa = $this->mahasiswa_m->read();

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
            $kd_peminjaman = $this->input->post('kd_peminjaman');
            $tgl_peminjaman = $this->input->post('tgl_peminjaman');
            $jatuh_tempo = $this->input->post('jatuh_tempo');
            $nim = $this->input->post('nim');

            $data = array(
                'kode_peminjaman' => $kd_peminjaman,
                'tanggal_pinjam' => $tgl_peminjaman,
                'jatuh_tempo' => $jatuh_tempo,
                'NIM' => $nim
            );
            $this->peminjaman_model->insert($data);

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
    }