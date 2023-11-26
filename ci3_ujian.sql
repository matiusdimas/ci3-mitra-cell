-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2023 at 02:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci3_ujian`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harpok` int(11) NOT NULL,
  `harjul` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id_last_updated` int(11) DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode`, `nama`, `harpok`, `harjul`, `stok`, `kategori_id`, `user_id`, `createdAt`, `user_id_last_updated`, `updatedAt`) VALUES
('BR-AS9', 'ASUS 90', 10000000, 12000000, 60, 5, 7, '2023-11-26 20:05:56', NULL, NULL),
('BR-IP835', 'Iphone 12', 14000000, 16800000, 0, 3, 7, '2023-11-21 19:46:23', 7, '2023-11-21 13:50:50'),
('BR_IP22', 'Iphone 12asd', 4000000, 4800000, 0, 3, 7, '2023-11-21 20:02:25', 7, '2023-11-21 14:02:48'),
('BR_IP835s', 'Iphone 13', 20000000, 24000000, 0, 3, 7, '2023-11-21 19:46:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `nofak` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `supplier_kode` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`nofak`, `createdAt`, `supplier_kode`, `user_id`, `total`) VALUES
('B20231121140023SUP-MT37', '2023-11-21 14:00:23', 'SUP-MT3', 7, 320000000),
('B20231121140121SUP-CI907', '2023-11-21 14:01:21', 'SUP-CI90', 7, 750000000),
('B20231121140311SUP-CI907', '2023-11-21 14:03:11', 'SUP-CI90', 7, 450000000),
('B20231121152054SUP-CI907', '2023-11-21 15:20:54', 'SUP-CI90', 7, 400000000),
('B20231125080528SUP-PIs97', '2023-11-25 08:05:28', 'SUP-PIs9', 7, 142500000),
('B20231125083849SUP-MT37', '2023-11-25 08:38:49', 'SUP-MT3', 7, 80000000),
('B20231125084227SUP-MT37', '2023-11-25 08:42:27', 'SUP-MT3', 7, 200000000),
('B20231125084254SUP-MT37', '2023-11-25 08:42:54', 'SUP-MT3', 7, 10000000),
('B20231125084435SUP-MT37', '2023-11-25 08:44:35', 'SUP-MT3', 7, 200000000),
('B20231125084854SUP-CI907', '2023-11-25 08:48:54', 'SUP-CI90', 7, 4000000),
('B20231125085137SUP-MT37', '2023-11-25 08:51:37', 'SUP-MT3', 7, 4000000),
('B20231125085317SUP-MT37', '2023-11-25 08:53:17', 'SUP-MT3', 7, 4000000),
('B20231125085501SUP-PIs97', '2023-11-25 08:55:01', 'SUP-PIs9', 7, 140000000),
('B20231126140620SUP-SD907', '2023-11-26 14:06:20', 'SUP-SD90', 7, 1000000000),
('beli1', '2022-09-01 19:59:00', 'SUP-CI90', 3, 2000000000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_beli`
--

CREATE TABLE `detail_beli` (
  `id` int(11) NOT NULL,
  `beli_nofak` varchar(255) NOT NULL,
  `barang_kode` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_beli`
--

INSERT INTO `detail_beli` (`id`, `beli_nofak`, `barang_kode`, `nama`, `harga`, `jumlah`, `total`) VALUES
(1, 'B20231121140023SUP-MT37', 'BR_IP835s', 'Iphone 13', 12000000, 10, 120000000),
(2, 'B20231121140023SUP-MT37', 'BR-IP835', 'Iphone 12', 20000000, 10, 200000000),
(3, 'B20231121140121SUP-CI907', 'BR-IP835', 'Iphone 12', 30000000, 10, 300000000),
(4, 'B20231121140121SUP-CI907', 'BR_IP835s', 'Iphone 13', 15000000, 30, 450000000),
(5, 'B20231121140311SUP-CI907', 'BR-IP835', 'Iphone 12', 25000000, 10, 250000000),
(6, 'B20231121140311SUP-CI907', 'BR_IP22', 'Iphone 12asd', 4000000, 50, 200000000),
(7, 'B20231121152054SUP-CI907', 'BR-IP835', 'Iphone 12', 20000000, 20, 400000000),
(9, 'B20231125080528SUP-PIs97', 'BR_IP835s', 'Iphone 13', 14250000, 10, 142500000),
(10, 'B20231125083849SUP-MT37', 'BR_IP22', 'Iphone 12asd', 4000000, 20, 80000000),
(11, 'B20231125084227SUP-MT37', 'BR-IP835', 'Iphone 12', 10000000, 20, 200000000),
(12, 'B20231125084254SUP-MT37', 'BR-IP835', 'Iphone 12', 10000000, 1, 10000000),
(13, 'B20231125084435SUP-MT37', 'BR_IP835s', 'Iphone 13', 20000000, 10, 200000000),
(14, 'B20231125084854SUP-CI907', 'BR-IP835', 'Iphone 12', 4000000, 1, 4000000),
(15, 'B20231125085137SUP-MT37', 'BR_IP22', 'Iphone 12asd', 4000000, 1, 4000000),
(16, 'B20231125085317SUP-MT37', 'BR-IP835', 'Iphone 12', 4000000, 1, 4000000),
(17, 'B20231125085501SUP-PIs97', 'BR-IP835', 'Iphone 12', 14000000, 10, 140000000),
(18, 'beli1', 'BR_IP22', 'IPhone 13', 2000000000, 1, 2000000000),
(19, 'B20231126140620SUP-SD907', 'BR-AS9', 'ASUS 90', 10000000, 100, 1000000000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_jual`
--

CREATE TABLE `detail_jual` (
  `id` int(11) NOT NULL,
  `jual_nofak` varchar(255) NOT NULL,
  `barang_kode` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `harpok` int(11) NOT NULL,
  `harjul` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_jual`
--

INSERT INTO `detail_jual` (`id`, `jual_nofak`, `barang_kode`, `nama`, `harpok`, `harjul`, `qty`, `diskon`, `total`) VALUES
(1, '202311211407037', 'BR-IP835', 'Iphone 12', 25000000, 30000000, 30, 0, 900000000),
(2, '202311211407037', 'BR_IP22', 'Iphone 12asd', 4000000, 4800000, 50, 0, 240000000),
(3, '202311211407037', 'BR_IP835s', 'Iphone 13', 14250000, 17100000, 40, 0, 684000000),
(4, '202311211522177', 'BR-IP835', 'Iphone 12', 20000000, 24000000, 20, 0, 480000000),
(5, '202311250807237', 'BR_IP835s', 'Iphone 13', 14250000, 17100000, 10, 0, 171000000),
(6, '202311250847407', 'BR-IP835', 'Iphone 12', 10000000, 12000000, 21, 0, 252000000),
(7, '202311250847407', 'BR_IP22', 'Iphone 12asd', 4000000, 4800000, 20, 0, 96000000),
(8, '202311250847407', 'BR_IP835s', 'Iphone 13', 20000000, 24000000, 10, 0, 240000000),
(9, '202311250849257', 'BR-IP835', 'Iphone 12', 4000000, 4800000, 1, 0, 4800000),
(10, '202311250852307', 'BR_IP22', 'Iphone 12asd', 4000000, 4800000, 1, 0, 4800000),
(11, '202311250854347', 'BR-IP835', 'Iphone 12', 4000000, 4800000, 1, 0, 4800000),
(12, '202311250855467', 'BR-IP835', 'Iphone 12', 14000000, 16800000, 10, 0, 168000000),
(13, 'jual1', 'BR-IP835', 'Iphone 12', 2000000000, 2100000000, 1, 0, 2100000000),
(14, '202311261407247', 'BR-AS9', 'ASUS 90', 10000000, 12000000, 40, 0, 480000000);

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `nofak` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL,
  `jml_uang` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`nofak`, `createdAt`, `total`, `jml_uang`, `kembalian`, `user_id`) VALUES
('202311211407037', '2023-11-21 20:07:03', 1824000000, 2000000000, 176000000, 7),
('202311211522177', '2023-11-21 21:22:17', 480000000, 480000000, 0, 7),
('202311250807237', '2023-11-25 14:07:23', 171000000, 171000000, 0, 7),
('202311250847407', '2023-11-25 14:47:40', 588000000, 588880000, 880000, 7),
('202311250849257', '2023-11-25 14:49:25', 4800000, 4800000, 0, 7),
('202311250852307', '2023-11-25 14:52:31', 4800000, 4800000, 0, 7),
('202311250854347', '2023-11-25 14:54:34', 4800000, 4800000, 0, 7),
('202311250855467', '2023-11-25 14:55:46', 168000000, 170000000, 2000000, 7),
('202311261407247', '2023-11-26 20:07:24', 480000000, 480000000, 0, 7),
('jual1', '2022-09-29 16:53:23', 2100000000, 2100000000, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori_nama`) VALUES
(2, 'OPPO'),
(3, 'Iphone'),
(4, 'Xiaomi'),
(5, 'Asus');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `nama`, `no_ktp`, `alamat`, `no_hp`, `createdAt`, `updatedAt`) VALUES
(1, 'matius', '3172138024421', 'bekasi', '0891111', '2023-11-09', NULL),
(4, 'tiuss', '317819830123', 'bekasi', '08213712312', '2023-11-15', '2023-11-17'),
(5, 'panjuls', '098098092890', 'bekasi', '879182102', '2023-11-15', '2023-11-17'),
(6, 'udin', '317123791389', 'bekasi', '082136713683', '2023-11-25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode`, `nama`, `alamat`, `no_telp`, `user_id`, `createdAt`, `updatedAt`) VALUES
('SUP-CI90', 'PT. Cemerlang Indo', 'lubang buaya', '0899012', 3, '2023-11-14 13:47:35', '2023-11-14 08:28:48'),
('SUP-MT3', 'PT. Matahari Rakyat Besa', 'Jatinegara', '08999912', 3, '2023-11-14 14:28:17', '2023-11-25 08:01:37'),
('SUP-PIs9', 'PT. Matahari Updated', 'bekasi', '0899999', 7, '2023-11-17 23:39:51', NULL),
('SUP-SD90', 'Sederhana', 'bekasi', '021376231938', 7, '2023-11-26 20:05:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('ADMIN','STAFF') NOT NULL DEFAULT 'STAFF',
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`, `staff_id`) VALUES
(3, 'admins', '$2y$10$QdkpxmlgsCXFg/61sgAKDOrX9dLrrTfenhqgef/CEbCQTWXDB8Ptu', 'ADMIN', 1),
(7, 'admin', '$2y$10$J3sx2jHaWFbCpOtUciEC9uyn6f0gsckCiXp1Dumdlmpqrw7Qe31qS', 'ADMIN', 4),
(9, 'dimas', '$2y$10$EWUqOagflm/ff7Fd.UT3GuT/oa0tp6whdMW5FCqEaZDhLByplAUBK', 'STAFF', 5),
(10, 'udin', '$2y$10$ZbdMhvuX3CdXXUTYGcdek.pghWk9L.rx/P8Nfy12vI703chHi7mCC', 'STAFF', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `user_id` (`user_id`,`user_id_last_updated`),
  ADD KEY `barang_ibfk_3` (`user_id_last_updated`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`nofak`),
  ADD KEY `supplier_id` (`supplier_kode`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `detail_beli`
--
ALTER TABLE `detail_beli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_kode` (`barang_kode`),
  ADD KEY `beli_nofak` (`beli_nofak`);

--
-- Indexes for table `detail_jual`
--
ALTER TABLE `detail_jual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jual_nofak` (`jual_nofak`),
  ADD KEY `kode_barang1` (`barang_kode`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`nofak`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_ktp` (`no_ktp`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `staff_id_2` (`staff_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `staff_id` (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_beli`
--
ALTER TABLE `detail_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `detail_jual`
--
ALTER TABLE `detail_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`user_id_last_updated`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_id` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `beli`
--
ALTER TABLE `beli`
  ADD CONSTRAINT `beli_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_kode` FOREIGN KEY (`supplier_kode`) REFERENCES `supplier` (`kode`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_beli`
--
ALTER TABLE `detail_beli`
  ADD CONSTRAINT `barang_kode` FOREIGN KEY (`barang_kode`) REFERENCES `barang` (`kode`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `beli_nofak` FOREIGN KEY (`beli_nofak`) REFERENCES `beli` (`nofak`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_jual`
--
ALTER TABLE `detail_jual`
  ADD CONSTRAINT `jual_nofak` FOREIGN KEY (`jual_nofak`) REFERENCES `jual` (`nofak`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kode_barang1` FOREIGN KEY (`barang_kode`) REFERENCES `barang` (`kode`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `jual`
--
ALTER TABLE `jual`
  ADD CONSTRAINT `jual_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
