# Dump of table employee
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
                            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                            `company_name` varchar(256) DEFAULT NULL,
                            `employee` varchar(256) DEFAULT NULL,
                            `email_address` varchar(256) NOT NULL DEFAULT '',
                            `salary` int(11) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
