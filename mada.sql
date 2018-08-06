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
  PRIMARY KEY (`id`),
  KEY `IDX_E2E2D1EEB08FA272` (`district_id`),
  CONSTRAINT `FK_E2E2D1EEB08FA272` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `commune` */

insert  into `commune`(`id`,`district_id`,`name`) values (2,13,'Fianarantsoa');

/*Table structure for table `district` */

DROP TABLE IF EXISTS `district`;

CREATE TABLE `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_31C1548798260155` (`region_id`),
  CONSTRAINT `FK_31C1548798260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `district` */

insert  into `district`(`id`,`region_id`,`name`) values (7,6,'Tsiroanomandidy'),(8,4,'Isandra'),(9,4,'Isorana'),(10,4,'Ikalamavony'),(11,4,'Ambalavao'),(12,12,'Antsirabe'),(13,4,'Fianarantsoa'),(14,5,'Antananarivo'),(15,7,'Ambositra');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `promesse` */

insert  into `promesse`(`id`,`name`,`description`,`date`,`region_id`,`province_id`,`district_id`,`etat`) values (12,'Projet RN7','Rehabilitation de la route nationnale numero 7','2017-12-07',4,10,13,1),(13,'Projet garre routière','Construction d\'une garre routière','2017-06-03',5,8,14,0),(14,'Projet maison des jeunes','Consstruction d\'une maison des jeunes','2013-01-01',4,10,13,0),(16,'Construction d\'un stade','Contruction d\'un stade synthétique à ampasambazaha','2016-04-04',4,10,13,1),(17,'Construction Route vers ivato','Construction Route vers ivato','2016-04-04',5,8,14,1),(18,'Rehabilitation tranompokonolona','Rehabilitation tranompokonolona Antampon\'i Vinany','2017-04-04',7,10,15,1);

/*Table structure for table `province` */

DROP TABLE IF EXISTS `province`;

CREATE TABLE `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `province` */

insert  into `province`(`id`,`name`,`zip_code`) values (8,'Antananarivo','00101'),(9,'Antsiranana','00201'),(10,'Fianarantsoa','00301'),(11,'Mahajanga','00401'),(12,'Toamasina','00501'),(13,'Toliara','00601');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `region` */

insert  into `region`(`id`,`province_id`,`name`,`capital`,`slogan`) values (4,10,'Matsiatra ambony','Fianarantsoa','Ny soa Fianatsa ro mahavokatsa'),(5,8,'Analamanga','Antananarivo','....'),(6,8,'Bongolava','Tsiroanomandidy','....'),(7,10,'Amoron\'i Mania','Ambositra','....'),(8,10,'Ihorombe','Ihosy','...'),(9,13,'Androy','Ambovombe','...'),(10,9,'Diana','Antsiranana','...'),(11,12,'Atsinanana','Toamasina','....'),(12,8,'Vakinakaratra','Antsirabe','....');

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
