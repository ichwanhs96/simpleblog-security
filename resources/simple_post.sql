-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22 Feb 2016 pada 03.36
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
(1, 'ichwan', 'imba lah make ajax! oTL', '2016-02-22', '02:34:03'),
(5, 'ichwan', 'tes komentar!', '2016-02-22', '08:06:30'),
(1, 'ichwan', 'implementasi fingerprint~', '2016-02-22', '08:40:09');

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
(3, 'tes script', '<script>alert("woi")</script>', '2016-02-23'),
(5, 'tes bikin post', 'halo guys!', '2016-02-23'),
(6, 'tes bikin post 2', 'tes bikin post lagi gan!', '2016-02-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` text NOT NULL,
  `token` text,
  `fingerprint` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `token`, `fingerprint`) VALUES
(39, 'tes@tes.com', '$2y$11$FHBK.nnI/Y.n.Mf6rYvv5u94l7Ku.ONU9NSPScDSTNORPuB3263FK', 'c207f9dc5f5f23a76b774607b2199ced', '63ec9d93dc7b8602ecfd16072d576d4d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info_post`
--
ALTER TABLE `info_post`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info_post`
--
ALTER TABLE `info_post`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
