SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `server_agents`;
CREATE TABLE `server_agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text COLLATE utf8mb4_czech_ci NOT NULL,
  `name` text COLLATE utf8mb4_czech_ci NOT NULL,
  `drive_capacity_kb` int(12) DEFAULT NULL,
  `drive_free_space_kb` int(12) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_seen` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

DROP TABLE IF EXISTS `addons`;
CREATE TABLE `addons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_agent_id` int(11) NOT NULL,
  `addon_id` int(11) DEFAULT NULL,
  `addon_name` text COLLATE utf8mb4_czech_ci NOT NULL,
  `addon_size_bytes` int(12) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `desired_status` int(2) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `server_agent_id` (`server_agent_id`),
  CONSTRAINT `addons_ibfk_1` FOREIGN KEY (`server_agent_id`) REFERENCES `server_agents` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

DROP TABLE IF EXISTS `login_role`;
CREATE TABLE `login_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `center`;
CREATE TABLE `center` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  `is_active` smallint(1) NOT NULL DEFAULT 1,
  `note` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `abbreviation` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `detachment`;
CREATE TABLE `detachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  `center_id` int(9) DEFAULT 1,
  `parent_detachment_id` int(9) DEFAULT NULL,
  `note` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `abbreviation` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `is_active` smallint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `center_id` (`center_id`),
  CONSTRAINT `detachment_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

DROP TABLE IF EXISTS `squad_type`;
CREATE TABLE `squad_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `squad`;
CREATE TABLE `squad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_czech_ci NOT NULL,
  `squad_type_id` int(11) NOT NULL DEFAULT 2,
  `parent_squad_id` int(11) DEFAULT NULL,
  `detachment_id` int(11) DEFAULT NULL,
  `center_id` int(9) DEFAULT NULL,
  `note` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `abbreviation` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `is_active` smallint(1) DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detachment_id` (`detachment_id`),
  KEY `center_id` (`center_id`),
  KEY `squad_type_id` (`squad_type_id`),
  CONSTRAINT `squad_ibfk_1` FOREIGN KEY (`detachment_id`) REFERENCES `detachment` (`id`) ON DELETE CASCADE,
  CONSTRAINT `squad_ibfk_2` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`) ON DELETE CASCADE,
  CONSTRAINT `squad_ibfk_3` FOREIGN KEY (`squad_type_id`) REFERENCES `squad_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `course_level`;
CREATE TABLE `course_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  `abbreviation` varchar(64) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `required_course_level` tinyint(9) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `course_completition_type`;
CREATE TABLE `course_completition_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  `course_level_id` int(11) NOT NULL,
  `abbreviation` varchar(64) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_level_id` (`course_level_id`),
  CONSTRAINT `course_ibfk_1` FOREIGN KEY (`course_level_id`) REFERENCES `course_level` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `instructor`;
CREATE TABLE `instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(9) NOT NULL,
  `course_id` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `instructor_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `course_completed`;
CREATE TABLE `course_completed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_completition_type_id` int(11) NOT NULL,
  `completition_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_exam_date` datetime NOT NULL DEFAULT current_timestamp(),
  `next_exam_date` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `note` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`),
  KEY `course_completition_type_id` (`course_completition_type_id`),
  KEY `instructor_id` (`instructor_id`),
  CONSTRAINT `course_completed_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `course_completed_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `course_completed_ibfk_3` FOREIGN KEY (`course_completition_type_id`) REFERENCES `course_completition_type` (`id`),
  CONSTRAINT `course_completed_ibfk_7` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `rank`;
