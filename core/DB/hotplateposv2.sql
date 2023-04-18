-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 10:50 AM
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

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_name`, `description`, `quantity`, `unit_cost`, `total_value`, `reorder_level`, `supplier`, `location`, `created_at`, `updated_at`) VALUES
(3, 'Potatoes', 'Fresh potatoes for french fries', 100, '0.50', '50.00', 30, 'Farm Fresh Produce', 'Dry Storage', '2023-03-28 06:34:33', '2023-03-28 06:34:33'),
(4, 'Buns', 'Freshly baked hamburger buns', 150, '0.25', '37.50', 50, 'Bakery Co.', 'Dry Storage', '2023-03-28 06:34:33', '2023-03-28 06:34:33'),
(5, 'Cheese', 'Sliced American cheese', 50, '1.00', '50.00', 5, 'Dairy Farms Inc.', 'Walk-in Cooler', '2023-03-28 06:34:33', '2023-03-28 06:34:33');

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
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `picture` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `sale` decimal(8,2) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `status`, `picture`, `description`, `sale`, `category`, `create_at`, `update_at`) VALUES
(1, 'Longadog', '80', 'Available', NULL, 'Sugar, Salt, Olive Oil, Balsamic Vinegar, Garlic, Onions, Tomatoes, Lettuce, Salmon Fillets, Beef Sirloin', '0.00', 'meals', '2023-01-23 19:08:45', '2023-04-17 08:49:38'),
(2, 'Burger Steak', '80', 'Available', NULL, 'Ground beef, Onion, Bread crumbs, Egg, Worcestershire sauce, Salt, Black pepper, Butter, Flour, Beef broth, Soy sauce, Onion powder, Garlic powder, Cornstarch, Water', '0.00', 'meals', '2023-01-23 19:10:52', '2023-04-17 08:39:27'),
(3, 'Tocino Tips', '85', 'Available', NULL, 'Pork shoulder or pork belly, sliced into thin tips, Pineapple juice, Soy sauce, Brown sugar, Garlic, minced, Salt, Black pepper, Red food coloring', '0.00', 'meals', '2023-01-23 19:10:52', '2023-04-17 08:39:27'),
(4, 'Chicken BBQ', '85', 'Available', NULL, 'Chicken thighs or chicken legs, Soy sauce, Ketchup, Brown sugar, Garlic, minced, Lemon or calamansi juice, Salt, Black pepper, Cooking oil', '0.00', 'meals', '2023-01-23 19:10:52', '2023-04-17 08:39:27'),
(5, 'Pork BBQ', '85', 'Available', NULL, 'Pork shoulder or pork belly, Soy sauce, Vinegar, Brown sugar, Ketchup, Garlic, minced, Salt, Black pepper, Banana ketchup, Pineapple juice, Wooden skewers', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(6, 'Chicken Teriyaki', '90', 'Available', NULL, 'Chicken, Soy sauce, Mirin, Sake, Sugar, Garlic, minced, Ginger, grated, Cornstarch, Water, Vegetable oil', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(7, 'Pork Teriyaki', '90', 'Available', NULL, 'Pork, Soy sauce, Mirin, Sake, Sugar, Garlic, minced, Ginger, grated, Sesame oil, Cornstarch, Water, Green onions, Sesame seeds', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(8, 'Hungarian', '90', 'Available', NULL, 'Pork, beef, Garlic, Salt, Black pepper, Paprika, Caraway seeds, Allspice, Coriander seeds, Mustard seeds, Water or red wine', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:49:38'),
(9, 'Tapa Tips', '90', 'Available', NULL, 'Beef sirloin,  Soy sauce, Vinegar, Brown sugar, Garlic, minced, Salt, Black pepper', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:49:38'),
(10, 'Porkchop', '90', 'Available', NULL, 'Pork chops, Salt, Black pepper, Garlic powder, Paprika, Olive oil or vegetable oil, Butter, Fresh herbs', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(11, 'Pork Sisig', '95', 'Available', NULL, 'Pork head, ears, and liver, Onion, Garlic, Ginger, Calamansi juice, Soy sauce, Vinegar, Mayonnaise, Salt, Black pepper, Red chili peppers', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:49:38'),
(12, 'Spicy Beef Tapa', '95', 'Available', NULL, 'Beef sirloin, Soy sauce, Vinegar, Brown sugar, Garlic, minced, Salt, Black pepper, Red pepper flakes, Oil', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:49:38'),
(13, 'Liempo', '95', 'Available', NULL, 'Pork belly, Soy sauce, Vinegar, Garlic, minced, Salt, Black pepper, Brown sugar, Lemon', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(14, 'Gambas', '100', 'Available', NULL, 'Large shrimp, Garlic, minced, Olive oil, Paprika, Red pepper flakes, Lemon juice, Salt, Parsley', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(15, 'Beef Pares', '100', 'Available', NULL, 'Beef chuck, Soy sauce, Brown sugar, Star anise, Garlic, minced, Ginger, sliced, Water, Cornstarch, Salt, Black pepper, Oil', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(16, 'Boneless Bangus', '100', 'Available', NULL, 'Boneless Bangus,\r\nVinegar,\r\nGarlic, minced,\r\nSalt,\r\nBlack pepper,\r\nOil', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(17, 'T-Bone', '160', 'Available', NULL, 'T-bone steak, Salt, Black pepper, Olive oil, Butter, Garlic cloves, Fresh herbs', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(18, 'Porter House', '170', 'Available', NULL, 'Porterhouse steak, Salt, Black pepper, Olive oil, Garlic cloves,', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(19, 'Sizzling Tofu', '140', 'Available', NULL, 'Firm tofu, \r\nCornstarch,\r\nCooking oil,\r\nGarlic, \r\nOnion,\r\nBell peppers,\r\nSoy sauce,\r\nOyster sauce,\r\nSugar,\r\nWater,\r\nGreen onions,', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:49:38'),
(20, 'Sizzling Hotdog', '140', 'Available', NULL, 'Hotdogs,\r\nCooking oil,\r\nOnions,\r\nSoy sauce,\r\nKetchup,\r\nWorcestershire sauce,\r\nSugar,\r\nWater,\r\nCornstarch', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:49:38'),
(21, 'Sizzling Sisig', '160', 'Available', NULL, 'Hotdogs, Onions, Butter, Ketchup, Mayonnaise, Mustard, Worcestershire sauce, Soy sauce, Sugar, Lemon juice, Salt, Black pepper, Cheese, Chili flakes	', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(22, 'Sizzling Gambas', '180', 'Available', NULL, 'Shrimp, Garlic,  Onion, Tomato sauce, Soy sauce, Worcestershire sauce, Sugar, Red chili peppers, Butter, Olive oil, Salt, Black pepper, Spring onions', '0.00', 'meals', '2023-01-23 19:16:45', '2023-04-17 08:39:27'),
(47, 'rice', '15', 'Available', NULL, '', '0.00', 'add-ons', '2023-04-06 07:46:54', '2023-04-17 08:49:38'),
(48, 'coke', '20', 'Available', NULL, '', '0.00', 'drinks', '2023-04-06 07:50:59', '2023-04-12 15:52:05'),
(49, 'royal', '20', 'Available', NULL, '', '0.00', 'drinks', '2023-04-06 07:51:21', '2023-04-12 15:52:05'),
(50, 'sprite', '20', 'Available', NULL, '', '0.00', 'drinks', '2023-04-06 07:51:35', '2023-04-12 15:52:05'),
(51, 'red tea', '50', 'Available', NULL, '', '0.00', 'drinks', '2023-04-06 07:52:02', '2023-04-08 08:37:22'),
(52, 'cucumber', '50', 'Available', NULL, '', '0.00', 'drinks', '2023-04-06 07:52:18', '2023-04-12 15:52:05'),
(53, 'blue lemonade', '50', 'Available', NULL, '', '0.00', 'drinks', '2023-04-06 07:52:32', '2023-04-12 15:52:05'),
(54, 'gravy', '15', 'Available', NULL, '', '0.00', 'add-ons', '2023-04-06 08:01:52', '2023-04-17 08:39:27'),
(55, 'egg', '20', 'Available', NULL, '', '0.00', 'add-ons', '2023-04-06 08:02:07', '2023-04-12 15:52:05'),
(56, 'mix veggies', '15', 'Available', NULL, '', '0.00', 'add-ons', '2023-04-06 08:02:27', '2023-04-12 15:52:05');

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
  `created_at` datetime DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `password`, `role`, `token`, `created_at`, `update_at`) VALUES
(1, 'ADMIN', 'admin', 'jaybayron400@gmail.com', 'admin', 'Admin', 'csu4euvzm1c90bnzqr1swpkxc2y8tep0auls4ea8on000vg42r', '2023-03-21 22:39:36', '2023-04-16 13:31:51');

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
