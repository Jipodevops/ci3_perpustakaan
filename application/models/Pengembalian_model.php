<?php

class Pengembalian_model extends CI_Model{
    
    public function read(){
        $this->db->select('*');
        $this->db->from('pengembalian');
        $this->db->join('peminjaman', 'pengembalian.kode_peminjaman = peminjaman.kode_peminjaman');
        $this->db->join('mahasiswa', 'pengembalian.NIM = mahasiswa.NIM');
        $this->db->order_by('pengembalian.tanggal_pengembalian');
        return $this->db->get()->result_array();
    }

    public function insert($data){
        return $this->db->insert('pengembalian', $data);
    }

    public function Auto_PK(){
        $today = date('ymd');

		$this->db->select_max('kode_pengemblian', 'last');
		$this->db->from('pengembalian');

        $data = $this->db->get()->row_array();
        $lastPeminjaman = $data['last'];
        $noUrut = substr($lastPeminjaman,8,3);
        $nextNoUrut = $noUrut+1;
        $NoTransaksi = $today.sprintf('%03s', $nextNoUrut);
        return $NoTransaksi;
    }

    public function searchKode($id){
        $this->db->select('*');
        $this->db->from('peminjaman', 'pengembalian');
        $this->db->join('mahasiswa', 'peminjaman.NIM = mahasiswa.NIM');
        $this->db->where('peminjaman.kode_peminjaman', $id);
        $this->db->where('peminjaman.kode_peminjaman NOT IN(SELECT kode_peminjaman FROM pengembalian)');

        return $this->db->get()->row_array();

    }

    public function kodePeminjaman(){
        $this->db->select('*');
        $this->db->from('peminjaman', 'pengembalian');
        $this->db->where('peminjaman.kode_peminjaman NOT IN(SELECT kode_peminjaman FROM pengembalian)');

        return $this->db->get()->result_array();

    }

    public function readBook($id){
        $this->db->select('*');
        $this->db->from('detail_peminjaman', 'pengembalian');
        $this->db->join('buku', 'detail_peminjaman.id_buku = buku.id_buku');
        $this->db->where('detail_peminjaman.kode_peminjaman', $id);
        $this->db->where('detail_peminjaman.kode_peminjaman NOT IN(SELECT kode_peminjaman FROM pengembalian)');

        return $this->db->get()->result_array();
    }

}