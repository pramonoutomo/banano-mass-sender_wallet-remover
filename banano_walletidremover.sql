-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2021 at 03:57 PM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banano_walletidremover`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `wallets_add`(IN `wid` VARCHAR(150), IN `waddress` TEXT)
    NO SQL
INSERT INTO wallets (wallet_no,wallet_id,wallet_nodeaddress,wallet_destroydate,wallet_status) VALUES ('',wid,waddress,CURRENT_TIMESTAMP,1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wallets_getexpired`()
    NO SQL
SELECT * FROM wallets WHERE wallets.wallet_destroydate <= now() - INTERVAL 1 DAY AND wallets.wallet_status=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wallets_remove`(IN `wid` VARCHAR(150), IN `whash` VARCHAR(64))
    NO SQL
UPDATE wallets SET wallets.wallet_status=2,wallets.wallet_id=whash WHERE wallets.wallet_id=wid LIMIT 1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE IF NOT EXISTS `wallets` (
  `wallet_no` int(11) NOT NULL,
  `wallet_id` varchar(150) NOT NULL,
  `wallet_nodeaddress` text NOT NULL,
  `wallet_destroydate` datetime NOT NULL,
  `wallet_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`wallet_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `wallet_no` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
