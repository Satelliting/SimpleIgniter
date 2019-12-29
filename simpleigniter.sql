-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2019 at 02:45 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpleigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` bigint(20) NOT NULL,
  `userFirstName` varchar(50) NOT NULL,
  `userLastName` varchar(50) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` text NOT NULL,
  `userCreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `userRole` int(1) NOT NULL DEFAULT 0,
  `userStatus` int(1) NOT NULL DEFAULT 1,
  `userForgot` text DEFAULT NULL,
  `userForgotDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userFirstName`, `userLastName`, `userEmail`, `userPassword`, `userCreationDate`, `userRole`, `userStatus`, `userForgot`, `userForgotDate`) VALUES
(100000001, 'Jordan', 'Allen', 'jordanallen1332@gmail.com', '339759f3b11cfcaa23d7eda556718b1d986eeb5eaaeb5538537da18866df2513bb76e83f5d71b61fbcbeb8025768c73ff1d8cba3642e35a3f5ceabd126b076c8', '2019-12-27 23:00:43', 100, 1, NULL, NULL),
(100000002, 'Tests', 'Account', 'test@gmail.com', '89e85ec5bdafb314ca344b5853f7f8476c1d24309a6fd5459f387df7a0832982873a762cba88b2cb755ab0b964ab0d71ec970d9d59037b12b19251a8a789bb2b', '2019-12-28 22:59:41', 0, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000003;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
