-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 05:17 AM
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
-- Table structure for table `admin_dash`
--

CREATE TABLE `admin_dash` (
  `id` int(11) NOT NULL,
  `nim_mhs` varchar(50) NOT NULL,
  `nm_mhs` varchar(50) NOT NULL,
  `semester` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `total_tdk_hadir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_dash`
--

INSERT INTO `admin_dash` (`id`, `nim_mhs`, `nm_mhs`, `semester`, `kelas`, `prodi`, `total_tdk_hadir`) VALUES
(1, 'c030321124', 'Muhammad Haris', 4, 'Axioo', 'Teknik Informatika', 5),
(2, 'c030321125', 'Ahmad Hafis', 4, 'Axioo', 'Teknik Informatika', 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin_kompen`
--

CREATE TABLE `admin_kompen` (
  `id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jml_mhs` int(11) NOT NULL,
  `jml_jam` int(11) NOT NULL,
  `pengawas` varchar(50) NOT NULL,
  `tempat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_kompen`
--

INSERT INTO `admin_kompen` (`id`, `semester`, `kelas`, `jml_mhs`, `jml_jam`, `pengawas`, `tempat`) VALUES
(1, 4, 'Axioo', 25, 64, 'Ibu Rahimi', 'Gedung H'),
(2, 5, 'Axioo', 12, 80, 'Wanvy', 'Gedung D');

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
(2, 'c030321124', 4, 'Artificial Intelligen', '2023-01-11', 14, 'Alfa'),
(3, 'c030321124', 4, 'Basis Data', '2023-06-10', 16, 'Alfa'),
(4, 'c030321124', 4, 'Basis Data', '2023-06-23', 11, 'Hadir'),
(5, 'c030321124', 4, 'Artificial Intelligen', '2023-06-07', 10, 'Izin'),
(6, 'c030321125', 2, 'Artificial Intelligen', '2023-06-15', 16, 'Alfa'),
(7, 'c030321124', 4, 'Artificial Intelligen', '2023-06-27', 20, 'Sakit'),
(8, 'c030321124', 2, 'Basis Data', '2023-06-10', 10, 'Izin');

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
('c030321124', 'Ahmad Fadli', 4, 'Axioo', 'Teknik Elektro', 'Teknik Informatika'),
('c030321125', 'VanZ', 4, 'Axioo', 'Teknik Elektro', 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `sks` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `nama`, `sks`, `jenis`) VALUES
('c111111', 'Artificial Intelligen', 12, 'Jurusan'),
('c222222', 'Basis Data', 12, 'Jurusan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_induk` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `no_induk`, `role`) VALUES
(4, 'adi fuadi', '$2y$10$ym/sNHp8E0kkeN9dp42/Te7b7Fyqf5epya//tUDvhOCEV4fun2qvC', 'c030321124', 'mahasiswa'),
(5, 'poliban', '$2y$10$Ijvs8Ct8sXD4CARqoADOp.gKlh5MTM4jCigTZ.Dp5Ja5FvE66ggri', 'poliban123', 'admin'),
(6, 'vanzora', '$2y$10$f9vfym7KRtIHe32nDPz7Ge/4QGLXzDfFe3.kcBV/pxig//fhzUPcy', 'c030321125', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_dash`
--
ALTER TABLE `admin_dash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_kompen`
--
ALTER TABLE `admin_kompen`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_dash`
--
ALTER TABLE `admin_dash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_kompen`
--
ALTER TABLE `admin_kompen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_valid`
--
ALTER TABLE `admin_valid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logabsen`
--
ALTER TABLE `logabsen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logabsen`
--
ALTER TABLE `logabsen`
  ADD CONSTRAINT `logabsen_ibfk_2` FOREIGN KEY (`nm_matkul`) REFERENCES `matkul` (`nama`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `logabsen_ibfk_3` FOREIGN KEY (`nim_mhs`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
