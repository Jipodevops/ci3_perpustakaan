<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denda_model extends CI_Model {


	public function read() {
		$this->db->select('*');
		$this->db->from('denda');

		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function rowRead($id) {
		$this->db->select('*');
		$this->db->from('denda');
        $this->db->where('kode_denda', $id);
		$query = $this->db->get();
		return $query->row_array();
	}


	public function insert($data) {
		return $this->db->insert('denda', $data);
	}

	public function update($input, $id) {
		$this->db->where('kode_denda', $id);

		return $this->db->update('denda', $input);
	}


	public function delete($id) {
		$this->db->where('kode_denda', $id);
		return $this->db->delete('denda');
	}
}
