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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment`
--

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
INSERT INTO `appointment` VALUES (1,1,'5001','2020-12-12','12:00:00','Kosulys'),(2,2,'5001','2020-12-01','17:00:00','Skauda gerklę'),(3,2,'5001','2020-01-07','12:00:00','Kosulys'),(4,2,'5001','2020-11-25','08:00:00','Kosulys'),(5,1,'5001','2020-11-25','08:15:00','Kosulys'),(6,1,'5001','2020-11-25','15:00:00','Kosulys'),(7,2,'5001','2020-12-11','08:30:00','kosulys'),(8,2,'46546446554','2020-12-11','03:00:00','gf'),(9,2,'46546446554','2020-12-08','01:30:00','htgfhgf');
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `day_schedule`
--

LOCK TABLES `day_schedule` WRITE;
/*!40000 ALTER TABLE `day_schedule` DISABLE KEYS */;
INSERT INTO `day_schedule` VALUES (1,1,1,'08:00:00','20:00:00'),(2,1,2,'08:00:00','12:00:00'),(3,1,3,'08:00:00','20:00:00'),(4,1,4,'12:00:00','20:00:00'),(5,1,5,'08:00:00','20:00:00'),(6,1,6,'00:00:00','00:00:00'),(7,1,7,'00:00:00','00:00:00'),(8,2,1,'08:00:00','20:00:00'),(9,2,2,'08:00:00','20:00:00'),(10,2,3,'08:00:00','20:00:00'),(11,2,4,'08:00:00','20:00:00'),(12,2,5,'08:00:00','20:00:00'),(13,2,6,'00:00:00','00:00:00'),(14,2,7,'00:00:00','00:00:00'),(15,3,1,'01:00:00','03:00:00'),(16,3,2,'01:00:00','03:00:00'),(17,3,3,'01:00:00','03:00:00'),(18,3,4,'01:00:00','03:00:00'),(19,3,5,'01:00:00','03:00:00'),(20,3,6,'01:00:00','03:00:00'),(21,3,7,'01:00:00','03:00:00'),(22,4,1,'00:00:00','00:00:00'),(23,4,2,'00:00:00','00:00:00'),(24,4,3,'08:00:00','10:00:00'),(25,4,4,'00:00:00','00:00:00'),(26,4,5,'00:00:00','00:00:00'),(27,4,6,'00:00:00','00:00:00'),(28,4,7,'00:00:00','00:00:00'),(29,5,1,'01:00:00','04:00:00'),(30,5,2,'01:00:00','04:00:00'),(31,5,3,'01:00:00','04:00:00'),(32,5,4,'01:00:00','04:00:00'),(33,5,5,'01:00:00','03:00:00'),(34,5,6,'01:00:00','03:00:00'),(35,5,7,'04:00:00','04:00:00');
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
INSERT INTO `doctor` VALUES ('123456321','226102',15),('131313','226102',16),('46546446554','226102',18),('5001','226102',3),('65464','226102',17);
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20201123165112','2020-11-23 18:51:18',21);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,1,'5001','Vėluosiu','Vėluosiu 5 minutes.','2020-11-23 19:00:43'),(2,2,'5001','fdsfsd','gdagagad','2020-12-05 14:49:32'),(3,2,'5001','g','g','2020-12-05 16:39:44');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,2),(2,4),(3,5),(4,6),(5,7),(6,8),(7,9),(8,10),(9,11),(10,12),(11,13),(12,14);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (1,'5001',15),(2,'123456321',30),(3,'131313',30),(4,'65464',30),(5,'46546446554',60);
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
INSERT INTO `specialty` VALUES ('226102','Burnos chirurgas','Gydytojai odontologai'),('654654','gfsdg','gfsd');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin','Administrator','a@a.com','+37069781645','$2y$13$oD5Vupb.fj6nlBDV0dwpTeTY40qbSfrCVlv4ypAmH.k43Bl7qvXK6','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:10:\"ROLE_ADMIN\";}'),(2,'Jonas','Kazlauskas','jk@gmail.com','+37064897154','$2y$13$l/QiMfBidWJm.L3tRfZJQeIXFQZZX5a6mnXpOto4MQ58wzvWTyMnm','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(3,'Andrius','Petraitis','ap@gmail.com','+37064587945','$2y$13$f/tys/hj7uMNlWfHyfyuTOqb3O6CuOBd3cbIy7NSg7uQJhICcUaLe','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:11:\"ROLE_DOCTOR\";}'),(4,'Vilius','Grimalauskas','vgrimalauskas@yahoo.com','+37069457465','$2y$13$veUOVRWyzn62Uk8TaNYL..srGOHRfJ1.jg6eR9Mi0ftstuXoe43ee','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(5,'Petras','Kazlauskas','pk@gmail.com','+37069748645','$2y$13$pa/XQJXzmXf3HPyv4itk9u11G0ZHk7zhyqqz1PbvO79KmG49ed/dW','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(6,'Jonas','Petrauskas','jpetr@gmail.com','+37069784135','$2y$13$144fQA7JeqVwBgpci7rSzujbaxUcHMjExW7NDn8PYs4wAx3pKC1E2','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(7,'Mantas','Jankauskas','mja@gmail.com','+37068513485','$2y$13$3RcmAWyqEtLlJJsRVDCKP.tIhptLIy5R9yRgYw7wSJB49O/WAG0AC','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(8,'hgshs','hgssh','hgs@gfa.gfa','+37069487541','$2y$13$39esqtjVp5TEzNyXJR75neP6dn7dzjStewVYYapuw5XVt4Mo5BvAq','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(9,'gfa','gfa','gfa@ha.hd','+37069487512','$2y$13$p5aNOlCRfdIkUb/FNRHG1OT0xak6dfbkOWiNrhlYu26xhARkBIFp.','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(10,'fdafa','dfaasf','fdsfs@fd.com','+37064','$2y$13$dca8zq4jplU04r2295J6Bu8AGk4t5A6iJG2EA.RUK5/mDYEXPFDra','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(11,'shehw','hfaha','hraha@fds.com','+370648','$2y$13$MVQGqfFiJiobUpk79PC3ke9Zw9xkGeBXxsuJ.CvimlsRKBdvS.ma2','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(12,'gfaga','rhaha','hraha@dgda.com','+37069784568','$2y$13$w6BwgI54NJLPjC9kmlU9q.rK/BPKKa9QT7TcRBWXDhyYsVXhUO.Wq','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(13,'fdasfdas','fdasfas','fahraha@g.com','+370456789452','$2y$13$cQSWh8XvHLdaBHiNaC68keA1TdojkUXRaV3m9HXmuiObgc/LlIII6','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(14,'gfagafga','gfagada','gfag@fdad.com','+37049785365','$2y$13$RJ9TDPaHxHMX8Gacf3iMBulUfzmE5rVI8FWS1f1N.TMCHWKW1yXOG','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:12:\"ROLE_PATIENT\";}'),(15,'Alfredas','Jonauskas','aj@gmail.com','+37069485321','$2y$13$D1iRMezTAsplzMVEZZw5rO0h8M9MH/izQrN5EprSRR8cH5g2NrC6G','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:11:\"ROLE_DOCTOR\";}'),(16,'gfsgfsd','gfdsg','gfsd@gda.com','+37064895315','$2y$13$vLI83uGQO4O.XnNaq4qtq.5lWLhrPALRihkNsvJHLAo6bSGOqa7OO','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:11:\"ROLE_DOCTOR\";}'),(17,'yeheth','jejtejet','hrweh@gs.vom','+370698754658','$2y$13$RS6F0W7pTIkOB8QO35ul2.SmGNQW2DvWr5xghH7tQvbnIkm.b4fuG','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:11:\"ROLE_DOCTOR\";}'),(18,'qqqqqqqqqqqq','rerwrewr','fsfsd@fd.com','+37069846572','$2y$13$KVvZV.or0dN.Ot/9VZKGHODLgxxljKpgHwjkqYZdgwGVueJaODsQ.','a:2:{i:0;s:9:\"ROLE_USER\";i:1;s:11:\"ROLE_DOCTOR\";}');
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

-- Dump completed on 2020-12-06 17:19:26
