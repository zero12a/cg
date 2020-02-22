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
-- Table structure for table `CG_PJTFILE`
--

DROP TABLE IF EXISTS `CG_PJTFILE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_PJTFILE` (
  `FILESEQ` int(11) NOT NULL AUTO_INCREMENT,
  `PJTSEQ` int(11) NOT NULL,
  `MKFILETYPE` varchar(20) NOT NULL,
  `MKFILETYPENM` varchar(100) NOT NULL,
  `MKFILEFORMAT` varchar(100) NOT NULL,
  `MKFILEEXT` varchar(10) NOT NULL,
  `TEMPLATE` varchar(30) DEFAULT NULL,
  `FILEORD` int(11) NOT NULL DEFAULT '10',
  `USEYN` varchar(1) NOT NULL DEFAULT 'Y',
  `ADDDT` varchar(14) NOT NULL,
  `ADDID` int(11) NOT NULL DEFAULT '0',
  `MODDT` varchar(14) DEFAULT NULL,
  `MODID` int(11) DEFAULT NULL,
  PRIMARY KEY (`FILESEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_PJTFILE`
--

LOCK TABLES `CG_PJTFILE` WRITE;
/*!40000 ALTER TABLE `CG_PJTFILE` DISABLE KEYS */;
INSERT INTO `CG_PJTFILE` VALUES (1,3,'SVRCTL','컨트롤러','{P.PGMID#L}Controller','php','ASVRCTL',10,'Y','20160330121212',0,NULL,NULL),(2,3,'SVRDAO','데이터처리','{P.PGMID#L}Dao','php','ASVRDAO',10,'Y','20160330121212',0,NULL,NULL),(3,3,'SVRSVC','서비스','{P.PGMID#L}Service','php','ASVRSVC',10,'Y','20160330121212',0,NULL,NULL),(4,3,'HTML','화면','{P.PGMID#L}View','php','AHTML',10,'Y','20160330121212',0,NULL,NULL),(5,4,'SVRCTL','컨트롤러','{PGMID#L}Controller','java','JSVRCTL',10,'Y','20160330121212',0,NULL,NULL),(6,4,'SVRDAO','데이터처리','{PGMID#L}Mapper','java','JSVRDAO',10,'Y','20160330121212',0,NULL,NULL),(7,4,'SVRSVC','서비스','{PGMID#L}Service','java','JSVRSVC',10,'Y','20160330121212',0,NULL,NULL),(8,4,'HTML','화면','{PGMID#L}View','html','AHTML',10,'Y','20160330121212',0,NULL,NULL),(9,4,'SVRSQL','','{PGMID#L}Sql','xml','JSVRSQL',10,'Y','20160330121212',0,NULL,NULL),(10,3,'HTMLJS','JS','{P.PGMID#L}','js','AJS',10,'Y','20171211113836',0,'20171211114354',NULL),(11,0,'SVRCTL','컨트롤러','{P.PGMID#L}Controller','php','ASVRCTL',10,'Y','20180712174016',1,NULL,NULL),(12,0,'SVRDAO','데이터처리','{P.PGMID#L}Dao','php','ASVRDAO',10,'Y','20180712174016',1,NULL,NULL),(13,0,'SVRSVC','서비스','{P.PGMID#L}Service','php','ASVRSVC',10,'Y','20180712174016',1,NULL,NULL),(14,0,'HTML','화면','{P.PGMID#L}View','php','AHTML',10,'Y','20180712174016',1,NULL,NULL),(15,0,'HTMLJS','JS','{P.PGMID#L}','js','AJS',10,'Y','20180712174016',1,NULL,NULL),(16,0,'SVRCTL','컨트롤러','{P.PGMID#L}Controller','php','ASVRCTL',10,'Y','20180712174053',1,NULL,NULL),(17,0,'SVRDAO','데이터처리','{P.PGMID#L}Dao','php','ASVRDAO',10,'Y','20180712174053',1,NULL,NULL),(18,0,'SVRSVC','서비스','{P.PGMID#L}Service','php','ASVRSVC',10,'Y','20180712174053',1,NULL,NULL),(19,0,'HTML','화면','{P.PGMID#L}View','php','AHTML',10,'Y','20180712174053',1,NULL,NULL),(20,0,'HTMLJS','JS','{P.PGMID#L}','js','AJS',10,'Y','20180712174053',1,NULL,NULL),(21,0,'SVRCTL','컨트롤러','{P.PGMID#L}Controller','php','ASVRCTL',10,'Y','20180712180910',1,NULL,NULL),(22,0,'SVRCTL','컨트롤러','{P.PGMID#L}Controller','php','ASVRCTL',10,'Y','20180712180925',1,NULL,NULL),(23,0,'SVRCTL','컨트롤러','{P.PGMID#L}Controller','php','ASVRCTL',10,'Y','20180716083329',1,NULL,NULL),(24,0,'SVRCTL','컨트롤러','{P.PGMID#L}Controller','php','ASVRCTL',10,'Y','20180716083416',1,NULL,NULL),(25,5,'SVRCTL','컨트롤러','{P.PGMID#L}Controller','php','ASVRCTL',10,'Y','20180716084627',1,NULL,NULL),(26,5,'SVRDAO','데이터처리','{P.PGMID#L}Dao','php','ASVRDAO',10,'Y','20180716084651',1,NULL,NULL),(27,5,'SVRSVC','서비스','{P.PGMID#L}Service','php','ASVRSVC',10,'Y','20180716084651',1,NULL,NULL),(28,5,'HTML','화면','{P.PGMID#L}View','php','AHTML',10,'Y','20180716084651',1,NULL,NULL),(29,5,'HTMLJS','JS','{P.PGMID#L}','js','AJS',10,'Y','20180716084651',1,NULL,NULL),(30,24,'SVRCTL','컨트롤러','{P.PGMID#L}Controller','php','ASVRCTL',10,'Y','20180716113643',1,NULL,NULL),(31,24,'SVRDAO','데이터처리','{P.PGMID#L}Dao','php','ASVRDAO',10,'Y','20180716113643',1,NULL,NULL),(32,24,'SVRSVC','서비스','{P.PGMID#L}Service','php','ASVRSVC',10,'Y','20180716113643',1,NULL,NULL),(33,24,'HTML','화면','{P.PGMID#L}View','php','AHTML',10,'Y','20180716113643',1,NULL,NULL),(34,24,'HTMLJS','JS','{P.PGMID#L}','js','AJS',10,'Y','20180716113643',1,NULL,NULL),(35,5,'SVRCTL','컨트롤러','{P.PGMID#L}Controller','php','ASVRCTL',10,'Y','20180716165644',1,NULL,NULL);
/*!40000 ALTER TABLE `CG_PJTFILE` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-22 17:45:15
