-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 04:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lyza_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP DATABASE IF EXISTS lyza_system;
CREATE DATABASE IF NOT EXISTS lyza_system;
USE lyza_system;

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'TEST_ADMIN1', 'testadmin1@gmail.com', 'testadmin001');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`, `location`) VALUES
(1, 'Branch-Main', 'San Miguel'),
(2, 'Branch-2', 'San Isidro Norte');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Medicine'),
(2, 'Supplement'),
(3, 'Hygiene'),
(4, 'Contraceptive'),
(5, 'Baby Care'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

-- CREATE TABLE `products` (
--   `product_id` int(11) NOT NULL,
--   `product_name` varchar(100) DEFAULT NULL,
--   `price` decimal(10,2) DEFAULT NULL,
--   `stock` int(11) DEFAULT NULL,
--   `image_path` varchar(255) DEFAULT NULL,
--   `category` varchar(50) DEFAULT NULL,
--   `branch` varchar(50) DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

-- INSERT INTO `products` (`product_id`, `product_name`, `price`, `stock`, `image_path`, `category`, `branch`) VALUES
-- (1, 'TEST-PRODUCT1', 15.00, 50, 'Biogesic.png', 'Medicine', 'San Miguel'),
-- (2, 'TEST-PRODUCT2', 20.00, 35, 'Biogesic.png', 'Supplement', 'San Miguel'),
-- (3, 'TEST-PRODUCT3', 12.00, 50, 'Biogesic.png', 'Hygiene', 'San Miguel'),
-- (4, 'TEST-PRODUCT4', 25.00, 15, 'Biogesic.png', 'Contraceptive', 'San Isidro Norte'),
-- (5, 'TEST_PRODUCT5', 15.00, 50, 'Biogesic.png', 'Baby Care', 'San Isidro Norte'),
-- (6, 'TEST-PRODUCT6', 12.00, 35, 'Biogesic.png', 'Other', 'San Isidro Norte');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `staff_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `branch_id`, `staff_name`, `email`, `pass`) VALUES
(1, 1, 'TEST-STAFF-BRANCH1', 'teststaffbranch1@gmail.com', 'teststaffbranch001'),
(2, 2, 'TEST-STAFF-BRANCH2', 'teststaffbranch2@gmail.com', 'teststaffbranch002');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `cash_received` decimal(10,2) NOT NULL,
  `cash_change` decimal(10,2) NOT NULL,
  `transaction_date` datetime DEFAULT current_timestamp(),
  `staff_acc` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `product_name`, `branch_name`, `qty`, `total_amount`, `cash_received`, `cash_change`, `transaction_date`, `staff_acc`, `category`) VALUES
(1, 'TEST-PRODUCT1', 'San  Miguel', 3, 45.00, 50.00, 5.00, '2024-10-03 13:04:07', 'TEST-STAFF-BRANCH1', 'Medicine'),
(2, 'TEST-PRODUCT2', 'San  Miguel', 2, 40.00, 50.00, 10.00, '2024-10-03 13:06:19', 'TEST-STAFF-BRANCH1', 'Supplement'),
(3, 'TEST-PRODUCT3', 'San  Miguel', 1, 12.00, 20.00, 8.00, '2024-10-03 13:07:46', 'TEST-STAFF-BRANCH1', 'Hygiene'),
(4, 'TEST-PRODUCT4', 'San Isidro Norte', 1, 25.00, 25.00, 0.00, '2024-10-03 13:08:54', 'TEST-STAFF-BRANCH2', 'Contraceptive'),
(5, 'TEST_PRODUCT5', 'San Isidro Norte', 2, 30.00, 30.00, 0.00, '2024-10-03 13:09:53', 'TEST-STAFF-BRANCH2', 'Baby Care'),
(6, 'TEST-PRODUCT6', 'San Isidro Norte', 1, 12.00, 15.00, 3.00, '2024-10-03 13:11:01', 'TEST-STAFF-BRANCH2', 'Other');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
