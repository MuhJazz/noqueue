-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2021 at 02:25 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

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
-- Table structure for table `admin_resto`
--

CREATE TABLE `admin_resto` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(24) NOT NULL,
  `admin_password` varchar(24) NOT NULL,
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_resto`
--

INSERT INTO `admin_resto` (`admin_id`, `admin_username`, `admin_password`, `res_id`) VALUES
(11, 'taican', '1111', 3),
(12, 'owl_admin_321', '321', 2);

-- --------------------------------------------------------

--
-- Table structure for table `meja_resto`
--

CREATE TABLE `meja_resto` (
  `meja_id` int(11) NOT NULL,
  `meja_name` varchar(64) NOT NULL,
  `meja_status` varchar(255) NOT NULL,
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meja_resto`
--

INSERT INTO `meja_resto` (`meja_id`, `meja_name`, `meja_status`, `res_id`) VALUES
(4, 'owl table 1', 'free', 2),
(5, 'owl table 2', 'free', 2),
(6, 'owl table 3', 'free', 2),
(7, 'owl table 4', 'free', 2),
(8, 'summa table 1', 'free', 6);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(64) NOT NULL,
  `menu_price` int(24) NOT NULL,
  `menu_desc` varchar(255) NOT NULL,
  `menu_image` varchar(255) NOT NULL,
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_price`, `menu_desc`, `menu_image`, `res_id`) VALUES
(1, 'Sate Bakar', 20000, 'Sate ayam lezat dengan proses pembakaran', '5f1fdcdacafc4.jpg', 1),
(2, 'Spaghetti Carbonara', 32000, 'Spaghetti dengan keju enak', 'Espaguetis_carbonara.jpg', 2),
(3, 'Nasi Goreng Kambing', 15000, 'Nasi Goreng dengan daging kambing penuh rempah', '5f211052c70f7.jpg', 4),
(4, 'Sate Ayam Bumbu Kacang', 18000, 'Sate Ayam yang dibakar ditambah dengan bumbu kacang penuh rasa', 'sate-ayam-bumbu-kacang-foto-resep-utama.jpg', 3),
(5, 'Beef Wellington', 150000, 'Beef Wellington terkenal di seluruh dunia', 'image1.jpg', 2),
(6, 'Beef Wellington', 20000, 'Beef Wellington terkenal di seluruh dunia', 'Beef-wellington-d4f3320.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE `menu_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `r_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`category_id`, `category_name`, `r_id`) VALUES
(27, 'Minuman', 2),
(28, 'Makanan', 2),
(31, 'Makanan Berat', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_menu_resto`
--

