
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- keybox
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `keybox`;

CREATE TABLE `keybox`
(
    `id` VARCHAR(36) NOT NULL,
    `action_id` VARCHAR(36) NOT NULL,
    `link_type` INTEGER(1) NOT NULL,
    `link_id` VARCHAR(50) NOT NULL,
    `comment` LONGBLOB,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
