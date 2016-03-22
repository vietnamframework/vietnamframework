/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : love

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-03-23 01:04:40
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `content`
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` text,
  `content` text,
  `file_name` text,
  `tag` text,
  `authour_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
-- ----------------------------
INSERT INTO content VALUES ('1', '0', '1', 'hÃ³t news', 'sexy dance', 'hoahong.jpg', 'dalat#dkdfhd#', '1', null, null);

-- ----------------------------
-- Table structure for `frontend_trans`
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
-- Table structure for `func`
-- ----------------------------
DROP TABLE IF EXISTS `func`;
CREATE TABLE `func` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `func` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of func
-- ----------------------------
INSERT INTO func VALUES ('4', ' user/create', 'user create ');
INSERT INTO func VALUES ('5', ' news/create', 'news create ');

-- ----------------------------
-- Table structure for `grand_permission`
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
INSERT INTO grand_permission VALUES ('1', '2', '4', '1');
INSERT INTO grand_permission VALUES ('2', '2', '5', '1');

-- ----------------------------
-- Table structure for `group`
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
INSERT INTO group VALUES ('1', 'admin');
INSERT INTO group VALUES ('2', 'author');
INSERT INTO group VALUES ('3', 'user');

-- ----------------------------
-- Table structure for `language`
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
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `link` text,
  `status` int(11) DEFAULT '1' COMMENT '1. active  0. disable',
  `parent` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO menu VALUES ('1', 'HOme', 'index', '1', '0');
INSERT INTO menu VALUES ('2', 'tes2', 'user', '1', '0');
INSERT INTO menu VALUES ('3', 'tesst3', 'menu', '1', '0');

-- ----------------------------
-- Table structure for `url_friendly`
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
INSERT INTO url_friendly VALUES ('1', 'hungbuit', 'news', 'index');
INSERT INTO url_friendly VALUES ('2', 'hungbu', 'news', 'view');
INSERT INTO url_friendly VALUES ('3', 'test', 'index', 'test');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` tinytext,
  `pass` text,
  `email` text,
  `create` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO user VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', null, '2015-10-20 11:40:01');
INSERT INTO user VALUES ('2', 'hungbu', '202cb962ac59075b964b07152d234b70', null, '2015-10-28 09:25:49');
INSERT INTO user VALUES ('3', 'hungbuit', '202cb962ac59075b964b07152d234b70', null, '2015-10-28 09:29:21');
INSERT INTO user VALUES ('7', 'kaka', 'dfsdf', 'hungbuit@gmail.com', '2016-03-22 02:04:02');
INSERT INTO user VALUES ('16', 'fgf', '13b920adfaf00184fc0d4e5fee6f4551', 'ggfg@gfgfgfg.xx', '2016-03-22 02:30:49');
