-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 02:53 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendencedetails`
--

CREATE TABLE `attendencedetails` (
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `AttendenceStatus` tinyint(4) NOT NULL DEFAULT 0,
  `UpdatedByID` int(11) NOT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `ClassID` int(11) NOT NULL,
  `Class` varchar(5) NOT NULL,
  `Fees` decimal(5,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ClassID`, `Class`, `Fees`) VALUES
(1, 'I', '0.00'),
(2, 'II', '0.00'),
(3, 'III', '0.00'),
(4, 'IV', '0.00'),
(5, 'V', '0.00'),
(6, 'VI', '0.00'),
(7, 'VII', '0.00'),
(8, 'VIII', '0.00'),
(9, 'IX', '0.00'),
(10, 'X', '0.00'),
(11, 'XI', '0.00'),
(12, 'XII', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `feesdetails`
--

CREATE TABLE `feesdetails` (
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Month` int(11) NOT NULL,
  `FeesAmount` decimal(5,2) NOT NULL,
  `ReceivedAmount` decimal(5,2) NOT NULL,
  `Discount` decimal(5,2) NOT NULL DEFAULT 0.00,
  `UpdatedByID` int(11) NOT NULL,
  `UpdatedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `markdetails`
--

CREATE TABLE `markdetails` (
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `ExamNo` int(11) NOT NULL,
  `Marks` decimal(3,2) NOT NULL,
  `UpdatedByID` int(11) NOT NULL,
  `UpdatedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `ID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `Month` int(11) NOT NULL,
  `SalaryAmount` decimal(5,2) NOT NULL,
  `ReceivedAmount` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `StaffName` varchar(100) NOT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `MobileNo` varchar(50) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `AadharCardNo` int(20) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `EducationDetails` varchar(500) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `EntryDate` date NOT NULL,
  `EntryByID` int(11) NOT NULL,
  `Inservice` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffName`, `Gender`, `MobileNo`, `Email`, `AadharCardNo`, `Address`, `EducationDetails`, `Password`, `EntryDate`, `EntryByID`, `Inservice`) VALUES
(2, 'dfsgbs', 'Male', '123123', 'abc@123', 23312, '113', '1231', 'ramanujan@123', '2022-04-28', 1, 0),
(3, 'ABC', 'Female', '1234564568', 'abc@1233', 2147483647, 'GGGt', 'NNN', 'ramanujan@123', '2022-04-28', 1, 1),
(4, 'ABCD', 'Male', '1234564567', 'abc@1236', 2147483647, 'hhh', 'yyy', 'ramanujan@123', '2022-04-28', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staffattendence`
--

CREATE TABLE `staffattendence` (
  `ID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `AttendenceStatus` tinyint(4) NOT NULL DEFAULT 0,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `StudentName` varchar(100) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `FatherName` varchar(100) NOT NULL,
  `MotherName` varchar(100) NOT NULL,
  `AadharCardNo` int(11) NOT NULL,
  `MobileNo` int(11) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `RollNo` int(11) NOT NULL,
  `Photo` int(11) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `RegistrationDate` date NOT NULL,
  `RegisteredByID` int(11) NOT NULL,
  `Passout` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `StudentName`, `ClassID`, `Gender`, `FatherName`, `MotherName`, `AadharCardNo`, `MobileNo`, `Address`, `RollNo`, `Photo`, `Password`, `RegistrationDate`, `RegisteredByID`, `Passout`) VALUES
(1, 'ABC', 1, 'Female', 'CDE', 'FGH', 123456789, 2147483647, 'LKO', 0, 0, 'ramanujan@123', '2022-05-02', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `SubjectID` int(11) NOT NULL,
  `SubjectName` varchar(50) NOT NULL,
  `ClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`SubjectID`, `SubjectName`, `ClassID`) VALUES
(1, 'Mathematics', 1),
(2, 'English', 2),
(3, 'Hindi', 1),
(4, 'Maths', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendencedetails`
--
ALTER TABLE `attendencedetails`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ClassID`);

--
-- Indexes for table `feesdetails`
--
ALTER TABLE `feesdetails`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `markdetails`
--
ALTER TABLE `markdetails`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `staffattendence`
--
ALTER TABLE `staffattendence`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`SubjectID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendencedetails`
--
ALTER TABLE `attendencedetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feesdetails`
--
ALTER TABLE `feesdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `markdetails`
--
ALTER TABLE `markdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staffattendence`
--
ALTER TABLE `staffattendence`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
