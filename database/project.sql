-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2022 at 03:28 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`id_domain`, `name_company`, `user_domain`, `tel_domain`, `domain`, `start_date`, `due_date`, `cost`) VALUES
(1, 'test', 'test2', '0877777777', '123.123.21342', '2022-04-26', '2023-04-26', 300000),
(2, 'test2', 'test3', '0899999999', '198.168.1.1', '2022-04-26', '2022-04-29', 500000),
(3, 'test5', 'test7', '0899129321', '198.168.123', '2022-04-26', '2022-05-26', 1000000),
(4, 'test10', 'test4', '0879678664', '192.167.1.1', '2022-04-26', '2022-05-26', 500000);

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
(1, 'หยุดประจำเดือน', '#0071c5', '2022-04-05 00:00:00', '2022-04-06 00:00:00');

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

--
-- Dumping data for table `expenditure_payroll`
--

INSERT INTO `expenditure_payroll` (`id_expenditure`, `detail_expenditure`, `expenditure`, `date_expenditure`, `id_order`) VALUES
(1, 'tset', '12,345', '2022-04-26', 1);

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
('admin', '1234', 'game@gmail.com', 'admin', 'admin', 'admin', '2022-04-01', '2022-04-02', 'programer', '21sdfa', '0980138234', '23', 'admin', 'avatar.png', 0),
('araya', '1234', 'bell@gmail.com', 'อารยา', 'เคหาแก้ว', 'เบลล์', '2022-04-26', '1970-01-01', 'Accounting', 'test', '(080) 621-3270', 'female', 'user', '32636.png', 0),
('ball', '1234', 'ball@gmail.com', 'ธรรมรงค์', 'ปิ่นแก้ว', 'บอล', '2022-04-26', '1970-01-01', 'Marketing', 'test', '(080) 222-2222', 'male', 'user', '65531.jpg', 0),
('cee', '1234', 'cee@gmail.com', 'จตุรงค์', 'ดวงสุวรรณ', 'ซี่', '2022-04-26', '1997-08-20', 'Graphic', 'test', '(080) 111-1111', 'male', 'user', '55037.png', 0),
('game', '1234', 'gamesuza55@gmail.com', 'คมกฤษ', 'ช่วยโครธะ', 'เกมส์', '2022-04-26', '1998-05-15', 'Programer', '27 ขัยมงคล ซ.3', '(098) 013-8234', 'male', 'user', '33286.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_payroll`
--

CREATE TABLE `order_payroll` (
  `id_order` int(11) NOT NULL,
  `date_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_payroll`
--

INSERT INTO `order_payroll` (`id_order`, `date_order`) VALUES
(1, '2022-04-26');

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

--
-- Dumping data for table `revenue_payroll`
--

INSERT INTO `revenue_payroll` (`id_revenue`, `detail_revenue`, `revenue`, `fistname`, `date_revenue`, `id_order`) VALUES
(1, 'test ', '123,421,412', 'คมกฤษ', '2022-04-26', 1),
(2, 'test2 ', '1,231,241', 'จตุรงค์', '2022-04-26', 1);

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
(1, 'คมกฤษ', 'ลาป่วย', 'ลาเต็มวัน', 'มีธุระด่วน', '2022-04-26', '2022-04-30', '5', '1650958868.jpg', 'อนุมัติ'),
(2, 'อารยา', 'ลาป่วย', 'ลาครึ่งวัน-เช้า', 'ลาป่วย', '2022-04-26', '2022-04-26', 'ลาครึ่งวัน-เช้า', '1650959604.jpg', 'ไม่อนุมัติ'),
(4, 'ธรรมรงค์', 'ลาป่วย', 'ลาเต็มวัน', 'ป่วยหนักมาก', '2022-04-26', '2022-04-30', '5', '1650959709.jpg', 'กำลังรอการอนุมัติ'),
(5, 'จตุรงค์', 'ลาพักร้อน', 'ลาเต็มวัน', 'test', '2022-04-26', '2022-04-26', '1', '', 'กำลังรอการอนุมัติ');

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
  MODIFY `id_domain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenditure_payroll`
--
ALTER TABLE `expenditure_payroll`
  MODIFY `id_expenditure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_payroll`
--
ALTER TABLE `order_payroll`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `revenue_payroll`
--
ALTER TABLE `revenue_payroll`
  MODIFY `id_revenue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sick_leave`
--
ALTER TABLE `sick_leave`
  MODIFY `ID_leave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
