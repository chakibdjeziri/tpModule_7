-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 20 fév. 2024 à 20:40
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `module7`
--

-- --------------------------------------------------------

--
-- Structure de la table `user_admin`
--

CREATE TABLE `user_admin` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` date NOT NULL COMMENT '(DC2Type:date_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_admin`
--

INSERT INTO `user_admin` (`id`, `pseudo`, `email`, `roles`, `password`, `date_creation`) VALUES
(5, 'Administrateur de MalikAuto', 'admin@malikauto.fr', '[\"ROLE_ADMIN\"]', '$2y$13$alFzM9x8ahXAcAOjmMkDzu5ZhHg80xhejySE8L9Pn63u7ZXmDKu7a', '2024-02-20'),
(6, 'alibabajfhjz', 'ch.djeziri@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$ch1bSJpDDFa2FU4IikSFEOjaBB9QYs5Wcdo36lPQJzp21mygy2Rxm', '2024-02-20'),
(7, 'ali', 'toto@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$JMVkMdez0jfgqroPGYOvEuwAxkOrzfv/RwUAhYb1CcPMKaQdI9t3m', '2024-02-20'),
(8, 'eezez', 'ch.djezzezzeiri@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$lffR9FCouH0/dwzIhw29Seh4BmKFcrx/hy.8CrgwlEZ7YGqmRwG0K', '2024-02-20'),
(9, 'alalal', 'ch.djezajhjhiri@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$q4Lx1KxiZfxy18eld76HKOuznlh80VPkZc.gQPG1v9dt1PX8hv0WS', '2024-02-20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6ACCF62EE7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
