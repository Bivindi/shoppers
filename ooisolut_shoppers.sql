-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 30 oct. 2018 à 12:55
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ooisolut_shoppers`
--

-- --------------------------------------------------------

--
-- Structure de la table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `about_us`
--

INSERT INTO `about_us` (`id`, `desc`, `image`, `created_at`, `updated_at`) VALUES
(1, '<div>\r\n<h2 style=\"text-align: left;\">What is Lorem Ipsum?</h2>\r\n<p style=\"text-align: left;\"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2 style=\"text-align: left;\">Why do we use it?</h2>\r\n<p style=\"text-align: left;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>', 'about_1524031040.jpg', '2018-04-18 07:27:20', '2018-04-18 07:27:20');

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

CREATE TABLE `blog` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `blog`
--

INSERT INTO `blog` (`id`, `desc`, `title`, `image`, `created_at`, `updated_at`, `slug`) VALUES
(1, '<p>eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;&nbsp;</p>', 'eCommerce Solution', 'blog_1532318319.jpg', '2018-07-23 08:56:56', '2018-07-23 08:56:56', 'ecommerce-solution-2'),
(2, '<p>eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;&nbsp;</p>', 'eCommerce Solution', 'blog_1532318319.jpg', '2018-07-23 09:19:15', '2018-07-23 09:19:15', 'ecommerce-solution'),
(3, '<p>eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;&nbsp;</p>', 'eCommerce Solution', 'blog_1532318319.jpg', '2018-07-23 09:19:56', '2018-07-23 09:19:56', 'ecommerce-solution-1'),
(4, '<p>eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;eCommerce Solution part&nbsp;eCommerce Solution part.&nbsp;&nbsp;</p>', 'eCommerce Solution part', 'blog_1532318319.jpg', '2018-07-23 09:28:39', '2018-07-23 09:28:39', 'ecommerce-solution-part');

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `brands`
--

INSERT INTO `brands` (`id`, `user_id`, `category_id`, `name`, `desc`, `slug`, `brand_logo`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 3, 'Apple', 'Apple', 'apple', 'brand_1533121235.png', 1, '2018-08-01 11:00:35', '2018-08-01 11:00:35'),
(6, 1, 4, 'Bovis', 'Plastic items', 'bovis', 'brand_1533547503.png', 1, '2018-08-06 09:25:03', '2018-08-06 09:25:03'),
(7, 52, 5, 'Mitsubishi', 'Mitsubishi AC', 'mitsubishi', 'brand_1533559026.jpg', 1, '2018-08-06 12:37:06', '2018-08-09 06:44:18'),
(9, 52, 3, 'Samsung', 'Samsung', 'samsung-1', 'brand_1533797431.png', 1, '2018-08-09 06:50:31', '2018-08-09 06:52:00'),
(10, 1, 4, 'Godrej', 'Godrej', 'godrej', 'brand_1533905524.jpg', 1, '2018-08-10 12:52:04', '2018-08-10 13:29:35'),
(11, 1, 16, 'Himalaya', 'Himalaya', 'himalaya', 'brand_1533906075.jpg', 1, '2018-08-10 13:01:16', '2018-08-10 13:29:38'),
(12, 1, 16, 'Lakme', 'Lakme', 'lakme', 'brand_1533906124.jpg', 1, '2018-08-10 13:02:04', '2018-08-10 13:29:41'),
(13, 1, 19, 'LG', 'LG', 'lg', 'brand_1533906206.jpg', 1, '2018-08-10 13:03:26', '2018-08-10 13:29:44'),
(14, 1, 19, 'Dell', 'Dell', 'dell', 'brand_1533906237.png', 1, '2018-08-10 13:03:58', '2018-08-10 13:29:47'),
(15, 1, 20, 'Adidas', 'Adidas', 'adidas', 'brand_1533906560.png', 1, '2018-08-10 13:09:20', '2018-08-10 13:29:51'),
(16, 1, 20, 'Levi\'s', 'Levi\'s', 'levi-s', 'brand_1533906601.jpg', 1, '2018-08-10 13:10:01', '2018-08-10 13:29:55'),
(17, 1, 22, 'Harry potter', 'Harry potter', 'harry-potter', 'brand_1533907618.jpg', 1, '2018-08-10 13:26:58', '2018-08-10 13:30:01'),
(18, 1, 14, 'TVS', 'TVS', 'tvs', 'brand_1533908461.jpg', 1, '2018-08-10 13:41:02', '2018-08-14 12:56:08'),
(19, 1, 39, 'Tanisqh', 'Tanisqh', 'tanisqh', 'brand_1534242822.png', 1, '2018-08-14 10:33:42', '2018-08-14 12:56:03'),
(20, 1, 42, 'Nataraj', 'Nataraj', 'nataraj', 'brand_1534251399.jpg', 1, '2018-08-14 12:31:42', '2018-08-14 12:56:39'),
(22, 1, 43, 'Pedigree', 'Pedigree', 'pedigree', 'brand_1534404584.jpg', 1, '2018-08-14 12:39:32', '2018-08-16 07:29:45'),
(23, 1, 44, 'Lotto', 'Lotto', 'lotto', 'brand_1534251771.jpg', 1, '2018-08-14 13:02:51', '2018-08-15 09:14:01'),
(24, 1, 47, 'FODG', 'FODG', 'fodg', 'brand_1534309666.jpg', 1, '2018-08-15 05:07:46', '2018-08-15 09:14:05'),
(25, 1, 17, 'Sky Bolt', 'Sky Bolt', 'sky-bolt', 'brand_1534324431.png', 1, '2018-08-15 09:13:51', '2018-08-15 09:14:09'),
(26, 1, 21, 'IndiaMART', 'IndiaMART', 'indiamart', 'brand_1534482969.png', 1, '2018-08-17 05:16:10', '2018-08-17 06:23:20'),
(27, 1, 49, 'Kisan Craft', 'Kisan Craft', 'kisan-craft', 'brand_1534483658.png', 1, '2018-08-17 05:27:39', '2018-08-17 06:23:37'),
(28, 1, 24, 'Rostaa', 'Rostaa - Harvested at its best', 'rostaa', 'brand_1534484610.png', 1, '2018-08-17 05:43:30', '2018-08-17 06:23:41'),
(29, 1, 40, 'Philips', 'Philips', 'philips', 'brand_1534487088.png', 1, '2018-08-17 06:24:48', '2018-08-17 11:53:33'),
(30, 1, 18, 'American Tourist', 'American Tourist', 'american-tourist', 'brand_1534504030.jpg', 1, '2018-08-17 11:07:11', '2018-08-17 11:53:29'),
(31, 1, 41, 'Taylor', 'Taylor', 'taylor', 'brand_1534504780.jpg', 1, '2018-08-17 11:19:41', '2018-08-17 11:53:24'),
(32, 58, 16, 'Lakme', 'test lakme', 'lakme-1', NULL, 0, '2018-10-08 21:50:03', '2018-10-08 21:50:03'),
(33, 58, 15, 'Mexperience', 'fafd', 'mexperience', 'brand_1539240172.JPG', 1, '2018-10-11 16:12:52', '2018-10-11 16:14:12'),
(34, 1, 22, 'Gupta', 'basics of c programming', 'gupta', NULL, 1, '2018-10-19 21:31:39', '2018-10-19 21:33:36'),
(35, 58, 15, 'Johnson Prod', 'test', 'johnson-prod', NULL, 0, '2018-10-19 22:00:31', '2018-10-19 22:00:31');

-- --------------------------------------------------------

--
-- Structure de la table `brands_documents`
--

CREATE TABLE `brands_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `brands_documents` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `brands_documents`
--

INSERT INTO `brands_documents` (`id`, `brand_id`, `user_id`, `brands_documents`, `created_at`, `updated_at`) VALUES
(5, 5, 1, 'brand_doc1533121235297775b6192d38049a.png', '2018-08-01 11:00:35', '2018-08-01 11:00:35'),
(6, 5, 1, 'brand_doc1533121235257825b6192d389c5e.pdf', '2018-08-01 11:00:35', '2018-08-01 11:00:35'),
(9, 6, 1, 'brand_doc153354750363255b6813efe69ec.pdf', '2018-08-06 09:25:03', '2018-08-06 09:25:03'),
(10, 9, 52, 'brand_doc1533797431200665b6be437d5e0b.pdf', '2018-08-09 06:50:31', '2018-08-09 06:50:31'),
(12, 9, 1, 'brand_doc1533800272124645b6bef503f75a.pdf', '2018-08-09 07:37:52', '2018-08-09 07:37:52'),
(13, 9, 1, 'brand_doc153380027228575b6bef504f916.png', '2018-08-09 07:37:52', '2018-08-09 07:37:52'),
(14, 5, 52, 'brand_doc1533800333283345b6bef8d9025f.pdf', '2018-08-09 07:38:53', '2018-08-09 07:38:53'),
(15, 10, 1, 'brand_doc153390552483755b6d8a74d5a6a.pdf', '2018-08-10 12:52:04', '2018-08-10 12:52:04'),
(16, 11, 1, 'brand_doc1533906076246125b6d8c9c24a4e.jpg', '2018-08-10 13:01:16', '2018-08-10 13:01:16'),
(17, 12, 1, 'brand_doc153390612460295b6d8cccf33c2.jpg', '2018-08-10 13:02:04', '2018-08-10 13:02:04'),
(18, 13, 1, 'brand_doc1533906207115865b6d8d1f10a54.jpg', '2018-08-10 13:03:27', '2018-08-10 13:03:27'),
(19, 14, 1, 'brand_doc153390623844355b6d8d3e24b98.png', '2018-08-10 13:03:58', '2018-08-10 13:03:58'),
(20, 15, 1, 'brand_doc1533906560231845b6d8e80bb95c.png', '2018-08-10 13:09:20', '2018-08-10 13:09:20'),
(21, 16, 1, 'brand_doc153390660180735b6d8ea992d33.jpg', '2018-08-10 13:10:01', '2018-08-10 13:10:01'),
(22, 17, 1, 'brand_doc1533907618234385b6d92a2805ec.jpg', '2018-08-10 13:26:58', '2018-08-10 13:26:58'),
(23, 18, 1, 'brand_doc1533908462285915b6d95ee2fe74.jpg', '2018-08-10 13:41:02', '2018-08-10 13:41:02'),
(24, 24, 1, 'brand_doc1534309666194125b73b522f32ba.jpg', '2018-08-15 05:07:47', '2018-08-15 05:07:47'),
(25, 33, 58, 'brand_doc15392401721783991355bbef0ecad67b.jpg', '2018-10-11 16:12:52', '2018-10-11 16:12:52');

-- --------------------------------------------------------

--
-- Structure de la table `cancellation_policy`
--

CREATE TABLE `cancellation_policy` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cancellation_policy`
--

INSERT INTO `cancellation_policy` (`id`, `desc`, `image`, `created_at`, `updated_at`) VALUES
(1, '<h2><strong><u>Return Policy:<br /><br /></u></strong></h2>\r\n<p>Returns is a scheme provided by our respective sellers directly under this policy in terms of which the option of exchange, replacement and/ or refund is offered by the respective sellers to you. All products listed under a particular category may not have the same returns policy. For all products, the policy on the product page shall prevail over the general returns policy. Please find below the respective item\'s applicable return policy on the product page for any exceptions as below.</p>\r\n<p>&nbsp;</p>\r\n<p><strong><u>Categories:</u></strong></p>\r\n<p>&nbsp;Clothing, Footwear, Watches, Sunglasses, Fashion Accessories, Sport &amp; Fitness Equipment,, Baby Care, Jewellery, Footwear Accessories, Travel Accessories, Lingerie (top-wear).</p>\r\n<p><strong><u>Return Window</u></strong><strong>:</strong> 10 days</p>\r\n<p><strong><u>Action Details :</u></strong> Refund or replacement</p>', NULL, '2018-05-01 06:51:16', '2018-05-01 06:51:16');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `cart_temp_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `cart_temp_id`, `color`, `quantity`, `price`, `size`, `created_at`, `updated_at`) VALUES
(83, 15, 34, '', NULL, '1', 30000, NULL, '2018-08-07 12:22:32', '2018-08-07 13:30:17'),
(86, NULL, 160, '5b89281fc3b09', '#46c25f', '1', 16500, 'XXL', '2018-08-31 12:34:35', '2018-08-31 13:36:22'),
(87, NULL, 162, '5b8f86e45772e', '#0088cc', '1', 160150, 'XXL', '2018-09-05 07:33:56', '2018-09-05 13:18:09'),
(88, 60, 165, '5b8f86e45772e', '#03000a', '1', 1850, 'L', '2018-09-05 13:52:58', '2018-10-08 15:44:35');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb_img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `other_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
  `top_menu` tinyint(1) NOT NULL DEFAULT '0',
  `special` tinyint(1) NOT NULL DEFAULT '0',
  `top_seller` tinyint(1) NOT NULL DEFAULT '0',
  `new_arrival` tinyint(1) NOT NULL DEFAULT '0',
  `m_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_desc` text COLLATE utf8mb4_unicode_ci,
  `m_keywords` text COLLATE utf8mb4_unicode_ci,
  `m_tag` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `desc`, `slug`, `cat_img`, `thumb_img`, `other_image`, `sidebar_image`, `recommend`, `top_menu`, `special`, `top_seller`, `new_arrival`, `m_title`, `m_desc`, `m_keywords`, `m_tag`, `created_at`, `updated_at`) VALUES
(3, 'Consumer Electronics', 'Electronics', 'electronics-1', 'cat_1523940890.png', 'thumb_1533812406.jpg', 'other_1523941070.png', 'side_1533812406.jpg', 1, 1, 1, 1, 1, 'Electronics', 'Electronics', 'Electronics', 'Electronics', '2018-02-26 05:52:12', '2018-08-09 11:00:06'),
(4, 'Home & Kitchen', 'Home & Kitchen', 'category-2-1', 'cat_1523940903.png', 'thumb_1533812513.png', NULL, NULL, 0, 1, 0, 1, 1, 'Home & Kitchen', 'Home & Kitchen', 'Home & Kitchen', 'Home & Kitchen', '2018-03-19 17:07:06', '2018-08-09 11:01:53'),
(5, 'Large Home Appliances', 'Large Home Appliances', 'appliances', 'cat_1523940915.png', 'thumb_1533812599.jpg', NULL, NULL, 0, 1, 1, 0, 0, 'Large Home Appliances', 'Large Home Appliances', 'Large Home Appliances', 'Large Home Appliances', '2018-03-19 17:07:18', '2018-08-09 11:31:40'),
(14, 'Auto & Accessories', 'Auto & Accessories', 'men-s-fashion-1', 'cat_1532181537.png', 'thumb_1533812875.jpg', 'other_1533812875.jpg', NULL, 0, 1, 0, 0, 0, 'Auto & Accessories', 'Auto & Accessories', 'Auto & Accessories', 'Auto & Accessories', '2018-07-21 19:06:58', '2018-08-09 11:07:55'),
(15, 'Baby Products', 'Baby Products', 'women-s-fashion-1', 'cat_1532187069.png', 'thumb_1533812953.jpg', NULL, NULL, 0, 0, 0, 0, 0, 'Baby Products', 'Baby Products', 'Baby Products', 'Baby Products', '2018-07-21 20:57:18', '2018-08-09 11:09:13'),
(16, 'Beauty', 'Beauty', 'kids-fashion-toys-1', 'cat_1533876028.jpg', 'thumb_1533876028.jpg', 'other_1533876029.jpg', 'side_1533876029.jpg', 0, 0, 0, 0, 0, 'Beauty', 'Beauty', 'Beauty', 'Beauty', '2018-07-21 20:58:25', '2018-08-10 04:40:29'),
(17, 'Sports', 'Sports', 'sports-fitness-1', 'cat_1533813347.png', 'thumb_1533813347.png', 'other_1533813347.png', 'side_1533813347.png', 0, 0, 0, 0, 0, 'Sports', 'Sports', 'Sports', 'Sports', '2018-07-21 21:05:50', '2018-08-15 09:08:36'),
(18, 'Luggage', 'Luggage', 'bags-luggage-1', 'cat_1533813467.png', 'thumb_1533813466.png', 'other_1533813467.png', 'side_1533813467.png', 0, 0, 0, 0, 0, 'Luggage', 'Luggage', 'Luggage', 'Luggage', '2018-07-21 21:07:17', '2018-08-09 11:32:30'),
(19, 'Computers & Laptops', 'Computers & Laptops', 'computers-accessories-1', 'cat_1532187532.png', 'thumb_1533808161.jpg', NULL, NULL, 0, 0, 0, 0, 0, 'Computers & Laptops', 'Computers & Laptops', 'Computers & Laptops', 'Computers & Laptops', '2018-07-21 21:08:52', '2018-08-09 09:49:21'),
(20, 'Clothings', 'Clothings', 'movies-music-1', 'cat_1533813652.png', 'thumb_1533813652.png', 'other_1533813652.png', 'side_1533813652.png', 0, 0, 0, 0, 0, 'Clothings', 'Clothings', 'Clothings', 'Clothings', '2018-07-21 21:10:19', '2018-08-09 11:20:53'),
(21, 'Furnitures', 'Furnitures', 'video-games-2', 'cat_1533813765.png', 'thumb_1533813765.png', NULL, NULL, 0, 0, 0, 0, 0, 'Furnitures', 'Furnitures', 'Furnitures', 'Furnitures', '2018-07-21 21:10:59', '2018-08-09 11:22:45'),
(22, 'Books', 'Books', 'books', 'cat_1532187723.png', 'thumb_1533813848.png', 'other_1533813848.png', 'side_1533813848.png', 0, 0, 0, 0, 0, 'Books', 'Books', 'Books', 'Books', '2018-07-21 21:12:03', '2018-08-09 11:24:08'),
(24, 'Grocery-food & Beverages', 'Grocery-food & Beverages', 'grocery-gourmet-1', 'cat_1533813257.jpg', 'thumb_1533813257.jpg', 'other_1533813257.jpg', 'side_1533813257.jpg', 0, 0, 0, 0, 0, 'Grocery-food & Beverages', 'Grocery-food & Beverages', 'Grocery-food & Beverages', 'Grocery-food & Beverages', '2018-07-21 21:14:28', '2018-08-09 11:14:17'),
(39, 'Jewelry', 'Jewelry', 'jewelry', 'cat_1533808733.png', 'thumb_1533808733.jpg', 'other_1533808733.png', 'side_1533808733.png', 0, 0, 0, 0, 0, 'Jewelry', 'Jewelry', 'Jewelry', 'Jewelry', '2018-08-09 09:58:54', '2018-08-09 09:58:54'),
(40, 'Home & Lightnings', 'Home & Lightnings', 'home-lightnings', 'cat_1533809189.jpg', 'thumb_1533809189.jpg', 'other_1533809189.jpg', 'side_1533809189.jpg', 0, 0, 0, 0, 0, 'Home & Lightnings', 'Home & Lightnings', 'Home & Lightnings', 'Home & Lightnings', '2018-08-09 10:06:29', '2018-08-09 10:06:29'),
(41, 'Musical Instruments', 'Musical Instruments', 'musical-instruments', 'cat_1533809587.jpg', 'thumb_1533809587.jpg', 'other_1533809587.jpg', 'side_1533809587.jpg', 0, 0, 0, 0, 0, 'Musical Instruments', 'Musical Instruments', 'Musical Instruments', 'Musical Instruments', '2018-08-09 10:13:07', '2018-08-09 10:13:07'),
(42, 'Office Supplies', 'Office Supplies', 'office-supplies', 'cat_1533809759.jpg', 'thumb_1533809759.jpg', 'other_1533809759.jpg', 'side_1533809759.jpg', 0, 0, 0, 0, 0, 'Office Supplies', 'Office Supplies', 'Office Supplies', 'Office Supplies', '2018-08-09 10:15:59', '2018-08-09 10:15:59'),
(43, 'Pet Supplies', 'Pet Supplies', 'pet-supplies', 'cat_1533809883.png', 'thumb_1533809883.png', 'other_1533809883.png', 'side_1533809883.png', 0, 0, 0, 0, 0, 'Pet Supplies', 'Pet Supplies', 'Pet Supplies', 'Pet Supplies', '2018-08-09 10:18:03', '2018-08-09 10:18:03'),
(44, 'Shoes & Handbags', 'Shoes & Handbags', 'shoes-handbags', 'cat_1533810022.jpg', 'thumb_1533810022.jpg', 'other_1533810022.jpg', 'side_1533810022.jpg', 0, 0, 0, 0, 0, 'Shoes & Handbags', 'Shoes & Handbags', 'Shoes & Handbags', 'Shoes & Handbags', '2018-08-09 10:20:22', '2018-08-09 10:20:22'),
(45, 'Toys & Games', 'Toys & Games', 'toys-games', 'cat_1533810544.png', 'thumb_1533810543.png', 'other_1533810544.png', 'side_1533810544.png', 0, 0, 0, 0, 0, 'Toys & Games', 'Toys & Games', 'Toys & Games', 'Toys & Games', '2018-08-09 10:29:04', '2018-08-09 10:29:04'),
(46, 'Video Games & Consoles', 'Video Games & Consoles', 'video-games-consoles', 'cat_1533810620.jpg', 'thumb_1533810620.jpg', 'other_1533810620.jpg', 'side_1533810621.jpg', 0, 0, 0, 0, 0, 'Video Games & Consoles', 'Video Games & Consoles', 'Video Games & Consoles', 'Video Games & Consoles', '2018-08-09 10:30:21', '2018-08-09 10:30:21'),
(47, 'Watches', 'Watches', 'watches', 'cat_1533810708.png', 'thumb_1533810708.png', 'other_1533810708.png', 'side_1533810708.png', 0, 0, 0, 0, 0, 'Watches', 'Watches', 'Watches', 'Watches', '2018-08-09 10:31:48', '2018-08-09 10:31:48'),
(49, 'Garden & Outdoor', 'Garden & Outdoor', 'garden-outdoor', 'cat_1533810913.jpg', 'thumb_1533810913.jpg', 'other_1533810913.jpg', 'side_1533810913.jpg', 0, 0, 0, 0, 0, 'Garden & Outdoor', 'Garden & Outdoor', 'Garden & Outdoor', 'Garden & Outdoor', '2018-08-09 10:35:13', '2018-08-09 10:35:13'),
(50, 'Books', 'story books', 'books-1', NULL, 'default.png', NULL, NULL, 0, 0, 1, 1, 1, 'story books', 'story books', 'story books', 'story books', '2018-10-19 21:26:22', '2018-10-19 21:27:17');

-- --------------------------------------------------------

--
-- Structure de la table `charity_gift`
--

CREATE TABLE `charity_gift` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mob_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anonymously` tinyint(1) NOT NULL DEFAULT '0',
  `charity_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_donate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_info` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `circle`
--

CREATE TABLE `circle` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `circle`
--

INSERT INTO `circle` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Andhra Pradesh', 'AP', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(2, 'Assam', 'AS', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(3, 'Bihar & Jharkhand', 'BR', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(4, 'Chennai', 'CH', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(5, 'Delhi', 'DL', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(6, 'Gujarat', 'GJ', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(7, 'Haryana', 'HR', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(8, 'Himachal Pradesh', 'HP', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(9, 'Jammu & Kashmir', 'JK', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(10, 'Karnataka', 'KA', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(11, 'Kerala', 'KL', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(12, 'Kolkata', 'KO', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(13, 'Maharashtra & Goa (except Mumbai)', 'MH', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(14, 'Madhya Pradesh & Chhattisgarh', 'MP', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(15, 'Mumbai', 'MU', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(16, 'North East', 'NE', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(17, 'Orissa', 'OR', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(18, 'Punjab', 'PB', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(19, 'Rajasthan', 'RJ', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(20, 'Tamil Nadu', 'TN', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(21, 'Uttar Pradesh', 'UE', '2018-03-19 16:45:55', '2018-03-19 16:45:55'),
(22, 'West Bengal', 'WB', '2018-03-19 16:45:55', '2018-03-19 16:45:55');

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `state_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Mumbai', '2018-03-23 11:53:14', '2018-03-23 11:53:14'),
(2, 3, 'Delhi', '2018-03-23 11:53:14', '2018-03-23 11:53:14'),
(3, 4, 'Bengaluru', '2018-03-23 11:53:14', '2018-03-23 11:53:14'),
(4, 5, 'Ahmedabad', '2018-03-23 11:53:14', '2018-03-23 11:53:14'),
(5, 6, 'Hyderabad', '2018-03-23 11:53:14', '2018-03-23 11:53:14'),
(6, 7, 'Chennai', '2018-03-23 11:53:14', '2018-03-23 11:53:14'),
(7, 8, 'Kolkata', '2018-03-23 11:53:14', '2018-03-23 11:53:14'),
(8, 2, 'Pune', '2018-03-23 11:53:14', '2018-03-23 11:53:14'),
(9, 9, 'Jaipur', '2018-03-23 11:53:14', '2018-03-23 11:53:14'),
(10, 5, 'Surat', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(11, 10, 'Lucknow', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(12, 10, 'Kanpur', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(13, 2, 'Nagpur', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(14, 11, 'Patna', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(15, 12, 'Indore', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(16, 2, 'Thane', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(17, 12, 'Bhopal', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(18, 13, 'Visakhapatnam', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(19, 5, 'Vadodara', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(20, 10, 'Firozabad', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(21, 14, 'Ludhiana', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(22, 5, 'Rajkot', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(23, 10, 'Agra', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(24, 8, 'Siliguri', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(25, 2, 'Nashik', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(26, 15, 'Faridabad', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(27, 14, 'Patiala', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(28, 10, 'Meerut', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(29, 2, 'Kalyan-Dombivali', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(30, 2, 'Vasai-Virar', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(31, 10, 'Varanasi', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(32, 16, 'Srinagar', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(33, 17, 'Dhanbad', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(34, 9, 'Jodhpur', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(35, 14, 'Amritsar', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(36, 18, 'Raipur', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(37, 10, 'Allahabad', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(38, 7, 'Coimbatore', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(39, 12, 'Jabalpur', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(40, 12, 'Gwalior', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(41, 13, 'Vijayawada', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(42, 7, 'Madurai', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(43, 19, 'Guwahati', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(44, 20, 'Chandigarh', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(45, 4, 'Hubli-Dharwad', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(46, 10, 'Amroha', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(47, 10, 'Moradabad', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(48, 15, 'Gurgaon', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(49, 10, 'Aligarh', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(50, 2, 'Solapur', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(51, 17, 'Ranchi', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(52, 14, 'Jalandhar', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(53, 7, 'Tiruchirappalli', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(54, 21, 'Bhubaneswar', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(55, 7, 'Salem', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(56, 6, 'Warangal', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(57, 2, 'Mira-Bhayandar', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(58, 22, 'Thiruvananthapuram', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(59, 2, 'Bhiwandi', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(60, 10, 'Saharanpur', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(61, 13, 'Guntur', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(62, 2, 'Amravati', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(63, 9, 'Bikaner', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(64, 10, 'Noida', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(65, 17, 'Jamshedpur', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(66, 18, 'Bhilai Nagar', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(67, 21, 'Cuttack', '2018-03-23 11:53:16', '2018-03-23 11:53:16'),
(68, 22, 'Kochi', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(69, 9, 'Udaipur', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(70, 5, 'Bhavnagar', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(71, 23, 'Dehradun', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(72, 8, 'Asansol', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(73, 2, 'Nanded-Waghala', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(74, 9, 'Ajmer', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(75, 5, 'Jamnagar', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(76, 12, 'Ujjain', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(77, 2, 'Sangli', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(78, 10, 'Loni', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(79, 10, 'Jhansi', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(80, 24, 'Pondicherry', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(81, 13, 'Nellore', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(82, 16, 'Jammu', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(83, 4, 'Belagavi', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(84, 21, 'Raurkela', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(85, 4, 'Mangaluru', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(86, 7, 'Tirunelveli', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(87, 2, 'Malegaon', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(88, 11, 'Gaya', '2018-03-23 11:53:17', '2018-03-23 11:53:17'),
(89, 7, 'Tiruppur', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(90, 4, 'Davanagere', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(91, 22, 'Kozhikode', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(92, 2, 'Akola', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(93, 13, 'Kurnool', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(94, 17, 'Bokaro Steel City', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(95, 13, 'Rajahmundry', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(96, 4, 'Ballari', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(97, 25, 'Agartala', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(98, 11, 'Bhagalpur', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(99, 2, 'Latur', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(100, 2, 'Dhule', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(101, 18, 'Korba', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(102, 9, 'Bhilwara', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(103, 21, 'Brahmapur', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(104, 4, 'Mysore', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(105, 11, 'Muzaffarpur', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(106, 2, 'Ahmednagar', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(107, 22, 'Kollam', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(108, 8, 'Raghunathganj', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(109, 18, 'Bilaspur', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(110, 10, 'Shahjahanpur', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(111, 22, 'Thrissur', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(112, 9, 'Alwar', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(113, 13, 'Kakinada', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(114, 6, 'Nizamabad', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(115, 12, 'Sagar', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(116, 4, 'Tumkur', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(117, 15, 'Hisar', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(118, 15, 'Rohtak', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(119, 15, 'Panipat', '2018-03-23 11:53:18', '2018-03-23 11:53:18'),
(120, 11, 'Darbhanga', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(121, 8, 'Kharagpur', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(122, 26, 'Aizawl', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(123, 2, 'Ichalkaranji', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(124, 13, 'Tirupati', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(125, 15, 'Karnal', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(126, 14, 'Bathinda', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(127, 10, 'Rampur', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(128, 4, 'Shivamogga', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(129, 12, 'Ratlam', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(130, 10, 'Modinagar', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(131, 18, 'Durg', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(132, 27, 'Shillong', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(133, 28, 'Imphal', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(134, 10, 'Hapur', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(135, 7, 'Ranipet', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(136, 13, 'Anantapur', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(137, 11, 'Arrah', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(138, 6, 'Karimnagar', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(139, 2, 'Parbhani', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(140, 10, 'Etawah', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(141, 9, 'Bharatpur', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(142, 11, 'Begusarai', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(143, 3, 'New Delhi', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(144, 11, 'Chhapra', '2018-03-23 11:53:19', '2018-03-23 11:53:19'),
(145, 13, 'Kadapa', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(146, 6, 'Ramagundam', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(147, 9, 'Pali', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(148, 12, 'Satna', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(149, 13, 'Vizianagaram', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(150, 11, 'Katihar', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(151, 23, 'Hardwar', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(152, 15, 'Sonipat', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(153, 7, 'Nagercoil', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(154, 7, 'Thanjavur', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(155, 12, 'Murwara (Katni]', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(156, 8, 'Naihati', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(157, 10, 'Sambhal', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(158, 5, 'Nadiad', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(159, 15, 'Yamunanagar', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(160, 8, 'English Bazar', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(161, 13, 'Eluru', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(162, 11, 'Munger', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(163, 15, 'Panchkula', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(164, 4, 'Raayachuru', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(165, 2, 'Panvel', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(166, 17, 'Deoghar', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(167, 13, 'Ongole', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(168, 13, 'Nandyal', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(169, 12, 'Morena', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(170, 15, 'Bhiwani', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(171, 5, 'Porbandar', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(172, 22, 'Palakkad', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(173, 5, 'Anand', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(174, 11, 'Purnia', '2018-03-23 11:53:20', '2018-03-23 11:53:20'),
(175, 8, 'Baharampur', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(176, 9, 'Barmer', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(177, 5, 'Morvi', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(178, 10, 'Orai', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(179, 10, 'Bahraich', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(180, 9, 'Sikar', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(181, 7, 'Vellore', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(182, 12, 'Singrauli', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(183, 6, 'Khammam', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(184, 5, 'Mahesana', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(185, 19, 'Silchar', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(186, 21, 'Sambalpur', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(187, 12, 'Rewa', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(188, 10, 'Unnao', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(189, 8, 'Hugli-Chinsurah', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(190, 8, 'Raiganj', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(191, 17, 'Phusro', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(192, 17, 'Adityapur', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(193, 22, 'Alappuzha', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(194, 15, 'Bahadurgarh', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(195, 13, 'Machilipatnam', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(196, 10, 'Rae Bareli', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(197, 8, 'Jalpaiguri', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(198, 5, 'Bharuch', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(199, 14, 'Pathankot', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(200, 14, 'Hoshiarpur', '2018-03-23 11:53:21', '2018-03-23 11:53:21'),
(201, 16, 'Baramula', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(202, 13, 'Adoni', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(203, 15, 'Jind', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(204, 9, 'Tonk', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(205, 13, 'Tenali', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(206, 7, 'Kancheepuram', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(207, 5, 'Vapi', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(208, 15, 'Sirsa', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(209, 5, 'Navsari', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(210, 6, 'Mahbubnagar', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(211, 21, 'Puri', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(212, 4, 'Robertson Pet', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(213, 7, 'Erode', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(214, 14, 'Batala', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(215, 23, 'Haldwani-cum-Kathgodam', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(216, 12, 'Vidisha', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(217, 11, 'Saharsa', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(218, 15, 'Thanesar', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(219, 13, 'Chittoor', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(220, 5, 'Veraval', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(221, 10, 'Lakhimpur', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(222, 10, 'Sitapur', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(223, 13, 'Hindupur', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(224, 8, 'Santipur', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(225, 8, 'Balurghat', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(226, 12, 'Ganjbasoda', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(227, 14, 'Moga', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(228, 13, 'Proddatur', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(229, 23, 'Srinagar', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(230, 8, 'Medinipur', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(231, 8, 'Habra', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(232, 11, 'Sasaram', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(233, 11, 'Hajipur', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(234, 5, 'Bhuj', '2018-03-23 11:53:22', '2018-03-23 11:53:22'),
(235, 12, 'Shivpuri', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(236, 8, 'Ranaghat', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(237, 29, 'Shimla', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(238, 7, 'Tiruvannamalai', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(239, 15, 'Kaithal', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(240, 18, 'Rajnandgaon', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(241, 5, 'Godhra', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(242, 17, 'Hazaribag', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(243, 13, 'Bhimavaram', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(244, 12, 'Mandsaur', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(245, 19, 'Dibrugarh', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(246, 4, 'Kolar', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(247, 8, 'Bankura', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(248, 4, 'Mandya', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(249, 11, 'Dehri-on-Sone', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(250, 13, 'Madanapalle', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(251, 14, 'Malerkotla', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(252, 10, 'Lalitpur', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(253, 11, 'Bettiah', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(254, 7, 'Pollachi', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(255, 14, 'Khanna', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(256, 12, 'Neemuch', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(257, 15, 'Palwal', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(258, 5, 'Palanpur', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(259, 13, 'Guntakal', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(260, 8, 'Nabadwip', '2018-03-23 11:53:23', '2018-03-23 11:53:23'),
(261, 4, 'Udupi', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(262, 18, 'Jagdalpur', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(263, 11, 'Motihari', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(264, 10, 'Pilibhit', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(265, 30, 'Dimapur', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(266, 14, 'Mohali', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(267, 9, 'Sadulpur', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(268, 7, 'Rajapalayam', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(269, 13, 'Dharmavaram', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(270, 23, 'Kashipur', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(271, 7, 'Sivakasi', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(272, 8, 'Darjiling', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(273, 4, 'Chikkamagaluru', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(274, 13, 'Gudivada', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(275, 21, 'Baleshwar Town', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(276, 6, 'Mancherial', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(277, 13, 'Srikakulam', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(278, 6, 'Adilabad', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(279, 2, 'Yavatmal', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(280, 14, 'Barnala', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(281, 19, 'Nagaon', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(282, 13, 'Narasaraopet', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(283, 18, 'Raigarh', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(284, 23, 'Roorkee', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(285, 5, 'Valsad', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(286, 18, 'Ambikapur', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(287, 17, 'Giridih', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(288, 10, 'Chandausi', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(289, 8, 'Purulia', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(290, 5, 'Patan', '2018-03-23 11:53:24', '2018-03-23 11:53:24'),
(291, 11, 'Bagaha', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(292, 10, 'Hardoi ', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(293, 2, 'Achalpur', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(294, 2, 'Osmanabad', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(295, 5, 'Deesa', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(296, 2, 'Nandurbar', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(297, 10, 'Azamgarh', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(298, 17, 'Ramgarh', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(299, 14, 'Firozpur', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(300, 21, 'Baripada Town', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(301, 4, 'Karwar', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(302, 11, 'Siwan', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(303, 13, 'Rajampet', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(304, 7, 'Pudukkottai', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(305, 16, 'Anantnag', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(306, 13, 'Tadpatri', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(307, 2, 'Satara', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(308, 21, 'Bhadrak', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(309, 11, 'Kishanganj', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(310, 6, 'Suryapet', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(311, 2, 'Wardha', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(312, 4, 'Ranebennuru', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(313, 5, 'Amreli', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(314, 7, 'Neyveli (TS]', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(315, 11, 'Jamalpur', '2018-03-23 11:53:25', '2018-03-23 11:53:25'),
(316, 31, 'Marmagao', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(317, 2, 'Udgir', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(318, 13, 'Tadepalligudem', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(319, 7, 'Nagapattinam', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(320, 11, 'Buxar', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(321, 2, 'Aurangabad', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(322, 11, 'Jehanabad', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(323, 14, 'Phagwara', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(324, 10, 'Khair', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(325, 9, 'Sawai Madhopur', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(326, 14, 'Kapurthala', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(327, 13, 'Chilakaluripet', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(328, 11, 'Aurangabad', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(329, 22, 'Malappuram', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(330, 15, 'Rewari', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(331, 9, 'Nagaur', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(332, 10, 'Sultanpur', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(333, 12, 'Nagda', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(334, 32, 'Port Blair', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(335, 11, 'Lakhisarai', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(336, 31, 'Panaji', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(337, 19, 'Tinsukia', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(338, 12, 'Itarsi', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(339, 30, 'Kohima', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(340, 21, 'Balangir', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(341, 11, 'Nawada', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(342, 21, 'Jharsuguda', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(343, 6, 'Jagtial', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(344, 7, 'Viluppuram', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(345, 2, 'Amalner', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(346, 14, 'Zirakpur', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(347, 10, 'Tanda', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(348, 7, 'Tiruchengode', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(349, 10, 'Nagina', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(350, 13, 'Yemmiganur', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(351, 7, 'Vaniyambadi', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(352, 12, 'Sarni', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(353, 7, 'Theni Allinagaram', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(354, 31, 'Margao', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(355, 2, 'Akot', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(356, 12, 'Sehore', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(357, 12, 'Mhow Cantonment', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(358, 14, 'Kot Kapura', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(359, 9, 'Makrana', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(360, 2, 'Pandharpur', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(361, 6, 'Miryalaguda', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(362, 10, 'Shamli', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(363, 12, 'Seoni', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(364, 4, 'Ranibennur', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(365, 13, 'Kadiri', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(366, 2, 'Shrirampur', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(367, 23, 'Rudrapur', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(368, 2, 'Parli', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(369, 10, 'Najibabad', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(370, 6, 'Nirmal', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(371, 7, 'Udhagamandalam', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(372, 10, 'Shikohabad', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(373, 17, 'Jhumri Tilaiya', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(374, 7, 'Aruppukkottai', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(375, 22, 'Ponnani', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(376, 11, 'Jamui', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(377, 11, 'Sitamarhi', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(378, 13, 'Chirala', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(379, 5, 'Anjar', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(380, 24, 'Karaikal', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(381, 15, 'Hansi', '2018-03-23 11:53:27', '2018-03-23 11:53:27'),
(382, 13, 'Anakapalle', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(383, 18, 'Mahasamund', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(384, 14, 'Faridkot', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(385, 17, 'Saunda', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(386, 5, 'Dhoraji', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(387, 7, 'Paramakudi', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(388, 12, 'Balaghat', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(389, 9, 'Sujangarh', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(390, 5, 'Khambhat', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(391, 14, 'Muktsar', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(392, 14, 'Rajpura', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(393, 13, 'Kavali', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(394, 18, 'Dhamtari', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(395, 12, 'Ashok Nagar', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(396, 9, 'Sardarshahar', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(397, 5, 'Mahuva', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(398, 21, 'Bargarh', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(399, 6, 'Kamareddy', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(400, 17, 'Sahibganj', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(401, 6, 'Kothagudem', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(402, 4, 'Ramanagaram', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(403, 4, 'Gokak', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(404, 12, 'Tikamgarh', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(405, 11, 'Araria', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(406, 23, 'Rishikesh', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(407, 12, 'Shahdol', '2018-03-23 11:53:28', '2018-03-23 11:53:28'),
(408, 17, 'Medininagar (Daltonganj]', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(409, 7, 'Arakkonam', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(410, 2, 'Washim', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(411, 14, 'Sangrur', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(412, 6, 'Bodhan', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(413, 14, 'Fazilka', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(414, 13, 'Palacole', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(415, 5, 'Keshod', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(416, 13, 'Sullurpeta', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(417, 5, 'Wadhwan', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(418, 14, 'Gurdaspur', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(419, 22, 'Vatakara', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(420, 27, 'Tura', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(421, 15, 'Narnaul', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(422, 14, 'Kharar', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(423, 4, 'Yadgir', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(424, 2, 'Ambejogai', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(425, 5, 'Ankleshwar', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(426, 5, 'Savarkundla', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(427, 21, 'Paradip', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(428, 7, 'Virudhachalam', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(429, 22, 'Kanhangad', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(430, 5, 'Kadi', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(431, 7, 'Srivilliputhur', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(432, 14, 'Gobindgarh', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(433, 7, 'Tindivanam', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(434, 14, 'Mansa', '2018-03-23 11:53:29', '2018-03-23 11:53:29'),
(435, 22, 'Taliparamba', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(436, 2, 'Manmad', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(437, 13, 'Tanuku', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(438, 13, 'Rayachoti', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(439, 7, 'Virudhunagar', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(440, 22, 'Koyilandy', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(441, 19, 'Jorhat', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(442, 7, 'Karur', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(443, 7, 'Valparai', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(444, 13, 'Srikalahasti', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(445, 22, 'Neyyattinkara', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(446, 13, 'Bapatla', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(447, 15, 'Fatehabad', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(448, 14, 'Malout', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(449, 7, 'Sankarankovil', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(450, 7, 'Tenkasi', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(451, 2, 'Ratnagiri', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(452, 4, 'Rabkavi Banhatti', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(453, 10, 'Sikandrabad', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(454, 17, 'Chaibasa', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(455, 18, 'Chirmiri', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(456, 6, 'Palwancha', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(457, 21, 'Bhawanipatna', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(458, 22, 'Kayamkulam', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(459, 12, 'Pithampur', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(460, 14, 'Nabha', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(461, 10, 'Shahabad, Hardoi', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(462, 21, 'Dhenkanal', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(463, 2, 'Uran Islampur', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(464, 11, 'Gopalganj', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(465, 19, 'Bongaigaon City', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(466, 7, 'Palani', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(467, 2, 'Pusad', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(468, 16, 'Sopore', '2018-03-23 11:53:30', '2018-03-23 11:53:30'),
(469, 10, 'Pilkhuwa', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(470, 14, 'Tarn Taran', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(471, 10, 'Renukoot', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(472, 6, 'Mandamarri', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(473, 4, 'Shahabad', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(474, 21, 'Barbil', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(475, 6, 'Koratla', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(476, 11, 'Madhubani', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(477, 8, 'Arambagh', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(478, 15, 'Gohana', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(479, 9, 'Ladnu', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(480, 7, 'Pattukkottai', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(481, 4, 'Sirsi', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(482, 6, 'Sircilla', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(483, 8, 'Tamluk', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(484, 14, 'Jagraon', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(485, 8, 'AlipurdUrban Agglomerationr', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(486, 12, 'Alirajpur', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(487, 6, 'Tandur', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(488, 13, 'Naidupet', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(489, 7, 'Tirupathur', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(490, 15, 'Tohana', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(491, 9, 'Ratangarh', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(492, 19, 'Dhubri', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(493, 11, 'Masaurhi', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(494, 5, 'Visnagar', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(495, 10, 'Vrindavan', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(496, 9, 'Nokha', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(497, 13, 'Nagari', '2018-03-23 11:53:31', '2018-03-23 11:53:31'),
(498, 15, 'Narwana', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(499, 7, 'Ramanathapuram', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(500, 10, 'Ujhani', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(501, 11, 'Samastipur', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(502, 10, 'Laharpur', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(503, 2, 'Sangamner', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(504, 9, 'Nimbahera', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(505, 6, 'Siddipet', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(506, 8, 'Suri', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(507, 19, 'Diphu', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(508, 8, 'Jhargram', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(509, 2, 'Shirpur-Warwade', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(510, 10, 'Tilhar', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(511, 4, 'Sindhnur', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(512, 7, 'Udumalaipettai', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(513, 2, 'Malkapur', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(514, 6, 'Wanaparthy', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(515, 13, 'Gudur', '2018-03-23 11:53:32', '2018-03-23 11:53:32'),
(516, 21, 'Kendujhar', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(517, 12, 'Mandla', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(518, 29, 'Mandi', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(519, 22, 'Nedumangad', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(520, 19, 'North Lakhimpur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(521, 13, 'Vinukonda', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(522, 4, 'Tiptur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(523, 7, 'Gobichettipalayam', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(524, 21, 'Sunabeda', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(525, 2, 'Wani', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(526, 5, 'Upleta', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(527, 13, 'Narasapuram', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(528, 13, 'Nuzvid', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(529, 19, 'Tezpur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(530, 5, 'Una', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(531, 13, 'Markapur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(532, 12, 'Sheopur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(533, 7, 'Thiruvarur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(534, 5, 'Sidhpur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(535, 10, 'Sahaswan', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(536, 9, 'Suratgarh', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(537, 12, 'Shajapur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(538, 21, 'Rayagada', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(539, 2, 'Lonavla', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(540, 13, 'Ponnur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(541, 6, 'Kagaznagar', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(542, 6, 'Gadwal', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(543, 18, 'Bhatapara', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(544, 13, 'Kandukur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(545, 6, 'Sangareddy', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(546, 5, 'Unjha', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(547, 26, 'Lunglei', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(548, 19, 'Karimganj', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(549, 22, 'Kannur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(550, 13, 'Bobbili', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(551, 11, 'Mokameh', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(552, 2, 'Talegaon Dabhade', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(553, 2, 'Anjangaon', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(554, 5, 'Mangrol', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(555, 14, 'Sunam', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(556, 8, 'Gangarampur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(557, 7, 'Thiruvallur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(558, 22, 'Tirur', '2018-03-23 11:53:33', '2018-03-23 11:53:33'),
(559, 10, 'Rath', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(560, 21, 'Jatani', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(561, 5, 'Viramgam', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(562, 9, 'Rajsamand', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(563, 24, 'Yanam', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(564, 22, 'Kottayam', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(565, 7, 'Panruti', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(566, 14, 'Dhuri', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(567, 7, 'Namakkal', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(568, 22, 'Kasaragod', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(569, 5, 'Modasa', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(570, 13, 'Rayadurg', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(571, 11, 'Supaul', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(572, 22, 'Kunnamkulam', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(573, 2, 'Umred', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(574, 6, 'Bellampalle', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(575, 19, 'Sibsagar', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(576, 15, 'Mandi Dabwali', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(577, 22, 'Ottappalam', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(578, 11, 'Dumraon', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(579, 13, 'Samalkot', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(580, 13, 'Jaggaiahpet', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(581, 19, 'Goalpara', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(582, 13, 'Tuni', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(583, 9, 'Lachhmangarh', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(584, 6, 'Bhongir', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(585, 13, 'Amalapuram', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(586, 14, 'Firozpur Cantt.', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(587, 6, 'Vikarabad', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(588, 22, 'Thiruvalla', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(589, 10, 'Sherkot', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(590, 2, 'Palghar', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(591, 2, 'Shegaon', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(592, 6, 'Jangaon', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(593, 13, 'Bheemunipatnam', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(594, 12, 'Panna', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(595, 22, 'Thodupuzha', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(596, 16, 'KathUrban Agglomeration', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(597, 5, 'Palitana', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(598, 11, 'Arwal', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(599, 13, 'Venkatagiri', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(600, 10, 'Kalpi', '2018-03-23 11:53:34', '2018-03-23 11:53:34'),
(601, 9, 'Rajgarh (Churu]', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(602, 13, 'Sattenapalle', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(603, 4, 'Arsikere', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(604, 2, 'Ozar', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(605, 7, 'Thirumangalam', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(606, 5, 'Petlad', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(607, 9, 'Nasirabad', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(608, 2, 'Phaltan', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(609, 8, 'Rampurhat', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(610, 4, 'Nanjangud', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(611, 11, 'Forbesganj', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(612, 10, 'Tundla', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(613, 11, 'BhabUrban Agglomeration', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(614, 4, 'Sagara', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(615, 13, 'Pithapuram', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(616, 4, 'Sira', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(617, 6, 'Bhadrachalam', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(618, 15, 'Charkhi Dadri', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(619, 17, 'Chatra', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(620, 13, 'Palasa Kasibugga', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(621, 9, 'Nohar', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(622, 2, 'Yevla', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(623, 14, 'Sirhind Fatehgarh Sahib', '2018-03-23 11:53:35', '2018-03-23 11:53:35'),
(624, 6, 'Bhainsa', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(625, 13, 'Parvathipuram', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(626, 2, 'Shahade', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(627, 22, 'Chalakudy', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(628, 11, 'Narkatiaganj', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(629, 5, 'Kapadvanj', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(630, 13, 'Macherla', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(631, 12, 'Raghogarh-Vijaypur', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(632, 14, 'Rupnagar', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(633, 11, 'Naugachhia', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(634, 12, 'Sendhwa', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(635, 21, 'Byasanagar', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(636, 10, 'Sandila', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(637, 13, 'Gooty', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(638, 13, 'Salur', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(639, 10, 'Nanpara', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(640, 10, 'Sardhana', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(641, 2, 'Vita', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(642, 17, 'Gumia', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(643, 4, 'Puttur', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(644, 14, 'Jalandhar Cantt.', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(645, 10, 'Nehtaur', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(646, 22, 'Changanassery', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(647, 13, 'Mandapeta', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(648, 17, 'Dumka', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(649, 10, 'Seohara', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(650, 2, 'Umarkhed', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(651, 17, 'Madhupur', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(652, 7, 'Vikramasingapuram', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(653, 22, 'Punalur', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(654, 21, 'Kendrapara', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(655, 5, 'Sihor', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(656, 7, 'Nellikuppam', '2018-03-23 11:53:36', '2018-03-23 11:53:36'),
(657, 14, 'Samana', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(658, 2, 'Warora', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(659, 22, 'Nilambur', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(660, 7, 'Rasipuram', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(661, 23, 'Ramnagar', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(662, 13, 'Jammalamadugu', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(663, 14, 'Nawanshahr', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(664, 28, 'Thoubal', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(665, 4, 'Athni', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(666, 22, 'Cherthala', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(667, 12, 'Sidhi', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(668, 6, 'Farooqnagar', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(669, 13, 'Peddapuram', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(670, 17, 'Chirkunda', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(671, 2, 'Pachora', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(672, 11, 'Madhepura', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(673, 23, 'Pithoragarh', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(674, 2, 'Tumsar', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(675, 9, 'Phalodi', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(676, 7, 'Tiruttani', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(677, 14, 'Rampura Phul', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(678, 22, 'Perinthalmanna', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(679, 10, 'Padrauna', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(680, 12, 'Pipariya', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(681, 18, 'Dalli-Rajhara', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(682, 13, 'Punganur', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(683, 22, 'Mattannur', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(684, 10, 'Mathura', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(685, 10, 'Thakurdwara', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(686, 7, 'Nandivaram-Guduvancheri', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(687, 4, 'Mulbagal', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(688, 2, 'Manjlegaon', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(689, 5, 'Wankaner', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(690, 2, 'Sillod', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(691, 13, 'Nidadavole', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(692, 4, 'Surapura', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(693, 21, 'Rajagangapur', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(694, 11, 'Sheikhpura', '2018-03-23 11:53:37', '2018-03-23 11:53:37'),
(695, 21, 'Parlakhemundi', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(696, 8, 'Kalimpong', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(697, 4, 'Siruguppa', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(698, 2, 'Arvi', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(699, 5, 'Limbdi', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(700, 19, 'Barpeta', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(701, 23, 'Manglaur', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(702, 13, 'Repalle', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(703, 4, 'Mudhol', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(704, 12, 'Shujalpur', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(705, 5, 'Mandvi', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(706, 5, 'Thangadh', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(707, 12, 'Sironj', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(708, 2, 'Nandura', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(709, 22, 'Shoranur', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(710, 9, 'Nathdwara', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(711, 7, 'Periyakulam', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(712, 11, 'Sultanganj', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(713, 6, 'Medak', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(714, 6, 'Narayanpet', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(715, 11, 'Raxaul Bazar', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(716, 16, 'Rajauri', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(717, 7, 'Pernampattu', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(718, 23, 'Nainital', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(719, 13, 'Ramachandrapuram', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(720, 2, 'Vaijapur', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(721, 14, 'Nangal', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(722, 4, 'Sidlaghatta', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(723, 16, 'Punch', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(724, 12, 'Pandhurna', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(725, 2, 'Wadgaon Road', '2018-03-23 11:53:38', '2018-03-23 11:53:38'),
(726, 21, 'Talcher', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(727, 22, 'Varkala', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(728, 9, 'Pilani', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(729, 12, 'Nowgong', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(730, 18, 'Naila Janjgir', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(731, 31, 'Mapusa', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(732, 7, 'Vellakoil', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(733, 9, 'Merta City', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(734, 7, 'Sivaganga', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(735, 12, 'Mandideep', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(736, 2, 'Sailu', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(737, 5, 'Vyara', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(738, 13, 'Kovvur', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(739, 7, 'Vadalur', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(740, 10, 'Nawabganj', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(741, 5, 'Padra', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(742, 8, 'Sainthia', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(743, 10, 'Siana', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(744, 4, 'Shahpur', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(745, 9, 'Sojat', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(746, 10, 'Noorpur', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(747, 22, 'Paravoor', '2018-03-23 11:53:39', '2018-03-23 11:53:39');
INSERT INTO `cities` (`id`, `state_id`, `name`, `created_at`, `updated_at`) VALUES
(748, 2, 'Murtijapur', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(749, 11, 'Ramnagar', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(750, 21, 'Sundargarh', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(751, 8, 'Taki', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(752, 4, 'Saundatti-Yellamma', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(753, 22, 'Pathanamthitta', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(754, 4, 'Wadi', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(755, 7, 'Rameshwaram', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(756, 2, 'Tasgaon', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(757, 10, 'Sikandra Rao', '2018-03-23 11:53:39', '2018-03-23 11:53:39'),
(758, 12, 'Sihora', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(759, 7, 'Tiruvethipuram', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(760, 13, 'Tiruvuru', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(761, 2, 'Mehkar', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(762, 22, 'Peringathur', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(763, 7, 'Perambalur', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(764, 4, 'Manvi', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(765, 30, 'Zunheboto', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(766, 11, 'Mahnar Bazar', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(767, 22, 'Attingal', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(768, 15, 'Shahbad', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(769, 10, 'Puranpur', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(770, 4, 'Nelamangala', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(771, 14, 'Nakodar', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(772, 5, 'Lunawada', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(773, 8, 'Murshidabad', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(774, 24, 'Mahe', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(775, 19, 'Lanka', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(776, 10, 'Rudauli', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(777, 30, 'Tuensang', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(778, 4, 'Lakshmeshwar', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(779, 14, 'Zira', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(780, 2, 'Yawal', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(781, 10, 'Thana Bhawan', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(782, 4, 'Ramdurg', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(783, 2, 'Pulgaon', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(784, 6, 'Sadasivpet', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(785, 4, 'Nargund', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(786, 9, 'Neem-Ka-Thana', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(787, 8, 'Memari', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(788, 2, 'Nilanga', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(789, 33, 'Naharlagun', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(790, 17, 'Pakaur', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(791, 2, 'Wai', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(792, 4, 'Tarikere', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(793, 4, 'Malavalli', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(794, 12, 'Raisen', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(795, 12, 'Lahar', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(796, 13, 'Uravakonda', '2018-03-23 11:53:40', '2018-03-23 11:53:40'),
(797, 4, 'Savanur', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(798, 9, 'Sirohi', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(799, 16, 'Udhampur', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(800, 2, 'Umarga', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(801, 9, 'Pratapgarh', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(802, 4, 'Lingsugur', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(803, 7, 'Usilampatti', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(804, 10, 'Palia Kalan', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(805, 30, 'Wokha', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(806, 5, 'Rajpipla', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(807, 4, 'Vijayapura', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(808, 9, 'Rawatbhata', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(809, 9, 'Sangaria', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(810, 2, 'Paithan', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(811, 2, 'Rahuri', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(812, 14, 'Patti', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(813, 10, 'Zaidpur', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(814, 9, 'Lalsot', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(815, 12, 'Maihar', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(816, 7, 'Vedaranyam', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(817, 2, 'Nawapur', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(818, 29, 'Solan', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(819, 5, 'Vapi', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(820, 12, 'Sanawad', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(821, 11, 'Warisaliganj', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(822, 11, 'Revelganj', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(823, 12, 'Sabalgarh', '2018-03-23 11:53:41', '2018-03-23 11:53:41'),
(824, 2, 'Tuljapur', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(825, 17, 'Simdega', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(826, 17, 'Musabani', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(827, 22, 'Kodungallur', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(828, 21, 'Phulabani', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(829, 5, 'Umreth', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(830, 13, 'Narsipatnam', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(831, 10, 'Nautanwa', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(832, 11, 'Rajgir', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(833, 6, 'Yellandu', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(834, 7, 'Sathyamangalam', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(835, 9, 'Pilibanga', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(836, 2, 'Morshi', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(837, 15, 'Pehowa', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(838, 11, 'Sonepur', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(839, 22, 'Pappinisseri', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(840, 10, 'Zamania', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(841, 17, 'Mihijam', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(842, 2, 'Purna', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(843, 7, 'Puliyankudi', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(844, 10, 'Shikarpur, Bulandshahr', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(845, 12, 'Umaria', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(846, 12, 'Porsa', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(847, 10, 'Naugawan Sadat', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(848, 10, 'Fatehpur Sikri', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(849, 6, 'Manuguru', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(850, 25, 'Udaipur', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(851, 9, 'Pipar City', '2018-03-23 11:53:42', '2018-03-23 11:53:42'),
(852, 21, 'Pattamundai', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(853, 7, 'Nanjikottai', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(854, 9, 'Taranagar', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(855, 13, 'Yerraguntla', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(856, 2, 'Satana', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(857, 11, 'Sherghati', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(858, 4, 'Sankeshwara', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(859, 4, 'Madikeri', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(860, 7, 'Thuraiyur', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(861, 5, 'Sanand', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(862, 5, 'Rajula', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(863, 6, 'Kyathampalle', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(864, 10, 'Shahabad, Rampur', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(865, 18, 'Tilda Newra', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(866, 12, 'Narsinghgarh', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(867, 22, 'Chittur-Thathamangalam', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(868, 12, 'Malaj Khand', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(869, 12, 'Sarangpur', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(870, 10, 'Robertsganj', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(871, 7, 'Sirkali', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(872, 5, 'Radhanpur', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(873, 7, 'Tiruchendur', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(874, 10, 'Utraula', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(875, 17, 'Patratu', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(876, 9, 'Vijainagar, Ajmer', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(877, 7, 'Periyasemur', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(878, 2, 'Pathri', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(879, 10, 'Sadabad', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(880, 4, 'Talikota', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(881, 2, 'Sinnar', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(882, 18, 'Mungeli', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(883, 4, 'Sedam', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(884, 4, 'Shikaripur', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(885, 9, 'Sumerpur', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(886, 7, 'Sattur', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(887, 11, 'Sugauli', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(888, 19, 'Lumding', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(889, 7, 'Vandavasi', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(890, 21, 'Titlagarh', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(891, 2, 'Uchgaon', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(892, 30, 'Mokokchung', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(893, 8, 'Paschim Punropara', '2018-03-23 11:53:43', '2018-03-23 11:53:43'),
(894, 9, 'Sagwara', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(895, 9, 'Ramganj Mandi', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(896, 8, 'Tarakeswar', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(897, 4, 'Mahalingapura', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(898, 25, 'Dharmanagar', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(899, 5, 'Mahemdabad', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(900, 18, 'Manendragarh', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(901, 2, 'Uran', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(902, 7, 'Tharamangalam', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(903, 7, 'Tirukkoyilur', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(904, 2, 'Pen', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(905, 11, 'Makhdumpur', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(906, 11, 'Maner', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(907, 7, 'Oddanchatram', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(908, 7, 'Palladam', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(909, 12, 'Mundi', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(910, 21, 'Nabarangapur', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(911, 4, 'Mudalagi', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(912, 15, 'Samalkha', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(913, 12, 'Nepanagar', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(914, 2, 'Karjat', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(915, 5, 'Ranavav', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(916, 13, 'Pedana', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(917, 15, 'Pinjore', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(918, 9, 'Lakheri', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(919, 12, 'Pasan', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(920, 13, 'Puttur', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(921, 7, 'Vadakkuvalliyur', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(922, 7, 'Tirukalukundram', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(923, 12, 'Mahidpur', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(924, 23, 'Mussoorie', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(925, 22, 'Muvattupuzha', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(926, 10, 'Rasra', '2018-03-23 11:53:44', '2018-03-23 11:53:44'),
(927, 9, 'Udaipurwati', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(928, 2, 'Manwath', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(929, 22, 'Adoor', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(930, 7, 'Uthamapalayam', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(931, 2, 'Partur', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(932, 29, 'Nahan', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(933, 15, 'Ladwa', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(934, 19, 'Mankachar', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(935, 27, 'Nongstoin', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(936, 9, 'Losal', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(937, 9, 'Sri Madhopur', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(938, 9, 'Ramngarh', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(939, 22, 'Mavelikkara', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(940, 9, 'Rawatsar', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(941, 9, 'Rajakhera', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(942, 10, 'Lar', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(943, 10, 'Lal Gopalganj Nindaura', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(944, 4, 'Muddebihal', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(945, 10, 'Sirsaganj', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(946, 9, 'Shahpura', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(947, 7, 'Surandai', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(948, 2, 'Sangole', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(949, 4, 'Pavagada', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(950, 5, 'Tharad', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(951, 5, 'Mansa', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(952, 5, 'Umbergaon', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(953, 22, 'Mavoor', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(954, 19, 'Nalbari', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(955, 5, 'Talaja', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(956, 4, 'Malur', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(957, 2, 'Mangrulpir', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(958, 21, 'Soro', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(959, 9, 'Shahpura', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(960, 5, 'Vadnagar', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(961, 9, 'Raisinghnagar', '2018-03-23 11:53:45', '2018-03-23 11:53:45'),
(962, 4, 'Sindhagi', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(963, 4, 'Sanduru', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(964, 15, 'Sohna', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(965, 5, 'Manavadar', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(966, 10, 'Pihani', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(967, 15, 'Safidon', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(968, 2, 'Risod', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(969, 11, 'Rosera', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(970, 7, 'Sankari', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(971, 9, 'Malpura', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(972, 8, 'Sonamukhi', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(973, 10, 'Shamsabad, Agra', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(974, 11, 'Nokha', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(975, 8, 'PandUrban Agglomeration', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(976, 8, 'Mainaguri', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(977, 4, 'Afzalpur', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(978, 2, 'Shirur', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(979, 5, 'Salaya', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(980, 7, 'Shenkottai', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(981, 25, 'Pratapgarh', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(982, 7, 'Vadipatti', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(983, 6, 'Nagarkurnool', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(984, 2, 'Savner', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(985, 2, 'Sasvad', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(986, 10, 'Rudrapur', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(987, 10, 'Soron', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(988, 7, 'Sholingur', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(989, 2, 'Pandharkaoda', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(990, 22, 'Perumbavoor', '2018-03-23 11:53:46', '2018-03-23 11:53:46'),
(991, 4, 'Maddur', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(992, 9, 'Nadbai', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(993, 2, 'Talode', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(994, 2, 'Shrigonda', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(995, 4, 'Madhugiri', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(996, 4, 'Tekkalakote', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(997, 12, 'Seoni-Malwa', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(998, 2, 'Shirdi', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(999, 10, 'SUrban Agglomerationr', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1000, 4, 'Terdal', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1001, 2, 'Raver', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1002, 7, 'Tirupathur', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1003, 15, 'Taraori', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1004, 2, 'Mukhed', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1005, 7, 'Manachanallur', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1006, 12, 'Rehli', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1007, 9, 'Sanchore', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1008, 2, 'Rajura', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1009, 11, 'Piro', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1010, 4, 'Mudabidri', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1011, 2, 'Vadgaon Kasba', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1012, 9, 'Nagar', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1013, 5, 'Vijapur', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1014, 7, 'Viswanatham', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1015, 7, 'Polur', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1016, 7, 'Panagudi', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1017, 12, 'Manawar', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1018, 23, 'Tehri', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1019, 10, 'Samdhan', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1020, 5, 'Pardi', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1021, 12, 'Rahatgarh', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1022, 12, 'Panagar', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1023, 7, 'Uthiramerur', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1024, 2, 'Tirora', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1025, 19, 'Rangia', '2018-03-23 11:53:47', '2018-03-23 11:53:47'),
(1026, 10, 'Sahjanwa', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1027, 12, 'Wara Seoni', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1028, 4, 'Magadi', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1029, 9, 'Rajgarh (Alwar]', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1030, 11, 'Rafiganj', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1031, 12, 'Tarana', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1032, 10, 'Rampur Maniharan', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1033, 9, 'Sheoganj', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1034, 14, 'Raikot', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1035, 23, 'Pauri', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1036, 10, 'Sumerpur', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1037, 4, 'Navalgund', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1038, 10, 'Shahganj', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1039, 11, 'Marhaura', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1040, 10, 'Tulsipur', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1041, 9, 'Sadri', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1042, 7, 'Thiruthuraipoondi', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1043, 4, 'Shiggaon', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1044, 7, 'Pallapatti', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1045, 15, 'Mahendragarh', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1046, 12, 'Sausar', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1047, 7, 'Ponneri', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1048, 2, 'Mahad', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1049, 17, 'Lohardaga', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1050, 10, 'Tirwaganj', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1051, 19, 'Margherita', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1052, 29, 'Sundarnagar', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1053, 12, 'Rajgarh', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1054, 19, 'Mangaldoi', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1055, 13, 'Renigunta', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1056, 14, 'Longowal', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1057, 15, 'Ratia', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1058, 7, 'Lalgudi', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1059, 4, 'Shrirangapattana', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1060, 12, 'Niwari', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1061, 7, 'Natham', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1062, 7, 'Unnamalaikadai', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1063, 10, 'PurqUrban Agglomerationzi', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1064, 10, 'Shamsabad, Farrukhabad', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1065, 11, 'Mirganj', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1066, 9, 'Todaraisingh', '2018-03-23 11:53:48', '2018-03-23 11:53:48'),
(1067, 10, 'Warhapur', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1068, 13, 'Rajam', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1069, 14, 'Urmar Tanda', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1070, 2, 'Lonar', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1071, 10, 'Powayan', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1072, 7, 'P.N.Patti', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1073, 29, 'Palampur', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1074, 13, 'Srisailam Project (Right Flank Colony] Township', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1075, 4, 'Sindagi', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1076, 10, 'Sandi', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1077, 22, 'Vaikom', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1078, 8, 'Malda', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1079, 7, 'Tharangambadi', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1080, 4, 'Sakaleshapura', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1081, 11, 'Lalganj', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1082, 21, 'Malkangiri', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1083, 5, 'Rapar', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1084, 12, 'Mauganj', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1085, 9, 'Todabhim', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1086, 4, 'Srinivaspur', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1087, 11, 'Murliganj', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1088, 9, 'Reengus', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1089, 2, 'Sawantwadi', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1090, 7, 'Tittakudi', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1091, 28, 'Lilong', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1092, 9, 'Rajaldesar', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1093, 2, 'Pathardi', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1094, 10, 'Achhnera', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1095, 7, 'Pacode', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1096, 10, 'Naraura', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1097, 10, 'Nakur', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1098, 22, 'Palai', '2018-03-23 11:53:49', '2018-03-23 11:53:49'),
(1099, 14, 'Morinda, India', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1100, 12, 'Manasa', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1101, 12, 'Nainpur', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1102, 10, 'Sahaspur', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1103, 2, 'Pauni', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1104, 12, 'Prithvipur', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1105, 2, 'Ramtek', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1106, 19, 'Silapathar', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1107, 5, 'Songadh', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1108, 10, 'Safipur', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1109, 12, 'Sohagpur', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1110, 2, 'Mul', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1111, 9, 'Sadulshahar', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1112, 14, 'Phillaur', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1113, 9, 'Sambhar', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1114, 9, 'Prantij', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1115, 23, 'Nagla', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1116, 14, 'Pattran', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1117, 9, 'Mount Abu', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1118, 10, 'Reoti', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1119, 17, 'Tenu dam-cum-Kathhara', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1120, 8, 'Panchla', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1121, 23, 'Sitarganj', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1122, 33, 'Pasighat', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1123, 11, 'Motipur', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1124, 7, 'O\' Valley', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1125, 8, 'Raghunathpur', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1126, 7, 'Suriyampalayam', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1127, 14, 'Qadian', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1128, 21, 'Rairangpur', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1129, 34, 'Silvassa', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1130, 12, 'Nowrozabad (Khodargama]', '2018-03-23 11:53:50', '2018-03-23 11:53:50'),
(1131, 9, 'Mangrol', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1132, 2, 'Soyagaon', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1133, 14, 'Sujanpur', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1134, 11, 'Manihari', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1135, 10, 'Sikanderpur', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1136, 2, 'Mangalvedhe', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1137, 9, 'Phulera', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1138, 4, 'Ron', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1139, 7, 'Sholavandan', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1140, 10, 'Saidpur', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1141, 12, 'Shamgarh', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1142, 7, 'Thammampatti', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1143, 12, 'Maharajpur', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1144, 12, 'Multai', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1145, 14, 'Mukerian', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1146, 10, 'Sirsi', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1147, 10, 'Purwa', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1148, 11, 'Sheohar', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1149, 7, 'Namagiripettai', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1150, 10, 'Parasi', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1151, 5, 'Lathi', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1152, 10, 'Lalganj', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1153, 2, 'Narkhed', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1154, 8, 'Mathabhanga', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1155, 2, 'Shendurjana', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1156, 7, 'Peravurani', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1157, 19, 'Mariani', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1158, 10, 'Phulpur', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1159, 15, 'Rania', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1160, 12, 'Pali', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1161, 12, 'Pachore', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1162, 7, 'Parangipettai', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1163, 7, 'Pudupattinam', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1164, 22, 'Panniyannur', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1165, 11, 'Maharajganj', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1166, 12, 'Rau', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1167, 8, 'Monoharpur', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1168, 9, 'Mandawa', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1169, 19, 'Marigaon', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1170, 7, 'Pallikonda', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1171, 9, 'Pindwara', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1172, 10, 'Shishgarh', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1173, 2, 'Patur', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1174, 28, 'Mayang Imphal', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1175, 12, 'Mhowgaon', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1176, 22, 'Guruvayoor', '2018-03-23 11:53:51', '2018-03-23 11:53:51'),
(1177, 2, 'Mhaswad', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1178, 10, 'Sahawar', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1179, 7, 'Sivagiri', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1180, 4, 'Mundargi', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1181, 7, 'Punjaipugalur', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1182, 25, 'Kailasahar', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1183, 10, 'Samthar', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1184, 18, 'Sakti', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1185, 4, 'Sadalagi', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1186, 11, 'Silao', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1187, 9, 'Mandalgarh', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1188, 2, 'Loha', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1189, 10, 'Pukhrayan', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1190, 7, 'Padmanabhapuram', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1191, 25, 'Belonia', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1192, 26, 'Saiha', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1193, 8, 'Srirampore', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1194, 14, 'Talwara', '2018-03-23 11:53:52', '2018-03-23 11:53:52'),
(1195, 22, 'Puthuppally', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1196, 25, 'Khowai', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1197, 12, 'Vijaypur', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1198, 9, 'Takhatgarh', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1199, 7, 'Thirupuvanam', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1200, 8, 'Adra', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1201, 4, 'Piriyapatna', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1202, 10, 'Obra', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1203, 5, 'Adalaj', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1204, 2, 'Nandgaon', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1205, 11, 'Barh', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1206, 5, 'Chhapra', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1207, 22, 'Panamattom', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1208, 10, 'Niwai', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1209, 23, 'Bageshwar', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1210, 21, 'Tarbha', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1211, 4, 'Adyar', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1212, 12, 'Narsinghgarh', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1213, 2, 'Warud', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1214, 11, 'Asarganj', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1215, 15, 'Sarsod', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1216, 5, 'Gandhinagar', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1217, 29, 'Kullu', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1219, 10, 'Mirzapur', '2018-03-23 11:53:53', '2018-03-23 11:53:53'),
(1220, 5, 'Junagadh', '2018-04-16 20:00:00', '2018-04-16 20:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `colors_images`
--

CREATE TABLE `colors_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image5` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `colors_images`
--

INSERT INTO `colors_images` (`id`, `attribute_id`, `product_id`, `image1`, `image2`, `image3`, `image4`, `image5`, `created_at`, `updated_at`) VALUES
(1, 1662, 158, 'color1_1535627407.png', 'color2_1535627407.jpg', 'color3_1535627407.jpg', 'color4_1535627407.png', 'color5_1535627408.png', '2018-08-30 11:10:08', '2018-08-30 11:10:08'),
(2, 1666, 159, 'color1_1535627823.jpg', 'color2_1535627823.jpg', 'color3_1535627824.jpg', 'color_1535630966.jpg', '', '2018-08-30 11:17:04', '2018-08-30 12:09:26'),
(3, 1667, 159, 'color1_1535631133.jpg', 'color2_1535631133.jpg', '', 'color4_1535631133.png', 'color5_1535631133.jpg', '2018-08-30 12:12:13', '2018-08-30 12:12:30'),
(4, 1677, 159, 'color1_1535632263.jpg', 'color2_1535632263.jpg', '', '', '', '2018-08-30 12:31:03', '2018-08-30 12:31:03'),
(5, 1684, 160, 'color1_1535712681.jpg', 'color2_1535712681.jpg', 'color3_1535712681.jpg', 'color4_1535712681.jpg', 'color5_1535712682.jpg', '2018-08-31 10:51:22', '2018-08-31 10:51:22'),
(6, 1685, 160, 'color1_1535712682.jpg', 'color2_1535712682.jpg', 'color3_1535712682.jpg', 'color4_1535712682.jpg', 'color5_1535712682.jpg', '2018-08-31 10:51:22', '2018-08-31 10:51:22'),
(7, 1707, 160, 'color1_1535714065.jpg', 'color2_1535714065.jpg', 'color3_1535714065.jpg', 'color4_1535714066.jpg', 'color_1535721922.jpg', '2018-08-31 11:14:26', '2018-08-31 13:25:23'),
(10, 1827, 162, 'color1_1536130986.jpg', 'color2_1536130986.jpg', 'color3_1536130986.jpg', '', '', '2018-09-05 07:03:06', '2018-09-05 07:03:06'),
(11, 1828, 162, '', '', '', '', '', '2018-09-05 07:03:07', '2018-09-05 07:03:07'),
(12, 1829, 162, 'color1_1536130987.jpg', 'color2_1536130987.jpg', '', '', '', '2018-09-05 07:03:07', '2018-09-05 07:03:07'),
(13, 1830, 162, 'color1_1536130987.jpg', '', '', '', '', '2018-09-05 07:03:07', '2018-09-05 07:03:07'),
(14, 1831, 162, '', '', '', '', '', '2018-09-05 07:03:07', '2018-09-05 07:03:07'),
(15, 1833, 164, 'color1_1536152509.jpg', 'color2_1536152509.png', 'color3_1536152509.png', 'color4_1536152509.jpg', 'color5_1536152509.jpg', '2018-09-05 13:01:49', '2018-09-05 13:01:49'),
(16, 1834, 164, 'color1_1536152509.jpg', 'color2_1536152510.jpg', 'color3_1536152510.jpg', 'color4_1536152510.jpg', 'color5_1536152510.jpg', '2018-09-05 13:01:50', '2018-09-05 13:01:50'),
(17, 1837, 165, 'color1_1536155405.jpg', 'color2_1536155405.jpg', 'color3_1536155406.jpg', '', 'color5_1536155406.jpg', '2018-09-05 13:50:06', '2018-09-05 13:50:06'),
(18, 1838, 165, 'color1_1536155406.jpg', 'color2_1536155406.jpg', 'color3_1536155407.jpg', '', '', '2018-09-05 13:50:07', '2018-09-05 13:50:07'),
(19, 1839, 165, '', '', '', '', '', '2018-09-05 13:50:07', '2018-09-05 13:50:07'),
(20, 1840, 165, 'color1_1536155407.jpg', 'color2_1536155407.jpg', 'color3_1536155407.jpg', 'color4_1536155408.jpg', 'color5_1536155408.jpg', '2018-09-05 13:50:08', '2018-09-05 13:50:08'),
(21, 1841, 165, '', '', '', '', '', '2018-09-05 13:50:08', '2018-09-05 13:50:08'),
(22, 1844, 166, 'color1_1536217038.jpg', '', '', '', '', '2018-09-06 08:27:19', '2018-09-06 08:27:19'),
(23, 1845, 166, 'color1_1536217039.jpg', '', '', '', '', '2018-09-06 08:27:19', '2018-09-06 08:27:19'),
(24, 1846, 166, 'color1_1536217039.jpg', '', '', '', '', '2018-09-06 08:27:19', '2018-09-06 08:27:19'),
(25, 1847, 166, 'color1_1536217039.jpg', '', '', '', '', '2018-09-06 08:27:19', '2018-09-06 08:27:19'),
(26, 1848, 166, 'color1_1536217039.jpg', '', '', '', '', '2018-09-06 08:27:20', '2018-09-06 08:27:20'),
(27, 1849, 166, 'color1_1536217040.jpg', '', '', '', '', '2018-09-06 08:27:20', '2018-09-06 08:27:20');

-- --------------------------------------------------------

--
-- Structure de la table `compare`
--

CREATE TABLE `compare` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `compare_temp_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compare`
--

INSERT INTO `compare` (`id`, `user_id`, `product_id`, `compare_temp_id`, `created_at`, `updated_at`) VALUES
(36, NULL, 22, '5ab63d1eb31fc', '2018-03-24 14:27:36', '2018-03-24 14:27:36'),
(24, 16, 20, '', '2018-03-17 10:25:00', '2018-03-17 10:32:06'),
(42, NULL, 21, '5ab88cc7b5560', '2018-03-26 08:41:42', '2018-03-26 08:41:42'),
(43, 15, 35, NULL, '2018-05-10 16:11:50', '2018-05-10 16:11:50'),
(47, 15, 29, NULL, '2018-05-10 16:39:24', '2018-05-10 16:39:24'),
(48, 15, 30, NULL, '2018-05-10 16:40:03', '2018-05-10 16:40:03'),
(49, 60, 140, NULL, '2018-10-08 15:53:28', '2018-10-08 15:53:28');

-- --------------------------------------------------------

--
-- Structure de la table `csr_page`
--

CREATE TABLE `csr_page` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `csr_page`
--

INSERT INTO `csr_page` (`id`, `desc`, `video`, `created_at`, `updated_at`) VALUES
(1, '<h1>My Gifti.com</h1>\r\n<p>India Best B2B website in India.</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>', 'https://www.youtube.com/watch?v=D984gI908iI', '2018-07-17 16:07:18', '2018-07-17 16:07:18');

-- --------------------------------------------------------

--
-- Structure de la table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `default` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `value`, `status`, `slug`, `created_at`, `updated_at`, `default`) VALUES
(2, 'Indian rupee', 'INR', 10, 1, 'indian-rupee', '2018-02-26 09:43:17', '2018-10-19 21:12:56', 0),
(3, 'Doller', 'USD', 66, 1, 'doller', '2018-02-26 09:43:49', '2018-03-27 18:37:08', 0);

-- --------------------------------------------------------

--
-- Structure de la table `delivery_info`
--

CREATE TABLE `delivery_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `delivery_info`
--

INSERT INTO `delivery_info` (`id`, `desc`, `image`, `created_at`, `updated_at`) VALUES
(1, '<h2><strong><u>Shipping Policy :<br /><br /></u></strong></h2>\r\n<ul>\r\n<li><strong>What are the delivery charges?</strong></li>\r\n</ul>\r\n<p>Delivery charge varies with each Seller.</p>\r\n<p>Sellers incur relatively higher shipping costs on low-value items. In such cases, charging a nominal delivery charge helps them offset logistics costs. Please check your order summary to understand the delivery charges for individual products.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li><strong>Order Tracking:</strong></li>\r\n</ul>\r\n<p>If a tracking # is provided by the shipping carrier, we will update your order with the tracking information. Please note that some orders using 1st Class USPS mail will not have tracking numbers.&nbsp;</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<ul>\r\n<li><strong>Shipping Rates:</strong></li>\r\n</ul>\r\n<p>The rate charged for the shipping of your order is based on the weight of your products, and your location. Before the final checkout page you will be shown what the cost of shipping will be, and you will have a chance to not place your order if you decide not to.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<ul>\r\n<li><strong>Back Orders:</strong></li>\r\n</ul>\r\n<p>If an item goes on back order we will ship you the part of your order that is in stock. When the item becomes available we will ship you the rest of your order. You will not be charged any additional shipping and handling for the second shipment.</p>', 'faq_1524031114.jpg', '2018-04-18 07:28:34', '2018-05-01 06:50:09');

-- --------------------------------------------------------

--
-- Structure de la table `employee_permission`
--

CREATE TABLE `employee_permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employee_permission`
--

INSERT INTO `employee_permission` (`id`, `permission_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 1, 54, '2018-04-28 14:01:44', '2018-04-28 14:01:44'),
(5, 1, 55, '2018-04-28 14:01:52', '2018-04-28 14:01:52'),
(6, 4, 54, '2018-04-28 14:04:07', '2018-04-28 14:04:07');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id`, `desc`, `image`, `created_at`, `updated_at`) VALUES
(1, '<div>\r\n<h2 style=\"text-align: left;\">What is Lorem Ipsum?</h2>\r\n<p style=\"text-align: left;\"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2 style=\"text-align: left;\">Why do we use it?</h2>\r\n<p style=\"text-align: left;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>', 'faq_1524031098.jpg', '2018-04-18 07:28:18', '2018-04-18 07:28:18');

-- --------------------------------------------------------

--
-- Structure de la table `fee_deduction`
--

CREATE TABLE `fee_deduction` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `deduction_charge` double NOT NULL,
  `deduction_type` enum('flat','percentage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fee_deduction`
--

INSERT INTO `fee_deduction` (`id`, `category_id`, `deduction_charge`, `deduction_type`, `created_at`, `updated_at`) VALUES
(9, 3, 10, 'percentage', '2018-08-01 10:27:01', '2018-08-09 11:00:06'),
(10, 5, 10, 'percentage', '2018-08-01 10:27:01', '2018-08-09 11:31:40'),
(11, 14, 100, 'flat', '2018-08-09 09:40:28', '2018-08-09 11:07:55'),
(12, 19, 100, 'flat', '2018-08-09 09:46:07', '2018-08-09 09:49:21'),
(13, 39, 10, 'percentage', '2018-08-09 09:58:54', '2018-08-09 09:58:54'),
(14, 40, 100, 'flat', '2018-08-09 10:06:30', '2018-08-09 10:06:30'),
(15, 41, 100, 'percentage', '2018-08-09 10:13:07', '2018-08-09 10:13:07'),
(16, 42, 100, 'flat', '2018-08-09 10:15:59', '2018-08-09 10:15:59'),
(17, 43, 100, 'flat', '2018-08-09 10:18:03', '2018-08-09 10:18:03'),
(18, 44, 100, 'flat', '2018-08-09 10:20:22', '2018-08-09 10:20:22'),
(20, 45, 100, 'flat', '2018-08-09 10:29:04', '2018-08-09 10:29:04'),
(21, 46, 100, 'flat', '2018-08-09 10:30:21', '2018-08-09 10:30:21'),
(22, 47, 100, 'flat', '2018-08-09 10:31:48', '2018-08-09 10:31:48'),
(24, 49, 1000, 'flat', '2018-08-09 10:35:13', '2018-08-09 10:35:13'),
(31, 4, 15, 'flat', '2018-08-09 11:01:53', '2018-08-10 04:44:07'),
(32, 15, 100, 'flat', '2018-08-09 11:09:13', '2018-08-09 11:09:13'),
(33, 16, 100, 'flat', '2018-08-09 11:11:32', '2018-08-10 04:40:29'),
(34, 24, 100, 'flat', '2018-08-09 11:14:17', '2018-08-09 11:14:17'),
(35, 17, 100, 'flat', '2018-08-09 11:15:47', '2018-08-15 09:08:36'),
(36, 18, 100, 'flat', '2018-08-09 11:17:47', '2018-08-09 11:32:30'),
(37, 20, 10, 'percentage', '2018-08-09 11:20:53', '2018-08-09 11:20:53'),
(38, 21, 10, 'percentage', '2018-08-09 11:22:45', '2018-08-09 11:22:45'),
(39, 22, 10, 'flat', '2018-08-09 11:24:08', '2018-08-09 11:24:08'),
(40, 50, 10, 'percentage', '2018-10-19 21:26:22', '2018-10-19 21:27:00');

-- --------------------------------------------------------

--
-- Structure de la table `homepage_contain`
--

CREATE TABLE `homepage_contain` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc1` longtext COLLATE utf8mb4_unicode_ci,
  `desc2` longtext COLLATE utf8mb4_unicode_ci,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `homepage_contain`
--

INSERT INTO `homepage_contain` (`id`, `desc1`, `desc2`, `video`, `created_at`, `updated_at`) VALUES
(3, '<h3><em><strong>Online ABC Store In India</strong></em></h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent</p>', '<h1>MyGifti.com</h1>\r\n<p>India Best B2B Web Site In India.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>', 'http://productdemo.info/gift/public/front/gifti/images/mov_bbb.mp4', '2018-07-17 10:44:32', '2018-07-17 10:44:32'),
(4, '<h3><em><strong>Online ABC Store In India</strong></em></h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent</p>', '<h1>MyGifti.com</h1>\r\n<p>India Best B2B Web Site In India.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>', 'https://www.youtube.com/watch?v=D984gI908iI', '2018-07-17 10:45:52', '2018-07-17 10:45:52'),
(2, '<h3><em><strong>Online ABC Store In India</strong></em></h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent</p>', '<h1>MyGifti.com</h1>\r\n<p>India Best B2B Web Site In India.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>', 'http://productdemo.info/gift/public/front/gifti/images/mov_bbb.mp4', '2018-07-17 10:31:01', '2018-07-17 10:31:01'),
(5, '<h3><em><strong>Online ABC Store In India</strong></em></h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent</p>', '<h1>MyGifti.com</h1>\r\n<p>India Best B2B Web Site In India.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor pulvinar mi in pellentesque. In et faucibus nisi. Vivamus nec bibendum eros. Ut in augue ac leo facilisis lobortis. Cras sit amet pulvinar massa. Donec sed tempus velit. Praesent dignissim iaculis pretium</p>', 'https://www.youtube.com/embed/D984gI908iI', '2018-07-17 10:49:35', '2018-07-17 10:49:35');

-- --------------------------------------------------------

--
-- Structure de la table `homepage_slider`
--

CREATE TABLE `homepage_slider` (
  `id` int(10) UNSIGNED NOT NULL,
  `main_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `small_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medium_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_arrival_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_seller_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seller_horizontal_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_product_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommend_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `homepage_slider`
--

INSERT INTO `homepage_slider` (`id`, `main_slider`, `small_slider`, `medium_slider`, `new_arrival_slider`, `top_seller_slider`, `seller_horizontal_slider`, `special_product_slider`, `recommend_slider`, `footer_slider`, `url`, `created_at`, `updated_at`) VALUES
(35, 'uaNG71532183490.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 20:01:30', '2018-07-21 20:01:30'),
(41, 'pIM3v1532185805.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 20:40:05', '2018-07-21 20:40:05'),
(33, NULL, '4KuIJ1532183444.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 20:00:44', '2018-07-21 20:00:44'),
(5, NULL, NULL, NULL, 'IFNRO1523536305.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-12 14:01:45', '2018-04-12 14:01:45'),
(6, NULL, NULL, NULL, 'Znl081523536314.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-12 14:01:54', '2018-04-12 14:01:54'),
(7, NULL, NULL, NULL, NULL, 'W1vTq1523536376.jpg', NULL, NULL, NULL, NULL, NULL, '2018-04-12 14:02:56', '2018-04-12 14:02:56'),
(8, NULL, NULL, NULL, NULL, 'wzcD91523536387.jpg', NULL, NULL, NULL, NULL, NULL, '2018-04-12 14:03:07', '2018-04-12 14:03:07'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, 'QVkLK1523536406.jpg', NULL, NULL, NULL, '2018-04-12 14:03:26', '2018-04-12 14:03:26'),
(10, NULL, NULL, NULL, NULL, NULL, NULL, 'LG9vN1523536442.jpg', NULL, NULL, NULL, '2018-04-12 14:04:02', '2018-04-12 14:04:02'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mrblu1523536474.jpg', NULL, NULL, '2018-04-12 14:04:34', '2018-04-12 14:04:34'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xbcZ81523536491.jpg', NULL, NULL, '2018-04-12 14:04:51', '2018-04-12 14:04:51'),
(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '247iQ1523941307.jpg', NULL, '2018-04-17 06:31:47', '2018-04-17 06:31:47'),
(14, NULL, NULL, 'bnCDv1523940776.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-17 06:22:56', '2018-04-17 06:22:56'),
(15, NULL, NULL, 'XKcI11523940792.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-17 06:23:12', '2018-04-17 06:23:12'),
(16, NULL, 'EE1za1523940849.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-17 06:24:09', '2018-04-17 06:24:09'),
(17, NULL, 'xaefm1523940855.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-17 06:24:15', '2018-04-17 06:24:15'),
(18, NULL, NULL, NULL, NULL, NULL, 'Wv3CS1523941183.jpg', NULL, NULL, NULL, NULL, '2018-04-17 06:29:43', '2018-04-17 06:29:43'),
(19, NULL, NULL, NULL, NULL, NULL, 'GyqVV1523941195.jpg', NULL, NULL, NULL, NULL, '2018-04-17 06:29:55', '2018-04-17 06:29:55'),
(32, 'IgtTE1526620608.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '#', '2018-05-18 06:46:48', '2018-05-18 06:46:48'),
(42, 'FUwrE1532186131.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 20:45:31', '2018-07-21 20:45:31'),
(44, 'zjTTL1532269037.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-22 19:47:17', '2018-07-22 19:47:17'),
(34, 'MLLok1531042887.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-08 15:11:27', '2018-07-08 15:11:27');

-- --------------------------------------------------------

--
-- Structure de la table `kyc_documents`
--

CREATE TABLE `kyc_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kyc_doc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_doc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `kyc_documents`
--

INSERT INTO `kyc_documents` (`id`, `user_id`, `kyc_doc`, `other_doc`, `created_at`, `updated_at`) VALUES
(5, 59, '1530601291831557185b3b1f4bc7b5a.jpg', NULL, '2018-07-03 08:31:31', '2018-07-03 08:31:31'),
(6, 59, NULL, '55b3b1f4bc7f92.jpg', '2018-07-03 08:31:31', '2018-07-03 08:31:31');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_21_132415_entrust_setup_tables', 1),
(4, '2018_02_21_132542_create_user_addresses_table', 1),
(5, '2018_02_21_132904_create_kyc_documents_table', 1),
(6, '2018_02_21_132948_create_kyc_details_table', 1),
(7, '2018_02_21_145918_create_services_table', 1),
(8, '2018_02_21_145919_create_operators_table', 1),
(9, '2018_02_21_150033_create_transaction_table', 1),
(10, '2018_02_22_115430_create_add_slug_to_permission_table', 1),
(11, '2018_02_23_154058_create_recharge_history_table', 1),
(12, '2018_02_24_111018_create_add_users_table', 2),
(13, '2017_05_20_092912_create_categories_table', 3),
(14, '2017_05_20_093037_create_subcategories_table', 3),
(15, '2018_02_26_105700_create_categories_table', 4),
(16, '2018_02_26_105816_create_subcategories_table', 4),
(17, '2018_02_26_113522_create_subcategories_table', 5),
(18, '2018_02_26_122521_create_tax_class_table', 6),
(19, '2018_02_26_144633_create_currencies_table', 7),
(20, '2018_02_26_150221_create_currencies_table', 8),
(21, '2018_02_26_152647_create_brands_table', 9),
(22, '2018_02_26_190245_create_products_table', 10),
(23, '2018_02_26_191112_create_product_discount_table', 10),
(24, '2018_02_26_191300_create_product_attributes_table', 10),
(25, '2018_02_26_191406_create_product_screenshots_table', 10),
(26, '2018_02_27_165911_create_cart_table', 11),
(27, '2018_03_06_184150_create_shipping_information_table', 12),
(28, '2018_03_06_191135_create_shipping_information_table', 13),
(29, '2018_03_08_154604_create_add_to_cart_table', 14),
(30, '2018_03_08_185620_create_add_to_products_table', 14),
(31, '2018_03_09_152638_create_wishlist_table', 15),
(32, '2018_03_09_175413_create_compare_table', 15),
(33, '2018_03_13_151825_create_order_table', 16),
(34, '2018_03_13_175325_create_add_sub_category_to_commission_table', 16),
(35, '2018_03_14_161651_create_product_review_table', 17),
(36, '2018_03_16_100512_create_add_to_order_table', 18),
(37, '2018_03_16_105922_create_add_price_to_cart_table', 18),
(38, '2018_03_16_161322_create_wallet_history_table', 18),
(39, '2018_03_16_191045_create_add_to_recharge_history_temp_table', 18),
(40, '2018_03_19_173127_create_circle_table', 18),
(41, '2018_03_19_191427_create_states_table', 18),
(42, '2018_03_21_102617_create_users_to_wallet_amount_change_table', 19),
(43, '2018_03_21_150603_create_update_operators_table', 19),
(44, '2018_03_22_112230_create_update_users_table', 20),
(45, '2018_03_22_125655_create_homepage_categories_table', 20),
(46, '2018_03_22_140112_create_homepage_products_table', 20),
(47, '2018_03_23_170326_create_cities_table', 20),
(48, '2018_03_26_120247_create_update_products_table', 21),
(49, '2018_03_26_151705_create_update_order_table', 21),
(50, '2018_03_26_171646_create_update_aadhar_users_table', 21),
(51, '2018_03_26_173444_create_employee_permission_table', 21),
(52, '2018_03_28_123030_create_drop_foreign_key_products_table', 22),
(53, '2018_03_29_160045_create_update_currency_table', 23),
(54, '2018_03_29_173210_create_update_category_table', 23),
(55, '2018_03_30_102458_crete_update_users_varificatin_table', 24),
(56, '2018_04_04_123452_create_update_order_shipping_table', 25),
(57, '2018_04_05_115223_create_update_order_table', 25),
(58, '2018_04_05_121641_create_shipping_history_table', 25),
(59, '2016_06_01_000001_create_oauth_auth_codes_table', 26),
(60, '2016_06_01_000002_create_oauth_access_tokens_table', 26),
(61, '2016_06_01_000003_create_oauth_refresh_tokens_table', 26),
(62, '2016_06_01_000004_create_oauth_clients_table', 26),
(63, '2016_06_01_000005_create_oauth_personal_access_clients_table', 26),
(64, '2018_04_06_120605_create_homepage_slider_table', 26),
(65, '2018_04_06_161920_create_update_categories_table', 26),
(66, '2018_04_06_173522_create_subcategory_slider_table', 26),
(67, '2018_04_09_154721_create_update_homepage_slider_table', 27),
(68, '2018_04_09_175539_create_update_users_is_verify_table', 27),
(69, '2018_04_16_173445_create_update_recharge_history_status_table', 28),
(70, '2018_04_17_145054_create_update_categories_other_image_table', 29),
(71, '2018_04_17_153105_create_about_us_table', 29),
(72, '2018_04_17_160317_create_privacy_policy_table', 29),
(73, '2018_04_17_162824_create_terms_condition_table', 29),
(74, '2018_04_17_165248_create_faq_table', 29),
(75, '2018_04_17_171601_create_delivery_info_table', 29),
(76, '2018_04_17_172837_create_cancellation_policy_table', 29),
(77, '2018_04_17_173556_create_seller_policy_table', 29),
(78, '2018_04_17_185115_create_testimonials_table', 29),
(79, '2018_04_18_145905_create_update_wallet_history_table', 30),
(80, '2018_04_23_162754_create_order_cancel_table', 31),
(81, '2018_04_23_172445_create_products_sliders_table', 31),
(82, '2018_04_23_183612_create_kyc_documents_table', 32),
(83, '2018_07_25_105245_create_fee_deduction_table', 33),
(84, '2018_07_25_112439_add_shipping_charge_to_products_table', 34),
(85, '2018_07_25_125704_create_payment_collection_table', 35),
(87, '2018_07_25_131351_create_payment_collection_table', 36),
(88, '2018_07_25_160454_create_subcategories2_table', 37),
(89, '2018_07_25_172031_update_foreignkey_of_products_table', 38),
(90, '2018_07_27_161018_update_brands_table', 39),
(91, '2018_07_27_161642_update_brands_with_userid_table', 40),
(92, '2018_07_27_185249_create_seller_holiday_table', 41),
(93, '2018_07_27_185856_create_update_seller_holiday_table', 42),
(94, '2018_07_31_103605_update_users_table', 43),
(95, '2018_07_31_151750_update_product_attributes_table', 44),
(96, '2018_08_01_121354_create_brands_documents_table', 45),
(97, '2018_08_01_122945_update_brands_table', 46),
(98, '2018_08_01_125237_update2_brands_table', 47),
(99, '2018_08_01_170338_update_users_table', 48),
(100, '2018_08_02_131904_update_orders_table', 49),
(101, '2018_08_02_150852_create_seller_payment_request_table', 49),
(102, '2018_08_02_152437_create_seller_payment_history_table', 50),
(103, '2018_08_02_172649_update_order_table', 51),
(104, '2018_08_03_125343_update_seller_payment_request_table', 52),
(105, '2018_08_03_125616_update_seller_payment_history_table', 53),
(106, '2018_08_09_111942_update_brands_table', 54),
(107, '2018_08_09_112947_update_brands_documents_table', 55),
(108, '2018_08_30_151016_create_color_images_table', 56),
(109, '2018_08_30_162237_create_colors_images_table', 57);

-- --------------------------------------------------------

--
-- Structure de la table `news_page`
--

CREATE TABLE `news_page` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `news_page`
--

INSERT INTO `news_page` (`id`, `desc`, `video`, `created_at`, `updated_at`) VALUES
(1, '<h1>My Gifti.com</h1>\r\n<p>India Best B2B website in India.</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>\r\n<p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>', 'https://youtu.be/D984gI908iI', '2018-07-17 15:55:14', '2018-07-17 15:55:14');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `operators`
--

CREATE TABLE `operators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `op_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `op_code1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `commission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_type` enum('flat','percentage') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `operators`
--

INSERT INTO `operators` (`id`, `name`, `op_code`, `op_code1`, `service_id`, `commission`, `commission_type`, `status`, `created_at`, `updated_at`) VALUES
(47, 'Aircel', 'AIR', 'AC', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(48, 'Airtel', 'A', 'AT', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(49, 'Airtel Digital DTH TV', 'ATV', '', 4, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(50, 'BIG TV', 'BTV', '', 4, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(51, 'BSNL - 3G', 'B3', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(52, 'BSNL - STV', 'BR', '', 4, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(53, 'BSNL - TOPUP', 'BT', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(54, 'BSNL Recharge', 'BS', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(55, 'DISH TV', 'DTV', '', 4, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(56, 'DOCOME-SPECIAL', 'DS', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(57, 'DOCOMO', 'D', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(58, 'IDEA', 'I', 'ID', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(59, 'LOOP MOBILE', 'LM', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(60, 'MTNL - Recharge', 'MTR', 'DP', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(61, 'MTNL TOPUP', 'MTT', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(62, 'MTS', 'M', 'MT', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(63, 'RECHARGE VIDEOCON', 'VD', 'VD', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(64, 'RECHARGE VIDEOCON - SPL', 'VS', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(65, 'RELIANCE - JIO', 'RC', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(66, 'RELIANCE - GSM', 'RG', 'RG', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(67, 'TATA INDICOM', 'T', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(68, 'TATASKY DTH TV', 'TTV', '', 4, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(69, 'UNINOR', 'U', 'UN', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(70, 'UNINOR - SPL', 'US', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(71, 'VIDEOCON DTH TV', 'VTV', '', 4, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(72, 'VIRGIN - CDMA', 'VC', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(73, 'VIRGIN - GSM', 'VG', '', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(74, 'Vodafone', 'V', 'VF', 1, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(75, 'Airtel Postpaid', 'PAT', '', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(76, 'Bsnl Landline', 'LBS', '', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(77, 'BSNL Postpaid', 'BP', '', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(78, 'Idea Postpaid', 'IP', '', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(79, 'Loop Mobile Postpaid', 'LMP', '', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(80, 'MTNL Delhi Landline', 'LMT', '', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(81, 'Reliance CDMA Postpaid', 'RCP', 'CG', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(82, 'Reliance GSM Postpaid', 'RGP', '', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(83, 'Tata Docomo Postpaid', 'DP', 'TD', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(84, 'Tata Walky', 'TW', '', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43'),
(85, 'Vodafone Postpaid', 'VP', '', 2, NULL, NULL, 1, '2018-03-21 18:11:43', '2018-03-21 18:11:43');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_order_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('success','failed','pending','canceled','returned','process') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_approve` smallint(6) NOT NULL DEFAULT '0',
  `delivered_seller` tinyint(1) NOT NULL DEFAULT '0',
  `delivery_date` datetime DEFAULT NULL,
  `shipping` enum('dispute','ontheway','nearbyyou','delivered') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `cancel_approve` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `user_id`, `product_id`, `transaction_id`, `unique_order_id`, `color`, `size`, `quantity`, `price`, `address`, `status`, `return_approve`, `delivered_seller`, `delivery_date`, `shipping`, `shipping_method`, `payment_type`, `shipping_charge`, `reason`, `comments`, `cancel_approve`, `created_at`, `updated_at`) VALUES
(1, 16, 21, 'lozypay5ab53eededea0', '5ab53eededdf2', NULL, NULL, '1', 0, 'Smriti Nagar', 'pending', 0, 0, NULL, NULL, 'free', NULL, NULL, NULL, NULL, 0, '2018-03-23 20:22:45', '2018-03-23 20:22:45'),
(2, 16, 23, 'lozypay5ab6851731b6e', '5ab6851730bc8', NULL, NULL, '3', 0, 'Smriti Nagar', 'pending', 0, 0, NULL, NULL, 'free', NULL, NULL, NULL, NULL, 0, '2018-03-24 19:34:23', '2018-03-24 19:34:23'),
(3, 11, 21, 'lozypay5aba4fd6039ff', '5aba4fd60395d', NULL, NULL, '1', 12000, 'lxkfgldjldfgdlgdg dflg jdgd jgfdlfgl', 'pending', 0, 0, NULL, NULL, 'free', NULL, NULL, NULL, NULL, 0, '2018-03-27 16:36:14', '2018-03-27 16:36:14'),
(4, 11, 21, 'lozypay5aba501932758', '5aba501932366', NULL, NULL, '1', 12000, 'lxkfgldjldfgdlgdg dflg jdgd jgfdlfgl', 'success', 0, 0, NULL, NULL, 'free', NULL, NULL, NULL, NULL, 0, '2018-03-27 16:37:21', '2018-03-27 16:37:29'),
(5, 31, 29, 'lozypay5aba740ab2259', '5aba740ab21a1', '#d1a862', NULL, '1', 9000, 'dsjfka fkfjfjakjdfka djf ajdf djfa', 'success', 0, 0, NULL, NULL, 'free', NULL, NULL, NULL, NULL, 0, '2018-03-27 19:10:42', '2018-03-27 19:12:36'),
(6, 17, 28, 'lozypay5abf12d9c91b6', '5abf12d9c89e4', '#0088cc', NULL, '1', 1000, 'No.66, 19th Street, Shankar Nagar, Pammal', 'success', 0, 0, NULL, NULL, 'free', NULL, NULL, NULL, NULL, 0, '2018-03-31 06:17:21', '2018-03-31 06:17:52'),
(7, 15, 28, 'lozypay5acde6b67df4b', '5acde6b67de7f', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'success', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 12:13:02', '2018-04-11 12:13:19'),
(8, 15, 28, 'lozypay5ace0e2d23e31', '5ace0e2d23d1f', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'process', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:01:25', '2018-04-18 19:45:20'),
(9, 15, 28, 'lozypay5ace0fb49d175', '5ace0fb49d0d2', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:07:56', '2018-04-11 15:07:56'),
(10, 15, 28, 'lozypay5ace1106a2102', '5ace1106a2052', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:13:34', '2018-04-11 15:13:34'),
(11, 15, 28, 'lozypay5ace113d882bc', '5ace113d88224', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:14:29', '2018-04-11 15:14:29'),
(12, 15, 28, 'lozypay5ace117cd1a43', '5ace117cd19b6', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:15:32', '2018-04-11 15:15:32'),
(13, 15, 28, 'lozypay5ace11cf12eee', '5ace11cf12dde', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:16:55', '2018-04-11 15:16:55'),
(14, 15, 28, 'lozypay5ace12228b1d4', '5ace12228b13a', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:18:18', '2018-04-11 15:18:18'),
(15, 15, 28, 'lozypay5ace124203d34', '5ace124203c90', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:18:50', '2018-04-11 15:18:50'),
(16, 15, 28, 'lozypay5ace129b90ccc', '5ace129b90c34', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:20:19', '2018-04-11 15:20:19'),
(17, 15, 28, '67282277308404448', '67282277308404448', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:27:26', '2018-04-11 15:27:26'),
(18, 15, 28, '14192898115143180', '14192898115143180', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'success', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:29:41', '2018-04-11 15:44:32'),
(19, 47, 28, '42407538588158788', '42407538588158788', '#0088cc', 'M', '1', 1000, 'dsdsgdsg\r\ndsg\r\ndsgds\r\ngds', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:30:32', '2018-04-11 15:30:32'),
(20, 47, 28, '33174641574732960', '33174641574732960', '#0088cc', 'M', '1', 1000, 'dsdsgdsg\r\ndsg\r\ndsgds\r\ngds', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:35:36', '2018-04-11 15:35:36'),
(21, 47, 28, '37989502134732904', '37989502134732904', '#0088cc', 'M', '1', 1000, 'dsdsgdsg\r\ndsg\r\ndsgds\r\ngds', 'success', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-11 15:40:13', '2018-04-11 15:44:35'),
(22, 47, 28, '90060004084371024', '90060004084371024', '#0088cc', 'M', '1', 1000, 'asdfasfefa\r\nasfaew', 'pending', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-12 13:41:00', '2018-04-12 13:41:00'),
(23, 46, 28, '34809365868568420', '34809365868568420', '#0088CC', 'XL', '1', 1000, 'rajkot gujarat', 'pending', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-12 14:06:55', '2018-04-12 14:06:55'),
(24, 46, 29, '34809365868568420', '34809365868568420', '#D1A862', NULL, '1', 9000, 'rajkot gujarat', 'pending', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-12 14:06:55', '2018-04-12 14:06:55'),
(25, 47, 28, '88846931387670336', '88846931387670336', '#0088cc', 'M', '1', 1000, 'safdvfgfd', 'pending', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-12 14:27:04', '2018-04-12 14:27:04'),
(26, 15, 28, '21060258648358286', '21060258648358286', '#0088cc', 'M', '1', 1000, 'fsffspdksfkspfkpsfksfpkdspfkpdskfpskpdsfs sdf sdf', 'success', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-16 06:30:58', '2018-04-16 06:31:45'),
(27, 46, 29, '82358659881573867', '82358659881573867', '#D1A862', NULL, '1', 9000, 'safdvfgfd', 'pending', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-16 15:27:30', '2018-04-16 15:27:30'),
(28, 46, 29, '80291039611591504', '80291039611591504', '#D1A862', NULL, '1', 9000, 'safdvfgfd', 'pending', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-17 05:43:42', '2018-04-17 05:43:42'),
(29, 46, 29, '42766435925030096', '42766435925030096', '#D1A862', NULL, '1', 9000, 'safdvfgfd', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-17 05:45:39', '2018-04-17 05:46:46'),
(30, 46, 29, '13112311721573061', '13112311721573061', '#D1A862', NULL, '1', 9000, 'safdvfgfd', 'pending', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-17 05:50:29', '2018-04-17 05:50:29'),
(31, 46, 29, '51821124551912442', '51821124551912442', '#D1A862', NULL, '1', 9000, 'safdvfgfd', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-17 05:51:03', '2018-04-17 05:54:32'),
(32, 46, 28, '20460824168332369', '20460824168332369', '#0088CC', 'XL', '1', 1000, 'rajkot gujarat', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-17 15:23:46', '2018-04-17 15:23:59'),
(33, 46, 29, '59150997903330234', '59150997903330234', '#D1A862', NULL, '3', 9000, 'rajkot gujarat', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-17 15:28:57', '2018-04-17 15:29:11'),
(34, 51, 28, '25681125528823093', '25681125528823093', '#0088CC', 'M', '1', 1000, 'fghb fg\nhhjjjjkkjjkiffg\nhjkkkhj', 'pending', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-18 19:34:50', '2018-04-18 19:34:50'),
(35, 48, 28, '99366851941191724', '99366851941191724', '#0088cc', 'M', '1', 1000, 'kdlsajfkl ajdfakjdf djfakj', 'pending', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-18 19:48:17', '2018-04-18 19:48:17'),
(36, 51, 28, '89902918834597681', '89902918834597681', '#0088CC', 'M', '1', 1000, 'fghb fg\nhhjjjjkkjjkiffg\nhjkkkhj', 'pending', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-19 05:47:57', '2018-04-19 05:47:57'),
(37, 46, 29, '67583082953064827', '67583082953064827', '#D1A862', NULL, '1', 9000, 'rajkot gujarat', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-19 06:15:28', '2018-04-19 06:15:47'),
(38, 46, 29, '43711143472657311', '43711143472657311', '#D1A862', NULL, '1', 9000, 'rajkot gujarat', 'pending', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-19 06:20:28', '2018-04-19 06:20:28'),
(39, 46, 29, '22869424358481321', '22869424358481321', '#D1A862', NULL, '1', 9000, 'rajkot gujarat', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-19 06:25:44', '2018-04-19 06:26:00'),
(40, 46, 28, '18511031160626336', '18511031160626336', '#0088CC', 'M', '1', 1000, 'rajkot gujarat', 'pending', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-19 06:35:49', '2018-04-19 06:35:49'),
(41, 46, 28, '00974344804822252', '00974344804822252', '#0088CC', 'M', '1', 1000, 'rajkot gujarat', 'pending', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-19 06:38:10', '2018-04-19 06:38:10'),
(42, 46, 28, '87495368558346931', '87495368558346931', '#0088CC', 'M', '1', 1000, 'rajkot gujarat', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-19 06:41:13', '2018-04-19 06:41:33'),
(43, 46, 29, '90495993603148444', '90495993603148444', '#D1A862', NULL, '1', 9000, 'rajkot gujarat', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-19 06:55:55', '2018-04-19 06:56:11'),
(44, 46, 29, '20447396623538314', '20447396623538314', '#D1A862', NULL, '1', 9000, 'azszax\nza\nzaaza', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 13:47:21', '2018-04-20 13:47:39'),
(45, 46, 28, '20447396623538314', '20447396623538314', '#0088CC', 'M', '1', 1000, 'azszax\nza\nzaaza', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 13:47:21', '2018-04-20 13:47:39'),
(46, 46, 28, '36304781652192199', '36304781652192199', '#0088CC', 'M', '1', 1000, 'hjdtdys\nshdyh', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 14:16:37', '2018-04-20 14:16:51'),
(47, 46, 29, '36304781652192199', '36304781652192199', '#D1A862', NULL, '1', 9000, 'hjdtdys\nshdyh', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 14:16:37', '2018-04-20 14:16:51'),
(48, 46, 29, '69225940229914816', '69225940229914816', '#D1A862', NULL, '1', 9000, 'hjdtdys\nshdyh', 'pending', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-20 14:22:24', '2018-04-20 14:22:24'),
(49, 46, 28, '72072473460956025', '72072473460956025', '#0088CC', 'M', '1', 1000, 'hjdtdys\nshdyh', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 14:26:42', '2018-04-20 14:26:55'),
(50, 46, 29, '72072473460956025', '72072473460956025', '#D1A862', NULL, '1', 9000, 'hjdtdys\nshdyh', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 14:26:42', '2018-04-20 14:26:55'),
(51, 46, 29, '15589570922409888', '15589570922409888', '#D1A862', NULL, '1', 9000, 'hjdtdys\nshdyh', 'pending', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 14:30:01', '2018-04-20 14:30:01'),
(52, 46, 29, '90411709893863066', '90411709893863066', '#D1A862', NULL, '1', 9000, 'hjdtdys\nshdyh', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 14:31:37', '2018-04-20 14:31:48'),
(53, 46, 29, '42249631910117862', '42249631910117862', '#D1A862', NULL, '1', 9000, 'hjdtdys\nshdyh', 'pending', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 14:32:31', '2018-04-20 14:32:31'),
(54, 46, 29, '11568675852699429', '11568675852699429', '#D1A862', NULL, '1', 9000, 'hjdtdys\nshdyh', 'success', 0, 0, NULL, NULL, 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 14:33:30', '2018-04-20 14:33:39'),
(55, 53, 29, '91166962398382124', '91166962398382124', '#d1a862', NULL, '1', 9000, 'skfsgkjldfjgldjfgjgdljdlj', 'success', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-04-21 08:02:19', '2018-04-21 08:03:08'),
(56, 15, 29, '53092311071769697', '53092311071769697', '#d1a862', NULL, '1', 9000, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'process', 0, 0, '2018-04-21 20:18:00', 'delivered', 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-21 08:08:45', '2018-04-21 09:26:55'),
(57, 15, 29, '83802907536200149', '83802907536200149', '#d1a862', NULL, '1', 9000, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'process', 0, 0, '2018-04-25 20:18:00', 'delivered', 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-21 09:29:42', '2018-04-27 06:11:48'),
(58, 47, 29, '29969847695372454', '29969847695372454', '#d1a862', NULL, '1', 9000, 'dsdsgdsg\r\ndsg\r\ndsgds\r\ngds', 'process', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-24 06:53:14', '2018-04-26 15:13:28'),
(59, 15, 28, '06190600714295859', '06190600714295859', '#0088cc', 'M', '1', 1000, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'canceled', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-04-25 13:13:47', '2018-06-07 09:29:24'),
(60, 57, 34, '35065820972971372', '35065820972971372', '#0088cc', NULL, '1', 25000, 'qwrtoivjjkl', 'success', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-05-07 19:49:55', '2018-10-19 21:45:12'),
(61, 15, 28, '49582619782040741', '49582619782040741', '#0088cc', 'M', '1', 1000, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'canceled', 0, 0, NULL, NULL, 'free', 'cod', NULL, 'purchased_mistake', NULL, 0, '2018-05-11 06:03:54', '2018-05-18 20:47:29'),
(62, 15, 30, '97091054445989130', '97091054445989130', '#d10023', NULL, '1', 40000, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'pending', 0, 0, NULL, NULL, 'free', 'debit_card', NULL, NULL, NULL, 0, '2018-05-18 20:59:29', '2018-05-18 20:59:29'),
(63, 15, 34, '21781874058157028', '21781874058157028', '#0088cc', NULL, '1', 25000, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'process', 0, 0, '2018-07-28 20:18:00', 'delivered', 'free', 'cod', NULL, 'purchased_mistake', NULL, 0, '2018-05-20 09:55:12', '2018-07-27 10:00:47'),
(64, 15, 29, '27681561133929941', '27681561133929941', '#d1a862', NULL, '1', 12000, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'returned', 1, 1, '2018-08-04 20:18:00', 'delivered', 'free', 'cod', NULL, 'long_delivery_promise', '123', 0, '2018-08-02 04:48:05', '2018-08-02 12:40:55'),
(65, 15, 29, '51688266278373716', '51688266278373716', '#d1a862', NULL, '1', 12000, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'process', 0, 0, NULL, NULL, 'free', 'cod', NULL, NULL, NULL, 0, '2018-08-02 05:19:59', '2018-08-02 05:20:17'),
(66, 15, 34, '42273922258451626', '42273922258451626', '#0088cc', NULL, '1', 30000, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'canceled', 0, 0, '2018-08-04 20:18:00', 'ontheway', 'free', 'cod', NULL, 'others', 'color is varient selected', 1, '2018-08-02 06:19:25', '2018-10-19 21:45:45'),
(67, 15, 34, '06536165750666128', '06536165750666128', '#0088cc', NULL, '1', 30000, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'process', 0, 0, '2018-08-06 20:18:00', 'delivered', 'free', 'cod', NULL, NULL, NULL, 0, '2018-08-02 11:23:12', '2018-08-02 13:20:33'),
(68, 15, 55, '18409016744863056', '18409016744863056', '#0088cc', NULL, '1', 11, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'process', 0, 0, '2018-08-05 20:18:00', 'delivered', 'free', 'cod', NULL, NULL, NULL, 0, '2018-08-04 12:25:42', '2018-08-04 12:28:23'),
(69, 46, 67, '20447396623538314', '20447396623538314', '#D1A862', NULL, '1', 9000, 'azszax\r\nza\r\nzaaza', 'success', 0, 0, NULL, 'dispute', 'free', 'debit', NULL, NULL, NULL, 0, '2018-04-20 13:47:21', '2018-04-20 13:47:39'),
(70, 15, 67, '83141142106458614', '83141142106458614', NULL, NULL, '1', 350, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'success', 0, 0, '2018-08-07 20:18:00', 'delivered', 'free', 'cod', NULL, NULL, NULL, 0, '2018-08-06 04:53:21', '2018-08-06 04:58:22'),
(71, 15, 68, '83141142106458614', '83141142106458614', NULL, NULL, '1', 350, 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 'success', 0, 0, '2018-08-07 20:18:00', 'delivered', 'free', 'cod', NULL, NULL, NULL, 0, '2018-08-06 04:53:21', '2018-08-06 04:58:22');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment_collection`
--

CREATE TABLE `payment_collection` (
  `id` int(10) UNSIGNED NOT NULL,
  `fee_deduction_id` int(10) UNSIGNED NOT NULL,
  `selling_fee` double NOT NULL,
  `closing_fee` double NOT NULL,
  `total_fee` double NOT NULL,
  `service_tax` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `payment_collection`
--

INSERT INTO `payment_collection` (`id`, `fee_deduction_id`, `selling_fee`, `closing_fee`, `total_fee`, `service_tax`, `created_at`, `updated_at`) VALUES
(8, 9, 10, 5, 5, 9, '2018-08-01 10:27:01', '2018-08-09 11:00:06'),
(9, 10, 10, 5, 5, 9, '2018-08-01 10:27:01', '2018-08-09 11:31:40'),
(10, 11, 10, 10, 10, 10, '2018-08-09 09:40:28', '2018-08-09 11:07:55'),
(11, 12, 10, 10, 10, 10, '2018-08-09 09:46:07', '2018-08-09 09:49:21'),
(12, 13, 10, 10, 10, 18, '2018-08-09 09:58:54', '2018-08-09 09:58:54'),
(13, 14, 100, 100, 100, 10, '2018-08-09 10:06:30', '2018-08-09 10:06:30'),
(14, 15, 100, 100, 100, 100, '2018-08-09 10:13:07', '2018-08-09 10:13:07'),
(15, 16, 100, 100, 100, 100, '2018-08-09 10:15:59', '2018-08-09 10:15:59'),
(16, 17, 100, 100, 100, 100, '2018-08-09 10:18:03', '2018-08-09 10:18:03'),
(17, 18, 100, 100, 100, 100, '2018-08-09 10:20:22', '2018-08-09 10:20:22'),
(19, 20, 100, 100, 100, 100, '2018-08-09 10:29:04', '2018-08-09 10:29:04'),
(20, 21, 100, 100, 100, 100, '2018-08-09 10:30:21', '2018-08-09 10:30:21'),
(21, 22, 10, 10, 10, 10, '2018-08-09 10:31:48', '2018-08-09 10:31:48'),
(23, 24, 100, 100, 100, 100, '2018-08-09 10:35:13', '2018-08-09 10:35:13'),
(30, 31, 10, 10, 10, 10, '2018-08-09 11:01:53', '2018-08-10 04:44:07'),
(31, 32, 100, 100, 100, 100, '2018-08-09 11:09:13', '2018-08-09 11:09:13'),
(32, 33, 100, 99, 1100, 100, '2018-08-09 11:11:32', '2018-08-10 04:40:29'),
(33, 34, 100, 100, 100, 100, '2018-08-09 11:14:17', '2018-08-09 11:14:17'),
(34, 35, 100, 100, 100, 100, '2018-08-09 11:15:47', '2018-08-15 09:08:36'),
(35, 36, 100, 100, 100, 100, '2018-08-09 11:17:47', '2018-08-09 11:32:30'),
(36, 37, 10, 10, 10, 10, '2018-08-09 11:20:53', '2018-08-09 11:20:53'),
(37, 38, 10, 10, 10, 10, '2018-08-09 11:22:45', '2018-08-09 11:22:45'),
(38, 39, 10, 10, 10, 10, '2018-08-09 11:24:08', '2018-08-09 11:24:08'),
(39, 40, 220, 180, 180, -5, '2018-10-19 21:26:22', '2018-10-19 21:27:00');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Product', 'Create Product', 'User create ,edit end delete product', 'product', '2018-02-28 05:32:50', '2018-04-27 16:07:54'),
(2, 'Admin', 'Admin', 'Give the permission to access', 'admin', '2018-03-17 11:24:36', '2018-03-17 11:24:36'),
(3, 'Order', 'Order', 'Order', 'order', '2018-04-27 16:08:36', '2018-04-27 16:08:57'),
(4, 'Report', 'Report', 'Report', 'report', '2018-04-27 16:12:44', '2018-04-27 16:12:44'),
(5, 'Front Slide', 'Front Slide', 'Front Slide', 'front-slide', '2018-04-27 16:30:31', '2018-04-27 16:30:40');

-- --------------------------------------------------------

--
-- Structure de la table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `desc`, `image`, `created_at`, `updated_at`) VALUES
(1, '<h2><strong><u>Privacy Policy:<br /><br /></u></strong></h2>\r\n<p>Our primary goal is to build a trust between us. That\'s why we insist upon the highest standards for secure transactions and customer information privacy. Please read the following statement to learn about our information gathering and practices.<br /><br /></p>\r\n<p><strong><u>Our collection and use of information:</u></strong></p>\r\n<p><strong>&nbsp;</strong></p>\r\n<ul>\r\n<li><strong>Information you provide to us</strong>:</li>\r\n</ul>\r\n<p><strong>&nbsp;</strong></p>\r\n<p>We collect personal information such as your name, email address and phone number, when you register for an account on the service.</p>\r\n<p>You may also provide with us some optional information such as name, email and other option profile information that you elect to associate with your account is referred to herein&nbsp; as your &ldquo;profile information&rdquo;.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li><strong>Use of Cookies:</strong></li>\r\n</ul>\r\n<p><strong>&nbsp;</strong></p>\r\n<p>We are using use cookies to allow you to enter your password less frequently during a session. Cookies can also help us provide information that is targeted to your interests. Most cookies are \"session cookies,\" meaning that they are automatically deleted from your hard drive at the end of a session. You are always free to decline our cookies if your browser permits, although in that case you may not be able to use certain features on the Website and you may be required to re-enter your password more frequently during a session.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<ul>\r\n<li><strong>Sharing of personal information:</strong></li>\r\n</ul>\r\n<p><strong>&nbsp;</strong></p>\r\n<p>We may share personal information with our other corporate entities and affiliates. These entities and affiliates may market to you as a result of such sharing unless you explicitly opt-out.</p>\r\n<p>We may disclose personal information to third parties. This disclosure may be required for us to provide you access to our Services, to comply with our legal obligations, to enforce our User Agreement, to facilitate our marketing and advertising activities, or to prevent, detect, mitigate, and investigate fraudulent or illegal activities related to our Services. We do not disclose your personal information to third parties for their marketing and advertising purposes without your explicit consent.</p>\r\n<p>We may disclose personal information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to respond to subpoenas, court orders, or other legal process. We may disclose personal information to law enforcement offices, third party rights owners, or others in the good faith belief that such disclosure is reasonably necessary to: enforce our Terms or Privacy Policy; respond to claims that an advertisement, posting or other content violates the rights of a third party; or protect the rights, property or personal safety of our users or the general public.</p>\r\n<p>We and our affiliates will share / sell some or all of your personal information with another business entity should we (or our assets) plan to merge with, or be acquired by that business entity, or re-organization, amalgamation, restructuring of business. Should such a transaction occur that other business entity (or the new combined entity) will be required to follow this privacy policy with respect to your personal information.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<ul>\r\n<li><strong>Grievance Redressal:</strong></li>\r\n</ul>\r\n<p><strong>&nbsp;</strong></p>\r\n<p>In accordance with Information Technology Act 2000 and rules made there under, the name and contact details of the Grievance Officer are provided below:</p>\r\n<p>&nbsp;</p>\r\n<p>LozyPay Soft Solution.</p>\r\n<p>Swathisudha Apartment</p>\r\n<p>1st floor,19<sup>th</sup> Street , Shankar Nagar, Pammal</p>\r\n<p>Tamilnadu, India</p>\r\n<p>Phone: 6309734245 / 8778783053</p>\r\n<p>Email: info@lozypay.com</p>\r\n<h5 style=\"text-align: left;\">Time: Mon - Sat (9:00 - 18:00)</h5>', 'privacy_1524031065.jpeg', '2018-04-18 07:27:45', '2018-05-01 06:56:57');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_desc` text COLLATE utf8mb4_unicode_ci,
  `m_keywords` text COLLATE utf8mb4_unicode_ci,
  `m_tag` text COLLATE utf8mb4_unicode_ci,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hsn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `quantity` bigint(191) DEFAULT NULL,
  `reward_points` bigint(191) DEFAULT NULL,
  `video_thumb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_class_id` int(10) UNSIGNED DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `sub_category_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `product_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_chart` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` bigint(20) DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
  `special` tinyint(1) NOT NULL DEFAULT '0',
  `new_arrival` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `desc`, `m_title`, `m_desc`, `m_keywords`, `m_tag`, `model`, `sku`, `hsn`, `isbn`, `price`, `shipping_charge`, `quantity`, `reward_points`, `video_thumb`, `video_id`, `url`, `tax_class_id`, `brand_id`, `sub_category_id`, `status`, `product_img`, `size_chart`, `order`, `slug`, `recommend`, `special`, `new_arrival`, `created_at`, `updated_at`) VALUES
(34, 1, 'Apple iPhone 6', '<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">8MP primary camera with auto focus and 1.2MP front facing camera</span></li>\r\n<li><span class=\"a-list-item\">11.4 centimeters (4.7-inch) retina HD touchscreen with 1334 x 750 pixels resolution and 326 ppi pixel density</span></li>\r\n<li><span class=\"a-list-item\">iOS 8, upgradable to iOS 10.3.2 with 1.4GHz A8 chip 64-bit architecture processor, 1GB RAM, 32GB internal memory and single nano SIM</span></li>\r\n<li><span class=\"a-list-item\">1810mAH lithium-ion battery providing talk-time of 14 hours on 3G networks and standby time of 240 hours</span></li>\r\n<li><span class=\"a-list-item\">1 year manufacturer warranty for device and manufacturer warranty for in-box accessories including batteries from the date of purchase</span></li>\r\n</ul>', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', '12', '159', '226', '30000', 10, 5, 0, NULL, NULL, 'https://www.youtube.com/embed/neqdJevIdBY', NULL, 5, 1, 1, '1524828287.jpg', NULL, NULL, 'apple-iphone-6', 1, 1, 1, '2018-04-27 12:54:51', '2018-04-27 12:55:30'),
(49, 1, 'Dennis Lingo Men\'s Cotton Solid Casual Shirt', '<div id=\"title_feature_div\" class=\"feature\" data-feature-name=\"title\">\r\n<div id=\"titleSection\" class=\"a-section a-spacing-none\">\r\n<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">100% Premium Cottton, extremely soft finish and Rich look</span></li>\r\n<li><span class=\"a-list-item\">Stylish Slim collar casual Shirt for men</span></li>\r\n<li><span class=\"a-list-item\">Modern Slim Fit</span></li>\r\n<li><span class=\"a-list-item\">Best for casual &amp; smart casual wear</span></li>\r\n</ul>\r\n</div>\r\n</div>', 'Dennis Lingo Men\'s Cotton Solid Casual Shirt', 'This Is Designed As Per The Latest Trends To Keep You In Sync With High Fashion And With Wedding And Other Occasion, It Will Keep You Comfortable All Day Long. The Lovely Design Forms A Substantial Feature Of This Wear.It Looks Stunning Every Time You Match It With Accessories. Disclaimer: Product Color May Slightly Vary Due To Photographic Lighting Sources Or Your Monitor Settings.', 'Mens Shirts, Cotton Shirts', '100% Premium Cottton, Extremely soft finish and Rich look, Stylish Slim collar casual Shirt for men, Modern Slim Fit Best for casual & smart casual wear', 'A1234', 'A1234', NULL, NULL, '500', NULL, 10, NULL, NULL, NULL, NULL, NULL, 6, 1, 1, '1532164893.jpg', NULL, NULL, 'dennis-lingo-men-s-cotton-solid-casual-shirt', 0, 0, 0, '2018-07-21 14:51:34', '2018-07-21 19:12:53'),
(50, 1, 'The Theory of Everything By Stephen Hawking', '<p>Seven lectures by the brilliant theoretical physicist have been compiled into this book to try to explain to the common man, the complex problems of mathematics and the question that has been gripped everyone all for centuries, the theory of existence.</p>\r\n<p>Undeniably intelligent, witty and childlike in his explanations, the narrator describes every detail about the beginning of the universe. He describes what a theory that can state the initiation of everything would encompass.</p>\r\n<p>Ideologies about the universe by Aristotle, Augustine, Hubble, Newton and Einstein have all been briefly introduced to the reader. Black holes and Big Bang has been explained in an unsophisticated manner for anyone to understand.</p>\r\n<p>All these events and individual theories may be strung together to create a theory of the origin of everything and the author strongly believes that the origin might not necessarily be from a singular event. He advocates the idea of a multi-dimensional origin with a no-boundary condition to remain true to the theories of modern physics and quantum physics.</p>\r\n<p>The book provides a clear view of the world through Stephen&rsquo;s mind where he respectfully dismisses the belief that the Universe conforms by a supernatural and all-powerful entity.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>About The Author:</strong></p>\r\n<p>Stephen Hawking: An English cosmologist, theoretical physicist, author as well as the Director of Research at the Centre for Theoretical Cosmology under the University of Cambridge, Stephen Hawking is a scholar with more than a dozen of honorary degrees. In was in 1963 that Stephen Hawking contracted a rare motor neuron disorder which gave him just two years to live, yet he went to Cambridge to become what he is today.</p>', 'The Theory of Everything Paperback', 'Seven lectures by the brilliant theoretical physicist have been compiled into this book to try to explain to the common man, the complex problems of mathematics and the theory of existence.', 'Book, Stephen Hawking', 'Book, English Book, Stephen Hawking', '978-8179925911', '8179925911', NULL, '978-8179925911', '130', NULL, 100, NULL, NULL, NULL, NULL, NULL, 7, 1, 1, '1532251929.jpg', NULL, NULL, 'the-theory-of-everything-1', 0, 0, 0, '2018-07-22 15:02:09', '2018-07-24 16:56:09'),
(57, 1, 'NEws', '<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">8MP primary camera with auto focus and 1.2MP front facing camera</span></li>\r\n<li><span class=\"a-list-item\">11.4 centimeters (4.7-inch) retina HD touchscreen with 1334 x 750 pixels resolution and 326 ppi pixel density</span></li>\r\n<li><span class=\"a-list-item\">iOS 8, upgradable to iOS 10.3.2 with 1.4GHz A8 chip 64-bit architecture processor, 1GB RAM, 32GB internal memory and single nano SIM</span></li>\r\n<li><span class=\"a-list-item\">1810mAH lithium-ion battery providing talk-time of 14 hours on 3G networks and standby time of 240 hours</span></li>\r\n<li><span class=\"a-list-item\">1 year manufacturer warranty for device and manufacturer warranty for in-box accessories including batteries from the date of purchase</span></li>\r\n</ul>', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', '12', '159', '226', '30000', 10, 5, 0, NULL, NULL, NULL, NULL, 5, 1, 1, '1533036279.jpg', '1533036279.jpg', NULL, 'news', 0, 0, 0, '2018-07-31 11:24:39', '2018-07-31 11:24:39'),
(58, 1, 'is', '<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">8MP primary camera with auto focus and 1.2MP front facing camera</span></li>\r\n<li><span class=\"a-list-item\">11.4 centimeters (4.7-inch) retina HD touchscreen with 1334 x 750 pixels resolution and 326 ppi pixel density</span></li>\r\n<li><span class=\"a-list-item\">iOS 8, upgradable to iOS 10.3.2 with 1.4GHz A8 chip 64-bit architecture processor, 1GB RAM, 32GB internal memory and single nano SIM</span></li>\r\n<li><span class=\"a-list-item\">1810mAH lithium-ion battery providing talk-time of 14 hours on 3G networks and standby time of 240 hours</span></li>\r\n<li><span class=\"a-list-item\">1 year manufacturer warranty for device and manufacturer warranty for in-box accessories including batteries from the date of purchase</span></li>\r\n</ul>', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', '12', '159', '226', '30000', 10, 5, 0, NULL, NULL, 'https://www.youtube.com/embed/neqdJevIdBY', 2, 5, 1, 1, '1533036540.png', '1533036540.png', NULL, 'apple-iphone-6-2', 0, 0, 0, '2018-07-31 11:29:00', '2018-07-31 11:29:00'),
(60, 1, 'is2', '<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">8MP primary camera with auto focus and 1.2MP front facing camera</span></li>\r\n<li><span class=\"a-list-item\">11.4 centimeters (4.7-inch) retina HD touchscreen with 1334 x 750 pixels resolution and 326 ppi pixel density</span></li>\r\n<li><span class=\"a-list-item\">iOS 8, upgradable to iOS 10.3.2 with 1.4GHz A8 chip 64-bit architecture processor, 1GB RAM, 32GB internal memory and single nano SIM</span></li>\r\n<li><span class=\"a-list-item\">1810mAH lithium-ion battery providing talk-time of 14 hours on 3G networks and standby time of 240 hours</span></li>\r\n<li><span class=\"a-list-item\">1 year manufacturer warranty for device and manufacturer warranty for in-box accessories including batteries from the date of purchase</span></li>\r\n</ul>', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', '12', '159', '226', '30000', 10, 5, 0, NULL, NULL, NULL, 2, 5, 1, 1, '1533037886.jpg', NULL, NULL, 'is2', 0, 0, 0, '2018-07-31 11:51:26', '2018-07-31 11:51:26'),
(61, 1, 'is546644646', '<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">8MP primary camera with auto focus and 1.2MP front facing camera</span></li>\r\n<li><span class=\"a-list-item\">11.4 centimeters (4.7-inch) retina HD touchscreen with 1334 x 750 pixels resolution and 326 ppi pixel density</span></li>\r\n<li><span class=\"a-list-item\">iOS 8, upgradable to iOS 10.3.2 with 1.4GHz A8 chip 64-bit architecture processor, 1GB RAM, 32GB internal memory and single nano SIM</span></li>\r\n<li><span class=\"a-list-item\">1810mAH lithium-ion battery providing talk-time of 14 hours on 3G networks and standby time of 240 hours</span></li>\r\n<li><span class=\"a-list-item\">1 year manufacturer warranty for device and manufacturer warranty for in-box accessories including batteries from the date of purchase</span></li>\r\n</ul>', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', '12', '159', '226', '30000', 10, 5, 0, NULL, NULL, NULL, 2, 5, 1, 1, '1533038231.jpg', NULL, NULL, 'is546644646', 0, 0, 0, '2018-07-31 11:57:11', '2018-07-31 11:57:11'),
(62, 1, 'is10', '<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">8MP primary camera with auto focus and 1.2MP front facing camera</span></li>\r\n<li><span class=\"a-list-item\">11.4 centimeters (4.7-inch) retina HD touchscreen with 1334 x 750 pixels resolution and 326 ppi pixel density</span></li>\r\n<li><span class=\"a-list-item\">iOS 8, upgradable to iOS 10.3.2 with 1.4GHz A8 chip 64-bit architecture processor, 1GB RAM, 32GB internal memory and single nano SIM</span></li>\r\n<li><span class=\"a-list-item\">1810mAH lithium-ion battery providing talk-time of 14 hours on 3G networks and standby time of 240 hours</span></li>\r\n<li><span class=\"a-list-item\">1 year manufacturer warranty for device and manufacturer warranty for in-box accessories including batteries from the date of purchase</span></li>\r\n</ul>', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', '12', '159', '226', '30000', 10, 5, 0, NULL, NULL, NULL, 2, 5, 1, 1, '1533038307.jpg', NULL, NULL, 'is10', 0, 0, 0, '2018-07-31 11:58:28', '2018-07-31 11:58:28'),
(63, 1, 'Sun Glasses', '<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">8MP primary camera with auto focus and 1.2MP front facing camera</span></li>\r\n<li><span class=\"a-list-item\">11.4 centimeters (4.7-inch) retina HD touchscreen with 1334 x 750 pixels resolution and 326 ppi pixel density</span></li>\r\n<li><span class=\"a-list-item\">iOS 8, upgradable to iOS 10.3.2 with 1.4GHz A8 chip 64-bit architecture processor, 1GB RAM, 32GB internal memory and single nano SIM</span></li>\r\n<li><span class=\"a-list-item\">1810mAH lithium-ion battery providing talk-time of 14 hours on 3G networks and standby time of 240 hours</span></li>\r\n<li><span class=\"a-list-item\">1 year manufacturer warranty for device and manufacturer warranty for in-box accessories including batteries from the date of purchase</span></li>\r\n</ul>', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', '12', '159', '226', '30000', 10, 5, 0, NULL, NULL, NULL, 2, 5, 1, 1, '1533038389.jpg', NULL, NULL, 'is10-1', 0, 0, 0, '2018-07-31 11:59:49', '2018-07-31 11:59:49'),
(64, 1, 'Jio Phone', '<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">8MP primary camera with auto focus and 1.2MP front facing camera</span></li>\r\n<li><span class=\"a-list-item\">11.4 centimeters (4.7-inch) retina HD touchscreen with 1334 x 750 pixels resolution and 326 ppi pixel density</span></li>\r\n<li><span class=\"a-list-item\">iOS 8, upgradable to iOS 10.3.2 with 1.4GHz A8 chip 64-bit architecture processor, 1GB RAM, 32GB internal memory and single nano SIM</span></li>\r\n<li><span class=\"a-list-item\">1810mAH lithium-ion battery providing talk-time of 14 hours on 3G networks and standby time of 240 hours</span></li>\r\n<li><span class=\"a-list-item\">1 year manufacturer warranty for device and manufacturer warranty for in-box accessories including batteries from the date of purchase</span></li>\r\n</ul>', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', '12', '159', '226', '30000', 10, 5, 0, NULL, NULL, NULL, 2, 5, 1, 1, '1533038404.jpg', NULL, NULL, 'is10-2', 0, 0, 0, '2018-07-31 12:00:04', '2018-07-31 12:00:04'),
(65, 1, 'Apple i10', '<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">8MP primary camera with auto focus and 1.2MP front facing camera</span></li>\r\n<li><span class=\"a-list-item\">11.4 centimeters (4.7-inch) retina HD touchscreen with 1334 x 750 pixels resolution and 326 ppi pixel density</span></li>\r\n<li><span class=\"a-list-item\">iOS 8, upgradable to iOS 10.3.2 with 1.4GHz A8 chip 64-bit architecture processor, 1GB RAM, 32GB internal memory and single nano SIM</span></li>\r\n<li><span class=\"a-list-item\">1810mAH lithium-ion battery providing talk-time of 14 hours on 3G networks and standby time of 240 hours</span></li>\r\n<li><span class=\"a-list-item\">1 year manufacturer warranty for device and manufacturer warranty for in-box accessories including batteries from the date of purchase</span></li>\r\n</ul>', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', 'Apple iPhone 6', '12', '159', '226', '30000', 10, 5, 0, NULL, NULL, NULL, NULL, 5, 1, 1, '1533038457.jpg', NULL, NULL, 'example-data', 0, 0, 0, '2018-07-31 12:00:57', '2018-07-31 12:00:57'),
(71, 52, 'Mistubishi', '<p>Mistubishi</p>', 'Mistubishi', 'Mistubishi', 'Mistubishi', 'Mistubishi', 'Mistubishi', 'Mistubishi', 'Mistubishi', 'Mistubishi', '69999', 198, 120, 0, NULL, NULL, NULL, 2, 7, 6, 1, '1533559087.jpg', '1533559088.jpg', NULL, 'mistubishi', 0, 0, 0, '2018-08-06 12:38:08', '2018-08-06 12:38:32'),
(77, 1, 'One box', '<p>One box</p>', 'One box', 'One box', 'One box', 'One box', 'One box', 'One box', 'One box', 'One box', '1500', 12, 9, 0, NULL, NULL, NULL, 2, 6, 5, 0, '1533636889.jpg', '1533636890.jpg', NULL, 'one-box', 0, 0, 0, '2018-08-07 10:14:50', '2018-08-07 10:14:50'),
(86, 1, '09-08-2018 product0', '<p>test</p>', 'test', 'test', 'tes', 'test', 'tes', 'test', 'test', 'test', '15000', 1000, 15200, 0, NULL, NULL, NULL, 2, 9, 2, 1, '1533818661.jpg', '1533818662.jpg', NULL, '09-08-2018-product-2', 0, 0, 0, '2018-08-09 12:44:22', '2018-08-30 09:29:12'),
(87, 1, '09-08-2018 product123', '<p>test</p>', 'test', 'test', 'tes', 'test', 'tes', 'test', 'test', 'test', '15000', 1000, 15200, 0, NULL, NULL, NULL, 2, 9, 2, 1, '1533818802.jpg', '1533818802.jpg', NULL, '09-08-2018-product-2', 0, 0, 0, '2018-08-09 12:46:42', '2018-08-30 09:27:11'),
(106, 1, 'ds', '<p>dsf</p>', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', '54353', 3453, 343, 34, NULL, NULL, NULL, 2, 9, 2, 0, '1533882797.png', '1533882798.png', NULL, 'ds', 0, 0, 0, '2018-08-10 06:33:18', '2018-08-10 06:33:18'),
(107, 1, 'test', '<p>test</p>', 'test', 'estset', 'set', 'etst', 'estse', 'set', 'set', 'set', '4353', 345, 342, 3, NULL, NULL, NULL, 2, 9, 2, 0, '1533886442.png', '1533886442.png', NULL, 'test', 0, 0, 0, '2018-08-10 07:34:03', '2018-08-10 07:34:03'),
(108, 1, 'dfg', '<p>dfg</p>', 'dfgd', 'dfg', 'dfg', 'dfg', 'dfgd', 'dfg', 'dfgdf', 'd', '4645', 455, 45, 4, NULL, NULL, NULL, 2, 9, 1, 0, '1533886590.png', '1533886591.png', NULL, 'dfg', 0, 0, 0, '2018-08-10 07:36:31', '2018-08-10 07:36:31'),
(109, 1, 'dfg', '<p>dfg</p>', 'dfgd', 'dfg', 'dfg', 'dfg', 'dfgd', 'dfg', 'dfgdf', 'd', '4645', 455, 45, 4, NULL, NULL, NULL, 2, 9, 1, 0, '1533886721.png', '1533886721.png', NULL, 'dfg-1', 0, 0, 0, '2018-08-10 07:38:42', '2018-08-10 07:38:42'),
(110, 1, 'sdf', '<p>sdf</p>', 'sdf', 'sdf', 'dsf', 'sadf', 'sdf', 'sdf', 'sdf', 'sdf', '324', 23, 23, 234, '1533886940.jpg', '23', '23', 2, 9, 1, 0, '1533886940.jpg', '1533886940.jpg', NULL, 'sdf', 0, 0, 0, '2018-08-10 07:42:21', '2018-08-10 07:42:21'),
(114, 1, 'tes', '<p>tes</p>', 'tes', 'tes', 'test', 'est', 'tes', 'test', 'etst', 'ets', '23', 23, 234, 234, NULL, NULL, NULL, 2, 9, 2, 0, '1533892704.jpg', '1533892705.png', NULL, 'tes-1', 0, 0, 0, '2018-08-10 09:18:25', '2018-08-10 09:18:25'),
(118, 1, 'abc', '<p>abc</p>', 'abc', 'abc', 'abc', 'abc', 'asd', 'asd', NULL, 'asd', '234', 234, 233, 23, '1533896901.jpg', '2', '2', 2, 9, 1, 0, '1533896902.jpg', '1533896902.jpg', NULL, 'abc', 0, 0, 0, '2018-08-10 10:28:22', '2018-08-10 10:28:22'),
(119, 1, 'sdfds', '<p>sdf</p>', 'sdfs', 'fsf', 'fsf', 'fsdfds', 'sdf', 'sffs', 'sdfs', 'fsdf', '4353', 3453, 340, 345, NULL, NULL, NULL, 2, 5, 2, 1, '1533904411.png', '1533904411.png', NULL, 'sdfds', 0, 0, 0, '2018-08-10 12:33:31', '2018-08-17 06:20:22'),
(120, 1, '3.5 mm thick tyre', '<p>3.5 mm thick tyre</p>', '3.5 mm thick tyre', '3.5 mm thick tyre', '3.5 mm thick tyre', '3.5 mm thick tyre', '3.5 mm thick tyre', '3.5 mm thick tyre', '3.5 mm thick tyre', '3.5 mm thick tyre', '1700', 120, 120, 0, NULL, NULL, NULL, 2, 18, 19, 0, '1533909296.jpg', '1533909297.jpg', NULL, '3-5-mm-thick-tyre', 0, 0, 0, '2018-08-10 13:54:57', '2018-08-31 14:00:12'),
(121, 1, '13-08', '<p>13-08</p>', '13-08', '13-08', '13-08', '13-08', '13-08', '13-08', '13-08', '13-08', '1200', 120, 120, 10, NULL, NULL, NULL, 2, 9, 2, 1, '1534136970.jpg', '1534136971.jpg', NULL, '13-08', 0, 0, 0, '2018-08-13 05:09:31', '2018-08-16 09:39:34'),
(122, 1, 'test', '<p>test</p>', 'test', 'test', 'set', 'test', 'sete', 'etst', 'et', 'tests', '34543', 4353, 3451, 2, NULL, NULL, NULL, 2, 9, 1, 0, '1534141241.jpg', '1534141241.jpg', NULL, 'test-1', 0, 0, 0, '2018-08-13 06:20:41', '2018-08-13 06:20:41'),
(123, 1, 'test', '<p>tet</p>', 'test', 'setset', 'set', 'sets', 'set', 'sets', 'set', 'sets', '1500', 45, 456, 434, NULL, NULL, NULL, 2, 9, 1, 0, '1534144896.jpg', '1534144896.jpg', NULL, 'test-2', 0, 0, 0, '2018-08-13 07:21:36', '2018-08-13 07:21:36'),
(127, 1, 'test', '<p>test</p>', 'test', 'tests', 'test', 'test', 'test', 'test', 'etst', 'tes', '12000', 122, 152, 8, NULL, NULL, NULL, 2, 9, 1, 0, NULL, NULL, NULL, 'test-3', 0, 0, 0, '2018-08-14 10:14:10', '2018-08-14 10:14:10'),
(129, 1, 'gdfgd', '<p>fgd</p>', 'dfgd', 'dfgdfgdf', 'gdfg', 'dfgd', 'gdfgdfg', 'dfgd', 'dfgdfgfdgdfg', 'dfg', '546', 456, 456, 456, NULL, NULL, NULL, 2, 5, 1, 0, '1534241872.jpg', '1534241873.jpg', NULL, 'gdfgd', 0, 0, 0, '2018-08-14 10:17:53', '2018-08-14 10:17:53'),
(130, 1, 'gdfgd', '<p>fgd</p>', 'dfgd', 'dfgdfgdf', 'gdfg', 'dfgd', 'gdfgdfg', 'dfgd', 'dfgdfgfdgdfg', 'dfg', '546', 456, 456, 456, NULL, NULL, NULL, 2, 5, 1, 0, '1534241973.jpg', '1534241974.jpg', NULL, 'gdfgd-1', 0, 0, 0, '2018-08-14 10:19:34', '2018-08-14 10:19:34'),
(131, 1, 'dsfa', '<p>asdf</p>', 'sadfasd', 'asdfa', 'faa', 'dsf', 'sdf', 'asdf', 'sdf', 'asdf', '4353', 435, 34543, 3453, NULL, NULL, NULL, 2, 9, 1, 0, '1534242415.jpg', '1534242415.jpg', NULL, 'dsfa', 0, 0, 0, '2018-08-14 10:26:56', '2018-08-14 10:26:56'),
(134, 1, 'tes', '<p>test</p>', 'test', 'ets', 'test', 'test', 'est', 'set', 'set', 'sett', '4353', 5, 342, 5, NULL, NULL, NULL, 2, 5, 2, 1, '1534249473.jpg', '1534249474.jpg', NULL, 'tes-5', 0, 0, 0, '2018-08-14 12:24:34', '2018-08-16 09:38:46'),
(135, 1, 'Black And White Shoes', '<p>Black And White Shoes</p>', 'Black And White Shoes', 'Black And White Shoes', 'Black And White Shoes', 'Black And White Shoes', 'Black And White Shoes', 'Black And White Shoes', 'Black And White Shoes', 'Black And White Shoes', '433', 34, 34, 3, NULL, NULL, NULL, 2, 23, 23, 1, '1534253916.jpeg', '1534253917.jpeg', NULL, 'black-and-white-shoes', 0, 0, 0, '2018-08-14 13:38:37', '2018-08-15 11:34:47'),
(136, 1, 'FODG Wrist Watche Blue', '<p>FODG Wrist Watche Blue</p>', 'FODG Wrist Watche Blue', 'FODG Wrist Watche Blue', 'FODG Wrist Watche Blue', 'FODG Wrist Watche Blue', 'FODG Wrist Watche Blue', 'FODG Wrist Watche Blue', 'FODG Wrist Watche Blue', 'FODG Wrist Watche Blue', '450', 50, 17, 0, NULL, NULL, NULL, 2, 24, 24, 1, '1534309992.jpg', '1534309993.jpg', NULL, 'fodg-wrist-watche-blue', 0, 0, 0, '2018-08-15 05:13:14', '2018-08-15 11:34:42'),
(137, 1, 'Golf Ball', '<p>Golf Ball</p>', 'Golf Ball', 'Golf Ball', 'Golf Ball', 'Golf Ball', 'Golf Ball', 'Golf Ball', 'Golf Ball', 'Golf Ball', '324', 234, 234, 4, NULL, NULL, NULL, 2, 25, 25, 1, NULL, '1534332680.jpg', NULL, 'golf-ball', 0, 0, 0, '2018-08-15 11:31:20', '2018-08-15 11:35:22'),
(138, 1, 'Front Wheel Tyre', '<p>Front Wheel Tyre</p>', 'Front Wheel Tyre', 'Front Wheel Tyre', 'Front Wheel Tyre', 'Front Wheel Tyre', 'Front Wheel Tyre', 'Front Wheel Tyre', 'Front Wheel Tyre', 'Front Wheel Tyre', '1500', 100, 1500, 0, NULL, NULL, NULL, 2, 18, 19, 0, '1534395672.jpg', '1534395673.jpg', NULL, 'front-wheel-tyre', 0, 0, 0, '2018-08-16 05:01:13', '2018-08-31 14:00:02'),
(140, 1, 'Harry potter', '<p>Harry Potter is a series of fantasy novels written by British author J. K. Rowling. The novels chronicle the lives of a young wizard, Harry Potter, and his friends Hermione Granger and Ron Weasley...</p>', 'Harry potter', 'Harry potter', 'Harry potter', 'Harry potter', 'Harry potter 1', 'Harry potter', 'Harry potter', 'Harry potter', '450', 50, 120, 1, NULL, NULL, NULL, 2, 17, 17, 1, '1534405769.jpg', '1534405769.jpg', NULL, 'harry-potter-1', 0, 0, 0, '2018-08-16 07:49:30', '2018-08-16 07:49:30'),
(141, 1, 'Red Lipsticks', '<p>Red Lipsticks</p>', 'Red Lipsticks', 'Red Lipsticks', 'Red Lipsticks', 'Red Lipsticks', 'Red Lipsticks', 'Red Lipsticks', 'Red Lipsticks', 'Red Lipsticks', '1520', 80, 48, NULL, NULL, NULL, NULL, 2, 12, 12, 1, '1534413544.jpg', '1534413545.jpg', NULL, 'red-lipsticks', 0, 0, 0, '2018-08-16 09:59:05', '2018-08-16 09:59:05'),
(142, 1, 'Adidas Sport T-shirt', '<p>Adidas Sport T-shirt</p>', 'Adidas Sport T-shirt', 'Adidas Sport T-shirt', 'Adidas Sport T-shirt', 'Adidas Sport T-shirt', 'Adidas Sport T-shirt', 'Adidas Sport T-shirt', 'Adidas Sport T-shirt', 'Adidas Sport T-shirt', '450', 50, 540, 0, NULL, NULL, NULL, 2, 15, 15, 1, '1534423880.jpg', '1534423880.jpg', NULL, 'adidas-sport-t-shirt', 0, 0, 0, '2018-08-16 12:51:20', '2018-08-16 12:51:20'),
(143, 1, 'Desk Keyboard', '<p>Desk Keyboard</p>', 'Desk Keyboard', 'Desk Keyboard', 'Desk Keyboard', 'Desk Keyboard', 'Desk Keyboard', 'Desk Keyboard', 'Desk Keyboard', 'Desk Keyboard', '1500', 50, 21, 2, NULL, NULL, NULL, 2, 14, 28, 1, '1534482504.jpg', '1534482505.jpg', NULL, 'desk-keyboard', 0, 0, 0, '2018-08-17 05:08:25', '2018-08-17 05:08:25'),
(144, 1, 'Wooden Dining Table Classic', '<p>Wooden Dining Table Classic</p>', 'Wooden Dining Table Classic', 'Wooden Dining Table Classic', 'Wooden Dining Table Classic', 'Wooden Dining Table Classic', 'Wooden Dining Table Classic', 'Wooden Dining Table Classic', 'Wooden Dining Table Classic', 'Wooden Dining Table Classic', '15999', 150, 5, 0, NULL, NULL, NULL, 2, 26, 26, 1, '1534483170.jpg', '1534483170.jpg', NULL, 'wooden-dining-table-classic', 0, 0, 0, '2018-08-17 05:19:30', '2018-08-17 05:19:30'),
(145, 1, 'Garden Water Can Plastic', '<p>Garden Water Can Plastic</p>', 'Garden Water Can Plastic', 'Garden Water Can Plastic', 'Garden Water Can Plastic', 'Garden Water Can Plastic', 'Garden Water Can Plastic', 'Garden Water Can Plastic', 'Garden Water Can Plastic', 'Garden Water Can Plastic', '350', 50, 1, 0, NULL, NULL, NULL, 2, 27, 27, 1, '1534483938.jpg', '1534483938.jpg', NULL, 'garden-water-can-plastic', 0, 0, 0, '2018-08-17 05:32:18', '2018-08-17 05:32:18'),
(146, 1, 'Rostaa Almonds', '<p>Rostaa Almonds</p>', 'Rostaa Almonds', 'Rostaa Almonds', 'Rostaa Almonds', 'Rostaa Almonds', 'Rostaa Almonds', 'Rostaa Almonds', 'Rostaa Almonds', 'Rostaa Almonds', '450', 50, 43, 0, NULL, NULL, NULL, 2, 28, 29, 1, '1534484958.jpg', '1534484958.jpg', NULL, 'rostaa-almonds', 0, 0, 0, '2018-08-17 05:49:18', '2018-08-17 05:49:18'),
(147, 1, 'Philips Led Tube ligth', '<p>Philips Led Tube ligth</p>', 'Philips Led Tube ligth', 'Philips Led Tube ligth', 'Philips Led Tube ligth', 'Philips Led Tube ligth', 'Philips Led Tube ligth', 'Philips Led Tube ligth', 'Philips Led Tube ligth', 'Philips Led Tube ligth', '450', 50, 45, 2, NULL, NULL, NULL, 2, 29, 30, 1, '1534487335.jpg', '1534487336.jpg', NULL, 'philips-led-tube-ligth', 0, 0, 0, '2018-08-17 06:28:56', '2018-08-17 06:28:56'),
(148, 1, 'Taniqsh  Wedding Ring For Men', '<p>Taniqsh Wedding Ring For Men</p>', 'Taniqsh  Wedding Ring For Men', 'Taniqsh  Wedding Ring For Men', 'Taniqsh  Wedding Ring For Men', 'Taniqsh  Wedding Ring For Men', 'Taniqsh  Wedding Ring For Men', 'Taniqsh  Wedding Ring For Men', 'Taniqsh  Wedding Ring For Men', 'Taniqsh  Wedding Ring For Men', '13000', 450, 45, 0, NULL, NULL, NULL, 2, 19, 20, 1, NULL, NULL, NULL, 'taniqsh-wedding-ring-for-men', 0, 0, 0, '2018-08-17 06:57:11', '2018-08-17 06:57:11'),
(149, 1, '150 ton Mitsubishi AC', '<p>150 ton Mitsubishi AC</p>', '150 ton Mitsubishi AC', '150 ton Mitsubishi AC', '150 ton Mitsubishi AC', '150 ton Mitsubishi AC', '150 ton Mitsubishi AC', '150 ton Mitsubishi AC', '150 ton Mitsubishi AC', '150 ton Mitsubishi AC', '1520', 140, 20, 0, NULL, NULL, NULL, 2, 7, 6, 1, '1534503844.jpg', '1534503844.jpg', NULL, '150-ton-mitsubishi-ac', 0, 0, 0, '2018-08-17 11:04:04', '2018-08-17 11:04:04'),
(150, 1, 'American tourister Red Bag', '<p>American tourister Red Bag</p>', 'American tourister Red Bag', 'American tourister Red Bag', 'American tourister Red Bag', 'American tourister Red Bag', 'American tourister Red Bag', 'American tourister Red Bag', 'American tourister Red Bag', 'American tourister Red Bag', '4570', 30, 456, 3, NULL, NULL, NULL, 2, 30, 31, 1, '1534504445.jpg', '1534504445.jpg', NULL, 'american-tourister-red-bag', 0, 0, 0, '2018-08-17 11:14:05', '2018-08-17 11:14:05'),
(151, 1, 'Quality Guitar', '<p>Quality Guitar</p>', 'Quality Guitar', 'Quality Guitar', 'Quality Guitar', 'Quality Guitar', 'Quality Guitar', 'Quality Guitar', 'Quality Guitar', 'Quality Guitar', '3453', 24, 34, 3, NULL, NULL, NULL, 2, 31, 32, 1, '1534504979.jpg', '1534504980.jpg', NULL, 'quality-guitar', 0, 0, 0, '2018-08-17 11:23:00', '2018-08-17 11:23:00'),
(152, 1, 'Natraj Pens', '<p>Natraj Pens</p>', 'Natraj Pens', 'Natraj Pens', 'Natraj Pens', 'Natraj Pens', 'Natraj Pens', 'Natraj Pens', 'Natraj Pens', 'Natraj Pens', '456', 43, 43, 44, NULL, NULL, NULL, 2, 20, 21, 1, '1534505392.jpg', '1534505393.jpg', NULL, 'natraj-pens', 0, 0, 0, '2018-08-17 11:29:53', '2018-08-17 11:29:53'),
(153, 1, 'Pedigree', '<p>Pedigree</p>', 'Pedigree', 'Pedigree', 'Pedigree', 'Pedigree', 'Pedigree', 'Pedigree', 'Pedigree', 'Pedigree', '4000', 110, 45, 0, NULL, NULL, NULL, 2, 22, 22, 1, '1534506725.jpg', '1534506725.jpg', NULL, 'pedigree', 0, 0, 0, '2018-08-17 11:52:05', '2018-08-17 11:52:05'),
(154, 1, 'Lotto Shoes Black', '<p>Lotto Shoes Black</p>', 'Lotto Shoes Black', 'Lotto Shoes Black', 'Lotto Shoes Black', 'Lotto Shoes Black', 'Lotto Shoes Black', 'Lotto Shoes Black', 'Lotto Shoes Black', 'Lotto Shoes Black', '990', 45, 45, 2, NULL, NULL, NULL, 2, 23, 23, 1, '1534507909.jpg', '1534507909.jpg', NULL, 'lotto-shoes-black', 0, 0, 0, '2018-08-17 12:11:49', '2018-08-17 12:11:49'),
(155, 1, 'Fodg Watch', '<p>Fodg Watch</p>', 'Fodg Watch', 'Fodg Wat Fodg Watchch', 'Fodg Watch', 'Fodg Watch', 'Fodg Watch', 'Fodg Watch', 'Fodg Watch', 'Fodg Watch', '555', 34, 45, 4, NULL, NULL, NULL, 2, 24, 24, 1, '1534509230.jpg', '1534509230.jpg', NULL, 'fodg-watch', 0, 0, 0, '2018-08-17 12:33:51', '2018-08-17 12:33:51'),
(156, 1, 'Maruti suzuki Wheels', '<p>Maruti suzuki Wheels</p>', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', '110000', 4, 150, NULL, NULL, NULL, NULL, 2, 18, 19, 0, '1535627379.jpg', '1535627380.jpg', NULL, 'maruti-suzuki-wheels', 0, 0, 0, '2018-08-30 11:09:40', '2018-08-31 13:59:28'),
(157, 1, 'Maruti suzuki Wheels', '<p>Maruti suzuki Wheels</p>', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', 'Maruti suzuki Wheels', '110000', 4, 150, NULL, NULL, NULL, NULL, 2, 18, 19, 0, '1535627406.jpg', '1535627407.jpg', NULL, 'maruti-suzuki-wheels-1', 0, 0, 0, '2018-08-30 11:10:07', '2018-08-31 13:59:15'),
(158, 1, 'sdfsf', '<p>sdfds</p>', 'sdfs', 'f', 'fdsfdsfdsf', 'sdfdsf', 'sf', 'sdf', 'sdfs', 'dsfs', '5', 3, 4353, 2342, NULL, NULL, NULL, 2, 18, 19, 0, '1535627645.png', '1535627646.jpg', NULL, 'sdfsf', 0, 0, 0, '2018-08-30 11:14:06', '2018-08-30 11:14:06'),
(159, 1, 'test', '<p>sdfds</p>', 'sdfs', 'f', 'fdsfdsfdsf', 'sdfdsf', 'sf', 'sdf', 'sdfs', 'dsfs', '5', 3, 4353, 2342, NULL, NULL, NULL, 2, 18, 19, 0, '1535627823.png', '1535627823.jpg', NULL, 'ishwar', 0, 0, 0, '2018-08-30 11:17:03', '2018-08-31 10:54:33'),
(160, 1, 'Bikes And Tractor Tyres Slider', '<p>Bikes And Tractor Tyres Slider</p>', 'Bikes And Tractor Tyres Slider', 'Bikes And Tractor Tyres Slider', 'Bikes And Tractor Tyres Slider', 'Bikes And Tractor Tyres Slider', 'Bikes And Tractor Tyres Slider', 'Bikes And Tractor Tyres Slider', 'Bikes And Tractor Tyres Slider', 'Bikes And Tractor Tyres Slider', '15000', 150, 16, 1, NULL, NULL, NULL, 2, 18, 19, 0, '1535712680.jpg', '1535712681.jpg', NULL, 'bikes-and-tractor-tyres-slider', 1, 1, 1, '2018-08-31 10:51:21', '2018-09-05 13:39:57'),
(162, 1, 'test', '<p>test</p>', 'test', 'etst', 'etst', 'test', 'test', 'etst', 'tests', 'ets', '160000', 18, 5, 2, NULL, NULL, NULL, 2, 18, 19, 0, '1536130985.jpg', '1536130986.jpg', NULL, 'test-5', 0, 0, 0, '2018-09-05 07:03:06', '2018-09-05 13:38:49'),
(163, 1, 'test', '<p>test</p>', 'ett', 'etwt', 'ests', 'est', 'we', 'ewtw', 'ewtwtw', 'wetwtw', '6', 3, 2, 4, NULL, NULL, NULL, 2, 18, 19, 1, '1536152415.png', '1536152417.png', NULL, 'test-5', 0, 0, 0, '2018-09-05 13:00:17', '2018-09-05 13:00:17'),
(164, 1, 'tetst', '<p>test</p>', 'ett', 'etwt', 'ests', 'est', 'we', 'ewtw', 'ewtwtw', 'wetwtw', '6', 3, 2, 4, NULL, NULL, NULL, 2, 18, 19, 0, '1536152507.jpg', '1536152508.jpg', NULL, 'tetst', 0, 0, 0, '2018-09-05 13:01:48', '2018-09-05 13:38:29'),
(165, 1, 'TVS Tyre Tube', '<p>TVS Tyre Tube</p>', 'TVS Tyre Tube', 'TVS Tyre Tube', 'TVS Tyre Tube', 'TVS Tyre Tube', 'TVS Tyre Tube', 'TVS Tyre Tube', 'TVS Tyre Tube', 'TVS Tyre Tube', '1700', 50, 6, NULL, NULL, NULL, NULL, 2, 18, 19, 1, '1536155405.jpg', '1536155405.jpg', NULL, 'tvs-tyre-tube', 0, 0, 0, '2018-09-05 13:50:05', '2018-09-05 13:50:05'),
(166, 58, 'Cotton Casual Shirt for Men', '<ul class=\"a-unordered-list a-vertical a-spacing-none\">\r\n<li><span class=\"a-list-item\">Material - Cotton, extremely soft finish and rich look</span></li>\r\n<li><span class=\"a-list-item\">Stylish slim collar casual shirt for men</span></li>\r\n<li><span class=\"a-list-item\">Modern slim fit</span></li>\r\n<li><span class=\"a-list-item\">Best for casual and smart casual wear</span></li>\r\n</ul>\r\n<div id=\"descriptionAndDetails\" class=\"a-section a-spacing-extra-large\">\r\n<div id=\"dp_productDescription_container_div\" class=\"feature\" data-feature-name=\"productDescription\" data-cel-widget=\"dp_productDescription_container_div\">\r\n<div id=\"productDescription_feature_div\" class=\"a-row feature\" data-feature-name=\"productDescription\" data-template-name=\"productDescription\" data-cel-widget=\"productDescription_feature_div\">\r\n<div id=\"productDescription\" class=\"a-section a-spacing-small\">\r\n<p>This is designed as per the latest trends to keep you in sync with high fashion and with wedding and other occasion, it will keep you comfortable all day long. The lovely design forms a substantial feature of this wear.It looks stunning every time you match it with accessories. Disclaimer: product colour may slightly vary due to photographic lighting sources or your monitor settings.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"dpx-aplus-product-description_feature_div\">\r\n<div id=\"aplus_feature_div\" class=\"feature\" data-feature-name=\"aplus\" data-cel-widget=\"aplus_feature_div\">\r\n<div id=\"aplus\" class=\"a-section a-spacing-extra-large bucket\">&nbsp;</div>\r\n</div>\r\n</div>', 'Cotton Casual Shirt for Men', 'This is designed as per the latest trends to keep you in sync with high fashion and with wedding and other occasion, it will keep you comfortable all day long. The lovely design forms a substantial feature of this wear.It looks stunning every time you match it with accessories. Disclaimer: product colour may slightly vary due to photographic lighting sources or your monitor settings.', 'Cotton Casual Shirt for Men', 'Cotton Casual Shirt for Men', 'Cotton Casual Shirt for Men', '456788', NULL, NULL, '250', 30, 100, NULL, NULL, NULL, NULL, NULL, 16, 16, 1, '1536217037.jpg', '1536217038.jpg', NULL, 'cotton-casual-shirt-for-men', 1, 1, 1, '2018-09-06 08:27:18', '2018-10-19 22:04:36'),
(167, 65, 'Michelin', 'Michelin tyre', 'Michelin tyre', 'none', 'tyre', 'tyre, tyres', 'M21', 'Skwa', '124', '1245-452F-45AS', '2496', 150, 50, 5, NULL, NULL, NULL, 2, 18, 19, 0, '1540800080.png', NULL, NULL, 'michelin', 0, 0, 0, '2018-10-29 12:31:26', '2018-10-29 12:31:26');

-- --------------------------------------------------------

--
-- Structure de la table `products_sliders`
--

CREATE TABLE `products_sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `main_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products_sliders`
--

INSERT INTO `products_sliders` (`id`, `main_slider`, `sidebar_slider`, `url`, `created_at`, `updated_at`) VALUES
(1, NULL, 'FVcSE1525519810.jpg', NULL, '2018-05-05 13:00:10', '2018-05-05 13:00:10'),
(3, 'mTTaV1525520012.jpg', NULL, '#', '2018-05-05 13:03:32', '2018-05-05 13:03:32');

-- --------------------------------------------------------

--
-- Structure de la table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `image_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `name`, `desc`, `desc2`, `product_price`, `image_id`, `slug`, `created_at`, `updated_at`) VALUES
(197, 49, 'color', '#0f0004', NULL, NULL, NULL, 'color', '2018-07-21 19:12:53', '2018-07-21 19:12:53'),
(198, 49, 'color', '#ab2800', NULL, NULL, NULL, 'color', '2018-07-21 19:12:53', '2018-07-21 19:12:53'),
(199, 49, 'color', '#003fad', NULL, NULL, NULL, 'color', '2018-07-21 19:12:53', '2018-07-21 19:12:53'),
(200, 49, 'size', 'Small', NULL, NULL, NULL, 'size', '2018-07-21 19:12:53', '2018-07-21 19:12:53'),
(201, 49, 'size', 'Medium', NULL, NULL, NULL, 'size', '2018-07-21 19:12:53', '2018-07-21 19:12:53'),
(202, 49, 'size', 'Large', NULL, NULL, NULL, 'size', '2018-07-21 19:12:53', '2018-07-21 19:12:53'),
(203, 49, 'Occassion', 'The Stylish and High Quality dress shirt is breathable,Anti-wrinkle,not pilling and fade ;The slim fit button down shirts for men has exquisite craft.', NULL, NULL, NULL, 'occassion', '2018-07-21 19:12:53', '2018-07-21 19:12:53'),
(204, 49, 'Material', 'Cotton', NULL, NULL, NULL, 'material', '2018-07-21 19:12:53', '2018-07-21 19:12:53'),
(305, 50, 'Publisher', 'Jaico', NULL, NULL, NULL, 'publisher', '2018-07-24 16:57:35', '2018-07-24 16:57:35'),
(306, 50, 'ISBN-10', '8179925919', NULL, NULL, NULL, 'isbn-10', '2018-07-24 16:57:35', '2018-07-24 16:57:35'),
(307, 50, 'ISBN-13', '978-8179925911', NULL, NULL, NULL, 'isbn-13', '2018-07-24 16:57:35', '2018-07-24 16:57:35'),
(308, 50, 'Paperpack', '140 Pages', NULL, NULL, NULL, 'paperpack', '2018-07-24 16:57:35', '2018-07-24 16:57:35'),
(309, 50, 'Product Dimensions', '12.7 x 1.3 x 21 cm', NULL, NULL, NULL, 'product-dimensions-2', '2018-07-24 16:57:35', '2018-07-24 16:57:35'),
(310, 50, 'Author', 'Stephen Hawking', NULL, NULL, NULL, 'author', '2018-07-24 16:57:35', '2018-07-24 16:57:35'),
(313, 34, 'color', '#0088cc', NULL, NULL, NULL, 'color', '2018-07-27 05:46:20', '2018-07-27 05:46:20'),
(314, 34, 'OS', 'iOS', NULL, NULL, NULL, 'os-3', '2018-07-27 05:46:20', '2018-07-27 05:46:20'),
(315, 34, 'RAM', '1 GB', NULL, NULL, NULL, 'ram-3', '2018-07-27 05:46:20', '2018-07-27 05:46:20'),
(316, 34, 'Item Weight', '127 g', NULL, NULL, NULL, 'item-weight', '2018-07-27 05:46:20', '2018-07-27 05:46:20'),
(317, 34, 'Product Dimensions', '13.8 x 0.7 x 6.7 cm', NULL, NULL, NULL, 'product-dimensions-2', '2018-07-27 05:46:20', '2018-07-27 05:46:20'),
(318, 34, 'Batteries', '1 Lithium Polymer batteries required. (included)', NULL, NULL, NULL, 'batteries', '2018-07-27 05:46:20', '2018-07-27 05:46:20'),
(319, 34, 'Item model number', 'iPhone 6', NULL, NULL, NULL, 'item-model-number', '2018-07-27 05:46:20', '2018-07-27 05:46:20'),
(320, 34, 'Wireless communication technologies', 'Bluetooth, WiFi Hotspot', NULL, NULL, NULL, 'wireless-communication-technologies', '2018-07-27 05:46:20', '2018-07-27 05:46:20'),
(333, 58, 'brand_size', '1200', NULL, NULL, NULL, 'brand-size', '2018-07-31 11:29:00', '2018-07-31 11:29:00'),
(346, 60, 'brand_size', '1200', NULL, NULL, NULL, 'brand-size-1', '2018-07-31 11:51:26', '2018-07-31 11:51:26'),
(347, 61, 'brand_size', '1200', NULL, NULL, NULL, 'brand-size-2', '2018-07-31 11:57:11', '2018-07-31 11:57:11'),
(348, 62, 'brand_size', '1200', NULL, NULL, NULL, 'brand-size-3', '2018-07-31 11:58:28', '2018-07-31 11:58:28'),
(349, 63, 'brand_size', '1200', NULL, NULL, NULL, 'brand-size-4', '2018-07-31 11:59:49', '2018-07-31 11:59:49'),
(350, 64, 'brand_size', '1200', NULL, NULL, NULL, 'brand-size-5', '2018-07-31 12:00:04', '2018-07-31 12:00:04'),
(351, 65, 'OS', 'iOS', NULL, NULL, NULL, 'os-4', '2018-07-31 12:00:57', '2018-07-31 12:00:57'),
(352, 65, 'RAM', '1 GB', NULL, NULL, NULL, 'ram-4', '2018-07-31 12:00:57', '2018-07-31 12:00:57'),
(353, 65, 'Item Weight', '127 g', NULL, NULL, NULL, 'item-weight-1', '2018-07-31 12:00:57', '2018-07-31 12:00:57'),
(354, 65, 'Product Dimensions', '13.8 x 0.7 x 6.7 cm', NULL, NULL, NULL, 'product-dimensions-3', '2018-07-31 12:00:57', '2018-07-31 12:00:57'),
(355, 65, 'Batteries', '1 Lithium Polymer batteries required. (included)', NULL, NULL, NULL, 'batteries-1', '2018-07-31 12:00:57', '2018-07-31 12:00:57'),
(356, 65, 'Item model number', 'iPhone 6', NULL, NULL, NULL, 'item-model-number-1', '2018-07-31 12:00:57', '2018-07-31 12:00:57'),
(357, 65, 'Wireless communication technologies', 'Bluetooth, WiFi Hotspot', NULL, NULL, NULL, 'wireless-communication-technologies-1', '2018-07-31 12:00:57', '2018-07-31 12:00:57'),
(385, 77, 'color', '#2ea300', NULL, 1500, NULL, 'color', '2018-08-07 10:14:50', '2018-08-07 10:14:50'),
(386, 77, 'color', '#fa0000', NULL, 1999, NULL, 'color', '2018-08-07 10:14:50', '2018-08-07 10:14:50'),
(606, 106, 'color', '#0088cc', NULL, 3453, '', 'color', '2018-08-10 06:33:18', '2018-08-10 06:33:18'),
(607, 106, 'size', 'xl', NULL, NULL, '', 'size', '2018-08-10 06:33:18', '2018-08-10 06:33:18'),
(608, 106, 'size', 'xxl', NULL, NULL, '', 'size', '2018-08-10 06:33:18', '2018-08-10 06:33:18'),
(609, 106, 'size_color', '#00ab67', '12', 12000, '89', 'size_color', '2018-08-10 06:33:18', '2018-08-10 06:33:18'),
(610, 106, 'size_color', '#0088cc', '13', 13000, '90', 'size_color', '2018-08-10 06:33:19', '2018-08-10 06:33:19'),
(611, 106, 'scent_name', 'scent1', NULL, 1200, '91', 'scent_name', '2018-08-10 06:33:20', '2018-08-10 06:33:20'),
(612, 106, 'scent_name', 'scent2', NULL, 1300, '92', 'scent_name', '2018-08-10 06:33:20', '2018-08-10 06:33:20'),
(613, 106, 'size_scent_name', 'size-scent1', '2', 2000, '93', 'size_scent_name', '2018-08-10 06:33:21', '2018-08-10 06:33:21'),
(614, 106, 'size_scent_name', 'size-scent2', '4', 4000, '94', 'size_scent_name', '2018-08-10 06:33:21', '2018-08-10 06:33:21'),
(615, 107, 'paperback', 'paperback1', NULL, 120, '95', 'paperback', '2018-08-10 07:34:03', '2018-08-10 07:34:03'),
(616, 107, 'paperback', 'paperback2', NULL, 140, '96', 'paperback', '2018-08-10 07:34:03', '2018-08-10 07:34:03'),
(617, 107, 'hardcover', 'Hardcover1', NULL, 100, '', 'hardcover', '2018-08-10 07:34:03', '2018-08-10 07:34:03'),
(618, 107, 'hardcover', 'Hardcover2', NULL, 200, '', 'hardcover', '2018-08-10 07:34:03', '2018-08-10 07:34:03'),
(619, 108, 'paperback', 'paperback1', NULL, 1, '97', 'paperback', '2018-08-10 07:36:31', '2018-08-10 07:36:31'),
(620, 108, 'paperback', 'paperback2', NULL, 2, '98', 'paperback', '2018-08-10 07:36:32', '2018-08-10 07:36:32'),
(621, 108, 'hardcover', 'hardcover1', NULL, 1, '', 'hardcover', '2018-08-10 07:36:32', '2018-08-10 07:36:32'),
(622, 108, 'hardcover', 'hardcover2', NULL, 2, '', 'hardcover', '2018-08-10 07:36:32', '2018-08-10 07:36:32'),
(623, 110, 'paperback', 'paper1', NULL, 1, '99', 'paperback', '2018-08-10 07:42:21', '2018-08-10 07:42:21'),
(624, 110, 'paperback', 'paper2', NULL, 2, '100', 'paperback', '2018-08-10 07:42:22', '2018-08-10 07:42:22'),
(625, 110, 'hardcover', 'hard1', NULL, 1, '101', 'hardcover', '2018-08-10 07:42:22', '2018-08-10 07:42:22'),
(626, 110, 'hardcover', 'hard2', NULL, 2, '102', 'hardcover', '2018-08-10 07:42:23', '2018-08-10 07:42:23'),
(627, 110, 'audiocd', 'cd1', NULL, 1, '103', 'audiocd', '2018-08-10 07:42:23', '2018-08-10 07:42:23'),
(642, 114, 'paperback', 'Paperback1', NULL, 1200, '116', 'paperback', '2018-08-10 09:18:25', '2018-08-10 09:18:25'),
(643, 114, 'paperback', 'paperback2', NULL, 1363, '117', 'paperback', '2018-08-10 09:18:26', '2018-08-10 09:18:26'),
(644, 114, 'hardcover', 'Hardcover', NULL, 1198, '', 'hardcover', '2018-08-10 09:18:26', '2018-08-10 09:18:26'),
(645, 114, 'audiocd', 'CD1', NULL, 125, '118', 'audiocd', '2018-08-10 09:18:26', '2018-08-10 09:18:26'),
(646, 114, 'audiocd', 'CD2', NULL, 152, '', 'audiocd', '2018-08-10 09:18:26', '2018-08-10 09:18:26'),
(659, 118, 'pattern', 'pattern1', NULL, 15800, '132', 'pattern', '2018-08-10 10:28:23', '2018-08-10 10:28:23'),
(660, 118, 'pattern', 'pattern2', NULL, 15000, '133', 'pattern', '2018-08-10 10:28:23', '2018-08-10 10:28:23'),
(661, 118, 'cup_size', 'small cup', NULL, 12, '134', 'cup_size', '2018-08-10 10:28:24', '2018-08-10 10:28:24'),
(662, 118, 'cup_size', 'meduim cup', NULL, 18, '135', 'cup_size', '2018-08-10 10:28:24', '2018-08-10 10:28:24'),
(663, 118, 'cup_size', 'large cup', NULL, 22, '136', 'cup_size', '2018-08-10 10:28:25', '2018-08-10 10:28:25'),
(664, 118, 'cup_size_color', 'small cup', '#ff0900', 16, '137', 'cup_size_color', '2018-08-10 10:28:25', '2018-08-10 10:28:25'),
(665, 118, 'cup_size_color', 'medium cup', '#00cf1f', 20, '138', 'cup_size_color', '2018-08-10 10:28:26', '2018-08-10 10:28:26'),
(666, 118, 'cup_size_color', 'Big cup', '#d1d100', 25, '139', 'cup_size_color', '2018-08-10 10:28:26', '2018-08-10 10:28:26'),
(667, 119, 'color_lens_width', '#0088cc', '12', 1231212, '140', 'color_lens_width', '2018-08-10 12:33:32', '2018-08-10 12:33:32'),
(668, 119, 'color_lens_width', '#0088cc', '13', 123131, '141', 'color_lens_width', '2018-08-10 12:33:32', '2018-08-10 12:33:32'),
(669, 119, 'color_magnification_strength', '12', NULL, NULL, '', 'color_magnification_strength', '2018-08-10 12:33:32', '2018-08-10 12:33:32'),
(670, 119, 'color_magnification_strength', '15', NULL, NULL, '', 'color_magnification_strength', '2018-08-10 12:33:33', '2018-08-10 12:33:33'),
(671, 119, 'lens_color', '#0088cc', NULL, 12312, '142', 'lens_color', '2018-08-10 12:33:33', '2018-08-10 12:33:33'),
(672, 119, 'lens_color', '#009c37', NULL, 234234, '143', 'lens_color', '2018-08-10 12:33:33', '2018-08-10 12:33:33'),
(673, 121, 'color_material', '#0088cc', 'material1', 12000, '144', 'color_material', '2018-08-13 05:09:32', '2018-08-13 05:09:32'),
(674, 121, 'color_material', '#0088cc', 'material2', 12050, '145', 'color_material', '2018-08-13 05:09:33', '2018-08-13 05:09:33'),
(675, 122, 'product_flavor', 'flavor1', NULL, 12, '146', 'product_flavor', '2018-08-13 06:20:42', '2018-08-13 06:20:42'),
(676, 122, 'product_flavor', 'flavor2', NULL, 13, '147', 'product_flavor', '2018-08-13 06:20:42', '2018-08-13 06:20:42'),
(677, 122, 'product_weight', '50gm', NULL, 13, '148', 'product_weight', '2018-08-13 06:20:43', '2018-08-13 06:20:43'),
(678, 122, 'product_weight', '60gm', NULL, 15, '149', 'product_weight', '2018-08-13 06:20:43', '2018-08-13 06:20:43'),
(679, 122, 'flavor_size', 'Orange', '12 size', 15, '150', 'flavor_size', '2018-08-13 06:20:44', '2018-08-13 06:20:44'),
(680, 122, 'flavor_size', 'Blue', '13 size', 16, '151', 'flavor_size', '2018-08-13 06:20:44', '2018-08-13 06:20:44'),
(681, 122, 'flavor_weight', 'FlavorWeight1', '500gm', 12500, '152', 'flavor_weight', '2018-08-13 06:20:45', '2018-08-13 06:20:45'),
(682, 122, 'flavor_weight', 'FlavorWeight2', '1kg', 25000, '153', 'flavor_weight', '2018-08-13 06:20:45', '2018-08-13 06:20:45'),
(683, 123, 'product_material', 'abc Material', NULL, 150, '154', 'product_material', '2018-08-13 07:21:37', '2018-08-13 07:21:37'),
(684, 123, 'product_material', 'xyz Material', NULL, 152, '', 'product_material', '2018-08-13 07:21:37', '2018-08-13 07:21:37'),
(685, 123, 'product_material_size', 'Material Size 1', 'xl', 1500, '', 'product_material_size', '2018-08-13 07:21:37', '2018-08-13 07:21:37'),
(686, 123, 'product_material_size', 'Material Size 2', 'xxl', 14200, '', 'product_material_size', '2018-08-13 07:21:37', '2018-08-13 07:21:37'),
(745, 127, 'metaltype', 'Metaltype 1', NULL, 12000, '192', 'metaltype', '2018-08-14 10:14:11', '2018-08-14 10:14:11'),
(746, 127, 'metaltype', 'Metaltype 2', NULL, 13000, '193', 'metaltype', '2018-08-14 10:14:11', '2018-08-14 10:14:11'),
(747, 127, 'sizeperpearl', 'sizeperpearl 1', NULL, 15000, '194', 'sizeperpearl', '2018-08-14 10:14:12', '2018-08-14 10:14:12'),
(748, 127, 'sizeperpearl', 'sizeperpearl 2', NULL, 16000, '195', 'sizeperpearl', '2018-08-14 10:14:12', '2018-08-14 10:14:12'),
(749, 127, 'color_metaltype', '#00b32a', 'color metaltype 1', 2000, '196', 'color_metaltype', '2018-08-14 10:14:13', '2018-08-14 10:14:13'),
(750, 127, 'color_metaltype', '#0088cc', 'color metaltype 2', 2997, '197', 'color_metaltype', '2018-08-14 10:14:13', '2018-08-14 10:14:13'),
(751, 127, 'color_itemlength', '#0088cc', 'item length 1', 1200, '', 'color_itemlength', '2018-08-14 10:14:13', '2018-08-14 10:14:13'),
(752, 127, 'color_itemlength', '#0088cc', 'item length 2', 1300, '', 'color_itemlength', '2018-08-14 10:14:13', '2018-08-14 10:14:13'),
(753, 127, 'gem_type', 'Gem type 1', NULL, 15200, '198', 'gem_type', '2018-08-14 10:14:14', '2018-08-14 10:14:14'),
(754, 127, 'gem_type', 'Gem type 2', NULL, 12500, '199', 'gem_type', '2018-08-14 10:14:14', '2018-08-14 10:14:14'),
(755, 127, 'metaltype_gemtype', 'Metal Type 1', 'Gem type1', 12500, '200', 'metaltype_gemtype', '2018-08-14 10:14:14', '2018-08-14 10:14:14'),
(756, 127, 'metaltype_gemtype', 'Metal Type 2', 'Gem type2', 1000, '201', 'metaltype_gemtype', '2018-08-14 10:14:15', '2018-08-14 10:14:15'),
(757, 127, 'total_gemweight', 'Total Gem Weight 100', NULL, 15200, '', 'total_gemweight', '2018-08-14 10:14:15', '2018-08-14 10:14:15'),
(758, 127, 'total_gemweight', 'Total Gem Weight 200', NULL, 32000, '', 'total_gemweight', '2018-08-14 10:14:15', '2018-08-14 10:14:15'),
(759, 127, 'total_diamondweight', 'TotalDiamond Weight 100', NULL, 100, '202', 'total_diamondweight', '2018-08-14 10:14:15', '2018-08-14 10:14:15'),
(760, 127, 'total_diamondweight', 'TotalDiamond Weight 100', NULL, 2000, '203', 'total_diamondweight', '2018-08-14 10:14:16', '2018-08-14 10:14:16'),
(761, 127, 'metaltype_totaldiamondweight', 'MetalType1', 'TotalDiamondWeight1', 100, '204', 'metaltype_totaldiamondweight', '2018-08-14 10:14:16', '2018-08-14 10:14:16'),
(762, 127, 'metaltype_totaldiamondweight', 'MetalType2', 'TotalDiamondWeight2', 100, '205', 'metaltype_totaldiamondweight', '2018-08-14 10:14:17', '2018-08-14 10:14:17'),
(763, 127, 'itemlength_gemtype', 'ItemLength 1', 'Gemtype 1', 1000, '206', 'itemlength_gemtype', '2018-08-14 10:14:17', '2018-08-14 10:14:17'),
(764, 127, 'itemlength_gemtype', 'ItemLength 2', 'Gemtype 2', 15200, '207', 'itemlength_gemtype', '2018-08-14 10:14:18', '2018-08-14 10:14:18'),
(765, 127, 'itemlength_material', 'ItemLength 1', 'Material 1', 1200, '', 'itemlength_material', '2018-08-14 10:14:18', '2018-08-14 10:14:18'),
(766, 127, 'itemlength_material', 'ItemLength 2', 'Material 2', 1500, '', 'itemlength_material', '2018-08-14 10:14:18', '2018-08-14 10:14:18'),
(767, 127, 'itemlength_sizeperpearl', 'ItemLength 1', NULL, 1200, '', 'itemlength_sizeperpearl', '2018-08-14 10:14:18', '2018-08-14 10:14:18'),
(768, 127, 'itemlength_sizeperpearl', 'ItemLength 2', NULL, 15200, '', 'itemlength_sizeperpearl', '2018-08-14 10:14:18', '2018-08-14 10:14:18'),
(769, 130, 'itemlength_totaldiamondweight', '456', '4465654', 646, '208', 'itemlength_totaldiamondweight', '2018-08-14 10:19:34', '2018-08-14 10:19:34'),
(770, 131, 'itemlength_metaltype', 'ItemLength', 'MetalType', 234424, '209', 'itemlength_metaltype', '2018-08-14 10:26:56', '2018-08-14 10:26:56'),
(771, 131, 'itemlength_totaldiamondweight', 'ItemLength', 'TotalDiamondWeight', 4243, '210', 'itemlength_totaldiamondweight', '2018-08-14 10:26:57', '2018-08-14 10:26:57'),
(772, 131, 'item_length', 'ItemLength', NULL, 223, '211', 'item_length', '2018-08-14 10:26:57', '2018-08-14 10:26:57'),
(773, 131, 'ring_size', 'RingSize', NULL, 354435, '212', 'ring_size', '2018-08-14 10:26:57', '2018-08-14 10:26:57'),
(774, 131, 'metaltype_ringsize', 'MetalType', 'RingSize', 34533, '', 'metaltype_ringsize', '2018-08-14 10:26:57', '2018-08-14 10:26:57'),
(775, 131, 'color_ringsize', '#0088cc', 'RingSize', 2342, '213', 'color_ringsize', '2018-08-14 10:26:58', '2018-08-14 10:26:58'),
(776, 131, 'ringsize_gemtype', 'RingSize', 'GemType', 23424, '214', 'ringsize_gemtype', '2018-08-14 10:26:58', '2018-08-14 10:26:58'),
(777, 131, 'ringsize_totaldiamondweight', 'RingSize', 'TotalDiamondWeight', 54355, '215', 'ringsize_totaldiamondweight', '2018-08-14 10:26:59', '2018-08-14 10:26:59'),
(789, 134, 'number_of_items', 'Number Of Items', NULL, 1, '225', 'number_of_items', '2018-08-14 12:24:34', '2018-08-14 12:24:34'),
(790, 134, 'paper_size', 'Paper Size', NULL, 23, '226', 'paper_size', '2018-08-14 12:24:35', '2018-08-14 12:24:35'),
(791, 134, 'maximum_expandable_size', 'Maximum Expandable Size', NULL, 32, '227', 'maximum_expandable_size', '2018-08-14 12:24:35', '2018-08-14 12:24:35'),
(792, 134, 'line_size', 'Line Size', NULL, 34, '228', 'line_size', '2018-08-14 12:24:36', '2018-08-14 12:24:36'),
(793, 135, 'size_color', '#0088cc', '10', 5999, '229', 'size_color', '2018-08-14 13:38:37', '2018-08-14 13:38:37'),
(794, 135, 'product_material', 'Blue Lather', NULL, 69000, '230', 'product_material', '2018-08-14 13:38:38', '2018-08-14 13:38:38'),
(795, 135, 'product_material_size', 'Blue Lather', '10', 58777, '', 'product_material_size', '2018-08-14 13:38:38', '2018-08-14 13:38:38'),
(796, 135, 'style_size', 'Sport', '10', 6855, '231', 'style_size', '2018-08-14 13:38:38', '2018-08-14 13:38:38'),
(797, 135, 'shoes_style', 'Sport Shoes', NULL, NULL, '', 'shoes_style', '2018-08-14 13:38:38', '2018-08-14 13:38:38'),
(798, 136, 'color', '#ffffff', NULL, 450, '232', 'color', '2018-08-15 05:13:14', '2018-08-15 05:13:14'),
(799, 136, 'color', '#1b4a80', NULL, 460, '233', 'color', '2018-08-15 05:13:15', '2018-08-15 05:13:15'),
(800, 136, 'band_color', '#d6d8e3', NULL, 50, '234', 'band_color', '2018-08-15 05:13:16', '2018-08-15 05:13:16'),
(801, 136, 'Warranty', 'manufacturer', NULL, NULL, NULL, 'warranty', '2018-08-15 05:13:16', '2018-08-15 05:13:16'),
(802, 137, 'color', '#ffffff', NULL, 2500, '235', 'color', '2018-08-15 11:31:21', '2018-08-15 11:31:21'),
(803, 137, 'size', 'size1', NULL, NULL, '', 'size', '2018-08-15 11:31:21', '2018-08-15 11:31:21'),
(804, 137, 'size', 'size2', NULL, NULL, '', 'size', '2018-08-15 11:31:21', '2018-08-15 11:31:21'),
(805, 137, 'size_color', '#ffffff', 'Small', 2410, '236', 'size_color', '2018-08-15 11:31:21', '2018-08-15 11:31:21'),
(806, 137, 'product_material', 'Material 1', NULL, 1500, '237', 'product_material', '2018-08-15 11:31:22', '2018-08-15 11:31:22'),
(807, 137, 'golf_loft', 'Golf Loft1', NULL, 1, '238', 'golf_loft', '2018-08-15 11:31:22', '2018-08-15 11:31:22'),
(808, 137, 'golf_loft', 'Golf Loft1', NULL, 4, '239', 'golf_loft', '2018-08-15 11:31:23', '2018-08-15 11:31:23'),
(809, 137, 'golf_flexmaterial', 'Golf Flex Material', NULL, 1, '240', 'golf_flexmaterial', '2018-08-15 11:31:23', '2018-08-15 11:31:23'),
(810, 137, 'golf_flexshaft_material', 'Golf FlexShaft Material', NULL, 3, '241', 'golf_flexshaft_material', '2018-08-15 11:31:23', '2018-08-15 11:31:23'),
(811, 137, 'golf_shaft_material', 'Golf Shaft Materia', NULL, 1, '242', 'golf_shaft_material', '2018-08-15 11:31:24', '2018-08-15 11:31:24'),
(812, 137, 'grip_size', 'Grip Size', NULL, 3, '243', 'grip_size', '2018-08-15 11:31:24', '2018-08-15 11:31:24'),
(813, 137, 'grip_type', 'Grip Type', NULL, 1, '244', 'grip_type', '2018-08-15 11:31:25', '2018-08-15 11:31:25'),
(814, 137, 'sport_hand', 'Hand', NULL, 2, '245', 'sport_hand', '2018-08-15 11:31:25', '2018-08-15 11:31:25'),
(815, 137, 'hand_shaftlength', 'Hand Shaft Length', NULL, 2, '246', 'hand_shaftlength', '2018-08-15 11:31:26', '2018-08-15 11:31:26'),
(816, 137, 'shaftmaterial_golfflex', 'Shaft Material Golf Flex', NULL, 2, '247', 'shaftmaterial_golfflex', '2018-08-15 11:31:26', '2018-08-15 11:31:26'),
(817, 137, 'shaftmaterial_golfflex_golfloft', 'Shaft Material GolfFlex GolfLoft', NULL, 2, '248', 'shaftmaterial_golfflex_golfloft', '2018-08-15 11:31:26', '2018-08-15 11:31:26'),
(818, 137, 'tension_level', 'Tension Level', NULL, 2, '249', 'tension_level', '2018-08-15 11:31:27', '2018-08-15 11:31:27'),
(819, 137, 'shaft_material', 'Shaft Material', NULL, 2, '250', 'shaft_material', '2018-08-15 11:31:27', '2018-08-15 11:31:27'),
(820, 137, 'item_shape', 'Item Shape', NULL, 3, '251', 'item_shape', '2018-08-15 11:31:28', '2018-08-15 11:31:28'),
(821, 137, 'size_weight_supported', 'Size Weight Supported', NULL, 4, '252', 'size_weight_supported', '2018-08-15 11:31:28', '2018-08-15 11:31:28'),
(822, 137, 'style_name', 'Style Name', NULL, 4, '253', 'style_name', '2018-08-15 11:31:28', '2018-08-15 11:31:28'),
(823, 137, 'other attributes', 'other attributes', NULL, NULL, NULL, 'other-attributes', '2018-08-15 11:31:28', '2018-08-15 11:31:28'),
(824, 138, 'color', '#000000', NULL, 1600, '256', 'color', '2018-08-16 05:01:14', '2018-08-16 05:01:14'),
(825, 138, 'size', '3.5', NULL, NULL, '', 'size', '2018-08-16 05:01:14', '2018-08-16 05:01:14'),
(826, 138, 'size', '4', NULL, NULL, '', 'size', '2018-08-16 05:01:14', '2018-08-16 05:01:14'),
(827, 138, 'size_color', '#000000', '3.5', 1560, '257', 'size_color', '2018-08-16 05:01:14', '2018-08-16 05:01:14'),
(828, 138, 'size_color', '#66705f', '4', 1500, '258', 'size_color', '2018-08-16 05:01:15', '2018-08-16 05:01:15'),
(829, 138, 'Max. Inflation Pressure(kpa)', '225', NULL, NULL, NULL, 'max-inflation-pressure-kpa', '2018-08-16 05:01:15', '2018-08-16 05:01:15'),
(836, 140, 'paperback', 'Flexible card', NULL, 200, '265', 'paperback', '2018-08-16 07:49:30', '2018-08-16 07:49:30'),
(837, 140, 'paperback', 'Stiff paper', NULL, 250, '266', 'paperback', '2018-08-16 07:49:30', '2018-08-16 07:49:30'),
(838, 140, 'hardcover', 'Buckram', NULL, 250, '267', 'hardcover', '2018-08-16 07:49:31', '2018-08-16 07:49:31'),
(839, 140, 'hardcover', 'Leather', NULL, 350, '268', 'hardcover', '2018-08-16 07:49:31', '2018-08-16 07:49:31'),
(840, 140, 'audiocd', 'Harry Potter Series 1', NULL, 2900, '269', 'audiocd', '2018-08-16 07:49:32', '2018-08-16 07:49:32'),
(841, 140, 'audiocd', 'Harry Potter Series 2', NULL, 3000, '270', 'audiocd', '2018-08-16 07:49:32', '2018-08-16 07:49:32'),
(842, 140, 'Weight', '250 Gm', NULL, NULL, NULL, 'weight', '2018-08-16 07:49:32', '2018-08-16 07:49:32'),
(843, 140, 'Region', 'All Region', NULL, NULL, NULL, 'region', '2018-08-16 07:49:32', '2018-08-16 07:49:32'),
(844, 140, 'Studio', 'Excel Home Videos', NULL, NULL, NULL, 'studio', '2018-08-16 07:49:32', '2018-08-16 07:49:32'),
(845, 140, 'Run Time', '900 Minutes', NULL, NULL, NULL, 'run-time', '2018-08-16 07:49:32', '2018-08-16 07:49:32'),
(883, 141, 'color', '#ff0900', NULL, 1520, '271', 'color', '2018-08-16 12:04:20', '2018-08-16 12:04:20'),
(884, 141, 'color', '#f000cc', NULL, 1550, '272', 'color', '2018-08-16 12:04:21', '2018-08-16 12:04:21'),
(885, 141, 'color', '#f26100', NULL, 1450, '273', 'color', '2018-08-16 12:04:21', '2018-08-16 12:04:21'),
(886, 141, 'size', 'L', NULL, NULL, '', 'size', '2018-08-16 12:04:21', '2018-08-16 12:04:21'),
(887, 141, 'size', 'S', NULL, NULL, '', 'size', '2018-08-16 12:04:21', '2018-08-16 12:04:21'),
(893, 141, 'Generic Name', 'Combo Kits', NULL, NULL, NULL, 'generic-name', '2018-08-16 12:04:24', '2018-08-16 12:04:24'),
(894, 141, 'Weight', '3.5 Gm', NULL, NULL, NULL, 'weight-1', '2018-08-16 12:04:24', '2018-08-16 12:04:24'),
(895, 141, 'Flavours', 'Different by Colors', NULL, NULL, NULL, 'flavours', '2018-08-16 12:04:24', '2018-08-16 12:04:24'),
(896, 142, 'color', '#ffffff', NULL, 350, '283', 'color', '2018-08-16 12:51:21', '2018-08-16 12:51:21'),
(897, 142, 'color', '#000000', NULL, 450, '284', 'color', '2018-08-16 12:51:21', '2018-08-16 12:51:21'),
(898, 142, 'color', '#ff0900', NULL, 400, '285', 'color', '2018-08-16 12:51:22', '2018-08-16 12:51:22'),
(899, 142, 'size', 'L', NULL, NULL, '', 'size', '2018-08-16 12:51:22', '2018-08-16 12:51:22'),
(900, 142, 'size', 'M', NULL, NULL, '', 'size', '2018-08-16 12:51:22', '2018-08-16 12:51:22'),
(901, 142, 'size', 'XL', NULL, NULL, '', 'size', '2018-08-16 12:51:22', '2018-08-16 12:51:22'),
(902, 142, 'size', 'XXL', NULL, NULL, '', 'size', '2018-08-16 12:51:22', '2018-08-16 12:51:22'),
(903, 142, 'size_color', '#ffffff', 'L', 450, '286', 'size_color', '2018-08-16 12:51:22', '2018-08-16 12:51:22'),
(904, 142, 'size_color', '#000000', 'L', 499, '287', 'size_color', '2018-08-16 12:51:22', '2018-08-16 12:51:22'),
(905, 142, 'pattern', 'Plain', NULL, 399, '288', 'pattern', '2018-08-16 12:51:23', '2018-08-16 12:51:23'),
(906, 142, 'pattern', 'Symboled', NULL, 499, '289', 'pattern', '2018-08-16 12:51:23', '2018-08-16 12:51:23'),
(907, 142, 'cup_size', 'Round Neck', NULL, 399, '290', 'cup_size', '2018-08-16 12:51:23', '2018-08-16 12:51:23'),
(908, 142, 'cup_size_color', 'Round Neck', '#000000', 399, '291', 'cup_size_color', '2018-08-16 12:51:24', '2018-08-16 12:51:24'),
(909, 142, 'color_lens_width', '#e80800', '48 inch', 399, '292', 'color_lens_width', '2018-08-16 12:51:24', '2018-08-16 12:51:24'),
(910, 142, 'color_magnification_strength', '100%', NULL, NULL, '', 'color_magnification_strength', '2018-08-16 12:51:24', '2018-08-16 12:51:24'),
(911, 142, 'lens_color', '#000000', NULL, 499, '293', 'lens_color', '2018-08-16 12:51:25', '2018-08-16 12:51:25'),
(912, 142, 'Weight', '150 Gm', NULL, NULL, NULL, 'weight-2', '2018-08-16 12:51:25', '2018-08-16 12:51:25'),
(913, 142, 'Cloth material', 'Cotton and Polyster', NULL, NULL, NULL, 'cloth-material', '2018-08-16 12:51:25', '2018-08-16 12:51:25'),
(914, 143, 'color', '#000000', NULL, 1550, '294', 'color', '2018-08-17 05:08:26', '2018-08-17 05:08:26'),
(915, 143, 'color', '#005ce6', NULL, 1850, '295', 'color', '2018-08-17 05:08:26', '2018-08-17 05:08:26'),
(916, 143, 'size', 'L', NULL, NULL, '', 'size', '2018-08-17 05:08:26', '2018-08-17 05:08:26'),
(917, 143, 'size', 'M', NULL, NULL, '', 'size', '2018-08-17 05:08:26', '2018-08-17 05:08:26'),
(918, 143, 'size_color', '#000000', 'L', 2050, '296', 'size_color', '2018-08-17 05:08:27', '2018-08-17 05:08:27'),
(919, 143, 'size_color', '#0000f0', 'M', 2500, '297', 'size_color', '2018-08-17 05:08:27', '2018-08-17 05:08:27'),
(920, 143, 'No of keys', '205', NULL, NULL, NULL, 'no-of-keys', '2018-08-17 05:08:27', '2018-08-17 05:08:27'),
(921, 143, 'Weight', '500 Gm', NULL, NULL, NULL, 'weight-3', '2018-08-17 05:08:28', '2018-08-17 05:08:28'),
(922, 144, 'color', '#610909', NULL, 15999, '298', 'color', '2018-08-17 05:19:30', '2018-08-17 05:19:30'),
(923, 144, 'color', '#000000', NULL, 14999, '299', 'color', '2018-08-17 05:19:31', '2018-08-17 05:19:31'),
(924, 144, 'size', 'Small', NULL, NULL, '', 'size', '2018-08-17 05:19:31', '2018-08-17 05:19:31'),
(925, 144, 'size', 'Big', NULL, NULL, '', 'size', '2018-08-17 05:19:31', '2018-08-17 05:19:31'),
(926, 144, 'No of Chairs', '6', NULL, NULL, NULL, 'no-of-chairs', '2018-08-17 05:19:31', '2018-08-17 05:19:31'),
(927, 144, 'Weight', '50 Kg', NULL, NULL, NULL, 'weight-4', '2018-08-17 05:19:31', '2018-08-17 05:19:31'),
(928, 144, 'Warrenty', '2 Years', NULL, NULL, NULL, 'warrenty', '2018-08-17 05:19:31', '2018-08-17 05:19:31'),
(929, 145, 'color', '#e0c762', NULL, 350, '300', 'color', '2018-08-17 05:32:19', '2018-08-17 05:32:19'),
(930, 145, 'size', '2 Ltrs', NULL, NULL, '', 'size', '2018-08-17 05:32:19', '2018-08-17 05:32:19'),
(931, 145, 'size', '3 Ltrs', NULL, NULL, '', 'size', '2018-08-17 05:32:19', '2018-08-17 05:32:19'),
(932, 145, 'size_color', '#e0c200', '3 Ltrs', 450, '301', 'size_color', '2018-08-17 05:32:19', '2018-08-17 05:32:19'),
(933, 145, 'color_material', '#e0bb00', 'Plastic', 450, '302', 'color_material', '2018-08-17 05:32:20', '2018-08-17 05:32:20'),
(934, 145, 'Package Contents:', '2 ltr', NULL, NULL, NULL, 'package-contents', '2018-08-17 05:32:20', '2018-08-17 05:32:20'),
(935, 145, 'Warrenty', '6 months', NULL, NULL, NULL, 'warrenty-1', '2018-08-17 05:32:20', '2018-08-17 05:32:20'),
(936, 146, 'size', 'Big', NULL, NULL, '', 'size', '2018-08-17 05:49:18', '2018-08-17 05:49:18'),
(937, 146, 'size', 'Small', NULL, NULL, '', 'size', '2018-08-17 05:49:18', '2018-08-17 05:49:18'),
(938, 146, 'product_flavor', 'Almond Flavor 1', NULL, 450, '303', 'product_flavor', '2018-08-17 05:49:19', '2018-08-17 05:49:19'),
(939, 146, 'product_flavor', 'Almond Flavor 2', NULL, 500, '304', 'product_flavor', '2018-08-17 05:49:19', '2018-08-17 05:49:19'),
(940, 146, 'product_weight', '500 Gm', NULL, 550, '305', 'product_weight', '2018-08-17 05:49:19', '2018-08-17 05:49:19'),
(941, 146, 'product_weight', '1 Kg', NULL, 1100, '306', 'product_weight', '2018-08-17 05:49:20', '2018-08-17 05:49:20'),
(942, 146, 'flavor_size', 'Flavor size 1', '1', 500, '307', 'flavor_size', '2018-08-17 05:49:20', '2018-08-17 05:49:20'),
(943, 146, 'flavor_size', 'Flavor size 1', '2', 505, '308', 'flavor_size', '2018-08-17 05:49:20', '2018-08-17 05:49:20'),
(944, 146, 'flavor_weight', 'Flavor Weight 1', '500 Gm', 550, '309', 'flavor_weight', '2018-08-17 05:49:21', '2018-08-17 05:49:21'),
(945, 146, 'flavor_weight', 'Flavor Weight 2', '1 KG', 1100, '310', 'flavor_weight', '2018-08-17 05:49:21', '2018-08-17 05:49:21'),
(946, 146, 'Expire on', 'Best Before 2 years', NULL, NULL, NULL, 'expire-on', '2018-08-17 05:49:21', '2018-08-17 05:49:21'),
(947, 147, 'color', '#ffffff', NULL, 450, '311', 'color', '2018-08-17 06:28:56', '2018-08-17 06:28:56'),
(948, 147, 'size', 'Small', NULL, NULL, '', 'size', '2018-08-17 06:28:57', '2018-08-17 06:28:57'),
(949, 147, 'size', 'Large', NULL, NULL, '', 'size', '2018-08-17 06:28:57', '2018-08-17 06:28:57'),
(950, 147, 'size_color', '#ffffff', 'Large', 500, '312', 'size_color', '2018-08-17 06:28:57', '2018-08-17 06:28:57'),
(951, 147, 'product_material', 'Plastic & Glass', NULL, 450, '313', 'product_material', '2018-08-17 06:28:58', '2018-08-17 06:28:58'),
(952, 147, 'product_material', 'Glass', NULL, 550, '314', 'product_material', '2018-08-17 06:28:58', '2018-08-17 06:28:58'),
(953, 147, 'product_material_size', 'Plastic & Glass', '3 Feet', 450, '314', 'product_material_size', '2018-08-17 06:28:58', '2018-08-17 06:28:58'),
(954, 147, 'product_material_size', 'Plastic & Glass', '4 Feet', 550, '314', 'product_material_size', '2018-08-17 06:28:58', '2018-08-17 06:28:58'),
(955, 147, 'Warranty', 'Manufacturer Warranty  2 years', NULL, NULL, NULL, 'warranty-1', '2018-08-17 06:28:58', '2018-08-17 06:28:58'),
(956, 148, 'color', '#edcc49', NULL, 13900, '315', 'color', '2018-08-17 06:57:11', '2018-08-17 06:57:11'),
(957, 148, 'color', '#ebebeb', NULL, 14000, '316', 'color', '2018-08-17 06:57:12', '2018-08-17 06:57:12'),
(958, 148, 'size', '4', NULL, NULL, '', 'size', '2018-08-17 06:57:12', '2018-08-17 06:57:12'),
(959, 148, 'size', '4.5', NULL, NULL, '', 'size', '2018-08-17 06:57:12', '2018-08-17 06:57:12'),
(960, 148, 'size', '5', NULL, NULL, '', 'size', '2018-08-17 06:57:12', '2018-08-17 06:57:12'),
(961, 148, 'size', '5.5', NULL, NULL, '', 'size', '2018-08-17 06:57:12', '2018-08-17 06:57:12'),
(962, 148, 'product_material', 'Gold', NULL, 14999, '317', 'product_material', '2018-08-17 06:57:13', '2018-08-17 06:57:13'),
(963, 148, 'product_material', 'Platinum', NULL, 15999, '318', 'product_material', '2018-08-17 06:57:13', '2018-08-17 06:57:13'),
(964, 148, 'metaltype', 'Metal type 1', NULL, 15000, '319', 'metaltype', '2018-08-17 06:57:14', '2018-08-17 06:57:14'),
(965, 148, 'metaltype', 'Metal type 2', NULL, 18000, '320', 'metaltype', '2018-08-17 06:57:15', '2018-08-17 06:57:15'),
(966, 148, 'sizeperpearl', 'Size Per Pearl 1', NULL, 14800, '321', 'sizeperpearl', '2018-08-17 06:57:15', '2018-08-17 06:57:15'),
(967, 148, 'color_metaltype', '#e6ae6a', 'Color MetalType', 15400, '322', 'color_metaltype', '2018-08-17 06:57:16', '2018-08-17 06:57:16'),
(968, 148, 'color_itemlength', '#b88400', 'Color-ItemLength', 45000, '323', 'color_itemlength', '2018-08-17 06:57:16', '2018-08-17 06:57:16'),
(969, 148, 'gem_type', 'Gem Type', NULL, 14900, '323', 'gem_type', '2018-08-17 06:57:17', '2018-08-17 06:57:17'),
(970, 148, 'metaltype_gemtype', 'Metaltype', 'GemType', 14000, '324', 'metaltype_gemtype', '2018-08-17 06:57:17', '2018-08-17 06:57:17'),
(971, 148, 'total_gemweight', 'Total Gem Weight', NULL, 14000, '325', 'total_gemweight', '2018-08-17 06:57:17', '2018-08-17 06:57:17'),
(972, 148, 'total_diamondweight', 'Total Diamond Weight', NULL, 14500, '325', 'total_diamondweight', '2018-08-17 06:57:18', '2018-08-17 06:57:18'),
(973, 148, 'metaltype_totaldiamondweight', 'MetalType', 'TotalDiamondWeight', 14900, '326', 'metaltype_totaldiamondweight', '2018-08-17 06:57:18', '2018-08-17 06:57:18'),
(974, 148, 'itemlength_gemtype', 'ItemLength', 'Gemtype', 45000, '327', 'itemlength_gemtype', '2018-08-17 06:57:19', '2018-08-17 06:57:19'),
(975, 148, 'itemlength_material', 'ItemLength', 'Material', 14500, '328', 'itemlength_material', '2018-08-17 06:57:19', '2018-08-17 06:57:19'),
(976, 148, 'itemlength_sizeperpearl', 'ItemLength', 'Sizeperpearl', 14900, '329', 'itemlength_sizeperpearl', '2018-08-17 06:57:20', '2018-08-17 06:57:20'),
(977, 148, 'itemlength_metaltype', 'ItemLength', 'MetalType', 14000, '330', 'itemlength_metaltype', '2018-08-17 06:57:21', '2018-08-17 06:57:21'),
(978, 148, 'itemlength_totaldiamondweight', 'ItemLength', 'TotalDiamondWeight', 14900, '331', 'itemlength_totaldiamondweight', '2018-08-17 06:57:21', '2018-08-17 06:57:21'),
(979, 148, 'item_length', 'ItemLength', NULL, 14000, '332', 'item_length', '2018-08-17 06:57:22', '2018-08-17 06:57:22'),
(980, 148, 'ring_size', 'RingSize', NULL, 14500, '332', 'ring_size', '2018-08-17 06:57:22', '2018-08-17 06:57:22'),
(981, 148, 'metaltype_ringsize', 'MetalType', 'RingSize', 145000, '332', 'metaltype_ringsize', '2018-08-17 06:57:22', '2018-08-17 06:57:22'),
(982, 148, 'color_ringsize', '#ff9900', 'RingSize', 145000, '332', 'color_ringsize', '2018-08-17 06:57:22', '2018-08-17 06:57:22'),
(983, 148, 'ringsize_gemtype', 'RingSize', 'GemType', 14500, '332', 'ringsize_gemtype', '2018-08-17 06:57:22', '2018-08-17 06:57:22'),
(984, 148, 'ringsize_totaldiamondweight', 'RingSize', 'TotalDiamondWeight', 14500, '332', 'ringsize_totaldiamondweight', '2018-08-17 06:57:22', '2018-08-17 06:57:22'),
(985, 148, 'Test Parameter', '123456', NULL, NULL, NULL, 'test-parameter', '2018-08-17 06:57:22', '2018-08-17 06:57:22'),
(986, 149, 'color', '#ffffff', NULL, 59999, '333', 'color', '2018-08-17 11:04:05', '2018-08-17 11:04:05'),
(987, 149, 'color', '#a68f8f', NULL, 49999, '334', 'color', '2018-08-17 11:04:05', '2018-08-17 11:04:05'),
(988, 149, 'size', '150 ton', NULL, NULL, '', 'size', '2018-08-17 11:04:05', '2018-08-17 11:04:05'),
(989, 149, 'size', '200 ton', NULL, NULL, '', 'size', '2018-08-17 11:04:05', '2018-08-17 11:04:05'),
(990, 149, 'size_color', '#ffffff', '150 ton', 49999, '335', 'size_color', '2018-08-17 11:04:06', '2018-08-17 11:04:06'),
(991, 149, 'size_color', '#000000', '150 ton', 59999, '336', 'size_color', '2018-08-17 11:04:06', '2018-08-17 11:04:06'),
(992, 149, 'Warranty', '1 year', NULL, NULL, NULL, 'warranty-2', '2018-08-17 11:04:06', '2018-08-17 11:04:06'),
(993, 149, 'Invertor  Warranty', '2 year', NULL, NULL, NULL, 'invertor-warranty', '2018-08-17 11:04:06', '2018-08-17 11:04:06'),
(994, 150, 'color', '#f00800', NULL, 4500, '337', 'color', '2018-08-17 11:14:07', '2018-08-17 11:14:07'),
(995, 150, 'color', '#000000', NULL, 4900, '338', 'color', '2018-08-17 11:14:07', '2018-08-17 11:14:07'),
(996, 150, 'size', 'L', NULL, NULL, '', 'size', '2018-08-17 11:14:07', '2018-08-17 11:14:07'),
(997, 150, 'size', 'M', NULL, NULL, '', 'size', '2018-08-17 11:14:07', '2018-08-17 11:14:07'),
(998, 150, 'Manufacturer Detail', 'Detail Imported Marketed By Samsonite South Asia Pvt Nasik', NULL, NULL, NULL, 'manufacturer-detail', '2018-08-17 11:14:08', '2018-08-17 11:14:08'),
(999, 150, 'Country Of Origin', 'CHINA', NULL, NULL, NULL, 'country-of-origin', '2018-08-17 11:14:08', '2018-08-17 11:14:08'),
(1000, 150, 'Material', 'Polyester', NULL, NULL, NULL, 'material-1', '2018-08-17 11:14:08', '2018-08-17 11:14:08'),
(1009, 152, 'color', '#12009e', NULL, 450, '343', 'color', '2018-08-17 11:29:53', '2018-08-17 11:29:53'),
(1010, 152, 'color', '#ed0000', NULL, 455, '344', 'color', '2018-08-17 11:29:54', '2018-08-17 11:29:54'),
(1011, 152, 'size', 'Large', NULL, NULL, '', 'size', '2018-08-17 11:29:54', '2018-08-17 11:29:54'),
(1012, 152, 'size', 'Medium', NULL, NULL, '', 'size', '2018-08-17 11:29:54', '2018-08-17 11:29:54'),
(1013, 152, 'size_color', '#fc0000', 'Large', 450, '345', 'size_color', '2018-08-17 11:29:54', '2018-08-17 11:29:54'),
(1014, 152, 'size_color', '#2600ff', 'Large', 450, '346', 'size_color', '2018-08-17 11:29:54', '2018-08-17 11:29:54'),
(1015, 152, 'product_material', 'Plastic', NULL, 450, '347', 'product_material', '2018-08-17 11:29:55', '2018-08-17 11:29:55'),
(1016, 152, 'number_of_items', '12 piece', NULL, 450, '348', 'number_of_items', '2018-08-17 11:29:55', '2018-08-17 11:29:55'),
(1017, 152, 'number_of_items', '6 piece', NULL, 225, '349', 'number_of_items', '2018-08-17 11:29:56', '2018-08-17 11:29:56'),
(1018, 152, 'paper_size', 'Paper Size Large', NULL, 1500, '350', 'paper_size', '2018-08-17 11:29:56', '2018-08-17 11:29:56'),
(1019, 152, 'maximum_expandable_size', '50', NULL, 120, '', 'maximum_expandable_size', '2018-08-17 11:29:56', '2018-08-17 11:29:56'),
(1020, 152, 'line_size', '1520', NULL, 1501, '351', 'line_size', '2018-08-17 11:29:57', '2018-08-17 11:29:57'),
(1021, 152, 'Test Parameter', 'Test Parameter', NULL, NULL, NULL, 'test-parameter-1', '2018-08-17 11:29:57', '2018-08-17 11:29:57'),
(1022, 153, 'color', '#a68d4c', NULL, 4500, '352', 'color', '2018-08-17 11:52:06', '2018-08-17 11:52:06'),
(1023, 153, 'size', '5 Kg', NULL, NULL, '', 'size', '2018-08-17 11:52:06', '2018-08-17 11:52:06'),
(1024, 153, 'size', '10 Kg', NULL, NULL, '', 'size', '2018-08-17 11:52:06', '2018-08-17 11:52:06'),
(1025, 153, 'size_color', '#c48300', '5 Kg', 5000, '353', 'size_color', '2018-08-17 11:52:06', '2018-08-17 11:52:06'),
(1026, 153, 'size_color', '#a68500', '10 Kg', 1500, '354', 'size_color', '2018-08-17 11:52:06', '2018-08-17 11:52:06'),
(1027, 153, 'product_flavor', 'Banana', NULL, 4500, '355', 'product_flavor', '2018-08-17 11:52:07', '2018-08-17 11:52:07'),
(1028, 153, 'product_flavor', 'Orange', NULL, 4800, '356', 'product_flavor', '2018-08-17 11:52:07', '2018-08-17 11:52:07'),
(1029, 153, 'flavor_size', 'Orange', '5 Kg', 4500, '357', 'flavor_size', '2018-08-17 11:52:07', '2018-08-17 11:52:07'),
(1030, 153, 'flavor_size', 'Banana', '10 Kg', 4800, '358', 'flavor_size', '2018-08-17 11:52:08', '2018-08-17 11:52:08'),
(1031, 153, 'Pedgree', 'Parameter', NULL, NULL, NULL, 'pedgree', '2018-08-17 11:52:08', '2018-08-17 11:52:08'),
(1032, 154, 'color', '#000000', NULL, 999, '359', 'color', '2018-08-17 12:11:50', '2018-08-17 12:11:50'),
(1033, 154, 'size', '8 UK', NULL, NULL, '', 'size', '2018-08-17 12:11:50', '2018-08-17 12:11:50'),
(1034, 154, 'size', '9 UK', NULL, NULL, '', 'size', '2018-08-17 12:11:50', '2018-08-17 12:11:50'),
(1035, 154, 'size', '10 UK', NULL, NULL, '', 'size', '2018-08-17 12:11:50', '2018-08-17 12:11:50'),
(1036, 154, 'size_color', '#000000', '8UK', 899, '360', 'size_color', '2018-08-17 12:11:50', '2018-08-17 12:11:50'),
(1037, 154, 'size_color', '#000000', '9 UK', 899, '361', 'size_color', '2018-08-17 12:11:51', '2018-08-17 12:11:51'),
(1038, 154, 'product_material', 'Mesh', NULL, 899, '362', 'product_material', '2018-08-17 12:11:51', '2018-08-17 12:11:51'),
(1039, 154, 'product_material_size', 'Mesh', '8 UK', 899, '363', 'product_material_size', '2018-08-17 12:11:51', '2018-08-17 12:11:51'),
(1040, 154, 'style_size', 'Sport', '8 UK', 899, '363', 'style_size', '2018-08-17 12:11:51', '2018-08-17 12:11:51'),
(1041, 154, 'shoes_style', 'Sport', NULL, 899, '363', 'shoes_style', '2018-08-17 12:11:51', '2018-08-17 12:11:51'),
(1042, 154, 'Closure Type', 'Lace-Up', NULL, NULL, NULL, 'closure-type', '2018-08-17 12:11:51', '2018-08-17 12:11:51'),
(1043, 155, 'color', '#005c6e', NULL, 488, '364', 'color', '2018-08-17 12:33:51', '2018-08-17 12:33:51'),
(1044, 155, 'color', '#ffffff', NULL, 500, '365', 'color', '2018-08-17 12:33:52', '2018-08-17 12:33:52'),
(1045, 155, 'size', 'L', NULL, NULL, '', 'size', '2018-08-17 12:33:52', '2018-08-17 12:33:52'),
(1046, 155, 'size', 'M', NULL, NULL, '', 'size', '2018-08-17 12:33:52', '2018-08-17 12:33:52'),
(1047, 155, 'size_color', '#2f00ed', 'L', 499, '366', 'size_color', '2018-08-17 12:33:53', '2018-08-17 12:33:53'),
(1048, 155, 'size_color', '#ffffff', 'L', 499, '367', 'size_color', '2018-08-17 12:33:53', '2018-08-17 12:33:53'),
(1049, 155, 'band_color', '#ffffff', NULL, 499, '368', 'band_color', '2018-08-17 12:33:54', '2018-08-17 12:33:54'),
(1050, 155, 'band_color', '#0088cc', NULL, 488, '369', 'band_color', '2018-08-17 12:33:54', '2018-08-17 12:33:54'),
(1051, 155, 'Watch Type', 'Multitype', NULL, NULL, NULL, 'watch-type', '2018-08-17 12:33:54', '2018-08-17 12:33:54'),
(1645, 151, 'color', '#0088cc', NULL, 345, '420', 'color', '2018-08-18 13:43:34', '2018-08-18 13:43:34'),
(1646, 151, 'size', 'L', NULL, NULL, NULL, 'size', '2018-08-18 13:43:34', '2018-08-18 13:43:34'),
(1647, 151, 'size', 'M', NULL, NULL, NULL, 'size', '2018-08-18 13:43:34', '2018-08-18 13:43:34'),
(1648, 151, 'size_color', '#0088cc', 'L', 234234, NULL, 'size_color', '2018-08-18 13:43:34', '2018-08-18 13:43:34'),
(1649, 151, 'Weight', '2 kg', NULL, NULL, NULL, 'weight-5', '2018-08-18 13:43:35', '2018-08-18 13:43:35'),
(1650, 151, 'Test Attribute', 'Attrib Value', NULL, NULL, NULL, 'test-attribute', '2018-08-18 13:43:35', '2018-08-18 13:43:35'),
(1651, 151, 'New Updated', 'Attribute', NULL, NULL, NULL, 'new-updated', '2018-08-18 13:43:35', '2018-08-18 13:43:35'),
(1652, 87, 'color', '#ff0900', NULL, 15000, '421', 'color', '2018-08-30 09:27:12', '2018-08-30 09:27:12'),
(1653, 87, 'color', '#0088cc', NULL, 14800, '422', 'color', '2018-08-30 09:27:13', '2018-08-30 09:27:13'),
(1654, 87, 'tetss', 'tsets', NULL, NULL, NULL, 'tetss', '2018-08-30 09:27:13', '2018-08-30 09:27:13'),
(1660, 86, 'color', '#000000', NULL, 4564, '425', 'color', '2018-08-30 09:30:48', '2018-08-30 09:30:48'),
(1661, 86, 'color', '#e80800', NULL, 45646, '426', 'color', '2018-08-30 09:30:48', '2018-08-30 09:30:48'),
(1662, 157, 'color', '#000000', NULL, NULL, NULL, 'color', '2018-08-30 11:10:07', '2018-08-30 11:10:07'),
(1663, 157, 'tests', 'testset', NULL, NULL, NULL, 'tests', '2018-08-30 11:10:08', '2018-08-30 11:10:08'),
(1664, 157, 'tets', 'testst', NULL, NULL, NULL, 'tets-1', '2018-08-30 11:10:08', '2018-08-30 11:10:08'),
(1665, 158, 'color', '#0088cc', NULL, 456, NULL, 'color', '2018-08-30 11:14:06', '2018-08-30 11:14:06'),
(1666, 159, 'color', '#09bd00', NULL, 456, NULL, 'color', '2018-08-30 11:17:03', '2018-08-30 12:11:28'),
(1667, 159, 'color', '#00ad51', NULL, 7, NULL, 'color', '2018-08-30 12:12:12', '2018-08-30 12:12:25'),
(1677, 159, 'color', '#20c200', NULL, 0, NULL, 'color', '2018-08-30 12:31:03', '2018-08-30 12:31:03'),
(1684, 160, 'color', '#000000', NULL, 150, NULL, 'color', '2018-08-31 10:51:21', '2018-08-31 10:51:21'),
(1685, 160, 'color', '#46c25f', NULL, 1500, NULL, 'color', '2018-08-31 10:51:22', '2018-08-31 11:56:03'),
(1688, 159, 'size_color', '#0088cc', 'L', 5, NULL, 'size_color', '2018-08-31 10:54:33', '2018-08-31 10:54:33'),
(1689, 159, 'size_color', '#0088cc', '456', 4, NULL, 'size_color', '2018-08-31 10:54:33', '2018-08-31 10:54:33'),
(1707, 160, 'color', '#1500b0', NULL, 1505, NULL, 'color', '2018-08-31 11:14:25', '2018-08-31 13:16:31'),
(1818, 160, 'size', 'L', NULL, NULL, NULL, 'size', '2018-08-31 13:45:06', '2018-08-31 13:45:06'),
(1819, 160, 'size', 'XL', NULL, NULL, NULL, 'size', '2018-08-31 13:45:06', '2018-08-31 13:45:06'),
(1820, 160, 'size', 'XXL', NULL, NULL, NULL, 'size', '2018-08-31 13:45:06', '2018-08-31 13:45:06'),
(1822, 160, 'Weigth', '25kg', NULL, NULL, NULL, 'weigth', '2018-08-31 13:45:07', '2018-08-31 13:45:07'),
(1823, 160, 'Quality', 'A-1', NULL, NULL, NULL, 'quality', '2018-08-31 13:45:07', '2018-08-31 13:45:07'),
(1824, 160, 'Hello', 'test', NULL, NULL, NULL, 'hello', '2018-08-31 13:45:07', '2018-08-31 13:45:07'),
(1827, 162, 'size_color', '#0088cc', 'XXL', 150, NULL, 'size_color', '2018-09-05 07:03:06', '2018-09-05 07:03:06'),
(1828, 162, 'size_color', '#0088cc', 'M', 200, NULL, 'size_color', '2018-09-05 07:03:06', '2018-09-05 07:03:06'),
(1829, 162, 'size_color', '#ff0900', 'X', 150, NULL, 'size_color', '2018-09-05 07:03:07', '2018-09-05 07:03:07'),
(1830, 162, 'size_color', '#ff0900', 'XL', 150, NULL, 'size_color', '2018-09-05 07:03:07', '2018-09-05 07:03:07'),
(1831, 162, 'size_color', '#ff0900', 'M', 450, NULL, 'size_color', '2018-09-05 07:03:07', '2018-09-05 07:03:07'),
(1832, 163, 'color', '#db0700', NULL, 13, NULL, 'color', '2018-09-05 13:00:17', '2018-09-05 13:00:17'),
(1833, 164, 'color', '#007d3a', NULL, 4, NULL, 'color', '2018-09-05 13:01:49', '2018-09-05 13:01:49'),
(1834, 164, 'color', '#00d6ab', NULL, 6, NULL, 'color', '2018-09-05 13:01:49', '2018-09-05 13:01:49'),
(1835, 164, 'size', 'L', NULL, NULL, NULL, 'size', '2018-09-05 13:01:50', '2018-09-05 13:01:50'),
(1836, 164, 'size', 'LL', NULL, NULL, NULL, 'size', '2018-09-05 13:01:50', '2018-09-05 13:01:50'),
(1837, 165, 'size_color', '#03000a', 'L', 150, NULL, 'size_color', '2018-09-05 13:50:05', '2018-09-05 13:50:05'),
(1838, 165, 'size_color', '#03000a', 'XL', 200, NULL, 'size_color', '2018-09-05 13:50:06', '2018-09-05 13:50:06'),
(1839, 165, 'size_color', '#03000a', 'XXL', 450, NULL, 'size_color', '2018-09-05 13:50:07', '2018-09-05 13:50:07'),
(1840, 165, 'size_color', '#730400', 'L', 250, NULL, 'size_color', '2018-09-05 13:50:07', '2018-09-05 13:50:07'),
(1841, 165, 'size_color', '#730400', 'XL', 300, NULL, 'size_color', '2018-09-05 13:50:08', '2018-09-05 13:50:08'),
(1843, 165, 'Test', 'test', NULL, NULL, NULL, 'test-4', '2018-09-05 13:51:26', '2018-09-05 13:51:26'),
(1844, 166, 'size_color', '#cf1f00', 'Large', 200, NULL, 'size_color', '2018-09-06 08:27:18', '2018-09-06 08:27:18'),
(1845, 166, 'size_color', '#cf1f00', 'Medium', 251, NULL, 'size_color', '2018-09-06 08:27:19', '2018-09-06 08:27:19'),
(1846, 166, 'size_color', '#cf1f00', 'Small', 300, NULL, 'size_color', '2018-09-06 08:27:19', '2018-09-06 08:27:19'),
(1847, 166, 'size_color', '#7d002e', 'Small', 200, NULL, 'size_color', '2018-09-06 08:27:19', '2018-09-06 08:27:19'),
(1848, 166, 'size_color', '#7d002e', 'Medium', 240, NULL, 'size_color', '2018-09-06 08:27:19', '2018-09-06 08:27:19'),
(1849, 166, 'size_color', '#7d002e', 'Extra Large', 150, NULL, 'size_color', '2018-09-06 08:27:20', '2018-09-06 08:27:20'),
(1851, 166, 'Material', 'Cotton', NULL, NULL, NULL, 'material-2', '2018-10-19 22:04:36', '2018-10-19 22:04:36');

-- --------------------------------------------------------

--
-- Structure de la table `product_discount`
--

CREATE TABLE `product_discount` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_discount`
--

INSERT INTO `product_discount` (`id`, `product_id`, `price`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(43, 49, 450, '2018-07-21', '2018-08-27', '0', '2018-07-21 19:12:53', '2018-07-21 19:12:53'),
(46, 34, 25000, '2018-05-05', '2018-05-31', '0', '2018-07-27 05:46:20', '2018-07-27 05:46:20'),
(51, 58, 2500, '2018-07-26', '2018-07-28', '0', '2018-07-31 11:29:00', '2018-07-31 11:29:00');

-- --------------------------------------------------------

--
-- Structure de la table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `rating` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_review`
--

INSERT INTO `product_review` (`id`, `user_id`, `product_id`, `rating`, `title`, `desc`, `status`, `created_at`, `updated_at`) VALUES
(1, 47, 28, '4', NULL, 'dsfgkjsgs', 0, '2018-04-12 05:46:46', '2018-04-12 05:46:46'),
(2, 46, 29, '5.0', NULL, 'product is good', 0, '2018-04-19 07:04:39', '2018-04-19 07:04:39'),
(3, 15, 34, '5', 'Very Good', 'Good !!!!!!', 0, '2018-04-21 09:43:54', '2018-08-07 14:02:22');

-- --------------------------------------------------------

--
-- Structure de la table `product_screenshots`
--

CREATE TABLE `product_screenshots` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `screenshots` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_screenshots`
--

INSERT INTO `product_screenshots` (`id`, `product_id`, `screenshots`, `created_at`, `updated_at`) VALUES
(37, 34, 'apple-iphone-6_3426.jpeg', '2018-04-27 12:54:51', '2018-04-27 12:54:51'),
(38, 34, 'apple-iphone-6_1215.png', '2018-04-27 12:54:52', '2018-04-27 12:54:52'),
(42, 49, 'dennis-lingo-men-s-cotton-solid-casual-shirt_3307.jpg', '2018-07-21 14:51:34', '2018-07-21 14:51:34'),
(43, 49, 'dennis-lingo-men-s-cotton-solid-casual-shirt_9808.jpg', '2018-07-21 14:51:35', '2018-07-21 14:51:35'),
(44, 50, 'the-theory-of-everything_9303.jpg', '2018-07-22 15:02:10', '2018-07-22 15:02:10'),
(52, 77, 'one-box_1420.jpg', '2018-08-07 10:14:50', '2018-08-07 10:14:50'),
(89, 106, 'ds_2887.png', '2018-08-10 06:33:18', '2018-08-10 06:33:18'),
(90, 106, 'ds_7625.png', '2018-08-10 06:33:19', '2018-08-10 06:33:19'),
(91, 106, 'ds_1234.png', '2018-08-10 06:33:20', '2018-08-10 06:33:20'),
(92, 106, 'ds_4500.png', '2018-08-10 06:33:20', '2018-08-10 06:33:20'),
(93, 106, 'ds_5273.jpg', '2018-08-10 06:33:21', '2018-08-10 06:33:21'),
(94, 106, 'ds_1596.png', '2018-08-10 06:33:21', '2018-08-10 06:33:21'),
(95, 107, 'test_8994.png', '2018-08-10 07:34:03', '2018-08-10 07:34:03'),
(96, 107, 'test_1934.png', '2018-08-10 07:34:03', '2018-08-10 07:34:03'),
(97, 108, 'dfg_3891.jpg', '2018-08-10 07:36:31', '2018-08-10 07:36:31'),
(98, 108, 'dfg_2701.jpg', '2018-08-10 07:36:32', '2018-08-10 07:36:32'),
(99, 110, 'sdf_3402.png', '2018-08-10 07:42:21', '2018-08-10 07:42:21'),
(100, 110, 'sdf_1919.png', '2018-08-10 07:42:22', '2018-08-10 07:42:22'),
(101, 110, 'sdf_5132.png', '2018-08-10 07:42:22', '2018-08-10 07:42:22'),
(102, 110, 'sdf_5109.png', '2018-08-10 07:42:23', '2018-08-10 07:42:23'),
(103, 110, 'sdf_6405.jpg', '2018-08-10 07:42:23', '2018-08-10 07:42:23'),
(116, 114, 'tes-1_5463.jpg', '2018-08-10 09:18:25', '2018-08-10 09:18:25'),
(117, 114, 'tes-1_2630.jpg', '2018-08-10 09:18:26', '2018-08-10 09:18:26'),
(118, 114, 'tes-1_7600.jpg', '2018-08-10 09:18:26', '2018-08-10 09:18:26'),
(132, 118, 'abc_1762.jpg', '2018-08-10 10:28:23', '2018-08-10 10:28:23'),
(133, 118, 'abc_7317.jpg', '2018-08-10 10:28:23', '2018-08-10 10:28:23'),
(134, 118, 'abc_9867.jpg', '2018-08-10 10:28:24', '2018-08-10 10:28:24'),
(135, 118, 'abc_9921.jpg', '2018-08-10 10:28:24', '2018-08-10 10:28:24'),
(136, 118, 'abc_7274.jpg', '2018-08-10 10:28:25', '2018-08-10 10:28:25'),
(137, 118, 'abc_4135.jpg', '2018-08-10 10:28:25', '2018-08-10 10:28:25'),
(138, 118, 'abc_7974.png', '2018-08-10 10:28:26', '2018-08-10 10:28:26'),
(139, 118, 'abc_4091.jpg', '2018-08-10 10:28:26', '2018-08-10 10:28:26'),
(140, 119, 'sdfds_5684.jpg', '2018-08-10 12:33:32', '2018-08-10 12:33:32'),
(141, 119, 'sdfds_9199.jpg', '2018-08-10 12:33:32', '2018-08-10 12:33:32'),
(142, 119, 'sdfds_7174.jpg', '2018-08-10 12:33:33', '2018-08-10 12:33:33'),
(143, 119, 'sdfds_1924.jpg', '2018-08-10 12:33:33', '2018-08-10 12:33:33'),
(144, 121, '13-08_9095.jpg', '2018-08-13 05:09:32', '2018-08-13 05:09:32'),
(145, 121, '13-08_1266.jpg', '2018-08-13 05:09:33', '2018-08-13 05:09:33'),
(146, 122, 'test-1_1709.jpg', '2018-08-13 06:20:42', '2018-08-13 06:20:42'),
(147, 122, 'test-1_6522.jpg', '2018-08-13 06:20:42', '2018-08-13 06:20:42'),
(148, 122, 'test-1_5951.jpg', '2018-08-13 06:20:43', '2018-08-13 06:20:43'),
(149, 122, 'test-1_1408.jpg', '2018-08-13 06:20:43', '2018-08-13 06:20:43'),
(150, 122, 'test-1_2203.jpg', '2018-08-13 06:20:44', '2018-08-13 06:20:44'),
(151, 122, 'test-1_7558.jpg', '2018-08-13 06:20:44', '2018-08-13 06:20:44'),
(152, 122, 'test-1_1679.jpg', '2018-08-13 06:20:45', '2018-08-13 06:20:45'),
(153, 122, 'test-1_2991.jpg', '2018-08-13 06:20:45', '2018-08-13 06:20:45'),
(154, 123, 'test-2_8652.jpg', '2018-08-13 07:21:37', '2018-08-13 07:21:37'),
(192, 127, 'test-3_3518.jpg', '2018-08-14 10:14:11', '2018-08-14 10:14:11'),
(193, 127, 'test-3_7462.jpg', '2018-08-14 10:14:11', '2018-08-14 10:14:11'),
(194, 127, 'test-3_6044.jpg', '2018-08-14 10:14:12', '2018-08-14 10:14:12'),
(195, 127, 'test-3_9686.jpg', '2018-08-14 10:14:12', '2018-08-14 10:14:12'),
(196, 127, 'test-3_5388.jpg', '2018-08-14 10:14:13', '2018-08-14 10:14:13'),
(197, 127, 'test-3_5134.jpg', '2018-08-14 10:14:13', '2018-08-14 10:14:13'),
(198, 127, 'test-3_6238.jpg', '2018-08-14 10:14:14', '2018-08-14 10:14:14'),
(199, 127, 'test-3_6968.jpg', '2018-08-14 10:14:14', '2018-08-14 10:14:14'),
(200, 127, 'test-3_3004.jpg', '2018-08-14 10:14:14', '2018-08-14 10:14:14'),
(201, 127, 'test-3_1400.jpg', '2018-08-14 10:14:15', '2018-08-14 10:14:15'),
(202, 127, 'test-3_4262.jpg', '2018-08-14 10:14:15', '2018-08-14 10:14:15'),
(203, 127, 'test-3_7704.jpg', '2018-08-14 10:14:16', '2018-08-14 10:14:16'),
(204, 127, 'test-3_3867.jpg', '2018-08-14 10:14:16', '2018-08-14 10:14:16'),
(205, 127, 'test-3_4872.jpg', '2018-08-14 10:14:17', '2018-08-14 10:14:17'),
(206, 127, 'test-3_5394.jpg', '2018-08-14 10:14:17', '2018-08-14 10:14:17'),
(207, 127, 'test-3_9396.jpg', '2018-08-14 10:14:18', '2018-08-14 10:14:18'),
(208, 130, 'gdfgd-1_2142.png', '2018-08-14 10:19:34', '2018-08-14 10:19:34'),
(209, 131, 'dsfa_1937.jpg', '2018-08-14 10:26:56', '2018-08-14 10:26:56'),
(210, 131, 'dsfa_1578.jpg', '2018-08-14 10:26:57', '2018-08-14 10:26:57'),
(211, 131, 'dsfa_5098.jpg', '2018-08-14 10:26:57', '2018-08-14 10:26:57'),
(212, 131, 'dsfa_5331.jpg', '2018-08-14 10:26:57', '2018-08-14 10:26:57'),
(213, 131, 'dsfa_1206.jpg', '2018-08-14 10:26:58', '2018-08-14 10:26:58'),
(214, 131, 'dsfa_6980.jpg', '2018-08-14 10:26:58', '2018-08-14 10:26:58'),
(215, 131, 'dsfa_1199.jpg', '2018-08-14 10:26:59', '2018-08-14 10:26:59'),
(225, 134, 'tes-5_5022.jpg', '2018-08-14 12:24:34', '2018-08-14 12:24:34'),
(226, 134, 'tes-5_2389.jpg', '2018-08-14 12:24:35', '2018-08-14 12:24:35'),
(227, 134, 'tes-5_6899.jpg', '2018-08-14 12:24:35', '2018-08-14 12:24:35'),
(228, 134, 'tes-5_8331.jpg', '2018-08-14 12:24:36', '2018-08-14 12:24:36'),
(229, 135, 'black-and-white-shoes_1445.jpeg', '2018-08-14 13:38:37', '2018-08-14 13:38:37'),
(230, 135, 'black-and-white-shoes_8556.jpeg', '2018-08-14 13:38:38', '2018-08-14 13:38:38'),
(231, 135, 'black-and-white-shoes_6264.jpeg', '2018-08-14 13:38:38', '2018-08-14 13:38:38'),
(232, 136, 'fodg-wrist-watche-blue_2325.jpg', '2018-08-15 05:13:14', '2018-08-15 05:13:14'),
(233, 136, 'fodg-wrist-watche-blue_5030.jpg', '2018-08-15 05:13:15', '2018-08-15 05:13:15'),
(234, 136, 'fodg-wrist-watche-blue_9219.jpg', '2018-08-15 05:13:16', '2018-08-15 05:13:16'),
(235, 137, 'golf-ball_6753.jpg', '2018-08-15 11:31:21', '2018-08-15 11:31:21'),
(236, 137, 'golf-ball_6143.jpg', '2018-08-15 11:31:21', '2018-08-15 11:31:21'),
(237, 137, 'golf-ball_8454.jpg', '2018-08-15 11:31:22', '2018-08-15 11:31:22'),
(238, 137, 'golf-ball_2924.jpg', '2018-08-15 11:31:22', '2018-08-15 11:31:22'),
(239, 137, 'golf-ball_5654.jpg', '2018-08-15 11:31:23', '2018-08-15 11:31:23'),
(240, 137, 'golf-ball_9111.jpg', '2018-08-15 11:31:23', '2018-08-15 11:31:23'),
(241, 137, 'golf-ball_8040.jpg', '2018-08-15 11:31:23', '2018-08-15 11:31:23'),
(242, 137, 'golf-ball_5085.jpg', '2018-08-15 11:31:24', '2018-08-15 11:31:24'),
(243, 137, 'golf-ball_1690.jpg', '2018-08-15 11:31:24', '2018-08-15 11:31:24'),
(244, 137, 'golf-ball_2061.jpg', '2018-08-15 11:31:25', '2018-08-15 11:31:25'),
(245, 137, 'golf-ball_9068.jpg', '2018-08-15 11:31:25', '2018-08-15 11:31:25'),
(246, 137, 'golf-ball_4311.jpg', '2018-08-15 11:31:26', '2018-08-15 11:31:26'),
(247, 137, 'golf-ball_6806.jpg', '2018-08-15 11:31:26', '2018-08-15 11:31:26'),
(248, 137, 'golf-ball_6939.jpg', '2018-08-15 11:31:26', '2018-08-15 11:31:26'),
(249, 137, 'golf-ball_3481.jpg', '2018-08-15 11:31:27', '2018-08-15 11:31:27'),
(250, 137, 'golf-ball_2548.jpg', '2018-08-15 11:31:27', '2018-08-15 11:31:27'),
(251, 137, 'golf-ball_1835.jpg', '2018-08-15 11:31:28', '2018-08-15 11:31:28'),
(252, 137, 'golf-ball_5688.jpg', '2018-08-15 11:31:28', '2018-08-15 11:31:28'),
(253, 137, 'golf-ball_5446.jpg', '2018-08-15 11:31:28', '2018-08-15 11:31:28'),
(254, 138, 'front-wheel-tyre_3867.jpg', '2018-08-16 05:01:13', '2018-08-16 05:01:13'),
(255, 138, 'front-wheel-tyre_4872.jpg', '2018-08-16 05:01:14', '2018-08-16 05:01:14'),
(256, 138, 'front-wheel-tyre_5394.jpg', '2018-08-16 05:01:14', '2018-08-16 05:01:14'),
(257, 138, 'front-wheel-tyre_9396.jpg', '2018-08-16 05:01:14', '2018-08-16 05:01:14'),
(258, 138, 'front-wheel-tyre_2142.jpg', '2018-08-16 05:01:15', '2018-08-16 05:01:15'),
(265, 140, 'harry-potter-1_1199.jpg', '2018-08-16 07:49:30', '2018-08-16 07:49:30'),
(266, 140, 'harry-potter-1_7600.jpg', '2018-08-16 07:49:30', '2018-08-16 07:49:30'),
(267, 140, 'harry-potter-1_6848.jpg', '2018-08-16 07:49:31', '2018-08-16 07:49:31'),
(268, 140, 'harry-potter-1_4657.jpg', '2018-08-16 07:49:31', '2018-08-16 07:49:31'),
(269, 140, 'harry-potter-1_8533.jpeg', '2018-08-16 07:49:32', '2018-08-16 07:49:32'),
(270, 140, 'harry-potter-1_7560.jpeg', '2018-08-16 07:49:32', '2018-08-16 07:49:32'),
(271, 141, 'red-lipsticks_9694.jpg', '2018-08-16 09:59:06', '2018-08-16 09:59:06'),
(272, 141, 'red-lipsticks_8775.jpg', '2018-08-16 09:59:07', '2018-08-16 09:59:07'),
(273, 141, 'red-lipsticks_6822.jpg', '2018-08-16 09:59:08', '2018-08-16 09:59:08'),
(274, 141, 'red-lipsticks_8267.jpg', '2018-08-16 09:59:09', '2018-08-16 09:59:09'),
(275, 141, 'red-lipsticks_5022.jpg', '2018-08-16 09:59:09', '2018-08-16 09:59:09'),
(276, 141, 'red-lipsticks_2389.jpg', '2018-08-16 09:59:10', '2018-08-16 09:59:10'),
(283, 142, 'adidas-sport-t-shirt_3128.png', '2018-08-16 12:51:21', '2018-08-16 12:51:21'),
(284, 142, 'adidas-sport-t-shirt_1441.jpg', '2018-08-16 12:51:21', '2018-08-16 12:51:21'),
(285, 142, 'adidas-sport-t-shirt_6862.jpg', '2018-08-16 12:51:22', '2018-08-16 12:51:22'),
(286, 142, 'adidas-sport-t-shirt_5420.png', '2018-08-16 12:51:22', '2018-08-16 12:51:22'),
(287, 142, 'adidas-sport-t-shirt_9794.jpg', '2018-08-16 12:51:22', '2018-08-16 12:51:22'),
(288, 142, 'adidas-sport-t-shirt_4100.jpg', '2018-08-16 12:51:23', '2018-08-16 12:51:23'),
(289, 142, 'adidas-sport-t-shirt_6193.jpg', '2018-08-16 12:51:23', '2018-08-16 12:51:23'),
(290, 142, 'adidas-sport-t-shirt_4113.jpg', '2018-08-16 12:51:23', '2018-08-16 12:51:23'),
(291, 142, 'adidas-sport-t-shirt_7831.jpg', '2018-08-16 12:51:24', '2018-08-16 12:51:24'),
(292, 142, 'adidas-sport-t-shirt_8479.jpg', '2018-08-16 12:51:24', '2018-08-16 12:51:24'),
(293, 142, 'adidas-sport-t-shirt_6200.jpg', '2018-08-16 12:51:24', '2018-08-16 12:51:24'),
(294, 143, 'desk-keyboard_8621.jpg', '2018-08-17 05:08:26', '2018-08-17 05:08:26'),
(295, 143, 'desk-keyboard_6694.jpg', '2018-08-17 05:08:26', '2018-08-17 05:08:26'),
(296, 143, 'desk-keyboard_6533.jpg', '2018-08-17 05:08:27', '2018-08-17 05:08:27'),
(297, 143, 'desk-keyboard_1578.jpg', '2018-08-17 05:08:27', '2018-08-17 05:08:27'),
(298, 144, 'wooden-dining-table-classic_3659.jpg', '2018-08-17 05:19:30', '2018-08-17 05:19:30'),
(299, 144, 'wooden-dining-table-classic_1945.jpg', '2018-08-17 05:19:31', '2018-08-17 05:19:31'),
(300, 145, 'garden-water-can-plastic_4965.jpg', '2018-08-17 05:32:19', '2018-08-17 05:32:19'),
(301, 145, 'garden-water-can-plastic_6786.jpg', '2018-08-17 05:32:19', '2018-08-17 05:32:19'),
(302, 145, 'garden-water-can-plastic_7360.jpg', '2018-08-17 05:32:20', '2018-08-17 05:32:20'),
(303, 146, 'rostaa-almonds_8150.jpg', '2018-08-17 05:49:19', '2018-08-17 05:49:19'),
(304, 146, 'rostaa-almonds_6366.jpg', '2018-08-17 05:49:19', '2018-08-17 05:49:19'),
(305, 146, 'rostaa-almonds_6698.jpg', '2018-08-17 05:49:19', '2018-08-17 05:49:19'),
(306, 146, 'rostaa-almonds_2780.jpg', '2018-08-17 05:49:19', '2018-08-17 05:49:19'),
(307, 146, 'rostaa-almonds_9477.jpg', '2018-08-17 05:49:20', '2018-08-17 05:49:20'),
(308, 146, 'rostaa-almonds_9346.jpg', '2018-08-17 05:49:20', '2018-08-17 05:49:20'),
(309, 146, 'rostaa-almonds_9926.jpg', '2018-08-17 05:49:21', '2018-08-17 05:49:21'),
(310, 146, 'rostaa-almonds_4085.jpg', '2018-08-17 05:49:21', '2018-08-17 05:49:21'),
(311, 147, 'philips-led-tube-ligth_3426.jpg', '2018-08-17 06:28:56', '2018-08-17 06:28:56'),
(312, 147, 'philips-led-tube-ligth_8073.jpg', '2018-08-17 06:28:57', '2018-08-17 06:28:57'),
(313, 147, 'philips-led-tube-ligth_2859.jpg', '2018-08-17 06:28:58', '2018-08-17 06:28:58'),
(314, 147, 'philips-led-tube-ligth_3220.jpg', '2018-08-17 06:28:58', '2018-08-17 06:28:58'),
(315, 148, 'taniqsh-wedding-ring-for-men_9718.jpg', '2018-08-17 06:57:11', '2018-08-17 06:57:11'),
(316, 148, 'taniqsh-wedding-ring-for-men_1158.jpg', '2018-08-17 06:57:12', '2018-08-17 06:57:12'),
(317, 148, 'taniqsh-wedding-ring-for-men_2997.jpg', '2018-08-17 06:57:13', '2018-08-17 06:57:13'),
(318, 148, 'taniqsh-wedding-ring-for-men_5463.jpg', '2018-08-17 06:57:13', '2018-08-17 06:57:13'),
(319, 148, 'taniqsh-wedding-ring-for-men_8076.jpg', '2018-08-17 06:57:14', '2018-08-17 06:57:14'),
(320, 148, 'taniqsh-wedding-ring-for-men_9434.jpg', '2018-08-17 06:57:15', '2018-08-17 06:57:15'),
(321, 148, 'taniqsh-wedding-ring-for-men_5617.jpg', '2018-08-17 06:57:15', '2018-08-17 06:57:15'),
(322, 148, 'taniqsh-wedding-ring-for-men_2758.jpg', '2018-08-17 06:57:16', '2018-08-17 06:57:16'),
(323, 148, 'taniqsh-wedding-ring-for-men_9334.jpg', '2018-08-17 06:57:17', '2018-08-17 06:57:17'),
(324, 148, 'taniqsh-wedding-ring-for-men_4845.jpg', '2018-08-17 06:57:17', '2018-08-17 06:57:17'),
(325, 148, 'taniqsh-wedding-ring-for-men_1553.jpg', '2018-08-17 06:57:18', '2018-08-17 06:57:18'),
(326, 148, 'taniqsh-wedding-ring-for-men_9272.jpg', '2018-08-17 06:57:18', '2018-08-17 06:57:18'),
(327, 148, 'taniqsh-wedding-ring-for-men_2102.jpg', '2018-08-17 06:57:19', '2018-08-17 06:57:19'),
(328, 148, 'taniqsh-wedding-ring-for-men_8225.jpg', '2018-08-17 06:57:19', '2018-08-17 06:57:19'),
(329, 148, 'taniqsh-wedding-ring-for-men_3861.jpg', '2018-08-17 06:57:20', '2018-08-17 06:57:20'),
(330, 148, 'taniqsh-wedding-ring-for-men_8060.jpg', '2018-08-17 06:57:21', '2018-08-17 06:57:21'),
(331, 148, 'taniqsh-wedding-ring-for-men_6103.jpg', '2018-08-17 06:57:21', '2018-08-17 06:57:21'),
(332, 148, 'taniqsh-wedding-ring-for-men_9296.jpg', '2018-08-17 06:57:22', '2018-08-17 06:57:22'),
(333, 149, '150-ton-mitsubishi-ac_3374.jpg', '2018-08-17 11:04:05', '2018-08-17 11:04:05'),
(334, 149, '150-ton-mitsubishi-ac_4400.jpg', '2018-08-17 11:04:05', '2018-08-17 11:04:05'),
(335, 149, '150-ton-mitsubishi-ac_9947.jpg', '2018-08-17 11:04:06', '2018-08-17 11:04:06'),
(336, 149, '150-ton-mitsubishi-ac_2225.jpg', '2018-08-17 11:04:06', '2018-08-17 11:04:06'),
(337, 150, 'american-tourister-red-bag_4259.jpeg', '2018-08-17 11:14:07', '2018-08-17 11:14:07'),
(338, 150, 'american-tourister-red-bag_8014.jpg', '2018-08-17 11:14:07', '2018-08-17 11:14:07'),
(339, 151, 'quality-guitar_6691.jpg', '2018-08-17 11:23:01', '2018-08-17 11:23:01'),
(340, 151, 'quality-guitar_3400.jpg', '2018-08-17 11:23:01', '2018-08-17 11:23:01'),
(343, 152, 'natraj-pens_2723.jpg', '2018-08-17 11:29:53', '2018-08-17 11:29:53'),
(344, 152, 'natraj-pens_6988.jpg', '2018-08-17 11:29:54', '2018-08-17 11:29:54'),
(345, 152, 'natraj-pens_4586.jpg', '2018-08-17 11:29:54', '2018-08-17 11:29:54'),
(346, 152, 'natraj-pens_9288.jpg', '2018-08-17 11:29:54', '2018-08-17 11:29:54'),
(347, 152, 'natraj-pens_8876.jpg', '2018-08-17 11:29:55', '2018-08-17 11:29:55'),
(348, 152, 'natraj-pens_2712.jpg', '2018-08-17 11:29:55', '2018-08-17 11:29:55'),
(349, 152, 'natraj-pens_7919.jpg', '2018-08-17 11:29:56', '2018-08-17 11:29:56'),
(350, 152, 'natraj-pens_4170.png', '2018-08-17 11:29:56', '2018-08-17 11:29:56'),
(351, 152, 'natraj-pens_4873.jpg', '2018-08-17 11:29:57', '2018-08-17 11:29:57'),
(352, 153, 'pedigree_2516.jpg', '2018-08-17 11:52:06', '2018-08-17 11:52:06'),
(353, 153, 'pedigree_2622.jpg', '2018-08-17 11:52:06', '2018-08-17 11:52:06'),
(354, 153, 'pedigree_9659.jpg', '2018-08-17 11:52:06', '2018-08-17 11:52:06'),
(355, 153, 'pedigree_1548.jpg', '2018-08-17 11:52:07', '2018-08-17 11:52:07'),
(356, 153, 'pedigree_5010.jpg', '2018-08-17 11:52:07', '2018-08-17 11:52:07'),
(357, 153, 'pedigree_6198.jpg', '2018-08-17 11:52:07', '2018-08-17 11:52:07'),
(358, 153, 'pedigree_4367.jpg', '2018-08-17 11:52:08', '2018-08-17 11:52:08'),
(359, 154, 'lotto-shoes-black_5288.jpg', '2018-08-17 12:11:50', '2018-08-17 12:11:50'),
(360, 154, 'lotto-shoes-black_4362.jpg', '2018-08-17 12:11:50', '2018-08-17 12:11:50'),
(361, 154, 'lotto-shoes-black_5033.jpg', '2018-08-17 12:11:51', '2018-08-17 12:11:51'),
(362, 154, 'lotto-shoes-black_6905.jpg', '2018-08-17 12:11:51', '2018-08-17 12:11:51'),
(363, 154, 'lotto-shoes-black_9150.jpg', '2018-08-17 12:11:51', '2018-08-17 12:11:51'),
(364, 155, 'fodg-watch_8072.jpg', '2018-08-17 12:33:51', '2018-08-17 12:33:51'),
(365, 155, 'fodg-watch_7741.jpg', '2018-08-17 12:33:52', '2018-08-17 12:33:52'),
(366, 155, 'fodg-watch_4773.jpg', '2018-08-17 12:33:53', '2018-08-17 12:33:53'),
(367, 155, 'fodg-watch_1744.jpg', '2018-08-17 12:33:53', '2018-08-17 12:33:53'),
(368, 155, 'fodg-watch_1418.jpg', '2018-08-17 12:33:53', '2018-08-17 12:33:53'),
(369, 155, 'fodg-watch_9597.jpg', '2018-08-17 12:33:54', '2018-08-17 12:33:54'),
(420, 151, 'quality-guitar_5878.download (4).jpg', '2018-08-18 13:42:44', '2018-08-18 13:42:44'),
(421, 87, '09-08-2018-product-2_3792.download.jpg', '2018-08-30 09:27:12', '2018-08-30 09:27:12'),
(422, 87, '09-08-2018-product-2_5937.download (1).jpg', '2018-08-30 09:27:12', '2018-08-30 09:27:12'),
(424, 86, '09-08-2018-product-2_9832.Blue_Dart_logo_transparent.png', '2018-08-30 09:29:14', '2018-08-30 09:29:14'),
(425, 86, '09-08-2018-product-2_2129.cash-on-delivery-500x500.png', '2018-08-30 09:30:48', '2018-08-30 09:30:48'),
(426, 86, '09-08-2018-product-2_5180.fedex_logo.png', '2018-08-30 09:30:48', '2018-08-30 09:30:48'),
(427, 159, 'sdfsf-2_5729.jpg', '2018-08-30 12:52:29', '2018-08-30 12:52:29'),
(428, 159, 'sdfsf-2_3164.jpg', '2018-08-30 12:52:29', '2018-08-30 12:52:29'),
(429, 159, 'sdfsf-2_2347.png', '2018-08-30 12:52:31', '2018-08-30 12:52:31'),
(438, 160, 'bikes-and-tractor-tyres-slider_5126.tvs-tyre-250x250.jpg', '2018-08-31 12:08:21', '2018-08-31 12:08:21'),
(439, 160, 'bikes-and-tractor-tyres-slider_6294.tvs-tyre-for-ajax-fiori-s-500x500.jpg', '2018-08-31 12:36:17', '2018-08-31 12:36:17'),
(440, 160, 'bikes-and-tractor-tyres-slider_3446.81vPGBvyMvL._SY355_.png', '2018-08-31 13:45:07', '2018-08-31 13:45:07'),
(441, 165, 'tvs-tyre-tube_7571.jpg', '2018-09-05 13:51:25', '2018-09-05 13:51:25'),
(442, 165, 'tvs-tyre-tube_1878.jpg', '2018-09-05 13:51:25', '2018-09-05 13:51:25'),
(443, 165, 'tvs-tyre-tube_3971.jpg', '2018-09-05 13:51:26', '2018-09-05 13:51:26');

-- --------------------------------------------------------

--
-- Structure de la table `recharge_history`
--

CREATE TABLE `recharge_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `recharge_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recharge_temp_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `res_trans_id` int(100) DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('Success','Failure','Aborted','Invalid') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operator` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recharge_history`
--

INSERT INTO `recharge_history` (`id`, `service_id`, `user_id`, `recharge_num`, `transaction_id`, `recharge_temp_id`, `operator_id`, `circle`, `amount`, `res_trans_id`, `status`, `payment_status`, `operator`, `created_at`, `updated_at`) VALUES
(50, 1, 15, '9624949787', '88334540156647568', NULL, 58, '6', 10, NULL, 'Success', NULL, NULL, '2018-04-11 15:52:39', '2018-04-11 15:53:19'),
(51, 1, 47, '7359420100', '14105775230564177', NULL, 58, '6', 10, NULL, NULL, NULL, NULL, '2018-04-13 07:23:28', '2018-04-13 07:23:28'),
(53, 1, 47, '7359420100', '68114804476499560', NULL, 58, '6', 10, NULL, NULL, NULL, NULL, '2018-04-13 11:09:55', '2018-04-13 11:09:55'),
(54, 1, 47, '7359420100', '97274236772209408', NULL, 58, '6', 10, NULL, NULL, NULL, NULL, '2018-04-13 11:35:05', '2018-04-13 11:35:05'),
(55, 1, 47, '7359420100', '82456827242858704', NULL, 58, '6', 50, NULL, NULL, NULL, NULL, '2018-04-13 11:54:20', '2018-04-13 11:54:20'),
(56, 1, 46, '7359420100', '5ad08d99ebdf7', NULL, 58, '7', 10, 1548211748, 'Success', NULL, NULL, '2018-04-13 12:29:37', '2018-04-13 12:29:43'),
(57, 1, 46, '7359420100', '5ad08df854fc2', NULL, 58, '7', 10, 1548211754, 'Failure', NULL, NULL, '2018-04-13 12:31:12', '2018-04-13 12:31:19'),
(58, 1, 46, '7359420100', '5ad08e05a0d40', NULL, 58, '7', 10, 1548224166, 'Success', 'Success', 'OperatorId:', '2018-04-13 12:31:25', '2018-04-16 13:53:09'),
(59, 1, 46, '7359420100', '5ad093b82f980', NULL, 58, '7', 10, 1548211847, 'Success', NULL, NULL, '2018-04-13 12:55:44', '2018-04-13 12:55:50'),
(60, 1, 46, '7359420100', '5ad094494f319', NULL, 58, '7', 11, 1548211859, 'Success', NULL, NULL, '2018-04-13 12:58:09', '2018-04-13 12:58:14'),
(61, 1, 46, '7359420100', '5ad0969a33ccd', NULL, 58, '7', 11, 1548211894, 'Success', NULL, NULL, '2018-04-13 13:08:02', '2018-04-13 13:08:07'),
(62, 1, 48, '9993767636', '5ad1b9d13d877', NULL, 48, '15', 10, 1548215236, 'Success', NULL, NULL, '2018-04-14 09:50:33', '2018-04-14 09:51:09'),
(63, 1, 48, '9427666688', '5ad1bd76c4a78', NULL, 53, '7', 10, 1548215275, 'Success', NULL, NULL, '2018-04-14 10:06:06', '2018-04-14 10:06:12'),
(64, 1, 48, '9427666688', '5ad1beb32cf7e', NULL, 53, '7', 10, 1548215294, 'Failure', NULL, NULL, '2018-04-14 10:11:23', '2018-04-14 10:11:29'),
(65, 1, 48, '9427666688', '5ad1beead92fc', NULL, 53, '7', 12, 1548215297, 'Success', NULL, NULL, '2018-04-14 10:12:18', '2018-04-14 10:12:24'),
(66, 1, 48, '9427666688', '5ad1bf60b650a', NULL, 78, '7', 10, 1548215308, 'Failure', NULL, NULL, '2018-04-14 10:14:16', '2018-04-14 10:14:23'),
(67, 2, 31, '8140666688', '49536466803401712', '', 78, '6', 10, 1548215325, 'Failure', NULL, '', '2018-04-14 10:17:01', '2018-04-14 10:22:53'),
(68, 1, 48, '9427666688', '5ad1ca2cbb208', NULL, 53, '7', 10, 1548215383, 'Success', NULL, NULL, '2018-04-14 11:00:20', '2018-04-14 11:00:28'),
(69, 1, 46, '7359420100', '5ad1d0df7b8af', NULL, 58, '7', 11, 1548215436, 'Success', NULL, NULL, '2018-04-14 11:28:55', '2018-04-14 11:29:01'),
(70, 1, 46, '7359420100', '5ad1d192e03d6', NULL, 58, '7', 11, 1548215444, 'Success', NULL, NULL, '2018-04-14 11:31:54', '2018-04-14 11:32:01'),
(71, 1, 46, '7359420100', '5ad1d1bd70ad1', NULL, 58, '7', 10, 1548215446, 'Success', NULL, NULL, '2018-04-14 11:32:37', '2018-04-14 11:32:42'),
(72, 1, 46, '9427666688', '5ad1d28d25c94', NULL, 53, '7', 10, 1548215456, 'Success', NULL, NULL, '2018-04-14 11:36:05', '2018-04-14 11:36:12'),
(73, 1, 46, '7359420100', '5ad1d7815a1c5', NULL, 58, '7', 11, 1548215515, 'Success', NULL, NULL, '2018-04-14 11:57:13', '2018-04-14 11:57:19'),
(74, 1, 46, '7359420100', '5ad1da6d819ad', NULL, 58, '7', 11, 1548215554, 'Success', NULL, NULL, '2018-04-14 12:09:41', '2018-04-14 12:09:47'),
(75, 1, 46, '7359420100', '5ad1da8e1c7fa', NULL, 58, '7', 11, 1548215555, 'Success', NULL, NULL, '2018-04-14 12:10:14', '2018-04-14 12:10:20'),
(76, 1, 46, '7359420100', '5ad1dabd52958', NULL, 58, '7', 11, 1548215558, 'Success', NULL, NULL, '2018-04-14 12:11:01', '2018-04-14 12:11:07'),
(77, 1, 46, '7359420100', '5ad1dba9d7900', NULL, 58, '7', 11, 1548215570, 'Success', NULL, NULL, '2018-04-14 12:14:57', '2018-04-14 12:15:04'),
(78, 1, 46, '7359420100', '5ad1dbce3f50a', NULL, 58, '7', 11, 1548215573, 'Success', NULL, NULL, '2018-04-14 12:15:34', '2018-04-14 12:15:39'),
(79, 1, 46, '7359420100', '5ad1dbff0a266', NULL, 58, '7', 11, 1548215578, 'Success', NULL, NULL, '2018-04-14 12:16:23', '2018-04-14 12:16:28'),
(80, 1, 46, '7359420100', '5ad1dcb43b05e', NULL, 58, '7', 11, 1548215592, 'Success', NULL, NULL, '2018-04-14 12:19:24', '2018-04-14 12:19:29'),
(82, 1, 46, '7359420100', '5ad4408588b01', NULL, 58, '7', 11, 1548221970, 'Success', NULL, NULL, '2018-04-16 07:49:49', '2018-04-16 07:49:55'),
(83, 1, 46, '7359420100', '5ad473d99bc63', NULL, 58, '7', 11, 1548223443, 'Success', NULL, NULL, '2018-04-16 11:28:49', '2018-04-16 11:28:55'),
(87, 1, 47, '7359420100', '5ad49416eed68', NULL, 58, '7', 11, 1548224154, 'Success', NULL, NULL, '2018-04-16 13:46:22', '2018-04-16 13:46:28'),
(88, 1, 47, '7359420100', '5ad4942f046b6', NULL, 58, '7', 11, NULL, NULL, NULL, NULL, '2018-04-16 13:46:47', '2018-04-16 13:46:47'),
(90, 1, 15, '9624949787', '57592102758703197', NULL, 58, '6', 11, 1548224378, 'Success', 'Success', 'OperatorId:929866', '2018-04-16 13:52:14', '2018-04-16 14:20:54'),
(91, 1, 46, '7359420100', '5ad49ab665f35', NULL, 58, '7', 11, NULL, NULL, NULL, NULL, '2018-04-16 14:14:38', '2018-04-16 14:14:38'),
(92, 1, 46, '7359420100', '5ad49beb9597c', NULL, 58, '7', 11, 1548224382, 'Success', 'Success', 'OperatorId:929870', '2018-04-16 14:19:47', '2018-04-16 14:21:30'),
(93, 1, 46, '7359420100', '5ad49e38358c0', NULL, 58, '7', 11, 1548224443, 'Success', 'Success', 'OperatorId:929893', '2018-04-16 14:29:36', '2018-04-16 14:30:28'),
(94, 1, 46, '7359420100', '5ad49f6e01ee5', NULL, 58, '7', 11, 1548224475, 'Success', 'Success', 'OperatorId:929913', '2018-04-16 14:34:46', '2018-04-16 14:35:31'),
(95, 1, 46, '7359420100', '5ad4a298268e8', NULL, 58, '7', 11, NULL, NULL, NULL, NULL, '2018-04-16 14:48:16', '2018-04-16 14:48:16'),
(96, 1, 46, '7359420100', '5ad4a29b13acf', NULL, 58, '7', 11, NULL, NULL, NULL, NULL, '2018-04-16 14:48:19', '2018-04-16 14:48:19'),
(97, 1, 46, '7359420100', '5ad4a30746e08', NULL, 58, '7', 11, 1548224600, 'Success', 'Success', 'OperatorId:929952', '2018-04-16 14:50:07', '2018-04-16 14:50:46'),
(98, 1, 46, '7359420100', '5ad4a376b6082', NULL, 58, '7', 11, 1548224618, 'Success', 'Success', 'OperatorId:929959', '2018-04-16 14:51:58', '2018-04-16 14:52:42'),
(99, 1, 46, '7359420100', '5ad4a4425e629', NULL, 58, '7', 11, 1548224646, 'Success', 'Success', 'OperatorId:929963', '2018-04-16 14:55:22', '2018-04-16 14:56:04'),
(100, 1, 46, '7359420100', '5ad4a4d041438', NULL, 58, '7', 11, 1548224669, 'Success', 'Success', 'OperatorId:929969', '2018-04-16 14:57:44', '2018-04-16 14:58:23'),
(101, 1, 46, '7359420100', '5ad4a68fd4ba0', NULL, 58, '7', 11, 1548224735, 'Success', 'Success', 'OperatorId:929986', '2018-04-16 15:05:11', '2018-04-16 15:05:51'),
(102, 1, 46, '7359420100', '5ad4a74c1353d', NULL, 58, '7', 11, 1548224770, 'Success', 'Success', 'OperatorId:929995', '2018-04-16 15:08:20', '2018-04-16 15:08:51'),
(103, 1, 46, '7359420100', '5ad4a87111e64', NULL, 58, '7', 11, 1548224807, 'Success', 'Success', 'OperatorId:930009', '2018-04-16 15:13:13', '2018-04-16 15:13:47'),
(104, 1, 46, '7359420100', '5ad4a8ee7b3fb', NULL, 58, '7', 11, 1548224835, 'Success', 'Success', 'OperatorId:930014', '2018-04-16 15:15:18', '2018-04-16 15:15:47'),
(105, 1, 46, '7359420100', '5ad4ab73c6b73', NULL, 58, '7', 11, 1548224933, 'Success', 'Success', 'OperatorId:930048', '2018-04-16 15:26:03', '2018-04-16 15:26:36'),
(106, 1, 46, '7359420100', '5ad5865a9abb0', NULL, 58, '6', 11, 1548226724, 'Success', 'Success', 'OperatorId:930608', '2018-04-17 07:00:02', '2018-04-17 07:00:32'),
(107, 1, 46, '7359420100', '5ad5871409ba4', NULL, 58, '6', 11, NULL, NULL, NULL, NULL, '2018-04-17 07:03:08', '2018-04-17 07:03:08'),
(108, 1, 46, '7359420100', '5ad5877a0f282', NULL, 58, '6', 11, 1548226739, 'Success', 'Success', 'OperatorId:930621', '2018-04-17 07:04:50', '2018-04-17 07:05:13'),
(109, 3, 46, '7359420100', '5ad58904f004e', NULL, 58, '6', 11, 1548226775, 'Success', 'Success', 'OperatorId:930642', '2018-04-17 07:11:24', '2018-04-17 07:11:49'),
(110, 1, 46, '7359420100', '5ad58a210b941', NULL, 58, '6', 11, 1548226805, 'Success', 'Success', 'OperatorId:930668', '2018-04-17 07:16:09', '2018-04-17 07:16:33'),
(111, 1, 46, '7359420100', '5ad5fc2c7b0e4', NULL, 58, '6', 11, 1548229743, 'Success', 'Success', 'OperatorId:453937', '2018-04-17 15:22:44', '2018-04-17 15:23:07'),
(112, 1, 15, '9610003839', '75984043166359822', NULL, 48, '5', 100, 1548233220, 'Success', NULL, 'OperatorId:462216', '2018-04-18 11:38:48', '2018-04-18 11:40:25'),
(113, 1, NULL, '7339241846', '00204220653930779', '5ad77bb3a5eb2', 48, '4', 50, NULL, NULL, NULL, NULL, '2018-04-18 18:39:07', '2018-04-18 18:39:07'),
(114, 1, 51, '9993767636', '5ad77f9850a20', NULL, 48, '14', 10, 1548235591, 'Success', 'Success', 'OperatorId:200778', '2018-04-18 18:55:44', '2018-04-18 18:56:47'),
(115, 2, 51, '9940278677', '5ad784ba62cbd', NULL, 75, '20', 400, 1548235600, 'Failure', 'Success', '0', '2018-04-18 19:17:38', '2018-04-18 19:18:42'),
(116, 2, 51, '9940278677', '5ad7855826108', NULL, 75, '20', 349, 1548235603, 'Failure', 'Success', '0', '2018-04-18 19:20:16', '2018-04-18 19:21:07'),
(117, 1, 51, '9724666688', '5ad81a24db8be', NULL, 53, '6', 10, 1548236063, 'Success', 'Success', 'OperatorId:1334596', '2018-04-19 05:55:08', '2018-04-19 05:55:35'),
(118, 2, 51, '8140666688', '5ad81a747f233', NULL, 78, '6', 10, 1548236071, 'Failure', 'Success', '', '2018-04-19 05:56:28', '2018-04-19 05:57:04'),
(121, 1, 46, '7359420100', '5ad9ed82d49ad', NULL, 58, '6', 11, 1548242931, 'Success', NULL, NULL, '2018-04-20 15:09:14', '2018-04-20 15:09:20'),
(122, 4, 15, '9898098980', '23973288873874997', NULL, 49, '6', 100, 1548243057, 'Success', 'Success', 'OperatorId:4195489', '2018-04-20 15:19:38', '2018-04-20 15:20:44'),
(123, 1, 15, '9993767636', '36799892409173272', NULL, 48, '14', 10, NULL, NULL, NULL, NULL, '2018-04-21 09:47:35', '2018-04-21 09:47:35'),
(124, 1, 50, '7339241846', '20622906057360825', '', 48, '20', 70, NULL, NULL, NULL, NULL, '2018-04-22 06:50:08', '2018-04-22 06:50:41'),
(125, 1, 15, '9427666688', '60301570855639050', NULL, 53, '6', 10, NULL, NULL, NULL, NULL, '2018-04-25 13:11:22', '2018-04-25 13:11:22'),
(126, 2, 46, '9909957898', '5ae08a41dc502', NULL, 85, '6', 500, 1548260838, 'Failure', 'Success', '', '2018-04-25 15:31:37', '2018-04-25 15:37:54'),
(127, 1, 53, '9624949787', '34635460011462856', NULL, 58, '6', 11, 1548262776, 'Success', 'Success', 'OperatorId:949325', '2018-04-26 08:12:40', '2018-04-26 08:13:47'),
(128, 1, 46, '7359420100', '5ae33b3d5400c', NULL, 58, '6', 11, 1548268779, 'Success', NULL, NULL, '2018-04-27 16:31:17', '2018-04-27 16:31:23'),
(129, 1, 15, '7359420100', '5ae33d1cf0ab3', NULL, 58, '6', 11, 1548268819, 'Success', NULL, NULL, '2018-04-27 16:39:16', '2018-04-27 16:39:23'),
(130, 1, 50, '7339241846', '63823490180990601', NULL, 48, '20', 100, NULL, NULL, NULL, NULL, '2018-04-29 07:26:21', '2018-04-29 07:26:21');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2018-02-23 10:24:15', '2018-02-23 10:24:15'),
(2, 'employee', 'Project Employee', 'User is allowed to manage users', '2018-02-23 10:24:15', '2018-02-23 10:24:15'),
(3, 'customer', 'Project User', 'Simple user', '2018-02-23 10:24:15', '2018-02-23 10:24:15'),
(4, 'seller', 'Project Seller', 'Project seller', '2018-02-23 10:24:15', '2018-02-23 10:24:15');

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(15, 3),
(31, 3),
(35, 4),
(47, 3),
(48, 3),
(50, 3),
(51, 3),
(52, 4),
(53, 3),
(54, 2),
(55, 2),
(56, 2),
(57, 3),
(58, 4),
(59, 4),
(60, 3),
(61, 4),
(62, 4),
(63, 4),
(64, 2),
(65, 4),
(66, 4);

-- --------------------------------------------------------

--
-- Structure de la table `seller_holiday`
--

CREATE TABLE `seller_holiday` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `holiday_dates` date DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `seller_holiday`
--

INSERT INTO `seller_holiday` (`id`, `user_id`, `holiday_dates`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 52, '2018-07-31', 'All day close', '2018-07-30 06:22:34', '2018-07-30 06:22:34'),
(2, 52, '2018-08-02', 'Testting', '2018-07-30 06:45:19', '2018-07-30 06:45:19'),
(3, 52, '2018-07-29', 'tes', '2018-07-30 06:48:19', '2018-07-30 06:48:19'),
(4, 58, '2018-10-20', 'Eve', '2018-10-19 22:01:38', '2018-10-19 22:01:38');

-- --------------------------------------------------------

--
-- Structure de la table `seller_payment_history`
--

CREATE TABLE `seller_payment_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `seller_payment_id` int(10) UNSIGNED NOT NULL,
  `amount` double DEFAULT NULL,
  `payment_status` int(10) UNSIGNED NOT NULL COMMENT '0=pending,1=approve,2=decline,3=withdraw',
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `seller_payment_history`
--

INSERT INTO `seller_payment_history` (`id`, `seller_payment_id`, `amount`, `payment_status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1500, 0, NULL, '2018-08-04 07:04:33', '2018-08-04 07:04:33'),
(2, 1, 1500, 1, NULL, '2018-08-04 07:04:40', '2018-08-04 07:04:40'),
(3, 1, 1500, 3, 'Done', '2018-08-04 07:04:47', '2018-08-04 07:04:47'),
(4, 2, 1500, 0, NULL, '2018-08-04 07:05:08', '2018-08-04 07:05:08'),
(5, 2, 1500, 2, 'Maintenance', '2018-08-04 07:05:30', '2018-08-04 07:05:30'),
(6, 3, 1000, 0, NULL, '2018-08-04 07:08:48', '2018-08-04 07:08:48'),
(7, 3, 100000, 1, NULL, '2018-08-04 07:09:10', '2018-08-04 07:09:10'),
(8, 3, 1000, 3, 'hkhj', '2018-08-04 07:11:30', '2018-08-04 07:11:30');

-- --------------------------------------------------------

--
-- Structure de la table `seller_payment_request`
--

CREATE TABLE `seller_payment_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` double DEFAULT NULL,
  `payment_status` int(10) UNSIGNED NOT NULL COMMENT '0=pending,1=approve,2=decline,3=withdraw',
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `seller_payment_request`
--

INSERT INTO `seller_payment_request` (`id`, `user_id`, `amount`, `payment_status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 52, 1500, 3, 'Done', '2018-08-04 12:34:33', '2018-08-04 07:04:47'),
(2, 52, 1500, 2, 'Maintenance', '2018-08-04 12:35:08', '2018-08-04 07:05:30'),
(3, 52, 1000, 3, 'hkhj', '2018-08-04 12:38:48', '2018-08-04 07:11:30');

-- --------------------------------------------------------

--
-- Structure de la table `seller_policy`
--

CREATE TABLE `seller_policy` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `seller_policy`
--

INSERT INTO `seller_policy` (`id`, `desc`, `image`, `created_at`, `updated_at`) VALUES
(1, '<div>\r\n<h2 style=\"text-align: left;\">What is Lorem Ipsum?</h2>\r\n<p style=\"text-align: left;\"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2 style=\"text-align: left;\">Why do we use it?</h2>\r\n<p style=\"text-align: left;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>', 'faq_1524031130.jpg', '2018-04-18 07:28:50', '2018-04-18 07:28:50');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Prepaid Recharge', 'prepaid-recharge', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(2, 'Postpaid Recharge', 'postpaid-recharge', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(3, 'DataCard', 'datacard', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(4, 'DTH Recharge', 'dth-recharge', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(5, 'Electricity', 'electricity', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(6, 'Gas', 'gas', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(7, 'Water', 'water', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(8, 'Insurance', 'insurance', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(9, 'Broadband', 'broadband', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(10, 'Landline', 'landline', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(11, 'Bus', 'bus', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(12, 'Domestic Hotel', 'domestic-hotel', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(13, 'International Hotel', 'international-hotel', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(14, 'Domestic Flights', 'domestic-flights', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(15, 'International Flights', 'international-flights', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(16, 'DMT', 'dmt', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(17, 'ECommerce', 'ecommerce', '2018-02-23 12:34:53', '2018-02-23 12:34:53'),
(18, 'Multi Vendor', 'multi-vendor', '2018-02-23 12:34:53', '2018-02-23 12:34:53');

-- --------------------------------------------------------

--
-- Structure de la table `shipping_history`
--

CREATE TABLE `shipping_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `status` enum('dispute','ontheway','nearbyyou','delivered') COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `shipping_history`
--

INSERT INTO `shipping_history` (`id`, `order_id`, `status`, `delivery_date`, `remark`, `created_at`, `updated_at`) VALUES
(1, 56, 'ontheway', '2018-04-21 20:18:00', 'hiii', '2018-04-21 08:20:16', '2018-04-21 09:24:52'),
(2, 56, 'nearbyyou', '2018-04-27 20:18:00', 'product near by you', '2018-04-21 08:23:27', '2018-04-21 08:23:27'),
(3, 56, 'delivered', '2018-04-21 20:18:00', 'hi', '2018-04-21 09:26:55', '2018-04-21 09:26:55'),
(4, 57, 'ontheway', '2018-04-24 20:18:00', 'hii', '2018-04-21 09:35:00', '2018-04-21 09:35:00'),
(5, 57, 'dispute', '2018-04-25 20:18:00', 'hi', '2018-04-21 09:41:23', '2018-04-21 09:41:23'),
(6, 63, 'dispute', '2018-07-28 20:18:00', NULL, '2018-07-27 07:09:57', '2018-07-27 07:56:06'),
(10, 63, 'nearbyyou', '2018-07-28 20:18:00', NULL, '2018-07-27 10:00:06', '2018-07-27 10:00:06'),
(9, 63, 'ontheway', '2018-07-28 20:18:00', NULL, '2018-07-27 09:59:09', '2018-07-27 09:59:09'),
(11, 63, 'delivered', '2018-07-28 20:18:00', NULL, '2018-07-27 10:00:47', '2018-07-27 10:00:47'),
(12, 64, 'ontheway', '2018-08-03 20:18:00', 'Product is on the way', '2018-08-02 05:07:54', '2018-08-02 05:07:54'),
(13, 64, 'dispute', '2018-08-02 20:18:00', NULL, '2018-08-02 05:08:36', '2018-08-02 05:08:36'),
(14, 64, 'nearbyyou', '2018-08-03 20:18:00', NULL, '2018-08-02 05:09:12', '2018-08-02 05:09:12'),
(15, 64, 'delivered', '2018-08-04 20:18:00', NULL, '2018-08-02 05:09:40', '2018-08-02 05:09:40'),
(16, 66, 'ontheway', '2018-08-04 20:18:00', NULL, '2018-08-02 06:34:40', '2018-08-02 06:34:40'),
(21, 67, 'ontheway', '2018-08-04 20:18:00', NULL, '2018-08-02 13:04:19', '2018-08-02 13:04:19'),
(22, 67, 'nearbyyou', '2018-08-05 20:18:00', NULL, '2018-08-02 13:04:38', '2018-08-02 13:04:38'),
(24, 67, 'delivered', '2018-08-06 20:18:00', NULL, '2018-08-02 13:20:33', '2018-08-02 13:20:33'),
(25, 68, 'dispute', '2018-08-04 20:18:00', NULL, '2018-08-04 12:27:32', '2018-08-04 12:27:32'),
(26, 68, 'ontheway', '2018-08-04 20:18:00', NULL, '2018-08-04 12:27:51', '2018-08-04 12:27:51'),
(27, 68, 'nearbyyou', '2018-08-05 20:18:00', NULL, '2018-08-04 12:28:06', '2018-08-04 12:28:06'),
(28, 68, 'delivered', '2018-08-05 20:18:00', NULL, '2018-08-04 12:28:23', '2018-08-04 12:28:23'),
(29, 70, 'dispute', '2018-08-06 20:18:00', NULL, '2018-08-06 04:57:16', '2018-08-06 04:57:16'),
(30, 70, 'ontheway', '2018-08-07 20:18:00', NULL, '2018-08-06 04:57:38', '2018-08-06 04:57:38'),
(31, 70, 'nearbyyou', '2018-08-07 20:18:00', NULL, '2018-08-06 04:57:53', '2018-08-06 04:57:53'),
(32, 70, 'delivered', '2018-08-07 20:18:00', NULL, '2018-08-06 04:58:08', '2018-08-06 04:58:08');

-- --------------------------------------------------------

--
-- Structure de la table `shipping_information`
--

CREATE TABLE `shipping_information` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_code` int(11) NOT NULL,
  `mobile_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `shipping_information`
--

INSERT INTO `shipping_information` (`id`, `user_id`, `first_name`, `last_name`, `city`, `state`, `pin_code`, `mobile_num`, `address`, `status`, `created_at`, `updated_at`) VALUES
(5, 31, 'amit', 'patel', 'rajkot', 'Illinois', 360005, '8140666688', 'dsjfka fkfjfjakjdfka djf ajdf djfa', 0, '2018-03-27 19:10:19', '2018-04-24 06:53:06'),
(7, 47, 'jaykishan', 'gauswami', 'Rajkot', 'Gujarat', 360001, '7016587490', 'dsdsgdsg\r\ndsg\r\ndsgds\r\ngds', 0, '2018-04-11 15:29:19', '2018-04-25 13:13:32'),
(8, 47, 'jk', 'jk', 'Rajkot', 'Gujarat', 360001, '7589456889', 'asdfasfefa\r\nasfaew', 0, '2018-04-12 08:05:06', '2018-05-07 19:49:23'),
(13, 51, 'amit', 'patel', 'rajkot', 'gujarat', 360005, '9427666688', 'fghb fg\nhhjjjjkkjjkiffg\nhjkkkhj', 0, '2018-04-18 19:34:11', '2018-05-07 19:49:23'),
(14, 48, 'amit', 'patel', 'Rajkot', 'Gujarat', 360001, '9427666688', 'kdlsajfkl ajdfakjdf djfakj', 0, '2018-04-18 19:47:59', '2018-05-07 19:49:23'),
(17, 46, 'jk', 'jk', 'rajkot', '7359420100', 360001, '7359420100', 'hjdtdys\nshdyh', 0, '2018-04-20 14:16:24', '2018-05-07 19:49:23'),
(18, 53, 'sanjay', 'mokariya', 'Ahmedabad', 'Gujarat', 360005, '9624949787', 'skfsgkjldfjgldjfgjgdljdlj', 0, '2018-04-21 08:01:16', '2018-05-07 19:49:23'),
(19, 15, 'amit', 'patel', 'Rajkot', 'Gujarat', 360001, '9427666688', 'jdhfjkahd\r\ndfakdjfalkf\r\nadkfakld', 1, '2018-04-21 08:02:38', '2018-05-11 06:03:47'),
(20, 57, 'Puneet', 'Kumar', 'Bhilai', 'Chhattisgarh', 490020, '9993767636', 'qwrtoivjjkl', 0, '2018-05-07 19:49:11', '2018-05-11 06:03:47');

-- --------------------------------------------------------

--
-- Structure de la table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `states`
--

INSERT INTO `states` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(2, 'Maharashtra', 'MH', '2018-03-23 11:53:14', '2018-03-23 12:02:13'),
(3, 'Delhi', 'DL', '2018-03-23 11:53:14', '2018-03-23 12:02:13'),
(4, 'Karnataka', 'KA', '2018-03-23 11:53:14', '2018-03-23 12:02:13'),
(5, 'Gujarat', 'GJ', '2018-03-23 11:53:14', '2018-03-23 12:02:13'),
(6, 'Telangana', 'TG', '2018-03-23 11:53:14', '2018-03-23 11:53:14'),
(7, 'Tamil Nadu', 'TN', '2018-03-23 11:53:14', '2018-03-23 12:02:13'),
(8, 'West Bengal', 'WB', '2018-03-23 11:53:14', '2018-03-23 12:02:13'),
(9, 'Rajasthan', 'RJ', '2018-03-23 11:53:14', '2018-03-23 12:02:13'),
(10, 'Uttar Pradesh', 'UP', '2018-03-23 11:53:15', '2018-03-23 12:02:13'),
(11, 'Bihar', 'BR', '2018-03-23 11:53:15', '2018-03-23 12:02:13'),
(12, 'Madhya Pradesh', 'MP', '2018-03-23 11:53:15', '2018-03-23 12:02:13'),
(13, 'Andhra Pradesh', 'AP', '2018-03-23 11:53:15', '2018-03-23 12:02:13'),
(14, 'Punjab', 'PB', '2018-03-23 11:53:15', '2018-03-23 12:02:13'),
(15, 'Haryana', 'HR', '2018-03-23 11:53:15', '2018-03-23 12:02:13'),
(16, 'Jammu and Kashmir', 'JK', '2018-03-23 11:53:15', '2018-03-23 11:53:15'),
(17, 'Jharkhand', 'JH', '2018-03-23 11:53:15', '2018-03-23 12:02:13'),
(18, 'Chhattisgarh', 'CT', '2018-03-23 11:53:15', '2018-03-23 12:02:13'),
(19, 'Assam', 'AS', '2018-03-23 11:53:16', '2018-03-23 12:02:13'),
(20, 'Chandigarh', 'CH', '2018-03-23 11:53:16', '2018-03-23 12:02:13'),
(21, 'Odisha', 'OR', '2018-03-23 11:53:16', '2018-03-23 12:02:13'),
(22, 'Kerala', 'KL', '2018-03-23 11:53:16', '2018-03-23 12:02:13'),
(23, 'Uttarakhand', 'UK', '2018-03-23 11:53:17', '2018-03-23 12:02:13'),
(24, 'Puducherry', 'PY', '2018-03-23 11:53:17', '2018-03-23 12:02:13'),
(25, 'Tripura', 'TR', '2018-03-23 11:53:18', '2018-03-23 12:02:13'),
(26, 'Mizoram', 'MZ', '2018-03-23 11:53:19', '2018-03-23 12:02:13'),
(27, 'Meghalaya', 'ML', '2018-03-23 11:53:19', '2018-03-23 12:02:13'),
(28, 'Manipur', 'MN', '2018-03-23 11:53:19', '2018-03-23 12:02:13'),
(29, 'Himachal Pradesh', 'HP', '2018-03-23 11:53:23', '2018-03-23 12:02:13'),
(30, 'Nagaland', 'NL', '2018-03-23 11:53:24', '2018-03-23 12:02:13'),
(31, 'Goa', 'GA', '2018-03-23 11:53:26', '2018-03-23 12:02:13'),
(32, 'Andaman and Nicobar Islands', 'AN', '2018-03-23 11:53:26', '2018-03-23 11:53:26'),
(33, 'Arunachal Pradesh', 'AR', '2018-03-23 11:53:40', '2018-03-23 12:02:13'),
(34, 'Dadra and Nagar Haveli', 'DN', '2018-03-23 11:53:50', '2018-03-23 12:02:13');

-- --------------------------------------------------------

--
-- Structure de la table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_cat_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb_img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_type` enum('flat','percentage') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_desc` text COLLATE utf8mb4_unicode_ci,
  `m_keywords` text COLLATE utf8mb4_unicode_ci,
  `m_tag` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `desc`, `sub_cat_img`, `thumb_img`, `slug`, `commission`, `commission_type`, `m_title`, `m_desc`, `m_keywords`, `m_tag`, `created_at`, `updated_at`) VALUES
(1, 4, 'Fine Art', 'Fine Art Products', '1519708606.jpg', 'default.png', 'kitchen-dining', NULL, NULL, 'Fine Art', 'Fine Art', 'Fine Art', 'Fine Art', '2018-02-27 05:16:46', '2018-07-21 17:22:50'),
(2, 4, 'Kitchen Storage & Containers', 'Kitchen Storage & Containers', NULL, 'default.png', 'sub-category-2', '10', 'percentage', 'Kitchen Storage & Containers', 'Kitchen Storage & Containers', 'Kitchen Storage & Containers', 'Kitchen Storage & Containers', '2018-03-19 17:10:02', '2018-07-21 17:19:26'),
(3, 3, 'Mobile', 'Mobile', '1532183766.jpg', 'default.png', 'mobile', '10', 'percentage', 'Mobile', 'Mobile', 'Mobile', 'Mobile', '2018-03-27 18:29:02', '2018-07-21 20:06:06'),
(4, 4, 'Kitchen & Dining', 'Kitchen & Dining', NULL, 'default.png', 'sub-category-3-1', '9', 'percentage', 'Kitchen & Dining', 'Kitchen & Dining', 'Kitchen & Dining', 'Kitchen & Dining', '2018-04-26 11:49:57', '2018-07-21 17:24:53'),
(5, 4, 'Furniture', 'Furniture', NULL, 'default.png', 'sub-category-4-1', '10', 'flat', 'Furniture', 'Furniture', 'Furniture', 'Furniture', '2018-04-26 14:42:16', '2018-07-21 17:21:36'),
(6, 4, 'Home Furnishing', 'Home Furnishing', NULL, 'default.png', 'home-furnishing', NULL, NULL, 'Home Furnishing', 'Home Furnishing', 'Home Furnishing', 'Home Furnishing', '2018-07-21 17:26:12', '2018-07-21 17:26:12'),
(7, 4, 'Bedroom Linen', 'Bedroom Linen', NULL, 'default.png', 'bedroom-linen', NULL, NULL, 'Bedroom Linen', 'Bedroom Linen', 'Bedroom Linen', 'Bedroom Linen', '2018-07-21 17:27:19', '2018-07-21 17:27:19'),
(8, 4, 'Home Décor', 'Home Décor', NULL, 'default.png', 'home-d-cor', NULL, NULL, 'Home Décor', 'Home Décor', 'Home Décor', 'Home Décor', '2018-07-21 17:28:42', '2018-07-21 17:28:42'),
(9, 4, 'Garden & Outdoors', 'Garden & Outdoors', NULL, 'default.png', 'garden-outdoors', NULL, NULL, 'Garden & Outdoors', 'Garden & Outdoors', 'Garden & Outdoors', 'Garden & Outdoors', '2018-07-21 17:29:20', '2018-07-21 17:29:20'),
(10, 4, 'Home Storage', 'Home Storage', '1532174742.jpg', 'default.png', 'home-storage', NULL, NULL, 'Home Storage', 'Home Storage', 'Home Storage', 'Home Storage', '2018-07-21 17:31:11', '2018-07-21 17:35:42'),
(11, 4, 'Indoor Lighting', 'Indoor Lighting', NULL, 'default.png', 'indoor-lighting', NULL, NULL, 'Indoor Lighting', 'Indoor Lighting', 'Indoor Lighting', 'Indoor Lighting', '2018-07-21 17:38:28', '2018-07-21 17:38:28'),
(12, 4, 'Sewing & Craft Supplies', 'Sewing & Craft Supplies', NULL, 'default.png', 'sewing-craft-supplies', NULL, NULL, 'Sewing & Craft Supplies', 'Sewing & Craft Supplies', 'Sewing & Craft Supplies', 'Sewing & Craft Supplies', '2018-07-21 17:39:51', '2018-07-21 17:39:51'),
(13, 4, 'All Home & Kitchen', 'All Home & Kitchen', NULL, 'default.png', 'all-home-kitchen', NULL, NULL, 'All Home & Kitchen products', 'All Home & Kitchen', 'All Home & Kitchen', 'All Home & Kitchen', '2018-07-21 17:41:12', '2018-07-21 17:41:12'),
(14, 5, 'Air Conditioners', 'Air Conditioners', NULL, 'default.png', 'air-conditioners', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:06:24', '2018-07-21 18:06:24'),
(15, 5, 'Refrigerators', 'Refrigerators', NULL, 'default.png', 'refrigerators', NULL, NULL, 'Refrigerators', NULL, 'Refrigerators', NULL, '2018-07-21 18:07:41', '2018-07-21 18:07:41'),
(16, 5, 'Washing Machines', 'Washing Machines', NULL, 'default.png', 'washing-machines', NULL, NULL, 'Washing Machines', NULL, 'Washing Machines', NULL, '2018-07-21 18:08:11', '2018-07-21 18:08:11'),
(17, 5, 'Kitchen & Home Appliances', 'Kitchen & Home Appliances', NULL, 'default.png', 'kitchen-home-appliances', NULL, NULL, 'Kitchen & Home Appliances', NULL, 'Kitchen & Home Appliances', NULL, '2018-07-21 18:09:27', '2018-07-21 18:09:27'),
(18, 5, 'Heating & Cooling Appliances', 'Heating & Cooling Appliances', NULL, 'default.png', 'heating-cooling-appliances', NULL, NULL, 'Heating & Cooling Appliances', NULL, 'Heating & Cooling Appliances', NULL, '2018-07-21 18:09:51', '2018-07-21 18:09:51'),
(19, 3, 'Televisions', 'Televisions', NULL, 'default.png', 'televisions', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:12:09', '2018-07-21 18:12:09'),
(20, 3, 'Home Entertainment Systems', 'Home Entertainment Systems', NULL, 'default.png', 'home-entertainment-systems', NULL, NULL, 'Home Entertainment Systems', NULL, NULL, NULL, '2018-07-21 18:15:50', '2018-07-21 18:15:50'),
(21, 3, 'Headphones', 'Headphones', NULL, 'default.png', 'headphones', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:19:10', '2018-07-21 18:19:10'),
(22, 3, 'Speakers', 'Speakers', NULL, 'default.png', 'speakers', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:19:31', '2018-07-21 18:19:31'),
(23, 3, 'MP3, Media Players & Accessories', 'MP3, Media Players & Accessories', NULL, 'default.png', 'mp3-media-players-accessories', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:19:46', '2018-07-21 18:19:46'),
(24, 3, 'Audio & Video Accessories', 'Audio & Video Accessories', NULL, 'default.png', 'audio-video-accessories', NULL, NULL, 'Audio & Video Accessories', NULL, NULL, NULL, '2018-07-21 18:20:08', '2018-07-21 18:20:08'),
(25, 3, 'Cameras', 'Cameras', NULL, 'default.png', 'cameras', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:20:26', '2018-07-21 18:20:26'),
(26, 3, 'DSLR Cameras', 'DSLR Cameras', NULL, 'default.png', 'dslr-cameras', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:20:38', '2018-07-21 18:20:38'),
(27, 3, 'Camera Accessories', 'Camera Accessories', NULL, 'default.png', 'camera-accessories', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:20:55', '2018-07-21 18:20:55'),
(28, 3, 'Gaming Consoles', 'Gaming Consoles', NULL, 'default.png', 'gaming-consoles', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:21:17', '2018-07-21 18:21:17'),
(29, 3, 'Mobile Accessories', 'Mobile Accessories', NULL, 'default.png', 'mobile-accessories', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:21:41', '2018-07-21 18:21:41'),
(30, 3, 'Cases & Covers', 'Cases & Covers', NULL, 'default.png', 'cases-covers', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:22:09', '2018-07-21 18:22:09'),
(31, 3, 'Screen Protectors', 'Screen Protectors', NULL, 'default.png', 'screen-protectors', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:22:25', '2018-07-21 18:22:25'),
(32, 3, 'Power Banks', 'Power Banks', NULL, 'default.png', 'power-banks', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:22:42', '2018-07-21 18:22:42'),
(33, 3, 'Tablets', 'Tablets', NULL, 'default.png', 'tablets', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:23:08', '2018-07-21 18:23:08'),
(34, 3, 'Wearable Devices', 'Wearable Devices', NULL, 'default.png', 'wearable-devices', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:23:32', '2018-07-21 18:23:32'),
(35, 3, 'Gaming Consoles', 'Gaming Consoles', NULL, 'default.png', 'gaming-consoles-1', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:24:08', '2018-07-21 18:24:08'),
(36, 3, 'Musical Instruments & Professional Audio', 'Musical Instruments & Professional Audio', NULL, 'default.png', 'musical-instruments-professional-audio', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-21 18:25:01', '2018-07-21 18:25:01'),
(37, 20, 'Shirts', 'Men\'s Shirts', '1533908210.jpg', 'thumb_1533908210.jpg', 'shirts', '10', 'percentage', 'Men\'s Shirts', 'Men\'s Shirts', 'Men\'s Shirts', 'Men\'s Shirts', '2018-07-21 19:07:49', '2018-08-10 13:36:50'),
(38, 22, 'Fiction Books', 'Fiction Books', NULL, 'default.png', 'fiction-books', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-22 14:23:26', '2018-07-22 14:23:26'),
(39, 22, 'School Textbooks', 'School Textbooks', NULL, 'default.png', 'school-textbooks', NULL, NULL, 'School Textbooks', NULL, NULL, NULL, '2018-07-22 14:23:59', '2018-07-22 14:23:59'),
(40, 22, 'Children\'s Books', 'Children\'s Books', NULL, 'default.png', 'children-s-books', NULL, NULL, 'Children\'s Books', NULL, NULL, NULL, '2018-07-22 14:24:18', '2018-07-22 14:24:18'),
(41, 22, 'Exam Central', 'Exam Central', NULL, 'default.png', 'exam-central', NULL, NULL, 'Exam Central', NULL, NULL, NULL, '2018-07-22 14:24:41', '2018-07-22 14:24:41'),
(42, 22, 'Textbooks', 'Textbooks', NULL, 'default.png', 'textbooks', NULL, NULL, NULL, NULL, 'Textbooks', NULL, '2018-07-22 14:25:01', '2018-07-22 14:25:01'),
(43, 22, 'Indian Language Books', 'Indian Language Books', NULL, 'default.png', 'indian-language-books', NULL, NULL, 'Indian Language Books', NULL, NULL, NULL, '2018-07-22 14:25:18', '2018-07-22 14:25:18'),
(44, 22, 'Used Books', 'Used Books', NULL, 'default.png', 'used-books', NULL, NULL, 'Used Books', NULL, NULL, NULL, '2018-07-22 14:25:35', '2018-07-22 14:25:35'),
(45, 22, 'Editor\'s Corner', 'Editor\'s Corner', NULL, 'default.png', 'editor-s-corner', NULL, NULL, 'Editor\'s Corner', NULL, NULL, NULL, '2018-07-22 14:25:56', '2018-07-22 14:25:56'),
(46, 19, 'Software', 'Software', NULL, 'default.png', 'software', NULL, NULL, 'Software', NULL, NULL, NULL, '2018-07-22 14:27:58', '2018-07-22 14:27:58'),
(48, 19, 'Laptops', 'Laptops', NULL, 'default.png', 'laptops', NULL, NULL, 'Laptops', NULL, 'Laptops', NULL, '2018-07-22 14:29:16', '2018-07-22 14:29:16'),
(49, 19, 'Drives & Storage', 'Drives & Storage', NULL, 'default.png', 'drives-storage', NULL, NULL, 'Drives & Storage', NULL, 'Drives & Storage', NULL, '2018-07-22 14:29:42', '2018-07-22 14:29:42'),
(50, 19, 'Printers & Ink', 'Printers & Ink', NULL, 'default.png', 'printers-ink', NULL, NULL, 'Printers & Ink', NULL, 'Printers & Ink', NULL, '2018-07-22 14:30:04', '2018-07-22 14:30:04'),
(51, 19, 'Desktops & Monitors', 'Desktops & Monitors', NULL, 'default.png', 'desktops-monitors', NULL, NULL, 'Desktops & Monitors', NULL, 'Desktops & Monitors', NULL, '2018-07-22 14:32:37', '2018-07-22 14:32:37'),
(52, 19, 'Computer Accessories', 'Computer Accessories', NULL, 'default.png', 'computer-accessories', NULL, NULL, 'Computer Accessories', NULL, 'Computer Accessories', NULL, '2018-07-22 14:33:06', '2018-07-22 14:33:06'),
(53, 19, 'Networking Devices', 'Networking Devices', NULL, 'default.png', 'networking-devices', NULL, NULL, 'Networking Devices', NULL, 'Networking Devices', NULL, '2018-07-22 14:33:38', '2018-07-22 14:33:38'),
(54, 19, 'Game Zone', 'Game Zone', NULL, 'default.png', 'game-zone', NULL, NULL, 'Game Zone', NULL, 'Game Zone', NULL, '2018-07-22 14:34:06', '2018-07-22 14:34:06'),
(55, 19, 'All Computers & Accessories', 'All Computers & Accessories', NULL, 'default.png', 'all-computers-accessories', NULL, NULL, 'All Computers & Accessories', NULL, 'All Computers & Accessories', NULL, '2018-07-22 14:34:54', '2018-07-22 14:34:54'),
(56, 3, 'Hello new subcategory', 'Hello new subcategory', '1532582511.jpg', 'thumb_1532582494.jpg', 'hello-new-subcategory', '10', 'percentage', 'Hello new subcategory', 'Hello new subcategory', 'Hello new subcategory', 'Hello new subcategory', '2018-07-26 05:10:57', '2018-07-26 05:21:51'),
(57, 4, 'Godrej', 'Godrej', '1533905667.jpg', 'thumb_1533905667.jpg', 'godrej', '100', 'flat', 'goodrej', 'godrej', 'godrej', 'godrej', '2018-08-10 12:54:27', '2018-08-10 12:54:27'),
(58, 16, 'Liva', 'Liva', '1533905821.jpg', 'thumb_1533905821.jpg', 'liva', '5', 'flat', 'Liva', 'Liva', 'Liva', 'Liva', '2018-08-10 12:57:01', '2018-08-10 12:57:01'),
(59, 19, 'Dell', 'Dell', '1533906273.png', 'thumb_1533906273.png', 'dell', '5', 'flat', 'Dell', 'Dell', 'Dell', 'Dell', '2018-08-10 13:04:33', '2018-08-10 13:04:33'),
(60, 19, 'LG', 'LG', '1533906310.jpg', 'thumb_1533906310.jpg', 'lg', '1', 'percentage', 'LG', 'LG', 'LG', 'LG', '2018-08-10 13:05:10', '2018-08-10 13:05:10'),
(61, 20, 'Adidas', 'Adidas', '1533906539.png', 'thumb_1533906539.png', 'adidas', '2', 'flat', 'Adidas', 'Adidas', 'Adidas', 'Adidas', '2018-08-10 13:08:59', '2018-08-10 13:08:59'),
(62, 20, 'Levi\'s', 'Levi\'s', '1533906770.jpg', 'thumb_1533906770.jpg', 'levi-s', '10', 'flat', 'Levi\'s', 'Levi\'s', 'Levi\'s', 'Levi\'s', '2018-08-10 13:12:50', '2018-08-10 13:12:50'),
(63, 15, 'Himalaya', 'Himalaya', '1533907679.jpg', 'thumb_1533907679.jpg', 'himalaya', '2', 'flat', 'Himalaya', 'Himalaya', 'Himalaya', 'Himalaya', '2018-08-10 13:27:59', '2018-08-10 13:27:59'),
(64, 14, 'TVS', 'TVS', '1533908502.jpg', 'thumb_1533908502.jpg', 'tvs', '2', 'flat', 'TVS', 'TVS', 'TVS', 'TVS', '2018-08-10 13:41:42', '2018-08-10 13:41:42'),
(65, 39, 'Tanishq jewelry', 'Tanishq jewelry', '1534242747.png', 'thumb_1534242747.png', 'tanishq-jewelry', '34', 'percentage', 'Tanishq jewelry', 'Tanishq jewelry', 'Tanishq jewelry', 'Tanishq jewelry', '2018-08-14 10:32:27', '2018-08-14 10:32:27'),
(66, 42, 'Pens', 'Pens', '1534251448.jpg', 'thumb_1534251448.jpg', 'pens', '2', 'percentage', 'Pens', 'Pens', 'Pens', 'Pens', '2018-08-14 12:28:40', '2018-08-14 12:57:29'),
(67, 43, 'Pedigree', 'Pedigree', '1534404565.jpg', 'thumb_1534404566.jpg', 'pedigree', '2', 'percentage', 'Pedigree', 'Pedigree', 'Pedigree', 'Pedigree', '2018-08-14 12:39:09', '2018-08-16 07:29:26'),
(68, 44, 'Lotto', 'Lotto', '1534251670.jpg', 'thumb_1534251670.jpg', 'lotto', '4', 'percentage', 'Lotto', 'Lotto', 'Lotto', 'Lotto', '2018-08-14 13:01:10', '2018-08-14 13:01:10'),
(69, 47, 'FODG', 'FODG', '1534309541.jpg', 'thumb_1534309542.jpg', 'fodg', '5', 'percentage', 'FODG', 'FODG', 'FODG', 'FODG', '2018-08-15 05:05:42', '2018-08-15 05:05:42'),
(70, 17, 'Ball', 'Ball', '1534324266.jpg', 'thumb_1534324267.jpg', 'ball', '1', 'percentage', 'Ball', 'Ball', 'Ball', 'Ball', '2018-08-15 09:11:07', '2018-08-15 09:11:07'),
(71, 21, 'Dining Tables', 'Dining Tables', '1534336104.jpg', 'thumb_1534336105.jpg', 'dining-tables', '2', 'percentage', 'Dining Tables', 'Dining Tables', 'Dining Tables', 'Dining Tables', '2018-08-15 12:28:25', '2018-08-15 12:28:25'),
(72, 49, 'Plants', 'Plants', '1534336486.jpeg', 'thumb_1534336486.jpeg', 'plants', '2', 'percentage', 'Plants', 'Plants', 'Plants', 'Plants', '2018-08-15 12:34:46', '2018-08-15 12:34:46'),
(73, 24, 'Dry Fruits', 'Dry Fruits', '1534336857.jpg', 'thumb_1534336857.jpg', 'dry-fruits', '3', 'percentage', 'Dry Fruits', 'Dry Fruits', 'Dry Fruits', 'Dry Fruits', '2018-08-15 12:40:57', '2018-08-15 12:40:57'),
(74, 40, 'Philips', 'Philips', '1534337305.png', 'thumb_1534337305.png', 'philips', '2', 'percentage', 'Philips', 'Philips', 'Philips', 'Philips', '2018-08-15 12:48:25', '2018-08-15 12:48:25'),
(75, 18, 'Bags', 'Bags', '1534337579.jpeg', 'thumb_1534337580.jpeg', 'bags', '3', 'percentage', 'Bags', 'Bags', 'Bags', 'Bags', '2018-08-15 12:53:00', '2018-08-15 12:53:00'),
(76, 41, 'Guitars', 'Guitars', '1534504648.jpg', 'thumb_1534504648.jpg', 'guitars', '1', 'percentage', 'Guitars', 'Guitars', 'Guitars', 'Guitars', '2018-08-17 11:17:28', '2018-08-17 11:17:28');

-- --------------------------------------------------------

--
-- Structure de la table `subcategories2`
--

CREATE TABLE `subcategories2` (
  `id` int(10) UNSIGNED NOT NULL,
  `subcategory_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_cat_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_type` enum('flat','percentage') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_desc` text COLLATE utf8mb4_unicode_ci,
  `m_keywords` text COLLATE utf8mb4_unicode_ci,
  `m_tag` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `subcategories2`
--

INSERT INTO `subcategories2` (`id`, `subcategory_id`, `name`, `desc`, `sub_cat_img`, `slug`, `commission`, `commission_type`, `m_title`, `m_desc`, `m_keywords`, `m_tag`, `created_at`, `updated_at`) VALUES
(1, 3, 'Nokia 3500 classic', 'Nokia 3500 classic', '1532516707.jpg', 'nokia-3500-1', '11', 'percentage', 'Nokia 3500 classic', 'Nokia 3500 classic', 'Nokia 3500 classic', 'Nokia 3500 classic', '2018-07-25 11:05:07', '2018-07-25 11:07:20'),
(2, 3, 'Samsung 7562', 'Samsung 7562', '1532522400.jpg', 'samsung-7562', '10', 'percentage', 'Samsung 7562', 'Samsung 7562', 'Samsung 7562', 'Samsung 7562', '2018-07-25 12:40:01', '2018-07-25 12:40:01'),
(3, 1, 'test', 'test', '1532522670.jpg', 'test', '10', 'percentage', 'tes', 'test', 'tes', 'test', '2018-07-25 12:44:30', '2018-07-25 12:45:46'),
(4, 2, '10 pcs plastic containers', '10 pcs plastic containers', '1533385359.jpg', '10-pcs-plastic-containers', '10', 'percentage', '10 pcs plastic containers', '10 pcs plastic containers', '10 pcs plastic containers', '10 pcs plastic containers', '2018-08-04 12:22:40', '2018-08-04 12:22:40'),
(5, 2, 'Steel Items', 'Steel lunch box', '1533531973.jpg', 'steel-items', '10', 'percentage', 'test', 'test', 'test', 'tes', '2018-08-06 05:06:13', '2018-08-06 05:06:13'),
(6, 14, 'Mitsubishi AC', 'Mitsubishi AC', '1533534279.jpg', 'mitsubishi-ac', '2', 'flat', 'Mitsubishi', 'Mitsubishi', 'Mitsubishi', 'Mitsubishi', '2018-08-06 05:44:39', '2018-08-06 05:44:39'),
(7, 19, 'Mi Tv', 'Mi Tv', '1533558041.png', 'mi-tv', '1', 'percentage', 'Mi Tv', 'Mi Tv', 'Mi Tv', 'Mi Tv', '2018-08-06 12:20:42', '2018-08-06 12:20:42'),
(8, 19, 'Samsung TV', 'Samsung TV', '1533558365.png', 'samsung-tv', '1', 'percentage', 'Samsung TV', 'Samsung TV', 'Samsung TV', 'Samsung TV', '2018-08-06 12:26:05', '2018-08-06 12:26:05'),
(9, 14, 'Mitsubishi  Air Conditioner', 'Mitsubishi  Air Conditioner', '1533558796.jpg', 'mitsubishi-air-conditioner', '2', 'percentage', 'Mitsubishi  Air Conditioner', 'Mitsubishi  Air Conditioner', 'Mitsubishi  Air Conditioner', 'Mitsubishi  Air Conditioner', '2018-08-06 12:33:17', '2018-08-06 12:33:17'),
(10, 37, 'Cotton shirts', 'Cotton shirts', '1533627249.jpg', 'cotton-shirts', '1', 'flat', 'xczc', 'xc', 'zxc', 'zxc', '2018-08-07 07:34:09', '2018-08-07 07:34:09'),
(11, 57, 'Cabinets', 'Cabinets', '1533905746.png', 'cabinets', '10', 'percentage', 'Cabinets', 'Cabinets', 'Cabinets', 'Cabinets', '2018-08-10 12:55:46', '2018-08-10 12:55:46'),
(12, 58, 'lipsticks', 'lipsticks', '1533905919.jpg', 'lipsticks', '101', 'flat', 'lipsticks', 'lipsticks', 'lipsticks', 'lipsticks', '2018-08-10 12:58:39', '2018-08-10 12:58:39'),
(13, 48, 'DellDell', 'Dell', '1533906359.png', 'delldell', '10', 'flat', 'Dell', 'Dell', 'Dell', 'Dell', '2018-08-10 13:05:59', '2018-08-10 13:05:59'),
(14, 51, 'Dell', 'Dell', '1533906412.png', 'dell-1', '5', 'flat', 'Dell', 'Dell', 'Dell', 'Dell', '2018-08-10 13:06:52', '2018-08-10 13:06:52'),
(15, 61, 'T-shirts', 'T-shirts', '1533906725.png', 't-shirts', '1', 'flat', 'T-shirts', 'T-shirts', 'T-shirts', 'T-shirts', '2018-08-10 13:12:05', '2018-08-10 13:12:05'),
(16, 62, 'Shirts', 'Shirts', '1533906842.jpg', 'shirts', '3', 'flat', 'asd', 'asd', 'asd', 'asda', '2018-08-10 13:14:02', '2018-08-10 13:14:02'),
(17, 38, 'Harry potter', 'Harry potter', '1533907541.jpg', 'harry-potter', '3', 'percentage', 'Harry potter', 'Harry potter', 'Harry potter', 'Harry potter', '2018-08-10 13:25:41', '2018-08-10 13:25:41'),
(18, 63, 'Powder', 'Powder', '1533907734.jpg', 'powder', '3', 'flat', 'Powder', 'Powder', 'Powder', 'Powder', '2018-08-10 13:28:54', '2018-08-10 13:28:54'),
(19, 64, 'Tyres', 'Tyres', '1533908601.jpg', 'tyres', '1', 'flat', 'Tyres', 'Tyres', 'Tyres', 'Tyres', '2018-08-10 13:43:21', '2018-08-10 13:43:21'),
(20, 65, 'Rings', 'Rings', '1534242795.jpg', 'rings', '2', 'percentage', 'Rings', 'Rings', 'Rings', 'Rings', '2018-08-14 10:33:15', '2018-08-14 10:33:15'),
(21, 66, 'Nataraj', 'Nataraj', '1534249966.jpg', 'nataraj', '4', 'percentage', 'Nataraj', 'Nataraj', 'Nataraj', 'Nataraj', '2018-08-14 12:32:46', '2018-08-14 12:32:46'),
(22, 67, 'Pet Food', 'Pet Food', '1534250446.png', 'pet-food', '3', 'percentage', 'Pet Food', 'Pet Food', 'Pet Food', 'Pet Food', '2018-08-14 12:40:46', '2018-08-14 12:40:46'),
(23, 68, 'Sports Shoes', 'Sports Shoes', '1534251741.jpeg', 'sports-shoes', '2', 'percentage', 'Sports Shoes', 'Sports Shoes', 'Sports Shoes', 'Sports Shoes', '2018-08-14 13:02:21', '2018-08-14 13:02:21'),
(24, 69, 'Wrist Watches', 'Wrist Watches', '1534309630.jpg', 'wrist-watches', '1', 'percentage', 'Wrist Watches', 'Wrist Watches', 'Wrist Watches', 'Wrist Watches', '2018-08-15 05:07:10', '2018-08-15 05:07:10'),
(25, 70, 'Sky Bolt', 'Sky Bolt', '1534324407.png', 'sky-bolt', '2', 'percentage', 'Sky Bolt', 'Sky Bolt', 'Sky Bolt', 'Sky Bolt', '2018-08-15 09:13:27', '2018-08-15 09:13:27'),
(26, 71, 'Wooden Dining Table', 'Wooden Dining Table', '1534336201.jpg', 'wooden-dining-table', '1', 'percentage', 'Wooden Dining Table', 'Wooden Dining Table', 'Wooden Dining Table', 'Wooden Dining Table', '2018-08-15 12:30:01', '2018-08-15 12:30:01'),
(27, 72, 'Blooms Gardening', 'Blooms Gardening', '1534336580.jpeg', 'blooms-gardening', '2', 'percentage', 'Blooms Gardening', 'Blooms Gardening', 'Blooms Gardening', 'Blooms Gardening', '2018-08-15 12:36:20', '2018-08-15 12:36:20'),
(28, 55, 'Keyboards', 'Keyboards', '1534482256.jpg', 'keyboards', '4', 'percentage', 'Keyboards', 'Keyboards', 'Keyboards', 'Keyboards', '2018-08-17 05:04:17', '2018-08-17 05:04:17'),
(29, 73, 'Almonds', 'Almonds', '1534484670.jpg', 'almonds', '1', 'percentage', 'Almonds', 'Almonds', 'Almonds', 'Almonds', '2018-08-17 05:44:30', '2018-08-17 05:44:30'),
(30, 74, 'Tube lights', 'Tube lights', '1534486928.png', 'tube-lights', '3', 'percentage', 'Tube lights', 'Tube lights', 'Tube lights', 'Tube lights', '2018-08-17 06:22:08', '2018-08-17 06:22:08'),
(31, 75, 'Travelling Bags', 'Travelling Bags', '1534504111.jpeg', 'travelling-bags', '10', 'flat', 'Travelling Bags', 'Travelling Bags', 'Travelling Bags', 'Travelling Bags', '2018-08-17 11:08:32', '2018-08-17 11:08:32'),
(32, 76, 'Taylor', 'Taylor', '1534504761.jpg', 'taylor', '2', 'flat', 'Taylor', 'Taylor', 'Taylor', 'Taylor', '2018-08-17 11:19:21', '2018-08-17 11:19:21');

-- --------------------------------------------------------

--
-- Structure de la table `subcategory_slider`
--

CREATE TABLE `subcategory_slider` (
  `id` int(10) UNSIGNED NOT NULL,
  `main_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_slider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `subcategory_slider`
--

INSERT INTO `subcategory_slider` (`id`, `main_slider`, `sidebar_slider`, `created_at`, `updated_at`) VALUES
(7, 'Urspf1525519682.jpg', NULL, '2018-05-05 12:58:02', '2018-05-05 12:58:02'),
(8, NULL, '2RWtY1525519716.jpg', '2018-05-05 12:58:36', '2018-05-05 12:58:36'),
(9, NULL, 'XB4qZ1525519731.jpg', '2018-05-05 12:58:51', '2018-05-05 12:58:51'),
(10, NULL, 'wmxKw1532183167.jpg', '2018-07-21 19:56:07', '2018-07-21 19:56:07'),
(11, '3uS5T1532183643.jpg', NULL, '2018-07-21 20:04:03', '2018-07-21 20:04:03'),
(12, 'FqXB51532183662.jpg', NULL, '2018-07-21 20:04:22', '2018-07-21 20:04:22'),
(13, 'tX1z01532183678.jpg', NULL, '2018-07-21 20:04:38', '2018-07-21 20:04:38');

-- --------------------------------------------------------

--
-- Structure de la table `tax_class`
--

CREATE TABLE `tax_class` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('flat','percentage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tax_class`
--

INSERT INTO `tax_class` (`id`, `name`, `tax_rate`, `type`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'GST', '18', 'flat', 'gst', '2018-03-27 17:05:37', '2018-03-27 17:05:37'),
(3, 'SGST', '10', 'flat', 'tesst-1', '2018-10-19 21:09:19', '2018-10-19 21:09:53');

-- --------------------------------------------------------

--
-- Structure de la table `terms_condition`
--

CREATE TABLE `terms_condition` (
  `id` int(10) UNSIGNED NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `terms_condition`
--

INSERT INTO `terms_condition` (`id`, `desc`, `image`, `created_at`, `updated_at`) VALUES
(1, '<p><strong><u>Terms &amp; Conditions:<br /><br /></u></strong></p>\r\n<ul>\r\n<li>Thank you for visiting the www.lozypay.com. By accessing or using www.lozypay.com website or the mobile application or any other media&nbsp;<strong>(\"Website\")</strong>, whether automated or otherwise, you, a registered or guest user in terms of the eligibility criteria set out herein you&nbsp;<strong>(&ldquo;User&rdquo;)</strong>agree to be bound by these Terms and Conditions&nbsp;<strong>(&ldquo;Terms&rdquo;)</strong>&nbsp;and any additional terms and conditions of third party sellers&nbsp;<strong>(&ldquo;Sellers&rdquo;)</strong>.</li>\r\n<li>In these Terms, references to \"you\", \"User\" shall mean the end user/customer accessing the Website, its contents and using the Services offered through the Website. \"Service Providers\" mean independent third party service providers or Sellers, and references to the &ldquo;Website&rdquo;, \"Jabong\", &ldquo;Jabong.com&rdquo;, \"we\", \"us\" and \"our\" shall mean the Website and/or Novarris Fashion Trading Private Limited, its affiliates and partners (as applicable).</li>\r\n</ul>\r\n<p>The contents set out herein form an electronic record in terms of Information Technology Act, 2000 and rules there under as applicable and as amended from time to time. As such, this document does not require any physical or digital signatures and forms a valid and binding agreement between the Website and the User. These Terms are made available to the User pursuant to and in accordance with the provisions of Rule 3 (1) of the Information Technology (Intermediaries Guidelines) Rules, 2011 that require publishing the rules, regulations, privacy policy and Terms for access or usage of the Website</p>', 'terms_1524031081.jpg', '2018-04-18 07:28:01', '2018-05-01 06:45:12');

-- --------------------------------------------------------

--
-- Structure de la table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `testimonials`
--

INSERT INTO `testimonials` (`id`, `title`, `desc`, `image`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Roverto & Maria', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>', 'testmonial_1523973246.jpg', 'roverto-maria', '2018-04-17 15:24:06', '2018-04-17 15:24:06'),
(2, 'test new', '<p>test</p>', NULL, 'test-1', '2018-10-19 21:14:06', '2018-10-19 21:14:38');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `mobile_num` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `previous_balance` double DEFAULT NULL,
  `next_balance` double DEFAULT NULL,
  `offer_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_type` enum('web','app') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_type` tinyint(1) NOT NULL DEFAULT '0',
  `pincode` double DEFAULT NULL,
  `benificiary_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` double DEFAULT NULL,
  `ifsc_code` double DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_amount` double DEFAULT '0',
  `kyc_status` tinyint(1) NOT NULL DEFAULT '0',
  `aadhar_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_back` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_front` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_or_tan_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_verify` tinyint(1) NOT NULL DEFAULT '0',
  `fullfilment_mode` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seller_name_code` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categories_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `mobile_num`, `city`, `state`, `company_name`, `shipping_address`, `shipping_type`, `pincode`, `benificiary_name`, `account_number`, `ifsc_code`, `bank_name`, `branch_name`, `profile`, `birth_date`, `otp`, `gender`, `status`, `confirmation_code`, `confirmed`, `slug`, `wallet_amount`, `kyc_status`, `aadhar_num`, `aadhar_back`, `aadhar_front`, `gst_num`, `pan_or_tan_num`, `remember_token`, `created_at`, `updated_at`, `is_verify`, `fullfilment_mode`, `location`, `seller_name_code`, `categories_id`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', '$2y$10$rIAoMRFKFC/O.o5gPiWY7eKaX3pNYY8Y7ezGSY/nlPwRMpzVXW6V.', '1234567890', 'Rajkot', 'Gujarat', 'Shopper Beam', 'Abcd Road', 0, 360001, 'Shopper Beam', 1234567890123, 12345, 'SBI', 'Rajkot', NULL, NULL, NULL, NULL, 1, NULL, 0, 'admin', 30361, 0, NULL, NULL, NULL, NULL, NULL, 'iC0i4PQqNn89ON7h4W9XT2csnipCtSxfd2OMtTHRioX30yq2fB0SWOinkJxh', '2018-02-23 10:24:15', '2018-10-19 21:49:06', 0, NULL, NULL, NULL, NULL),
(15, 'Amit', 'Patel', 'bizzhere', 'ark5020@gmail.com', '$2y$10$wdSzM.DLy7IYI5zz5RF9Heh7JEWdrQiH1salxeOpeh0F2i4oNCNw2', '9427666688', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '713580', NULL, 0, NULL, 0, NULL, 989, 0, NULL, NULL, NULL, NULL, NULL, 'taNSQG9n3p2p9lz1OqsN1yyq469pHTaIE6Mm0B3FVRO9hwdDRhGGmI6rRFkp', '2018-03-08 09:31:48', '2018-04-27 16:39:23', 1, NULL, NULL, NULL, NULL),
(31, 'amit', 'patel', 'amit', 'myemailidis006@yahoo.in', '$2y$10$eOlD4BS/9cloy0C2X5cvKOciGaJTKtUVfJgNpRXhjRzCNJORknnam', '8140666666', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 'amit', 20, 0, NULL, NULL, NULL, NULL, NULL, 'lM4dt6rGJH9nDBujgscQZ3gsQ2jjDUwtBh23jwQU8RCnnyrtzQEhiMOIYAFi', '2018-03-27 19:09:43', '2018-03-27 19:09:43', 0, NULL, NULL, NULL, NULL),
(35, 'amit', 'patel', 'amitpp1', 'bizz.website@gmail.in', '$2y$10$vSPFu.xLECvgqM8KWE5fZuEwyf5c9gOxd/4RsdwaG5HjpaMEhfgOW', '9427666666', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '6S8EeZl7BIckavNp2s1OAUIPy20gc0jCnBu1plrLTsRPKwv30jUDfSn0MELS', 0, 'amitpp', 0, 0, NULL, NULL, NULL, NULL, NULL, '3c83KVLwmiVsM1KozZ9BARsiLtA87ueKxxX8R5noPffoZ0kT5R6SWCRbutXa', '2018-03-31 07:46:32', '2018-10-09 21:29:41', 0, NULL, NULL, NULL, NULL),
(45, 'jk', 'jk', NULL, 'jK@gmail.com', NULL, '0123456789', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '854235', NULL, 0, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-09 12:44:46', '2018-04-09 12:44:46', 0, NULL, NULL, NULL, NULL),
(46, 'jay', 'kishan', NULL, 'jkq@gmail.com', '$2y$10$3uTcl/t5BvG9PcoSmfVCoOx8XBXau4i6mA2t/MHkx2c0y2adnFkaW', '7359420100', 'Rajkot', 'Gujarat', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22-04-1995', '421434', 'male', 0, NULL, 0, NULL, 1278, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-09 13:48:11', '2018-04-27 16:31:23', 1, NULL, NULL, NULL, NULL),
(47, 'jaykishan', 'gauswami', 'jaykishan', 'bizz.website@gmail.com', '$2y$10$/7cWxs40FNrINs6E9gIkneO5HdH7mWZF40yXoceycT8KBT.n1DOJ2', '7016587490', 'Junagadh', 'Gujarat', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '22-04-1995', NULL, 'male', 0, NULL, 0, 'jaykishan', 9, 0, NULL, NULL, NULL, NULL, NULL, '5lbk9MXNkaVpgpRFz4ZDtc4EME92uYtPARCYxEa7pGBt5x9zUUXmYkMds1UB', '2018-04-11 15:27:04', '2018-04-24 06:35:36', 0, NULL, NULL, NULL, NULL),
(48, 'amit', 'patel', 'amitpp', 'amit@buzz.com', '$2y$10$HmtiDMjpcT1KDmI1LXXIp..4os1qM2tItAyB8t.BJe01RTk1J0AkO', '9427666644', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14-04-2018', '532893', 'male', 0, NULL, 0, 'amitp', 200000, 0, NULL, NULL, NULL, NULL, NULL, 'AyaxDhW7fxrQoDpBDJjQ1uf4h07F8flYThl6BAzoMfK2QvpGJbg1MJBH7RcS', '2018-04-14 09:42:58', '2018-04-17 09:04:05', 1, NULL, NULL, NULL, NULL),
(49, 'viru', 'pa', NULL, 'virugroups@gmail.com', NULL, '9901997769', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '402036', NULL, 0, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-15 15:31:48', '2018-04-15 15:31:48', 0, NULL, NULL, NULL, NULL),
(50, 'Anuja', 'Das', 'anujdas8@gmail.com', 'developerbizzwebsite@gmail.com', '$2y$10$kxUUPygpcwshtMuuXhkn/uIIMux3pOkNBHK51BEGdaphxKOBKo/OG', '9940278677', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 'anujdas8-gmail-com', 0, 0, NULL, NULL, NULL, NULL, NULL, 'CySrT88lT0QBtHfp74l6UueZ3FxRjfWF8j1d4914pA9GJGEvWVqRNfD6EnXo', '2018-04-18 18:42:25', '2018-04-18 18:42:25', 0, NULL, NULL, NULL, NULL),
(51, 'amit', 'patel', NULL, 'ark5030@gmail.com', '$2y$10$3H.X/kEtLRUQgRB.DbBm/.0kfAjJx7zk09pUjy0PjhJCAqyGVXFxC', '9427666677', 'Rajkot', 'Gujarat', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28-03-2018', '599036', 'male', 0, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-18 18:44:50', '2018-04-18 19:02:39', 1, NULL, NULL, NULL, NULL),
(52, 'amit', 'patel', 'resamit', 'puneet.das@aol.com', '$2y$10$YZll9W1e4rzKAB/wp2zVfeKtPy2wblU8JAB1GUjFw.gfbIIyqZijC', '8109157430', NULL, NULL, NULL, NULL, 0, NULL, NULL, 123456789012345, 12345, 'SBI', 'RAJKOT', NULL, NULL, NULL, NULL, 1, 'y3wdZcNmuR38wPPin7KcZxO6IFZJmhWI5BuMXsKppm9fW81RMlxQUSVCAU32', 0, 'resamit', 13000, 0, '1234567890098', '152428703618813246465adac63c6e93d.jpg', '152428703612806443675adac63c6c229.jpg', '1234567890012', '1234567890', '8GhyeH0W3mzPWfp43HoEJb4DaL6rtsF2LUkcsM01XJ33erRAtyyELU3hSkOx', '2018-04-21 06:33:56', '2018-08-04 07:11:30', 0, NULL, NULL, NULL, NULL),
(53, 'sanjay', 'mokariya', 'sanjay', 'sanjaymokariya48@gmail.com', '$2y$10$5qhT5DvV1XaLnzgt2pnh5.kuccLhp/lYkRixaIH6lYCyKJQlFScfy', '9624949788', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 'sanjay', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-21 07:58:48', '2018-04-21 07:58:48', 0, NULL, NULL, NULL, NULL),
(54, 'nagaraju', 'raju', 'lozyadmin', 'naagaraju444@gmail.com', '$2y$10$0Kc5q.MInHAjtGHRM/exyeCOAgU.joja5Y/oYzHgZF7udmhInJp8i', '9884496818', '5', 'AP', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, 'lozyadmin', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-21 10:50:02', '2018-04-21 10:50:02', 0, NULL, NULL, NULL, NULL),
(55, 'amit', 'patel', 'amitemp', 'myemailidis007@yahoo.in', '$2y$10$iRWPZrXddg/gbL.JXQuoBO8rrxeEuL7qpPyRdK32WdbOaw18dJUDG', '8140666688', '305', 'GJ', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, 'amitemp', 0, 0, NULL, NULL, NULL, NULL, NULL, 'X6UfBTx5a6KwkRRnchWrsWcRc54BYc6wUsgKXKfugkI5SKF0qx8uPQoPiqo9', '2018-04-27 05:38:01', '2018-04-27 05:38:01', 0, NULL, NULL, NULL, NULL),
(56, 'Puneet', 'Das', 'puneetemp', 'puneet.das15@aol.com', '$2y$10$ACvufRss1LGP2xymDDqcNe695XX84SF/bwl1tdz0py5cc09jDH5uC', '8109157531', '293', 'BR', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, 'puneetemp', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-29 09:56:15', '2018-04-29 09:56:15', 0, NULL, NULL, NULL, NULL),
(57, 'Puneet', 'Kumar', 'Puneet', 'rbpuneet@gmail.com', '$2y$10$07nLy7U/2OHGM9XU.HfjEOBYRJidhzkIrDa8H.8NgrerxSiXgYQ26', '9993767636', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 'puneet-1', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-07 19:46:35', '2018-05-07 19:46:35', 0, NULL, NULL, NULL, NULL),
(58, 'Raj', 'Kumar', 'Shoppersbeam', 'rjkumar832@gmail.com', '$2y$10$.1mjNMJz.ch8L8n.MTpRkuLa14nukCjcq6mhFIq4f.9AjhO3Gfbyi', '7330910929', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 'shoppersbeam', 0, 0, NULL, NULL, NULL, NULL, NULL, 'aVFvcvlmFnt4Si4bBb3AKCbs6c8pjejvylvTG7oAsdSqoe9zW2CqUZ8Orz8G', '2018-05-12 16:28:15', '2018-05-12 16:29:40', 0, NULL, NULL, NULL, NULL),
(59, 'Puneet', 'Kumar', 'RBPuneet', 'puneet@kartcastle.com', '$2y$10$jWw4dUbS5tqJRyle99uJE.fjKZ4noHJQTvLF1BSH5pC7Z4HhrNuSq', '7665544335', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Sm17uaeeC4iGJKJOuYtcIn6FBcTEBz8HgU1ozhCgHEPZHDAER6H8ETAeH53h', 0, 'rbpuneet', 0, 0, '122331233444', NULL, NULL, '12233444322', '11233werw', NULL, '2018-07-03 08:11:47', '2018-07-03 08:12:20', 0, NULL, NULL, NULL, NULL),
(60, 'swetha', 'pingali', 'swetha', 'swetha@ooisolutions.com', '$2y$10$QEzKRNJKORPX79yX32LVF.EpJTO.JO/x8T5NSBieP7AaWDc3vgtRW', '8977735225', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 'swetha', 0, 0, NULL, NULL, NULL, NULL, NULL, 's4r6l9naqiaGijjGjufA7ndOnoJTPR7IGcuNoI265eizsOaGfkhFoG5XCdTz', '2018-10-08 14:39:52', '2018-10-08 14:39:52', 0, NULL, NULL, NULL, NULL),
(61, 'pankaj', 'kumar', 'pankaj', 'ranapankaj883@gmail.com', '$2y$10$f/yL3JBns4l.eQ1SxX0DTOJgEpuojHdAiIOMu.TO8ZVbjiw5MSYjC', '9876543210', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'bDpDQMzbW5h20WHkT3KecbNet0mTQ2jvEl750nZIYXoxwZCu3PsaquwO3cyQ', 0, 'pankaj', 0, 0, NULL, NULL, NULL, NULL, NULL, 'm1lAXNy9cHAK75zIotYMdVgbJ6z1kEgPcDJuImQbUeaaUxP70IX2LFbIBFWb', '2018-10-09 21:15:02', '2018-10-09 21:31:43', 0, NULL, NULL, NULL, NULL),
(62, 'John', 'Doe', 'jack', 'jack@yopmail.com', '$2y$10$9lJfZ6RakqjAZxDHUBWR5OWbp5oY0RooAz6m.vWhUfSBkle6p3O12', '7837915587', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'TacDVsCXY3wLhtlon5W9rrN99EDP7QY53FdeZx8PrAiotH2PclAZsrRGYLHZ', 0, 'jack', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-12 19:42:45', '2018-10-12 19:42:45', 0, NULL, NULL, NULL, NULL),
(63, 'Rajiv', 'Jack', 'rajiv', 'rajiv@yopmail.com', '$2y$10$EbD/CwU2xZWx8ANhd/JoU.cWT8EtERLTQ.bLm7AQHlg9WHtnk4Goa', '9871212345', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'TYEpOWEIRPjBE3zB2yO0iKM2mO6sNkg5EBKtSHozBzlcdQbXvlv8rjkIZHnK', 0, 'rajiv', 0, 0, NULL, NULL, NULL, NULL, NULL, 'w2jDzXf1V8bdrFd9KpyrOgbJBIUfKN0QidgSlXflFhPNGZCHiIME2TnoOTg5', '2018-10-12 19:43:49', '2018-10-12 19:49:59', 0, NULL, NULL, NULL, NULL),
(64, 'raghav', 'tangella', 'raghav', 'raghav@ooisolutions.com', '$2y$10$mBT8CjGizkPXE9qp0xelQu55L6yN0bLxOuZIX68XxZ5eV4Yz4q.6.', '8985360257', '293', 'AN', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, 'raghav', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-19 21:02:31', '2018-10-19 21:02:31', 0, NULL, NULL, NULL, NULL),
(65, 'Steve', 'Nosse', 'bk', 'nossesteve@gmail.com', '$2y$10$7ze35m4LwazWOWtbIZS8I.L6o5xDB2M0DffkUOV49zx8GPb3XzJ36', '9112451250', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'Yaoundé', NULL, NULL, NULL, NULL, NULL, 1, 'kxrj8Ro80cTYVDGBAmRoVO39ZKm7kZiwR3wETLlkipnkxHI5BDVlnmKO28aO', 1, 'bk', 0, 0, '5564', NULL, NULL, '983', '5265', 'bDcau3NGEaow8mRWos6ThTBqebxnIswRyNW5mmoRNVDTLl4rxnn684Xfkovb', '2018-10-25 22:19:24', '2018-10-29 12:23:30', 1, NULL, 'Yaoundé', NULL, NULL),
(66, 'kljm', 'ohm', 'kl', 'noso@gmail.com', '$2y$10$uNmDg3MUUMfv3JsN5df55eaze2EzQFCvADJRzXXM2FWCUUNm9Lz1W', '9112451254', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'OFA6smCuopvw8SEqWigNK2a1CrukgVsTpnMBr10uFTI6NFTUed610XO16sUi', 1, 'kl', 0, 0, NULL, NULL, NULL, NULL, NULL, 'vdhbx13AbKeYitfYTF6JmrgYK3u2jYDR7EM0GQCtEzcnmzoJhgTdthRJKauV', '2018-10-29 17:28:32', '2018-10-29 17:28:32', 1, NULL, NULL, NULL, '3,4,14');

-- --------------------------------------------------------

--
-- Structure de la table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wallet_history`
--

CREATE TABLE `wallet_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cash_back_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tran_mob_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_mob_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `next_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tran_type` enum('credit','debit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `wallet_history`
--

INSERT INTO `wallet_history` (`id`, `user_id`, `transaction_id`, `cash_back_id`, `tran_mob_num`, `received_mob_num`, `current_amount`, `amount`, `next_amount`, `tran_type`, `created_at`, `updated_at`, `status`) VALUES
(1, 17, '5aba78046dcfe', NULL, '9884496818', NULL, '0', '19', '19', 'debit', '2018-03-27 19:29:11', '2018-03-27 19:29:11', NULL),
(2, 17, '5abf1161e6262', NULL, '9884496818', NULL, '19', '50', '31', 'debit', '2018-03-31 06:13:14', '2018-03-31 06:13:14', NULL),
(3, 15, '88334540156647568', NULL, '9624949787', NULL, '0', '10', '10', 'debit', '2018-04-11 15:53:19', '2018-04-11 15:53:19', NULL),
(4, 15, '47283157918279625', NULL, '9624949787', NULL, '10', '11', '0', 'debit', '2018-04-16 13:21:20', '2018-04-16 13:21:20', NULL),
(5, 15, '55363028271223655', NULL, '9624949787', NULL, '5', '11', '0', 'debit', '2018-04-16 13:31:01', '2018-04-16 13:31:01', NULL),
(6, 15, '07184907988431784', NULL, '9624949787', NULL, '5', '11', '0', 'debit', '2018-04-16 13:49:34', '2018-04-16 13:49:34', NULL),
(7, 15, '57592102758703197', NULL, '9624949787', NULL, '5', '11', '0', 'debit', '2018-04-16 14:20:54', '2018-04-16 14:20:54', NULL),
(8, 46, '5ad49beb9597c', NULL, '7359420100', NULL, '6', '11', '0', 'debit', '2018-04-16 14:21:30', '2018-04-16 14:21:30', NULL),
(9, 46, '5ad49e38358c0', NULL, '7359420100', NULL, '5', '11', '0', 'debit', '2018-04-16 14:30:28', '2018-04-16 14:30:28', NULL),
(10, 46, '5ad49f6e01ee5', NULL, '7359420100', NULL, '5', '11', '0', 'debit', '2018-04-16 14:35:31', '2018-04-16 14:35:31', NULL),
(15, 15, '42958101038852478', NULL, NULL, NULL, NULL, '50', NULL, 'credit', '2018-04-18 11:34:01', '2018-04-18 11:34:23', 'Success'),
(16, 39, 'HU85180318', NULL, '9624949787', '9624949788', '0', '50', '50', 'credit', '2018-04-18 11:35:15', '2018-04-18 11:35:15', NULL),
(14, 15, '73749149614046904', NULL, NULL, NULL, NULL, '100', NULL, 'credit', '2018-04-18 10:47:57', '2018-04-18 11:30:47', 'Success'),
(17, 39, 'EM69844446', NULL, '9624949787', NULL, '250', '50', '200', 'debit', '2018-04-18 11:35:16', '2018-04-18 11:35:16', NULL),
(18, 15, '96970385412338107', NULL, NULL, NULL, NULL, '10', NULL, 'credit', '2018-04-18 11:42:38', '2018-04-18 11:42:38', NULL),
(19, 15, '91359385519109885', NULL, NULL, NULL, NULL, '100', NULL, 'credit', '2018-04-18 15:07:10', '2018-04-18 15:09:13', 'Success'),
(20, 46, '33812823612523509', NULL, NULL, NULL, NULL, '50', NULL, 'credit', '2018-04-20 11:04:34', '2018-04-20 11:05:39', 'Success'),
(21, 46, '12066553180551253', NULL, NULL, NULL, NULL, '50', NULL, 'credit', '2018-04-20 11:11:13', '2018-04-20 11:11:47', 'Success'),
(22, 46, '20538750829656072', NULL, NULL, NULL, NULL, '50', NULL, 'credit', '2018-04-20 11:15:35', '2018-04-20 11:16:12', 'Success'),
(23, 46, '05189190346744449', NULL, NULL, NULL, NULL, '50', NULL, 'credit', '2018-04-20 11:16:28', '2018-04-20 11:16:58', 'Success'),
(24, 46, '65332559699164323', NULL, NULL, NULL, NULL, '50', NULL, 'credit', '2018-04-20 11:28:09', '2018-04-20 11:28:44', 'Success'),
(25, 46, '47523355072080999', NULL, NULL, NULL, NULL, '50', NULL, 'credit', '2018-04-20 11:29:44', '2018-04-20 11:30:20', 'Success'),
(26, 46, '16277558369105281', NULL, NULL, NULL, NULL, '500', NULL, 'credit', '2018-04-20 11:31:51', '2018-04-20 11:32:20', 'Success'),
(27, 46, '89690237845380150', NULL, NULL, NULL, NULL, '500', NULL, 'credit', '2018-04-20 11:34:20', '2018-04-20 11:35:07', 'Success'),
(28, 15, '23973288873874997', NULL, '9898098980', NULL, '5', '100', '0', 'debit', '2018-04-20 15:20:44', '2018-04-20 15:20:44', 'Success'),
(29, 53, '34635460011462856', NULL, '9624949787', NULL, '0', '11', '0', 'debit', '2018-04-26 08:13:47', '2018-04-26 08:13:47', 'Success');

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(4, 11, 20, '2018-03-12 16:50:45', '2018-03-12 16:50:45');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_user_id_foreign` (`user_id`),
  ADD KEY `brands_category_id_foreign` (`category_id`);

--
-- Index pour la table `brands_documents`
--
ALTER TABLE `brands_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_documents_brand_id_foreign` (`brand_id`),
  ADD KEY `brands_documents_user_id_foreign` (`user_id`);

--
-- Index pour la table `cancellation_policy`
--
ALTER TABLE `cancellation_policy`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_user_id_foreign` (`user_id`),
  ADD KEY `cart_product_id_foreign` (`product_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `circle`
--
ALTER TABLE `circle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_state_id_foreign` (`state_id`);

--
-- Index pour la table `colors_images`
--
ALTER TABLE `colors_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `colors_images_attribute_id_foreign` (`attribute_id`);

--
-- Index pour la table `compare`
--
ALTER TABLE `compare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compare_user_id_foreign` (`user_id`),
  ADD KEY `compare_product_id_foreign` (`product_id`);

--
-- Index pour la table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `delivery_info`
--
ALTER TABLE `delivery_info`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employee_permission`
--
ALTER TABLE `employee_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_permission_permission_id_foreign` (`permission_id`),
  ADD KEY `employee_permission_user_id_foreign` (`user_id`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fee_deduction`
--
ALTER TABLE `fee_deduction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_deduction_category_id_foreign` (`category_id`);

--
-- Index pour la table `homepage_slider`
--
ALTER TABLE `homepage_slider`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `kyc_documents`
--
ALTER TABLE `kyc_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kyc_documents_user_id_foreign` (`user_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Index pour la table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Index pour la table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Index pour la table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operators_service_id_foreign` (`service_id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user_id_foreign` (`user_id`),
  ADD KEY `order_product_id_foreign` (`product_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `payment_collection`
--
ALTER TABLE `payment_collection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_collection_fee_deduction_id_foreign` (`fee_deduction_id`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Index pour la table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Index pour la table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_tax_class_id_foreign` (`tax_class_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`);

--
-- Index pour la table `products_sliders`
--
ALTER TABLE `products_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`);

--
-- Index pour la table `product_discount`
--
ALTER TABLE `product_discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_discount_product_id_foreign` (`product_id`);

--
-- Index pour la table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_review_user_id_foreign` (`user_id`),
  ADD KEY `product_review_product_id_foreign` (`product_id`);

--
-- Index pour la table `product_screenshots`
--
ALTER TABLE `product_screenshots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_screenshots_product_id_foreign` (`product_id`);

--
-- Index pour la table `recharge_history`
--
ALTER TABLE `recharge_history`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recharge_history_transaction_id_unique` (`transaction_id`),
  ADD KEY `recharge_history_service_id_foreign` (`service_id`),
  ADD KEY `recharge_history_user_id_foreign` (`user_id`),
  ADD KEY `recharge_history_operator_id_foreign` (`operator_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Index pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Index pour la table `seller_holiday`
--
ALTER TABLE `seller_holiday`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_holiday_user_id_foreign` (`user_id`);

--
-- Index pour la table `seller_payment_history`
--
ALTER TABLE `seller_payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_payment_history_seller_payment_id_foreign` (`seller_payment_id`);

--
-- Index pour la table `seller_payment_request`
--
ALTER TABLE `seller_payment_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_payment_request_user_id_foreign` (`user_id`);

--
-- Index pour la table `seller_policy`
--
ALTER TABLE `seller_policy`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `shipping_history`
--
ALTER TABLE `shipping_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_history_order_id_foreign` (`order_id`);

--
-- Index pour la table `shipping_information`
--
ALTER TABLE `shipping_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_information_user_id_foreign` (`user_id`);

--
-- Index pour la table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Index pour la table `subcategories2`
--
ALTER TABLE `subcategories2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories2_subcategory_id_foreign` (`subcategory_id`);

--
-- Index pour la table `subcategory_slider`
--
ALTER TABLE `subcategory_slider`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tax_class`
--
ALTER TABLE `tax_class`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `terms_condition`
--
ALTER TABLE `terms_condition`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_transaction_id_unique` (`transaction_id`),
  ADD KEY `transaction_user_id_foreign` (`user_id`),
  ADD KEY `transaction_service_id_foreign` (`service_id`),
  ADD KEY `transaction_operator_id_foreign` (`operator_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_num_unique` (`mobile_num`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Index pour la table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `wallet_history`
--
ALTER TABLE `wallet_history`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallet_history_transaction_id_unique` (`transaction_id`),
  ADD KEY `wallet_history_user_id_foreign` (`user_id`);

--
-- Index pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_user_id_foreign` (`user_id`),
  ADD KEY `wishlist_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `brands_documents`
--
ALTER TABLE `brands_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `cancellation_policy`
--
ALTER TABLE `cancellation_policy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `circle`
--
ALTER TABLE `circle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1221;

--
-- AUTO_INCREMENT pour la table `colors_images`
--
ALTER TABLE `colors_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `compare`
--
ALTER TABLE `compare`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `delivery_info`
--
ALTER TABLE `delivery_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `employee_permission`
--
ALTER TABLE `employee_permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `fee_deduction`
--
ALTER TABLE `fee_deduction`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `homepage_slider`
--
ALTER TABLE `homepage_slider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `kyc_documents`
--
ALTER TABLE `kyc_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT pour la table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `payment_collection`
--
ALTER TABLE `payment_collection`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT pour la table `products_sliders`
--
ALTER TABLE `products_sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1852;

--
-- AUTO_INCREMENT pour la table `product_discount`
--
ALTER TABLE `product_discount`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `product_screenshots`
--
ALTER TABLE `product_screenshots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=444;

--
-- AUTO_INCREMENT pour la table `recharge_history`
--
ALTER TABLE `recharge_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `seller_holiday`
--
ALTER TABLE `seller_holiday`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `seller_payment_history`
--
ALTER TABLE `seller_payment_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `seller_payment_request`
--
ALTER TABLE `seller_payment_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `seller_policy`
--
ALTER TABLE `seller_policy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `shipping_history`
--
ALTER TABLE `shipping_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `shipping_information`
--
ALTER TABLE `shipping_information`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `subcategories2`
--
ALTER TABLE `subcategories2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `subcategory_slider`
--
ALTER TABLE `subcategory_slider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `tax_class`
--
ALTER TABLE `tax_class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `terms_condition`
--
ALTER TABLE `terms_condition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `wallet_history`
--
ALTER TABLE `wallet_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brands_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `brands_documents`
--
ALTER TABLE `brands_documents`
  ADD CONSTRAINT `brands_documents_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brands_documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `colors_images`
--
ALTER TABLE `colors_images`
  ADD CONSTRAINT `colors_images_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fee_deduction`
--
ALTER TABLE `fee_deduction`
  ADD CONSTRAINT `fee_deduction_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `operators`
--
ALTER TABLE `operators`
  ADD CONSTRAINT `operators_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
