-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2025 at 01:05 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `actthgku_general-register`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_grams`
--

CREATE TABLE `about_grams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_gram` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `annual_maintenances`
--

CREATE TABLE `annual_maintenances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maintenance_year` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maintenance_amount` decimal(15,2) NOT NULL,
  `remaining_amount` decimal(15,2) NOT NULL,
  `payment_mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `current_population` int(11) DEFAULT NULL,
  `bill_status` enum('pending','complete') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bonafids`
--

CREATE TABLE `bonafids` (
  `id` bigint(20) NOT NULL,
  `state` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `taluka` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `school_name` bigint(20) UNSIGNED NOT NULL,
  `school_address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `student_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `general_register_number` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `caste` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `birth_in_text` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `birth_place` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `birth_place_taluka` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `birth_place_dist` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `certificate_issued_date` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `principal_signature` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bonafids`
--

INSERT INTO `bonafids` (`id`, `state`, `district`, `taluka`, `school_name`, `school_address`, `student_name`, `general_register_number`, `religion`, `caste`, `dob`, `birth_in_text`, `birth_place`, `birth_place_taluka`, `birth_place_dist`, `certificate_issued_date`, `principal_signature`, `created_at`, `updated_at`) VALUES
(3, 'Maharashtra', 'Kolhapur', 'कागल', 2, 'Kolhapur', 'Yogesh Jharbade', '00012345', 'Hindu', 'SC', '1997-03-03', 'three March one thousand ninety-seven', 'Betul', 'Ghoradongri', 'Betul', '2025-02-01', NULL, '2025-02-01 06:44:33', '2025-02-01 06:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'testing', '2025-02-05 11:01:57', '2025-02-05 11:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_to_gram_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `path`, `original_file_name`, `register_to_gram_id`, `created_at`, `updated_at`) VALUES
(1, 'uploads/Maharashtra/Kolhapur/कागल/2/test_hindi_pdf (6).pdf', 'test_hindi_pdf (6).pdf', 1, '2025-02-05 11:02:40', '2025-02-05 11:02:40'),
(2, 'uploads/Maharashtra/Kolhapur/कागल/2/test_hindi_pdf (7).pdf', 'test_hindi_pdf (7).pdf', 1, '2025-02-05 11:02:40', '2025-02-05 11:02:40'),
(3, 'uploads/Maharashtra/Kolhapur/कागल/2/test_hindi_pdf (8).pdf', 'test_hindi_pdf (8).pdf', 1, '2025-02-05 11:02:40', '2025-02-05 11:02:40'),
(4, 'uploads/Maharashtra/Kolhapur/कागल/2/test_hindi_pdf (9).pdf', 'test_hindi_pdf (9).pdf', 1, '2025-02-05 11:02:40', '2025-02-05 11:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `gharpatti_panipattis`
--

CREATE TABLE `gharpatti_panipattis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('gharpatti','panipatti') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_type` enum('cash','online','rtgs','check') COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `paid_date` datetime NOT NULL,
  `remaining_amount` decimal(10,2) DEFAULT NULL,
  `send_bill` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grams`
--

CREATE TABLE `grams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gram_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taluka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_contact_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_gmail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_gram_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_management` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_udash_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_board` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_details_id` json NOT NULL,
  `principal_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principal_type` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principle_whatsapp_no` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clerk_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clerk_whatspp_no` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grams`
--

INSERT INTO `grams` (`id`, `gram_name`, `school_logo`, `created_at`, `updated_at`, `state`, `district`, `taluka`, `address`, `pin_code`, `school_contact_no`, `school_gmail`, `school_gram_no`, `school_management`, `school_level`, `school_udash_no`, `school_board`, `school_details_id`, `principal_name`, `principal_type`, `principle_whatsapp_no`, `clerk_name`, `clerk_whatspp_no`) VALUES
(2, 'Govt Exc H S School', 'assets/school-logo/Maharashtra/Kolhapur/कागल/subahsh-schoool/1738230908_th.jpg', '2025-01-22 07:23:02', '2025-01-22 07:25:14', 'Maharashtra', 'Kolhapur', 'कागल', 'hn 4 , narendra nagar ,berkheda pathani , bhopal', '543235', '9876543212', 'school@gmail.com', '9876543212', 'Board of education Bhopal', 'Higher', '12121', 'Yes', '0', '', '', '', '', ''),
(3, 'djkd', NULL, '2025-01-27 11:30:56', '2025-01-30 11:09:22', 'Maharashtra', 'Kolhapur', 'कागल', 'hn 4 , narendra nagar ,berkheda pathani , bhopal', '462022', '8736735633', NULL, '8', 'd', NULL, '12345678', '378', '[62]', 'd', 'djk', '1234567891', 'djd', '8746122345'),
(5, 'Govt subhash hr sec excellence school', 'assets/school-logo/Maharashtra/Kolhapur/कागल/subahsh-schoool/1738230908_th.jpg', '2025-01-28 04:50:47', '2025-01-30 08:33:01', 'Maharashtra', 'Kolhapur', 'कागल', 'bhopal', '462022', '1234567898', 'subhash@gmail.com', '4', 'dk', 'djkd', '844847', 'MP board', '[43]', 'k', 'sjk', '23456898733', 'jk', '7891234560'),
(10, 'subahsh schoool', 'assets/school-logo/Maharashtra/Kolhapur/कागल/subahsh-schoool/1738237904_LuckyNumber2.jpg', '2025-01-30 08:59:41', '2025-01-30 11:56:48', 'Maharashtra', 'Kolhapur', 'कागल', 'hn 4 , narendr bhopal', '462022', NULL, 'djdhggfd@gmail.com', '87', '98', '8', '87675', 'jhj', '[88, 89, 90]', 'dj', 'dk', '9876543209', 'djkdj', '9876543234');

-- --------------------------------------------------------

--
-- Table structure for table `gram_bills`
--

CREATE TABLE `gram_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `population` int(10) UNSIGNED NOT NULL,
  `first_time_bill_amount` decimal(10,2) DEFAULT NULL,
  `paid_amount` int(255) NOT NULL DEFAULT '0',
  `quatation_date` date DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_amount` decimal(10,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `payment_mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_maintenance_date` date DEFAULT NULL,
  `bill_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lcs`
--

CREATE TABLE `lcs` (
  `id` int(11) NOT NULL,
  `certificate_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taluka` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gram` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `other_studies` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `adhar_number` bigint(12) DEFAULT NULL,
  `student_first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_middle_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_last_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mother_tongue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caste` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_caste` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_place_taluka` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_place_dist` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_place_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_place_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `birth_in_text` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `previous_school` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `standard` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_admission` date DEFAULT NULL,
  `academic_progress` text COLLATE utf8_unicode_ci,
  `behavior` text COLLATE utf8_unicode_ci,
  `date_of_leaving_school` text COLLATE utf8_unicode_ci,
  `reason_for_leaving_school` text COLLATE utf8_unicode_ci,
  `comments` text COLLATE utf8_unicode_ci,
  `certificate_date` int(11) DEFAULT NULL,
  `certificate_month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `certificate_year` int(11) DEFAULT NULL,
  `teacher_signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `writer_signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `principal_signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lcs`
--

INSERT INTO `lcs` (`id`, `certificate_no`, `state`, `district`, `taluka`, `gram`, `student_id`, `other_studies`, `adhar_number`, `student_first_name`, `student_middle_name`, `student_last_name`, `mother_name`, `nationality`, `mother_tongue`, `religion`, `caste`, `sub_caste`, `birth_place`, `birth_place_taluka`, `birth_place_dist`, `birth_place_state`, `birth_place_country`, `dob`, `birth_in_text`, `previous_school`, `standard`, `date_of_admission`, `academic_progress`, `behavior`, `date_of_leaving_school`, `reason_for_leaving_school`, `comments`, `certificate_date`, `certificate_month`, `certificate_year`, `teacher_signature`, `writer_signature`, `principal_signature`, `created_at`, `updated_at`) VALUES
(4, '0001', 'Maharashtra', 'Kolhapur', 'कागल', 2, 789655, 'India', 123456789017, 'Tushar', 'Sudam', 'Suryawanshi', 'India', 'India', 'India', 'India', 'म्हणून', 'India', 'Sangli', 'India', 'India', 'India', 'India', '2025-01-01', 'one January two thousand twenty-five', 'India', 'India', '2025-01-15', 'India', 'India', 'India', 'India', 'India', 19, '12', 2019, NULL, NULL, NULL, '2025-01-29 15:55:15', '2025-01-31 13:37:29'),
(5, '0002', 'Maharashtra', 'Kolhapur', 'कागल', 2, 14257785, 'चांगली आहे', 145632789546, 'सौरभ', 'भालचंद्र', 'कदम', 'सविता', 'भारत', 'मराठी', 'हिंदू', 'मराठा', 'मराठा', 'सांगली', 'सातारा', 'सातारा', 'महाराष्ट्र', 'भारत', '2025-01-28', 'twenty-eight January two thousand twenty-five', 'विद्या मंदिर शिग्नापूर करवीर तालुका', '५ वी ब', '2025-01-23', 'चांगली आहे', 'चांगली आहे', 'पुढील शिक्षणासाठी शाळा बदल', 'चांगली आहे', 'चांगली आहे', 16, '11', 2025, NULL, NULL, NULL, '2025-01-31 13:42:08', '2025-01-31 13:42:08');

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
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `population` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `confirm_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register_to_grams`
--

CREATE TABLE `register_to_grams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_to_grams`
--

INSERT INTO `register_to_grams` (`id`, `state`, `district`, `taluka`, `gram`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Maharashtra', 'Kolhapur', 'कागल', '2', 'testing', '2025-02-05 11:02:39', '2025-02-05 11:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_cat_viewown` tinyint(1) DEFAULT '1',
  `m_cat_viewall` tinyint(1) DEFAULT '1',
  `m_cat_edit` tinyint(1) DEFAULT '1',
  `m_cat_delete` tinyint(1) DEFAULT '1',
  `m_cat_add` tinyint(1) DEFAULT '1',
  `m_taluka_add` tinyint(1) DEFAULT '1',
  `m_taluka_edit` tinyint(1) DEFAULT '1',
  `m_taluka_delete` tinyint(1) DEFAULT '1',
  `m_taluka_viewown` tinyint(1) DEFAULT '1',
  `m_taluka_viewall` tinyint(1) DEFAULT '1',
  `m_gram_add` tinyint(1) DEFAULT '1',
  `m_gram_edit` tinyint(1) DEFAULT '1',
  `m_gram_delete` tinyint(1) DEFAULT '1',
  `m_gram_viewown` tinyint(1) DEFAULT '1',
  `m_gram_viewall` tinyint(1) DEFAULT '1',
  `registered_gram_add` tinyint(1) DEFAULT '1',
  `registered_gram_edit` tinyint(1) DEFAULT '1',
  `registered_gram_delete` tinyint(1) DEFAULT '1',
  `registered_gram_viewown` tinyint(1) DEFAULT '1',
  `registered_gram_viewall` tinyint(1) DEFAULT '1',
  `registered_gram_print` tinyint(11) NOT NULL DEFAULT '1',
  `manage_user_add` tinyint(1) DEFAULT '1',
  `manage_user_edit` tinyint(1) DEFAULT '1',
  `manage_user_delete` tinyint(1) DEFAULT '1',
  `manage_user_viewown` tinyint(1) DEFAULT '1',
  `manage_user_viewall` tinyint(1) DEFAULT '1',
  `p_w_bill_add` tinyint(1) DEFAULT '1',
  `p_w_bill_edit` tinyint(1) DEFAULT '1',
  `p_w_bill_delete` tinyint(1) DEFAULT '1',
  `p_w_bill_viewown` tinyint(1) DEFAULT '1',
  `p_w_bill_viewall` tinyint(1) DEFAULT '1',
  `p_w_bill_print` tinyint(1) DEFAULT '1',
  `about_gram_add` tinyint(1) DEFAULT '1',
  `about_gram_edit` tinyint(1) DEFAULT '1',
  `about_gram_delete` tinyint(1) DEFAULT '1',
  `about_gram_viewown` tinyint(1) DEFAULT '1',
  `about_gram_viewall` tinyint(1) DEFAULT '1',
  `about_gram_print` tinyint(1) DEFAULT '1',
  `population_add` tinyint(1) DEFAULT '1',
  `population_edit` tinyint(1) DEFAULT '1',
  `population_delete` tinyint(1) DEFAULT '1',
  `population_viewown` tinyint(1) DEFAULT '1',
  `population_viewall` tinyint(1) DEFAULT '1',
  `population_print` tinyint(1) DEFAULT '1',
  `gram_bill_add` tinyint(1) DEFAULT '1',
  `gram_bill_edit` tinyint(1) DEFAULT '1',
  `gram_bill_delete` tinyint(1) DEFAULT '1',
  `gram_bill_viewown` tinyint(1) DEFAULT '1',
  `gram_bill_viewall` tinyint(1) DEFAULT '1',
  `gram_bill_print` tinyint(1) DEFAULT '1',
  `gram_annual_add` tinyint(1) DEFAULT '1',
  `gram_annual_edit` tinyint(1) DEFAULT '1',
  `gram_annual_delete` tinyint(1) DEFAULT '1',
  `gram_annual_viewown` tinyint(1) DEFAULT '1',
  `gram_annual_viewall` tinyint(1) DEFAULT '1',
  `gram_annual_print` tinyint(1) DEFAULT '1',
  `dash_pending_taxation_user` tinyint(1) DEFAULT '1',
  `dash_pending_water_user` tinyint(1) DEFAULT '1',
  `paid_annual_m_gram` tinyint(1) DEFAULT '1',
  `pending_annual_m_gram` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for table `school_details`
--

CREATE TABLE `school_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `class_teacher_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `whatsapp_no` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `school_details`
--

INSERT INTO `school_details` (`id`, `class_name`, `class_teacher_name`, `whatsapp_no`, `created_at`, `updated_at`) VALUES
(1, 'nd', 'd,', '378377373', '2025-01-27 11:14:56', '2025-01-27 11:14:56'),
(2, 'sjk', 'sk38', '383367733', '2025-01-27 11:14:56', '2025-01-27 11:14:56'),
(3, 'djddjkd', 'djk', '89336333633', '2025-01-27 11:29:44', '2025-01-27 11:29:44'),
(4, 'djddjkd', 'djk', '89336333633', '2025-01-27 11:30:06', '2025-01-27 11:30:06'),
(5, 'djddjkd', 'djk', '89336333633', '2025-01-27 11:30:16', '2025-01-27 11:30:16'),
(6, 'djddjkd', 'djk', '89336333633', '2025-01-27 11:30:56', '2025-01-27 11:30:56'),
(7, 'dkj', 'd', '383533', '2025-01-27 11:32:53', '2025-01-27 11:32:53'),
(8, 'djk', 'dj', '38733563', '2025-01-27 11:32:53', '2025-01-27 11:32:53'),
(9, 'GFJS', 'SRGJDH', '1234567890', '2025-01-27 13:16:30', '2025-01-27 13:16:30'),
(10, 'RTUJREYRE8553', '57657FSDFG', '1234567890', '2025-01-27 13:16:30', '2025-01-27 13:16:30'),
(11, '57FSDFG', 'E8553', '1234567897', '2025-01-27 13:16:30', '2025-01-27 13:16:30'),
(12, 'GFJS', 'SRGJDH', '1234567890', '2025-01-27 13:16:47', '2025-01-27 13:16:47'),
(13, 'RTUJREYRE8553', '57657FSDFG', '1234567890', '2025-01-27 13:16:47', '2025-01-27 13:16:47'),
(14, '57FSDFG', 'E8553', '1234567897', '2025-01-27 13:16:47', '2025-01-27 13:16:47'),
(15, 'djddjkd', 'djk', '89336333633', '2025-01-28 04:27:41', '2025-01-28 04:27:41'),
(16, 'djkdjk', 'djkd', '1234567891', '2025-01-28 04:27:41', '2025-01-28 04:27:41'),
(17, 'djddjkd', 'djk', '89336333633', '2025-01-28 04:37:56', '2025-01-28 04:37:56'),
(18, 'djkdjk', 'djkd', '1234567891', '2025-01-28 04:37:56', '2025-01-28 04:37:56'),
(19, 'djddjkd', 'djk', '89336333633', '2025-01-28 04:44:02', '2025-01-28 04:44:02'),
(20, 'djkdjk', 'djkd', '1234567891', '2025-01-28 04:44:02', '2025-01-28 04:44:02'),
(21, 'nd', 'd,', '9876543212', '2025-01-28 04:50:47', '2025-01-28 04:50:47'),
(22, 'nd', 'd,', '987654383783212', '2025-01-28 04:51:06', '2025-01-28 04:51:06'),
(23, 'nd', 'd,', '988333567654383783212', '2025-01-28 04:51:14', '2025-01-28 04:51:14'),
(24, 'nd', 'd,', '988333567654383783212', '2025-01-28 04:52:11', '2025-01-28 04:52:11'),
(25, 'nd', 'd,', '988333567654383783212', '2025-01-28 04:55:49', '2025-01-28 04:55:49'),
(26, 'nd', 'd,', '3878373', '2025-01-28 05:19:14', '2025-01-28 05:19:14'),
(27, 'nd', 'd,', '3878373', '2025-01-28 06:15:04', '2025-01-28 06:15:04'),
(28, 'djddjkd', 'djk', '89336333633', '2025-01-28 06:15:49', '2025-01-28 06:15:49'),
(29, 'djkdjk', 'djkd', '1234567891', '2025-01-28 06:15:49', '2025-01-28 06:15:49'),
(30, 'nd', 'd,', '3878373', '2025-01-28 06:19:31', '2025-01-28 06:19:31'),
(31, 'nd', 'd,', '3878373', '2025-01-28 06:41:46', '2025-01-28 06:41:46'),
(32, 'nd', 'd,', '387837773', '2025-01-28 06:44:08', '2025-01-28 06:44:08'),
(33, 'nd', 'd,', '3878377739', '2025-01-30 05:39:02', '2025-01-30 05:39:02'),
(34, 'nd', 'd,', '3878377739', '2025-01-30 05:44:14', '2025-01-30 05:44:14'),
(35, 'djddjkd', 'djk', '89336333633', '2025-01-30 06:06:37', '2025-01-30 06:06:37'),
(36, 'djkdjk', 'djkd', '1234567891', '2025-01-30 06:06:37', '2025-01-30 06:06:37'),
(37, 'nd', 'd,', '3878377739', '2025-01-30 06:23:35', '2025-01-30 06:23:35'),
(38, 'djddjkd', 'djk', '89336333633', '2025-01-30 06:33:58', '2025-01-30 06:33:58'),
(39, 'djkdjk', 'djkd', '1234567891', '2025-01-30 06:33:58', '2025-01-30 06:33:58'),
(40, 'djddjkd', 'djk', '89336333633', '2025-01-30 06:51:16', '2025-01-30 06:51:16'),
(41, 'djkdjk', 'djkd', '1234567891', '2025-01-30 06:51:16', '2025-01-30 06:51:16'),
(42, 'jj', 'sush', '12345678912', '2025-01-30 06:51:16', '2025-01-30 06:51:16'),
(43, 'nd', 'd,', '3878377739', '2025-01-30 08:33:01', '2025-01-30 08:33:01'),
(44, 'kdj', 'sk', '98765432123', '2025-01-30 08:46:18', '2025-01-30 08:46:18'),
(45, 'kjddjk', 'djk', '12349876545', '2025-01-30 08:49:14', '2025-01-30 08:49:14'),
(46, 'kjddjk', 'djk', '12349876545', '2025-01-30 08:49:27', '2025-01-30 08:49:27'),
(47, 'jkd', 'djk', '8976543214', '2025-01-30 08:53:31', '2025-01-30 08:53:31'),
(48, 'jkd', 'djk', '8976543214', '2025-01-30 08:53:47', '2025-01-30 08:53:47'),
(49, 'jkd', 'sjk', '9876543267', '2025-01-30 08:56:05', '2025-01-30 08:56:05'),
(50, 'dkjdk', 'djk', '9876543256', '2025-01-30 08:59:29', '2025-01-30 08:59:29'),
(51, 'dkjdk', 'djk', '9876543256', '2025-01-30 08:59:41', '2025-01-30 08:59:41'),
(52, 'dkjdk', 'djk', '9876543256', '2025-01-30 09:18:22', '2025-01-30 09:18:22'),
(53, 'dkjdk', 'djk', '9876543256', '2025-01-30 09:18:25', '2025-01-30 09:18:25'),
(54, 'dkjdk', 'djk', '9876543256', '2025-01-30 09:18:32', '2025-01-30 09:18:32'),
(55, 'dkjdk', 'djk', '9876543256', '2025-01-30 09:38:11', '2025-01-30 09:38:11'),
(56, 'dkjdk', 'djk', '9876543256', '2025-01-30 09:47:44', '2025-01-30 09:47:44'),
(57, 'dkjdk', 'djk', '9876543256', '2025-01-30 09:47:46', '2025-01-30 09:47:46'),
(58, 'dkjdk', 'djk', '9876543256', '2025-01-30 09:47:49', '2025-01-30 09:47:49'),
(59, 'dkjdk', 'djk', '9876543256', '2025-01-30 09:48:18', '2025-01-30 09:48:18'),
(60, 'dkjdk', 'djk', '9876543256', '2025-01-30 09:48:29', '2025-01-30 09:48:29'),
(61, 'dkjdk', 'djk', '9876543256', '2025-01-30 09:55:08', '2025-01-30 09:55:08'),
(62, 'djddjkd', 'djk', '89336333633', '2025-01-30 11:09:22', '2025-01-30 11:09:22'),
(63, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:10:07', '2025-01-30 11:10:07'),
(64, 'kdk', 'djkd', '9876543212', '2025-01-30 11:10:07', '2025-01-30 11:10:07'),
(65, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:10:44', '2025-01-30 11:10:44'),
(66, 'kdk', 'djkd', '9876543212', '2025-01-30 11:10:44', '2025-01-30 11:10:44'),
(67, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:11:11', '2025-01-30 11:11:11'),
(68, 'kdk', 'djkd', '9876543212', '2025-01-30 11:11:11', '2025-01-30 11:11:11'),
(69, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:12:55', '2025-01-30 11:12:55'),
(70, 'kdk', 'djkd', '9876543212', '2025-01-30 11:12:55', '2025-01-30 11:12:55'),
(71, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:26:48', '2025-01-30 11:26:48'),
(72, 'kdk', 'djkd', '9876543212', '2025-01-30 11:26:48', '2025-01-30 11:26:48'),
(73, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:38:35', '2025-01-30 11:38:35'),
(74, 'kdk', 'djkd', '9876543212', '2025-01-30 11:38:35', '2025-01-30 11:38:35'),
(75, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:38:50', '2025-01-30 11:38:50'),
(76, 'kdk', 'djkd', '9876543212', '2025-01-30 11:38:50', '2025-01-30 11:38:50'),
(77, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:48:29', '2025-01-30 11:48:29'),
(78, 'kdk', 'djkd', '9876543212', '2025-01-30 11:48:29', '2025-01-30 11:48:29'),
(79, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:48:42', '2025-01-30 11:48:42'),
(80, 'kdk', 'djkd', '9876543212', '2025-01-30 11:48:42', '2025-01-30 11:48:42'),
(81, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:51:26', '2025-01-30 11:51:26'),
(82, 'kdk', 'djkd', '9876543212', '2025-01-30 11:51:26', '2025-01-30 11:51:26'),
(83, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:51:44', '2025-01-30 11:51:44'),
(84, 'kdk', 'djkd', '9876543212', '2025-01-30 11:51:44', '2025-01-30 11:51:44'),
(85, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:52:38', '2025-01-30 11:52:38'),
(86, 'kdk', 'djkd', '9876543212', '2025-01-30 11:52:38', '2025-01-30 11:52:38'),
(87, 'jghf', 'hghfd', '9876543216', '2025-01-30 11:52:38', '2025-01-30 11:52:38'),
(88, 'dkjdk', 'djk', '9876543256', '2025-01-30 11:56:48', '2025-01-30 11:56:48'),
(89, 'kdk', 'djkd', '9876543212', '2025-01-30 11:56:48', '2025-01-30 11:56:48'),
(90, 'jghf', 'hghfd', '9876543216', '2025-01-30 11:56:48', '2025-01-30 11:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `talukas`
--

CREATE TABLE `talukas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taluka_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `is_admin` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taluka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `is_admin`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`, `state`, `district`, `taluka`, `gram`, `contact_no`, `profile_pic`, `gender`, `dob`, `age`, `user_type`, `otp`, `otp_expires_at`) VALUES
(1, 'admin', 'Super Admin', 'admin@egramofficial.in', NULL, '$2y$10$.4VR/JYR/Pp4G.5vZYx1deDvwWj3WinjaH8rwwJwcIEKbx9QW3mSC', 'avatar-1.jpg', NULL, '2024-11-27 03:16:52', '2025-02-05 10:58:01', 'Andhra Pradesh', 'Anantapur', NULL, NULL, '0000000000', 'profile_pics/m9aScRBwT7WckjFaXMbDgcsATQX10pFqOvwKTqGJ.jpg', 'Male', '2025-01-07', 0, 'admin', '8948', '2025-01-09 13:24:41'),
(35, 'user', 'njsdn', 'actt@gmail.com', NULL, NULL, NULL, NULL, '2025-01-29 11:50:59', '2025-02-05 09:19:13', 'Maharashtra', 'Kolhapur', 'कागल', '2', '9131323213', 'profile_pics/67a32d10cc720-WhatsApp Image 2025-02-05 at 1.27.22 PM.jpeg', 'Male', '2025-01-29', 12, '1', NULL, NULL),
(36, 'user', 'Yogii', 'yoggi@egra.com', NULL, NULL, NULL, NULL, '2025-02-05 09:21:58', '2025-02-05 09:32:22', 'Maharashtra', 'Kolhapur', 'कागल', '5', '8602538690', 'profile_pics/sBqqtx7RVeDHDVhrQa8W6JwS0pe0zbQdFJ6BfrTx.jpg', 'Male', '2025-02-05', 26, '1', NULL, NULL);

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
-- Indexes for table `bonafids`
--
ALTER TABLE `bonafids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_name`);

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
-- Indexes for table `lcs`
--
ALTER TABLE `lcs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_nammee` (`gram`);

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
-- Indexes for table `school_details`
--
ALTER TABLE `school_details`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `annual_maintenances`
--
ALTER TABLE `annual_maintenances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bonafids`
--
ALTER TABLE `bonafids`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gharpatti_panipattis`
--
ALTER TABLE `gharpatti_panipattis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grams`
--
ALTER TABLE `grams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gram_bills`
--
ALTER TABLE `gram_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lcs`
--
ALTER TABLE `lcs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register_to_grams`
--
ALTER TABLE `register_to_grams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `school_details`
--
ALTER TABLE `school_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `talukas`
--
ALTER TABLE `talukas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bonafids`
--
ALTER TABLE `bonafids`
  ADD CONSTRAINT `school_id` FOREIGN KEY (`school_name`) REFERENCES `grams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lcs`
--
ALTER TABLE `lcs`
  ADD CONSTRAINT `school_nammee` FOREIGN KEY (`gram`) REFERENCES `grams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
