-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 02 oct. 2023 à 15:01
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `voisinous`
--
CREATE DATABASE IF NOT EXISTS `voisinous` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `voisinous`;

-- --------------------------------------------------------

--
-- Structure de la table `Answers`
--

CREATE TABLE `Answers` (
  `id` int(5) NOT NULL,
  `postid` int(5) NOT NULL,
  `answerid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `GroupeMembers`
--

CREATE TABLE `GroupeMembers` (
  `id` int(5) NOT NULL,
  `userid` int(5) NOT NULL,
  `groupid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Groupes`
--

CREATE TABLE `Groupes` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `decription` varchar(255) DEFAULT NULL,
  `localisation` int(5) NOT NULL,
  `photo` blob,
  `private` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adminid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Likes`
--

CREATE TABLE `Likes` (
  `id` int(5) NOT NULL,
  `userid` int(5) NOT NULL,
  `postid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Posts`
--

CREATE TABLE `Posts` (
  `id` int(5) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `userid` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `groupeid` int(5) NOT NULL,
  `principale` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id` int(5) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `localisation` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Answers`
--
ALTER TABLE `Answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PrincipalPost` (`postid`),
  ADD KEY `AnswerPost` (`answerid`);

--
-- Index pour la table `GroupeMembers`
--
ALTER TABLE `GroupeMembers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UsersMembers` (`userid`),
  ADD KEY `GroupeMembers` (`groupid`);

--
-- Index pour la table `Groupes`
--
ALTER TABLE `Groupes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminGroupes` (`adminid`);

--
-- Index pour la table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserLikes` (`userid`),
  ADD KEY `PostLikes` (`postid`);

--
-- Index pour la table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UsersPost` (`userid`),
  ADD KEY `GroupesPost` (`groupeid`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Groupes`
--
ALTER TABLE `Groupes`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Answers`
--
ALTER TABLE `Answers`
  ADD CONSTRAINT `AnswerPost` FOREIGN KEY (`answerid`) REFERENCES `Posts` (`id`),
  ADD CONSTRAINT `PrincipalPost` FOREIGN KEY (`postid`) REFERENCES `Posts` (`id`);

--
-- Contraintes pour la table `GroupeMembers`
--
ALTER TABLE `GroupeMembers`
  ADD CONSTRAINT `GroupeMembers` FOREIGN KEY (`groupid`) REFERENCES `Groupes` (`id`),
  ADD CONSTRAINT `UsersMembers` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `Groupes`
--
ALTER TABLE `Groupes`
  ADD CONSTRAINT `AdminGroupes` FOREIGN KEY (`adminid`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `Likes`
--
ALTER TABLE `Likes`
  ADD CONSTRAINT `PostLikes` FOREIGN KEY (`postid`) REFERENCES `Posts` (`id`),
  ADD CONSTRAINT `UserLikes` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `GroupesPost` FOREIGN KEY (`groupeid`) REFERENCES `Groupes` (`id`),
  ADD CONSTRAINT `UsersPost` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
