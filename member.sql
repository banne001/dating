-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2021 at 11:24 PM
-- Server version: 10.2.37-MariaDB
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
-- Database: `blezylsa_grc`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(5) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `state` varchar(20) DEFAULT NULL,
  `seeking` varchar(20) DEFAULT NULL,
  `bio` varchar(1000) DEFAULT NULL,
  `premium` tinyint(1) DEFAULT NULL,
  `interests` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `fname`, `lname`, `age`, `gender`, `phone`, `email`, `state`, `seeking`, `bio`, `premium`, `interests`, `image`) VALUES
(1, 'Blezyl', 'Santos', 19, 'female', '1000000001', 'bsantos@yahoo.com', 'Washington', NULL, NULL, 1, NULL, NULL),
(2, 'Luke', 'Skywalker', 67, 'male', '8880001111', 'ls@hotmail.com', 'Alabama', 'Female', 'I am a Jedi', 1, '', ''),
(3, 'baby', 'yod', 22, 'male', '0', 'b@G.com', 'Washington', 'female', 'I AM A BABYY', 0, '', ''),
(4, 'baby', 'yod', 22, 'female', '1234567890', 'blezylsantos@hotmail.com', 'Arizona', 'female', 'stilll a baby', 1, 'board games, collecting', 'images/937638c53cfa769461280bfeb7332728.png'),
(5, 'Sandra', 'Bullock', 60, 'female', '1234567890', 'sb@yahoo.com', 'Illinois', 'male', 'I was in Gravity', 0, '', ''),
(6, 'George', 'Clooney', 61, 'male', '1234567890', 'bc@gmail.com', 'Washington', 'female', 'I was also in Gravity', 1, '', 'images/profile.png'),
(7, 'Prince', 'Charming', 23, 'male', '1234567890', 'pc@hotmail.com', 'Arkansas', 'female', 'I am that Prince', 1, 'cooking, board games, puzzles, reading, biking, swimming, collecting, walking', 'images/profile.png'),
(8, 'Hannah', 'Montana', 29, 'female', '1112223333', 'hm@gmail.com', 'Montana', 'male', 'I am a singer', 1, 'walking, climbing', 'images/profile.png'),
(9, 'Justin', 'Timberlake', 33, 'male', '2223334444', 'jt@mail.com', 'Arkansas', 'female', 'I am coooll', 1, 'movies, biking', 'images/1083e39783a0991b4cc0362cce2e7dc2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
