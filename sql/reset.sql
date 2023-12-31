-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Oct 12, 2023 at 06:37 PM
-- Server version: 8.0.21
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fasistent`
--

DROP DATABASE IF EXISTS `cn_demo`;
DROP DATABASE IF EXISTS `fasistent`;

CREATE DATABASE IF NOT EXISTS `fasistent` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `fasistent`;

-- --------------------------------------------------------

--
-- Table structure for table `rickrolls`
--
DROP TABLE IF EXISTS `rickrolls`;
CREATE TABLE `rickrolls` (
  `id` int NOT NULL,
  `ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rickrolls`
--
ALTER TABLE `rickrolls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rickrolls`
--
ALTER TABLE `rickrolls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades` (
  `id` int NOT NULL,
  `grade` varchar(10) NOT NULL,
  `student_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `grade`, `student_id`, `subject_id`, `teacher_id`, `timestamp`) VALUES
(4, '2', 5, 3, 4, '2023-10-08 21:25:24'),
(5, '5', 7, 1, 3, '2023-10-08 21:33:37'),
(10, '6', 7, 1, 3, '2023-10-08 21:34:01'),
(12, '5', 7, 1, 3, '2023-10-08 21:34:08'),
(13, '4', 7, 1, 3, '2023-10-08 21:34:11'),
(14, '5', 7, 1, 3, '2023-10-08 21:34:13'),
(15, '2', 5, 1, 3, '2023-10-08 21:34:20'),
(16, '1', 5, 1, 3, '2023-10-08 21:34:22'),
(18, '2', 5, 1, 3, '2023-10-08 21:34:25'),
(19, '5', 7, 4, 3, '2023-10-08 21:34:31'),
(20, '4', 7, 4, 3, '2023-10-08 21:34:35'),
(21, '2', 5, 2, 4, '2023-10-08 21:34:52'),
(22, '3', 5, 2, 4, '2023-10-08 21:34:55'),
(23, '2', 5, 2, 4, '2023-10-08 21:34:56'),
(24, '2', 7, 2, 4, '2023-10-08 21:34:58'),
(25, '1', 5, 2, 4, '2023-10-08 21:35:01'),
(26, '2', 7, 2, 4, '2023-10-08 21:35:03'),
(27, '3', 7, 2, 4, '2023-10-08 21:35:08'),
(28, '1', 7, 2, 4, '2023-10-08 21:35:10'),
(29, '5', 5, 3, 4, '2023-10-08 21:35:16'),
(30, '4', 7, 3, 4, '2023-10-08 21:35:19'),
(31, '5', 7, 3, 4, '2023-10-08 21:35:22'),
(33, '5', 10, 1, 3, '2023-10-08 21:33:37'),
(34, '6', 10, 1, 3, '2023-10-08 21:34:01'),
(35, '5', 10, 1, 3, '2023-10-08 21:34:08'),
(36, '4', 10, 1, 3, '2023-10-08 21:34:11'),
(37, '5', 10, 1, 3, '2023-10-08 21:34:13'),
(38, '5', 10, 4, 3, '2023-10-08 21:34:31'),
(39, '4', 10, 4, 3, '2023-10-08 21:34:35'),
(40, '2', 10, 2, 4, '2023-10-08 21:34:58'),
(41, '2', 10, 2, 4, '2023-10-08 21:35:03'),
(42, '3', 10, 2, 4, '2023-10-08 21:35:08'),
(43, '1', 10, 2, 4, '2023-10-08 21:35:10'),
(44, '4', 10, 3, 4, '2023-10-08 21:35:19'),
(45, '5', 10, 3, 4, '2023-10-08 21:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `description`) VALUES
(1, 'Matematika', 'Vsi jo imamo radi!'),
(2, 'Slovenščina', 'brt js ne znam po slovenski'),
(3, 'Geografija', 'Sever je gor, ne?'),
(4, 'Zgodovina', 'Jah, je blo kar je blo...');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','teacher','admin','') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'd008b35ed33449e584632397f7b45553', 'admin'),
(2, 'Tadej', '709a31b1ebd7a0230bd413f32661061a', 'teacher'),
(3, 'Aljaz', 'd008b35ed33449e584632397f7b45553', 'teacher'),
(4, 'Manja', '25f9e794323b453885f5181f1b624d0b', 'teacher'),
(5, 'FranciNaBalanci', '2e8f2fff77a1dd6be8dd5b2f2e5b02e5', 'student'),
(7, 'JakaNovak', '89027d8ca2ee716eefb16cdfe6265ca5', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `users_subjects`
--

DROP TABLE IF EXISTS `users_subjects`;
CREATE TABLE `users_subjects` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `subject_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_subjects`
--

INSERT INTO `users_subjects` (`id`, `user_id`, `subject_id`) VALUES
(4, 2, 2),
(1, 3, 1),
(2, 3, 4),
(5, 4, 2),
(3, 4, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`,`subject_id`,`teacher_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_subjects`
--
ALTER TABLE `users_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_subjects`
--
ALTER TABLE `users_subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `users_subjects`
--
ALTER TABLE `users_subjects`
  ADD CONSTRAINT `users_subjects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `users_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
