# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.41)
# Database: shop
# Generation Time: 2019-05-18 10:57:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table xs_brand
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_brand`;

CREATE TABLE `xs_brand` (
  `id` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `is_show` tinyint(1) DEFAULT NULL COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品牌';

LOCK TABLES `xs_brand` WRITE;
/*!40000 ALTER TABLE `xs_brand` DISABLE KEYS */;

INSERT INTO `xs_brand` (`id`, `name`, `url`, `logo`, `remarks`, `sort`, `is_show`)
VALUES
	('qwert5cdfcda5c12e7','百度','http://www.baidu.com','./upload/img/qwertdfcda5c12f1.png','',10,1),
	('qwert5cdfcdbfc86d6','google','http://www.google.com','./upload/img/qwertdfcdbfc86dd.png','',10,1),
	('qwert5cdfcdd960311','苹果','http://www.apple.com','./upload/img/qwertdfcde216494.png','',10,2);

/*!40000 ALTER TABLE `xs_brand` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xs_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_category`;

CREATE TABLE `xs_category` (
  `id` varchar(45) NOT NULL,
  `cat_name` varchar(90) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `cat_desc` varchar(255) NOT NULL DEFAULT '',
  `parent_id` varchar(45) NOT NULL DEFAULT '0',
  `parents` varchar(255) NOT NULL DEFAULT '0' COMMENT '上级目录',
  `sort_order` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `template_file` varchar(50) DEFAULT '',
  `measure_unit` varchar(15) DEFAULT '',
  `show_in_nav` tinyint(1) DEFAULT '1',
  `style` varchar(150) DEFAULT NULL,
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `grade` tinyint(4) DEFAULT '0',
  `genre_id` varchar(255) DEFAULT NULL,
  `filter_attr` varchar(255) DEFAULT '0',
  `cat_recommer_val` varchar(45) DEFAULT NULL,
  `cat_recommend` varchar(45) DEFAULT NULL,
  `create_user` varchar(35) DEFAULT NULL,
  `update_user` varchar(45) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_user` varchar(45) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `create_time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品分类';

LOCK TABLES `xs_category` WRITE;
/*!40000 ALTER TABLE `xs_category` DISABLE KEYS */;

INSERT INTO `xs_category` (`id`, `cat_name`, `keywords`, `cat_desc`, `parent_id`, `parents`, `sort_order`, `template_file`, `measure_unit`, `show_in_nav`, `style`, `is_show`, `grade`, `genre_id`, `filter_attr`, `cat_recommer_val`, `cat_recommend`, `create_user`, `update_user`, `update_time`, `delete_user`, `delete_time`, `create_time`)
VALUES
	('qwert5cdfce377a695','家用电器','电器|家用','','0','0',50,'','',1,NULL,1,0,'选择商品类型','0',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfce4d1d569','大家电','','','qwert5cdfce377a695','0,qwert5cdfce377a695',50,'','',1,NULL,1,0,'选择商品类型','0',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfce6910cef','洗衣机','','','qwert5cdfce4d1d569','0,qwert5cdfce377a695,qwert5cdfce4d1d569',50,'','',1,NULL,1,0,'选择商品类型','0',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfce88a7bc9','冰箱','','','qwert5cdfce4d1d569','0,qwert5cdfce377a695,qwert5cdfce4d1d569',50,'','',1,NULL,1,0,'选择商品类型','0',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfceb00b72d','家用空调','','','0','0',50,'','',1,NULL,1,0,'选择商品类型','0',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcee227ed5','数码时尚','','','0','0',50,'','',1,NULL,1,0,'选择商品类型','0',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcf19dbc3f','智能硬件','','','0','0',50,'','',1,NULL,1,0,'选择商品类型','0',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcf2b28395','移动电源','','','0','0',50,'','',1,NULL,1,0,'选择商品类型','0',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcf376a085','手机类型','','','0','0',50,'','',1,NULL,1,0,'选择商品类型','0',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `xs_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xs_genre
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_genre`;

CREATE TABLE `xs_genre` (
  `id` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `attr_num` int(11) NOT NULL DEFAULT '0' COMMENT '属性数',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `remarks` varchar(255) DEFAULT NULL,
  `create_user` varchar(35) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_user` varchar(45) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_user` varchar(45) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品类型';

LOCK TABLES `xs_genre` WRITE;
/*!40000 ALTER TABLE `xs_genre` DISABLE KEYS */;

INSERT INTO `xs_genre` (`id`, `name`, `attr_num`, `enabled`, `remarks`, `create_user`, `create_time`, `update_user`, `update_time`, `delete_user`, `delete_time`)
VALUES
	('qwert5cdfc930a00a6','书',12,1,'',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfc95472bdc','音乐',14,1,'',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfc95f8cca4','电影',12,1,'',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfc96f25e4b','手机',0,1,'',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfc97c730cd','笔记本电脑',0,1,'',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfc98a295c6','数码相机',0,1,'',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfc99ce974b','数码摄像机',0,1,'',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfc9acbc61f','化妆品',0,1,'',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfc9ba11d49','精品手机',0,1,'',NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `xs_genre` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xs_genre_attr
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_genre_attr`;

CREATE TABLE `xs_genre_attr` (
  `id` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `genre_id` varchar(45) NOT NULL COMMENT '类型id',
  `select_type` tinyint(1) DEFAULT NULL COMMENT '属性选择方式 1:单选 2:复选属性',
  `input_type` tinyint(1) DEFAULT NULL,
  `select_list` varchar(45) DEFAULT NULL COMMENT '可选择值列表',
  `remarks` varchar(255) DEFAULT NULL,
  `create_user` varchar(35) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_user` varchar(45) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_user` varchar(45) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xs_genre_attr` WRITE;
/*!40000 ALTER TABLE `xs_genre_attr` DISABLE KEYS */;

INSERT INTO `xs_genre_attr` (`id`, `name`, `genre_id`, `select_type`, `input_type`, `select_list`, `remarks`, `create_user`, `create_time`, `update_user`, `update_time`, `delete_user`, `delete_time`)
VALUES
	('qwert5cdfca1ca2cad','作者','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfca2f51840','出版社','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfca3f56e44','图书书号','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfca4a243d0','出版日期','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfca56144ac','开本','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfca6cc85da','图书页数','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfca7b9feb9','图书装订','qwert5cdfc930a00a6',NULL,2,'平装|黑白','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfca8939488','图书规格','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfca9a87592','版次','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcab44bf4b','印张','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcabb2ebc8','字数','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcac40cb89','所属分类','qwert5cdfc930a00a6',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcb5e02d72','中文片名','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcb69449d1','英文片名','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcb72819e4','商品别名','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcbb331063','介质/格式','qwert5cdfc95472bdc',NULL,2,'HDCD|DTS|DVD|DVD9|VCD|CD|TAPE|LP','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcbd4ba07a','片装数','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcbde5ed53','国家地区','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcbe5d0d05','语种','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcc09dde24','主唱','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcc3f0c6d3','所属类别','qwert5cdfc95472bdc',NULL,2,'古典|流行|摇滚|乡村|民谣|爵士|电子','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcc49efe79','长度','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcc7a56b91','歌词','qwert5cdfc95472bdc',NULL,2,'有|无','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcc8dbe9d5','碟片代码','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcc989ce1c','ISRC码','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcca3be078','发行公司','qwert5cdfc95472bdc',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcccddec13','中文片名','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfccd77401b','英文片名','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcce2f2831','商品别名','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfccf343487','介质/格式','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcd09a89a9','碟片类型','qwert5cdfc95f8cca4',NULL,2,'单面|双层','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcd1472f8d','片装数','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcd1a6ae62','国家地区','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcd2b9a658','语种/配音','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcd3661526','字母','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcd42bf1f1','导演','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcd4d00a3e','表演者','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cdfcd53ceef5','年份','qwert5cdfc95f8cca4',NULL,1,'','',NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `xs_genre_attr` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xs_genre_attr_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_genre_attr_list`;

CREATE TABLE `xs_genre_attr_list` (
  `id` varchar(45) NOT NULL,
  `attr_id` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `genre_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性列表可选值';

LOCK TABLES `xs_genre_attr_list` WRITE;
/*!40000 ALTER TABLE `xs_genre_attr_list` DISABLE KEYS */;

INSERT INTO `xs_genre_attr_list` (`id`, `attr_id`, `name`, `genre_id`)
VALUES
	('qwert5cdfca1ca2cb3','qwert5cdfca1ca2cad','','qwert5cdfc930a00a6'),
	('qwert5cdfca2f5184a','qwert5cdfca2f51840','','qwert5cdfc930a00a6'),
	('qwert5cdfca3f56e4b','qwert5cdfca3f56e44','','qwert5cdfc930a00a6'),
	('qwert5cdfca4a243d6','qwert5cdfca4a243d0','','qwert5cdfc930a00a6'),
	('qwert5cdfca56144bc','qwert5cdfca56144ac','','qwert5cdfc930a00a6'),
	('qwert5cdfca6cc85df','qwert5cdfca6cc85da','','qwert5cdfc930a00a6'),
	('qwert5cdfca893948e','qwert5cdfca8939488','','qwert5cdfc930a00a6'),
	('qwert5cdfca9a87597','qwert5cdfca9a87592','','qwert5cdfc930a00a6'),
	('qwert5cdfcab44bf50','qwert5cdfcab44bf4b','','qwert5cdfc930a00a6'),
	('qwert5cdfcabb2ebcf','qwert5cdfcabb2ebc8','','qwert5cdfc930a00a6'),
	('qwert5cdfcac40cb8e','qwert5cdfcac40cb89','','qwert5cdfc930a00a6'),
	('qwert5cdfcb355f360','qwert5cdfca7b9feb9','平装','qwert5cdfc930a00a6'),
	('qwert5cdfcb355f366','qwert5cdfca7b9feb9','黑白','qwert5cdfc930a00a6'),
	('qwert5cdfcb5e02d79','qwert5cdfcb5e02d72','','qwert5cdfc95472bdc'),
	('qwert5cdfcb69449d7','qwert5cdfcb69449d1','','qwert5cdfc95472bdc'),
	('qwert5cdfcb72819e9','qwert5cdfcb72819e4','','qwert5cdfc95472bdc'),
	('qwert5cdfcbb331069','qwert5cdfcbb331063','HDCD','qwert5cdfc95472bdc'),
	('qwert5cdfcbb33106b','qwert5cdfcbb331063','DTS','qwert5cdfc95472bdc'),
	('qwert5cdfcbb33106c','qwert5cdfcbb331063','DVD','qwert5cdfc95472bdc'),
	('qwert5cdfcbb33106d','qwert5cdfcbb331063','DVD9','qwert5cdfc95472bdc'),
	('qwert5cdfcbb33106e','qwert5cdfcbb331063','VCD','qwert5cdfc95472bdc'),
	('qwert5cdfcbb33106f','qwert5cdfcbb331063','CD','qwert5cdfc95472bdc'),
	('qwert5cdfcbb331070','qwert5cdfcbb331063','TAPE','qwert5cdfc95472bdc'),
	('qwert5cdfcbb331071','qwert5cdfcbb331063','LP','qwert5cdfc95472bdc'),
	('qwert5cdfcbd4ba083','qwert5cdfcbd4ba07a','','qwert5cdfc95472bdc'),
	('qwert5cdfcbde5ed58','qwert5cdfcbde5ed53','','qwert5cdfc95472bdc'),
	('qwert5cdfcbe5d0d0b','qwert5cdfcbe5d0d05','','qwert5cdfc95472bdc'),
	('qwert5cdfcc09dde29','qwert5cdfcc09dde24','','qwert5cdfc95472bdc'),
	('qwert5cdfcc3f0c6db','qwert5cdfcc3f0c6d3','古典','qwert5cdfc95472bdc'),
	('qwert5cdfcc3f0c6de','qwert5cdfcc3f0c6d3','流行','qwert5cdfc95472bdc'),
	('qwert5cdfcc3f0c6df','qwert5cdfcc3f0c6d3','摇滚','qwert5cdfc95472bdc'),
	('qwert5cdfcc3f0c6e0','qwert5cdfcc3f0c6d3','乡村','qwert5cdfc95472bdc'),
	('qwert5cdfcc3f0c6e1','qwert5cdfcc3f0c6d3','民谣','qwert5cdfc95472bdc'),
	('qwert5cdfcc3f0c6e2','qwert5cdfcc3f0c6d3','爵士','qwert5cdfc95472bdc'),
	('qwert5cdfcc3f0c6e3','qwert5cdfcc3f0c6d3','电子','qwert5cdfc95472bdc'),
	('qwert5cdfcc49efe7f','qwert5cdfcc49efe79','','qwert5cdfc95472bdc'),
	('qwert5cdfcc7a56b97','qwert5cdfcc7a56b91','有','qwert5cdfc95472bdc'),
	('qwert5cdfcc7a56b99','qwert5cdfcc7a56b91','无','qwert5cdfc95472bdc'),
	('qwert5cdfcc8dbe9dd','qwert5cdfcc8dbe9d5','','qwert5cdfc95472bdc'),
	('qwert5cdfcc989ce24','qwert5cdfcc989ce1c','','qwert5cdfc95472bdc'),
	('qwert5cdfcca3be080','qwert5cdfcca3be078','','qwert5cdfc95472bdc'),
	('qwert5cdfcccddec1a','qwert5cdfcccddec13','','qwert5cdfc95f8cca4'),
	('qwert5cdfccd774020','qwert5cdfccd77401b','','qwert5cdfc95f8cca4'),
	('qwert5cdfcce2f2837','qwert5cdfcce2f2831','','qwert5cdfc95f8cca4'),
	('qwert5cdfccf34348d','qwert5cdfccf343487','','qwert5cdfc95f8cca4'),
	('qwert5cdfcd09a89b1','qwert5cdfcd09a89a9','单面','qwert5cdfc95f8cca4'),
	('qwert5cdfcd09a89b5','qwert5cdfcd09a89a9','双层','qwert5cdfc95f8cca4'),
	('qwert5cdfcd1472f93','qwert5cdfcd1472f8d','','qwert5cdfc95f8cca4'),
	('qwert5cdfcd1a6ae68','qwert5cdfcd1a6ae62','','qwert5cdfc95f8cca4'),
	('qwert5cdfcd2b9a65e','qwert5cdfcd2b9a658','','qwert5cdfc95f8cca4'),
	('qwert5cdfcd366152b','qwert5cdfcd3661526','','qwert5cdfc95f8cca4'),
	('qwert5cdfcd42bf1f9','qwert5cdfcd42bf1f1','','qwert5cdfc95f8cca4'),
	('qwert5cdfcd4d00a44','qwert5cdfcd4d00a3e','','qwert5cdfc95f8cca4'),
	('qwert5cdfcd53ceefd','qwert5cdfcd53ceef5','','qwert5cdfc95f8cca4');

/*!40000 ALTER TABLE `xs_genre_attr_list` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xs_merchandise
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_merchandise`;

CREATE TABLE `xs_merchandise` (
  `id` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `number` varchar(45) DEFAULT NULL COMMENT '货号',
  `cate_id` varchar(45) DEFAULT NULL COMMENT '分类编号',
  `brand_id` varchar(45) DEFAULT NULL COMMENT '品牌',
  `supplier_id` varchar(45) DEFAULT NULL COMMENT '供应商id',
  `genre_id` varchar(45) DEFAULT NULL,
  `shop_price` double(20,2) DEFAULT NULL,
  `member_price` double(20,2) DEFAULT NULL COMMENT '会员价格',
  `vip_price` double(20,2) DEFAULT NULL COMMENT 'Vip 价格',
  `promotion_price` decimal(20,2) DEFAULT NULL COMMENT '促销价',
  `promotion_start_time` int(11) DEFAULT NULL COMMENT '促销开始时间',
  `promotion_end_time` int(11) DEFAULT NULL COMMENT '促销结束时间',
  `img` varchar(150) DEFAULT NULL COMMENT '缩略图',
  `remarks` varchar(255) DEFAULT NULL COMMENT '描述',
  `weight` int(11) DEFAULT NULL COMMENT '重量',
  `weight_type` tinyint(1) DEFAULT NULL COMMENT '重量方式',
  `stock_num` int(11) DEFAULT NULL COMMENT '库存数量',
  `stock_waring_num` int(11) DEFAULT NULL COMMENT '库存警告数量',
  `recommend` int(11) DEFAULT NULL COMMENT '推荐',
  `is_shelf` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否上架',
  `is_general_goods` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否作为普通商品',
  `is_free_shipping` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否免运费',
  `keyword` varchar(150) NOT NULL DEFAULT '-',
  `sales_num` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
  `details` text COMMENT '详情',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品管理';



# Dump of table xs_merchandise_attr
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_merchandise_attr`;

CREATE TABLE `xs_merchandise_attr` (
  `id` varchar(45) NOT NULL,
  `merchandise_id` varchar(45) DEFAULT NULL,
  `attr_id` varchar(45) DEFAULT NULL COMMENT '属性id',
  `attr_val` varchar(45) DEFAULT NULL COMMENT '属性值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品属性';



# Dump of table xs_merchandise_imgs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_merchandise_imgs`;

CREATE TABLE `xs_merchandise_imgs` (
  `id` varchar(45) NOT NULL,
  `merchandise_id` varchar(45) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `remarks` varchar(25) DEFAULT NULL,
  `delete_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品图片';



# Dump of table xs_supplier
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_supplier`;

CREATE TABLE `xs_supplier` (
  `id` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL COMMENT '供应商名',
  `addr` varchar(255) DEFAULT NULL COMMENT '地址',
  `tel` varchar(45) DEFAULT NULL COMMENT '办公电话',
  `phone` varchar(45) DEFAULT NULL COMMENT '手机号',
  `contact` varchar(45) DEFAULT NULL COMMENT '联系人',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `remarks` varchar(255) DEFAULT NULL COMMENT '描述备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供应商';

LOCK TABLES `xs_supplier` WRITE;
/*!40000 ALTER TABLE `xs_supplier` DISABLE KEYS */;

INSERT INTO `xs_supplier` (`id`, `name`, `addr`, `tel`, `phone`, `contact`, `status`, `remarks`)
VALUES
	('qwert5cdfc81ab6b0c','供应商1','广东省广州市白云区xxx街道320号','08620400609','18620400909','张三',1,'不错3'),
	('qwert5cdfc83814356','供应商2','广东省广州市白云区xxx街道321号','08620400609','18620400909','李四',1,'1111'),
	('qwert5cdfc875bca8b','供应商3','广东省广州市白云区xxx街道322号','08620400609','18620400909','王五',1,'收拾收拾');

/*!40000 ALTER TABLE `xs_supplier` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xs_supplier_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_supplier_status`;

CREATE TABLE `xs_supplier_status` (
  `id` varchar(45) NOT NULL,
  `supplier_id` varchar(45) DEFAULT NULL COMMENT '供应商',
  `status` varchar(45) DEFAULT NULL COMMENT '状态',
  `remarks` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `xs_supplier_status` WRITE;
/*!40000 ALTER TABLE `xs_supplier_status` DISABLE KEYS */;

INSERT INTO `xs_supplier_status` (`id`, `supplier_id`, `status`, `remarks`, `create_time`)
VALUES
	('qwert5cdfc89366203','qwert5cdfc81ab6b0c','2','不错',1558169747),
	('qwert5cdfc89b63b25','qwert5cdfc81ab6b0c','1','不错1',1558169755),
	('qwert5cdfc8a0ea6f7','qwert5cdfc81ab6b0c','2','不错2',1558169760),
	('qwert5cdfc8ed01296','qwert5cdfc81ab6b0c','1','不错3',1558169837);

/*!40000 ALTER TABLE `xs_supplier_status` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
