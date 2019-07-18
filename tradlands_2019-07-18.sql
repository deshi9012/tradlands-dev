# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.25-0ubuntu0.18.04.2)
# Database: tradlands
# Generation Time: 2019-07-18 07:14:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table easypost_webhook_calls
# ------------------------------------------------------------

DROP TABLE IF EXISTS `easypost_webhook_calls`;

CREATE TABLE `easypost_webhook_calls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci,
  `exception` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table internal_errors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `internal_errors`;

CREATE TABLE `internal_errors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `error_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopify_order_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`)
VALUES
	(1,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563430512,1563430512),
	(2,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563430514,1563430514),
	(3,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563430582,1563430582),
	(4,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563430710,1563430710),
	(5,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563430762,1563430762),
	(6,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563431200,1563431200),
	(7,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563431271,1563431271),
	(8,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563431322,1563431322),
	(9,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563431376,1563431376),
	(10,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563431449,1563431449),
	(11,'default','{\"displayName\":\"App\\\\Jobs\\\\FailedOrders\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\FailedOrders\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\FailedOrders\\\":14:{s:10:\\\"\\u0000*\\u0000message\\\";a:3:{s:12:\\\"order_number\\\";i:234;s:10:\\\"error_code\\\";i:400;s:13:\\\"error_message\\\";s:69:\\\"Invalid parameters were passed and the record could not be persisted.\\\";}s:12:\\\"\\u0000*\\u0000addresses\\\";a:2:{s:10:\\\"to_address\\\";a:6:{s:4:\\\"name\\\";s:13:\\\"Steve Shipper\\\";s:7:\\\"street1\\\";s:19:\\\"123 Shipping Street\\\";s:4:\\\"city\\\";s:11:\\\"Shippington\\\";s:5:\\\"state\\\";s:2:\\\"KY\\\";s:3:\\\"zip\\\";s:5:\\\"40003\\\";s:5:\\\"phone\\\";s:12:\\\"555-555-SHIP\\\";}s:12:\\\"from_address\\\";a:7:{s:7:\\\"company\\\";s:8:\\\"EasyPost\\\";s:7:\\\"street1\\\";s:14:\\\"118 2nd Street\\\";s:7:\\\"street2\\\";s:9:\\\"4th Floor\\\";s:4:\\\"city\\\";s:13:\\\"San Francisco\\\";s:5:\\\"state\\\";s:2:\\\"CA\\\";s:3:\\\"zip\\\";s:5:\\\"94105\\\";s:5:\\\"phone\\\";s:12:\\\"415-456-7890\\\";}}s:9:\\\"\\u0000*\\u0000parcel\\\";N;s:8:\\\"\\u0000*\\u0000email\\\";s:25:\\\"ilia.bojadzhiev@gmail.com\\\";s:16:\\\"\\u0000*\\u0000easy_post_key\\\";s:58:\\\"EZTK71befb418b3740e4b2f2e26fb289f6cdCtPeuDlUEHTgLjZ7sv0jPQ\\\";s:15:\\\"\\u0000*\\u0000weight_in_oz\\\";d:0;s:15:\\\"\\u0000*\\u0000order_number\\\";i:234;s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1563431555,1563431555);

/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_06_10_113214_create_easypost_webhook_calls_table',1),
	(4,'2019_06_11_092911_create_table_orders',1),
	(5,'2019_06_17_094045_create_jobs_table',1),
	(6,'2019_06_17_120213_create_failed_jobs_table',1),
	(7,'2019_06_19_073346_create_errors_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shopify_id` bigint(20) NOT NULL,
  `shopify_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopify_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopify_total_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopify_order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopify_total_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopify_line_items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopify_shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopify_billing_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopify_order_weight` decimal(10,2) NOT NULL,
  `shipify_order_units` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'grams',
  `shopify_all_order` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_to_easypost` tinyint(1) NOT NULL,
  `easypost_to_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `easypost_from_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `predefined_package` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `easypost_parcel_weight` decimal(10,2) NOT NULL,
  `tracker_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) DEFAULT NULL,
  `easypost_flag` tinyint(1) DEFAULT NULL,
  `barcode` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` varchar(191) DEFAULT NULL,
  `variant_id` varchar(191) DEFAULT NULL,
  `easypost_id` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `barcode` (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `title`, `easypost_flag`, `barcode`, `created_at`, `updated_at`, `product_id`, `variant_id`, `easypost_id`)
VALUES
	(51,'00 - Grab Bag Template Default Title',1,'00 - Grab Bag Template','2019-07-17 19:02:29','2019-07-17 20:49:59','6928082206756','6928082206756',NULL),
	(52,'00 - XXS Grab Bag Template Default Title',1,'00 - XXS Grab Bag Template','2019-07-17 19:02:30','2019-07-17 20:50:00','6928122740772','6928122740772',NULL),
	(53,'01 - L Grab Bag Default Title',1,'01 - L Grab Bag','2019-07-17 19:02:31','2019-07-17 20:50:01','10348566773796','10348566773796',NULL),
	(54,'01 - M Grab Bag Default Title',1,'01 - M Grab Bag','2019-07-17 19:02:32','2019-07-17 20:50:02','10348588400676','10348588400676',NULL),
	(55,'01 - S Grab Bag Default Title',1,'01 - S Grab Bag','2019-07-17 19:02:32','2019-07-17 20:50:03','10348582600740','10348582600740',NULL),
	(56,'01 - XL Grab Bag Default Title',1,'01 - XL Grab Bag','2019-07-17 19:02:33','2019-07-17 20:50:04','10348564873252','10348564873252',NULL),
	(57,'01 - XS Grab Bag Default Title',1,'01 - XS Grab Bag','2019-07-17 19:02:34','2019-07-17 20:50:05','10348581126180','10348581126180',NULL),
	(58,'01 - XXS Grab Bag Default Title',1,'01 - XXS Grab Bag','2019-07-17 19:02:35','2019-07-17 20:50:06','10318914748452','10318914748452',NULL),
	(59,'101 Clare Chambray Linen XXS / 55% Cotton 45% Linen / Indigo',1,'21101-32XXS','2019-07-17 19:02:35','2019-07-17 20:50:06','7021578625','7021578625',NULL),
	(60,'101 Elms White Oxford XXS / 100% Cotton Oxford / White',1,'21101-31XXS','2019-07-17 19:02:36','2019-07-17 20:50:07','7021931393','7021931393',NULL),
	(61,'101 Everyday Linen Shirt Pink XXS / 70% Cotton 30% Linen / Light Pink',1,'21101-83XXS','2019-07-17 19:02:37','2019-07-17 20:50:08','7314576048164','7314576048164',NULL),
	(62,'101 Girlfriend Oxford Shirt Charcoal XXS / 100% Cotton / Grey',1,'21101-22XXS','2019-07-17 19:02:37','2019-07-17 20:50:09','7024272961','7024272961',NULL),
	(63,'101 Goodall Poplin Shirt Sienna XXS / 100% Cotton / Sienna',1,'21101-85XXS','2019-07-17 19:02:38','2019-07-17 20:50:10','9084966273060','9084966273060',NULL),
	(64,'101 Jessica Grey Long Sleeve XXS / 80% Cotton 20% Linen / Grey',1,'21101-28XXS','2019-07-17 19:02:39','2019-07-17 20:50:11','7023867457','7023867457',NULL),
	(65,'101 Marine Gingham Shirt XXS / 100% Cotton / Blue',1,'21101-82XXS','2019-07-17 19:02:40','2019-07-17 20:50:12','7314554880036','7314554880036',NULL),
	(66,'101 Martine Black Tencel XXS / 70% Tencel 30% Linen / Black',1,'21101-87XXS','2019-07-17 19:02:41','2019-07-17 20:50:13','9933141082148','9933141082148',NULL),
	(67,'101 Martine Cameo Tencel XXS / 70% Tencel 30% Linen / Cameo',1,'21101-88XXS','2019-07-17 19:02:41','2019-07-17 20:50:14','9933153435684','9933153435684',NULL),
	(68,'101 Mercer Shirt Sienna XXS / 70% Cotton 30% Linen / Sienna',1,'21101-81XXS','2019-07-17 19:02:42','2019-07-17 20:50:15','7314543706148','7314543706148',NULL),
	(69,'101 Tourist Catalina XXS / 100% Tencel / Blue',1,'21101-34XXS','2019-07-17 19:02:43','2019-07-17 20:50:15','25818565057','25818565057',NULL),
	(70,'101 Washed Denim Shirt XXS / 100% Cotton / Blue',1,'21101-79XXS','2019-07-17 19:02:44','2019-07-17 20:50:16','7303628390436','7303628390436',NULL),
	(71,'102 Box T-Shirt Fatigue XXS / Fatigue / 100% Cotton',1,'21119-10XXS','2019-07-17 19:02:44','2019-07-17 20:50:17','9933050216484','9933050216484',NULL),
	(72,'102 Box T-Shirt Stripe XXS / 95% Cotton 5% Spandex / White / Black',1,'21130-01XXS','2019-07-17 19:02:45','2019-07-17 20:50:18','9933065289764','9933065289764',NULL),
	(73,'102 Box T-Shirt Sunbleached XXS / 100% Cotton / White',1,'21119-09XXS','2019-07-17 19:02:46','2019-07-17 20:50:19','9933029277732','9933029277732',NULL),
	(74,'102 Les Femmes Fatigue XXS / Fatigue / 100% Cotton',1,'21119-12XXS','2019-07-17 19:02:46','2019-07-17 20:50:20','11201858469924','11201858469924',NULL),
	(75,'102 Les Femmes Sunbleached XXS / 100% Cotton / White',1,'21119-11XXS','2019-07-17 19:02:47','2019-07-17 20:50:21','11201837629476','11201837629476',NULL),
	(76,'103 Girlfriend T-Shirt Cavern XXS / 100% Cotton / Cavern',1,'21103-01XXS','2019-07-17 19:02:48','2019-07-17 20:50:22','22454292737','22454292737',NULL),
	(77,'103 Girlfriend T-Shirt Garnet XXS / 100% Cotton / Red',1,'21103-12XXS','2019-07-17 19:02:49','2019-07-17 20:50:23','9410577039396','9410577039396',NULL),
	(78,'103 Girlfriend T-Shirt Heather Grey XXS / 100% Cotton / Heather Grey',1,'21103-08XXS','2019-07-17 19:02:49','2019-07-17 20:50:24','7321427574820','7321427574820',NULL),
	(79,'103 Girlfriend T-Shirt Navy XXS / Navy / 100% Cotton',1,'21103-10XXS','2019-07-17 19:02:50','2019-07-17 20:50:24','22481935297','22481935297',NULL),
	(80,'103 Girlfriend T-Shirt Olive XXS / 100% Cotton / Olive',1,'21103-16XXS','2019-07-17 19:02:51','2019-07-17 20:50:25','9933084819492','9933084819492',NULL),
	(81,'103 Girlfriend T-Shirt Pine XXS / 100% Cotton / Green',1,'21103-13XXS','2019-07-17 19:02:52','2019-07-17 20:50:26','9391869919268','9391869919268',NULL),
	(82,'103 Girlfriend T-Shirt Rust XXS / 100% Cotton / Rust',1,'21103-11XXS','2019-07-17 19:02:52','2019-07-17 20:50:27','9410592309284','9410592309284',NULL),
	(83,'103 Girlfriend T-Shirt Shell XXS / 100% Cotton / Cream',1,'21103-15XXS','2019-07-17 19:02:53','2019-07-17 20:50:28','9933072531492','9933072531492',NULL),
	(84,'103 Girlfriend T-Shirt Sienna XXS / 100% Cotton / Burnt Sienna',1,'21103-09XXS','2019-07-17 19:02:54','2019-07-17 20:50:29','7321457721380','7321457721380',NULL),
	(85,'103 Girlfriend T-Shirt Sunbleached XXS / 100% Cotton / White',1,'21103-07XXS','2019-07-17 19:02:54','2019-07-17 20:50:30','37743419981','37743419981',NULL),
	(86,'103 Girlfriend T-Shirt Terracotta XXS / 100% Cotton / Terracotta',1,'21103-14XXS','2019-07-17 19:02:55','2019-07-17 20:50:31','9933070499876','9933070499876',NULL),
	(87,'105 Classic Striped Shirt Navy XXS / 70% Cotton 30% Linen / Blue',1,'21105-24XXS','2019-07-17 19:02:56','2019-07-17 20:50:32','7314663079972','7314663079972',NULL),
	(88,'105 Costa Stripe Short Sleeve XXS / 90% Cotton 10% Tencel / Black / Off White',1,'21105-25XXS','2019-07-17 19:02:57','2019-07-17 20:50:33','9933165559844','9933165559844',NULL),
	(89,'105 Seville Black Short Sleeve XXS / Black / 70% Tencel 30% Linen',1,'21105-27XXS','2019-07-17 19:02:57','2019-07-17 20:50:33','9933178568740','9933178568740',NULL),
	(90,'105 Seville Gold Short Sleeve XXS / 70% Tencel 30% Linen / Golden Yellow',1,'21105-26XXS','2019-07-17 19:02:58','2019-07-17 20:50:34','9933173555236','9933173555236',NULL),
	(91,'105 The Lily XXS / 100% Cotton / White',1,'21105-09XXS','2019-07-17 19:02:59','2019-07-17 20:50:35','20437930881','20437930881',NULL),
	(92,'105 Ventura Madras Shirt XXS / 100% Cotton / Pink',1,'21105-22XXS','2019-07-17 19:02:59','2019-07-17 20:50:36','7314617958436','7314617958436',NULL),
	(93,'105 Vintage Denim Shirt XXS / 100% Cotton / Blue',1,'21105-23XXS','2019-07-17 19:03:00','2019-07-17 20:50:37','7314642698276','7314642698276',NULL),
	(94,'111 Arapahoe Red Flannel XXS / 100% Cotton / Red',1,'21111-01XXS','2019-07-17 19:03:01','2019-07-17 20:50:38','5878369985','5878369985',NULL),
	(95,'111 North Coast Dusk Flannel XXS / 100% Cotton / Blue',1,'21111-28XXS','2019-07-17 19:03:02','2019-07-17 20:50:39','9085017915428','9085017915428',NULL),
	(96,'111 North Coast Solstice Flannel XXS / 100% Cotton / Orange',1,'21111-27XXS','2019-07-17 19:03:02','2019-07-17 20:50:39','9085005692964','9085005692964',NULL),
	(97,'111 Reyes Grey Flannel XXS / 100% Cotton / Light Grey',1,'21111-25XXS','2019-07-17 19:03:03','2019-07-17 20:50:40','9084985671716','9084985671716',NULL),
	(98,'111 The Finch Flannel XXS / 70% Cotton 30% Tencel / Mustard',1,'21111-02XXS','2019-07-17 19:03:04','2019-07-17 20:50:41','5877229377','5877229377',NULL),
	(99,'116 Les Femmes Varsity Shell XXS / 100% Cotton / Cream',1,'21116-09XXS','2019-07-17 19:03:05','2019-07-17 20:50:42','11201884717092','11201884717092',NULL),
	(100,'116 Varsity Sweatshirt Azure XXS / 100% Cotton / Blue',1,'21116-07XXS','2019-07-17 19:03:05','2019-07-17 20:50:43','9933122600996','9933122600996',NULL);

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
