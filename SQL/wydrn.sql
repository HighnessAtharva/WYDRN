-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2022 at 11:16 AM
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
('HighnessAtharva', '', '', 'EMOTION', 'CARLY RAE JEPSEN', '', '', '', '', '', '', '2022-06-23 14:03:46', '2022-06-23'),
('HighnessAtharva', '', '', '', '', 'THE ART OF WAR', 'SUN TZU', '', '', '', '', '2022-06-23 14:27:52', '2022-06-23'),
('HighnessAtharva', 'MIDDLE-EARTH: SHADOW OF WAR', 'PC', '', '', '', '', '', '', '', '', '2022-06-23 16:16:43', '2022-06-23'),
('HighnessAtharva', 'MIDDLE-EARTH: SHADOW OF MORDOR', 'PC', '', '', '', '', '', '', '', '', '2022-06-23 16:16:55', '2022-06-23'),
('HighnessAtharva', '', '', '', '', '', '', '', '', '', '', '2022-06-23 20:18:49', '2022-06-23'),
('HighnessAtharva', 'ELDEN RING', 'NINTENDO', 'PETALS FOR ARMOR', 'HAYLEY WILLIAMS', 'SKULDUGGERY PLEASANT', 'DEREK LANDY', '', '', '', '', '2022-06-24 21:27:36', '2022-06-24'),
('weebshooter', '', '', '', '', 'DRAGON BALL Z, VOL. 12', 'AKIRA TORIYAMA', 'RAYA AND THE LAST DRAGON', '2021', '', '', '2022-06-25 13:31:58', '2022-06-25'),
('weebshooter', '', '', 'MOTOMAMI', 'ROSALÍA', 'THE WORLD OF THE BOOK', 'DES COWLEY,CLARE WILLIAMSON', 'FANTASTIC BEASTS: THE SECRETS OF DUMBLEDORE', '2022', 'MR. MERCEDES', 'AMAZON PRIME', '2022-06-25 13:33:54', '2022-06-25'),
('susujpeg', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 18:40:09', '2022-06-26'),
('susujpeg', '', '', 'AFTER HOURS', 'THE WEEKND', '', '', '', '', '', '', '2022-06-26 18:40:10', '2022-06-26'),
('susujpeg', '', '', '', '', '', '', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '2014', '', '', '2022-06-26 18:40:11', '2022-06-26'),
('susujpeg', '', '', '', '', '', '', '??????????? THE MOVIE ?????:?????', '2019', '', '', '2022-06-26 18:40:12', '2022-06-26'),
('susujpeg', '', '', '', '', '', '', '??????????? THE MOVIE ?????:?????', '2019', '', '', '2022-06-26 18:40:13', '2022-06-26'),
('susujpeg', '', '', '', '', '', '', '??? NARUTO -???- ??? ASDA', '2007', '', '', '2022-06-26 18:40:14', '2022-06-26'),
('susujpeg', '', '', '', '', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-06-26 18:40:15', '2022-06-26'),
('susujpeg', 'MARIO BROS.', 'PC', '', '', '', '', '', '', '', '', '2022-06-26 18:40:16', '2022-06-26'),
('susujpeg', '', '', '', '', '', '', '??? NARUTO -???- ???', '2007', '', '', '2022-06-26 18:40:17', '2022-06-26'),
('susujpeg', 'STAR CONTROL: ORIGINS', 'XBOX', '', '', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-06-26 18:40:18', '2022-06-26'),
('susujpeg', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-06-26 18:40:19', '2022-06-26'),
('susujpeg', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-06-26 18:40:20', '2022-06-26'),
('susujpeg', 'MARIO BROS.', 'XBOX', 'CAVALCADE', 'BLACK MIDI', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-06-26 18:40:21', '2022-06-26'),
('susujpeg', 'ELDEN RING', 'XBOX', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', '', '', 'SPIRIT UNTAMED', '2021', '', '', '2022-06-26 18:40:22', '2022-06-26'),
('susujpeg', '', '', '', '', 'MY YEAR OF REST AND RELAXATION', 'OTTESSA MOSHFEGH', '', '', '', '', '2022-06-26 18:40:23', '2022-06-26'),
('susujpeg', 'NARUTO TO BORUTO: SHINOBI STRIKER', 'PC', 'PETALS FOR ARMOR', 'HAYLEY WILLIAMS', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '??? NARUTO -???- ???', '2007', '', '', '2022-06-26 18:40:24', '2022-06-26'),
('susujpeg', '', '', '', '', '', '', 'THE DICTATOR', '1935', 'STRANGER THINGS', 'NETFLIX', '2022-06-26 18:40:26', '2022-06-26'),
('susujpeg', '', '', '', '', '', '', '', '', 'STRANGER THINGS', 'NETFLIX', '2022-06-26 18:40:27', '2022-06-26'),
('susujpeg', 'FAR CRY 2', 'XBOX', '', '', '', '', '', '', '', '', '2022-06-26 18:40:28', '2022-06-26'),
('susujpeg', 'MARIO BROS. (1983)', 'XBOX', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'AURORA', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', 'SUSPIRIA', '1977', 'THE SUITE LIFE ON DECK', 'AMAZON PRIME', '2022-06-26 18:40:29', '2022-06-26'),
('susujpeg', 'ELDEN RING', 'XBOX', 'AURORA', 'BEA MILLER', 'THE WORLD OF AVATAR', 'JOSHUA IZZO', 'THE AVIATOR', '1929', 'SUITS', 'NETFLIX', '2022-06-26 18:40:30', '2022-06-26'),
('susujpeg', '', '', '', '', '', '', 'TOP GUN', '1986', 'STRANGER THINGS', 'NETFLIX', '2022-06-26 18:40:31', '2022-06-26'),
('susujpeg', '', '', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'BLACK MIDI', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', 'THE SOUND OF MUSIC', '2007', 'SUITS', 'AMAZON PRIME', '2022-06-26 18:40:32', '2022-06-26'),
('susujpeg', '', '', 'BLACK SAILS AT MIDNIGHT', 'ALESTORM', 'FITZ AND THE FOOL: COLORING BOOK', 'ROBIN HOBB', 'IGNORING IT: THE BIG BA$IL STORY', '2017', 'FROG IN A SUIT', 'NETFLIX', '2022-06-26 18:40:33', '2022-06-26'),
('susujpeg', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 18:40:34', '2022-06-26'),
('susujpeg', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 18:40:35', '2022-06-26'),
('susujpeg', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 18:40:36', '2022-06-26'),
('susujpeg', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 18:40:37', '2022-06-26'),
('susujpeg', 'UGGLLLLYYYYY', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 18:40:38', '2022-06-26'),
('susujpeg', '', '', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', '', '', '', '', '', '', '2022-06-26 18:40:39', '2022-06-26'),
('susujpeg', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-26 18:40:40', '2022-06-26'),
('susujpeg', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-26 18:40:41', '2022-06-26'),
('susujpeg', '', '', '', '', '', '', '', '', '', '', '2022-06-26 18:41:11', '2022-06-26'),
('susujpeg', '', '', 'CIRCLES', 'MAC MILLER', '', '', 'SKY SHARKS', '2020', '', '', '2022-06-26 18:41:50', '2022-06-26'),
('anay', '', '', 'PURPLE MOUNTAINS', 'PURPLE MOUNTAINS', 'THE WORLD OF AVATAR', 'JOSHUA IZZO', '', '', '', '', '2022-06-26 19:11:14', '2022-06-26'),
('anay', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 19:25:17', '2022-06-26'),
('anay', '', '', 'AFTER HOURS', 'THE WEEKND', '', '', '', '', '', '', '2022-06-26 19:25:18', '2022-06-26'),
('anay', '', '', '', '', '', '', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '2014', '', '', '2022-06-26 19:25:19', '2022-06-26'),
('anay', '', '', '', '', '', '', '??????????? THE MOVIE ?????:?????', '2019', '', '', '2022-06-26 19:25:20', '2022-06-26'),
('anay', '', '', '', '', '', '', '??????????? THE MOVIE ?????:?????', '2019', '', '', '2022-06-26 19:25:21', '2022-06-26'),
('anay', '', '', '', '', '', '', '??? NARUTO -???- ??? ASDA', '2007', '', '', '2022-06-26 19:25:22', '2022-06-26'),
('anay', '', '', '', '', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-06-26 19:25:23', '2022-06-26'),
('anay', 'MARIO BROS.', 'PC', '', '', '', '', '', '', '', '', '2022-06-26 19:25:24', '2022-06-26'),
('anay', '', '', '', '', '', '', '??? NARUTO -???- ???', '2007', '', '', '2022-06-26 19:25:25', '2022-06-26'),
('anay', 'STAR CONTROL: ORIGINS', 'XBOX', '', '', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-06-26 19:25:26', '2022-06-26'),
('anay', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-06-26 19:25:27', '2022-06-26'),
('anay', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-06-26 19:25:28', '2022-06-26'),
('anay', 'MARIO BROS.', 'XBOX', 'CAVALCADE', 'BLACK MIDI', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-06-26 19:25:29', '2022-06-26'),
('anay', 'ELDEN RING', 'XBOX', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', '', '', 'SPIRIT UNTAMED', '2021', '', '', '2022-06-26 19:25:30', '2022-06-26'),
('anay', '', '', '', '', 'MY YEAR OF REST AND RELAXATION', 'OTTESSA MOSHFEGH', '', '', '', '', '2022-06-26 19:25:31', '2022-06-26'),
('anay', 'NARUTO TO BORUTO: SHINOBI STRIKER', 'PC', 'PETALS FOR ARMOR', 'HAYLEY WILLIAMS', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '??? NARUTO -???- ???', '2007', '', '', '2022-06-26 19:25:32', '2022-06-26'),
('anay', '', '', '', '', '', '', 'THE DICTATOR', '1935', 'STRANGER THINGS', 'NETFLIX', '2022-06-26 19:25:33', '2022-06-26'),
('anay', '', '', '', '', '', '', '', '', 'STRANGER THINGS', 'NETFLIX', '2022-06-26 19:25:34', '2022-06-26'),
('anay', 'FAR CRY 2', 'XBOX', '', '', '', '', '', '', '', '', '2022-06-26 19:25:35', '2022-06-26'),
('anay', 'MARIO BROS. (1983)', 'XBOX', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'AURORA', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', 'SUSPIRIA', '1977', 'THE SUITE LIFE ON DECK', 'AMAZON PRIME', '2022-06-26 19:25:36', '2022-06-26'),
('anay', 'ELDEN RING', 'XBOX', 'AURORA', 'BEA MILLER', 'THE WORLD OF AVATAR', 'JOSHUA IZZO', 'THE AVIATOR', '1929', 'SUITS', 'NETFLIX', '2022-06-26 19:25:37', '2022-06-26'),
('anay', '', '', '', '', '', '', 'TOP GUN', '1986', 'STRANGER THINGS', 'NETFLIX', '2022-06-26 19:25:38', '2022-06-26'),
('anay', '', '', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'BLACK MIDI', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', 'THE SOUND OF MUSIC', '2007', 'SUITS', 'AMAZON PRIME', '2022-06-26 19:25:39', '2022-06-26'),
('anay', '', '', 'BLACK SAILS AT MIDNIGHT', 'ALESTORM', 'FITZ AND THE FOOL: COLORING BOOK', 'ROBIN HOBB', 'IGNORING IT: THE BIG BA$IL STORY', '2017', 'FROG IN A SUIT', 'NETFLIX', '2022-06-26 19:25:40', '2022-06-26'),
('anay', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 19:25:41', '2022-06-26'),
('anay', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 19:25:42', '2022-06-26'),
('anay', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 19:25:43', '2022-06-26'),
('anay', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 19:25:44', '2022-06-26'),
('anay', 'UGGLLLLYYYYY', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-06-26 19:25:45', '2022-06-26'),
('anay', '', '', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', '', '', '', '', '', '', '2022-06-26 19:25:46', '2022-06-26'),
('anay', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-26 19:25:47', '2022-06-26'),
('anay', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-06-26 19:25:48', '2022-06-26'),
('anay', '', '', '', '', '', '', '', '', '', '', '2022-06-26 19:40:33', '2022-06-26'),
('musicbot', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-07-22 11:30:18', '2022-07-22'),
('musicbot', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', 'AFTER HOURS', 'THE WEEKND', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', '', '', 'THE LAST: NARUTO THE MOVIE ASHDKAJSDHJASHD', '2014', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', '', '', '??????????? THE MOVIE ?????:?????', '2019', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', '', '', '??????????? THE MOVIE ?????:?????', '2019', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', '', '', '??? NARUTO -???- ??? ASDA', '2007', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'MARIO BROS.', 'PC', '', '', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', '', '', '??? NARUTO -???- ???', '2007', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'STAR CONTROL: ORIGINS', 'XBOX', '', '', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', 'CAVALCADE', 'BLACK MIDI', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'MARIO BROS.', 'XBOX', 'CAVALCADE', 'BLACK MIDI', '', '', 'THE SOUND OF MUSIC', '1965', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'ELDEN RING', 'XBOX', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', '', '', 'SPIRIT UNTAMED', '2021', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', 'MY YEAR OF REST AND RELAXATION', 'OTTESSA MOSHFEGH', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'NARUTO TO BORUTO: SHINOBI STRIKER', 'PC', 'PETALS FOR ARMOR', 'HAYLEY WILLIAMS', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '??? NARUTO -???- ???', '2007', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', '', '', 'THE DICTATOR', '1935', 'STRANGER THINGS', 'NETFLIX', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', '', '', '', '', 'STRANGER THINGS', 'NETFLIX', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'FAR CRY 2', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'MARIO BROS. (1983)', 'XBOX', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'AURORA', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', 'SUSPIRIA', '1977', 'THE SUITE LIFE ON DECK', 'AMAZON PRIME', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'ELDEN RING', 'XBOX', 'AURORA', 'BEA MILLER', 'THE WORLD OF AVATAR', 'JOSHUA IZZO', 'THE AVIATOR', '1929', 'SUITS', 'NETFLIX', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', '', '', 'TOP GUN', '1986', 'STRANGER THINGS', 'NETFLIX', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', 'ALL MY DEMONS GREETING ME AS A FRIEND (DELUXE)', 'BLACK MIDI', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', 'THE SOUND OF MUSIC', '2007', 'SUITS', 'AMAZON PRIME', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', 'BLACK SAILS AT MIDNIGHT', 'ALESTORM', 'FITZ AND THE FOOL: COLORING BOOK', 'ROBIN HOBB', 'IGNORING IT: THE BIG BA$IL STORY', '2017', 'FROG IN A SUIT', 'NETFLIX', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'SERIOUS SAM 4', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'UGGLLLLYYYYY', 'XBOX ONE', '', '', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', 'THE DARK SIDE OF THE MOON', 'PINK FLOYD', '', '', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', '', '', 'MIGRAINE JOURNAL', 'ROGUE PLUS PUBLISHING', '', '', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', '', '', 'CIRCLES', 'MAC MILLER', '', '', 'SKY SHARKS', '2020', '', '', '2022-07-22 11:35:47', '2022-07-22'),
('musicbot', 'BORDERLANDS', 'NINTENDO', 'AM', 'ARCTIC MONKEYS', '1984', 'GEORGE ORWELL', 'MANDY', '2018', 'THE MANDALORIAN', 'YOUTUBE', '2022-07-22 11:37:31', '2022-07-22'),
('dev', '', '', 'OK COMPUTER (COLLECTOR\'S EDITION)', 'RADIOHEAD', '', '', '', '', '', '', '2022-07-23 21:31:09', '2022-07-23');

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
('HighnessAtharva', 'susujpeg', '2022-06-23 19:56:35'),
('anay', 'HighnessAtharva', '2022-06-26 19:16:28'),
('dev', 'HighnessAtharva', '2022-07-23 21:36:00'),
('HighnessAtharva', 'musicbot', '2022-07-26 20:29:51');

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
(71, 862114561492, 'susujpeg', 'darlingjamiesooo@gmail.com', '$2y$10$v/ZcsYOjV7xaJKJNViD4wOyyY4ntPCPcBPRswBOAUh5y7aZbBZPYS', '2022-07-26 13:24:39', 'images/users/110321yeeeee.JPG', 'images/website/defaultBackground.jpg', 0, 0),
(114, 32726220398725619, 'HighnessAtharva', 'HighnessAtharva@gmail.com', '$2y$10$N20olViAKiwwJQDVbIBiXumiwjwUzXBuhrc9GGwri5j3ZH/uO5QPG', '2022-07-27 09:14:52', 'images/users/042722500x500-000000-80-0-0(3).jpg', 'images/users/023743ezgif-5-95f925855a.gif', 1, 1),
(119, 74383560500, 'weebshooter', 'abcdefg@gmail.com', '$2y$10$k.Av6PfUY3W2U3VVqWix6.Pnl20agyynHFpigOtz/O5kjRUFgcLSy', '2022-06-26 13:07:31', 'images/users/095843atharva.png', 'images/website/defaultBackground.jpg', 0, 0),
(120, 43960315659, 'musicbot', 'mycloudbackupmusic@gmail.com', '$2y$10$743rMLwA7DoSe.SoMkt1/OHx7CLKyY.8kaZDAsJBTb71c/yE1V.fa', '2022-07-23 10:10:36', 'images/users/031519tmp_1608820741507.jpg', 'images/users/a0127997326_10.jpg', 1, 1),
(121, 36627543520, 'anay', 'anaydesh1234@gmail.com', '$2y$10$R0cvJsbAK8w9AuqsUWuC8ONh0J9x/wWOzfPubwHkBxClv/KDGYz2a', '2022-06-26 14:11:20', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 1),
(122, 5784303861, 'dev', 'dummymail2069@gmail.com', '$2y$10$V/cOlDorenUUcbJyn8p0qO1NO4hE019f/f7LF0hvufhahCaWszZMK', '2022-07-25 12:37:21', 'images/users/022641maskable@19233.png', 'images/users/022641final2.gif', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
