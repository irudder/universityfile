/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : weibo

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-04-13 20:13:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hd_admin
-- ----------------------------
DROP TABLE IF EXISTS `hd_admin`;
CREATE TABLE `hd_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) DEFAULT NULL COMMENT '账号',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `logintime` int(10) unsigned DEFAULT '0' COMMENT '上一次登陆时间',
  `loginip` char(20) DEFAULT NULL COMMENT '上一次的登陆IP',
  `look` tinyint(1) unsigned DEFAULT '0' COMMENT '1:已锁定 0：未锁定',
  `admin` tinyint(1) unsigned DEFAULT '1' COMMENT '0:超级管理员 1：普通管理员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台管理员';

-- ----------------------------
-- Records of hd_admin
-- ----------------------------
INSERT INTO `hd_admin` VALUES ('1', 'admin', 'cc03e747a6afbbcbf8be7668acfebee5', '1460549406', '127.0.0.1', '0', '0');

-- ----------------------------
-- Table structure for hd_atme
-- ----------------------------
DROP TABLE IF EXISTS `hd_atme`;
CREATE TABLE `hd_atme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wid` int(11) NOT NULL COMMENT '提到我的微博ID',
  `uid` int(11) NOT NULL COMMENT '所属用户ID',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `wid` (`wid`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='@提到我的微博';

-- ----------------------------
-- Records of hd_atme
-- ----------------------------
INSERT INTO `hd_atme` VALUES ('1', '45', '1');
INSERT INTO `hd_atme` VALUES ('2', '45', '2');
INSERT INTO `hd_atme` VALUES ('3', '45', '4');
INSERT INTO `hd_atme` VALUES ('4', '46', '2');
INSERT INTO `hd_atme` VALUES ('5', '46', '1');
INSERT INTO `hd_atme` VALUES ('6', '47', '1');
INSERT INTO `hd_atme` VALUES ('7', '48', '3');
INSERT INTO `hd_atme` VALUES ('8', '50', '3');
INSERT INTO `hd_atme` VALUES ('9', '51', '1');
INSERT INTO `hd_atme` VALUES ('10', '52', '1');
INSERT INTO `hd_atme` VALUES ('11', '53', '1');
INSERT INTO `hd_atme` VALUES ('12', '54', '1');
INSERT INTO `hd_atme` VALUES ('13', '55', '1');
INSERT INTO `hd_atme` VALUES ('14', '56', '1');
INSERT INTO `hd_atme` VALUES ('15', '57', '1');
INSERT INTO `hd_atme` VALUES ('16', '60', '1');
INSERT INTO `hd_atme` VALUES ('17', '61', '1');
INSERT INTO `hd_atme` VALUES ('18', '62', '1');
INSERT INTO `hd_atme` VALUES ('19', '71', '1');
INSERT INTO `hd_atme` VALUES ('20', '72', '1');
INSERT INTO `hd_atme` VALUES ('21', '77', '1');
INSERT INTO `hd_atme` VALUES ('22', '78', '1');
INSERT INTO `hd_atme` VALUES ('23', '85', '1');
INSERT INTO `hd_atme` VALUES ('24', '89', '1');
INSERT INTO `hd_atme` VALUES ('25', '90', '1');

-- ----------------------------
-- Table structure for hd_comment
-- ----------------------------
DROP TABLE IF EXISTS `hd_comment`;
CREATE TABLE `hd_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '评论内容',
  `time` int(10) unsigned NOT NULL COMMENT '评论时间',
  `uid` int(11) NOT NULL COMMENT '评论用户的ID',
  `wid` int(11) NOT NULL COMMENT '所属微博ID',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `wid` (`wid`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='微博评论表';

-- ----------------------------
-- Records of hd_comment
-- ----------------------------
INSERT INTO `hd_comment` VALUES ('1', '阿斯顿发送到', '1426319632', '1', '6');
INSERT INTO `hd_comment` VALUES ('2', '你撒地方见', '1427449052', '1', '1');
INSERT INTO `hd_comment` VALUES ('3', '阿斯顿发', '1427449060', '1', '1');
INSERT INTO `hd_comment` VALUES ('4', '[害羞]', '1427449125', '1', '13');
INSERT INTO `hd_comment` VALUES ('5', '[可怜]', '1427449133', '1', '18');
INSERT INTO `hd_comment` VALUES ('6', '[哈哈]', '1427449597', '1', '17');
INSERT INTO `hd_comment` VALUES ('7', '[懒得理你]', '1427449662', '1', '19');
INSERT INTO `hd_comment` VALUES ('8', '啊啊啊', '1427450009', '1', '22');
INSERT INTO `hd_comment` VALUES ('11', '阿斯达', '1427528560', '1', '24');
INSERT INTO `hd_comment` VALUES ('12', '发顶顶顶顶顶', '1427528562', '1', '24');
INSERT INTO `hd_comment` VALUES ('13', '阿斯顿发', '1427528563', '1', '24');
INSERT INTO `hd_comment` VALUES ('14', '阿斯顿发', '1427528565', '1', '24');
INSERT INTO `hd_comment` VALUES ('15', '广泛的双方各', '1427528567', '1', '24');
INSERT INTO `hd_comment` VALUES ('16', '阿斯顿发为', '1427528569', '1', '24');
INSERT INTO `hd_comment` VALUES ('17', '自行车vw', '1427528571', '1', '24');
INSERT INTO `hd_comment` VALUES ('18', '在战争中', '1427528576', '1', '24');
INSERT INTO `hd_comment` VALUES ('19', 'asdfas', '1427961002', '1', '24');
INSERT INTO `hd_comment` VALUES ('20', 'asdfadsf ', '1427961006', '1', '24');
INSERT INTO `hd_comment` VALUES ('24', 'asdfasdaf', '1428999830', '1', '40');
INSERT INTO `hd_comment` VALUES ('23', '说等发生的', '1428999783', '1', '40');
INSERT INTO `hd_comment` VALUES ('25', '呵呵', '1429690665', '3', '50');
INSERT INTO `hd_comment` VALUES ('26', '呵呵~', '1429690691', '3', '50');
INSERT INTO `hd_comment` VALUES ('27', '呵呵~', '1429690744', '3', '50');

-- ----------------------------
-- Table structure for hd_follow
-- ----------------------------
DROP TABLE IF EXISTS `hd_follow`;
CREATE TABLE `hd_follow` (
  `follow` int(10) unsigned NOT NULL COMMENT '关注用户的ID',
  `fans` int(10) unsigned NOT NULL COMMENT '粉丝用户ID',
  `gid` int(11) NOT NULL COMMENT '所属关注分组ID',
  KEY `follow` (`follow`),
  KEY `fans` (`fans`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='关注与粉丝表';

-- ----------------------------
-- Records of hd_follow
-- ----------------------------
INSERT INTO `hd_follow` VALUES ('2', '1', '0');
INSERT INTO `hd_follow` VALUES ('3', '1', '0');
INSERT INTO `hd_follow` VALUES ('1', '3', '0');
INSERT INTO `hd_follow` VALUES ('4', '3', '0');
INSERT INTO `hd_follow` VALUES ('1', '4', '0');
INSERT INTO `hd_follow` VALUES ('2', '4', '0');
INSERT INTO `hd_follow` VALUES ('3', '4', '0');
INSERT INTO `hd_follow` VALUES ('2', '3', '0');

-- ----------------------------
-- Table structure for hd_group
-- ----------------------------
DROP TABLE IF EXISTS `hd_group`;
CREATE TABLE `hd_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '' COMMENT '分组名称',
  `uid` int(11) NOT NULL COMMENT '所属用户的ID',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='关注分组表';

-- ----------------------------
-- Records of hd_group
-- ----------------------------
INSERT INTO `hd_group` VALUES ('1', '后盾网', '1');
INSERT INTO `hd_group` VALUES ('2', '同学', '1');
INSERT INTO `hd_group` VALUES ('3', '后盾网友', '1');
INSERT INTO `hd_group` VALUES ('4', '123', '10');

-- ----------------------------
-- Table structure for hd_keep
-- ----------------------------
DROP TABLE IF EXISTS `hd_keep`;
CREATE TABLE `hd_keep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '收藏用户的ID',
  `time` int(10) unsigned NOT NULL COMMENT '收藏时间',
  `wid` int(11) NOT NULL COMMENT '收藏微博的ID',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='收藏表';

-- ----------------------------
-- Records of hd_keep
-- ----------------------------
INSERT INTO `hd_keep` VALUES ('1', '1', '1428392843', '25');
INSERT INTO `hd_keep` VALUES ('2', '1', '1428392851', '24');
INSERT INTO `hd_keep` VALUES ('3', '1', '1428392860', '23');
INSERT INTO `hd_keep` VALUES ('4', '1', '1428392863', '20');
INSERT INTO `hd_keep` VALUES ('5', '1', '1428466064', '21');
INSERT INTO `hd_keep` VALUES ('7', '1', '1429005174', '40');
INSERT INTO `hd_keep` VALUES ('8', '1', '1429084388', '46');

-- ----------------------------
-- Table structure for hd_letter
-- ----------------------------
DROP TABLE IF EXISTS `hd_letter`;
CREATE TABLE `hd_letter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL COMMENT '发私用户ID',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '私信内容',
  `time` int(10) unsigned NOT NULL COMMENT '私信发送时间',
  `uid` int(11) NOT NULL COMMENT '所属用户ID（收信人）',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='私信表';

-- ----------------------------
-- Records of hd_letter
-- ----------------------------
INSERT INTO `hd_letter` VALUES ('3', '1', 'heheh ', '1428993657', '1');
INSERT INTO `hd_letter` VALUES ('4', '1', '在吗？', '1429689890', '3');
INSERT INTO `hd_letter` VALUES ('5', '1', '阿斯顿发', '1429690345', '1');
INSERT INTO `hd_letter` VALUES ('6', '3', '呵呵', '1429690359', '1');
INSERT INTO `hd_letter` VALUES ('7', '3', '你好哦！', '1429690380', '1');
INSERT INTO `hd_letter` VALUES ('8', '3', '呵呵', '1429690619', '1');

-- ----------------------------
-- Table structure for hd_picture
-- ----------------------------
DROP TABLE IF EXISTS `hd_picture`;
CREATE TABLE `hd_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mini` varchar(60) NOT NULL DEFAULT '' COMMENT '小图',
  `medium` varchar(60) NOT NULL DEFAULT '' COMMENT '中图',
  `max` varchar(60) NOT NULL DEFAULT '' COMMENT '大图',
  `wid` int(11) NOT NULL COMMENT '所属微博ID',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='微博配图表';

-- ----------------------------
-- Records of hd_picture
-- ----------------------------
INSERT INTO `hd_picture` VALUES ('1', '2015_03/54fd56a81732f.jpg_120_120.jpg', '2015_03/54fd56a81732f.jpg_300_300.jpg', '2015_03/54fd56a81732f.jpg_800_800.jpg', '6');
INSERT INTO `hd_picture` VALUES ('2', '2015_03/5502a9f86e535.jpg_120_120.jpg', '2015_03/5502a9f86e535.jpg_300_300.jpg', '2015_03/5502a9f86e535.jpg_800_800.jpg', '7');

-- ----------------------------
-- Table structure for hd_user
-- ----------------------------
DROP TABLE IF EXISTS `hd_user`;
CREATE TABLE `hd_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `registime` int(10) unsigned NOT NULL COMMENT '注册时间',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否锁定（0：否，1：是）',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of hd_user
-- ----------------------------
INSERT INTO `hd_user` VALUES ('1', 'milkbobo', 'c0dfe07e9a120fe0d4e2cdeaaf4e9fb5', '1425375910', '1');
INSERT INTO `hd_user` VALUES ('2', 'mileto', 'c0dfe07e9a120fe0d4e2cdeaaf4e9fb5', '1425376360', '0');
INSERT INTO `hd_user` VALUES ('3', 'admin01', 'c0dfe07e9a120fe0d4e2cdeaaf4e9fb5', '1425624475', '0');
INSERT INTO `hd_user` VALUES ('4', 'admin02', 'c0dfe07e9a120fe0d4e2cdeaaf4e9fb5', '1425624499', '0');
INSERT INTO `hd_user` VALUES ('5', 'admin04', 'c0dfe07e9a120fe0d4e2cdeaaf4e9fb5', '1425624521', '0');
INSERT INTO `hd_user` VALUES ('6', 'admin09', 'c0dfe07e9a120fe0d4e2cdeaaf4e9fb5', '1426211387', '0');
INSERT INTO `hd_user` VALUES ('7', 'milkbobo09', 'c0dfe07e9a120fe0d4e2cdeaaf4e9fb5', '1426211556', '0');
INSERT INTO `hd_user` VALUES ('8', 'qqqqqq', '437599f1ea3514f8969f161a6606ce18', '1460546707', '0');
INSERT INTO `hd_user` VALUES ('9', 'qweqwe', 'efe6398127928f1b2e9ef3207fb82663', '1460547256', '0');
INSERT INTO `hd_user` VALUES ('10', 'test123', 'cc03e747a6afbbcbf8be7668acfebee5', '1460548584', '0');

-- ----------------------------
-- Table structure for hd_userinfo
-- ----------------------------
DROP TABLE IF EXISTS `hd_userinfo`;
CREATE TABLE `hd_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `truename` varchar(45) DEFAULT NULL COMMENT '真实名称',
  `sex` enum('男','女') NOT NULL DEFAULT '男' COMMENT '性别',
  `location` varchar(45) NOT NULL DEFAULT '' COMMENT '所在地',
  `constellation` char(10) NOT NULL DEFAULT '' COMMENT '星座',
  `intro` varchar(100) NOT NULL DEFAULT '' COMMENT '一句话介绍自己',
  `face50` varchar(60) NOT NULL DEFAULT '' COMMENT '50*50头像',
  `face80` varchar(60) NOT NULL DEFAULT '' COMMENT '80*80头像',
  `face180` varchar(60) NOT NULL DEFAULT '' COMMENT '180*180头像',
  `style` varchar(45) NOT NULL DEFAULT 'default' COMMENT '个性模版',
  `follow` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关注数',
  `fans` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '粉丝数',
  `weibo` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '微博数',
  `uid` int(11) NOT NULL COMMENT '所属用户ID',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- ----------------------------
-- Records of hd_userinfo
-- ----------------------------
INSERT INTO `hd_userinfo` VALUES ('1', 'test', '到山顶', '男', 'xx', '金牛座', 'sdfasa', '2015_03/54fd44200d1af.png_50_50.png', '2015_03/54fd44200d1af.png_80_80.png', '2015_03/54fd44200d1af.png_180_180.png', 'default', '8', '2', '12', '1');
INSERT INTO `hd_userinfo` VALUES ('2', 'test', null, '男', '', '', '', '', '', '', 'default', '0', '5', '0', '2');
INSERT INTO `hd_userinfo` VALUES ('3', 'test', null, '男', '', '', '', '', '', '', 'default', '7', '4', '0', '3');
INSERT INTO `hd_userinfo` VALUES ('4', 'test', null, '男', '', '', '', '', '', '', 'default', '7', '4', '0', '4');
INSERT INTO `hd_userinfo` VALUES ('5', 'test', null, '男', '', '', '', '', '', '', 'default', '0', '3', '0', '5');
INSERT INTO `hd_userinfo` VALUES ('6', 'test', null, '男', '', '', '', '', '', '', 'default', '0', '3', '0', '6');
INSERT INTO `hd_userinfo` VALUES ('7', 'test', null, '男', '', '', '', '', '', '', 'default', '0', '1', '0', '7');
INSERT INTO `hd_userinfo` VALUES ('8', 'qqqqq', null, '男', '', '', '', '', '', '', 'style4', '0', '0', '0', '8');
INSERT INTO `hd_userinfo` VALUES ('9', 'qwe', '6666', '男', ' ', '', '', '', '', '', 'style4', '0', '0', '0', '9');
INSERT INTO `hd_userinfo` VALUES ('10', 'test', null, '男', '', '', '', '', '', '', 'style3', '0', '0', '1', '10');

-- ----------------------------
-- Table structure for hd_weibo
-- ----------------------------
DROP TABLE IF EXISTS `hd_weibo`;
CREATE TABLE `hd_weibo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '微博内容',
  `isturn` int(11) NOT NULL DEFAULT '0' COMMENT '是否转发（0：原创， 如果是转发的则保存该转发微博的ID）',
  `time` int(10) unsigned NOT NULL COMMENT '发布时间',
  `turn` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '转发次数',
  `keep` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `comment` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `uid` int(11) NOT NULL COMMENT '所属用户的ID',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COMMENT='微博表';

-- ----------------------------
-- Records of hd_weibo
-- ----------------------------
INSERT INTO `hd_weibo` VALUES ('1', 'sadfadfsasddasd', '0', '1425888433', '12', '0', '2', '1');
INSERT INTO `hd_weibo` VALUES ('2', 'asdfasdsadf', '0', '1425888528', '11', '0', '0', '1');
INSERT INTO `hd_weibo` VALUES ('3', 'asdfasdf', '0', '1425888636', '11', '0', '0', '1');
INSERT INTO `hd_weibo` VALUES ('91', '呵呵~', '88', '1429770312', '0', '0', '0', '1');
INSERT INTO `hd_weibo` VALUES ('92', '恩恩', '90', '1429771548', '0', '0', '0', '1');
INSERT INTO `hd_weibo` VALUES ('93', '哈哈哈', '87', '1429771583', '0', '0', '0', '1');
INSERT INTO `hd_weibo` VALUES ('94', 'nihaoya', '0', '1460549088', '0', '0', '0', '10');
