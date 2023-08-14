-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 19, 2023 at 12:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL DEFAULT 'radmin',
  `pcode` varchar(5) NOT NULL DEFAULT '-----',
  `role` enum('admin','superadmin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `fname`, `lname`, `email`, `phone`, `address`, `password`, `pcode`, `role`) VALUES
(1, 'Ram', 'Shrestha', 'photosthapit3@gmail.com', '9808246702', 'Kapan', 'ram', 'zoNPk', 'admin'),
(2, 'Hemant', 'Khatiwada', 'photosthapit4@gmail.com', '9813012391', 'Mahankal', 'Ramu', 'RbXUm', 'superadmin'),
(7, 'Bikram', 'Dahal', 'beeku@gmail.com', '9813012397', 'Kalopul', '1234', '-----', 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `auth_id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`auth_id`, `Name`) VALUES
(1, 'Ramesh'),
(3, 'Badal'),
(6, 'saugat sthapitt'),
(7, 'Sanjay Siwakoti');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `b_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `rack` varchar(10) NOT NULL,
  `copies` int(11) NOT NULL,
  `imgname` varchar(30) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`b_id`, `name`, `isbn`, `author`, `category`, `rack`, `copies`, `imgname`) VALUES
(28, 'Ramayan', '666', 'ramesh', 'English', 'R3', 23, '28.jpg'),
(29, 'Java', '477', 'babu', 'English', 'R1', 32, '29.jpg'),
(31, 'Engineering', '1234', 'saugat sthapit', 'English', 'R1', 115, '31.jpg'),
(32, 'Famous Tricks', '4321', 'ramesh', 'English', 'R3', 27, '32.jpg'),
(33, 'Mechanics', '112', 'Badal', 'English', 'R2', 20, '33.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `Name`) VALUES
(7, 'Programming'),
(21, 'Nepali'),
(22, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `issue_book`
--

CREATE TABLE `issue_book` (
  `issue_id` int(11) NOT NULL,
  `Book` varchar(70) NOT NULL,
  `ISBN` varchar(30) NOT NULL,
  `Student` varchar(50) NOT NULL,
  `roll` varchar(4) NOT NULL,
  `Faculty` enum('BCA','BBS','BSW') NOT NULL,
  `Issue_date` date NOT NULL,
  `Expected_return` date NOT NULL,
  `Status` enum('Issued','Returned','Not returned') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_book`
--

INSERT INTO `issue_book` (`issue_id`, `Book`, `ISBN`, `Student`, `roll`, `Faculty`, `Issue_date`, `Expected_return`, `Status`) VALUES
(2, 'Engineering', '1234', 'Saugat', '12', 'BCA', '2023-07-18', '2023-07-30', 'Issued'),
(4, 'Java', '477', 'Sanjay', '321', 'BCA', '2023-07-19', '2023-07-30', 'Issued');

-- --------------------------------------------------------

--
-- Table structure for table `rack`
--

CREATE TABLE `rack` (
  `rack_id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rack`
--

INSERT INTO `rack` (`rack_id`, `Name`) VALUES
(2, 'R3'),
(5, 'R2'),
(16, 'R1'),
(17, 'R4');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `s_id` int(11) NOT NULL,
  `roll` varchar(4) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `faculty` enum('BCA','BBS','BSW','MBS') NOT NULL,
  `address` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL DEFAULT 'reliance',
  `pcode` varchar(5) NOT NULL DEFAULT '-----',
  `fine` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `roll`, `fname`, `lname`, `email`, `phone`, `faculty`, `address`, `password`, `pcode`, `fine`) VALUES
(1, '12', 'Saugat', 'Sthapit', 'saugatsthapit3@gmail.com', '981301391', 'BCA', 'Chabahil', '1234', 'lSeT6', 0),
(6, '321', 'Sanjay', 'Majhi', 'sanjay123@gmail.com', '9813012391', 'BCA', 'Kapan', 'reliance', '-----', 0),
(8, '01', 'Ram', 'Khanal', 'ram123@gmail.com', '9856237412', 'BCA', 'Kapan', 'reliance', '-----', 0),
(9, '234', 'Shreenarayan', 'Shrestha', 'shree123@gmail.com', '9813012399', 'BCA', 'Kapan', 'reliance', '-----', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `issue_book`
--
ALTER TABLE `issue_book`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `rack`
--
ALTER TABLE `rack`
  ADD PRIMARY KEY (`rack_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `issue_book`
--
ALTER TABLE `issue_book`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rack`
--
ALTER TABLE `rack`
  MODIFY `rack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
