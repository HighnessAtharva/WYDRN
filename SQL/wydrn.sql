-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 06:55 AM
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
('HighnessAtharva', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-05-24 22:05:35', '2022-05-24'),
('HighnessAtharva', 'ELDEN RING', 'PC', 'UFO', 'BLACK MIDI', 'FOOL\'S ERRAND', 'ROBIN HOBB', 'THE BATMAN ', '2009', 'WESTWORLD', 'HBO', '2022-05-24 22:06:27', '2022-05-24'),
('susujpeg', 'ELDEN RING', 'XBOX ONE', 'AFTER HOURS', 'THE WEEKND', '', '', '', '', 'WESTWORLD', 'BBC', '2022-05-25 17:58:53', '2022-05-25'),
('highnessatharva', '', '', 'AFTER HOURS', 'THE WEEKND', '', '', '', '', '', '', '2022-05-25 17:58:54', '2022-05-25'),
('susujpeg', '', '', 'AFTER HOURS', 'DAYA', '', '', '', '', '', '', '2022-05-26 17:53:22', '2022-05-26'),
('susujpeg', '', '', '', '', 'FOOL\'S ERRAND', 'ROBIN HOBB', 'THE BATMAN ', '1996', 'WATCHMEN', 'HBO', '2022-05-26 17:54:29', '2022-05-26'),
('HighnessAtharva', '', '', '', '', '', '', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '2014', '', '', '2022-05-29 22:44:06', '2022-05-29'),
('HighnessAtharva', '', '', '', '', '', '', '僕のヒーローアカデミア THE MOVIE ヒーローズ：ライジング', '2019', '', '', '2022-05-29 22:44:22', '2022-05-29'),
('HighnessAtharva', '', '', '', '', '', '', '僕のヒーローアカデミア THE MOVIE ヒーローズ：ライジング', '2019', '', '', '2022-05-29 23:09:46', '2022-05-29'),
('HighnessAtharva', '', '', '', '', '', '', '劇場版 NARUTO -ナルト- 疾風伝 ASDA', '2007', '', '', '2022-05-29 23:14:24', '2022-05-29'),
('HighnessAtharva', '', '', '', '', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-05-29 23:42:08', '2022-05-29'),
('HighnessAtharva', 'MARIO BROS.', 'PC', '', '', '', '', '', '', '', '', '2022-05-29 23:55:10', '2022-05-29'),
('HighnessAtharva', 'ZORBIT\'S ORBITS (ITCH)', 'XBOX', '', '', '', '', '', '', '', '', '2022-05-30 00:21:47', '2022-05-30'),
('HighnessAtharva', '', '', '', '', '', '', '劇場版 NARUTO -ナルト- 疾風伝', '2007', '', '', '2022-05-30 00:24:50', '2022-05-30'),
('HighnessAtharva', 'STAR CONTROL: ORIGINS', 'XBOX', '', '', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-05-30 00:26:08', '2022-05-30'),
('HighnessAtharva', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-05-30 00:43:21', '2022-05-30'),
('HighnessAtharva', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-05-30 00:43:34', '2022-05-30'),
('HighnessAtharva', 'MARIO BROS.', 'XBOX', 'CAVALCADE', 'BLACK MIDI', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-05-30 00:44:54', '2022-05-30'),
('HighnessAtharva', 'ELDEN RING', 'XBOX', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', '', '', 'SPIRIT UNTAMED', '2021', '', '', '2022-05-30 00:46:27', '2022-05-30'),
('HighnessAtharva', '', '', '', '', 'MY YEAR OF REST AND RELAXATION', 'OTTESSA MOSHFEGH', '', '', '', '', '2022-05-30 09:45:54', '2022-05-30'),
('HighnessAtharva', 'NARUTO TO BORUTO: SHINOBI STRIKER', 'PC', 'PETALS FOR ARMOR', 'HAYLEY WILLIAMS', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '劇場版 NARUTO -ナルト- 疾風伝', '2007', '', '', '2022-05-30 09:47:08', '2022-05-30'),
('HighnessAtharva', '', '', '', '', '', '', 'THE DICTATOR', '1935', 'STRANGER THINGS', 'NETFLIX', '2022-05-30 09:54:20', '2022-05-30'),
('HighnessAtharva', '', '', '', '', '', '', '', '', 'STRANGER THINGS', 'NETFLIX', '2022-05-30 10:19:31', '2022-05-30'),
('HighnessAtharva', 'FAR CRY 2', 'XBOX', '', '', '', '', '', '', '', '', '2022-05-30 10:28:20', '2022-05-30'),
('HighnessAtharva', 'MARIO BROS. (1983)', 'XBOX', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'AURORA', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', 'SUSPIRIA', '1977', 'THE SUITE LIFE ON DECK', 'AMAZON PRIME', '2022-05-31 13:56:31', '2022-05-31'),
('HighnessAtharva', 'ELDEN RING', 'XBOX', 'AURORA', 'BEA MILLER', 'THE WORLD OF AVATAR', 'JOSHUA IZZO', 'THE AVIATOR', '1929', 'SUITS', 'NETFLIX', '2022-05-31 17:12:23', '2022-05-31'),
('HighnessAtharva', '', '', '', '', '', '', 'TOP GUN', '1986', 'STRANGER THINGS', 'NETFLIX', '2022-05-31 17:13:47', '2022-05-31'),
('HighnessAtharva', '', '', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'BLACK MIDI', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', 'THE SOUND OF MUSIC', '2007', 'SUITS', 'AMAZON PRIME', '2022-05-31 17:14:01', '2022-05-31'),
('HighnessAtharva', '', '', 'BLACK SAILS AT MIDNIGHT', 'ALESTORM', 'FITZ AND THE FOOL: COLORING BOOK', 'ROBIN HOBB', 'IGNORING IT: THE BIG BA$IL STORY', '2017', 'FROG IN A SUIT', 'NETFLIX', '2022-05-31 20:48:34', '2022-05-31'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:17:10', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:17:24', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:17:36', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:17:53', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:18:05', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:22:45', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:24:21', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:27:25', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:27:27', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:30:15', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:30:24', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:30:29', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:30:59', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:31:05', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:31:22', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:31:25', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:31:30', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:31:34', '2022-06-01'),
('susujpeg', 'ZORBIT\'S ORBITS (ITCH)', 'NINTENDO', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', 'THE WORLD OF AVATAR', 'OTTESSA MOSHFEGH', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '1965', 'SUITS', 'HBOMAX', '2022-06-01 21:35:01', '2022-06-01'),
('susujpeg', '', '', '', '', '', '', 'LOVE DON\'T CO$T A THING', '2003', '', '', '2022-06-01 21:56:13', '2022-06-01'),
('HighnessAtharva', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-03 17:03:22', '2022-06-03'),
('HighnessAtharva', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-03 17:06:15', '2022-06-03'),
('HighnessAtharva', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-03 17:08:16', '2022-06-03'),
('HighnessAtharva', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-03 17:09:04', '2022-06-03'),
('HighnessAtharva', 'UGGLLLLYYYYY', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-03 17:09:09', '2022-06-03'),
('HighnessAtharva', '', '', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', '', '', '', '', '', '', '2022-06-05 17:19:01', '2022-06-05'),
('susujpeg', 'ZORBIT\'S ORBITS', 'NINTENDO', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'PINK FLOYD', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '劇場版 NARUTO -ナルト- 疾風伝 ASDA', '2017', 'THE SUITE LIFE ON DECK', 'YOUTUBE', '2022-06-07 16:01:14', '2022-06-07'),
('susujpeg', 'ZORBIT\'S ORBITS', 'NINTENDO', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'PINK FLOYD', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '劇場版 NARUTO -ナルト- 疾風伝 ASDA', '2017', 'THE SUITE LIFE ON DECK', 'YOUTUBE', '2022-06-07 16:01:31', '2022-06-07'),
('susujpeg', 'ZORBIT\'S ORBITS', 'NINTENDO', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'PINK FLOYD', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '劇場版 NARUTO -ナルト- 疾風伝 ASDA', '2017', 'THE SUITE LIFE ON DECK', 'YOUTUBE', '2022-06-07 16:03:21', '2022-06-07'),
('HighnessAtharva', '', '', '', '', '', '', '', '', '', '', '2022-06-07 21:08:58', '2022-06-07'),
('HighnessAtharva', '', '', '', '', '', '', '', '', '', '', '2022-06-07 21:09:00', '2022-06-07'),
('HighnessAtharva', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-07 21:22:44', '2022-06-07'),
('HighnessAtharva', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-07 21:22:48', '2022-06-07'),
('HighnessAtharva', '', '', '', '', '', '', '', '', '', '', '2022-06-07 21:22:50', '2022-06-07'),
('HighnessAtharva', '', '', '', '', '', '', '', '', '', '', '2022-06-07 21:22:51', '2022-06-07'),
('HighnessAtharva', '', '', '', '', '', '', '', '', '', '', '2022-06-07 21:22:52', '2022-06-07');

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
('HighnessAtharva', 'susujpeg', '2022-06-08 10:18:54');

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
(71, 862114561492, 'susujpeg', 'darlingjamiesooo@gmail.com', '$2y$10$v/ZcsYOjV7xaJKJNViD4wOyyY4ntPCPcBPRswBOAUh5y7aZbBZPYS', '2022-06-07 15:07:06', 'images/users/110321yeeeee.JPG', 'images/website/defaultBackground.jpg', 0, 0),
(114, 32726220398725619, 'HighnessAtharva', 'HighnessAtharva@gmail.com', '$2y$10$XUB0HTMRHAZtQk.I7QD4nOhmei2r1FOEbXpVBosXsFzYG1vs71k0e', '2022-06-08 04:48:18', 'images/users/051028Depositphotos_all-passives-2.jpg', 'images/users/wp3192582-the-disastrous-life-of-saiki-k-wallpapers.png', 1, 1),
(115, 48086836447270, 'westerospatriot', 'westerospatriot@gmail.com', '$2y$10$aaYbh11qjZXDZAp6toi84eg8kh.2zYQpvb9YktiuBDZLELcUYF.C6', '2022-04-28 15:51:46', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD UNIQUE KEY `datetime` (`datetime`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
