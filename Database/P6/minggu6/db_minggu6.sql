/*
SQLyog Community v13.3.1 (64 bit)
MySQL - 8.0.30 : Database - db_supermarket
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_supermarket` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_supermarket`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `categories` */

insert  into `categories`(`category_id`,`category_name`,`description`) values 
(1,'Sembako','Beras, minyak goreng, gula'),
(2,'Minuman','Air mineral, soda, jus'),
(3,'Cemilan','Biskuit, keripik, coklat'),
(4,'Susu & Olahan','Susu UHT, keju, mentega'),
(5,'Bumbu Dapur','Garam, kecap, saus'),
(6,'Daging & Ikan','Daging sapi, ayam, ikan'),
(7,'Sayur & Buah','Sayuran segar dan buah'),
(8,'Perawatan Diri','Sabun, sampo, kosmetik'),
(9,'Pembersih Rumah','Deterjen, pembersih lantai'),
(10,'Kebutuhan Bayi','Popok, susu bayi'),
(11,'Makanan Beku','Nugget, sosis, bakso'),
(12,'Roti & Kue','Roti tawar, kue basah'),
(13,'Alat Tulis Kantor','Buku, pulpen, kertas'),
(14,'Obat & P3K','Obat bebas, perban, minyak angin'),
(15,'Kebutuhan Hewan','Makanan kucing, anjing'),
(16,'Kategori Kosong 1','Tidak ada produk'),
(17,'Kategori Kosong 2','Tidak ada produk'),
(18,'Kategori Kosong 3','Tidak ada produk');

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `member_since` date DEFAULT NULL,
  `membership_type` enum('regular','gold','platinum') DEFAULT NULL,
  `total_spent` decimal(15,2) DEFAULT NULL,
  `last_transaction_date` date DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `customers` */

insert  into `customers`(`customer_id`,`name`,`phone`,`email`,`gender`,`birth_date`,`member_since`,`membership_type`,`total_spent`,`last_transaction_date`) values 
(1,'Ahmad Ridwan','0811111111','ahmad@mail.com','male','1985-04-12','2022-01-10','platinum',15500000.00,'2026-03-25'),
(2,'Dewi Sartika','0811111112','dewi@mail.com','female','1990-08-25','2022-03-15','gold',8500000.00,'2026-03-28'),
(3,'Reza Rahadian','0811111113','reza@mail.com','male','1995-11-02','2023-05-20','regular',2100000.00,'2026-03-15'),
(4,'Nina Zatulini','0811111114','nina@mail.com','female','1988-02-14','2022-11-11','gold',6700000.00,'2026-03-29'),
(5,'Fajar Nugraha','0811111115','fajar@mail.com','male','1992-07-30','2024-01-05','regular',1500000.00,'2026-03-10'),
(6,'Siska Kohl','0811111116','siska@mail.com','female','2000-12-12','2023-08-17','platinum',25000000.00,'2026-03-30'),
(7,'Tono Supriyadi','0811111117','tono@mail.com','male','1975-05-05','2021-02-28','gold',9200000.00,'2026-03-20'),
(8,'Lina Marlina','0811111118','lina@mail.com','female','1982-09-09','2022-07-07','regular',3400000.00,'2026-03-22'),
(9,'Bagas Putra','0811111119','bagas@mail.com','male','1998-03-18','2024-02-14','regular',800000.00,'2026-03-05'),
(10,'Dina Lorenza','0811111120','dina@mail.com','female','1993-06-21','2023-10-10','gold',5500000.00,'2026-03-27'),
(11,'Rudi Heryanto','0811111121','rudi@mail.com','male','1980-01-30','2021-12-12','platinum',18000000.00,'2026-03-28'),
(12,'Citra Kirana','0811111122','citra@mail.com','female','1994-04-23','2023-04-04','regular',2800000.00,'2026-03-18'),
(13,'Agus Salim','0811111123','agus@mail.com','male','1978-11-11','2022-05-05','gold',7200000.00,'2026-03-25'),
(14,'Nita Thalia','0811111124','nita@mail.com','female','1986-08-08','2021-09-09','platinum',14500000.00,'2026-03-29'),
(15,'Kevin Julio','0811111125','kevin@mail.com','male','1997-07-28','2024-01-20','regular',1200000.00,'2026-03-12'),
(16,'Ratna Galih','0811111126','ratna@mail.com','female','1989-10-10','2023-02-14','gold',6800000.00,'2026-03-26'),
(17,'Doni Salman','0811111127','doni@mail.com','male','1991-12-05','2023-11-11','regular',4500000.00,'2026-03-24'),
(18,'Putri Titian','0811111128','putri@mail.com','female','1996-02-20','2024-03-01','regular',600000.00,'2026-03-15'),
(19,'Bowo Alpenliebe','0811111129','bowo@mail.com','male','2002-03-14','2023-06-06','regular',1800000.00,'2026-03-21'),
(20,'Gisel Anastasia','0811111130','gisel@mail.com','female','1990-11-16','2022-08-08','platinum',19000000.00,'2026-03-30'),
(21,'Raffi Ahmad','0811111131','raffi@mail.com','male','1987-02-17','2021-01-01','platinum',50000000.00,'2026-03-31'),
(22,'Nagita Slavina','0811111132','nagita@mail.com','female','1988-02-17','2021-01-02','platinum',45000000.00,'2026-03-31'),
(23,'Fadil Jaidi','0811111133','fadil@mail.com','male','1994-10-17','2023-09-09','gold',8800000.00,'2026-03-28'),
(24,'Keanu Agl','0811111134','keanu@mail.com','male','1998-05-25','2024-02-02','regular',2300000.00,'2026-03-27'),
(25,'Anya Geraldine','0811111135','anya@mail.com','female','1995-12-15','2022-10-10','gold',9500000.00,'2026-03-29'),
(26,'Vidi Aldiano','0811111136','vidi@mail.com','male','1990-03-29','2023-01-15','gold',7600000.00,'2026-03-28'),
(27,'Bunga Citra','0811111137','bcl@mail.com','female','1983-03-22','2021-05-20','platinum',21000000.00,'2026-03-25'),
(28,'Ariel Noah','0811111138','ariel@mail.com','male','1981-09-16','2022-02-14','gold',8900000.00,'2026-03-30'),
(29,'Luna Maya','0811111139','luna@mail.com','female','1983-08-26','2021-11-11','platinum',22000000.00,'2026-03-29'),
(30,'Deddy Corbuzier','0811111140','deddy@mail.com','male','1976-12-28','2021-08-08','platinum',35000000.00,'2026-03-31'),
(31,'Sule Sutisna','0811111141','sule@mail.com','male','1976-11-15','2022-04-04','gold',9800000.00,'2026-03-27'),
(32,'Andre Taulany','0811111142','andre@mail.com','male','1974-09-17','2021-07-07','platinum',28000000.00,'2026-03-26'),
(33,'Ivan Gunawan','0811111143','ivan@mail.com','male','1981-12-31','2022-09-09','platinum',17000000.00,'2026-03-28'),
(34,'Ruben Onsu','0811111144','ruben@mail.com','male','1983-08-15','2021-10-10','platinum',24000000.00,'2026-03-29'),
(35,'Sarwendah','0811111145','sarwendah@mail.com','female','1989-08-29','2021-10-11','platinum',16000000.00,'2026-03-25'),
(36,'Jefri Nichol','0811111146','jefri@mail.com','male','1999-01-15','2023-12-12','regular',4500000.00,'2026-03-24'),
(37,'Tiara Andini','0811111147','tiara@mail.com','female','2001-09-23','2024-01-20','regular',3200000.00,'2026-03-30'),
(38,'Lyodra Ginting','0811111148','lyodra@mail.com','female','2003-06-21','2024-02-14','regular',2800000.00,'2026-03-29'),
(39,'Ziva Magnolya','0811111149','ziva@mail.com','female','2001-03-14','2024-03-01','regular',1500000.00,'2026-03-28'),
(40,'Mahalini Raharja','0811111150','mahalini@mail.com','female','2000-03-04','2023-11-11','gold',5600000.00,'2026-03-27'),
(41,'Rizky Febian','0811111151','rizky@mail.com','male','1998-02-25','2023-10-10','gold',6200000.00,'2026-03-26'),
(42,'Atta Halilintar','0811111152','atta@mail.com','male','1994-11-20','2021-06-06','platinum',48000000.00,'2026-03-31'),
(43,'Aurel Hermansyah','0811111153','aurel@mail.com','female','1998-07-10','2021-06-07','platinum',32000000.00,'2026-03-30'),
(44,'Thariq Halilintar','0811111154','thariq@mail.com','male','1999-01-29','2022-08-08','gold',12000000.00,'2026-03-29'),
(45,'Fuji An','0811111155','fuji@mail.com','female','2002-11-03','2023-01-01','gold',9500000.00,'2026-03-28'),
(46,'Boy William','0811111156','boy@mail.com','male','1991-10-17','2022-05-05','platinum',18000000.00,'2026-03-27'),
(47,'Chef Juna','0811111157','juna@mail.com','male','1975-07-20','2021-12-12','platinum',15000000.00,'2026-03-26'),
(48,'Chef Renatta','0811111158','renatta@mail.com','female','1994-03-17','2022-11-11','gold',8500000.00,'2026-03-25'),
(49,'Chef Arnold','0811111159','arnold@mail.com','male','1988-08-18','2022-10-10','gold',9200000.00,'2026-03-24'),
(50,'Raditya Dika','0811111160','radit@mail.com','male','1984-12-28','2021-03-03','platinum',26000000.00,'2026-03-31'),
(51,'Budi Santoso','08120001','a@mail.com','male','2000-01-01','2025-01-01','regular',0.00,NULL),
(52,'Siti Aminah','08120002','b@mail.com','female','1999-02-02','2025-01-02','gold',0.00,NULL),
(53,'Joko Susanto','08120003','c@mail.com','male','1998-03-03','2025-01-03','regular',0.00,NULL),
(54,'Rina Melati','08120004','d@mail.com','female','1997-04-04','2025-01-04','platinum',0.00,NULL),
(55,'Andi Wijaya','08120005','e@mail.com','male','1996-05-05','2025-01-05','regular',0.00,NULL),
(56,'Maya Sari','08120006','f@mail.com','female','1995-06-06','2025-01-06','gold',0.00,NULL),
(57,'Dwi Cahyono','08120007','g@mail.com','male','1994-07-07','2025-01-07','regular',0.00,NULL),
(58,'Fitriani Kusuma','08120008','h@mail.com','female','1993-08-08','2025-01-08','regular',0.00,NULL),
(59,'Hendra Setiawan','08120009','i@mail.com','male','1992-09-09','2025-01-09','gold',0.00,NULL),
(60,'Indah Permatasari','08120010','j@mail.com','female','1991-10-10','2025-01-10','regular',0.00,NULL),
(61,'Gilang Pratama','08120011','k@mail.com','male','1990-11-11','2025-01-11','platinum',0.00,NULL),
(62,'Kartika Sari','08120012','l@mail.com','female','1989-12-12','2025-01-12','regular',0.00,NULL),
(63,'Lukman Hakim','08120013','m@mail.com','male','1988-01-13','2025-01-13','gold',0.00,NULL),
(64,'Novianti','08120014','n@mail.com','female','1987-02-14','2025-01-14','regular',0.00,NULL),
(65,'Eko Prasetyo','08120015','o@mail.com','male','1986-03-15','2025-01-15','regular',0.00,NULL),
(66,'Ayu Lestari','08120016','p@mail.com','female','1985-04-16','2025-01-16','gold',0.00,NULL),
(67,'Dedi Kurniawan','08120017','q@mail.com','male','1984-05-17','2025-01-17','regular',0.00,NULL),
(68,'Sri Rahayu','08120018','r@mail.com','female','1983-06-18','2025-01-18','platinum',0.00,NULL),
(69,'Wahyu Hidayat','08120019','s@mail.com','male','1982-07-19','2025-01-19','regular',0.00,NULL),
(70,'Rian Dwi Putranto','08120020','t@mail.com','female','1981-08-20','2025-01-20','regular',0.00,NULL);

