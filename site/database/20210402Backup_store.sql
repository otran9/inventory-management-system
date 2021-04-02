-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 04:56 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `assetID` int(11) NOT NULL,
  `assetTagID` varchar(100) NOT NULL,
  `assetDescription` text NOT NULL,
  `assetGeoTags` varchar(100) DEFAULT NULL,
  `purchaseDate` date DEFAULT NULL,
  `purchaseFrom` varchar(100) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `serialNo` varchar(100) DEFAULT NULL,
  `asset_image` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `activeDate` date DEFAULT NULL,
  `contractID` int(11) DEFAULT NULL,
  `warrantyID` int(11) DEFAULT NULL,
  `departmentID` int(11) DEFAULT NULL,
  `siteID` int(11) DEFAULT NULL,
  `locationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`assetID`, `assetTagID`, `assetDescription`, `assetGeoTags`, `purchaseDate`, `purchaseFrom`, `cost`, `categories_id`, `brand`, `model`, `serialNo`, `asset_image`, `user_id`, `status`, `activeDate`, `contractID`, `warrantyID`, `departmentID`, `siteID`, `locationID`) VALUES
(1, 'USD0000001', 'Dell OptiPlex All-in-one PC', '1241123, 1313411', '2016-08-30', 'United Computers', 25, 3, '1', 'Dell Optiplex', 'SBY6TXC', NULL, 0, 'Available', NULL, NULL, NULL, 0, 0, 0),
(3, 'UDS0000002', 'ASUS Gaming Laptop', '1234, 1234', '2015-10-03', 'Microcenter', 750, 3, '2', 'ROG', '10P8FH2', NULL, 0, 'Active', NULL, NULL, NULL, 0, 0, 0),
(47, 'USD0000003', 'Desc 3', '222, 333', '2021-03-10', 'United Computers', 3000, 1, '1', '123', '123', NULL, 12, 'Active', NULL, NULL, NULL, 1, 0, 0),
(58, 'USD0004', 'D0004', '', '2021-03-01', 'Best Buy', 2000, 2, '7', '', 'F3FJ39', NULL, 0, 'Available', NULL, NULL, NULL, 2, 0, 0),
(59, 'USD2000', 'Product 2000', NULL, '2021-03-24', '', 2000, 1, '', '', '', NULL, 0, 'Available', '0000-00-00', NULL, NULL, 0, 0, 0),
(68, 'USD2000', 'Asset 2000', NULL, '2021-04-09', '', 2000, 1, '0', '', '', NULL, 0, 'Active', '0000-00-00', NULL, NULL, 3, 0, 0),
(71, 'USD300', 'No Brand/Category', NULL, '2021-03-13', '', 4500, 0, '0', '', '', NULL, 0, 'Available', '0000-00-00', NULL, NULL, 4, 0, 0),
(73, 'USD01288', 'Edit Test', NULL, '2021-01-11', '', 12000, 2, '3', '', '', NULL, 11, 'Checked Out', '0000-00-00', NULL, NULL, 1, 0, 0),
(75, 'USD000123', 'Product 123', NULL, '2021-03-02', 'TIC', 2000, 3, '3', '', 'POG302F', NULL, 0, 'Available', '0000-00-00', NULL, NULL, 3, 0, 0),
(79, 'USD203822', 'Edit Desc', NULL, '2021-03-16', '', 0, 2, '0', '', '', NULL, 0, 'Active', '0000-00-00', NULL, NULL, 0, 0, 0),
(91, 'USD33082', 'D1234', NULL, '2021-03-15', '', 0, 2, '3', '', '', NULL, 0, 'Available', '0000-00-00', NULL, NULL, 2, 0, 0),
(92, 'USD000111', 'D3202', NULL, '0000-00-00', '', 0, 0, '0', '', '', NULL, 0, 'Available', '0000-00-00', NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT 0,
  `brand_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(0, '', 0, 0),
