-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 07:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kompen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_kompen`
--

CREATE TABLE `admin_kompen` (
  `kode_kompen` varchar(50) NOT NULL,
  `semester` int(11) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jml_mhs` int(11) NOT NULL,
  `nik_pengawas` varchar(50) NOT NULL,
  `kode_ruang` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `waktu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_kompen`
--

INSERT INTO `admin_kompen` (`kode_kompen`, `semester`, `prodi`, `kelas`, `jml_mhs`, `nik_pengawas`, `kode_ruang`, `tanggal`, `waktu`) VALUES
('07202311053937', 4, 'Teknik Informatika', 'Axioo', 3, 'dimas123', '01', '2023-07-12', '2023-07-27');

-- --------------------------------------------------------

--
-- Table structure for table `admin_valid`
--

CREATE TABLE `admin_valid` (
  `id` int(11) NOT NULL,
  `nim_mhs` int(50) NOT NULL,
  `nm_mhs` int(50) NOT NULL,
  `semester` int(11) NOT NULL,
  `prodi` int(50) NOT NULL,
  `kelas` int(50) NOT NULL,
  `v_kprodi` varchar(50) NOT NULL,
  `v_klab` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logabsen`
--

CREATE TABLE `logabsen` (
  `id` int(11) NOT NULL,
  `nim_mhs` varchar(50) NOT NULL,
  `semester` int(11) NOT NULL,
  `nm_matkul` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `pertemuan` int(11) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logabsen`
--

INSERT INTO `logabsen` (`id`, `nim_mhs`, `semester`, `nm_matkul`, `tanggal`, `pertemuan`, `ket`) VALUES
(2, 'z030321124', 4, 'Artificial Intelligen', '2023-01-11', 14, 'Alfa'),
(3, 'z030321124', 4, 'Basis Data', '2023-06-10', 16, 'Alfa'),
(4, 'z030321124', 4, 'Basis Data', '2023-06-23', 11, 'Hadir'),
(5, 'z030321124', 4, 'Artificial Intelligen', '2023-06-07', 10, 'Izin'),
(6, 'z030321125', 2, 'Artificial Intelligen', '2023-06-15', 16, 'Alfa'),
(7, 'z030321124', 4, 'Artificial Intelligen', '2023-06-27', 20, 'Sakit'),
(8, 'z030321124', 2, 'Basis Data', '2023-06-10', 10, 'Izin'),
(9, 'a030321122', 4, 'Artificial Intelligen', '2023-06-23', 11, 'Izin'),
(10, 'a030321122', 4, 'Algoritma', '2023-06-21', 8, 'Sakit'),
(11, 'z030321111', 4, 'Artificial Intelligen', '2023-06-08', 11, 'Hadir'),
(12, 'z030321110', 4, 'Basis Data', '2023-06-08', 16, 'Alfa'),
(13, 'z030321124', 4, 'Metode Numerik', '2023-06-14', 14, 'Hadir'),
(17, 'a030321122', 4, 'Artificial Intelligen', '2023-06-14', 16, 'Sakit'),
(18, 'z030321125', 4, 'Metode Numerik', '2023-06-02', 13, 'Alfa'),
(22, 'd030321119', 4, 'Basis Data', '2023-06-01', 1, 'Hadir'),
(23, 'd030321119', 4, 'Algoritma', '2023-06-01', 13, 'Alfa'),
(24, 'c030321124', 1, 'Artificial Intelligen', '2023-06-01', 12, 'Alfa'),
(25, 'c030321124', 2, 'Metode Numerik', '2023-06-03', 13, 'Alfa');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `semester` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `semester`, `kelas`, `jurusan`, `prodi`) VALUES
('a030321122', 'Abdul Wahid', 4, 'A', 'Teknik Elektro', 'Teknik Informatika'),
('a030321123', 'Rahmat Ujang', 4, 'A', 'Teknik Elektro', 'Teknik Informatika'),
('a030321124', 'Ahmad Hamid', 4, 'A', 'Teknik Elektro', 'Teknik Informatika'),
('b030321120', 'Layla Nur Sabrina', 4, 'B', 'Teknik Elektro', 'Teknik Informatika'),
('b030321129', 'Rina Fardina', 4, 'B', 'Teknik Elektro', 'Teknik Informatika'),
('c030321120', 'Muhammad Abbas', 2, 'C', 'Teknik Elektro', 'Teknik Informatika'),
('c030321124', 'Saman Habib', 2, 'C', 'Teknik Elektro', 'Teknik Informatika'),
('d030321111', 'Raiden Shogun', 4, 'D', 'Teknik Elektro', 'Teknik Informatika'),
('d030321112', 'Farhan', 4, 'D', 'Teknik Elektro', 'Teknik Informatika'),
('d030321119', 'Alghi', 4, 'D', 'Teknik Elektro', 'Teknik Informatika'),
('z030321110', 'Eula', 4, 'Axioo', 'Teknik Elektro', 'Teknik Informatika'),
('z030321111', 'Jingyuan', 4, 'Axioo', 'Teknik Elektro', 'Teknik Informatika'),
('z030321124', 'Ahmad Fadli', 4, 'Axioo', 'Teknik Elektro', 'Teknik Informatika'),
('z030321125', 'VanZ', 4, 'Axioo', 'Teknik Elektro', 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jam` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `nm_dosen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `nama`, `jam`, `jenis`, `nm_dosen`) VALUES
('c111111', 'Artificial Intelligen', 8, 'Jurusan', 'Udin sakadut'),
('c222222', 'Basis Data', 4, 'Jurusan', 'Dimas Banjar'),
('c333333', 'Metode Numerik', 4, 'Umum', 'Jamet Penghutang'),
('c444444', 'Algoritma', 8, 'Jurusan', 'Samsat');

