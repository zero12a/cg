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
-- Table structure for table `CG_SVR`
--

DROP TABLE IF EXISTS `CG_SVR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_SVR` (
  `SVRSEQ` int(11) NOT NULL AUTO_INCREMENT,
  `SVRID` varchar(50) NOT NULL,
  `SVRNM` varchar(100) NOT NULL,
  `PJTSEQ` int(11) NOT NULL,
  `USERSEQ` int(11) NOT NULL,
  `DBHOST` varchar(100) NOT NULL,
  `DBPORT` int(11) NOT NULL DEFAULT '3306',
  `DBNAME` varchar(100) NOT NULL,
  `DBUSRID` varchar(200) NOT NULL,
  `DBUSRPW` varchar(200) NOT NULL,
  `WEBHOST` varchar(100) DEFAULT NULL,
  `WEBFTPPORT` int(11) DEFAULT '21',
  `WEBFTPID` varchar(100) DEFAULT NULL,
  `WEBFTPPW` varchar(200) DEFAULT NULL,
  `WEBFTPREMOTEPATH` varchar(500) DEFAULT NULL,
  `USEYN` varchar(1) NOT NULL DEFAULT 'Y',
  `ADDDT` varchar(14) NOT NULL,
  `MODDT` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`SVRSEQ`),
  UNIQUE KEY `SVRID` (`SVRID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_SVR`
--

LOCK TABLES `CG_SVR` WRITE;
/*!40000 ALTER TABLE `CG_SVR` DISABLE KEYS */;
INSERT INTO `CG_SVR` VALUES (3,'CG','CG',3,1,'172.17.0.1',3306,'CG','cg','v+brCyGuam45V6DuIqN84otDIa5z9VnTE8iJa2FDFZA=',NULL,21,NULL,NULL,'/home/ec2-user/apache/html/c.g/rst/usr_1','Y','','20180123133656'),(4,'DATING','데이팅',3,1,'172.17.0.1',3306,'DATING','zero12a','VdlXUhz6aO7iBPSiC4FUUfB1/epcq5+JXm7Z/FIYuRQ=',NULL,21,NULL,NULL,NULL,'Y','20180123132706','20200220061119'),(5,'SC','SC',3,1,'172.17.0.1',3306,'SC','zero12a','VdlXUhz6aO7iBPSiC4FUUfB1/epcq5+JXm7Z/FIYuRQ=',NULL,21,NULL,NULL,NULL,'Y','20180712153825',NULL),(6,'CGPJT2','CG플젝2',3,1,'172.17.0.1',3306,'CGPJT2','cg','v+brCyGuam45V6DuIqN84otDIa5z9VnTE8iJa2FDFZA=',NULL,21,NULL,NULL,NULL,'Y','20200217215919','20200301114405'),(7,'CGPJT1','CG플젝1',3,1,'172.17.0.1',3306,'CGPJT1','cg','v+brCyGuam45V6DuIqN84otDIa5z9VnTE8iJa2FDFZA=',NULL,21,NULL,NULL,NULL,'Y','20200217215919',NULL),(8,'CGCORE','CG코어3',3,1,'172.17.0.1',3306,'CGCORE','cg','v+brCyGuam45V6DuIqN84otDIa5z9VnTE8iJa2FDFZA=',NULL,21,NULL,NULL,NULL,'Y','20200217215919','20200219081902'),(9,'OS','OS인증',3,1,'172.17.0.1',3306,'OS','cg','v+brCyGuam45V6DuIqN84otDIa5z9VnTE8iJa2FDFZA=',NULL,21,NULL,NULL,NULL,'Y','20200220061119',NULL);
/*!40000 ALTER TABLE `CG_SVR` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-03  7:09:58
