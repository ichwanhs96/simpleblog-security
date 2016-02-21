-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21 Feb 2016 pada 20.57
-- Versi Server: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_post`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_komentar`
--

CREATE TABLE `info_komentar` (
  `ID` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `komentar` text NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `info_komentar`
--

INSERT INTO `info_komentar` (`ID`, `nama`, `komentar`, `tanggal`, `waktu`) VALUES
(0, 'ichwan', 'iya nih kangen~', '2016-02-22', '02:24:16'),
(1, 'ichwan', 'iya nih kangen~', '2016-02-22', '02:33:35'),
(1, 'ichwan', 'halo!', '2016-02-22', '02:33:42'),
(1, 'ichwan', 'imba lah make ajax! oTL', '2016-02-22', '02:34:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_post`
--

CREATE TABLE `info_post` (
  `ID` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `konten` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `info_post`
--

INSERT INTO `info_post` (`ID`, `judul`, `konten`, `tanggal`) VALUES
(1, 'halo!', 'Halo lama tidak berjumpa simpleblog ^_^', '2016-02-23'),
(3, 'tes script', '<script>alert("woi")</script>', '2016-02-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info_post`
--
ALTER TABLE `info_post`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info_post`
--
ALTER TABLE `info_post`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
