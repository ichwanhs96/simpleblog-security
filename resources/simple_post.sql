-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Feb 2016 pada 17.52
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
  `komentar` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `info_komentar`
--

INSERT INTO `info_komentar` (`ID`, `komentar`, `date`, `user_id`) VALUES
(0, 'iya nih kangen~', '2016-02-23 19:45:07', 0),
(1, 'iya nih kangen~', '2016-02-23 19:45:07', 0),
(1, 'halo!', '2016-02-23 19:45:07', 0),
(1, 'imba lah make ajax! oTL', '2016-02-23 19:45:07', 0),
(5, 'tes komentar!', '2016-02-23 19:45:07', 0),
(1, 'implementasi fingerprint~', '2016-02-23 19:45:07', 0),
(7, 'tes komentar', '2016-02-24 16:38:31', 40),
(7, 'tes', '2016-02-24 16:39:28', 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_post`
--

CREATE TABLE `info_post` (
  `ID` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `konten` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `info_post`
--

INSERT INTO `info_post` (`ID`, `judul`, `konten`, `tanggal`, `user_id`) VALUES
(1, 'halo!', 'Halo lama tidak berjumpa simpleblog ^_^', '2016-02-23 20:33:53', 39),
(7, 'tes11', 'tes11', '2016-02-24 07:13:28', 40),
(8, 'halo', 'halo halo halo', '2016-02-24 16:52:10', 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` text NOT NULL,
  `token` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `token`) VALUES
(39, 'tes@tes.com', '$2y$11$FHBK.nnI/Y.n.Mf6rYvv5u94l7Ku.ONU9NSPScDSTNORPuB3263FK', 'c207f9dc5f5f23a76b774607b2199ced'),
(40, 'ichwan@gmail.com', '79d1dc29d89e51ccc7a00999f6740a0ef38c18b2c29fa74976a598408d451c42', NULL);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
