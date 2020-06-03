<?php

class Peminjaman_model extends CI_Model{

    public function read(){
        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('mahasiswa', 'peminjaman.NIM = mahasiswa.NIM');
        $this->db->order_by('peminjaman.tanggal_pinjam ASC');
        return $this->db->get()->result_array();
    }

    
    public function Auto_PK() {
        $today = date('ymd');

		$this->db->select_max('kode_peminjaman', 'last');
		$this->db->from('peminjaman');

        $data = $this->db->get()->row_array();
        $lastPeminjaman = $data['last'];
        $noUrut = substr($lastPeminjaman,8,3);
        $nextNoUrut = $noUrut+1;
        $NoTransaksi = $today.sprintf('%03s', $nextNoUrut);
        return $NoTransaksi;

    }

    public function insert($data){
        return $this->db->insert('peminjaman', $data);
    }

    public function delete($id){
        $this->db->where('kode_peminjaman', $id);
        return $this->db->delete('peminjaman');
    }

    public function rowRead($id){
        $this->db->where('kode_peminjaman', $id);
        return $this->db->get('peminjaman')->row_array();
    }

    public function update_status($table, $id){
        $this->db->where('kode_peminjaman', $id);

        return $this->db->update('peminjaman', $table);
    }

    public function export(){
        $this->db->select('peminjaman.*, petugas.nama as ptgs, mahasiswa.nama as mhs, buku.judul');
        $this->db->from('peminjaman');
        $this->db->join('mahasiswa', 'peminjaman.NIM = mahasiswa.NIM');
        $this->db->join('detail_peminjaman', 'peminjaman.kode_peminjaman = detail_peminjaman.kode_peminjaman');
        $this->db->join('petugas', 'peminjaman.id_petugas = petugas.id_petugas');
        $this->db->join('buku', 'detail_peminjaman.id_buku = buku.id_buku');
        $this->db->order_by('peminjaman.kode_peminjaman');

        return $this->db->get()->result_array();

    }
}