/*Table structure for table `deliveries` */

DROP TABLE IF EXISTS `deliveries`;

CREATE TABLE `deliveries` (
  `delivery_id` int NOT NULL AUTO_INCREMENT,
  `sale_id` int DEFAULT NULL,
  `courier_name` varchar(100) DEFAULT NULL,
  `delivery_status` enum('packing','shipped','delivered','failed') DEFAULT NULL,
  `delivery_fee` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`delivery_id`),
  KEY `fk_delivery_sale` (`sale_id`),
  CONSTRAINT `fk_delivery_sale` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `deliveries` */

insert  into `deliveries`(`delivery_id`,`sale_id`,`courier_name`,`delivery_status`,`delivery_fee`) values 
(1,1,'Kurir Internal Toko','delivered',15000.00),
(2,3,'GrabExpress','delivered',22000.00),
(3,4,'GoSend','delivered',18000.00),
(4,7,'J&T Express','delivered',12000.00),
(5,9,'SiCepat','delivered',15000.00),
(6,10,'Kurir Internal Toko','delivered',10000.00),
(7,11,'GrabExpress','delivered',25000.00),
(8,14,'AnterAja','delivered',14000.00),
(9,15,'GoSend','failed',20000.00),
(10,18,'Kurir Internal Toko','delivered',10000.00),
(11,19,'SiCepat','delivered',17000.00),
(12,20,'JNE','delivered',21000.00),
(13,22,'GrabExpress','delivered',24000.00),
(14,25,'GoSend','delivered',19000.00),
(15,28,'Kurir Internal Toko','delivered',15000.00),
(16,29,'J&T Express','delivered',13000.00),
(17,32,'SiCepat','delivered',16000.00),
(18,34,'GoSend','delivered',20000.00),
(19,35,'Kurir Internal Toko','delivered',10000.00),
(20,37,'AnterAja','delivered',14000.00),
(21,39,'GrabExpress','delivered',26000.00),
(22,42,'JNE','delivered',22000.00),
(23,43,'SiCepat','failed',18000.00),
(24,45,'Kurir Internal Toko','delivered',10000.00),
(25,48,'GoSend','delivered',21000.00),
(26,49,'GrabExpress','delivered',30000.00),
(27,51,'Kurir Internal Toko','shipped',10000.00),
(28,52,'GoSend','shipped',15000.00),
(29,53,'SiCepat','packing',14000.00),
(30,54,'J&T Express','packing',12000.00);

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `employee_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `shift` enum('morning','afternoon','night') DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `employees` */

insert  into `employees`(`employee_id`,`name`,`position`,`salary`,`hire_date`,`shift`) values 
(1,'Budi Santoso','Store Manager',8500000.00,'2020-01-15','morning'),
(2,'Siti Aminah','Supervisor',6000000.00,'2020-06-10','afternoon'),
(3,'Andi Wijaya','Kasir',4500000.00,'2021-03-20','morning'),
(4,'Rina Permata','Kasir',4500000.00,'2021-08-12','afternoon'),
(5,'Dodi Pratama','Kasir',4500000.00,'2022-02-05','night'),
(6,'Ayu Lestari','Kasir',4500000.00,'2022-05-18','morning'),
(7,'Hendra Saputra','Kasir',4500000.00,'2022-09-22','afternoon'),
(8,'Eka Sari','Pramuniaga',4000000.00,'2021-11-11','morning'),
(9,'Joko Susilo','Pramuniaga',4000000.00,'2023-01-08','night'),
(10,'Maya Indah','Pramuniaga',4000000.00,'2023-04-14','morning'),
(11,'Rizal Fahmi','Pramuniaga',4000000.00,'2023-05-20','afternoon'),
(12,'Siska Amelia','Pramuniaga',4000000.00,'2023-06-15','night'),
(13,'Toni Gunawan','Staff Gudang',4200000.00,'2021-02-10','morning'),
(14,'Wawan Kurniawan','Staff Gudang',4200000.00,'2022-07-07','afternoon'),
(15,'Yudi Hermawan','Staff Gudang',4200000.00,'2023-08-01','night'),
(16,'Zainal Abidin','Security',4000000.00,'2020-03-05','morning'),
(17,'Ade Irawan','Security',4000000.00,'2021-04-12','night'),
(18,'Bella Saphira','Customer Service',4500000.00,'2022-10-10','morning'),
(19,'Caca Handika','Cleaning Service',3500000.00,'2023-01-20','morning'),
(20,'Derry Sudarisman','Cleaning Service',3500000.00,'2023-02-15','afternoon');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `sale_id` int DEFAULT NULL,
  `amount_paid` decimal(15,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `sale_id` (`sale_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `payments` */

