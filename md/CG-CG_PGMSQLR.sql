-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 172.17.0.1    Database: CG
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
-- Table structure for table `CG_PGMSQLR`
--

DROP TABLE IF EXISTS `CG_PGMSQLR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_PGMSQLR` (
  `SQLRSEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SVCSEQ` int(10) unsigned NOT NULL,
  `PJTSEQ` int(11) NOT NULL,
  `PGMSEQ` int(11) NOT NULL,
  `SQLSEQ` int(11) DEFAULT NULL,
  `ORD` int(11) unsigned NOT NULL DEFAULT '0',
  `ADDDT` varchar(14) COLLATE utf8_bin NOT NULL,
  `MODDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `ADDID` int(11) NOT NULL DEFAULT '0',
  `MODID` int(11) DEFAULT NULL,
  PRIMARY KEY (`SQLRSEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=351 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_PGMSQLR`
--

LOCK TABLES `CG_PGMSQLR` WRITE;
/*!40000 ALTER TABLE `CG_PGMSQLR` DISABLE KEYS */;
INSERT INTO `CG_PGMSQLR` VALUES (32,2,3,20,NULL,0,'20141225143502',NULL,0,NULL),(33,2,3,20,NULL,20,'20141225143944','20141225144104',0,NULL),(34,2,3,20,NULL,30,'20141225144053','20141225144104',0,NULL),(35,3,3,20,1,19,'20141225162857','20190630230552',0,NULL),(36,4,3,20,NULL,10,'20141227130852',NULL,0,NULL),(37,4,3,20,NULL,20,'20141227130852',NULL,0,NULL),(38,4,3,20,NULL,30,'20141227130852',NULL,0,NULL),(39,7,3,20,2,10,'20141227131401','20190630230731',0,NULL),(40,7,3,20,3,20,'20141227131401','20190630230731',0,NULL),(41,7,3,20,4,30,'20141227131401','20190630230731',0,NULL),(42,8,3,20,7,30,'20141227131548','20190630230746',0,NULL),(43,8,3,20,6,20,'20141227131548','20190630230746',0,NULL),(44,8,3,20,8,10,'20141227131548','20190630230746',0,NULL),(45,9,3,20,5,10,'20141227131618','20190630230613',0,NULL),(46,10,3,20,9,10,'20141227131655','20190630230634',0,NULL),(47,11,3,20,10,1,'20141227131722','20190630230806',0,NULL),(48,11,3,20,11,2,'20141227131722','20190630230806',0,NULL),(49,11,3,20,12,3,'20141227131722','20190630230806',0,NULL),(50,12,3,20,NULL,10,'20141228202027',NULL,0,NULL),(51,12,3,20,NULL,20,'20141228202027',NULL,0,NULL),(52,12,3,20,NULL,30,'20141228202027',NULL,0,NULL),(53,14,3,20,NULL,1,'20141228204911',NULL,0,NULL),(54,14,3,20,NULL,2,'20141228204911',NULL,0,NULL),(55,14,3,20,NULL,3,'20141228204911',NULL,0,NULL),(56,15,3,20,NULL,1,'20141228205235',NULL,0,NULL),(57,15,3,20,NULL,2,'20141228205235',NULL,0,NULL),(58,15,3,20,NULL,3,'20141228205235',NULL,0,NULL),(59,16,3,20,NULL,0,'20150101204116',NULL,0,NULL),(60,16,3,20,NULL,0,'20150101204116',NULL,0,NULL),(61,16,3,20,NULL,0,'20150101204116',NULL,0,NULL),(62,17,3,20,NULL,10,'20150111154111',NULL,0,NULL),(63,18,3,20,14,10,'20150111155457','20190630230831',0,NULL),(64,18,3,20,15,20,'20150111155458','20190630230831',0,NULL),(65,18,3,20,16,30,'20150111155458','20191214145321',0,NULL),(66,19,3,20,13,10,'20150111160424','20190630230650',0,NULL),(67,20,3,20,NULL,1,'20150111182357',NULL,0,NULL),(68,20,3,20,NULL,2,'20150111182357',NULL,0,NULL),(69,20,3,20,NULL,3,'20150111182357',NULL,0,NULL),(71,21,0,0,NULL,33,'20160111045233','20160330020345',0,NULL),(73,22,0,0,NULL,2,'20160111102445','20160330020339',0,NULL),(74,23,0,0,NULL,1,'20160111123914','20160330015613',0,NULL),(77,24,0,0,NULL,1,'20160111124604','20160330020715',0,NULL),(78,22,0,0,NULL,2,'20160328125247','20160330020339',0,NULL),(79,22,0,0,NULL,1,'20160328125247','20160330020339',0,NULL),(80,25,3,20,25,10,'20160331123741','20190630230707',0,NULL),(81,26,3,8,NULL,10,'20160402134401',NULL,0,NULL),(82,27,3,8,NULL,10,'20160402134647',NULL,0,NULL),(83,28,3,8,NULL,10,'20160402141449',NULL,0,NULL),(84,29,3,8,NULL,10,'20160407044431',NULL,0,NULL),(85,32,3,8,NULL,10,'20160407045548',NULL,0,NULL),(86,33,3,8,NULL,10,'20160421124614',NULL,0,NULL),(87,33,3,8,NULL,20,'20160421124647',NULL,0,NULL),(88,34,3,39,NULL,10,'20171203115320',NULL,0,NULL),(89,35,3,39,NULL,1,'20171204130020','20171204130023',0,NULL),(90,36,3,39,NULL,1,'20171204225106','20171204230813',0,NULL),(91,38,3,38,34,1,'20171205115156','20190809203446',0,NULL),(92,39,3,38,NULL,0,'20171205115246',NULL,0,NULL),(93,40,3,38,NULL,0,'20171205115746','20180104120548',0,NULL),(94,41,3,38,35,1,'20171205120054','20190810154634',0,NULL),(95,42,3,38,38,1,'20171205121453','20190810154810',0,NULL),(96,43,3,38,37,1,'20171206123326','20190810154927',0,NULL),(98,42,3,38,36,2,'20171206222857','20190810154811',0,NULL),(99,44,3,20,39,1,'20171211113046','20190630230902',0,NULL),(100,45,3,20,NULL,10,'20171211113552',NULL,0,NULL),(101,45,3,20,NULL,20,'20171211114202',NULL,0,NULL),(102,46,3,38,NULL,1,'20171214230714',NULL,0,NULL),(103,47,3,38,NULL,1,'20171214230741','20171214230749',0,NULL),(104,47,3,38,NULL,2,'20171214230741','20171214230749',0,NULL),(105,48,3,38,NULL,0,'20171218224517',NULL,0,NULL),(106,48,3,38,NULL,1,'20171219233134',NULL,0,NULL),(107,46,3,38,NULL,2,'20171219233347',NULL,0,NULL),(108,48,3,38,NULL,2,'20171221232346',NULL,0,NULL),(109,49,3,38,NULL,2,'20171228222303',NULL,0,NULL),(110,49,3,38,NULL,1,'20171228222303',NULL,0,NULL),(111,49,3,38,NULL,3,'20171228222304',NULL,0,NULL),(112,50,3,38,NULL,0,'20171228222317',NULL,0,NULL),(113,50,3,38,NULL,0,'20171228222317',NULL,0,NULL),(114,50,3,38,NULL,0,'20171228222318',NULL,0,NULL),(115,51,3,38,NULL,1,'20180108232444',NULL,0,NULL),(116,52,3,20,NULL,1,'20180111233440',NULL,0,NULL),(117,53,3,40,NULL,10,'20180118224751','20180118224758',0,NULL),(118,54,3,40,45,10,'20180118230159','20200214064309',0,NULL),(119,55,3,40,48,10,'20180118232343','20200214064347',0,NULL),(120,56,3,40,49,10,'20180118232408','20200214064400',0,NULL),(121,57,3,40,52,10,'20180121222929','20200214064410',0,NULL),(122,58,3,40,47,10,'20180121231249','20200214064320',0,NULL),(123,59,3,40,45,10,'20180122221830','20200214064255',0,NULL),(124,57,3,40,50,20,'20180123123846','20200214064410',0,NULL),(126,61,3,41,54,10,'20180129095531','20191018152422',0,NULL),(127,61,3,41,53,20,'20180129095531','20191018152422',0,NULL),(128,62,3,41,55,10,'20180129100208','20191018151911',0,NULL),(129,63,3,41,54,1,'20180129101053','20191018151925',0,NULL),(130,63,3,41,53,2,'20180129101053','20191018151926',0,NULL),(131,63,3,41,56,0,'20180129101855','20191018151925',0,NULL),(132,64,3,42,NULL,10,'20180228102655',NULL,0,NULL),(133,65,3,42,57,10,'20180228102716','20191018153138',0,NULL),(135,66,3,43,58,0,'20180228105959','20191029213957',0,NULL),(136,67,3,43,59,10,'20180228110020','20191029214019',0,NULL),(137,68,3,43,60,10,'20180228110444','20191029214029',0,NULL),(138,69,3,43,NULL,10,'20180228110828',NULL,0,NULL),(139,70,3,44,NULL,10,'20180303024059',NULL,0,NULL),(140,71,3,44,NULL,10,'20180303024115',NULL,0,NULL),(141,71,3,44,NULL,20,'20180303024253',NULL,0,NULL),(142,72,3,45,NULL,10,'20180303030409',NULL,0,NULL),(143,73,3,45,NULL,10,'20180303030428',NULL,0,NULL),(144,74,3,45,NULL,0,'20180303030446',NULL,0,NULL),(145,75,3,45,NULL,0,'20180303030841',NULL,0,NULL),(146,76,3,45,NULL,0,'20180303032520',NULL,0,NULL),(147,77,3,45,NULL,0,'20180303032641',NULL,0,NULL),(148,78,3,46,NULL,0,'20180303060730',NULL,0,NULL),(149,79,3,46,NULL,0,'20180303060920',NULL,0,NULL),(150,80,3,46,NULL,0,'20180303061021',NULL,0,NULL),(151,81,3,46,NULL,0,'20180303062124',NULL,0,NULL),(152,82,3,46,NULL,0,'20180303062144',NULL,0,NULL),(153,83,3,46,NULL,0,'20180303062918',NULL,0,NULL),(154,84,3,48,74,0,'20180304230528','20190802210818',0,NULL),(155,85,3,48,75,10,'20180304230546','20190802210838',0,NULL),(156,86,3,49,76,0,'20180304231750','20191018153207',0,NULL),(157,87,3,49,77,10,'20180305095420','20191018153921',0,NULL),(158,88,3,53,NULL,0,'20180305114624',NULL,0,NULL),(159,89,3,43,80,0,'20180305223431','20191029214038',0,NULL),(160,90,3,48,81,0,'20180306225719','20190802210907',0,NULL),(161,91,3,48,NULL,0,'20180307223102',NULL,0,NULL),(162,92,3,49,79,0,'20180307225050','20191018153217',0,NULL),(163,93,3,42,NULL,0,'20180308232134',NULL,0,NULL),(164,94,3,54,NULL,0,'20180312052036',NULL,0,NULL),(165,95,3,54,NULL,0,'20180312053304',NULL,0,NULL),(166,96,3,54,NULL,0,'20180312055119',NULL,0,NULL),(167,97,3,55,NULL,0,'20180318230726',NULL,0,NULL),(168,99,3,55,NULL,0,'20180318231543',NULL,0,NULL),(169,100,3,55,NULL,0,'20180318232309',NULL,0,NULL),(170,90,3,48,82,0,'20180321081724','20190802210907',0,NULL),(171,101,3,56,NULL,0,'20180325151823',NULL,0,NULL),(172,102,3,56,NULL,0,'20180325151835',NULL,0,NULL),(173,105,3,56,NULL,0,'20180325153133',NULL,0,NULL),(174,106,3,56,NULL,0,'20180325153150',NULL,0,NULL),(175,107,3,56,NULL,0,'20180325172548',NULL,0,NULL),(176,108,3,56,NULL,0,'20180325172600',NULL,0,NULL),(177,109,3,4,97,0,'20180325192853','20190610223247',0,NULL),(178,110,3,4,98,0,'20180325192907','20190610223351',0,NULL),(179,112,3,4,99,0,'20180325194236','20190610223300',0,NULL),(180,113,3,4,100,0,'20180325194247','20190610223343',0,NULL),(181,112,3,4,101,0,'20180325195344','20190610223300',0,NULL),(182,113,3,4,102,0,'20180325195354','20190610223343',0,NULL),(183,112,3,4,104,0,'20180325200230','20190610223301',0,NULL),(184,113,3,4,103,0,'20180325200442','20190610223343',0,NULL),(185,114,3,57,105,0,'20180327073133','20191018145005',0,NULL),(186,116,3,57,106,0,'20180327073745','20191018151102',0,NULL),(187,115,3,57,NULL,0,'20180327073925',NULL,0,NULL),(188,116,3,57,108,0,'20180327081833','20191018151102',0,NULL),(189,116,3,57,107,0,'20180329190215','20191018151102',0,NULL),(190,117,3,60,NULL,0,'20180401160052',NULL,0,NULL),(191,118,3,60,NULL,0,'20180401160104',NULL,0,NULL),(192,120,3,60,NULL,0,'20180401161211',NULL,0,NULL),(193,121,3,60,NULL,0,'20180401161223',NULL,0,NULL),(194,121,3,60,NULL,0,'20180401161738',NULL,0,NULL),(195,120,3,60,NULL,0,'20180401161748','20180401161754',0,NULL),(196,120,3,60,NULL,0,'20180401162306','20180401162349',0,NULL),(197,121,3,60,NULL,0,'20180401162357',NULL,0,NULL),(198,122,3,61,117,0,'20180405215443','20191018153347',0,NULL),(199,123,3,61,118,0,'20180405215804','20191018153355',0,NULL),(200,125,3,62,121,0,'20180423151402','20191018152909',0,NULL),(201,126,3,62,120,0,'20180423151413','20191018152852',0,NULL),(202,127,3,62,119,0,'20180423151425','20191018152901',0,NULL),(203,132,3,63,122,0,'20180423153223','20190630231138',0,NULL),(204,136,3,63,124,0,'20180423153313','20190630231157',0,NULL),(205,131,3,63,123,0,'20180427073024','20190630231148',0,NULL),(206,137,3,65,NULL,0,'20180511143834',NULL,0,NULL),(207,138,3,65,NULL,0,'20180511143850',NULL,0,NULL),(208,139,3,65,NULL,0,'20180511143907',NULL,0,NULL),(209,140,3,65,NULL,0,'20180511143923',NULL,0,NULL),(210,141,3,65,NULL,0,'20180511143946',NULL,0,NULL),(211,142,3,65,NULL,0,'20180511143958',NULL,0,NULL),(212,143,3,65,NULL,0,'20180511144014',NULL,0,NULL),(213,145,3,65,NULL,0,'20180511151145',NULL,0,NULL),(214,146,3,66,133,0,'20180515210354','20190719041100',0,NULL),(215,148,3,66,133,0,'20180518083249','20190719042334',0,NULL),(216,149,3,67,NULL,0,'20180528073532',NULL,0,NULL),(217,150,3,67,NULL,0,'20180528073545',NULL,0,NULL),(218,151,3,67,NULL,0,'20180528073556',NULL,0,NULL),(219,152,3,66,133,0,'20180614082543','20190719041130',0,NULL),(220,153,3,66,262,0,'20180614082555','20190719041145',0,NULL),(221,154,3,68,NULL,0,'20180712171934',NULL,0,NULL),(222,155,3,68,NULL,0,'20180712171951',NULL,0,NULL),(223,156,3,68,NULL,1,'20180712172013',NULL,0,NULL),(224,157,3,68,NULL,0,'20180712172034',NULL,0,NULL),(225,158,3,68,NULL,0,'20180712173336','20180712173425',0,NULL),(226,159,3,68,NULL,0,'20180712173412',NULL,0,NULL),(227,160,24,70,NULL,0,'20180716174539',NULL,0,NULL),(228,161,24,70,NULL,0,'20180716174553',NULL,0,NULL),(229,164,24,72,NULL,0,'20180718104705',NULL,0,NULL),(230,166,24,72,NULL,0,'20180718105741',NULL,0,NULL),(231,167,24,70,NULL,0,'20180719095334',NULL,0,NULL),(232,168,24,70,NULL,0,'20180719103633',NULL,0,NULL),(233,169,24,69,153,0,'20180719144546','20190812113158',0,NULL),(234,170,24,69,NULL,0,'20180719144709',NULL,0,NULL),(235,171,24,69,150,0,'20180719154249','20190812113207',0,NULL),(236,172,24,69,151,0,'20180719154525','20190812113215',0,NULL),(237,173,24,69,152,0,'20180719155059','20190812113226',0,NULL),(238,174,24,73,NULL,0,'20180827201100',NULL,0,NULL),(239,175,24,73,252,0,'20180827201100','20190825133447',0,NULL),(240,176,24,73,249,0,'20180827201100','20190825133457',0,NULL),(241,177,24,73,250,0,'20180827201100','20190825133506',0,NULL),(242,178,24,73,251,0,'20180827201100','20190825133517',0,NULL),(243,179,24,75,NULL,0,'20181114075304',NULL,0,NULL),(244,180,24,75,NULL,0,'20181114075304',NULL,0,NULL),(245,181,24,75,NULL,0,'20181114075304',NULL,0,NULL),(246,182,24,75,NULL,0,'20181114075304',NULL,0,NULL),(247,183,24,75,NULL,0,'20181114075305',NULL,0,NULL),(248,184,3,4,NULL,0,'20190527074357',NULL,0,NULL),(249,185,3,4,NULL,0,'20190528041139',NULL,0,NULL),(250,187,3,78,266,0,'20190528215721','20190607212445',0,NULL),(251,188,3,78,268,0,'20190528215721','20190608073049',0,NULL),(252,188,3,78,270,0,'20190528215721','20190608073049',0,NULL),(253,188,3,78,273,0,'20190528215721','20190608073049',0,NULL),(254,189,3,78,267,0,'20190528215721','20190608074217',0,NULL),(255,190,3,78,280,0,'20190528215721','20190610221321',0,NULL),(258,191,3,78,274,0,'20190528215722','20190608073339',0,NULL),(261,194,3,78,280,0,'20190608151201','20190610171958',0,NULL),(262,195,3,78,283,0,'20190610211242',NULL,0,NULL),(263,196,3,79,286,0,'20190615170644',NULL,0,NULL),(264,197,3,79,287,0,'20190615171013',NULL,0,NULL),(266,199,3,79,288,0,'20190615172827',NULL,0,NULL),(267,200,3,79,289,0,'20190625210435',NULL,0,NULL),(268,201,3,79,289,0,'20190625213938',NULL,0,NULL),(269,202,3,79,290,0,'20190625213952','20190625214218',0,NULL),(270,203,3,79,290,0,'20190625214004','20190625214226',0,NULL),(271,44,3,20,40,0,'20190630230902',NULL,0,NULL),(272,207,3,87,266,0,'20190705221251',NULL,0,NULL),(273,208,3,87,268,0,'20190705221251',NULL,0,NULL),(274,208,3,87,270,0,'20190705221251',NULL,0,NULL),(275,208,3,87,273,0,'20190705221251',NULL,0,NULL),(276,209,3,87,283,0,'20190705221252',NULL,0,NULL),(277,210,3,87,267,0,'20190705221254',NULL,0,NULL),(278,211,3,87,280,0,'20190705221254',NULL,0,NULL),(279,212,3,87,274,0,'20190705221258',NULL,0,NULL),(280,213,3,87,280,0,'20190705221259',NULL,0,NULL),(281,215,3,88,338,0,'20190705223205',NULL,0,NULL),(282,216,3,88,334,0,'20190705223205',NULL,0,NULL),(283,216,3,88,344,0,'20190705223205',NULL,0,NULL),(284,216,3,88,332,0,'20190705223205',NULL,0,NULL),(285,217,3,88,329,0,'20190705223206',NULL,0,NULL),(286,218,3,88,335,0,'20190705223208',NULL,0,NULL),(287,219,3,88,339,0,'20190705223208',NULL,0,NULL),(288,220,3,88,336,0,'20190705223212',NULL,0,NULL),(289,221,3,88,339,0,'20190705223212',NULL,0,NULL),(290,90,3,48,90,0,'20190802210920',NULL,0,NULL),(291,222,3,38,43,1,'20190818154822','20190819072910',0,NULL),(292,223,3,96,346,1,'20190829203906',NULL,0,NULL),(293,224,3,96,347,1,'20190829204333',NULL,0,NULL),(294,225,3,96,346,1,'20190829204824',NULL,0,NULL),(295,226,3,95,349,1,'20190829212234',NULL,0,NULL),(296,228,3,95,350,11,'20190829213532',NULL,0,NULL),(297,229,3,93,351,1,'20190902203627',NULL,0,NULL),(298,231,3,93,352,1,'20190902203927',NULL,0,NULL),(299,232,3,90,353,1,'20190902210133',NULL,0,NULL),(300,233,3,90,354,1,'20190902210459',NULL,0,NULL),(301,235,3,94,355,1,'20190902211827',NULL,0,NULL),(302,236,3,94,356,1,'20190902211851',NULL,0,NULL),(303,239,94,97,358,1,'20190902212832',NULL,0,NULL),(304,240,94,97,357,1,'20190902212835',NULL,0,NULL),(305,241,3,98,360,1,'20190902214201',NULL,0,NULL),(306,242,3,98,359,1,'20190902214225','20190902214400',0,NULL),(307,244,3,89,361,1,'20190902215800',NULL,0,NULL),(308,245,3,89,362,1,'20190902215857',NULL,0,NULL),(309,247,3,92,363,1,'20190902222214',NULL,0,NULL),(310,248,3,92,364,1,'20190902222228',NULL,0,NULL),(311,250,3,91,365,1,'20190902223401','20190903072354',0,NULL),(312,251,3,91,364,1,'20190902223420',NULL,0,NULL),(313,253,3,91,366,1,'20190903072345',NULL,0,NULL),(314,254,3,93,367,1,'20190904221016',NULL,0,NULL),(315,256,3,99,369,1,'20190904222142',NULL,0,NULL),(316,257,3,99,368,1,'20190904222145',NULL,0,NULL),(317,258,3,99,370,1,'20190904222145',NULL,0,NULL),(318,259,3,96,371,11,'20190905070711',NULL,0,NULL),(319,260,3,96,372,1,'20190909111141',NULL,0,NULL),(320,259,3,96,372,22,'20190909113110',NULL,0,NULL),(321,254,3,93,373,2,'20190909115841',NULL,0,NULL),(322,261,3,95,374,1,'20190916214917',NULL,0,NULL),(323,261,3,95,375,2,'20190916214917',NULL,0,NULL),(324,262,3,95,376,1,'20190916220222',NULL,0,NULL),(325,263,3,94,377,1,'20190916222228',NULL,0,NULL),(326,263,3,94,378,2,'20190916222228',NULL,0,NULL),(327,264,3,94,379,1,'20190916223812',NULL,0,NULL),(328,265,3,98,382,1,'20190916225417',NULL,0,NULL),(329,265,3,98,381,2,'20190916225417',NULL,0,NULL),(330,266,3,98,380,1,'20190916225434',NULL,0,NULL),(331,268,3,89,384,1,'20190916230857',NULL,0,NULL),(332,268,3,89,383,2,'20190916230857',NULL,0,NULL),(333,269,3,89,385,1,'20190916230914',NULL,0,NULL),(335,270,3,91,388,1,'20190916231808',NULL,0,NULL),(336,271,3,91,386,1,'20190916231828',NULL,0,NULL),(337,271,3,91,387,2,'20190916231828',NULL,0,NULL),(338,272,3,92,389,1,'20190917072404',NULL,0,NULL),(339,273,3,92,390,1,'20190917072427',NULL,0,NULL),(340,273,3,92,391,2,'20190917072427',NULL,0,NULL),(341,61,3,41,56,30,'20191018152422',NULL,0,NULL),(342,275,3,100,392,1,'20191118102733',NULL,0,NULL),(343,277,3,100,393,1,'20191118182028',NULL,0,NULL),(344,279,3,101,395,1,'20191119063715',NULL,0,NULL),(345,280,3,101,394,1,'20191119063715',NULL,0,NULL),(346,281,3,102,396,1,'20200209211448',NULL,0,NULL),(347,282,3,102,397,10,'20200209211505',NULL,0,NULL),(348,283,3,103,398,1,'20200210081519',NULL,0,NULL),(349,284,3,103,399,1,'20200210082305',NULL,0,NULL),(350,58,3,40,46,20,'20200214064331',NULL,0,NULL);
/*!40000 ALTER TABLE `CG_PGMSQLR` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-21 22:55:52
