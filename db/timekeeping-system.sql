-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2022 at 03:11 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timekeeping-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjustment_emp`
--

CREATE TABLE `adjustment_emp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_ID` bigint(20) UNSIGNED NOT NULL,
  `time_ID` bigint(20) UNSIGNED NOT NULL,
  `att_ID` bigint(20) UNSIGNED NOT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `status1` enum('PENDING','APPROVED','SENT BACK','REJECTED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `status2` enum('PENDING','APPROVED','SENT BACK','REJECTED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_at1` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at2` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `approval1_ID` bigint(20) UNSIGNED NOT NULL,
  `approval2_ID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_ID` bigint(20) UNSIGNED NOT NULL,
  `time_ID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `change_shift_emp`
--

CREATE TABLE `change_shift_emp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_ID` bigint(20) UNSIGNED NOT NULL,
  `shift_emp_ID` bigint(20) UNSIGNED NOT NULL,
  `shift_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `status1` enum('PENDING','APPROVED','SENT BACK','REJECTED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `status2` enum('PENDING','APPROVED','SENT BACK','REJECTED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_at1` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at2` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dept_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'IT', 'dsfsd\r\nsdfsdf\r\n\r\nsdf', '2022-04-19 20:29:17', '2022-04-19 20:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_bal_emp`
--

CREATE TABLE `leave_bal_emp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_ID` bigint(20) UNSIGNED NOT NULL,
  `main_leave_ID` bigint(20) UNSIGNED NOT NULL,
  `balance` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_emp`
--

CREATE TABLE `leave_emp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_ID` bigint(20) UNSIGNED NOT NULL,
  `main_leave_ID` bigint(20) UNSIGNED NOT NULL,
  `sub_leave_ID` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `status1` enum('PENDING','APPROVED','SENT BACK','REJECTED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `status2` enum('PENDING','APPROVED','SENT BACK','REJECTED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_at1` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at2` timestamp NOT NULL DEFAULT current_timestamp(),
  `document_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_leaves`
--

CREATE TABLE `main_leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_leave_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_balance` int(11) NOT NULL,
  `req_doc` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_leaves`
--

