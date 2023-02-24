-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2023 at 04:52 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dokter`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_pasien`
--

CREATE TABLE `data_pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `alamat_pasien` varchar(255) NOT NULL,
  `telepon_pasien` varchar(13) NOT NULL,
  `jenkel_pasien` varchar(10) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `bpjs` varchar(13) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pasien`
--

INSERT INTO `data_pasien` (`id_pasien`, `nama_pasien`, `alamat_pasien`, `telepon_pasien`, `jenkel_pasien`, `no_ktp`, `tgl_lahir`, `bpjs`, `status`, `keterangan`) VALUES
(1, 'Dea Afrizal', 'Perumahan Tamansari Indah RT11/RW 02 Bondowoso ', '081234567895', 'Laki-laki', '3511171703750004', '1975-03-17', '0000193516625', 1, ''),
(2, 'Sandhika Galih', 'Kademangan, Bondowoso', '082331796582', 'Laki-laki', '3511171511730004', '1973-11-15', '0000193516600', 1, ''),
(3, 'Elok Perdana', 'Jln. RE. Martadinata No 50 Bondowoso', '089776589312', 'Perempuan', '3511116007710005', '1971-07-20', '0000193516715', 1, ''),
(5, 'Andre Pratama', 'Jln. Khairil Anwar 10 Badean Bondowoso', '081332456965', 'Laki-laki', '3511122401730001', '1973-01-24', '', 1, ''),
(6, 'Eko Kurniawan Khanedy', 'Jln. Raya Situbondo 166 Tenggarang', '082331251471', 'Laki-laki', '3511080407680001', '1968-07-04', '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id_jadwal` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_jam` int(11) NOT NULL,
  `id_tanggal` int(11) NOT NULL,
  `status_pasien` int(1) NOT NULL DEFAULT 0,
  `ket_tanggal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id_jadwal`, `id_pasien`, `id_jam`, `id_tanggal`, `status_pasien`, `ket_tanggal`) VALUES
