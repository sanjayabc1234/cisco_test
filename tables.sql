
CREATE DATABASE IF NOT EXISTS cisco_test;

USE cisco_test;

-- create table
CREATE TABLE IF NOT EXISTS `cisco_test`.`router_properties` (
    `router_id` INT(10) NOT NULL AUTO_INCREMENT,
    `sap_id` VARCHAR(30) NOT NULL,
    `hostname` VARCHAR(225) NOT NULL,
    `loopback` VARCHAR(12) NOT NULL,
    `mac_address` VARCHAR(17) NOT NULL,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `status` ENUM('inactive', 'active') NOT NULL DEFAULT 'active',
    PRIMARY KEY (`router_id`),
    UNIQUE (hostname,loopback)
)  ENGINE=INNODB; 

CREATE TABLE IF NOT EXISTS `cisco_test`.`api_tokens` (
    `id` INT(10) NOT NULL AUTO_INCREMENT,
    `token` VARCHAR(255) NOT NULL,
    `customer_id` INT(5) NOT NULL,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)  ENGINE=INNODB; 

