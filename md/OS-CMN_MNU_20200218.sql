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
-- Table structure for table `CMN_MNU`
--

DROP TABLE IF EXISTS `CMN_MNU`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CMN_MNU` (
  `MNU_SEQ` int(11) NOT NULL AUTO_INCREMENT,
  `MNU_NM` varchar(100) NOT NULL,
  `PGMID` varchar(30) DEFAULT NULL,
  `URL` varchar(200) NOT NULL,
  `PGMTYPE` varchar(20) NOT NULL,
  `MNU_ORD` int(11) NOT NULL DEFAULT '10',
  `FOLDER_SEQ` int(11) NOT NULL,
  `USE_YN` varchar(1) NOT NULL DEFAULT 'Y',
  `ADD_DT` varchar(14) NOT NULL,
  `ADD_ID` int(11) NOT NULL,
  `MOD_DT` varchar(14) DEFAULT NULL,
  `MOD_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`MNU_SEQ`),
  UNIQUE KEY `PGMID` (`PGMID`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CMN_MNU`
--

LOCK TABLES `CMN_MNU` WRITE;
/*!40000 ALTER TABLE `CMN_MNU` DISABLE KEYS */;
INSERT INTO `CMN_MNU` VALUES (32,'입력값검증','VALIDMNG','validmngView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(33,'D  사용자관리','USRMNG','usrmngView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(34,'사용자관리','USERMNG','usermngView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(35,'프로젝트 관리','PGMMNG','pgmmngView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(36,'D 메뉴 관리','MENUMNG','menumngView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(37,'D 로그인','LOGIN','loginView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(38,'D 그룹의 사용자관리','GRPUSRMNG','grpusrmngView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(39,'D 그룹의 권한관리','GRPAUTHMNG','grpauthmngView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(40,'D 그룹관리','GROUPMNG','groupmngView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(41,'BO메인2','BOMAIN','bomainView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(42,'D 권한관리','AUTHMNG','authmngView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(43,'권한조회','AUTHDOWN','authdownView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(44,'앱API','APP_API','app_apiView.php','NORMAL',10,1,'Y','20180307224701',0,NULL,NULL),(45,'인트로_일반','INTRONORMAL','intronormalView.php','NORMAL',5,1,'Y','20180423161444',1,'20190630231541',1),(46,'챠트','CHARTBAR','chartbarView.php','NORMAL',10,1,'Y','20180528224550',1,NULL,NULL),(48,'인트로_관리자','INTROADMIN','introadminView.php','NORMAL',6,1,'Y','20180528224838',1,'20190630231541',1),(49,'배포관리자','DEPLOYPGM','deploypgmView.php','NORMAL',10,1,'Y','20180528225211',1,NULL,NULL),(50,'SQL검색','SQLSEARCH','sqlsearchView.php','POPUP',10,1,'Y','20180611163116',1,NULL,NULL),(51,'앱API','APPAPI','appapiView.php','NORMAL',10,1,'Y','20180611163230',1,NULL,NULL),(52,'로그인이력','LOGLOGIN','logloginView.php','NORMAL',10,1,'Y','20180611163230',1,NULL,NULL),(53,'AUTH로그','AUTHLOG','authlogView.php','NORMAL',10,1,'Y','20180611163230',1,NULL,NULL),(54,'DD IO 이격관리','DDIOMNG','ddiomngView.php','NORMAL',10,1,'Y','20180611163230',1,NULL,NULL),(55,'IP관리','IPMNG','ipmngView.php','NORMAL',10,1,'Y','20180611163230',1,NULL,NULL),(56,'레이아웃관리','LAYOUTMNG','layoutmngView.php','NORMAL',10,1,'Y','20180611163230',1,NULL,NULL),(57,'프로그램검색','PGMSEARCH','pgmsearchView.php','POPUP',10,1,'Y','20180611163230',1,NULL,NULL),(58,'코드관리','CODEMNG','codemngView.php','NORMAL',10,1,'Y','20180611163828',1,NULL,NULL),(59,'에러 관리','ERRMNG','','NORMAL',10,1,'Y','20180611163828',1,NULL,NULL),(60,'(팝업) 프로젝트 검색','POPPJT','','NORMAL',10,0,'Y','20190213230441',1,NULL,NULL),(61,'프로젝트 복사','PJTCOPY','pjtcopyView.php','NORMAL',10,0,'Y','20190213230510',1,NULL,NULL);
/*!40000 ALTER TABLE `CMN_MNU` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-18  5:05:48
