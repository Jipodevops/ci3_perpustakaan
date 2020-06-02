<?php

class Peminjaman_model extends CI_Model{

    public function read(){
        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('mahasiswa', 'peminjaman.NIM = mahasiswa.NIM');
        $this->db->order_by('peminjaman.kode_peminjaman ASC');
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

    public function update_status($table, $id){
        $this->db->where('kode_peminjaman', $id);

        return $this->db->update('peminjaman', $table);
    }
}