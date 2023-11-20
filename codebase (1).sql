-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2023 at 06:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codebase`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_logs`
--

CREATE TABLE `action_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `action_type` enum('create','update','delete') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '1-active, 0-inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `profile`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin Test', 'admin@test', 'admin', '$2y$10$uEXhYu9GfnGPBRtONswyeec9l8CpnllHMraKwZZr.qtFsDfHWWze2', '64ca51a54df3d1690980773.jpg', 1, NULL, '2023-08-02 06:52:53', NULL),
(2, 'admin test1', 'admin1@test', 'admin1', '$2y$10$D8aEYA0jPI6hkwcmHjzer.2jOtBdAhB8.NIpNmzo3CQEbY/sSKJzu', NULL, 1, '2023-08-15 01:19:38', '2023-08-15 01:19:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins_modules`
--

CREATE TABLE `admins_modules` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` int UNSIGNED DEFAULT NULL,
  `module_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins_modules`
--

INSERT INTO `admins_modules` (`id`, `admin_id`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins_permissions`
--

CREATE TABLE `admins_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` int UNSIGNED DEFAULT NULL,
  `permission_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins_permissions`
--

INSERT INTO `admins_permissions` (`id`, `admin_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint DEFAULT NULL COMMENT '1-yes,0-no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `flag`, `is_default`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'English', 'en', NULL, 1, '2023-08-04 08:13:51', '2023-08-04 08:13:51', NULL),
(2, 'Bangla', 'bn', NULL, NULL, '2023-08-04 08:37:18', '2023-08-04 08:37:18', NULL),
(3, 'Hindi', 'hn', '64db96092cae61692112393.png', NULL, '2023-08-04 09:05:00', '2023-08-15 09:28:20', '2023-08-15 09:28:20'),
(4, 'Malaysia', 'ml', '64db95a52202b1692112293.png', NULL, '2023-08-07 00:00:59', '2023-08-15 09:25:23', '2023-08-15 09:25:23'),
(5, 'Indonesia', 'in', 'C:\\Users\\KYTWOTONE\\AppData\\Local\\Temp\\php1B6A.tmp', NULL, '2023-08-15 08:07:53', '2023-08-15 09:28:42', '2023-08-15 09:28:42'),
(6, 'Arabic', 'ar', '64db8d4b924351692110155.jpg', NULL, '2023-08-15 08:35:55', '2023-08-15 09:18:17', '2023-08-15 09:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_19_063227_create_admins_table', 1),
(7, '2023_07_19_063551_create_sessions_table', 1),
(8, '2023_07_19_154659_create_roles_table', 1),
(9, '2023_07_19_164932_create_action_logs_table', 1),
(10, '2023_07_23_062201_create_modules_table', 1),
(11, '2023_07_24_082230_create_permissions_table', 1),
(12, '2023_07_24_094428_create_users_permissions_table', 1),
(13, '2023_07_25_053521_create_users_modules_table', 2),
(14, '2023_08_02_074016_create_admins_permissions_table', 3),
(15, '2023_08_02_074103_create_admins_modules_table', 3),
(16, '2023_08_04_123942_create_languages_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `link`, `route_name`, `icon`, `sequence`, `parent_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Module', 'modules', 'modules', 'fas fa-align-right', '1', 9, 1, NULL, '2023-08-23 17:13:19', NULL),
(2, 'Permission', 'permissions', NULL, '', '2', 9, 1, '2023-07-23 22:38:41', '2023-08-23 17:12:57', NULL),
(3, 'Role', 'roles', NULL, '', '3', 9, 1, '2023-07-23 22:40:10', '2023-08-23 17:12:42', NULL),
(4, 'User', 'users', NULL, '<i class=\"fas fa-user\"></i>', '4', 0, 1, '2023-07-26 16:45:46', '2023-08-02 01:20:27', NULL),
(5, 'Admin', 'admins', NULL, '<i class=\"fas fa-user\"></i>', '5', 0, 1, '2023-08-02 00:58:30', '2023-08-02 02:23:21', NULL),
(6, 'Admin', 'admins', NULL, '<i class=\"fas fa-user\"></i>', '5', 0, 1, '2023-08-02 00:58:58', '2023-08-02 00:59:17', '2023-08-02 00:59:17'),
(7, 'sdfs', 'sfs', NULL, 's', '2', 4, 1, '2023-08-02 02:21:52', '2023-08-02 02:23:14', '2023-08-02 02:23:14'),
(8, 'fsdfs', 'fsdfs', NULL, 'sdfds', '432', 4, 1, '2023-08-02 02:22:46', '2023-08-02 02:23:09', '2023-08-02 02:23:09'),
(9, 'Site Setting', 'site-setting', NULL, '', '6', 9, 1, '2023-08-02 04:07:44', '2023-08-21 23:55:08', NULL),
(10, 'Language', 'languages', NULL, 'fas fa-user', '6', 9, 1, '2023-08-04 01:59:59', '2023-08-23 17:13:50', NULL),
(11, 'Dashboard', 'dashboard', NULL, 'fas fa-align-right', '6', 0, 1, '2023-08-14 20:34:49', '2023-08-15 03:49:32', NULL),
(12, 'asda', 'asda', NULL, '', '3', 0, 1, '2023-08-14 22:16:14', '2023-08-14 23:26:44', '2023-08-14 23:26:44'),
(13, 'terte', 'terte', NULL, 'ertert', '454', 0, 1, '2023-08-14 22:37:55', '2023-08-14 23:26:44', '2023-08-14 23:26:44'),
(14, 'dsad', 'dsad', NULL, '', '3213', 0, 1, '2023-08-14 22:41:22', '2023-08-14 23:26:44', '2023-08-14 23:26:44'),
(15, 'fsdf', 'fsdf', NULL, '', '4232', 0, 1, '2023-08-14 22:43:08', '2023-08-14 23:26:44', '2023-08-14 23:26:44'),
(16, 'sa', 'sa', NULL, 'sa', '6465', 0, 1, '2023-08-14 23:22:13', '2023-08-14 23:26:44', '2023-08-14 23:26:44'),
(17, 'Update', 'update', NULL, 'bx bx-food-tag', '36', 0, 1, '2023-08-15 03:45:05', '2023-08-23 17:10:52', '2023-08-23 17:10:52'),
(18, 'DemoUpdate', 'demoupdate', NULL, '1', '253', 0, 1, '2023-08-21 23:40:38', '2023-08-23 17:10:52', '2023-08-23 17:10:52'),
(19, 'newUpdatenwq', 'newupdatenwq', NULL, '', '263', 0, 1, '2023-08-21 23:46:47', '2023-08-23 17:10:52', '2023-08-23 17:10:52'),
(20, 'Demo', 'demo', NULL, 'fas fa-align-right', '260', 18, 1, '2023-08-22 03:50:05', '2023-08-23 17:10:52', '2023-08-23 17:10:52'),
(21, 'hgjh', 'hgjh', NULL, '423', '422', 0, 1, '2023-08-22 03:51:48', '2023-08-23 17:10:52', '2023-08-23 17:10:52'),
(22, 'hsjdhsahd', 'hsjdhsahd', NULL, '23', '2131', 0, 1, '2023-08-22 04:07:30', '2023-08-23 17:10:52', '2023-08-23 17:10:52'),
(23, 'dasdsadsadwe', 'dasdsadsadwe', NULL, 'ada', '42', 0, 1, '2023-08-22 04:08:28', '2023-08-23 17:10:52', '2023-08-23 17:10:52'),
(24, 'asddsa', 'asddsa', NULL, 'ada', '223', 0, 1, '2023-08-22 04:18:27', '2023-08-23 17:10:53', '2023-08-23 17:10:53'),
(25, 'iojhhjhh', 'iojhhjhh', NULL, '', '', 0, 1, '2023-08-22 04:20:21', '2023-08-23 17:10:53', '2023-08-23 17:10:53'),
(26, 'sada', 'sada', NULL, '', '', 0, 1, '2023-08-22 04:21:41', '2023-08-23 17:10:53', '2023-08-23 17:10:53');

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `module_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` bigint DEFAULT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `name`, `slug`, `code`, `route_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'Create Role', 'create-role', NULL, NULL, '2023-07-24 04:42:00', '2023-07-24 04:42:00', NULL),
(2, 3, 'View Role', 'view-role', NULL, NULL, '2023-07-24 04:42:24', '2023-07-24 04:42:24', NULL),
(3, 3, 'Edit Role', 'edit-role', NULL, NULL, '2023-07-24 04:42:35', '2023-07-24 04:42:35', NULL),
(4, 3, 'Delete Role', 'delete-role', NULL, NULL, '2023-07-24 04:42:49', '2023-07-24 04:42:49', NULL),
(5, 4, 'Create User', 'create-user', NULL, NULL, '2023-07-26 22:46:24', '2023-07-26 22:46:24', NULL),
(6, 4, 'Edit User', 'edit-user', NULL, NULL, '2023-07-26 22:46:46', '2023-07-26 22:46:46', NULL),
(7, 4, 'View User', 'view-user', NULL, NULL, '2023-07-26 22:47:15', '2023-07-26 22:47:15', NULL),
(8, 4, 'Delete User', 'delete-user', NULL, NULL, '2023-07-26 22:47:29', '2023-07-26 22:47:29', NULL),
(9, 4, 'Bulk Action User', 'bulk-action-user', NULL, NULL, '2023-07-26 22:47:42', '2023-07-26 22:57:52', NULL),
(10, 1, 'updated', 'updated', NULL, NULL, '2023-07-26 23:04:05', '2023-08-22 11:18:03', '2023-08-22 11:18:03'),
(11, 3, 'po', 'po', NULL, NULL, '2023-08-22 11:17:14', '2023-08-22 11:18:03', '2023-08-22 11:18:03'),
(12, 1, 'Create-Module', 'create-module', NULL, NULL, '2023-08-23 02:10:59', '2023-08-23 02:10:59', NULL),
(13, 1, 'View Module', 'view-module', NULL, NULL, '2023-08-23 02:31:37', '2023-08-23 02:31:37', NULL),
(14, 1, 'Edit Module', 'edit-module', NULL, NULL, '2023-08-23 02:31:58', '2023-08-23 02:52:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL, NULL),
(2, 'Manager', NULL, '2023-07-25 00:26:24', '2023-07-25 00:26:51', '2023-07-25 00:26:51'),
(3, 'Manager', NULL, '2023-07-25 00:28:16', '2023-08-22 11:12:35', '2023-08-22 11:12:35'),
(4, 'Staff', NULL, '2023-08-15 02:37:33', '2023-08-15 02:37:33', NULL),
(5, 'Manager', NULL, '2023-08-15 03:11:55', '2023-08-15 03:11:55', NULL),
(6, 'fs', NULL, '2023-08-15 04:18:18', '2023-08-22 11:12:18', '2023-08-22 11:12:18'),
(7, 'Admin', NULL, '2023-08-15 04:21:48', '2023-08-22 11:12:35', '2023-08-22 11:12:35'),
(8, 'Account', NULL, '2023-08-15 04:23:01', '2023-08-22 11:13:32', NULL),
(9, 'Update', NULL, '2023-08-22 22:48:00', '2023-08-22 22:49:25', '2023-08-22 22:49:25'),
(10, 'New', NULL, '2023-08-22 22:48:07', '2023-08-22 22:50:25', '2023-08-22 22:50:25'),
(11, 'dtre', NULL, '2023-08-22 22:50:16', '2023-08-22 22:50:26', '2023-08-22 22:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '1-active, 0-inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `mobile`, `email_verified_at`, `password`, `remember_token`, `profile`, `gender`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'User Test', 'user@test', 'user', '01869226545', NULL, '$2y$10$uEXhYu9GfnGPBRtONswyeec9l8CpnllHMraKwZZr.qtFsDfHWWze2', NULL, NULL, 'Male', 1, '2023-07-18 14:33:11', '2023-08-22 11:59:46', NULL),
(2, 'User1 Test', 'user1@test', 'user1', '01889226545', NULL, '$2y$10$RFk8xnntpZUraIPStxkr8eovKtGuPKwNYk/zAb/ZCPZcnnT1ex5vu', NULL, '64ca3a34a72281690974772.jpg', 'Male', 1, '2023-07-18 14:33:11', '2023-08-23 22:57:21', NULL),
(5, 'Wasif Jobair', 'wasif.jobair@kdsgroup.net', 'wasif.jobair', '01713108163', NULL, '$2y$10$vt8V75nzdXFRh5cM8da.Ye45EMOt2V7lHjNlpCo90t67.mCv2jIDK', NULL, NULL, 'Male', 1, '2023-09-09 00:00:52', '2023-09-09 00:00:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_modules`
--

CREATE TABLE `users_modules` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `module_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_modules`
--

INSERT INTO `users_modules` (`id`, `user_id`, `module_id`, `created_at`, `updated_at`) VALUES
(55, 2, 1, NULL, NULL),
(56, 2, 3, NULL, NULL),
(57, 2, 4, NULL, NULL),
(58, 5, 1, NULL, NULL),
(59, 5, 4, NULL, NULL),
(60, 5, 5, NULL, NULL),
(63, 1, 1, NULL, NULL),
(64, 1, 4, NULL, NULL),
(65, 1, 9, NULL, NULL),
(66, 1, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `permission_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`id`, `user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(49, 2, 2, NULL, NULL),
(50, 2, 7, NULL, NULL),
(51, 5, 12, NULL, NULL),
(52, 5, 13, NULL, NULL),
(53, 5, 14, NULL, NULL),
(54, 5, 5, NULL, NULL),
(55, 5, 6, NULL, NULL),
(56, 5, 7, NULL, NULL),
(57, 5, 8, NULL, NULL),
(58, 5, 9, NULL, NULL),
(64, 1, 12, NULL, NULL),
(65, 1, 13, NULL, NULL),
(66, 1, 14, NULL, NULL),
(67, 1, 5, NULL, NULL),
(68, 1, 6, NULL, NULL),
(69, 1, 7, NULL, NULL),
(70, 1, 8, NULL, NULL),
(71, 1, 9, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_logs`
--
ALTER TABLE `action_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_logs_user_id_index` (`user_id`),
  ADD KEY `action_logs_admin_id_index` (`admin_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `admins_modules`
--
ALTER TABLE `admins_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins_permissions`
--
ALTER TABLE `admins_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- Indexes for table `users_modules`
--
ALTER TABLE `users_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_logs`
--
ALTER TABLE `action_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins_modules`
--
ALTER TABLE `admins_modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins_permissions`
--
ALTER TABLE `admins_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_modules`
--
ALTER TABLE `users_modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users_permissions`
--
ALTER TABLE `users_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
