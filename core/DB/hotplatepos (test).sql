-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 10:39 AM
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
  `payment` varchar(20) DEFAULT '0',
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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `invoice_no`, `customer`, `total`, `discount`, `total_discount`, `pay_type`, `payment`, `pay_change`, `service`, `status`, `payment_status`, `name`, `quantity`, `price`, `note`, `order_seen`, `count_update`, `create_at`, `update_at`) VALUES
(1, 376, 'Table 1', '345', '51.75', '293.25', NULL, '293.25', '0', 'DN', 'served', 'Paid', 'Porter House, Sizzling Hotdog, Coke, Gravy, ', '1, 1, 1, 1, ', '170, 140, 20, 15, ', '', 1, 0, '2023-05-15 14:39:12', '2023-05-17 16:51:09'),
(2, 295, 'Table 2', '285', '42.75', '242.25', NULL, '285', '42.75', 'DN', 'served', 'Paid', 'Pork Sisig, Chicken Teriyaki, Gambas, ', '1, 1, 1, ', '95, 90, 100, ', '', 1, 0, '2023-05-15 14:39:23', '2023-05-17 16:42:25'),
(3, 755, 'Table 3', '340', '0.00', '340', NULL, '350', '10', 'DN', 'served', 'Paid', 'Pork Teriyaki, Porkchop, T-Bone, ', '1, 1, 1, ', '90, 90, 160, ', '', 1, 0, '2023-05-15 14:39:35', '2023-05-17 16:42:25'),
(4, 18, 'Table 4', '230', '0.00', '230', NULL, '240', '10', 'DN', 'served', 'Paid', 'Chicken Teriyaki, Sizzling Hotdog, ', '1, 1, ', '90, 140, ', '', 1, 0, '2023-05-15 14:39:45', '2023-05-17 16:42:25'),
(5, 683, 'Table 5', '290', '0.00', '290', NULL, '290.00', '0', 'DN', 'served', 'Paid', 'Pork Teriyaki, Boneless Bangus, Beef Pares, ', '1, 1, 1, ', '90, 100, 100, ', '', 1, 0, '2023-05-15 14:40:04', '2023-05-15 16:08:43'),
(6, 777, 'Table 6', '240', '0.00', '240', NULL, '250', '10', 'DN', 'served', 'Paid', 'Longadog, Burger Steak, ', '2, 1, ', '160, 80, ', '', 1, 0, '2023-05-15 14:40:15', '2023-05-17 16:42:25'),
(7, 531, 'Table 7', '250', '37.50', '212.5', NULL, '250.00', '37.5', 'DN', 'served', 'Paid', 'Burger Steak, Tocino Tips, ', '1, 2, ', '80, 170, ', '', 1, 0, '2023-05-15 14:40:24', '2023-05-17 16:42:25'),
(8, 238, 'Table 8', '285', '0.00', '285', NULL, '285', '0', 'DN', 'served', 'Paid', 'Chicken BBQ, Pork BBQ, Mix Veggies, Egg, ', '2, 1, 1, 1, ', '170, 85, 15, 15, ', '', 1, 0, '2023-05-15 14:40:42', '2023-05-17 16:51:09'),
(9, 626, 'Table 9', '480', '72.00', '408', NULL, '500', '92', 'DN', 'served', 'Paid', 'T-Bone, Sizzling Sisig, ', '1, 2, ', '160, 320, ', '', 1, 0, '2023-05-15 14:41:01', '2023-05-17 16:42:25'),
(10, 484, 'Table 10', '690', '0.00', '690', NULL, '690.00', '0', 'DN', 'served', 'Paid', 'T-Bone, Sizzling Gambas, Porter House, ', '1, 2, 1, ', '160, 360, 170, ', '', 1, 0, '2023-05-15 14:41:10', '2023-05-15 16:03:00'),
(11, 222, 'Table 11', '415', '62.25', '352.75', NULL, '415', '62.25', 'DN', 'served', 'Paid', 'Blue Lemonade, Rice, T-Bone, ', '1, 3, 2, ', '50, 45, 320, ', '', 1, 0, '2023-05-15 14:41:26', '2023-05-17 16:42:25'),
(12, 462, 'Table 12', '460', '69.00', '391', NULL, '391', '0', 'DN', 'served', 'Paid', 'Chicken Teriyaki, Spicy Beef Tapa, Pork Teriyaki, ', '1, 2, 2, ', '90, 190, 180, ', '', 1, 0, '2023-05-15 14:41:56', '2023-05-17 16:51:09'),
(13, 578, 'Table 13', '275', '41.25', '233.75', NULL, '275.00', '41.25', 'DN', 'served', 'Paid', 'Liempo, Porkchop, ', '1, 2, ', '95, 180, ', '', 1, 0, '2023-05-15 14:42:05', '2023-05-17 16:42:25'),
(14, 99, 'Table 14', '350', '0.00', '350', NULL, '350', '0', 'DN', 'served', 'Paid', 'Pork Teriyaki, Hungarian, Coke, Gravy, Egg, Rice, ', '1, 2, 1, 1, 1, 2, ', '90, 180, 20, 15, 15, 30, ', '', 1, 0, '2023-05-15 14:42:29', '2023-05-17 16:51:09'),
(15, 286, 'Table 15', '360', '54.00', '306', NULL, '400', '94', 'DN', 'served', 'Paid', 'Tapa Tips, Porkchop, ', '2, 2, ', '180, 180, ', '', 1, 0, '2023-05-15 14:42:43', '2023-05-17 16:42:25'),
(16, 528, 'Table 16', '515', '77.25', '437.75', NULL, '437.75', '0', 'DN', 'served', 'Paid', 'Pork Sisig, Porkchop, Spicy Beef Tapa, Mix Veggies, Rice, ', '2, 1, 2, 1, 2, ', '190, 90, 190, 15, 30, ', '', 1, 0, '2023-05-15 14:43:13', '2023-05-17 16:51:09'),
(17, 598, 'Table 17', '595', '0.00', '595', NULL, '600.00', '5', 'DN', 'served', 'Paid', 'Sizzling Hotdog, Spicy Beef Tapa, Liempo, Rice, ', '2, 1, 2, 2, ', '280, 95, 190, 30, ', '', 1, 0, '2023-05-15 14:43:56', '2023-05-17 16:42:25'),
(18, 894, 'Table 18', '325', '48.75', '276.25', NULL, '325.00', '48.75', 'DN', 'served', 'Paid', 'Liempo, Gambas, Mix Veggies, ', '1, 2, 2, ', '95, 200, 30, ', '', 1, 0, '2023-05-15 14:44:48', '2023-05-17 16:42:25'),
(19, 754, 'Table 19', '275', '0.00', '275', NULL, '300', '25', 'DN', 'served', 'Paid', 'Spicy Beef Tapa, Boneless Bangus, Rice, Red Tea, ', '1, 1, 2, 1, ', '95, 100, 30, 50, ', '', 1, 0, '2023-05-15 14:45:07', '2023-05-17 16:42:25'),
(20, 854, 'Table 20', '485', '0.00', '485', NULL, '485.00', '0', 'DN', 'served', 'Paid', 'Sizzling Hotdog, Sizzling Sisig, Rice, Mix Veggies, ', '2, 1, 2, 1, ', '280, 160, 30, 15, ', '', 1, 0, '2023-05-15 14:45:31', '2023-05-15 16:10:00'),
(21, 290, 'Table 1', '480', '0.00', '480', NULL, '200', '-280', 'DN', 'served', 'Balance', '++Burger Steak, +Burger Steak, Longadog, ', '2, 2, 2, ', '160, 160, 160, ', '', 1, 2, '2023-05-15 16:24:31', '2023-05-17 16:52:28'),
(23, 760, 'Table 8', '280', '0.00', '280', NULL, '280.00', '0', 'DN', 'served', 'Paid', 'Spicy Beef Tapa, Chicken Teriyaki, ', '2, 1, ', '190, 90, ', '', 1, 0, '2023-05-17 06:59:14', '2023-05-17 07:00:51'),
(24, 712, 'Table 1', '160', '0.00', '160', NULL, '160.00', '0', 'DN', 'served', 'Paid', '+Burger Steak, Longadog, ', '1, 1, ', '80, 80, ', '', 1, 1, '2023-05-17 07:21:20', '2023-05-17 17:08:40'),
(25, 828, 'Table 5', '175', '0.00', '175', NULL, '175.00', '0', 'DN', 'served', 'Paid', 'Burger Steak, Pork Sisig, ', '1, 1, ', '80, 95, ', '', 1, 0, '2023-05-17 16:26:30', '2023-05-17 16:46:34'),
(26, 215, 'Table 9', '185', '0', '185', NULL, '0', '-185', 'DN', 'served', 'Unpaid', 'Porkchop, Pork Sisig, ', '1, 1, ', '90, 95, ', '', 1, 0, '2023-05-17 16:28:40', '2023-05-17 16:50:48'),
(27, 649, 'Table 18', '420', '0', '420', NULL, '0', '-420', 'DN', 'served', 'Unpaid', '+Spicy Beef Tapa, +Sizzling Hotdog, Chicken Teriyaki, Spicy Beef Tapa, ', '1, 1, 1, 1, ', '95, 140, 90, 95, ', '', 1, 1, '2023-05-17 16:29:20', '2023-05-17 17:09:08'),
(28, 947, 'Table 20', '460', '0.00', '460', NULL, '320.00', '-140', 'DN', 'served', 'Paid', '+Sizzling Hotdog, Pork BBQ, Pork Sisig, Sizzling Tofu, ', '1, 1, 1, 1, ', '140, 85, 95, 140, ', '', 1, 1, '2023-05-17 16:32:05', '2023-05-17 16:58:10'),
(29, 556, 'Table 19', '190', '0.00', '190', NULL, '120', '-70', 'DN', 'served', 'Balance', 'Spicy Beef Tapa, ', '2, ', '190, ', '', 1, 0, '2023-05-17 16:35:04', '2023-05-17 16:56:41'),
(30, 691, 'Table 8', '520', '78.00', '442', NULL, '442', '0', 'DN', 'served', 'Paid', 'Boneless Bangus, Sizzling Tofu, Sizzling Hotdog, ', '1, 2, 1, ', '100, 280, 140, ', '', 1, 0, '2023-05-17 16:45:23', '2023-05-17 16:56:43'),
(31, 823, 'Table 1', '745', '0', '745', NULL, '200', '-545', 'DN', 'served', 'Balance', '+Pork Sisig, +Tapa Tips, Chicken Teriyaki, Porkchop, Boneless Bangus, ', '1, 3, 1, 1, 2, ', '95, 270, 90, 90, 200, ', '', 1, 1, '2023-05-17 16:52:58', '2023-05-17 16:58:13'),
(32, 704, 'Table 20', '290', '0', '290', NULL, '0', '-290', 'DN', 'served', 'Unpaid', 'Spicy Beef Tapa, Pork Sisig, Boneless Bangus, ', '1, 1, 1, ', '95, 95, 100, ', '', 1, 0, '2023-05-17 16:54:03', '2023-05-17 16:56:46'),
(33, 930, 'Table 20', '90', '0', '90', NULL, '0', '-90', 'DN', 'served', 'Unpaid', 'Porkchop, ', '1, ', '90, ', '', 1, 0, '2023-05-17 16:54:38', '2023-05-17 17:35:41'),
(34, 129, 'Table 20', '380', '0', '380', NULL, '50', '-330', 'DN', 'served', 'Balance', '+Sizzling Tofu, +Sizzling Hotdog, Boneless Bangus, ', '1, 1, 1, ', '140, 140, 100, ', '', 1, 1, '2023-05-17 16:55:11', '2023-05-17 17:37:37'),
(35, 600, 'Table 7', '375', '0', '375', NULL, '0', '-375', 'DN', 'served', 'Unpaid', 'Spicy Beef Tapa, Sizzling Hotdog, Sizzling Tofu, ', '1, 1, 1, ', '95, 140, 140, ', '', 1, 0, '2023-05-17 17:28:41', '2023-05-17 17:39:04'),
(36, 194, 'Table 7', '235', '0', '235', NULL, '0', '-235', 'DN', 'served', 'Unpaid', 'Spicy Beef Tapa, Sizzling Hotdog, ', '1, 1, ', '95, 140, ', '', 1, 0, '2023-05-17 17:31:07', '2023-05-17 17:40:01');

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
(1, 'Longadog', 80, 'Available', NULL, NULL, 48, 48, 25, '3840.00', '0.00', 'meals', '2023-01-23 11:08:45', '2023-05-17 17:13:27'),
(2, 'Burger Steak', 80, 'Available', NULL, NULL, 49, 49, 25, '3920.00', '0.00', 'meals', '2023-01-23 11:10:52', '2023-05-17 17:13:27'),
(3, 'Tocino Tips', 85, 'Available', NULL, NULL, 48, 48, 25, '4080.00', '0.00', 'meals', '2023-01-23 11:10:52', '2023-05-17 17:13:27'),
(4, 'Chicken BBQ', 85, 'Available', NULL, NULL, 48, 48, 25, '4080.00', '0.00', 'meals', '2023-01-23 11:10:52', '2023-05-17 17:13:27'),
(5, 'Pork BBQ', 85, 'Available', NULL, NULL, 47, 47, 25, '3995.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(6, 'Chicken Teriyaki', 90, 'Available', NULL, NULL, 42, 42, 25, '3780.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(7, 'Pork Teriyaki', 90, 'Available', NULL, NULL, 45, 45, 25, '4050.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(8, 'Hungarian', 90, 'Available', NULL, NULL, 48, 48, 25, '4320.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(9, 'Tapa Tips', 90, 'Available', NULL, NULL, 48, 48, 25, '4320.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(10, 'Porkchop', 90, 'Available', NULL, NULL, 38, 38, 25, '3420.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:35:51'),
(11, 'Pork Sisig', 95, 'Available', NULL, NULL, 42, 42, 25, '3990.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(12, 'Spicy Beef Tapa', 95, 'Available', NULL, NULL, 30, 30, 25, '2850.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:40:01'),
(13, 'Liempo', 95, 'Available', NULL, NULL, 46, 46, 25, '4370.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(14, 'Gambas', 100, 'Available', NULL, NULL, 47, 47, 25, '4700.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(15, 'Beef Pares', 100, 'Available', NULL, NULL, 49, 49, 25, '4900.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(16, 'Boneless Bangus', 100, 'Available', NULL, NULL, 39, 39, 25, '3900.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:37:46'),
(17, 'T-Bone', 160, 'Available', NULL, NULL, 45, 45, 25, '7200.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(18, 'Porter House', 170, 'Available', NULL, NULL, 48, 48, 25, '8160.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(19, 'Sizzling Tofu', 140, 'Available', NULL, NULL, 43, 43, 25, '6020.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:39:15'),
(20, 'Sizzling Hotdog', 140, 'Available', NULL, NULL, 36, 36, 25, '5040.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:40:01'),
(21, 'Sizzling Sisig', 160, 'Available', NULL, NULL, 47, 47, 25, '7520.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(22, 'Sizzling Gambas', 180, 'Available', NULL, NULL, 48, 48, 25, '8640.00', '0.00', 'meals', '2023-01-23 11:16:45', '2023-05-17 17:13:27'),
(23, 'Coke', 20, 'Available', NULL, NULL, 48, 48, 25, '960.00', '0.00', 'drinks', '2023-05-11 01:32:07', '2023-05-17 17:13:27'),
(24, 'Royal', 20, 'Available', NULL, NULL, 50, 50, 25, '1000.00', '0.00', 'drinks', '2023-05-11 01:33:01', '2023-05-14 08:50:13'),
(25, 'Sprite', 20, 'Available', NULL, NULL, 50, 50, 25, '1000.00', '0.00', 'drinks', '2023-05-11 01:33:15', '2023-05-14 08:50:13'),
(26, 'Red Tea', 50, 'Available', NULL, NULL, 49, 49, 25, '2450.00', '0.00', 'drinks', '2023-05-11 01:33:37', '2023-05-17 17:13:27'),
(27, 'Cucumber', 50, 'Available', NULL, NULL, 50, 50, 25, '2500.00', '0.00', 'drinks', '2023-05-11 01:34:01', '2023-05-14 08:50:13'),
(28, 'Blue Lemonade', 50, 'Available', NULL, NULL, 49, 49, 25, '2450.00', '0.00', 'drinks', '2023-05-11 01:34:22', '2023-05-17 17:13:27'),
(29, 'Rice', 15, 'Available', NULL, NULL, 37, 37, 25, '555.00', '0.00', 'add-ons', '2023-05-11 01:34:37', '2023-05-15 15:00:01'),
(30, 'Gravy', 15, 'Available', NULL, NULL, 48, 48, 25, '720.00', '0.00', 'add-ons', '2023-05-11 01:34:50', '2023-05-17 17:13:27'),
(31, 'Egg', 15, 'Available', NULL, NULL, 48, 48, 25, '720.00', '0.00', 'add-ons', '2023-05-11 01:35:01', '2023-05-15 15:00:01'),
(32, 'Mix Veggies', 15, 'Available', NULL, NULL, 45, 45, 25, '675.00', '0.00', 'add-ons', '2023-05-11 01:35:15', '2023-05-15 15:00:01'),
(33, 'Takeout Box', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:36:25', '2023-05-14 08:50:13'),
(34, 'Gravy Cup', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:36:25', '2023-05-14 08:50:13'),
(35, 'Yello Coloring', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(36, 'Pares Cup', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(37, '12oz Plastic Cup', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(38, 'Plastic Medium', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(39, 'Plastic Small', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(40, 'Oyster', 0, 'Available', NULL, NULL, 50, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-14 08:50:13'),
(41, 'Mix Veggies', 0, 'Available', NULL, NULL, 45, 45, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-15 15:00:01'),
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
(57, 'Rice', 0, 'Available', NULL, NULL, 37, 37, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-15 15:00:01'),
(58, 'Egg', 0, 'Available', NULL, NULL, 48, 48, 25, '0.00', '0.00', 'supplies', '2023-05-11 01:42:29', '2023-05-15 15:00:01'),
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

--
-- Dumping data for table `product_history`
--

INSERT INTO `product_history` (`id`, `product_id`, `product_name`, `type`, `transaction_count`, `updated_quantity`, `created_at`) VALUES
(1, 1, 'Longadog', 'IN', 8, 50, '2023-05-17 07:20:51'),
(2, 2, 'Burger Steak', 'IN', 2, 50, '2023-05-17 07:22:06');

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
(1, 'HotPlate Menu', '12345678910-0000', '1149 MARCELO H. DEL PILAR, CORNER CORDERO ST., ARKONG BATO, VALENZUELA 1444 METRO, MANILA VALENZUELA', '09263065035', 'hotplate@gmail.com', 'fb.com/hotplatesizzling', NULL, NULL, '01 : 00 : 00', '2023-03-06 04:51:07', '2023-05-17 17:54:12');

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `product_history`
--
ALTER TABLE `product_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
