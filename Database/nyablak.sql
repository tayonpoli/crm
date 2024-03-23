-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Mar 2024 pada 13.22
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nyablak`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `delivery` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `delivery`, `payment_status`) VALUES
(10, 3, 'skiau', '0123455789', 'skiau@gmail.com', 'cash on delivery', 'flat no. 12, 12, bogor, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'completed'),
(11, 3, 'dONTOL', '089135172', 'keceonly@gmail.com', 'cash on delivery', 'flat no. 12, jl. kampus hijau, cikarang, indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'completed'),
(12, 3, 'skiau', '0812878754', 'skiau@gmail.com', 'cash on delivery', 'flat no. 9, 12, bogor, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending'),
(13, 3, 'Claudya PutriAn', '086435356', 'claudyaananda@gmail.com', 'cash_on_delivery', 'flat no. 9, jl. kampus hijau, cikarang, Indonesia - 12345', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending'),
(14, 3, 'dONTOL', '87213612', 'klodii@gmail.com', 'gopay', 'flat no. 12, jl. kampus hijau, cikarang, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending'),
(24, 5, 'tayon', '12312323', 'tayon@gmail.com', 'Gopay', 'Jl. Gajah mada no.23, Bekasi, 123445', 'Moccacino (1) ', 48900, '23-Mar-2024', 'Grab', 'completed'),
(25, 5, 'eldwinnn', '085111312', 'tayon@gmail.com', 'Gopay', 'Jl. Sudirman no.55, Bekasi, 12355', 'Americano (1) , Matcha frappe (1) , Sweet sunset (1) , Fanta float (1) , Cookies & Cream (1) , Sandwich (1) , Cookies (1) , Muffin (1) ', 303000, '23-Mar-2024', 'Grab', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `event` varchar(50) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `price`, `image`, `event`, `discount`) VALUES
(3, 'Espresso', 'Coffee', 19000, 'espresso.png', '', 0),
(4, 'Cappucino', 'Coffee', 22000, 'cappucino.png', '', 0),
(5, 'Double trouble', 'Offer', 40000, 'offer1.png', 'Limited offer', 58000),
(6, 'Moccacino', 'Coffee', 29000, 'moccacino.png', NULL, NULL),
(7, 'Croissant', 'Pastry', 35000, 'croissant.png', NULL, NULL),
(8, 'Sweet release', 'Offer', 40000, 'sweet.png', 'Ramadhan edition', 58000),
(9, 'Cake combo', 'Offer', 45000, 'offer5.png', 'Limited offer', 60000),
(10, 'Morning combo', 'Offer', 40000, 'offer3.png', 'Special morning', 65000),
(11, 'Cookies & Cream', 'Non', 35000, 'cookies.png', NULL, NULL),
(12, 'Fanta float', 'Non', 25000, 'fanta.png', NULL, NULL),
(13, 'Perfect combo', 'Offer', 35000, 'offer4.png', 'Lunch offer', 45000),
(14, 'Americano', 'Coffee', 22000, 'americano.png', NULL, NULL),
(15, 'Matcha frappe', 'Non', 38000, 'matcha.png', NULL, NULL),
(16, 'Muffin', 'Pastry', 32000, 'muffin.png', NULL, NULL),
(17, 'Sandwich', 'Pastry', 34000, 'sandwich.png', NULL, NULL),
(18, 'Cookies', 'Pastry', 30000, 'cookie.png', NULL, NULL),
(19, 'Sweet sunset', 'Non', 44000, 'sunset.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'Claudya', 'klodi@gmail.com', 'b6f81a53b4cccd34463fc155ab9d38fc', 'user'),
(2, 'klodii', 'klodii@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'admin'),
(3, 'skiau', 'skiau@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'user'),
(4, 'skiaumader', 'sekiau@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(5, 'tayon', 'tayon@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(6, 'admin1', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(7, 'eldwinn', 'eldwin@gmail.com', '202cb962ac59075b964b07152d234b70', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
