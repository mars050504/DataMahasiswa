-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2023 pada 15.08
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datamahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_mhs`
--

CREATE TABLE `data_mhs` (
  `id_mahasiswa` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Tahun_Masuk` date NOT NULL,
  `Prodi` varchar(100) NOT NULL,
  `UKT` double NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_mhs`
--

INSERT INTO `data_mhs` (`id_mahasiswa`, `Nama`, `Tahun_Masuk`, `Prodi`, `UKT`, `Alamat`, `Email`) VALUES
(1, 'Moh. Mario Subagioo', '2022-07-07', 'Teknik Informatika', 5000000, 'Besuki', 'mariosubagio@gmail.com'),
(214, 'Harper Garcia', '2019-02-25', 'Manajemen Informatika', 12000000, 'Surabaya', 'harper.garcia@example.com'),
(215, 'Aria Robinson', '2020-10-12', 'Pendidikan Bahasa Inggris', 16000000, 'Jakarta', 'aria.robinson@example.com'),
(216, 'Leo Smith', '2021-04-05', 'Akuntansi', 11000000, 'Yogyakarta', 'leo.smith@example.com'),
(217, 'Stella Kim', '2019-09-20', 'Pendidikan Seni Rupa', 13000000, 'Bandung', 'stella.kim@example.com'),
(218, 'Zachary Li', '2020-01-13', 'Agroteknologi', 19000000, 'Semarang', 'zachary.li@example.com'),
(219, 'Nova White', '2022-07-26', 'Kedokteran', 18000000, 'Surabaya', 'nova.white@example.com'),
(220, 'Mason Thomas', '2019-04-09', 'Teknik Kimia', 11000000, 'Makassar', 'mason.thomas@example.com'),
(309, 'Sofia Perez', '2020-08-14', 'Pendidikan Pancasila dan Kewarganegaraan', 14000000, 'Semarang', 'sofia.perez@example.com'),
(310, 'Elijah Johnson', '2021-02-07', 'Teknik Mesin', 16000000, 'Bandung', 'elijah.johnson@example.com'),
(311, 'Aurora Garcia', '2019-10-13', 'Keperawatan', 1500000, 'Yogyakarta', 'aurora.garcia@example.com'),
(312, 'Eliana Martin', '2020-07-26', 'Teknik Lingkungan', 14000000, 'Jakarta', 'eliana.martin@example.com'),
(313, 'Parker Turner', '2021-05-11', 'Ilmu Komputer', 18000000, 'Surabaya', 'parker.turner@example.com'),
(410, 'Lily Brown', '2020-04-20', 'Manajemen Sumber Daya Manusia', 12000000, 'Semarang', 'lily.brown@example.com'),
(501, 'Oliver Lewis', '2022-01-08', 'Pendidikan Fisika', 17000000, 'Yogyakarta', 'oliver.lewis@example.com'),
(502, 'Eva Rodriguez', '2019-11-25', 'Pendidikan Biologi', 13000000, 'Semarang', 'eva.rodriguez@example.com'),
(503, 'Peyton Harris', '2020-09-10', 'Teknik Industri', 12000000, 'Jakarta', 'peyton.harris@example.com'),
(504, 'Skylar Martinez', '2021-03-27', 'Teknik Elektro', 15000000, 'Surabaya', 'skylar.martinez@example.com'),
(505, 'Lucas Taylor', '2019-06-12', 'Ilmu Hubungan Internasional', 19000000, 'Bandung', 'lucas.taylor@example.com'),
(506, 'Aria Robinson', '2020-02-18', 'Agribisnis', 16000000, 'Makassar', 'aria.robinson@example.com'),
(507, 'Levi Kim', '2021-08-05', 'Pendidikan Matematika', 11000000, 'Yogyakarta', 'levi.kim@example.com'),
(508, 'Grace Li', '2019-03-21', 'Psikologi', 13000000, 'Surabaya', 'grace.li@example.com'),
(509, 'Daniel White', '2020-11-05', 'Teknik Kimia', 18000000, 'Bandung', 'daniel.white@example.com'),
(510, 'Isabella Brown', '2021-06-20', 'Akuntansi', 12000000, 'Jakarta', 'isabella.brown@example.com'),
(609, 'Lucas Perez', '2020-12-17', 'Ilmu Komunikasi', 15000000, 'Semarang', 'lucas.perez@example.com'),
(610, 'Zoe Johnson', '2021-05-02', 'Sosiologi', 14000000, 'Yogyakarta', 'zoe.johnson@example.com'),
(611, 'Mila Garcia', '2019-09-08', 'Pendidikan Bahasa Indonesia', 1100000, 'Surabaya', 'mila.garcia@example.com'),
(612, 'Michael Turner', '2020-07-23', 'Hukum', 14000000, 'Makassar', 'michael.turner@example.com'),
(613, 'Natalie Lewis', '2021-04-09', 'Manajemen Informatika', 18000000, 'Jakarta', 'natalie.lewis@example.com'),
(710, 'Emma Smith', '2019-12-24', 'Ilmu Politik', 16000000, 'Bandung', 'emma.smith@example.com'),
(801, 'Budi Susanto', '2022-01-08', 'Pendidikan Fisika', 17000000, 'Yogyakarta', 'budi.susanto@example.com'),
(802, 'Dewi Rahayu', '2019-11-25', 'Pendidikan Biologi', 13000000, 'Semarang', 'dewi.rahayu@example.com'),
(803, 'Putra Ramadhan', '2020-09-10', 'Teknik Industri', 12000000, 'Jakarta', 'putra.ramadhan@example.com'),
(804, 'Siti Nurlela', '2021-03-27', 'Teknik Elektro', 15000000, 'Surabaya', 'siti.nurlela@example.com'),
(805, 'Agus Pranoto', '2019-06-12', 'Ilmu Hubungan Internasional', 19000000, 'Bandung', 'agus.pranoto@example.com'),
(806, 'Ani Suryani', '2020-02-18', 'Agribisnis', 16000000, 'Makassar', 'ani.suryani@example.com'),
(807, 'Levi Kim', '2021-08-05', 'Pendidikan Matematika', 11000000, 'Yogyakarta', 'levi.kim@example.com'),
(808, 'Siti Grace', '2019-03-21', 'Psikologi', 13000000, 'Surabaya', 'siti.grace@example.com'),
(809, 'Dani Setiawan', '2020-11-05', 'Teknik Kimia', 18000000, 'Bandung', 'dani.setiawan@example.com'),
(810, 'Ira Yanti', '2021-06-20', 'Akuntansi', 12000000, 'Jakarta', 'ira.yanti@example.com'),
(909, 'Lucas Prasetyo', '2020-12-17', 'Ilmu Komunikasi', 15000000, 'Semarang', 'lucas.prasetyo@example.com'),
(910, 'Zoe Aditiya', '2021-05-02', 'Sosiologi', 14000000, 'Yogyakarta', 'zoe.aditiya@example.com'),
(911, 'Mila Handayani', '2019-09-08', 'Pendidikan Bahasa Indonesia', 1100000, 'Surabaya', 'mila.handayani@example.com'),
(912, 'Michael Wibowo', '2020-07-23', 'Hukum', 14000000, 'Makassar', 'michael.wibowo@example.com'),
(913, 'Natalie Kusuma', '2021-04-09', 'Manajemen Informatika', 18000000, 'Jakarta', 'natalie.kusuma@example.com'),
(1010, 'Emma Santoso', '2019-12-24', 'Ilmu Politik', 16000000, 'Bandung', 'emma.santoso@example.com'),
(2019, 'Muh Ardani Syabilla', '2023-07-05', 'Teknik Informatika', 5000000, 'Paiton', 'Ardanisyabilla@gmail.com'),
(2876, 'Velian Praptoni', '2022-06-10', 'Teknik Informatika', 8000000, 'Besuki', 'velian81@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_mhs`
--
ALTER TABLE `data_mhs`
  ADD PRIMARY KEY (`id_mahasiswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
