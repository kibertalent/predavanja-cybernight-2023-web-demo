-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Oct 08, 2023 at 10:00 PM
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
-- Database: `cn_demo`
--

DROP DATABASE IF EXISTS `cn_demo`;
DROP DATABASE IF EXISTS `fasistent`;

CREATE DATABASE IF NOT EXISTS `fasistent` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `fasistent`;
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
(1, 'admin', '$2y$10$TAwNe5zRhiZvq5DPfFbmROtBOeCosBtslVUW/AkBMlkhp4vhL874S', 'admin'),
(2, 'Tadej', '$2y$10$3CQdHKRsl6T/8MTGL1cIgekeM/T4BOjiyOTpL09is6KahPtL2wdh.', 'teacher'),
(3, 'Aljaz', '$2y$10$gn6l5Lbgu4wy/V3UJuujk.xh5GolrXj/0god5K6okMYkM7DnfNcn2', 'teacher'),
(4, 'Manja', '$2y$10$zYTCDsZktWdlAvhZi.9nq.Sw0NpIcbmpYkdji0KUxszeTSZL3QVDW', 'teacher'),
(5, 'FranciNaBalanci', '$2y$10$liUfhiAQjrNysbe0syMhku2k7Zu4o6lJvSQSFMJNNZb9Adl1WvAaO', 'student'),
(6, 'test', '$2y$10$KMKdPWuYWiz2jJJeXQgtj.wK2Qd7kEoeM9wcRXxo7f2pSjYlno656', 'student'),
(7, 'JakaNovak', '$2y$10$vMygSk5F1VRWE6scLA4QFOdK3c3SfYo5n1Jz27BPgoFJAZi0tJdOm', 'student'),
(10, 'anze', '$2y$10$7UwNxzgxa35eBk.A7pN3UO76t07xcY6BIonUwy0jMVfVnEzcgYPWi', 'student');

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
