-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `minerstatus`;
CREATE TABLE `minerstatus` (
  `ip_addr` varchar(255) NOT NULL,
  `last_action_at` datetime NOT NULL,
  `last_action_change` datetime DEFAULT NULL,
  `action` int(11) NOT NULL,
  PRIMARY KEY (`ip_addr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `seedqueue`;
CREATE TABLE `seedqueue` (
  `id_seedqueue` int(11) NOT NULL AUTO_INCREMENT,
  `id0` varchar(32) NOT NULL,
  `part1b64` varchar(4096) DEFAULT NULL,
  `friendcode` varchar(12) DEFAULT NULL,
  `taskId` varchar(32) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `claimedby` varchar(255) DEFAULT NULL,
  `time_started` datetime NOT NULL,
  PRIMARY KEY (`id_seedqueue`),
  KEY `index_state` (`state`),
  KEY `taskId_state` (`friendcode`,`id0`),
  KEY `tid_index` (`taskId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2020-03-25 10:08:47