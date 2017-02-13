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
-- Struktur dari tabel `sales_invoice_costs`
--

CREATE TABLE `sales_invoice_costs` (
  `id` int(11) NOT NULL,
  `sales_invoice_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sales_invoice_costs`
--

INSERT INTO `sales_invoice_costs` (`id`, `sales_invoice_id`, `description`, `cost`) VALUES
(6, 2, 'Biaya Bus', 90000),
(10, 3, 'Biaya Penjemputan', 50000),
(11, 4, 'Biaya Penjemputan ke Tangerang', 60000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_invoice_costs`
--
ALTER TABLE `sales_invoice_costs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_invoice_costs`
--
ALTER TABLE `sales_invoice_costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
