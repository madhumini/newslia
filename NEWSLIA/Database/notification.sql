-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 05:44 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newslia`
--

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `Notification_ID` int(11) NOT NULL,
  `Post_ID` varchar(11) NOT NULL,
  `Approve_or_Reject` varchar(10) NOT NULL,
  `System_Actor_ID` varchar(10) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Read` tinyint(1) NOT NULL DEFAULT 0,
  `Moderator_ID` varchar(10) NOT NULL,
  `Title` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`Notification_ID`, `Post_ID`, `Approve_or_Reject`, `System_Actor_ID`, `Date`, `Time`, `Read`, `Moderator_ID`, `Title`) VALUES
(3, 'NL-A-1', 'Approve', 'NL-M-2', '2022-01-06', '15:27:28', 0, 'NL-M-1', ''),
(4, 'NL-A-2', 'Approve', 'NL-M-2', '2022-01-06', '15:36:49', 0, 'NL-M-1', ''),
(11, 'NL-NO-2', 'Approve', 'NL-M-2', '2022-01-06', '18:27:34', 0, 'NL-M-1', ''),
(12, 'NL-NO-2', 'Approve', 'NL-M-2', '2022-01-06', '18:31:48', 0, 'NL-M-1', ''),
(14, 'NL-JV-1', 'Approve', 'NL-M-2', '2022-01-06', '20:11:45', 0, 'NL-M-1', ''),
(15, 'NL-CA-1', 'Approve', 'NL-M-2', '2022-01-06', '20:18:17', 0, 'NL-M-1', ''),
(16, 'NL-CA-1', 'Approve', 'NL-M-2', '2022-01-13', '18:59:48', 0, 'NL-M-1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`Notification_ID`),
  ADD KEY `System_Actor_ID` (`System_Actor_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `Notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`System_Actor_ID`) REFERENCES `system_actor` (`System_Actor_Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
