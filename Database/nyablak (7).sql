-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2024 pada 11.53
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `transaction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `employee`
--

INSERT INTO `employee` (`employee_id`, `name`, `email`, `gender`, `department`, `transaction`) VALUES
(1, 'John', 'john@gmail.com', 'Male', 'Sales', 2),
(2, 'Ryan', 'ryan@gmail.com', 'Male', 'Sales', 1),
(3, 'Rina', 'rina@gmail.com', 'Female', 'Purchasing', 0),
(4, 'Dewi', 'dewi@gmail.com', 'Female', 'Purchasing', 1),
(5, 'Ruru', 'ruru@gmail.com', 'Female', 'Expenditure', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `expenditures`
--

CREATE TABLE `expenditures` (
  `expenditure_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `categories` varchar(255) NOT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `recipient` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `expenditures`
--

INSERT INTO `expenditures` (`expenditure_id`, `date`, `categories`, `pic`, `amount`, `payment_method`, `invoice`, `recipient`, `description`) VALUES
(2, '2024-04-23', 'Electricity', 'Jaehyun', 1000, 'DANA', '1234567', 'PLN', '-'),
(5, '2024-04-23', 'Purchase Order', 'Ryan', 3256000, 'BCA', '6', 'PT.Toffin', '-'),
(6, '2024-05-03', 'Raw Material', 'Dewi', 4279000, 'BCA', '4', 'PT.CoffeeIndo1', '-'),
(7, '2024-05-03', 'Raw Material', 'Dewi', 4279000, 'BCA', '4', 'PT.CoffeeIndo1', '-'),
(8, '2024-05-03', 'Raw Material', 'Dewi', 4279000, 'BCA', '4', 'PT.CoffeeIndo1', '-');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `shipping_status` varchar(20) NOT NULL DEFAULT 'pending',
  `sales` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `delivery`, `payment_status`, `shipping_status`, `sales`) VALUES
