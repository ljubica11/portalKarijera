-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 19, 2019 at 08:27 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karijera`
--
CREATE DATABASE IF NOT EXISTS `karijera` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `karijera`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idKor` int(11) NOT NULL,
  `ime` varchar(45) DEFAULT NULL,
  `prezime` varchar(45) DEFAULT NULL,
  `telefon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKor`),
  KEY `idAdmKor_idx` (`idKor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clanovigrupe`
--

DROP TABLE IF EXISTS `clanovigrupe`;
CREATE TABLE IF NOT EXISTS `clanovigrupe` (
  `idGru` int(11) NOT NULL,
  `idKor` int(11) NOT NULL,
  PRIMARY KEY (`idGru`,`idKor`),
  KEY `fk_clanovigrupe_grupe1_idx` (`idGru`),
  KEY `fk_clanovigrupe_student1_idx` (`idKor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `diploma`
--

DROP TABLE IF EXISTS `diploma`;
CREATE TABLE IF NOT EXISTS `diploma` (
  `idKor` int(11) NOT NULL,
  `fakultet` varchar(45) DEFAULT NULL,
  `odsek` varchar(45) DEFAULT NULL,
  `nivo` varchar(45) DEFAULT NULL,
  `godinaUpisa` int(11) DEFAULT NULL,
  `godinaZavrsetka` int(11) DEFAULT NULL,
  `zvanje` varchar(45) DEFAULT NULL,
  `idFak` int(11) NOT NULL,
  PRIMARY KEY (`idKor`),
  KEY `fk_diploma_siffakulteti1_idx` (`idFak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diploma`
--

INSERT INTO `diploma` (`idKor`, `fakultet`, `odsek`, `nivo`, `godinaUpisa`, `godinaZavrsetka`, `zvanje`, `idFak`) VALUES
(16, '1', 'php', '2', 1990, 1995, 'ing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `diskusija`
--

DROP TABLE IF EXISTS `diskusija`;
CREATE TABLE IF NOT EXISTS `diskusija` (
  `idDis` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  `opis` varchar(45) DEFAULT NULL,
  `kategorija` int(11) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `vidljivost` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDis`),
  KEY `idDisidKor_idx` (`autor`),
  KEY `idDisidKat_idx` (`kategorija`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diskusija`
--

INSERT INTO `diskusija` (`idDis`, `naziv`, `opis`, `kategorija`, `datum`, `autor`, `vidljivost`) VALUES
(1, 'test', 'testiranje', 1, '2019-07-15 00:00:00', 16, '3'),
(2, 'strani kljucevi', 'sta ide pre', 2, '2019-07-16 00:00:00', 24, '3'),
(3, 'engine', 'inno ili myisam', 2, '2019-07-17 00:00:00', 16, '3');

-- --------------------------------------------------------

--
-- Table structure for table `grupe`
--

DROP TABLE IF EXISTS `grupe`;
CREATE TABLE IF NOT EXISTS `grupe` (
  `idGru` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idGru`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupe`
--

INSERT INTO `grupe` (`idGru`, `naziv`) VALUES
(1, 'PHP'),
(2, 'JAVA'),
(3, 'LINUX');

-- --------------------------------------------------------

--
-- Table structure for table `imainteresovanja`
--

DROP TABLE IF EXISTS `imainteresovanja`;
CREATE TABLE IF NOT EXISTS `imainteresovanja` (
  `idKor` int(11) NOT NULL,
  `idInt` int(11) NOT NULL,
  PRIMARY KEY (`idKor`,`idInt`),
  KEY `idInt_idx` (`idInt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imainteresovanja`
--

INSERT INTO `imainteresovanja` (`idKor`, `idInt`) VALUES
(16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `imavestine`
--

DROP TABLE IF EXISTS `imavestine`;
CREATE TABLE IF NOT EXISTS `imavestine` (
  `idKor` int(11) NOT NULL,
  `idVes` int(11) NOT NULL,
  PRIMARY KEY (`idKor`,`idVes`),
  KEY `idVestineeee_idx` (`idVes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imavestine`
--

INSERT INTO `imavestine` (`idKor`, `idVes`) VALUES
(16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kompanija`
--

DROP TABLE IF EXISTS `kompanija`;
CREATE TABLE IF NOT EXISTS `kompanija` (
  `naziv` varchar(45) DEFAULT NULL,
  `sediste` int(11) DEFAULT NULL,
  `pib` int(9) DEFAULT NULL,
  `telefoni` varchar(45) DEFAULT NULL,
  `opis` varchar(45) DEFAULT NULL,
  `oblastDelovanja` varchar(45) DEFAULT NULL,
  `brojZap` int(6) DEFAULT NULL,
  `sajt` varchar(45) DEFAULT NULL,
  `idKor` int(11) NOT NULL,
  PRIMARY KEY (`idKor`),
  UNIQUE KEY `pib_UNIQUE` (`pib`),
  UNIQUE KEY `naziv_UNIQUE` (`naziv`),
  KEY `idKorGrad_idx` (`sediste`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `idKor` int(11) NOT NULL AUTO_INCREMENT,
  `korisnicko` varchar(45) DEFAULT NULL,
  `lozinka` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tip` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`idKor`),
  UNIQUE KEY `idKor_UNIQUE` (`idKor`),
  UNIQUE KEY `username_UNIQUE` (`korisnicko`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKor`, `korisnicko`, `lozinka`, `email`, `tip`) VALUES
(16, 'gord', '456', 'gord', 's'),
(17, 'kompanija', '123', 'komp', 'k'),
(18, 'sanja', '123', 'sanja@mejl.co', 's'),
(21, 'sanjas', '123', 'sanja@mejl.co', 's'),
(23, 'sanja1', '123', 'sanja@mejl.co', 's'),
(24, 'zorana', '123', 'zorana@mejl.co', 's'),
(25, 'pera', '123', 'pera@mal', 's'),
(26, 'jova', '123', 'jova@mejl', '2');

-- --------------------------------------------------------

--
-- Table structure for table `obavestenja`
--

DROP TABLE IF EXISTS `obavestenja`;
CREATE TABLE IF NOT EXISTS `obavestenja` (
  `idOba` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(45) DEFAULT NULL,
  `tekst` varchar(45) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `vidljivost` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idOba`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oglasi`
--

DROP TABLE IF EXISTS `oglasi`;
CREATE TABLE IF NOT EXISTS `oglasi` (
  `idOgl` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tekst` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vremePostavljanja` datetime DEFAULT NULL,
  `vremeIsticanja` datetime DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `vidljivost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idOgl`),
  KEY `idAutidKor_idx` (`autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postdiskusija`
--

DROP TABLE IF EXISTS `postdiskusija`;
CREATE TABLE IF NOT EXISTS `postdiskusija` (
  `idPos` int(11) NOT NULL AUTO_INCREMENT,
  `poslatoDatum` datetime NOT NULL,
  `tekst` varchar(250) DEFAULT NULL,
  `posiljalac` int(11) DEFAULT NULL,
  `diskusija` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPos`),
  KEY `idDisidDis_idx` (`diskusija`),
  KEY `idKorUcesnik_idx` (`posiljalac`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postdiskusija`
--

INSERT INTO `postdiskusija` (`idPos`, `poslatoDatum`, `tekst`, `posiljalac`, `diskusija`) VALUES
(1, '2019-07-16 00:00:00', 'ajde', 16, 1),
(2, '2019-07-16 00:00:00', 'mozda radi sad', 23, 1),
(3, '2019-07-16 00:00:00', 'koji kljucevi imaju prednost', 24, 2),
(4, '2019-07-16 00:05:00', 'probacemo sve', 16, 2),
(8, '2019-07-16 00:00:00', 'stalno mi prebacuje na myisam', 16, 3),
(9, '2019-07-17 00:00:00', 'vidi u settingsu', 26, 3),
(10, '2019-07-17 00:00:00', 'mislim da cemo morati da brisemo fk u tb', 18, 2),
(15, '2019-07-18 00:00:00', 'da probamo ovo bez', 25, 3),
(16, '2019-07-19 00:00:00', 'dobar dan', 17, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sadrzidiskusije`
--

DROP TABLE IF EXISTS `sadrzidiskusije`;
CREATE TABLE IF NOT EXISTS `sadrzidiskusije` (
  `idDisk` int(11) NOT NULL,
  `idGrupe` int(11) NOT NULL,
  PRIMARY KEY (`idDisk`,`idGrupe`),
  KEY `idGrupe_idx` (`idGrupe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sadrziobavestenje`
--

DROP TABLE IF EXISTS `sadrziobavestenje`;
CREATE TABLE IF NOT EXISTS `sadrziobavestenje` (
  `idGrupe` int(11) NOT NULL,
  `idObav` int(11) NOT NULL,
  PRIMARY KEY (`idGrupe`,`idObav`),
  KEY `idObav_idx` (`idObav`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sadrzioglas`
--

DROP TABLE IF EXISTS `sadrzioglas`;
CREATE TABLE IF NOT EXISTS `sadrzioglas` (
  `idGru` int(11) NOT NULL,
  `idOgl` int(11) NOT NULL,
  PRIMARY KEY (`idGru`,`idOgl`),
  KEY `fk_sadrzioglas_grupe1_idx` (`idGru`),
  KEY `fk_sadrzioglas_oglasi1_idx` (`idOgl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sadrzivesti`
--

DROP TABLE IF EXISTS `sadrzivesti`;
CREATE TABLE IF NOT EXISTS `sadrzivesti` (
  `idVest` int(11) NOT NULL,
  `idGrupa` int(11) NOT NULL,
  PRIMARY KEY (`idVest`,`idGrupa`),
  KEY `idGrupa_idx` (`idGrupa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sifdrzavljanstvo`
--

DROP TABLE IF EXISTS `sifdrzavljanstvo`;
CREATE TABLE IF NOT EXISTS `sifdrzavljanstvo` (
  `idDrz` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDrz`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifdrzavljanstvo`
--

INSERT INTO `sifdrzavljanstvo` (`idDrz`, `naziv`) VALUES
(1, 'Srb');

-- --------------------------------------------------------

--
-- Table structure for table `siffakulteti`
--

DROP TABLE IF EXISTS `siffakulteti`;
CREATE TABLE IF NOT EXISTS `siffakulteti` (
  `idFak` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`idFak`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `siffakulteti`
--

INSERT INTO `siffakulteti` (`idFak`, `naziv`) VALUES
(1, 'etf');

-- --------------------------------------------------------

--
-- Table structure for table `sifgradovi`
--

DROP TABLE IF EXISTS `sifgradovi`;
CREATE TABLE IF NOT EXISTS `sifgradovi` (
  `idGra` int(11) NOT NULL,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idGra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifgradovi`
--

INSERT INTO `sifgradovi` (`idGra`, `naziv`) VALUES
(1, 'bgd');

-- --------------------------------------------------------

--
-- Table structure for table `sifinteresovanja`
--

DROP TABLE IF EXISTS `sifinteresovanja`;
CREATE TABLE IF NOT EXISTS `sifinteresovanja` (
  `idInt` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idInt`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifinteresovanja`
--

INSERT INTO `sifinteresovanja` (`idInt`, `naziv`) VALUES
(1, 'IT tehnologije');

-- --------------------------------------------------------

--
-- Table structure for table `sifkategorijadiskusija`
--

DROP TABLE IF EXISTS `sifkategorijadiskusija`;
CREATE TABLE IF NOT EXISTS `sifkategorijadiskusija` (
  `idKatDis` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKatDis`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifkategorijadiskusija`
--

INSERT INTO `sifkategorijadiskusija` (`idKatDis`, `naziv`) VALUES
(1, 'informacione tehnologije'),
(2, 'php'),
(3, 'java'),
(4, 'linux'),
(5, 'c++'),
(6, 'zaposlenje'),
(7, 'ljubav'),
(8, 'razno');

-- --------------------------------------------------------

--
-- Table structure for table `sifkategorijavesti`
--

DROP TABLE IF EXISTS `sifkategorijavesti`;
CREATE TABLE IF NOT EXISTS `sifkategorijavesti` (
  `idKatVesti` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKatVesti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sifkompanija`
--

DROP TABLE IF EXISTS `sifkompanija`;
CREATE TABLE IF NOT EXISTS `sifkompanija` (
  `idSifKo` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSifKo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sifkurs`
--

DROP TABLE IF EXISTS `sifkurs`;
CREATE TABLE IF NOT EXISTS `sifkurs` (
  `idKurs` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKurs`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifkurs`
--

INSERT INTO `sifkurs` (`idKurs`, `naziv`) VALUES
(1, 'PHP'),
(2, 'java'),
(3, 'linux');

-- --------------------------------------------------------

--
-- Table structure for table `sifpozicija`
--

DROP TABLE IF EXISTS `sifpozicija`;
CREATE TABLE IF NOT EXISTS `sifpozicija` (
  `idPoz` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPoz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sifuniverziteti`
--

DROP TABLE IF EXISTS `sifuniverziteti`;
CREATE TABLE IF NOT EXISTS `sifuniverziteti` (
  `idUni` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`idUni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sifvestine`
--

DROP TABLE IF EXISTS `sifvestine`;
CREATE TABLE IF NOT EXISTS `sifvestine` (
  `idVes` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idVes`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifvestine`
--

INSERT INTO `sifvestine` (`idVes`, `naziv`) VALUES
(1, 'kukicenje');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `ime` varchar(45) DEFAULT NULL,
  `srednjeIme` varchar(45) DEFAULT NULL,
  `prezime` varchar(45) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `pol` varchar(1) DEFAULT NULL,
  `drzavljanstvo` int(11) DEFAULT NULL,
  `telefon` varchar(45) DEFAULT NULL,
  `adresa` varchar(45) DEFAULT NULL,
  `mesto` int(11) DEFAULT NULL,
  `pin` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `idKor` int(11) NOT NULL,
  `idInt` int(11) DEFAULT NULL,
  `idVes` int(11) DEFAULT NULL,
  `idKurs` int(11) DEFAULT NULL,
  PRIMARY KEY (`idKor`),
  UNIQUE KEY `pin_UNIQUE` (`pin`),
  KEY `idSifInt_idx` (`idInt`),
  KEY `idVesStudent_idx` (`idVes`),
  KEY `idSifMesStudent_idx` (`mesto`),
  KEY `idSifDrzStudent_idx` (`drzavljanstvo`),
  KEY `idSifKursStudent_idx` (`idKurs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ime`, `srednjeIme`, `prezime`, `datum`, `pol`, `drzavljanstvo`, `telefon`, `adresa`, `mesto`, `pin`, `status`, `idKor`, `idInt`, `idVes`, `idKurs`) VALUES
('Gordan', NULL, 'Stojkovic', '0000-00-00', 'm', 1, '0631', 'da', 1, 100100, '1', 16, 1, 1, 1),
('Sanja', '', 'Sanjic', '2000-10-10', 'z', 1, '0641', 'da', 1, 100200, 'da', 23, NULL, NULL, 1),
('Zorana', '', 'Zoranic', '2001-11-11', 'z', 1, '0642', 'dada', 1, 100300, 'aha', 24, NULL, NULL, 1),
('Pera', '', 'Peric', '2000-10-10', 'm', 1, '0631', 'da', 1, 100400, 'da', 25, NULL, NULL, 2),
('Jovan', NULL, 'Jovanovic', '2000-10-11', 'm', 1, '0632', 'da', 1, 100510, 'da', 26, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `studije`
--

DROP TABLE IF EXISTS `studije`;
CREATE TABLE IF NOT EXISTS `studije` (
  `idKor` int(11) NOT NULL,
  `univerzitet` int(11) DEFAULT NULL,
  `sediste` int(11) DEFAULT NULL,
  `nivo` varchar(45) DEFAULT NULL,
  `godinaStudija` int(11) DEFAULT NULL,
  `idFak` int(11) NOT NULL,
  PRIMARY KEY (`idKor`),
  KEY `idStudijeSifUniverzitet_idx` (`univerzitet`),
  KEY `idStudijeSifGrad_idx` (`sediste`),
  KEY `fk_studije_siffakulteti1_idx` (`idFak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ucesnicidiskusije`
--

DROP TABLE IF EXISTS `ucesnicidiskusije`;
CREATE TABLE IF NOT EXISTS `ucesnicidiskusije` (
  `idKor` int(11) NOT NULL,
  `idDis` int(11) NOT NULL,
  KEY `idDisUc_idx` (`idDis`),
  KEY `idKorUc_idx` (`idKor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ucesnicidiskusije`
--

INSERT INTO `ucesnicidiskusije` (`idKor`, `idDis`) VALUES
(16, 1),
(16, 3),
(18, 2),
(23, 1),
(24, 1),
(24, 2),
(26, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

DROP TABLE IF EXISTS `vesti`;
CREATE TABLE IF NOT EXISTS `vesti` (
  `idVes` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  `tekst` varchar(45) DEFAULT NULL,
  `kategorija` int(11) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `vidljivost` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idVes`),
  KEY `idVestIdKor_idx` (`autor`),
  KEY `idVesiIdKat_idx` (`kategorija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zaposlenje`
--

DROP TABLE IF EXISTS `zaposlenje`;
CREATE TABLE IF NOT EXISTS `zaposlenje` (
  `idKor` int(11) NOT NULL,
  `kompanija` int(11) DEFAULT NULL,
  `mesto` int(11) DEFAULT NULL,
  `pozicija` int(11) DEFAULT NULL,
  `od` date DEFAULT NULL,
  `do` date DEFAULT NULL,
  PRIMARY KEY (`idKor`),
  KEY `idKorZapKompanija_idx` (`kompanija`),
  KEY `idKorZapPozicija_idx` (`pozicija`),
  KEY `idKorZapGrad_idx` (`mesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `idAdmKor` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clanovigrupe`
--
ALTER TABLE `clanovigrupe`
  ADD CONSTRAINT `fk_clanovigrupe_grupe1` FOREIGN KEY (`idGru`) REFERENCES `grupe` (`idGru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clanovigrupe_student1` FOREIGN KEY (`idKor`) REFERENCES `student` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diploma`
--
ALTER TABLE `diploma`
  ADD CONSTRAINT `fk_diploma_siffakulteti1` FOREIGN KEY (`idFak`) REFERENCES `siffakulteti` (`idFak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorDipl` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diskusija`
--
ALTER TABLE `diskusija`
  ADD CONSTRAINT `idDisidKat` FOREIGN KEY (`kategorija`) REFERENCES `sifkategorijadiskusija` (`idKatDis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idDisidKor` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imainteresovanja`
--
ALTER TABLE `imainteresovanja`
  ADD CONSTRAINT `idInt` FOREIGN KEY (`idInt`) REFERENCES `sifinteresovanja` (`idInt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKor` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imavestine`
--
ALTER TABLE `imavestine`
  ADD CONSTRAINT `idKorisnikaaaa` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idVestineeee` FOREIGN KEY (`idVes`) REFERENCES `sifvestine` (`idVes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kompanija`
--
ALTER TABLE `kompanija`
  ADD CONSTRAINT `idKorGrad` FOREIGN KEY (`sediste`) REFERENCES `sifgradovi` (`idGra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorKomp` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oglasi`
--
ALTER TABLE `oglasi`
  ADD CONSTRAINT `idAutidKor` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postdiskusija`
--
ALTER TABLE `postdiskusija`
  ADD CONSTRAINT `idDisidDis` FOREIGN KEY (`diskusija`) REFERENCES `diskusija` (`idDis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorUcesnik` FOREIGN KEY (`posiljalac`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sadrzidiskusije`
--
ALTER TABLE `sadrzidiskusije`
  ADD CONSTRAINT `idDisk` FOREIGN KEY (`idDisk`) REFERENCES `diskusija` (`idDis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idGrupe` FOREIGN KEY (`idGrupe`) REFERENCES `grupe` (`idGru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sadrziobavestenje`
--
ALTER TABLE `sadrziobavestenje`
  ADD CONSTRAINT `idGrup` FOREIGN KEY (`idGrupe`) REFERENCES `grupe` (`idGru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idObav` FOREIGN KEY (`idObav`) REFERENCES `obavestenja` (`idOba`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sadrzioglas`
--
ALTER TABLE `sadrzioglas`
  ADD CONSTRAINT `fk_sadrzioglas_grupe1` FOREIGN KEY (`idGru`) REFERENCES `grupe` (`idGru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sadrzioglas_oglasi1` FOREIGN KEY (`idOgl`) REFERENCES `oglasi` (`idOgl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sadrzivesti`
--
ALTER TABLE `sadrzivesti`
  ADD CONSTRAINT `idGrupa` FOREIGN KEY (`idGrupa`) REFERENCES `grupe` (`idGru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idVesti` FOREIGN KEY (`idVest`) REFERENCES `vesti` (`idVes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `idKorStudent` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSifDrzStudent` FOREIGN KEY (`drzavljanstvo`) REFERENCES `sifdrzavljanstvo` (`idDrz`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSifGradStudent` FOREIGN KEY (`mesto`) REFERENCES `sifgradovi` (`idGra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSifIntStudent` FOREIGN KEY (`idInt`) REFERENCES `sifinteresovanja` (`idInt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSifKursStudent` FOREIGN KEY (`idKurs`) REFERENCES `sifkurs` (`idKurs`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSifVesStudent` FOREIGN KEY (`idVes`) REFERENCES `sifvestine` (`idVes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studije`
--
ALTER TABLE `studije`
  ADD CONSTRAINT `fk_studije_siffakulteti1` FOREIGN KEY (`idFak`) REFERENCES `siffakulteti` (`idFak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idStudijeKor` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idStudijeSifGradovi` FOREIGN KEY (`sediste`) REFERENCES `sifgradovi` (`idGra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idStudijeSifUniverzitet` FOREIGN KEY (`univerzitet`) REFERENCES `sifuniverziteti` (`idUni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ucesnicidiskusije`
--
ALTER TABLE `ucesnicidiskusije`
  ADD CONSTRAINT `idDisUc` FOREIGN KEY (`idDis`) REFERENCES `postdiskusija` (`diskusija`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorUc` FOREIGN KEY (`idKor`) REFERENCES `postdiskusija` (`posiljalac`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vesti`
--
ALTER TABLE `vesti`
  ADD CONSTRAINT `idVesIdKor` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idVesiIdKat` FOREIGN KEY (`kategorija`) REFERENCES `sifkategorijavesti` (`idKatVesti`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zaposlenje`
--
ALTER TABLE `zaposlenje`
  ADD CONSTRAINT `idKorZap` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorZapGrad` FOREIGN KEY (`mesto`) REFERENCES `sifgradovi` (`idGra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorZapKomp` FOREIGN KEY (`kompanija`) REFERENCES `sifkompanija` (`idSifKo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorZapPozicija` FOREIGN KEY (`pozicija`) REFERENCES `sifpozicija` (`idPoz`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
