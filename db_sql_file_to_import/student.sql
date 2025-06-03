-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 06:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `academics`
--

CREATE TABLE `academics` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academics`
--

INSERT INTO `academics` (`id`, `name`) VALUES
(1, '2021-2022'),
(2, '2022-2023'),
(3, '2023-2024'),
(4, '2024-2025'),
(5, '2025-2026');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'India', NULL, NULL),
(2, 'United States', '2025-03-24 09:11:10', '2025-03-24 09:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `year_of_course` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `degrees`
--

INSERT INTO `degrees` (`id`, `name`, `year_of_course`, `created_at`, `updated_at`) VALUES
(1, 'Bachelor', 4, '2025-03-24 09:23:13', '2025-03-24 09:23:13'),
(2, 'Secondary', 1, '2025-03-24 09:08:00', '2025-03-24 09:08:00'),
(3, 'Higher Secondary', 2, '2025-03-24 09:09:00', '2025-03-24 09:09:00'),
(4, 'Masters', 2, '2025-03-24 09:09:00', '2025-03-24 09:09:00'),
(5, 'PHD', 5, '2025-03-24 09:10:00', '2025-03-24 09:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `state_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'North 24 Parganas', '2025-03-24 09:17:41', '2025-03-24 09:17:41'),
(2, 1, 'Kolkata', '2025-03-24 09:16:14', '2025-03-24 09:16:14'),
(3, 1, 'Howrah', '2025-03-24 09:16:14', '2025-03-24 09:16:14'),
(4, 1, 'darjeeling', '2025-03-24 09:16:14', '2025-03-24 09:16:14'),
(9, 2, 'Thiruvananthapuram', '2025-03-24 09:19:12', '2025-03-24 09:19:12'),
(10, 2, 'Kollam', '2025-03-24 09:19:12', '2025-03-24 09:19:12'),
(11, 2, 'Alappuzha', '2025-03-24 09:19:49', '2025-03-24 09:19:49'),
(12, 2, 'Pathanamthitta', '2025-03-24 09:20:14', '2025-03-24 09:20:14'),
(13, 3, 'Chennai', '2025-03-24 09:21:14', '2025-03-24 09:21:14'),
(14, 3, 'Coimbatore', '2025-03-24 09:21:14', '2025-03-24 09:21:14'),
(15, 3, 'Cuddalore', '2025-03-24 09:21:47', '2025-03-24 09:21:47'),
(16, 3, 'Dharmapuri', '2025-03-24 09:21:47', '2025-03-24 09:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `fees_details`
--

CREATE TABLE `fees_details` (
  `id` bigint(20) NOT NULL,
  `fees_structure_id` bigint(20) UNSIGNED NOT NULL,
  `fees_head_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_details`
--

INSERT INTO `fees_details` (`id`, `fees_structure_id`, `fees_head_id`, `amount`, `created_at`, `updated_at`) VALUES
(43, 17, 1, 22000.00, '2025-05-11 23:22:10', '2025-05-11 23:22:10'),
(44, 17, 2, 5000.00, '2025-05-11 23:22:10', '2025-05-11 23:22:10'),
(45, 17, 3, 10000.00, '2025-05-11 23:22:10', '2025-05-11 23:22:10'),
(46, 17, 4, 20000.00, '2025-05-11 23:22:10', '2025-05-11 23:22:10'),
(47, 18, 1, 15000.00, '2025-05-11 23:23:06', '2025-05-11 23:23:06'),
(48, 18, 2, 5000.00, '2025-05-11 23:23:06', '2025-05-11 23:23:06'),
(49, 18, 3, 7000.00, '2025-05-11 23:23:06', '2025-05-11 23:23:06'),
(50, 18, 4, 20000.00, '2025-05-11 23:23:06', '2025-05-11 23:23:06'),
(51, 19, 1, 22000.00, '2025-05-13 03:49:05', '2025-05-13 03:49:05'),
(52, 19, 2, 5000.00, '2025-05-13 03:49:05', '2025-05-13 03:49:05'),
(53, 19, 3, 10000.00, '2025-05-13 03:49:05', '2025-05-13 03:49:05'),
(54, 19, 4, 20000.00, '2025-05-13 03:49:05', '2025-05-13 03:49:05'),
(55, 20, 1, 22000.00, '2025-05-13 03:49:35', '2025-05-13 03:49:35'),
(56, 20, 2, 5000.00, '2025-05-13 03:49:35', '2025-05-13 03:49:35'),
(57, 20, 3, 10000.00, '2025-05-13 03:49:35', '2025-05-13 03:49:35'),
(58, 20, 4, 20000.00, '2025-05-13 03:49:35', '2025-05-13 03:49:35'),
(59, 21, 1, 22000.00, '2025-05-13 04:18:03', '2025-05-13 04:18:03'),
(60, 21, 2, 5000.00, '2025-05-13 04:18:03', '2025-05-13 04:18:03'),
(61, 21, 3, 10000.00, '2025-05-13 04:18:03', '2025-05-13 04:18:03'),
(62, 21, 4, 20000.00, '2025-05-13 04:18:03', '2025-05-13 04:18:03'),
(63, 22, 1, 22000.00, '2025-05-13 04:30:18', '2025-05-13 04:30:18'),
(64, 22, 2, 5000.00, '2025-05-13 04:30:18', '2025-05-13 04:30:18'),
(65, 22, 3, 10000.00, '2025-05-13 04:30:18', '2025-05-13 04:30:18'),
(66, 22, 4, 20000.00, '2025-05-13 04:30:18', '2025-05-13 04:30:18'),
(67, 22, 13, 40000.00, '2025-05-13 04:30:18', '2025-05-13 04:30:18'),
(68, 23, 1, 22000.00, '2025-05-20 01:02:37', '2025-05-20 01:02:37'),
(69, 23, 2, 5000.00, '2025-05-20 01:02:37', '2025-05-20 01:02:37'),
(70, 23, 3, 10000.00, '2025-05-20 01:02:37', '2025-05-20 01:02:37'),
(71, 23, 13, 40000.00, '2025-05-20 01:02:37', '2025-05-20 01:02:37'),
(72, 24, 1, 22000.00, '2025-05-20 01:03:21', '2025-05-20 01:03:21'),
(73, 24, 2, 5000.00, '2025-05-20 01:03:21', '2025-05-20 01:03:21'),
(74, 24, 3, 10000.00, '2025-05-20 01:03:21', '2025-05-20 01:03:21'),
(75, 24, 13, 40000.00, '2025-05-20 01:03:21', '2025-05-20 01:03:21'),
(76, 25, 1, 22000.00, '2025-05-20 01:04:17', '2025-05-20 01:04:17'),
(77, 25, 2, 5000.00, '2025-05-20 01:04:17', '2025-05-20 01:04:17'),
(78, 25, 3, 10000.00, '2025-05-20 01:04:17', '2025-05-20 01:04:17'),
(79, 25, 13, 40000.00, '2025-05-20 01:04:17', '2025-05-20 01:04:17'),
(80, 26, 1, 22000.00, '2025-05-20 01:04:47', '2025-05-20 01:04:47'),
(81, 26, 2, 5000.00, '2025-05-20 01:04:47', '2025-05-20 01:04:47'),
(82, 26, 3, 1000.00, '2025-05-20 01:04:47', '2025-05-20 01:04:47'),
(83, 26, 13, 40000.00, '2025-05-20 01:04:47', '2025-05-20 01:04:47'),
(84, 27, 1, 22000.00, '2025-05-20 01:05:21', '2025-05-20 01:05:21'),
(85, 27, 2, 5000.00, '2025-05-20 01:05:21', '2025-05-20 01:05:21'),
(86, 27, 3, 10000.00, '2025-05-20 01:05:21', '2025-05-20 01:05:21'),
(87, 27, 13, 40000.00, '2025-05-20 01:05:21', '2025-05-20 01:05:21'),
(88, 28, 1, 22000.00, '2025-05-20 01:06:41', '2025-05-20 01:06:41'),
(89, 28, 2, 5000.00, '2025-05-20 01:06:41', '2025-05-20 01:06:41'),
(90, 28, 3, 10000.00, '2025-05-20 01:06:41', '2025-05-20 01:06:41'),
(91, 28, 13, 40000.00, '2025-05-20 01:06:41', '2025-05-20 01:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `fees_heads`
--

CREATE TABLE `fees_heads` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_heads`
--

INSERT INTO `fees_heads` (`id`, `name`, `description`) VALUES
(1, 'Tuition', 'Covers teaching and academic instruction'),
(2, 'Library', 'Access to library facilities and resources'),
(3, 'Exam', 'Examination and evaluation charges'),
(4, 'Admission', 'One-time admission processing fee'),
(13, 'Hostel', NULL),
(14, 'late_fine', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees_payment_details`
--

CREATE TABLE `fees_payment_details` (
  `id` bigint(20) NOT NULL,
  `fees_structure_id` bigint(20) UNSIGNED NOT NULL,
  `fees_payment_header_id` bigint(20) UNSIGNED NOT NULL,
  `fees_head_id` int(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_payment_header`
--

CREATE TABLE `fees_payment_header` (
  `id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `fees_structure_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL DEFAULT current_timestamp(),
  `payment_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_payment_schedule`
--

CREATE TABLE `fees_payment_schedule` (
  `id` bigint(20) NOT NULL,
  `fees_structure_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date NOT NULL DEFAULT current_timestamp(),
  `extended_date` date DEFAULT NULL,
  `late_fine` decimal(10,2) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_payment_schedule`
--

INSERT INTO `fees_payment_schedule` (`id`, `fees_structure_id`, `start_date`, `end_date`, `extended_date`, `late_fine`, `description`, `created_at`, `updated_at`) VALUES
(10, 18, '2025-05-20', '2025-05-27', NULL, 1.00, NULL, '2025-05-14 11:26:27', '2025-05-14 11:26:27'),
(11, 19, '2025-05-21', '2025-05-28', NULL, 0.00, NULL, '2025-05-19 10:37:51', '2025-05-19 10:37:51'),
(12, 17, '2025-05-19', '2025-05-26', NULL, NULL, NULL, '2025-05-19 10:50:09', '2025-05-19 10:50:09'),
(13, 21, '2025-05-20', '2025-05-27', NULL, NULL, NULL, '2025-05-20 06:31:10', '2025-05-20 06:31:10'),
(14, 23, '2025-04-01', '2025-05-08', '2025-05-19', 10.00, NULL, '2025-05-20 06:37:16', '2025-05-20 06:37:16'),
(15, 24, '2025-05-21', '2025-05-25', NULL, 50.00, NULL, '2025-05-20 06:56:28', '2025-05-20 06:56:28'),
(16, 25, '2025-05-21', '2025-05-28', NULL, NULL, NULL, '2025-05-20 06:56:42', '2025-05-20 06:56:42'),
(17, 28, '2025-05-21', '2025-05-28', NULL, NULL, NULL, '2025-05-20 06:57:04', '2025-05-20 06:57:04'),
(18, 26, '2025-05-21', '2025-05-28', NULL, NULL, NULL, '2025-05-20 06:57:24', '2025-05-20 06:57:24'),
(19, 27, '2025-05-21', '2025-05-27', NULL, NULL, NULL, '2025-05-20 06:57:38', '2025-05-20 06:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `fees_structure`
--

CREATE TABLE `fees_structure` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `structure_name` varchar(255) DEFAULT NULL,
  `academic_id` bigint(20) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_structure`
--

INSERT INTO `fees_structure` (`id`, `structure_name`, `academic_id`, `course_id`, `semester_id`, `total_amount`, `created_at`, `updated_at`) VALUES
(17, '2021-2022 Computer Science and Engineering 1st SEM', 1, 1, 1, 57000.00, '2025-05-11 23:22:10', '2025-05-12 04:52:10'),
(18, '2021-2022 Applied Psychology 1st SEM', 1, 13, 1, 47000.00, '2025-05-11 23:23:06', '2025-05-12 04:53:06'),
(19, '2021-2022 Computer Science and Engineering 2nd SEM', 1, 1, 2, 57000.00, '2025-05-13 03:49:05', '2025-05-13 09:19:05'),
(20, '2021-2022 Computer Application 2nd SEM', 1, 3, 2, 57000.00, '2025-05-13 03:49:35', '2025-05-13 09:19:35'),
(21, '2021-2022 Robotics 1st SEM', 1, 4, 1, 57000.00, '2025-05-13 04:18:03', '2025-05-13 09:48:03'),
(22, '2021-2022 Robotics 2nd SEM', 1, 4, 2, 97000.00, '2025-05-13 04:19:18', '2025-05-13 10:00:18'),
(23, '2021-2022 Computer Science and Engineering 3rd SEM', 1, 1, 3, 77000.00, '2025-05-20 01:02:37', '2025-05-20 06:32:37'),
(24, '2021-2022 Computer Science and Engineering 4th SEM', 1, 1, 4, 77000.00, '2025-05-20 01:03:21', '2025-05-20 06:33:21'),
(25, '2021-2022 Computer Science and Engineering 5th SEM', 1, 1, 5, 77000.00, '2025-05-20 01:04:17', '2025-05-20 06:34:17'),
(26, '2021-2022 Computer Science and Engineering 7th SEM', 1, 1, 7, 68000.00, '2025-05-20 01:04:47', '2025-05-20 06:34:47'),
(27, '2021-2022 Computer Science and Engineering 8th SEM', 1, 1, 8, 77000.00, '2025-05-20 01:05:21', '2025-05-20 06:35:21'),
(28, '2021-2022 Computer Science and Engineering 6th SEM', 1, 1, 6, 77000.00, '2025-05-20 01:06:41', '2025-05-20 06:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Male', NULL, NULL),
(2, 'Female', NULL, NULL),
(3, 'Third Gender', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_admin_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2025_01_28_105531_create_genders', 1),
(4, '2025_01_28_105606_create_countries', 1),
(5, '2025_01_28_105614_create_states', 1),
(6, '2025_01_28_105625_create_districts', 1),
(7, '2025_01_28_105636_create_schools', 1),
(8, '2025_01_28_105647_create_degrees', 1),
(9, '2025_01_28_105701_create_specializations', 1),
(10, '2025_02_03_091939_create_students', 1),
(11, '2025_03_20_072423_create_student_basic_details', 1),
(12, '2025_03_20_072459_create_student_address_details', 1),
(13, '2025_03_20_072508_create_student_education_details', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) NOT NULL,
  `payment_table_id` bigint(20) NOT NULL,
  `fees_head_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `payment_table_id`, `fees_head_id`, `amount`) VALUES
(96, 24, 1, 22000.00),
(97, 24, 2, 5000.00),
(98, 24, 3, 10000.00),
(99, 24, 4, 20000.00),
(100, 25, 1, 22000.00),
(101, 25, 2, 5000.00),
(102, 25, 3, 10000.00),
(103, 25, 13, 40000.00),
(104, 25, 14, 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment_table`
--

CREATE TABLE `payment_table` (
  `id` bigint(20) NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `fees_structure_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `reciept_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_table`
--

INSERT INTO `payment_table` (`id`, `student_id`, `fees_structure_id`, `total_amount`, `payment_date`, `reciept_number`) VALUES
(24, 27, 17, 57000.00, '2025-05-21', 'PR20250001'),
(25, 27, 23, 77020.00, '2025-05-21', 'PR20250002');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'The Neotia University', '2025-03-24 09:26:15', '2025-03-24 09:26:15'),
(2, 'Indian Institute of Technology, Kharagpur', '2025-03-24 09:29:02', '2025-03-24 09:29:02'),
(3, 'Indian Institute of Technology Madras', '2025-03-24 09:30:43', '2025-03-24 09:30:43'),
(4, 'Indian Institute of Science', '2025-03-24 09:30:43', '2025-03-24 09:30:43'),
(5, 'University of Kerala ', '2025-03-24 09:30:43', '2025-03-24 09:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd'),
(4, '4th'),
(5, '5th'),
(6, '6th'),
(7, '7th'),
(8, '8th'),
(9, '9th'),
(10, '10th');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Computer Science and Engineering', NULL, NULL),
(2, 'General', '2025-03-24 09:32:15', '2025-03-24 09:32:15'),
(3, 'Computer Application', '2025-03-24 09:32:15', '2025-03-24 09:32:15'),
(4, 'Robotics', NULL, NULL),
(5, 'Agriculture', NULL, NULL),
(6, 'Fishary Science', NULL, NULL),
(7, 'BMLT', NULL, NULL),
(8, 'BHM', NULL, NULL),
(9, 'Optometry', NULL, NULL),
(10, 'Hotel Management', NULL, NULL),
(11, 'BioTechnology', NULL, NULL),
(12, 'MicroBiology', NULL, NULL),
(13, 'Applied Psychology', NULL, NULL),
(14, 'BBA', NULL, NULL),
(15, 'Nursing', NULL, NULL),
(16, 'English Mass Communication', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'West Bengal', NULL, NULL),
(2, 1, 'Kerala', '2025-03-24 09:13:29', '2025-03-24 09:13:29'),
(3, 1, 'Tamil Nadu', '2025-03-24 09:13:26', '2025-03-24 09:13:27'),
(4, 1, 'Karnataka', '2025-03-24 09:15:39', '2025-03-24 09:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `degree_id_opt` bigint(20) UNSIGNED DEFAULT NULL,
  `specialization_id_opt` bigint(20) UNSIGNED DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `academic_id` bigint(20) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL,
  `registration_no` varchar(255) DEFAULT NULL,
  `is_submitted` tinyint(1) DEFAULT 0,
  `token` varchar(512) DEFAULT NULL,
  `otp` varchar(4) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `lname`, `email`, `mobile`, `degree_id_opt`, `specialization_id_opt`, `semester_id`, `academic_id`, `signature`, `password`, `photo`, `registration_no`, `is_submitted`, `token`, `otp`, `otp_expires_at`, `created_at`, `updated_at`) VALUES
(27, 'Sankar', 'Rajak', 'sankarrajak1223@gmail.com', '9330741654', 4, 1, 1, 1, 'TNU2021020100055-1747295700.png', '54c9d4680a678494b6e5547b8524fbef637e61425329ddfe2b1eeb93e410b128', 'TNU2021020100055-1747295700.png', 'DCG20250000', 1, 'dc501c106a84b63629f15edd830777352662ce30ca625c04db4886802eb1050e', '5598', NULL, NULL, '2025-05-15 02:25:01'),
(28, 'Soumik', 'De', 'soumik@gmail.com', '9330741601', NULL, NULL, NULL, NULL, 'TNU2021020100001-1743655331.png', '4322da71f8bc64a62f0f825d15d7c3dd7f99ef0a4a9c1bccd40f125d90383efd', 'TNU2021020100001-1743655331.png', 'DCG20250002', 1, '898c5d653bbb731c9c0f047414aedbe44de5249526d921f164214e8f92d67b87', '5923', NULL, NULL, '2025-04-02 23:12:11'),
(29, 'Subhojit', 'Giri', 'subhojit@gmail.com', '9330741604', NULL, NULL, NULL, NULL, 'TNU2021020100004-1744103193.png', '6e56cd033844681e23c5953a9d2f4157bb1ee6644521b83b88471bf8caf36579', 'TNU2021020100004-1744103193.png', 'DCG20250003', 1, '63f6a204ef2b2e0791b9f96691eea3960b48657d5828dfd525d54f1ea72d5605', '3983', NULL, NULL, '2025-04-08 03:36:35'),
(31, 'Biplab', 'Ghosh', 'biplab@gmail.com', '9330741605', NULL, NULL, NULL, NULL, 'TNU2021020100005-1744175267.png', 'fe98fadb86f7e057f21b3f3691b677df064430a3aa8859f5da9394087cb5a4f4', 'TNU2021020100005-1744175267.png', 'DCG20250004', 1, '0005cad5117c7fdd53916c8fa75232567d28f3e7a65296e94916b17ef174f2d4', '3265', NULL, NULL, '2025-04-08 23:37:47'),
(32, 'Sagnik', 'Das', 'sagnik@gmail.com', '9330741606', NULL, NULL, NULL, NULL, 'TNU2021020100006-1744175482.png', 'b7611dcb69e27fb69025aa369f80334ae5a2c772337c19af56e53768271b27b6', 'TNU2021020100006-1744175482.png', 'DCG20250005', 1, 'fb464646e2e064320ce2ba35fc3b87a36ab930ef0b2f5684519d936745d9810e', '5495', NULL, NULL, '2025-04-08 23:41:22'),
(33, 'Sancharita', 'Dutta', 'sancharita@gmail.com', '9330741607', NULL, NULL, NULL, NULL, 'TNU2021020100007-1744175684.png', 'ed11e7293bee4f811d8f0af3c4599e624b0643e5b6facffaf05152500445abfa', 'TNU2021020100007-1744175684.png', 'DCG20250006', 1, '06ab11c2b7c813efb0802d4669e514936719adb9e67f5834ac334be96b3577ec', '3995', NULL, NULL, '2025-04-09 02:01:47'),
(34, 'Arnab', 'Bera', 'arnab.bera@tnu.in', '9330741608', NULL, NULL, NULL, NULL, 'TNU2021020100008-1744175857.png', 'faf28c31507ffdb32b94d488923b53a2ea0b8a2f9545931464eaf7dfbe5f4a47', 'TNU2021020100008-1744175857.png', 'DCG20250007', 1, 'cd1f52ac07eb7a45b0a706b35806acc945c9aaf4e7cb400194a998313a8c181f', '3493', NULL, NULL, '2025-04-08 23:47:37'),
(35, 'Subhasish', 'Mondal', 'subhasish@gmail.com', '9330741609', NULL, NULL, NULL, NULL, 'TNU2021020100009-1744176208.png', 'c213f1894770d8c46bc55d80d0787a7aacff0dcbbe3ae681005f3833fdd3d7a9', 'TNU2021020100009-1744176208.png', 'DCG20250008', 1, 'd15813860c78eae306146ecfcec636d780d8ddfd343381cae3ac1f7d8919cd37', '5925', NULL, NULL, '2025-04-08 23:53:28'),
(36, 'Akash', 'Howli', 'akash1@gmail.com', '9330741610', NULL, NULL, NULL, NULL, 'PNU2021020100010-1744176442.png', 'd40ea25ec29d6e369d4c7d845d772586dd34b5ced837f1ca89e84a290f27912e', 'PNU2021020100010-1744176442.png', 'DCG20250009', 1, 'e3f0a633a9d39649643f78135783d5c554262a3dd6794d49d0b056e572487deb', '5423', NULL, NULL, '2025-04-08 23:57:22'),
(37, 'Pratik', 'Sapui', 'pratik@gmail.com', '9330741611', NULL, NULL, NULL, NULL, 'TNU2021020100011-1744176739.png', 'f14a4f65ff631143e95235f2ed89052a0e147dc7abdb4df861cdb0bdd869d415', 'TNU2021020100011-1744176739.png', 'DCG20250010', 1, 'f8c07d49bc5a0cbb2527ab34dac1898e43e629179bbad3cec0e9f6db878af09f', '8214', NULL, NULL, '2025-04-09 00:02:20'),
(38, 'Srimanta', 'Maity', 'srimanta@gmail.com', '9330741612', NULL, NULL, NULL, NULL, NULL, 'cfa870cff989d96436184b55a38001e38e2946a20a0e8345b82a4ac621f2d6b8', NULL, NULL, 0, '342f5c9044c55a631be57f4a6d80e832fe681235d14956ff5d7a1ad3a2e219f3', '3033', NULL, NULL, '2025-04-09 05:01:02'),
(39, 'Swagatam', 'Jana', 'swagatam@gmail.com', '9330741613', 4, 4, NULL, NULL, 'TNU2021020100013-1746787336.png', '95f04c20e72f3da5e7f00aeaf6dd0843c95893fe734e78a7565917b2e418e3dd', 'TNU2021020100013-1746787336.png', 'DCG20250011', 1, '8a4810491c368921dd51cfcea99f4b36f67ab0662d1415c1cfad4adf474b52e9', '3956', NULL, NULL, '2025-05-09 05:12:17'),
(48, 'Sankar', 'Rajak', 'sankar.rajak@tnu.in', '9330741650', 4, 1, NULL, NULL, 'TNU2021020100000-1748849356.png', '54c9d4680a678494b6e5547b8524fbef637e61425329ddfe2b1eeb93e410b128', 'TNU2021020100000-1748849356.png', 'DCG20250012', 1, '399d6d296bbbd0c3051fe2774273a5133fae31e6615a8f9300c1eaa731d931c2', '1041', NULL, NULL, '2025-06-02 01:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `student_address_details`
--

CREATE TABLE `student_address_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_address_details`
--

INSERT INTO `student_address_details` (`id`, `student_id`, `country_id`, `state_id`, `district_id`, `street`, `pin`, `created_at`, `updated_at`) VALUES
(9, 27, 1, 1, 1, 'PURNANDAPALLY,DOGACHHIA(CT),NAIHATI.', '743130', NULL, '2025-04-02 05:51:50'),
(10, 28, 1, 1, 3, 'Memary, Bardwan', '746565', NULL, '2025-04-02 23:11:50'),
(11, 29, 1, 1, 1, 'PURNANDAPALLY,DOGACHHIA(CT),NAIHATI.', '743130', NULL, '2025-04-03 00:45:10'),
(13, 31, 1, 2, 9, 'Kerala', '743130', NULL, '2025-04-08 23:37:30'),
(14, 32, 1, 1, 3, 'DurgaPur', '743130', NULL, '2025-04-08 23:41:10'),
(15, 33, 1, 1, 2, 'Budge Budge', '743130', NULL, '2025-04-09 02:01:47'),
(16, 34, 1, 3, 14, 'Tamil Nadu', '743130', NULL, '2025-04-08 23:47:25'),
(17, 35, 1, 1, 1, 'SodePur', '743130', NULL, '2025-04-08 23:53:15'),
(18, 36, 1, 2, 10, 'Kerala', '743130', NULL, '2025-04-08 23:57:10'),
(19, 37, 1, 1, 3, 'Kharagpur', '743130', NULL, '2025-04-09 00:02:03'),
(20, 38, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-09 05:01:02'),
(21, 39, 1, 1, 2, 'Kolkata', '743100', NULL, '2025-05-09 04:42:43'),
(22, 48, 1, 1, 1, 'PURNANDAPALLY,DOGACHHIA(CT),NAIHATI.', '743130', NULL, '2025-06-02 01:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `student_basic_details`
--

CREATE TABLE `student_basic_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `gender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_basic_details`
--

INSERT INTO `student_basic_details` (`id`, `student_id`, `gender_id`, `dob`, `created_at`, `updated_at`) VALUES
(14, 27, 1, '2003-11-04', NULL, '2025-04-02 05:50:22'),
(15, 28, 1, '2003-01-01', NULL, '2025-04-02 23:10:14'),
(16, 29, 1, '2003-01-01', NULL, '2025-04-03 00:45:10'),
(18, 31, 1, '2003-01-01', NULL, '2025-04-08 23:36:39'),
(19, 32, 1, '2003-01-01', NULL, '2025-04-08 23:39:57'),
(20, 33, 2, '2003-01-01', NULL, '2025-04-09 02:01:47'),
(21, 34, 1, '2003-01-01', NULL, '2025-04-08 23:46:21'),
(22, 35, 1, '2003-01-01', NULL, '2025-04-08 23:51:08'),
(23, 36, 1, '2003-01-01', NULL, '2025-04-08 23:55:31'),
(24, 37, 1, '2003-01-01', NULL, '2025-04-09 00:00:59'),
(25, 38, NULL, NULL, NULL, '2025-04-09 05:01:02'),
(26, 39, 1, '2003-01-01', NULL, '2025-05-09 04:42:43'),
(30, 48, 1, '2003-11-04', NULL, '2025-06-02 01:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `student_course_details`
--

CREATE TABLE `student_course_details` (
  `id` bigint(20) NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `degree_id` bigint(20) UNSIGNED DEFAULT NULL,
  `specialization_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_course_details`
--

INSERT INTO `student_course_details` (`id`, `student_id`, `degree_id`, `specialization_id`, `updated_at`) VALUES
(1, 39, 4, 1, '2025-06-02 05:51:14'),
(2, 48, NULL, NULL, '2025-06-02 00:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `student_education_details`
--

CREATE TABLE `student_education_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `degree_id` bigint(20) UNSIGNED DEFAULT NULL,
  `specialization_id` bigint(20) UNSIGNED DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_education_details`
--

INSERT INTO `student_education_details` (`id`, `student_id`, `degree_id`, `specialization_id`, `school_id`, `uid`, `created_at`, `updated_at`) VALUES
(18, 28, 1, 1, 2, 'TNU2021020100001', '2025-04-02 23:11:03', '2025-04-02 23:11:03'),
(19, 28, 3, 2, 2, 'HNU2021020100001', '2025-04-02 23:11:03', '2025-04-02 23:11:03'),
(20, 28, 2, 2, 2, 'SNU2021020100001', '2025-04-02 23:11:03', '2025-04-02 23:11:03'),
(22, 27, 1, 1, 1, 'TNU2021020100055', '2025-04-02 23:22:03', '2025-04-02 23:22:03'),
(23, 27, 3, 2, 1, 'HNU2021020100055', '2025-04-02 23:22:03', '2025-04-02 23:22:03'),
(24, 27, 2, 2, 1, 'SNU2021020100055', '2025-04-02 23:22:03', '2025-04-02 23:22:03'),
(25, 29, 1, 1, 3, 'TNU2021020100004', '2025-04-02 23:26:08', '2025-04-03 00:45:10'),
(26, 29, 3, 2, 3, 'HNU2021020100004', '2025-04-02 23:26:08', '2025-04-03 00:45:10'),
(27, 29, 2, 2, 3, 'SNU2021020100004', '2025-04-02 23:26:08', '2025-04-03 00:45:10'),
(31, 31, 1, 1, 5, 'TNU2021020100005', '2025-04-08 23:37:16', '2025-04-08 23:37:16'),
(32, 31, 3, 2, 5, 'HNU2021020100005', '2025-04-08 23:37:16', '2025-04-08 23:37:16'),
(33, 31, 2, 2, 5, 'SNU2021020100005', '2025-04-08 23:37:16', '2025-04-08 23:37:16'),
(34, 32, 1, 1, 1, 'TNU2021020100006', '2025-04-08 23:40:49', '2025-04-08 23:40:49'),
(35, 32, 3, 2, 1, 'SNU2021020100006', '2025-04-08 23:40:49', '2025-04-08 23:40:49'),
(36, 33, 1, 1, 2, 'TNU2021020100007', '2025-04-08 23:44:07', '2025-04-09 02:01:47'),
(37, 33, 3, 2, 2, 'HNU2021020100007', '2025-04-08 23:44:07', '2025-04-09 02:01:47'),
(38, 33, 2, 2, 2, 'SNU2021020100007', '2025-04-08 23:44:07', '2025-04-09 02:01:47'),
(39, 34, 1, 1, 3, 'TNU2021020100008', '2025-04-08 23:46:58', '2025-04-08 23:46:58'),
(40, 34, 3, 2, 3, 'HNU2021020100008', '2025-04-08 23:46:58', '2025-04-08 23:46:58'),
(41, 34, 2, 2, 3, 'SNU2021020100008', '2025-04-08 23:46:58', '2025-04-08 23:46:58'),
(42, 35, 1, 1, 4, 'TNU2021020100009', '2025-04-08 23:51:57', '2025-04-08 23:51:57'),
(43, 35, 3, 2, 4, 'HNU2021020100009', '2025-04-08 23:51:57', '2025-04-08 23:51:57'),
(44, 35, 2, 2, 4, 'SNU2021020100009', '2025-04-08 23:51:57', '2025-04-08 23:51:57'),
(45, 36, 5, 1, 5, 'PNU2021020100010', '2025-04-08 23:56:53', '2025-04-08 23:56:53'),
(46, 36, 1, 1, 5, 'TNU2021020100010', '2025-04-08 23:56:53', '2025-04-08 23:56:53'),
(47, 36, 3, 2, 5, 'HNU2021020100010', '2025-04-08 23:56:53', '2025-04-08 23:56:53'),
(48, 36, 2, 2, 5, 'SNU2021020100010', '2025-04-08 23:56:53', '2025-04-08 23:56:53'),
(49, 37, 1, 1, 2, 'TNU2021020100011', '2025-04-09 00:01:46', '2025-04-09 00:01:46'),
(50, 37, 3, 2, 2, 'HNU2021020100011', '2025-04-09 00:01:46', '2025-04-09 00:01:46'),
(51, 37, 2, 2, 2, 'SNU2021020100011', '2025-04-09 00:01:46', '2025-04-09 00:01:46'),
(52, 39, 1, 1, 1, 'TNU2021020100013', '2025-05-06 05:02:35', '2025-05-09 04:42:43'),
(55, 48, 1, 1, 1, 'TNU2021020100000', '2025-06-02 01:54:51', '2025-06-02 01:54:51'),
(56, 48, 3, 2, 1, 'HNU2021020100000', '2025-06-02 01:54:51', '2025-06-02 01:54:51'),
(57, 48, 2, 2, 1, 'SNU2021020100000', '2025-06-02 01:54:51', '2025-06-02 01:54:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academics`
--
ALTER TABLE `academics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_state_id_foreign` (`state_id`);

--
-- Indexes for table `fees_details`
--
ALTER TABLE `fees_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_head_id` (`fees_head_id`),
  ADD KEY `fees_structure_id` (`fees_structure_id`);

--
-- Indexes for table `fees_heads`
--
ALTER TABLE `fees_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_payment_details`
--
ALTER TABLE `fees_payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_payment_header`
--
ALTER TABLE `fees_payment_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_structure_id` (`fees_structure_id`);

--
-- Indexes for table `fees_payment_schedule`
--
ALTER TABLE `fees_payment_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_structure_id` (`fees_structure_id`);

--
-- Indexes for table `fees_structure`
--
ALTER TABLE `fees_structure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `academic_course_semester` (`academic_id`,`course_id`,`semester_id`) USING BTREE,
  ADD KEY `course_id` (`course_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_table_id` (`payment_table_id`);

--
-- Indexes for table `payment_table`
--
ALTER TABLE `payment_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_structure_id` (`fees_structure_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_country_id_foreign` (`country_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_registration_no_unique` (`registration_no`),
  ADD KEY `degree_id_opt` (`degree_id_opt`),
  ADD KEY `specialization_id_opt` (`specialization_id_opt`),
  ADD KEY `academic_id` (`academic_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `student_address_details`
--
ALTER TABLE `student_address_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_address_details_country_id_foreign` (`country_id`),
  ADD KEY `student_address_details_district_id_foreign` (`district_id`),
  ADD KEY `student_address_details_state_id_foreign` (`state_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_basic_details`
--
ALTER TABLE `student_basic_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_basic_details_gender_id_foreign` (`gender_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_course_details`
--
ALTER TABLE `student_course_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`degree_id`),
  ADD KEY `specialization_id` (`specialization_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_education_details`
--
ALTER TABLE `student_education_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD KEY `student_education_details_degree_id_foreign` (`degree_id`),
  ADD KEY `student_education_details_school_id_foreign` (`school_id`),
  ADD KEY `student_education_details_specialization_id_foreign` (`specialization_id`),
  ADD KEY `student_education_details_student_id_foreign` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academics`
--
ALTER TABLE `academics`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `degrees`
--
ALTER TABLE `degrees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fees_details`
--
ALTER TABLE `fees_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `fees_heads`
--
ALTER TABLE `fees_heads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fees_payment_details`
--
ALTER TABLE `fees_payment_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_payment_header`
--
ALTER TABLE `fees_payment_header`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_payment_schedule`
--
ALTER TABLE `fees_payment_schedule`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `fees_structure`
--
ALTER TABLE `fees_structure`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `payment_table`
--
ALTER TABLE `payment_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `student_address_details`
--
ALTER TABLE `student_address_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student_basic_details`
--
ALTER TABLE `student_basic_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `student_course_details`
--
ALTER TABLE `student_course_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_education_details`
--
ALTER TABLE `student_education_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fees_details`
--
ALTER TABLE `fees_details`
  ADD CONSTRAINT `fees_details_ibfk_1` FOREIGN KEY (`fees_structure_id`) REFERENCES `fees_structure` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fees_payment_header`
--
ALTER TABLE `fees_payment_header`
  ADD CONSTRAINT `fees_payment_header_ibfk_1` FOREIGN KEY (`fees_structure_id`) REFERENCES `fees_structure` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fees_payment_schedule`
--
ALTER TABLE `fees_payment_schedule`
  ADD CONSTRAINT `fees_payment_schedule_ibfk_1` FOREIGN KEY (`fees_structure_id`) REFERENCES `fees_structure` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fees_structure`
--
ALTER TABLE `fees_structure`
  ADD CONSTRAINT `fees_structure_ibfk_1` FOREIGN KEY (`academic_id`) REFERENCES `academics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fees_structure_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `specializations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fees_structure_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`payment_table_id`) REFERENCES `payment_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_table`
--
ALTER TABLE `payment_table`
  ADD CONSTRAINT `payment_table_ibfk_1` FOREIGN KEY (`fees_structure_id`) REFERENCES `fees_structure` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_table_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`degree_id_opt`) REFERENCES `degrees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`specialization_id_opt`) REFERENCES `specializations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`academic_id`) REFERENCES `academics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_5` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_address_details`
--
ALTER TABLE `student_address_details`
  ADD CONSTRAINT `student_address_details_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_address_details_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_address_details_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_address_details_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_basic_details`
--
ALTER TABLE `student_basic_details`
  ADD CONSTRAINT `student_basic_details_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_basic_details_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_course_details`
--
ALTER TABLE `student_course_details`
  ADD CONSTRAINT `student_course_details_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_course_details_ibfk_2` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_course_details_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_education_details`
--
ALTER TABLE `student_education_details`
  ADD CONSTRAINT `student_education_details_degree_id_foreign` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_education_details_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_education_details_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_education_details_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
