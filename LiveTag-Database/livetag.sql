-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2016 at 04:21 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `livetag`
--

-- --------------------------------------------------------

--
-- Table structure for table `glasovi`
--

CREATE TABLE IF NOT EXISTS `glasovi` (
  `KorisnikID` bigint(20) NOT NULL,
  `SlikaID` bigint(20) NOT NULL,
  PRIMARY KEY (`KorisnikID`,`SlikaID`),
  KEY `Slika_idx` (`SlikaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `glasovi`
--

INSERT INTO `glasovi` (`KorisnikID`, `SlikaID`) VALUES
(14, 39),
(17, 39),
(18, 39),
(19, 39),
(20, 39),
(14, 40),
(18, 40),
(20, 40),
(21, 40),
(14, 41),
(16, 41),
(17, 41),
(19, 41),
(21, 41),
(14, 42),
(20, 42),
(14, 43),
(21, 43),
(14, 44),
(14, 49),
(15, 53),
(16, 53),
(17, 53),
(15, 54),
(16, 54),
(15, 55),
(15, 60),
(16, 60),
(18, 60),
(19, 60),
(20, 60),
(14, 61),
(15, 61),
(18, 61),
(19, 61),
(20, 61),
(14, 62),
(15, 62),
(19, 62),
(20, 62),
(16, 63),
(20, 63),
(14, 64),
(16, 64),
(19, 64),
(16, 65),
(20, 65),
(20, 67),
(16, 68);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
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
  `ZadnjaObjava` date DEFAULT NULL,
  `TipKorisnika` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `AvatarURL` varchar(10000) DEFAULT NULL,
  `StiglaPoruka` bit(1) DEFAULT NULL,
  `PorukaZaElite` text,
  PRIMARY KEY (`KorisnikID`),
  UNIQUE KEY `KorisnikID_UNIQUE` (`KorisnikID`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`KorisnikID`, `Username`, `Password`, `Ime`, `Prezime`, `DatumRodjenja`, `MestoStanovanja`, `Pol`, `Email`, `BrojPoena`, `ZadnjaObjava`, `TipKorisnika`, `AvatarURL`, `StiglaPoruka`, `PorukaZaElite`) VALUES
(12, 'admin', '$2y$10$938vMKY6rVcGs7YVG2.dJuvQu2pWDqZ7AIUBjJL4vwAGvHAb5Krsu', 'admin', 'admin', '2016-01-01', 'Zemun', 'M', 'admin@admin.com', 0, NULL, 'admin', NULL, b'0', NULL),
(13, 'mod', '$2y$10$3ledFC3yDPXp7YV3r7OxPOdiut1wtW8N3uWDF1ypuBGSSEUAy8O7C', 'moderator', 'moderator', '2016-01-01', 'Zemun', 'Z', 'mod@mod.com', 0, NULL, 'mod', NULL, b'0', NULL),
(14, 'micdo', '$2y$10$s4zD0m7oR4NQUz1Hi2Gh0OjVP7dTxjsMR6sxknMIWBGXO/IFyqSCi', 'Marko', 'Domi&#263;', '1994-01-25', 'Zemun', 'M', 'micdo94@outlook.com', 328, '2016-05-26', 'elite', 'slike/marko.jpg', b'0', NULL),
(15, 'gazda', '$2y$10$U/f1Sg2ilEAL3J2SM3H5EuJsbVSTYsua2v9jlS5v.itqaGr/h6b2m', 'Veljko', 'Markovic', '1994-06-04', 'Miljakovac', 'M', 'mv130137d@student.etf.rs', 233, '2016-05-26', 'elite', 'slike/rob.jpg', b'0', NULL),
(16, 'geko', '$2y$10$SpV2MuRZlVaTHQBhss8ztenkVuEOjtMQYDkTNzNP6zBPMvgqVT4Ji', 'Aleksandar', 'Genal', '1995-01-25', 'Zemun', 'M', 'ga130012d@student.etf.rs', 143, '2016-05-26', 'premium', 'slike/geko.jpg', b'0', NULL),
(17, 'merkel', '$2y$10$ES6HMXj4.G3v72nDUw7M9uhgdUau8RneyCcbkVAzum/bvp0WfvgVK', 'Andjela', 'Spasic', '1994-03-02', 'NBG', 'Z', 'sa130055d@student.etf.rs', 115, '2016-05-26', 'premium', 'slike/merkel.jpg', b'0', NULL),
(18, 'diamond', '$2y$10$JiTb9gwmeZ4jjpmqJD4fsOH79NYAGHskPht1P0SPhSObJpLDAbQgq', 'Marija', 'Radovic', '1994-10-01', 'Vozdovac', 'Z', 'makica@hotmail.com', 98, '2016-05-26', 'basic', 'slike/diamond.jpg', b'0', NULL),
(19, 'domara', '$2y$10$wjMiqCxeqyn1ymoU0.qN4eYlpsE7/LW/TIKCW6U2rOLpiJX.LhB4y', 'Marija', 'Domi&#263;', '1995-09-05', 'Zemun', 'Z', 'domicka@hotmail.com', 82, '2016-05-26', 'basic', 'slike/sestra.jpg', b'0', NULL),
(20, 'vicde', '$2y$10$.dCux98afYwFrcaRk6TWOuswd5aHYOLNX/vggzItiOE4kY0e4.ZPC', 'Aleksandar', 'Devic', '1994-06-18', 'Zemun', 'M', 'vicdemunze@hotmail.com', 54, '2016-05-26', 'basic', 'slike/vicde.JPG', b'0', NULL),
(21, 'lukica', '$2y$10$sGmCSf3yGOItjLbsfNoXouMO5UwESRkJRoaHTQUq/tEdZuxEC5ntu', 'Luka', 'Ognjanov', '1994-12-28', 'Zemun', 'M', 'lukica@gmail.com', 51, '2016-05-26', 'basic', 'slike/gio.jpg', b'0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slika_post`
--

CREATE TABLE IF NOT EXISTS `slika_post` (
  `SlikaID` bigint(20) NOT NULL AUTO_INCREMENT,
  `SlikaURL` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `KorisnikID` bigint(20) NOT NULL,
  `TopikID` bigint(20) NOT NULL,
  `BrojGlasova` bigint(20) DEFAULT '0',
  PRIMARY KEY (`SlikaID`),
  UNIQUE KEY `SlikaID_UNIQUE` (`SlikaID`),
  KEY `Vlasnik_idx` (`KorisnikID`),
  KEY `TopikSlike_idx` (`TopikID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `slika_post`
--

INSERT INTO `slika_post` (`SlikaID`, `SlikaURL`, `KorisnikID`, `TopikID`, `BrojGlasova`) VALUES
(39, '../slike_posts/1-16-genal.jpg', 16, 1, 5),
(40, '../slike_posts/1-17-andjela.jpg', 17, 1, 4),
(41, '../slike_posts/1-18-Marija.jpg', 18, 1, 5),
(42, '../slike_posts/1-19-domicka.jpg', 19, 1, 2),
(43, '../slike_posts/1-20-vicde.jpg', 20, 1, 2),
(44, '../slike_posts/1-21-ognjanov.jpg', 21, 1, 1),
(49, '../slike_posts/1-15-velja.jpg', 15, 1, 1),
(50, '../slike_posts/1-14-marko.jpg', 14, 1, 0),
(53, '../slike_posts/2-14-marko2.jpg', 14, 2, 3),
(54, '../slike_posts/2-17-andjela2.jpg', 17, 2, 2),
(55, '../slike_posts/2-16-genal2.jpg', 16, 2, 1),
(56, '../slike_posts/2-15-velja2.jpg', 15, 2, 0),
(60, '../slike_posts/3-14-marko3.jpg', 14, 3, 4),
(61, '../slike_posts/3-17-andjela3.jpg', 17, 3, 5),
(62, '../slike_posts/3-16-genal3.jpg', 16, 3, 4),
(63, '../slike_posts/3-15-velja3.jpg', 15, 3, 2),
(64, '../slike_posts/3-18-Marija3.jpg', 18, 3, 3),
(65, '../slike_posts/3-19-domicka3.jpg', 19, 3, 2),
(67, '../slike_posts/3-21-ognjanov3.jpg', 21, 3, 1),
(68, '../slike_posts/3-20-vicde3.jpg', 20, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topik`
--

CREATE TABLE IF NOT EXISTS `topik` (
  `TopikID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `DatumObjave` date DEFAULT NULL,
  `Objavljen` tinyint(1) DEFAULT '0',
  `PrvoMesto` bigint(20) DEFAULT NULL,
  `DrugoMesto` bigint(20) DEFAULT NULL,
  `TreceMesto` bigint(20) DEFAULT NULL,
  `CetvrtoMesto` bigint(20) DEFAULT NULL,
  `PetoMesto` bigint(20) DEFAULT NULL,
  `KorisnikID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`TopikID`),
  UNIQUE KEY `TopikID_UNIQUE` (`TopikID`),
  KEY `KorisnikID_idx` (`KorisnikID`),
  KEY `PrvoMesto_idx` (`PrvoMesto`),
  KEY `DrugoMesto_idx` (`DrugoMesto`),
  KEY `TreceMesto_idx` (`TreceMesto`),
  KEY `CetvrtoMesto_idx` (`CetvrtoMesto`),
  KEY `PetoMesto_idx` (`PetoMesto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `topik`
--

INSERT INTO `topik` (`TopikID`, `Naziv`, `DatumObjave`, `Objavljen`, `PrvoMesto`, `DrugoMesto`, `TreceMesto`, `CetvrtoMesto`, `PetoMesto`, `KorisnikID`) VALUES
(1, 'TopikTest', '2016-05-24', 2, 41, 39, 40, 42, 43, 13),
(2, 'TopikTest2', '2016-05-25', 2, 53, 54, 55, 56, NULL, 13),
(3, 'TopikTest3', '2016-05-26', 1, NULL, NULL, NULL, NULL, NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `zahtev`
--

CREATE TABLE IF NOT EXISTS `zahtev` (
  `ZahtevID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `KorisnikID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ZahtevID`),
  KEY `Korisnik_idx` (`KorisnikID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `glasovi`
--
ALTER TABLE `glasovi`
  ADD CONSTRAINT `Korisnik` FOREIGN KEY (`KorisnikID`) REFERENCES `korisnik` (`KorisnikID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Slika` FOREIGN KEY (`SlikaID`) REFERENCES `slika_post` (`SlikaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slika_post`
--
ALTER TABLE `slika_post`
  ADD CONSTRAINT `TopikSlike` FOREIGN KEY (`TopikID`) REFERENCES `topik` (`TopikID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `Vlasnik` FOREIGN KEY (`KorisnikID`) REFERENCES `korisnik` (`KorisnikID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topik`
--
ALTER TABLE `topik`
  ADD CONSTRAINT `CetvrtoMesto` FOREIGN KEY (`CetvrtoMesto`) REFERENCES `slika_post` (`SlikaID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `DrugoMesto` FOREIGN KEY (`DrugoMesto`) REFERENCES `slika_post` (`SlikaID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `KorisnikID` FOREIGN KEY (`KorisnikID`) REFERENCES `korisnik` (`KorisnikID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `PetoMesto` FOREIGN KEY (`PetoMesto`) REFERENCES `slika_post` (`SlikaID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `PrvoMesto` FOREIGN KEY (`PrvoMesto`) REFERENCES `slika_post` (`SlikaID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `TreceMesto` FOREIGN KEY (`TreceMesto`) REFERENCES `slika_post` (`SlikaID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `zahtev`
--
ALTER TABLE `zahtev`
  ADD CONSTRAINT `KorisnikZahteva` FOREIGN KEY (`KorisnikID`) REFERENCES `korisnik` (`KorisnikID`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
