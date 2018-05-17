-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 12 avr. 2018 à 22:03
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `orphee`
--

-- --------------------------------------------------------

--
-- Structure de la table `fiche`
--

DROP TABLE IF EXISTS `fiche`;
CREATE TABLE IF NOT EXISTS `fiche` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(200) DEFAULT NULL,
  `Portrait` varchar(200) DEFAULT NULL,
  `Couverture` varchar(200) DEFAULT NULL,
  `SousTitre` mediumtext,
  `Description` mediumtext,
  `Video` varchar(200) DEFAULT NULL,
  `Citation` mediumtext,
  `template` varchar(255) NOT NULL,
  `nationnalite` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Portrait` (`Portrait`,`Couverture`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fiche`
--

INSERT INTO `fiche` (`ID`, `Nom`, `Portrait`, `Couverture`, `SousTitre`, `Description`, `Video`, `Citation`, `template`, `nationnalite`) VALUES
(1, 'Joe Doe', 'img/joedoe.jpg', 'Joe Doe Cover', 'Musique pop', 'Joe Doe is good', 'videos/joedoe.mp4', 'Joe Doe is life', 'template/joedoe.php', 'Francais'),
(3, 'Tommy Heat', 'img/tommyheat.jpg', 'Tommy Heat Cover', 'Rock', 'Tommy Heat is good', 'videos/tommyheat.mp4', 'Tommy Heat is life', 'template/tommyheat.php', 'Francais'),
(4, 'Yellow Code', 'img/yellowcode.png', 'Yellow Code Cover', 'Electronique', 'Yellow Code is good', 'videos/yellowcode.mp4', 'Yellow Code is life', 'template/yellowcode.php', 'Anglais'),
(5, 'Sarah Connor', 'img/sarahconnor.png', 'Sarah Connor Cover', 'Musique trise', 'Sarah Connor is good', 'videos/sarahconnor.mp4', 'Sarah Connor is life', 'template/sarahconnor.php', 'Anglais'),
(6, 'John Solo', 'img/johnsolo.png', 'John Solo Cover', 'Rock', 'John Solo is good', 'videos/johnsolo.mp4', 'John Solo is life', 'template/johnsolo.php', 'Anglais'),
(7, 'Maria Ela', 'img/mariaela.jpg', 'Maria Ela Cover', 'Rock', 'Maria Ela is good', 'videos/mariaela.mp4', 'Maria Ela is life', 'template/mariaela.php', 'Espagnol'),
(8, 'Kate Schools', 'img/kateschools.jpg', 'Kate Schools Cover', 'Rap', 'Kate Schools is good', 'videos/kateschools.mp4', 'Kate Schools is life', 'template/kateschools.php', 'Americain'),
(9, 'Penaldo', 'img/penaldo.png', 'Penaldo Cover', 'Rap', 'Penaldo is ?', 'videos/penaldo.mp4', 'Penaldo is life', 'template/penaldo.php', 'Portugais'),
(10, 'Orphee', 'img/orphee.jpg', 'Orphee Cover', 'Classique', 'Orphee is good', 'videos/orphee.mp4', 'Orphee is life', 'template/orphee.php', 'Grec');

-- --------------------------------------------------------

--
-- Structure de la table `fichegenre`
--

DROP TABLE IF EXISTS `fichegenre`;
CREATE TABLE IF NOT EXISTS `fichegenre` (
  `ID` int(11) NOT NULL,
  `ID_Genre` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`ID_Genre`),
  KEY `FK_FicheGenre_ID_Genre` (`ID_Genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ficheutilisateur`
--

DROP TABLE IF EXISTS `ficheutilisateur`;
CREATE TABLE IF NOT EXISTS `ficheutilisateur` (
  `ID` int(11) NOT NULL,
  `ID_Utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`ID_Utilisateur`),
  KEY `FK_FicheUtilisateur_ID_Utilisateur` (`ID_Utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DateHistorique` date DEFAULT NULL,
  `Description` mediumtext,
  `ID_Fiche` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Historique_ID_Fiche` (`ID_Fiche`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `musique`
--

DROP TABLE IF EXISTS `musique`;
CREATE TABLE IF NOT EXISTS `musique` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Chemin` varchar(200) DEFAULT NULL,
  `Nom` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `musiquefiche`
--

DROP TABLE IF EXISTS `musiquefiche`;
CREATE TABLE IF NOT EXISTS `musiquefiche` (
  `ID` int(11) NOT NULL,
  `ID_Musique` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`ID_Musique`),
  KEY `FK_MusiqueFiche_ID_Musique` (`ID_Musique`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

DROP TABLE IF EXISTS `ouvrage`;
CREATE TABLE IF NOT EXISTS `ouvrage` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(200) DEFAULT NULL,
  `Auteur` varchar(200) DEFAULT NULL,
  `DateCreation` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ouvragefiche`
--

DROP TABLE IF EXISTS `ouvragefiche`;
CREATE TABLE IF NOT EXISTS `ouvragefiche` (
  `Page` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `ID_Fiche` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`ID_Fiche`),
  KEY `FK_OuvrageFiche_ID_Fiche` (`ID_Fiche`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) DEFAULT NULL,
  `MotDePasse` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Nom` (`Nom`,`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fichegenre`
--
ALTER TABLE `fichegenre`
  ADD CONSTRAINT `FK_FicheGenre_ID` FOREIGN KEY (`ID`) REFERENCES `fiche` (`ID`),
  ADD CONSTRAINT `FK_FicheGenre_ID_Genre` FOREIGN KEY (`ID_Genre`) REFERENCES `genre` (`ID`);

--
-- Contraintes pour la table `ficheutilisateur`
--
ALTER TABLE `ficheutilisateur`
  ADD CONSTRAINT `FK_FicheUtilisateur_ID` FOREIGN KEY (`ID`) REFERENCES `fiche` (`ID`),
  ADD CONSTRAINT `FK_FicheUtilisateur_ID_Utilisateur` FOREIGN KEY (`ID_Utilisateur`) REFERENCES `utilisateur` (`ID`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `FK_Historique_ID_Fiche` FOREIGN KEY (`ID_Fiche`) REFERENCES `fiche` (`ID`);

--
-- Contraintes pour la table `musiquefiche`
--
ALTER TABLE `musiquefiche`
  ADD CONSTRAINT `FK_MusiqueFiche_ID` FOREIGN KEY (`ID`) REFERENCES `fiche` (`ID`),
  ADD CONSTRAINT `FK_MusiqueFiche_ID_Musique` FOREIGN KEY (`ID_Musique`) REFERENCES `musique` (`ID`);

--
-- Contraintes pour la table `ouvragefiche`
--
ALTER TABLE `ouvragefiche`
  ADD CONSTRAINT `FK_OuvrageFiche_ID` FOREIGN KEY (`ID`) REFERENCES `ouvrage` (`ID`),
  ADD CONSTRAINT `FK_OuvrageFiche_ID_Fiche` FOREIGN KEY (`ID_Fiche`) REFERENCES `fiche` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
