-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2018 at 06:19 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `notification_t`
--

CREATE TABLE `notification_t` (
  `notification_id` int(4) NOT NULL,
  `ticket_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL,
  `user_id` int(5) NOT NULL,
  `notification_description` varchar(100) NOT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT '0',
  `isSeen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_t`
--

INSERT INTO `notification_t` (`notification_id`, `ticket_id`, `user_id`, `notification_description`, `isRead`, `isSeen`) VALUES
(7, 029, 23, 'Ticket No. : 2018029 needs your review', 0, 1),
(8, 029, 26, 'New ticket 2018029 for approval', 0, 1),
(9, 029, 19, 'Ticket No. : 2018029 has been approved', 0, 1),
(10, 029, 18, '2018029 has been assigned to you', 0, 1),
(11, 029, 18, '2018029 has been assigned to you', 0, 1),
(12, 030, 26, 'Ticket No. : 2018030 needs your review', 0, 1),
(13, 030, 23, 'New ticket 2018030 for approval', 0, 1),
(14, 030, 23, 'New ticket 2018030 for approval', 0, 1),
(15, 030, 19, 'Ticket No. : 2018030 has been approved', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_ticket_t`
--

CREATE TABLE `service_ticket_t` (
  `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `findings` varchar(250) DEFAULT NULL,
  `request_details` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `date_required` datetime DEFAULT NULL,
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
(028, 2018028, 'k', '2018-02-06 17:40:59', 'User Access', NULL, NULL, 1, NULL, NULL, NULL, 22, NULL, NULL),
(029, 2018029, 'k', '2018-02-06 19:17:44', 'User Access', 'Access', 1, 5, '2018-02-07 07:17:44', NULL, NULL, 22, NULL, 18),
(030, 2018030, 'AutoCad Access', '2018-02-07 03:37:57', 'User Access', NULL, NULL, 3, NULL, NULL, NULL, 22, NULL, NULL);

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
(028, 'l', 'l', 23, 'll', 'l', NULL, 26, NULL, 23, NULL),
(029, 'l', 'l', 23, 'll', 'l', NULL, 26, 1, 23, 1),
(030, 'EEI', 'MRT 7', 0, 'Lennon Villanueva', 'AutoCad', NULL, 23, 1, 26, 1);

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
(18, 'Donna', 'Dumaliang', 'ddumaliang', '21232f297a57a5a743894a0e4a801fc3', 'dondumaliang@gmail.com', 'Access Group Manager', 1),
(19, 'April', 'Angelo', 'ahangelo', '21232f297a57a5a743894a0e4a801fc3', 'dondumaliang@gmail.com', 'Administrator', 1),
(20, 'Christiana', 'Tan', 'cetan', 'usr@EEI1', 'dondumaliang@gmail.com', 'Technicals Group Manager', NULL),
(21, 'Jerico', 'Lopez', 'jlopez', 'usr@EEI1', 'dondumaliang@gmail.com', 'Network Group Manager', NULL),
(22, 'Lennon', 'Villanueva', 'lvillanueva', '21232f297a57a5a743894a0e4a801fc3', 'dondumaliang@gmail.com', 'Requestor', 1),
(23, 'Elisha', 'Dumaliang', 'edumaliang', '21232f297a57a5a743894a0e4a801fc3', 'dondumaliang@gmail.com', 'Requestor', 1),
(24, 'Chandler', 'Bing', 'cbing', 'usr@EEI1', 'dondumaliang@gmail.com', 'Technician', NULL),
(25, 'Joey', 'Tribbiani', 'jtribbiani', 'usr@EEI1', 'dondumaliang@gmail.com', 'Network Engineer', NULL),
(26, 'Rachel', 'Green', 'rgreen', '21232f297a57a5a743894a0e4a801fc3', 'dondumaliang@gmail.com', 'Requestor', 1),
(27, 'Phoebe', 'Buffay', 'pbuffay', 'd41d8cd98f00b204e9800998ecf8427e', 'dondumaliang@gmail.com', 'Requestor', NULL);

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
  ADD UNIQUE KEY `ticket_id_2` (`ticket_id`),
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
  MODIFY `activity_log_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_t`
--
ALTER TABLE `notification_t`
  MODIFY `notification_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `ticket_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_t`
--
ALTER TABLE `user_t`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
