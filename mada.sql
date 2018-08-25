/*
SQLyog Community Edition- MySQL GUI v7.02 
MySQL - 5.7.14 : Database - madagascar
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`madagascar` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `madagascar`;

/*Table structure for table `commune` */

DROP TABLE IF EXISTS `commune`;

CREATE TABLE `commune` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rnm` tinyint(1) NOT NULL,
  `tvm` tinyint(1) NOT NULL,
  `population` int(11) NOT NULL,
  `electeurs` int(11) NOT NULL,
  `hvm` tinyint(1) NOT NULL,
  `observation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `freqrnm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E2E2D1EEB08FA272` (`district_id`),
  CONSTRAINT `FK_E2E2D1EEB08FA272` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `commune` */

/*Table structure for table `district` */

DROP TABLE IF EXISTS `district`;

CREATE TABLE `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nb_epp` int(11) DEFAULT NULL,
  `nb_ceg` int(11) DEFAULT NULL,
  `nb_lycee` int(11) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `electeurs` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_31C1548798260155` (`region_id`),
  CONSTRAINT `FK_31C1548798260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `district` */

insert  into `district`(`id`,`region_id`,`name`,`nb_epp`,`nb_ceg`,`nb_lycee`,`population`,`electeurs`) values (18,13,'Ikalamavony',45,68,78,102000,5000);

/*Table structure for table `fokontany` */

DROP TABLE IF EXISTS `fokontany`;

CREATE TABLE `fokontany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commune_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `habitants` int(11) NOT NULL,
  `lecteurs` int(11) NOT NULL,
  `dernier_election` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E9452B46131A4F72` (`commune_id`),
  CONSTRAINT `FK_E9452B46131A4F72` FOREIGN KEY (`commune_id`) REFERENCES `commune` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `fokontany` */

/*Table structure for table `promesse` */

DROP TABLE IF EXISTS `promesse`;

CREATE TABLE `promesse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4900EF5298260155` (`region_id`),
  KEY `IDX_4900EF52E946114A` (`province_id`),
  KEY `IDX_4900EF52B08FA272` (`district_id`),
  CONSTRAINT `FK_4900EF5298260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`),
  CONSTRAINT `FK_4900EF52B08FA272` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `FK_4900EF52E946114A` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `promesse` */

/*Table structure for table `province` */

DROP TABLE IF EXISTS `province`;

CREATE TABLE `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `province` */

insert  into `province`(`id`,`name`,`zip_code`) values (16,'FIANARANTSOA','301');

/*Table structure for table `region` */

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `capital` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slogan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F62F176E946114A` (`province_id`),
  CONSTRAINT `FK_F62F176E946114A` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `region` */

insert  into `region`(`id`,`province_id`,`name`,`capital`,`slogan`) values (13,16,'HAUTE MATSIATRA','FIANARANTSOA','......');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`email`,`name`,`role`,`password`) values (2,'rabe@gmail.com','rabe','ROLE_USER','$2y$13$UJncxv6ADcoAlW36fKSTJetsGUwW2F/PBvADG./DRCVdLuKDLiR6S'),(3,'pasmi@gmail.com','Pasmi','ROLE_USER','$2y$13$baIFQIFrfBx44xlb..TuwOsc3VpY0GyuQp60gmAoxJiIUTJPxvYHW');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
