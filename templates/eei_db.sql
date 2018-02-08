-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2018 at 05:17 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eei_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log_t`
--

CREATE TABLE `activity_log_t` (
  `activity_log_id` int(5) NOT NULL,
  `activity_log_details` text NOT NULL,
  `ticket_no` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `it_group_manager`
--

CREATE TABLE `it_group_manager` (
  `it_group_manager_id` int(1) NOT NULL,
  `userid` char(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` char(30) NOT NULL,
  `last_name` char(20) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `it_group` enum('Technical','Access','Network') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification_t`
--

CREATE TABLE `notification_t` (
  `notification_id` int(4) NOT NULL,
  `notification_details` varchar(100) NOT NULL,
  `requestor_id` int(5) NOT NULL,
  `ticket_agent_id` int(2) NOT NULL,
  `it_group_manager_id` int(1) NOT NULL,
  `ticket_no` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requestor_t`
--

CREATE TABLE `requestor_t` (
  `requestor_id` int(5) NOT NULL,
  `first_name` char(30) NOT NULL,
  `last_name` char(20) NOT NULL,
  `userid` char(20) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT 'usr@EEI1',
  `email_address` varchar(50) NOT NULL,
  `user_type` enum('Administrator','Requestor','Technicals Group Manager','Access Group Manager','Network Group Manager','Technician','Network Engineer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requestor_t`
--

INSERT INTO `requestor_t` (`requestor_id`, `first_name`, `last_name`, `userid`, `password`, `email_address`, `user_type`) VALUES
(2, 'April Hann', 'Angelo', 'ahpangelo', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'ahpangelo@eei.com.ph', 'Requestor');

-- --------------------------------------------------------

--
-- Table structure for table `service_ticket_t`
--

CREATE TABLE `service_ticket_t` (
  `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `ticket_number` int(7) NOT NULL,
  `findings` varchar(250) DEFAULT NULL,
  `request_details` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_ticket_t`
--

INSERT INTO `service_ticket_t` (`ticket_id`, `ticket_number`, `findings`, `request_details`) VALUES
(031, 2018031, NULL, 'hi'),
(034, 2018034, NULL, 'hi'),
(035, 2018035, NULL, 'hi'),
(036, 2018036, NULL, 'hi'),
(037, 2018037, NULL, 'hi'),
(039, 2018039, NULL, 'hi'),
(040, 2018040, NULL, 'hi'),
(042, 2018042, NULL, 'hi'),
(043, 2018043, NULL, 'en'),
(044, 2018044, NULL, 'swal'),
(045, 2018045, NULL, 'swal'),
(046, 2018046, NULL, 'red'),
(047, 2018047, NULL, 'hi'),
(048, 2018048, NULL, 'Last Friday night yeah we danced on tabletops and we took too many shots think we kissed but I forgot. Last Friday night yeah we maxed our credit cards and got kicked out of the bar so we hit the boulevard.');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_agent_t`
--

CREATE TABLE `ticket_agent_t` (
  `ticket_agent_id` int(2) NOT NULL,
  `userid` char(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` char(30) NOT NULL,
  `last_name` char(20) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `it_group` enum('Technical','Access','Network') NOT NULL,
  `position` enum('Technician','Engineer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_agent_t`
--

INSERT INTO `ticket_agent_t` (`ticket_agent_id`, `userid`, `password`, `first_name`, `last_name`, `email_address`, `it_group`, `position`) VALUES
(1, 'jmblopez', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'Jerico Miguel', 'Lopez', 'jmblopez@eei.com.ph', 'Technical', 'Technician');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_t`
--

CREATE TABLE `ticket_t` (
  `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `ticket_number` int(11) NOT NULL,
  `ticket_title` varchar(40) NOT NULL,
  `date_prepared` date NOT NULL,
  `ticket_type` enum('Service','User Access') DEFAULT NULL,
  `ticket_category` enum('Technicals','Access','Network') DEFAULT NULL,
  `severity_level` enum('SEV1','SEV2','SEV3','SEV4','SEV5') DEFAULT NULL,
  `ticket_status` enum('New','Pending','Approved','Resolved','Closed') DEFAULT 'New',
  `date_required` date DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `resolution_date` date DEFAULT NULL,
  `requestor_id` int(5) NOT NULL,
  `it_group_manager_id` int(1) DEFAULT NULL,
  `ticket_agent_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_t`
--

INSERT INTO `ticket_t` (`ticket_id`, `ticket_number`, `ticket_title`, `date_prepared`, `ticket_type`, `ticket_category`, `severity_level`, `ticket_status`, `date_required`, `remarks`, `resolution_date`, `requestor_id`, `it_group_manager_id`, `ticket_agent_id`) VALUES
(031, 2018031, 'Service tix', '2018-01-04', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(033, 2018033, 'user access tix', '2018-01-04', 'User Access', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(034, 2018034, 'hi', '2018-01-04', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(035, 2018035, 'hi', '2018-01-04', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(036, 2018036, 'hi', '2018-01-04', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(037, 2018037, 'hi', '2018-01-04', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(038, 2018038, 'hi', '2018-01-04', 'User Access', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(039, 2018039, 'hi', '2018-01-04', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(040, 2018040, 'trial new', '2018-01-05', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(041, 2018041, 'Application Access', '2018-01-05', 'User Access', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(042, 2018042, 'hi', '2018-01-05', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(043, 2018043, 'new', '2018-01-05', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(044, 2018044, 'new', '2018-01-05', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(045, 2018045, 'swal', '2018-01-05', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(046, 2018046, 'red', '2018-01-05', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(047, 2018047, 'hihi', '2018-01-05', 'Service', NULL, NULL, 'New', NULL, NULL, NULL, 2, NULL, NULL),
(048, 2018048, 'Keyboard is not working', '2018-01-05', 'Service', 'Technicals', 'SEV4', 'Pending', '2018-01-07', NULL, NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_ticket_t`
--

CREATE TABLE `user_access_ticket_t` (
  `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `ticket_number` int(7) NOT NULL,
  `company` varchar(45) NOT NULL,
  `dept_proj` char(20) NOT NULL,
  `rc_no` int(5) NOT NULL,
  `name` text NOT NULL,
  `access_requested` char(40) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `approver` varchar(250) DEFAULT NULL,
  `isApproved` tinyint(1) DEFAULT NULL,
  `checker` varchar(250) DEFAULT NULL,
  `isChecked` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_ticket_t`
--

INSERT INTO `user_access_ticket_t` (`ticket_id`, `ticket_number`, `company`, `dept_proj`, `rc_no`, `name`, `access_requested`, `expiry_date`, `approver`, `isApproved`, `checker`, `isChecked`) VALUES
(033, 2018033, 'hi', 'hi', 12, 'hi', 'hi', '0000-00-00', '', NULL, '', NULL),
(038, 2018038, 'hi', 'hi', 12, 'hi', 'hi', '0000-00-00', '', NULL, '', NULL),
(041, 2018041, 'EEI', 'IT', 12345, 'Lennon', 'IBM Notes', '0000-00-00', '', NULL, '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log_t`
--
ALTER TABLE `activity_log_t`
  ADD PRIMARY KEY (`activity_log_id`),
  ADD KEY `activity_log_t_ibfk_1` (`ticket_no`);

--
-- Indexes for table `it_group_manager`
--
ALTER TABLE `it_group_manager`
  ADD PRIMARY KEY (`it_group_manager_id`);

--
-- Indexes for table `notification_t`
--
ALTER TABLE `notification_t`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `it_group_manager_id` (`it_group_manager_id`),
  ADD KEY `requestor_id` (`requestor_id`),
  ADD KEY `ticket_agent_id` (`ticket_agent_id`),
  ADD KEY `ticket_no` (`ticket_no`);

--
-- Indexes for table `requestor_t`
--
ALTER TABLE `requestor_t`
  ADD PRIMARY KEY (`requestor_id`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `service_ticket_t`
--
ALTER TABLE `service_ticket_t`
  ADD KEY `ticket_number` (`ticket_number`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `ticket_agent_t`
--
ALTER TABLE `ticket_agent_t`
  ADD PRIMARY KEY (`ticket_agent_id`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `password_2` (`password`);

--
-- Indexes for table `ticket_t`
--
ALTER TABLE `ticket_t`
  ADD PRIMARY KEY (`ticket_id`),
  ADD UNIQUE KEY `ticket_id` (`ticket_id`),
  ADD UNIQUE KEY `ticket_number` (`ticket_number`),
  ADD KEY `requestor_id` (`requestor_id`);

--
-- Indexes for table `user_access_ticket_t`
--
ALTER TABLE `user_access_ticket_t`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log_t`
--
ALTER TABLE `activity_log_t`
  MODIFY `activity_log_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `it_group_manager`
--
ALTER TABLE `it_group_manager`
  MODIFY `it_group_manager_id` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_t`
--
ALTER TABLE `notification_t`
  MODIFY `notification_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requestor_t`
--
ALTER TABLE `requestor_t`
  MODIFY `requestor_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket_agent_t`
--
ALTER TABLE `ticket_agent_t`
  MODIFY `ticket_agent_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_t`
--
ALTER TABLE `ticket_t`
  MODIFY `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notification_t`
--
ALTER TABLE `notification_t`
  ADD CONSTRAINT `notification_t_ibfk_1` FOREIGN KEY (`it_group_manager_id`) REFERENCES `it_group_manager` (`it_group_manager_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_t_ibfk_2` FOREIGN KEY (`requestor_id`) REFERENCES `requestor_t` (`requestor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_t_ibfk_3` FOREIGN KEY (`ticket_agent_id`) REFERENCES `ticket_agent_t` (`ticket_agent_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_ticket_t`
--
ALTER TABLE `service_ticket_t`
  ADD CONSTRAINT `service_ticket_t_ibfk_2` FOREIGN KEY (`ticket_number`) REFERENCES `ticket_t` (`ticket_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_ticket_t_ibfk_3` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_t` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_t`
--
ALTER TABLE `ticket_t`
  ADD CONSTRAINT `ticket_t_ibfk_1` FOREIGN KEY (`requestor_id`) REFERENCES `requestor_t` (`requestor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_access_ticket_t`
--
ALTER TABLE `user_access_ticket_t`
  ADD CONSTRAINT `user_access_ticket_t_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_t` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
