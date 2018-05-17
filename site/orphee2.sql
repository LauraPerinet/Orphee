-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 06 Mai 2018 à 19:51
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fiche`
--

INSERT INTO `fiche` (`ID`, `Nom`, `Portrait`, `Couverture`, `SousTitre`, `Description`, `Video`, `Citation`, `template`, `nationnalite`) VALUES
(37, 'Mondrian', '1a_5.jpg', '1a22.jpg', 'feqerqef', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis lectus in enim malesuada, in faucibus urna condimentum. Vivamus faucibus purus eleifend tellus consequat, vel aliquam lorem feugiat. Suspendisse libero metus, laoreet et lectus non, tempus congue felis. Quisque quis nisl tempor, gravida lacus eget, tempor felis. Maecenas accumsan lorem vulputate, interdum erat sed, tristique dui. Vivamus euismod tortor eget tortor mollis, a rutrum turpis fermentum. Aenean imperdiet feugiat aliquam. Nullam in sagittis nibh. Nulla auctor elit quis efficitur pretium. ', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 'black', 'gd'),
(38, 'Egypte', '1i1.jpg', NULL, 'feqerqef', 'greqgrqegrqe', '', 'gtfsgrt', 'black', 'gd'),
(39, 'Egypte', '1g1.jpg', '1n1.jpg', 'fdsfds', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis lectus in enim malesuada, in faucibus urna condimentum. Vivamus faucibus purus eleifend tellus consequat, vel aliquam lorem feugiat. Suspendisse libero metus, laoreet et lectus non, tempus congue felis. Quisque quis nisl tempor, gravida lacus eget, tempor felis. Maecenas accumsan lorem vulputate, interdum erat sed, tristique dui. Vivamus euismod tortor eget tortor mollis, a rutrum turpis fermentum. Aenean imperdiet feugiat aliquam. Nullam in sagittis nibh. Nulla auctor elit quis efficitur pretium. ', 'kineticText_LauraPerinet-Marquet.mp4', ' Vivamus faucibus purus eleifend ', 'black', 'ffdsfdsf');

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
(37, 1),
(38, 1),
(39, 1);

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
(37, 3),
(38, 3),
(39, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `historique`
--

INSERT INTO `historique` (`ID`, `DateHistorique`, `Description`, `ID_Fiche`) VALUES
(11, 2001, 'Historique 1', 38),
(12, 2002, 'Historique 2', 38),
(14, 0000, 'Lorem ipsum dolor sit amen', 37),
(15, 0000, 'Lorem ipsum', 37);

-- --------------------------------------------------------

--
-- Structure de la table `musique`
--

CREATE TABLE IF NOT EXISTS `musique` (
  `ID` int(11) NOT NULL,
  `Chemin` varchar(200) DEFAULT NULL,
  `Nom` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `musiquefiche`
--

CREATE TABLE IF NOT EXISTS `musiquefiche` (
  `ID` int(11) NOT NULL,
  `ID_Musique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ouvrage`
--

INSERT INTO `ouvrage` (`ID`, `Nom`, `Auteur`, `DateCreation`, `imagecouverture`, `ID_utilisateur`) VALUES
(10, 'NouveauTitre2', 'test2', '2018-05-06', '1a_4.jpg', 3),
(11, 'NouveauTitre2', 'test2', '2018-05-06', '1a2.jpg', 3),
(12, 'NouveauTitre2', 'test2', '2018-05-06', '1c1.jpg', 3),
(13, 'NouveauTitre2', 'test2', '2018-05-06', '1d.jpg', 3),
(14, 'NouveauTitre2', 'test2', '2018-05-06', '1f.jpg', 3),
(15, 'Chauvet', 'test2', '2018-05-06', '1g.jpg', 3);

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
(NULL, 10, 37),
(NULL, 11, 37),
(NULL, 11, 38),
(NULL, 11, 39),
(NULL, 12, 37),
(NULL, 15, 37),
(NULL, 15, 39);

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
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Portrait` (`Portrait`,`Couverture`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `musique`
--
ALTER TABLE `musique`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
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
