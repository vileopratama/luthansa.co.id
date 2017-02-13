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
-- Struktur dari tabel `sales_invoice_armada`
--

CREATE TABLE `sales_invoice_armada` (
  `id` int(11) NOT NULL,
  `sales_invoice_id` int(11) NOT NULL,
  `armada_id` int(11) NOT NULL,
  `booking_from_date` date NOT NULL,
  `booking_to_date` date NOT NULL,
  `booking_total_days` int(3) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sales_invoice_armada`
--

INSERT INTO `sales_invoice_armada` (`id`, `sales_invoice_id`, `armada_id`, `booking_from_date`, `booking_to_date`, `booking_total_days`, `updated_at`, `updated_by`) VALUES
(3, 3, 2, '2016-11-09', '2016-11-10', 2, '2016-11-07 16:49:33', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_invoice_armada`
--
ALTER TABLE `sales_invoice_armada`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_invoice_armada`
--
ALTER TABLE `sales_invoice_armada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
