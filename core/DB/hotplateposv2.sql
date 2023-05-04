-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2023 at 01:55 PM
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
-- Database: `hotplateposv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `total_value` decimal(10,2) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `total_discount` varchar(255) DEFAULT NULL,
  `pay_type` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `pay_change` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
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
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `picture` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `quantity` varchar(30) DEFAULT NULL,
  `reorder_level` varchar(30) DEFAULT NULL,
  `total` varchar(30) DEFAULT NULL,
  `sale` decimal(8,2) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `status`, `picture`, `description`, `quantity`, `reorder_level`, `total`, `sale`, `category`, `create_at`, `update_at`) VALUES
(1, 'Longadog', '80', 'Available', NULL, '', '50', '30', '4000', '0.00', 'meals', '2023-01-23 11:08:45', '2023-05-04 05:57:04'),
(2, 'Burger Steak', '80', 'Available', NULL, '', '50', '30', '4000', '0.00', 'meals', '2023-01-23 11:10:52', '2023-05-04 11:41:00'),
(3, 'Tocino Tips', '85', 'Available', NULL, '', '50', '30', '4250', '0.00', 'meals', '2023-01-23 11:10:52', '2023-05-04 11:53:52'),
(4, 'Chicken BBQ', '85', 'Available', NULL, '', '50', '30', '4250', '0.00', 'meals', '2023-01-23 11:10:52', '2023-05-04 11:40:58'),
(5, 'Pork BBQ', '85', 'Available', NULL, '', '50', '30', '4250', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(6, 'Chicken Teriyaki', '90', 'Available', NULL, '', '50', '30', '4500', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(7, 'Pork Teriyaki', '90', 'Available', NULL, '', '50', '30', '4500', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(8, 'Hungarian', '90', 'Available', NULL, '', '50', '30', '4500', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(9, 'Tapa Tips', '90', 'Available', NULL, '', '50', '30', '4500', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(10, 'Porkchop', '90', 'Available', NULL, '', '50', '30', '4500', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(11, 'Pork Sisig', '95', 'Available', NULL, '', '50', '30', '4750', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-03 15:55:15'),
(12, 'Spicy Beef Tapa', '95', 'Available', NULL, '', '50', '30', '4750', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(13, 'Liempo', '95', 'Available', NULL, '', '49', '30', '4655', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 10:39:19'),
(14, 'Gambas', '100', 'Available', NULL, '', '50', '30', '5000', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(15, 'Beef Pares', '100', 'Available', NULL, '', '50', '30', '5000', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(16, 'Boneless Bangus', '100', 'Available', NULL, '', '50', '30', '5000', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(17, 'T-Bone', '160', 'Available', NULL, '', '50', '30', '8000', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(18, 'Porter House', '170', 'Available', NULL, '', '50', '30', '8500', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(19, 'Sizzling Tofu', '140', 'Available', NULL, '', '50', '30', '7000', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-03 17:13:15'),
(20, 'Sizzling Hotdog', '140', 'Available', NULL, '', '50', '30', '7000', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-03 17:13:15'),
(21, 'Sizzling Sisig', '160', 'Available', NULL, '', '50', '30', '8000', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(22, 'Sizzling Gambas', '180', 'Available', NULL, '', '50', '30', '9000', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-04 11:25:58'),
(47, 'rice', '15', 'Available', NULL, '', '50', '30', '750', '0.00', 'add-ons', '2023-04-05 23:46:54', '2023-05-04 11:25:58'),
(48, 'coke', '20', 'Available', NULL, '', '50', '30', '1000', '0.00', 'drinks', '2023-04-05 23:50:59', '2023-05-04 11:25:58'),
(49, 'royal', '20', 'Available', NULL, '', '50', '30', '1000', '0.00', 'drinks', '2023-04-05 23:51:21', '2023-05-04 11:25:58'),
(50, 'sprite', '20', 'Available', NULL, '', '50', '30', '1000', '0.00', 'drinks', '2023-04-05 23:51:35', '2023-05-04 11:25:58'),
(51, 'red tea', '50', 'Available', NULL, '', '50', '30', '2500', '0.00', 'drinks', '2023-04-05 23:52:02', '2023-05-04 11:25:58'),
(52, 'cucumber', '50', 'Available', NULL, '', '50', '30', '2500', '0.00', 'drinks', '2023-04-05 23:52:18', '2023-05-04 11:25:58'),
(53, 'blue lemonade', '50', 'Available', NULL, '', '50', '30', '2500', '0.00', 'drinks', '2023-04-05 23:52:32', '2023-05-04 11:25:58'),
(54, 'gravy', '15', 'Available', NULL, '', '50', '30', '750', '0.00', 'add-ons', '2023-04-06 00:01:52', '2023-05-04 11:25:58'),
(55, 'egg', '20', 'Available', NULL, '', '50', '30', '1000', '0.00', 'add-ons', '2023-04-06 00:02:07', '2023-05-04 11:25:58'),
(56, 'mix veggies', '15', 'Available', NULL, '', '50', '30', '750', '0.00', 'add-ons', '2023-04-06 00:02:27', '2023-05-04 11:25:58'),
(57, 'potato', '12', 'Available', NULL, '', NULL, NULL, NULL, '0.00', 'other', '2023-05-03 16:37:24', '2023-05-03 17:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_history`
--

CREATE TABLE `product_history` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
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
  `bussiness_name` varchar(255) DEFAULT NULL,
  `bussiness_tin` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `auth` varchar(255) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `bussiness_name`, `bussiness_tin`, `address`, `contact_no`, `email`, `URL`, `logo`, `auth`, `create_at`, `update_at`) VALUES
(1, 'HotPlate Menu', '12345678910-0000', '1149 MARCELO H. DEL PILAR, CORNER CORDERO ST., ARKONG BATO, VALENZUELA 1444 METRO, MANILA VALENZUELA, PHILIPPINES', '09263065035', 'hotplate@gmail.com', 'fb.com/hotplatesizzling', NULL, NULL, '2023-03-06 12:51:07', '2023-04-14 13:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `password`, `role`, `token`, `hint`, `answer`, `created_at`, `update_at`) VALUES
(1, 'Admin', 'Admin', 'hotplate@gmail.com', 'admin', 'Admin', 'drhef0nwegg0n8rqge8r46j6kt357stq419jfj3x3vrsf3omgy', 'favorite color?', 'blue', '2023-04-25 17:08:54', '2023-05-04 11:52:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product_history`
--
ALTER TABLE `product_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