(1, 1, 1, 1, 1, ''),
(2, 2, 1, 2, 1, ''),
(3, 3, 2, 2, 1, ''),
(4, 1, 3, 2, 1, ''),
(5, 1, 1, 3, 1, ''),
(6, 2, 1, 4, 1, ''),
(7, 3, 2, 4, 1, ''),
(8, 1, 3, 4, 1, ''),
(9, 2, 4, 4, 1, ''),
(10, 2, 1, 5, 1, ''),
(11, 1, 5, 6, 1, ''),
(12, 6, 1, 15, 1, ''),
(13, 6, 1, 17, 3, ''),
(14, 3, 1, 18, 3, ''),
(15, 6, 6, 18, 3, ''),
(16, 2, 2, 18, 3, ''),
(17, 5, 3, 18, 3, ''),
(18, 1, 5, 18, 3, ''),
(19, 1, 1, 19, 3, ''),
(20, 2, 2, 19, 2, ''),
(21, 1, 1, 20, 3, ''),
(22, 3, 2, 20, 3, ''),
(23, 5, 3, 20, 3, ''),
(24, 2, 5, 20, 2, ''),
(25, 2, 1, 21, 2, ''),
(26, 5, 2, 21, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `jam_periksa`
--

CREATE TABLE `jam_periksa` (
  `id_jam` int(11) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `status_jam` int(1) NOT NULL DEFAULT 1,
  `ket_jam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jam_periksa`
--

INSERT INTO `jam_periksa` (`id_jam`, `jam`, `status_jam`, `ket_jam`) VALUES
(1, '16.00 - 16.30', 1, 'Praktek'),
(2, '16.30 - 17.00', 1, 'Praktek'),
(3, '17.30 - 18.00', 1, 'Praktek'),
(4, '18.00 - 18.30', 1, 'Sholat'),
(5, '18.30 - 19.00', 1, 'Praktek'),
(6, '19.00 - 19.30', 1, 'Praktek'),
(10, '19.30 - 20.00', 1, 'Praktek'),
(11, '20.00 - 20.30', 1, 'Praktek'),
(12, '20.30 - 21.00', 1, 'Praktek'),
(13, '15.30 - 16.00', 1, 'Praktek');

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan_pasien`
--

CREATE TABLE `kunjungan_pasien` (
  `id_kunjungan` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_tindakan` int(11) DEFAULT NULL,
  `keluhan` varchar(255) NOT NULL,
  `jumlah` int(2) NOT NULL,
  `tagihan` int(11) NOT NULL,
  `ket_kunjungan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kunjungan_pasien`
--

INSERT INTO `kunjungan_pasien` (`id_kunjungan`, `id_jadwal`, `id_tindakan`, `keluhan`, `jumlah`, `tagihan`, `ket_kunjungan`) VALUES
(1, 14, 1, 'Gigi Berlubang', 1, 100000, ''),
(3, 16, 2, 'Gigi Keropos', 1, 100000, ''),
(4, 17, 4, 'Gigi Ompong', 2, 400000, ''),
(5, 18, 4, 'Gigi Ompong', 3, 600000, ''),
(6, 15, 1, 'Gigi Berlubang', 3, 300000, ''),
(7, 19, 1, 'Gigi Berlubang', 2, 200000, ''),
(8, 20, NULL, '', 0, 0, ''),
(9, 21, 7, 'Gigi  geraham belakang sakit dan linu', 2, 400000, ''),
(10, 22, 1, 'Gigi Sakit', 1, 250000, ''),
(11, 23, 7, 'Gigi Berlubang dan sakit', 2, 500000, ''),
(12, 24, NULL, '', 0, 0, ''),
(13, 25, NULL, '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tanggal_pasien`
--

CREATE TABLE `tanggal_pasien` (
  `id_tanggal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `ket_tanggal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tanggal_pasien`
--

INSERT INTO `tanggal_pasien` (`id_tanggal`, `tanggal`, `status`, `ket_tanggal`) VALUES
(1, '2023-02-01', 1, ''),
(2, '2023-02-02', 1, ''),
(3, '2023-02-03', 1, ''),
(4, '2023-02-04', 1, ''),
(5, '2023-02-06', 1, ''),
(6, '2023-02-07', 1, ''),
(7, '2023-02-08', 1, ''),
(8, '2023-02-09', 1, ''),
(9, '2023-02-10', 1, ''),
(10, '2023-02-11', 1, ''),
(11, '2023-02-13', 1, ''),
(12, '2023-02-14', 1, ''),
(13, '2023-02-15', 1, ''),
(14, '2023-02-16', 1, ''),
(15, '2023-02-17', 1, ''),
(16, '2023-02-18', 1, ''),
(17, '2023-02-20', 1, ''),
(18, '2023-02-21', 1, ''),
(19, '2023-02-22', 1, ''),
(20, '2023-02-23', 1, ''),
(21, '2023-02-24', 1, ''),
(22, '2023-02-25', 1, ''),
(23, '2023-02-27', 1, ''),
(24, '2023-02-28', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(8) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `password`, `email`, `alamat`, `no_hp`, `level`) VALUES
(1, 'admin', 'Nadia Kamila', '$2y$10$1/jK4CCVXdzksyoJBmvBiuRY0847UD0lT123YEPj3cH3ARpoQXVqC', 'admin@gmail.com', 'jalan. inaja dulu dah', '0816591527', 'Resepsionis'),
(2, 'dokter', 'Drg. Bilal Zaidan', '$2y$10$llceyEg5X5nBu9dWHJ3WIeS01qB1soCnmyOxFv0ZfVJjMjtuRfufG', 'bilal@gmail.com', 'Badean, Bondowoso', '0816591527', 'Dokter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pasien`
--
ALTER TABLE `data_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_jam` (`id_jam`),
  ADD KEY `id_tanggal` (`id_tanggal`);

--
-- Indexes for table `jam_periksa`
--
ALTER TABLE `jam_periksa`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indexes for table `kunjungan_pasien`
--
ALTER TABLE `kunjungan_pasien`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `id_pasien` (`id_jadwal`),
  ADD KEY `id_proses` (`id_tindakan`);

--
-- Indexes for table `tanggal_pasien`
--
ALTER TABLE `tanggal_pasien`
  ADD PRIMARY KEY (`id_tanggal`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pasien`
--
ALTER TABLE `data_pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `jam_periksa`
--
ALTER TABLE `jam_periksa`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kunjungan_pasien`
--
ALTER TABLE `kunjungan_pasien`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tanggal_pasien`
--
ALTER TABLE `tanggal_pasien`
  MODIFY `id_tanggal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `jadwal_periksa_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `data_pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_periksa_ibfk_2` FOREIGN KEY (`id_jam`) REFERENCES `jam_periksa` (`id_jam`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_periksa_ibfk_3` FOREIGN KEY (`id_tanggal`) REFERENCES `tanggal_pasien` (`id_tanggal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kunjungan_pasien`
--
ALTER TABLE `kunjungan_pasien`
  ADD CONSTRAINT `kunjungan_pasien_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kunjungan_pasien_ibfk_2` FOREIGN KEY (`id_tindakan`) REFERENCES `tindakan` (`id_tindakan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
