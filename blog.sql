-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 24 fév. 2022 à 19:21
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `article`, `id_utilisateur`, `id_categorie`, `date`) VALUES
(38, 'Life is Strange Remastered Collection', 'Life is Strange Remastered Collection est une compilation des jeux Life is Strange et Life is Strange : Before the Storm dont les graphismes et les animations seront ameliores. Life is Strange suit l\'histoire de Max Caufield, une etudiante en photographie ayant le pouvoir de remonter dans le temps, et son amie Chloe Price. Life is Strange : Before the Storm, prequelle de Life is Strange, se situe trois ans plus tot et se focalise sur l\'amitie entre les personnages Chloe Price et Rachel Amber.', 3, 1, '2022-02-24 16:18:42'),
(39, 'Dying Light 2 : Stay Human', 'Dying Light 2 est un Survival-Horror dans lequel le joueur doit survivre dans un environnement peuple de zombies. Dans ce nouvel opus, l\'enjeu sera de controler notamment des reserves d\'eau et de nourriture afin de maitriser une cite de survivants. Les choix du joueur ont ainsi une importance capitale dans le deroulement du scenario.\r\n\r\nSortie : 04 fevr. 2022', 3, 1, '2022-02-24 16:44:00'),
(32, 'Nintendo direct', 'Voici certaines super nouvelles annoncÃ©es durant le Nintendo Direct du 09/02/2022:   Annonce dâ€™un nouveau jeu de foot Mario avec Mario Strikers Battle League Football pour le 10 juin 2022 !   Nouvel aperÃ§u de Kirby et les Mondes OubliÃ©s qui est attendu pour le 20 mars 2022 sur Nintendo Switch.    Annonce dâ€™un DLC payant pour Mario Kart 8 avec une sÃ©lection de circuits remasterisÃ©s qui sont issus de tous les anciens jeux Mario Kart.', 3, 1, '2022-02-23 19:17:27'),
(40, 'Star Wars : The Old Republic : Legacy of the Sith', 'Legacy of the Sith est la mise a jour 7.0 du MMORPG Star Wars : The Old Republic. Celle-ci entraine les joueurs dans une campagne militaire visant a s\'emparer d\'une planete vitale pour leur faction afin de decouvrir le plan ultime du renegat Sith, Dark Malgus. De nouvelles zones sont au rendez-vous et le niveau maximal atteignable passe a 80.\r\n\r\nSortie : 15 fevr. 2022', 3, 1, '2022-02-24 16:46:59'),
(41, 'Elden Ring', 'Elden Ring est le nouveau jeu de From Software. Il s\'agit d\'un Action-RPG a la troisieme personne qui se deroule dans un monde ouvert. Le jeu marque la collaboration entre Hidetaka Miyazaki et George R. R. Martin, le createur de Game of Thrones.\r\n\r\nSortie : 25 fevr. 2022', 3, 1, '2022-02-24 17:00:17'),
(42, 'Ghostwire Tokyo', 'Ghostwire Tokyo raconte l\'etrange histoire d\'Akito qui par une nuit tout aussi etrange fusionne avec l\'esprit de KK, un chasseur de fantomes experimente. Ce jeune japonais assiste impuissant a la disparition de la quasi-totalite des habitants de Tokyo. En effet, la capitale nippone est la victime d\'un maitre de l\'occulte nomme Hannya. Ce dernier invoque des forces surnaturelles qui causent de nombreux incidents dans toute la megalopole.', 3, 11, '2022-02-24 17:06:12'),
(43, 'Pokemon Diamant Etincelant / Perle Scintillante', 'Pokemon Diamant Etincelant / Perle Scintillante est un remake de Pokemon Version Diamant / Perle sorti sur Nintendo DS. Avec un nouveau style graphique plutot enfantin, les joueurs peuvent decouvrir ou redecouvrir la region de Sinnoh et retrouver les Pokemons de la quatrieme generation.\r\n\r\nSortie : 19 nov. 2021', 3, 9, '2022-02-24 17:13:12'),
(44, 'Microsoft Flight', 'Microsoft Flight est une simulation de vols gratuite destinee aux neophytes sur PC. Aux commandes d\'un Stearman PT-17 ou d\'un Icon A5, le joueur peut survoler l\'ile d\'Hawai librement ou accepter diverses missions. De nombreux tutoriels sont egalement disponibles pour lui permettre d\'ameliorer ses competences. Microsoft prevoit par ailleurs de proposer regulierement du contenu supplementaire payant pour etoffer l\'experience.\r\n\r\nSortie : 29 fevr. 2012', 3, 12, '2022-02-24 18:52:33'),
(45, 'Amnesia : The Dark Descent', 'Amnesia : The Dark Descent est un jeu d\'action horrifique a la premiere personne sur Mac se deroulant au XVIIIe siecle dans les entrailles d\'un vieux chateau. Une gestion de la physique importante ainsi que la possibilite d\'editer tous les niveaux du jeu a sa convenance grace a des outils avances offrent une grande liberte au joueur.', 3, 8, '2022-02-24 18:57:44'),
(46, 'FIFA 22', 'FIFA 22 est une simulation de football editee par Electronic Arts. Comme chaque saison, le jeu offre son lot d\'ameliorations techniques pour toujours plus de realisme ainsi que des animations et des comportements toujours plus pousses. Les modes carriere et Ultimate Team disposent egalement de nouveaux ajouts.\r\n\r\nSortie : 01 oct. 2021', 3, 10, '2022-02-24 19:00:58');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Nouvelles sorties'),
(10, 'multiplayer'),
(9, 'RPG'),
(8, 'Horreur'),
(11, 'action'),
(12, 'simulation');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(22, 'genial !', 42, 3, '2022-02-24 06:16:48'),
(21, 'Attrapez les tous haha', 43, 3, '2022-02-24 06:16:26'),
(20, 'Je reve de devenir pilote et ce jeu m aide a m entrainer c super', 44, 3, '2022-02-24 06:15:58'),
(19, 'Ce jeu est super !', 45, 3, '2022-02-24 06:14:27'),
(18, 'genial', 37, 3, '2022-02-24 03:19:03'),
(23, 'hate de pouvoir y jouer !', 38, 3, '2022-02-24 06:17:34');

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'modérateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COMMENT='Projet Blog LaPlateforme_';

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(1, 'eden', '$2y$10$a2QIRsud.mbtVc.VNa6erOwtsHE8aySlB64iEdhrF127mm8pFPXhi', 'eden.eden@gmail.com', 42),
(3, 'admin', '$2y$10$zXXGlNk16byhK16Pvgrg/ODw9YqvVL6euvgk1zwt9FGxwqetiu9a2', 'admin.admin@admin.com', 1337),
(14, 'lambyuser', '$2y$10$iFawHw2BxgCb.vffK9/C3OPGb.AOVV.8T3hzIw3rUYTMxqgTW2zCW', 'yuser@yuser.fr', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
