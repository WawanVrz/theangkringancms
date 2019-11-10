# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.38)
# Database: theangkringancms
# Generation Time: 2019-11-10 11:32:02 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table content_flat_category_post
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_flat_category_post`;

CREATE TABLE `content_flat_category_post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `website_id` int(11) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `content_type` text COLLATE utf8_unicode_ci NOT NULL,
  `author` bigint(20) NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `template` text COLLATE utf8_unicode_ci,
  `publish_time` longtext COLLATE utf8_unicode_ci,
  `status` longtext COLLATE utf8_unicode_ci,
  `order` longtext COLLATE utf8_unicode_ci,
  `title` longtext COLLATE utf8_unicode_ci,
  `category_slug` longtext COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `featured_image` longtext COLLATE utf8_unicode_ci,
  `featured_image_title` longtext COLLATE utf8_unicode_ci,
  `featured_image_alt_text` longtext COLLATE utf8_unicode_ci,
  `meta_title` longtext COLLATE utf8_unicode_ci,
  `slug` longtext COLLATE utf8_unicode_ci,
  `meta_description` longtext COLLATE utf8_unicode_ci,
  `meta_keywords` longtext COLLATE utf8_unicode_ci,
  `canonical_url` longtext COLLATE utf8_unicode_ci,
  `meta_robots_index` longtext COLLATE utf8_unicode_ci,
  `meta_robots_follow` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table content_flat_example
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_flat_example`;

CREATE TABLE `content_flat_example` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `website_id` int(11) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `content_type` text COLLATE utf8_unicode_ci NOT NULL,
  `author` bigint(20) NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `template` text COLLATE utf8_unicode_ci,
  `status` longtext COLLATE utf8_unicode_ci,
  `publish_time` longtext COLLATE utf8_unicode_ci,
  `order` longtext COLLATE utf8_unicode_ci,
  `text_1` longtext COLLATE utf8_unicode_ci,
  `text_2` longtext COLLATE utf8_unicode_ci,
  `text_3` longtext COLLATE utf8_unicode_ci,
  `text_4` longtext COLLATE utf8_unicode_ci,
  `digit` longtext COLLATE utf8_unicode_ci,
  `number` longtext COLLATE utf8_unicode_ci,
  `username` longtext COLLATE utf8_unicode_ci,
  `password` longtext COLLATE utf8_unicode_ci,
  `password_strong` longtext COLLATE utf8_unicode_ci,
  `email` longtext COLLATE utf8_unicode_ci,
  `url` longtext COLLATE utf8_unicode_ci,
  `slug` longtext COLLATE utf8_unicode_ci,
  `tag` longtext COLLATE utf8_unicode_ci,
  `maxlength` longtext COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `dob` longtext COLLATE utf8_unicode_ci,
  `title` longtext COLLATE utf8_unicode_ci,
  `address_1` longtext COLLATE utf8_unicode_ci,
  `address_2` longtext COLLATE utf8_unicode_ci,
  `first_name` longtext COLLATE utf8_unicode_ci,
  `middle_name` longtext COLLATE utf8_unicode_ci,
  `last_name` longtext COLLATE utf8_unicode_ci,
  `phone` longtext COLLATE utf8_unicode_ci,
  `cc` longtext COLLATE utf8_unicode_ci,
  `gender` longtext COLLATE utf8_unicode_ci,
  `gender2` longtext COLLATE utf8_unicode_ci,
  `hobby1` longtext COLLATE utf8_unicode_ci,
  `hobby2` longtext COLLATE utf8_unicode_ci,
  `facility` longtext COLLATE utf8_unicode_ci,
  `facilities` longtext COLLATE utf8_unicode_ci,
  `like_pizza` longtext COLLATE utf8_unicode_ci,
  `select_basic` longtext COLLATE utf8_unicode_ci,
  `select_icon` longtext COLLATE utf8_unicode_ci,
  `select_basic_2` longtext COLLATE utf8_unicode_ci,
  `select_opt_2_icon` longtext COLLATE utf8_unicode_ci,
  `select_auto_width` longtext COLLATE utf8_unicode_ci,
  `featured_image` longtext COLLATE utf8_unicode_ci,
  `featured_image_title` longtext COLLATE utf8_unicode_ci,
  `featured_image_alt_text` longtext COLLATE utf8_unicode_ci,
  `images_gallery` longtext COLLATE utf8_unicode_ci,
  `featured_video_used` longtext COLLATE utf8_unicode_ci,
  `featured_video_external` longtext COLLATE utf8_unicode_ci,
  `featured_video_internal` longtext COLLATE utf8_unicode_ci,
  `meta_title` longtext COLLATE utf8_unicode_ci,
  `meta_description` longtext COLLATE utf8_unicode_ci,
  `meta_keywords` longtext COLLATE utf8_unicode_ci,
  `canonical_url` longtext COLLATE utf8_unicode_ci,
  `meta_robots_index` longtext COLLATE utf8_unicode_ci,
  `meta_robots_follow` longtext COLLATE utf8_unicode_ci,
  `file_1` longtext COLLATE utf8_unicode_ci,
  `file_2` longtext COLLATE utf8_unicode_ci,
  `file_3` longtext COLLATE utf8_unicode_ci,
  `avatar` longtext COLLATE utf8_unicode_ci,
  `like` longtext COLLATE utf8_unicode_ci,
  `select_multi` longtext COLLATE utf8_unicode_ci,
  `select_opt` longtext COLLATE utf8_unicode_ci,
  `select_multi_2` longtext COLLATE utf8_unicode_ci,
  `select_opt_2` longtext COLLATE utf8_unicode_ci,
  `select_search` longtext COLLATE utf8_unicode_ci,
  `select_all` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table content_flat_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_flat_page`;

CREATE TABLE `content_flat_page` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `website_id` int(11) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `content_type` text COLLATE utf8_unicode_ci NOT NULL,
  `author` bigint(20) NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `template` text COLLATE utf8_unicode_ci,
  `publish_time` longtext COLLATE utf8_unicode_ci,
  `status` longtext COLLATE utf8_unicode_ci,
  `order` longtext COLLATE utf8_unicode_ci,
  `title` longtext COLLATE utf8_unicode_ci,
  `page_slug` longtext COLLATE utf8_unicode_ci,
  `short_description` longtext COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `featured_image` longtext COLLATE utf8_unicode_ci,
  `featured_image_title` longtext COLLATE utf8_unicode_ci,
  `featured_image_alt_text` longtext COLLATE utf8_unicode_ci,
  `images_gallery` longtext COLLATE utf8_unicode_ci,
  `featured_video_used` longtext COLLATE utf8_unicode_ci,
  `featured_video_external` longtext COLLATE utf8_unicode_ci,
  `featured_video_internal` longtext COLLATE utf8_unicode_ci,
  `meta_title` longtext COLLATE utf8_unicode_ci,
  `slug` longtext COLLATE utf8_unicode_ci,
  `meta_description` longtext COLLATE utf8_unicode_ci,
  `meta_keywords` longtext COLLATE utf8_unicode_ci,
  `canonical_url` longtext COLLATE utf8_unicode_ci,
  `meta_robots_index` longtext COLLATE utf8_unicode_ci,
  `meta_robots_follow` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table content_flat_post
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_flat_post`;

CREATE TABLE `content_flat_post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `website_id` int(11) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  `content_type` text COLLATE utf8_unicode_ci NOT NULL,
  `author` bigint(20) NOT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `template` text COLLATE utf8_unicode_ci,
  `publish_time` longtext COLLATE utf8_unicode_ci,
  `status` longtext COLLATE utf8_unicode_ci,
  `order` longtext COLLATE utf8_unicode_ci,
  `count` int(11) DEFAULT NULL,
  `title` longtext COLLATE utf8_unicode_ci,
  `category_id` longtext COLLATE utf8_unicode_ci,
  `layouttemplate` longtext COLLATE utf8_unicode_ci,
  `related_id` longtext COLLATE utf8_unicode_ci,
  `short_description` longtext COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `featured_image` longtext COLLATE utf8_unicode_ci,
  `featured_image_title` longtext COLLATE utf8_unicode_ci,
  `featured_image_alt_text` longtext COLLATE utf8_unicode_ci,
  `images_gallery` longtext COLLATE utf8_unicode_ci,
  `meta_title` longtext COLLATE utf8_unicode_ci,
  `slug` longtext COLLATE utf8_unicode_ci,
  `meta_description` longtext COLLATE utf8_unicode_ci,
  `meta_keywords` longtext COLLATE utf8_unicode_ci,
  `canonical_url` longtext COLLATE utf8_unicode_ci,
  `meta_robots_index` longtext COLLATE utf8_unicode_ci,
  `meta_robots_follow` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `viewer` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;

INSERT INTO `languages` (`id`, `name`, `code`, `created_at`, `updated_at`)
VALUES
	(2,'Descotis English','en',NULL,NULL);

/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table master_city
# ------------------------------------------------------------

DROP TABLE IF EXISTS `master_city`;

