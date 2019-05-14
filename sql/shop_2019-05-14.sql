# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.41)
# Database: shop
# Generation Time: 2019-05-14 11:18:40 +0000
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
	('qwer5cd984cb859ffo','ppp','www.baidu.com','./upload/img/qwercd984cb85a14.png','sss',10,1),
	('qwer5cd98515b6892y','ppp','nnn','./upload/img/qwercd98515b68a7.png','pp',10,1),
	('qwer5cd9a86e15228s','ppp','dd','./upload/img/qwercd9a8c998467.png','pppp',20,1);

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

INSERT INTO `xs_category` (`id`, `cat_name`, `keywords`, `cat_desc`, `parent_id`, `parents`, `sort_order`, `template_file`, `measure_unit`, `show_in_nav`, `style`, `is_show`, `grade`, `genre_id`, `filter_attr`, `cat_recommend`, `create_user`, `update_user`, `update_time`, `delete_user`, `delete_time`, `create_time`)
VALUES
	('qwer5cd95fa386b63n','xxx','11','sss','0','0',50,'','111',1,NULL,1,0,'qwer5cd854e33951av','qwer5cd871328aa46l','3',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwer5cd95fb3d6fde8','ddd','dd','ssss','qwer5cd95fa386b63n','0,qwer5cd95fa386b63n',50,'','aaa',1,NULL,1,0,'qwer5cd854e33951av','qwer5cd871328aa46l','0',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwer5cd960187cabeu','ppp','','','qwer5cd95fb3d6fde8','0,qwer5cd95fa386b63n,qwer5cd95fb3d6fde8',50,'','11',1,NULL,1,0,'qwer5cd854e33951av','qwer5cd871328aa46l','3',NULL,NULL,NULL,NULL,NULL,NULL);

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
	('qwer5cd854e33951av','ppp1',1,2,'aaa',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwer5cd85578a83a7m','asdfad',0,1,'adfsdfs',NULL,NULL,NULL,NULL,NULL,NULL),
	('qwert5cda77d12bb40','type1',0,1,'ssss',NULL,NULL,NULL,NULL,NULL,NULL);

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

INSERT INTO `xs_genre_attr` (`id`, `name`, `genre_id`, `select_type`, `select_list`, `remarks`, `create_user`, `create_time`, `update_user`, `update_time`, `delete_user`, `delete_time`)
VALUES
	('qwert5cda737e352ee','dddd','qwer5cd854e33951av',1,'sss|ffff','ssss',NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `xs_genre_attr` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table xs_genre_attr_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `xs_genre_attr_list`;

CREATE TABLE `xs_genre_attr_list` (
  `id` varchar(45) NOT NULL,
  `attr_id` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性列表可选值';

LOCK TABLES `xs_genre_attr_list` WRITE;
/*!40000 ALTER TABLE `xs_genre_attr_list` DISABLE KEYS */;

INSERT INTO `xs_genre_attr_list` (`id`, `attr_id`, `name`)
VALUES
	('qwer5cd86f19071faj','qwer5cd865d0edf39l','qwe'),
	('qwer5cd86f190720fq','qwer5cd865d0edf39l','ddd'),
	('qwer5cd86f695cf35i','qwer5cd8675e28a22f','111'),
	('qwer5cd86f695cf4ay','qwer5cd8675e28a22f','dd'),
	('qwer5cd86f8fa6130i','qwer5cd86c574c1126','aaa'),
	('qwer5cd871192e767l','qwer5cd86fd97c93f1','ddd'),
	('qwer5cd871192e779o','qwer5cd86fd97c93f1','dd'),
	('qwert5cda722b93f45','qwer5cd871328aa46l',''),
	('qwert5cda7304ce1f8','qwer5cd87213dd749r',''),
	('qwert5cda737e352f6','qwert5cda737e352ee','sss'),
	('qwert5cda737e352f9','qwert5cda737e352ee','ffff'),
	('qwert5cda76d7c3318','qwert5cda73769fe96','1111');

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
  `shop_price` double(20,4) DEFAULT NULL,
  `member_price` double(20,4) DEFAULT NULL COMMENT '会员价格',
  `vip_price` double(20,4) DEFAULT NULL COMMENT 'Vip 价格',
  `promotion_price` decimal(20,4) DEFAULT NULL COMMENT '促销价',
  `promotion_start_time` int(11) DEFAULT NULL COMMENT '促销开始时间',
  `promotion_end_time` int(11) DEFAULT NULL COMMENT '促销结束时间',
  `img` varchar(150) DEFAULT NULL COMMENT '缩略图',
  `remarks` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品管理';



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
	('qwert5cda38d10dddb','supplier','广东省广州市白云区xxx街道320号','086240609','18620400909','张三',2,'desc'),
	('qwert5cda4a4b64a09','supplier2','广东省广州市白云区xxx街道321号','08620400609','18620400909','李四',1,'');

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
	('qwert5cda438b1cd87','qwert5cda38d10dddb','2','desc',1557808011),
	('qwert5cda438d9125c','qwert5cda38d10dddb','1','desc',1557808013),
	('qwert5cda469ddb92c','qwert5cda38d10dddb','2','desc',1557808797),
	('qwert5cda46f14e179','qwert5cda38d10dddb','1','desc',1557808881),
	('qwert5cda7e6f728cb','qwert5cda38d10dddb','2','desc',1557823087);

/*!40000 ALTER TABLE `xs_supplier_status` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
