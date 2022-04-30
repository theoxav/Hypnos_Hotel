-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: kgb_studi
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_880E0D76E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (2,'johndoe@admin.com','Doe','John','[\"ROLE_ADMIN\"]','$2y$13$j3vEhEzAthLvbLVZqbNFy.w4.ll2klWyVdUQygdLKgVHJVSe5Y/Ca','2022-02-20 09:05:02','2022-02-20 09:05:02');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agent`
--

DROP TABLE IF EXISTS `agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `nationality` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent`
--

LOCK TABLES `agent` WRITE;
/*!40000 ALTER TABLE `agent` DISABLE KEYS */;
INSERT INTO `agent` VALUES (1,'007','James','Bond','2022-02-20','England',NULL,'2022-02-20 09:03:33','2022-02-22 15:26:39'),(2,'Captain America','Steve','Rogers','2022-01-20','United-States','captain-america.jpg','2022-02-20 09:03:33','2022-02-22 15:27:00'),(3,'SanGoku','Kakarot','Goku','2022-02-20','Japan','sangoku.png','2022-02-20 09:03:33','2022-02-22 15:26:22'),(4,'Wolverine','Hugh','Jackman','2022-02-20','France',NULL,'2022-02-20 09:03:33','2022-02-20 09:03:33');
/*!40000 ALTER TABLE `agent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agent_skill`
--

DROP TABLE IF EXISTS `agent_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agent_skill` (
  `agent_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  PRIMARY KEY (`agent_id`,`skill_id`),
  KEY `IDX_6793CC0F3414710B` (`agent_id`),
  KEY `IDX_6793CC0F5585C142` (`skill_id`),
  CONSTRAINT `FK_6793CC0F3414710B` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6793CC0F5585C142` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agent_skill`
--