insert  into `payments`(`payment_id`,`sale_id`,`amount_paid`,`payment_date`,`payment_method`,`status`) values 
(1,1,250000.00,'2026-03-20','Cash','Success'),
(2,2,145000.00,'2026-03-20','Debit Card','Success'),
(3,3,85000.00,'2026-03-21','E-Wallet','Success'),
(4,4,420000.00,'2026-03-21','Credit Card','Success'),
(5,5,75000.00,'2026-03-22','Cash','Success'),
(6,6,850000.00,'2026-03-22','Credit Card','Success'),
(7,7,195000.00,'2026-03-23','Debit Card','Success'),
(8,8,110000.00,'2026-03-23','Cash','Success'),
(9,9,45000.00,'2026-03-24','E-Wallet','Success'),
(10,10,320000.00,'2026-03-24','Debit Card','Success'),
(11,11,550000.00,'2026-03-25','Credit Card','Success'),
(12,12,135000.00,'2026-03-25','E-Wallet','Success'),
(13,13,210000.00,'2026-03-26','Cash','Success'),
(14,14,480000.00,'2026-03-26','Debit Card','Success'),
(15,15,65000.00,'2026-03-27','E-Wallet','Failed'),
(16,16,175000.00,'2026-03-27','Cash','Success'),
(17,17,95000.00,'2026-03-28','QRIS','Success'),
(18,18,55000.00,'2026-03-28','Cash','Success'),
(19,19,125000.00,'2026-03-29','E-Wallet','Success'),
(20,20,620000.00,'2026-03-29','Credit Card','Success'),
(21,21,1250000.00,'2026-03-30','Credit Card','Success'),
(22,22,890000.00,'2026-03-30','Debit Card','Success'),
(23,23,340000.00,'2026-03-30','QRIS','Success'),
(24,24,150000.00,'2026-03-31','Cash','Success'),
(25,25,410000.00,'2026-03-31','Debit Card','Success'),
(26,26,280000.00,'2026-03-31','QRIS','Success'),
(27,27,160000.00,'2026-03-31','Cash','Success'),
(28,28,520000.00,'2026-03-31','Credit Card','Success'),
(29,29,310000.00,'2026-03-31','Debit Card','Success'),
(30,30,250000.00,'2026-03-31','E-Wallet','Success'),
(31,31,185000.00,'2026-03-31','Cash','Success'),
(32,32,430000.00,'2026-03-31','Credit Card','Success'),
(33,33,95000.00,'2026-03-31','QRIS','Success'),
(34,34,650000.00,'2026-03-31','Debit Card','Success'),
(35,35,215000.00,'2026-03-31','E-Wallet','Success'),
(36,36,120000.00,'2026-03-31','Cash','Success'),
(37,37,85000.00,'2026-03-31','QRIS','Success'),
(38,38,380000.00,'2026-03-31','Credit Card','Success'),
(39,39,590000.00,'2026-03-31','Debit Card','Success'),
(40,40,145000.00,'2026-03-31','Cash','Success'),
(41,41,240000.00,'2026-03-31','E-Wallet','Success'),
(42,42,510000.00,'2026-03-31','Credit Card','Success'),
(43,43,75000.00,'2026-03-31','QRIS','Failed'),
(44,44,195000.00,'2026-03-31','Cash','Success'),
(45,45,105000.00,'2026-03-31','E-Wallet','Success'),
(46,46,65000.00,'2026-03-31','QRIS','Success'),
(47,47,135000.00,'2026-03-31','Cash','Success'),
(48,48,680000.00,'2026-03-31','Debit Card','Success'),
(49,49,1450000.00,'2026-03-31','Credit Card','Success'),
(50,50,940000.00,'2026-03-31','Debit Card','Success');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `total_sold` int DEFAULT NULL,
  `last_sold_date` date DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `products` */

