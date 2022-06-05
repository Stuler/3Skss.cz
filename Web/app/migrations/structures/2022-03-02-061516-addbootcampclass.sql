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