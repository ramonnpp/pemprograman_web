-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 04:49 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_5622`
--

-- --------------------------------------------------------

--
-- Table structure for table `gudang_5622`
--

CREATE TABLE `gudang_5622` (
  `kode_gudang` char(6) NOT NULL,
  `nama_gudang` varchar(25) NOT NULL,
  `alamat_gudang` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gudang_5622`
--

INSERT INTO `gudang_5622` (`kode_gudang`, `nama_gudang`, `alamat_gudang`) VALUES
('G_1', 'Gudang Motor', 'Maguwo'),
('G_2', 'Gudang Mobil', 'Mancasan');

-- --------------------------------------------------------

--
-- Table structure for table `produk_5622`
--

CREATE TABLE `produk_5622` (
  `kode_produk` char(6) NOT NULL,
  `kode_gudang` char(6) DEFAULT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `harga_produk` int NOT NULL,
  `deskripsi_produk` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk_5622`
--

INSERT INTO `produk_5622` (`kode_produk`, `kode_gudang`, `nama_produk`, `harga_produk`, `deskripsi_produk`) VALUES
('P_1', 'G_1', 'Mio Karbu', 5000000, 'Tahun 2003'),
('P_2', 'G_2', 'Ioniq 5N', 1000000000, 'Tahun 2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gudang_5622`
--
ALTER TABLE `gudang_5622`
  ADD PRIMARY KEY (`kode_gudang`);

--
-- Indexes for table `produk_5622`
--
ALTER TABLE `produk_5622`
  ADD PRIMARY KEY (`kode_produk`),
  ADD KEY `kode_gudang` (`kode_gudang`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk_5622`
--
ALTER TABLE `produk_5622`
  ADD CONSTRAINT `produk_5622_ibfk_1` FOREIGN KEY (`kode_gudang`) REFERENCES `gudang_5622` (`kode_gudang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
