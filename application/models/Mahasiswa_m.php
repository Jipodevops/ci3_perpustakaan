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

	public function searchNIM($NIM){
		$this->db->where("NIM", $NIM);
        return $this->db->get("mahasiswa")->row_array();
	}

	public function cekNIM(){
		$this->db->select('*');
		$this->db->from('mahasiswa', 'peminjaman');
		$this->db->where('mahasiswa.NIM NOT IN(SELECT NIM FROM peminjaman WHERE status = "N")');
		return $this->db->get()->result_array();
	}

	public function update($input, $id) {
		$this->db->where('NIM', $id);

		return $this->db->update('mahasiswa', $input);
	}


	public function delete($id) {
		$this->db->where('NIM', $id);
		return $this->db->delete('mahasiswa');

	}

	public function export_all(){
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->join('prodi', 'mahasiswa.kode_prodi = prodi.kode_prodi');
		$this->db->join('fakultas', 'prodi.kode_fakultas = fakultas.kode_fakultas');
		$this->db->order_by('NIM ASC');
		$this->db->order_by('mahasiswa.kode_prodi ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function grafikProdi(){
		$this->db->select('*, count(NIM) as countNIM');
		$this->db->from('mahasiswa');
		$this->db->join('prodi', 'prodi.kode_prodi=mahasiswa.kode_prodi');
		$this->db->group_by('prodi.kode_prodi');

		return $this->db->get()->result_array();
	}

	public function grafikFakultas(){
		$this->db->select('*, count(mahasiswa.NIM) as countNIM');
		$this->db->from('mahasiswa');
		$this->db->join('prodi', 'prodi.kode_prodi=mahasiswa.kode_prodi');
		$this->db->join('fakultas', 'prodi.kode_fakultas=prodi.kode_fakultas');
		$this->db->group_by('prodi.kode_fakultas');

		return $this->db->get()->result_array();
	}
}
