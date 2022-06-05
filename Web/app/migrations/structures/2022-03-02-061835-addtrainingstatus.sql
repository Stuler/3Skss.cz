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