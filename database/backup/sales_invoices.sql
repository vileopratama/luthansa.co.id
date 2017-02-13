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
-- Struktur dari tabel `sales_invoices`
--

CREATE TABLE `sales_invoices` (
  `id` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `number` varchar(100) NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `total` double NOT NULL,
  `expense` double NOT NULL,
  `payment` double NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sales_invoices`
--

INSERT INTO `sales_invoices` (`id`, `sales_order_id`, `number`, `invoice_date`, `due_date`, `customer_id`, `status`, `total`, `expense`, `payment`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 4, '-', '2016-11-04', '2016-11-11', 1, 0, 170000, 80000, 0, '2016-11-04 13:19:32', 1, '2016-11-07 11:49:45', 1),
(3, 6, '-', '2016-11-07', '2016-11-26', 2, 2, 27130000, 10000, 27130000, '2016-11-07 14:40:12', 1, '2016-11-07 16:49:32', 1),
(4, 7, '-', '2016-12-04', '2016-12-10', 1, 0, 5850000, 0, 0, '2016-11-09 09:52:22', 1, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
