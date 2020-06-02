<?php

class Tmp_model extends CI_Model{
    public function insert($data){
        return $this->db->insert('tmp', $data);
    }

    public function read(){
        $this->db->select('*');
        $this->db->from('tmp');

        return $this->db->get()->result_array();
    }

    public function delete($id){
        $this->db->where('id_buku', $id);
        return $this->db->delete('tmp');
    }

    public function countTmp(){
        return $this->db->count_all("tmp");
    }

    public function getTmp(){
        return $this->db->get('tmp')->result_array();
    }

    public function checkTmp($id){
        $this->db->where('id_buku', $id);
        return $this->db->get('tmp')->num_rows();
    }
}