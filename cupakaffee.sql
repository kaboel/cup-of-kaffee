-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2018 at 10:10 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cupakaffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `dt_cart`
--

CREATE TABLE `dt_cart` (
  `ID_CART` int(5) NOT NULL,
  `ID_TRANSACT` varchar(15) NOT NULL,
  `ID_STOCK` int(2) NOT NULL,
  `STOCK_COUNT` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dt_delivery`
--

CREATE TABLE `dt_delivery` (
  `ID_CONS` int(11) NOT NULL,
  `ID_TRANSACT` varchar(15) NOT NULL,
  `CONSIGNEE` varchar(100) NOT NULL,
  `PHONE` varchar(30) NOT NULL,
  `DESTINATION` text NOT NULL,
  `STATUS` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_price`
--

CREATE TABLE `m_price` (
  `ID_STOCK` int(2) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `DISCOUNT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='SATUAN HARGA PER KILOGRAM ATAU PER PCS';

-- --------------------------------------------------------

--
-- Table structure for table `m_stock`
--

CREATE TABLE `m_stock` (
  `ID_STOCK` int(2) NOT NULL,
  `STOCK_NAME` varchar(100) NOT NULL,
  `STOCK` int(10) NOT NULL DEFAULT '0',
  `EXPIRED` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='SATUAN STOK PER KILOGRAM(BIJI KOPI / BUBUK KOPI) ATAU PER PCS(KOPI SEDUH)';

-- --------------------------------------------------------

--
-- Table structure for table `m_transact`
--

CREATE TABLE `m_transact` (
  `ID_TRANSACT` varchar(15) NOT NULL,
  `ID_CART` int(5) NOT NULL,
  `INCOME` bigint(20) NOT NULL,
  `DATE_OMMIT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_menu`
--

CREATE TABLE `t_menu` (
  `ID_MENU` int(11) NOT NULL,
  `ID_SUPER` int(11) NOT NULL,
  `TITLE` varchar(50) NOT NULL COMMENT 'Title Displayed',
  `STR_ID` varchar(50) NOT NULL,
  `ICON` varchar(50) NOT NULL,
  `PATH` varchar(50) NOT NULL,
  `PERMIT` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_menu`
--

INSERT INTO `t_menu` (`ID_MENU`, `ID_SUPER`, `TITLE`, `STR_ID`, `ICON`, `PATH`, `PERMIT`) VALUES
(0, 0, 'Dashboard', 'dashBoard', 'fas fa-tachometer-alt', 'dshbrd', 0),
(2, 0, 'Main Control', 'mainControl', 'fas fa-cogs', 'pg_control', 0),
(3, 0, 'Master Data', 'masterData', 'fa fa-database', 'pg_master', 1),
(4, 2, 'Company Profile', 'cpControl', '', 'index', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `ID_USER` int(2) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `FIRST_NAME` varchar(100) DEFAULT NULL,
  `LAST_NAME` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `CREATED` date DEFAULT NULL,
  `LAST_LOGIN` datetime DEFAULT NULL,
  `PERMIT` int(1) NOT NULL DEFAULT '0',
  `DELETE` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`ID_USER`, `USERNAME`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `CREATED`, `LAST_LOGIN`, `PERMIT`, `DELETE`) VALUES
(1, 'kaboel', 'df85f55abd44e5343a7d4a71154521a2', NULL, NULL, NULL, NULL, '2018-10-24 14:01:47', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dt_cart`
--
ALTER TABLE `dt_cart`
  ADD PRIMARY KEY (`ID_CART`);

--
-- Indexes for table `dt_delivery`
--
ALTER TABLE `dt_delivery`
  ADD PRIMARY KEY (`ID_CONS`);

--
-- Indexes for table `m_price`
--
ALTER TABLE `m_price`
  ADD PRIMARY KEY (`ID_STOCK`);

--
-- Indexes for table `m_stock`
--
ALTER TABLE `m_stock`
  ADD PRIMARY KEY (`ID_STOCK`);

--
-- Indexes for table `m_transact`
--
ALTER TABLE `m_transact`
  ADD PRIMARY KEY (`ID_TRANSACT`),
  ADD UNIQUE KEY `m_transact_UN` (`ID_CART`);

--
-- Indexes for table `t_menu`
--
ALTER TABLE `t_menu`
  ADD PRIMARY KEY (`ID_MENU`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dt_cart`
--
ALTER TABLE `dt_cart`
  MODIFY `ID_CART` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dt_delivery`
--
ALTER TABLE `dt_delivery`
  MODIFY `ID_CONS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_price`
--
ALTER TABLE `m_price`
  MODIFY `ID_STOCK` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_stock`
--
ALTER TABLE `m_stock`
  MODIFY `ID_STOCK` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_menu`
--
ALTER TABLE `t_menu`
  MODIFY `ID_MENU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `ID_USER` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
