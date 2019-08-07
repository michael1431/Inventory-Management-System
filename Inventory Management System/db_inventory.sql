-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2019 at 08:19 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_no` int(11) NOT NULL,
  `ck_key` varchar(100) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `sub_total` double NOT NULL,
  `gst` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `ck_key`, `customer_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES
(40, 'fcc0', 'Michael', '2019-08-07', 2000, 360, 60, 2300, 2300, 0, 'Cash'),
(41, '8a23', 'Emon', '2019-08-07', 12000, 2160, 160, 14000, 14000, 0, 'Cash'),
(42, 'a4a3', 'Novel', '2019-08-07', 4000, 720, 0, 4720, 4720, 0, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `product_name`, `price`, `qty`) VALUES
(39, 40, 'One Man', 1000, 2),
(40, 41, 'Ms Excell', 4000, 3),
(41, 42, 'Micropack Keyboard', 4000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `bid` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`bid`, `brand_name`, `status`) VALUES
(1, 'Samsung', '1'),
(3, 'HP', '1'),
(5, 'Huawei', '1'),
(6, 'POLO', '1'),
(7, 'Microsoft', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `parent_cat`, `category_name`, `status`) VALUES
(1, 0, 'Electronics', '1'),
(2, 0, 'Software', '1'),
(12, 1, 'Laptop', '1'),
(13, 2, 'Ms Office', '1'),
(14, 0, 'Tshirt', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` double NOT NULL,
  `product_stock` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `p_status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pid`, `cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) VALUES
(5, 1, 3, 'Micropack Keyboard', 4000, 9, '2019-07-31', '1'),
(6, 1, 1, 'Samsung Galaxy S8', 80000, 90, '2019-07-31', '1'),
(7, 14, 6, 'One Man', 1000, 48, '2019-08-07', '1'),
(8, 13, 7, 'Ms Excell', 4000, 37, '2019-08-07', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `usertype` enum('Admin','Others') NOT NULL,
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES
(23, 'Michael Sutradhar', 'michaelsutradhar@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Admin', '2019-08-06 21:26:18', '2019-08-07 06:08:18', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `brand_name` (`brand_name`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
