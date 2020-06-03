<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denda_model extends CI_Model {


	public function read() {
		$this->db->select('*');
		$this->db->from('denda');
		$this->db->where_not_in('kode_denda', '2');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function read1() {
		$this->db->select('*');
		$this->db->from('denda');
		$this->db->where('kode_denda > 1');
		$this->db->where_not_in('kode_denda', '2');
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

	public function chart() {
		$this->db->select('*, count(pengembalian.kode_denda) as denda');
		$this->db->from('denda');
		$this->db->join('pengembalian', 'denda.kode_denda = pengembalian.kode_denda');
		$this->db->group_by('pengembalian.kode_pengemblian');
		$query = $this->db->get();
		return $query->result_array();
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
