SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `acl` (
  `acl_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `aclroles_id` bigint(10) NOT NULL,
  `aclresources_id` bigint(10) NOT NULL,
  `state` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'allow',
  `application_id` bigint(10) NOT NULL DEFAULT '0',
  `client_id` bigint(10) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`acl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=67 ;

CREATE TABLE IF NOT EXISTS `aclresource` (
  `aclresources_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `resourceslug` varchar(255) COLLATE utf8_bin NOT NULL,
  `resourcename` varchar(255) COLLATE utf8_bin NOT NULL,
  `application_id` bigint(10) NOT NULL DEFAULT '0',
  `client_id` bigint(10) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`aclresources_id`),
  UNIQUE KEY `resourceslug` (`resourceslug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=31 ;

CREATE TABLE IF NOT EXISTS `aclrole` (
  `aclroles_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `roleslug` varchar(255) COLLATE utf8_bin NOT NULL,
  `rolename` varchar(255) COLLATE utf8_bin NOT NULL,
  `application_id` bigint(10) NOT NULL DEFAULT '0',
  `client_id` bigint(10) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`aclroles_id`),
  UNIQUE KEY `roleslug` (`roleslug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

CREATE TABLE IF NOT EXISTS `applications` (
  `application_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_bin NOT NULL,
  `shortname` text COLLATE utf8_bin NOT NULL,
  `path` text COLLATE utf8_bin NOT NULL,
  `url` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `client_id` bigint(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `clients` (
  `clients_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_bin NOT NULL,
  `extraname` text COLLATE utf8_bin NOT NULL,
  `homepage` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `contact` text COLLATE utf8_bin NOT NULL,
  `phone` text COLLATE utf8_bin NOT NULL,
  `statistics` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`clients_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

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
  `application_id` bigint(10) NOT NULL DEFAULT '0',
  `client_id` bigint(10) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=82 ;

CREATE TABLE IF NOT EXISTS `userprofile` (
  `user_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `street` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `city` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `country` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `cell` varchar(255) COLLATE utf8_bin NOT NULL,
  `twitter` text COLLATE utf8_bin NOT NULL,
  `facebook` text COLLATE utf8_bin NOT NULL,
  `skype` text COLLATE utf8_bin NOT NULL,
  `icq` text COLLATE utf8_bin NOT NULL,
  `application_id` bigint(10) NOT NULL DEFAULT '0',
  `client_id` bigint(10) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;
