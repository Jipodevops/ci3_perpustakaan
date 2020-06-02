<?php

class DetailPeminjaman_model extends CI_Model{
    
    public function insert($data){
        return $this->db->insert('detail_peminjaman', $data);
    }

    public function read(){
        $this->db->select('*');
        $this->db->from('detail_peminjaman');

        return $this->db->get()->result_array();
    }

    public function rowRead($id){
        $this->db->select('*');
        $this->db->from('detail_peminjaman');
        $this->db->join('buku', 'detail_peminjaman.id_buku = buku.id_buku');
        $this->db->where('kode_peminjaman', $id);
        return $this->db->get()->result_array();
    }
}