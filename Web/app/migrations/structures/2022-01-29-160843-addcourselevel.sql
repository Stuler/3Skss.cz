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
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;