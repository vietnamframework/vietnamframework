/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : hoctiengnhat

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2016-04-19 18:33:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` text,
  `parent` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'hame', '0');
INSERT INTO `category` VALUES ('2', 'category2', '1');

-- ----------------------------
-- Table structure for content
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` text,
  `lang_id` int(11) NOT NULL,
  `title` text,
  `content` text,
  `category_id` int(11) DEFAULT NULL,
  `file_name` text,
  `tag` text,
  `authour_id` int(11) DEFAULT NULL,
  `counter` int(11) unsigned DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
-- ----------------------------
INSERT INTO `content` VALUES ('1', '0', '1', 'hÃ³t news', 'sexy dance', '2', 'hoahong.jpg', 'dalat#dkdfhd#', '1', null, null, null);
INSERT INTO `content` VALUES ('2', '0', '1', 'dfdfdfd', 'sdfsdfdf', '1', 'fd', 'fdfdf', '1', null, null, null);
INSERT INTO `content` VALUES ('3', '0', '2', 'dfd', 'see you again<img src=\"http://localhost/vietnamframework.git/file_upload/katagana_56f4224939033.png\">', '2', 'katagana_56f429c55edbd.png', 'dfdfdfdf', '1', null, null, null);
INSERT INTO `content` VALUES ('5', '0', '1', 'fdfdfd', 'fdfdfdf', '1', 'dfdfdfd', 'fdsf', '1', null, null, null);
INSERT INTO `content` VALUES ('6', '0', '1', 'dfd', 'fsdfsdfsf', '2', null, 'dfsdf', '1', null, null, null);
INSERT INTO `content` VALUES ('7', '0', '1', 'fdfdfs', 'sdfsdfsdf', '1', null, 'dafdsf', '1', null, null, null);
INSERT INTO `content` VALUES ('8', '0', '2', 'title', 'dsfsdfsdf', '2', 'katagana_56f41fdcc692b.png', 'sdfsdf', '1', null, null, null);

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
-- Table structure for group_detail
-- ----------------------------
DROP TABLE IF EXISTS `group_detail`;
CREATE TABLE `group_detail` (
  `group_tv_id` int(11) NOT NULL,
  `tuvung_id` int(11) NOT NULL,
  PRIMARY KEY (`group_tv_id`,`tuvung_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of group_detail
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
-- Table structure for group_tv
-- ----------------------------
DROP TABLE IF EXISTS `group_tv`;
CREATE TABLE `group_tv` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of group_tv
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of language
-- ----------------------------
INSERT INTO `language` VALUES ('1', 'Viá»‡t Nam', 'vn', 'chÆ°a cÃ³');
INSERT INTO `language` VALUES ('2', 'English', 'en', 'chÆ°a cÃ³ ');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'HOme', 'index', '1', '0');
INSERT INTO `menu` VALUES ('2', 'tes2', 'user', '1', '0');
INSERT INTO `menu` VALUES ('3', 'tesst3', 'menu', '1', '0');
INSERT INTO `menu` VALUES ('4', 'home', '123', '1', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of slide
-- ----------------------------
INSERT INTO `slide` VALUES ('1', 'vacontimanhyeuem', 'vacontimanhyeuem', 'hiragana_56f43abe9cca2.png', 'katagana_56f43abe9d08a.png', '1');
INSERT INTO `slide` VALUES ('2', 'fa', 'dfasdfa', 'dfdfdf', 'sdfasdf', '1');

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

-- ----------------------------
-- Table structure for tuvung
-- ----------------------------
DROP TABLE IF EXISTS `tuvung`;
CREATE TABLE `tuvung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tuvung` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hantu` varchar(0) CHARACTER SET utf8 DEFAULT NULL,
  `phienam` varchar(0) CHARACTER SET utf8 DEFAULT NULL,
  `tiengviet` varchar(255) DEFAULT NULL,
  `bai_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tuvung
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
