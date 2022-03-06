-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2022 at 10:02 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doku_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `document_name` varchar(50) DEFAULT NULL,
  `document_desc` varchar(30) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document_name`, `document_desc`, `group_id`, `user_id`, `update_at`) VALUES
(1, 'Kartu Keluarga', 'Fotocopy', 20, 1, '2021-12-20 04:12:53'),
(3, 'Ijazah', 'Fotocopy', 20, 1, '2021-12-20 03:22:42'),
(4, 'SKHUN', 'Asli', 1, 1, '2021-12-20 04:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `document_history`
--

CREATE TABLE `document_history` (
  `id` int(11) NOT NULL,
  `member_code` varchar(6) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `file_name` varchar(9) DEFAULT NULL,
  `validator` varchar(30) DEFAULT NULL,
  `validator_name` varchar(30) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `user_id`) VALUES
(1, 'XI TKJ 1 (2021-2022)', 1),
(10, 'XI TMI 2 (2021-2022)', 2),
(20, 'XI TKJ 2 (2021-2022)', 1),
(21, 'XI TKR 1 (2021-2022)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `member_code` varchar(6) NOT NULL,
  `member_name` varchar(50) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_code`, `member_name`, `group_id`, `user_id`, `update_at`) VALUES
(2, 'AGlCqM', 'MAHMUDI', 1, 1, '2021-12-28 05:12:24'),
(3, 'qvh5EL', 'MUHAMMAD NURHASAN MAHMUDI', 1, 1, '2021-12-28 05:51:22'),
(4, 'bMV9RR', 'HENRIFADIL SAPTO NUGROHO', 21, 1, '2021-12-20 05:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `mail`, `telp`, `address`, `update_at`) VALUES
(1, 'admin', '$2y$10$oM2kYy2NG/5xDPn3npQCm.s.gvDjjJ2UUjnQZLa2qzS9RsjFwCxe2', 'admin', 'admin', '089124', 'habdahsbdahsda', '2021-11-28 12:47:14'),
(6, 'apa', '$2y$10$5AhcoyYkWBn4ZpmAOSmkpOnapJgpYRhwweMAIoAq5g7P5z.35An9q', 'SMK TARUMA JAYA', 'bussines.mnmahmud@gmail.com', NULL, NULL, '2021-12-18 06:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `validators`
--

CREATE TABLE `validators` (
  `id` int(11) NOT NULL,
  `validator_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `validators`
--

INSERT INTO `validators` (`id`, `validator_name`, `user_id`) VALUES
(2, 'Supervisors', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_history`
--
ALTER TABLE `document_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_code` (`member_code`),
  ADD KEY `users` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `validators`
--
ALTER TABLE `validators`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `document_history`
--
ALTER TABLE `document_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `validators`
--
ALTER TABLE `validators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
