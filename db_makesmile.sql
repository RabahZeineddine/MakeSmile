-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3308
-- Generation Time: 16-Maio-2016 às 15:02
-- Versão do servidor: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_makesmile`
--
CREATE DATABASE IF NOT EXISTS `db_makesmile` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_makesmile`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clothes`
--

CREATE TABLE IF NOT EXISTS `clothes` (
`id_clothe` int(11) NOT NULL,
  `item_title` varchar(50) NOT NULL,
  `item_description` varchar(250) NOT NULL,
  `item_picture` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `clothes`
--

INSERT INTO `clothes` (`id_clothe`, `item_title`, `item_description`, `item_picture`, `date`, `id_user`, `username`) VALUES
(5, 'item 1 ', 'test', '2016-05-16-14-19-35.png', '2016-05-16 12:51:08', 1, 'rabahzein'),
(6, 'item 2 ', 'test', '2016-05-16-14-52-47.png', '2016-05-16 12:53:03', 2, 'jessicaYumi'),
(7, 'rabah test 2', 'askdada\r\n\r\n', '2016-05-16-15-00-21.png', '2016-05-16 13:00:40', 1, 'rabahzein');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `name`, `lastname`, `gender`, `email`, `number`, `image_source`, `address`, `addNumber`, `complement`, `CEP`, `country`, `state`, `city`) VALUES
(1, 'rabahzein', 'rabah', 'rabah', 'zeineddine', 'male', 'rabah.zeineddine@hotmail.com', '(11) 94996-6817', '2016-05-16-14-14-02.png', 'rua aragao', 1068, 'casa', '02308-001', 'brazil', 'sp', 'sao paulo'),
(2, 'jessicaYumi', 'jessica', 'jessica', 'yumii', 'female', 'jessica@gmail.com', '(11) 11111-1111', '2016-05-16-14-42-23.png', 'rua jessica', 1111, '', '02301-123', 'brazil', 'sp', 'sao paulo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clothes`
--
ALTER TABLE `clothes`
 ADD PRIMARY KEY (`id_clothe`);

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
MODIFY `id_clothe` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
