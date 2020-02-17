-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 172.17.0.1    Database: OS
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
-- Table structure for table `CMN_IP`
--

DROP TABLE IF EXISTS `CMN_IP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CMN_IP` (
  `IP_SEQ` int(11) NOT NULL AUTO_INCREMENT,
  `PGMTYPE` varchar(20) CHARACTER SET utf8 NOT NULL,
  `ALLOW_IP` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT 'allow ip (all=0.0.0.0)',
  `IP_DESC` int(11) DEFAULT NULL,
  `ADD_DT` varchar(14) CHARACTER SET utf8 DEFAULT NULL,
  `ADD_ID` int(11) NOT NULL,
  `MOD_DT` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MOD_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`IP_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CMN_IP`
--

LOCK TABLES `CMN_IP` WRITE;
/*!40000 ALTER TABLE `CMN_IP` DISABLE KEYS */;
INSERT INTO `CMN_IP` VALUES (1,'NORMAL','172.17.0.1',NULL,'20170423150000',0,NULL,NULL);
/*!40000 ALTER TABLE `CMN_IP` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-18  5:05:46
