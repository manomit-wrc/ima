-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2017 at 04:05 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ima`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_description` text COLLATE utf8_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `short_description`, `full_description`, `banner_image`, `created_at`, `updated_at`) VALUES
(6, 'Indian Medical Association', 'Indian Medical Association', 'Indian Medical Association', '1496204133_bg.jpg', '2017-05-31 11:15:33', '2017-05-31 11:15:33'),
(8, 'Test Heading', 'Test Heading', 'Test Heading', '1496204195_bg.jpg', '2017-05-31 11:16:35', '2017-05-31 11:16:35'),
(9, 'Test Heading-1', 'Test Heading-1', 'Test Heading-1', '1496204229_img1.jpg', '2017-05-31 11:17:09', '2017-05-31 11:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `bulletins`
--

CREATE TABLE IF NOT EXISTS `bulletins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bulletin_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bulletin_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bulletins`
--

INSERT INTO `bulletins` (`id`, `name`, `bulletin_image`, `bulletin_file`, `status`, `created_at`, `updated_at`) VALUES
(1, 'DMA NB 10TH MAY', '1495695600_Desert.jpg', '1495695601_pdf-sample.pdf.pdf', 1, '2017-05-25 14:00:01', '2017-05-25 14:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Category-1', 1, '2017-06-06 17:04:05', '2017-06-06 17:04:05'),
(2, 'Category-2', 1, '2017-06-06 17:04:05', '2017-06-06 17:04:05'),
(3, 'Category-3', 1, '2017-06-06 17:04:05', '2017-06-06 17:04:05'),
(4, 'Category-4', 1, '2017-06-06 17:04:05', '2017-06-06 17:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `firstname`, `lastname`, `email`, `phone`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'atanu', 'ray', 'atanu@wrctechnologies.com', '9748632804', 'dsdsdsdsd', '2017-06-16 17:03:50', '2017-06-16 17:03:50'),
(2, 'manomit', 'mitra', 'manomit@wrctechnologies.com', '9748632804', 'sd;lsldsldsdlslds', '2017-06-16 17:17:56', '2017-06-16 17:17:56'),
(7, 'rajesh', 'kumar', 'rajesh@gmail.com', '7667632323', 'wewew weweweww', '2017-06-16 20:21:45', '2017-06-16 20:21:45'),
(8, 'vineet', 'sen', 'vineet@gmail.com', '9889899889', 'hello test form', '2017-06-19 11:23:13', '2017-06-19 11:23:13'),
(9, 'vikash', 'jha', 'vikash@gmail.com', '9889899889', 'for testing mail from vikash', '2017-06-19 14:30:21', '2017-06-19 14:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `c_m_s`
--

CREATE TABLE IF NOT EXISTS `c_m_s` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `full_description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `c_m_s`
--

INSERT INTO `c_m_s` (`id`, `title`, `slug`, `short_description`, `full_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis velit vel urna pulvinar aliquam. Aenean pretium at enim vel mollis. Fusce imperdiet ornare libero, ac pretium odio egestas eget. Nulla aliquam hendrerit euismod. Morbi nec suscipit lectus, vitae accumsan ex. Fusce ut commodo ante. Morbi nec justo volutpat, accumsan mauris ac, tincidunt felis. Maecenas eu porta felis, ac posuere dolor. Cras consequat tristique enim.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis velit vel urna pulvinar aliquam. Aenean pretium at enim vel mollis. Fusce imperdiet ornare libero, ac pretium odio egestas eget. Nulla aliquam hendrerit euismod. Morbi nec suscipit lectus, vitae accumsan ex. Fusce ut commodo ante. Morbi nec justo volutpat, accumsan mauris ac, tincidunt felis. Maecenas eu porta felis, ac posuere dolor. Cras consequat tristique enim.</p>\r\n', 1, '2017-05-26 20:59:45', '2017-05-26 20:59:45'),
(2, 'About Us', 'about-us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis velit vel urna pulvinar ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis velit vel urna pulvinar aliquam. Aenean pretium at enim vel mollis. Fusce imperdiet ornare libero, ac pretium odio egestas eget. Nulla aliquam hendrerit euismod. Morbi nec suscipit lectus, vitae accumsan ex. Fusce ut commodo ante. Morbi nec justo volutpat, accumsan mauris ac, tincidunt felis. Maecenas eu porta felis, ac posuere dolor. Cras consequat tristique enim.</p>\r\n', 1, '2017-05-26 20:59:58', '2017-06-27 12:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, ' 5-ALPHA-REDUCTASE INHIBITORS', '5-alpha-reductase inhibitors are a group of medicines that block the action of 5-alpha-reductase, the enzyme that converts testosterone into dihydrotestosterone. This results in increased levels of testosterone and decreased levels of dihydrotestosterone; an overabundance of dihydrotestosterone has been implicated in benign prostatic hyperplasia (BPH) and prostate cancer. The scalp of men with androgenetic alopecia (male-pattern baldness) has also been found to contain increased amounts of dihydrotestosterone and miniaturized hair follicles compared with men who have a lot of hair.', 1, '2017-07-05 16:07:03', '2017-07-05 16:18:44'),
(2, 'ACE INHIBITORS WITH THIAZIDES', 'ACE inhibitors with thiazides is a combination medicine containing both an angiotensin-converting-enzyme inhibitor (ACE inhibitor) and a thiazide. An ACE inhibitor blocks the angiotensin converting enzyme from converting angiotensin I to angiotensin II. This results in a decrease in angiotensin II causing vasodilation and therefore a reduction in blood pressure. Thiazide diuretics decrease active re-absorption of sodium and chloride ions by inhibiting the sodium/chloride co-transporter in the distal convoluted tubule. This causes an increase in urine production (diuresis) and results in a decrease in blood volume and a reduction in blood pressure.', 1, '2017-07-05 16:07:34', '2017-07-05 16:07:34'),
(3, 'ANTACIDS', 'Antacids are a class of medicines that neutralize acid in the stomach. They contain ingredients such as aluminum, calcium, or magnesium which act as bases (alkalis) to counteract the stomach acid and lower pH. They work quickly and are used to relieve symptoms of acid reflux, heartburn or indigestion (dyspepsia).', 1, '2017-07-05 16:08:04', '2017-07-05 16:08:04'),
(4, 'METABOLIC AGENTS', 'Metabolic agents are substances capable of producing an effect on the sum of the chemical and physical changes occurring in tissue, consisting of those reactions that convert small molecules into large (anabolism), and those reactions that convert large molecules into small (catabolism ).', 1, '2017-07-05 16:08:30', '2017-07-05 16:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE IF NOT EXISTS `designations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'National President', 1, '2017-05-23 20:03:03', '2017-05-23 20:03:03'),
(2, 'Hony Secretary General', 1, '2017-05-23 20:03:38', '2017-05-23 20:03:38'),
(4, 'Hony State Secretary', 1, '2017-05-23 20:05:52', '2017-05-23 20:05:52'),
(5, 'IMA PAST PRESIDENT', 1, '2017-05-23 20:06:18', '2017-05-23 20:06:18'),
(6, 'SENIOR VICE PRESIDENT', 1, '2017-05-23 20:06:36', '2017-05-23 20:06:36'),
(8, 'HONY FINANCE SECRETARY', 1, '2017-05-23 20:07:14', '2017-05-23 20:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `type` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'D',
  `company_regsitration_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8_unicode_ci,
  `license` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `doe` date DEFAULT NULL,
  `testimonial` text COLLATE utf8_unicode_ci,
  `payment` text COLLATE utf8_unicode_ci,
  `date_of_payment` date DEFAULT NULL,
  `certificate` text COLLATE utf8_unicode_ci,
  `avators` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `active_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `doctors_email_index` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `first_name`, `last_name`, `address`, `email`, `mobile`, `sex`, `password`, `pincode`, `city`, `status`, `type`, `company_regsitration_no`, `biography`, `license`, `dob`, `doe`, `testimonial`, `payment`, `date_of_payment`, `certificate`, `avators`, `created_at`, `updated_at`, `state_id`, `active_token`) VALUES
(1, 'Manomit', 'Mitra', '49/1 K, ANATH NATH DEBLANE, BELGACHIA, KOLKATA-700037', 'manomit@wrctechnologies.com', '8697733159', 'M', '$2y$10$..LpXmzCvKg1O774WDiUb.4xA3obNuosRXo/wkj0GCxzPacmJ77rK', '700037', 'Kolkata', 1, 'D', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis imperdiet enim ac dolor ultrices, in gravida neque varius. Donec ac commodo lectus. Nullam tempor elementum egestas. Nulla facilisi. Aliquam enim nisi, porta sed consectetur in, commodo et libero. In at cursus neque. Quisque tempor ligula ut tellus pharetra, in vestibulum odio cursus. Praesent tincidunt efficitur orci eu imperdiet. Ut non cursus metus. Duis at ipsum porta, sagittis sapien ac, dictum arcu. Donec lorem dolor, auctor id imperdiet at, placerat vitae diam.\r\n\r\nDonec sollicitudin, nulla in suscipit tincidunt, ipsum erat condimentum sapien, id mollis neque orci in nisl. Donec accumsan sagittis erat at gravida. Quisque quis sapien sem. Nullam bibendum enim velit, quis cursus magna faucibus vitae. Aliquam vitae nibh ex. Fusce dapibus purus urna, eget sodales eros faucibus et. Nullam turpis nisi, pretium non pretium eu, molestie eu elit. Donec imperdiet, turpis sagittis tempus tempor, erat nisl placerat magna, tincidunt convallis sem turpis in nisl.', '123456789', '1983-04-23', NULL, 'I have been seeing Dr. Mitra and the medical group since early 2017 for alcohol addiction. Dr. mitra''s practice is cutting edge in treating alcoholism. I am on a...', '5000', '2017-07-05', '1499348454_Desert.jpg,1499348454_Hydrangeas.jpg,1499348454_Jellyfish.jpg,1499348454_Tulips.jpg', '1500032821_Koala.jpg', '2017-06-07 16:25:23', '2017-07-14 18:47:01', 24, '$2y$10$dBmHSb5Fw2o80wlpJZVqe.fuZFkAFkhQKyPE.kLrqnNdhTrkLqHe'),
(2, 'Arijit', 'Das', 'J-1/12 Block EP-GP, 2nd Floor, Saltlake, Kolkata, West Bengal 700091', 'arijit@wrctechnologies.com', '5858585858', 'M', '$2y$10$..LpXmzCvKg1O774WDiUb.4xA3obNuosRXo/wkj0GCxzPacmJ77rK', '700001', 'Kolkata', 1, 'D', NULL, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '11111111', '2004-01-01', NULL, 'I have been seeing Dr. A and the medical group since early 2017 for alcohol addiction. Dr. A''s practice is cutting edge in treating alcoholism. I am on a... Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '4000', '2017-07-02', '1499666016_Tulips.jpg', '1499668151_Koala.jpg', '2017-06-07 17:42:50', '2017-07-10 13:29:11', 24, '$2y$10$a.F6H94V3iAqaLEQQIvUXOkOKViHlwjeKxWCjySPoKohHssxXAuS'),
(6, 'WRC technologies pvt ltd', '', 'J-1/12 Block EP-GP, 2nd Floor, Saltlake, Kolkata, West Bengal 700091', 'atanu123@wrctechnologies.com', '9143246419', NULL, '$2y$10$2agQDg7B/NDdb3BXfGkhnetPvjvWOqs11Q27CaP9CpqcIsc4BldRq', '711302', 'Andul', 1, 'C', '2222', NULL, NULL, NULL, '2017-06-28', NULL, NULL, NULL, NULL, '1499330405_Tulips.jpg', '2017-06-29 20:47:29', '2017-07-06 15:40:06', 30, ''),
(8, 'Atanu & co.', '', 'ps-panchla district:- howrah', 'atanuray@wrctechnologies.com', '9748632804', NULL, '$2y$10$r//CCO493ythBjQeaBAajeJ7NpPj8/Yy3223bXW8FgWUyazMDz1ii', '711302', 'howrah', 1, 'C', '1111', 'Testing purpose only.', NULL, NULL, '2017-06-13', NULL, NULL, NULL, NULL, '1499084189_Chrysanthemum.jpg', '2017-07-03 12:35:28', '2017-07-03 20:06:23', 24, ''),
(9, 'vikash &  co.', '', 'andul, howrah', 'vikash@gmail.com', '8045785210', NULL, '$2y$10$r//CCO493ythBjQeaBAajeJ7NpPj8/Yy3223bXW8FgWUyazMDz1ii', '711302', 'howrah', 1, 'C', '1111', NULL, NULL, NULL, '2017-07-03', NULL, NULL, NULL, NULL, '1499158170_Koala.jpg', '2017-07-03 14:22:56', '2017-07-04 15:49:31', 24, ''),
(10, 'Atanu', 'Ray', '', 'atanu@wrctechnologies.com', '7788554455', NULL, '$2y$10$/L6yp1RZvZymp/V5PkRqQufldOUx65MkM4f89VxQpn9xw31xuBSFq', NULL, NULL, 1, 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1500024243_Desert.jpg', '2017-07-14 16:23:20', '2017-07-14 16:24:03', 24, '$2y$10$54tSZWjCbyLJtP.uNJ.omOFT0p7vSuJKnzMY2KFdyHgqv1LAVdTC'),
(11, 'Amir', 'Sohel', '', 'amir@wrctechnologies.com', '8697733152', NULL, '$2y$10$fvcymr3bo/r0chvmRMTVRuFP1b0haGIdY0R.UpoEXQGS4kPYmyQY6', NULL, NULL, 1, 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-07-14 16:24:36', '2017-07-14 16:24:36', 24, '$2y$10$t9uktoMY3QOR5ZIR8ptTf.BYdsr4lE9dZI6kIh4KpiqxQOgDS.q');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_qualifications`
--

CREATE TABLE IF NOT EXISTS `doctor_qualifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` int(10) unsigned NOT NULL,
  `qualification_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `doctor_qualifications`
--

INSERT INTO `doctor_qualifications` (`id`, `doctor_id`, `qualification_id`, `created_at`, `updated_at`) VALUES
(8, 1, 1, NULL, NULL),
(9, 1, 3, NULL, NULL),
(10, 1, 5, NULL, NULL),
(11, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE IF NOT EXISTS `drugs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `doctor_id` int(10) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mfg_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `drugs_department_id_foreign` (`department_id`),
  KEY `drugs_doctor_id_foreign` (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `title`, `description`, `department_id`, `doctor_id`, `image`, `mfg_name`, `unit`, `price`, `video`, `created_at`, `updated_at`) VALUES
(1, 'Diagen-(FDA)', 'Abacavir sulfate', 3, 8, '1499928098_Hydrangeas.jpg', 'Ranbaxy', '1.00', '1.00', '', '2017-07-13 13:41:38', '2017-07-13 13:41:38'),
(2, 'Acetaminophen', 'N-(4-hydroxyphenyl) acetamide', 2, 8, '1500011228_Chrysanthemum.jpg', 'Tylenol', '11 PCS', '250.00', '', '2017-07-14 12:47:08', '2017-07-14 12:47:08'),
(3, 'Diazepam', '7-chloro-1,3-dihydro-1-methyl-5-phenyl-2H-1,4-benzodiazepin-2-one', 3, 8, '1500011279_Desert.jpg', 'Valium', '2', '30', '', '2017-07-14 12:47:59', '2017-07-14 12:47:59'),
(4, 'Pseudoephedrine', 'dl-threo-2-(methylamino)-1-phenylpropan-1-ol', 4, 8, '1500011339_Penguins.jpg', 'Sudafed', '6', '20.00', '', '2017-07-14 12:48:59', '2017-07-14 12:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_category_id` int(10) unsigned NOT NULL,
  `event_venue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_event_category_id_foreign` (`event_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `event_category_id`, `event_venue`, `event_date`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CWC MEETING 2017 KOLKATA', 4, 'Infinity Benchmark', '2017-05-26', 'The Congress Working Committee (CWC) is the executive committee of the Indian National Congress. It typically consists of fifteen members elected from the All India Congress Committee. It is headed by the Working President.', 1, '2017-05-24 17:44:54', '2017-05-24 17:51:35'),
(2, 'BIMACON 2016', 2, 'BIMACON', '2017-05-27', 'THURSDAY 12TH JANUARY 2017 SWAMI VIVEKANADA BIRTH ANNIVERSARY OBSERVATION\r\nMONDAY 23RD JANUARY 2017 NETAJI BIRTH ANNIVERSARY OBSERVATION\r\nTHURSDAY, 26TH JANUARY 20175: REPUBLIC DAY OBSERVATION\r\nSUNDAY, 5TH MARCH 2017 INTERNATIONAL WOMEN''S DAY OBSERVATION', 1, '2017-05-24 17:51:21', '2017-05-24 17:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE IF NOT EXISTS `event_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_categories_name_index` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Category-1', 1, '2017-05-24 14:35:18', '2017-05-24 14:35:18'),
(2, 'Category-2', 1, '2017-05-24 14:35:28', '2017-05-24 14:35:28'),
(4, 'Category-3', 1, '2017-05-24 14:36:47', '2017-05-24 17:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `event_galleries`
--

CREATE TABLE IF NOT EXISTS `event_galleries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_galleries_event_id_foreign` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `event_galleries`
--

INSERT INTO `event_galleries` (`id`, `event_id`, `filename`, `original_name`, `created_at`, `updated_at`) VALUES
(1, 1, '1495633394_1495633394_tulips.jpg', 'Tulips.jpg', '2017-05-24 20:43:14', '2017-05-24 20:43:14'),
(2, 1, '1495633394_1495633394_desert.jpg', 'Desert.jpg', '2017-05-24 20:43:15', '2017-05-24 20:43:15'),
(3, 1, '1495633395_1495633395_chrysanthemum.jpg', 'Chrysanthemum.jpg', '2017-05-24 20:43:15', '2017-05-24 20:43:15'),
(4, 1, '1495633395_1495633395_penguins.jpg', 'Penguins.jpg', '2017-05-24 20:43:16', '2017-05-24 20:43:16'),
(5, 2, '1495633435_1495633435_lighthouse.jpg', 'Lighthouse.jpg', '2017-05-24 20:43:55', '2017-05-24 20:43:55'),
(6, 2, '1495633435_1495633435_hydrangeas.jpg', 'Hydrangeas.jpg', '2017-05-24 20:43:55', '2017-05-24 20:43:55'),
(7, 2, '1495633436_1495633436_koala.jpg', 'Koala.jpg', '2017-05-24 20:43:56', '2017-05-24 20:43:56'),
(8, 2, '1495633436_1495633436_jellyfish.jpg', 'Jellyfish.jpg', '2017-05-24 20:43:56', '2017-05-24 20:43:56'),
(9, 1, '1495633510_1495633510_chrysanthemum.jpg', 'Chrysanthemum.jpg', '2017-05-24 20:45:11', '2017-05-24 20:45:11'),
(10, 1, '1495633511_1495633511_desert.jpg', 'Desert.jpg', '2017-05-24 20:45:11', '2017-05-24 20:45:11'),
(11, 1, '1495633535_1495633535_hydrangeas.jpg', 'Hydrangeas.jpg', '2017-05-24 20:45:35', '2017-05-24 20:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `no_of_people` int(10) unsigned NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_doctor_id_foreign` (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `doctor_id`, `name`, `description`, `no_of_people`, `status`, `created_at`, `updated_at`) VALUES
(9, 1, 'Group-1', 'This is group-1', 10, 1, '2017-07-12 14:24:19', '2017-07-12 14:24:19'),
(11, 1, 'Group-3', 'This is a test group-3', 5, 1, '2017-07-12 15:50:22', '2017-07-12 15:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE IF NOT EXISTS `journals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `published_date` date NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `doctor_id` int(10) unsigned NOT NULL,
  `journal_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `journals_category_id_foreign` (`category_id`),
  KEY `journals_doctor_id_foreign` (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `title`, `description`, `published_date`, `category_id`, `doctor_id`, `journal_file`, `status`, `created_at`, `updated_at`) VALUES
(1, 'My Journal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam posuere, elit sed molestie faucibus, augue sapien ultrices est, sit amet malesuada leo enim sit amet diam. Curabitur at placerat est. Cras non arcu vel ipsum vulputate imperdiet eget eget ligula. Nunc ullamcorper ornare lobortis. Maecenas convallis lectus accumsan pellentesque sagittis. Proin pellentesque, odio quis vulputate tempus, libero nisi commodo dolor, non gravida lacus felis nec quam. Phasellus scelerisque fringilla tincidunt.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sit amet finibus quam. Aenean non rhoncus est, et sagittis risus. Duis eget diam maximus, imperdiet lorem sit amet, dignissim nisi. Nullam non tellus ac sem volutpat tempor sit amet sit amet odio. Praesent vitae gravida nibh. Praesent orci massa, lobortis sit amet sem eu, venenatis facilisis erat. Proin ipsum nisi, suscipit imperdiet arcu non, gravida mollis nunc. Mauris in ante accumsan, molestie lorem sit amet, pulvinar sem. Nunc ultricies ac purus non luctus. Praesent velit erat, auctor in ante id, imperdiet efficitur dui. Nunc rutrum mi et felis egestas dignissim. Nam eros sapien, porttitor a nibh vel, commodo iaculis mi. Suspendisse potenti.', '2017-06-11', 2, 1, '1497247912_bulletin.pdf', 0, '2017-06-12 11:41:48', '2017-06-29 14:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `local_branches`
--

CREATE TABLE IF NOT EXISTS `local_branches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch_head` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `designation_id` int(10) unsigned NOT NULL,
  `branch_address` text COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `local_branches_designation_id_foreign` (`designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `local_branches`
--

INSERT INTO `local_branches` (`id`, `branch_name`, `branch_head`, `designation_id`, `branch_address`, `mobile_no`, `phone_no`, `email_id`, `branch_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'IMA CENTRAL BRANCH', 'DR. VINOD GOEL', 8, 'C-134 K , SURYA NAGAR\r\nGHAZIABAD-201011', '9868525758', '119136526757', 'drvinodgoyal@gmail.com', '1495703842_Koala.jpg', 1, '2017-05-25 15:59:06', '2017-05-25 16:17:22'),
(2, 'IMA CENTRAL BRANCH 2', 'Dr. Atanu Ray', 1, 'C-134 K , howrah-711302', '9748632804', '033-22687458', 'atanu@wrctechnologies.com', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_05_23_073322_add_some_fields_to_users_table', 2),
(4, '2017_05_23_110115_create_organizations_table', 3),
(5, '2017_05_23_114447_create_designations_table', 4),
(6, '2017_05_24_045605_create_teams_table', 5),
(7, '2017_05_24_071023_create_event_categories_table', 6),
(8, '2017_05_24_084238_create_events_table', 7),
(9, '2017_05_24_125225_create_event_galleries_table', 8),
(10, '2017_05_25_045124_create_banners_table', 9),
(11, '2017_05_25_060920_create_bulletins_table', 10),
(12, '2017_05_25_072614_create_local_branches_table', 11),
(13, '2017_05_25_110222_create_tags_table', 12),
(14, '2017_05_25_122251_create_news_table', 13),
(15, '2017_05_25_130643_create_news_tag_table', 14),
(16, '2017_05_26_130520_create_c_m_s_table', 15),
(17, '2017_05_29_052234_create_notices_table', 16),
(18, '2017_06_01_063637_create_doctors_table', 17),
(19, '2017_06_01_125543_add_other_fields_to_doctors_table', 18),
(20, '2017_06_05_054329_create_states_table', 19),
(21, '2017_06_05_131649_add_state_id_to_doctors_tabel', 20),
(22, '2017_06_06_095500_create_categories_table', 20),
(23, '2017_06_06_114422_create_journals_table', 21),
(24, '2017_06_07_093040_add_is_published_to_journals_table', 22),
(25, '2017_06_07_094112_drop_is_published_to_journals_table', 23),
(26, '2017_06_07_094832_add_active_token_to_doctors_table', 24),
(27, '2017_06_14_092817_create_contacts_table', 25),
(28, '2017_06_27_063545_add_testimonial_to_doctors_table', 26),
(29, '2017_06_28_094948_add_type_to_doctors_table', 27),
(30, '2017_06_28_095600_drop_type_to_doctors_table', 28),
(31, '2017_06_28_095816_add_only_type_to_doctors_table', 29),
(32, '2017_07_04_094523_create_qualifications_table', 30),
(33, '2017_07_04_124141_add_payment_to_qualifications_table', 31),
(34, '2017_07_04_124542_add_payment_to_doctors_table', 31),
(35, '2017_07_04_125911_create_doctor_qualifications_table', 32),
(36, '2017_07_05_083619_create_departments_table', 33),
(37, '2017_07_05_092334_create_drugs_table', 34),
(38, '2017_07_11_111421_create_groups_table', 35);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `published_date` date NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `published_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CDPH publishes resources for physicians who prescribe opioids', '<p><em><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget tortor fermentum, ultrices enim eu, suscipit quam. Mauris vestibulum convallis odio, ut congue turpis tempor nec. Aliquam erat volutpat. Sed ligula purus, finibus eu tortor et, efficitur fermentum dui. Mauris et pharetra dolor, et laoreet sem. Aliquam sit amet pulvinar enim. Vivamus commodo leo nec sagittis vulputate. Aliquam ipsum ante, feugiat vitae porttitor non, maximus quis neque. Nullam elit nisi, ornare sit amet lacinia sed, commodo nec tellus. Integer finibus neque magna, quis euismod nulla pellentesque sollicitudin. Curabitur nec pellentesque nisi, et sodales urna. Etiam porttitor nibh eget rutrum interdum. Duis quis purus sed tortor hendrerit gravida.</strong></em></p>\r\n', '2017-05-27', 1, '2017-05-26 14:09:09', '2017-05-26 14:40:50'),
(2, 'Test News', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec diam ex, tempor nec diam ut, cursus lobortis nisl. Duis justo quam, efficitur id diam ut, porttitor placerat ligula. Vivamus ac magna eget massa consequat hendrerit. Proin id leo malesuada, pulvinar sapien id, tincidunt mauris. Aliquam vehicula, velit in ullamcorper iaculis, nulla dolor lobortis ex, a ornare mauris turpis sit amet tortor. Sed orci est, ultricies sed magna in, gravida tempus felis. Curabitur dolor tellus, eleifend non nisl vel, dapibus suscipit arcu. Suspendisse potenti. Donec efficitur luctus nisl, a efficitur lectus elementum eget. Maecenas sed hendrerit nisl, eget rhoncus nibh. Fusce vulputate urna ac commodo auctor. Phasellus nec consequat lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis imperdiet leo sed risus pulvinar, posuere convallis orci gravida.</p>\r\n', '2017-06-02', 1, '2017-06-01 12:36:58', '2017-06-01 12:36:58'),
(3, 'Test News - 2', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec diam ex, tempor nec diam ut, cursus lobortis nisl. Duis justo quam, efficitur id diam ut, porttitor placerat ligula. Vivamus ac magna eget massa consequat hendrerit. Proin id leo malesuada, pulvinar sapien id, tincidunt mauris. Aliquam vehicula, velit in ullamcorper iaculis, nulla dolor lobortis ex, a ornare mauris turpis sit amet tortor. Sed orci est, ultricies sed magna in, gravida tempus felis. Curabitur dolor tellus, eleifend non nisl vel, dapibus suscipit arcu. Suspendisse potenti. Donec efficitur luctus nisl, a efficitur lectus elementum eget. Maecenas sed hendrerit nisl, eget rhoncus nibh. Fusce vulputate urna ac commodo auctor. Phasellus nec consequat lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis imperdiet leo sed risus pulvinar, posuere convallis orci gravida.</p>\r\n', '2017-06-03', 1, '2017-06-01 12:37:54', '2017-06-01 12:37:54'),
(4, 'Test News - 3', '<p>Ne eam errem semper. Laudem detracto phaedrum cu vim, pri cu errem fierent fabellas. Quis magna in ius, pro vidit nonumy te, nostrud.</p>\r\n\r\n<p>The California Department of Public Health (CDPH) has developed an opioid prescriber resource guide to help improve</p>\r\n', '2017-06-02', 1, '2017-06-01 12:39:36', '2017-06-01 12:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `news_tag`
--

CREATE TABLE IF NOT EXISTS `news_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `news_tag`
--

INSERT INTO `news_tag` (`id`, `news_id`, `tag_id`) VALUES
(12, 1, 1),
(13, 1, 3),
(14, 1, 4),
(15, 2, 2),
(16, 2, 4),
(17, 3, 1),
(18, 3, 3),
(19, 4, 1),
(20, 4, 2),
(21, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notices_subject_index` (`subject`),
  KEY `notices_published_date_index` (`published_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook_link` text COLLATE utf8_unicode_ci NOT NULL,
  `twitter_link` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `email`, `alternate_email`, `phone`, `address`, `facebook_link`, `twitter_link`, `created_at`, `updated_at`) VALUES
(1, 'Indian Medical Association', 'hsgima@gmail.com', 'hsg@ima-india.org', '+91-11-23370009', 'J-1/12 Block EP-GP, 2nd Floor, Saltlake, Kolkata, West Bengal 700091', 'https://www.facebook.com/ima.national', 'https://twitter.com/IndianMedAssn', '2017-05-23 07:00:00', '2017-06-22 14:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE IF NOT EXISTS `qualifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qualification_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `qualification_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'M.B.B.S', 1, '2017-07-04 18:31:13', '2017-07-04 18:31:13'),
(2, 'M.D', 1, '2017-07-04 18:31:24', '2017-07-04 18:32:18'),
(3, 'MBCHB', 1, '2017-07-04 18:31:53', '2017-07-04 18:32:01'),
(4, 'Surgeons-FRCS', 1, '2017-07-04 18:32:42', '2017-07-04 18:32:42'),
(5, 'MCh Orth ', 1, '2017-07-06 12:08:32', '2017-07-06 12:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ANDHRA PRADESH', 1, NULL, NULL),
(2, 'ASSAM', 1, NULL, NULL),
(3, 'ARUNACHAL PRADESH', 1, NULL, NULL),
(4, 'GUJRAT', 1, NULL, NULL),
(5, 'BIHAR', 1, NULL, NULL),
(6, 'HARYANA', 1, NULL, NULL),
(7, 'HIMACHAL PRADESH', 1, NULL, NULL),
(8, 'JAMMU & KASHMIR', 1, NULL, NULL),
(9, 'KARNATAKA', 1, NULL, NULL),
(10, 'KERALA', 1, NULL, NULL),
(11, 'MADHYA PRADESH', 1, NULL, NULL),
(12, 'MAHARASHTRA', 1, NULL, NULL),
(13, 'MANIPUR', 1, NULL, NULL),
(14, 'MEGHALAYA', 1, NULL, NULL),
(15, 'MIZORAM', 1, NULL, NULL),
(16, 'NAGALAND', 1, NULL, NULL),
(17, 'ORISSA', 1, NULL, NULL),
(18, 'PUNJAB', 1, NULL, NULL),
(19, 'RAJASTHAN', 1, NULL, NULL),
(20, 'SIKKIM', 1, NULL, NULL),
(21, 'TAMIL NADU', 1, NULL, NULL),
(22, 'TRIPURA', 1, NULL, NULL),
(23, 'UTTAR PRADESH', 1, NULL, NULL),
(24, 'WEST BENGAL', 1, NULL, NULL),
(25, 'DELHI', 1, NULL, NULL),
(26, 'GOA', 1, NULL, NULL),
(27, 'PONDICHERY', 1, NULL, NULL),
(28, 'LAKSHDWEEP', 1, NULL, NULL),
(29, 'ANDAMAN & NICOBAR', 1, NULL, NULL),
(30, 'UTTARANCHAL', 1, NULL, NULL),
(31, 'JHARKHAND', 1, NULL, NULL),
(32, 'CHATTISGARH', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Public Health', 1, '2017-05-25 18:52:47', '2017-05-25 18:52:47'),
(2, 'Drug Prescribing', 1, '2017-05-25 18:53:09', '2017-05-25 18:53:09'),
(3, 'Addiction', 1, '2017-05-25 18:54:33', '2017-05-25 18:54:33'),
(4, 'Pain Medicine', 1, '2017-05-25 18:54:51', '2017-05-25 18:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avators` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serving_period` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `designation_id` int(10) unsigned NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_designation_id_foreign` (`designation_id`),
  KEY `teams_email_index` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `first_name`, `last_name`, `address`, `mobile_no`, `email`, `avators`, `serving_period`, `designation_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'K K ', 'AGGARWAL', 'dfdsfdsfsdf', '8697744365', 'kk.aggarwal@gmail.com', '1496235439_1.jpg', '2016-2017', 8, 1, '2017-05-31 19:57:20', '2017-05-31 19:57:20'),
(2, 'R.N', 'Tandon', 'sdfsdfsdf', '8877444445', 'rntandon@gmail.com', '1496235496_2.jpg', '2016-2017', 2, 1, '2017-05-31 19:58:16', '2017-05-31 19:58:16'),
(3, 'Susil', 'Mondal', 'sdfsfsdfsdf', '9868525758', 'susilmondal@gmail.com', '1496235528_3.jpg', '2016-2017', 4, 1, '2017-05-31 19:58:48', '2017-05-31 19:58:48'),
(4, 'Tapan Kumar', 'Biswas', 'sdfdsfsdfsdf', '7000371256', 'tapanbiswas@gmail.com', '1496235565_4.jpg', '2016-2017', 5, 1, '2017-05-31 19:59:25', '2017-05-31 19:59:25'),
(5, 'Tapas', 'Chakraborty', 'sdfsdfsfsdf', '9988774455', 'tapa@gmail.com', '1496235597_5.jpg', '2016-2017', 1, 1, '2017-05-31 19:59:57', '2017-05-31 19:59:57'),
(6, 'Sibabrata', 'Banerjee', 'sdfdsfsdf', '9432159741', 'sibabratabanerjee@gmail.com', '1496235634_6.jpg', '2016-2017', 6, 1, '2017-05-31 20:00:34', '2017-05-31 20:00:34'),
(7, 'Amrita', 'Mondal', 'Airport,kolkata-700002', '7000371256', 'amrita@wrctechnologies.com', '1496294249_Koala.jpg', '2016-2017', 6, 1, '2017-06-01 12:17:29', '2017-06-01 12:17:29'),
(8, 'Amir', 'Sohel', 'fdsdsfsdfsf', '8697744365', 'amir@wrctechnologies.com', '1496294306_Lighthouse.jpg', '2016-2017', 4, 1, '2017-06-01 12:18:26', '2017-06-01 12:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avators` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `email`, `password`, `mobile`, `remember_token`, `created_at`, `updated_at`, `avators`) VALUES
(1, 'Manomit Mitra', 'J-1/12 Block EP-GP, 2nd Floor, Saltlake, Kolkata, West Bengal 700091', 'admin@wrctechnologies.com', '$2y$10$jOG5kriZBIQGkzu72QvrNet7lDcx0V6JCP/XdQYtlfa/cwndI4.72', '9007341343', '8aPbcrndNfVXy4GGJswhqZeCgETOejqB0079TVRXZ3BezGNYciAl5SQJepqd', '2017-05-23 14:39:24', '2017-07-07 18:37:17', '1496035093_Chrysanthemum.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drugs`
--
ALTER TABLE `drugs`
  ADD CONSTRAINT `drugs_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `drugs_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_event_category_id_foreign` FOREIGN KEY (`event_category_id`) REFERENCES `event_categories` (`id`);

--
-- Constraints for table `event_galleries`
--
ALTER TABLE `event_galleries`
  ADD CONSTRAINT `event_galleries_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `journals`
--
ALTER TABLE `journals`
  ADD CONSTRAINT `journals_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `journals_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `local_branches`
--
ALTER TABLE `local_branches`
  ADD CONSTRAINT `local_branches_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
