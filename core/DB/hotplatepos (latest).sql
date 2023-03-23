-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2023 at 03:48 PM
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
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(50) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Quantity` decimal(8,2) DEFAULT NULL,
  `Unit` varchar(50) DEFAULT NULL,
  `UnitPrice` decimal(8,2) DEFAULT NULL,
  `TotalValue` decimal(8,2) DEFAULT NULL,
  `Supplier` varchar(50) DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  `LeadTime` int(11) DEFAULT NULL,
  `ReorderPoints` decimal(8,2) DEFAULT NULL,
  `DemandVariability` decimal(8,2) DEFAULT NULL,
  `SafetyStock` decimal(8,2) DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ItemID`, `ItemName`, `Description`, `Category`, `Quantity`, `Unit`, `UnitPrice`, `TotalValue`, `Supplier`, `Location`, `LeadTime`, `ReorderPoints`, `DemandVariability`, `SafetyStock`, `Created_at`, `Updated_at`) VALUES
(1, 'Sugar', 'Granulated white sugar', NULL, '30.00', 'lbs', '0.25', '7.50', 'Domino Sugar', 'Warehouse B', 5, '-600.00', '0.30', '2.00', '2023-03-05 23:03:45', '2023-03-21 14:47:45'),
(2, 'Salt', 'Table salt', NULL, '20.00', 'lbs', '0.10', '2.00', 'Morton Salt', 'Warehouse A', 3, '-1707.00', '0.10', '3.00', '2023-03-05 23:03:46', '2023-03-21 14:47:45'),
(3, 'Olive Oil', 'Extra-virgin olive oil', NULL, '15.00', 'liters', '5.00', '75.00', 'California Olive Ranch', 'Warehouse C', 14, '-587.00', '0.40', '1.00', '2023-03-05 23:03:47', '2023-03-21 14:47:45'),
(4, 'Balsamic Vinegar', 'Aged balsamic vinegar', NULL, '10.00', 'liters', '10.00', '100.00', 'Acetaia Leonardi', 'Warehouse D', 21, '-15.00', '0.20', '1.00', '2023-03-05 23:03:48', '2023-03-21 14:47:45'),
(5, 'Garlic', 'Fresh garlic bulbs', NULL, '25.00', 'lbs', '2.50', '62.50', 'Local Farmer', 'Warehouse A', 7, '-1375.00', '0.50', '2.00', '2023-03-05 23:03:49', '2023-03-21 14:47:45'),
(6, 'Onions', 'Yellow onions', NULL, '40.00', 'lbs', '1.00', '40.00', 'Local Farmer', 'Warehouse B', 5, '-130.00', '0.40', '3.00', '2023-03-05 23:03:50', '2023-03-21 14:47:45'),
(7, 'Tomatoes', 'Fresh ripe tomatoes', NULL, '30.00', 'lbs', '2.00', '60.00', 'Local Farmer', 'Warehouse C', 4, '-15.00', '0.30', '2.00', '2023-03-05 23:03:51', '2023-03-21 14:47:45'),
(8, 'Lettuce', 'Fresh leafy lettuce', NULL, '20.00', 'lbs', '3.00', '60.00', 'Local Farmer', 'Warehouse D', 3, '-15.00', '0.20', '2.00', '2023-03-05 23:03:53', '2023-03-21 14:47:45'),
(9, 'Salmon Fillets', 'Fresh wild-caught salmon fillets', NULL, '30.00', 'lbs', '12.00', '360.00', 'Local Seafood Market', 'Warehouse C', 14, '-15.00', '0.70', '2.00', '2023-03-05 23:05:42', '2023-03-21 14:47:45'),
(10, 'Beef Sirloin', 'Fresh boneless beef sirloin', NULL, '40.00', 'lbs', '6.00', '240.00', 'Local Butcher', 'Warehouse B', 10, '-210.00', '0.60', '3.00', '2023-03-05 23:05:44', '2023-03-21 14:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `total_discount` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `service` varchar(255) NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `note` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `order_seen` int(1) NOT NULL,
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
(1, 'Longadog', '80', 'On Hand', NULL, 'Sugar, Salt, Olive Oil, Balsamic Vinegar, Garlic, Onions, Tomatoes, Lettuce, Salmon Fillets, Beef Sirloin', '0.00', 'meals', '2023-01-24 03:08:45', '2023-03-18 19:47:00'),
(2, 'Burger Steak', '80', 'On Hand', NULL, 'Ground beef, Onion, Bread crumbs, Egg, Worcestershire sauce, Salt, Black pepper, Butter, Flour, Beef broth, Soy sauce, Onion powder, Garlic powder, Cornstarch, Water', '0.00', 'meals', '2023-01-24 03:10:52', '2023-03-04 09:59:27'),
(3, 'Tocino Tips', '85', 'On Hand', NULL, 'Pork shoulder or pork belly, sliced into thin tips, Pineapple juice, Soy sauce, Brown sugar, Garlic, minced, Salt, Black pepper, Red food coloring', '0.00', 'meals', '2023-01-24 03:10:52', '2023-03-21 04:19:46'),
(4, 'Chicken BBQ', '85', 'On Hand', NULL, 'Chicken thighs or chicken legs, Soy sauce, Ketchup, Brown sugar, Garlic, minced, Lemon or calamansi juice, Salt, Black pepper, Cooking oil', '0.00', 'meals', '2023-01-24 03:10:52', '2023-03-18 19:19:24'),
(5, 'Pork BBQ', '85', 'On Hand', NULL, 'Pork shoulder or pork belly, Soy sauce, Vinegar, Brown sugar, Ketchup, Garlic, minced, Salt, Black pepper, Banana ketchup, Pineapple juice, Wooden skewers', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-21 05:16:28'),
(6, 'Chicken Teriyaki', '90', 'On Hand', NULL, 'Chicken, Soy sauce, Mirin, Sake, Sugar, Garlic, minced, Ginger, grated, Cornstarch, Water, Vegetable oil', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-21 05:16:28'),
(7, 'Pork Teriyaki', '90', 'On Hand', NULL, 'Pork, Soy sauce, Mirin, Sake, Sugar, Garlic, minced, Ginger, grated, Sesame oil, Cornstarch, Water, Green onions, Sesame seeds', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-18 19:19:24'),
(8, 'Hungarian', '90', 'On Hand', NULL, 'Pork, beef, Garlic, Salt, Black pepper, Paprika, Caraway seeds, Allspice, Coriander seeds, Mustard seeds, Water or red wine', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-18 19:19:24'),
(9, 'Tapa Tips', '90', 'On Hand', NULL, 'Beef sirloin,  Soy sauce, Vinegar, Brown sugar, Garlic, minced, Salt, Black pepper', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-21 04:19:46'),
(10, 'Porkchop', '90', 'On Hand', NULL, 'Pork chops, Salt, Black pepper, Garlic powder, Paprika, Olive oil or vegetable oil, Butter, Fresh herbs', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-21 05:16:28'),
(11, 'Pork Sisig', '95', 'On Hand', NULL, 'Pork head, ears, and liver, Onion, Garlic, Ginger, Calamansi juice, Soy sauce, Vinegar, Mayonnaise, Salt, Black pepper, Red chili peppers', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-21 05:16:28'),
(12, 'Spicy Beef Tapa', '95', 'On Hand', NULL, 'Beef sirloin, Soy sauce, Vinegar, Brown sugar, Garlic, minced, Salt, Black pepper, Red pepper flakes, Oil', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-21 05:16:28'),
(13, 'Liempo', '95', 'On Hand', NULL, 'Pork belly, Soy sauce, Vinegar, Garlic, minced, Salt, Black pepper, Brown sugar, Lemon', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-11 10:54:00'),
(14, 'Gambas', '100', 'On Hand', NULL, 'Large shrimp, Garlic, minced, Olive oil, Paprika, Red pepper flakes, Lemon juice, Salt, Parsley', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-17 05:38:34'),
(15, 'Beef Pares', '100', 'On Hand', NULL, 'Beef chuck, Soy sauce, Brown sugar, Star anise, Garlic, minced, Ginger, sliced, Water, Cornstarch, Salt, Black pepper, Oil', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-11 10:54:51'),
(16, 'Boneless Bangus', '100', 'On Hand', NULL, 'Boneless Bangus,\r\nVinegar,\r\nGarlic, minced,\r\nSalt,\r\nBlack pepper,\r\nOil', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-21 05:16:28'),
(17, 'T-Bone', '160', 'On Hand', NULL, 'T-bone steak, Salt, Black pepper, Olive oil, Butter, Garlic cloves, Fresh herbs', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-21 05:16:28'),
(18, 'Porter House', '170', 'On Hand', NULL, 'Porterhouse steak, Salt, Black pepper, Olive oil, Garlic cloves,', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-21 05:16:28'),
(19, 'Sizzling Tofu', '140', 'On Hand', NULL, 'Firm tofu, \r\nCornstarch,\r\nCooking oil,\r\nGarlic, \r\nOnion,\r\nBell peppers,\r\nSoy sauce,\r\nOyster sauce,\r\nSugar,\r\nWater,\r\nGreen onions,', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-04 10:14:31'),
(20, 'Sizzling Hotdog', '140', 'On Hand', NULL, 'Hotdogs,\r\nCooking oil,\r\nOnions,\r\nSoy sauce,\r\nKetchup,\r\nWorcestershire sauce,\r\nSugar,\r\nWater,\r\nCornstarch', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-04 10:18:03'),
(21, 'Sizzling Sisig', '160', 'On Hand', NULL, 'Hotdogs, Onions, Butter, Ketchup, Mayonnaise, Mustard, Worcestershire sauce, Soy sauce, Sugar, Lemon juice, Salt, Black pepper, Cheese, Chili flakes	', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-04 10:17:23'),
(22, 'Sizzling Gambas', '180', 'On Hand', NULL, 'Shrimp, Garlic,  Onion, Tomato sauce, Soy sauce, Worcestershire sauce, Sugar, Red chili peppers, Butter, Olive oil, Salt, Black pepper, Spring onions', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-21 04:01:35'),
(24, 'juice', '25', 'On Hand', NULL, 'Shrimp, Garlic,  Onion,  Tomato sauce, Soy sauce, Worcestershire sauce, Sugar, Red chili peppers, Butter, Olive oil, Salt, Black pepper, Spring onions', '0.00', 'drinks', '2023-02-23 05:10:06', '2023-03-04 15:07:45'),
(25, 'water', '0', 'On Hand', NULL, 'Shrimp, Garlic,  Onion,  Tomato sauce, Soy sauce, Worcestershire sauce, Sugar, Red chili peppers, Butter, Olive oil, Salt, Black pepper, Spring onions', '0.00', 'drinks', '2023-02-23 05:11:20', '2023-03-04 15:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `bussiness_name` varchar(255) DEFAULT NULL,
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

INSERT INTO `settings` (`id`, `bussiness_name`, `address`, `contact_no`, `email`, `URL`, `logo`, `auth`, `create_at`, `update_at`) VALUES
(1, 'HotPlate Menu', '1149 Marcelo H. Del Pilar, Corner Cordero St, Arkong Bato, Valenzuela, 1444 Metro Manila, Valenzuela, Philippines', '09263065035', 'hotplate@gmail.com', 'https://www.fb.com/hotplatesizzling', NULL, NULL, '2023-03-06 20:51:07', '2023-03-17 07:29:42');

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
(1, 'admin', 'hotplate', 'hotplate@gmail.com', 'hotplate', 'Admin', NULL, '2023-03-21 22:39:36', '2023-03-21 14:39:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`ItemID`);

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
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
