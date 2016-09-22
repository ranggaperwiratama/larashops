-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2016 at 10:25 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbtokokita`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `idberita` bigint(20) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `posisi` varchar(5) NOT NULL,
  `gambar` varchar(30) NOT NULL,
  `idkategori` int(11) NOT NULL,
  PRIMARY KEY (`idberita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`idberita`, `judul`, `posisi`, `gambar`, `idkategori`) VALUES
(1, 'Top', 'kiri', 'corporate_law.jpg', 0),
(2, 'T-Shirts', 'kanan', 'promo2.png', 0),
(3, 'Pants', 'kanan', 'promo2.png', 0),
(4, 'Dress', 'kanan', 'promo2.png', 0),
(5, 'Bags', 'kanan', 'promo2.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `noinvoice` varchar(6) NOT NULL,
  `tanggal` datetime NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `totalbayar` float NOT NULL,
  `transfer` tinyint(1) NOT NULL,
  `tglkirim` datetime DEFAULT NULL,
  `noresi` varchar(35) DEFAULT NULL,
  `tgl_tr` date DEFAULT NULL,
  `bank_from` varchar(15) DEFAULT NULL,
  `bank_dest` varchar(10) DEFAULT NULL,
  `nama_rek` varchar(25) DEFAULT NULL,
  `jumlah_tr` int(11) DEFAULT NULL,
  `bukti_tr` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`noinvoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`noinvoice`, `tanggal`, `idpelanggan`, `totalbayar`, `transfer`, `tglkirim`, `noresi`, `tgl_tr`, `bank_from`, `bank_dest`, `nama_rek`, `jumlah_tr`, `bukti_tr`, `ket`) VALUES
('T00001', '2016-09-02 17:19:40', 1, 75000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `idkategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(40) NOT NULL,
  PRIMARY KEY (`idkategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`) VALUES
(1, 'T-Shirts'),
(2, 'Outers'),
(3, 'Shirts'),
(4, 'Bags'),
(5, 'Wallets'),
(6, 'Skirts'),
(7, 'Pants'),
(8, 'Jumpsuits'),
(9, 'Dress'),
(10, 'Blouse'),
(11, 'Knitwears');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `idpelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) NOT NULL,
  `kelamin` set('L','P') NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kodepos` varchar(6) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `telp` varchar(200) NOT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idpelanggan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `nama`, `kelamin`, `email`, `alamat`, `kodepos`, `kota`, `telp`, `tanggal_daftar`, `password`, `status`) VALUES
(1, 'Rachel Johannes', 'P', 'rachel_johannes@yahoo.com', 'Seturan', '55281', 'Yogyakarta', '08122333', '2016-08-31', '8e73b27568cb3be29e2da74d42eab6dd', 0),
(2, 'Ani Ani', 'P', 'aniani@gmail.com', '', '50256', 'Semarang', '0812313222', '2016-08-31', 'ea5d163e672c73a32851f1529f49c8dd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengelola`
--

CREATE TABLE IF NOT EXISTS `pengelola` (
  `idpengelola` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`idpengelola`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pengelola`
--

INSERT INTO `pengelola` (`idpengelola`, `nama`, `username`, `password`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `idproduk` int(10) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `idkategori` int(255) NOT NULL,
  `deskripsi` text,
  `foto` varchar(50) DEFAULT NULL,
  `status_sale` int(11) NOT NULL,
  PRIMARY KEY (`idproduk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `nama_produk`, `idkategori`, `deskripsi`, `foto`, `status_sale`) VALUES
(1, 'Bag', 4, 'abc									', 'bag.jpg', 0),
(2, 'Blouse', 10, '	abc								', 'blouse.jpg', 0),
(3, 'Dress', 9, '		abc							', 'dress.jpg', 0),
(4, 'Knitwear', 11, '	abc								', 'knitwear.jpg', 0),
(5, 'Outer', 2, '	abc								', 'outer.jpg', 0),
(6, 'Pant', 7, '		abc							', 'pants.jpg', 0),
(7, 'Shirt', 3, '	abc								', 'shirt.jpg', 0),
(8, 'Skirt', 6, '	abc								', 'skirt.jpg', 0),
(9, 'tshirt', 1, 'abc									', 'tshirt.jpg', 0),
(10, 'Wallet', 5, '		abc							', 'wallet.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `idslider` int(11) NOT NULL AUTO_INCREMENT,
  `namaslider` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idslider`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`idslider`, `namaslider`) VALUES
(1, 'banner-1.jpg'),
(3, 'banner-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `idstok` int(11) NOT NULL AUTO_INCREMENT,
  `idproduk` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`idstok`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idstok`, `idproduk`, `harga_beli`, `harga_jual`, `jumlah`) VALUES
(1, 1, 50000, 75000, 12),
(2, 2, 50000, 75000, 12),
(3, 3, 50000, 75000, 12),
(4, 4, 50000, 75000, 12),
(5, 5, 50000, 75000, 12),
(6, 6, 50000, 75000, 12),
(7, 7, 50000, 75000, 12),
(8, 8, 50000, 75000, 12),
(9, 9, 50000, 75000, 12),
(10, 10, 50000, 75000, 12);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `idtransaksi` int(11) NOT NULL AUTO_INCREMENT,
  `noinvoice` varchar(6) NOT NULL,
  `idproduk` int(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`idtransaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `noinvoice`, `idproduk`, `jumlah`) VALUES
(1, 'T00001', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
