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