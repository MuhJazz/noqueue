-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Bulan Mei 2021 pada 11.38
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noq`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `restoran`
--

CREATE TABLE `restoran` (
  `resto_id` int(11) NOT NULL,
  `resto_name` varchar(24) NOT NULL,
  `resto_address` varchar(64) NOT NULL,
  `resto_number` varchar(20) NOT NULL,
  `resto_image` varchar(255) NOT NULL,
  `loc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `restoran_loc`
--

CREATE TABLE `restoran_loc` (
  `loc_id` int(11) NOT NULL,
  `loc_name` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `restoran_loc`
--

INSERT INTO `restoran_loc` (`loc_id`, `loc_name`) VALUES
(2, 'Depok'),
(3, 'Bogor'),
(4, 'Jakarta'),
(5, 'Bekasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `no_hp`) VALUES
(1, 'test', 'daffasubhan', 'daffa.schrub@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '087782374699'),
(2, 'Naruto', 'blodek', 'daffa.schrsssssub@gmail.com', '74b87337454200d4d33f80c4663dc5e5', '087782374698'),
(3, 'test', 'ssss', 'daffa.ssssschrub@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '087782374698'),
(4, '1121', 'ddddddd', 'daffa.ssssschsssrub@gmail.com', '11ddbaf3386aea1f2974eee984542152', '087782374698'),
(5, 'test', 'wwwww', 'daffa.schssssrub@gmail.com', 'e34a8899ef6468b74f8a1048419ccc8b', '087782374698');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `restoran`
--
ALTER TABLE `restoran`
  ADD PRIMARY KEY (`resto_id`),
  ADD KEY `FK_Resto_Loc` (`loc_id`);

--
-- Indeks untuk tabel `restoran_loc`
--
ALTER TABLE `restoran_loc`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `restoran`
--
ALTER TABLE `restoran`
  MODIFY `resto_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `restoran_loc`
--
ALTER TABLE `restoran_loc`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `restoran`
--
ALTER TABLE `restoran`
  ADD CONSTRAINT `FK_Resto_Loc` FOREIGN KEY (`loc_id`) REFERENCES `restoran_loc` (`loc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
