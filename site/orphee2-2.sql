-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 10 Mai 2018 à 21:27
-- Version du serveur :  5.6.37
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `orphee2`
--

-- --------------------------------------------------------

--
-- Structure de la table `fiche`
--

CREATE TABLE IF NOT EXISTS `fiche` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(200) DEFAULT NULL,
  `Portrait` varchar(200) DEFAULT NULL,
  `Couverture` varchar(200) DEFAULT NULL,
  `SousTitre` mediumtext,
  `Description` mediumtext,
  `Video` varchar(200) DEFAULT NULL,
  `Citation` mediumtext,
  `template` varchar(255) NOT NULL,
  `nationnalite` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fiche`
--

INSERT INTO `fiche` (`ID`, `Nom`, `Portrait`, `Couverture`, `SousTitre`, `Description`, `Video`, `Citation`, `template`, `nationnalite`) VALUES
(69, 'test video + imgs', '1a_1.jpg', 'defaultCouverture.jpg', '', 'fdsfds', 'kineticText_LauraPerinet-Marquet2.mp4', '', 'black', 'fdsfds'),
(70, 'Musique + images', '1h.jpg', '1f1.jpg', 'gfdgfd', 'gfsgr rqe terg qe', NULL, 'reqger', 'black', 'gfhtfh'),
(72, 'fdsfq efq ezf ezf', 'jimmyv2.jpg', 'guyv2.jpg', 'htrshtrshrtsh hrts', 'hrth qh thstrhtfhdyt hgnhgh ', 'kineticText_LauraPerinet-Marquet.mp4', 'grsegreqg erg greqg eq', 'black', 'gsrdg dwr');

-- --------------------------------------------------------

--
-- Structure de la table `fichegenre`
--

CREATE TABLE IF NOT EXISTS `fichegenre` (
  `ID` int(11) NOT NULL,
  `ID_Genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fichegenre`
--

INSERT INTO `fichegenre` (`ID`, `ID_Genre`) VALUES
(70, 1),
(69, 2),
(72, 3);

-- --------------------------------------------------------

--
-- Structure de la table `ficheutilisateur`
--

CREATE TABLE IF NOT EXISTS `ficheutilisateur` (
  `ID` int(11) NOT NULL,
  `ID_Utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ficheutilisateur`
--

INSERT INTO `ficheutilisateur` (`ID`, `ID_Utilisateur`) VALUES
(69, 3),
(70, 3),
(72, 3);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
  `ID` int(11) NOT NULL,
  `DateHistorique` year(4) DEFAULT NULL,
  `Description` mediumtext,
  `ID_Fiche` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `historique`
--

INSERT INTO `historique` (`ID`, `DateHistorique`, `Description`, `ID_Fiche`) VALUES
(18, 2018, 'fefezfze', 70),
(19, 2015, 'ferf qreg eqrgqer', 72),
(20, 2012, 'ferf qreg eqrgqergwdr gdrw', 72),
(21, 2015, 'fefezfze', 70);

-- --------------------------------------------------------

--
-- Structure de la table `musique`
--

CREATE TABLE IF NOT EXISTS `musique` (
  `ID` int(11) NOT NULL,
  `Chemin` varchar(200) DEFAULT NULL,
  `Nom` varchar(200) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `musique`
--

INSERT INTO `musique` (`ID`, `Chemin`, `Nom`, `image`) VALUES
(1, 'EdSheeranShapeOfYou.mp3', 'defaultMusique.jpg', 'defaultMusique.jpg'),
(2, 'EdSheeranShapeOfYou1.mp3', '1', 'defaultMusique.jpg'),
(3, 'EdSheeranShapeOfYou2.mp3', 'test', 'defaultMusique.jpg'),
(4, 'EdSheeranShapeOfYou3.mp3', 'test', 'defaultMusique.jpg'),
(5, 'EdSheeranShapeOfYou4.mp3', 'test', 'defaultMusique.jpg'),
(6, 'EdSheeranShapeOfYou1.mp3', 'fesfsefe', 'defaultMusique.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `musiquefiche`
--

CREATE TABLE IF NOT EXISTS `musiquefiche` (
  `ID` int(11) NOT NULL,
  `ID_Musique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `musiquefiche`
--

INSERT INTO `musiquefiche` (`ID`, `ID_Musique`) VALUES
(72, 6);

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE IF NOT EXISTS `ouvrage` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(200) DEFAULT NULL,
  `Auteur` varchar(200) DEFAULT NULL,
  `DateCreation` date DEFAULT NULL,
  `imagecouverture` varchar(255) NOT NULL,
  `ID_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ouvrage`
--

INSERT INTO `ouvrage` (`ID`, `Nom`, `Auteur`, `DateCreation`, `imagecouverture`, `ID_utilisateur`) VALUES
(16, 'test Video', 'test2', '2018-05-10', '1a_1.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `ouvragefiche`
--

CREATE TABLE IF NOT EXISTS `ouvragefiche` (
  `Page` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `ID_Fiche` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ouvragefiche`
--

INSERT INTO `ouvragefiche` (`Page`, `ID`, `ID_Fiche`) VALUES
(0, 16, 69);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `MotDePasse` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `Nom`, `MotDePasse`, `Email`) VALUES
(3, 'test2', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'test2@test2.fr');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `fiche`
--
ALTER TABLE `fiche`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `fichegenre`
--
ALTER TABLE `fichegenre`
  ADD PRIMARY KEY (`ID`,`ID_Genre`),
  ADD KEY `FK_FicheGenre_ID_Genre` (`ID_Genre`);

--
-- Index pour la table `ficheutilisateur`
--
ALTER TABLE `ficheutilisateur`
  ADD PRIMARY KEY (`ID`,`ID_Utilisateur`),
  ADD KEY `FK_FicheUtilisateur_ID_Utilisateur` (`ID_Utilisateur`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Historique_ID_Fiche` (`ID_Fiche`);

--
-- Index pour la table `musique`
--
ALTER TABLE `musique`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `musiquefiche`
--
ALTER TABLE `musiquefiche`
  ADD PRIMARY KEY (`ID`,`ID_Musique`),
  ADD KEY `FK_MusiqueFiche_ID_Musique` (`ID_Musique`);

--
-- Index pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ouvragefiche`
--
ALTER TABLE `ouvragefiche`
  ADD PRIMARY KEY (`ID`,`ID_Fiche`),
  ADD KEY `FK_OuvrageFiche_ID_Fiche` (`ID_Fiche`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nom` (`Nom`,`Email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `fiche`
--
ALTER TABLE `fiche`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `musique`
--
ALTER TABLE `musique`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
