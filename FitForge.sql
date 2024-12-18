-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2024 at 09:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FitForge`
--

-- --------------------------------------------------------

--
-- Table structure for table `Credit_Card`
--

CREATE TABLE `Credit_Card` (
  `Credit_Card_Number` varchar(16) NOT NULL,
  `Card_Holder_Name` varchar(100) DEFAULT NULL,
  `Expiry_Date` varchar(100) DEFAULT NULL,
  `CVV` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Credit_Card`
--

INSERT INTO `Credit_Card` (`Credit_Card_Number`, `Card_Holder_Name`, `Expiry_Date`, `CVV`) VALUES
('4069691103772428', 'Mohamad Deryan', 'April 2032', '079');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `goal_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `target_date` date NOT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Membership_Plans`
--

CREATE TABLE `Membership_Plans` (
  `Subscription` varchar(100) NOT NULL,
  `Duration` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Membership_Plans`
--

INSERT INTO `Membership_Plans` (`Subscription`, `Duration`, `Price`) VALUES
('Deluxe', 3, 20.00),
('Premium', 12, 70.00),
('Standard', 1, 8.00);

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE `Reviews` (
  `ID` int(11) NOT NULL,
  `review` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `FN` varchar(50) DEFAULT NULL,
  `LN` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Credit_Card_Number` varchar(16) DEFAULT NULL,
  `Subscription` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Credit_Card`
--
ALTER TABLE `Credit_Card`
  ADD PRIMARY KEY (`Credit_Card_Number`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `FK_goals_Users` (`Email`);

--
-- Indexes for table `Membership_Plans`
--
ALTER TABLE `Membership_Plans`
  ADD PRIMARY KEY (`Subscription`);

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `FK_Credit_Card_Number` (`Credit_Card_Number`),
  ADD KEY `FK_Subscription` (`Subscription`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `FK_goals_Users` FOREIGN KEY (`Email`) REFERENCES `Users` (`Email`);

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `FK_Credit_Card_Number` FOREIGN KEY (`Credit_Card_Number`) REFERENCES `Credit_Card` (`Credit_Card_Number`),
  ADD CONSTRAINT `FK_Subscription` FOREIGN KEY (`Subscription`) REFERENCES `Membership_Plans` (`Subscription`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
