-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 11:44 PM
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
-- Database: `scrubhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin',
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `role`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@example.com', 'admin', '../assets/images/admins/684078684d9fa_cleanesta-logo.png', '2025-06-04 07:16:20', '2025-06-04 16:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('pending','confirmed','completed','cancelled') DEFAULT 'pending',
  `total_price` decimal(10,2) NOT NULL,
  `special_instructions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_hours`
--

CREATE TABLE `business_hours` (
  `id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `is_closed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_hours`
--

INSERT INTO `business_hours` (`id`, `day`, `open_time`, `close_time`, `is_closed`, `created_at`, `updated_at`) VALUES
(1, 'Monday', '08:00:00', '18:00:00', 0, '2025-06-04 10:33:47', '2025-06-04 10:33:47'),
(2, 'Tuesday', '08:00:00', '18:00:00', 0, '2025-06-04 10:33:47', '2025-06-04 10:33:47'),
(3, 'Wednesday', '08:00:00', '18:00:00', 0, '2025-06-04 10:33:47', '2025-06-04 10:33:47'),
(4, 'Thursday', '08:00:00', '18:00:00', 0, '2025-06-04 10:33:47', '2025-06-04 10:33:47'),
(5, 'Friday', '08:00:00', '18:00:00', 0, '2025-06-04 10:33:47', '2025-06-04 10:33:47'),
(6, 'Saturday', '09:00:00', '16:00:00', 0, '2025-06-04 10:33:47', '2025-06-04 10:33:47'),
(7, 'Sunday', NULL, NULL, 1, '2025-06-04 10:33:47', '2025-06-04 10:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `whatsapp_link` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `whatsapp_link`, `email`, `created_at`, `updated_at`) VALUES
(1, 'https://wa.me/447359129002', 'salo.aseidua34@gmail.com', '2025-06-04 10:33:10', '2025-06-04 10:33:10');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--
-- Error reading structure for table scrubhub.promotions: #1146 - Table &#039;scrubhub.promotions&#039; doesn&#039;t exist
-- Error reading data for table scrubhub.promotions: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `scrubhub`.`promotions`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `booking_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by_admin` int(11) DEFAULT NULL,
  `updated_by_admin` int(11) DEFAULT NULL,
  `deleted_by_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `admin_id`, `booking_id`, `rating`, `comment`, `created_at`, `updated_at`, `created_by_admin`, `updated_by_admin`, `deleted_by_admin`) VALUES
(1, NULL, NULL, 1, 5, 'Excellent service! Very thorough and professional.', '2025-05-31 10:46:47', '2025-05-31 10:46:47', NULL, NULL, NULL),
(2, NULL, NULL, 2, 4, 'Good deep cleaning service. Would recommend.', '2025-05-31 10:46:47', '2025-05-31 10:46:47', NULL, NULL, NULL),
(3, 'cole', NULL, 0, 4, 'great', '2025-06-04 09:16:38', '2025-06-04 09:16:38', NULL, NULL, NULL),
(4, 'test', NULL, 0, 3, 'test', '2025-06-04 19:11:10', '2025-06-04 19:11:10', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by_admin` int(11) DEFAULT NULL,
  `updated_by_admin` int(11) DEFAULT NULL,
  `deleted_by_admin` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`features`)),
  `benefits` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `base_price`, `duration_minutes`, `is_active`, `created_at`, `updated_at`, `created_by_admin`, `updated_by_admin`, `deleted_by_admin`, `image`, `price`, `duration`, `features`, `benefits`) VALUES
