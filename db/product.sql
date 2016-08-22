/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : love

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-08-22 21:28:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) DEFAULT NULL COMMENT 'ten san pham',
  `price` varchar(255) DEFAULT NULL COMMENT 'gia tinh tien',
  `price_display` varchar(255) DEFAULT NULL COMMENT 'gia hien thi',
  `discount` varchar(255) DEFAULT NULL COMMENT 'giam gia',
  `product_code` varchar(255) DEFAULT NULL COMMENT 'ma san pham',
  `status` int(11) DEFAULT '0' COMMENT 'tinh trang con hang san pham',
  `rate` int(11) DEFAULT NULL COMMENT 'danh gia',
  `description` varchar(255) DEFAULT NULL COMMENT 'mo ta chi tiet',
  `description_detail` varchar(255) DEFAULT NULL COMMENT 'mo ta san pham',
  `froms_product` varchar(255) DEFAULT NULL COMMENT 'xuat xu',
  `material` varchar(255) DEFAULT NULL COMMENT 'Chat lieu',
  `age_from` int(11) DEFAULT NULL COMMENT 'Tuoi From',
  `age_to` int(11) DEFAULT NULL COMMENT 'Tuoi to',
  `size_id` varchar(11) DEFAULT NULL COMMENT 'id size san pham',
  `genders` varchar(255) DEFAULT NULL COMMENT 'gioi tinh',
  `category_id` int(11) DEFAULT NULL COMMENT 'id category san pham',
  `image_avata` varchar(255) DEFAULT NULL COMMENT 'hinh dai dien',
  `image_detail_1` varchar(255) DEFAULT NULL,
  `image_detail_2` varchar(255) DEFAULT NULL,
  `image_detail_3` varchar(255) DEFAULT NULL,
  `image_detail_4` varchar(255) DEFAULT NULL,
  `image_detail_5` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL COMMENT 'key san pham - multi language',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('8', '1', '1', '1', '1', '1', '0', '1', '1', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '1', null, null, null);
INSERT INTO `product` VALUES ('9', '4', '44', '4', '4', '4', '0', '4', '4', '44', '4', null, null, null, null, null, null, null, null, null, null, null, null, '1', null, null, null);
INSERT INTO `product` VALUES ('10', '5', '5', '5', '5', '5', '0', '5', '5', '5', '5', null, null, null, null, null, null, null, null, null, null, null, null, '1', null, null, null);
INSERT INTO `product` VALUES ('11', '6', '6', '6', '6', '6', '0', '6', '6', '6', '6', null, null, null, null, null, null, null, null, null, null, null, null, '1', null, null, null);
INSERT INTO `product` VALUES ('12', '6', '6', '6', '6', '6', '0', '6', '6', '6', '6', '6', '6', null, null, null, null, null, null, null, null, null, null, '1', null, null, null);
INSERT INTO `product` VALUES ('13', '3', '3', '3', '3', '3', '0', '3', '3', '3', '3', '3', '3', '3', null, null, null, null, null, null, null, null, null, '1', null, null, null);
INSERT INTO `product` VALUES ('14', '4', '4', '4', '4', '4', '0', '4', '4', '4', '4', '4', '4', '4', '4', null, null, null, null, null, null, null, null, '1', null, null, null);
INSERT INTO `product` VALUES ('16', '2', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, '13820886_1013630098723180_232250977_n_57b91e06af332.jpg', '13720692_1013629935389863_1825420964_o_57b91e06af8a4.jpg', null, null, null, null, '1', null, null, null);
INSERT INTO `product` VALUES ('17', '2', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, null, null, null, null, null, '1', null, null, null);
INSERT INTO `product` VALUES ('18', 'biÌ€nh', '12', '12312', '11', '12312', '0', '12', 'anh nhÆ¡Ì em nhiÃªÌ€u lÄƒÌm', null, 'ÄFSF', '1', '212', '123', 'AÌ', null, '2', '14017962_1034093573343499_2020939511_n_57b9844977ec5.jpg', null, null, null, null, null, '1', null, null, null);
INSERT INTO `product` VALUES ('19', 'd', 'F', 'ff', 'ff', 'f', '0', '0', 'fsdfsdf', 'sfasfasdf saÌ€', 'd', 'd', '0', '0', 'd', null, '2', null, null, null, null, null, null, '1', null, null, null);
