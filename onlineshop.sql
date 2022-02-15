-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2022 at 04:15 PM
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
(3, 'admin@gmail.com');

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
  `seller_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `p_status` varchar(20) NOT NULL,
  `p_type` varchar(24) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `seller_id`, `user_id`, `product_id`, `qty`, `trx_id`, `p_status`, `p_type`, `date_created`) VALUES
(50, 27, 50, 110, 5, 'pay_seix56vZsGTgt6uMke9c8Eyx', 'Completed', 'gcash', '2022-02-01 20:22:37'),
(51, 27, 50, 111, 1, 'pay_pSbvB6a2Yh9PxjWWo4Cxovbe', 'Pending', 'gcash', '2022-02-04 20:43:21'),
(52, 27, 50, 111, 1, 'pay_kHtdJLQTgwz297AR5wbWkdg8', 'Pending', 'gcash', '2022-02-04 20:58:57'),
(53, 27, 50, 111, 1, 'D464AA58-571D-4BD4-AEE6-253DE0316CE9', 'Pending', 'cod', '2022-02-04 21:18:30'),
(54, 27, 50, 111, 1, '30DCC778-0B7E-4E1D-BCFE-785F4DE7E3CA', 'Pending', 'cod', '2022-02-04 21:19:04'),
(55, 27, 50, 111, 1, '450F6975-6E11-4531-BA76-6CF980E20AC2', 'Pending', 'cod', '2022-02-04 21:19:31'),
(56, 27, 50, 111, 1, 'A4711021-97C0-4EC7-B4F2-170EC34DED8A', 'Pending', 'cod', '2022-02-04 21:19:55'),
(57, 27, 50, 111, 1, 'E2BB9488-C48B-43BD-B634-F27F274D93EE', 'Pending', 'card', '2022-02-04 21:22:24'),
(58, 27, 50, 111, 1, 'DC17EAFA-3E7F-469E-A51A-1D080BF8F770', 'Pending', 'card', '2022-02-04 21:22:48'),
(59, 27, 50, 111, 1, 'EB28F3E0-9633-49B4-9CC0-DE85CF254455', 'Pending', 'card', '2022-02-04 21:23:05'),
(60, 27, 50, 111, 1, '8333CF1C-7BD4-4F85-B31E-C3347287A408', 'Pending', 'cod', '2022-02-04 21:28:55'),
(61, 27, 50, 111, 111, '990BAE99-155B-4A32-A63B-02A49C28FC3C', 'Pending', 'cod', '2022-02-13 17:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `orders_info_card`
--

CREATE TABLE `orders_info_card` (
  `order_id` int(10) NOT NULL,
  `trx_id` varchar(256) NOT NULL,
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

INSERT INTO `orders_info_card` (`order_id`, `trx_id`, `user_id`, `f_name`, `email`, `address`, `city`, `state`, `zip`, `cardname`, `cardnumber`, `expdate`, `prod_count`, `total_amt`, `cvv`) VALUES
(1, '', 49, 'John Doe', 'johdoe01@gmail.com', 'Santa Teresita', 'Angeles City', 'Pampanga', 2009, 'Andres ', '2222222222222222', '12/22', 1, 999, 512),
(2, '', 50, 'John Doe', 'johndoe01@gmail.com', 'Santa Teresita', 'Angeles City', 'Pampanga', 2009, 'Andres ', '1111111111111111', '11/22', 1, 10000, 123);

-- --------------------------------------------------------

--
-- Table structure for table `order_info_cod`
--

CREATE TABLE `order_info_cod` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(512) NOT NULL,
  `total_amt` int(11) NOT NULL,
  `trx_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_info_cod`
--

INSERT INTO `order_info_cod` (`order_id`, `user_id`, `address`, `total_amt`, `trx_id`) VALUES
(30, 50, 'Santa Teresita, Angeles City', 10000, '30DCC778-0B7E-4E1D-BCFE-785F4DE7E3CA'),
(450, 50, 'Santa Teresita, Angeles City', 10000, '450F6975-6E11-4531-BA76-6CF980E20AC2'),
(990, 50, 'Santa Teresita, Angeles City', 10000, '990BAE99-155B-4A32-A63B-02A49C28FC3C'),
(8333, 50, 'Santa Teresita, Angeles City', 10000, '8333CF1C-7BD4-4F85-B31E-C3347287A408'),
(1693936, 50, 'Santa Teresita, Angeles City', 10000, 'D464AA58-571D-4BD4-AEE6-253DE0316CE9'),
(1693937, 50, 'Santa Teresita, Angeles City', 10000, 'A4711021-97C0-4EC7-B4F2-170EC34DED8A');

-- --------------------------------------------------------

--
-- Table structure for table `order_info_gcash`
--

CREATE TABLE `order_info_gcash` (
  `id` int(10) NOT NULL,
  `order_id` varchar(512) NOT NULL,
  `trx_id` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `account_name` varchar(64) NOT NULL,
  `account_number` int(64) NOT NULL,
  `total_amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_info_gcash`
--

INSERT INTO `order_info_gcash` (`id`, `order_id`, `trx_id`, `user_id`, `address`, `account_name`, `account_number`, `total_amt`) VALUES
(9, '', '', 49, 'Santa Teresita, Angeles City', 'John Doe', 0, 999),
(10, 'pay_Wr5ve9iJUNSjNcAEJeybr3iF', '', 49, 'Santa Teresita, Angeles City', 'John Doe', 2147483647, 2997),
(11, 'pay_seix56vZsGTgt6uMke9c8Eyx', '', 50, 'Santa Teresita, Angeles City', 'John Doe', 2147483647, 4995),
(12, 'pay_pSbvB6a2Yh9PxjWWo4Cxovbe', '', 50, 'Santa Teresita, Angeles City', 'John Doe', 2147483647, 10000),
(13, 'pay_kHtdJLQTgwz297AR5wbWkdg8', '', 50, 'Santa Teresita, Angeles City', 'John Doe', 2147483647, 10000);

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
(106, 2, 111, 1, 10000);

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
  `stock` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `seller_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `stock`, `product_desc`, `product_image`, `product_keywords`) VALUES
