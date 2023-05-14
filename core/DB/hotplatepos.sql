-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 10:51 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotplatepos`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `total` varchar(20) NOT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `total_discount` varchar(20) DEFAULT NULL,
  `pay_type` varchar(20) DEFAULT NULL,
  `payment` int(11) DEFAULT 0,
  `pay_change` varchar(20) DEFAULT NULL,
  `service` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `name` longtext NOT NULL,
  `quantity` longtext NOT NULL,
  `price` longtext NOT NULL,
  `note` longtext DEFAULT NULL,
  `order_seen` int(1) NOT NULL,
  `count_update` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `picture` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `orig_quantity` int(11) DEFAULT 0,
  `quantity` int(11) DEFAULT NULL,
  `reorder_level` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `sale` decimal(10,2) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `status`, `picture`, `description`, `orig_quantity`, `quantity`, `reorder_level`, `total`, `sale`, `category`, `create_at`, `update_at`) VALUES
(1, 'Longadog', 80, 'Available', NULL, NULL, 50, 50, 25, '4000.00', '0.00', 'meals', '2023-01-23 11:08:45', '2023-05-14 08:50:13'),
(2, 'Burger Steak', 80, 'Available', NULL, NULL, 50, 50, 25, '4000.00', '0.00', 'meals', '2023-01-23 11:10:52', '2023-05-14 08:50:13'),
(3, 'Tocino Tips', 85, 'Available', NULL, NULL, 50, 50, 25, '4250.00', '0.00', 'meals', '2023-01-23 11:10:52', '2023-05-14 08:50:13'),
(4, 'Chicken BBQ', 85, 'Available', NULL, NULL, 50, 50, 25, '4250.00', '0.00', 'meals', '2023-01-23 11:10:52', '2023-05-14 08:50:13'),
(5, 'Pork BBQ', 85, 'Available', NULL, NULL, 50, 50, 25, '4250.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(6, 'Chicken Teriyaki', 90, 'Available', NULL, NULL, 50, 50, 25, '4500.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(7, 'Pork Teriyaki', 90, 'Available', NULL, NULL, 50, 50, 25, '4500.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(8, 'Hungarian', 90, 'Available', NULL, NULL, 50, 50, 25, '4500.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(9, 'Tapa Tips', 90, 'Available', NULL, NULL, 50, 50, 25, '4500.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(10, 'Porkchop', 90, 'Available', NULL, NULL, 50, 50, 25, '4500.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(11, 'Pork Sisig', 95, 'Available', NULL, NULL, 50, 50, 25, '4750.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(12, 'Spicy Beef Tapa', 95, 'Available', NULL, NULL, 50, 50, 25, '4750.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(13, 'Liempo', 95, 'Available', NULL, NULL, 50, 50, 25, '4750.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(14, 'Gambas', 100, 'Available', NULL, NULL, 50, 50, 25, '5000.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(15, 'Beef Pares', 100, 'Available', NULL, NULL, 50, 50, 25, '5000.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(16, 'Boneless Bangus', 100, 'Available', NULL, NULL, 50, 50, 25, '5000.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(17, 'T-Bone', 160, 'Available', NULL, NULL, 50, 50, 25, '8000.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(18, 'Porter House', 170, 'Available', NULL, NULL, 50, 50, 25, '8500.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(19, 'Sizzling Tofu', 140, 'Available', NULL, NULL, 50, 50, 25, '7000.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(20, 'Sizzling Hotdog', 140, 'Available', NULL, NULL, 50, 50, 25, '7000.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(21, 'Sizzling Sisig', 160, 'Available', NULL, NULL, 50, 50, 25, '8000.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(22, 'Sizzling Gambas', 180, 'Available', NULL, NULL, 50, 50, 25, '9000.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-14 08:50:13'),
(23, 'Coke', 20, 'Available', NULL, NULL, 50, 50, 25, '1000.00', '0.00', 'drinks', '2023-05-11 01:32:07', '2023-05-14 08:50:13'),
(24, 'Royal', 20, 'Available', NULL, NULL, 50, 50, 25, '1000.00', '0.00', 'drinks', '2023-05-11 01:33:01', '2023-05-14 08:50:13'),
(25, 'Sprite', 20, 'Available', NULL, NULL, 50, 50, 25, '1000.00', '0.00', 'drinks', '2023-05-11 01:33:15', '2023-05-14 08:50:13'),
(26, 'Red Tea', 50, 'Available', NULL, NULL, 50, 50, 25, '2500.00', '0.00', 'drinks', '2023-05-11 01:33:37', '2023-05-14 08:50:13'),
(27, 'Cucumber', 50, 'Available', NULL, NULL, 50, 50, 25, '2500.00', '0.00', 'drinks', '2023-05-11 01:34:01', '2023-05-14 08:50:13'),
(28, 'Blue Lemonade', 50, 'Available', NULL, NULL, 50, 50, 25, '2500.00', '0.00', 'drinks', '2023-05-11 01:34:22', '2023-05-14 08:50:13'),
(29, 'Rice', 15, 'Available', NULL, NULL, 50, 50, 25, '750.00', '0.00', 'add-ons', '2023-05-11 01:34:37', '2023-05-14 08:50:13'),
(30, 'Gravy', 15, 'Available', NULL, NULL, 50, 50, 25, '750.00', '0.00', 'add-ons', '2023-05-11 01:34:50', '2023-05-14 08:50:13'),
(31, 'Egg', 15, 'Available', NULL, NULL, 50, 50, 25, '750.00', '0.00', 'add-ons', '2023-05-11 01:35:01', '2023-05-14 08:50:13'),
(32, 'Mix Veggies', 15, 'Available', NULL, NULL, 50, 50, 25, '750.00', '0.00', 'add-ons', '2023-05-11 01:35:15', '2023-05-14 08:50:13'),
(33, 'Takeout Box', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:36:25', '2023-05-14 08:50:13'),
(34, 'Gravy Cup', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:36:25', '2023-05-14 08:50:13'),
(35, 'Yello Coloring', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(36, 'Pares Cup', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(37, '12oz Plastic Cup', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(38, 'Plastic Medium', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(39, 'Plastic Small', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(40, 'Oyster', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(41, 'Mix Veggies', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(42, 'Sessame Seed', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(43, 'Fried Garlic', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(44, 'Butter', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(45, 'Brown Sugar', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(46, 'Magic Sarap', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(47, 'Cornstarch', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(48, 'Beef Cubes', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(49, 'Oil', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(50, 'Soy Sauce', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(51, 'Red Chili', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(52, 'Green Chili', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(53, 'Calamansi', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(54, 'Onion', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(55, 'Hot Sauce', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(56, 'Catsup', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(57, 'Rice', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(58, 'Egg', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(59, 'Spoon/Fork', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(60, 'Vinegar', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(61, 'Mayonnase', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(62, 'Margarine', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(63, 'Seasoning LIQ.', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(64, 'Bell Pepper', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(65, 'Garlic', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(66, 'Salt/Pepper', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_history`
--

