-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2016 at 11:40 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coder`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentid` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `username` varchar(50) NOT NULL,
  `postid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentid`, `comment`, `username`, `postid`) VALUES
(1, 'This is a good program', 'anik', 3),
(2, 'Osthir type er code ami age airokom code dekhini....', 'rizvi', 3),
(4, 'Hi I Am Prosen.', 'rizvi', 3),
(5, 'I am Rizvi...', 'rizvi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(11) NOT NULL,
  `posttitle` varchar(200) NOT NULL,
  `post` varchar(2000) NOT NULL,
  `date` varchar(30) NOT NULL,
  `point` int(11) DEFAULT NULL,
  `tag` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `state` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `posttitle`, `post`, `date`, `point`, `tag`, `username`, `state`) VALUES
(3, 'C Hello World', '#include <stdio.h>\r\n\r\nint main(void) {\r\n	// your code goes here\r\n	printf("Hello Prosen");\r\n	return 0;\r\n}', '2016/11/04', 0, 'C', 'rizvi', 'ACTIVE'),
(4, 'Hello World In Java', 'import java.util.*;\r\nimport java.lang.*;\r\nimport java.io.*;\r\n\r\n/* Name of the class has to be "Main" only if the class is public. */\r\nclass Ideone\r\n{\r\n	public static void main (String[] args) throws java.lang.Exception\r\n	{\r\n		System.out.println("Hello Java");\r\n	}\r\n}', '2016/11/09', 0, 'Java, Basic', 'anik', 'ACTIVE'),
(8, 'String Example In C++', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n	string str = "This is a String.";\r\n	coout << str << endl;\r\n	return 0;\r\n}', '2016/11/09', 0, 'C++, String', 'anik', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `postview`
--

CREATE TABLE `postview` (
  `postviewid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `totalpostview` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postview`
--

INSERT INTO `postview` (`postviewid`, `postid`, `totalpostview`) VALUES
(1, 3, 21),
(3, 4, 7),
(7, 8, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `serialno` int(11) NOT NULL,
  `category` varchar(20) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`serialno`, `category`, `username`, `name`, `email`, `password`, `address`, `url`, `status`, `picture`, `country`, `city`) VALUES
(1, 'admin', 'admin', 'Prosen Ghosh', 'prosenghosh25@gmail.com', 'Pg1234', '577/A Dhaka Cantonment', 'https://www.facebook.com/prosenghosh25', 'ACTIVE', '', 'Bangladesh', 'Dhaka'),
(2, 'user', 'anik', 'Gm Anik', 'anik@gmail.com', 'Anik123', 'Noawapara', 'https://www.facebook.com/gm.anik2?fref=ts', 'ACTIVE', '', 'Bangladesh', 'Jessore'),
(3, 'USER', 'rizvi', 'Rizvi', 'rizvi@gmail.com', 'A1234a', 'Dhaka', '', 'ACTIVE', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `postview`
--
ALTER TABLE `postview`
  ADD PRIMARY KEY (`postviewid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`serialno`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `postview`
--
ALTER TABLE `postview`
  MODIFY `postviewid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `serialno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
