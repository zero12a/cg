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
-- Table structure for table `CG_VALID`
--

DROP TABLE IF EXISTS `CG_VALID`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_VALID` (
  `VALIDSEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PJTSEQ` int(11) NOT NULL,
  `DATATYPE` varchar(30) COLLATE utf8_bin NOT NULL,
  `VALIDID` varchar(30) COLLATE utf8_bin NOT NULL,
  `VALIDORD` int(11) NOT NULL DEFAULT '10',
  `VALIDNM` varchar(300) CHARACTER SET utf8 NOT NULL,
  `VALIDTYPE` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'VALIDATE,WHITELIST',
  `INVALIDMSG` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `MATSTR` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `ADDDT` varchar(14) CHARACTER SET utf8 NOT NULL,
  `ADDID` int(11) NOT NULL,
  `MODDT` varchar(14) CHARACTER SET utf8 DEFAULT NULL,
  `MODID` int(11) DEFAULT NULL,
  PRIMARY KEY (`VALIDSEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_VALID`
--

LOCK TABLES `CG_VALID` WRITE;
/*!40000 ALTER TABLE `CG_VALID` DISABLE KEYS */;
INSERT INTO `CG_VALID` VALUES (2,3,'NUMBER','NUM1',10,'숫자검사','REGEXMAT','숫자 아님','^[0-9]+$','20180129101414',0,'20180329204046',1),(3,3,'STRING','UPFILE1',20,'파일확장자검사','WHITELIST','업로드 허용 확장자 아님','jpg,gif,png','20180129101414',0,'20180329203005',1),(4,3,'STRING','EMAIL1',30,'이메일','REGEXMAT','이메일 형식 아님','^[^@]+@[^@]+$','20180129103240',0,'20180329203005',1),(5,3,'STRING','PHONE1',40,'핸드폰','REGEXMAT','핸드폰 아님 ( 형식 : 0101112222 )','^[0-9]{10,11}$','20180129103437',0,'20180329203005',1),(6,3,'STRING','PHONE2',50,'집전화','REGEXMAT','집전화 아님 ( 형식 : 02)111-2222 )','^[0-9]{2,3}\\)[0-9]{3,4}-[0-9]{4}$','20180129103830',0,'20180329203005',1),(7,3,'STRING','STR1',60,'특수문자없이 영/숫자','REGEXMAT','문자열 아님 ( 숫자, 영어, 공백, 콤마, 마침표, 물음표, 느낌표만 )','^[0-9a-zA-Z ,.!?]$','20180129104144',0,'20180329203005',1),(8,3,'STRING','STR2',70,'영문시작 영/숫자','REGEXMAT','영문시작 영/숫자 아님','^[a-zA-Z]{1}[a-zA-Z0-9]*$','20180129104314',0,'20180329203005',1),(14,3,'STRING','HTML1',300,'안전한 HTML','SAFEHTML','안전하지 않은 HTML 문자가 포함되어 있습니다.(변환)','--미 정의--','20180131223923',0,'20180329203005',1),(15,3,'STRING','TEXT1',200,'안전한 텍스트','SAFETEXT','안전하지 않은 특수문자/HTML 문자열이 포함되어 있습니다.','--미 정의--','20180131223923',0,'20180329203005',1),(16,3,'STRING','TEXT2',210,'클리어 텍스트','CLEARTEXT','안전하지 않은 HTML 문자가 포함되어 있습니다(제거)','--미 정의--','20180131231226',0,'20180329203005',1),(18,3,'STRING','COLID1',75,'영문시작 영/숫자/_','REGEXMAT','영/숫자/언더바 형식 필요','^[a-zA-Z]{1}[_a-zA-Z0-9]*$','20180307224202',0,'20180329203005',1),(19,3,'STRING','CHK1',100,'마스터체크','REGEXMAT','키,키,키 아님','^([0-9a-zA-Z]|,)+$','20180319083616',0,'20180329204019',1),(20,3,'DATE','DATE1',100,'YYYY.MM.DD','REGEXMAT','YYYY.MM.DD형식아님','^[0-9]{4}\\.[0-9]{2}\\.[0-9]{2}$','20180329203359',1,NULL,NULL),(21,3,'DATE','DATE4',130,'YYYY/MM/DD','REGEXMAT','YYYY/MM/DD','^[0-9]{4}/[0-9]{2}/[0-9]{2}$','20180329203718',1,NULL,NULL),(22,3,'DATE','DATE3',120,'YYYY-MM-DD','REGEXMAT','YYYY-MM-DD','^[0-9]{4}\\-[0-9]{2}\\-[0-9]{2}$','20180329203718',1,NULL,NULL),(23,3,'DATE','DATE2',110,'YYYYMMDD','REGEXMAT','YYYYMMDD','^[0-9]{8}$','20180329203718',1,'20191118133844',1);
/*!40000 ALTER TABLE `CG_VALID` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-10  6:51:16
