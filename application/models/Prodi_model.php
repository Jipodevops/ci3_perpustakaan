<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi_model extends CI_Model {


	public function read() {
        $this->db->select('*');
        $this->db->from('prodi');
        $this->db->join('fakultas', 'prodi.kode_fakultas = fakultas.kode_fakultas');

        $query = $this->db->get();
        
        return $query->result_array();
	}

    /*
	public function insert($data) {
		//$input = data yang dikirim dari controller
		return $this->db->insert('mahasiswa', $data);
	}
    */
	public function update() {
	
	}


	public function delete($id) {
		
	}
}
