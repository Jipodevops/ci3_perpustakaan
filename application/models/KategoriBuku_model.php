<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriBuku_model extends CI_Model {


	public function read() {
		$this->db->select('*');
		$this->db->from('kategori_buku');

		$query = $this->db->get();
		return $query->result_array();
	}

	public function rowRead($id){
		$this->db->select('*');
		$this->db->from('kategori_buku');
		$this->db->where('id_kategoribuku', $id);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function insert($data){
		return $this->db->insert('kategori_buku',$data);
	}

	public function update($input, $id) {
		$this->db->where('id_kategoribuku', $id);

		return $this->db->update('kategori_buku', $input);
	}

	public function delete($id){
		$this->db->where('id_kategoribuku', $id);
		return $this->db->delete('kategori_buku');
	}

}
