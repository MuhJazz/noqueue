-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Bulan Mei 2021 pada 18.15
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
-- Struktur dari tabel `admin_resto`
--

CREATE TABLE `admin_resto` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(24) NOT NULL,
  `admin_password` varchar(24) NOT NULL,
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(64) NOT NULL,
  `menu_price` varchar(24) NOT NULL,
  `menu_desc` varchar(255) NOT NULL,
  `menu_image` varchar(255) NOT NULL,
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_price`, `menu_desc`, `menu_image`, `res_id`) VALUES
(1, 'Sate Bakar', 'Rp.15.000', 'Sate ayam lezat dengan proses pembakaran', '5f1fdcdacafc4.jpg', 1),
(2, 'Spaghetti Carbonara', 'Rp.42.000', 'Spaghetti dengan keju enak', 'Espaguetis_carbonara.jpg', 2),
(3, 'Nasi Goreng Kambing', 'Rp.23.000', 'Nasi Goreng dengan daging kambing penuh rempah', '5f211052c70f7.jpg', 4),
(4, 'Sate Ayam Bumbu Kacang', 'Rp.19.000', 'Sate Ayam yang dibakar ditambah dengan bumbu kacang penuh rasa', 'sate-ayam-bumbu-kacang-foto-resep-utama.jpg', 3);

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
  `resto_open` varchar(24) NOT NULL,
  `resto_rating` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `restoran`
--

INSERT INTO `restoran` (`resto_id`, `resto_name`, `resto_address`, `resto_number`, `resto_image`, `resto_open`, `resto_rating`, `loc_id`) VALUES
(1, 'cikenti', 'Jl. Babakan Raya', '082838281921', 'resto1.jpeg', '09.00-21.00', 0, 3),
(2, 'owl', 'Jl. Perwira', '08237323281', 'resto2.jpeg', '10.00-21.00', 0, 2),
(3, 'taican', 'Jl. Tebet Timur', '08123321921', 'resto3.jpeg', '10.00-20.00', 0, 4),
(4, 'eater', 'Jl. Summarecon', '085263281921', 'resto4.jpeg', '07.00-23.00', 0, 5);

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
  `no_hp` varchar(15) NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `no_hp`, `user_image`) VALUES
(1, 'test', 'blodek', 'daffa.schrub@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '087782374698', 'rasputin.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_resto`
--
ALTER TABLE `admin_resto`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `FK_Res_Id` (`res_id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `FK_Resto_Id` (`res_id`);

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
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `restoran`
--
ALTER TABLE `restoran`
  MODIFY `resto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `restoran_loc`
--
ALTER TABLE `restoran_loc`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin_resto`
--
ALTER TABLE `admin_resto`
  ADD CONSTRAINT `FK_Res_Id` FOREIGN KEY (`res_id`) REFERENCES `restoran` (`resto_id`);

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_Resto_Id` FOREIGN KEY (`res_id`) REFERENCES `restoran` (`resto_id`);

--
-- Ketidakleluasaan untuk tabel `restoran`
--
ALTER TABLE `restoran`
  ADD CONSTRAINT `FK_Resto_Loc` FOREIGN KEY (`loc_id`) REFERENCES `restoran_loc` (`loc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
