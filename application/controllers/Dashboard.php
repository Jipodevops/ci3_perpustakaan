<?php 
    class Dashboard extends CI_Controller{
        public function __construct(){
            parent::__construct();

            if(empty($this->session->userdata('id_petugas'))) {
                redirect('login');
            }

            $this->load->model(array('dashboard_model'));
        }

        public function index(){
            $jumlahMahasiswa = $this->dashboard_model->countMahasiswa();
            $jumlahPeminjaman = $this->dashboard_model->countPeminjaman();
            $jumlahBuku = $this->dashboard_model->countBuku();
            $jumlahBelDikembalikan = $this->dashboard_model->countBelumDikembalikan();

            $grafikBuku = $this->dashboard_model->grafikBook();
            $grafikPerBook = $this->dashboard_model->grafikPerBook();
            $grafikPinjamPerProdi = $this->dashboard_model->grafikPeminjamanperProdi();
            $grafikPeminjamanperTanggal = $this->dashboard_model->grafikPeminjamanperTanggal();

            $data = array(
                'theme_page' => 'dashboard',
                'judul' => 'Halaman Utama',
                'jumMahasiswa' => $jumlahMahasiswa,
                'jumPeminjaman' => $jumlahPeminjaman,
                'jumBuku' => $jumlahBuku,
                'jumBelDikembalikan' => $jumlahBelDikembalikan,
                'grafikBuku' => $grafikBuku,
                'grafikPerBook' => $grafikPerBook,
                'grafikPinjamPerProdi' => $grafikPinjamPerProdi,
                'grafikPeminjamanperTanggal' => $grafikPeminjamanperTanggal
            );

            $this->load->view('theme/index', $data);
        }
    }