-- MySQL dump 10.13  Distrib 5.7.34, for Linux (x86_64)
--
-- Host: localhost    Database: ann
-- ------------------------------------------------------
-- Server version	5.7.34-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `arguments`
--

DROP TABLE IF EXISTS `arguments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arguments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `des` text COLLATE utf8_persian_ci,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `u_id` (`u_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `arguments_ibfk_0` FOREIGN KEY (`parent`) REFERENCES `arguments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `arguments_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `arguments_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4464 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arguments`
--

LOCK TABLES `arguments` WRITE;
/*!40000 ALTER TABLE `arguments` DISABLE KEYS */;
INSERT INTO `arguments` VALUES (280,10,134,'Participant','مشارکت کننده',NULL),(281,10,134,'Time','زمان',NULL),(282,10,134,'Place','مکان',NULL),(283,10,134,'Number of Participants','تعداد شرکت کنندگان',NULL),(284,10,135,'Participant','مشارکت کننده',NULL),(285,10,135,'Time','زمان',NULL),(286,10,135,'Place','مکان',NULL),(287,10,135,'Number of Participants','تعداد شرکت کنندگان',NULL),(288,10,136,'Participant','مشارکت کننده',NULL),(289,10,136,'Time','زمان',NULL),(290,10,136,'Place','مکان',NULL),(291,10,136,'Number of Participants','تعداد شرکت کنندگان',NULL),(292,10,137,'Participant','مشارکت کننده',NULL),(293,10,137,'Time','زمان',NULL),(294,10,137,'Place','مکان',NULL),(295,10,137,'Number of Participants','تعداد شرکت کنندگان',NULL),(296,10,138,'Participant','مشارکت کننده',NULL),(297,10,138,'Time','زمان',NULL),(298,10,138,'Place','مکان',NULL),(299,10,138,'Number of Participants','تعداد شرکت کنندگان',NULL),(300,10,139,'Participant','مشارکت کننده',NULL),(301,10,139,'Time','زمان',NULL),(302,10,139,'Place','مکان',NULL),(303,10,139,'Number of Participants','تعداد شرکت کنندگان',NULL),(305,10,140,'Participant','مشارکت کننده',NULL),(306,10,140,'Time','زمان',NULL),(307,10,140,'Place','مکان',NULL),(308,10,140,'Number of Participants','تعداد شرکت کنندگان',NULL),(309,10,141,'Participant','مشارکت کننده',NULL),(310,10,141,'Time','زمان',NULL),(311,10,141,'Place','مکان',NULL),(312,10,141,'Number of Participants','تعداد شرکت کنندگان',NULL),(313,10,142,'Participant','مشارکت کننده',NULL),(314,10,142,'Time','زمان',NULL),(315,10,142,'Place','مکان',NULL),(316,10,142,'Number of Participants','تعداد شرکت کنندگان',NULL),(317,10,143,'Source','شروع کننده رویداد',NULL),(318,10,143,'Target','هدف رویداد',NULL),(319,10,143,'Time','زمان',NULL),(320,10,143,'Place','مبدا رویداد',NULL),(321,10,143,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(322,10,144,'Source','شروع کننده رویداد',NULL),(323,10,144,'Time','زمان',NULL),(324,10,144,'Place','مکان',NULL),(325,10,144,'Instrument','ابزار',NULL),(326,10,144,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(327,10,145,'Participant','مشارکت کننده',NULL),(328,10,145,'Time','زمان',NULL),(329,10,145,'Place','مکان',NULL),(330,10,145,'Scale','اندازه/قدرت رویداد',NULL),(331,10,145,'Number of Injuries','تعداد مصدومین',NULL),(332,10,145,'Number of Deaths','تعداد مرگ و میر',NULL),(333,10,145,'Number of Missing Entities','تعداد گم شدگان',NULL),(334,10,145,'Number of Destructions','تعداد ویرانی ها',NULL),(335,10,145,'Number of Participants','تعداد شرکت کنندگان',NULL),(336,10,146,'Participant','مشارکت کننده',NULL),(337,10,146,'Time','زمان',NULL),(338,10,146,'Place','مکان',NULL),(339,10,146,'Scale','اندازه/قدرت رویداد',NULL),(340,10,146,'Number of Injuries','تعداد مصدومین',NULL),(341,10,146,'Number of Deaths','تعداد مرگ و میر',NULL),(342,10,146,'Number of Missing Entities','تعداد گم شدگان',NULL),(343,10,146,'Number of Destructions','تعداد ویرانی ها',NULL),(344,10,146,'Number of Participants','تعداد شرکت کنندگان',NULL),(345,10,147,'Participant','مشارکت کننده',NULL),(346,10,147,'Time','زمان',NULL),(347,10,147,'Place','مکان',NULL),(348,10,147,'Scale (Magnitude)','اندازه/قدرت رویداد',NULL),(349,10,147,'Number of Injuries','تعداد مصدومین',NULL),(350,10,147,'Number of Deaths','تعداد مرگ و میر',NULL),(351,10,147,'Number of Missing Entities','تعداد گم شدگان',NULL),(352,10,147,'Number of Destructions','تعداد ویرانی ها',NULL),(353,10,147,'Number of Participants','تعداد شرکت کنندگان',NULL),(354,10,148,'Participant','مشارکت کننده',NULL),(355,10,148,'Time','زمان',NULL),(356,10,148,'Place','مکان',NULL),(357,10,148,'Scale','اندازه/قدرت رویداد',NULL),(358,10,148,'Number of Injuries','تعداد مصدومین',NULL),(359,10,148,'Number of Deaths','تعداد مرگ و میر',NULL),(360,10,148,'Number of Missing Entities','تعداد گم شدگان',NULL),(361,10,148,'Number of Destructions','تعداد ویرانی ها',NULL),(362,10,148,'Number of Participants','تعداد شرکت کنندگان',NULL),(363,10,149,'Participant','مشارکت کننده',NULL),(364,10,149,'Time','زمان',NULL),(365,10,149,'Place','مکان',NULL),(366,10,149,'Scale','اندازه/قدرت رویداد',NULL),(367,10,149,'Number of Injuries','تعداد مصدومین',NULL),(368,10,149,'Number of Deaths','تعداد مرگ و میر',NULL),(369,10,149,'Number of Missing Entities','تعداد گم شدگان',NULL),(370,10,149,'Number of Destructions','تعداد ویرانی ها',NULL),(371,10,149,'Number of Participants','تعداد شرکت کنندگان',NULL),(372,10,150,'Participant','مشارکت کننده',NULL),(373,10,150,'Time','زمان',NULL),(374,10,150,'Place','مکان',NULL),(375,10,150,'Scale','اندازه/قدرت رویداد',NULL),(376,10,150,'Number of Injuries','تعداد مصدومین',NULL),(377,10,150,'Number of Deaths','تعداد مرگ و میر',NULL),(378,10,150,'Number of Missing Entities','تعداد گم شدگان',NULL),(379,10,150,'Number of Destructions','تعداد ویرانی ها',NULL),(380,10,150,'Number of Participants','تعداد شرکت کنندگان',NULL),(381,10,151,'Participant','مشارکت کننده',NULL),(382,10,151,'Time','زمان',NULL),(383,10,151,'Place','مکان',NULL),(384,10,151,'Scale','اندازه/قدرت رویداد',NULL),(385,10,151,'Number of Injuries','تعداد مصدومین',NULL),(386,10,151,'Number of Deaths','تعداد مرگ و میر',NULL),(387,10,151,'Number of Missing Entities','تعداد گم شدگان',NULL),(388,10,151,'Number of Destructions','تعداد ویرانی ها',NULL),(389,10,151,'Number of Participants','تعداد شرکت کنندگان',NULL),(390,10,152,'Participant','مشارکت کننده',NULL),(391,10,152,'Time','زمان',NULL),(392,10,152,'Place','مکان',NULL),(393,10,152,'Scale','اندازه/قدرت رویداد',NULL),(394,10,152,'Number of Injuries','تعداد مصدومین',NULL),(395,10,152,'Number of Deaths','تعداد مرگ و میر',NULL),(396,10,152,'Number of Missing Entities','تعداد گم شدگان',NULL),(397,10,152,'Number of Destructions','تعداد ویرانی ها',NULL),(398,10,152,'Number of Participants','تعداد شرکت کنندگان',NULL),(408,10,154,'Participant','مشارکت کننده',NULL),(409,10,154,'Time','زمان',NULL),(410,10,154,'Place','مکان',NULL),(411,10,154,'Scale','اندازه/قدرت رویداد',NULL),(413,10,154,'Number of Injuries','تعداد مصدومین',NULL),(414,10,154,'Number of Deaths','تعداد مرگ و میر',NULL),(415,10,154,'Number of Missing Entities','تعداد گم شدگان',NULL),(416,10,154,'Number of Destructions','تعداد ویرانی ها',NULL),(417,10,154,'Number of Participants','تعداد شرکت کنندگان',NULL),(427,10,156,'Source','شروع کننده رویداد',NULL),(428,10,156,'Target','هدف رویداد',NULL),(429,10,156,'Time','زمان',NULL),(430,10,156,'Place','مکان',NULL),(431,10,156,'Number of Targets','تعداد اهداف رویداد',NULL),(433,10,156,'Number of Injuries','تعداد مصدومین',NULL),(434,10,156,'Number of Deaths','تعداد مرگ و میر',NULL),(435,10,157,'Source','شروع کننده رویداد',NULL),(436,10,157,'Target','هدف رویداد',NULL),(437,10,157,'Time','زمان',NULL),(438,10,157,'Place','مکان',NULL),(440,10,157,'Number of Targets','تعداد اهداف رویداد',NULL),(441,10,157,'Number of Injuries','تعداد مصدومین',NULL),(442,10,157,'Number of Deaths','تعداد مرگ و میر',NULL),(443,10,158,'Source','شروع کننده رویداد',NULL),(444,10,158,'Target','هدف رویداد',NULL),(445,10,158,'Time','زمان',NULL),(446,10,158,'Place','مکان',NULL),(447,10,158,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(448,10,158,'Number of Targets','تعداد اهداف رویداد',NULL),(449,10,159,'Participant','مشارکت کننده',NULL),(450,10,159,'Time','زمان',NULL),(451,10,159,'Place','مکان',NULL),(453,10,159,'Number of Participants','تعداد شرکت کنندگان',NULL),(458,10,161,'Participant','مشارکت کننده',NULL),(459,10,161,'Time','زمان',NULL),(460,10,161,'Place','مکان',NULL),(461,10,161,'Number of Participants','تعداد شرکت کنندگان',NULL),(462,10,162,'Participant','مشارکت کننده',NULL),(463,10,162,'Time','زمان',NULL),(464,10,162,'Place','مکان',NULL),(465,10,162,'Number of Participants','تعداد شرکت کنندگان',NULL),(466,10,163,'Participant','مشارکت کننده',NULL),(467,10,163,'Time','زمان',NULL),(470,10,163,'Duration','مدت زمان اجرای رویداد',NULL),(471,10,163,'Number of Participants','تعداد شرکت کنندگان',NULL),(472,10,164,'Source','شروع کننده رویداد',NULL),(473,10,164,'Target','هدف رویداد',NULL),(474,10,164,'Instrument','ابزار',NULL),(475,10,164,'Time','زمان',NULL),(476,10,164,'Place','مکان',NULL),(477,10,164,'Number of Injuries','تعداد مصدومین',NULL),(478,10,164,'Number of Deaths','تعداد مرگ و میر',NULL),(479,10,164,'Number of Destructions','تعداد ویرانی ها',NULL),(480,10,164,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(481,10,164,'Number of Targets','تعداد اهداف رویداد',NULL),(482,10,165,'Source','شروع کننده رویداد',NULL),(483,10,165,'Target','هدف رویداد',NULL),(484,10,165,'Instrument','ابزار',NULL),(485,10,165,'Time','زمان',NULL),(486,10,165,'Place','مکان',NULL),(487,10,165,'Number of Injuries','تعداد مصدومین',NULL),(488,10,165,'Number of Deaths','تعداد مرگ و میر',NULL),(489,10,165,'Number of Destructions','تعداد ویرانی ها',NULL),(490,10,165,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(491,10,165,'Number of Targets','تعداد اهداف رویداد',NULL),(492,10,166,'Source','شروع کننده رویداد',NULL),(493,10,166,'Target','هدف رویداد',NULL),(494,10,166,'Instrument','ابزار',NULL),(495,10,166,'Time','زمان',NULL),(496,10,166,'Place','مکان',NULL),(497,10,166,'Number of Injuries','تعداد مصدومین',NULL),(498,10,166,'Number of Deaths','تعداد مرگ و میر',NULL),(499,10,166,'Number of Destructions','تعداد ویرانی ها',NULL),(500,10,166,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(501,10,166,'Number of Targets','تعداد اهداف رویداد',NULL),(522,10,169,'Source','شروع کننده رویداد',NULL),(523,10,169,'Target','هدف رویداد',NULL),(524,10,169,'Instrument','ابزار',NULL),(525,10,169,'Time','زمان',NULL),(526,10,169,'Place','مکان',NULL),(527,10,169,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(528,10,169,'Number of Targets','تعداد اهداف رویداد',NULL),(529,10,170,'Source','شروع کننده رویداد',NULL),(530,10,170,'Target','هدف رویداد',NULL),(531,10,170,'Instrument','ابزار',NULL),(532,10,170,'Time','زمان',NULL),(533,10,170,'Place','مکان',NULL),(534,10,170,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(535,10,170,'Number of Targets','تعداد اهداف رویداد',NULL),(536,10,171,'Source','شروع کننده رویداد',NULL),(537,10,171,'Target','هدف رویداد',NULL),(538,10,171,'Instrument','ابزار',NULL),(539,10,171,'Time','زمان',NULL),(540,10,171,'Place','مکان',NULL),(541,10,171,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(542,10,171,'Number of Targets','تعداد اهداف رویداد',NULL),(543,10,172,'Source','شروع کننده رویداد',NULL),(544,10,172,'Target','هدف رویداد',NULL),(545,10,172,'Instrument','ابزار',NULL),(546,10,172,'Time','زمان',NULL),(547,10,172,'Place','مکان',NULL),(548,10,172,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(549,10,172,'Number of Targets','تعداد اهداف رویداد',NULL),(550,10,173,'Source','شروع کننده رویداد',NULL),(551,10,173,'Target','هدف رویداد',NULL),(552,10,173,'Instrument','ابزار',NULL),(553,10,173,'Time','زمان',NULL),(554,10,173,'Place','مکان',NULL),(555,10,173,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(556,10,173,'Number of Targets','تعداد اهداف رویداد',NULL),(557,10,174,'Source','شروع کننده رویداد',NULL),(558,10,174,'Time','زمان',NULL),(559,10,174,'Place','مکان',NULL),(562,10,176,'Source','شروع کننده رویداد',NULL),(563,10,176,'Target','هدف رویداد',NULL),(564,10,176,'Time','زمان',NULL),(565,10,176,'Place','مکان',NULL),(566,10,176,'Artifact','محصول',NULL),(567,10,176,'Price','قیمت',NULL),(568,10,176,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(569,10,176,'Number of Targets','تعداد اهداف رویداد',NULL),(570,10,177,'Source','شروع کننده رویداد',NULL),(571,10,177,'Target','هدف رویداد',NULL),(572,10,177,'Time','زمان',NULL),(573,10,177,'Place','مکان',NULL),(574,10,177,'Artifact','محصول',NULL),(575,10,177,'Price','قیمت',NULL),(576,10,177,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(577,10,177,'Number of Targets','تعداد اهداف رویداد',NULL),(578,10,178,'Source','شروع کننده رویداد',NULL),(579,10,178,'Target','هدف رویداد',NULL),(580,10,178,'Time','زمان',NULL),(581,10,178,'Place','مکان',NULL),(582,10,179,'Source','شروع کننده رویداد',NULL),(583,10,179,'Target','هدف رویداد',NULL),(584,10,179,'Time','زمان',NULL),(585,10,179,'Place','مکان',NULL),(586,10,180,'Source','شروع کننده رویداد',NULL),(587,10,180,'Target','هدف رویداد',NULL),(588,10,180,'Time','زمان',NULL),(589,10,180,'Place','مکان',NULL),(590,10,182,'Source','شروع کننده رویداد',NULL),(591,10,182,'Target','هدف رویداد',NULL),(592,10,182,'Time','زمان',NULL),(593,10,182,'Place','مکان',NULL),(594,10,183,'Source','شروع کننده رویداد',NULL),(595,10,183,'Target','هدف رویداد',NULL),(596,10,183,'Time','زمان',NULL),(597,10,183,'Place','مکان',NULL),(598,10,183,'Number of Targets','تعداد اهداف رویداد',NULL),(599,10,184,'Source','شروع کننده رویداد',NULL),(600,10,184,'Target','هدف رویداد',NULL),(601,10,184,'Time','زمان',NULL),(602,10,184,'Place','مکان',NULL),(603,10,184,'Number of Targets','تعداد اهداف رویداد',NULL),(604,10,185,'Source','شروع کننده رویداد',NULL),(605,10,185,'Target','هدف رویداد',NULL),(606,10,185,'Time','زمان',NULL),(607,10,185,'Place','مکان',NULL),(608,10,185,'Number of Targets','تعداد اهداف رویداد',NULL),(609,10,186,'Source','شروع کننده رویداد',NULL),(610,10,186,'Target','هدف رویداد',NULL),(611,10,186,'Time','زمان',NULL),(612,10,186,'Place','مکان',NULL),(613,10,186,'Number of Targets','تعداد اهداف رویداد',NULL),(614,10,187,'Source','شروع کننده رویداد',NULL),(615,10,187,'Target','هدف رویداد',NULL),(616,10,187,'Time','زمان',NULL),(617,10,187,'Place','مکان',NULL),(618,10,187,'Number of Targets','تعداد اهداف رویداد',NULL),(619,10,188,'Source','شروع کننده رویداد',NULL),(620,10,188,'Target','هدف رویداد',NULL),(621,10,188,'Time','زمان',NULL),(622,10,188,'Place','مکان',NULL),(623,10,188,'Number of Targets','تعداد اهداف رویداد',NULL),(624,10,189,'Source','شروع کننده رویداد',NULL),(625,10,189,'Target','هدف رویداد',NULL),(626,10,189,'Time','زمان',NULL),(627,10,189,'Place','مکان',NULL),(628,10,189,'Number of Targets','تعداد اهداف رویداد',NULL),(629,10,190,'Source','شروع کننده رویداد',NULL),(630,10,190,'Target','هدف رویداد',NULL),(631,10,190,'Time','زمان',NULL),(632,10,190,'Place','مکان',NULL),(633,10,190,'Number of Targets','تعداد اهداف رویداد',NULL),(635,10,191,'Source','شروع کننده رویداد',NULL),(636,10,191,'Target','هدف رویداد',NULL),(637,10,191,'Time','زمان',NULL),(638,10,191,'Place','مکان',NULL),(639,10,191,'Duration','مدت زمان اجرای رویداد',NULL),(640,10,192,'Source','شروع کننده رویداد',NULL),(641,10,192,'Target','هدف رویداد',NULL),(642,10,192,'Time','زمان',NULL),(643,10,192,'Place','مکان',NULL),(644,10,192,'Price','قیمت',NULL),(645,10,208,'Source','شروع کننده رویداد',NULL),(646,10,208,'Target','هدف رویداد',NULL),(647,10,208,'Time','زمان',NULL),(648,10,208,'Place','مکان',NULL),(649,10,208,'Occupation','سمت شغلی',NULL),(650,10,208,'Contact-info','اطلاعات تماس',NULL),(651,10,208,'Number of Targets','تعداد اهداف رویداد',NULL),(652,10,209,'Source','شروع کننده رویداد',NULL),(653,10,209,'Target','هدف رویداد',NULL),(654,10,209,'Time','زمان',NULL),(655,10,209,'Place','مکان',NULL),(656,10,209,'Occupation','سمت شغلی',NULL),(657,10,209,'Contact-info','اطلاعات تماس',NULL),(658,10,209,'Number of Targets','تعداد اهداف رویداد',NULL),(659,10,210,'Source','شروع کننده رویداد',NULL),(660,10,210,'Target','هدف رویداد',NULL),(661,10,210,'Time','زمان',NULL),(662,10,210,'Place','مکان',NULL),(663,10,210,'Occupation','سمت شغلی',NULL),(664,10,210,'Contact-info','اطلاعات تماس',NULL),(665,10,210,'Number of Targets','تعداد اهداف رویداد',NULL),(666,10,211,'Source','شروع کننده رویداد',NULL),(667,10,211,'Target','هدف رویداد',NULL),(668,10,211,'Time','زمان',NULL),(669,10,211,'Place','مکان',NULL),(670,10,211,'Price','قیمت',NULL),(671,10,212,'Source','شروع کننده رویداد',NULL),(672,10,212,'Target','هدف رویداد',NULL),(673,10,212,'Time','زمان',NULL),(674,10,212,'Place','مکان',NULL),(675,10,212,'Artifact','محصول',NULL),(676,10,212,'Price','قیمت',NULL),(677,10,213,'Source','شروع کننده رویداد',NULL),(678,10,213,'Target','هدف رویداد',NULL),(679,10,213,'Time','زمان',NULL),(680,10,213,'Place','مکان',NULL),(681,10,213,'Price','قیمت',NULL),(682,10,214,'Source','شروع کننده رویداد',NULL),(683,10,214,'Time','زمان',NULL),(684,10,214,'Place','مکان',NULL),(685,10,214,'Target','هدف رویداد (محصول)',NULL),(687,10,215,'Source','شروع کننده رویداد',NULL),(688,10,215,'Time','زمان',NULL),(689,10,215,'Place','مکان',NULL),(690,10,215,'Target','هدف رویداد (محصول)',NULL),(693,10,216,'Participant','مشارکت کننده',NULL),(695,10,216,'Price','قیمت',NULL),(696,10,216,'Time','زمان',NULL),(697,10,216,'Place','مکان',NULL),(698,10,217,'Participant','مشارکت کننده',NULL),(700,10,217,'Time','زمان',NULL),(701,10,217,'Place','مکان',NULL),(702,10,217,'Price','قیمت',NULL),(703,10,217,'Fluctuation','مقدار نوسان',NULL),(704,10,218,'Participant','مشارکت کننده',NULL),(706,10,218,'Time','زمان',NULL),(707,10,218,'Place','مکان',NULL),(708,10,218,'Price','قیمت',NULL),(709,10,218,'Fluctuation','مقدار نوسان',NULL),(710,10,219,'Participant','مشارکت کننده',NULL),(712,10,219,'Time','زمان',NULL),(713,10,219,'Place','مکان',NULL),(714,10,219,'Fluctuation','مقدار نوسان',NULL),(715,10,219,'Number of Participants','تعداد مشارکت کننده',NULL),(716,10,220,'Participant','مشارکت کننده',NULL),(718,10,220,'Time','زمان',NULL),(719,10,220,'Place','مکان',NULL),(720,10,220,'Fluctuation','مقدار نوسان',NULL),(721,10,220,'Number of Participants','تعداد مشارکت کننده',NULL),(722,10,221,'Source','شروع کننده رویداد',NULL),(723,10,221,'Target','هدف رویداد',NULL),(724,10,221,'Time','زمان',NULL),(725,10,221,'Place','مکان',NULL),(726,10,222,'Participant','مشارکت کننده',NULL),(727,10,222,'Time','زمان',NULL),(728,10,222,'Place','مکان',NULL),(729,10,223,'Source','شروع کننده رویداد',NULL),(734,10,224,'Source','شروع کننده رویداد',NULL),(735,10,224,'Target','هدف رویداد',NULL),(736,10,224,'Time','زمان',NULL),(737,10,224,'Place','مکان',NULL),(738,10,224,'Artifact','محصول',NULL),(739,10,224,'Price','قیمت',NULL),(740,10,225,'Source','شروع کننده رویداد',NULL),(741,10,225,'Target','هدف رویداد',NULL),(742,10,225,'Time','زمان',NULL),(743,10,225,'Place','مکان',NULL),(744,10,225,'Artifact','محصول',NULL),(745,10,225,'Price','قیمت',NULL),(746,10,226,'Source','شروع کننده رویداد',NULL),(747,10,226,'Target','هدف رویداد',NULL),(748,10,226,'Time','زمان',NULL),(749,10,226,'Place','مکان',NULL),(750,10,226,'Artifact','محصول',NULL),(751,10,226,'Price','قیمت',NULL),(752,10,227,'Source','شروع کننده رویداد',NULL),(753,10,227,'Target','هدف رویداد',NULL),(754,10,227,'Time','زمان',NULL),(755,10,227,'Place','مکان',NULL),(756,10,227,'Artifact','محصول',NULL),(757,10,227,'Price','قیمت',NULL),(758,10,228,'Source','شروع کننده رویداد',NULL),(759,10,228,'Target','هدف رویداد',NULL),(760,10,228,'Time','زمان',NULL),(761,10,228,'Place','مکان',NULL),(762,10,228,'Artifact','محصول',NULL),(763,10,228,'Price','قیمت',NULL),(764,10,229,'Source','شروع کننده رویداد',NULL),(765,10,229,'Target','هدف رویداد',NULL),(766,10,229,'Time','زمان',NULL),(767,10,229,'Place','مکان',NULL),(768,10,229,'Artifact','محصول',NULL),(769,10,229,'Price','قیمت',NULL),(770,10,230,'Source','شروع کننده رویداد',NULL),(771,10,230,'Target','هدف رویداد',NULL),(772,10,230,'Time','زمان',NULL),(773,10,230,'Place','مکان',NULL),(774,10,230,'Artifact','محصول',NULL),(775,10,231,'Source','شروع کننده رویداد',NULL),(776,10,231,'Target','هدف رویداد',NULL),(777,10,231,'Time','زمان',NULL),(778,10,231,'Place','مکان',NULL),(779,10,231,'Artifact','محصول',NULL),(780,10,232,'Participant','مشارکت کننده',NULL),(781,10,232,'Time','زمان',NULL),(782,10,232,'Place','مکان',NULL),(783,10,232,'Number of Participants','تعداد شرکت کنندگان',NULL),(784,10,233,'Participant','مشارکت کننده',NULL),(785,10,233,'Time','زمان',NULL),(786,10,233,'Place','مکان',NULL),(787,10,233,'Number of Participants','تعداد شرکت کنندگان',NULL),(788,10,234,'Source','شروع کننده رویداد',NULL),(789,10,234,'Target','هدف رویداد',NULL),(790,10,234,'Time','زمان',NULL),(791,10,234,'Place','مکان',NULL),(793,10,235,'Source','شروع کننده رویداد',NULL),(794,10,235,'Target','هدف رویداد',NULL),(795,10,235,'Time','زمان',NULL),(796,10,235,'Place','مکان',NULL),(797,10,236,'Source','شروع کننده رویداد',NULL),(798,10,236,'Target','هدف رویداد',NULL),(799,10,236,'Time','زمان',NULL),(800,10,236,'Place','مکان',NULL),(801,10,237,'Source','شروع کننده رویداد',NULL),(802,10,237,'Target','هدف رویداد',NULL),(803,10,237,'Time','زمان',NULL),(804,10,237,'Place','مکان',NULL),(805,10,238,'Source','شروع کننده رویداد',NULL),(806,10,238,'Target','هدف رویداد',NULL),(807,10,238,'Time','زمان',NULL),(808,10,238,'Place','مکان',NULL),(809,10,239,'Source','شروع کننده رویداد',NULL),(810,10,239,'Target','هدف رویداد',NULL),(811,10,239,'Time','زمان',NULL),(812,10,239,'Place','مکان',NULL),(813,10,240,'Source','شروع کننده رویداد',NULL),(814,10,240,'Target','هدف رویداد',NULL),(815,10,240,'Time','زمان',NULL),(816,10,240,'Place','مکان',NULL),(817,10,241,'Source','شروع کننده رویداد',NULL),(818,10,241,'Target','هدف رویداد',NULL),(819,10,241,'Time','زمان',NULL),(820,10,241,'Place','مکان',NULL),(821,10,242,'Source','شروع کننده رویداد',NULL),(822,10,242,'Target','هدف رویداد',NULL),(823,10,242,'Time','زمان',NULL),(824,10,242,'Place','مکان',NULL),(825,10,243,'Source','شروع کننده رویداد',NULL),(826,10,243,'Target','هدف رویداد',NULL),(827,10,243,'Time','زمان',NULL),(828,10,243,'Place','مکان',NULL),(829,10,244,'Source','شروع کننده رویداد',NULL),(830,10,244,'Target','هدف رویداد',NULL),(831,10,244,'Time','زمان',NULL),(832,10,244,'Place','مکان',NULL),(833,10,245,'Source','شروع کننده رویداد',NULL),(834,10,245,'Target','هدف رویداد',NULL),(835,10,245,'Time','زمان',NULL),(836,10,245,'Place','مکان',NULL),(837,10,246,'Source','شروع کننده رویداد',NULL),(838,10,246,'Target','هدف رویداد',NULL),(839,10,246,'Time','زمان',NULL),(840,10,246,'Place','مکان',NULL),(842,10,247,'Source','شروع کننده رویداد',NULL),(843,10,247,'Target','هدف رویداد',NULL),(844,10,247,'Time','زمان',NULL),(845,10,247,'Place','مکان',NULL),(846,10,248,'Source','شروع کننده رویداد',NULL),(847,10,248,'Target','هدف رویداد',NULL),(848,10,248,'Time','زمان',NULL),(849,10,248,'Place','مکان',NULL),(850,10,249,'Source','شروع کننده رویداد',NULL),(851,10,249,'Target','هدف رویداد',NULL),(852,10,249,'Time','زمان',NULL),(853,10,249,'Place','مکان',NULL),(854,10,250,'Source','شروع کننده رویداد',NULL),(855,10,250,'Target','هدف رویداد',NULL),(856,10,250,'Time','زمان',NULL),(857,10,250,'Place','مکان',NULL),(858,10,250,'Number of Injuries','تعداد مصدومین',NULL),(859,10,250,'Number of Deaths','تعداد مرگ و میر',NULL),(860,10,250,'Number of Missing Entities','تعداد گم شدگان',NULL),(861,10,250,'Number of Destructions','تعداد ویرانی ها',NULL),(862,10,251,'Source','شروع کننده رویداد',NULL),(863,10,251,'Target','هدف رویداد',NULL),(864,10,251,'Time','زمان',NULL),(865,10,251,'Place','مکان',NULL),(866,10,251,'Number of Injuries','تعداد مصدومین',NULL),(867,10,251,'Number of Deaths','تعداد مرگ و میر',NULL),(868,10,251,'Number of Missing Entities','تعداد گم شدگان',NULL),(869,10,251,'Number of Destructions','تعداد ویرانی ها',NULL),(870,10,252,'Source','شروع کننده رویداد',NULL),(871,10,252,'Target','هدف رویداد',NULL),(872,10,252,'Instrument','ابزار',NULL),(873,10,252,'Time','زمان',NULL),(874,10,252,'Place','مکان',NULL),(875,10,252,'Number of Injuries','تعداد مصدومین',NULL),(876,10,252,'Number of Deaths','تعداد مرگ و میر',NULL),(877,10,252,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(878,10,252,'Number of Targets','تعداد اهداف رویداد',NULL),(890,10,254,'Source','شروع کننده رویداد',NULL),(891,10,254,'Target','هدف رویداد',NULL),(892,10,254,'Time','زمان',NULL),(893,10,254,'Place','مکان',NULL),(894,10,254,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(895,10,254,'Number of Targets','تعداد اهداف رویداد',NULL),(896,10,254,'Number of Injuries','تعداد مصدومین',NULL),(897,10,254,'Number of Deaths','تعداد مرگ و میر',NULL),(898,10,254,'Number of Missing Entities','تعداد گم شدگان',NULL),(899,10,254,'Number of Destructions','تعداد ویرانی ها',NULL),(901,10,255,'Participant','مشارکت کننده',NULL),(902,10,255,'Time','زمان',NULL),(903,10,255,'Place','مکان',NULL),(904,10,255,'Number of Participants','تعداد شرکت کنندگان',NULL),(905,10,258,'Source','شروع کننده رویداد',NULL),(906,10,258,'Target','هدف رویداد',NULL),(907,10,258,'Instrument','ابزار',NULL),(908,10,258,'Time','زمان',NULL),(909,10,258,'Place','مکان',NULL),(910,10,258,'Number of Targets','تعداد اهداف رویداد',NULL),(911,10,259,'Source','شروع کننده رویداد',NULL),(912,10,259,'Target','هدف رویداد',NULL),(913,10,259,'Instrument','ابزار',NULL),(914,10,259,'Time','زمان',NULL),(915,10,259,'Place','مکان',NULL),(916,10,259,'Number of Targets','تعداد اهداف رویداد',NULL),(917,10,260,'Participant','مشارکت کننده',NULL),(919,10,260,'Time','زمان',NULL),(920,10,260,'Place','مکان',NULL),(921,10,260,'Number of Participants','تعداد شرکت کنندگان رویداد',NULL),(922,10,261,'Participant','مشارکت کننده',NULL),(924,10,261,'Time','زمان',NULL),(925,10,261,'Place','مکان',NULL),(926,10,261,'Number of Participants','تعداد مشارکت کننده رویداد',NULL),(927,10,261,'Occupation','سمت شغلی',NULL),(928,10,262,'Source','شروع کننده رویداد',NULL),(929,10,262,'Target','هدف رویداد',NULL),(930,10,262,'Time','زمان',NULL),(931,10,262,'Place','مکان',NULL),(932,10,263,'Participant','مشارکت کننده',NULL),(933,10,263,'Time','زمان',NULL),(934,10,263,'Place','مکان',NULL),(935,10,263,'Vehicle','وسیله نقلیه',NULL),(936,10,263,'Number of Participants','تعداد شرکت کنندگان',NULL),(937,10,263,'Number of Injuries','تعداد مصدومین',NULL),(938,10,263,'Number of Deaths','تعداد مرگ و میر',NULL),(939,10,263,'Number of Missing Entities','تعداد گم شدگان',NULL),(940,10,264,'Participant','مشارکت کننده',NULL),(941,10,264,'Time','زمان',NULL),(942,10,264,'Place','مکان',NULL),(943,10,264,'Vehicle','وسیله نقلیه',NULL),(944,10,264,'Number of Participants','تعداد شرکت کنندگان',NULL),(945,10,264,'Number of Injuries','تعداد مصدومین',NULL),(946,10,264,'Number of Deaths','تعداد مرگ و میر',NULL),(947,10,264,'Number of Missing Entities','تعداد گم شدگان',NULL),(948,10,265,'Participant','مشارکت کننده',NULL),(949,10,265,'Time','زمان',NULL),(950,10,265,'Place','مکان',NULL),(951,10,265,'Vehicle','وسیله نقلیه',NULL),(952,10,265,'Number of Participants','تعداد شرکت کنندگان',NULL),(953,10,265,'Number of Injuries','تعداد مصدومین',NULL),(954,10,265,'Number of Deaths','تعداد مرگ و میر',NULL),(955,10,265,'Number of Missing Entities','تعداد گم شدگان',NULL),(956,10,266,'Participant','مشارکت کننده',NULL),(957,10,266,'Time','زمان',NULL),(958,10,266,'Place','مکان',NULL),(959,10,266,'Vehicle','وسیله نقلیه',NULL),(960,10,266,'Number of Participants','تعداد شرکت کنندگان',NULL),(961,10,266,'Number of Injuries','تعداد مصدومین',NULL),(962,10,266,'Number of Deaths','تعداد مرگ و میر',NULL),(963,10,266,'Number of Missing Entities','تعداد گم شدگان',NULL),(964,10,267,'Source','شروع کننده رویداد',NULL),(968,10,267,'Target','هدف رویداد',NULL),(969,10,267,'Time','زمان',NULL),(970,10,267,'Place','مکان',NULL),(971,10,267,'Number of Targets','تعداد اهداف رویداد',NULL),(972,10,268,'Source','شروع کننده رویداد',NULL),(973,10,268,'Time','زمان',NULL),(974,10,268,'Place','مکان',NULL),(975,10,268,'Artifact','محصول',NULL),(976,10,174,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(977,10,174,'Vehicle','وسیله نقلیه',NULL),(978,10,175,'Source','شروع کننده رویداد',NULL),(983,10,223,'Target','مقصد رویداد',NULL),(984,10,223,'Time','زمان',NULL),(985,10,223,'Place','مبدا رویداد',NULL),(986,10,223,'Vehicle','وسیله نقلیه',NULL),(987,10,175,'Target','مقصد رویداد',NULL),(988,10,175,'Time','زمان',NULL),(989,10,175,'Place','مبدا رویداد',NULL),(990,10,175,'Artifact','محصول',NULL),(991,10,175,'Vehicle','وسیله نقلیه',NULL),(992,10,163,'Place','مکان',NULL),(993,10,270,'Source','شروع کننده رویداد',NULL),(994,10,270,'Target','هدف رویداد',NULL),(995,10,270,'Time','زمان',NULL),(996,10,270,'Place','مکان',NULL),(997,10,270,'Number of Sources','تعداد شروع کنندگان رویداد',NULL),(998,10,270,'Number of Targets','تعداد اهداف رویداد',NULL),(999,10,270,'Number of Injuries','تعداد مصدومین',NULL),(1000,10,270,'Number of Deaths','تعداد مرگ و میر',NULL),(1001,10,270,'Number of Missing Entities','تعداد گم شدگان',NULL),(1002,10,270,'Number of Destructions','تعداد ویرانی ها',NULL),(1003,10,271,'Participant','مشارکت کننده',NULL),(1004,10,271,'Time','زمان',NULL),(1005,10,271,'Place','مکان',NULL),(1006,10,271,'Number of Injuries','تعداد مصدومین',NULL),(1007,10,271,'Number of Deaths','تعداد مرگ و میر',NULL),(1008,10,271,'Number of Missing Entities','تعداد گم شدگان',NULL),(1009,10,271,'Number of Destructions','تعداد ویرانی ها',NULL),(1010,10,272,'Participant','مشارکت کننده',NULL),(1011,10,272,'Time','زمان',NULL),(1012,10,272,'Place','مکان',NULL),(1013,10,272,'Number of Injuries','تعداد مصدومین',NULL),(1014,10,272,'Number of Deaths','تعداد مرگ و میر',NULL),(1015,10,272,'Number of Missing Entities','تعداد گم شدگان',NULL),(1016,10,272,'Number of Destructions','تعداد ویرانی ها',NULL),(1017,10,273,'Participant','مشارکت کننده',NULL),(1018,10,273,'Time','زمان',NULL),(1019,10,273,'Place','مکان',NULL),(1020,10,273,'Number of Injuries','تعداد مصدومین',NULL),(1021,10,273,'Number of Deaths','تعداد مرگ و میر',NULL),(1022,10,273,'Number of Missing Entities','تعداد گم شدگان',NULL),(1023,10,273,'Number of Destructions','تعداد ویرانی ها',NULL),(2410,10,271,'Number of Participants','تعداد مشارکت کننده',NULL),(2411,10,272,'Number of Participants','تعداد مشارکت کننده',NULL),(2412,10,273,'Number of Participants','تعداد مشارکت کننده',NULL),(3767,10,260,'Occupation','سمت شغلی',NULL),(3768,10,191,'Number of Targets','تعداد اهداف رویداد',NULL),(3769,10,794,'Source','شروع کننده رویداد',NULL),(3770,10,794,'Target','هدف رویداد',NULL),(3771,10,794,'Time','زمان',NULL),(3772,10,794,'Place','مکان',NULL),(3773,10,794,'Price','قیمت',NULL),(3774,10,795,'Source','شروع کننده رویداد',NULL),(3775,10,795,'Target','هدف رویداد',NULL),(3776,10,795,'Time','زمان',NULL),(3777,10,795,'Place','مکان',NULL),(3778,10,795,'Price','قیمت',NULL),(4452,10,235,'Duration','مدت زمان اجرای رویداد',NULL),(4453,10,932,'Source','شروع کننده رویداد',NULL),(4454,10,932,'Target','هدف رویداد',NULL),(4455,10,932,'Time','زمان',NULL),(4456,10,932,'Place','مکان',NULL),(4457,10,932,'Duration','مدت زمان اجرای رویداد',NULL),(4458,10,933,'Participant','مشارکت کننده',NULL),(4459,10,933,'Time','زمان',NULL),(4460,10,933,'Place','مکان',NULL),(4461,10,933,'Number of Participants','تعداد شرکت کنندگان',NULL),(4462,10,214,'Number of Targets','تعداد اهداف رویداد',NULL),(4463,10,215,'Number of Targets','تعداد اهداف رویداد',NULL);
/*!40000 ALTER TABLE `arguments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entities`
--

DROP TABLE IF EXISTS `entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `des` text COLLATE utf8_persian_ci,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `parent` (`parent`),
  CONSTRAINT `entities_ibfk_0` FOREIGN KEY (`parent`) REFERENCES `entities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `entities_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entities`
--

LOCK TABLES `entities` WRITE;
/*!40000 ALTER TABLE `entities` DISABLE KEYS */;
INSERT INTO `entities` VALUES (12,10,'Organization','سازمان',NULL),(13,10,'Geo-Political Entity','سیاسی-جغرافیایی',NULL),(14,10,'Location','مکان',NULL),(15,10,'Person','انسان',NULL),(16,10,'Animal','حیوان',NULL),(17,10,'Facility','اشیا',NULL),(18,10,'Time','زمان',NULL),(19,10,'Numeric','عددی',NULL),(20,10,'Occupation','سمت شغلی',NULL),(21,10,'Contact-Info','اطلاعات تماس',NULL),(22,10,'Disease','بیماری',NULL);
/*!40000 ALTER TABLE `entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `des` text COLLATE utf8_persian_ci,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `events_ibfk_0` FOREIGN KEY (`parent`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=934 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (121,10,'Life','زندگی',NULL),(122,10,'Natural Disasters','بلاهای طبیعی',NULL),(123,10,'Environment','محیط زیست',NULL),(124,10,'Crime','جرم',NULL),(125,10,'Justice','عدالت',NULL),(126,10,'Business','کسب و کار',NULL),(127,10,'Politics','سیاست',NULL),(128,10,'Social','اقدام جمعی',NULL),(129,10,'Cyberspace','فضای مجازی',NULL),(130,10,'Election','انتخابات',NULL),(131,10,'Accident','حوادث',NULL),(132,10,'Science','علم و دانش',NULL),(134,10,'Death','مردن',121),(135,10,'Injury','مجروح، زخمی، مریض شدن',121),(136,10,'Birth','متولد شدن',121),(137,10,'Drowning','غرق شدن',121),(138,10,'Survival','نجات یافتن',121),(139,10,'Marriage','ازدواج',121),(140,10,'Divorce','طلاق',121),(141,10,'Hospitalization','بستری شدن',121),(142,10,'Missing','گم شدن، مفقود شدن',121),(143,10,'Immigration','مهاجرت',121),(144,10,'Suicide','خودکشی',121),(145,10,'Volcanic Eruption','فوران آتشفشان',122),(146,10,'Tsunami','سونامی',122),(147,10,'Earthquake','زمین لرزه، پیش لرزه، پس لرزه',122),(148,10,'Landslide','رانش زمین',122),(149,10,'Avalanche','بهمن',122),(150,10,'Bad Weather',' هوای نامناسب (بارانی، برفی، مه، گرما، تگرگ، غبار)',122),(151,10,'Storm','طوفان',122),(152,10,'Flood','سیل',122),(154,10,'Drought','خشکسالی',122),(156,10,'Pollution','آلودگی',123),(157,10,'Epidemics','بیماری های فراگیر، ویروس، اپیدمی',123),(158,10,'Hunting','شکار',123),(159,10,'Extinction','انقراض',123),(161,10,'Emergency Evacuation','تخلیه ناگهانی',123),(162,10,'Resource Shortages',' کمبود یا قطع منابع (غذا، برق، آب و اینترنت)',123),(163,10,'Quarantine','قرنطینه',123),(164,10,'Attack','حمله، مبارزه، یورش، پرتاب موشک',124),(165,10,'Explosion','انفجار',124),(166,10,'Hostage Crisis','گروگان گیری',124),(169,10,'Destruction','تخریب/ خسارت',124),(170,10,'Sex assault','تجاوز جنسی',124),(171,10,'Kidnapping','آدم ربایی',124),(172,10,'Homicide','قتل، کشتن، ترور',124),(173,10,'Torture','شکنجه، آزار',124),(174,10,'Escape','فرار کردن',124),(175,10,'Smuggling','قاچاق',124),(176,10,'Robbery','دزدیدن',124),(177,10,'Economic corruption','فساد مالی (اختلاس، رشوه، احتکار، کلاهبرداری، سو استفاده، پول شویی)',124),(178,10,'Espionage','جاسوسی',124),(179,10,'Copyright violation','نقض کپی رایت',124),(180,10,'Human right violation','نقض حقوق بشر',124),(182,10,'Privacy Violation','نقض حریم خصوصی',124),(183,10,'Complaint','شکایت/اتهام',125),(184,10,'Arrest','دستگیر کردن، بازداشت',125),(185,10,'Pardoning','بخشیدن، عوف',125),(186,10,'Prosecution','تعقیب کردن',125),(187,10,'Execution','اعدام',125),(188,10,'Trial','محاکمه، دادگاهی کردن',125),(189,10,'Surrender','تسلیم شدن',125),(190,10,'Prisoner Release','آزادی زندانی',125),(191,10,'Imprisonment','زندانی کردن، حبس',125),(192,10,'Fining','جریمه، جزای نقدی',125),(208,10,'Start-Position','شروع اشتغال، انتصاب',126),(209,10,'Recruitment','استخدام',126),(210,10,'End Position','ترک کار، اخراج شدن، استعفا',126),(211,10,'Money Transfer','انتقال پول، پرداخت',126),(212,10,'Ownership Transfer','انتقال مالکیت، خرید و فروش',126),(213,10,'Investment','سرمایه گذاری',126),(214,10,'Produce','تولید، توسعه',126),(215,10,'Release','انتشار، معرفی، چاپ',126),(216,10,'Pricing','قیمت گذاری',126),(217,10,'Price Rise','افزایش قیمت',126),(218,10,'Price Drop','کاهش قیمت',126),(219,10,'Production Rise','افزایش تولید',126),(220,10,'Production Drop','کاهش تولید',126),(221,10,'Establishment','تاسیس',126),(222,10,'Bankruptcy','ورشکستگی',126),(223,10,'Travel','سفر/اعزام',127),(224,10,'Cooperation','همکاری، مشارکت و اتحاد',127),(225,10,'End Cooperation','اتمام همکاری',127),(226,10,'Aid','کمک کردن، حمایت',127),(227,10,'Import','واردات',127),(228,10,'Export','صادارت',127),(229,10,'Settlement','انجام توافق/قرارداد/قطع نامه',127),(230,10,'Breach of Settlement','نقض توافق/قرارداد/قطع نامه',127),(231,10,'End Settlement','پایان توافق/قرارداد/قطع نامه',127),(232,10,'Meeting','جلسه، بازدید، مذاکره، مصاحبه، نشست',127),(233,10,'Military Exercise','مانور نظامی',127),(234,10,'Impeachment','استیضاح',127),(235,10,'Sanction','تحریم کردن',127),(236,10,'Threat','تهدید کردن',127),(237,10,'Extradite','استرداد افراد/ اشیا',127),(238,10,'Exile','تبعید',127),(239,10,'Apologize','عذر خواهی',127),(240,10,'Deport','اخراج کردن ازیک  کشور',127),(241,10,'Interference','مداخله',127),(242,10,'Troops Withdrawal','خروج نظامی',127),(243,10,'Criticism','انتقاد کردن',127),(244,10,'Condemn','محکوم کردن',127),(245,10,'Dissolution','انحلال گروه/سازمان',127),(246,10,'Refuge','پناهندگی',127),(247,10,'Conflict','زد و خورد، درگیری، مشاجره، اختلاف',127),(248,10,'Conquering','فتح نظامی',127),(249,10,'Occupy','تسخیر کردن، تصرف کردن، اشغال',127),(250,10,'War','جنگ',127),(251,10,'End War','اتمام جنگ/ آتش بس/ صلح',127),(252,10,'Suppress','سرکوب  کردن',127),(254,10,'Coup','کودتا',128),(255,10,'Ceremony','مراسم، فستیوال، نمایشگاه',128),(258,10,'CyberAttack','حمله سایبری',129),(259,10,'Information Disclosure','افشای اطلاعات',129),(260,10,'Holding Election','برگزاری انتخابات',130),(261,10,'Election Results','نتیجه انتخابات',130),(262,10,'Election Candidacy','کاندید شدن در انتخابات',130),(263,10,'Traffic Collision','تصادفات وسایل نقلیه‌ی زمینی',131),(264,10,'Rail Accidents','تصادفات ریلی',131),(265,10,'Aviation Accidents','تصادفات هوایی',131),(266,10,'Marine Accidents','تصادفات دریایی',131),(267,10,'Discovery','اکتشاف',132),(268,10,'Invention','اختراع',132),(270,10,'Protest','اعتراض، شورش و تجمع',128),(271,10,'Collapse','سقوط آوار یا ساختمان',131),(272,10,'Hazardous material spill','نشت مواد خطرناک',131),(273,10,'Fire','آتش سوزی',131),(794,10,'Initial Public Offering (IPO)','عرضه اولیه شرکت/سازمان',126),(795,10,'Capital Increase','افزایش سرمایه شرکت/سازمان',126),(932,10,'Ban','ممنوع کردن، مسدود کردن',127),(933,10,'Revolution','انقلاب',128);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_phrases`
--

DROP TABLE IF EXISTS `project_phrases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_phrases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `time` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `link` text COLLATE utf8_persian_ci,
  `num_of_visit` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `project` (`project`),
  CONSTRAINT `project_phrases_ibfk_0` FOREIGN KEY (`project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13347 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_phrases`
--

LOCK TABLES `project_phrases` WRITE;
/*!40000 ALTER TABLE `project_phrases` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_phrases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_phrases_status`
--

DROP TABLE IF EXISTS `project_phrases_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_phrases_status` (
  `phrases` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  KEY `phrases` (`phrases`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `project_phrases_status_ibfk_0` FOREIGN KEY (`phrases`) REFERENCES `project_phrases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_status_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_phrases_status`
--

LOCK TABLES `project_phrases_status` WRITE;
/*!40000 ALTER TABLE `project_phrases_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_phrases_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_phrases_words`
--

DROP TABLE IF EXISTS `project_phrases_words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_phrases_words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phrases` int(11) NOT NULL,
  `word` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `words_ibfk_0` (`phrases`),
  CONSTRAINT `project_phrases_words_ibfk_0` FOREIGN KEY (`phrases`) REFERENCES `project_phrases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=172416 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_phrases_words`
--

LOCK TABLES `project_phrases_words` WRITE;
/*!40000 ALTER TABLE `project_phrases_words` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_phrases_words` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_phrases_words_arguments`
--

DROP TABLE IF EXISTS `project_phrases_words_arguments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_phrases_words_arguments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `word` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `entity` int(11) NOT NULL,
  `argument` int(11) NOT NULL,
  `type` varchar(2) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_phrases_words_arguments_ibfk_0` (`u_id`),
  KEY `project_phrases_words_arguments_ibfk_1` (`word`),
  KEY `project_phrases_words_arguments_ibfk_4` (`argument`),
  KEY `project_phrases_words_arguments_ibfk_5` (`parent`),
  KEY `project_phrases_words_arguments_ibfk_6` (`event`),
  KEY `project_phrases_words_arguments_ibfk_7` (`entity`),
  CONSTRAINT `project_phrases_words_arguments_ibfk_0` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_arguments_ibfk_1` FOREIGN KEY (`word`) REFERENCES `project_phrases_words` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_arguments_ibfk_4` FOREIGN KEY (`argument`) REFERENCES `arguments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_arguments_ibfk_5` FOREIGN KEY (`parent`) REFERENCES `project_phrases_words_arguments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_arguments_ibfk_6` FOREIGN KEY (`event`) REFERENCES `project_phrases_words_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_arguments_ibfk_7` FOREIGN KEY (`entity`) REFERENCES `project_phrases_words_entities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32696 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_phrases_words_arguments`
--

LOCK TABLES `project_phrases_words_arguments` WRITE;
/*!40000 ALTER TABLE `project_phrases_words_arguments` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_phrases_words_arguments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_phrases_words_entities`
--

DROP TABLE IF EXISTS `project_phrases_words_entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_phrases_words_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `word` int(11) NOT NULL,
  `entity` int(11) NOT NULL,
  `type` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `args` (`entity`),
  KEY `word` (`word`),
  KEY `parent` (`parent`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `project_phrases_words_entities_ibfk_0` FOREIGN KEY (`parent`) REFERENCES `project_phrases_words_entities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_entities_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_entities_ibfk_2` FOREIGN KEY (`word`) REFERENCES `project_phrases_words` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_entities_ibfk_3` FOREIGN KEY (`entity`) REFERENCES `entities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46463 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_phrases_words_entities`
--

LOCK TABLES `project_phrases_words_entities` WRITE;
/*!40000 ALTER TABLE `project_phrases_words_entities` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_phrases_words_entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_phrases_words_events`
--

DROP TABLE IF EXISTS `project_phrases_words_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_phrases_words_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `word` int(11) NOT NULL,
  `events` int(11) NOT NULL,
  `type` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `tens` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `asserted` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `polarity` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events` (`events`),
  KEY `word` (`word`),
  KEY `parent` (`parent`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `project_phrases_words_events_ibfk_0` FOREIGN KEY (`events`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_events_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `project_phrases_words_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_events_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_words_events_ibfk_3` FOREIGN KEY (`word`) REFERENCES `project_phrases_words` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11960 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_phrases_words_events`
--

LOCK TABLES `project_phrases_words_events` WRITE;
/*!40000 ALTER TABLE `project_phrases_words_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_phrases_words_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_users`
--

DROP TABLE IF EXISTS `project_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_users` (
  `project` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  KEY `project` (`project`),
  KEY `user` (`u_id`),
  CONSTRAINT `project_users_ibfk_0` FOREIGN KEY (`project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_users_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_users`
--

LOCK TABLES `project_users` WRITE;
/*!40000 ALTER TABLE `project_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `des` text COLLATE utf8_persian_ci,
  `user_num` int(11) NOT NULL,
  `rtl` tinyint(1) NOT NULL DEFAULT '0',
  `annotation_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `user_group` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `limit_per_page` int(11) NOT NULL DEFAULT '25',
  `rtl` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (10,'admin','123',2,NULL,25,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-20 18:28:55
