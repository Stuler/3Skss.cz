INSERT INTO `squad` (`id`, `name`, `squad_type_id`, `parent_squad_id`, `detachment_id`, `center_id`, `note`, `description`, `abbreviation`, `is_active`, `date_created`, `date_deleted`, `date_modified`, `created_by`, `deleted_by`) VALUES
(1,	'Velitelská kancelář',	1,	NULL,	NULL,	1,	NULL,	NULL,	NULL,	1,	'2022-01-28 20:27:20',	NULL,	NULL,	0,	0),
(2,	'Personální oddělení',	1,	NULL,	NULL,	1,	NULL,	NULL,	NULL,	1,	'2022-01-28 20:28:51',	NULL,	NULL,	0,	0),
(3,	'Velitelství speciálního výcviku',	1,	NULL,	NULL,	2,	NULL,	NULL,	NULL,	1,	'2022-01-28 20:29:25',	NULL,	'2022-01-28 19:31:01',	0,	0),
(4,	'Kancelář instruktorů',	1,	NULL,	NULL,	2,	NULL,	NULL,	NULL,	1,	'2022-01-28 20:30:22',	NULL,	'2022-01-28 19:31:05',	0,	0),
(5,	'Výcvikové středisko',	1,	NULL,	NULL,	2,	'',	'Pro členy v základním výcviku',	'VS',	1,	'2022-05-14 20:26:57',	NULL,	NULL,	2,	NULL),
(6,	'Gambit 1',	2,	NULL,	1,	3,	'',	'',	'G1',	1,	'2022-05-15 13:35:14',	NULL,	NULL,	2,	NULL),
(7,	'Gambit 2',	2,	NULL,	1,	3,	'',	'',	'G2',	1,	'2022-05-15 13:35:27',	NULL,	NULL,	2,	NULL),
(8,	'Gambit 3',	2,	NULL,	1,	3,	'',	'',	'G3',	1,	'2022-05-15 13:36:21',	NULL,	NULL,	2,	NULL),
(9,	'Spartan 1',	2,	NULL,	2,	3,	'',	'',	'S1',	1,	'2022-05-15 13:36:48',	NULL,	NULL,	2,	NULL),
(10,	'Spartan 2',	2,	NULL,	2,	3,	'',	'',	'S2',	1,	'2022-05-15 13:37:03',	NULL,	NULL,	2,	NULL),
(11,	'Spartan 3',	2,	NULL,	2,	3,	'',	'',	'S3',	1,	'2022-05-15 13:37:19',	NULL,	NULL,	2,	NULL),
(12,	'SOATU/LOSO',	3,	NULL,	NULL,	4,	NULL,	NULL,	NULL,	1,	'2022-05-15 13:52:55',	NULL,	NULL,	0,	NULL);