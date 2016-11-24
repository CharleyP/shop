/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp5_shop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2016-11-24 22:45:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `admin_did` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------

-- ----------------------------
-- Table structure for admin_priv
-- ----------------------------
DROP TABLE IF EXISTS `admin_priv`;
CREATE TABLE `admin_priv` (
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_priv
-- ----------------------------

-- ----------------------------
-- Table structure for associator
-- ----------------------------
DROP TABLE IF EXISTS `associator`;
CREATE TABLE `associator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uno` varchar(255) NOT NULL COMMENT '用户编号',
  `uname` varchar(255) NOT NULL COMMENT '用户姓名',
  `account` varchar(255) NOT NULL COMMENT '账号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `nickname` varchar(255) NOT NULL COMMENT '昵称',
  `phone` int(11) NOT NULL COMMENT '手机号',
  `email` varchar(255) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL COMMENT '禁用时间',
  `active` int(11) NOT NULL COMMENT '是否激活',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of associator
-- ----------------------------

-- ----------------------------
-- Table structure for dept
-- ----------------------------
DROP TABLE IF EXISTS `dept`;
CREATE TABLE `dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL,
  `dname` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dept
-- ----------------------------

-- ----------------------------
-- Table structure for node
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node` (
  `node_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `allow` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`node_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO `node` VALUES ('1', '店铺管理', null, '0', '1', null);
INSERT INTO `node` VALUES ('2', '资讯管理', null, '0', '1', null);
INSERT INTO `node` VALUES ('3', '图片管理', '', '0', '1', '');
INSERT INTO `node` VALUES ('4', '产品管理', '', '0', '1', '');
INSERT INTO `node` VALUES ('5', '评论管理', '', '0', '1', '');
INSERT INTO `node` VALUES ('6', '会员管理', '', '0', '1', '');
INSERT INTO `node` VALUES ('7', '管理员管理', '', '0', '1', '');
INSERT INTO `node` VALUES ('8', '系统统计', '', '0', '1', '');
INSERT INTO `node` VALUES ('9', '系统管理', null, '0', '1', null);
INSERT INTO `node` VALUES ('10', '店铺列表', null, '1', '2', null);
INSERT INTO `node` VALUES ('11', '会员管理', null, '1', '2', null);
INSERT INTO `node` VALUES ('12', '资讯管理', null, '2', '2', null);
INSERT INTO `node` VALUES ('13', '图片管理', null, '3', '2', null);
INSERT INTO `node` VALUES ('14', '品牌管理', null, '4', '2', null);
INSERT INTO `node` VALUES ('15', '分类管理', null, '4', '2', null);
INSERT INTO `node` VALUES ('16', '产品管理', null, '4', '2', null);
INSERT INTO `node` VALUES ('17', '评论列表', null, '5', '2', null);
INSERT INTO `node` VALUES ('18', '意见反馈', null, '5', '2', null);
INSERT INTO `node` VALUES ('19', '会员列表', null, '6', '2', null);
INSERT INTO `node` VALUES ('20', '删除的会员', null, '6', '2', null);
INSERT INTO `node` VALUES ('21', '等级管理', null, '6', '2', null);
INSERT INTO `node` VALUES ('22', '积分管理', null, '6', '2', null);
INSERT INTO `node` VALUES ('23', '浏览记录', null, '6', '2', null);
INSERT INTO `node` VALUES ('24', '角色管理', null, '7', '2', null);
INSERT INTO `node` VALUES ('25', '权限管理', null, '7', '2', null);
INSERT INTO `node` VALUES ('26', '管理员列表', null, '7', '2', null);
INSERT INTO `node` VALUES ('27', '折线图', null, '8', '2', null);
INSERT INTO `node` VALUES ('28', '时间轴折线图', null, '8', '2', null);
INSERT INTO `node` VALUES ('29', '系统设置', null, '9', '2', null);
INSERT INTO `node` VALUES ('30', '栏目管理', null, '9', '2', null);
INSERT INTO `node` VALUES ('31', '系统日志', null, '9', '2', null);

-- ----------------------------
-- Table structure for priv
-- ----------------------------
DROP TABLE IF EXISTS `priv`;
CREATE TABLE `priv` (
  `priv_id` int(11) NOT NULL AUTO_INCREMENT,
  `priv_name` varchar(255) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`priv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of priv
-- ----------------------------
INSERT INTO `priv` VALUES ('1', '1', '1', '1', '1');
INSERT INTO `priv` VALUES ('2', '2', '2', '2', '2');

-- ----------------------------
-- Table structure for priv_node
-- ----------------------------
DROP TABLE IF EXISTS `priv_node`;
CREATE TABLE `priv_node` (
  `node_id` int(11) NOT NULL,
  `priv_id` int(11) NOT NULL,
  KEY `priv_id` (`priv_id`),
  KEY `node_id` (`node_id`),
  CONSTRAINT `priv_node_ibfk_1` FOREIGN KEY (`priv_id`) REFERENCES `priv` (`priv_id`),
  CONSTRAINT `priv_node_ibfk_2` FOREIGN KEY (`node_id`) REFERENCES `node` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of priv_node
-- ----------------------------
INSERT INTO `priv_node` VALUES ('1', '1');
INSERT INTO `priv_node` VALUES ('2', '1');
INSERT INTO `priv_node` VALUES ('3', '1');
INSERT INTO `priv_node` VALUES ('4', '1');
INSERT INTO `priv_node` VALUES ('5', '1');
INSERT INTO `priv_node` VALUES ('6', '1');
INSERT INTO `priv_node` VALUES ('7', '1');
INSERT INTO `priv_node` VALUES ('8', '1');
INSERT INTO `priv_node` VALUES ('9', '1');
INSERT INTO `priv_node` VALUES ('10', '1');
INSERT INTO `priv_node` VALUES ('11', '1');

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sno` varchar(255) NOT NULL COMMENT '店铺编号',
  `sname` varchar(255) NOT NULL COMMENT '店铺名',
  `uid` int(11) NOT NULL COMMENT '创建人ID',
  `synopsis` varchar(255) NOT NULL COMMENT '摘要、简介',
  `info` varchar(255) NOT NULL COMMENT '店铺信息',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL COMMENT '关闭时间',
  `active` int(11) DEFAULT NULL COMMENT '店铺是否激活、开启',
  `level` int(11) DEFAULT NULL COMMENT '店铺等级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop
-- ----------------------------
