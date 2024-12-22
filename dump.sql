-- MySQL dump 10.13  Distrib 8.0.39, for Win64 (x86_64)
--
-- Host: localhost    Database: lyza_system
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branchName` varchar(100) NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (1,'All Branch','2024-12-15 03:09:49'),(2,'San Miguel','2024-12-15 03:09:49'),(3,'San Isidro Norte','2024-12-15 03:09:49');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `physicalcount`
--

DROP TABLE IF EXISTS `physicalcount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `physicalcount` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) DEFAULT NULL,
  `genericName` varchar(100) DEFAULT NULL,
  `expiryDate` date NOT NULL,
  `productStock` int DEFAULT '0',
  `branchId` int NOT NULL,
  `staffId` int NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `physicalcount`
--

LOCK TABLES `physicalcount` WRITE;
/*!40000 ALTER TABLE `physicalcount` DISABLE KEYS */;
/*!40000 ALTER TABLE `physicalcount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productordered`
--

DROP TABLE IF EXISTS `productordered`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productordered` (
  `id` int NOT NULL AUTO_INCREMENT,
  `productId` int NOT NULL,
  `numberProduct` int NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `productId` (`productId`),
  CONSTRAINT `productordered_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productordered`
--

LOCK TABLES `productordered` WRITE;
/*!40000 ALTER TABLE `productordered` DISABLE KEYS */;
INSERT INTO `productordered` VALUES (1,32,10,'2024-12-15 03:10:17'),(2,32,15,'2024-12-15 03:10:17'),(3,46,5,'2024-12-15 03:10:17'),(4,34,10,'2024-12-15 03:10:17'),(5,45,2,'2024-12-15 03:10:17'),(6,32,20,'2024-12-15 03:10:17'),(7,32,20,'2024-12-15 03:10:17'),(8,45,2,'2024-12-15 03:10:17'),(9,42,3,'2024-12-15 03:10:17'),(10,40,1,'2024-12-15 03:10:17'),(11,32,10,'2024-12-15 03:10:17'),(12,34,10,'2024-12-15 03:10:17'),(13,46,5,'2024-12-15 03:10:17'),(14,41,5,'2024-12-15 03:10:17'),(15,39,10,'2024-12-15 03:10:17'),(16,32,30,'2024-12-15 03:10:17'),(17,40,1,'2024-12-15 03:10:17'),(18,45,1,'2024-12-15 03:10:17'),(19,32,10,'2024-12-15 03:10:17'),(20,41,5,'2024-12-15 03:10:17'),(21,45,2,'2024-12-15 03:10:17'),(22,46,5,'2024-12-15 03:10:17'),(23,34,10,'2024-12-15 03:10:17'),(24,32,5,'2024-12-15 03:10:17'),(25,42,3,'2024-12-15 03:10:17'),(26,32,5,'2024-12-15 03:10:17'),(27,45,1,'2024-12-15 03:10:17'),(28,34,10,'2024-12-15 03:10:17'),(29,40,1,'2024-12-15 03:10:17'),(30,32,10,'2024-12-15 03:10:17'),(31,46,5,'2024-12-15 03:10:17'),(32,41,5,'2024-12-15 03:10:17'),(33,45,2,'2024-12-15 03:10:17'),(34,32,10,'2024-12-15 03:10:17'),(35,40,1,'2024-12-15 03:10:17'),(36,39,10,'2024-12-15 03:10:17'),(37,45,2,'2024-12-15 03:10:17'),(38,32,10,'2024-12-15 03:10:17'),(39,34,10,'2024-12-15 03:10:17'),(40,41,5,'2024-12-15 03:10:17'),(41,46,10,'2024-12-15 03:10:17'),(42,39,20,'2024-12-15 03:10:17'),(43,45,1,'2024-12-15 03:10:17'),(44,32,10,'2024-12-15 03:10:17'),(45,40,1,'2024-12-15 03:10:17'),(46,34,20,'2024-12-15 03:10:17'),(47,41,5,'2024-12-15 03:10:17'),(48,40,1,'2024-12-15 03:10:17'),(49,39,10,'2024-12-15 03:10:17'),(50,32,5,'2024-12-15 03:10:17'),(51,34,5,'2024-12-15 03:10:17'),(52,45,2,'2024-12-15 03:10:17'),(53,32,5,'2024-12-15 03:10:17'),(54,45,2,'2024-12-15 03:10:17'),(55,34,10,'2024-12-15 03:10:17'),(56,40,1,'2024-12-15 03:10:17'),(57,46,10,'2024-12-15 03:10:17'),(58,32,5,'2024-12-15 03:10:17'),(59,41,5,'2024-12-15 03:10:17'),(60,45,2,'2024-12-15 03:10:17'),(61,32,10,'2024-12-15 03:10:17'),(62,39,10,'2024-12-15 03:10:17'),(63,45,2,'2024-12-15 03:10:17'),(64,34,10,'2024-12-15 03:10:17'),(65,41,5,'2024-12-15 03:10:17'),(66,46,10,'2024-12-15 03:10:17'),(67,39,20,'2024-12-15 03:10:17'),(68,32,5,'2024-12-15 03:10:17'),(69,32,10,'2024-12-15 03:10:17'),(70,40,1,'2024-12-15 03:10:17'),(71,34,20,'2024-12-15 03:10:17'),(72,39,10,'2024-12-15 03:10:17'),(73,45,1,'2024-12-15 03:10:17'),(74,32,5,'2024-12-15 03:10:17'),(75,34,5,'2024-12-15 03:10:17');
/*!40000 ALTER TABLE `productordered` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branchId` int NOT NULL,
  `barCode` varchar(100) DEFAULT '',
  `productName` varchar(100) NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `productStock` int DEFAULT '0',
  `productCategory` varchar(100) NOT NULL,
  `genericBrand` varchar(100) NOT NULL,
  `productUnit` varchar(100) NOT NULL,
  `productImage` varchar(100) DEFAULT '',
  `productDescription` varchar(100) DEFAULT '',
  `isArchived` tinyint(1) DEFAULT '0',
  `physicalCount` int DEFAULT NULL,
  `investigation` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `branchId` (`branchId`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`branchId`) REFERENCES `branch` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,2,'12345','Alaxan',30.00,0,'Medicine','Paracetamol','Tablet','Alaxan.jpeg','',0,NULL,NULL,'2024-12-15 03:09:49'),(2,3,'23456','Biogesic',50.00,0,'Supplement','Paracetamol','Tablet','Biogesic.png','',0,NULL,NULL,'2024-12-15 03:09:49'),(3,3,'','Bioflu',6.00,20,'Medicine','Phenylephrine Hydrochloride + Chlorphenamine Maleate + Paracetamol','Tablet','bioflu500mg.png','',0,NULL,NULL,'2024-12-15 03:10:08'),(4,2,'','Tempra + Forte',120.00,10,'Medicine','Paracetamol','Box','tempraforte500mg.png','',0,NULL,NULL,'2024-12-15 03:10:08'),(5,3,'','Lomotil 2mg',13.00,10,'Medicine','Loperamide HCI','Tablet','lomotil2mg.png','',0,NULL,NULL,'2024-12-15 03:10:08'),(6,2,'','Rubitussin DM 120ml',245.00,5,'Medicine','Dextromethorphan Hydrobromide + Guaifensin','Box','robitussindm120ml.png','',0,NULL,NULL,'2024-12-15 03:10:08'),(7,3,'','Mucosolvan 30mg',21.00,10,'Medicine','Ambroxol HCI','Tablet','mucosolvan30mg.png','',0,NULL,NULL,'2024-12-15 03:10:08'),(8,2,'','Advil 200mg',10.00,10,'Medicine','Ibuprofen','Tablet','advil200mg.png','',0,NULL,NULL,'2024-12-15 03:10:08'),(9,3,'','RiteMED',7.00,5,'Medicine','Losartan Potassium + Amlodipine Besilate','Tablet','ritemedlosartan100mg.png','',0,NULL,NULL,'2024-12-15 03:10:08'),(10,2,'','Comxicla 625mg',625.00,5,'Medicine','Co-Amoxiclav','Bottle','comxicla.png','',0,NULL,NULL,'2024-12-15 03:10:08'),(11,3,'','Biogesic',6.00,10,'Medicine','Paracetamol','Tablet','biogesic500mg.png','',0,NULL,NULL,'2024-12-15 03:10:08'),(12,2,'','Symdex D Forte',7.50,10,'Medicine','Phenylephrine HCI Chlorphenamine Maleate Paracetamol','Tablet','symdexdforte.png','',0,NULL,NULL,'2024-12-15 03:10:08'),(13,3,'','Imodium',20.00,5,'Medicine','Loperamide','Tablet','imodium.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(14,2,'','Celixib',8.00,2,'Medicine','Celecoxib','Tablet','celixib.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(15,3,'','Cherifer 240ml',395.00,5,'Supplement','Cherifer','Box','cherifersyrup.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(16,2,'','Propan TLC',435.00,5,'Supplement','Propan','Box','propantlc.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(17,3,'','Nutrilin 120ml',35.00,5,'Supplement','Nutrilin','Box','nutrilin120ml.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(18,2,'','Ceelin Plus',385.00,5,'Supplement','Ascorbic Acid Zinc','Box','ceelinplus60ml.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(19,3,'','Growee 120ml',230.00,10,'Supplement','Growee','Box','growee120ml.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(20,3,'','Bioflu',6.00,100,'Medicine','Phenylephrine Hydrochloride + Chlorphenamine Maleate + Paracetamol','Tablet','bioflu500mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(21,3,'','Tempra + Forte',120.00,50,'Medicine','Paracetamol','Box','tempraforte500mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(22,2,'','Lomotil 2mg',13.00,100,'Medicine','Loperamide HCI','Tablet','lomotil2mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(23,2,'','Rubitussin DM 120ml',245.00,30,'Medicine','Dextromethorphan Hydrobromide + Guaifensin','Box','robitussindm120ml.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(24,3,'','Mucosolvan 30mg',21.00,50,'Medicine','Ambroxol HCI','Tablet','mucosolvan30mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(25,3,'','Advil 200mg',10.00,100,'Medicine','Ibuprofen','Tablet','advil200mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(26,3,'','Biogesic',6.00,200,'Medicine','Paracetamol','Tablet','biogesic500mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(27,2,'','Celixib',8.00,50,'Medicine','Celecoxib','Tablet','celixib.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(28,3,'','Imodium',20.00,50,'Medicine','Loperamide','Tablet','imodium.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(29,2,'','RiteMED',7.00,50,'Medicine','Losartan Potassium + Amlodipine Besilate','Tablet','ritemedlosartan100mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(30,3,'','Rubitussin DM 120ml',245.00,50,'Medicine','Dextromethorphan Hydrobromide + Guaifensin','Box','robitussindm120ml.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(31,3,'','Mucosolvan 30mg',21.00,50,'Medicine','Ambroxol HCI','Tablet','mucosolvan30mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(32,2,'','Tempra + Forte',120.00,50,'Medicine','Paracetamol','Box','tempraforte500mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(33,2,'','Advil 200mg',10.00,100,'Medicine','Ibuprofen','Tablet','advil200mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(34,3,'','Bioflu',6.00,200,'Medicine','Phenylephrine Hydrochloride + Chlorphenamine Maleate + Paracetamol','Tablet','bioflu500mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(35,3,'','Tempra + Forte',120.00,100,'Medicine','Paracetamol','Box','tempraforte500mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(36,2,'','Lomotil 2mg',13.00,200,'Medicine','Loperamide HCI','Tablet','lomotil2mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(37,2,'','Rubitussin DM 120ml',245.00,60,'Medicine','Dextromethorphan Hydrobromide + Guaifensin','Box','robitussindm120ml.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(38,3,'','Mucosolvan 30mg',21.00,100,'Medicine','Ambroxol HCI','Tablet','mucosolvan30mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(39,3,'','Advil 200mg',10.00,200,'Medicine','Ibuprofen','Tablet','advil200mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(40,2,'','Symdex D Forte',7.50,200,'Medicine','Phenylephrine HCI Chlorphenamine Maleate Paracetamol','Tablet','symdexdforte.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(41,3,'','Biogesic',6.00,400,'Medicine','Paracetamol','Tablet','biogesic500mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(42,2,'','Celixib',8.00,100,'Medicine','Celecoxib','Tablet','celixib.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(43,3,'','Imodium',20.00,100,'Medicine','Loperamide','Tablet','imodium.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(44,2,'','RiteMED',7.00,100,'Medicine','Losartan Potassium + Amlodipine Besilate','Tablet','ritemedlosartan100mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(45,3,'','Rubitussin DM 120ml',245.00,100,'Medicine','Dextromethorphan Hydrobromide + Guaifensin','Box','robitussindm120ml.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(46,3,'','Mucosolvan 30mg',21.00,100,'Medicine','Ambroxol HCI','Tablet','mucosolvan30mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(47,2,'','Tempra + Forte',120.00,100,'Medicine','Paracetamol','Box','tempraforte500mg.png','',0,NULL,NULL,'2024-12-15 03:10:09'),(48,2,'','Advil 200mg',10.00,200,'Medicine','Ibuprofen','Tablet','advil200mg.png','',0,NULL,NULL,'2024-12-15 03:10:09');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,2,'2024-12-15 03:09:49'),(2,3,'2024-12-15 03:09:49'),(3,4,'2024-12-15 03:09:49'),(4,5,'2024-12-15 03:09:49');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockhistory`
--

DROP TABLE IF EXISTS `stockhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stockhistory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branchId` int NOT NULL,
  `staffId` int NOT NULL,
  `productId` int NOT NULL,
  `quantity` int NOT NULL,
  `remainingStock` int NOT NULL,
  `expirationDate` date DEFAULT NULL,
  `discarded` tinyint(1) DEFAULT '0',
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `staffId` (`staffId`),
  KEY `branchId` (`branchId`),
  KEY `productId` (`productId`),
  CONSTRAINT `stockhistory_ibfk_1` FOREIGN KEY (`staffId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stockhistory_ibfk_2` FOREIGN KEY (`branchId`) REFERENCES `branch` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stockhistory_ibfk_3` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockhistory`
--

LOCK TABLES `stockhistory` WRITE;
/*!40000 ALTER TABLE `stockhistory` DISABLE KEYS */;
INSERT INTO `stockhistory` VALUES (1,3,3,3,20,20,'2026-12-30',0,'2024-12-15 03:10:08'),(2,2,2,4,10,10,'2027-01-10',0,'2024-12-15 03:10:08'),(3,3,3,5,10,10,'2027-02-20',0,'2024-12-15 03:10:08'),(4,2,2,6,5,5,'2027-03-15',0,'2024-12-15 03:10:08'),(5,3,3,7,10,10,'2027-04-25',0,'2024-12-15 03:10:08'),(6,2,2,8,10,10,'2027-05-10',0,'2024-12-15 03:10:08'),(7,3,3,9,5,5,'2027-06-15',0,'2024-12-15 03:10:08'),(8,2,2,10,5,5,'2027-07-20',0,'2024-12-15 03:10:08'),(9,3,3,11,10,10,'2027-08-25',0,'2024-12-15 03:10:08'),(10,2,2,12,10,10,'2027-09-30',0,'2024-12-15 03:10:08'),(11,3,3,13,5,5,'2027-10-15',0,'2024-12-15 03:10:09'),(12,2,2,14,2,2,'2027-11-20',0,'2024-12-15 03:10:09'),(13,3,3,15,5,5,'2027-12-25',0,'2024-12-15 03:10:09'),(14,2,2,16,5,5,'2028-01-10',0,'2024-12-15 03:10:09'),(15,3,3,17,5,5,'2028-02-15',0,'2024-12-15 03:10:09'),(16,2,2,18,5,5,'2028-03-20',0,'2024-12-15 03:10:09'),(17,3,3,19,10,10,'2028-04-25',0,'2024-12-15 03:10:09'),(18,3,3,20,100,100,'2025-12-15',0,'2024-12-15 03:10:09'),(19,3,3,21,50,50,'2026-03-10',0,'2024-12-15 03:10:09'),(20,2,2,22,100,100,'2025-04-15',0,'2024-12-15 03:10:09'),(21,2,2,23,30,30,'2024-11-02',0,'2024-12-15 03:10:09'),(22,3,3,24,50,50,'2026-02-16',0,'2024-12-15 03:10:09'),(23,3,3,25,100,100,'2024-10-09',0,'2024-12-15 03:10:09'),(24,3,3,26,200,200,'2025-03-06',0,'2024-12-15 03:10:09'),(25,2,2,27,50,50,'2025-12-30',0,'2024-12-15 03:10:09'),(26,3,3,28,50,50,'2025-08-29',0,'2024-12-15 03:10:09'),(27,2,2,29,50,50,'2026-02-22',0,'2024-12-15 03:10:09'),(28,3,3,30,50,50,'2024-11-02',0,'2024-12-15 03:10:09'),(29,3,3,31,50,50,'2026-02-16',0,'2024-12-15 03:10:09'),(30,2,2,32,50,50,'2026-03-10',0,'2024-12-15 03:10:09'),(31,2,2,33,100,100,'2024-10-09',0,'2024-12-15 03:10:09'),(32,3,3,34,200,200,'2025-12-15',0,'2024-12-15 03:10:09'),(33,3,3,35,100,100,'2026-03-10',0,'2024-12-15 03:10:09'),(34,2,2,36,200,200,'2025-04-15',0,'2024-12-15 03:10:09'),(35,2,2,37,60,60,'2024-11-02',0,'2024-12-15 03:10:09'),(36,3,3,38,100,100,'2026-02-16',0,'2024-12-15 03:10:09'),(37,3,3,39,200,200,'2024-10-09',0,'2024-12-15 03:10:09'),(38,2,2,40,200,200,'2024-12-22',0,'2024-12-15 03:10:09'),(39,3,3,41,400,400,'2025-03-06',0,'2024-12-15 03:10:09'),(40,2,2,42,100,100,'2025-12-30',0,'2024-12-15 03:10:09'),(41,3,3,43,100,100,'2025-08-29',0,'2024-12-15 03:10:09'),(42,2,2,44,100,100,'2026-02-22',0,'2024-12-15 03:10:09'),(43,3,3,45,100,100,'2024-11-02',0,'2024-12-15 03:10:09'),(44,3,3,46,100,100,'2026-02-16',0,'2024-12-15 03:10:09'),(45,2,2,47,100,100,'2026-03-10',0,'2024-12-15 03:10:09'),(46,2,2,48,200,200,'2024-10-09',0,'2024-12-15 03:10:09');
/*!40000 ALTER TABLE `stockhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `productOrderedIds` json NOT NULL,
  `branchId` int NOT NULL,
  `staffId` int NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `cashPrice` decimal(10,2) NOT NULL,
  `changePrice` decimal(10,2) NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `discountID` varchar(50) DEFAULT '',
  `seniorDiscount` tinyint(1) DEFAULT '0',
  `pwdDiscount` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `branchId` (`branchId`),
  KEY `staffId` (`staffId`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`branchId`) REFERENCES `branch` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`staffId`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,'{\"id\": [32]}',3,3,48.00,100.00,52.00,'2024-12-15 03:10:17','',0,0),(2,'{\"id\": [32, 46]}',3,3,210.00,300.00,90.00,'2024-12-15 03:10:17','',0,0),(3,'{\"id\": [34, 45]}',2,2,260.00,300.00,40.00,'2024-12-15 03:10:17','',0,0),(4,'{\"id\": []}',2,2,245.00,300.00,55.00,'2024-12-15 03:10:17','',0,0),(5,'{\"id\": [32]}',3,3,300.00,400.00,100.00,'2024-12-15 03:10:17','',0,0),(6,'{\"id\": [32]}',3,3,228.00,300.00,72.00,'2024-12-15 03:10:17','',0,0),(7,'{\"id\": [45, 42, 40]}',2,2,1466.00,2000.00,534.80,'2024-12-15 03:10:17','',0,0),(8,'{\"id\": [32, 34]}',3,3,160.00,300.00,140.00,'2024-12-15 03:10:17','',0,0),(9,'{\"id\": [46, 41]}',2,2,150.00,200.00,50.00,'2024-12-15 03:10:17','',0,0),(10,'{\"id\": [39]}',2,2,305.00,400.00,95.00,'2024-12-15 03:10:17','',0,0),(11,'{\"id\": [32, 40]}',3,3,305.00,400.00,95.00,'2024-12-15 03:10:17','',0,0),(12,'{\"id\": [45]}',3,3,295.00,400.00,105.00,'2024-12-15 03:10:17','',0,0),(13,'{\"id\": [32, 41]}',3,3,312.00,400.00,88.00,'2024-12-15 03:10:17','',0,0),(14,'{\"id\": [45, 46, 34]}',2,2,452.00,600.00,148.00,'2024-12-15 03:10:17','',0,0),(15,'{\"id\": [32, 42]}',3,3,144.00,200.00,56.00,'2024-12-15 03:10:17','',0,0),(16,'{\"id\": [32, 45]}',3,3,90.00,200.00,110.00,'2024-12-15 03:10:17','',0,0),(17,'{\"id\": [34]}',3,3,315.00,400.00,85.00,'2024-12-15 03:10:17','',0,0),(18,'{\"id\": [40]}',2,2,505.00,600.00,95.00,'2024-12-15 03:10:17','',0,0),(19,'{\"id\": [32, 46]}',2,2,110.00,200.00,90.00,'2024-12-15 03:10:17','',0,0),(20,'{\"id\": [41, 45]}',3,3,230.00,300.00,70.00,'2024-12-15 03:10:17','',0,0),(21,'{\"id\": [32, 40]}',2,2,365.00,500.00,135.00,'2024-12-15 03:10:17','',0,0),(22,'{\"id\": [39]}',3,3,150.00,200.00,50.00,'2024-12-15 03:10:17','',0,0),(23,'{\"id\": [45, 32]}',2,2,160.00,200.00,40.00,'2024-12-15 03:10:17','',0,0),(24,'{\"id\": [34]}',3,3,195.00,300.00,105.00,'2024-12-15 03:10:17','',0,0),(25,'{\"id\": [41, 46]}',2,2,250.00,300.00,50.00,'2024-12-15 03:10:17','',0,0),(26,'{\"id\": [39, 45]}',3,3,135.00,200.00,65.00,'2024-12-15 03:10:17','',0,0),(27,'{\"id\": [32, 40]}',2,2,207.00,300.00,93.00,'2024-12-15 03:10:17','',0,0),(28,'{\"id\": [34, 41, 40]}',3,3,380.00,400.00,20.00,'2024-12-15 03:10:17','',0,0),(29,'{\"id\": [39]}',2,2,305.00,400.00,95.00,'2024-12-15 03:10:17','',0,0),(30,'{\"id\": [32, 34, 45]}',3,3,185.00,300.00,115.00,'2024-12-15 03:10:17','',0,0),(31,'{\"id\": [32, 45]}',3,3,110.00,200.00,90.00,'2024-12-15 03:10:17','',0,0),(32,'{\"id\": [34]}',3,3,315.00,400.00,85.00,'2024-12-15 03:10:17','',0,0),(33,'{\"id\": [40]}',2,2,530.00,600.00,70.00,'2024-12-15 03:10:17','',0,0),(34,'{\"id\": [46, 32]}',2,2,110.00,200.00,90.00,'2024-12-15 03:10:17','',0,0),(35,'{\"id\": [41, 45]}',3,3,230.00,300.00,70.00,'2024-12-15 03:10:17','',0,0),(36,'{\"id\": [32]}',2,2,305.00,400.00,95.00,'2024-12-15 03:10:17','',0,0),(37,'{\"id\": [39]}',3,3,150.00,200.00,50.00,'2024-12-15 03:10:17','',0,0),(38,'{\"id\": [45]}',2,2,160.00,200.00,40.00,'2024-12-15 03:10:17','',0,0),(39,'{\"id\": [34]}',3,3,195.00,300.00,105.00,'2024-12-15 03:10:17','',0,0),(40,'{\"id\": [41, 46]}',2,2,250.00,300.00,50.00,'2024-12-15 03:10:17','',0,0),(41,'{\"id\": [39, 32]}',3,3,135.00,200.00,65.00,'2024-12-15 03:10:17','',0,0),(42,'{\"id\": [32, 40]}',2,2,207.00,300.00,93.00,'2024-12-15 03:10:17','',0,0),(43,'{\"id\": [34]}',3,3,380.00,400.00,20.00,'2024-12-15 03:10:17','',0,0),(44,'{\"id\": [39, 45]}',2,2,305.00,400.00,95.00,'2024-12-15 03:10:17','',0,0),(45,'{\"id\": [32, 34]}',3,3,185.00,300.00,115.00,'2024-12-15 03:10:17','',0,0);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploadedtransactions`
--

DROP TABLE IF EXISTS `uploadedtransactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uploadedtransactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fileId` varchar(255) NOT NULL,
  `uploadedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fileId` (`fileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploadedtransactions`
--

LOCK TABLES `uploadedtransactions` WRITE;
/*!40000 ALTER TABLE `uploadedtransactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `uploadedtransactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT '0',
  `assignedBranch` int DEFAULT NULL,
  `userStatus` enum('active','disabled','removed') DEFAULT 'active',
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userName` (`userName`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ADMIN','admin','admin','admin@example.com','$2y$10$HwfYgfXoL.c0D1bFyLQw5epckFCoLnxzp7d.Z0enLKYImQJwv91yy',1,1,'active','2024-12-15 03:09:49'),(2,'staff1','staff1','staff','staff1@example.com','$2y$10$HwfYgfXoL.c0D1bFyLQw5epckFCoLnxzp7d.Z0enLKYImQJwv91yy',0,2,'active','2024-12-15 03:09:49'),(3,'staff2','staff2','staff','staff2@example.com','$2y$10$HwfYgfXoL.c0D1bFyLQw5epckFCoLnxzp7d.Z0enLKYImQJwv91yy',0,3,'disabled','2024-12-15 03:09:49'),(4,'staff3','staff3','staff','staff3@example.com','$2y$10$HwfYgfXoL.c0D1bFyLQw5epckFCoLnxzp7d.Z0enLKYImQJwv91yy',0,2,'removed','2024-12-15 03:09:49'),(5,'NJ Admin','NJ','ADMIN','nj.zxc14@gmail.com','$2y$10$f.Zds9tg/eJbQYllN4JF7OOs1d1AbqM56JjWvfl1RCdWSWaPnSUtG',1,1,'active','2024-12-15 03:09:49'),(6,'Tejada Staff','JOSH','STAFF','joshtejada2017@gmail.com','$2y$10$3SRVFjEJ/mu2kCYTwiRPI./We488IGZYLWKb8D3v7HKR9IuW2cg9W',0,2,'active','2024-12-15 03:09:49');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-15 11:12:26
