-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 11:43 AM
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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `area_region_id`, `area_user_id`, `area_name`, `area_remarks`, `area_created_at`, `area_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `area_company_id`) VALUES
(1, '1', 3, 'Khan Plaza', NULL, '2023-02-13 07:49:47', '2023-02-13 12:49:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, '2', 3, 'Hasil Pur', NULL, '2023-02-13 08:00:09', '2023-02-13 13:00:09', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, '3', 3, 'Darya khan', NULL, '2023-02-13 08:02:43', '2023-02-13 13:02:43', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, '4', 3, 'Multan', NULL, '2023-03-01 10:45:38', '2023-03-01 15:45:38', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, '6', 3, 'Karachi', NULL, '2023-03-08 07:57:47', '2023-03-08 12:57:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, '6', 3, 'sdfsdf', NULL, '2024-01-27 07:58:12', '2024-01-27 12:58:12', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(9, '8', 3, 'eeee', NULL, '2024-01-27 08:03:56', '2024-01-27 13:03:56', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(10, '11', 3, 'sdfasdfasd', NULL, '2024-01-27 08:07:42', '2024-01-27 13:07:42', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(11, '14', 3, 'QWS', NULL, '2024-01-27 08:17:44', '2024-01-27 13:17:44', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(13, '1', 3, 'WES', NULL, '2024-03-15 10:01:17', '2024-03-15 15:01:17', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(14, '18', 3, 'QWAS', NULL, '2024-03-15 10:52:40', '2024-03-15 15:52:40', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(15, '19', 3, 'sdsfdfdssss', NULL, '2024-03-15 10:55:05', '2024-03-15 15:55:05', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(16, '19', 3, 'wwwww', NULL, '2024-03-15 10:56:15', '2024-03-15 15:56:15', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(17, '20', 4, 'erere', NULL, '2024-03-25 09:40:41', '2024-03-25 14:40:41', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_category_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_category`
--

