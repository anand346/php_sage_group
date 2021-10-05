-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2021 at 11:40 AM
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
-- Database: `db_sage`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `touser` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `fromuser`, `touser`, `message`) VALUES
(1, 2, 1, 'hello anand'),
(2, 1, 2, 'hello faiyaz'),
(3, 2, 1, 'aur kaise ho'),
(4, 1, 2, 'hy'),
(5, 2, 1, 'hello'),
(6, 1, 2, 'aur batao'),
(7, 2, 1, 'bs badhiya'),
(8, 1, 2, 'aur kuch'),
(9, 2, 1, 'nhi yr sb thik h'),
(10, 1, 2, 'nice'),
(11, 1, 2, 'aur bataiye'),
(12, 2, 1, 'bs maje me'),
(13, 1, 2, 'aur kuch batao'),
(14, 2, 1, 'kya bataye'),
(15, 1, 2, 'batao kuch'),
(16, 2, 1, 'sb thik h'),
(17, 1, 3, 'hy birother'),
(18, 3, 1, 'hy big b'),
(19, 1, 3, 'aur kaise ho birother'),
(20, 3, 1, 'badhiya hun big b'),
(21, 1, 3, 'f'),
(22, 1, 3, 'f'),
(23, 1, 3, 'f'),
(24, 1, 3, 'f'),
(25, 1, 3, 'f'),
(26, 1, 3, 'f'),
(27, 3, 1, 'f');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `post_desc` text NOT NULL,
  `post_img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `username`, `post_desc`, `post_img`) VALUES
(16, 'aman1', ' ', '1633424918Screenshot (8).png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `ip` varchar(256) NOT NULL,
  `profile_img` varchar(256) NOT NULL,
  `vkey` varchar(256) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `ip`, `profile_img`, `vkey`, `verified`) VALUES
(1, 'anand1', 'rajanand9039@gmail.com', 'rajanand9039', '::1', 'profile_img.png', '84a2a50dffb09d6b272097d987943183', 1),
(2, 'Faiyaz', 'faiyazstart786@gmail.com', 'faiyaz', '::1', 'profile_img.png', 'd8a281f75de8040b7cc77a768392bc51', 1),
(3, 'aman1', 'aman@gmail.com', 'aman', '::1', 'profile_img.png', 'a94093d930ba4156def0c213e6d73f48', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
