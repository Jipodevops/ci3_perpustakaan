<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_m extends CI_Model {


	public function read() {
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->join('prodi', 'mahasiswa.kode_prodi = prodi.kode_prodi');

		$query = $this->db->get();
		return $query->result_array();
	}

	public function readRow($id){
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->join('prodi', 'mahasiswa.kode_prodi = prodi.kode_prodi');
		$this->db->where('NIM', $id);
		$query = $this->db->get();
		return $query->row_array();
	}


	public function insert($data) {
		return $this->db->insert('mahasiswa', $data);
	}

	public function update($input, $id) {
		$this->db->where('NIM', $id);

		return $this->db->update('mahasiswa', $input);
	}


	public function delete($id) {
		$this->db->where('NIM', $id);
		return $this->db->delete('mahasiswa');
	}
}
