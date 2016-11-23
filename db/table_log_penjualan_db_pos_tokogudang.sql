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

/*Table structure for table `log_penjualan_delete` */

DROP TABLE IF EXISTS `log_penjualan_delete`;

CREATE TABLE `log_penjualan_delete` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_penjualan` int(11) DEFAULT NULL COMMENT 'ID Penjualan',
  `id_barang` int(11) DEFAULT NULL COMMENT 'ID Barang',
  `jml` int(11) DEFAULT NULL COMMENT 'Jml',
  `harga` decimal(10,0) DEFAULT NULL COMMENT 'Harga',
  `subtotal` decimal(10,0) DEFAULT NULL COMMENT 'Subtotal',
  `tgl` datetime DEFAULT NULL COMMENT 'Tgl.',
  `user_id` int(11) DEFAULT NULL COMMENT 'User ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
