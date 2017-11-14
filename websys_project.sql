-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2017 at 07:20 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websys_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `accountType` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `email`, `password`, `accountType`) VALUES
(1, 'aikenj@rpi.edu', 'ea71c25a7a602246b4c39824b855678894a96f43bb9b71319c39700a1e045222', 'RA'),
(2, 'email@rpi.edu', 'ea71c25a7a602246b4c39824b855678894a96f43bb9b71319c39700a1e045222', 'AD');

-- --------------------------------------------------------

--
-- Table structure for table `big_program_proposals`
--

CREATE TABLE `big_program_proposals` (
  `ID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `building` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `learningOutcomes` varchar(200) NOT NULL,
  `budget` int(11) NOT NULL,
  `itemNames` varchar(200) NOT NULL,
  `itemCosts` varchar(200) NOT NULL,
  `additional` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `big_program_proposals`
--

INSERT INTO `big_program_proposals` (`ID`, `name`, `building`, `date`, `time`, `location`, `title`, `description`, `learningOutcomes`, `budget`, `itemNames`, `itemCosts`, `additional`) VALUES
(1, 'John Aiken', 'Lally', '2017-11-17', '12:00', '102', 'group study', 'git gud', 'git gudder', 1000000, 'a:2:{i:0;s:22:"personal donation fund";i:1;s:5:"pizza";}', 'a:2:{i:0;s:6:"999990";i:1;s:2:"10";}', 'pls');

-- --------------------------------------------------------

--
-- Table structure for table `partner_proposals`
--

CREATE TABLE `partner_proposals` (
  `ID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `classYear` varchar(200) NOT NULL,
  `curricularExperience` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `learningObjectives` varchar(200) NOT NULL,
  `assessed` varchar(200) NOT NULL,
  `SLLsupport` varchar(200) NOT NULL,
  `additional` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `partner_proposals`
--

INSERT INTO `partner_proposals` (`ID`, `name`, `email`, `department`, `date`, `time`, `location`, `classYear`, `curricularExperience`, `description`, `learningObjectives`, `assessed`, `SLLsupport`, `additional`) VALUES
(1, 'john aiken', 'email', 'dept', '2001-01-01', '12:00', 'Carry', 'third', 'PIR', 'desc', 'LO', 'painfully', 'SLLsupport info', 'additional comments');

-- --------------------------------------------------------

--
-- Table structure for table `small_program_proposals`
--

CREATE TABLE `small_program_proposals` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `building` text NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `location` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `learningObjective` text NOT NULL,
  `q1` text NOT NULL,
  `q2` text NOT NULL,
  `q3` text NOT NULL,
  `budget` int(11) NOT NULL,
  `itemNames` text NOT NULL,
  `itemCosts` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `small_program_proposals`
--

INSERT INTO `small_program_proposals` (`ID`, `name`, `email`, `building`, `date`, `time`, `location`, `title`, `description`, `learningObjective`, `q1`, `q2`, `q3`, `budget`, `itemNames`, `itemCosts`) VALUES
(2, 'John Aikn', 'aikenj@rpi.edu', 'Lally', '2017-11-01', '17:00', '102', 'websys study group', 'git good', 'git good', 'question1?', 'question 2?', 'question 3?', 1000000, 'a:3:{i:0;s:8:"notebook";i:1;s:7:"tuition";i:2;s:3:"tip";}', 'a:3:{i:0;s:1:"2";i:1;s:5:"60000";i:2;s:5:"39998";}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `big_program_proposals`
--
ALTER TABLE `big_program_proposals`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `partner_proposals`
--
ALTER TABLE `partner_proposals`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `small_program_proposals`
--
ALTER TABLE `small_program_proposals`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `big_program_proposals`
--
ALTER TABLE `big_program_proposals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `partner_proposals`
--
ALTER TABLE `partner_proposals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `small_program_proposals`
--
ALTER TABLE `small_program_proposals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
