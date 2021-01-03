/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.17-MariaDB : Database - db_dapen
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_dapen` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_dapen`;

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(225) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `article` */

insert  into `article`(`id`,`type_id`,`name`,`img`,`user_id`,`description`,`created_at`) values 
(3,NULL,'test edit','d42118fcd90f29903c9a864f08803817.jpg',1,'asda                    ','2021-01-03 15:47:03'),
(4,NULL,'test edit','8453655b43bd614c28df4297e12cd42e.jpg',1,'asda                    ','2021-01-03 15:47:43'),
(5,NULL,'asd','e6566918dedc03ee548fa4fef6559eb5.jpg',1,'asda','2021-01-03 15:47:54'),
(6,NULL,'asd','a158dca06e36db404fea18a7ed659a32.jpg',1,'asda','2021-01-03 15:47:59'),
(7,NULL,'asdasd','7454b3e65096d358e240ad1b50ad9f0f.jpg',1,'asdasd','2021-01-04 03:53:29'),
(8,NULL,'test edit','d42118fcd90f29903c9a864f08803817.jpg',1,'asda                    ','2021-01-03 15:47:03');

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`) values 
(1,'admin','Administrator'),
(2,'members','General User');

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id`,`name`) values 
(1,'jabatan'),
(2,'jabatan'),
(3,'asdasdasd'),
(4,'asdaksdh');

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `login_attempts` */

/*Table structure for table `organization_structure` */

DROP TABLE IF EXISTS `organization_structure`;

CREATE TABLE `organization_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text DEFAULT NULL,
  `img` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `jabatan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jabatan_id` (`jabatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `organization_structure` */

insert  into `organization_structure`(`id`,`description`,`img`,`created_at`,`jabatan_id`) values 
(3,'asdasd','34a0e4ecba5f3e4bb7b9faadb8880360.jpg','2021-01-03 17:36:25',NULL),
(4,'keterangan','d4d37e281c6a56f0e91c64413a6ba348.jpg','2021-01-04 00:07:19',NULL),
(5,'asdasd','704a9dfa1e40457c790d1b47d061531f.jpg','2021-01-04 00:13:28',NULL),
(6,'asdasd','e757c1dba747b3bc68c62155dab43a70.jpg','2021-01-04 00:14:17',3);

/*Table structure for table `type` */

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `type` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`email`,`activation_selector`,`activation_code`,`forgotten_password_selector`,`forgotten_password_code`,`forgotten_password_time`,`remember_selector`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) values 
(1,'127.0.0.1','administrator','$2y$12$1qWIxFsUjs2M2rWx8rem2evHH2GyUhDBpWpLLp3GgbxTXVVZXXo5.','admin@admin.com',NULL,'',NULL,NULL,NULL,NULL,NULL,1268889823,1609693486,1,'Admin','istrator','ADMIN','0');

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values 
(1,1,1),
(2,1,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
