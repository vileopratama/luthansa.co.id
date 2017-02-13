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
-- Struktur dari tabel `armada_categories`
--

CREATE TABLE `armada_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `capacity` int(3) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `armada_categories`
--

INSERT INTO `armada_categories` (`id`, `name`, `capacity`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Commuter Hi-Ace 15 Seats', 15, 1, 1, '2016-10-11 05:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Elf Long 19 Seats', 19, 1, 1, '2016-10-11 05:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Elf Long 21 Seats', 21, 1, 1, '2016-10-03 07:00:00', NULL, NULL),
(4, 'Medium Bus 31 Seats', 31, 1, 1, '2016-10-11 05:00:00', NULL, NULL),
(5, 'Big Bus 59 Seats', 59, 0, 1, '2016-10-11 20:00:00', NULL, NULL),
(6, 'Elft', 10, 1, 1, '2016-11-01 12:11:51', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armada_categories`
--
ALTER TABLE `armada_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armada_categories`
--
ALTER TABLE `armada_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
