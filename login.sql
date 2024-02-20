-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 01:48 PM
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

--
-- Dumping data for table `private_tasks`
--

INSERT INTO `private_tasks` (`private_tasks_id_pk`, `private_tasks_title`, `private_tasks_notes`, `private_tasks_due_date`, `private_user_id_fk`) VALUES
(9, 'qwe', 'qwe', '2024-02-23 14:29:00', 2);

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

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`tasks_id_pk`, `tasks_user_id_fk`, `tasks_title`, `tasks_notes`, `tasks_due_date`) VALUES
(52, 2, 'qwe', 'qwe', '2024-02-24 15:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id_pk` int(11) NOT NULL,
  `user_fname` varchar(25) NOT NULL,
  `user_lname` varchar(25) NOT NULL,
  `user_eadd` varchar(30) NOT NULL,
  `user_pw` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id_pk`, `user_fname`, `user_lname`, `user_eadd`, `user_pw`) VALUES
(1, 'tester', 'aggabao', 'tester@gmail.com', '$2y$10$mjQXgRczHPwkb/ZROZAEuueSOubMeagc4UBuLmvGT/lsjVjBtTQsO'),
(2, 'qwe', 'qwe', 'qwe@gmail.com', '$2y$10$baQeN13xgzj1LGd81vGPbOy4u32/BzaSbxHV39KOGW9NYr5GlToO6'),
(3, 'q', 'q', 'q@gmail.com', '$2y$10$NzOJATONOIrhXmRQn5n7pOx.NgyslZAey.mwCmuyNmFyPKw61FrQm'),
(4, 'gdn', 'dan', 'gdn@gmail.com', '$2y$10$uNYfL8u2np2nbnPH09G9ruo5rOmJfWqjmH6dtP1gvbZbeUi8wemsq'),
(5, 'meowmeow', 'coffeee', 'meow@gmail.com', '$2y$10$eL.683E6p5Jh9kK7BoGzyOKsz1I8t0GdjSkUzw0LXJtqIIKRdi0ga');

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
(52, 2, 'insert', 50, 'task', '2024-02-20 06:09:14'),
(53, 2, 'update', 50, 'task', '2024-02-20 06:09:23'),
(54, 2, 'archive', 50, 'task', '2024-02-20 06:09:27'),
(55, 2, 'delete', 50, 'archived_task', '2024-02-20 06:09:31'),
(56, 2, 'insert', 51, 'task', '2024-02-20 06:09:48'),
(57, 2, 'archive', 51, 'task', '2024-02-20 06:09:50'),
(58, 2, 'delete', 51, 'archived_task', '2024-02-20 06:09:54'),
(59, 2, 'update', 8, 'task', '2024-02-20 06:13:22'),
(60, 2, 'update', 9, 'task', '2024-02-20 06:41:43'),
(61, 2, 'update', 9, 'task', '2024-02-20 06:44:45'),
(62, 2, 'update', 9, 'task', '2024-02-20 06:48:54'),
(63, 2, 'update', 9, 'task', '2024-02-20 06:55:15'),
(64, 2, 'insert', 52, 'task', '2024-02-20 07:03:52'),
(65, 2, 'update', 52, 'task', '2024-02-20 07:10:18'),
(66, 4, 'insert', 53, 'task', '2024-02-20 10:37:20'),
(67, 4, 'update', 53, 'task', '2024-02-20 10:38:00'),
(68, 4, 'archive', 53, 'task', '2024-02-20 10:38:05'),
(69, 4, 'delete', 53, 'archived_task', '2024-02-20 10:38:17'),
(70, 2, 'insert', 54, 'task', '2024-02-20 12:30:30'),
(71, 2, 'update', 54, 'task', '2024-02-20 12:30:49'),
(72, 2, 'archive', 54, 'task', '2024-02-20 12:30:51'),
(73, 2, 'delete', 54, 'archived_task', '2024-02-20 12:30:55'),
(74, 5, 'insert', 55, 'task', '2024-02-20 12:45:39'),
(75, 5, 'update', 55, 'task', '2024-02-20 12:46:00'),
(76, 5, 'archive', 55, 'task', '2024-02-20 12:46:07'),
(77, 5, 'delete', 55, 'archived_task', '2024-02-20 12:46:14');

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
  MODIFY `archived_tasks_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `private_tasks`
--
ALTER TABLE `private_tasks`
  MODIFY `private_tasks_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `tasks_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

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
