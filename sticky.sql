/*
Navicat MySQL Data Transfer

Source Server         : laragon
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : sticky

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-07-05 17:50:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for o2o_area
-- ----------------------------
DROP TABLE IF EXISTS `o2o_area`;
CREATE TABLE `o2o_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '商圈名',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市id',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商圈表';

-- ----------------------------
-- Records of o2o_area
-- ----------------------------

-- ----------------------------
-- Table structure for o2o_bis
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis`;
CREATE TABLE `o2o_bis` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '商户名',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '标志',
  `licence_logo` varchar(255) NOT NULL DEFAULT '' COMMENT '营业执照图片',
  `description` text NOT NULL COMMENT '描述',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市id',
  `city_path` varchar(50) NOT NULL DEFAULT '' COMMENT '城市具体路径',
  `bank_info` varchar(50) NOT NULL DEFAULT '' COMMENT '银行信息',
  `money` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '用户金额',
  `bank_name` varchar(50) NOT NULL DEFAULT '' COMMENT '开户行名称',
  `bank_user` varchar(50) NOT NULL DEFAULT '' COMMENT '开户人',
  `legal_person` varchar(20) NOT NULL DEFAULT '' COMMENT '法人',
  `person_tel` varchar(20) NOT NULL DEFAULT '' COMMENT '法人联系方式',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='商户表';

-- ----------------------------
-- Records of o2o_bis
-- ----------------------------
INSERT INTO `o2o_bis` VALUES ('3', '厦商食堂', '1071119121@zzs.com', '', '', '<p>很好吃</p>', '2', '2,3', '6216611600004546333', '0.00', '中国银行', '张泽山', '张泽山', '18250305186', '0', '1', '1561700871', '1561944148');
INSERT INTO `o2o_bis` VALUES ('6', 'asdjahd a', 'sameldon930@126.com', '', '', '<p>jdhkjasdhja</p>', '6', '6,7', '1312312312', '0.00', '3123123', '1231231', 'zzs', '18250305186', '0', '2', '1561702040', '1561944484');
INSERT INTO `o2o_bis` VALUES ('7', '<script>alert(1)</script>', 'sameldon930@126.com', '', '', '', '5', '5', '123123', '0.00', '12312', '3123', '3123', '3123', '0', '0', '1562047238', '1562047238');

-- ----------------------------
-- Table structure for o2o_bis_account
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis_account`;
CREATE TABLE `o2o_bis_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '加密字符串',
  `bis_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '最后登陆的ip',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `is_main` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为总管理员',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `bis_id` (`bis_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='商户账号表';

-- ----------------------------
-- Records of o2o_bis_account
-- ----------------------------
INSERT INTO `o2o_bis_account` VALUES ('1', 'zzs', 'b16bf0c30abdcbb133acb6bf518e1612', '7464', '3', '', '1562144386', '1', '0', '1', '1561701010', '1562144386');
INSERT INTO `o2o_bis_account` VALUES ('2', 'root', '028b674f3fbeae06d0c70a6ea1db3348', '7884', '6', '', '0', '1', '0', '0', '1561702040', '1561702040');
INSERT INTO `o2o_bis_account` VALUES ('3', '', '', '', '6', '', '0', '1', '0', '0', '1561714450', '1561714450');
INSERT INTO `o2o_bis_account` VALUES ('4', '', '', '', '6', '', '0', '1', '0', '0', '1561714455', '1561714455');
INSERT INTO `o2o_bis_account` VALUES ('5', '', '', '', '6', '', '0', '1', '0', '0', '1561715029', '1561715029');
INSERT INTO `o2o_bis_account` VALUES ('6', '', '', '', '6', '', '0', '1', '0', '0', '1561715056', '1561715056');
INSERT INTO `o2o_bis_account` VALUES ('7', '', '', '', '6', '', '0', '1', '0', '0', '1561715084', '1561715084');
INSERT INTO `o2o_bis_account` VALUES ('8', '', '', '', '3', '', '0', '1', '0', '0', '1561715131', '1561715131');
INSERT INTO `o2o_bis_account` VALUES ('9', '', '', '', '3', '', '0', '1', '0', '0', '1561715134', '1561715134');
INSERT INTO `o2o_bis_account` VALUES ('10', '', '', '', '6', '', '0', '1', '0', '0', '1561943699', '1561943699');
INSERT INTO `o2o_bis_account` VALUES ('11', '', '', '', '6', '', '0', '1', '0', '0', '1561943862', '1561943862');
INSERT INTO `o2o_bis_account` VALUES ('12', '', '', '', '6', '', '0', '1', '0', '0', '1561943869', '1561943869');
INSERT INTO `o2o_bis_account` VALUES ('13', '', '', '', '6', '', '0', '1', '0', '1', '1561944144', '1561944144');
INSERT INTO `o2o_bis_account` VALUES ('14', '', '', '', '3', '', '0', '1', '0', '1', '1561944148', '1561944148');
INSERT INTO `o2o_bis_account` VALUES ('15', '', '', '', '6', '', '0', '1', '0', '2', '1561944484', '1561944484');
INSERT INTO `o2o_bis_account` VALUES ('16', '31231', 'fc19c7a60f9b41898638155a30a3041f', '6103', '1', '', '0', '1', '0', '0', '1562047238', '1562047238');

-- ----------------------------
-- Table structure for o2o_bis_location
-- ----------------------------
DROP TABLE IF EXISTS `o2o_bis_location`;
CREATE TABLE `o2o_bis_location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '门店名',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '门店logo',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '门店地址',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '门店电话',
  `contact` varchar(20) NOT NULL DEFAULT '' COMMENT '门店联系人',
  `xpoint` varchar(20) NOT NULL DEFAULT '' COMMENT '门店位置经度',
  `ypoint` varchar(20) NOT NULL DEFAULT '' COMMENT '门店位置纬度',
  `bis_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `open_time` varchar(50) NOT NULL DEFAULT '0' COMMENT '营业时间',
  `content` text COMMENT '门店介绍',
  `is_main` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为总店',
  `api_address` varchar(255) NOT NULL DEFAULT '' COMMENT '相关地址',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市id',
  `city_path` varchar(50) NOT NULL DEFAULT '' COMMENT '城市路径',
  `category_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `category_path` varchar(50) NOT NULL DEFAULT '' COMMENT '分类路径',
  `bank_info` varchar(50) NOT NULL DEFAULT '' COMMENT '银行信息',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `bis_id` (`bis_id`),
  KEY `category_id` (`category_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='商户门店表';

-- ----------------------------
-- Records of o2o_bis_location
-- ----------------------------
INSERT INTO `o2o_bis_location` VALUES ('1', '厦商食堂', '', '漳州市东山县', '18250305186', '张泽山', '117.43656', '23.706895', '3', '早上', '<p>在软件园</p>', '1', '', '0', '', '1', '1', '', '0', '1', '1561701010', '1561701010');
INSERT INTO `o2o_bis_location` VALUES ('2', 'asdjahd a', '', '福建省 东山县', '232131', '31231', '117.43656', '23.706895', '6', '31231', '<p>31231231</p>', '1', '', '0', '', '2', '2', '', '0', '0', '1561702040', '1561702040');
INSERT INTO `o2o_bis_location` VALUES ('16', '1111111111111', '', '漳州市东山县', '1111111111111', '1111111111111', '117.43656', '23.706895', '3', '1111111111111', '<p>1111111111111</p>', '0', '', '0', '', '0', '0', '', '0', '0', '1561950616', '1561950616');
INSERT INTO `o2o_bis_location` VALUES ('17', '2222222222222', '', '漳州市东山县', '2222222222222', '2222222222222', '117.43656', '23.706895', '3', '2222222222222', '<p>2222222222222</p>', '0', '', '0', '', '0', '0', '', '0', '0', '1561950978', '1561950978');
INSERT INTO `o2o_bis_location` VALUES ('18', '<script>alert(1)</script>', '', '福建省东山县', '3123312', '31231', '117.43656', '23.706895', '1', '12312', '', '1', '', '0', '', '2', '2', '', '0', '0', '1562047238', '1562047238');

-- ----------------------------
-- Table structure for o2o_category
-- ----------------------------
DROP TABLE IF EXISTS `o2o_category`;
CREATE TABLE `o2o_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '分类名',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='生活服务分类表';

-- ----------------------------
-- Records of o2o_category
-- ----------------------------
INSERT INTO `o2o_category` VALUES ('1', '美食', '0', '4', '1', '1560996766', '1562205649');
INSERT INTO `o2o_category` VALUES ('2', '美妆', '0', '2', '1', '1560996848', '1562205651');
INSERT INTO `o2o_category` VALUES ('3', '娱乐', '0', '0', '1', '1560996978', '1561103972');
INSERT INTO `o2o_category` VALUES ('4', '旅行', '0', '8', '0', '1560997134', '1562205654');
INSERT INTO `o2o_category` VALUES ('5', '游戏', '3', '0', '1', '1560998835', '1561099451');
INSERT INTO `o2o_category` VALUES ('6', '酒吧', '1', '0', '1', '1561003854', '1561012659');

-- ----------------------------
-- Table structure for o2o_city
-- ----------------------------
DROP TABLE IF EXISTS `o2o_city`;
CREATE TABLE `o2o_city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '城市名',
  `uname` varchar(50) NOT NULL DEFAULT '' COMMENT '城市英文名',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否默认',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='城市表';

-- ----------------------------
-- Records of o2o_city
-- ----------------------------
INSERT INTO `o2o_city` VALUES ('1', '上海', 'shanghai', '0', '1', '0', '1', '1561531031', '1561531031');
INSERT INTO `o2o_city` VALUES ('2', '四川', 'sichuan', '1', '1', '0', '1', '1561531031', '1561531031');
INSERT INTO `o2o_city` VALUES ('3', '成都', 'chengdu', '1', '1', '0', '1', '1561531031', '1561531031');
INSERT INTO `o2o_city` VALUES ('4', '深圳', 'shenzhen', '1', '1', '0', '1', '1561531031', '1561531031');
INSERT INTO `o2o_city` VALUES ('5', '广州', 'guangzhou', '1', '1', '0', '1', '1561531031', '1561531031');
INSERT INTO `o2o_city` VALUES ('6', '安徽', 'anhui', '1', '1', '0', '1', '1561531031', '1561531031');
INSERT INTO `o2o_city` VALUES ('7', '合肥', 'hefei', '6', '1', '0', '1', '1561531031', '1561531031');

-- ----------------------------
-- Table structure for o2o_deal
-- ----------------------------
DROP TABLE IF EXISTS `o2o_deal`;
CREATE TABLE `o2o_deal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类id',
  `se_category_id` int(11) NOT NULL DEFAULT '0' COMMENT '二级栏目id',
  `bis_id` int(11) NOT NULL DEFAULT '0' COMMENT '商户id',
  `location_ids` varchar(100) DEFAULT '' COMMENT '商品所属店面的地址',
  `image` varchar(200) NOT NULL DEFAULT '' COMMENT '商品图片',
  `description` text NOT NULL COMMENT '商品描述',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `origin_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '原始价格',
  `current_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '当前价格',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '城市id',
  `buy_count` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `total_count` int(11) NOT NULL DEFAULT '0' COMMENT '总数',
  `coupons_start_time` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券开始时间',
  `coupons_end_time` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券结束时间',
  `xpoint` varchar(20) NOT NULL DEFAULT '经度',
  `ypoint` varchar(20) NOT NULL DEFAULT '纬度',
  `bis_account_id` int(10) NOT NULL DEFAULT '0' COMMENT '账号id',
  `balance_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `notes` text NOT NULL COMMENT '备注',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `se_category_id` (`se_category_id`),
  KEY `city_id` (`city_id`),
  KEY `start_time` (`start_time`),
  KEY `end_time` (`end_time`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='团购商品表';

-- ----------------------------
-- Records of o2o_deal
-- ----------------------------
INSERT INTO `o2o_deal` VALUES ('1', '张泽山', '4', '0', '3', '', '', '<p>1231</p>', '1562312800', '1565419080', '1000.00', '123.00', '3', '0', '123', '1562312800', '1564727880', '115.905503455', '115.905503455', '3', '0.00', '<p>3123</p>', '0', '1', '1561963283', '1561963283');

-- ----------------------------
-- Table structure for o2o_featured
-- ----------------------------
DROP TABLE IF EXISTS `o2o_featured`;
CREATE TABLE `o2o_featured` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='推荐位表';

-- ----------------------------
-- Records of o2o_featured
-- ----------------------------
INSERT INTO `o2o_featured` VALUES ('1', '0', '交易细则', '', 'https://www.champion.com', '冠军', '0', '0', '1562050032', '1562204534');

-- ----------------------------
-- Table structure for o2o_order
-- ----------------------------
DROP TABLE IF EXISTS `o2o_order`;
CREATE TABLE `o2o_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `out_trade_no` varchar(100) NOT NULL DEFAULT '' COMMENT '订单编号',
  `transaction_id` varchar(100) NOT NULL DEFAULT '' COMMENT '微信支付编号',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `pay_time` int(20) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `payment_id` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `deal_id` int(11) NOT NULL DEFAULT '0' COMMENT '购买的商品id',
  `deal_count` int(11) NOT NULL DEFAULT '0' COMMENT '购买的商品数量',
  `pay_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付状态 0未支付 1成功 2失败',
  `total_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '订单总价格',
  `pay_amount` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '微信返回价格',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `referer` varchar(255) NOT NULL DEFAULT '' COMMENT '订单来源',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `out_trade_no` (`out_trade_no`),
  KEY `user_id` (`user_id`),
  KEY `create_time` (`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of o2o_order
-- ----------------------------
INSERT INTO `o2o_order` VALUES ('1', '1562318703341260304', '', '5', 'zzs', '0', '1', '1', '0', '1', '1.00', '0.00', '1', 'http://localhost/index/order/confirm.html?id=1count=1', '1562318703', '1562318703');
INSERT INTO `o2o_order` VALUES ('2', '1562318718431725811', '', '5', 'zzs', '0', '1', '1', '0', '1', '8.00', '0.00', '1', 'http://localhost/index/order/confirm.html?id=1count=1', '1562318718', '1562318718');

-- ----------------------------
-- Table structure for o2o_user
-- ----------------------------
DROP TABLE IF EXISTS `o2o_user`;
CREATE TABLE `o2o_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '会员名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '随机字符串',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '最后登陆ip',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `email` varchar(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '联系方式',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of o2o_user
-- ----------------------------
INSERT INTO `o2o_user` VALUES ('3', '231', '36bcf06a602a39d4eeb67bce78e50cc8', '', '', '0', '1071119121@zzs.com', '', '0', '1', '1562211328', '1562211328');
INSERT INTO `o2o_user` VALUES ('4', '231', '0325d8c0da12f56d6533c34e1ec74062', '', '', '0', '1071119121@zzs.com', '', '0', '1', '1562211362', '1562211362');
INSERT INTO `o2o_user` VALUES ('5', 'zzs', '85e0398d7207dfbe3dfec6bf98e055bf', '643', '', '1562313338', '1071119121@qq.com', '', '0', '1', '1562221069', '1562313338');
