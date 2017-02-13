-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 Nov 2016 pada 10.10
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
-- Struktur dari tabel `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` int(11) NOT NULL,
  `source` tinyint(1) NOT NULL,
  `number` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `due_date` date NOT NULL,
  `booking_from_date` date NOT NULL,
  `booking_to_date` date NOT NULL,
  `pick_up_point` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone_number` varchar(18) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `total` double NOT NULL,
  `expense` double NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `source`, `number`, `order_date`, `due_date`, `booking_from_date`, `booking_to_date`, `pick_up_point`, `destination`, `customer_id`, `customer_email`, `customer_phone_number`, `status`, `total`, `expense`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 0, '-', '2016-11-02', '2016-11-10', '0000-00-00', '0000-00-00', '', '', 1, '', '', 0, 0, 0, '2016-11-02 16:56:54', 1, '0000-00-00 00:00:00', 0),
(4, 0, '-', '2016-11-04', '2016-11-11', '0000-00-00', '0000-00-00', '', '', 2, '', '', 1, 2780000, 50000, '2016-11-04 12:10:04', 1, '2016-11-04 12:59:17', 1),
(6, 0, '-', '2016-11-07', '2016-11-26', '0000-00-00', '0000-00-00', '', '', 2, '', '', 1, 6000000, 50000, '2016-11-07 14:39:21', 1, '0000-00-00 00:00:00', 0),
(7, 0, '-', '2016-12-04', '2016-12-10', '0000-00-00', '0000-00-00', '', '', 1, '', '', 1, 5850000, 60000, '2016-11-09 09:37:24', 1, '2016-11-09 09:39:23', 1),
(8, 1, '', '2016-11-10', '0000-00-00', '2016-11-10', '2016-11-24', 'Jalan petukangan Utara No.8 Jakarta Selatan', 'Hotel Nakamura Bogor 52', 4, '', '', 2, 0, 0, '2016-11-10 09:51:42', 4, '0000-00-00 00:00:00', 0),
(9, 1, '', '2016-11-11', '0000-00-00', '2016-11-11', '2016-11-14', 'Jln Pelana No.90 Jakarta Selatan', 'Jln District 4 Bandung ', 6, 'hendarsyahss5@gmail.com', '08522208555', 2, 0, 0, '2016-11-11 07:22:43', 6, '0000-00-00 00:00:00', 0),
(10, 1, '', '2016-11-11', '0000-00-00', '2016-11-11', '2016-11-14', 'Jln Pelana No.90 Jakarta Selatan', 'Jln District 4 Bandung ', 6, 'hendarsyahss5@gmail.com', '08522208555', 2, 0, 0, '2016-11-11 07:23:37', 6, '0000-00-00 00:00:00', 0),
(11, 1, '', '2016-11-11', '0000-00-00', '2016-11-10', '2016-11-12', 'Test', 'Test', 6, 'hendarsyahss5@gmail.com', '08522208555', 2, 0, 0, '2016-11-11 07:25:22', 6, '0000-00-00 00:00:00', 0),
(12, 1, '', '2016-11-11', '0000-00-00', '2016-11-10', '2016-11-12', 'Test', 'Test', 6, 'hendarsyahss5@gmail.com', '08522208555', 2, 0, 0, '2016-11-11 08:59:44', 6, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
