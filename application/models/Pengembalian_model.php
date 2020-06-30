<?php

class Pengembalian_model extends CI_Model{

    //field yang ditampilkan
	var $column_order = array(null, 'tanggal_pengembalian', 'kode_peminjaman', 'NIM', 'kode_denda', 'total_denda', 'id_petugas'); 

	//field yang diizin untuk pencarian 
	var $column_search = array('kode_pengemblian', 'pengembalian.NIM', 'pengembalian.kode_peminjaman'); 

	//field pertama yang diurutkan
	var $order = array('kode_pengemblian' => 'asc'); 

	var $table = "pengembalian";

   public function __construct() {
	   parent::__construct();
   }
    
    public function read(){
        $this->db->select('*');
        $this->db->from('pengembalian');
        $this->db->join('peminjaman', 'pengembalian.kode_peminjaman = peminjaman.kode_peminjaman');
        $this->db->join('mahasiswa', 'pengembalian.NIM = mahasiswa.NIM');
        $this->db->join('denda', 'denda.kode_denda = pengembalian.kode_denda');
        $this->db->order_by('pengembalian.tanggal_pengembalian');

        return $this->db->get()->result_array();
    }

    public function insert($data){
        return $this->db->insert('pengembalian', $data);
    }

    private function _get_datatables_query() {
         
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('peminjaman', 'pengembalian.kode_peminjaman = peminjaman.kode_peminjaman');
        $this->db->join('mahasiswa', 'pengembalian.NIM = mahasiswa.NIM');
        $this->db->join('denda', 'denda.kode_denda = pengembalian.kode_denda');
        $this->db->order_by('pengembalian.tanggal_pengembalian');
    
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

    public function Auto_PK(){
        $today = date('ymd');

		$this->db->select_max('kode_pengemblian', 'last');
		$this->db->from('pengembalian');

        $data = $this->db->get()->row_array();
        $lastPeminjaman = $data['last'];
        $noUrut = substr($lastPeminjaman,8,3);
        $nextNoUrut = $noUrut+1;
        $NoTransaksi = $today.sprintf('%03s', $nextNoUrut);
        return $NoTransaksi;
    }

    public function searchKode($id){
        $this->db->select('*');
        $this->db->from('peminjaman', 'pengembalian');
        $this->db->join('mahasiswa', 'peminjaman.NIM = mahasiswa.NIM');
        $this->db->where('peminjaman.kode_peminjaman', $id);
        $this->db->where('peminjaman.kode_peminjaman NOT IN(SELECT kode_peminjaman FROM pengembalian)');

        return $this->db->get()->row_array();

    }

    public function kodePeminjaman(){
        $this->db->select('*');
        $this->db->from('peminjaman', 'pengembalian');
        $this->db->where('peminjaman.kode_peminjaman NOT IN(SELECT kode_peminjaman FROM pengembalian)');

        return $this->db->get()->result_array();

    }

    public function readBook($id){
        $this->db->select('*');
        $this->db->from('detail_peminjaman', 'pengembalian');
        $this->db->join('buku', 'detail_peminjaman.id_buku = buku.id_buku');
        $this->db->where('detail_peminjaman.kode_peminjaman', $id);
        $this->db->where('detail_peminjaman.kode_peminjaman NOT IN(SELECT kode_peminjaman FROM pengembalian)');

        return $this->db->get()->result_array();
    }

    public function delete($id){
        $this->db->where('kode_peminjaman', $id);
        return $this->db->delete('pengembalian');
    }

}