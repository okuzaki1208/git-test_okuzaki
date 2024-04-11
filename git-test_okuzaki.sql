CREATE DATABASE IF NOT EXISTS `git-test`;

USE `git-test`;

CREATE TABLE IF NOT EXISTS `comments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(10),
    `email` VARCHAR(100),
    `message` TEXT,
    `date_time` DATETIME,
    UNIQUE (`id`)
);