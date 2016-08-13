-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2016 at 02:04 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_makesmile`
--
CREATE DATABASE IF NOT EXISTS `db_makesmile` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_makesmile`;

-- --------------------------------------------------------

--
-- Table structure for table `clothes`
--

CREATE TABLE `clothes` (
  `id_item` int(11) NOT NULL,
  `item_title` varchar(50) NOT NULL,
  `item_description` varchar(250) NOT NULL,
  `item_picture` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clothes`
--

INSERT INTO `clothes` (`id_item`, `item_title`, `item_description`, `item_picture`, `date`, `id_user`) VALUES
(1, 'new clothes test', 'new test', '2016-07-19-11-00-58.png', '2016-07-19 09:01:12', 1),
(2, 'ne wtest', '                        asdqweqw                                                    ', '2016-07-19-11-09-20.png', '2016-07-19 09:09:30', 1),
(3, 'jessica test', 'a new test jessica', '2016-07-19-13-51-42.png', '2016-07-19 11:52:03', 2),
(4, 'mimo test', 'asdqwe', '2016-07-20-17-22-42.png', '2016-07-20 15:22:54', 1),
(5, 'newww', 'asd                                                                            ', '2016-07-20-17-23-00.png', '2016-07-20 15:23:05', 1),
(6, 'zd test', 'asdqwe                                                 ', '2016-08-09-22-26-54.png', '2016-08-09 20:27:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `decoration`
--

CREATE TABLE `decoration` (
  `id_item` int(11) NOT NULL,
  `item_title` varchar(50) NOT NULL,
  `item_description` varchar(250) NOT NULL,
  `item_picture` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `electronic`
--

CREATE TABLE `electronic` (
  `id_item` int(11) NOT NULL,
  `item_title` varchar(50) NOT NULL,
  `item_description` varchar(250) NOT NULL,
  `item_picture` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `electronic`
--

INSERT INTO `electronic` (`id_item`, `item_title`, `item_description`, `item_picture`, `date`, `id_user`) VALUES
(1, 'new test', 'asdqwe                                                                            ', '2016-07-21-10-25-35.png', '2016-07-21 08:25:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `id_item` int(11) NOT NULL,
  `item_title` varchar(50) NOT NULL,
  `item_description` varchar(250) NOT NULL,
  `item_picture` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id_table` int(11) NOT NULL,
  `table_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id_table`, `table_name`) VALUES
(0, 'clothes'),
(1, 'decoration'),
(2, 'electronic'),
(3, 'other');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `number` varchar(20) NOT NULL,
  `image_source` varchar(200) NOT NULL,
  `address` varchar(100) NOT NULL,
  `addNumber` int(20) NOT NULL,
  `complement` varchar(20) NOT NULL,
  `CEP` varchar(10) NOT NULL,
  `country` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `name`, `lastname`, `gender`, `email`, `number`, `image_source`, `address`, `addNumber`, `complement`, `CEP`, `country`, `state`, `city`) VALUES
(1, 'rabahzein', '8dd51e63c7b632e5300f7a344da701f1', 'rabah', 'zeineddine', 'male', 'rabah.zeineddine@hotmail.com', '(11) 94996-6817', '2016-05-16-14-14-02.png', 'rua aragao', 1068, 'casa', '02308-001', 'brazil', 'sp', 'sao paulo'),
(2, 'jessicaYumi', '8dd51e63c7b632e5300f7a344da701f1', 'jessica', 'yumii', 'female', 'jessica@gmail.com', '(11) 11111-1111', '2016-05-18-03-09-08.png', 'rua jessica', 1111, '', '02301-123', 'brazil', 'sp', 'sao paulo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clothes`
--
ALTER TABLE `clothes`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `decoration`
--
ALTER TABLE `decoration`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `electronic`
--
ALTER TABLE `electronic`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id_table`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clothes`
--
ALTER TABLE `clothes`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `decoration`
--
ALTER TABLE `decoration`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `electronic`
--
ALTER TABLE `electronic`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `other`
--
ALTER TABLE `other`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id_table` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `clothes`
--
ALTER TABLE `clothes`
  ADD CONSTRAINT `clothes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `decoration`
--
ALTER TABLE `decoration`
  ADD CONSTRAINT `decoration_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `electronic`
--
ALTER TABLE `electronic`
  ADD CONSTRAINT `electronic_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `other`
--
ALTER TABLE `other`
  ADD CONSTRAINT `other_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
