<?php

class Dashboard_model extends CI_Model{

    public function countMahasiswa(){
        return $this->db->count_all("mahasiswa");
    }

    public function countPeminjaman(){
        return $this->db->count_all("peminjaman");
    }

    public function countBuku(){
        return $this->db->count_all("buku");
    }

    public function countBelumDikembalikan(){
        $query = $this->db->where('status', 'N')->get("peminjaman");
        return $query->num_rows();
    }

    public function grafikBook(){
        $this->db->select('*, count(buku.id_buku) as countBok');
        $this->db->from('buku');
        $this->db->join('kategori_buku', 'buku.id_kategoribuku = kategori_buku.id_kategoribuku');
        $this->db->group_by('buku.id_kategoribuku');
        return $this->db->get()->result_array();
    }

    public function grafikPerBook(){
        $this->db->select('*, count(buku.id_buku) as countBook');
        $this->db->from('detail_peminjaman', ' peminjaman');
        $this->db->join('buku', 'detail_peminjaman.id_buku = buku.id_buku');
        $this->db->join('peminjaman', 'detail_peminjaman.kode_peminjaman = peminjaman.kode_peminjaman');
        $this->db->where('peminjaman.kode_peminjaman NOT IN(select kode_peminjaman from peminjaman where status= "Y")');
        $this->db->group_by('detail_peminjaman.id_buku');
        return $this->db->get()->result_array();
    }

    public function grafikPeminjamanperProdi(){
        $this->db->select('*, count(peminjaman.kode_peminjaman) as countPeminjaman');
        $this->db->from('peminjaman');
        $this->db->join('mahasiswa', 'peminjaman.NIM = mahasiswa.NIM');
        $this->db->join('prodi', 'mahasiswa.kode_prodi = prodi.kode_prodi');
        $this->db->group_by('mahasiswa.kode_prodi');
        return $this->db->get()->result_array();
    }

    public function grafikPeminjamanperTanggal(){
        $this->db->select('*, count(peminjaman.kode_peminjaman) as countPeminjaman');
        $this->db->from('peminjaman');
        $this->db->group_by('peminjaman.tanggal_pinjam');
        return $this->db->get()->result_array();
    }
}