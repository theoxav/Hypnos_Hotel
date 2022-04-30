-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: hypnos_hotel
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
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establishement_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `suite_id` int(11) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E00CEDDEC65F9894` (`establishement_id`),
  KEY `IDX_E00CEDDEA76ED395` (`user_id`),
  KEY `IDX_E00CEDDE4FFCB518` (`suite_id`),
  CONSTRAINT `FK_E00CEDDE4FFCB518` FOREIGN KEY (`suite_id`) REFERENCES `suite` (`id`),
  CONSTRAINT `FK_E00CEDDEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_E00CEDDEC65F9894` FOREIGN KEY (`establishement_id`) REFERENCES `establishement` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
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
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20220421104513','2022-04-21 10:45:20',201);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establishement`
--

DROP TABLE IF EXISTS `establishement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establishement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_best` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8BBF0C72A76ED395` (`user_id`),
  CONSTRAINT `FK_8BBF0C72A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establishement`
--

LOCK TABLES `establishement` WRITE;
/*!40000 ALTER TABLE `establishement` DISABLE KEYS */;
INSERT INTO `establishement` VALUES (1,2,'The Fabulous','4 square Blank','EC2P 2E','London','Hatter went on, taking first one side and up the fan and two or three times over to the jury.','london.jpg','the-fabulous','The place to be','londonbanner.jpg',0,'2022-04-21 10:45:33','2022-04-21 10:45:33'),(2,3,'Le grand Palais','5 avenue des champs Élysée','75015','Paris','Alice more boldly: \'you know you\'re growing too.\' \'Yes, but I can\'t be civil, you\'d better finish the story for yourself.\' \'No, please go on!\' Alice.','paris.jpg','le-grand-palais','Luxe et élégance','parisbanner.jpg',0,'2022-04-21 10:45:33','2022-04-21 10:45:33'),(3,4,'Le Majestic','1 place du sauveur','60000','Nice','However, the Multiplication Table doesn\'t signify: let\'s try Geography. London is the driest thing I know. Silence all.','nice.jpg','le-majestic','Luxe et prestige','nicebanner.jpg',0,'2022-04-21 10:45:33','2022-04-21 10:45:33'),(4,5,'Le Normandy','5 avenue de la République','14000','Caen','There was no use in the window, and on it but tea. \'I don\'t know the.','caen.jpg','le-normandy','Un Havre de paix ','caenbanner.jpg',0,'2022-04-21 10:45:33','2022-04-21 10:45:33'),(5,6,'Le Royal Deauville','5 impasse de la prairie','14800','Deauville-Trouville','Queen furiously, throwing an.','deauville.jpg','le-royal-deauville','Une bulle d\'oxygène face à la mer','deauvillebanner.jpg',0,'2022-04-21 10:45:33','2022-04-21 10:45:33');
/*!40000 ALTER TABLE `establishement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_hotel`
--

DROP TABLE IF EXISTS `service_hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_hotel`
--

LOCK TABLES `service_hotel` WRITE;
/*!40000 ALTER TABLE `service_hotel` DISABLE KEYS */;
INSERT INTO `service_hotel` VALUES (1,'SPA','Alice replied eagerly, for she had been wandering, when a cry of \'The trial\'s beginning!\' was heard in the distance. \'And yet what a delightful.','spa.jpg'),(2,'Gastronomy','I only wish they COULD! I\'m sure she\'s the best of educations--in fact, we went to school in the window, and one foot to the Queen. \'I haven\'t the slightest idea,\' said the Hatter.','gastronomy.jpg'),(3,'Casino','Her first idea was that it might happen any minute, \'and then,\' thought she, \'what would become of me? They\'re.','casino.jpg'),(4,'Cinema','Eaglet, and several other curious creatures. Alice led the way, and then turned to the jury, in a tone of great surprise. \'Of course not,\' Alice.','casino.jpg'),(5,'Sport','Beautiful, beautiful Soup!\' CHAPTER XI. Who Stole the Tarts?.','sport.jpg');
/*!40000 ALTER TABLE `service_hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suite`
--

DROP TABLE IF EXISTS `suite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `establishement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `IDX_153CE426C65F9894` (`establishement_id`),
  KEY `IDX_153CE426A76ED395` (`user_id`),
  CONSTRAINT `FK_153CE426A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_153CE426C65F9894` FOREIGN KEY (`establishement_id`) REFERENCES `establishement` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suite`
--

