-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Waktu pembuatan: 08. Maret 2012 jam 00:58
-- Versi Server: 5.0.45
-- Versi PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `db_lulu`
-- 

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_customer`
-- 

CREATE TABLE `m_customer` (
  `code_customer` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `name_customer` varchar(150) character set utf8 collate utf8_unicode_ci NOT NULL,
  `address_customer` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `postal_code_customer` int(6) NOT NULL,
  `phone_customer` varchar(15) character set utf8 collate utf8_unicode_ci NOT NULL,
  `email_customer` varchar(150) character set utf8 collate utf8_unicode_ci NOT NULL,
  `status_customer` enum('0','1') character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`code_customer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data untuk tabel `m_customer`
-- 

INSERT INTO `m_customer` VALUES ('B001', 'Feldy', 'Depok', 16417, '02199699433,087', 'feldy@ar.vom', '1');
INSERT INTO `m_customer` VALUES ('B002', 'Rian', 'Cianjur', 16418, '087865464321', 'rian@dc.com', '1');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_detail_transaction`
-- 

CREATE TABLE `m_detail_transaction` (
  `id_detail_transaction` int(11) NOT NULL auto_increment,
  `code_transaction` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `code_product` varchar(50) NOT NULL,
  `quantity_detail_transaction` int(11) NOT NULL,
  `description_detail_transaction` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `status_detail_transaction` enum('0','1') character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_detail_transaction`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- 
-- Dumping data untuk tabel `m_detail_transaction`
-- 

INSERT INTO `m_detail_transaction` VALUES (13, 'B002', '15', 0, 'Gila', '1');
INSERT INTO `m_detail_transaction` VALUES (11, 'B001CS', 'B002', 6, '', '');
INSERT INTO `m_detail_transaction` VALUES (10, 'B001CS', 'B001', 3, 'Enak Sekali', '');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_product`
-- 

CREATE TABLE `m_product` (
  `code_product` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `group_product` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `name_product` varchar(150) character set utf8 collate utf8_unicode_ci NOT NULL,
  `size_product` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `stock_product` int(8) NOT NULL,
  `price_product` bigint(15) NOT NULL,
  `status_product` enum('0','1') character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`code_product`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data untuk tabel `m_product`
-- 

INSERT INTO `m_product` VALUES ('B001', 'SATE', 'Sate Padang', '120 tusuk', 60, 12000, '1');
INSERT INTO `m_product` VALUES ('B002', 'Sop', 'Sop Kambing', '1 Mangkok', 40, 10000, '1');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `m_transaction`
-- 

CREATE TABLE `m_transaction` (
  `code_transaction` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `code_customer` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `time_transaction` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `sub_office_transaction` int(5) NOT NULL,
  `cost_type_transaction` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `status_transaction` enum('0','1') character set utf8 collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data untuk tabel `m_transaction`
-- 

INSERT INTO `m_transaction` VALUES ('B001CS', 'B001', '2012-03-07 23:36:09', 0, 'ee', '1');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `user_account`
-- 

CREATE TABLE `user_account` (
  `id_account` int(5) NOT NULL auto_increment,
  `username_account` varchar(75) collate utf8_unicode_ci NOT NULL,
  `password_account` varchar(150) collate utf8_unicode_ci NOT NULL,
  `name_role` varchar(75) collate utf8_unicode_ci NOT NULL,
  `status_account` enum('0','1') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_account`),
  UNIQUE KEY `username` (`username_account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data untuk tabel `user_account`
-- 

INSERT INTO `user_account` VALUES (1, 'admin', 'admin', 'su_admin', '0');
INSERT INTO `user_account` VALUES (2, 'rian', 'rian', 'admin', '0');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `user_credential`
-- 

CREATE TABLE `user_credential` (
  `id_credential` int(5) NOT NULL auto_increment,
  `id_role` int(5) NOT NULL,
  `id_page` int(5) NOT NULL,
  PRIMARY KEY  (`id_credential`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data untuk tabel `user_credential`
-- 

INSERT INTO `user_credential` VALUES (1, 1, 1);
INSERT INTO `user_credential` VALUES (2, 2, 1);
INSERT INTO `user_credential` VALUES (3, 1, 2);

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `user_page`
-- 

CREATE TABLE `user_page` (
  `id_page` int(5) NOT NULL auto_increment,
  `name_page` varchar(75) collate utf8_unicode_ci NOT NULL,
  `caption_page` varchar(75) collate utf8_unicode_ci NOT NULL,
  `uri_page` varchar(150) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_page`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data untuk tabel `user_page`
-- 

INSERT INTO `user_page` VALUES (1, 'account', 'Account', 'dashboard/account/');
INSERT INTO `user_page` VALUES (2, 'user_credential', 'User Credential', 'dashboard/credential/');

-- --------------------------------------------------------

-- 
-- Struktur dari tabel `user_role`
-- 

CREATE TABLE `user_role` (
  `id_role` int(5) NOT NULL auto_increment,
  `name_role` varchar(75) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_role`),
  UNIQUE KEY `name_role` (`name_role`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data untuk tabel `user_role`
-- 

INSERT INTO `user_role` VALUES (1, 'su_admin');
INSERT INTO `user_role` VALUES (2, 'admin');
