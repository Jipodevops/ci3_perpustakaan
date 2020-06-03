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

    public function export_all(){
        $this->db->select('*');
        $this->db->from('fakultas');
        $this->db->join('prodi', 'fakultas.kode_fakultas = prodi.kode_fakultas');
        $this->db->join('mahasiswa', 'mahasiswa.kode_prodi = prodi.kode_prodi');
        $this->db->order_by('fakultas.kode_fakultas');

        return $this->db->get()->result_array();
    }
}