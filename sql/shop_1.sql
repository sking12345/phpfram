-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	5.7.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `xs_brand`
--

DROP TABLE IF EXISTS `xs_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xs_brand`
--

LOCK TABLES `xs_brand` WRITE;
/*!40000 ALTER TABLE `xs_brand` DISABLE KEYS */;
INSERT INTO `xs_brand` VALUES ('qwer5cd984cb859ffo','ppp','www.baidu.com','./upload/img/qwercd984cb85a14.png','sss',10,1),('qwer5cd98515b6892y','ppp1','nnn','./upload/img/qwercd98515b68a7.png','pp',10,1),('qwer5cd9a86e15228s','ppp2','dd','./upload/img/qwercd9a8c998467.png','pppp',20,1);
/*!40000 ALTER TABLE `xs_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_category`
--

DROP TABLE IF EXISTS `xs_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xs_category`
--

LOCK TABLES `xs_category` WRITE;
/*!40000 ALTER TABLE `xs_category` DISABLE KEYS */;
INSERT INTO `xs_category` VALUES ('qwer5cd95fa386b63n','xxx','11','sss','0','0',50,'','111',1,NULL,1,0,'qwer5cd854e33951av','qwer5cd871328aa46l','3',NULL,NULL,NULL,NULL,NULL,NULL),('qwer5cd95fb3d6fde8','ddd','dd','ssss','qwer5cd95fa386b63n','0,qwer5cd95fa386b63n',50,'','aaa',1,NULL,1,0,'qwer5cd854e33951av','qwer5cd871328aa46l','0',NULL,NULL,NULL,NULL,NULL,NULL),('qwer5cd960187cabeu','ppp','','','qwer5cd95fb3d6fde8','0,qwer5cd95fa386b63n,qwer5cd95fb3d6fde8',50,'','11',1,NULL,1,0,'qwer5cd854e33951av','qwert5cda737e352ee','3',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `xs_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_genre`
--

DROP TABLE IF EXISTS `xs_genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xs_genre`
--

LOCK TABLES `xs_genre` WRITE;
/*!40000 ALTER TABLE `xs_genre` DISABLE KEYS */;
INSERT INTO `xs_genre` VALUES ('qwer5cd854e33951av','ppp1',1,2,'aaa',NULL,NULL,NULL,NULL,NULL,NULL),('qwer5cd85578a83a7m','asdfad',0,1,'adfsdfs',NULL,NULL,NULL,NULL,NULL,NULL),('qwert5cda77d12bb40','type1',0,1,'ssss',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `xs_genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_genre_attr`
--

DROP TABLE IF EXISTS `xs_genre_attr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xs_genre_attr`
--

LOCK TABLES `xs_genre_attr` WRITE;
/*!40000 ALTER TABLE `xs_genre_attr` DISABLE KEYS */;
INSERT INTO `xs_genre_attr` VALUES ('qwert5cda737e352ee','dddd','qwer5cd854e33951av',1,'sss|ffff','ssss',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `xs_genre_attr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_genre_attr_list`
--

DROP TABLE IF EXISTS `xs_genre_attr_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xs_genre_attr_list` (
  `id` varchar(45) NOT NULL,
  `attr_id` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性列表可选值';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xs_genre_attr_list`
--

LOCK TABLES `xs_genre_attr_list` WRITE;
/*!40000 ALTER TABLE `xs_genre_attr_list` DISABLE KEYS */;
INSERT INTO `xs_genre_attr_list` VALUES ('qwer5cd86f19071faj','qwer5cd865d0edf39l','qwe'),('qwer5cd86f190720fq','qwer5cd865d0edf39l','ddd'),('qwer5cd86f695cf35i','qwer5cd8675e28a22f','111'),('qwer5cd86f695cf4ay','qwer5cd8675e28a22f','dd'),('qwer5cd86f8fa6130i','qwer5cd86c574c1126','aaa'),('qwer5cd871192e767l','qwer5cd86fd97c93f1','ddd'),('qwer5cd871192e779o','qwer5cd86fd97c93f1','dd'),('qwert5cda722b93f45','qwer5cd871328aa46l',''),('qwert5cda7304ce1f8','qwer5cd87213dd749r',''),('qwert5cda737e352f6','qwert5cda737e352ee','sss'),('qwert5cda737e352f9','qwert5cda737e352ee','ffff'),('qwert5cda76d7c3318','qwert5cda73769fe96','1111');
/*!40000 ALTER TABLE `xs_genre_attr_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_merchandise`
--

DROP TABLE IF EXISTS `xs_merchandise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xs_merchandise` (
  `id` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `number` varchar(45) DEFAULT NULL COMMENT '货号',
  `cate_id` varchar(45) DEFAULT NULL COMMENT '分类编号',
  `brand_id` varchar(45) DEFAULT NULL COMMENT '品牌',
  `supplier_id` varchar(45) DEFAULT NULL COMMENT '供应商id',
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
  `is_shelf` tinyint(1) DEFAULT NULL COMMENT '是否上架',
  `is_general_goods` tinyint(1) DEFAULT NULL COMMENT '是否作为普通商品',
  `is_free_shipping` tinyint(1) DEFAULT NULL COMMENT '是否免运费',
  `keyword` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品管理';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xs_merchandise`
--

LOCK TABLES `xs_merchandise` WRITE;
/*!40000 ALTER TABLE `xs_merchandise` DISABLE KEYS */;
INSERT INTO `xs_merchandise` VALUES ('qwer5cdaf9bd345066','s s s','','qwer5cd95fb3d6fde8','qwer5cd984cb859ffo','',11.00,11.00,11.00,11.00,1557853200,1557766800,'./upload/img/qwercdaf9bd3458d.png','111',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `xs_merchandise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_merchandise_attr`
--

DROP TABLE IF EXISTS `xs_merchandise_attr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xs_merchandise_attr` (
  `id` varchar(45) NOT NULL,
  `merchandise_id` varchar(45) DEFAULT NULL,
  `attr_id` varchar(45) DEFAULT NULL COMMENT '属性id',
  `attr_val` varchar(45) DEFAULT NULL COMMENT '属性值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品属性';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xs_merchandise_attr`
--

LOCK TABLES `xs_merchandise_attr` WRITE;
/*!40000 ALTER TABLE `xs_merchandise_attr` DISABLE KEYS */;
/*!40000 ALTER TABLE `xs_merchandise_attr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_supplier`
--

DROP TABLE IF EXISTS `xs_supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xs_supplier`
--

LOCK TABLES `xs_supplier` WRITE;
/*!40000 ALTER TABLE `xs_supplier` DISABLE KEYS */;
INSERT INTO `xs_supplier` VALUES ('qwert5cda38d10dddb','supplier','广东省广州市白云区xxx街道320号','086240609','18620400909','张三',2,'desc'),('qwert5cda4a4b64a09','supplier2','广东省广州市白云区xxx街道321号','08620400609','18620400909','李四',1,'');
/*!40000 ALTER TABLE `xs_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xs_supplier_status`
--

DROP TABLE IF EXISTS `xs_supplier_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xs_supplier_status` (
  `id` varchar(45) NOT NULL,
  `supplier_id` varchar(45) DEFAULT NULL COMMENT '供应商',
  `status` varchar(45) DEFAULT NULL COMMENT '状态',
  `remarks` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xs_supplier_status`
--

LOCK TABLES `xs_supplier_status` WRITE;
/*!40000 ALTER TABLE `xs_supplier_status` DISABLE KEYS */;
INSERT INTO `xs_supplier_status` VALUES ('qwert5cda438b1cd87','qwert5cda38d10dddb','2','desc',1557808011),('qwert5cda438d9125c','qwert5cda38d10dddb','1','desc',1557808013),('qwert5cda469ddb92c','qwert5cda38d10dddb','2','desc',1557808797),('qwert5cda46f14e179','qwert5cda38d10dddb','1','desc',1557808881),('qwert5cda7e6f728cb','qwert5cda38d10dddb','2','desc',1557823087);
/*!40000 ALTER TABLE `xs_supplier_status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-15  9:57:05
