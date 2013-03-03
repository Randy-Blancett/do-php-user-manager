
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- applications
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `applications`;

CREATE TABLE `applications`
(
	`id` VARCHAR(36) NOT NULL,
	`name` VARCHAR(50) NOT NULL,
	`comment` LONGBLOB,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
