<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriBuku_model extends CI_Model {

	//field yang ditampilkan
	var $column_order = array(null, 'kategori_buku'); 

	//field yang diizin untuk pencarian 
	var $column_search = array('id_kategoribuku', 'kategori_buku'); 

	//field pertama yang diurutkan
	var $order = array('kategori_buku' => 'asc'); 

	var $table = "kategori_buku";

   public function __construct() {
	   parent::__construct();
   }

	public function read() {
		$this->db->select('*');
		$this->db->from('kategori_buku');

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

	public function exportRow($id){
		$this->db->select('*');
		$this->db->from('kategori_buku');
		$this->db->join('buku', 'kategori_buku.id_kategoribuku = buku.id_kategoribuku');
		$this->db->where('kategori_buku.id_kategoribuku', $id);
		$query = $this->db->get();

		return $query->result_array();
	}

	

}
