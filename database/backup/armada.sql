-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 Nov 2016 pada 10.08
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luthansa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `armada`
--

CREATE TABLE `armada` (
  `id` int(11) NOT NULL,
  `armada_category_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_booking` tinyint(1) NOT NULL,
  `booking_from_date` date NOT NULL,
  `booking_to_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `armada`
--

INSERT INTO `armada` (`id`, `armada_category_id`, `company_id`, `number`, `is_active`, `is_booking`, `booking_from_date`, `booking_to_date`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, 'B 8909 BXL', 1, 0, '0000-00-00', '0000-00-00', 0, '0000-00-00 00:00:00', NULL, NULL),
(2, 1, 1, 'B 1510 DX', 1, 0, '0000-00-00', '0000-00-00', 1, '2016-11-01 15:47:52', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armada`
--
ALTER TABLE `armada`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armada`
--
ALTER TABLE `armada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
