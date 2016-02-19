/*
Navicat MySQL Data Transfer

Source Server         : My sql
Source Server Version : 50627
Source Host           : localhost:3306
Source Database       : love

Target Server Type    : MYSQL
Target Server Version : 50627
File Encoding         : 65001

Date: 2016-01-07 16:45:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for content
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `key` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` text,
  `content` text,
  `tag` text,
  `authour_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of url_friendly
-- ----------------------------
INSERT INTO `url_friendly` VALUES ('1', 'hungbuit', 'news', 'index');
INSERT INTO `url_friendly` VALUES ('2', 'hungbu', 'news', 'view');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` tinytext,
  `pass` text,
  `create` datetime ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '123456', '2015-10-20 11:40:01');
INSERT INTO `user` VALUES ('2', 'hungbu', '202cb962ac59075b964b07152d234b70', '2015-10-28 09:25:49');
INSERT INTO `user` VALUES ('3', 'hungbuit', '202cb962ac59075b964b07152d234b70', '2015-10-28 09:29:21');
