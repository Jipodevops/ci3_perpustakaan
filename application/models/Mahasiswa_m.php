<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_m extends CI_Model {

	 //field yang ditampilkan
	 var $column_order = array(null, 'NIM', 'nama'); 

	 //field yang diizin untuk pencarian 
	 var $column_search = array('NIM', 'nama'); 
 
	 //field pertama yang diurutkan
	 var $order = array('nama' => 'asc'); 

     var $table = "mahasiswa";

    public function __construct() {
        parent::__construct();
    }


	public function read() {
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->join('prodi', 'mahasiswa.kode_prodi = prodi.kode_prodi');

		$query = $this->db->get();
		return $query->result_array();
	}


 
    private function _get_datatables_query() {
         
        $this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('prodi', 'mahasiswa.kode_prodi = prodi.kode_prodi');
    
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

	public function readRow($id){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('prodi', 'mahasiswa.kode_prodi = prodi.kode_prodi');
		$this->db->where('NIM', $id);
		$query = $this->db->get();
		return $query->row_array();
	}


	public function insert($data) {
		return $this->db->insert($this->table, $data);
	}

	public function searchNIM($NIM){
		$this->db->where("NIM", $NIM);
        return $this->db->get($this->table)->row_array();
	}

	public function cekNIM(){
		$this->db->select('*');
		$this->db->from($this->table, 'peminjaman');
		$this->db->where('mahasiswa.NIM NOT IN(SELECT NIM FROM peminjaman WHERE status = "N")');
		return $this->db->get()->result_array();
	}

	public function update($input, $id) {
		$this->db->where('NIM', $id);

		return $this->db->update($this->table, $input);
	}


	public function delete($id) {
		$this->db->where('NIM', $id);
		return $this->db->delete($this->table);

	}

	public function export_all(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('prodi', 'mahasiswa.kode_prodi = prodi.kode_prodi');
		$this->db->join('fakultas', 'prodi.kode_fakultas = fakultas.kode_fakultas');
		$this->db->order_by('NIM ASC');
		$this->db->order_by('mahasiswa.kode_prodi ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function grafikProdi(){
		$this->db->select('*, count(NIM) as countNIM');
		$this->db->from($this->table);
		$this->db->join('prodi', 'prodi.kode_prodi=mahasiswa.kode_prodi');
		$this->db->group_by('prodi.kode_prodi');

		return $this->db->get()->result_array();
	}

	public function grafikFakultas(){
		$this->db->select('*, count(mahasiswa.NIM) as countNIM');
		$this->db->from($this->table);
		$this->db->join('prodi', 'prodi.kode_prodi=mahasiswa.kode_prodi');
		$this->db->join('fakultas', 'prodi.kode_fakultas=fakultas.kode_fakultas');
		$this->db->group_by('fakultas.kode_fakultas');

		return $this->db->get()->result_array();
	}
}
