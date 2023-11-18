-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 11:14 AM
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
('BR-IP290', 'Iphone 12s', 0, 0, 0, 3, 7, '2023-11-18 16:03:34', NULL, NULL),
('BR-IP835', 'Iphone 13s', 0, 10000000, 25, 3, 7, '2023-11-17 23:37:39', 7, '2023-11-18 10:50:13');

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
('B20231118103021SUP-MT37', '2023-11-18 10:30:21', 'SUP-MT3', 7, 80000000),
('B20231118105506SUP-PIs97', '2023-11-18 10:55:06', 'SUP-PIs9', 7, 280000000);

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
(4, 'B20231118103021SUP-MT37', 'BR-IP835', 'Iphone 13s', 8000000, 10, 80000000),
(5, 'B20231118105506SUP-PIs97', 'BR-IP835', 'Iphone 13s', 14000000, 20, 280000000);

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
(1, '202311180956189', NULL, 'Iphone 12', 10000000, 12000000, 1, 0, 12000000),
(2, '202311181000347', NULL, 'Iphone 12', 10000000, 12000000, 27, 0, 324000000),
(3, '202311181032187', 'BR-IP835', 'Iphone 13s', 0, 10000000, 5, 25, 37500000);

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
('202311180956189', '2023-11-18 15:56:18', 12000000, 12500000, 500000, 9),
('202311181000347', '2023-11-18 16:00:34', 324000000, 400000000, 76000000, 7),
('202311181032187', '2023-11-18 16:32:18', 37500000, 40000000, 2500000, 7);

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
(3, 'Iphoness'),
(4, 'Xiamo');

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
(5, 'panjuls', '098098092890', 'bekasi', '879182102', '2023-11-15', '2023-11-17');

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
('SUP-MT3', 'PT. Matahari Rakyat Besa', 'JAtinegara', '08999912', 3, '2023-11-14 14:28:17', '2023-11-14 08:28:57'),
('SUP-PIs9', 'PT. Matahari Updated', 'bekasi', '0899999', 7, '2023-11-17 23:39:51', NULL);

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
(3, 'admins', 'admin', 'ADMIN', 1),
(7, 'tius', 'tius', 'ADMIN', 4),
(9, 'dimas', 'mitra123', 'STAFF', 5);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_jual`
--
ALTER TABLE `detail_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
