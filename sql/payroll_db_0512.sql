-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2020 at 12:25 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `account_created_date` date NOT NULL,
  `account_edited_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username_id`, `username`, `password`, `permission`, `account_created_date`, `account_edited_date`) VALUES
(3, 'admin', '123', '2', '0000-00-00', '0000-00-00'),
(8, 'abc', '1223', '1', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `allowance`
--

CREATE TABLE `allowance` (
  `allowance_id` int(11) NOT NULL,
  `allowance_display_id` varchar(255) NOT NULL,
  `allowance_desc` varchar(255) NOT NULL,
  `allowance_rate` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowance`
--

INSERT INTO `allowance` (`allowance_id`, `allowance_display_id`, `allowance_desc`, `allowance_rate`) VALUES
(21, 'P01', 'Petrol Normal', 50.00),
(22, 'P02', 'Petrol Diesel', 40.00),
(23, 'F01', 'Food', 25.00),
(24, 'G01', 'Gun', 200.00),
(25, 'C01', 'Candy', 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE `deduction` (
  `deduction_id` int(11) NOT NULL,
  `deduction_display_id` varchar(255) NOT NULL,
  `deduction_desc` varchar(255) NOT NULL,
  `deduction_rate` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`deduction_id`, `deduction_display_id`, `deduction_desc`, `deduction_rate`) VALUES
(12, 'L01', 'Late for Work', 25.00),
(13, 'PA01', 'Panic', 100.00),
(14, 'B01', 'Buyback', 300.00),
(15, 'B02', 'Black King Bar', 500.00),
(16, 'M01', 'Monkey King Bar', 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `eis_formula`
--

CREATE TABLE `eis_formula` (
  `eis_formula_id` int(11) NOT NULL,
  `eis_formula_year` varchar(100) DEFAULT NULL,
  `eis_formula_wage_start` double(11,2) DEFAULT NULL,
  `eis_formula_wage_end` double(11,2) DEFAULT NULL,
  `eis_formula_employee_amt` double(11,2) DEFAULT NULL,
  `eis_formula_employer_amt` double(11,2) DEFAULT NULL,
  `eis_formula_total` double(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eis_formula`
--

INSERT INTO `eis_formula` (`eis_formula_id`, `eis_formula_year`, `eis_formula_wage_start`, `eis_formula_wage_end`, `eis_formula_employee_amt`, `eis_formula_employer_amt`, `eis_formula_total`) VALUES
(1, '', 0.01, 30.00, 0.05, 0.05, 0.10),
(2, '', 30.01, 50.00, 0.10, 0.10, 0.20),
(3, '', 50.01, 70.00, 0.15, 0.15, 0.30),
(4, '', 70.01, 100.00, 0.20, 0.20, 0.40),
(5, '', 100.01, 140.00, 0.25, 0.25, 0.50),
(6, '', 140.01, 200.00, 0.35, 0.35, 0.70),
(7, '', 200.01, 300.00, 0.50, 0.50, 1.00),
(8, '', 300.01, 400.00, 0.70, 0.70, 1.40),
(9, '', 400.01, 500.00, 0.90, 0.90, 1.80),
(10, '', 500.01, 600.00, 1.10, 1.10, 2.20),
(11, '', 600.01, 700.00, 1.30, 1.30, 2.60),
(12, '', 700.01, 800.00, 1.50, 1.50, 3.00),
(13, '', 800.01, 900.00, 1.70, 1.70, 3.40),
(14, '', 900.01, 1000.00, 1.90, 1.90, 3.80),
(15, '', 1000.01, 1100.00, 2.10, 2.10, 4.20),
(16, '', 1100.01, 1200.00, 2.30, 2.30, 4.60),
(17, '', 1200.01, 1300.00, 2.50, 2.50, 5.00),
(18, '', 1300.01, 1400.00, 2.70, 2.70, 5.40),
(19, '', 1400.01, 1500.00, 2.90, 2.90, 5.80),
(20, '', 1500.01, 1600.00, 3.10, 3.10, 6.20),
(21, '', 1600.01, 1700.00, 3.30, 3.30, 6.60),
(22, '', 1700.01, 1800.00, 3.50, 3.50, 7.00),
(23, '', 1800.01, 1900.00, 3.70, 3.70, 7.40),
(24, '', 1900.01, 2000.00, 3.90, 3.90, 7.80),
(25, '', 2000.01, 2100.00, 4.10, 4.10, 8.20),
(26, '', 2100.01, 2200.00, 4.30, 4.30, 8.60),
(27, '', 2200.01, 2300.00, 4.50, 4.50, 9.00),
(28, '', 2300.01, 2400.00, 4.70, 4.70, 9.40),
(29, '', 2400.01, 2500.00, 4.90, 4.90, 9.80),
(30, '', 2500.01, 2600.00, 5.10, 5.10, 10.20),
(31, '', 2600.01, 2700.00, 5.30, 5.30, 10.60),
(32, '', 2700.01, 2800.00, 5.50, 5.50, 11.00),
(33, '', 2800.01, 2900.00, 5.70, 5.70, 11.40),
(34, '', 2900.01, 3000.00, 5.90, 5.90, 11.80),
(35, '', 3000.01, 3100.00, 6.10, 6.10, 12.20),
(36, '', 3100.01, 3200.00, 6.30, 6.30, 12.60),
(37, '', 3200.01, 3300.00, 6.50, 6.50, 13.00),
(38, '', 3300.01, 3400.00, 6.70, 6.70, 13.40),
(39, '', 3400.01, 3500.00, 6.90, 6.90, 13.80),
(40, '', 3500.01, 3600.00, 7.10, 7.10, 14.20),
(41, '', 3600.01, 3700.00, 7.30, 7.30, 14.60),
(42, '', 3700.01, 3800.00, 7.50, 7.50, 15.00),
(43, '', 3800.01, 3900.00, 7.70, 7.70, 15.40),
(44, '', 3900.01, 4000.00, 7.90, 7.90, 15.80),
(45, '', 4000.01, 99999.99, 7.90, 7.90, 15.80);

-- --------------------------------------------------------

--
-- Table structure for table `eis_report`
--

CREATE TABLE `eis_report` (
  `eis_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `eis_report_total` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_allowance`
--

CREATE TABLE `employee_allowance` (
  `emp_allowance_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `allowance_id` int(11) NOT NULL,
  `allowance_desc` varchar(255) NOT NULL,
  `allowance_rate` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_allowance`
--

INSERT INTO `employee_allowance` (`emp_allowance_id`, `emp_id`, `allowance_id`, `allowance_desc`, `allowance_rate`) VALUES
(1, 67, 21, 'Petrol Normal', 50.00),
(2, 67, 23, 'Food', 25.00),
(3, 68, 24, 'Gun', 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `employee_deduction`
--

CREATE TABLE `employee_deduction` (
  `emp_deduction_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `deduction_id` int(11) NOT NULL,
  `deduction_desc` varchar(255) NOT NULL,
  `deduction_rate` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_deduction`
--

INSERT INTO `employee_deduction` (`emp_deduction_id`, `emp_id`, `deduction_id`, `deduction_desc`, `deduction_rate`) VALUES
(1, 68, 14, 'Buyback', 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `employee_id_count`
--

CREATE TABLE `employee_id_count` (
  `id` int(11) NOT NULL,
  `emp_id_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_id_count`
--

INSERT INTO `employee_id_count` (`id`, `emp_id_count`) VALUES
(1, 1004);

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `emp_id` int(11) NOT NULL,
  `emp_display_id` varchar(255) NOT NULL,
  `emp_full_name` varchar(255) NOT NULL,
  `emp_gender` varchar(50) NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `emp_mobile` varchar(255) NOT NULL,
  `emp_telephone` varchar(255) NOT NULL,
  `emp_ic` varchar(255) NOT NULL,
  `emp_passport` varchar(255) NOT NULL,
  `emp_immigration` varchar(255) NOT NULL,
  `emp_title` varchar(255) NOT NULL,
  `emp_wages` double(11,2) NOT NULL,
  `emp_payment_method` varchar(255) NOT NULL,
  `emp_bank_name` varchar(255) NOT NULL,
  `emp_account` varchar(255) NOT NULL,
  `emp_health_status` varchar(255) DEFAULT NULL,
  `emp_martial_status` varchar(255) NOT NULL,
  `emp_spouse_status` varchar(255) DEFAULT NULL,
  `emp_epf` varchar(255) NOT NULL,
  `emp_socso` varchar(255) NOT NULL,
  `emp_socso_type` varchar(255) NOT NULL,
  `emp_eis_type` varchar(255) NOT NULL,
  `emp_join_date` date NOT NULL,
  `emp_confirm_date` date NOT NULL,
  `emp_resign_date` date NOT NULL,
  `emp_total_allowance` double NOT NULL,
  `emp_total_deduction` double NOT NULL,
  `data_created_date` date NOT NULL,
  `data_edited_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`emp_id`, `emp_display_id`, `emp_full_name`, `emp_gender`, `emp_dob`, `emp_email`, `emp_address`, `emp_mobile`, `emp_telephone`, `emp_ic`, `emp_passport`, `emp_immigration`, `emp_title`, `emp_wages`, `emp_payment_method`, `emp_bank_name`, `emp_account`, `emp_health_status`, `emp_martial_status`, `emp_spouse_status`, `emp_epf`, `emp_socso`, `emp_socso_type`, `emp_eis_type`, `emp_join_date`, `emp_confirm_date`, `emp_resign_date`, `emp_total_allowance`, `emp_total_deduction`, `data_created_date`, `data_edited_date`) VALUES
(65, 'E1001', 'Andrew Yongz', 'Male', '2020-05-31', 'myrealemail@email.com', 'Tabuan Jaya Crown Square no 88', '0164460111', '082334564', '789012874335', '', '', 'Project Manager', 3100.00, 'Cheque', 'Maybank', '21223356742', 'Resident', 'Single', 'Work', '223391', '442314', 'Category 1', 'Yes', '2020-05-31', '2020-05-31', '0000-00-00', 0, 0, '2020-05-08', '2020-05-12'),
(66, 'E1002', 'Wu Zhe Tian', 'Female', '2019-06-14', 'wuzhetian@email.com', 'Wu My House no 96', '0113327865', '083445678', '927816896556', '', '', 'Supervisor', 2400.00, 'Cheque', 'Maybank', '223829712', 'Resident', 'Single', 'Work', '123554', '123512', 'Category 1', 'Yes', '2020-05-31', '2020-05-31', '0000-00-00', 0, 0, '2020-05-08', '0000-00-00'),
(67, 'E1003', 'Sun Mu Kong', 'Male', '2020-05-01', 'sunmukung@email.com', 'Sun and Mood no 38', '0183347854', '0823345567', '378947812334', '', '', 'Watch VPN', 1200.00, 'Bank-In', 'Maybank', '12312312112', 'Resident', 'Single', 'Work', '12445', '35664', 'Category 1', 'Yes', '2020-05-31', '2020-05-31', '0000-00-00', 75, 0, '2020-05-08', '2020-05-10'),
(68, 'E1004', 'Gui Gu Zi', 'Male', '2020-05-31', 'gui@mail.com', 'wz garden', '67896', '3425', '7654', '2345', '653', 'Wash Money', 1150.00, 'Cheque', 'Affin', '464565', 'Resident', 'Single', 'None', '2345', '6543', 'Category 2', 'No', '2020-05-31', '2020-05-31', '0000-00-00', 200, 300, '2020-05-10', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `epf_formula`
--

CREATE TABLE `epf_formula` (
  `epf_formula_id` int(11) NOT NULL,
  `epf_formula_year` double DEFAULT NULL,
  `epf_formula_month` double DEFAULT NULL,
  `epf_formula_employee_rate` varchar(100) DEFAULT NULL,
  `epf_formula_employer_rate` varchar(100) DEFAULT NULL,
  `epf_formula_wage_start` double(11,2) DEFAULT NULL,
  `epf_formula_wage_end` double(11,2) DEFAULT NULL,
  `epf_formula_employee_amt` double(11,2) DEFAULT NULL,
  `epf_formula_employer_amt` double(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `epf_formula`
--

INSERT INTO `epf_formula` (`epf_formula_id`, `epf_formula_year`, `epf_formula_month`, `epf_formula_employee_rate`, `epf_formula_employer_rate`, `epf_formula_wage_start`, `epf_formula_wage_end`, `epf_formula_employee_amt`, `epf_formula_employer_amt`) VALUES
(1, 2020, 4, '', '', 0.01, 10.00, 0.00, 0.00),
(2, 2020, 4, '', '', 10.01, 20.00, 3.00, 3.00),
(3, 2020, 4, '', '', 20.01, 40.00, 5.00, 6.00),
(4, 2020, 4, '', '', 40.01, 60.00, 7.00, 8.00),
(5, 2020, 4, '', '', 60.01, 80.00, 9.00, 11.00),
(6, 2020, 4, '', '', 80.01, 100.00, 11.00, 13.00),
(7, 2020, 4, '', '', 100.01, 120.00, 14.00, 16.00),
(8, 2020, 4, '', '', 120.01, 140.00, 16.00, 19.00),
(9, 2020, 4, '', '', 140.01, 160.00, 18.00, 21.00),
(10, 2020, 4, '', '', 160.01, 180.00, 20.00, 24.00),
(11, 2020, 4, '', '', 180.01, 200.00, 22.00, 26.00),
(12, 2020, 4, '', '', 200.01, 220.00, 25.00, 29.00),
(13, 2020, 4, '', '', 220.01, 240.00, 27.00, 32.00),
(14, 2020, 4, '', '', 240.01, 260.00, 29.00, 34.00),
(15, 2020, 4, '', '', 260.01, 280.00, 31.00, 37.00),
(16, 2020, 4, '', '', 280.01, 300.00, 33.00, 39.00),
(17, 2020, 4, '', '', 300.01, 320.00, 36.00, 42.00),
(18, 2020, 4, '', '', 320.01, 340.00, 38.00, 45.00),
(19, 2020, 4, '', '', 340.01, 360.00, 40.00, 47.00),
(20, 2020, 4, '', '', 360.01, 380.00, 42.00, 50.00),
(21, 2020, 4, '', '', 380.01, 400.00, 44.00, 52.00),
(22, 2020, 4, '', '', 400.01, 420.00, 47.00, 55.00),
(23, 2020, 4, '', '', 420.01, 440.00, 49.00, 58.00),
(24, 2020, 4, '', '', 440.01, 460.00, 51.00, 60.00),
(25, 2020, 4, '', '', 460.01, 480.00, 53.00, 63.00),
(26, 2020, 4, '', '', 480.01, 500.00, 55.00, 65.00),
(27, 2020, 4, '', '', 500.01, 520.00, 58.00, 68.00),
(28, 2020, 4, '', '', 520.01, 540.00, 60.00, 71.00),
(29, 2020, 4, '', '', 540.01, 560.00, 62.00, 73.00),
(30, 2020, 4, '', '', 560.01, 580.00, 64.00, 76.00),
(31, 2020, 4, '', '', 580.01, 600.00, 66.00, 78.00),
(32, 2020, 4, '', '', 600.01, 620.00, 69.00, 81.00),
(33, 2020, 4, '', '', 620.01, 640.00, 71.00, 84.00),
(34, 2020, 4, '', '', 640.01, 660.00, 73.00, 86.00),
(35, 2020, 4, '', '', 660.01, 680.00, 75.00, 89.00),
(36, 2020, 4, '', '', 680.01, 700.00, 77.00, 91.00),
(37, 2020, 4, '', '', 700.01, 720.00, 80.00, 94.00),
(38, 2020, 4, '', '', 720.01, 740.00, 82.00, 97.00),
(39, 2020, 4, '', '', 740.01, 760.00, 84.00, 99.00),
(40, 2020, 4, '', '', 760.01, 780.00, 86.00, 102.00),
(41, 2020, 4, '', '', 780.01, 800.00, 88.00, 104.00),
(42, 2020, 4, '', '', 800.01, 820.00, 91.00, 107.00),
(43, 2020, 4, '', '', 820.01, 840.00, 93.00, 110.00),
(44, 2020, 4, '', '', 840.01, 860.00, 95.00, 112.00),
(45, 2020, 4, '', '', 860.01, 880.00, 97.00, 115.00),
(46, 2020, 4, '', '', 880.01, 900.00, 99.00, 117.00),
(47, 2020, 4, '', '', 900.01, 920.00, 102.00, 120.00),
(48, 2020, 4, '', '', 920.01, 940.00, 104.00, 123.00),
(49, 2020, 4, '', '', 940.01, 960.00, 106.00, 125.00),
(50, 2020, 4, '', '', 960.01, 980.00, 108.00, 128.00),
(51, 2020, 4, '', '', 980.01, 1000.00, 110.00, 130.00),
(52, 2020, 4, '', '', 1000.01, 1020.00, 113.00, 133.00),
(53, 2020, 4, '', '', 1020.01, 1040.00, 115.00, 136.00),
(54, 2020, 4, '', '', 1040.01, 1060.00, 117.00, 138.00),
(55, 2020, 4, '', '', 1060.01, 1080.00, 119.00, 141.00),
(56, 2020, 4, '', '', 1080.01, 1100.00, 121.00, 143.00),
(57, 2020, 4, '', '', 1100.01, 1120.00, 124.00, 146.00),
(58, 2020, 4, '', '', 1120.01, 1140.00, 126.00, 149.00),
(59, 2020, 4, '', '', 1140.01, 1160.00, 128.00, 151.00),
(60, 2020, 4, '', '', 1160.01, 1180.00, 130.00, 154.00),
(61, 2020, 4, '', '', 1180.01, 1200.00, 132.00, 156.00),
(62, 2020, 4, '', '', 1200.01, 1220.00, 135.00, 159.00),
(63, 2020, 4, '', '', 1220.01, 1240.00, 137.00, 162.00),
(64, 2020, 4, '', '', 1240.01, 1260.00, 139.00, 164.00),
(65, 2020, 4, '', '', 1260.01, 1280.00, 141.00, 167.00),
(66, 2020, 4, '', '', 1280.01, 1300.00, 143.00, 169.00),
(67, 2020, 4, '', '', 1300.01, 1320.00, 146.00, 172.00),
(68, 2020, 4, '', '', 1320.01, 1340.00, 148.00, 175.00),
(69, 2020, 4, '', '', 1340.01, 1360.00, 150.00, 177.00),
(70, 2020, 4, '', '', 1360.01, 1380.00, 152.00, 180.00),
(71, 2020, 4, '', '', 1380.01, 1400.00, 154.00, 182.00),
(72, 2020, 4, '', '', 1400.01, 1420.00, 157.00, 185.00),
(73, 2020, 4, '', '', 1420.01, 1440.00, 159.00, 188.00),
(74, 2020, 4, '', '', 1440.01, 1460.00, 161.00, 190.00),
(75, 2020, 4, '', '', 1460.01, 1480.00, 163.00, 193.00),
(76, 2020, 4, '', '', 1480.01, 1500.00, 165.00, 195.00),
(77, 2020, 4, '', '', 1500.01, 1520.00, 168.00, 198.00),
(78, 2020, 4, '', '', 1520.01, 1540.00, 170.00, 201.00),
(79, 2020, 4, '', '', 1540.01, 1560.00, 172.00, 203.00),
(80, 2020, 4, '', '', 1560.01, 1580.00, 174.00, 206.00),
(81, 2020, 4, '', '', 1580.01, 1600.00, 176.00, 208.00),
(82, 2020, 4, '', '', 1600.01, 1620.00, 179.00, 211.00),
(83, 2020, 4, '', '', 1620.01, 1640.00, 181.00, 214.00),
(84, 2020, 4, '', '', 1640.01, 1660.00, 183.00, 216.00),
(85, 2020, 4, '', '', 1660.01, 1680.00, 185.00, 219.00),
(86, 2020, 4, '', '', 1680.01, 1700.00, 187.00, 221.00),
(87, 2020, 4, '', '', 1700.01, 1720.00, 190.00, 224.00),
(88, 2020, 4, '', '', 1720.01, 1740.00, 192.00, 227.00),
(89, 2020, 4, '', '', 1740.01, 1760.00, 194.00, 229.00),
(90, 2020, 4, '', '', 1760.01, 1780.00, 196.00, 232.00),
(91, 2020, 4, '', '', 1780.01, 1800.00, 198.00, 234.00),
(92, 2020, 4, '', '', 1800.01, 1820.00, 201.00, 237.00),
(93, 2020, 4, '', '', 1820.01, 1840.00, 203.00, 240.00),
(94, 2020, 4, '', '', 1840.01, 1860.00, 205.00, 242.00),
(95, 2020, 4, '', '', 1860.01, 1880.00, 207.00, 245.00),
(96, 2020, 4, '', '', 1880.01, 1900.00, 209.00, 247.00),
(97, 2020, 4, '', '', 1900.01, 1920.00, 212.00, 250.00),
(98, 2020, 4, '', '', 1920.01, 1940.00, 214.00, 253.00),
(99, 2020, 4, '', '', 1940.01, 1960.00, 216.00, 255.00),
(100, 2020, 4, '', '', 1960.01, 1980.00, 218.00, 258.00),
(101, 2020, 4, '', '', 1980.01, 2000.00, 220.00, 260.00),
(102, 2020, 4, '', '', 2000.01, 2020.00, 223.00, 263.00),
(103, 2020, 4, '', '', 2020.01, 2040.00, 225.00, 266.00),
(104, 2020, 4, '', '', 2040.01, 2060.00, 227.00, 268.00),
(105, 2020, 4, '', '', 2060.01, 2080.00, 229.00, 271.00),
(106, 2020, 4, '', '', 2080.01, 2100.00, 231.00, 273.00),
(107, 2020, 4, '', '', 2100.01, 2120.00, 234.00, 276.00),
(108, 2020, 4, '', '', 2120.01, 2140.00, 236.00, 279.00),
(109, 2020, 4, '', '', 2140.01, 2160.00, 238.00, 281.00),
(110, 2020, 4, '', '', 2160.01, 2180.00, 240.00, 284.00),
(111, 2020, 4, '', '', 2180.01, 2200.00, 242.00, 286.00),
(112, 2020, 4, '', '', 2200.01, 2220.00, 245.00, 289.00),
(113, 2020, 4, '', '', 2220.01, 2240.00, 247.00, 292.00),
(114, 2020, 4, '', '', 2240.01, 2260.00, 249.00, 294.00),
(115, 2020, 4, '', '', 2260.01, 2280.00, 251.00, 297.00),
(116, 2020, 4, '', '', 2280.01, 2300.00, 253.00, 299.00),
(117, 2020, 4, '', '', 2300.01, 2320.00, 256.00, 302.00),
(118, 2020, 4, '', '', 2320.01, 2340.00, 258.00, 305.00),
(119, 2020, 4, '', '', 2340.01, 2360.00, 260.00, 307.00),
(120, 2020, 4, '', '', 2360.01, 2380.00, 262.00, 310.00),
(121, 2020, 4, '', '', 2380.01, 2400.00, 264.00, 312.00),
(122, 2020, 4, '', '', 2400.01, 2420.00, 267.00, 315.00),
(123, 2020, 4, '', '', 2420.01, 2440.00, 269.00, 318.00),
(124, 2020, 4, '', '', 2440.01, 2460.00, 271.00, 320.00),
(125, 2020, 4, '', '', 2460.01, 2480.00, 273.00, 323.00),
(126, 2020, 4, '', '', 2480.01, 2500.00, 275.00, 325.00),
(127, 2020, 4, '', '', 2500.01, 2520.00, 278.00, 328.00),
(128, 2020, 4, '', '', 2520.01, 2540.00, 280.00, 331.00),
(129, 2020, 4, '', '', 2540.01, 2560.00, 282.00, 333.00),
(130, 2020, 4, '', '', 2560.01, 2580.00, 284.00, 336.00),
(131, 2020, 4, '', '', 2580.01, 2600.00, 286.00, 338.00),
(132, 2020, 4, '', '', 2600.01, 2620.00, 289.00, 341.00),
(133, 2020, 4, '', '', 2620.01, 2640.00, 291.00, 344.00),
(134, 2020, 4, '', '', 2640.01, 2660.00, 293.00, 346.00),
(135, 2020, 4, '', '', 2660.01, 2680.00, 295.00, 349.00),
(136, 2020, 4, '', '', 2680.01, 2700.00, 297.00, 351.00),
(137, 2020, 4, '', '', 2700.01, 2720.00, 300.00, 354.00),
(138, 2020, 4, '', '', 2720.01, 2740.00, 302.00, 357.00),
(139, 2020, 4, '', '', 2740.01, 2760.00, 304.00, 359.00),
(140, 2020, 4, '', '', 2760.01, 2780.00, 306.00, 362.00),
(141, 2020, 4, '', '', 2780.01, 2800.00, 308.00, 364.00),
(142, 2020, 4, '', '', 2800.01, 2820.00, 311.00, 367.00),
(143, 2020, 4, '', '', 2820.01, 2840.00, 313.00, 370.00),
(144, 2020, 4, '', '', 2840.01, 2860.00, 315.00, 372.00),
(145, 2020, 4, '', '', 2860.01, 2880.00, 317.00, 375.00),
(146, 2020, 4, '', '', 2880.01, 2900.00, 319.00, 377.00),
(147, 2020, 4, '', '', 2900.01, 2920.00, 322.00, 380.00),
(148, 2020, 4, '', '', 2920.01, 2940.00, 324.00, 383.00),
(149, 2020, 4, '', '', 2940.01, 2960.00, 326.00, 385.00),
(150, 2020, 4, '', '', 2960.01, 2980.00, 328.00, 388.00),
(151, 2020, 4, '', '', 2980.01, 3000.00, 330.00, 390.00),
(152, 2020, 4, '', '', 3000.01, 3020.00, 333.00, 393.00),
(153, 2020, 4, '', '', 3020.01, 3040.00, 335.00, 396.00),
(154, 2020, 4, '', '', 3040.01, 3060.00, 337.00, 398.00),
(155, 2020, 4, '', '', 3060.01, 3080.00, 339.00, 401.00),
(156, 2020, 4, '', '', 3080.01, 3100.00, 341.00, 403.00),
(157, 2020, 4, '', '', 3100.01, 3120.00, 344.00, 406.00),
(158, 2020, 4, '', '', 3120.01, 3140.00, 346.00, 409.00),
(159, 2020, 4, '', '', 3140.01, 3160.00, 348.00, 411.00),
(160, 2020, 4, '', '', 3160.01, 3180.00, 350.00, 414.00),
(161, 2020, 4, '', '', 3180.01, 3200.00, 352.00, 416.00),
(162, 2020, 4, '', '', 3200.01, 3220.00, 355.00, 419.00),
(163, 2020, 4, '', '', 3220.01, 3240.00, 357.00, 422.00),
(164, 2020, 4, '', '', 3240.01, 3260.00, 359.00, 424.00),
(165, 2020, 4, '', '', 3260.01, 3280.00, 361.00, 427.00),
(166, 2020, 4, '', '', 3280.01, 3300.00, 363.00, 429.00),
(167, 2020, 4, '', '', 3300.01, 3320.00, 366.00, 432.00),
(168, 2020, 4, '', '', 3320.01, 3340.00, 368.00, 435.00),
(169, 2020, 4, '', '', 3340.01, 3360.00, 370.00, 437.00),
(170, 2020, 4, '', '', 3360.01, 3380.00, 372.00, 440.00),
(171, 2020, 4, '', '', 3380.01, 3400.00, 374.00, 442.00),
(172, 2020, 4, '', '', 3400.01, 3420.00, 377.00, 445.00),
(173, 2020, 4, '', '', 3420.01, 3440.00, 379.00, 448.00),
(174, 2020, 4, '', '', 3440.01, 3460.00, 381.00, 450.00),
(175, 2020, 4, '', '', 3460.01, 3480.00, 383.00, 453.00),
(176, 2020, 4, '', '', 3480.01, 3500.00, 385.00, 455.00),
(177, 2020, 4, '', '', 3500.01, 3520.00, 388.00, 458.00),
(178, 2020, 4, '', '', 3520.01, 3540.00, 390.00, 461.00),
(179, 2020, 4, '', '', 3540.01, 3560.00, 392.00, 463.00),
(180, 2020, 4, '', '', 3560.01, 3580.00, 394.00, 466.00),
(181, 2020, 4, '', '', 3580.01, 3600.00, 396.00, 468.00),
(182, 2020, 4, '', '', 3600.01, 3620.00, 399.00, 471.00),
(183, 2020, 4, '', '', 3620.01, 3640.00, 401.00, 474.00),
(184, 2020, 4, '', '', 3640.01, 3660.00, 403.00, 476.00),
(185, 2020, 4, '', '', 3660.01, 3680.00, 405.00, 479.00),
(186, 2020, 4, '', '', 3680.01, 3700.00, 407.00, 481.00),
(187, 2020, 4, '', '', 3700.01, 3720.00, 410.00, 484.00),
(188, 2020, 4, '', '', 3720.01, 3740.00, 412.00, 487.00),
(189, 2020, 4, '', '', 3740.01, 3760.00, 414.00, 489.00),
(190, 2020, 4, '', '', 3760.01, 3780.00, 416.00, 492.00),
(191, 2020, 4, '', '', 3780.01, 3800.00, 418.00, 494.00),
(192, 2020, 4, '', '', 3800.01, 3820.00, 421.00, 497.00),
(193, 2020, 4, '', '', 3820.01, 3840.00, 423.00, 500.00),
(194, 2020, 4, '', '', 3840.01, 3860.00, 425.00, 502.00),
(195, 2020, 4, '', '', 3860.01, 3880.00, 427.00, 505.00),
(196, 2020, 4, '', '', 3880.01, 3900.00, 429.00, 507.00),
(197, 2020, 4, '', '', 3900.01, 3920.00, 432.00, 510.00),
(198, 2020, 4, '', '', 3920.01, 3940.00, 434.00, 513.00),
(199, 2020, 4, '', '', 3940.01, 3960.00, 436.00, 515.00),
(200, 2020, 4, '', '', 3960.01, 3980.00, 438.00, 518.00),
(201, 2020, 4, '', '', 3980.01, 4000.00, 440.00, 520.00),
(202, 2020, 4, '', '', 4000.01, 4020.00, 443.00, 523.00),
(203, 2020, 4, '', '', 4020.01, 4040.00, 445.00, 526.00),
(204, 2020, 4, '', '', 4040.01, 4060.00, 447.00, 528.00),
(205, 2020, 4, '', '', 4060.01, 4080.00, 449.00, 531.00),
(206, 2020, 4, '', '', 4080.01, 4100.00, 451.00, 533.00),
(207, 2020, 4, '', '', 4100.01, 4120.00, 454.00, 536.00),
(208, 2020, 4, '', '', 4120.01, 4140.00, 456.00, 539.00),
(209, 2020, 4, '', '', 4140.01, 4160.00, 458.00, 541.00),
(210, 2020, 4, '', '', 4160.01, 4180.00, 460.00, 544.00),
(211, 2020, 4, '', '', 4180.01, 4200.00, 462.00, 546.00),
(212, 2020, 4, '', '', 4200.01, 4220.00, 465.00, 549.00),
(213, 2020, 4, '', '', 4220.01, 4240.00, 467.00, 552.00),
(214, 2020, 4, '', '', 4240.01, 4260.00, 469.00, 554.00),
(215, 2020, 4, '', '', 4260.01, 4280.00, 471.00, 557.00),
(216, 2020, 4, '', '', 4280.01, 4300.00, 473.00, 559.00),
(217, 2020, 4, '', '', 4300.01, 4320.00, 476.00, 562.00),
(218, 2020, 4, '', '', 4320.01, 4340.00, 478.00, 565.00),
(219, 2020, 4, '', '', 4340.01, 4360.00, 480.00, 567.00),
(220, 2020, 4, '', '', 4360.01, 4380.00, 482.00, 570.00),
(221, 2020, 4, '', '', 4380.01, 4400.00, 484.00, 572.00),
(222, 2020, 4, '', '', 4400.01, 4420.00, 487.00, 575.00),
(223, 2020, 4, '', '', 4420.01, 4440.00, 489.00, 578.00),
(224, 2020, 4, '', '', 4440.01, 4460.00, 491.00, 580.00),
(225, 2020, 4, '', '', 4460.01, 4480.00, 493.00, 583.00),
(226, 2020, 4, '', '', 4480.01, 4500.00, 495.00, 585.00),
(227, 2020, 4, '', '', 4500.01, 4520.00, 498.00, 588.00),
(228, 2020, 4, '', '', 4520.01, 4540.00, 500.00, 591.00),
(229, 2020, 4, '', '', 4540.01, 4560.00, 502.00, 593.00),
(230, 2020, 4, '', '', 4560.01, 4580.00, 504.00, 596.00),
(231, 2020, 4, '', '', 4580.01, 4600.00, 506.00, 598.00),
(232, 2020, 4, '', '', 4600.01, 4620.00, 509.00, 601.00),
(233, 2020, 4, '', '', 4620.01, 4640.00, 511.00, 604.00),
(234, 2020, 4, '', '', 4640.01, 4660.00, 513.00, 606.00),
(235, 2020, 4, '', '', 4660.01, 4680.00, 515.00, 609.00),
(236, 2020, 4, '', '', 4680.01, 4700.00, 517.00, 611.00),
(237, 2020, 4, '', '', 4700.01, 4720.00, 520.00, 614.00),
(238, 2020, 4, '', '', 4720.01, 4740.00, 522.00, 617.00),
(239, 2020, 4, '', '', 4740.01, 4760.00, 524.00, 619.00),
(240, 2020, 4, '', '', 4760.01, 4780.00, 526.00, 622.00),
(241, 2020, 4, '', '', 4780.01, 4800.00, 528.00, 624.00),
(242, 2020, 4, '', '', 4800.01, 4820.00, 531.00, 627.00),
(243, 2020, 4, '', '', 4820.01, 4840.00, 533.00, 630.00),
(244, 2020, 4, '', '', 4840.01, 4860.00, 535.00, 632.00),
(245, 2020, 4, '', '', 4860.01, 4880.00, 537.00, 635.00),
(246, 2020, 4, '', '', 4880.01, 4900.00, 539.00, 637.00),
(247, 2020, 4, '', '', 4900.01, 4920.00, 542.00, 640.00),
(248, 2020, 4, '', '', 4920.01, 4940.00, 544.00, 643.00),
(249, 2020, 4, '', '', 4940.01, 4960.00, 546.00, 645.00),
(250, 2020, 4, '', '', 4960.01, 4980.00, 548.00, 648.00),
(251, 2020, 4, '', '', 4980.01, 5000.00, 550.00, 650.00),
(252, 2020, 4, '', '', 5000.01, 5100.00, 561.00, 612.00),
(253, 2020, 4, '', '', 5100.01, 5200.00, 572.00, 624.00),
(254, 2020, 4, '', '', 5200.01, 5300.00, 583.00, 636.00),
(255, 2020, 4, '', '', 5300.01, 5400.00, 594.00, 648.00),
(256, 2020, 4, '', '', 5400.01, 5500.00, 605.00, 660.00),
(257, 2020, 4, '', '', 5500.01, 5600.00, 616.00, 672.00),
(258, 2020, 4, '', '', 5600.01, 5700.00, 627.00, 684.00),
(259, 2020, 4, '', '', 5700.01, 5800.00, 638.00, 696.00),
(260, 2020, 4, '', '', 5800.01, 5900.00, 649.00, 708.00),
(261, 2020, 4, '', '', 5900.01, 6000.00, 660.00, 720.00),
(262, 2020, 4, '', '', 6000.01, 6100.00, 671.00, 732.00),
(263, 2020, 4, '', '', 6100.01, 6200.00, 682.00, 744.00),
(264, 2020, 4, '', '', 6200.01, 6300.00, 693.00, 756.00),
(265, 2020, 4, '', '', 6300.01, 6400.00, 704.00, 768.00),
(266, 2020, 4, '', '', 6400.01, 6500.00, 715.00, 780.00),
(267, 2020, 4, '', '', 6500.01, 6600.00, 726.00, 792.00),
(268, 2020, 4, '', '', 6600.01, 6700.00, 737.00, 804.00),
(269, 2020, 4, '', '', 6700.01, 6800.00, 748.00, 816.00),
(270, 2020, 4, '', '', 6800.01, 6900.00, 759.00, 828.00),
(271, 2020, 4, '', '', 6900.01, 7000.00, 770.00, 840.00),
(272, 2020, 4, '', '', 7000.01, 7100.00, 781.00, 852.00),
(273, 2020, 4, '', '', 7100.01, 7200.00, 792.00, 864.00),
(274, 2020, 4, '', '', 7200.01, 7300.00, 803.00, 876.00),
(275, 2020, 4, '', '', 7300.01, 7400.00, 814.00, 888.00),
(276, 2020, 4, '', '', 7400.01, 7500.00, 825.00, 900.00),
(277, 2020, 4, '', '', 7500.01, 7600.00, 836.00, 912.00),
(278, 2020, 4, '', '', 7600.01, 7700.00, 847.00, 924.00),
(279, 2020, 4, '', '', 7700.01, 7800.00, 858.00, 936.00),
(280, 2020, 4, '', '', 7800.01, 7900.00, 869.00, 948.00),
(281, 2020, 4, '', '', 7900.01, 8000.00, 880.00, 960.00),
(282, 2020, 4, '', '', 8000.01, 8100.00, 891.00, 972.00),
(283, 2020, 4, '', '', 8100.01, 8200.00, 902.00, 984.00),
(284, 2020, 4, '', '', 8200.01, 8300.00, 913.00, 996.00),
(285, 2020, 4, '', '', 8300.01, 8400.00, 924.00, 1008.00),
(286, 2020, 4, '', '', 8400.01, 8500.00, 935.00, 1020.00),
(287, 2020, 4, '', '', 8500.01, 8600.00, 946.00, 1032.00),
(288, 2020, 4, '', '', 8600.01, 8700.00, 957.00, 1044.00),
(289, 2020, 4, '', '', 8700.01, 8800.00, 968.00, 1056.00),
(290, 2020, 4, '', '', 8800.01, 8900.00, 979.00, 1068.00),
(291, 2020, 4, '', '', 8900.01, 9000.00, 990.00, 1080.00),
(292, 2020, 4, '', '', 9000.01, 9100.00, 1001.00, 1092.00),
(293, 2020, 4, '', '', 9100.01, 9200.00, 1012.00, 1104.00),
(294, 2020, 4, '', '', 9200.01, 9300.00, 1023.00, 1116.00),
(295, 2020, 4, '', '', 9300.01, 9400.00, 1034.00, 1128.00),
(296, 2020, 4, '', '', 9400.01, 9500.00, 1045.00, 1140.00),
(297, 2020, 4, '', '', 9500.01, 9600.00, 1056.00, 1152.00),
(298, 2020, 4, '', '', 9600.01, 9700.00, 1067.00, 1164.00),
(299, 2020, 4, '', '', 9700.01, 9800.00, 1078.00, 1176.00),
(300, 2020, 4, '', '', 9800.01, 9900.00, 1089.00, 1188.00),
(301, 2020, 4, '', '', 9900.01, 10000.00, 1100.00, 1200.00),
(302, 0, 0, '', '', 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `epf_report`
--

CREATE TABLE `epf_report` (
  `epf_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `epf_report_total` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_summary_report`
--

CREATE TABLE `payroll_summary_report` (
  `payroll_summary_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `process_adhoc_id` int(11) NOT NULL,
  `payroll_summary_report_gross_pay` double NOT NULL,
  `payroll_summary_report_gross_deduction` double NOT NULL,
  `payroll_summary_report_gross_net` double NOT NULL,
  `payroll_summary_report_adjustment` double NOT NULL,
  `payroll_summary_report_net_pay` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payslip_report`
--

CREATE TABLE `payslip_report` (
  `payslip_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `process_adhoc_id` int(11) NOT NULL,
  `payslip_report_gross_pay` double NOT NULL,
  `payslip_report_gross_deduction` double NOT NULL,
  `payslip_report_gross_net` double(11,2) NOT NULL,
  `payslip_report_adjustment` double NOT NULL,
  `payslip_report_net_pay` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `process_adhoc`
--

CREATE TABLE `process_adhoc` (
  `process_adhoc_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `epf_formula_id` int(11) NOT NULL,
  `socso_formula_id` int(11) NOT NULL,
  `eis_formula_id` int(11) NOT NULL,
  `process_adhoc_process_date` date NOT NULL,
  `process_adhoc_from` date NOT NULL,
  `process_adhoc_to` date NOT NULL,
  `process_adhoc_contribution_epf` varchar(255) NOT NULL,
  `process_adhoc_contributioin_socso` varchar(255) NOT NULL,
  `process_adhoc_contributioin_eis` varchar(255) NOT NULL,
  `process_adhoc_status` varchar(255) NOT NULL,
  `process_adhoc_desc_1` varchar(255) NOT NULL,
  `process_adhoc_desc_2` varchar(255) NOT NULL,
  `process_adhoc_ref_1` varchar(255) NOT NULL,
  `process_adhoc_ref_2` varchar(255) NOT NULL,
  `process_adhoc_wage` double(11,2) NOT NULL,
  `process_adhoc_allowance` double(11,2) NOT NULL,
  `process_adhoc_overtime` double(11,2) NOT NULL,
  `process_adhoc_commision` double(11,2) NOT NULL,
  `process_adhoc_claims` double(11,2) NOT NULL,
  `process_adhoc_director_fees` double(11,2) NOT NULL,
  `process_adhoc_bonus` double(11,2) NOT NULL,
  `process_adhoc_others` double(11,2) NOT NULL,
  `process_adhoc_advance_paid` double(11,2) NOT NULL,
  `process_adhoc_loan` double(11,2) NOT NULL,
  `process_adhoc_deduction` double(11,2) NOT NULL,
  `process_adhoc_unpaid_leave` double(11,2) NOT NULL,
  `process_adhoc_advance_deduct` double(11,2) NOT NULL,
  `epf_employee_deduction` double(11,2) NOT NULL,
  `socso_employee_deduction` double(11,2) NOT NULL,
  `eis_employee_deduction` double(11,2) NOT NULL,
  `epf_employer_deduction` double(11,2) NOT NULL,
  `socso_employer_deduction` double(11,2) NOT NULL,
  `eis_employer_deduction` double(11,2) NOT NULL,
  `process_payroll_gross_pay` double(11,2) NOT NULL,
  `process_payroll_gross_deduction` double(11,2) NOT NULL,
  `process_payroll_gross_net` double(11,2) NOT NULL,
  `process_payroll_adjustment` double(11,2) NOT NULL,
  `process_payroll_net_pay` double(11,2) NOT NULL,
  `data_created_date` date NOT NULL,
  `data_edited_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `process_payroll`
--

CREATE TABLE `process_payroll` (
  `process_payroll_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `epf_formula_id` int(11) DEFAULT NULL,
  `socso_formula_id` int(11) DEFAULT NULL,
  `eis_formula_id` int(11) DEFAULT NULL,
  `process_payroll_process_date` date NOT NULL,
  `process_payroll_from` date NOT NULL,
  `process_payroll_to` date NOT NULL,
  `process_payroll_desc_1` varchar(255) NOT NULL,
  `process_payroll_desc_2` varchar(255) NOT NULL,
  `process_payroll_ref_1` varchar(255) NOT NULL,
  `process_payroll_ref_2` varchar(255) NOT NULL,
  `process_payroll_wage` double(11,2) NOT NULL,
  `process_payroll_allowance` double(11,2) NOT NULL,
  `process_payroll_deduction` double(11,2) NOT NULL,
  `process_payroll_overtime` double(11,2) NOT NULL,
  `process_payroll_commission` double(11,2) NOT NULL,
  `process_payroll_claims` double(11,2) NOT NULL,
  `process_payroll_director_fees` double(11,2) NOT NULL,
  `process_payroll_bonus` double(11,2) NOT NULL,
  `process_payroll_others` double(11,2) NOT NULL,
  `process_payroll_advance_paid` double(11,2) NOT NULL,
  `process_payroll_loan` double(11,2) NOT NULL,
  `process_adhoc_deduction` double(11,2) NOT NULL,
  `process_payroll_unpaid_leave` double(11,2) NOT NULL,
  `process_payroll_advance_deduct` double(11,2) NOT NULL,
  `epf_employee_deduction` double(11,2) NOT NULL,
  `socso_employee_deduction` double(11,2) NOT NULL,
  `eis_employee_deduction` double(11,2) NOT NULL,
  `epf_employer_deduction` double(11,2) NOT NULL,
  `socso_employer_deduction` double(11,2) NOT NULL,
  `eis_employer_deduction` double(11,2) NOT NULL,
  `process_payroll_gross_pay` double(11,2) NOT NULL,
  `process_payroll_gross_deduction` double(11,2) NOT NULL,
  `process_payroll_gross_net` double(11,2) NOT NULL,
  `process_payroll_adjustment` double(11,2) NOT NULL,
  `process_payroll_net_pay` double(11,2) NOT NULL,
  `data_created_date` date NOT NULL,
  `data_edited_date` date NOT NULL,
  `process_payroll_process_month` varchar(255) NOT NULL,
  `process_payroll_process_year` varchar(255) NOT NULL,
  `socso_employee_contribution` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `process_payroll`
--

INSERT INTO `process_payroll` (`process_payroll_id`, `emp_id`, `epf_formula_id`, `socso_formula_id`, `eis_formula_id`, `process_payroll_process_date`, `process_payroll_from`, `process_payroll_to`, `process_payroll_desc_1`, `process_payroll_desc_2`, `process_payroll_ref_1`, `process_payroll_ref_2`, `process_payroll_wage`, `process_payroll_allowance`, `process_payroll_deduction`, `process_payroll_overtime`, `process_payroll_commission`, `process_payroll_claims`, `process_payroll_director_fees`, `process_payroll_bonus`, `process_payroll_others`, `process_payroll_advance_paid`, `process_payroll_loan`, `process_adhoc_deduction`, `process_payroll_unpaid_leave`, `process_payroll_advance_deduct`, `epf_employee_deduction`, `socso_employee_deduction`, `eis_employee_deduction`, `epf_employer_deduction`, `socso_employer_deduction`, `eis_employer_deduction`, `process_payroll_gross_pay`, `process_payroll_gross_deduction`, `process_payroll_gross_net`, `process_payroll_adjustment`, `process_payroll_net_pay`, `data_created_date`, `data_edited_date`, `process_payroll_process_month`, `process_payroll_process_year`, `socso_employee_contribution`) VALUES
(167, 65, NULL, NULL, NULL, '2020-05-08', '2020-05-01', '2020-05-31', '', '', '', '', 3000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 330.00, 14.75, 5.90, 390.00, 36.90, 5.90, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', '5', '2020', 3000.00),
(168, 66, NULL, NULL, NULL, '2020-05-08', '2020-05-01', '2020-05-31', '', '', '', '', 2400.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 264.00, 11.75, 4.70, 312.00, 29.40, 4.70, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', '5', '2020', 2400.00),
(169, 67, NULL, NULL, NULL, '2020-05-08', '2020-05-01', '2020-05-31', '', '', '', '', 1200.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 132.00, 5.75, 2.30, 156.00, 14.40, 2.30, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', '5', '2020', 1200.00),
(170, 65, NULL, NULL, NULL, '2020-05-08', '2020-05-01', '2020-05-31', '', '', '', '', 3000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 330.00, 14.75, 5.90, 390.00, 36.90, 5.90, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', '8', '2020', 3000.00),
(171, 65, NULL, NULL, NULL, '2020-05-10', '2020-05-01', '2020-05-31', '', '', '', '', 3500.00, 0.00, 0.00, 200.00, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 330.00, 14.75, 5.90, 390.00, 36.90, 5.90, 0.00, 0.00, 0.00, -49.35, 0.00, '0000-00-00', '0000-00-00', '6', '2020', 3000.00),
(172, 66, NULL, NULL, NULL, '2020-05-10', '2020-05-01', '2020-05-31', '', '', '', '', 2400.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 264.00, 11.75, 4.70, 312.00, 29.40, 4.70, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', '6', '2020', 2400.00),
(173, 67, NULL, NULL, NULL, '2020-05-10', '2020-05-01', '2020-05-31', '', '', '', '', 1200.00, 75.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 132.00, 5.75, 2.30, 156.00, 14.40, 2.30, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', '6', '2020', 1200.00),
(174, 68, NULL, NULL, NULL, '2020-05-10', '2020-05-01', '2020-05-31', '', '', '', '', 1150.00, 200.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 128.00, 5.75, 2.30, 151.00, 14.40, 2.30, 0.00, 0.00, 0.00, -13.95, 0.00, '0000-00-00', '0000-00-00', '6', '2020', 1200.00);

-- --------------------------------------------------------

--
-- Table structure for table `socso_formula`
--

CREATE TABLE `socso_formula` (
  `socso_formula_id` int(11) NOT NULL,
  `socso_formula_year` varchar(100) DEFAULT NULL,
  `socso_formula_month` varchar(100) DEFAULT NULL,
  `socso_formula_wage_start` double(11,2) DEFAULT NULL,
  `socso_formula_wage_end` double(11,2) DEFAULT NULL,
  `socso_formula_employee_amt` double(11,2) DEFAULT NULL,
  `socso_formula_employer_amt` double(11,2) DEFAULT NULL,
  `socso_formula_total` double(11,2) DEFAULT NULL,
  `socso_formula_employer_contribution` double(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `socso_formula`
--

INSERT INTO `socso_formula` (`socso_formula_id`, `socso_formula_year`, `socso_formula_month`, `socso_formula_wage_start`, `socso_formula_wage_end`, `socso_formula_employee_amt`, `socso_formula_employer_amt`, `socso_formula_total`, `socso_formula_employer_contribution`) VALUES
(1, '', '', 0.01, 30.00, 0.10, 0.40, 0.50, 0.30),
(2, '', '', 30.01, 50.00, 0.20, 0.70, 0.90, 0.50),
(3, '', '', 50.01, 70.00, 0.30, 1.10, 1.40, 0.80),
(4, '', '', 70.01, 100.00, 0.40, 1.50, 1.90, 1.10),
(5, '', '', 100.01, 140.00, 0.60, 2.10, 2.70, 1.50),
(6, '', '', 140.01, 200.00, 0.85, 2.95, 3.80, 2.10),
(7, '', '', 200.01, 300.00, 1.25, 4.35, 5.60, 3.10),
(8, '', '', 300.01, 400.00, 1.75, 6.15, 7.90, 4.40),
(9, '', '', 400.01, 500.00, 2.25, 7.85, 10.10, 5.60),
(10, '', '', 500.01, 600.00, 2.75, 9.65, 12.40, 6.90),
(11, '', '', 600.01, 700.00, 3.25, 11.35, 14.60, 8.10),
(12, '', '', 700.01, 800.00, 3.75, 13.15, 16.90, 9.40),
(13, '', '', 800.01, 900.00, 4.25, 14.85, 19.10, 10.60),
(14, '', '', 900.01, 1000.00, 4.75, 16.65, 21.40, 11.90),
(15, '', '', 1000.01, 1100.00, 5.25, 18.35, 23.60, 13.10),
(16, '', '', 1100.01, 1200.00, 5.75, 20.15, 25.90, 14.40),
(17, '', '', 1200.01, 1300.00, 6.25, 21.85, 28.10, 15.60),
(18, '', '', 1300.01, 1400.00, 6.75, 23.65, 30.40, 16.90),
(19, '', '', 1400.01, 1500.00, 7.25, 25.35, 32.60, 18.10),
(20, '', '', 1500.01, 1600.00, 7.75, 27.15, 34.90, 19.40),
(21, '', '', 1600.01, 1700.00, 8.25, 28.85, 37.10, 20.60),
(22, '', '', 1700.01, 1800.00, 8.75, 30.65, 39.40, 21.90),
(23, '', '', 1800.01, 1900.00, 9.25, 32.35, 41.60, 23.10),
(24, '', '', 1900.01, 2000.00, 9.75, 34.15, 43.90, 24.40),
(25, '', '', 2000.01, 2100.00, 10.25, 35.85, 46.10, 25.60),
(26, '', '', 2100.01, 2200.00, 10.75, 37.65, 48.40, 26.90),
(27, '', '', 2200.01, 2300.00, 11.25, 39.35, 50.60, 28.10),
(28, '', '', 2300.01, 2400.00, 11.75, 41.15, 52.90, 29.40),
(29, '', '', 2400.01, 2500.00, 12.25, 42.85, 55.10, 30.60),
(30, '', '', 2500.01, 2600.00, 12.75, 44.65, 57.40, 31.90),
(31, '', '', 2600.01, 2700.00, 13.25, 46.35, 59.60, 33.10),
(32, '', '', 2700.01, 2800.00, 13.75, 48.15, 61.90, 34.40),
(33, '', '', 2800.01, 2900.00, 14.25, 49.85, 64.10, 35.60),
(34, '', '', 2900.01, 3000.00, 14.75, 51.65, 66.40, 36.90),
(35, '', '', 3000.01, 3100.00, 15.25, 53.35, 68.60, 38.10),
(36, '', '', 3100.01, 3200.00, 15.75, 55.15, 70.90, 39.40),
(37, '', '', 3200.01, 3300.00, 16.25, 56.85, 73.10, 40.60),
(38, '', '', 3300.01, 3400.00, 16.75, 58.65, 75.40, 41.90),
(39, '', '', 3400.01, 3500.00, 17.25, 60.35, 77.60, 43.10),
(40, '', '', 3500.01, 3600.00, 17.75, 62.15, 79.90, 44.40),
(41, '', '', 3600.01, 3700.00, 18.25, 63.85, 82.10, 45.60),
(42, '', '', 3700.01, 3800.00, 18.75, 65.65, 84.40, 46.90),
(43, '', '', 3800.01, 3900.00, 19.25, 67.35, 86.60, 48.10),
(44, '', '', 3900.01, 4000.00, 19.75, 69.05, 88.80, 49.40),
(45, '', '', 4000.01, 99999.99, 19.75, 69.05, 88.80, 49.40);

-- --------------------------------------------------------

--
-- Table structure for table `socso_report`
--

CREATE TABLE `socso_report` (
  `socso_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `socso_report_total` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `table_name`
--

CREATE TABLE `table_name` (
  `epf_formula_id` double DEFAULT NULL,
  `epf_formula_year` double DEFAULT NULL,
  `epf_formula_month` double DEFAULT NULL,
  `epf_formula_employee_rate` varchar(100) DEFAULT NULL,
  `epf_formula_employer_rate` varchar(100) DEFAULT NULL,
  `epf_formula_wage_start` double(11,2) DEFAULT NULL,
  `epf_formula_wage_end` double(11,2) DEFAULT NULL,
  `epf_formula_employee_amt` double(11,2) DEFAULT NULL,
  `epf_formula_employer_amt` double(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_process`
--

CREATE TABLE `temp_process` (
  `id` int(11) NOT NULL,
  `temp_month` varchar(255) NOT NULL,
  `temp_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_process`
--

INSERT INTO `temp_process` (`id`, `temp_month`, `temp_year`) VALUES
(0, '6', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `yir_report`
--

CREATE TABLE `yir_report` (
  `yir_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `process_adhoc_id` int(11) NOT NULL,
  `yir_report_gross_pay` double(11,2) NOT NULL,
  `yir_report_gross_deduction` double(11,2) NOT NULL,
  `yir_report_gross_net` double(11,2) NOT NULL,
  `yir_report_gross_adjustment` double(11,2) NOT NULL,
  `yir_report_net_pay` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ywr_report`
--

CREATE TABLE `ywr_report` (
  `ywr_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `ywr_report_total` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username_id`);

--
-- Indexes for table `allowance`
--
ALTER TABLE `allowance`
  ADD PRIMARY KEY (`allowance_id`);

--
-- Indexes for table `deduction`
--
ALTER TABLE `deduction`
  ADD PRIMARY KEY (`deduction_id`);

--
-- Indexes for table `eis_formula`
--
ALTER TABLE `eis_formula`
  ADD PRIMARY KEY (`eis_formula_id`);

--
-- Indexes for table `eis_report`
--
ALTER TABLE `eis_report`
  ADD PRIMARY KEY (`eis_report_id`),
  ADD KEY `process_payroll_id` (`process_payroll_id`);

--
-- Indexes for table `employee_allowance`
--
ALTER TABLE `employee_allowance`
  ADD PRIMARY KEY (`emp_allowance_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `allowance_id` (`allowance_id`);

--
-- Indexes for table `employee_deduction`
--
ALTER TABLE `employee_deduction`
  ADD PRIMARY KEY (`emp_deduction_id`);

--
-- Indexes for table `employee_id_count`
--
ALTER TABLE `employee_id_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `epf_formula`
--
ALTER TABLE `epf_formula`
  ADD PRIMARY KEY (`epf_formula_id`);

--
-- Indexes for table `epf_report`
--
ALTER TABLE `epf_report`
  ADD PRIMARY KEY (`epf_report_id`),
  ADD KEY `process_payroll_id` (`process_payroll_id`);

--
-- Indexes for table `payroll_summary_report`
--
ALTER TABLE `payroll_summary_report`
  ADD PRIMARY KEY (`payroll_summary_report_id`),
  ADD KEY `process_payroll_id` (`process_payroll_id`),
  ADD KEY `process_adhoc_id` (`process_adhoc_id`);

--
-- Indexes for table `payslip_report`
--
ALTER TABLE `payslip_report`
  ADD PRIMARY KEY (`payslip_report_id`),
  ADD KEY `process_payroll_id` (`process_payroll_id`),
  ADD KEY `process_adhoc_id` (`process_adhoc_id`);

--
-- Indexes for table `process_adhoc`
--
ALTER TABLE `process_adhoc`
  ADD PRIMARY KEY (`process_adhoc_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `epf_formula_id` (`epf_formula_id`),
  ADD KEY `socso_formula_id` (`socso_formula_id`),
  ADD KEY `eis_formula_id` (`eis_formula_id`);

--
-- Indexes for table `process_payroll`
--
ALTER TABLE `process_payroll`
  ADD PRIMARY KEY (`process_payroll_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `socso_formula_id` (`socso_formula_id`),
  ADD KEY `eis_formula_id` (`eis_formula_id`),
  ADD KEY `epf_formula_id` (`epf_formula_id`);

--
-- Indexes for table `socso_formula`
--
ALTER TABLE `socso_formula`
  ADD PRIMARY KEY (`socso_formula_id`);

--
-- Indexes for table `socso_report`
--
ALTER TABLE `socso_report`
  ADD PRIMARY KEY (`socso_report_id`),
  ADD KEY `process_payroll_id` (`process_payroll_id`);

--
-- Indexes for table `yir_report`
--
ALTER TABLE `yir_report`
  ADD PRIMARY KEY (`yir_report_id`),
  ADD KEY `process_payroll_id` (`process_payroll_id`),
  ADD KEY `process_adhoc_id` (`process_adhoc_id`);

--
-- Indexes for table `ywr_report`
--
ALTER TABLE `ywr_report`
  ADD PRIMARY KEY (`ywr_report_id`),
  ADD KEY `process_payroll_id` (`process_payroll_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `username_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `allowance`
--
ALTER TABLE `allowance`
  MODIFY `allowance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `deduction`
--
ALTER TABLE `deduction`
  MODIFY `deduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `eis_formula`
--
ALTER TABLE `eis_formula`
  MODIFY `eis_formula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `eis_report`
--
ALTER TABLE `eis_report`
  MODIFY `eis_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_allowance`
--
ALTER TABLE `employee_allowance`
  MODIFY `emp_allowance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_deduction`
--
ALTER TABLE `employee_deduction`
  MODIFY `emp_deduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_id_count`
--
ALTER TABLE `employee_id_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `epf_formula`
--
ALTER TABLE `epf_formula`
  MODIFY `epf_formula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `epf_report`
--
ALTER TABLE `epf_report`
  MODIFY `epf_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_summary_report`
--
ALTER TABLE `payroll_summary_report`
  MODIFY `payroll_summary_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payslip_report`
--
ALTER TABLE `payslip_report`
  MODIFY `payslip_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `process_adhoc`
--
ALTER TABLE `process_adhoc`
  MODIFY `process_adhoc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `process_payroll`
--
ALTER TABLE `process_payroll`
  MODIFY `process_payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `socso_formula`
--
ALTER TABLE `socso_formula`
  MODIFY `socso_formula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `socso_report`
--
ALTER TABLE `socso_report`
  MODIFY `socso_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yir_report`
--
ALTER TABLE `yir_report`
  MODIFY `yir_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ywr_report`
--
ALTER TABLE `ywr_report`
  MODIFY `ywr_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eis_report`
--
ALTER TABLE `eis_report`
  ADD CONSTRAINT `eis_report_ibfk_1` FOREIGN KEY (`process_payroll_id`) REFERENCES `eis_report` (`eis_report_id`);

--
-- Constraints for table `employee_allowance`
--
ALTER TABLE `employee_allowance`
  ADD CONSTRAINT `employee_allowance_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_info` (`emp_id`),
  ADD CONSTRAINT `employee_allowance_ibfk_2` FOREIGN KEY (`allowance_id`) REFERENCES `allowance` (`allowance_id`);

--
-- Constraints for table `epf_report`
--
ALTER TABLE `epf_report`
  ADD CONSTRAINT `epf_report_ibfk_1` FOREIGN KEY (`process_payroll_id`) REFERENCES `process_payroll` (`process_payroll_id`);

--
-- Constraints for table `payroll_summary_report`
--
ALTER TABLE `payroll_summary_report`
  ADD CONSTRAINT `payroll_summary_report_ibfk_1` FOREIGN KEY (`process_payroll_id`) REFERENCES `process_payroll` (`process_payroll_id`),
  ADD CONSTRAINT `payroll_summary_report_ibfk_2` FOREIGN KEY (`process_adhoc_id`) REFERENCES `process_adhoc` (`process_adhoc_id`);

--
-- Constraints for table `payslip_report`
--
ALTER TABLE `payslip_report`
  ADD CONSTRAINT `payslip_report_ibfk_1` FOREIGN KEY (`process_payroll_id`) REFERENCES `process_payroll` (`process_payroll_id`),
  ADD CONSTRAINT `payslip_report_ibfk_2` FOREIGN KEY (`process_adhoc_id`) REFERENCES `process_adhoc` (`process_adhoc_id`);

--
-- Constraints for table `process_adhoc`
--
ALTER TABLE `process_adhoc`
  ADD CONSTRAINT `process_adhoc_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_info` (`emp_id`),
  ADD CONSTRAINT `process_adhoc_ibfk_2` FOREIGN KEY (`epf_formula_id`) REFERENCES `epf_formula` (`epf_formula_id`),
  ADD CONSTRAINT `process_adhoc_ibfk_3` FOREIGN KEY (`socso_formula_id`) REFERENCES `socso_formula` (`socso_formula_id`),
  ADD CONSTRAINT `process_adhoc_ibfk_4` FOREIGN KEY (`eis_formula_id`) REFERENCES `eis_formula` (`eis_formula_id`);

--
-- Constraints for table `process_payroll`
--
ALTER TABLE `process_payroll`
  ADD CONSTRAINT `process_payroll_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_info` (`emp_id`),
  ADD CONSTRAINT `process_payroll_ibfk_2` FOREIGN KEY (`eis_formula_id`) REFERENCES `eis_formula` (`eis_formula_id`),
  ADD CONSTRAINT `process_payroll_ibfk_3` FOREIGN KEY (`socso_formula_id`) REFERENCES `socso_formula` (`socso_formula_id`),
  ADD CONSTRAINT `process_payroll_ibfk_4` FOREIGN KEY (`eis_formula_id`) REFERENCES `eis_formula` (`eis_formula_id`),
  ADD CONSTRAINT `process_payroll_ibfk_5` FOREIGN KEY (`epf_formula_id`) REFERENCES `epf_formula` (`epf_formula_id`);

--
-- Constraints for table `socso_report`
--
ALTER TABLE `socso_report`
  ADD CONSTRAINT `socso_report_ibfk_1` FOREIGN KEY (`process_payroll_id`) REFERENCES `process_payroll` (`process_payroll_id`);

--
-- Constraints for table `yir_report`
--
ALTER TABLE `yir_report`
  ADD CONSTRAINT `yir_report_ibfk_1` FOREIGN KEY (`process_payroll_id`) REFERENCES `process_payroll` (`process_payroll_id`),
  ADD CONSTRAINT `yir_report_ibfk_2` FOREIGN KEY (`process_adhoc_id`) REFERENCES `process_adhoc` (`process_adhoc_id`);

--
-- Constraints for table `ywr_report`
--
ALTER TABLE `ywr_report`
  ADD CONSTRAINT `ywr_report_ibfk_1` FOREIGN KEY (`process_payroll_id`) REFERENCES `process_payroll` (`process_payroll_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