INSERT INTO `main_leaves` (`id`, `main_leave_name`, `description`, `total_balance`, `req_doc`, `created_at`, `updated_at`) VALUES
(1, 'Dummy', 'dummy\r\n\r\ndescription of this leave', 113, 'NO', '2022-04-19 20:28:45', '2022-04-19 20:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2022_04_05_061722_create_departments_table', 1),
(6, '2022_04_05_062006_create_shifts_table', 1),
(7, '2022_04_05_062331_create_main_leaves_table', 1),
(8, '2022_04_05_062404_create_sub_leaves_table', 1),
(9, '2022_04_19_071242_create_comments_table', 1),
(10, '2022_04_19_072025_create_time_adjustments_table', 1),
(11, '2022_04_19_074551_create_approvals_table', 1),
(12, '2022_04_19_080522_create_shift_emp_table', 1),
(13, '2022_04_19_103303_add_columns_to_users_table', 2),
(14, '2022_04_19_121432_create_attendance_table', 3),
(15, '2022_04_19_121705_create_adjustment_emp_table', 3),
(16, '2022_04_19_122731_create_overtime_emp_table', 3),
(17, '2022_04_19_123548_create_leave_bal_emp_table', 3),
(18, '2022_04_19_123823_create_leave_emp_table', 3),
(19, '2022_04_19_125408_create_change_shift_emp_table', 3),
(20, '2022_04_20_041231_change_name_to_main_leaves_and_sub_leaves_table', 4),
(21, '2022_04_20_061346_add_columns_to_requests_table', 5),
(22, '2022_04_20_065313_add_role_to_users_table', 6),
(23, '2022_04_20_121142_change_nullable_to_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `overtime_emp`
--

CREATE TABLE `overtime_emp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_ID` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `status1` enum('PENDING','APPROVED','SENT BACK','REJECTED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `status2` enum('PENDING','APPROVED','SENT BACK','REJECTED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_at1` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at2` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shift_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shift_emp`
--

CREATE TABLE `shift_emp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_ID` bigint(20) UNSIGNED NOT NULL,
  `shift_ID` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_leaves`
--

CREATE TABLE `sub_leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_leave_ID` bigint(20) UNSIGNED NOT NULL,
  `sub_leave_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_leaves`
--

INSERT INTO `sub_leaves` (`id`, `main_leave_ID`, `sub_leave_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'dummy sub', 'sdfsdfd\r\n\r\ndsf', '2022-04-19 20:01:54', '2022-04-19 20:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `time_adjustments`
--

CREATE TABLE `time_adjustments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time_in1` time DEFAULT NULL,
  `time_out1` time DEFAULT NULL,
  `time_in2` time DEFAULT NULL,
  `time_out2` time DEFAULT NULL,
  `time_in3` time DEFAULT NULL,
  `time_out3` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dept_ID` bigint(20) UNSIGNED NOT NULL,
  `approval_ID` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_ID` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjustment_emp`
--
ALTER TABLE `adjustment_emp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adjustment_emp_emp_id_foreign` (`emp_ID`),
  ADD KEY `adjustment_emp_time_id_foreign` (`time_ID`),
  ADD KEY `adjustment_emp_att_id_foreign` (`att_ID`),
  ADD KEY `adjustment_emp_comment_id_foreign` (`comment_ID`);

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approvals_approval1_id_foreign` (`approval1_ID`),
  ADD KEY `approvals_approval2_id_foreign` (`approval2_ID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_emp_id_foreign` (`emp_ID`),
  ADD KEY `attendance_time_id_foreign` (`time_ID`);

--
-- Indexes for table `change_shift_emp`
--
ALTER TABLE `change_shift_emp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `change_shift_emp_emp_id_foreign` (`emp_ID`),
  ADD KEY `change_shift_emp_shift_emp_id_foreign` (`shift_emp_ID`),
  ADD KEY `change_shift_emp_shift_id_foreign` (`shift_ID`),
  ADD KEY `change_shift_emp_comment_id_foreign` (`comment_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `leave_bal_emp`
--
ALTER TABLE `leave_bal_emp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_bal_emp_emp_id_foreign` (`emp_ID`),
  ADD KEY `leave_bal_emp_main_leave_id_foreign` (`main_leave_ID`);

--
-- Indexes for table `leave_emp`
--
ALTER TABLE `leave_emp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_emp_emp_id_foreign` (`emp_ID`),
  ADD KEY `leave_emp_main_leave_id_foreign` (`main_leave_ID`),
  ADD KEY `leave_emp_sub_leave_id_foreign` (`sub_leave_ID`),
  ADD KEY `leave_emp_comment_id_foreign` (`comment_ID`);

--
-- Indexes for table `main_leaves`
--
ALTER TABLE `main_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime_emp`
--
ALTER TABLE `overtime_emp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `overtime_emp_emp_id_foreign` (`emp_ID`),
  ADD KEY `overtime_emp_comment_id_foreign` (`comment_ID`);

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
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift_emp`
--
ALTER TABLE `shift_emp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shift_emp_emp_id_foreign` (`emp_ID`),
  ADD KEY `shift_emp_shift_id_foreign` (`shift_ID`);

--
-- Indexes for table `sub_leaves`
--
ALTER TABLE `sub_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_leaves_main_leave_id_foreign` (`main_leave_ID`);

--
-- Indexes for table `time_adjustments`
--
ALTER TABLE `time_adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_dept_id_foreign` (`dept_ID`),
  ADD KEY `users_approval_id_foreign` (`approval_ID`),
  ADD KEY `users_sub_id_foreign` (`sub_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adjustment_emp`
--
ALTER TABLE `adjustment_emp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `change_shift_emp`
--
ALTER TABLE `change_shift_emp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_bal_emp`
--
ALTER TABLE `leave_bal_emp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_emp`
--
ALTER TABLE `leave_emp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_leaves`
--
ALTER TABLE `main_leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `overtime_emp`
--
ALTER TABLE `overtime_emp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shift_emp`
--
ALTER TABLE `shift_emp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_leaves`
--
ALTER TABLE `sub_leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time_adjustments`
--
ALTER TABLE `time_adjustments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adjustment_emp`
--
ALTER TABLE `adjustment_emp`
  ADD CONSTRAINT `adjustment_emp_att_id_foreign` FOREIGN KEY (`att_ID`) REFERENCES `attendance` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adjustment_emp_comment_id_foreign` FOREIGN KEY (`comment_ID`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adjustment_emp_emp_id_foreign` FOREIGN KEY (`emp_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adjustment_emp_time_id_foreign` FOREIGN KEY (`time_ID`) REFERENCES `time_adjustments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_approval1_id_foreign` FOREIGN KEY (`approval1_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `approvals_approval2_id_foreign` FOREIGN KEY (`approval2_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_emp_id_foreign` FOREIGN KEY (`emp_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_time_id_foreign` FOREIGN KEY (`time_ID`) REFERENCES `time_adjustments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `change_shift_emp`
--
ALTER TABLE `change_shift_emp`
  ADD CONSTRAINT `change_shift_emp_comment_id_foreign` FOREIGN KEY (`comment_ID`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `change_shift_emp_emp_id_foreign` FOREIGN KEY (`emp_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `change_shift_emp_shift_emp_id_foreign` FOREIGN KEY (`shift_emp_ID`) REFERENCES `shift_emp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `change_shift_emp_shift_id_foreign` FOREIGN KEY (`shift_ID`) REFERENCES `shifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_bal_emp`
--
ALTER TABLE `leave_bal_emp`
  ADD CONSTRAINT `leave_bal_emp_emp_id_foreign` FOREIGN KEY (`emp_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_bal_emp_main_leave_id_foreign` FOREIGN KEY (`main_leave_ID`) REFERENCES `main_leaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_emp`
--
ALTER TABLE `leave_emp`
  ADD CONSTRAINT `leave_emp_comment_id_foreign` FOREIGN KEY (`comment_ID`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_emp_emp_id_foreign` FOREIGN KEY (`emp_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_emp_main_leave_id_foreign` FOREIGN KEY (`main_leave_ID`) REFERENCES `main_leaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_emp_sub_leave_id_foreign` FOREIGN KEY (`sub_leave_ID`) REFERENCES `sub_leaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `overtime_emp`
--
ALTER TABLE `overtime_emp`
  ADD CONSTRAINT `overtime_emp_comment_id_foreign` FOREIGN KEY (`comment_ID`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `overtime_emp_emp_id_foreign` FOREIGN KEY (`emp_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shift_emp`
--
ALTER TABLE `shift_emp`
  ADD CONSTRAINT `shift_emp_emp_id_foreign` FOREIGN KEY (`emp_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shift_emp_shift_id_foreign` FOREIGN KEY (`shift_ID`) REFERENCES `shifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_leaves`
--
ALTER TABLE `sub_leaves`
  ADD CONSTRAINT `sub_leaves_main_leave_id_foreign` FOREIGN KEY (`main_leave_ID`) REFERENCES `main_leaves` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_approval_id_foreign` FOREIGN KEY (`approval_ID`) REFERENCES `approvals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_dept_id_foreign` FOREIGN KEY (`dept_ID`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_sub_id_foreign` FOREIGN KEY (`sub_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
