-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2021 at 05:07 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `superordersys`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `time_sent` datetime DEFAULT NULL,
  `time_read` datetime DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `from`, `to`, `time_sent`, `time_read`, `status`, `message`, `order_id`, `created_at`, `updated_at`) VALUES
(48, 14, 1, NULL, NULL, 'unread', 'hello support', 0, '2021-06-22 08:48:48', '2021-06-22 08:48:48'),
(49, 1, 14, NULL, NULL, 'unread', 'hello customer-12677', 0, '2021-06-22 08:49:18', '2021-06-22 08:49:18'),
(50, 14, 1, NULL, NULL, 'unread', 'Am good, thanks.', 0, '2021-06-23 02:35:00', '2021-06-23 02:35:00'),
(51, 14, 8, NULL, NULL, 'unread', 'witer 2 hi', 0, '2021-06-23 05:58:48', '2021-06-23 05:58:48'),
(52, 1, 14, NULL, NULL, 'unread', 'test to customer12677', 0, '2021-06-23 05:59:44', '2021-06-23 05:59:44'),
(53, 1, 14, NULL, NULL, 'unread', 'heeey', 0, '2021-06-23 06:16:49', '2021-06-23 06:16:49'),
(54, 3, 21, NULL, NULL, 'unread', 'dssdssd', 0, '2021-06-23 06:24:44', '2021-06-23 06:24:44'),
(55, 3, 14, NULL, NULL, 'unread', 'deeedd', 0, '2021-06-23 06:24:58', '2021-06-23 06:24:58'),
(56, 14, 3, NULL, NULL, 'unread', 'csssds', 0, '2021-06-23 06:25:13', '2021-06-23 06:25:13'),
(57, 3, 14, NULL, NULL, 'unread', 'tree test', 0, '2021-06-23 06:27:24', '2021-06-23 06:27:24'),
(58, 14, 3, NULL, NULL, 'unread', 'test', 0, '2021-06-23 06:27:32', '2021-06-23 06:27:32'),
(59, 3, 14, NULL, NULL, 'unread', 'papa shark', 0, '2021-06-23 06:27:41', '2021-06-23 06:27:41'),
(60, 14, 3, NULL, NULL, 'unread', 'dada shark', 0, '2021-06-23 06:27:52', '2021-06-23 06:27:52'),
(61, 1, 14, NULL, NULL, 'unread', 'deee', 0, '2021-06-23 06:28:03', '2021-06-23 06:28:03'),
(62, 3, 2, NULL, NULL, 'unread', 'dsdsd', 0, '2021-06-23 06:47:21', '2021-06-23 06:47:21'),
(63, 3, 1, NULL, NULL, 'unread', 'sdsds', 0, '2021-06-23 10:51:31', '2021-06-23 10:51:31'),
(64, 1, 2, NULL, NULL, 'unread', 'dsdsddsd', 0, '2021-06-23 11:12:00', '2021-06-23 11:12:00'),
(65, 14, 3, NULL, NULL, 'unread', 'sdsdds', 0, '2021-06-24 05:44:02', '2021-06-24 05:44:02'),
(66, 14, 1, NULL, NULL, 'unread', 'test', 0, '2021-06-24 06:33:25', '2021-06-24 06:33:25'),
(67, 14, 1, NULL, NULL, 'unread', 'ddwdwd', 0, '2021-06-24 06:35:15', '2021-06-24 06:35:15'),
(68, 1, 14, NULL, NULL, 'unread', 'yyii', 0, '2021-06-24 06:40:11', '2021-06-24 06:40:11'),
(69, 14, 1, NULL, NULL, 'unread', 'i', 0, '2021-06-24 06:40:31', '2021-06-24 06:40:31'),
(70, 14, 1, NULL, NULL, 'unread', 'dsdsssdsdsddsds', 0, '2021-06-24 06:47:56', '2021-06-24 06:47:56'),
(71, 1, 14, NULL, NULL, 'unread', 'dsdsdsdsdqdqd55555555555555555', 0, '2021-06-24 06:48:09', '2021-06-24 06:48:09'),
(72, 14, 3, NULL, NULL, 'unread', 'dddd', 0, '2021-06-24 07:01:38', '2021-06-24 07:01:38'),
(73, 14, 3, NULL, NULL, 'unread', 'sdsdsd', 0, '2021-06-25 04:41:55', '2021-06-25 04:41:55'),
(74, 14, 8, NULL, NULL, 'unread', 'ccww', 0, '2021-06-25 05:40:17', '2021-06-25 05:40:17'),
(75, 14, 3, NULL, NULL, 'unread', 'ssss', 0, '2021-08-07 11:02:00', '2021-08-07 11:02:00'),
(76, 1, 14, NULL, NULL, 'unread', 'sdsd', 0, '2021-08-07 11:02:43', '2021-08-07 11:02:43'),
(77, 14, 1, NULL, NULL, 'unread', 'dss', 0, '2021-08-07 11:03:05', '2021-08-07 11:03:05'),
(78, 1, 14, NULL, NULL, 'unread', 'ssd', 0, '2021-08-07 11:03:11', '2021-08-07 11:03:11'),
(79, 14, 1, NULL, NULL, 'unread', '2222', 0, '2021-08-07 11:03:15', '2021-08-07 11:03:15'),
(80, 1, 14, NULL, NULL, 'unread', 'ddwdwdwdw', 0, '2021-08-07 11:03:20', '2021-08-07 11:03:20'),
(81, 14, 1, NULL, NULL, 'unread', 'eeeeee', 0, '2021-08-07 12:01:07', '2021-08-07 12:01:07'),
(82, 14, 1, NULL, NULL, 'unread', 'hello', 0, '2021-08-10 11:58:07', '2021-08-10 11:58:07'),
(83, 1, 14, NULL, NULL, 'unread', 'test', 0, '2021-08-10 11:58:13', '2021-08-10 11:58:13'),
(84, 14, 3, NULL, NULL, 'unread', 'dsdwdwd', 0, '2021-08-10 12:00:56', '2021-08-10 12:00:56'),
(85, 14, 8, NULL, NULL, 'unread', 'ddssd', 0, '2021-08-10 12:01:23', '2021-08-10 12:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2020_11_04_075101_update_users_add_url_prefix', 2),
(8, '2020_11_13_180343_update_users_table_add_login_session_and_site_id', 3),
(9, '2020_11_10_063621_create_orders_table', 4),
(10, '2020_11_16_083908_create_writers_table', 5),
(11, '2020_12_15_063616_update_writers_table_add_fields', 6),
(12, '2021_03_21_091414_order_files', 7),
(13, '2021_03_26_073353_update_orders_table_add_fields', 8),
(14, '2021_04_17_085601_create_transactions_table', 9),
(15, '2021_04_17_090139_update_orders_table_add_payment_status', 10),
(16, '2021_04_17_193457_create_notifications_table', 11),
(17, '2021_06_01_194352_create_chat_messages_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `paper_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Writer choice',
  `academic_level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pages` int(11) NOT NULL,
  `service` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `citation_style` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_citations` int(11) NOT NULL,
  `paper_instructions` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer_pick` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `writer_quality` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` datetime NOT NULL,
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `assigned_to` int(11) DEFAULT NULL,
  `dispute_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `discount_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dicount_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `progressive_delivery` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `vip_support` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `page_abstract` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `essay_outline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `customer_id`, `paper_type`, `subject`, `topic`, `academic_level`, `pages`, `service`, `citation_style`, `no_of_citations`, `paper_instructions`, `writer_pick`, `writer_quality`, `deadline`, `time_zone`, `status`, `assigned_to`, `dispute_reason`, `order_price`, `amount_paid`, `payment_status`, `discount_code`, `dicount_amt`, `created_at`, `updated_at`, `progressive_delivery`, `vip_support`, `page_abstract`, `essay_outline`) VALUES
