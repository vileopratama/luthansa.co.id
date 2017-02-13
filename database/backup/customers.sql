-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 Nov 2016 pada 10.09
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
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'Individual',
  `phone_number` varchar(18) NOT NULL,
  `mobile_number` varchar(18) DEFAULT NULL,
  `fax_number` varchar(18) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(5) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `type`, `phone_number`, `mobile_number`, `fax_number`, `address`, `city`, `zip_code`, `is_active`, `remember_token`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Suhendar', 'hendarsyahss@gmail.com', '', 'Corporate', '08522205406', '08522205406', '', 'Jalan pegangsaan TImur No.80 ', 'DKI Jakarta', '12090', 1, '', '2016-11-01', 1, '2016-11-03', 1),
(2, 'PT One Piece Sekatung', '', '', 'Corporate', '', NULL, '', '', '', '', 1, '', '2016-11-02', 1, '0000-00-00', 0),
(3, 'Suhendar', 'hendarsyahss2@gmail.com', '$2y$10$vPpWJqXZdL5JVZd4hX1ua.5t.g.Kn5Ucu3VeCI0fvAFu.qnsdRFhm', '''Corporate'',''Individual''', '', NULL, '', '', '', '', 1, '', '0000-00-00', 0, '0000-00-00', 0),
(4, 'Suhendar', 'hendarsyahss3@gmail.com', '$2y$10$U.mnsdyDAUtaoUDUA3v8q.7ion02cwkgV9iMxE/50B4tiDp8Wg2t2', '''Corporate'',''Individual''', '', NULL, '', '', '', '', 1, '', '0000-00-00', 0, '0000-00-00', 0),
(5, 'Suhendar', 'hendarsyahss4@gmail.com', '$2y$10$zAJ.czNBrkDbAb/0uJo/CuyIvMfKXMyh6Ooqu04633bzN/EDys/HK', 'Individual', '', NULL, '', '', '', '', 1, '', '0000-00-00', 0, '0000-00-00', 0),
(6, 'Suhendar', 'hendarsyahss5@gmail.com', '$2y$10$WWKm.DX1VeelqSYYAvrcHugt2GqQIrm5porm7QAO0uRW1rRtmyMtW', 'Individual', '', NULL, '', '', '', '', 1, '', '0000-00-00', 0, '0000-00-00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
