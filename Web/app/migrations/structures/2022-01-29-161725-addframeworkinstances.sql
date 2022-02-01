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