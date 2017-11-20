/*
Navicat MySQL Data Transfer

Source Server         : 1. Localhost
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : ost_telephone_cost

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-07-04 14:43:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for call_histories
-- ----------------------------
DROP TABLE IF EXISTS `call_histories`;
CREATE TABLE `call_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `from_phone_number` varchar(255) CHARACTER SET utf8 NOT NULL,
  `to_phone_number` varchar(255) CHARACTER SET utf8 NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'number seconds',
  `cost` decimal(11,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `called_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of call_histories
-- ----------------------------

-- ----------------------------
-- Table structure for file_scans
-- ----------------------------
DROP TABLE IF EXISTS `file_scans`;
CREATE TABLE `file_scans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `path_file` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` enum('waiting','processing','success','failed') NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of file_scans
-- ----------------------------

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `price_start` float DEFAULT NULL,
  `price_end` float DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('1', '4656', '', '0000-00-00 00:00:00', '2016-06-29 13:41:58', '1000', '500', '1');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event` varchar(45) NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `phone_number` varchar(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `permission` enum('admin','group','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `monthly_limited_cost` decimal(15,2) NOT NULL DEFAULT '0.00',
  `monthly_used_cost` decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `userpass` (`username`,`password`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('20', 'Trieu Trung Hieu', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '', null, null, 'admin', '0000-00-00 00:00:00', '2016-01-14 10:02:20', '0.00', '0.00');
INSERT INTO `user` VALUES ('21', 'hiepdh', 'hiepdh', '21232f297a57a5a743894a0e4a801fc3', 'hiepdh@saobacdau.vn', '4656', '22 Hoang hoa Tham', '1', 'group', '0000-00-00 00:00:00', '2016-07-04 14:43:11', '100000.00', '100000.00');
