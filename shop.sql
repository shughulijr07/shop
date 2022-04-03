-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2020 at 10:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `ava_qty` int(11) NOT NULL,
  `total` double NOT NULL,
  `shop` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `issued_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `point` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `date_invoiced` varchar(100) NOT NULL,
  `buying_price` double NOT NULL,
  `selling_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `product`, `type`, `qty`, `point`, `description`, `date_invoiced`, `buying_price`, `selling_price`) VALUES
(1, 'ALU', 'Tablets', 100, 'MAJENGO', 'children 100mg', '2019-08-27', 2000, 2500),
(9, 'pen', 'Packets', 12, 'MAJENGO', 'blue', '2020-06-30', 200, 300),
(10, 'vaseline', 'Pieces', 10, 'MAJENGO', 'mafuta ya kujipaka', '2020-07-01', 100, 200),
(11, 'exercise book', 'Packets', 10, 'MAJENGO', 'daftari ya mazoezi', '2020-07-01', 500, 600),
(12, 'lipstick', 'Pieces', 5, 'KISASA', 'red and pink lipstick', '2020-07-01', 100, 200),
(13, 'water', 'Litre', 7, 'KISASA', 'maji ya kunywa', '2020-07-01', 400, 500);

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `issue_id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date_issued` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `shop` varchar(200) NOT NULL,
  `totalSelling` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `issue_no` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ordering`
--

CREATE TABLE `ordering` (
  `order_id` int(11) NOT NULL,
  `product` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `shop` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_store`
--

CREATE TABLE `product_store` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_type` varchar(200) NOT NULL,
  `expiredate` varchar(20) NOT NULL,
  `buying_price` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `shop` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_bought` varchar(100) NOT NULL,
  `date_inserted` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_selling` double NOT NULL DEFAULT 0,
  `total_buying` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_store`
--

INSERT INTO `product_store` (`product_id`, `product_name`, `product_type`, `expiredate`, `buying_price`, `description`, `selling_price`, `shop`, `quantity`, `date_bought`, `date_inserted`, `total_selling`, `total_buying`) VALUES
(11, 'vaseline', 'Pieces', '2020-07-17', 100, 'mafuta ya kujipaka', 200, 'MAJENGO', 10, '2020-07-01', '2020-07-01 18:53:10', 2000, 1000),
(12, 'exercise book', 'Packets', '2020-07-02', 500, 'daftari ya mazoezi', 600, 'MAJENGO', 10, '2020-07-01', '2020-07-01 18:56:25', 6000, 5000),
(13, 'lipstick', 'Pieces', '2020-07-02', 100, 'red and pink lipstick', 200, 'KISASA', 2, '2020-07-01', '2020-07-01 19:02:11', 1000, 500),
(14, 'water', 'Litre', '2020-07-04', 400, 'maji ya kunywa', 500, 'KISASA', 7, '2020-07-01', '2020-07-01 18:58:51', 3500, 2800),
(15, 'lipstick', 'Pieces', '2020-07-02', 100, 'red and pink lipstick', 200, 'MAJENGO', 3, '2020-07-01', '2020-07-01 19:02:11', 600, 300);

-- --------------------------------------------------------

--
-- Table structure for table `shop_point`
--

CREATE TABLE `shop_point` (
  `shop_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_point`
--

INSERT INTO `shop_point` (`shop_id`, `name`, `phone`, `address`, `date_inserted`) VALUES
(1, 'MAJENGO', '255753364579', 'DODOMA', '2019-08-26 11:49:43'),
(2, 'KISASA', '215455888000', 'DODOMA', '2019-08-26 11:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `shop_point` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `shop_point`) VALUES
(1, 'admin', '4321', 'admin', '0'),
(2, 'Rahim', '1234', 'shopkeeper', 'Majengo'),
(4, 'kenny', '1234', 'shopkeeper', 'MAJENGO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product_store`
--
ALTER TABLE `product_store`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `shop_point`
--
ALTER TABLE `shop_point`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ordering`
--
ALTER TABLE `ordering`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_store`
--
ALTER TABLE `product_store`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shop_point`
--
ALTER TABLE `shop_point`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
