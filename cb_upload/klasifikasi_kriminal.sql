/*
Navicat MySQL Data Transfer

Source Server         : local base
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : sig_crime

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-06-13 02:01:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for klasifikasi_kriminal
-- ----------------------------
DROP TABLE IF EXISTS `klasifikasi_kriminal`;
CREATE TABLE `klasifikasi_kriminal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `last_upadate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
