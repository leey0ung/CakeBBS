-- MySQL dump 10.13  Distrib 5.5.27, for Win32 (x86)
--
-- Host: localhost    Database: cakebbs
-- ------------------------------------------------------
-- Server version	5.5.27

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
-- Table structure for table `responses`
--

DROP TABLE IF EXISTS `responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `threadid` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `createtime` datetime NOT NULL,
  `updatetime` datetime DEFAULT NULL,
  `showflag` tinyint(1) NOT NULL DEFAULT '0',
  `temp1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `threadid` (`threadid`),
  CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`threadid`) REFERENCES `threads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responses`
--

LOCK TABLES `responses` WRITE;
/*!40000 ALTER TABLE `responses` DISABLE KEYS */;
INSERT INTO `responses` VALUES (27,63,'RE：ガソリン、七週連続値下がり','リエイ','','198925','最高！','2013-04-24 17:29:29','2013-04-24 17:29:29',1,NULL,NULL,NULL),(28,63,'RE：ガソリン、七週連続値下がり','大西','oonishi@yahoo.co.jp','198925','すげい','2013-04-24 17:48:33','2013-04-24 17:48:33',1,NULL,NULL,NULL),(29,63,'RE：ガソリン、七週連続値下がり','戸山','toyama@yahoo.co.jp','198925','よし','2013-04-24 17:51:01','2013-04-25 13:48:59',1,NULL,NULL,NULL),(30,63,'RE：ガソリン、七週連続値下がり','test','','','<a href=\"www.yahoo.co.jp\"></a>','2013-04-24 17:52:02','2013-04-24 17:52:02',0,NULL,NULL,NULL),(31,65,'RE：見積もり競争支援システム','李咏','','','見積書ちょうだい','2013-04-24 18:56:40','2013-04-24 18:56:40',0,NULL,NULL,NULL),(32,65,'RE：見積もり競争支援システム','test','','','<sssss>','2013-04-24 19:04:44','2013-04-24 19:04:44',0,NULL,NULL,NULL),(33,66,'RE：組み込み開発','リエイ','','','<a></a>ただのテスト','2013-04-24 19:08:20','2013-04-24 19:08:20',0,NULL,NULL,NULL),(34,66,'RE：組み込み開発','リエイ','','','<a></a>ただのテスト','2013-04-24 19:08:20','2013-04-24 19:08:20',0,NULL,NULL,NULL),(35,69,'RE：test','テスト次郎','','','ああああ','2013-04-26 13:28:39','2013-04-26 13:28:39',0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `click` int(11) DEFAULT '0',
  `createtime` datetime NOT NULL,
  `updatetime` datetime DEFAULT NULL,
  `showflag` tinyint(1) NOT NULL DEFAULT '0',
  `temp1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES (63,'ガソリン、七週連続値下がり','李咏','lee_young19880910@yahoo.co.jp','198925','全国平均で先週比０．７円安の１５４．１円と七週連続でン値下がりした。',58,'2013-04-24 17:18:35','2013-04-24 17:18:35',1,NULL,NULL,NULL),(64,'アカウントが乗っ取られた','吉野家','yoshinoya@yoshinoya.com','','意味不明の文字をツイッターへ\r\n\r\n',3,'2013-04-24 18:42:24','2013-04-24 18:42:24',0,NULL,NULL,NULL),(65,'見積もり競争支援システム','洋平','youhei@gmail.com','198925','見積もり依頼書をもらいました。\r\n\r\n\r\n------------------------------------------\r\n追伸：\r\n来週まで見積書を出し\r\n\r\n--------------------------------------------\r\n早くしよう\r\n\r\n--------------------------------------------\r\n<a href=\"http://www.yahoo.co.jp\">テスト</a>何とかなる',56,'2013-04-24 18:44:31','2013-04-24 20:59:14',1,NULL,NULL,NULL),(66,'組み込み開発','りえい','','','アンドロイドのソフトウェアを作る。',9,'2013-04-24 18:45:24','2013-04-24 18:45:24',0,NULL,NULL,NULL),(67,'香川、四冠達成','香川真司','','','マンチェスターユナイテッド。四戦を残し、２季ぶりに史上最大２０度目のリーグ優勝を決めた。',2,'2013-04-24 18:49:55','2013-04-24 18:49:55',0,NULL,NULL,NULL),(68,'柏一位で決勝T進出','柏','','','H組の柏はホームの日立サッカー場で貴州と１－１引き分けた。３勝２わけの勝ち点１１として同組一位が確定。',4,'2013-04-24 18:55:25','2013-04-24 18:55:25',0,NULL,NULL,NULL),(69,'test','テスト太郎','','','テストテスト',3,'2013-04-26 13:28:20','2013-04-26 13:28:20',0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-26 15:46:24
