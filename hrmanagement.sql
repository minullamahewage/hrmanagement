-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 01, 2020 at 05:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrmanagement`
--
CREATE DATABASE IF NOT EXISTS `hrmanagement` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hrmanagement`;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL,
  `line_1` varchar(30) DEFAULT NULL,
  `line_2` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `name`, `line_1`, `line_2`, `city`, `country`, `postal_code`) VALUES
('1', 'Colombo', '21', 'Main Street', 'Colombo 07', 'Sri Lanka', '10100'),
('2', 'Kandy', '20', 'Street', 'Kandy', 'Sri Lanka', '1000'),
('3', 'Branch 3', '3', 'Road 3', 'City 3', 'Sri Lanka', '10003');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(20) NOT NULL DEFAULT '',
  `building` varchar(20) DEFAULT NULL,
  `floor` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `building`, `floor`) VALUES
(1, 'Finance', 'Main', 'Second'),
(2, 'Human Resource', 'Main', 'First'),
(3, 'IT', 'Main', 'Second'),
(4, 'Maintenance', 'Main', 'Ground');

-- --------------------------------------------------------

--
-- Table structure for table `dependent`
--

CREATE TABLE `dependent` (
  `dependent_id` int(11) NOT NULL,
  `nic` varchar(12) DEFAULT NULL,
  `emp_id` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `telephone` varchar(12) DEFAULT NULL,
  `addr_line_1` varchar(30) DEFAULT NULL,
  `addr_line_2` varchar(30) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dependent`
--

INSERT INTO `dependent` (`dependent_id`, `nic`, `emp_id`, `name`, `email`, `relationship`, `telephone`, `addr_line_1`, `addr_line_2`, `city`, `country`, `postal_code`) VALUES
(1, '900000004', '1', 'Dependent1', 'dependent1@gmail.com', 'Son', '071729729', '20', '20', 'Colombo', 'Sri Lanka', '10001');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contact`
--

CREATE TABLE `emergency_contact` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `telephone` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emergency_contact`
--

INSERT INTO `emergency_contact` (`id`, `emp_id`, `name`, `telephone`) VALUES
(3, '2', 'Em Contact 1', '077123123'),
(4, '3', 'Emergency Contact 2', '1123456783'),
(5, '4', 'Emergency Contact 3', '1123456789'),
(6, '1', 'Emergency Contact 4', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` varchar(10) NOT NULL DEFAULT '',
  `NIC` varchar(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `addr_line_1` varchar(30) NOT NULL,
  `addr_line_2` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `branch_id` varchar(10) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `job_title_id` int(11) NOT NULL,
  `pay_grade` varchar(10) DEFAULT NULL,
  `emp_status_id` int(11) NOT NULL,
  `supervisor_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `NIC`, `name`, `email`, `addr_line_1`, `addr_line_2`, `city`, `country`, `postal_code`, `dob`, `marital_status`, `branch_id`, `dept_id`, `job_title_id`, `pay_grade`, `emp_status_id`, `supervisor_id`) VALUES
('0', '9600000000', 'Admin', 'admin@gmail.com', '10', 'Road 0', 'Colombo', 'Sri Lanka', '10000', '1996-01-01', 'Married', '1', 3, 5, 'Level4', 5, '0'),
('1', '9600000001', 'HR Manager', 'hrmanager@gmail.com', '20', 'Main Street', 'Colombo 07', 'Sri Lanka', '10100', '1996-08-05', 'Unmarried', '1', 2, 2, 'Level4', 1, '1'),
('2', '9700000002', 'Supervisor', 'supervisor@gmail.com', '2', 'Road2', 'Colombo 02', 'Sri Lanka', '10002', '1997-01-30', 'Unmarried', '1', 1, 1, 'Level2', 5, '1'),
('3', '9600000003', 'Manager', 'manager@gmail.com', '20', 'Road 3', 'Colombo 03', 'Sri Lanka', '10003', '1920-01-02', 'Unmarried', '1', 1, 1, 'Level1', 5, '2'),
('4', '9600000004', 'Employee', 'employee@gmail.com', '20', 'Road 4', 'Colombo 4', 'Sri Lanka', '10004', '1997-04-04', 'Married', '2', 3, 4, 'Level4', 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `employment_status`
--

CREATE TABLE `employment_status` (
  `id` int(11) NOT NULL,
  `emp_status` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employment_status`
--

INSERT INTO `employment_status` (`id`, `emp_status`) VALUES
(1, 'Contract Full-time'),
(2, 'Contract Part-time'),
(6, 'Freelance'),
(3, 'Intern Full-time'),
(4, 'Intern Part-time'),
(7, 'NaN'),
(5, 'Permanent');

-- --------------------------------------------------------

--
-- Table structure for table `employ_history`
--

CREATE TABLE `employ_history` (
  `emp_history_id` int(11) NOT NULL,
  `emp_id` varchar(10) DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `emp_status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employ_history`
--

INSERT INTO `employ_history` (`emp_history_id`, `emp_id`, `to_date`, `from_date`, `emp_status_id`) VALUES
(1, '1', '2015-12-18', '2018-12-01', 1);

--
-- Triggers `employ_history`
--
DELIMITER $$
CREATE TRIGGER `check_employ_history_period` BEFORE INSERT ON `employ_history` FOR EACH ROW BEGIN
IF (NEW.to_date < NEW.from_date) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'The Selected Period of Employment is not Valid';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `emp_custom`
--

CREATE TABLE `emp_custom` (
  `attribute` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_custom`
--

INSERT INTO `emp_custom` (`attribute`) VALUES
('custom_attribute_1'),
('custom_attribute_2');

--
-- Triggers `emp_custom`
--
DELIMITER $$
CREATE TRIGGER `after_custom_attribute_insert` AFTER INSERT ON `emp_custom` FOR EACH ROW BEGIN
    DECLARE n INT DEFAULT 0;
	DECLARE i INT DEFAULT 0;
    DECLARE empId VARCHAR(10);
	SELECT COUNT(*) FROM employee INTO n;
	SET i=0;
	WHILE i<n DO 
    	SELECT emp_id from employee limit i,1 into empId;
  		INSERT INTO emp_data(emp_id, attribute) VALUES (empId, NEW.attribute);
  		SET i = i + 1;
	END WHILE;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `emp_data`
--

CREATE TABLE `emp_data` (
  `emp_id` varchar(10) NOT NULL,
  `attribute` varchar(20) NOT NULL,
  `value` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_data`
--

INSERT INTO `emp_data` (`emp_id`, `attribute`, `value`) VALUES
('0', 'custom_attribute_1', NULL),
('0', 'custom_attribute_2', NULL),
('1', 'custom_attribute_1', NULL),
('1', 'custom_attribute_2', NULL),
('2', 'custom_attribute_1', 'custom_data_1_2'),
('2', 'custom_attribute_2', 'custom_data_2_2'),
('3', 'custom_attribute_1', 'custom data 1_3'),
('3', 'custom_attribute_2', 'custom data 2_3'),
('4', 'custom_attribute_1', NULL),
('4', 'custom_attribute_2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp_telephone`
--

CREATE TABLE `emp_telephone` (
  `emp_id` varchar(10) NOT NULL DEFAULT '',
  `telephone` varchar(12) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_telephone`
--

INSERT INTO `emp_telephone` (`emp_id`, `telephone`) VALUES
('1', '071729729'),
('1', '077729729'),
('2', '076729729');

-- --------------------------------------------------------

--
-- Table structure for table `job_title`
--

CREATE TABLE `job_title` (
  `job_title_id` int(11) NOT NULL,
  `job_title` varchar(20) NOT NULL DEFAULT '',
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_title`
--

INSERT INTO `job_title` (`job_title_id`, `job_title`, `description`) VALUES
(1, 'Accountant', NULL),
(2, 'HR Manager', NULL),
(3, 'QA Engineer', NULL),
(4, 'Software Engineer', NULL),
(5, 'DB Admin', 'database admin');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `leave_form_id` int(11) NOT NULL,
  `emp_id` varchar(10) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `till_date` date DEFAULT NULL,
  `leave_type` varchar(15) DEFAULT NULL,
  `approval_status` varchar(15) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`leave_form_id`, `emp_id`, `from_date`, `till_date`, `leave_type`, `approval_status`) VALUES
(1, '1', '2019-10-01', '2019-10-02', 'No-pay', 'False'),
(4, '1', '2014-01-01', '2014-01-03', 'No-pay', 'True'),
(5, '2', '2014-01-01', '2014-01-02', 'No-pay', 'True'),
(6, '1', '2019-12-01', '2019-12-03', 'No-pay', 'True'),
(7, '1', '2019-12-04', '2019-12-10', 'No-pay', 'True'),
(8, '1', '2019-12-01', '2019-12-03', 'No-pay', 'True'),
(9, '1', '2019-12-04', '2019-12-06', 'No-pay', 'True'),
(10, '1', '2019-12-01', '2019-12-03', 'Annual', 'True'),
(11, '2', '2019-12-02', '2019-12-04', 'No-pay', 'False'),
(12, '1', '2014-01-01', '2014-01-02', 'Annual', 'False'),
(13, '1', '2014-01-02', '2014-01-03', 'Annual', 'False'),
(14, '1', '2014-01-02', '2014-01-03', 'Annual', 'False'),
(15, '2', '2014-01-01', '2014-01-10', 'Annual', 'True'),
(17, '2', '2014-01-01', '2014-01-02', 'No-pay', 'True'),
(18, '2', '2014-01-01', '2014-01-02', 'No-pay', 'False'),
(19, '1', '2019-12-01', '2019-12-02', 'No-pay', 'True'),
(20, '3', '2019-12-15', '2019-12-16', 'No-pay', 'True'),
(21, '3', '2019-12-18', '2019-12-20', 'No-pay', 'False'),
(22, '1', '2019-12-30', '2019-12-31', 'Annual', 'True'),
(23, '3', '2019-11-29', '2019-12-29', 'Annual', '0'),
(24, '4', '2020-01-01', '2020-01-03', 'Annual', 'Pending'),
(25, '4', '2019-12-01', '2019-12-03', 'No-pay', 'Pending'),
(26, '2', '2020-01-10', '2020-01-13', 'No-pay', 'Pending');

--
-- Triggers `leaves`
--
DELIMITER $$
CREATE TRIGGER `check_leave_form_dates` BEFORE INSERT ON `leaves` FOR EACH ROW BEGIN
IF (NEW.till_date < NEW.from_date) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Dates are not Valid';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `leaves_days`
-- (See below for the actual view)
--
CREATE TABLE `leaves_days` (
`leave_form_id` int(11)
,`emp_id` varchar(10)
,`leave_type` varchar(15)
,`approval_status` varchar(15)
,`days` int(7)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `leaves_remaining`
-- (See below for the actual view)
--
CREATE TABLE `leaves_remaining` (
`emp_id` varchar(10)
,`leave_type` varchar(15)
,`leave_limit` int(11)
,`leaves_taken` decimal(33,0)
,`leaves_remaining` decimal(34,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `leave_limit`
--

CREATE TABLE `leave_limit` (
  `pay_grade` varchar(10) NOT NULL,
  `leave_type` varchar(15) NOT NULL,
  `leave_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_limit`
--

INSERT INTO `leave_limit` (`pay_grade`, `leave_type`, `leave_limit`) VALUES
('Level1', 'Maternity', 30),
('Level1', 'No-pay', 50),
('Level2', 'Annual', 10),
('Level2', 'Casual', 10),
('Level2', 'No-pay', 50),
('Level3', 'No-pay', 50),
('Level4', 'Annual', 40),
('Level4', 'No-pay', 50);

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `leave_type` varchar(15) NOT NULL DEFAULT '',
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`leave_type`, `description`) VALUES
('Annual', NULL),
('Casual', NULL),
('Maternity', NULL),
('No-pay', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_grade`
--

CREATE TABLE `pay_grade` (
  `pay_grade` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay_grade`
--

INSERT INTO `pay_grade` (`pay_grade`) VALUES
('Level1'),
('Level2'),
('Level3'),
('Level4'),
('Level5');

-- --------------------------------------------------------

--
-- Stand-in structure for view `supervisor`
-- (See below for the actual view)
--
CREATE TABLE `supervisor` (
`emp_id` varchar(10)
,`supervisor_id` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) DEFAULT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` text NOT NULL,
  `emp_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `emp_id`) VALUES
(11, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$Nk/PDr7d.Gezlm5Wu0DHneFMdAxz4eJuCVafCmq/M8b.q6No5y4zG', '0'),
(12, 'hrmanager', '[\"ROLE_HRMANAGER\"]', '$2y$13$5HLQVwUxBiugA2VtjzpAY.62WVLaS9i4BtpY2YVJjS1RC/xtMoExO', '1'),
(13, 'supervisor', '[\"ROLE_SUPERVISOR\"]', '$2y$13$vF8sJjLw3lZaiO2ymwUmiO9NG9p91vZ9wDCRIzwH61ysJvwiRkbEu', '2'),
(14, 'employee', '[\"ROLE_EMPLOYEE\"]', '$2y$13$tt54Oc8kF6px8nnUXhayfOZbjfgUfESsc/VliHgLbSvF2k2acN.kC', '4');

-- --------------------------------------------------------

--
-- Structure for view `leaves_days`
--
DROP TABLE IF EXISTS `leaves_days`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `leaves_days`  AS  select `leaves`.`leave_form_id` AS `leave_form_id`,`leaves`.`emp_id` AS `emp_id`,`leaves`.`leave_type` AS `leave_type`,`leaves`.`approval_status` AS `approval_status`,to_days(`leaves`.`till_date`) - to_days(`leaves`.`from_date`) AS `days` from `leaves` ;

-- --------------------------------------------------------

--
-- Structure for view `leaves_remaining`
--
DROP TABLE IF EXISTS `leaves_remaining`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `leaves_remaining`  AS  select `employee`.`emp_id` AS `emp_id`,`leave_limit`.`leave_type` AS `leave_type`,`leave_limit`.`leave_limit` AS `leave_limit`,ifnull(sum(`leaves_days`.`days`) + 1,0) AS `leaves_taken`,`leave_limit`.`leave_limit` - ifnull(sum(`leaves_days`.`days`) + 1,0) AS `leaves_remaining` from ((`employee` left join `leave_limit` on(`employee`.`pay_grade` = `leave_limit`.`pay_grade`)) left join `leaves_days` on(`employee`.`emp_id` = `leaves_days`.`emp_id` and `leave_limit`.`leave_type` = `leaves_days`.`leave_type` and `leaves_days`.`approval_status` = 'True')) group by `employee`.`emp_id`,`leave_limit`.`leave_type` ;

-- --------------------------------------------------------

--
-- Structure for view `supervisor`
--
DROP TABLE IF EXISTS `supervisor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `supervisor`  AS  select `employee`.`emp_id` AS `emp_id`,`employee`.`supervisor_id` AS `supervisor_id` from `employee` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `dependent`
--
ALTER TABLE `dependent`
  ADD PRIMARY KEY (`dependent_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `pay_grade` (`pay_grade`),
  ADD KEY `superviser_id` (`supervisor_id`),
  ADD KEY `emp_status_id` (`emp_status_id`),
  ADD KEY `job_title_id` (`job_title_id`),
  ADD KEY `employee_ibfk_7` (`dept_id`);

--
-- Indexes for table `employment_status`
--
ALTER TABLE `employment_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_status` (`emp_status`);

--
-- Indexes for table `employ_history`
--
ALTER TABLE `employ_history`
  ADD PRIMARY KEY (`emp_history_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `emp_status` (`emp_status_id`);

--
-- Indexes for table `emp_custom`
--
ALTER TABLE `emp_custom`
  ADD PRIMARY KEY (`attribute`);

--
-- Indexes for table `emp_data`
--
ALTER TABLE `emp_data`
  ADD PRIMARY KEY (`emp_id`,`attribute`),
  ADD KEY `emp_data_ibfk_2` (`attribute`);

--
-- Indexes for table `emp_telephone`
--
ALTER TABLE `emp_telephone`
  ADD PRIMARY KEY (`emp_id`,`telephone`);

--
-- Indexes for table `job_title`
--
ALTER TABLE `job_title`
  ADD PRIMARY KEY (`job_title_id`),
  ADD UNIQUE KEY `job_title` (`job_title`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`leave_form_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `leave_type` (`leave_type`);

--
-- Indexes for table `leave_limit`
--
ALTER TABLE `leave_limit`
  ADD PRIMARY KEY (`pay_grade`,`leave_type`),
  ADD KEY `leave_type` (`leave_type`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`leave_type`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `pay_grade`
--
ALTER TABLE `pay_grade`
  ADD PRIMARY KEY (`pay_grade`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dependent`
--
ALTER TABLE `dependent`
  MODIFY `dependent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employ_history`
--
ALTER TABLE `employ_history`
  MODIFY `emp_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_title`
--
ALTER TABLE `job_title`
  MODIFY `job_title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leave_form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dependent`
--
ALTER TABLE `dependent`
  ADD CONSTRAINT `dependent_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  ADD CONSTRAINT `emergency_contact_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_4` FOREIGN KEY (`pay_grade`) REFERENCES `pay_grade` (`pay_grade`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_6` FOREIGN KEY (`supervisor_id`) REFERENCES `employee` (`emp_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_7` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON UPDATE CASCADE;

--
-- Constraints for table `employ_history`
--
ALTER TABLE `employ_history`
  ADD CONSTRAINT `employ_history_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `employ_history_ibfk_2` FOREIGN KEY (`emp_status_id`) REFERENCES `employment_status` (`id`);

--
-- Constraints for table `emp_data`
--
ALTER TABLE `emp_data`
  ADD CONSTRAINT `emp_data_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `emp_data_ibfk_2` FOREIGN KEY (`attribute`) REFERENCES `emp_custom` (`attribute`) ON DELETE CASCADE;

--
-- Constraints for table `emp_telephone`
--
ALTER TABLE `emp_telephone`
  ADD CONSTRAINT `emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `leaves_ibfk_2` FOREIGN KEY (`leave_type`) REFERENCES `leave_type` (`leave_type`);

--
-- Constraints for table `leave_limit`
--
ALTER TABLE `leave_limit`
  ADD CONSTRAINT `leave_limit_ibfk_1` FOREIGN KEY (`pay_grade`) REFERENCES `pay_grade` (`pay_grade`),
  ADD CONSTRAINT `leave_type` FOREIGN KEY (`leave_type`) REFERENCES `leave_type` (`leave_type`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
