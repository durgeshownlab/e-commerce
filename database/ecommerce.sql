-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 12:33 PM
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
(71, 9, 126, 1, 1200, 0, '2023-07-07 10:02:06');

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
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `product_id`, `address_id`, `transaction_id`, `quantity`, `price_single_unit`, `total_price`, `payment_method`, `payment_status`, `delivery_status`, `order_date`, `is_deleted`, `timestamp`) VALUES
(141, '168847436073f5370c', 9, 92, 20, NULL, 2, 15999, 31998, 'pod', 'pending', 'delivered', '2023-07-04 18:09:20', 0, '2023-07-04 12:39:20'),
(142, '1688474360d2135f2d', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'delivered', '2023-07-04 18:09:20', 0, '2023-07-04 12:39:20'),
(143, '16884743606d8481a5', 9, 103, 20, NULL, 5, 290, 1450, 'pod', 'pending', 'out for delivery', '2023-07-04 18:09:20', 0, '2023-07-04 12:39:20'),
(144, '16884753610ddf346d', 9, 92, 20, NULL, 2, 15999, 31998, 'pod', 'pending', 'order confirmed', '2023-07-04 18:26:01', 0, '2023-07-04 12:56:01'),
(145, '168847536131232843', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-04 18:26:01', 0, '2023-07-04 12:56:01'),
(146, '1688475361fbd19397', 9, 103, 20, NULL, 5, 290, 1450, 'pod', 'pending', 'order confirmed', '2023-07-04 18:26:01', 0, '2023-07-04 12:56:01'),
(147, '1688475428cc30642b', 9, 92, 20, NULL, 2, 15999, 31998, 'pod', 'pending', 'order confirmed', '2023-07-04 18:27:08', 0, '2023-07-04 12:57:08'),
(148, '16884754284c1c583d', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-04 18:27:08', 0, '2023-07-04 12:57:08'),
(149, '16885307293fb8870b', 9, 92, 20, NULL, 2, 15999, 31998, 'pod', 'pending', 'order confirmed', '2023-07-05 09:48:49', 0, '2023-07-05 04:18:49'),
(150, '16885307290f9b1c59', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-05 09:48:49', 0, '2023-07-05 04:18:49'),
(151, '168853158718c67d78', 9, 92, 20, NULL, 2, 15999, 31998, 'pod', 'pending', 'order confirmed', '2023-07-05 10:03:07', 0, '2023-07-05 04:33:07'),
(152, '168853158710a3fb85', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-05 10:03:07', 0, '2023-07-05 04:33:07'),
(153, '1688533289c270705c', 9, 92, 20, NULL, 2, 15999, 31998, 'pod', 'pending', 'order confirmed', '2023-07-05 10:31:29', 0, '2023-07-05 05:01:29'),
(154, '1688533289eb0e9a3a', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-05 10:31:29', 0, '2023-07-05 05:01:29'),
(155, '168853347316eb82ea', 9, 92, 20, NULL, 2, 15999, 31998, 'pod', 'pending', 'order confirmed', '2023-07-05 10:34:33', 0, '2023-07-05 05:04:33'),
(156, '1688533473be585b9e', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-05 10:34:33', 0, '2023-07-05 05:04:33'),
(157, '1688533827508389c7', 9, 92, 20, NULL, 2, 15999, 31998, 'pod', 'pending', 'order confirmed', '2023-07-05 10:40:27', 0, '2023-07-05 05:10:27'),
(158, '16885338276bdf8c2c', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-05 10:40:27', 0, '2023-07-05 05:10:27'),
(159, '1688534319d70414ec', 9, 92, 20, NULL, 2, 15999, 31998, 'pod', 'pending', 'order confirmed', '2023-07-05 10:48:39', 0, '2023-07-05 05:18:39'),
(160, '168853431953444e2f', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-05 10:48:39', 0, '2023-07-05 05:18:39'),
(161, '1688534453d5d3fe24', 9, 92, 20, NULL, 2, 15999, 31998, 'pod', 'pending', 'order confirmed', '2023-07-05 10:50:53', 0, '2023-07-05 05:20:53'),
(162, '1688534453f11fb086', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-05 10:50:53', 0, '2023-07-05 05:20:53'),
(163, '1688534629fba3c721', 9, 92, 20, 'pay_MA0G58zAOqqcsP', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 10:53:49', 0, '2023-07-05 05:23:49'),
(164, '1688534629128d5ce1', 9, 101, 20, 'pay_MA0G58zAOqqcsP', 2, 10000, 20000, 'online', 'success', 'order confirmed', '2023-07-05 10:53:49', 0, '2023-07-05 05:23:49'),
(165, '16885348169efb71e8', 9, 92, 20, 'pay_MA0JPZ5lfOwihx', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 10:56:56', 0, '2023-07-05 05:26:56'),
(166, '16885348163dce9772', 9, 101, 20, 'pay_MA0JPZ5lfOwihx', 2, 10000, 20000, 'online', 'success', 'order confirmed', '2023-07-05 10:56:56', 0, '2023-07-05 05:26:56'),
(167, '16885351873299f786', 9, 92, 20, 'pay_MA0PxXj4LhA695', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 11:03:07', 0, '2023-07-05 05:33:07'),
(168, '16885351875b845717', 9, 101, 20, 'pay_MA0PxXj4LhA695', 2, 10000, 20000, 'online', 'success', 'order confirmed', '2023-07-05 11:03:07', 0, '2023-07-05 05:33:07'),
(169, '168853538310403adf', 9, 92, 20, 'pay_MA0TP0PVnMdyb6', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 11:06:23', 0, '2023-07-05 05:36:23'),
(170, '16885353832fbf8a1f', 9, 101, 20, 'pay_MA0TP0PVnMdyb6', 2, 10000, 20000, 'online', 'success', 'order confirmed', '2023-07-05 11:06:23', 0, '2023-07-05 05:36:23'),
(171, '1688535428170d6d7b', 9, 92, 20, 'pay_MA0UC9ZPhQlfT3', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 11:07:08', 0, '2023-07-05 05:37:08'),
(172, '1688535428a8e73a7a', 9, 101, 20, 'pay_MA0UC9ZPhQlfT3', 2, 10000, 20000, 'online', 'success', 'order confirmed', '2023-07-05 11:07:08', 0, '2023-07-05 05:37:08'),
(173, '16885374361b982e17', 9, 101, 20, NULL, 1, 10000, 10000, 'pod', 'pending', 'order confirmed', '2023-07-05 11:40:36', 0, '2023-07-05 06:10:36'),
(174, '1688537436ae511763', 9, 103, 20, NULL, 1, 290, 290, 'pod', 'pending', 'order confirmed', '2023-07-05 11:40:36', 0, '2023-07-05 06:10:36'),
(175, '1688541056a6517018', 9, 101, 20, NULL, 1, 10000, 10000, 'pod', 'pending', 'order confirmed', '2023-07-05 12:40:56', 0, '2023-07-05 07:10:56'),
(176, '1688541056e63163f0', 9, 103, 20, NULL, 1, 290, 290, 'pod', 'pending', 'order confirmed', '2023-07-05 12:40:56', 0, '2023-07-05 07:10:56'),
(177, '1688541437a944dba7', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-05 12:47:17', 0, '2023-07-05 07:17:17'),
(178, '16885414374ebfdb20', 9, 103, 20, NULL, 2, 290, 580, 'pod', 'pending', 'order confirmed', '2023-07-05 12:47:17', 0, '2023-07-05 07:17:17'),
(179, '1688541437ba102489', 9, 105, 20, NULL, 1, 10999, 10999, 'pod', 'pending', 'order confirmed', '2023-07-05 12:47:17', 0, '2023-07-05 07:17:17'),
(180, '1688541437484dc5bb', 9, 112, 20, NULL, 2, 277, 554, 'pod', 'pending', 'order confirmed', '2023-07-05 12:47:17', 0, '2023-07-05 07:17:17'),
(181, '1688541887c211c9cb', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-05 12:54:47', 0, '2023-07-05 07:24:47'),
(182, '16885423843ddfc236', 9, 101, 20, 'pay_MA2SdzV5tXS5t4', 2, 10000, 20000, 'online', 'success', 'order confirmed', '2023-07-05 13:03:04', 0, '2023-07-05 07:33:04'),
(183, '16885423843103a20b', 9, 103, 20, 'pay_MA2SdzV5tXS5t4', 2, 290, 580, 'online', 'success', 'order confirmed', '2023-07-05 13:03:04', 0, '2023-07-05 07:33:04'),
(184, '16885423848f04b492', 9, 105, 20, 'pay_MA2SdzV5tXS5t4', 2, 10999, 21998, 'online', 'success', 'order confirmed', '2023-07-05 13:03:04', 0, '2023-07-05 07:33:04'),
(185, '16885423849875d0bb', 9, 112, 20, 'pay_MA2SdzV5tXS5t4', 2, 277, 554, 'online', 'success', 'order confirmed', '2023-07-05 13:03:04', 0, '2023-07-05 07:33:04'),
(186, '1688542419c4d2d164', 9, 101, 20, NULL, 2, 10000, 20000, 'pod', 'pending', 'order confirmed', '2023-07-05 13:03:39', 0, '2023-07-05 07:33:39'),
(187, '1688542419a1134103', 9, 103, 20, NULL, 2, 290, 580, 'pod', 'pending', 'order confirmed', '2023-07-05 13:03:39', 0, '2023-07-05 07:33:39'),
(188, '1688542419446040f6', 9, 105, 20, NULL, 2, 10999, 21998, 'pod', 'pending', 'order confirmed', '2023-07-05 13:03:39', 0, '2023-07-05 07:33:39'),
(189, '168854241931930c63', 9, 112, 20, NULL, 2, 277, 554, 'pod', 'pending', 'order confirmed', '2023-07-05 13:03:39', 0, '2023-07-05 07:33:39'),
(190, '1688542602e8b29103', 9, 101, 19, 'pay_MA2WTPapQILy8Y', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-05 13:06:42', 0, '2023-07-05 07:36:42'),
(191, '1688542602406b22cc', 9, 92, 19, 'pay_MA2WTPapQILy8Y', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:06:42', 0, '2023-07-05 07:36:42'),
(192, '1688542640794d044b', 9, 101, 19, 'pay_MA2XBGpwvIpGEL', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-05 13:07:20', 0, '2023-07-05 07:37:20'),
(193, '1688542640b79a3086', 9, 92, 19, 'pay_MA2XBGpwvIpGEL', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:07:20', 0, '2023-07-05 07:37:20'),
(194, '1688542717b27a06f0', 9, 101, 19, 'pay_MA2YWkdj4JQcEK', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-05 13:08:37', 0, '2023-07-05 07:38:37'),
(195, '16885427171b3fce95', 9, 92, 19, 'pay_MA2YWkdj4JQcEK', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:08:37', 0, '2023-07-05 07:38:37'),
(196, '168854275353a75357', 9, 103, 20, 'pay_MA2ZR4Euw5z1rN', 1, 290, 290, 'online', 'success', 'order confirmed', '2023-07-05 13:09:30', 0, '2023-07-05 07:39:30'),
(197, '16885428793acb222e', 9, 101, 20, NULL, 1, 10000, 10000, 'pod', 'pending', 'order confirmed', '2023-07-05 13:11:19', 0, '2023-07-05 07:41:19'),
(198, '1688542879fabca19f', 9, 92, 20, NULL, 1, 15999, 15999, 'pod', 'pending', 'order confirmed', '2023-07-05 13:11:19', 0, '2023-07-05 07:41:19'),
(199, '168854287995b64c7a', 9, 103, 20, NULL, 1, 290, 290, 'pod', 'pending', 'order confirmed', '2023-07-05 13:11:19', 0, '2023-07-05 07:41:19'),
(200, '16885429162197774f', 9, 101, 20, 'pay_MA2c0LxWxFLUtl', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-05 13:11:56', 0, '2023-07-05 07:41:56'),
(201, '16885429169c56ba22', 9, 92, 20, 'pay_MA2c0LxWxFLUtl', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:11:56', 0, '2023-07-05 07:41:56'),
(202, '1688542916513ed088', 9, 103, 20, 'pay_MA2c0LxWxFLUtl', 1, 290, 290, 'online', 'success', 'order confirmed', '2023-07-05 13:11:56', 0, '2023-07-05 07:41:56'),
(203, '168854295525c40896', 9, 101, 20, 'pay_MA2ch8QOSCaBW1', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-05 13:12:35', 0, '2023-07-05 07:42:35'),
(204, '1688542955144517f3', 9, 92, 20, 'pay_MA2ch8QOSCaBW1', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:12:35', 0, '2023-07-05 07:42:35'),
(205, '1688542955134523a2', 9, 103, 20, 'pay_MA2ch8QOSCaBW1', 1, 290, 290, 'online', 'success', 'order confirmed', '2023-07-05 13:12:35', 0, '2023-07-05 07:42:35'),
(206, '16885430890d380e68', 9, 101, 20, 'pay_MA2f39HNGcgsBe', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-05 13:14:49', 0, '2023-07-05 07:44:49'),
(207, '1688543089155f2916', 9, 92, 20, 'pay_MA2f39HNGcgsBe', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:14:49', 0, '2023-07-05 07:44:49'),
(208, '168854308930cf1bff', 9, 103, 20, 'pay_MA2f39HNGcgsBe', 1, 290, 290, 'online', 'success', 'order confirmed', '2023-07-05 13:14:49', 0, '2023-07-05 07:44:49'),
(209, '16885431298b9c5a65', 9, 101, 20, 'pay_MA2fiztF5DqJe3', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-05 13:15:29', 0, '2023-07-05 07:45:29'),
(210, '1688543129651e872e', 9, 92, 20, 'pay_MA2fiztF5DqJe3', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:15:29', 0, '2023-07-05 07:45:29'),
(211, '1688543129dcedce60', 9, 103, 20, 'pay_MA2fiztF5DqJe3', 1, 290, 290, 'online', 'success', 'order confirmed', '2023-07-05 13:15:29', 0, '2023-07-05 07:45:29'),
(212, '1688543174475c0f23', 9, 92, 20, 'pay_MA2gnrMWb0ZFcw', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:16:29', 0, '2023-07-05 07:46:29'),
(213, '168854321205037400', 9, 92, 20, NULL, 1, 15999, 15999, 'pod', 'pending', 'order confirmed', '2023-07-05 13:16:52', 0, '2023-07-05 07:46:52'),
(214, '1688543398d7a2388e', 9, 92, 19, 'pay_MA2kUcbQTuAqYf', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:19:58', 0, '2023-07-05 07:49:58'),
(215, '1688543398a607af06', 9, 101, 19, 'pay_MA2kUcbQTuAqYf', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-05 13:19:58', 0, '2023-07-05 07:49:58'),
(216, '16885433986f86293f', 9, 103, 19, 'pay_MA2kUcbQTuAqYf', 5, 290, 1450, 'online', 'success', 'order confirmed', '2023-07-05 13:19:58', 0, '2023-07-05 07:49:58'),
(217, '168854545346762861', 9, 92, 20, 'pay_MA3KbK4v0RaYCX', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:54:13', 0, '2023-07-05 08:24:13'),
(218, '1688545453c055bd9e', 9, 101, 20, 'pay_MA3KbK4v0RaYCX', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-05 13:54:13', 0, '2023-07-05 08:24:13'),
(219, '16885454535c1cf545', 9, 103, 20, 'pay_MA3KbK4v0RaYCX', 5, 290, 1450, 'online', 'success', 'order confirmed', '2023-07-05 13:54:13', 0, '2023-07-05 08:24:13'),
(220, '168854548604d91888', 9, 92, 20, NULL, 1, 15999, 15999, 'pod', 'pending', 'order confirmed', '2023-07-05 13:54:46', 0, '2023-07-05 08:24:46'),
(221, '1688545486edfa16b8', 9, 101, 20, NULL, 1, 10000, 10000, 'pod', 'pending', 'order confirmed', '2023-07-05 13:54:46', 0, '2023-07-05 08:24:46'),
(222, '1688545486ee7869ab', 9, 103, 20, NULL, 5, 290, 1450, 'pod', 'pending', 'order confirmed', '2023-07-05 13:54:46', 0, '2023-07-05 08:24:46'),
(223, '1688545510521c8789', 9, 92, 20, NULL, 1, 15999, 15999, 'pod', 'success', 'delivered', '2023-07-05 13:55:10', 0, '2023-07-05 08:25:10'),
(224, '168854551034468249', 9, 101, 20, NULL, 1, 10000, 10000, 'pod', 'success', 'delivered', '2023-07-05 13:55:10', 0, '2023-07-05 08:25:10'),
(225, '1688545510f5744ca3', 9, 103, 20, NULL, 5, 290, 1450, 'pod', 'pending', 'order confirmed', '2023-07-05 13:55:10', 0, '2023-07-05 08:25:10'),
(226, '1688545542a6d5e9fe', 9, 92, 20, 'pay_MA3MEMagbWAYat', 1, 15999, 15999, 'online', 'success', 'order confirmed', '2023-07-05 13:55:42', 0, '2023-07-05 08:25:42'),
(227, '16885455420616356c', 9, 101, 20, 'pay_MA3MEMagbWAYat', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-05 13:55:42', 0, '2023-07-05 08:25:42'),
(228, '16885455425cf0fd4b', 9, 103, 20, 'pay_MA3MEMagbWAYat', 5, 290, 1450, 'online', 'success', 'order confirmed', '2023-07-05 13:55:42', 0, '2023-07-05 08:25:42'),
(229, '168855783512dc33a1', 9, 92, 20, NULL, 1, 15999, 15999, 'pod', 'success', 'delivered', '2023-07-05 17:20:35', 0, '2023-07-05 11:50:35'),
(230, '1688637091492bcc6a', 9, 112, 19, NULL, 1, 277, 277, 'pod', 'pending', 'delivered', '2023-07-06 15:21:31', 0, '2023-07-06 09:51:31'),
(231, '168863720396b54b5a', 9, 101, 19, 'pay_MATNuycQB8SE2K', 1, 10000, 10000, 'online', 'success', 'delivered', '2023-07-06 15:23:23', 0, '2023-07-06 09:53:23'),
(232, '16886372035e07e944', 9, 103, 19, 'pay_MATNuycQB8SE2K', 5, 290, 1450, 'online', 'success', 'delivered', '2023-07-06 15:23:23', 0, '2023-07-06 09:53:23'),
(233, '1688637203baf89243', 9, 112, 19, 'pay_MATNuycQB8SE2K', 1, 277, 277, 'online', 'success', 'delivered', '2023-07-06 15:23:23', 0, '2023-07-06 09:53:23'),
(234, '1688640222b7c37400', 9, 103, 20, NULL, 5, 290, 1450, 'pod', 'success', 'delivered', '2023-07-06 16:13:42', 0, '2023-07-06 10:43:42'),
(235, '16886402225abf9fc1', 9, 112, 20, NULL, 1, 277, 277, 'pod', 'success', 'delivered', '2023-07-06 16:13:42', 0, '2023-07-06 10:43:42'),
(236, '16886472612430a0a2', 9, 103, 20, 'pay_MAWF4MB2djYnqM', 5, 290, 1450, 'online', 'success', 'delivered', '2023-07-06 18:11:01', 0, '2023-07-06 12:41:01'),
(237, '168864726160b1f941', 9, 112, 20, 'pay_MAWF4MB2djYnqM', 2, 277, 554, 'online', 'success', 'order confirmed', '2023-07-06 18:11:01', 0, '2023-07-06 12:41:01'),
(238, '16886474496ecd7340', 9, 103, 20, NULL, 2, 290, 580, 'pod', 'pending', 'order confirmed', '2023-07-06 18:14:09', 0, '2023-07-06 12:44:09'),
(239, '168871481091249f74', 9, 101, 20, 'pay_MApQJJ6pwuXV9r', 1, 10000, 10000, 'online', 'success', 'order confirmed', '2023-07-07 12:56:50', 0, '2023-07-07 07:26:50'),
(240, '1688715066cd71b00b', 9, 101, 20, NULL, 1, 10000, 10000, 'pod', 'success', 'delivered', '2023-07-07 13:01:06', 0, '2023-07-07 07:31:06'),
(241, '1688715111d4e1ae8b', 9, 101, 21, 'pay_MApVsokNWUJK2e', 1, 10000, 10000, 'online', 'success', 'delivered', '2023-07-07 13:02:09', 0, '2023-07-07 07:32:09'),
(242, '168871987245e4bd0a', 9, 119, 21, NULL, 2, 0, 0, 'pod', 'success', 'delivered', '2023-07-07 14:21:12', 0, '2023-07-07 08:51:12'),
(243, '16887231072518b8a5', 9, 123, 21, NULL, 1, 23, 23, 'pod', 'success', 'delivered', '2023-07-07 15:15:07', 0, '2023-07-07 09:45:07'),
(244, '1688724143ac597bcf', 9, 126, 19, NULL, 1, 1200, 1200, 'pod', 'success', 'delivered', '2023-07-07 15:32:23', 0, '2023-07-07 10:02:23');

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
(162, 9, 101, 0, '2023-07-07 10:11:06'),
(163, 9, 103, 0, '2023-07-07 10:11:07'),
(164, 9, 92, 0, '2023-07-07 10:11:08');

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

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
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

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