(10, 3, 'skiau', '0123455789', 'skiau@gmail.com', 'cash on delivery', 'flat no. 12, 12, bogor, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'completed', 'indelivery', NULL),
(11, 3, 'dONTOL', '089135172', 'keceonly@gmail.com', 'cash on delivery', 'flat no. 12, jl. kampus hijau, cikarang, indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'completed', 'Brewing', NULL),
(12, 3, 'skiau', '0812878754', 'skiau@gmail.com', 'cash on delivery', 'flat no. 9, 12, bogor, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending', 'Brewing', NULL),
(13, 3, 'Claudya PutriAn', '086435356', 'claudyaananda@gmail.com', 'cash_on_delivery', 'flat no. 9, jl. kampus hijau, cikarang, Indonesia - 12345', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending', 'Brewing', NULL),
(14, 3, 'dONTOL', '87213612', 'klodii@gmail.com', 'gopay', 'flat no. 12, jl. kampus hijau, cikarang, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending', 'In Delivery', NULL),
(24, 5, 'tayon', '12312323', 'tayon@gmail.com', 'Gopay', 'Jl. Gajah mada no.23, Bekasi, 123445', 'Moccacino (1) ', 48900, '23-Mar-2024', 'Grab', 'completed', 'Complete', NULL),
(25, 5, 'eldwinnn', '085111312', 'tayon@gmail.com', 'Gopay', 'Jl. Sudirman no.55, Bekasi, 12355', 'Americano (1) , Matcha frappe (1) , Sweet sunset (1) , Fanta float (1) , Cookies & Cream (1) , Sandwich (1) , Cookies (1) , Muffin (1) ', 303000, '23-Mar-2024', 'Grab', 'completed', 'Complete', NULL),
(26, 5, 'eldwin', '1235343', 'tayon@gmail.com', 'Gopay', 'Jl. Entah No.666, Bekasi, 124343', 'Sweet release (1) , Cappucino (1) ', 85200, '25-Mar-2024', 'Grab', 'completed', 'In Delivery', NULL),
(27, 5, 'DASD', '133', 'tayon@gmail.com', 'Gopay', 'jL.AKSDASD, BEKA9S, 23123', 'Cappucino (2) ', 65400, '26-Mar-2024', 'Grab', 'pending', 'pending', NULL),
(28, 5, 'tes', '3123', 'tayon@gmail.com', 'Gopay', 'kasdpasd, oaskd, 3138', 'Espresso (1) ', 37900, '26-Mar-2024', 'Grab', 'pending', 'pending', NULL),
(29, 5, 'aosdj', '453', 'tayon@gmail.com', 'Gopay', 'Jl.asdkasd, 9808, 909', 'Cappucino (1) , Espresso (1) , Croissant (1) ', 100600, '26-Mar-2024', 'Grab', 'pending', 'pending', NULL),
(30, 5, 'aosdj', '453', 'tayon@gmail.com', 'Gopay', 'Jl.asdkasd, 9808, 909', 'Cappucino (1) , Espresso (1) , Croissant (1) ', 100600, '26-Mar-2024', 'Go Send', 'pending', 'pending', NULL),
(31, 5, 'llklhlh', '454564', 'tayon@gmail.com', 'Gopay', 'jl.hjhjh, Betkgk, 9898', 'Cappucino (1) , Espresso (1) ', 62100, '26-Mar-2024', 'Grab', 'paid', 'pending', 'John'),
(32, 5, 'Johnasda', '123123', 'tayon@gmail.com', 'Gopay', 'Jalan Professor Doktor Satrio, jakarta selatan, 12940', 'Cappucino (3) , Moccacino (1) ', 17000, '01-Jul-2024', 'Grab', 'pending', 'pending', NULL),
(33, 5, 'dasdasdqad', '1231231', 'tayon@gmail.com', 'Gopay', 'Jalan Professor Doktor Satrio, jakarta selatan, 12940', 'Moccacino (1) , Cappucino (1) ', 48900, '01-Jul-2024', 'Grab', 'pending', 'pending', NULL),
(34, 5, 'eldwin', '133', 'tayon@gmail.com', 'Gopay', 'Jalan Professor Doktor Satrio, jakarta selatan, 12940', 'Cappucino (1) , Moccacino (1) , Croissant (1) ', 111600, '01-Jul-2024', 'Grab', 'pending', 'pending', NULL),
(35, 5, 'eldwin', '133', 'tayon@gmail.com', '', 'Jalan Professor Doktor Satrio, jakarta selatan, 12940', 'Cappucino (1) , Moccacino (1) , Croissant (1) ', 111600, '01-Jul-2024', '', 'pending', 'pending', NULL),
(36, 5, 'tes1', '123123', 'tayon@gmail.com', 'Gopay', 'Jalan Professor Doktor Satrio, jakarta selatan, 12940', 'Cappucino (1) , Moccacino (1) , Croissant (1) , Espresso (1) ', 132500, '01-Jul-2024', 'Grab', 'Paid', 'Complete', NULL);

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
  `discount` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `sold` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `reedemed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `price`, `image`, `event`, `discount`, `stock`, `sold`, `point`, `reedemed`) VALUES
(3, 'Espresso', 'Coffee', 19000, 'espresso.png', '', 0, 99, 1, 22, 0),
(4, 'Cappucino', 'Coffee', 22000, 'cappucino.png', '', 0, 97, 1, 22, 1),
(5, 'Double trouble', 'Offer', 40000, 'offer1.png', 'Limited offer', 58000, 100, 0, 22, 0),
(6, 'Moccacino', 'Coffee', 29000, 'moccacino.png', NULL, NULL, 97, 1, 22, 1),
(7, 'Croissant', 'Pastry', 35000, 'croissant.png', NULL, NULL, 98, 1, 22, 0),
(8, 'Sweet release', 'Offer', 40000, 'sweet.png', 'Ramadhan edition', 58000, 100, 0, 22, 0),
(9, 'Cake combo', 'Offer', 45000, 'offer5.png', 'Limited offer', 60000, 100, 0, 22, 0),
(10, 'Morning combo', 'Offer', 40000, 'offer3.png', 'Special morning', 65000, 100, 0, 22, 0),
(11, 'Cookies & Cream', 'Non', 35000, 'cookies.png', NULL, NULL, 100, 0, 22, 0),
(12, 'Fanta float', 'Non', 25000, 'fanta.png', NULL, NULL, 100, 0, 22, 0),
(13, 'Perfect combo', 'Offer', 35000, 'offer4.png', 'Lunch offer', 45000, 100, 0, 22, 0),
(14, 'Americano', 'Coffee', 22000, 'americano.png', NULL, NULL, 100, 0, 22, 0),
(15, 'Matcha frappe', 'Non', 38000, 'matcha.png', NULL, NULL, 100, 0, 22, 0),
(16, 'Muffin', 'Pastry', 32000, 'muffin.png', NULL, NULL, 100, 0, 22, 0),
(17, 'Sandwich', 'Pastry', 34000, 'sandwich.png', NULL, NULL, 100, 0, 22, 0),
(18, 'Cookies', 'Pastry', 30000, 'cookie.png', NULL, NULL, 100, 0, 22, 0),
(19, 'Sweet sunset', '', 44000, 'sunset.png', NULL, NULL, 100, 0, 22, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `vendor` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `buyer` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `bill_status` varchar(100) NOT NULL DEFAULT 'Not Billed',
  `arrival` date NOT NULL,
  `terms` int(11) NOT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `account` varchar(100) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `vendor`, `address`, `email`, `phone`, `buyer`, `date`, `total`, `bill_status`, `arrival`, `terms`, `bank`, `account`, `payment_date`) VALUES
(2, 'asdasd', 'asdad', '123asda', '123', 'asdasd', '2024-04-01', '245.00', 'Not Billed', '2024-04-16', 12, NULL, NULL, NULL),
(3, 'PT.Indomilk', 'Jl.Karangan', 'indomilk@gmail.com', '021343431', 'John', '2024-04-10', '18920000.00', 'Not Billed', '2024-04-16', 15, 'required', 'required - required', '2024-04-23'),
(4, 'PT.CoffeeIndo1', 'Jl.Kemang', 'coffeeindo@gmail.com', '021313131', 'Dewi', '2024-04-13', '4279000.00', 'Fully Billed', '2024-04-20', 12, 'BCA', '12313131 - Doe', '2024-05-03'),
(5, 'tes', '123', 'tes', '123', '123', '2024-04-23', '158400.00', 'Not Billed', '2024-04-30', 23, 'Mandiri', '12312312 - John', NULL),
(6, 'PT.Toffin', 'Jl.Penggilingan No.68', 'toffin@gmail.com', '0213445482', 'Ryan', '2024-04-23', '3256000.00', 'Fully Billed', '2024-04-26', 7, 'BCA', '568131903 -John Doe', '2024-04-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `purchase_products`
--

INSERT INTO `purchase_products` (`id`, `purchase_id`, `product_name`, `product_price`, `product_qty`) VALUES
(3, 2, 'Caramel', 86000, 20),
(4, 2, 'Caramel12', 86000, 20),
(5, 3, 'Caramel', 86000, 20),
(6, 3, 'Caramel', 86000, 20),
(7, 4, 'Caramel2', 86000, 20),
(8, 4, 'Caramel', 86000, 20),
(9, 4, 'Caramel', 86000, 20),
(10, 5, 'Caramel', 86000, 20),
(11, 6, 'Caramel', 86000, 20),
(12, 6, 'Caramel', 86000, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `revenue`
--

CREATE TABLE `revenue` (
  `order_id` int(11) NOT NULL,
  `order_placed` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` int(100) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `revenue`
--

INSERT INTO `revenue` (`order_id`, `order_placed`, `name`, `number`, `email`, `address`, `total_products`, `total_price`, `payment_method`, `payment_status`) VALUES
(26, '25-Mar-2024', 'eldwin', '1235343', 'tayon@gmail.com', 'Jl. Entah No.666, Bekasi, 124343', 'Sweet release (1) , Cappucino (1) ', 85200, 'Gopay', 'paid'),
(31, '26-Mar-2024', 'llklhlh', '454564', 'tayon@gmail.com', 'jl.hjhjh, Betkgk, 9898', 'Cappucino (1) , Espresso (1) ', 62100, 'Gopay', 'paid'),
(36, '01-Jul-2024', 'tes1', '123123', 'tayon@gmail.com', 'Jalan Professor Doktor Satrio, jakarta selatan, 12940', 'Cappucino (1) , Moccacino (1) , Croissant (1) , Espresso (1) ', 132500, 'Gopay', 'paid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `poin`) VALUES
(1, 'Claudya', 'klodi@gmail.com', 'b6f81a53b4cccd34463fc155ab9d38fc', 'user', 0),
(2, 'klodii', 'klodii@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'admin', 0),
(3, 'skiau', 'skiau@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'user', 0),
(4, 'skiaumader', 'sekiau@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 0),
(5, 'tayon', 'tayon@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 3),
(6, 'admin1', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin', 0),
(7, 'eldwinn', 'eldwin@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 0),
(8, 'admin123', 'admin123@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indeks untuk tabel `expenditures`
--
ALTER TABLE `expenditures`
  ADD PRIMARY KEY (`expenditure_id`);

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
-- Indeks untuk tabel `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indeks untuk tabel `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PURCHASE` (`purchase_id`);

--
-- Indeks untuk tabel `revenue`
--
ALTER TABLE `revenue`
  ADD PRIMARY KEY (`order_id`);

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
-- AUTO_INCREMENT untuk tabel `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `expenditures`
--
ALTER TABLE `expenditures`
  MODIFY `expenditure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `revenue`
--
ALTER TABLE `revenue`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD CONSTRAINT `FK_PURCHASE` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
