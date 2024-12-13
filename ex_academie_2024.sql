-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 13 déc. 2024 à 12:52
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ex_academie_2024`
--

-- --------------------------------------------------------

--
-- Structure de la table `creatures`
--

DROP TABLE IF EXISTS `creatures`;
CREATE TABLE IF NOT EXISTS `creatures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `creatures`
--

INSERT INTO `creatures` (`id`, `name`, `description`, `image`, `type`, `user_id`) VALUES
(12, 'élémentaires de l\'eau', 'Les élémentaires de l\'Eau sont des créatures patientes et opiniâtres faites d\'eau douce ou d\'eau salée. Ils préfèrent se cacher dans l\'eau ou y emmener leurs adversaires afin de prendre l\'avantage sur eux.', 'elementaire_d\'eau1734000119324.jpg', 'aquatique', 1),
(13, 'tourmenteur', 'Tormentors are the servants of Ur-Traggal, the Demon Overlord of Pain. Consumed by the endless suffering of Urgash, they inflict upon their own bodies unthinkable horrors.', 'tourmenteur1734009997179.jpg', 'démoniaque', 3),
(14, 'cyclope', 'Les cyclopes forment une espèce de créatures fantastiques dans la mythologie grecque.\r\n\r\nCe sont des monstres géants n\'ayant qu\'un œil au milieu du front. Les premiers cyclopes sont ceux de la Théogonie d\'Hésiode.', 'cyclope1734000788951.jpg', 'mi-bête', 3);

-- --------------------------------------------------------

--
-- Structure de la table `elements`
--

DROP TABLE IF EXISTS `elements`;
CREATE TABLE IF NOT EXISTS `elements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `elements`
--

INSERT INTO `elements` (`id`, `name`) VALUES
(1, 'air'),
(2, 'eau'),
(3, 'feu'),
(4, 'lumière');

-- --------------------------------------------------------

--
-- Structure de la table `spells`
--

DROP TABLE IF EXISTS `spells`;
CREATE TABLE IF NOT EXISTS `spells` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `element_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `spells`
--

INSERT INTO `spells` (`id`, `name`, `description`, `image`, `user_id`, `element_name`) VALUES
(2, 'vents violents', 'The Hero calls upon the winds to impair enemy ranged-attacking creatures for 5 turn(s). Damage from all enemy shooters is reduced by X%.', 'Vent violent1734093203714.webp', 1, 'air');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Aquatique'),
(2, 'Démoniaque'),
(3, 'Mi-Bête'),
(4, 'Mort-Vivant');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `role`) VALUES
(1, 'aze', '8d019f4187a2415e48b00a3ee28cbe7e545a3c6d', 'utilisateur'),
(3, 'qsd', 'df422a3dbdd5921d36100f808dc6395048468f55', 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `users_elements`
--

DROP TABLE IF EXISTS `users_elements`;
CREATE TABLE IF NOT EXISTS `users_elements` (
  `user_id` int NOT NULL,
  `element_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users_elements`
--

INSERT INTO `users_elements` (`user_id`, `element_id`) VALUES
(1, 2),
(1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
