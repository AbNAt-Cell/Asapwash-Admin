-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2020 at 12:47 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carq`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_setting`
--

CREATE TABLE `admin_setting` (
  `id` int(11) NOT NULL,
  `phone_no` varchar(20) NOT NULL DEFAULT '+1 21456987',
  `admin_per` float NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT 'support@email.com',
  `address` text,
  `pp` text NOT NULL,
  `notification` int(11) NOT NULL DEFAULT '1',
  `currency_symbol` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '$',
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `time_slot_length` int(11) NOT NULL DEFAULT '60',
  `verification` int(11) NOT NULL DEFAULT '0',
  `sms_gateway` varchar(20) NOT NULL DEFAULT 'twilio',
  `country_code` varchar(4) NOT NULL DEFAULT '+1',
  `offline_payment` int(11) NOT NULL DEFAULT '1',
  `stipe_status` int(11) NOT NULL DEFAULT '0',
  `paypal_status` int(11) NOT NULL DEFAULT '0',
  `razor_status` int(11) NOT NULL DEFAULT '0',
  `ios_version` varchar(255) NOT NULL DEFAULT 'X.Y.Z',
  `android_version` varchar(255) NOT NULL DEFAULT 'X.Y.Z',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_setting`
--

INSERT INTO `admin_setting` (`id`, `phone_no`, `admin_per`, `email`, `address`, `pp`, `notification`, `currency_symbol`, `currency`, `time_slot_length`, `verification`, `sms_gateway`, `country_code`, `offline_payment`, `stipe_status`, `paypal_status`, `razor_status`, `ios_version`, `android_version`, `created_at`, `updated_at`) VALUES
(1, '+178788778772', 50, 'support@email.com', 'Hettinger Mews 4554 Tevin Meadows', '<h2 style=\"letter-spacing: normal; padding: 0px; font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 45px; line-height: 48px; margin: 24px 0px; color: rgb(97, 97, 97);\">Privacy Policy</h2><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">[Developer/Company name] built the [App Name] app as [open source/free/freemium/ad-supported/commercial] app. This SERVICE is provided by [Developer/Company name] [at no cost] and is intended for use as is.</p><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">This page is used to inform visitors regarding [my/our] policies with the collection, use, and disclosure of Personal Information if anyone decided to use [my/our] Service.</p><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">If you choose to use [my/our] Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that [I/We] collect is used for providing and improving the Service. [I/We] will not use or share your information with anyone except as described in this Privacy Policy.</p><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at [App Name] unless otherwise defined in this Privacy Policy.</p><div><strong style=\"letter-spacing: normal; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif; font-size: 14px;\">Information Collection and Use</strong></div><div><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">For a better experience, while using our Service, [I/We] may require you to provide us with certain personally identifiable information[add whatever else you collect here, e.g. users name, address, location, pictures] The information that [I/We] request will be [retained on your device and is not collected by [me/us] in any way]/[retained by us and used as described in this privacy policy].</p><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">The app does use third party services that may collect information used to identify you.</p><div style=\"letter-spacing: normal; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif; font-size: 14px;\"><p style=\"padding: 0px; line-height: 24px; letter-spacing: 0px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px;\">Link to privacy policy of third party service providers used by the app</p><ul style=\"letter-spacing: 0px; line-height: 24px;\"><li><a href=\"https://www.google.com/policies/privacy/\" target=\"_blank\" style=\"-webkit-tap-highlight-color: rgba(255, 255, 255, 0); color: rgb(68, 138, 255);\">Google Play Services</a></li></ul><p style=\"padding: 0px; line-height: 24px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px;\"><strong>Log Data</strong></p><p style=\"padding: 0px; line-height: 24px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px;\">[I/We] want to inform you that whenever you use [my/our] Service, in a case of an error in the app [I/We] collect data and information (through third party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol (“IP”) address, device name, operating system version, the configuration of the app when utilizing [my/our] Service, the time and date of your use of the Service, and other statistics.</p></div><br></div>', 0, '$', 'USD', 60, 0, 'twilio', '+1', 1, 1, 1, 1, '2.2.03', '20.2.2', NULL, '2020-06-18 10:07:39');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `address` text,
  `device_token` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `otp` varchar(6) DEFAULT '',
  `noti` int(11) NOT NULL DEFAULT '1',
  `verified` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_master`
--

CREATE TABLE `booking_master` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `admin_per` float NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `service_type` int(11) NOT NULL DEFAULT '0' COMMENT '0=home 1=shop',
  `amount` float NOT NULL,
  `discount` float NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_token` varchar(255) NOT NULL,
  `payment_method` varchar(10) NOT NULL DEFAULT 'Offline ',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT ' 0= wating 1= approved =2 complate 3=cancle 5= rejected ',
  `service` text NOT NULL COMMENT '1,2,3',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'default.png',
  `is_trending` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`, `is_trending`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Wash', '5ee47213a2b57.png', 1, 1, '2020-06-08 07:35:41', '2020-06-13 06:28:35', NULL),
(2, 'Interior Clean', '5efda938eaa84.png', 1, 1, '2020-07-02 09:30:32', '2020-07-02 09:30:32', NULL),
(3, 'Polishing', '5efda94dce5eb.png', 0, 1, '2020-07-02 09:30:53', '2020-07-02 09:30:53', NULL),
(4, 'Tire Dressing', '5efda9641e6bc.png', 0, 1, '2020-07-02 09:31:16', '2020-07-02 09:31:16', NULL),
(5, 'Engine Wash', '5efda973e33fa.png', 0, 1, '2020-07-02 09:31:31', '2020-07-02 09:31:31', NULL),
(6, 'Car Spray', '5efda9836c51d.png', 0, 1, '2020-07-02 09:31:47', '2020-07-02 09:31:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `code`, `symbol`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek'),
(2, 'America', 'Dollars', 'USD', '$'),
(3, 'Afghanistan', 'Afghanis', 'AFN', '؋'),
(4, 'Argentina', 'Pesos', 'ARS', '$'),
(5, 'Aruba', 'Guilders', 'AWG', 'Afl'),
(6, 'Australia', 'Dollars', 'AUD', '$'),
(7, 'Azerbaijan', 'New Manats', 'AZN', '₼'),
(8, 'Bahamas', 'Dollars', 'BSD', '$'),
(9, 'Barbados', 'Dollars', 'BBD', '$'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.'),
(11, 'Belgium', 'Euro', 'EUR', '€'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$'),
(13, 'Bermuda', 'Dollars', 'BMD', '$'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM'),
(16, 'Botswana', 'Pula', 'BWP', 'P'),
(17, 'Bulgaria', 'Leva', 'BGN', 'Лв.'),
(18, 'Brazil', 'Reais', 'BRL', 'R$'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£\r\n'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$'),
(21, 'Cambodia', 'Riels', 'KHR', '៛'),
(22, 'Canada', 'Dollars', 'CAD', '$'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$'),
(24, 'Chile', 'Pesos', 'CLP', '$'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥'),
(26, 'Colombia', 'Pesos', 'COP', '$'),
(27, 'Costa Rica', 'Colón', 'CRC', '₡'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn'),
(29, 'Cuba', 'Pesos', 'CUP', '₱'),
(30, 'Cyprus', 'Euro', 'EUR', '€'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'Kč'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr'),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$'),
(35, 'Egypt', 'Pounds', 'EGP', '£'),
(36, 'El Salvador', 'Colones', 'SVC', '$'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£'),
(38, 'Euro', 'Euro', 'EUR', '€'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£'),
(40, 'Fiji', 'Dollars', 'FJD', '$'),
(41, 'France', 'Euro', 'EUR', '€'),
(42, 'Ghana', 'Cedis', 'GHC', 'GH₵'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£'),
(44, 'Greece', 'Euro', 'EUR', '€'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q'),
(46, 'Guernsey', 'Pounds', 'GGP', '£'),
(47, 'Guyana', 'Dollars', 'GYD', '$'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr'),
(53, 'India', 'Rupees', 'INR', '₹'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp'),
(55, 'Iran', 'Rials', 'IRR', '﷼'),
(56, 'Ireland', 'Euro', 'EUR', '€'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£'),
(58, 'Israel', 'New Shekels', 'ILS', '₪'),
(59, 'Italy', 'Euro', 'EUR', '€'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$'),
(61, 'Japan', 'Yen', 'JPY', '¥'),
(62, 'Jersey', 'Pounds', 'JEP', '£'),
(63, 'Kazakhstan', 'Tenge', 'KZT', '₸'),
(64, 'Korea (North)', 'Won', 'KPW', '₩'),
(65, 'Korea (South)', 'Won', 'KRW', '₩'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', 'Лв'),
(67, 'Laos', 'Kips', 'LAK', '	₭'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls'),
(69, 'Lebanon', 'Pounds', 'LBP', '£'),
(70, 'Liberia', 'Dollars', 'LRD', '$'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt'),
(73, 'Luxembourg', 'Euro', 'EUR', '€'),
(74, 'Macedonia', 'Denars', 'MKD', 'Ден\r\n'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM'),
(76, 'Malta', 'Euro', 'EUR', '€'),
(77, 'Mauritius', 'Rupees', 'MUR', '₹'),
(78, 'Mexico', 'Pesos', 'MXN', '$'),
(79, 'Mongolia', 'Tugriks', 'MNT', '₮'),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT'),
(81, 'Namibia', 'Dollars', 'NAD', '$'),
(82, 'Nepal', 'Rupees', 'NPR', '₹'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ'),
(84, 'Netherlands', 'Euro', 'EUR', '€'),
(85, 'New Zealand', 'Dollars', 'NZD', '$'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$'),
(87, 'Nigeria', 'Nairas', 'NGN', '₦'),
(88, 'North Korea', 'Won', 'KPW', '₩'),
(89, 'Norway', 'Krone', 'NOK', 'kr'),
(90, 'Oman', 'Rials', 'OMR', '﷼'),
(91, 'Pakistan', 'Rupees', 'PKR', '₹'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs'),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php'),
(96, 'Poland', 'Zlotych', 'PLN', 'zł'),
(97, 'Qatar', 'Rials', 'QAR', '﷼'),
(98, 'Romania', 'New Lei', 'RON', 'lei'),
(99, 'Russia', 'Rubles', 'RUB', '₽'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '﷼'),
(102, 'Serbia', 'Dinars', 'RSD', 'ع.د'),
(103, 'Seychelles', 'Rupees', 'SCR', '₹'),
(104, 'Singapore', 'Dollars', 'SGD', '$'),
(105, 'Slovenia', 'Euro', 'EUR', '€'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$'),
(107, 'Somalia', 'Shillings', 'SOS', 'S'),
(108, 'South Africa', 'Rand', 'ZAR', 'R'),
(109, 'South Korea', 'Won', 'KRW', '₩'),
(110, 'Spain', 'Euro', 'EUR', '€'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '₹'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF'),
(114, 'Suriname', 'Dollars', 'SRD', '$'),
(115, 'Syria', 'Pounds', 'SYP', '£'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$'),
(117, 'Thailand', 'Baht', 'THB', '฿'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$'),
(119, 'Turkey', 'Lira', 'TRY', 'TL'),
(120, 'Turkey', 'Liras', 'TRL', '₺'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '₴'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£'),
(124, 'United States of America', 'Dollars', 'USD', '$'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U'),
(126, 'Uzbekistan', 'Sums', 'UZS', 'so\'m'),
(127, 'Vatican City', 'Euro', 'EUR', '€'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs'),
(129, 'Vietnam', 'Dong', 'VND', '₫\r\n'),
(130, 'Yemen', 'Rials', 'YER', '﷼'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(2, 'Privacy settings', 'Your privacy settings let you manage basic privacy preferences. For other stuff you share on Facebook, you can choose your audience right when you post. Learn more.', '2020-02-14 09:52:31', '2020-02-14 09:52:31'),
(3, 'sdfs', 'asdafsadf', '2020-06-10 05:59:35', '2020-06-10 05:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(7, '2016_06_01_000004_create_oauth_clients_table', 2),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notification_tbl`
--

CREATE TABLE `notification_tbl` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'VhDGADtwVZBPpzIevPsVCupKr3rgyZuAvmawRKR6', NULL, 'http://localhost', 1, 0, 0, '2020-06-08 03:36:59', '2020-06-08 03:36:59'),
(2, NULL, 'Laravel Password Grant Client', 'iVRe75jUoHhXtWx9eaZUu9iqS1Dtz9bmn5Unyanw', 'users', 'http://localhost', 0, 1, 0, '2020-06-08 03:37:00', '2020-06-08 03:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-06-08 03:36:59', '2020-06-08 03:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owner_shops`
--

CREATE TABLE `owner_shops` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `service_id` text,
  `package_id` text,
  `employee_id` text,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT 'default.png',
  `phone_no` varchar(50) DEFAULT NULL,
  `is_popular` int(11) NOT NULL DEFAULT '0',
  `is_best` int(11) NOT NULL DEFAULT '0',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `service_type` int(11) NOT NULL DEFAULT '2',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `service` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction`
--

CREATE TABLE `payment_transaction` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `admin_share` float NOT NULL,
  `owner_share` float NOT NULL,
  `payment` int(11) NOT NULL DEFAULT '0' COMMENT '0=online 1 = offline ',
  `shattle` int(11) NOT NULL DEFAULT '0' COMMENT '0=not 1=done = 2 =cancel ',
  `shattle_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(113, 'dashboard', NULL, NULL, NULL),
(114, 'role_access', NULL, NULL, NULL),
(115, 'role_create', NULL, NULL, NULL),
(116, 'role_edit', NULL, NULL, NULL),
(117, 'role_show', NULL, NULL, NULL),
(118, 'role_delete', NULL, NULL, NULL),
(119, 'user_access', NULL, NULL, NULL),
(120, 'user_create', NULL, NULL, NULL),
(121, 'user_edit', NULL, NULL, NULL),
(122, 'user_show', NULL, NULL, NULL),
(123, 'user_delete', NULL, NULL, NULL),
(124, 'category_access', NULL, NULL, NULL),
(125, 'category_create', NULL, NULL, NULL),
(126, 'category_edit', NULL, NULL, NULL),
(127, 'category_show', NULL, NULL, NULL),
(128, 'category_delete', NULL, NULL, NULL),
(129, 'setting_access', NULL, NULL, NULL),
(130, 'privacy_access', NULL, NULL, NULL),
(131, 'privacy_edit', NULL, NULL, NULL),
(132, 'vehicleBrand_access', NULL, NULL, NULL),
(133, 'vehicleBrand_create', NULL, NULL, NULL),
(134, 'vehicleBrand_edit', NULL, NULL, NULL),
(135, 'vehicleBrand_delete', NULL, NULL, NULL),
(136, 'vehicleModel_access', NULL, NULL, NULL),
(137, 'vehicleModel_create', NULL, NULL, NULL),
(138, 'vehicleModel_edit', NULL, NULL, NULL),
(139, 'vehicleModel_delete', NULL, NULL, NULL),
(140, 'notification_access', NULL, NULL, NULL),
(141, 'custom_notification_access', NULL, NULL, NULL),
(142, 'appuser_access', NULL, NULL, NULL),
(143, 'appuser_edit', NULL, NULL, NULL),
(144, 'faq_access', NULL, NULL, NULL),
(145, 'faq_create', NULL, NULL, NULL),
(146, 'faq_edit', NULL, NULL, NULL),
(147, 'faq_delete', NULL, NULL, NULL),
(148, 'earning_access', NULL, NULL, NULL),
(149, 'earning_show', NULL, NULL, NULL),
(150, 'earning_settle', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(11, 113),
(11, 114),
(11, 115),
(11, 116),
(11, 117),
(11, 118),
(11, 119),
(11, 120),
(11, 121),
(11, 122),
(11, 123),
(11, 124),
(11, 125),
(11, 126),
(11, 127),
(11, 128),
(11, 129),
(11, 130),
(11, 131),
(11, 132),
(11, 133),
(11, 134),
(11, 135),
(11, 136),
(11, 137),
(11, 138),
(11, 139),
(11, 140),
(11, 141),
(11, 142),
(11, 143),
(11, 144),
(11, 145),
(11, 146),
(11, 147),
(11, 148),
(11, 149),
(11, 150);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `star` int(11) NOT NULL DEFAULT '0',
  `cmt` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 'Admin', '2020-06-08 01:55:24', '2020-06-08 01:55:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `shop_employee`
--

CREATE TABLE `shop_employee` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `experience` varchar(250) DEFAULT NULL,
  `id_no` varchar(250) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `device_token` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `noti` int(11) NOT NULL DEFAULT '1',
  `online` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shop_owner`
--

CREATE TABLE `shop_owner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `verified` int(11) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `noti` int(11) NOT NULL DEFAULT '1',
  `auto_assign` int(11) NOT NULL DEFAULT '1',
  `emp_decline_req` int(11) NOT NULL DEFAULT '0',
  `device_token` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_notification`
--

CREATE TABLE `static_notification` (
  `id` int(11) NOT NULL,
  `for_what` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `for_who` int(11) NOT NULL DEFAULT '0' COMMENT '0 = user 1 = owner 2 = emp',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `static_notification`
--

INSERT INTO `static_notification` (`id`, `for_what`, `title`, `sub_title`, `status`, `for_who`, `created_at`, `updated_at`) VALUES
(2, 'New Booking (Owner)', 'new booking for {{shop_name}} by {{user_name}}', '{{user_name}} want booking on  {{booking_date}} for {{shop_name}}.', 1, 1, '2020-01-31 02:10:03', '2020-06-27 05:37:36'),
(3, 'Booking Approved(User)', '{{shop_name}} is approved your booking.', 'Your Booking on {{booking_date}} is Approved please many further information {{booking_id}} keep this ref no.', 1, 0, '2020-01-31 00:00:00', '2020-06-27 05:38:32'),
(6, 'Booking Rejected (User)', 'Dear {{user_name}}, {{{shop_name}} Just Reject Booking Req', 'Dear {{user_name}}, {{{shop_name}} Just Reject Booking by shop.', 1, 0, '0000-00-00 00:00:00', '2020-06-27 05:39:19'),
(7, 'Booking Complete(Owner)', '{{employee_name}} complete booking', '{{booking_id}} is complete for {{shop_name}}.', 1, 1, '0000-00-00 00:00:00', '2020-06-27 05:40:36'),
(8, 'Booking Approved(Employee)', 'New job for {{shop_name}}', 'hay {{employee_name}} , you have new booking on {{booking_date}} .', 1, 2, '0000-00-00 00:00:00', '2020-06-27 05:42:58'),
(9, 'Booking Complete(User)', '{{employee_name}} complete booking', '{{booking_id}} is complete for {{shop_name}}.', 1, 0, '0000-00-00 00:00:00', '2020-06-27 05:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '5',
  `status` int(11) NOT NULL DEFAULT '1',
  `price` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '2020-05-19 01:07:15', '$2y$10$hmKnxon3LwqizbdZWPtrWe86zYgPRTB620qPngMqF09KMv3zq5CbS', 'mDzCstwOsUfFB8OlosKZfhx7TeSyGCstM5h8u8BB2DY5t0OZFBZvHCaMRQlD', '2020-05-19 01:07:15', '2020-07-02 05:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `line_1` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0= home 1= office 2 ',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_vehicle`
--

CREATE TABLE `user_vehicle` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `reg_number` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL DEFAULT 'White',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_brand`
--

CREATE TABLE `vehicle_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL DEFAULT 'default.png',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_brand`
--

INSERT INTO `vehicle_brand` (`id`, `name`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BMW', '5ee4ae5df1ac1.png', 1, '2020-06-09 03:45:03', '2020-07-02 09:32:05'),
(2, 'Audi', '5ee4b9f435cc9.png', 1, '2020-06-13 11:35:16', '2020-06-13 11:35:16'),
(3, 'Bugatti', '5ee4baee82935.png', 1, '2020-06-13 11:39:26', '2020-06-13 11:39:26');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model`
--

CREATE TABLE `vehicle_model` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_model`
--

INSERT INTO `vehicle_model` (`id`, `brand_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Polo', '2020-06-09 04:20:32', '2020-07-02 09:32:34'),
(2, 2, 'Audi A6', '2020-06-13 11:36:41', '2020-06-13 11:36:41'),
(3, 2, 'Audi Q8', '2020-06-13 11:37:12', '2020-06-13 11:37:12'),
(4, 2, 'Audi A8 L', '2020-06-13 11:37:28', '2020-06-13 11:37:28'),
(5, 1, 'X5', '2020-06-13 11:38:10', '2020-06-13 11:38:10'),
(6, 2, 'Chiron', '2020-06-13 11:42:27', '2020-07-02 09:32:48'),
(7, 3, 'Divo', '2020-06-13 11:42:54', '2020-06-13 11:42:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_setting`
--
ALTER TABLE `admin_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_master`
--
ALTER TABLE `booking_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner_shops`
--
ALTER TABLE `owner_shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`owner_id`,`booking_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_476162` (`role_id`),
  ADD KEY `permission_id_fk_476162` (`permission_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`booking_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `branch_id` (`shop_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_476171` (`user_id`),
  ADD KEY `role_id_fk_476171` (`role_id`);

--
-- Indexes for table `shop_employee`
--
ALTER TABLE `shop_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_owner`
--
ALTER TABLE `shop_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_notification`
--
ALTER TABLE `static_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_vehicle`
--
ALTER TABLE `user_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_brand`
--
ALTER TABLE `vehicle_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_model`
--
ALTER TABLE `vehicle_model`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_setting`
--
ALTER TABLE `admin_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_master`
--
ALTER TABLE `booking_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `owner_shops`
--
ALTER TABLE `owner_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shop_employee`
--
ALTER TABLE `shop_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_owner`
--
ALTER TABLE `shop_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `static_notification`
--
ALTER TABLE `static_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_vehicle`
--
ALTER TABLE `user_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_brand`
--
ALTER TABLE `vehicle_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle_model`
--
ALTER TABLE `vehicle_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
