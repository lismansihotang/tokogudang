/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 5.6.19 : Database - db_pos_tokogudang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_pos_tokogudang` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_pos_tokogudang`;

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nm_pelanggan` varchar(35) NOT NULL COMMENT 'Nama Pelanggan',
  `alamat` tinytext COMMENT 'Alamat',
  `no_telp` varchar(25) DEFAULT NULL COMMENT 'No. Telp',
  `barcode` varchar(35) DEFAULT NULL COMMENT 'Barcode',
  `card_number` varchar(35) DEFAULT NULL COMMENT 'No. Kartu',
  `tgl_bergabung` date DEFAULT NULL COMMENT 'Tgl. bergabung',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pelanggan` */

LOCK TABLES `pelanggan` WRITE;

insert  into `pelanggan`(`id`,`nm_pelanggan`,`alamat`,`no_telp`,`barcode`,`card_number`,`tgl_bergabung`) values (1,'#CASH',NULL,NULL,NULL,NULL,NULL),(2,'Bapak Tester','Alamat untuk tester kartu','','','0007191233','2016-11-17');

UNLOCK TABLES;

/*Table structure for table `pelanggan_quota` */

DROP TABLE IF EXISTS `pelanggan_quota`;

CREATE TABLE `pelanggan_quota` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pelanggan_id` int(11) DEFAULT NULL COMMENT 'ID Pelanggan',
  `nominal` decimal(10,0) DEFAULT '0' COMMENT 'Nominal',
  `user_insert` int(11) DEFAULT NULL COMMENT 'User ID Insert',
  `insert_date` datetime DEFAULT NULL COMMENT 'Tgl. Insert',
  `user_update` int(11) DEFAULT NULL COMMENT 'User ID Update',
  `update_date` datetime DEFAULT NULL COMMENT 'Tgl. Update',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pelanggan_quota` */

LOCK TABLES `pelanggan_quota` WRITE;

insert  into `pelanggan_quota`(`id`,`pelanggan_id`,`nominal`,`user_insert`,`insert_date`,`user_update`,`update_date`) values (1,2,'0',4,'2016-11-17 23:30:26',NULL,NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
