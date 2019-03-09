-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2019 at 10:46 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crudappvue`
--

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `userage` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `username`, `email`, `userage`, `image`) VALUES
(80, 'castro filler', 'razor@gmail.com', '45', '1552155668.jpg'),
(81, 'camara ignila', 'favor@gmail.com', '4532', '1552155721.jpg'),
(83, 'pascal brand', 'nnamdi@gmail.com', '43', '1552156698.jpg'),
(84, 'cazorla', 'santi@gmail.com', '23', '1552156746.jpg'),
(85, 'best deals ever', 'bestcar@gmail.com', '34', '1552156798.jpg'),
(86, 'early boy', 'earlydayscoding@gmail.com', '62', '1552156834.PNG'),
(87, 'jesus we love you too much', 'barack@gmail.com', '40', '1552156883.png'),
(88, 'techbuildz', 'techbuildz@gmail.com', '76', '1552156913.PNG'),
(89, 'frontier web', 'webginks@gmail.com', '35', '1552156946.PNG'),
(90, 'tester', 'tester@gmail.com', '34', '1552156986.JPG'),
(91, 'deeper things', 'testerdeeper@gmail.com', '34', '1552157021.jpg'),
(92, 'sekerenews@gmail.com', 'bascaro@gmail.com', '54', '1552167191.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
