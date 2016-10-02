-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2016 at 05:11 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a_smk_rapline`
--
CREATE DATABASE IF NOT EXISTS `a_smk_rapline` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `a_smk_rapline`;

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
  `hari` int(2) NOT NULL,
  `jam` int(3) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `as_assign_guru_kelas`
--

INSERT INTO `as_assign_guru_kelas` (`id`, `id_semester`, `id_guru`, `id_kelas`, `id_mata_pelajaran`, `hari`, `jam`, `timestamp`) VALUES
(10, 2, 2, 2, 7, 1, 1, '2016-09-17 10:54:46'),
(11, 2, 1, 4, 7, 1, 1, '2016-10-01 13:43:02'),
(12, 2, 2, 2, 2, 3, 1, '2016-10-01 14:11:29'),
(13, 2, 1, 4, 1, 2, 4, '2016-10-01 14:18:17'),
(14, 2, 1, 4, 1, 1, 2, '2016-10-01 14:18:43'),
(15, 2, 2, 5, 6, 1, 1, '2016-10-01 14:25:07'),
(16, 2, 1, 5, 5, 1, 2, '2016-10-01 14:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `m_guru`
--

CREATE TABLE IF NOT EXISTS `m_guru` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nama_guru` varchar(255) NOT NULL,
  `kode_identitas` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `m_guru`
--

INSERT INTO `m_guru` (`id`, `nama_guru`, `kode_identitas`, `jenis_kelamin`, `timestamp`) VALUES
(1, 'Suliastri', '002001', 'Perempuan', '2016-09-06 13:47:12'),
(2, 'Irsyad Ahmad', '002002', 'Laki-Laki', '2016-09-06 13:47:33');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `m_kelas`
--

