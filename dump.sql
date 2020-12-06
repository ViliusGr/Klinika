-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: klinika
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int DEFAULT NULL,
  `doctor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `info` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_FE38F8446B899279` (`patient_id`),
  KEY `IDX_FE38F84487F4FB17` (`doctor_id`),
  CONSTRAINT `FK_FE38F8446B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  CONSTRAINT `FK_FE38F84487F4FB17` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`emplid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment`
--

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
INSERT INTO `appointment` VALUES (1,1,'1001','2020-12-08','12:00:00','Kosulys');
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `day_of_week`
--

DROP TABLE IF EXISTS `day_of_week`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `day_of_week` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `day_of_week`
--

LOCK TABLES `day_of_week` WRITE;
/*!40000 ALTER TABLE `day_of_week` DISABLE KEYS */;
INSERT INTO `day_of_week` VALUES (1,'Pirmadienis'),(2,'Antradienis'),(3,'Trečiadienis'),(4,'Ketvirtadienis'),(5,'Penktadienis'),(6,'Šeštadienis'),(7,'Sekmadienis');
/*!40000 ALTER TABLE `day_of_week` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `day_schedule`
--

DROP TABLE IF EXISTS `day_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `day_schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `schedule_id` int DEFAULT NULL,
  `day_of_week_id` int DEFAULT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_59763687A40BC2D5` (`schedule_id`),
  KEY `IDX_59763687139A4A41` (`day_of_week_id`),
  CONSTRAINT `FK_59763687139A4A41` FOREIGN KEY (`day_of_week_id`) REFERENCES `day_of_week` (`id`),
  CONSTRAINT `FK_59763687A40BC2D5` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `day_schedule`
--

LOCK TABLES `day_schedule` WRITE;
/*!40000 ALTER TABLE `day_schedule` DISABLE KEYS */;
INSERT INTO `day_schedule` VALUES (1,1,1,'08:00:00','12:00:00'),(2,1,2,'12:00:00','18:00:00'),(3,1,3,'08:00:00','12:00:00'),(4,1,4,'12:00:00','18:00:00'),(5,1,5,'08:00:00','12:00:00'),(6,1,6,'00:00:00','00:00:00'),(7,1,7,'00:00:00','00:00:00');
/*!40000 ALTER TABLE `day_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor` (
  `emplid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialty_id` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`emplid`),
  UNIQUE KEY `UNIQ_1FC0F36AA76ED395` (`user_id`),
  KEY `IDX_1FC0F36A9A353316` (`specialty_id`),
  CONSTRAINT `FK_1FC0F36A9A353316` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id`),
  CONSTRAINT `FK_1FC0F36AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES ('1001','222107',3);
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receiver_id` int DEFAULT NULL,
  `sender_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_B6BD307FCD53EDB6` (`receiver_id`),
  KEY `IDX_B6BD307FF624B39D` (`sender_id`),
  CONSTRAINT `FK_B6BD307FCD53EDB6` FOREIGN KEY (`receiver_id`) REFERENCES `patient` (`id`),
  CONSTRAINT `FK_B6BD307FF624B39D` FOREIGN KEY (`sender_id`) REFERENCES `doctor` (`emplid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,1,'1001','Dėl vizito','Vėluosiu 5 minutes.','2020-12-06 22:49:27');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1ADAD7EBA76ED395` (`user_id`),
  CONSTRAINT `FK_1ADAD7EBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,2);
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doctor_emplid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5A3811FBF8D75B4C` (`doctor_emplid`),
  CONSTRAINT `FK_5A3811FBF8D75B4C` FOREIGN KEY (`doctor_emplid`) REFERENCES `doctor` (`emplid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (1,'1001',60);
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialty`
--

DROP TABLE IF EXISTS `specialty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `specialty` (
  `id` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subgroup` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialty`
--

LOCK TABLES `specialty` WRITE;
/*!40000 ALTER TABLE `specialty` DISABLE KEYS */;
INSERT INTO `specialty` VALUES ('222107','Vaikų slaugytojas','Slaugos specialistai'),('226102','Burnos chirurgas','Gydytojai odontologai'),('226301','Epidemiologas','Aplinkos, profesinės sveikatos ir higienos specialistai'),('226403','Kineziologas','Fizioterapeutai');
/*!40000 ALTER TABLE `specialty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D6496B01BC5B` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin','Administrator','a@a.com','+37069781645','$2y$13$NC/25M.U6ONMPzsGqsTb2Oi6G0zhFD0BJPG.2pAtaRaG0yW3iIlXe','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:10:\"ROLE_ADMIN\";}'),(2,'Vilius','Grimalauskas','vgrimalauskas@yahoo.com','+37069487135','$2y$13$4hsh9Q0oNV/xaVI90MooXuWwQaeBbMODQQuLL9AVx/iVKv7vSueme','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(3,'Jonas','Arlauskas','ja@gmail.com','+37064897345','$2y$13$wHiWaTwJuiG.0Lbn85aax.sSql2NeFwQ/VlbShQvYijUkJgh0vosy','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:11:\"ROLE_DOCTOR\";}');
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

-- Dump completed on 2020-12-06 23:48:51
