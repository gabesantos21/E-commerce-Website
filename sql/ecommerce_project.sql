-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2021 at 12:21 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`productId`, `productName`, `productImage`, `price`) VALUES
(1, 'A Quiet Place', 'A Quiet Place.png', 10),
(2, 'Godzilla: King of the Monsters', 'Godzilla King of the Monsters.png', 13),
(3, 'Halo: The Fall of Reach', 'Halo The Fall of Reach.png', 12),
(4, 'Halo', 'Halo.png', 11),
(5, 'Kung Fu Panda 3', 'Kung Fu Panda 3.png', 13),
(6, 'Monster Hunter', 'Monster Hunter.png', 12),
(7, 'Raya and The Last Dragon', 'Raya and The Last Dragon.png', 12),
(8, 'The Great Wall', 'The Great Wall.png', 13),
(9, 'Zack Snyder\'s Justice League ', 'Zack Snyders Justice League.png', 13);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(750) NOT NULL,
  `password` varchar(750) NOT NULL,
  `firstname` varchar(750) NOT NULL,
  `middlename` varchar(750) NOT NULL,
  `lastname` varchar(750) NOT NULL,
  `suffix` varchar(750) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `suffix`, `address`) VALUES
(17, 'winore', '15749901c29fa4ca7f6d6fb5f8c243cb', 'winore', '', 'Grantusa', '', 'eeeee'),
(18, 'gabesantos21', '5b6e707f0244ed21f39a73eb125681dc', 'gabe', 'gamboa', 'santos', 'mr', 'block 1 lot 4, annex a'),
(19, 'huhuhuuh', '181105a73fc52365ed0d0d7216d3adfa', 'uhuhu', 'huhuhu', 'uhuh', 'h', ''),
(20, 'new', '9f4a66a0bac35d6f7f25b5fd931c7abe', 'new', 'ne', 'nw', 'n', 'newaddress'),
(34, 'admin', '0192023a7bbd73250516f069df18b500', 'admin', 'admin', 'admin', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
