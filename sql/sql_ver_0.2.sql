-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Waktu pembuatan: 07. Maret 2012 jam 19:49
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