CREATE TABLE `product_history` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `transaction_count` int(11) NOT NULL,
  `updated_quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `bussiness_name` varchar(200) DEFAULT NULL,
  `bussiness_tin` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `URL` varchar(100) DEFAULT NULL,
  `logo` longtext DEFAULT NULL,
  `auth` varchar(255) DEFAULT NULL,
  `daily_report_hr` varchar(20) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `bussiness_name`, `bussiness_tin`, `address`, `contact_no`, `email`, `URL`, `logo`, `auth`, `daily_report_hr`, `create_at`, `update_at`) VALUES
(1, 'HotPlate Menu', '12345678910-0000', '1149 MARCELO H. DEL PILAR, CORNER CORDERO ST., ARKONG BATO, VALENZUELA 1444 METRO, MANILA VALENZUELA', '09263065035', 'hotplate@gmail.com', 'fb.com/hotplatesizzling', NULL, NULL, '23 : 00 : 00', '2023-03-06 04:51:07', '2023-05-14 08:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `password`, `role`, `hint`, `answer`, `created_at`, `update_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', 'admin', 'Admin', 'favorite color?', 'blue', '2023-04-25 17:08:54', '2023-05-08 03:35:05'),
(2, 'staff one', 'staff1', 'staffone@gmail.com', 'admin', 'Staff', NULL, NULL, '2023-05-08 19:22:04', '2023-05-08 03:42:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_history`
--
ALTER TABLE `product_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `product_history`
--
ALTER TABLE `product_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