INSERT INTO `m_kelas` (`id`, `nama_kelas`, `tahun_masuk`, `timestamp`) VALUES
(2, 'RPL 1', 2015, '2016-09-09 15:05:31'),
(3, 'MM 1', 2015, '2016-09-09 15:05:35'),
(4, 'RPL 2', 2015, '2016-09-17 11:56:23'),
(5, 'RPL 1', 2016, '2016-09-17 11:56:33'),
(6, 'RPL 1', 2014, '2016-09-17 11:56:42'),
(7, 'RPL 1', 2010, '2016-10-01 08:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `m_mata_pelajaran`
--

CREATE TABLE IF NOT EXISTS `m_mata_pelajaran` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nama_mata_pelajaran` varchar(75) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `m_mata_pelajaran`
--

INSERT INTO `m_mata_pelajaran` (`id`, `nama_mata_pelajaran`, `timestamp`) VALUES
(1, 'Bahasa Indonesia', '2016-09-06 13:34:15'),
(2, 'Bahasa Inggris', '2016-09-06 13:34:19'),
(4, 'Matematika', '2016-09-06 13:38:13'),
(5, 'Bahasa Jepang', '2016-09-17 05:29:45'),
(6, 'Fisika', '2016-09-17 05:30:03'),
(7, 'Kimia', '2016-09-17 05:30:07');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `m_password_login`
--

INSERT INTO `m_password_login` (`id`, `password_for`, `id_user`, `password`, `timestamp`) VALUES
(1, 1, 0, '45991986536fa968aa36e2590780a1fc', '2016-09-10 05:43:40'),
(2, 1, 2, 'c7ee1296e6a4ee0fb5722049b5a2d662', '2016-09-10 05:44:33'),
(9, 1, 1, 'b8c082fdc929017ef21584ee00da0cee', '2016-10-02 13:21:27'),
(11, 2, 37, 'd7632d08ec57bdd142b6bb0cb8b5e346', '2016-10-02 14:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `m_semester`
--

CREATE TABLE IF NOT EXISTS `m_semester` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nomor_semester` varchar(30) NOT NULL COMMENT 'semester kumulatif dihitung dari semester awal penggunaan program',
  `tahun_masuk` int(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `m_semester`
--

INSERT INTO `m_semester` (`id`, `nomor_semester`, `tahun_masuk`, `timestamp`) VALUES
(1, '15', 2015, '2016-09-06 13:38:24'),
(2, '16', 2016, '2016-09-06 13:38:28'),
(3, '17', 2017, '2016-09-06 13:38:32'),
(4, '14', 2014, '2016-09-17 11:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `m_siswa`
--

CREATE TABLE IF NOT EXISTS `m_siswa` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) NOT NULL,
  `kode_identitas` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(11) NOT NULL,
  `kelas` int(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `m_siswa`
--

INSERT INTO `m_siswa` (`id`, `nama_siswa`, `kode_identitas`, `jenis_kelamin`, `kelas`, `timestamp`) VALUES
(3, 'ALFIAN PERMANA', '1014005002', 'L', 2, '2016-10-01 09:11:36'),
(4, 'AMALIA OKTAVIANI', '1014005003', 'L', 2, '2016-10-01 09:11:36'),
(5, 'ANDNAN PERDINANTO TAMBA', '1014005004', 'L', 2, '2016-10-01 09:11:36'),
(6, 'ANGGI AERLANGGA SAPUTRA', '1014005005', 'L', 2, '2016-10-01 09:11:36'),
(7, 'BERLIAND OCTA ZULFIKAR', '1014005006', 'L', 2, '2016-10-01 09:11:36'),
(8, 'BIMA ZAHLUTFI', '1014005007', 'L', 2, '2016-10-01 09:11:36'),
(9, 'BOBY KUBUS KUNDA', '1014005008', 'L', 2, '2016-10-01 09:11:36'),
(10, 'CITRA SALFIRA ', '1014005009', 'L', 2, '2016-10-01 09:11:36'),
(11, 'DIMAS SATYA FIRNANDA', '1014005010', 'L', 2, '2016-10-01 09:11:36'),
(12, 'DWIKA ARDYAN FEBRIANSYAH', '1014005011', 'L', 2, '2016-10-01 09:11:36'),
(13, 'EGGY RAYFALDO', '1014005012', 'L', 2, '2016-10-01 09:11:36'),
(14, 'FADILLA AFIFAH NUR', '1014005013', 'L', 2, '2016-10-01 09:11:36'),
(15, 'FAHMAN FAISAL', '1014005014', 'L', 2, '2016-10-01 09:11:37'),
(16, 'FAISYAL ACHMAD NURWIJAYA', '1014005015', 'L', 2, '2016-10-01 09:11:37'),
(17, 'IRSYAD ABDUL ROJAK', '1014005016', 'L', 2, '2016-10-01 09:11:37'),
(18, 'MARIA ESTER AGUSTINA', '1014005017', 'L', 2, '2016-10-01 09:11:37'),
(19, 'MAULANA GHIFARI', '1014005018', 'L', 2, '2016-10-01 09:11:37'),
(20, 'MEIDINA LARASWATI', '1014005019', 'L', 2, '2016-10-01 09:11:37'),
(21, 'MUHAMMAD DAFFA ALFADIRA', '1014005020', 'L', 2, '2016-10-01 09:11:37'),
(22, 'MUHAMMAD KAMARUZZAMAN', '1014005021', 'L', 2, '2016-10-01 09:11:37'),
(23, 'NURZILA AULIA', '1014005022', 'L', 2, '2016-10-01 09:11:37'),
(24, 'OSSA ABDI PRATAMA', '1014005023', 'L', 2, '2016-10-01 09:11:37'),
(25, 'PUTRI WARIYANTI', '1014005024', 'L', 2, '2016-10-01 09:11:37'),
(26, 'REZZA HEYDAR UMMAR ALWIE', '1014005025', 'L', 2, '2016-10-01 09:11:37'),
(27, 'RIFQI WILDANI', '1014005026', 'L', 2, '2016-10-01 09:11:37'),
(28, 'RISENDI MUHAMMAD FAUZI', '1014005027', 'L', 2, '2016-10-01 09:11:37'),
(29, 'SATRIA MEGADHARMA PUTRA', '1014005028', 'L', 2, '2016-10-01 09:11:37'),
(30, 'SATRIO MUHAROM HARYANTO', '1014005029', 'L', 2, '2016-10-01 09:11:37'),
(31, 'WISNU AJI PRATAMA', '1014005030', 'L', 2, '2016-10-01 09:11:38'),
(32, 'YUPAN JULIASPEN', '1014005031', 'L', 2, '2016-10-01 09:11:38'),
(33, 'YUSUF OKA MAHENDRA', '1014005032', 'L', 2, '2016-10-01 09:11:38'),
(34, 'ACHMAD FIRDAUS', '1014005065', 'L', 5, '2016-10-01 14:24:27'),
(35, 'AELEN PRITI KURNIA', '1014005066', 'L', 5, '2016-10-01 14:24:27'),
(36, 'AHMAD FAUZI', '1014005067', 'L', 5, '2016-10-01 14:24:27'),
(37, 'ALDHY RIANSYAH SUDERI', '1014005068', 'L', 5, '2016-10-01 14:24:27'),
(38, 'ANAS DWI WICAKSONO', '1014005069', 'L', 5, '2016-10-01 14:24:27'),
(39, 'ANI SAPUTRI', '1014005070', 'L', 5, '2016-10-01 14:24:27'),
(40, 'FABIAN ADAM', '1014005071', 'L', 5, '2016-10-01 14:24:28'),
(41, 'FALIH FADHIL AKBAR UTOMO', '1014005072', 'L', 5, '2016-10-01 14:24:28'),
(42, 'FATIMA ZAHRA', '1014005073', 'L', 5, '2016-10-01 14:24:28'),
(43, 'IAN DARMAWAN', '1014005074', 'L', 5, '2016-10-01 14:24:28'),
(44, 'IQBAL DESRYAN RAMADHAN', '1014005075', 'L', 5, '2016-10-01 14:24:28'),
(45, 'ISNAYNI RIZKA FATIHANI', '1014005076', 'L', 5, '2016-10-01 14:24:28'),
(46, 'JOSEYONATHAN', '1014005077', 'L', 5, '2016-10-01 14:24:28'),
(47, 'KARINA YULIA HERMAWATI', '1014005078', 'L', 5, '2016-10-01 14:24:28'),
(48, 'LAILA PUTRI GUSTI', '1014005079', 'L', 5, '2016-10-01 14:24:28'),
(49, 'M FIRDAUS RACHMATULLAH', '1014005080', 'L', 5, '2016-10-01 14:24:28'),
(50, 'MAHESTA RIZKITANINGRUM', '1014005081', 'L', 5, '2016-10-01 14:24:28'),
(51, 'MOCH MEIZAR ARIEF', '1014005082', 'L', 5, '2016-10-01 14:24:28'),
(52, 'MUHAMAD LAZUARDI RIZKI FIRMANSYAH', '1014005083', 'L', 5, '2016-10-01 14:24:28'),
(53, 'MUHAMMAD ADITYA WICAKSONO', '1014005084', 'L', 5, '2016-10-01 14:24:28'),
(54, 'MUHAMMAD AGUNG SHOLEHUDIN', '1014005085', 'L', 5, '2016-10-01 14:24:28'),
(55, 'MUHAMMAD AL GHIFARI', '1014005086', 'L', 5, '2016-10-01 14:24:28'),
(56, 'MUHAMMAD DIRJA KAMALUDIN', '1014005087', 'L', 5, '2016-10-01 14:24:28'),
(57, 'MUHAMMAD ZEDAN RIZQIYA', '1014005088', 'L', 5, '2016-10-01 14:24:28'),
(58, 'NUR ALWI', '1014005089', 'L', 5, '2016-10-01 14:24:28'),
(59, 'NURUL QURNIA RAMADHANTI', '1014005090', 'L', 5, '2016-10-01 14:24:28'),
(60, 'PRAYOGA FAHLUL HIDAYAT', '1014005091', 'L', 5, '2016-10-01 14:24:28'),
(61, 'RENALDO ALFIAN', '1014005092', 'L', 5, '2016-10-01 14:24:28'),
(62, 'RIZKI ADITIYA', '1014005093', 'L', 5, '2016-10-01 14:24:28'),
(63, 'SAHRUL RAJAB', '1014005094', 'L', 5, '2016-10-01 14:24:28'),
(64, 'SARAH PUTRI NOER', '1014005095', 'L', 5, '2016-10-01 14:24:29'),
(65, 'SAVIRA RAHMA JULITA', '1014005096', 'L', 5, '2016-10-01 14:24:29'),
(66, 'SOFIATUN NISSA', '1014005097', 'L', 5, '2016-10-01 14:24:29'),
(67, 'SYIFFA RADHITYA INDRASARI', '1014005098', 'L', 5, '2016-10-01 14:24:29'),
(68, 'VALDI RANDITA PUTRA', '1014005099', 'L', 5, '2016-10-01 14:24:29');

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
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `t_nilai`
--

INSERT INTO `t_nilai` (`id`, `id_mata_pelajaran`, `id_siswa`, `id_guru`, `id_semester`, `nilai`, `timestamp`) VALUES
(1, 7, 4, 2, 2, 80, '2016-10-01 14:01:25'),
(2, 7, 4, 2, 1, 80, '2016-10-01 14:01:27'),
(3, 5, 34, 1, 2, 56, '2016-10-02 04:52:41'),
(4, 5, 35, 1, 2, 66, '2016-10-02 04:52:41'),
(5, 5, 36, 1, 2, 89, '2016-10-02 04:52:41'),
(6, 5, 37, 1, 2, 45, '2016-10-02 04:52:41'),
(7, 5, 38, 1, 2, 89, '2016-10-02 04:52:41'),
(8, 5, 39, 1, 2, 70, '2016-10-02 04:52:41'),
(9, 5, 40, 1, 2, 75, '2016-10-02 04:52:41'),
(10, 5, 41, 1, 2, 80, '2016-10-02 04:52:41'),
(11, 5, 42, 1, 2, 60, '2016-10-02 04:52:41'),
(12, 5, 43, 1, 2, 97, '2016-10-02 04:52:41'),
(13, 5, 44, 1, 2, 95, '2016-10-02 04:52:41'),
(14, 5, 45, 1, 2, 80, '2016-10-02 03:36:07'),
(15, 5, 46, 1, 2, 70, '2016-10-02 04:52:41'),
(16, 5, 47, 1, 2, 55, '2016-10-02 04:52:41'),
(17, 5, 48, 1, 2, 30, '2016-10-02 04:52:41'),
(18, 5, 49, 1, 2, 25, '2016-10-02 04:52:41'),
(19, 5, 50, 1, 2, 14, '2016-10-02 04:52:41'),
(20, 5, 51, 1, 2, 0, '2016-10-02 01:34:13'),
(21, 5, 52, 1, 2, 0, '2016-10-02 01:34:13'),
(22, 5, 53, 1, 2, 0, '2016-10-02 01:34:13'),
(23, 5, 54, 1, 2, 0, '2016-10-02 01:34:13'),
(24, 5, 55, 1, 2, 0, '2016-10-02 01:34:13'),
(25, 5, 56, 1, 2, 0, '2016-10-02 01:34:13'),
(26, 5, 57, 1, 2, 0, '2016-10-02 01:34:13'),
(27, 5, 58, 1, 2, 0, '2016-10-02 01:34:13'),
(28, 5, 59, 1, 2, 0, '2016-10-02 01:34:13'),
(29, 5, 60, 1, 2, 0, '2016-10-02 01:34:13'),
(30, 5, 61, 1, 2, 0, '2016-10-02 01:34:14'),
(31, 5, 62, 1, 2, 0, '2016-10-02 01:34:14'),
(32, 5, 63, 1, 2, 0, '2016-10-02 01:34:14'),
(33, 5, 64, 1, 2, 0, '2016-10-02 01:34:14'),
(34, 5, 65, 1, 2, 0, '2016-10-02 01:34:14'),
(35, 5, 66, 1, 2, 0, '2016-10-02 01:34:14'),
(36, 5, 67, 1, 2, 0, '2016-10-02 01:34:14'),
(37, 5, 68, 1, 2, 0, '2016-10-02 01:34:14');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
