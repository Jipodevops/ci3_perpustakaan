-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jun 2020 pada 21.58
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tb2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` varchar(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `id_kategoribuku` int(5) NOT NULL,
  `kode_rak` int(10) NOT NULL,
  `foto_sampul` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `jumlah`, `id_kategoribuku`, `kode_rak`, `foto_sampul`) VALUES
(9, 'Mobile Programing', 'Jodikal Pomalingo', 'Jipodevops', '2020', 200, 1, 3, 'Database_Aggregations.PNG'),
(10, 'Java Programming', 'Jipo', 'Jodi', '2018', 200, 1, 3, '16R_1.jpg'),
(11, 'Java', 'eyey', 'reyeye', '2020', 6546, 1, 3, 'Double_E2.jpg'),
(12, 'Jopi', 'asas', 'dfdf', '2020', 12, 2, 3, 'Double_E1.jpg'),
(13, 'rtew', 'retyrty', 'yrty', '2021', 111, 5, 3, 'Baliho_Lapak.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `kode_denda` int(10) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlah_denda` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `denda`
--

INSERT INTO `denda` (`kode_denda`, `keterangan`, `jumlah_denda`) VALUES
(1, 'Denda Keterlambatan', 5000),
(3, 'Rusak sebagian', 20000),
(5, 'Hilang', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `kode_peminjaman` int(50) NOT NULL,
  `id_buku` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fakultas`
--

CREATE TABLE `fakultas` (
  `kode_fakultas` int(10) NOT NULL,
  `nama_fakultas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fakultas`
--

INSERT INTO `fakultas` (`kode_fakultas`, `nama_fakultas`) VALUES
(4, 'Ilmu Komputer'),
(5, 'Ilmu Ekonomi'),
(6, 'Teknik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategoribuku` int(5) NOT NULL,
  `kategori_buku` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategoribuku`, `kategori_buku`) VALUES
(1, 'Teknologi'),
(2, 'Science'),
(5, 'Romance');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` char(25) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `status_mahasiswa` varchar(50) NOT NULL,
  `kode_prodi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `nama`, `jenis_kelamin`, `alamat`, `no_telepon`, `agama`, `status_mahasiswa`, `kode_prodi`) VALUES
('41518010033', 'Jodikal Pomalingo', 'Laki - laki', 'Gorontalo', '082112345543', 'Islam', 'Aktif', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(10) NOT NULL,
  `NIM` char(25) NOT NULL,
  `kode_peminjaman` int(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `kode_peminjaman` int(50) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `NIM` char(25) NOT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `id_petugas` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `kode_pengemblian` int(50) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `kode_peminjaman` int(50) NOT NULL,
  `NIM` char(25) NOT NULL,
  `kode_denda` int(10) DEFAULT NULL,
  `total_denda` int(15) DEFAULT NULL,
  `id_petugas` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `psw` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `jenis_kelamin`, `alamat`, `no_telepon`, `username`, `psw`) VALUES
(1, 'Jodikal Pomalingo', 'Laki - laki', 'Meruya Selatan', '0878231444', 'jodipmlgo', 'd7f53ba5a2b891222597cf4a63ecd6d190dcf0803038cdda7debb6d3ff1a0bdd2ca6cde5c4e9d6ac3dd56154bf33f8d84790532e964936d7b6f688a2dfa63483CukXs+PZYgxo5nAVxk1ad/Uq8BkpWOg1EJlD9OccLkU=');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `kode_prodi` int(10) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `kode_fakultas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`kode_prodi`, `nama_prodi`, `kode_fakultas`) VALUES
(1, 'Informatika', '4'),
(2, 'Sistem Informasi', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak_buku`
--

CREATE TABLE `rak_buku` (
  `kode_rak` int(10) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rak_buku`
--

INSERT INTO `rak_buku` (`kode_rak`, `kategori`, `lokasi`) VALUES
(3, 'Teknologi', 'Sebelah Kiri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp`
--

CREATE TABLE `tmp` (
  `id_buku` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kode_rak` (`kode_rak`),
  ADD KEY `id_kategoribuku` (`id_kategoribuku`);

--
-- Indeks untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`kode_denda`);

--
-- Indeks untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD KEY `kode_peminjaman` (`kode_peminjaman`);

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`kode_fakultas`);

--
-- Indeks untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategoribuku`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`),
  ADD KEY `kode_prodi` (`kode_prodi`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `NIM` (`NIM`),
  ADD KEY `kode_peminjaman` (`kode_peminjaman`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`kode_peminjaman`),
  ADD KEY `NIM` (`NIM`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`kode_pengemblian`),
  ADD KEY `NIM` (`NIM`),
  ADD KEY `kode_denda` (`kode_denda`),
  ADD KEY `kode_peminjaman` (`kode_peminjaman`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`kode_prodi`),
  ADD KEY `kode_fakultas` (`kode_fakultas`);

--
-- Indeks untuk tabel `rak_buku`
--
ALTER TABLE `rak_buku`
  ADD PRIMARY KEY (`kode_rak`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `denda`
--
ALTER TABLE `denda`
  MODIFY `kode_denda` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `kode_fakultas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategoribuku` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `kode_prodi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rak_buku`
--
ALTER TABLE `rak_buku`
  MODIFY `kode_rak` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
