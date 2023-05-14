-- Active: 1666468590274@@127.0.0.1@3306@hotplatepos
create database hotplatepos;
use  hotplatepos;

-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

CREATE TABLE settings (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    bussiness_name VARCHAR(200),
    bussiness_tin VARCHAR(50),
    address VARCHAR(100),
    contact_no VARCHAR(20),
    email VARCHAR(50),
    URL VARCHAR(100),
    logo LONGTEXT,
    auth VARCHAR(255),
    daily_report_hr VARCHAR(20),
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
);
    drop table settings;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    role VARCHAR(20) NOT NULL,
    hint VARCHAR(255),
    answer VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
    drop table users;

CREATE TABLE orders (
    order_id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    invoice_no INT(11) NOT NULL,
    customer VARCHAR(50) NOT NULL,
    total VARCHAR(20) NOT NULL,
    discount VARCHAR(20),
    total_discount VARCHAR(20),
    pay_type VARCHAR(20),
    payment INT DEFAULT 0,
    pay_change VARCHAR(20),
    service VARCHAR(20) NOT NULL,
    status VARCHAR(20) NOT NULL,
    payment_status VARCHAR(20),
    name LONGTEXT NOT NULL,
    quantity LONGTEXT NOT NULL,
    price LONGTEXT NOT NULL,
    note LONGTEXT,
    order_seen int(1) NOT NULL,
    count_update int(11) NOT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
    drop table orders;

CREATE TABLE products (
    product_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    price INT(11),
    status VARCHAR(50),
    picture LONGTEXT,
    description LONGTEXT,
    orig_quantity INT(11) DEFAULT 0, 
    quantity INT(11),
    reorder_level INT(11),
    total DECIMAL(10, 2),
    sale DECIMAL(10, 2),
    category VARCHAR(50),
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
    drop table products;

create table product_history(
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    product_name VARCHAR(50),
    type VARCHAR(50),
    transaction_count INT NOT NULL,
    updated_quantity INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
    drop table product_history;
    
create table daily_report() {
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50),
    total_sales DECIMAL(10,2),
    total_discount DECIMAL(10,2),
    total_tax DECIMAL(10,2),
    total_profit DECIMAL(10,2),
    total_cost DECIMAL(10,2),
    total_quantity INT,
    total_orders INT,
    total_customers INT,
    total_products INT,
    total_suppliers INT,
    total_transactions INT,
    total_payments INT, 
    total_expenses INT,
    total_receivables INT,
    total_payables INT,
    total_cash INT,
    total_credit INT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
};
    drop table daily_report;

-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO `products` (`product_id`, `name`, `price`, `status`, `picture`, `description`, `quantity`, `reorder_level`, `total`, `sale`, `category`, `create_at`, `update_at`) VALUES
    (1, 'Longadog', 80, 'Available', NULL, NULL, 50, 25, '4000.00', '0.00', 'meals', '2023-01-23 19:08:45', '2023-05-11 10:39:28'),
    (2, 'Burger Steak', 80, 'Available', NULL, NULL, 50, 25, '4000.00', '0.00', 'meals', '2023-01-23 19:10:52', '2023-05-11 10:39:28'),
    (3, 'Tocino Tips', 85, 'Available', NULL, NULL, 50, 25, '4250.00', '0.00', 'meals', '2023-01-23 19:10:52', '2023-05-11 10:39:28'),
    (4, 'Chicken BBQ', 85, 'Available', NULL, NULL, 50, 25, '4250.00', '0.00', 'meals', '2023-01-23 19:10:52', '2023-05-11 10:39:28'),
    (5, 'Pork BBQ', 85, 'Available', NULL, NULL, 50, 25, '4250.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (6, 'Chicken Teriyaki', 90, 'Available', NULL, NULL, 50, 25, '4500.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (7, 'Pork Teriyaki', 90, 'Available', NULL, NULL, 50, 25, '4500.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (8, 'Hungarian', 90, 'Available', NULL, NULL, 50, 25, '4500.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (9, 'Tapa Tips', 90, 'Available', NULL, NULL, 50, 25, '4500.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (10, 'Porkchop', 90, 'Available', NULL, NULL, 50, 25, '4500.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (11, 'Pork Sisig', 95, 'Available', NULL, NULL, 50, 25, '4750.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (12, 'Spicy Beef Tapa', 95, 'Available', NULL, NULL, 50, 25, '4750.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (13, 'Liempo', 95, 'Available', NULL, NULL, 50, 25, '4750.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (14, 'Gambas', 100, 'Available', NULL, NULL, 50, 25, '5000.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (15, 'Beef Pares', 100, 'Available', NULL, NULL, 50, 25, '5000.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (16, 'Boneless Bangus', 100, 'Available', NULL, NULL, 50, 25, '5000.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (17, 'T-Bone', 160, 'Available', NULL, NULL, 50, 25, '8000.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (18, 'Porter House', 170, 'Available', NULL, NULL, 50, 25, '8500.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (19, 'Sizzling Tofu', 140, 'Available', NULL, NULL, 50, 25, '7000.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (20, 'Sizzling Hotdog', 140, 'Available', NULL, NULL, 50, 25, '7000.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (21, 'Sizzling Sisig', 160, 'Available', NULL, NULL, 50, 25, '8000.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (22, 'Sizzling Gambas', 180, 'Available', NULL, NULL, 50, 25, '9000.00', '0.00', 'meals', '2023-01-23 19:16:45', '2023-05-11 10:39:28'),
    (23, 'Coke', 20, 'Available', NULL, NULL, 50, 25, '1000.00', '0.00', 'drinks', '2023-05-11 09:32:07', '2023-05-11 10:39:28'),
    (24, 'Royal', 20, 'Available', NULL, NULL, 50, 25, '1000.00', '0.00', 'drinks', '2023-05-11 09:33:01', '2023-05-11 10:39:28'),
    (25, 'Sprite', 20, 'Available', NULL, NULL, 50, 25, '1000.00', '0.00', 'drinks', '2023-05-11 09:33:15', '2023-05-11 10:39:28'),
    (26, 'Red Tea', 50, 'Available', NULL, NULL, 50, 25, '2500.00', '0.00', 'drinks', '2023-05-11 09:33:37', '2023-05-11 10:39:28'),
    (27, 'Cucumber', 50, 'Available', NULL, NULL, 50, 25, '2500.00', '0.00', 'drinks', '2023-05-11 09:34:01', '2023-05-11 10:39:28'),
    (28, 'Blue Lemonade', 50, 'Available', NULL, NULL, 50, 25, '2500.00', '0.00', 'drinks', '2023-05-11 09:34:22', '2023-05-11 10:39:28'),
    (29, 'Rice', 15, 'Available', NULL, NULL, 50, 25, '750.00', '0.00', 'add-ons', '2023-05-11 09:34:37', '2023-05-11 10:39:28'),
    (30, 'Gravy', 15, 'Available', NULL, NULL, 50, 25, '750.00', '0.00', 'add-ons', '2023-05-11 09:34:50', '2023-05-11 10:39:28'),
    (31, 'Egg', 15, 'Available', NULL, NULL, 50, 25, '750.00', '0.00', 'add-ons', '2023-05-11 09:35:01', '2023-05-11 10:39:28'),
    (32, 'Mix Veggies', 15, 'Available', NULL, NULL, 50, 25, '750.00', '0.00', 'add-ons', '2023-05-11 09:35:15', '2023-05-11 10:39:28'),
    (33, 'Takeout Box', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:36:25', '2023-05-11 10:39:26'),
    (34, 'Gravy Cup', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:36:25', '2023-05-11 10:39:26'),
    (35, 'Yello Coloring', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (36, 'Pares Cup', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (37, '12oz Plastic Cup', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (38, 'Plastic Medium', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (39, 'Plastic Small', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (40, 'Oyster', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (41, 'Mix Veggies', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (42, 'Sessame Seed', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (43, 'Fried Garlic', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (44, 'Butter', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (45, 'Brown Sugar', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (46, 'Magic Sarap', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (47, 'Cornstarch', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (48, 'Beef Cubes', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (49, 'Oil', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (50, 'Soy Sauce', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (51, 'Red Chili', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (52, 'Green Chili', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (53, 'Calamansi', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (54, 'Onion', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (55, 'Hot Sauce', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (56, 'Catsup', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (57, 'Rice', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (58, 'Egg', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (59, 'Spoon/Fork', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (60, 'Vinegar', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (61, 'Mayonnase', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (62, 'Margarine', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (63, 'Seasoning LIQ.', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (64, 'Bell Pepper', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (65, 'Garlic', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26'),
    (66, 'Salt/Pepper', 0, 'Available', NULL, NULL, 50, 25, '0.00', '0.00', 'supplies', '2023-05-11 09:42:29', '2023-05-11 10:39:26');
INSERT INTO `settings` (`id`, `bussiness_name`, `bussiness_tin`, `address`, `contact_no`, `email`, `URL`, `logo`, `auth`, `create_at`, `update_at`) VALUES
    (1, 'HotPlate Menu', '12345678910-0000', '1149 MARCELO H. DEL PILAR, CORNER CORDERO ST., ARKONG BATO, VALENZUELA 1444 METRO, MANILA VALENZUELA, PHILIPPINES', '09263065035', 'hotplate@gmail.com', 'fb.com/hotplatesizzling', NULL, NULL, '2023-03-06 12:51:07', '2023-04-14 13:34:58');

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `password`, `role`, `hint`, `answer`, `created_at`, `update_at`) VALUES
    (1, 'Admin', 'admin', 'admin@gmail.com', 'admin', 'Admin', 'favorite color?', 'blue', '2023-04-25 17:08:54', '2023-05-08 11:35:05'),
    (2, 'staff one', 'staff1', 'staffone@gmail.com', 'admin', 'Staff', NULL, NULL, '2023-05-08 19:22:04', '2023-05-08 11:42:19');
