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


INSERT INTO `inventory` (`id`, `item_name`, `description`, `quantity`, `unit_cost`, `total_value`, `reorder_level`, `supplier`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Beef', 'Fresh ground beef for burgers', 50, '2.50', '125.00', 10, 'Meat Co.', 'Walk-in Freezer', '2023-03-28 14:34:33', '2023-03-28 14:34:33'),
(2, 'Chicken Breast', 'Boneless, skinless chicken breast', 75, '2.00', '150.00', 20, 'Poultry Farms Inc.', 'Walk-in Cooler', '2023-03-28 14:34:33', '2023-03-28 14:34:33'),
(3, 'Potatoes', 'Fresh potatoes for french fries', 100, '0.50', '50.00', 30, 'Farm Fresh Produce', 'Dry Storage', '2023-03-28 14:34:33', '2023-03-28 14:34:33'),
(4, 'Buns', 'Freshly baked hamburger buns', 150, '0.25', '37.50', 50, 'Bakery Co.', 'Dry Storage', '2023-03-28 14:34:33', '2023-03-28 14:34:33'),
(5, 'Cheese', 'Sliced American cheese', 50, '1.00', '50.00', 5, 'Dairy Farms Inc.', 'Walk-in Cooler', '2023-03-28 14:34:33', '2023-03-28 14:34:33');

INSERT INTO `products` (`product_id`, `name`, `price`, `status`, `picture`, `description`, `sale`, `category`, `create_at`, `update_at`) VALUES
(1, 'Longadog', '80', 'Available', NULL, 'Sugar, Salt, Olive Oil, Balsamic Vinegar, Garlic, Onions, Tomatoes, Lettuce, Salmon Fillets, Beef Sirloin', '80.00', 'meals', '2023-01-24 03:08:45', '2023-03-31 15:42:48'),
(2, 'Burger Steak', '80', 'Available', NULL, 'Ground beef, Onion, Bread crumbs, Egg, Worcestershire sauce, Salt, Black pepper, Butter, Flour, Beef broth, Soy sauce, Onion powder, Garlic powder, Cornstarch, Water', '80.00', 'meals', '2023-01-24 03:10:52', '2023-03-31 15:42:48'),
(3, 'Tocino Tips', '85', 'Available', NULL, 'Pork shoulder or pork belly, sliced into thin tips, Pineapple juice, Soy sauce, Brown sugar, Garlic, minced, Salt, Black pepper, Red food coloring', '85.00', 'meals', '2023-01-24 03:10:52', '2023-03-31 15:42:48'),
(4, 'Chicken BBQ', '85', 'Available', NULL, 'Chicken thighs or chicken legs, Soy sauce, Ketchup, Brown sugar, Garlic, minced, Lemon or calamansi juice, Salt, Black pepper, Cooking oil', '0.00', 'meals', '2023-01-24 03:10:52', '2023-03-30 14:51:46'),
(5, 'Pork BBQ', '85', 'Available', NULL, 'Pork shoulder or pork belly, Soy sauce, Vinegar, Brown sugar, Ketchup, Garlic, minced, Salt, Black pepper, Banana ketchup, Pineapple juice, Wooden skewers', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-30 14:51:46'),
(6, 'Chicken Teriyaki', '90', 'Available', NULL, 'Chicken, Soy sauce, Mirin, Sake, Sugar, Garlic, minced, Ginger, grated, Cornstarch, Water, Vegetable oil', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-31 15:41:55'),
(7, 'Pork Teriyaki', '90', 'Available', NULL, 'Pork, Soy sauce, Mirin, Sake, Sugar, Garlic, minced, Ginger, grated, Sesame oil, Cornstarch, Water, Green onions, Sesame seeds', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-28 15:16:52'),
(8, 'Hungarian', '90', 'Available', NULL, 'Pork, beef, Garlic, Salt, Black pepper, Paprika, Caraway seeds, Allspice, Coriander seeds, Mustard seeds, Water or red wine', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-29 13:30:33'),
(9, 'Tapa Tips', '90', 'Available', NULL, 'Beef sirloin,  Soy sauce, Vinegar, Brown sugar, Garlic, minced, Salt, Black pepper', '90.00', 'meals', '2023-01-24 03:16:45', '2023-03-31 15:43:11'),
(10, 'Porkchop', '90', 'Available', NULL, 'Pork chops, Salt, Black pepper, Garlic powder, Paprika, Olive oil or vegetable oil, Butter, Fresh herbs', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-30 14:51:46'),
(11, 'Pork Sisig', '95', 'Available', NULL, 'Pork head, ears, and liver, Onion, Garlic, Ginger, Calamansi juice, Soy sauce, Vinegar, Mayonnaise, Salt, Black pepper, Red chili peppers', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-31 15:41:55'),
(12, 'Spicy Beef Tapa', '95', 'Available', NULL, 'Beef sirloin, Soy sauce, Vinegar, Brown sugar, Garlic, minced, Salt, Black pepper, Red pepper flakes, Oil', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-31 15:41:55'),
(13, 'Liempo', '95', 'Available', NULL, 'Pork belly, Soy sauce, Vinegar, Garlic, minced, Salt, Black pepper, Brown sugar, Lemon', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-28 15:16:52'),
(14, 'Gambas', '100', 'Available', NULL, 'Large shrimp, Garlic, minced, Olive oil, Paprika, Red pepper flakes, Lemon juice, Salt, Parsley', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-28 15:16:52'),
(15, 'Beef Pares', '100', 'Available', NULL, 'Beef chuck, Soy sauce, Brown sugar, Star anise, Garlic, minced, Ginger, sliced, Water, Cornstarch, Salt, Black pepper, Oil', '100.00', 'meals', '2023-01-24 03:16:45', '2023-03-31 15:43:11'),
(16, 'Boneless Bangus', '100', 'Available', NULL, 'Boneless Bangus,\r\nVinegar,\r\nGarlic, minced,\r\nSalt,\r\nBlack pepper,\r\nOil', '100.00', 'meals', '2023-01-24 03:16:45', '2023-03-31 15:43:11'),
(17, 'T-Bone', '160', 'Available', NULL, 'T-bone steak, Salt, Black pepper, Olive oil, Butter, Garlic cloves, Fresh herbs', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-28 15:16:52'),
(18, 'Porter House', '170', 'Available', NULL, 'Porterhouse steak, Salt, Black pepper, Olive oil, Garlic cloves,', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-23 02:48:59'),
(19, 'Sizzling Tofu', '140', 'Available', NULL, 'Firm tofu, \r\nCornstarch,\r\nCooking oil,\r\nGarlic, \r\nOnion,\r\nBell peppers,\r\nSoy sauce,\r\nOyster sauce,\r\nSugar,\r\nWater,\r\nGreen onions,', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-31 15:41:55'),
(20, 'Sizzling Hotdog', '140', 'Available', NULL, 'Hotdogs,\r\nCooking oil,\r\nOnions,\r\nSoy sauce,\r\nKetchup,\r\nWorcestershire sauce,\r\nSugar,\r\nWater,\r\nCornstarch', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-31 15:41:55'),
(21, 'Sizzling Sisig', '160', 'Available', NULL, 'Hotdogs, Onions, Butter, Ketchup, Mayonnaise, Mustard, Worcestershire sauce, Soy sauce, Sugar, Lemon juice, Salt, Black pepper, Cheese, Chili flakes	', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-30 14:51:46'),
(22, 'Sizzling Gambas', '180', 'Available', NULL, 'Shrimp, Garlic,  Onion, Tomato sauce, Soy sauce, Worcestershire sauce, Sugar, Red chili peppers, Butter, Olive oil, Salt, Black pepper, Spring onions', '0.00', 'meals', '2023-01-24 03:16:45', '2023-03-23 02:49:00'),
(23, 'juice', '25', 'Available', NULL, '', '0.00', 'drinks', '2023-02-23 05:10:06', '2023-03-30 14:38:04'),
(24, 'water', '0', 'Available', NULL, '', '0.00', 'drinks', '2023-02-23 05:11:20', '2023-03-30 14:38:10');

update orders set status = '';

INSERT INTO inventory (item_name, description, quantity, unit_cost, total_value, reorder_level, supplier, location)
VALUES 
  ('Beef', 'Fresh ground beef for burgers', 50, 2.50, 125.00, 10, 'Meat Co.', 'Walk-in Freezer'),
  ('Chicken Breast', 'Boneless, skinless chicken breast', 75, 2.00, 150.00, 20, 'Poultry Farms Inc.', 'Walk-in Cooler'),
  ('Potatoes', 'Fresh potatoes for french fries', 100, 0.50, 50.00, 30, 'Farm Fresh Produce', 'Dry Storage'),
  ('Buns', 'Freshly baked hamburger buns', 150, 0.25, 37.50, 50, 'Bakery Co.', 'Dry Storage'),
  ('Cheese', 'Sliced American cheese', 50, 1.00, 50.00, 5, 'Dairy Farms Inc.', 'Walk-in Cooler');
