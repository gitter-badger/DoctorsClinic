-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: doctorsclinic
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
  KEY `e_id` (`e_id`,`p_id`,`checkup_type`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `employee-diagnosis` FOREIGN KEY (`e_id`) REFERENCES `employees_info` (`e_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient-diagnosis` FOREIGN KEY (`p_id`) REFERENCES `patient_info` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnosis_info`
--

LOCK TABLES `diagnosis_info` WRITE;
/*!40000 ALTER TABLE `diagnosis_info` DISABLE KEYS */;
INSERT INTO `diagnosis_info` VALUES (1,1,1,'ECG'),(1,2,2,'X-ray'),(1,4,4,'Malaria parasite'),(1,5,5,'Widal test'),(1,7,7,'Haemoglobin Checkup');
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
  `e_id` int(11) NOT NULL,
  `fees` int(11) NOT NULL DEFAULT '150',
  `specialisation` varchar(500) NOT NULL,
  PRIMARY KEY (`doctor_id`),
  UNIQUE KEY `employee_id` (`e_id`),
  KEY `fees` (`fees`,`specialisation`),
  CONSTRAINT `eployee-doctor` FOREIGN KEY (`e_id`) REFERENCES `employees_info` (`e_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors_info`
--

LOCK TABLES `doctors_info` WRITE;
/*!40000 ALTER TABLE `doctors_info` DISABLE KEYS */;
INSERT INTO `doctors_info` VALUES (1,1,150,'Heart'),(2,5,150,'General Physician'),(3,6,200,'Gastriologist'),(4,7,175,'General Physician'),(5,8,200,'Dermatologist');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees_info`
--

LOCK TABLES `employees_info` WRITE;
/*!40000 ALTER TABLE `employees_info` DISABLE KEYS */;
INSERT INTO `employees_info` VALUES (1,'Viditi Agarwal','E-10/99 Chitrakoot, Jhotwara, Jaipur','Doctor','Monday','18:00:00','22:00:00','0141-2440413'),(2,'Raghavendra Sharma','99-MadanGopal Colony, Delhi','Lab Assistant','Sunday','09:00:00','20:00:00','7420831384'),(3,'Geetika Sharma','31-A Rakesh Flats, RamuNagar','Nurse','Wednesday','10:00:00','18:00:00','98457354568'),(4,'Ramu Kaka','Doctors Clinic, Extra rooms, Jaipur','Sweeper','None','08:00:00','17:00:00','9895125654'),(5,'Anchal Pandey','E-15','Doctor','Monday','11:01:00','17:11:00','0141-12313123'),(6,'Abhijeet Halwai','8-A, Halwai Colony, Jaipur','Doctor','Monday','13:00:00','18:00:00','8756498456'),(7,'Mahesh Tiwari','4/23 Sector-4, Vidhya Dhar Nagar','Doctor','Friday','10:00:00','17:00:00','9829032600'),(8,'Naresh Gujjar','4-3A. Chitrakoot Scheme, Jaipur','Doctor','Thursday','12:00:00','16:00:00','94451234558');
/*!40000 ALTER TABLE `employees_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_info`
--

DROP TABLE IF EXISTS `login_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_info` (
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `account_type` set('admin','patient','doctor','lab_assistant') NOT NULL,
  `e_id` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_info`
--

LOCK TABLES `login_info` WRITE;
/*!40000 ALTER TABLE `login_info` DISABLE KEYS */;
INSERT INTO `login_info` VALUES ('admin1','admin11','admin',0),('doctor1','doctor11','doctor',1),('doctor2','doctor22','doctor',5),('doctor3','doctor33','doctor',6),('doctor4','doctor44','doctor',7),('doctor5','doctor55','doctor',8),('patient1','patient11','patient',1),('patient2','patient22','patient',2);
/*!40000 ALTER TABLE `login_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicine_info`
--

DROP TABLE IF EXISTS `medicine_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicine_info` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity_in_pack` int(11) NOT NULL,
  PRIMARY KEY (`medicine_id`),
  KEY `medicine_name` (`medicine_name`,`quantity`,`price`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicine_info`
--

LOCK TABLES `medicine_info` WRITE;
/*!40000 ALTER TABLE `medicine_info` DISABLE KEYS */;
INSERT INTO `medicine_info` VALUES (1,'Combiflam',100,50,10),(2,'Crocin',197,37,10),(3,'Ofloxacin',200,99,6),(4,'Erythromycin',200,120,6),(5,'Erythromycin',300,120,6),(6,'Chloroquine CV',100,125,4),(7,'Primaquine CV',100,150,5),(8,'Artesunate  SV 200',150,160,6),(9,'Nimesulide',400,30,10),(10,'Ceftriaxone',200,145,6);
/*!40000 ALTER TABLE `medicine_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicines_prescribed`
--

DROP TABLE IF EXISTS `medicines_prescribed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicines_prescribed` (
  `p_id` int(11) NOT NULL,
  `medicines_set` varchar(1000) NOT NULL,
  PRIMARY KEY (`p_id`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `medicine-patient` FOREIGN KEY (`p_id`) REFERENCES `patient_info` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicines_prescribed`
--

LOCK TABLES `medicines_prescribed` WRITE;
/*!40000 ALTER TABLE `medicines_prescribed` DISABLE KEYS */;
INSERT INTO `medicines_prescribed` VALUES (1,'1, 2, 3, 4, 5'),(2,'4,5,3,2'),(3,'1,2,3,4'),(4,'1,2,3,5'),(5,'2,4,6,7'),(6,'7,8,9'),(7,'1,2,3,4'),(8,'1,2,3,4,5'),(9,'6,5,4,3'),(10,'3,6,8,9');
/*!40000 ALTER TABLE `medicines_prescribed` ENABLE KEYS */;
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
  KEY `treated_by` (`treated_by`),
  KEY `p_id` (`p_id`),
  KEY `treated_by_2` (`treated_by`),
  CONSTRAINT `doctor-patient` FOREIGN KEY (`treated_by`) REFERENCES `doctors_info` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_info`
--

LOCK TABLES `patient_info` WRITE;
/*!40000 ALTER TABLE `patient_info` DISABLE KEYS */;
INSERT INTO `patient_info` VALUES (1,'M','Raghav Sapera',19,'9873193891','Jaundice',1),(2,'M','Vaibhav Sharma',20,'8483426543','Malaria',2),(3,'F','Tiya Joshi',15,'7431234312','',2),(4,'M','Aviral Jain',18,'9981234234','',3),(5,'F','Anjali saxena',18,'9909124578','Typhoid',5),(6,'M','Abhash pandey',21,'9989124537','',4),(7,'M','Aakash garg',23,'9909876905','Typhoid',4),(8,'M','Prateek Khurana',21,'9978723412','Viral fever',2),(9,'M','Ashish Singh',21,'9912312343','',1),(10,'M','Akshat vijay',19,'7654123098','',5),(11,'M','Ram Singh',44,'8980765431','Viral fever',4),(12,'M','Ashutosh Mishra',15,'8767564321','',3),(13,'M','Rajesh Shukla',13,'9987234156','',3),(14,'F','Pooja Chaurasia',19,'9908765125','Jaundice',2),(15,'M','Sahil  Nigam',24,'7898675125','Malaria',3),(16,'M','Siddhart Singh',17,'9978654128','Viral fever',1),(17,'F','Ananya Ahuja',19,'9978125673','Typhoid',1),(18,'F','Anshika Pandey',19,'9908563891','Malaria',4),(19,'F','Aarti Jhunjhunwala',18,'8978123657','Malaria',4),(20,'M','Manish Kant Thakur',27,'8897671233','Filaria',4);
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
  KEY `date_of_admit` (`date_of_admit`,`date_of_discharge`,`occupancy_type`,`medical_cost`),
  KEY `p_id_2` (`p_id`),
  CONSTRAINT `patient-room` FOREIGN KEY (`p_id`) REFERENCES `patient_info` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_occupancy`
--

LOCK TABLES `patient_occupancy` WRITE;
/*!40000 ALTER TABLE `patient_occupancy` DISABLE KEYS */;
INSERT INTO `patient_occupancy` VALUES (1,'2014-11-12','2014-11-13','',200,1),(3,'2014-02-03','2014-02-04','Oxygen Mask',300,2),(2,'2014-10-30','2014-10-29','',200,3);
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

-- Dump completed on 2014-11-13 23:31:57
