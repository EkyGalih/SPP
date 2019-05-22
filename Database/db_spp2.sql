-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06 Jan 2018 pada 05.50
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `jenis_pembayaran` varchar(15) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `periode_bayar` varchar(25) NOT NULL,
  `total_bayar` int(50) NOT NULL,
  `status_pembayaran` tinyint(2) DEFAULT '0',
  `id_siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `jenis_pembayaran`, `tgl_bayar`, `periode_bayar`, `total_bayar`, `status_pembayaran`, `id_siswa`) VALUES
(2, 'DPP', '2018-01-06', '2018/2019', 350000, 1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_petugas`
--

CREATE TABLE `tbl_petugas` (
  `id_petugas` int(4) NOT NULL,
  `nama_petugas` varchar(100) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `hak_akses` varchar(35) NOT NULL,
  `gambar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_petugas`
--

INSERT INTO `tbl_petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `hak_akses`, `gambar`) VALUES
(1, 'Kepsek', 'kepsek', '8561863b55faf85b9ad67c52b3b851ac', 'kepsek', NULL),
(2, 'Admin nw', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Profile/Petugas/Gambar_Petugas/admin1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` int(15) DEFAULT NULL,
  `password` varchar(150) NOT NULL,
  `nama_siswa` varchar(35) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `kelas` varchar(15) DEFAULT NULL,
  `jurusan` varchar(20) DEFAULT NULL,
  `periode` varchar(30) DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `kategori` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id_siswa`, `nis`, `password`, `nama_siswa`, `alamat`, `jenis_kelamin`, `kelas`, `jurusan`, `periode`, `gambar`, `kategori`) VALUES
(5, 12345, '827ccb0eea8a706c4c34a16891f84e7b', 'supriadi', 'bali, nusa tenggara', 'laki-laki', 'XI', 'IPS', '2018/2019', 'Profile/Siswa/Gambar_siswa/siswa.png', 'siswa'),
(7, 54321, '01cfcd4f6b8770febfb40cb906715822', 'ery cenge', 'selong beranak', 'laki-laki', 'XII', 'IPA', '2017/2018', NULL, 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `fk_tbl_pembayaran_tbl_siswa_idx` (`id_siswa`);

--
-- Indexes for table `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  MODIFY `id_petugas` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `fk_tbl_pembayaran_tbl_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `tbl_siswa` (`id_siswa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
