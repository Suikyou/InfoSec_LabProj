-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2024 at 03:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `archived_tasks`
--

CREATE TABLE `archived_tasks` (
  `archived_tasks_id_pk` int(11) NOT NULL,
  `archived_title` varchar(50) NOT NULL,
  `archived_notes` varchar(100) NOT NULL,
  `archived_due_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `private_tasks`
--

CREATE TABLE `private_tasks` (
  `private_tasks_id_pk` int(11) NOT NULL,
  `private_tasks_title` varchar(50) NOT NULL,
  `private_tasks_notes` varchar(100) NOT NULL,
  `private_tasks_due_date` datetime NOT NULL,
  `private_user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `tasks_id_pk` int(11) NOT NULL,
  `tasks_user_id_fk` int(11) NOT NULL,
  `tasks_title` varchar(50) NOT NULL,
  `tasks_notes` varchar(100) NOT NULL,
  `tasks_due_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id_pk` int(11) NOT NULL,
  `user_fname` varchar(25) NOT NULL,
  `user_lname` varchar(25) NOT NULL,
  `user_eadd` varchar(30) NOT NULL,
  `user_pw` varchar(60) NOT NULL,
  `security_question` varchar(60) NOT NULL,
  `security_answer` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id_pk`, `user_fname`, `user_lname`, `user_eadd`, `user_pw`, `security_question`, `security_answer`) VALUES
(13, 'q', 'q', 'q@gmail.com', '$2y$10$k3elclN2aBtOos8abetXHersy1M6FsPFfXunJe5deXarW8f0An50a', 'What is the name of the company you had your first job at?', 'Str company');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_type` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`log_id`, `user_id`, `action`, `item_id`, `item_type`, `timestamp`) VALUES
(97, 13, 'User created a', 69, 'Task', '2024-03-13 02:14:59'),
(98, 13, 'User updated a', 69, 'Task', '2024-03-13 02:15:02'),
(99, 13, 'User archived a', 69, 'Task', '2024-03-13 02:15:03'),
(100, 13, 'User deleted an', 69, 'Archived Task', '2024-03-13 02:15:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archived_tasks`
--
ALTER TABLE `archived_tasks`
  ADD PRIMARY KEY (`archived_tasks_id_pk`);

--
-- Indexes for table `private_tasks`
--
ALTER TABLE `private_tasks`
  ADD PRIMARY KEY (`private_tasks_id_pk`),
  ADD KEY `private_user_id_fk` (`private_user_id_fk`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`tasks_id_pk`),
  ADD KEY `tasks_user_id_fk` (`tasks_user_id_fk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id_pk`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archived_tasks`
--
ALTER TABLE `archived_tasks`
  MODIFY `archived_tasks_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `private_tasks`
--
ALTER TABLE `private_tasks`
  MODIFY `private_tasks_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `tasks_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `private_tasks`
--
ALTER TABLE `private_tasks`
  ADD CONSTRAINT `private_tasks_ibfk_1` FOREIGN KEY (`private_user_id_fk`) REFERENCES `users` (`user_id_pk`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`tasks_user_id_fk`) REFERENCES `users` (`user_id_pk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