insert  into `products`(`product_id`,`product_name`,`category_id`,`unit_price`,`is_active`,`created_at`,`total_sold`,`last_sold_date`) values 
(1,'Beras Maknyus 5 Kg',1,75000.00,1,'2022-01-01',520,'2026-03-31'),
(2,'Minyak Goreng Bimoli 2L',1,38000.00,1,'2022-01-01',840,'2026-03-31'),
(3,'Gula Pasir Gulaku 1 Kg',1,15000.00,1,'2022-01-01',650,'2026-03-30'),
(4,'Indomie Goreng (Karton)',1,115000.00,1,'2022-01-01',950,'2026-03-31'),
(5,'Indomie Ayam Bawang (Pcs)',1,3000.00,1,'2022-01-01',3200,'2026-03-31'),
(6,'Aqua Botol 600ml',2,3500.00,1,'2022-01-01',4500,'2026-03-31'),
(7,'Teh Pucuk Harum 350ml',2,4000.00,1,'2022-01-01',3100,'2026-03-30'),
(8,'Coca Cola 1.5L',2,16000.00,1,'2022-01-01',890,'2026-03-29'),
(9,'Oreo Vanilla 133g',3,10000.00,1,'2022-01-01',1200,'2026-03-30'),
(10,'Chitato Sapi Panggang 68g',3,11500.00,1,'2022-01-01',1450,'2026-03-31'),
(11,'Susu UHT Ultra Milk Coklat 1L',4,19500.00,1,'2022-01-01',1600,'2026-03-31'),
(12,'Keju Kraft Cheddar 165g',4,24000.00,1,'2022-01-01',420,'2026-03-28'),
(13,'Kecap Bango 520ml',5,25000.00,1,'2022-01-01',750,'2026-03-29'),
(14,'Saus Sambal ABC 340ml',5,16500.00,1,'2022-01-01',680,'2026-03-30'),
(15,'Daging Sapi Rendang 1Kg',6,135000.00,1,'2022-01-01',310,'2026-03-31'),
(16,'Ayam Broiler Utuh',6,35000.00,1,'2022-01-01',540,'2026-03-31'),
(17,'Apel Fuji 1 Kg',7,45000.00,1,'2022-01-01',420,'2026-03-30'),
(18,'Bawang Merah 500g',7,22000.00,1,'2022-01-01',580,'2026-03-31'),
(19,'Sabun Lifebuoy Total 10',8,4500.00,1,'2022-01-01',1800,'2026-03-29'),
(20,'Shampo Pantene 340ml',8,45000.00,1,'2022-01-01',620,'2026-03-30'),
(21,'Rinso Anti Noda 700g',9,21000.00,1,'2022-01-01',980,'2026-03-31'),
(22,'Sunlight Jeruk Nipis 755ml',9,18500.00,1,'2022-01-01',1150,'2026-03-31'),
(23,'Pampers Mami Poko L30',10,65000.00,1,'2022-01-01',450,'2026-03-30'),
(24,'Susu Dancow 1+ Madu 800g',10,95000.00,1,'2022-01-01',380,'2026-03-28'),
(25,'Kopi Kapal Api Mix',2,14000.00,1,'2022-01-01',1300,'2026-03-31'),
(26,'Bear Brand 189ml',4,10500.00,1,'2022-01-01',2100,'2026-03-31'),
(27,'Mie Sedaap Soto (Karton)',1,110000.00,1,'2022-01-01',750,'2026-03-29'),
(28,'Wipol Karbol Wangi 750ml',9,19500.00,1,'2022-01-01',640,'2026-03-30'),
(29,'Pepsodent White 190g',8,12500.00,1,'2022-01-01',1450,'2026-03-31'),
(30,'Silverqueen Mentega 62g',3,17500.00,1,'2022-01-01',890,'2026-03-30'),
(31,'Fiesta Chicken Nugget 500g',11,48000.00,1,'2023-01-01',500,'2026-03-31'),
(32,'Sosis Champ Sapi 500g',11,35000.00,1,'2023-01-01',450,'2026-03-30'),
(33,'Sari Roti Tawar Spesial',12,16000.00,1,'2023-01-01',1200,'2026-03-31'),
(34,'Buku Tulis Sinar Dunia 58L',13,35000.00,1,'2023-01-01',600,'2026-03-28'),
(35,'Pulpen Standard AE7 (1 Lusin)',13,20000.00,1,'2023-01-01',400,'2026-03-29'),
(36,'Panadol Paracetamol 10s',14,12000.00,1,'2023-01-01',850,'2026-03-31'),
(37,'Minyak Kayu Putih Cap Lang 60ml',14,22500.00,1,'2023-01-01',700,'2026-03-30'),
(38,'Whiskas Tuna 1.2Kg',15,65000.00,1,'2023-01-01',320,'2026-03-29'),
(39,'Pedigree Beef 1.5Kg',15,75000.00,1,'2023-01-01',210,'2026-03-28'),
(40,'Kacang Garuda Rosta 100g',3,11000.00,1,'2023-01-01',980,'2026-03-31'),
(41,'Biore Mens Facial Wash 100g',8,28000.00,1,'2023-01-01',650,'2026-03-30'),
(42,'Gatsby Styling Pomade 75g',8,32000.00,1,'2023-01-01',420,'2026-03-29'),
(43,'Tolak Angin Cair 5x15ml',14,18000.00,1,'2023-01-01',1100,'2026-03-31'),
(44,'Milo Active Go UHT 190ml',4,5500.00,1,'2023-01-01',1500,'2026-03-31'),
(45,'Yakult 5 Botol',4,10500.00,1,'2023-01-01',2200,'2026-03-31'),
(46,'Taro Net Seaweed 65g',3,8500.00,1,'2023-01-01',1300,'2026-03-30'),
(47,'Pocari Sweat 500ml',2,7500.00,1,'2023-01-01',1800,'2026-03-31'),
(48,'Tango Waffle Coklat 130g',3,9000.00,0,'2023-01-01',1150,'2026-03-30'),
(49,'Dettol Body Wash 410ml',8,38000.00,0,'2023-01-01',780,'2026-03-31'),
(50,'Royco Ayam 100g',5,5500.00,1,'2023-01-01',2500,'2026-03-31'),
(51,'Produk Random 1',1,10000.00,1,'2025-01-01',0,NULL),
(52,'Produk Random 2',2,20000.00,1,'2025-01-01',0,NULL),
(53,'Produk Random 3',3,15000.00,1,'2025-01-01',0,NULL),
(54,'Produk Random 4',4,5000.00,1,'2025-01-01',0,NULL),
(55,'Produk Random 5',5,7000.00,1,'2025-01-01',0,NULL),
(56,'Produk Random 6',6,12000.00,1,'2025-01-01',0,NULL),
(57,'Produk Random 7',7,8000.00,1,'2025-01-01',0,NULL),
(58,'Produk Random 8',8,22000.00,1,'2025-01-01',0,NULL),
(59,'Produk Random 9',9,30000.00,1,'2025-01-01',0,NULL),
(60,'Produk Random 10',10,25000.00,1,'2025-01-01',0,NULL),
(61,'Produk Random 11',11,27000.00,1,'2025-01-01',0,NULL),
(62,'Produk Random 12',12,35000.00,1,'2025-01-01',0,NULL),
(63,'Produk Random 13',13,40000.00,1,'2025-01-01',0,NULL),
(64,'Produk Random 14',14,45000.00,1,'2025-01-01',0,NULL),
(65,'Produk Random 15',15,50000.00,1,'2025-01-01',0,NULL),
(66,'Produk Random 16',1,6000.00,1,'2025-01-01',0,NULL),
(67,'Produk Random 17',2,7000.00,1,'2025-01-01',0,NULL),
(68,'Produk Random 18',3,8000.00,1,'2025-01-01',0,NULL),
(69,'Produk Random 19',4,9000.00,1,'2025-01-01',0,NULL),
(70,'Produk Random 20',5,10000.00,1,'2025-01-01',0,NULL);

