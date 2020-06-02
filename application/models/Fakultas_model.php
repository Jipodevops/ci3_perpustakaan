<?php

class Fakultas_model extends CI_Model{
    public function read(){
        $this->db->select('*');
        $this->db->from('fakultas');

        return $this->db->get()->result_array();
    }

    public function insert($data){
        return $this->db->insert('fakultas', $data);
    }

    public function delete($id){
        $this->db->where('kode_fakultas', $id);

        return $this->db->delete('fakultas');
    }

    public function rowRead($id){
        $this->db->select('*');
        $this->db->from('fakultas');
        $this->db->where('kode_fakultas', $id);

        return $this->db->get()->row_array();
    }

    public function update($data, $id){
        $this->db->where('kode_fakultas', $id);
        return $this->db->update('fakultas', $data);
    }
}