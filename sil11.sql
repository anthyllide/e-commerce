-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 29 Janvier 2017 à 10:19
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sil11`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `file`) VALUES
(1, 'Avions', '91194d4499e629014a4aca1bbe6d076d.jpeg'),
(2, 'Planeurs', 'e0355f2b582fcdc4a40f1603461f38bb.jpeg'),
(3, 'Hélicoptères', '1e3876ce1e88ac7d2ec0156634ffea01.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `administrator` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `customer`
--

INSERT INTO `customer` (`id`, `last_name`, `first_name`, `mail`, `password`, `administrator`) VALUES
(18, 'Orival', 'Florent', 'f.dorival@yahoo.fr', '$2y$12$lhqQ4gjfrK8P0NVCP4RF6OpNRgBHxZ5KKGS9BLrWFyyik4vTbMoEW', 'n'),
(20, 'flechon', 'celine', 'c.flechon@hotmail.fr', '$2y$12$7sc4j3NVsjXdt7GO3uqSAOMmu2vZiZlPFcSl1zRjBtv2n/Ryim0fW', 'y'),
(29, 'Dupont', 'Fred', 'f.dupont@gmail.com', '$2y$12$/wP3l3PdGhTS4qq/ejMEfetdGMYNQqXHhCfSfFmpbGVt25oKi9xiW', 'n'),
(38, 'Bel', 'Eric', 'e.bel@orange.fr', '$2y$12$wCBU/I2cl1OFE1jRl3Jt7OeQ5qgGw1s.aAk93XJjSsfrnhUZlPBZm', 'n'),
(39, 'Gonzalez', 'Alexandra', 'choucaxa@hotmail.fr', '$2y$12$2tRw8GFkW252UWsIunvMhOa0GXcu2fuEEFqgZzBzBX3E.5kajw1mm', 'y'),
(40, 'proux', 'arno', 'arnaud.proux@wanadoo.fr', '$2y$12$WxvIu7QBph/TC1681zgypOrV1sOf996R0BeAgj27sJh9xkXBjK7jO', 'n');

-- --------------------------------------------------------

--
-- Structure de la table `order_line`
--

CREATE TABLE `order_line` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `order_line`
--

INSERT INTO `order_line` (`order_id`, `product_id`, `order_quantity`, `price`) VALUES
(15, 4, 1, '179.00'),
(31, 2, 1, '159.90'),
(32, 2, 2, '159.90'),
(32, 4, 1, '179.00'),
(33, 5, 2, '520.00'),
(34, 1, 1, '229.00'),
(35, 4, 2, '179.00'),
(36, 1, 2, '229.00'),
(37, 1, 1, '229.00'),
(38, 2, 1, '159.90'),
(39, 3, 2, '370.00'),
(39, 4, 1, '179.00');

-- --------------------------------------------------------

--
-- Structure de la table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `submited` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `order_list`
--

INSERT INTO `order_list` (`id`, `date`, `submited`, `customer_id`) VALUES
(31, '2017-01-24', 'no', 19),
(32, '2017-01-24', 'yes', 19),
(33, '2017-01-24', 'yes', 19),
(34, '2017-01-24', 'yes', 19),
(35, '2017-01-27', 'yes', 38),
(36, '2017-01-27', 'yes', 38),
(37, '2017-01-27', 'yes', 39),
(38, '2017-01-27', 'yes', 39),
(39, '2017-01-28', 'yes', 40);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `item` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reference` smallint(6) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `item`, `reference`, `price`, `description`, `quantity`, `category_id`, `file`) VALUES
(1, 'Calmato Alpha 1.60m', 1001, '229.00', 'Ce Calmato Alpha aile haute est tout particulièrement destiné aux pilotes débutants qui recherchent un maximum de stabilité sans décrochages intempestifs pour maitriser leur technique de vol. Le choix de la motorisation appartient au pilote.', 8, 1, '5b8ed6324565903f72175e5a5d245a2d.jpeg'),
(2, 'Planeur Héron 2.20m', 2001, '159.90', 'Le HERON MULTIPLEX est un planeur électrique performant avec un empennage en T et une aile à 4 gouvernes. Ses ailes élégantes et son fuselage fin lui permette d\'exploiter la moindre ascendance, et si nécessaire, le puissant moteur Brushless PERMAX relancera vigoureusement l\'hélice à pales repliables (version RR). Le comportement très sain et les performances en vol de cet HERON vous procureront un maximum de plaisir à le piloter, que vous soyez pilote occasionnel ou pilote aguerri. Vous pourrez planer dans les airs avec élégance et précision ou apprécier ses capacités de voltige .', 3, 2, '8abdaad8a7414f6316f79a6fa9b35783.jpeg'),
(3, 'Planeur Mystic 2.90m', 2002, '370.00', 'L\'impressionnant moto-planeur E-flite Mystic vous fera découvrir de nouvelles sensations. Sa motorisation Brushless combinée à sa structure en Z-Foam légère et très résistante vous permettront de voler en toute simplicité. Son impressionnante aile elliptique vous permettra de profiter des thermiques et ses aérofreins vous assureront une grande précision à l\'atterrissage. L\'empennage est composé d\'un stabilisateur pour un contrôle d\'exception à la profondeur. Son aile en 3 parties et son stabilisateur en 2 parties vous permettront de transporter votre modèle facilement.', 1, 2, 'd680b74537bce333822d87deee0e9695.jpeg'),
(4, 'Blade 130X', 3001, '179.00', 'Vous allez vivre une expérience inédite avec le Blade 130 X BNF.\r\nSa conception utilisant la technologie flybarless réduit le frottement de la tête rotor et augmente de façon significative la réponse au cyclique. Cela, combiné à son exceptionnelle légèreté, délivre un niveau de puissance et de réponse qu’aucun autre ultra micro hélicoptère n’avait pu offrir jusque là.\r\nVol inversé, boucles, flips, tonneaux – Le Blade 130X peut tout faire, en intérieur et en extérieur. Si vous avez déjà piloté un hélico basique CCPM ou à pas fixe, vous trouverez que le 130 X est le meilleur moyen pour progresser vers des hélicos CCPM plus complexes sans avoir à investir beaucoup d’argent dans du matériel ou des réparations.', 5, 3, '75b36f639649efe27306bd3a8b957db4.jpeg'),
(5, 'Avion Starlet 2.40m', 1002, '520.00', 'Modèle pratiquement terminé, structure complète en Balsa/CTP entoilée.\r\nModèle de transition idéal pour passer au pilotage 3 axes des grands modèles.\r\nAiles et stabilisateurs démontables pour faciliter le transport.', 0, 1, '8c2fe4584c63dffd13988e59626371cd.jpeg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `IDX_9CE58EE18D9F6D38` (`order_id`),
  ADD KEY `IDX_9CE58EE14584665A` (`product_id`);

--
-- Index pour la table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_939C20F9395C3F3` (`customer_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `FK_9CE58EE14584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_9CE58EE18D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `order_list` (`id`);

--
-- Contraintes pour la table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `FK_F52993989395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