/*Table structure for table `promotions` */

DROP TABLE IF EXISTS `promotions`;

CREATE TABLE `promotions` (
  `promo_id` int NOT NULL AUTO_INCREMENT,
  `promo_name` varchar(100) DEFAULT NULL,
  `discount_percent` decimal(5,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`promo_id`),
  KEY `fk_promo_product` (`product_id`),
  CONSTRAINT `fk_promo_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `promotions` */

insert  into `promotions`(`promo_id`,`promo_name`,`discount_percent`,`start_date`,`end_date`,`product_id`) values 
(1,'Promo Gajian Indomie',10.00,'2026-03-25','2026-04-05',4),
(2,'Diskon Minyak Goreng',5.00,'2026-03-01','2026-03-31',2),
(3,'Cuci Gudang Cemilan',20.00,'2026-04-01','2026-04-15',9),
(4,'Cuci Gudang Cemilan',20.00,'2026-04-01','2026-04-15',10),
(5,'Flash Sale Ramadhan',15.00,'2026-03-10','2026-04-10',NULL),
(6,'Diskon Susu Anak',12.50,'2026-03-15','2026-03-30',24),
(7,'Spesial Member Baru',25.00,'2026-01-01','2026-12-31',NULL),
(8,'Promo Sabun Cuci',10.00,'2026-04-01','2026-04-30',21),
(9,'Promo Sabun Cuci',10.00,'2026-04-01','2026-04-30',22),
(10,'Buy 1 Get 1 Kecap Bango',50.00,'2026-03-20','2026-04-20',13),
(11,'Promo Daging Segar JSM',15.00,'2026-04-03','2026-04-05',15),
(12,'Diskon Shampo Pantene',20.00,'2026-03-01','2026-03-31',20),
(13,'Promo Kopi Pagi',10.00,'2026-04-01','2026-04-15',25),
(14,'Pampers Diskon Gede',30.00,'2026-03-25','2026-04-05',23),
(15,'Diskon Roti Tawar',15.00,'2026-03-20','2026-03-25',33),
(16,'Cuci Gudang Buku Tulis',40.00,'2026-01-01','2026-06-30',34),
(17,'Promo Coklat Valentine',25.00,'2026-02-10','2026-02-20',30),
(18,'Diskon Minuman Isotonik',10.00,'2026-04-01','2026-04-30',47),
(19,'Promo Spesial Kemerdekaan',17.08,'2026-08-10','2026-08-20',NULL),
(20,'Voucher Cashback Kosong 1',5.00,'2026-05-01','2026-05-31',NULL),
(21,'Voucher Cashback Kosong 2',10.00,'2026-06-01','2026-06-30',NULL),
(22,'Diskon Akhir Tahun',50.00,'2025-12-25','2025-12-31',1),
(23,'Promo Buah Segar',20.00,'2026-04-10','2026-04-15',17),
(24,'Diskon Obat-obatan P3K',10.00,'2026-03-01','2026-12-31',36),
(25,'Diskon Makanan Kucing',15.00,'2026-04-01','2026-04-30',38);

/*Table structure for table `purchase_details` */

DROP TABLE IF EXISTS `purchase_details`;

CREATE TABLE `purchase_details` (
  `purchase_detail_id` int NOT NULL AUTO_INCREMENT,
  `purchase_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`purchase_detail_id`),
  KEY `purchase_id` (`purchase_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `purchase_details_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`purchase_id`),
  CONSTRAINT `purchase_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `purchase_details` */

insert  into `purchase_details`(`purchase_detail_id`,`purchase_id`,`product_id`,`quantity`,`price`,`subtotal`) values 
(1,1,4,20,105000.00,2100000.00),
(2,1,5,1160,2500.00,2900000.00),
(3,2,21,100,18500.00,1850000.00),
(4,2,22,100,16000.00,1600000.00),
(5,2,29,100,10500.00,1050000.00),
(6,3,17,30,35000.00,1050000.00),
(7,3,18,25,18000.00,450000.00),
(8,4,15,15,115000.00,1725000.00),
(9,4,16,27,28000.00,756000.00),
(10,5,11,200,17500.00,3500000.00),
(11,6,24,30,85000.00,2550000.00),
(12,6,26,183,9000.00,1647000.00),
(13,7,27,30,100000.00,3000000.00),
(14,8,25,100,12000.00,1200000.00),
(15,8,9,105,8500.00,892500.00),
(16,9,23,50,58000.00,2900000.00),
(17,10,2,100,34000.00,3400000.00),
(18,10,3,100,13000.00,1300000.00),
(19,10,14,92,14000.00,1288000.00),
(20,11,13,100,22000.00,2200000.00),
(21,11,19,421,3800.00,1599800.00),
(22,12,7,500,3200.00,1600000.00),
(23,13,17,30,35000.00,1050000.00),
(24,13,18,41,18000.00,738000.00),
(25,14,15,20,115000.00,2300000.00),
(26,14,16,32,28000.00,896000.00),
(27,15,12,128,21000.00,2688000.00),
(28,16,6,500,2800.00,1400000.00),
(29,17,1,50,68000.00,3400000.00),
(30,17,27,6,100000.00,600000.00),
(31,18,30,100,15000.00,1500000.00),
(32,19,8,150,14000.00,2100000.00),
(33,19,28,100,17000.00,1700000.00),
(34,19,20,43,39000.00,1677000.00),
(35,20,4,30,105000.00,3150000.00),
(36,20,10,200,9500.00,1900000.00),
(37,20,2,57,34000.00,1938000.00),
(38,21,31,30,42000.00,1260000.00),
(39,21,32,41,30000.00,1230000.00),
(40,22,33,100,13000.00,1300000.00),
(41,23,36,100,10000.00,1000000.00),
(42,23,37,105,19000.00,1995000.00),
(43,24,34,50,28000.00,1400000.00),
(44,24,35,50,16000.00,800000.00),
(45,25,38,30,55000.00,1650000.00),
(46,25,39,28,65000.00,1820000.00),
(47,26,40,200,9000.00,1800000.00),
(48,27,41,50,24000.00,1200000.00),
(49,27,42,50,28000.00,1400000.00),
(50,28,43,100,15000.00,1500000.00),
(51,29,44,200,4500.00,900000.00),
(52,29,45,200,9000.00,1800000.00),
(53,30,46,100,7000.00,700000.00),
(54,30,48,93,7500.00,697500.00),
(55,31,47,492,6500.00,3198000.00),
(56,32,48,200,7500.00,1500000.00),
(57,33,49,100,32000.00,3200000.00),
(58,33,50,355,4500.00,1597500.00),
(59,34,1,30,68000.00,2040000.00),
(60,34,2,54,34000.00,1836000.00),
(61,35,31,50,42000.00,2100000.00),
(62,36,33,100,13000.00,1300000.00),
(63,37,36,100,10000.00,1000000.00),
(64,37,37,100,19000.00,1900000.00),
(65,38,34,50,28000.00,1400000.00),
(66,38,35,25,16000.00,400000.00),
(67,39,38,45,55000.00,2475000.00),
(68,40,44,500,4500.00,2250000.00),
(69,40,45,250,9000.00,2250000.00),
(70,7,1,10,68000.00,680000.00),
(71,12,6,200,2800.00,560000.00),
(72,15,26,50,9000.00,450000.00),
(73,21,1,5,68000.00,340000.00),
(74,22,2,10,34000.00,340000.00),
(75,25,4,5,105000.00,525000.00),
(76,30,5,100,2500.00,250000.00),
(77,33,6,50,2800.00,140000.00),
(78,35,7,50,3200.00,160000.00),
(79,38,8,20,14000.00,280000.00),
(80,40,9,50,8500.00,425000.00);

/*Table structure for table `purchases` */

DROP TABLE IF EXISTS `purchases`;

CREATE TABLE `purchases` (
  `purchase_id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT NULL,
  `total_items` int DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `purchases` */

