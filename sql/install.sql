-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: xampp2.mysql.local:5506
-- Erstellungszeit: 21. Aug 2015 um 19:38
-- Server Version: 5.1.44
-- PHP-Version: 5.6.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `dbmyapplication`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
  `acl_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `aclroles_id` bigint(10) NOT NULL,
  `aclresources_id` bigint(10) NOT NULL,
  `state` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'allow',
  PRIMARY KEY (`acl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ;

--
-- Daten für Tabelle `acl`
--

INSERT INTO `acl` (`acl_id`, `aclroles_id`, `aclresources_id`, `state`) VALUES
(1, 4, 1, 'allow'),
(61, 1, 4, 'allow'),
(3, 1, 1, 'deny'),
(47, 4, 4, 'deny'),
(66, 6, 2, 'allow'),
(65, 6, 1, 'deny'),
(64, 6, 4, 'deny'),
(63, 4, 2, 'deny'),
(62, 1, 2, 'allow');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aclresource`
--

CREATE TABLE IF NOT EXISTS `aclresource` (
  `aclresources_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `resourceslug` varchar(255) COLLATE utf8_bin NOT NULL,
  `resourcename` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`aclresources_id`),
  UNIQUE KEY `resourceslug` (`resourceslug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ;

--
-- Daten für Tabelle `aclresource`
--

INSERT INTO `aclresource` (`aclresources_id`, `resourceslug`, `resourcename`) VALUES
(1, 'mvc:nouser', 'kein Benutzer'),
(2, 'mvc:user', 'Benutzer'),
(4, 'mvc:admin', 'Administration');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aclrole`
--

CREATE TABLE IF NOT EXISTS `aclrole` (
  `aclroles_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `roleslug` varchar(255) COLLATE utf8_bin NOT NULL,
  `rolename` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`aclroles_id`),
  UNIQUE KEY `roleslug` (`roleslug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ;

--
-- Daten für Tabelle `aclrole`
--

INSERT INTO `aclrole` (`aclroles_id`, `roleslug`, `rolename`) VALUES
(1, 'admin', 'Administrator'),
(4, 'public', 'kein Benutzer'),
(6, 'user', 'Benutzer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) COLLATE utf8_bin NOT NULL,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `value` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`settings_id`),
  UNIQUE KEY `type_name` (`type`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ;

--
-- Daten für Tabelle `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `name`, `value`) VALUES
(1, 'system', 'lang', 'de_DE'),
(2, 'user', 'lang', 'de_DE');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `street` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `city` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `phone` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `state` smallint(5) NOT NULL DEFAULT '1',
  `aclrole` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'swimmer',
  `token` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `display_name`, `username`, `email`, `street`, `city`, `phone`, `password`, `state`, `aclrole`, `token`) VALUES
(1, 'System-Administrator', 'sysadmin', 'webmaster@myapplication.tld', '', '', '', '$2y$14$aNr/FPiS.Kbw8/ZYiOaXpum/4RrX7AGMaxA5vV6OIHUi1kr.w6GgC', 1, 'admin', '');