INSERT INTO `business_category` (`business_category_id`, `business_category_user_id`, `business_category_name`, `business_category_created_at`, `business_category_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `business_category_company_id`) VALUES
(1, '3', 'Camera', '2023-02-27 12:49:18', '2023-02-13 12:49:18', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, '3', 'LED TV', '2023-02-28 12:35:20', '2023-03-08 12:35:20', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, '3', 'Electronics', '2023-02-25 15:37:13', '2023-03-09 15:37:13', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, '3', 'CCTV', '2023-03-09 15:37:36', '2023-03-09 15:37:36', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, '3', 'Water Supply', '2023-03-09 15:44:48', '2023-03-09 15:44:48', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, '3', 'Watches', '2023-03-09 15:45:01', '2023-03-09 15:45:01', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(10, '4', 'QSAWA', '2024-03-25 14:41:46', '2024-03-25 14:41:46', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(11, '4', 'QASWA', '2024-03-26 13:14:30', '2024-03-26 13:14:30', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_profile_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_profile`
--

INSERT INTO `business_profile` (`business_profile_id`, `business_profile_logo`, `business_profile_name`, `business_profile_address`, `business_profile_ntn_no`, `business_profile_gst_no`, `business_profile_mobile_no`, `business_profile_ptcl_no`, `business_profile_email`, `business_profile_web_address`, `business_profile_created_at`, `business_profile_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `business_profile_company_id`) VALUES
(1, 'car_1710579416.png', 'SoftagicsSales', 'sdfsdfsdfsdf', '4555454545', '54555888888888', '44444444444', '454554545455', 'sadmin2@gmail.com', '5455', '2024-03-16 08:56:56', '2024-03-16 13:56:56', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `cat_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_user_id`, `cat_product_group_id`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `cat_category`, `category_company_id`) VALUES
(1, 3, '1', '2023-04-08 07:15:34', '2023-04-08 07:15:34', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 'Camera', 1),
(2, 3, '2', '2023-04-08 07:15:59', '2023-04-08 07:15:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 'LCD', 1),
(3, 3, '2', '2023-04-08 07:15:59', '2023-04-08 07:15:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 'Laptop', 1),
(4, 3, '2', '2023-04-08 07:16:00', '2023-04-08 07:16:00', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 'Keyborad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_product_grp`
--

CREATE TABLE `cat_product_grp` (
  `cat_product_grp_id` int(11) NOT NULL,
  `product_cat_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_grp_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_product_grp_company_id` int(11) DEFAULT NULL
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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `user_id`, `business_category_id`, `com_region_id`, `com_sector_id`, `com_area_id`, `com_town_id`, `company_name`, `comp_ptcl`, `comp_address`, `comp_mobile_no`, `comp_whatsapp_no`, `comp_email`, `comp_status`, `map_coordinate`, `comp_webaddress`, `comp_remarks`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `company_company_id`) VALUES
(1, 3, 1, '1', '1', '1', '1', 'khan Printers', '0313254145', 'khan Printers', '03132547415', '031325474545', 'khanprinters@gmailcom', '0', '30.200867939719867, 71.53845013338103', 'khanPrinters.com', NULL, '2023-02-20 12:31:38', '2023-02-22 08:08:11', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, 3, 1, '1', '1', '1', '1', 'green T & D', '03132541244', 'sdadfsasdffd', '0313254741', '0313254741', 'greent&d@gmail.com', '1', '30.18439845902759, 71.53402985299549', 'greent&d.com', NULL, '2023-02-24 11:40:09', '2023-02-24 11:40:09', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, 3, 1, '1', '1', '1', '1', 'assus', '0212145474', 'sfasdfasdfasdfasdfasdf', '03132541211', '03132541211', 'assus@gmail.com', '1', '30.18818223207812, 71.51038349869997', 'assus.com', NULL, '2023-02-27 07:44:34', '2023-02-27 07:44:34', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, 3, 1, '4', '4', '4', '1', 'Fahad Printers', '3133332112', 'SDAFSDFASDFASDF', '03132254141', '03132254141', 'fahad@gmail.com', '1', '30.208798359424268, 71.47565200445908', 'fahadprinters.comq', NULL, '2023-03-01 10:47:44', '2023-03-01 10:47:44', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, 3, 1, '6', '6', '6', '5', 'Raes', '1235641422', 'Raes', '03125478541', '03125478541', 'raes@gmail.com', '0', '30.16074549058018, 71.50264573535604', 'raes.com', NULL, '2023-03-08 09:33:10', '2023-03-09 06:04:19', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, 3, 4, '1', '1', '1', '1', 'Ewas', '15155515151', 'sdfdsfsdf', '45444444444', '45444444444', 'sdfsdf@w', NULL, '8888888888888888888888', 'asdfasdf', 'asdfsadffff', '2024-01-26 08:00:06', '2024-01-26 12:33:55', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, 4, 1, '1', '2', '1', '4', 'czxczxcs', '888888888888', 'czxczxcxdfxzcxcvzxcv', '888888888888', '888888888888', 'xcvzxcv@w', NULL, '8888888888888888888', 'zCXZXc', NULL, '2024-01-26 12:01:30', '2024-01-26 12:34:58', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(8, 4, 2, '1', '1', '1', '1', 'dfsdsf', '00000055555', 'SDFDFSF', '1111111111111', '1111111111111', 'WS@W', NULL, '999999999999988888', 'sdfdf', NULL, '2024-01-27 06:21:25', '2024-01-27 06:21:25', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(12, 5, 10, '20', '13', '17', '9', 'Asfar', '87878787878', 'sdfasdfsdf', '1111111111111', '1111111111111', 'esew@gmail.com', NULL, '30.19043986782512, 71.50524642883614', 'sdfads', NULL, '2024-03-25 09:43:04', '2024-03-25 09:43:04', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(11, 3, 2, '1', '1', '1', '1', 'CSP', '5545464555', 'asdfasdf77', '03213313118', '03213313118', 'csp@csp.pk', NULL, '123125sdfasd4fsd45fsdf', 'csp.pk', 'asdf', '2024-03-11 07:06:17', '2024-03-11 07:08:37', '::1', 'Windows 10', 'Chrome', 'Computer', 2),
(13, 4, 10, '20', '13', '17', '9', 'wewsa', '87878787878', 'sfdafasdfsdf', '03131454545', '03131454545', 'fare!@w', NULL, '30.19043986782512, 71.50524642883614', 'asdffds', NULL, '2024-03-25 09:45:54', '2024-03-25 09:45:54', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_poc_profile_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_poc_profile`
--

INSERT INTO `company_poc_profile` (`com_poc_profile_id`, `com_poc_profile_user_id`, `com_poc_profile_name`, `com_poc_profile_company_id`, `com_poc_profile_designation`, `com_poc_profile_mobile_no`, `com_poc_profile_whatsapp_no`, `com_poc_profile_email`, `com_poc_profile_status`, `com_poc_profile_address`, `com_poc_profile_created_at`, `com_poc_profile_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `company_poc_profile_company_id`) VALUES
(1, '3', 'Khan SahaB', '1', '1', '031325414755', '031325414755', 'khan@gmail.coM', '1', NULL, '2023-02-22 08:27:14', '2023-02-24 13:14:53', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, '3', 'Sham Idrees', '2', '1', '03132541475', '03132541475', 'shamidreees@gmail.com', '0', NULL, '2023-02-24 11:23:07', '2023-03-09 11:29:08', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, '3', 'Hasham', '2', '1', '031230254745', '031230254745', 'hasham@gmail.com', '1', NULL, '2023-03-10 11:23:59', '2023-03-10 16:23:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, '3', 'arshad', '4', '1', '031325414745', '031325414745', 'arshad@gmail.com', '1', NULL, '2023-03-01 10:48:15', '2023-03-01 15:48:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, '3', 'asad', '7', '1', '000000000', '000000000', 'sadfasd@w', NULL, NULL, '2024-01-26 08:01:49', '2024-01-26 18:43:50', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(8, '3', 'Aswe', NULL, '1', '0000', '0000', 'far@w', NULL, NULL, '2024-01-26 12:44:54', '2024-01-26 18:12:59', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(9, '3', 'sss', '2', '1', '77777777777', '77777777777', 'erw@w', NULL, NULL, '2024-01-27 06:19:06', '2024-01-27 11:19:06', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(11, '3', 'fredric', '2', '3', '4545454545454', '4545454545454', 'fgfgg@gmail.com', NULL, NULL, '2024-02-26 11:34:57', '2024-02-26 16:34:57', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(13, '4', 'WES', '8', '5', '03132541212', '03132541212', 'Wes@we', '1', NULL, '2024-03-25 10:37:51', '2024-03-25 15:55:40', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_profile_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`comprofile_id`, `comprofile_user_id`, `comprofile_company_id`, `comprofile_name`, `comprofile_ptcl`, `comprofile_address`, `comprofile_mobile_no`, `comprofile_whatsapp_no`, `comprofile_email`, `comprofile_status`, `comprofile_web_address`, `comprofile_created_at`, `comprofile_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `company_profile_company_id`) VALUES
(1, '1', '1', NULL, '0313241472', 'sdfsdfdfdsfsdfsdfasdf', '0313251474', '0313251474', 'krfi@gmail.com', '1', 'rfi.com', '2023-02-16 16:46:53', '2023-02-16 16:46:53', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `designation_updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_title`, `designation_created_at`, `designation_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `designation_user_id`, `designation_company_id`) VALUES
(1, 'Marketer', '2024-02-26 09:00:21', '2024-02-26 11:03:46', '::1', 'Windows 10', 'Chrome', 'Computer', '3', 1),
(5, 'sawa', '2024-03-25 10:20:16', '2024-03-25 10:27:33', '::1', 'Windows 10', 'Chrome', 'Computer', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expiry_days`
--

CREATE TABLE `expiry_days` (
  `id` int(11) NOT NULL,
  `days` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiry_days_company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expiry_days`
--

INSERT INTO `expiry_days` (`id`, `days`, `updated_at`, `expiry_days_company_id`) VALUES
(1, '15', '2024-03-15 01:40:00', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funnel_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funnel`
--

INSERT INTO `funnel` (`id`, `user_id`, `date`, `company_id`, `category_id`, `mrc`, `status_remarks`, `cat_remarks`, `status_id`, `otc`, `funnel_reminder_reason`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `funnel_company_id`) VALUES
(1, 3, '2022-11-10', 1, '1', '77', 'An Active', NULL, 0, '4', NULL, '2022-11-10 08:02:24', '2024-01-27 07:06:32', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, 3, '2022-11-28', 1, '2', '120', NULL, NULL, 1, '1', NULL, '2022-11-28 09:18:24', '2022-11-28 09:18:24', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, 3, '13-02-2024', 3, '1,3', '8888', NULL, NULL, 1, '888', NULL, '2024-02-13 10:59:41', '2024-02-13 10:59:41', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, 3, '13-02-2024', 5, '3,4', '6', NULL, NULL, 1, '850', NULL, '2024-02-13 11:00:36', '2024-02-13 11:00:36', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(10, 4, '26-03-2024', 13, '1,3', '879', NULL, NULL, 1, '5820', NULL, '2024-03-26 08:02:19', '2024-03-26 08:02:19', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(8, 3, '12-03-2024', 2, '1,3', '879', NULL, NULL, 1, '879', NULL, '2024-03-12 08:41:19', '2024-03-12 08:41:19', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(11, 4, '26-03-2024', 7, '2,3', '78878', NULL, NULL, 1, '87887', NULL, '2024-03-26 08:19:19', '2024-03-26 08:19:19', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `funnel_target_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funnel_target`
--

INSERT INTO `funnel_target` (`funnel_target_id`, `funnel_target_your_manager`, `funnel_target_user_id`, `funnel_target_by`, `funnel_target_product_category`, `funnel_target_date`, `funnel_target_role`, `funnel_target_otc`, `funnel_target_mrc`, `funnel_target_created_at`, `funnel_target_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `funnel_target_company_id`) VALUES
(1, '3', '3', 3, '1', '2022-11-09', 'Supervisor', '2', '2', '2022-11-09 11:07:30', '2022-11-09 16:07:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, '3', '3', 3, '2', '2022-11-10', 'Supervisor', '2', '9', '2022-11-10 07:17:02', '2022-11-10 12:17:02', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, '3', '3', 3, '1', '23-11-2022', 'Sale Person', '2', '4', '2022-11-23 10:30:30', '2022-11-23 15:30:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, '3', '3', 3, '1', '08-03-2023', 'Supervisor', '20', '0', '2023-03-08 10:44:38', '2023-03-08 15:44:38', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, '3', '4', 3, '3', '16-03-2024', 'Sale Person', '4545', '555', '2024-03-16 08:57:57', '2024-03-16 13:57:57', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, '3', '4', 3, '1', '16-03-2024', 'Sale Person', '5444', '544', '2024-03-16 09:33:42', '2024-03-16 14:33:42', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, '3', '4', 3, '4', '18-03-2024', 'Sale Person', '7415', '7451', '2024-03-18 05:50:34', '2024-03-18 10:50:34', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(8, '3', '4', 3, '2', '18-03-2024', 'Sale Person', '74147', '5214', '2024-03-18 06:01:01', '2024-03-18 11:01:01', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groups_id` int(11) NOT NULL,
  `groups_user_id` int(11) DEFAULT NULL,
  `groups_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groups_users` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groups_created_at` timestamp NULL DEFAULT current_timestamp(),
  `groups_updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  `groups_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groups_id`, `groups_user_id`, `groups_name`, `groups_users`, `ip_address`, `os_name`, `browser`, `device`, `groups_created_at`, `groups_updated_at`, `groups_company_id`) VALUES
(4, 3, 'Regiter', '4', '::1', 'Windows 10', 'Chrome', 'Computer', '2024-03-20 08:24:36', '2024-03-20 13:24:36', 1),
(5, 3, 'EWDS', '4,6', '::1', 'Windows 10', 'Chrome', 'Computer', '2024-03-25 07:50:59', '2024-03-25 12:50:59', 1);

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
  `expiry_date` date DEFAULT NULL,
  `invoice_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_no`, `user_id`, `inv_date`, `company_id`, `grand_total`, `subject`, `tandc_id`, `unique_id`, `poc_id`, `version`, `link`, `version_use`, `invoice_reminder_reason`, `quotation_remarks`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `expiry_date`, `invoice_company_id`) VALUES
(1, 1, '3', '2023-04-08', 1, '2530', 'CCTV EXT', '1', '1-CCTV EXT-khan Printers', 1, 1, '2,4', NULL, NULL, 'sdffsdfd', '2023-04-08 07:55:47', '2023-04-08 07:55:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23', 1),
(2, 2, '3', '2023-04-08', 2, '2750', 'LCD', '1', '2-LCD-green T & D', 6, 1, '2,3', NULL, NULL, 'sdfsdfsdfsdf', '2023-04-08 07:56:30', '2023-04-08 07:56:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23', 1),
(3, 3, '3', '2023-04-08', 2, '4550', 'LCD', '1,2', '2-LCD-green T & D', 6, 2, '4', 1, NULL, 'fsdfsdf', '2023-04-08 09:40:48', '2023-04-08 09:40:48', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23', 1),
(4, 4, '3', '2023-04-08', 2, '5300', 'LCD', '2', '2-LCD-green T & D', 6, 3, NULL, 1, NULL, 'sfssfdfsd', '2023-04-08 09:41:05', '2023-04-08 09:41:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2024-02-11', 1),
(10, 10, '3', '2024-01-27', 1, '780', 'WSE', '2,5', '9-WSE-khan Printers', 1, 2, NULL, 1, NULL, 'sdfsdfsdf', '2024-01-27 07:39:07', '2024-01-27 07:39:07', '::1', 'Windows 10', 'Chrome', 'Computer', '2024-02-11', 1),
(6, 6, '3', '2023-04-08', 1, '110410', 'CCTV EXT', '1,2', '1-CCTV EXT-khan Printers', 1, 2, '3', 1, NULL, 'dfdsfsd', '2023-04-08 09:46:21', '2023-04-08 09:46:21', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23', 1),
(7, 7, '3', '2023-04-08', 1, '11810', 'CCTV EXT', '1', '1-CCTV EXT-khan Printers', 1, 3, NULL, 2, NULL, 'fssf', '2023-04-08 09:47:05', '2023-04-08 09:47:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23', 1),
(8, 8, '3', '2023-04-08', 1, '5130', 'CCTV EXT', '1,2', '1-CCTV EXT-khan Printers', 1, 4, NULL, 1, NULL, 'sdffsd', '2023-04-08 09:53:15', '2023-04-08 09:53:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-23', 1),
(9, 9, '3', '2024-01-27', 1, '200', 'WSE', '5', '9-WSE-khan Printers', 1, 1, '2', NULL, NULL, 'sdfsdfasdf', '2024-01-27 07:18:24', '2024-01-27 07:18:24', '::1', 'Windows 10', 'Chrome', 'Computer', '2024-02-11', 1),
(11, 11, '4', '2024-02-13', 1, '150', 'sdfdsfsdf', '1', '10-sdfdsfsdf-khan Printers', 1, 1, NULL, NULL, NULL, 'asdfsdfasdfdsf', '2024-02-13 12:28:53', '2024-02-13 12:28:53', '::1', 'Windows 10', 'Chrome', 'Computer', '2024-03-30', 1),
(14, 14, '4', '2024-03-27', 8, '1504', 'dfdf', '1,2,8', '12-dfdf-dfsdsf', 13, 1, '2,3', NULL, NULL, 'sdfsdfdsf', '2024-03-27 09:55:37', '2024-03-27 09:55:37', '::1', 'Windows 10', 'Chrome', 'Computer', '2024-04-11', 1),
(13, 13, '4', '2024-03-12', 2, '21548', 'sdf', '1', '11-sdf-green T & D', 6, 2, NULL, 1, NULL, 'sdfdf', '2024-03-12 10:39:23', '2024-03-12 10:39:23', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', '2024-03-22', 1),
(15, 15, '4', '2024-03-27', 8, '23052', 'dfdf', '1', '12-dfdf-dfsdsf', 13, 2, NULL, 1, NULL, 'sddfsd', '2024-03-27 10:04:09', '2024-03-27 10:04:09', '::1', 'Windows 10', 'Chrome', 'Computer', '2024-04-11', 1),
(16, 16, '4', '2024-03-27', 8, '23052', 'dfdf', '2', '12-dfdf-dfsdsf', 13, 3, NULL, 1, NULL, 'wewewe', '2024-03-27 10:04:53', '2024-03-27 10:04:53', '::1', 'Windows 10', 'Chrome', 'Computer', '2024-04-11', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_unit_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_unit`
--

INSERT INTO `main_unit` (`main_unit_id`, `main_unit_user_id`, `main_unit_name`, `main_unit_remarks`, `main_unit_created_at`, `main_unit_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `main_unit_company_id`) VALUES
(6, 3, 'barbans', NULL, '2024-03-16 07:16:36', '2024-03-16 12:16:36', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, 3, 'barban', NULL, '2024-03-16 07:16:30', '2024-03-16 12:16:30', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `messages_company_id` int(11) DEFAULT NULL
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
(1, 'App\\User', 2),
(1, 'App\\User', 17),
(1, 'App\\User', 18),
(2, 'App\\User', 3),
(2, 'App\\User', 4),
(2, 'App\\User', 19),
(3, 'App\\User', 3),
(4, 'App\\User', 5),
(4, 'App\\User', 6),
(9, 'App\\User', 20),
(10, 'App\\User', 22),
(11, 'App\\User', 24),
(12, 'App\\User', 26);

-- --------------------------------------------------------

--
-- Table structure for table `new_company`
--

CREATE TABLE `new_company` (
  `nc_id` int(11) NOT NULL,
  `nc_name` varchar(255) DEFAULT NULL,
  `nc_contact` varchar(255) DEFAULT NULL,
  `nc_created_at` timestamp NULL DEFAULT current_timestamp(),
  `nc_status` int(11) DEFAULT 1 COMMENT '1=Continue\r\n2=Discontinue'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new_company`
--

INSERT INTO `new_company` (`nc_id`, `nc_name`, `nc_contact`, `nc_created_at`, `nc_status`) VALUES
(1, 'SoftagicsSales', '44444444444', '2024-03-09 07:56:30', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `invoice_id`, `order_no`, `tandc_id`, `sale_date`, `company_id`, `grand_total`, `order_reminder_reason`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `order_company_id`) VALUES
(13, 3, '3', 8, '1', '01/27/2024', 1, '4550', NULL, '2024-01-27 07:53:43', '2024-01-27 07:53:43', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, 3, '2', 5, '1,2,5', '02/13/2023', 1, '270', NULL, '2023-02-13 12:50:55', '2023-02-13 12:50:55', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(14, 4, '2', 9, '1,2,5', '02/13/2024', 2, '2750', NULL, '2024-02-13 11:07:53', '2024-02-13 11:07:53', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(15, 4, '1', 10, '1', '03/27/2024', 10, '4480', NULL, '2024-03-27 10:37:19', '2024-03-27 10:37:19', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_purposal_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_purposal`
--

INSERT INTO `order_purposal` (`order_purposal_id`, `order_purposal_order_id`, `order_purposal_user_id`, `order_purposal_category_id`, `order_purposal_product_id`, `order_purposal_qty`, `order_purposal_sale`, `order_purposal_total_amount`, `order_purposal_pro_description`, `order_purposal_payment_type`, `order_purposal_date`, `order_purposal_created_at`, `order_purposal_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `order_purposal_company_id`) VALUES
(15, '13', '3', '2', '2', '13', '200', '2600', '<p>asdffsdafsd<strong>sdfasfd</strong></p>', 'OTC', '01/27/2024', '2024-01-27 07:53:43', '2024-01-27 12:53:43', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(14, '13', '3', '1', '1', '13', '150', '1950', '<ul>\r\n<li>sdfafsasdfsdffasdfsdfsdfasdf<strong>sdf</strong></li>\r\n</ul>', 'OTC', '01/27/2024', '2024-01-27 07:53:43', '2024-01-27 12:53:43', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(13, '12', '3', '4', '4', '1', '580', '580', '<p>dsffasfsdf<strong>asdffasd</strong></p>', 'OTC', '01/27/2024', '2024-01-27 07:53:18', '2024-01-27 12:53:18', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(17, '14', '4', '2', '2', '13', '200', '2600', '<p>asdffsdafsd<strong>sdfasfd</strong></p>', 'OTC', '02/13/2024', '2024-02-13 11:07:53', '2024-02-13 16:07:53', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(16, '14', '4', '1', '1', '1', '150', '150', '<ul>\r\n<li>sdfafsasdfsdffasdfsdfsdfasdf<strong>sdf</strong></li>\r\n</ul>', 'OTC', '02/13/2024', '2024-02-13 11:07:53', '2024-02-13 16:07:53', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(12, '12', '4', '1', '1', '13', '150', '1950', '<ul>\r\n<li>sdfafsasdfsdffasdfsdfsdfasdf<strong>sdf</strong></li>\r\n</ul>', 'OTC', '01/27/2024', '2024-01-27 07:53:18', '2024-01-27 12:53:18', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(18, '15', '4', '1', '1', '13', '1504', '1950', '<ul>\r\n<li>sdfafsasdfsdffasdfsdfsdfasdf<strong>sdf</strong></li>\r\n</ul>', 'OTC', '03/27/2024', '2024-03-27 10:37:19', '2024-03-27 15:37:19', '::1', 'Windows 10', 'Chrome', 'Computer', 3),
(19, '15', '4', '1', '1', '13', '850', '1950', '<ul>\r\n<li>sdfafsasdfsdffasdfsdfsdfasdf<strong>sdf</strong></li>\r\n</ul>', 'OTC', '03/27/2024', '2024-03-27 10:37:19', '2024-03-27 15:37:19', '::1', 'Windows 10', 'Chrome', 'Computer', 3),
(20, '15', '4', '4', '1', '1', '5804', '580', '<p>dsffasfsdf<strong>asdffasd</strong></p>', 'OTC', '03/27/2024', '2024-03-27 10:37:19', '2024-03-27 15:37:19', '::1', 'Windows 10', 'Chrome', 'Computer', 3);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_target_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_target`
--

INSERT INTO `order_target` (`order_target_id`, `order_target_your_manager`, `order_target_user_id`, `order_target_by`, `order_target_product_category`, `order_target_date`, `order_target_role`, `order_target_otc`, `order_target_mrc`, `order_target_created_at`, `order_target_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `order_target_company_id`) VALUES
(1, '3', '3', 3, '1', '09-03-2023', 'Supervisor', '22', '23', '2023-03-09 09:44:49', '2023-03-09 14:44:49', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, '3', '3', 3, '2', '09-03-2023', 'Supervisor', '33', '2', '2023-03-09 09:45:02', '2023-03-09 14:45:02', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, '3', '3', 3, '3', '09-03-2023', 'Supervisor', '23', '85', '2023-03-09 09:45:10', '2023-03-09 14:45:10', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, '3', '4', 3, '3', '16-03-2024', 'Sale Person', '454545554', '545455454', '2024-03-16 08:58:27', '2024-03-16 13:58:27', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, '3', '4', 3, '1', '18-03-2024', 'Sale Person', '987454', '85412', '2024-03-18 06:05:53', '2024-03-18 11:05:53', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
(173, 'deleteClientPoc', 'web', '2023-03-01 08:08:15', '2023-03-01 08:08:15'),
(174, 'create_designation', 'web', '2024-03-11 07:42:30', '2024-03-11 07:42:30'),
(175, 'storedesignation', 'web', '2024-03-11 07:42:30', '2024-03-11 07:42:30'),
(176, 'designation', 'web', '2024-03-11 07:45:01', '2024-03-11 07:45:01'),
(177, 'edit_designation', 'web', '2024-03-11 07:45:26', '2024-03-11 07:45:26'),
(178, 'update_designation', 'web', '2024-03-11 07:45:26', '2024-03-11 07:45:26'),
(179, 'deletedesignation', 'web', '2024-03-11 07:45:55', '2024-03-11 07:45:55'),
(180, 'product_price_update', 'web', '2024-03-11 07:42:30', '2024-03-11 07:42:30'),
(181, 'update_product_price', 'web', '2024-03-11 07:42:30', '2024-03-11 07:42:30'),
(185, 'completed_work', 'web', '2024-03-18 10:39:22', '2024-03-18 10:39:22'),
(184, 'all_work', 'web', '2024-03-18 10:38:41', '2024-03-18 10:38:41'),
(186, 'all_remarks', 'web', '2024-03-19 06:16:46', '2024-03-19 06:16:46'),
(207, 'updateGroup', 'web', '2024-03-20 09:49:42', '2024-03-20 09:49:42'),
(206, 'editGroup', 'web', '2024-03-20 09:49:42', '2024-03-20 09:49:42'),
(205, 'storeGroup', 'web', '2024-03-20 09:49:42', '2024-03-20 09:49:42'),
(204, 'createGroup', 'web', '2024-03-20 09:48:58', '2024-03-20 09:48:58'),
(203, 'group', 'web', '2024-03-20 09:48:58', '2024-03-20 09:48:58'),
(192, 'delete_schedule_reminder', 'web', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'delete_funnel_reminder', 'web', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'delete_invoice_reminder', 'web', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'delete_order_reminder', 'web', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'deleteGroup', 'web', '2024-03-20 09:49:42', '2024-03-20 09:49:42'),
(200, 'all_remarks', 'web', '2024-03-19 08:14:26', '2024-03-19 08:14:26');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `post_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_company_id` int(11) DEFAULT NULL
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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `user_id`, `pro_group_id`, `cat_id`, `product_unit`, `product_status`, `product_name`, `description`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `product_company_id`) VALUES
(1, 3, '1', '1', '1', 1, 'HickVision', '<ul>\r\n<li>sdfafsasdfsdffasdfsdfsdfasdf<strong>sdf</strong></li>\r\n</ul>', '2023-04-08 07:16:23', '2023-04-08 13:21:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, 3, '2', '2', '1', 1, 'Dell 104', '<p>asdffsdafsd<strong>sdfasfd</strong></p>', '2023-04-08 07:17:01', '2023-04-08 12:17:01', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, 3, '2', '3', '1', 0, 'HP-Zbook', '<p>sdasdfsdfdsf<strong>sdafdfs</strong></p>', '2023-04-08 07:17:28', '2023-04-08 12:17:28', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, 3, '2', '4', '1', 1, 'Thunder F321', '<p>dsffasfsdf<strong>asdffasd</strong></p>', '2023-04-08 07:17:59', '2023-04-08 12:17:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, 3, '1', '1', '1', 1, 'Gasoline', '<ul><li>asdfasdfasdf<strong>asdfasdfasdfasdfsdf</strong><ul><li><strong>sadfsadfsdf</strong><i><strong>sdfasdfsdfsdfsdfdf</strong></i></li><li><i><strong>asdfasdf</strong></i></li><li><i><strong>asdfsadf</strong></i></li><li><i><strong>asdfasdf</strong></i></li><li><i><strong>asdfasdf</strong></i></li><li><i><strong>asdfsdf</strong></i></li></ul></li></ul>', '2024-02-10 08:29:45', '2024-02-10 13:31:20', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, 3, '1', '1', '1', 1, 'ERD', '<p>sdffasdfasd</p>', '2024-03-16 08:40:10', '2024-03-16 13:40:10', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `product_group_updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  `product_group_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_group`
--

INSERT INTO `product_group` (`product_group_id`, `product_group_user_id`, `product_group_name`, `product_group_remarks`, `ip_address`, `os_name`, `browser`, `device`, `product_group_created_at`, `product_group_updated_at`, `product_group_company_id`) VALUES
(1, 3, 'CCTV', NULL, '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-08 07:14:47', '2023-04-08 12:14:47', 1),
(2, 3, 'Computer', NULL, '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '2023-04-08 07:15:00', '2023-04-08 12:15:00', 1),
(5, 3, 'sdf', NULL, '::1', 'Windows 10', 'Chrome', 'Computer', '2024-03-16 08:21:48', '2024-03-16 13:21:48', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_group_target_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_group_target`
--

INSERT INTO `product_group_target` (`product_group_target_id`, `product_group_target_your_manager`, `product_group_target_user_id`, `product_group_target_by`, `product_group_target`, `product_group_target_date`, `product_group_target_role`, `product_group_target_created_at`, `product_group_target_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `product_group_target_company_id`) VALUES
(1, '1', '11', 1, '2', '15-03-2023', 'Supervisor', '2023-03-08 10:45:22', '2023-03-08 15:45:22', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, '3', '4', 3, '1', '16-03-2024', 'Sale Person', '2024-03-16 08:58:37', '2024-03-16 13:58:37', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, '3', '4', 3, '2', '16-03-2024', 'Sale Person', '2024-03-16 08:58:39', '2024-03-16 13:58:39', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, '3', '4', 3, '5', '16-03-2024', 'Sale Person', '2024-03-16 08:58:40', '2024-03-16 13:58:40', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, '3', NULL, NULL, NULL, NULL, 'Admin', '2024-03-19 08:52:12', '2024-03-19 13:52:12', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`product_price_id`, `product_price_user_id`, `product_price_product_id`, `product_price_purchase`, `product_price_sale`, `product_price_status`, `product_price_unit`, `product_price_updated_at`, `product_price_created_at`, `os_name`, `browser`, `device`, `ip_address`, `product_price_company_id`) VALUES
(1, 3, 1, '1204', '1504', NULL, NULL, '2024-03-16 08:48:20', '2023-04-08 07:18:21', 'Windows 10', 'Chrome', 'Computer', '127.0.0.1', 1),
(2, 3, 2, '18045', '20044', NULL, NULL, '2024-02-23 11:07:08', '2023-04-08 07:18:35', 'Windows 10', 'Chrome', 'Computer', '127.0.0.1', 1),
(3, 3, 3, '4904', '5124', NULL, NULL, '2024-02-16 07:54:50', '2023-04-08 07:18:53', 'Windows 10', 'Chrome', 'Computer', '127.0.0.1', 1),
(4, 3, 4, '5604', '5804', NULL, NULL, '2024-02-16 07:54:50', '2023-04-08 07:19:05', 'Windows 10', 'Chrome', 'Computer', '127.0.0.1', 1),
(6, 3, 1, '470', '850', NULL, NULL, '2024-03-16 08:48:20', '2024-03-16 08:47:00', 'Windows 10', 'Chrome', 'Computer', '::1', 1);

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
  `updated_at` datetime DEFAULT NULL,
  `quotations_approval_company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotations_approval`
--

INSERT INTO `quotations_approval` (`id`, `inv_id`, `user_id`, `request_time`, `approve_time`, `remarks`, `approved_by`, `refuse_remarks`, `refuse_time`, `refused_by`, `status`, `created_at`, `updated_at`, `quotations_approval_company_id`) VALUES
(1, 3, 3, '2023-02-13 08:08:59', NULL, 'fdadfsasdffsd', NULL, NULL, NULL, NULL, 'Approved', '2023-02-13 08:08:59', '2023-02-13 10:52:14', 1),
(2, 1, 3, '2023-02-16 07:37:53', NULL, 'sdfsdfsdf', NULL, NULL, NULL, NULL, 'Approved', '2023-02-16 07:37:53', '2023-02-16 07:38:46', 1),
(3, 5, 3, '2024-01-27 07:25:43', '2024-01-27 07:31:35', 'sfdfsdf', 3, NULL, NULL, NULL, 'Approved', '2024-01-27 07:25:43', '2024-01-27 07:31:35', 1),
(4, 4, 3, '2024-01-27 07:26:40', '2024-01-27 07:31:40', 'sdfdff', 3, NULL, NULL, NULL, 'Approved', '2024-01-27 07:26:40', '2024-01-27 07:31:40', 1),
(5, 8, 3, '2024-01-27 07:31:56', NULL, 'sdfsdf', NULL, 'sdfsdafsdf', '2024-01-27 07:33:45', 1, 'Refused', '2024-01-27 07:31:56', '2024-01-27 07:33:45', 1),
(6, 7, 3, '2024-01-27 07:32:03', NULL, 'sdfsdf', NULL, 'g', '2024-01-27 07:35:32', 1, 'Refused', '2024-01-27 07:32:03', '2024-01-27 07:35:32', 1),
(7, 2, 3, '2024-01-27 07:34:20', NULL, 'gfgfg', NULL, 'sdfsdf', '2024-01-27 07:34:32', 1, 'Refused', '2024-01-27 07:34:20', '2024-01-27 07:34:32', 1),
(8, 11, 3, '2024-03-12 10:46:40', '2024-03-15 07:06:42', 'sdf', 2, NULL, NULL, NULL, 'Approved', '2024-03-12 10:46:40', '2024-03-15 07:06:42', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_target_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotation_target`
--

INSERT INTO `quotation_target` (`quotation_target_id`, `quotation_target_your_manager`, `quotation_target_user_id`, `quotation_target_by`, `quotation_target_product_category`, `quotation_target_date`, `quotation_target_role`, `quotation_target_otc`, `quotation_target_mrc`, `quotation_target_created_at`, `quotation_target_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `quotation_target_company_id`) VALUES
(1, '1', '3', 1, '1', '2022-11-09', 'Supervisor', '20', '3', '2022-11-09 11:08:58', '2022-11-09 16:08:58', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, '1', '3', 1, '1', '2022-11-10', 'Supervisor', '10', '5', '2022-11-10 07:17:22', '2022-11-10 12:17:22', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, '8', '3', 1, '1', '23-11-2022', 'Sale Person', '6', '3', '2022-11-23 10:30:56', '2022-11-23 15:30:56', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, '1', '3', 1, '3', '10-03-2023', 'Supervisor', '20', '0', '2023-03-08 10:44:58', '2023-03-08 15:44:58', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, '3', '4', 3, '3', '16-03-2024', 'Sale Person', '45544', '544', '2024-03-16 08:58:16', '2024-03-16 13:58:16', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, '3', '4', 3, '4', '18-03-2024', 'Sale Person', '85412', '9855', '2024-03-18 06:01:15', '2024-03-18 11:01:15', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, '3', '4', 3, '1', '18-03-2024', 'Sale Person', '78454', '4522', '2024-03-18 06:01:27', '2024-03-18 11:01:27', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(8, '3', '4', 3, '2', '18-03-2024', 'Sale Person', '858585', '96545', '2024-03-18 06:05:38', '2024-03-18 11:05:38', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `reg_user_id`, `reg_name`, `reg_remarks`, `reg_created_at`, `reg_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `region_company_id`) VALUES
(1, 3, 'Multan', NULL, '2023-02-13 07:49:31', '2023-02-13 12:49:31', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, 3, 'Mian wali', NULL, '2023-02-13 07:59:47', '2023-02-13 12:59:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, 3, 'Sindh', NULL, '2023-02-13 08:02:01', '2023-02-13 13:02:01', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, 3, 'Punjab', NULL, '2023-03-01 10:45:25', '2023-03-01 15:45:25', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, 3, 'Sindhs', NULL, '2023-03-08 07:55:52', '2024-01-27 12:59:20', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(8, 3, 'sdf', NULL, '2024-01-27 08:00:56', '2024-01-27 13:00:56', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(9, 3, 'erw', NULL, '2024-01-27 08:03:49', '2024-01-27 13:03:49', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(10, 3, 'fsdf', NULL, '2024-01-27 08:07:25', '2024-01-27 13:07:25', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(11, 3, 'MM', NULL, '2024-01-27 08:07:31', '2024-01-27 13:07:31', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(12, 3, 'WEEE', NULL, '2024-01-27 08:08:58', '2024-01-27 13:08:58', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(13, 3, 'dfsdfdsf', NULL, '2024-01-27 08:14:59', '2024-01-27 13:14:59', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(14, 3, 'qasa', NULL, '2024-01-27 08:15:06', '2024-03-15 14:36:50', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(15, 3, 'sdf', NULL, '2024-03-15 09:36:56', '2024-03-15 14:36:56', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(16, 3, 'Aswes', NULL, '2024-03-15 09:42:46', '2024-03-15 14:42:46', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(17, 3, 'QAWS', NULL, '2024-03-15 09:44:29', '2024-03-15 14:44:29', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(18, 3, 'wes', NULL, '2024-03-15 10:52:25', '2024-03-15 15:52:25', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(19, 3, 'sd', NULL, '2024-03-15 10:54:53', '2024-03-15 15:54:53', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(20, 4, 'erew', NULL, '2024-03-25 09:40:33', '2024-03-25 14:40:33', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `remarks`
--

INSERT INTO `remarks` (`remarks_id`, `remarks_user_id`, `remarks_for_id`, `remarks_schedule_id`, `remarks_funnel_id`, `remarks_purposal_id`, `remarks_order_id`, `remarks_detail`, `remarks_date`, `remarks_created_at`, `remarks_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `remarks_company_id`) VALUES
(1, '3', '4', NULL, NULL, '1', NULL, 'Check as soon as possible', '11/10/2022', '2022-11-10 13:04:24', '2022-11-10 13:04:24', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, '3', '4', '2', NULL, NULL, NULL, NULL, NULL, '2022-11-11 12:36:30', '2022-11-11 12:36:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, '3', '4', NULL, NULL, '3', NULL, NULL, '11/12/2022', '2022-11-12 12:32:59', '2022-11-12 12:32:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, '3', '4', '2', NULL, NULL, NULL, 'khannn', '12/07/2022', '2022-12-07 15:58:18', '2022-12-07 15:58:18', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, '3', '4', NULL, NULL, NULL, '13', NULL, NULL, '2022-11-29 16:54:13', '2022-11-29 16:54:13', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, '3', '4', NULL, NULL, NULL, '14', NULL, NULL, '2022-12-07 15:58:26', '2022-12-07 15:58:26', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(8, '3', '4', NULL, '7', NULL, NULL, NULL, NULL, '2022-12-07 16:04:17', '2022-12-07 16:04:17', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(9, '3', '4', '1', NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:06:07', '2022-12-07 16:06:07', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(10, '5', '4', NULL, NULL, '13', NULL, 'sdffsd', '03/19/2024', '2024-03-19 14:55:14', '2024-03-19 14:55:14', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(11, '5', '4', NULL, NULL, '11', NULL, 'sfd', '03/19/2024', '2024-03-19 14:56:14', '2024-03-19 14:56:14', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`reminder_id`, `reminder_user_id`, `reminder_for_id`, `reminder_schedule_id`, `reminder_funnel_id`, `reminder_purposal_id`, `reminder_order_id`, `reminder_remarks`, `reminder_date`, `reminder_reason`, `reminder_created_at`, `reminder_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `reminder_company_id`) VALUES
(1, '1', '1', NULL, NULL, '1', NULL, 'Check as soon as possible', '11/10/2022', NULL, '2022-11-10 13:04:24', '2022-11-10 13:04:24', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, '1', '1', '2', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-11 12:36:30', '2022-11-11 12:36:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, '1', '1', NULL, NULL, '3', NULL, NULL, '11/12/2022', NULL, '2022-11-12 12:32:59', '2022-11-12 12:32:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, '1', '1', NULL, NULL, NULL, '3', 'khannn', '12/07/2022', NULL, '2022-12-07 15:58:18', '2022-12-07 15:58:18', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, '1', '1', NULL, NULL, NULL, '3', NULL, NULL, NULL, '2022-11-29 16:54:13', '2022-11-29 16:54:13', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, '1', '1', NULL, NULL, NULL, '4', NULL, NULL, NULL, '2022-12-07 15:58:26', '2022-12-07 15:58:26', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(8, '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:04:17', '2022-12-07 16:04:17', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(9, '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:06:07', '2022-12-07 16:06:07', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(10, '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:10:45', '2022-12-07 16:10:45', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(11, '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:10:59', '2022-12-07 16:10:59', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(12, '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:11:30', '2022-12-07 16:11:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(13, '1', '1', '2', NULL, NULL, NULL, 'zxcx', '07-12-2022', NULL, '2022-12-07 16:13:32', '2022-12-07 16:13:32', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(14, '1', '1', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:20:15', '2022-12-07 16:20:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(15, '1', '1', NULL, '1', NULL, NULL, NULL, NULL, NULL, '2022-12-07 16:20:35', '2022-12-07 16:20:35', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(16, '1', '1', NULL, NULL, '15', NULL, NULL, NULL, NULL, '2022-12-07 16:21:27', '2022-12-07 16:21:27', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(17, '1', '1', NULL, NULL, NULL, '3', NULL, NULL, NULL, '2022-12-07 16:38:34', '2022-12-07 16:38:34', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(18, '1', '1', NULL, NULL, NULL, '4', 'kiczxs', '12/07/2022', NULL, '2022-12-07 16:38:58', '2022-12-07 16:38:58', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(19, '1', '1', NULL, '7', NULL, NULL, 'sdfsdfasdf', '13-02-2024', NULL, '2024-02-13 17:24:10', '2024-02-13 17:24:10', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(20, '1', '1', NULL, '4', NULL, NULL, 'asdfasdf', '20-02-2024', NULL, '2024-02-13 17:24:17', '2024-02-13 17:24:17', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(21, '1', '1', NULL, NULL, '11', NULL, 'asdfasdfsdf', '02/13/2024', NULL, '2024-02-13 17:29:01', '2024-02-13 17:29:01', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(22, '1', '1', NULL, NULL, '11', NULL, 'gdfgdfgdfgdfg', '02/13/2024', NULL, '2024-02-13 17:29:29', '2024-02-13 17:29:29', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(23, '1', '1', NULL, NULL, '11', NULL, 'xcvzvvxcvxc', '02/14/2024', NULL, '2024-02-13 17:31:40', '2024-02-13 17:31:40', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(24, '1', '1', NULL, NULL, NULL, '14', 'sdfasdfsdf', '02/15/2024', NULL, '2024-02-13 17:52:40', '2024-02-13 17:52:40', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(25, '1', '1', NULL, NULL, NULL, '13', 'asdfsdf', '02/14/2024', NULL, '2024-02-13 17:52:47', '2024-02-13 17:52:47', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(26, '1', '1', NULL, NULL, NULL, '13', 'sdfdsf', '02/23/2024', NULL, '2024-02-13 17:53:12', '2024-02-13 17:53:12', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(28, '3', '3', '2', NULL, NULL, NULL, 'sadf', '20-03-2024', NULL, '2024-03-12 12:16:34', '2024-03-12 12:16:34', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(29, '3', '3', '1', NULL, NULL, NULL, 'sdf', '28-03-2024', NULL, '2024-03-12 12:17:31', '2024-03-12 12:17:31', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(31, '3', '3', NULL, '7', NULL, NULL, 'sdaf', '15-03-2024', NULL, '2024-03-12 13:31:38', '2024-03-12 13:31:38', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(34, '4', '4', '4', NULL, NULL, NULL, 'sdf', 'TueTue-MarMar-2024202420242024 1414:0303:0606', 'kem_reminder', '2024-03-19 14:00:09', '2024-03-19 14:00:09', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `roles_company_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_by`, `type`, `roles_company_id`, `created_at`, `updated_at`) VALUES
(1, 'Master SoftagicsSales', 'web', 1, 1, 1, '2024-03-09 02:56:30', '2024-03-09 02:56:30'),
(2, 'Sale Person', 'web', 2, 2, 1, '2024-03-09 03:04:48', '2024-03-09 03:04:48'),
(3, 'Admin', 'web', 2, 2, 1, '2024-03-09 03:04:59', '2024-03-09 03:04:59'),
(4, 'Tele Caller', 'web', 3, 2, 1, '2024-03-12 02:44:19', '2024-03-12 02:44:19');

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
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(16, 1),
(16, 2),
(16, 3),
(16, 4),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(20, 1),
(20, 2),
(20, 3),
(20, 4),
(21, 1),
(21, 2),
(21, 3),
(21, 4),
(22, 1),
(22, 2),
(22, 3),
(22, 4),
(23, 1),
(23, 2),
(23, 3),
(23, 4),
(24, 1),
(24, 2),
(24, 3),
(24, 4),
(25, 1),
(25, 2),
(25, 3),
(25, 4),
(26, 1),
(26, 2),
(26, 3),
(26, 4),
(27, 1),
(27, 2),
(27, 3),
(27, 4),
(28, 1),
(28, 2),
(28, 3),
(28, 4),
(29, 1),
(29, 2),
(29, 3),
(29, 4),
(30, 1),
(30, 2),
(30, 3),
(30, 4),
(31, 1),
(31, 2),
(31, 3),
(31, 4),
(32, 1),
(32, 2),
(32, 3),
(32, 4),
(33, 1),
(33, 2),
(33, 3),
(33, 4),
(34, 1),
(34, 2),
(34, 3),
(34, 4),
(35, 1),
(35, 2),
(35, 3),
(35, 4),
(36, 1),
(36, 2),
(36, 3),
(36, 4),
(37, 1),
(37, 2),
(37, 3),
(37, 4),
(38, 1),
(38, 2),
(38, 3),
(38, 4),
(39, 1),
(39, 2),
(39, 3),
(39, 4),
(40, 1),
(40, 2),
(40, 3),
(40, 4),
(41, 1),
(41, 2),
(41, 3),
(41, 4),
(42, 1),
(42, 2),
(42, 3),
(42, 4),
(43, 1),
(43, 2),
(43, 3),
(43, 4),
(44, 1),
(44, 2),
(44, 3),
(44, 4),
(45, 1),
(45, 2),
(45, 3),
(45, 4),
(46, 1),
(46, 2),
(46, 3),
(46, 4),
(47, 1),
(47, 2),
(47, 3),
(47, 4),
(48, 1),
(48, 2),
(48, 3),
(48, 4),
(49, 1),
(49, 2),
(49, 3),
(49, 4),
(54, 1),
(54, 2),
(54, 3),
(54, 4),
(55, 1),
(55, 2),
(55, 3),
(55, 4),
(56, 1),
(56, 2),
(56, 3),
(56, 4),
(57, 1),
(57, 2),
(57, 3),
(57, 4),
(62, 1),
(62, 2),
(62, 3),
(62, 4),
(63, 1),
(63, 2),
(63, 3),
(63, 4),
(64, 1),
(64, 2),
(64, 3),
(64, 4),
(65, 1),
(65, 2),
(65, 3),
(65, 4),
(66, 1),
(66, 2),
(66, 3),
(66, 4),
(67, 2),
(67, 3),
(67, 4),
(68, 2),
(68, 3),
(68, 4),
(69, 2),
(69, 3),
(69, 4),
(70, 2),
(70, 3),
(70, 4),
(75, 1),
(75, 2),
(75, 3),
(75, 4),
(76, 1),
(76, 2),
(76, 3),
(76, 4),
(77, 1),
(77, 2),
(77, 3),
(77, 4),
(78, 1),
(78, 2),
(78, 3),
(78, 4),
(79, 1),
(79, 2),
(79, 3),
(79, 4),
(80, 1),
(80, 2),
(80, 3),
(80, 4),
(81, 1),
(81, 2),
(81, 3),
(81, 4),
(82, 1),
(82, 2),
(82, 3),
(82, 4),
(83, 1),
(83, 2),
(83, 3),
(83, 4),
(84, 1),
(84, 2),
(84, 3),
(84, 4),
(85, 1),
(85, 2),
(85, 3),
(85, 4),
(86, 1),
(86, 2),
(86, 3),
(86, 4),
(87, 1),
(87, 2),
(87, 3),
(87, 4),
(88, 1),
(88, 2),
(88, 3),
(88, 4),
(89, 1),
(89, 2),
(89, 3),
(89, 4),
(90, 1),
(90, 2),
(90, 3),
(90, 4),
(91, 1),
(91, 2),
(91, 3),
(91, 4),
(92, 1),
(92, 2),
(92, 3),
(92, 4),
(93, 1),
(93, 2),
(93, 3),
(93, 4),
(94, 1),
(94, 2),
(94, 3),
(94, 4),
(95, 1),
(95, 2),
(95, 3),
(95, 4),
(96, 1),
(96, 2),
(96, 3),
(96, 4),
(97, 1),
(97, 2),
(97, 3),
(97, 4),
(98, 1),
(98, 2),
(98, 3),
(98, 4),
(99, 1),
(99, 2),
(99, 3),
(99, 4),
(100, 1),
(100, 2),
(100, 3),
(100, 4),
(101, 1),
(101, 2),
(101, 3),
(101, 4),
(102, 1),
(102, 2),
(102, 3),
(102, 4),
(103, 1),
(103, 2),
(103, 3),
(103, 4),
(104, 2),
(104, 3),
(104, 4),
(105, 1),
(105, 2),
(105, 3),
(105, 4),
(106, 1),
(106, 2),
(106, 3),
(106, 4),
(107, 1),
(107, 2),
(107, 3),
(107, 4),
(108, 1),
(108, 2),
(108, 3),
(108, 4),
(109, 1),
(109, 2),
(109, 3),
(109, 4),
(110, 1),
(110, 2),
(110, 3),
(110, 4),
(111, 1),
(111, 2),
(111, 3),
(111, 4),
(112, 1),
(112, 2),
(112, 3),
(112, 4),
(113, 1),
(113, 2),
(113, 3),
(113, 4),
(114, 1),
(114, 2),
(114, 3),
(114, 4),
(115, 1),
(115, 2),
(115, 3),
(115, 4),
(116, 1),
(116, 2),
(116, 3),
(116, 4),
(117, 1),
(117, 2),
(117, 3),
(117, 4),
(118, 1),
(118, 2),
(118, 3),
(118, 4),
(119, 1),
(119, 2),
(119, 3),
(119, 4),
(120, 1),
(120, 2),
(120, 3),
(120, 4),
(121, 1),
(121, 2),
(121, 3),
(121, 4),
(122, 1),
(122, 2),
(122, 3),
(122, 4),
(123, 1),
(123, 2),
(123, 3),
(123, 4),
(124, 1),
(124, 2),
(124, 3),
(124, 4),
(125, 1),
(125, 2),
(125, 3),
(125, 4),
(126, 1),
(126, 2),
(126, 3),
(126, 4),
(127, 1),
(127, 2),
(127, 3),
(127, 4),
(128, 1),
(128, 2),
(128, 3),
(128, 4),
(129, 1),
(129, 2),
(129, 3),
(129, 4),
(130, 1),
(130, 2),
(130, 3),
(130, 4),
(131, 1),
(131, 2),
(131, 3),
(131, 4),
(134, 1),
(134, 2),
(134, 3),
(134, 4),
(135, 1),
(135, 2),
(135, 3),
(135, 4),
(136, 1),
(136, 2),
(136, 3),
(136, 4),
(137, 1),
(137, 2),
(137, 3),
(137, 4),
(138, 1),
(138, 2),
(138, 3),
(138, 4),
(139, 1),
(139, 2),
(139, 3),
(139, 4),
(140, 1),
(140, 2),
(140, 3),
(140, 4),
(141, 1),
(141, 2),
(141, 3),
(141, 4),
(142, 1),
(142, 2),
(142, 3),
(142, 4),
(144, 2),
(144, 3),
(144, 4),
(147, 1),
(147, 2),
(147, 3),
(147, 4),
(148, 1),
(148, 2),
(148, 3),
(148, 4),
(149, 1),
(149, 2),
(149, 3),
(149, 4),
(150, 1),
(150, 2),
(150, 3),
(150, 4),
(151, 1),
(151, 2),
(151, 3),
(151, 4),
(152, 1),
(152, 2),
(152, 3),
(152, 4),
(153, 1),
(153, 2),
(153, 3),
(153, 4),
(154, 1),
(154, 2),
(154, 3),
(154, 4),
(155, 1),
(155, 2),
(155, 3),
(155, 4),
(156, 1),
(156, 2),
(156, 3),
(156, 4),
(159, 1),
(159, 2),
(159, 3),
(159, 4),
(160, 1),
(160, 2),
(160, 3),
(160, 4),
(162, 1),
(162, 2),
(162, 3),
(162, 4),
(163, 1),
(163, 2),
(163, 3),
(163, 4),
(164, 1),
(164, 2),
(164, 3),
(164, 4),
(165, 1),
(165, 2),
(165, 3),
(165, 4),
(166, 1),
(166, 2),
(166, 3),
(166, 4),
(167, 1),
(167, 2),
(167, 3),
(167, 4),
(168, 1),
(168, 2),
(168, 3),
(168, 4),
(169, 1),
(169, 2),
(169, 3),
(169, 4),
(170, 1),
(170, 2),
(170, 3),
(170, 4),
(171, 1),
(171, 2),
(171, 3),
(171, 4),
(172, 1),
(172, 2),
(172, 3),
(172, 4),
(173, 1),
(173, 2),
(173, 3),
(173, 4),
(174, 2),
(174, 3),
(174, 4),
(175, 2),
(175, 3),
(175, 4),
(176, 2),
(176, 3),
(176, 4),
(177, 2),
(177, 3),
(177, 4),
(178, 2),
(178, 3),
(178, 4),
(179, 2),
(179, 3),
(179, 4),
(180, 1),
(180, 2),
(180, 3),
(180, 4),
(181, 1),
(181, 2),
(181, 3),
(181, 4),
(184, 2),
(184, 3),
(184, 4),
(185, 2),
(185, 3),
(185, 4),
(186, 2),
(186, 3),
(186, 4),
(192, 2),
(192, 3),
(192, 4),
(193, 2),
(193, 3),
(193, 4),
(194, 2),
(194, 3),
(194, 4),
(195, 2),
(195, 3),
(195, 4),
(203, 2),
(203, 3),
(203, 4),
(204, 2),
(204, 3),
(204, 4),
(205, 2),
(205, 3),
(205, 4),
(206, 2),
(206, 3),
(206, 4),
(207, 2),
(207, 3),
(207, 4),
(208, 2),
(208, 3),
(208, 4);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_invoice_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_invoice`
--

INSERT INTO `sale_invoice` (`id`, `user_id`, `inv_id`, `category_id`, `product_id`, `qty`, `sale`, `total_amount`, `payment_type`, `date`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `sale_invoice_company_id`) VALUES
(1, 3, 1, '1', '1', 13, 150, 1950, 'OTC', NULL, '2023-04-08 07:55:47', '2023-04-08 07:55:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, 3, 1, '4', '4', 1, 580, 580, 'OTC', NULL, '2023-04-08 07:55:47', '2023-04-08 07:55:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, 3, 2, '1', '1', 1, 150, 150, 'OTC', NULL, '2023-04-08 07:56:30', '2023-04-08 07:56:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, 3, 2, '2', '2', 13, 200, 2600, 'OTC', NULL, '2023-04-08 07:56:30', '2023-04-08 07:56:30', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, 3, 3, '1', '1', 13, 150, 1950, 'OTC', NULL, '2023-04-08 09:40:48', '2023-04-08 09:40:48', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, 3, 3, '2', '2', 13, 200, 2600, 'OTC', NULL, '2023-04-08 09:40:48', '2023-04-08 09:40:48', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, 3, 4, '1', '1', 18, 150, 2700, 'OTC', NULL, '2023-04-08 09:41:05', '2023-04-08 09:41:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(8, 3, 4, '2', '2', 13, 200, 2600, 'OTC', NULL, '2023-04-08 09:41:05', '2023-04-08 09:41:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(20, 3, 10, '4', '4', 1, 580, 580, 'OTC', NULL, '2024-01-27 07:39:08', '2024-01-27 07:39:08', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(19, 3, 10, '2', '2', 1, 200, 200, 'OTC', NULL, '2024-01-27 07:39:08', '2024-01-27 07:39:08', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(11, 3, 6, '1', '1', 13, 150, 1950, 'OTC', NULL, '2023-04-08 09:46:21', '2023-04-08 09:46:21', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(12, 3, 6, '4', '4', 187, 580, 108460, 'OTC', NULL, '2023-04-08 09:46:21', '2023-04-08 09:46:21', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(13, 3, 7, '1', '1', 13, 150, 1950, 'OTC', NULL, '2023-04-08 09:47:05', '2023-04-08 09:47:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(14, 4, 7, '4', '4', 17, 580, 9860, 'OTC', NULL, '2023-04-08 09:47:05', '2023-04-08 09:47:05', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(15, 4, 8, '1', '1', 13, 150, 1950, 'OTC', NULL, '2023-04-08 09:53:15', '2023-04-08 09:53:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(16, 4, 8, '4', '4', 1, 580, 580, 'OTC', NULL, '2023-04-08 09:53:15', '2023-04-08 09:53:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(17, 3, 8, '2', '2', 13, 200, 2600, 'OTC', NULL, '2023-04-08 09:53:15', '2023-04-08 09:53:15', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(18, 3, 9, '2', '2', 1, 200, 200, 'OTC', NULL, '2024-01-27 07:18:24', '2024-01-27 07:18:24', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(21, 3, 11, '1', '1', 1, 150, 150, 'OTC', NULL, '2024-02-13 12:28:53', '2024-02-13 12:28:53', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(25, 5, 14, '1', '1', 1, 1504, 1504, 'OTC', NULL, '2024-03-27 09:55:37', '2024-03-27 09:55:37', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(23, 3, 13, '2', '2', 1, 20044, 20044, 'OTC', NULL, '2024-03-12 10:39:23', '2024-03-12 10:39:23', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(24, 3, 13, '1', '1', 1, 1504, 1504, 'OTC', NULL, '2024-03-12 10:39:23', '2024-03-12 10:39:23', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(26, 5, 15, '1', '1', 1, 1504, 1504, 'OTC', NULL, '2024-03-27 10:04:09', '2024-03-27 10:04:09', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(27, 5, 15, '1', '1', 1, 1504, 1504, 'OTC', NULL, '2024-03-27 10:04:09', '2024-03-27 10:04:09', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(28, 5, 15, '2', '2', 1, 20044, 20044, 'OTC', NULL, '2024-03-27 10:04:09', '2024-03-27 10:04:09', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(29, 5, 16, '1', '1', 1, 1504, 1504, 'OTC', NULL, '2024-03-27 10:04:53', '2024-03-27 10:04:53', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(30, 5, 16, '1', '1', 1, 1504, 1504, 'OTC', NULL, '2024-03-27 10:04:53', '2024-03-27 10:04:53', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(31, 5, 16, '2', '2', 1, 20044, 20044, 'OTC', NULL, '2024-03-27 10:04:53', '2024-03-27 10:04:53', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `user_id`, `date`, `company_id`, `type_of_visit`, `sch_remarks`, `schedule_status`, `sch_reminder_reason`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `schedule_company_id`) VALUES
(1, 3, '26-11-2022', 1, '2', 'Tough Situations', 'new', 'close_reminder', '2022-11-10 08:01:15', '2024-01-27 06:59:56', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, 3, '26-11-2022', 4, '1', NULL, 'new', NULL, '2022-11-11 07:35:14', '2022-11-26 08:10:19', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, 4, '03-04-2023', 1, '1', NULL, 'reSchedule', 'kem_reminder', '2023-04-03 07:15:52', '2023-04-03 07:15:52', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(7, 4, '25-03-2024', 13, '6', NULL, 'new', NULL, '2024-03-25 11:09:33', '2024-03-25 11:09:33', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_target_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_target`
--

INSERT INTO `schedule_target` (`sch_target_id`, `sch_target_your_manager`, `sch_target_user_id`, `sch_target_by`, `sch_target_date`, `sch_target_role`, `sch_target_business_category_id`, `sch_target_total_visits`, `sch_target_min_new_visits`, `sch_target_created_at`, `sch_target_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `schedule_target_company_id`) VALUES
(1, '1', '3', 1, '2022-11-09', 'Supervisor', '1', '5', '5', '2022-11-09 11:07:18', '2022-11-09 16:07:18', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', NULL),
(2, '7', '3', 1, '2022-11-10', 'Sale Person', '5', '3', '2', '2022-11-10 07:16:31', '2022-11-10 12:16:31', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', NULL),
(3, '1', '3', 1, '23-11-2022', 'Supervisor', '2', '1', '1', '2022-11-23 10:30:07', '2022-11-23 15:30:07', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', NULL),
(4, '1', '3', 1, '25-11-2022', 'Supervisor', '1', '156', '104', '2022-11-25 07:15:45', '2022-11-25 12:15:45', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', NULL),
(5, '5', '3', 1, '25-11-2022', 'Sale Person', '5', '156', '104', '2022-11-25 07:19:08', '2022-11-25 12:19:08', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', NULL),
(6, '5', '3', 1, '25-11-2022', 'Sale Person', '4', '200', '100', '2022-11-25 07:43:43', '2022-11-25 12:43:43', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', NULL),
(7, '1', '3', 1, '08-03-2023', 'Supervisor', '1', '25', '15', '2023-03-08 10:44:10', '2023-03-08 15:44:10', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', NULL),
(8, '3', '3', 3, '16-03-2024', 'Sale Person', '1', '5', '5', '2024-03-16 08:57:42', '2024-03-16 13:57:42', '::1', 'Windows 10', 'Chrome', 'Computer', NULL),
(9, '3', '3', 3, '16-03-2024', 'Sale Person', '2', '4', '4', '2024-03-16 09:31:35', '2024-03-16 14:31:35', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(10, '3', '4', 3, '18-03-2024', 'Sale Person', '2', '7845', '7845', '2024-03-18 05:50:07', '2024-03-18 10:50:07', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(11, '3', '4', 3, '18-03-2024', 'Sale Person', '5', '7845', '8558', '2024-03-18 06:00:04', '2024-03-18 11:00:04', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`sector_id`, `sec_region_id`, `sec_area_id`, `sec_user_id`, `sec_name`, `sec_remarks`, `sec_created_at`, `sec_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `sector_company_id`) VALUES
(1, 1, 1, 1, 'Chungi No.9', NULL, '2023-02-13 07:50:16', '2023-02-13 12:50:16', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, 1, 1, 1, 'F-Block', NULL, '2023-02-13 08:00:24', '2023-02-13 13:00:24', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, 3, 3, 2, 'Kahan Velly', NULL, '2023-02-13 08:03:01', '2023-02-13 13:03:01', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, 4, 4, 1, 'Shah Rukn-e-Alam', NULL, '2023-03-01 10:46:02', '2023-03-01 15:46:02', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, 6, 6, 1, 'korangi', NULL, '2023-03-08 08:00:02', '2023-03-08 13:00:02', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(7, 9, 9, 1, 'sdfsdfsdfsdfsdffsdf', NULL, '2024-01-27 08:04:04', '2024-01-27 13:04:04', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(9, 1, 1, 1, 'sdfsdf', NULL, '2024-01-27 08:17:54', '2024-01-27 13:17:54', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(10, 1, 1, 3, 'ere', NULL, '2024-03-15 10:03:14', '2024-03-15 15:04:15', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(11, 18, 14, 3, 'QAAA', NULL, '2024-03-15 10:53:07', '2024-03-15 15:53:07', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(12, 6, 7, 3, 'sdfsdfsdfsdf', NULL, '2024-03-15 11:03:23', '2024-03-15 16:03:23', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(13, 20, 17, 4, 'sdfsdfsdf', NULL, '2024-03-25 09:40:53', '2024-03-25 14:40:53', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1);

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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`sta_id`, `sta_status`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `status_company_id`) VALUES
(1, 'Active', '2023-03-08 10:50:35', '2023-03-08 10:50:35', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, 'Deactive', '2023-03-08 10:50:45', '2023-03-08 10:50:45', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `tandc_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `term_and_condition_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_and_condition`
--

INSERT INTO `term_and_condition` (`tandc_id`, `tandc_title`, `tandc_description`, `tandc_created_at`, `tandc_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `tandc_user_id`, `term_and_condition_company_id`) VALUES
(1, 'Price', '<p>Dont LOck</p>', '2022-11-09 10:41:33', '2022-11-09 10:41:47', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', '1', 1),
(2, 'Privacy Policy of OIL', '<p>This is oil</p>', '2022-11-10 07:15:16', '2024-02-26 10:17:13', '::1', 'Windows 10', 'Chrome', 'Computer', '1', 1),
(5, 'services', '<p><strong>Services</strong></p><ul><li>full of cart</li><li>smiley face</li></ul>', '2022-11-30 07:07:40', '2024-02-26 10:16:19', '::1', 'Windows 10', 'Chrome', 'Computer', '1', 2),
(8, 'sdfdfs', '<p>sdfsdfsdf</p>', '2024-03-16 08:53:56', '2024-03-16 08:53:56', '::1', 'Windows 10', 'Chrome', 'Computer', '3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE `testing` (
  `testing_id` int(11) NOT NULL,
  `testing_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testing_company_id` int(11) DEFAULT NULL
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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `town`
--

INSERT INTO `town` (`town_id`, `town_region_id`, `town_area_id`, `town_sector_id`, `town_user_id`, `town_name`, `town_remarks`, `town_created_at`, `town_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `town_company_id`) VALUES
(1, 1, 1, 1, 2, 'hashim Colony', NULL, '2023-02-13 07:50:34', '2023-02-13 12:50:34', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, 2, 2, 2, 2, 'Plaza', NULL, '2023-02-13 08:00:39', '2023-02-13 13:00:39', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(3, 3, 3, 3, 2, 'Dolat Town', NULL, '2023-02-13 08:03:21', '2023-02-13 13:03:21', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, 4, 4, 3, 2, 'F-block', NULL, '2023-03-01 10:46:12', '2023-03-01 15:46:12', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, 6, 6, 6, 2, 'New Karachiii', NULL, '2023-03-08 08:02:10', '2023-03-08 13:02:10', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(8, 18, 14, 11, 3, 'QWASS', NULL, '2024-03-15 10:53:14', '2024-03-15 15:53:14', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(9, 20, 17, 13, 4, 'ewere', NULL, '2024-03-25 09:41:07', '2024-03-25 14:41:07', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1);

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
  `unit_updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  `unit_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_user_id`, `unit_main_unit_id`, `unit_name`, `unit_scale_size`, `unit_remarks`, `ip_address`, `os_name`, `browser`, `device`, `unit_created_at`, `unit_updated_at`, `unit_company_id`) VALUES
(1, 3, '6', 'EWD', NULL, NULL, '::1', 'Windows 10', 'Chrome', 'Computer', '2024-03-16 08:17:24', '2024-03-16 13:17:24', 1),
(2, 3, '5', 'sdfdsf', NULL, NULL, '::1', 'Windows 10', 'Chrome', 'Computer', '2024-03-16 08:17:35', '2024-03-16 13:17:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `upload_video`
--

CREATE TABLE `upload_video` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `upload_video_company_id` int(11) DEFAULT NULL
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
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doj` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `supervisor`, `role`, `email`, `username`, `mob`, `address`, `image`, `password`, `modular_group`, `email_verified_at`, `user_status`, `type`, `f_name`, `cnic`, `doj`, `group_id`, `emergency_contact`, `remember_token`, `created_at`, `updated_at`, `ip_address`, `os_name`, `browser`, `device`, `users_company_id`) VALUES
(1, 'Softagics', NULL, 'Admin', 'softagics@gmail.com', 'softagics', '', NULL, NULL, '$2y$10$tL/GDmcxuoQy9Qd3vPsBCOexh.Bz4MbjpQNLoFOC1nGAE71zrzJZK', NULL, NULL, 1, 'Master', NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-09 07:53:54', '2024-03-09 12:53:54', NULL, NULL, NULL, NULL, NULL),
(2, 'MasterSoftagicsSales', 1, 'Admin', 'masterSoftagicsSales@gmail.com', 'MasterSoftagicsSales', '44444444444', NULL, NULL, '$2y$10$7S/k/HPZ0MjgUZwIQntM8.Ne3QMsx99tm6CSRnF3q85a94VYvbPT.', NULL, NULL, 1, 'Master', NULL, '', NULL, NULL, NULL, NULL, '2024-03-09 07:56:31', '2024-03-09 12:56:31', NULL, NULL, NULL, NULL, 1),
(3, 'sadminSoftagicsSales', 2, 'Admin', 'sadminSoftagicsSales@gmail.com', 'sadminSoftagicsSales', '44444444444', 'asdf', 'car_1709971663.png', '$2y$10$4Y8u90xe8AFKMZdhMcqAN..ZIBcjvRjeZ37YyLKzOQMus4FvlET2G', 'Admin', NULL, 1, 'Employee', 'sdf', 'asdf', '09-03-2024', NULL, 'sdf', NULL, '2024-03-09 07:56:31', '2024-03-09 13:15:55', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, 'Asad', 3, 'Sale Person', 'asad@gmail.com', 'asad1234', '03131454545', 'multan', 'cartoon_1710136937.png', '$2y$10$utKi5f9KGbZ54Iq13eHIUObOjA7qO37hDjhZ/BVLUrOuA8i4HHfgi', 'Sale Person', NULL, 1, '', 'farhad', '22222-2222222-2', '11-03-2024', NULL, '0131313131', NULL, '2024-03-11 06:02:17', '2024-03-11 11:02:17', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, 'Tele Caller', 3, 'Tele Caller', 'telecaller1234@w', 'telecaller1234', '884848484848484', 'asdfasdfasdfasdf', 'cartoon_1710230156.png', '$2y$10$V5zeJHAAgZcRjw3umQYXduIb.i9J31Yejk9t9r.ZtDUzvWLSSpgqa', 'Tele Caller', NULL, 1, '', 'sdf', '88888-8888888-8', '20-03-2024', '4,5', '858588855858', '', '2024-03-12 07:55:56', '2024-03-12 12:55:56', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1),
(6, 'burhan', 3, 'Tele Caller', 'burhan@gmail.com', 'burhanburhan@gmail.com', '111111111111111', 'sadfasdfsadfsdf', 'cartoon_1711352004.png', '$2y$10$2AnW74fFX7OjCHacIG5VqeZ7jHNpCEjePtko9EP85Vbik5prlWkdq', 'Tele Caller', NULL, 1, '', 'irshad Ali', '14545454456854', '25-03-2024', '4,5', '0131313131', NULL, '2024-03-25 07:33:24', '2024-03-25 12:33:24', '::1', 'Windows 10', 'Chrome', 'Computer', 1);

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
  `user_role_updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  `user_role_company_id` int(11) DEFAULT NULL
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
  `device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visit_type_company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visit_type`
--

INSERT INTO `visit_type` (`visit_type_id`, `visit_type_name`, `visit_type_user_id`, `visit_type_created_at`, `visit_type_updated_at`, `ip_address`, `os_name`, `browser`, `device`, `visit_type_company_id`) VALUES
(1, 'Showns', '3', '2023-02-09 09:33:50', '2024-01-27 13:27:59', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(2, 'Show', '3', '2023-02-09 09:33:57', '2023-02-09 14:33:57', '127.0.0.1', 'Windows 10', 'Chrome', 'Computer', 1),
(4, 'sdf', '3', '2024-01-27 08:27:27', '2024-01-27 13:27:27', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(5, 'زژيژئژ', '3', '2024-03-16 06:49:09', '2024-03-16 11:49:09', '::1', 'Windows 10', 'Chrome', 'Computer', 1),
(6, 'WESDW', '4', '2024-03-25 10:57:01', '2024-03-25 15:57:01', '127.0.0.1', 'Windows 10', 'Firefox', 'Computer', 1);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `websockets_statistics_entries_company_id` int(11) DEFAULT NULL
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
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

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
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groups_id`);

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
-- Indexes for table `new_company`
--
ALTER TABLE `new_company`
  ADD PRIMARY KEY (`nc_id`);

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
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `business_category`
--
ALTER TABLE `business_category`
  MODIFY `business_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `business_profile`
--
ALTER TABLE `business_profile`
  MODIFY `business_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cat_product_grp`
--
ALTER TABLE `cat_product_grp`
  MODIFY `cat_product_grp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `company_poc_profile`
--
ALTER TABLE `company_poc_profile`
  MODIFY `com_poc_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `comprofile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expiry_days`
--
ALTER TABLE `expiry_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `funnel`
--
ALTER TABLE `funnel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `funnel_target`
--
ALTER TABLE `funnel_target`
  MODIFY `funnel_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groups_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `main_unit`
--
ALTER TABLE `main_unit`
  MODIFY `main_unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `new_company`
--
ALTER TABLE `new_company`
  MODIFY `nc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_purposal`
--
ALTER TABLE `order_purposal`
  MODIFY `order_purposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_target`
--
ALTER TABLE `order_target`
  MODIFY `order_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_group`
--
ALTER TABLE `product_group`
  MODIFY `product_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_group_target`
--
ALTER TABLE `product_group_target`
  MODIFY `product_group_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `product_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotations_approval`
--
ALTER TABLE `quotations_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quotation_target`
--
ALTER TABLE `quotation_target`
  MODIFY `quotation_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `remarks_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale_invoice`
--
ALTER TABLE `sale_invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedule_target`
--
ALTER TABLE `schedule_target`
  MODIFY `sch_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `sta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `term_and_condition`
--
ALTER TABLE `term_and_condition`
  MODIFY `tandc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `testing`
--
ALTER TABLE `testing`
  MODIFY `testing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `town_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upload_video`
--
ALTER TABLE `upload_video`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visit_type`
--
ALTER TABLE `visit_type`
  MODIFY `visit_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
