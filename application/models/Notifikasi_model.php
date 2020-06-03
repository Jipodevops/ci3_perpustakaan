<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model{
    
	public function insert($data1) {
		return $this->db->insert('notifikasi', $data1);
	}
	public function read() {
		$this->db->select('*');
		$this->db->from('notifikasi');
		$this->db->join('mahasiswa', 'notifikasi.NIM = mahasiswa.NIM');

		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function rowRead($id) {
		$this->db->select('*');
		$this->db->from('notifikasi');
        $this->db->where('id_notifikasi', $id);
		$query = $this->db->get();
		return $query->row_array();
	}


	

	public function update($input, $id) {
		$this->db->where('id_notifikasi', $id);

		return $this->db->update('notifikasi', $input);
	}


	public function delete($id) {
		$this->db->where('id_notifikasi', $id);
		return $this->db->delete('notifikasi');
	}

	public function delete_notifikasi($kode){
		$this->db->where('kode_peminjaman', $kode);
		return $this->db->delete('notifikasi');

	}
}