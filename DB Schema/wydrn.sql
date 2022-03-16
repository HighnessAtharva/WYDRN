-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 06:51 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wydrn`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `username` varchar(50) NOT NULL,
  `videogame` varchar(120) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `album` varchar(150) DEFAULT NULL,
  `artist` varchar(100) DEFAULT NULL,
  `book` varchar(200) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `movie` varchar(150) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `tv` varchar(150) DEFAULT NULL,
  `streaming` varchar(100) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`username`, `videogame`, `platform`, `album`, `artist`, `book`, `author`, `movie`, `year`, `tv`, `streaming`, `datetime`, `date`) VALUES
('susujpeg', 'Serious Sam 4', 'Playstation 5', '', '', 'Royal Assassin', 'Robin Hobb', '13 Going on 30', '1978', '', '', '2022-03-08 16:44:04', '2022-03-08'),
('HighnessAtharva', 'Elden Ring', 'PC', 'Cavalcade', 'Black Midi', 'Royal Assassin', 'Robin Hobb', 'The Batman', '2022', 'Peaky Blinders', 'Netflix', '2022-03-09 10:56:03', '2022-03-09'),
('HighnessAtharva', 'Elden Ring', 'PC', '', '', '', '', '', '', 'Cheeky Suckers', 'Netflix', '2022-03-09 10:59:35', '2022-03-09'),
('HighnessAtharva', 'Elden Ring', 'XBOX', 'Cavalcade', 'Black Midi', 'Royal Assassin', 'Robin Hobb', 'The Batman ', '2022', 'Peaky Blinders', 'Netflix', '2022-03-09 11:02:27', '2022-03-09'),
('HighnessAtharva', 'Elden Ring', 'PC', 'Cavalcade', 'Black Midi', 'Royal Assassin', 'Robin Hobb', 'The Batman ', '2022', 'Game of Thrones', 'HBO', '2022-03-09 11:04:49', '2022-03-09'),
('susujpeg', 'Elden Ring', 'PC', '', '', '', '', '', '', '', '', '2022-03-09 11:11:39', '2022-03-09'),
('HighnessAtharva', '', '', 'Cavalcade', 'Black Midi', '', '', '', '', '', '', '2022-03-09 11:12:20', '2022-03-09'),
('HighnessAtharva', '', '', '', '', '', '', '', '', 'Peaky Blinders', 'HBO', '2022-03-09 11:12:28', '2022-03-09'),
('susujpeg', '', '', '', '', '', '', 'Black Swan', '2009', '', '', '2022-03-09 11:13:06', '2022-03-09'),
('admin', '', '', '', '', 'Royal Assassin', 'Robin Hobb', '', '', 'Game of Thrones', 'HBO', '2022-03-09 11:13:39', '2022-03-09'),
('admin', '', '', 'whole lotta red', 'playboi carti', '', '', '', '', '', '', '2022-03-09 11:14:53', '2022-03-09'),
('admin', 'Elden Ring', 'PC', 'Cavalcade', 'Black Midi', 'Idk Bro', 'Robin Hovv', 'Batmanesnasd And The Titans', '2069', 'WestWorld', 'HBO', '2022-03-09 11:20:30', '2022-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `password`, `date`) VALUES
(1, 2810727, 'HighnessAtharva', 'ATHARVASHAH', '2022-03-07 18:40:03'),
(20, 1432011569896302, 'Robin', 'sherwood', '2022-03-07 19:49:17'),
(22, 85009, 'susujpeg', 'mafia69k', '2022-03-08 11:13:04'),
(23, 4784850399629, 'admin', 'admin', '2022-03-09 05:43:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD UNIQUE KEY `datetime` (`datetime`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name_2` (`user_name`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
