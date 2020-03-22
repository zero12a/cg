-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 172.17.0.1    Database: CGPJT1
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
-- Table structure for table `CG_PGMEVT`
--

DROP TABLE IF EXISTS `CG_PGMEVT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_PGMEVT` (
  `PJTSEQ` int(11) NOT NULL,
  `PGMSEQ` int(11) NOT NULL,
  `GRPSEQ` int(11) NOT NULL,
  `EVTSEQ` int(11) NOT NULL AUTO_INCREMENT,
  `EVTCD` varchar(50) NOT NULL,
  `EVTNM` varchar(200) NOT NULL,
  `EVTORD` int(11) NOT NULL,
  `EVTSRC` varchar(1000) NOT NULL,
  `USEYN` varchar(1) NOT NULL DEFAULT 'Y',
  `ADDID` int(11) NOT NULL,
  `ADDDT` varchar(14) NOT NULL,
  `MODID` int(11) DEFAULT NULL,
  `MODDT` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`EVTSEQ`),
  UNIQUE KEY `IDX_PGMEVT_EVTIDUNIQUE` (`PJTSEQ`,`PGMSEQ`,`GRPSEQ`,`EVTCD`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_PGMEVT`
--

LOCK TABLES `CG_PGMEVT` WRITE;
/*!40000 ALTER TABLE `CG_PGMEVT` DISABLE KEYS */;
INSERT INTO `CG_PGMEVT` VALUES (3,100,248,16,'ROWCLICK','1',3,'2','Y',1,'20200227070628',1,'20200227072200'),(3,105,268,18,'ROWCLICK','클릭',1,'alert(\"OKOK G2\")','Y',1,'20200312065147',1,'20200313032850'),(3,105,269,19,'ROWCLICK','click',1,'alert(\"OKOK G3\")','Y',1,'20200313032823',NULL,NULL),(3,105,270,20,'ROWCLICK','click',1,'alert(\"OKOK G4\")','Y',1,'20200313032842',NULL,NULL),(3,105,271,21,'ROWCLICK','click',1,'alert(\"OKOK G5\")','Y',1,'20200313032909',NULL,NULL),(3,105,272,22,'GRPCLICK','test',1,'alert(\"그룹영역 클릭\");\n','Y',1,'20200313042622',NULL,NULL),(3,105,272,23,'OBJCLICK','test',2,'alert(\"오브젝트 영역 클릭\");\n','Y',1,'20200313042622',NULL,NULL);
/*!40000 ALTER TABLE `CG_PGMEVT` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-21 22:40:09
