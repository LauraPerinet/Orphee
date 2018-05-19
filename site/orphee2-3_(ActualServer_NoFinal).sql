-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Client :  orphee.santhor.com
-- Généré le :  Sam 19 Mai 2018 à 23:46
-- Version du serveur :  5.5.60-0+deb7u1-log
-- Version de PHP :  5.4.45-0+deb7u14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `orphee2`
--

-- --------------------------------------------------------

--
-- Structure de la table `fiche`
--

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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fichegenre`
--

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

CREATE TABLE IF NOT EXISTS `genre` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`ID`, `Nom`) VALUES
(1, 'Rock'),
(2, 'Classique'),
(3, 'Jazz'),
(4, 'Métal'),
(5, 'Electro');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE IF NOT EXISTS `historique` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DateHistorique` year(4) DEFAULT NULL,
  `Description` mediumtext,
  `ID_Fiche` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Historique_ID_Fiche` (`ID_Fiche`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Structure de la table `musique`
--

CREATE TABLE IF NOT EXISTS `musique` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Chemin` varchar(200) DEFAULT NULL,
  `Nom` varchar(200) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Structure de la table `musiquefiche`
--

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

CREATE TABLE IF NOT EXISTS `ouvrage` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(200) DEFAULT NULL,
  `Auteur` varchar(200) DEFAULT NULL,
  `DateCreation` date DEFAULT NULL,
  `imagecouverture` varchar(255) NOT NULL,
  `ID_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ouvragefiche`
--

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

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) DEFAULT NULL,
  `MotDePasse` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Nom` (`Nom`,`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `Nom`, `MotDePasse`, `Email`) VALUES
(4, 'Alph4', '2c1743a391305fbf367df8e4f069f9f9', 'alpha@alpha.fr');

--
-- Contraintes pour les tables exportées
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
