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
-- Table structure for table `CG_LAYOUT`
--

DROP TABLE IF EXISTS `CG_LAYOUT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_LAYOUT` (
  `PJTSEQ` int(11) NOT NULL,
  `LAYOUTID` varchar(3) COLLATE utf8_bin NOT NULL,
  `GRPCNT` int(11) NOT NULL,
  `USEYN` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'Y',
  `ADDDT` varchar(14) COLLATE utf8_bin NOT NULL,
  `ADDID` int(11) NOT NULL,
  `MODDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `MODID` int(11) DEFAULT NULL,
  PRIMARY KEY (`PJTSEQ`,`LAYOUTID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_LAYOUT`
--

LOCK TABLES `CG_LAYOUT` WRITE;
/*!40000 ALTER TABLE `CG_LAYOUT` DISABLE KEYS */;
INSERT INTO `CG_LAYOUT` VALUES (3,'2A',2,'Y','',0,NULL,NULL),(3,'3B',3,'Y','',0,NULL,NULL),(3,'3C',3,'Y','',0,NULL,NULL),(3,'4D',4,'Y','',0,NULL,NULL),(3,'4E',4,'Y','',0,NULL,NULL),(3,'4F',4,'Y','',0,NULL,NULL),(3,'4G',4,'Y','',0,NULL,NULL),(3,'4H',4,'Y','',0,NULL,NULL),(3,'4I',4,'Y','',0,NULL,NULL);
/*!40000 ALTER TABLE `CG_LAYOUT` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-02 23:34:48
