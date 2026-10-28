/*
SQLyog Community v13.3.1 (64 bit)
MySQL - 8.0.30 : Database - db_library
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_library` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_library`;

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `book_id` int NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `genre_id` int DEFAULT NULL,
  `language_id` int DEFAULT NULL,
  PRIMARY KEY (`book_id`),
  KEY `genre_id` (`genre_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`),
  CONSTRAINT `book_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `language` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `book` */

insert  into `book`(`book_id`,`book_name`,`author`,`genre_id`,`language_id`) values 
(1,'The Great Gatsby','F. Scott Fitzgerald',1,1),
(2,'Bumi Manusia','Pramoedya Ananta Toer',1,2),
(3,'Dune','Frank Herbert',4,1),
(4,'Laskar Pelangi','Andrea Hirata',1,2),
(5,'The Hobbit','J.R.R. Tolkien',3,1),
(6,'Sapiens: A Brief History of Humankind','Yuval Noah Harari',2,1),
(7,'Gadis Kretek','Ratih Kumala',1,2),
(8,'The Adventures of Sherlock Holmes','Arthur Conan Doyle',5,1),
(9,'Cantik Itu Luka','Eka Kurniawan',1,2),
(10,'Neuromancer','William Gibson',4,1),
(11,'Norwegian Wood','Haruki Murakami',1,3),
(12,'Kokoro','Natsume Sōseki',1,3),
(13,'One Thousand and One Nights','Unknown',1,4),
(14,'The Prophet','Kahlil Gibran',2,4);

/*Table structure for table `genre` */

DROP TABLE IF EXISTS `genre`;

CREATE TABLE `genre` (
  `genre_id` int NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `genre` */

insert  into `genre`(`genre_id`,`genre_name`) values 
(1,'Fiction'),
(2,'Non-Fiction'),
(3,'Fantasy'),
(4,'Science Fiction'),
(5,'Mystery');

/*Table structure for table `language` */

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `language_id` int NOT NULL AUTO_INCREMENT,
  `language_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `language` */

insert  into `language`(`language_id`,`language_name`) values 
(1,'English'),
(2,'Indonesian'),
(3,'Japanese'),
(4,'Arabic');

/*Table structure for table `librarian` */

DROP TABLE IF EXISTS `librarian`;

CREATE TABLE `librarian` (
  `librarian_id` int NOT NULL AUTO_INCREMENT,
  `librarian_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`librarian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `librarian` */

insert  into `librarian`(`librarian_id`,`librarian_name`,`password`) values 
(1,'admin','admin'),
(2,'Sarah','1234'),
(3,'John','admin123');

/*Table structure for table `patron` */

DROP TABLE IF EXISTS `patron`;

CREATE TABLE `patron` (
  `patron_id` int NOT NULL AUTO_INCREMENT,
  `patron_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`patron_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `patron` */

insert  into `patron`(`patron_id`,`patron_name`,`password`) values 
(1,'Budi','123456'),
(2,'Siti','password'),
(3,'Andi','qwerty');

/*Table structure for table `all_users` */

DROP TABLE IF EXISTS `all_users`;

/*!50001 DROP VIEW IF EXISTS `all_users` */;
/*!50001 DROP TABLE IF EXISTS `all_users` */;

/*!50001 CREATE TABLE  `all_users`(
 `user_id` int ,
 `username` varchar(255) ,
 `password` varchar(255) ,
 `role` varchar(9) 
)*/;

/*Table structure for table `book_catalog` */

DROP TABLE IF EXISTS `book_catalog`;

/*!50001 DROP VIEW IF EXISTS `book_catalog` */;
/*!50001 DROP TABLE IF EXISTS `book_catalog` */;

/*!50001 CREATE TABLE  `book_catalog`(
 `book_id` int ,
 `book_name` varchar(255) ,
 `author` varchar(255) ,
 `genre_name` varchar(255) ,
 `language_name` varchar(255) 
)*/;

/*View structure for view all_users */

/*!50001 DROP TABLE IF EXISTS `all_users` */;
/*!50001 DROP VIEW IF EXISTS `all_users` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_users` AS select `librarian`.`librarian_id` AS `user_id`,`librarian`.`librarian_name` AS `username`,`librarian`.`password` AS `password`,'Librarian' AS `role` from `librarian` union all select `patron`.`patron_id` AS `user_id`,`patron`.`patron_name` AS `username`,`patron`.`password` AS `password`,'Patron' AS `role` from `patron` */;

/*View structure for view book_catalog */

/*!50001 DROP TABLE IF EXISTS `book_catalog` */;
/*!50001 DROP VIEW IF EXISTS `book_catalog` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `book_catalog` AS select `b`.`book_id` AS `book_id`,`b`.`book_name` AS `book_name`,`b`.`author` AS `author`,`g`.`genre_name` AS `genre_name`,`l`.`language_name` AS `language_name` from ((`book` `b` join `genre` `g` on((`b`.`genre_id` = `g`.`genre_id`))) join `language` `l` on((`b`.`language_id` = `l`.`language_id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
