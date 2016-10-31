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

--
-- Dumping data for table `as_assign_guru_kelas`
--

INSERT INTO `as_assign_guru_kelas` (`id`, `id_semester`, `id_guru`, `id_kelas`, `id_mata_pelajaran`, `kkm`, `hari`, `jam`, `timestamp`) VALUES
(1, 6, 4, 8, 8, 70, 1, 1, '2016-10-29 10:11:24'),
(2, 6, 3, 8, 18, 70, 1, 2, '2016-10-29 10:38:22'),
(7, 6, 6, 8, 11, 75, 1, 3, '2016-10-30 06:20:31'),
(8, 6, 5, 8, 13, 65, 2, 1, '2016-10-30 13:09:42');

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

--
-- Dumping data for table `m_guru`
--

INSERT INTO `m_guru` (`id`, `nama_guru`, `kode_identitas`, `jenis_kelamin`, `email`, `timestamp`) VALUES
(3, 'Heri Hermawan', '001', 'L', '', '2016-10-23 14:28:45'),
(4, 'Alfi Rahman Hakim', '002', 'L', '', '2016-10-23 14:28:56'),
(5, 'Ridwan Achadi Nugroho', '003', 'L', '', '2016-10-23 14:29:04'),
(6, 'Heriyadi', '004', 'L', '', '2016-10-23 14:29:11');

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

--
-- Dumping data for table `m_kelas`
--

INSERT INTO `m_kelas` (`id`, `nama_kelas`, `tahun_masuk`, `timestamp`) VALUES
(8, 'RPL 1', 2015, '2016-10-23 13:40:19'),
(9, 'RPL 2', 2015, '2016-10-23 13:40:24'),
(10, 'RPL 1', 2016, '2016-10-23 13:40:32'),
(11, 'RPL 2', 2016, '2016-10-23 13:40:37');

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

--
-- Dumping data for table `m_mata_pelajaran`
--

INSERT INTO `m_mata_pelajaran` (`id`, `nama_mata_pelajaran`, `kelompok`, `timestamp`) VALUES
(8, 'Matematika', 1, '2016-10-30 06:31:06'),
(9, 'Bahasa Jepang', 0, '2016-10-23 14:27:26'),
(10, 'Bahasa Indonesia', 1, '2016-10-30 06:31:11'),
(11, 'Bahasa Inggris', 1, '2016-10-30 06:31:17'),
(12, 'Pendidikan Agama Islam', 1, '2016-10-30 06:30:52'),
(13, 'Fisika', 4, '2016-10-30 06:31:51'),
(14, 'Kimia', 4, '2016-10-30 06:31:53'),
(15, 'Bahasa Sunda', 0, '2016-10-23 14:27:54'),
(16, 'IPA/PLH', 0, '2016-10-23 14:28:00'),
(17, 'KKPI', 0, '2016-10-23 14:28:11'),
(18, 'Bahasa Mandarin', 0, '2016-10-23 14:28:18');

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

--
-- Dumping data for table `m_password_login`
--

INSERT INTO `m_password_login` (`id`, `password_for`, `id_user`, `password`, `timestamp`) VALUES
(2, 2, 5, '21232f297a57a5a743894a0e4a801fc3', '2016-10-30 06:16:11'),
(3, 2, 4, '21232f297a57a5a743894a0e4a801fc3', '2016-10-30 06:16:11'),
(4, 2, 3, '21232f297a57a5a743894a0e4a801fc3', '2016-10-30 06:16:11'),
(5, 1, 69, '21232f297a57a5a743894a0e4a801fc3', '2016-10-30 06:16:11');

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

--
-- Dumping data for table `m_semester`
--

INSERT INTO `m_semester` (`id`, `nomor_semester`, `titimangsa_rapor`, `tahun_masuk`, `ganjil`, `timestamp`) VALUES
(5, 'Genap 2015/2016', '2016-05-29', 2015, 0, '2016-10-29 09:37:45'),
(6, 'Ganjil 2015/2016', '2015-12-18', 2015, 1, '2016-10-29 09:37:42');

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

