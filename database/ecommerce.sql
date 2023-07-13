-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 02:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `pin_code` varchar(11) NOT NULL,
  `locality` text NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'India',
  `address_type` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `user_id`, `name`, `mobile`, `pin_code`, `locality`, `address`, `city`, `state`, `country`, `address_type`, `is_deleted`, `timestamp`) VALUES
(9, 10, 'df', '5673456345', '345643', 'grhfg', 'df', 'dfgh', 'Himachal Pradesh', 'India', 'home', 0, '2023-06-28 09:30:37'),
(10, 10, ' df', '3646363663', '234636', 'dfgs', 'sdfs', 'sdf', 'Kerala', 'India', 'office', 0, '2023-06-28 09:31:35'),
(19, 9, 'Durgesh Kumar', '7667107173', '851133', 'rani bagh', 'Mokhtiyarpur bhagwanpur begusarai Bihar', 'Begusarai', 'Bihar', 'India', 'home', 0, '2023-06-30 10:14:47'),
(20, 9, 'vikash kumar', '7667107173', '585556', 'ranibagh', 'Mokhtiyarpur bhagwanpur begusarai Bihar', 'Begusarai', 'Delhi', 'India', 'office', 0, '2023-07-04 06:58:06'),
(21, 9, 'fthydh', '8678548585', '453743', '437thsdh', 'sdfhsh', 'sdhdsh', 'Sikkim', 'India', 'home', 0, '2023-07-07 07:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `total_price`, `is_deleted`, `timestamp`) VALUES
(33, 10, 92, 1, 15999, 0, '2023-06-28 09:49:22'),
(61, 9, 119, 2, 0, 0, '2023-07-07 08:50:56'),
(65, 9, 120, 1, 0, 0, '2023-07-07 09:03:22'),
(67, 9, 121, 1, 0, 0, '2023-07-07 09:22:39'),
(68, 9, 123, 1, 23, 0, '2023-07-07 09:44:53'),
(69, 9, 124, 1, 425, 0, '2023-07-07 09:52:21'),
(70, 9, 125, 1, 0, 0, '2023-07-07 09:55:33'),
(71, 9, 126, 1, 1200, 0, '2023-07-07 10:02:06'),
(80, 9, 105, 1, 10999, 0, '2023-07-12 11:44:23'),
(81, 9, 103, 1, 290, 0, '2023-07-13 12:34:38'),
(82, 9, 92, 1, 15999, 0, '2023-07-13 12:34:49'),
(83, 9, 101, 1, 10000, 0, '2023-07-13 12:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price_single_unit` bigint(20) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `delivery_status` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_event` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_canceled` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `product_id`, `address_id`, `transaction_id`, `quantity`, `price_single_unit`, `total_price`, `payment_method`, `payment_status`, `delivery_status`, `order_status`, `order_event`, `order_date`, `is_deleted`, `is_canceled`, `timestamp`) VALUES
(1, '1689247230b323f5a5', 9, 103, 21, NULL, 1, 290, 290, 'pod', 'pending', 'order confirmed', 'canceled', '[{\"event_name\":\"order placed\",\"Date\":\"13-07-2023\",\"Time\":\"13:27:55\"}]', '2023-07-13 16:50:30', 0, 1, '2023-07-13 11:20:30'),
(2, '16892472301e2c7905', 9, 105, 21, NULL, 3, 10999, 32997, 'pod', 'pending', 'order confirmed', 'canceled', NULL, '2023-07-13 16:50:30', 0, 1, '2023-07-13 11:20:30'),
(3, '168924725968f6a463', 9, 103, 20, 'pay_MDGcNAJWwDSiJL', 1, 290, 290, 'online', 'success', 'delivered', 'confirm', '[{\"event_name\":\"order placed\",\"Date\":\"13-07-2023\",\"Time\":\"13:21:15\"}]', '2023-07-13 16:50:59', 0, 0, '2023-07-13 11:20:59'),
(4, '1689247259a59a9f0b', 9, 105, 20, 'pay_MDGcNAJWwDSiJL', 3, 10999, 32997, 'online', 'success', 'order confirmed', 'canceled', NULL, '2023-07-13 16:50:59', 0, 1, '2023-07-13 11:20:59'),
(5, '16892497031c161852', 9, 105, 20, NULL, 3, 10999, 32997, 'pod', 'success', 'delivered', 'confirm', '[{\"event_name\":\"order placed\",\"Date\":\"13-07-2023\",\"Time\":\"14:02:01\"}]', '2023-07-13 17:31:43', 0, 0, '2023-07-13 12:01:43'),
(6, '16892509368d23aa6c', 9, 105, 20, NULL, 2, 10999, 21998, 'pod', 'pending', 'order confirmed', 'canceled', NULL, '2023-07-13 17:52:16', 0, 1, '2023-07-13 12:22:16'),
(7, '1689251424fb83da67', 9, 105, 20, 'pay_MDHngloDlYcwkb', 2, 10999, 21998, 'online', 'success', 'order confirmed', 'confirm', '[{\"event_name\":\"order placed\",\"Date\":\"13-07-2023\",\"Time\":\"14:31:22\"}]', '2023-07-13 18:00:24', 0, 0, '2023-07-13 12:30:24'),
(8, '16892517066680fa7a', 9, 105, 21, NULL, 1, 10999, 10999, 'pod', 'success', 'delivered', 'confirm', '[{\"event_name\":\"order placed\",\"Date\":\"13-07-2023\",\"Time\":\"14:35:42\"}]', '2023-07-13 18:05:06', 0, 0, '2023-07-13 12:35:06'),
(9, '16892517066a8eb900', 9, 103, 21, NULL, 1, 290, 290, 'pod', 'pending', 'order confirmed', 'confirm', '[{\"event_name\":\"order placed\",\"Date\":\"13-07-2023\",\"Time\":\"14:45:58\"}]', '2023-07-13 18:05:06', 0, 0, '2023-07-13 12:35:06'),
(10, '1689251706e98de5b0', 9, 92, 21, NULL, 1, 15999, 15999, 'pod', 'pending', 'order confirmed', 'canceled', NULL, '2023-07-13 18:05:06', 0, 1, '2023-07-13 12:35:06'),
(11, '1689251706d680d292', 9, 101, 21, NULL, 1, 10000, 10000, 'pod', 'pending', 'order confirmed', 'canceled', NULL, '2023-07-13 18:05:06', 0, 1, '2023-07-13 12:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `image`, `is_deleted`, `timestamp`) VALUES
(1, 'Top Offers', 'img/category/top_offers.webp', 0, '2023-06-13 20:12:41'),
(2, 'Mobiles & Tablets', 'img/category/smart_phone.webp', 0, '2023-06-13 20:12:41'),
(3, 'Electronics', 'img/category/laptop.webp', 0, '2023-06-13 20:13:37'),
(4, 'TV & Appliances', 'img/category/tv.webp', 0, '2023-06-13 20:13:37'),
(5, 'Fashions', 'img/category/fashions.webp', 0, '2023-06-13 20:14:45'),
(6, 'Beauty', 'img/category/beauty.webp', 0, '2023-06-13 20:14:45'),
(7, 'Home & Kitchen', 'img/category/home_and_kitchen.webp', 0, '2023-06-13 20:16:20'),
(8, 'Furniture', 'img/category/furniture.webp', 0, '2023-06-13 20:16:20'),
(9, 'Flights', 'img/category/flights.webp', 0, '2023-06-13 20:16:55'),
(10, 'Grocery', 'img/category/grocery.webp', 0, '2023-06-13 20:16:55'),
(33, 'fgns', 'img/category/64a7c0195d0e08.56834546.jpg', 1, '2023-07-07 07:34:49'),
(34, 'test', 'img/category/64a7d17717dd37.72923197.jpg', 1, '2023-07-07 08:48:55'),
(35, 'ddddf', 'img/category/64a7d7e27008c5.51293678.jpg', 1, '2023-07-07 09:16:18'),
(36, 'asdf', 'img/category/64a7daed9da835.44118267.jpg', 1, '2023-07-07 09:29:17'),
(37, 'test', 'img/category/64a7de49029868.97266519.jpg', 1, '2023-07-07 09:43:37'),
(38, 'asdf', 'img/category/64a7e034c2d920.20759942.jpg', 1, '2023-07-07 09:51:48'),
(39, 'veg', 'img/category/64a7e255d47813.02749283.jpg', 1, '2023-07-07 10:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_specifications_table`
--

CREATE TABLE `product_specifications_table` (
  `specification_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_specifications_table`
--

INSERT INTO `product_specifications_table` (`specification_id`, `product_id`, `name`, `value`, `is_deleted`, `timestamp`) VALUES
(25, 92, 'ram', '8 GB', 0, '2023-06-21 19:35:42'),
(26, 92, 'rom', '64 GB', 0, '2023-06-21 19:36:14'),
(35, 105, 'ss', 'dsg', 0, '2023-06-21 23:56:06'),
(36, 105, 'sdfg', 'dsfg', 0, '2023-06-21 23:56:06'),
(37, 105, 'asf', 'sf', 0, '2023-06-21 23:56:06'),
(47, 112, 'color', 'black', 0, '2023-06-22 23:17:38'),
(48, 112, 'size', '95 cm', 0, '2023-06-22 23:17:38'),
(49, 117, 'sdf', 'sdg', 0, '2023-07-06 12:42:52'),
(50, 117, 'sdf', 'sdfg', 0, '2023-07-06 12:42:52'),
(51, 118, 'asdf', 'asdf', 0, '2023-07-07 08:49:57'),
(52, 123, 'asdf', 'asdf', 0, '2023-07-07 09:44:11'),
(53, 126, 'AA', 'AA', 0, '2023-07-07 10:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_image` text NOT NULL,
  `product_price` bigint(20) NOT NULL,
  `product_desc` text NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`product_id`, `product_name`, `product_image`, `product_price`, `product_desc`, `sub_category_id`, `is_deleted`, `timestamp`) VALUES
(92, 'OPPO A17 (Lake Blue, 64 GB)  (4 GB RAM)', 'img/common/64948ea3d328f3.19062641.webp', 15999, '8 GB', 1, 0, '2023-06-21 19:34:25'),
(101, 'realme C33 2023', 'img/common/64938b2d4ed455.40779882.webp', 10000, '4 GB RAM and 64 GB ROM', 1, 0, '2023-06-21 23:43:41'),
(103, 'realme C33 2023', 'img/common/64938c810a0817.51385795.webp', 290, 'sdf', 1, 0, '2023-06-21 23:49:21'),
(105, 'sadf', 'img/common/64938e1656c028.05183453.webp', 10999, 'sadf', 1, 0, '2023-06-21 23:56:06'),
(112, 'shirt', 'img/common/6494d6ee1d36e0.88419080.webp', 277, 'half shirt', 32, 1, '2023-06-22 23:17:38'),
(114, 'fsdfs', 'img/common/64a6a2682975c7.54140948.jpg', 0, 'asfsaf', 32, 1, '2023-07-06 11:15:52'),
(115, 'asdgsg', 'img/common/64a6a591c2e6f2.70616549.jpg', 0, 'zxcbb', 34, 1, '2023-07-06 11:29:21'),
(117, 'sdhd', 'img/common/64a6b6cc0348c9.15887354.jpg', 5000, 'sdfgh', 34, 1, '2023-07-06 12:42:52'),
(118, 'asdf', 'img/common/64a7d1b4efd348.56773561.jpg', 0, 'sf', 36, 1, '2023-07-07 08:49:57'),
(119, 'tset ', 'img/common/64a7d1c4aa2509.08243622.jpg', 0, 'sadfa', 36, 1, '2023-07-07 08:50:12'),
(120, 'asdgsg', 'img/common/64a7d4af9998b5.15255045.jpg', 0, 'sdfsafgs', 37, 1, '2023-07-07 09:02:39'),
(121, 'sdfs', 'img/common/64a7d808e640a2.64123715.jpg', 0, 'asdfsa', 38, 1, '2023-07-07 09:16:56'),
(122, 'asdf', 'img/common/64a7db02d1d541.08892652.jpg', 0, 'asdf', 39, 1, '2023-07-07 09:29:38'),
(123, 'asdfsa', 'img/common/64a7de6b05b566.11047269.jpg', 23, 'sdfsaf', 40, 1, '2023-07-07 09:44:11'),
(124, 'asdf', 'img/common/64a7e04756fef1.32486120.jpg', 425, 'safds', 42, 1, '2023-07-07 09:52:07'),
(125, 'asdsa', 'img/common/64a7e10c3f3e90.44926574.jpg', 0, 'asda', 43, 1, '2023-07-07 09:55:24'),
(126, 'MANGO', 'img/common/64a7e27d682552.06763085.jpg', 1200, 'LELELELE', 44, 1, '2023-07-07 10:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `razorpay_record`
--

CREATE TABLE `razorpay_record` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `razorpay_order_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `razorpay_record`
--

INSERT INTO `razorpay_record` (`id`, `order_id`, `razorpay_order_id`, `user_id`, `product_id`, `datetime`, `is_deleted`, `timestamp`) VALUES
(23, '16882058926226f17d', 'order_M8Uufxnk5DR7Gl', 9, 101, '2023-07-01 15:34:52', 0, '2023-07-01 10:04:52'),
(24, '1688207793b4101fcc', 'order_M8VS9LG3lLVH9s', 9, 101, '2023-07-01 16:06:33', 0, '2023-07-01 10:36:33'),
(25, '1688207825821fbe7c', 'order_M8VSiRJFpfgBPe', 9, 101, '2023-07-01 16:07:06', 0, '2023-07-01 10:37:06'),
(26, '1688208467cb631848', 'order_M8Ve1JT2pvxAEf', 9, 101, '2023-07-01 16:17:48', 0, '2023-07-01 10:47:48'),
(27, '16882085093171a921', 'order_M8VekLviFUV9QH', 9, 101, '2023-07-01 16:18:29', 0, '2023-07-01 10:48:29'),
(28, '1688208596c100e217', 'order_M8VgIDCzhqXIWK', 9, 101, '2023-07-01 16:19:57', 0, '2023-07-01 10:49:57'),
(29, '1688209565acd740ff', 'order_M8VxLeJZBv2MOB', 9, 101, '2023-07-01 16:36:06', 0, '2023-07-01 11:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `name`, `category_id`, `is_deleted`, `timestamp`) VALUES
(1, 'smartphone', 2, 0, '2023-06-21 19:18:33'),
(9, 'tablets', 2, 0, '2023-06-21 23:29:18'),
(25, 'hgjk', 6, 0, '2023-06-22 22:14:55'),
(26, 'dfhdfhd', 6, 0, '2023-06-22 22:14:58'),
(30, 'key-pad', 2, 0, '2023-06-22 23:15:17'),
(32, 'asdf', 5, 0, '2023-06-22 23:16:57'),
(34, 'sdfag', 1, 1, '2023-07-06 11:28:59'),
(35, 'asdf', 33, 0, '2023-07-07 07:35:01'),
(36, 'test sub cat', 34, 1, '2023-07-07 08:49:34'),
(37, 'test sub cat', 34, 0, '2023-07-07 09:02:20'),
(38, 'asfdf', 35, 0, '2023-07-07 09:16:38'),
(39, 'asdf', 36, 1, '2023-07-07 09:29:26'),
(40, 'test sub cat', 37, 1, '2023-07-07 09:43:48'),
(41, 'test sub cat2', 37, 1, '2023-07-07 09:43:54'),
(42, 'asdf', 38, 1, '2023-07-07 09:51:56'),
(43, 'sads', 38, 1, '2023-07-07 09:55:10'),
(44, 'SUB-VEG', 39, 1, '2023-07-07 10:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `name`, `email`, `mobile`, `gender`, `password`, `user_type`, `is_deleted`, `timestamp`) VALUES
(1, 'durgesh kumar', 'durgesh@gmail.com', '7667107173', 'male', '12345', 'admin', 0, '2023-06-21 17:29:23'),
(9, 'vikash kumar', 'durgeshkumarraj62@gmail.com', '9508727678', 'male', '12345', 'customer', 0, '2023-06-23 17:27:25'),
(10, 'naveen', 'naveen@gmail.com', '6205925686', 'male', '12345', 'customer', 0, '2023-06-28 04:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`wishlist_id`, `user_id`, `product_id`, `is_deleted`, `timestamp`) VALUES
(157, 9, 120, 0, '2023-07-07 09:03:13'),
(158, 9, 121, 0, '2023-07-07 09:22:37'),
(159, 9, 123, 0, '2023-07-07 09:44:51'),
(160, 9, 124, 0, '2023-07-07 09:52:18'),
(161, 9, 125, 0, '2023-07-07 09:55:34'),
(171, 9, 92, 0, '2023-07-10 04:22:36'),
(172, 9, 101, 0, '2023-07-12 10:13:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_specifications_table`
--
ALTER TABLE `product_specifications_table`
  ADD PRIMARY KEY (`specification_id`),
  ADD KEY `product_specifications_table_ibfk_1` (`product_id`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_table_ibfk_1` (`sub_category_id`);

--
-- Indexes for table `razorpay_record`
--
ALTER TABLE `razorpay_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`),
  ADD KEY `sub_category_ibfk_1` (`category_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product_specifications_table`
--
ALTER TABLE `product_specifications_table`
  MODIFY `specification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `razorpay_record`
--
ALTER TABLE `razorpay_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `product_specifications_table`
--
ALTER TABLE `product_specifications_table`
  ADD CONSTRAINT `product_specifications_table_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`);

--
-- Constraints for table `product_table`
--
ALTER TABLE `product_table`
  ADD CONSTRAINT `product_table_ibfk_1` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`sub_category_id`);

--
-- Constraints for table `razorpay_record`
--
ALTER TABLE `razorpay_record`
  ADD CONSTRAINT `razorpay_record_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`),
  ADD CONSTRAINT `razorpay_record_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`),
  ADD CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
