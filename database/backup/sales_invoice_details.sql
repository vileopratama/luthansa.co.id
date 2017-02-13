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
-- Struktur dari tabel `sales_invoice_details`
--

CREATE TABLE `sales_invoice_details` (
  `id` int(11) NOT NULL,
  `sales_invoice_id` int(11) NOT NULL,
  `armada_category_id` int(11) NOT NULL,
  `qty` int(3) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `days` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sales_invoice_details`
--

INSERT INTO `sales_invoice_details` (`id`, `sales_invoice_id`, `armada_category_id`, `qty`, `description`, `price`, `days`) VALUES
(4, 1, 3, 1, 'Pembelian 3 Biji', 120000, 3),
(20, 2, 4, 1, 'Testing2', 80000, 1),
(29, 3, 1, 4, 'Untuk 3 Hari', 1000000, 3),
(30, 3, 1, 3, 'Untuk 3 Hari', 1000000, 5),
(31, 3, 2, 1, 'Testing', 8000, 10),
(32, 4, 1, 3, '1 (satu) Unit HiAce Commuter 15 Seat\n3 (Tiga) hari ; Selasa - Kamis, 18 - 20 Oktober 2016\nDalam Kota Jakarta dan Tangerang', 1350000, 3),
(33, 4, 2, 1, '1 (satu) Unit HiAce Commuter 19 Seat 3 (Tiga) hari ; Selasa - Kamis, 18 - 20 Oktober 2016 Dalam Kota Jakarta dan Tangerang', 1800000, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_invoice_details`
--
ALTER TABLE `sales_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_invoice_details`
--
ALTER TABLE `sales_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
