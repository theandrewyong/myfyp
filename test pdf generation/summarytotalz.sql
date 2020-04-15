-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2020 at 08:17 PM
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
-- Table structure for table `summarytotalz`
--

CREATE TABLE `summarytotalz` (
  `title` varchar(255) DEFAULT NULL,
  `t_wages` double DEFAULT NULL,
  `t_meal` double DEFAULT NULL,
  `t_hphone` double DEFAULT NULL,
  `t_petrol` double DEFAULT NULL,
  `t_gross_pay` double DEFAULT NULL,
  `t_epf` double DEFAULT NULL,
  `t_socso` double DEFAULT NULL,
  `t_pcb` double DEFAULT NULL,
  `t_eis` double DEFAULT NULL,
  `t_gross_deduct` double DEFAULT NULL,
  `t_epf_employer` double DEFAULT NULL,
  `t_socso_employer` double DEFAULT NULL,
  `t_eis_employer` double DEFAULT NULL,
  `t_gross_net_pay` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summarytotalz`
--

INSERT INTO `summarytotalz` (`title`, `t_wages`, `t_meal`, `t_hphone`, `t_petrol`, `t_gross_pay`, `t_epf`, `t_socso`, `t_pcb`, `t_eis`, `t_gross_deduct`, `t_epf_employer`, `t_socso_employer`, `t_eis_employer`, `t_gross_net_pay`) VALUES
('Grand Total', 7800, 280, 300, 300, 8680, -959, -43.75, 0, -17.5, -1020.25, -1133, -153.15, -17.5, 7659.75);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