--
-- Dumping data for table `m_siswa`
--

INSERT INTO `m_siswa` (`id`, `nama_siswa`, `kode_identitas`, `jenis_kelamin`, `agama`, `status_dalam_keluarga`, `anak_ke`, `alamat_siswa`, `no_telp_rumah`, `sekolah_asal`, `di_terima_kelas`, `di_terima_tanggal`, `nama_ibu`, `nama_ayah`, `alamat_orangtua`, `no_telepon_rumah`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `alamat_wali`, `no_telepon_wali`, `pekerjaan_wali`, `img_photo`, `kelas`, `email`, `tahun_masuk`, `timestamp`) VALUES
(69, 'AHMAD SYAHID AFFANDI', '1014005001', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(70, 'ALFIAN PERMANA', '1014005002', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(71, 'AMALIA OKTAVIANI', '1014005003', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(72, 'ANDNAN PERDINANTO TAMBA', '1014005004', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(73, 'ANGGI AERLANGGA SAPUTRA', '1014005005', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(74, 'BERLIAND OCTA ZULFIKAR', '1014005006', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(75, 'BIMA ZAHLUTFI', '1014005007', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(76, 'BOBY KUBUS KUNDA', '1014005008', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(77, 'CITRA SALFIRA ', '1014005009', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(78, 'DIMAS SATYA FIRNANDA', '1014005010', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(79, 'DWIKA ARDYAN FEBRIANSYAH', '1014005011', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(80, 'EGGY RAYFALDO', '1014005012', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:19'),
(81, 'FADILLA AFIFAH NUR', '1014005013', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(82, 'FAHMAN FAISAL', '1014005014', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(83, 'FAISYAL ACHMAD NURWIJAYA', '1014005015', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(84, 'IRSYAD ABDUL ROJAK', '1014005016', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(85, 'MARIA ESTER AGUSTINA', '1014005017', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(86, 'MAULANA GHIFARI', '1014005018', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(87, 'MEIDINA LARASWATI', '1014005019', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(88, 'MUHAMMAD DAFFA ALFADIRA', '1014005020', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(89, 'MUHAMMAD KAMARUZZAMAN', '1014005021', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(90, 'NURZILA AULIA', '1014005022', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(91, 'OSSA ABDI PRATAMA', '1014005023', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(92, 'PUTRI WARIYANTI', '1014005024', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(93, 'REZZA HEYDAR UMMAR ALWIE', '1014005025', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(94, 'RIFQI WILDANI', '1014005026', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(95, 'RISENDI MUHAMMAD FAUZI', '1014005027', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:20'),
(96, 'SATRIA MEGADHARMA PUTRA', '1014005028', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:21'),
(97, 'SATRIO MUHAROM HARYANTO', '1014005029', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:21'),
(98, 'WISNU AJI PRATAMA', '1014005030', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:21'),
(99, 'YUPAN JULIASPEN', '1014005031', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:21'),
(100, 'YUSUF OKA MAHENDRA', '1014005032', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 8, '', 0, '2016-10-23 14:23:21'),
(101, 'ACHMAD FIRDAUS', '1014005065', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(102, 'AELEN PRITI KURNIA', '1014005066', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(103, 'AHMAD FAUZI', '1014005067', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(104, 'ALDHY RIANSYAH SUDERI', '1014005068', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(105, 'ANAS DWI WICAKSONO', '1014005069', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(106, 'ANI SAPUTRI', '1014005070', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(107, 'FABIAN ADAM', '1014005071', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(108, 'FALIH FADHIL AKBAR UTOMO', '1014005072', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(109, 'FATIMA ZAHRA', '1014005073', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(110, 'IAN DARMAWAN', '1014005074', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(111, 'IQBAL DESRYAN RAMADHAN', '1014005075', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(112, 'ISNAYNI RIZKA FATIHANI', '1014005076', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(113, 'JOSEYONATHAN', '1014005077', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(114, 'KARINA YULIA HERMAWATI', '1014005078', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(115, 'LAILA PUTRI GUSTI', '1014005079', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(116, 'M FIRDAUS RACHMATULLAH', '1014005080', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(117, 'MAHESTA RIZKITANINGRUM', '1014005081', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:32'),
(118, 'MOCH MEIZAR ARIEF', '1014005082', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(119, 'MUHAMAD LAZUARDI RIZKI FIRMANSYAH', '1014005083', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(120, 'MUHAMMAD ADITYA WICAKSONO', '1014005084', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(121, 'MUHAMMAD AGUNG SHOLEHUDIN', '1014005085', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(122, 'MUHAMMAD AL GHIFARI', '1014005086', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(123, 'MUHAMMAD DIRJA KAMALUDIN', '1014005087', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(124, 'MUHAMMAD ZEDAN RIZQIYA', '1014005088', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(125, 'NUR ALWI', '1014005089', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(126, 'NURUL QURNIA RAMADHANTI', '1014005090', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(127, 'PRAYOGA FAHLUL HIDAYAT', '1014005091', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(128, 'RENALDO ALFIAN', '1014005092', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(129, 'RIZKI ADITIYA', '1014005093', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(130, 'SAHRUL RAJAB', '1014005094', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(131, 'SARAH PUTRI NOER', '1014005095', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(132, 'SAVIRA RAHMA JULITA', '1014005096', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(133, 'SOFIATUN NISSA', '1014005097', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(134, 'SYIFFA RADHITYA INDRASARI', '1014005098', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33'),
(135, 'VALDI RANDITA PUTRA', '1014005099', 'L', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 9, '', 0, '2016-10-23 14:23:33');

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

--
-- Dumping data for table `t_assign_wali`
--

INSERT INTO `t_assign_wali` (`id`, `id_guru`, `id_kelas`, `id_semester`, `timestamp`) VALUES
(1, 5, 8, 6, '2016-10-29 09:58:42'),
(2, 5, 8, 5, '2016-10-29 09:58:44');

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

--
-- Dumping data for table `t_catatan_siswa`
--

INSERT INTO `t_catatan_siswa` (`id`, `id_siswa`, `id_guru`, `id_semester`, `deskripsi`, `cat_sikap`, `timestamp`) VALUES
(1, 69, 5, 5, 'awdawdaw', 'SIMPAN', '2016-10-29 13:19:17'),
(2, 70, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(3, 71, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(4, 72, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(5, 73, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(6, 74, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(7, 75, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(8, 76, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(9, 77, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(10, 78, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(11, 79, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(12, 80, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(13, 81, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(14, 82, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(15, 83, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(16, 84, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(17, 85, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(18, 86, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(19, 87, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(20, 88, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:58'),
(21, 89, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(22, 90, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(23, 91, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(24, 92, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(25, 93, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(26, 94, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(27, 95, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(28, 96, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(29, 97, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(30, 98, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(31, 99, 5, 5, 'hai', '(kosong)', '2016-10-29 13:05:01'),
(32, 100, 5, 5, '(kosong)', '(kosong)', '2016-10-29 12:55:59'),
(33, 69, 5, 6, 'UDAH DIISI YA', '(kosong)', '2016-10-30 15:09:54'),
(34, 70, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(35, 71, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(36, 72, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(37, 73, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(38, 74, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(39, 75, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(40, 76, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(41, 77, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(42, 78, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(43, 79, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(44, 80, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(45, 81, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(46, 82, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(47, 83, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:31'),
(48, 84, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(49, 85, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(50, 86, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(51, 87, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(52, 88, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(53, 89, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(54, 90, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(55, 91, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(56, 92, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(57, 93, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(58, 94, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(59, 95, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(60, 96, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(61, 97, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(62, 98, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(63, 99, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32'),
(64, 100, 5, 6, '(kosong)', '(kosong)', '2016-10-29 13:20:32');

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

--
-- Dumping data for table `t_eskul`
--

INSERT INTO `t_eskul` (`id`, `id_siswa`, `id_semester`, `nama_eskul`, `keterangan`, `timestamp`) VALUES
(1, 69, 5, 'Pramuka', '-\r\n', '2016-10-30 12:56:19'),
(2, 70, 5, 'Pramuka', '-', '2016-10-30 12:57:29');

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

--
-- Dumping data for table `t_nilai`
--

INSERT INTO `t_nilai` (`id`, `id_mata_pelajaran`, `id_siswa`, `id_guru`, `id_semester`, `nilai`, `deskripsi_nilai`, `nilai_keterampilan`, `deskripsi_nilai_keterampilan`, `timestamp`) VALUES
(1, 8, 69, 4, 6, 80, '', 0, '', '2016-10-29 10:24:13'),
(2, 8, 70, 4, 6, 0, '', 0, '', '2016-10-29 10:12:13'),
(3, 8, 71, 4, 6, 0, '', 0, '', '2016-10-29 10:12:13'),
(4, 8, 72, 4, 6, 0, '', 0, '', '2016-10-29 10:12:13'),
(5, 8, 73, 4, 6, 0, '', 0, '', '2016-10-29 10:12:13'),
(6, 8, 74, 4, 6, 0, '', 0, '', '2016-10-29 10:12:13'),
(7, 8, 75, 4, 6, 0, '', 0, '', '2016-10-29 10:12:13'),
(8, 8, 76, 4, 6, 0, '', 0, '', '2016-10-29 10:12:13'),
(9, 8, 77, 4, 6, 0, '', 0, '', '2016-10-29 10:12:13'),
(10, 8, 78, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(11, 8, 79, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(12, 8, 80, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(13, 8, 81, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(14, 8, 82, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(15, 8, 83, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(16, 8, 84, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(17, 8, 85, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(18, 8, 86, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(19, 8, 87, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(20, 8, 88, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(21, 8, 89, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(22, 8, 90, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(23, 8, 91, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(24, 8, 92, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(25, 8, 93, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(26, 8, 94, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(27, 8, 95, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(28, 8, 96, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(29, 8, 97, 4, 6, 0, '', 0, '', '2016-10-29 10:12:14'),
(30, 8, 98, 4, 6, 0, '', 0, '', '2016-10-29 10:12:15'),
(31, 8, 99, 4, 6, 0, '', 0, '', '2016-10-29 10:12:15'),
(32, 8, 100, 4, 6, 0, '', 0, '', '2016-10-29 10:12:15'),
(33, 18, 69, 3, 6, 87, '', 0, '', '2016-10-29 10:39:20'),
(34, 18, 70, 3, 6, 95, '', 0, '', '2016-10-29 10:39:20'),
(35, 18, 71, 3, 6, 0, '', 0, '', '2016-10-29 10:39:05'),
(36, 18, 72, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(37, 18, 73, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(38, 18, 74, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(39, 18, 75, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(40, 18, 76, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(41, 18, 77, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(42, 18, 78, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(43, 18, 79, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(44, 18, 80, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(45, 18, 81, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(46, 18, 82, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(47, 18, 83, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(48, 18, 84, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(49, 18, 85, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(50, 18, 86, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(51, 18, 87, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(52, 18, 88, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(53, 18, 89, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(54, 18, 90, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(55, 18, 91, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(56, 18, 92, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(57, 18, 93, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(58, 18, 94, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(59, 18, 95, 3, 6, 0, '', 0, '', '2016-10-29 10:39:06'),
(60, 18, 96, 3, 6, 0, '', 0, '', '2016-10-29 10:39:07'),
(61, 18, 97, 3, 6, 0, '', 0, '', '2016-10-29 10:39:07'),
(62, 18, 98, 3, 6, 0, '', 0, '', '2016-10-29 10:39:07'),
(63, 18, 99, 3, 6, 0, '', 0, '', '2016-10-29 10:39:07'),
(64, 18, 100, 3, 6, 0, '', 0, '', '2016-10-29 10:39:07'),
(65, 13, 69, 5, 6, 0, '', 0, '', '2016-10-30 13:10:25'),
(66, 13, 70, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(67, 13, 71, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(68, 13, 72, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(69, 13, 73, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(70, 13, 74, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(71, 13, 75, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(72, 13, 76, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(73, 13, 77, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(74, 13, 78, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(75, 13, 79, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(76, 13, 80, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(77, 13, 81, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(78, 13, 82, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(79, 13, 83, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(80, 13, 84, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(81, 13, 85, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(82, 13, 86, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(83, 13, 87, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(84, 13, 88, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(85, 13, 89, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(86, 13, 90, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(87, 13, 91, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(88, 13, 92, 5, 6, 0, '', 0, '', '2016-10-30 13:10:26'),
(89, 13, 93, 5, 6, 0, '', 0, '', '2016-10-30 13:10:27'),
(90, 13, 94, 5, 6, 0, '', 0, '', '2016-10-30 13:10:27'),
(91, 13, 95, 5, 6, 0, '', 0, '', '2016-10-30 13:10:27'),
(92, 13, 96, 5, 6, 0, '', 0, '', '2016-10-30 13:10:27'),
(93, 13, 97, 5, 6, 0, '', 0, '', '2016-10-30 13:10:27'),
(94, 13, 98, 5, 6, 0, '', 0, '', '2016-10-30 13:10:27'),
(95, 13, 99, 5, 6, 0, '', 0, '', '2016-10-30 13:10:27'),
(96, 13, 100, 5, 6, 0, '', 0, '', '2016-10-30 13:10:27');

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

--
-- Dumping data for table `t_pkl`
--

INSERT INTO `t_pkl` (`id`, `id_siswa`, `id_semester`, `lokasi`, `durasi`, `keterangan`, `timestamp`) VALUES
(2, 69, 6, 'PT Deptech Digital Indonesia', 2, '-', '2016-10-30 11:55:24'),
(3, 71, 6, 'Kementrian Ristek dan Teknologi', 3, '-', '2016-10-30 11:55:38'),
(4, 69, 5, 'PT Quantum Bussiness International', 2, '-', '2016-10-30 12:04:49');

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

--
-- Dumping data for table `t_rekap_absensi`
--

INSERT INTO `t_rekap_absensi` (`id`, `id_siswa`, `id_guru`, `id_semester`, `alfa`, `sakit`, `izin`, `timestamp`) VALUES
(1, 69, 5, 5, 0, 0, 2, '2016-10-31 13:22:55'),
(2, 70, 5, 5, 0, 0, 0, '2016-10-31 13:16:52'),
(3, 71, 5, 5, 0, 0, 0, '2016-10-31 13:16:52'),
(4, 72, 5, 5, 0, 0, 3, '2016-10-31 13:22:55'),
(5, 73, 5, 5, 0, 0, 0, '2016-10-31 13:16:52'),
(6, 74, 5, 5, 0, 0, 0, '2016-10-31 13:16:52'),
(7, 75, 5, 5, 0, 0, 0, '2016-10-31 13:16:52'),
(8, 76, 5, 5, 0, 0, 0, '2016-10-31 13:16:52'),
(9, 77, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(10, 78, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(11, 79, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(12, 80, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(13, 81, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(14, 82, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(15, 83, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(16, 84, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(17, 85, 5, 5, 5, 0, 0, '2016-10-31 13:23:07'),
(18, 86, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(19, 87, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(20, 88, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(21, 89, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(22, 90, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(23, 91, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(24, 92, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(25, 93, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(26, 94, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(27, 95, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(28, 96, 5, 5, 0, 0, 0, '2016-10-31 13:16:53'),
(29, 97, 5, 5, 0, 0, 0, '2016-10-31 13:16:54'),
(30, 98, 5, 5, 0, 0, 0, '2016-10-31 13:16:54'),
(31, 99, 5, 5, 0, 0, 0, '2016-10-31 13:16:54'),
(32, 100, 5, 5, 0, 0, 0, '2016-10-31 13:16:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
