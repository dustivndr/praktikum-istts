/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 8.0.30 : Database - basdat_week5_materi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`basdat_week5_materi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `basdat_week5_materi`;

/*Table structure for table `cabang` */

DROP TABLE IF EXISTS `cabang`;

CREATE TABLE `cabang` (
  `id_cabang` int NOT NULL,
  `nama_cabang` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cabang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `cabang` */

insert  into `cabang`(`id_cabang`,`nama_cabang`,`kota`) values 
(1,'Resto Pusat','Jakarta'),
(2,'Resto Sudirman','Jakarta'),
(3,'Resto Dago','Bandung'),
(4,'Resto Tunjungan','Surabaya'),
(5,'Resto Kuta','Bali');

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_karyawan` int NOT NULL,
  `nama_karyawan` varchar(50) DEFAULT NULL,
  `posisi` varchar(30) DEFAULT NULL,
  `id_cabang` int DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `karyawan` */

insert  into `karyawan`(`id_karyawan`,`nama_karyawan`,`posisi`,`id_cabang`) values 
(101,'Andi Kasir','Kasir',1),
(102,'Budi Waiter','Pelayan',1),
(103,'Siti Manager','Manager',1),
(104,'Santi Kasir','Kasir',2),
(105,'Rian Waiter','Pelayan',2),
(106,'Agus Manager','Manager',2),
(107,'Rizky Kasir','Kasir',3),
(108,'Eka Waiter','Pelayan',3),
(109,'Dewi Manager','Manager',3),
(110,'Hadi Kasir','Kasir',4),
(111,'Yanto Waiter','Pelayan',4),
(112,'Maya Kasir','Kasir',5),
(113,'Lulu Waiter','Pelayan',5),
(114,'Joko Pelayan','Pelayan',1),
(115,'Putu Kasir','Kasir',5);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kat` int NOT NULL,
  `nama_kat` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_kat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `kategori` */

insert  into `kategori`(`id_kat`,`nama_kat`) values 
(1,'Makanan Utama'),
(2,'Minuman'),
(3,'Makanan Penutup'),
(4,'Camilan'),
(5,'Menu Musiman');

/*Table structure for table `meja` */

DROP TABLE IF EXISTS `meja`;

CREATE TABLE `meja` (
  `id_meja` int NOT NULL,
  `nomor_meja` varchar(10) DEFAULT NULL,
  `kapasitas` int DEFAULT NULL,
  PRIMARY KEY (`id_meja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `meja` */

insert  into `meja`(`id_meja`,`nomor_meja`,`kapasitas`) values 
(1,'M01',2),
(2,'M02',4),
(3,'M03',6),
(4,'M04',2),
(5,'M05',10),
(6,'M06',4),
(7,'M07',4),
(8,'M08',2),
(9,'M09',8),
(10,'M10',6);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id_menu` int NOT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `id_kat` int DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `menu` */

insert  into `menu`(`id_menu`,`nama_menu`,`id_kat`,`harga`,`stok`) values 
(501,'Nasi Goreng Spesial',1,35000,100),
(502,'Sate Ayam Madura',1,45000,50),
(503,'Es Teh Manis',2,8000,200),
(504,'Kopi Gula Aren',2,18000,80),
(505,'Ice Cream Vanilla',3,25000,40),
(506,'Kentang Goreng',4,20000,60),
(507,'Ayam Bakar Taliwang',1,55000,30),
(508,'Jus Alpukat',2,22000,45),
(509,'Pisang Goreng Keju',4,15000,70),
(510,'Sop Buntut',1,85000,20),
(511,'Soda Gembira',2,15000,100),
(512,'Brownies Panggang',3,30000,25),
(513,'Cumi Saus Padang',1,65000,15),
(514,'Lemon Tea',2,12000,150),
(515,'Dimsum Ayam',4,25000,80),
(516,'Steak Wagyu',5,250000,10),
(517,'Lobster Bakar',5,350000,5),
(518,'Es Jeruk',2,10000,120),
(519,'Tahu Gejrot',4,12000,90),
(520,'Kerupuk Kaleng',4,2000,500);

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pel` int NOT NULL,
  `nama_pel` varchar(50) DEFAULT NULL,
  `tipe_member` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_pel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pel`,`nama_pel`,`tipe_member`) values 
(1,'Lemon pro','Gold'),
(2,'Kairi San','Silver'),
(3,'Skylar Hunter','Bronze'),
(4,'Vynnn Out','Non-Member'),
(5,'Alberttt','Gold'),
(6,'Sanz Gacor','Silver'),
(7,'Butsss Captain','Bronze'),
(8,'Kiboy Roam','Gold'),
(9,'CW Marksman','Non-Member'),
(10,'Drian Last','Silver'),
(11,'Antimage','Non-Member'),
(12,'Donkey Bar-Bar','Gold');

/*Table structure for table `pesanan` */

DROP TABLE IF EXISTS `pesanan`;

CREATE TABLE `pesanan` (
  `id_transaksi` int NOT NULL,
  `id_order` int DEFAULT NULL,
  `tgl_order` date DEFAULT NULL,
  `id_pel` int DEFAULT NULL,
  `id_karyawan` int DEFAULT NULL,
  `id_meja` int DEFAULT NULL,
  `id_menu` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `pesanan` */

insert  into `pesanan`(`id_transaksi`,`id_order`,`tgl_order`,`id_pel`,`id_karyawan`,`id_meja`,`id_menu`,`qty`) values 
(1,1001,'2023-10-01',1,107,3,501,2),
(2,1001,'2023-10-01',1,101,1,503,2),
(3,1002,'2023-10-01',2,101,2,502,1),
(4,1002,'2023-10-01',2,101,2,503,1),
(5,1003,'2023-10-02',3,103,3,507,2),
(6,1003,'2023-10-02',3,103,3,504,2),
(7,1004,'2023-10-02',1,103,1,506,3),
(8,1005,'2023-10-03',5,105,5,501,5),
(9,1006,'2023-10-03',4,105,4,504,1),
(10,1007,'2023-10-04',1,101,2,502,2),
(11,1008,'2023-10-05',8,107,6,516,1),
(12,1008,'2023-10-05',8,107,6,508,1),
(13,1009,'2023-10-05',12,112,10,517,2),
(14,1009,'2023-10-05',12,112,10,511,2),
(15,1010,'2023-10-06',6,104,7,510,1),
(16,1010,'2023-10-06',6,104,7,503,1),
(17,1011,'2023-10-06',9,110,8,515,4),
(18,1012,'2023-10-07',10,112,9,501,2),
(19,1013,'2023-10-07',7,107,1,513,1),
(20,1013,'2023-10-07',7,107,1,514,1),
(21,1014,'2023-10-08',11,115,5,519,2),
(22,1014,'2023-10-08',11,115,5,518,2),
(23,1015,'2023-10-08',1,101,2,520,10),
(24,1016,'2023-10-09',12,115,3,516,2),
(25,1017,'2023-10-09',5,101,4,501,2),
(26,1018,'2023-10-10',8,103,2,502,3),
(27,1019,'2023-10-10',2,104,6,510,2),
(28,1020,'2023-10-11',3,110,1,515,2),
(29,1021,'2023-10-11',6,112,2,503,5),
(30,1022,'2023-10-12',1,101,3,505,3),
(31,1023,'2023-10-12',4,103,5,507,1),
(32,1024,'2023-10-13',10,105,10,513,2),
(33,1025,'2023-10-13',12,107,7,501,1),
(34,1026,'2023-10-14',8,110,4,509,2),
(35,1027,'2023-10-14',5,115,2,511,2),
(36,1028,'2023-10-15',7,101,1,516,1),
(37,1029,'2023-10-15',2,104,5,508,2),
(38,1030,'2023-10-16',3,107,3,502,1),
(39,1031,'2023-10-16',1,112,6,501,2),
(40,1031,'2023-10-16',1,112,6,518,2);

/*Table structure for table `ulasan` */

DROP TABLE IF EXISTS `ulasan`;

CREATE TABLE `ulasan` (
  `id_ulasan` int NOT NULL,
  `id_pel` int DEFAULT NULL,
  `id_menu` int DEFAULT NULL,
  `bintang` int DEFAULT NULL,
  `komentar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_ulasan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `ulasan` */

