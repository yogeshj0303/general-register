-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2025 at 11:21 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `egram_egram`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_grams`
--

CREATE TABLE `about_grams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) NOT NULL,
  `district` varchar(191) NOT NULL,
  `taluka` varchar(191) NOT NULL,
  `gram` varchar(191) NOT NULL,
  `about_gram` text NOT NULL,
  `path` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_grams`
--

INSERT INTO `about_grams` (`id`, `state`, `district`, `taluka`, `gram`, `about_gram`, `path`, `created_at`, `updated_at`, `owner_id`) VALUES
(27, 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', 'nnn', 'assets/about-gram/Maharashtra/Kolhapur/कागल/ग्रामपंचायत कापशी/07012025 updates.pdf', '2025-01-15 17:15:18', '2025-01-15 17:15:18', '1');

-- --------------------------------------------------------

--
-- Table structure for table `annual_maintenances`
--

CREATE TABLE `annual_maintenances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `state` varchar(191) NOT NULL,
  `district` varchar(191) NOT NULL,
  `taluka` varchar(191) NOT NULL,
  `gram` varchar(191) NOT NULL,
  `maintenance_year` varchar(11) NOT NULL,
  `maintenance_amount` decimal(15,2) NOT NULL,
  `remaining_amount` decimal(15,2) NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `current_population` int(11) DEFAULT NULL,
  `bill_status` enum('pending','complete') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `annual_maintenances`
--

