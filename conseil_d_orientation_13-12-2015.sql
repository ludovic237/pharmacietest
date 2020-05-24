-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2015 at 06:02 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `conseil_d_orientation`
--

-- --------------------------------------------------------

--
-- Table structure for table `acces_concours`
--

CREATE TABLE IF NOT EXISTS `acces_concours` (
  `CONCOURS_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `UNIVERSITE_ID` bigint(12) NOT NULL,
  `DATE_DEBUT_CONCOURS` date DEFAULT NULL,
  `DATE_FIN_CONCOURS` date DEFAULT NULL,
  `DESCRIPTION` text,
  `DETAILS` text,
  `MODALITE_ADMISSION` text,
  `COMPOSITION_DOSSIER` text,
  `DATE_DOSSIER` date DEFAULT NULL,
  `SUPPRIMER` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CONCOURS_ID`),
  KEY `FK_UNIVERSITE` (`UNIVERSITE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `acces_concours`
--

INSERT INTO `acces_concours` (`CONCOURS_ID`, `UNIVERSITE_ID`, `DATE_DEBUT_CONCOURS`, `DATE_FIN_CONCOURS`, `DESCRIPTION`, `DETAILS`, `MODALITE_ADMISSION`, `COMPOSITION_DOSSIER`, `DATE_DOSSIER`, `SUPPRIMER`) VALUES
(1, 8, '2015-09-24', '2015-09-25', 'Premier et Second Cycles de l''Ecole Normale Supérieure d''Enseiqnement Technique (ENSET) de l''Université de Douala.', '', '', '', NULL, 0),
(2, 7, '2015-09-22', '2015-09-25', 'Ecole Supérieure des Sciences Economiques et Commerciales de l''Université de Douala (ESSEC).\r\nFilière: Etudes Supérieures de Commerce (ESSEC).', '<p>Accès est un concours post-bac qui ouvre les portes de trois écoles de commerce : l’Iéseg, l’Essca et l’Esdes, pour un programme grande école en 5 ans Découvrez les modalités d’organisation de ce concours, le contenu des épreuves et de nombreux conseils pour réussir.</p>', 'Pour pouvoir passer ce concours, il faut soit être titulaire du baccalauréat, soit être titulaire du GCE-AL (ou d’un titre camerounais ou étranger équivalent).', '<ul class="list-group" style="font-size: 14px;">\r\n                        <li class="list-group-item" style="border: none;"> <i class="fa fa-check-square-o"></i>une demande d''inscription dûment remplie par le candidat;</li>\r\n                        <li class="list-group-item" style="border: none;"> <i class="fa fa-check-square-o"></i>une copie certifiée ''conforme d''acte de ''naissance dactylographiée;</li>\r\n                        <li class="list-group-item" style="border: none;"> <i class="fa fa-check-square-o"></i>les relevés de notes certifiés du Probatoire ou du GCE/OL, du Baccalauréat ou du GCE-AL;</li>\r\n                        <li class="list-group-item" style="border: none;"> <i class="fa fa-check-square-o"></i>une copie certifiée conforme du Baccalauréat ou du GCEIAL, ou du diplôme reconnu équivalent;</li>\r\n                        <li class="list-group-item" style="border: none;"> <i class="fa fa-check-square-o"></i>un certificat médical délivré par un médecin de l''Administration;</li>\r\n                        <li class="list-group-item" style="border: none;"> <i class="fa fa-check-square-o"></i>un extrait de casier judiciaire;</li>\r\n                        <li class="list-group-item" style="border: none;"> <i class="fa fa-check-square-o"></i>une enveloppe grand format timbrée et portant l''adresse du candidat;</li>\r\n                        <li class="list-group-item" style="border: none;"> <i class="fa fa-check-square-o"></i>deux photos (4x4) d''identité;</li>\r\n                        <li class="list-group-item" style="border: none;"> <i class="fa fa-check-square-o"></i>...</li>\r\n                    </ul>', NULL, 0),
(3, 7, '2015-09-26', '2015-09-26', 'Filière: Etudes Professionnelles Approfondies (ESSEC).', '', '', '', '2015-06-01', 0),
(4, 5, '2015-09-17', '2015-09-18', 'Institut Universitaire de Technologie (IUT) de l''Université de Douala.', '', '', '', NULL, 0),
(5, 10, '2015-09-25', '2015-09-25', 'Première année de l''Institut de Sciences Halieutiques (ISH) de\r\nl''Université de Douala.', '', '', '', NULL, 0),
(6, 6, '2015-09-16', '2015-09-16', 'Première année Faculté de Génie Industriel (FGI) de l''Université de Douala.', '', '', '', NULL, 0),
(7, 1, NULL, NULL, 'Date limite pour les inscriptions', '', '', '', '2015-10-15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_universite`
--

CREATE TABLE IF NOT EXISTS `article_universite` (
  `ARTICLE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `CATEGORIE_ID` bigint(12) NOT NULL,
  `PERSONNE_ID` bigint(12) NOT NULL,
  `UNIVERSITE_ID` bigint(12) DEFAULT NULL,
  `TITRE` varchar(255) NOT NULL,
  `INTITULE` text,
  `CONTENU` text NOT NULL,
  `IMAGE_DE_PRESENTATION` varchar(50) DEFAULT NULL,
  `VIDEO_DE_PRESENTATION` varchar(100) DEFAULT NULL,
  `DATE_PUBLICATION` datetime NOT NULL,
  `DATE_LECTURE` datetime DEFAULT NULL,
  `AIME` bigint(12) DEFAULT '0',
  `VUE` bigint(12) DEFAULT '0',
  PRIMARY KEY (`ARTICLE_ID`),
  KEY `FK_CATERORY` (`CATEGORIE_ID`),
  KEY `PERSONNE_ID` (`PERSONNE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `article_universite`
--

INSERT INTO `article_universite` (`ARTICLE_ID`, `CATEGORIE_ID`, `PERSONNE_ID`, `UNIVERSITE_ID`, `TITRE`, `INTITULE`, `CONTENU`, `IMAGE_DE_PRESENTATION`, `VIDEO_DE_PRESENTATION`, `DATE_PUBLICATION`, `DATE_LECTURE`, `AIME`, `VUE`) VALUES
(1, 1, 1, NULL, 'Outer space', '<p><strong>Outer space</strong>, or simply space, is the void that exists between celestial bodies, including the Earth. It is not completely empty, but consists of a hard vacuum containing a low density of particles: predominantly a plasma of hydrogen an', '<p>There is no firm boundary where space begins. However the Kármán line, at an altitude of 100 km (62 mi) above sea level, is conventionally used as the start of outer space in space treaties and for aerospace records keeping. The framework for international space law was established by the Outer Space Treaty, which was passed by the United Nations in 1967. This treaty precludes any claims of national sovereignty and permits all states to freely explore outer space. In 1979, the Moon Treaty made the surfaces of objects such as planets, as well as the orbital space around these bodies, the jurisdiction of the international community. Despite the drafting of UN resolutions for the peaceful uses of outer space, anti-satellite weapons have been tested in Earth orbit.</p>\r\n                                            <p><strong>Humans began</strong> the physical exploration of space during the 20th century with the advent of high-altitude balloon flights, followed by manned rocket launches. Earth orbit was first achieved by Yuri Gagarin of the Soviet Union in 1961 and unmanned spacecraft have since reached all of the known planets in the Solar System. Due to the high cost of getting into space, manned spaceflight has been limited to low Earth orbit and the Moon. In August 2012, Voyager 1 became the first man-made spacecraft to enter interstellar space.</p>\r\n                                            <p>Outer space represents a challenging environment for human exploration because of the dual hazards of vacuum and radiation. <a href="#">Microgravity</a> also has a negative effect on human physiology that causes both muscle atrophy and bone loss. In addition to solving all of these health and environmental issues, humans will also need to find a way to significantly reduce the cost of getting into space if they want to become a space faring civilization. Proposed concepts for doing this are non-rocket spacelaunch, momentum exchange tethers and space elevators.</p>\r\n                                            <h4>Discovery</h4>\r\n                                            <p>In 350 BC, <i>Greek philosopher Aristotle</i> suggested that nature abhors a vacuum, a principle that became known as the horror vacui. This concept built upon a 5th-century BC ontological argument by the Greek philosopher Parmenides, who denied the possible existence of a void in space.[8] Based on this idea that a vacuum could not exist, in the West it was widely held for many centuries that space could not be empty. As late as the 17th century, the French philosopher René Descartes argued that the entirety of space must be filled.</p>\r\n                                            <p>In ancient China, there were various schools of thought concerning the nature of the heavens, some of which bear a resemblance to the modern understanding. In the 2nd century, astronomer Zhang Heng became convinced that space must be infinite, extending well beyond the mechanism that supported the Sun and the stars. The surviving books of the Hsüan Yeh school said that the heavens were boundless, "empty and void of substance". Likewise, the "sun, moon, and the company of stars float in the empty space, moving or standing still".</p>\r\n                                            <h4>Formation and state</h4>\r\n                                            <p>According to the Big Bang theory, the Universe originated in an extremely hot and dense state about 13.8 billion years ago and began expanding rapidly. About 380,000 years later the Universe had cooled sufficiently to allow protons and electrons to combine and form hydrogen—the so-called recombination epoch. When this happened, matter and energy became decoupled, allowing photons to travel freely through space. The matter that remained following the initial expansion has since undergone gravitational collapse to create stars, galaxies and other astronomical objects, leaving behind a deep vacuum that forms what is now called outer space. As light has a finite velocity, this theory also constrains the size of the directly observable Universe. This leaves open the question as to whether the Universe is finite or infinite.</p>', 'post_1.jpg', NULL, '2015-05-10 21:05:29', '2015-11-02 20:04:00', 0, 5),
(2, 2, 1, 1, 'Nature', '<p>Nature, in the broadest sense, is equivalent to the natural, physical, or material world or universe. "Nature" refers to the phenomena of the physical world, and also to life in general. It ranges in scale from the subatomic to the cosmic.</p>                                ', '<p>There is no firm boundary where space begins. However the Kármán line, at an altitude of 100 km (62 mi) above sea level, is conventionally used as the start of outer space in space treaties and for aerospace records keeping. The framework for international space law was established by the Outer Space Treaty, which was passed by the United Nations in 1967. This treaty precludes any claims of national sovereignty and permits all states to freely explore outer space. In 1979, the Moon Treaty made the surfaces of objects such as planets, as well as the orbital space around these bodies, the jurisdiction of the international community. Despite the drafting of UN resolutions for the peaceful uses of outer space, anti-satellite weapons have been tested in Earth orbit.</p>', '', '//www.youtube.com/embed/kguSGXP3-_E', '2014-05-10 21:12:17', '2015-11-02 20:04:26', 0, 27),
(3, 2, 2, 1, 'Womans', '<p>A woman is a female human. The term woman is usually reserved for an adult, with the term girl being the usual term for a female child or adolescent. However, the term woman is also sometimes used to identify a female human.</p>', '<p><strong>Humans began</strong> the physical exploration of space during the 20th century with the advent of high-altitude balloon flights, followed by manned rocket launches. Earth orbit was first achieved by Yuri Gagarin of the Soviet Union in 1961 and unmanned spacecraft have since reached all of the known planets in the Solar System. Due to the high cost of getting into space, manned spaceflight has been limited to low Earth orbit and the Moon. In August 2012, Voyager 1 became the first man-made spacecraft to enter interstellar space.</p>', 'post_2.jpg', NULL, '2015-05-10 21:14:21', '2015-05-21 04:15:30', 1, 22),
(4, 3, 2, 3, 'History', '<p>History (from Greek ???????, historia, meaning "inquiry, knowledge acquired by investigation") is the study of the past, specifically how it relates to humans. It is an umbrella term that relates to past events as well as the memory, discovery, collection, organization, presentation, and interpretation of information about these events.</p>', '<p>Outer space represents a challenging environment for human exploration because of the dual hazards of vacuum and radiation. <a href="#">Microgravity</a> also has a negative effect on human physiology that causes both muscle atrophy and bone loss. In addition to solving all of these health and environmental issues, humans will also need to find a way to significantly reduce the cost of getting into space if they want to become a space faring civilization. Proposed concepts for doing this are non-rocket spacelaunch, momentum exchange tethers and space elevators.</p>                                       ', NULL, NULL, '2015-05-08 21:15:55', '2015-05-14 00:00:00', 0, 1),
(5, 4, 1, NULL, 'Geography', '<p>Geography (from Greek ???????, historia, meaning "inquiry, knowledge acquired by investigation") is the study of the past, specifically how it relates to humans. It is an umbrella term that relates to past events as well as the memory, discovery, collection, organization, presentation, and interpretation of information about these events.</p>\r\n                                                    ', '<p>History (from Greek ???????, historia, meaning "inquiry, knowledge acquired by investigation") is the study of the past, specifically how it relates to humans. It is an umbrella term that relates to past events as well as the memory, discovery, collection, organization, presentation, and interpretation of information about these events.</p>\r\n                                                    <ol>\r\n                                                        <li>Demographic history</li>\r\n                                                        <li>Black history</li>\r\n                                                        <li>History of education</li>\r\n                                                        <li>Ethnic history</li>\r\n                                                        <li>Family history</li>\r\n                                                        <li>Labor history</li>\r\n                                                        <li>Rural history</li>\r\n                                                        <li>Urban history</li>                                                        \r\n                                                    </ol>\r\n                                                    <p>Stories common to a particular culture, but not supported by external sources (such as the tales surrounding King Arthur) are usually classified as cultural heritage or legends, because they do not support the "disinterested investigation" required of the discipline of history.[10][11] Herodotus, a 5th-century BC Greek historian is considered within the Western tradition to be the "father of history", and, along with his contemporary Thucydides, helped form the foundations for the modern study of human history.</p>\r\n                                               ', NULL, NULL, '2015-05-06 21:20:37', '2015-05-16 01:40:47', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `categorie_article`
--

CREATE TABLE IF NOT EXISTS `categorie_article` (
  `CATEGORIE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  PRIMARY KEY (`CATEGORIE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categorie_article`
--

INSERT INTO `categorie_article` (`CATEGORIE_ID`, `NOM`, `DESCRIPTION`) VALUES
(1, 'GENERAL', 'Information d''ordre général'),
(2, 'UNIVERSITE', 'Information concernant les étudiants'),
(3, 'POLITIQUE', ''),
(4, 'ECONOMIQUE', '');

-- --------------------------------------------------------

--
-- Table structure for table `categorie_filiere`
--

CREATE TABLE IF NOT EXISTS `categorie_filiere` (
  `CATEGORIE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) NOT NULL,
  `SLUG` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `SUPPRIMER` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CATEGORIE_ID`),
  UNIQUE KEY `NOM` (`NOM`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `categorie_filiere`
--

INSERT INTO `categorie_filiere` (`CATEGORIE_ID`, `NOM`, `SLUG`, `DESCRIPTION`, `SUPPRIMER`) VALUES
(1, 'Informatique', 'informatique', NULL, 0),
(2, 'Mécanique', 'mecanique', NULL, 0),
(3, 'Gestion et Administration', 'gestion-administration', NULL, 0),
(4, 'Electronique-Electrotechnique', 'electronique-electrotechnique', NULL, 0),
(5, 'Télécommunication', 'telecommunication', NULL, 0),
(6, 'Travaux publics', 'travaux-publics', NULL, 0),
(7, 'Finance', 'finance', NULL, 0),
(8, 'Economie', 'economie', NULL, 0),
(9, 'Art', 'art', NULL, 0),
(10, 'Architecture', 'architecture', NULL, 0),
(11, 'Culture', 'culture', NULL, 0),
(12, 'Gestion de l''environnement', 'gestion-environnement', NULL, 0),
(13, 'Géologie', 'geologie', NULL, 0),
(14, 'Sciences Humaines', 'sciences-humaines', NULL, 0),
(15, 'Sciences Juridiques et Politiques', 'sciences-juridiques-politiques', NULL, 0),
(16, 'Commerce', 'commerce', NULL, 0),
(17, 'Biologie', 'biologie', NULL, 0),
(18, 'Physique', 'physique', NULL, 0),
(19, 'Mathémaatiques', 'mathematiques', NULL, 0),
(20, 'Géotechnique', 'geotechnique', NULL, 0),
(21, 'Santé', 'sante', NULL, 0),
(22, 'Chimie', 'chimie', NULL, 0),
(23, 'Ménuserie', 'menuserie', NULL, 0),
(24, 'Stylisme et Couture', 'stylisme-couture', NULL, 0),
(25, 'Logistique et transport', 'logistique-transport', NULL, 0),
(26, 'Energie', 'energie', NULL, 0),
(27, 'Alimentation', 'alimentation', NULL, 0),
(28, 'Mines et Hydrocarbures', 'mines-hydrocarbures', NULL, 0),
(29, 'Cinéma', 'cinema', NULL, 0),
(30, 'Ecosystème', 'ecosysteme', NULL, 0),
(31, 'Halieutiques', 'halieutiques', NULL, 0),
(32, 'Ondes et Transmission', 'ondes-transmission', NULL, 0),
(33, 'Technique et Normes', 'technique-normes', NULL, 0),
(35, 'Lettres et droit', 'lettres-droit', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `commentaire_article`
--

CREATE TABLE IF NOT EXISTS `commentaire_article` (
  `COMMENTAIRE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `PERSONNE_ID` bigint(12) NOT NULL,
  `ARTICLE_ID` bigint(12) NOT NULL,
  `CONTENU` text NOT NULL,
  `DATE_PUBLICATION` datetime NOT NULL,
  `TYPE` varchar(15) NOT NULL,
  `REPONSE_ID` bigint(12) DEFAULT NULL,
  PRIMARY KEY (`COMMENTAIRE_ID`),
  KEY `FK_PERSONNE` (`PERSONNE_ID`),
  KEY `FK_ARTICLE` (`ARTICLE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `commentaire_article`
--

INSERT INTO `commentaire_article` (`COMMENTAIRE_ID`, `PERSONNE_ID`, `ARTICLE_ID`, `CONTENU`, `DATE_PUBLICATION`, `TYPE`, `REPONSE_ID`) VALUES
(1, 2, 3, 'We happy? Vincent, we happy?', '2015-05-06 03:56:11', 'commentaire', NULL),
(2, 1, 3, 'Yeeees we happy!', '2015-05-21 03:57:13', 'commentaire', NULL),
(3, 1, 3, 'merci beaucoup pour le test', '2015-05-26 00:27:10', 'commentaire', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commentaire_filiere`
--

CREATE TABLE IF NOT EXISTS `commentaire_filiere` (
  `COMMENTAIRE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `PERSONNE_ID` bigint(12) NOT NULL,
  `FILIERE_ID` bigint(12) NOT NULL,
  `CONTENU` text NOT NULL,
  `DATE_PUBLICATION` datetime NOT NULL,
  PRIMARY KEY (`COMMENTAIRE_ID`),
  KEY `PERSONNE_ID` (`PERSONNE_ID`),
  KEY `FILIERE_ID` (`FILIERE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `commentaire_filiere`
--


-- --------------------------------------------------------

--
-- Table structure for table `commentaire_universite`
--

CREATE TABLE IF NOT EXISTS `commentaire_universite` (
  `COMMENTAIRE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `PERSONNE_ID` bigint(12) NOT NULL,
  `UNIVERSITE_ID` bigint(12) NOT NULL,
  `CONTENU` text NOT NULL,
  `DATE_PUBLICATION` datetime NOT NULL,
  `TYPE` varchar(15) NOT NULL COMMENT 'quel est le type de commentaire une reponse ou une commentaire simple',
  `REPONSE_ID` bigint(12) DEFAULT NULL COMMENT 'quel est l''id du comment au quel on repond',
  `POSITION_ID` bigint(12) DEFAULT NULL COMMENT 'quel est l''id du commentaire deja repondu au quel on repond',
  PRIMARY KEY (`COMMENTAIRE_ID`),
  KEY `PERSONNE_ID` (`PERSONNE_ID`),
  KEY `UNIVERSITE_ID` (`UNIVERSITE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `commentaire_universite`
--

INSERT INTO `commentaire_universite` (`COMMENTAIRE_ID`, `PERSONNE_ID`, `UNIVERSITE_ID`, `CONTENU`, `DATE_PUBLICATION`, `TYPE`, `REPONSE_ID`, `POSITION_ID`) VALUES
(1, 2, 1, 'Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.', '2014-10-24 01:32:47', 'commentaire', NULL, NULL),
(2, 1, 1, 'What? What did you say? It''s not even a language...', '2014-10-27 01:34:42', 'reponse', 1, NULL),
(3, 1, 1, 'We happy? Vincent, we happy?', '2014-05-21 01:36:48', 'commentaire', NULL, NULL),
(4, 2, 1, 'Yeeees we happy!', '2015-05-22 01:38:03', 'reponse', 1, NULL),
(5, 2, 1, 'l''université de douala forme aussi en vue de l''obtention d''une certification en Oracle.', '2015-03-10 01:39:42', 'commentaire', NULL, NULL),
(6, 1, 1, 'merci beaucoup pour cet avancé', '2015-05-23 13:54:47', 'reponse', 1, 2),
(7, 2, 1, 'comment tu trouves cette idée', '2015-05-29 13:57:09', 'reponse', 1, 2),
(8, 1, 1, 'tu vas ou comme ca ', '2015-05-24 13:58:44', 'reponse', 1, 6),
(9, 2, 1, 'tu trouves ça comment toi au juste hein', '2015-05-15 14:03:12', 'reponse', 1, 6),
(10, 1, 1, 'tu avances quand même', '2015-05-26 00:57:17', 'commentaire', NULL, NULL),
(11, 3, 1, 'pourquooi pas elle', '2015-05-26 01:10:44', 'commentaire', NULL, NULL),
(17, 1, 1, 'pourquoi elle?', '2015-05-26 02:18:15', 'reponse', 0, NULL),
(18, 2, 1, 'l''université de douala forme aussi en vue de l''obtention d''une certification en Oracle. en plus de l''autre', '2015-05-26 02:22:53', 'commentaire', NULL, NULL),
(19, 2, 1, 'tres et toi alors?', '2015-05-26 02:27:13', 'reponse', 0, 0),
(20, 2, 1, '', '2015-05-26 02:33:55', 'reponse', 1, 6),
(21, 2, 1, 'merci c''est rien?', '2015-05-26 02:38:16', 'reponse', 1, 6),
(22, 1, 1, 'pourquoi pas elle?', '2015-05-26 02:40:28', 'reponse', 11, NULL),
(23, 6, 1, 'faut pas rester sur place', '2015-05-26 02:49:20', 'reponse', 10, NULL),
(24, 2, 1, 'j''espere que ca marche', '2015-05-26 02:52:09', 'reponse', 5, NULL),
(25, 1, 2, 'il faut un debut à tout n''est ce pas', '2015-05-26 02:54:09', 'commentaire', NULL, NULL),
(26, 6, 2, 'tu en penses koi', '2015-05-26 02:56:05', 'reponse', 25, NULL),
(27, 2, 3, 'est ce que on forme en MIP la-bas', '2015-05-26 02:59:04', 'commentaire', NULL, NULL),
(28, 1, 3, 'mais biensur et il y''a de cala fort longtemps', '2015-05-26 03:01:14', 'reponse', 27, NULL),
(29, 1, 3, 'a mrche', '2015-05-26 23:23:42', 'commentaire', NULL, NULL),
(30, 1, 3, 'a mrche', '2015-05-26 23:23:45', 'commentaire', NULL, NULL),
(31, 1, 3, 'a mrche', '2015-05-26 23:23:45', 'commentaire', NULL, NULL),
(32, 1, 3, 'a mrche', '2015-05-26 23:23:46', 'commentaire', NULL, NULL),
(33, 1, 3, 'a mrche', '2015-05-26 23:23:47', 'commentaire', NULL, NULL),
(34, 1, 3, 'a mrche', '2015-05-26 23:23:48', 'commentaire', NULL, NULL),
(35, 1, 3, 'a mrche', '2015-05-26 23:23:48', 'commentaire', NULL, NULL),
(36, 1, 3, 'a mrche', '2015-05-26 23:23:49', 'commentaire', NULL, NULL),
(37, 1, 3, 'a mrche', '2015-05-26 23:23:49', 'commentaire', NULL, NULL),
(38, 1, 3, 'ca marche', '2015-05-26 23:24:43', 'commentaire', NULL, NULL),
(39, 7, 3, 'que ca marche', '2015-05-27 00:09:42', 'reponse', 38, NULL),
(40, 7, 3, 'que ca marche', '2015-05-27 00:09:44', 'reponse', 38, NULL),
(41, 7, 3, 'que ca marche', '2015-05-27 00:09:44', 'reponse', 38, NULL),
(42, 7, 3, 'que ca marche', '2015-05-27 00:09:45', 'reponse', 38, NULL),
(43, 7, 3, 'que ca marche', '2015-05-27 00:09:45', 'reponse', 38, NULL),
(44, 7, 3, 'que ca marche', '2015-05-27 00:09:46', 'reponse', 38, NULL),
(45, 7, 3, 'que ca marche', '2015-05-27 00:09:46', 'reponse', 38, NULL),
(46, 7, 3, 'que ca marche', '2015-05-27 00:09:46', 'reponse', 38, NULL),
(47, 8, 1, 'gbbfh dtht ;hdltlbt tlebmetbmthn tlnbetmlnet trmnmtenùetùnet temn;mtej*rymj; fjh fgjfljfùhljh fhj u ky yukiy yilougf yjfyk ulkyi_fhj ', '2015-06-08 04:03:04', 'commentaire', NULL, NULL),
(48, 8, 1, 'gbbfh dtht ;hdltlbt tlebmetbmthn tlnbetmlnet trmnmtenùetùnet temn;mtej*rymj; fjh fgjfljfùhljh fhj u ky yukiy yilougf yjfyk ulkyi_fhj ', '2015-06-08 04:03:06', 'commentaire', NULL, NULL),
(49, 8, 1, 'gbbfh dtht ;hdltlbt tlebmetbmthn tlnbetmlnet trmnmtenùetùnet temn;mtej*rymj; fjh fgjfljfùhljh fhj u ky yukiy yilougf yjfyk ulkyi_fhj ', '2015-06-08 04:03:09', 'commentaire', NULL, NULL),
(50, 8, 1, 'gbbfh dtht ;hdltlbt tlebmetbmthn tlnbetmlnet trmnmtenùetùnet temn;mtej*rymj; fjh fgjfljfùhljh fhj u ky yukiy yilougf yjfyk ulkyi_fhj ', '2015-06-08 04:03:09', 'commentaire', NULL, NULL),
(51, 8, 1, 'gbbfh dtht ;hdltlbt tlebmetbmthn tlnbetmlnet trmnmtenùetùnet temn;mtej*rymj; fjh fgjfljfùhljh fhj u ky yukiy yilougf yjfyk ulkyi_fhj ', '2015-06-08 04:03:11', 'commentaire', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `concours_matiere`
--

CREATE TABLE IF NOT EXISTS `concours_matiere` (
  `CONCOURS_ID` bigint(20) NOT NULL,
  `MATIERE_ID` bigint(20) NOT NULL,
  `DUREE` int(11) NOT NULL,
  KEY `FK_MATIERE` (`MATIERE_ID`),
  KEY `FK_CONCOURS` (`CONCOURS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `concours_matiere`
--

INSERT INTO `concours_matiere` (`CONCOURS_ID`, `MATIERE_ID`, `DUREE`) VALUES
(2, 1, 90),
(2, 3, 90),
(2, 2, 120);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `CONTACT_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `BP` varchar(100) DEFAULT NULL,
  `TELEPHONE_1` varchar(12) DEFAULT NULL,
  `TELEPHONE_2` varchar(12) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `SITE` varchar(100) DEFAULT NULL,
  `SUPPRIMER` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CONTACT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=430715173731 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`CONTACT_ID`, `BP`, `TELEPHONE_1`, `TELEPHONE_2`, `EMAIL`, `SITE`, `SUPPRIMER`) VALUES
(150715113650, '96 DSCHANG', '233 45 13 81', NULL, NULL, NULL, 0),
(150722134014, '', '674-20-07-54', '', 'bouwou02@yahoo.fr', 'http://', 0),
(150722134106, '', '674-20-07-54', '', 'bouwou02@yahoo.fr', 'http://', 0),
(150722134843, '', '674-20-07-54', '', 'bouwou02@yahoo.fr', 'http://', 0),
(150722141728, '53 Bandjoun', '674-20-07-54', '670-61-10-33', 'bouwou02@yahoo.fr', NULL, 0),
(150723081330, NULL, '674-20-07-54', '670-61-10-33', 'justlonam@yahoo.fr', NULL, 0),
(150723082911, '', '674-20-07-54', '', 'juvetdinho@yahoo.ca', '', 0),
(151208161432, '53 Bandjoun', '674-20-07-54', NULL, 'bgomne@gmail.com', NULL, 0),
(151208162845, '', '999-99-99-99', '', 'justlosdfnam@yahoo.fr', '', 0),
(151211171406, '', '674-20-07-54', '', 'bgomne@icicomtech.com', '', 0),
(151211171537, '', '674-83-07-16', '', 'botiwoman@yahoo.fr', '', 0),
(220715133102, '', '674-20-07-54', '', 'bouwou02@yahoo.fr', 'http://', 0),
(430715173730, '2701 Douala-Cameroun', '233-40-11-28', '670-61-10-33', 'infos.udla@univdouala.com', 'www.univ-douala.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE IF NOT EXISTS `departement` (
  `DEPARTEMENT_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `UNIVERSITE_ID` bigint(12) NOT NULL,
  `NOM` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `SIGLE` varchar(255) DEFAULT NULL,
  `SUPPRIMER` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`DEPARTEMENT_ID`),
  KEY `UNIVERSITE_ID` (`UNIVERSITE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151211171538 ;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`DEPARTEMENT_ID`, `UNIVERSITE_ID`, `NOM`, `DESCRIPTION`, `SIGLE`, `SUPPRIMER`) VALUES
(1, 3, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0),
(2, 13, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0),
(3, 4, 'GENERAL', NULL, NULL, 0),
(6, 2, 'Faculté de Lettres et Sciences Humaines', 'Pour les bacs littéraires', 'FLSH', 0),
(7, 2, 'Faculté des Sciences Economiques et de Gestion', NULL, 'FSEG', 0),
(8, 2, 'Faculté des Sciences Juridiques et Politiques', NULL, 'FSJP', 0),
(9, 2, 'Faculté des Sciences', 'Regroupe les filières scientifiques', 'FS', 0),
(10, 1, 'Faculté des Sciences Economiques et de Gestion Appliquées', NULL, 'FSEGA', 0),
(11, 7, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0),
(12, 8, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0),
(13, 5, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0),
(14, 9, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0),
(15, 10, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0),
(16, 11, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0),
(17, 6, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0),
(18, 1, 'Faculté des Sciences', 'Regroupe les filières scientifiques', 'FS', 0),
(19, 1, 'Académie Internet', NULL, 'AI', 0),
(20, 1, 'Centre de Physique Atomique, Moléculaire Optique et Quantique', NULL, 'CEPAMOQ', 0),
(21, 1, 'Faculté des Lettres et Sciences Humaines', NULL, 'FLSH', 0),
(22, 1, 'Faculté de Sciences Juridique et politique', NULL, 'FSJP', 0),
(151209095511, 4, 'bouwa', 'la filière informatique a crée', 'BW', 0),
(151209135836, 11, 'bow', '', '', 0),
(151209140841, 13, 'sdf', '', '', 0),
(151209140944, 9, 'fdssfg', '', '', 1),
(151211143731, 4, 'bouwou', '', 'bw', 0),
(151211171406, 151211171406, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0),
(151211171537, 151211171537, 'GENERAL', 'l''option général rassemble toutes les filières dont le département constitue directement la filière', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE IF NOT EXISTS `filiere` (
  `FILIERE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `CATEGORIE_ID` bigint(12) NOT NULL,
  `DEPARTEMENT_ID` bigint(12) NOT NULL,
  `NOM` varchar(100) NOT NULL,
  `SLUG` varchar(255) NOT NULL,
  `SIGLE` varchar(10) DEFAULT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `TYPE_FORMATION` varchar(50) DEFAULT NULL,
  `NIVEAU_FORMATION` varchar(50) DEFAULT NULL,
  `SUPPRIMER` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`FILIERE_ID`),
  KEY `CATEGORIE_ID` (`CATEGORIE_ID`),
  KEY `DEPARTEMENT_ID` (`DEPARTEMENT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=216 ;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`FILIERE_ID`, `CATEGORIE_ID`, `DEPARTEMENT_ID`, `NOM`, `SLUG`, `SIGLE`, `DESCRIPTION`, `TYPE_FORMATION`, `NIVEAU_FORMATION`, `SUPPRIMER`) VALUES
(1, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(2, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(3, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(4, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(5, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(6, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(7, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique;Professionnel', 'DUT', 0),
(8, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(11, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(12, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(13, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(14, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(15, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(16, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(17, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(18, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(19, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Teechnologique', 'DUT', 0),
(20, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(21, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(24, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(25, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(26, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(27, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(28, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(29, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(30, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(31, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(32, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(33, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(34, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(35, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(36, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(39, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(40, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(41, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(42, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(43, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(44, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(45, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(46, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(47, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(48, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(49, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(50, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(51, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(52, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(53, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(54, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(55, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(56, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(57, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(58, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(59, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(60, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(61, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(62, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(63, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(64, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(65, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(66, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(67, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(68, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(69, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(70, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(71, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(72, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', '', 'DUT', 0),
(73, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(74, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(75, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(76, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(77, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(78, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(79, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(80, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(81, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(82, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(83, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(84, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(85, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(86, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(87, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(88, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Professionnel', 'DUT', 0),
(89, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(90, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(91, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(92, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(93, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(94, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(95, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(96, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(97, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(98, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(99, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(100, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(101, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(102, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(103, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(104, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(105, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(106, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(107, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(108, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(109, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(110, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(111, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(112, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(113, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(114, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(115, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(116, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', '', 'DUT', 0),
(117, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(118, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(119, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(120, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(121, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(122, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(123, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(124, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(125, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(126, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(127, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(128, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(129, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(130, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(131, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(132, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(133, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(134, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(135, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(136, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(137, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(138, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(139, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(140, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(141, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(142, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(143, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(144, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(145, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(146, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(147, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(148, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(149, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Technologique', 'DUT', 0),
(150, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(151, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(152, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(153, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(154, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(155, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(156, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(157, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(158, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(159, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(160, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(161, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(162, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(163, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(164, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(165, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(166, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(167, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(168, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(169, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(170, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(171, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(172, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(173, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(174, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(175, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(176, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(177, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(178, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(179, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(180, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(181, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(182, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(183, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(184, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(185, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(186, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(187, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', NULL, 'DUT', 0),
(188, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(189, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(190, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(191, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(192, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(193, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(194, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(195, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(196, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(197, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(198, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(199, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(200, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(201, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(202, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(203, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(204, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(205, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(206, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(207, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(208, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(209, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(210, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(211, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(212, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(213, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(214, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0),
(215, 1, 1, 'Informatique de gestion', 'informatique-de-gestion', 'IG', '<qsd', 'Général', 'DUT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `filiere_serie`
--

CREATE TABLE IF NOT EXISTS `filiere_serie` (
  `FILIERE_ID` bigint(12) NOT NULL,
  `SERIE_ID` bigint(12) NOT NULL,
  PRIMARY KEY (`FILIERE_ID`,`SERIE_ID`),
  KEY `SERIE_ID` (`SERIE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filiere_serie`
--


-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `MATIERE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `SUPPRIMER` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`MATIERE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `matiere`
--

INSERT INTO `matiere` (`MATIERE_ID`, `NOM`, `DESCRIPTION`, `SUPPRIMER`) VALUES
(1, 'Mathématiques', 'maths', 0),
(2, 'Culture Générale', 'culture generale', 0),
(3, 'Matière de spécialité', 'matiere de specialite', 0);

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `PERSONNE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `IDENTIFIANT` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `DATE_CREATION` date NOT NULL,
  `CONTACT` varchar(255) DEFAULT NULL,
  `STATUT` varchar(50) NOT NULL,
  `FONCTION` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PERSONNE_ID`),
  UNIQUE KEY `EMAIL` (`EMAIL`),
  UNIQUE KEY `IDENTIFIANT` (`IDENTIFIANT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`PERSONNE_ID`, `NOM`, `PRENOM`, `IDENTIFIANT`, `PASSWORD`, `EMAIL`, `DATE_CREATION`, `CONTACT`, `STATUT`, `FONCTION`) VALUES
(1, 'Bouwa', 'Boris', 'Boris', '521d98b1da65840a303277e5506d73eedf31dd9a', 'bouwou02@yahoo.fr', '2015-05-09', '674200754', 'Universitaire', 'Informaticien'),
(2, 'BouWou', 'Bow', 'bouwou', '39cf8db684d9d5cdc1d24d309180b23dfd269425', 'bgomne@gmail.com', '2015-05-10', '670611033', 'Administrateur', 'Informaticien'),
(3, NULL, 'Manuella', NULL, '', 'botiwoman@yahoo.fr', '2015-05-26', NULL, 'visiteur', NULL),
(5, NULL, '', NULL, '', '', '2015-05-26', NULL, 'visiteur', NULL),
(6, NULL, 'franck', NULL, '', 'bgomne@icicomtech.com', '2015-05-26', NULL, 'visiteur', NULL),
(7, NULL, 'test', NULL, '', 'bouwou@yahoo.fr', '2015-05-27', NULL, 'visiteur', NULL),
(8, NULL, 'lonam', NULL, '', 'justlonam@yahoo.fr', '2015-06-08', NULL, 'visiteur', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presentation_filiere`
--

CREATE TABLE IF NOT EXISTS `presentation_filiere` (
  `PRESENTATION_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `FILIERE_ID` bigint(12) NOT NULL,
  `CONENU` text NOT NULL,
  `DATE_PUBLICATION` datetime NOT NULL,
  PRIMARY KEY (`PRESENTATION_ID`),
  KEY `FILIERE_ID` (`FILIERE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `presentation_filiere`
--


-- --------------------------------------------------------

--
-- Table structure for table `presentation_universite`
--

CREATE TABLE IF NOT EXISTS `presentation_universite` (
  `PRESENTATION_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `UNIVERSITE_ID` bigint(12) NOT NULL,
  `CONTENU` text NOT NULL,
  `IMAGE` varchar(50) DEFAULT NULL,
  `DATE_PUBLICATION` datetime NOT NULL,
  PRIMARY KEY (`PRESENTATION_ID`),
  KEY `UNIVERSITE_ID` (`UNIVERSITE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `presentation_universite`
--

INSERT INTO `presentation_universite` (`PRESENTATION_ID`, `UNIVERSITE_ID`, `CONTENU`, `IMAGE`, `DATE_PUBLICATION`) VALUES
(1, 1, '<p> Avec une grande variété d''étudiants, la Faculté de Médecine  et de Sciences Biomédicales de Yaoundé est le plus grand centre de formation et de recherche médicales du Cameroun.</p>\r\n									<p>Partenaire des meilleurs hôpitaux universitaires nationaux, notre Faculté de médecine bénéficie pleinement de l’excellence Camerounaise  en matière de soins, de formation clinique et de recherche scientifique.</p>                               \r\n                                    <p>Nous venons de vivre un changement d’hommes à la tête de l’Université de Yaoundé 1 et de la Faculté de Médecine et des Sciences Biomédi-cales. Qui dit changement dit nouvelle vision et nouvelle impulsion. C’est dans ce sens qu’il faut comprendre la feuille de route prescrite par Monsieur le Recteur de l’UY1 le jour de notre installation et qui vise à faire de notre Faculté, l’une des meilleures du monde.</p>\r\n                                    <p>Ce n’est d’ailleurs que la traduction des hautes instructions du Chef de l’Etat Paul Biya et que met en œuvre le Ministre de l’enseignement supérieur. Cette noble ambition va reposer sur trois piliers :</p>', 'nature.jpg', '2015-04-10 16:13:06'),
(2, 3, '<p> Avec une grande variété d''étudiants, la Faculté de Médecine  et de Sciences Biomédicales de Yaoundé est le plus grand centre de formation et de recherche médicales du Cameroun.</p>\r\n									<p>Partenaire des meilleurs hôpitaux universitaires nationaux, notre Faculté de médecine bénéficie pleinement de l’excellence Camerounaise  en matière de soins, de formation clinique et de recherche scientifique.</p>                               \r\n                                    <p>Nous venons de vivre un changement d’hommes à la tête de l’Université de Yaoundé 1 et de la Faculté de Médecine et des Sciences Biomédi-cales. Qui dit changement dit nouvelle vision et nouvelle impulsion. C’est dans ce sens qu’il faut comprendre la feuille de route prescrite par Monsieur le Recteur de l’UY1 le jour de notre installation et qui vise à faire de notre Faculté, l’une des meilleures du monde.</p>\r\n                                    <p>Ce n’est d’ailleurs que la traduction des hautes instructions du Chef de l’Etat Paul Biya et que met en œuvre le Ministre de l’enseignement supérieur. Cette noble ambition va reposer sur trois piliers :</p>', 'nature.jpg', '2015-04-10 22:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `reponse_filiere`
--

CREATE TABLE IF NOT EXISTS `reponse_filiere` (
  `REPONSE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `COMMENTAIRE_ID` bigint(12) NOT NULL,
  `CONTENU` text NOT NULL,
  `DATE_PUBLICATION` datetime NOT NULL,
  PRIMARY KEY (`REPONSE_ID`),
  KEY `COMMENTAIRE_ID` (`COMMENTAIRE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `reponse_filiere`
--


-- --------------------------------------------------------

--
-- Table structure for table `reponse_universite`
--

CREATE TABLE IF NOT EXISTS `reponse_universite` (
  `REPONSE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `COMMENTAIRE_ID` bigint(12) NOT NULL,
  `CONTENU` text NOT NULL,
  `DATE_PUBLICATION` datetime NOT NULL,
  PRIMARY KEY (`REPONSE_ID`),
  KEY `COMMENTAIRE_ID` (`COMMENTAIRE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `reponse_universite`
--


-- --------------------------------------------------------

--
-- Table structure for table `serie`
--

CREATE TABLE IF NOT EXISTS `serie` (
  `SERIE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SERIE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `serie`
--


-- --------------------------------------------------------

--
-- Table structure for table `serie_matiere`
--

CREATE TABLE IF NOT EXISTS `serie_matiere` (
  `SERIE_ID` bigint(12) NOT NULL,
  `MATIERE_ID` bigint(12) NOT NULL,
  PRIMARY KEY (`SERIE_ID`,`MATIERE_ID`),
  KEY `MATIERE_ID` (`MATIERE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serie_matiere`
--


-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `TYPE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) NOT NULL,
  `DESCRIPTION` text,
  `SLUG` varchar(50) DEFAULT NULL,
  `CERTIFICATION` varchar(20) NOT NULL DEFAULT 'En attente',
  `SUPPRIMER` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`TYPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151211170427 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`TYPE_ID`, `NOM`, `DESCRIPTION`, `SLUG`, `CERTIFICATION`, `SUPPRIMER`) VALUES
(1, 'Université d''état', NULL, 'Universite-etat', 'Certifié', 0),
(2, 'Ecole d''ingénierie', NULL, 'Ecole-ingenierie', 'Certifié', 0),
(3, 'Ecole de médécine', NULL, 'Ecole-medecine', 'Certifié', 0),
(4, 'Autre université', NULL, 'Autre-universite', 'Certifié', 0),
(151210102409, 'sdf', 'test', 'sdf', 'En attente', 0),
(151210103600, 'pdeq', 'qsdqon', 'pdeq', '', 0),
(151210105246, 'Plate forme d\\''àuto école', 'tout', 'plate-forme-dauto-ecole', 'En attente', 0),
(151210114623, 'Plate forme d''àuto école', 'voiture', 'plate-forme-auto-ecole', 'En attente', 0),
(151210115945, 'bouwou', 'bouwou', 'bouwou', 'En attente', 0),
(151210120216, 'test', 'test', 'test', 'Certifié', 0),
(151211162935, 'bow', 'thc', 'bow', 'Certifié', 0),
(151211163009, 'rec', 'dedo', 'rec', 'En attente', 0),
(151211170426, 'gdgd', 'qdcsqd', 'gdgd', 'En attente', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type_universite`
--

CREATE TABLE IF NOT EXISTS `type_universite` (
  `TYPE_ID` bigint(12) NOT NULL,
  `UNIVERSITE_ID` bigint(12) NOT NULL,
  PRIMARY KEY (`TYPE_ID`,`UNIVERSITE_ID`),
  KEY `FK_TYPE` (`TYPE_ID`),
  KEY `FK_UNIVERSITE` (`UNIVERSITE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_universite`
--

INSERT INTO `type_universite` (`TYPE_ID`, `UNIVERSITE_ID`) VALUES
(1, 12),
(1, 151208162845),
(2, 5),
(2, 12),
(2, 151208162845),
(2, 151211171537),
(3, 11),
(3, 151208162845),
(4, 5),
(4, 150722141728),
(4, 151208161432),
(4, 151211171406),
(4, 151211171537);

-- --------------------------------------------------------

--
-- Table structure for table `universite`
--

CREATE TABLE IF NOT EXISTS `universite` (
  `UNIVERSITE_ID` bigint(12) NOT NULL AUTO_INCREMENT,
  `PERSONNE_ID` bigint(12) NOT NULL DEFAULT '1',
  `CONTACT_ID` bigint(12) NOT NULL DEFAULT '430715173730',
  `NOM` varchar(50) NOT NULL,
  `NOM_COMPLET` varchar(100) DEFAULT NULL,
  `VILLE` varchar(50) NOT NULL,
  `REGION` varchar(50) NOT NULL,
  `STATUT` varchar(50) NOT NULL,
  `RESPONSABLE` varchar(100) DEFAULT NULL,
  `LOGO` varchar(255) DEFAULT NULL,
  `PARRAIN_ID` bigint(12) DEFAULT NULL,
  `CERTIFICATION` varchar(10) NOT NULL DEFAULT 'Certifié',
  `SUPPRIMER` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UNIVERSITE_ID`),
  KEY `FK_PERSONNE` (`PERSONNE_ID`),
  KEY `FK_CONTACT` (`CONTACT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151211171538 ;

--
-- Dumping data for table `universite`
--

INSERT INTO `universite` (`UNIVERSITE_ID`, `PERSONNE_ID`, `CONTACT_ID`, `NOM`, `NOM_COMPLET`, `VILLE`, `REGION`, `STATUT`, `RESPONSABLE`, `LOGO`, `PARRAIN_ID`, `CERTIFICATION`, `SUPPRIMER`) VALUES
(1, 1, 430715173730, 'UNIVERSITE DE DOUALA', NULL, 'DOUALA', 'LITTORAL', 'Public', NULL, NULL, NULL, 'Certifié', 0),
(2, 1, 430715173730, 'UNIVERSITE DE DSCHANG', NULL, 'DSCHANG', 'OUEST', 'Public', NULL, NULL, NULL, 'Certifié', 0),
(3, 1, 430715173730, 'IUT Fotso Victor', 'Institut Universitaire de Technologie Fotso Victor', 'BANDJOUN', 'OUEST', 'Public', NULL, NULL, 2, 'Certifié', 0),
(4, 1, 430715173730, 'FASA', 'Faculté d''Agronomie et des Sciences Agricoles', 'DSCHANG', 'OUEST', 'Public', NULL, NULL, 2, 'Certifié', 0),
(5, 1, 430715173730, 'IUT DE DOUALA', 'Institut Universitaire de Technologie', 'DOUALA', 'LITTORAL', 'Public', NULL, NULL, 1, 'Certifié', 0),
(6, 1, 430715173730, 'FGI', 'Faculté du Génie Industriel', 'DOUALA', 'LITTORAL', 'Public', NULL, NULL, 1, 'Certifié', 0),
(7, 1, 430715173730, 'ESSEC', 'Ecole Supérieure des Sciences Economiques et Commerciales', 'DOUALA', 'LITTORAL', 'Privée', NULL, NULL, 1, 'Certifié', 0),
(8, 1, 430715173730, 'ENSET', 'Ecole Normale Supérieure de l''Enseignement Technique', 'DOUALA', 'LITTORAL', 'Privée', NULL, NULL, 1, 'Certifié', 0),
(9, 1, 430715173730, 'IBA', 'Institut des Beaux Atrs', 'NKONGSAMBA', 'LITTORAL', 'Privée', NULL, NULL, 1, 'Certifié', 0),
(10, 1, 430715173730, 'ISH', 'Institut des Sciences Halieutiques', 'DOUALA', 'LITTORAL', 'Privée', NULL, NULL, 1, 'Certifié', 0),
(11, 1, 430715173730, 'FMSP', 'Faculté de Médecine et des Sciences Pharmaceutiques', 'DOUALA', 'LITTORAL', 'Privée', NULL, NULL, 1, 'Certifié', 0),
(12, 1, 430715173730, 'CEPAMOQ', 'Centre de Physique Atomique Moléculaire Optique et Quantique', 'DOUALA', 'LITTORAL', 'Privée', NULL, NULL, 1, 'Certifié', 0),
(13, 1, 430715173730, 'IBA', 'Institut des Beaux Arts', 'FOUMBAN', 'OUEST', 'Privée', NULL, NULL, 2, 'Certifié', 0),
(150722134843, 1, 150722134843, 'Allu bassa', 'TT', 'Douala', 'Littoral', 'Public', NULL, NULL, 3, 'En attente', 1),
(150722141728, 1, 150722141728, 'Allias', 'bouwoujzldzd bszju', 'Douala', 'Littoral', 'Public', NULL, NULL, 3, 'En attente', 0),
(150723081330, 1, 150723081330, 'Alliage', NULL, 'Doul', 'Littoral', 'Privée', NULL, NULL, 150722141728, 'En attente', 1),
(150723082911, 1, 150723082911, 'Test', NULL, 'Douala', 'Littoral', 'Privée', NULL, NULL, NULL, 'En attente', 1),
(151208161432, 1, 151208161432, 'BouWou', 'Bouwa Woukam', 'Douala', 'Littoral', 'Privée', NULL, NULL, NULL, 'En attente', 1),
(151208162845, 1, 151208162845, 'boris', 'boris', 'Douala', 'Littoral', 'Public', NULL, NULL, NULL, 'En attente', 1),
(151211171406, 1, 151211171406, 'pour', NULL, 'Douala', 'Littoral', 'Public', NULL, NULL, NULL, 'En attente', 0),
(151211171537, 1, 151211171537, 'aaaaa', NULL, 'Bandjoun', 'Ouest', 'Public', NULL, NULL, NULL, 'Certifié', 0);

-- --------------------------------------------------------

--
-- Table structure for table `universite_personne`
--

CREATE TABLE IF NOT EXISTS `universite_personne` (
  `PERSONNE_ID` bigint(12) NOT NULL,
  `UNIVERSITE_ID` bigint(12) NOT NULL,
  PRIMARY KEY (`PERSONNE_ID`,`UNIVERSITE_ID`),
  KEY `UNIVERSITE_ID` (`UNIVERSITE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `universite_personne`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `acces_concours`
--
ALTER TABLE `acces_concours`
  ADD CONSTRAINT `acces_concours_ibfk_1` FOREIGN KEY (`UNIVERSITE_ID`) REFERENCES `universite` (`UNIVERSITE_ID`);

--
-- Constraints for table `article_universite`
--
ALTER TABLE `article_universite`
  ADD CONSTRAINT `article_universite_ibfk_4` FOREIGN KEY (`CATEGORIE_ID`) REFERENCES `categorie_article` (`CATEGORIE_ID`),
  ADD CONSTRAINT `article_universite_ibfk_5` FOREIGN KEY (`PERSONNE_ID`) REFERENCES `personne` (`PERSONNE_ID`);

--
-- Constraints for table `commentaire_article`
--
ALTER TABLE `commentaire_article`
  ADD CONSTRAINT `commentaire_article_ibfk_1` FOREIGN KEY (`PERSONNE_ID`) REFERENCES `personne` (`PERSONNE_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaire_article_ibfk_2` FOREIGN KEY (`ARTICLE_ID`) REFERENCES `article_universite` (`ARTICLE_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `commentaire_filiere`
--
ALTER TABLE `commentaire_filiere`
  ADD CONSTRAINT `commentaire_filiere_ibfk_3` FOREIGN KEY (`PERSONNE_ID`) REFERENCES `personne` (`PERSONNE_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaire_filiere_ibfk_4` FOREIGN KEY (`FILIERE_ID`) REFERENCES `filiere` (`FILIERE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commentaire_universite`
--
ALTER TABLE `commentaire_universite`
  ADD CONSTRAINT `commentaire_universite_ibfk_3` FOREIGN KEY (`PERSONNE_ID`) REFERENCES `personne` (`PERSONNE_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaire_universite_ibfk_4` FOREIGN KEY (`UNIVERSITE_ID`) REFERENCES `universite` (`UNIVERSITE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `concours_matiere`
--
ALTER TABLE `concours_matiere`
  ADD CONSTRAINT `concours_matiere_ibfk_1` FOREIGN KEY (`CONCOURS_ID`) REFERENCES `acces_concours` (`CONCOURS_ID`),
  ADD CONSTRAINT `concours_matiere_ibfk_2` FOREIGN KEY (`MATIERE_ID`) REFERENCES `matiere` (`MATIERE_ID`);

--
-- Constraints for table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`UNIVERSITE_ID`) REFERENCES `universite` (`UNIVERSITE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_3` FOREIGN KEY (`CATEGORIE_ID`) REFERENCES `categorie_filiere` (`CATEGORIE_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `filiere_ibfk_4` FOREIGN KEY (`DEPARTEMENT_ID`) REFERENCES `departement` (`DEPARTEMENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filiere_serie`
--
ALTER TABLE `filiere_serie`
  ADD CONSTRAINT `filiere_serie_ibfk_3` FOREIGN KEY (`FILIERE_ID`) REFERENCES `filiere` (`FILIERE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `filiere_serie_ibfk_4` FOREIGN KEY (`SERIE_ID`) REFERENCES `serie` (`SERIE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presentation_filiere`
--
ALTER TABLE `presentation_filiere`
  ADD CONSTRAINT `presentation_filiere_ibfk_1` FOREIGN KEY (`FILIERE_ID`) REFERENCES `filiere` (`FILIERE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presentation_universite`
--
ALTER TABLE `presentation_universite`
  ADD CONSTRAINT `presentation_universite_ibfk_1` FOREIGN KEY (`UNIVERSITE_ID`) REFERENCES `universite` (`UNIVERSITE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reponse_filiere`
--
ALTER TABLE `reponse_filiere`
  ADD CONSTRAINT `reponse_filiere_ibfk_1` FOREIGN KEY (`COMMENTAIRE_ID`) REFERENCES `commentaire_filiere` (`COMMENTAIRE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reponse_universite`
--
ALTER TABLE `reponse_universite`
  ADD CONSTRAINT `reponse_universite_ibfk_1` FOREIGN KEY (`COMMENTAIRE_ID`) REFERENCES `commentaire_universite` (`COMMENTAIRE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `serie_matiere`
--
ALTER TABLE `serie_matiere`
  ADD CONSTRAINT `serie_matiere_ibfk_3` FOREIGN KEY (`SERIE_ID`) REFERENCES `serie` (`SERIE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `serie_matiere_ibfk_4` FOREIGN KEY (`MATIERE_ID`) REFERENCES `matiere` (`MATIERE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `type_universite`
--
ALTER TABLE `type_universite`
  ADD CONSTRAINT `type_universite_ibfk_1` FOREIGN KEY (`TYPE_ID`) REFERENCES `type` (`TYPE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `type_universite_ibfk_2` FOREIGN KEY (`UNIVERSITE_ID`) REFERENCES `universite` (`UNIVERSITE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `universite`
--
ALTER TABLE `universite`
  ADD CONSTRAINT `universite_ibfk_1` FOREIGN KEY (`PERSONNE_ID`) REFERENCES `personne` (`PERSONNE_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `universite_ibfk_2` FOREIGN KEY (`CONTACT_ID`) REFERENCES `contacts` (`CONTACT_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `universite_personne`
--
ALTER TABLE `universite_personne`
  ADD CONSTRAINT `universite_personne_ibfk_3` FOREIGN KEY (`PERSONNE_ID`) REFERENCES `personne` (`PERSONNE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `universite_personne_ibfk_4` FOREIGN KEY (`UNIVERSITE_ID`) REFERENCES `universite` (`UNIVERSITE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