insert  into `purchases`(`purchase_id`,`supplier_id`,`purchase_date`,`total_amount`,`total_items`) values 
(1,1,'2026-03-01',5000000.00,2),
(2,2,'2026-03-02',4500000.00,3),
(3,6,'2026-03-05',1500000.00,2),
(4,7,'2026-03-06',2500000.00,2),
(5,5,'2026-03-08',3500000.00,1),
(6,8,'2026-03-10',4200000.00,2),
(7,3,'2026-03-12',3000000.00,1),
(8,4,'2026-03-15',2100000.00,2),
(9,10,'2026-03-16',2900000.00,1),
(10,1,'2026-03-18',6000000.00,3),
(11,2,'2026-03-20',3800000.00,2),
(12,9,'2026-03-21',1600000.00,1),
(13,6,'2026-03-23',1800000.00,2),
(14,7,'2026-03-24',3200000.00,2),
(15,8,'2026-03-25',2700000.00,1),
(16,5,'2026-03-26',1400000.00,1),
(17,3,'2026-03-27',4000000.00,2),
(18,4,'2026-03-28',1500000.00,1),
(19,2,'2026-03-29',5500000.00,3),
(20,1,'2026-03-30',7000000.00,3),
(21,11,'2026-03-01',2500000.00,2),
(22,12,'2026-03-03',1300000.00,1),
(23,13,'2026-03-05',3000000.00,2),
(24,14,'2026-03-07',2200000.00,2),
(25,15,'2026-03-10',3500000.00,2),
(26,9,'2026-03-12',1800000.00,1),
(27,10,'2026-03-15',2600000.00,2),
(28,13,'2026-03-18',1500000.00,1),
(29,8,'2026-03-20',2700000.00,2),
(30,4,'2026-03-22',1400000.00,2),
(31,5,'2026-03-24',3200000.00,1),
(32,4,'2026-03-25',1500000.00,1),
(33,2,'2026-03-26',4800000.00,2),
(34,1,'2026-03-27',3900000.00,2),
(35,11,'2026-03-28',2100000.00,1),
(36,12,'2026-03-29',1300000.00,1),
(37,13,'2026-03-30',2900000.00,2),
(38,14,'2026-03-31',1800000.00,2),
(39,15,'2026-03-31',2500000.00,1),
(40,8,'2026-03-31',4500000.00,2);

/*Table structure for table `sale_details` */

DROP TABLE IF EXISTS `sale_details`;

