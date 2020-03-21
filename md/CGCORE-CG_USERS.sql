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
-- Table structure for table `CG_USERS`
--

DROP TABLE IF EXISTS `CG_USERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_USERS` (
  `USERSEQ` int(11) NOT NULL,
  `EMAIL` varchar(300) NOT NULL,
  `PASSWD` varchar(300) NOT NULL,
  `EMAILVALIDYN` varchar(1) NOT NULL,
  `LASTPWCHGDT` varchar(14) NOT NULL,
  `PWFAILCNT` int(11) NOT NULL DEFAULT '0',
  `LOCKYN` varchar(1) NOT NULL,
  `FREEZEDT` varchar(14) NOT NULL,
  `LOCKDT` varchar(14) NOT NULL,
  `SERVERSEQ` int(11) NOT NULL,
  `ADDDT` varchar(14) NOT NULL,
  `MODDT` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_USERS`
--

LOCK TABLES `CG_USERS` WRITE;
/*!40000 ALTER TABLE `CG_USERS` DISABLE KEYS */;
INSERT INTO `CG_USERS` VALUES (1,'zero12a@gmail.com','3e453f868136a31be81a1923f4c4011ce83355b26b76834f0424dabfb3611b4784d9bcfb290831c3b0446ebfd42dcf2621ebdef6d1fee51c63a35e7ff7d75299','Y','20180122224831',0,'N','','',3,'20160415111111','20180122225108');
/*!40000 ALTER TABLE `CG_USERS` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-21 22:39:42
