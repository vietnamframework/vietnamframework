/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100110
Source Host           : localhost:3306
Source Database       : love

Target Server Type    : MYSQL
Target Server Version : 100110
File Encoding         : 65001

Date: 2016-03-22 14:41:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for content
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` text,
  `content` text,
  `tag` text,
  `file_name` varchar(150) DEFAULT NULL,
  `authour_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
-- ----------------------------

-- ----------------------------
-- Table structure for download_structure
-- ----------------------------
DROP TABLE IF EXISTS `download_structure`;
CREATE TABLE `download_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Title or Content or Image',
  `description` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xpath` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref_link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'webiste download',
  `element_remove` int(11) DEFAULT '0' COMMENT 'when is 1 then remove elemte from html',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of download_structure
-- ----------------------------

-- ----------------------------
-- Table structure for frontend_trans
-- ----------------------------
DROP TABLE IF EXISTS `frontend_trans`;
CREATE TABLE `frontend_trans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` text,
  `content` text,
  `lang_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of frontend_trans
-- ----------------------------

-- ----------------------------
-- Table structure for func_permission
-- ----------------------------
DROP TABLE IF EXISTS `func_permission`;
CREATE TABLE `func_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `func` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of func_permission
-- ----------------------------
INSERT INTO `func_permission` VALUES ('4', ' user/create', 'user create ');
INSERT INTO `func_permission` VALUES ('5', ' news/create', 'news create ');

-- ----------------------------
-- Table structure for grand_permission
-- ----------------------------
DROP TABLE IF EXISTS `grand_permission`;
CREATE TABLE `grand_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) DEFAULT NULL,
  `funcid` int(11) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grand_permission
-- ----------------------------
INSERT INTO `grand_permission` VALUES ('1', '2', '4', '1');
INSERT INTO `grand_permission` VALUES ('2', '2', '5', '1');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group
-- ----------------------------

-- ----------------------------
-- Table structure for group_permission
-- ----------------------------
DROP TABLE IF EXISTS `group_permission`;
CREATE TABLE `group_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group_permission
-- ----------------------------
INSERT INTO `group_permission` VALUES ('1', 'admin');
INSERT INTO `group_permission` VALUES ('2', 'author');
INSERT INTO `group_permission` VALUES ('3', 'user');

-- ----------------------------
-- Table structure for language
-- ----------------------------
DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(255) DEFAULT NULL COMMENT 'language name',
  `short_name` varchar(255) DEFAULT NULL COMMENT 'short name',
  `flag` varchar(255) DEFAULT NULL COMMENT 'language flag',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of language
-- ----------------------------

-- ----------------------------
-- Table structure for url_friendly
-- ----------------------------
DROP TABLE IF EXISTS `url_friendly`;
CREATE TABLE `url_friendly` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_friendly` text,
  `controller` tinytext,
  `action` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of url_friendly
-- ----------------------------
INSERT INTO `url_friendly` VALUES ('1', 'hungbuit', 'news', 'index');
INSERT INTO `url_friendly` VALUES ('2', 'hungbu', 'news', 'view');
INSERT INTO `url_friendly` VALUES ('3', 'test', 'index', 'test');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` tinytext,
  `pass` text,
  `email` text,
  `create` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '123456', null, '2015-10-20 11:40:01');
INSERT INTO `user` VALUES ('2', 'hungbu', '202cb962ac59075b964b07152d234b70', null, '2015-10-28 09:25:49');
INSERT INTO `user` VALUES ('3', 'hungbuit', '202cb962ac59075b964b07152d234b70', null, '2015-10-28 09:29:21');
