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
-- Struktur dari tabel `sales_invoice_expense`
--

CREATE TABLE `sales_invoice_expense` (
  `id` int(11) NOT NULL,
  `sales_invoice_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `expense` double NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sales_invoice_expense`
--

INSERT INTO `sales_invoice_expense` (`id`, `sales_invoice_id`, `description`, `expense`, `created_by`, `created_at`) VALUES
(5, 2, 'Biaya Perawatan', 80000, 0, '0000-00-00 00:00:00'),
(7, 3, 'Biaya Tambahan Bensin', 10000, 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_invoice_expense`
--
ALTER TABLE `sales_invoice_expense`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_invoice_expense`
--
ALTER TABLE `sales_invoice_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
