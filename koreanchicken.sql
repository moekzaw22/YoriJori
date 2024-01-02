-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 01:47 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koreanchicken`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `Detail_ID` int(11) NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Item_Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `total_price_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`Detail_ID`, `Order_ID`, `Product_ID`, `Item_Price`, `Quantity`, `total_price_p`) VALUES
(4, 15, 1, 3500, 1, 17500),
(5, 15, 2, 7000, 2, 14000),
(6, 15, 3, 0, 1, 0),
(7, 16, 1, 3500, 1, 52500),
(8, 16, 2, 7000, 4, 28000),
(12, 16, 3, 12, 8, 96);

-- --------------------------------------------------------

--
-- Table structure for table `order_r`
--

CREATE TABLE `order_r` (
  `Order_ID` int(11) NOT NULL,
  `Table_R` int(11) NOT NULL,
  `Order_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_r`
--

INSERT INTO `order_r` (`Order_ID`, `Table_R`, `Order_Date`) VALUES
(1, 1, '2022-12-23'),
(2, 2, '2022-12-23'),
(3, 3, '2022-12-23'),
(4, 4, '2022-12-23'),
(5, 5, '2022-12-23'),
(6, 6, '2022-12-23'),
(7, 7, '2022-12-23'),
(8, 8, '2022-12-23'),
(9, 9, '2022-12-23'),
(10, 10, '2022-12-23'),
(11, 11, '2022-12-23'),
(12, 12, '2022-12-23'),
(13, 13, '2022-12-23'),
(14, 14, '2022-12-23'),
(15, 1, '2022-12-26'),
(16, 2, '2022-12-26');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` int(11) NOT NULL,
  `Product_Name` varchar(100) NOT NULL,
  `Product_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `Product_Price`) VALUES
(1, 'Wing Thura 4p', 3500),
(2, 'Wing Thura 8p', 7000),
(3, 'Wing Thura 12p', 10000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`Detail_ID`);

--
-- Indexes for table `order_r`
--
ALTER TABLE `order_r`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `Detail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_r`
--
ALTER TABLE `order_r`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
