/*
SQLyog Community v13.3.1 (64 bit)
MySQL - 8.0.30 : Database - db_gmail
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_gmail` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_gmail`;

/*Table structure for table `email_recipients` */

DROP TABLE IF EXISTS `email_recipients`;

CREATE TABLE `email_recipients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email_id` int NOT NULL,
  `recipient_id` int NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email_id` (`email_id`),
  KEY `recipient_id` (`recipient_id`),
  CONSTRAINT `email_recipients_ibfk_1` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`) ON DELETE CASCADE,
  CONSTRAINT `email_recipients_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `email_recipients` */

insert  into `email_recipients`(`id`,`email_id`,`recipient_id`,`is_read`,`is_deleted`) values 
(1,1,1,1,0),
(2,2,1,1,0),
(3,3,1,1,0),
(4,4,1,1,0),
(5,5,1,0,0),
(6,6,1,1,0),
(7,7,1,1,0),
(8,8,1,1,0);

/*Table structure for table `emails` */

DROP TABLE IF EXISTS `emails`;

CREATE TABLE `emails` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `emails` */

insert  into `emails`(`id`,`sender_id`,`subject`,`body`,`created_at`,`is_deleted`) values 
(1,2,'Unpacking from your Steam wishlist is now on sale!','Steam 1 GAME YOU HAVE WISHED FOR IS ON SALE! Unpacking -60% discount today only. Grab it now before the sale ends.','2026-09-17 05:06:00',0),
(2,3,'Billing Problem - iCloud+ Subscription','Dear Clairine Vania, To avoid interruption of your iCloud+ 50GB storage, please update your payment detail immediately.','2026-09-15 10:14:00',0),
(3,4,'Happy Birthday from ZAP!','Dear Clairine Vania Goni, Happy Birthday! On your special day, we hope all your dreams come true. Claim your birthday promo inside.','2026-09-15 08:00:00',0),
(4,5,'Internet Transaction Journal','Hi CLAIRINE VANIA GONI, You just made a transaction through myBCA. Amount: Rp 150.000 to Transfer QRIS. Reference No: 9812374.','2026-09-14 19:30:00',0),
(5,6,'Item shared with you: \"_224117124.zip\"','Eclass ISTTS shared an item (_224117124.zip) with you. Please click the link to download your assignment file.','2026-09-14 14:15:00',0),
(6,2,'BOKURA from your Steam wishlist is now on sale!','BOKURA -50% OFF! A co-op puzzle adventure game for two players. Invite your friend and solve puzzles together.','2026-09-10 11:00:00',0),
(7,5,'Internet Transaction Journal','Hi CLAIRINE VANIA GONI, You just made a transaction through myBCA. Amount: Rp 45.000 to Tokopedia.','2026-09-09 12:45:00',0),
(8,7,'Visitor Access Notification','Note: The English version of this message follows the Indonesian section below. Clairine Vania has been granted lab access permission.','2026-09-03 09:20:00',0),
(10,1,'tess','hihi haha','2026-09-17 19:13:04',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`) values 
(1,'Clairine Vania','clairine.v24@mhs.istts.ac.id','123'),
(2,'Steam','noreply@steampowered.com','123'),
(3,'Apple Billing','no_reply@email.apple.com','123'),
(4,'ZAP Manyar Kertoarjo','info@zapclinic.com','123'),
(5,'BCA Notification','mybca@bca.co.id','123'),
(6,'Eclass ISTTS','eclass@istts.ac.id','123'),
(7,'access-management','no-reply@access.com','123');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