(2, 1002, 7, 'Essay (Any Type)', 'Other', 'Writers Choice', '', 2, '1', 'Other', 0, NULL, 'client', '', '2020-11-26 07:01:19', 'UTC', 3, 3209, NULL, '28.00', '0.00', 'pending', NULL, '0.00', '2020-11-16 02:01:19', '2020-11-16 02:01:19', 'No', 'No', 'No', 'No'),
(5, 1005, 2, 'Essay (Any Type)', 'International and Public Relations', 'TEST ORDER BY PAFE', 'College', 2, '1', 'Chicago/Turabian', 2, 'sdsddddsds', 'client', '', '2020-12-25 05:27:39', 'UTC', 4, 3209, NULL, '32.00', '0.00', 'pending', NULL, '0.00', '2020-12-15 00:27:39', '2020-12-15 00:27:39', 'No', 'No', 'No', 'No'),
(7, 1007, 1, 'Annotated Bibliography', 'Other', 'TEST ORDER BY PAFE', 'College', 4, '1', 'Harvard', 2, 'TEST ORDER BY PAFE', 'client', '', '2020-03-16 19:50:27', 'UTC', 9, 3209, NULL, '92.00', '0.00', 'pending', NULL, '0.00', '2021-03-12 14:50:28', '2021-03-12 16:10:19', 'No', 'No', 'No', 'No'),
(8, 1008, 1, 'Annotated Bibliography', 'Marketing', 'TEST ORDER TO BE CANCELLED', '', 2, '2', 'Vancouver', 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'system', '', '2020-03-30 17:21:25', 'UTC', -1, 3209, NULL, '44.00', '0.00', 'pending', NULL, '0.00', '2021-03-20 12:21:25', '2021-03-20 12:21:25', 'No', 'No', 'No', 'No'),
(9, 1009, 1, 'Essay (Any Type)', 'International and Public Relations', 'TEST ORDER TO BE CANCELLED', 'College', 4, '2', 'Harvard', 3, 'TEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLEDTEST ORDER TO BE CANCELLED', 'client', NULL, '2020-03-31 09:33:00', 'UTC', 2, 3209, NULL, '91.00', '0.00', 'pending', NULL, '0.00', '2021-03-21 04:33:00', '2021-03-21 04:33:00', 'No', 'No', 'No', 'No'),
(10, 1010, 1, 'Essay (Any Type)', 'Management', 'TEST ORDER BY PAFE', 'Masters', 2, '2', 'Other', 0, 'TEST ORDER BY PAFE', 'client', NULL, '2020-04-03 16:39:47', 'UTC', 3, 3209, NULL, '41.00', '0.00', 'pending', NULL, '0.00', '2021-03-24 11:39:47', '2021-03-24 11:40:45', 'No', 'No', 'No', 'No'),
(11, 1011, 1, 'Essay (Any Type)', 'Other', 'Writers Choice', '', 2, '1', 'Other', 0, NULL, 'system', NULL, '2020-04-04 17:30:25', 'UTC', 0, 3209, NULL, '48.00', '0.00', 'pending', NULL, '0.00', '2021-03-25 12:30:26', '2021-03-25 12:30:26', 'No', 'No', 'No', 'No'),
(15, 1015, 9, 'Application Essay', 'Management', 'TEST ORDER BY PAFE TO BE CANCELLED', 'Undergraduate', 5, '3', 'Harvard', 3, 'TEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLED', 'client', NULL, '2021-04-16 16:43:40', 'UTC', 7, 3209, NULL, '125.88', '0.00', 'pending', NULL, '0.00', '2021-04-15 07:43:40', '2021-04-23 15:06:37', 'Yes', 'Yes', 'Yes', 'No'),
(23, 1016, 14, 'Essay (Any Type)', 'Mathematics', 'TEST ORDER BY PAFE TO BE CANCELLED', 'Undergraduate', 4, '2', 'Harvard', 3, 'TEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLED', 'client', NULL, '2021-05-02 18:51:01', 'UTC', 10, 3209, NULL, '57.00', '0.00', 'pending', NULL, '0.00', '2021-04-22 13:51:01', '2021-04-22 13:51:01', 'No', 'No', 'No', 'No'),
(24, 1017, 14, 'Essay (Any Type)', 'Mathematics', 'TEST ORDER BY PAFE TO BE CANCELLED', 'Undergraduate', 4, '2', 'Harvard', 3, 'TEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLED', 'client', NULL, '2021-05-02 18:53:20', 'UTC', 8, 3209, NULL, '57.00', '0.00', 'pending', NULL, '0.00', '2021-04-22 13:53:20', '2021-04-22 13:53:20', 'No', 'No', 'No', 'No'),
(25, 1018, 14, 'Essay (Any Type)', 'Mathematics', 'TEST ORDER BY PAFE TO BE CANCELLED', 'Undergraduate', 4, '2', 'Harvard', 3, 'TEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLED', 'client', NULL, '2021-05-02 18:53:44', 'UTC', 5, 3209, NULL, '69.99', '0.00', 'pending', NULL, '0.00', '2021-04-22 13:53:44', '2021-04-22 13:55:20', 'No', 'Yes', 'No', 'No'),
(26, 1019, 14, 'Essay (Any Type)', 'Other', 'TEST ORDER BY PAFE TO BE CANCELLED', '', 2, '1', 'Other', 0, 'editPlaceOrdereditPlaceOrdereditPlaceOrdereditPlaceOrdereditPlaceOrder', 'client', NULL, '2021-05-03 21:44:44', 'UTC', 0, 3211, NULL, '0.01', '0.00', 'pending', NULL, '0.00', '2021-04-23 15:08:52', '2021-05-19 06:52:51', 'No', 'No', 'No', 'No'),
(27, 1020, 15, 'Application Essay', 'Literature', 'TEST ORDER BY PAFE', 'Masters', 2, '2', 'Chicago/Turabian', 3, 'use App\\Models\\Writer;\r\nuse App\\Models\\Writer;\r\nuse App\\Models\\Writer;\r\nuse App\\Models\\Writer;', 'system', NULL, '2021-05-07 17:40:51', 'UTC', 7, NULL, NULL, '50.00', '0.00', 'completed', NULL, '0.00', '2021-04-27 12:40:51', '2021-05-12 09:54:36', 'No', 'Yes', 'No', 'No'),
(28, 1021, 18, 'Annotated Bibliography', 'Management', 'TEST ORDER BY PAFE TO BE CANCELLED', 'Undergraduate', 4, '2', 'Other', 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'client', NULL, '2021-05-27 11:21:44', 'UTC', 0, NULL, NULL, '57.00', '0.00', 'pending', NULL, '0.00', '2021-05-17 08:21:44', '2021-05-17 08:21:44', 'No', 'No', 'No', 'No'),
(29, 1022, 18, 'Essay (Any Type)', 'Other', 'TEST ORDER BY PAFE TO BE CANCELLED', '', 2, '1', 'Other', 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'client', NULL, '2021-05-27 11:24:34', 'UTC', 3, 3210, NULL, '38.99', '0.00', 'completed', NULL, '0.00', '2021-05-17 08:23:39', '2021-05-17 08:46:18', 'No', 'Yes', 'No', 'No'),
(30, 1023, 14, 'Annotated Bibliography', 'Environmental Issues', 'TEST ORDER BY PAFE', 'College', 4, '1', 'Chicago/Turabian', 3, 'TEST ORDER BY PAFE', 'client', NULL, '2021-05-29 10:58:40', 'UTC', 0, NULL, NULL, '63.00', '0.00', 'pending', NULL, '0.00', '2021-05-19 08:58:40', '2021-05-19 08:58:40', 'No', 'No', 'No', 'No'),
(31, 1024, 14, 'Essay (Any Type)', 'Other', 'TEST ORDER BY PAFE', '', 2, '1', 'Other', 4, 'TEST ORDER BY PAFE', 'client', NULL, '2021-05-29 11:03:45', 'UTC', 0, 3211, NULL, '28.00', '0.00', 'pending', NULL, '0.00', '2021-05-19 09:02:52', '2021-05-19 09:03:50', 'No', 'No', 'No', 'No'),
(32, 1025, 14, 'Admission Essay', 'Mathematics', 'TEST ORDER BY PAFE TO BE CANCELLED', 'Undergraduate', 4, '1', 'Other', 1, 'TEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLED', 'client', NULL, '2021-05-29 11:04:51', 'UTC', 6, 3211, NULL, '97.98', '0.00', 'pending', NULL, '0.00', '2021-05-19 09:04:51', '2021-05-19 09:57:35', 'Yes', 'Yes', 'No', 'No'),
(33, 1026, 14, 'Application Essay', 'Literature', 'TEST ORDER BY PAFE TO BE CANCELLED', 'Undergraduate', 5, '2', 'Other', 2, 'if($request->hasfile(\'documents\'))\r\n        {\r\n\r\n           foreach($request->file(\'documents\') as $key => $file)\r\n           {\r\n            $allowed = [\'pdf\',\'PDF\',\'csv\',\'docx\',\'xls\',\'xlsx\',\'jpg\',\'jpeg\',\'png\'];\r\n            $ext = $file->getClientOriginalExtension();\r\n            $file_name = $file->getClientOriginalName();\r\n            if(!in_array($ext,$allowed)){\r\n             return response([\'errors\'=>[\'documents\'=>\'Please upload a valid file(pdf,csv,docx,xls,xlsx,jpg,jpeg,png)\']],422);\r\n         }\r\n         $uploaded = FileRepository::move($file);\r\n         if($uploaded[\'uploaded\'] == false){\r\n             return response([\'errors\'=>[\'documents\'=>$uploaded[\'error\']]],422);\r\n         }\r\n\r\n         $document_path = $uploaded[\'path\'];\r\n\r\n         $document = new OrderFile;\r\n         $document->order_code =$order_code;\r\n         $document->user_id =auth()->user()->id;\r\n         $document->user_role =auth()->user()->level;\r\n         $document->file_name = $file_name;\r\n         $document->mime_type = $ext;\r\n         $document->path = $document_path;\r\n         $document->save();\r\n\r\n     }\r\n }', 'client', NULL, '2021-05-30 19:08:40', 'UTC', 0, NULL, NULL, '78.00', '0.00', 'pending', NULL, '0.00', '2021-05-20 16:08:40', '2021-05-20 16:08:40', 'No', 'No', 'No', 'No'),
(34, 1027, 14, 'Content (Any Type)', 'Marketing', 'TEST ORDER BY PAFE', 'High School', 4, '1', 'Other', 2, 'if($request->hasfile(\'documents\'))\r\n        {\r\n\r\n           foreach($request->file(\'documents\') as $key => $file)\r\n           {\r\n            $allowed = [\'pdf\',\'PDF\',\'csv\',\'docx\',\'xls\',\'xlsx\',\'jpg\',\'jpeg\',\'png\'];\r\n            $ext = $file->getClientOriginalExtension();\r\n            $file_name = $file->getClientOriginalName();\r\n            if(!in_array($ext,$allowed)){\r\n             return response([\'errors\'=>[\'documents\'=>\'Please upload a valid file(pdf,csv,docx,xls,xlsx,jpg,jpeg,png)\']],422);\r\n         }\r\n         $uploaded = FileRepository::move($file);\r\n         if($uploaded[\'uploaded\'] == false){\r\n             return response([\'errors\'=>[\'documents\'=>$uploaded[\'error\']]],422);\r\n         }\r\n\r\n         $document_path = $uploaded[\'path\'];\r\n\r\n         $document = new OrderFile;\r\n         $document->order_code =$order_code;\r\n         $document->user_id =auth()->user()->id;\r\n         $document->user_role =auth()->user()->level;\r\n         $document->file_name = $file_name;\r\n         $document->mime_type = $ext;\r\n         $document->path = $document_path;\r\n         $document->save();\r\n\r\n     }\r\n }', 'client', NULL, '2021-10-28 20:11:02', 'UTC', 0, NULL, NULL, '52.00', '0.00', 'pending', NULL, '0.00', '2021-05-20 16:11:02', '2021-05-20 16:11:02', 'No', 'No', 'No', 'No'),
(35, 1028, 14, 'Content (Any Type)', 'Marketing', 'TEST ORDER BY PAFE', 'High School', 4, '1', 'Other', 2, 'if($request->hasfile(\'documents\'))\r\n        {\r\n\r\n           foreach($request->file(\'documents\') as $key => $file)\r\n           {\r\n            $allowed = [\'pdf\',\'PDF\',\'csv\',\'docx\',\'xls\',\'xlsx\',\'jpg\',\'jpeg\',\'png\'];\r\n            $ext = $file->getClientOriginalExtension();\r\n            $file_name = $file->getClientOriginalName();\r\n            if(!in_array($ext,$allowed)){\r\n             return response([\'errors\'=>[\'documents\'=>\'Please upload a valid file(pdf,csv,docx,xls,xlsx,jpg,jpeg,png)\']],422);\r\n         }\r\n         $uploaded = FileRepository::move($file);\r\n         if($uploaded[\'uploaded\'] == false){\r\n             return response([\'errors\'=>[\'documents\'=>$uploaded[\'error\']]],422);\r\n         }\r\n\r\n         $document_path = $uploaded[\'path\'];\r\n\r\n         $document = new OrderFile;\r\n         $document->order_code =$order_code;\r\n         $document->user_id =auth()->user()->id;\r\n         $document->user_role =auth()->user()->level;\r\n         $document->file_name = $file_name;\r\n         $document->mime_type = $ext;\r\n         $document->path = $document_path;\r\n         $document->save();\r\n\r\n     }\r\n }', 'client', NULL, '2021-10-28 20:11:44', 'UTC', 3, NULL, NULL, '52.00', '0.00', 'completed', NULL, '0.00', '2021-05-20 16:11:44', '2021-07-15 05:00:36', 'No', 'No', 'No', 'No'),
(36, 1029, 14, 'Content (Any Type)', 'Marketing', 'TEST ORDER BY PAFE', 'High School', 4, '1', 'Other', 2, 'if($request->hasfile(\'documents\'))\r\n        {\r\n\r\n           foreach($request->file(\'documents\') as $key => $file)\r\n           {\r\n            $allowed = [\'pdf\',\'PDF\',\'csv\',\'docx\',\'xls\',\'xlsx\',\'jpg\',\'jpeg\',\'png\'];\r\n            $ext = $file->getClientOriginalExtension();\r\n            $file_name = $file->getClientOriginalName();\r\n            if(!in_array($ext,$allowed)){\r\n             return response([\'errors\'=>[\'documents\'=>\'Please upload a valid file(pdf,csv,docx,xls,xlsx,jpg,jpeg,png)\']],422);\r\n         }\r\n         $uploaded = FileRepository::move($file);\r\n         if($uploaded[\'uploaded\'] == false){\r\n             return response([\'errors\'=>[\'documents\'=>$uploaded[\'error\']]],422);\r\n         }\r\n\r\n         $document_path = $uploaded[\'path\'];\r\n\r\n         $document = new OrderFile;\r\n         $document->order_code =$order_code;\r\n         $document->user_id =auth()->user()->id;\r\n         $document->user_role =auth()->user()->level;\r\n         $document->file_name = $file_name;\r\n         $document->mime_type = $ext;\r\n         $document->path = $document_path;\r\n         $document->save();\r\n\r\n     }\r\n }', 'client', NULL, '2021-10-28 20:20:16', 'UTC', 3, NULL, NULL, '52.00', '0.00', 'completed', NULL, '0.00', '2021-05-20 16:20:16', '2021-07-15 04:52:40', 'No', 'No', 'No', 'No'),
(37, 1030, 14, 'Annotated Bibliography', 'Music', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'College', 4, '2', 'Other', 2, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'system', NULL, '2021-05-30 18:22:48', 'UTC', 3, NULL, NULL, '73.00', '0.00', 'completed', NULL, '0.00', '2021-05-20 16:22:48', '2021-07-15 04:43:01', 'No', 'No', 'No', 'No'),
(38, 1031, 14, 'Essay (Any Type)', 'Other', 'TEST ORDER BY PAFE TO BE CANCELLED', '', 2, '1', 'Other', 0, 'TEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLED', 'client', NULL, '2021-06-17 09:26:05', 'UTC', 3, 3209, NULL, '26.00', '0.00', 'completed', NULL, '0.00', '2021-05-31 11:19:56', '2021-07-15 04:35:50', 'No', 'No', 'No', 'No'),
(39, 1032, 20, 'Essay (Any Type)', 'Other', 'Writers Choice', '', 2, '1', 'Other', 0, NULL, 'client', NULL, '2021-06-18 07:23:44', 'UTC', 0, NULL, NULL, '26.00', '0.00', 'pending', NULL, '0.00', '2021-06-08 04:23:44', '2021-06-08 04:23:44', 'No', 'No', 'No', 'No'),
(40, 1033, 28, 'Admission Essay', 'Mathematics', 'TEST ORDER BY PAFE TO BE CANCELLED', 'College', 4, '1', 'Other', 2, 'TEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLEDTEST ORDER BY PAFE TO BE CANCELLED', 'client', NULL, '2021-06-19 19:50:26', 'UTC', 0, 3211, NULL, '63.00', '0.00', 'pending', NULL, '0.00', '2021-06-09 17:50:26', '2021-06-09 17:51:36', 'No', 'No', 'No', 'No'),
(41, 1034, 29, 'Admission Essay', 'Marketing', 'TEST ORDER BY PAFE', 'High School', 4, '1', 'Other', 0, 'TEST ORDER BY PAFETEST ORDER BY PAFETEST ORDER BY PAFE', 'client', NULL, '2021-07-21 07:58:11', 'UTC', 0, 3210, NULL, '55.00', '0.00', 'pending', NULL, '0.00', '2021-07-11 05:58:11', '2021-07-11 05:58:31', 'No', 'No', 'No', 'No'),
(42, 1035, 29, 'Essay (Any Type)', 'Literature', 'TEST ORDER BY PAFE', 'Undergraduate', 2, '1', 'Other', 2, 'TEST ORDER BY PAFETEST ORDER BY PAFE', 'client', NULL, '2021-07-21 08:06:21', 'UTC', 0, 3210, NULL, '32.00', '0.00', 'pending', NULL, '0.00', '2021-07-11 06:06:21', '2021-07-11 06:06:35', 'No', 'No', 'No', 'No'),
(43, 1036, 14, 'Essay (Any Type)', 'Mathematics', 'TEST ORDER BY PAFE', 'College', 4, '2', 'Chicago/Turabian', 2, 'TEST ORDER BY PAFETEST ORDER BY PAFETEST ORDER BY PAFETEST ORDER BY PAFETEST ORDER BY PAFETEST ORDER BY PAFETEST ORDER BY PAFETEST ORDER BY PAFETEST ORDER BY PAFETEST ORDER BY PAFETEST ORDER BY PAFE', 'system', NULL, '2021-07-29 10:48:03', 'UTC', 3, NULL, NULL, '90.00', '0.00', 'completed', NULL, '0.00', '2021-07-19 08:48:03', '2021-07-21 07:10:40', 'No', 'No', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `order_files`
--

CREATE TABLE `order_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_files`
--

INSERT INTO `order_files` (`id`, `order_code`, `user_id`, `user_role`, `file_name`, `mime_type`, `path`, `created_at`, `updated_at`) VALUES
(57, '1029', 14, 'customer', '1621538406777Invoice B1754 - Jenny Luesby.pdf', 'pdf', 'app//uploads/2021/05/20/1621538406777invoice-b1754-jenny-luesby.pdf', '2021-05-20 16:20:06', '2021-05-20 16:20:16'),
(95, '0000', 99999, 'customer', 'grid-report.PDF', 'PDF', 'app//uploads/2021/05/24/grid-report.PDF', '2021-05-24 17:33:20', '2021-05-24 17:33:20'),
(103, '0000', 99999, 'customer', 'WhatsApp Image 2021-05-21 at 2.49.24 PM.jpeg', 'jpeg', 'app//uploads/2021/05/24/whatsapp-image-2021-05-21-at-24924-pm.jpeg', '2021-05-24 17:39:18', '2021-05-24 17:39:18'),
(108, '0000', 99999, 'customer', 'grid-report.PDF', 'PDF', 'app//uploads/2021/05/24/grid-report.PDF', '2021-05-24 17:40:49', '2021-05-24 17:40:49'),
(119, '0000', 99999, 'customer', 'grid-report.PDF', 'PDF', 'app//uploads/2021/05/25/grid-report.PDF', '2021-05-25 15:59:30', '2021-05-25 15:59:30'),
(123, '0000', 99999, 'customer', 'grid-report.PDF', 'PDF', 'app//uploads/2021/05/25/grid-report.PDF', '2021-05-25 16:06:45', '2021-05-25 16:06:45'),
(127, '0000', 99999, 'customer', 'img20180324-20043478.pdf', 'pdf', 'app//uploads/2021/05/25/img20180324-20043478.pdf', '2021-05-25 16:22:40', '2021-05-25 16:22:40'),
(128, '0000', 99999, 'customer', 'img20180324-20043478.pdf', 'pdf', 'app//uploads/2021/05/25/img20180324-20043478.pdf', '2021-05-25 16:23:57', '2021-05-25 16:23:57'),
(129, '0000', 99999, 'customer', 'WhatsApp Image 2021-05-21 at 2.49.24 PM.jpeg', 'jpeg', 'app//uploads/2021/05/25/whatsapp-image-2021-05-21-at-24924-pm.jpeg', '2021-05-25 16:24:04', '2021-05-25 16:24:04'),
(132, '0000', 99999, 'customer', 'WhatsApp Image 2021-05-21 at 2.49.24 PM.jpeg', 'jpeg', 'app//uploads/2021/05/25/whatsapp-image-2021-05-21-at-24924-pm.jpeg', '2021-05-25 16:26:16', '2021-05-25 16:26:16'),
(134, '0000', 99999, 'customer', 'WhatsApp Image 2021-05-21 at 2.49.24 PM.jpeg', 'jpeg', 'app//uploads/2021/05/25/whatsapp-image-2021-05-21-at-24924-pm.jpeg', '2021-05-25 16:28:04', '2021-05-25 16:28:04'),
(135, '0000', 99999, 'customer', 'img20180324-20043478.pdf', 'pdf', 'app//uploads/2021/05/25/img20180324-20043478.pdf', '2021-05-25 16:29:22', '2021-05-25 16:29:22'),
(136, '0000', 99999, 'customer', 'img20180324-20043478.pdf', 'pdf', 'app//uploads/2021/05/25/img20180324-20043478.pdf', '2021-05-25 16:30:35', '2021-05-25 16:30:35'),
(137, '0000', 99999, 'customer', 'WhatsApp Image 2021-05-21 at 2.49.24 PM.jpeg', 'jpeg', 'app//uploads/2021/05/25/whatsapp-image-2021-05-21-at-24924-pm.jpeg', '2021-05-25 16:30:47', '2021-05-25 16:30:47'),
(142, '0000', 99999, 'customer', 'grid-report.PDF', 'PDF', 'app//uploads/2021/05/26/grid-report.PDF', '2021-05-26 04:14:07', '2021-05-26 04:14:07'),
(145, '0000', 99999, 'customer', 'img20180324-20043478.pdf', 'pdf', 'app//uploads/2021/05/26/img20180324-20043478.pdf', '2021-05-26 04:25:51', '2021-05-26 04:25:51'),
(154, '0000', 99999, 'customer', 'Invoice B1754 - Jenny Luesby.pdf', 'pdf', 'app//uploads/2021/06/01/invoice-b1754-jenny-luesby.pdf', '2021-06-01 17:15:52', '2021-06-01 17:15:52'),
(155, '0000', 99999, 'customer', 'Invoice B1754 - Jenny Luesby.pdf', 'pdf', 'app//uploads/2021/06/01/invoice-b1754-jenny-luesby.pdf', '2021-06-01 17:17:10', '2021-06-01 17:17:10'),
(156, '0000', 99999, 'customer', 'Invoice B1754 - Jenny Luesby.pdf', 'pdf', 'app//uploads/2021/06/01/invoice-b1754-jenny-luesby.pdf', '2021-06-01 17:18:03', '2021-06-01 17:18:03'),
(158, '0000', 99999, 'customer', 'img20180324-20043478.pdf', 'pdf', 'app//uploads/2021/06/01/img20180324-20043478.pdf', '2021-06-01 17:20:40', '2021-06-01 17:20:40'),
(159, '0000', 99999, 'customer', 'Invoice B1754 - Jenny Luesby.pdf', 'pdf', 'app//uploads/2021/06/01/invoice-b1754-jenny-luesby.pdf', '2021-06-01 17:22:04', '2021-06-01 17:22:04'),
(160, '0000', 99999, 'customer', 'Invoice B1754 - Jenny Luesby.pdf', 'pdf', 'app//uploads/2021/06/01/invoice-b1754-jenny-luesby.pdf', '2021-06-01 17:22:29', '2021-06-01 17:22:29'),
(161, '0000', 99999, 'customer', 'Invoice B1754 - Jenny Luesby.pdf', 'pdf', 'app//uploads/2021/06/02/invoice-b1754-jenny-luesby.pdf', '2021-06-02 04:09:10', '2021-06-02 04:09:10'),
(162, '0000', 99999, 'customer', 'Invoice B1754 - Jenny Luesby.pdf', 'pdf', 'app//uploads/2021/06/03/invoice-b1754-jenny-luesby.pdf', '2021-06-03 05:07:08', '2021-06-03 05:07:08'),
(164, '0000', 99999, 'customer', 'grid-report.PDF', 'PDF', 'app//uploads/2021/06/03/grid-report.PDF', '2021-06-03 05:07:17', '2021-06-03 05:07:17'),
(165, '0000', 99999, 'customer', 'Invoice B1754 - Jenny Luesby.pdf', 'pdf', 'app//uploads/2021/06/03/invoice-b1754-jenny-luesby.pdf', '2021-06-03 08:09:32', '2021-06-03 08:09:32'),
(166, '0000', 99999, 'customer', 'WhatsApp Image 2021-05-21 at 2.49.24 PM WhatsApp Image 2021-05-21 at 2.49.24 PM.jpeg', 'jpeg', 'app//uploads/2021/06/03/whatsapp-image-2021-05-21-at-24924-pm-whatsapp-image-2021-05-21-at-24924-pm.jpeg', '2021-06-03 08:09:56', '2021-06-03 08:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Order payment',
  `amount` decimal(30,2) NOT NULL DEFAULT 0.00,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `transaction_id`, `order_id`, `transaction_type`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, '82603678WD810104K', '1018', 'Order payment', '98.99', 'successful', '2021-04-17 03:04:32', '2021-04-17 03:04:32'),
(2, 4, '82603678WD810104K', '1018', 'Order payment', '98.99', 'successful', '2021-04-17 03:04:59', '2021-04-17 03:04:59'),
(3, 4, '6UK80779BV9899444', '1019', 'Order payment', '69.00', 'successful', '2021-04-17 14:19:35', '2021-04-17 14:19:35'),
(4, 4, '6UK80779BV9899444', '1019', 'Order payment', '69.00', 'successful', '2021-04-17 14:20:05', '2021-04-17 14:20:05'),
(5, 15, '13H50946KM374983H', '1020', 'Order payment', '54.99', 'successful', '2021-04-27 13:15:06', '2021-04-27 13:15:06'),
(6, 15, '13H50946KM374983H', '1020', 'Order payment', '54.99', 'successful', '2021-04-27 13:16:38', '2021-04-27 13:16:38'),
(7, 15, '13H50946KM374983H', '1020', 'Order payment', '54.99', 'successful', '2021-04-27 13:17:35', '2021-04-27 13:17:35'),
(8, 15, '13H50946KM374983H', '1020', 'Order payment', '54.99', 'successful', '2021-04-27 13:18:20', '2021-04-27 13:18:20'),
(9, 14, 'D6413912-B974-4A07-9DA6-B04AE5869F6B', '1019', 'Order payment', '0.01', 'successful', '2021-04-27 16:02:06', '2021-04-27 16:02:06'),
(10, 18, '501', '1022', 'Order payment', '38.99', 'failed', '2021-05-17 08:39:22', '2021-05-17 08:39:22'),
(11, 18, '501', '1022', 'Order payment', '38.99', 'failed', '2021-05-17 08:43:30', '2021-05-17 08:43:30'),
(12, 18, '501', '1022', 'Order payment', '38.99', 'failed', '2021-05-17 08:43:56', '2021-05-17 08:43:56'),
(13, 18, '501', '1022', 'Order payment', '38.99', 'failed', '2021-05-17 08:44:14', '2021-05-17 08:44:14'),
(14, 18, '501', '1022', 'Order payment', '38.99', 'failed', '2021-05-17 08:44:35', '2021-05-17 08:44:35'),
(15, 18, '501', '1022', 'Order payment', '38.99', 'failed', '2021-05-17 08:44:48', '2021-05-17 08:44:48'),
(16, 18, '501', '1022', 'Order payment', '38.99', 'failed', '2021-05-17 08:45:07', '2021-05-17 08:45:07'),
(17, 18, '501', '1022', 'Order payment', '38.99', 'failed', '2021-05-17 08:45:17', '2021-05-17 08:45:17'),
(18, 18, '10X21983R6416034V', '1022', 'Order payment', '38.99', 'successful', '2021-05-17 08:46:18', '2021-05-17 08:46:18'),
(19, 14, '4YK287687U823724W', '1031', 'Order payment', '26.00', 'successful', '2021-07-15 04:35:50', '2021-07-15 04:35:50'),
(20, 14, '4YK287687U823724W', '1031', 'Order payment', '26.00', 'successful', '2021-07-15 04:36:19', '2021-07-15 04:36:19'),
(21, 14, '4YK287687U823724W', '1031', 'Order payment', '26.00', 'successful', '2021-07-15 04:39:36', '2021-07-15 04:39:36'),
(22, 14, '7LK4376585722363J', '1030', 'Order payment', '73.00', 'successful', '2021-07-15 04:43:01', '2021-07-15 04:43:01'),
(23, 14, '8XM89315AJ400694T', '1029', 'Order payment', '52.00', 'successful', '2021-07-15 04:52:40', '2021-07-15 04:52:40'),
(24, 14, '4M325725RB131264D', '1028', 'Order payment', '52.00', 'successful', '2021-07-15 05:00:36', '2021-07-15 05:00:36'),
(25, 14, '26S25924MB023420C', '1036', 'Order payment', '67.00', 'successful', '2021-07-19 09:05:21', '2021-07-19 09:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_seen` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url_prefix` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `login_session` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_bal` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `level`, `phone_number`, `country`, `city`, `state`, `zip`, `profile_picture`, `status`, `last_seen`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `url_prefix`, `login_session`, `site_url`, `account_bal`) VALUES
(1, 'Johnston (Support)', 'johniemutio@gmail.com', 'admin', '222', NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, '$2y$10$yurbNGX/lGPVTh.bxBSzpOzUpz3Jkt0QFfnUkAwVTEouGGgi3Lgsq', NULL, '2020-06-16 03:16:39', '2021-08-10 11:57:20', 'main', 'Online', NULL, '0.00'),
(3, 'Mutio Sam', 'mutiosamson95@gmail.com', 'writer', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, '$2y$10$7eHm/dFgHZCL.Iha4qgo9eLSZmSjA33oWKlo1lIquZo.Ndp/AxbM6', NULL, '2020-06-16 03:16:39', '2021-06-23 10:51:34', 'writer', 'Offline', NULL, '0.00'),
(8, 'Writer Two2', 'writer.two@gmail.com', 'writer', NULL, NULL, NULL, NULL, NULL, '1.jpeg', 'active', NULL, NULL, '$2y$10$7eHm/dFgHZCL.Iha4qgo9eLSZmSjA33oWKlo1lIquZo.Ndp/AxbM6', NULL, '2020-06-16 03:16:39', '2021-05-19 09:34:47', 'writer', 'Offline', NULL, '0.00'),
(14, 'Customer-12677', 'johniegamer5@gmail.com', 'customer', '0799778888', 'UK (+44)', 'Denver', 'Denver', '222', NULL, 'active', NULL, NULL, '$2y$10$yurbNGX/lGPVTh.bxBSzpOzUpz3Jkt0QFfnUkAwVTEouGGgi3Lgsq', 'H1KneDUywBMkg2YeGqnpxT2rxscwcRYvSwSUfEPNtMzbv3lH5SVxXUCrbeZn', '2021-04-22 03:52:22', '2021-07-15 04:30:29', 'customer', 'Online', NULL, '0.00'),
(18, 'Pafe Support', 'support@pafe.co.ke', 'customer', '0722911322', 'Andorra', 'Denver', 'Denver', '222', NULL, 'active', NULL, NULL, '$2y$10$7eHm/dFgHZCL.Iha4qgo9eLSZmSjA33oWKlo1lIquZo.Ndp/AxbM6', NULL, '2021-05-17 08:15:12', '2021-05-17 08:47:19', 'customer', 'Offline', NULL, '0.00'),
(19, 'Writer 3', 'writer.3@gmail.com', 'writer', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, '$2y$10$vbVYfwlrvYBZpGcMIeDQBumYxdUpEHKfnspYk7UfRa.TLrWfPqQGi', NULL, '2021-05-17 17:23:13', '2021-05-17 17:23:13', 'writer', 'Offline', NULL, '0.00'),
(29, 'Customer-28370', 'johnston.mutio@pafe.co.ke', 'customer', '409892939', 'Algeria (+213)', 'Denver', NULL, NULL, NULL, 'active', NULL, NULL, '$2y$10$KRTPN9AEUl6EnaTK2JmvIufaeTQ.iqrbl2Ut2StDCHhTvsF4Ugbf6', 'FwwyZn6KyQ7t97R5DqihdqQkGGMiH0VRFK82C3BOr4PoLlHuTIh3DZDyeJmC', '2021-07-11 05:57:43', '2021-07-11 05:58:53', 'customer', 'Online', NULL, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `writers`
--

CREATE TABLE `writers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `writer_code` int(11) NOT NULL,
  `rating` decimal(10,1) NOT NULL,
  `profile_summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bronze',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price_rate` decimal(2,1) NOT NULL DEFAULT 1.0,
  `finished_papers` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `writers`
--

INSERT INTO `writers` (`id`, `user_id`, `writer_code`, `rating`, `profile_summary`, `skills`, `badge`, `created_at`, `updated_at`, `price_rate`, `finished_papers`) VALUES
(1, 3, 3209, '91.0', 'Professional academic writer with 4+ years of experience.', 'essay writing, grammar, comprehensive writing, proof-reading', 'gold', NULL, NULL, '1.0', 22),
(2, 8, 3210, '94.0', 'Professional academic writer with 6+ years of experience.', 'essay writing, grammar, comprehensive writing, proof-reading,maths', 'gold', NULL, NULL, '1.0', 34),
(3, 19, 3211, '99.0', 'Profile summary', 'english.science', 'bronze', '2021-05-17 17:23:13', '2021-05-17 17:23:13', '1.0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`);

--
-- Indexes for table `order_files`
--
ALTER TABLE `order_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `writers`
--
ALTER TABLE `writers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `writers_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `writers_writer_code_unique` (`writer_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_files`
--
ALTER TABLE `order_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `writers`
--
ALTER TABLE `writers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