-- --------------------------------------------------------

--
-- Table structure for table `mhs_kegiatan`
--

CREATE TABLE `mhs_kegiatan` (
  `id` int(11) NOT NULL,
  `nim_mhs` varchar(50) NOT NULL,
  `kode_kompen` varchar(50) NOT NULL,
  `kegiatan` varchar(50) NOT NULL,
  `durasi` int(11) NOT NULL,
  `tuntas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mhs_kegiatan`
--

INSERT INTO `mhs_kegiatan` (`id`, `nim_mhs`, `kode_kompen`, `kegiatan`, `durasi`, `tuntas`) VALUES
(222, 'z030321124', '07202311053937', 'Menyapu', 24, 'ya'),
(223, 'z030321110', '07202311053937', '-', 0, 'belum'),
(224, 'z030321125', '07202311053937', '-', 0, 'belum'),
(225, 'z030321124', '07202311053937', 'ASSASA', 32, 'ya');

-- --------------------------------------------------------

--
-- Table structure for table `mhs_kompen`
--

CREATE TABLE `mhs_kompen` (
  `id` int(11) NOT NULL,
  `kode_kompen` varchar(50) NOT NULL,
  `nim_mhs` varchar(50) NOT NULL,
  `jml_jam` int(50) NOT NULL,
  `nik_pengawas` varchar(50) NOT NULL,
  `v_pengawas` varchar(50) NOT NULL,
  `v_aprodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mhs_kompen`
--

INSERT INTO `mhs_kompen` (`id`, `kode_kompen`, `nim_mhs`, `jml_jam`, `nik_pengawas`, `v_pengawas`, `v_aprodi`) VALUES
(119, '07202311053937', 'z030321124', 56, 'dimas123', '-', '-'),
(120, '07202311053937', 'z030321110', 8, 'dimas123', '-', '-'),
(121, '07202311053937', 'z030321125', 8, 'dimas123', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pengawas`
--

CREATE TABLE `pengawas` (
  `nik` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengawas`
--

INSERT INTO `pengawas` (`nik`, `nama`, `jurusan`) VALUES
('dimas123', 'Dimas', 'Teknik Informatika'),
('jamet123', 'Jametz', 'Teknik Informatika'),
('udin123', 'Udin', 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tempat`
--

CREATE TABLE `tempat` (
  `kode_ruang` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kalab` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat`
--

INSERT INTO `tempat` (`kode_ruang`, `nama`, `kalab`) VALUES
('01', 'Ruang RPL', 'Rio'),
('02', 'Ruang Multimedia', 'Dirsa'),
('03', 'Ruang UPT 1', 'Fuadi');

-- --------------------------------------------------------

--
-- Table structure for table `tgs_pengawas`
--

CREATE TABLE `tgs_pengawas` (
  `id` int(11) NOT NULL,
  `kode_kompen` varchar(50) NOT NULL,
  `nik_pengawas` varchar(50) NOT NULL,
  `semester` int(11) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jml_mhs` int(11) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `progress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tgs_pengawas`
--

INSERT INTO `tgs_pengawas` (`id`, `kode_kompen`, `nik_pengawas`, `semester`, `prodi`, `kelas`, `jml_mhs`, `tempat`, `tanggal`, `waktu`, `progress`) VALUES
(84, '07202311053937', 'dimas123', 4, 'Teknik Informatika', 'Axioo', 3, '01', '2023-07-12', '01', 'OTW');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `passuser` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `passuser`, `role`) VALUES
(19, 'a030321122', '$2y$10$VpGzHC.dkJyT9DNt6BWTEeYQJNtzrjxGU/CpdbJ2Jc8FooulLryRq', 'admin', 'mahasiswa'),
(20, 'd030321119', '$2y$10$raYrgUinvXoxCCiDCZoVpe.SO7QnTsWMSOOOyTb6tyFKayB8lAcHu', 'admin', 'mahasiswa'),
(21, 'z030321110', '$2y$10$vDAr5EzB1n41xmhDKlnN9uZfwVoWBnAYhoGmbkWPhEv.WWtVTXa7.', 'admin', 'mahasiswa'),
(22, 'z030321111', '$2y$10$FCpXt/Vp.K.WHrerqDb2i.QuPhtCoJawOSN3KWJFf9ZVf1mLFphnO', 'admin', 'mahasiswa'),
(23, 'z030321124', '$2y$10$GJ7wrn0jfylyjESDS43uAe/Yh6HLRiVuvwc1U0sh68bXZLOUARea6', 'admin', 'mahasiswa'),
(24, 'z030321125', '$2y$10$iKi3bOPxX.fGBmDzzTqwtuUNrvCDhQiwdAlWHtMPysEXBNvyh7AEm', 'admin', 'mahasiswa'),
(25, 'dimas123', '$2y$10$XUy.16uosXWxEwctsrnNuuyXVU7j9Ut9sP5.jx.rZzW5UIoqbQyIO', 'admin', 'pengawas'),
(26, 'admin', '$2y$10$Gvj5Ae0T4igFVFlUtMpNPOGCo2/qDnz9NauZuawo137Vp/d6tImzq', '-', 'admin'),
(27, 'jamet123', '$2y$10$qdVzulWgpWJ1zJoH3eRj0uZdR903woGBaJE6/9PQlTw5O8Y1YfHBW', 'admin', 'pengawas'),
(28, 'udin123', '$2y$10$MnM5v4g/A6K00nz8iPH2henKIw4d6R7HrXckosYcUYQ1i9EguPYRC', 'admin', 'pengawas'),
(29, 'c030321124', '$2y$10$P3NnhVzhDpem8yweLtL4X.xodNTzMUZR2fdHJkziryYjuNhAyXNia', 'admin', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_kompen`
--
ALTER TABLE `admin_kompen`
  ADD PRIMARY KEY (`kode_kompen`),
  ADD KEY `pengawas` (`nik_pengawas`),
  ADD KEY `kode_ruang` (`kode_ruang`);

--
-- Indexes for table `admin_valid`
--
ALTER TABLE `admin_valid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logabsen`
--
ALTER TABLE `logabsen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim_mhs` (`nim_mhs`),
  ADD KEY `nm_matkul` (`nm_matkul`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `nama` (`nama`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`),
  ADD KEY `nama` (`nama`);

--
-- Indexes for table `mhs_kegiatan`
--
ALTER TABLE `mhs_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim_mhs` (`nim_mhs`,`kode_kompen`),
  ADD KEY `kode_kompen` (`kode_kompen`);

--
-- Indexes for table `mhs_kompen`
--
ALTER TABLE `mhs_kompen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim_mhs` (`nim_mhs`),
  ADD KEY `nik_pengawas` (`nik_pengawas`),
  ADD KEY `id_tgs_pengawas` (`kode_kompen`);

--
-- Indexes for table `pengawas`
--
ALTER TABLE `pengawas`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`kode_ruang`);

--
-- Indexes for table `tgs_pengawas`
--
ALTER TABLE `tgs_pengawas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik_pengawas` (`nik_pengawas`),
  ADD KEY `id_admin_kompen` (`kode_kompen`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_valid`
--
ALTER TABLE `admin_valid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logabsen`
--
ALTER TABLE `logabsen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mhs_kegiatan`
--
ALTER TABLE `mhs_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `mhs_kompen`
--
ALTER TABLE `mhs_kompen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `tgs_pengawas`
--
ALTER TABLE `tgs_pengawas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_kompen`
--
ALTER TABLE `admin_kompen`
  ADD CONSTRAINT `admin_kompen_ibfk_1` FOREIGN KEY (`nik_pengawas`) REFERENCES `pengawas` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_kompen_ibfk_2` FOREIGN KEY (`kode_ruang`) REFERENCES `tempat` (`kode_ruang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logabsen`
--
ALTER TABLE `logabsen`
  ADD CONSTRAINT `logabsen_ibfk_2` FOREIGN KEY (`nm_matkul`) REFERENCES `matkul` (`nama`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `logabsen_ibfk_3` FOREIGN KEY (`nim_mhs`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mhs_kegiatan`
--
ALTER TABLE `mhs_kegiatan`
  ADD CONSTRAINT `mhs_kegiatan_ibfk_1` FOREIGN KEY (`kode_kompen`) REFERENCES `admin_kompen` (`kode_kompen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mhs_kompen`
--
ALTER TABLE `mhs_kompen`
  ADD CONSTRAINT `mhs_kompen_ibfk_1` FOREIGN KEY (`nik_pengawas`) REFERENCES `pengawas` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_kompen_ibfk_2` FOREIGN KEY (`kode_kompen`) REFERENCES `admin_kompen` (`kode_kompen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tgs_pengawas`
--
ALTER TABLE `tgs_pengawas`
  ADD CONSTRAINT `tgs_pengawas_ibfk_1` FOREIGN KEY (`nik_pengawas`) REFERENCES `pengawas` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tgs_pengawas_ibfk_2` FOREIGN KEY (`kode_kompen`) REFERENCES `admin_kompen` (`kode_kompen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