CREATE TABLE `order_menu_resto` (
  `order_menu_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_price` int(24) NOT NULL,
  `menu_qty` int(64) NOT NULL,
  `rest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_menu_resto`
--

INSERT INTO `order_menu_resto` (`order_menu_id`, `order_id`, `menu_id`, `menu_price`, `menu_qty`, `rest_id`) VALUES
(38, 62, 6, 20000, 3, 6),
(56, 80, 6, 20000, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `order_resto`
--

CREATE TABLE `order_resto` (
  `order_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_user` varchar(64) NOT NULL,
  `order_total` int(24) NOT NULL,
  `order_payment` varchar(255) NOT NULL,
  `order_meja` int(11) NOT NULL,
  `order_waktu` varchar(24) NOT NULL,
  `order_catatan` varchar(255) NOT NULL,
  `order_bukti_bayar` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_resto`
--

INSERT INTO `order_resto` (`order_id`, `res_id`, `order_date`, `order_user`, `order_total`, `order_payment`, `order_meja`, `order_waktu`, `order_catatan`, `order_bukti_bayar`, `order_status`) VALUES
(62, 6, '2021-06-09', 'blodek', 60000, 'gopay', 8, '18.30', 'medium rare', 'images.png', 'sedang verif'),
(80, 6, '2021-06-09', 'blodek', 40000, 'gopay', 8, '18.30', 'medium rare', 'Gaming_5000x3125.jpg', 'sedang verif');

-- --------------------------------------------------------

--
-- Table structure for table `restoran`
--

CREATE TABLE `restoran` (
  `resto_id` int(11) NOT NULL,
  `resto_name` varchar(24) NOT NULL,
  `resto_address` varchar(64) NOT NULL,
  `resto_number` varchar(20) NOT NULL,
  `resto_image` varchar(255) NOT NULL,
  `resto_open` varchar(24) NOT NULL,
  `resto_rating` int(11) NOT NULL,
  `qr_ovo` varchar(255) NOT NULL,
  `qr_gopay` varchar(255) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restoran`
--

INSERT INTO `restoran` (`resto_id`, `resto_name`, `resto_address`, `resto_number`, `resto_image`, `resto_open`, `resto_rating`, `qr_ovo`, `qr_gopay`, `loc_id`, `status_id`) VALUES
(1, 'cikenti', 'Jl. Babakan Raya', '082838281921', 'resto1.jpeg', '09.00-21.00', 0, '', '', 3, 0),
(2, 'owl', 'Jl. Perwira', '08237323281', 'resto2.jpeg', '10.00-21.00', 0, '', '', 2, 0),
(3, 'taican', 'Jl. Tebet Timur', '08123321921', 'resto3.jpeg', '10.00-20.00', 0, '', '', 4, 0),
(4, 'eater', 'Jl. Summarecon', '085263281921', 'resto4.jpeg', '07.00-23.00', 0, '', '', 5, 0),
(6, 'Summa', 'Jl. Summarecon 22', '08283824242', 'res_img.jpg', '10.00-21.00', 0, 'qr-code.png', 'qr-code-2.png', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `restoran_loc`
--

CREATE TABLE `restoran_loc` (
  `loc_id` int(11) NOT NULL,
  `loc_name` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restoran_loc`
--

INSERT INTO `restoran_loc` (`loc_id`, `loc_name`) VALUES
(2, 'Depok'),
(3, 'Bogor'),
(4, 'Jakarta'),
(5, 'Bekasi');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'buka'),
(2, 'tutup');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `no_hp`, `user_image`) VALUES
(1, 'Narto', 'blodek', 'daffa.schrub@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '087782374698', 'Gaming_5000x3125.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_resto`
--
ALTER TABLE `admin_resto`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `FK_Res_Id` (`res_id`);

--
-- Indexes for table `meja_resto`
--
ALTER TABLE `meja_resto`
  ADD PRIMARY KEY (`meja_id`),
  ADD KEY `FK_Restoran_Id` (`res_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `FK_Resto_Id` (`res_id`);

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `FK_R_Id_Cat` (`r_id`);

--
-- Indexes for table `order_menu_resto`
--
ALTER TABLE `order_menu_resto`
  ADD PRIMARY KEY (`order_menu_id`),
  ADD KEY `FK_Order_Id` (`order_id`),
  ADD KEY `FK_Menu_Id` (`menu_id`),
  ADD KEY `FK_Restor_Id` (`rest_id`);

--
-- Indexes for table `order_resto`
--
ALTER TABLE `order_resto`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_Meja_Id` (`order_meja`),
  ADD KEY `FK_Rst_id` (`res_id`);

--
-- Indexes for table `restoran`
--
ALTER TABLE `restoran`
  ADD PRIMARY KEY (`resto_id`),
  ADD KEY `FK_Resto_Loc` (`loc_id`);

--
-- Indexes for table `restoran_loc`
--
ALTER TABLE `restoran_loc`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_resto`
--
ALTER TABLE `admin_resto`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `meja_resto`
--
ALTER TABLE `meja_resto`
  MODIFY `meja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_menu_resto`
--
ALTER TABLE `order_menu_resto`
  MODIFY `order_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `order_resto`
--
ALTER TABLE `order_resto`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `restoran`
--
ALTER TABLE `restoran`
  MODIFY `resto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restoran_loc`
--
ALTER TABLE `restoran_loc`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_resto`
--
ALTER TABLE `admin_resto`
  ADD CONSTRAINT `FK_Res_Id` FOREIGN KEY (`res_id`) REFERENCES `restoran` (`resto_id`);

--
-- Constraints for table `meja_resto`
--
ALTER TABLE `meja_resto`
  ADD CONSTRAINT `FK_Restoran_Id` FOREIGN KEY (`res_id`) REFERENCES `restoran` (`resto_id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_Resto_Id` FOREIGN KEY (`res_id`) REFERENCES `restoran` (`resto_id`);

--
-- Constraints for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD CONSTRAINT `FK_R_Id_Cat` FOREIGN KEY (`r_id`) REFERENCES `restoran` (`resto_id`);

--
-- Constraints for table `order_menu_resto`
--
ALTER TABLE `order_menu_resto`
  ADD CONSTRAINT `FK_Menu_Id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`),
  ADD CONSTRAINT `FK_Order_Id` FOREIGN KEY (`order_id`) REFERENCES `order_resto` (`order_id`),
  ADD CONSTRAINT `FK_Restor_Id` FOREIGN KEY (`rest_id`) REFERENCES `restoran` (`resto_id`);

--
-- Constraints for table `order_resto`
--
ALTER TABLE `order_resto`
  ADD CONSTRAINT `FK_Meja_Id` FOREIGN KEY (`order_meja`) REFERENCES `meja_resto` (`meja_id`),
  ADD CONSTRAINT `FK_Rst_id` FOREIGN KEY (`res_id`) REFERENCES `restoran` (`resto_id`);

--
-- Constraints for table `restoran`
--
ALTER TABLE `restoran`
  ADD CONSTRAINT `FK_Resto_Loc` FOREIGN KEY (`loc_id`) REFERENCES `restoran_loc` (`loc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
