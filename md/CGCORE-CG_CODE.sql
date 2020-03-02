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
-- Table structure for table `CG_CODE`
--

DROP TABLE IF EXISTS `CG_CODE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_CODE` (
  `PCD` varchar(30) COLLATE utf8_bin NOT NULL,
  `PNM` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `PCDDESC` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `ORD` int(11) NOT NULL DEFAULT '1',
  `UITOOL` varchar(300) COLLATE utf8_bin NOT NULL,
  `USEYN` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'N',
  `DELYN` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'N',
  `ADDDT` varchar(14) COLLATE utf8_bin NOT NULL,
  `MODDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`PCD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_CODE`
--

LOCK TABLES `CG_CODE` WRITE;
/*!40000 ALTER TABLE `CG_CODE` DISABLE KEYS */;
INSERT INTO `CG_CODE` VALUES ('BGCOL','브레이크ROW COL','',11,'','Y','N','20140701193530','20190809072755'),('BINDDATATYPE','SQL바인딩데이터타입','',10,'','Y','N','20140803140304','20190610212524'),('BODYHTML','바디HTML','',11,'','Y','N','20141103163300','20190610212524'),('BODYTYPE','바디타입','',45,'','Y','N','20141103163300',NULL),('BRCOL','브레이크ROW COL','',36,'','Y','N','20140701193720',''),('BRGRP','브레이크ROWGRP','',36,'','Y','N','20140701193530',''),('COLSIZETYPE','컬럼사이즈타입','퍼센트P, 픽셀X',35,'','Y','N','20141212223349',NULL),('COLSORT','그리드컬럼SORT기준','',44,'','Y','N','20141209201250',NULL),('CONCOLTYPE','컨디션컬럼타입','',35,'','Y','N','20140628132559',''),('CRUD','CRUD','',38,'','Y','N','20141027222324',NULL),('CRUDTYPE','기능구분','',36,'','Y','N','20140628133232',''),('CRYPT','암호화','',39,'','Y','N','20180114231444',NULL),('CTBIVIEW','BI뷰','',65,'','Y','N','20190624232842','20190809072755'),('CTCHARTBAR','챠트 BAR','',35,'','Y','N','20180515205430','20180524080550'),('CTCHARTPIE','챠트 PIE','',53,'','Y','N','20180518082919','20180524080550'),('CTCONDITION','(컬럼타입)컨디션','',43,'','Y','N','20141103100605',NULL),('CTFORMVIEW','(컬럼타입)폼뷰','',63,'','Y','N','20141103100605',NULL),('CTGRID','(컬럼타입)그리드','',53,'','Y','N','20141103100605',NULL),('CTGRIDBT','부트스트랩Table','',1,'','Y','N','20190809202858',NULL),('DATATYPE','데이터 타입','',51,'','Y','N','20140628091308','20190610223430'),('DHTMLX','수정이력','',35,'','Y','N','20140629132818','20140629132830'),('EVTBIVIEW','이벤트BIVIEW','',2,'','Y','N','20191223163232',NULL),('EVTGRID','이벤트 GRID','',1,'','Y','N','20191223111320',NULL),('FILETYPE','파일타입','',35,'','Y','N','20141103153514',NULL),('FNC','기능','2',36,'','Y','N','20141026203958','20190608110328'),('FNCBIVIEW','BI뷰 기능','',80,'','Y','N','20190625000033',NULL),('FNCBTN','버튼 기능','',35,'','Y','N','20141027210449',NULL),('FNCCHARTBAR','CHARTBAR','',34,'','Y','N','20180515205344',NULL),('FNCCHARTBAR2Y','CHARTBAR y좌우축','',43,'','Y','N','20180720114238','20180720114300'),('FNCCHARTPIE','챠트파이 기능','',43,'','Y','N','20180518083028',NULL),('FNCCONDITION','컨디션 기능','',35,'','Y','N','20141027210449',NULL),('FNCFORMVIEW','폼뷰 기능','',37,'','Y','N','20141027210449',NULL),('FNCGRID','그리드 기능','',36,'','Y','N','20141027210449',NULL),('FNCGRIDBT','부트스트랩Table','',10,'','Y','Y','20190809202740',NULL),('FNCHTML','화면기능전체','',43,'','Y','N','20141101175802',NULL),('FNCJS','화면스크립트','',43,'','Y','N','20141101173803','20190809072755'),('FNCTYPE','기능종류','INPUT,OUTPUT,SAVE,ETC,SVRSVC',35,'','Y','N','20141101194121','20190809072755'),('FORMENCTYPE','FORM_ENCTYPE','FORM ENCTYPE',43,'','Y','N','20171214104051',NULL),('GRIDCOLTYPE','그리드컬럼타입Q','http://docs.dhtmlx.com/grid__columns_types.html',34,'','Y','N','20140628080423','20140628100019'),('GRIDFOOTER','그리드푸터','',34,'','Y','N','20180827203358',NULL),('GRIDSORT','그리드 정렬 타입 종류','http://docs.dhtmlx.com/grid__sorting.html',34,'','Y','N','20140711202125','20140711202155'),('GRPTYPE','그룹타입','',36,'','Y','N','20140628102025',''),('LANGUI','서버언어 및 UI툴','',36,'','Y','Y','20160111110717',NULL),('LEGENDALIGN','챠트 라벨위치','',43,'','Y','N','20180523082816',NULL),('MVCGBN','MVCGBN','IMPORT 구분',43,'','Y','N','20150111154955','20150111155019'),('OBJALIGN','가로정렬ㅇ','',34,'','Y','N','20140628135602',''),('OBJFORMAT','IOFORMAT','',11,'','Y','N','20200302072003',NULL),('PCD','BBB',NULL,36,'','1','N','20140625053816',''),('PGMTYPE','PGMTYPE','NORMAL,POPUP',35,'','Y','N','20180329192430','20180523080218'),('PHPERRTYPE','PHP에러타입','',43,'','Y','N','20160415122441',NULL),('PHPFILEEXT','PHP파일 타입','',34,'','Y','N','20140629104913',''),('POPUPCD','팝업CD/NM','',43,'','Y','N','20180523080301',NULL),('REQDATATYPE','REQDATATYPE','APP_API REQ DATATYPE',43,'','Y','N','20171214103309','20171214103335'),('RTN_TYPE','DAO 리턴타입','DAO 리턴타입 (INT, MAP, LIST)',34,'','Y','N','20160328015056',NULL),('SECTYPE','보안타입','',88,'','Y','N','20180405212653',NULL),('SQLGBN','SQL입력력구분','',43,'','Y','N','20150111190813',NULL),('SQLROLETYPE','SQL역할','',34,'','Y','N','20190606205611','20190809072755'),('SRCINPUT','소스 INPUT','SRCINFO 의 INPUT 종류',34,'','Y','N','20140630190231',''),('UILANG','UILANG','',35,'','Y','N','20160111112121',NULL),('VALIDACTION','실패/성공액션','',73,'','Y','N','20141213214348','20190809072755'),('VALIDJOBTYPE','처리 방법','',53,'','Y','N','20141213214348',NULL),('VALIDOPER','연산자/정규식','',63,'','Y','N','20141213214348',NULL),('VALIDTIMETYPE','전처리/후처리','',43,'','Y','N','20141213214348',NULL),('VALIDTYPE','입력값검증타입','',43,'','Y','N','20180129102045',NULL),('VBOX','VBOX','',35,'','Y','N','20180401152156','20180401152916'),('YN','YN','',1,'','Y','N','20190916223016',NULL);
/*!40000 ALTER TABLE `CG_CODE` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-03  7:09:57
