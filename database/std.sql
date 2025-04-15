-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 09:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `std`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `departmentId` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `photo`, `phone`, `address`, `dob`, `departmentId`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Amzad Hossain', 'amzad@gmail.com', '$2y$10$N52Ms9u9IJn0.uzi4FV3Bu8ZV3TxK2zbTfxlUEcSQU26y1DCoUJ5G', NULL, '123456789', 'Dhaka', '2025-04-14', 1, 3, 1, '2025-04-13 23:30:50', '2025-04-13 23:30:50'),
(2, 'Shamim Hossain', 'samim@gmail.com', '$2y$10$db23JrxYJp6d23ITwJYvXuOLOpg/u.XlyiZ96liA1XaVJrnfPlgP.', NULL, '123456789', 'Dhaka', '2025-04-14', 1, 2, 1, '2025-04-13 23:31:15', '2025-04-13 23:31:15'),
(3, 'Rakib Hossain', 'rakib@gmail.com', '$2y$10$mapnlTFTkf/TfR3A2EafBeNDtdRXO9Ir.8GYEBdUQMt2A9sw/Dtre', NULL, '123456789', 'Dhaka', '2025-04-14', 1, 1, 1, '2025-04-13 23:31:29', '2025-04-13 23:31:29'),
(4, 'Md Akbor Hossain', 'akbar@gmail.com', '$2y$10$SpeilaWTViUqJ/IPpaWNWum4zkWgmzO76gSiVwYGUuLCp/LqWq83i', 'tech-17446125041.JPG', '123456789', 'Dhaka', '2025-04-14', 5, 2, 1, '2025-04-14 00:35:04', '2025-04-14 00:35:04'),
(5, 'Prof. Akram Mia', 'akram@gmail.com', '$2y$10$SpeilaWTViUqJ/IPpaWNWum4zkWgmzO76gSiVwYGUuLCp/LqWq83i', 'tech-17446126421.JPG', '123456789', 'Dhaka', '2025-04-14', 6, 2, 1, '2025-04-14 00:37:22', '2025-04-14 00:37:22'),
(6, 'Md Anisul Islam', 'anis@gmail.com', '$2y$10$zGqSutLnVr/MNMaXzAVnaujNG.9aVdYRSSmjbm9bki5JYGjfidBym', 'std-17446129981.JPG', '3216549872', 'Dhaka', '2025-04-14', 3, 1, 1, '2025-04-14 00:43:18', '2025-04-14 00:43:18'),
(7, 'Mimi Akter', 'mimi@gmail.com', '$2y$10$rX5koYBHBsyAihuU2HRUJuW6R7T9zJENVhNFrSxNgJoiMLai4OH1.', 'std-17446134871.JPG', '321654', 'Dhaka', '2025-04-14', 5, 1, 1, '2025-04-14 00:51:27', '2025-04-15 01:39:55'),
(8, 'Babu', 'babu@gmail.com', '$2y$10$XB6ElJDV0qRO.UDlX.OQHeHOkSolUfw8ZbVECEYtX.DabvZWhRP.m', NULL, '123456789', 'Dhaka', '2025-04-15', 1, 3, 1, '2025-04-15 00:59:20', '2025-04-15 00:59:20'),
(9, 'Arifa Akter', 'arifa@gmail.com', '$2y$10$3oxZdJ1Ze2E.rVRzqnoZSeW2qTE9IWmOptE/dNg0L8IM4KWwLm6s6', 'std-17447004191.JPG', '3216549872', 'Dhaka, Bangladesh', '2025-04-15', 6, 1, 1, '2025-04-15 01:00:19', '2025-04-15 01:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Government Holiday Notice', '14 April-2025 government holiday.\r\nThis is our bangla new year 1432.', 'std-17446552801.JPG', '2025-04-14 12:28:00', '2025-04-14 12:28:00'),
(6, 'Holiday Notce', 'Without any reason tomorrow is holiday.', 'announce-17446601641.jpg', '2025-04-14 13:49:24', '2025-04-14 13:49:24'),
(7, 'Boishak Holiday', 'Today Boishak Holiday\r\nIf any one went to office. they can be attend the office', 'announce-17446950881.jpg', '2025-04-14 23:31:28', '2025-04-14 23:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'CSE', NULL, NULL),
(2, 'BBA', NULL, NULL),
(3, 'DBA', NULL, NULL),
(4, 'EEE', NULL, NULL),
(5, 'LLB', NULL, NULL),
(6, 'ENG', NULL, NULL),
(7, 'CIVIL', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_04_13_163945_create_admins_table', 1),
(6, '2025_04_14_045037_create_departments_table', 1),
(9, '2025_04_14_071036_create_tasks_table', 2),
(10, '2025_04_14_181227_create_announcements_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `teacherId` int(11) NOT NULL,
  `stdId` int(11) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `date`, `status`, `teacherId`, `stdId`, `feedback`, `created_at`, `updated_at`) VALUES
(1, 'Find the largest value problem?', 'Use C Language', '2025-04-14', 1, 2, 1, 'Done', '2025-04-14 02:08:40', '2025-04-14 11:39:08'),
(3, 'Newton 3rd Law solved.', 'Hand Write,\r\nSubmit in picture.\r\nDon\'t copy to other person.', '2025-04-14', 2, 5, 1, 'Done', '2025-04-14 02:09:27', '2025-04-14 11:52:42'),
(4, 'Tree generate usign C', 'Graph Tree\r\nUse only your mind\r\nDo not use AI', '2025-04-14', 3, 5, 1, 'Done', '2025-04-14 03:20:38', '2025-04-14 11:45:56'),
(5, 'Number wise month find.', 'Using C language,\r\nonly if else statement.', '2025-04-14', 0, 1, NULL, NULL, '2025-04-14 11:45:35', '2025-04-14 11:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
