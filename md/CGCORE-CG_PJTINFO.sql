-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 172.17.0.1    Database: CGCORE
-- ------------------------------------------------------
-- Server version	5.7.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `CG_PJTINFO`
--

DROP TABLE IF EXISTS `CG_PJTINFO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_PJTINFO` (
  `PJTSEQ` int(11) NOT NULL AUTO_INCREMENT,
  `PJTID` varchar(20) COLLATE utf8_bin NOT NULL,
  `PJTNM` varchar(200) COLLATE utf8_bin NOT NULL,
  `DELYN` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'N',
  `FILECHARSET` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT 'UTF-8',
  `STARTDT` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `ENDDT` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `UITOOL` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'DHTMLX',
  `SVRLANG` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'PHP',
  `DEPLOYKEY` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '배포 키',
  `PKGROOT` varchar(200) COLLATE utf8_bin NOT NULL,
  `DSNM` varchar(30) COLLATE utf8_bin DEFAULT NULL COMMENT '데이터소스 네임',
  `ADDDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `ADDID` int(11) NOT NULL,
  `MODDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `MODID` int(11) DEFAULT NULL,
  PRIMARY KEY (`PJTSEQ`),
  UNIQUE KEY `IDX_PJTSEQ` (`PJTSEQ`),
  UNIQUE KEY `PJTID` (`PJTID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_PJTINFO`
--

LOCK TABLES `CG_PJTINFO` WRITE;
/*!40000 ALTER TABLE `CG_PJTINFO` DISABLE KEYS */;
INSERT INTO `CG_PJTINFO` VALUES (1,'AA1','AA1','Y','','','','DHTMLX','PHP','','',NULL,'20150111182454',0,'20150111192931',NULL),(2,'AA2','AA2','Y','AA2',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150111182550',0,NULL,NULL),(3,'CG','CodePhp','N','UTF-8','','','DHTMLX','PHP','MyLoveKim','com.ssg.cg','CGPJT1','20151030222446',0,'20180530074608',1),(4,'CG2','CodeJava','N','UTF-8',NULL,NULL,'DHTMLX','JAVA','','',NULL,'20151030210952',0,'20160330100622',NULL),(5,'CodeGen','코드제너레이션','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,NULL,0,NULL,NULL),(6,'CodeGen4','33334444','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20140621',0,'20140622105246',NULL),(7,'ERER','ERER','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101213022',0,NULL,NULL),(8,'GG','GG','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101182902',0,NULL,NULL),(9,'GGG','GGG','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101182959',0,NULL,NULL),(10,'HH','HH','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101183045',0,NULL,NULL),(11,'MM','MM','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101184015',0,NULL,NULL),(12,'QQQ','QQQ','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101213924',0,NULL,NULL),(13,'TEST','TESTSDFSF','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20141209214227',0,NULL,NULL),(14,'WWW','WWW','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101213539',0,NULL,NULL),(15,'ccc','ccc','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101214732',0,NULL,NULL),(16,'eee','ee','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101163304',0,NULL,NULL),(17,'ggbb','bb','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101184338',0,NULL,NULL),(18,'jj','jj','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101183437',0,NULL,NULL),(19,'kk','kk','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101183335',0,NULL,NULL),(20,'r','r','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101184154',0,NULL,NULL),(21,'vv','vv','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101184423',0,NULL,NULL),(22,'www','www','Y','UTF-8',NULL,NULL,'DHTMLX','PHP','','',NULL,'20150101193004',0,NULL,NULL),(23,'AAA','BBBd99','N','CCC','20160301','20160331','DDD','EEE','','',NULL,'20160331122532',0,'20200308213557',1),(24,'SC','SecureCoding','N','UTF-8','20180712','20181110','DHTMLX','PHP','MyLoveSC','com.ssg.sc',NULL,'20180712154753',1,NULL,NULL),(25,'?','?','Y','?','?','?','?','?','?','?',NULL,'20190611215735',0,NULL,NULL),(29,'111','?','Y','?','?','?','?','?','?','?',NULL,'20190611215933',1,NULL,NULL),(30,'22','?','Y','?','?','?','?','?','?','?',NULL,'20190611215950',3,NULL,NULL),(32,'333','?','Y','?','?','?','?','?','?','?',NULL,'20190611221113',0,NULL,NULL),(33,'3334','?','Y','?','?','?','?','?','?','?',NULL,'20190611221117',0,NULL,NULL),(35,'33346','?','Y','?','?','?','?','?','?','?',NULL,'20190611221214',0,NULL,NULL),(37,'333461','?','Y','?','?','?','?','?','?','?',NULL,'20190611221247',0,NULL,NULL);
/*!40000 ALTER TABLE `CG_PJTINFO` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-08 23:21:27
