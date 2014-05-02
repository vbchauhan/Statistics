-- MySQL dump 10.13  Distrib 5.5.9, for Win32 (x86)
--
-- Host: localhost    Database: sglstatistics
-- ------------------------------------------------------
-- Server version	5.5.8

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
-- Current Database: `sglstatistics`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `sglstatistics` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sglstatistics`;

--
-- Table structure for table `daily_data`
--

DROP TABLE IF EXISTS `daily_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_data` (
  `d_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `d_date` date NOT NULL,
  `p_id` int(10) NOT NULL,
  `s_id` int(10) NOT NULL,
  `d_count` int(3) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`d_id`),
  UNIQUE KEY `d_id_UNIQUE` (`d_id`),
  KEY `s_id` (`s_id`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `p_id` FOREIGN KEY (`p_id`) REFERENCES `parameter` (`p_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `s_id` FOREIGN KEY (`s_id`) REFERENCES `slot` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_data`
--

LOCK TABLES `daily_data` WRITE;
/*!40000 ALTER TABLE `daily_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `l_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`l_id`),
  UNIQUE KEY `l_id_UNIQUE` (`l_id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'priddyreserves','33734cb7c3d4451060cc456bd6f9fd95');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `month`
--

DROP TABLE IF EXISTS `month`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `month` (
  `month_id` int(11) NOT NULL,
  `month_name` varchar(45) NOT NULL,
  PRIMARY KEY (`month_id`),
  UNIQUE KEY `m_name_UNIQUE` (`month_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `month`
--

LOCK TABLES `month` WRITE;
/*!40000 ALTER TABLE `month` DISABLE KEYS */;
INSERT INTO `month` VALUES (4,'April'),(8,'August'),(12,'December'),(2,'February'),(1,'January'),(7,'July'),(6,'June'),(3,'March'),(5,'May'),(11,'November'),(10,'October'),(9,'September');
/*!40000 ALTER TABLE `month` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monthly_data`
--

DROP TABLE IF EXISTS `monthly_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monthly_data` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(10) DEFAULT NULL,
  `m_count` int(4) unsigned zerofill NOT NULL,
  `month_id` int(11) NOT NULL,
  `m_year` year(4) NOT NULL,
  PRIMARY KEY (`m_id`),
  KEY `month_id` (`month_id`),
  KEY `pid` (`p_id`),
  CONSTRAINT `month_id` FOREIGN KEY (`month_id`) REFERENCES `month` (`month_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pid` FOREIGN KEY (`p_id`) REFERENCES `parameter` (`p_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monthly_data`
--

LOCK TABLES `monthly_data` WRITE;
/*!40000 ALTER TABLE `monthly_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `monthly_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parameter`
--

DROP TABLE IF EXISTS `parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameter` (
  `p_id` int(10) NOT NULL,
  `p_name` varchar(45) NOT NULL,
  `p_item_code` varchar(45) DEFAULT NULL,
  `p_type` varchar(45) NOT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `p_item_code_UNIQUE` (`p_item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameter`
--

LOCK TABLES `parameter` WRITE;
/*!40000 ALTER TABLE `parameter` DISABLE KEYS */;
INSERT INTO `parameter` VALUES (1,'Number of Patrons',NULL,'Daily'),(2,'Computer Usage',NULL,'Daily'),(4,'Number of Group Study Rooms',NULL,'Daily'),(5,'Reference Questions - WalkIn',NULL,'Daily'),(6,'Reference Questions - Phone',NULL,'Daily'),(7,'Reference Questions - Email',NULL,'Daily'),(8,'Library Instructions - One to One Tutorial',NULL,'Daily'),(11,'Headphones Usage',NULL,'Monthly'),(12,'Laptop and VGA Cables Usage',NULL,'Monthly'),(14,'IPad Usage',NULL,'Monthly'),(16,'Number of Materials Previewed',NULL,'Monthly'),(17,'Number of Reshelved Items Not on Loan',NULL,'Monthly'),(18,'Number of Hours Library is Staffed',NULL,'Monthly'),(19,'Number of General Loans',NULL,'Monthly'),(20,'Number of Reserve Loans',NULL,'Monthly'),(21,'Number of Holds',NULL,'Monthly'),(22,'Number of Materials Transferred',NULL,'Monthly'),(23,'Number of Materials Returned',NULL,'Monthly'),(24,'Number of Person Passing Turnstile',NULL,'Monthly'),(25,'Library Instructions by SG Librarians',NULL,'Monthly');
/*!40000 ALTER TABLE `parameter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slot`
--

DROP TABLE IF EXISTS `slot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slot` (
  `s_id` int(10) NOT NULL,
  `s_name` varchar(45) NOT NULL,
  PRIMARY KEY (`s_id`),
  UNIQUE KEY `s_name_UNIQUE` (`s_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slot`
--

LOCK TABLES `slot` WRITE;
/*!40000 ALTER TABLE `slot` DISABLE KEYS */;
INSERT INTO `slot` VALUES (18,'01:00 am-02:00 am'),(6,'01:00 pm-02:00 pm'),(19,'02:00 am-03:00 am'),(7,'02:00 pm-03:00 pm'),(20,'03:00 am-04:00 am'),(8,'03:00 pm-04:00 pm'),(21,'04:00 am-05:00 am'),(9,'04:00 pm-05:00 pm'),(22,'05:00 am-06:00 am'),(10,'05:00 pm-06:00 pm'),(23,'06:00 am-07:00 am'),(11,'06:00 pm-07:00 pm'),(24,'07:00 am-08:00 am'),(12,'07:00 pm-08:00 pm'),(1,'08:00 am-09:00 am'),(13,'08:00 pm-09:00 pm'),(2,'09:00 am-10:00 am'),(14,'09:00 pm-10:00 pm'),(3,'10:00 am-11:00 am'),(15,'10:00 pm-11:00 pm'),(4,'11:00 am-12:00 pm'),(16,'11:00 pm-12:00 am'),(17,'12:00 am-01:00 am'),(5,'12:00 pm-01:00 pm');
/*!40000 ALTER TABLE `slot` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-08-13  0:23:59
