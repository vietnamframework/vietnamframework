/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : love

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-09-08 01:26:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mailmagazine
-- ----------------------------
DROP TABLE IF EXISTS `mailmagazine`;
CREATE TABLE `mailmagazine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `del_flg` int(11) DEFAULT '0',
  `add_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mailmagazine
-- ----------------------------
INSERT INTO `mailmagazine` VALUES ('1', 'luuhuybinh@gmail.com', '0', '2016-09-07 23:31:59');
INSERT INTO `mailmagazine` VALUES ('2', 'hungbuit@gmail.com', '0', '2016-09-07 23:33:47');
