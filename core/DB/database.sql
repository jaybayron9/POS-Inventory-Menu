-- Active: 1666468590274@@127.0.0.1@3306@hotplatepos
create database hotplateposv2;
use  hotplateposv2;

-- warning: do not execute, not yet ready!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
CREATE TABLE settings (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    bussiness_name VARCHAR(255) NULL,
    address VARCHAR(255) NULL,
    contact_no VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    URL VARCHAR(255) NULL,
    logo VARCHAR(255) NULL,
    auth VARCHAR(255) NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
drop table settings;

CREATE TABLE users ( 
    user_id INT AUTO_INCREMENT PRIMARY KEY,     
    name VARCHAR(255) NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    token VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

drop table users;

CREATE TABLE orders (
    order_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    customer VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    price VARCHAR(255) NOT NULL,
    quantity VARCHAR(255) NOT NULL,
    total VARCHAR(255) NOT NULL,
    total_discount VARCHAR(255) NULl,
    discount VARCHAR(255) NULL,
    service VARCHAR(255) NOT NULL,
    pay_type VARCHAR(255) NOT NULL,
    note LONGTEXT,
    invoice_no VARCHAR(255) NOT NULL,
    status VARCHAR(255) NOT NULL,
    order_seen int(1) NOT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

drop table orders;

CREATE TABLE products (
    product_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price VARCHAR(255) NOT NULL,
    status VARCHAR(255) NOT NULL,
    picture LONGTEXT,
    description LONGTEXT,
    sale DECIMAL(8, 2),
    category VARCHAR(255),
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
drop table products;
CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    quantity INT NOT NULL,
    unit_cost DECIMAL(10,2) NOT NULL,
    total_value DECIMAL(10,2) NOT NULL,
    reorder_level INT NOT NULL,
    supplier VARCHAR(255),
    location VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP table `inventory`;


INSERT INTO `inventory` (`ItemID`, `ItemName`, `Description`, `ReorderPoints`, `Quantity`, `Unit`, `UnitPrice`, `TotalValue`, `Supplier`, `Location`, `Created_at`, `Updated_at`) VALUES
(1, 'Ground pork', '', '78', '50.00', 'lb', '50.00', '2500.00', '', '', '2023-03-05 12:34:55', '2023-03-06 08:00:20'),
(2, 'Garlic', '', '12', '50.00', 'unit', '0.00', '0.00', '', '', '2023-03-05 12:35:04', '2023-03-06 08:00:20'),
(3, 'Soy sauce', '', '-32', '50.00', 'lb', '0.00', '0.00', '', '', '2023-03-05 12:35:15', '2023-03-06 08:00:20'),
(4, 'Vinegar', '', '78', '50.00', 'oz', '0.00', '0.00', '', '', '2023-03-05 12:35:26', '2023-03-06 08:00:20'),
(5, 'Brown sugar', '', '56', '50.00', 'each', '0.00', '0.00', '', '', '2023-03-05 12:35:34', '2023-03-06 08:00:20'),
(6, 'Salt', '', '-32', '50.00', 'lb', '0.00', '0.00', '', '', '2023-03-05 13:48:49', '2023-03-06 08:00:20'),
(7, 'Black pepper', '', '-32', '50.00', 'each', '0.00', '0.00', '', '', '2023-03-05 13:48:49', '2023-03-06 08:00:20'),
(8, 'Paprika', '', '78', '50.00', 'L', '0.00', '0.00', '', '', '2023-03-05 13:48:49', '2023-03-06 08:00:20'),
(9, 'Red pepper flakes', '', '78', '50.00', 'oz', '0.00', '0.00', '', '', '2023-03-05 13:48:49', '2023-03-06 08:00:20'),
(10, 'Casing', '', '78', '50.00', 'each', '0.00', '0.00', '', '', '2023-03-05 13:48:49', '2023-03-06 08:00:20');

INSERT INTO `products` (`product_id`, `name`, `price`, `status`, `picture`, `description`, `sale`, `category`, `create_at`, `update_at`) VALUES
(1, 'Longadog', '80', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:08:45', '2023-03-01 02:35:42'),
(2, 'Burger Steak', '80', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:10:52', '2023-03-01 02:35:43'),
(3, 'Tocino Tips', '85', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:10:52', '2023-03-01 02:35:44'),
(4, 'Chicken BBQ', '85', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:10:52', '2023-03-01 12:25:56'),
(5, 'Pork BBQ', '85', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-03-01 02:35:48'),
(6, 'Chicken Teriyaki', '90', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-03-01 02:35:49'),
(7, 'Pork Teriyaki', '90', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:19:11'),
(8, 'Hungarian', '90', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:19:11'),
(9, 'Tapa Tips', '90', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:19:11'),
(10, 'Porkchop', '90', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-03-01 12:25:56'),
(11, 'Pork Sisig', '95', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-03-01 02:32:09'),
(12, 'Spicy Beef Tapa', '95', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-03-01 02:32:09'),
(13, 'Liempo', '95', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:17:34'),
(14, 'Gambas', '100', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:17:34'),
(15, 'Beef Pares', '100', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:17:34'),
(16, 'Boneless Bangus', '100', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:17:34'),
(17, 'T-Bone', '160', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-03-01 02:32:09'),
(18, 'Porter House', '170', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-03-01 02:32:09'),
(19, 'Sizzling Tofu', '140', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:17:34'),
(20, 'Sizzling Hotdog', '140', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:17:34'),
(21, 'Sizzling Sisig', '160', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:17:34'),
(22, 'Sizzling Gambas', '180', 'On Hand', NULL, NULL, '0.00', 'meals', '2023-01-25 03:16:45', '2023-02-28 13:17:34'),
(24, 'juice', '25', 'On Hand', NULL, NULL, '0.00', 'drinks', '2023-02-24 05:10:06', '2023-02-28 13:17:34'),
(25, 'water', '0', 'On Hand', NULL, NULL, '0.00', 'drinks', '2023-02-24 05:11:20', '2023-02-24 12:01:04');

update orders set status = '';

INSERT INTO inventory (item_name, description, quantity, unit_cost, total_value, reorder_level, supplier, location)
VALUES 
  ('Beef', 'Fresh ground beef for burgers', 50, 2.50, 125.00, 10, 'Meat Co.', 'Walk-in Freezer'),
  ('Chicken Breast', 'Boneless, skinless chicken breast', 75, 2.00, 150.00, 20, 'Poultry Farms Inc.', 'Walk-in Cooler'),
  ('Potatoes', 'Fresh potatoes for french fries', 100, 0.50, 50.00, 30, 'Farm Fresh Produce', 'Dry Storage'),
  ('Buns', 'Freshly baked hamburger buns', 150, 0.25, 37.50, 50, 'Bakery Co.', 'Dry Storage'),
  ('Cheese', 'Sliced American cheese', 50, 1.00, 50.00, 5, 'Dairy Farms Inc.', 'Walk-in Cooler');