CREATE TABLE `master_city` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `master_province_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pro_kota` (`master_province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `master_city` WRITE;
/*!40000 ALTER TABLE `master_city` DISABLE KEYS */;

INSERT INTO `master_city` (`id`, `name`, `master_province_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Kabupaten Aceh Barat',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(2,'Kabupaten Aceh Barat Daya',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(3,'Kabupaten Aceh Besar',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(4,'Kabupaten Aceh Jaya',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(5,'Kabupaten Aceh Selatan',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(6,'Kabupaten Aceh Singkil',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(7,'Kabupaten Aceh Tamiang',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(8,'Kabupaten Aceh Tengah',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(9,'Kabupaten Aceh Tenggara',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(10,'Kabupaten Aceh Timur',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(11,'Kabupaten Aceh Utara',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(12,'Kabupaten Bener Meriah',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(13,'Kabupaten Bireuen',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(14,'Kabupaten Gayo Luwes',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(15,'Kabupaten Nagan Raya',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(16,'Kabupaten Pidie',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(17,'Kabupaten Pidie Jaya',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(18,'Kabupaten Simeulue',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(19,'Kota Banda Aceh',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(20,'Kota Langsa',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(21,'Kota Lhokseumawe',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(22,'Kota Sabang',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(23,'Kota Subulussalam',1,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(24,'Kabupaten Asahan',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(25,'Kabupaten Batubara',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(26,'Kabupaten Dairi',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(27,'Kabupaten Deli Serdang',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(28,'Kabupaten Humbang Hasundutan',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(29,'Kabupaten Karo',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(30,'Kabupaten Labuhan Batu',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(31,'Kabupaten Labuhanbatu Selatan',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(32,'Kabupaten Labuhanbatu Utara',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(33,'Kabupaten Langkat',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(34,'Kabupaten Mandailing Natal',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(35,'Kabupaten Nias',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(36,'Kabupaten Nias Barat',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(37,'Kabupaten Nias Selatan',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(38,'Kabupaten Nias Utara',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(39,'Kabupaten Padang Lawas',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(40,'Kabupaten Padang Lawas Utara',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(41,'Kabupaten Pakpak Barat',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(42,'Kabupaten Samosir',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(43,'Kabupaten Serdang Bedagai',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(44,'Kabupaten Simalungun',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(45,'Kabupaten Tapanuli Selatan',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(46,'Kabupaten Tapanuli Tengah',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(47,'Kabupaten Tapanuli Utara',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(48,'Kabupaten Toba Samosir',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(49,'Kota Binjai',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(50,'Kota Gunung Sitoli',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(51,'Kota Medan',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(52,'Kota Padangsidempuan',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(53,'Kota Pematang Siantar',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(54,'Kota Sibolga',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(55,'Kota Tanjung Balai',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(56,'Kota Tebing Tinggi',2,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(57,'Kabupaten Agam',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(58,'Kabupaten Dharmas Raya',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(59,'Kabupaten Kepulauan Mentawai',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(60,'Kabupaten Lima Puluh Kota',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(61,'Kabupaten Padang Pariaman',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(62,'Kabupaten Pasaman',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(63,'Kabupaten Pasaman Barat',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(64,'Kabupaten Pesisir Selatan',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(65,'Kabupaten Sijunjung',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(66,'Kabupaten Solok',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(67,'Kabupaten Solok Selatan',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(68,'Kabupaten Tanah Datar',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(69,'Kota Bukittinggi',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(70,'Kota Padang',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(71,'Kota Padang Panjang',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(72,'Kota Pariaman',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(73,'Kota Payakumbuh',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(74,'Kota Sawah Lunto',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(75,'Kota Solok',3,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(76,'Kabupaten Bengkalis',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(77,'Kabupaten Indragiri Hilir',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(78,'Kabupaten Indragiri Hulu',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(79,'Kabupaten Kampar',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(80,'Kabupaten Kuantan Singingi',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(81,'Kabupaten Meranti',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(82,'Kabupaten Pelalawan',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(83,'Kabupaten Rokan Hilir',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(84,'Kabupaten Rokan Hulu',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(85,'Kabupaten Siak',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(86,'Kota Dumai',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(87,'Kota Pekanbaru',4,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(88,'Kabupaten Bintan',5,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(89,'Kabupaten Karimun',5,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(90,'Kabupaten Kepulauan Anambas',5,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(91,'Kabupaten Lingga',5,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(92,'Kabupaten Natuna',5,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(93,'Kota Batam',5,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(94,'Kota Tanjung Pinang',5,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(95,'Kabupaten Bangka',6,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(96,'Kabupaten Bangka Barat',6,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(97,'Kabupaten Bangka Selatan',6,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(98,'Kabupaten Bangka Tengah',6,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(99,'Kabupaten Belitung',6,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(100,'Kabupaten Belitung Timur',6,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(101,'Kota Pangkal Pinang',6,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(102,'Kabupaten Kerinci',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(103,'Kabupaten Merangin',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(104,'Kabupaten Sarolangun',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(105,'Kabupaten Batang Hari',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(106,'Kabupaten Muaro Jambi',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(107,'Kabupaten Tanjung Jabung Timur',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(108,'Kabupaten Tanjung Jabung Barat',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(109,'Kabupaten Tebo',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(110,'Kabupaten Bungo',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(111,'Kota Jambi',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(112,'Kota Sungai Penuh',7,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(113,'Kabupaten Bengkulu Selatan',8,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(114,'Kabupaten Bengkulu Tengah',8,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(115,'Kabupaten Bengkulu Utara',8,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(116,'Kabupaten Kaur',8,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(117,'Kabupaten Kepahiang',8,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(118,'Kabupaten Lebong',8,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(119,'Kabupaten Mukomuko',8,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(120,'Kabupaten Rejang Lebong',8,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(121,'Kabupaten Seluma',8,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(122,'Kota Bengkulu',8,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(123,'Kabupaten Banyuasin',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(124,'Kabupaten Empat Lawang',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(125,'Kabupaten Lahat',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(126,'Kabupaten Muara Enim',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(127,'Kabupaten Musi Banyu Asin',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(128,'Kabupaten Musi Rawas',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(129,'Kabupaten Ogan Ilir',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(130,'Kabupaten Ogan Komering Ilir',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(131,'Kabupaten Ogan Komering Ulu',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(132,'Kabupaten Ogan Komering Ulu Se',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(133,'Kabupaten Ogan Komering Ulu Ti',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(134,'Kota Lubuklinggau',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(135,'Kota Pagar Alam',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(136,'Kota Palembang',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(137,'Kota Prabumulih',9,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(138,'Kabupaten Lampung Barat',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(139,'Kabupaten Lampung Selatan',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(140,'Kabupaten Lampung Tengah',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(141,'Kabupaten Lampung Timur',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(142,'Kabupaten Lampung Utara',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(143,'Kabupaten Mesuji',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(144,'Kabupaten Pesawaran',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(145,'Kabupaten Pringsewu',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(146,'Kabupaten Tanggamus',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(147,'Kabupaten Tulang Bawang',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(148,'Kabupaten Tulang Bawang Barat',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(149,'Kabupaten Way Kanan',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(150,'Kota Bandar Lampung',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(151,'Kota Metro',10,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(152,'Kabupaten Lebak',11,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(153,'Kabupaten Pandeglang',11,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(154,'Kabupaten Serang',11,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(155,'Kabupaten Tangerang',11,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(156,'Kota Cilegon',11,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(157,'Kota Serang',11,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(158,'Kota Tangerang',11,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(159,'Kota Tangerang Selatan',11,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(160,'Kabupaten Adm. Kepulauan Serib',12,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(161,'Kota Jakarta Barat',12,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(162,'Kota Jakarta Pusat',12,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(163,'Kota Jakarta Selatan',12,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(164,'Kota Jakarta Timur',12,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(165,'Kota Jakarta Utara',12,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(166,'Kabupaten Bandung',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(167,'Kabupaten Bandung Barat',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(168,'Kabupaten Bekasi',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(169,'Kabupaten Bogor',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(170,'Kabupaten Ciamis',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(171,'Kabupaten Cianjur',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(172,'Kabupaten Cirebon',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(173,'Kabupaten Garut',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(174,'Kabupaten Indramayu',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(175,'Kabupaten Karawang',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(176,'Kabupaten Kuningan',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(177,'Kabupaten Majalengka',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(178,'Kabupaten Purwakarta',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(179,'Kabupaten Subang',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(180,'Kabupaten Sukabumi',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(181,'Kabupaten Sumedang',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(182,'Kabupaten Tasikmalaya',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(183,'Kota Bandung',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(184,'Kota Banjar',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(185,'Kota Bekasi',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(186,'Kota Bogor',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(187,'Kota Cimahi',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(188,'Kota Cirebon',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(189,'Kota Depok',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(190,'Kota Sukabumi',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(191,'Kota Tasikmalaya',13,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(192,'Kabupaten Banjarnegara',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(193,'Kabupaten Banyumas',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(194,'Kabupaten Batang',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(195,'Kabupaten Blora',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(196,'Kabupaten Boyolali',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(197,'Kabupaten Brebes',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(198,'Kabupaten Cilacap',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(199,'Kabupaten Demak',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(200,'Kabupaten Grobogan',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(201,'Kabupaten Jepara',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(202,'Kabupaten Karanganyar',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(203,'Kabupaten Kebumen',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(204,'Kabupaten Kendal',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(205,'Kabupaten Klaten',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(206,'Kabupaten Kota Tegal',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(207,'Kabupaten Kudus',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(208,'Kabupaten Magelang',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(209,'Kabupaten Pati',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(210,'Kabupaten Pekalongan',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(211,'Kabupaten Pemalang',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(212,'Kabupaten Purbalingga',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(213,'Kabupaten Purworejo',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(214,'Kabupaten Rembang',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(215,'Kabupaten Semarang',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(216,'Kabupaten Sragen',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(217,'Kabupaten Sukoharjo',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(218,'Kabupaten Temanggung',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(219,'Kabupaten Wonogiri',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(220,'Kabupaten Wonosobo',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(221,'Kota Magelang',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(222,'Kota Pekalongan',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(223,'Kota Salatiga',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(224,'Kota Semarang',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(225,'Kota Surakarta',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(226,'Kota Tegal',14,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(227,'Kabupaten Bantul',15,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(228,'Kabupaten Gunung Kidul',15,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(229,'Kabupaten Kulon Progo',15,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(230,'Kabupaten Sleman',15,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(231,'Kota Yogyakarta',15,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(232,'Kabupaten Bangkalan',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(233,'Kabupaten Banyuwangi',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(234,'Kabupaten Blitar',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(235,'Kabupaten Bojonegoro',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(236,'Kabupaten Bondowoso',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(237,'Kabupaten Gresik',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(238,'Kabupaten Jember',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(239,'Kabupaten Jombang',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(240,'Kabupaten Kediri',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(241,'Kabupaten Lamongan',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(242,'Kabupaten Lumajang',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(243,'Kabupaten Madiun',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(244,'Kabupaten Magetan',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(245,'Kabupaten Malang',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(246,'Kabupaten Mojokerto',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(247,'Kabupaten Nganjuk',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(248,'Kabupaten Ngawi',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(249,'Kabupaten Pacitan',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(250,'Kabupaten Pamekasan',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(251,'Kabupaten Pasuruan',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(252,'Kabupaten Ponorogo',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(253,'Kabupaten Probolinggo',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(254,'Kabupaten Sampang',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(255,'Kabupaten Sidoarjo',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(256,'Kabupaten Situbondo',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(257,'Kabupaten Sumenep',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(258,'Kabupaten Trenggalek',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(259,'Kabupaten Tuban',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(260,'Kabupaten Tulungagung',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(261,'Kota Batu',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(262,'Kota Blitar',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(263,'Kota Kediri',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(264,'Kota Madiun',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(265,'Kota Malang',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(266,'Kota Mojokerto',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(267,'Kota Pasuruan',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(268,'Kota Probolinggo',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(269,'Kota Surabaya',16,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(270,'Kabupaten Badung',17,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(271,'Kabupaten Bangli',17,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(272,'Kabupaten Buleleng',17,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(273,'Kabupaten Gianyar',17,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(274,'Kabupaten Jembrana',17,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(275,'Kabupaten Karang Asem',17,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(276,'Kabupaten Klungkung',17,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(277,'Kabupaten Tabanan',17,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(278,'Kota Denpasar',17,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(279,'Kabupaten Bima',18,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(280,'Kabupaten Dompu',18,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(281,'Kabupaten Lombok Barat',18,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(282,'Kabupaten Lombok Tengah',18,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(283,'Kabupaten Lombok Timur',18,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(284,'Kabupaten Lombok Utara',18,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(285,'Kabupaten Sumbawa',18,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(286,'Kabupaten Sumbawa Barat',18,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(287,'Kota Bima',18,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(288,'Kota Mataram',18,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(289,'Kabupaten Alor',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(290,'Kabupaten Belu',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(291,'Kabupaten Ende',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(292,'Kabupaten Flores Timur',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(293,'Kabupaten Kupang',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(294,'Kabupaten Lembata',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(295,'Kabupaten Manggarai',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(296,'Kabupaten Manggarai Barat',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(297,'Kabupaten Manggarai Timur',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(298,'Kabupaten Nagekeo',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(299,'Kabupaten Ngada',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(300,'Kabupaten Rote Ndao',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(301,'Kabupaten Sabu Raijua',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(302,'Kabupaten Sikka',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(303,'Kabupaten Sumba Barat',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(304,'Kabupaten Sumba Barat Daya',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(305,'Kabupaten Sumba Tengah',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(306,'Kabupaten Sumba Timur',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(307,'Kabupaten Timor Tengah Selatan',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(308,'Kabupaten Timor Tengah Utara',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(309,'Kota Kupang',19,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(310,'Kabupaten Bengkayang',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(311,'Kabupaten Kapuas Hulu',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(312,'Kabupaten Kayong Utara',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(313,'Kabupaten Ketapang',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(314,'Kabupaten Kubu Raya',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(315,'Kabupaten Landak',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(316,'Kabupaten Melawi',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(317,'Kabupaten Pontianak',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(318,'Kabupaten Sambas',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(319,'Kabupaten Sanggau',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(320,'Kabupaten Sekadau',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(321,'Kabupaten Sintang',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(322,'Kota Pontianak',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(323,'Kota Singkawang',20,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(324,'Kabupaten Barito Selatan',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(325,'Kabupaten Barito Timur',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(326,'Kabupaten Barito Utara',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(327,'Kabupaten Gunung Mas',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(328,'Kabupaten Kapuas',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(329,'Kabupaten Katingan',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(330,'Kabupaten Kotawaringin Barat',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(331,'Kabupaten Kotawaringin Timur',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(332,'Kabupaten Lamandau',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(333,'Kabupaten Murung Raya',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(334,'Kabupaten Pulang Pisau',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(335,'Kabupaten Seruyan',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(336,'Kabupaten Sukamara',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(337,'Kota Palangkaraya',21,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(338,'Kabupaten Balangan',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(339,'Kabupaten Banjar',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(340,'Kabupaten Barito Kuala',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(341,'Kabupaten Hulu Sungai Selatan',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(342,'Kabupaten Hulu Sungai Tengah',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(343,'Kabupaten Hulu Sungai Utara',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(344,'Kabupaten Kota Baru',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(345,'Kabupaten Tabalong',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(346,'Kabupaten Tanah Bumbu',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(347,'Kabupaten Tanah Laut',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(348,'Kabupaten Tapin',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(349,'Kota Banjar Baru',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(350,'Kota Banjarmasin',22,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(351,'Kabupaten Berau',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(352,'Kabupaten Bulongan',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(353,'Kabupaten Kutai Barat',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(354,'Kabupaten Kutai Kartanegara',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(355,'Kabupaten Kutai Timur',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(356,'Kabupaten Malinau',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(357,'Kabupaten Nunukan',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(358,'Kabupaten Paser',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(359,'Kabupaten Penajam Paser Utara',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(360,'Kabupaten Tana Tidung',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(361,'Kota Balikpapan',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(362,'Kota Bontang',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(363,'Kota Samarinda',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(364,'Kota Tarakan',23,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(365,'Kabupaten Boalemo',24,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(366,'Kabupaten Bone Bolango',24,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(367,'Kabupaten Gorontalo',24,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(368,'Kabupaten Gorontalo Utara',24,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(369,'Kabupaten Pohuwato',24,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(370,'Kota Gorontalo',24,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(371,'Kabupaten Bantaeng',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(372,'Kabupaten Barru',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(373,'Kabupaten Bone',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(374,'Kabupaten Bulukumba',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(375,'Kabupaten Enrekang',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(376,'Kabupaten Gowa',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(377,'Kabupaten Jeneponto',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(378,'Kabupaten Luwu',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(379,'Kabupaten Luwu Timur',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(380,'Kabupaten Luwu Utara',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(381,'Kabupaten Maros',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(382,'Kabupaten Pangkajene Kepulauan',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(383,'Kabupaten Pinrang',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(384,'Kabupaten Selayar',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(385,'Kabupaten Sidenreng Rappang',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(386,'Kabupaten Sinjai',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(387,'Kabupaten Soppeng',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(388,'Kabupaten Takalar',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(389,'Kabupaten Tana Toraja',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(390,'Kabupaten Toraja Utara',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(391,'Kabupaten Wajo',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(392,'Kota Makassar',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(393,'Kota Palopo',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(394,'Kota Pare-pare',25,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(395,'Kabupaten Bombana',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(396,'Kabupaten Buton',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(397,'Kabupaten Buton Utara',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(398,'Kabupaten Kolaka',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(399,'Kabupaten Kolaka Utara',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(400,'Kabupaten Konawe',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(401,'Kabupaten Konawe Selatan',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(402,'Kabupaten Konawe Utara',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(403,'Kabupaten Muna',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(404,'Kabupaten Wakatobi',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(405,'Kota Bau-bau',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(406,'Kota Kendari',26,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(407,'Kabupaten Banggai',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(408,'Kabupaten Banggai Kepulauan',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(409,'Kabupaten Buol',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(410,'Kabupaten Donggala',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(411,'Kabupaten Morowali',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(412,'Kabupaten Parigi Moutong',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(413,'Kabupaten Poso',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(414,'Kabupaten Sigi',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(415,'Kabupaten Tojo Una-Una',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(416,'Kabupaten Toli Toli',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(417,'Kota Palu',27,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(418,'Kabupaten Bolaang Mangondow',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(419,'Kabupaten Bolaang Mangondow Se',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(420,'Kabupaten Bolaang Mangondow Ti',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(421,'Kabupaten Bolaang Mangondow Ut',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(422,'Kabupaten Kepulauan Sangihe',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(423,'Kabupaten Kepulauan Siau Tagul',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(424,'Kabupaten Kepulauan Talaud',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(425,'Kabupaten Minahasa',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(426,'Kabupaten Minahasa Selatan',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(427,'Kabupaten Minahasa Tenggara',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(428,'Kabupaten Minahasa Utara',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(429,'Kota Bitung',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(430,'Kota Kotamobagu',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(431,'Kota Manado',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(432,'Kota Tomohon',28,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(433,'Kabupaten Majene',29,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(434,'Kabupaten Mamasa',29,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(435,'Kabupaten Mamuju',29,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(436,'Kabupaten Mamuju Utara',29,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(437,'Kabupaten Polewali Mandar',29,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(438,'Kabupaten Buru',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(439,'Kabupaten Buru Selatan',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(440,'Kabupaten Kepulauan Aru',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(441,'Kabupaten Maluku Barat Daya',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(442,'Kabupaten Maluku Tengah',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(443,'Kabupaten Maluku Tenggara',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(444,'Kabupaten Maluku Tenggara Bara',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(445,'Kabupaten Seram Bagian Barat',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(446,'Kabupaten Seram Bagian Timur',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(447,'Kota Ambon',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(448,'Kota Tual',30,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(449,'Kabupaten Halmahera Barat',31,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(450,'Kabupaten Halmahera Selatan',31,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(451,'Kabupaten Halmahera Tengah',31,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(452,'Kabupaten Halmahera Timur',31,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(453,'Kabupaten Halmahera Utara',31,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(454,'Kabupaten Kepulauan Sula',31,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(455,'Kabupaten Pulau Morotai',31,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(456,'Kota Ternate',31,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(457,'Kota Tidore Kepulauan',31,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(458,'Kabupaten Fakfak',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(459,'Kabupaten Kaimana',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(460,'Kabupaten Manokwari',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(461,'Kabupaten Maybrat',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(462,'Kabupaten Raja Ampat',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(463,'Kabupaten Sorong',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(464,'Kabupaten Sorong Selatan',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(465,'Kabupaten Tambrauw',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(466,'Kabupaten Teluk Bintuni',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(467,'Kabupaten Teluk Wondama',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(468,'Kota Sorong',32,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(469,'Kabupaten Merauke',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(470,'Kabupaten Jayawijaya',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(471,'Kabupaten Nabire',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(472,'Kabupaten Kepulauan Yapen',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(473,'Kabupaten Biak Numfor',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(474,'Kabupaten Paniai',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(475,'Kabupaten Puncak Jaya',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(476,'Kabupaten Mimika',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(477,'Kabupaten Boven Digoel',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(478,'Kabupaten Mappi',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(479,'Kabupaten Asmat',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(480,'Kabupaten Yahukimo',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(481,'Kabupaten Pegunungan Bintang',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(482,'Kabupaten Tolikara',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(483,'Kabupaten Sarmi',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(484,'Kabupaten Keerom',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(485,'Kabupaten Waropen',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(486,'Kabupaten Jayapura',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(487,'Kabupaten Deiyai',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(488,'Kabupaten Dogiyai',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(489,'Kabupaten Intan Jaya',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(490,'Kabupaten Lanny Jaya',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(491,'Kabupaten Mamberamo Raya',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(492,'Kabupaten Mamberamo Tengah',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(493,'Kabupaten Nduga',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(494,'Kabupaten Puncak',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(495,'Kabupaten Supiori',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(496,'Kabupaten Yalimo',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(497,'Kota Jayapura',33,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(498,'Kabupaten Bulungan',34,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(499,'Kabupaten Malinau',34,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(500,'Kabupaten Nunukan',34,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(501,'Kabupaten Tana Tidung',34,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL),
	(502,'Kota Tarakan',34,'2016-07-12 11:13:23','0000-00-00 00:00:00',NULL);

/*!40000 ALTER TABLE `master_city` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table master_province
# ------------------------------------------------------------

DROP TABLE IF EXISTS `master_province`;

CREATE TABLE `master_province` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `master_province` WRITE;
/*!40000 ALTER TABLE `master_province` DISABLE KEYS */;

INSERT INTO `master_province` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Nanggroe Aceh Darussalam','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(2,'Sumatera Utara','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(3,'Sumatera Barat','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(4,'Riau','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(5,'Kepulauan Riau','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(6,'Kepulauan Bangka-Belitung','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(7,'Jambi','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(8,'Bengkulu','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(9,'Sumatera Selatan','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(10,'Lampung','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(11,'Banten','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(12,'DKI Jakarta','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(13,'Jawa Barat','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(14,'Jawa Tengah','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(15,'Daerah Istimewa Yogyakarta  ','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(16,'Jawa Timur','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(17,'Bali','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(18,'Nusa Tenggara Barat','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(19,'Nusa Tenggara Timur','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(20,'Kalimantan Barat','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(21,'Kalimantan Tengah','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(22,'Kalimantan Selatan','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(23,'Kalimantan Timur','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(24,'Gorontalo','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(25,'Sulawesi Selatan','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(26,'Sulawesi Tenggara','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(27,'Sulawesi Tengah','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(28,'Sulawesi Utara','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(29,'Sulawesi Barat','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(30,'Maluku','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(31,'Maluku Utara','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(32,'Papua Barat','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(33,'Papua','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL),
	(34,'Kalimantan Utara','2016-07-12 10:10:07','0000-00-00 00:00:00',NULL);

/*!40000 ALTER TABLE `master_province` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2017_12_09_100317_create_shoppingcart_table',1),
	(4,'2013_11_26_161501_create_currency_table',2),
	(5,'2014_04_02_193005_create_translations_table',2),
	(6,'2019_09_06_134601_create_languages_table',3);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `template` int(11) NOT NULL,
  `title` text NOT NULL,
  `subtitle` text,
  `url` text NOT NULL,
  `meta_title` text,
  `meta_description` text,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `crated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table pages_box
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages_box`;

CREATE TABLE `pages_box` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table pages_template
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages_template`;

CREATE TABLE `pages_template` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table sys_blogs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_blogs`;

CREATE TABLE `sys_blogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` bigint(20) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `content` longtext,
  `publish_time` timestamp NULL DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_blogs_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_blogs_data`;

CREATE TABLE `sys_blogs_data` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` bigint(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `data_key` text NOT NULL,
  `data_value` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_category_recipe
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_category_recipe`;

CREATE TABLE `sys_category_recipe` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` bigint(20) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `content` longtext,
  `publish_time` timestamp NULL DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_category_recipe_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_category_recipe_data`;

CREATE TABLE `sys_category_recipe_data` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` bigint(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `data_key` text NOT NULL,
  `data_value` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_content_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_content_data`;

CREATE TABLE `sys_content_data` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` bigint(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `data_key` text NOT NULL,
  `data_value` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_content_relation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_content_relation`;

CREATE TABLE `sys_content_relation` (
  `id` bigint(111) unsigned NOT NULL AUTO_INCREMENT,
  `relation` varchar(200) NOT NULL DEFAULT '',
  `parent_id` bigint(11) unsigned NOT NULL,
  `child_id` bigint(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_content_relation_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_content_relation_product`;

CREATE TABLE `sys_content_relation_product` (
  `id` bigint(111) unsigned NOT NULL AUTO_INCREMENT,
  `relation` varchar(200) NOT NULL DEFAULT '',
  `parent_id` bigint(11) unsigned NOT NULL,
  `child_id` bigint(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_contents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_contents`;

CREATE TABLE `sys_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` bigint(20) NOT NULL,
  `type` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `content` longtext,
  `excerpt` text,
  `template` text,
  `publish_time` timestamp NULL DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `parent` bigint(20) NOT NULL DEFAULT '0',
  `comment_status` enum('0','1') NOT NULL DEFAULT '0',
  `modified_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_country
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_country`;

CREATE TABLE `sys_country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_code` char(2) CHARACTER SET utf8 DEFAULT NULL,
  `country_name` text CHARACTER SET utf8,
  PRIMARY KEY (`id`),
  KEY `idx_country_code` (`country_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

LOCK TABLES `sys_country` WRITE;
/*!40000 ALTER TABLE `sys_country` DISABLE KEYS */;

INSERT INTO `sys_country` (`id`, `country_code`, `country_name`)
VALUES
	(1,'AD','Andorra'),
	(2,'AE','United Arab Emirates'),
	(3,'AF','Afghanistan'),
	(4,'AG','Antigua and Barbuda'),
	(5,'AI','Anguilla'),
	(6,'AL','Albania'),
	(7,'AM','Armenia'),
	(8,'AN','Netherlands Antilles'),
	(9,'AO','Angola'),
	(10,'AQ','Antarctica'),
	(11,'AR','Argentina'),
	(12,'AS','American Samoa'),
	(13,'AT','Austria'),
	(14,'AU','Australia'),
	(15,'AW','Aruba'),
	(16,'AX','Aland Islands'),
	(17,'AZ','Azerbaijan'),
	(18,'BA','Bosnia and Herzegovina'),
	(19,'BB','Barbados'),
	(20,'BD','Bangladesh'),
	(21,'BE','Belgium'),
	(22,'BF','Burkina Faso'),
	(23,'BG','Bulgaria'),
	(24,'BH','Bahrain'),
	(25,'BI','Burundi'),
	(26,'BJ','Benin'),
	(27,'BL','Saint Barthélemy'),
	(28,'BM','Bermuda'),
	(29,'BN','Brunei'),
	(30,'BO','Bolivia'),
	(31,'BQ','Bonaire, Saint Eustatius and Saba '),
	(32,'BR','Brazil'),
	(33,'BS','Bahamas'),
	(34,'BT','Bhutan'),
	(35,'BV','Bouvet Island'),
	(36,'BW','Botswana'),
	(37,'BY','Belarus'),
	(38,'BZ','Belize'),
	(39,'CA','Canada'),
	(40,'CC','Cocos Islands'),
	(41,'CD','Democratic Republic of the Congo'),
	(42,'CF','Central African Republic'),
	(43,'CG','Republic of the Congo'),
	(44,'CH','Switzerland'),
	(45,'CI','Ivory Coast'),
	(46,'CK','Cook Islands'),
	(47,'CL','Chile'),
	(48,'CM','Cameroon'),
	(49,'CN','China'),
	(50,'CO','Colombia'),
	(51,'CR','Costa Rica'),
	(52,'CS','Serbia and Montenegro'),
	(53,'CU','Cuba'),
	(54,'CV','Cape Verde'),
	(55,'CW','Curaçao'),
	(56,'CX','Christmas Island'),
	(57,'CY','Cyprus'),
	(58,'CZ','Czech Republic'),
	(59,'DE','Germany'),
	(60,'DJ','Djibouti'),
	(61,'DK','Denmark'),
	(62,'DM','Dominica'),
	(63,'DO','Dominican Republic'),
	(64,'DZ','Algeria'),
	(65,'EC','Ecuador'),
	(66,'EE','Estonia'),
	(67,'EG','Egypt'),
	(68,'EH','Western Sahara'),
	(69,'ER','Eritrea'),
	(70,'ES','Spain'),
	(71,'ET','Ethiopia'),
	(72,'FI','Finland'),
	(73,'FJ','Fiji'),
	(74,'FK','Falkland Islands'),
	(75,'FM','Micronesia'),
	(76,'FO','Faroe Islands'),
	(77,'FR','France'),
	(78,'GA','Gabon'),
	(79,'GB','United Kingdom'),
	(80,'GD','Grenada'),
	(81,'GE','Georgia'),
	(82,'GF','French Guiana'),
	(83,'GG','Guernsey'),
	(84,'GH','Ghana'),
	(85,'GI','Gibraltar'),
	(86,'GL','Greenland'),
	(87,'GM','Gambia'),
	(88,'GN','Guinea'),
	(89,'GP','Guadeloupe'),
	(90,'GQ','Equatorial Guinea'),
	(91,'GR','Greece'),
	(92,'GS','South Georgia and the South Sandwich Islands'),
	(93,'GT','Guatemala'),
	(94,'GU','Guam'),
	(95,'GW','Guinea-Bissau'),
	(96,'GY','Guyana'),
	(97,'HK','Hong Kong'),
	(98,'HM','Heard Island and McDonald Islands'),
	(99,'HN','Honduras'),
	(100,'HR','Croatia'),
	(101,'HT','Haiti'),
	(102,'HU','Hungary'),
	(103,'ID','Indonesia'),
	(104,'IE','Ireland'),
	(105,'IL','Israel'),
	(106,'IM','Isle of Man'),
	(107,'IN','India'),
	(108,'IO','British Indian Ocean Territory'),
	(109,'IQ','Iraq'),
	(110,'IR','Iran'),
	(111,'IS','Iceland'),
	(112,'IT','Italy'),
	(113,'JE','Jersey'),
	(114,'JM','Jamaica'),
	(115,'JO','Jordan'),
	(116,'JP','Japan'),
	(117,'KE','Kenya'),
	(118,'KG','Kyrgyzstan'),
	(119,'KH','Cambodia'),
	(120,'KI','Kiribati'),
	(121,'KM','Comoros'),
	(122,'KN','Saint Kitts and Nevis'),
	(123,'KP','North Korea'),
	(124,'KR','South Korea'),
	(125,'KW','Kuwait'),
	(126,'KY','Cayman Islands'),
	(127,'KZ','Kazakhstan'),
	(128,'LA','Laos'),
	(129,'LB','Lebanon'),
	(130,'LC','Saint Lucia'),
	(131,'LI','Liechtenstein'),
	(132,'LK','Sri Lanka'),
	(133,'LR','Liberia'),
	(134,'LS','Lesotho'),
	(135,'LT','Lithuania'),
	(136,'LU','Luxembourg'),
	(137,'LV','Latvia'),
	(138,'LY','Libya'),
	(139,'MA','Morocco'),
	(140,'MC','Monaco'),
	(141,'MD','Moldova'),
	(142,'ME','Montenegro'),
	(143,'MF','Saint Martin'),
	(144,'MG','Madagascar'),
	(145,'MH','Marshall Islands'),
	(146,'MK','Macedonia'),
	(147,'ML','Mali'),
	(148,'MM','Myanmar'),
	(149,'MN','Mongolia'),
	(150,'MO','Macao'),
	(151,'MP','Northern Mariana Islands'),
	(152,'MQ','Martinique'),
	(153,'MR','Mauritania'),
	(154,'MS','Montserrat'),
	(155,'MT','Malta'),
	(156,'MU','Mauritius'),
	(157,'MV','Maldives'),
	(158,'MW','Malawi'),
	(159,'MX','Mexico'),
	(160,'MY','Malaysia'),
	(161,'MZ','Mozambique'),
	(162,'NA','Namibia'),
	(163,'NC','New Caledonia'),
	(164,'NE','Niger'),
	(165,'NF','Norfolk Island'),
	(166,'NG','Nigeria'),
	(167,'NI','Nicaragua'),
	(168,'NL','Netherlands'),
	(169,'NO','Norway'),
	(170,'NP','Nepal'),
	(171,'NR','Nauru'),
	(172,'NU','Niue'),
	(173,'NZ','New Zealand'),
	(174,'OM','Oman'),
	(175,'PA','Panama'),
	(176,'PE','Peru'),
	(177,'PF','French Polynesia'),
	(178,'PG','Papua New Guinea'),
	(179,'PH','Philippines'),
	(180,'PK','Pakistan'),
	(181,'PL','Poland'),
	(182,'PM','Saint Pierre and Miquelon'),
	(183,'PN','Pitcairn'),
	(184,'PR','Puerto Rico'),
	(185,'PS','Palestinian Territory'),
	(186,'PT','Portugal'),
	(187,'PW','Palau'),
	(188,'PY','Paraguay'),
	(189,'QA','Qatar'),
	(190,'RE','Reunion'),
	(191,'RO','Romania'),
	(192,'RS','Serbia'),
	(193,'RU','Russia'),
	(194,'RW','Rwanda'),
	(195,'SA','Saudi Arabia'),
	(196,'SB','Solomon Islands'),
	(197,'SC','Seychelles'),
	(198,'SD','Sudan'),
	(199,'SE','Sweden'),
	(200,'SG','Singapore'),
	(201,'SH','Saint Helena'),
	(202,'SI','Slovenia'),
	(203,'SJ','Svalbard and Jan Mayen'),
	(204,'SK','Slovakia'),
	(205,'SL','Sierra Leone'),
	(206,'SM','San Marino'),
	(207,'SN','Senegal'),
	(208,'SO','Somalia'),
	(209,'SR','Suriname'),
	(210,'SS','South Sudan'),
	(211,'ST','Sao Tome and Principe'),
	(212,'SV','El Salvador'),
	(213,'SX','Sint Maarten'),
	(214,'SY','Syria'),
	(215,'SZ','Swaziland'),
	(216,'TC','Turks and Caicos Islands'),
	(217,'TD','Chad'),
	(218,'TF','French Southern Territories'),
	(219,'TG','Togo'),
	(220,'TH','Thailand'),
	(221,'TJ','Tajikistan'),
	(222,'TK','Tokelau'),
	(223,'TL','East Timor'),
	(224,'TM','Turkmenistan'),
	(225,'TN','Tunisia'),
	(226,'TO','Tonga'),
	(227,'TR','Turkey'),
	(228,'TT','Trinidad and Tobago'),
	(229,'TV','Tuvalu'),
	(230,'TW','Taiwan'),
	(231,'TZ','Tanzania'),
	(232,'UA','Ukraine'),
	(233,'UG','Uganda'),
	(234,'UM','United States Minor Outlying Islands'),
	(235,'US','United States'),
	(236,'UY','Uruguay'),
	(237,'UZ','Uzbekistan'),
	(238,'VA','Vatican'),
	(239,'VC','Saint Vincent and the Grenadines'),
	(240,'VE','Venezuela'),
	(241,'VG','British Virgin Islands'),
	(242,'VI','U.S. Virgin Islands'),
	(243,'VN','Vietnam'),
	(244,'VU','Vanuatu'),
	(245,'WF','Wallis and Futuna'),
	(246,'WS','Samoa'),
	(247,'XK','Kosovo'),
	(248,'YE','Yemen'),
	(249,'YT','Mayotte'),
	(250,'ZA','South Africa'),
	(251,'ZM','Zambia'),
	(252,'ZW','Zimbabwe');

/*!40000 ALTER TABLE `sys_country` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sys_locale
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_locale`;

CREATE TABLE `sys_locale` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code_long` varchar(4) NOT NULL DEFAULT '',
  `code` varchar(3) NOT NULL DEFAULT '',
  `name` varchar(81) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_locale_code_long_unique` (`code_long`),
  UNIQUE KEY `sys_locale_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `sys_locale` WRITE;
/*!40000 ALTER TABLE `sys_locale` DISABLE KEYS */;

INSERT INTO `sys_locale` (`id`, `code_long`, `code`, `name`)
VALUES
	(1,'aar','aa','Afar'),
	(2,'abk','ab','Abkhazian'),
	(3,'afr','af','Afrikaans'),
	(4,'aka','ak','Akan'),
	(5,'alb','sq','Albanian'),
	(6,'amh','am','Amharic'),
	(7,'ara','ar','Arabic'),
	(8,'arg','an','Aragonese'),
	(9,'arm','hy','Armenian'),
	(10,'asm','as','Assamese'),
	(11,'ava','av','Avaric'),
	(12,'ave','ae','Avestan'),
	(13,'aym','ay','Aymara'),
	(14,'aze','az','Azerbaijani'),
	(15,'bak','ba','Bashkir'),
	(16,'bam','bm','Bambara'),
	(17,'baq','eu','Basque'),
	(18,'bel','be','Belarusian'),
	(19,'ben','bn','Bengali'),
	(20,'bih','bh','Bihari languages'),
	(21,'bis','bi','Bislama'),
	(22,'bos','bs','Bosnian'),
	(23,'bre','br','Breton'),
	(24,'bul','bg','Bulgarian'),
	(25,'bur','my','Burmese'),
	(26,'cat','ca','Catalan; Valencian'),
	(27,'cha','ch','Chamorro'),
	(28,'che','ce','Chechen'),
	(29,'chi','zh','Chinese'),
	(30,'chu','cu','Church Slavic; Old Slavonic; Church Slavonic; Old Bulgarian; Old Church Slavonic'),
	(31,'chv','cv','Chuvash'),
	(32,'cor','kw','Cornish'),
	(33,'cos','co','Corsican'),
	(34,'cre','cr','Cree'),
	(35,'cze','cs','Czech'),
	(36,'dan','da','Danish'),
	(37,'div','dv','Divehi; Dhivehi; Maldivian'),
	(38,'dut','nl','Dutch; Flemish'),
	(39,'dzo','dz','Dzongkha'),
	(40,'eng','en','English'),
	(41,'epo','eo','Esperanto'),
	(42,'est','et','Estonian'),
	(43,'ewe','ee','Ewe'),
	(44,'fao','fo','Faroese'),
	(45,'fij','fj','Fijian'),
	(46,'fin','fi','Finnish'),
	(47,'fre','fr','French'),
	(48,'fry','fy','Western Frisian'),
	(49,'ful','ff','Fulah'),
	(50,'geo','ka','Georgian'),
	(51,'ger','de','German'),
	(52,'gla','gd','Gaelic; Scottish Gaelic'),
	(53,'gle','ga','Irish'),
	(54,'glg','gl','Galician'),
	(55,'glv','gv','Manx'),
	(56,'gre','el','Greek, Modern (1453-)'),
	(57,'grn','gn','Guarani'),
	(58,'guj','gu','Gujarati'),
	(59,'hat','ht','Haitian; Haitian Creole'),
	(60,'hau','ha','Hausa'),
	(61,'heb','he','Hebrew'),
	(62,'her','hz','Herero'),
	(63,'hin','hi','Hindi'),
	(64,'hmo','ho','Hiri Motu'),
	(65,'hrv','hr','Croatian'),
	(66,'hun','hu','Hungarian'),
	(67,'ibo','ig','Igbo'),
	(68,'ice','is','Icelandic'),
	(69,'ido','io','Ido'),
	(70,'iii','ii','Sichuan Yi; Nuosu'),
	(71,'iku','iu','Inuktitut'),
	(72,'ile','ie','Interlingue; Occidental'),
	(73,'ina','ia','Interlingua (International Auxiliary Language Association)'),
	(74,'ind','id','Indonesian'),
	(75,'ipk','ik','Inupiaq'),
	(76,'ita','it','Italian'),
	(77,'jav','jv','Javanese'),
	(78,'jpn','ja','Japanese'),
	(79,'kal','kl','Kalaallisut; Greenlandic'),
	(80,'kan','kn','Kannada'),
	(81,'kas','ks','Kashmiri'),
	(82,'kau','kr','Kanuri'),
	(83,'kaz','kk','Kazakh'),
	(84,'khm','km','Central Khmer'),
	(85,'kik','ki','Kikuyu; Gikuyu'),
	(86,'kin','rw','Kinyarwanda'),
	(87,'kir','ky','Kirghiz; Kyrgyz'),
	(88,'kom','kv','Komi'),
	(89,'kon','kg','Kongo'),
	(90,'kor','ko','Korean'),
	(91,'kua','kj','Kuanyama; Kwanyama'),
	(92,'kur','ku','Kurdish'),
	(93,'lao','lo','Lao'),
	(94,'lat','la','Latin'),
	(95,'lav','lv','Latvian'),
	(96,'lim','li','Limburgan; Limburger; Limburgish'),
	(97,'lin','ln','Lingala'),
	(98,'lit','lt','Lithuanian'),
	(99,'ltz','lb','Luxembourgish; Letzeburgesch'),
	(100,'lub','lu','Luba-Katanga'),
	(101,'lug','lg','Ganda'),
	(102,'mac','mk','Macedonian'),
	(103,'mah','mh','Marshallese'),
	(104,'mal','ml','Malayalam'),
	(105,'mao','mi','Maori'),
	(106,'mar','mr','Marathi'),
	(107,'may','ms','Malay'),
	(108,'mlg','mg','Malagasy'),
	(109,'mlt','mt','Maltese'),
	(110,'mon','mn','Mongolian'),
	(111,'nau','na','Nauru'),
	(112,'nav','nv','Navajo; Navaho'),
	(113,'nbl','nr','Ndebele, South; South Ndebele'),
	(114,'nde','nd','Ndebele, North; North Ndebele'),
	(115,'ndo','ng','Ndonga'),
	(116,'nep','ne','Nepali'),
	(117,'nno','nn','Norwegian Nynorsk; Nynorsk, Norwegian'),
	(118,'nob','nb','Bokmål, Norwegian; Norwegian Bokmål'),
	(119,'nor','no','Norwegian'),
	(120,'nya','ny','Chichewa; Chewa; Nyanja'),
	(121,'oci','oc','Occitan (post 1500); Provençal'),
	(122,'oji','oj','Ojibwa'),
	(123,'ori','or','Oriya'),
	(124,'orm','om','Oromo'),
	(125,'oss','os','Ossetian; Ossetic'),
	(126,'pan','pa','Panjabi; Punjabi'),
	(127,'per','fa','Persian'),
	(128,'pli','pi','Pali'),
	(129,'pol','pl','Polish'),
	(130,'por','pt','Portuguese'),
	(131,'pus','ps','Pushto; Pashto'),
	(132,'que','qu','Quechua'),
	(133,'roh','rm','Romansh'),
	(134,'rum','ro','Romanian; Moldavian; Moldovan'),
	(135,'run','rn','Rundi'),
	(136,'rus','ru','Russian'),
	(137,'sag','sg','Sango'),
	(138,'san','sa','Sanskrit'),
	(139,'sin','si','Sinhala; Sinhalese'),
	(140,'slo','sk','Slovak'),
	(141,'slv','sl','Slovenian'),
	(142,'sme','se','Northern Sami'),
	(143,'smo','sm','Samoan'),
	(144,'sna','sn','Shona'),
	(145,'snd','sd','Sindhi'),
	(146,'som','so','Somali'),
	(147,'sot','st','Sotho, Southern'),
	(148,'spa','es','Spanish; Castilian'),
	(149,'srd','sc','Sardinian'),
	(150,'srp','sr','Serbian'),
	(151,'ssw','ss','Swati'),
	(152,'sun','su','Sundanese'),
	(153,'swa','sw','Swahili'),
	(154,'swe','sv','Swedish'),
	(155,'tah','ty','Tahitian'),
	(156,'tam','ta','Tamil'),
	(157,'tat','tt','Tatar'),
	(158,'tel','te','Telugu'),
	(159,'tgk','tg','Tajik'),
	(160,'tgl','tl','Tagalog'),
	(161,'tha','th','Thai'),
	(162,'tib','bo','Tibetan'),
	(163,'tir','ti','Tigrinya'),
	(164,'ton','to','Tonga (Tonga Islands)'),
	(165,'tsn','tn','Tswana'),
	(166,'tso','ts','Tsonga'),
	(167,'tuk','tk','Turkmen'),
	(168,'tur','tr','Turkish'),
	(169,'twi','tw','Twi'),
	(170,'uig','ug','Uighur; Uyghur'),
	(171,'ukr','uk','Ukrainian'),
	(172,'urd','ur','Urdu'),
	(173,'uzb','uz','Uzbek'),
	(174,'ven','ve','Venda'),
	(175,'vie','vi','Vietnamese'),
	(176,'vol','vo','Volapük'),
	(177,'wel','cy','Welsh'),
	(178,'wln','wa','Walloon'),
	(179,'wol','wo','Wolof'),
	(180,'xho','xh','Xhosa'),
	(181,'yid','yi','Yiddish'),
	(182,'yor','yo','Yoruba'),
	(183,'zha','za','Zhuang; Chuang'),
	(184,'zul','zu','Zulu');

/*!40000 ALTER TABLE `sys_locale` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sys_logging
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_logging`;

CREATE TABLE `sys_logging` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `website_id` int(11) DEFAULT NULL,
  `content_type` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `notes` longtext,
  `ac` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `sys_logging` WRITE;
/*!40000 ALTER TABLE `sys_logging` DISABLE KEYS */;

INSERT INTO `sys_logging` (`id`, `user_id`, `fullname`, `user_role`, `status`, `website_id`, `content_type`, `url`, `notes`, `ac`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,'Admin Wawan',1,'Delete',0,'Website','http://laravelcms.test','Admin Wawan has deleted this website : Descotis English',1,'2019-11-10 08:34:51','2019-11-10 08:34:51',NULL),
	(2,1,'Admin Wawan',1,'Update',0,'Website','http://laravelcms.test','Admin Wawan has changed something on this website : The Angkringan',1,'2019-11-10 08:35:09','2019-11-10 08:35:09',NULL),
	(3,1,'Admin Wawan',1,'Create',0,'category_post','http://laravelcms.test/page/blogs/category/uncategories','Admin Wawan has created this page : http://laravelcms.test/page/blogs/category/uncategories',1,'2019-11-10 08:45:31','2019-11-10 08:45:31',NULL);

/*!40000 ALTER TABLE `sys_logging` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sys_members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_members`;

CREATE TABLE `sys_members` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `address` text,
  `gender` varchar(20) DEFAULT NULL,
  `password` text,
  `remember_token` text,
  `avatar` text,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_other_setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_other_setting`;

CREATE TABLE `sys_other_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `logo` text,
  `google_analytics` longtext,
  `facebook_pixel` longtext,
  `google_map_api_key` longtext,
  `mailchimp_api_key` longtext,
  `about` longtext,
  `termcondotion` longtext,
  `privacypolicy` longtext,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_recipe
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_recipe`;

CREATE TABLE `sys_recipe` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `recipe_name` varchar(200) DEFAULT NULL,
  `recipe_category` int(11) DEFAULT NULL,
  `description` longtext,
  `image` text,
  `gallery` text,
  `video` text,
  `inggridients` longtext,
  `cookmethd` longtext,
  `notes` longtext,
  `province` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `whislist` int(11) DEFAULT NULL,
  `share` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_reviews
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_reviews`;

CREATE TABLE `sys_reviews` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` longtext,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_settings`;

CREATE TABLE `sys_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `website_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL DEFAULT '',
  `value` longtext NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`website_id`,`key`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `sys_settings` WRITE;
/*!40000 ALTER TABLE `sys_settings` DISABLE KEYS */;

INSERT INTO `sys_settings` (`id`, `website_id`, `key`, `value`, `active`, `created_at`, `updated_at`)
VALUES
	(1,0,'base_url','http://descotiswebsite.test','1','2016-11-25 12:38:50','2019-08-27 10:27:36'),
	(5,0,'website_title','Descotis Website','1','2016-11-25 13:39:22','2019-10-21 09:41:18'),
	(9,0,'timezone','Asia/Makassar','1','2016-11-25 13:39:22',NULL),
	(11,0,'start_of_week','1','1','2016-11-25 13:39:22',NULL),
	(14,0,'country','ID','1','2017-05-18 16:13:20',NULL),
	(15,0,'contact_email','info@descotis.com','1','2017-05-18 16:13:20','2019-10-21 09:41:35'),
	(16,0,'phone','+62 361 419 288','1','2017-05-18 18:13:39','2018-02-19 01:12:47'),
	(17,0,'postal_code','80361','1','2017-05-18 18:13:39','2018-03-29 20:44:41'),
	(18,0,'address','Jalan Batu Sangian VI No.10 Kuta Utara, Bali ','1','2017-05-18 18:13:39','2018-03-29 20:40:00'),
	(21,0,'tagline','Descotis','1','2017-05-18 18:13:39','2019-08-27 10:51:06'),
	(22,0,'meta_description','Descotis','1','2017-05-18 18:13:39','2019-08-27 10:51:06'),
	(23,0,'meta_keyword','descotis,hammock','1','2017-05-18 18:13:39','2019-10-21 09:41:57'),
	(26,0,'content_settings','{\"example\":{\"module_id\":\"content_example\",\"module_name\":\"example\",\"module_action\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"create\",\"edit\":\"edit\",\"update\":\"edit\",\"delete\":\"delete\"},\"template\":\"default\",\"instruction\":\"Creating an example takes quite a few steps. Fill out the content below to present users relevant information of our website.\",\"field_container\":[{\"type\":\"custom\",\"label\":\"Data fields\",\"default_display\":\"show\",\"field\":[{\"type\":\"heading\",\"label\":\"text type\"},{\"type\":\"text\",\"id\":\"text_1\",\"name\":\"text_1\",\"label\":\"text 1\",\"placeholder\":\"Text required\",\"message_error\":{\"required\":\"Text 1 Required\"},\"required\":\"yes\",\"width\":\"12\"},{\"type\":\"text\",\"id\":\"text_2\",\"name\":\"text_2\",\"label\":\"text 2\",\"placeholder\":\"Text required & Min 5 chars\",\"message_error\":{\"required\":\"Text 2 Required\",\"minlength\":\"Min 5 characters\"},\"required\":\"yes\",\"minlength\":\"5\",\"width\":\"12\"},{\"type\":\"text\",\"id\":\"text_3\",\"name\":\"text_3\",\"label\":\"text 3\",\"placeholder\":\"Text required & Max 7 chars\",\"message_error\":{\"required\":\"Text 3 Required\",\"maxlength\":\"Max 7 characters\"},\"required\":\"yes\",\"maxlength\":\"7\",\"width\":\"12\"},{\"type\":\"text\",\"id\":\"text_4\",\"name\":\"text_4\",\"label\":\"text 4\",\"placeholder\":\"Min 5 characters & Max 7 chars\",\"message_error\":{\"minlength\":\"Min 5 characters\",\"maxlength\":\"Max 7 characters\"},\"required\":\"no\",\"minlength\":\"5\",\"maxlength\":\"7\",\"width\":\"12\"}]},{\"type\":\"custom\",\"label\":\"additional data\",\"default_display\":\"hide\",\"field\":[{\"type\":\"group\",\"id\":\"testimonial\",\"label\":\"testimonials\",\"repeatable\":\"yes\",\"field\":[{\"type\":\"text\",\"id\":\"name\",\"name\":\"name\",\"label\":\"name\",\"placeholder\":\"Enter customer name\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"6\"},{\"type\":\"text\",\"id\":\"city\",\"name\":\"city\",\"label\":\"city\",\"placeholder\":\"Enter customer city\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"6\"},{\"type\":\"textarea\",\"id\":\"testimonial\",\"name\":\"testimonial\",\"label\":\"testimonial\",\"placeholder\":\"customer testimonial\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"12\"},{\"type\":\"avatar\",\"id\":\"picture\",\"name\":\"picture\",\"label\":\"picture\",\"placeholder\":\"\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"12\"}]}]},{\"type\":\"media\",\"label\":\"media\",\"default_display\":\"show\",\"feature\":[\"image\",\"gallery\",\"video\"]},{\"type\":\"seo\",\"label\":\"search engine optimization\",\"default_display\":\"hide\",\"feature\":[\"keywords\",\"advanced\"]}]},\"page\":{\"module_id\":\"content_page\",\"module_name\":\"page\",\"module_action\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"create\",\"edit\":\"edit\",\"update\":\"edit\",\"delete\":\"delete\"},\"template\":\"default\",\"instruction\":\"Creating a page takes quite a few steps. Fill out the page\'s content below to present users relevant information of our website.\",\"field_container\":[{\"type\":\"custom\",\"label\":\"general\",\"default_display\":\"show\",\"field\":[{\"type\":\"text\",\"id\":\"title\",\"name\":\"title\",\"label\":\"page title\",\"placeholder\":\"Enter page title here\",\"message_error\":\"page title required\",\"required\":\"yes\",\"width\":\"12\"},{\"type\":\"textarea\",\"id\":\"excerpt\",\"name\":\"excerpt\",\"label\":\"short description\",\"placeholder\":\"content short description\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"12\",\"row\":\"2\"},{\"type\":\"editor\",\"id\":\"content\",\"name\":\"content\",\"label\":\"content\",\"placeholder\":\"\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"12\"},{\"type\":\"text\",\"id\":\"field1\",\"name\":\"field1\",\"label\":\"field 1\",\"placeholder\":\"\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"4\"},{\"type\":\"text\",\"id\":\"field2\",\"name\":\"field2\",\"label\":\"field 2\",\"placeholder\":\"\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"4\"},{\"type\":\"text\",\"id\":\"field3\",\"name\":\"field3\",\"label\":\"field 3\",\"placeholder\":\"\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"4\"}]},{\"type\":\"media\",\"label\":\"media\",\"default_display\":\"show\",\"feature\":[\"image\",\"gallery\",\"video\"]},{\"type\":\"seo\",\"label\":\"search engine optimization\",\"default_display\":\"hide\",\"feature\":[\"keywords\",\"advanced\"]},{\"type\":\"custom\",\"label\":\"additional data\",\"default_display\":\"hide\",\"field\":[{\"type\":\"group\",\"id\":\"testimonial\",\"label\":\"testimonials\",\"repeatable\":\"yes\",\"field\":[{\"type\":\"text\",\"id\":\"name\",\"name\":\"name\",\"label\":\"name\",\"placeholder\":\"Enter customer name\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"6\"},{\"type\":\"text\",\"id\":\"city\",\"name\":\"city\",\"label\":\"city\",\"placeholder\":\"Enter customer city\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"6\"},{\"type\":\"textarea\",\"id\":\"testimonial\",\"name\":\"testimonial\",\"label\":\"testimonial\",\"placeholder\":\"customer testimonial\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"12\"},{\"type\":\"avatar\",\"id\":\"picture\",\"name\":\"picture\",\"label\":\"picture\",\"placeholder\":\"\",\"message_error\":\"\",\"required\":\"no\",\"width\":\"12\"}]}]}]},\"post\":{\"module_id\":\"content_post\",\"module_name\":{\"en\":\"post\",\"fr\":\"post\"},\"module_action\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"create\",\"edit\":\"edit\",\"update\":\"edit\",\"delete\":\"delete\"}}}','1','2017-09-14 06:45:16',NULL),
	(27,0,'menu_sidebar','{\"key\":\"sidebar\",\"name\":\"Sidebar Menu\",\"title\":\"Menu\",\"tree\":\"{\\\"expanded\\\":true,\\\"key\\\":\\\"root_1\\\",\\\"title\\\":\\\"root\\\",\\\"children\\\":[{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Home\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/siam.dev\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_2\\\",\\\"title\\\":\\\"Courses\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/siam.dev\\/courses\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_3\\\",\\\"title\\\":\\\"Academies\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/siam.dev\\/academy\\\",\\\"type\\\":\\\"custom\\\"}}]}\"}','1','2017-10-10 01:53:01','2017-10-10 01:18:35'),
	(28,0,'menu_footer_1','{\"key\":\"footer_1\",\"name\":\"Footer 1 Menu\",\"title\":\"Site Map\",\"tree\":\"{\\\"expanded\\\":true,\\\"key\\\":\\\"root_2\\\",\\\"title\\\":\\\"root\\\",\\\"children\\\":[{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"F.A.Q\\\",\\\"data\\\":{\\\"id\\\":\\\"28\\\",\\\"url\\\":\\\"faq\\\",\\\"type\\\":\\\"page\\\"}},{\\\"key\\\":\\\"_2\\\",\\\"title\\\":\\\"Terms & Conditions\\\",\\\"data\\\":{\\\"id\\\":\\\"1\\\",\\\"url\\\":\\\"terms-conditions\\\",\\\"type\\\":\\\"page\\\"}}]}\"}','1','2017-10-10 01:54:59','2017-11-19 23:39:17'),
	(29,0,'menu_footer_2','{\"key\":\"footer_2\",\"name\":\"Footer 2 Menu\",\"title\":\"Menu Footer\",\"tree\":\"{\\\"expanded\\\":true,\\\"key\\\":\\\"root_3\\\",\\\"title\\\":\\\"root\\\",\\\"children\\\":[{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Terms & Conditions\\\",\\\"data\\\":{\\\"id\\\":\\\"1\\\",\\\"url\\\":\\\"terms-conditions\\\",\\\"type\\\":\\\"page\\\"}},{\\\"key\\\":\\\"_2\\\",\\\"title\\\":\\\"F.A.Q\\\",\\\"data\\\":{\\\"id\\\":\\\"28\\\",\\\"url\\\":\\\"faq\\\",\\\"type\\\":\\\"page\\\"}},{\\\"key\\\":\\\"_3\\\",\\\"title\\\":\\\"asda\\\",\\\"data\\\":{\\\"id\\\":\\\"23\\\",\\\"url\\\":\\\"asda\\\",\\\"type\\\":\\\"post\\\"}},{\\\"key\\\":\\\"_4\\\",\\\"title\\\":\\\"Google\\\",\\\"data\\\":{\\\"url\\\":\\\"https:\\/\\/www.google.com\\\",\\\"type\\\":\\\"custom\\\"}}]}\"}','1','2017-10-10 01:58:00','2017-11-19 23:39:32'),
	(30,0,'menu','[{\"key\":\"menu_1\",\"name\":\"Header Menu\",\"title\":\"Menu\",\"tree\":\"{\\\"expanded\\\":true,\\\"key\\\":\\\"root_1\\\",\\\"title\\\":\\\"root\\\",\\\"children\\\":[{\\\"expanded\\\":true,\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Collection\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/collection\\\",\\\"type\\\":\\\"custom\\\"},\\\"children\\\":[{\\\"expanded\\\":false,\\\"key\\\":\\\"_5\\\",\\\"title\\\":\\\"Chandra Hammock\\\",\\\"data\\\":{\\\"url\\\":\\\"#\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"http:\\/\\/descotiswebsite.test\\/media\\/upload\\/source\\/MenuNav\\/CHANDRA%20520%20Ds520C4545%20TERRACOTA%20ORANGE%20PACKSHOT%20STUDIO%20OPENED%2005-2019.png\\\",\\\"shortdesc\\\":\\\"Find Out More Chandra Hammock Here!\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Hanging Chair\\\",\\\"data\\\":{\\\"url\\\":\\\"#\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"http:\\/\\/descotiswebsite.test\\/media\\/upload\\/source\\/MenuNav\\/DsHC45%20DESCOTIS%20HANGING%20CHAIR%20TERRACOTTA%20ORANGE%20PACKSHOT_smile.png\\\",\\\"shortdesc\\\":\\\"Find Out More Hanging Chair Here!\\\"}},{\\\"key\\\":\\\"_2\\\",\\\"title\\\":\\\"Swag Bag\\\",\\\"data\\\":{\\\"url\\\":\\\"#\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"http:\\/\\/descotiswebsite.test\\/media\\/upload\\/source\\/MenuNav\\/DsSW23452%20DESCOTIS%20SWAG%20BAG%20SPARKLING%20GOLD%20TERRACOTTA%20ORANGE%20PACKSHOT%20OPEN%231.png\\\",\\\"shortdesc\\\":\\\"Find Out More Swag Bag Here!\\\"}},{\\\"key\\\":\\\"_3\\\",\\\"title\\\":\\\"Pillow\\\",\\\"data\\\":{\\\"url\\\":\\\"#\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"http:\\/\\/descotiswebsite.test\\/media\\/upload\\/source\\/MenuNav\\/CHANDRA%20520%20Ds520C4545%20TERRACOTA%20ORANGE%20PACKSHOT%20STUDIO%20OPENED%2005-2019.png\\\",\\\"shortdesc\\\":\\\"Find Out More Pilow Here!\\\"}}]},{\\\"key\\\":\\\"_2\\\",\\\"title\\\":\\\"Discovery\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/discovery\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Material\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/material\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_2\\\",\\\"title\\\":\\\"Gallery\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/gallery\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"shortdesc\\\":\\\"\\\"}},{\\\"key\\\":\\\"_3\\\",\\\"title\\\":\\\"Blog\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/blogs\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"shortdesc\\\":\\\"\\\"}},{\\\"key\\\":\\\"_4\\\",\\\"title\\\":\\\"Contact\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/contact-us\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"shortdesc\\\":\\\"\\\"}}]}\"},{\"key\":\"menu_2\",\"name\":\"Footer 1 Menu\",\"title\":\"DESCOTIS\",\"tree\":\"{\\\"expanded\\\":true,\\\"key\\\":\\\"root_2\\\",\\\"title\\\":\\\"root\\\",\\\"children\\\":[{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Discover Descotis\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/discovery\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Our Collection\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/collection\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Customize & Shop\\\",\\\"data\\\":{\\\"url\\\":\\\"#\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"shortdesc\\\":\\\"\\\"}},{\\\"expanded\\\":false,\\\"key\\\":\\\"_3\\\",\\\"title\\\":\\\"Our Store\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/our-stores\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"shortdesc\\\":\\\"\\\"}},{\\\"key\\\":\\\"_2\\\",\\\"title\\\":\\\"Sitemap\\\",\\\"data\\\":{\\\"url\\\":\\\"#\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"shortdesc\\\":\\\"\\\"}}]}\"},{\"key\":\"menu_3\",\"name\":\"Footer 2 Menu\",\"title\":\"INFORMATION\",\"tree\":\"{\\\"expanded\\\":true,\\\"key\\\":\\\"root_3\\\",\\\"title\\\":\\\"root\\\",\\\"children\\\":[{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"FAQ\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/faq-find-an-answer\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Privacy Policy\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/privacy-policy\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Warranty\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/warranty\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"GDPR Privacy Policy\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/gdpr-privacy-policy\\\",\\\"type\\\":\\\"custom\\\"}}]}\"},{\"key\":\"menu_4\",\"name\":\"Footer 3 Menu\",\"title\":\"SERVICE\",\"tree\":\"{\\\"expanded\\\":true,\\\"key\\\":\\\"root_4\\\",\\\"title\\\":\\\"root\\\",\\\"children\\\":[{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Affiliate Program\\\",\\\"data\\\":{\\\"url\\\":\\\"#\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Shopping Cart\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/cart\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"shortdesc\\\":\\\"\\\"}},{\\\"expanded\\\":false,\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Contact Us\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/descotiswebsite.test\\/page\\/contact-us\\\",\\\"type\\\":\\\"custom\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"shortdesc\\\":\\\"\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Tracking Order\\\",\\\"data\\\":{\\\"id\\\":\\\"70\\\",\\\"url\\\":\\\"tracking-order\\\",\\\"type\\\":\\\"page\\\",\\\"icons\\\":\\\"\\\",\\\"image\\\":\\\"\\\",\\\"shortdesc\\\":\\\"\\\"}}]}\"},{\"key\":\"menu_5\",\"name\":\"Header Top Menu\",\"title\":\"Top Nav\",\"tree\":\"{\\\"expanded\\\":true,\\\"key\\\":\\\"root_5\\\",\\\"title\\\":\\\"root\\\",\\\"children\\\":[{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Free shipping on orders from 150 \\u20ac\\\",\\\"data\\\":{\\\"url\\\":\\\"http:\\/\\/\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\" Find a Distributor\\\",\\\"data\\\":{\\\"url\\\":\\\"\\/distributor-location\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_2\\\",\\\"title\\\":\\\" Find a Store\\\",\\\"data\\\":{\\\"url\\\":\\\"\\/store-location\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_3\\\",\\\"title\\\":\\\"Contact Us\\\",\\\"data\\\":{\\\"id\\\":\\\"16\\\",\\\"url\\\":\\\"contact-us\\\",\\\"type\\\":\\\"page\\\"}},{\\\"key\\\":\\\"_4\\\",\\\"title\\\":\\\" Login \\/ Register\\\",\\\"data\\\":{\\\"url\\\":\\\"https:\\/\\/www.ticketothemoon.com\\\",\\\"type\\\":\\\"custom\\\"}},{\\\"key\\\":\\\"_1\\\",\\\"title\\\":\\\"Blogs\\\",\\\"data\\\":{\\\"id\\\":\\\"97\\\",\\\"url\\\":\\\"blogs\\\",\\\"type\\\":\\\"page\\\"}}]}\"}]','1','2017-12-08 16:48:23','2019-10-28 11:38:01'),
	(31,0,'slug_prefix','{\"page\":\"page\",\"product\":\"product\",\"blog\":\"\",\"category_post\":\"page\",\"post\":\"\"}','1','2017-12-08 16:48:23',NULL);

/*!40000 ALTER TABLE `sys_settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sys_slider
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_slider`;

CREATE TABLE `sys_slider` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` bigint(20) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `content` longtext,
  `publish_time` timestamp NULL DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_slider_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_slider_data`;

CREATE TABLE `sys_slider_data` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` bigint(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `data_key` text NOT NULL,
  `data_value` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_sosmed
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_sosmed`;

CREATE TABLE `sys_sosmed` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` int(11) DEFAULT NULL,
  `website_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `url` text,
  `icon` text,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_timezone
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_timezone`;

CREATE TABLE `sys_timezone` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `country_code` char(2) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `zone_name` varchar(35) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_country_code` (`country_code`),
  KEY `idx_zone_name` (`zone_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

LOCK TABLES `sys_timezone` WRITE;
/*!40000 ALTER TABLE `sys_timezone` DISABLE KEYS */;

INSERT INTO `sys_timezone` (`id`, `country_code`, `zone_name`)
VALUES
	(1,'AD','Europe/Andorra'),
	(2,'AE','Asia/Dubai'),
	(3,'AF','Asia/Kabul'),
	(4,'AG','America/Antigua'),
	(5,'AI','America/Anguilla'),
	(6,'AL','Europe/Tirane'),
	(7,'AM','Asia/Yerevan'),
	(8,'AO','Africa/Luanda'),
	(9,'AQ','Antarctica/McMurdo'),
	(10,'AQ','Antarctica/Casey'),
	(11,'AQ','Antarctica/Davis'),
	(12,'AQ','Antarctica/DumontDUrville'),
	(13,'AQ','Antarctica/Mawson'),
	(14,'AQ','Antarctica/Palmer'),
	(15,'AQ','Antarctica/Rothera'),
	(16,'AQ','Antarctica/Syowa'),
	(17,'AQ','Antarctica/Troll'),
	(18,'AQ','Antarctica/Vostok'),
	(19,'AR','America/Argentina/Buenos_Aires'),
	(20,'AR','America/Argentina/Cordoba'),
	(21,'AR','America/Argentina/Salta'),
	(22,'AR','America/Argentina/Jujuy'),
	(23,'AR','America/Argentina/Tucuman'),
	(24,'AR','America/Argentina/Catamarca'),
	(25,'AR','America/Argentina/La_Rioja'),
	(26,'AR','America/Argentina/San_Juan'),
	(27,'AR','America/Argentina/Mendoza'),
	(28,'AR','America/Argentina/San_Luis'),
	(29,'AR','America/Argentina/Rio_Gallegos'),
	(30,'AR','America/Argentina/Ushuaia'),
	(31,'AS','Pacific/Pago_Pago'),
	(32,'AT','Europe/Vienna'),
	(33,'AU','Australia/Lord_Howe'),
	(34,'AU','Antarctica/Macquarie'),
	(35,'AU','Australia/Hobart'),
	(36,'AU','Australia/Currie'),
	(37,'AU','Australia/Melbourne'),
	(38,'AU','Australia/Sydney'),
	(39,'AU','Australia/Broken_Hill'),
	(40,'AU','Australia/Brisbane'),
	(41,'AU','Australia/Lindeman'),
	(42,'AU','Australia/Adelaide'),
	(43,'AU','Australia/Darwin'),
	(44,'AU','Australia/Perth'),
	(45,'AU','Australia/Eucla'),
	(46,'AW','America/Aruba'),
	(47,'AX','Europe/Mariehamn'),
	(48,'AZ','Asia/Baku'),
	(49,'BA','Europe/Sarajevo'),
	(50,'BB','America/Barbados'),
	(51,'BD','Asia/Dhaka'),
	(52,'BE','Europe/Brussels'),
	(53,'BF','Africa/Ouagadougou'),
	(54,'BG','Europe/Sofia'),
	(55,'BH','Asia/Bahrain'),
	(56,'BI','Africa/Bujumbura'),
	(57,'BJ','Africa/Porto-Novo'),
	(58,'BL','America/St_Barthelemy'),
	(59,'BM','Atlantic/Bermuda'),
	(60,'BN','Asia/Brunei'),
	(61,'BO','America/La_Paz'),
	(62,'BQ','America/Kralendijk'),
	(63,'BR','America/Noronha'),
	(64,'BR','America/Belem'),
	(65,'BR','America/Fortaleza'),
	(66,'BR','America/Recife'),
	(67,'BR','America/Araguaina'),
	(68,'BR','America/Maceio'),
	(69,'BR','America/Bahia'),
	(70,'BR','America/Sao_Paulo'),
	(71,'BR','America/Campo_Grande'),
	(72,'BR','America/Cuiaba'),
	(73,'BR','America/Santarem'),
	(74,'BR','America/Porto_Velho'),
	(75,'BR','America/Boa_Vista'),
	(76,'BR','America/Manaus'),
	(77,'BR','America/Eirunepe'),
	(78,'BR','America/Rio_Branco'),
	(79,'BS','America/Nassau'),
	(80,'BT','Asia/Thimphu'),
	(81,'BW','Africa/Gaborone'),
	(82,'BY','Europe/Minsk'),
	(83,'BZ','America/Belize'),
	(84,'CA','America/St_Johns'),
	(85,'CA','America/Halifax'),
	(86,'CA','America/Glace_Bay'),
	(87,'CA','America/Moncton'),
	(88,'CA','America/Goose_Bay'),
	(89,'CA','America/Blanc-Sablon'),
	(90,'CA','America/Toronto'),
	(91,'CA','America/Nipigon'),
	(92,'CA','America/Thunder_Bay'),
	(93,'CA','America/Iqaluit'),
	(94,'CA','America/Pangnirtung'),
	(95,'CA','America/Atikokan'),
	(96,'CA','America/Winnipeg'),
	(97,'CA','America/Rainy_River'),
	(98,'CA','America/Resolute'),
	(99,'CA','America/Rankin_Inlet'),
	(100,'CA','America/Regina'),
	(101,'CA','America/Swift_Current'),
	(102,'CA','America/Edmonton'),
	(103,'CA','America/Cambridge_Bay'),
	(104,'CA','America/Yellowknife'),
	(105,'CA','America/Inuvik'),
	(106,'CA','America/Creston'),
	(107,'CA','America/Dawson_Creek'),
	(108,'CA','America/Fort_Nelson'),
	(109,'CA','America/Vancouver'),
	(110,'CA','America/Whitehorse'),
	(111,'CA','America/Dawson'),
	(112,'CC','Indian/Cocos'),
	(113,'CD','Africa/Kinshasa'),
	(114,'CD','Africa/Lubumbashi'),
	(115,'CF','Africa/Bangui'),
	(116,'CG','Africa/Brazzaville'),
	(117,'CH','Europe/Zurich'),
	(118,'CI','Africa/Abidjan'),
	(119,'CK','Pacific/Rarotonga'),
	(120,'CL','America/Santiago'),
	(121,'CL','America/Punta_Arenas'),
	(122,'CL','Pacific/Easter'),
	(123,'CM','Africa/Douala'),
	(124,'CN','Asia/Shanghai'),
	(125,'CN','Asia/Urumqi'),
	(126,'CO','America/Bogota'),
	(127,'CR','America/Costa_Rica'),
	(128,'CU','America/Havana'),
	(129,'CV','Atlantic/Cape_Verde'),
	(130,'CW','America/Curacao'),
	(131,'CX','Indian/Christmas'),
	(132,'CY','Asia/Nicosia'),
	(133,'CY','Asia/Famagusta'),
	(134,'CZ','Europe/Prague'),
	(135,'DE','Europe/Berlin'),
	(136,'DE','Europe/Busingen'),
	(137,'DJ','Africa/Djibouti'),
	(138,'DK','Europe/Copenhagen'),
	(139,'DM','America/Dominica'),
	(140,'DO','America/Santo_Domingo'),
	(141,'DZ','Africa/Algiers'),
	(142,'EC','America/Guayaquil'),
	(143,'EC','Pacific/Galapagos'),
	(144,'EE','Europe/Tallinn'),
	(145,'EG','Africa/Cairo'),
	(146,'EH','Africa/El_Aaiun'),
	(147,'ER','Africa/Asmara'),
	(148,'ES','Europe/Madrid'),
	(149,'ES','Africa/Ceuta'),
	(150,'ES','Atlantic/Canary'),
	(151,'ET','Africa/Addis_Ababa'),
	(152,'FI','Europe/Helsinki'),
	(153,'FJ','Pacific/Fiji'),
	(154,'FK','Atlantic/Stanley'),
	(155,'FM','Pacific/Chuuk'),
	(156,'FM','Pacific/Pohnpei'),
	(157,'FM','Pacific/Kosrae'),
	(158,'FO','Atlantic/Faroe'),
	(159,'FR','Europe/Paris'),
	(160,'GA','Africa/Libreville'),
	(161,'GB','Europe/London'),
	(162,'GD','America/Grenada'),
	(163,'GE','Asia/Tbilisi'),
	(164,'GF','America/Cayenne'),
	(165,'GG','Europe/Guernsey'),
	(166,'GH','Africa/Accra'),
	(167,'GI','Europe/Gibraltar'),
	(168,'GL','America/Godthab'),
	(169,'GL','America/Danmarkshavn'),
	(170,'GL','America/Scoresbysund'),
	(171,'GL','America/Thule'),
	(172,'GM','Africa/Banjul'),
	(173,'GN','Africa/Conakry'),
	(174,'GP','America/Guadeloupe'),
	(175,'GQ','Africa/Malabo'),
	(176,'GR','Europe/Athens'),
	(177,'GS','Atlantic/South_Georgia'),
	(178,'GT','America/Guatemala'),
	(179,'GU','Pacific/Guam'),
	(180,'GW','Africa/Bissau'),
	(181,'GY','America/Guyana'),
	(182,'HK','Asia/Hong_Kong'),
	(183,'HN','America/Tegucigalpa'),
	(184,'HR','Europe/Zagreb'),
	(185,'HT','America/Port-au-Prince'),
	(186,'HU','Europe/Budapest'),
	(187,'ID','Asia/Jakarta'),
	(188,'ID','Asia/Pontianak'),
	(189,'ID','Asia/Makassar'),
	(190,'ID','Asia/Jayapura'),
	(191,'IE','Europe/Dublin'),
	(192,'IL','Asia/Jerusalem'),
	(193,'IM','Europe/Isle_of_Man'),
	(194,'IN','Asia/Kolkata'),
	(195,'IO','Indian/Chagos'),
	(196,'IQ','Asia/Baghdad'),
	(197,'IR','Asia/Tehran'),
	(198,'IS','Atlantic/Reykjavik'),
	(199,'IT','Europe/Rome'),
	(200,'JE','Europe/Jersey'),
	(201,'JM','America/Jamaica'),
	(202,'JO','Asia/Amman'),
	(203,'JP','Asia/Tokyo'),
	(204,'KE','Africa/Nairobi'),
	(205,'KG','Asia/Bishkek'),
	(206,'KH','Asia/Phnom_Penh'),
	(207,'KI','Pacific/Tarawa'),
	(208,'KI','Pacific/Enderbury'),
	(209,'KI','Pacific/Kiritimati'),
	(210,'KM','Indian/Comoro'),
	(211,'KN','America/St_Kitts'),
	(212,'KP','Asia/Pyongyang'),
	(213,'KR','Asia/Seoul'),
	(214,'KW','Asia/Kuwait'),
	(215,'KY','America/Cayman'),
	(216,'KZ','Asia/Almaty'),
	(217,'KZ','Asia/Qyzylorda'),
	(218,'KZ','Asia/Aqtobe'),
	(219,'KZ','Asia/Aqtau'),
	(220,'KZ','Asia/Atyrau'),
	(221,'KZ','Asia/Oral'),
	(222,'LA','Asia/Vientiane'),
	(223,'LB','Asia/Beirut'),
	(224,'LC','America/St_Lucia'),
	(225,'LI','Europe/Vaduz'),
	(226,'LK','Asia/Colombo'),
	(227,'LR','Africa/Monrovia'),
	(228,'LS','Africa/Maseru'),
	(229,'LT','Europe/Vilnius'),
	(230,'LU','Europe/Luxembourg'),
	(231,'LV','Europe/Riga'),
	(232,'LY','Africa/Tripoli'),
	(233,'MA','Africa/Casablanca'),
	(234,'MC','Europe/Monaco'),
	(235,'MD','Europe/Chisinau'),
	(236,'ME','Europe/Podgorica'),
	(237,'MF','America/Marigot'),
	(238,'MG','Indian/Antananarivo'),
	(239,'MH','Pacific/Majuro'),
	(240,'MH','Pacific/Kwajalein'),
	(241,'MK','Europe/Skopje'),
	(242,'ML','Africa/Bamako'),
	(243,'MM','Asia/Yangon'),
	(244,'MN','Asia/Ulaanbaatar'),
	(245,'MN','Asia/Hovd'),
	(246,'MN','Asia/Choibalsan'),
	(247,'MO','Asia/Macau'),
	(248,'MP','Pacific/Saipan'),
	(249,'MQ','America/Martinique'),
	(250,'MR','Africa/Nouakchott'),
	(251,'MS','America/Montserrat'),
	(252,'MT','Europe/Malta'),
	(253,'MU','Indian/Mauritius'),
	(254,'MV','Indian/Maldives'),
	(255,'MW','Africa/Blantyre'),
	(256,'MX','America/Mexico_City'),
	(257,'MX','America/Cancun'),
	(258,'MX','America/Merida'),
	(259,'MX','America/Monterrey'),
	(260,'MX','America/Matamoros'),
	(261,'MX','America/Mazatlan'),
	(262,'MX','America/Chihuahua'),
	(263,'MX','America/Ojinaga'),
	(264,'MX','America/Hermosillo'),
	(265,'MX','America/Tijuana'),
	(266,'MX','America/Bahia_Banderas'),
	(267,'MY','Asia/Kuala_Lumpur'),
	(268,'MY','Asia/Kuching'),
	(269,'MZ','Africa/Maputo'),
	(270,'NA','Africa/Windhoek'),
	(271,'NC','Pacific/Noumea'),
	(272,'NE','Africa/Niamey'),
	(273,'NF','Pacific/Norfolk'),
	(274,'NG','Africa/Lagos'),
	(275,'NI','America/Managua'),
	(276,'NL','Europe/Amsterdam'),
	(277,'NO','Europe/Oslo'),
	(278,'NP','Asia/Kathmandu'),
	(279,'NR','Pacific/Nauru'),
	(280,'NU','Pacific/Niue'),
	(281,'NZ','Pacific/Auckland'),
	(282,'NZ','Pacific/Chatham'),
	(283,'OM','Asia/Muscat'),
	(284,'PA','America/Panama'),
	(285,'PE','America/Lima'),
	(286,'PF','Pacific/Tahiti'),
	(287,'PF','Pacific/Marquesas'),
	(288,'PF','Pacific/Gambier'),
	(289,'PG','Pacific/Port_Moresby'),
	(290,'PG','Pacific/Bougainville'),
	(291,'PH','Asia/Manila'),
	(292,'PK','Asia/Karachi'),
	(293,'PL','Europe/Warsaw'),
	(294,'PM','America/Miquelon'),
	(295,'PN','Pacific/Pitcairn'),
	(296,'PR','America/Puerto_Rico'),
	(297,'PS','Asia/Gaza'),
	(298,'PS','Asia/Hebron'),
	(299,'PT','Europe/Lisbon'),
	(300,'PT','Atlantic/Madeira'),
	(301,'PT','Atlantic/Azores'),
	(302,'PW','Pacific/Palau'),
	(303,'PY','America/Asuncion'),
	(304,'QA','Asia/Qatar'),
	(305,'RE','Indian/Reunion'),
	(306,'RO','Europe/Bucharest'),
	(307,'RS','Europe/Belgrade'),
	(308,'RU','Europe/Kaliningrad'),
	(309,'RU','Europe/Moscow'),
	(310,'RU','Europe/Simferopol'),
	(311,'RU','Europe/Volgograd'),
	(312,'RU','Europe/Kirov'),
	(313,'RU','Europe/Astrakhan'),
	(314,'RU','Europe/Saratov'),
	(315,'RU','Europe/Ulyanovsk'),
	(316,'RU','Europe/Samara'),
	(317,'RU','Asia/Yekaterinburg'),
	(318,'RU','Asia/Omsk'),
	(319,'RU','Asia/Novosibirsk'),
	(320,'RU','Asia/Barnaul'),
	(321,'RU','Asia/Tomsk'),
	(322,'RU','Asia/Novokuznetsk'),
	(323,'RU','Asia/Krasnoyarsk'),
	(324,'RU','Asia/Irkutsk'),
	(325,'RU','Asia/Chita'),
	(326,'RU','Asia/Yakutsk'),
	(327,'RU','Asia/Khandyga'),
	(328,'RU','Asia/Vladivostok'),
	(329,'RU','Asia/Ust-Nera'),
	(330,'RU','Asia/Magadan'),
	(331,'RU','Asia/Sakhalin'),
	(332,'RU','Asia/Srednekolymsk'),
	(333,'RU','Asia/Kamchatka'),
	(334,'RU','Asia/Anadyr'),
	(335,'RW','Africa/Kigali'),
	(336,'SA','Asia/Riyadh'),
	(337,'SB','Pacific/Guadalcanal'),
	(338,'SC','Indian/Mahe'),
	(339,'SD','Africa/Khartoum'),
	(340,'SE','Europe/Stockholm'),
	(341,'SG','Asia/Singapore'),
	(342,'SH','Atlantic/St_Helena'),
	(343,'SI','Europe/Ljubljana'),
	(344,'SJ','Arctic/Longyearbyen'),
	(345,'SK','Europe/Bratislava'),
	(346,'SL','Africa/Freetown'),
	(347,'SM','Europe/San_Marino'),
	(348,'SN','Africa/Dakar'),
	(349,'SO','Africa/Mogadishu'),
	(350,'SR','America/Paramaribo'),
	(351,'SS','Africa/Juba'),
	(352,'ST','Africa/Sao_Tome'),
	(353,'SV','America/El_Salvador'),
	(354,'SX','America/Lower_Princes'),
	(355,'SY','Asia/Damascus'),
	(356,'SZ','Africa/Mbabane'),
	(357,'TC','America/Grand_Turk'),
	(358,'TD','Africa/Ndjamena'),
	(359,'TF','Indian/Kerguelen'),
	(360,'TG','Africa/Lome'),
	(361,'TH','Asia/Bangkok'),
	(362,'TJ','Asia/Dushanbe'),
	(363,'TK','Pacific/Fakaofo'),
	(364,'TL','Asia/Dili'),
	(365,'TM','Asia/Ashgabat'),
	(366,'TN','Africa/Tunis'),
	(367,'TO','Pacific/Tongatapu'),
	(368,'TR','Europe/Istanbul'),
	(369,'TT','America/Port_of_Spain'),
	(370,'TV','Pacific/Funafuti'),
	(371,'TW','Asia/Taipei'),
	(372,'TZ','Africa/Dar_es_Salaam'),
	(373,'UA','Europe/Kiev'),
	(374,'UA','Europe/Uzhgorod'),
	(375,'UA','Europe/Zaporozhye'),
	(376,'UG','Africa/Kampala'),
	(377,'UM','Pacific/Midway'),
	(378,'UM','Pacific/Wake'),
	(379,'US','America/New_York'),
	(380,'US','America/Detroit'),
	(381,'US','America/Kentucky/Louisville'),
	(382,'US','America/Kentucky/Monticello'),
	(383,'US','America/Indiana/Indianapolis'),
	(384,'US','America/Indiana/Vincennes'),
	(385,'US','America/Indiana/Winamac'),
	(386,'US','America/Indiana/Marengo'),
	(387,'US','America/Indiana/Petersburg'),
	(388,'US','America/Indiana/Vevay'),
	(389,'US','America/Chicago'),
	(390,'US','America/Indiana/Tell_City'),
	(391,'US','America/Indiana/Knox'),
	(392,'US','America/Menominee'),
	(393,'US','America/North_Dakota/Center'),
	(394,'US','America/North_Dakota/New_Salem'),
	(395,'US','America/North_Dakota/Beulah'),
	(396,'US','America/Denver'),
	(397,'US','America/Boise'),
	(398,'US','America/Phoenix'),
	(399,'US','America/Los_Angeles'),
	(400,'US','America/Anchorage'),
	(401,'US','America/Juneau'),
	(402,'US','America/Sitka'),
	(403,'US','America/Metlakatla'),
	(404,'US','America/Yakutat'),
	(405,'US','America/Nome'),
	(406,'US','America/Adak'),
	(407,'US','Pacific/Honolulu'),
	(408,'UY','America/Montevideo'),
	(409,'UZ','Asia/Samarkand'),
	(410,'UZ','Asia/Tashkent'),
	(411,'VA','Europe/Vatican'),
	(412,'VC','America/St_Vincent'),
	(413,'VE','America/Caracas'),
	(414,'VG','America/Tortola'),
	(415,'VI','America/St_Thomas'),
	(416,'VN','Asia/Ho_Chi_Minh'),
	(417,'VU','Pacific/Efate'),
	(418,'WF','Pacific/Wallis'),
	(419,'WS','Pacific/Apia'),
	(420,'YE','Asia/Aden'),
	(421,'YT','Indian/Mayotte'),
	(422,'ZA','Africa/Johannesburg'),
	(423,'ZM','Africa/Lusaka'),
	(424,'ZW','Africa/Harare');

/*!40000 ALTER TABLE `sys_timezone` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sys_user_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_user_data`;

CREATE TABLE `sys_user_data` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) NOT NULL,
  `data_key` text NOT NULL,
  `data_value` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sys_user_privileges
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_user_privileges`;

CREATE TABLE `sys_user_privileges` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `entity` text NOT NULL,
  `privileges` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `sys_user_privileges` WRITE;
/*!40000 ALTER TABLE `sys_user_privileges` DISABLE KEYS */;

INSERT INTO `sys_user_privileges` (`id`, `role_id`, `entity`, `privileges`)
VALUES
	(1,1,'module/xx/index','0'),
	(2,1,'module/yy/index','1'),
	(3,1,'module/zz/index','1'),
	(4,1,'module/page/index','1'),
	(5,1,'module/page/create','1'),
	(6,1,'module/dashboard/index','1'),
	(7,1,'module/zz/create','1'),
	(8,1,'module/blog/post/index','1'),
	(9,1,'module/blog/post/create','1'),
	(10,1,'module/blog/post/edit','1'),
	(11,1,'module/blog/post/delete','1'),
	(12,1,'module/blog/category/index','1'),
	(13,1,'module/blog/category/create','1'),
	(14,1,'module/blog/category/edit','1'),
	(15,1,'module/blog/category/delete','1'),
	(16,1,'module/page/edit','1'),
	(17,1,'module/page/delete','1'),
	(18,1,'module/course/index','1'),
	(19,1,'module/course/create','1'),
	(20,1,'module/course/edit','1'),
	(21,1,'module/course/delete','1'),
	(22,1,'module/setting_general/index','1'),
	(23,1,'module/setting/scope','1'),
	(24,1,'module/setting_general/create','1'),
	(25,1,'module/website/index','1'),
	(26,1,'module/website/create','1'),
	(27,1,'module/website/edit','1'),
	(28,1,'module/user/index','1'),
	(29,1,'module/user/edit','1'),
	(30,1,'module/user/create','1'),
	(31,1,'module/content_page/index','1'),
	(32,1,'module/content_page/create','1'),
	(33,1,'module/content_page/edit','1'),
	(34,1,'module/content_page/delete','1'),
	(35,1,'module/content/index','1'),
	(36,1,'module/content/create','1'),
	(37,1,'module/content/edit','1'),
	(38,1,'module/content/delete','1'),
	(39,1,'module/content_example/index','1'),
	(40,1,'module/content_example/create','1'),
	(41,1,'module/content_example/edit','1'),
	(42,1,'module/content_example/delete','1'),
	(43,1,'module/content_example2/index','1'),
	(44,1,'module/content_example2/create','1'),
	(45,1,'module/content_example2/edit','1'),
	(46,1,'module/content_example2/delete','1'),
	(47,1,'module/menu/index','1'),
	(48,1,'module/menu/create','1'),
	(49,1,'module/menu/edit','1'),
	(50,1,'module/menu/delete','1'),
	(51,1,'module/content_product/index','1'),
	(52,1,'module/content_product/create','1'),
	(53,1,'module/content_product/edit','1'),
	(54,1,'module/content_product/delete','1'),
	(55,1,'module/product/category/index','1'),
	(56,1,'module/poduct/category/create','1'),
	(57,1,'module/product/category/edit','1'),
	(58,1,'module/product/category/delete','1'),
	(59,1,'module/content_product_attribute/index','1'),
	(60,1,'module/content_product_attribute/create','1'),
	(61,1,'module/content_product_attribute/edit','1'),
	(62,1,'module/content_product_attribute/delete','1'),
	(63,1,'module/content_product_variations/index','1'),
	(64,1,'module/content_product_variations/create','1'),
	(65,1,'module/content_product_variations/edit','1'),
	(66,1,'module/content_product_variations/delete','1'),
	(67,1,'module/content_product_attribute_value/index','1'),
	(68,1,'module/content_product_attribute_value/edit','1'),
	(69,1,'module/content_product_attribute_value/create','1'),
	(70,1,'module/content_product_attribute_value/delete','1'),
	(71,1,'module/attribute_set/index','1'),
	(72,1,'module/attribute_set/create','1'),
	(73,1,'module/attribute_set/edit','1'),
	(74,1,'module/attribute_set/delete','1'),
	(75,1,'module/attribute_set/index','1'),
	(76,1,'module/attribute_set/create','1'),
	(77,1,'module/gallery/category/index','1'),
	(78,1,'module/gallery/category/create','1'),
	(79,1,'module/gallery/category/edit','1'),
	(80,1,'module/gallery/category/delete','1'),
	(81,1,'module/content_gallery_images/index','1'),
	(82,1,'module/content_gallery_images/create','1'),
	(83,1,'module/content_gallery_images/edit','1'),
	(84,1,'module/content_gallery_images/delete','1'),
	(85,1,'module/homepage/index','1'),
	(86,1,'module/homepage/slideradd','1'),
	(87,1,'module/homepage/slideredit','1'),
	(88,1,'module/attribute_set/detail','1'),
	(89,1,'module/content_locations/index','1'),
	(90,1,'module/content_locations/create','1'),
	(91,1,'module/content_locations/edit','1'),
	(92,1,'module/content_locations/delete','1'),
	(93,1,'module/content_locations/setting','1'),
	(94,1,'module/related_product/index','1'),
	(95,1,'module/related_product/create','1'),
	(96,1,'module/related_product/edit','1'),
	(97,1,'module/related_product/delete','1'),
	(98,1,'module/related_product/detail','1'),
	(99,1,'module/product_default/index','1'),
	(100,1,'module/product_default/create','1'),
	(101,1,'module/product_default/edit','1'),
	(102,1,'module/product_default/delete','1'),
	(103,1,'module/product_default/detail','1'),
	(104,1,'module/product_default/ajaxsetproduct','1'),
	(105,1,'module/product_default/maincolorset','1'),
	(106,1,'module/product_default/secondcolorset','1'),
	(107,1,'module/product_default/acchookset','1'),
	(108,1,'module/product_default/accsleeveset','1'),
	(109,1,'module/product_coupon/index','1'),
	(110,1,'module/product_coupon/create','1'),
	(111,1,'module/product_coupon/edit','1'),
	(112,1,'module/product_coupon/delete','1'),
	(113,1,'module/product_coupon/detail','1'),
	(114,1,'module/menu/indexlanguage','1'),
	(115,1,'module/category_product/index','1'),
	(116,1,'module/category_product/create','1'),
	(117,1,'module/category_product/edit','1'),
	(118,1,'module/category_product/delete','1'),
	(119,1,'module/sosmed/index','1'),
	(120,1,'module/sosmed/create','1'),
	(121,1,'module/sosmed/edit','1'),
	(122,1,'module/sosmed/delete','1'),
	(124,1,'module/jointribe/index','1'),
	(125,1,'module/jointribe/edit','1'),
	(126,1,'module/jointribe/delete','1'),
	(127,1,'module/content_seo/index','1'),
	(128,1,'module/content_seo/create','1'),
	(129,1,'module/content_seo/edit','1'),
	(130,1,'module/content_seo/delete','1'),
	(131,1,'module/category_post/index','1'),
	(132,1,'module/category_post/create','1'),
	(133,1,'module/category_post/edit','1'),
	(134,1,'module/category_post/delete','1'),
	(135,1,'module/post/index','1'),
	(136,1,'module/post/create','1'),
	(137,1,'module/post/edit','1'),
	(138,1,'module/post/delete','1'),
	(139,1,'module/alfiliate/index','1'),
	(140,1,'module/alfiliate/create','1'),
	(141,1,'module/alfiliate/edit','1'),
	(142,1,'module/alfiliate/delete','1'),
	(143,1,'module/reviews/index','1'),
	(144,1,'module/reviews/edit','1'),
	(145,1,'module/reviews/delete','1'),
	(146,4,'module/dashboard/index','1'),
	(147,4,'module/alfiliate/index','1'),
	(148,4,'module/alfiliate/create','1'),
	(149,4,'module/alfiliate/edit','1'),
	(150,4,'module/alfiliate/delete','1'),
	(151,1,'module/othersetting/index','1'),
	(152,1,'module/othersetting/edit','1'),
	(153,1,'module/dashboard/media','1'),
	(154,1,'module/homepage_slider/index','1'),
	(155,1,'module/homepage_slider/create','1'),
	(156,1,'module/homepage_slider/edit','1'),
	(157,1,'module/homepage_slider/delete','1'),
	(158,1,'module/homepage_content/index','1'),
	(159,1,'module/homepage_content/create','1'),
	(160,1,'module/homepage_content/edit','1'),
	(161,1,'module/homepage_content/delete','1'),
	(162,1,'module/role/index','1'),
	(163,1,'module/role/create','1'),
	(164,1,'module/role/edit','1'),
	(165,1,'module/role/delete','1'),
	(166,1,'module/language/index','1'),
	(167,1,'module/language/create','1'),
	(168,1,'module/language/edit','1'),
	(169,1,'module/language/delete','1'),
	(170,1,'module/language/open','1'),
	(171,1,'module/language/save','1'),
	(172,1,'module/syslog/index','1'),
	(173,1,'module/material_page/index','1'),
	(174,1,'module/material_page/create','1'),
	(175,1,'module/material_page/edit','1'),
	(176,1,'module/material_page/delete','1'),
	(177,1,'module/discovery_page/index','1'),
	(178,1,'module/discovery_page/create','1'),
	(179,1,'module/discovery_page/edit','1'),
	(180,1,'module/discovery_page/delete','1');

/*!40000 ALTER TABLE `sys_user_privileges` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sys_user_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_user_roles`;

CREATE TABLE `sys_user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_users_roles_role_unique` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `sys_user_roles` WRITE;
/*!40000 ALTER TABLE `sys_user_roles` DISABLE KEYS */;

INSERT INTO `sys_user_roles` (`id`, `role`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(0,'Root','2016-09-21 22:22:08',NULL,NULL),
	(1,'Administrator','2016-09-21 22:22:08',NULL,NULL),
	(2,'Author','2016-09-21 22:22:08',NULL,NULL),
	(3,'Operator','2016-09-21 22:22:08',NULL,NULL),
	(4,'Staff','2018-01-12 15:11:53',NULL,NULL);

/*!40000 ALTER TABLE `sys_user_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sys_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_users`;

CREATE TABLE `sys_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telphone` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `type` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_token` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `sys_users` WRITE;
/*!40000 ALTER TABLE `sys_users` DISABLE KEYS */;

INSERT INTO `sys_users` (`id`, `username`, `firstname`, `lastname`, `email`, `telphone`, `password`, `role_id`, `type`, `avatar`, `status`, `remember_token`, `api_token`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Admin Wawan','Admin','Wawan','root@theangkringan.com','082257359698','$2y$12$gY0/pmF5EXtbwHxLZIPVWuTAPCYl3RHiRrJVVBkRFiOVpq5/fM1de',1,'root','picture.jpg','1','bXwFX0PJjYjjTzNHPVnfyiZAxNmsNWfj86s7iov2akKGLqY4CW9GgEVYCTmx','3K9GBE5ksU3K9GBE5ksU','2019-08-27 09:28:35','2019-11-01 16:06:01',NULL);

/*!40000 ALTER TABLE `sys_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sys_websites
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_websites`;

CREATE TABLE `sys_websites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL,
  `locale` char(2) NOT NULL DEFAULT '',
  `enable` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `sys_websites` WRITE;
/*!40000 ALTER TABLE `sys_websites` DISABLE KEYS */;

INSERT INTO `sys_websites` (`id`, `code`, `name`, `locale`, `enable`, `created_at`, `updated_at`)
VALUES
	(0,'EN','The Angkringan','en','1','2019-10-21 09:46:04','2019-11-10 08:35:26');

/*!40000 ALTER TABLE `sys_websites` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sys_whislist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sys_whislist`;

CREATE TABLE `sys_whislist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
