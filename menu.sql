/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : love

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-09-06 01:13:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `link` text,
  `status` int(11) DEFAULT '1' COMMENT '1. active  0. disable',
  `parent` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Trang chá»§', 'home', '1', '0');
INSERT INTO `menu` VALUES ('2', 'Thá»i trang nam', 'home', '1', '0');
INSERT INTO `menu` VALUES ('5', 'Ão sÆ¡ mi', 'home', '1', '2');
INSERT INTO `menu` VALUES ('6', 'Thá»i trang ná»¯', 'home', '1', '0');
INSERT INTO `menu` VALUES ('7', 'VÃ¡y', 'home', '1', '6');
INSERT INTO `menu` VALUES ('8', 'Phá»¥ kiá»‡n', 'home', '1', '0');

-- ----------------------------
-- Table structure for slide
-- ----------------------------
DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  `sub_image` varchar(255) DEFAULT NULL,
  `taxonomy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of slide
-- ----------------------------
INSERT INTO `slide` VALUES ('1', 'HÃ ng má»›i vá»', 'Thá»i trang cÃ¡ tÃ­nh', 'slide_5_57cdae07891af.jpg', 'slide_5_57cdae078997f.jpg', '1');
INSERT INTO `slide` VALUES ('2', 'Äáº§m thun ná»¯', 'váº£y ren cá»±c mÃ¡t', 'thumb(1)_57bc775627c02.jpg', 'sdfasdf', '1');
INSERT INTO `slide` VALUES ('3', 'HÃ ng Thu ÄÃ´ng', 'Äáº­m cháº¥t tÃ¢y Ã¢u', 'slide_6_57cdae238af61.jpg', 'slide_5_57cdae238b731.jpg', '1');

-- ----------------------------
-- Table structure for taxonomy
-- ----------------------------
DROP TABLE IF EXISTS `taxonomy`;
CREATE TABLE `taxonomy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxonomy_name` text,
  `type` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of taxonomy
-- ----------------------------
INSERT INTO `taxonomy` VALUES ('1', 'taxonomy', 'slide', null);
INSERT INTO `taxonomy` VALUES ('2', 'dafsdf', 'asdfasdf', '1');
