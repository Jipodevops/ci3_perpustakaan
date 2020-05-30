<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RakBuku_model extends CI_Model {


	public function read() {
		$this->db->select('*');
		$this->db->from('rak_buku');

		$query = $this->db->get();
		return $query->result_array();
	}

}
