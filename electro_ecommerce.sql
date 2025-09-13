-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 sep. 2025 à 01:07
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
-- Base de données : `electro_ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande_speciale`
--

CREATE TABLE `commande_speciale` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `nom_produit` varchar(150) NOT NULL,
  `quantite` int(11) NOT NULL,
  `adresse` text NOT NULL,
  `status` varchar(50) DEFAULT 'En attente',
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `commande_speciale`
--

INSERT INTO `commande_speciale` (`id`, `user_id`, `username`, `nom_produit`, `quantite`, `adresse`, `status`, `date_commande`) VALUES
(1, 1, 'salma', 'iPhone 14 Pro', 2, '123 Avenue Hassan II, Casablanca', 'En attente', '2025-09-09 17:48:35'),
(2, 2, 'amine', 'HP 640 G5 Laptop', 1, '45 Rue Mohammed V, Rabat', 'En cours', '2025-09-09 17:48:35'),
(3, 3, 'karima', 'AirPods Pro', 3, 'Lotissement Al Wifaq, Marrakech', 'Livrée', '2025-09-09 17:48:35');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `commentaire` text NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `nom`, `commentaire`, `date`) VALUES
(1, 'ali', 'ce site est très riche en produits électoniques!', '2025-09-09 17:10:15');

-- --------------------------------------------------------

--
-- Structure de la table `image_home`
--

CREATE TABLE `image_home` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `image_home`
--

INSERT INTO `image_home` (`id`, `image`, `titre`, `created_at`) VALUES
(1, '../electro_ecommerce/images/image1.jpg', 'Image d\'accueil', '2025-09-09 15:48:04');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `prix`, `image`, `description`, `created_at`) VALUES
(1, 'Apple MOBILE', 9500.00, 'Apple MOBILE.jpg', 'Smartphone Apple mobile dernière génération.', '2025-09-09 17:12:04'),
(2, 'CAMERA', 7200.00, 'CAMERA.jpg', 'Caméra numérique haute résolution pour photo et vidéo.', '2025-09-09 17:12:04'),
(3, 'CASQUE', 1200.00, 'CASQUE.jpg', 'Casque audio de haute qualité.', '2025-09-09 17:12:04'),
(4, 'CHARGEUR', 300.00, 'CHARGEUR.jpg', 'Chargeur rapide compatible avec plusieurs appareils.', '2025-09-09 17:12:04'),
(5, 'Ecouteurs Bluetooth sans Fil', 850.00, 'Ecouteurs Bluetooth sans Fil.jpg', 'Écouteurs sans fil avec longue autonomie.', '2025-09-09 17:12:04'),
(6, 'Écouteurs filaires', 150.00, 'Écouteurs filaires.jpg', 'Écouteurs filaires pratiques et confortables.', '2025-09-09 17:12:04'),
(7, 'HP 640 G5 Laptop', 12500.00, 'HP 640 G5 Laptop.jpg', 'Ordinateur portable HP performant pour bureautique et multimédia.', '2025-09-09 17:12:04'),
(8, 'IPAD', 8900.00, 'IPAD.jpg', 'Tablette Apple iPad dernière version.', '2025-09-09 17:12:04'),
(9, 'montre connectée', 2100.00, 'montre connectée.jpg', 'Smartwatch connectée avec capteurs santé et notifications.', '2025-09-09 17:12:04'),
(10, 'phone 14 pro purple', 14500.00, 'phone 14 pro purple.jpg', 'iPhone 14 Pro couleur violet.', '2025-09-09 17:12:04'),
(11, 'souris', 250.00, 'souris.jpg', 'Souris sans fil ergonomique.', '2025-09-09 17:12:04'),
(12, 'USB', 180.00, 'USB.jpg', 'Clé USB de grande capacité de stockage.', '2025-09-09 17:12:04'),
(13, 'image1', 0.00, 'image1.jpg', 'Image générique de test.', '2025-09-09 17:12:04');

-- --------------------------------------------------------

--
-- Structure de la table `temoignage`
--

CREATE TABLE `temoignage` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `nom` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `temoignage`
--

INSERT INTO `temoignage` (`id`, `id_produit`, `nom`, `message`, `created_at`) VALUES
(1, 1, 'Salma', 'Très satisfaite de mon achat, livraison rapide !', '2025-09-09 18:51:25'),
(2, 2, 'Amine', 'Produit de qualité, je recommande fortement.', '2025-09-09 18:51:25'),
(3, 3, 'Karima', 'Service client excellent, merci beaucoup.', '2025-09-09 18:51:25');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom_utilisateur` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom_utilisateur`, `email`, `mot_de_passe`, `created_at`) VALUES
(9, 'salma', 'salma22@gmail.com', '$2y$10$sxXpzc8.QeIZc7xlANKZ4els0.37wS2ykzEua2CNIxbyDBK03z7TS', '2025-09-09 22:58:07');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande_speciale`
--
ALTER TABLE `commande_speciale`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image_home`
--
ALTER TABLE `image_home`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `temoignage`
--
ALTER TABLE `temoignage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande_speciale`
--
ALTER TABLE `commande_speciale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `image_home`
--
ALTER TABLE `image_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `temoignage`
--
ALTER TABLE `temoignage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
