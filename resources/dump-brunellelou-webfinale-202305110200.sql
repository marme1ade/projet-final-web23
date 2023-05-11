-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: brunellelou-webfinale
-- ------------------------------------------------------
-- Server version	5.5.5-10.6.7-MariaDB-1:10.6.7+maria~focal

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
-- Table structure for table `artiste`
--

DROP TABLE IF EXISTS `artiste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artiste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artiste`
--

LOCK TABLES `artiste` WRITE;
/*!40000 ALTER TABLE `artiste` DISABLE KEYS */;
INSERT INTO `artiste` VALUES (2,'Frédéric Chopin','Frédéric Chopin est un compositeur et pianiste polonais né le 1er mars 1810 et mort le 17 octobre 1849 de la tuberculose pulmonaire. Son nom de naissance est Fryderyk Franciszek Chopin, il adopta ses prénoms francisés Frédéric-François lorsqu\'il quitta définitivement la Pologne pour Paris. '),(5,'Claude Debussy','Claude Debussy est un compositeur français né le 22 août 1862 à Saint-Germain-en-Laye et mort le 25 mars 1918 à Paris');
/*!40000 ALTER TABLE `artiste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `composition`
--

DROP TABLE IF EXISTS `composition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `composition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_periode` int(11) NOT NULL,
  `id_artiste` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `composition_FK` (`id_artiste`),
  KEY `composition_FK_1` (`id_periode`),
  CONSTRAINT `composition_FK` FOREIGN KEY (`id_artiste`) REFERENCES `artiste` (`id`),
  CONSTRAINT `composition_FK_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `composition`
--

LOCK TABLES `composition` WRITE;
/*!40000 ALTER TABLE `composition` DISABLE KEYS */;
INSERT INTO `composition` VALUES (1,5,2,'Polonaise-fantaisie, Op.61','La Polonaise-Fantaisie en la bémol majeur op. 61 est une polonaise de Frédéric Chopin. Composée en 1846, elle est dédiée « à Madame A. Veyret », amie du compositeur, et publiée chez l\'éditeur Brandus à Paris.'),(3,5,2,'Étude op. 10, no 1 de Chopin','L\'Étude op. 10, no 1 en do majeur, connue sous le nom d\'Étude La Cascade (en anglais Waterfall), est une étude pour piano solo composée par Frédéric Chopin en 1829. Elle a été publiée pour la première fois en 1833 en France, Allemagne et Angleterre.');
/*!40000 ALTER TABLE `composition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partition_musique`
--

DROP TABLE IF EXISTS `partition_musique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partition_musique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_periode` int(11) NOT NULL,
  `id_composition` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `nom_fichier` text NOT NULL,
  `upload_par` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `partition_musique_FK` (`id_periode`),
  KEY `partition_musique_FK_1` (`id_composition`),
  CONSTRAINT `partition_musique_FK` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`),
  CONSTRAINT `partition_musique_FK_1` FOREIGN KEY (`id_composition`) REFERENCES `composition` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partition_musique`
--

LOCK TABLES `partition_musique` WRITE;
/*!40000 ALTER TABLE `partition_musique` DISABLE KEYS */;
INSERT INTO `partition_musique` VALUES (7,5,1,'Polonaise-fantaisie, Op.61 [Scan 1845]','a7cda697a6ba81ad.pdf',1),(8,5,3,'Book 1 (Nos.1-6)','005f09c145f49b9b.pdf',1),(9,5,3,'Book 2 (Nos.7-12)','417c10135a82de03.pdf',1);
/*!40000 ALTER TABLE `partition_musique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periode`
--

DROP TABLE IF EXISTS `periode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periode`
--

LOCK TABLES `periode` WRITE;
/*!40000 ALTER TABLE `periode` DISABLE KEYS */;
INSERT INTO `periode` VALUES (1,'Medieval'),(2,'Renaissance'),(3,'Baroque'),(4,'Classique'),(5,'Romantique'),(6,'Moderne'),(7,'Post-Moderne');
/*!40000 ALTER TABLE `periode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usager`
--

DROP TABLE IF EXISTS `usager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `cle_api` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usager_FK` (`cle_api`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usager`
--

LOCK TABLES `usager` WRITE;
/*!40000 ALTER TABLE `usager` DISABLE KEYS */;
INSERT INTO `usager` VALUES (4,'stan','$2y$10$iembIrRG/zz8.M2Iaut3oOP5p19OQ.uanMh1dGWVwvOY9ugQdoDaq','zjUtRsPKxAVWIkGk');
/*!40000 ALTER TABLE `usager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'brunellelou-webfinale'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-11  2:00:45
