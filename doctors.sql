-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2017 at 03:42 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `first_name`, `last_name`, `address`, `email`, `mobile`, `sex`, `password`, `pincode`, `city`, `status`, `type`, `company_regsitration_no`, `biography`, `license`, `dob`, `doe`, `testimonial`, `payment`, `date_of_payment`, `certificate`, `avators`, `created_at`, `updated_at`, `state_id`, `active_token`) VALUES
(1, 'Manomit', 'Mitra', '49/1 K, ANATH NATH DEBLANE, BELGACHIA, KOLKATA-700037', 'manomit@wrctechnologies.com', '8697733159', 'M', '$2y$10$..LpXmzCvKg1O774WDiUb.4xA3obNuosRXo/wkj0GCxzPacmJ77rK', '700037', 'Kolkata', 1, 'D', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis imperdiet enim ac dolor ultrices, in gravida neque varius. Donec ac commodo lectus. Nullam tempor elementum egestas. Nulla facilisi. Aliquam enim nisi, porta sed consectetur in, commodo et libero. In at cursus neque. Quisque tempor ligula ut tellus pharetra, in vestibulum odio cursus. Praesent tincidunt efficitur orci eu imperdiet. Ut non cursus metus. Duis at ipsum porta, sagittis sapien ac, dictum arcu. Donec lorem dolor, auctor id imperdiet at, placerat vitae diam.\r\n\r\nDonec sollicitudin, nulla in suscipit tincidunt, ipsum erat condimentum sapien, id mollis neque orci in nisl. Donec accumsan sagittis erat at gravida. Quisque quis sapien sem. Nullam bibendum enim velit, quis cursus magna faucibus vitae. Aliquam vitae nibh ex. Fusce dapibus purus urna, eget sodales eros faucibus et. Nullam turpis nisi, pretium non pretium eu, molestie eu elit. Donec imperdiet, turpis sagittis tempus tempor, erat nisl placerat magna, tincidunt convallis sem turpis in nisl.', '123456789', '1983-04-23', NULL, 'I have been seeing Dr. Mitra and the medical group since early 2017 for alcohol addiction. Dr. mitra''s practice is cutting edge in treating alcoholism. I am on a...', '5000', '2017-07-05', '1499348454_Desert.jpg,1499348454_Hydrangeas.jpg,1499348454_Jellyfish.jpg,1499348454_Tulips.jpg', '1499861890_Lighthouse.jpg', '2017-06-07 16:25:23', '2017-07-12 19:18:10', 24, '$2y$10$dBmHSb5Fw2o80wlpJZVqe.fuZFkAFkhQKyPE.kLrqnNdhTrkLqHe'),
(2, 'Arijit', 'Das', 'J-1/12 Block EP-GP, 2nd Floor, Saltlake, Kolkata, West Bengal 700091', 'arijit@wrctechnologies.com', '5858585858', 'M', '$2y$10$..LpXmzCvKg1O774WDiUb.4xA3obNuosRXo/wkj0GCxzPacmJ77rK', '700001', 'Kolkata', 1, 'D', NULL, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '11111111', '2004-01-01', NULL, 'I have been seeing Dr. A and the medical group since early 2017 for alcohol addiction. Dr. A''s practice is cutting edge in treating alcoholism. I am on a... Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '4000', '2017-07-02', '1499666016_Tulips.jpg', '1499668151_Koala.jpg', '2017-06-07 17:42:50', '2017-07-10 13:29:11', 24, '$2y$10$a.F6H94V3iAqaLEQQIvUXOkOKViHlwjeKxWCjySPoKohHssxXAuS'),
(6, 'WRC technologies pvt ltd', '', 'J-1/12 Block EP-GP, 2nd Floor, Saltlake, Kolkata, West Bengal 700091', 'atanu123@wrctechnologies.com', '9143246419', NULL, '$2y$10$2agQDg7B/NDdb3BXfGkhnetPvjvWOqs11Q27CaP9CpqcIsc4BldRq', '711302', 'Andul', 1, 'C', '2222', NULL, NULL, NULL, '2017-06-28', NULL, NULL, NULL, NULL, '1499330405_Tulips.jpg', '2017-06-29 20:47:29', '2017-07-06 15:40:06', 30, ''),
(8, 'Atanu & co.', '', 'ps-panchla district:- howrah', 'atanuray@wrctechnologies.com', '9748632804', NULL, '$2y$10$r//CCO493ythBjQeaBAajeJ7NpPj8/Yy3223bXW8FgWUyazMDz1ii', '711302', 'howrah', 1, 'C', '1111', 'Testing purpose only.', NULL, NULL, '2017-06-13', NULL, NULL, NULL, NULL, '1499084189_Chrysanthemum.jpg', '2017-07-03 12:35:28', '2017-07-03 20:06:23', 24, ''),
(9, 'vikash &  co.', '', 'andul, howrah', 'vikash@gmail.com', '8045785210', NULL, '$2y$10$r//CCO493ythBjQeaBAajeJ7NpPj8/Yy3223bXW8FgWUyazMDz1ii', '711302', 'howrah', 1, 'C', '1111', NULL, NULL, NULL, '2017-07-03', NULL, NULL, NULL, NULL, '1499158170_Koala.jpg', '2017-07-03 14:22:56', '2017-07-04 15:49:31', 24, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
