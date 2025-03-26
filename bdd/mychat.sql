-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 16 nov. 2024 à 10:35
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mychat`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages_box`
--

CREATE TABLE `messages_box` (
  `id_auteur` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `messages` text NOT NULL,
  `dates` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages_box`
--

INSERT INTO `messages_box` (`id_auteur`, `id_message`, `messages`, `dates`) VALUES
(1, 1, 'Bonjour', '2024-11-16 09:46:17'),
(2, 2, 'Oui bonjour et ce matin', '2024-11-16 09:46:40'),
(1, 3, 'sdfser', '2024-11-16 09:54:54'),
(1, 4, 'ezzezt', '2024-11-16 09:55:01'),
(1, 5, '  border: 1px solid rgba(0, 0, 0, 0.1);<br />\r\n     box-shadow: 0 0 2px #b4b2b2 ;<br />\r\n     border-radius: 10px 10px 10px 0px;<br />\r\n     font-size:14px;<br />\r\n     width: 92%;<br />\r\n     padding: 0px 5px;<br />\r\n     margin-top: 6px;   <br />\r\n     background-color: #ece9e9;<br />\r\n     margin-left: auto;', '2024-11-16 09:55:09'),
(1, 6, ' color: #575050;<br />\r\n     font-weight: bold;<br />\r\n     margin-bottom: 0px;<br />\r\n     margin-top: 0px;<br />\r\n     padding: 0px;<br />\r\n     font-size: 12px;<br />\r\n     text-align: start;<br />\r\n     margin-left:170px;<br />\r\n}', '2024-11-16 09:55:40'),
(3, 7, 'Bonjour le groupe', '2024-11-16 10:11:25'),
(1, 8, 'Oui bonjour Rebecca', '2024-11-16 10:26:14'),
(2, 9, 'Oui bonjour comment vas tu ?', '2024-11-16 10:26:55'),
(3, 10, 'ça va très bien ', '2024-11-16 10:28:12');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenoms` varchar(255) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenoms`, `identifiant`, `mdp`) VALUES
(1, 'KAOU', 'Venance', 'kaouvenance@gmail.com', '386c57017f4658ca5215569643f0189d'),
(2, 'KOAU', 'Brigitte', 'kaou@gmail.com', '65ba841e01d6db7733e90a5b7f9e6f80'),
(3, 'YABI', 'Rebecca', 'rebeccaileloui@gmail.com', '91b3199855c685fc47a5161907428756');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages_box`
--
ALTER TABLE `messages_box`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages_box`
--
ALTER TABLE `messages_box`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
