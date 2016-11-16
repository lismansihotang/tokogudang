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

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_assignment` */

LOCK TABLES `auth_assignment` WRITE;

UNLOCK TABLES;

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_item` */

LOCK TABLES `auth_item` WRITE;

UNLOCK TABLES;

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_item_child` */

LOCK TABLES `auth_item_child` WRITE;

UNLOCK TABLES;

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `auth_rule` */

LOCK TABLES `auth_rule` WRITE;

UNLOCK TABLES;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nm_barang` varchar(35) NOT NULL COMMENT 'Nama Barang',
  `ket_barang` tinytext COMMENT 'Deskripsi Barang',
  `harga_beli` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Harga Beli',
  `margin_jual` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Margin Jual',
  `harga_jual` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Harga Jual',
  `id_satuan_kecil` tinyint(4) NOT NULL COMMENT 'Satuan Barang',
  `id_satuan_besar` tinyint(4) DEFAULT NULL COMMENT 'Satuan Pembelian',
  `id_kategori` smallint(6) NOT NULL COMMENT 'Kategori Barang',
  `id_lokasi` int(11) DEFAULT NULL COMMENT 'Lokasi',
  `stock` int(11) DEFAULT '0' COMMENT 'Stock',
  `min_stock` int(11) NOT NULL DEFAULT '0' COMMENT 'Min. Stock',
  `user_id` int(11) DEFAULT NULL COMMENT 'User ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

LOCK TABLES `barang` WRITE;

insert  into `barang`(`id`,`nm_barang`,`ket_barang`,`harga_beli`,`margin_jual`,`harga_jual`,`id_satuan_kecil`,`id_satuan_besar`,`id_kategori`,`id_lokasi`,`stock`,`min_stock`,`user_id`) values (1,'Aqua Botol 600 ml','Aqua Botol 600 ml','4000.00','0.00','4000.00',3,4,5,4,4,5,4);

UNLOCK TABLES;

/*Table structure for table `barang_detail` */

DROP TABLE IF EXISTS `barang_detail`;

CREATE TABLE `barang_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_barang` int(11) NOT NULL COMMENT 'Nama Barang',
  `barcode` varchar(35) NOT NULL COMMENT 'Barcode',
  `tgl` datetime DEFAULT NULL COMMENT 'Tgl',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `barang_detail` */

LOCK TABLES `barang_detail` WRITE;

insert  into `barang_detail`(`id`,`id_barang`,`barcode`,`tgl`) values (1,1,'8886008101053','2016-11-15 22:30:34');

UNLOCK TABLES;

/*Table structure for table `barang_mutasi_stock` */

DROP TABLE IF EXISTS `barang_mutasi_stock`;

CREATE TABLE `barang_mutasi_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tgl` date NOT NULL COMMENT 'Tanggal',
  `id_barang` int(11) NOT NULL COMMENT 'Nama Barang',
  `stock_awal` int(11) DEFAULT '0' COMMENT 'Stock Awal',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT 'Stock',
  `harga` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Harga',
  `keterangan` tinytext COMMENT 'Keterangan',
  `user_id` int(11) DEFAULT NULL COMMENT 'User ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang_mutasi_stock` */

LOCK TABLES `barang_mutasi_stock` WRITE;

UNLOCK TABLES;

/*Table structure for table `cash_register` */

DROP TABLE IF EXISTS `cash_register`;

CREATE TABLE `cash_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Cash ID',
  `shift_id` int(11) DEFAULT NULL COMMENT 'ID Shift',
  `tgl` datetime DEFAULT NULL COMMENT 'Tanggal',
  `nominal` decimal(10,2) DEFAULT NULL COMMENT 'Nominal',
  `start_cash` time DEFAULT NULL COMMENT 'Start',
  `finish_cash` time DEFAULT NULL COMMENT 'Finish',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cash_register` */

LOCK TABLES `cash_register` WRITE;

UNLOCK TABLES;

/*Table structure for table `invoice` */

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `penjualan_id` int(11) DEFAULT NULL COMMENT 'No. Penjualan',
  `tgl` date DEFAULT NULL COMMENT 'Tgl. Invoice',
  `nominal` decimal(10,2) DEFAULT NULL COMMENT 'Nominal',
  `desc` tinytext COMMENT 'Keterangan',
  `status` enum('NEW','CANCEL','PAYMENT') DEFAULT 'NEW' COMMENT 'Status',
  `user_id` int(11) DEFAULT NULL COMMENT 'User ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `invoice` */

