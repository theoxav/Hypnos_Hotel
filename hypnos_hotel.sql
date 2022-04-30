
DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`email` varchar(180) NOT NULL UNIQUE,
	`roles` longtext NOT NULL COMMENT '(DC2Type:json)',
	`password` varchar(255) NOT NULL,
	`first_name` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL,
	`created_at` datetime NOT NULL DEFAULT current_timestamp(),
	`updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;




DROP TABLE IF EXISTS `service_hotel`;

CREATE TABLE `service_hotel` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`title` varchar(255) NOT NULL,
	`description` longtext NOT NULL,
	`illustration` varchar(255) NOT NULL,BIGINT`created_at` datetime NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `establishement`;

CREATE TABLE `establishement` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`user_id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	`address` varchar(255) NOT NULL,
	`postal_code` varchar(255) NOT NULL,
	`city` varchar(255) NOT NULL,
	`description` longtext NOT NULL,
	`illustration` varchar(255) DEFAULT NULL,
	`slug` varchar(255) NOT NULL,
	`subtitle` varchar(255) NOT NULL,
	`banner` varchar(255) DEFAULT NULL,
	`is_best` tinyint(1) NOT NULL,
	`created_at` datetime NOT NULL DEFAULT current_timestamp(),
	`updated_at` datetime NOT NULL DEFAULT current_timestamp(),
	FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
DROP TABLE IF EXISTS `suite`;



CREATE TABLE `suite` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`establishement_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	`description` longtext NOT NULL,
	`price` double NOT NULL,
	`illustration` varchar(255) DEFAULT NULL,
	`created_at` datetime NOT NULL DEFAULT current_timestamp(),
	`updated_at` datetime NOT NULL DEFAULT current_timestamp(),
	INDEX IDX_establishement (`establishement_id`),
	INDEX IDX_user (`user_id`),
	FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
	FOREIGN KEY (`establishement_id`) REFERENCES `establishement` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;




DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`establishement_id` int(11) DEFAULT NULL,
	`user_id` int(11) DEFAULT NULL,
	`suite_id` int(11) DEFAULT NULL,
	`start` datetime NOT NULL,
	`end` datetime NOT NULL,
	INDEX IDX_establishement (`establishement_id`),
	INDEX IDX_user (`user_id`),
	INDEX IDX_suite (`suite_id`),
	FOREIGN KEY (`establishement_id`) REFERENCES `establishement` (`id`),
	FOREIGN KEY (`suite_id`) REFERENCES `suite` (`id`),
	FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;


