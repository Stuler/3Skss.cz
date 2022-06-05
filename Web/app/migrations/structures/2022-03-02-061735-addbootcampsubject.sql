CREATE TABLE `bootcamp_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bootcamp_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bootcamp_id` (`bootcamp_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `bootcamp_subject_ibfk_1` FOREIGN KEY (`bootcamp_id`) REFERENCES `bootcamp_class` (`id`),
  CONSTRAINT `bootcamp_subject_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;