LOCK TABLES `invoice` WRITE;

UNLOCK TABLES;

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `desc` varchar(15) NOT NULL COMMENT 'Nama Kategori',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

LOCK TABLES `kategori` WRITE;

insert  into `kategori`(`id`,`desc`) values (5,'-');

UNLOCK TABLES;

/*Table structure for table `lokasi` */

DROP TABLE IF EXISTS `lokasi`;

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `desc` varchar(25) NOT NULL COMMENT 'Nama Lokasi',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `lokasi` */

LOCK TABLES `lokasi` WRITE;

insert  into `lokasi`(`id`,`desc`) values (4,'-');

UNLOCK TABLES;

/*Table structure for table `meja_pengunjung` */

DROP TABLE IF EXISTS `meja_pengunjung`;

CREATE TABLE `meja_pengunjung` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nm_meja` varchar(25) DEFAULT NULL COMMENT 'Nama Meja',
  `desc_meja` tinytext COMMENT 'Deskripsi',
  `urutan` smallint(6) DEFAULT NULL COMMENT 'Urutan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `meja_pengunjung` */

LOCK TABLES `meja_pengunjung` WRITE;

UNLOCK TABLES;

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `invoice_id` int(11) DEFAULT NULL COMMENT 'No. Invoice',
  `tgl` date DEFAULT NULL COMMENT 'Tgl. Payment',
  `nominal` decimal(10,2) DEFAULT NULL COMMENT 'Nominal',
  `desc` tinytext COMMENT 'Keterangan',
  `user_id` int(11) DEFAULT NULL COMMENT 'User ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `payment` */

LOCK TABLES `payment` WRITE;

UNLOCK TABLES;

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nm_pelanggan` varchar(35) NOT NULL COMMENT 'Nama Pelanggan',
  `alamat` tinytext COMMENT 'Alamat',
  `no_telp` varchar(25) DEFAULT NULL COMMENT 'No. Telp',
  `barcode` varchar(35) DEFAULT NULL COMMENT 'Barcode',
  `tgl_bergabung` date DEFAULT NULL COMMENT 'Tgl. bergabung',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `pelanggan` */

LOCK TABLES `pelanggan` WRITE;

