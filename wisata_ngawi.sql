-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: wisata_ngawi
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `gambar_wisata`
--

DROP TABLE IF EXISTS `gambar_wisata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gambar_wisata` (
  `id_gambar` int(11) NOT NULL AUTO_INCREMENT,
  `id_tempat` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_gambar`),
  KEY `id_tempat` (`id_tempat`),
  CONSTRAINT `id_tempat` FOREIGN KEY (`id_tempat`) REFERENCES `tempat_wisata` (`id_tempat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gambar_wisata`
--

LOCK TABLES `gambar_wisata` WRITE;
/*!40000 ALTER TABLE `gambar_wisata` DISABLE KEYS */;
INSERT INTO `gambar_wisata` VALUES (1,1,'https://www.madiunpos.com/files/2020/10/benteng-pendem.jpg'),(2,1,'https://ngawikab.go.id/wp-content/uploads/2014/02/benteng-pendem-van-den-bosch-2.jpg'),(3,2,'https://ngawikab.go.id/wp-content/uploads/2011/08/kebun-teh-jamus-1-1080x675.jpg'),(4,2,'https://idoltokyo.com/storage/2019/11/tea-leaf-37.jpg'),(5,2,'https://kampoengngawi.com/module/uploads/2021/08/rusa-di-kebun-teh-jamus.jpg'),(6,3,'https://pbs.twimg.com/media/Ebl41M1UEAAyTg-?format=jpg&name=large'),(7,3,'https://risetcdn.jatimtimes.com/images/2020/05/04/Sambangi-Wisata-Air-Terjun-Srambang-Park-Kepolisian-Pastikan-Tutup-Sementarad5aae9433219d8cf.jpg'),(8,3,'https://awsimages.detik.net.id/community/media/visual/2022/04/28/air-terjun-srambang-park_43.jpeg?w=1200'),(9,1,'https://www.goodnewsfromindonesia.id/uploads/post/large-travellingyukdotcom-bef17f0603836e32caf8f4bf91caf939.jpg'),(10,1,'https://live.staticflickr.com/3767/11646001485_0526cd5866_b.jpg');
/*!40000 ALTER TABLE `gambar_wisata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tempat_wisata`
--

DROP TABLE IF EXISTS `tempat_wisata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tempat_wisata` (
  `id_tempat` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `video` varchar(50) DEFAULT NULL,
  `biaya` int(7) DEFAULT NULL,
  PRIMARY KEY (`id_tempat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tempat_wisata`
--

LOCK TABLES `tempat_wisata` WRITE;
/*!40000 ALTER TABLE `tempat_wisata` DISABLE KEYS */;
INSERT INTO `tempat_wisata` VALUES (1,'Benteng Van Den Bosch','Benteng Van Den Bosch atau Benteng Pendem adalah bangunan bersejarah peninggalan Belanda.','https://goo.gl/maps/rcPYRq9XU51c9HXV7','Untung Suropati No.II, Pelem II, Pelem, Kec. Ngawi, Kabupaten Ngawi, Jawa Timur 63211','HgFTOshBgW8?start=495&end=750;',10000),(2,'Kebun Teh Jamus','Wisata hamparan kebun teh yang menghijau di lereng Gunung Lawu.','https://goo.gl/maps/EGoEKCtjgdFXjG6c8','C5RJ+HHW, Jamus, RW.04, Jamus, Girikerto, Kec. Sine, Kabupaten Ngawi, Jawa Timur 63264','CBbYjWFaHj8?start=21&60',15000),(3,'Srambang Park','Wisata di tengah kawasan hutan dan air terjun lereng sisi timur laut Gunung Lawu.','https://goo.gl/maps/RXATcXDcx4fBgKPL7','Hutan, Hutan Jogorogo, Jogorogo, Kabupaten Ngawi, Jawa Timur 63262','Nqhxu2pBelI?start=7',25000);
/*!40000 ALTER TABLE `tempat_wisata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiket`
--

DROP TABLE IF EXISTS `tiket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `wisata` int(11) NOT NULL,
  `pengunjung_dewasa` int(11) DEFAULT NULL,
  `pengunjung_anak` int(11) DEFAULT NULL,
  `tgl_kunjungan` date DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `status` enum('Menghitung','Akan Berkunjung','Dibatalkan','Telah Berkunjung') DEFAULT NULL,
  PRIMARY KEY (`id_tiket`),
  KEY `wisata` (`wisata`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `wisata` FOREIGN KEY (`wisata`) REFERENCES `tempat_wisata` (`id_tempat`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiket`
--

LOCK TABLES `tiket` WRITE;
/*!40000 ALTER TABLE `tiket` DISABLE KEYS */;
INSERT INTO `tiket` VALUES (111220616,11,1,2,0,'2022-06-16',30000,'Akan Berkunjung'),(112220618,11,2,5,1,'2022-06-18',112500,'Akan Berkunjung'),(151220617,15,1,1,2,'2022-06-17',15000,'Akan Berkunjung');
/*!40000 ALTER TABLE `tiket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(25) NOT NULL,
  `nomor_identitas` varchar(16) DEFAULT NULL,
  `no_hp` bigint(12) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (11,'Kiyowo Licious','1234567891234567',85733302666),(15,'Selvi Dwi K','1234567891012345',85733302666);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-17 23:47:40