(1, 'Dell', 1, 1),
(2, 'Asus', 1, 1),
(3, 'Apple', 1, 1),
(4, 'Lenovo', 1, 1),
(6, 'Toshiba', 1, 1),
(7, 'Samsung', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(0, '', 0, 0),
(1, 'Electronics', 1, 1),
(2, 'Accessories', 1, 1),
(3, 'Computers', 1, 1),
(4, 'Peripherals', 1, 1),
(5, 'Equipment', 1, 1),
(22, 'Test 0', 1, 0),
(23, 'Test 1', 1, 0),
(24, 'Test 2', 1, 0),
(25, 'Test 3', 1, 0),
(26, 'Test 4', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `contractID` int(11) NOT NULL,
  `contractTitle` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `contractNo` varchar(100) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `contractPerson` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `noOfLicenses` int(11) DEFAULT NULL,
  `isSoftware` varchar(100) DEFAULT NULL,
  `assetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`contractID`, `contractTitle`, `description`, `startDate`, `endDate`, `contractNo`, `cost`, `vendor`, `contractPerson`, `phone`, `noOfLicenses`, `isSoftware`, `assetID`) VALUES
(1, 'Contract 1', 'Desc. 1', '2021-03-01', '2021-03-18', '123', 2222, 'Microcenter', 'Olivier', '1232132', 23222, 'Yes', 1),
(3, 'Contract 3', '', '2021-03-03', '2021-03-10', '', 0, '', '', '', 0, '', 3),
(4, 'Contract 4', 'D4', '2021-03-02', '2021-03-18', '', 4444, '', '', '', 0, '', 47),
(6, 'Contract 5', 'D5', '2021-03-03', '2021-05-14', '', 5000, '', '', '', 0, '', 3),
(7, 'Contract 2', 'Desc. 2', '2021-03-01', '2021-03-26', '', 0, '', '', '', 0, '', 58);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` int(11) NOT NULL,
  `departmentName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `departmentName`) VALUES
(0, ''),
(1, 'Accounting'),
(2, 'Marketing'),
(3, 'Executive'),
(4, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empNumber` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `empID` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationID` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationID`, `siteID`, `location`) VALUES
(0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintNumber` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `dueDate` date DEFAULT NULL,
  `maintBy` varchar(100) DEFAULT NULL,
  `maintStatus` varchar(100) DEFAULT NULL,
  `dateCompleted` date DEFAULT NULL,
  `repairsCost` float DEFAULT NULL,
  `repeating` varchar(100) DEFAULT NULL,
  `assetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`maintNumber`, `title`, `details`, `dueDate`, `maintBy`, `maintStatus`, `dateCompleted`, `repairsCost`, `repeating`, `assetID`) VALUES
(1, 'Maintenance 1', 'Details 1', '2021-03-10', 'United Computers', 'In Progress', '2021-03-01', 200, 'Yes', 3),
(2, 'Maintenance 3', 'Details 3', '2021-03-17', 'TIC', 'Cancelled', '2021-03-15', 4000, 'Yes', 3),
(10, 'Maint 4', 'D 4', '2021-03-01', 'United Computers', 'Cancelled', '2021-04-09', 1234, 'No', 3),
(11, 'Maintenance 2', 'Details 2', '2021-02-02', '', 'On Hold', '0000-00-00', 0, 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_place` int(11) NOT NULL,
  `gstn` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `payment_place`, `gstn`, `order_status`, `user_id`) VALUES
(1, '2021-03-06', 'Olivier Tran', '10931092341', '323.00', '58.14', '381.14', '12', '369.14', '12', '357.14', 2, 1, 1, '58.14', 1, 11),
(2, '2021-03-05', 'D. Michael Franklin', '1', '323.00', '58.14', '381.14', '0', '381.14', '381.14', '0.00', 2, 1, 2, '58.14', 1, 11),
(3, '2021-03-11', 'Order 3', '333', '33.00', '5.94', '38.94', '0', '38.94', '38.94', '0', 1, 2, 2, '5.94', 1, 11),
(4, '2021-03-09', 'Order 4', '222', '33.00', '5.94', '38.94', '0', '38.94', '44', '-5.06', 2, 1, 1, '5.94', 1, 11),
(5, '2021-03-02', 'edf', '3ed3d', '1.00', '0.18', '1.18', '1', '0.18', '1', '-0.82', 1, 1, 1, '0.18', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(1, 0, 1, '1', '323', '323.00', 1),
(3, 2, 1, '1', '323', '323.00', 1),
(4, 0, 2, '1', '33', '33.00', 1),
(5, 3, 2, '1', '33', '33.00', 1),
(6, 1, 1, '1', '323', '323.00', 1),
(7, 4, 2, '1', '33', '33.00', 1),
(8, 5, 4, '1', '1', '1.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `rate`, `active`, `status`) VALUES
(1, 'Optiplex', '../assests/images/stock/32918419460425ba435970.jpg', 1, 1, '4441', '323', 1, 1),
(2, 'asdf', '../assests/images/stock/29313417660450c1763733.jpg', 1, 1, '30', '33', 1, 1),
(3, '121rrr3', '../assests/images/stock/10057473160450fc807488.jpg', 1, 1, '3432', '333', 2, 2),
(4, '1', '../assests/images/stock/6485476536045203ba6606.jpg', 1, 1, '0', '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `siteID` int(11) NOT NULL,
  `siteName` varchar(100) NOT NULL,
  `siteDescription` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`siteID`, `siteName`, `siteDescription`, `address`, `city`, `country`) VALUES
(0, '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 'admin'),
(11, 'otran', '5f4dcc3b5aa765d61d8327deb882cf99', 'otranedu@gmail.com', 'it'),
(12, 'user2', '5f4dcc3b5aa765d61d8327deb882cf99', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `warranty`
--

CREATE TABLE `warranty` (
  `warrantyID` int(11) NOT NULL,
  `length` int(11) DEFAULT NULL,
  `expirDate` date NOT NULL,
  `notes` text DEFAULT NULL,
  `assetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warranty`
--

INSERT INTO `warranty` (`warrantyID`, `length`, `expirDate`, `notes`, `assetID`) VALUES
(1, 2, '2021-05-15', 'Notes 1', 47);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`assetID`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`contractID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empNumber`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintNumber`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`siteID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `warranty`
--
ALTER TABLE `warranty`
  ADD PRIMARY KEY (`warrantyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `assetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `contractID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empNumber` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `maintNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `siteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `warranty`
--
ALTER TABLE `warranty`
  MODIFY `warrantyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
