-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2020 at 10:08 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapps`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_log`
--

CREATE TABLE `app_log` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `module` varchar(50) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_log`
--

INSERT INTO `app_log` (`id`, `id_user`, `module`, `activity`, `timestamp`) VALUES
(1, 1, 'app-backend-webapps/user', 'index', '2020-11-02 08:23:09'),
(2, 1, 'app-backend-webapps/user-access', 'control', '2020-11-02 08:23:15'),
(3, 1, 'app-backend-webapps/user-level', 'index', '2020-11-02 08:23:31'),
(4, 1, 'app-backend-webapps/user-access', 'control', '2020-11-02 08:23:34'),
(5, 1, 'app-backend-webapps/user-level', 'index', '2020-11-02 08:23:44'),
(6, 1, 'app-backend-webapps/user-menu', 'index', '2020-11-02 08:23:47'),
(7, 1, 'app-backend-webapps/app-log', 'index', '2020-11-02 08:23:57'),
(8, 1, 'app-backend-webapps/app-logd', 'index', '2020-11-02 08:24:03'),
(9, 1, 'app-backend-webapps/system', 'info', '2020-11-02 08:24:08'),
(10, 1, 'app-backend-webapps/user', 'index', '2020-11-02 10:41:03'),
(11, 1, 'app-backend-webapps/user-access', 'control', '2020-11-02 10:41:16'),
(12, 1, 'app-backend-webapps/user', 'index', '2020-11-02 10:41:20'),
(13, 2, 'app-backend-webapps/user', 'index', '2020-11-02 10:43:26'),
(14, 2, 'app-backend-webapps/user-access', 'control', '2020-11-02 10:43:29'),
(15, 2, 'app-backend-webapps/user-level', 'index', '2020-11-02 10:43:32'),
(16, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-02 10:43:35'),
(17, 2, 'app-backend-webapps/user-level', 'index', '2020-11-02 10:43:38'),
(18, 2, 'app-backend-webapps/user-level', 'update', '2020-11-02 10:44:07'),
(19, 2, 'app-backend-webapps/user-level', 'update', '2020-11-02 10:44:31'),
(20, 2, 'app-backend-webapps/user-level', 'view', '2020-11-02 10:44:31'),
(21, 2, 'app-backend-webapps/user-level', 'index', '2020-11-02 10:44:38'),
(22, 2, 'app-backend-webapps/user-level', 'update', '2020-11-02 10:44:45'),
(23, 2, 'app-backend-webapps/user-level', 'update', '2020-11-02 10:44:55'),
(24, 2, 'app-backend-webapps/user-level', 'view', '2020-11-02 10:44:55'),
(25, 2, 'app-backend-webapps/user-level', 'index', '2020-11-02 10:44:59'),
(26, 2, 'app-backend-webapps/user-access', 'control', '2020-11-02 10:45:02'),
(27, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-02 10:45:09'),
(28, 2, 'app-backend-webapps/user', 'index', '2020-11-02 10:45:33'),
(29, 2, 'app-backend-webapps/user', 'update', '2020-11-02 10:45:53'),
(30, 2, 'app-backend-webapps/user', 'update', '2020-11-02 10:46:53'),
(31, 2, 'app-backend-webapps/user', 'view', '2020-11-02 10:46:55'),
(32, 2, 'app-backend-webapps/user', 'index', '2020-11-02 10:47:01'),
(33, 2, 'app-backend-webapps/user', 'update', '2020-11-02 10:47:16'),
(34, 2, 'app-backend-webapps/user', 'update', '2020-11-02 10:48:17'),
(35, 2, 'app-backend-webapps/user', 'view', '2020-11-02 10:48:19'),
(36, 2, 'app-backend-webapps/user', 'index', '2020-11-02 10:48:23'),
(37, 2, 'app-backend-webapps/user', 'update', '2020-11-02 10:48:33'),
(38, 2, 'app-backend-webapps/user', 'update', '2020-11-02 10:48:59'),
(39, 2, 'app-backend-webapps/user', 'view', '2020-11-02 10:49:00'),
(40, 2, 'app-backend-webapps/user', 'index', '2020-11-02 10:49:07'),
(41, 2, 'app-backend-webapps/user-access', 'control', '2020-11-02 10:49:12'),
(42, 2, 'app-backend-webapps/user-level', 'index', '2020-11-02 10:49:30'),
(43, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-02 10:49:34'),
(44, 2, 'app-backend-webapps/user', 'index', '2020-11-02 10:56:41'),
(45, 2, 'app-backend-webapps/user-access', 'control', '2020-11-02 10:56:43'),
(46, 2, 'app-backend-webapps/user-level', 'index', '2020-11-02 10:56:46'),
(47, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-02 10:56:51'),
(48, 2, 'app-backend-webapps/app-log', 'index', '2020-11-02 10:56:56'),
(49, 2, 'app-backend-webapps/app-logd', 'index', '2020-11-02 10:56:59'),
(50, 2, 'app-backend-webapps/user', 'index', '2020-11-03 03:37:04'),
(51, 2, 'app-backend-webapps/user-access', 'control', '2020-11-03 03:37:08'),
(52, 2, 'app-backend-webapps/user-level', 'index', '2020-11-03 03:37:31'),
(53, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 03:37:34'),
(54, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 03:37:40'),
(55, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 03:40:11'),
(56, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 03:43:58'),
(57, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 03:44:00'),
(58, 2, 'app-backend-webapps/user', 'index', '2020-11-03 05:04:41'),
(59, 2, 'app-backend-webapps/user', 'view', '2020-11-03 05:04:47'),
(60, 2, 'app-backend-webapps/user', 'index', '2020-11-03 05:04:57'),
(61, 2, 'app-backend-webapps/user-access', 'control', '2020-11-03 05:05:03'),
(62, 2, 'app-backend-webapps/user-access', 'control', '2020-11-03 05:05:12'),
(63, 2, 'app-backend-webapps/user-access', 'control', '2020-11-03 05:05:27'),
(64, 2, 'app-backend-webapps/user-level', 'index', '2020-11-03 05:05:38'),
(65, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:05:41'),
(66, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 05:05:57'),
(67, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:12:56'),
(68, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:13:05'),
(69, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:13:15'),
(70, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 05:14:42'),
(71, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:15:04'),
(72, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 05:16:12'),
(73, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 05:17:07'),
(74, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 05:17:07'),
(75, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 05:17:22'),
(76, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 05:19:07'),
(77, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 05:19:07'),
(78, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:19:52'),
(79, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 05:20:07'),
(80, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 05:24:20'),
(81, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 05:24:20'),
(82, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:24:30'),
(83, 2, 'app-backend-webapps/user', 'index', '2020-11-03 05:25:47'),
(84, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:26:13'),
(85, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 05:27:01'),
(86, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 05:28:07'),
(87, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 05:28:08'),
(88, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 05:28:28'),
(89, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 05:28:44'),
(90, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 05:28:44'),
(91, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:29:25'),
(92, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:29:30'),
(93, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:29:31'),
(94, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 05:29:31'),
(95, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 05:37:53'),
(96, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:04:46'),
(97, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:04:47'),
(98, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:04:59'),
(99, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:05:07'),
(100, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:06:20'),
(101, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:06:53'),
(102, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:07:12'),
(103, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:07:12'),
(104, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:07:30'),
(105, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 06:07:33'),
(106, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 06:08:03'),
(107, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:08:03'),
(108, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:08:09'),
(109, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 06:08:12'),
(110, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 06:09:30'),
(111, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:09:30'),
(112, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:09:57'),
(113, 2, 'app-backend-webapps/user', 'index', '2020-11-03 06:10:50'),
(114, 2, 'app-backend-webapps/user-level', 'index', '2020-11-03 06:10:58'),
(115, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:11:20'),
(116, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:11:39'),
(117, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:11:45'),
(118, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:12:00'),
(119, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:12:01'),
(120, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:12:36'),
(121, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:12:49'),
(122, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:12:49'),
(123, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:13:09'),
(124, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:13:18'),
(125, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:13:19'),
(126, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:13:25'),
(127, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:13:45'),
(128, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:13:51'),
(129, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:13:57'),
(130, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:14:04'),
(131, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:14:25'),
(132, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:14:35'),
(133, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:14:36'),
(134, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:14:52'),
(135, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:14:56'),
(136, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:15:06'),
(137, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:15:10'),
(138, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:15:20'),
(139, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:16:21'),
(140, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:16:21'),
(141, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:17:30'),
(142, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:17:48'),
(143, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:19:45'),
(144, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:20:19'),
(145, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:20:25'),
(146, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:20:30'),
(147, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:21:14'),
(148, 2, 'app-backend-webapps/system', 'info', '2020-11-03 06:21:32'),
(149, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:26:52'),
(150, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 06:27:12'),
(151, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:27:17'),
(152, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:27:22'),
(153, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:27:55'),
(154, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:28:08'),
(155, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:28:08'),
(156, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:29:29'),
(157, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:29:34'),
(158, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:29:38'),
(159, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:29:49'),
(160, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:29:49'),
(161, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:30:16'),
(162, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:30:23'),
(163, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:30:42'),
(164, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:30:59'),
(165, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:30:59'),
(166, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:49:08'),
(167, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:49:15'),
(168, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:49:22'),
(169, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:49:22'),
(170, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:49:30'),
(171, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:50:02'),
(172, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:50:02'),
(173, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:50:29'),
(174, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:50:33'),
(175, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:50:38'),
(176, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:50:56'),
(177, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:50:56'),
(178, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 06:51:04'),
(179, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:51:12'),
(180, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 06:51:21'),
(181, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 06:51:21'),
(182, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 07:41:29'),
(183, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 07:41:33'),
(184, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 07:44:19'),
(185, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 07:44:19'),
(186, 2, 'app-backend-webapps/user', 'index', '2020-11-03 07:44:36'),
(187, 2, 'app-backend-webapps/user-access', 'control', '2020-11-03 07:44:38'),
(188, 2, 'app-backend-webapps/user-level', 'index', '2020-11-03 07:44:41'),
(189, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 07:44:42'),
(190, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 07:45:58'),
(191, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 07:47:18'),
(192, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 07:47:19'),
(193, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 07:49:54'),
(194, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 07:49:56'),
(195, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 07:51:41'),
(196, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 07:51:41'),
(197, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 07:53:11'),
(198, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 07:53:15'),
(199, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 07:55:01'),
(200, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 07:55:02'),
(201, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 07:55:15'),
(202, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 07:55:34'),
(203, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 07:55:34'),
(204, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 07:57:37'),
(205, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 07:57:42'),
(206, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 07:59:47'),
(207, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 07:59:47'),
(208, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:01:31'),
(209, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:01:33'),
(210, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:06:29'),
(211, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:06:29'),
(212, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:06:46'),
(213, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:07:03'),
(214, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:07:10'),
(215, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:07:45'),
(216, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:07:45'),
(217, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:07:55'),
(218, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:08:00'),
(219, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:08:05'),
(220, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:09:57'),
(221, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:09:57'),
(222, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:10:21'),
(223, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:10:24'),
(224, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:10:34'),
(225, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:10:54'),
(226, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:10:54'),
(227, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:11:15'),
(228, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:11:19'),
(229, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:11:26'),
(230, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:11:49'),
(231, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:11:50'),
(232, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:14:57'),
(233, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:15:06'),
(234, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:15:37'),
(235, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:16:04'),
(236, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:16:04'),
(237, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:16:12'),
(238, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:16:17'),
(239, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:16:26'),
(240, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:16:53'),
(241, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:16:53'),
(242, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:17:24'),
(243, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:19:11'),
(244, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:19:18'),
(245, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:19:32'),
(246, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:19:33'),
(247, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:20:11'),
(248, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:23:07'),
(249, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:23:10'),
(250, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:25:03'),
(251, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:25:06'),
(252, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:25:11'),
(253, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:25:52'),
(254, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:25:52'),
(255, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:26:00'),
(256, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:26:04'),
(257, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:26:10'),
(258, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:26:30'),
(259, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:26:30'),
(260, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:26:38'),
(261, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:26:41'),
(262, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:26:48'),
(263, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:27:08'),
(264, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:27:09'),
(265, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:30:55'),
(266, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:31:17'),
(267, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:32:08'),
(268, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:32:08'),
(269, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:33:50'),
(270, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:33:52'),
(271, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:34:03'),
(272, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:34:49'),
(273, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:34:50'),
(274, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:35:23'),
(275, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:35:27'),
(276, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:35:32'),
(277, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:35:57'),
(278, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:35:57'),
(279, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:36:17'),
(280, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:36:20'),
(281, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:37:21'),
(282, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:37:21'),
(283, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:37:49'),
(284, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:37:55'),
(285, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:37:58'),
(286, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:38:37'),
(287, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:38:56'),
(288, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:38:57'),
(289, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:39:06'),
(290, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:39:09'),
(291, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:39:17'),
(292, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:39:34'),
(293, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:39:35'),
(294, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:40:03'),
(295, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:40:09'),
(296, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:40:15'),
(297, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:40:29'),
(298, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:40:30'),
(299, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:40:39'),
(300, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:40:49'),
(301, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:40:50'),
(302, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:40:55'),
(303, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:40:58'),
(304, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:41:05'),
(305, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:41:15'),
(306, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:41:15'),
(307, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:41:24'),
(308, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:41:27'),
(309, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:41:33'),
(310, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:41:49'),
(311, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:41:50'),
(312, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:42:02'),
(313, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:42:21'),
(314, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:42:24'),
(315, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:42:30'),
(316, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:43:08'),
(317, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:43:08'),
(318, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:43:12'),
(319, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:43:24'),
(320, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:43:24'),
(321, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:43:32'),
(322, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:43:35'),
(323, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:43:41'),
(324, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:43:52'),
(325, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:43:52'),
(326, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:44:00'),
(327, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:44:05'),
(328, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:44:29'),
(329, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:44:48'),
(330, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:44:48'),
(331, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:45:00'),
(332, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:45:27'),
(333, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:45:27'),
(334, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:45:32'),
(335, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:46:08'),
(336, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:46:10'),
(337, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:46:43'),
(338, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:46:43'),
(339, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:46:51'),
(340, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:46:54'),
(341, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:47:28'),
(342, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:47:29'),
(343, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:47:42'),
(344, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:47:45'),
(345, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:47:49'),
(346, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:48:03'),
(347, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:48:03'),
(348, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:48:55'),
(349, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:48:58'),
(350, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:49:28'),
(351, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:49:29'),
(352, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:49:38'),
(353, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:49:40'),
(354, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:50:14'),
(355, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:50:15'),
(356, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:50:22'),
(357, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:50:27'),
(358, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:50:33'),
(359, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:51:00'),
(360, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:51:00'),
(361, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:51:25'),
(362, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:51:28'),
(363, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:51:36'),
(364, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:51:56'),
(365, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:51:56'),
(366, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:52:06'),
(367, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:52:09'),
(368, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:52:13'),
(369, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:52:29'),
(370, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:52:29'),
(371, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:52:43'),
(372, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:52:45'),
(373, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:52:52'),
(374, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:53:11'),
(375, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:53:12'),
(376, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:53:33'),
(377, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:53:36'),
(378, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:53:48'),
(379, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:54:09'),
(380, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:54:10'),
(381, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:54:19'),
(382, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:54:22'),
(383, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:54:29'),
(384, 2, 'app-backend-webapps/user-menu', 'update', '2020-11-03 08:54:42'),
(385, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:54:42'),
(386, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:54:59'),
(387, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:55:07'),
(388, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:55:57'),
(389, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:55:58'),
(390, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:58:19'),
(391, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:58:21'),
(392, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:58:49'),
(393, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 08:58:49'),
(394, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 08:58:57'),
(395, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 08:59:01'),
(396, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 09:00:01'),
(397, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 09:00:01'),
(398, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 09:00:29'),
(399, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 09:00:31'),
(400, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 09:01:11'),
(401, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 09:01:11'),
(402, 2, 'app-backend-webapps/user-menu', 'index', '2020-11-03 09:01:23'),
(403, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 09:05:52'),
(404, 2, 'app-backend-webapps/user-menu', 'create', '2020-11-03 09:06:24'),
(405, 2, 'app-backend-webapps/user-menu', 'view', '2020-11-03 09:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `app_logd`
--

CREATE TABLE `app_logd` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `table_name` varchar(50) DEFAULT NULL,
  `update` longtext DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_logd`
