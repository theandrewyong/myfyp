-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2020 at 11:01 AM
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
(3, 'admin', '123', '2', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `allowance`
--

CREATE TABLE `allowance` (
  `allowance_id` int(11) NOT NULL,
  `allowance_desc` varchar(255) NOT NULL,
  `allowance_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowance`
--

INSERT INTO `allowance` (`allowance_id`, `allowance_desc`, `allowance_rate`) VALUES
(4, 'food', 50),
(5, 'drinks', 10);

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE `deduction` (
  `deduction_id` int(11) NOT NULL,
  `deduction_desc` varchar(255) NOT NULL,
  `deduction_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`deduction_id`, `deduction_desc`, `deduction_rate`) VALUES
(6, 'food', 50),
(7, 'drinks', 10);

-- --------------------------------------------------------

--
-- Table structure for table `eis_formula`
--

CREATE TABLE `eis_formula` (
  `eis_formula_id` int(11) NOT NULL,
  `eis_formula_wage_start` varchar(255) NOT NULL,
  `eis_formula_wage_end` varchar(255) NOT NULL,
  `eis_formula_employee_amt` varchar(255) NOT NULL,
  `eis_formula_employer_amt` varchar(255) NOT NULL,
  `eis_formula_total_amt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `emp_id` int(255) NOT NULL,
  `allowance_id` int(11) NOT NULL,
  `deduction_id` int(11) NOT NULL,
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
  `allowance_desc` varchar(255) NOT NULL,
  `deduction_desc` varchar(255) NOT NULL,
  `allowance_rate` double NOT NULL,
  `deduction_rate` double NOT NULL,
  `data_created_date` date NOT NULL,
  `data_edited_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `epf_formula`
--

CREATE TABLE `epf_formula` (
  `epf_formula_id` int(11) NOT NULL,
  `epf_formula_wage_start` varchar(255) NOT NULL,
  `epf_formula_wage_end` varchar(255) NOT NULL,
  `epf_formula_employee_epf` varchar(255) NOT NULL,
  `epf_formula_employer_epf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `payroll_summary_report_gross_pay` varchar(255) NOT NULL,
  `payroll_summary_report_gross_deduction` varchar(255) NOT NULL,
  `payroll_summary_report_gross_net` varchar(255) NOT NULL,
  `payroll_summary_report_adjustment` varchar(255) NOT NULL,
  `payroll_summary_report_net_pay` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payslip_report`
--

CREATE TABLE `payslip_report` (
  `payslip_report_id` int(11) NOT NULL,
  `process_payroll_id` int(11) NOT NULL,
  `process_adhoc_id` int(11) NOT NULL,
  `payslip_report_gross_pay` varchar(255) NOT NULL,
  `payslip_report_gross_deduction` varchar(255) NOT NULL,
  `payslip_report_gross_net` varchar(255) NOT NULL,
  `payslip_report_adjustment` varchar(255) NOT NULL,
  `payslip_report_net_pay` varchar(255) NOT NULL
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
  `process_adhoc_process_date` varchar(255) NOT NULL,
  `process_adhoc_from` varchar(255) NOT NULL,
  `process_adhoc_to` varchar(255) NOT NULL,
  `process_adhoc_desc_1` varchar(255) NOT NULL,
  `process_adhoc_desc_2` varchar(255) NOT NULL,
  `process_adhoc_ref_1` varchar(255) NOT NULL,
  `process_adhoc_ref_2` varchar(255) NOT NULL,
  `process_adhoc_wage` varchar(255) NOT NULL,
  `process_adhoc_allowance` varchar(255) NOT NULL,
  `process_adhoc_overtime` varchar(255) NOT NULL,
  `process_adhoc_commision` varchar(255) NOT NULL,
  `process_adhoc_claims` varchar(255) NOT NULL,
  `process_adhoc_director_fees` varchar(255) NOT NULL,
  `process_adhoc_bonus` varchar(255) NOT NULL,
  `process_adhoc_others` varchar(255) NOT NULL,
  `process_adhoc_advance_paid` varchar(255) NOT NULL,
  `process_adhoc_loan` varchar(255) NOT NULL,
  `process_adhoc_deduction` varchar(255) NOT NULL,
  `process_adhoc_unpaid_leave` varchar(255) NOT NULL,
  `process_adhoc_advance_deduct` varchar(255) NOT NULL,
  `epf_deduction` varchar(255) NOT NULL,
  `socso_deduction` varchar(255) NOT NULL,
  `eis_deduction` varchar(255) NOT NULL,
  `process_payroll_gross_pay` varchar(255) NOT NULL,
  `process_payroll_gross_deduction` varchar(255) NOT NULL,
  `process_payroll_gross_net` varchar(255) NOT NULL,
  `process_payroll_adjustment` varchar(255) NOT NULL,
  `process_payroll_net_pay` varchar(255) NOT NULL,
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
  `epf_formula_id` int(11) NOT NULL,
  `socso_formula_id` int(11) NOT NULL,
  `eis_formula_id` int(11) NOT NULL,
  `process_payroll_process_date` date NOT NULL,
  `process_payroll_from` date NOT NULL,
  `process_payroll_to` date NOT NULL,
  `process_payroll_desc_1` varchar(255) NOT NULL,
  `process_payroll_desc_2` varchar(255) NOT NULL,
  `process_payroll_ref_1` varchar(255) NOT NULL,
  `process_payroll_ref_2` varchar(255) NOT NULL,
  `epf_deduction` varchar(255) NOT NULL,
  `socso_deduction` varchar(255) NOT NULL,
  `eis_deduction` varchar(255) NOT NULL,
  `process_payroll_gross_pay` varchar(255) NOT NULL,
  `process_payroll_gross_deduction` varchar(255) NOT NULL,
  `process_payroll_gross_net` varchar(255) NOT NULL,
  `process_payroll_adjustment` varchar(255) NOT NULL,
  `process_payroll_net_pay` varchar(255) NOT NULL,
  `data_created_date` date NOT NULL,
  `data_edited_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `socso_formula`
--

CREATE TABLE `socso_formula` (
  `socso_formula_id` int(11) NOT NULL,
  `socso_formula_wage_start` varchar(255) NOT NULL,
  `socso_formula_wage_end` varchar(255) NOT NULL,
  `socso_formula_employee_amt` varchar(255) NOT NULL,
  `socso_formula_employer_amt` varchar(255) NOT NULL,
  `socso_total_amt` varchar(255) NOT NULL,
  `socso_employer_contribution_amt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `socso_formula`
--

INSERT INTO `socso_formula` (`socso_formula_id`, `socso_formula_wage_start`, `socso_formula_wage_end`, `socso_formula_employee_amt`, `socso_formula_employer_amt`, `socso_total_amt`, `socso_employer_contribution_amt`) VALUES
(13, '100', '1000', '14', '16', '30', '');

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
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `allowance_id` (`allowance_id`),
  ADD KEY `deduction_id` (`deduction_id`);

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
  ADD KEY `epf_formula_id` (`epf_formula_id`),
  ADD KEY `socso_formula_id` (`socso_formula_id`),
  ADD KEY `eis_formula_id` (`eis_formula_id`);

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
  MODIFY `username_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `allowance`
--
ALTER TABLE `allowance`
  MODIFY `allowance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deduction`
--
ALTER TABLE `deduction`
  MODIFY `deduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `eis_formula`
--
ALTER TABLE `eis_formula`
  MODIFY `eis_formula_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eis_report`
--
ALTER TABLE `eis_report`
  MODIFY `eis_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `emp_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `epf_formula`
--
ALTER TABLE `epf_formula`
  MODIFY `epf_formula_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `process_payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `socso_formula`
--
ALTER TABLE `socso_formula`
  MODIFY `socso_formula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- Constraints for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD CONSTRAINT `employee_info_ibfk_1` FOREIGN KEY (`allowance_id`) REFERENCES `allowance` (`allowance_id`),
  ADD CONSTRAINT `employee_info_ibfk_2` FOREIGN KEY (`deduction_id`) REFERENCES `deduction` (`deduction_id`);

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
  ADD CONSTRAINT `process_payroll_ibfk_2` FOREIGN KEY (`epf_formula_id`) REFERENCES `epf_formula` (`epf_formula_id`),
  ADD CONSTRAINT `process_payroll_ibfk_3` FOREIGN KEY (`socso_formula_id`) REFERENCES `socso_formula` (`socso_formula_id`),
  ADD CONSTRAINT `process_payroll_ibfk_4` FOREIGN KEY (`eis_formula_id`) REFERENCES `eis_formula` (`eis_formula_id`);

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
