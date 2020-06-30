<?php

class Pengembalian extends CI_Controller{
    public function __construct(){
        parent::__construct();

        if(empty($this->session->userdata('id_petugas'))) {
        	redirect('login');
		}

        $this->load->model(array('pengembalian_model', 'peminjaman_model', 'denda_model', 'notifikasi_model'));
    }

    public function index(){
        $this->read();
    }

    public function read(){
 
        $data = array(
            'judul' => 'Pengembalian',
            'theme_page' => 'pengembalian/read_pengembalian',
        );

        $this->load->view('theme/index', $data);
    }

    public function datatables() {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        //sleep(3000);

        //memanggil fungsi model datatables
        $list = $this->pengembalian_model->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field['kode_pengemblian'];
            $row[] = date("l, d-m-Y", strtotime($field['tanggal_pinjam']));
            $row[] = $field['kode_peminjaman'];
            $row[] = $field['NIM'].' - '.$field['nama'];
            $row[] = date("l, d-m-Y", strtotime($field['tanggal_pengembalian']));
            $row[] = $field['keterangan'];
            $row[] = 'Rp.'.number_format($field['total_denda']);
            $data[] = $row;
        }
    
        //mengirim data json
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->pengembalian_model->count_all(),
            "recordsFiltered" => $this->pengembalian_model->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

    public function insert(){
        $tglkembali = date('Y-m-d');
        $noUrut = $this->pengembalian_model->Auto_PK();
        $data_peminjaman = $this->pengembalian_model->kodePeminjaman();
        $data_denda = $this->denda_model->read1();

        $data = array(
            'judul' => 'Pengembalian',
            'theme_page' => 'pengembalian/insert_pengembalian',
            'noUrut' => $noUrut,
            'tglkembali' => $tglkembali,
            'data_peminjaman' => $data_peminjaman,
            'data_denda' => $data_denda
        );

        $this->load->view('theme/index', $data);
    }

    public function insert_submit(){
        $petugas          = $this->session->userdata('id_petugas');
        $kd_pengembalian  = $this->input->post('kd_pengembalian');
        $kd_peminjaman    = $this->input->post('kd_peminjaman');
        $nim              = $this->input->post('nim');
        $tgl_pengembalian = $this->input->post('tgl_pengembalian');
        $denda            = $this->input->post('denda');
        //cek kode denda lainnya yang diinput dari view
        $kode_denda       = $this->input->post('denda1');
        $cekDenda         = $this->denda_model->rowRead($kode_denda);
        $denda1           = $cekDenda['jumlah_denda'];

        $tot_denda = $denda + $denda1;

        if ($denda != 0) {
            $this->session->set_flashdata('kode_denda', '1');
        }else if($kode_denda !=0){
            $this->session->set_flashdata('kode_denda', $kode_denda);
        }else if($denda == 0){
            $this->session->set_flashdata('kode_denda', '2');
        }

        $data = array(
            'kode_pengemblian' => $kd_pengembalian,
            'tanggal_pengembalian' => $tgl_pengembalian,
            'kode_peminjaman' => $kd_peminjaman,
            'NIM' => $nim,
            'total_denda' => $tot_denda,
            'kode_denda' =>$this->session->flashdata('kode_denda'),
            'id_petugas' => $petugas
        );

        $this->pengembalian_model->insert($data);

        $status = array(
            'status' => "Y"
        );

        $this->peminjaman_model->update_status($status, $kd_peminjaman);

        $this->notifikasi_model->delete_notifikasi($kd_peminjaman);
    }

    public function searchKodePeminjaman(){
        $kd_peminjaman = $this->input->post('kd_peminjaman');
        $cekKode = $this->pengembalian_model->searchKode($kd_peminjaman);
        echo $cekKode['tanggal_pinjam']."|".$cekKode['NIM']."|".$cekKode['nama'];
    }

    public function tampilBuku(){
        $kd_peminjaman = $this->input->get('kd_peminjaman');
        //$kd_peminjaman = "200601004";
        $data_buku = $this->pengembalian_model->readBook($kd_peminjaman);
        
        $data = array(
            'data_buku' => $data_buku
        );

        $this->load->view('pengembalian/read_buku_pengembalian', $data);
        
    }
    /*
    public function testDenda(){
        $tglpinjam = "2020-02-20";
        $tglbatas = "2020-02-24";
        $tglkembali = "2020-02-26";

        echo $tglbatas->diff($tglkembali);

        $subbatas = substr($tglbatas, 8, 2);
        $subkembali = substr($tglkembali, 8, 2);
            if ($subkembali > $subbatas) {
                $selisih = $subkembali - $subbatas;
                $denda = $selisih * 2000;
                echo $denda;
            }
        ;     
    }
*/

    public function hitungDenda(){
        $kd_peminjaman = $this->input->post('kd_peminjaman');
        $tgl_pengembalian = date('Y-m-d');

        //mengambil data dari peminjaman_model
        $data_peminjaman = $this->peminjaman_model->rowRead($kd_peminjaman);
        $tgl_jatuh = $data_peminjaman['jatuh_tempo'];

        $kodeDenda = "1";
        $cekDenda =  $this->denda_model->rowRead($kodeDenda);;
        //memecah string untuk mengambil tanggal jatuh tempo dan tanggal pengembalian
        $subbatas = substr($tgl_jatuh, 8, 2);
        $subkembali = substr($tgl_pengembalian, 8, 2);

        if($subkembali > $subbatas) {   
            $selisih = $subkembali - $subbatas;
            $nominaldenda = $selisih * $cekDenda['jumlah_denda'];
            echo $nominaldenda;
        }else{
            echo 0;
        }


    }
    
}