LOCK TABLES `suite` WRITE;
/*!40000 ALTER TABLE `suite` DISABLE KEYS */;
INSERT INTO `suite` VALUES (1,1,2,'Un Homme et une Femme','Five! Always lay the blame on others!\' \'YOU\'D better not do that again!\' which produced another dead.',8000,'londonsuite.jpg','2022-04-21 10:45:33','2022-04-21 10:45:33'),(2,1,2,'Signature British','Alice glanced rather anxiously at the bottom of the table. \'Have some wine,\' the March Hare meekly replied. \'Yes, but some crumbs must have a trial: For really this morning I\'ve nothing.',8500,'londonsuite2.jpg','2022-04-21 10:45:33','2022-04-21 10:45:33'),(3,2,3,'Signature George V','Alice. \'Of course not,\' Alice replied in an angry voice--the Rabbit\'s--\'Pat! Pat! Where are you?\' And then a row of lodging houses, and.',12500,'parissuite.jpg','2022-04-21 10:45:33','2022-04-21 10:45:33'),(4,2,3,'Signature Arc de Triomphe','Alice dodged behind a great deal of thought, and it sat for a minute, while Alice thought she might as.',18500,'parissuite2.jpg','2022-04-21 10:45:33','2022-04-21 10:45:33'),(5,3,4,'Chambre Deluxe Mer','Alice, as she could. \'The Dormouse is asleep again,\' said the Caterpillar decidedly, and he checked.',3500,'nicesuite.jpg','2022-04-21 10:45:33','2022-04-21 10:45:33'),(6,3,4,'Chambre Prestige Mer','Who ever saw one that size? Why, it fills the whole cause, and condemn you.',7500,'nicesuite2.jpg','2022-04-21 10:45:33','2022-04-21 10:45:33'),(7,4,5,'Le Prestige','I think you\'d better ask HER about it.\' \'She\'s in prison,\' the Queen was close behind it was.',14500,'caensuite.jpg','2022-04-21 10:45:33','2022-04-21 10:45:33'),(8,4,5,'La petite prairie','Dormouse,\' the Queen to-day?\' \'I should like to be found: all she could see this, as she tucked her arm.',14500,'caensuite2.jpg','2022-04-21 10:45:33','2022-04-21 10:45:33'),(9,5,6,'Beauté Campagne','I THINK,\' said Alice. \'Well, I should think very likely true.) Down, down, down. Would the fall NEVER come to an end! \'I.',12500,'deauvillesuite.jpg','2022-04-21 10:45:33','2022-04-21 10:45:33'),(10,5,6,'Douce nuit','Alice replied, so eagerly that the Queen.',12500,'deauvillesuite2.jpg','2022-04-21 10:45:33','2022-04-21 10:45:33');
/*!40000 ALTER TABLE `suite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'johnhypnos@example.com','[\"ROLE_ADMIN\"]','$2y$13$tK76w11.tqA4FfxqggSeYuYkQngMhqoNRolA3BOKf4cUFl0KrwZgO','John','Hypnos','2022-04-21 10:45:33','2022-04-21 10:45:33'),(2,'janegoodall@example.com','[\"ROLE_MANAGER\"]','$2y$13$hl7HzY5fGJf.jd418uXv7OkPHRwZD4Zo9TKIkBz6pSweyQWop0s3G','Jane','Goodall','2022-04-21 10:45:33','2022-04-21 10:45:33'),(3,'jackparis@example.com','[\"ROLE_MANAGER\"]','$2y$13$9q/XmsJMUVsymvgNJPrYuuOtS7dcG3WKa2D1wBsVBfM7fezZkDnpe','Jack','Paris','2022-04-21 10:45:33','2022-04-21 10:45:33'),(4,'markdoe@example.com','[\"ROLE_MANAGER\"]','$2y$13$hBzSKdRQpHxNWXZQurK0feyY5XSVA9kNy4VkCIXXgWxO8OsRFgEOy','Mark','Doe','2022-04-21 10:45:33','2022-04-21 10:45:33'),(5,'jeantorin@example.com','[\"ROLE_MANAGER\"]',' $2y$13$yNMyhLIg0O7QeYtUyjz7m.Yx9z91tieWvnCb6smWzWXRvQ6EJAwiq','Jean','Torin','2022-04-21 10:45:33','2022-04-21 10:45:33'),(6,'Juliettekaty@example.com','[\"ROLE_MANAGER\"]','$2y$13$eJMdRc2nPOavFqMCYSqBZeskI8j412UlMMTDYzhYj5NtOalrhEcjG','Juliette','Katy','2022-04-21 10:45:33','2022-04-21 10:45:33'),(7,'johndoe@example.com','[]','$2y$13$1rAfeg2nw1AcozDGL1tkqOqCSo2e9pu909Z1b4HmsukynUlKzcNCK','John','Doe','2022-04-21 10:45:33','2022-04-21 10:45:33');
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

-- Dump completed on 2022-04-30 15:06:17
