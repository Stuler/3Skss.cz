CREATE TABLE `user_role` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(9) NOT NULL,
  `login_role_id` int(11) NOT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`login_role_id`) REFERENCES `login_role` (`id`)
) COLLATE 'utf8mb4_czech_ci';