CREATE TABLE `sale_details` (
  `sale_detail_id` int NOT NULL AUTO_INCREMENT,
  `sale_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price_at_sale` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`sale_detail_id`),
  KEY `sale_id` (`sale_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `sale_details_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sale_id`),
  CONSTRAINT `sale_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `sale_details` */

insert  into `sale_details`(`sale_detail_id`,`sale_id`,`product_id`,`quantity`,`price_at_sale`,`subtotal`) values 
(1,1,1,1,75000.00,75000.00),
(2,1,2,2,38000.00,76000.00),
(3,1,5,10,3000.00,30000.00),
(4,1,13,1,25000.00,25000.00),
(5,1,14,1,16500.00,16500.00),
(6,2,15,1,135000.00,135000.00),
(7,2,18,1,22000.00,22000.00),
(8,2,7,2,4000.00,8000.00),
(9,3,23,1,65000.00,65000.00),
(10,3,19,2,4500.00,9000.00),
(11,4,4,2,115000.00,230000.00),
(12,4,2,2,38000.00,76000.00),
(13,4,3,3,15000.00,45000.00),
(14,4,21,1,21000.00,21000.00),
(15,5,11,2,19500.00,39000.00),
(16,5,26,2,10500.00,21000.00),
(17,6,24,4,95000.00,380000.00),
(18,6,23,3,65000.00,195000.00),
(19,6,1,2,75000.00,150000.00),
(20,7,16,2,35000.00,70000.00),
(21,7,17,1,45000.00,45000.00),
(22,7,22,1,18500.00,18500.00),
(23,8,25,2,14000.00,28000.00),
(24,8,3,2,15000.00,30000.00),
(25,9,6,5,3500.00,17500.00),
(26,9,9,1,10000.00,10000.00),
(27,10,1,1,75000.00,75000.00),
(28,10,15,1,135000.00,135000.00),
(29,11,4,2,115000.00,230000.00),
(30,11,27,2,110000.00,220000.00),
(31,12,29,2,12500.00,25000.00),
(32,12,20,1,45000.00,45000.00),
(33,13,12,2,24000.00,48000.00),
(34,13,8,2,16000.00,32000.00),
(35,14,1,2,75000.00,150000.00),
(36,14,2,2,38000.00,76000.00),
(37,16,10,5,11500.00,57500.00),
(38,16,30,3,17500.00,52500.00),
(39,17,28,2,19500.00,39000.00),
(40,17,21,1,21000.00,21000.00),
(41,21,15,3,135000.00,405000.00),
(42,21,1,4,75000.00,300000.00),
(43,21,24,2,95000.00,190000.00),
(44,22,27,3,110000.00,330000.00),
(45,22,4,2,115000.00,230000.00),
(46,25,2,4,38000.00,152000.00),
(47,26,1,2,75000.00,150000.00),
(48,28,23,4,65000.00,260000.00),
(49,29,15,1,135000.00,135000.00),
(50,30,24,1,95000.00,95000.00),
(51,31,31,2,48000.00,96000.00),
(52,31,32,1,35000.00,35000.00),
(53,31,33,2,16000.00,32000.00),
(54,32,4,2,115000.00,230000.00),
(55,32,38,1,65000.00,65000.00),
(56,32,39,1,75000.00,75000.00),
(57,33,40,5,11000.00,55000.00),
(58,33,6,5,3500.00,17500.00),
(59,34,1,3,75000.00,225000.00),
(60,34,15,2,135000.00,270000.00),
(61,34,16,2,35000.00,70000.00),
(62,35,41,2,28000.00,56000.00),
(63,35,42,1,32000.00,32000.00),
(64,35,19,5,4500.00,22500.00),
(65,36,43,2,18000.00,36000.00),
(66,36,36,2,12000.00,24000.00),
(67,36,6,5,3500.00,17500.00),
(68,37,44,5,5500.00,27500.00),
(69,37,45,5,10500.00,52500.00),
(70,38,46,5,8500.00,42500.00),
(71,38,48,5,9000.00,45000.00),
(72,38,47,5,7500.00,37500.00),
(73,39,49,2,38000.00,76000.00),
(74,39,21,2,21000.00,42000.00),
(75,39,28,2,19500.00,39000.00),
(76,40,50,10,5500.00,55000.00),
(77,40,13,1,25000.00,25000.00),
(78,40,18,1,22000.00,22000.00),
(79,41,1,2,75000.00,150000.00),
(80,41,2,1,38000.00,38000.00),
(81,41,3,2,15000.00,30000.00),
(82,42,4,2,115000.00,230000.00),
(83,42,24,1,95000.00,95000.00),
(84,42,23,1,65000.00,65000.00),
(85,44,31,2,48000.00,96000.00),
(86,44,32,1,35000.00,35000.00),
(87,44,33,2,16000.00,32000.00),
(88,45,40,5,11000.00,55000.00),
(89,45,6,5,3500.00,17500.00),
(90,46,44,5,5500.00,27500.00),
(91,46,45,5,10500.00,52500.00),
(92,47,46,5,8500.00,42500.00),
(93,47,48,5,9000.00,45000.00),
(94,48,49,2,38000.00,76000.00),
(95,48,21,2,21000.00,42000.00),
(96,49,1,5,75000.00,375000.00),
(97,49,15,5,135000.00,675000.00),
(98,50,4,5,115000.00,575000.00),
(99,50,27,2,110000.00,220000.00),
(100,50,38,1,65000.00,65000.00);

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `sale_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `employee_id` int DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT NULL,
  `total_items` int DEFAULT NULL,
  `status` enum('completed','canceled') DEFAULT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `customer_id` (`customer_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `sales` */

insert  into `sales`(`sale_id`,`customer_id`,`employee_id`,`sale_date`,`total_amount`,`total_items`,`status`) values 
(1,1,3,'2026-03-20',250000.00,5,'completed'),
(2,2,4,'2026-03-20',145000.00,3,'completed'),
(3,3,5,'2026-03-21',85000.00,2,'completed'),
(4,4,6,'2026-03-21',420000.00,6,'completed'),
(5,5,7,'2026-03-22',75000.00,2,'completed'),
(6,6,3,'2026-03-22',850000.00,8,'completed'),
(7,7,4,'2026-03-23',195000.00,4,'completed'),
(8,8,5,'2026-03-23',110000.00,3,'completed'),
(9,9,6,'2026-03-24',45000.00,2,'completed'),
(10,10,7,'2026-03-24',320000.00,5,'completed'),
(11,11,3,'2026-03-25',550000.00,7,'completed'),
(12,12,4,'2026-03-25',135000.00,3,'completed'),
(13,13,5,'2026-03-26',210000.00,4,'completed'),
(14,14,6,'2026-03-26',480000.00,5,'completed'),
(15,15,7,'2026-03-27',65000.00,2,'canceled'),
(16,16,3,'2026-03-27',175000.00,4,'completed'),
(17,17,4,'2026-03-28',95000.00,3,'completed'),
(18,18,5,'2026-03-28',55000.00,2,'completed'),
(19,19,6,'2026-03-29',125000.00,3,'completed'),
(20,20,7,'2026-03-29',620000.00,6,'completed'),
(21,21,3,'2026-03-30',1250000.00,10,'completed'),
(22,22,4,'2026-03-30',890000.00,8,'completed'),
(23,23,5,'2026-03-30',340000.00,5,'completed'),
(24,24,6,'2026-03-31',150000.00,3,'completed'),
(25,25,7,'2026-03-31',410000.00,6,'completed'),
(26,26,3,'2026-03-31',280000.00,4,'completed'),
(27,27,4,'2026-03-31',160000.00,3,'completed'),
(28,28,5,'2026-03-31',520000.00,5,'completed'),
(29,29,6,'2026-03-31',310000.00,4,'completed'),
(30,30,7,'2026-03-31',250000.00,3,'completed'),
(31,31,3,'2026-03-31',185000.00,3,'completed'),
(32,32,4,'2026-03-31',430000.00,6,'completed'),
(33,33,5,'2026-03-31',95000.00,2,'completed'),
(34,34,6,'2026-03-31',650000.00,8,'completed'),
(35,35,7,'2026-03-31',215000.00,4,'completed'),
(36,36,3,'2026-03-31',120000.00,3,'completed'),
(37,37,4,'2026-03-31',85000.00,2,'completed'),
(38,38,5,'2026-03-31',380000.00,5,'completed'),
(39,39,6,'2026-03-31',590000.00,7,'completed'),
(40,40,7,'2026-03-31',145000.00,3,'completed'),
(41,41,3,'2026-03-31',240000.00,4,'completed'),
(42,42,4,'2026-03-31',510000.00,5,'completed'),
(43,43,5,'2026-03-31',75000.00,2,'canceled'),
(44,44,6,'2026-03-31',195000.00,4,'completed'),
(45,45,7,'2026-03-31',105000.00,3,'completed'),
(46,46,3,'2026-03-31',65000.00,2,'completed'),
(47,47,4,'2026-03-31',135000.00,3,'completed'),
(48,48,5,'2026-03-31',680000.00,6,'completed'),
(49,49,6,'2026-03-31',1450000.00,10,'completed'),
(50,50,7,'2026-03-31',940000.00,8,'completed'),
(51,1,3,'2026-04-01',100000.00,2,'completed'),
(52,2,4,'2026-04-01',200000.00,3,'completed'),
(53,3,5,'2026-04-01',150000.00,2,'completed'),
(54,4,6,'2026-04-01',300000.00,4,'completed'),
(55,5,7,'2026-04-01',120000.00,2,'completed');

/*Table structure for table `stocks` */

DROP TABLE IF EXISTS `stocks`;

CREATE TABLE `stocks` (
  `stock_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `last_updated` date DEFAULT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `stocks` */

insert  into `stocks`(`stock_id`,`product_id`,`quantity`,`last_updated`) values 
(1,1,150,'2026-03-31'),
(2,2,200,'2026-03-31'),
(3,3,0,'2026-03-31'),
(4,4,80,'2026-03-31'),
(5,5,1500,'2026-03-31'),
(6,6,800,'2026-03-31'),
(7,7,600,'2026-03-31'),
(8,8,120,'2026-03-31'),
(9,9,0,'2026-03-31'),
(10,10,300,'2026-03-31'),
(11,11,180,'2026-03-31'),
(12,12,90,'2026-03-31'),
(13,13,140,'2026-03-31'),
(14,14,160,'2026-03-31'),
(15,15,40,'2026-03-31'),
(16,16,60,'2026-03-31'),
(17,17,55,'2026-03-31'),
(18,18,70,'2026-03-31'),
(19,19,450,'2026-03-31'),
(20,20,110,'2026-03-31'),
(21,21,220,'2026-03-31'),
(22,22,0,'2026-03-31'),
(23,23,85,'2026-03-31'),
(24,24,65,'2026-03-31'),
(25,25,340,'2026-03-31'),
(26,26,410,'2026-03-31'),
(27,27,95,'2026-03-31'),
(28,28,130,'2026-03-31'),
(29,29,320,'2026-03-31'),
(30,30,150,'2026-03-31'),
(31,31,0,'2026-03-31'),
(32,32,90,'2026-03-31'),
(33,33,50,'2026-03-31'),
(34,34,100,'2026-03-31'),
(35,35,200,'2026-03-31'),
(36,36,120,'2026-03-31'),
(37,37,150,'2026-03-31'),
(38,38,45,'2026-03-31'),
(39,39,30,'2026-03-31'),
(40,40,250,'2026-03-31'),
(41,41,0,'2026-03-31'),
(42,42,60,'2026-03-31'),
(43,43,300,'2026-03-31'),
(44,44,400,'2026-03-31'),
(45,45,0,'2026-03-31'),
(46,46,350,'2026-03-31'),
(47,47,0,'2026-03-31'),
(48,48,220,'2026-03-31'),
(49,49,90,'2026-03-31'),
(50,50,600,'2026-03-31');

/*Table structure for table `supplier_products` */

DROP TABLE IF EXISTS `supplier_products`;

CREATE TABLE `supplier_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `supply_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `supplier_products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`),
  CONSTRAINT `supplier_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `supplier_products` */

insert  into `supplier_products`(`id`,`supplier_id`,`product_id`,`supply_price`) values 
(1,1,4,105000.00),
(2,1,5,2500.00),
(3,2,13,22000.00),
(4,2,19,3800.00),
(5,2,21,18500.00),
(6,2,22,16000.00),
(7,2,29,10500.00),
(8,3,27,100000.00),
(9,4,25,12000.00),
(10,5,11,17500.00),
(11,6,17,35000.00),
(12,6,18,18000.00),
(13,7,15,115000.00),
(14,7,16,28000.00),
(15,8,24,85000.00),
(16,8,26,9000.00),
(17,1,2,34000.00),
(18,4,9,8500.00),
(19,1,10,9500.00),
(20,2,28,17000.00),
(21,2,20,39000.00),
(22,3,1,68000.00),
(23,1,14,14000.00),
(24,2,8,14000.00),
(25,4,30,15000.00),
(26,8,12,21000.00),
(27,5,6,2800.00),
(28,9,7,3200.00),
(29,1,3,13000.00),
(30,10,23,58000.00),
(31,11,31,42000.00),
(32,11,32,30000.00),
(33,12,33,13000.00),
(34,14,34,28000.00),
(35,14,35,16000.00),
(36,13,36,10000.00),
(37,13,37,19000.00),
(38,15,38,55000.00),
(39,15,39,65000.00),
(40,9,40,9000.00),
(41,10,41,24000.00),
(42,10,42,28000.00),
(43,13,43,15000.00),
(44,8,44,4500.00),
(45,8,45,9000.00),
(46,4,46,7000.00),
(47,5,47,6500.00),
(48,4,48,7500.00),
(49,2,49,32000.00),
(50,2,50,4500.00);

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL,
  `total_products_supplied` int DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `suppliers` */

insert  into `suppliers`(`supplier_id`,`supplier_name`,`contact_person`,`phone`,`email`,`address`,`city`,`province`,`join_date`,`status`,`total_products_supplied`) values 
(1,'PT Indofood','Pak Johan','021111222','sales@indofood.com','Jl. Sudirman 1','Jakarta','DKI Jakarta','2020-01-05','active',50),
(2,'PT Unilever','Bu Rini','021333444','b2b@unilever.co.id','Jl. Gatot Subroto','Jakarta','DKI Jakarta','2020-02-10','active',120),
(3,'PT Wings Surya','Pak Anton','031555666','dist@wings.com','Jl. Rungkut','Surabaya','Jawa Timur','2020-03-15','active',80),
(4,'PT Mayora Indah','Bu Siska','021777888','order@mayora.co.id','Jl. Tomang','Jakarta','DKI Jakarta','2020-04-20','active',45),
(5,'PT Ultrajaya','Pak Dedi','022999000','sales@ultrajaya.co.id','Jl. Cimareme','Bandung','Jawa Barat','2021-01-10','active',15),
(6,'CV Segar Makmur','Pak Yanto','0813444555','yanto@segar.com','Pasar Induk','Jakarta','DKI Jakarta','2021-05-12','active',30),
(7,'PT Nusantara Daging','Bu Lely','021888999','info@nusantara.com','Jl. RPH Cakung','Jakarta','DKI Jakarta','2021-08-20','active',25),
(8,'PT Nestle','Pak Firman','021444555','supply@nestle.co.id','Arkadia Park','Jakarta','DKI Jakarta','2020-06-06','active',60),
(9,'PT Garudafood','Bu Dian','021666777','sales@garudafood.com','Jl. Bintaro','Tangerang','Banten','2022-02-14','active',40),
(10,'PT Kao Indonesia','Pak Lukman','021222333','order@kao.co.id','Jl. MT Haryono','Jakarta','DKI Jakarta','2022-07-01','active',35),
(11,'PT Charoen Pokphand','Pak Budi','021888111','sales@cp.co.id','Jl. Ancol','Jakarta','DKI Jakarta','2023-01-10','active',40),
(12,'Sari Roti (PT Nippon)','Bu Ani','021999222','order@sariroti.com','Kawasan Industri','Bekasi','Jawa Barat','2023-02-20','inactive',20),
(13,'PT Kalbe Farma','Pak Candra','021777333','b2b@kalbe.co.id','Jl. Letjen','Jakarta','DKI Jakarta','2023-03-15','active',50),
(14,'Faber-Castell','Bu Dina','021666444','sales@faber.co.id','Jl. Raya Narogong','Bekasi','Jawa Barat','2023-04-10','active',30),
(15,'Whiskas (Mars Inc)','Pak Eko','021555111','order@mars.com','Kawasan MM2100','Bekasi','Jawa Barat','2023-05-05','active',15),
(16,'Supplier X','Andi','08120021',NULL,NULL,'Surabaya','Jawa Timur','2025-01-01','active',0),
(17,'Supplier Y','Budi','08120022',NULL,NULL,'Malang','Jawa Timur','2025-01-02','active',0),
(18,'Supplier Z','Citra','08120023',NULL,NULL,'Jakarta','DKI Jakarta','2025-01-03','inactive',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
