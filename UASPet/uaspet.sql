-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2025 at 09:02 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uaspet`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoption_pets`
--

CREATE TABLE `adoption_pets` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `species` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `breed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` decimal(5,2) DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaccinated` tinyint(1) NOT NULL DEFAULT '0',
  `sterilized` tinyint(1) NOT NULL DEFAULT '0',
  `dewormed` tinyint(1) NOT NULL DEFAULT '0',
  `adoption_fee` decimal(65,2) NOT NULL DEFAULT '0.00',
  `status` enum('available','reserved','adopted','pending') COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` json DEFAULT NULL,
  `special_notes` text COLLATE utf8mb4_unicode_ci,
  `entry_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adoption_pets`
--

INSERT INTO `adoption_pets` (`id`, `name`, `species`, `breed`, `age`, `gender`, `weight`, `color`, `description`, `vaccinated`, `sterilized`, `dewormed`, `adoption_fee`, `status`, `images`, `special_notes`, `entry_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Milao', 'kucing', 'Persian', '5.00', 'female', '1.00', 'Putih', 'pendiam', 1, 1, 1, '150000000.00', 'available', '\"[\\\"adoption-pets\\\\/NWtm8nej0V01eaodvCsm.jpg\\\"]\"', 'makan daging', '2025-12-04', '2025-12-04 02:28:24', '2025-12-04 02:28:24', NULL),
(6, 'maspur', 'kucing', 'domestik', '6.00', 'female', '0.90', 'coklat', 'Sangat Aktif', 1, 1, 1, '10000.00', 'available', '\"[\\\"adoption-pets\\\\/LhNLJqxM5c6eGIYOarqO.jpeg\\\"]\"', 'alergi makan rumput', '2025-12-04', '2025-12-04 05:50:49', '2025-12-04 05:50:49', NULL),
(7, 'Bhalul', 'anjing', 'Chiwawa', '24.00', 'male', '2.50', 'Putih Krem', 'Aktif dan sensitif dengan orang baru', 1, 1, 1, '10000.00', 'adopted', '\"[\\\"adoption-pets\\\\/9ygxKOSsAXMqnTXhIO0N.jpg\\\",\\\"adoption-pets\\\\/AIXHZckcreSKFRffZnI2.jpg\\\"]\"', 'suka menggigit', '2025-12-04', '2025-12-04 08:33:58', '2025-12-04 08:36:10', NULL),
(8, 'Dora', 'kucing', 'Persian', '12.00', 'female', '2.00', 'Putih Krem', 'Pemalu dan sensitif', 1, 1, 1, '100000.00', 'available', '\"[\\\"adoption-pets\\\\/4wBVERhQDAyUKvxK2TvK.jpeg\\\"]\"', 'Butuh mainan', '2025-12-04', '2025-12-04 08:57:42', '2025-12-04 08:57:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(5, '2025_12_01_062301_add_google_columns_to_users_table', 2),
(12, '2025_12_03_142736_create_pet_hotel_bookings_table', 3),
(13, '2025_12_03_155312_add_payment_fields_to_pet_hotel_bookings_table', 4),
(15, '2025_12_03_161935_add_is_admin_to_users_table', 5),
(16, '2025_12_03_231037_create_adoption_pets_table', 6);

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
-- Table structure for table `pet_hotel_bookings`
--

CREATE TABLE `pet_hotel_bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pet_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pet_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pet_weight` decimal(5,2) NOT NULL,
  `temprament` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_type` enum('standard','premium','luxury') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bring_own_food` tinyint(1) NOT NULL DEFAULT '0',
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` int NOT NULL,
  `paid_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `payment_date` datetime DEFAULT NULL,
  `payment_status` enum('unpaid','paid','partial') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','confirmed','checked_in','checked_out','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_notes` text COLLATE utf8mb4_unicode_ci,
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_hotel_bookings`
--

INSERT INTO `pet_hotel_bookings` (`id`, `user_id`, `owner_name`, `owner_phone`, `pet_name`, `pet_type`, `pet_weight`, `temprament`, `room_type`, `bring_own_food`, `check_in`, `check_out`, `total_price`, `paid_amount`, `payment_date`, `payment_status`, `payment_method`, `payment_proof`, `status`, `user_notes`, `admin_notes`, `created_at`, `updated_at`) VALUES
(8, 7, 'Shaquille Rashaun Sahl Tamrin _TEKOM E', '081280946366', 'Milo', 'Kucing', '1.00', 'tenang', 'standard', 1, '2025-12-07', '2025-12-13', 252000, '252000.00', '2025-12-03 23:01:13', 'paid', 'qris', 'payment-proofs/BqRzss6GEYtz9aXqX1p6lgaHM6Va0479ugVOIi4x.jpg', 'checked_in', NULL, NULL, '2025-12-03 10:59:22', '2025-12-03 15:01:55'),
(10, 10, 'mas gacor', '081208120812', 'sandilak', 'Kelinci', '2.00', 'aktif', 'premium', 0, '2025-12-05', '2025-12-06', 85000, '0.00', NULL, 'unpaid', NULL, NULL, 'pending', NULL, NULL, '2025-12-04 05:19:48', '2025-12-04 06:13:22'),
(11, 7, 'sahl', '081280946366', 'Murfa', 'Anjing', '20.00', 'aktif', 'luxury', 0, '2025-12-05', '2025-12-12', 1050000, '0.00', NULL, 'unpaid', NULL, NULL, 'pending', 'hati hati menggigit', NULL, '2025-12-04 08:01:07', '2025-12-04 08:01:07'),
(12, 7, 'Shaquille Rashaun Sahl Tamrin _TEKOM E', '081280946366', 'kukubima', 'Kucing', '10.00', 'aktif', 'luxury', 1, '2025-12-05', '2025-12-11', 630000, '0.00', NULL, 'unpaid', NULL, NULL, 'cancelled', 'suka makanan kering', NULL, '2025-12-04 08:04:53', '2025-12-04 08:40:00'),
(13, 11, 'Riyadi', '081269696969', 'wokwi', 'Anjing', '5.00', 'aktif', 'luxury', 1, '2025-12-05', '2025-12-06', 105000, '105000.00', '2025-12-04 16:13:01', 'paid', 'qris', 'payment-proofs/9C996l7JbQNiUBAL5nspdkP29dxorP8KCRfVXZCa.jpg', 'checked_in', NULL, NULL, '2025-12-04 08:09:16', '2025-12-04 08:13:47'),
(14, 7, 'Shaquille Rashaun Sahl Tamrin _TEKOM E', '081280946366', 'Cici', 'Kucing', '4.00', 'agresif', 'luxury', 1, '2025-12-05', '2025-12-07', 210000, '210000.00', '2025-12-04 16:54:59', 'paid', 'qris', 'payment-proofs/UjeFYXUUMW5nPzUVqoJAFR28OC4c9p0H4XmNMS89.jpg', 'checked_in', 'Menggigit', NULL, '2025-12-04 08:54:28', '2025-12-04 08:55:51');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('eHB4xXT2sVkFykIlXwY2QPFiqd43jit3fVQAz6DD', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaklTWjk2dlhjUEhaNXlKQUNkUjdUTDRlV2pORlQ2TkYyREowSDZvQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9hZG9wdGlvbi1wZXRzLzgiO3M6NToicm91dGUiO3M6MjQ6ImFkbWluLmFkb3B0aW9uLXBldHMuc2hvdyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==', 1764838666),
('sh6QvrPt9QUMey9SBhVCi3rhAjHXrdVyueRboP1g', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidGw1eENkamtzbzlQV0tCUEJYT3JQODA5RnFXY1dxMlY4ZDBZWXBUUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1764838713),
('XJXpAwg5LXuztAwcuJJpH1vdL4SpAxgMSnJBOXJO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV0dNRHJLdERES1FTZUFWVW90UkdOdzh2ME9YWEg4M0tTWks4S2RDdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hdXRoL2dvb2dsZSI7czo1OiJyb3V0ZSI7czoxMjoibG9naW4uZ29vZ2xlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1OiJzdGF0ZSI7czo0MDoiVEdkeE9RRzBvR0lkYmNMdkQzOUxzRzRCVmVvM3BDQ2tGR21jZFVKYSI7fQ==', 1764833067);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `role`, `email_verified_at`, `password`, `google_id`, `avatar`, `phone`, `date_of_birth`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Shaquille Rashaun Sahl Tamrin _TEKOM E', 'shaqy9center@gmail.com', 0, NULL, '2025-12-02 19:41:27', '$2y$12$d5a5HQGoaqazv4uNTS6u2uat5AunnjlKRmp28niAnD7d3vBRklr0.', '100115472358995525618', 'https://lh3.googleusercontent.com/a/ACg8ocI4gXVbX_pkIIUnEovyvDGALlo6PKllPq52CTMOyN-EcnnX0Iw=s96-c', '081280946366', '2006-08-02', 'Taman Telkomas', 'pkVXLU3TIGqLoZuuDMIRzWbXSsAOdbWidSAKmLG2i18ZrbPnM8T8Geokn42r', '2025-12-02 19:41:27', '2025-12-02 19:41:54'),
(9, 'MathQnA . Project', 'mathqna.project@gmail.com', 1, 'admin', '2025-12-03 08:49:40', '$2y$12$8GUqD0PKu.ELrknCIKM3/.L7/GPjMjCdXGqBXCcRO774NI.KyEOLy', '105837179837196033249', 'https://lh3.googleusercontent.com/a/ACg8ocKWRGFwHANovgxTmsmxzceU6AEe1F0gBen-r1YVAJwdQTXi-A=s96-c', NULL, NULL, NULL, 'fdwuG31lmgUlXkjFxEsaA73blHKWoNolds1MiNrivN33QPyTNtAqsUFVjB7g', '2025-12-03 08:49:40', '2025-12-03 08:50:48'),
(10, 'shaqy7 center', 'shaqy5center@gmail.com', 0, NULL, '2025-12-04 03:51:32', '$2y$12$812fM7n/RhVE2TGFh3QZeuXSDygmmOnzHmXVTdKdqCEt6TcNgHN7m', '102719163775226815411', 'https://lh3.googleusercontent.com/a/ACg8ocIXFlkER9LhHd45lq8pbiJIDwT2kZILlWNfCsmwhjRkmE9b7w=s96-c', NULL, NULL, NULL, '4Aw2N25vhVunyTo3DkzoRU9MNpAkrz0gdtMzosm1fYNA73dTKSe5ItCcDPfV', '2025-12-04 03:51:33', '2025-12-04 03:51:33'),
(11, 'riyadi', 'shaquille282@smk.belajar.id', 0, NULL, '2025-12-04 08:08:20', '$2y$12$uN.mU/hP9Xy88IOFxknzleXp.cYWelhsXafPN2XHkz50Bmt9AkYLK', '115357551565810913923', 'https://lh3.googleusercontent.com/a/ACg8ocLYpFvpviMtW5EseOfnGy6WyQQbWN8cR-g7_P8cpijzf8Ldyg=s96-c', '0812898989', '2006-07-21', 'gowa', 'XRSjazOrpdLviKfO7HT0YbnSUInkPhZ02hM2aE76HpcdvtU3I9hAq1YG2Yku', '2025-12-04 08:08:20', '2025-12-04 08:29:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption_pets`
--
ALTER TABLE `adoption_pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pet_hotel_bookings`
--
ALTER TABLE `pet_hotel_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_hotel_bookings_user_id_foreign` (`user_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption_pets`
--
ALTER TABLE `adoption_pets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pet_hotel_bookings`
--
ALTER TABLE `pet_hotel_bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_hotel_bookings`
--
ALTER TABLE `pet_hotel_bookings`
  ADD CONSTRAINT `pet_hotel_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
