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