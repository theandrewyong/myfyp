-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2020 at 09:48 AM
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
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `emp_id` int(255) NOT NULL,
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
  `emp_wages` varchar(255) NOT NULL,
  `emp_payment_method` varchar(255) NOT NULL,
  `emp_bank_name` varchar(255) NOT NULL,
  `emp_account` varchar(255) NOT NULL,
  `emp_health_status` varchar(255) NOT NULL,
  `emp_martial_status` varchar(255) NOT NULL,
  `emp_spouse_status` varchar(255) NOT NULL,
  `emp_epf` varchar(255) NOT NULL,
  `emp_socso` varchar(255) NOT NULL,
  `emp_socso_type` varchar(255) NOT NULL,
  `emp_eis_type` varchar(255) NOT NULL,
  `emp_join_date` date NOT NULL,
  `emp_confirm_date` date NOT NULL,
  `emp_resign_date` date NOT NULL,
  `allowance_id` int(50) NOT NULL,
  `deduction_id` int(50) NOT NULL,
  `allowance_desc` varchar(255) NOT NULL,
  `deduction_desc` varchar(255) NOT NULL,
  `allowance_rate` double NOT NULL,
  `deduction_rate` double NOT NULL,
  `data_created_date` date NOT NULL,
  `data_edited_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `emp_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