LOCK TABLES `agent_skill` WRITE;
/*!40000 ALTER TABLE `agent_skill` DISABLE KEYS */;
INSERT INTO `agent_skill` VALUES (1,2),(1,5),(2,1),(2,4),(3,1),(3,4),(4,1);
/*!40000 ALTER TABLE `agent_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `nationality` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'The Mole','Jean','Mark','2022-02-20','France',NULL,'2022-02-20 09:03:33','2022-02-20 09:03:33'),(2,'L\'Americain','Kyle','Uper','2022-02-20','United-States',NULL,'2022-02-20 09:03:33','2022-02-20 09:03:33'),(3,'l\'Anglais','Will','Nothing','2022-02-20','England',NULL,'2022-02-20 09:03:33','2022-02-20 09:03:33'),(4,'Le Français','Mike','Paris','2022-02-20','France',NULL,'2022-02-20 09:03:33','2022-02-20 09:03:33');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (1,'France','2022-02-20 09:03:33','2022-02-20 09:03:33'),(2,'England','2022-02-20 09:03:33','2022-02-20 09:03:33'),(3,'United-States','2022-02-20 09:03:33','2022-02-20 09:03:33');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20220219130804','2022-02-19 13:08:11',444);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hideout`
--

DROP TABLE IF EXISTS `hideout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hideout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `IDX_2C2FE159F92F3E70` (`country_id`),
  KEY `IDX_2C2FE159C54C8C93` (`type_id`),
  CONSTRAINT `FK_2C2FE159C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `hideout_type` (`id`),
  CONSTRAINT `FK_2C2FE159F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hideout`
--

LOCK TABLES `hideout` WRITE;
/*!40000 ALTER TABLE `hideout` DISABLE KEYS */;
INSERT INTO `hideout` VALUES (1,1,1,'Red','16 rue des Coudriers Paris','2022-02-20 09:03:33','2022-02-20 09:03:33'),(2,2,2,'Dark','Jenaer Strasse 82 Mulheim','2022-02-20 09:03:33','2022-02-20 09:03:33'),(3,3,3,'Blue','3660 Patterson Street Houston','2022-02-20 09:03:33','2022-02-20 09:03:33');
/*!40000 ALTER TABLE `hideout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hideout_type`
--

DROP TABLE IF EXISTS `hideout_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hideout_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hideout_type`
--

LOCK TABLES `hideout_type` WRITE;
/*!40000 ALTER TABLE `hideout_type` DISABLE KEYS */;
INSERT INTO `hideout_type` VALUES (1,'Building','2022-02-20 09:03:33','2022-02-20 09:03:33'),(2,'House','2022-02-20 09:03:33','2022-02-20 09:03:33'),(3,'Villa','2022-02-20 09:03:33','2022-02-20 09:03:33');
/*!40000 ALTER TABLE `hideout_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission`
--

DROP TABLE IF EXISTS `mission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `skills_id` int(11) NOT NULL,
  `hideout_id` int(11) NOT NULL,
  `mission_gender_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9067F23CF92F3E70` (`country_id`),
  KEY `IDX_9067F23C7FF61858` (`skills_id`),
  KEY `IDX_9067F23CE9982FD7` (`hideout_id`),
  KEY `IDX_9067F23CB5BD57C9` (`mission_gender_id`),
  CONSTRAINT `FK_9067F23C7FF61858` FOREIGN KEY (`skills_id`) REFERENCES `skill` (`id`),
  CONSTRAINT `FK_9067F23CB5BD57C9` FOREIGN KEY (`mission_gender_id`) REFERENCES `mission_gender` (`id`),
  CONSTRAINT `FK_9067F23CE9982FD7` FOREIGN KEY (`hideout_id`) REFERENCES `hideout` (`id`),
  CONSTRAINT `FK_9067F23CF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission`
--

LOCK TABLES `mission` WRITE;
/*!40000 ALTER TABLE `mission` DISABLE KEYS */;
INSERT INTO `mission` VALUES (1,1,1,1,2,'Teacher of Darkness','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus lacinia eget nisl et aliquam. Pellentesque est tellus, vehicula sed posuere eu, ornare vel turpis. Sed vel ex venenatis, elementum nunc id, porta nunc. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus porttitor tincidunt venenatis. Praesent id tellus tellus. Nam tincidunt nunc sed justo tristique dictum. Cras a enim tellus. Etiam hendrerit nisi magna, quis iaculis sem consequat sit amet. Quisque faucibus dignissim ullamcorper. Ut venenatis elit ut aliquet porta. Vestibulum in augue sed libero vehicula porta. Donec venenatis odio a commodo hendrerit.','Blue','2022-02-22','2022-03-22','preparation');
/*!40000 ALTER TABLE `mission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission_agent`
--

DROP TABLE IF EXISTS `mission_agent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_agent` (
  `mission_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  PRIMARY KEY (`mission_id`,`agent_id`),
  KEY `IDX_B61DC3A0BE6CAE90` (`mission_id`),
  KEY `IDX_B61DC3A03414710B` (`agent_id`),
  CONSTRAINT `FK_B61DC3A03414710B` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B61DC3A0BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission_agent`
--

LOCK TABLES `mission_agent` WRITE;
/*!40000 ALTER TABLE `mission_agent` DISABLE KEYS */;
INSERT INTO `mission_agent` VALUES (1,1);
/*!40000 ALTER TABLE `mission_agent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission_contact`
--

DROP TABLE IF EXISTS `mission_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_contact` (
  `mission_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`mission_id`,`contact_id`),
  KEY `IDX_DD5E7275BE6CAE90` (`mission_id`),
  KEY `IDX_DD5E7275E7A1254A` (`contact_id`),
  CONSTRAINT `FK_DD5E7275BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_DD5E7275E7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission_contact`
--

LOCK TABLES `mission_contact` WRITE;
/*!40000 ALTER TABLE `mission_contact` DISABLE KEYS */;
INSERT INTO `mission_contact` VALUES (1,1);
/*!40000 ALTER TABLE `mission_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission_gender`
--

DROP TABLE IF EXISTS `mission_gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission_gender`
--

LOCK TABLES `mission_gender` WRITE;
/*!40000 ALTER TABLE `mission_gender` DISABLE KEYS */;
INSERT INTO `mission_gender` VALUES (1,'Infiltration'),(2,'Assassination'),(3,'Monitoring'),(4,'Protection');
/*!40000 ALTER TABLE `mission_gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission_target`
--

DROP TABLE IF EXISTS `mission_target`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission_target` (
  `mission_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  PRIMARY KEY (`mission_id`,`target_id`),
  KEY `IDX_1E97F5B2BE6CAE90` (`mission_id`),
  KEY `IDX_1E97F5B2158E0B66` (`target_id`),
  CONSTRAINT `FK_1E97F5B2158E0B66` FOREIGN KEY (`target_id`) REFERENCES `target` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1E97F5B2BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission_target`
--

LOCK TABLES `mission_target` WRITE;
/*!40000 ALTER TABLE `mission_target` DISABLE KEYS */;
INSERT INTO `mission_target` VALUES (1,3);
/*!40000 ALTER TABLE `mission_target` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill`
--

LOCK TABLES `skill` WRITE;
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
INSERT INTO `skill` VALUES (1,'fight','2022-02-20 09:03:33','2022-02-20 09:03:33'),(2,'Kung-fu','2022-02-20 09:03:33','2022-02-20 09:03:33'),(3,'precision','2022-02-20 09:03:33','2022-02-20 09:03:33'),(4,'Speed','2022-02-20 09:03:33','2022-02-20 09:03:33'),(5,'Thai-Shi','2022-02-20 09:03:33','2022-02-20 09:03:33'),(6,'Thief','2022-02-20 09:03:33','2022-02-20 09:03:33'),(7,'Strength','2022-02-20 09:03:33','2022-02-20 09:03:33');
/*!40000 ALTER TABLE `skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `target`
--

DROP TABLE IF EXISTS `target`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `nationality` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `target`
--

LOCK TABLES `target` WRITE;
/*!40000 ALTER TABLE `target` DISABLE KEYS */;
INSERT INTO `target` VALUES (1,'The Joker','Joey','Kerr','2022-02-20','United-States','jocker.png','2022-02-20 09:03:33','2022-02-22 15:18:37'),(2,'The Torche','Boby','Brown','2022-02-20','England',NULL,'2022-02-20 09:03:33','2022-02-20 09:03:33'),(3,'Magneto','Jean','Pierre','2022-02-20','France',NULL,'2022-02-20 09:03:33','2022-02-20 09:03:33');
/*!40000 ALTER TABLE `target` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-30 17:59:38
