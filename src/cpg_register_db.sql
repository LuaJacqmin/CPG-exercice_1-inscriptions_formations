-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 14 juil. 2021 à 13:23
-- Version du serveur :  10.4.19-MariaDB
-- Version de PHP : 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cpg_register_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `lj_guests`
--

CREATE TABLE `lj_guests` (
  `id_guests` mediumint(9) NOT NULL,
  `name` varchar(60) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `picture` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `lj_visites`
--

CREATE TABLE `lj_visites` (
  `id_visits` int(11) NOT NULL,
  `id_guests` int(11) NOT NULL,
  `entrydate` datetime NOT NULL DEFAULT current_timestamp(),
  `leavingdate` datetime NOT NULL DEFAULT current_timestamp(),
  `link` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lj_guests`
--
ALTER TABLE `lj_guests`
  ADD PRIMARY KEY (`id_guests`);

--
-- Index pour la table `lj_visites`
--
ALTER TABLE `lj_visites`
  ADD PRIMARY KEY (`id_visits`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lj_guests`
--
ALTER TABLE `lj_guests`
  MODIFY `id_guests` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `lj_visites`
--
ALTER TABLE `lj_visites`
  MODIFY `id_visits` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
