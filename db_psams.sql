-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2017 at 10:57 PM
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
-- Table structure for table `role_t`
--

CREATE TABLE `role_t` (
  `role_id` int(11) NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_t`
--

INSERT INTO `role_t` (`role_id`, `role`) VALUES
(1, 'supervisor'),
(2, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_t`
--

CREATE TABLE `schedule_t` (
  `day_id` int(1) NOT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `appointment_max` int(11) DEFAULT NULL,
  `staff_number` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_t`
--

INSERT INTO `schedule_t` (`day_id`, `from_time`, `to_time`, `appointment_max`, `staff_number`) VALUES
(1, NULL, NULL, NULL, 123456789),
(2, NULL, NULL, NULL, 123456789),
(3, NULL, NULL, NULL, 123456789),
(4, NULL, NULL, NULL, 123456789),
(5, NULL, NULL, NULL, 123456789),
(6, NULL, NULL, NULL, 123456789),
(7, NULL, NULL, NULL, 123456789);

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
  `role_id` int(11) NOT NULL DEFAULT '2',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_t`
--

INSERT INTO `student_t` (`matric_number`, `staff_number`, `profile_picture`, `project`, `role_id`, `id`) VALUES
(130805001, 123456789, NULL, 'Project Supervisor Appointment Management System', 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_t`
--

CREATE TABLE `supervisor_t` (
  `staff_number` int(11) NOT NULL,
  `title_id` int(11) DEFAULT NULL,
  `end_date` date NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor_t`
--

INSERT INTO `supervisor_t` (`staff_number`, `title_id`, `end_date`, `role_id`, `id`) VALUES
(123456789, 2, '2017-05-24', 1, 1);

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
  `id` int(9) NOT NULL,
  `user_password` varchar(511) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_t`
--

INSERT INTO `user_t` (`id`, `user_password`, `first_name`, `last_name`) VALUES
(1, '$2y$10$cJ9ARcwYy78lwz8XvPX62uw/9P6JWgWhDj/HuQGhkojxhJ0k7fOXG', 'Albert', 'Einstein'),
(12, '$2y$10$Ht0DWjA3S400O.0t3ukkvem1e194txuWdkX4/Hozl/Xnk6v2GPI.C', 'Tobi ', 'Bello');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_t`
--
ALTER TABLE `appointment_t`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `day_id` (`day_id`),
  ADD KEY `matric_number` (`matric_number`);

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
-- Indexes for table `role_t`
--
ALTER TABLE `role_t`
  ADD PRIMARY KEY (`role_id`);

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
  ADD KEY `role_id` (`role_id`),
  ADD KEY `student_t_user_t_id_fk` (`id`),
  ADD KEY `student_t_supervisor_t_staff_number_fk` (`staff_number`);

--
-- Indexes for table `supervisor_t`
--
ALTER TABLE `supervisor_t`
  ADD PRIMARY KEY (`staff_number`),
  ADD KEY `title_id` (`title_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `supervisor_t_user_t_id_fk` (`id`);

--
-- Indexes for table `title_t`
--
ALTER TABLE `title_t`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `user_t`
--
ALTER TABLE `user_t`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `student_t`
--
ALTER TABLE `student_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `title_t`
--
ALTER TABLE `title_t`
  MODIFY `title_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_t`
--
ALTER TABLE `user_t`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_t`
--
ALTER TABLE `appointment_t`
  ADD CONSTRAINT `appointment_t_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `schedule_t` (`day_id`),
  ADD CONSTRAINT `appointment_t_ibfk_2` FOREIGN KEY (`matric_number`) REFERENCES `student_t` (`matric_number`);

--
-- Constraints for table `message_t`
--
ALTER TABLE `message_t`
  ADD CONSTRAINT `message_t_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `student_t` (`matric_number`),
  ADD CONSTRAINT `message_t_ibfk_4` FOREIGN KEY (`recipient_id`) REFERENCES `student_t` (`matric_number`),
  ADD CONSTRAINT `message_t_supervisor_t_staff_number_fk` FOREIGN KEY (`sender_id`) REFERENCES `supervisor_t` (`staff_number`),
  ADD CONSTRAINT `message_t_supervisor_t_staff_number_fk_1` FOREIGN KEY (`recipient_id`) REFERENCES `supervisor_t` (`staff_number`);

--
-- Constraints for table `schedule_t`
--
ALTER TABLE `schedule_t`
  ADD CONSTRAINT `schedule_t_ibfk_2` FOREIGN KEY (`day_id`) REFERENCES `day_t` (`day_id`),
  ADD CONSTRAINT `schedule_t_supervisor_t_staff_number_fk` FOREIGN KEY (`staff_number`) REFERENCES `supervisor_t` (`staff_number`);

--
-- Constraints for table `student_t`
--
ALTER TABLE `student_t`
  ADD CONSTRAINT `student_t_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role_t` (`role_id`),
  ADD CONSTRAINT `student_t_supervisor_t_staff_number_fk` FOREIGN KEY (`staff_number`) REFERENCES `supervisor_t` (`staff_number`),
  ADD CONSTRAINT `student_t_user_t_id_fk` FOREIGN KEY (`id`) REFERENCES `user_t` (`id`);

--
-- Constraints for table `supervisor_t`
--
ALTER TABLE `supervisor_t`
  ADD CONSTRAINT `supervisor_t_ibfk_1` FOREIGN KEY (`title_id`) REFERENCES `title_t` (`title_id`),
  ADD CONSTRAINT `supervisor_t_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role_t` (`role_id`),
  ADD CONSTRAINT `supervisor_t_user_t_id_fk` FOREIGN KEY (`id`) REFERENCES `user_t` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