insert  into `ulasan`(`id_ulasan`,`id_pel`,`id_menu`,`bintang`,`komentar`) values 
(1,1,501,5,'Nasi gorengnya mantap sekali!'),
(2,2,502,4,'Sate ayamnya enak tapi bumbunya dikit'),
(3,3,507,5,'Ayam Taliwang juara pedasnya'),
(4,5,501,5,'Porsi banyak kenyang bgt'),
(5,1,503,3,'Es tehnya standar aja'),
(6,8,516,5,'Steak Wagyu terlezat yang pernah saya makan'),
(7,12,517,5,'Lobster segar dan bumbunya meresap'),
(8,6,510,4,'Sop Buntut empuk dan kuahnya gurih'),
(9,9,515,3,'Dimsum agak dingin pas disajikan'),
(10,1,520,4,'Kerupuknya renyah tidak melempem'),
(11,12,516,5,'Repeat order wagyu, tetep juara!'),
(12,5,511,4,'Soda gembira beneran bikin gembira'),
(13,8,502,4,'Sate ayam konsisten enaknya'),
(14,2,503,2,'Es teh tawar banget, kurang gula'),
(15,10,501,5,'Nasgor spesialis resto ini emang terbaik'),
(16,1,502,5,'Sate ayamnya sekarang lebih mantap bumbunya!'),
(17,4,502,5,'Bumbu kacangnya juara dunia'),
(18,6,504,5,'Kopi gula arennya pas bgt manisnya'),
(19,7,504,4,'Enak buat nemenin kerja'),
(20,8,504,5,'Salah satu kopi aren terbaik di kota ini'),
(21,9,505,5,'Vanilla ice creamnya lembut bgt'),
(22,10,505,4,'Manisnya pas, gak bikin enek'),
(23,11,506,5,'Kentang gorengnya krispi bgt, suka!'),
(24,12,506,5,'Porsi kentangnya banyak, worth it'),
(25,2,507,5,'Ayam taliwangnya pedes nampol, langganan nih'),
(26,3,507,4,'Bumbunya meresap sampai ke tulang'),
(27,4,508,5,'Jus alpukatnya kental dan seger'),
(28,5,508,5,'Gak pelit kasih susunya'),
(29,6,509,4,'Pisang goreng kejunya melimpah kejunya'),
(30,7,509,5,'Camilan sore paling mantap'),
(31,8,510,5,'Sop buntutnya empuk banget parah'),
(32,9,510,5,'Kuahnya bening tapi gurih pol'),
(33,10,513,5,'Cumi saus padangnya seger, ga bau amis'),
(34,11,513,4,'Porsinya pas buat makan tengah'),
(35,12,515,5,'Dimsumnya kerasa bgt daging ayamnya'),
(36,1,515,4,'Ukurannya gede-gede, kenyang!'),
(37,2,516,5,'Wagyu di sini emang ga pernah gagal'),
(38,3,516,5,'Juicy bgt dagingnya, melt di mulut'),
(39,4,511,5,'Soda gembira paling seger pas siang hari'),
(40,5,501,4,'Nasi goreng favorit keluarga');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
