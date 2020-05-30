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


	public function insert($data) {
		//$input = data yang dikirim dari controller
		return $this->db->insert('mahasiswa', $data);
	}

	public function update($input, $id) {
	
	}


	public function delete($id) {
		
	}
}
