-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 09:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sale_force`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area_id` int(11) NOT NULL,
  `area_region_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_user_id` int(11) DEFAULT NULL,
  `area_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_created_at` timestamp NULL DEFAULT current_timestamp(),
  `area_updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `area_region_id`, `area_user_id`, `area_name`, `area_remarks`, `area_created_at`, `area_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, '1', 8, 'Khan Plaza', NULL, '2023-02-13 07:49:47', '2023-02-13 12:49:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, '2', 7, 'Hasil Pur', NULL, '2023-02-13 08:00:09', '2023-02-13 13:00:09', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, '3', 7, 'Darya khan', NULL, '2023-02-13 08:02:43', '2023-02-13 13:02:43', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, '4', 11, 'Multan', NULL, '2023-03-01 10:45:38', '2023-03-01 15:45:38', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(6, '6', 1, 'Karachi', NULL, '2023-03-08 07:57:47', '2023-03-08 12:57:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(7, '6', 1, 'sdfsdf', NULL, '2024-01-27 07:58:12', '2024-01-27 12:58:12', '::1', 'Windows 10', 'Chrome', 'Computer'),
(9, '8', 1, 'eeee', NULL, '2024-01-27 08:03:56', '2024-01-27 13:03:56', '::1', 'Windows 10', 'Chrome', 'Computer'),
(10, '11', 1, 'sdfasdfasd', NULL, '2024-01-27 08:07:42', '2024-01-27 13:07:42', '::1', 'Windows 10', 'Chrome', 'Computer'),
(11, '14', 1, 'QWS', NULL, '2024-01-27 08:17:44', '2024-01-27 13:17:44', '::1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `business_category`
--

CREATE TABLE `business_category` (
  `business_category_id` int(11) NOT NULL,
  `business_category_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_category_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_category_created_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_category_updated_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_category`
--

INSERT INTO `business_category` (`business_category_id`, `business_category_user_id`, `business_category_name`, `business_category_created_at`, `business_category_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, '17', 'Camera', '2023-02-27 12:49:18', '2023-02-13 12:49:18', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, '1', 'LED TV', '2023-02-28 12:35:20', '2023-03-08 12:35:20', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, '1', 'Electronics', '2023-02-25 15:37:13', '2023-03-09 15:37:13', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(5, '1', 'CCTV', '2023-03-09 15:37:36', '2023-03-09 15:37:36', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(6, '17', 'Water Supply', '2023-03-09 15:44:48', '2023-03-09 15:44:48', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(7, '17', 'Watches', '2023-03-09 15:45:01', '2023-03-09 15:45:01', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `business_profile`
--

CREATE TABLE `business_profile` (
  `business_profile_id` int(11) NOT NULL,
  `business_profile_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_profile_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_profile_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_profile_ntn_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_profile_gst_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_profile_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_profile_ptcl_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_profile_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_profile_web_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_profile_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `business_profile_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_profile`
--

INSERT INTO `business_profile` (`business_profile_id`, `business_profile_logo`, `business_profile_name`, `business_profile_address`, `business_profile_ntn_no`, `business_profile_gst_no`, `business_profile_mobile_no`, `business_profile_ptcl_no`, `business_profile_email`, `business_profile_web_address`, `business_profile_created_at`, `business_profile_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 'cartoon_1677586799.png', 'Softagics', 'Shah Rukn-e-ALAM Multan Pakistan', '0132547', '0214578960142', '03130256475', '0513274123', 'Softagics@gmail.com', 'www.softagics.com', '2023-02-28 12:20:00', '2023-02-28 17:20:00', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_user_id` int(11) NOT NULL,
  `cat_product_group_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_user_id`, `cat_product_group_id`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `cat_category`) VALUES
(1, 1, '1', '2023-04-08 07:15:34', '2023-04-08 07:15:34', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 'Camera'),
(2, 1, '2', '2023-04-08 07:15:59', '2023-04-08 07:15:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 'LCD'),
(3, 1, '2', '2023-04-08 07:15:59', '2023-04-08 07:15:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 'Laptop'),
(4, 1, '2', '2023-04-08 07:16:00', '2023-04-08 07:16:00', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 'Keyborad');

-- --------------------------------------------------------

--
-- Table structure for table `cat_product_grp`
--

CREATE TABLE `cat_product_grp` (
  `cat_product_grp_id` int(11) NOT NULL,
  `product_cat_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_grp_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_category_id` int(11) DEFAULT NULL,
  `com_region_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `com_sector_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `com_area_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `com_town_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp_ptcl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comp_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comp_mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comp_whatsapp_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comp_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comp_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_coordinate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comp_webaddress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comp_remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `user_id`, `business_category_id`, `com_region_id`, `com_sector_id`, `com_area_id`, `com_town_id`, `company_name`, `comp_ptcl`, `comp_address`, `comp_mobile_no`, `comp_whatsapp_no`, `comp_email`, `comp_status`, `map_coordinate`, `comp_webaddress`, `comp_remarks`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 1, 1, '1', '1', '1', '1', 'khan Printers', '0313254145', 'khan Printers', '03132547415', '031325474545', 'khanprinters@gmailcom', '0', '30.200867939719867, 71.53845013338103', 'khanPrinters.com', NULL, '2023-02-20 12:31:38', '2023-02-22 08:08:11', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, 1, 1, '1', '1', '1', '1', 'green T & D', '03132541244', 'sdadfsasdffd', '0313254741', '0313254741', 'greent&d@gmail.com', '1', '30.18439845902759, 71.53402985299549', 'greent&d.com', NULL, '2023-02-24 11:40:09', '2023-02-24 11:40:09', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, 1, 1, '1', '1', '1', '1', 'assus', '0212145474', 'sfasdfasdfasdfasdfasdf', '03132541211', '03132541211', 'assus@gmail.com', '1', '30.18818223207812, 71.51038349869997', 'assus.com', NULL, '2023-02-27 07:44:34', '2023-02-27 07:44:34', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, 11, 1, '4', '4', '4', '1', 'Fahad Printers', '3133332112', 'SDAFSDFASDFASDF', '03132254141', '03132254141', 'fahad@gmail.com', '1', '30.208798359424268, 71.47565200445908', 'fahadprinters.comq', NULL, '2023-03-01 10:47:44', '2023-03-01 10:47:44', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(5, 1, 1, '6', '6', '6', '5', 'Raes', '1235641422', 'Raes', '03125478541', '03125478541', 'raes@gmail.com', '0', '30.16074549058018, 71.50264573535604', 'raes.com', NULL, '2023-03-08 09:33:10', '2023-03-09 06:04:19', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(6, 1, 4, '1', '1', '1', '1', 'Ewas', '15155515151', 'sdfdsfsdf', '45444444444', '45444444444', 'sdfsdf@w', NULL, '8888888888888888888888', 'asdfasdf', 'asdfsadffff', '2024-01-26 08:00:06', '2024-01-26 12:33:55', '::1', 'Windows 10', 'Chrome', 'Computer'),
(7, 1, 1, '1', '2', '1', '4', 'czxczxcs', '888888888888', 'czxczxcxdfxzcxcvzxcv', '888888888888', '888888888888', 'xcvzxcv@w', NULL, '8888888888888888888', 'zCXZXc', NULL, '2024-01-26 12:01:30', '2024-01-26 12:34:58', '::1', 'Windows 10', 'Chrome', 'Computer'),
(8, 1, 2, '1', '1', '1', '1', 'dfsdsf', '00000055555', 'SDFDFSF', '1111111111111', '1111111111111', 'WS@W', NULL, '999999999999988888', 'sdfdf', NULL, '2024-01-27 06:21:25', '2024-01-27 06:21:25', '::1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `company_poc_profile`
--

CREATE TABLE `company_poc_profile` (
  `com_poc_profile_id` int(11) NOT NULL,
  `com_poc_profile_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_poc_profile_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_poc_profile_company_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_poc_profile_designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_poc_profile_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_poc_profile_whatsapp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_poc_profile_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_poc_profile_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_poc_profile_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `com_poc_profile_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `com_poc_profile_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_poc_profile`
--

INSERT INTO `company_poc_profile` (`com_poc_profile_id`, `com_poc_profile_user_id`, `com_poc_profile_name`, `com_poc_profile_company_id`, `com_poc_profile_designation`, `com_poc_profile_mobile_no`, `com_poc_profile_whatsapp_no`, `com_poc_profile_email`, `com_poc_profile_status`, `com_poc_profile_address`, `com_poc_profile_created_at`, `com_poc_profile_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, '1', 'Khan SahaB', '1', 'Hr', '031325414755', '031325414755', 'khan@gmail.coM', '1', NULL, '2023-02-22 08:27:14', '2023-02-24 13:14:53', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, '1', 'Sham Idrees', '2', 'Md', '03132541475', '03132541475', 'shamidreees@gmail.com', '0', NULL, '2023-02-24 11:23:07', '2023-03-09 11:29:08', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(6, '1', 'Hasham', '2', 'Md', '031230254745', '031230254745', 'hasham@gmail.com', '1', NULL, '2023-03-10 11:23:59', '2023-03-10 16:23:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, '11', 'arshad', '4', 'GM', '031325414745', '031325414745', 'arshad@gmail.com', '1', NULL, '2023-03-01 10:48:15', '2023-03-01 15:48:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(7, '1', 'asad', '7', 'sadfsdf', '000000000', '000000000', 'sadfasd@w', NULL, NULL, '2024-01-26 08:01:49', '2024-01-26 18:43:50', '::1', 'Windows 10', 'Chrome', 'Computer'),
(8, '1', 'Aswe', NULL, 'asfddfsdfs', '0000', '0000', 'far@w', NULL, NULL, '2024-01-26 12:44:54', '2024-01-26 18:12:59', '::1', 'Windows 10', 'Chrome', 'Computer'),
(9, '1', 'sss', '2', 'sdfsdfdf', '77777777777', '77777777777', 'erw@w', NULL, NULL, '2024-01-27 06:19:06', '2024-01-27 11:19:06', '::1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `comprofile_id` int(11) NOT NULL,
  `comprofile_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprofile_company_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprofile_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprofile_ptcl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprofile_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprofile_mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprofile_whatsapp_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprofile_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprofile_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprofile_web_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comprofile_created_at` datetime DEFAULT NULL,
  `comprofile_updated_at` datetime DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`comprofile_id`, `comprofile_user_id`, `comprofile_company_id`, `comprofile_name`, `comprofile_ptcl`, `comprofile_address`, `comprofile_mobile_no`, `comprofile_whatsapp_no`, `comprofile_email`, `comprofile_status`, `comprofile_web_address`, `comprofile_created_at`, `comprofile_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, '1', '1', NULL, '0313241472', 'sdfsdfdfdsfsdfsdfasdf', '0313251474', '0313251474', 'krfi@gmail.com', '1', 'rfi.com', '2023-02-16 16:46:53', '2023-02-16 16:46:53', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `expiry_days`
--

CREATE TABLE `expiry_days` (
  `id` int(11) NOT NULL,
  `days` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expiry_days`
--

INSERT INTO `expiry_days` (`id`, `days`, `updated_at`) VALUES
(1, '10', '2024-01-27 02:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `funnel`
--

CREATE TABLE `funnel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` int(11) DEFAULT 1,
  `otc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funnel_reminder_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funnel`
--

INSERT INTO `funnel` (`id`, `user_id`, `date`, `company_id`, `category_id`, `mrc`, `status_remarks`, `cat_remarks`, `status_id`, `otc`, `funnel_reminder_reason`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 1, '2022-11-10', 1, '1', '77', 'An Active', NULL, 0, '4', NULL, '2022-11-10 08:02:24', '2024-01-27 07:06:32', '::1', 'Windows 10', 'Chrome', 'Computer'),
(2, 1, '2022-11-28', 1, '2', '120', NULL, NULL, 1, '1', NULL, '2022-11-28 09:18:24', '2022-11-28 09:18:24', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, 1, '07-04-2023', 1, '2,3', '900', NULL, NULL, 1, '875', NULL, '2023-04-07 06:59:20', '2023-04-07 07:00:00', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `funnel_target`
--

CREATE TABLE `funnel_target` (
  `funnel_target_id` int(11) NOT NULL,
  `funnel_target_your_manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funnel_target_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funnel_target_by` int(11) DEFAULT NULL,
  `funnel_target_product_category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funnel_target_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funnel_target_role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funnel_target_otc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funnel_target_mrc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funnel_target_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `funnel_target_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funnel_target`
--

INSERT INTO `funnel_target` (`funnel_target_id`, `funnel_target_your_manager`, `funnel_target_user_id`, `funnel_target_by`, `funnel_target_product_category`, `funnel_target_date`, `funnel_target_role`, `funnel_target_otc`, `funnel_target_mrc`, `funnel_target_created_at`, `funnel_target_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, '1', '17', 1, '1', '2022-11-09', 'Supervisor', '2', '2', '2022-11-09 11:07:30', '2022-11-09 16:07:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, '1', '17', 1, '2', '2022-11-10', 'Supervisor', '2', '9', '2022-11-10 07:17:02', '2022-11-10 12:17:02', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, '5', '17', 1, '1', '23-11-2022', 'Sale Person', '2', '4', '2022-11-23 10:30:30', '2022-11-23 15:30:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, '1', '17', 1, '1', '08-03-2023', 'Supervisor', '20', '0', '2023-03-08 10:44:38', '2023-03-08 15:44:38', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` int(11) DEFAULT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inv_date` date DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `grand_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tandc_id` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `unique_id` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poc_id` int(11) DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `link` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version_use` int(11) DEFAULT NULL,
  `invoice_reminder_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_no`, `user_id`, `inv_date`, `company_id`, `grand_total`, `subject`, `tandc_id`, `unique_id`, `poc_id`, `version`, `link`, `version_use`, `invoice_reminder_reason`, `quotation_remarks`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `expiry_date`) VALUES
(1, 1, '1', '2023-04-08', 1, '2530', 'CCTV EXT', '1', '1-CCTV EXT-khan Printers', 1, 1, '2,4', NULL, NULL, 'sdffsdfd', '2023-04-08 07:55:47', '2023-04-08 07:55:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23'),
(2, 2, '1', '2023-04-08', 2, '2750', 'LCD', '1', '2-LCD-green T & D', 6, 1, '2,3', NULL, NULL, 'sdfsdfsdfsdf', '2023-04-08 07:56:30', '2023-04-08 07:56:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23'),
(3, 3, '1', '2023-04-08', 2, '4550', 'LCD', '1,2', '2-LCD-green T & D', 6, 2, '4', 1, NULL, 'fsdfsdf', '2023-04-08 09:40:48', '2023-04-08 09:40:48', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23'),
(4, 4, '1', '2023-04-08', 2, '5300', 'LCD', '2', '2-LCD-green T & D', 6, 3, NULL, 1, NULL, 'sfssfdfsd', '2023-04-08 09:41:05', '2023-04-08 09:41:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2024-02-11'),
(10, 10, '1', '2024-01-27', 1, '780', 'WSE', '2,5', '9-WSE-khan Printers', 1, 2, NULL, 1, NULL, 'sdfsdfsdf', '2024-01-27 07:39:07', '2024-01-27 07:39:07', '::1', 'Windows 10', 'Chrome', 'Computer', '2024-02-11'),
(6, 6, '1', '2023-04-08', 1, '110410', 'CCTV EXT', '1,2', '1-CCTV EXT-khan Printers', 1, 2, '3', 1, NULL, 'dfdsfsd', '2023-04-08 09:46:21', '2023-04-08 09:46:21', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23'),
(7, 7, '1', '2023-04-08', 1, '11810', 'CCTV EXT', '1', '1-CCTV EXT-khan Printers', 1, 3, NULL, 2, NULL, 'fssf', '2023-04-08 09:47:05', '2023-04-08 09:47:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23'),
(8, 8, '1', '2023-04-08', 1, '5130', 'CCTV EXT', '1,2', '1-CCTV EXT-khan Printers', 1, 4, NULL, 1, NULL, 'sdffsd', '2023-04-08 09:53:15', '2023-04-08 09:53:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23'),
(9, 9, '1', '2024-01-27', 1, '200', 'WSE', '5', '9-WSE-khan Printers', 1, 1, '2', NULL, NULL, 'sdfsdfasdf', '2024-01-27 07:18:24', '2024-01-27 07:18:24', '::1', 'Windows 10', 'Chrome', 'Computer', '2024-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `main_unit`
--

CREATE TABLE `main_unit` (
  `main_unit_id` int(11) NOT NULL,
  `main_unit_user_id` int(11) DEFAULT NULL,
  `main_unit_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_unit_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_unit_created_at` timestamp NULL DEFAULT current_timestamp(),
  `main_unit_updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_unit`
--

INSERT INTO `main_unit` (`main_unit_id`, `main_unit_user_id`, `main_unit_name`, `main_unit_remarks`, `main_unit_created_at`, `main_unit_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 1, 'MM', NULL, '2023-04-08 07:13:51', '2023-04-08 12:13:51', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, 1, 'Weight', NULL, '2023-04-08 07:14:06', '2023-04-08 12:14:06', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_07_18_064539_create_area_table', 1),
(2, '2020_07_18_064539_create_business_category_table', 1),
(3, '2020_07_18_064539_create_business_profile_table', 1),
(4, '2020_07_18_064539_create_cat_product_grp_table', 1),
(5, '2020_07_18_064539_create_category_table', 1),
(6, '2020_07_18_064539_create_company_poc_profile_table', 1),
(7, '2020_07_18_064539_create_company_profile_table', 1),
(8, '2020_07_18_064539_create_company_table', 1),
(9, '2020_07_18_064539_create_funnel_table', 1),
(10, '2020_07_18_064539_create_funnel_target_table', 1),
(11, '2020_07_18_064539_create_invoice_table', 1),
(12, '2020_07_18_064539_create_main_unit_table', 1),
(13, '2020_07_18_064539_create_messages_table', 1),
(14, '2020_07_18_064539_create_order_purposal_table', 1),
(15, '2020_07_18_064539_create_order_table', 1),
(16, '2020_07_18_064539_create_order_target_table', 1),
(17, '2020_07_18_064539_create_post_table', 1),
(18, '2020_07_18_064539_create_product_group_table', 1),
(19, '2020_07_18_064539_create_product_group_target_table', 1),
(20, '2020_07_18_064539_create_product_price_table', 1),
(21, '2020_07_18_064539_create_product_table', 1),
(22, '2020_07_18_064539_create_quotation_target_table', 1),
(23, '2020_07_18_064539_create_region_table', 1),
(24, '2020_07_18_064539_create_remarks_table', 1),
(25, '2020_07_18_064539_create_reminder_table', 1),
(26, '2020_07_18_064539_create_sale_invoice_table', 1),
(27, '2020_07_18_064539_create_schedule_table', 1),
(28, '2020_07_18_064539_create_schedule_target_table', 1),
(29, '2020_07_18_064539_create_sector_table', 1),
(30, '2020_07_18_064539_create_status_table', 1),
(31, '2020_07_18_064539_create_term_and_condition_table', 1),
(32, '2020_07_18_064539_create_testing_table', 1),
(33, '2020_07_18_064539_create_town_table', 1),
(34, '2020_07_18_064539_create_unit_table', 1),
(35, '2020_07_18_064539_create_upload_video_table', 1),
(36, '2020_07_18_064539_create_users_table', 1),
(37, '2020_07_18_064539_create_visit_type_table', 1),
(38, '2020_07_18_064539_create_websockets_statistics_entries_table', 1),
(39, '2020_07_27_090457_create_user_role_table', 1),
(40, '2020_08_12_051738_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 17);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_no` int(11) DEFAULT NULL,
  `tandc_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `sale_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `grand_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_reminder_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `invoice_id`, `order_no`, `tandc_id`, `sale_date`, `company_id`, `grand_total`, `order_reminder_reason`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(12, 1, '1', 7, '1', '01/27/2024', 1, '2530', NULL, '2024-01-27 07:53:18', '2024-01-27 07:53:18', '::1', 'Windows 10', 'Chrome', 'Computer'),
(13, 1, '3', 8, '1', '01/27/2024', 1, '4550', NULL, '2024-01-27 07:53:43', '2024-01-27 07:53:43', '::1', 'Windows 10', 'Chrome', 'Computer'),
(7, 8, '2', 5, '1,2,5', '02/13/2023', 1, '270', NULL, '2023-02-13 12:50:55', '2023-02-13 12:50:55', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `order_purposal`
--

CREATE TABLE `order_purposal` (
  `order_purposal_id` int(11) NOT NULL,
  `order_purposal_order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_purposal_user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_purposal_category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_purposal_product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_purposal_qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_purposal_sale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_purposal_total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_purposal_pro_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_purposal_payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_purposal_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_purposal_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_purposal_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_purposal`
--

INSERT INTO `order_purposal` (`order_purposal_id`, `order_purposal_order_id`, `order_purposal_user_id`, `order_purposal_category_id`, `order_purposal_product_id`, `order_purposal_qty`, `order_purposal_sale`, `order_purposal_total_amount`, `order_purposal_pro_description`, `order_purposal_payment_type`, `order_purposal_date`, `order_purposal_created_at`, `order_purposal_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(15, '13', '1', '2', '2', '13', '200', '2600', '<p>asdffsdafsd<strong>sdfasfd</strong></p>', 'OTC', '01/27/2024', '2024-01-27 07:53:43', '2024-01-27 12:53:43', '::1', 'Windows 10', 'Chrome', 'Computer'),
(14, '13', '1', '1', '1', '13', '150', '1950', '<ul>\r\n<li>sdfafsasdfsdffasdfsdfsdfasdf<strong>sdf</strong></li>\r\n</ul>', 'OTC', '01/27/2024', '2024-01-27 07:53:43', '2024-01-27 12:53:43', '::1', 'Windows 10', 'Chrome', 'Computer'),
(13, '12', '1', '4', '4', '1', '580', '580', '<p>dsffasfsdf<strong>asdffasd</strong></p>', 'OTC', '01/27/2024', '2024-01-27 07:53:18', '2024-01-27 12:53:18', '::1', 'Windows 10', 'Chrome', 'Computer'),
(12, '12', '1', '1', '1', '13', '150', '1950', '<ul>\r\n<li>sdfafsasdfsdffasdfsdfsdfasdf<strong>sdf</strong></li>\r\n</ul>', 'OTC', '01/27/2024', '2024-01-27 07:53:18', '2024-01-27 12:53:18', '::1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `order_target`
--

CREATE TABLE `order_target` (
  `order_target_id` int(11) NOT NULL,
  `order_target_your_manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_target_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_target_by` int(11) DEFAULT NULL,
  `order_target_product_category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_target_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_target_role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_target_otc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_target_mrc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_target_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_target_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_target`
--

INSERT INTO `order_target` (`order_target_id`, `order_target_your_manager`, `order_target_user_id`, `order_target_by`, `order_target_product_category`, `order_target_date`, `order_target_role`, `order_target_otc`, `order_target_mrc`, `order_target_created_at`, `order_target_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, '1', '17', 1, '1', '09-03-2023', 'Supervisor', '22', '23', '2023-03-09 09:44:49', '2023-03-09 14:44:49', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, '1', '17', 1, '2', '09-03-2023', 'Supervisor', '33', '2', '2023-03-09 09:45:02', '2023-03-09 14:45:02', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, '1', '17', 1, '3', '09-03-2023', 'Supervisor', '23', '85', '2023-03-09 09:45:10', '2023-03-09 14:45:10', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'businessCategory', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(2, 'view_businessCategory', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(3, 'edit_businessCategory', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(4, 'delete_businessCategory', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(5, 'region', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(6, 'viewRegion', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(7, 'editRegion', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(8, 'deleteRegion', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(9, 'area', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(10, 'viewArea', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(11, 'editArea', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(12, 'deleteArea', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(13, 'sector', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(14, 'viewSector', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(15, 'editSector', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(16, 'deleteSector', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(17, 'createTown', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(18, 'town', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(19, 'editTown', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(20, 'deleteTown', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(21, 'visitTypeCreate', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(22, 'visitTypeView', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(23, 'visitTypeEdit', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(24, 'visitTypeDelete', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(25, 'mainUnitCreate', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(26, 'mainUnit', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(27, 'mainUnitEdit', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(28, 'mainUnitDelete', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(29, 'uomCreate', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(30, 'uom', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(31, 'uomEdit', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(32, 'uomDelete', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(33, 'createCategory', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(34, 'category', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(35, 'editCategory', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(36, 'deleteCategory', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(37, 'createProduct', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(38, 'product', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(39, 'editProduct', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(40, 'deleteProduct', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(41, 'productPriceCreate', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(42, 'productPrice', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(43, 'productPriceEdit', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(44, 'productPriceDelete', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(45, 'TandC', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(46, 'viewTandC', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(47, 'edit_tandc', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(48, 'deleteTandC', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(49, 'createTarget', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(50, 'createStatus', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(51, 'status', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(52, 'editStatus', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(53, 'deleteStatus', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(54, 'createuser', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(55, 'user', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(56, 'edituser', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(57, 'deleteuser', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(58, 'user_role_create', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(59, 'user_role', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(60, 'user_role_edit', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(61, 'user_role_delete', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(62, 'create_modular_group', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(63, 'modular_group', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(64, 'edit_modular_group', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(65, 'delete_modular_group', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(66, 'businessProfile', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(67, 'createClients', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(68, 'clients', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(69, 'editClients', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(70, 'deleteClients', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(71, 'createCompProfile', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(72, 'CompProfile', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(73, 'editCompProfile', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(74, 'deleteCompProfile', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(75, 'schedule', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(76, 'schedule_show', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(77, 'schedule_edit', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(78, 'schedule_delete', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(79, 'createFunnel', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(80, 'funnel', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(81, 'editFunnel', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(82, 'deleteFunnel', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(83, 'create_quotation', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(84, 'quotations', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(85, 'view_expiry_days', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(86, 'order', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(87, 'scheduleReports', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(88, 'funnelReports', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(89, 'purposalReports', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(90, 'orderReports', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(91, 'scheduleReminder', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(92, 'funnelReminder', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(93, 'purposalReminder', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(94, 'orderReminder', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(95, 'scheduleRemarks', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(96, 'funnelRemarks', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(97, 'purposalRemarks', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(98, 'orderRemarks', 'web', '2020-08-15 03:56:24', '2020-08-15 03:56:24'),
(99, 'createProductGroup', 'web', NULL, NULL),
(100, 'productGroup', 'web', NULL, NULL),
(101, 'productGroupEdit', 'web', NULL, NULL),
(102, 'productGroupDelete', 'web', NULL, NULL),
(103, 'createOrder', 'web', NULL, NULL),
(104, 'storeClients', 'web', '2023-02-02 12:30:08', '2023-02-02 12:30:08'),
(105, 'storeRegion', 'web', NULL, NULL),
(106, 'store_businessCategory', 'web', NULL, NULL),
(107, 'update_businessCategory', 'web', NULL, NULL),
(108, 'updateRegion', 'web', '2023-02-03 11:33:06', '2023-02-03 11:33:06'),
(109, 'storeArea', 'web', '2023-02-03 11:33:06', '2023-02-03 11:33:06'),
(110, 'updateArea', 'web', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'storeSector', 'web', '2023-02-03 12:22:37', '0000-00-00 00:00:00'),
(112, 'updateSector', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(113, 'storeTown', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(114, 'updateTown', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(115, 'visitTypeStore', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(116, 'visitTypeUpdate', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(117, 'mainUnitStore', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(118, 'mainUnitUpdate', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(119, 'uomStore', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(120, 'uomUpdate', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(121, 'productGroupStore', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(122, 'productGroupUpdate', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(123, 'storeCategory', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(124, 'updateCategory', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(125, 'storeProduct', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(126, 'updateProduct', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(127, 'productPriceStore', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(128, 'productPriceUpdate', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(129, 'storeTandC', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(130, 'update_tandc', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(131, 'storeTask', 'web', '2023-02-03 12:24:50', '2023-02-03 12:24:50'),
(132, 'storeStatus', 'web', '2023-02-03 12:32:52', '2023-02-03 12:32:52'),
(133, 'updateStatus', 'web', '2023-02-03 12:32:52', '2023-02-03 12:32:52'),
(134, 'storeuser', 'web', '2023-02-03 12:32:52', '2023-02-03 12:32:52'),
(135, 'updateuser', 'web', '2023-02-03 12:32:52', '2023-02-03 12:32:52'),
(136, 'editProfile', 'web', '2023-02-03 12:32:52', '2023-02-03 12:32:52'),
(137, 'updateProfile', 'web', '2023-02-03 12:32:52', '2023-02-03 12:32:52'),
(138, 'change-password', 'web', '2023-02-03 12:32:52', '2023-02-03 12:32:52'),
(139, 'change_password', 'web', '2023-02-03 12:32:52', '2023-02-03 12:32:52'),
(140, 'store_modular_group', 'web', '2023-02-03 12:32:52', '2023-02-03 12:32:52'),
(141, 'update_modular_group', 'web', '2023-02-03 12:32:52', '2023-02-03 12:32:52'),
(142, 'updateBusinessProfile', 'web', '2023-02-03 12:35:55', '2023-02-03 12:35:55'),
(168, 'ClientPoc', 'web', '2023-03-01 08:08:15', '2023-03-01 08:08:15'),
(144, 'updateClients', 'web', '2023-02-03 12:35:55', '2023-02-03 12:35:55'),
(145, 'storeCompProfile', 'web', '2023-02-03 12:35:55', '2023-02-03 12:35:55'),
(146, 'updateCompProfile', 'web', '2023-02-03 12:35:55', '2023-02-03 12:35:55'),
(147, 'schedule_store', 'web', '2023-02-03 12:35:55', '2023-02-03 12:35:55'),
(148, 'schedule_update', 'web', '2023-02-03 12:35:55', '2023-02-03 12:35:55'),
(149, 'storeFunnel', 'web', '2023-02-03 12:35:55', '2023-02-03 12:35:55'),
(150, 'updateFunnel', 'web', '2023-02-03 12:46:39', '2023-02-03 12:46:39'),
(151, 'store_quotation', 'web', '2023-02-03 12:46:39', '2023-02-03 12:46:39'),
(152, 'versionInvoice', 'web', '2023-02-03 12:47:30', '2023-02-03 12:47:30'),
(153, 'store_version', 'web', '2023-02-03 12:47:30', '2023-02-03 12:47:30'),
(154, 'deleteInvoice', 'web', '2023-02-03 12:47:30', '2023-02-03 12:47:30'),
(155, 'storeOrder', 'web', '2023-02-03 12:47:30', '2023-02-03 12:47:30'),
(156, 'updateOrder', 'web', '2023-02-03 12:47:30', '2023-02-03 12:47:30'),
(160, 'deleteOrder', 'web', '2023-02-04 07:34:47', '2023-02-04 07:34:47'),
(159, 'editOrder', 'web', '2023-02-04 07:34:47', '2023-02-04 07:34:47'),
(162, 'approval_quotations', 'web', '2023-02-10 11:30:55', '2023-02-10 11:30:55'),
(163, 'view_expiry_approvals', 'web', '2023-02-13 07:05:58', '2023-02-12 19:00:00'),
(164, 'get_purposal', 'web', '2023-02-13 11:16:47', '2023-02-13 11:16:47'),
(165, 'purposal_lists', 'web', '2023-02-13 11:16:47', '2023-02-13 11:16:47'),
(166, 'get_product_list', 'web', '2023-02-13 11:17:28', '2023-02-13 11:17:28'),
(167, 'checkQuery', 'web', '2023-02-13 11:17:45', '2023-02-13 11:17:45'),
(169, 'createClientPoc', 'web', '2023-03-01 08:08:15', '2023-03-01 08:08:15'),
(170, 'storeClientPoc', 'web', '2023-03-01 08:08:15', '2023-03-01 08:08:15'),
(171, 'editClientPoc', 'web', '2023-03-01 08:08:15', '2023-03-01 08:08:15'),
(172, 'updateClientPoc', 'web', '2023-03-01 08:08:15', '2023-03-01 08:08:15'),
(173, 'deleteClientPoc', 'web', '2023-03-01 08:08:15', '2023-03-01 08:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `post_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pro_group_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_status` int(11) NOT NULL DEFAULT 1,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `user_id`, `pro_group_id`, `cat_id`, `product_unit`, `product_status`, `product_name`, `description`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 1, '1', '1', '1', 1, 'HickVision', '<ul>\r\n<li>sdfafsasdfsdffasdfsdfsdfasdf<strong>sdf</strong></li>\r\n</ul>', '2023-04-08 07:16:23', '2023-04-08 13:21:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, 1, '2', '2', '1', 1, 'Dell 104', '<p>asdffsdafsd<strong>sdfasfd</strong></p>', '2023-04-08 07:17:01', '2023-04-08 12:17:01', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, 1, '2', '3', '1', 0, 'HP-Zbook', '<p>sdasdfsdfdsf<strong>sdafdfs</strong></p>', '2023-04-08 07:17:28', '2023-04-08 12:17:28', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, 1, '2', '4', '1', 1, 'Thunder F321', '<p>dsffasfsdf<strong>asdffasd</strong></p>', '2023-04-08 07:17:59', '2023-04-08 12:17:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `product_group`
--

CREATE TABLE `product_group` (
  `product_group_id` int(11) NOT NULL,
  `product_group_user_id` int(11) DEFAULT NULL,
  `product_group_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_group_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_group_created_at` timestamp NULL DEFAULT current_timestamp(),
  `product_group_updated_at` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_group`
--

INSERT INTO `product_group` (`product_group_id`, `product_group_user_id`, `product_group_name`, `product_group_remarks`, `ip_address`, `os_name`, `browser`, `device`, `product_group_created_at`, `product_group_updated_at`) VALUES
(1, 1, 'CCTV', NULL, '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-08 07:14:47', '2023-04-08 12:14:47'),
(2, 1, 'Computer', NULL, '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-08 07:15:00', '2023-04-08 12:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_group_target`
--

CREATE TABLE `product_group_target` (
  `product_group_target_id` int(11) NOT NULL,
  `product_group_target_your_manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_group_target_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_group_target_by` int(11) DEFAULT NULL,
  `product_group_target` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_group_target_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_group_target_role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_group_target_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_group_target_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_group_target`
--

INSERT INTO `product_group_target` (`product_group_target_id`, `product_group_target_your_manager`, `product_group_target_user_id`, `product_group_target_by`, `product_group_target`, `product_group_target_date`, `product_group_target_role`, `product_group_target_created_at`, `product_group_target_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, '1', '11', 1, '2', '15-03-2023', 'Supervisor', '2023-03-08 10:45:22', '2023-03-08 15:45:22', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `product_price_id` int(11) NOT NULL,
  `product_price_user_id` int(11) DEFAULT NULL,
  `product_price_product_id` int(11) DEFAULT NULL,
  `product_price_purchase` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price_sale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_price_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`product_price_id`, `product_price_user_id`, `product_price_product_id`, `product_price_purchase`, `product_price_sale`, `product_price_status`, `product_price_unit`, `product_price_updated_at`, `product_price_created_at`, `os_name`, `browser`, `device`, `ip_address`) VALUES
(1, 1, 1, '120', '150', NULL, NULL, '2023-04-08 12:18:21', '2023-04-08 07:18:21', 'Windows 10', 'Chrome', 'Computer', '127.0.0.1'),
(2, 1, 2, '180', '200', NULL, NULL, '2023-04-08 12:18:35', '2023-04-08 07:18:35', 'Windows 10', 'Chrome', 'Computer', '127.0.0.1'),
(3, 1, 3, '490', '512', NULL, NULL, '2023-04-08 12:18:53', '2023-04-08 07:18:53', 'Windows 10', 'Chrome', 'Computer', '127.0.0.1'),
(4, 1, 4, '560', '580', NULL, NULL, '2023-04-08 12:19:05', '2023-04-08 07:19:05', 'Windows 10', 'Chrome', 'Computer', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `quotations_approval`
--

CREATE TABLE `quotations_approval` (
  `id` int(11) NOT NULL,
  `inv_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `request_time` datetime DEFAULT NULL,
  `approve_time` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `refuse_remarks` varchar(255) DEFAULT NULL,
  `refuse_time` datetime DEFAULT NULL,
  `refused_by` int(11) DEFAULT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'PENDING',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotations_approval`
--

INSERT INTO `quotations_approval` (`id`, `inv_id`, `user_id`, `request_time`, `approve_time`, `remarks`, `approved_by`, `refuse_remarks`, `refuse_time`, `refused_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 8, '2023-02-13 08:08:59', NULL, 'fdadfsasdffsd', NULL, NULL, NULL, NULL, 'Approved', '2023-02-13 08:08:59', '2023-02-13 10:52:14'),
(2, 1, 1, '2023-02-16 07:37:53', NULL, 'sdfsdfsdf', NULL, NULL, NULL, NULL, 'Approved', '2023-02-16 07:37:53', '2023-02-16 07:38:46'),
(3, 5, 1, '2024-01-27 07:25:43', '2024-01-27 07:31:35', 'sfdfsdf', 1, NULL, NULL, NULL, 'Approved', '2024-01-27 07:25:43', '2024-01-27 07:31:35'),
(4, 4, 1, '2024-01-27 07:26:40', '2024-01-27 07:31:40', 'sdfdff', 1, NULL, NULL, NULL, 'Approved', '2024-01-27 07:26:40', '2024-01-27 07:31:40'),
(5, 8, 1, '2024-01-27 07:31:56', NULL, 'sdfsdf', NULL, 'sdfsdafsdf', '2024-01-27 07:33:45', 1, 'Refused', '2024-01-27 07:31:56', '2024-01-27 07:33:45'),
(6, 7, 1, '2024-01-27 07:32:03', NULL, 'sdfsdf', NULL, 'g', '2024-01-27 07:35:32', 1, 'Refused', '2024-01-27 07:32:03', '2024-01-27 07:35:32'),
(7, 2, 1, '2024-01-27 07:34:20', NULL, 'gfgfg', NULL, 'sdfsdf', '2024-01-27 07:34:32', 1, 'Refused', '2024-01-27 07:34:20', '2024-01-27 07:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_target`
--

CREATE TABLE `quotation_target` (
  `quotation_target_id` int(11) NOT NULL,
  `quotation_target_your_manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_target_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_target_by` int(11) DEFAULT NULL,
  `quotation_target_product_category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_target_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_target_role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_target_otc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_target_mrc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_target_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `quotation_target_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotation_target`
--

INSERT INTO `quotation_target` (`quotation_target_id`, `quotation_target_your_manager`, `quotation_target_user_id`, `quotation_target_by`, `quotation_target_product_category`, `quotation_target_date`, `quotation_target_role`, `quotation_target_otc`, `quotation_target_mrc`, `quotation_target_created_at`, `quotation_target_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, '1', '17', 1, '1', '2022-11-09', 'Supervisor', '20', '3', '2022-11-09 11:08:58', '2022-11-09 16:08:58', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, '1', '17', 1, '1', '2022-11-10', 'Supervisor', '10', '5', '2022-11-10 07:17:22', '2022-11-10 12:17:22', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, '8', '17', 1, '1', '23-11-2022', 'Sale Person', '6', '3', '2022-11-23 10:30:56', '2022-11-23 15:30:56', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, '1', '17', 1, '3', '10-03-2023', 'Supervisor', '20', '0', '2023-03-08 10:44:58', '2023-03-08 15:44:58', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `region_id` int(11) NOT NULL,
  `reg_user_id` int(11) DEFAULT NULL,
  `reg_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_created_at` timestamp NULL DEFAULT current_timestamp(),
  `reg_updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `reg_user_id`, `reg_name`, `reg_remarks`, `reg_created_at`, `reg_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 8, 'Multan', NULL, '2023-02-13 07:49:31', '2023-02-13 12:49:31', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, 7, 'Mian wali', NULL, '2023-02-13 07:59:47', '2023-02-13 12:59:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, 7, 'Sindh', NULL, '2023-02-13 08:02:01', '2023-02-13 13:02:01', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, 11, 'Punjab', NULL, '2023-03-01 10:45:25', '2023-03-01 15:45:25', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(6, 1, 'Sindhs', NULL, '2023-03-08 07:55:52', '2024-01-27 12:59:20', '::1', 'Windows 10', 'Chrome', 'Computer'),
(8, 1, 'sdf', NULL, '2024-01-27 08:00:56', '2024-01-27 13:00:56', '::1', 'Windows 10', 'Chrome', 'Computer'),
(9, 1, 'erw', NULL, '2024-01-27 08:03:49', '2024-01-27 13:03:49', '::1', 'Windows 10', 'Chrome', 'Computer'),
(10, 1, 'fsdf', NULL, '2024-01-27 08:07:25', '2024-01-27 13:07:25', '::1', 'Windows 10', 'Chrome', 'Computer'),
(11, 1, 'MM', NULL, '2024-01-27 08:07:31', '2024-01-27 13:07:31', '::1', 'Windows 10', 'Chrome', 'Computer'),
(12, 1, 'WEEE', NULL, '2024-01-27 08:08:58', '2024-01-27 13:08:58', '::1', 'Windows 10', 'Chrome', 'Computer'),
(13, 1, 'dfsdfdsf', NULL, '2024-01-27 08:14:59', '2024-01-27 13:14:59', '::1', 'Windows 10', 'Chrome', 'Computer'),
(14, 1, 'qw', NULL, '2024-01-27 08:15:06', '2024-01-27 13:15:06', '::1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `remarks_id` int(11) NOT NULL,
  `remarks_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_for_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_schedule_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_funnel_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_purposal_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_order_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_detail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_created_at` datetime DEFAULT NULL,
  `remarks_updated_at` datetime DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `reminder_id` int(11) NOT NULL,
  `reminder_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_for_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_schedule_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_funnel_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_purposal_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_order_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_created_at` datetime DEFAULT NULL,
  `reminder_updated_at` datetime DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`reminder_id`, `reminder_user_id`, `reminder_for_id`, `reminder_schedule_id`, `reminder_funnel_id`, `reminder_purposal_id`, `reminder_order_id`, `reminder_remarks`, `reminder_date`, `reminder_reason`, `reminder_created_at`, `reminder_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, '1', '1', NULL, NULL, '1', NULL, 'Check as soon as possible', '11/10/2022', NULL, '2022-11-10 13:04:24', '2022-11-10 13:04:24', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, '1', '1', '2', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-11 12:36:30', '2022-11-11 12:36:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, '1', '1', NULL, NULL, '3', NULL, NULL, '11/12/2022', NULL, '2022-11-12 12:32:59', '2022-11-12 12:32:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(6, '1', '1', NULL, NULL, NULL, '3', 'khannn', '12/07/2022', NULL, '2022-12-07 15:58:18', '2022-12-07 15:58:18', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(5, '1', '1', NULL, NULL, NULL, '3', NULL, NULL, NULL, '2022-11-29 16:54:13', '2022-11-29 16:54:13', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(7, '1', '1', NULL, NULL, NULL, '4', NULL, NULL, NULL, '2022-12-07 15:58:26', '2022-12-07 15:58:26', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(8, '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:04:17', '2022-12-07 16:04:17', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(9, '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:06:07', '2022-12-07 16:06:07', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(10, '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:10:45', '2022-12-07 16:10:45', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(11, '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:10:59', '2022-12-07 16:10:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(12, '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:11:30', '2022-12-07 16:11:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(13, '1', '1', '2', NULL, NULL, NULL, 'zxcx', '07-12-2022', NULL, '2022-12-07 16:13:32', '2022-12-07 16:13:32', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(14, '1', '1', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:20:15', '2022-12-07 16:20:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(15, '1', '1', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:20:35', '2022-12-07 16:20:35', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(16, '1', '1', NULL, NULL, '15', NULL, NULL, NULL, NULL, '2022-12-07 16:21:27', '2022-12-07 16:21:27', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(17, '1', '1', NULL, NULL, NULL, '3', NULL, NULL, NULL, '2022-12-07 16:38:34', '2022-12-07 16:38:34', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(18, '1', '1', NULL, NULL, NULL, '4', 'kiczxs', '12/07/2022', NULL, '2022-12-07 16:38:58', '2022-12-07 16:38:58', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Supervisor', 'web', '2023-03-08 05:57:44', '2023-03-08 05:57:44'),
(2, 'Sale Person', 'web', '2023-03-08 05:57:55', '2023-03-08 05:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(67, 2),
(68, 1),
(68, 2),
(69, 1),
(69, 2),
(70, 1),
(70, 2),
(75, 1),
(75, 2),
(76, 1),
(76, 2),
(77, 1),
(77, 2),
(78, 1),
(78, 2),
(79, 1),
(79, 2),
(80, 1),
(80, 2),
(81, 1),
(81, 2),
(82, 1),
(82, 2),
(83, 1),
(83, 2),
(84, 1),
(84, 2),
(85, 1),
(86, 1),
(86, 2),
(87, 1),
(87, 2),
(88, 1),
(88, 2),
(89, 1),
(89, 2),
(90, 1),
(90, 2),
(91, 1),
(91, 2),
(92, 1),
(92, 2),
(93, 1),
(93, 2),
(94, 1),
(94, 2),
(95, 1),
(95, 2),
(96, 1),
(96, 2),
(97, 1),
(97, 2),
(98, 1),
(98, 2),
(99, 1),
(99, 2),
(100, 1),
(100, 2),
(101, 1),
(101, 2),
(102, 1),
(102, 2),
(103, 1),
(103, 2),
(104, 1),
(104, 2),
(105, 1),
(105, 2),
(106, 1),
(106, 2),
(107, 1),
(107, 2),
(108, 1),
(108, 2),
(109, 1),
(109, 2),
(110, 1),
(110, 2),
(111, 1),
(111, 2),
(112, 1),
(112, 2),
(113, 1),
(113, 2),
(114, 1),
(114, 2),
(115, 1),
(115, 2),
(116, 1),
(116, 2),
(117, 1),
(117, 2),
(118, 1),
(118, 2),
(119, 1),
(119, 2),
(120, 1),
(120, 2),
(121, 1),
(121, 2),
(122, 1),
(122, 2),
(123, 1),
(123, 2),
(124, 1),
(124, 2),
(125, 1),
(125, 2),
(126, 1),
(126, 2),
(127, 1),
(127, 2),
(128, 1),
(128, 2),
(129, 1),
(129, 2),
(130, 1),
(130, 2),
(131, 1),
(131, 2),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(136, 2),
(137, 1),
(137, 2),
(138, 1),
(138, 2),
(139, 1),
(139, 2),
(140, 1),
(141, 1),
(142, 1),
(144, 1),
(144, 2),
(147, 1),
(147, 2),
(148, 1),
(148, 2),
(149, 1),
(149, 2),
(150, 1),
(150, 2),
(151, 1),
(151, 2),
(152, 1),
(152, 2),
(153, 1),
(153, 2),
(154, 1),
(155, 1),
(155, 2),
(156, 1),
(156, 2),
(159, 1),
(159, 2),
(160, 1),
(160, 2),
(162, 1),
(163, 1),
(164, 1),
(164, 2),
(165, 1),
(165, 2),
(166, 1),
(166, 2),
(167, 1),
(167, 2),
(168, 1),
(168, 2),
(169, 1),
(169, 2),
(170, 1),
(170, 2),
(171, 1),
(171, 2),
(172, 1),
(172, 2),
(173, 1),
(173, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoice`
--

CREATE TABLE `sale_invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `sale` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_invoice`
--

INSERT INTO `sale_invoice` (`id`, `user_id`, `inv_id`, `category_id`, `product_id`, `qty`, `sale`, `total_amount`, `payment_type`, `date`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 1, 1, '1', '1', 13, 150, 1950, 'OTC', NULL, '2023-04-08 07:55:47', '2023-04-08 07:55:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, 1, 1, '4', '4', 1, 580, 580, 'OTC', NULL, '2023-04-08 07:55:47', '2023-04-08 07:55:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, 1, 2, '1', '1', 1, 150, 150, 'OTC', NULL, '2023-04-08 07:56:30', '2023-04-08 07:56:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, 1, 2, '2', '2', 13, 200, 2600, 'OTC', NULL, '2023-04-08 07:56:30', '2023-04-08 07:56:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(5, 1, 3, '1', '1', 13, 150, 1950, 'OTC', NULL, '2023-04-08 09:40:48', '2023-04-08 09:40:48', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(6, 1, 3, '2', '2', 13, 200, 2600, 'OTC', NULL, '2023-04-08 09:40:48', '2023-04-08 09:40:48', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(7, 1, 4, '1', '1', 18, 150, 2700, 'OTC', NULL, '2023-04-08 09:41:05', '2023-04-08 09:41:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(8, 1, 4, '2', '2', 13, 200, 2600, 'OTC', NULL, '2023-04-08 09:41:05', '2023-04-08 09:41:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(20, 1, 10, '4', '4', 1, 580, 580, 'OTC', NULL, '2024-01-27 07:39:08', '2024-01-27 07:39:08', '::1', 'Windows 10', 'Chrome', 'Computer'),
(19, 1, 10, '2', '2', 1, 200, 200, 'OTC', NULL, '2024-01-27 07:39:08', '2024-01-27 07:39:08', '::1', 'Windows 10', 'Chrome', 'Computer'),
(11, 1, 6, '1', '1', 13, 150, 1950, 'OTC', NULL, '2023-04-08 09:46:21', '2023-04-08 09:46:21', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(12, 1, 6, '4', '4', 187, 580, 108460, 'OTC', NULL, '2023-04-08 09:46:21', '2023-04-08 09:46:21', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(13, 1, 7, '1', '1', 13, 150, 1950, 'OTC', NULL, '2023-04-08 09:47:05', '2023-04-08 09:47:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(14, 1, 7, '4', '4', 17, 580, 9860, 'OTC', NULL, '2023-04-08 09:47:05', '2023-04-08 09:47:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(15, 1, 8, '1', '1', 13, 150, 1950, 'OTC', NULL, '2023-04-08 09:53:15', '2023-04-08 09:53:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(16, 1, 8, '4', '4', 1, 580, 580, 'OTC', NULL, '2023-04-08 09:53:15', '2023-04-08 09:53:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(17, 1, 8, '2', '2', 13, 200, 2600, 'OTC', NULL, '2023-04-08 09:53:15', '2023-04-08 09:53:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(18, 1, 9, '2', '2', 1, 200, 200, 'OTC', NULL, '2024-01-27 07:18:24', '2024-01-27 07:18:24', '::1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `type_of_visit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sch_remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sch_reminder_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `user_id`, `date`, `company_id`, `type_of_visit`, `sch_remarks`, `schedule_status`, `sch_reminder_reason`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 1, '26-11-2022', 1, '2', 'Tough Situations', 'new', NULL, '2022-11-10 08:01:15', '2024-01-27 06:59:56', '::1', 'Windows 10', 'Chrome', 'Computer'),
(2, 1, '26-11-2022', 4, '1', NULL, 'new', NULL, '2022-11-11 07:35:14', '2022-11-26 08:10:19', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, 1, '03-04-2023', 1, '1', NULL, 'reSchedule', NULL, '2023-04-03 07:15:52', '2023-04-03 07:15:52', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_target`
--

CREATE TABLE `schedule_target` (
  `sch_target_id` int(11) NOT NULL,
  `sch_target_your_manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sch_target_user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sch_target_by` int(11) DEFAULT NULL,
  `sch_target_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sch_target_role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sch_target_business_category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sch_target_total_visits` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sch_target_min_new_visits` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sch_target_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sch_target_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_target`
--

INSERT INTO `schedule_target` (`sch_target_id`, `sch_target_your_manager`, `sch_target_user_id`, `sch_target_by`, `sch_target_date`, `sch_target_role`, `sch_target_business_category_id`, `sch_target_total_visits`, `sch_target_min_new_visits`, `sch_target_created_at`, `sch_target_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, '1', '5', 1, '2022-11-09', 'Supervisor', '1', '5', '5', '2022-11-09 11:07:18', '2022-11-09 16:07:18', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, '7', '10', 1, '2022-11-10', 'Sale Person', '5', '3', '2', '2022-11-10 07:16:31', '2022-11-10 12:16:31', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, '1', '5', 1, '23-11-2022', 'Supervisor', '2', '1', '1', '2022-11-23 10:30:07', '2022-11-23 15:30:07', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, '1', '7', 1, '25-11-2022', 'Supervisor', '1', '156', '104', '2022-11-25 07:15:45', '2022-11-25 12:15:45', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(5, '5', '17', 1, '25-11-2022', 'Sale Person', '5', '156', '104', '2022-11-25 07:19:08', '2022-11-25 12:19:08', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(6, '5', '17', 1, '25-11-2022', 'Sale Person', '4', '200', '100', '2022-11-25 07:43:43', '2022-11-25 12:43:43', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(7, '1', '17', 1, '08-03-2023', 'Supervisor', '1', '25', '15', '2023-03-08 10:44:10', '2023-03-08 15:44:10', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `sector_id` int(11) NOT NULL,
  `sec_region_id` int(11) DEFAULT NULL,
  `sec_area_id` int(11) DEFAULT NULL,
  `sec_user_id` int(11) DEFAULT NULL,
  `sec_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sec_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sec_created_at` timestamp NULL DEFAULT current_timestamp(),
  `sec_updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`sector_id`, `sec_region_id`, `sec_area_id`, `sec_user_id`, `sec_name`, `sec_remarks`, `sec_created_at`, `sec_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 1, 1, 8, 'Chungi No.9', NULL, '2023-02-13 07:50:16', '2023-02-13 12:50:16', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, NULL, NULL, 7, 'F-Block', NULL, '2023-02-13 08:00:24', '2023-02-13 13:00:24', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, 3, 3, 7, 'Kahan Velly', NULL, '2023-02-13 08:03:01', '2023-02-13 13:03:01', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, 4, 4, 11, 'Shah Rukn-e-Alam', NULL, '2023-03-01 10:46:02', '2023-03-01 15:46:02', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(6, 6, 6, 1, 'korangi', NULL, '2023-03-08 08:00:02', '2023-03-08 13:00:02', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(7, 9, 9, 1, 'sdfsdfsdfsdfsdffsdf', NULL, '2024-01-27 08:04:04', '2024-01-27 13:04:04', '::1', 'Windows 10', 'Chrome', 'Computer'),
(9, NULL, NULL, 1, 'sdfsdf', NULL, '2024-01-27 08:17:54', '2024-01-27 13:17:54', '::1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `sta_id` bigint(20) NOT NULL,
  `sta_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`sta_id`, `sta_status`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 'Active', '2023-03-08 10:50:35', '2023-03-08 10:50:35', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, 'Deactive', '2023-03-08 10:50:45', '2023-03-08 10:50:45', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `term_and_condition`
--

CREATE TABLE `term_and_condition` (
  `tandc_id` int(11) NOT NULL,
  `tandc_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tandc_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tandc_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tandc_updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tandc_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_and_condition`
--

INSERT INTO `term_and_condition` (`tandc_id`, `tandc_title`, `tandc_description`, `tandc_created_at`, `tandc_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `tandc_user_id`) VALUES
(1, 'Price', '<p>Dont LOck</p>', '2022-11-09 10:41:33', '2022-11-09 10:41:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '1'),
(2, 'Privacy Policy of OIL', '<p style=\"text-align: center;\">This is oil</p>', '2022-11-10 07:15:16', '2022-11-18 05:36:52', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '1'),
(5, 'services', '<p style=\"text-align: center;\"><strong>Services</strong></p>\r\n<ul>\r\n<li>full of cart</li>\r\n<li>smiley face</li>\r\n</ul>', '2022-11-30 07:07:40', '2022-11-30 07:07:40', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '1');

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE `testing` (
  `testing_id` int(11) NOT NULL,
  `testing_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE `town` (
  `town_id` int(11) NOT NULL,
  `town_region_id` int(11) DEFAULT NULL,
  `town_area_id` int(11) DEFAULT NULL,
  `town_sector_id` int(11) DEFAULT NULL,
  `town_user_id` int(11) DEFAULT NULL,
  `town_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town_created_at` timestamp NULL DEFAULT current_timestamp(),
  `town_updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `town`
--

INSERT INTO `town` (`town_id`, `town_region_id`, `town_area_id`, `town_sector_id`, `town_user_id`, `town_name`, `town_remarks`, `town_created_at`, `town_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 1, 1, 1, 8, 'hashim Colony', NULL, '2023-02-13 07:50:34', '2023-02-13 12:50:34', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(2, 2, 2, 2, 7, 'Plaza', NULL, '2023-02-13 08:00:39', '2023-02-13 13:00:39', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(3, 3, 3, 3, 7, 'Dolat Town', NULL, '2023-02-13 08:03:21', '2023-02-13 13:03:21', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, 4, 4, 3, 11, 'F-block', NULL, '2023-03-01 10:46:12', '2023-03-01 15:46:12', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(5, 6, 6, 6, 1, 'New Karachiii', NULL, '2023-03-08 08:02:10', '2023-03-08 13:02:10', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(7, 14, 11, 9, 1, 'ERT', NULL, '2024-01-27 08:18:19', '2024-01-27 13:18:19', '::1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_user_id` int(11) DEFAULT NULL,
  `unit_main_unit_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_scale_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_created_at` timestamp NULL DEFAULT current_timestamp(),
  `unit_updated_at` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_user_id`, `unit_main_unit_id`, `unit_name`, `unit_scale_size`, `unit_remarks`, `ip_address`, `os_name`, `browser`, `device`, `unit_created_at`, `unit_updated_at`) VALUES
(1, 1, '1', 'Peice', NULL, NULL, '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-08 07:14:19', '2023-04-08 12:14:19'),
(2, 1, '2', 'Kg', NULL, NULL, '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-08 07:14:29', '2023-04-08 12:14:29'),
(3, 1, '1', 'WED', NULL, NULL, '::1', 'Windows 10', 'Chrome', 'Computer', '2024-01-27 08:30:58', '2024-01-27 13:30:58'),
(4, 1, '1', 'WED', NULL, NULL, '::1', 'Windows 10', 'Chrome', 'Computer', '2024-01-27 08:31:03', '2024-01-27 13:31:03'),
(5, 1, '1', 'WED', NULL, NULL, '::1', 'Windows 10', 'Chrome', 'Computer', '2024-01-27 08:31:03', '2024-01-27 13:31:03'),
(6, 1, '1', 'WED', NULL, NULL, '::1', 'Windows 10', 'Chrome', 'Computer', '2024-01-27 08:31:03', '2024-01-27 13:31:03'),
(7, 1, '1', 'WED', NULL, NULL, '::1', 'Windows 10', 'Chrome', 'Computer', '2024-01-27 08:31:03', '2024-01-27 13:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `upload_video`
--

CREATE TABLE `upload_video` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` int(11) DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mob` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modular_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `user_status` int(11) DEFAULT 1,
  `f_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doj` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `supervisor`, `role`, `email`, `username`, `mob`, `address`, `image`, `password`, `modular_group`, `email_verified_at`, `user_status`, `f_name`, `cnic`, `doj`, `emergency_contact`, `remember_token`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 'Admin', 1, 'Admin', 'admin@gmail.com', 'admin123', '554477441', 'multan', 'cartoon_1669201935.png', '$2y$10$5Fzv.IUoK0U7yrwSe0vLAOYxtojTPt0sL7CaFwFWqeHdDp8PyPLU.', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2023-02-02 07:51:11', '2023-02-02 12:51:11', '124.29.212.148', 'Windows 10', 'Chrome', 'Computer'),
(2, 'Tele Caller', 1, 'Tele Caller', 'telecaller@gmail.com', 'telecaller123', '2342380923', 'multan', 'no_image.jpg', '$2y$10$5Fzv.IUoK0U7yrwSe0vLAOYxtojTPt0sL7CaFwFWqeHdDp8PyPLU.', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2023-02-02 07:53:51', '2023-02-02 12:53:51', NULL, NULL, NULL, NULL),
(3, 'Price Manager', 1, 'Price Manager', 'pricemanager@gmail.com', 'pricemanager123', '2342380923', 'multan', 'no_image.jpg', '$2y$10$5Fzv.IUoK0U7yrwSe0vLAOYxtojTPt0sL7CaFwFWqeHdDp8PyPLU.', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2023-02-02 07:56:04', '2023-02-02 12:56:04', NULL, NULL, NULL, NULL),
(17, 'intizar', 1, 'Supervisor', 'intizar@gmail.com', 'intizar123', '03132587454', 'sdfasdfsdffsdfsdfsdfsdfsdfsdfsdfsd', 'cartoon_1678274815.png', '$2y$10$5Fzv.IUoK0U7yrwSe0vLAOYxtojTPt0sL7CaFwFWqeHdDp8PyPLU.', '1', NULL, 1, 'raes', '3810147454741', '08-03-2023', '031325474121', NULL, '2023-03-08 11:26:59', '2023-03-08 16:26:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL,
  `user_role_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_line_manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_created_at` timestamp NULL DEFAULT current_timestamp(),
  `user_role_updated_at` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visit_type`
--

CREATE TABLE `visit_type` (
  `visit_type_id` int(11) NOT NULL,
  `visit_type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_type_user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_type_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `visit_type_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visit_type`
--

INSERT INTO `visit_type` (`visit_type_id`, `visit_type_name`, `visit_type_user_id`, `visit_type_created_at`, `visit_type_updated_at`, `ip_address`, `os_name`, `browser`, `device`) VALUES
(1, 'Showns', '1', '2023-02-09 09:33:50', '2024-01-27 13:27:59', '::1', 'Windows 10', 'Chrome', 'Computer'),
(2, 'Show', '5', '2023-02-09 09:33:57', '2023-02-09 14:33:57', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer'),
(4, 'sdf', '1', '2024-01-27 08:27:27', '2024-01-27 13:27:27', '::1', 'Windows 10', 'Chrome', 'Computer');

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `business_category`
--
ALTER TABLE `business_category`
  ADD PRIMARY KEY (`business_category_id`);

--
-- Indexes for table `business_profile`
--
ALTER TABLE `business_profile`
  ADD PRIMARY KEY (`business_profile_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `cat_product_grp`
--
ALTER TABLE `cat_product_grp`
  ADD PRIMARY KEY (`cat_product_grp_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_poc_profile`
--
ALTER TABLE `company_poc_profile`
  ADD PRIMARY KEY (`com_poc_profile_id`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`comprofile_id`);

--
-- Indexes for table `expiry_days`
--
ALTER TABLE `expiry_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funnel`
--
ALTER TABLE `funnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funnel_target`
--
ALTER TABLE `funnel_target`
  ADD PRIMARY KEY (`funnel_target_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_unit`
--
ALTER TABLE `main_unit`
  ADD PRIMARY KEY (`main_unit_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_purposal`
--
ALTER TABLE `order_purposal`
  ADD PRIMARY KEY (`order_purposal_id`);

--
-- Indexes for table `order_target`
--
ALTER TABLE `order_target`
  ADD PRIMARY KEY (`order_target_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_group`
--
ALTER TABLE `product_group`
  ADD PRIMARY KEY (`product_group_id`);

--
-- Indexes for table `product_group_target`
--
ALTER TABLE `product_group_target`
  ADD PRIMARY KEY (`product_group_target_id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`product_price_id`);

--
-- Indexes for table `quotations_approval`
--
ALTER TABLE `quotations_approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_target`
--
ALTER TABLE `quotation_target`
  ADD PRIMARY KEY (`quotation_target_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`remarks_id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`reminder_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_target`
--
ALTER TABLE `schedule_target`
  ADD PRIMARY KEY (`sch_target_id`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`sector_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`sta_id`);

--
-- Indexes for table `term_and_condition`
--
ALTER TABLE `term_and_condition`
  ADD PRIMARY KEY (`tandc_id`);

--
-- Indexes for table `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`testing_id`);

--
-- Indexes for table `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`town_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `upload_video`
--
ALTER TABLE `upload_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indexes for table `visit_type`
--
ALTER TABLE `visit_type`
  ADD PRIMARY KEY (`visit_type_id`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `business_category`
--
ALTER TABLE `business_category`
  MODIFY `business_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `business_profile`
--
ALTER TABLE `business_profile`
  MODIFY `business_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cat_product_grp`
--
ALTER TABLE `cat_product_grp`
  MODIFY `cat_product_grp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `company_poc_profile`
--
ALTER TABLE `company_poc_profile`
  MODIFY `com_poc_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `comprofile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expiry_days`
--
ALTER TABLE `expiry_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `funnel`
--
ALTER TABLE `funnel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `funnel_target`
--
ALTER TABLE `funnel_target`
  MODIFY `funnel_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `main_unit`
--
ALTER TABLE `main_unit`
  MODIFY `main_unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_purposal`
--
ALTER TABLE `order_purposal`
  MODIFY `order_purposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_target`
--
ALTER TABLE `order_target`
  MODIFY `order_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_group`
--
ALTER TABLE `product_group`
  MODIFY `product_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_group_target`
--
ALTER TABLE `product_group_target`
  MODIFY `product_group_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `product_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quotations_approval`
--
ALTER TABLE `quotations_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quotation_target`
--
ALTER TABLE `quotation_target`
  MODIFY `quotation_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `remarks_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule_target`
--
ALTER TABLE `schedule_target`
  MODIFY `sch_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `sta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `term_and_condition`
--
ALTER TABLE `term_and_condition`
  MODIFY `tandc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `testing`
--
ALTER TABLE `testing`
  MODIFY `testing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `town_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `upload_video`
--
ALTER TABLE `upload_video`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visit_type`
--
ALTER TABLE `visit_type`
  MODIFY `visit_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
