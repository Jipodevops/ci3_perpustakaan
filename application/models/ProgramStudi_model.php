<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProgramStudi_model extends CI_Model {


	public function read() {
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->join('fakultas', 'prodi.kode_fakultas = fakultas.kode_fakultas');
		
		$query = $this->db->get();

		return $query->result_array(); 
	}

	public function read_single($id) {

		$this->db->select('*');
		$this->db->from('prodi');

		$this->db->where('kode_prodi', $id);

		$query = $this->db->get();

        return $query->row_array();
	}

	public function insert($data) {
		//$input = data yang dikirim dari controller
		return $this->db->insert('prodi', $data);
	}

	public function update($input, $id) {

		$this->db->where('kode_prodi', $id);

		return $this->db->update('prodi', $input);
	}

	public function delete($id) {

		$this->db->where('kode_prodi', $id);
		
		return $this->db->delete('prodi');
	}
}
