/*
Navicat MySQL Data Transfer

Source Server         : MysQL
Source Server Version : 50136
Source Host           : localhost:3306
Source Database       : activebook

Target Server Type    : MYSQL
Target Server Version : 50136
File Encoding         : 65001

Date: 2011-04-30 13:49:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `active_book`
-- ----------------------------
DROP TABLE IF EXISTS `active_book`;
CREATE TABLE `active_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auteur` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `message` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ip` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `temp` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of active_book
-- ----------------------------
