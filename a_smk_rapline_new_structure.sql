-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2016 at 03:45 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a_smk_rapline_new`
--
CREATE DATABASE IF NOT EXISTS `a_smk_rapline_new` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `a_smk_rapline_new`;

-- --------------------------------------------------------

--
-- Table structure for table `as_assign_guru_kelas`
--

CREATE TABLE IF NOT EXISTS `as_assign_guru_kelas` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_semester` int(255) NOT NULL,
  `id_guru` int(255) NOT NULL,
  `id_kelas` int(255) NOT NULL,
  `id_mata_pelajaran` int(255) NOT NULL,
  `kkm` int(3) NOT NULL DEFAULT '70',
  `hari` int(2) NOT NULL,
  `jam` int(3) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_dictionary`
--

CREATE TABLE IF NOT EXISTS `m_dictionary` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `masterkey` varchar(255) NOT NULL,
  `itemkey` varchar(255) NOT NULL,
  `itemvalue` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`itemkey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_guru`
--

CREATE TABLE IF NOT EXISTS `m_guru` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nama_guru` varchar(255) NOT NULL,
  `kode_identitas` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_kelas`
--

CREATE TABLE IF NOT EXISTS `m_kelas` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(30) NOT NULL,
  `tahun_masuk` int(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_mata_pelajaran`
--

CREATE TABLE IF NOT EXISTS `m_mata_pelajaran` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nama_mata_pelajaran` varchar(75) NOT NULL,
  `kelompok` int(2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_password_login`
--

CREATE TABLE IF NOT EXISTS `m_password_login` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `password_for` int(2) NOT NULL COMMENT 'enum type, 1 = siswa 2 = guru 4 = staff TU dll',
  `id_user` bigint(255) NOT NULL COMMENT 'related to id_siswa / id_guru',
  `password` varchar(255) NOT NULL COMMENT 'hashed',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_semester`
--

CREATE TABLE IF NOT EXISTS `m_semester` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nomor_semester` varchar(30) NOT NULL COMMENT 'semester kumulatif dihitung dari semester awal penggunaan program',
  `titimangsa_rapor` date NOT NULL,
  `tahun_masuk` int(4) NOT NULL,
  `ganjil` tinyint(1) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_siswa`
--

CREATE TABLE IF NOT EXISTS `m_siswa` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) NOT NULL,
  `kode_identitas` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(11) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `status_dalam_keluarga` varchar(20) NOT NULL,
  `anak_ke` int(2) NOT NULL,
  `alamat_siswa` text NOT NULL,
  `no_telp_rumah` varchar(16) NOT NULL,
  `sekolah_asal` varchar(30) NOT NULL,
  `di_terima_kelas` varchar(30) NOT NULL,
  `di_terima_tanggal` varchar(100) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `alamat_orangtua` text NOT NULL,
  `no_telepon_rumah` varchar(16) NOT NULL,
  `pekerjaan_ayah` varchar(20) NOT NULL,
  `pekerjaan_ibu` varchar(20) NOT NULL,
  `nama_wali` varchar(255) NOT NULL,
  `alamat_wali` text NOT NULL,
  `no_telepon_wali` varchar(16) NOT NULL,
  `pekerjaan_wali` varchar(20) NOT NULL,
  `img_photo` varchar(255) NOT NULL,
  `kelas` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tahun_masuk` int(6) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_wali_kelas`
--

CREATE TABLE IF NOT EXISTS `m_wali_kelas` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_guru` int(255) NOT NULL,
  `id_kelas` int(255) NOT NULL,
  `id_semester` int(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_assign_wali`
--

CREATE TABLE IF NOT EXISTS `t_assign_wali` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_guru` int(255) NOT NULL,
  `id_kelas` int(255) NOT NULL,
  `id_semester` int(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_catatan_siswa`
--

CREATE TABLE IF NOT EXISTS `t_catatan_siswa` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(255) NOT NULL,
  `id_guru` int(255) NOT NULL,
  `id_semester` int(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `cat_sikap` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_eskul`
--

CREATE TABLE IF NOT EXISTS `t_eskul` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(255) NOT NULL,
  `id_semester` int(255) NOT NULL,
  `nama_eskul` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_nilai`
--

CREATE TABLE IF NOT EXISTS `t_nilai` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_mata_pelajaran` int(255) NOT NULL,
  `id_siswa` bigint(255) NOT NULL,
  `id_guru` int(255) NOT NULL,
  `id_semester` int(255) NOT NULL,
  `nilai` int(4) NOT NULL,
  `deskripsi_nilai` text NOT NULL,
  `nilai_keterampilan` int(4) NOT NULL,
  `deskripsi_nilai_keterampilan` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_pkl`
--

CREATE TABLE IF NOT EXISTS `t_pkl` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(255) NOT NULL,
  `id_semester` int(255) NOT NULL,
  `lokasi` text NOT NULL,
  `durasi` int(5) NOT NULL,
  `keterangan` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_prestasi`
--

CREATE TABLE IF NOT EXISTS `t_prestasi` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(255) NOT NULL,
  `id_semester` int(255) NOT NULL,
  `nama_prestasi` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_rekap_absensi`
--

CREATE TABLE IF NOT EXISTS `t_rekap_absensi` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(255) NOT NULL,
  `id_guru` int(255) NOT NULL,
  `id_semester` int(255) NOT NULL,
  `alfa` int(5) NOT NULL,
  `sakit` int(5) NOT NULL,
  `izin` int(5) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
