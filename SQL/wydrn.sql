-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 06:45 PM
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
('HighnessAtharva', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-16 15:10:49', '2022-06-16'),
('HighnessAtharva', '', '', 'AFTER HOURS', 'THE WEEKND', '', '', '', '', '', '', '2022-06-16 15:10:50', '2022-06-16'),
('HighnessAtharva', '', '', '', '', '', '', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '2014', '', '', '2022-06-16 15:10:51', '2022-06-16'),
('HighnessAtharva', '', '', '', '', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-06-16 15:10:55', '2022-06-16'),
('HighnessAtharva', 'MARIO BROS.', 'PC', '', '', '', '', '', '', '', '', '2022-06-16 15:10:56', '2022-06-16'),
('HighnessAtharva', 'STAR CONTROL: ORIGINS', 'XBOX', '', '', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-06-16 15:10:58', '2022-06-16'),
('HighnessAtharva', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-06-16 15:10:59', '2022-06-16'),
('HighnessAtharva', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-06-16 15:11:00', '2022-06-16'),
('HighnessAtharva', 'MARIO BROS.', 'XBOX', 'CAVALCADE', 'BLACK MIDI', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-06-16 15:11:01', '2022-06-16'),
('HighnessAtharva', 'ELDEN RING', 'XBOX', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', '', '', 'SPIRIT UNTAMED', '2021', '', '', '2022-06-16 15:11:02', '2022-06-16'),
('HighnessAtharva', '', '', '', '', 'MY YEAR OF REST AND RELAXATION', 'OTTESSA MOSHFEGH', '', '', '', '', '2022-06-16 15:11:03', '2022-06-16'),
('HighnessAtharva', '', '', '', '', '', '', 'THE DICTATOR', '1935', 'STRANGER THINGS', 'NETFLIX', '2022-06-16 15:11:05', '2022-06-16'),
('HighnessAtharva', '', '', '', '', '', '', '', '', 'STRANGER THINGS', 'NETFLIX', '2022-06-16 15:11:06', '2022-06-16'),
('HighnessAtharva', 'FAR CRY 2', 'XBOX', '', '', '', '', '', '', '', '', '2022-06-16 15:11:07', '2022-06-16'),
('HighnessAtharva', 'MARIO BROS. (1983)', 'XBOX', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'AURORA', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', 'SUSPIRIA', '1977', 'THE SUITE LIFE ON DECK', 'AMAZON PRIME', '2022-06-16 15:11:08', '2022-06-16'),
('HighnessAtharva', 'ELDEN RING', 'XBOX', 'AURORA', 'BEA MILLER', 'THE WORLD OF AVATAR', 'JOSHUA IZZO', 'THE AVIATOR', '1929', 'SUITS', 'NETFLIX', '2022-06-16 15:11:09', '2022-06-16'),
('HighnessAtharva', '', '', '', '', '', '', 'TOP GUN', '1986', 'STRANGER THINGS', 'NETFLIX', '2022-06-16 15:11:10', '2022-06-16'),
('HighnessAtharva', '', '', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'BLACK MIDI', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', 'THE SOUND OF MUSIC', '2007', 'SUITS', 'AMAZON PRIME', '2022-06-16 15:11:12', '2022-06-16'),
('HighnessAtharva', '', '', 'BLACK SAILS AT MIDNIGHT', 'ALESTORM', 'FITZ AND THE FOOL: COLORING BOOK', 'ROBIN HOBB', 'IGNORING IT: THE BIG BA$IL STORY', '2017', 'FROG IN A SUIT', 'NETFLIX', '2022-06-16 15:11:13', '2022-06-16'),
('HighnessAtharva', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-16 15:11:14', '2022-06-16'),
('HighnessAtharva', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-16 15:11:15', '2022-06-16'),
('HighnessAtharva', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-16 15:11:16', '2022-06-16'),
('HighnessAtharva', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-16 15:11:17', '2022-06-16'),
('HighnessAtharva', '', '', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', '', '', '', '', '', '', '2022-06-16 15:11:19', '2022-06-16'),
('HighnessAtharva', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-16 15:11:20', '2022-06-16'),
('HighnessAtharva', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-16 15:11:21', '2022-06-16'),
('HighnessAtharva', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-16 15:12:10', '2022-06-16'),
('susujpeg', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-16 15:12:43', '2022-06-16'),
('susujpeg', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-16 15:12:49', '2022-06-16'),
('HighnessAtharva', '', '', '', '', '', '', 'SCARFACE', '1983', '', '', '2022-06-19 16:31:28', '2022-06-19'),
('HighnessAtharva', '', '', '', '', '', '', 'VIVRE SA VIE: FILM EN DOUZE TABLEAUX', '1962', '', '', '2022-06-19 20:55:00', '2022-06-19'),
('HighnessAtharva', '', '', '', '', '', '', 'TRICK \'R TREAT', '2007', '', '', '2022-06-19 20:55:10', '2022-06-19'),
('HighnessAtharva', '', '', 'UNPEELED', 'CAGE THE ELEPHANT', '', '', 'THE PINK PANTHER', '1963', 'SOLAR OPPOSITES', 'HULU', '2022-06-20 18:57:15', '2022-06-20'),
('HighnessAtharva', '', '', '', '', '', '', 'PINK FLAMINGOS', '1972', '', '', '2022-06-20 18:57:27', '2022-06-20'),
('HighnessAtharva', '', '', '', '', '', '', '', '', '', '', '2022-06-20 19:30:39', '2022-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `follower_username` varchar(255) NOT NULL,
  `followed_username` varchar(255) NOT NULL,
  `followed_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`follower_username`, `followed_username`, `followed_time`) VALUES
('susujpeg', 'rt', '2022-03-24 11:41:58'),
('susujpeg', 'highnessatharva', '2022-05-26 18:05:58'),
('HighnessAtharva', 'rt', '2022-06-07 15:53:36'),
('HighnessAtharva', 'jamesjoyce', '2022-06-08 16:19:10'),
('westerospatriot', 'HighnessAtharva', '2022-06-10 14:02:06'),
('HighnessAtharva', 'westerospatriot', '2022-06-10 14:02:18'),
('westerospatriot', 'susujpeg', '2022-06-10 14:03:13'),
('susujpeg', 'westerospatriot', '2022-06-10 14:03:38'),
('HighnessAtharva', 'susujpeg', '2022-06-16 15:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_pic` varchar(255) DEFAULT 'images/website/defaultPFP.png',
  `background_pic` varchar(255) DEFAULT 'images/website/defaultBackground.jpg',
  `active` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `email`, `password`, `date`, `profile_pic`, `background_pic`, `active`, `verified`) VALUES
(61, 9223372036854775807, 'rt', 'rt@james.com', '$2y$10$IA5Z9y0A0lnJ6QnhrqBT1.TCNGHQkwPOmtXywHpf/Ecsl5ncesSLC', '2022-03-19 14:09:00', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(62, 100333, 'pppppppppppp', 'pppppppp@gmail.com', '$2y$10$rYdZUmCkuoAX3399dqiFAesbg.ycr2CjCqenKCmZcoQ5SOkNe5Y92', '2022-03-19 14:49:34', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(66, 86554043705, 'jamesjoyce', 'wydrnwebapp@gmail.com', '$2y$10$e9jU7bIvrgVLFWBOdNXLrubWwSKwbNz/fmI9inelUN5ChWW47Ujuq', '2022-03-19 14:59:20', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(67, 192511, 'wydrnbae', 'wydrnapp@gmail.com', '$2y$10$sZow5C2lbfA5fgovkj21LueQUhc379J76g4NQGSPcBfdbxGzfgLvC', '2022-03-19 15:00:28', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(71, 862114561492, 'susujpeg', 'darlingjamiesooo@gmail.com', '$2y$10$v/ZcsYOjV7xaJKJNViD4wOyyY4ntPCPcBPRswBOAUh5y7aZbBZPYS', '2022-06-21 16:44:03', 'images/users/110321yeeeee.JPG', 'images/website/defaultBackground.jpg', 0, 0),
(114, 32726220398725619, 'HighnessAtharva', 'HighnessAtharva@gmail.com', '$2y$10$KwdkO.XcvCjTDDrz3vmGcOUGRIITDP3AAawkgXLIs0mMgPmYY4Vgu', '2022-06-21 16:44:05', 'images/users/105632download.jpg', 'images/users/gradient-blue-pink-abstract-art-wallpaper-preview.jpg', 1, 1),
(117, 207808057, 'westerospatriot', 'westerospatriot@gmail.com', '$2y$10$nANrrN5Mkhf8ialK1X7edOltt4aQTvIUoK1cE0y06RpBykX7owZoS', '2022-06-15 18:45:40', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD UNIQUE KEY `datetime` (`datetime`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`follower_username`,`followed_username`),
  ADD UNIQUE KEY `followed_time` (`followed_time`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name_2` (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
