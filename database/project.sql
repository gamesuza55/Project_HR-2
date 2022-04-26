-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 11:35 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE `domain` (
  `id_domain` int(11) NOT NULL,
  `name_company` varchar(50) NOT NULL,
  `user_domain` varchar(50) NOT NULL,
  `tel_domain` varchar(10) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_payroll`
--

CREATE TABLE `expenditure_payroll` (
  `id_expenditure` int(11) NOT NULL,
  `detail_expenditure` varchar(50) NOT NULL,
  `expenditure` varchar(11) NOT NULL,
  `date_expenditure` date NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fistname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `start_work` date NOT NULL,
  `birthday` date NOT NULL,
  `department` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `tel` varchar(15) NOT NULL,
  `gendar` varchar(10) NOT NULL,
  `status` set('admin','user') NOT NULL,
  `image_user` varchar(50) NOT NULL,
  `status_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password`, `email`, `fistname`, `lastname`, `nickname`, `start_work`, `birthday`, `department`, `address`, `tel`, `gendar`, `status`, `image_user`, `status_user`) VALUES
('admin', '1234', '', 'admin', 'admin', 'admin', '0000-00-00', '0000-00-00', '-', '-', '-', '-', 'admin', 'avatar.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_payroll`
--

CREATE TABLE `order_payroll` (
  `id_order` int(11) NOT NULL,
  `date_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `revenue_payroll`
--

CREATE TABLE `revenue_payroll` (
  `id_revenue` int(11) NOT NULL,
  `detail_revenue` varchar(50) NOT NULL,
  `revenue` varchar(20) NOT NULL,
  `fistname` varchar(50) NOT NULL,
  `date_revenue` date NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sick_leave`
--

CREATE TABLE `sick_leave` (
  `ID_leave` int(11) NOT NULL,
  `fistname` varchar(20) NOT NULL,
  `sick` varchar(20) NOT NULL,
  `type_sick` varchar(15) NOT NULL,
  `detail_sick` text NOT NULL,
  `dates` date NOT NULL,
  `date_range` date NOT NULL,
  `day_num` varchar(20) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `status` set('อนุมัติ','กำลังรอการอนุมัติ','ไม่อนุมัติ') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`id_domain`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditure_payroll`
--
ALTER TABLE `expenditure_payroll`
  ADD PRIMARY KEY (`id_expenditure`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `order_payroll`
--
ALTER TABLE `order_payroll`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `revenue_payroll`
--
ALTER TABLE `revenue_payroll`
  ADD PRIMARY KEY (`id_revenue`);

--
-- Indexes for table `sick_leave`
--
ALTER TABLE `sick_leave`
  ADD PRIMARY KEY (`ID_leave`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
  MODIFY `id_domain` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenditure_payroll`
--
ALTER TABLE `expenditure_payroll`
  MODIFY `id_expenditure` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_payroll`
--
ALTER TABLE `order_payroll`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revenue_payroll`
--
ALTER TABLE `revenue_payroll`
  MODIFY `id_revenue` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sick_leave`
--
ALTER TABLE `sick_leave`
  MODIFY `ID_leave` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
