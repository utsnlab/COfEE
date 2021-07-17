-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: annotate_data
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB-1:10.4.17+maria~stretch

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
  `des` text COLLATE utf8_persian_ci DEFAULT NULL,
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
-- Table structure for table `entities`
--

DROP TABLE IF EXISTS `entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `des` text COLLATE utf8_persian_ci DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `parent` (`parent`),
  CONSTRAINT `entities_ibfk_0` FOREIGN KEY (`parent`) REFERENCES `entities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `entities_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `des` text COLLATE utf8_persian_ci DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `events_ibfk_0` FOREIGN KEY (`parent`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=934 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `link` text COLLATE utf8_persian_ci DEFAULT NULL,
  `num_of_visit` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `project` (`project`),
  CONSTRAINT `project_phrases_ibfk_0` FOREIGN KEY (`project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13347 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_phrases_status`
--

DROP TABLE IF EXISTS `project_phrases_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_phrases_status` (
  `phrases` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  KEY `phrases` (`phrases`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `project_phrases_status_ibfk_0` FOREIGN KEY (`phrases`) REFERENCES `project_phrases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `project_phrases_status_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=32706 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `des` text COLLATE utf8_persian_ci DEFAULT NULL,
  `user_num` int(11) NOT NULL,
  `rtl` tinyint(1) NOT NULL DEFAULT 0,
  `annotation_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `limit_per_page` int(11) NOT NULL DEFAULT 25,
  `rtl` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-11  8:06:02
