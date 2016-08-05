DROP SCHEMA IF EXISTS `finance` ;
CREATE SCHEMA IF NOT EXISTS `finance` DEFAULT CHARACTER SET utf8 ;
USE `finance` ;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `currency_iso` CHAR(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `balance` DECIMAL(16,4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.0000',
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`, `currency_iso`, `name`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_account` int(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` int COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(16,4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_transaction` (`id_account`, `id_category`, `date`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `report` (
  `date` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_account` int(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` int COLLATE utf8mb4_unicode_ci NOT NULL,
  `sum` decimal(16,4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avg_amount` decimal(16,4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_amount` decimal(16,4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_amount` decimal(16,4) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `id_report` (`date`, `id_user`, `id_account`, `id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `log` (
  `id_account` int(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` int COLLATE utf8mb4_unicode_ci NOT NULL,
  `sum` decimal(16,4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_amount` decimal(16,4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_amount` decimal(16,4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT NOW(),
  UNIQUE KEY `id_log` (`id_account`, `id_category`, `date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
