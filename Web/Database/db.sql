-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE TABLE `rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `rank` (`id`, `name`) VALUES
(1,	'Vojín'),
(2,	'Svobodník'),
(3,	'Desátnik'),
(4,	'Četař'),
(5,	'Rotný'),
(6,	'Rotmistr'),
(7,	'Praporčík'),
(8,	'Nadpraporčík'),
(9,	'Stábní praporčík'),
(10,	'Nadporučík'),
(11,	'Kapitán'),
(12,	'Major'),
(13,	'Podpluovník'),
(14,	'Plukovník');

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `role` (`id`, `name`) VALUES
(1,	'Vedení'),
(2,	'Člen'),
(3,	'Host');

CREATE TABLE `squad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_czech_ci NOT NULL,
  `parent_squad_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `squad` (`id`, `name`, `parent_squad_id`) VALUES
(1,	'Velení',	NULL),
(2,	'Gambit 1',	1),
(3,	'Gambit 2',	2),
(4,	'Gambit 3',	2),
(5,	'Gambit 4',	2),
(6,	'Spartan 1',	1),
(7,	'Spartan 2',	6),
(8,	'Spartan 3',	6),
(9,	'LOSO',	1);

CREATE TABLE `user` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `nick` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 3,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` int(9) DEFAULT NULL,
  `note` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `squad_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_super_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_commander` tinyint(1) NOT NULL DEFAULT 0,
  `is_instructor` tinyint(1) NOT NULL DEFAULT 0,
  `is_squadleader` tinyint(1) NOT NULL DEFAULT 0,
  `tactical_points` int(9) DEFAULT NULL,
  `penalty` int(9) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_basic_infantry` tinyint(1) NOT NULL DEFAULT 0,
  `is_advanced_tactics` tinyint(1) NOT NULL DEFAULT 0,
  `is_medic_shooter` tinyint(1) NOT NULL DEFAULT 0,
  `is_cls` tinyint(1) NOT NULL DEFAULT 0,
  `is_doctor` tinyint(1) NOT NULL DEFAULT 0,
  `is_rto_1_cz` tinyint(1) NOT NULL DEFAULT 0,
  `is_rto_2_cz` tinyint(1) NOT NULL DEFAULT 0,
  `is_rto_1_en` tinyint(1) NOT NULL DEFAULT 0,
  `is_rto_2_en` tinyint(1) NOT NULL DEFAULT 0,
  `is_heli_1` tinyint(1) NOT NULL DEFAULT 0,
  `is_heli_2` tinyint(1) NOT NULL DEFAULT 0,
  `is_heli_3` tinyint(1) NOT NULL DEFAULT 0,
  `is_jet_1` tinyint(1) NOT NULL DEFAULT 0,
  `is_jet_2` tinyint(1) NOT NULL DEFAULT 0,
  `is_jet_3` tinyint(1) NOT NULL DEFAULT 0,
  `is_engineer_basic` tinyint(1) NOT NULL DEFAULT 0,
  `is_engineer_adv` tinyint(1) NOT NULL DEFAULT 0,
  `is_sniper` tinyint(1) NOT NULL DEFAULT 0,
  `is_jtac_basic` tinyint(1) NOT NULL DEFAULT 0,
  `is_jtac_adv` tinyint(1) NOT NULL DEFAULT 0,
  `is_driver` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `squad_id` (`squad_id`),
  KEY `rank_id` (`rank_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`squad_id`) REFERENCES `squad` (`id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`rank_id`) REFERENCES `rank` (`id`),
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `user` (`id`, `nick`, `email`, `password`, `role_id`, `date_created`, `date_modified`, `date_deleted`, `deleted_by`, `note`, `squad_id`, `rank_id`, `is_admin`, `is_super_admin`, `is_commander`, `is_instructor`, `is_squadleader`, `tactical_points`, `penalty`, `is_active`, `is_basic_infantry`, `is_advanced_tactics`, `is_medic_shooter`, `is_cls`, `is_doctor`, `is_rto_1_cz`, `is_rto_2_cz`, `is_rto_1_en`, `is_rto_2_en`, `is_heli_1`, `is_heli_2`, `is_heli_3`, `is_jet_1`, `is_jet_2`, `is_jet_3`, `is_engineer_basic`, `is_engineer_adv`, `is_sniper`, `is_jtac_basic`, `is_jtac_adv`, `is_driver`) VALUES
(1,	'admin',	'peter.jurek@gmail.com',	'202cb962ac59075b964b07152d234b70',	3,	'2021-09-15 08:53:41',	'2021-10-06 02:14:44',	NULL,	NULL,	NULL,	5,	5,	1,	1,	0,	0,	0,	8,	NULL,	1,	1,	1,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(2,	'test',	'peter.jurek@gmail.com',	'$2y$10$DQ2jYHut5v2skx6iRT3rIOMG1/2JNcNzih6I2symGvX4hIbv94noW',	3,	'2021-10-05 06:51:10',	'2021-10-06 02:16:07',	NULL,	NULL,	NULL,	4,	4,	0,	0,	0,	0,	0,	NULL,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0);

-- 2021-10-06 05:00:39