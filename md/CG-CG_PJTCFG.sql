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
-- Table structure for table `CG_PJTCFG`
--

DROP TABLE IF EXISTS `CG_PJTCFG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_PJTCFG` (
  `CFGSEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PJTSEQ` int(11) NOT NULL,
  `CFGID` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `CFGNM` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `MVCGBN` varchar(30) COLLATE utf8_bin NOT NULL,
  `CFGORD` int(11) NOT NULL,
  `PATH` varchar(300) COLLATE utf8_bin NOT NULL,
  `USEYN` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'Y',
  `ADDDT` varchar(14) COLLATE utf8_bin NOT NULL,
  `ADDID` int(11) NOT NULL,
  `MODID` int(11) DEFAULT NULL,
  `MODDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`CFGSEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_PJTCFG`
--

LOCK TABLES `CG_PJTCFG` WRITE;
/*!40000 ALTER TABLE `CG_PJTCFG` DISABLE KEYS */;
INSERT INTO `CG_PJTCFG` VALUES (3,3,'JqueryCore','JQUERY CORE','JAVASCRIPT',20,'lib/jquery/jquery-3.4.1.min.js','Y','20150111161044',0,1,'20191214141706'),(6,3,'JqueryJson','JQUERY JSON','JAVASCRIPT',50,'lib/json2.min.js','Y','20150111164611',0,1,'20191214141706'),(7,3,'DhtmlxJs','DHTMLX CORE','JAVASCRIPT',60,'lib/dhtmlxSuite/codebase/dhtmlx.js','Y','20150111164716',0,1,'20191214141706'),(8,3,'DhtmlxCss','DHTMLX CORE','CSS',70,'lib/dhtmlxSuite/codebase/dhtmlx.css','Y','20150111164747',0,1,'20191214141706'),(10,3,'PhpLibUtil','CG UTIL','CONTROL',10,'../../common/include/incUtil.php','Y','20150111165127',0,1,'20191210214118'),(11,3,'PhpLibDb','CG DB','CONTROL',20,'../../common/include/incDB.php','Y','20150111165127',0,1,'20191210214118'),(12,3,'PhpConfig','CG CONFIG','CONTROL_CFG',30,'../../common/include/incConfig.php','Y','20150111165127',0,1,'20191214141706'),(13,3,'DhtmlxImg','DHTMLX IMG','HTML',10,'lib/dhtmlxSuite/codebase/imgs/','Y','20150111181234',0,1,'20191214141706'),(16,3,'Jquery UI','JQUERY UI','JAVASCRIPT',25,'lib/jquery/jquery-ui.min.js','Y','20171208115118',0,1,'20191214141706'),(17,3,'Jquery ui css','JQUERY UI','CSS',70,'lib/jquery/jquery-ui.min.css','Y','20171208115619',0,1,'20191214141706'),(18,3,'PhpLibSec','CG SEC','CONTROL',25,'../../common/include/incSec.php','Y','20180115123515',0,1,'20191210214118'),(19,3,'SafeHtml','HTML Purifier','CONTROL_XSS',10,'../../lib/php/htmlpurifier-4.9.3/library/HTMLPurifier.auto.php','N','20180131232831',0,1,'20191210214412'),(20,3,'PhpLibUser','CG USER','CONTROL',40,'../../common/include/incUser.php','Y','20180312225045',0,1,'20191210214118'),(21,3,'PhpLibSqlParser','CG SQLParser','CONTROL',23,'../../lib/php/PHP-SQL-Parser/src/PHPSQLParser.php','N','20180316233932',0,1,'20191210214412'),(22,3,'PhpLibAuth','CG AUTH','CONTROL',32,'../../common/include/incAuth.php','Y','20180318225309',0,1,'20191210214412'),(23,3,'PhpLibRequest','CG REQUEST','CONTROL',15,'../../common/include/incRequest.php','Y','20180320081928',0,1,'20191210214412'),(25,3,'Chart.js','Chart.js','JAVASCRIPT',70,'lib/Chart.min.js','Y','20180515212647',1,1,'20191214141707'),(26,3,'Moment','Moment Date','JAVASCRIPT',90,'lib/moment.min.js','Y','20180517072912',1,1,'20191214141707'),(27,0,'JqueryCore','JQUERY CORE','JAVASCRIPT',20,'../lib/jquery-1.11.1.min.js','Y','20180712173733',1,NULL,NULL),(28,0,'JqueryJson','JQUERY JSON','JAVASCRIPT',50,'../lib/json2.min.js','Y','20180712173733',1,NULL,NULL),(29,0,'DhtmlxJs','DHTMLX CORE','JAVASCRIPT',60,'../lib/dhtmlxSuite/codebase/dhtmlx.js','Y','20180712173733',1,NULL,NULL),(30,0,'DhtmlxCss','DHTMLX CORE','CSS',70,'../lib/dhtmlxSuite/codebase/dhtmlx.css','Y','20180712173733',1,NULL,NULL),(31,0,'DhtmlxExt','DHTMLX EXT','JAVASCRIPT',80,'../common/common.js','Y','20180712173733',1,NULL,NULL),(32,0,'PhpLibUtil','CG UTIL','CONTROL',10,'../include/incUtil.php','Y','20180712173733',1,NULL,NULL),(33,0,'PhpLibDb','CG DB','CONTROL',20,'../include/incDB.php','Y','20180712173734',1,NULL,NULL),(34,0,'PhpConfig','CG CONFIG','CONTROL',30,'../incConfig.php','Y','20180712173734',1,NULL,NULL),(35,0,'DhtmlxImg','DHTMLX IMG','HTML',10,'../lib/dhtmlxSuite/codebase/imgs/','Y','20180712173734',1,NULL,NULL),(36,0,'Jquery UI','JQUERY UI','JAVASCRIPT',25,'../lib/jquery-ui-1.11.1.min.js','Y','20180712173734',1,NULL,NULL),(37,0,'Jquery ui css','JQUERY UI','CSS',70,'../lib/jquery-ui-1.8.18.css','Y','20180712173734',1,NULL,NULL),(38,0,'PhpLibSec','CG SEC','CONTROL',25,'../include/incSEC.php','Y','20180712173734',1,NULL,NULL),(39,0,'SafeHtml','HTML Purifier','CONTROL_XSS',10,'../lib/htmlpurifier-4.9.3/library/HTMLPurifier.auto.php','Y','20180712173734',1,NULL,NULL),(40,0,'PhpLibUser','CG USER','CONTROL',40,'../include/incUser.php','Y','20180712173734',1,NULL,NULL),(41,0,'PhpLibSqlParser','CG SQLParser','CONTROL',23,'../lib/PHP-SQL-Parser/src/PHPSQLParser.php','N','20180712173734',1,NULL,NULL),(42,0,'PhpLibAuth\'','CG AUTH','CONTROL',27,'../include/incAuth.php','Y','20180712173734',1,NULL,NULL),(43,0,'PhpLibRequest','CG REQUEST','CONTROL',15,'../include/incRequest.php','Y','20180712173734',1,NULL,NULL),(44,0,'ChartUtil.js','Chart.js','JAVASCRIPT',75,'/chartjs_util.js','Y','20180712173734',1,NULL,NULL),(45,0,'Chart.js','Chart.js','JAVASCRIPT',70,'/lib/chart.min.js','Y','20180712173734',1,NULL,NULL),(46,0,'Moment','Moment Date','JAVASCRIPT',90,'/lib/moment.min.js','Y','20180712173734',1,NULL,NULL),(47,5,'JqueryCore','JQUERY CORE','JAVASCRIPT',20,'../lib/jquery-1.11.1.min.js','Y','20180716084657',1,NULL,NULL),(48,5,'JqueryJson','JQUERY JSON','JAVASCRIPT',50,'../lib/json2.min.js','Y','20180716084718',1,NULL,NULL),(49,5,'DhtmlxJs','DHTMLX CORE','JAVASCRIPT',60,'../lib/dhtmlxSuite/codebase/dhtmlx.js','Y','20180716084719',1,NULL,NULL),(50,5,'DhtmlxCss','DHTMLX CORE','CSS',70,'../lib/dhtmlxSuite/codebase/dhtmlx.css','Y','20180716084719',1,NULL,NULL),(51,5,'DhtmlxExt','DHTMLX EXT','JAVASCRIPT',80,'../common/common.js','Y','20180716084719',1,NULL,NULL),(52,5,'PhpLibUtil','CG UTIL','CONTROL',10,'../include/incUtil.php','Y','20180716084719',1,NULL,NULL),(53,5,'PhpLibDb','CG DB','CONTROL',20,'../include/incDB.php','Y','20180716084719',1,NULL,NULL),(54,5,'PhpConfig','CG CONFIG','CONTROL',30,'../incConfig.php','Y','20180716084719',1,NULL,NULL),(55,5,'DhtmlxImg','DHTMLX IMG','HTML',10,'../lib/dhtmlxSuite/codebase/imgs/','Y','20180716084719',1,NULL,NULL),(56,5,'Jquery UI','JQUERY UI','JAVASCRIPT',25,'../lib/jquery-ui-1.11.1.min.js','Y','20180716084719',1,NULL,NULL),(57,5,'Jquery ui css','JQUERY UI','CSS',70,'../lib/jquery-ui-1.8.18.css','Y','20180716084719',1,NULL,NULL),(58,5,'PhpLibSec','CG SEC','CONTROL',25,'../include/incSEC.php','Y','20180716084719',1,NULL,NULL),(59,5,'SafeHtml','HTML Purifier','CONTROL_XSS',10,'../lib/htmlpurifier-4.9.3/library/HTMLPurifier.auto.php','Y','20180716084719',1,NULL,NULL),(60,5,'PhpLibUser','CG USER','CONTROL',40,'../include/incUser.php','Y','20180716084719',1,NULL,NULL),(61,5,'PhpLibSqlParser','CG SQLParser','CONTROL',23,'../lib/PHP-SQL-Parser/src/PHPSQLParser.php','N','20180716084719',1,NULL,NULL),(62,5,'PhpLibAuth\'','CG AUTH','CONTROL',27,'../include/incAuth.php','Y','20180716084719',1,NULL,NULL),(63,5,'PhpLibRequest','CG REQUEST','CONTROL',15,'../include/incRequest.php','Y','20180716084719',1,NULL,NULL),(64,5,'ChartUtil.js','Chart.js','JAVASCRIPT',75,'/chartjs_util.js','Y','20180716084719',1,NULL,NULL),(65,5,'Chart.js','Chart.js','JAVASCRIPT',70,'/lib/chart.min.js','Y','20180716084719',1,NULL,NULL),(66,5,'Moment','Moment Date','JAVASCRIPT',90,'/lib/moment.min.js','Y','20180716084719',1,NULL,NULL),(67,24,'JqueryCore','JQUERY CORE','JAVASCRIPT',20,'../lib/jquery-1.11.1.min.js','Y','20180716113657',1,NULL,NULL),(68,24,'JqueryJson','JQUERY JSON','JAVASCRIPT',50,'../lib/json2.min.js','Y','20180716113657',1,NULL,NULL),(69,24,'DhtmlxJs','DHTMLX CORE','JAVASCRIPT',60,'../lib/dhtmlxSuite/codebase/dhtmlx.js','Y','20180716113657',1,NULL,NULL),(70,24,'DhtmlxCss','DHTMLX CORE','CSS',70,'../lib/dhtmlxSuite/codebase/dhtmlx.css','Y','20180716113657',1,NULL,NULL),(71,24,'DhtmlxExt','DHTMLX EXT','JAVASCRIPT',80,'../common/common.js','Y','20180716113657',1,NULL,NULL),(72,24,'PhpLibUtil','CG UTIL','CONTROL',30,'../include/incUtil.php','Y','20180716113657',1,1,'20190812113858'),(73,24,'PhpLibDb','CG DB','CONTROL',40,'../include/incDB.php','Y','20180716113657',1,1,'20190812113858'),(74,24,'PhpConfig','CG CONFIG','CONTROL_CFG',10,'./incConfig.{P.PJTID}.php','Y','20180716113657',1,1,'20190812113858'),(75,24,'DhtmlxImg','DHTMLX IMG','HTML',10,'../lib/dhtmlxSuite/codebase/imgs/','Y','20180716113657',1,NULL,NULL),(76,24,'Jquery UI','JQUERY UI','JAVASCRIPT',25,'../lib/jquery-ui-1.11.1.min.js','Y','20180716113657',1,NULL,NULL),(77,24,'Jquery ui css','JQUERY UI','CSS',70,'../lib/jquery-ui-1.8.18.css','Y','20180716113657',1,NULL,NULL),(78,24,'PhpLibSec','CG SEC','CONTROL',20,'../include/incSec.php','Y','20180716113657',1,1,'20190812113858'),(79,24,'SafeHtml','HTML Purifier','CONTROL_XSS',10,'../lib/htmlpurifier-4.9.3/library/HTMLPurifier.auto.php','Y','20180716113657',1,NULL,NULL),(80,24,'PhpLibUser','CG USER','CONTROL',40,'../include/incUser.php','Y','20180716113657',1,NULL,NULL),(81,24,'PhpLibSqlParser','CG SQLParser','CONTROL',23,'../lib/PHP-SQL-Parser/src/PHPSQLParser.php','N','20180716113657',1,NULL,NULL),(82,24,'PhpLibAuth\'','CG AUTH','CONTROL',27,'../include/incAuth.php','Y','20180716113658',1,NULL,NULL),(83,24,'PhpLibRequest','CG REQUEST','CONTROL',15,'../include/incRequest.php','Y','20180716113658',1,NULL,NULL),(84,24,'ChartUtil.js','Chart.js','JAVASCRIPT',75,'/c.g/common/chartjs_util.js','Y','20180716113658',1,1,'20190825135716'),(85,24,'Chart.js','Chart.js','JAVASCRIPT',70,'/lib/chart.min.js','Y','20180716113658',1,NULL,NULL),(86,24,'Moment','Moment Date','JAVASCRIPT',90,'/lib/moment.min.js','Y','20180716113658',1,NULL,NULL),(87,3,'hashmap.js','HASHMAP','JAVASCRIPT',55,'lib/hashmap.js','Y','20190322204636',0,1,'20191214141707'),(88,24,'HashMap','HASH MAP','JAVASCRIPT',55,'/lib/hashmap.js','Y','20190322205943',0,NULL,NULL),(89,3,'FeatherIconCss','FEATHER ICON CSS','CSS',0,'/common/common.css','N','20190623210454',0,1,'20200206081511'),(90,3,'FeatherIconJs','FEATHER ICON JS','JAVASCRIPT',0,'lib/feather.min.js','Y','20190623210454',0,1,'20191214141707'),(91,3,'BootStrapV4','BOOTSTRAP V4','CSS',80,'lib/bootstrap4/css/bootstrap.min.css','Y','20190808214554',1,1,'20191214141706'),(92,3,'Bt4TableCss','BT4 Table CSS','CSS',90,'lib/bootstrap-table/bootstrap-table.min.css','Y','20190808220145',1,1,'20191214141706'),(93,3,'BT4TableJsLang','BT4 Table JS Lang','JAVASCRIPT',130,'lib/bootstrap-table/locale/bootstrap-table-ko-KR.min.js','Y','20190808220359',1,1,'20191214141707'),(94,3,'Bt4TableJs','BT4 Table JS','JAVASCRIPT',120,'lib/bootstrap-table/bootstrap-table.min.js','Y','20190808220359',1,1,'20191214141707'),(95,24,'FeatherIcon','FEATHER ICON','JAVASCRIPT',75,'/lib/feather.min.js','Y','20190812113505',1,NULL,NULL),(96,24,'BT4TableJs','BT4 Table JS','JAVASCRIPT',120,'/lib/bootstrap-table/bootstrap-table.min.js','Y','20190825135716',1,NULL,NULL),(97,24,'BT4TableJsLang','BT4 Table JS Lang','JAVASCRIPT',130,'/lib/bootstrap-table/locale/bootstrap-table-ko-KR.min.js','Y','20190825135716',1,NULL,NULL),(98,24,'BootStrapV4','부트스트랩4','CSS',80,'/lib/bootstrap4/css/bootstrap.min.css','Y','20190825135906',1,NULL,NULL),(99,24,'Bt4TableCss','BT4 Table CSS','CSS',90,'/lib/bootstrap-table/bootstrap-table.min.css','Y','20190825135906',1,NULL,NULL),(100,24,'tableExportFileSaver','BT4 EXPORT SAVER','JAVASCRIPT',15,'/lib/tableExport/FileSaver.min.js','Y','20190825155517',1,NULL,NULL),(101,24,'tableExportJs','BT4 EXPORT','JAVASCRIPT',16,'/lib/tableExport/tableExport.min.js','Y','20190825155517',1,NULL,NULL),(102,3,'Bt4TableExportSaver','BT4 TABLE EXPORT SAVER','JAVASCRIPT',25,'lib/tableExport/FileSaver.min.js','Y','20190825160012',1,1,'20191214141707'),(103,3,'Bt4TableExport','BT4 TABLE EXPORT','JAVASCRIPT',26,'lib/tableExport/tableExport.min.js','Y','20190825160012',1,1,'20191214141707'),(104,3,'CodeMirrorCss','CODE MIRROR CSS','CSS',210,'lib/codemirror/lib/codemirror.css','Y','20190904203214',1,1,'20191214141706'),(105,3,'CodeMirrorJs3','CODE MIRROR3','JAVASCRIPT',220,'lib/codemirror/addon/selection/active-line.js','Y','20190904203214',1,1,'20191214141707'),(106,3,'CodeMirrorJs2','CODE MIRROR2','JAVASCRIPT',210,'lib/codemirror/mode/sql/sql.js','Y','20190904203215',1,1,'20191214141707'),(107,3,'CodeMirrorJs1','CODE MIRROR1','JAVASCRIPT',200,'lib/codemirror/lib/codemirror.js','Y','20190904203215',1,1,'20191214141707');
/*!40000 ALTER TABLE `CG_PJTCFG` ENABLE KEYS */;
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
