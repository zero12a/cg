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
-- Table structure for table `CG_OBJINFO`
--

DROP TABLE IF EXISTS `CG_OBJINFO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_OBJINFO` (
  `OBJSEQ` int(11) NOT NULL AUTO_INCREMENT,
  `OBJTYPE` varchar(30) COLLATE utf8_bin NOT NULL,
  `DELYN` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'N',
  `USEYN` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'Y',
  `DEPLOYHASH` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `DEPLOYDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `LOADHASH` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `LOADDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `ADDDT` varchar(14) COLLATE utf8_bin NOT NULL,
  `MODDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`OBJSEQ`),
  UNIQUE KEY `OBJTYPE` (`OBJTYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_OBJINFO`
--

LOCK TABLES `CG_OBJINFO` WRITE;
/*!40000 ALTER TABLE `CG_OBJINFO` DISABLE KEYS */;
INSERT INTO `CG_OBJINFO` VALUES (3,'AHTML','N','Y','af293337b047e5eee45cdeaca8b965c38676d04f0d9cb75f8495346a94d77f81','20191029213156','af293337b047e5eee45cdeaca8b965c38676d04f0d9cb75f8495346a94d77f81','20191029212958','20141110213802',NULL),(4,'AJS','N','Y','99a9edb230ffefd16180d07aec4b54ff91d1a36ddcc839dc4d566b70cfd3ccab','20191029213156','99a9edb230ffefd16180d07aec4b54ff91d1a36ddcc839dc4d566b70cfd3ccab','20191029213000','20171211114408',NULL),(5,'ASVRCTL','N','Y','b1b06a5208b80cd856149527435e5e01b8b8bf1de8d1a9a209d4012c7f73758b','20191029213156','b1b06a5208b80cd856149527435e5e01b8b8bf1de8d1a9a209d4012c7f73758b','20191029213005','20141110213802',NULL),(6,'ASVRDAO','N','Y','5f68568f96dac6be4f24ce64706c8cfd161444779050af90d2443eb12d04c50f','20191029213157','5f68568f96dac6be4f24ce64706c8cfd161444779050af90d2443eb12d04c50f','20191029072817','20141110213802',NULL),(7,'ASVRSVC','N','Y','057451ac1c6de4f30ae4ec227f86818877dbaa074e7122a469980fe57cc9a42a','20191029213157','057451ac1c6de4f30ae4ec227f86818877dbaa074e7122a469980fe57cc9a42a','20191029213207','20141110213802',NULL),(8,'ASVRUFI','Y','Y',NULL,NULL,NULL,NULL,'20141119064037',NULL),(9,'BIVAL1A','N','Y','d500abcc9587a6793ebe41365a53e3b872d47b38e23d82c79fd83d54eac6c931','20191029213157','d500abcc9587a6793ebe41365a53e3b872d47b38e23d82c79fd83d54eac6c931','20191029072818','20190623175930',NULL),(10,'BIVAL1B','N','Y','b1789aa2b96a1f17ce2caf5c729e4acce57352f22faa56a41f83b02e8786a670','20191029213157','b1789aa2b96a1f17ce2caf5c729e4acce57352f22faa56a41f83b02e8786a670','20191029072818','20190623175930',NULL),(11,'BIVAL2C','N','Y','a8cbfde198c9f98c07a2c0d272b09988e050949eebb6fed6ef18dbb43ed9d5ca','20191029213157','a8cbfde198c9f98c07a2c0d272b09988e050949eebb6fed6ef18dbb43ed9d5ca','20191029072818','20190623175930',NULL),(12,'BIVAL2D','N','Y','98f5534000fa898a7944fe744f523f958c598db92f333bc7bd0e2631b91a3f7b','20191029213157','98f5534000fa898a7944fe744f523f958c598db92f333bc7bd0e2631b91a3f7b','20191029072818','20190623175931',NULL),(13,'BIVIEW','N','Y','01ec043ac7c86b50508a308f9eaa418dfcb1361fbaccf7c6a652abee5a8517bc','20191029213157','01ec043ac7c86b50508a308f9eaa418dfcb1361fbaccf7c6a652abee5a8517bc','20191029072818','20190624231313',NULL),(14,'BODYINIT','N','Y','6ad2ea4ed52e021bb458d19e90f9d9c730eebb3cbfc578d9bf8f48eb906076b2','20191029213157','6ad2ea4ed52e021bb458d19e90f9d9c730eebb3cbfc578d9bf8f48eb906076b2','20191029072818','20140712180905',NULL),(15,'BTN','Y','Y',NULL,NULL,NULL,NULL,'20141102214757','20141102214837'),(16,'BUTTON','N','Y','127a1db95214d7eba329ddabdb670e0d977e08846a8c3d93e631ab13a656c0af','20191029213157','127a1db95214d7eba329ddabdb670e0d977e08846a8c3d93e631ab13a656c0af','20191029072818','20141102215957','20141103104240'),(17,'CALENDAR','N','Y','5d80f29e3b30830eb26b380714ea4f1641d879de9f53be24100d7948d59144bc','20191029213158','5d80f29e3b30830eb26b380714ea4f1641d879de9f53be24100d7948d59144bc','20191029072818','20140702211044','20140713143554'),(18,'CHARTBAR','N','Y','0cf043050e8e4119af541757191d2634fdd85243be3984e22fbd64761e0baa00','20191029213158','0cf043050e8e4119af541757191d2634fdd85243be3984e22fbd64761e0baa00','20191029072818','20180515082303',NULL),(19,'CHARTBAR2Y','N','Y','1308073ae7618142747a2db42b0bddeb63af1e8cfc067d2457c066fcdd440835','20191029213158','1308073ae7618142747a2db42b0bddeb63af1e8cfc067d2457c066fcdd440835','20191029072818','20180720110432',NULL),(20,'CHARTPIE','N','Y','3bc194dbb24fa9966c6a3f670495c3960badb3a170c21e49518855cac4e7306b','20191029213158','3bc194dbb24fa9966c6a3f670495c3960badb3a170c21e49518855cac4e7306b','20191029072818','20180518080722',NULL),(21,'CODEMIRROR','N','Y','fc61e5c0a026a930f3dc219c79e13fc9abaf109cd282117f3c8f2c7e7c325c8f','20191029213158','fc61e5c0a026a930f3dc219c79e13fc9abaf109cd282117f3c8f2c7e7c325c8f','20191029072819','20140726143239','20140726172622'),(22,'CODESEARCH','N','Y','9c44b5c1d3915b0f48763dd850b9536bf5cd8778a9007785ee39468b83cca916','20191029213158','9c44b5c1d3915b0f48763dd850b9536bf5cd8778a9007785ee39468b83cca916','20191029072819','20180409153359',NULL),(23,'COMBO','N','Y','15348d21d81e991399d12363587ad95ceaa7f20913142ae7f13ddc7579808aa9','20191029213158','15348d21d81e991399d12363587ad95ceaa7f20913142ae7f13ddc7579808aa9','20191029213010','20140702212151','20140713143554'),(24,'CONDITION','N','Y','52ee23a5b59dd9bd96da1f859b53ccf7f1eeb48d8bf2fd2a928dc4d3a95be8e4','20191029213158','52ee23a5b59dd9bd96da1f859b53ccf7f1eeb48d8bf2fd2a928dc4d3a95be8e4','20191029213015','20140712141915','20190624235600'),(25,'FILE','N','Y','5aecd15428a82f560e19b3ae782a26e64e8b834bcd065878bce57daba4088e5e','20191029213158','5aecd15428a82f560e19b3ae782a26e64e8b834bcd065878bce57daba4088e5e','20191029072819','20171211105005',NULL),(26,'FORMVIEW','N','Y','36f9a000ead59dc3eb370ebedadfeefe9a5bc2f00aefade19f654c407f7fd5b2','20191029213159','36f9a000ead59dc3eb370ebedadfeefe9a5bc2f00aefade19f654c407f7fd5b2','20191029213025','20140712141843','20141101172406'),(27,'GRID','N','Y','23efe787e558f40313b9a2b1aa945e641ccda718bf6f4a5c355cdbdcde18f4bc','20191029213159','23efe787e558f40313b9a2b1aa945e641ccda718bf6f4a5c355cdbdcde18f4bc','20191029213044','20140703043808','20140713153059'),(28,'HIDDENLINK','N','Y','f85fef1257d8dc21a7291f7d9d7abe07f5ecb9d423ebbd251f40d1dedaae037e','20191029213159','f85fef1257d8dc21a7291f7d9d7abe07f5ecb9d423ebbd251f40d1dedaae037e','20191029072819','20190613214820',NULL),(29,'IMGVIEWER','N','Y','0f50598cfb3714d43a2e6b0f9068dc11c03b774d065490be9876794377b19d08','20191029213159','0f50598cfb3714d43a2e6b0f9068dc11c03b774d065490be9876794377b19d08','20191029072820','20171214114047',NULL),(30,'INPUTBOX','N','Y','f2e9f5e5145e9ffcd865b7274a27b9a84cd5370b8fab58f9136ddd8742591dd0','20191029213159','f2e9f5e5145e9ffcd865b7274a27b9a84cd5370b8fab58f9136ddd8742591dd0','20191029213047','20140701194818','20140713143554'),(31,'INPUTCHECK','N','Y','afe7002f100ac07b0ff7e3c17d9089e9ddf256fce06c9f55794f91750388fad0','20191029213159','afe7002f100ac07b0ff7e3c17d9089e9ddf256fce06c9f55794f91750388fad0','20191029072820','20190526143020',NULL),(32,'INPUTRADIO','N','Y','7b4ef5257f3f29a5d35019c8e938e1fdabf9ee7f324c2e7cb47da167975f59c7','20191029213159','7b4ef5257f3f29a5d35019c8e938e1fdabf9ee7f324c2e7cb47da167975f59c7','20191029072820','20190526143020',NULL),(33,'JSVRCTL','N','Y','3e55766c8262ead236f122511185b35fda043ffbe028371126c9a7ed2a7591bc','20191029213159','3e55766c8262ead236f122511185b35fda043ffbe028371126c9a7ed2a7591bc','20191029072820','20151030224013','20151030224213'),(34,'JSVRDAO','N','Y','243d18b296717c4e9e2cd9b01fd9ab091e41747e807c0405eb58629cae850306','20191029213159','243d18b296717c4e9e2cd9b01fd9ab091e41747e807c0405eb58629cae850306','20191029072820','20151030224101','20151030224213'),(35,'JSVRSQL','N','Y','3960c3342fbf57275dc7f3d3a4ddc7404251c055071a4da9f81ef6cc0a361960','20191029213159','3960c3342fbf57275dc7f3d3a4ddc7404251c055071a4da9f81ef6cc0a361960','20191029072820','20151030224213',NULL),(36,'JSVRSVC','N','Y','4485e5d1bf3244e7a51c2803b51292e5501b6afbc200497a366516a2a8bdc3e4','20191029213200','4485e5d1bf3244e7a51c2803b51292e5501b6afbc200497a366516a2a8bdc3e4','20191029072820','20151030224043','20151030224213'),(37,'JSVRUFI','N','Y','4f53cda18c2baa0c0354bb5f9a3ecbe5ed12ab4d8e11ba873c2f11161202b945','20191029213200','4f53cda18c2baa0c0354bb5f9a3ecbe5ed12ab4d8e11ba873c2f11161202b945','20191029072820','20151030224030','20151030224213'),(38,'LINKVIEW','N','Y','3dd40ccdfdea58f4eabde0492d60072ce5c9f4299ba1c6a8354304af7110a444','20191029213200','3dd40ccdfdea58f4eabde0492d60072ce5c9f4299ba1c6a8354304af7110a444','20191029072820','20190620203849',NULL),(39,'TEST','Y','Y',NULL,NULL,NULL,NULL,'20140730225307','20141101165528'),(40,'TEST3','Y','Y',NULL,NULL,NULL,NULL,'20141028215302',NULL),(41,'TEST5','Y','Y',NULL,NULL,NULL,NULL,'20140803133505','20141028215444'),(42,'TEXTAREA','N','Y','fee9c35979e92a0e208df14508b83db02a531476959460f34a46637e7cdc1249','20191029213200','fee9c35979e92a0e208df14508b83db02a531476959460f34a46637e7cdc1249','20191029072820','20140706120517','20140713160447'),(43,'TEXTVIEW','N','Y','a752271385d74af98bb3c92e0ea158cef0560aded3d911548db2e8b5ec558581','20191029213200','a752271385d74af98bb3c92e0ea158cef0560aded3d911548db2e8b5ec558581','20191029072821','20171214122048',NULL),(44,'TREE','Y','Y',NULL,NULL,NULL,NULL,'20140712142200','20140713143345'),(45,'WEBEDITOR','N','Y','c4ca1ef840685a2e21e58aa53c49d3d87818db4ec272616fa27de0a24b17086a','20191029213200','c4ca1ef840685a2e21e58aa53c49d3d87818db4ec272616fa27de0a24b17086a','20191029072821','20140706174147','20140713143345'),(46,'aaa','Y','Y',NULL,NULL,NULL,NULL,'20190621213318',NULL),(47,'GRIDBT','N','Y','78f8621a6debe25964aab7b80873c5b53623e08c4b30ef123bbc0c7f8ab3e28e','20191029213200','78f8621a6debe25964aab7b80873c5b53623e08c4b30ef123bbc0c7f8ab3e28e','20191029213056','20190808205919',NULL),(48,'HIDDENGET','N','Y','9d7cd6c9984a94b47fd25dc06c1ae33319d4e5c74ca4e648c42d3ca5ec7195c9','20191029213200','9d7cd6c9984a94b47fd25dc06c1ae33319d4e5c74ca4e648c42d3ca5ec7195c9','20191029072821','20190829201716',NULL),(49,'WESUMMERNOTE','N','Y',NULL,NULL,NULL,NULL,'20200220081246',NULL);
/*!40000 ALTER TABLE `CG_OBJINFO` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-27  7:37:55
