-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: doctorsclinic
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
-- Table structure for table `diagnosis_info`
--

DROP TABLE IF EXISTS `diagnosis_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diagnosis_info` (
  `e_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `sample_id` int(11) NOT NULL,
  `checkup_type` varchar(40) NOT NULL,
  PRIMARY KEY (`sample_id`),
  KEY `e_id` (`e_id`,`p_id`,`checkup_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnosis_info`
--

LOCK TABLES `diagnosis_info` WRITE;
/*!40000 ALTER TABLE `diagnosis_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `diagnosis_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctors_info`
--

DROP TABLE IF EXISTS `doctors_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors_info` (
  `doctor_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `fees` int(11) NOT NULL DEFAULT '150',
  `specialisation` varchar(500) NOT NULL,
  PRIMARY KEY (`doctor_id`),
  UNIQUE KEY `employee_id` (`employee_id`),
  KEY `fees` (`fees`,`specialisation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors_info`
--

LOCK TABLES `doctors_info` WRITE;
/*!40000 ALTER TABLE `doctors_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctors_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees_info`
--

DROP TABLE IF EXISTS `employees_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees_info` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `off_day` varchar(100) NOT NULL,
  `duty_start_time` time NOT NULL,
  `duty_end_time` time NOT NULL,
  `phone` varchar(16) NOT NULL,
  PRIMARY KEY (`e_id`),
  UNIQUE KEY `phone` (`phone`),
  KEY `name` (`name`,`address`,`type`,`off_day`,`duty_start_time`,`duty_end_time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees_info`
--

LOCK TABLES `employees_info` WRITE;
/*!40000 ALTER TABLE `employees_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `employees_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_info`
--

DROP TABLE IF EXISTS `patient_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_info` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` smallint(6) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `patient_history` varchar(500) NOT NULL,
  `treated_by` int(11) NOT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `phone` (`phone`),
  KEY `gender` (`gender`,`name`,`age`,`patient_history`),
  KEY `treated_by` (`treated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_info`
--

LOCK TABLES `patient_info` WRITE;
/*!40000 ALTER TABLE `patient_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_occupancy`
--

DROP TABLE IF EXISTS `patient_occupancy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_occupancy` (
  `p_id` int(11) NOT NULL,
  `date_of_admit` date NOT NULL,
  `date_of_discharge` date NOT NULL,
  `occupancy_type` varchar(20) NOT NULL,
  `medical_cost` int(11) NOT NULL DEFAULT '100',
  `room_number` int(11) NOT NULL,
  PRIMARY KEY (`room_number`),
  UNIQUE KEY `p_id` (`p_id`),
  KEY `date_of_admit` (`date_of_admit`,`date_of_discharge`,`occupancy_type`,`medical_cost`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_occupancy`
--

LOCK TABLES `patient_occupancy` WRITE;
/*!40000 ALTER TABLE `patient_occupancy` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_occupancy` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-06  0:47:01
