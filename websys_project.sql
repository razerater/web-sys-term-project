-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2017 at 01:59 AM
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
(1, 'RAemail@rpi.edu', 'ea71c25a7a602246b4c39824b855678894a96f43bb9b71319c39700a1e045222', 'RA'),
(5, 'RDemail@rpi.edu', 'ea71c25a7a602246b4c39824b855678894a96f43bb9b71319c39700a1e045222', 'RD'),
(6, 'ADemail@rpi.edu', 'ea71c25a7a602246b4c39824b855678894a96f43bb9b71319c39700a1e045222', 'AD'),
(7, 'trial1@rpi.edu', 'ea71c25a7a602246b4c39824b855678894a96f43bb9b71319c39700a1e045222', 'RA'),
(8, 'test@rpi.edu', 'ea71c25a7a602246b4c39824b855678894a96f43bb9b71319c39700a1e045222', 'RA'),
(9, 'test2@rpi.edu', 'ea71c25a7a602246b4c39824b855678894a96f43bb9b71319c39700a1e045222', 'RA'),
(10, 'demo@rpi.edu', 'ea71c25a7a602246b4c39824b855678894a96f43bb9b71319c39700a1e045222', 'RA');

-- --------------------------------------------------------

--
-- Table structure for table `big_program_proposals`
--

CREATE TABLE `big_program_proposals` (
  `ID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` text NOT NULL,
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
  `additional` varchar(200) DEFAULT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'Unapproved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `big_program_proposals`
--

INSERT INTO `big_program_proposals` (`ID`, `name`, `email`, `building`, `date`, `time`, `location`, `title`, `description`, `learningOutcomes`, `budget`, `itemNames`, `itemCosts`, `additional`, `status`) VALUES
(1, 'John Aiken', 'RAemail@rpi.edu', 'Lally', '2017-11-17', '12:00', '102', 'group study', 'git gud', 'git gudder', 1000000, 'a:2:{i:0;s:22:"personal donation fund";i:1;s:5:"pizza";}', 'a:2:{i:0;s:6:"999990";i:1;s:2:"10";}', 'pls', 'Unapproved'),
(5, 'asdsad', 'RDemail@rpi.edu', 'asdasd', '0009-09-09', '17:00', 'asdasd', 'axczxc', 'SADSAD', 'asdasd', 10, 'a:2:{i:0;s:3:"asd";i:1;s:11:"ECOND FIELD";}', 'a:2:{i:0;s:1:"1";i:1;s:3:"123";}', 'assad', 'Rejected');

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
  `additional` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'Unapproved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `partner_proposals`
--

INSERT INTO `partner_proposals` (`ID`, `name`, `email`, `department`, `date`, `time`, `location`, `classYear`, `curricularExperience`, `description`, `learningObjectives`, `assessed`, `SLLsupport`, `additional`, `status`) VALUES
(1, 'john aiken', 'email', 'dept', '2001-01-01', '12:00', 'Carry', 'third', 'PIR', 'desc', 'LO', 'painfully', 'SLLsupport info', 'additional comments', 'Unapproved'),
(3, 'raz reed', 'reedr@rpi.edu', 'dept', '0099-09-09', '17:00', 'EC-4', 'first', 'MCGP', 'desc', 'lo', 'assess', 'asdasd', '?????', 'Unapproved');

-- --------------------------------------------------------

--
-- Table structure for table `program_assessments`
--

CREATE TABLE `program_assessments` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `building` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `pre1` varchar(200) NOT NULL,
  `pre2` varchar(200) NOT NULL,
  `pre3` varchar(200) NOT NULL,
  `post1` varchar(200) NOT NULL,
  `post2` varchar(200) NOT NULL,
  `post3` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_assessments`
--

INSERT INTO `program_assessments` (`id`, `name`, `email`, `building`, `date`, `title`, `description`, `pre1`, `pre2`, `pre3`, `post1`, `post2`, `post3`) VALUES
(3, 'asdsad', 'asasd', 'barton', '12213-09-09', 'qweqwe', '', 'lkasdnasdlkn', 'aaasldknasd', 'klasndlk', 'asdlknasd', 'asldknasd', 'alksdnasd');

-- --------------------------------------------------------

--
-- Table structure for table `program_evaluation`
--

CREATE TABLE `program_evaluation` (
  `id` int(11) NOT NULL,
  `major` varchar(200) NOT NULL,
  `staff` varchar(200) NOT NULL,
  `building` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `learned` varchar(200) NOT NULL,
  `enjoyment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_evaluation`
--

INSERT INTO `program_evaluation` (`id`, `major`, `staff`, `building`, `date`, `title`, `category`, `learned`, `enjoyment`) VALUES
(1, 'itws', 'asdsad', 'barton', '9001-09-09', 'adsasd', 'ggds', 'asdasd', 'gsdf'),
(2, 'asdsad', 'asdasd', 'barton', '122132-09-09', 'qqweasd', 'asdasd', 'asdsad', 'asdsad');

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
  `itemCosts` text NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'Unapproved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `small_program_proposals`
--

INSERT INTO `small_program_proposals` (`ID`, `name`, `email`, `building`, `date`, `time`, `location`, `title`, `description`, `learningObjective`, `q1`, `q2`, `q3`, `budget`, `itemNames`, `itemCosts`, `status`) VALUES
(2, 'John Aikn', 'RAemail@rpi.edu', 'Lally', '2017-11-01', '17:00', '102', 'websys study group', 'git good', 'git good', 'question1?', 'question 2?', 'question 3?', 1000000, 'a:3:{i:0;s:8:"notebook";i:1;s:7:"tuition";i:2;s:3:"tip";}', 'a:3:{i:0;s:1:"2";i:1;s:5:"60000";i:2;s:5:"39998";}', 'Accepted'),
(3, 'John Aiken', 'RAemail@rpi.edu', 'lally', '2017-12-12', '13:00', '103', 'Program 2', 'testing to see how multiple results are handled', 'nice', 'q1', 'q2', 'q3', 11, 'a:2:{i:0;s:8:"donation";i:1;s:4:"food";}', 'a:2:{i:0;s:1:"1";i:1;s:2:"10";}', 'Rejected'),
(4, 'john aiken', 'RDemail@rpi.edu', 'carnegie', '2018-09-28', '05:00', '100', 'learn things', 'learn about the things', 'yes', 'q1', 'q2', 'qq3', 2, 'a:1:{i:0;s:3:"tax";}', 'a:1:{i:0;s:1:"2";}', 'Unapproved'),
(8, 'skkkkrt', 'RDemail@rpi.edu', 'niBBa', '0001-09-10', '05:00', '100', 'skrrrt', 'desc', 'lo', 'q1', 'q2', 'q3', 1000000, 'a:2:{i:0;s:6:"ayyyyy";i:1;s:4:"lmao";}', 'a:2:{i:0;s:6:"999999";i:1;s:1:"1";}', 'Rejected');

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
-- Indexes for table `program_assessments`
--
ALTER TABLE `program_assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_evaluation`
--
ALTER TABLE `program_evaluation`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `big_program_proposals`
--
ALTER TABLE `big_program_proposals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `partner_proposals`
--
ALTER TABLE `partner_proposals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `program_assessments`
--
ALTER TABLE `program_assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `program_evaluation`
--
ALTER TABLE `program_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `small_program_proposals`
--
ALTER TABLE `small_program_proposals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
