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
}
