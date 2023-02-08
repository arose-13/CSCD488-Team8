-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: budgetappuser
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appusertable`
--

DROP TABLE IF EXISTS `appusertable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appusertable` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `userCreationDate` date NOT NULL,
  `accountActivated` tinyint NOT NULL DEFAULT '1',
  `userRole` enum('USER','ADMIN') NOT NULL DEFAULT 'USER',
  `m01` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m02` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m03` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m04` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m05` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m06` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m07` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m08` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m09` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m10` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m11` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  `m12` json DEFAULT (_utf8mb4'{"actual":0.0,"expected":0.0}'),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appusertable`
--

LOCK TABLES `appusertable` WRITE;
/*!40000 ALTER TABLE `appusertable` DISABLE KEYS */;
INSERT INTO `appusertable` VALUES (4,'testUser1','notHashedPW1','anotherEmail1@email.com','0000-00-00',1,'USER','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}'),(5,'testUser2','notHashedPW2','testEmail2@email.com','0000-00-00',1,'USER','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}'),(6,'testUser3','notHashedPW3','yetAnotherEmail3@email.com','0000-00-00',1,'USER','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}'),(7,'testUser4','notHashedPW4','AnotherEmail4@email.com','0000-00-00',1,'USER','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}','{\"actual\": 0.0, \"expected\": 0.0}');
/*!40000 ALTER TABLE `appusertable` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-31 16:32:25
