-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 07 oct. 2024 à 16:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `icad`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE `animal` (
  `ICAD` varchar(9) NOT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `AGE` int(11) DEFAULT NULL,
  `SEXE` tinyint(1) DEFAULT NULL,
  `DESCRIPTIF` varchar(256) DEFAULT NULL,
  `PHOTO` blob NOT NULL,
  `STATUE` tinyint(1) NOT NULL,
  `IDENTIFIANT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

CREATE TABLE `proprietaire` (
  `IDENTIFIANT` int(11) NOT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `TELEPHONE` int(11) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `ADRESSE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `proprietaire`
--

INSERT INTO `proprietaire` (`IDENTIFIANT`, `NOM`, `PRENOM`, `TELEPHONE`, `EMAIL`, `ADRESSE`) VALUES
(1, 'turo', 'ferere', NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`ICAD`),
  ADD KEY `fk_proprietaire` (`IDENTIFIANT`);

--
-- Index pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD PRIMARY KEY (`IDENTIFIANT`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  MODIFY `IDENTIFIANT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `ANIMAL_PROPRIETAIRE_FK` FOREIGN KEY (`IDENTIFIANT`) REFERENCES `proprietaire` (`IDENTIFIANT`),
  ADD CONSTRAINT `fk_proprietaire` FOREIGN KEY (`IDENTIFIANT`) REFERENCES `proprietaire` (`IDENTIFIANT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
