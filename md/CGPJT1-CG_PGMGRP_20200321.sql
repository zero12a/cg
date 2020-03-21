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
-- Table structure for table `CG_PGMGRP`
--

DROP TABLE IF EXISTS `CG_PGMGRP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_PGMGRP` (
  `PJTSEQ` int(11) NOT NULL,
  `PGMSEQ` int(11) NOT NULL,
  `GRPSEQ` int(11) NOT NULL AUTO_INCREMENT,
  `GRPID` varchar(30) COLLATE utf8_bin NOT NULL,
  `GRPTYPE` varchar(20) COLLATE utf8_bin NOT NULL,
  `GRPNM` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `GRPORD` int(11) NOT NULL DEFAULT '1',
  `FREEZECNT` int(11) DEFAULT '0',
  `VBOX` varchar(10) COLLATE utf8_bin NOT NULL,
  `COLBRCNT` int(11) DEFAULT '4',
  `REFGRPID` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `GRPWIDTH` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `GRPHEIGHT` varchar(200) COLLATE utf8_bin NOT NULL,
  `GRPPADDING` varchar(100) COLLATE utf8_bin DEFAULT '0',
  `BRYN` varchar(1) COLLATE utf8_bin DEFAULT 'Y',
  `COLSIZETYPE` varchar(1) COLLATE utf8_bin DEFAULT 'X',
  `LEGENDALIGN` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'TOP',
  `STACKED` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'N',
  `ADDDT` varchar(14) COLLATE utf8_bin NOT NULL,
  `MODDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `ADDID` int(11) NOT NULL DEFAULT '0',
  `MODID` int(11) DEFAULT NULL,
  PRIMARY KEY (`GRPSEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_PGMGRP`
--

LOCK TABLES `CG_PGMGRP` WRITE;
/*!40000 ALTER TABLE `CG_PGMGRP` DISABLE KEYS */;
INSERT INTO `CG_PGMGRP` VALUES (3,8,1,'G1','BTN','',5,0,'NONE',0,'','100%','22px','0',NULL,'X','0','N','20160402134237',NULL,0,NULL),(3,8,2,'G2','CONDITION','',10,0,'NONE',0,'G1','100%','44px','0',NULL,'X','0','N','20160402134237','20160402135613',0,NULL),(3,8,3,'G3','GRID','에러',20,0,'NONE',0,'G2','70%','400px','0',NULL,'X','0','N','20160402134237','20160402144332',0,NULL),(3,8,4,'G4','FORMVIEW','',30,0,'NONE',0,'G3','30%','400px','0',NULL,'X','0','N','20160402134237','20160402144332',0,NULL),(3,20,10,'G2','CONDITION','2',10,0,'NONE',0,'G1','100%','80px','',NULL,'X','0','N','20141027205141','20200303065305',0,NULL),(3,20,11,'G3','GRID','PJT',30,0,'NONE',0,'G2','50%','250px','',NULL,'X','0','N','20141027205141','20171222102431',0,NULL),(3,20,12,'G4','GRID','PGM',40,0,'NONE',0,'G3','50%','250px','',NULL,'X','0','N','20141209202944','20171222102431',0,NULL),(3,20,13,'G5','GRID','DD',50,3,'NONE',0,'G3','100%','200px','',NULL,'X','0','N','20141209223001','20180325173251',0,NULL),(3,20,14,'G6','GRID','CONFIG',60,0,'NONE',0,'G3','50%','250px','0',NULL,'X','0','N','20150111153903','20171222102431',0,NULL),(3,20,15,'G7','GRID','FILE',70,0,'NONE',0,'G3','50%','250px','0',NULL,'X','0','N','20160331123147','20171222102431',0,NULL),(38,20,40,'BTN','BTN','5',0,0,'NONE',0,'0','22px','','0',NULL,'X','0','N','20171203110542','20171203110646',0,NULL),(38,20,41,'CONDITION','CONDITION','10',0,0,'NONE',0,'0','200px','','0',NULL,'X','0','N','20171203110542','20171203110646',0,NULL),(38,20,42,'GRID','GRID','20',0,0,'NONE',0,'0','200px','','0',NULL,'X','0','N','20171203110542','20171203110646',0,NULL),(38,20,43,'GRID','GRID','30',0,0,'NONE',0,'0','200px','','0',NULL,'X','0','N','20171203110542','20171203110646',0,NULL),(3,38,50,'C2','CONDITION','컨디션1',10,0,'NONE',0,'','100%','80px','0',NULL,'X','0','N','20171205113026','20171228222216',0,NULL),(3,38,51,'G3','GRIDBT','그리드1',20,3,'NONE',0,'C2','50%','500px','0',NULL,'X','0','N','20171205113026','20200321094738',0,NULL),(3,38,52,'F4','FORMVIEW','폼뷰1',30,0,'NONE',0,'G3','50%','500px','0',NULL,'X','0','N','20171205113026','20190812092622',0,NULL),(3,13,54,'G1','BTN','',5,0,'NONE',4,'0','0','100%','0',NULL,'X','0','N','20171208105041',NULL,0,NULL),(3,13,55,'G2','CONDITION','',10,0,'NONE',4,'0','0','100%','0',NULL,'X','0','N','20171208105041',NULL,0,NULL),(3,13,56,'G3','GRID','',20,0,'NONE',4,'0','0','50%','0',NULL,'X','0','N','20171208105041',NULL,0,NULL),(3,13,57,'G4','GRID','',30,0,'NONE',4,'0','0','50%','0',NULL,'X','0','N','20171208105041',NULL,0,NULL),(3,40,58,'C1','CONDITION','조건1',20,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180118223742','20200217220358',0,NULL),(3,40,59,'G2','GRID','사용자1',30,0,'NONE',4,'C1','35%','500px','0',NULL,'X','0','N','20180118223742','20200217220630',0,NULL),(3,40,61,'G3','GRID','프로젝트2',40,0,'NONE',4,'G2','25%','500px','0',NULL,'X','0','N','20180118230644','20200217220630',0,NULL),(3,40,62,'G4','GRID','서버4',50,0,'NONE',4,'G2','40%','500px','0',NULL,'X','0','N','20180118231356','20180121221748',0,NULL),(3,41,63,'C1','CONDITION','조회조건',10,0,'NONE',4,'0','100%','80px','0',NULL,'X','0','N','20180129094400','20180129095957',0,NULL),(3,41,64,'G2','GRID','목록',20,0,'NONE',4,'C1','60%','500px','0',NULL,'X','0','N','20180129094400','20180309120524',0,NULL),(3,41,65,'F3','FORMVIEW','상세',30,0,'NONE',4,'G2','40%','500px','0',NULL,'X','0','N','20180129094401','20180309120524',0,NULL),(3,42,66,'G1','CONDITION','입력폼',10,0,'NONE',4,'0','100%','200px','0',NULL,'X','0','N','20180228102123',NULL,0,NULL),(3,42,67,'G2','FORMVIEW','조회결과',20,0,'NONE',4,'G1','100%','200px','0',NULL,'X','0','N','20180228102123','20180308230727',0,NULL),(3,43,68,'G1','CONDITION','조회조건',10,0,'NONE',4,'0','100%','80px','0',NULL,'X','0','N','20180228103750','20191029214123',0,NULL),(3,43,69,'G2','GRID','회원목록',20,0,'NONE',4,'G1','65%','400px','0',NULL,'X','0','N','20180228103750','20180228114134',0,NULL),(3,43,70,'G3','FORMVIEW','회원상세',30,0,'NONE',4,'G2','35%','400px','0',NULL,'X','0','N','20180228103750','20180228114134',0,NULL),(3,44,71,'G1','CONDITION','조회조건',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180303023323','20180303024927',0,NULL),(3,44,72,'G2','GRID','그룹목록',20,0,'NONE',4,'G1','50%','300px','0',NULL,'X','0','N','20180303023323','20180303024927',0,NULL),(3,44,73,'G3','FORMVIEW','그룹상세',30,0,'NONE',4,'G2','50%','300px','0',NULL,'X','0','N','20180303023323','20180303024927',0,NULL),(3,45,74,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180303025659','20180303031039',0,NULL),(3,45,75,'G2','GRID','그룹',20,0,'NONE',4,'G1','100%','200px','0',NULL,'X','0','N','20180303025659','20180312050751',0,NULL),(3,45,76,'G3','GRID','그룹에 속함',30,0,'NONE',4,'G2','50%','400px','0',NULL,'X','0','N','20180303025659','20180312050751',0,NULL),(3,45,77,'G4','GRID','해당그룹에 미포함',40,0,'NONE',4,'G2','50%','400px','0',NULL,'X','0','N','20180303025659','20180312050751',0,NULL),(3,46,78,'G1','CONDITION','조회조건',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180303041316','20180303041441',0,NULL),(3,46,79,'G2','GRID','그룹목록',20,0,'NONE',4,'G1','20%','500px','0',NULL,'X','0','N','20180303041316','20180312051321',0,NULL),(3,46,80,'G3','GRID','보유 권한',30,0,'NONE',4,'G2','40%','500px','0',NULL,'X','0','N','20180303041316','20180312051321',0,NULL),(3,46,81,'G4','GRID','미보유 권한',40,0,'NONE',4,'G2','40%','500px','0',NULL,'X','0','N','20180303041316','20180312051321',0,NULL),(3,48,82,'G1','CONDITION','조회조건',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180304225446','20180304225535',0,NULL),(3,48,83,'G2','GRID','지정 폴더',20,0,'NONE',4,'G1','50%','300px','0',NULL,'X','0','N','20180304225446','20200317221014',0,NULL),(3,48,84,'G3','GRID','지정 메뉴',30,0,'NONE',4,'G2','50%','300px','0',NULL,'X','0','N','20180304225446','20200317221014',0,NULL),(3,49,85,'G1','CONDITION','조회조건',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180304231510',NULL,0,NULL),(3,49,86,'G2','GRID','권한목록',20,0,'NONE',4,'G1','80%','600px','0',NULL,'X','0','N','20180304231511','20180403203619',0,NULL),(3,49,87,'G3','FORMVIEW','권한상세',30,0,'NONE',4,'G2','20%','600px','0',NULL,'X','0','N','20180304231511','20180403203619',0,NULL),(3,53,88,'G1','CONDITION','조회조건',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180305113752','20180308223150',0,NULL),(3,53,89,'G2','GRID','권한목록',20,0,'NONE',4,'G1','100%','700px','0',NULL,'X','0','N','20180305113752','20180308223107',0,NULL),(3,54,90,'G1','CONDITION','조건',10,0,'NONE',4,'','100%','60px','0',NULL,'X','0','N','20180312051624','20180312054052',0,NULL),(3,54,91,'G2','GRID','목록',20,0,'NONE',4,'G1','65%','600px','0',NULL,'X','0','N','20180312051624','20180312054052',0,NULL),(3,54,92,'G3','FORMVIEW','상세',30,0,'NONE',4,'G2','35%','600px','0',NULL,'X','0','N','20180312051624','20180312054052',0,NULL),(3,55,93,'G1','CONDITION','컨',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180318230024','20180318232149',0,NULL),(3,55,94,'G2','GRID','AUTH',20,0,'NONE',4,'G1','50%','600px','0',NULL,'X','0','N','20180318230024','20180318232149',0,NULL),(3,55,95,'G3','GRID','AUTHD',30,0,'NONE',4,'G2','50%','200px','0',NULL,'X','0','N','20180318230024','20180318232149',0,NULL),(3,55,96,'G4','FORMVIEW','AUTHD상세',40,0,'NONE',4,'G3','50%','400px','0',NULL,'X','0','N','20180318230024','20180318232149',0,NULL),(3,56,97,'G1','CONDITION','조건1',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180325150937','20180325151008',0,NULL),(3,56,98,'G2','GRID','DATASIZE',20,0,'NONE',4,'G1','33%','500px','0',NULL,'X','0','N','20180325150937','20180325172322',0,NULL),(3,56,99,'G3','GRID','DATATYPE',30,0,'NONE',4,'G1','34%','500px','0',NULL,'X','0','N','20180325150937','20180325172322',0,NULL),(3,56,100,'G4','GRID','VALIDSEQ',40,0,'NONE',4,'G1','33%','500px','0',NULL,'X','0','N','20180325172322','20180325172759',0,NULL),(3,4,113,'G1','CONDITION','1',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180325191704',NULL,0,NULL),(3,4,114,'G2','GRID','마스터',20,0,'NONE',4,'G1','40%','500px','0',NULL,'X','0','N','20180325191704','20190809071915',0,NULL),(3,4,115,'G3','GRID','상세',30,0,'NONE',4,'G2','60%','500px','0',NULL,'X','0','N','20180325191704','20190809071915',0,NULL),(3,57,116,'G1','CONDITION','조건',10,0,'NONE',4,'','100%','100px','0',NULL,'X','0','N','20180327072953',NULL,0,NULL),(3,57,117,'G2','GRID','IP목록',20,0,'NONE',4,'G1','100%','500px','0',NULL,'X','0','N','20180327072953',NULL,0,NULL),(3,58,118,'G1','CONDITION','',10,0,'NONE',4,'','100%','150px','0',NULL,'X','0','N','20180330075153','20180401171250',0,NULL),(3,58,119,'G2','GRID','G2',20,0,'NONE',4,'G1','50%','300px','0',NULL,'X','0','N','20180330075153','20180401171250',0,NULL),(3,58,120,'G3','GRID','G3',30,0,'START',4,'G2','50%','150px','0',NULL,'X','0','N','20180330075153','20180401171250',0,NULL),(3,58,121,'G4','GRID','G4',40,0,'END',4,'G3','50%','150px','0',NULL,'X','0','N','20180330075153','20180401171250',0,NULL),(3,59,126,'G1','CONDITION','G1',10,0,'NONE',4,'','100%','100px','0',NULL,'X','0','N','20180401150857','20180401162858',0,NULL),(3,59,127,'G2','GRID','G2',20,0,'START',4,'G1','50%','150px','0',NULL,'X','0','N','20180401150857','20180401162858',0,NULL),(3,59,128,'G3','GRID','G3',30,0,'END',4,'G2','50%','150px','0',NULL,'X','0','N','20180401150857','20180401162858',0,NULL),(3,59,129,'G4','GRID','G4',40,0,'NONE',4,'G3','50%','300px','0',NULL,'X','0','N','20180401150857','20180401162858',0,NULL),(3,60,130,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180401154106','20200227064048',0,NULL),(3,60,131,'G2','GRID','LAYOUT',20,0,'NONE',4,'G1','50%','500px','0',NULL,'X','0','N','20180401154107','20180401160327',0,NULL),(3,60,132,'G3','GRID','LAYOUTD',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','0','N','20180401154107','20180401160327',0,NULL),(3,61,133,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180405213633',NULL,0,NULL),(3,61,134,'G2','GRID','G2',20,0,'NONE',4,'G1','50%','400px','0',NULL,'X','0','N','20180405213633','20180406080038',0,NULL),(3,61,135,'G3','GRID','G3',30,0,'NONE',4,'G2','50%','400px','0',NULL,'X','0','N','20180405213633','20180406080038',0,NULL),(3,62,136,'G1','CONDITION','조건',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180423150655','20180423152250',0,NULL),(3,62,137,'G2','GRID','프로그램',20,0,'NONE',4,'G1','50%','505px','0',NULL,'X','0','N','20180423150655','20180423152420',0,NULL),(3,62,138,'G3','GRID','SQL',30,0,'START',4,'G2','50%','200px','0',NULL,'X','0','N','20180423150655','20180423152250',0,NULL),(3,62,139,'G4','FORMVIEW','폼',40,0,'END',4,'G3','50%','300px','0',NULL,'X','0','N','20180423150655','20180423152359',0,NULL),(3,63,140,'G1','CONDITION','',10,0,'NONE',4,'','100%','70px','0',NULL,'X','0','N','20180423152641',NULL,0,NULL),(3,63,141,'G2','GRID','로그인',20,0,'NONE',4,'G1','50%','305px','0',NULL,'X','0','N','20180423152641',NULL,0,NULL),(3,63,142,'G3','GRID','잠금',30,0,'START',4,'G1','50%','100px','0',NULL,'X','0','N','20180423152641','20180423153140',0,NULL),(3,63,143,'G4','GRID','메뉴이력',40,0,'END',4,'G1','50%','200px','0',NULL,'X','0','N','20180423152641','20180423153140',0,NULL),(3,65,144,'G1','CONDITION','조건',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20180511143424',NULL,0,NULL),(3,65,145,'G2','FORMVIEW','월점검',20,0,'NONE',4,'G1','50%','200px','0',NULL,'X','0','N','20180511143424',NULL,0,NULL),(3,65,146,'G3','GRID','로그인실패',30,0,'NONE',4,'G1','50%','200px','0',NULL,'X','0','N','20180511143424',NULL,0,NULL),(3,65,147,'G4','GRID','로그인실패IP',40,0,'NONE',4,'G1','50%','200px','0',NULL,'X','0','N','20180511143424',NULL,0,NULL),(3,65,148,'G6','GRID','권한없는접근',50,0,'NONE',4,'G1','33%','200px','0',NULL,'X','0','N','20180511143424','20180511151053',0,NULL),(3,65,149,'G7','GRID','로그인잠금',60,0,'NONE',4,'G1','33%','200px','0',NULL,'X','0','N','20180511143424','20180511151053',0,NULL),(3,65,150,'G8','GRID','월점검목록',25,0,'NONE',4,'G1','50%','200px','0',NULL,'X','0','N','20180511143424',NULL,0,NULL),(3,65,151,'G9','GRID','개인정보접근',70,0,'NONE',4,'G1','34%','200px','0',NULL,'X','0','N','20180511151053',NULL,0,NULL),(3,66,152,'G1','CONDITION','컨디션',10,0,'NONE',4,'','100%','100px','0',NULL,'X','0','N','20180515205246',NULL,0,NULL),(3,66,153,'G2','CHARTBAR','챠트',20,0,'NONE',4,'G1','50%','500px','0',NULL,'X','RIGHT','N','20180515205246','20190325224613',0,NULL),(3,66,154,'G3','CHARTPIE','PIE',39,0,'NONE',4,'G1','50%','500px','0',NULL,'X','RIGHT','N','20180518083202','20190325220501',0,NULL),(3,67,155,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','N','20180528073205',NULL,0,NULL),(3,67,156,'G2','GRID','파일',20,0,'NONE',4,'G1','50%','510px','0',NULL,'X','','N','20180528073205','20180528080633',0,NULL),(3,67,157,'G3','GRID','SQL PGM',30,0,'START',4,'G1','50%','250px','0',NULL,'X','','N','20180528073205','20180528080355',0,NULL),(3,67,158,'G4','GRID','SQL AUTH',40,0,'END',4,'G1','50%','250px','0',NULL,'X','','N','20180528073205','20180528080355',0,NULL),(3,66,159,'G5','GRID','PIE상속',50,0,'NONE',4,'G3','50%','200px','0',NULL,'X','','N','20180614071134','20180614083127',0,NULL),(3,66,160,'G4','GRID','BAR상속',40,0,'NONE',4,'G2','50%','200px','0',NULL,'X','','N','20180614071134','20180614083127',0,NULL),(3,68,161,'G5','GRID','to FILE',50,0,'NONE',4,'G1','50%','300px','0',NULL,'X','','N','20180712170621','20180716111220',0,NULL),(3,68,162,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','N','20180712170621','20200301120159',0,NULL),(3,68,163,'G2','GRID','from CFG',20,0,'NONE',4,'G1','50%','300px','0',NULL,'X','','N','20180712170621','20180716111220',0,NULL),(3,68,164,'G3','GRID','from FILE',30,0,'NONE',4,'G1','50%','300px','0',NULL,'X','','N','20180712170621','20180716111220',0,NULL),(3,68,165,'G4','GRID','to CFG',40,0,'NONE',4,'G1','50%','300px','0',NULL,'X','','N','20180712170621','20180716111220',0,NULL),(3,71,166,'G1','CONDITION','조건',10,0,'NONE',4,'','100%','100px','0',NULL,'X','','N','20180716171156',NULL,0,NULL),(3,71,167,'G2','GRID','프로젝트',20,0,'NONE',4,'G1','100%','300px','0',NULL,'X','','N','20180716171156',NULL,0,NULL),(24,71,168,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','N','20180716171628',NULL,0,NULL),(24,71,169,'G2','GRID','파일목록',20,0,'NONE',4,'G1','50%','700px','0',NULL,'X','','N','20180716171628',NULL,0,NULL),(24,71,170,'G3','GRID','파일상세',30,0,'NONE',4,'G2','50%','700px','0',NULL,'X','','N','20180716171628',NULL,0,NULL),(24,70,171,'G1','CONDITION','2',10,0,'NONE',4,'','100%','70px','0',NULL,'X','','N','20180716171701','20180719102505',0,NULL),(24,70,172,'G2','GRID','3',20,0,'NONE',4,'G1','50%','650px','0',NULL,'X','','N','20180716171701','20180719102505',0,NULL),(24,70,173,'G3','GRID','4',30,0,'NONE',4,'G2','50%','650px','0',NULL,'X','','N','20180716171701','20180719102505',0,NULL),(24,72,174,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','N','20180716181829','20180718105222',0,NULL),(24,72,175,'G2','GRID','',20,0,'NONE',4,'G1','100%','600px','0',NULL,'X','','N','20180716181829','20180718105222',0,NULL),(24,69,176,'G1','CONDITION','',10,0,'NONE',4,'','100%','70px','0',NULL,'X','','N','20180719144015','20180719164715',0,NULL),(24,69,177,'G2','CHARTBAR2Y','팀별 현황 (보안취약점 갯수)',20,0,'NONE',4,'G1','50%','400px','0',NULL,'X','RIGHT','N','20180719144015','20190812120747',0,NULL),(24,69,178,'G3','GRID','팀별 현황 (보안취약점 갯수)',30,0,'NONE',4,'G1','50%','400px','0',NULL,'X','','N','20180719144015','20190812120747',0,NULL),(24,69,179,'G4','GRID','시스템별 현황',40,0,'NONE',4,'G3','50%','400px','0',NULL,'X','','N','20180719144015','20190812120747',0,NULL),(24,69,180,'G5','GRID','취약점별 현황',50,0,'NONE',4,'G4','50%','400px','0',NULL,'X','','N','20180719154215','20190812120747',0,NULL),(24,73,181,'G1','CONDITION','',10,0,'NONE',4,'','100%','90px','0',NULL,'X','','N','20180827201059','20181005081756',0,NULL),(24,73,182,'G2','CHARTBAR','팀별 현황 (보안취약점 갯수)1',20,0,'NONE',4,'G1','100%','300px','0',NULL,'X','RIGHT','N','20180827201100','20190825133419',0,NULL),(24,73,183,'G3','GRID','팀별 현황 (보안취약점 갯수)2',30,0,'NONE',4,'G1','33%','400px','0',NULL,'X','','N','20180827201100','20181014150959',0,NULL),(24,73,184,'G4','GRID','시스템별 현황',40,0,'NONE',4,'G3','33%','400px','0',NULL,'X','','N','20180827201100',NULL,0,NULL),(24,73,185,'G5','GRID','취약점별 현황',50,0,'NONE',4,'G4','34%','400px','0',NULL,'X','','N','20180827201100',NULL,0,NULL),(24,75,186,'G1','CONDITION','',10,0,'NONE',4,'','100%','90px','0',NULL,'X','','N','20181114075304',NULL,0,NULL),(24,75,187,'G2','CHARTBAR','팀별 현황 (보안취약점 갯수)1',20,0,'NONE',4,'G1','100%','800px','0',NULL,'X','RIGHT','N','20181114075304',NULL,0,NULL),(24,75,188,'G3','GRID','팀별 현황 (보안취약점 갯수)2',30,0,'NONE',4,'G1','33%','400px','0',NULL,'X','','N','20181114075304',NULL,0,NULL),(24,75,189,'G4','GRID','시스템별 현황',40,0,'NONE',4,'G3','33%','400px','0',NULL,'X','','N','20181114075304',NULL,0,NULL),(24,75,190,'G5','GRID','취약점별 현황',50,0,'NONE',4,'G4','34%','400px','0',NULL,'X','','N','20181114075305',NULL,0,NULL),(3,79,196,'G1','CONDITION','컨디션',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20190615170333','20190624234351',0,NULL),(3,79,197,'G2','GRID','그리드',20,0,'NONE',4,'G1','50%','200px','0',NULL,'X','','','20190615170334','20190808225139',0,NULL),(3,79,198,'G3','FORMVIEW','폼뷰',30,0,'NONE',4,'G2','50%','200px','0',NULL,'X','','','20190615170334','20190808225139',0,NULL),(3,79,199,'G4','BIVIEW','a',15,0,'NONE',4,'G1','25%','83px','0',NULL,'X','','','20190624205958','20190812125154',0,NULL),(3,79,200,'G6','BIVIEW','c',17,0,'NONE',4,'G1','25%','83px','0',NULL,'X','','','20190625001343','20190812125154',0,NULL),(3,79,201,'G5','BIVIEW','b',16,0,'NONE',4,'G1','25%','83px','0',NULL,'X','','','20190625001343','20190812125154',0,NULL),(3,79,202,'G7','BIVIEW','d',18,0,'NONE',4,'G1','25%','83px','0',NULL,'','','','20190625072319','20190812125154',0,NULL),(3,86,203,'G1','CONDITION','1',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20190705221151',NULL,0,NULL),(3,86,204,'G2','GRID','마스터',20,0,'NONE',4,'G1','30%','500px','0',NULL,'X','0','N','20190705221152',NULL,0,NULL),(3,87,205,'G1','CONDITION','1',10,0,'NONE',4,'','100%','80px','0',NULL,'X','0','N','20190705221249',NULL,0,NULL),(3,87,206,'G2','GRID','마스터',20,0,'NONE',4,'G1','30%','500px','0',NULL,'X','0','N','20190705221251',NULL,0,NULL),(3,87,207,'G3','GRID','상세',30,0,'NONE',4,'G2','70%','500px','0',NULL,'X','0','N','20190705221254',NULL,0,NULL),(3,87,208,'G4','FORMVIEW','상세폼',40,0,'NONE',4,'G2','100%','200px','0',NULL,'X','','','20190705221258',NULL,0,NULL),(3,79,213,'G8','BTTABLE','BT그리드',50,NULL,'NONE',4,'G1','100%','30px','0',NULL,'X','','','20190808224158','20190808224222',0,NULL),(3,96,214,'G1','CONDITION','검색',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20190828074705','20190829203844',0,NULL),(3,96,215,'G2','GRIDBT','PGM목록',20,0,'NONE',4,'G1','50%','600','0',NULL,'X','','','20190828074705','20190829204453',0,NULL),(3,96,216,'G3','FORMVIEW','PGM상세',30,0,'NONE',4,'G2','50%','600px','0',NULL,'X','','','20190828074705','20190829204419',0,NULL),(3,95,217,'G1','CONDITION','조건',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20190829211243',NULL,0,NULL),(3,95,218,'G2','GRIDBT','GRP목록',20,0,'NONE',4,'G1','50%','600','0',NULL,'X','','','20190829211243',NULL,0,NULL),(3,95,219,'G3','FORMVIEW','GRP상세',30,0,'NONE',4,'G2','50%','600px','0',NULL,'X','','','20190829211243','20190829213614',0,NULL),(3,93,220,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20190902203014',NULL,0,NULL),(3,93,221,'G2','GRIDBT','',20,0,'NONE',4,'G1','50%','500','0',NULL,'X','','','20190902203014','20190902204716',0,NULL),(3,93,222,'G3','FORMVIEW','',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20190902203014','20190902204717',0,NULL),(3,90,223,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20190902205319',NULL,0,NULL),(3,90,224,'G2','GRIDBT','',20,0,'NONE',4,'G1','50%','500','0',NULL,'X','','','20190902205319','20190902205404',0,NULL),(3,90,225,'G3','FORMVIEW','',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20190902205319','20190902205404',0,NULL),(3,94,226,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20190902211023',NULL,0,NULL),(3,94,227,'G2','GRIDBT','',20,0,'NONE',4,'G1','50%','500','0',NULL,'X','','','20190902211023',NULL,0,NULL),(3,94,228,'G3','FORMVIEW','',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20190902211023',NULL,0,NULL),(94,97,229,'G1','CONDITION','',10,NULL,'NONE',4,'','100%','80px','0',NULL,'X','','','20190902212831',NULL,0,NULL),(94,97,230,'G2','GRIDBT','',20,NULL,'NONE',4,'G1','50%','500','0',NULL,'X','','','20190902212832',NULL,0,NULL),(94,97,231,'G3','FORMVIEW','',30,NULL,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20190902212835',NULL,0,NULL),(3,98,232,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20190902213020',NULL,0,NULL),(3,98,233,'G2','GRIDBT','',20,0,'NONE',4,'G1','50%','500','0',NULL,'X','','','20190902213020',NULL,0,NULL),(3,98,234,'G3','FORMVIEW','',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20190902213020',NULL,0,NULL),(3,89,235,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20190902215343',NULL,0,NULL),(3,89,236,'G2','GRIDBT','',20,0,'NONE',4,'G1','50%','500','0',NULL,'X','','','20190902215343',NULL,0,NULL),(3,89,237,'G3','FORMVIEW','',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20190902215343',NULL,0,NULL),(3,92,238,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20190902220724',NULL,0,NULL),(3,92,239,'G2','GRIDBT','',20,0,'NONE',4,'G1','50%','500','0',NULL,'X','','','20190902220724',NULL,0,NULL),(3,92,240,'G3','FORMVIEW','',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20190902220725',NULL,0,NULL),(3,91,241,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20190902222818',NULL,0,NULL),(3,91,242,'G2','GRIDBT','',20,0,'NONE',4,'G1','50%','500','0',NULL,'X','','','20190902222818','20190902222840',0,NULL),(3,91,243,'G3','FORMVIEW','',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20190902222818','20190902222840',0,NULL),(3,100,247,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20191118102300','20191118134104',0,NULL),(3,100,248,'G2','GRID','로그',20,0,'NONE',4,'G1','60%','500px','0',NULL,'X','','','20191118102300','20191118181631',0,NULL),(3,100,249,'G3','FORMVIEW','상세',30,NULL,'NONE',4,'G2','40%','500px','0',NULL,'X','','','20191118181631',NULL,0,NULL),(3,102,255,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20200209205622',NULL,0,NULL),(3,102,256,'G2','GRID','프로젝트목록',20,0,'NONE',4,'G1','50%','500px','0',NULL,'X','','','20200209205622','20200209211919',0,NULL),(3,102,257,'G3','FORMVIEW','배포 상세',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20200209205622','20200209211919',0,NULL),(3,103,258,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20200210080021',NULL,0,NULL),(3,103,259,'G2','GRID','테이블목록',20,0,'NONE',4,'G1','50%','500px','0',NULL,'X','','','20200210080021','20200210082044',0,NULL),(3,103,260,'G3','FORMVIEW','테이블상세',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20200210080021','20200210082044',0,NULL),(3,104,261,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','N','20200228070832',NULL,0,NULL),(3,104,263,'G2','GRID','PGM',20,0,'NONE',4,'G1','50%','250px','0',NULL,'X','','N','20200228070832','20200229105242',0,NULL),(3,104,264,'G4','GRID','AUTH',40,0,'NONE',4,'G1','50%','250px','0',NULL,'X','','N','20200228070833','20200229105242',0,NULL),(3,104,265,'G3','GRID','SVC MENU',30,NULL,'NONE',4,'G1','50%','250px','0',NULL,'X','','','20200229105242','20200229133120',0,NULL),(3,104,266,'G5','GRID','SVC AUTH',50,NULL,'NONE',4,'G1','50%','250px','0',NULL,'X','','','20200229105242','20200229133422',0,NULL),(3,105,267,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20200312064346',NULL,0,NULL),(3,105,268,'G2','BIVIEW','1',20,0,'NONE',4,'G1','25%','80px','0',NULL,'X','','','20200312064346','20200313033035',0,NULL),(3,105,269,'G3','BIVIEW','2',30,0,'NONE',4,'G1','25%','80px','0',NULL,'X','','','20200312064346','20200313033035',0,NULL),(3,105,270,'G4','BIVIEW','3',40,NULL,'NONE',4,'G1','25%','80px','0',NULL,'X','','','20200312064346','20200313033035',0,NULL),(3,105,271,'G5','BIVIEW','4',50,NULL,'NONE',4,'G1','25%','80px','0',NULL,'X','','','20200312064346','20200313033035',0,NULL),(3,105,272,'G6','CHARTBAR','6',60,NULL,'NONE',4,'G1','100%','200px','0',NULL,'X','','','20200313033229','20200313034335',0,NULL),(3,48,273,'G4','GRID','메뉴폴더별건수',40,NULL,'NONE',4,'G1','50%','300px','0',NULL,'X','','','20200317215356',NULL,0,NULL),(3,48,274,'G5','FORMVIEW','변경할 폴더',50,NULL,'START',4,'','50%','80px','0',NULL,'X','','','20200317215441','20200318070130',0,NULL),(3,48,275,'G6','GRID','건수의 폴더',60,NULL,'END',4,'G4','50%','220px','0',NULL,'X','','','20200317221014',NULL,0,NULL),(3,106,276,'G1','CONDITION','',10,0,'NONE',4,'','100%','80px','0',NULL,'X','','','20200320070354',NULL,0,NULL),(3,106,277,'G2','GRID','',20,0,'NONE',4,'G1','50%','500px','0',NULL,'X','','','20200320070354','20200321093842',0,NULL),(3,106,278,'G3','FORMVIEW','',30,0,'NONE',4,'G2','50%','500px','0',NULL,'X','','','20200320070354','20200321093842',0,NULL);
/*!40000 ALTER TABLE `CG_PGMGRP` ENABLE KEYS */;
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
