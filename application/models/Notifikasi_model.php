<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model{
    
	public function read() {
		$this->db->select('*');
		$this->db->from('notifikasi');

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


	public function insert($data) {
		return $this->db->insert('notifikasi', $data);
	}

	public function update($input, $id) {
		$this->db->where('id_notifikasi', $id);

		return $this->db->update('notifikasi', $input);
	}


	public function delete($id) {
		$this->db->where('id_notifikasi', $id);
		return $this->db->delete('notifikasi');
	}
}