(1, 'Regular House Cleaning', 'Standard cleaning service for your home including dusting, vacuuming, and bathroom cleaning', 89.99, 120, 0, '2025-05-31 10:46:47', '2025-06-04 19:14:13', NULL, 1, NULL, '', 0.00, '', '[]', '[]'),
(2, 'Office Cleaning', 'Professional cleaning service for office spaces and commercial properties', 129.99, 180, 1, '2025-05-31 10:46:47', '2025-06-04 06:17:26', NULL, NULL, NULL, '', 0.00, '', '[]', ''),
(3, 'End Of Tenancy Cleaning', 'A comprehensive cleaning service designed for tenants, landlords, and letting agents. Our End Of Tenancy Cleaning ensures every corner of the property is spotless, helping you secure your deposit or prepare for new tenants. Includes deep cleaning of kitchens, bathrooms, living areas, appliances, and all surfaces.', 199.99, 300, 1, '2025-06-04 05:53:56', '2025-06-04 06:17:26', NULL, NULL, NULL, '', 0.00, '', '[]', '[]'),
(4, 'After Events Cleaning', 'Restore your venue to pristine condition after any event! Our After Events Cleaning service handles post-party mess, including trash removal, stain treatment, floor and surface cleaning, and resetting the space for regular use. Perfect for private parties, corporate events, and celebrations.', 179.99, 240, 1, '2025-06-04 05:53:56', '2025-06-04 06:17:26', NULL, NULL, NULL, '', 0.00, '', '[]', '[]'),
(5, 'Vacuuming', 'A focused cleaning service dedicated to thorough vacuuming of all carpets, rugs, and floors. Ideal for removing dust, dirt, pet hair, and allergens, leaving your home or office fresh and spotless.', 49.99, 60, 1, '2025-06-04 06:02:40', '2025-06-04 06:17:26', NULL, NULL, NULL, '', 0.00, '', '[]', '[]'),
(6, 'School Cleaning', 'A specialized cleaning service tailored for educational environments. Our School Cleaning ensures classrooms, hallways, restrooms, and common areas are thoroughly cleaned and sanitized, providing a safe and healthy space for students and staff.', 299.99, 360, 1, '2025-06-04 06:08:10', '2025-06-04 06:17:26', NULL, NULL, NULL, '', 0.00, '', '[]', '[]'),
(11, 'Carson', 'whatever', 12.00, 1, 1, '2025-06-04 19:13:43', '2025-06-04 19:13:43', 1, NULL, NULL, '', 0.00, '', '[]', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `service_areas`
--

CREATE TABLE `service_areas` (
  `id` int(11) NOT NULL,
  `area_name` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by_admin` int(11) DEFAULT NULL,
  `updated_by_admin` int(11) DEFAULT NULL,
  `deleted_by_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `sid` varchar(36) NOT NULL,
  `expires` datetime DEFAULT NULL,
  `data` text DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `created_at`, `updated_at`) VALUES
(1, 'cleanesta-logo', '../assets/images/logo/cleanesta-logo.png', '2025-06-04 10:34:03', '2025-06-04 14:17:57'),
(2, 'favicon', '../assets/images/logo/cleanesta-logo.png', '2025-06-04 10:34:03', '2025-06-04 14:17:57'),
(3, 'cleanesta-description', 'Bringing sparkle to your space. Trusted by hundreds for spotless home and office cleaning services.', '2025-06-04 10:34:03', '2025-06-04 14:18:08'),
(4, 'social-media-links', 'null', '2025-06-04 10:34:03', '2025-06-04 14:18:08'),
(5, 'terms-of-service', 'test', '2025-06-04 10:34:03', '2025-06-04 14:18:08'),
(6, 'privacy-policy', 'test', '2025-06-04 10:34:03', '2025-06-04 14:18:08'),
(7, 'theme-colors', '{\n    \"primary\": \"#f34d26\",\n    \"secondary\": \"#00bda4\",\n    \"accent\": \"#7d2ea8\",\n    \"neutral\": \"#ffffff\",\n    \"dark\": \"#1f1f1f\"\n}', '2025-06-04 10:34:03', '2025-06-04 14:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `staff_availability`
--

CREATE TABLE `staff_availability` (
  `id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by_admin` int(11) DEFAULT NULL,
  `updated_by_admin` int(11) DEFAULT NULL,
  `deleted_by_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_availability`
--

INSERT INTO `staff_availability` (`id`, `day_of_week`, `start_time`, `end_time`, `is_available`, `created_at`, `updated_at`, `created_by_admin`, `updated_by_admin`, `deleted_by_admin`) VALUES
(1, 'Monday', '09:00:00', '17:00:00', 1, '2025-05-31 10:46:47', '2025-05-31 10:46:47', NULL, NULL, NULL),
(2, 'Tuesday', '09:00:00', '17:00:00', 1, '2025-05-31 10:46:47', '2025-06-04 13:36:35', NULL, 1, NULL),
(3, 'Wednesday', '09:00:00', '17:00:00', 1, '2025-05-31 10:46:47', '2025-05-31 10:46:47', NULL, NULL, NULL),
(4, 'Monday', '10:00:00', '18:00:00', 1, '2025-05-31 10:46:47', '2025-05-31 10:46:47', NULL, NULL, NULL),
(5, 'Tuesday', '10:00:00', '18:00:00', 1, '2025-05-31 10:46:47', '2025-05-31 10:46:47', NULL, NULL, NULL),
(6, 'Wednesday', '10:00:00', '18:00:00', 1, '2025-05-31 10:46:47', '2025-05-31 10:46:47', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `business_hours`
--
ALTER TABLE `business_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `fk_reviews_admin` (`admin_id`),
  ADD KEY `fk_reviews_created_by_admin` (`created_by_admin`),
  ADD KEY `fk_reviews_updated_by_admin` (`updated_by_admin`),
  ADD KEY `fk_reviews_deleted_by_admin` (`deleted_by_admin`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_services_created_by_admin` (`created_by_admin`),
  ADD KEY `fk_services_updated_by_admin` (`updated_by_admin`),
  ADD KEY `fk_services_deleted_by_admin` (`deleted_by_admin`);

--
-- Indexes for table `service_areas`
--
ALTER TABLE `service_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_service_areas_created_by_admin` (`created_by_admin`),
  ADD KEY `fk_service_areas_updated_by_admin` (`updated_by_admin`),
  ADD KEY `fk_service_areas_deleted_by_admin` (`deleted_by_admin`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `staff_availability`
--
ALTER TABLE `staff_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_staff_availability_created_by_admin` (`created_by_admin`),
  ADD KEY `fk_staff_availability_updated_by_admin` (`updated_by_admin`),
  ADD KEY `fk_staff_availability_deleted_by_admin` (`deleted_by_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `business_hours`
--
ALTER TABLE `business_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `service_areas`
--
ALTER TABLE `service_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff_availability`
--
ALTER TABLE `staff_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_admin` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_reviews_created_by_admin` FOREIGN KEY (`created_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_reviews_deleted_by_admin` FOREIGN KEY (`deleted_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_reviews_updated_by_admin` FOREIGN KEY (`updated_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_services_created_by_admin` FOREIGN KEY (`created_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_services_deleted_by_admin` FOREIGN KEY (`deleted_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_services_updated_by_admin` FOREIGN KEY (`updated_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `service_areas`
--
ALTER TABLE `service_areas`
  ADD CONSTRAINT `fk_service_areas_created_by_admin` FOREIGN KEY (`created_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_service_areas_deleted_by_admin` FOREIGN KEY (`deleted_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_service_areas_updated_by_admin` FOREIGN KEY (`updated_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `staff_availability`
--
ALTER TABLE `staff_availability`
  ADD CONSTRAINT `fk_staff_availability_created_by_admin` FOREIGN KEY (`created_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_staff_availability_deleted_by_admin` FOREIGN KEY (`deleted_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_staff_availability_updated_by_admin` FOREIGN KEY (`updated_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
