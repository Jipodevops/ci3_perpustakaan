<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RakBuku_model extends CI_Model {


	public function read() {
		$this->db->select('*');
		$this->db->from('rak_buku');

		$query = $this->db->get();
		return $query->result_array();
	}

	public function rowRead($id){
		$this->db->select('*');
		$this->db->from('rak_buku');
		$this->db->where('kode_rak', $id);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function insert($data){
		return $this->db->insert('rak_buku',$data);
	}

	public function update($input, $id) {
		$this->db->where('kode_rak', $id);

		return $this->db->update('rak_buku', $input);
	}

	public function delete($id){
		$this->db->where('kode_rak', $id);
		return $this->db->delete('rak_buku');
	}

}
