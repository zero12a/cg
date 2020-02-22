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
-- Table structure for table `CG_PGMSVC`
--

DROP TABLE IF EXISTS `CG_PGMSVC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_PGMSVC` (
  `SVCSEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PJTSEQ` int(11) NOT NULL,
  `PGMSEQ` int(11) NOT NULL,
  `GRPSEQ` int(11) NOT NULL,
  `FNCSEQ` int(11) NOT NULL,
  `SVCGRPID` varchar(30) COLLATE utf8_bin NOT NULL,
  `ADDDT` varchar(30) COLLATE utf8_bin NOT NULL,
  `ORD` int(10) unsigned DEFAULT '10',
  `MODDT` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `ADDID` int(11) NOT NULL DEFAULT '0',
  `MODID` int(11) DEFAULT NULL,
  PRIMARY KEY (`SVCSEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=285 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_PGMSVC`
--

LOCK TABLES `CG_PGMSVC` WRITE;
/*!40000 ALTER TABLE `CG_PGMSVC` DISABLE KEYS */;
INSERT INTO `CG_PGMSVC` VALUES (3,3,20,11,1,'G3','20141225143543',30,NULL,0,NULL),(7,3,20,11,2,'G3','20141227131341',10,'20141227132247',0,NULL),(8,3,20,12,9,'G4','20141227131518',10,NULL,0,NULL),(9,3,20,12,8,'G4','20141227131603',10,NULL,0,NULL),(10,3,20,13,14,'G5','20141227131628',10,NULL,0,NULL),(11,3,20,13,15,'G5','20141227131707',10,NULL,0,NULL),(14,3,20,9,20,'G4','20141228204847',10,NULL,0,NULL),(15,3,20,9,20,'G5','20141228205206',20,NULL,0,NULL),(16,3,20,9,20,'G3','20150101204050',5,NULL,0,NULL),(17,0,0,0,0,'G6','20150111154101',10,NULL,0,NULL),(18,3,20,14,27,'G6','20150111155433',10,NULL,0,NULL),(19,3,20,14,26,'G6','20150111160417',10,NULL,0,NULL),(20,3,20,9,20,'G6','20150111182333',30,NULL,0,NULL),(21,0,0,0,0,'G3','20151011131006',1,'20160111101421',0,NULL),(22,0,0,0,0,'G2','20160111102433',2,NULL,0,NULL),(23,0,0,0,0,'G3','20160111123854',10,NULL,0,NULL),(24,0,0,0,0,'G2','20160111124554',20,NULL,0,NULL),(25,3,20,15,46,'G7','20160331123733',10,NULL,0,NULL),(26,3,8,3,53,'G3','20160402134344',10,NULL,0,NULL),(27,3,8,1,68,'G3','20160402134631',10,NULL,0,NULL),(28,3,8,1,0,'G3','20160402141441',0,NULL,0,NULL),(29,3,8,4,1,'G4','20160407044311',1,NULL,0,NULL),(30,3,8,4,1,'G4','20160407045244',1,NULL,0,NULL),(31,3,8,4,1,'G4','20160407045311',1,NULL,0,NULL),(32,3,8,4,59,'G4','20160407045521',10,NULL,0,NULL),(33,3,8,3,54,'G3','20160421124601',10,NULL,0,NULL),(34,3,39,44,110,'GRID1','20171203115311',10,'20171204131305',0,NULL),(35,3,39,48,120,'G3','20171204130007',1,'20171204133807',0,NULL),(36,3,39,48,134,'G3','20171204225051',1,NULL,0,NULL),(38,3,38,51,148,'G3','20171205114915',1,NULL,0,NULL),(40,3,38,50,158,'G3','20171205115740',1,NULL,0,NULL),(41,3,38,52,159,'F4','20171205120012',1,NULL,0,NULL),(42,3,38,52,160,'F4','20171205121440',1,NULL,0,NULL),(43,3,38,52,163,'F4','20171206123319',1,NULL,0,NULL),(44,3,20,15,47,'G7','20171211113032',1,NULL,0,NULL),(45,3,20,9,20,'G7','20171211113537',40,NULL,0,NULL),(46,3,38,49,154,'G3','20171214230505',1,NULL,0,NULL),(47,3,38,49,154,'F4','20171214230505',2,NULL,0,NULL),(48,3,38,51,149,'G3','20171218224444',1,NULL,0,NULL),(49,3,38,50,165,'G3','20171228222235',2,NULL,0,NULL),(50,3,38,50,165,'F4','20171228222235',1,NULL,0,NULL),(51,3,38,51,167,'G3','20180108232358',1,NULL,0,NULL),(52,3,20,10,7,'G2','20180111233413',1,NULL,0,NULL),(53,3,40,58,196,'G2','20180118224747',10,NULL,0,NULL),(54,3,40,59,179,'G2','20180118230151',10,NULL,0,NULL),(55,3,40,61,200,'G3','20180118232331',10,NULL,0,NULL),(56,3,40,62,209,'G4','20180118232359',10,NULL,0,NULL),(57,3,40,62,210,'G4','20180121222915',10,NULL,0,NULL),(58,3,40,59,180,'G2','20180121231238',10,NULL,0,NULL),(59,3,40,59,178,'G2','20180122221811',10,NULL,0,NULL),(60,3,41,63,228,'G2','20180129095455',10,NULL,0,NULL),(61,3,41,63,229,'G2','20180129095520',10,NULL,0,NULL),(62,3,41,64,231,'G2','20180129100201',10,NULL,0,NULL),(63,3,41,64,232,'G2','20180129101044',10,NULL,0,NULL),(64,3,42,66,262,'G2','20180228102648',10,NULL,0,NULL),(65,3,42,67,265,'G2','20180228102708',10,NULL,0,NULL),(66,3,43,69,274,'G2','20180228105945',10,NULL,0,NULL),(67,3,43,69,275,'G2','20180228110012',10,NULL,0,NULL),(68,3,43,69,288,'G2','20180228110121',10,NULL,0,NULL),(69,3,43,68,271,'G2','20180228110816',10,NULL,0,NULL),(70,3,44,72,289,'G2','20180303024049',10,NULL,0,NULL),(71,3,44,72,290,'G2','20180303024107',10,NULL,0,NULL),(72,3,45,75,312,'G2','20180303030401',10,NULL,0,NULL),(73,3,45,76,320,'G3','20180303030421',10,NULL,0,NULL),(74,3,45,77,328,'G4','20180303030441',10,NULL,0,NULL),(75,3,45,74,309,'G2','20180303030836',10,NULL,0,NULL),(76,3,45,77,335,'G4','20180303032509',10,NULL,0,NULL),(77,3,45,76,327,'G3','20180303032636',10,NULL,0,NULL),(78,3,46,81,355,'G4','20180303060725',10,NULL,0,NULL),(79,3,46,78,336,'G2','20180303060912',0,NULL,0,NULL),(80,3,46,79,339,'G2','20180303061016',10,NULL,0,NULL),(81,3,46,80,354,'G3','20180303062111',0,NULL,0,NULL),(82,3,46,81,362,'G4','20180303062134',0,NULL,0,NULL),(83,3,46,80,347,'G3','20180303062856',0,NULL,0,NULL),(84,3,48,83,366,'G2','20180304230523',10,NULL,0,NULL),(85,3,48,84,374,'G3','20180304230539',10,NULL,0,NULL),(86,3,49,86,385,'G2','20180304231746',0,'20180304232411',0,NULL),(87,3,49,86,392,'G2','20180305095413',10,NULL,0,NULL),(88,3,53,89,406,'G2','20180305114620',0,NULL,0,NULL),(89,3,43,70,282,'G3','20180305223351',0,NULL,0,NULL),(90,3,48,84,375,'G3','20180306225715',0,NULL,0,NULL),(91,3,48,84,381,'G3','20180307223057',0,NULL,0,NULL),(92,3,49,86,386,'G2','20180307225042',0,NULL,0,NULL),(93,3,42,67,415,'G2','20180308232129',0,NULL,0,NULL),(94,3,54,91,420,'G2','20180312052032',0,NULL,0,NULL),(95,3,54,92,429,'G3','20180312053258',0,NULL,0,NULL),(96,3,54,90,417,'G2','20180312054720',0,NULL,0,NULL),(97,3,55,94,435,'G2','20180318230723',0,NULL,0,NULL),(98,3,55,93,459,'G2','20180318230734',0,NULL,0,NULL),(99,3,55,95,444,'G3','20180318231536',0,NULL,0,NULL),(100,3,55,96,453,'G4','20180318232302',0,NULL,0,NULL),(101,3,56,98,462,'G2','20180325151818',0,NULL,0,NULL),(102,3,56,99,471,'G3','20180325151830',0,NULL,0,NULL),(103,3,56,97,480,'G3','20180325151936',0,NULL,0,NULL),(104,3,56,97,480,'G2','20180325151936',0,NULL,0,NULL),(105,3,56,98,470,'G2','20180325153124',0,NULL,0,NULL),(106,3,56,99,479,'G3','20180325153143',0,NULL,0,NULL),(107,3,56,100,492,'G4','20180325172541',0,NULL,0,NULL),(108,3,56,100,500,'G4','20180325172554',0,NULL,0,NULL),(109,3,4,114,502,'G2','20180325192849',0,NULL,0,NULL),(110,3,4,115,514,'G3','20180325192902',0,NULL,0,NULL),(111,3,4,113,511,'G2','20180325192916',0,NULL,0,NULL),(112,3,4,114,503,'G2','20180325194226',0,NULL,0,NULL),(113,3,4,115,515,'G3','20180325194242',0,NULL,0,NULL),(114,3,57,117,526,'G2','20180327073128',0,NULL,0,NULL),(115,3,57,116,523,'G2','20180327073518',0,NULL,0,NULL),(116,3,57,117,527,'G2','20180327073741',0,NULL,0,NULL),(117,3,60,131,562,'G2','20180401160045',0,NULL,0,NULL),(118,3,60,132,571,'G3','20180401160058',0,NULL,0,NULL),(119,3,60,130,580,'G2','20180401160113',0,NULL,0,NULL),(120,3,60,131,563,'G2','20180401161202',0,NULL,0,NULL),(121,3,60,132,572,'G3','20180401161217',0,NULL,0,NULL),(122,3,61,134,583,'G2','20180405215439',0,NULL,0,NULL),(123,3,61,135,592,'G3','20180405215757',0,NULL,0,NULL),(124,3,61,133,601,'G1','20180405215846',0,NULL,0,NULL),(125,3,62,137,607,'G2','20180423151352',0,NULL,0,NULL),(126,3,62,138,616,'G3','20180423151408',0,NULL,0,NULL),(127,3,62,139,625,'G4','20180423151420',0,NULL,0,NULL),(128,3,62,136,604,'G2','20180423151431',0,NULL,0,NULL),(131,3,63,142,640,'G3','20180423153206',0,NULL,0,NULL),(132,3,63,141,631,'G2','20180423153218',0,NULL,0,NULL),(133,3,63,140,658,'G4','20180423153245',0,NULL,0,NULL),(134,3,63,140,658,'G3','20180423153245',0,NULL,0,NULL),(135,3,63,140,658,'G2','20180423153245',0,NULL,0,NULL),(136,3,63,143,649,'G4','20180423153308',0,NULL,0,NULL),(137,3,65,145,662,'G2','20180511143829',0,NULL,0,NULL),(138,3,65,145,661,'G2','20180511143843',0,NULL,0,NULL),(139,3,65,150,667,'G8','20180511143902',0,NULL,0,NULL),(140,3,65,146,676,'G3','20180511143914',0,NULL,0,NULL),(141,3,65,147,685,'G4','20180511143933',0,NULL,0,NULL),(142,3,65,148,694,'G6','20180511143953',0,NULL,0,NULL),(143,3,65,149,703,'G7','20180511144007',0,NULL,0,NULL),(144,3,65,144,712,'G2','20180511144436',0,NULL,0,NULL),(145,3,65,151,715,'G9','20180511151136',0,NULL,0,NULL),(146,3,66,153,724,'G2','20180515210351',0,NULL,0,NULL),(147,3,66,152,725,'G2','20180515214133',0,NULL,0,NULL),(148,3,66,154,728,'G3','20180518083244',10,NULL,0,NULL),(149,3,67,156,729,'G2','20180528073521',0,NULL,0,NULL),(150,3,67,157,738,'G3','20180528073537',0,NULL,0,NULL),(151,3,67,158,747,'G4','20180528073550',0,NULL,0,NULL),(152,3,66,160,768,'G4','20180614082536',0,NULL,0,NULL),(153,3,66,159,759,'G5','20180614082548',0,NULL,0,NULL),(154,3,68,163,774,'G2','20180712171925',1,NULL,0,NULL),(155,3,68,164,783,'G3','20180712171945',0,NULL,0,NULL),(156,3,68,165,792,'G4','20180712172006',1,NULL,0,NULL),(157,3,68,161,801,'G5','20180712172027',1,NULL,0,NULL),(158,3,68,164,784,'G3','20180712173325',0,'20180712173420',0,NULL),(159,3,68,163,775,'G2','20180712173406',0,NULL,0,NULL),(160,24,70,172,825,'G2','20180716174534',0,NULL,0,NULL),(161,24,70,173,834,'G3','20180716174548',0,NULL,0,NULL),(162,24,70,173,834,'','20180716174548',0,NULL,0,NULL),(163,24,70,171,843,'G2','20180716174709',0,NULL,0,NULL),(164,24,72,175,849,'G2','20180718104659',0,NULL,0,NULL),(165,24,72,174,846,'G2','20180718104749',0,NULL,0,NULL),(166,24,72,175,850,'G2','20180718105736',0,NULL,0,NULL),(167,24,70,172,833,'G2','20180719095327',0,NULL,0,NULL),(168,24,70,172,826,'G2','20180719103625',0,NULL,0,NULL),(169,24,69,177,858,'G2','20180719144543',0,NULL,0,NULL),(170,24,69,176,877,'G2','20180719144705',0,NULL,0,NULL),(171,24,69,178,859,'G3','20180719154238',0,'20180719154245',0,NULL),(172,24,69,179,868,'G4','20180719154521',0,NULL,0,NULL),(173,24,69,180,880,'G5','20180719155055',0,NULL,0,NULL),(174,24,73,181,890,'G2','20180827201059',0,NULL,0,NULL),(175,24,73,182,891,'G2','20180827201100',0,NULL,0,NULL),(176,24,73,183,892,'G3','20180827201100',0,NULL,0,NULL),(177,24,73,184,894,'G4','20180827201100',0,NULL,0,NULL),(178,24,73,185,897,'G5','20180827201100',0,NULL,0,NULL),(179,24,75,186,911,'G2','20181114075304',0,NULL,0,NULL),(180,24,75,187,912,'G2','20181114075304',0,NULL,0,NULL),(181,24,75,188,913,'G3','20181114075304',0,NULL,0,NULL),(182,24,75,189,916,'G4','20181114075304',0,NULL,0,NULL),(183,24,75,190,919,'G5','20181114075305',0,NULL,0,NULL),(184,3,4,191,927,'G4','20190527074241',0,'20190527074246',0,NULL),(185,3,4,191,928,'G4','20190528041130',0,NULL,0,NULL),(186,3,78,192,933,'G2','20190528215721',0,NULL,0,NULL),(187,3,78,193,936,'G2','20190528215721',0,NULL,0,NULL),(188,3,78,193,937,'G2','20190528215721',0,NULL,0,NULL),(189,3,78,194,945,'G3','20190528215721',0,NULL,0,NULL),(190,3,78,194,946,'G4','20190528215721',0,'20190610221244',0,NULL),(191,3,78,195,955,'G4','20190528215722',0,NULL,0,NULL),(194,3,78,195,961,'G4','20190608150923',0,NULL,0,NULL),(195,3,78,193,944,'G2','20190610211231',0,NULL,0,NULL),(196,3,79,197,968,'G2','20190615170640',0,NULL,0,NULL),(197,3,79,198,980,'G3','20190615171000',0,NULL,0,NULL),(198,3,79,196,964,'G2','20190615171055',0,NULL,0,NULL),(199,3,79,198,979,'G3','20190615172821',0,NULL,0,NULL),(200,3,79,199,1002,'G4','20190625210426',0,NULL,0,NULL),(201,3,79,201,1004,'G5','20190625213930',0,NULL,0,NULL),(202,3,79,200,1005,'G6','20190625213947',0,NULL,0,NULL),(203,3,79,202,1003,'G7','20190625214000',0,NULL,0,NULL),(204,3,86,203,1006,'G2','20190705221151',0,NULL,0,NULL),(205,3,86,204,1009,'G2','20190705221152',0,NULL,0,NULL),(206,3,87,205,1010,'G2','20190705221249',0,NULL,0,NULL),(207,3,87,206,1013,'G2','20190705221251',0,NULL,0,NULL),(208,3,87,206,1014,'G2','20190705221251',0,NULL,0,NULL),(209,3,87,206,1019,'G2','20190705221251',0,NULL,0,NULL),(210,3,87,207,1021,'G3','20190705221254',0,NULL,0,NULL),(211,3,87,207,1022,'G4','20190705221254',0,NULL,0,NULL),(212,3,87,208,1031,'G4','20190705221258',0,NULL,0,NULL),(213,3,87,208,1036,'G4','20190705221258',0,NULL,0,NULL),(214,3,88,209,1037,'G2','20190705223204',0,NULL,0,NULL),(215,3,88,210,1040,'G2','20190705223205',0,NULL,0,NULL),(216,3,88,210,1041,'G2','20190705223205',0,NULL,0,NULL),(217,3,88,210,1046,'G2','20190705223205',0,NULL,0,NULL),(218,3,88,211,1048,'G3','20190705223208',0,NULL,0,NULL),(219,3,88,211,1049,'G4','20190705223208',0,NULL,0,NULL),(220,3,88,212,1058,'G4','20190705223212',0,NULL,0,NULL),(221,3,88,212,1063,'G4','20190705223212',0,NULL,0,NULL),(222,3,38,51,1065,'G3','20190818154803',1,'20190819071827',0,NULL),(223,3,96,214,1074,'G2','20190829203900',1,NULL,0,NULL),(224,3,96,216,1077,'G3','20190829204325',1,NULL,0,NULL),(225,3,96,215,1069,'G2','20190829204814',1,NULL,0,NULL),(226,3,95,218,1080,'G2','20190829212223',1,NULL,0,NULL),(227,3,95,217,1085,'G2','20190829212254',1,NULL,0,NULL),(228,3,95,219,1088,'G3','20190829213524',1,NULL,0,NULL),(229,3,93,221,1095,'G2','20190902203619',10,NULL,0,NULL),(230,3,93,220,1091,'G2','20190902203638',1,NULL,0,NULL),(231,3,93,222,1100,'G3','20190902203921',1,NULL,0,NULL),(232,3,90,224,1107,'G2','20190902210124',1,NULL,0,NULL),(233,3,90,225,1112,'G3','20190902210452',1,NULL,0,NULL),(234,3,90,223,1119,'G2','20190902210513',1,NULL,0,NULL),(235,3,94,227,1123,'G2','20190902211821',10,NULL,0,NULL),(236,3,94,228,1128,'G3','20190902211845',1,NULL,0,NULL),(237,3,94,226,1135,'G2','20190902211949',1,NULL,0,NULL),(238,94,97,229,1139,'G2','20190902212831',1,NULL,0,NULL),(239,94,97,230,1143,'G2','20190902212832',10,NULL,0,NULL),(240,94,97,231,1148,'G3','20190902212835',1,NULL,0,NULL),(241,3,98,234,1164,'G3','20190902214155',1,NULL,0,NULL),(242,3,98,233,1155,'G2','20190902214218',1,NULL,0,NULL),(243,3,98,232,1160,'G2','20190902214237',1,NULL,0,NULL),(244,3,89,236,1171,'G2','20190902215755',1,NULL,0,NULL),(245,3,89,237,1176,'G3','20190902215852',1,NULL,0,NULL),(246,3,89,235,1183,'G2','20190902220125',1,NULL,0,NULL),(247,3,92,239,1187,'G2','20190902222209',1,NULL,0,NULL),(248,3,92,240,1192,'G3','20190902222223',1,NULL,0,NULL),(249,3,92,238,1199,'G2','20190902222240',1,NULL,0,NULL),(250,3,91,242,1203,'G2','20190902223352',1,NULL,0,NULL),(252,3,91,241,1215,'G2','20190902223727',1,NULL,0,NULL),(253,3,91,243,1208,'G3','20190902224040',2,NULL,0,NULL),(254,3,93,222,1101,'G3','20190904221010',1,NULL,0,NULL),(255,3,99,244,1219,'G2','20190904222142',1,NULL,0,NULL),(256,3,99,245,1223,'G2','20190904222142',10,NULL,0,NULL),(257,3,99,246,1228,'G3','20190904222145',1,NULL,0,NULL),(258,3,99,246,1229,'G3','20190904222145',1,NULL,0,NULL),(259,3,96,216,1235,'G3','20190905070704',1,NULL,0,NULL),(260,3,96,216,1236,'G3','20190909111134',1,NULL,0,NULL),(261,3,95,219,1237,'G3','20190916214909',0,NULL,0,NULL),(262,3,95,219,1240,'G3','20190916220216',3,NULL,0,NULL),(263,3,94,228,1129,'G3','20190916222219',1,NULL,0,NULL),(264,3,94,228,1133,'G3','20190916223806',1,NULL,0,NULL),(265,3,98,234,1165,'G3','20190916225408',1,NULL,0,NULL),(266,3,98,234,1169,'G3','20190916225427',1,NULL,0,NULL),(268,3,89,237,1177,'G3','20190916230848',1,NULL,0,NULL),(269,3,89,237,1181,'G3','20190916230907',1,NULL,0,NULL),(270,3,91,243,1213,'G3','20190916231802',1,NULL,0,NULL),(271,3,91,243,1209,'G3','20190916231819',1,NULL,0,NULL),(272,3,92,240,1197,'G3','20190917072356',1,NULL,0,NULL),(273,3,92,240,1193,'G3','20190917072417',1,NULL,0,NULL),(274,3,49,85,382,'G2','20191018153821',1,NULL,0,NULL),(275,3,100,248,1246,'G2','20191118102727',1,NULL,0,NULL),(276,3,100,247,1242,'G2','20191118102745',1,NULL,0,NULL),(277,3,100,249,1257,'G3','20191118182021',1,NULL,0,NULL),(278,3,101,250,1260,'G2','20191119063715',1,NULL,0,NULL),(279,3,101,251,1262,'G2','20191119063715',1,NULL,0,NULL),(280,3,101,252,1264,'G3','20191119063715',1,NULL,0,NULL),(281,3,102,256,1267,'G2','20200209211437',1,NULL,0,NULL),(282,3,102,257,1278,'G3','20200209211500',10,NULL,0,NULL),(283,3,103,259,1293,'G2','20200210081514',10,NULL,0,NULL),(284,3,103,260,1308,'G3','20200210082259',10,NULL,0,NULL);
/*!40000 ALTER TABLE `CG_PGMSVC` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-22 17:45:14
