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
-- Table structure for table `CG_LAYOUTD`
--

DROP TABLE IF EXISTS `CG_LAYOUTD`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_LAYOUTD` (
  `LAYOUTDSEQ` int(11) NOT NULL AUTO_INCREMENT,
  `PJTSEQ` int(11) NOT NULL,
  `LAYOUTID` varchar(3) COLLATE utf8_bin NOT NULL,
  `GRPID` varchar(30) COLLATE utf8_bin NOT NULL,
  `REFGRPID` varchar(30) COLLATE utf8_bin NOT NULL,
  `ORD` int(11) NOT NULL,
  `GRPTYPE` varchar(30) COLLATE utf8_bin NOT NULL,
  `GRPWIDTH` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `GRPHEIGHT` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `VBOX` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `ADDDT` varchar(14) COLLATE utf8_bin NOT NULL,
  `ADDID` int(11) NOT NULL,
  `MODDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `MODID` int(11) DEFAULT NULL,
  PRIMARY KEY (`LAYOUTDSEQ`),
  UNIQUE KEY `PJTSEQ` (`PJTSEQ`,`LAYOUTID`,`GRPID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_LAYOUTD`
--

LOCK TABLES `CG_LAYOUTD` WRITE;
/*!40000 ALTER TABLE `CG_LAYOUTD` DISABLE KEYS */;
INSERT INTO `CG_LAYOUTD` VALUES (1,3,'2A','G1','',10,'CONDITION','100%','100px','NONE','20180104103837',1,'20180401161255',NULL),(2,3,'2A','G2','G1',20,'GRID','100%','300px','NONE','20180104103837',1,'20180401161255',NULL),(3,3,'3B','G1','',10,'CONDITION','100%','80px','NONE','',1,'20180401161305',NULL),(4,3,'3B','G2','G1',20,'GRID','100%','200px','NONE','',1,'20180401161305',NULL),(5,3,'3B','G3','G2',30,'GRID','100%','200px','NONE','',1,'20180401161305',NULL),(6,3,'3C','G1','',10,'CONDITION','100%','80px','NONE','',1,'20180401161312',NULL),(7,3,'3C','G2','G1',20,'GRID','50%','200px','NONE','',1,'20180401161312',NULL),(8,3,'3C','G3','G2',30,'GRID','50%','200px','NONE','',1,'20180401161312',NULL),(10,3,'4D','G1','',10,'CONDITION','100%','80px','NONE','',1,'20180401161320',NULL),(11,3,'4D','G2','G1',20,'GRID','100%','100px','NONE','',1,'20180401161320',NULL),(12,3,'4D','G3','G2',30,'GRID','100%','100px','NONE','',1,'20180401161320',NULL),(13,3,'4D','G4','G3',40,'GRID','100%','100px','NONE','',1,'20180401161320',NULL),(15,3,'4E','G1','',10,'CONDITION','100%','100px','NONE','',1,'20180401161327',NULL),(16,3,'4E','G2','G1',20,'GRID','33%','300px','NONE','',1,'20180401161327',NULL),(17,3,'4E','G3','G2',30,'GRID','33%','300px','NONE','',1,'20180401161327',NULL),(18,3,'4E','G4','G3',40,'GRID','34%','300px','NONE','',1,'20180401161327',NULL),(20,3,'4F','G1','',10,'CONDITION','100%','100px','NONE','',1,'20180401161334',NULL),(21,3,'4F','G2','G1',20,'GRID','50%','100px','NONE','',1,'20180401161334',NULL),(22,3,'4F','G3','G2',30,'GRID','50%','100px','NONE','',1,'20180401161334',NULL),(23,3,'4F','G4','G3',40,'GRID','100%','200px','NONE','',1,'20180401161334',NULL),(25,3,'4G','G1','',10,'CONDITION','100%','100px','NONE','20140804214338',1,'20180401161341',NULL),(26,3,'4G','G2','G1',20,'GRID','100%','200px','NONE','20140804214502',1,'20180401161341',NULL),(27,3,'4G','G3','G2',30,'GRID','50%','100px','NONE','20140804214502',1,'20180401161341',NULL),(28,3,'4G','G4','G3',40,'GRID','50%','100px','NONE','20140804214502',1,'20180401161341',NULL),(30,3,'4H','G1','',10,'CONDITION','100%','100px','NONE','20140804214703',1,'20180401161349',NULL),(31,3,'4H','G2','G1',20,'GRID','50%','150px','START','20140804214703',1,'20180401161349',NULL),(32,3,'4H','G3','G2',30,'GRID','50%','150px','END','20140804214703',1,'20180401161349',NULL),(33,3,'4H','G4','G3',40,'GRID','50%','300px','NONE','20140804214703',1,'20180401161349',NULL),(35,3,'4I','G1','',10,'CONDITION','100%','150px','NONE','20140804214859',1,'20180401161359',NULL),(36,3,'4I','G2','G1',20,'GRID','50%','100px','NONE','20140804214859',1,'20180401161359',NULL),(37,3,'4I','G3','G2',30,'GRID','50%','300px','START','20140804214859',1,'20180401161359',NULL),(38,3,'4I','G4','G3',40,'GRID','50%','150px','END','20140804214859',1,'20180401161359',NULL);
/*!40000 ALTER TABLE `CG_LAYOUTD` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-27  7:37:55
