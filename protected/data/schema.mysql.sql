-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: smartbullet
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `text` text,
  `post_id` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_from` int(11) DEFAULT NULL,
  `user_to` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `del1` int(11) DEFAULT NULL,
  `del2` int(11) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`id`),
  KEY `user_from` (`user_from`),
  KEY `user_to` (`user_to`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_from`) REFERENCES `user` (`id`),
  CONSTRAINT `message_ibfk_2` FOREIGN KEY (`user_to`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,2,1,0,'2014-10-20 00:00:00',0,0,'Hello!!!!!:))) How are you????:))))))'),(2,1,2,0,'2014-11-17 15:06:56',0,0,'Good'),(3,1,2,0,'2014-11-17 15:07:24',0,0,'Blalalalalalalalalalalalalalalalalala');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `text` text,
  `wall_id` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `wall_id` (`wall_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`wall_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (6,4,'sss',4,'2014-11-13 16:50:01'),(7,4,'kh',2,'2014-11-17 15:12:00');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relationship`
--

DROP TABLE IF EXISTS `relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relationship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) DEFAULT NULL,
  `user2` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user1` (`user1`),
  KEY `user2` (`user2`),
  CONSTRAINT `relationship_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user` (`id`),
  CONSTRAINT `relationship_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relationship`
--

LOCK TABLES `relationship` WRITE;
/*!40000 ALTER TABLE `relationship` DISABLE KEYS */;
INSERT INTO `relationship` VALUES (13,3,1,0,0),(14,1,3,0,0),(39,1,4,1,1),(40,4,1,2,1),(41,1,2,1,0),(42,2,1,2,0),(43,4,2,1,0),(44,2,4,2,0);
/*!40000 ALTER TABLE `relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `brth` date DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `photo` varchar(32) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'MyLogin','123','1990-10-15','Novosibirsk','login@mail.ru',10000,'photo.jpg','2014-11-12 00:00:00','Ivan','Ivanov'),(2,'User2','123','0000-00-00','SPB','',500,'','0000-00-00 00:00:00','Vasya',NULL),(3,'Anna','123','1990-10-15','NSK','a@mail.ru',4000,'','0000-00-00 00:00:00','',NULL),(4,'User3','123','1980-01-01','','',NULL,'','0000-00-00 00:00:00','',NULL),(5,'123','123','0000-00-00','','',NULL,'arr2.jpg','0000-00-00 00:00:00','',NULL),(15,'Koko','123','0000-00-00','','',50000,'e00a12959b.jpg','0000-00-00 00:00:00','Dur',NULL);
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

-- Dump completed on 2014-11-19 19:51:29
