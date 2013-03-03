
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
	`id` VARCHAR(36) NOT NULL,
	`user_name` VARCHAR(25) NOT NULL,
	`password` VARCHAR(40),
	`first_name` VARCHAR(20),
	`middle_name` VARCHAR(20),
	`last_name` VARCHAR(50),
	`personal_title` VARCHAR(10),
	`professional_title` VARCHAR(10),
	`phone_num_1` VARCHAR(30),
	`phone_num_2` VARCHAR(30),
	`email1` VARCHAR(30),
	`email2` VARCHAR(30),
	`assigned_org` VARCHAR(30),
	`org` VARCHAR(30),
	`company` VARCHAR(30),
	`affiliation` VARCHAR(30),
	`type` VARCHAR(10),
	`location` VARCHAR(100),
	`suite` VARCHAR(20),
	`last_login` DATETIME,
	`last_updated` DATETIME,
	`account_creation` DATETIME,
	`comment` LONGBLOB,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
