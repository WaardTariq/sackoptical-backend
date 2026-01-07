-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2026 at 08:58 AM
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
-- Database: `sacks-optical`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'super_admin',
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `role`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', NULL, '$2y$10$AmRYlqpgfNryUR7s9OvPCerInOtWiSs/ti3lYbEznBN2P7Rpgxe5C', NULL, 'super_admin', NULL, 1, NULL, '2025-12-23 12:12:14', '2025-12-23 12:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `slug`, `values`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Color', 'color', '[\"Black\",\"Tortoise\",\"Gold\",\"Silver\"]', 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14'),
(2, 'Size', 'size', '[\"Small\",\"Medium\",\"Large\"]', 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14'),
(3, 'nsdfnsdfn', 'nsdfnsdfn', '[\"red\"]', 1, '2025-12-23 12:33:53', '2025-12-23 12:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ray-Ban', 'ray-ban', NULL, 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14'),
(2, 'Oakley', 'oakley', NULL, 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14'),
(3, 'Gucci', 'gucci', NULL, 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_phone` varchar(255) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `currency_symbol` varchar(255) NOT NULL DEFAULT '$',
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tax_settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `currency_settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `stripe_status` tinyint(1) NOT NULL DEFAULT 0,
  `stripe_publishable_key` varchar(255) DEFAULT NULL,
  `stripe_secret_key` varchar(255) DEFAULT NULL,
  `cod_status` tinyint(1) NOT NULL DEFAULT 1,
  `shipping_charges` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `company_name`, `company_email`, `company_phone`, `company_address`, `logo`, `favicon`, `currency`, `currency_symbol`, `social_links`, `tax_settings`, `currency_settings`, `stripe_status`, `stripe_publishable_key`, `stripe_secret_key`, `cod_status`, `shipping_charges`, `created_at`, `updated_at`) VALUES
(1, 'Sacks Optical', 'contact@sacksoptical.com', '+1 555 123 4567', NULL, NULL, NULL, 'USD', '$', NULL, NULL, NULL, 0, NULL, NULL, 1, 0.00, '2025-12-23 12:12:14', '2025-12-23 12:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `lens_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lens_coating_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `banner`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'men', '695b9984c332a.png', NULL, 0, 1, '2025-12-23 12:12:14', '2026-01-05 05:59:16'),
(2, 'Women', 'women', '695b9997d4d5d.png', NULL, 0, 1, '2025-12-23 12:12:14', '2026-01-05 05:59:35'),
(3, 'Eyeglasse', 'eyeglasse', '695b996595926.png', NULL, 0, 1, '2025-12-24 13:01:52', '2026-01-05 05:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `priority` varchar(255) NOT NULL DEFAULT 'normal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Tana Chandler', 'wykojizehi@mailinator.com', 'Voluptatibus accusam', 'Nisi aspernatur nece', 1, '2025-12-30 14:00:26', '2025-12-30 14:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `min_purchase` decimal(10,2) NOT NULL DEFAULT 0.00,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `min_purchase`, `start_date`, `end_date`, `usage_limit`, `status`, `created_at`, `updated_at`) VALUES
(1, 'WELCOME10', 'percent', 10.00, 0.00, NULL, NULL, NULL, 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14');

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
-- Table structure for table `lens_coatings`
--

CREATE TABLE `lens_coatings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_percentage` decimal(5,2) NOT NULL DEFAULT 8.25,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lens_coatings`
--

INSERT INTO `lens_coatings` (`id`, `name`, `slug`, `price`, `tax_percentage`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Anti-Reflective', 'anti-reflective', 30.00, 8.25, 'Reduces glare and eye strain.', 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14'),
(2, 'Blue Light Block', 'blue-light-block', 50.00, 8.25, 'Protects eyes from digital screens.', 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `lens_types`
--

CREATE TABLE `lens_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price_modifier` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lens_types`
--

INSERT INTO `lens_types` (`id`, `name`, `slug`, `image`, `price_modifier`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Single Vision', 'single-vision', 'storage/lenses/1767093990_lens_Vo8Do.png', 0.00, 'Standard lenses for distance or reading.', 1, '2025-12-23 12:12:14', '2025-12-30 06:26:30'),
(2, 'Progressive', 'progressive', 'storage/lenses/1767094075_lens_rXL1t.png', 100.00, 'Multifocal lenses for all distances.', 1, '2025-12-23 12:12:14', '2025-12-30 06:27:55'),
(3, 'Bifocal', 'bifocal', 'storage/lenses/1767094005_lens_07Z5m.png', 50.00, 'Two distinct optical powers.', 1, '2025-12-23 12:12:14', '2025-12-30 06:26:45'),
(4, 'Trifocal', 'trifocal', 'storage/lenses/1767093927_lens_F7P9H.png', 0.00, 'Quas mollit odit inv', 1, '2025-12-30 06:25:27', '2025-12-30 06:25:27'),
(5, 'Multifocal', 'multifocal', 'storage/lenses/1767094119_lens_IFv84.png', 0.00, 'Cillum et odit minim', 0, '2025-12-30 06:28:39', '2025-12-30 06:28:39');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_01_000000_add_fields_to_users_table', 1),
(6, '2024_01_01_000001_create_brands_table', 1),
(7, '2024_01_01_000001_create_user_addresses_table', 1),
(8, '2024_01_01_000002_create_attributes_table', 1),
(9, '2024_01_01_000003_create_categories_table', 1),
(10, '2024_01_01_000004_create_sub_categories_table', 1),
(11, '2024_01_01_000005_create_products_table', 1),
(12, '2024_01_01_000006_create_product_attributes_table', 1),
(13, '2024_01_01_000007_create_product_images_table', 1),
(14, '2024_01_01_000008_create_lens_types_table', 1),
(15, '2024_01_01_000009_create_lens_coatings_table', 1),
(16, '2024_01_01_000010_create_prescriptions_table', 1),
(17, '2024_01_01_000011_create_coupons_table', 1),
(18, '2024_01_01_000012_create_orders_table', 1),
(19, '2024_01_01_000013_create_order_items_table', 1),
(20, '2024_01_01_000014_create_business_settings_table', 1),
(21, '2024_01_01_000015_create_settings_table', 1),
(22, '2024_01_01_000016_create_notifications_table', 1),
(23, '2024_01_01_000017_create_reviews_table', 1),
(24, '2024_01_01_000018_create_chats_table', 1),
(25, '2024_01_01_000019_create_chat_messages_table', 1),
(26, '2024_01_01_000020_create_admins_table', 1),
(27, '2024_01_01_000021_create_carts_table', 1),
(28, '2024_01_01_000022_create_wishlists_table', 1),
(29, '2024_01_01_000023_create_transactions_table', 1),
(30, '2024_01_01_000024_create_pages_table', 1),
(31, '2024_01_01_000025_create_sliders_table', 1),
(32, '2025_12_23_173443_add_color_to_product_images_table', 2),
(33, '2025_12_23_192258_add_image_path_to_prescriptions_table', 3),
(34, '2025_12_24_111255_add_dimensions_to_products_table', 4),
(35, '2025_12_24_111258_create_product_variants_table', 4),
(36, '2025_12_24_113418_add_primary_image_to_products_table', 5),
(37, '2025_12_24_113558_remove_color_from_product_images_table', 6),
(38, '2025_12_24_124104_add_color_to_product_images_table', 7),
(39, '2025_12_29_000000_add_fields_to_sliders_table', 8),
(40, '2025_12_29_000001_add_more_fields_to_sliders_table', 9),
(41, '2025_12_30_111808_add_image_and_remove_tax_from_lens_types', 10),
(42, '2025_12_30_130918_add_payment_and_shipping_to_business_settings', 11),
(43, '2025_12_30_153007_add_prescription_fields_to_order_items', 12),
(45, '2025_12_30_184631_create_contact_messages_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
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
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `billing_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `status`, `payment_status`, `payment_method`, `total`, `tax`, `shipping_cost`, `discount`, `shipping_address`, `billing_address`, `created_at`, `updated_at`) VALUES
(1, 12, 'ORD-694BF135A2C0E', 'delivered', 'paid', 'credit_card', 162.86, 16.29, 15.00, 0.00, '{\"name\":\"Matilde Kunze PhD\",\"address\":\"84002 Jess Circle\",\"city\":\"East Lydiahaven\",\"zip\":\"95562\"}', '{\"name\":\"Matilde Kunze PhD\",\"zip\":\"39987\"}', '2025-01-03 04:16:23', '2025-12-24 08:57:09'),
(2, 12, 'ORD-694BF135A3DCB', 'processing', 'pending', 'credit_card', 375.38, 37.54, 15.00, 0.00, '{\"name\":\"Matilde Kunze PhD\",\"address\":\"918 Kshlerin Viaduct Apt. 634\",\"city\":\"New Jarrell\",\"zip\":\"58021\"}', '{\"name\":\"Matilde Kunze PhD\",\"zip\":\"75572\"}', '2025-09-08 04:38:36', '2025-12-24 08:57:09'),
(3, 13, 'ORD-694BF135A4D32', 'shipped', 'pending', 'credit_card', 470.81, 47.08, 15.00, 0.00, '{\"name\":\"Marcelle Johns\",\"address\":\"463 Rosenbaum Creek\",\"city\":\"Yasmeenchester\",\"zip\":\"08695\"}', '{\"name\":\"Marcelle Johns\",\"zip\":\"85930\"}', '2025-07-13 08:29:58', '2025-12-24 08:57:09'),
(4, 13, 'ORD-694BF135A5A00', 'delivered', 'paid', 'credit_card', 274.31, 27.43, 15.00, 0.00, '{\"name\":\"Marcelle Johns\",\"address\":\"882 Terrill Circle Suite 267\",\"city\":\"North Elinoreside\",\"zip\":\"79650\"}', '{\"name\":\"Marcelle Johns\",\"zip\":\"15248\"}', '2025-10-06 23:28:50', '2025-12-24 08:57:09'),
(5, 14, 'ORD-694BF135A6C76', 'pending', 'pending', 'credit_card', 395.30, 39.53, 15.00, 0.00, '{\"name\":\"Mariano Brown\",\"address\":\"795 Kerluke Ferry Apt. 662\",\"city\":\"East Chelseyland\",\"zip\":\"28528-5637\"}', '{\"name\":\"Mariano Brown\",\"zip\":\"45992\"}', '2025-11-02 23:44:12', '2025-12-24 08:57:09'),
(6, 15, 'ORD-694BF135A7B98', 'cancelled', 'failed', 'credit_card', 374.08, 37.41, 15.00, 0.00, '{\"name\":\"Ernesto Blick\",\"address\":\"7382 Bednar Harbors\",\"city\":\"West Ceceliafort\",\"zip\":\"50298-2704\"}', '{\"name\":\"Ernesto Blick\",\"zip\":\"26632-0952\"}', '2025-09-16 17:11:48', '2025-12-24 08:57:09'),
(7, 16, 'ORD-694BF135A87F9', 'cancelled', 'failed', 'credit_card', 254.14, 25.41, 15.00, 0.00, '{\"name\":\"Weldon Swift\",\"address\":\"31430 Robel Turnpike\",\"city\":\"Addisonville\",\"zip\":\"60170\"}', '{\"name\":\"Weldon Swift\",\"zip\":\"83341\"}', '2025-07-01 05:04:39', '2025-12-24 08:57:09'),
(8, 17, 'ORD-694BF135A94E3', 'cancelled', 'failed', 'credit_card', 68.70, 6.87, 15.00, 0.00, '{\"name\":\"Ms. Iliana King Sr.\",\"address\":\"35534 Littel Orchard\",\"city\":\"Lake Hesterborough\",\"zip\":\"13990-4329\"}', '{\"name\":\"Ms. Iliana King Sr.\",\"zip\":\"33012\"}', '2025-05-07 06:14:54', '2025-12-24 08:57:09'),
(9, 18, 'ORD-694BF135AA3F4', 'pending', 'pending', 'credit_card', 294.08, 29.41, 15.00, 0.00, '{\"name\":\"Betty Walter V\",\"address\":\"295 Jacobson Mountains\",\"city\":\"Americaton\",\"zip\":\"25506\"}', '{\"name\":\"Betty Walter V\",\"zip\":\"30662\"}', '2025-01-15 09:44:34', '2025-12-24 08:57:09'),
(10, 18, 'ORD-694BF135AADE6', 'delivered', 'paid', 'credit_card', 64.38, 6.44, 15.00, 0.00, '{\"name\":\"Betty Walter V\",\"address\":\"957 Ernser Roads Apt. 668\",\"city\":\"Steuberburgh\",\"zip\":\"12537-7792\"}', '{\"name\":\"Betty Walter V\",\"zip\":\"56069-6086\"}', '2025-10-14 14:06:06', '2025-12-24 08:57:09'),
(11, 18, 'ORD-694BF135AB559', 'cancelled', 'failed', 'credit_card', 394.21, 39.42, 15.00, 0.00, '{\"name\":\"Betty Walter V\",\"address\":\"84367 Dietrich Lodge Suite 610\",\"city\":\"Ferryhaven\",\"zip\":\"41506\"}', '{\"name\":\"Betty Walter V\",\"zip\":\"18508-7224\"}', '2025-01-08 10:36:20', '2025-12-24 08:57:09'),
(12, 19, 'ORD-694BF135AC297', 'processing', 'pending', 'credit_card', 203.18, 20.32, 15.00, 0.00, '{\"name\":\"Kelli Mueller PhD\",\"address\":\"589 Wolf Oval Suite 594\",\"city\":\"Croninhaven\",\"zip\":\"50145\"}', '{\"name\":\"Kelli Mueller PhD\",\"zip\":\"01765-8655\"}', '2025-08-05 09:13:21', '2025-12-24 08:57:09'),
(13, 19, 'ORD-694BF135AC89F', 'shipped', 'pending', 'credit_card', 253.50, 25.35, 15.00, 0.00, '{\"name\":\"Kelli Mueller PhD\",\"address\":\"383 McLaughlin Road Apt. 548\",\"city\":\"East Virgieland\",\"zip\":\"88540\"}', '{\"name\":\"Kelli Mueller PhD\",\"zip\":\"14995\"}', '2025-04-03 06:00:00', '2025-12-24 08:57:09'),
(14, 20, 'ORD-694BF135AD41C', 'pending', 'pending', 'credit_card', 178.45, 17.85, 15.00, 0.00, '{\"name\":\"Mrs. Dasia Bailey\",\"address\":\"64328 Harris Point Apt. 942\",\"city\":\"New Peggiefort\",\"zip\":\"09271\"}', '{\"name\":\"Mrs. Dasia Bailey\",\"zip\":\"36788\"}', '2024-12-30 08:16:20', '2025-12-24 08:57:09'),
(15, 20, 'ORD-694BF135ADA2E', 'pending', 'pending', 'credit_card', 166.13, 16.61, 15.00, 0.00, '{\"name\":\"Mrs. Dasia Bailey\",\"address\":\"8509 Luis Way\",\"city\":\"East Keaganmouth\",\"zip\":\"52122-6349\"}', '{\"name\":\"Mrs. Dasia Bailey\",\"zip\":\"50813\"}', '2025-12-11 13:35:37', '2025-12-24 08:57:09'),
(16, 20, 'ORD-694BF135ADFD3', 'cancelled', 'failed', 'credit_card', 196.71, 19.67, 15.00, 0.00, '{\"name\":\"Mrs. Dasia Bailey\",\"address\":\"774 Julius Mountains Apt. 491\",\"city\":\"Amiyafort\",\"zip\":\"11790\"}', '{\"name\":\"Mrs. Dasia Bailey\",\"zip\":\"93817-9866\"}', '2024-12-25 05:13:38', '2025-12-24 08:57:09'),
(17, 21, 'ORD-694BF135AF1B2', 'pending', 'pending', 'credit_card', 178.92, 17.89, 15.00, 0.00, '{\"name\":\"Dr. Dustin Monahan Jr.\",\"address\":\"89474 Rodrick Stravenue Suite 806\",\"city\":\"Port Payton\",\"zip\":\"18898\"}', '{\"name\":\"Dr. Dustin Monahan Jr.\",\"zip\":\"79627\"}', '2025-08-22 02:52:09', '2025-12-24 08:57:09'),
(18, 21, 'ORD-694BF135AF895', 'shipped', 'pending', 'credit_card', 282.90, 28.29, 15.00, 0.00, '{\"name\":\"Dr. Dustin Monahan Jr.\",\"address\":\"6127 Tromp Creek Apt. 324\",\"city\":\"Stantonbury\",\"zip\":\"26463\"}', '{\"name\":\"Dr. Dustin Monahan Jr.\",\"zip\":\"29379\"}', '2024-12-29 20:24:03', '2025-12-24 08:57:09'),
(19, 21, 'ORD-694BF135AFF22', 'delivered', 'paid', 'credit_card', 449.90, 44.99, 15.00, 0.00, '{\"name\":\"Dr. Dustin Monahan Jr.\",\"address\":\"36615 Elissa Circles Suite 059\",\"city\":\"East Alexanehaven\",\"zip\":\"21427-7702\"}', '{\"name\":\"Dr. Dustin Monahan Jr.\",\"zip\":\"55951\"}', '2025-06-20 09:59:00', '2025-12-24 08:57:09'),
(20, 22, 'ORD-694C12C68C675', 'processing', 'pending', 'credit_card', 269.55, 26.96, 15.00, 0.00, '{\"name\":\"Kayleigh Hane\",\"address\":\"579 Davis Station Suite 068\",\"city\":\"New Alexandra\",\"zip\":\"19180\"}', '{\"name\":\"Kayleigh Hane\",\"zip\":\"69470-7067\"}', '2025-06-15 03:00:02', '2025-12-24 11:20:22'),
(21, 23, 'ORD-694C12C68D8F6', 'pending', 'pending', 'credit_card', 120.36, 12.04, 15.00, 0.00, '{\"name\":\"Newell Barton\",\"address\":\"379 Serenity Oval\",\"city\":\"New Marvinberg\",\"zip\":\"06592\"}', '{\"name\":\"Newell Barton\",\"zip\":\"94757\"}', '2025-01-24 03:48:16', '2025-12-24 11:20:22'),
(22, 23, 'ORD-694C12C68DFB9', 'cancelled', 'failed', 'credit_card', 56.45, 5.65, 15.00, 0.00, '{\"name\":\"Newell Barton\",\"address\":\"855 Izaiah Park Suite 922\",\"city\":\"Nathanhaven\",\"zip\":\"97933-0058\"}', '{\"name\":\"Newell Barton\",\"zip\":\"53872\"}', '2025-04-20 19:25:03', '2025-12-24 11:20:22'),
(23, 23, 'ORD-694C12C68E5CA', 'delivered', 'paid', 'credit_card', 478.10, 47.81, 15.00, 0.00, '{\"name\":\"Newell Barton\",\"address\":\"629 Sam Union Suite 201\",\"city\":\"Gutkowskihaven\",\"zip\":\"88455\"}', '{\"name\":\"Newell Barton\",\"zip\":\"55364-3431\"}', '2025-09-10 10:19:55', '2025-12-24 11:20:22'),
(24, 24, 'ORD-694C12C68F219', 'pending', 'pending', 'credit_card', 460.63, 46.06, 15.00, 0.00, '{\"name\":\"Prof. Willie Price\",\"address\":\"5045 Bechtelar Club Apt. 300\",\"city\":\"Beierside\",\"zip\":\"73531-2411\"}', '{\"name\":\"Prof. Willie Price\",\"zip\":\"75505\"}', '2025-10-07 15:16:54', '2025-12-24 11:20:22'),
(25, 24, 'ORD-694C12C68FD49', 'cancelled', 'failed', 'credit_card', 474.64, 47.46, 15.00, 0.00, '{\"name\":\"Prof. Willie Price\",\"address\":\"171 Duane Village\",\"city\":\"Ivoryfurt\",\"zip\":\"07701\"}', '{\"name\":\"Prof. Willie Price\",\"zip\":\"62974-4511\"}', '2025-10-16 09:15:59', '2025-12-24 11:20:22'),
(26, 24, 'ORD-694C12C690320', 'processing', 'pending', 'credit_card', 350.00, 35.00, 15.00, 0.00, '{\"name\":\"Prof. Willie Price\",\"address\":\"9111 Margaret Path Suite 427\",\"city\":\"Port Daniella\",\"zip\":\"60499-5186\"}', '{\"name\":\"Prof. Willie Price\",\"zip\":\"00057-3854\"}', '2025-05-22 19:14:19', '2025-12-24 11:20:22'),
(27, 25, 'ORD-694C12C690EAC', 'shipped', 'pending', 'credit_card', 83.76, 8.38, 15.00, 0.00, '{\"name\":\"Rigoberto Klein I\",\"address\":\"6668 Winfield Turnpike Apt. 857\",\"city\":\"Wehnerfort\",\"zip\":\"69226\"}', '{\"name\":\"Rigoberto Klein I\",\"zip\":\"36798\"}', '2025-06-11 17:42:39', '2025-12-24 11:20:22'),
(28, 26, 'ORD-694C12C691C4A', 'processing', 'pending', 'credit_card', 94.25, 9.43, 15.00, 0.00, '{\"name\":\"Freeda Padberg\",\"address\":\"7913 Hamill Fort Apt. 753\",\"city\":\"West Garnettview\",\"zip\":\"71366\"}', '{\"name\":\"Freeda Padberg\",\"zip\":\"42763\"}', '2025-01-03 20:40:38', '2025-12-24 11:20:22'),
(29, 26, 'ORD-694C12C692207', 'pending', 'pending', 'credit_card', 457.69, 45.77, 15.00, 0.00, '{\"name\":\"Freeda Padberg\",\"address\":\"72206 Oberbrunner Knoll Apt. 304\",\"city\":\"Port Dedrickview\",\"zip\":\"70597-1932\"}', '{\"name\":\"Freeda Padberg\",\"zip\":\"81031-6476\"}', '2025-10-16 13:07:33', '2025-12-24 11:20:22'),
(30, 26, 'ORD-694C12C6927A7', 'processing', 'pending', 'credit_card', 337.48, 33.75, 15.00, 0.00, '{\"name\":\"Freeda Padberg\",\"address\":\"8867 Huel Motorway\",\"city\":\"Emmerichton\",\"zip\":\"97935-2834\"}', '{\"name\":\"Freeda Padberg\",\"zip\":\"29329-2945\"}', '2025-10-31 22:28:10', '2025-12-24 11:20:22'),
(31, 27, 'ORD-694C12C693270', 'pending', 'pending', 'credit_card', 386.42, 38.64, 15.00, 0.00, '{\"name\":\"Mike Gusikowski\",\"address\":\"59198 Kovacek Center Apt. 674\",\"city\":\"West Kristianmouth\",\"zip\":\"07932-8058\"}', '{\"name\":\"Mike Gusikowski\",\"zip\":\"73525-2414\"}', '2025-09-23 21:02:22', '2025-12-24 11:20:22'),
(32, 27, 'ORD-694C12C6937DB', 'cancelled', 'failed', 'credit_card', 229.78, 22.98, 15.00, 0.00, '{\"name\":\"Mike Gusikowski\",\"address\":\"267 Spinka Shoals\",\"city\":\"Zanderville\",\"zip\":\"61160-4464\"}', '{\"name\":\"Mike Gusikowski\",\"zip\":\"80918\"}', '2025-07-21 12:23:24', '2025-12-24 11:20:22'),
(33, 28, 'ORD-694C12C694272', 'processing', 'pending', 'credit_card', 278.51, 27.85, 15.00, 0.00, '{\"name\":\"Derrick Doyle\",\"address\":\"2801 Haley Isle Suite 731\",\"city\":\"New Theresiamouth\",\"zip\":\"58410-0525\"}', '{\"name\":\"Derrick Doyle\",\"zip\":\"11898-0865\"}', '2025-12-17 14:22:56', '2025-12-24 11:20:22'),
(34, 29, 'ORD-694C12C694C82', 'processing', 'pending', 'credit_card', 96.24, 9.62, 15.00, 0.00, '{\"name\":\"Devante Hansen Sr.\",\"address\":\"9397 Zora Isle\",\"city\":\"North Juanaville\",\"zip\":\"11217-7275\"}', '{\"name\":\"Devante Hansen Sr.\",\"zip\":\"76621\"}', '2025-07-24 03:44:55', '2025-12-24 11:20:22'),
(35, 29, 'ORD-694C12C6951B2', 'cancelled', 'failed', 'credit_card', 281.82, 28.18, 15.00, 0.00, '{\"name\":\"Devante Hansen Sr.\",\"address\":\"1441 Aryanna Burg\",\"city\":\"South Emile\",\"zip\":\"15060-5671\"}', '{\"name\":\"Devante Hansen Sr.\",\"zip\":\"79022\"}', '2025-09-19 09:54:26', '2025-12-24 11:20:22'),
(36, 30, 'ORD-694C12C695DA5', 'pending', 'pending', 'credit_card', 457.98, 45.80, 15.00, 0.00, '{\"name\":\"Osvaldo Watsica MD\",\"address\":\"46060 Weimann Heights Apt. 508\",\"city\":\"Bernierbury\",\"zip\":\"08673\"}', '{\"name\":\"Osvaldo Watsica MD\",\"zip\":\"14821-1288\"}', '2025-06-04 22:26:19', '2025-12-24 11:20:22'),
(37, 30, 'ORD-694C12C69639D', 'shipped', 'pending', 'credit_card', 135.99, 13.60, 15.00, 0.00, '{\"name\":\"Osvaldo Watsica MD\",\"address\":\"57189 Lockman Village\",\"city\":\"North Christian\",\"zip\":\"72165-9487\"}', '{\"name\":\"Osvaldo Watsica MD\",\"zip\":\"72226\"}', '2024-12-26 04:56:55', '2025-12-24 11:20:22'),
(38, 31, 'ORD-694C12C696DE9', 'pending', 'pending', 'credit_card', 369.23, 36.92, 15.00, 0.00, '{\"name\":\"Jerad Bergnaum\",\"address\":\"65253 Osinski Way Apt. 044\",\"city\":\"Spencerberg\",\"zip\":\"27046-7147\"}', '{\"name\":\"Jerad Bergnaum\",\"zip\":\"47170\"}', '2025-02-13 21:37:34', '2025-12-24 11:20:22'),
(39, 32, 'ORD-6953EAF7E1D57856101549', 'pending', 'paid', 'stripe', 11.00, 0.00, 0.00, 0.00, '{\"name\":\"Test User\",\"email\":\"test@example.com\",\"address\":\"Plot No, 20-C Ittehad Lane 8\",\"phone\":\"+17573393464\"}', '{\"name\":\"Test User\",\"email\":\"test@example.com\",\"address\":\"Plot No, 20-C Ittehad Lane 8\",\"phone\":\"+17573393464\"}', '2025-12-30 10:08:39', '2025-12-30 10:08:39'),
(40, 32, 'ORD-695412F69DE64832382794', 'pending', 'unpaid', 'cod', 22.00, 0.00, 0.00, 0.00, '{\"first_name\":\"Test\",\"last_name\":\"User\",\"email\":\"test@example.com\",\"address\":\"Plot No\",\"apartment\":\"20-C Ittehad Lane 8\",\"city\":\"Karachi\",\"state\":\"NY\",\"zip_code\":\"75500\",\"country\":\"United States\",\"delivery_method\":\"ship\"}', '{\"first_name\":\"Test\",\"last_name\":\"User\",\"address\":\"Plot No\"}', '2025-12-30 12:59:18', '2025-12-30 12:59:18'),
(41, NULL, 'ORD-6957B61A1B7CD294682561', 'pending', 'paid', 'stripe', 69.00, 0.00, 0.00, 0.00, '{\"first_name\":\"Timon\",\"last_name\":\"Cleveland\",\"email\":\"Nostrum mollitia iru\",\"address\":\"Sed ea laboriosam e\",\"apartment\":\"Eiusmod enim eum pro\",\"city\":\"Laboriosam laborum\",\"state\":\"CA\",\"zip_code\":\"53199\",\"country\":\"United States\",\"delivery_method\":\"ship\"}', '{\"first_name\":\"Timon\",\"last_name\":\"Cleveland\",\"address\":\"Sed ea laboriosam e\"}', '2026-01-02 17:12:10', '2026-01-02 17:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `lens_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lens_coating_id` bigint(20) UNSIGNED DEFAULT NULL,
  `prescription_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `prescription_file` varchar(255) DEFAULT NULL,
  `prescription_doctor` varchar(255) DEFAULT NULL,
  `prescription_date` varchar(255) DEFAULT NULL,
  `prescription_time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `tax_amount`, `tax_rate`, `lens_type_id`, `lens_coating_id`, `prescription_data`, `prescription_file`, `prescription_doctor`, `prescription_date`, `prescription_time`, `created_at`, `updated_at`) VALUES
(1, 33, 1, 'Test Frame', 1, 199.00, 0.00, 0.00, NULL, NULL, '{\"od_sph\":\"-1.50\",\"od_cyl\":\"-0.25\",\"od_axis\":\"180\",\"os_sph\":\"-1.75\",\"os_cyl\":\"-0.50\",\"os_axis\":\"090\",\"pd\":\"62\"}', NULL, NULL, NULL, NULL, '2025-12-24 11:38:40', '2025-12-24 11:38:40'),
(2, 33, 1, 'Test Frame (Spare)', 1, 159.20, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:38:40', '2025-12-24 11:38:40'),
(3, 39, 8, 'Shelley Gonzal', 1, 11.00, 0.00, 0.00, NULL, NULL, '{\"variant_name\":\"Color: blue\",\"variant_id\":\"13\"}', NULL, NULL, NULL, NULL, '2025-12-30 10:08:39', '2025-12-30 10:08:39'),
(4, 40, 8, 'Shelley Gonzal', 2, 11.00, 0.00, 0.00, NULL, NULL, '{\"variant_name\":\"Color: blue\",\"variant_id\":\"13\"}', 'prescriptions/lKYJL4nHuLWKywzUC9pdk2GycjTaxVYxG5QadeMw.png', 'Dr.Wade Warren', '2025-12-30', '12:01', '2025-12-30 12:59:18', '2025-12-30 12:59:18'),
(5, 41, 7, 'VJ1002', 1, 69.00, 0.00, 0.00, NULL, NULL, '{\"variant_name\":\"Color: Light Brown frame\",\"variant_id\":\"10\"}', 'prescriptions/Pco7Ftxcjrg0ItzmyB3K29Gck0JA9IKLVwz4UO17.jpg', 'Quo laboris necessit', '1997-06-20', '10:17', '2026-01-02 17:12:10', '2026-01-02 17:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `od_sph` varchar(255) NOT NULL,
  `od_cyl` varchar(255) DEFAULT NULL,
  `od_axis` varchar(255) DEFAULT NULL,
  `os_sph` varchar(255) NOT NULL,
  `os_cyl` varchar(255) DEFAULT NULL,
  `os_axis` varchar(255) DEFAULT NULL,
  `add` varchar(255) DEFAULT NULL,
  `pd` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `user_id`, `title`, `image_path`, `od_sph`, `od_cyl`, `od_axis`, `os_sph`, `os_cyl`, `os_axis`, `add`, `pd`, `created_at`, `updated_at`) VALUES
(1, 1, 'Distance - 2024', NULL, '-1.50', '-0.50', '180', '-1.75', '-0.25', '170', NULL, '62', '2025-12-24 12:05:06', '2025-12-24 12:05:06'),
(2, 1, 'Reading Glasses', NULL, '+1.50', '0.00', '0', '+1.50', '0.00', '0', '+2.00', '60', '2025-12-24 12:05:06', '2025-12-24 12:05:06'),
(3, 1, 'Backup Specs', NULL, '0.44', '-1.27', '105', '-0.74', '-1.01', '41', NULL, '59', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(4, 1, 'Reading', NULL, '4.73', '-1.31', '44', '-0.44', '-1.44', '139', NULL, '68', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(5, 1, 'Computer', NULL, '-3.03', '-1.83', '54', '4.26', '-0.65', '58', NULL, '69', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(6, 2, 'Computer', NULL, '4.8', '-0.47', '40', '-2.8', '-0.36', '90', '1.53', '61', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(7, 2, 'Reading', NULL, '-1.16', '-1.9', '133', '-2.62', '-1.66', '89', NULL, '69', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(8, 3, 'Backup Specs', NULL, '-3.62', '-0.76', '77', '-4.96', '-1.55', '133', '2.27', '64', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(9, 3, 'Backup Specs', NULL, '1.12', '-0.24', '28', '-4.83', '-0.84', '8', NULL, '59', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(10, 4, 'Backup Specs', NULL, '-4.6', '-1.13', '144', '4.82', '-1.41', '12', NULL, '67', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(11, 4, 'Daily Wear', NULL, '2.94', '-0.28', '173', '-2.04', '-1.29', '27', NULL, '70', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(12, 4, 'Driving', NULL, '1.37', '-1.5', '78', '2.21', '-1.51', '12', '1.6', '70', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(13, 5, 'Daily Wear', NULL, '-0.87', '-1.79', '133', '1.54', '-0.39', '110', NULL, '69', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(14, 5, 'Reading', NULL, '2.96', '-0.59', '125', '-2.05', '-1.21', '71', '1.2', '70', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(15, 6, 'Driving', NULL, '-0.9', '-1', '147', '3.05', '-1.13', '47', NULL, '66', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(16, 6, 'Reading', NULL, '3.8', '-1.44', '45', '-2.04', '-1.39', '115', NULL, '65', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(17, 6, 'Driving', NULL, '-0.09', '-1.18', '90', '1.89', '-0.46', '163', '2.28', '60', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(18, 7, 'Daily Wear', NULL, '-2.66', '-1.28', '60', '4.05', '-1.55', '132', '2.62', '63', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(19, 7, 'Reading', NULL, '2.98', '-0.4', '149', '2.12', '-1.29', '57', NULL, '58', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(20, 8, 'Driving', NULL, '4.98', '-0.48', '42', '4.84', '-0.6', '164', NULL, '65', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(21, 8, 'Backup Specs', NULL, '-4.5', '-0.41', '171', '0.64', '-1.12', '89', '1.88', '63', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(22, 9, 'Reading', NULL, '4.66', '-1.89', '174', '3.83', '-0.34', '178', NULL, '68', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(23, 9, 'Driving', NULL, '-3.97', '-0.95', '160', '-0.11', '-1.84', '15', '1.51', '58', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(24, 9, 'Driving', NULL, '-3.49', '-1.04', '42', '-1.59', '-1.06', '20', NULL, '70', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(25, 10, 'Backup Specs', NULL, '0.47', '-0.87', '96', '1.87', '-1.32', '57', NULL, '62', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(26, 10, 'Backup Specs', NULL, '3.71', '-1.15', '148', '2.11', '-1.07', '13', '1.98', '62', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(27, 11, 'Driving', NULL, '-1.68', '-0.22', '78', '-0.5', '-1.92', '178', NULL, '66', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(28, 11, 'Daily Wear', NULL, '3.58', '-1.94', '165', '0.17', '-1.03', '140', NULL, '70', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(29, 12, 'Daily Wear', NULL, '2.53', '-1.56', '117', '-2.51', '-0.95', '4', NULL, '65', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(30, 12, 'Computer', NULL, '-3.25', '-0.64', '134', '2.18', '-1.99', '139', NULL, '70', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(31, 12, 'Daily Wear', NULL, '-4.09', '-1.73', '81', '-2.2', '-1.28', '126', NULL, '65', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(32, 13, 'Reading', NULL, '-4.77', '-1.09', '96', '4.91', '-1.62', '108', NULL, '69', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(33, 14, 'Driving', NULL, '-1.5', '-0.54', '120', '-4.94', '-1.8', '149', NULL, '61', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(34, 14, 'Computer', NULL, '-3.96', '-1.63', '57', '-1.94', '-1.64', '8', NULL, '65', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(35, 15, 'Driving', NULL, '1.84', '-1.33', '139', '-2.9', '-1.65', '159', NULL, '64', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(36, 15, 'Backup Specs', NULL, '4.1', '-0.55', '131', '-1.59', '-0.46', '86', '1.4', '67', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(37, 16, 'Reading', NULL, '-1.04', '-1.19', '71', '-4.75', '-1.59', '35', NULL, '64', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(38, 17, 'Driving', NULL, '1.94', '-1.37', '59', '-4.35', '-1.72', '129', NULL, '68', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(39, 18, 'Backup Specs', NULL, '-2.39', '-0.1', '177', '-3.26', '-1.05', '96', NULL, '63', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(40, 18, 'Daily Wear', NULL, '2.66', '-0.76', '21', '4.64', '-1.63', '2', NULL, '59', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(41, 18, 'Backup Specs', NULL, '-3.12', '-1.51', '47', '3.56', '-0.82', '125', NULL, '67', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(42, 19, 'Reading', NULL, '2.73', '-0.9', '163', '-1.03', '-0.09', '112', NULL, '68', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(43, 19, 'Backup Specs', NULL, '1.42', '-1.51', '163', '-1.76', '-1.54', '138', '2.37', '69', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(44, 20, 'Computer', NULL, '-2.08', '-1.36', '50', '-4.48', '-1.81', '64', '1.1', '58', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(45, 21, 'Reading', NULL, '-1.07', '-1.61', '143', '0.53', '-1.8', '37', NULL, '68', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(46, 21, 'Computer', NULL, '-2.08', '-1.92', '150', '4.45', '-0.65', '162', NULL, '68', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(47, 21, 'Driving', NULL, '1.93', '-1.12', '71', '-2.94', '-0.2', '9', NULL, '59', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(48, 22, 'Reading', NULL, '-1.7', '-0.89', '93', '2', '-1.39', '166', '1.95', '63', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(49, 23, 'Reading', NULL, '2.31', '-0.56', '50', '-0.13', '-0.25', '4', NULL, '67', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(50, 23, 'Reading', NULL, '-1.23', '-1.53', '109', '-1.23', '-1.26', '114', NULL, '63', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(51, 23, 'Computer', NULL, '-4.46', '-0.86', '69', '4.67', '-1.66', '157', NULL, '70', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(52, 24, 'Daily Wear', NULL, '0.14', '-1.09', '78', '-4.89', '-1.02', '61', NULL, '65', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(53, 24, 'Backup Specs', NULL, '-4.21', '-1.61', '62', '-1.7', '-0.43', '174', NULL, '59', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(54, 24, 'Driving', NULL, '1.65', '-1.26', '139', '1.93', '-1.67', '157', NULL, '70', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(55, 25, 'Backup Specs', NULL, '0.01', '-0.31', '97', '0.6', '-0.46', '170', '2.23', '58', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(56, 25, 'Reading', NULL, '-3.92', '-0.24', '55', '1.49', '-0.21', '179', NULL, '69', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(57, 26, 'Reading', NULL, '0.85', '-0.83', '112', '-2.84', '-0.91', '26', NULL, '59', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(58, 27, 'Driving', NULL, '0.36', '-0.72', '165', '1.8', '-0.86', '180', NULL, '58', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(59, 27, 'Driving', NULL, '-4.23', '-0.64', '25', '3.63', '-0.7', '34', NULL, '59', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(60, 27, 'Driving', NULL, '0.74', '-0.43', '88', '0.73', '-0.2', '27', NULL, '70', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(61, 28, 'Daily Wear', NULL, '-0.2', '-1.59', '37', '3.76', '-1.52', '6', NULL, '61', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(62, 28, 'Backup Specs', NULL, '-4.19', '-0.24', '127', '1.54', '-0.87', '102', NULL, '63', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(63, 28, 'Computer', NULL, '-2.59', '-0.79', '101', '4.91', '-0.97', '120', NULL, '70', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(64, 29, 'Computer', NULL, '-2.8', '-0.15', '21', '0.2', '-1.51', '93', NULL, '60', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(65, 29, 'Driving', NULL, '-4.17', '-1.22', '132', '4.85', '-1.33', '115', NULL, '63', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(66, 29, 'Computer', NULL, '4.9', '-1.35', '30', '4.26', '-0.85', '101', NULL, '61', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(67, 30, 'Driving', NULL, '4.92', '-0.34', '124', '-2.33', '-1.9', '98', NULL, '58', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(68, 30, 'Backup Specs', NULL, '1.37', '-0.61', '60', '-2.52', '-0.05', '36', NULL, '64', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(69, 30, 'Reading', NULL, '-0.25', '-0.67', '24', '-4.93', '-1.82', '13', NULL, '60', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(70, 31, 'Backup Specs', NULL, '1.78', '-1.03', '150', '-4.86', '-1.83', '131', '2.31', '63', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(71, 31, 'Reading', NULL, '-3.76', '-0.82', '171', '-2.15', '-0.65', '121', '2.14', '68', '2025-12-24 12:18:50', '2025-12-24 12:18:50'),
(72, 31, 'Daily Wear', NULL, '0.23', '-0.79', '155', '-1.35', '-0.24', '112', NULL, '68', '2025-12-24 12:18:50', '2025-12-24 12:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `tax_percentage` decimal(5,2) NOT NULL DEFAULT 8.25,
  `stock` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `primary_image` varchar(255) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `lens_width` varchar(255) DEFAULT NULL,
  `bridge_width` varchar(255) DEFAULT NULL,
  `temple_length` varchar(255) DEFAULT NULL,
  `frame_width` varchar(255) DEFAULT NULL,
  `face_width_recommended` varchar(255) DEFAULT NULL,
  `frame_shape` varchar(255) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `category_id`, `sub_category_id`, `brand_id`, `price`, `discount_price`, `tax_percentage`, `stock`, `description`, `primary_image`, `length`, `width`, `height`, `weight`, `unit`, `lens_width`, `bridge_width`, `temple_length`, `frame_width`, `face_width_recommended`, `frame_shape`, `material`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Men\'s Eyeglasses', 'test-frame', 1, 2, NULL, 103.00, 0.00, 0.00, 10, 'Commodo officia natu', 'storage/products/1767036144_primary_u99I4.png', 2.00, 1.00, 2.00, 3.00, NULL, '52', '18', '140', '135', 'Medium', 'Oval', 'Metal', 0, 1, '2025-12-24 11:38:40', '2025-12-29 14:23:29'),
(2, 'Oliver Peoples Gregory Peck', 'oliver-peoples-gregory-peck', 3, NULL, NULL, 350.00, NULL, 8.25, 20, 'Premium eyewear crafted for style and comfort.', 'products/1766588482_primary_7Q8o6.png', NULL, NULL, NULL, NULL, NULL, '47', '23', '150', NULL, NULL, 'Round', 'Acetate', 0, 1, '2025-12-24 13:01:52', '2025-12-24 13:08:07'),
(3, 'Tom Ford FT5178', 'tom-ford-ft5178', 3, NULL, NULL, 410.00, NULL, 8.25, 35, 'Premium eyewear crafted for style and comfort.', 'products/1766588482_primary_7Q8o6.png', NULL, NULL, NULL, NULL, NULL, '50', '21', '145', NULL, NULL, 'Square', 'Acetate', 0, 1, '2025-12-24 13:01:52', '2025-12-24 13:08:07'),
(4, 'Ray-Ban Clubmaster Optics', 'ray-ban-clubmaster-optics', 3, NULL, NULL, 180.00, NULL, 8.25, 55, 'Premium eyewear crafted for style and comfort.', 'products/1766588482_primary_7Q8o6.png', NULL, NULL, NULL, NULL, NULL, '49', '21', '140', NULL, NULL, 'Browline', 'Metal/Acetate', 0, 1, '2025-12-24 13:01:52', '2025-12-24 13:08:07'),
(5, 'Persol PO3007V', 'persol-po3007v', 3, NULL, NULL, 310.00, NULL, 8.25, 10, 'Premium eyewear crafted for style and comfort.', 'products/1766588482_primary_7Q8o6.png', NULL, NULL, NULL, NULL, NULL, '50', '19', '145', NULL, NULL, 'Pilot', 'Acetate', 0, 1, '2025-12-24 13:01:52', '2025-12-24 13:08:07'),
(6, 'Gucci GG0026O', 'gucci-gg0026o', 3, NULL, NULL, 295.00, NULL, 8.25, 32, 'Premium eyewear crafted for style and comfort.', 'products/1766588482_primary_7Q8o6.png', NULL, NULL, NULL, NULL, NULL, '55', '17', '140', NULL, NULL, 'Rectangular', 'Optyl', 0, 1, '2025-12-24 13:01:52', '2025-12-24 13:08:07'),
(7, 'VJ1002', 'vj1002', 3, 2, 1, 69.00, 0.00, 0.00, 10, 'Model Code: VJ1002 513871 49-18\r\nFrame shape: Round\r\nFront color: Light Brown\r\nLens color: Dark Green\r\nFrame material: Metal\r\nMeasurements:', 'storage/products/1767014113_primary_R3Uzq.png', 1.00, 1.00, 1.00, 1.00, 'inch', '52', '18', '140', '135', 'Medium', 'Oval', 'Metal', 0, 1, '2025-12-29 08:15:13', '2025-12-29 08:15:14'),
(8, 'Shelley Gonza', 'shelley-gonzalez', 3, 1, 1, 11.00, 0.00, 0.00, 10, 'Aliquip labore fugit', 'storage/products/1767029753_primary_A0Ukp.png', 2.00, 1.00, 1.00, 1.00, 'inch', '52', '18', '140', '135', 'Medium', 'Oval', 'Metal', 0, 1, '2025-12-29 12:35:53', '2025-12-30 13:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 'blue', '2025-12-29 14:17:48', '2025-12-30 13:12:44'),
(2, 1, 1, 'light brown', '2025-12-29 14:22:24', '2025-12-29 14:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `color`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'products/1766588482_primary_7Q8o6.png', '2025-12-24 13:08:07', '2025-12-24 13:08:07'),
(2, 3, NULL, 'products/1766588482_primary_7Q8o6.png', '2025-12-24 13:08:07', '2025-12-24 13:08:07'),
(3, 4, NULL, 'products/1766588482_primary_7Q8o6.png', '2025-12-24 13:08:07', '2025-12-24 13:08:07'),
(4, 5, NULL, 'products/1766588482_primary_7Q8o6.png', '2025-12-24 13:08:07', '2025-12-24 13:08:07'),
(5, 6, NULL, 'products/1766588482_primary_7Q8o6.png', '2025-12-24 13:08:07', '2025-12-24 13:08:07'),
(6, 7, NULL, 'storage/products/1767014114_0_KWIbm.png', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(7, 7, NULL, 'storage/products/1767014114_1_iQd3E.png', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(8, 7, NULL, 'storage/products/1767014114_2_27zxn.png', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(9, 7, NULL, 'storage/products/1767014114_3_WKerB.png', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(10, 7, NULL, 'storage/products/1767014114_4_iRfku.png', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(11, 7, 'Light Brown frame', 'storage/products/1767014114_color_1_XjzvE.png', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(12, 7, 'Light Brown frame', 'storage/products/1767014114_color_1_5ZFn1.png', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(13, 7, 'Light Brown frame', 'storage/products/1767014114_color_1_4vF7P.png', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(14, 7, 'Light Brown frame', 'storage/products/1767014114_color_1_wRgzH.png', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(15, 7, 'Light Brown frame', 'storage/products/1767014114_color_1_La4QN.png', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(25, 8, NULL, 'storage/products/1767029753_0_tyDDc.png', '2025-12-29 12:35:53', '2025-12-29 12:35:53'),
(26, 8, NULL, 'storage/products/1767029753_1_51Eri.png', '2025-12-29 12:35:53', '2025-12-29 12:35:53'),
(27, 8, NULL, 'storage/products/1767029753_2_fAOgY.png', '2025-12-29 12:35:53', '2025-12-29 12:35:53'),
(28, 8, 'blue', 'storage/products/1767029753_color_1_T9BSO.png', '2025-12-29 12:35:53', '2025-12-29 12:35:53'),
(29, 8, 'blue', 'storage/products/1767029753_color_1_WpARG.png', '2025-12-29 12:35:53', '2025-12-29 12:35:53'),
(30, 8, 'blue', 'storage/products/1767029753_color_1_MAYJX.png', '2025-12-29 12:35:53', '2025-12-29 12:35:53'),
(31, 8, 'blue', 'storage/products/1767029753_color_1_ztkNF.png', '2025-12-29 12:35:53', '2025-12-29 12:35:53'),
(32, 8, 'blue', 'storage/products/1767029753_color_1_DKVHs.png', '2025-12-29 12:35:53', '2025-12-29 12:35:53'),
(33, 1, NULL, 'storage/products/1767036144_0_liUGv.png', '2025-12-29 14:22:24', '2025-12-29 14:22:24'),
(34, 1, NULL, 'storage/products/1767036144_1_U5fjf.png', '2025-12-29 14:22:24', '2025-12-29 14:22:24'),
(35, 1, NULL, 'storage/products/1767036144_2_uCVhU.png', '2025-12-29 14:22:24', '2025-12-29 14:22:24'),
(36, 1, NULL, 'storage/products/1767036144_3_Kgm8F.png', '2025-12-29 14:22:24', '2025-12-29 14:22:24'),
(37, 1, NULL, 'storage/products/1767036144_4_jJsfb.png', '2025-12-29 14:22:24', '2025-12-29 14:22:24'),
(38, 1, 'light brown', 'storage/products/1767036144_color_1_gyEfV.png', '2025-12-29 14:22:24', '2025-12-29 14:22:24'),
(39, 1, 'light brown', 'storage/products/1767036144_color_1_61zRf.png', '2025-12-29 14:22:24', '2025-12-29 14:22:24'),
(40, 1, 'light brown', 'storage/products/1767036144_color_1_DHZg3.png', '2025-12-29 14:22:24', '2025-12-29 14:22:24'),
(41, 1, 'light brown', 'storage/products/1767036144_color_1_rNb4F.png', '2025-12-29 14:22:24', '2025-12-29 14:22:24'),
(42, 1, 'light brown', 'storage/products/1767036144_color_1_0aOZk.png', '2025-12-29 14:22:24', '2025-12-29 14:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_name` varchar(255) NOT NULL,
  `attribute_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `attribute_values`, `price`, `stock`, `sku`, `created_at`, `updated_at`) VALUES
(1, 2, 'Color: Cocobolo', '[]', 350.00, 12, NULL, '2025-12-24 13:01:52', '2025-12-24 13:01:52'),
(2, 2, 'Color: Matte Black', '[]', 350.00, 8, NULL, '2025-12-24 13:01:52', '2025-12-24 13:01:52'),
(3, 3, 'Color: Dark Havana', '[]', 410.00, 15, NULL, '2025-12-24 13:01:52', '2025-12-24 13:01:52'),
(4, 3, 'Color: Shiny Black', '[]', 410.00, 20, NULL, '2025-12-24 13:01:52', '2025-12-24 13:01:52'),
(5, 4, 'Color: Mock Tortoise/Gold', '[]', 180.00, 30, NULL, '2025-12-24 13:01:52', '2025-12-24 13:01:52'),
(6, 4, 'Color: Black/Silver', '[]', 180.00, 25, NULL, '2025-12-24 13:01:52', '2025-12-24 13:01:52'),
(7, 5, 'Color: Havana', '[]', 310.00, 10, NULL, '2025-12-24 13:01:52', '2025-12-24 13:01:52'),
(8, 6, 'Color: Black', '[]', 295.00, 18, NULL, '2025-12-24 13:01:52', '2025-12-24 13:01:52'),
(9, 6, 'Color: Avana', '[]', 295.00, 14, NULL, '2025-12-24 13:01:52', '2025-12-24 13:01:52'),
(10, 7, 'Color: Light Brown frame', '{\"Color\":\"Light Brown frame\"}', 69.00, 10, '10', '2025-12-29 08:15:14', '2025-12-29 08:15:14'),
(15, 1, 'Color: light brown', '{\"Color\":\"light brown\"}', 103.00, 10, '10', '2025-12-29 14:23:29', '2025-12-29 14:23:29'),
(16, 8, 'Color: blue', '{\"Color\":\"blue\"}', 11.00, 10, '10', '2025-12-30 13:12:44', '2025-12-30 13:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 27, 2, 5, 'The Oliver Peoples Gregory Peck frames are absolutely stunning. The build quality is top-notch!', 1, '2025-12-29 14:42:52', '2025-12-29 14:42:52'),
(2, 22, 4, 5, 'I love my new Ray-Ban Clubmasters. They fit perfectly and the vision clarity is amazing.', 1, '2025-12-29 14:42:52', '2025-12-29 14:42:52'),
(3, 23, 5, 4, 'Very stylish Persol glasses. The delivery was fast and the packaging was premium.', 1, '2025-12-29 14:42:52', '2025-12-29 14:42:52'),
(4, 28, 1, 5, 'Sacks Optical has the best collection I\'ve seen. Highly recommended for luxury eyewear.', 1, '2025-12-29 14:42:52', '2025-12-29 14:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `secondary_image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `text_alignment` enum('left','center','right') NOT NULL DEFAULT 'center',
  `button_text` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `image`, `secondary_image`, `link`, `text_alignment`, `button_text`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Providing Various Glasses', 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'storage/sliders/1767020120_slider_bg_PancC.png', 'storage/sliders/1767020121_slider_sec_s7ruu.png', '/shop', 'left', 'Shop Now', 1, 1, '2025-12-29 09:55:21', '2025-12-29 09:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sunglasses', 'men-sunglasses', 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14'),
(2, 1, 'Eyeglasses', 'men-eyeglasses', 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14'),
(3, 2, 'Sunglasses', 'women-sunglasses', 1, '2025-12-23 12:12:14', '2025-12-23 12:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `response_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `total_orders` int(11) NOT NULL DEFAULT 0,
  `total_spend` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `email_verified_at`, `password`, `status`, `total_orders`, `total_spend`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'user@example.com', NULL, NULL, NULL, '$2y$12$Qn5RPL./gdaq65TSsbxqOOy/79g9VFu7iakNQyZCjpwlAi2jEBAWC', '1', 0, 0.00, NULL, '2025-12-23 12:12:14', '2025-12-23 12:26:04'),
(2, 'David Runolfsdottir', 'quincy.rodriguez@example.org', '386-372-6825', NULL, '2025-12-24 08:56:28', '$2y$12$2LgIaoZVofwZrfN.PhHnwO9c0YjJszhpQLoIadd9HQT2oVOxz.ONi', 'active', 5, 488.00, '0Ej0Nx4TJ9', '2025-12-24 08:56:28', '2025-12-24 08:56:28'),
(3, 'Priscilla Romaguera', 'tito23@example.org', '386-372-6825', NULL, '2025-12-24 08:56:28', '$2y$12$2LgIaoZVofwZrfN.PhHnwO9c0YjJszhpQLoIadd9HQT2oVOxz.ONi', 'active', 5, 488.00, 'VI8J48Tc7x', '2025-12-24 08:56:28', '2025-12-24 08:56:28'),
(4, 'Domenick Walter Jr.', 'eliza03@example.org', '386-372-6825', NULL, '2025-12-24 08:56:28', '$2y$12$2LgIaoZVofwZrfN.PhHnwO9c0YjJszhpQLoIadd9HQT2oVOxz.ONi', 'active', 5, 488.00, 'rI6UMRWOQO', '2025-12-24 08:56:28', '2025-12-24 08:56:28'),
(5, 'Kristoffer Hagenes DVM', 'olueilwitz@example.org', '386-372-6825', NULL, '2025-12-24 08:56:28', '$2y$12$2LgIaoZVofwZrfN.PhHnwO9c0YjJszhpQLoIadd9HQT2oVOxz.ONi', 'active', 5, 488.00, 'f6wqCB8EYI', '2025-12-24 08:56:28', '2025-12-24 08:56:28'),
(6, 'Rachael Hermann', 'deborah.wunsch@example.com', '386-372-6825', NULL, '2025-12-24 08:56:28', '$2y$12$2LgIaoZVofwZrfN.PhHnwO9c0YjJszhpQLoIadd9HQT2oVOxz.ONi', 'active', 5, 488.00, 'ugPWbdCaWS', '2025-12-24 08:56:28', '2025-12-24 08:56:28'),
(7, 'Dario Bahringer', 'andrew50@example.net', '386-372-6825', NULL, '2025-12-24 08:56:28', '$2y$12$2LgIaoZVofwZrfN.PhHnwO9c0YjJszhpQLoIadd9HQT2oVOxz.ONi', 'active', 5, 488.00, '42if31l5eT', '2025-12-24 08:56:28', '2025-12-24 08:56:28'),
(8, 'Myrtie Turcotte', 'harmony63@example.org', '386-372-6825', NULL, '2025-12-24 08:56:28', '$2y$12$2LgIaoZVofwZrfN.PhHnwO9c0YjJszhpQLoIadd9HQT2oVOxz.ONi', 'active', 5, 488.00, 'mKVbJwJo0k', '2025-12-24 08:56:28', '2025-12-24 08:56:28'),
(9, 'Mr. Toy Towne', 'gadams@example.net', '386-372-6825', NULL, '2025-12-24 08:56:28', '$2y$12$2LgIaoZVofwZrfN.PhHnwO9c0YjJszhpQLoIadd9HQT2oVOxz.ONi', 'active', 5, 488.00, 'Lz989bPT3Y', '2025-12-24 08:56:28', '2025-12-24 08:56:28'),
(10, 'Avery Wyman', 'plowe@example.net', '386-372-6825', NULL, '2025-12-24 08:56:28', '$2y$12$2LgIaoZVofwZrfN.PhHnwO9c0YjJszhpQLoIadd9HQT2oVOxz.ONi', 'active', 5, 488.00, 'CaaQTCEWV2', '2025-12-24 08:56:28', '2025-12-24 08:56:28'),
(11, 'Carolyn Nicolas V', 'poconner@example.net', '386-372-6825', NULL, '2025-12-24 08:56:28', '$2y$12$2LgIaoZVofwZrfN.PhHnwO9c0YjJszhpQLoIadd9HQT2oVOxz.ONi', 'active', 5, 488.00, 'PLjzMNGsuI', '2025-12-24 08:56:28', '2025-12-24 08:56:28'),
(12, 'Matilde Kunze PhD', 'littel.drew@example.org', '341-627-3285', NULL, '2025-12-24 08:57:09', '$2y$12$sCziaRTp2Xc047Ty2dIKe.NTr0baXwYCf0CEkkfNfOBwERO4PERZe', 'active', 0, 759.00, 'pOxxocCvLD', '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(13, 'Marcelle Johns', 'alford.pagac@example.org', '341-627-3285', NULL, '2025-12-24 08:57:09', '$2y$12$sCziaRTp2Xc047Ty2dIKe.NTr0baXwYCf0CEkkfNfOBwERO4PERZe', 'active', 0, 759.00, 'DGSBrLgesQ', '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(14, 'Mariano Brown', 'murazik.jeffery@example.org', '341-627-3285', NULL, '2025-12-24 08:57:09', '$2y$12$sCziaRTp2Xc047Ty2dIKe.NTr0baXwYCf0CEkkfNfOBwERO4PERZe', 'active', 0, 759.00, 'hLPN3Akwy7', '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(15, 'Ernesto Blick', 'agustina45@example.com', '341-627-3285', NULL, '2025-12-24 08:57:09', '$2y$12$sCziaRTp2Xc047Ty2dIKe.NTr0baXwYCf0CEkkfNfOBwERO4PERZe', 'active', 0, 759.00, 'AeCMNAHMQ1', '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(16, 'Weldon Swift', 'desmond.halvorson@example.org', '341-627-3285', NULL, '2025-12-24 08:57:09', '$2y$12$sCziaRTp2Xc047Ty2dIKe.NTr0baXwYCf0CEkkfNfOBwERO4PERZe', 'active', 0, 759.00, 'jcQsXQO5GW', '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(17, 'Ms. Iliana King Sr.', 'hansen.carlos@example.net', '341-627-3285', NULL, '2025-12-24 08:57:09', '$2y$12$sCziaRTp2Xc047Ty2dIKe.NTr0baXwYCf0CEkkfNfOBwERO4PERZe', 'active', 0, 759.00, 'qy7Pk5a40N', '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(18, 'Betty Walter V', 'bernice31@example.net', '341-627-3285', NULL, '2025-12-24 08:57:09', '$2y$12$sCziaRTp2Xc047Ty2dIKe.NTr0baXwYCf0CEkkfNfOBwERO4PERZe', 'active', 0, 759.00, 'kYoIUgJ2Px', '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(19, 'Kelli Mueller PhD', 'pagac.ebony@example.com', '341-627-3285', NULL, '2025-12-24 08:57:09', '$2y$12$sCziaRTp2Xc047Ty2dIKe.NTr0baXwYCf0CEkkfNfOBwERO4PERZe', 'active', 0, 759.00, 'MeOr6lVBXm', '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(20, 'Mrs. Dasia Bailey', 'joannie05@example.org', '341-627-3285', NULL, '2025-12-24 08:57:09', '$2y$12$sCziaRTp2Xc047Ty2dIKe.NTr0baXwYCf0CEkkfNfOBwERO4PERZe', 'active', 0, 759.00, 'zsqHkMN6Wz', '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(21, 'Dr. Dustin Monahan Jr.', 'stanley.parisian@example.net', '341-627-3285', NULL, '2025-12-24 08:57:09', '$2y$12$sCziaRTp2Xc047Ty2dIKe.NTr0baXwYCf0CEkkfNfOBwERO4PERZe', 'active', 0, 759.00, '2JoSCvGXwe', '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(22, 'Kayleigh Hane', 'vernie.wilderman@example.net', '435.552.7662', NULL, '2025-12-24 11:20:22', '$2y$12$Tg9DpikAcIEJTfocxbgE2OYAO6E689qQ/Z.wAJYJ7kgeW0TMkW/gK', 'active', 1, 811.00, 'XTL3ovM1ND', '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(23, 'Newell Barton', 'pfannerstill.zula@example.net', '435.552.7662', NULL, '2025-12-24 11:20:22', '$2y$12$Tg9DpikAcIEJTfocxbgE2OYAO6E689qQ/Z.wAJYJ7kgeW0TMkW/gK', 'active', 1, 811.00, 'ZURmGw8F1v', '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(24, 'Prof. Willie Price', 'jairo31@example.com', '435.552.7662', NULL, '2025-12-24 11:20:22', '$2y$12$Tg9DpikAcIEJTfocxbgE2OYAO6E689qQ/Z.wAJYJ7kgeW0TMkW/gK', 'active', 1, 811.00, 'N9E65a68un', '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(25, 'Rigoberto Klein I', 'kieran15@example.com', '435.552.7662', NULL, '2025-12-24 11:20:22', '$2y$12$Tg9DpikAcIEJTfocxbgE2OYAO6E689qQ/Z.wAJYJ7kgeW0TMkW/gK', 'active', 1, 811.00, '4SxciMplRc', '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(26, 'Freeda Padberg', 'hankunding@example.net', '435.552.7662', NULL, '2025-12-24 11:20:22', '$2y$12$Tg9DpikAcIEJTfocxbgE2OYAO6E689qQ/Z.wAJYJ7kgeW0TMkW/gK', 'active', 1, 811.00, 'UQ1gT15Wa0', '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(27, 'Mike Gusikowski', 'anjali59@example.com', '435.552.7662', NULL, '2025-12-24 11:20:22', '$2y$12$Tg9DpikAcIEJTfocxbgE2OYAO6E689qQ/Z.wAJYJ7kgeW0TMkW/gK', 'active', 1, 811.00, 'BxFCL5OQPe', '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(28, 'Derrick Doyle', 'karli08@example.com', '435.552.7662', NULL, '2025-12-24 11:20:22', '$2y$12$Tg9DpikAcIEJTfocxbgE2OYAO6E689qQ/Z.wAJYJ7kgeW0TMkW/gK', 'active', 1, 811.00, 'jwOAnd2AHE', '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(29, 'Devante Hansen Sr.', 'ydickens@example.com', '435.552.7662', NULL, '2025-12-24 11:20:22', '$2y$12$Tg9DpikAcIEJTfocxbgE2OYAO6E689qQ/Z.wAJYJ7kgeW0TMkW/gK', 'active', 1, 811.00, 'PiXQzS7vV5', '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(30, 'Osvaldo Watsica MD', 'abdiel.considine@example.org', '435.552.7662', NULL, '2025-12-24 11:20:22', '$2y$12$Tg9DpikAcIEJTfocxbgE2OYAO6E689qQ/Z.wAJYJ7kgeW0TMkW/gK', 'active', 1, 811.00, 'MFPK13DcV6', '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(31, 'Jerad Bergnaum', 'roger87@example.com', '435.552.7662', NULL, '2025-12-24 11:20:22', '$2y$12$Tg9DpikAcIEJTfocxbgE2OYAO6E689qQ/Z.wAJYJ7kgeW0TMkW/gK', 'active', 1, 811.00, 'pmc16d3D4f', '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(32, 'Test User', 'test@example.com', NULL, NULL, NULL, '$2y$12$TQ8ZhO2MJzSxP8vuz1FSV.sCLRuHdQ0r2a/hbS7l0evW3.3aa1H4a', 'active', 0, 0.00, NULL, '2025-12-30 06:38:39', '2025-12-30 06:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'shipping',
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'USA',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `type`, `address`, `city`, `state`, `zip`, `country`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 12, 'billing', '2885 Mekhi Greens', 'Collinsmouth', 'NV', '88819', 'USA', 1, '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(2, 13, 'billing', '444 Rogahn Loaf', 'New Sonia', 'VA', '60260', 'USA', 1, '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(3, 14, 'billing', '322 Hudson Spring Apt. 549', 'Maudeburgh', 'IL', '45359', 'USA', 1, '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(4, 15, 'billing', '681 Koss Plain Apt. 453', 'Brownstad', 'CA', '26826-1057', 'USA', 1, '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(5, 16, 'billing', '66974 Boyer Square', 'Cullenstad', 'VT', '22417', 'USA', 1, '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(6, 17, 'billing', '110 Ramiro Turnpike Apt. 127', 'South Fredystad', 'OH', '76298-0483', 'USA', 1, '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(7, 18, 'billing', '84896 Marilyne Knolls', 'South Furmanshire', 'GA', '04459', 'USA', 1, '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(8, 19, 'billing', '1092 Lilliana Unions Suite 866', 'Bernardochester', 'ND', '90586-5543', 'USA', 1, '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(9, 20, 'billing', '99142 Rosina Keys Suite 976', 'West Elenora', 'PA', '99168-1010', 'USA', 1, '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(10, 21, 'billing', '512 Josie Springs Suite 757', 'Port Gaetanostad', 'GA', '66619-7950', 'USA', 1, '2025-12-24 08:57:09', '2025-12-24 08:57:09'),
(11, 22, 'billing', '40160 Kuhn Shoal Suite 962', 'Tremayneland', 'VA', '31593-7462', 'USA', 1, '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(12, 23, 'billing', '35402 Moen Point', 'Darienstad', 'AR', '81058-8676', 'USA', 1, '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(13, 24, 'billing', '18017 Larkin Mills Suite 180', 'Rubyebury', 'VT', '35148-4734', 'USA', 1, '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(14, 25, 'billing', '8555 Kertzmann Neck Apt. 309', 'East Tesshaven', 'TN', '30443-5399', 'USA', 1, '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(15, 26, 'billing', '57812 Krystina Mountain Suite 834', 'Percyville', 'NV', '37870', 'USA', 1, '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(16, 27, 'billing', '1512 Stiedemann Square', 'Lake Nikkistad', 'UT', '20161', 'USA', 1, '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(17, 28, 'billing', '39122 Grady Stream Apt. 098', 'Talonside', 'DE', '19330', 'USA', 1, '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(18, 29, 'billing', '2744 Adriel Coves', 'Runtemouth', 'AR', '18416', 'USA', 1, '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(19, 30, 'billing', '25551 Moore Summit Suite 597', 'East Daniellestad', 'OR', '48634', 'USA', 1, '2025-12-24 11:20:22', '2025-12-24 11:20:22'),
(20, 31, 'billing', '11233 Monahan Divide Apt. 803', 'Myahhaven', 'AL', '52960-0441', 'USA', 1, '2025-12-24 11:20:22', '2025-12-24 11:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
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
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attributes_slug_unique` (`slug`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_session_id_index` (`session_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_lens_type_id_foreign` (`lens_type_id`),
  ADD KEY `cart_items_lens_coating_id_foreign` (`lens_coating_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_user_id_foreign` (`user_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_messages_chat_id_foreign` (`chat_id`),
  ADD KEY `chat_messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lens_coatings`
--
ALTER TABLE `lens_coatings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lens_coatings_slug_unique` (`slug`);

--
-- Indexes for table `lens_types`
--
ALTER TABLE `lens_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lens_types_slug_unique` (`slug`);

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
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_lens_type_id_foreign` (`lens_type_id`),
  ADD KEY `order_items_lens_coating_id_foreign` (`lens_coating_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_user_id_foreign` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`),
  ADD KEY `product_attributes_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`),
  ADD KEY `settings_group_index` (`group`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lens_coatings`
--
ALTER TABLE `lens_coatings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lens_types`
--
ALTER TABLE `lens_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_lens_coating_id_foreign` FOREIGN KEY (`lens_coating_id`) REFERENCES `lens_coatings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cart_items_lens_type_id_foreign` FOREIGN KEY (`lens_type_id`) REFERENCES `lens_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_chat_id_foreign` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_lens_coating_id_foreign` FOREIGN KEY (`lens_coating_id`) REFERENCES `lens_coatings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_lens_type_id_foreign` FOREIGN KEY (`lens_type_id`) REFERENCES `lens_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
