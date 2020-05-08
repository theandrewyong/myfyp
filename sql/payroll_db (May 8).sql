-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2020 at 02:04 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

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
  `allowance_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowance`
--

INSERT INTO `allowance` (`allowance_id`, `allowance_display_id`, `allowance_desc`, `allowance_rate`) VALUES
(21, 'P01', 'Petrol Normal', 50),
(22, 'P02', 'Petrol Diesel', 40),
(23, 'F01', 'Food', 25);

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE `deduction` (
  `deduction_id` int(11) NOT NULL,
  `deduction_display_id` varchar(255) NOT NULL,
  `deduction_desc` varchar(255) NOT NULL,
  `deduction_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`deduction_id`, `deduction_display_id`, `deduction_desc`, `deduction_rate`) VALUES
(12, 'L01', 'Late for Work', 25),
(13, 'PA01', 'Panic', 100);

-- --------------------------------------------------------

--
-- Table structure for table `eis_formula`
--

CREATE TABLE `eis_formula` (
  `eis_formula_id` int(11) NOT NULL,
  `eis_formula_year` varchar(100) DEFAULT NULL,
  `eis_formula_wage_start` double DEFAULT NULL,
  `eis_formula_wage_end` double DEFAULT NULL,
  `eis_formula_employee_amt` double DEFAULT NULL,
  `eis_formula_employer_amt` double DEFAULT NULL,
  `eis_formula_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eis_formula`
--

INSERT INTO `eis_formula` (`eis_formula_id`, `eis_formula_year`, `eis_formula_wage_start`, `eis_formula_wage_end`, `eis_formula_employee_amt`, `eis_formula_employer_amt`, `eis_formula_total`) VALUES
(1, '', 0.01, 30, 0.05, 0.05, 0.1),
(2, '', 30.01, 50, 0.1, 0.1, 0.2),
(3, '', 50.01, 70, 0.15, 0.15, 0.3),
(4, '', 70.01, 100, 0.2, 0.2, 0.4),
(5, '', 100.01, 140, 0.25, 0.25, 0.5),
(6, '', 140.01, 200, 0.35, 0.35, 0.7),
(7, '', 200.01, 300, 0.5, 0.5, 1),
(8, '', 300.01, 400, 0.7, 0.7, 1.4),
(9, '', 400.01, 500, 0.9, 0.9, 1.8),
(10, '', 500.01, 600, 1.1, 1.1, 2.2),
(11, '', 600.01, 700, 1.3, 1.3, 2.6),
(12, '', 700.01, 800, 1.5, 1.5, 3),
(13, '', 800.01, 900, 1.7, 1.7, 3.4),
(14, '', 900.01, 1000, 1.9, 1.9, 3.8),
(15, '', 1000.01, 1100, 2.1, 2.1, 4.2),
(16, '', 1100.01, 1200, 2.3, 2.3, 4.6),
(17, '', 1200.01, 1300, 2.5, 2.5, 5),
(18, '', 1300.01, 1400, 2.7, 2.7, 5.4),
(19, '', 1400.01, 1500, 2.9, 2.9, 5.8),
(20, '', 1500.01, 1600, 3.1, 3.1, 6.2),
(21, '', 1600.01, 1700, 3.3, 3.3, 6.6),
(22, '', 1700.01, 1800, 3.5, 3.5, 7),
(23, '', 1800.01, 1900, 3.7, 3.7, 7.4),
(24, '', 1900.01, 2000, 3.9, 3.9, 7.8),
(25, '', 2000.01, 2100, 4.1, 4.1, 8.2),
(26, '', 2100.01, 2200, 4.3, 4.3, 8.6),
(27, '', 2200.01, 2300, 4.5, 4.5, 9),
(28, '', 2300.01, 2400, 4.7, 4.7, 9.4),
(29, '', 2400.01, 2500, 4.9, 4.9, 9.8),
(30, '', 2500.01, 2600, 5.1, 5.1, 10.2),
(31, '', 2600.01, 2700, 5.3, 5.3, 10.6),
(32, '', 2700.01, 2800, 5.5, 5.5, 11),
(33, '', 2800.01, 2900, 5.7, 5.7, 11.4),
(34, '', 2900.01, 3000, 5.9, 5.9, 11.8),
(35, '', 3000.01, 3100, 6.1, 6.1, 12.2),
(36, '', 3100.01, 3200, 6.3, 6.3, 12.6),
(37, '', 3200.01, 3300, 6.5, 6.5, 13),
(38, '', 3300.01, 3400, 6.7, 6.7, 13.4),
(39, '', 3400.01, 3500, 6.9, 6.9, 13.8),
(40, '', 3500.01, 3600, 7.1, 7.1, 14.2),
(41, '', 3600.01, 3700, 7.3, 7.3, 14.6),
(42, '', 3700.01, 3800, 7.5, 7.5, 15),
(43, '', 3800.01, 3900, 7.7, 7.7, 15.4),
(44, '', 3900.01, 4000, 7.9, 7.9, 15.8),
(45, '', 4000.01, 99999.99, 7.9, 7.9, 15.8);

-- --------------------------------------------------------

--
-- Table structure for table `eis_report`
--

CREATE TABLE `eis_report` (
  `eis_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `eis_report_total` double NOT NULL
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
  `allowance_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_deduction`
--

CREATE TABLE `employee_deduction` (
  `emp_deduction_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `deduction_id` int(11) NOT NULL,
  `deduction_desc` varchar(255) NOT NULL,
  `deduction_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1003);

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
  `emp_wages` double NOT NULL,
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
(65, 'E1001', 'Andrew Yong', 'Male', '2020-05-31', 'myrealemail@email.com', 'Tabuan Jaya Crown Square no 88', '0164460111', '082334564', '789012874335', '', '', 'Project Manager', 3000, 'Cheque', 'Maybank', '21223356742', 'Resident', 'Single', 'Work', '223391', '442314', 'Category 1', 'Yes', '2020-05-31', '2020-05-31', '0000-00-00', 0, 0, '2020-05-08', '0000-00-00'),
(66, 'E1002', 'Wu Zhe Tian', 'Female', '2019-06-14', 'wuzhetian@email.com', 'Wu My House no 96', '0113327865', '083445678', '927816896556', '', '', 'Supervisor', 2400, 'Cheque', 'Maybank', '223829712', 'Resident', 'Single', 'Work', '123554', '123512', 'Category 1', 'Yes', '2020-05-31', '2020-05-31', '0000-00-00', 0, 0, '2020-05-08', '0000-00-00'),
(67, 'E1003', 'Sun Mu Kong', 'Male', '2020-05-01', 'sunmukung@email.com', 'Sun and Mood no 38', '0183347854', '0823345567', '378947812334', '', '', 'Wash Toilet', 1200, 'Bank_In', 'Maybank', '12312312112', 'Resident', 'Single', 'Work', '12445', '35664', 'Category 1', 'Yes', '2020-05-31', '2020-05-31', '0000-00-00', 0, 0, '2020-05-08', '0000-00-00');

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
  `epf_formula_wage_start` double DEFAULT NULL,
  `epf_formula_wage_end` double DEFAULT NULL,
  `epf_formula_employee_amt` double DEFAULT NULL,
  `epf_formula_employer_amt` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `epf_formula`
--

INSERT INTO `epf_formula` (`epf_formula_id`, `epf_formula_year`, `epf_formula_month`, `epf_formula_employee_rate`, `epf_formula_employer_rate`, `epf_formula_wage_start`, `epf_formula_wage_end`, `epf_formula_employee_amt`, `epf_formula_employer_amt`) VALUES
(1, 2020, 4, '', '', 0.01, 10, 0, 0),
(2, 2020, 4, '', '', 10.01, 20, 3, 3),
(3, 2020, 4, '', '', 20.01, 40, 5, 6),
(4, 2020, 4, '', '', 40.01, 60, 7, 8),
(5, 2020, 4, '', '', 60.01, 80, 9, 11),
(6, 2020, 4, '', '', 80.01, 100, 11, 13),
(7, 2020, 4, '', '', 100.01, 120, 14, 16),
(8, 2020, 4, '', '', 120.01, 140, 16, 19),
(9, 2020, 4, '', '', 140.01, 160, 18, 21),
(10, 2020, 4, '', '', 160.01, 180, 20, 24),
(11, 2020, 4, '', '', 180.01, 200, 22, 26),
(12, 2020, 4, '', '', 200.01, 220, 25, 29),
(13, 2020, 4, '', '', 220.01, 240, 27, 32),
(14, 2020, 4, '', '', 240.01, 260, 29, 34),
(15, 2020, 4, '', '', 260.01, 280, 31, 37),
(16, 2020, 4, '', '', 280.01, 300, 33, 39),
(17, 2020, 4, '', '', 300.01, 320, 36, 42),
(18, 2020, 4, '', '', 320.01, 340, 38, 45),
(19, 2020, 4, '', '', 340.01, 360, 40, 47),
(20, 2020, 4, '', '', 360.01, 380, 42, 50),
(21, 2020, 4, '', '', 380.01, 400, 44, 52),
(22, 2020, 4, '', '', 400.01, 420, 47, 55),
(23, 2020, 4, '', '', 420.01, 440, 49, 58),
(24, 2020, 4, '', '', 440.01, 460, 51, 60),
(25, 2020, 4, '', '', 460.01, 480, 53, 63),
(26, 2020, 4, '', '', 480.01, 500, 55, 65),
(27, 2020, 4, '', '', 500.01, 520, 58, 68),
(28, 2020, 4, '', '', 520.01, 540, 60, 71),
(29, 2020, 4, '', '', 540.01, 560, 62, 73),
(30, 2020, 4, '', '', 560.01, 580, 64, 76),
(31, 2020, 4, '', '', 580.01, 600, 66, 78),
(32, 2020, 4, '', '', 600.01, 620, 69, 81),
(33, 2020, 4, '', '', 620.01, 640, 71, 84),
(34, 2020, 4, '', '', 640.01, 660, 73, 86),
(35, 2020, 4, '', '', 660.01, 680, 75, 89),
(36, 2020, 4, '', '', 680.01, 700, 77, 91),
(37, 2020, 4, '', '', 700.01, 720, 80, 94),
(38, 2020, 4, '', '', 720.01, 740, 82, 97),
(39, 2020, 4, '', '', 740.01, 760, 84, 99),
(40, 2020, 4, '', '', 760.01, 780, 86, 102),
(41, 2020, 4, '', '', 780.01, 800, 88, 104),
(42, 2020, 4, '', '', 800.01, 820, 91, 107),
(43, 2020, 4, '', '', 820.01, 840, 93, 110),
(44, 2020, 4, '', '', 840.01, 860, 95, 112),
(45, 2020, 4, '', '', 860.01, 880, 97, 115),
(46, 2020, 4, '', '', 880.01, 900, 99, 117),
(47, 2020, 4, '', '', 900.01, 920, 102, 120),
(48, 2020, 4, '', '', 920.01, 940, 104, 123),
(49, 2020, 4, '', '', 940.01, 960, 106, 125),
(50, 2020, 4, '', '', 960.01, 980, 108, 128),
(51, 2020, 4, '', '', 980.01, 1000, 110, 130),
(52, 2020, 4, '', '', 1000.01, 1020, 113, 133),
(53, 2020, 4, '', '', 1020.01, 1040, 115, 136),
(54, 2020, 4, '', '', 1040.01, 1060, 117, 138),
(55, 2020, 4, '', '', 1060.01, 1080, 119, 141),
(56, 2020, 4, '', '', 1080.01, 1100, 121, 143),
(57, 2020, 4, '', '', 1100.01, 1120, 124, 146),
(58, 2020, 4, '', '', 1120.01, 1140, 126, 149),
(59, 2020, 4, '', '', 1140.01, 1160, 128, 151),
(60, 2020, 4, '', '', 1160.01, 1180, 130, 154),
(61, 2020, 4, '', '', 1180.01, 1200, 132, 156),
(62, 2020, 4, '', '', 1200.01, 1220, 135, 159),
(63, 2020, 4, '', '', 1220.01, 1240, 137, 162),
(64, 2020, 4, '', '', 1240.01, 1260, 139, 164),
(65, 2020, 4, '', '', 1260.01, 1280, 141, 167),
(66, 2020, 4, '', '', 1280.01, 1300, 143, 169),
(67, 2020, 4, '', '', 1300.01, 1320, 146, 172),
(68, 2020, 4, '', '', 1320.01, 1340, 148, 175),
(69, 2020, 4, '', '', 1340.01, 1360, 150, 177),
(70, 2020, 4, '', '', 1360.01, 1380, 152, 180),
(71, 2020, 4, '', '', 1380.01, 1400, 154, 182),
(72, 2020, 4, '', '', 1400.01, 1420, 157, 185),
(73, 2020, 4, '', '', 1420.01, 1440, 159, 188),
(74, 2020, 4, '', '', 1440.01, 1460, 161, 190),
(75, 2020, 4, '', '', 1460.01, 1480, 163, 193),
(76, 2020, 4, '', '', 1480.01, 1500, 165, 195),
(77, 2020, 4, '', '', 1500.01, 1520, 168, 198),
(78, 2020, 4, '', '', 1520.01, 1540, 170, 201),
(79, 2020, 4, '', '', 1540.01, 1560, 172, 203),
(80, 2020, 4, '', '', 1560.01, 1580, 174, 206),
(81, 2020, 4, '', '', 1580.01, 1600, 176, 208),
(82, 2020, 4, '', '', 1600.01, 1620, 179, 211),
(83, 2020, 4, '', '', 1620.01, 1640, 181, 214),
(84, 2020, 4, '', '', 1640.01, 1660, 183, 216),
(85, 2020, 4, '', '', 1660.01, 1680, 185, 219),
(86, 2020, 4, '', '', 1680.01, 1700, 187, 221),
(87, 2020, 4, '', '', 1700.01, 1720, 190, 224),
(88, 2020, 4, '', '', 1720.01, 1740, 192, 227),
(89, 2020, 4, '', '', 1740.01, 1760, 194, 229),
(90, 2020, 4, '', '', 1760.01, 1780, 196, 232),
(91, 2020, 4, '', '', 1780.01, 1800, 198, 234),
(92, 2020, 4, '', '', 1800.01, 1820, 201, 237),
(93, 2020, 4, '', '', 1820.01, 1840, 203, 240),
(94, 2020, 4, '', '', 1840.01, 1860, 205, 242),
(95, 2020, 4, '', '', 1860.01, 1880, 207, 245),
(96, 2020, 4, '', '', 1880.01, 1900, 209, 247),
(97, 2020, 4, '', '', 1900.01, 1920, 212, 250),
(98, 2020, 4, '', '', 1920.01, 1940, 214, 253),
(99, 2020, 4, '', '', 1940.01, 1960, 216, 255),
(100, 2020, 4, '', '', 1960.01, 1980, 218, 258),
(101, 2020, 4, '', '', 1980.01, 2000, 220, 260),
(102, 2020, 4, '', '', 2000.01, 2020, 223, 263),
(103, 2020, 4, '', '', 2020.01, 2040, 225, 266),
(104, 2020, 4, '', '', 2040.01, 2060, 227, 268),
(105, 2020, 4, '', '', 2060.01, 2080, 229, 271),
(106, 2020, 4, '', '', 2080.01, 2100, 231, 273),
(107, 2020, 4, '', '', 2100.01, 2120, 234, 276),
(108, 2020, 4, '', '', 2120.01, 2140, 236, 279),
(109, 2020, 4, '', '', 2140.01, 2160, 238, 281),
(110, 2020, 4, '', '', 2160.01, 2180, 240, 284),
(111, 2020, 4, '', '', 2180.01, 2200, 242, 286),
(112, 2020, 4, '', '', 2200.01, 2220, 245, 289),
(113, 2020, 4, '', '', 2220.01, 2240, 247, 292),
(114, 2020, 4, '', '', 2240.01, 2260, 249, 294),
(115, 2020, 4, '', '', 2260.01, 2280, 251, 297),
(116, 2020, 4, '', '', 2280.01, 2300, 253, 299),
(117, 2020, 4, '', '', 2300.01, 2320, 256, 302),
(118, 2020, 4, '', '', 2320.01, 2340, 258, 305),
(119, 2020, 4, '', '', 2340.01, 2360, 260, 307),
(120, 2020, 4, '', '', 2360.01, 2380, 262, 310),
(121, 2020, 4, '', '', 2380.01, 2400, 264, 312),
(122, 2020, 4, '', '', 2400.01, 2420, 267, 315),
(123, 2020, 4, '', '', 2420.01, 2440, 269, 318),
(124, 2020, 4, '', '', 2440.01, 2460, 271, 320),
(125, 2020, 4, '', '', 2460.01, 2480, 273, 323),
(126, 2020, 4, '', '', 2480.01, 2500, 275, 325),
(127, 2020, 4, '', '', 2500.01, 2520, 278, 328),
(128, 2020, 4, '', '', 2520.01, 2540, 280, 331),
(129, 2020, 4, '', '', 2540.01, 2560, 282, 333),
(130, 2020, 4, '', '', 2560.01, 2580, 284, 336),
(131, 2020, 4, '', '', 2580.01, 2600, 286, 338),
(132, 2020, 4, '', '', 2600.01, 2620, 289, 341),
(133, 2020, 4, '', '', 2620.01, 2640, 291, 344),
(134, 2020, 4, '', '', 2640.01, 2660, 293, 346),
(135, 2020, 4, '', '', 2660.01, 2680, 295, 349),
(136, 2020, 4, '', '', 2680.01, 2700, 297, 351),
(137, 2020, 4, '', '', 2700.01, 2720, 300, 354),
(138, 2020, 4, '', '', 2720.01, 2740, 302, 357),
(139, 2020, 4, '', '', 2740.01, 2760, 304, 359),
(140, 2020, 4, '', '', 2760.01, 2780, 306, 362),
(141, 2020, 4, '', '', 2780.01, 2800, 308, 364),
(142, 2020, 4, '', '', 2800.01, 2820, 311, 367),
(143, 2020, 4, '', '', 2820.01, 2840, 313, 370),
(144, 2020, 4, '', '', 2840.01, 2860, 315, 372),
(145, 2020, 4, '', '', 2860.01, 2880, 317, 375),
(146, 2020, 4, '', '', 2880.01, 2900, 319, 377),
(147, 2020, 4, '', '', 2900.01, 2920, 322, 380),
(148, 2020, 4, '', '', 2920.01, 2940, 324, 383),
(149, 2020, 4, '', '', 2940.01, 2960, 326, 385),
(150, 2020, 4, '', '', 2960.01, 2980, 328, 388),
(151, 2020, 4, '', '', 2980.01, 3000, 330, 390),
(152, 2020, 4, '', '', 3000.01, 3020, 333, 393),
(153, 2020, 4, '', '', 3020.01, 3040, 335, 396),
(154, 2020, 4, '', '', 3040.01, 3060, 337, 398),
(155, 2020, 4, '', '', 3060.01, 3080, 339, 401),
(156, 2020, 4, '', '', 3080.01, 3100, 341, 403),
(157, 2020, 4, '', '', 3100.01, 3120, 344, 406),
(158, 2020, 4, '', '', 3120.01, 3140, 346, 409),
(159, 2020, 4, '', '', 3140.01, 3160, 348, 411),
(160, 2020, 4, '', '', 3160.01, 3180, 350, 414),
(161, 2020, 4, '', '', 3180.01, 3200, 352, 416),
(162, 2020, 4, '', '', 3200.01, 3220, 355, 419),
(163, 2020, 4, '', '', 3220.01, 3240, 357, 422),
(164, 2020, 4, '', '', 3240.01, 3260, 359, 424),
(165, 2020, 4, '', '', 3260.01, 3280, 361, 427),
(166, 2020, 4, '', '', 3280.01, 3300, 363, 429),
(167, 2020, 4, '', '', 3300.01, 3320, 366, 432),
(168, 2020, 4, '', '', 3320.01, 3340, 368, 435),
(169, 2020, 4, '', '', 3340.01, 3360, 370, 437),
(170, 2020, 4, '', '', 3360.01, 3380, 372, 440),
(171, 2020, 4, '', '', 3380.01, 3400, 374, 442),
(172, 2020, 4, '', '', 3400.01, 3420, 377, 445),
(173, 2020, 4, '', '', 3420.01, 3440, 379, 448),
(174, 2020, 4, '', '', 3440.01, 3460, 381, 450),
(175, 2020, 4, '', '', 3460.01, 3480, 383, 453),
(176, 2020, 4, '', '', 3480.01, 3500, 385, 455),
(177, 2020, 4, '', '', 3500.01, 3520, 388, 458),
(178, 2020, 4, '', '', 3520.01, 3540, 390, 461),
(179, 2020, 4, '', '', 3540.01, 3560, 392, 463),
(180, 2020, 4, '', '', 3560.01, 3580, 394, 466),
(181, 2020, 4, '', '', 3580.01, 3600, 396, 468),
(182, 2020, 4, '', '', 3600.01, 3620, 399, 471),
(183, 2020, 4, '', '', 3620.01, 3640, 401, 474),
(184, 2020, 4, '', '', 3640.01, 3660, 403, 476),
(185, 2020, 4, '', '', 3660.01, 3680, 405, 479),
(186, 2020, 4, '', '', 3680.01, 3700, 407, 481),
(187, 2020, 4, '', '', 3700.01, 3720, 410, 484),
(188, 2020, 4, '', '', 3720.01, 3740, 412, 487),
(189, 2020, 4, '', '', 3740.01, 3760, 414, 489),
(190, 2020, 4, '', '', 3760.01, 3780, 416, 492),
(191, 2020, 4, '', '', 3780.01, 3800, 418, 494),
(192, 2020, 4, '', '', 3800.01, 3820, 421, 497),
(193, 2020, 4, '', '', 3820.01, 3840, 423, 500),
(194, 2020, 4, '', '', 3840.01, 3860, 425, 502),
(195, 2020, 4, '', '', 3860.01, 3880, 427, 505),
(196, 2020, 4, '', '', 3880.01, 3900, 429, 507),
(197, 2020, 4, '', '', 3900.01, 3920, 432, 510),
(198, 2020, 4, '', '', 3920.01, 3940, 434, 513),
(199, 2020, 4, '', '', 3940.01, 3960, 436, 515),
(200, 2020, 4, '', '', 3960.01, 3980, 438, 518),
(201, 2020, 4, '', '', 3980.01, 4000, 440, 520),
(202, 2020, 4, '', '', 4000.01, 4020, 443, 523),
(203, 2020, 4, '', '', 4020.01, 4040, 445, 526),
(204, 2020, 4, '', '', 4040.01, 4060, 447, 528),
(205, 2020, 4, '', '', 4060.01, 4080, 449, 531),
(206, 2020, 4, '', '', 4080.01, 4100, 451, 533),
(207, 2020, 4, '', '', 4100.01, 4120, 454, 536),
(208, 2020, 4, '', '', 4120.01, 4140, 456, 539),
(209, 2020, 4, '', '', 4140.01, 4160, 458, 541),
(210, 2020, 4, '', '', 4160.01, 4180, 460, 544),
(211, 2020, 4, '', '', 4180.01, 4200, 462, 546),
(212, 2020, 4, '', '', 4200.01, 4220, 465, 549),
(213, 2020, 4, '', '', 4220.01, 4240, 467, 552),
(214, 2020, 4, '', '', 4240.01, 4260, 469, 554),
(215, 2020, 4, '', '', 4260.01, 4280, 471, 557),
(216, 2020, 4, '', '', 4280.01, 4300, 473, 559),
(217, 2020, 4, '', '', 4300.01, 4320, 476, 562),
(218, 2020, 4, '', '', 4320.01, 4340, 478, 565),
(219, 2020, 4, '', '', 4340.01, 4360, 480, 567),
(220, 2020, 4, '', '', 4360.01, 4380, 482, 570),
(221, 2020, 4, '', '', 4380.01, 4400, 484, 572),
(222, 2020, 4, '', '', 4400.01, 4420, 487, 575),
(223, 2020, 4, '', '', 4420.01, 4440, 489, 578),
(224, 2020, 4, '', '', 4440.01, 4460, 491, 580),
(225, 2020, 4, '', '', 4460.01, 4480, 493, 583),
(226, 2020, 4, '', '', 4480.01, 4500, 495, 585),
(227, 2020, 4, '', '', 4500.01, 4520, 498, 588),
(228, 2020, 4, '', '', 4520.01, 4540, 500, 591),
(229, 2020, 4, '', '', 4540.01, 4560, 502, 593),
(230, 2020, 4, '', '', 4560.01, 4580, 504, 596),
(231, 2020, 4, '', '', 4580.01, 4600, 506, 598),
(232, 2020, 4, '', '', 4600.01, 4620, 509, 601),
(233, 2020, 4, '', '', 4620.01, 4640, 511, 604),
(234, 2020, 4, '', '', 4640.01, 4660, 513, 606),
(235, 2020, 4, '', '', 4660.01, 4680, 515, 609),
(236, 2020, 4, '', '', 4680.01, 4700, 517, 611),
(237, 2020, 4, '', '', 4700.01, 4720, 520, 614),
(238, 2020, 4, '', '', 4720.01, 4740, 522, 617),
(239, 2020, 4, '', '', 4740.01, 4760, 524, 619),
(240, 2020, 4, '', '', 4760.01, 4780, 526, 622),
(241, 2020, 4, '', '', 4780.01, 4800, 528, 624),
(242, 2020, 4, '', '', 4800.01, 4820, 531, 627),
(243, 2020, 4, '', '', 4820.01, 4840, 533, 630),
(244, 2020, 4, '', '', 4840.01, 4860, 535, 632),
(245, 2020, 4, '', '', 4860.01, 4880, 537, 635),
(246, 2020, 4, '', '', 4880.01, 4900, 539, 637),
(247, 2020, 4, '', '', 4900.01, 4920, 542, 640),
(248, 2020, 4, '', '', 4920.01, 4940, 544, 643),
(249, 2020, 4, '', '', 4940.01, 4960, 546, 645),
(250, 2020, 4, '', '', 4960.01, 4980, 548, 648),
(251, 2020, 4, '', '', 4980.01, 5000, 550, 650),
(252, 2020, 4, '', '', 5000.01, 5100, 561, 612),
(253, 2020, 4, '', '', 5100.01, 5200, 572, 624),
(254, 2020, 4, '', '', 5200.01, 5300, 583, 636),
(255, 2020, 4, '', '', 5300.01, 5400, 594, 648),
(256, 2020, 4, '', '', 5400.01, 5500, 605, 660),
(257, 2020, 4, '', '', 5500.01, 5600, 616, 672),
(258, 2020, 4, '', '', 5600.01, 5700, 627, 684),
(259, 2020, 4, '', '', 5700.01, 5800, 638, 696),
(260, 2020, 4, '', '', 5800.01, 5900, 649, 708),
(261, 2020, 4, '', '', 5900.01, 6000, 660, 720),
(262, 2020, 4, '', '', 6000.01, 6100, 671, 732),
(263, 2020, 4, '', '', 6100.01, 6200, 682, 744),
(264, 2020, 4, '', '', 6200.01, 6300, 693, 756),
(265, 2020, 4, '', '', 6300.01, 6400, 704, 768),
(266, 2020, 4, '', '', 6400.01, 6500, 715, 780),
(267, 2020, 4, '', '', 6500.01, 6600, 726, 792),
(268, 2020, 4, '', '', 6600.01, 6700, 737, 804),
(269, 2020, 4, '', '', 6700.01, 6800, 748, 816),
(270, 2020, 4, '', '', 6800.01, 6900, 759, 828),
(271, 2020, 4, '', '', 6900.01, 7000, 770, 840),
(272, 2020, 4, '', '', 7000.01, 7100, 781, 852),
(273, 2020, 4, '', '', 7100.01, 7200, 792, 864),
(274, 2020, 4, '', '', 7200.01, 7300, 803, 876),
(275, 2020, 4, '', '', 7300.01, 7400, 814, 888),
(276, 2020, 4, '', '', 7400.01, 7500, 825, 900),
(277, 2020, 4, '', '', 7500.01, 7600, 836, 912),
(278, 2020, 4, '', '', 7600.01, 7700, 847, 924),
(279, 2020, 4, '', '', 7700.01, 7800, 858, 936),
(280, 2020, 4, '', '', 7800.01, 7900, 869, 948),
(281, 2020, 4, '', '', 7900.01, 8000, 880, 960),
(282, 2020, 4, '', '', 8000.01, 8100, 891, 972),
(283, 2020, 4, '', '', 8100.01, 8200, 902, 984),
(284, 2020, 4, '', '', 8200.01, 8300, 913, 996),
(285, 2020, 4, '', '', 8300.01, 8400, 924, 1008),
(286, 2020, 4, '', '', 8400.01, 8500, 935, 1020),
(287, 2020, 4, '', '', 8500.01, 8600, 946, 1032),
(288, 2020, 4, '', '', 8600.01, 8700, 957, 1044),
(289, 2020, 4, '', '', 8700.01, 8800, 968, 1056),
(290, 2020, 4, '', '', 8800.01, 8900, 979, 1068),
(291, 2020, 4, '', '', 8900.01, 9000, 990, 1080),
(292, 2020, 4, '', '', 9000.01, 9100, 1001, 1092),
(293, 2020, 4, '', '', 9100.01, 9200, 1012, 1104),
(294, 2020, 4, '', '', 9200.01, 9300, 1023, 1116),
(295, 2020, 4, '', '', 9300.01, 9400, 1034, 1128),
(296, 2020, 4, '', '', 9400.01, 9500, 1045, 1140),
(297, 2020, 4, '', '', 9500.01, 9600, 1056, 1152),
(298, 2020, 4, '', '', 9600.01, 9700, 1067, 1164),
(299, 2020, 4, '', '', 9700.01, 9800, 1078, 1176),
(300, 2020, 4, '', '', 9800.01, 9900, 1089, 1188),
(301, 2020, 4, '', '', 9900.01, 10000, 1100, 1200),
(302, 0, 0, '', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `epf_report`
--

CREATE TABLE `epf_report` (
  `epf_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `epf_report_total` double NOT NULL
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
  `payroll_summary_report_net_pay` double NOT NULL
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
  `payslip_report_gross_net` double NOT NULL,
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
  `process_adhoc_wage` double NOT NULL,
  `process_adhoc_allowance` double NOT NULL,
  `process_adhoc_overtime` double NOT NULL,
  `process_adhoc_commision` double NOT NULL,
  `process_adhoc_claims` double NOT NULL,
  `process_adhoc_director_fees` double NOT NULL,
  `process_adhoc_bonus` double NOT NULL,
  `process_adhoc_others` double NOT NULL,
  `process_adhoc_advance_paid` double NOT NULL,
  `process_adhoc_loan` double NOT NULL,
  `process_adhoc_deduction` double NOT NULL,
  `process_adhoc_unpaid_leave` double NOT NULL,
  `process_adhoc_advance_deduct` double NOT NULL,
  `epf_employee_deduction` double NOT NULL,
  `socso_employee_deduction` double NOT NULL,
  `eis_employee_deduction` double NOT NULL,
  `epf_employer_deduction` double NOT NULL,
  `socso_employer_deduction` double NOT NULL,
  `eis_employer_deduction` double NOT NULL,
  `process_payroll_gross_pay` double NOT NULL,
  `process_payroll_gross_deduction` double NOT NULL,
  `process_payroll_gross_net` double NOT NULL,
  `process_payroll_adjustment` double NOT NULL,
  `process_payroll_net_pay` double NOT NULL,
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
  `process_payroll_wage` double NOT NULL,
  `process_payroll_allowance` double NOT NULL,
  `process_payroll_deduction` double NOT NULL,
  `process_payroll_overtime` double NOT NULL,
  `process_payroll_commission` double NOT NULL,
  `process_payroll_claims` double NOT NULL,
  `process_payroll_director_fees` double NOT NULL,
  `process_payroll_bonus` double NOT NULL,
  `process_payroll_others` double NOT NULL,
  `process_payroll_advance_paid` double NOT NULL,
  `process_payroll_loan` double NOT NULL,
  `process_adhoc_deduction` double NOT NULL,
  `process_payroll_unpaid_leave` double NOT NULL,
  `process_payroll_advance_deduct` double NOT NULL,
  `epf_employee_deduction` double NOT NULL,
  `socso_employee_deduction` double NOT NULL,
  `eis_employee_deduction` double NOT NULL,
  `epf_employer_deduction` double NOT NULL,
  `socso_employer_deduction` double NOT NULL,
  `eis_employer_deduction` double NOT NULL,
  `process_payroll_gross_pay` double NOT NULL,
  `process_payroll_gross_deduction` double NOT NULL,
  `process_payroll_gross_net` double NOT NULL,
  `process_payroll_adjustment` double NOT NULL,
  `process_payroll_net_pay` double NOT NULL,
  `data_created_date` date NOT NULL,
  `data_edited_date` date NOT NULL,
  `process_payroll_process_month` varchar(255) NOT NULL,
  `process_payroll_process_year` varchar(255) NOT NULL,
  `socso_employee_contribution` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `process_payroll`
--

INSERT INTO `process_payroll` (`process_payroll_id`, `emp_id`, `epf_formula_id`, `socso_formula_id`, `eis_formula_id`, `process_payroll_process_date`, `process_payroll_from`, `process_payroll_to`, `process_payroll_desc_1`, `process_payroll_desc_2`, `process_payroll_ref_1`, `process_payroll_ref_2`, `process_payroll_wage`, `process_payroll_allowance`, `process_payroll_deduction`, `process_payroll_overtime`, `process_payroll_commission`, `process_payroll_claims`, `process_payroll_director_fees`, `process_payroll_bonus`, `process_payroll_others`, `process_payroll_advance_paid`, `process_payroll_loan`, `process_adhoc_deduction`, `process_payroll_unpaid_leave`, `process_payroll_advance_deduct`, `epf_employee_deduction`, `socso_employee_deduction`, `eis_employee_deduction`, `epf_employer_deduction`, `socso_employer_deduction`, `eis_employer_deduction`, `process_payroll_gross_pay`, `process_payroll_gross_deduction`, `process_payroll_gross_net`, `process_payroll_adjustment`, `process_payroll_net_pay`, `data_created_date`, `data_edited_date`, `process_payroll_process_month`, `process_payroll_process_year`, `socso_employee_contribution`) VALUES
(167, 65, NULL, NULL, NULL, '2020-05-08', '2020-05-01', '2020-05-31', '', '', '', '', 3000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 330, 14.75, 5.9, 390, 36.9, 5.9, 0, 0, 0, 0, 0, '0000-00-00', '0000-00-00', '5', '2020', 3000),
(168, 66, NULL, NULL, NULL, '2020-05-08', '2020-05-01', '2020-05-31', '', '', '', '', 2400, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 264, 11.75, 4.7, 312, 29.4, 4.7, 0, 0, 0, 0, 0, '0000-00-00', '0000-00-00', '5', '2020', 2400),
(169, 67, NULL, NULL, NULL, '2020-05-08', '2020-05-01', '2020-05-31', '', '', '', '', 1200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 132, 5.75, 2.3, 156, 14.4, 2.3, 0, 0, 0, 0, 0, '0000-00-00', '0000-00-00', '5', '2020', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `socso_formula`
--

CREATE TABLE `socso_formula` (
  `socso_formula_id` int(11) NOT NULL,
  `socso_formula_year` varchar(100) DEFAULT NULL,
  `socso_formula_month` varchar(100) DEFAULT NULL,
  `socso_formula_wage_start` double DEFAULT NULL,
  `socso_formula_wage_end` double DEFAULT NULL,
  `socso_formula_employee_amt` double DEFAULT NULL,
  `socso_formula_employer_amt` double DEFAULT NULL,
  `socso_formula_total` double DEFAULT NULL,
  `socso_formula_employer_contribution` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `socso_formula`
--

INSERT INTO `socso_formula` (`socso_formula_id`, `socso_formula_year`, `socso_formula_month`, `socso_formula_wage_start`, `socso_formula_wage_end`, `socso_formula_employee_amt`, `socso_formula_employer_amt`, `socso_formula_total`, `socso_formula_employer_contribution`) VALUES
(1, '', '', 0.01, 30, 0.1, 0.4, 0.5, 0.3),
(2, '', '', 30.01, 50, 0.2, 0.7, 0.9, 0.5),
(3, '', '', 50.01, 70, 0.3, 1.1, 1.4, 0.8),
(4, '', '', 70.01, 100, 0.4, 1.5, 1.9, 1.1),
(5, '', '', 100.01, 140, 0.6, 2.1, 2.7, 1.5),
(6, '', '', 140.01, 200, 0.85, 2.95, 3.8, 2.1),
(7, '', '', 200.01, 300, 1.25, 4.35, 5.6, 3.1),
(8, '', '', 300.01, 400, 1.75, 6.15, 7.9, 4.4),
(9, '', '', 400.01, 500, 2.25, 7.85, 10.1, 5.6),
(10, '', '', 500.01, 600, 2.75, 9.65, 12.4, 6.9),
(11, '', '', 600.01, 700, 3.25, 11.35, 14.6, 8.1),
(12, '', '', 700.01, 800, 3.75, 13.15, 16.9, 9.4),
(13, '', '', 800.01, 900, 4.25, 14.85, 19.1, 10.6),
(14, '', '', 900.01, 1000, 4.75, 16.65, 21.4, 11.9),
(15, '', '', 1000.01, 1100, 5.25, 18.35, 23.6, 13.1),
(16, '', '', 1100.01, 1200, 5.75, 20.15, 25.9, 14.4),
(17, '', '', 1200.01, 1300, 6.25, 21.85, 28.1, 15.6),
(18, '', '', 1300.01, 1400, 6.75, 23.65, 30.4, 16.9),
(19, '', '', 1400.01, 1500, 7.25, 25.35, 32.6, 18.1),
(20, '', '', 1500.01, 1600, 7.75, 27.15, 34.9, 19.4),
(21, '', '', 1600.01, 1700, 8.25, 28.85, 37.1, 20.6),
(22, '', '', 1700.01, 1800, 8.75, 30.65, 39.4, 21.9),
(23, '', '', 1800.01, 1900, 9.25, 32.35, 41.6, 23.1),
(24, '', '', 1900.01, 2000, 9.75, 34.15, 43.9, 24.4),
(25, '', '', 2000.01, 2100, 10.25, 35.85, 46.1, 25.6),
(26, '', '', 2100.01, 2200, 10.75, 37.65, 48.4, 26.9),
(27, '', '', 2200.01, 2300, 11.25, 39.35, 50.6, 28.1),
(28, '', '', 2300.01, 2400, 11.75, 41.15, 52.9, 29.4),
(29, '', '', 2400.01, 2500, 12.25, 42.85, 55.1, 30.6),
(30, '', '', 2500.01, 2600, 12.75, 44.65, 57.4, 31.9),
(31, '', '', 2600.01, 2700, 13.25, 46.35, 59.6, 33.1),
(32, '', '', 2700.01, 2800, 13.75, 48.15, 61.9, 34.4),
(33, '', '', 2800.01, 2900, 14.25, 49.85, 64.1, 35.6),
(34, '', '', 2900.01, 3000, 14.75, 51.65, 66.4, 36.9),
(35, '', '', 3000.01, 3100, 15.25, 53.35, 68.6, 38.1),
(36, '', '', 3100.01, 3200, 15.75, 55.15, 70.9, 39.4),
(37, '', '', 3200.01, 3300, 16.25, 56.85, 73.1, 40.6),
(38, '', '', 3300.01, 3400, 16.75, 58.65, 75.4, 41.9),
(39, '', '', 3400.01, 3500, 17.25, 60.35, 77.6, 43.1),
(40, '', '', 3500.01, 3600, 17.75, 62.15, 79.9, 44.4),
(41, '', '', 3600.01, 3700, 18.25, 63.85, 82.1, 45.6),
(42, '', '', 3700.01, 3800, 18.75, 65.65, 84.4, 46.9),
(43, '', '', 3800.01, 3900, 19.25, 67.35, 86.6, 48.1),
(44, '', '', 3900.01, 4000, 19.75, 69.05, 88.8, 49.4),
(45, '', '', 4000.01, 99999.99, 19.75, 69.05, 88.8, 49.4);

-- --------------------------------------------------------

--
-- Table structure for table `socso_report`
--

CREATE TABLE `socso_report` (
  `socso_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `socso_report_total` double NOT NULL
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
  `epf_formula_wage_start` double DEFAULT NULL,
  `epf_formula_wage_end` double DEFAULT NULL,
  `epf_formula_employee_amt` double DEFAULT NULL,
  `epf_formula_employer_amt` double DEFAULT NULL
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
(0, '5', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `yir_report`
--

CREATE TABLE `yir_report` (
  `yir_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `process_adhoc_id` int(11) NOT NULL,
  `yir_report_gross_pay` double NOT NULL,
  `yir_report_gross_deduction` double NOT NULL,
  `yir_report_gross_net` double NOT NULL,
  `yir_report_gross_adjustment` double NOT NULL,
  `yir_report_net_pay` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ywr_report`
--

CREATE TABLE `ywr_report` (
  `ywr_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `ywr_report_total` double NOT NULL
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
  MODIFY `username_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `allowance`
--
ALTER TABLE `allowance`
  MODIFY `allowance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `deduction`
--
ALTER TABLE `deduction`
  MODIFY `deduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `emp_allowance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee_deduction`
--
ALTER TABLE `employee_deduction`
  MODIFY `emp_deduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_id_count`
--
ALTER TABLE `employee_id_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

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
  MODIFY `process_payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

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
