-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2016 at 09:56 PM
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
  `TipKorisnika` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `AvatarURL` varchar(1000) DEFAULT NULL,
  `StiglaPoruka` bit(1) DEFAULT NULL,
  `PorukaZaElite` text,
  PRIMARY KEY (`KorisnikID`),
  UNIQUE KEY `KorisnikID_UNIQUE` (`KorisnikID`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`KorisnikID`, `Username`, `Password`, `Ime`, `Prezime`, `DatumRodjenja`, `MestoStanovanja`, `Pol`, `Email`, `BrojPoena`, `TipKorisnika`, `AvatarURL`, `StiglaPoruka`, `PorukaZaElite`) VALUES
(3, 'micdo', 'micdo', 'Marko', 'Domic', '1994-01-25', 'Zemun', 'M', 'micdo94@outlook.com', 205, 'elite', NULL, b'1', 'sisaj ga'),
(5, 'veljaRob', 'veljaRob', 'Veljko', 'Markovic', '1994-06-04', 'Vozdovac za picke', 'M', 'mv130137d@student.etf.rs', 151, 'premium', NULL, b'0', NULL),
(7, 'geko', 'geko', 'Aleksandar', 'Genal', '1995-01-22', 'Zemun', 'M', 'ga130012d@student.etf.rs', 70, 'basic', NULL, b'0', NULL),
(8, 'domara', 'domara', 'Marija', 'Domic', '1995-09-05', 'Zemun', 'Z', 'domicka95@gmail.com', 90, 'basic', NULL, b'0', NULL),
(9, 'diamond', 'diamond', 'Marija', 'Radovic', '1994-10-01', 'Vozdovac', 'Z', 'radovicm@gmail.com', 99, 'basic', NULL, b'0', NULL),
(10, 'vicde', 'vicde', 'Aleksandar', 'Devic', '1994-06-18', 'Zemun', 'M', 'vicdemunze@gmail.com', 50, 'basic', NULL, b'0', NULL),
(11, 'lukica', 'lukica', 'Luka', 'Ognjanov', '1994-12-01', 'Zemun', 'M', 'ognjanov@gmail.com', 49, 'basic', NULL, b'0', NULL),
(13, 'neko2', '$2y$10$kbz7/.s4DV0BnIZ6c85B3uSr8naNYqTBJMkkl9TBiI72h2WLstj.a', 'neko2', 'neko', '2016-01-01', 'MUNZE', 'Z', 'a@a.rs', 0, 'basic', NULL, b'0', NULL),
(14, 'admin', '$2y$10$BGbSA6BPGm7Vcoz8dpZp1eKk5T7iIhaIWo8Rn7Gcps2itOrnSXKwa', 'admin', 'admin', '2016-01-01', 'admin', 'M', 'b@b.rs', 0, 'admin', NULL, b'0', NULL),
(15, 'mod', '$2y$10$e1Mf0Zq634wixfMk58K.j.e1QU/tzJFhekuO6Srl0XDpSwzq3cuQK', 'mod', 'mod', '2016-01-01', 'Vozd', 'M', 'qq@qq.rs', 0, 'mod', NULL, b'0', NULL),
(16, 'andjela', '$2y$10$.rHLtpYflTnKhaR7Arer8.m/2CBroZKaq6ePhBCYEhn.6RqA8BR3G', 'andjela', 'andjela', '2016-01-01', 'nbg', 'Z', 'aa@aa.com', 0, 'basic', 'slike/marko.jpg', b'0', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `slika_post`
--

INSERT INTO `slika_post` (`SlikaID`, `SlikaURL`, `KorisnikID`, `TopikID`, `BrojGlasova`) VALUES
(2, '../slike_posts/1-5-velja.jpg', 5, 1, 1),
(4, '../slike_posts/1-7-genal.jpg', 7, 1, 1),
(5, '../slike_posts/1-8-domicka.jpg', 8, 1, 0),
(6, '../slike_posts/1-9-Marija.jpg', 9, 1, 1),
(7, '../slike_posts/1-10-vicde.jpg', 10, 1, 1),
(9, '../slike_posts/1-11-ognjanov.jpg', 11, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `topik`
--

CREATE TABLE IF NOT EXISTS `topik` (
  `TopikID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `DatumObjave` date DEFAULT NULL,
  `Objavljen` bit(1) DEFAULT b'0',
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `topik`
--

INSERT INTO `topik` (`TopikID`, `Naziv`, `DatumObjave`, `Objavljen`, `PrvoMesto`, `DrugoMesto`, `TreceMesto`, `CetvrtoMesto`, `PetoMesto`, `KorisnikID`) VALUES
(1, 'TopikTest', '2016-05-19', b'0', NULL, NULL, NULL, NULL, NULL, 3),
(3, 'picka', '2016-05-19', b'0', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'jaja', '2016-05-19', b'0', NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
  ADD CONSTRAINT `CetvrtoMesto` FOREIGN KEY (`CetvrtoMesto`) REFERENCES `slika_post` (`SlikaID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `DrugoMesto` FOREIGN KEY (`DrugoMesto`) REFERENCES `slika_post` (`SlikaID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `KorisnikID` FOREIGN KEY (`KorisnikID`) REFERENCES `korisnik` (`KorisnikID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `PetoMesto` FOREIGN KEY (`PetoMesto`) REFERENCES `slika_post` (`SlikaID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `PrvoMesto` FOREIGN KEY (`PrvoMesto`) REFERENCES `slika_post` (`SlikaID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `TreceMesto` FOREIGN KEY (`TreceMesto`) REFERENCES `slika_post` (`SlikaID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `zahtev`
--
ALTER TABLE `zahtev`
  ADD CONSTRAINT `KorisnikZahteva` FOREIGN KEY (`KorisnikID`) REFERENCES `korisnik` (`KorisnikID`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
