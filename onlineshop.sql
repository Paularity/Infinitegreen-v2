-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2022 at 05:52 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshop`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getcat` (IN `cid` INT)  SELECT * FROM categories WHERE cat_id=cid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(300) NOT NULL,
  `admin_password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'PlantPh'),
(2, 'Plantitas'),
(3, 'Plantitos'),
(8, 'Generic');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`) VALUES
(150, 83, '::1', 27, 1),
(151, 84, '::1', 27, 1),
(152, 85, '::1', 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Indoor'),
(2, 'Outdoor'),
(8, 'Collectors');

-- --------------------------------------------------------

--
-- Table structure for table `chatlog`
--

CREATE TABLE `chatlog` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatlog`
--

INSERT INTO `chatlog` (`id`, `sender_id`, `receiver_id`, `message`, `date_created`) VALUES
(58, 1, 7, 'seller one are you there? this is admin', '2022-01-30 15:04:39'),
(59, 7, 1, 'yes I am here, seller01 here', '2022-01-30 15:05:04'),
(60, 47, 1, 'asdasd', '2022-01-30 21:56:53'),
(61, 47, 1, 'Can you anwser me?', '2022-01-30 21:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `email_info`
--

CREATE TABLE `email_info` (
  `email_id` int(100) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_info`
--

INSERT INTO `email_info` (`email_id`, `email`) VALUES
(3, 'admin@gmail.com'),
(4, 'puneethreddy951@gmail.com'),
(5, 'puneethreddy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `p_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `qty`, `trx_id`, `p_status`) VALUES
(1, 12, 7, 1, '07M47684BS5725041', 'Completed'),
(2, 14, 2, 1, '07M47684BS5725041', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `orders_info_card`
--

CREATE TABLE `orders_info_card` (
  `order_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(10) NOT NULL,
  `cardname` varchar(255) NOT NULL,
  `cardnumber` varchar(20) NOT NULL,
  `expdate` varchar(255) NOT NULL,
  `prod_count` int(15) DEFAULT NULL,
  `total_amt` int(15) DEFAULT NULL,
  `cvv` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_info_card`
--

INSERT INTO `orders_info_card` (`order_id`, `user_id`, `f_name`, `email`, `address`, `city`, `state`, `zip`, `cardname`, `cardnumber`, `expdate`, `prod_count`, `total_amt`, `cvv`) VALUES
(1, 46, 'Florence Pamintuan', 'user02@gmail.com', 'Pampang', 'Angeles Cit', 'Pampanga', 2009, 'Andres ', '1111111111111111', '11/22', 2, 1487, 512),
(2, 46, 'Florence Pamintuan', 'user02@gmail.com', 'Pampang', 'Angeles Cit', 'Pampanga', 2008, 'Bonifacio Medina', '0000000000000000', '12/28', 2, 1220, 808),
(3, 47, 'Jane Doe', 'buyer01@gmail.com', 'Santa Teresita', 'Angeles Cit', 'Pampanga', 2009, 'Andres ', '1111111111111111', '11/22', 1, 1110, 512),
(4, 47, 'Jane Doe', 'buyer01@gmail.com', 'Santa Teresita', 'Angeles Cit', 'Pampanga', 2009, 'Andres ', '1111111111111111', '12/12', 1, 110, 1),
(5, 47, 'Jane Doe', 'buyer01@gmail.com', 'Santa Teresita', 'Angeles Cit', 'Pampanga', 2009, 'Andres ', '2212351541243124', '12/12', 2, 1220, 212);

-- --------------------------------------------------------

--
-- Table structure for table `order_info_cod`
--

CREATE TABLE `order_info_cod` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(512) NOT NULL,
  `total_amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_info_cod`
--

INSERT INTO `order_info_cod` (`order_id`, `user_id`, `address`, `total_amt`) VALUES
(1, 47, '0', 1110),
(2, 47, 'Santa Teresita, Angeles Cit', 1110),
(3, 47, 'Santa Teresita, Angeles Cit', 110);

-- --------------------------------------------------------

--
-- Table structure for table `order_info_gcash`
--

CREATE TABLE `order_info_gcash` (
  `order_id` varchar(512) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `account_name` varchar(64) NOT NULL,
  `account_number` int(64) NOT NULL,
  `total_amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_info_gcash`
--

INSERT INTO `order_info_gcash` (`order_id`, `user_id`, `address`, `account_name`, `account_number`, `total_amt`) VALUES
('pay_TwJdU6usis4p7t81yMajqbmS', 47, 'Santa Teresita, Angeles Cit', 'Jane Doe', 2147483647, 111000),
('', 47, 'Santa Teresita, Angeles Cit', 'Jane Doe', 0, 0),
('pay_9G2qhfc6ifTDKiUzk2g2jhud', 47, 'Santa Teresita, Angeles Cit', 'Jane Doe', 2147483647, 1110),
('pay_5kYRxG9aNHopeTpinNDhFh4m', 47, 'Santa Teresita, Angeles Cit', 'Jane Doe', 2147483647, 110),
('pay_NgggA8ge4vEVA6CEoSeMQnw8', 47, 'Santa Teresita, Angeles Cit', 'Jane Doe', 997899971, 1220);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_pro_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(15) DEFAULT NULL,
  `amt` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_pro_id`, `order_id`, `product_id`, `qty`, `amt`) VALUES
(100, 3, 105, 1, 1110),
(101, 4, 104, 1, 110),
(102, 5, 105, 1, 1110),
(103, 5, 104, 1, 110);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `seller_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(104, 1, 1, 8, 'Malunggay[ EXCLUSIVE OFFER ] 2', 110, '1', '104.jpg', ''),
(105, 7, 2, 8, 'Seller01: Kalamunding', 1110, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nec feugiat nisl pretium fusce id velit. Ipsum a arcu cursus vitae. Laoreet suspendisse interdum consectetur libero id faucibus nisl. Placerat orci nulla pellentesque dignissim.', '105.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Infinite Green : Store', 'info@infinitewater.com', '+6948 8542 623', '1643427300_banner1.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Admin,2=Seller,3=Buyer',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `contact`, `address`, `type`, `date_created`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'admin@admin.com', '+123456789', '', 1, '2020-10-27 09:19:59'),
(5, 'John Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'jsmith@sample.com', '+18456-5455-55', 'Sample', 2, '2020-10-27 14:18:32'),
(7, 'Seller One', 'seller01', '95abc042bcdf3a5054627d31153bbd1c', '', '', '', 2, '2022-01-26 22:24:21'),
(10, 'Boni', 'seller02', '917c1b615ff7da73cb2fffa987bc9554', '', '', '', 2, '2022-01-27 00:20:50'),
(14, 'Christian Paul', 'seller03', '153ded82fa3db5c91237d579309367f7', '', '', '', 2, '2022-01-29 13:14:00'),
(15, 'John Doe', 'admin02', '6e60a28384bc05fa5b33cc579d040c56', '', '', '', 1, '2022-01-29 13:14:27'),
(16, 'Christian Paul', 'seller06', 'e0dd4964448f045b7b2f487d8361ad89', 'christiandecembrana1@gmail.com', '09560585678', 'Santa teresita', 3, '2022-01-30 02:56:56'),
(17, 'Florence Pamintuan', 'seller002', '917c1b615ff7da73cb2fffa987bc9554', 'seller1002@gmail.com', '09560585678', 'Pampang', 3, '2022-01-30 15:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(44, 'Christian', 'Decembrana', 'christiandecembrana1@gmail.com', 'b75705d7e35e7014521a46b532236ec3', '9999992', 'Angeles City', 'Pampanga'),
(46, 'Florence', 'Pamintuan', 'user02@gmail.com', 'testtest@SM123', '9999999999', 'Pampang', 'Angeles Cit'),
(47, 'Jane', 'Doe', 'buyer01@gmail.com', '$KsCPDp62k', '9560585678', 'Santa Teresita', 'Angeles Cit');

--
-- Triggers `user_info`
--
DELIMITER $$
CREATE TRIGGER `after_user_info_insert` AFTER INSERT ON `user_info` FOR EACH ROW BEGIN 
INSERT INTO user_info_backup VALUES(new.user_id,new.first_name,new.last_name,new.email,new.password,new.mobile,new.address1,new.address2);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_info_backup`
--

CREATE TABLE `user_info_backup` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info_backup`
--

INSERT INTO `user_info_backup` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(1, 'Admin', '01', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', '', 'AAAAA', 'AAAA'),
(12, 'puneeth', 'Reddy', 'puneethreddy951@gmail.com', '123456789', '9448121558', '123456789', 'sdcjns,djc'),
(14, 'hemanthu', 'reddy', 'hemanthreddy951@gmail.com', '123456788', '6526436723', 's,dc wfjvnvn', 'b efhfhvvbr'),
(15, 'hemu', 'ajhgdg', 'keeru@gmail.com', '346778', '536487276', ',mdnbca', 'asdmhmhvbv'),
(16, 'venky', 'vs', 'venkey@gmail.com', '1234534', '9877654334', 'snhdgvajfehyfygv', 'asdjbhfkeur'),
(19, 'abhishek', 'bs', 'abhishekbs@gmail.com', 'asdcsdcc', '9871236534', 'bangalore', 'hassan'),
(20, 'pramod', 'vh', 'pramod@gmail.com', '124335353', '9767645653', 'ksbdfcdf', 'sjrgrevgsib'),
(21, 'prajval', 'mcta', 'prajvalmcta@gmail.com', '1234545662', '202-555-01', 'bangalore', 'kumbalagodu'),
(22, 'puneeth', 'v', 'hemu@gmail.com', '1234534', '9877654334', 'snhdgvajfehyfygv', 'asdjbhfkeur'),
(23, 'hemanth', 'reddy', 'hemanth@gmail.com', 'Puneeth@123', '9876543234', 'Bangalore', 'Kumbalagodu'),
(24, 'newuser', 'user', 'newuser@gmail.com', 'puneeth@123', '9535688928', 'Bangalore', 'Kumbalagodu'),
(25, 'otheruser', 'user', 'otheruser@gmail.com', 'puneeth@123', '9535688928', 'Bangalore', 'Kumbalagodu'),
(26, 'flo', 'pam', 'christiandecembrana1@gmail.com', 'abcd12345', '9685788454', 'angele', 's'),
(27, 'Christian', 'Decembrana', 'christiandecembrana1@gmail.com', 'testtest@SM123', '9560585678', 'asd 123', 'AC'),
(28, 'Bonifacio', 'Andre', 'boni@gmail.com', '123456789', '9685788454', 'Pampanga', 'Angeles Cit'),
(29, '', '', 'admin@admin.com', '', '', '', ''),
(30, '', '', 'admin@admin.com', '', '', '', ''),
(31, '', '', 'admin@admin.com', '', '', '', ''),
(32, '', '', 'admin@admin.com', '', '', '', ''),
(33, '', '', 'admin@admin.com', '', '', '', ''),
(34, '', '', 'admin@admin.com', '', '', '', ''),
(35, '', '', 'admin@admin.com', '', '', '', ''),
(36, '', '', 'admin@admin.com', '', '', '', ''),
(37, '', '', 'admin@admin.com', '', '', '', ''),
(38, '', '', 'asd', '202cb962ac59075b964b07152d234b70', '', '', ''),
(39, '', '', '123', '202cb962ac59075b964b07152d234b70', '', '', ''),
(40, '', '', '123', '202cb962ac59075b964b07152d234b70', '', '', ''),
(41, '', '', 'a', '0cc175b9c0f1b6a831c399e269772661', '', '', ''),
(42, '', '', '1', 'c4ca4238a0b923820dcc509a6f75849b', '', '', ''),
(43, '', '', 'christiandecembrana1@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', ''),
(44, 'Christian', 'Decembrana', 'christiandecembrana1@gmail.com', '123123123', '', 'Angeles City', 'Pampanga'),
(45, 'asdasd', 'asdasd', 'christiandecembrana21@gmail.com', '4297f44b13955235245b2497399d7a93', '123123123', '123123123', '123123'),
(46, 'Florence', 'Pamintuan', 'user02@gmail.com', 'testtest@SM123', '9999999999', 'Pampang', 'Angeles Cit'),
(47, 'Jane', 'Doe', 'buyer01@gmail.com', '$KsCPDp62k', '9560585678', 'Santa Teresita', 'Angeles Cit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `chatlog`
--
ALTER TABLE `chatlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_info`
--
ALTER TABLE `email_info`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_info_card`
--
ALTER TABLE `orders_info_card`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_info_cod`
--
ALTER TABLE `order_info_cod`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_pro_id`),
  ADD KEY `order_products` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_info_backup`
--
ALTER TABLE `user_info_backup`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chatlog`
--
ALTER TABLE `chatlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `email_info`
--
ALTER TABLE `email_info`
  MODIFY `email_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_info_card`
--
ALTER TABLE `orders_info_card`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_info_cod`
--
ALTER TABLE `order_info_cod`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_info_backup`
--
ALTER TABLE `user_info_backup`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_info_card`
--
ALTER TABLE `orders_info_card`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products` FOREIGN KEY (`order_id`) REFERENCES `orders_info_card` (`order_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
