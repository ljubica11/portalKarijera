

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE DATABASE  IF NOT EXISTS `karijera` ;
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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idKor`, `ime`, `prezime`, `telefon`) VALUES
(1, 'Ljubica', 'Krstić', '0606705351'),
(2, 'Gordan', 'Stojkovic', '0631405971'),
(3, 'Zorana', 'Trifunović', '0648285685'),
(4, 'Saša', 'Đekić', '0638335577'),
(5, 'Sanja', 'Kordić', '0642574423');

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

--
-- Dumping data for table `clanovigrupe`
--

INSERT INTO `clanovigrupe` (`idGru`, `idKor`) VALUES
(1, 10),
(1, 13),
(1, 19),
(1, 22),
(1, 30),
(1, 33),
(2, 4),
(2, 9),
(2, 10),
(2, 20),
(2, 23),
(2, 27),
(3, 2),
(3, 5),
(3, 10),
(3, 13),
(3, 27),
(3, 30),
(3, 33),
(4, 1),
(4, 2),
(4, 3),
(4, 5),
(4, 14),
(4, 18),
(4, 21),
(4, 22),
(5, 6),
(5, 13),
(5, 19),
(6, 13),
(6, 19),
(6, 22),
(6, 27),
(7, 1),
(7, 9),
(7, 14),
(7, 21),
(7, 25),
(7, 28);

-- --------------------------------------------------------

--
-- Table structure for table `diploma`
--

DROP TABLE IF EXISTS `diploma`;
CREATE TABLE IF NOT EXISTS `diploma` (
  `idKor` int(11) NOT NULL,
  `odsek` varchar(45) DEFAULT NULL,
  `nivo` varchar(45) DEFAULT NULL,
  `godinaUpisa` int(11) DEFAULT NULL,
  `godinaZavrsetka` int(11) DEFAULT NULL,
  `zvanje` varchar(45) DEFAULT NULL,
  `idFak` int(11) NOT NULL,
  `idDipl` int(11) NOT NULL AUTO_INCREMENT,
  `vidljivost` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDipl`),
  KEY `fk_diploma_siffakulteti1_idx` (`idFak`),
  KEY `idKorDipl_idx` (`idKor`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diploma`
--

INSERT INTO `diploma` (`idKor`, `odsek`, `nivo`, `godinaUpisa`, `godinaZavrsetka`, `zvanje`, `idFak`, `idDipl`, `vidljivost`) VALUES
(1, 'Novinarstvo', 'osnovne', 2009, 2014, 'Novinar', 14, 1, NULL),
(5, 'Medjunarodne finansije', 'osnovne', 2008, 2018, 'Ekonomista', 10, 2, NULL),
(2, 'Bankarstvo', 'master', 1996, 2000, 'master ekonomista', 13, 3, NULL),
(4, 'Menadžment kvaliteta i standardizacija', 'osnovne', 2000, 2004, 'Menadžer', 8, 4, NULL),
(3, 'Bankarstvo', 'osnovne ', 2010, 2014, 'Ekonomista', 10, 5, NULL),
(6, 'Novinarstvo', 'master', 2009, 2015, 'master novinar', 14, 6, NULL),
(9, 'Opšta medicina', 'master', 2005, 2007, 'Doktor opšte medicine', 18, 7, NULL),
(14, 'Advokatura', 'osnovne', 1999, 2005, 'Advokat', 22, 8, NULL),
(18, 'Informatika', 'osnovne', 2001, 2006, 'Računarski inženjer', 16, 9, 1),
(20, 'Primenjena i likovna umetnost', 'osnovne', 2002, 2006, 'Likovni umetnik', 25, 10, NULL),
(21, 'Mašinstvo', 'master', 2007, 2012, 'Mašinski inženjer', 5, 11, NULL),
(24, 'Inženjerski menadžment', 'master', 1998, 2002, 'Menadžer', 20, 12, NULL),
(25, 'Farmacija', 'master', 2000, 2002, 'Farmaceut', 19, 13, 1),
(26, 'Unutrašnji poslovi', 'osnovne', 1995, 1999, 'Pravnik', 22, 14, NULL),
(28, 'Farmacija', 'master', 2008, 2010, 'Master farmaceut', 2, 15, NULL),
(29, 'Gluma', 'osnovne', 2005, 2009, 'Glumac', 7, 16, NULL),
(34, 'Kineski jezik', 'osnovne', 1998, 2002, 'Filolog', 6, 17, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diskusija`
--

DROP TABLE IF EXISTS `diskusija`;
CREATE TABLE IF NOT EXISTS `diskusija` (
  `idDis` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  `opis` varchar(45) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `vidljivost` varchar(45) DEFAULT NULL,
  `vidljivostKurs` int(11) DEFAULT NULL,
  `vidljivostGrupa` int(11) DEFAULT NULL,
  `zaBrisanje` varchar(45) DEFAULT NULL,
  `kategorija` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDis`),
  KEY `idDisidKor_idx` (`autor`),
  KEY `idGrupaDiskusije_idx` (`vidljivostGrupa`),
  KEY `idKursDiskusije_idx` (`vidljivostKurs`),
  KEY `idKategorijaidDiskusija_idx` (`kategorija`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diskusija`
--

INSERT INTO `diskusija` (`idDis`, `naziv`, `opis`, `datum`, `autor`, `vidljivost`, `vidljivostKurs`, `vidljivostGrupa`, `zaBrisanje`, `kategorija`) VALUES
(1, 'PHP 2019', 'Sta mislite o PHP kursu?', '2019-03-15 00:00:00', 1, 'kurs', 1, NULL, NULL, 6),
(2, 'Programerska rešenja', 'Treba vam pomoć u kodiranju, pitajte nas', '2018-07-16 00:00:00', 4, 'gost', NULL, NULL, NULL, 6),
(3, 'Strani kljucevi', 'Kako primeniti strane ključeve u MySql-u', '2019-07-16 00:00:00', 1, 'korisnici', NULL, NULL, NULL, 6),
(4, 'Engine', 'Čemu služi inno ili myisam', '2018-07-17 00:00:00', 25, 'korisnici', NULL, NULL, NULL, 6),
(5, 'Razgovor za posao', 'Kako se najbolje pripremiti?', '2019-07-21 18:44:25', 16, 'gost', NULL, NULL, NULL, 7),
(6, 'Plaćena praksa', 'Da li praksa treba da bude plaćena?', '2019-07-21 18:48:27', 34, 'grupa', NULL, 6, NULL, 7),
(7, 'Plata', 'Da li kandidati imaju nerealna očekivanja?', '2018-07-21 20:47:13', 8, 'grupa', NULL, 7, NULL, 8),
(8, 'Server', 'Koji server koristiti: WAMP ili XAMP?', '2017-07-22 00:04:14', 33, 'gost', NULL, NULL, NULL, 8),
(10, 'Pasivna nezaposlenost', 'Koliko se trudite da nađete posao?', '2019-07-23 20:44:11', 1, 'gost', NULL, NULL, 'da', 9),
(11, 'NetBeans ili Sublime?', 'Za početnike u programiranju šta je lakše?', '2019-08-07 10:53:23', 3, 'kurs', 1, NULL, NULL, 9),
(12, 'PHP programer', 'Kako postati PHP programer?', '2019-08-21 14:41:58', 16, 'korisnici', NULL, NULL, 'da', 6);

-- --------------------------------------------------------

--
-- Table structure for table `grupe`
--

DROP TABLE IF EXISTS `grupe`;
CREATE TABLE IF NOT EXISTS `grupe` (
  `idGru` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  `opis` varchar(200) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `zaBrisanje` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idGru`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupe`
--

INSERT INTO `grupe` (`idGru`, `naziv`, `opis`, `datum`, `zaBrisanje`) VALUES
(1, 'Grupa za studente ', 'Sve o studijama i studiranju u Srbiji\r\n', '2019-08-01 20:08:48', NULL),
(2, 'Java', 'Grupa namenjena Java programerima', '2019-03-18 20:08:47', NULL),
(3, 'Studenti BG', 'Grupa za studente Beogradskog Univerziteta', '2018-08-01 00:00:00', NULL),
(4, 'PHP', 'Grupa namenjena PHP programerima', '2017-04-22 00:00:00', NULL),
(5, 'Linux', 'Grupa namenjena Linux programerima', '2008-02-02 06:00:00', 'da'),
(6, 'Traženje prakse', 'Grupa namenjena studentima u potrazi za praksom.', '2016-05-06 13:00:00', NULL),
(7, 'Traženje posla', 'Grupa namenjena korisnicima sajta koji su u potrazi za poslom.', '2018-07-25 15:00:00', 'da');

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
(1, 1),
(57, 1),
(1, 2),
(2, 2),
(4, 2),
(23, 2),
(30, 2),
(4, 3),
(22, 3),
(33, 3),
(2, 4),
(3, 4),
(57, 4),
(2, 5),
(21, 5),
(22, 5),
(2, 6),
(3, 6),
(20, 6),
(13, 7),
(14, 7),
(21, 7),
(23, 7),
(30, 7),
(6, 8),
(9, 8),
(10, 9),
(26, 9),
(57, 9),
(13, 10),
(14, 10),
(2, 11),
(5, 11),
(18, 12),
(19, 12),
(28, 12),
(3, 13),
(10, 13),
(18, 13),
(24, 13),
(4, 14),
(6, 14),
(9, 14),
(25, 14),
(29, 14),
(5, 15),
(28, 15),
(34, 15),
(4, 16),
(13, 16),
(21, 16),
(6, 17),
(27, 17),
(33, 17),
(57, 17),
(25, 18),
(27, 19),
(10, 20),
(22, 20),
(24, 20),
(26, 20),
(30, 20),
(33, 20),
(5, 23),
(19, 23),
(57, 24);

-- --------------------------------------------------------

--
-- Table structure for table `imavestine`
--

DROP TABLE IF EXISTS `imavestine`;
CREATE TABLE IF NOT EXISTS `imavestine` (
  `idKor` int(11) NOT NULL,
  `idVes` int(11) NOT NULL,
  PRIMARY KEY (`idKor`,`idVes`),
  KEY `idVes_idx` (`idVes`),
  KEY `idVestine` (`idVes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imavestine`
--

INSERT INTO `imavestine` (`idKor`, `idVes`) VALUES
(1, 1),
(5, 1),
(57, 1),
(1, 2),
(30, 2),
(1, 3),
(18, 3),
(20, 3),
(27, 3),
(24, 4),
(28, 4),
(10, 5),
(21, 5),
(22, 5),
(25, 5),
(5, 6),
(13, 6),
(28, 6),
(30, 6),
(57, 6),
(10, 7),
(19, 7),
(22, 7),
(23, 7),
(24, 7),
(26, 7),
(4, 8),
(23, 8),
(25, 10),
(20, 11),
(29, 11),
(6, 12),
(9, 13),
(14, 13),
(27, 13),
(33, 14),
(9, 15),
(30, 15),
(6, 16),
(34, 16),
(3, 17),
(33, 17),
(14, 18),
(28, 18),
(14, 19),
(19, 19),
(21, 20),
(3, 21),
(14, 22),
(26, 22),
(18, 23),
(2, 24),
(29, 25),
(4, 26),
(13, 26),
(20, 26),
(6, 27),
(22, 27),
(29, 27),
(13, 28),
(34, 28),
(9, 29),
(13, 29),
(22, 29),
(23, 29),
(3, 30),
(4, 30),
(14, 30),
(5, 31),
(18, 31),
(21, 31),
(30, 31),
(57, 32),
(23, 33),
(34, 33);

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
  `opis` mediumtext,
  `oblastDelovanja` varchar(45) DEFAULT NULL,
  `brojZap` int(6) DEFAULT NULL,
  `sajt` varchar(45) DEFAULT NULL,
  `idKor` int(11) NOT NULL,
  PRIMARY KEY (`idKor`),
  UNIQUE KEY `pib_UNIQUE` (`pib`),
  UNIQUE KEY `naziv_UNIQUE` (`naziv`),
  KEY `idGraKomp_idx` (`sediste`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kompanija`
--

INSERT INTO `kompanija` (`naziv`, `sediste`, `pib`, `telefoni`, `opis`, `oblastDelovanja`, `brojZap`, `sajt`, `idKor`) VALUES
('Officecom', 1, 100067021, '0113770518', 'Uvoz i veleprodaja školskog pribora', 'Trgovina', 12, 'www.officecom.rs', 7),
('Tehnomanija', 1, 100416234, '0113713713', 'Prodaja bele tehnike i kućnih aparata', 'Trgovina', 589, 'www.tehnomanija.rs', 8),
('Semantic Bits', 2, 109509148, '0601231234', 'Dizajn i razvoj digitalnih servisa.', 'Informacione tehnologije', 47756, 'www.semanticbits.com', 11),
('Promont Group DOO', 2, 100238485, '021443195', 'Preduzeće za projektovanje, proizvodnju i montažu', 'Klimatizacija', 59, 'www.promontgroup.rs', 12),
('Banka Intesa', 1, 100001159, '0113108888', 'Pružanje bankarskih i finansijskih usluga', 'Usluge', 5858, 'www.bancaintesa.rs', 15),
('Delta Holding DOO', 1, 101681615, '0112011164', 'Grupacija firmi koje se bave proizvodnjom i prodajom hrane, uvozom i izvozom, maloprodajom, prodajom automobila i razvojem nekretnina', 'Proizvodnja, prodaja, usluge, trgovina', 7020, 'www.deltaholding.rs', 16),
('Almex DOO', 25, 100958453, '013306500', 'Poljoprivredna proizvodnja, trgovina poljoprivrednom mehanizacijom i transport', 'Poljoprivreda, trgovina, usluge, transport', 540, 'www.almex.rs', 17),
('Bigz Office Group DOO', 1, 106635732, '0113691038', 'Veleprodaja kancelarijskog materijala i poklon programa', 'Trgovina', 30, 'www.bigzoffice.rs', 31),
('Bambi', 26, 100436827, '012539800', 'Proizvodnja hrane', 'Proizvodnja', 251, 'www.bambi.rs', 32),
('Zasavica', 4, 100791674, '0222656212', 'Specijalni rezervat prirode', 'Usluge', 54, 'www.zasavica.org.rs', 35),
('Swisslion Takovo', 3, 105511020, '0112069300', 'Proizvodnja konditorskih proizvoda, dečje hrane, alkoholnih i bezalkoholnih pića,supa, testenina, sladoleda i mesnih prerađevina.', 'Proizvodnja', 899, 'www.swisslion-takovo.com', 36),
('Agro Hemik', 5, 101285056, '0143443235', 'Transport drumskim prevozom', 'Transport', 325, 'www.agro-hemik.com', 37),
('Putevi Ivanjica doo', 6, 101064157, '032664580', 'Izgradnja, rekonstrukcija i održavanje puteva', 'Građevinarstvo', 92, 'www.putevi-ivanjica.rs', 38),
('Pionir', 1, 102248114, '0113541151', 'Pionir d.o.o. - Privredno društvo za proizvodnju čokolade, bombona i peciva jedan je od vodećih proizvođača konditorskih proizvoda na jugu Evrope sa tradicijom dugom 100 godina.\r\n', 'Proizvodnja', 652, 'www.pionir.rs', 39),
('Delta Tehnik', 8, 108086497, '021871705', 'Proizvodnja auto delova i mašinskih elemenata.', 'Proizvodnja', 74, 'www.deltatehnik.rs', 40),
('Como', 9, 107100441, '035282828', 'Serijska proizvodnja nameštaja od pločastih materijala,\r\ndizajn i opremanje enterijera i proizvodnja nameštaja po narudžbini,\r\ndizajn i uređenje sajamskih postavki', 'Proizvodnja, usluge', 142, 'www.como.rs', 41),
('Vlasinac IGDA', 10, 100474568, '037444477', 'Projektovanje svih vrsta objekata. VLASINAC IGDA vrši izvođenje svih vrsta radova u građevinarstvu.', 'Građevinarstvo', 686, 'www.vlasinac.co.rs', 42),
('Nigos', 11, 100339440, '018217468', '\"NIGOS-elektronik\" je svoj proizvodni program počeo sa ispravljačkom tehnikom, da bi dalji razvoj nastavio preko brojačke i merno-regulacione tehnike, pa do najnovije oblasti projektovanja, proizvodnje i montaže automatskih sušara za drvo.', 'Proizvodnja', 50, 'www.nigos.rs', 43),
('Amiga Doo', 12, 101260634, '036399099', 'Proizvodnja stubova za javno osvetljenje: klasičnih cevnih segmentnih, dekorativnih, konusnih okruglih i konusnih poligonalnih iz jednog komada do 16m i reflektorskih\r\n   stubova iz više segmenata do 65m;\r\nο stubova za mobilnu telefoniju, mreže i dalekovode;\r\nο tramvajskih, trolejbuskih i železničkih stubova kontaktnih mreža, stubova, portala i poluportala putne i železničke signalizacije;\r\nο specifičnih čelično rešetkastih konstrukcija velikih raspona i posebnih zahteva: sportske hale, stadioni, fabričke i proizvodne hale, hladnjače, cementare,\r\n   termoelektrane i drugi objekti;\r\nο razvodnih i komandnih elektro ormana;\r\n\r\nIzgradnja:\r\nο specifičnih objekata na teško pristupačnim terenima: bazne stanice mobilne telefonije, antenski stubovi, žičare i instalacije veštačkog snega;\r\nο energetskih objekata: distributivne mreže, dalekovodi, trafo stanice, agregatska postojenja, solarne centrale;\r\nο izgradnja objekata sportske infrastrukture;\r\nο rekonstrukcija i montaža svih vrsta zahtevnih čeličnih konstrukcija: industrijske hale, krovni nosači, mostovske konstrukcije;\r\nο objekata niskogradnje i visokogradnje;\r\nο kompletnih objekata po sistemu „ključ u ruke“ ili po sistemu inženjeringa.\r\n\r\nTransport:\r\nο preko sto radnih i transportnih mašina za sve vrste radova', 'Proizvodnja, izgradnja, transport', 2302, 'www.amiga.rs', 44),
('Coja-promet', 13, 100303823, '0658084355', 'Osnovna delatnost preduzeća je poljoprivredna proizvodnja, otkup voća, povrća, prerada, dorada, pakovanje i trgovina na veliko. Naše preduzeće je snabdevač najvećih lanaca marketa u Srbiji.', 'Proizvodnja, trgovina', 48, 'www.coja-promet.com', 45),
('AD Ukras', 14, 101795144, '020385109', 'Proizvodnja betona, blokova, svih vrsta mermera i granita', 'Proizvodnja', 85, 'www.adukras.com', 46),
('Prvi Partizan', 15, 100599056, '031563086', 'Proizvodnja i trgovina oružja i municije', 'Proizvodnja, trgovina', 2353, 'www.prvipartizan.com', 47),
('SMB-gradnja', 16, 102212447, '024692160', 'Preduzeće za izvođenje građevinskih radova.', 'Građevinarstvo', 699, 'www.smb-gradnja.rs', 48),
('Elektrovolt', 17, 100068602, '014239171', 'Preduzeće \"Elektrovolt\" d.o.o. bavi se proizvodnjom elektroopreme, projektovanjem, izvođenjem elektromontažnih radova, revizijom i remontom elektropostrojenja i opreme do 110 KV, izradom elektrokomandnih ormana, visokonaponskim ispitivanjem opreme do 35 KV, merenjem i ispitivanjem u instalacijama i opremi do 35 KV.', 'Proizvodnja, usluge', 121, 'www.elektrovolt.biz', 49),
('Signal DOO', 18, 100122798, '025420470', 'Preduzeće za proizvodnju i održavanje saobraćajne signalizacije, projektovanje i inženjering, sa sedištem u Somboru.', 'Proizvodnja, usluge', 225, 'www.signal.co.rs', 50),
('Migo', 19, 100593662, '0603512858', 'Kompanija MIGO , sa sedištem u Vršcu, osnovana je 1990. godine. Spoj retro, klasičnog i futurističkog stila, dobre cene i brzina isporuke su osnovni, principi kojima se firma vodila svih ovih godina. Od svog osnivanja MIGO nastupa kao ekskluzivni zastupnik italijanske renomirane kompanije EFFEA , za teritoriju Srbije i Crne Gore nudeći proizvode od plastike za bašte i domaćinstvo. Vremenom je kompanija širila svoj asortiman, tako da danas u ponudi d.o.o. MIGA možete pronaći kompletan asortiman nameštaja za ugostiteljstvo. ', 'Proizvodnja', 562, 'www.migo.rs', 51),
('Zidar DOO', 20, 100776976, '019544090', 'U preduzeću \"Naša škola\" proizvodimo školski i kancelarijski nameštaj, fasadnu i unutrašnju\r\nstolariju, uredjujemo enterijer. Sa fabrikom \"Naša škola\" AD zaokružili smo kompletan proces\r\nizgradnje po sistemu \"KLJUČ U RUKE\".', 'Proizvodnja, usluge', 665, 'www.zidar.co.rs', 52),
('Credo', 21, 100549998, '017421139', 'Preduzeće CREDO se bavi projektovanjem, izradom i ispitivanjem niskonaponskih razvodnih ormana i niskonaponskih blokova. Možemo odgovoriti na svaki vaš zahtev u pogledu projektovanja i izrade distributivnih energetskih ormana, distributivnih blokova (trafostanice), tipski i fabrički testiranih rešenja.\r\n\r\nTakođe se bavimo projektovanjem i izradom ormana elektromotornog pogona sa implementiranim elementima automatike i kontrole.', 'Proizvodnja, usluge', 110, 'www.credo.co.rs', 53),
('MBM Rad DOO', 22, 103637007, '015892502', 'MBM RAD d.o.o.- PREDUZEĆE ZA PROJEKTOVANJE, INŽENJERING  I IZVOĐENJE GRAĐEVINSKIH RADOVA\r\n\r\n\r\nMBM RAD je porodično preduzeće smešteno u Loznici\r\n\r\nPotpuno smo osposobljeni da gradimo i gradili smo sve vrste građevinskih objekata od pešačkih i kolskih mostova,preko stambenih zgrada,proizvodnih hala do objekata od javnih značaja kao što su olimpijski bazeni za kupanje, gradski bazen, rezervoari pijaće vode, obdaništa, hotele ...', 'Građevinarstvo', 254, 'www.mbmrad.rs', 54),
('Metalac', 23, 104182281, '032770311', 'Kompanija Metalac a.d. je javno akcionarsko društvo, sa sedištem u Gornjem Milanovcu. Osnovana je 1959. a kao akcionarsko društvo posluje od 1998. godine. Danas Metalac a.d. po osnovu vlasništva u kapitalu ima 15 zavisnih društava sa kojima je povezan u Grupu: pet proizvodnih, šest trgovinskih na domaćem, četiri trgovinska društva u inostranstvu. U okviru Metalac grupe zaposleno je oko 2.000 ljudi.\r\n\r\nSva proizvodna društva nalaze se u Srbiji, u Gornjem Milanovcu, 120 kilometara od Beograda. Metalac posuđe d.o.o. je najstarije i najveće zavisno društvo koje se bavi proizvodnjom emajliranog, inox i non-stick posuđa.', 'Proizvodnja, usluge', 922, 'www.metalac.com', 55),
('Docus inormacioni sistemi', 24, 100899125, '032310050', 'Docus je kompanija koja radi na projektovanju\r\nimplementaciji i \r\nodržavanju informacionih sistema za mala i velika preduzeća.', 'Usluge', 855, 'www.docus.co.rs', 56);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `idKor` int(11) NOT NULL AUTO_INCREMENT,
  `korisnicko` varchar(45) DEFAULT NULL,
  `lozinka` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tip` varchar(11) DEFAULT NULL,
  `vidljivostEmail` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `cekaOdobrenje` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKor`),
  UNIQUE KEY `idKor_UNIQUE` (`idKor`),
  UNIQUE KEY `username_UNIQUE` (`korisnicko`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKor`, `korisnicko`, `lozinka`, `email`, `tip`, `vidljivostEmail`, `datum`, `cekaOdobrenje`) VALUES
(1, 'ljuba', '123', 'ljuba@gmail.com', 's', 1, NULL, NULL),
(2, 'gord', '123', 'gord@gmail.com', 's', NULL, NULL, NULL),
(3, 'zoka', '123', 'zoka@gmail.com', 's', NULL, NULL, NULL),
(4, 'sasa', '123', 'sasa@gmail.com', 's', NULL, NULL, NULL),
(5, 'sanja', '123', 'sanja@gmail.com', 's', 1, NULL, NULL),
(6, 'boka', 'k259*O', 'boka@gmail.com', 'a', 1, NULL, NULL),
(7, 'Officecom', 'oFFice#*12', 'nbosko@etf.bg.ac.rs', 'k', 1, NULL, NULL),
(8, 'Tehnomanija', 'e5wBZf9QkOgR0V1', 'tehnomanija@gmail.com', 'k', NULL, '1970-01-01', NULL),
(9, 'Joca', 'FClfqnXb75U8Ggd', 'jovanmiskovic@gmail.com', 's', 1, '1970-01-01', NULL),
(10, 'Ana', 'd#ana*D52', 'dimicana@gmail.com', 's', 1, NULL, NULL),
(11, 'Semantic Bits', '123', 'semanticbits@gmail.com', 'k', 1, NULL, NULL),
(12, 'promontdoo', 'proMONT#25', 'promontdoo@gmail.com', 'k', NULL, NULL, NULL),
(13, 'Mare', 'zZU7P1kMEJ5gYrd', 'mmmmaremmm225@gmail.com', 's', 1, '1970-01-01', NULL),
(14, 'Boki', 'bOOkII##21', 'boki85@gmail.com', 's', 1, NULL, NULL),
(15, 'Intesa', 'intesssssaBank999#', 'intesabank@gmail.com', 'k', NULL, NULL, NULL),
(16, 'Delta', 'Federer4ever#', 'deltacompany@gmail.com', 'k', 1, NULL, NULL),
(17, 'Almex', 'aLmEx*3*3', 'almexdoo@gmail.com', 'k', 1, NULL, NULL),
(18, 'Vanja', 'Fed4#', 'vanjabobic@gmail.com', 's', NULL, NULL, NULL),
(19, 'Marija', 'Makilina88', 'makimaki77@gmail.com', 's', NULL, NULL, NULL),
(20, 'Igor', 'IiIiIi2*2#', 'igipop78@gmail.com', 's', NULL, NULL, NULL),
(21, 'Janko125', 'Janko1#', 'janko125@gmail.com', 's', NULL, NULL, NULL),
(22, 'Nesa', 'Nele84*78', 'nesa2548@gmail.com', 's', 1, NULL, NULL),
(23, 'Misa', 'Misa4#', 'misa125086@gmail.com', 's', 1, NULL, NULL),
(24, 'Jelena', 'Fed5#', 'jelajelicic@gmail.com', 's', NULL, NULL, NULL),
(25, 'Milos', 'Km999#66', 'mrakovic@gmail.com', 's', NULL, NULL, NULL),
(26, 'Kornelije', 'Konj2#', 'kornelijus55@gmail.com', 's', NULL, NULL, NULL),
(27, 'Anjuska', 'Ljig3#', 'anjuska1@gmail.com', 's', NULL, NULL, NULL),
(28, 'milica', 'Miki2#', 'milicica@gmail.com', 's', 1, NULL, NULL),
(29, 'bane', 'BaneCar1#', 'bane87@gmail.com', 's', NULL, NULL, NULL),
(30, 'ivica', 'IvIca1#', 'ivica78@gmail.com', 's', NULL, NULL, NULL),
(31, 'bigz', 'BigzOff1#', 'bigzoffice@gmail.com', 'k', NULL, NULL, NULL),
(32, 'Bambi', 'NOva1#', 'bambi@gmail.com', 'k', NULL, NULL, NULL),
(33, 'miki', 'Maja1#', 'ljkrstic1@gmail.com', 's', NULL, NULL, NULL),
(34, 'Ljiljana', 'Nena1#', 'ljkrstic146807@gmail.com', 's', NULL, NULL, NULL),
(35, 'Zasavica', 'zasavicaca2#', 'zasavica@gmail.com', 'k', NULL, NULL, NULL),
(36, 'Swisslion', 'Swiss123#', 'swissliontakovo@gmail.com', 'k', NULL, NULL, NULL),
(37, 'Hemik', 'hemikDOO2*', 'hemikdoo@gmail.com', 'k', NULL, NULL, NULL),
(38, 'Putevi', 'PuteviIvanjica3#', 'puteviivanjica@gmail.com', 'k', NULL, NULL, NULL),
(39, 'Pionir', 'pioNIR333*', 'pionir@gmail.com', 'k', NULL, NULL, NULL),
(40, 'DeltaTehnik', 'deltaTehnik1!', 'deltatehnik@gmail.com', 'k', NULL, NULL, NULL),
(41, 'Como', 'cOmO$4', 'como@gmail.com', 'k', NULL, NULL, NULL),
(42, 'Vlasinac', 'vlasInac#8', 'vlasinacigda@gmail.com', 'k', NULL, NULL, NULL),
(43, 'Nigos', 'nIgOs##77', 'nigos@gmail.com', 'k', NULL, NULL, NULL),
(44, 'Amiga', 'amigA56*', 'amiga@gmail.com', 'k', NULL, NULL, NULL),
(45, 'Coja', 'CoJa333#', 'coja@gmail.com', 'k', NULL, NULL, NULL),
(46, 'ADUkras', 'adUKRAS@1', 'adukras@gmail.com', 'k', NULL, NULL, NULL),
(47, 'PrviPartizan', 'PrviPart123*', 'prvipartizan@gmail.com', 'k', NULL, NULL, NULL),
(48, 'SMB', 'SmB99#9', 'smb@gmail.com', 'k', NULL, NULL, NULL),
(49, 'Elektrovolt', 'elvo5^', 'elektrovolt@gmail.com', 'k', NULL, NULL, NULL),
(50, 'Signal', 'sigNAL85%', 'signal@gmail.com', 'k', NULL, NULL, 'da'),
(51, 'Migo', 'MIgo$$66', 'migo@gmail.com', 'k', NULL, NULL, 'da'),
(52, 'Zidar', 'ZIDAr#444', 'zidardoo@gmail.com', 'k', NULL, NULL, 'da'),
(53, 'Credo', 'ccccCCCC$5', 'credo@gmail.com', 'k', NULL, NULL, 'da'),
(54, 'MBM Rad', 'MBMRAD123@', 'mbmrad@gmail.com', 'k', NULL, NULL, NULL),
(55, 'Metalac', 'MeTaL888*', 'metalac@gmail.com', 'k', NULL, NULL, NULL),
(56, 'Docus', 'docusss421%', 'docus@gmail.com', 'k', NULL, NULL, NULL),
(57, 'biljana', 'Biki98#', 'biljana.biljana@gmail.com', 's', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `obavestenja`
--

DROP TABLE IF EXISTS `obavestenja`;
CREATE TABLE IF NOT EXISTS `obavestenja` (
  `idOba` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(45) DEFAULT NULL,
  `tekst` mediumtext,
  `datum` datetime DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `vidljivost` varchar(45) DEFAULT NULL,
  `vidljivostGrupa` int(11) DEFAULT NULL,
  `vidljivostKurs` int(11) DEFAULT NULL,
  `zaBrisanje` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idOba`),
  KEY `idGrupaObav_idx` (`vidljivostGrupa`),
  KEY `idKursObav_idx` (`vidljivostKurs`),
  KEY `idKorObav_idx` (`autor`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obavestenja`
--

INSERT INTO `obavestenja` (`idOba`, `naslov`, `tekst`, `datum`, `autor`, `vidljivost`, `vidljivostGrupa`, `vidljivostKurs`, `zaBrisanje`) VALUES
(1, 'Velike promene', 'Uvodimo velike promene u nase poslovanje. \r\nViše informacija na našem sajtu.', '2018-07-11 14:30:00', 36, 'gost', NULL, NULL, 'da'),
(2, 'Novi kamioni', 'Kompanija Almex je obogatila svoju mehanizaciju novim transportnim kamionima sa kompletno modernizovanom unutrašnošću. Za više infrmacija posetite naš sajt.', '2017-08-03 10:08:54', 17, 'kurs', NULL, 2, NULL),
(3, 'Novi artikli', 'Uveli smo nove artikle, posetite naš sajt.', '2019-08-19 16:08:18', 7, 'studenti', NULL, NULL, NULL),
(4, 'Novo radno mesto', 'Otvorena je pozicija za računovođu. Pogledajte oglas na našem profilu.', '2019-08-21 10:08:54', 7, 'grupa', 7, NULL, NULL),
(5, 'Novi proizvodi', 'U našem širokom asortimanu proizvoda, moramo da izdvojimo dugo najavljivani komplet Vito, za više informacija o novom proizvodu posetite naš sajt.', '2019-08-03 11:08:11', 55, 'gost', NULL, NULL, NULL),
(6, 'Nova čokolada', 'Sa zadovoljstvom Vas obaveštavamo da je Pionir uvrstio u svoju ponudu novu čokoladu. O čemu se radi pogledajte na našem sajtu.', '2019-08-03 11:08:12', 39, 'kurs', NULL, 1, NULL),
(7, 'Novo prodajno mesto', 'Sa zadovoljstvom Vas obaveštavamo da smo otvorili prvo prodajno mesto u Beogradu, ulica Bulevar Mihajla Pupina 15. Za više informacija posetite naš sajt.', '2019-08-03 11:08:13', 51, 'gost', NULL, NULL, NULL),
(8, 'Otvaranje nove firme', 'Najavljen je dolazak velike investicione grupe iz Švajcarske i otvaranje prve ekspoziture u Jugoistočnoj Evropi i to u Jagodini. Pratite vesti za više informacija.', '2019-05-29 20:08:44', 18, 'gost', NULL, NULL, NULL),
(9, 'Uskoro novi oglas', 'Poštovani, zbog angažovanja na izgradnji hotela Belmont u Kruševcu potrebna nam je nova radna snaga. Pratite oglase, uskoro će biti objavljeno koje su nam struke neophodne.', '2019-07-04 20:08:44', 42, 'grupa', 7, NULL, NULL),
(10, 'Početak PHP prekvalifikacija', 'Kolege, početak prekvalifikacija je zakazan za 17.02.2019 godine u 18h u zgradi Računarskog centra u sklopu ETF-a. Uskoro ćete dobiti obaveštenja na mejlove. ', '2019-01-26 20:08:44', 5, 'kurs', NULL, 1, NULL),
(11, 'Novi Bosch proizvodi', 'Pogledajte kompletnu ponudu Bosch-ovih proizvoda na našem sajtu.', '2019-08-21 12:08:43', 8, 'gost', NULL, NULL, NULL),
(12, 'Otvoreno radno mesto', 'Tražimo junior JAVA programera. Više informacija možete naći na našem sajtu: www.semanticbits.com', '2019-08-21 13:08:14', 11, 'kurs', NULL, 2, NULL),
(13, 'Nova pozicija', 'Tražimo kreditnog analitičara. Više informacija na našem sajtu ili profilu.', '2019-08-21 14:08:25', 15, 'grupa', 7, NULL, NULL),
(14, 'Poklon program', 'Sa zadovoljstvom možemo da Vas obavestimo da smo uveli nove artikle u našu ponudu poklon progama. Tu su razne torbe, ogledala, novčanici i još mnogo drugih proizvoda koje možete naći kod nas. Posetite naš sajt za više informacija: www.bigzoffice.rs', '2019-08-22 14:08:15', 31, 'gost', NULL, NULL, 'da'),
(15, 'Orao belorepan', 'Dobili smo novog člana našeg društva od srede 21.08.2019. godine. To je Orao belorepan, jedna do najređih i najugroženijih vrsta u Evropi, a sada se možemo pohvaliti da je ima i kod nas. Posetite nas i uživajte u njegovom posmatranju.', '2019-08-22 14:08:34', 35, 'gost', NULL, NULL, NULL),
(16, 'Put Kraljevo-Ivanjica', 'Poštovani, pušten je u promet rekonstruisani put između Kraljeva i Ivanjice, završeni su kompletni radovi. Srećan put Vam žele Putevi-Ivanjica...', '2019-08-22 14:08:44', 38, 'korisnici', NULL, NULL, NULL),
(17, 'Dekorativno osvetljenje', 'Sa zadovoljstvom Vas obaveštavamo da je postavljeno dekorativno osvetljenje na glavnom trgu u Kraljevu. Posetite nas i uverite se u stručnost naših radnika.', '2019-08-22 15:08:33', 44, 'studenti', NULL, NULL, 'da'),
(18, 'Nova signalizacija', 'Postavljena je nova signalizacija na autoputu Novi Sad-Sombor.Srećan put.', '2019-08-22 15:08:45', 50, 'gost', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oglasi`
--

DROP TABLE IF EXISTS `oglasi`;
CREATE TABLE IF NOT EXISTS `oglasi` (
  `idOgl` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opis` mediumtext COLLATE utf8_unicode_ci,
  `vremePostavljanja` datetime DEFAULT NULL,
  `vremeIsticanja` date DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `vidljivost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uslovi` mediumtext COLLATE utf8_unicode_ci,
  `ponuda` mediumtext COLLATE utf8_unicode_ci,
  `obaveze` mediumtext COLLATE utf8_unicode_ci,
  `plata` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nacinPlacanja` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mesto` int(11) DEFAULT NULL,
  `pozicija` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zaBrisanje` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vidljivostKurs` int(11) DEFAULT NULL,
  `vidljivostGrupa` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOgl`),
  KEY `idAutidKor_idx` (`autor`),
  KEY `idGraOglasi_idx` (`mesto`),
  KEY `idKursOglasi_idx` (`vidljivostKurs`),
  KEY `idGrupaOglasi_idx` (`vidljivostGrupa`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oglasi`
--

INSERT INTO `oglasi` (`idOgl`, `naslov`, `opis`, `vremePostavljanja`, `vremeIsticanja`, `autor`, `vidljivost`, `uslovi`, `ponuda`, `obaveze`, `plata`, `nacinPlacanja`, `mesto`, `pozicija`, `zaBrisanje`, `vidljivostKurs`, `vidljivostGrupa`) VALUES
(1, 'Junior PHP programer', 'Trazimo junior programera za nasu kompaniju. Minimum iskustva od 2 godine. Pružamo stimulativnu zaradu, kao i mogućnost stručnog usavršavanja i daljeg napredovanja u poslu.', '2018-07-11 14:30:00', '2018-08-11', 11, 'kurs', 'Završen Elektrotehnički fakultet;Minimum 2 godine iskustva u programiranju;Iskustvo u radu sa bazama podataka', 'Stimulativna plata;Mogućnost dodatnih nagrada po učinku;Mogućnost napredovanja;Mogućnost profesionalnog i stručnog usavršavanja', 'OBAVEZNO ODLIČNO POZNAVANJE MySQL BAZA PODATAKA; NEOPHODNA IZUZETNA BRZINA RADA I POPRAVLJANJA EVENTUALNIH PROPUSTA I BAGOVA; MOGUĆI RAZLIČITI OBLICI SARADNJE: RAD PO PROJEKTU, POVREMENO ANGAŽOVANJE, STALNI ANGAŽMAN NA ADMINISTRACIJI I UNAPREĐENJU SAJT(OV)A.', NULL, NULL, 1, 'PHP junior programer', 'da', 1, NULL),
(2, 'Referent komercijale', 'Potreban nam je komercijalni referent za prodaju i rad sa klijentima.', '2018-07-12 14:30:00', '2018-08-12', 7, 'grupa', 'Obrazovanje minimum SSS;Minimum 3 godine iskustva u poslovima vezanim za spoljnu trgovinu;Poznavanje rada na računaru (MS Office paket);Poznavanje engleskog jezika;Vozačka dozvola B kategorije;Visok nivo komunikativnosti, organizovanosti, odgovornosti i produktivnosti.', 'Posao u firmi koja ima tendenciju rasta;Optimalne uslove za rad;Isplatu ostvarenih primanja u dogovoreno vreme; Zaradu prema ostvarenim rezultatima.', 'Praćenje i kontrolisanje nabavke iz uvoza;Praćenje stanja lagera u redovnim i carinskim magacinima;Davanje naloga špediteru za carinjenje i praćenje realizacije;Kontakti i komunikacija sa zaposlenim u magacinu;Pracenje eventualnih reklamacija kod isporučilaca i kupaca;Praćenje komercijalnih i marketinških aktivnosti preduzeća;  Razvijanje dobrih poslovnih odnosa sa kupcima i poslovnim partnerima;  Primenjivanje uslova i politike nastupa na tržištu u skladu sa procedurama preduzeća;  Aktivno ucestvuje u analizi tržišta i tržišnih trendova i cena;  Izrada i analiza dnevnih, mesečnih i godišnjih izveštaja prodaje;  Učestvovanje u formiranju strategije uvođenja i razvoja novih prozivoda.', '50000', 'mesecno', 1, 'Komercijalni referent', 'da', NULL, 1),
(3, 'Električar', 'Tražimo električara-elektromontera sa iskustvom.', '2019-07-12 14:30:00', '2019-09-12', 49, 'korisnici', 'SSS, KV ili VKV u elektro struci\r ;Godinu dana radnog iskustva na elektrodistributivnoj mreži, podzemnoj i nadzemnoj, distributivnim trafo stanicama, izradi kućnih priključaka', 'Redovna i dobra primanja\r; Potpuna zdravstvena i socijalna zaštita', 'Obavezan je da se stara o mestu rada, kao i da pri radu koristi predviđena zaštitna sredstva\r\n', NULL, NULL, 17, 'Električar', NULL, NULL, NULL),
(4, 'Administrativni radnik', 'Tražimo administrativnog radnika.', '2019-07-12 14:30:00', '2019-10-12', 46, 'korisnici', 'Poželjno radno iskustvo na istim ili sličnim poslovima;\r  Odlično poznavanje MS Office (Excel);\r  Matematičko razmišljanje;\r  Analitičke sposobnosti', 'Odlične uslove za rad;\r Stalno usavršavanje i napredovanje;\r Početnu platu od 40.000 rsd;\r Bonuse', 'Unos podataka u tabele;  Kontrola potrošnje robe i troškova;  Komuniciranje sa dobavljačima;  Analiza poslovanja;  Kontrola video nadzora;', '40000', 'mesecno', 14, 'Administrativni radnik', NULL, NULL, NULL),
(5, 'Električar', 'tražimo električara-instalatera.', '2019-07-27 11:01:16', '2019-07-31', 49, 'korisnici', 'Poželjno iskustvo u radu;\n Minimum srednja stručna sprema;\n Vozačka dozvola B kategorije – aktivan vozač (obavezno);\n Potvrda da lice nije osuđivano i da krivični postupak nije u toku', 'Profesionalni razvoj, obuke, treninge;\r Stalno zaposlenje', 'Izvođenje radova na instalacijama niske struje i montaži sigurnosnih sistema (video nadzor, alarm, računarske mreže, dojava požara, kontrola pristupa);Vođenje evidencije radnih naloga i ostale prateće dokumentacije', NULL, NULL, 17, 'Električar', 'da', NULL, NULL),
(6, 'Kreditni analitičar', 'Tražimo kreditnog analitičara za rad sa privredom.', '2019-07-30 00:00:00', '2019-09-30', 15, 'grupa', 'Minimum dve godine iskustva u bankarskom sektoru na traženoj poziciji;\n Visoka stručna sprema iz oblasti ekonomije;\n Napredno znanje engleskog jezika;\n Poznavanje MS Office paketa (posebno MS Excel)', 'Stimulativna zarada;\r Mogućnost napredovanja', 'Ocena boniteta i kreditne sposobnosti klijenata privrede;  Izrada kreditne analize klijenata prema usvojenim procedurama, uputstvima i limitima;  Prikupljanje i provera svih potrebnih podataka i informacija u kreditnom procesu o klijentima;  Horizontalna, vertikalna i uporedna analiza finansijskog stanja;  Pokazatelji finansijske strukture i racio analiza;  Analiza otplatnog kapaciteta i tokova gotovine;  Procena biznis planova i poslovnih projekcija;  Ocena boniteta i analiza grupa povezanih lica;  Davanje mišljenja o finansijskom stanju klijenta; Provera klasifikacije klijenata i pojedinačnih potraživanja na nivou klijenta u skladu sa procedurama Banke i propisima NBS', NULL, NULL, 1, 'Kreditni analitičar', 'da', NULL, 2),
(7, 'Montažer-vozač', 'Tražimo vozača-montažera za našu kompaniju.', '2019-07-30 10:35:47', '2019-11-20', 41, 'gost', 'Stručna sprema: SSS;\r  Iskustvo u radu na poslovima montaže nameštaja;\r  Vozačka dozvola B kategorije', 'Redovna plata, socijalno i zdravstveno osiguranje, stimulativna zarada', 'Vrši utovar i istovar proizvoda i odgovara za eventaualno oštećenje robe;  Odgovoran je i stara se o tehničkoj ispravnosti vozila;  Odgovoran je i obavezno sprovodi mere i primenjuje zakonske propise iz bezbednosti o saobraćaju;  Vrši montažu proizvoda za potrebe kupaca po nalogu;  Vrši montažu i demontažu proizvoda za potrebe maloprodaje u salonu;  Planira potrebna sredstva za rad i dostavlja zahtev za nabavku;  Vrši prevoz kupcima po nalogu na odredište;  Kontroliše ispravnost vozila', '47.000 - 50.000', 'mesecno', 9, 'Montažer', 'da', NULL, NULL),
(8, 'Računovođa', 'SSS/VS/VSS – ekonomskog smera\r\nKnjiženje svih poslovnih promena u preduzeću (ulazne i izlazne dokumentacije, lizinga, kredita i osiguranja)\r\nPriprema za obračun zarada, blagajne i putnih naloga\r\nIskustvo u računovodstvu\r\nPoznavanje poreskih propisa\r\nRad u MS Office paketa', '2019-08-21 10:41:21', '2019-12-03', 7, 'korisnici', 'Najmanje 5 godina radnog iskustva u računovodstvu', 'Rad u prijatnom ambijentu i odličnim uslovima; Redovna isplata zarade', 'Knjiženje svih poslovnih promena u preduzeću (ulazne i izlazne dokumentacije, lizinga, kredita i osiguranja); Priprema za obračun zarada, blagajne i putnih naloga', '60000 - 70000', 'mesecno', 1, 'Računovođa', NULL, NULL, NULL),
(9, 'PHP programer', 'Kandidat će raditi na razvoju internih i internet aplikacija u oblasti trgovine...\r\nIntegracija novih i modifikacija postojećih rešenja u integrisani informacioni sistem', '2019-08-21 12:50:27', '2019-09-28', 8, 'gost', 'Solidno poznavanje PHP programskog jezika (PHP5/PHP7); Rad sa relacionim bazama podataka (SQL); JavaScript (AJAX, jQuery)/HTML/CSS; Poznavanje različitih programskih paradigmi (funkcionalno, objektno-orijentisano programiranje...); Visoko obrazovanje i stepena (Bachelor – osnovne akademske ili strukovne studije) informacionih/računarskih tehnologija; Znanje engleskog jezika (pisanje, čitanje, komunikacija)', 'Stabilno radno okruženje; Mogućnost usavršavanja i napredovanja u oblasti informacionih tehnologija i osiguranja; Prijatno radno okruženje, timski i individialni rad; Rad sa aktuelnim tehnologijama u oblasti web razvoja softvera', 'Kreiranje kvalitetnog (i urednog) programskog koda i projektne dokumentacije, poštovanjem dogovorenih konvencija i usvojenih politika; Predanost u radu, sposobnost da se zadaci završavaju i to u predviđenim rokovima; Želja za učenjem i daljim usavršavanjem, praćenje najnovijih trendova u oblasti web programiranja; Sposobnost da se sagledaju i apstrahuju poslovni procesi; Redovnost i preciznost u komunikaciji', '50000 - 70000', 'mesecno', 1, 'PHP junior programer', NULL, NULL, NULL),
(10, 'Junior JAVA programer', 'zuzetni radni uslovi uključuju:\r\nJedinstvenu priliku da se nauči pravi profesionalni Enterprise Software Development\r\nPozitivnu i opuštenu \'startup atmosferu\'\r\nOdličnu lokaciju kancelarije\r\nModernu opremu\r\nIzuzetnu radnu sredinu i kancelariju\r\nDodatne sadržaje\r\nRad od kuće: Ne\r\nU obzir dolaze i studenti sa malim brojem preostalih ispita/diplomskim kao i studentske prakse.\r\nPlata: Zavisna od iskustva i sposobnosti, atraktivna', '2019-08-21 13:18:17', '2019-10-10', 11, 'kurs', 'Design patterni Spring/IOC; Dubinsko razumevanje struktura podataka; Exposure enterprise software development; HTML/CSS Angular, React, Javascript, Jquery, Bootstrap MongoDB, DynamoDB, MSSQL, Postgresql, MySQL Amazon tehnologije (SQS, S3, Lambda, ECS, SNS, DynamoDB, Route53, ELB, ALB, Sparkle, Codedeploy etc) Redis|Memcached Nodejs, Ruby, Python Git|SVN Linux IntelliJ IDEA; Što viši nivo engleskog jezika', 'Jedinstvenu priliku da se nauči pravi profesionalni Enterprise Software Development; Pozitivnu i opuštenu \'startup atmosferu\'; Odličnu lokaciju kancelarije; Modernu opremu; Izuzetnu radnu sredinu i kancelariju; Dodatne sadržaje ', 'Osnove Jave; Osnovni koncepti OO programiranja; Potpuno razumevanje i poznavanje programiranja kao i struktura podataka; Osnova engleskog jezika', '50000 - 80000', 'mesecno', 2, 'Junior Java programer', NULL, 2, NULL),
(12, 'Elektroinženjer', 'Izrada projekata, ponuda, razrada tehničke dokumentacije,\r\nVođenje gradilišta kao i kompletne gradilišne dokumentacije,\r\nSaradnja sa investitorima u realizaciji projekata,\r\nKontrola kvaliteta pri izvođenju radova,\r\n', '2019-08-22 12:51:02', '2019-08-31', 12, 'studenti', 'Diploma elektrotehničkog fakulteta, energetski odsek; Rad na računaru – MS Office, AutoCAD; Aktivno znanje engleskog jezika; Samostalnost u izvršenju zadataka; Spremnost za rad pod pritiskom; Posedovanje vozačke dozvole B kategorije.', 'Redovna plata;Mogućnost stručnog usavršavanja', 'Izrada projekata, ponuda, razrada tehničke dokumentacije; Vođenje gradilišta kao i kompletne gradilišne dokumentacije; Saradnja sa investitorima u realizaciji projekata; Kontrola kvaliteta pri izvođenju radova; Prati radove svojih podizvođača, kooperanata, dobavljača i isporučioca opreme.', '', 'mesecno', 2, 'Elektroinženjer', NULL, NULL, NULL),
(13, 'Izvršni direktor', 'Sastavljanje kratkoročnih i dugoročnih planova\r\nRaspoređivanje zaduženja\r\nKoordiniranje izvršenja zadataka\r\nPraćenje kretanja na tržištu, razvoja tehnologije\r\nPraćenje kretanja konkurentskih preduzeća iste ili srodne delatnosti\r\nPraćenje razvoja sredstava za rad i drugih faktora koji mogu uticati na razvoj preduzeća\r\nKontrola rezultata rada', '2019-08-22 13:37:55', '2019-09-28', 16, 'korisnici', 'Visoka stručna sprema i višegodišnje iskustvo; Položeni stručni ispiti; Organizacione, liderske i analitičke veštine; Sposobnost komunikacije; Sposobnost planiranja; Sposobnost za multitasking; Znanje engleskog jezika i rada na računaru', 'Stimulativna zarada uz fiksni deo plate;Stručni seminari;Poslovna putovanja uz određene beneficije', 'Sastavljanje kratkoročnih i dugoročnih planova; Raspoređivanje zaduženja; Koordiniranje izvršenja zadataka; Praćenje kretanja na tržištu, razvoja tehnologije; Praćenje kretanja konkurentskih preduzeća iste ili srodne delatnosti; Praćenje razvoja sredstava za rad i drugih faktora koji mogu uticati na razvoj preduzeća; Kontrola rezultata rada', '', 'mesecno', 1, 'Izvršni direktor transportnog sektora', NULL, NULL, NULL),
(14, 'Produkt menadžer', 'Pružanje stručne asistencije i adekvatnih rešenja postojećim i/ili budućim korisnicima\r\nPraćenje, identifikovanje i prijavljivanje problema sa terena servisu', '2019-06-22 14:20:39', '2019-08-03', 32, 'grupa', 'VII stepen stručne spreme, farmaceut-medicinski biohemičar; Radno iskustvo: minimum 1 godina (završen pripravnički staž); Obavezno poznavanje engleskog jezika; Poželjno poznavanje nemačkog jezika; Rad na računaru (MS Office paket); Vozačka dozvola B kategorije, aktivan vozač', 'Konkurentan kompenzacioni paket uz priliku za ostvarivanje bonusa ; Kontinuiranu stručnu obuku u Srbiji i inostranstvu; Rad na terenu u dinamičnom okruženju', 'Održavanje kontakata i obilazak korisnika po definisanom planu i nalogu sektora; Prezentovanje performansi i prednosti aparata, reagenasa i testova korisnicima; Obučavanje korisnika za rad na aparatima i aplikacijama testova; Pružanje stručne asistencije i adekvatnih rešenja postojećim i/ili budućim korisnicima', '50000 - 60000', 'mesecno', 26, 'Produkt menadžer', NULL, NULL, 1),
(15, 'Pomoćni radnik', 'Obavlja poslove pripremanja sirovina za kuvanje jela\r\nVodi računa o ispravnosti i roku trajanja namirnica', '2019-08-22 14:30:25', '2019-09-30', 36, 'gost', 'Osnovno ili srednje obrazovanje; Nije potrebno prethodno iskustvo; Urednost, marljivost, odgovornost; Precizan i brz rad; Održavanje higijene na zavidnom nivou', 'Mogućnost zaposlenja za stalno; Prijava na zdravstveno i socijalno osiguranje od prvog dana rada; Mogućnost učenja i napredovanja; Mogućnost dogovora sa poslodavcem o svim bitnim pojedinostima', 'Obavlja poslove pripremanja sirovina za kuvanje jela; Vodi računa o ispravnosti i roku trajanja namirnica; Zadužen je za korišćenje sredstava higijenske zaštite; Održava higijenu  kuhinje i pomoćnih kuhinjskih prostorija uz vođenje evidencije o čišćenju; Održavanje čistih i urednih radnih površina u svakom trenutku; Obavlja i druge poslove po nalogu Šefa kuhinje ili zamenika Šefa kuhinje i Kuvaru kojima pripada', '30000 - 40000', 'mesecno', 3, 'Pomoćni radnik u kuhinji', NULL, NULL, NULL),
(16, 'Operater', 'Pružanje stručne pomoći korisnicima telefonskim putem, e-mailom ili drugim oblicima komunikacije\r\nOrganizovanje usluga na zahtev korisnika\r\nAdministriranje zahteva\r\nKontrola i verifikacija pokrivenosti potrebne usluge saglasno polisama osiguranja ', '2019-08-22 14:40:30', '2019-03-09', 37, 'studenti', 'Služite se engleskim jezikom (konverzacijski nivo) ;Spremni za rad pod pritiskom i brzo odlučivanje; Ambiciozni i motivisani da učite i postižete izvanredne rezultate; Otvoreni za izazove, uvek spremni da napravite korak napred; Fleksibilni u novom okruženju i prihvatanju i primeni novih metodologija i tehnologija rada; Društveni, komunikativni, vedrog duha, sa pozitivnim stavom prema kolegama i klijentima; Imate minimum IV stepen stručne spreme ;Aktivno koristite računar (MS Windows, MS Office, internet)', 'Stimulativna zarada uz fiksni deo plate;Redovna plata', 'Pružanje stručne pomoći korisnicima telefonskim putem, e-mailom ili drugim oblicima komunikacije; Organizovanje usluga na zahtev korisnika; Administriranje zahteva ;Kontrola i verifikacija pokrivenosti potrebne usluge saglasno polisama osiguranja', '', 'mesecno', 5, 'Call operater', NULL, NULL, NULL),
(17, 'Mašinski inženjer', 'Projektovanje instalacija i nadzor nad izvođenjem radova\r\nIzrada ponuda za opremu i usluge iz asortimana preduzeća  \r\nKomunikacija sa dobavljačima, podizvođačima i klijentima uz unapređenje odnosa sa postojećim klijentima ', '2019-08-22 14:51:28', '2019-09-14', 40, 'grupa', 'VSS - mašinski fakultet - smer termotehnika; Sa licencama za projektovanje i izvođenje; Sa radnim iskustvom ;Organizovanost i pedantnost, analitičnost, sistematičnost i odgovornost; Znanje engleskog jezika obavezno; Znanje AutoCAD, MS Office paket (Word, Excel, Outlook, Powerpoint), Windows, internet; Da niste krivično kažnjavani i da niste pod istragom', 'Stalni radni odnos; Dinamičnu, kvalitetnu i kreativnu radnu atmosferu; Mogućnost stručnog usavršavanja i napretka; Praćenje svetskih trendova u tehnologijama i pristupu organizaciji rada', 'Projektovanje instalacija i nadzor nad izvođenjem radova; Izrada ponuda za opremu i usluge iz asortimana preduzeća;   Komunikacija sa dobavljačima, podizvođačima i klijentima uz unapređenje odnosa sa postojećim klijentima', '', 'mesecno', 8, 'Mašinski inženjer', NULL, NULL, 3),
(18, 'Mašinski inženjer', 'Projektovanje instalacija i nadzor nad izvođenjem radova\r\nIzrada ponuda za opremu i usluge iz asortimana preduzeća  \r\nKomunikacija sa dobavljačima, podizvođačima i klijentima uz unapređenje odnosa sa postojećim klijentima ', '2019-07-22 14:51:28', '2019-09-10', 43, 'studenti', 'VSS - mašinski fakultet - smer termotehnika; Sa licencama za projektovanje i izvođenje; Sa radnim iskustvom; Organizovanost i pedantnost, analitičnost, sistematičnost i odgovornost; Znanje engleskog jezika obavezno ;Znanje AutoCAD, MS Office paket (Word, Excel, Outlook, Powerpoint), Windows, internet; Da niste krivično kažnjavani i da niste pod istragom', 'Stalni radni odnos; Dinamičnu, kvalitetnu i kreativnu radnu atmosferu; Mogućnost stručnog usavršavanja i napretka; Praćenje svetskih trendova u tehnologijama i pristupu organizaciji rada', 'Projektovanje instalacija i nadzor nad izvođenjem radova; Izrada ponuda za opremu i usluge iz asortimana preduzeća;   Komunikacija sa dobavljačima, podizvođačima i klijentima uz unapređenje odnosa sa postojećim klijentima', '', 'mesecno', 11, 'Mašinski inženjer', NULL, NULL, NULL),
(19, 'Pomoćni radnik', 'Obavlja poslove pakovanja\r\nVodi računa o ispravnosti i roku trajanja namirnica', '2019-04-22 14:30:25', '2019-09-15', 45, 'gost', 'Osnovno ili srednje obrazovanje; Nije potrebno prethodno iskustvo; Urednost, marljivost, odgovornost; Precizan i brz rad; Održavanje higijene na zavidnom nivou', 'Mogućnost zaposlenja za stalno; Prijava na zdravstveno i socijalno osiguranje od prvog dana rada; Mogućnost učenja i napredovanja; Mogućnost dogovora sa poslodavcem o svim bitnim pojedinostima', 'Obavlja poslove pripremanja sirovina; Obavlja i druge poslove po nalogu nadležnog.', '30000 - 40000', 'mesecno', 13, 'Pomoćni radnik ', NULL, NULL, NULL),
(20, 'Junior programer', 'zuzetni radni uslovi uključuju:\r\nJedinstvenu priliku da se nauči pravi profesionalni Enterprise Software Development\r\nPozitivnu i opuštenu \'startup atmosferu\'\r\nOdličnu lokaciju kancelarije\r\nModernu opremu\r\nIzuzetnu radnu sredinu i kancelariju\r\nDodatne sadržaje\r\nRad od kuće: Ne\r\nU obzir dolaze i studenti sa malim brojem preostalih ispita/diplomskim kao i studentske prakse.\r\nPlata: Zavisna od iskustva i sposobnosti, atraktivna', '2019-05-21 13:18:17', '2019-10-05', 47, 'kurs', 'linux,Design patterni; Spring/IOC; Dubinsko razumevanje struktura podataka; Exposure enterprise software development; HTML/CSS Angular, React, Javascript, Jquery, Bootstrap MongoDB, DynamoDB, MSSQL, Postgresql, MySQL Amazon tehnologije (SQS, S3, Lambda, ECS, SNS, DynamoDB, Route53, ELB, ALB, Sparkle, Codedeploy etc) Redis|Memcached Nodejs, Ruby, Python Git|SVN Linux IntelliJ IDEA; Što viši nivo engleskog jezika', 'Jedinstvenu priliku da se nauči pravi profesionalni Enterprise Software Development; Pozitivnu i opuštenu \'startup atmosferu\'; Odličnu lokaciju kancelarije; Modernu opremu; Izuzetnu radnu sredinu i kancelariju; Dodatne sadržaje ', 'Neophodno znanje: Osnove Linuxa; Osnovni koncepti OO programiranja; Potpuno razumevanje i poznavanje programiranja kao i struktura podataka; Osnova engleskog jezika', '50000 - 80000', 'mesecno', 15, 'Junior programer', NULL, 3, NULL),
(21, 'Inženjer', 'Izrada projekata, ponuda, razrada tehničke dokumentacije,\r\nVođenje gradilišta kao i kompletne gradilišne dokumentacije,\r\nSaradnja sa investitorima u realizaciji projekata,\r\nKontrola kvaliteta pri izvođenju radova,\r\n', '2019-08-22 12:51:02', '2019-08-31', 48, 'grupa', 'Diploma elektrotehničkog fakulteta, energetski odsek; Rad na računaru – MS Office; AutoCAD; Aktivno znanje engleskog jezika; Samostalnost u izvršenju zadataka; Spremnost za rad pod pritiskom; Posedovanje vozačke dozvole B kategorije.', 'Redovna plata;Mogućnost stručnog usavršavanja', 'Izrada projekata, ponuda, razrada tehničke dokumentacije; Vođenje gradilišta kao i kompletne gradilišne dokumentacije; Saradnja sa investitorima u realizaciji projekata; Kontrola kvaliteta pri izvođenju radova; Prati radove svojih podizvođača, kooperanata, dobavljača i isporučioca opreme.', '', 'mesecno', 16, 'Elektroinženjer', NULL, NULL, 2),
(22, 'Građevinski inženjer', 'Izrada projekata, ponuda, razrada tehničke dokumentacije,\r\nVođenje gradilišta kao i kompletne gradilišne dokumentacije,\r\nSaradnja sa investitorima u realizaciji projekata,\r\nKontrola kvaliteta pri izvođenju radova,\r\n', '2019-03-22 12:51:02', '2019-04-30', 52, 'studenti', 'Diploma mašinskog fakulteta,;Rad na računaru – MS Office; AutoCAD; Aktivno znanje engleskog jezika; Samostalnost u izvršenju zadataka; Spremnost za rad pod pritiskom; Posedovanje vozačke dozvole B kategorije.', 'Redovna plata;Mogućnost stručnog usavršavanja', 'Izrada projekata, ponuda, razrada tehničke dokumentacije; Vođenje gradilišta kao i kompletne gradilišne dokumentacije; Saradnja sa investitorima u realizaciji projekata; Kontrola kvaliteta pri izvođenju radova; Prati radove svojih podizvođača, kooperanata, dobavljača i isporučioca opreme.', '', 'mesecno', 20, 'Mašinski inženjer', NULL, NULL, NULL),
(23, 'Junior PHP programer', 'zuzetni radni uslovi uključuju:\r\nJedinstvenu priliku da se nauči pravi profesionalni Enterprise Software Development\r\nPozitivnu i opuštenu \'startup atmosferu\'\r\nOdličnu lokaciju kancelarije\r\nModernu opremu\r\nIzuzetnu radnu sredinu i kancelariju\r\nDodatne sadržaje\r\nRad od kuće: Ne\r\nU obzir dolaze i studenti sa malim brojem preostalih ispita/diplomskim kao i studentske prakse.\r\nPlata: Zavisna od iskustva i sposobnosti, atraktivna', '2019-06-21 13:18:17', '2019-10-21', 53, 'kurs', 'Design patterni ;Spring/IOC; Dubinsko razumevanje struktura podataka; Exposure enterprise software development; HTML/CSS Angular, React, Javascript, Jquery, Bootstrap MongoDB, DynamoDB, MSSQL, Postgresql, MySQL Amazon tehnologije (SQS, S3, Lambda, ECS, SNS, DynamoDB, Route53, ELB, ALB, Sparkle, Codedeploy etc) Redis|Memcached Nodejs, Ruby, Python Git|SVN Linux IntelliJ IDEA; Što viši nivo engleskog jezika', 'Jedinstvenu priliku da se nauči pravi profesionalni Enterprise Software Development; Pozitivnu i opuštenu \'startup atmosferu\'; Odličnu lokaciju kancelarije; Modernu opremu; Izuzetnu radnu sredinu i kancelariju; Dodatne sadržaje ', 'Neophodno znanje: Osnove PHP; Osnovni koncepti OO programiranja; Potpuno razumevanje i poznavanje programiranja kao i struktura podataka; Osnova engleskog jezika', '50000 - 80000', 'mesecno', 21, 'Junior programer', NULL, 1, NULL),
(24, 'Mašinski inženjer', 'Projektovanje instalacija i nadzor nad izvođenjem radova\r\nIzrada ponuda za opremu i usluge iz asortimana preduzeća  \r\nKomunikacija sa dobavljačima, podizvođačima i klijentima uz unapređenje odnosa sa postojećim klijentima ', '2019-07-22 14:51:28', '2019-09-01', 54, 'studenti', 'VSS - mašinski fakultet - smer termotehnika; Sa licencama za projektovanje i izvođenje; Sa radnim iskustvom; Organizovanost i pedantnost, analitičnost, sistematičnost i odgovornost; Znanje engleskog jezika obavezno; Znanje AutoCAD, MS Office paket (Word, Excel, Outlook, Powerpoint), Windows, internet; Da niste krivično kažnjavani i da niste pod istragom', 'Stalni radni odnos; Dinamičnu, kvalitetnu i kreativnu radnu atmosferu; Mogućnost stručnog usavršavanja i napretka; Praćenje svetskih trendova u tehnologijama i pristupu organizaciji rada', 'Projektovanje instalacija i nadzor nad izvođenjem radova; Izrada ponuda za opremu i usluge iz asortimana preduzeća;   Komunikacija sa dobavljačima, podizvođačima i klijentima uz unapređenje odnosa sa postojećim klijentima', '', 'mesecno', 22, 'Mašinski inženjer', NULL, NULL, NULL),
(25, 'Junior JAVA programer', 'Izuzetni radni uslovi uključuju:\r\nJedinstvenu priliku da se nauči pravi profesionalni Enterprise Software Development\r\nPozitivnu i opuštenu \'startup atmosferu\'\r\nOdličnu lokaciju kancelarije\r\nModernu opremu\r\nIzuzetnu radnu sredinu i kancelariju\r\nDodatne sadržaje\r\nRad od kuće: Ne\r\nU obzir dolaze i studenti sa malim brojem preostalih ispita/diplomskim kao i studentske prakse.\r\nPlata: Zavisna od iskustva i sposobnosti, atraktivna', '2019-07-07 13:18:17', '2019-10-07', 56, 'kurs', 'Design patterni Spring/IOC; Dubinsko razumevanje struktura podataka; Exposure enterprise software development; HTML/CSS Angular, React, Javascript, Jquery, Bootstrap MongoDB, DynamoDB, MSSQL, Postgresql, MySQL Amazon tehnologije (SQS, S3, Lambda, ECS, SNS, DynamoDB, Route53, ELB, ALB, Sparkle, Codedeploy etc) Redis|Memcached Nodejs, Ruby, Python Git|SVN Linux IntelliJ IDEA; Što viši nivo engleskog jezika', 'Jedinstvenu priliku da se nauči pravi profesionalni Enterprise Software Development; Pozitivnu i opuštenu \'startup atmosferu\'; Odličnu lokaciju kancelarije; Modernu opremu; Izuzetnu radnu sredinu i kancelariju; Dodatne sadržaje ', 'Neophodno znanje: Osnove Jave; Osnovni koncepti OO programiranja; Potpuno razumevanje i poznavanje programiranja kao i struktura podataka; Osnova engleskog jezika', '50000 - 80000', 'mesecno', 24, 'Junior Java programer', NULL, 2, NULL),
(26, 'Programer u sektoru IT podrške', 'Naša kompanija je ispostava IMEL Grupacije iz Hong Kong-a u Srbiji, koja služi za dalju distribuciju i reeksport robe širom sveta. Sinoalpine DOO je carinski magacin, pod nadzorom carine, tako da se skupoceni duvanski proizvodi koji se nalaze u magacinu ne smeju prodavati na teritoriji Srbije, već se samo pakuju, zasticuju, stite, pripremaju za slanje i šalju dalje do odredišta krajnjeg kupca. Vise na profilu kompanije. ', '2019-08-22 18:21:53', '2019-08-31', 7, 'grupa', 'Dve godine radnog iskustva minimum.;Odlicno poznavanje rada na racunaru.;PHP – Full Stack, snalazi se i sa FrontEnd-om i sa Backend-om', 'Rad na izazovnim projektima, u mladom i ambicioznom timu.;Konkurentna plata. ;Redovni odmori. ', 'Podrazumeva se dobro poznavanje engleskog jezika, viši nivo   ;Potpuna IT podrška u kancelarijama, obuka u našim internim programima i aplikacijama, za koje će kasnije biti podrška. Nameštanje štampača (mnogo štampamo na dnevnom nivou), setovanje kompjutera, mail-ova... ', '47.00 - 50.000', 'mesecno', 1, 'Programer u sektoru IT podrške', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `postdiskusija`
--

DROP TABLE IF EXISTS `postdiskusija`;
CREATE TABLE IF NOT EXISTS `postdiskusija` (
  `idPos` int(11) NOT NULL AUTO_INCREMENT,
  `poslatoDatum` datetime DEFAULT NULL,
  `tekst` mediumtext,
  `posiljalac` int(11) DEFAULT NULL,
  `diskusija` int(11) DEFAULT NULL,
  `brLajkova` int(4) DEFAULT NULL,
  PRIMARY KEY (`idPos`),
  KEY `idPosidKor_idx` (`posiljalac`),
  KEY `idDisidDis_idx` (`diskusija`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postdiskusija`
--

INSERT INTO `postdiskusija` (`idPos`, `poslatoDatum`, `tekst`, `posiljalac`, `diskusija`, `brLajkova`) VALUES
(1, '2019-03-16 00:00:00', 'Mislim da je ovo sjajna prilika da se razmene iskustva o prekvalifikacijama i kursu PHP-a. Nadam se da će biti dosta učesnika u diskusiji. Ja lično mislim da nam ovaj kurs pruža sjajnu priliku za nastavak usavršavanja. Šta vi mislite?', 1, 1, 3),
(2, '2019-03-16 01:00:00', 'Slažem se sa konstatacijom da nam ovaj kurs svakako znači. Mada bi bilo mnogo bolje i lakše za nas studente da duže traje i da nije toliko ubrzan.', 3, 1, 5),
(3, '2019-03-16 01:30:00', 'Da upravo tako, kada bi bilo malo duže imali bismo više vremena za vežbanje i lakše bismo povezali stvari, svakako...', 1, 1, 5),
(4, '2019-03-16 02:05:00', 'Kurs je dobar, samo treba mnogo još da se radi da bismo došli do nekog nivoa junior programera, ali svakako je odskočna daska.', 5, 1, 6),
(5, '2019-03-16 02:10:00', 'Ja sam mnogo naučio i baš sam zadovoljan, nisam ni znao da je programiranje moja strast dok nisam počeo da kuckam, sada ne prođe dan da ne dodam neki kod...:)', 2, 1, 6),
(6, '2019-06-17 08:00:00', 'Kolege da li neko zna kako da definišem strane ključeve u MySql-u?', 9, 3, NULL),
(7, '2019-06-17 09:00:00', 'Mislim da bi pri dnu tabele trebalo da imaš deo gde piše foreign key..', 20, 3, 1),
(8, '2019-06-18 10:00:00', 'Da, kada uđeš u tabelu imaš na dnu foreign keys, onda klikneš i uneseš koji ti je strani ključ i iz koje je tabele da izvršiš povezivanje i to je čitava tehnologija.', 24, 3, 1),
(9, '2019-06-20 11:53:38', 'Hvala puno na pomoći, snađoh se. Pozdrav', 9, 3, 1),
(10, '2019-05-20 11:59:00', 'Drugari može li neko da mi objasni ukratko kako funkcioniše Codeigniter?', 30, 2, NULL),
(11, '2019-05-20 14:44:03', 'Uh, baš i ne može ukratko ali evo, sastoji se od Contolora, Modela i View-a. U view-u se nalazi deo koji se prikazuje na strani, u modelu definišeš funkcije koje pozivaš preko kontrolera. Kontroler ti zapravo služi kao veza između modela i view strane.', 34, 2, 1),
(12, '2019-05-20 15:45:52', 'Hvala puno za ukratko objašnjenje, za početnika je i to dovoljno.. pozdrav', 30, 2, NULL),
(13, '2019-04-20 15:41:27', 'Može li neko da mi objasni razliku između InnoDB-a i MyIsam-a?', 25, 4, NULL),
(14, '2019-04-20 16:43:29', 'Pa osnovna i najbitnija razlika je u tome što treba koristiti InnoDB ako su ti potrebni strani ključevi, a u većini slučajeva svima trebaju. Jer MyISAM ne podržava strane ključeve.', 26, 4, 1),
(15, '2019-04-22 23:07:06', 'Koja su Vaša očekivanja na razgovoru za posao? Koje su informacije koje očekujete da vam poslodavac da, ili pak pitamja koja smatrate neprikladnim?', 17, 5, NULL),
(16, '2019-04-25 23:08:37', 'Pa voleo bih kada bi za promenu neko na razgovoru za posao rekao kolika je plata predviđena za to radno mesto, a ne da me pitaju koju platu očekujem...', 29, 5, 6),
(17, '2019-04-26 23:16:16', 'Slažem se sa tobom, takođe ja kao žensko bih volela da me ne pitaju da li sam udata i imam li decu, ili da li možda planiram da rađam... To je strašno ružno i jednostavno nije u redu postavljati tako privatna pitanja na razgovoru za posao.', 10, 5, 11),
(18, '2019-04-26 22:57:44', 'Potpuno Vas razumem koleginice i hvala na iskrenosti. Mi kao poslodavac se trudimo da privatna pitanja budu potpuno isključena kada je u pitanju razgovor za posao.', 17, 5, NULL),
(19, '2019-07-21 22:22:08', 'Smatrate li da praksa uvek treba da bude plaćena?', 48, 6, NULL),
(20, '2019-07-22 12:02:25', 'Pa bilo bi poželjno u svakom slučaju. Ali sad nekome ko i dalje studira sigurno znači ako na toj praksi može dosta da nauči, pa mu taj finansijski aspekt i nije toliko bitan.', 28, 6, 3),
(21, '2019-07-22 12:03:00', 'Da, ja mislim da treba, jer ti ljudi koji dolaze na praksu u 99% slučajeva se više trude i više rade od samih zaposlenih...', 1, 6, 2),
(23, '2019-02-25 14:42:39', 'Naravno da nije, ali je svakako odlučujući, mada bih verovatno pristala i na manju svotu novca ako postoji mogućnost učenja i napredovanja...', 1, 7, 1),
(24, '2019-02-25 16:05:18', 'Da se ne lažemo jeste. Ne živi se od vazduha. Svakako bih želeo nešto da naučim i da mogu da napredujem, ali novac je taj koji nas hrani.', 26, 7, 1),
(25, '2019-08-13 11:54:19', 'Drugari koji server je bolji Wamp ili Xamp?', 18, 8, NULL),
(26, '2019-08-14 04:00:00', 'Potpuno je svejedno. Zavisi od preferencija. Ljudi koji počnu jedan da koriste posle se retko prebacuju na drugi, to je to.. Nema neke posebne razlike.', 14, 8, 1),
(27, '2019-06-04 05:00:00', 'Smatrate li da su ljudi u Srbiji nezaposleni zato što tako žele? Tj. zato što biraju posao i neće zapravo da rade...', 10, 10, 5),
(28, '2019-06-12 08:00:00', 'Pa sad zavisi od ljudi i izbora. Ne mislim da je većina voljno nezaposlena, ali opet sa druge strane znam i dosta ljudi koji biraju posao pa ne rade već godinama.. Tako da ima i jednog i drugog faktora.', 14, 10, 10),
(29, '2018-11-01 10:00:00', 'Šta mislite da je bolje za početnika, netbeans ili sublime?', 27, 11, NULL),
(30, '2018-11-14 23:00:00', 'Pa sad, imaju prednosti i jedan i drugi, jednostavniji je sublime za učenje nema puno opcija, ali netbeans kad savladaš znaćeš u svakom da se snađeš i baš ima korisnih opcija. Moj savet svakako Netbeans', 4, 11, 1),
(31, '2019-08-02 07:00:00', 'Šta mislite kako i koliko dugo je potrebno da se postane PHP junior programer?', 2, 12, NULL),
(32, '2019-08-03 08:00:00', 'To je baš individualno. Zavisi koliko vremena posvetiš učenju, koliko se pronađeš u tome, kao i da li vidiš sebe u toj priči celog života... U principu to je učenje za ceo život, pa moraš toga da budeš svestan, mnogi odustanu posle nekog vremena.', 14, 12, 2),
(33, '2019-08-04 04:00:00', 'Da, ja mislim ako se potpuno posvetiš tome za 2 godine recimo možeš za sebe da kažeš da si na nivou junior programera. Ali te dve godine moraš baš da učiš i svaki dan da nešto kuckaš, slušaš, gledaš i istražuješ...', 29, 12, 5);

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

--
-- Dumping data for table `sadrzidiskusije`
--

INSERT INTO `sadrzidiskusije` (`idDisk`, `idGrupe`) VALUES
(1, 4),
(11, 4),
(6, 6),
(7, 7);

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

--
-- Dumping data for table `sadrziobavestenje`
--

INSERT INTO `sadrziobavestenje` (`idGrupe`, `idObav`) VALUES
(4, 10),
(2, 12);

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

--
-- Dumping data for table `sadrzioglas`
--

INSERT INTO `sadrzioglas` (`idGru`, `idOgl`) VALUES
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 6),
(7, 7),
(7, 8);

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

--
-- Dumping data for table `sadrzivesti`
--

INSERT INTO `sadrzivesti` (`idVest`, `idGrupa`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sifdrzavljanstvo`
--

DROP TABLE IF EXISTS `sifdrzavljanstvo`;
CREATE TABLE IF NOT EXISTS `sifdrzavljanstvo` (
  `idDrz` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDrz`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifdrzavljanstvo`
--

INSERT INTO `sifdrzavljanstvo` (`idDrz`, `naziv`) VALUES
(1, 'Srpsko'),
(2, 'Hrvatsko'),
(3, 'Crnogorsko'),
(4, 'Bosansko'),
(5, 'Slovenačko'),
(6, 'Makedonsko'),
(7, 'Nemačko');

-- --------------------------------------------------------

--
-- Table structure for table `siffakulteti`
--

DROP TABLE IF EXISTS `siffakulteti`;
CREATE TABLE IF NOT EXISTS `siffakulteti` (
  `idFak` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`idFak`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `siffakulteti`
--

INSERT INTO `siffakulteti` (`idFak`, `naziv`) VALUES
(1, 'Elektrotehnicki fakultet'),
(2, 'Farmaceutski fakultet'),
(3, 'Fakultet politickih nauka'),
(4, 'Bioloski fakultet'),
(5, 'Masinski fakultet'),
(6, 'Filoloski fakultet'),
(7, 'Fakultet dramskih umetnosti'),
(8, 'Fakultet organizacionih nauka'),
(9, 'Matematički fakultet'),
(10, 'Ekonomski fakultet'),
(11, 'Pravni fakultet'),
(12, 'Pravni fakultet u Kragujevcu'),
(13, 'Fakultet za poslovne studije'),
(14, 'Fakultet za kulturu i medije'),
(15, 'Poslovni fakultet u Beogradu'),
(16, 'Fakultet za informatiku i računarstvo'),
(17, 'Departman za prirodno-tehničke nauke'),
(18, 'Medicinski fakultet u Novom Sadu'),
(19, 'Medicinski fakultet u Nišu'),
(20, 'Mašinski fakultet u Nišu'),
(21, 'Ekonomski fakultet u Novom Sadu'),
(22, 'Pravni fakultet u Novom Sadu'),
(23, 'Departman za Biomedicinske nauke'),
(24, 'Departman za filozofske nauke'),
(25, 'Filološko-umetnički fakultet'),
(26, 'Prirodno-matematički fakultet');

-- --------------------------------------------------------

--
-- Table structure for table `sifgradovi`
--

DROP TABLE IF EXISTS `sifgradovi`;
CREATE TABLE IF NOT EXISTS `sifgradovi` (
  `idGra` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idGra`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifgradovi`
--

INSERT INTO `sifgradovi` (`idGra`, `naziv`) VALUES
(1, 'Beograd'),
(2, 'Novi Sad'),
(3, 'Kragujevac'),
(4, 'Sremska Mitrovica'),
(5, 'Ljig'),
(6, 'Ivanjica'),
(7, 'Bajina Bašta'),
(8, 'Beočin'),
(9, 'Jagodina'),
(10, 'Kruševac'),
(11, 'Niš'),
(12, 'Kraljevo'),
(13, 'Aleksinac'),
(14, 'Novi Pazar'),
(15, 'Užice'),
(16, 'Subotica'),
(17, 'Valjevo'),
(18, 'Sombor'),
(19, 'Vršac'),
(20, 'Negotin'),
(21, 'Vranje'),
(22, 'Loznica'),
(23, 'Gornji Milanovac'),
(24, 'Čačak'),
(25, 'Pančevo'),
(26, 'Požarevac'),
(27, 'Bačka Palanka');

-- --------------------------------------------------------

--
-- Table structure for table `sifinteresovanja`
--

DROP TABLE IF EXISTS `sifinteresovanja`;
CREATE TABLE IF NOT EXISTS `sifinteresovanja` (
  `idInt` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idInt`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifinteresovanja`
--

INSERT INTO `sifinteresovanja` (`idInt`, `naziv`) VALUES
(1, 'Novinarstvo'),
(2, 'Programiranje'),
(3, 'Pecanje'),
(4, 'Modeling'),
(5, 'TV'),
(6, 'Humanitarni rad'),
(7, 'Fudbal'),
(8, 'Skupljanje sličica'),
(9, 'Brzo hodanje'),
(10, 'Planinarenje'),
(11, 'Čitanje'),
(12, 'Slikanje'),
(13, 'Pilates'),
(14, 'Trcanje'),
(15, 'Crtanje'),
(16, 'Košarka'),
(17, 'Odbojka'),
(18, 'Vežbanje'),
(19, 'Klizanje'),
(20, 'Fotografija'),
(21, 'Vajarstvo'),
(22, 'Projektovanje'),
(23, 'Dizajniranje'),
(24, 'Tenis');

-- --------------------------------------------------------

--
-- Table structure for table `sifkategorijadiskusija`
--

DROP TABLE IF EXISTS `sifkategorijadiskusija`;
CREATE TABLE IF NOT EXISTS `sifkategorijadiskusija` (
  `idKatDis` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKatDis`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifkategorijadiskusija`
--

INSERT INTO `sifkategorijadiskusija` (`idKatDis`, `naziv`) VALUES
(1, 'Nova kategorija 12'),
(6, 'Programiranje'),
(7, 'Trazenje posla'),
(8, 'Praksa'),
(9, 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `sifkategorijavesti`
--

DROP TABLE IF EXISTS `sifkategorijavesti`;
CREATE TABLE IF NOT EXISTS `sifkategorijavesti` (
  `idKatVesti` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKatVesti`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifkategorijavesti`
--

INSERT INTO `sifkategorijavesti` (`idKatVesti`, `naziv`) VALUES
(1, 'Programiranje'),
(2, 'Obuka PHP'),
(3, 'Obuka - Java'),
(4, 'Sajam poslova'),
(5, 'Obuka-Linux'),
(6, 'Praksa');

-- --------------------------------------------------------

--
-- Table structure for table `sifkompanija`
--

DROP TABLE IF EXISTS `sifkompanija`;
CREATE TABLE IF NOT EXISTS `sifkompanija` (
  `idSifKo` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSifKo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifkompanija`
--

INSERT INTO `sifkompanija` (`idSifKo`, `naziv`) VALUES
(1, 'Delhaize'),
(2, 'Nordeus'),
(3, 'Cander'),
(4, 'Komercijalna banka'),
(6, 'Nelt DOO'),
(7, 'NCR doo'),
(8, 'Bigz Office Group DOO'),
(9, 'Starbag'),
(10, 'Ringier Axel Springer');

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
(2, 'Java'),
(3, 'Linux');

-- --------------------------------------------------------

--
-- Table structure for table `sifpozicija`
--

DROP TABLE IF EXISTS `sifpozicija`;
CREATE TABLE IF NOT EXISTS `sifpozicija` (
  `idPoz` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPoz`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifpozicija`
--

INSERT INTO `sifpozicija` (`idPoz`, `naziv`) VALUES
(1, 'Direktor'),
(2, 'Sekretarica'),
(3, 'Programer'),
(4, 'Predavač'),
(5, 'Čistačica'),
(6, 'Čuvar'),
(7, 'Peracica prozora'),
(8, 'Komercijalista'),
(9, 'Bankar'),
(10, 'Analitičar'),
(11, 'Asistent'),
(12, 'Kuvar'),
(13, 'Javni beležnik'),
(14, 'Kurir'),
(15, 'Šalter radnik'),
(17, 'Menadžer'),
(18, 'Poslovođa'),
(19, 'Knjigovođa'),
(20, 'Fizički radnik'),
(21, 'Novinar');

-- --------------------------------------------------------

--
-- Table structure for table `sifuniverziteti`
--

DROP TABLE IF EXISTS `sifuniverziteti`;
CREATE TABLE IF NOT EXISTS `sifuniverziteti` (
  `idUni` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`idUni`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifuniverziteti`
--

INSERT INTO `sifuniverziteti` (`idUni`, `naziv`) VALUES
(1, 'Univerzitet u Beogradu'),
(2, 'Megatrend univerzitet'),
(3, 'Univerzitet umetnosti u Beogradu'),
(4, 'Univerzitet Odbrane u Beogradu'),
(5, 'Univerzitet u Prištini'),
(6, 'Univerzitet u Kragujevcu\r\n'),
(7, 'Državni univerzitet u Novom Pazaru'),
(8, 'Univerzitet u Novom Sadu'),
(9, 'Univerzitet u Nišu'),
(10, 'Univerzitet Singidunum'),
(11, 'Univerzitet Privredna akademija'),
(12, 'Univerzitet Educons'),
(13, 'Univerzitet Metropolitan'),
(14, 'Univerzitet Union'),
(15, 'Univerzitet Union- Nikola Tesla'),
(16, 'Univerzitet Alfa'),
(17, 'Evropski univerzitet'),
(18, 'Univerzitet u Novom Pazaru');

-- --------------------------------------------------------

--
-- Table structure for table `sifvestine`
--

DROP TABLE IF EXISTS `sifvestine`;
CREATE TABLE IF NOT EXISTS `sifvestine` (
  `idVes` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idVes`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sifvestine`
--

INSERT INTO `sifvestine` (`idVes`, `naziv`) VALUES
(1, 'Kreativno pisanje'),
(2, 'Rad na računaru'),
(3, 'Pravljenje tabela'),
(4, 'Pričanje'),
(5, 'Komunikacija'),
(6, 'Pregovaranje'),
(7, 'Društvene mreže'),
(8, 'Timski rad'),
(9, 'Rešavanje konflikata'),
(10, 'Savetovanje'),
(11, 'Maštovitost'),
(12, 'Asertivnost'),
(13, 'Multitasking'),
(14, 'Sposobnost rada pod pritiskom'),
(15, 'Planiranje aktivnosti'),
(16, 'Efikasno upravljanje vremenom'),
(17, 'Korišćenje listi i tabela'),
(18, 'Realizovanje zadataka uz poštovanje rokova'),
(19, 'Klasifikacija i sumiranje podataka'),
(20, 'Pronalaženje praktičnih rešenja'),
(21, 'Formulisanje pitanja'),
(22, 'Procena problema'),
(23, 'Upravljanje problemom'),
(24, 'Rešavanje problema'),
(25, 'Donošenje odluka'),
(26, 'Motivisanje drugih'),
(27, 'Delegiranje zadataka'),
(28, 'Supervizija'),
(29, 'Postavljanje ciljeva'),
(30, 'Fleksibilnost'),
(31, 'Istrajnost'),
(32, 'Upornost'),
(33, 'Preuzimanje inicijative');

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
  `vidljivostTelefon` int(11) DEFAULT NULL,
  `vidljivostAdresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`idKor`),
  UNIQUE KEY `pin_UNIQUE` (`pin`),
  KEY `idSifInt_idx` (`idInt`),
  KEY `idVesStudent_idx` (`idVes`),
  KEY `idSifDrzStudent_idx` (`drzavljanstvo`),
  KEY `idSifKursStudent_idx` (`idKurs`),
  KEY `idGraStudent_idx` (`mesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ime`, `srednjeIme`, `prezime`, `datum`, `pol`, `drzavljanstvo`, `telefon`, `adresa`, `mesto`, `pin`, `status`, `idKor`, `idInt`, `idVes`, `idKurs`, `vidljivostTelefon`, `vidljivostAdresa`) VALUES
('Ljubica', 'Zoran', 'Krstic', '1991-11-04', 'z', 1, '0606705351', 'Luke Vojvodica 25', 1, 234585, 'nezaposlena', 1, 1, 1, 1, 1, NULL),
('Gordan', 'Jovan', 'Stojkovic', '2078-06-19', 'm', 1, '0601231456', 'Vlajka Vlajica 23', 1, 567890, 'zaposlen', 2, 2, 24, 1, NULL, NULL),
('Zorana', 'Marko', 'Trifunović', '1991-11-11', 'z', 1, '0621231290', 'Svetozara Markovića 15', 1, 109458, 'zaposlena', 3, 4, 17, 1, NULL, NULL),
('Saša', 'Stanko', 'Đekić', '1986-11-11', 'm', 1, '063258425', 'Kumanovska 35', 1, 225256, 'zaposlen', 4, 3, 30, 1, NULL, 1),
('Sanja', 'Luka', 'Kordić', '1989-10-04', 'z', 1, '0642574423', 'Grčića Milenka 3', 1, 252285, 'zaposlena', 5, 11, 6, 1, NULL, NULL),
('Bojana', 'Marko', 'Matić', '1992-12-12', 'z', 1, '064455458', 'Cara Lazara 51', 24, 906525, 'nezaposlena', 6, 17, 16, 3, NULL, NULL),
('Jovan', 'Miloš', 'Marković', '1980-02-03', 'm', 1, '062252855', 'Partizanska 56', 2, 122524, 'nezaposlen', 9, 8, 29, 2, NULL, 1),
('Ana', 'Jovan', 'Jovanović', '2000-12-25', 'z', 1, '0652323526', 'Jug Bogdanova 1', 15, 152144, 'student', 10, 9, 5, 2, NULL, NULL),
('Marko', 'Milan', 'Dmitrović', '1991-11-18', 'm', 1, '0618525444', 'Bogoljuba Čukića 36', 14, 9999, 'student', 13, 10, 26, 3, NULL, NULL),
('Bojan', 'Branko', 'Jovović', '1978-06-02', 'm', 1, '0641552151', 'Karađorđeva 25', 20, 132212, 'nezaposlen', 14, 7, 13, 1, NULL, NULL),
('Vanja', 'Igor', 'Mitrović', '1990-03-15', 'z', 2, '0642529662', 'Labuda Đukića 14', 9, 114214, 'zaposlena', 18, 13, 31, 1, NULL, 1),
('Marija', 'Stanko', 'Stankovic', '1977-04-04', 'z', 1, '062323352', 'Moravička 12', 13, 135356, 'student', 19, 23, 19, 3, NULL, NULL),
('Igor', 'Boban', 'Bojic', '1980-05-26', 'm', 2, '061626335', 'Hajduk Veljkova 52', 12, 166925, 'zaposlen', 20, 6, 26, 2, NULL, NULL),
('Janko', 'Igor', 'Jankovic', '1986-07-04', 'm', 1, '0567543689', 'Vidikovacki Venac 7', 1, 1104, 'nezaposlen', 21, 16, 20, 1, NULL, NULL),
('Nenad', 'Novak', 'Stanković', '1965-12-18', 'm', 1, '065432167', 'Prvomajski bulevar 95', 18, 212612, 'student', 22, 5, 27, 1, NULL, NULL),
('Miša', 'Bojan', 'Petrović', '1979-04-16', 'm', 1, '0626332321', 'Moravička 25', 6, 114134, 'student', 23, 2, 29, 2, NULL, NULL),
('Jelena', 'Branko', 'Vojvodić', '1987-06-27', 'z', 1, '0645225851', 'Miloša Obilića 13', 21, 163325, 'zaposlena', 24, 20, 7, 3, NULL, 1),
('Miloš', 'Marijan', 'Marijanovic', '1988-11-25', 'm', 1, '0621332992', 'Avalska 11', 11, 136262, 'nezaposlen', 25, 18, 10, 1, NULL, NULL),
('Kornelije', 'Dobrivoje', 'Pantić', '1988-06-21', 'm', 2, '0635274744', 'Braće Radić 65', 16, 118790, 'nezaposlen', 26, 20, 22, 1, NULL, 1),
('Aleksandra', 'Petar', 'Katić', '1968-10-14', 'z', 1, '0648872121', 'Alekse Nenadovića 19', 17, 233365, 'student', 27, 19, 3, 2, NULL, NULL),
('Milica', 'Ratko', 'Janićijević', '1972-09-01', 'z', 1, '0639989865', 'Aleksandrovačka 78', 10, 166362, 'nezaposlena', 28, 12, 18, 3, NULL, NULL),
('Bane', 'Janko', 'Radović', '1980-06-08', 'm', 1, '061576696', 'Banjski put 6', 22, 293936, 'zaposlen', 29, 14, 11, 1, 1, 1),
('Ivica', 'Milivoje', 'Branković', '1981-10-14', 'm', 1, '0638577741', 'Braće Jugović 29', 7, 166887, 'student', 30, 20, 2, 3, NULL, 1),
('Mirko', 'Jevta', 'Ranković', '1985-04-28', 'm', 1, '0641777858', 'Alberta Ajnštajna 56', 2, 199852, 'student', 33, 3, 17, 3, NULL, NULL),
('Ljiljana', 'Vlada', 'Ilić', '1974-11-29', 'z', 1, '0637712123', 'Bore Stankovića 82', 19, 144547, 'nezaposlena', 34, 15, 28, 3, 1, 1),
('Biljana', 'Ivana', 'Rasic', '1991-11-11', 'z', 5, '0600789542', 'Kostolacka 5', 14, 536, 'nezaposleni', 57, NULL, NULL, 1, NULL, NULL);

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
  KEY `fk_studije_siffakulteti1_idx` (`idFak`),
  KEY `idGraStudije_idx` (`sediste`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studije`
--

INSERT INTO `studije` (`idKor`, `univerzitet`, `sediste`, `nivo`, `godinaStudija`, `idFak`) VALUES
(10, 1, 1, 'osnovne', 4, 2),
(13, 18, 14, 'osnovne', 3, 17),
(19, 1, 1, 'master', 1, 7),
(22, 8, 2, 'osnovne', 4, 18),
(23, 2, 1, 'osnovne', 3, 13),
(27, 6, 3, 'master', 2, 12),
(30, 10, 1, 'osnovne', 2, 16),
(33, 8, 2, 'master', 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `ucesnicidiskusije`
--

DROP TABLE IF EXISTS `ucesnicidiskusije`;
CREATE TABLE IF NOT EXISTS `ucesnicidiskusije` (
  `idKor` int(11) NOT NULL,
  `idDis` int(11) NOT NULL,
  PRIMARY KEY (`idKor`,`idDis`),
  KEY `idDisidDis_idx` (`idDis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ucesnicidiskusije`
--

INSERT INTO `ucesnicidiskusije` (`idKor`, `idDis`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

DROP TABLE IF EXISTS `vesti`;
CREATE TABLE IF NOT EXISTS `vesti` (
  `idVes` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) DEFAULT NULL,
  `tekst` mediumtext,
  `kategorija` int(11) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `vidljivost` varchar(45) DEFAULT NULL,
  `vidljivostKurs` int(11) DEFAULT NULL,
  `vidljivostGrupa` int(11) DEFAULT NULL,
  `zaBrisanje` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idVes`),
  KEY `idVestIdKor_idx` (`autor`),
  KEY `idVesiIdKat_idx` (`kategorija`),
  KEY `idGrupaVesti_idx` (`vidljivostGrupa`),
  KEY `idKursVesti_idx` (`vidljivostKurs`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vesti`
--

INSERT INTO `vesti` (`idVes`, `naziv`, `tekst`, `kategorija`, `datum`, `autor`, `vidljivost`, `vidljivostKurs`, `vidljivostGrupa`, `zaBrisanje`) VALUES
(1, 'PHP', 'Najavljena je nova investicija u Srbiji. Dolazi inostrana IT kompanija koja će otvoriti 1500 radnih mesta za IT struku.', 1, '2018-07-11 14:30:00', 1, 'kurs', 1, NULL, NULL),
(2, 'Obuka PHP', 'Početak predavanja u okviru prekvalifikacija se očekuje početkom februara meseca.', 2, '2019-01-02 14:30:00', 4, 'grupa', NULL, 4, NULL),
(3, 'Nova kategorija PHP', 'Napravljena je nova grupa za PHP programere i sve zainteresovane koji žele da razmenjuju iskustva i potraže pomoć od kolega.', 2, '2019-07-28 11:07:45', 1, 'gost', NULL, NULL, NULL),
(4, 'Potraga za poslom', 'Poštovane kolege, na ovom sajtu možete pogledati potencijalne poslodavce, kao i tekuće otvorene pozicije kod istih. Srećno svima.', 2, '2019-07-28 11:07:45', 9, 'gost', NULL, NULL, NULL),
(5, 'Potraga za programerima', 'Kolege otvorene su nove pozicije za junior programere u okviru kompanija koje su aktivne na sajtu. Pogledajte njihove ponude.', 1, '2019-07-30 21:07:42', 4, 'korisnici', NULL, NULL, NULL),
(6, 'PHP junior programer', 'Tehnomanija je objavila konkurs za potragu PHP programera.', 4, '2019-08-11 12:08:37', 1, 'pretraga', NULL, NULL, NULL),
(7, 'PHP junior programer', 'Tehnomanija je objavila konkurs za poziciju junior PHP programer. Pogledati dodatne zahteve i informacije u okviru oglasa ili na njihovom sajtu.', 3, '2019-08-15 11:08:06', 1, 'kurs', 1, NULL, NULL),
(8, 'Praksa', 'Drage kolege, pošto se bliži vreme odmora za zaposlene, postoji veliki broj konkursa otvorenih za praksu. Više informacija možete naći u okviru oglasa kao i najnovijih vesti.', 6, '2019-06-15 11:08:19', 13, 'pretraga', NULL, NULL, NULL),
(9, 'Ukidanje Delta M firme', 'Poštovani, Delta M firma u okviru grupacije Delta prestala je da postoji od dana 09.02.2019. godine. Sve aktivnosti, zaposlene i prostorije preuzete su od strane Delta Holdinga u okviru grupacije.', NULL, '2019-02-10 20:08:46', 16, 'gost', NULL, NULL, 'da'),
(10, 'Saradnja sa Nemačkom', 'Poštovani, sa zadovoljstvom mogu da Vas obavestim da je uspešno dogovorena saradnja sa Nemačkom u oblasti prodaje i izvoza oružja. Samim tim uskoro će biti objavljeni konkursi za praksu i poslove, koji su neophodni da bi saradnja bila uspešno obavljena.', NULL, '2018-10-17 20:08:46', 47, 'gost', NULL, NULL, NULL),
(11, 'Puštena deonica Ljig-Čačak', 'Poštovani, sa zadovoljstvom Vas obaveštavam da je puštena deonica Ljig-Čačak, kao rezultat efikasnog rada naših zaposlenih i pre predviđenog roka. Svi zaposleni će biti adekvatno nagrađeni.', 4, '2019-02-26 20:08:47', 38, 'gost', NULL, NULL, NULL),
(12, 'Java programer', 'Kolege, objavljene su nove otvorene pozicije za Java programere. Pogledajte oglase za više informacija.', 3, '2019-07-20 08:47:00', 21, 'gost', NULL, NULL, NULL),
(14, 'Posao', 'Otvorena je nova pozicija za računovođu. Pogledajte oglas na našem profilu.', 4, '2019-08-21 10:08:49', 7, 'gost', NULL, NULL, NULL),
(15, 'Nova ponuda', 'Dragi kupci, sa zadovoljstvom Vas obaveštavamo da od 01.09.2019. godine u našim radnjama možete pronaći Bosch-ove proizvode. Za celokupnu ponudu posetite naš sajt: www.tehnomanija.rs.', NULL, '2019-08-21 12:08:41', 8, 'gost', NULL, NULL, NULL),
(16, 'Otvoreno radno mesto', 'Tražimo junior Java programera. Više informacija možete naći u okviru oglasa na našem profilu.', NULL, '2019-08-21 13:08:12', 11, 'kurs', NULL, NULL, NULL),
(17, 'Dekorativno osvetljenje', 'Sa zadovoljstvom Vas obaveštavamo da je postavljeno dekorativno osvetljenje na glavnom trgu u Kraljevu. Posetite nas i uverite se u stručnost naših radnika.', 4, '2019-08-22 15:08:31', 44, 'gost', NULL, NULL, NULL),
(18, 'Nova signalizacija', 'Postavljena je nova signalizacija na autoputu Novi Sad-Sombor. Srećan put.', NULL, '2019-08-22 15:08:46', 50, NULL, NULL, NULL, NULL),
(19, 'Novo radno mesto', 'Tražimo mašinskog inženjera. Više informacija na našem sajtu.', NULL, '2019-08-22 15:08:56', 54, 'korisnici', NULL, NULL, NULL),
(20, 'Blizi se kraj projekta', 'Dragi studenti, projekat samo sto nije gotov. Bilo je jako lepo saradjivati sa vama. Pozdrav!', 1, '2019-08-25 13:08:40', 1, 'pretraga', NULL, NULL, 'da');

-- --------------------------------------------------------

--
-- Table structure for table `vidiobavestenje`
--

DROP TABLE IF EXISTS `vidiobavestenje`;
CREATE TABLE IF NOT EXISTS `vidiobavestenje` (
  `idKor` int(11) NOT NULL,
  `idObav` int(11) NOT NULL,
  PRIMARY KEY (`idKor`,`idObav`),
  KEY `idObavVidiObav_idx` (`idObav`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vidioglas`
--

DROP TABLE IF EXISTS `vidioglas`;
CREATE TABLE IF NOT EXISTS `vidioglas` (
  `idOgl` int(11) NOT NULL,
  `idKor` int(11) NOT NULL,
  PRIMARY KEY (`idOgl`,`idKor`),
  KEY `idKorVidiOgl_idx` (`idKor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vidivest`
--

DROP TABLE IF EXISTS `vidivest`;
CREATE TABLE IF NOT EXISTS `vidivest` (
  `idKor` int(11) NOT NULL,
  `idVes` int(11) NOT NULL,
  PRIMARY KEY (`idKor`,`idVes`),
  KEY `idVestVidiVest_idx` (`idVes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vidivest`
--

INSERT INTO `vidivest` (`idKor`, `idVes`) VALUES
(1, 20),
(2, 20),
(3, 20),
(4, 20),
(5, 20),
(21, 20);

-- --------------------------------------------------------

--
-- Table structure for table `zaposlenje`
--

DROP TABLE IF EXISTS `zaposlenje`;
CREATE TABLE IF NOT EXISTS `zaposlenje` (
  `kompanija` int(11) DEFAULT NULL,
  `mesto` int(11) DEFAULT NULL,
  `pozicija` int(11) DEFAULT NULL,
  `od` date DEFAULT NULL,
  `do` date DEFAULT NULL,
  `vidljivost` int(11) DEFAULT NULL,
  `idZap` int(11) NOT NULL AUTO_INCREMENT,
  `idKor` int(11) NOT NULL,
  PRIMARY KEY (`idZap`),
  KEY `idKorZapKompanija_idx` (`kompanija`),
  KEY `idKorZapPozicija_idx` (`pozicija`),
  KEY `idGraZap_idx` (`mesto`),
  KEY `idKorZaposlenje_idx` (`idKor`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zaposlenje`
--

INSERT INTO `zaposlenje` (`kompanija`, `mesto`, `pozicija`, `od`, `do`, `vidljivost`, `idZap`, `idKor`) VALUES
(2, 9, 2, '2016-05-01', NULL, NULL, 1, 18),
(1, 12, 1, '2005-06-01', NULL, 1, 2, 20),
(3, 21, 5, '2000-05-01', NULL, NULL, 3, 24),
(4, 22, 3, '2010-01-01', NULL, 1, 4, 29),
(6, 1, 1, '2000-06-01', NULL, NULL, 13, 2),
(7, 1, 9, '2009-03-01', NULL, NULL, 14, 3),
(9, 1, 11, '2008-09-01', NULL, NULL, 15, 4),
(8, 1, 8, '2018-09-17', NULL, NULL, 16, 5),
(10, 1, 21, '2013-11-11', '2019-03-12', NULL, 17, 1);

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
  ADD CONSTRAINT `idGruClanovigrupe` FOREIGN KEY (`idGru`) REFERENCES `grupe` (`idGru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorclanovigrupe` FOREIGN KEY (`idKor`) REFERENCES `student` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `idDisidKor` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idGrupaDiskusije` FOREIGN KEY (`vidljivostGrupa`) REFERENCES `grupe` (`idGru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKategorijaidDiskusija` FOREIGN KEY (`kategorija`) REFERENCES `sifkategorijadiskusija` (`idKatDis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKursDiskusije` FOREIGN KEY (`vidljivostKurs`) REFERENCES `sifkurs` (`idKurs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imainteresovanja`
--
ALTER TABLE `imainteresovanja`
  ADD CONSTRAINT `idInt` FOREIGN KEY (`idInt`) REFERENCES `sifinteresovanja` (`idInt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKor` FOREIGN KEY (`idKor`) REFERENCES `student` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imavestine`
--
ALTER TABLE `imavestine`
  ADD CONSTRAINT `idKorisnikaaaa` FOREIGN KEY (`idKor`) REFERENCES `student` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idVestineeee` FOREIGN KEY (`idVes`) REFERENCES `sifvestine` (`idVes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kompanija`
--
ALTER TABLE `kompanija`
  ADD CONSTRAINT `idGraKomp` FOREIGN KEY (`sediste`) REFERENCES `sifgradovi` (`idGra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorKomp` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `obavestenja`
--
ALTER TABLE `obavestenja`
  ADD CONSTRAINT `idGrupaObav` FOREIGN KEY (`vidljivostGrupa`) REFERENCES `grupe` (`idGru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorObav` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKursObav` FOREIGN KEY (`vidljivostKurs`) REFERENCES `sifkurs` (`idKurs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oglasi`
--
ALTER TABLE `oglasi`
  ADD CONSTRAINT `idAutidKor` FOREIGN KEY (`autor`) REFERENCES `kompanija` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idGraOglasi` FOREIGN KEY (`mesto`) REFERENCES `sifgradovi` (`idGra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idGrupaOglasi` FOREIGN KEY (`vidljivostGrupa`) REFERENCES `grupe` (`idGru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKursOglasi` FOREIGN KEY (`vidljivostKurs`) REFERENCES `sifkurs` (`idKurs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postdiskusija`
--
ALTER TABLE `postdiskusija`
  ADD CONSTRAINT `idDisidDis` FOREIGN KEY (`diskusija`) REFERENCES `diskusija` (`idDis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idPosidKor` FOREIGN KEY (`posiljalac`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_sadrzioglas_grupe1` FOREIGN KEY (`idGru`) REFERENCES `grupe` (`idGru`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sadrzioglas_oglasi1` FOREIGN KEY (`idOgl`) REFERENCES `oglasi` (`idOgl`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `idGraStudent` FOREIGN KEY (`mesto`) REFERENCES `sifgradovi` (`idGra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorStudent` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSifDrzStudent` FOREIGN KEY (`drzavljanstvo`) REFERENCES `sifdrzavljanstvo` (`idDrz`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSifIntStudent` FOREIGN KEY (`idInt`) REFERENCES `sifinteresovanja` (`idInt`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idSifKursStudent` FOREIGN KEY (`idKurs`) REFERENCES `sifkurs` (`idKurs`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idSifVesStudent` FOREIGN KEY (`idVes`) REFERENCES `sifvestine` (`idVes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studije`
--
ALTER TABLE `studije`
  ADD CONSTRAINT `fk_studije_siffakulteti1` FOREIGN KEY (`idFak`) REFERENCES `siffakulteti` (`idFak`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idGraStudije` FOREIGN KEY (`sediste`) REFERENCES `sifgradovi` (`idGra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idStudijeKor` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idStudijeSifUniverzitet` FOREIGN KEY (`univerzitet`) REFERENCES `sifuniverziteti` (`idUni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ucesnicidiskusije`
--
ALTER TABLE `ucesnicidiskusije`
  ADD CONSTRAINT `idDiskusije` FOREIGN KEY (`idDis`) REFERENCES `diskusija` (`idDis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorDisIdKor` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vesti`
--
ALTER TABLE `vesti`
  ADD CONSTRAINT `idGrupaVesti` FOREIGN KEY (`vidljivostGrupa`) REFERENCES `grupe` (`idGru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKursVesti` FOREIGN KEY (`vidljivostKurs`) REFERENCES `sifkurs` (`idKurs`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idVesIdKor` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idVesiIdKat` FOREIGN KEY (`kategorija`) REFERENCES `sifkategorijavesti` (`idKatVesti`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vidiobavestenje`
--
ALTER TABLE `vidiobavestenje`
  ADD CONSTRAINT `idKorVidiObav` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idObavVidiObav` FOREIGN KEY (`idObav`) REFERENCES `obavestenja` (`idOba`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vidioglas`
--
ALTER TABLE `vidioglas`
  ADD CONSTRAINT `idKorVidiOgl` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idOglVidiOgl` FOREIGN KEY (`idOgl`) REFERENCES `oglasi` (`idOgl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vidivest`
--
ALTER TABLE `vidivest`
  ADD CONSTRAINT `idKorVidiVest` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idVesVidiVest` FOREIGN KEY (`idVes`) REFERENCES `vesti` (`idVes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zaposlenje`
--
ALTER TABLE `zaposlenje`
  ADD CONSTRAINT `IdKorZaposlenje` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idGraZap` FOREIGN KEY (`mesto`) REFERENCES `sifgradovi` (`idGra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKorZapKomp` FOREIGN KEY (`kompanija`) REFERENCES `sifkompanija` (`idSifKo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idKorZapPozicija` FOREIGN KEY (`pozicija`) REFERENCES `sifpozicija` (`idPoz`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
