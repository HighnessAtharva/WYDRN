-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2022 at 08:58 AM
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
('dev', '', '', 'OK COMPUTER (COLLECTOR\'S EDITION)', 'RADIOHEAD', '', '', '', '', '', '', '2022-07-23 21:31:09', '2022-07-23'),
('HighnessAtharva', '', '', 'WHOLE LOTTA RED', 'PLAYBOI CARTI', '', '', 'EMPEROR OF THE NORTH', '1973', '', '', '2022-07-28 02:22:44', '2022-07-28'),
('HighnessAtharva', '', '', '', '', '', '', '', '', '', '', '2022-07-28 02:22:51', '2022-07-28'),
('HighnessAtharva', '', '', '', '', 'EMPIRE OF THE VAMPIRE', 'JAY KRISTOFF', '', '', '', '', '2022-07-28 10:43:07', '2022-07-28'),
('anay', '', '', '', '', 'EMPIRE OF THE VAMPIRE', 'JAY KRISTOFF', '', '', '', '', '2022-07-28 10:43:29', '2022-07-28'),
('HighnessAtharva', 'BORDER', 'PLAYSTATION', 'APHEX TWINS', 'APHEX TWIN', 'COMPUTATIONAL THINKING: A PERSPECTIVE ON COMPUTER SCIENCE', 'ZHIWEI XU,JIALIN ZHANG', 'THE MUMMY: TOMB OF THE DRAGON EMPEROR', '2008', '', '', '2022-07-28 20:09:48', '2022-07-28'),
('HighnessAtharva', 'FAR CRY 2', 'NINTENDO', 'ZABA', 'GLASS ANIMALS', 'CITROëN DS', 'LANCE COLE', 'S IS FOR STANLEY', '2016', 'THE GRIM ADVENTURES OF BILLY AND MANDY', 'AMAZON PRIME', '2022-07-28 20:11:25', '2022-07-28'),
('dev', '', '', '', '', '', '', 'THE INVITATION', '2015', '', '', '2022-07-29 00:56:33', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Imagine Me & You', '2005', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Dating Amber', '2020', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Hannah Gadsby: Nanette', '2018', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Just Friends', '2005', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Spider-Man', '2002', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Spider-Man: No Way Home', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'The Conversation', '1974', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Ek Main Aur Ekk Tu', '2012', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Kaanekkaane', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Haywire', '2011', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'The Worst Person in the World', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'The Novice', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Spider-Man 2', '2004', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Minnal Murali', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Aankhen', '2002', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Hacksaw Ridge', '2016', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Atrangi Re', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'The Lost Daughter', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Uncle Frank', '2020', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Professor Marston and the Wonder Women', '2017', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'A Simple Favor', '2018', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Virus', '2019', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Can You Keep a Secret?', '2019', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Drinking Buddies', '2013', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'About a Boy', '2002', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'The Tender Bar', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'The Fallout', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Binisutoy', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Elle', '2016', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Love, Rosie', '2014', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Long Shot', '2019', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Moonlit Winter', '2019', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Law Abiding Citizen', '2009', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Forgetting Sarah Marshall', '2008', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Sleepless in Seattle', '1993', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Dark Waters', '2019', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Badhaai Do', '2022', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Fresh', '2022', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'The Accountant', '2016', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'The Batman', '2022', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Nightmare Alley', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Don 2', '2011', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'The Secret in Their Eyes', '2009', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'K.G.F: Chapter 1', '2018', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Beast', '2022', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Liberal Arts', '2012', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'K.G.F: Chapter 2', '2022', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Everything Everywhere All at Once', '2022', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Ratatouille', '2007', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'RRR', '2022', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Mission: Impossible III', '2006', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Vikram', '2022', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Kaithi', '2019', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Mirage', '2018', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Jana Gana Mana', '2022', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Pleasure', '2021', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', '', '', 'Cha Cha Real Smooth', '2022', '', '', '2022-07-29 11:29:31', '2022-07-29'),
('spammer', '', '', '', '', 'Fundamentals of Wavelets', 'Goswami, Jaideva', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Data Smart', 'Foreman, John', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'God Created the Integers', 'Hawking, Stephen', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Superfreakonomics', 'Dubner, Stephen', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Orientalism', 'Said, Edward', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Nature of Statistical Learning Theory, The', 'Vapnik, Vladimir', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Integration of the Indian States', 'Menon, V P', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Image Processing & Mathematical Morphology', 'Shih, Frank', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'How to Think Like Sherlock Holmes', 'Konnikova, Maria', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Data Scientists at Work', 'Sebastian Gutierrez', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Slaughterhouse Five', 'Vonnegut, Kurt', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Birth of a Theorem', 'Villani, Cedric', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Structure & Interpretation of Computer Programs', 'Sussman, Gerald', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Age of Wrath, The', 'Eraly, Abraham', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Trial, The', 'Kafka, Frank', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Data Mining Handbook', 'Nisbet, Robert', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'New Machiavelli, The', 'Wells, H. G.', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Physics & Philosophy', 'Heisenberg, Werner', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Making Software', 'Oram, Andy', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Analysis, Vol I', 'Tao, Terence', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Machine Learning for Hackers', 'Conway, Drew', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Signal and the Noise, The', 'Silver, Nate', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Python for Data Analysis', 'McKinney, Wes', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Introduction to Algorithms', 'Cormen, Thomas', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Beautiful and the Damned, The', 'Deb, Siddhartha', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Outsider, The', 'Camus, Albert', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Complete Sherlock Holmes, The - Vol I', 'Doyle, Arthur Conan', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Complete Sherlock Holmes, The - Vol II', 'Doyle, Arthur Conan', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Wealth of Nations, The', 'Smith, Adam', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Pillars of the Earth, The', 'Follett, Ken', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Mein Kampf', 'Hitler, Adolf', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Tao of Physics, The', 'Capra, Fritjof', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Farewell to Arms, A', 'Hemingway, Ernest', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Veteran, The', 'Forsyth, Frederick', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'False Impressions', 'Archer, Jeffery', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Last Lecture, The', 'Pausch, Randy', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Return of the Primitive', 'Rand, Ayn', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Jurassic Park', 'Crichton, Michael', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Russian Journal, A', 'Steinbeck, John', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Tales of Mystery and Imagination', 'Poe, Edgar Allen', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Freakonomics', 'Dubner, Stephen', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Hidden Connections, The', 'Capra, Fritjof', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Story of Philosophy, The', 'Durant, Will', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Asami Asami', 'Deshpande, P L', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Journal of a Novel', 'Steinbeck, John', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Once There Was a War', 'Steinbeck, John', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Moon is Down, The', 'Steinbeck, John', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Brethren, The', 'Grisham, John', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'In a Free State', 'Naipaul, V. S.', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Catch 22', 'Heller, Joseph', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Complete Mastermind, The', 'BBC', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Dylan on Dylan', 'Dylan, Bob', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Soft Computing & Intelligent Systems', 'Gupta, Madan', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Textbook of Economic Theory', 'Stonier, Alfred', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Econometric Analysis', 'Greene, W. H.', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', '', '', 'Learning OpenCV', 'Bradsky, Gary', '', '', '', '', '2022-07-29 11:43:06', '2022-07-29'),
('spammer', '', '', 'Pet Sounds', 'The Beach Boys', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Revolver', 'The Beatles', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Highway 61 Revisited', 'Bob Dylan', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Rubber Soul', 'The Beatles', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Exile on Main St.', 'The Rolling Stones', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'London Calling', 'The Clash', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Blonde on Blonde', 'Bob Dylan', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Beatles (\"The White Album\")', 'The Beatles', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Sun Sessions', 'Elvis Presley', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Kind of Blue', 'Miles Davis', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Velvet Underground & Nico', 'The Velvet Underground', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Abbey Road', 'The Beatles', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Are You Experienced', 'The Jimi Hendrix Experience', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Blood on the Tracks', 'Bob Dylan', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Nevermind', 'Nirvana', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Born to Run', 'Bruce Springsteen', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Astral Weeks', 'Van Morrison', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Thriller', 'Michael Jackson', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Great Twenty_Eight', 'Chuck Berry', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Complete Recordings', 'Robert Johnson', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'John Lennon/Plastic Ono Band', 'John Lennon / Plastic Ono Band', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Innervisions', 'Stevie Wonder', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Live at the Apollo, 1962', 'James Brown', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Rumours', 'Fleetwood Mac', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Joshua Tree', 'U2', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Led Zeppelin', 'Led Zeppelin', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Blue', 'Joni Mitchell', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Bringing It All Back Home', 'Bob Dylan', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Let It Bleed', 'The Rolling Stones', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Ramones', 'Ramones', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Music From Big Pink', 'The Band', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Rise and Fall of Ziggy Stardust and the Spiders From Mars', 'David Bowie', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Tapestry', 'Carole King', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Hotel California', 'Eagles', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Anthology', 'Muddy Waters', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Please Please Me', 'The Beatles', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Forever Changes', 'Love', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Doors', 'The Doors', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Dark Side of the Moon', 'Pink Floyd', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Horses', 'Patti Smith', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Band (\"The Brown Album\")', 'The Band', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Legend: The Best of Bob Marley and The Wailers', 'Bob Marley & The Wailers', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'A Love Supreme', 'John Coltrane', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'It Takes a Nation of Millions to Hold Us Back', 'Public Enemy', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'At Fillmore East', 'The Allman Brothers Band', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Bridge Over Troubled Water', 'Simon & Garfunkel', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Greatest Hits', 'Al Green', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Meet The Beatles!', 'The Beatles', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'The Birth of Soul', 'Ray Charles', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Electric Ladyland', 'The Jimi Hendrix Experience', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Elvis Presley', 'Elvis Presley', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Songs in the Key of Life', 'Stevie Wonder', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Beggars Banquet', 'The Rolling Stones', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', 'Chronicle: The 20 Greatest Hits', 'Creedence Clearwater Revival', '', '', '', '', '', '', '2022-07-29 11:53:05', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'The Halloween Candy Magic Pet', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'The Next Thing You Eat', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Queens', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'The Bachelorette', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'The Real Queens of Hip-Hop: The Women Who Changed the Game', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Wakefield', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Home Sweet Home', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Showtime Championship Boxing: Wilder vs. Molina', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Beyond Oak Island', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Beyond Scared Straight', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Hoarders', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Little Women: Atlanta', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Marrying Millions', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Nightwatch', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Seven Year Switch', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Swamp People', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Unsolved', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Acapulco Shore', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Catfish M?xico', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Dani Who?', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'La Culpa es de Cort?s', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'The Real Housewives of Orange County', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Why Not Us', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Dopesick', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Champaign, Ill', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Buried', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Demon Slayer Kimetsu No Yaiba', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Roots Less Traveled', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Shark Tank', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'General Hospital', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'ABC News Live Prime with Linsey Davis', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', '', '', '', '', '', '', '', '', 'Castle', 'Hulu', '2022-07-29 12:10:42', '2022-07-29'),
('spammer', 'Scooby-Doo! Unmasked', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Viewtiful Joe: Double Trouble!', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'The Legend of Heroes: A Tear of Vermillion', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'PQ: Practical Intelligence Quotient', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Lost in Blue', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Ghost in the Shell: Stand Alone Complex', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Dig Dug: Digging Strike', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Frogger: Helmet Chaos', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Mega Man Battle Network 5: Double Team DS', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Nanostray', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Sega Casino', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Teenage Mutant Ninja Turtles 3: Mutant Nightmare', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Pac-Man World 3', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Tokobot', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Fullmetal Alchemist: Dual Sympathy', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Exit', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Bubble Bobble Revolution', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'The Rub Rabbits!', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Electroplankton', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'LifeSigns: Surgical Unit', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Space Invaders Revolution', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Wii Play', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'New Super Mario Bros.', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Pokmon Diamond', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Pokmon Pearl', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Gears of War', 'XBOX', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'The Legend of Zelda: Twilight Princess', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Cooking Mama', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Marvel Ultimate Alliance', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Daxter', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'The Elder Scrolls IV: Oblivion', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Madden NFL 07', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Grand Theft Auto: Vice City Stories', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Resistance: Fall of Man', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'MotorStorm', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Call of Duty 3', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Fight Night Round 3', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Pokmon Ranger', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Rayman Raving Rabbids', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Saints Row', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Dead Rising', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Call of Duty 3', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Lost Planet: Extreme Condition', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Mario Hoops 3 on 3', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'LEGO Star Wars II: The Original Trilogy', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Super Monkey Ball: Banana Blitz', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'The Sims 2: Pets', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Need for Speed: Carbon - Own the City', 'PC', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'WarioWare: Smooth Moves', 'PS5', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Fight Night Round 3', 'PS5', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Final Fantasy III', 'PS5', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'SOCOM: U.S. Navy SEALs - Fireteam Bravo 2', 'PS5', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Madden NFL 07', 'PS5', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Monster 4x4: World Circuit', 'PS5', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29');
INSERT INTO `data` (`username`, `videogame`, `platform`, `album`, `artist`, `book`, `author`, `movie`, `year`, `tv`, `streaming`, `datetime`, `date`) VALUES
('spammer', 'Kirby: Squeak Squad', 'PS5', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29'),
('spammer', 'Pokmon Battle Revolution', 'PS5', '', '', '', '', '', '', '', '', '2022-07-29 12:18:26', '2022-07-29');

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
('susujpeg', 'highnessatharva', '2022-05-26 18:05:58'),
('HighnessAtharva', 'susujpeg', '2022-06-23 19:56:35'),
('dev', 'HighnessAtharva', '2022-07-23 21:36:00'),
('HighnessAtharva', 'musicbot', '2022-07-26 20:29:51'),
('HighnessAtharva', 'dev', '2022-07-27 17:27:40'),
('anay', 'musicbot', '2022-07-28 11:18:46'),
('anay', 'HighnessAtharva', '2022-07-28 23:43:39');

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
  `date` date NOT NULL,
  `profile_pic` varchar(255) DEFAULT 'images/website/defaultPFP.png',
  `background_pic` varchar(255) DEFAULT 'images/website/defaultBackground.jpg',
  `active` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `email`, `password`, `date`, `profile_pic`, `background_pic`, `active`, `verified`) VALUES
(67, 192511, 'wydrnbae', 'wydrnapp@gmail.com', '$2y$10$sZow5C2lbfA5fgovkj21LueQUhc379J76g4NQGSPcBfdbxGzfgLvC', '2022-03-19', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 0, 0),
(71, 862114561492, 'susujpeg', 'darlingjamiesooo@gmail.com', '$2y$10$v/ZcsYOjV7xaJKJNViD4wOyyY4ntPCPcBPRswBOAUh5y7aZbBZPYS', '2022-07-29', 'images/users/110321yeeeee.JPG', 'images/website/defaultBackground.jpg', 0, 0),
(114, 32726220398725619, 'HighnessAtharva', 'HighnessAtharva@gmail.com', '$2y$10$N20olViAKiwwJQDVbIBiXumiwjwUzXBuhrc9GGwri5j3ZH/uO5QPG', '2022-07-29', 'images/users/042722500x500-000000-80-0-0(3).jpg', 'images/users/023743ezgif-5-95f925855a.gif', 0, 1),
(119, 74383560500, 'weebshooter', 'abcdefg@gmail.com', '$2y$10$k.Av6PfUY3W2U3VVqWix6.Pnl20agyynHFpigOtz/O5kjRUFgcLSy', '2022-07-27', 'images/users/095843atharva.png', 'images/website/defaultBackground.jpg', 0, 0),
(120, 43960315659, 'musicbot', 'mycloudbackupmusic@gmail.com', '$2y$10$743rMLwA7DoSe.SoMkt1/OHx7CLKyY.8kaZDAsJBTb71c/yE1V.fa', '2022-07-29', 'images/users/031519tmp_1608820741507.jpg', 'images/users/a0127997326_10.jpg', 0, 1),
(121, 36627543520, 'anay', 'anaydesh1234@gmail.com', '$2y$10$R0cvJsbAK8w9AuqsUWuC8ONh0J9x/wWOzfPubwHkBxClv/KDGYz2a', '2022-07-29', 'images/users/070231maskable@19233.png', 'images/users/064726rotarylogo.png', 0, 1),
(122, 5784303861, 'dev', 'dummymail2069@gmail.com', '$2y$10$V/cOlDorenUUcbJyn8p0qO1NO4hE019f/f7LF0hvufhahCaWszZMK', '2022-07-29', 'images/users/070935pexelsabstract992.jpg', 'images/users/070935hm.JPG', 0, 0),
(129, 144524083361, 'spammer', 'westerospatriot@gmail.com', '$2y$10$p5ecXxjAnN154CxEHkvIzO5r3QVY8NxpEc/J2Ec/WE7/N9WOc2MMu', '2022-07-29', 'images/website/defaultPFP.png', 'images/website/defaultBackground.jpg', 1, 0);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
