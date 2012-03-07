-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2012 at 05:24 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lulu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_customer`
--

CREATE TABLE IF NOT EXISTS `m_customer` (
  `code_customer` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_customer` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address_customer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postal_code_customer` int(6) NOT NULL,
  `phone_customer` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_customer` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_customer` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`code_customer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_detail_transaction`
--

CREATE TABLE IF NOT EXISTS `m_detail_transaction` (
  `id_detail_transaction` int(11) NOT NULL AUTO_INCREMENT,
  `code_transaction` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quantity_detail_transaction` int(11) NOT NULL,
  `description_detail_transaction` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_detail_transaction` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_detail_transaction`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_product`
--

CREATE TABLE IF NOT EXISTS `m_product` (
  `code_product` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `group_product` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_product` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `size_product` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stock_product` int(8) NOT NULL,
  `price_product` bigint(15) NOT NULL,
  `status_product` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`code_product`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_transaction`
--

CREATE TABLE IF NOT EXISTS `m_transaction` (
  `code_transaction` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code_customer` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time_transaction` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sub_office_transaction` int(5) NOT NULL,
  `cost_type_transaction` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_transaction` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `id_account` int(5) NOT NULL AUTO_INCREMENT,
  `username_account` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `password_account` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `name_role` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `status_account` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_account`),
  UNIQUE KEY `username` (`username_account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id_account`, `username_account`, `password_account`, `name_role`, `status_account`) VALUES
(1, 'admin', 'admin', 'su_admin', '0'),
(2, 'rian', 'rian', 'admin', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_credential`
--

CREATE TABLE IF NOT EXISTS `user_credential` (
  `id_credential` int(5) NOT NULL AUTO_INCREMENT,
  `id_role` int(5) NOT NULL,
  `id_page` int(5) NOT NULL,
  PRIMARY KEY (`id_credential`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_credential`
--

INSERT INTO `user_credential` (`id_credential`, `id_role`, `id_page`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_page`
--

CREATE TABLE IF NOT EXISTS `user_page` (
  `id_page` int(5) NOT NULL AUTO_INCREMENT,
  `name_page` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `caption_page` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `uri_page` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_page`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_page`
--

INSERT INTO `user_page` (`id_page`, `name_page`, `caption_page`, `uri_page`) VALUES
(1, 'account', 'Account', 'dashboard/account/'),
(2, 'user_credential', 'User Credential', 'dashboard/credential/');

--
-- Triggers `user_page`
--
DROP TRIGGER IF EXISTS `UPDATE_USER_PAGE`;
DELIMITER //
CREATE TRIGGER `UPDATE_USER_PAGE` AFTER UPDATE ON `user_page`
 FOR EACH ROW BEGIN
    UPDATE user_credential SET user_credential.id_page = NEW.id_page WHERE user_credential.id_page = OLD.id_page;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id_role` int(5) NOT NULL AUTO_INCREMENT,
  `name_role` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `name_role` (`name_role`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `name_role`) VALUES
(1, 'su_admin'),
(2, 'admin');

--
-- Triggers `user_role`
--
DROP TRIGGER IF EXISTS `UPDATE_USER_ROLE`;
DELIMITER //
CREATE TRIGGER `UPDATE_USER_ROLE` AFTER UPDATE ON `user_role`
 FOR EACH ROW BEGIN
    UPDATE user_account SET user_account.name_role = NEW.name_role WHERE user_account.name_role = OLD.name_role;
    UPDATE user_credential SET user_credential.id_role = NEW.id_role WHERE user_credential.id_role = OLD.id_role;
END
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