insert  into `pelanggan`(`id`,`nm_pelanggan`,`alamat`,`no_telp`,`barcode`,`tgl_bergabung`) values (3,'#CASH',NULL,NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `pemesanan` */

DROP TABLE IF EXISTS `pemesanan`;

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tgl` date DEFAULT NULL COMMENT 'Tgl. Pemesanan',
  `id_supplier` int(11) DEFAULT NULL COMMENT 'Nama Supplier',
  `subtotal` decimal(10,2) DEFAULT NULL COMMENT 'Subtotal',
  `ppn` decimal(10,2) DEFAULT NULL COMMENT 'PPN',
  `disc` decimal(10,2) DEFAULT NULL COMMENT 'Discount',
  `total` decimal(10,2) DEFAULT NULL COMMENT 'Total',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pemesanan` */

LOCK TABLES `pemesanan` WRITE;

UNLOCK TABLES;

/*Table structure for table `pemesanan_detail` */

DROP TABLE IF EXISTS `pemesanan_detail`;

CREATE TABLE `pemesanan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_barang` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pemesanan_detail` */

LOCK TABLES `pemesanan_detail` WRITE;

UNLOCK TABLES;

/*Table structure for table `penerimaan` */

DROP TABLE IF EXISTS `penerimaan`;

CREATE TABLE `penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tgl` date DEFAULT NULL COMMENT 'Tgl. Penerimaan',
  `id_pemesanan` int(11) DEFAULT NULL COMMENT 'No. Pemesanan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penerimaan` */

LOCK TABLES `penerimaan` WRITE;

UNLOCK TABLES;

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tgl` date NOT NULL COMMENT 'Tgl. Pembelian',
  `id_pelanggan` int(11) DEFAULT NULL COMMENT 'Pelanggan',
  `subtotal` decimal(10,2) DEFAULT '0.00' COMMENT 'Subtotal',
  `disc` decimal(10,2) DEFAULT '0.00' COMMENT 'Discount',
  `pajak` decimal(10,2) DEFAULT '0.00' COMMENT 'Pajak',
  `total` decimal(10,2) DEFAULT '0.00' COMMENT 'Total',
  `pembayaran` decimal(10,2) DEFAULT '0.00' COMMENT 'Pembayaran',
  `tipe_bayar` enum('Cash','Kartu Anggota','Debet','Kartu Kredit') DEFAULT 'Cash' COMMENT 'Tipe Bayar',
  `user_id` int(11) DEFAULT NULL COMMENT 'User ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `penjualan` */

LOCK TABLES `penjualan` WRITE;

insert  into `penjualan`(`id`,`tgl`,`id_pelanggan`,`subtotal`,`disc`,`pajak`,`total`,`pembayaran`,`tipe_bayar`,`user_id`) values (8,'2016-11-15',3,'12000.00','0.00','0.00','12000.00','50000.00','Cash',4);

UNLOCK TABLES;

/*Table structure for table `penjualan_detail` */

DROP TABLE IF EXISTS `penjualan_detail`;

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_penjualan` int(11) NOT NULL COMMENT 'No. Pembelian',
  `id_barang` int(11) NOT NULL COMMENT 'Nama Barang',
  `jml` int(11) DEFAULT '1' COMMENT 'Jml',
  `harga` decimal(10,2) DEFAULT '0.00' COMMENT 'Harga',
  `subtotal` decimal(10,2) DEFAULT '0.00' COMMENT 'Subtotal',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `penjualan_detail` */

LOCK TABLES `penjualan_detail` WRITE;

insert  into `penjualan_detail`(`id`,`id_penjualan`,`id_barang`,`jml`,`harga`,`subtotal`) values (14,8,16,3,'4000.00','12000.00');

UNLOCK TABLES;

/*Table structure for table `penjualan_resto` */

DROP TABLE IF EXISTS `penjualan_resto`;

CREATE TABLE `penjualan_resto` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `penjualan_id` int(11) DEFAULT NULL COMMENT 'ID Penjualan',
  `mp_id` int(11) DEFAULT NULL COMMENT 'Meja Pengunjung',
  `pr_status` enum('Open','Closed') DEFAULT 'Open' COMMENT 'Status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penjualan_resto` */

LOCK TABLES `penjualan_resto` WRITE;

UNLOCK TABLES;

/*Table structure for table `satuan_besar` */

DROP TABLE IF EXISTS `satuan_besar`;

CREATE TABLE `satuan_besar` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nm_satuan` varchar(15) DEFAULT NULL COMMENT 'Nama Satuan',
  `konversi_satuan` int(11) DEFAULT NULL COMMENT 'Konversi Satuan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `satuan_besar` */

LOCK TABLES `satuan_besar` WRITE;

insert  into `satuan_besar`(`id`,`nm_satuan`,`konversi_satuan`) values (4,'-',0);

UNLOCK TABLES;

/*Table structure for table `satuan_kecil` */

DROP TABLE IF EXISTS `satuan_kecil`;

CREATE TABLE `satuan_kecil` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nm_satuan` varchar(15) NOT NULL COMMENT 'Nama Satuan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `satuan_kecil` */

LOCK TABLES `satuan_kecil` WRITE;

insert  into `satuan_kecil`(`id`,`nm_satuan`) values (3,'-');

UNLOCK TABLES;

/*Table structure for table `shift` */

DROP TABLE IF EXISTS `shift`;

CREATE TABLE `shift` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Shift',
  `nm_shift` varchar(12) DEFAULT NULL COMMENT 'Nama Shift',
  `start_shift` time DEFAULT NULL COMMENT 'Start Shift',
  `finish_shift` time DEFAULT NULL COMMENT 'Fnish Shift',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `shift` */

LOCK TABLES `shift` WRITE;

UNLOCK TABLES;

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nm_supplier` varchar(35) NOT NULL COMMENT 'Nama Supplier',
  `alamat` tinytext COMMENT 'Alamat',
  `no_telp` varchar(25) NOT NULL COMMENT 'No. Telp',
  `no_fax` varchar(25) DEFAULT NULL COMMENT 'No. Fax',
  `email` varchar(35) DEFAULT NULL COMMENT 'Email',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

LOCK TABLES `supplier` WRITE;

UNLOCK TABLES;

/*Table structure for table `supplier_cp` */

DROP TABLE IF EXISTS `supplier_cp`;

CREATE TABLE `supplier_cp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `id_supplier` int(11) DEFAULT NULL COMMENT 'Nama Supplier',
  `nm_cp` varchar(35) DEFAULT NULL COMMENT 'Nama',
  `no_telp` varchar(25) DEFAULT NULL COMMENT 'No. Telp',
  `email` varchar(35) DEFAULT NULL COMMENT 'Email',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `supplier_cp` */

LOCK TABLES `supplier_cp` WRITE;

UNLOCK TABLES;

/*Table structure for table `sys_user` */

DROP TABLE IF EXISTS `sys_user`;

CREATE TABLE `sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(35) DEFAULT NULL COMMENT 'Username',
  `pass` varchar(35) DEFAULT NULL COMMENT 'Password',
  `fullname` varchar(45) DEFAULT NULL COMMENT 'Nama Lengkap',
  `auth_key` varchar(150) DEFAULT NULL COMMENT 'Auth Key',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `sys_user` */

LOCK TABLES `sys_user` WRITE;

insert  into `sys_user`(`id`,`username`,`pass`,`fullname`,`auth_key`) values (4,'admin','21232f297a57a5a743894a0e4a801fc3','Administrator','iuvV08C3mxvYBCl_lEPx_LvGMmJ0nGMG');

UNLOCK TABLES;

/*Table structure for table `v_invoice` */

DROP TABLE IF EXISTS `v_invoice`;

/*!50001 DROP VIEW IF EXISTS `v_invoice` */;
/*!50001 DROP TABLE IF EXISTS `v_invoice` */;

/*!50001 CREATE TABLE  `v_invoice`(
 `id` int(11) ,
 `penjualan_id` int(11) ,
 `tgl` date ,
 `nominal` decimal(10,2) ,
 `desc` tinytext ,
 `status` enum('NEW','CANCEL','PAYMENT') ,
 `nm_pelanggan` varchar(35) 
)*/;

/*Table structure for table `v_penjualan` */

DROP TABLE IF EXISTS `v_penjualan`;

/*!50001 DROP VIEW IF EXISTS `v_penjualan` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualan` */;

/*!50001 CREATE TABLE  `v_penjualan`(
 `id` int(11) ,
 `tgl` date ,
 `id_pelanggan` int(11) ,
 `nm_pelanggan` varchar(35) ,
 `subtotal` decimal(10,2) ,
 `disc` decimal(10,2) ,
 `pajak` decimal(10,2) ,
 `total` decimal(10,2) ,
 `pembayaran` decimal(10,2) ,
 `tipe_bayar` enum('Cash','Kartu Anggota','Debet','Kartu Kredit') 
)*/;

/*View structure for view v_invoice */

/*!50001 DROP TABLE IF EXISTS `v_invoice` */;
/*!50001 DROP VIEW IF EXISTS `v_invoice` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_invoice` AS select `invoice`.`id` AS `id`,`invoice`.`penjualan_id` AS `penjualan_id`,`invoice`.`tgl` AS `tgl`,`invoice`.`nominal` AS `nominal`,`invoice`.`desc` AS `desc`,`invoice`.`status` AS `status`,`pelanggan`.`nm_pelanggan` AS `nm_pelanggan` from ((`invoice` join `penjualan` on((`invoice`.`penjualan_id` = `penjualan`.`id`))) join `pelanggan` on((`pelanggan`.`id` = `penjualan`.`id_pelanggan`))) */;

/*View structure for view v_penjualan */

/*!50001 DROP TABLE IF EXISTS `v_penjualan` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_penjualan` AS select `penjualan`.`id` AS `id`,`penjualan`.`tgl` AS `tgl`,`penjualan`.`id_pelanggan` AS `id_pelanggan`,`pelanggan`.`nm_pelanggan` AS `nm_pelanggan`,`penjualan`.`subtotal` AS `subtotal`,`penjualan`.`disc` AS `disc`,`penjualan`.`pajak` AS `pajak`,`penjualan`.`total` AS `total`,`penjualan`.`pembayaran` AS `pembayaran`,`penjualan`.`tipe_bayar` AS `tipe_bayar` from (`pelanggan` join `penjualan` on((`pelanggan`.`id` = `penjualan`.`id_pelanggan`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
