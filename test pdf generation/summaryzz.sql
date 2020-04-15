-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2020 at 08:18 PM
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
-- Table structure for table `summaryzz`
--

CREATE TABLE `summaryzz` (
  `employee_name` varchar(255) DEFAULT NULL,
  `default_wages` double DEFAULT NULL,
  `meal` double DEFAULT NULL,
  `hphone` double DEFAULT NULL,
  `petrol` double DEFAULT NULL,
  `gross_pay` double DEFAULT NULL,
  `epf` double DEFAULT NULL,
  `socso` double DEFAULT NULL,
  `pcb` double DEFAULT NULL,
  `eis` double DEFAULT NULL,
  `gross_deduct` double DEFAULT NULL,
  `epf_employer` double DEFAULT NULL,
  `socso_employer` double DEFAULT NULL,
  `eis_employer` double DEFAULT NULL,
  `gross_net_pay` double DEFAULT NULL,
  `summary_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summaryzz`
--

INSERT INTO `summaryzz` (`employee_name`, `default_wages`, `meal`, `hphone`, `petrol`, `gross_pay`, `epf`, `socso`, `pcb`, `eis`, `gross_deduct`, `epf_employer`, `socso_employer`, `eis_employer`, `gross_net_pay`, `summary_id`) VALUES
('LEE', 3000, 80, 150, 300, 3530, -390, -17.75, 0, -7.1, -414.85, -461, -62.15, -7.1, 3115.15, 1),
('KOO', 2000, 120, 0, 0, 2120, -234, -10.75, 0, -4.3, -249.05, -276, -37.65, -4.3, 1870.95, 2),
('NICOLE', 2800, 80, 150, 0, 3030, -335, -15.25, 0, -6.1, -356.35, -396, -53.35, -6.1, 2673.65, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `summaryzz`
--
ALTER TABLE `summaryzz`
  ADD PRIMARY KEY (`summary_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `summaryzz`
--
ALTER TABLE `summaryzz`
  MODIFY `summary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
