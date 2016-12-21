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

/*Table structure for table `log_jual_detail` */

DROP TABLE IF EXISTS `log_jual_detail`;

CREATE TABLE `log_jual_detail` (
  `id_ljd` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_penjualan` int(11) DEFAULT NULL COMMENT 'ID. Penjualan',
  `tgl_penjualan` date DEFAULT NULL COMMENT 'Tgl. Penjualan',
  `id_barang` int(11) DEFAULT NULL COMMENT 'ID. Barang',
  `harga_beli` decimal(10,0) DEFAULT NULL COMMENT 'Harga Beli',
  `insert_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ljd`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
