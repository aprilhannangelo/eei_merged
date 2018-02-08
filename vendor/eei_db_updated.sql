-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2018 at 05:41 PM
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
  `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `activity_log_details` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `logger` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_log_t`
--

INSERT INTO `activity_log_t` (`activity_log_id`, `ticket_id`, `activity_log_details`, `timestamp`, `logger`) VALUES
(4, 020, 'hi world', '2018-02-05 14:26:54', 1),
(5, 022, 'log1', '2018-02-06 14:21:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_t`
--

CREATE TABLE `notification_t` (
  `notification_id` int(5) NOT NULL,
  `ticket_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL,
  `user_id` int(5) NOT NULL,
  `notification_description` varchar(100) NOT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT '0',
  `isSeen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `service_ticket_t`
--

CREATE TABLE `service_ticket_t` (
  `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `findings` varchar(250) DEFAULT NULL,
  `request_details` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_ticket_t`
--

INSERT INTO `service_ticket_t` (`ticket_id`, `findings`, `request_details`) VALUES
(020, NULL, 'hi'),
(022, NULL, 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `sla_t`
--

CREATE TABLE `sla_t` (
  `id` int(3) NOT NULL,
  `severity_level` varchar(4) NOT NULL,
  `description` varchar(30) NOT NULL,
  `resolution_time` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sla_t`
--

INSERT INTO `sla_t` (`id`, `severity_level`, `description`, `resolution_time`) VALUES
(1, 'SEV1', 'Critical', 4),
(2, 'SEV2', 'Important', 6),
(3, 'SEV3', 'Normal', 8),
(4, 'SEV4', 'Low', 24),
(5, 'SEV5', 'Very Low', 48);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_status_t`
--

CREATE TABLE `ticket_status_t` (
  `status_id` int(1) NOT NULL,
  `ticket_status` varchar(15) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_status_t`
--

INSERT INTO `ticket_status_t` (`status_id`, `ticket_status`, `description`) VALUES
(1, 'New', NULL),
(2, 'Checked', NULL),
(3, 'Approved', NULL),
(4, 'Rejected', NULL),
(5, 'Pending', NULL),
(6, 'In Progress', NULL),
(7, 'Resolved', NULL),
(8, 'Closed', NULL),
(9, 'Cancelled', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_t`
--

CREATE TABLE `ticket_t` (
  `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `ticket_number` int(11) NOT NULL,
  `ticket_title` varchar(40) NOT NULL,
  `date_prepared` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ticket_type` enum('Service','User Access') DEFAULT NULL,
  `ticket_category` enum('Technicals','Access','Network') DEFAULT NULL,
  `severity_level` int(1) DEFAULT NULL,
  `ticket_status` int(1) DEFAULT NULL,
  `date_required` date DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `resolution_date` date DEFAULT NULL,
  `user_id` int(5) NOT NULL,
  `ticket_agent_id` int(5) DEFAULT NULL,
  `it_group_manager_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_t`
--

INSERT INTO `ticket_t` (`ticket_id`, `ticket_number`, `ticket_title`, `date_prepared`, `ticket_type`, `ticket_category`, `severity_level`, `ticket_status`, `date_required`, `remarks`, `resolution_date`, `user_id`, `ticket_agent_id`, `it_group_manager_id`) VALUES
(020, 2018020, 'hi', '2018-02-05 14:37:03', 'Service', 'Technicals', 1, 9, NULL, NULL, NULL, 1, NULL, 3),
(021, 2018021, 'hi', '2018-02-06 16:25:39', 'User Access', 'Technicals', 1, 5, NULL, NULL, NULL, 1, 10, 3),
(022, 2018022, 'hello', '2018-02-06 12:53:15', 'Service', 'Network', 2, 6, NULL, NULL, NULL, 1, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_ticket_t`
--

CREATE TABLE `user_access_ticket_t` (
  `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `company` varchar(45) NOT NULL,
  `dept_proj` char(20) NOT NULL,
  `rc_no` int(5) NOT NULL,
  `name` text NOT NULL,
  `access_requested` char(40) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `approver` int(11) DEFAULT NULL,
  `isApproved` tinyint(1) DEFAULT NULL,
  `checker` int(11) DEFAULT NULL,
  `isChecked` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_ticket_t`
--

INSERT INTO `user_access_ticket_t` (`ticket_id`, `company`, `dept_proj`, `rc_no`, `name`, `access_requested`, `expiry_date`, `approver`, `isApproved`, `checker`, `isChecked`) VALUES
(021, 'hi', 'hih', 1245, 'ih', 'ih', NULL, 8, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_t`
--

CREATE TABLE `user_t` (
  `user_id` int(5) NOT NULL,
  `first_name` char(30) NOT NULL,
  `last_name` char(20) NOT NULL,
  `userid` char(20) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT 'usr@EEI1',
  `email_address` varchar(50) NOT NULL,
  `user_type` enum('Administrator','Requestor','Technicals Group Manager','Access Group Manager','Network Group Manager','Technician','Network Engineer') NOT NULL,
  `is_firstlogin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_t`
--

INSERT INTO `user_t` (`user_id`, `first_name`, `last_name`, `userid`, `password`, `email_address`, `user_type`, `is_firstlogin`) VALUES
(1, 'User', 'Administrator', 'administrator', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'useradministrator@yahoo.com', 'Administrator', 1),
(2, 'User', 'Requestor', 'requestor', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'userrequestor@yahoo.com', 'Requestor', 1),
(3, 'User', 'Technicals Manager', 'technicalsmanager', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'usertechnicalsmanager@yahoo.com', 'Technicals Group Manager', 1),
(4, 'User', 'Access Manager', 'accessmanager', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'useraccessmanager@yahoo.com', 'Access Group Manager', 1),
(5, 'User', 'Network Manager', 'networkmanager', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'usernetworkmanager@yahoo.com', 'Network Group Manager', 1),
(6, 'User', 'Technician', 'technician', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'usertechnician@yahoo.com', 'Technician', 1),
(7, 'User', 'Network Engineer', 'networkengineer', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'usernetworkengineer@yahoo.com', 'Network Engineer', NULL),
(8, 'User', 'Requestor Two', 'requestortwo', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'userrequestortwo@yahoo.com', 'Requestor', 1),
(9, 'User', 'Requestor Three', 'requestorthree', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'userrequestorthree@yahoo.com', 'Requestor', 1),
(10, 'Tifanny', 'Udquin', 'tudquin', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'tudquin@eei.com.ph', 'Technician', 1),
(11, 'Donna', 'Dumaliang', 'ddumaliang', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'ddumaliang@eei.com.ph', 'Network Engineer', 1),
(12, 'Jerico', 'Lopez', 'jlopez', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'jlopez@eei.com.ph', 'Technician', 1),
(13, 'Lennon', 'Villanueva', 'lvillanueva', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'lvillanueva@eei.com.ph', 'Network Engineer', 1),
(14, 'Lennon', 'Villanueva', 'lvillanueva', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'lvillanueva@eei.com.ph', 'Network Engineer', 1),
(15, 'Trina', 'Tan', 'ctan', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'ttan@eei.com.ph', 'Requestor', NULL),
(16, 'Lean', 'Angelo', 'langelo', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'langelo@yahoo.com', 'Network Engineer', NULL),
(17, 'Efren', 'Angelo', 'eangelo', 'aa15a654dad571bb6a60a3c5ac1f6eae', 'eangelo@eei.com.ph', 'Requestor', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log_t`
--
ALTER TABLE `activity_log_t`
  ADD PRIMARY KEY (`activity_log_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `notification_t`
--
ALTER TABLE `notification_t`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ticket_id` (`ticket_id`);


--
-- Indexes for table `service_ticket_t`
--
ALTER TABLE `service_ticket_t`
  ADD KEY `service_ticket_t_ibfk_1` (`ticket_id`);

--
-- Indexes for table `sla_t`
--
ALTER TABLE `sla_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_status_t`
--
ALTER TABLE `ticket_status_t`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `ticket_t`
--
ALTER TABLE `ticket_t`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `requestor_id` (`user_id`),
  ADD KEY `ticket_number` (`ticket_number`),
  ADD KEY `severity_level` (`severity_level`),
  ADD KEY `ticket_status` (`ticket_status`);

--
-- Indexes for table `user_access_ticket_t`
--
ALTER TABLE `user_access_ticket_t`
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `user_t`
--
ALTER TABLE `user_t`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log_t`
--
ALTER TABLE `activity_log_t`
  MODIFY `activity_log_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notification_t`
--
ALTER TABLE `notification_t`
  MODIFY `notification_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sla_t`
--
ALTER TABLE `sla_t`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticket_status_t`
--
ALTER TABLE `ticket_status_t`
  MODIFY `status_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket_t`
--
ALTER TABLE `ticket_t`
  MODIFY `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_t`
--
ALTER TABLE `user_t`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log_t`
--
ALTER TABLE `activity_log_t`
  ADD CONSTRAINT `activity_log_t_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_t` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification_t`
--
ALTER TABLE `notification_t`
  ADD CONSTRAINT `notification_t_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_t` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_ticket_t`
--
ALTER TABLE `service_ticket_t`
  ADD CONSTRAINT `service_ticket_t_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_t` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_t`
--
ALTER TABLE `ticket_t`
  ADD CONSTRAINT `ticket_t_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_t` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_t_ibfk_3` FOREIGN KEY (`severity_level`) REFERENCES `sla_t` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_t_ibfk_4` FOREIGN KEY (`ticket_status`) REFERENCES `ticket_status_t` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_access_ticket_t`
--
ALTER TABLE `user_access_ticket_t`
  ADD CONSTRAINT `user_access_ticket_t_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_t` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
