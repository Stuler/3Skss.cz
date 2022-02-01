SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

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
  `email` varchar(100) COLLATE utf8mb4_czech_ci NULL,
  `password` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  `discord_id` varchar(64) DEFAULT NULL,
  `steam_id` varchar(64) DEFAULT NULL,
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
  `tactical_points` int(9) DEFAULT 0,
  `penalty` int(9) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
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


DROP TABLE IF EXISTS `framework_instances`;
CREATE TABLE `framework_instances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text COLLATE utf8mb4_czech_ci NOT NULL,
  `name` text COLLATE utf8mb4_czech_ci NOT NULL,
  `drive_capacity_bytes` int(12) DEFAULT NULL,
  `drive_free_space_bytes` int(12) DEFAULT NULL,
  `drive_addons_size_bytes` int(12) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_seen` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;


DROP TABLE IF EXISTS `addons`;
CREATE TABLE `addons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `framework_instance_id` int(11) NOT NULL,
  `addon_id` int(11) DEFAULT NULL,
  `addon_name` text COLLATE utf8mb4_czech_ci NOT NULL,
  `addon_size_bytes` int(12) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `desired_status` int(2) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `framework_instance_id` (`framework_instance_id`),
  CONSTRAINT `addon_ibfk_1` FOREIGN KEY (`framework_instance_id`) REFERENCES `framework_instances` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `login_role` (`id`, `name`) VALUES
(1,	'admin'),
(2,	'member'),
(3,	'guest');

INSERT INTO `center` (`id`, `name`, `is_active`, `note`, `description`, `abbreviation`, `date_created`, `created_by`, `date_deleted`, `deleted_by`, `date_modified`, `modified_by`) VALUES
(1,	'Velitelské středisko',	1,	'tu jsou velitelé',	'velitelé',	'VS',	'2022-01-07 21:19:16',	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'1. Středisko speciálního výcviku',	1,	'tu prebieha mučenie',	'Výcvik',	'1SSV',	'2022-01-09 20:17:50',	1,	NULL,	NULL,	'2022-01-09 19:31:42',	NULL),
(3,	'Bojové středisko',	1,	'tu sa vraždí',	'bojovníci',	'BS',	'2022-01-07 21:19:55',	1,	NULL,	NULL,	'2022-01-09 19:31:53',	NULL);

INSERT INTO `detachment` (`id`, `name`, `center_id`, `parent_detachment_id`, `note`, `description`, `abbreviation`, `is_active`, `date_created`, `date_deleted`, `date_modified`, `created_by`, `deleted_by`) VALUES
(1,	'Gambit',	3,	NULL,	'',	'Bojovníci gambitu',	'G',	1,	'2022-01-07 21:23:42',	NULL,	'2022-01-09 19:32:06',	0,	0),
(2,	'Spartan',	3,	NULL,	'',	'Mdrky ze Spartanu',	'S',	1,	'2022-01-09 20:19:24',	NULL,	'2022-01-20 05:26:44',	1,	0),
(6,	'Letecký odřad speciálních operací',	3,	NULL,	'tu sa ničí technika (vlastná)',	'Letectví a obsluha',	'SOATU/LOSO',	1,	'2022-01-23 14:40:57',	NULL,	'2022-01-23 13:41:48',	1,	0),
(9,	'TACP',	3,	NULL,	'',	'',	'',	1,	'2022-01-23 20:09:28',	'2022-01-23 20:09:33',	'2022-01-23 19:09:33',	1,	1);

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
(5,	'Gambit 1',	2,	NULL,	1,	3,	'',	'',	'G1',	1,	'2022-01-28 20:31:30',	NULL,	'2022-01-28 19:31:39',	0,	0),
(6,	'Spartan 1',	2,	NULL,	2,	3,	'',	'',	'S1',	1,	'2022-01-28 20:32:02',	NULL,	'2022-01-28 19:32:11',	0,	0);

INSERT INTO `course_level` (`id`, `name`, `abbreviation`, `description`, `note`, `required_course_level`, `date_created`, `date_modified`, `date_deleted`) VALUES
(1,	'Základní povinné kurzy',	NULL,	NULL,	NULL,	1,	'2021-12-03 07:21:58',	'2021-12-03 06:22:34',	NULL),
(2,	'Pokročilé kurzy',	NULL,	NULL,	NULL,	1,	'2021-12-03 07:22:53',	NULL,	NULL),
(3,	'Specializované kurzy',	NULL,	NULL,	NULL,	2,	'2021-12-03 07:23:23',	NULL,	NULL),
(4,	'Nezařazeno',	'',	'',	'',	NULL,	'2021-12-03 07:59:03',	NULL,	NULL);

INSERT INTO `course_completition_type` (`id`, `name`) VALUES
(1,	'Splněn'),
(2,	'Nesplněn'),
(3,	'Probíhá'),
(4,	'Instruktor');

INSERT INTO `course` (`id`, `name`, `course_level_id`, `abbreviation`, `description`, `note`, `date_created`, `date_modified`, `date_deleted`) VALUES
(16,	'Komplexní základní výcvik',	1,	'KZP',	'',	'',	'2022-01-29 15:40:55',	NULL,	NULL);

INSERT INTO `instructor` (`id`, `user_id`, `course_id`, `note`, `date_created`, `created_by`, `date_modified`, `date_deleted`, `deleted_by`) VALUES
(27,	2,	16,	NULL,	'2022-01-29 15:40:55',	2,	NULL,	NULL,	NULL);

INSERT INTO `course_completed` (`id`, `user_id`, `instructor_id`, `course_id`, `course_completition_type_id`, `completition_date`, `last_exam_date`, `next_exam_date`, `date_modified`, `date_deleted`, `deleted_by`, `note`) VALUES
(155,	50,	27,	16,	3,	'2022-01-29 15:41:14',	'2022-01-29 15:41:14',	NULL,	'2022-01-29 14:42:51',	NULL,	NULL,	''),
(157,	49,	27,	16,	1,	'2022-01-29 00:00:00',	'2022-01-29 15:46:29',	NULL,	'2022-01-29 14:47:01',	NULL,	NULL,	''),
(160,	51,	27,	16,	1,	'2022-01-29 00:00:00',	'2022-01-29 15:54:20',	NULL,	NULL,	NULL,	NULL,	'');


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

INSERT INTO `user` (`id`, `nick`, `email`, `password`, `discord_id`, `steam_id`, `login_role_id`, `date_created`, `date_modified`, `date_deleted`, `deleted_by`, `note`, `squad_id`, `squad_pos`, `rank_id`, `is_admin`, `is_super_admin`, `is_commander`, `is_instructor`, `is_squadleader`, `tactical_points`, `penalty`, `is_active`) VALUES
(2,	'admin',	'peter.jurek@gmail.com',	'$2y$10$tH9goK/PKe4oeXMMsSNxXOJ/gY3oP1A0cmHVAEW8jwL4w.90D..l.',	0,	0,	1,	'2021-10-15 07:09:10',	'2022-01-29 14:31:39',	NULL,	NULL,	'',	1,	1,	8,	1,	1,	0,	0,	0,	8,	NULL,	1),
(49,	'Stuler',	'test@test.cz',	'$2y$10$/0UI8SnFcCxl4RES8DK2fuc93s6fUg7avQ6FNQdv2.BjaGSTIK75G',	0,	0,	2,	'2022-01-29 15:32:37',	'2022-01-29 14:36:06',	NULL,	NULL,	'',	5,	0,	1,	0,	0,	0,	0,	0,	0,	0,	1),
(50,	'Rafty',	'',	'',	675647,	877598,	2,	'2022-01-29 15:39:52',	NULL,	NULL,	NULL,	'',	NULL,	0,	1,	0,	0,	0,	0,	0,	NULL,	NULL,	1),
(51,	'Karel',	'',	'',	0,	0,	2,	'2022-01-29 15:48:20',	NULL,	NULL,	NULL,	'',	NULL,	0,	1,	0,	0,	0,	0,	0,	NULL,	NULL,	1);

INSERT INTO `event_type` (`id`, `name`, `note`, `date_created`, `date_modified`, `date_deleted`, `created_by`, `deleted_by`) VALUES
(1,	'Kampaň',	'Mise kampaně.\r\nDocházka je povinná, pokud není řečeno jinak.\r\nMusí mít speciální tabulku.\r\nMusí být schválena vedením.\r\nMůžou běžet pouze 2 kampaně najednou.',	'2021-12-18 15:29:44',	NULL,	NULL,	NULL,	NULL),
(2,	'Mise',	'Oficiální mise vytvořena MM.\r\nMusí mít tabulku.\r\nMise je vytvořena v editoru a musí se hlásit dopředu.\r\nMusí být schválena vedením.',	'2021-12-18 15:30:05',	NULL,	NULL,	NULL,	NULL),
(3,	'Zeus mise',	'Mise kampaně.\r\nDocházka je povinná, pokud není řečeno jinak.\r\nMusí mít speciální tabulku.\r\nMusí být schválena vedením.\r\nMůžou běžet pouze 2 kampaně najednou.',	'2021-12-18 15:30:26',	NULL,	NULL,	NULL,	NULL),
(4,	'JointOp',	'žluté ohraničení - čas kdy probíhá zahraniční operace zapsaná v listu NATO ',	'2021-12-18 15:30:56',	NULL,	NULL,	NULL,	NULL),
(5,	'Trénink',	'',	'2021-12-18 15:31:08',	NULL,	NULL,	NULL,	NULL),
(6,	'Výcvik',	'',	'2021-12-18 15:31:17',	NULL,	NULL,	NULL,	NULL),
(7,	'Porada',	'',	'2021-12-18 15:31:21',	NULL,	NULL,	NULL,	NULL),
(8,	'Volná hra',	'- Event, který může založit jakýkoliv člen četař+\r\n- Může být max 3 hodiny týdně\r\n- Může se jednat o libovolnou skupinovou aktivitu v libovolné hře\r\n- např. Liberation, konvoj v ETS2, GTA 5, Minecraft, atd...',	'2021-12-18 15:31:42',	NULL,	NULL,	NULL,	NULL);


INSERT INTO `framework_instances` (`id`, `token`, `name`, `drive_capacity_bytes`, `drive_free_space_bytes`, `drive_addons_size_bytes`, `date_created`, `date_last_seen`) VALUES
(1,	'abc123',	'Dummy 1',	2147483647,	1,	1,	'2021-12-21 20:54:40',	'2021-12-29 18:19:56'),
(2,	'321abc',	'Dummy 2',	1,	1,	1,	'2021-12-21 20:54:40',	NULL),
(3,	'123abc',	'Dummy 3',	1,	1,	1,	'2021-12-21 20:54:40',	NULL),
(4,	'abc321',	'Dummy 4',	1,	1,	1,	'2021-12-21 20:54:40',	NULL);
