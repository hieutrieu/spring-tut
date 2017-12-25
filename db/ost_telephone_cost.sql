/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : ost_telephone_cost

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2017-12-22 19:45:10
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
  `cost` decimal(11,2) NOT NULL,
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
INSERT INTO `group` VALUES ('1', 'default', '', '0000-00-00 00:00:00', '2016-07-06 09:39:42', '1000', '500', '1');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `event` enum('error','info') NOT NULL DEFAULT 'info',
  `log` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `permission` enum('admin','group','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `monthly_limited_cost` decimal(15,2) NOT NULL DEFAULT '0.00',
  `monthly_used_cost` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('active','inactive','delete') DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `userpass` (`username`,`password`),
  KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('20', 'Trieu Trung Hieu', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '', '', '0', 'admin', '0000-00-00 00:00:00', '2017-12-05 11:41:41', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2080', 'Autonomous', 'Autonomous', '', '', '2417', null, null, 'user', '2017-12-22 19:31:45', '2017-12-22 19:31:45', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2081', 'Autonomous', 'Autonomous', '', '', '1402', null, null, 'user', '2017-12-22 19:31:45', '2017-12-22 19:31:45', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2082', 'Autonomous', 'Autonomous', '', '', '0904126578', null, null, 'user', '2017-12-22 19:31:45', '2017-12-22 19:31:45', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2083', 'Autonomous', 'Autonomous', '', '', '02473081616126578', null, null, 'user', '2017-12-22 19:31:45', '2017-12-22 19:31:45', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2084', 'Autonomous', 'Autonomous', '', '', '024730816163081616126578', null, null, 'user', '2017-12-22 19:31:45', '2017-12-22 19:31:45', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2085', 'Autonomous', 'Autonomous', '', '', '0247308161630816163081616126578', null, null, 'user', '2017-12-22 19:31:45', '2017-12-22 19:31:45', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2086', 'Autonomous', 'Autonomous', '', '', '1403', null, null, 'user', '2017-12-22 19:31:46', '2017-12-22 19:31:46', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2087', 'Autonomous', 'Autonomous', '', '', '1203', null, null, 'user', '2017-12-22 19:31:46', '2017-12-22 19:31:46', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2088', 'Autonomous', 'Autonomous', '', '', '1703', null, null, 'user', '2017-12-22 19:31:47', '2017-12-22 19:31:47', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2089', 'Autonomous', 'Autonomous', '', '', '1702', null, null, 'user', '2017-12-22 19:31:47', '2017-12-22 19:31:47', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2090', 'Autonomous', 'Autonomous', '', '', '2409', null, null, 'user', '2017-12-22 19:31:47', '2017-12-22 19:31:47', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2091', 'Autonomous', 'Autonomous', '', '', '1602', null, null, 'user', '2017-12-22 19:31:47', '2017-12-22 19:31:47', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2092', 'Autonomous', 'Autonomous', '', '', '1601', null, null, 'user', '2017-12-22 19:31:47', '2017-12-22 19:31:47', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2093', 'Autonomous', 'Autonomous', '', '', '2415', null, null, 'user', '2017-12-22 19:38:38', '2017-12-22 19:38:38', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2094', 'Autonomous', 'Autonomous', '', '', '1502', null, null, 'user', '2017-12-22 19:38:38', '2017-12-22 19:38:38', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2095', 'Autonomous', 'Autonomous', '', '', '2008', null, null, 'user', '2017-12-22 19:38:38', '2017-12-22 19:38:38', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2096', 'Autonomous', 'Autonomous', '', '', '2402', null, null, 'user', '2017-12-22 19:38:38', '2017-12-22 19:38:38', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2097', 'Autonomous', 'Autonomous', '', '', '1904', null, null, 'user', '2017-12-22 19:38:38', '2017-12-22 19:38:38', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2098', 'Autonomous', 'Autonomous', '', '', '2004', null, null, 'user', '2017-12-22 19:38:39', '2017-12-22 19:38:39', '0.00', '0.00', 'active');
INSERT INTO `user` VALUES ('2099', 'Autonomous', 'Autonomous', '', '', '2007', null, null, 'user', '2017-12-22 19:38:39', '2017-12-22 19:38:39', '0.00', '0.00', 'active');
