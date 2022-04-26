-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2019 at 06:44 AM
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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(6, 'วันหยุด', '#FF0000', '2019-08-10 00:00:00', '2019-08-12 00:00:00'),
(7, 'วันหยุด', '#000', '2019-08-06 00:00:00', '2019-08-08 00:00:00'),
(9, 'วันหยุด', '#FF0000', '2019-08-22 00:00:00', '2019-08-24 00:00:00'),
(10, 'วันหยุด', '#FF8C00', '2019-08-27 00:00:00', '2019-08-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_payroll`
--

CREATE TABLE `expenditure_payroll` (
  `id_expenditure` int(11) NOT NULL,
  `detail_expenditure` varchar(50) NOT NULL,
  `expenditure` int(11) NOT NULL,
  `date_expenditure` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `fistname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `address` text NOT NULL,
  `tel` varchar(15) NOT NULL,
  `status` set('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password`, `fistname`, `lastname`, `nickname`, `birthday`, `address`, `tel`, `status`) VALUES
('admin', '1234', 'heelo', 'world', 'Peter', '0000-00-00', '', '', 'admin'),
('admin2', '1234', 'tilic', 'ging', 'lkiolj', '0000-00-00', '', '', 'admin'),
('game', '1234', 'คมกฤษ', ' ช่วยโครธะ', 'เกมส์', '2019-05-15', '27 ชัยมงคล ซอย3 อำเภอเมือง ตำบลบ่อยาง จังหวัดสงขลา 90000', '098-034-1824', 'user'),
('mix', '1234', 'พิเชษฐ์', 'ชื่นชม', 'มิก', '2019-10-01', 'ชุมพร', '085-590-0774', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `order_payroll`
--

CREATE TABLE `order_payroll` (
  `id_order` int(11) NOT NULL,
  `name_order` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_payroll`
--

INSERT INTO `order_payroll` (`id_order`, `name_order`) VALUES
(1, 'รายรับ'),
(2, 'รายจ่าย');

-- --------------------------------------------------------

--
-- Table structure for table `revenue_payroll`
--

CREATE TABLE `revenue_payroll` (
  `id_revenue` int(11) NOT NULL,
  `detail_revenue` varchar(50) NOT NULL,
  `revenue` int(11) NOT NULL,
  `fistname` varchar(50) NOT NULL,
  `date_revenue` date NOT NULL,
  `id_expenditure` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `revenue_payroll`
--

INSERT INTO `revenue_payroll` (`id_revenue`, `detail_revenue`, `revenue`, `fistname`, `date_revenue`, `id_expenditure`) VALUES
(97, '', 0, '', '2019-08-30', 0),
(98, '', 0, '', '2019-08-30', 0),
(99, '', 0, '', '2019-08-30', 0);

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
-- Dumping data for table `sick_leave`
--

INSERT INTO `sick_leave` (`ID_leave`, `fistname`, `sick`, `type_sick`, `detail_sick`, `dates`, `date_range`, `day_num`, `image_name`, `status`) VALUES
(137, 'คมกฤษ', 'ลาป่วย', 'ลาเต็มวัน', 'ปวดหัว', '2019-08-01', '2019-08-27', '1', '1566899962.jpg', 'อนุมัติ'),
(138, 'คมกฤษ', 'ลาป่วย', 'ลาเต็มวัน', 'hello', '2019-08-20', '2019-08-27', '1', '', 'อนุมัติ'),
(139, 'คมกฤษ', 'ลาป่วย', 'ลาเต็มวัน', 'asdfasdf', '2019-08-21', '2019-08-27', '1', '', 'ไม่อนุมัติ'),
(141, 'พิเชษฐ์', 'ลาป่วย', 'ลาเต็มวัน', 'ปวดหัว', '2019-08-27', '2019-08-27', '1', '', 'กำลังรอการอนุมัติ');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expenditure_payroll`
--
ALTER TABLE `expenditure_payroll`
  MODIFY `id_expenditure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `revenue_payroll`
--
ALTER TABLE `revenue_payroll`
  MODIFY `id_revenue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `sick_leave`
--
ALTER TABLE `sick_leave`
  MODIFY `ID_leave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
