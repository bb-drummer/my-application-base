ALTER TABLE `acl` ADD `application_id` bigint(10) NOT NULL
ALTER TABLE `acl` ADD `client_id` bigint(10) NOT NULL
ALTER TABLE `acl` ADD `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
ALTER TABLE `acl` ADD `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
ALTER TABLE `aclresource` ADD `application_id` bigint(10) NOT NULL
ALTER TABLE `aclresource` ADD `client_id` bigint(10) NOT NULL
ALTER TABLE `aclresource` ADD `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
ALTER TABLE `aclresource` ADD `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
ALTER TABLE `aclrole` ADD `application_id` bigint(10) NOT NULL
ALTER TABLE `aclrole` ADD `client_id` bigint(10) NOT NULL
ALTER TABLE `aclrole` ADD `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
ALTER TABLE `aclrole` ADD `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
CREATE TABLE IF NOT EXISTS `application` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `url` text COLLATE utf8_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin
ALTER TABLE `settings` ADD `application_id` bigint(10) NOT NULL
ALTER TABLE `settings` ADD `client_id` bigint(10) NOT NULL
ALTER TABLE `settings` ADD `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
ALTER TABLE `settings` ADD `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
ALTER TABLE `settings` ADD `ref_id` bigint(10) NOT NULL
ALTER TABLE `settings` ADD `scope` varchar(255) COLLATE utf8_bin NOT NULL
ALTER TABLE `user` ADD `application_id` bigint(10) NOT NULL
ALTER TABLE `user` ADD `client_id` bigint(10) NOT NULL
ALTER TABLE `user` ADD `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
ALTER TABLE `user` ADD `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin