<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denda_model extends CI_Model {

	//field yang ditampilkan
	var $column_order = array(null, 'keterangan', 'jumlah_denda'); 

	//field yang diizin untuk pencarian 
	var $column_search = array('keterangan', 'kode_denda'); 

	//field pertama yang diurutkan
	var $order = array('kode_denda' => 'asc'); 

	var $table = "denda";

   public function __construct() {
	   parent::__construct();
   }

	public function read() {
		$this->db->select('*');
		$this->db->from('denda');
		$this->db->where_not_in('kode_denda', '2');
		$query = $this->db->get();
		return $query->result_array();
	}

	private function _get_datatables_query() {
         
        $this->db->select('*');
		$this->db->from($this->table);
		$this->db->where_not_in('kode_denda', '2');
    
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
		$this->db->group_by('denda.kode_denda');
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
