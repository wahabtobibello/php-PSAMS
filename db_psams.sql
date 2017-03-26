-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2017 at 04:26 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_psams`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_t`
--

CREATE TABLE `appointment_t` (
  `appointment_id` int(11) NOT NULL,
  `day_id` int(1) NOT NULL,
  `matric_number` int(9) NOT NULL,
  `appointment_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `day_t`
--

CREATE TABLE `day_t` (
  `day_id` int(1) NOT NULL,
  `day` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `day_t`
--

INSERT INTO `day_t` (`day_id`, `day`) VALUES
(1, 'Sunday'),
(2, 'Monday'),
(3, 'Tuesday'),
(4, 'Wednesday'),
(5, 'Thursday'),
(6, 'Friday'),
(7, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `message_t`
--

CREATE TABLE `message_t` (
  `message_id` int(11) NOT NULL,
  `send_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(255) NOT NULL,
  `text_message` longtext NOT NULL,
  `read_flag` tinyint(1) NOT NULL DEFAULT '1',
  `sender_id` int(9) NOT NULL,
  `recipient_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_t`
--

CREATE TABLE `schedule_t` (
  `day_id` int(1) NOT NULL,
  `staff_number` int(9) NOT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `appointment_max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_t`
--

INSERT INTO `schedule_t` (`day_id`, `staff_number`, `from_time`, `to_time`, `appointment_max`) VALUES
(1, 123456789, NULL, NULL, NULL),
(2, 123456789, '09:00:00', '15:00:00', 4),
(3, 123456789, NULL, NULL, NULL),
(4, 123456789, NULL, NULL, NULL),
(5, 123456789, NULL, NULL, NULL),
(6, 123456789, NULL, NULL, NULL),
(7, 123456789, '08:00:00', '10:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `slot_t`
--

CREATE TABLE `slot_t` (
  `date` date NOT NULL,
  `slots` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_t`
--

CREATE TABLE `student_t` (
  `matric_number` int(9) NOT NULL,
  `staff_number` int(9) NOT NULL,
  `profile_picture` text,
  `project` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_t`
--

INSERT INTO `student_t` (`matric_number`, `staff_number`, `profile_picture`, `project`, `role_id`) VALUES
(130805001, 123456789, NULL, 'Project Supervisor Appointment Management System', 2);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_t`
--

CREATE TABLE `supervisor_t` (
  `staff_number` int(11) NOT NULL,
  `title_id` int(11) DEFAULT NULL,
  `end_date` date NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor_t`
--

INSERT INTO `supervisor_t` (`staff_number`, `title_id`, `end_date`, `role_id`) VALUES
(123456789, 2, '2017-05-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `title_t`
--

CREATE TABLE `title_t` (
  `title_id` int(1) NOT NULL,
  `title` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `title_t`
--

INSERT INTO `title_t` (`title_id`, `title`) VALUES
(1, 'Dr.'),
(2, 'Prof.'),
(3, 'Mr.'),
(4, 'Mrs.'),
(5, 'Ms.');

-- --------------------------------------------------------

--
-- Table structure for table `user_t`
--

CREATE TABLE `user_t` (
  `user_number` int(9) NOT NULL,
  `user_password` varchar(511) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_t`
--

INSERT INTO `user_t` (`user_number`, `user_password`, `first_name`, `last_name`) VALUES
(123456789, '$2y$10$7RHi5nUMmGxPH4qHWhnVwukuCoY7XgIHIL0XP5CPxR3Nptv/tC0Zu', 'Albert', 'Einstein'),
(130805001, '$2y$10$68WcrwzdFwZ7zTTUPrkgxOgR5jMnxeJVFL1jX6.ROk5oeUymmyJie', 'Tobi', 'Bello');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_t`
--
ALTER TABLE `appointment_t`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `day_id` (`day_id`),
  ADD KEY `appointment_t_student_t_matric_number_fk` (`matric_number`);

--
-- Indexes for table `day_t`
--
ALTER TABLE `day_t`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `message_t`
--
ALTER TABLE `message_t`
  ADD PRIMARY KEY (`message_id`,`send_time`),
  ADD KEY `message_t_supervisor_t_staff_number_fk` (`sender_id`),
  ADD KEY `message_t_supervisor_t_staff_number_fk_1` (`recipient_id`);

--
-- Indexes for table `schedule_t`
--
ALTER TABLE `schedule_t`
  ADD PRIMARY KEY (`day_id`),
  ADD KEY `schedule_t_supervisor_t_staff_number_fk` (`staff_number`);

--
-- Indexes for table `slot_t`
--
ALTER TABLE `slot_t`
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `student_t`
--
ALTER TABLE `student_t`
  ADD PRIMARY KEY (`matric_number`),
  ADD KEY `student_t_supervisor_t_staff_number_fk` (`staff_number`);

--
-- Indexes for table `supervisor_t`
--
ALTER TABLE `supervisor_t`
  ADD PRIMARY KEY (`staff_number`),
  ADD KEY `supervisor_t_ibfk_1` (`title_id`);

--
-- Indexes for table `title_t`
--
ALTER TABLE `title_t`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `user_t`
--
ALTER TABLE `user_t`
  ADD PRIMARY KEY (`user_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_t`
--
ALTER TABLE `appointment_t`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `day_t`
--
ALTER TABLE `day_t`
  MODIFY `day_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `message_t`
--
ALTER TABLE `message_t`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `title_t`
--
ALTER TABLE `title_t`
  MODIFY `title_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_t`
--
ALTER TABLE `appointment_t`
  ADD CONSTRAINT `appointment_t_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `schedule_t` (`day_id`),
  ADD CONSTRAINT `appointment_t_student_t_matric_number_fk` FOREIGN KEY (`matric_number`) REFERENCES `student_t` (`matric_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message_t`
--
ALTER TABLE `message_t`
  ADD CONSTRAINT `message_t_student_t_matric_number_fk` FOREIGN KEY (`sender_id`) REFERENCES `student_t` (`matric_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_t_student_t_matric_number_fk_1` FOREIGN KEY (`recipient_id`) REFERENCES `student_t` (`matric_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_t_supervisor_t_staff_number_fk` FOREIGN KEY (`sender_id`) REFERENCES `supervisor_t` (`staff_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_t_supervisor_t_staff_number_fk_1` FOREIGN KEY (`recipient_id`) REFERENCES `supervisor_t` (`staff_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule_t`
--
ALTER TABLE `schedule_t`
  ADD CONSTRAINT `schedule_t_ibfk_2` FOREIGN KEY (`day_id`) REFERENCES `day_t` (`day_id`),
  ADD CONSTRAINT `schedule_t_supervisor_t_staff_number_fk` FOREIGN KEY (`staff_number`) REFERENCES `supervisor_t` (`staff_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_t`
--
ALTER TABLE `student_t`
  ADD CONSTRAINT `student_t_supervisor_t_staff_number_fk` FOREIGN KEY (`staff_number`) REFERENCES `supervisor_t` (`staff_number`),
  ADD CONSTRAINT `student_t_user_t_user_number_fk` FOREIGN KEY (`matric_number`) REFERENCES `user_t` (`user_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supervisor_t`
--
ALTER TABLE `supervisor_t`
  ADD CONSTRAINT `supervisor_t_ibfk_1` FOREIGN KEY (`title_id`) REFERENCES `title_t` (`title_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `supervisor_t_user_t_user_number_fk` FOREIGN KEY (`staff_number`) REFERENCES `user_t` (`user_number`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
