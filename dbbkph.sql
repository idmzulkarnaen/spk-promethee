-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05 Jul 2018 pada 03.55
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbkph`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'amikom bkph', 'amikom', 'a3e1100d6e60ffdac3c22044ae6518b7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(5) NOT NULL,
  `nama_alternatif` varchar(30) NOT NULL,
  `universitas` varchar(30) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `tempat_lahir` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `posjab` varchar(30) NOT NULL,
  `id_rekrutmen` int(5) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternatif`, `nama_alternatif`, `universitas`, `telp`, `tempat_lahir`, `tgl_lahir`, `alamat`, `posjab`, `id_rekrutmen`, `level`) VALUES
(12, 'Angga Renald', 'AMIKOM', '089606082003', 'Cilacap', '2018-06-05', 'Cikondang', 'AMPU', 11, 0),
(13, 'Andrew Andrian', 'Amikom', '089606082003', 'Cilacap', '2018-06-05', 'Cikondang', 'Ampu', 11, 2),
(14, 'Angga Bangles', 'AMIKOM', '089606082003', 'Cilacap', '2018-06-22', 'Cilacap', 'AMPU', 11, 3),
(15, 'Abed SIaga', 'Amikom', '089606082003', 'Cilacap', '2018-06-11', 'Cilacap', 'Ampu', 11, 0),
(16, 'Awenda', 'Amikom', '089606082003', 'Cilacap', '2018-06-18', 'Cilacap', 'Ampu', 11, 0),
(17, 'Akanda', 'Amikom', '089606082003', 'Cimanggu', '2018-06-13', 'Purwokerto', 'Ampu', 11, 1),
(18, 'Bayu Dwi Permono', 'Amikom', '089606082003', 'Cilacap', '2018-06-05', 'Cialca', 'FO', 12, 2),
(19, 'Bagas', 'Amikom', '089606082003', 'Cilacap', '2018-06-14', 'Purwokerto', 'FO', 12, 0),
(20, 'Bayu', 'Amikom', '089606082003', 'Cilacap', '2018-06-13', 'Cilacap', 'FO', 12, 1),
(21, 'Bewi', 'Amikom', '089606082003', 'Cilacap', '2018-06-06', 'Purwokerto', 'FO', 12, 2),
(22, 'Cica', 'Unsoed', '089606082003', 'Cilacap', '2018-07-18', 'Cilacap', 'LPPM', 14, 1),
(23, 'Candra', 'unsoed', '089606082003', 'Cilacap', '2018-07-05', 'Purwokerto', 'LPPM', 14, 2),
(24, 'Caca', 'unsoed', '08960602003', 'Cilacap', '2018-07-05', 'Cilacap', 'LPPM', 14, 2),
(25, 'CCC', 'Unsoed', '0960602003', 'cilacap', '2018-07-13', 'Cilacap', 'LPPM', 14, 2),
(26, 'Candra D', 'unsoed', '089606082003', 'Cilacap', '2018-07-12', 'Cilacap', 'LPPM', 14, 1),
(27, 'Cakra', 'unsoed', '08960602003', 'Cilacap', '2018-07-27', 'Cilacap', 'LPPM 2018', 14, 0),
(28, 'Cecep', 'Unsoed', '08960602003', 'Cilacap', '1900-12-19', 'Bagas', 'LPPM 2018', 14, 0),
(29, 'Didi', 'unsoed', '089606082003', 'cilacap', '2018-07-18', 'cikondang', 'BAUK', 13, 0),
(30, 'Dewi', 'unsoed', '089606082003', 'cilacap', '2018-07-18', 'fad', 'BAUK', 13, 0),
(31, 'Dowo', 'unsoed', '08960602003', 'Cilacap', '2018-07-25', 'Cilacap', 'BAUK', 13, 0),
(32, 'Dadan', 'unsoed', '08960602003', '', '2018-07-20', 'cilacap', 'BAUK 2018', 13, 0),
(33, 'Deni', 'unsoed', '08960602003', 'Cilacap', '2018-07-16', 'cikondang', 'BAUK', 13, 0),
(34, 'djoko', 'unsoed', '08960602003', 'cilacap', '2018-07-09', 'cikondang', 'BAUK', 13, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(5) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `id_tipe_preferensi` int(5) NOT NULL,
  `min_max` set('min','max') NOT NULL,
  `q` double NOT NULL,
  `p` double NOT NULL,
  `s` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama_kriteria`, `id_tipe_preferensi`, `min_max`, `q`, `p`, `s`) VALUES
(8, 'Pengalaman', 1, 'max', 0, 0, 0),
(9, 'tanggung jawab', 1, 'max', 0, 0, 0),
(10, 'kemampuan lain ', 1, 'max', 0, 0, 0),
(11, 'Gaji', 1, 'min', 0, 0, 0),
(12, 'TPA', 1, 'max', 0, 0, 0),
(13, 'microsoft word', 1, 'max', 0, 0, 0),
(14, 'Microsoft excel', 1, 'max', 0, 0, 0),
(15, 'microsoft powerpoint', 1, 'max', 0, 0, 0),
(16, 'motivasi', 1, 'max', 0, 0, 0),
(17, 'sikap', 1, 'max', 0, 0, 0),
(18, 'kesopanan', 1, 'max', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id_penilaian` int(5) NOT NULL,
  `id_seleksi_kriteria` int(5) NOT NULL,
  `id_alternatif` int(5) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id_penilaian`, `id_seleksi_kriteria`, `id_alternatif`, `nilai`) VALUES
(1, 9, 15, 28),
(2, 10, 15, 4),
(3, 11, 15, 6),
(4, 12, 15, 5),
(5, 9, 17, 39),
(6, 10, 17, 5),
(7, 11, 17, 7),
(8, 12, 17, 6),
(9, 9, 13, 40),
(10, 10, 13, 3),
(11, 11, 13, 8),
(12, 12, 13, 6),
(13, 9, 14, 35),
(14, 10, 14, 7),
(15, 11, 14, 9),
(16, 12, 14, 8),
(17, 9, 12, 21),
(18, 10, 12, 6),
(19, 11, 12, 4),
(20, 12, 12, 9),
(21, 9, 16, 55),
(22, 10, 16, 3),
(23, 11, 16, 2),
(24, 12, 16, 3),
(25, 13, 17, 1500),
(26, 14, 17, 40),
(27, 15, 17, 30),
(28, 16, 17, 50),
(29, 13, 13, 1400),
(30, 14, 13, 70),
(31, 15, 13, 30),
(32, 16, 13, 80),
(33, 13, 14, 2000),
(34, 14, 14, 80),
(35, 15, 14, 30),
(36, 16, 14, 50),
(37, 17, 13, 3),
(38, 18, 13, 1),
(39, 19, 13, 4),
(40, 17, 14, 6),
(41, 18, 14, 5),
(42, 19, 14, 1),
(43, 25, 19, 4),
(44, 26, 19, 5),
(45, 27, 19, 6),
(46, 28, 19, 8),
(47, 25, 20, 7),
(48, 26, 20, 3),
(49, 27, 20, 7),
(50, 28, 20, 9),
(51, 25, 18, 8),
(52, 26, 18, 9),
(53, 27, 18, 3),
(54, 28, 18, 1),
(55, 25, 21, 6),
(56, 26, 21, 3),
(57, 27, 21, 7),
(58, 28, 21, 6),
(59, 21, 20, 40),
(60, 22, 20, 50),
(61, 23, 20, 30),
(62, 24, 20, 1500),
(63, 21, 18, 70),
(64, 22, 18, 80),
(65, 23, 18, 30),
(66, 24, 18, 1400),
(67, 21, 21, 80),
(68, 22, 21, 50),
(69, 23, 21, 30),
(70, 24, 21, 2000),
(71, 55, 24, 23),
(72, 56, 24, 80),
(73, 57, 24, 86),
(74, 58, 24, 79),
(75, 55, 27, 34),
(76, 56, 27, 24),
(77, 57, 27, 43),
(78, 58, 27, 68),
(79, 55, 23, 56),
(80, 56, 23, 25),
(81, 57, 23, 13),
(82, 58, 23, 32),
(83, 55, 26, 35),
(84, 56, 26, 67),
(85, 57, 26, 56),
(86, 58, 26, 78),
(87, 55, 25, 64),
(88, 56, 25, 43),
(89, 57, 25, 67),
(90, 58, 25, 26),
(91, 55, 28, 23),
(92, 56, 28, 24),
(93, 57, 28, 24),
(94, 58, 28, 78),
(95, 55, 22, 56),
(96, 56, 22, 67),
(97, 57, 22, 67),
(98, 58, 22, 90),
(99, 59, 24, 1200000),
(100, 60, 24, 46),
(101, 61, 24, 33),
(102, 62, 24, 14),
(103, 59, 23, 1500000),
(104, 60, 23, 56),
(105, 61, 23, 22),
(106, 62, 23, 56),
(107, 59, 26, 1500000),
(108, 60, 26, 22),
(109, 61, 26, 55),
(110, 62, 26, 32),
(111, 59, 25, 1500000),
(112, 60, 25, 45),
(113, 61, 25, 55),
(114, 62, 25, 56),
(115, 59, 22, 1500000),
(116, 60, 22, 22),
(117, 61, 22, 13),
(118, 62, 22, 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rekrutmen`
--

CREATE TABLE `tb_rekrutmen` (
  `id_rekrutmen` int(5) NOT NULL,
  `nama_rekrutmen` varchar(30) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kuota` int(3) NOT NULL,
  `keterangan` text NOT NULL,
  `kode` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tb_rekrutmen`
--

INSERT INTO `tb_rekrutmen` (`id_rekrutmen`, `nama_rekrutmen`, `tanggal`, `kuota`, `keterangan`, `kode`) VALUES
(11, 'AMPU 2018', '2018-06-07 00:00:00', 2, '', 'AMPU'),
(12, 'FO 2018', '2018-06-12 00:00:00', 3, '', 'FO'),
(13, 'BAUK 2018', '2018-07-10 00:00:00', 1, '', 'BAUK'),
(14, 'LPPM 2018', '2018-07-18 00:00:00', 2, '', 'LPPM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_seleksi`
--

CREATE TABLE `tb_seleksi` (
  `id_seleksi` int(5) NOT NULL,
  `nama_seleksi` varchar(30) NOT NULL,
  `kuota` int(3) NOT NULL,
  `id_rekrutmen` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_seleksi`
--

INSERT INTO `tb_seleksi` (`id_seleksi`, `nama_seleksi`, `kuota`, `id_rekrutmen`) VALUES
(1, 'TPA dan Komputer', 3, 11),
(2, 'Wawancara 1', 2, 11),
(3, 'wawancara 1', 1, 11),
(4, 'TPA dan Komputer', 3, 12),
(5, 'Wawancara', 2, 12),
(6, 'TPA dan komputer', 5, 13),
(7, 'Wawancara 1', 3, 13),
(8, 'Wawancara 2', 1, 13),
(9, 'TPA dan praktek', 5, 14),
(10, 'wawancara 1', 3, 14),
(11, 'wawancara 2', 2, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_seleksi_kriteria`
--

CREATE TABLE `tb_seleksi_kriteria` (
  `id_seleksi_kriteria` int(5) NOT NULL,
  `id_seleksi` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_seleksi_kriteria`
--

INSERT INTO `tb_seleksi_kriteria` (`id_seleksi_kriteria`, `id_seleksi`, `id_kriteria`, `bobot`) VALUES
(9, 1, 12, 1),
(10, 1, 14, 1),
(11, 1, 15, 1),
(12, 1, 13, 1),
(13, 2, 11, 1),
(14, 2, 10, 1),
(15, 2, 8, 1),
(16, 2, 9, 1),
(17, 3, 18, 1),
(18, 3, 17, 1),
(19, 3, 16, 1),
(21, 5, 10, 1),
(22, 5, 9, 1),
(23, 5, 8, 1),
(24, 5, 11, 1),
(25, 4, 12, 1),
(26, 4, 14, 1),
(27, 4, 15, 1),
(28, 4, 13, 1),
(32, 6, 12, 1),
(33, 6, 14, 1),
(34, 6, 15, 1),
(35, 6, 13, 1),
(44, 8, 18, 1),
(45, 8, 17, 1),
(46, 8, 16, 1),
(55, 9, 12, 1),
(56, 9, 14, 1),
(57, 9, 15, 1),
(58, 9, 13, 1),
(59, 10, 11, 1),
(60, 10, 10, 1),
(61, 10, 9, 1),
(62, 10, 8, 1),
(64, 11, 18, 1),
(65, 11, 17, 1),
(66, 11, 16, 1),
(67, 7, 16, 1),
(68, 7, 10, 1),
(69, 7, 8, 1),
(70, 7, 9, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tipe_preferensi`
--

CREATE TABLE `tb_tipe_preferensi` (
  `id_tipe_preferensi` int(5) NOT NULL,
  `nama_tipe_preferensi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tipe_preferensi`
--

INSERT INTO `tb_tipe_preferensi` (`id_tipe_preferensi`, `nama_tipe_preferensi`) VALUES
(1, 'biasa'),
(2, 'quasi'),
(3, 'linear'),
(4, 'linear quasi'),
(5, 'level'),
(6, 'gausian');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `tb_rekrutmen`
--
ALTER TABLE `tb_rekrutmen`
  ADD PRIMARY KEY (`id_rekrutmen`);

--
-- Indexes for table `tb_seleksi`
--
ALTER TABLE `tb_seleksi`
  ADD PRIMARY KEY (`id_seleksi`);

--
-- Indexes for table `tb_seleksi_kriteria`
--
ALTER TABLE `tb_seleksi_kriteria`
  ADD PRIMARY KEY (`id_seleksi_kriteria`);

--
-- Indexes for table `tb_tipe_preferensi`
--
ALTER TABLE `tb_tipe_preferensi`
  ADD PRIMARY KEY (`id_tipe_preferensi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id_alternatif` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id_penilaian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `tb_rekrutmen`
--
ALTER TABLE `tb_rekrutmen`
  MODIFY `id_rekrutmen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tb_seleksi`
--
ALTER TABLE `tb_seleksi`
  MODIFY `id_seleksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_seleksi_kriteria`
--
ALTER TABLE `tb_seleksi_kriteria`
  MODIFY `id_seleksi_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `tb_tipe_preferensi`
--
ALTER TABLE `tb_tipe_preferensi`
  MODIFY `id_tipe_preferensi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
