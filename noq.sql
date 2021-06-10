-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 10:58 AM
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
(13, 'summarec', '1111', 6);

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
(14, 'summa table 1', 'free', 6),
(15, 'summa table 2', 'free', 6);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(64) NOT NULL,
  `menu_price` int(24) NOT NULL,
  `menu_image` varchar(255) NOT NULL,
  `res_id` int(11) NOT NULL,
  `categ_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(33, 'Makanan', 6),
(34, 'Minuman', 6);

-- --------------------------------------------------------

--
-- Table structure for table `order_menu_resto`
--

CREATE TABLE `order_menu_resto` (
  `order_menu_id` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_price` int(24) NOT NULL,
  `menu_qty` int(64) NOT NULL,
  `rest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `restoran`
--

CREATE TABLE `restoran` (
  `resto_id` int(11) NOT NULL,
  `resto_status` varchar(255) NOT NULL,
  `resto_name` varchar(24) NOT NULL,
  `resto_address` varchar(64) NOT NULL,
  `resto_number` varchar(20) NOT NULL,
  `resto_image` varchar(255) NOT NULL,
  `resto_open` varchar(24) NOT NULL,
  `qr_ovo` varchar(255) NOT NULL,
  `qr_gopay` varchar(255) NOT NULL,
  `loc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restoran`
--

INSERT INTO `restoran` (`resto_id`, `resto_status`, `resto_name`, `resto_address`, `resto_number`, `resto_image`, `resto_open`, `qr_ovo`, `qr_gopay`, `loc_id`) VALUES
(6, 'buka', 'Summa', 'Jl. Summarecon 22', '08283824242', 'res_img.jpg', '10.00-21.00', 'qr-code.png', 'qr-code-2.png', 5);

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
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `super_id` int(11) NOT NULL,
  `super_name` varchar(255) NOT NULL,
  `super_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`super_id`, `super_name`, `super_pass`) VALUES
(1, 'noq_super_admin', 'n0thingS');

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
  ADD KEY `FK_Resto_Id` (`res_id`),
  ADD KEY `FK_C_Id` (`categ_id`);

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
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`super_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `meja_resto`
--
ALTER TABLE `meja_resto`
  MODIFY `meja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `order_menu_resto`
--
ALTER TABLE `order_menu_resto`
  MODIFY `order_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `order_resto`
--
ALTER TABLE `order_resto`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `restoran`
--
ALTER TABLE `restoran`
  MODIFY `resto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `restoran_loc`
--
ALTER TABLE `restoran_loc`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `super_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `FK_C_Id` FOREIGN KEY (`categ_id`) REFERENCES `menu_category` (`category_id`),
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