INSERT INTO `annual_maintenances` (`id`, `invoice_no`, `reference_number`, `state`, `district`, `taluka`, `gram`, `maintenance_year`, `maintenance_amount`, `remaining_amount`, `payment_mode`, `description`, `current_population`, `bill_status`, `created_at`, `updated_at`) VALUES
(1, '00001', '003', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '2025', 2000.00, 0.00, 'Cash', 'mrtusharsuryawanshi@gmail.com', 35000, 'pending', '2025-01-07 20:00:40', '2025-01-07 20:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'जन्म', '2025-01-07 19:21:49', '2025-01-07 19:21:49'),
(2, 'मृत्यू', '2025-01-07 19:22:03', '2025-01-07 19:22:03'),
(3, 'उपजत मृत्यू', '2025-01-07 19:22:12', '2025-01-07 19:22:12'),
(4, 'घरठाण', '2025-01-07 19:22:33', '2025-01-07 19:22:33'),
(5, 'विवाह', '2025-01-07 19:22:40', '2025-01-07 19:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(191) NOT NULL,
  `original_file_name` varchar(255) DEFAULT NULL,
  `register_to_gram_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `path`, `original_file_name`, `register_to_gram_id`, `created_at`, `updated_at`) VALUES
(124, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19440.pdf', '19440.pdf', 21, '2025-01-13 18:59:35', '2025-01-13 18:59:35'),
(125, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19441.pdf', '19441.pdf', 21, '2025-01-13 19:03:25', '2025-01-13 19:03:25'),
(126, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19442.pdf', '19442.pdf', 21, '2025-01-13 19:03:35', '2025-01-13 19:03:35'),
(127, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19443.pdf', '19443.pdf', 21, '2025-01-13 19:03:49', '2025-01-13 19:03:49'),
(128, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19444.pdf', '19444.pdf', 21, '2025-01-13 19:04:00', '2025-01-13 19:04:00'),
(129, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19445.pdf', '19445.pdf', 21, '2025-01-13 19:04:06', '2025-01-13 19:04:06'),
(130, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19446.pdf', '19446.pdf', 21, '2025-01-13 19:11:28', '2025-01-13 19:11:28'),
(131, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19447.pdf', '19447.pdf', 21, '2025-01-13 19:11:38', '2025-01-13 19:11:38'),
(132, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19448.pdf', '19448.pdf', 21, '2025-01-13 19:11:53', '2025-01-13 19:11:53'),
(133, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19449.pdf', '19449.pdf', 21, '2025-01-13 19:12:06', '2025-01-13 19:12:06'),
(134, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19450.pdf', '19450.pdf', 21, '2025-01-13 19:12:18', '2025-01-13 19:12:18'),
(135, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19451.pdf', '19451.pdf', 21, '2025-01-13 19:19:08', '2025-01-13 19:19:08'),
(136, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19452.pdf', '19452.pdf', 21, '2025-01-13 19:19:14', '2025-01-13 19:19:14'),
(137, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19453.pdf', '19453.pdf', 21, '2025-01-13 19:19:19', '2025-01-13 19:19:19'),
(138, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19454.pdf', '19454.pdf', 21, '2025-01-13 19:19:24', '2025-01-13 19:19:24'),
(139, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19456.pdf', '19456.pdf', 21, '2025-01-13 19:28:32', '2025-01-13 19:28:32'),
(140, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19457.pdf', '19457.pdf', 21, '2025-01-13 19:28:39', '2025-01-13 19:28:39'),
(141, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19458.pdf', '19458.pdf', 21, '2025-01-13 19:28:48', '2025-01-13 19:28:48'),
(142, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19459.pdf', '19459.pdf', 21, '2025-01-13 19:28:51', '2025-01-13 19:28:51'),
(143, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19460.pdf', '19460.pdf', 21, '2025-01-13 19:29:01', '2025-01-13 19:29:01'),
(144, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19461.pdf', '19461.pdf', 21, '2025-01-13 19:45:54', '2025-01-13 19:45:54'),
(145, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19462.pdf', '19462.pdf', 21, '2025-01-13 19:46:02', '2025-01-13 19:46:02'),
(146, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19463.pdf', '19463.pdf', 21, '2025-01-13 19:46:10', '2025-01-13 19:46:10'),
(147, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19464.pdf', '19464.pdf', 21, '2025-01-13 19:46:20', '2025-01-13 19:46:20'),
(148, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19465.pdf', '19465.pdf', 21, '2025-01-13 19:46:25', '2025-01-13 19:46:25'),
(149, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19466.pdf', '19466.pdf', 21, '2025-01-13 19:46:28', '2025-01-13 19:46:28'),
(150, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19467.pdf', '19467.pdf', 21, '2025-01-13 19:51:40', '2025-01-13 19:51:40'),
(151, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19468.pdf', '19468.pdf', 21, '2025-01-13 19:51:44', '2025-01-13 19:51:44'),
(152, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19469.pdf', '19469.pdf', 21, '2025-01-13 19:51:46', '2025-01-13 19:51:46'),
(153, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19470.pdf', '19470.pdf', 21, '2025-01-13 19:51:47', '2025-01-13 19:51:47'),
(154, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19471.pdf', '19471.pdf', 21, '2025-01-13 19:51:49', '2025-01-13 19:51:49'),
(155, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19472.pdf', '19472.pdf', 21, '2025-01-13 19:51:52', '2025-01-13 19:51:52'),
(156, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19473.pdf', '19473.pdf', 21, '2025-01-13 19:51:54', '2025-01-13 19:51:54'),
(157, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19475.pdf', '19475.pdf', 22, '2025-01-13 20:03:05', '2025-01-13 20:03:05'),
(158, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19476.pdf', '19476.pdf', 22, '2025-01-13 20:03:18', '2025-01-13 20:03:18'),
(159, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19478.pdf', '19478.pdf', 22, '2025-01-13 20:03:25', '2025-01-13 20:03:25'),
(160, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19479.pdf', '19479.pdf', 22, '2025-01-13 20:03:30', '2025-01-13 20:03:30'),
(161, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19480.pdf', '19480.pdf', 22, '2025-01-13 20:03:43', '2025-01-13 20:03:43'),
(162, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19482.pdf', '19482.pdf', 22, '2025-01-13 20:14:54', '2025-01-13 20:14:54'),
(163, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19483.pdf', '19483.pdf', 22, '2025-01-13 20:15:03', '2025-01-13 20:15:03'),
(164, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19484.pdf', '19484.pdf', 22, '2025-01-13 20:15:17', '2025-01-13 20:15:17'),
(165, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19485.pdf', '19485.pdf', 22, '2025-01-13 20:15:23', '2025-01-13 20:15:23'),
(166, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19486.pdf', '19486.pdf', 22, '2025-01-13 20:18:57', '2025-01-13 20:18:57'),
(167, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19487.pdf', '19487.pdf', 22, '2025-01-13 20:19:01', '2025-01-13 20:19:01'),
(168, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19488.pdf', '19488.pdf', 22, '2025-01-13 20:19:07', '2025-01-13 20:19:07'),
(169, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19489.pdf', '19489.pdf', 22, '2025-01-13 20:21:21', '2025-01-13 20:21:21'),
(170, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19490.pdf', '19490.pdf', 22, '2025-01-13 20:21:25', '2025-01-13 20:21:25'),
(171, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19491.pdf', '19491.pdf', 22, '2025-01-13 20:21:29', '2025-01-13 20:21:29'),
(172, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19492.pdf', '19492.pdf', 22, '2025-01-13 20:21:36', '2025-01-13 20:21:36'),
(173, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19493.pdf', '19493.pdf', 22, '2025-01-13 20:21:41', '2025-01-13 20:21:41'),
(174, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19494.pdf', '19494.pdf', 22, '2025-01-13 20:21:46', '2025-01-13 20:21:46'),
(175, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19495.pdf', '19495.pdf', 22, '2025-01-13 20:21:48', '2025-01-13 20:21:48'),
(176, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19496.pdf', '19496.pdf', 22, '2025-01-13 20:23:41', '2025-01-13 20:23:41'),
(177, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19497.pdf', '19497.pdf', 22, '2025-01-13 20:23:44', '2025-01-13 20:23:44'),
(178, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19498.pdf', '19498.pdf', 22, '2025-01-13 20:23:49', '2025-01-13 20:23:49'),
(179, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19499.pdf', '19499.pdf', 22, '2025-01-13 20:23:51', '2025-01-13 20:23:51'),
(180, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19500.pdf', '19500.pdf', 22, '2025-01-13 20:23:56', '2025-01-13 20:23:56'),
(181, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19501.pdf', '19501.pdf', 22, '2025-01-13 20:25:52', '2025-01-13 20:25:52'),
(182, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19502.pdf', '19502.pdf', 22, '2025-01-13 20:25:55', '2025-01-13 20:25:55'),
(183, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19503.pdf', '19503.pdf', 22, '2025-01-13 20:26:00', '2025-01-13 20:26:00'),
(184, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19504.pdf', '19504.pdf', 22, '2025-01-13 20:26:03', '2025-01-13 20:26:03'),
(185, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19505.pdf', '19505.pdf', 22, '2025-01-13 20:26:12', '2025-01-13 20:26:12'),
(186, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19506.pdf', '19506.pdf', 22, '2025-01-13 20:26:16', '2025-01-13 20:26:16'),
(187, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19394.pdf', '19394.pdf', 23, '2025-01-13 20:31:44', '2025-01-13 20:31:44'),
(188, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19395.pdf', '19395.pdf', 23, '2025-01-13 20:55:59', '2025-01-13 20:55:59'),
(189, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19396.pdf', '19396.pdf', 23, '2025-01-13 20:56:06', '2025-01-13 20:56:06'),
(190, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19397.pdf', '19397.pdf', 23, '2025-01-13 20:58:42', '2025-01-13 20:58:42'),
(191, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19398.pdf', '19398.pdf', 23, '2025-01-13 20:58:53', '2025-01-13 20:58:53'),
(192, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19399.pdf', '19399.pdf', 23, '2025-01-13 20:59:07', '2025-01-13 20:59:07'),
(193, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19400.pdf', '19400.pdf', 23, '2025-01-13 20:59:23', '2025-01-13 20:59:23'),
(194, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19401.pdf', '19401.pdf', 23, '2025-01-13 21:02:35', '2025-01-13 21:02:35'),
(195, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19402.pdf', '19402.pdf', 23, '2025-01-13 21:02:46', '2025-01-13 21:02:46'),
(196, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19403.pdf', '19403.pdf', 23, '2025-01-13 21:02:51', '2025-01-13 21:02:51'),
(197, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19404.pdf', '19404.pdf', 23, '2025-01-13 21:02:59', '2025-01-13 21:02:59'),
(198, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19405.pdf', '19405.pdf', 23, '2025-01-13 21:03:11', '2025-01-13 21:03:11'),
(199, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19406.pdf', '19406.pdf', 23, '2025-01-13 21:12:07', '2025-01-13 21:12:07'),
(200, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19407.pdf', '19407.pdf', 23, '2025-01-13 21:12:23', '2025-01-13 21:12:23'),
(201, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19408.pdf', '19408.pdf', 23, '2025-01-13 21:12:38', '2025-01-13 21:12:38'),
(202, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19409.pdf', '19409.pdf', 23, '2025-01-13 22:03:46', '2025-01-13 22:03:46'),
(203, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19410.pdf', '19410.pdf', 23, '2025-01-13 22:03:55', '2025-01-13 22:03:55'),
(204, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19411.pdf', '19411.pdf', 23, '2025-01-13 22:09:36', '2025-01-13 22:09:36'),
(205, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19412.pdf', '19412.pdf', 23, '2025-01-13 22:10:00', '2025-01-13 22:10:00'),
(206, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19413.pdf', '19413.pdf', 23, '2025-01-13 22:13:08', '2025-01-13 22:13:08'),
(207, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19414.pdf', '19414.pdf', 23, '2025-01-13 22:13:24', '2025-01-13 22:13:24'),
(208, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19415.pdf', '19415.pdf', 23, '2025-01-13 22:13:42', '2025-01-13 22:13:42'),
(209, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19416.pdf', '19416.pdf', 23, '2025-01-13 22:17:11', '2025-01-13 22:17:11'),
(210, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19417.pdf', '19417.pdf', 23, '2025-01-13 22:17:35', '2025-01-13 22:17:35'),
(211, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19418.pdf', '19418.pdf', 23, '2025-01-13 22:23:27', '2025-01-13 22:23:27'),
(212, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19419.pdf', '19419.pdf', 23, '2025-01-13 22:23:55', '2025-01-13 22:23:55'),
(213, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19420.pdf', '19420.pdf', 23, '2025-01-13 22:27:42', '2025-01-13 22:27:42'),
(214, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19421.pdf', '19421.pdf', 23, '2025-01-13 22:27:57', '2025-01-13 22:27:57'),
(215, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19422.pdf', '19422.pdf', 23, '2025-01-13 22:28:11', '2025-01-13 22:28:11'),
(216, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19423.pdf', '19423.pdf', 23, '2025-01-13 22:31:17', '2025-01-13 22:31:17'),
(217, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19424.pdf', '19424.pdf', 23, '2025-01-13 22:31:35', '2025-01-13 22:31:35'),
(218, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19425.pdf', '19425.pdf', 23, '2025-01-13 22:31:40', '2025-01-13 22:31:40'),
(244, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19426.pdf', '19426.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(245, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19427.pdf', '19427.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(246, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19428.pdf', '19428.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(247, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19429.pdf', '19429.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(248, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19430.pdf', '19430.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(249, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19431.pdf', '19431.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(250, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19432.pdf', '19432.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(251, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19433.pdf', '19433.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(252, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19434.pdf', '19434.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(253, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19435.pdf', '19435.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(254, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19436.pdf', '19436.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(255, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19437.pdf', '19437.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(256, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19438.pdf', '19438.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(257, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19439.pdf', '19439.pdf', 23, '2025-01-15 20:01:34', '2025-01-15 20:01:34'),
(259, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/testing.pdf', 'testing.pdf', 38, '2025-01-15 20:09:09', '2025-01-15 20:09:09'),
(260, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19507.pdf', '19507.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(261, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19508.pdf', '19508.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(262, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19509.pdf', '19509.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(263, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19510.pdf', '19510.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(264, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19511.pdf', '19511.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(265, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19512.pdf', '19512.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(266, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19513.pdf', '19513.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(267, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19514.pdf', '19514.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(268, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19515.pdf', '19515.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(269, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19516.pdf', '19516.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(270, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19517.pdf', '19517.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(271, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19518.pdf', '19518.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(272, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19519.pdf', '19519.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(273, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19520.pdf', '19520.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(274, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19521.pdf', '19521.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(275, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19522.pdf', '19522.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(276, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19523.pdf', '19523.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(277, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19524.pdf', '19524.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(278, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19525.pdf', '19525.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(279, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19526.pdf', '19526.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(280, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19527.pdf', '19527.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(281, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19528.pdf', '19528.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(282, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19529.pdf', '19529.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(283, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19530.pdf', '19530.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(284, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19531.pdf', '19531.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(285, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19532.pdf', '19532.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(286, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19533.pdf', '19533.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(287, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19534.pdf', '19534.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(288, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19535.pdf', '19535.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(289, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19536.pdf', '19536.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(290, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19537.pdf', '19537.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(291, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19538.pdf', '19538.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(292, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19539.pdf', '19539.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(293, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19540.pdf', '19540.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(294, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19541.pdf', '19541.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(295, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19542.pdf', '19542.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(296, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19543.pdf', '19543.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54'),
(297, 'uploads/Maharashtra/Kolhapur/कागल/ग्रामपंचायत-कापशी/19544.pdf', '19544.pdf', 38, '2025-01-15 21:11:54', '2025-01-15 21:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `gharpatti_panipattis`
--

CREATE TABLE `gharpatti_panipattis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) NOT NULL,
  `district` varchar(191) NOT NULL,
  `taluka` varchar(191) NOT NULL,
  `gram` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `type` enum('gharpatti','panipatti') NOT NULL,
  `amount_type` varchar(191) NOT NULL,
  `paid_type` enum('cash','online','rtgs','check') NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `paid_date` datetime NOT NULL,
  `remaining_amount` decimal(10,2) DEFAULT NULL,
  `send_bill` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gharpatti_panipattis`
--

INSERT INTO `gharpatti_panipattis` (`id`, `state`, `district`, `taluka`, `gram`, `username`, `type`, `amount_type`, `paid_type`, `paid_amount`, `paid_date`, `remaining_amount`, `send_bill`, `created_at`, `updated_at`, `owner_id`) VALUES
(1, 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '26', 'panipatti', '500.00', 'cash', 500.00, '2025-01-07 20:07:00', 0.00, 0, '2025-01-07 20:07:56', '2025-01-07 20:07:56', '1'),
(2, 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '27', 'gharpatti', '1000.00', 'cash', 500.00, '2025-01-07 20:08:00', 500.00, 0, '2025-01-07 20:08:45', '2025-01-07 20:08:45', '1'),
(3, 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '27', 'gharpatti', '1000.00', 'cash', 500.00, '2025-01-07 20:09:00', 0.00, 0, '2025-01-07 20:09:54', '2025-01-07 20:09:54', '1');

-- --------------------------------------------------------

--
-- Table structure for table `grams`
--

CREATE TABLE `grams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gram_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `taluka` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pin_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grams`
--

INSERT INTO `grams` (`id`, `gram_name`, `created_at`, `updated_at`, `state`, `district`, `taluka`, `address`, `pin_code`) VALUES
(1, 'ग्रामपंचायत कापशी', '2025-01-07 19:26:24', '2025-01-07 19:26:24', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '000000');

-- --------------------------------------------------------

--
-- Table structure for table `gram_bills`
--

CREATE TABLE `gram_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `state` varchar(191) NOT NULL,
  `district` varchar(191) NOT NULL,
  `taluka` varchar(191) NOT NULL,
  `gram` varchar(191) NOT NULL,
  `population` int(10) UNSIGNED NOT NULL,
  `first_time_bill_amount` decimal(10,2) DEFAULT NULL,
  `paid_amount` int(255) NOT NULL DEFAULT 0,
  `quatation_date` date DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `reference_number` varchar(191) DEFAULT NULL,
  `maintenance_amount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `payment_mode` varchar(191) DEFAULT NULL,
  `next_maintenance_date` date DEFAULT NULL,
  `bill_status` varchar(191) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gram_bills`
--

INSERT INTO `gram_bills` (`id`, `invoice_no`, `state`, `district`, `taluka`, `gram`, `population`, `first_time_bill_amount`, `paid_amount`, `quatation_date`, `bill_date`, `reference_number`, `maintenance_amount`, `description`, `payment_mode`, `next_maintenance_date`, `bill_status`, `created_at`, `updated_at`, `owner_id`) VALUES
(1, '00001', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', 3500, 3000.00, 3000, '2025-01-01', '2025-01-07', '003', 2000.00, 'A 5G phone that only works on Jio network. (Image credit: Vivek Umashankar/The Indian Express) ggggggggggggggggggggggggggggggggggggggg', 'Cash', '2025-02-01', 'pending', '2025-01-07 19:51:44', '2025-01-08 12:50:45', '1'),
(2, '00002', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', 0, 0.00, 0, '2025-01-09', '2025-01-09', '0', 0.00, '0', 'RTGS', '2025-01-09', 'pending', '2025-01-09 13:26:18', '2025-01-09 13:26:48', '1');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_28_051036_create_categories_table', 2),
(6, '2024_11_28_070700_create_grams_table', 3),
(7, '2024_11_28_084944_create_talukas_table', 4),
(8, '2024_11_28_115428_create_gharpatti_panipattis_table', 5),
(9, '2024_11_30_055404_create_register_to_grams_table', 6),
(10, '2024_11_30_063849_create_files_table', 7),
(11, '2024_11_30_091335_create_about_grams_table', 8),
(12, '2024_12_02_060155_create_populations_table', 9),
(13, '2024_12_02_063709_create_gram_bills_table', 10),
(15, '2024_12_02_091231_create_annual_maintenances_table', 11),
(16, '2024_12_26_112822_add_expires_at_to_personal_access_tokens_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`, `expires_at`) VALUES
(8, 'App\\Models\\User', 2, 'authToken', '3743ec76ae070ec731dd90f97952ea1ddff1a0ea0de4500dccd64860fe856e24', '[\"*\"]', NULL, '2024-12-28 09:39:09', '2024-12-28 09:39:09', NULL),
(44, 'App\\Models\\User', 12, 'authToken', 'c0f56dee60c555f5f789dcca87d76e703e24b0d7578c6f2c520ed963e56c0ac4', '[\"*\"]', '2025-01-03 09:52:37', '2025-01-03 09:52:34', '2025-01-03 09:52:37', NULL),
(53, 'App\\Models\\User', 15, 'authToken', '3314c56f172a06d7b2a6cac7730b2a20092fbff5d486bfc7d6cea64a5bd77b50', '[\"*\"]', NULL, '2025-01-04 06:00:15', '2025-01-04 06:00:15', NULL),
(59, 'App\\Models\\User', 11, 'authToken', '59b5ea50b4d642638c296535f8ba41bb0dc3b0ca3d5ec75a331a4bf7f1521f93', '[\"*\"]', '2025-01-07 11:30:38', '2025-01-07 11:30:27', '2025-01-07 11:30:38', NULL),
(60, 'App\\Models\\User', 7, 'authToken', '71cee9906ff5925b672366a576e39a6adbdf83416bbfb437a680ebe3b49be480', '[\"*\"]', '2025-01-07 11:35:06', '2025-01-07 11:34:08', '2025-01-07 11:35:06', NULL),
(62, 'App\\Models\\User', 14, 'authToken', '2469896cd65e9812f317f49f68c9be16c4d0f0e604ded645a38135d96d37128d', '[\"*\"]', '2025-01-07 11:38:01', '2025-01-07 11:37:58', '2025-01-07 11:38:01', NULL),
(63, 'App\\Models\\User', 4, 'authToken', 'd2bf80d5aa8ea23daa36eada63d2e77ef536137035f8a7625c6b2c72719bb428', '[\"*\"]', '2025-01-07 13:25:54', '2025-01-07 12:33:02', '2025-01-07 13:25:54', NULL),
(90, 'App\\Models\\User', 25, 'authToken', 'c89522a01d2b986748b3d3b8b0a8f442446415184c4959b4b1111d071c505c0f', '[\"*\"]', '2025-01-15 18:22:10', '2025-01-15 18:05:59', '2025-01-15 18:22:10', NULL),
(92, 'App\\Models\\User', 33, 'authToken', '927ccdf8f4168f8b995b17726aa702a02794e5f0966741ab4cc09bd53337d3b0', '[\"*\"]', '2025-01-15 20:10:49', '2025-01-15 20:10:27', '2025-01-15 20:10:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `populations`
--

CREATE TABLE `populations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) NOT NULL,
  `district` varchar(191) NOT NULL,
  `taluka` varchar(191) NOT NULL,
  `gram` varchar(191) NOT NULL,
  `population` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `confirm_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `populations`
--

INSERT INTO `populations` (`id`, `state`, `district`, `taluka`, `gram`, `population`, `year`, `confirm_by`, `created_at`, `updated_at`) VALUES
(1, 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', 3500, 2024, '25', '2025-01-07 19:48:33', '2025-01-07 19:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `register_to_grams`
--

CREATE TABLE `register_to_grams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) NOT NULL,
  `district` varchar(191) NOT NULL,
  `taluka` varchar(191) NOT NULL,
  `gram` varchar(191) NOT NULL,
  `category` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_to_grams`
--

INSERT INTO `register_to_grams` (`id`, `state`, `district`, `taluka`, `gram`, `category`, `created_at`, `updated_at`) VALUES
(21, 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', 'जन्म', '2025-01-13 18:59:21', '2025-01-13 18:59:21'),
(22, 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', 'मृत्यू', '2025-01-13 20:02:48', '2025-01-13 20:02:48'),
(23, 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', 'घरठाण', '2025-01-13 20:31:37', '2025-01-13 20:31:37'),
(37, 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', 'उपजत मृत्यू', '2025-01-15 20:08:00', '2025-01-15 20:08:00'),
(38, 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', 'विवाह', '2025-01-15 20:09:08', '2025-01-15 20:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `m_cat_viewown` tinyint(1) DEFAULT 1,
  `m_cat_viewall` tinyint(1) DEFAULT 1,
  `m_cat_edit` tinyint(1) DEFAULT 1,
  `m_cat_delete` tinyint(1) DEFAULT 1,
  `m_cat_add` tinyint(1) DEFAULT 1,
  `m_taluka_add` tinyint(1) DEFAULT 1,
  `m_taluka_edit` tinyint(1) DEFAULT 1,
  `m_taluka_delete` tinyint(1) DEFAULT 1,
  `m_taluka_viewown` tinyint(1) DEFAULT 1,
  `m_taluka_viewall` tinyint(1) DEFAULT 1,
  `m_gram_add` tinyint(1) DEFAULT 1,
  `m_gram_edit` tinyint(1) DEFAULT 1,
  `m_gram_delete` tinyint(1) DEFAULT 1,
  `m_gram_viewown` tinyint(1) DEFAULT 1,
  `m_gram_viewall` tinyint(1) DEFAULT 1,
  `registered_gram_add` tinyint(1) DEFAULT 1,
  `registered_gram_edit` tinyint(1) DEFAULT 1,
  `registered_gram_delete` tinyint(1) DEFAULT 1,
  `registered_gram_viewown` tinyint(1) DEFAULT 1,
  `registered_gram_viewall` tinyint(1) DEFAULT 1,
  `registered_gram_print` tinyint(11) NOT NULL DEFAULT 1,
  `manage_user_add` tinyint(1) DEFAULT 1,
  `manage_user_edit` tinyint(1) DEFAULT 1,
  `manage_user_delete` tinyint(1) DEFAULT 1,
  `manage_user_viewown` tinyint(1) DEFAULT 1,
  `manage_user_viewall` tinyint(1) DEFAULT 1,
  `p_w_bill_add` tinyint(1) DEFAULT 1,
  `p_w_bill_edit` tinyint(1) DEFAULT 1,
  `p_w_bill_delete` tinyint(1) DEFAULT 1,
  `p_w_bill_viewown` tinyint(1) DEFAULT 1,
  `p_w_bill_viewall` tinyint(1) DEFAULT 1,
  `p_w_bill_print` tinyint(1) DEFAULT 1,
  `about_gram_add` tinyint(1) DEFAULT 1,
  `about_gram_edit` tinyint(1) DEFAULT 1,
  `about_gram_delete` tinyint(1) DEFAULT 1,
  `about_gram_viewown` tinyint(1) DEFAULT 1,
  `about_gram_viewall` tinyint(1) DEFAULT 1,
  `about_gram_print` tinyint(1) DEFAULT 1,
  `population_add` tinyint(1) DEFAULT 1,
  `population_edit` tinyint(1) DEFAULT 1,
  `population_delete` tinyint(1) DEFAULT 1,
  `population_viewown` tinyint(1) DEFAULT 1,
  `population_viewall` tinyint(1) DEFAULT 1,
  `population_print` tinyint(1) DEFAULT 1,
  `gram_bill_add` tinyint(1) DEFAULT 1,
  `gram_bill_edit` tinyint(1) DEFAULT 1,
  `gram_bill_delete` tinyint(1) DEFAULT 1,
  `gram_bill_viewown` tinyint(1) DEFAULT 1,
  `gram_bill_viewall` tinyint(1) DEFAULT 1,
  `gram_bill_print` tinyint(1) DEFAULT 1,
  `gram_annual_add` tinyint(1) DEFAULT 1,
  `gram_annual_edit` tinyint(1) DEFAULT 1,
  `gram_annual_delete` tinyint(1) DEFAULT 1,
  `gram_annual_viewown` tinyint(1) DEFAULT 1,
  `gram_annual_viewall` tinyint(1) DEFAULT 1,
  `gram_annual_print` tinyint(1) DEFAULT 1,
  `dash_pending_taxation_user` tinyint(1) DEFAULT 1,
  `dash_pending_water_user` tinyint(1) DEFAULT 1,
  `paid_annual_m_gram` tinyint(1) DEFAULT 1,
  `pending_annual_m_gram` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `m_cat_viewown`, `m_cat_viewall`, `m_cat_edit`, `m_cat_delete`, `m_cat_add`, `m_taluka_add`, `m_taluka_edit`, `m_taluka_delete`, `m_taluka_viewown`, `m_taluka_viewall`, `m_gram_add`, `m_gram_edit`, `m_gram_delete`, `m_gram_viewown`, `m_gram_viewall`, `registered_gram_add`, `registered_gram_edit`, `registered_gram_delete`, `registered_gram_viewown`, `registered_gram_viewall`, `registered_gram_print`, `manage_user_add`, `manage_user_edit`, `manage_user_delete`, `manage_user_viewown`, `manage_user_viewall`, `p_w_bill_add`, `p_w_bill_edit`, `p_w_bill_delete`, `p_w_bill_viewown`, `p_w_bill_viewall`, `p_w_bill_print`, `about_gram_add`, `about_gram_edit`, `about_gram_delete`, `about_gram_viewown`, `about_gram_viewall`, `about_gram_print`, `population_add`, `population_edit`, `population_delete`, `population_viewown`, `population_viewall`, `population_print`, `gram_bill_add`, `gram_bill_edit`, `gram_bill_delete`, `gram_bill_viewown`, `gram_bill_viewall`, `gram_bill_print`, `gram_annual_add`, `gram_annual_edit`, `gram_annual_delete`, `gram_annual_viewown`, `gram_annual_viewall`, `gram_annual_print`, `dash_pending_taxation_user`, `dash_pending_water_user`, `paid_annual_m_gram`, `pending_annual_m_gram`, `created_at`, `updated_at`) VALUES
(1, 'Public', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, '2024-12-24 07:11:00', '2024-12-24 07:11:40'),
(2, 'Gram Member', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, '2024-12-24 07:11:00', '2024-12-24 07:47:19'),
(3, 'Gram Member Head', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, '2024-12-24 07:46:50', '2024-12-24 07:46:50'),
(4, 'Gram clerk', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 2, 1, 1, 2, 1, 2, 2, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, '2024-12-24 09:11:56', '2024-12-24 09:11:56'),
(5, 'Gram Development Officer', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 1, 2, 1, 2, 1, 1, 2, 1, 2, 2, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, '2024-12-24 09:11:56', '2025-01-08 07:18:17'),
(6, 'Taluka Head Officer', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, '2024-12-24 09:11:56', '2024-12-24 09:11:56'),
(7, 'Dist. Head Officer', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, '2024-12-24 09:11:56', '2024-12-24 09:11:56'),
(8, 'State Head Officer', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, '2024-12-24 09:11:56', '2025-01-08 10:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `talukas`
--

CREATE TABLE `talukas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) NOT NULL,
  `district` varchar(191) NOT NULL,
  `taluka_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `talukas`
--

INSERT INTO `talukas` (`id`, `state`, `district`, `taluka_name`, `created_at`, `updated_at`) VALUES
(1, 'Maharashtra', 'Kolhapur', 'कागल', '2025-01-07 19:21:35', '2025-01-07 19:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_admin` varchar(5) NOT NULL DEFAULT 'user',
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `taluka` varchar(255) DEFAULT NULL,
  `gram` varchar(255) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `gate_no` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `land_area` varchar(255) DEFAULT NULL,
  `farm_area` varchar(255) DEFAULT NULL,
  `gharpatti_annual` decimal(10,2) DEFAULT NULL,
  `home_type` varchar(255) DEFAULT NULL,
  `panipatti_annual` decimal(10,2) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `otp` varchar(4) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `is_admin`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`, `state`, `district`, `taluka`, `gram`, `contact_no`, `gate_no`, `profile_pic`, `gender`, `dob`, `age`, `land_area`, `farm_area`, `gharpatti_annual`, `home_type`, `panipatti_annual`, `user_type`, `otp`, `otp_expires_at`) VALUES
(1, 'admin', 'Super Admin', 'admin@egramofficial.in', NULL, '$2y$10$.4VR/JYR/Pp4G.5vZYx1deDvwWj3WinjaH8rwwJwcIEKbx9QW3mSC', 'avatar-1.jpg', NULL, '2024-11-27 03:16:52', '2025-01-09 13:23:41', 'Andhra Pradesh', 'Anantapur', NULL, NULL, '0000000000', '0', 'profile_pics/lv7CSGb2jpVXUMEsZMvfGZvYpFCsQZ2SydNoAThM.jpg', 'Male', '2025-01-07', 0, '0', 'flat', 100000.00, 'Plot', 120000.00, 'admin', '8948', '2025-01-09 13:24:41'),
(25, 'user', 'ग्रामसेवक कापशी', NULL, NULL, NULL, NULL, NULL, '2025-01-07 19:34:20', '2025-01-15 18:05:59', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '8975560202', '0', 'profile_pics/rMc7OewMJW2YDHmkrOHNJmytFgtDjtybtXcxFlla.jpg', 'Male', '2025-01-07', 0, '0', '0', 0.00, '0', 0.00, '5', NULL, NULL),
(26, 'user', 'Public कापशी', NULL, NULL, NULL, NULL, NULL, '2025-01-07 19:38:27', '2025-01-08 12:30:24', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '0000000000', '0', 'profile_pics/JhmoM56ta3fZxYV072Y6pVQtEX01ZVBVcf6CiMt7.png', 'Male', '2025-01-07', 22, '458SKF', '5684SKF', 1000.00, '3BHK Flat', 500.00, '1', NULL, NULL),
(27, 'user', 'Gram Member कापशी', NULL, NULL, NULL, NULL, NULL, '2025-01-07 19:39:13', '2025-01-08 12:31:27', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '000000000', '0', 'profile_pics/MMTnRfKXXnZoV9Upt0W8lv5Ys1FT9f48mFHkfmW3.png', 'Male', '2025-01-07', 22, '458SKF', '5684SKF', 1000.00, '3BHK Flat', 500.00, '2', NULL, NULL),
(28, 'user', 'Gram Member He\'d कापशी', NULL, NULL, NULL, NULL, NULL, '2025-01-07 19:39:51', '2025-01-08 12:32:44', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '0000000000', '0', 'profile_pics/0kf59hZxUrSRZdjadjDiHzTmCEwnFu43sgqPWJU5.png', 'Male', '2025-01-07', 22, '458SKF', '5684SKF', 1000.00, '3BHK Flat', 500.00, '3', NULL, NULL),
(29, 'user', 'Gram Clark कापशी', NULL, NULL, NULL, NULL, NULL, '2025-01-07 19:40:31', '2025-01-08 12:38:29', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '000000000', '0', 'profile_pics/JFbV9N0ErnYL3kl2mKi5yFAfTojVEBHa486faxsi.png', 'Male', '2025-01-07', 22, '458SKF', '5684SKF', 1000.00, '3BHK Flat', 500.00, '4', NULL, NULL),
(30, 'user', 'Taluka Hed Officer कापशी', NULL, NULL, NULL, NULL, NULL, '2025-01-07 19:41:14', '2025-01-08 12:46:35', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '0000000000', '0', 'profile_pics/bBLVn1ZlAyhWm47wM6x7vHyKSVhQMU6uEhQdmhVT.png', 'Male', '2025-01-07', 22, '458SKF', '5684SKF', 1000.00, '3BHK Flat', 500.00, '6', NULL, NULL),
(31, 'user', 'Dits Hed Officer कापशी', NULL, NULL, NULL, NULL, NULL, '2025-01-07 19:42:32', '2025-01-07 19:42:32', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '0000000000', '0', 'profile_pics/r6Tz8tsCnlF0fyh8g4LNcgQADKPnIxWj0VePjFhZ.png', 'Male', '2025-01-07', 22, '458SKF', '5684SKF', 1000.00, '3BHK Flat', 500.00, '7', NULL, NULL),
(32, 'user', 'State Hed Officer कापशी', NULL, NULL, NULL, NULL, NULL, '2025-01-07 19:43:07', '2025-01-07 19:43:07', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '0000000000', '0', 'profile_pics/rZDEzdHuodgIHiVnZ4hR6wRrmbflcx1oqDyHiMOY.png', 'Male', '2025-01-07', 22, '458SKF', '5684SKF', 1000.00, '3BHK Flat', 500.00, '8', NULL, NULL),
(33, 'user', 'TUSHAR  SURYAWANSHI  MANAGEMENT', NULL, NULL, NULL, NULL, NULL, '2025-01-09 12:59:46', '2025-01-15 20:10:27', 'Maharashtra', 'Kolhapur', 'कागल', 'ग्रामपंचायत कापशी', '8888888888', 'na', 'profile_pics/Zb0vEV2K5sUiCIFbAHiFqBtrOl2brSTyOdwsGHSx.png', 'Male', '2025-01-09', 0, '0', '0', 0.00, '0', 0.00, '5', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_grams`
--
ALTER TABLE `about_grams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `annual_maintenances`
--
ALTER TABLE `annual_maintenances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gharpatti_panipattis`
--
ALTER TABLE `gharpatti_panipattis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grams`
--
ALTER TABLE `grams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gram_bills`
--
ALTER TABLE `gram_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `populations`
--
ALTER TABLE `populations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_to_grams`
--
ALTER TABLE `register_to_grams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `talukas`
--
ALTER TABLE `talukas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_grams`
--
ALTER TABLE `about_grams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `annual_maintenances`
--
ALTER TABLE `annual_maintenances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `gharpatti_panipattis`
--
ALTER TABLE `gharpatti_panipattis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grams`
--
ALTER TABLE `grams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gram_bills`
--
ALTER TABLE `gram_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `populations`
--
ALTER TABLE `populations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `register_to_grams`
--
ALTER TABLE `register_to_grams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `talukas`
--
ALTER TABLE `talukas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
