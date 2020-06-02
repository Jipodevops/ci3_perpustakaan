<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_model extends CI_Model {


	public function read() {
		$this->db->select('*');
		$this->db->from('petugas');

		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function rowRead($id) {
		$this->db->select('*');
		$this->db->from('petugas');
        $this->db->where('id_petugas', $id);
		$query = $this->db->get();
		return $query->row_array();
	}


	public function insert($data) {
		return $this->db->insert('petugas', $data);
	}

	public function update($input, $id) {
		$this->db->where('id_petugas', $id);

		return $this->db->update('petugas', $input);
	}


	public function delete($id) {
		$this->db->where('id_petugas', $id);
		return $this->db->delete('petugas');
	}

	public function read_export($id){
		$this->db->select('petugas.*, peminjaman.*');
		$this->db->select('petugas.nama as ptgs');
		$this->db->select('mahasiswa.nama as mhs');
		$this->db->from('petugas');
		$this->db->join('peminjaman', 'petugas.id_petugas = peminjaman.id_petugas');
		$this->db->join('mahasiswa', 'peminjaman.NIM = mahasiswa.NIM');
		$this->db->where('petugas.id_petugas', $id);
		$this->db->order_by('peminjaman.kode_peminjaman');

		return $this->db->get()->result_array();
	}
}
