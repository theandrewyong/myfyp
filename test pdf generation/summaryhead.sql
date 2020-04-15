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
-- Table structure for table `summaryhead`
--

CREATE TABLE `summaryhead` (
  `header1` varchar(255) DEFAULT NULL,
  `header2` varchar(255) DEFAULT NULL,
  `header3` varchar(255) DEFAULT NULL,
  `header4` varchar(255) DEFAULT NULL,
  `header5` varchar(255) DEFAULT NULL,
  `header6` varchar(255) DEFAULT NULL,
  `header7` varchar(255) DEFAULT NULL,
  `header8` varchar(255) DEFAULT NULL,
  `header9` varchar(255) DEFAULT NULL,
  `header10` varchar(255) DEFAULT NULL,
  `header11` varchar(255) DEFAULT NULL,
  `header12` varchar(255) DEFAULT NULL,
  `header13` varchar(255) DEFAULT NULL,
  `header14` varchar(255) DEFAULT NULL,
  `header15` varchar(255) DEFAULT NULL,
  `header16` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summaryhead`
--

INSERT INTO `summaryhead` (`header1`, `header2`, `header3`, `header4`, `header5`, `header6`, `header7`, `header8`, `header9`, `header10`, `header11`, `header12`, `header13`, `header14`, `header15`, `header16`) VALUES
('Name', 'Wages', 'Meal', 'Phone', 'Petrol', 'Gross Pay', 'EPF', 'SOCSO', 'PCB', 'EIS', 'Gross Deduct', 'EPF Employer', 'SOCSO Employer', 'EIS Employer', 'Gross Net Pay', 'ID');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
