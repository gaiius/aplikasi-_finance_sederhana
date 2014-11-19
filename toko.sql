# Host: localhost  (Version: 5.6.20)
# Date: 2014-11-18 15:09:41
# Generator: MySQL-Front 5.3  (Build 4.175)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "akses_user"
#

DROP TABLE IF EXISTS `akses_user`;
CREATE TABLE `akses_user` (
  `id_kode` int(11) NOT NULL AUTO_INCREMENT,
  `url_kode` int(11) NOT NULL DEFAULT '0',
  `kode_akses` varchar(255) NOT NULL DEFAULT '',
  `nama_user` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kode`)
) ENGINE=InnoDB AUTO_INCREMENT=332 DEFAULT CHARSET=latin1;

#
# Data for table "akses_user"
#

INSERT INTO `akses_user` VALUES (158,1,'','pemilik'),(159,2,'','pemilik'),(160,3,'','pemilik'),(161,4,'','pemilik'),(162,5,'','pemilik'),(163,6,'','pemilik'),(164,7,'','pemilik'),(165,8,'','pemilik'),(166,9,'','pemilik'),(167,10,'','pemilik'),(168,11,'','pemilik'),(169,12,'','pemilik'),(170,13,'','pemilik'),(171,14,'','pemilik'),(172,15,'','pemilik'),(173,16,'','pemilik'),(174,17,'','pemilik'),(175,18,'','pemilik'),(203,19,'','pemilik'),(205,20,'','pemilik'),(207,21,'','pemilik'),(208,22,'','pemilik'),(209,23,'','pemilik'),(210,24,'','pemilik'),(279,1,'','Admin'),(280,2,'','Admin'),(281,3,'','Admin'),(303,2,'','BEJO'),(304,3,'','BEJO'),(328,4,'','Admin'),(329,11,'','Admin'),(330,12,'','Admin'),(331,25,'','pemilik');

#
# Structure for table "customer"
#

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `telp` varchar(255) NOT NULL DEFAULT '',
  `pimpinan` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

#
# Data for table "customer"
#

INSERT INTO `customer` VALUES (30,'Galon','sda','09787555565','','dwt@yahoo.com','www.ptkainsejati.com'),(32,'30','','','','','');

#
# Structure for table "finishing"
#

DROP TABLE IF EXISTS `finishing`;
CREATE TABLE `finishing` (
  `id_finis` int(11) NOT NULL AUTO_INCREMENT,
  `kode_finis` int(11) NOT NULL DEFAULT '0',
  `po_finis` varchar(255) NOT NULL DEFAULT '',
  `nama_finis` varchar(255) NOT NULL DEFAULT '',
  `jumlah_finis` bigint(11) NOT NULL DEFAULT '0',
  `total_finis` bigint(11) NOT NULL DEFAULT '0',
  `biaya` varchar(255) NOT NULL DEFAULT '',
  `sisa` bigint(11) NOT NULL DEFAULT '0',
  `invoice` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(255) NOT NULL DEFAULT '',
  `ket` varchar(255) NOT NULL DEFAULT '',
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `tgl_kembali` varchar(255) NOT NULL DEFAULT '',
  `toko` varchar(255) NOT NULL DEFAULT '',
  `kirim` bigint(11) NOT NULL DEFAULT '0',
  `warna` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_finis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "finishing"
#


#
# Structure for table "hasil_produksi"
#

DROP TABLE IF EXISTS `hasil_produksi`;
CREATE TABLE `hasil_produksi` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` int(11) NOT NULL DEFAULT '0',
  `po_produk` varchar(255) NOT NULL DEFAULT '',
  `customer` varchar(255) NOT NULL DEFAULT '',
  `tgl_masuk` varchar(255) NOT NULL DEFAULT '',
  `tgl_keluar` varchar(255) NOT NULL DEFAULT '',
  `invoice` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "hasil_produksi"
#

INSERT INTO `hasil_produksi` VALUES (2,0,'','30','08/11/2014','','PO-081114-242-384','');

#
# Structure for table "history_bayar"
#

DROP TABLE IF EXISTS `history_bayar`;
CREATE TABLE `history_bayar` (
  `id_bayar` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bayar` int(11) NOT NULL DEFAULT '0',
  `bayar` bigint(11) NOT NULL DEFAULT '0',
  `sisa` bigint(11) NOT NULL DEFAULT '0',
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `jenis` varchar(255) NOT NULL DEFAULT '',
  `ket` text NOT NULL,
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id_bayar`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

#
# Data for table "history_bayar"
#

INSERT INTO `history_bayar` VALUES (10,325,1000000,0,'10/10/2014 13:41','Cast','Cast','2014-10-10'),(11,326,3000000,0,'10/10/2014 13:41','Cast','Cast','2014-10-10'),(12,327,100000,900000,'10/10/2014 13:45','Cast','9','2014-10-10'),(13,327,90000000,-89100000,'10/10/2014 13:49','Cast','7','2014-10-10'),(14,327,9000000,-8100000,'10/10/2014 13:50','Cast','8779','2014-10-10'),(15,327,100000,800000,'10/10/2014 13:56','Cast','rt','2014-10-10'),(16,327,100000,700000,'10/10/2014 13:59','Cast','asd','2014-10-10'),(17,327,700000,0,'10/10/2014 13:59','Cast','we','2014-10-10'),(18,328,1000000,2000000,'10/10/2014 14:09','Cast','qwe','2014-10-10'),(19,328,2000000,0,'10/10/2014 14:09','Cast','qwe','2014-10-10');

#
# Structure for table "history_finis"
#

DROP TABLE IF EXISTS `history_finis`;
CREATE TABLE `history_finis` (
  `id_fn` int(11) NOT NULL AUTO_INCREMENT,
  `kode_fn` varchar(255) NOT NULL DEFAULT '',
  `jumlah` bigint(11) NOT NULL DEFAULT '0',
  `kirim` bigint(11) NOT NULL DEFAULT '0',
  `biaya` bigint(11) NOT NULL DEFAULT '0',
  `kirim_jual` bigint(20) NOT NULL DEFAULT '0',
  `total` bigint(11) NOT NULL DEFAULT '0',
  `barang` varchar(255) NOT NULL DEFAULT '',
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `kode_barang` varchar(255) NOT NULL DEFAULT '',
  `auto_id` bigint(20) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT 'Fix',
  `tgl_finis` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id_fn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "history_finis"
#


#
# Structure for table "history_jahit"
#

DROP TABLE IF EXISTS `history_jahit`;
CREATE TABLE `history_jahit` (
  `id_jht` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jht` varchar(255) NOT NULL DEFAULT '',
  `toko_jht` bigint(11) NOT NULL DEFAULT '0',
  `kirim_jht` bigint(11) NOT NULL DEFAULT '0',
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `kode_jbarang` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `stt` varchar(255) NOT NULL DEFAULT '',
  `kode_keluar` bigint(20) NOT NULL DEFAULT '0',
  `biaya_jht` bigint(20) NOT NULL DEFAULT '0',
  `total_jht` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_jht`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

#
# Data for table "history_jahit"
#

INSERT INTO `history_jahit` VALUES (22,'823',48,100,'24/10/2014','210XX',0,'Kembali',20,100,10000),(26,'821',48,100,'23/10/2014','Jaket',0,'Keluar',0,0,0),(27,'824',48,123,'06/11/2014','Celana Jean ',1,'Keluar',0,0,0),(28,'824',48,123,'06/11/2014','Celana Jean ',0,'Kembali',27,167,20541),(29,'825',71,828,'06/11/2014','Jaket77',1,'Keluar',0,0,0),(30,'825',71,828,'06/11/2014','Jaket77',0,'Kembali',29,100,82800);

#
# Structure for table "history_jual"
#

DROP TABLE IF EXISTS `history_jual`;
CREATE TABLE `history_jual` (
  `id_jual` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jual` int(11) NOT NULL DEFAULT '0',
  `nama_jual` bigint(20) NOT NULL DEFAULT '0',
  `po_jual` varchar(255) NOT NULL DEFAULT '',
  `tgl_jual` varchar(255) NOT NULL DEFAULT '',
  `harga_satuan` int(11) NOT NULL DEFAULT '0',
  `harga` bigint(11) NOT NULL DEFAULT '0',
  `jumlah` bigint(11) NOT NULL DEFAULT '0',
  `inv` varchar(255) NOT NULL DEFAULT '',
  `customer` varchar(255) NOT NULL DEFAULT '',
  `bayarnya` bigint(11) NOT NULL DEFAULT '0',
  `retur_jumlah` bigint(20) NOT NULL DEFAULT '0',
  `retur_harga` bigint(20) NOT NULL DEFAULT '0',
  `jumlah_total` bigint(20) NOT NULL DEFAULT '0',
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id_jual`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "history_jual"
#


#
# Structure for table "history_laundry"
#

DROP TABLE IF EXISTS `history_laundry`;
CREATE TABLE `history_laundry` (
  `id_hl` int(11) NOT NULL AUTO_INCREMENT,
  `kode_hl` varchar(255) NOT NULL DEFAULT '',
  `kode_ly2` varchar(255) NOT NULL DEFAULT '',
  `jumlah` bigint(11) NOT NULL DEFAULT '0',
  `kirim` bigint(11) NOT NULL DEFAULT '0',
  `biaya` bigint(11) NOT NULL DEFAULT '0',
  `total` bigint(11) NOT NULL DEFAULT '0',
  `barang` varchar(255) NOT NULL DEFAULT '',
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `kode_barang` varchar(255) NOT NULL DEFAULT '',
  `warna` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_hl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "history_laundry"
#


#
# Structure for table "history_ly"
#

DROP TABLE IF EXISTS `history_ly`;
CREATE TABLE `history_ly` (
  `id_ly` int(11) NOT NULL AUTO_INCREMENT,
  `kode_ly` varchar(255) NOT NULL DEFAULT '',
  `toko_ly` bigint(11) NOT NULL DEFAULT '0',
  `kirim_ly` bigint(11) NOT NULL DEFAULT '0',
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `kode_lbarang` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_ly`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

#
# Data for table "history_ly"
#

INSERT INTO `history_ly` VALUES (18,'96',49,1200,'15/10/2014','BB1-MD2'),(19,'99',49,1500,'15/10/2014','ADD'),(20,'102',49,0,'17/10/2014','AA1'),(21,'101',76,0,'17/10/2014','MD2'),(22,'100',49,0,'17/10/2014','MD2-3');

#
# Structure for table "history_out"
#

DROP TABLE IF EXISTS `history_out`;
CREATE TABLE `history_out` (
  `id_histori` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` varchar(75) NOT NULL DEFAULT '',
  `kode_out` int(11) NOT NULL DEFAULT '0',
  `Keterangan` bigint(20) NOT NULL DEFAULT '0',
  `jml_kirim` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_histori`)
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=latin1;

#
# Data for table "history_out"
#

INSERT INTO `history_out` VALUES (257,'06/11/2014',241,0,500),(258,'06/11/2014',241,0,1500);

#
# Structure for table "history_potong"
#

DROP TABLE IF EXISTS `history_potong`;
CREATE TABLE `history_potong` (
  `id_ptk` int(11) NOT NULL AUTO_INCREMENT,
  `kode_ptk` varchar(255) NOT NULL DEFAULT '',
  `toko_ptk` bigint(11) NOT NULL DEFAULT '0',
  `kirim_ptk` bigint(11) NOT NULL DEFAULT '0',
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `kode_pbarang` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `stt` varchar(255) NOT NULL DEFAULT '',
  `kode_keluar` bigint(20) NOT NULL DEFAULT '0',
  `barang_ptk` varchar(255) NOT NULL DEFAULT '',
  `jumlah_ptk` bigint(11) NOT NULL DEFAULT '0',
  `pcs_ptk` bigint(11) NOT NULL DEFAULT '0',
  `lusin_ptk` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pakai_ptk` decimal(10,2) NOT NULL DEFAULT '0.00',
  `model_ptk` varchar(255) NOT NULL DEFAULT '',
  `harga_satuan` bigint(20) NOT NULL DEFAULT '0',
  `total_ptk` varchar(255) NOT NULL DEFAULT '',
  `invoice_ptk` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_ptk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "history_potong"
#

INSERT INTO `history_potong` VALUES (1,'2',47,400,'06/11/2014','KAIN',1,'Keluar',0,'',0,0,0.00,0.00,'',0,'',''),(2,'2',47,400,'06/11/2014','KAIN',0,'Kembali',1,'',400,123,10.25,39.02,'Celana Jean ',100,'12300','inv-200914-209'),(3,'3',59,1000,'06/11/2014','KAIN',1,'Keluar',0,'',0,0,0.00,0.00,'',0,'',''),(4,'3',59,1000,'06/11/2014','KAIN',0,'Kembali',3,'',1000,828,69.00,14.49,'Jaket77',100,'82800','PTG/71-0410149');

#
# Structure for table "jahit"
#

DROP TABLE IF EXISTS `jahit`;
CREATE TABLE `jahit` (
  `id_jahit` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jahit` int(11) NOT NULL DEFAULT '0',
  `barang_jahit` varchar(100) NOT NULL DEFAULT '',
  `po_jahit` varchar(255) NOT NULL DEFAULT '',
  `invoice` varchar(255) NOT NULL DEFAULT '',
  `tgl_kembali` varchar(70) NOT NULL DEFAULT '',
  `jumlah` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `tanggal` varchar(75) NOT NULL DEFAULT '',
  `status` varchar(255) NOT NULL DEFAULT '',
  `kirim` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT '0',
  `toko` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_jahit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "jahit"
#


#
# Structure for table "kas_kecil"
#

DROP TABLE IF EXISTS `kas_kecil`;
CREATE TABLE `kas_kecil` (
  `id_kas` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `jumlah` bigint(20) NOT NULL DEFAULT '0',
  `harga` bigint(20) NOT NULL DEFAULT '0',
  `total_harga` varchar(255) NOT NULL DEFAULT '',
  `keterangan` text NOT NULL,
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `nota` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "kas_kecil"
#


#
# Structure for table "laundry"
#

DROP TABLE IF EXISTS `laundry`;
CREATE TABLE `laundry` (
  `id_laundry` int(11) NOT NULL AUTO_INCREMENT,
  `kode_laundry` int(11) NOT NULL DEFAULT '0',
  `po_laundry` varchar(255) NOT NULL DEFAULT '',
  `nama_laundry` varchar(255) NOT NULL DEFAULT '',
  `jumlah_laundry` int(11) NOT NULL DEFAULT '0',
  `kirim` int(11) NOT NULL DEFAULT '0',
  `total_laundry` int(11) NOT NULL DEFAULT '0',
  `total_keluar` bigint(20) NOT NULL DEFAULT '0',
  `kirim_keluar` int(11) NOT NULL DEFAULT '0',
  `sisa_tkeluar` bigint(20) NOT NULL DEFAULT '0',
  `biaya` varchar(255) NOT NULL DEFAULT '',
  `sisa` int(11) NOT NULL DEFAULT '0',
  `invoice` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(255) NOT NULL DEFAULT '',
  `ket` varchar(255) NOT NULL DEFAULT '',
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `tgl_kembali` varchar(255) NOT NULL DEFAULT '',
  `toko` varchar(255) NOT NULL DEFAULT '',
  `warna` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_laundry`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "laundry"
#


#
# Structure for table "log_user"
#

DROP TABLE IF EXISTS `log_user`;
CREATE TABLE `log_user` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `ket` text NOT NULL,
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `no_po` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=3347 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "log_user"
#

INSERT INTO `log_user` VALUES (3340,150000,'pemilik','Pembelian Bahan&nbsp;KAIN&nbsp;','06/11/2014','PO-061114-1-391'),(3341,500,'pemilik','Barang Datang&nbsp;Po Out&nbsp;KAIN','06/11/2014',''),(3342,1500,'pemilik','Barang Datang&nbsp;Po Out&nbsp;KAIN','06/11/2014',''),(3343,-100,'pemilik','Retur&nbsp;Po Out&nbsp;','06/11/2014 08:40','PO-061114-1-391'),(3344,-100,'pemilik','Retur&nbsp;Po Out&nbsp;','06/11/2014 08:56','PO-061114-1-391'),(3345,0,'pemilik','Penjualan&nbsp;&nbsp;','08/11/2014',''),(3346,0,'pemilik','Penjualan&nbsp;&nbsp;','08/11/2014','');

#
# Structure for table "login"
#

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `user` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `hakakses` tinyint(1) NOT NULL DEFAULT '0',
  `bp` varchar(25) NOT NULL DEFAULT '',
  `nama` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `fb` varchar(255) NOT NULL DEFAULT '',
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '',
  `masuk` varchar(255) NOT NULL DEFAULT '',
  `cv` varchar(255) DEFAULT NULL,
  `qpa` varchar(255) DEFAULT '',
  `telp` varchar(255) NOT NULL DEFAULT '',
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `ket` text NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

#
# Data for table "login"
#

/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('Admin','21232f297a57a5a743894a0e4a801fc3',1,'admin','adadmin','adadmin@tviyogyakarta.com','','kosong','','',NULL,'Keluar','123-4567-89101','',''),('BEJO','d4c01b1d3471a1b41ad485918d2298cb',0,'bejo','','','','kosong','','',NULL,'Keluar','','',''),('pemilik','58399557dae3c60e23c78606771dfa3d',1,'pemilik','prashmana','prashmana@gmail.com','','791198argo.jpg','','2014-03-06','996063setup.log','Login','','alamat16','                                          \t\t\t\t\t\t\t\t          \t\t\t\t\t\t\t\t          ');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;

#
# Structure for table "menu"
#

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `kode` bigint(20) NOT NULL DEFAULT '0',
  `nama` varchar(255) NOT NULL DEFAULT '',
  `url_menu` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "menu"
#

INSERT INTO `menu` VALUES (1,0,'Account',''),(2,0,'Master',''),(3,0,'Belanja bahan',''),(4,0,'Proses Produksi',''),(5,0,'Biaya ',''),(6,0,'Report & Stock Jadi',''),(7,0,'Log',''),(8,0,'Penjualan','');

#
# Structure for table "pembelian"
#

DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian` (
  `id_beli` int(11) NOT NULL AUTO_INCREMENT,
  `dari` text NOT NULL,
  `ket` varchar(255) NOT NULL DEFAULT '',
  `jumlah` bigint(10) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '',
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `kode_finance` int(11) NOT NULL DEFAULT '0',
  `barang` varchar(255) NOT NULL DEFAULT '',
  `bayar` bigint(11) NOT NULL DEFAULT '0',
  `sisa` bigint(11) NOT NULL DEFAULT '0',
  `total` bigint(11) NOT NULL DEFAULT '0',
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `dept` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_beli`)
) ENGINE=InnoDB AUTO_INCREMENT=850 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "pembelian"
#

INSERT INTO `pembelian` VALUES (849,'PO OUT','PO-061114-1-391',130000,'Tempo','06/11/2014',241,'KAIN',0,0,130000,'2014-11-06','Belanja');

#
# Structure for table "po_barang"
#

DROP TABLE IF EXISTS `po_barang`;
CREATE TABLE `po_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `po` varchar(255) NOT NULL DEFAULT '',
  `kode_barang` bigint(20) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '',
  `jumlah_barang` bigint(20) NOT NULL DEFAULT '0',
  `harga` bigint(11) NOT NULL DEFAULT '0',
  `tanggal` varchar(100) DEFAULT NULL,
  `tgl_kembali` varchar(255) NOT NULL DEFAULT '',
  `kirim` bigint(20) NOT NULL DEFAULT '0',
  `total` bigint(11) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '',
  `tgl` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "po_barang"
#


#
# Structure for table "po_out"
#

DROP TABLE IF EXISTS `po_out`;
CREATE TABLE `po_out` (
  `id_out` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(225) NOT NULL DEFAULT '0',
  `tgl` varchar(255) NOT NULL DEFAULT '',
  `barang` varchar(255) NOT NULL DEFAULT '',
  `jumlah` bigint(20) NOT NULL DEFAULT '0',
  `harga_satuan` bigint(20) NOT NULL DEFAULT '0',
  `total` bigint(20) NOT NULL DEFAULT '0',
  `supplier` varchar(255) NOT NULL DEFAULT '',
  `kirim` bigint(11) NOT NULL DEFAULT '0',
  `sisa_out` bigint(20) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '',
  `retur_out` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_out`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "po_out"
#

INSERT INTO `po_out` VALUES (241,'PO-061114-1-391','06/11/2014','KAIN',1300,100,130000,'66',1300,-200,'Close',0);

#
# Structure for table "potong"
#

DROP TABLE IF EXISTS `potong`;
CREATE TABLE `potong` (
  `id_potong` int(11) NOT NULL AUTO_INCREMENT,
  `no_po` varchar(255) NOT NULL DEFAULT '',
  `kode_potong` int(11) NOT NULL DEFAULT '0',
  `barang_potong` varchar(255) NOT NULL DEFAULT '',
  `jumlah` bigint(11) NOT NULL DEFAULT '0',
  `biaya` varchar(255) NOT NULL DEFAULT '',
  `pcs` bigint(11) NOT NULL DEFAULT '0',
  `sisa` bigint(11) NOT NULL DEFAULT '0',
  `total` bigint(11) NOT NULL DEFAULT '0',
  `kirim` bigint(11) NOT NULL DEFAULT '0',
  `jumlah_total` bigint(20) NOT NULL DEFAULT '0',
  `lusin` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pakai` decimal(10,2) NOT NULL DEFAULT '0.00',
  `model` varchar(255) NOT NULL DEFAULT '',
  `tanggal` varchar(255) NOT NULL DEFAULT '',
  `tgl_kembali` varchar(255) NOT NULL DEFAULT '',
  `invoice` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(255) NOT NULL DEFAULT '',
  `ket` int(11) NOT NULL DEFAULT '0',
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id_potong`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "potong"
#


#
# Structure for table "retur"
#

DROP TABLE IF EXISTS `retur`;
CREATE TABLE `retur` (
  `id_retur` int(11) NOT NULL AUTO_INCREMENT,
  `kode_retur` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(255) NOT NULL DEFAULT '',
  `invoice` varchar(255) NOT NULL DEFAULT '',
  `jumlah` int(11) NOT NULL DEFAULT '0',
  `sisa` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `tgl_retur` varchar(255) NOT NULL DEFAULT '',
  `tgl_kembali` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_retur`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

#
# Data for table "retur"
#

INSERT INTO `retur` VALUES (12,0,'','',100,0,100,'06/11/2014 08:40',''),(13,0,'','',100,0,100,'06/11/2014 08:56','');

#
# Structure for table "sub_menu"
#

DROP TABLE IF EXISTS `sub_menu`;
CREATE TABLE `sub_menu` (
  `id_sub` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `url_menu` varchar(255) NOT NULL DEFAULT '',
  `kode` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_sub`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "sub_menu"
#

INSERT INTO `sub_menu` VALUES (1,'User account','profile/table_user/',1),(2,'List Toko','master/supplier',2),(3,'Customer','master/cutomer',2),(4,'Master Bahan','purchase/out',3),(5,'Stock Bahan','purchase/stock_bahan',3),(6,'Semua Biaya','finance/pembelian',6),(7,'Penjualan','finance/pembelanjaan',8),(9,'Pemotongan','progres/potong',4),(10,'Proses Jahit Kain','progres/jahis',4),(11,'Laundry','progres/laundry',4),(12,'Finishing','progres/finis',4),(13,'Log','laporan/log_user',7),(14,'Laporan Pembelian','laporan/pembelian',6),(15,'Laporan Penjualan','laporan/penjualan',6),(18,'Laba Rugi','laporan/laba',6),(19,'Stock Gudang','finance/stock',6),(21,'Biaya Belanja Kain','finance/biaya/out',5),(22,'Biaya Potong','finance/biaya/potong',5),(23,'Biaya Jahit','finance/biaya/jahit',5),(24,'Biaya Laundry','finance/biaya/loundry',5),(25,'Biaya Finishing','finance/biaya/finis',5),(26,'Biaya Lainnya','master/kas',2),(27,'Biaya Lain-lain','finance/biaya/Kas',5);

#
# Structure for table "supplier"
#

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `foto` varchar(255) DEFAULT '',
  `alamat` text NOT NULL,
  `telp` varchar(255) NOT NULL DEFAULT '',
  `mail` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) DEFAULT NULL,
  `dept_toko` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

#
# Data for table "supplier"
#

INSERT INTO `supplier` VALUES (47,'JS POTONG','','Jakarta Brata','09787555565','dwt@yahoo.com','www.ptkainsejati.com','Potong'),(48,'PT JAHIT INDO','','Jl. Di hatimu','0988776655 ','adiansyah@gmail.com','www.dewakain.com ','Jahit'),(49,'INDO LAUNDRY','','Jakarta','0988776655 ','asdfsaf@adfafd.com','www.ptkainsutra.com','Laundry'),(50,'PT PINISI','','Jakarta','08125123123',' hdsfh@yahoo.com','www.dewakain.com ','Finishing'),(52,'INDO KAIN','','asdad','0988776655 ','dwt@yahoo.com','www.dewakain.com ','Belanja'),(59,'POTONG AJA','','Jl. Potong ku no.5','0215152131','','','Potong'),(66,'BAHANKU','','Jl. Belanja aja No. 28','021212141231','','','Belanja'),(71,'Kain Halus','','',' 0812555890','','','Jahit'),(72,'Toko Bahana','','cengkareng\r\n','1231231','123123@123123','','Belanja'),(73,'Kain Halus1','','','','','','Belanja'),(74,'Galon6','','','','','','Belanja'),(75,'Galon7','','','','','','Belanja'),(76,'Almadani','','weqe','09787555565','dwt@yahoo.com','www.ptkainsejati.com','Laundry'),(77,'Cleaner Clean','','','0211231341',' hdsfh@yahoo.com','','Laundry');
