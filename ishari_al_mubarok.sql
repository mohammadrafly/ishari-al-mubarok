-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2023 at 07:42 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ishari_al_mubarok`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int UNSIGNED NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-02-02-182625', 'App\\Database\\Migrations\\Users', 'default', 'App', 1685978648, 1),
(2, '2023-02-02-182658', 'App\\Database\\Migrations\\Orders', 'default', 'App', 1685978648, 1),
(3, '2023-02-02-182741', 'App\\Database\\Migrations\\Gallery', 'default', 'App', 1685978648, 1),
(4, '2023-02-24-084047', 'App\\Database\\Migrations\\Token', 'default', 'App', 1685978648, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `tanggal_event` varchar(150) NOT NULL,
  `waktu_event` varchar(150) NOT NULL,
  `kategori_event` varchar(150) NOT NULL,
  `harga` varchar(150) NOT NULL DEFAULT '300000',
  `lokasi_event` text NOT NULL,
  `detail_lokasi` text NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `status` enum('dalam_pemeriksaan','pending','on_progres','done') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'dalam_pemeriksaan',
  `foto_pembayaran` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username`, `tanggal_event`, `waktu_event`, `kategori_event`, `harga`, `lokasi_event`, `detail_lokasi`, `no_hp`, `status`, `foto_pembayaran`, `created_at`, `updated_at`) VALUES
(3, 'test', '2023-06-06', '12:00', 'Hadrah Tradisional', '400000', '-7.731003507034892', '113.68926476726034', '123123123', 'pending', 'YIj0RkW1.jpg', '2023-06-06 05:59:38', '2023-06-06 05:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `type` enum('forgot_password') NOT NULL DEFAULT 'forgot_password',
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nomor_hp` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `role` enum('client','admin','pengurus') NOT NULL DEFAULT 'client',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `email`, `nomor_hp`, `alamat`, `picture`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$T8HECYgvCenqKQc4k6BY6euY1e5Y28A.QsdkD64kmJc7FmQBQWJH6', 'admin@admin', '', '', NULL, 'admin', '2023-06-05 15:24:32', '2023-06-05 15:24:32'),
(3, 'test', 'test', '$2y$10$MDrPd0f7Z6mLquTruz8j4.shCfo.9OYG5.jQJBgRD9FCQdaklOuTO', 'test@test', '123123123', '', NULL, 'client', '2023-06-05 23:37:11', '2023-06-05 23:37:11'),
(4, 'test2', 'test2', '$2y$10$VqoYqwuGJGtSdnD8GuYvEepl9xb5UzRv3dWCnGeGUP4MllECzQ7om', 'test2@test', '08917273123', '', NULL, 'client', '2023-06-06 06:06:04', '2023-06-06 06:06:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `token` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
