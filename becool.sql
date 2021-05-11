-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 10:24 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `becool`
--

-- --------------------------------------------------------

--
-- Table structure for table `accinfo`
--

CREATE TABLE `accinfo` (
  `acc_id` int(11) NOT NULL,
  `acc_cn` varchar(100) NOT NULL,
  `acc_age` int(11) NOT NULL,
  `acc_gender` varchar(11) NOT NULL,
  `acc_contact` varchar(50) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `brgy` varchar(100) NOT NULL,
  `add_details` varchar(100) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accinfo`
--

INSERT INTO `accinfo` (`acc_id`, `acc_cn`, `acc_age`, `acc_gender`, `acc_contact`, `province`, `city`, `brgy`, `add_details`, `account_id`) VALUES
(1, 'Mary Joy Elquiero', 21, 'Female', '09260367071', 'Albay', 'Ligao', 'Bacong', 'Purok 1', 1),
(2, 'Mary Joy Elquiero', 21, 'Female', '926036707', 'Albay', 'Ligao', 'Bacong', 'Bacong', 5),
(4, 'Jasmin Elquiero', 19, 'Female', '09123456789', 'Albay', 'Polangui', 'Ubaliw', 'Purok 2', 8),
(5, 'Mekylla Pormatelo', 15, 'Female', '09260367875', 'Albay', 'Polangui', 'Centro Oriental', 'Purok 4', 10);

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acc_id`, `email`, `password`) VALUES
(1, 1, 'mryjylqr@gmail.com', 'mryjy'),
(5, 2, 'joyelquiero2525@gmail.com', 'joy123'),
(8, 4, 'jasmin@gmail.com', '123'),
(10, 5, '123@gmail.com', '456');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_email`, `admin_pass`) VALUES
(1, 'Admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `price_id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `total_amt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `item_id`, `acc_id`, `price_id`, `item_qty`, `total_amt`) VALUES
(2, 2, 2, 2, 4, 400),
(14, 2, 2, 1, 1, 100),
(57, 5, 1, 4, 1, 10),
(58, 3, 1, 3, 5, 1500),
(59, 4, 5, 4, 1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_desc` varchar(100) NOT NULL,
  `cat_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_desc`, `cat_status`) VALUES
(1, 'Souvenir', 'A'),
(2, 'Food', 'A'),
(3, 'Bag', 'A'),
(4, 'Shoes', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_img` varchar(100) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_short_code` varchar(100) NOT NULL,
  `price_id` double NOT NULL,
  `cat_id` int(11) NOT NULL,
  `item_stat` varchar(12) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_img`, `item_name`, `item_short_code`, `price_id`, `cat_id`, `item_stat`, `shop_id`) VALUES
(3, 'bicolexpress.jpg', 'Bicol Express', 'BCLXPRS001', 3, 2, 'Active', 2),
(4, 'dahlia.png', 'Dahlia', 'DL001', 4, 3, 'Active', 1),
(5, 'mayon.jpg', 'Mayon Key Chain', 'MKC001', 5, 1, 'Active', 2),
(6, 'potato.png', 'Potatop Chips', 'P001', 6, 2, 'Active', 1),
(8, 'pili.png', 'Pili Nuts', 'PL001', 8, 2, 'Denied', 3),
(10, 'straw.png', 'Straw Bag', 'SB001', 10, 3, 'Active', 1),
(45, 'abacaslipper-removebg-preview.png', 'Abaca Slipper', 'ABC111', 28, 4, 'Active', 1),
(46, 'cuttie.png', 'Sling Bag', 'SLB001', 29, 3, 'Pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_total` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `billing_info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `acc_id`, `item_id`, `item_price`, `order_qty`, `order_total`, `order_date`, `order_status`, `billing_info`) VALUES
(1, 1, 3, 150, 8, 1200, '2021-04-13', 'Cancelled', 'Albay, Ligao, Bacong, Purok 2'),
(2, 1, 3, 150, 8, 1200, '2021-04-13', 'Cancelled', 'Albay, Ligao, Bacong, Purok 2'),
(3, 1, 3, 150, 8, 1200, '2021-04-13', 'Cancelled', 'Albay, Ligao, Bacong, Purok 2'),
(4, 1, 4, 300, 7, 2100, '2021-04-13', 'Completed', 'Albay, Ligao ,Bacong ,Purok2'),
(5, 1, 3, 150, 8, 1200, '2021-04-13', 'To Ship', 'Albay, Ligao ,Bacong ,Purok2'),
(6, 1, 2, 100, 7, 700, '2021-04-13', 'To Recieve', 'Albay, Ligao ,Bacong ,Purok2'),
(7, 1, 3, 150, 5, 750, '2021-04-14', 'To Pay', 'Albay, Ligao ,Bacong ,Purok2'),
(8, 1, 3, 150, 20, 3000, '2021-04-15', 'To Ship', 'Albay, Ligao ,Bacong ,Purok2'),
(9, 1, 2, 100, 10, 1000, '2021-04-16', 'To Pay', 'Albay, Ligao ,Bacong ,Purok 2'),
(10, 4, 2, 100, 5, 500, '2021-05-06', 'Completed', 'Albay, Polangui ,Ubaliw ,Purok 2'),
(11, 1, 4, 150, 17, 3300, '2021-05-06', 'Cancelled', 'Albay, Ligao ,Bacong ,Purok 2'),
(12, 1, 2, 100, 10, 1000, '2021-05-06', 'To Ship', 'Albay, Ligao ,Bacong ,Purok 2'),
(13, 1, 4, 150, 5, 750, '2021-05-09', 'To Pay', 'Albay, Ligao ,Bacong ,Purok 1');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price_id` int(11) NOT NULL,
  `price_amt` int(11) NOT NULL,
  `price_start_eff` date NOT NULL,
  `price_end_eff` date NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `price_amt`, `price_start_eff`, `price_end_eff`, `item_id`) VALUES
(2, 100, '2021-04-10', '2021-05-10', 2),
(3, 300, '2021-04-10', '2021-05-10', 3),
(4, 150, '2021-04-10', '2021-05-10', 4),
(5, 10, '2021-04-10', '2021-05-10', 5),
(6, 30, '0000-00-00', '0000-00-00', 6),
(7, 500, '0000-00-00', '0000-00-00', 7),
(8, 120, '0000-00-00', '0000-00-00', 8),
(9, 1, '0000-00-00', '0000-00-00', 9),
(10, 200, '0000-00-00', '0000-00-00', 10),
(23, 100, '0000-00-00', '0000-00-00', 23),
(24, 1000000, '0000-00-00', '0000-00-00', 41),
(25, 111111, '0000-00-00', '0000-00-00', 42),
(26, 1245789562, '0000-00-00', '0000-00-00', 43),
(27, 30, '0000-00-00', '0000-00-00', 44),
(28, 100, '0000-00-00', '0000-00-00', 45),
(29, 250, '0000-00-00', '0000-00-00', 46);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `acc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_name`, `acc_id`) VALUES
(1, 'PiliHub', 1),
(2, 'Shop2', 2),
(3, 'Shop3', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accinfo`
--
ALTER TABLE `accinfo`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accinfo`
--
ALTER TABLE `accinfo`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
