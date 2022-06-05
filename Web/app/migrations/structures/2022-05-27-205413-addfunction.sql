CREATE TABLE `function` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(64) COLLATE 'utf8mb4_czech_ci' NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_deleted` datetime NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) NULL
);