-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Skapad: 25 mars 2013 kl 20:20
-- Serverversion: 5.5.27
-- PHP-version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `gavleug`
--
CREATE DATABASE `gavleug` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gavleug`;

-- --------------------------------------------------------

--
-- Tabellstruktur `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumpning av Data i tabell `chat`
--

INSERT INTO `chat` (`message_id`, `user_id`, `message`, `timestamp`) VALUES
(1, 1, 'Toppen Grabbar !', 1364165750),
(2, 2, 'Tackar så skärtligt !', 1364165750),
(3, 1, 'This is a test message!', 1364172766),
(4, 1, 'This is a test message!', 1364173190),
(5, 1, 'This is a test message!', 1364173242),
(6, 1, 'This is a test message!', 1364173357),
(7, 1, 'sda', 1364177116),
(8, 1, ':)', 1364177118),
(9, 2, 'h&ouml;h&ouml;', 1364177193),
(10, 2, 'what', 1364177199),
(11, 2, 'ss', 1364177204),
(12, 2, 'asdsa', 1364177209),
(13, 2, 'hej', 1364177296),
(14, 2, 'p&aring; dej', 1364177307),
(15, 1, 'dfdf\nSsd', 1364177511),
(16, 1, '&lt;script&gt;alert(1);&lt;/script', 1364177548),
(17, 1, 'hej', 1364177673),
(18, 1, 'gullet', 1364177681),
(19, 1, 'gullet', 1364177697),
(20, 0, '&lt;script&gt;alert(1);&lt;/script', 1364233309),
(21, 1, '&lt;script&gt;alert(1);&lt;/script', 1364233321);

-- --------------------------------------------------------

--
-- Tabellstruktur `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `evdate` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumpning av Data i tabell `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `evdate`) VALUES
(8, 'Zlatan', 'V&auml;rldens b&auml;sta fotbollsspelare', '3/25/2013'),
(9, 'Tjo', 'Vad h&auml;nder?', '03/26/2013'),
(10, 'Musik p&aring; koserthuset', 'Kl 19:00 p&aring; Konserthuset i G&auml;vle s&aring; spelar Kenta Gustafsson', '3/26/2013'),
(11, 'Hello World', 'TROLOROLL LOREM IPSUM', '3/25/2013');

-- --------------------------------------------------------

--
-- Tabellstruktur `guestbook`
--

DROP TABLE IF EXISTS `guestbook`;
CREATE TABLE IF NOT EXISTS `guestbook` (
  `gb_id` int(11) NOT NULL AUTO_INCREMENT,
  `gb_text` varchar(255) NOT NULL,
  `gb_namn` varchar(30) NOT NULL,
  `gb_email` varchar(255) NOT NULL,
  `gb_date` int(11) NOT NULL,
  PRIMARY KEY (`gb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumpning av Data i tabell `guestbook`
--

INSERT INTO `guestbook` (`gb_id`, `gb_text`, `gb_namn`, `gb_email`, `gb_date`) VALUES
(16, 'sadsad', 'sdasd', 'asdasd', 1363824040),
(17, 'ZLATAN', 'Robin', 'Robin_larsson646@hotmail.com', 1364091568),
(18, 'HELLO WORLD', 'Zlatan', 'asdad@hotmail.com', 1364091590);

-- --------------------------------------------------------

--
-- Tabellstruktur `newsfeed`
--

DROP TABLE IF EXISTS `newsfeed`;
CREATE TABLE IF NOT EXISTS `newsfeed` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_text` text NOT NULL,
  `news_date` int(11) NOT NULL,
  `news_namn` varchar(30) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumpning av Data i tabell `newsfeed`
--

INSERT INTO `newsfeed` (`news_id`, `news_text`, `news_date`, `news_namn`) VALUES
(8, 'Best football player in the world did it again!', 1364094801, 'Zlatan'),
(9, 'Akta er, v&auml;rlden g&aring;r under snart! Eller inte.', 1364094949, 'V&auml;rlden g&aring;r under'),
(10, 'The Samsung Galaxy S4 will soon be released. This phone will own everyone!', 1364095008, 'Galaxy S4');

-- --------------------------------------------------------

--
-- Tabellstruktur `tips`
--

DROP TABLE IF EXISTS `tips`;
CREATE TABLE IF NOT EXISTS `tips` (
  `TIPS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIPS_NAME` varchar(32) NOT NULL,
  `TIPS_TEXT` text NOT NULL,
  `TIPS_DATE` date NOT NULL,
  `TIPS_EMAIL` varchar(50) NOT NULL,
  PRIMARY KEY (`TIPS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_fname` varchar(32) NOT NULL,
  `user_ename` varchar(32) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_fname`, `user_ename`, `user_email`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'ADMIN', 'ADMIN', 'ADMIN@ADMINA.COM'),
(2, 'mrfohlin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Johan', 'Fohlin', 'Mr.Fohlin@hotmail.com'),
(3, 'robin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Robin', 'Larsson', 'robin_larsson646@hotmail.com'),
(4, 'zlatan', '5f4dcc3b5aa765d61d8327deb882cf99', 'Zlatan', 'Ibrahimovic', 'Zlatan@psg.fr'),
(6, 'Ibracadabra', '5f4dcc3b5aa765d61d8327deb882cf99', 'Robin123', '', 'dasdsadasd@hotmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
