-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Agu 2021 pada 19.06
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolahdasar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelajaran`
--

CREATE TABLE `tbl_pelajaran` (
  `kd_pel` varchar(15) NOT NULL,
  `namapel` varchar(100) NOT NULL,
  `kkm` int(3) NOT NULL,
  `tipepel` varchar(30) NOT NULL,
  `tipeguru` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pelajaran`
--

INSERT INTO `tbl_pelajaran` (`kd_pel`, `namapel`, `kkm`, `tipepel`, `tipeguru`) VALUES
('MP-009', 'Bersosialisasi', 75, 'Sikap', 'Guru Kelas'),
('MP-010', 'Ekstrakulikuler', 75, 'Ekstrakulikuler', 'Guru Kelas'),
('MP-011', 'Saran-saran', 75, 'Saran-saran', 'Guru Kelas'),
('MP-012', 'Tinggi Badan', 75, 'Tinggi dan Berat Badan', 'Guru Kelas'),
('MP-013', 'Berat Badan', 75, 'Tinggi dan Berat Badan', 'Guru Kelas'),
('MP-014', 'Penglihatan', 75, 'Kondisi Kesehatan', 'Guru Kelas'),
('MP-015', 'Pendengaran', 75, 'Kondisi Kesehatan', 'Guru Kelas'),
('MP-016', 'Gigi', 75, 'Kondisi Kesehatan', 'Guru Kelas'),
('MP-017', 'SBdp', 75, 'Prestasi', 'Guru Kelas'),
('MP-018', 'PJOK', 75, 'Prestasi', 'Guru Kelas'),
('MP-019', 'Sakit', 75, 'Ketidak Hadiran', 'Guru Kelas'),
('MP-020', 'Izin', 75, 'Ketidak Hadiran', 'Guru Kelas'),
('MP-021', 'Tanpa Keterangan', 75, 'Ketidak Hadiran', 'Guru Kelas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_pelajaran`
--
ALTER TABLE `tbl_pelajaran`
  ADD PRIMARY KEY (`kd_pel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
