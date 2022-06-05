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