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
-- Table structure for table `CG_ICONMNG`
--

DROP TABLE IF EXISTS `CG_ICONMNG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_ICONMNG` (
  `ICONSEQ` int(11) NOT NULL AUTO_INCREMENT,
  `IMGNM` varchar(100) NOT NULL,
  `IMGSVRNM` varchar(100) NOT NULL,
  `IMGSIZE` int(11) NOT NULL,
  `IMGHASH` varchar(100) DEFAULT NULL,
  `IMGTYPE` int(11) DEFAULT NULL,
  `ADDDT` varchar(14) NOT NULL,
  PRIMARY KEY (`ICONSEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_ICONMNG`
--

LOCK TABLES `CG_ICONMNG` WRITE;
/*!40000 ALTER TABLE `CG_ICONMNG` DISABLE KEYS */;
INSERT INTO `CG_ICONMNG` VALUES (1,'crypt_lock.png','PIC_200320071434afX3.png',379,NULL,NULL,'20200320071434'),(2,'reload.png','PIC_200320071529P9RG.png',54667,NULL,NULL,'20200320071529'),(3,'reload.png','PIC_2003200728348yPf.png',54667,NULL,NULL,'20200320072834'),(4,'reload.png','PIC_200320073050el1U.png',54667,NULL,NULL,'20200320073050'),(5,'reload.png','PIC_200320073157pXrc.png',54667,NULL,NULL,'20200320073157'),(6,'reload.png','PIC_200320073334LZaK.png',54667,NULL,NULL,'20200320073334'),(7,'crypt_lock.png','PIC_200321213419EcIg.png',379,'20d12cd2d4c62191d6c4666b0ff11daab6d27b8a50d4daad4491451ab4a4c2d5',3,'20200321213419');
/*!40000 ALTER TABLE `CG_ICONMNG` ENABLE KEYS */;
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
