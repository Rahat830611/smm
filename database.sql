-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2023 at 05:09 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smm_empty`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@example.com', 'admin', NULL, '635ce2abe4bf81667031723.png', '$2y$10$ZOWPSwbB7098UQHq/GZX5uGq43wfuDDjMBNASktSNK55T/4jC/xvy', 'guqeEBJH8SwBJm6ZwEuDVqm00HLDLDKkfecDc2Hw0Er1fUT6OXULrThxWPhZ', NULL, '2023-01-14 08:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT 0,
  `click_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_providers`
--

CREATE TABLE `api_providers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(4) NOT NULL,
  `api_url` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `api_providers`
--

INSERT INTO `api_providers` (`id`, `name`, `short_name`, `api_url`, `api_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MomoSMM', 'MSMM', 'https://momopanel.com/api/v2', 'ee6598cd56dbae41d66a38a4e26743d7', 1, '2023-05-16 03:44:59', '2023-07-30 02:38:45'),
(4, 'ProviderSMM', 'PSMM', 'https://providersmm.net/api/v2', '653c5c5151bd72870ab4a4c400ab6a3d', 1, '2023-07-30 02:30:58', '2023-07-30 02:30:58'),
(5, 'VINA SMM', 'VSMM', 'https://vinasmm.com/api/v2', '709e812f7c8f9a577e08dffc7db79ff8', 1, '2023-07-30 02:36:45', '2023-07-30 02:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `brand_packages`
--

CREATE TABLE `brand_packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(28,8) NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL,
  `link_field` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `brand_package_orders`
--

CREATE TABLE `brand_package_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(28,8) NOT NULL,
  `link` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=>pending,1=>porcessing,2=>complete,3=>cancelled,4=>refunded',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=acttive 2=deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `commission_logs`
--

CREATE TABLE `commission_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `brand_package_order_id` int(11) DEFAULT NULL,
  `method_code` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `method_currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `final_amo` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_amo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` int(10) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT 0,
  `admin_feedback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'object',
  `support` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Live Chat(Tawk.to)', 'Key location is shown bellow', 'chat-png.png', '<script>\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\n                        (function(){\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\n                        s1.async=true;\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\n                        s1.charset=\"UTF-8\";\n                        s1.setAttribute(\"crossorigin\",\"*\");\n                        s0.parentNode.insertBefore(s1,s0);\n                        })();\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"55\"}}', 'twak.png', 0, NULL, '2019-10-18 23:16:05', '2023-03-22 06:04:56'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha2.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"6LdPC88fAAAAAG5SVaRYDnV2NpCrptLg2XLYKRKB\"}}', 'recaptcha.png', 0, NULL, '2019-10-18 23:16:05', '2022-05-08 04:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `act`, `form_data`, `created_at`, `updated_at`) VALUES
(2, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"nid_number_22\":{\"name\":\"NID Number 22\",\"label\":\"nid_number_22\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"textarea\"},\"sadfg\":{\"name\":\"sadfg\",\"label\":\"sadfg\",\"is_required\":\"optional\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"asdf\":{\"name\":\"asdf\",\"label\":\"asdf\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"Test2\",\"Test3\"],\"type\":\"select\"},\"nid_number_226985\":{\"name\":\"NID Number 226985\",\"label\":\"nid_number_226985\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"Test 2\",\"Test 3\"],\"type\":\"checkbox\"},\"nid_number_3333\":{\"name\":\"NID Number 3333\",\"label\":\"nid_number_3333\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"asdf\"],\"type\":\"radio\"},\"nid_number_3333587\":{\"name\":\"NID Number 3333587\",\"label\":\"nid_number_3333587\",\"is_required\":\"optional\",\"extensions\":\"jpg,bmp,png,pdf\",\"options\":[],\"type\":\"file\"}}', '2022-03-16 01:09:49', '2022-03-17 00:02:54'),
(3, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"nid_number_226985\":{\"name\":\"NID Number 226985\",\"label\":\"nid_number_226985\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-16 04:32:29', '2022-03-16 04:35:32'),
(5, 'withdraw_method', '{\"nid_number_33\":{\"name\":\"NID Number 33\",\"label\":\"nid_number_33\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-17 00:45:35', '2022-03-17 00:53:17'),
(6, 'withdraw_method', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-17 00:47:04', '2022-03-17 00:47:04'),
(7, 'kyc', '{\"full_name\":{\"name\":\"Full Name\",\"label\":\"full_name\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"gender\":{\"name\":\"Gender\",\"label\":\"gender\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Male\",\"Female\",\"Others\"],\"type\":\"select\"},\"you_hobby\":{\"name\":\"You Hobby\",\"label\":\"you_hobby\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Programming\",\"Gardening\",\"Traveling\",\"Others\"],\"type\":\"checkbox\"},\"nid_photo\":{\"name\":\"NID Photo\",\"label\":\"nid_photo\",\"is_required\":\"required\",\"extensions\":\"jpg,png\",\"options\":[],\"type\":\"file\"}}', '2022-03-17 02:56:14', '2022-04-11 03:23:40'),
(8, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-21 07:53:25', '2022-03-21 07:53:25'),
(9, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-21 07:54:15', '2022-03-21 07:54:15'),
(10, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-21 07:55:15', '2022-03-21 07:55:22'),
(11, 'withdraw_method', '{\"nid_number_2658\":{\"name\":\"NID Number 2658\",\"label\":\"nid_number_2658\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[\"asdf\"],\"type\":\"checkbox\"}}', '2022-03-22 00:14:09', '2022-03-22 00:14:18'),
(12, 'withdraw_method', '[]', '2022-03-30 09:03:12', '2022-03-30 09:03:12'),
(13, 'withdraw_method', '{\"bank_name\":{\"name\":\"Bank Name\",\"label\":\"bank_name\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"account_name\":{\"name\":\"Account Name\",\"label\":\"account_name\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"account_number\":{\"name\":\"Account Number\",\"label\":\"account_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"}}', '2022-03-30 09:09:11', '2022-09-28 04:05:20'),
(14, 'withdraw_method', '{\"mobile_number\":{\"name\":\"Mobile Number\",\"label\":\"mobile_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"}}', '2022-03-30 09:10:12', '2022-09-29 09:55:20'),
(15, 'manual_deposit', '{\"send_from_number\":{\"name\":\"Send From Number\",\"label\":\"send_from_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"transaction_number\":{\"name\":\"Transaction Number\",\"label\":\"transaction_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"screenshot\":{\"name\":\"Screenshot\",\"label\":\"screenshot\",\"is_required\":\"required\",\"extensions\":\"jpg,jpeg,png\",\"options\":[],\"type\":\"file\"}}', '2022-03-30 09:15:27', '2022-03-30 09:15:27'),
(16, 'manual_deposit', '{\"transaction_number\":{\"name\":\"Transaction Number\",\"label\":\"transaction_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"screenshot\":{\"name\":\"Screenshot\",\"label\":\"screenshot\",\"is_required\":\"required\",\"extensions\":\"jpg,pdf,docx\",\"options\":[],\"type\":\"file\"}}', '2022-03-30 09:16:43', '2022-04-11 03:19:54'),
(17, 'manual_deposit', '[]', '2022-03-30 09:21:19', '2022-03-30 09:21:19'),
(18, 'manual_deposit', '{\"asdfasddf\":{\"name\":\"asdfasddf\",\"label\":\"asdfasddf\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-09-28 04:50:55', '2022-09-28 04:50:55'),
(19, 'manual_deposit', '{\"sadf\":{\"name\":\"sadf\",\"label\":\"sadf\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"textarea\"}}', '2022-09-28 05:13:04', '2022-09-28 05:13:59'),
(20, 'manual_deposit', '{\"mobile_account\":{\"name\":\"Mobile Account\",\"label\":\"mobile_account\",\"is_required\":\"optional\",\"extensions\":null,\"options\":[],\"type\":\"text\"}}', '2023-05-14 23:30:41', '2023-05-18 01:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_keys` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"website\",\"services\",\"smm\",\"social media manager\"],\"description\":\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit\",\"social_title\":\"SMM\",\"social_description\":\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit ff\",\"image\":\"5fa397a629bee1604556710.jpg\"}', '2020-07-04 23:42:52', '2023-05-15 23:10:35'),
(24, 'about.content', '{\"has_image\":\"1\",\"top_heading\":\"About us\",\"heading\":\"What\'s so Special About Our SMM Website?\",\"description1\":\"Social media marketing (SMM) has become an essential component of any successful marketing strategy. With over 4.7 billion active users on social media platforms, it\\u2019s clear that SMM has immense potential diverse audience.\",\"description2\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media.\",\"about_btn\":\"View More\",\"about_image\":\"645cd0199cabb1683804185.jpg\"}', '2020-10-28 00:51:20', '2023-05-11 05:30:02'),
(25, 'blog.content', '{\"top_heading\":\"Blog\",\"heading\":\"News and  Feeds\",\"sub_heading\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media platforms, businesses can take.\"}', '2020-10-28 00:51:34', '2023-05-13 02:29:33'),
(26, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Photoshop Create Path From Image.\",\"description\":\"<p>Creating a path from an image in Adobe Photoshop allows you to create a precise selection based on the outline of an object or shape in the image. Paths are useful for various tasks, such as creating selections, applying special effects, or defining shapes for vector-based work. Here\'s how you can create a path from an image in Photoshop:<\\/p><p>\\u00a0<\\/p><p><strong>Photoshop Create Path From Image Steps:<\\/strong><\\/p><ul><li>Open Adobe Photoshop and open the image you want to work with.<\\/li><li>Make sure the Layers panel is visible (if not, go to \\\"Window\\\" in the top menu and select \\\"Layers\\\" to display it).<\\/li><li>In the Layers panel, right-click on the layer containing the image and choose \\\"Duplicate Layer.\\\" This step is optional but recommended to work on a\\u00a0<\\/li><li>separate layer to preserve the original image.<\\/li><li>With the duplicated layer selected, click on the \\\"Paths\\\" tab, usually located alongside the Layers tab.<\\/li><li>Click on the \\\"Create new path\\\" button at the bottom of the Paths panel. This will create a new path named \\\"Work Path.\\\"<\\/li><li>Select the Pen Tool from the toolbar on the left side of the Photoshop interface (shortcut: press \\\"P\\\" on your keyboard).<\\/li><li>Zoom in on the area you want to start creating the path. It\'s easier to work on smaller segments rather than the entire path at once.<\\/li><li>Position the Pen Tool where you want to start the path, click to set the first anchor point, and then click and drag to create curved segments if needed.\\u00a0<\\/li><li>Each click sets an anchor point, and each click and drag creates a curve.<\\/li><li>Continue placing anchor points and adjusting the curves until you have traced the entire object or shape you want to create a path around. You can click and drag on anchor points to adjust the curves further.<\\/li><li>Once you have completed the path, you can adjust its properties using the options in the Paths panel. For example, you can change the path\'s color, stroke, or fill settings.<\\/li><li>To convert the path into a selection, go to the top menu and choose \\\"Select\\\" &gt; \\\"Load Selection.\\\" In the dialog box that appears, make sure \\\"Work Path\\\" is selected, and click \\\"OK.\\\"<\\/li><li>You can now use the selection for various purposes, such as applying adjustments, adding a layer mask, or copying the selection to a new layer.<\\/li><\\/ul><p>Remember, creating a path requires some practice and precision, especially when dealing with complex shapes. Don\'t worry if it takes a few attempts to get the hang of it. With time and experience, you\'ll become more comfortable and efficient with the Pen Tool and path creation in Photoshop.<\\/p>\",\"blog_btn\":\"Read More\",\"blog_image\":\"645f4ab5a59781683966645.jpg\"}', '2020-10-28 00:57:19', '2023-05-20 06:29:03'),
(27, 'contact_us.content', '{\"title\":\"Get in Touch with us.\",\"short_description\":\"Let\'s make something great together. We are trusted by over 5000+ clients. Join them by using our services and grow your business.\",\"email_address\":\"democompany@gmail.com\",\"contact_details\":\"15205 North Kierland Blvd.100 Old City House\",\"contact_number\":\"9876897689698\",\"latitude\":\"876768\",\"longitude\":\"67867868\",\"website_footer\":\"<p>@Copyright 2023 . All rights reserved.<\\/p>\"}', '2020-10-28 00:59:19', '2023-05-13 03:29:36'),
(28, 'counter.content', '{\"heading\":\"Clients\",\"subheading\":\"Auctor gravida vestibulu\"}', '2020-10-28 01:04:02', '2022-09-28 14:02:14'),
(31, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"fab fa-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', '2020-11-12 04:07:30', '2023-05-13 03:30:31'),
(33, 'feature.content', '{\"heading\":\"asdf\",\"sub_heading\":\"asdf\"}', '2021-01-03 23:40:54', '2021-01-03 23:40:55'),
(34, 'feature.element', '{\"title\":\"asdf\",\"description\":\"asdf\",\"feature_icon\":\"asdf\"}', '2021-01-03 23:41:02', '2021-01-03 23:41:02'),
(35, 'service.element', '{\"service_icon\":\"<i class=\\\"fab fa-youtube\\\"><\\/i>\",\"title\":\"Youtube\",\"description\":\"It\'s a popular platform for social media marketing services.\"}', '2021-03-06 01:12:10', '2023-05-13 00:28:37'),
(36, 'service.content', '{\"top_heading\":\"Services\",\"heading\":\"What We Provide.\",\"sub_heading\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media platforms, businesses can take.\"}', '2021-03-06 01:27:34', '2023-05-13 00:27:08'),
(39, 'banner.content', '{\"has_image\":\"1\",\"top_heading\":\"Disruptive Marketing Solution.\",\"heading\":\"Drive Your Business Growth with Our SMM Expertise.\",\"sub_heading\":\"The platform could also include social features, allowing users to share their experiences with friends and family on social media and potentially driving word-of-mouth marketing.\",\"banner_button\":\"Get Started\",\"banner_image\":\"645cc88c10cf91683802252.png\",\"banner_social_image1\":\"645cc9d692dc01683802582.png\",\"banner_social_image2\":\"645cc9d69c3611683802582.png\",\"banner_social_image3\":\"645cc9d6a40291683802582.png\"}', '2021-05-02 06:09:30', '2023-05-11 04:56:22'),
(41, 'cookie.data', '{\"short_desc\":\"We use cookies to enhance your browsing experience, serve personalized ads or content, and analyze our traffic. By clicking \\\"Accept\\\", you consent to our use of cookies.\",\"description\":\"<h4>GDPR, cookies and compliance&nbsp;<\\/h4><ul><li>The&nbsp;General Data Protection Regulation (GDPR)&nbsp;is an EU legislation that governs all collection and processing of personal data from individuals inside the EU.<\\/li><li>Under the EU\\u2019s GDPR, it is the&nbsp;legal responsibility of website owners and operators&nbsp;to make sure that personal data is collected and processed lawfully.<\\/li><li>A website outside of the EU is required to comply with the GDPR if it collects&nbsp;data from users inside the EU.<\\/li><\\/ul><p>qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?<\\/p>\",\"status\":0}', '2020-07-04 23:42:52', '2023-05-29 07:57:05'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<h3><strong>Sed ut perspiciatis unde omnis iste\\u00a0<\\/strong><\\/h3><p>natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est.<\\/p><h3><strong>Nisi ut aliquid ex ea commodi consequatur<\\/strong><\\/h3><p>qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?<\\/p><h3><strong>Sed ut perspiciatis unde omnis iste\\u00a0<\\/strong><\\/h3><ul><li>Consequuntur quia consequuntur\\u00a0<\\/li><li>Eos qui ratione voluptatem\\u00a0<\\/li><li>Dolores eos qui ratione voluptatem<\\/li><li>Quis autem vel eum iure\\u00a0<\\/li><\\/ul><h3><strong>Nisi ut aliquid ex ea commodi consequatur<\\/strong><\\/h3><ul><li>Consequuntur quia consequuntur\\u00a0<\\/li><li>Eos qui ratione voluptatem\\u00a0<\\/li><li>Dolores eos qui ratione voluptatem<\\/li><li>Quis autem vel eum iure\\u00a0<\\/li><\\/ul><h3><strong>Sed ut perspiciatis unde omnis iste\\u00a0<\\/strong><\\/h3><p>natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est.\\u00a0<\\/p><h3><strong>Nisi ut aliquid ex ea commodi consequatur<\\/strong><\\/h3><p>qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?<\\/p>\"}', '2021-06-09 08:50:42', '2023-05-29 05:46:37'),
(43, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<h3>Sed ut perspiciatis unde omnis iste\\u00a0<\\/h3><p>natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est.<\\/p><h3>Nisi ut aliquid ex ea commodi consequatur<\\/h3><p>qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?<\\/p><h3>Sed ut perspiciatis unde omnis iste\\u00a0<\\/h3><ul><li>Consequuntur quia consequuntur\\u00a0<\\/li><li>Eos qui ratione voluptatem\\u00a0<\\/li><li>Dolores eos qui ratione voluptatem<\\/li><li>Quis autem vel eum iure\\u00a0<\\/li><\\/ul><h3>Nisi ut aliquid ex ea commodi consequatur<\\/h3><ul><li>Consequuntur quia consequuntur\\u00a0<\\/li><li>Eos qui ratione voluptatem\\u00a0<\\/li><li>Dolores eos qui ratione voluptatem<\\/li><li>Quis autem vel eum iure\\u00a0<\\/li><\\/ul><h3>Sed ut perspiciatis unde omnis iste\\u00a0<\\/h3><p>natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est.\\u00a0<\\/p><h3>Nisi ut aliquid ex ea commodi consequatur<\\/h3><p>qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?<\\/p>\"}', '2021-06-09 08:51:18', '2023-05-29 05:50:06'),
(44, 'maintenance.data', '{\"description\":\"<div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"text-align: center; font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"text-align: center; margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div>\"}', '2020-07-04 23:42:52', '2022-05-11 03:57:17'),
(45, 'feature.element', '{\"title\":\"sytry\",\"description\":\"ertyerty\",\"feature_icon\":\"<i class=\\\"fas fa-address-book\\\"><\\/i>\"}', '2022-10-17 10:23:22', '2022-10-17 10:23:22'),
(46, 'feature.element', '{\"title\":\"sytry\",\"description\":\"ertyerty\",\"feature_icon\":\"<i class=\\\"fas fa-address-book\\\"><\\/i>\"}', '2022-10-17 10:23:22', '2022-10-17 10:23:22'),
(51, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Photoshop Create Path From Image.\",\"description\":\"<p>Creating a path from an image in Adobe Photoshop allows you to create a precise selection based on the outline of an object or shape in the image. Paths are useful for various tasks, such as creating selections, applying special effects, or defining shapes for vector-based work. Here\'s how you can create a path from an image in Photoshop:<\\/p><p>\\u00a0<\\/p><p><strong>Photoshop Create Path From Image Steps:<\\/strong><\\/p><ul><li>Open Adobe Photoshop and open the image you want to work with.<\\/li><li>Make sure the Layers panel is visible (if not, go to \\\"Window\\\" in the top menu and select \\\"Layers\\\" to display it).<\\/li><li>In the Layers panel, right-click on the layer containing the image and choose \\\"Duplicate Layer.\\\" This step is optional but recommended to work on a\\u00a0<\\/li><li>separate layer to preserve the original image.<\\/li><li>With the duplicated layer selected, click on the \\\"Paths\\\" tab, usually located alongside the Layers tab.<\\/li><li>Click on the \\\"Create new path\\\" button at the bottom of the Paths panel. This will create a new path named \\\"Work Path.\\\"<\\/li><li>Select the Pen Tool from the toolbar on the left side of the Photoshop interface (shortcut: press \\\"P\\\" on your keyboard).<\\/li><li>Zoom in on the area you want to start creating the path. It\'s easier to work on smaller segments rather than the entire path at once.<\\/li><li>Position the Pen Tool where you want to start the path, click to set the first anchor point, and then click and drag to create curved segments if needed.\\u00a0<\\/li><li>Each click sets an anchor point, and each click and drag creates a curve.<\\/li><li>Continue placing anchor points and adjusting the curves until you have traced the entire object or shape you want to create a path around. You can click and drag on anchor points to adjust the curves further.<\\/li><li>Once you have completed the path, you can adjust its properties using the options in the Paths panel. For example, you can change the path\'s color, stroke, or fill settings.<\\/li><li>To convert the path into a selection, go to the top menu and choose \\\"Select\\\" &gt; \\\"Load Selection.\\\" In the dialog box that appears, make sure \\\"Work Path\\\" is selected, and click \\\"OK.\\\"<\\/li><li>You can now use the selection for various purposes, such as applying adjustments, adding a layer mask, or copying the selection to a new layer.<\\/li><\\/ul><p>Remember, creating a path requires some practice and precision, especially when dealing with complex shapes. Don\'t worry if it takes a few attempts to get the hang of it. With time and experience, you\'ll become more comfortable and efficient with the Pen Tool and path creation in Photoshop.<\\/p>\",\"blog_btn\":\"Read More\",\"blog_image\":\"645f4afa3a9171683966714.jpg\"}', '2023-03-21 08:45:08', '2023-05-20 06:29:40'),
(52, 'choose_us.content', '{\"top_heading\":\"Why Choose us\",\"heading\":\"Why you choose ous SMM Services?\",\"sub_heading\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media platforms, businesses can take.\"}', '2023-05-11 05:32:44', '2023-05-11 05:32:44'),
(53, 'choose_us.element', '{\"service_icon\":\"<i class=\\\"far fa-thumbs-up\\\"><\\/i>\",\"title\":\"Outstanding services\",\"description\":\"Outstanding services are the hallmark of a great business. Customers expect a high level of service, they are more likely to become loyal patrons.\"}', '2023-05-11 05:33:04', '2023-05-11 05:33:04'),
(54, 'choose_us.element', '{\"service_icon\":\"<i class=\\\"fas fa-hand-holding-usd\\\"><\\/i>\",\"title\":\"Various payment methods\",\"description\":\"Outstanding services are the hallmark of a great business. Customers expect a high level of service, they are more likely to become loyal patrons.\"}', '2023-05-11 05:33:47', '2023-05-11 05:33:47'),
(55, 'choose_us.element', '{\"service_icon\":\"<i class=\\\"fas fa-truck\\\"><\\/i>\",\"title\":\"Delivered promptly\",\"description\":\"Outstanding services are the hallmark of a great business. Customers expect a high level of service, they are more likely to become loyal patrons.\"}', '2023-05-11 05:34:02', '2023-05-11 05:34:02'),
(56, 'choose_us.element', '{\"service_icon\":\"<i class=\\\"fas fa-chart-line\\\"><\\/i>\",\"title\":\"Incredible prices\",\"description\":\"Outstanding services are the hallmark of a great business. Customers expect a high level of service, they are more likely to become loyal patrons.\"}', '2023-05-11 05:34:22', '2023-05-11 05:34:22'),
(57, 'where_to_begin.content', '{\"top_heading\":\"Begin\",\"heading\":\"Where to begin ?\",\"sub_heading\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media platforms, businesses can take.\"}', '2023-05-11 05:48:23', '2023-05-11 05:48:23'),
(58, 'where_to_begin.element', '{\"service_icon\":\"<i class=\\\"fas fa-sign-in-alt\\\"><\\/i>\",\"title\":\"Register and log in\",\"description\":\"Register an account on our panel and then log in.\"}', '2023-05-11 05:48:45', '2023-05-11 05:48:45'),
(59, 'where_to_begin.element', '{\"service_icon\":\"<i class=\\\"fas fa-dollar-sign\\\"><\\/i>\",\"title\":\"Make a deposit\",\"description\":\"In publishing and graphic design, Lorem ipsum\"}', '2023-05-11 05:49:48', '2023-05-11 05:49:48'),
(60, 'where_to_begin.element', '{\"service_icon\":\"<i class=\\\"fas fa-align-justify\\\"><\\/i>\",\"title\":\"Choose services\",\"description\":\"In publishing and graphic design, Lorem ipsum\"}', '2023-05-11 05:50:12', '2023-05-11 05:51:31'),
(61, 'where_to_begin.element', '{\"service_icon\":\"<i class=\\\"fas fa-align-left\\\"><\\/i>\",\"title\":\"Enjoy superb results\",\"description\":\"In publishing and graphic design, Lorem ipsum\"}', '2023-05-11 05:51:01', '2023-05-11 05:51:01'),
(62, 'subscribe.content', '{\"top_heading\":\"News Letter\",\"heading\":\"Subscribe our newsletter\",\"sub_heading\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media platforms, businesses can take.\"}', '2023-05-13 00:19:50', '2023-05-13 00:19:50'),
(63, 'service.element', '{\"service_icon\":\"<i class=\\\"fab fa-pinterest-p\\\"><\\/i>\",\"title\":\"Pinterest\",\"description\":\"It\'s a popular platform for social media marketing services.\"}', '2023-05-13 00:29:08', '2023-05-13 00:29:08'),
(64, 'service.element', '{\"service_icon\":\"<i class=\\\"fab fa-facebook-f\\\"><\\/i>\",\"title\":\"facebook\",\"description\":\"It\'s a popular platform for social media marketing services.\"}', '2023-05-13 00:29:22', '2023-05-13 00:29:22'),
(65, 'service.element', '{\"service_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"title\":\"Instagram\",\"description\":\"It\'s a popular platform for social media marketing services.\"}', '2023-05-13 00:29:48', '2023-05-13 00:29:48'),
(66, 'service.element', '{\"service_icon\":\"<i class=\\\"fab fa-reddit\\\"><\\/i>\",\"title\":\"Reddit\",\"description\":\"It\'s a popular platform for social media marketing services.\"}', '2023-05-13 00:30:02', '2023-05-13 00:30:02'),
(67, 'service.element', '{\"service_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"title\":\"Twitter\",\"description\":\"It\'s a popular platform for social media marketing services.\"}', '2023-05-13 00:30:18', '2023-05-13 00:30:18'),
(68, 'service.element', '{\"service_icon\":\"<i class=\\\"fab fa-snapchat-ghost\\\"><\\/i>\",\"title\":\"Snapchat\",\"description\":\"It\'s a popular platform for social media marketing services.\"}', '2023-05-13 00:31:36', '2023-05-13 00:31:36'),
(69, 'service.element', '{\"service_icon\":\"<i class=\\\"fab fa-linkedin-in\\\"><\\/i>\",\"title\":\"LinkedIn\",\"description\":\"It\'s a popular platform for social media marketing services.\"}', '2023-05-13 00:32:46', '2023-05-13 00:32:46'),
(70, 'package.content', '{\"top_heading\":\"SMM Packages\",\"heading\":\"Our Top SMM Packages\",\"sub_heading\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media platforms, businesses can take.\"}', '2023-05-13 00:42:43', '2023-05-13 00:44:37'),
(71, 'faq.content', '{\"top_heading\":\"FAQ\",\"heading\":\"Frequently Asked Question\",\"sub_heading\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media platforms, businesses can take.\"}', '2023-05-13 00:57:51', '2023-05-13 00:57:51'),
(72, 'faq.element', '{\"question\":\"What does Social Media Marketing (SMM) mean?\",\"answer\":\"<p>\\u00a0 Yes, we offer custom software development services tailored to the specific needs of our clients. We work closely with our clients to understand their requirements and develop solutions that meet their unique needs.<\\/p>\"}', '2023-05-13 00:58:32', '2023-05-13 00:58:32'),
(73, 'faq.element', '{\"question\":\"Which is the Best SMM Panel?\",\"answer\":\"<p>\\u00a0 Yes, we offer custom software development services tailored to the specific needs of our clients. We work closely with our clients to understand their requirements and develop solutions that meet their unique needs.<\\/p>\"}', '2023-05-13 00:58:42', '2023-05-13 00:58:42'),
(74, 'faq.element', '{\"question\":\"How can YouTube growth services help me?\",\"answer\":\"<p>\\u00a0Yes, we offer custom software development services tailored to the specific needs of our clients. We work closely with our clients to understand their requirements and develop solutions that meet their unique needs.<\\/p>\"}', '2023-05-13 00:58:54', '2023-05-13 00:58:54'),
(75, 'faq.element', '{\"question\":\"Which is the Best SMM Service?\",\"answer\":\"<p>\\u00a0Yes, we offer custom software development services tailored to the specific needs of our clients. We work closely with our clients to understand their requirements and develop solutions that meet their unique needs.<\\/p>\"}', '2023-05-13 00:59:07', '2023-05-13 00:59:07'),
(76, 'testimonial.content', '{\"top_heading\":\"Testimonials\",\"heading\":\"Don\'t Believe Me Check Client Says\",\"subheading\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media platforms, businesses can take.\"}', '2023-05-13 01:07:15', '2023-05-13 01:07:15'),
(77, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Javicerillos\",\"designation\":\"CEO and Founder\",\"description\":\"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur culpa magni, recusandae beatae provident nesciunt, quam corrupti rerum quod voluptatibus alias id!\",\"star_count\":\"2\",\"testimonial_image\":\"645f37c3e6cfe1683961795.png\"}', '2023-05-13 01:09:03', '2023-05-13 01:09:55'),
(78, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Javicerillos\",\"designation\":\"CEO and Founder\",\"description\":\"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur culpa magni, recusandae beatae provident nesciunt, quam corrupti rerum quod voluptatibus alias id!\",\"star_count\":\"5\",\"testimonial_image\":\"645f38021ae961683961858.png\"}', '2023-05-13 01:10:28', '2023-05-13 01:10:58'),
(79, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Javicerillos\",\"designation\":\"CEO and Founder\",\"description\":\"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur culpa magni, recusandae beatae provident nesciunt, quam corrupti rerum quod voluptatibus alias id!\",\"star_count\":\"5\",\"testimonial_image\":\"645f37fc249541683961852.png\"}', '2023-05-13 01:10:52', '2023-05-13 01:10:52'),
(80, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Javicerillos\",\"designation\":\"CEO and Founder\",\"description\":\"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur culpa magni, recusandae beatae provident nesciunt, quam corrupti rerum quod voluptatibus alias id!\",\"star_count\":\"4\",\"testimonial_image\":\"645f381b575ae1683961883.png\"}', '2023-05-13 01:11:23', '2023-05-13 01:11:23'),
(81, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Photoshop Create Path From Image\",\"description\":\"<p>Creating a path from an image in Adobe Photoshop allows you to create a precise selection based on the outline of an object or shape in the image. Paths are useful for various tasks, such as creating selections, applying special effects, or defining shapes for vector-based work. Here\'s how you can create a path from an image in Photoshop:<\\/p><p>\\u00a0<\\/p><p><strong>Photoshop Create Path From Image Steps:<\\/strong><\\/p><ul><li>Open Adobe Photoshop and open the image you want to work with.<\\/li><li>Make sure the Layers panel is visible (if not, go to \\\"Window\\\" in the top menu and select \\\"Layers\\\" to display it).<\\/li><li>In the Layers panel, right-click on the layer containing the image and choose \\\"Duplicate Layer.\\\" This step is optional but recommended to work on a\\u00a0<\\/li><li>separate layer to preserve the original image.<\\/li><li>With the duplicated layer selected, click on the \\\"Paths\\\" tab, usually located alongside the Layers tab.<\\/li><li>Click on the \\\"Create new path\\\" button at the bottom of the Paths panel. This will create a new path named \\\"Work Path.\\\"<\\/li><li>Select the Pen Tool from the toolbar on the left side of the Photoshop interface (shortcut: press \\\"P\\\" on your keyboard).<\\/li><li>Zoom in on the area you want to start creating the path. It\'s easier to work on smaller segments rather than the entire path at once.<\\/li><li>Position the Pen Tool where you want to start the path, click to set the first anchor point, and then click and drag to create curved segments if needed.\\u00a0<\\/li><li>Each click sets an anchor point, and each click and drag creates a curve.<\\/li><li>Continue placing anchor points and adjusting the curves until you have traced the entire object or shape you want to create a path around. You can click and drag on anchor points to adjust the curves further.<\\/li><li>Once you have completed the path, you can adjust its properties using the options in the Paths panel. For example, you can change the path\'s color, stroke, or fill settings.<\\/li><li>To convert the path into a selection, go to the top menu and choose \\\"Select\\\" &gt; \\\"Load Selection.\\\" In the dialog box that appears, make sure \\\"Work Path\\\" is selected, and click \\\"OK.\\\"<\\/li><li>You can now use the selection for various purposes, such as applying adjustments, adding a layer mask, or copying the selection to a new layer.<\\/li><\\/ul><p>Remember, creating a path requires some practice and precision, especially when dealing with complex shapes. Don\'t worry if it takes a few attempts to get the hang of it. With time and experience, you\'ll become more comfortable and efficient with the Pen Tool and path creation in Photoshop.<\\/p>\",\"blog_btn\":\"Read More\",\"blog_image\":\"645f4b2e454f31683966766.jpg\"}', '2023-05-13 02:32:25', '2023-05-20 06:30:26'),
(82, 'payment_method.content', '{\"top_heading\":\"Payment Methods\",\"heading\":\"Our Supported Payment Methods\",\"sub_heading\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media platforms, businesses can take.\"}', '2023-05-13 02:46:53', '2023-05-13 02:46:53'),
(83, 'payment_method.element', '{\"has_image\":[\"1\"],\"title\":\"Visa\",\"method_logo\":\"645f51f5218e71683968501.png\"}', '2023-05-13 02:47:24', '2023-05-13 03:01:41'),
(84, 'payment_method.element', '{\"has_image\":[\"1\"],\"title\":\"Mastercard\",\"method_logo\":\"645f53c2f2ee21683968962.png\"}', '2023-05-13 02:47:40', '2023-05-13 03:09:23'),
(86, 'payment_method.element', '{\"has_image\":[\"1\"],\"title\":\"Skrill\",\"method_logo\":\"645f53d91fa2b1683968985.png\"}', '2023-05-13 02:48:13', '2023-05-13 03:09:45'),
(87, 'payment_method.element', '{\"has_image\":[\"1\"],\"title\":\"Payeer\",\"method_logo\":\"645f53e5da7021683968997.png\"}', '2023-05-13 02:48:27', '2023-05-13 03:09:57'),
(90, 'counter.element', '{\"title\":\"Customer Support\",\"counter_digit\":\"23\",\"counter_icon\":\"<i class=\\\"fas fa-headset\\\"><\\/i>\"}', '2023-05-13 03:13:01', '2023-05-13 03:20:01'),
(91, 'counter.element', '{\"title\":\"Total Active Users\",\"counter_digit\":\"350\",\"counter_icon\":\"<i class=\\\"fas fa-user-check\\\"><\\/i>\"}', '2023-05-13 03:13:20', '2023-05-13 03:13:20'),
(92, 'counter.element', '{\"title\":\"Completed Orders\",\"counter_digit\":\"500\",\"counter_icon\":\"<i class=\\\"fas fa-bars\\\"><\\/i>\"}', '2023-05-13 03:13:45', '2023-05-13 03:13:45'),
(93, 'counter.element', '{\"title\":\"Our Happy Clients\",\"counter_digit\":\"400\",\"counter_icon\":\"<i class=\\\"fas fa-user\\\"><\\/i>\"}', '2023-05-13 03:14:26', '2023-05-13 03:14:26'),
(94, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', '2023-05-13 03:31:10', '2023-05-13 03:31:10'),
(95, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/twitter.com\\/\"}', '2023-05-13 03:31:48', '2023-05-13 03:31:48'),
(96, 'social_icon.element', '{\"title\":\"LinkedIn\",\"social_icon\":\"<i class=\\\"fab fa-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', '2023-05-13 03:32:31', '2023-05-13 03:32:31'),
(97, 'footer_important_links.element', '{\"title\":\"Services\",\"url\":\"\\/services\"}', '2023-05-13 03:36:35', '2023-05-13 03:36:35'),
(98, 'footer_important_links.element', '{\"title\":\"Contact\",\"url\":\"\\/contact\"}', '2023-05-13 03:36:46', '2023-05-13 03:36:46'),
(99, 'footer_important_links.element', '{\"title\":\"Login\",\"url\":\"\\/login\"}', '2023-05-13 03:38:31', '2023-05-13 03:38:31'),
(100, 'footer_important_links.element', '{\"title\":\"Registration\",\"url\":\"\\/register\"}', '2023-05-13 03:38:49', '2023-05-13 03:38:49'),
(101, 'brand_package.content', '{\"top_heading\":\"Packages\",\"heading\":\"Our Branding Packages\",\"sub_heading\":\"Furthermore, SMM provides valuable insights into customer behavior and preferences. With analytics tools provided by social media platforms, businesses can take.\"}', '2023-05-21 03:28:47', '2023-05-29 07:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `code` int(10) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-58ira22618401@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-11-26 08:03:45'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"---------------------\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-11-26 07:50:01'),
(3, 0, 105, 'PayTM', 'Paytm', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"-----------\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"--------------------\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"example.com\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-11-26 08:10:37'),
(4, 0, 107, 'PayStack', 'Paystack', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"--------\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 13:14:22', '2022-11-26 07:49:18'),
(5, 0, 108, 'VoguePay', 'Voguepay', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"-------------------\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-11-26 07:50:14'),
(6, 0, 109, 'Flutterwave', 'Flutterwave', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-06-05 11:37:45'),
(7, 0, 110, 'RazorPay', 'Razorpay', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"------------\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"--------\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:51:32'),
(8, 0, 112, 'Instamojo', 'Instamojo', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"------------\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"---------\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"-------\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-11-26 08:00:15'),
(9, 0, 503, 'CoinPayments', 'Coinpayments', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"----------------\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2022-10-29 07:29:51'),
(10, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"---------\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 13:14:22', '2022-10-29 07:29:48'),
(11, 0, 113, 'Paypal Express', 'PaypalSdk', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"------------\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"-----------\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-20 23:01:08'),
(12, 0, 114, 'Stripe Checkout', 'StripeV3', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51M8Ks2CL65BWuH7eCBcWsLP2yPfWaLtfJVxG3zfii7cCWJE1izM4jkhucmBSm6izmVtSGZyp0JDYYCVmx9E4WmQY004gfnctzD\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51M8Ks2CL65BWuH7eju6khGxJMpeeFuw2Rwrjr8UYCz6ZnQ3PiFxb1gVu1i1dBto9MQrnjkBimHkFJgNcqsrJHTak0010kCY41h\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"abcd\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 13:14:22', '2022-12-18 08:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int(10) DEFAULT NULL,
  `gateway_alias` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `max_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `percent_charge` decimal(5,2) NOT NULL DEFAULT 0.00,
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_parameter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email configuration',
  `sms_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `global_shortcodes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT 0,
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `force_ssl` tinyint(1) NOT NULL DEFAULT 0,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT 0,
  `secure_password` tinyint(1) NOT NULL DEFAULT 0,
  `agree` tinyint(1) NOT NULL DEFAULT 0,
  `registration` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_cron` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_template`, `sms_body`, `sms_from`, `base_color`, `secondary_color`, `mail_config`, `sms_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `force_ssl`, `maintenance_mode`, `secure_password`, `agree`, `registration`, `active_template`, `system_info`, `last_cron`, `created_at`, `updated_at`) VALUES
(1, 'SMM', 'USD', '$', 'notify@wstacks.com', '<p>Hi {{fullname}} ({{username}}),&nbsp;</p><p>{{message}}</p>', 'Hi {{fullname}} ({{username}}), \r\n{{message}}', 'Admin', '72ce40', '72ce40', '{\"name\":\"php\"}', '{\"name\":\"messageBird\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 0, 1, 1, 0, 0, 0, 0, 0, 1, 1, 'default', '[]', '2023-07-31 12:29:39', NULL, '2023-08-01 07:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_align` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: left to right text align, 1: right to left text align',
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `text_align`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '5f15968db08911595250317.png', 0, 1, '2020-07-06 03:47:55', '2022-09-29 10:36:14'),
(14, 'Spanish', 'es', NULL, 0, 0, '2023-02-15 11:06:57', '2023-02-15 11:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sender` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcodes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT 1,
  `sms_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'BAL_ADD', 'Balance - Added', 'Your Account has been Credited', '<div><div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been added to your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}&nbsp;</span></font><br></div><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin note:&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 12px; font-weight: 600; white-space: nowrap; text-align: var(--bs-body-text-align);\">{{remark}}</span></div>', '{{amount}} {{site_currency}} credited in your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin note is \"{{remark}}\"', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 0, '2021-11-03 12:00:00', '2022-09-21 13:04:13'),
(2, 'BAL_SUB', 'Balance - Subtracted', 'Your Account has been Debited', '<div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been subtracted from your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}</span></font><br><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin Note: {{remark}}</div>', '{{amount}} {{site_currency}} debited from your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin Note is {{remark}}', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:24:11'),
(3, 'DEPOSIT_COMPLETE', 'Deposit - Automated - Successful', 'Deposit Completed Successfully', '<div>Your deposit of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been completed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Received : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit successfully by {{method_name}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:25:43'),
(4, 'DEPOSIT_APPROVE', 'Deposit - Manual - Approved', 'Your Deposit is Approved', '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>is Approved .<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Admin Approve Your {{amount}} {{site_currency}} payment request by {{method_name}} transaction : {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:26:07'),
(5, 'DEPOSIT_REJECT', 'Deposit - Manual - Rejected', 'Your Deposit Request is Rejected', '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}} has been rejected</span>.<span style=\"font-weight: bolder;\"><br></span></div><div><br></div><div><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge: {{charge}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number was : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">if you have any queries, feel free to contact us.<br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><br><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">{{rejection_message}}</span><br>', 'Admin Rejected Your {{amount}} {{site_currency}} payment request by {{method_name}}\r\n\r\n{{rejection_message}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"rejection_message\":\"Rejection message by the admin\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:45:27'),
(6, 'DEPOSIT_REQUEST', 'Deposit - Manual - Requested', 'Deposit Request Submitted Successfully', '<div>Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>submitted successfully<span style=\"font-weight: bolder;\">&nbsp;.<br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit requested by {{method_name}}. Charge: {{charge}} . Trx: {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:29:19'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:46:35'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', '{\"code\":\"Email verification code\"}', 1, 0, '2021-11-03 12:00:00', '2022-04-03 02:32:07'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', '---', 'Your phone verification code is: {{code}}', '{\"code\":\"SMS Verification Code\"}', 0, 1, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', '{{message}}', '{{message}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(18, 'ORDER PLACE', 'Subscribe Service', '<p>You\'ve subscribed to <strong>{{order_name}}</strong> order. The price <strong>{{amount}} {{currency}}</strong>. The transaction number is #<strong>{{trx}}</strong>. Your current is<strong> {{post_balance}} {{currency}}</strong></p>', 'You\'ve subscribed to {{order_name}} order. The price {{amount}} {{currency}}. The transaction number is #{{trx}}. Your current is {{post_balance}} {{currency}}', 'You\'ve subscribed to {{order_name}} order. The price {{amount}} {{currency}}. The transaction number is #{{trx}}. Your current is {{post_balance}} {{currency}}', '{\"amount\":\"Price of the order\",\"order_name\":\"Name of order\",\"trx\":\"Transaction number\",\"post_balance\":\"Balance after transactions\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(19, 'BRAND PACKAGE ORDER PLACE', 'Brand Package Order', '<p>You\'ve subscribed to <strong>{{order_name}}</strong> order. The price <strong>{{amount}} {{currency}}</strong>. The transaction number is #<strong>{{trx}}</strong>. Your current is<strong> {{post_balance}} {{currency}}</strong></p>', 'You\'ve subscribed to {{order_name}} order. The price {{amount}} {{currency}}. The transaction number is #{{trx}}. Your current is {{post_balance}} {{currency}}', 'You\'ve subscribed to {{order_name}} order. The price {{amount}} {{currency}}. The transaction number is #{{trx}}. Your current is {{post_balance}} {{currency}}', '{\"amount\":\"Price of the order\",\"order_name\":\"Name of order\",\"trx\":\"Transaction number\",\"post_balance\":\"Balance after transactions\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(20, 'PENDING_ORDER', 'Pending Order', 'Thanks for your order', '<div>Thanks for your order.</div>\r\n<div>Username: {{username}}<br></div>\r\n<div>Your order for {{service_name}} is now pending. Order price {{price}} </div>\r\n', '<div>Thanks for your order.</div>\r\n<div>Username: {{username}}<br></div>\r\n<div>Your order for {{service_name}} is now pending. Order price {{price}} </div>', '{\"service_name\":\"Service Name\",\"price\":\"Service Price\",\"username\":\"Username\",\"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(21, 'PROCESSING_ORDER', 'Processing Order', 'Order processing', '<div>Thanks for your order.</div>\r\n<div>Username: {{username}}<br></div>\r\n<div>Your order for {{service_name}} is now processing. Order price {{price}} </div>\r\n', '<div>Thanks for your order.</div>\r\n<div>Username: {{username}}<br></div>\r\n<div>Your order for {{service_name}} is now processing. Order price {{price}} </div>', '{\"service_name\":\"Service Name\",\"price\":\"Service Price\",\"username\":\"Username\",\"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(22, 'COMPLETED_ORDER', 'Completed Order', 'Order completed', '<div>Thanks for your order.</div>\r\n<div>Username: {{username}}<br></div>\r\n<div>Your order for {{service_name}} is now completed. Order price {{price}} </div>\r\n', '<div>Thanks for your order.</div>\r\n<div>Username: {{username}}<br></div>\r\n<div>Your order for {{service_name}} is now completed. Order price {{price}} </div>', '{\"service_name\":\"Service Name\",\"price\":\"Service Price\",\"username\":\"Username\",\"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(23, 'CANCELLED_ORDER', 'Cancelled Order', 'Order cancelled', '<div>Thanks for your order.</div>\r\n<div>Username: {{username}}<br></div>\r\n<div>Your order for {{service_name}} is now cancelled. Order price {{price}} </div>\r\n', '<div>Thanks for your order.</div>\r\n<div>Username: {{username}}<br></div>\r\n<div>Your order for {{service_name}} is now cancelled. Order price {{price}} </div>', '{\"service_name\":\"Service Name\",\"price\":\"Service Price\",\"username\":\"Username\",\"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(24, 'REFUNDED_ORDER', 'Refunded Order', 'Order refunded', '<div>Thanks for your order.</div>\r\n<div>Username: {{username}}<br></div>\r\n<div>Your order for {{service_name}} is now refunded. Order price {{price}} </div>\r\n<div>Transaction ID: <b>{{trx}}</b></div><div>Your current balance: <b>{{post_balance}} {{currency}}</b></div></div>\r\n', '<div>Thanks for your order.</div>\r\n<div>Username: {{username}}<br></div>\r\n<div>Your order for {{service_name}} is now refunded. Order price {{price}} </div>\r\n<div>Transaction ID: <b>{{trx}}</b></div><div>Your current balance: <b>{{post_balance}} {{currency}}</b></div></div>', '{\"service_name\":\"Service Name\",\"price\":\"Service Price\",\"username\":\"Username\",\"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `service_id` varchar(255) NOT NULL,
  `api_service_id` int(11) NOT NULL DEFAULT 0,
  `api_provider_id` int(11) NOT NULL DEFAULT 0,
  `api_order` int(11) NOT NULL DEFAULT 0 COMMENT 'if api order then 1 ',
  `api_order_id` int(11) DEFAULT 0 COMMENT 'response order  like {\r\n    "order": 23501\r\n}',
  `order_placed_to_api` int(11) NOT NULL DEFAULT 0 COMMENT 'if api order place then 1 ',
  `user_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `price` decimal(28,8) NOT NULL,
  `quantity` int(11) NOT NULL,
  `start_count` int(11) DEFAULT NULL,
  `remain_count` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0=>Pending, \r\n1=> Processing, \r\n2=> Complete, \r\n3=> Cancelled, \r\n4=> Refunded	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', 'presets.default.', '[\"counter\",\"about\",\"brand_package\",\"service\",\"package\",\"choose_us\",\"where_to_begin\",\"subscribe\",\"faq\",\"testimonial\",\"blog\",\"payment_method\"]', 1, '2020-07-11 06:23:58', '2023-05-23 06:14:22'),
(4, 'About', 'about', 'presets.default.', '[\"about\",\"faq\"]', 1, '2020-10-22 01:14:43', '2023-05-15 04:35:26'),
(5, 'Blog', 'blog', 'presets.default.', '[\"blog\",\"service\"]', 1, '2020-10-22 01:14:53', '2023-05-15 04:42:08'),
(19, 'Services', 'services', 'presets.default.', NULL, 0, '2023-05-15 03:07:00', '2023-05-15 03:07:00'),
(20, 'Branding', 'brand-package', 'presets.default.', '[\"payment_method\"]', 0, '2023-05-15 04:30:44', '2023-05-29 07:55:19'),
(21, 'Contact', 'contact', 'presets.default.', NULL, 0, '2023-05-23 04:49:41', '2023-05-23 05:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(28,8) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `details` text DEFAULT NULL,
  `api_service_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `api_provider_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_message_id` int(10) UNSIGNED DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_ticket_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) DEFAULT 0,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `post_balance` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `trx_type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_by` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `balance` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'contains full address',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: banned, 1: active',
  `kv` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: KYC Unverified, 2: KYC pending, 1: KYC verified',
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: mobile unverified, 1: mobile verified',
  `reg_step` tinyint(1) NOT NULL DEFAULT 0,
  `ver_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_ip` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `user_ip`, `city`, `country`, `country_code`, `longitude`, `latitude`, `browser`, `os`, `created_at`, `updated_at`) VALUES
(1, 32, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-03-22 04:09:56', '2023-03-22 04:09:56'),
(2, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-13 06:40:57', '2023-05-13 06:40:57'),
(3, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-13 21:39:06', '2023-05-13 21:39:06'),
(4, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-13 23:56:14', '2023-05-13 23:56:14'),
(5, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-14 22:55:13', '2023-05-14 22:55:13'),
(6, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-15 23:23:01', '2023-05-15 23:23:01'),
(7, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-16 07:14:37', '2023-05-16 07:14:37'),
(8, 33, '127.0.0.1', '', '', '', '', '', 'Firefox', 'Windows 10', '2023-05-17 04:37:36', '2023-05-17 04:37:36'),
(9, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-17 23:05:49', '2023-05-17 23:05:49'),
(10, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-18 00:47:30', '2023-05-18 00:47:30'),
(11, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-20 00:06:34', '2023-05-20 00:06:34'),
(12, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-20 03:39:29', '2023-05-20 03:39:29'),
(13, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-20 23:48:06', '2023-05-20 23:48:06'),
(14, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-21 04:05:53', '2023-05-21 04:05:53'),
(15, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-21 23:45:07', '2023-05-21 23:45:07'),
(16, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-22 02:39:59', '2023-05-22 02:39:59'),
(17, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-22 07:31:26', '2023-05-22 07:31:26'),
(18, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-22 23:58:28', '2023-05-22 23:58:28'),
(19, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-23 01:06:31', '2023-05-23 01:06:31'),
(20, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-28 05:26:49', '2023-05-28 05:26:49'),
(21, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-05-29 06:20:12', '2023-05-29 06:20:12'),
(22, 33, '127.0.0.1', '', '', '', '', '', 'Firefox', 'Windows 10', '2023-05-29 07:15:30', '2023-05-29 07:15:30'),
(23, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-06-06 06:53:58', '2023-06-06 06:53:58'),
(24, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-06-11 01:01:28', '2023-06-11 01:01:28'),
(25, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-06-19 06:59:20', '2023-06-19 06:59:20'),
(26, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-07-30 01:07:39', '2023-07-30 01:07:39'),
(27, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-07-30 02:44:28', '2023-07-30 02:44:28'),
(28, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-07-31 03:37:42', '2023-07-31 03:37:42'),
(29, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-07-31 23:17:27', '2023-07-31 23:17:27'),
(30, 33, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Windows 10', '2023-08-04 23:38:39', '2023-08-04 23:38:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_providers`
--
ALTER TABLE `api_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_packages`
--
ALTER TABLE `brand_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_package_orders`
--
ALTER TABLE `brand_package_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_providers`
--
ALTER TABLE `api_providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand_packages`
--
ALTER TABLE `brand_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_package_orders`
--
ALTER TABLE `brand_package_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
