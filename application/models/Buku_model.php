<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {


	public function read() {
		$this->db->select('*');
		$this->db->from('buku');
        $this->db->join('kategori_buku', 'buku.id_kategoribuku = kategori_buku.id_kategoribuku');
        $this->db->join('rak_buku', 'buku.kode_rak = rak_buku.kode_rak');

		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function rowRead($id) {
		$this->db->select('*');
		$this->db->from('buku');
        $this->db->join('kategori_buku', 'buku.id_kategoribuku = kategori_buku.id_kategoribuku');
        $this->db->join('rak_buku', 'buku.kode_rak = rak_buku.kode_rak');
        $this->db->where('id_buku', $id);

		$query = $this->db->get();
		return $query->row_array();
	}

	public function readRow(){
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->join('prodi', 'mahasiswa.kode_prodi = prodi.kode_prodi');

		$query = $this->db->get();
		return $query->row_array();
	}


	public function insert($data) {
		return $this->db->insert('buku', $data);
	}

	public function update($input, $id) {
		$this->db->where('id_buku', $id);

		return $this->db->update('buku', $input);
	}


	public function delete($id) {
		$this->db->where('id_buku', $id);
		return $this->db->delete('buku');
	}

	public function cariBuku(){
		$this->db->select('*');
		$this->db->from('buku');
		$this->db->where('buku.id_buku NOT IN(SELECT id_buku from tmp)');
        return $this->db->get()->result_array();
	}

	public function export_all(){
		$this->db->select('*');
		$this->db->from('buku');
        $this->db->join('kategori_buku', 'buku.id_kategoribuku = kategori_buku.id_kategoribuku');
        $this->db->join('rak_buku', 'buku.kode_rak = rak_buku.kode_rak');

		$query = $this->db->get();
		return $query->result_array();
	}
}
