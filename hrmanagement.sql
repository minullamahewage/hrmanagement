-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2019 at 12:29 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

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
('1', 'Colombo', '20', 'Main Street', 'Colombo 07', 'Sri Lanka', '10100'),
('2', 'Kandy', '20', 'Street', 'Kandy', 'Sri Lanka', '1000');

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
(2, 'Human Resource', 'Main', 'First');

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

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` varchar(10) NOT NULL DEFAULT '',
  `NIC` varchar(12) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `addr_line_1` varchar(30) DEFAULT NULL,
  `addr_line_2` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `branch_id` varchar(10) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `job_title_id` int(11) NOT NULL,
  `pay_grade` varchar(10) DEFAULT NULL,
  `emp_status_id` int(11) NOT NULL,
  `superviser_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `NIC`, `name`, `email`, `addr_line_1`, `addr_line_2`, `city`, `country`, `postal_code`, `dob`, `marital_status`, `branch_id`, `dept_id`, `job_title_id`, `pay_grade`, `emp_status_id`, `superviser_id`) VALUES
('1', '9600000001', 'Test Employee One', 'test1@gmail.com', '20', 'Main Street', 'Colombo 07', 'Sri Lanka', '10100', '1996-08-05', 'married', '1', 1, 1, 'Level4', 1, '1');

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
  `to` date DEFAULT NULL,
  `from` date DEFAULT NULL,
  `emp_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_custom`
--

CREATE TABLE `emp_custom` (
  `attribute` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_data`
--

CREATE TABLE `emp_data` (
  `emp_id` varchar(10) NOT NULL,
  `attribute` varchar(20) NOT NULL,
  `value` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_telephone`
--

CREATE TABLE `emp_telephone` (
  `emp_id` varchar(10) NOT NULL DEFAULT '',
  `telephone` varchar(12) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(0, 'Test', NULL),
(1, 'Accountant', NULL),
(2, 'HR Manager', NULL),
(3, 'QA Engineer', NULL),
(4, 'Software Engineer', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `leave_form_id` int(11) NOT NULL,
  `emp_id` varchar(10) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `till` date DEFAULT NULL,
  `leave_type` varchar(15) DEFAULT NULL,
  `approval_status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('Level1', 'No-pay', 50),
('Level2', 'No-pay', 50),
('Level3', 'No-pay', 50),
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
('Level4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(30) DEFAULT NULL,
  `emp_id` varchar(10) DEFAULT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `emp_id`, `type`) VALUES
('test1', 'test1', '1', '');

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
  ADD KEY `superviser_id` (`superviser_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `employee_ibfk_9` (`job_title_id`),
  ADD KEY `emp_status_id` (`emp_status_id`);

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
  ADD KEY `emp_id` (`emp_id`);

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
  ADD KEY `attribute` (`attribute`);

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
  ADD PRIMARY KEY (`username`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dependent`
--
ALTER TABLE `dependent`
  MODIFY `dependent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employ_history`
--
ALTER TABLE `employ_history`
  MODIFY `emp_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leave_form_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_10` FOREIGN KEY (`emp_status_id`) REFERENCES `employment_status` (`id`),
  ADD CONSTRAINT `employee_ibfk_4` FOREIGN KEY (`pay_grade`) REFERENCES `pay_grade` (`pay_grade`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_6` FOREIGN KEY (`superviser_id`) REFERENCES `employee` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_7` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`),
  ADD CONSTRAINT `employee_ibfk_9` FOREIGN KEY (`job_title_id`) REFERENCES `job_title` (`job_title_id`) ON UPDATE CASCADE;

--
-- Constraints for table `employ_history`
--
ALTER TABLE `employ_history`
  ADD CONSTRAINT `employ_history_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `emp_data`
--
ALTER TABLE `emp_data`
  ADD CONSTRAINT `emp_data_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `emp_data_ibfk_2` FOREIGN KEY (`attribute`) REFERENCES `emp_custom` (`attribute`);

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
