-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: livetag
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik` (
  `KorisnikID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Username` varchar(60) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(60) CHARACTER SET utf8 NOT NULL,
  `Ime` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `Prezime` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `DatumRodjenja` date DEFAULT NULL,
  `MestoStanovanja` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `Pol` char(1) DEFAULT NULL,
  `Email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `BrojPoena` int(11) DEFAULT NULL,
  `TipKorisnika` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `StiglaPoruka` bit(1) DEFAULT NULL,
  `PorukaZaElite` text,
  PRIMARY KEY (`KorisnikID`),
  UNIQUE KEY `KorisnikID_UNIQUE` (`KorisnikID`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (1,'admin','admin','Administrator','Administrator','2016-05-11','Zemun','M','micdo94@outlook.com',0,'admin','\0',NULL),(2,'mod','mod','Moderator','Moderator','2016-05-11','Zemun','M','micdo94@outlook.com',0,'moderator','\0',NULL),(3,'micdo','micdo','Marko','Domic','1994-01-25','Zemun','M','micdo94@outlook.com',0,'Elite','\0',NULL),(5,'veljaRob','veljaRob','Veljko','Markovic','1994-06-04','Vozdovac za picke','M','mv130137d@student.etf.rs',0,'premium','\0',NULL),(6,'andjela','andjela','Andjela','Spasic','1994-06-04','Blokovi','Z','sa130055d@student.etf.rs',0,'basic','\0',NULL),(7,'geko','geko','Aleksandar','Genal','1995-01-22','Zemun','M','ga130012d@student.etf.rs',0,'basic','\0',NULL);
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-11 22:33:00
