-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 14 mars 2025 à 07:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sante`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `date_avis` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `email`, `telephone`) VALUES
(1, 'Abrar', 'Abrar', 'abrar@gmail.com', '0606060606');

-- --------------------------------------------------------

--
-- Structure de la table `developpeur`
--

CREATE TABLE `developpeur` (
  `id` int(11) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `developpeur`
--

INSERT INTO `developpeur` (`id`, `prenom`, `nom`) VALUES
(1, 'ABRAR', 'BOUSLAHI'),
(2, 'TÉO', 'SIMONCINI'),
(3, 'MOHAMED SALIM', 'KTARI'),
(4, 'KHALID', 'SABRY'),
(5, 'DANIELA', 'PONCE-MARTINEZ');

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites`
--

CREATE TABLE `disponibilites` (
  `id` int(11) NOT NULL,
  `id_medecin` int(11) DEFAULT NULL,
  `jour` date DEFAULT NULL,
  `heure` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `disponibilites`
--

INSERT INTO `disponibilites` (`id`, `id_medecin`, `jour`, `heure`) VALUES
(1, 8, '2024-09-10', '19:19:42');

-- --------------------------------------------------------

--
-- Structure de la table `maladies`
--

CREATE TABLE `maladies` (
  `id` int(11) NOT NULL,
  `nom_maladie` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `maladies`
--

INSERT INTO `maladies` (`id`, `nom_maladie`, `description`) VALUES
(1, 'Trouble anxieux généralisé', 'Un trouble mental caractérisé par une anxiété excessive et des inquiétudes persistantes.'),
(2, 'Dépression', 'Un trouble de l’humeur qui provoque une perte d’intérêt ou un sentiment de tristesse.'),
(3, 'Syndrome de stress post-traumatique (SSPT)', 'Un trouble qui peut se développer après une exposition à un événement traumatique.'),
(4, 'Trouble panique', 'Un trouble d’anxiété qui entraîne des attaques de panique soudaines et répétées.'),
(5, 'Crise de panique', 'Une attaque soudaine de peur intense qui provoque des réactions physiques.'),
(6, 'Syndrome d’anxiété', 'Un état d’anxiété prolongé qui affecte le quotidien.'),
(7, 'Maladie coronarienne', 'Un rétrécissement des vaisseaux sanguins qui fournit du sang au cœur.'),
(8, 'Costochondrite', 'Une inflammation du cartilage qui relie une côte au sternum.'),
(9, 'Infection', 'Une invasion de l’organisme par des agents pathogènes.'),
(10, 'Hyperthyroïdie', 'Une condition où la glande thyroïde produit trop d’hormones thyroïdiennes.'),
(11, 'Pneumonie', 'Une infection des poumons qui provoque des inflammations et des difficultés respiratoires.'),
(12, 'Gastro-entérite', 'Une inflammation de l’estomac et de l’intestin qui entraîne des nausées et des diarrhées.'),
(13, 'Appendicite', 'Une inflammation de l’appendice qui nécessite souvent une intervention chirurgicale.'),
(14, 'Colite', 'Une inflammation du côlon qui peut causer des douleurs abdominales et des diarrhées.'),
(15, 'Maladie de Crohn', 'Un trouble inflammatoire chronique du tube digestif.'),
(16, 'Syndrome du côlon irritable', 'Un trouble fonctionnel du gros intestin entraînant des douleurs abdominales et des changements dans les habitudes intestinales.'),
(17, 'Asthme', 'Une maladie respiratoire chronique qui provoque des difficultés respiratoires.'),
(18, 'Emphysème', 'Une maladie pulmonaire obstructive chronique qui affecte la respiration.'),
(19, 'Insuffisance cardiaque', 'Un état dans lequel le cœur ne pompe pas efficacement le sang.'),
(20, 'Embolie pulmonaire', 'Une obstruction d’une artère dans les poumons, souvent causée par un caillot de sang.'),
(21, 'Infarctus du myocarde', 'Une condition grave causée par un manque de circulation sanguine au muscle cardiaque.'),
(22, 'Laryngite', 'Une inflammation du larynx, souvent causée par une infection ou un surmenage vocal.'),
(23, 'Pharyngite', 'Une inflammation du pharynx qui peut causer un mal de gorge.'),
(24, 'Toux persistante', 'Une toux qui dure plus de trois semaines et peut être liée à diverses conditions médicales.'),
(25, 'Migraine', 'Un type de mal de tête sévère qui peut être accompagné de nausées et de sensibilités à la lumière.'),
(26, 'Névralgie', 'Une douleur causée par des lésions nerveuses.'),
(27, 'Syndrome de fatigue chronique', 'Une condition caractérisée par une fatigue persistante et inexpliquée.'),
(28, 'Fibromyalgie', 'Un trouble qui provoque des douleurs musculo-squelettiques généralisées.'),
(29, 'Syndrome de sevrage', 'Un ensemble de symptômes qui surviennent à l’arrêt de la consommation d’une substance.'),
(30, 'COVID-19', 'Une maladie infectieuse causée par le virus SARS-CoV-2.'),
(31, 'Grippe', 'Une infection virale qui affecte les voies respiratoires.'),
(32, 'Rhume', 'Une infection virale bénigne des voies respiratoires supérieures.'),
(33, 'Hépatite', 'Une inflammation du foie causée par une infection virale ou d’autres facteurs.'),
(34, 'Infection urinaire', 'Une infection qui affecte les voies urinaires.'),
(35, 'Syndrome prémenstruel', 'Un ensemble de symptômes physiques et émotionnels qui surviennent avant les règles.'),
(36, 'Syndrome des jambes sans repos', 'Une condition qui provoque une envie irrépressible de bouger les jambes.'),
(37, 'Vertige', 'Une sensation de déséquilibre ou de tournis.'),
(38, 'Allergies', 'Réactions du système immunitaire à des substances normalement inoffensives.'),
(39, 'Trouble de l\'équilibre', 'Difficultés à maintenir la position ou à se déplacer.'),
(40, 'Trouble du sommeil', 'Des difficultés à s’endormir ou à rester endormi.'),
(41, 'Syndrome de la tête qui explose', 'Une sensation soudaine de bruit fort dans la tête au moment de l’endormissement.'),
(42, 'Choc anaphylactique', 'Une réaction allergique sévère qui nécessite une intervention médicale immédiate.');

-- --------------------------------------------------------

--
-- Structure de la table `maladie_symptome`
--

CREATE TABLE `maladie_symptome` (
  `id` int(11) NOT NULL,
  `maladie_id` int(11) DEFAULT NULL,
  `symptome_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `maladie_symptome`
--

INSERT INTO `maladie_symptome` (`id`, `maladie_id`, `symptome_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 1, 5),
(5, 1, 6),
(6, 2, 7),
(7, 3, 8),
(8, 4, 9),
(9, 5, 10),
(10, 6, 11),
(11, 7, 12),
(12, 8, 13),
(13, 9, 14),
(14, 10, 15),
(15, 11, 16),
(16, 12, 17),
(17, 13, 18),
(18, 14, 19),
(19, 15, 20),
(20, 16, 21),
(21, 17, 22),
(22, 18, 23),
(23, 19, 24),
(24, 20, 25),
(25, 21, 26),
(26, 22, 27),
(27, 23, 28),
(28, 24, 29),
(29, 25, 30),
(30, 26, 31),
(31, 27, 32),
(32, 28, 33),
(33, 29, 34),
(34, 30, 35),
(35, 31, 36),
(36, 32, 37),
(37, 33, 38),
(38, 34, 39),
(39, 35, 40),
(40, 36, 41),
(41, 37, 42),
(42, 38, 43),
(43, 39, 44),
(44, 40, 45);

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE `medecin` (
  `id_medecin` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `Region` varchar(255) NOT NULL,
  `CP` int(11) NOT NULL,
  `dates_disponibles` text NOT NULL,
  `telephone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id_medecin`, `Nom`, `specialite`, `Region`, `CP`, `dates_disponibles`, `telephone`) VALUES
(8, 'monsieur dony', 'gynécologue', 'paris', 75000, '2024-09-25,2024-09-26', '5996636652'),
(10, 'SOAP', 'pédiatre', 'nantes', 0, '2024-09-30, 2024-09-23, 2024-09-24', '5996636652'),
(15, 'kol', 'generaliste', 'nantes', 0, '2025-03-26, 2025-03-04', '0603900539'),
(17, 'afrah', 'generaliste', 'nantes', 0, '2025-03-24', '0603900539'),
(19, '3fifaaa', 'generaliste', 'limoges', 0, '2025-03-25', '0603900539'),
(32, 'Dony', 'radiologue', 'nantes', 0, '2025-03-24', '0603900539'),
(33, 'Dony', 'radiologue', 'nantes', 0, '2025-03-24', '0603900539'),
(39, 'Bouslahi Emili', 'gynécologue', 'limoges', 0, '2025-03-24', '0508090808');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_envoi` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE `rdv` (
  `id_rdv` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date_rdv` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_rdv` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date_rdv` date NOT NULL,
  `heure_rdv` time NOT NULL,
  `modeReservation` enum('enligne','presentiel') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_rdv`, `id_medecin`, `id_client`, `date_rdv`, `heure_rdv`, `modeReservation`) VALUES
(31, 17, 1, '2025-03-24', '09:00:00', ''),
(33, 15, 1, '2025-03-26', '09:00:00', ''),
(34, 19, 1, '2025-03-25', '09:00:00', ''),
(35, 19, 1, '2025-03-25', '15:00:00', ''),
(36, 17, 1, '2025-03-24', '15:00:00', ''),
(37, 19, 1, '2002-01-01', '15:00:00', ''),
(38, 39, 1, '2025-03-19', '13:00:00', '');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `medecin_id` int(11) NOT NULL,
  `disponibilite` int(11) NOT NULL,
  `patient_nom` varchar(255) NOT NULL,
  `patient_prenom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `signalement_bugs`
--

CREATE TABLE `signalement_bugs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date_signalement` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `signalement_bugs`
--

INSERT INTO `signalement_bugs` (`id`, `nom`, `email`, `message`, `date_signalement`) VALUES
(1, 'dzafezfdsfds', 'teo@teo.com', 'dfsfsfds', '2024-10-01 14:43:41');

-- --------------------------------------------------------

--
-- Structure de la table `symptomes`
--

CREATE TABLE `symptomes` (
  `id` int(11) NOT NULL,
  `nom_symptome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `symptomes`
--

INSERT INTO `symptomes` (`id`, `nom_symptome`) VALUES
(1, 'Angoisse, stress très important'),
(2, 'Angoisse, stress très important et Douleur au thorax ( cote, poumon, coeur...)'),
(3, 'Angoisse, stress très important et Fièvre ( température > 38°C )'),
(4, 'Angoisse, stress très important et Mal au ventre'),
(5, 'Angoisse, stress très important et Toux'),
(6, 'Diarrhée'),
(7, 'Diarrhée et Démangeaisons ( diffuses ou localisées )'),
(8, 'Diarrhée et Fatigue'),
(9, 'Diarrhée et Fièvre ( température > 38°C )'),
(10, 'Diarrhée et Nausée ou vomissement'),
(11, 'Diarrhée et Sensation de malaise'),
(12, 'Diarrhée et Sueurs'),
(13, 'Diarrhée et Ventre gonflé'),
(14, 'Difficultés importantes pour respirer'),
(15, 'Difficultés importantes pour respirer et Douleur dans le dos (cervicales, lombaires, coccyx...)'),
(16, 'Difficultés importantes pour respirer et Fatigue'),
(17, 'Difficultés importantes pour respirer et Fièvre ( température > 38°C )'),
(18, 'Difficultés importantes pour respirer et Mal au ventre'),
(19, 'Difficultés importantes pour respirer et Nausée ou vomissement'),
(20, 'Douleur au thorax ( cote, poumon, coeur...)'),
(21, 'Douleur au thorax ( cote, poumon, coeur...) et Angoisse, stress très important'),
(22, 'Douleur au thorax ( cote, poumon, coeur...) et Démangeaisons ( diffuses ou localisées )'),
(23, 'Douleur au thorax ( cote, poumon, coeur...) et Fièvre ( température > 38°C )'),
(24, 'Douleur au thorax ( cote, poumon, coeur...) et Mal au ventre'),
(25, 'Douleur au thorax ( cote, poumon, coeur...) et Nausée ou vomissement'),
(26, 'Douleur au thorax ( cote, poumon, coeur...) et Sueurs'),
(27, 'Douleur dans le cou (cervicale)'),
(28, 'Douleur dans le cou (cervicale) et Fatigue'),
(29, 'Douleur dans le cou (cervicale) et Fièvre ( température > 38°C )'),
(30, 'Douleur dans le cou (cervicale) et Nausée ou vomissement'),
(31, 'Douleur dans le cou (cervicale) et Vertiges, tête qui tourne'),
(32, 'Fatigue'),
(33, 'Fatigue et Diarrhée'),
(34, 'Fatigue et Difficultés importantes pour respirer'),
(35, 'Fatigue et Douleur dans le cou (cervicale)'),
(36, 'Fatigue et Fièvre ( température > 38°C )'),
(37, 'Fatigue et Frissons'),
(38, 'Fatigue et Mal au ventre'),
(39, 'Fatigue et Nausée ou vomissement'),
(40, 'Fatigue et Saignement de nez'),
(41, 'Fatigue et Sensation de malaise'),
(42, 'Fatigue et Soif permanente'),
(43, 'Fatigue et Sueurs'),
(44, 'Fièvre ( température > 38°C )'),
(45, 'Fièvre ( température > 38°C ) et Absence de selle depuis plusieurs jours'),
(46, 'Fièvre ( température > 38°C ) et Angoisse, stress très important'),
(47, 'Fièvre ( température > 38°C ) et Coeur rapide : pouls > 90 battements / min'),
(48, 'Fièvre ( température > 38°C ) et Diarrhée'),
(49, 'Fièvre ( température > 38°C ) et Difficultés importantes pour respirer'),
(50, 'Fièvre ( température > 38°C ) et Douleur au thorax ( cote, poumon, coeur...)'),
(51, 'Fièvre ( température > 38°C ) et Douleur dans le cou (cervicale)'),
(52, 'Fièvre ( température > 38°C ) et Douleur dans le dos (cervicales, lombaires, coccyx...)'),
(53, 'Fièvre ( température > 38°C ) et Douleur de jambe : du genou à la cheville'),
(54, 'Fièvre ( température > 38°C ) et Douleur de l oreille'),
(55, 'Fièvre ( température > 38°C ) et Fatigue'),
(56, 'Fièvre ( température > 38°C ) et Gonflement de la gencive'),
(57, 'Fièvre ( température > 38°C ) et Hallucinations'),
(58, 'Fièvre ( température > 38°C ) et Mal à une ou des dents'),
(59, 'Fièvre ( température > 38°C ) et Mal au ventre'),
(60, 'Fièvre ( température > 38°C ) et Nausée ou vomissement'),
(61, 'Fièvre ( température > 38°C ) et Saignement de nez'),
(62, 'Fièvre ( température > 38°C ) et Tremblements'),
(63, 'Fièvre ( température > 38°C ) et Urines très foncées'),
(64, 'Fièvre ( température > 38°C ) et Vertiges, tête qui tourne'),
(65, 'Frissons'),
(66, 'Frissons et Fatigue'),
(67, 'Frissons et Mal à la tête (Céphalées)'),
(68, 'Frissons et Mal au ventre'),
(69, 'Frissons et Nausée ou vomissement'),
(70, 'Frissons et Sueurs'),
(71, 'Frissons et Vertiges, tête qui tourne'),
(72, 'Mal à la tête (Céphalées)'),
(73, 'Mal à la tête (Céphalées) et Crampes musculaires'),
(74, 'Mal à la tête (Céphalées) et Frissons'),
(75, 'Mal à la tête (Céphalées) et Saignement de nez'),
(76, 'Mal à la tête (Céphalées) et Soif permanente'),
(77, 'Mal à la tête (Céphalées) et Sueurs'),
(78, 'Mal à la tête (Céphalées) et Tremblements'),
(79, 'Mal au ventre'),
(80, 'Mal au ventre et Angoisse, stress très important'),
(81, 'Mal au ventre et Coeur rapide : pouls > 90 battements / min'),
(82, 'Mal au ventre et Démangeaisons ( diffuses ou localisées )'),
(83, 'Mal au ventre et Difficultés importantes pour respirer'),
(84, 'Mal au ventre et Douleur au thorax ( cote, poumon, coeur...)'),
(85, 'Mal au ventre et Fatigue'),
(86, 'Mal au ventre et Fièvre ( température > 38°C )'),
(87, 'Mal au ventre et Frissons'),
(88, 'Mal au ventre et Nausée ou vomissement'),
(89, 'Mal au ventre et Saignement vaginal (autre que des règles)'),
(90, 'Mal au ventre et Selles anormales (sang, diarrhées, décolorées...)'),
(91, 'Mal au ventre et Sensation de malaise'),
(92, 'Mal au ventre et Soif permanente'),
(93, 'Mal au ventre et Sueurs'),
(94, 'Mal au ventre et Toux'),
(95, 'Mal au ventre et Tremblements'),
(96, 'Mal au ventre et Urines rouges'),
(97, 'Mal au ventre et Urines très foncées'),
(98, 'Mal au ventre et Vertiges, tête qui tourne'),
(99, 'Nausée ou vomissement'),
(100, 'Nausée ou vomissement et Diarrhée'),
(101, 'Nausée ou vomissement et Difficultés importantes pour respirer'),
(102, 'Nausée ou vomissement et Douleur au thorax ( cote, poumon, coeur...)'),
(103, 'Nausée ou vomissement et Douleur dans le cou (cervicale)'),
(104, 'Nausée ou vomissement et Douleur de bras (de l’épaule au coude)'),
(105, 'Nausée ou vomissement et Fatigue'),
(106, 'Nausée ou vomissement et Fièvre ( température > 38°C )'),
(107, 'Nausée ou vomissement et Frissons'),
(108, 'Nausée ou vomissement et Mal au ventre'),
(109, 'Nausée ou vomissement et Saignement vaginal (autre que des règles)'),
(110, 'Nausée ou vomissement et Sensation de malaise'),
(111, 'Nausée ou vomissement et Sueurs'),
(112, 'Nausée ou vomissement et Ventre gonflé'),
(113, 'Nausée ou vomissement et Vertiges, tête qui tourne'),
(114, 'Saignement de nez'),
(115, 'Saignement de nez et Fatigue'),
(116, 'Saignement de nez et Fièvre ( température > 38°C )'),
(117, 'Saignement de nez et Mal à la tête (Céphalées)'),
(118, 'Saignement de nez et Vertiges, tête qui tourne'),
(119, 'Sensation de malaise'),
(120, 'Sensation de malaise et Diarrhée'),
(121, 'Sensation de malaise et Difficultés importantes pour respirer'),
(122, 'Sensation de malaise et Fatigue'),
(123, 'Sensation de malaise et Fièvre ( température > 38°C )'),
(124, 'Sensation de malaise et Mal au ventre'),
(125, 'Sensation de malaise et Soif permanente'),
(126, 'Sensation de malaise et Sueurs'),
(127, 'Sensation de malaise et Urines très foncées'),
(128, 'Soif permanente'),
(129, 'Soif permanente et Fatigue'),
(130, 'Soif permanente et Fièvre ( température > 38°C )'),
(131, 'Soif permanente et Mal au ventre'),
(132, 'Sueurs'),
(133, 'Sueurs et Fièvre ( température > 38°C )'),
(134, 'Sueurs et Fatigue'),
(135, 'Sueurs et Frissons'),
(136, 'Sueurs et Mal au ventre'),
(137, 'Tremblements'),
(138, 'Tremblements et Fatigue'),
(139, 'Tremblements et Frissons'),
(140, 'Tremblements et Mal au ventre'),
(141, 'Tremblements et Vertiges, tête qui tourne'),
(142, 'Urines très foncées'),
(143, 'Urines très foncées et Fatigue'),
(144, 'Urines très foncées et Fièvre ( température > 38°C )'),
(145, 'Urines très foncées et Mal au ventre'),
(146, 'Vertiges, tête qui tourne'),
(147, 'Vertiges, tête qui tourne et Fatigue'),
(148, 'Vertiges, tête qui tourne et Fièvre ( température > 38°C )'),
(149, 'Vertiges, tête qui tourne et Mal au ventre');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(150) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `numero_mobile` varchar(15) NOT NULL,
  `genre` enum('Homme','Femme','Autre') NOT NULL,
  `role` enum('PATIENT','MEDECIN') NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `date_naissance`, `email`, `motdepasse`, `numero_mobile`, `genre`, `role`, `message`, `created_at`) VALUES
(8, 'simon', '2002-06-17', 'theo@theo.com', 'alberto', '06060606', 'Homme', 'MEDECIN', '', '2024-10-06 09:44:55'),
(21, 'simonc', '2000-01-01', 'teo@teo.com', '$2y$10$gdA6AYBlBBex2uX.FCOawevjrzjbLyy3AM93nZCtSlzIqqqvLI8e2', '0606060606', 'Femme', 'PATIENT', '', '2024-10-06 09:44:55'),
(22, 'abrar', '1900-01-01', 'abrar@gmail.com', '$2y$10$Kyym1Bq.i6McRacv7sY0uu.OZwABOrAYLdxP2EwsEw1Tq3Fb6xf5q', '666', 'Homme', 'PATIENT', '', '2024-10-06 09:44:55'),
(23, 'khalid', '2000-10-10', 'mail@mail.com', '$2y$10$0.25UhkhTDOPrZXG4ZlPBeCbtTSdGwgBmVxk9lGdfmIk9uvHmMCUi', '0606060606', 'Autre', 'PATIENT', '', '2024-10-06 09:44:55'),
(26, 'toto', '2000-06-06', 't@t.com', 'toto', '0606060606', 'Homme', 'PATIENT', '', '2024-10-06 09:44:55'),
(27, 'albert', '2000-01-01', 'm@m.com', 'medecin', '06606060606', 'Homme', 'MEDECIN', '', '2024-10-07 05:37:20'),
(28, 'albert', '2000-02-01', 'p@p.com', 'patient', '60606065', 'Homme', 'PATIENT', '', '2024-10-07 05:38:01');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `id_medecin` (`id_medecin`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `developpeur`
--
ALTER TABLE `developpeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medecin` (`id_medecin`);

--
-- Index pour la table `maladies`
--
ALTER TABLE `maladies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `maladie_symptome`
--
ALTER TABLE `maladie_symptome`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maladie_id` (`maladie_id`),
  ADD KEY `symptome_id` (`symptome_id`);

--
-- Index pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`id_medecin`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_patient` (`id_patient`),
  ADD KEY `id_medecin` (`id_medecin`);

--
-- Index pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`id_rdv`),
  ADD KEY `id_medecin` (`id_medecin`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_rdv`),
  ADD KEY `id_medecin` (`id_medecin`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medecin_id` (`medecin_id`),
  ADD KEY `disponibilite` (`disponibilite`);

--
-- Index pour la table `signalement_bugs`
--
ALTER TABLE `signalement_bugs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `symptomes`
--
ALTER TABLE `symptomes`
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
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `developpeur`
--
ALTER TABLE `developpeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `maladies`
--
ALTER TABLE `maladies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `maladie_symptome`
--
ALTER TABLE `maladie_symptome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `id_medecin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `id_rdv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_rdv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `signalement_bugs`
--
ALTER TABLE `signalement_bugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `symptomes`
--
ALTER TABLE `symptomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_medecin`) REFERENCES `medecin` (`id_medecin`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  ADD CONSTRAINT `disponibilites_ibfk_1` FOREIGN KEY (`id_medecin`) REFERENCES `medecin` (`id_medecin`);

--
-- Contraintes pour la table `maladie_symptome`
--
ALTER TABLE `maladie_symptome`
  ADD CONSTRAINT `maladie_symptome_ibfk_1` FOREIGN KEY (`maladie_id`) REFERENCES `maladies` (`id`),
  ADD CONSTRAINT `maladie_symptome_ibfk_2` FOREIGN KEY (`symptome_id`) REFERENCES `symptomes` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_patient`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`id_medecin`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`id_medecin`) REFERENCES `medecin` (`id_medecin`),
  ADD CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_medecin`) REFERENCES `medecin` (`id_medecin`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`medecin_id`) REFERENCES `medecin` (`id_medecin`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`disponibilite`) REFERENCES `disponibilites` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
