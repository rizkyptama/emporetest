-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2020 at 05:38 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `empore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `kd_buku` varchar(10) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `stok_buku` int(11) NOT NULL,
  `no_rak` int(11) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`kd_buku`, `judul_buku`, `penerbit`, `pengarang`, `tahun_terbit`, `stok_buku`, `no_rak`, `kategori`, `created_at`, `updated_at`, `deleted_at`) VALUES
('BUK1', 'Abjad', 'Guruw', 'Guruw', 2019, 5, 12, 'Belajar', NULL, '2020-01-30 13:41:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjaman`
--

CREATE TABLE `tbl_pinjaman` (
  `kd_pinjam` varchar(20) NOT NULL,
  `kd_user` varchar(20) NOT NULL,
  `kd_buku` varchar(20) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pinjaman`
--

INSERT INTO `tbl_pinjaman` (`kd_pinjam`, `kd_user`, `kd_buku`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('PJM1', 'USR1', 'BUK1', '2020-01-30', '2020-01-31', 'sudah dikembalikan', NULL, '2020-01-30 16:27:27', NULL),
('PJM2', 'USR1', 'BUK1', '2020-01-30', '2020-01-31', 'sudah dikembalikan', NULL, '2020-01-30 16:37:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `kd_user` varchar(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `type` enum('admin','user') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`kd_user`, `username`, `password`, `nama`, `no_hp`, `email`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ADM1', 'admin', '$2y$10$DHOKYUvrLawC.KhsPC4GLeACwF4nj9kzMHq9gEL6407DZ9w4m2Rci', 'admin', '', NULL, 'admin', NULL, '2020-01-29 16:08:22', NULL),
('USR1', 'user1', '$2y$10$1XgzLzmRn5kcCdj8sZFYZejKNrsgBNg3o7jdZxueQsqMOPghmWWNi', 'User1', '1234567890', 'user1@mail.com', 'user', NULL, '2020-01-30 14:10:51', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`kd_buku`);

--
-- Indexes for table `tbl_pinjaman`
--
ALTER TABLE `tbl_pinjaman`
  ADD PRIMARY KEY (`kd_pinjam`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`kd_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
