-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 02:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cake_ordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `username`, `password`) VALUES
(13, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `cake`
--

CREATE TABLE `cake` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `feature` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cake`
--

INSERT INTO `cake` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `feature`, `active`) VALUES
(16, 'Choclate Pound Cake', 'This is the choclate pound cake', '299.00', 'Cake_Name_581.jpg', 9, 'Yes', 'Yes'),
(17, 'Strawberry Cake', 'This the strawberry cake', '399.00', 'Cake_Name_440.jpg', 14, 'Yes', 'Yes'),
(18, 'Mixed Falvored Cup Cakes', 'This are mixed falvored cup cakes', '499.00', 'Cake_Name_239.jpg', 10, 'Yes', 'Yes'),
(21, 'Choclate pound cake', 'This is the choclate pound cake', '399.00', 'Cake_Name_822.jpg', 9, 'Yes', 'Yes'),
(22, 'Coconut Foram Cake', 'This is coconut foram cake', '299.00', 'Cake_Name_953.jpg', 11, 'Yes', 'Yes'),
(23, 'Pineapple Cake', 'This is the pineapple cake', '299.00', 'Cake_Name_793.png', 14, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `categoris`
--

CREATE TABLE `categoris` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `feature` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoris`
--

INSERT INTO `categoris` (`id`, `title`, `image_name`, `feature`, `active`) VALUES
(9, 'Pound Cake', 'Cake_Category_813.jpg', 'Yes', 'Yes'),
(10, 'Cup Cakes', 'Cake_Category_783.jpg', 'Yes', 'Yes'),
(11, 'Foam Cakes', 'Cake_Category_747.jpg', 'Yes', 'Yes'),
(12, 'Birthday Cake', 'Cake_Category_914.jpg', 'Yes', 'Yes'),
(13, 'Mixed Flavor Cakes', 'Cake_Category_73.jpg', 'Yes', 'Yes'),
(14, 'Fruit Cake', 'Cake_Category_834.jpg', 'Yes', 'Yes'),
(15, 'Anniversary Cakes', 'Cake_Category_9.jpg', 'Yes', 'Yes'),
(16, 'Wedding Cake', 'Cake_Category_21.jpg', 'Yes', 'Yes'),
(17, 'Choclate Cakes', 'Cake_Category_160.jpeg', 'Yes', 'Yes'),
(18, 'Bread Cake', 'Cake_Category_776.jpg', 'Yes', 'No'),
(19, 'sfdksfkdnfkdsn', '', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `vaccineated` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `vaccineated`) VALUES
(6, 'Strawberry Cake', '399.00', 2, '798.00', '2022-02-23 04:56:16', 'On Delivery', 'riya ', 'gdg@fdj.com', '1234567890', 'xyz good to go', 'Yes'),
(7, 'Choclate Pound Cake', '299.00', 1, '299.00', '2022-02-23 05:16:05', 'Ordered', 'Janvi More', '8765439021', 'Real6@mail.com', 'Jalgaon', 'Yes'),
(8, 'Mixed Falvored Cup Cakes', '499.00', 2, '998.00', '2022-02-24 02:27:30', 'Delivered', 'ray', '4563789832', 'ray@gmail.com', 'jalgaon', 'Yes'),
(9, 'Coconut Foram Cake', '299.00', 1, '299.00', '2022-02-24 05:44:36', 'Cancelled', 'Kiya Roy', '987590322', 'lkiya@roy.com', 'mumbai', 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cake`
--
ALTER TABLE `cake`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoris`
--
ALTER TABLE `categoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cake`
--
ALTER TABLE `cake`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `categoris`
--
ALTER TABLE `categoris`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
