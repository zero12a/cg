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
-- Table structure for table `CG_PGMINFO`
--

DROP TABLE IF EXISTS `CG_PGMINFO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_PGMINFO` (
  `PGMSEQ` int(11) NOT NULL AUTO_INCREMENT,
  `PGMID` varchar(100) COLLATE utf8_bin NOT NULL,
  `PJTSEQ` int(11) NOT NULL,
  `PGMNM` varchar(200) COLLATE utf8_bin NOT NULL,
  `PKGGRP` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `VIEWURL` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `PGMTYPE` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'NORMAL,POPUP',
  `POPWIDTH` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `POPHEIGHT` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `SECTYPE` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'NORMAL' COMMENT 'NORMAL,POWER,PI',
  `LOGINYN` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'Y',
  `ADDDT` varchar(14) COLLATE utf8_bin NOT NULL,
  `ADDID` int(11) NOT NULL,
  `MODDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `MODID` int(11) DEFAULT NULL,
  PRIMARY KEY (`PGMSEQ`),
  UNIQUE KEY `PGMID_2` (`PGMID`,`PJTSEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_PGMINFO`
--

LOCK TABLES `CG_PGMINFO` WRITE;
/*!40000 ALTER TABLE `CG_PGMINFO` DISABLE KEYS */;
INSERT INTO `CG_PGMINFO` VALUES (1,'AA1',0,'AA1','AA1','','NORMAL',NULL,NULL,'NORMAL','Y','20150111182454',0,NULL,NULL),(2,'AA2',0,'AA2','AA2','','NORMAL',NULL,NULL,'NORMAL','Y','20150111182550',0,NULL,NULL),(3,'CCC',0,'CCC',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101162444',0,NULL,NULL),(4,'CODEMNG',3,'코드관리1','SYSTEM','codemngView.php','NORMAL','','','NORMAL','Y','20160406120547',0,'20200316223347',1),(5,'DDD',0,'DDD',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101162916',0,NULL,NULL),(7,'ERER',0,'ERER',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101213022',0,NULL,NULL),(8,'ERRMNG',3,'에러 관리','ERRMNG','errmngView.php','NORMAL',NULL,NULL,'NORMAL','Y','20160402134216',0,'20200316223331',NULL),(9,'FFF',0,'FFF',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101163304',0,NULL,NULL),(10,'GG',0,'GG',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101182902',0,NULL,NULL),(11,'GGG',0,'GGG',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101182959',0,NULL,NULL),(12,'GGGG',0,'GGG',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101162158',0,NULL,NULL),(14,'HH1',0,'',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101183045',0,NULL,NULL),(15,'MM',0,'',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101184015',0,NULL,NULL),(16,'PGMID',0,'DASDASD1',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20140622114724',0,'20140622115254',NULL),(17,'SDFSDF',0,'SFSFSF111111',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20140622121317',0,NULL,NULL),(20,'PGMMNG',3,'프로젝트 관리','','pgmmngView.php','NORMAL',NULL,NULL,'POWER','Y','20140706222122',0,'20200316223253',NULL),(22,'TEST999',0,'TEST3','stdpkg','','NORMAL',NULL,NULL,'NORMAL','Y','20151030211031',0,'20160328025710',NULL),(24,'WWW',0,'WWWW',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101213539',0,NULL,NULL),(25,'ccc',0,'ccc',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101214732',0,NULL,NULL),(26,'dddd',0,'dddd',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101162805',0,NULL,NULL),(27,'hhh',0,'hhh',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101214043',0,NULL,NULL),(28,'jj',0,'jj',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101183437',0,NULL,NULL),(29,'kk',0,'kk',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101183335',0,NULL,NULL),(30,'rrr',0,'rrr',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101184154',0,NULL,NULL),(31,'sdasdasd',0,'sfsfsf11111111',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20140622121719',0,NULL,NULL),(32,'ttt',0,'tttttttt',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101214702',0,NULL,NULL),(33,'vv',0,'vv',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101184600',0,NULL,NULL),(34,'ww',0,'ww',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101193004',0,NULL,NULL),(35,'yyy',0,'yyy',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20150101214302',0,NULL,NULL),(36,'감사',0,'감사합니다.',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20140622121742',0,NULL,NULL),(37,'한글',0,'한글입니다.',NULL,'','NORMAL',NULL,NULL,'NORMAL','Y','20140622121729',0,NULL,NULL),(38,'APPAPI',3,'앱API','CCC','appapiView.php','NORMAL',NULL,NULL,'NORMAL','Y','20171203073753',0,'20200321094807',1),(40,'USERMNG',3,'사용자관리','','usermngView.php','NORMAL',NULL,NULL,'POWER','Y','20180118223628',0,'20200316223225',NULL),(41,'VALIDMNG',3,'입력값검증','','validmngView.php','NORMAL',NULL,NULL,'POWER','Y','20180129093455',0,'20200316223200',NULL),(42,'LOGIN',3,'D 로그인','','loginView.php','NORMAL',NULL,NULL,'POWER','Y','20180228102019',0,'20200316223148',NULL),(43,'USRMNG',3,'D  사용자관리','','usrmngView.php','NORMAL',NULL,NULL,'POWER','Y','20180228103625',0,'20200316223133',NULL),(44,'GROUPMNG',3,'D 그룹관리','','groupmngView.php','NORMAL',NULL,NULL,'POWER','Y','20180303023112',0,'20200316223150',NULL),(45,'GRPUSRMNG',3,'D 그룹의 사용자관리','','grpusrmngView.php','NORMAL',NULL,NULL,'POWER','Y','20180303023129',0,'20200316223120',NULL),(46,'GRPAUTHMNG',3,'D 그룹의 권한관리','','grpauthmngView.php','NORMAL',NULL,NULL,'POWER','Y','20180303023132',0,'20200317100657',NULL),(48,'MENUMNG',3,'D 메뉴 관리','','menumngView.php','NORMAL',NULL,NULL,'POWER','Y','20180304225258',0,'20200320064044',NULL),(49,'AUTHMNG',3,'D 권한관리','','authmngView.php','NORMAL',NULL,NULL,'POWER','Y','20180304231213',0,'20200316223002',NULL),(53,'AUTHDOWN',3,'권한조회','','authdownView.php','NORMAL',NULL,NULL,'NORMAL','Y','20180305113716',0,'20200316222949',NULL),(54,'LOGLOGIN',3,'로그인이력','','logloginView.php','NORMAL',NULL,NULL,'POWER','Y','20180312051523',0,'20200316222925',NULL),(55,'AUTHLOG',3,'AUTH로그','','authlogView.php','NORMAL',NULL,NULL,'POWER','Y','20180318225846',0,'20200316222909',NULL),(56,'DDIOMNG',3,'DD IO 이격관리','','ddiomngView.php','NORMAL',NULL,NULL,'NORMAL','Y','20180325150917',0,'20200316222853',NULL),(57,'IPMNG',3,'IP관리','','ipmngView.php','NORMAL',NULL,NULL,'POWER','Y','20180327072908',0,'20200316222849',NULL),(60,'LAYOUTMNG',3,'레이아웃관리','','layoutmngView.php','NORMAL',NULL,NULL,'NORMAL','Y','20180401153918',1,'20200316222820',NULL),(61,'PGMSEARCH',3,'프로그램검색','','pgmsearchView.php','POPUP','800px','500px','NORMAL','Y','20180405213046',1,'20200316222805',1),(62,'SQLSEARCH',3,'SQL검색','','sqlsearchView.php','POPUP','','','NORMAL','Y','20180423150438',1,'20200316222748',NULL),(63,'INTRONORMAL',3,'인트로_일반','','intronormalView.php','NORMAL','','','NORMAL','Y','20180423150503',1,'20200317100922',NULL),(65,'INTROADMIN',3,'인트로_관리자','','introadminView.php','NORMAL','','','NORMAL','Y','20180423150552',1,'20200316222718',NULL),(66,'CHARTBAR',3,'챠트','','chartbarView.php','NORMAL','','','NORMAL','Y','20180515082140',1,'20200316222657',1),(67,'DEPLOYMNG',3,'배포관리자','','deploymngView.php','NORMAL','','','POWER','Y','20180528072955',1,'20200316222645',1),(68,'PJTCOPY',3,'프로젝트 복사','PJT','pjtcopyView.php','NORMAL','','','NORMAL','Y','20180712170332',1,'20200316222614',1),(69,'findAnal',24,'파일 통계','','findanalView.php','NORMAL','','','NORMAL','Y','20180716170951',1,'20190812122011',NULL),(70,'fileLoad',24,'파일 분석','','fileloadView.php','NORMAL','','','NORMAL','Y','20180716170951',1,'20190726160003',NULL),(71,'POPPJT',3,'(팝업) 프로젝트 검색','','poppjtView.php','NORMAL','400','500','NORMAL','Y','20180716171102',1,'20200316222559',NULL),(72,'sysVulExport',24,'시스템별 취약점 down','','sysvulexportView.php','NORMAL','','','NORMAL','Y','20180716181812',1,'20190726155948',NULL),(73,'findFooter',24,'파일 통계(비로그인)','','findfooterView.php','NORMAL','','','NORMAL','N','20180827201059',0,'20190825140417',1),(75,'TESTCOPY2',24,'Copy of 파일 통계(비로그인)','','testcopy2View.php','NORMAL','','','NORMAL','Y','20181114075303',0,'20190726155916',NULL),(76,'a',23,'b','1',NULL,'NORMAL','1','2','NORMAL','Y','20190322203756',0,NULL,NULL),(77,'',23,'22','1',NULL,'POPUP','2','3','NORMAL','Y','20190322211118',0,NULL,NULL),(79,'FILETEST',3,'폼뷰테스트','','filetestView.php','NORMAL','','','NORMAL','Y','20190615170313',0,'20200316222603',NULL),(89,'PISQLR',3,'PISQLR','','pisqlrView.php','NORMAL','','','NORMAL','Y','20190828074629',1,'20200316222534',NULL),(90,'PISQLD',3,'PISQLD','','pisqldView.php','NORMAL','','','NORMAL','Y','20190828074629',1,'20200316222523',1),(91,'PIINHERIT',3,'PIINHERIT','','piinheritView.php','NORMAL','','','NORMAL','Y','20190828074629',1,'20200316222504',NULL),(92,'PIIO',3,'PIIO','','piioView.php','NORMAL','','','NORMAL','Y','20190828074629',1,'20200316222445',NULL),(93,'PISQL',3,'PISQL','','pisqlView.php','NORMAL','','','NORMAL','Y','20190828074629',1,'20200316222433',NULL),(94,'PIFNC',3,'PIFNC','','pifncView.php','NORMAL','','','NORMAL','Y','20190828074629',1,'20200316222416',NULL),(95,'PIGRP',3,'PIGRP','','pigrpView.php','NORMAL','','','NORMAL','Y','20190828074630',1,'20200316222353',NULL),(96,'PIPGM',3,'PIPGM','','pipgmView.php','NORMAL','','','NORMAL','Y','20190828074630',1,'20200316222332',NULL),(97,'PISVC',94,'Copy of PIFNC','','pifncView.php','NORMAL','','','NORMAL','Y','20190902212829',0,NULL,NULL),(98,'PISVC',3,'PISVC','','pisvcView.php','NORMAL','','','NORMAL','Y','20190902212952',1,'20200316222321',NULL),(100,'MONOLOG',3,'MONOLOG','','monologView.php','NORMAL','','','NORMAL','Y','20191118101322',1,'20200316222305',NULL),(102,'SRCDEPLOY',3,'소스 배포','','srcdeployView.php','NORMAL','','','NORMAL','Y','20200209205341',1,'20200319080822',1),(103,'DBDEPLOY',3,'데이터 배포','','dbdeployView.php','NORMAL','','','NORMAL','Y','20200210075948',1,'20200320061446',NULL),(104,'AUTHDEPLOY',3,'메뉴/권한 배포','','authdeployView.php','NORMAL','','','POWER','Y','20200228070832',0,'20200317064534',1),(105,'PJTSUMMARY',3,'프로젝트요약','','pjtsummaryView.php','NORMAL','','','NORMAL','Y','20200312064226',1,'20200316223914',NULL),(106,'ICONMNG',3,'아이콘관리','','iconmngView.php','NORMAL','','','NORMAL','Y','20200320070340',1,'20200321222837',NULL);
/*!40000 ALTER TABLE `CG_PGMINFO` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-21 22:40:13
