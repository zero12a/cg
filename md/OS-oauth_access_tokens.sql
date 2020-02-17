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
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `atoken_seq` int(11) NOT NULL AUTO_INCREMENT,
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `user_seq` int(11) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`atoken_seq`),
  UNIQUE KEY `access_token` (`access_token`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES (66,'30d8043dc59c8b355e4221c495f4a9c9503521db','demoapp','demouser',1,'2020-01-21 23:19:15',''),(67,'a054bb82e96a2e11a66acd9c38943f75ad61b420','demoapp','demouser',1,'2020-01-22 22:25:41',''),(68,'24e9755e9da51d34cc208bb0d44f666a9de0ac90','demoapp','demouser',1,'2020-01-22 22:47:54',''),(69,'0aeb8c7caf0112d630eb7d68640fba4e9cb960cb','demoapp','demouser',1,'2020-01-22 23:03:14',''),(70,'6ef42078ab0fee5c4f0189ddbfaf07c38b1393e3','demoapp','demouser',1,'2020-01-22 23:06:08',''),(71,'3f9db68fb37e56014c02bf5b2c05f78efbfd439f','demoapp','demouser',1,'2020-01-22 23:07:11',''),(72,'0066c8130b2ef3ba9f0091d977198773975e8b8c','demoapp','demouser',1,'2020-01-22 23:07:30',''),(73,'72edc5ef18c016d016f83155b437d31af7e4705f','demoapp','demouser',1,'2020-01-22 23:09:37',''),(74,'4d58aa6b17ddc7c9fcb770912820e560dd67323f','demoapp','demouser',1,'2020-01-22 23:09:54',''),(75,'8cee15db9d05d984f3d439cbe51733f75652ecf5','demoapp','demouser',1,'2020-01-22 23:29:17',''),(76,'c9e9db25c6c5c4e6bd04fbf805e5c96cbfd927a4','demoapp','demouser',1,'2020-01-22 23:31:50',''),(77,'625e00a3f600bc71500109157d406284c5ac1206','demoapp','zero12a',NULL,'2020-01-27 06:45:29',''),(78,'409c56f38320772db36396a605b0887fd91cdca4','demoapp','zero12a',NULL,'2020-01-27 06:50:34',''),(79,'9255f98a628e27877d705fc8fd96d4009a71489e','demoapp','zero12a',NULL,'2020-01-27 06:51:44',''),(80,'9c2f8db9c07d8eab0635f7b1a1373d81219028c6','demoapp','zero12a',NULL,'2020-01-27 06:52:24',''),(81,'8e9f0346831df6f2d0de6d0a741491e7655aae0e','demoapp','zero12a',NULL,'2020-01-27 07:02:07',''),(82,'367adf4df1cd59a208a9bfa04e0b7737aa81f4e1','demoapp','zero12a',1,'2020-01-27 07:03:30',''),(83,'6a90c6ccaebccd7f9cf06ef821c78645f56ed090','demoapp','zero12a',1,'2020-01-27 07:05:30',''),(84,'ac1ed8bb482ce97f90379ab385929a1ab6a9d522','demoapp','zero12a',1,'2020-01-27 07:05:50',''),(85,'7a85211f02f801e693d67970fc43a2962df1fb6d','demoapp','zero12a',1,'2020-01-27 07:09:08',''),(86,'3bf91032b0b3b2cbd003022931d65f01fbbae2b1','demoapp','zero12a',1,'2020-01-27 07:24:48',''),(87,'731d7a62ebc9b5f41ad288c5fe14143f730006b6','demoapp','zero12a',1,'2020-01-27 07:26:38',''),(88,'bd6de4e833f60d9fbf7c5aa914cc1db073675cf9','demoapp','zero12a',1,'2020-01-27 07:32:37',''),(89,'7279db430f75c50603502c4b60069ed55fb17f95','demoapp','zero12a',1,'2020-01-30 00:42:31',''),(90,'6dae16d08976255715e32e44918fe501f6e5e5c3','demoapp','zero12a',1,'2020-01-30 00:43:36',''),(91,'79ac3a2374763927169e107e588440f4e0a9be25','demoapp','zero12a',1,'2020-01-31 00:07:25',''),(92,'c5dfac2b331a898c0b0b0434a70cc37c6c287c9f','demoapp','zero12a',1,'2020-02-04 13:03:03',''),(93,'f195f4497b2e03363080658f53bbce43654049bd','demoapp','zero12a',1,'2020-02-04 23:53:12',''),(94,'9577245907a9b9aae2558fd723a807abfa482f40','demoapp','zero12a',1,'2020-02-05 00:14:51',''),(95,'c7ac3d73cbe47fc42e580197c652b82ac86bd178','demoapp','zero12a',1,'2020-02-05 23:31:50',''),(96,'6ecce284156255c17781a43f8363209ae90f148f','demoapp','zero12a',1,'2020-02-06 00:41:58',''),(97,'dfba46a53b3e42036ff60917037dc68de4ad8d83','demoapp','zero12a',1,'2020-02-06 23:43:39',''),(98,'23613623b6bd721623d068744f88aa3d12019e30','demoapp','zero12a',1,'2020-02-07 00:16:03',''),(99,'9f77bc7b9732a7a50600041f052ec2d0e41d086b','demoapp','zero12a',1,'2020-02-08 03:16:49',''),(100,'27b9292b01194674dffd88b0d3b376c043effa94','demoapp','zero12a',1,'2020-02-08 04:11:10',''),(101,'13fba1fe001e8fb9e63d8f0ba64eeface6527f5b','demoapp','zero12a',1,'2020-02-08 04:20:43',''),(102,'faf59185c763ed66152e8ddeb8437ee787399a4f','demoapp','zero12a',1,'2020-02-08 04:20:44',''),(103,'84b602bd945f35c8c5efd59f5235c74c06d2335a','demoapp','zero12a',1,'2020-02-08 06:28:23',''),(104,'7bac02222bb39417989c84b733cb893b0d654e1f','demoapp','zero12a',1,'2020-02-08 06:41:17',''),(105,'465d9b2205dd7dc6f7eb9e0111bba198f3b24e7c','demoapp','zero12a',1,'2020-02-08 06:45:22',''),(106,'20b2adfab15f4f5967e75bd68230ebf9e85d2c73','demoapp','zero12a',1,'2020-02-08 06:52:20',''),(107,'e90f01a8780c4789878b60eaa1b478d7dff88fcb','demoapp','zero12a',1,'2020-02-08 07:05:16',''),(108,'e591a1b1035f4a481514967da8d00d2d73875a0f','demoapp','zero12a',1,'2020-02-08 07:07:45',''),(109,'22210d5cc5a42e4548595c9c46fa6c07c241f880','demoapp','zero12a',1,'2020-02-08 07:13:33',''),(110,'3a02594c74317bb5a0b6a45bcc78cd6e259d13eb','demoapp','zero12a',1,'2020-02-08 07:14:48',''),(111,'b3d9f54ac74013c8cd88967a7f97606d45ed1901','demoapp','zero12a',1,'2020-02-08 07:18:02',''),(112,'b1899dff7398db91a7cc56d7ce1b2eeb3a409575','demoapp','zero12a',1,'2020-02-08 07:21:34',''),(113,'306ec06ef679db02fc89888bd390484cf0d1f413','demoapp','zero12a',1,'2020-02-08 07:23:21',''),(114,'73de70482d109c18db3ab3352fe8979bb5d40544','demoapp','zero12a',1,'2020-02-08 07:23:35',''),(115,'cc1fe0ce0e916ef646ce994a418b2016d4a6d46e','demoapp','zero12a',1,'2020-02-08 07:25:13',''),(116,'77751d4d2f6f36cde1651737c479bbc11fd3af67','demoapp','zero12a',1,'2020-02-08 12:31:33',''),(117,'f203950be268fef038a366b4dec9aee28415f2de','demoapp','zero12a',1,'2020-02-08 12:46:02',''),(118,'3767b048c04089c8ac0c4834985ec28ceefe9b0c','demoapp','zero12a',1,'2020-02-09 06:25:19',''),(119,'552b98b04fac77266f90a4b3695a5fa697b6c1c5','demoapp','zero12a',1,'2020-02-09 07:14:30',''),(120,'8ed825809c58022b3d27450fedf4373f983cd5b9','demoapp','zero12a',1,'2020-02-09 07:17:53',''),(121,'1e244df93f76ac8bfe0912d1aedad31836cdf5bd','demoapp','zero12a',1,'2020-02-09 13:16:16',''),(122,'9b4dcaa71e7d78af128a280d203b06946b4e9090','demoapp','zero12a',1,'2020-02-09 23:24:53',''),(123,'edb92fcf4bc0a38c0c479c38a4ba999c6f8321ab','demoapp','zero12a',1,'2020-02-10 22:33:03',''),(124,'ce601e3feb5fca6219c871212b6a333cf7dd40cf','demoapp','zero12a',1,'2020-02-11 23:16:56',''),(125,'1af60371a1351dc1dc14b65b8f403623ca25a60e','demoapp','zero12a',1,'2020-02-11 23:18:48',''),(126,'9db33717504b966810d17959e5180abe3567d8e1','demoapp','zero12a',1,'2020-02-12 23:25:55',''),(127,'df2280060348d30a4278b4dacb316d3ecd6c9f73','demoapp','zero12a',1,'2020-02-12 23:47:17',''),(128,'6ea72014312d32502e239e705e31570ab899331c','demoapp','zero12a',1,'2020-02-12 23:47:32',''),(129,'2dfbe12f36d43842f8066282f60832bba2c8f060','demoapp','zero12a',1,'2020-02-12 23:49:56',''),(130,'2a732eda90869f5e6257e329c3de9817a0636267','demoapp','zero12a',1,'2020-02-12 23:51:12',''),(131,'603b84812c48382572d19562df3f8cf1b14a0c24','demoapp','zero12a',1,'2020-02-13 22:07:03',''),(132,'8e49b4038727ade5869662cc80105070053b5e0e','demoapp','zero12a',1,'2020-02-14 21:41:27',''),(133,'d5360b25f5b75a14b4d123cb42014070a05c6e79','demoapp','zero12a',1,'2020-02-14 22:13:09',''),(134,'d22ecb6e326c0bca687e9bdc9c3784d78b154343','demoapp','zero12a',1,'2020-02-14 22:21:17',''),(135,'ac876be94b4a2a154e9221f2e8db36a64a025fa2','demoapp','zero12a',1,'2020-02-14 22:23:32',''),(136,'4acfa59d80d2031dafeb0928b4ffb1cef87c95e2','demoapp','zero12a',1,'2020-02-14 22:32:46',''),(137,'7ab7d403a3bb9a23f73449f7c6bc2e7c2634ea15','svcfront','zero12a',1,'2020-02-14 22:32:52',''),(138,'0870a7d6ef5d822942de848dba1f42c0eb42787b','svcfront','zero12a',1,'2020-02-14 22:36:00',''),(139,'98a7e2a9a4cf4048c8efd7c66d61b1431a4745fa','svcfront','zero12a',1,'2020-02-14 22:36:05',''),(140,'d5b96a4d4ffd7c15f2dabf5e93b80c37452ab9dd','svcfront','zero12a',1,'2020-02-14 22:36:25',''),(141,'c4c2a36f41c44b295ffa801f37e3b26922adf1e5','svcfront','zero12a',1,'2020-02-14 22:36:41',''),(142,'9efc62328c33fed3da24925ff7f75e30c8e2c455','svcfront','zero12a',1,'2020-02-14 22:38:14',''),(143,'4ad42f6506712069ae107facee12089849f70bab','cgback','zero12a',1,'2020-02-14 22:53:47',''),(144,'b65356d461b89ddb7c79281a5714ba7e428277ec','cgback','zero12a',1,'2020-02-14 22:54:05',''),(145,'b04486b7dba1b2d8eec2a7a8a3743836e42a1967','cgback','zero12a',1,'2020-02-14 22:54:23',''),(146,'9a6cc73c6b2d2a93279c20dff1354df678f33cb5','cgback','zero12a',1,'2020-02-14 22:55:11',''),(147,'14b70615c32ec5582c3b15ef2eb1ac9e33160beb','cgback','zero12a',1,'2020-02-14 22:55:53',''),(148,'b1f635ba67d32db6ed978ede3b215a3211f86c95','cgback','zero12a',1,'2020-02-14 22:55:58',''),(149,'2e2901cf5c3452a6106307de9e581ec00bdc8f54','cgback','zero12a',1,'2020-02-14 22:57:33',''),(150,'3c5ab6c23d86d18687b9f71f9612eefcd3f20d7a','cgback','zero12a',1,'2020-02-14 22:58:02',''),(151,'d8cbf7d2594e2bb8b21e5eadf2fa8e9cc8935861','cgback','zero12a',1,'2020-02-14 22:58:16',''),(152,'49ada5299025e39e8fe87477e06aa137dbec852e','cgback','zero12a',1,'2020-02-14 22:58:37',''),(153,'cae3f517f3df6da484d55e16844e9bf89ad5f3fc','svcfront','zero12a',1,'2020-02-14 22:59:19',''),(154,'9d243d7bfcabba9a6ec3eb28eb14c279d1c96480','cgback','zero12a',1,'2020-02-14 23:01:11',''),(155,'22a221190cef7142260dbb333848aa1b09f8cb9e','cgback','zero12a',1,'2020-02-16 23:28:11',''),(156,'c4683e086b85b3184c061cb79f7a2a101c66a1c0','cgback','zero12a',1,'2020-02-17 12:12:38','');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
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
