-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 09, 2023 at 08:12 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnetwork`
--
CREATE DATABASE IF NOT EXISTS `socialnetwork` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `socialnetwork`;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(10) UNSIGNED NOT NULL,
  `followed_user_id` int(10) UNSIGNED NOT NULL,
  `following_user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `followed_user_id`, `following_user_id`) VALUES
(1, 5, 3),
(2, 5, 6),
(3, 5, 7),
(4, 1, 5),
(5, 2, 5),
(6, 4, 5),
(7, 1, 2),
(8, 1, 3),
(9, 1, 7),
(10, 1, 6),
(11, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 3, 3),
(4, 3, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 1, 9),
(12, 2, 9),
(13, 4, 9),
(14, 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created`, `parent_id`) VALUES
(1, 5, '#politique étrangère Joe Biden, le président des Américains \r\n\r\n', '2020-02-05 18:19:12', NULL),
(2, 5, 'Le gouvernement a lancé, le 3 septembre, un plan de relance historique de 100 milliards d’euros pour redresser l’#économie.', '2020-04-06 18:19:12', NULL),
(3, 5, 'Dans une définition large de la notion du #social, on peut l\'entendre comme l\'expression de l\'existence de relations et de communication entre les êtres vivants.', '2020-07-12 18:21:49', NULL),
(4, 5, 'La #société (du latin socius : compagnon, associé) est un groupe d\'individus unifiés par un réseau de relations, de traditions et d\'institutions. ', '2020-08-04 18:21:49', NULL),
(5, 5, 'La #technologie est l\'étude des outils et des techniques. Le terme désigne les observations sur l\'état de l\'art aux diverses périodes historiques, en matière d\'outils et de savoir-faire. Il comprend l\'art, l\'artisanat, les métiers, les sciences appliquées et éventuellement les connaissances.', '2020-09-25 18:24:30', NULL),
(6, 5, 'En sociologie, comme en éthologie, la #culture est définie de façon plus étroite comme « ce qui est commun à un groupe d\'individus » et comme « ce qui le soude », c\'est-à-dire ce qui est appris, transmis, produit et inventé. Ainsi, pour une organisation internationale comme l\'UNESCO : « Dans son sens le plus large, la culture peut aujourd’hui être considérée comme l\'ensemble des traits distinctifs, spirituels, matériels, intellectuels et affectifs, qui caractérisent une société ou un groupe social. Elle englobe, outre les arts, les lettres et les sciences, les modes de vie, les lois, les systèmes de valeurs, les traditions et les croyances ». Ce « réservoir commun » évolue dans le temps par et dans les formes des échanges. Il se constitue en de multiples manières distinctes d\'être, de penser, d\'agir et de communiquer en société.', '2020-10-15 00:35:42', NULL),
(7, 5, 'On peut définir le jeu comme une activité d\'ordre psychique ou bien physique pensée pour divertir et improductive à court terme. Le jeu entraîne des dépenses d\'énergie et de moyens matériels, sans créer aucune richesse nouvelle. La plupart des individus qui s\'y engagent n\'en retirent que du plaisir, bien que certains puissent en obtenir des avantages matériels. De ce fait, Johan Huizinga remarque que de très nombreuses activités humaines peuvent s\'assimiler à des jeux. La difficulté de circonscrire la définition du jeu présente un intérêt pour la philosophie. ', '2020-10-25 00:35:39', NULL),
(8, 5, 'Un #jeu de rôle est une technique ou activité, par laquelle une personne interprète le rôle d\'un personnage (réel ou imaginaire) dans un environnement fictif. Le participant agit à travers ce rôle par des actions physiques ou imaginaires, par des actions narratives (dialogues improvisés, descriptions, jeu) et par des prises de décision sur le développement du personnage et de son histoire.', '2020-11-10 18:26:12', NULL),
(9, 1, 'Le #féminisme est un ensemble de mouvements et d\'idées philosophiques qui partagent un but commun : définir, promouvoir et atteindre l\'égalité #politique, économique, culturelle, sociale et juridique entre les femmes et les hommes. Le féminisme a donc pour objectif d\'abolir, dans ces différents domaines, les inégalités homme-femme dont les femmes sont les principales victimes, et ainsi de promouvoir les droits des femmes dans la société civile et dans la vie privée. ', '2020-11-20 18:26:50', NULL),
(10, 7, 'Le #sport est un ensemble d\'exercices physiques se pratiquant sous forme de jeux individuels ou collectifs pouvant donner lieu à des compétitions. Le sport est un phénomène presque universel dans le temps et dans l\'espace humain. La Grèce antique, la Rome antique, Byzance, l\'Occident médiéval puis moderne, mais aussi l\'Amérique précolombienne ou l\'Asie, sont tous marqués par l\'importance du sport. Certaines périodes sont surtout marquées par des interdits. ', '2020-11-30 18:31:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE `posts_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`id`, `post_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 6),
(6, 6, 7),
(7, 7, 8),
(8, 8, 8),
(9, 9, 9),
(10, 10, 5),
(11, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `label`) VALUES
(7, 'culture'),
(2, 'économie'),
(9, 'féminisme'),
(8, 'jeux'),
(1, 'politique'),
(3, 'social'),
(4, 'société'),
(5, 'sport'),
(6, 'technologie');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `alias`) VALUES
(1, 'ada@test.org', '098f6bcd4621d373cade4e832627b4f6', 'ada'),
(2, 'alex@test.org', '098f6bcd4621d373cade4e832627b4f6', 'Alexandra'),
(3, 'bea@test.org', '098f6bcd4621d373cade4e832627b4f6', 'Béatrice'),
(4, 'zoe@test.org', '098f6bcd4621d373cade4e832627b4f6', 'Zoé'),
(5, 'felicie@test.org', '098f6bcd4621d373cade4e832627b4f6', 'Félicie'),
(6, 'cecile@test.com', '098f6bcd4621d373cade4e832627b4f6', 'Cécile'),
(7, 'chacha@test.net', '098f6bcd4621d373cade4e832627b4f6', 'Charlotte');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_has_users_users2_idx` (`following_user_id`),
  ADD KEY `fk_users_has_users_users1_idx` (`followed_user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_has_posts_posts1_idx` (`post_id`),
  ADD KEY `fk_users_has_posts_users1_idx` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_users_idx` (`user_id`),
  ADD KEY `fk_posts_posts1_idx` (`parent_id`);

--
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_has_tags_tags1_idx` (`tag_id`),
  ADD KEY `fk_posts_has_tags_posts1_idx` (`post_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label_UNIQUE` (`label`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `alias_UNIQUE` (`alias`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts_tags`
--
ALTER TABLE `posts_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `fk_users_has_users_users1` FOREIGN KEY (`followed_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_users_has_users_users2` FOREIGN KEY (`following_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_users_has_posts_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_users_has_posts_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_posts1` FOREIGN KEY (`parent_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD CONSTRAINT `fk_posts_has_tags_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_posts_has_tags_tags1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);
--
-- Database: `voisinous`
--
CREATE DATABASE IF NOT EXISTS `voisinous` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `voisinous`;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(5) NOT NULL,
  `postid` int(5) NOT NULL,
  `answerid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groupemembers`
--

CREATE TABLE `groupemembers` (
  `id` int(5) NOT NULL,
  `userid` int(5) NOT NULL,
  `groupid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `localisation` int(5) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `private` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `adminid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupes`
--

INSERT INTO `groupes` (`id`, `name`, `description`, `localisation`, `photo`, `private`, `date`, `latitude`, `longitude`, `adminid`) VALUES
(11, 'grptestdeloc', 'youhou', 75500, '372684839_661297286141897_4762877171425193551_n.jpg', 0, '2023-10-06 08:25:40', 48.8671, 2.35652, 1),
(12, 'letestinch', 'inch', 85000, '372684839_661297286141897_4762877171425193551_n.jpg', 0, '2023-10-06 08:32:14', 48.8466, 2.34446, 1),
(13, 'YOUHOU', 'inch', 85000, '372684839_661297286141897_4762877171425193551_n.jpg', 0, '2023-10-06 09:22:30', 48.8822, 2.48521, 1),
(14, 'El groupo très lointain', 'coucou', 77777, '372684839_661297286141897_4762877171425193551_n.jpg', 0, '2023-10-06 09:57:33', 48.8671, 2.35652, 1),
(15, 'El groupo fort fort loin', 'coucou', 77777, '372684839_661297286141897_4762877171425193551_n.jpg', 0, '2023-10-06 09:58:05', 48.693, 2.6118, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(5) NOT NULL,
  `userid` int(5) NOT NULL,
  `postid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(5) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `userid` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `groupeid` int(5) NOT NULL,
  `principale` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `localisation` int(5) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `mail`, `mdp`, `localisation`, `latitude`, `longitude`, `date`, `photo`) VALUES
(1, 'Un voisin', 'voisin@neighboor', 'password', 93210, 0, 0, '2023-10-03 08:47:54', NULL),
(2, 'aa', 'onat@aa.com', '$2y$10$aS1Od55zbUyUawO5KP9XQOmL1xf0T.qgDOhhZqCQL0DZPofakQTEy', 75100, 0, 0, '2023-10-03 12:44:24', NULL),
(5, 'onat', 'onat.rigault@gmail.com', '$2y$10$JgAoHf819Ugl4SClnKeYgO42vjc775hSOUD/q5b6YN/GRmslsRhgG', 93210, 0, 0, '2023-10-04 12:42:53', NULL),
(6, 'aaaaaaa', 'ont@gmail.com', 'aa', 68230, 48.8671, 2.35652, '2023-10-05 13:44:11', '372684839_661297286141897_4762877171425193551_n.jpg'),
(7, 'testdeloc', 'testdeloc@loc.com', 'mdp', 75000, 48.8671, 2.35652, '2023-10-06 08:24:58', '372684839_661297286141897_4762877171425193551_n.jpg'),
(8, 'reretestloc', 'loc@localoca.com', 'mdp', 95000, 48.8468, 2.34334, '2023-10-06 08:31:20', '372684839_661297286141897_4762877171425193551_n.jpg'),
(9, 'onat123', 'ontrgt@mail.com', 'azerty68', 68230, 48.909, 2.36236, '2023-10-06 12:29:54', '372684839_661297286141897_4762877171425193551_n.jpg'),
(10, 'ont', 'ont@mail.com', 'ont', 55555, 48.8645, 2.3809, '2023-10-06 12:32:10', '372684839_661297286141897_4762877171425193551_n.jpg'),
(12, 'ontyr', 'onatyr@gmail.com', '$2y$10$M0iG4Ns5DFmgjS1FlHnrzOL0TDrMcHz/T1Eg/XlWUeal56jDmVGG6', 55555, 48.8623, 2.38131, '2023-10-06 12:36:18', '372684839_661297286141897_4762877171425193551_n.jpg'),
(13, 'rueencyclo', 'encyclo@gmal.com', '$2y$10$lCDMHnHxZT9YW02Budh2zOFqnJjS6KIH6Bvq4XkFkaYPirlcmxFWy', 93210, 48.909, 2.36246, '2023-10-06 13:42:49', '372684839_661297286141897_4762877171425193551_n.jpg'),
(14, 'aaa', 'aaa@aaa.com', '$2y$10$mtE7tWuuLtTbaUdIDvW5..ZFar2kNFsgvCNm62XBgA5/BuKMCBxW2', 75000, 48.8662, 2.35723, '2023-10-09 08:01:04', '372684839_661297286141897_4762877171425193551_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PrincipalPost` (`postid`),
  ADD KEY `AnswerPost` (`answerid`);

--
-- Indexes for table `groupemembers`
--
ALTER TABLE `groupemembers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UsersMembers` (`userid`),
  ADD KEY `GroupeMembers` (`groupid`);

--
-- Indexes for table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminGroupes` (`adminid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserLikes` (`userid`),
  ADD KEY `PostLikes` (`postid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UsersPost` (`userid`),
  ADD KEY `GroupesPost` (`groupeid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupemembers`
--
ALTER TABLE `groupemembers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `AnswerPost` FOREIGN KEY (`answerid`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `PrincipalPost` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`);

--
-- Constraints for table `groupemembers`
--
ALTER TABLE `groupemembers`
  ADD CONSTRAINT `GroupeMembers` FOREIGN KEY (`groupid`) REFERENCES `groupes` (`id`),
  ADD CONSTRAINT `UsersMembers` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `groupes`
--
ALTER TABLE `groupes`
  ADD CONSTRAINT `AdminGroupes` FOREIGN KEY (`adminid`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `PostLikes` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `UserLikes` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `GroupesPost` FOREIGN KEY (`groupeid`) REFERENCES `groupes` (`id`),
  ADD CONSTRAINT `UsersPost` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