--

INSERT INTO `app_logd` (`id`, `id_user`, `table_name`, `update`, `timestamp`) VALUES
(1, 2, 'user/update', '{\"username\":\"pimpinan\",\"password\":\"muhammadiyah\",\"password_repeat\":\"muhammadiyah\",\"email\":\"pimpinan@muhammadiyah.com\",\"name\":\"Pimpinan Muhammadiyah\",\"level\":\"b640b97d668bf53c0dbc50a8f17871ef\",\"status\":\"10\",\"image\":\"\"}', '2020-11-02 10:46:55'),
(2, 2, 'user/update', '{\"username\":\"staff\",\"password\":\"muhammadiyah\",\"password_repeat\":\"muhammadiyah\",\"email\":\"staff@muhammadiyah.com\",\"name\":\"Staff Administrasi Muhammadiyah\",\"level\":\"8e2ef94cad245adb8089356242f49e55\",\"status\":\"10\",\"image\":\"\"}', '2020-11-02 10:48:19'),
(3, 2, 'user/update', '{\"username\":\"admin\",\"password\":\"muhammadiyah\",\"password_repeat\":\"muhammadiyah\",\"email\":\"admin@muhammadiyah.com\",\"name\":\"Super Admin Muhammadiyah\",\"level\":\"6fb4f22992a0d164b77267fde5477248\",\"status\":\"10\",\"image\":\"\"}', '2020-11-02 10:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1582665882),
('m130524_201442_init', 1582665886),
('m190124_110200_add_verification_token_column_to_user_table', 1582665887);

-- --------------------------------------------------------

--
-- Table structure for table `mp_grade`
--

CREATE TABLE `mp_grade` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL DEFAULT '',
  `id_level_b` tinyint(2) NOT NULL DEFAULT 0 COMMENT 'Kelas Sebelumnya',
  `id_level` tinyint(2) NOT NULL DEFAULT 0,
  `id_year` int(11) NOT NULL DEFAULT 0 COMMENT 'Tahun Ajaran',
  `status` enum('LULUS','TIDAK LULUS') NOT NULL DEFAULT 'LULUS',
  `date` date NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mp_grade`
--

INSERT INTO `mp_grade` (`id`, `nis`, `id_level_b`, `id_level`, `id_year`, `status`, `date`, `id_user`, `timestamp`) VALUES
(1, '12345', 1, 1, 1, 'TIDAK LULUS', '2020-11-01', 0, '2020-11-02 08:43:06'),
(2, '12345', 1, 2, 1, 'LULUS', '2021-11-02', 0, '2020-11-02 08:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `mp_level`
--

CREATE TABLE `mp_level` (
  `kelas` tinyint(2) NOT NULL,
  `kelas_c` char(50) NOT NULL,
  `nama` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mp_level`
--

INSERT INTO `mp_level` (`kelas`, `kelas_c`, `nama`) VALUES
(1, 'SATU', 'SD'),
(2, 'DUA', 'SD'),
(3, 'TIGA', 'SD'),
(4, 'EMPAT', 'SD'),
(5, 'LIMA', 'SD'),
(6, 'ENAM', 'SD'),
(7, 'TUJUH', 'SMP'),
(8, 'DELAPAN', 'SMP'),
(9, 'SEMBILAN', 'SMP'),
(10, 'SEPULUH', 'SMA'),
(11, 'SEBELAS', 'SMA'),
(12, 'DUA BELAS', 'SMA');

-- --------------------------------------------------------

--
-- Table structure for table `mp_pay`
--

CREATE TABLE `mp_pay` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mp_pay`
--

INSERT INTO `mp_pay` (`id`, `name`, `description`) VALUES
(1, 'SPP', 'Sumbangan Pembinaan Pendidikan'),
(2, 'USP', 'Uang Sumbangan Pendidikan'),
(3, 'DISKON 1', 'Diskon Tahun Ajaran');

-- --------------------------------------------------------

--
-- Table structure for table `mp_pay_list`
--

CREATE TABLE `mp_pay_list` (
  `id` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL DEFAULT 0,
  `id_jenjang` tinyint(2) NOT NULL DEFAULT 0,
  `id_pay` int(11) NOT NULL,
  `type` enum('CREDIT','CASH','DISCOUNT') NOT NULL DEFAULT 'CASH' COMMENT 'CREDIT (+); CASH (+), DISCOUNT (-)',
  `nominal` bigint(20) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mp_pay_list`
--

INSERT INTO `mp_pay_list` (`id`, `id_tahun`, `id_jenjang`, `id_pay`, `type`, `nominal`, `id_user`, `timestamp`) VALUES
(1, 1, 1, 1, '', 500000, 0, '2020-11-02 06:57:23'),
(2, 1, 1, 2, '', 200000, 0, '2020-11-02 06:57:23'),
(3, 1, 1, 3, '', 100000, 0, '2020-11-02 06:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `mp_pay_register`
--

CREATE TABLE `mp_pay_register` (
  `id` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL DEFAULT 0,
  `id_jenjang` tinyint(2) NOT NULL DEFAULT 0,
  `id_pay` int(11) NOT NULL,
  `type` enum('CREDIT','CASH','DISCOUNT') NOT NULL DEFAULT 'CASH' COMMENT 'CREDIT (+); CASH (+), DISCOUNT (-)',
  `nominal` bigint(20) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mp_pay_register`
--

INSERT INTO `mp_pay_register` (`id`, `id_tahun`, `id_jenjang`, `id_pay`, `type`, `nominal`, `id_user`, `timestamp`) VALUES
(5, 1, 1, 1, 'CASH', 500000, 0, '2020-11-02 09:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `mp_pay_remission`
--

CREATE TABLE `mp_pay_remission` (
  `id` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL DEFAULT 0,
  `id_jenjang` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `nis` varchar(50) NOT NULL,
  `nominal` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mp_pay_remission`
--

INSERT INTO `mp_pay_remission` (`id`, `id_tahun`, `id_jenjang`, `name`, `nis`, `nominal`) VALUES
(1, 1, 1, 'KERINGANAN BIAYA MASUK', '12345', 100000),
(2, 1, 1, 'DANA BOS', '12345', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `mp_pay_transact`
--

CREATE TABLE `mp_pay_transact` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL,
  `id_tahun` int(11) NOT NULL COMMENT 'Filter',
  `id_jenjang` int(11) NOT NULL COMMENT 'Filter',
  `id_pay` int(11) NOT NULL COMMENT 'Filter',
  `id_paylist` int(11) NOT NULL,
  `type` enum('CASH','DEBIT') NOT NULL DEFAULT 'CASH' COMMENT 'CASH; DEBIT',
  `name` varchar(50) NOT NULL,
  `nominal` bigint(20) NOT NULL DEFAULT 0,
  `id_user` bigint(20) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mp_pay_transact`
--

INSERT INTO `mp_pay_transact` (`id`, `nis`, `datetime`, `id_tahun`, `id_jenjang`, `id_pay`, `id_paylist`, `type`, `name`, `nominal`, `id_user`, `timestamp`) VALUES
(1, '12345', '2020-11-02 11:00:27', 0, 0, 0, 1, '', 'spp 1', 200000, 0, '2020-11-02 07:26:18'),
(2, '12345', '2020-11-02 11:00:27', 0, 0, 0, 1, '', 'spp 2', 200000, 0, '2020-11-02 07:26:21'),
(3, '12345', '2020-11-02 11:00:27', 0, 0, 0, 2, '', 'usp', 200000, 0, '2020-11-02 07:26:28'),
(4, '12345', '2020-11-02 11:00:27', 0, 0, 0, 1, '', 'spp 3', 100000, 0, '2020-11-02 07:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `mp_student`
--

CREATE TABLE `mp_student` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL COMMENT 'Nomor Induk Siswa',
  `type` enum('REGISTER','STUDENT') NOT NULL DEFAULT 'STUDENT',
  `full_name` varchar(50) NOT NULL,
  `nick_name` varchar(50) NOT NULL,
  `gender` enum('L','P') NOT NULL DEFAULT 'L',
  `pob` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `religion` enum('Islam','Kristen','Hindu','Budha') NOT NULL,
  `orphan` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `handphone` varchar(50) NOT NULL,
  `live` varchar(50) NOT NULL,
  `school_origin` varchar(50) NOT NULL,
  `other_information` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mp_student`
--

INSERT INTO `mp_student` (`id`, `nis`, `type`, `full_name`, `nick_name`, `gender`, `pob`, `dob`, `religion`, `orphan`, `address`, `handphone`, `live`, `school_origin`, `other_information`) VALUES
(1, '11111', 'REGISTER', '', '', '', '', NULL, '', '', '', '', '', '', ''),
(2, '12345', 'STUDENT', '', '', '', '', NULL, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mp_teacher`
--

CREATE TABLE `mp_teacher` (
  `nip` varchar(50) NOT NULL COMMENT 'Nomor Induk Pegawai',
  `name` varchar(50) NOT NULL,
  `pob` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `doe` date NOT NULL,
  `married_status` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `education` int(11) NOT NULL,
  `payroll` int(11) NOT NULL,
  `teacher_status` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `handphone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mp_year`
--

CREATE TABLE `mp_year` (
  `id` int(11) NOT NULL,
  `semester` enum('GENAP','GANJIL') NOT NULL DEFAULT 'GENAP',
  `nama` char(50) NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mp_year`
--

INSERT INTO `mp_year` (`id`, `semester`, `nama`, `awal`, `akhir`) VALUES
(1, 'GENAP', '2020', '0000-00-00', '0000-00-00'),
(2, 'GANJIL', '2020', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `name`, `image`, `level`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'root', '0AwqpjBTwa9AAv2dih8TPqyZqfuhyla8', '$2y$13$nAKuTfVbllxviIwOczggg.QC2Wove1rZ06LKt3v26Uv6n9As6JuKC', NULL, 'root@root.com', 'The Root', '/images/upload/user/root.jpg', '6fb4f22992a0d164b77267fde5477248', 10, 1582829438, 1586125515, 'aFPU-cKNQjyh2bkekFVImt2RbVI4A_Vy_1582666196'),
(2, 'admin', '1qv6IKOkGmIvR8_12kg2ksugIgYMEkHH', '$2y$13$yknfHNkCtdWaow8sjZ1lqeO6.rDWeqrXcw0ZmuAUdIGFiNR4Sg8TO', NULL, 'admin@muhammadiyah.com', 'Super Admin Muhammadiyah', '/images/upload/user/admin.jpg', '6fb4f22992a0d164b77267fde5477248', 10, 1582829973, 1604314139, NULL),
(3, 'pimpinan', 'nAG5c4wKTslLBjFFM7hJQhLYxBYEf4wP', '$2y$13$.9J.SMPKpeLQ.cG0BikP..zVUo.2tpRdLChkUKyBWovSiXrdCeI5y', NULL, 'pimpinan@muhammadiyah.com', 'Pimpinan Muhammadiyah', '/images/upload/user/user.jpg', 'b640b97d668bf53c0dbc50a8f17871ef', 10, 1582830712, 1604314014, NULL),
(4, 'staff', 'GOpNILaG2QhcXFLcbmwIXCI6k_FPO1z7', '$2y$13$u5v1LCFJtoTplVl1OV1cB.aiWYj08jbxX0kihFj4F/M/8cScvobQK', NULL, 'staff@muhammadiyah.com', 'Staff Administrasi Muhammadiyah', '/images/upload/user/menu.jpg', '8e2ef94cad245adb8089356242f49e55', 10, 1598935611, 1604314097, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(11) NOT NULL,
  `level` char(32) NOT NULL,
  `module` varchar(20) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `action` text NOT NULL,
  `id_stamp` int(11) NOT NULL DEFAULT 0,
  `datestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `level`, `module`, `controller`, `action`, `id_stamp`, `datestamp`, `timestamp`) VALUES
(1, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'user-access', '{\"control\":true,\"cekidot\":true}', 1, '2020-02-26 13:00:06', '2020-02-27 19:27:33'),
(2, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'user-level', '{\"index\":true,\"view\":true,\"create\":true,\"update\":true,\"delete\":true}', 2, '2020-02-26 13:00:06', '2020-09-02 07:17:23'),
(3, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'user', '{\"index\":true,\"view\":true,\"create\":true,\"update\":true,\"delete\":true}', 2, '2020-02-26 13:00:06', '2020-09-02 07:17:23'),
(4, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'site', '{\"index\":true,\"login\":true,\"logout\":true}', 2, '2020-02-26 13:00:06', '2020-09-02 07:17:23'),
(5, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'system', '{\"info\":true}', 2, '2020-02-27 02:10:36', '2020-09-02 07:19:14'),
(6, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'app-log', '{\"index\":true,\"view\":true}', 2, '2020-02-28 03:39:30', '2020-09-02 07:17:23'),
(7, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'app-logd', '{\"index\":true,\"view\":true}', 2, '2020-02-28 03:39:30', '2020-09-02 07:17:23'),
(8, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'user-menu', '{\"index\":true,\"view\":true,\"create\":true,\"update\":true,\"delete\":true}', 2, '2020-09-02 14:31:55', '2020-09-02 07:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `code` char(10) NOT NULL,
  `name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`code`, `name`) VALUES
('ADM', 'ADMIN'),
('PMPN', 'PIMPINAN'),
('STAFF', 'STAFF');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL COMMENT 'Menu',
  `id_sub` int(11) NOT NULL DEFAULT 0 COMMENT 'Submenu Level 1',
  `id_sub2` int(11) NOT NULL DEFAULT 0 COMMENT 'Submenu Level 2',
  `level` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `class` enum('H','D','S','L') NOT NULL DEFAULT 'L',
  `url_controller` varchar(50) DEFAULT NULL,
  `url_view` varchar(50) DEFAULT NULL,
  `url_parameter` varchar(50) DEFAULT NULL COMMENT 'param1=value1,param2=value2',
  `seq` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `id_sub`, `id_sub2`, `level`, `module`, `class`, `url_controller`, `url_view`, `url_parameter`, `seq`, `icon`, `name`) VALUES
(1, 0, 0, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'L', 'site', 'index', '', 1, 'fa fa-file', 'Link'),
(2, 0, 0, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'D', '', '', '', 2, '', 'Divider'),
(3, 0, 0, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'H', '', '', '', 3, '', 'Header'),
(4, 0, 0, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'S', '', '', '', 4, 'fa fa-file', 'Submenu Level_2'),
(5, 4, 0, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'L', 'site', 'index', '', 5, 'fa fa-file', 'Menu Level_2 A'),
(6, 4, 0, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'D', '', '', '', 6, '', 'Divider Submenu Level_2'),
(7, 4, 0, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'L', 'site', 'index', '', 7, '', 'Menu Level_2 C'),
(8, 4, 0, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'S', 'site', 'index', '', 8, 'fa fa-file', 'Submenu Level_3'),
(9, 4, 8, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'L', 'site', 'index', '', 9, 'fa fa-file', 'Menu Level_3 A'),
(10, 4, 8, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'D', '', '', '', 10, '', 'Divider Submenu Level_3'),
(11, 4, 8, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'L', 'site', 'index', '', 11, 'fa fa-file', 'Menu Level_3 C'),
(12, 4, 0, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'H', '', '', '', 6, '', 'Header Submenu Level_2'),
(13, 4, 8, '3ed53fbeb1eab0443561b68ca0c0b5cf', 'app-backend-webapps', 'H', '', '', '', 10, '', 'Header Submenu Level_3'),
(14, 0, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'S', '', '', '', 0, 'fa fa-user-check', 'User'),
(15, 14, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'user', 'index', '', 1, 'fa fa-user', 'User'),
(16, 14, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'user-access', 'control', '', 2, 'fa fa-user-lock', 'User Access'),
(17, 14, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'user-level', 'index', '', 3, 'fa fa-user-shield', 'User Level'),
(18, 14, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'user-menu', 'index', '', 4, 'fa fa-user-check', 'User Menu'),
(21, 0, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'S', '', '', '', 5, 'fa fa-desktop', 'Apps'),
(22, 21, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'app-log', 'index', '', 1, 'fa fa-cog', 'Log'),
(23, 21, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'app-logd', 'index', '', 2, 'fa fa-cogs', 'Log Database'),
(24, 0, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'D', '', '', '', 8, '', ''),
(25, 0, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'system', 'info', '', 10, 'fa fa-info', 'System Info'),
(26, 0, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'S', '', '', '', 1, 'fa fa-book', 'Administration'),
(27, 26, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'mp-student', 'index', '', 2, 'fa fa-user-graduate', 'Data Siswa'),
(28, 0, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'S', '', '', '', 4, 'fa fa-database', 'Data Master'),
(29, 0, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'S', '', '', '', 2, 'fa fa-exchange-alt', 'Transaction'),
(30, 0, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'S', '', '', '', 3, 'fa fa-chart-line', 'Report'),
(31, 26, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'mp-teacher', 'index', '', 1, 'fa fa-graduation-cap', 'Data Guru'),
(32, 29, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'mp-pay-register', 'index', '', 1, 'fa fa-book', 'Uang Registrasi'),
(33, 29, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'mp-pay-remission', 'index', '', 3, 'fab fa-accessible-icon', 'Keringanan Siswa'),
(34, 29, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'mp-pay-transact', 'index', '', 2, 'fab fa-cc-mastercard', 'Pembayaran Siswa'),
(35, 28, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'mp-level', 'index', '', 2, 'fa fa-level-up-alt', 'Tingkat Kelas'),
(36, 26, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'mp-grade', 'index', '', 3, 'fa fa-long-arrow-alt-up', 'Kenaikan Kelas'),
(37, 28, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'mp-pay', 'index', '', 1, 'fa fa-money-bill', 'Tipe Pembayaran'),
(38, 28, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', 'mp-year', 'index', '', 3, 'fa fa-calendar-times', 'Tahun Ajaran'),
(39, 30, 41, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', '', '', '', 1, 'fa fa-file', 'Data Siswa'),
(40, 30, 41, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', '', '', '', 2, 'fa fa-file-alt', 'Data Guru'),
(41, 30, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'S', '', '', '', 1, 'fa fa-file', 'Administrasi'),
(42, 30, 0, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'S', '', '', '', 2, 'fa fa-file-alt', 'Keuangan'),
(43, 30, 42, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', '', '', '', 1, 'fa fa-money-bill', 'Pembayaran Harian'),
(44, 30, 42, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', '', '', '', 2, 'fa fa-money-bill', 'Pembayaran Peritem'),
(45, 30, 42, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', '', '', '', 3, 'fa fa-money-bill', 'Pembayaran Persiswa'),
(46, 30, 42, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', '', '', '', 4, 'fa fa-money-bill', 'Pembayaran Perbulan'),
(47, 30, 42, '6fb4f22992a0d164b77267fde5477248', 'app-backend-webapps', 'L', '', '', '', 5, 'fa fa-money-bill', 'Kwitansi Pembayaran');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_log`
--
ALTER TABLE `app_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_logd`
--
ALTER TABLE `app_logd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mp_grade`
--
ALTER TABLE `mp_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp_level`
--
ALTER TABLE `mp_level`
  ADD PRIMARY KEY (`kelas`);

--
-- Indexes for table `mp_pay`
--
ALTER TABLE `mp_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp_pay_list`
--
ALTER TABLE `mp_pay_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp_pay_register`
--
ALTER TABLE `mp_pay_register`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `mp_pay_remission`
--
ALTER TABLE `mp_pay_remission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp_pay_transact`
--
ALTER TABLE `mp_pay_transact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp_student`
--
ALTER TABLE `mp_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `mp_teacher`
--
ALTER TABLE `mp_teacher`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `mp_year`
--
ALTER TABLE `mp_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_log`
--
ALTER TABLE `app_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;

--
-- AUTO_INCREMENT for table `app_logd`
--
ALTER TABLE `app_logd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mp_grade`
--
ALTER TABLE `mp_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mp_pay`
--
ALTER TABLE `mp_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mp_pay_list`
--
ALTER TABLE `mp_pay_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mp_pay_register`
--
ALTER TABLE `mp_pay_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mp_pay_remission`
--
ALTER TABLE `mp_pay_remission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mp_pay_transact`
--
ALTER TABLE `mp_pay_transact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mp_student`
--
ALTER TABLE `mp_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mp_year`
--
ALTER TABLE `mp_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Menu', AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
