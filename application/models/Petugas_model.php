<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_model extends CI_Model {

	//field yang ditampilkan
	var $column_order = array(null, 'nama', 'jenis_kelamin', 'alamat', 'no_telepon', 'username'); 

	//field yang diizin untuk pencarian 
	var $column_search = array('nama', 'username'); 

	//field pertama yang diurutkan
	var $order = array('nama' => 'asc'); 

	var $table = "petugas";

   public function __construct() {
	   parent::__construct();
   }


	public function read() {
		$this->db->select('*');
		$this->db->from($this->table);

		$query = $this->db->get();
		return $query->result_array();
	}
	
	private function _get_datatables_query() {
         
        $this->db->select('*');
        $this->db->from($this->table);
    
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
        	$search = $this->input->post('search');
            if($search['value']) 

            // jika datatable mengirimkan pencarian dengan metode POST
            {
                // looping awal 
                if($i===0) {
                    $this->db->group_start(); 
                    $this->db->like($item, $search['value']);
                } else {
                    $this->db->or_like($item, $search['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if($this->input->post('order')) {
        	$order = $this->input->post('order');
            $this->db->order_by($this->column_order[$order['0']['column']], $order['0']['dir']);

        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables() {
        $this->_get_datatables_query();
        if($this->input->post('length') != -1)
        	$this->db->limit($this->input->post('length'), $this->input->post('start'));

        $query = $this->db->get();
        return $query->result_array();
    }
 
 	//menghitung tota data sesuai filter/pagination
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
 	//menghitung total data di table
    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
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

	public function read_export($id){
		$this->db->select('petugas.*, peminjaman.*');
		$this->db->select('petugas.nama as ptgs');
		$this->db->select('mahasiswa.nama as mhs');
		$this->db->from('petugas');
		$this->db->join('peminjaman', 'petugas.id_petugas = peminjaman.id_petugas');
		$this->db->join('mahasiswa', 'peminjaman.NIM = mahasiswa.NIM');
		$this->db->where('petugas.id_petugas', $id);
		$this->db->order_by('peminjaman.kode_peminjaman');

		return $this->db->get()->result_array();
	}
}