CREATE TABLE `rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `nick` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `discord_id` varchar(64) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `steam_id` varchar(64) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `login_role_id` int(11) NOT NULL DEFAULT 3,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` int(9) DEFAULT NULL,
  `note` text COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `squad_id` int(11) DEFAULT NULL,
  `squad_pos` int(9) DEFAULT NULL,
  `rank_id` int(11) NOT NULL DEFAULT 1,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_super_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_commander` tinyint(1) NOT NULL DEFAULT 0,
  `is_instructor` tinyint(1) NOT NULL DEFAULT 0,
  `is_squadleader` tinyint(1) NOT NULL DEFAULT 0,
  `tactical_points` int(9) NOT NULL DEFAULT 0,
  `penalty` int(9) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `squad_id` (`squad_id`),
  KEY `rank_id` (`rank_id`),
  KEY `login_role_id` (`login_role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`squad_id`) REFERENCES `squad` (`id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`rank_id`) REFERENCES `rank` (`id`),
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`login_role_id`) REFERENCES `login_role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

DROP TABLE IF EXISTS `event_type`;
CREATE TABLE `event_type` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_czech_ci NOT NULL,
  `note` text COLLATE utf8mb4_czech_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `created_by` int(9) DEFAULT NULL,
  `deleted_by` int(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type_id` int(9) NOT NULL,
  `name` text COLLATE utf8mb4_czech_ci NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `description` text COLLATE utf8mb4_czech_ci NOT NULL,
  `slots_count` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `zeus` int(11) DEFAULT NULL,
  `instructor` int(11) DEFAULT NULL,
  `deleted_by` int(9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_type_id` (`event_type_id`),
  KEY `instructor` (`instructor`),
  CONSTRAINT `event_ibfk_1` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`),
  CONSTRAINT `event_ibfk_2` FOREIGN KEY (`instructor`) REFERENCES `instructor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

DROP TABLE IF EXISTS `bootcamp_class`;
CREATE TABLE `bootcamp_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_number` varchar(256) COLLATE utf8mb4_czech_ci NOT NULL,
  `label` varchar(256) COLLATE utf8mb4_czech_ci NOT NULL,
  `is_active` smallint(1) NOT NULL DEFAULT 1,
  `active_since` date DEFAULT NULL,
  `active_until` date DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `bootcamp_subject`;
CREATE TABLE `bootcamp_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bootcamp_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bootcamp_id` (`bootcamp_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `bootcamp_subject_ibfk_1` FOREIGN KEY (`bootcamp_id`) REFERENCES `bootcamp_class` (`id`),
  CONSTRAINT `bootcamp_subject_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `training_status`;
CREATE TABLE `training_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(256) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `color` varchar(256) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

DROP TABLE IF EXISTS `bootcamp_class_participant`;
CREATE TABLE `bootcamp_class_participant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bootcamp_class_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `training_status_id` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_not_ready` datetime DEFAULT NULL,
  `date_ready` datetime DEFAULT NULL,
  `date_mandatory` datetime DEFAULT NULL,
  `date_discarded` datetime DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bootcamp_class_id` (`bootcamp_class_id`),
  KEY `user_id` (`user_id`),
  KEY `training_status_id` (`training_status_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `bootcamp_class_participant_ibfk_1` FOREIGN KEY (`bootcamp_class_id`) REFERENCES `bootcamp_class` (`id`),
  CONSTRAINT `bootcamp_class_participant_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `bootcamp_class_participant_ibfk_3` FOREIGN KEY (`training_status_id`) REFERENCES `training_status` (`id`),
  CONSTRAINT `bootcamp_class_participant_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `bootcamp_class_role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

DROP TABLE IF EXISTS `bootcamp_class_role`;
CREATE TABLE `bootcamp_class_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(256) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(9) NOT NULL,
  `login_role_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`login_role_id`) REFERENCES `login_role` (`id`)
) COLLATE 'utf8mb4_czech_ci';

INSERT INTO `login_role` (`id`, `name`) VALUES
(1,	'admin'),
(2,	'member'),
(3,	'guest');

INSERT INTO `center` (`id`, `name`, `is_active`, `note`, `description`, `abbreviation`, `date_created`, `created_by`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`) VALUES
(1,	'Velitelské středisko',	1,	'tu jsou velitelé',	'velitelé',	'VS',	'2022-01-07 21:19:16',	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'1. Středisko speciálního výcviku',	1,	'tu prebieha mučenie',	'Výcvik',	'1SSV',	'2022-01-09 20:17:50',	1,	NULL,	NULL,	'2022-01-09 19:31:42',	NULL),
(3,	'Bojové středisko',	1,	'tu sa vraždí',	'bojovníci',	'BS',	'2022-01-07 21:19:55',	1,	NULL,	NULL,	'2022-01-09 19:31:53',	NULL),
(4,	'Letecký Odřad Speciálních Operací',	1,	'Tu sa ničí technika (vlastná)',	'Piloti',	'LOSO',	'2022-05-15 13:42:14',	NULL,	NULL,	NULL,	'2022-05-15 11:42:40',	NULL);

INSERT INTO `detachment` (`id`, `name`, `center_id`, `parent_detachment_id`, `note`, `description`, `abbreviation`, `is_active`, `date_created`, `date_deleted`, `date_modified`, `created_by`, `deleted_by`) VALUES
(1,	'Gambit',	3,	NULL,	'',	'Bojovníci gambitu',	'G',	1,	'2022-01-07 21:23:42',	NULL,	'2022-01-09 19:32:06',	0,	0),
(2,	'Spartan',	3,	NULL,	'',	'Bojovníci Spartanu',	'S',	1,	'2022-01-09 20:19:24',	NULL,	'2022-05-15 11:36:35',	2,	0),
(3,	'Letecký odřad speciálních operací',	4,	NULL,	'tu sa ničí technika (vlastná)',	'Letectví a obsluha',	'SOATU/LOSO',	1,	'2022-01-23 14:40:57',	NULL,	'2022-05-15 11:46:22',	1,	0),
(4,	'TACP',	3,	NULL,	'',	'',	'',	1,	'2022-01-23 20:09:28',	'2022-01-23 20:09:33',	'2022-05-15 11:46:25',	1,	1);

INSERT INTO `squad_type` (`id`, `name`) VALUES
(1,	'Kancelář'),
(2,	'Bojové družstvo'),
(3,	'Letka'),
(4,	'Nezařazeno');

INSERT INTO `squad` (`id`, `name`, `squad_type_id`, `parent_squad_id`, `detachment_id`, `center_id`, `note`, `description`, `abbreviation`, `is_active`, `date_created`, `date_deleted`, `date_modified`, `created_by`, `deleted_by`) VALUES
(1,	'Velitelská kancelář',	1,	NULL,	NULL,	1,	NULL,	NULL,	NULL,	1,	'2022-01-28 20:27:20',	NULL,	NULL,	0,	0),
(2,	'Personální oddělení',	1,	NULL,	NULL,	1,	NULL,	NULL,	NULL,	1,	'2022-01-28 20:28:51',	NULL,	NULL,	0,	0),
(3,	'Velitelství speciálního výcviku',	1,	NULL,	NULL,	2,	NULL,	NULL,	NULL,	1,	'2022-01-28 20:29:25',	NULL,	'2022-01-28 19:31:01',	0,	0),
(4,	'Kancelář instruktorů',	1,	NULL,	NULL,	2,	NULL,	NULL,	NULL,	1,	'2022-01-28 20:30:22',	NULL,	'2022-01-28 19:31:05',	0,	0),
(5,	'Výcvikové středisko',	1,	NULL,	NULL,	2,	'',	'Pro členy v základním výcviku',	'VS',	1,	'2022-05-14 20:26:57',	NULL,	NULL,	2,	NULL),
(6,	'Gambit 1',	2,	NULL,	1,	3,	'',	'',	'G1',	1,	'2022-05-15 13:35:14',	NULL,	NULL,	2,	NULL),
(7,	'Gambit 2',	2,	NULL,	1,	3,	'',	'',	'G2',	1,	'2022-05-15 13:35:27',	NULL,	NULL,	2,	NULL),
(8,	'Gambit 3',	2,	NULL,	1,	3,	'',	'',	'G3',	1,	'2022-05-15 13:36:21',	NULL,	NULL,	2,	NULL),
(9,	'Spartan 1',	2,	NULL,	2,	3,	'',	'',	'S1',	1,	'2022-05-15 13:36:48',	NULL,	NULL,	2,	NULL),
(10,	'Spartan 2',	2,	NULL,	2,	3,	'',	'',	'S2',	1,	'2022-05-15 13:37:03',	NULL,	NULL,	2,	NULL),
(11,	'Spartan 3',	2,	NULL,	2,	3,	'',	'',	'S3',	1,	'2022-05-15 13:37:19',	NULL,	NULL,	2,	NULL),
(12,	'SOATU/LOSO',	3,	NULL,	NULL,	4,	NULL,	NULL,	NULL,	1,	'2022-05-15 13:52:55',	NULL,	NULL,	0,	NULL);

INSERT INTO `course_level` (`id`, `name`, `abbreviation`, `description`, `note`, `required_course_level`, `date_created`, `date_modified`, `date_deleted`) VALUES
(1,	'Základní povinné kurzy',	NULL,	NULL,	NULL,	1,	'2021-12-03 07:21:58',	'2021-12-03 06:22:34',	NULL),
(2,	'Pokročilé kurzy',	NULL,	NULL,	NULL,	1,	'2021-12-03 07:22:53',	NULL,	NULL),
(3,	'Specializované kurzy',	NULL,	NULL,	NULL,	2,	'2021-12-03 07:23:23',	NULL,	NULL),
(4,	'Nezařazeno',	'',	'',	'',	NULL,	'2021-12-03 07:59:03',	NULL,	NULL);

INSERT INTO `course_completition_type` (`id`, `name`) VALUES
(1,	'Splněn'),
(2,	'Nesplněn'),
(3,	'Probíhá'),
(4,	'Instruktor'),
(5,	'Odebrán');


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

INSERT INTO `event_type` (`id`, `name`, `note`, `date_created`, `date_modified`, `date_deleted`, `created_by`, `deleted_by`) VALUES
(1,	'Kampaň',	'Mise kampaně.\r\nDocházka je povinná, pokud není řečeno jinak.\r\nMusí mít speciální tabulku.\r\nMusí být schválena vedením.\r\nMůžou běžet pouze 2 kampaně najednou.',	'2021-12-18 15:29:44',	NULL,	NULL,	NULL,	NULL),
(2,	'Mise',	'Oficiální mise vytvořena MM.\r\nMusí mít tabulku.\r\nMise je vytvořena v editoru a musí se hlásit dopředu.\r\nMusí být schválena vedením.',	'2021-12-18 15:30:05',	NULL,	NULL,	NULL,	NULL),
(3,	'Zeus mise',	'Mise kampaně.\r\nDocházka je povinná, pokud není řečeno jinak.\r\nMusí mít speciální tabulku.\r\nMusí být schválena vedením.\r\nMůžou běžet pouze 2 kampaně najednou.',	'2021-12-18 15:30:26',	NULL,	NULL,	NULL,	NULL),
(4,	'JointOp',	'žluté ohraničení - čas kdy probíhá zahraniční operace zapsaná v listu NATO ',	'2021-12-18 15:30:56',	NULL,	NULL,	NULL,	NULL),
(5,	'Trénink',	'',	'2021-12-18 15:31:08',	NULL,	NULL,	NULL,	NULL),
(6,	'Výcvik',	'',	'2021-12-18 15:31:17',	NULL,	NULL,	NULL,	NULL),
(7,	'Porada',	'',	'2021-12-18 15:31:21',	NULL,	NULL,	NULL,	NULL),
(8,	'Volná hra',	'- Event, který může založit jakýkoliv člen četař+\r\n- Může být max 3 hodiny týdně\r\n- Může se jednat o libovolnou skupinovou aktivitu v libovolné hře\r\n- např. Liberation, konvoj v ETS2, GTA 5, Minecraft, atd...',	'2021-12-18 15:31:42',	NULL,	NULL,	NULL,	NULL);

INSERT INTO `training_status` (`id`, `label`, `color`, `date_created`, `date_modified`, `date_deleted`, `created_by`, `deleted_by`) VALUES
(1,	'Není připraven',	'#D0021B',	'2022-02-12 13:47:47',	'2022-02-12 13:51:33',	NULL,	NULL,	NULL),
(2,	'Je připraven',	'#3176A6',	'2022-02-12 13:48:00',	'2022-02-12 13:51:33',	NULL,	NULL,	NULL),
(3,	'Povinné hotové',	'#4EA631',	'2022-02-12 13:48:10',	'2022-02-12 13:51:33',	NULL,	NULL,	NULL),
(4,	'Vyřazen',	'#9B9B9B',	'2022-02-12 13:48:20',	'2022-02-12 13:51:33',	NULL,	NULL,	NULL);

INSERT INTO `bootcamp_class_role` (`id`, `label`, `date_created`, `date_modified`, `date_deleted`, `created_by`, `deleted_by`) VALUES
(1,	'Hlavní instruktor',	'2022-02-15 05:00:38',	NULL,	NULL,	NULL,	NULL),
(2,	'Mladší instruktor',	'2022-02-15 05:00:46',	NULL,	NULL,	NULL,	NULL),
(3,	'Rekrut',	'2022-02-15 05:01:19',	NULL,	NULL,	NULL,	NULL);

INSERT INTO `server_agents` (`id`, `token`, `name`, `drive_capacity_kb`, `drive_free_space_kb`, `date_created`, `date_last_seen`) VALUES
(1,	'klokanek',	'Test Server',	1,	1,	'2021-12-21 20:54:40',	NULL);

INSERT INTO `user_role` (`id`, `user_id`, `login_role_id`) VALUES
(3,	2,	1),
(4,	49,	2),
(5,	50,	2),
(6,	51,	2);

INSERT INTO `course` (`id`, `name`, `course_level_id`, `abbreviation`, `description`, `note`, `date_created`, `date_modified`, `date_deleted`) VALUES
(1,	'Komplexní základní výcvik',	1,	'KZP',	'',	'',	'2022-01-29 15:40:55',	NULL,	NULL),
(2,	'Medic/Střelec',	1,	'Medic',	'',	'',	'2022-05-16 20:13:35',	NULL,	NULL),
(3,	'Doškolovací intenzivní výcvik',	1,	'DIV',	'',	'',	'2022-05-16 20:16:26',	NULL,	NULL),
(4,	'Základní spojovací příprava',	1,	'RTO 0',	'',	'',	'2022-05-16 20:17:01',	'2022-05-16 18:19:16',	NULL),
(5,	'Malá Spojovací příprava',	2,	'RTO 1',	'',	'',	'2022-05-16 20:17:18',	'2022-05-16 18:19:29',	NULL),
(6,	'Velká Spojovací příprava',	3,	'RTO 2',	'',	'',	'2022-05-16 20:19:49',	'2022-05-16 18:20:05',	NULL),
(7,	'Pilot - rotary',	3,	'HELI',	'',	'',	'2022-05-16 20:20:32',	NULL,	NULL),
(8,	'Pilot - fixed',	3,	'JET',	'',	'',	'2022-05-16 20:21:35',	NULL,	NULL),
(9,	'Ženista - základ',	1,	'',	'',	'',	'2022-05-16 20:21:52',	'2022-05-16 18:22:12',	NULL),
(10,	'Ženista - pokročilý',	2,	'',	'',	'',	'2022-05-16 20:22:04',	NULL,	NULL),
(11,	'Sharpshooter/Marskman',	2,	'SHS',	'',	'',	'2022-05-16 20:22:54',	NULL,	NULL),
(12,	'Sniper',	3,	'ODS',	'',	'',	'2022-05-16 20:23:18',	NULL,	NULL),
(13,	'Joint Terminal Attack Controller',	3,	'JTAC',	'',	'',	'2022-05-16 20:24:15',	NULL,	NULL),
(14,	'Pilot - Blízká letecká podpora',	3,	'CAS',	'',	'',	'2022-05-16 20:25:26',	NULL,	NULL);

INSERT INTO `user` (`id`, `nick`, `email`, `password`, `discord_id`, `steam_id`, `login_role_id`, `date_created`, `date_modified`, `date_deleted`, `deleted_by`, `note`, `squad_id`, `squad_pos`, `rank_id`, `is_admin`, `is_super_admin`, `is_commander`, `is_instructor`, `is_squadleader`, `tactical_points`, `penalty`, `is_active`, `date_last_login`) VALUES
(2,	'admin',	'peter.jurek@gmail.com',	'$2y$10$tH9goK/PKe4oeXMMsSNxXOJ/gY3oP1A0cmHVAEW8jwL4w.90D..l.',	'0',	'0',	1,	'2021-10-15 07:09:10',	'2022-01-29 14:31:39',	NULL,	NULL,	'',	1,	1,	8,	1,	1,	0,	0,	0,	8,	0,	1,	'2022-05-15 10:59:30'),
(6,	'Pjoczech',	'test@test.cz',	'$2y$10$RUUzX0VqXRcy/jlAtSHVxuOf.Teg4imp.yh3IeLnu.H5wBbHyc.8C',	NULL,	NULL,	2,	'2022-05-16 20:35:29',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:35:29'),
(7,	'3YRON',	'test@test.cz',	'$2y$10$U.0ckOpG2aPBlDoqo3MNW.rQrlXJ.23FL64cmzrPDgOswfm3zbLBO',	NULL,	NULL,	2,	'2022-05-16 20:35:44',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:35:44'),
(8,	'Shelby',	'test@test.cz',	'$2y$10$gpkO/SRYTAoghWKsLz03p.ragXf7QPoNgv882qEQyF/ec8iYbnk36',	NULL,	NULL,	2,	'2022-05-16 20:36:00',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:36:00'),
(9,	'Jakub',	'test@test.cz',	'$2y$10$0D2TD6jpuF1jaBDP17A8FeWDnK3PImF0hFl6wzz1Rnan5zgXhmXTG',	NULL,	NULL,	2,	'2022-05-16 20:36:13',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:36:13'),
(10,	'Mericius',	'test@test.cz',	'$2y$10$rrg6eJfFxyo2Kj8xbeH9Ku7C9QxNXVvWmtjYyW4d5KrN/Ah6KeAQ.',	NULL,	NULL,	2,	'2022-05-16 20:36:31',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:36:31'),
(11,	'DarkWolfCZ',	'test@test.cz',	'$2y$10$Wxq9taxqHbXkpxwr5dkMw.wejpUKci3PfW00gVPY7JkQe0KN73Qne',	NULL,	NULL,	2,	'2022-05-16 20:36:53',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:36:53'),
(12,	'Rafty',	'test@test.cz',	'$2y$10$d8mPc2t1Cr1XYYZjSoQ8Wet3MZu4SBEMo89y9DdTmGc3267LhAmf.',	NULL,	NULL,	2,	'2022-05-16 20:37:12',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:37:12'),
(13,	'Apatrik1',	'test@test.cz',	'$2y$10$dTplpowwj5YH7emgJ7UHNuFC216Ss1ZjuXa5AayVZJhDUJHqsmDyO',	NULL,	NULL,	2,	'2022-05-16 20:37:27',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:37:27'),
(14,	'Ondra13',	'test@test.cz',	'$2y$10$JRwTqXYC9iU6FrRKm50LIOLhoqm0PtSzmG/9m7HG33nT2iAo.e7OW',	NULL,	NULL,	2,	'2022-05-16 20:37:44',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:37:44'),
(15,	'Dragox',	'test@test.cz',	'$2y$10$bEoCK.HVCEXtRW8qGNsaNOkcjgFXNstx.UZnSC284aBIvxDK3b30m',	NULL,	NULL,	2,	'2022-05-16 20:38:00',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:38:00'),
(16,	'Paul',	'test@test.cz',	'$2y$10$Edh5JwnE6AJxA5eMPONo4.m4tlc76BhS3LRaOgeLdDUY6K3YuT2li',	NULL,	NULL,	2,	'2022-05-16 20:38:14',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:38:14'),
(17,	'Karel',	'test@test.cz',	'$2y$10$KDs6kk5ae4FGle/58j0SXOZJIw0GCUjV1Q2LN07QB4KPfaeCwJq9i',	NULL,	NULL,	2,	'2022-05-16 20:38:35',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:38:35'),
(18,	'Vsd26',	'test@test.cz',	'$2y$10$ErjCYaKeVkDpXH1D6wP84eRKKuXBOh3LZvQz3ilBWqelTxOYbN77m',	NULL,	NULL,	2,	'2022-05-16 20:39:16',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:39:16'),
(19,	'Peta',	'test@test.cz',	'$2y$10$5ACIEpQV8O0xofAJDbdS1e3JsdiOn.UOZJ1sBliYLBlkmuyCXtQf.',	NULL,	NULL,	2,	'2022-05-16 20:39:34',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:39:34'),
(20,	'Stuler',	'test@test.cz',	'$2y$10$oTFk1A0kHu/vUPqvNi2qEutrgYhGTU.QwLQEhdqg7brqVdItJWSa6',	NULL,	NULL,	2,	'2022-05-16 20:39:46',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:39:46'),
(21,	'Porky',	'test@test.cz',	'$2y$10$fusAFc2LtJ5uZ/CI7zEeM.oNvI2h47MmdBkVPiZ9Wv6lbj252LpAW',	NULL,	NULL,	2,	'2022-05-16 20:39:59',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:39:59'),
(22,	'Tomyy',	'test@test.cz',	'$2y$10$wrqgLGTrR.R9UHniiifggOQ4zRaEhPAM1q7v0/3yckErCRal3W4Gq',	NULL,	NULL,	2,	'2022-05-16 20:40:13',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:40:13'),
(23,	'Pipin',	'test@test.cz',	'$2y$10$4oLb/GFiY38fV2WRBTtAWONRazcJLzJttauydKnKj6r9lHfrQQgYq',	NULL,	NULL,	2,	'2022-05-16 20:40:32',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:40:32'),
(24,	'Echo',	'test@test.cz',	'$2y$10$mxY9k68p04VaOFmfGOpeiOnxA85xQ5WjJ.lhU6.PLY/qCoU26CvPm',	NULL,	NULL,	2,	'2022-05-16 20:40:47',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:40:47'),
(25,	'Vrsek005CZ',	'test@test.cz',	'$2y$10$c6NbO5Jj1eh7AF8Y.QPO9u6.S8J355c1nGqV0t/VNSKRtes14e/h6',	NULL,	NULL,	2,	'2022-05-16 20:41:09',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:41:09'),
(26,	'TheGatz',	'test@test.cz',	'$2y$10$2bsNwv/AiCV8MXbm16uIdOXQ3Pf0dyDIWt7/ZC9ngwEAHLXcxRdki',	NULL,	NULL,	2,	'2022-05-16 20:41:27',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:41:27'),
(27,	'Bejdy',	'test@test.cz',	'$2y$10$UImAvKw1VTTeMyr2sAEjuOeTJsJBMFB.eBL0vCDM45d2OstEa.pfS',	NULL,	NULL,	2,	'2022-05-16 20:41:41',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:41:41'),
(28,	'Hanz',	'test@test.cz',	'$2y$10$2/n2GbsnTBKgjA9/PyUkV.oJSSePMVhbF8UF.mMJV2kL3jG.rCt8a',	NULL,	NULL,	2,	'2022-05-16 20:41:54',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:41:54'),
(29,	'Hery',	'test@test.cz',	'$2y$10$PPErY2QMI4KRHWYoyeC6.Olt.KtJ6I099VRh5LRcwKsNwGnKPFnMa',	NULL,	NULL,	2,	'2022-05-16 20:42:06',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:42:06'),
(30,	'Bezzubka',	'test@test.cz',	'$2y$10$ga4CCMIZhgLv3wfnI/HRief61Zgrr.yPor361PzoL6l5FfQc4qC1i',	NULL,	NULL,	2,	'2022-05-16 20:42:23',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:42:23'),
(31,	'Blackus Featus',	'test@test.cz',	'$2y$10$.0yN8ZhCa3iTE8K6lz3wbei7pGh018bU4KPVOZKKHpZ/mQV6Aeyxa',	NULL,	NULL,	2,	'2022-05-16 20:42:39',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:42:39'),
(32,	'Štenclik',	'test@test.cz',	'$2y$10$M6TbC01D0Xwh9LXGKF4aGOretyixW8GzZLe3UBFUP3Qqo0eqzBJ7S',	NULL,	NULL,	2,	'2022-05-16 20:42:53',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:42:53'),
(33,	'Sebas',	'test@test.cz',	'$2y$10$juWDWo3f4D8MPXo.IJYE0u7XT6IqZRxkqTe5nX7FJnDLKJX7hpiua',	NULL,	NULL,	2,	'2022-05-16 20:43:09',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:43:09'),
(34,	'ProKxi',	'test@test.cz',	'$2y$10$A2Rspen5kvKM39BemFkKbufccKNDBruc6nqQ7EHkHJtnGNAJBn3ae',	NULL,	NULL,	2,	'2022-05-16 20:43:26',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:43:26'),
(35,	'D3HET',	'test@test.cz',	'$2y$10$.KkJAsJIhl4VZOhxAQ2Pyucoa/sFF7kQTVXgdI6keCqP5Z//YDNLe',	NULL,	NULL,	2,	'2022-05-16 20:43:39',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:43:39'),
(36,	'Fliger',	'test@test.cz',	'$2y$10$pu8q6dNtJZFJcPnZE1odBeaoayASZThHJIM8II3E6h89xZRZANYbe',	NULL,	NULL,	2,	'2022-05-16 20:43:54',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:43:54'),
(37,	'JakubČíslo',	'test@test.cz',	'$2y$10$f0UlLkcdrTrzZtA1eBk/9ur5xL9w2sYjLrlWn9diAjps58q56tAnq',	NULL,	NULL,	2,	'2022-05-16 20:44:21',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:44:21'),
(38,	'Voita',	'test@test.cz',	'$2y$10$rPTmRiSH5yTHj1ZQlhusBeUR44NfhYuqrw9C2MsBHe0bO72RiRI5i',	NULL,	NULL,	2,	'2022-05-16 20:44:33',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:44:33'),
(39,	'Krklam',	'test@test.cz',	'$2y$10$RfO4ky3KpEcE3Yl4GTNlDue6hK/LdzIiffFlscnIQXivyhWZK5EU6',	NULL,	NULL,	2,	'2022-05-16 20:44:49',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:44:49'),
(40,	'Frren',	'test@test.cz',	'$2y$10$PHHptmvcGRhfEnDb2qkFtuDzht9nrU37OGcbeQrAEsy9ulvMU/0oK',	NULL,	NULL,	2,	'2022-05-16 20:45:02',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:45:02'),
(41,	'Jobo',	'test@test.cz',	'$2y$10$RGnn9ipP06NEx0fsjEVFcOn2BNzJ8xDNYKRZo6gNsCrSNy.SisuVe',	NULL,	NULL,	2,	'2022-05-16 20:45:13',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:45:13'),
(42,	'Redly',	'test@test.cz',	'$2y$10$VNp6mYtghb8Ol/qSMkybEulVuPBb8tfCpahthgDmuy9SDSUl4Kqsy',	NULL,	NULL,	2,	'2022-05-16 20:45:28',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:45:28'),
(43,	'Kozlowskij',	'test@test.cz',	'$2y$10$cLQZi1ZQzKoXlE/7E.gBte7DgoUuYDZRM3YQ7IFT.16q/Yxrs35XC',	NULL,	NULL,	2,	'2022-05-16 20:45:57',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:45:57'),
(44,	'JustAKuba',	'test@test.cz',	'$2y$10$9gLej7lt9mEglIwr5kt7meawiHzLGyjFqQaZI.vnGW7OfGfQidIby',	NULL,	NULL,	2,	'2022-05-16 20:46:09',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:46:09'),
(45,	'Hammwe',	'test@test.cz',	'$2y$10$.3iKMNsGMWl9ekWotB4gau4xGVwMl60PVnA8IvWz9GE7IQzWhVlBu',	NULL,	NULL,	2,	'2022-05-16 20:46:22',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:46:22'),
(46,	'Poldas',	'test@test.cz',	'$2y$10$z1iTt5sJMQYCYf45D90bge6i3ltoQemR5RzG/tqhlckDzoJiO/r/S',	NULL,	NULL,	2,	'2022-05-16 20:46:32',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:46:32'),
(47,	'Skorky',	'test@test.cz',	'$2y$10$/8VthmzAi9n6i74QUunwiuDvg7Nuj4qm0PBt5eWYJgnFVua8hLXvu',	NULL,	NULL,	2,	'2022-05-16 20:46:46',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:46:46'),
(48,	'Psicho',	'test@test.cz',	'$2y$10$zCxpRqr6s3s6o3G6RXCDZee2vFz1ghPhA7GZQrYasnFzXiw/vqFX2',	NULL,	NULL,	2,	'2022-05-16 20:46:57',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:46:57'),
(49,	'PetrCZE',	'test@test.cz',	'$2y$10$vwC0/9pTLy5t7W5kFgalTOZjFlF9nUm8uPPPhSL63AzHnWhNX34dq',	NULL,	NULL,	2,	'2022-05-16 20:47:09',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:47:09'),
(50,	'OMEN',	'test@test.cz',	'$2y$10$hkR0Ftx1hYU1I71bV9sciOdfVIPdf8tPUduyAQOj7iapyRNDOQI5W',	NULL,	NULL,	2,	'2022-05-16 20:47:23',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:47:23'),
(51,	'buficek7_CZ',	'test@test.cz',	'$2y$10$.HFj5Saq9OSbH9Zm.Nlddupo.OI1OyGIN0mpuccfxH5cUzxEODzWi',	NULL,	NULL,	2,	'2022-05-16 20:47:39',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:47:39'),
(52,	'Dominikapa33',	'test@test.cz',	'$2y$10$5sCCoGw9YwxltcH9lcXliu48bu99fiSA7PasqVyhOf..60ZWt/pny',	NULL,	NULL,	2,	'2022-05-16 20:48:01',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:48:01'),
(53,	'Wolfen',	'test@test.cz',	'$2y$10$58CZeVOGEA/oZoxr9uSbWeaAIvm92rr5W2Jhpoqs0oXY3jC9z//xy',	NULL,	NULL,	2,	'2022-05-16 20:48:17',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:48:17'),
(54,	'TeolorD',	'test@test.cz',	'$2y$10$q83IdbHz/gHGcIWozJiG4.R90mQhfqmofXWyhYK1UfJLwY6IP.Jn.',	NULL,	NULL,	2,	'2022-05-16 20:48:29',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:48:29'),
(55,	'CiCiN',	'test@test.cz',	'$2y$10$hJkrrWQY11c51TRtd8fTO.HL8wNtdvAti9KTtxeUndTB2ygzCom/a',	NULL,	NULL,	2,	'2022-05-16 20:48:44',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:48:44'),
(56,	'Jurosic park',	'test@test.cz',	'$2y$10$D7OzwO84hi64REFPyCCeIeIGur1j711ARwpXG92AOwLT8o2yNnCWu',	NULL,	NULL,	2,	'2022-05-16 20:49:02',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:49:02'),
(57,	'Dyzii',	'test@test.cz',	'$2y$10$k7cSthVIboX/2.4QiHTrv.Xm4M4jmYo12eROvtyBOlIDTVZEswBCa',	NULL,	NULL,	2,	'2022-05-16 20:49:21',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:49:21'),
(58,	'V3N0M',	'test@test.cz',	'$2y$10$ienBvOlkWxflkaRva/xK4O4v8jiisXeS6MOukvkxln3erYshfn3oW',	NULL,	NULL,	2,	'2022-05-16 20:49:39',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:49:39'),
(59,	'Jacob',	'test@test.cz',	'$2y$10$vWjgPiR6SMQAPwhyCHp3eeWckDefI9dwKgcL0Zt06NCZYvCcQ0kB6',	NULL,	NULL,	2,	'2022-05-16 20:49:55',	NULL,	NULL,	NULL,	NULL,	5,	NULL,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 18:49:55'),
(60,	'Ondra0903',	'test@test.cz',	'$2y$10$ibz5Zbeztkouy2VB3iotVOtpJ9ZSEa.gU/UkCaYv/w93OWxOuXSJS',	NULL,	NULL,	2,	'2022-05-16 21:27:35',	'2022-05-16 19:27:53',	NULL,	NULL,	NULL,	8,	2,	1,	0,	0,	0,	0,	0,	0,	0,	1,	'2022-05-16 19:27:53');