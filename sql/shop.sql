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
  `sort_order` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `template_file` varchar(50) DEFAULT '',
  `measure_unit` varchar(15) DEFAULT '',
  `show_in_nav` tinyint(1) DEFAULT '1',
  `style` varchar(150) DEFAULT NULL,
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `grade` tinyint(4) DEFAULT '0',
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
INSERT INTO `xs_category` VALUES ('qwer5cd73c1a41e35h','xxx','11','111','0',50,'','11',1,NULL,1,0,'0','1,2',NULL,NULL,NULL,NULL,NULL,NULL),('qwer5cd73c896809b6','xxx1','111','sdasf','qwer5cd73c1a41e35h',50,'','111',1,NULL,1,0,'0','1,2',NULL,NULL,NULL,NULL,NULL,NULL);
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
INSERT INTO `xs_genre` VALUES ('qwer5cd854e33951av','ppp1',0,2,'aaa',NULL,NULL,NULL,NULL,NULL,NULL),('qwer5cd85578a83a7m','asdfad',0,1,'adfsdfs',NULL,NULL,NULL,NULL,NULL,NULL);
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
INSERT INTO `xs_genre_attr` VALUES ('qwer5cd871328aa46l','ppp','qwer5cd854e33951av',1,'sss','ssss',NULL,NULL,NULL,NULL,NULL,NULL),('qwer5cd87213dd749r','qqqq','qwer5cd854e33951av',1,'qqq|www','qqqqq',NULL,NULL,NULL,NULL,NULL,NULL);
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
INSERT INTO `xs_genre_attr_list` VALUES ('qwer5cd86f19071faj','qwer5cd865d0edf39l','qwe'),('qwer5cd86f190720fq','qwer5cd865d0edf39l','ddd'),('qwer5cd86f695cf35i','qwer5cd8675e28a22f','111'),('qwer5cd86f695cf4ay','qwer5cd8675e28a22f','dd'),('qwer5cd86f8fa6130i','qwer5cd86c574c1126','aaa'),('qwer5cd871192e767l','qwer5cd86fd97c93f1','ddd'),('qwer5cd871192e779o','qwer5cd86fd97c93f1','dd'),('qwer5cd87213dd761d','qwer5cd87213dd749r','qqq'),('qwer5cd87213dd76d4','qwer5cd87213dd749r','www'),('qwer5cd874b02d722z','qwer5cd871328aa46l','sss');
/*!40000 ALTER TABLE `xs_genre_attr_list` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-13 10:16:04
