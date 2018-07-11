/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : configcenter

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-07-11 20:44:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `authmanage`
-- ----------------------------
DROP TABLE IF EXISTS `authmanage`;
CREATE TABLE `authmanage` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `username` varchar(100) DEFAULT NULL COMMENT '用户英文名称（RTX英文名）',
  `auth` varchar(2000) DEFAULT 'all' COMMENT 'all(超级管理员) （region;product)->有区域及产品权限',
  `admin` varchar(100) DEFAULT NULL COMMENT '最近权限处理人',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of authmanage
-- ----------------------------
INSERT INTO `authmanage` VALUES ('1', 'jkjunjia', 'all', null, '2018-07-11 16:54:37', '2018-07-11 16:54:42');
INSERT INTO `authmanage` VALUES ('2', 'jk', 'region', null, '2018-07-11 16:54:39', '2018-07-11 16:55:52');

-- ----------------------------
-- Table structure for `cconf`
-- ----------------------------
DROP TABLE IF EXISTS `cconf`;
CREATE TABLE `cconf` (
  `confId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `confName` varchar(255) NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDel` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`confId`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cconf
-- ----------------------------
INSERT INTO `cconf` VALUES ('158', 'db_main', '2018-05-14 16:44:02', '0');
INSERT INTO `cconf` VALUES ('159', 'db.vsatation.main', '2018-05-15 14:49:31', '0');
INSERT INTO `cconf` VALUES ('160', 'db.CCDB4.main', '2018-05-17 18:44:46', '0');
INSERT INTO `cconf` VALUES ('161', 'db.CCDB4.slave', '2018-05-17 18:45:00', '0');
INSERT INTO `cconf` VALUES ('162', 'db.CCDB4.ro', '2018-05-17 18:45:10', '0');
INSERT INTO `cconf` VALUES ('163', 'db.vsatation.slave', '2018-05-17 18:52:14', '0');
INSERT INTO `cconf` VALUES ('164', 'db.vsatation.ro', '2018-05-17 18:52:21', '0');
INSERT INTO `cconf` VALUES ('165', 'db.des.master', '2018-05-17 18:53:40', '0');
INSERT INTO `cconf` VALUES ('166', 'db.des.slave', '2018-05-17 18:54:31', '0');
INSERT INTO `cconf` VALUES ('167', 'db.des.main', '2018-05-17 18:55:55', '0');
INSERT INTO `cconf` VALUES ('168', 'db.spot.main', '2018-06-19 15:15:56', '0');
INSERT INTO `cconf` VALUES ('169', 'test.samomo', '2018-07-09 15:26:32', '0');

-- ----------------------------
-- Table structure for `cmodule`
-- ----------------------------
DROP TABLE IF EXISTS `cmodule`;
CREATE TABLE `cmodule` (
  `moduleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `moduleName` varchar(255) NOT NULL,
  `moduleDesc` varchar(255) DEFAULT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`moduleId`),
  UNIQUE KEY `name` (`moduleName`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cmodule
-- ----------------------------
INSERT INTO `cmodule` VALUES ('23', 'test', null, '2018-05-14 16:14:00');
INSERT INTO `cmodule` VALUES ('24', 'vstation', null, '2018-05-14 16:42:28');
INSERT INTO `cmodule` VALUES ('25', 'ccdb', null, '2018-05-15 11:02:55');
INSERT INTO `cmodule` VALUES ('26', 'des', null, '2018-05-15 11:03:04');
INSERT INTO `cmodule` VALUES ('27', 'spot', null, '2018-06-19 15:09:01');

-- ----------------------------
-- Table structure for `cproduct`
-- ----------------------------
DROP TABLE IF EXISTS `cproduct`;
CREATE TABLE `cproduct` (
  `productId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) NOT NULL,
  `productDesc` varchar(255) DEFAULT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='QSDB产品表';

-- ----------------------------
-- Records of cproduct
-- ----------------------------
INSERT INTO `cproduct` VALUES ('1', 'qcloud', '腾讯云', '2018-05-16 16:42:36');

-- ----------------------------
-- Table structure for `cregion`
-- ----------------------------
DROP TABLE IF EXISTS `cregion`;
CREATE TABLE `cregion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `region` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `type` enum('other','product','test','dev') NOT NULL DEFAULT 'product',
  `desc` varchar(255) DEFAULT NULL,
  `createTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_region` (`region`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cregion
-- ----------------------------
INSERT INTO `cregion` VALUES ('1', 'bj', '北京', 'product', null, '2018-05-15 11:03:50');
INSERT INTO `cregion` VALUES ('2', 'ca', '北美', 'product', null, '2018-05-15 14:53:11');
INSERT INTO `cregion` VALUES ('3', 'cd', '成都', 'product', null, '2018-05-17 19:18:53');
INSERT INTO `cregion` VALUES ('4', 'cq', '重庆', 'product', null, '2018-05-17 19:19:18');
INSERT INTO `cregion` VALUES ('5', 'de', '德国', 'product', null, '2018-05-17 19:19:01');
INSERT INTO `cregion` VALUES ('6', 'dev', 'dev', 'product', null, '2018-05-14 16:13:52');
INSERT INTO `cregion` VALUES ('7', 'gz', '广州', 'product', null, '2018-05-15 11:04:08');
INSERT INTO `cregion` VALUES ('8', 'gzopen', '广州Open', 'product', null, '2018-05-17 19:17:12');
INSERT INTO `cregion` VALUES ('9', 'hk', '香港区', 'product', null, '2018-05-17 19:14:08');
INSERT INTO `cregion` VALUES ('10', 'in', '印度', 'product', null, '2018-05-17 19:19:30');
INSERT INTO `cregion` VALUES ('11', 'kr', '韩国', 'product', null, '2018-05-17 19:19:08');
INSERT INTO `cregion` VALUES ('12', 'sg', '新加坡', 'product', null, '2018-05-17 19:17:21');
INSERT INTO `cregion` VALUES ('13', 'sh', '上海', 'product', null, '2018-05-15 11:04:00');
INSERT INTO `cregion` VALUES ('14', 'shjr', '上海金融', 'product', null, '2018-05-17 19:14:18');
INSERT INTO `cregion` VALUES ('15', 'shysx', '上海沙箱云', 'product', null, '2018-05-17 19:18:14');
INSERT INTO `cregion` VALUES ('16', 'std', 'std', 'other', null, '2018-05-14 16:13:24');
INSERT INTO `cregion` VALUES ('17', 'szjr', '深圳金融', 'product', null, '2018-05-17 19:14:28');
INSERT INTO `cregion` VALUES ('18', 'th', '泰国', 'product', null, '2018-05-17 19:19:38');
INSERT INTO `cregion` VALUES ('19', 'use', '美东--阿什本', 'product', null, '2018-05-17 19:18:39');
INSERT INTO `cregion` VALUES ('20', 'usw', '美西--硅谷', 'product', null, '2018-05-17 19:18:27');
INSERT INTO `cregion` VALUES ('21', '240001', '俄罗斯', 'product', null, '2018-06-19 15:10:45');
INSERT INTO `cregion` VALUES ('22', 'ru', '俄罗斯', 'product', null, '2018-06-19 15:10:55');

-- ----------------------------
-- Table structure for `dconfvalue_240001`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_240001`;
CREATE TABLE `dconfvalue_240001` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_240001
-- ----------------------------
INSERT INTO `dconfvalue_240001` VALUES ('158', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:25');
INSERT INTO `dconfvalue_240001` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:30');
INSERT INTO `dconfvalue_240001` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-17 18:44:46');
INSERT INTO `dconfvalue_240001` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-17 18:45:16');
INSERT INTO `dconfvalue_240001` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-17 18:45:21');
INSERT INTO `dconfvalue_240001` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:34');
INSERT INTO `dconfvalue_240001` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:38');
INSERT INTO `dconfvalue_240001` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_240001` VALUES ('166', 'cee_v21_qae_des', '', '2018-05-17 18:54:31');
INSERT INTO `dconfvalue_240001` VALUES ('167', 'cee_v21_qae_des', '', '2018-05-17 18:55:55');

-- ----------------------------
-- Table structure for `dconfvalue_bj`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_bj`;
CREATE TABLE `dconfvalue_bj` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_bj
-- ----------------------------
INSERT INTO `dconfvalue_bj` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_bj` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"10.53.216.201\", \"port\" :15285, \"user\" : \"root\" , \"passwd\" : \"W3m3#nT6eE\"}', '', '2018-05-17 19:44:33');
INSERT INTO `dconfvalue_bj` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"10.53.216.201\", \"port\" :15145, \"user\" : \"root\" , \"passwd\" : \"e48yv_3RBQ\"}', '', '2018-05-17 19:12:33');
INSERT INTO `dconfvalue_bj` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"10.53.216.202\", \"port\" :15975, \"user\" : \"slaveroot\" , \"passwd\" : \"HmrT5D@72m\"}', '', '2018-05-17 19:12:39');
INSERT INTO `dconfvalue_bj` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"10.53.216.203\", \"port\" :4447, \"user\" : \"slaveroot\" , \"passwd\" : \"HmrT5D@72m\"}', '', '2018-05-17 19:12:45');
INSERT INTO `dconfvalue_bj` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"10.53.216.202\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"27*y9qXSfU\"}', '', '2018-05-17 19:44:40');
INSERT INTO `dconfvalue_bj` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"100.91.230.53\", \"port\" :5084, \"user\" : \"slaveroot\" , \"passwd\" : \"27*y9qXSfU\"}', '', '2018-05-17 19:45:04');
INSERT INTO `dconfvalue_bj` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.53.216.202\", \"port\" :18315, \"user\" : \"slaveroot\" , \"passwd\" : \"3#L7af5GgX\"}', '', '2018-05-17 20:00:18');
INSERT INTO `dconfvalue_bj` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.53.216.201\", \"port\" :15156, \"user\" : \"root\" , \"passwd\" : \"_grY1F4W5p\"}', '', '2018-05-17 20:00:24');
INSERT INTO `dconfvalue_bj` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"100.91.230.51\", \"port\" :16976, \"user\" : \"root\" , \"passwd\" : \"3CU5ug7_sK\"}', '', '2018-06-19 15:33:30');

-- ----------------------------
-- Table structure for `dconfvalue_ca`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_ca`;
CREATE TABLE `dconfvalue_ca` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_ca
-- ----------------------------
INSERT INTO `dconfvalue_ca` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_ca` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"10.116.19.171\", \"port\" :3304, \"user\" : \"root\" , \"passwd\" : \"aEx!yG81P8\"}', '{\'abc\':1234}', '2018-05-17 19:43:46');
INSERT INTO `dconfvalue_ca` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"10.116.19.171\", \"port\" :3300, \"user\" : \"root\" , \"passwd\" : \"zB4uS4r*L6\"}', '', '2018-05-17 19:13:38');
INSERT INTO `dconfvalue_ca` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"10.116.19.172\", \"port\" :3301, \"user\" : \"slaveroot\" , \"passwd\" : \"y6Ai^S3Gd4\"}', '', '2018-05-17 19:13:44');
INSERT INTO `dconfvalue_ca` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"10.116.19.173\", \"port\" :3891, \"user\" : \"slaveroot\" , \"passwd\" : \"y6Ai^S3Gd4\"}', '', '2018-05-17 19:13:50');
INSERT INTO `dconfvalue_ca` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"10.116.19.172\", \"port\" :6136, \"user\" : \"slaveroot\" , \"passwd\" : \"79zKbm_M4F\"}', '', '2018-05-17 19:43:51');
INSERT INTO `dconfvalue_ca` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"10.116.19.173\", \"port\" :7398, \"user\" : \"slaveroot\" , \"passwd\" : \"79zKbm_M4F\"}', '', '2018-05-17 19:43:57');
INSERT INTO `dconfvalue_ca` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.116.19.172\", \"port\" :3302, \"user\" : \"slaveroot\" , \"passwd\" : \"g5avU#68GM\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.116.19.171\", \"port\" :3312, \"user\" : \"root\" , \"passwd\" : \"u1gXTE71p\"}', '2018-05-17 19:59:48');
INSERT INTO `dconfvalue_ca` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.116.19.171\", \"port\" :3312, \"user\" : \"root\" , \"passwd\" : \"u1gXTE71p\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.116.19.172\", \"port\" :3302, \"user\" : \"slaveroot\" , \"passwd\" : \"g5avU#68GM\"}', '2018-05-17 19:59:54');
INSERT INTO `dconfvalue_ca` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"10.116.19.171\", \"port\" :3425, \"user\" : \"root\" , \"passwd\" : \"PQZy9v19h@\"}', '', '2018-06-19 15:36:35');

-- ----------------------------
-- Table structure for `dconfvalue_cd`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_cd`;
CREATE TABLE `dconfvalue_cd` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_cd
-- ----------------------------
INSERT INTO `dconfvalue_cd` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_cd` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"100.88.224.3\", \"port\" :15145, \"user\" : \"root\" , \"passwd\" : \"66hQ2^bHxK\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:47:04');
INSERT INTO `dconfvalue_cd` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"100.88.224.3\", \"port\" :15360, \"user\" : \"root\" , \"passwd\" : \"3Z^Tt8F5ee\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:21:28');
INSERT INTO `dconfvalue_cd` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"100.88.224.4\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"K7_15xmUnE\"}\n', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:21:34');
INSERT INTO `dconfvalue_cd` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"100.88.224.5\", \"port\" :15975, \"user\" : \"slaveroot\" , \"passwd\" : \"K7_15xmUnE\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:21:39');
INSERT INTO `dconfvalue_cd` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"100.88.224.4\", \"port\" :15558, \"user\" : \"slaveroot\" , \"passwd\" : \"QLsg%2Ks68\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:47:10');
INSERT INTO `dconfvalue_cd` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"100.88.224.5\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"QLsg%2Ks68\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:47:16');
INSERT INTO `dconfvalue_cd` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_cd` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.88.224.4\", \"port\" :15975, \"user\" : \"slaveroot\" , \"passwd\" : \"V5x2_2wEqH\"}', 'cee_v21_qae_des', '2018-05-17 20:04:53');
INSERT INTO `dconfvalue_cd` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.88.224.3\", \"port\" :15451, \"user\" : \"root\" , \"passwd\" : \"sgw2ST5G5!\"}', 'cee_v21_qae_des', '2018-05-17 20:04:58');
INSERT INTO `dconfvalue_cd` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"100.88.224.3\", \"port\" :13004, \"user\" : \"root\" , \"passwd\" : \"P65Y6zGw#h\"}', '', '2018-06-19 15:36:12');

-- ----------------------------
-- Table structure for `dconfvalue_cq`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_cq`;
CREATE TABLE `dconfvalue_cq` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_cq
-- ----------------------------
INSERT INTO `dconfvalue_cq` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_cq` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"100.98.100.81\", \"port\" :15558, \"user\" : \"root\" , \"passwd\" : \"6_a2W8UWwg\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:48:08');
INSERT INTO `dconfvalue_cq` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"100.98.100.81\", \"port\" :17433, \"user\" : \"root\" , \"passwd\" : \"G36Yr5gd%T\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:22:28');
INSERT INTO `dconfvalue_cq` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"100.98.100.82\", \"port\" :15558, \"user\" : \"slaveroot\" , \"passwd\" : \"z99rk2KR^B\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:22:32');
INSERT INTO `dconfvalue_cq` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"100.98.100.83\", \"port\" :15452, \"user\" : \"slaveroot\" , \"passwd\" : \"z99rk2KR^B\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:22:38');
INSERT INTO `dconfvalue_cq` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"100.98.100.82\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"a_MP15Q6aq\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:48:13');
INSERT INTO `dconfvalue_cq` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"100.98.100.83\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"a_MP15Q6aq\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:48:19');
INSERT INTO `dconfvalue_cq` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_cq` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.98.100.82\", \"port\" :15451, \"user\" : \"slaveroot\" , \"passwd\" : \"ccR2u^46VR\"}', 'cee_v21_qae_des', '2018-05-17 20:05:42');
INSERT INTO `dconfvalue_cq` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.98.100.81\", \"port\" :17711, \"user\" : \"root\" , \"passwd\" : \"bp3W1S@6vD\"}', 'cee_v21_qae_des', '2018-05-17 20:05:47');
INSERT INTO `dconfvalue_cq` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"100.98.100.81\", \"port\" :9472, \"user\" : \"root\" , \"passwd\" : \"feV^F19e6F\"}', '', '2018-06-19 15:36:23');

-- ----------------------------
-- Table structure for `dconfvalue_de`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_de`;
CREATE TABLE `dconfvalue_de` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_de
-- ----------------------------
INSERT INTO `dconfvalue_de` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_de` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"100.120.52.3\", \"port\" :15145, \"user\" : \"root\" , \"passwd\" : \"8ke%LQ42Qe\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:47:23');
INSERT INTO `dconfvalue_de` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"100.120.52.3\", \"port\" :15682, \"user\" : \"root\" , \"passwd\" : \"bkGM5P6u@1\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:21:48');
INSERT INTO `dconfvalue_de` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"100.120.52.4\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"2k83p#TQFi\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:21:53');
INSERT INTO `dconfvalue_de` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"100.120.52.5\", \"port\" :15360, \"user\" : \"slaveroot\" , \"passwd\" : \"2k83p#TQFi\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:21:58');
INSERT INTO `dconfvalue_de` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"100.120.52.4\", \"port\" :15558, \"user\" : \"slaveroot\" , \"passwd\" : \"P_g5b3qA4D\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:47:29');
INSERT INTO `dconfvalue_de` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"100.120.52.5\", \"port\" :15452, \"user\" : \"slaveroot\" , \"passwd\" : \"P_g5b3qA4D\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:47:34');
INSERT INTO `dconfvalue_de` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_de` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.120.52.4\", \"port\" :15681, \"user\" : \"slaveroot\" , \"passwd\" : \"vgVB^5Ab78\"}', 'cee_v21_qae_des', '2018-05-17 20:05:06');
INSERT INTO `dconfvalue_de` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.120.52.3\", \"port\" :15558, \"user\" : \"root\" , \"passwd\" : \"V3Yd89*Tdi\"}', 'cee_v21_qae_des', '2018-05-17 20:05:12');

-- ----------------------------
-- Table structure for `dconfvalue_dev`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_dev`;
CREATE TABLE `dconfvalue_dev` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_dev
-- ----------------------------

-- ----------------------------
-- Table structure for `dconfvalue_gz`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_gz`;
CREATE TABLE `dconfvalue_gz` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_gz
-- ----------------------------
INSERT INTO `dconfvalue_gz` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_gz` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"10.249.50.199\", \"port\" :4353, \"user\" : \"root\" , \"passwd\" : \"Xx835ux%BX\"}', '', '2018-05-17 19:30:36');
INSERT INTO `dconfvalue_gz` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"10.249.50.181\", \"port\" :11987, \"user\" : \"root\" , \"passwd\" : \"root\"}', '', '2018-05-17 19:13:18');
INSERT INTO `dconfvalue_gz` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"10.249.50.182\", \"port\" :4268, \"user\" : \"slaveroot\" , \"passwd\" : \"@wZL65re4P\"}', '', '2018-05-17 19:13:23');
INSERT INTO `dconfvalue_gz` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"10.249.50.183\", \"port\" :16101, \"user\" : \"slaveroot\" , \"passwd\" : \"@wZL65re4P\"}', '', '2018-05-17 19:13:28');
INSERT INTO `dconfvalue_gz` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"10.249.50.200\", \"port\" :15092, \"user\" : \"slaveroot\" , \"passwd\" : \"6_2SPcr8Hp\"}', '', '2018-05-17 19:30:54');
INSERT INTO `dconfvalue_gz` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"10.249.50.184\", \"port\" :6768, \"user\" : \"slaveroot\" , \"passwd\" : \"6_2SPcr8Hp\"}', '', '2018-05-17 19:31:00');
INSERT INTO `dconfvalue_gz` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.59.216.88\", \"port\" :8403, \"user\" : \"slaveroot\" , \"passwd\" : \"^Yhg532VdF\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.59.216.87\", \"port\" :13530, \"user\" : \"des\" , \"passwd\" : \"LF8W6d@5R6\"}', '2018-05-17 19:58:55');
INSERT INTO `dconfvalue_gz` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.59.216.87\", \"port\" :13530, \"user\" : \"des\" , \"passwd\" : \"LF8W6d@5R6\"}\n', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.59.216.88\", \"port\" :8403, \"user\" : \"slaveroot\" , \"passwd\" : \"^Yhg532VdF\"}', '2018-05-17 19:59:00');
INSERT INTO `dconfvalue_gz` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"10.59.216.87\", \"port\" :5623, \"user\" : \"root\" , \"passwd\" : \"SFG41k6^wf\"}', '', '2018-06-19 15:34:17');

-- ----------------------------
-- Table structure for `dconfvalue_gzopen`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_gzopen`;
CREATE TABLE `dconfvalue_gzopen` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_gzopen
-- ----------------------------
INSERT INTO `dconfvalue_gzopen` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_gzopen` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"10.249.50.199\", \"port\" :14917, \"user\" : \"root\" , \"passwd\" : \"a6diTY2Q#7\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:45:38');
INSERT INTO `dconfvalue_gzopen` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"10.249.50.199\", \"port\" :4597, \"user\" : \"root\" , \"passwd\" : \"lucky_MYSQL\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:19:58');
INSERT INTO `dconfvalue_gzopen` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"10.249.50.200\", \"port\" :8265, \"user\" : \"slaveroot\" , \"passwd\" : \"QaX%9q4S2u\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:20:04');
INSERT INTO `dconfvalue_gzopen` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"10.249.50.184\", \"port\" :3850, \"user\" : \"slaveroot\" , \"passwd\" : \"QaX%9q4S2u\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:20:10');
INSERT INTO `dconfvalue_gzopen` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"10.249.50.200\", \"port\" :6924, \"user\" : \"slaveroot\" , \"passwd\" : \"X7K7c3Nie#\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:45:44');
INSERT INTO `dconfvalue_gzopen` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"10.249.50.184\", \"port\" :9706, \"user\" : \"slaveroot\" , \"passwd\" : \"X7K7c3Nie#\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:45:49');
INSERT INTO `dconfvalue_gzopen` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_gzopen` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.249.50.200\", \"port\" :15091, \"user\" : \"slaveroot\" , \"passwd\" : \"_53uSXsw8A\"}', 'cee_v21_qae_des', '2018-05-17 20:03:52');
INSERT INTO `dconfvalue_gzopen` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.249.50.199\", \"port\" :13104 , \"user\" : \"root\" , \"passwd\" : \"lucky_MYSQL\"}', 'cee_v21_qae_des', '2018-05-17 20:03:58');
INSERT INTO `dconfvalue_gzopen` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"10.59.216.87\", \"port\" :5599, \"user\" : \"root\" , \"passwd\" : \"L6^w8QZxi5\"}', '', '2018-06-19 15:35:59');

-- ----------------------------
-- Table structure for `dconfvalue_hk`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_hk`;
CREATE TABLE `dconfvalue_hk` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_hk
-- ----------------------------
INSERT INTO `dconfvalue_hk` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_hk` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"10.225.30.114\", \"port\" :4012, \"user\" : \"root\" , \"passwd\" : \"13D#FFeg7k\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:43:25');
INSERT INTO `dconfvalue_hk` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"10.225.30.114\", \"port\" :4010, \"user\" : \"root\" , \"passwd\" : \"au4S9LB4#h\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:14:48');
INSERT INTO `dconfvalue_hk` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"10.225.30.115\", \"port\" :3334, \"user\" : \"slaveroot\" , \"passwd\" : \"MrKUp*56x8\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:14:53');
INSERT INTO `dconfvalue_hk` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"10.249.50.183\", \"port\" :17171, \"user\" : \"slaveroot\" , \"passwd\" : \"MrKUp*56x8\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:14:59');
INSERT INTO `dconfvalue_hk` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"10.225.30.115\", \"port\" :3317, \"user\" : \"slaveroot\" , \"passwd\" : \"Q571E^mkgB\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:43:30');
INSERT INTO `dconfvalue_hk` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"10.249.50.183\", \"port\" :17433, \"user\" : \"slaveroot\" , \"passwd\" : \"Q571E^mkgB\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:43:36');
INSERT INTO `dconfvalue_hk` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_hk` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.225.30.115\", \"port\" :3987, \"user\" : \"slaveroot\" , \"passwd\" : \"LG573h%bWk\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.225.30.114\", \"port\" :4011, \"user\" : \"root\" , \"passwd\" : \"u1gXTE7!1p\"}', '2018-05-17 19:59:34');
INSERT INTO `dconfvalue_hk` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.225.30.114\", \"port\" :4011, \"user\" : \"root\" , \"passwd\" : \"u1gXTE7!1p\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.225.30.115\", \"port\" :3987, \"user\" : \"slaveroot\" , \"passwd\" : \"LG573h%bWk\"}', '2018-05-17 19:59:40');
INSERT INTO `dconfvalue_hk` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"9.13.100.3\", \"port\" :7123, \"user\" : \"root\" , \"passwd\" : \"6R6bU*Cx8y\"}', '', '2018-06-19 15:36:47');

-- ----------------------------
-- Table structure for `dconfvalue_in`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_in`;
CREATE TABLE `dconfvalue_in` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_in
-- ----------------------------
INSERT INTO `dconfvalue_in` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_in` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"9.16.102.3\", \"port\" :15151, \"user\" : \"root\" , \"passwd\" : \"Qf1y8#VhQ8\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:49:22');
INSERT INTO `dconfvalue_in` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"9.16.102.3\", \"port\" :15213, \"user\" : \"root\" , \"passwd\" : \"Bv9R3p5p#Z\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:23:00');
INSERT INTO `dconfvalue_in` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"9.16.102.4\", \"port\" :15975, \"user\" : \"slaveroot\" , \"passwd\" : \"HDyC@67kc3\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:23:05');
INSERT INTO `dconfvalue_in` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"9.16.102.5\", \"port\" :15783, \"user\" : \"slaveroot\" , \"passwd\" : \"HDyC@67kc3\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:23:10');
INSERT INTO `dconfvalue_in` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"9.16.102.4\", \"port\" :15681, \"user\" : \"slaveroot\" , \"passwd\" : \"RBxw^s9R22\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:49:29');
INSERT INTO `dconfvalue_in` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"9.16.102.5\", \"port\" :15934, \"user\" : \"slaveroot\" , \"passwd\" : \"RBxw^s9R22\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:49:34');
INSERT INTO `dconfvalue_in` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_in` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"9.16.102.4\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"7B@WdgMx82\"}', 'cee_v21_qae_des', '2018-05-17 20:06:42');
INSERT INTO `dconfvalue_in` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"9.16.102.3\", \"port\" :15174, \"user\" : \"root\" , \"passwd\" : \"W2Q31ySy^y\"}', 'cee_v21_qae_des', '2018-05-17 20:06:47');
INSERT INTO `dconfvalue_in` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"9.16.102.3\", \"port\" :13001, \"user\" : \"root\" , \"passwd\" : \"FWx9F3d7*a\"}', '', '2018-06-19 15:37:00');

-- ----------------------------
-- Table structure for `dconfvalue_kr`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_kr`;
CREATE TABLE `dconfvalue_kr` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_kr
-- ----------------------------
INSERT INTO `dconfvalue_kr` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_kr` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"10.165.180.81\", \"port\" :15174, \"user\" : \"root\" , \"passwd\" : \"9SW_i62ppB\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:47:46');
INSERT INTO `dconfvalue_kr` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"10.165.180.81\", \"port\" :15145, \"user\" : \"root\" , \"passwd\" : \"5zi6wC7ZT@\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:22:08');
INSERT INTO `dconfvalue_kr` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"10.165.180.82\", \"port\" :15681, \"user\" : \"slaveroot\" , \"passwd\" : \"3K2V*eBy9x\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:22:14');
INSERT INTO `dconfvalue_kr` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"10.165.180.83\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"3K2V*eBy9x\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:22:19');
INSERT INTO `dconfvalue_kr` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"10.165.180.82\", \"port\" :15558, \"user\" : \"slaveroot\" , \"passwd\" : \"iUX@5vBr79\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:47:52');
INSERT INTO `dconfvalue_kr` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"10.165.180.83\", \"port\" :15681, \"user\" : \"slaveroot\" , \"passwd\" : \"iUX@5vBr79\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:47:57');
INSERT INTO `dconfvalue_kr` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_kr` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.165.180.82\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"ghG2L1G%v8\"}', 'cee_v21_qae_des', '2018-05-17 20:05:28');
INSERT INTO `dconfvalue_kr` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.165.180.81\", \"port\" :15151, \"user\" : \"root\" , \"passwd\" : \"WwBEt8_1h9\"}', 'cee_v21_qae_des', '2018-05-17 20:05:34');

-- ----------------------------
-- Table structure for `dconfvalue_ru`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_ru`;
CREATE TABLE `dconfvalue_ru` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_ru
-- ----------------------------
INSERT INTO `dconfvalue_ru` VALUES ('158', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:25');
INSERT INTO `dconfvalue_ru` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:30');
INSERT INTO `dconfvalue_ru` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-17 18:44:46');
INSERT INTO `dconfvalue_ru` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-17 18:45:16');
INSERT INTO `dconfvalue_ru` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-17 18:45:21');
INSERT INTO `dconfvalue_ru` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:34');
INSERT INTO `dconfvalue_ru` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:38');
INSERT INTO `dconfvalue_ru` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_ru` VALUES ('166', 'cee_v21_qae_des', '', '2018-05-17 18:54:31');
INSERT INTO `dconfvalue_ru` VALUES ('167', 'cee_v21_qae_des', '', '2018-05-17 18:55:55');
INSERT INTO `dconfvalue_ru` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"9.28.102.3\", \"port\" :11620, \"user\" : \"root\" , \"passwd\" : \"Dg78Cgx#F9\"}', '', '2018-06-19 15:37:23');

-- ----------------------------
-- Table structure for `dconfvalue_sg`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_sg`;
CREATE TABLE `dconfvalue_sg` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_sg
-- ----------------------------
INSERT INTO `dconfvalue_sg` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_sg` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"100.78.90.37\", \"port\" :15820, \"user\" : \"root\" , \"passwd\" : \"6azN34B*Hb\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:46:00');
INSERT INTO `dconfvalue_sg` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"100.78.90.37\", \"port\" :15183, \"user\" : \"root\" , \"passwd\" : \"!S2Z9Kp7gx\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:20:23');
INSERT INTO `dconfvalue_sg` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"100.78.90.46\", \"port\" :15451, \"user\" : \"slaveroot\" , \"passwd\" : \"%M1gf4TdQ9\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:20:29');
INSERT INTO `dconfvalue_sg` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"100.78.90.37\", \"port\" :7785, \"user\" : \"slaveroot\" , \"passwd\" : \"%M1gf4TdQ9\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:20:35');
INSERT INTO `dconfvalue_sg` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"100.78.90.46\", \"port\" :15975, \"user\" : \"slaveroot\" , \"passwd\" : \"4sP8f_4GNv\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:46:05');
INSERT INTO `dconfvalue_sg` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"100.78.90.37\", \"port\" :6291, \"user\" : \"slaveroot\" , \"passwd\" : \"4sP8f_4GNv\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:46:11');
INSERT INTO `dconfvalue_sg` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_sg` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.78.90.46\", \"port\" :15360, \"user\" : \"slaveroot\" , \"passwd\" : \"BG6gf37F%t\"}', 'cee_v21_qae_des', '2018-05-17 20:04:08');
INSERT INTO `dconfvalue_sg` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.78.90.37\", \"port\" :15156, \"user\" : \"root\" , \"passwd\" : \"2%EFg3cw6B\"}', 'cee_v21_qae_des', '2018-05-17 20:04:12');

-- ----------------------------
-- Table structure for `dconfvalue_sh`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_sh`;
CREATE TABLE `dconfvalue_sh` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_sh
-- ----------------------------
INSERT INTO `dconfvalue_sh` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_sh` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"10.236.158.100\", \"port\" :3307, \"user\" : \"root\" , \"passwd\" : \"q7fM8MKh7!\"}', '', '2018-05-17 19:42:57');
INSERT INTO `dconfvalue_sh` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"10.236.158.100\", \"port\" :3312, \"user\" : \"root\" , \"passwd\" : \"nRsE568@Rb\"}', '', '2018-05-17 19:12:57');
INSERT INTO `dconfvalue_sh` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"10.236.158.102\", \"port\" :3300, \"user\" : \"slaveroot\" , \"passwd\" : \"bB6Wnq!9W9\"}', '', '2018-05-17 19:13:02');
INSERT INTO `dconfvalue_sh` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"10.236.158.104\", \"port\" :16695, \"user\" : \"slaveroot\" , \"passwd\" : \"bB6Wnq!9W9\"}', '', '2018-05-17 19:13:07');
INSERT INTO `dconfvalue_sh` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"10.236.158.102\", \"port\" :3309, \"user\" : \"slaveroot\" , \"passwd\" : \"14Ti5TtK%a\"}', '', '2018-05-17 19:43:04');
INSERT INTO `dconfvalue_sh` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"10.236.158.104\", \"port\" :16925, \"user\" : \"slaveroot\" , \"passwd\" : \"14Ti5TtK%a\"}', '', '2018-05-17 19:43:10');
INSERT INTO `dconfvalue_sh` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.236.158.102\", \"port\" :5176, \"user\" : \"slaveroot\" , \"passwd\" : \"S^GD3y9pi8\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.236.158.100\", \"port\" :3314, \"user\" : \"root\" , \"passwd\" : \"7Lb6a@PDf2\"}', '2018-05-17 19:59:13');
INSERT INTO `dconfvalue_sh` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.236.158.100\", \"port\" :3314, \"user\" : \"root\" , \"passwd\" : \"7Lb6a@PDf2\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.236.158.102\", \"port\" :5176, \"user\" : \"slaveroot\" , \"passwd\" : \"S^GD3y9pi8\"}', '2018-05-17 19:59:19');
INSERT INTO `dconfvalue_sh` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"10.236.158.96\", \"port\" :4385, \"user\" : \"root\" , \"passwd\" : \"_1N3MHz6ni\"}', '', '2018-06-19 15:33:52');

-- ----------------------------
-- Table structure for `dconfvalue_shjr`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_shjr`;
CREATE TABLE `dconfvalue_shjr` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_shjr
-- ----------------------------
INSERT INTO `dconfvalue_shjr` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_shjr` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"10.48.46.51\", \"port\" :15287, \"user\" : \"root\" , \"passwd\" : \"SLpGx8!i44\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:44:10');
INSERT INTO `dconfvalue_shjr` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"10.48.46.51\", \"port\" :15649, \"user\" : \"root\" , \"passwd\" : \"yPN2H2im4_\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:15:11');
INSERT INTO `dconfvalue_shjr` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"10.48.46.52\", \"port\" :15821, \"user\" : \"slaveroot\" , \"passwd\" : \"yPN2H2im4_\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:15:16');
INSERT INTO `dconfvalue_shjr` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"10.48.46.26\", \"port\" :15935, \"user\" : \"slaveroot\" , \"passwd\" : \"yPN2H2im4_\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:15:21');
INSERT INTO `dconfvalue_shjr` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"10.48.46.52\", \"port\" :15682, \"user\" : \"slaveroot\" , \"passwd\" : \"SLpGx8!i44\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:44:15');
INSERT INTO `dconfvalue_shjr` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"10.48.46.26\", \"port\" :16101, \"user\" : \"slaveroot\" , \"passwd\" : \"SLpGx8!i44\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:44:21');
INSERT INTO `dconfvalue_shjr` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_shjr` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.48.46.52\", \"port\" :15559, \"user\" : \"slaveroot\" , \"passwd\" : \"s%5RAZzh11\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.48.46.51\", \"port\" :15783, \"user\" : \"root\" , \"passwd\" : \"K^sX83g3Ry\"}', '2018-05-17 20:00:02');
INSERT INTO `dconfvalue_shjr` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.48.46.51\", \"port\" :15783, \"user\" : \"root\" , \"passwd\" : \"K^sX83g3Ry\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"10.48.46.52\", \"port\" :15559, \"user\" : \"slaveroot\" , \"passwd\" : \"s%5RAZzh11\"}', '2018-05-17 20:00:09');
INSERT INTO `dconfvalue_shjr` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"10.48.46.51\", \"port\" :7047, \"user\" : \"root\" , \"passwd\" : \"imb5L5W#G7\"}', '', '2018-06-19 15:35:33');

-- ----------------------------
-- Table structure for `dconfvalue_shysx`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_shysx`;
CREATE TABLE `dconfvalue_shysx` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_shysx
-- ----------------------------
INSERT INTO `dconfvalue_shysx` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_shysx` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"100.92.100.51\", \"port\" :9053, \"user\" : \"root\" , \"passwd\" : \"awz66LM4!P\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:46:19');
INSERT INTO `dconfvalue_shysx` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"100.92.100.51\", \"port\" :9147, \"user\" : \"root\" , \"passwd\" : \"uerF2_2W3T\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:20:45');
INSERT INTO `dconfvalue_shysx` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"100.92.100.52\", \"port\" :9503, \"user\" : \"slaveroot\" , \"passwd\" : \"_v2QRk23Rc\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:20:51');
INSERT INTO `dconfvalue_shysx` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"null\", \"port\" :null, \"user\" : \"null\" , \"passwd\" : \"null\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:20:56');
INSERT INTO `dconfvalue_shysx` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"100.92.100.52\", \"port\" :9184, \"user\" : \"slaveroot\" , \"passwd\" : \"zZR95z@9Wu\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:46:25');
INSERT INTO `dconfvalue_shysx` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"null\", \"port\" :null, \"user\" : \"null\" , \"passwd\" : \"null\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:46:30');
INSERT INTO `dconfvalue_shysx` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_shysx` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.92.100.52\", \"port\" :9359, \"user\" : \"slaveroot\" , \"passwd\" : \"i2b33^YdEN\"}', 'cee_v21_qae_des', '2018-05-17 20:04:25');
INSERT INTO `dconfvalue_shysx` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.92.100.51\", \"port\" :9221, \"user\" : \"root\" , \"passwd\" : \"5GgmCN1g^4\"}', 'cee_v21_qae_des', '2018-05-17 20:04:30');

-- ----------------------------
-- Table structure for `dconfvalue_std`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_std`;
CREATE TABLE `dconfvalue_std` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_std
-- ----------------------------
INSERT INTO `dconfvalue_std` VALUES ('158', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:25');
INSERT INTO `dconfvalue_std` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:30');
INSERT INTO `dconfvalue_std` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-17 18:44:46');
INSERT INTO `dconfvalue_std` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-17 18:45:16');
INSERT INTO `dconfvalue_std` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-17 18:45:21');
INSERT INTO `dconfvalue_std` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:34');
INSERT INTO `dconfvalue_std` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:27:38');
INSERT INTO `dconfvalue_std` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_std` VALUES ('166', 'cee_v21_qae_des', '', '2018-05-17 18:54:31');
INSERT INTO `dconfvalue_std` VALUES ('167', 'cee_v21_qae_des', '', '2018-05-17 18:55:55');
INSERT INTO `dconfvalue_std` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"100.91.230.51\", \"port\" :16976, \"user\" : \"root\" , \"passwd\" : \"3CU5ug7_sK\"}', '', '2018-06-19 15:15:56');
INSERT INTO `dconfvalue_std` VALUES ('169', 'samomo', '', '2018-07-09 15:26:32');

-- ----------------------------
-- Table structure for `dconfvalue_szjr`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_szjr`;
CREATE TABLE `dconfvalue_szjr` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_szjr
-- ----------------------------
INSERT INTO `dconfvalue_szjr` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_szjr` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"100.83.224.51\", \"port\" :15451, \"user\" : \"root\" , \"passwd\" : \"4h*AnCA54i\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:45:16');
INSERT INTO `dconfvalue_szjr` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"100.83.224.51\", \"port\" :15558, \"user\" : \"root\" , \"passwd\" : \"ebc448_AAW\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:15:32');
INSERT INTO `dconfvalue_szjr` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"100.83.224.52\", \"port\" :15681, \"user\" : \"slaveroot\" , \"passwd\" : \"4VAi4@kLs7\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:15:38');
INSERT INTO `dconfvalue_szjr` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"100.83.224.53\", \"port\" :16690, \"user\" : \"slaveroot\" , \"passwd\" : \"4VAi4@kLs7\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:15:43');
INSERT INTO `dconfvalue_szjr` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"100.83.224.52\", \"port\" :15975, \"user\" : \"slaveroot\" , \"passwd\" : \"*t87fL8qCG\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:45:22');
INSERT INTO `dconfvalue_szjr` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"100.83.224.53\", \"port\" :16921, \"user\" : \"slaveroot\" , \"passwd\" : \"*t87fL8qCG\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:45:27');
INSERT INTO `dconfvalue_szjr` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_szjr` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.83.224.52\", \"port\" :15558, \"user\" : \"slaveroot\" , \"passwd\" : \"pngW44#EL8\"}', 'cee_v21_qae_des', '2018-05-17 20:03:29');
INSERT INTO `dconfvalue_szjr` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.83.224.51\", \"port\" :15681, \"user\" : \"root\" , \"passwd\" : \"Q9FegW5*v2\"}', 'cee_v21_qae_des', '2018-05-17 20:03:35');
INSERT INTO `dconfvalue_szjr` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"100.89.224.11\", \"port\" :10195, \"user\" : \"root\" , \"passwd\" : \"PGz259!Ngq\"}', '', '2018-06-19 15:35:46');

-- ----------------------------
-- Table structure for `dconfvalue_th`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_th`;
CREATE TABLE `dconfvalue_th` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_th
-- ----------------------------
INSERT INTO `dconfvalue_th` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_th` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"9.17.164.3\", \"port\" :15426, \"user\" : \"root\" , \"passwd\" : \"Z*37ttYDg8\"}', '{ \"default\" : \"db_vstation\", \"host\" : \"9.16.102.3\", \"port\" :15151, \"user\" : \"root\" , \"passwd\" : \"Qf1y8#VhQ8\"}', '2018-05-17 19:49:43');
INSERT INTO `dconfvalue_th` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"9.17.164.3\", \"port\" :15648, \"user\" : \"root\" , \"passwd\" : \"12_2ArrGHq\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:23:40');
INSERT INTO `dconfvalue_th` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"9.17.164.4\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"%1STd8rh1L\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:23:46');
INSERT INTO `dconfvalue_th` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"9.17.164.4\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"%1STd8rh1L\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:23:49');
INSERT INTO `dconfvalue_th` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"9.17.164.4\", \"port\" :15558, \"user\" : \"slaveroot\" , \"passwd\" : \"M7mG2F5vd_\"}', '{ \"default\" : \"db_vstation\", \"host\" : \"9.16.102.4\", \"port\" :15681, \"user\" : \"slaveroot\" , \"passwd\" : \"RBxw^s9R22\"}', '2018-05-17 19:49:49');
INSERT INTO `dconfvalue_th` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"9.17.164.5\", \"port\" :15558, \"user\" : \"slaveroot\" , \"passwd\" : \"M7mG2F5vd_\"}', '{ \"default\" : \"db_vstation\", \"host\" : \"9.16.102.5\", \"port\" :15934, \"user\" : \"slaveroot\" , \"passwd\" : \"RBxw^s9R22\"}', '2018-05-17 19:49:55');
INSERT INTO `dconfvalue_th` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_th` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"9.17.164.4\", \"port\" :15681, \"user\" : \"slaveroot\" , \"passwd\" : \"2cwR#B3Ty4\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"9.16.102.4\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"7B@WdgMx82\"}', '2018-05-17 20:06:30');
INSERT INTO `dconfvalue_th` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"9.17.164.3\", \"port\" :15783, \"user\" : \"root\" , \"passwd\" : \"y9T8EvH1@a\"}', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"9.16.102.3\", \"port\" :15174, \"user\" : \"root\" , \"passwd\" : \"W2Q31ySy^y\"}', '2018-05-17 20:06:35');

-- ----------------------------
-- Table structure for `dconfvalue_use`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_use`;
CREATE TABLE `dconfvalue_use` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_use
-- ----------------------------
INSERT INTO `dconfvalue_use` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_use` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"9.12.182.3\", \"port\" :15268, \"user\" : \"root\" , \"passwd\" : \"n3P*r98NUt\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:48:46');
INSERT INTO `dconfvalue_use` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"9.12.182.3\", \"port\" :15183, \"user\" : \"root\" , \"passwd\" : \"Ev6G@gD8m9\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:23:21');
INSERT INTO `dconfvalue_use` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"9.12.182.4\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"RbM2S1^ui8\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:23:26');
INSERT INTO `dconfvalue_use` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"9.12.182.5\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"RbM2S1^ui8\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:23:31');
INSERT INTO `dconfvalue_use` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"9.12.182.4\", \"port\" :15681, \"user\" : \"slaveroot\" , \"passwd\" : \"dQC#29b7cB\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:48:52');
INSERT INTO `dconfvalue_use` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"9.12.182.5\", \"port\" :15681, \"user\" : \"slaveroot\" , \"passwd\" : \"dQC#29b7cB\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:48:57');
INSERT INTO `dconfvalue_use` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_use` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"9.12.182.4\", \"port\" :15975, \"user\" : \"slaveroot\" , \"passwd\" : \"zP27h5k#UM\"}', 'cee_v21_qae_des', '2018-05-17 20:06:11');
INSERT INTO `dconfvalue_use` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"9.12.182.3\", \"port\" :15151, \"user\" : \"root\" , \"passwd\" : \"LaDm6M8g7@\"}', 'cee_v21_qae_des', '2018-05-17 20:06:16');
INSERT INTO `dconfvalue_use` VALUES ('168', '{ \"default\" : \"db_spot\", \"host\" : \"9.12.182.3\", \"port\" :7544, \"user\" : \"root\" , \"passwd\" : \"F5Pck8n8*G\"}', '', '2018-06-19 15:37:11');

-- ----------------------------
-- Table structure for `dconfvalue_usw`
-- ----------------------------
DROP TABLE IF EXISTS `dconfvalue_usw`;
CREATE TABLE `dconfvalue_usw` (
  `confId` int(11) unsigned NOT NULL,
  `value` longtext NOT NULL,
  `lastValue` longtext NOT NULL,
  `updateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`confId`),
  KEY `dConfValue_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dconfvalue_usw
-- ----------------------------
INSERT INTO `dconfvalue_usw` VALUES ('158', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '', '2018-05-14 16:44:02');
INSERT INTO `dconfvalue_usw` VALUES ('159', '{ \"default\" : \"db_vstation\", \"host\" : \"100.102.22.3\", \"port\" :15156, \"user\" : \"root\" , \"passwd\" : \"Xm^5v9eGU5\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:46:39');
INSERT INTO `dconfvalue_usw` VALUES ('160', '{ \"default\" : \"CCDB4\", \"host\" : \"100.102.22.3\", \"port\" :15183, \"user\" : \"root\" , \"passwd\" : \"YP*969Xybe\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:21:08');
INSERT INTO `dconfvalue_usw` VALUES ('161', '{ \"default\" : \"CCDB4\", \"host\" : \"100.102.22.4\", \"port\" :15820, \"user\" : \"slaveroot\" , \"passwd\" : \"AD4#9qH8sh\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:21:14');
INSERT INTO `dconfvalue_usw` VALUES ('162', '{ \"default\" : \"CCDB4\", \"host\" : \"100.102.22.5\", \"port\" :16283, \"user\" : \"slaveroot\" , \"passwd\" : \"AD4#9qH8sh\"}', '{ \"default\" : \"CCDB4\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:21:19');
INSERT INTO `dconfvalue_usw` VALUES ('163', '{ \"default\" : \"db_vstation\", \"host\" : \"100.102.22.4\", \"port\" :15681, \"user\" : \"slaveroot\" , \"passwd\" : \"e4uG7GS*9y\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:46:44');
INSERT INTO `dconfvalue_usw` VALUES ('164', '{ \"default\" : \"db_vstation\", \"host\" : \"100.102.22.5\", \"port\" :16282, \"user\" : \"slaveroot\" , \"passwd\" : \"e4uG7GS*9y\"}', '{ \"default\" : \"vsatation\", \"host\" : \"1.1.1.1\", \"port\" : 222222, \"user\" : \"ssssss\" , \"passwd\" : \"890\"}', '2018-05-17 19:46:50');
INSERT INTO `dconfvalue_usw` VALUES ('165', 'cee_v21_qae_des', '', '2018-05-17 18:53:40');
INSERT INTO `dconfvalue_usw` VALUES ('166', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.102.22.4\", \"port\" :15975, \"user\" : \"slaveroot\" , \"passwd\" : \"3U7*dVQp7w\"}', 'cee_v21_qae_des', '2018-05-17 20:04:38');
INSERT INTO `dconfvalue_usw` VALUES ('167', '{ \"default\" : \"cee_v21_qae_des\", \"host\" : \"100.102.22.3\", \"port\" :15145, \"user\" : \"root\" , \"passwd\" : \"^ne24NDFq5\"}', 'cee_v21_qae_des', '2018-05-17 20:04:45');

-- ----------------------------
-- Table structure for `rmoduleconf`
-- ----------------------------
DROP TABLE IF EXISTS `rmoduleconf`;
CREATE TABLE `rmoduleconf` (
  `moduleId` int(11) unsigned NOT NULL,
  `confId` int(11) unsigned NOT NULL,
  `productId` int(11) unsigned NOT NULL DEFAULT '1',
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`moduleId`,`confId`),
  KEY `rModuleConf_confId_fk` (`confId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rmoduleconf
-- ----------------------------
INSERT INTO `rmoduleconf` VALUES ('23', '169', '1', '2018-07-09 15:26:32');
INSERT INTO `rmoduleconf` VALUES ('24', '158', '1', '2018-05-14 16:44:02');
INSERT INTO `rmoduleconf` VALUES ('24', '159', '1', '2018-05-15 14:49:31');
INSERT INTO `rmoduleconf` VALUES ('24', '163', '1', '2018-05-17 18:52:14');
INSERT INTO `rmoduleconf` VALUES ('24', '164', '1', '2018-05-17 18:52:21');
INSERT INTO `rmoduleconf` VALUES ('25', '160', '1', '2018-05-17 18:44:46');
INSERT INTO `rmoduleconf` VALUES ('25', '161', '1', '2018-05-17 18:45:00');
INSERT INTO `rmoduleconf` VALUES ('25', '162', '1', '2018-05-17 18:45:10');
INSERT INTO `rmoduleconf` VALUES ('26', '166', '1', '2018-05-17 18:54:31');
INSERT INTO `rmoduleconf` VALUES ('26', '167', '1', '2018-05-17 18:55:55');
INSERT INTO `rmoduleconf` VALUES ('27', '168', '1', '2018-06-19 15:15:56');