(111, 27, 1, 8, 'Malunggay[ EXCLUSIVE OFFER ]', 10000, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '111.jpg', ''),
(112, 28, 1, 8, 'Johns Guyabano', 10, 10, 'a ad asd ', '112.jpg', '');

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
(27, 'Jane Done', 'jane01', 'aa64b63697ecfff47a09f676562b6d3f', 'jane01@gmail.com', '09560586578', 'Angeles City, Pampanga', 2, '2022-02-01 19:51:33'),
(28, 'John Doe', 'john01', 'bc9ac58d5b7a73808fb5dea595f50bdd', 'johndoe@gmail.com', '09560585678', 'Santa Teresita', 2, '2022-02-15 18:00:28');

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
  `address2` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(49, 'John', 'Doe', 'johdoe01@gmail.com', 'testtest@SM123', '9560585678', 'Santa Teresita', 'Angeles City'),
(50, 'John', 'Doe', 'johndoe01@gmail.com', 'testtest@SM123', '9560585678', 'Santa Teresita', 'Angeles City');

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
(47, 'Jane', 'Doe', 'buyer01@gmail.com', '$KsCPDp62k', '9560585678', 'Santa Teresita', 'Angeles Cit'),
(48, '', '', '', '', '', '', ''),
(49, 'John', 'Doe', 'johdoe01@gmail.com', 'testtest@SM123', '9560585678', 'Santa Teresita', 'Angeles Cit'),
(50, 'John', 'Doe', 'johndoe01@gmail.com', 'testtest@SM123', '9560585678', 'Santa Teresita', 'Angeles Cit');

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
-- Indexes for table `order_info_gcash`
--
ALTER TABLE `order_info_gcash`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `orders_info_card`
--
ALTER TABLE `orders_info_card`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_info_cod`
--
ALTER TABLE `order_info_cod`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1693938;

--
-- AUTO_INCREMENT for table `order_info_gcash`
--
ALTER TABLE `order_info_gcash`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_info_backup`
--
ALTER TABLE `user_info_backup`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
