/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : love

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-09-16 23:46:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for contact
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of contact
-- ----------------------------
INSERT INTO `contact` VALUES ('1', 'LÆ°u Huy BÃ¬nh', 'luuhuybinh@gmail.com', '911635292', '5A Háº NH THÃ”NG', 'tieeu de', 'sfs asfs');
INSERT INTO `contact` VALUES ('2', 'LÆ°u Huy BÃ¬nh', 'luuhuybinh@gmail.com', '911635292', '5A Háº NH THÃ”NG', 'tieeu de', 'sfs asfs');
INSERT INTO `contact` VALUES ('3', 'LÆ°u Huy BÃ¬nh', 'luuhuybinh@gmail.com', '911635292', '5A Háº NH THÃ”NG', 'sfsdf ', 'aÌ€ sfs sf sff  ');
INSERT INTO `contact` VALUES ('7', 'LÆ°u Huy BÃ¬nh', 'luuhuybinh@gmail.com', '911635292', '5A Háº NH THÃ”NG', 'sffa', 'ssfasf');
INSERT INTO `contact` VALUES ('10', 'LÆ°u Huy BÃ¬nh', 'luuhuybinh@gmail.com', '911635292', '5A Háº NH THÃ”NG', 'sfasfasd', 'aÌ€dasfsdf');
INSERT INTO `contact` VALUES ('11', 'LÆ°u Huy BÃ¬nh', 'luuhuybinh@gmail.com', '911635292', '5A Háº NH THÃ”NG', 'sfasfasd', 'aÌ€dasfsdf');
INSERT INTO `contact` VALUES ('12', 'LÆ°u Huy BÃ¬nh', 'luuhuybinh@gmail.com', '911635292', '5A Háº NH THÃ”NG', 'sfasfasd', 'aÌ€dasfsdf');
INSERT INTO `contact` VALUES ('17', 'hoaÌ€ng phi huÌ€ng', 'huybinh@gmail.com', '919793909', 'nhaÌ€ mÄƒÌ£t phÃ´Ì', 'anh yÃªu em', 'seÌƒ viÌ€ em laÌ€m thÆ¡ tiÌ€nh aÌi\r\n');

-- ----------------------------
-- Table structure for orderct
-- ----------------------------
DROP TABLE IF EXISTS `orderct`;
CREATE TABLE `orderct` (
  `idpro` int(11) DEFAULT NULL,
  `idorder` int(11) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  KEY `proid` (`idpro`),
  KEY `orderid` (`idorder`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of orderct
-- ----------------------------
INSERT INTO `orderct` VALUES ('25', '94', '3');
INSERT INTO `orderct` VALUES ('27', '94', '2');
INSERT INTO `orderct` VALUES ('26', '95', '2');
INSERT INTO `orderct` VALUES ('26', '96', '2');
INSERT INTO `orderct` VALUES ('27', '96', '4');
INSERT INTO `orderct` VALUES ('25', '97', '1');
INSERT INTO `orderct` VALUES ('25', '98', '2');
INSERT INTO `orderct` VALUES ('33', '98', '3');

-- ----------------------------
-- Table structure for orderthathi
-- ----------------------------
DROP TABLE IF EXISTS `orderthathi`;
CREATE TABLE `orderthathi` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `status` int(4) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of orderthathi
-- ----------------------------
INSERT INTO `orderthathi` VALUES ('97', '1', 'LÆ°u Huy BÃ¬nh', 'luuhuybinh@gmail.com', '911635292', '5A Háº NH THÃ”NG', ' KhÃ¡nh HÃ²a ', 'zÃ¢Ìdfa');
INSERT INTO `orderthathi` VALUES ('98', '1', 'haÌ£o nam', 'binh@gmail.com', '09879786876', '5A Háº NH THÃ”NG ,P.3, GÃ’ Váº¤P', ' PhÃº YÃªn', 'tÃ´i ko cÃ¢Ì€n gÃ¢Ìp');
