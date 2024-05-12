-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 05:10 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parth`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `parent_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `created_date`, `name`, `parent_id`) VALUES
(10, '2023-10-14 14:20:24', 'India', NULL),
(11, '2023-10-14 14:21:02', 'MH', 10),
(12, '2023-10-14 18:05:53', 'GJ', 10),
(13, '2023-10-14 18:06:17', 'Satara', 11),
(14, '2023-10-14 18:24:24', 'Jamnagar', 12),
(15, '2023-10-14 18:24:37', 'UP', 10),
(16, '2023-10-14 18:24:51', 'Gandhinagar', 12),
(17, '2023-10-14 18:30:19', 'Karad', 13),
(18, '2023-10-14 18:46:12', 'Khatav', 13),
(19, '2023-10-14 18:46:56', 'KA', 10),
(20, '2023-10-14 19:13:59', 'Sangli', 11),
(21, '2023-10-14 19:25:55', 'kolhapur', 11),
(22, '2023-10-14 19:27:12', 'Pune', 11),
(23, '2023-10-14 19:28:17', 'Sindhudurg', 11),
(24, '2023-10-14 19:28:46', 'ratnagitri', 11),
(25, '2023-10-14 19:32:41', 'Varanasi', 15),
(26, '2023-10-14 19:33:07', 'MP', 10),
(27, '2023-10-14 20:02:35', 'Medha', 13),
(28, '2023-10-14 20:03:07', 'Rajasthan', 10),
(29, '2023-10-14 20:05:26', 'Haryana', 10),
(30, '2023-10-14 20:07:58', 'Kole', 17),
(31, '2023-10-14 20:08:51', 'Undale', 17),
(32, '2023-10-14 20:09:28', 'raigad', 11),
(33, '2023-10-14 20:28:52', 'Belgaon', 19),
(34, '2023-10-14 20:36:55', 'Kagal', 21),
(35, '2023-10-14 20:39:19', 'walwa', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
