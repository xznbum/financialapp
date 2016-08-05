DROP SCHEMA IF EXISTS `finance` ;
CREATE SCHEMA IF NOT EXISTS `finance` DEFAULT CHARACTER SET utf8 ;
USE `finance` ;

CREATE TABLE IF NOT EXISTS `finance`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `pass` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `finance`.`account` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user` INT(11) NOT NULL,
  `currency_iso` CHAR(3) NOT NULL DEFAULT 'USD',
  `balance` DECIMAL(16,4) NOT NULL DEFAULT '0.0000',
  `name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_user` (`id_user` ASC, `currency_iso` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `finance`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `finance`.`transaction` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_account` INT(11) NOT NULL,
  `id_category` INT NOT NULL,
  `amount` DECIMAL(16,4) NOT NULL DEFAULT '0.0000',
  `currency_iso` CHAR(3) NOT NULL,
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_transaction_account1_idx` (`id_account` ASC),
  INDEX `fk_transaction_category1_idx` (`id_category` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `finance`.`report` (
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` INT(11) NOT NULL,
  `id_account` INT(11) NOT NULL,
  `id_category` INT NOT NULL,
  `sum` DECIMAL(16,4) NOT NULL DEFAULT '0.0000',
  `avg_amount` DECIMAL(16,4) NOT NULL DEFAULT '0.0000',
  `start_amount` DECIMAL(16,4) NOT NULL DEFAULT '0.0000',
  `end_amount` DECIMAL(16,4) NOT NULL DEFAULT '0.0000',
  UNIQUE KEY `id_report` (`date`, `id_user`, `id_account`, `id_category`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;