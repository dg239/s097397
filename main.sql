-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 22 okt 2013 om 23:41
-- Serverversie: 5.6.12-log
-- PHP-versie: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `s000000`
--
CREATE DATABASE IF NOT EXISTS `s000000` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `s000000`;
--
-- Databank: `s0918273`
--
CREATE DATABASE IF NOT EXISTS `s0918273` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `s0918273`;
--
-- Databank: `s097397`
--
CREATE DATABASE IF NOT EXISTS `s097397` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `s097397`;
--
-- Databank: `s098767`
--
CREATE DATABASE IF NOT EXISTS `s098767` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `s098767`;
--
-- Databank: `s1111111`
--
CREATE DATABASE IF NOT EXISTS `s1111111` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `s1111111`;
--
-- Databank: `s8106123`
--
CREATE DATABASE IF NOT EXISTS `s8106123` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `s8106123`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `day2_author`
--

CREATE TABLE IF NOT EXISTS `day2_author` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `mail` varchar(32) DEFAULT NULL,
  `bio` varchar(1024) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ipaddress` varchar(64) NOT NULL COMMENT 'IPV6 = 39 in length',
  `mailconfirmed` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `day2_author`
--

INSERT INTO `day2_author` (`id`, `name`, `mail`, `bio`, `regdate`, `ipaddress`, `mailconfirmed`) VALUES
(1, 'Thijs ter Velde', 'mail@thijstervelde.com', 'Thijs ter Velde is a student of Industrial Design.', '2013-09-30 09:25:06', '131.155.238.75', b'1'),
(2, 'Stephen King', 'x360x_stephen_the_king@hotmail.c', 'Stephen King is a famous writer.', '2013-09-30 09:25:53', '131.155.238.75', b'1'),
(3, 'Fanboy771', 'thijsiee.tv@gmail.com', 'Fanboy771 is a generic fanboy!', '2013-09-30 09:36:19', '131.155.238.75', b'1'),
(4, 'Unauthorized Poster', 'dodgy_site@malware.com', 'Unauthorized poster is known for posting unauthorized things.', '2013-09-30 13:40:07', '131.155.239.152', NULL),
(5, 'asd', 'thijs@thijs.com', 'asdas', '2013-10-02 14:39:38', '131.155.239.235', NULL),
(6, 'Final test', 'user@testing.com', 'The final test after implementing the user in a new enviroment.', '2013-10-13 00:31:02', '127.0.0.1', NULL),
(7, 'Thijs ter velde', 'thijsiee.tv@gmail.com', 'test\r\n', '2013-10-13 00:33:58', '127.0.0.1', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `day2_comment`
--

CREATE TABLE IF NOT EXISTS `day2_comment` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `comment` varchar(1024) NOT NULL,
  `author` int(8) NOT NULL,
  `postid` int(8) NOT NULL,
  `ipaddress` varchar(64) NOT NULL,
  `datewritten` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `day2_comment`
--

INSERT INTO `day2_comment` (`id`, `comment`, `author`, `postid`, `ipaddress`, `datewritten`) VALUES
(1, 'Lal Design sux', 2, 1, '131155', '2013-09-30 09:38:48'),
(2, 'Stephen King is awesome! He is right, for he is awesome!', 3, 1, '131155', '2013-09-30 09:39:12'),
(3, 'Design is so cool. Stephen King, you suck.', 1, 1, '131155', '2013-09-30 09:40:40'),
(4, 'ILL FUCKING KILL YOU AND YOUR WIFE AND YOUR DOG OMGWTF', 3, 1, '131155', '2013-09-30 09:41:05'),
(5, 'Like if you cried every time!', 3, 2, '131155', '2013-09-30 09:42:30'),
(6, 'Another master piece, amazing!!', 3, 3, '131155', '2013-09-30 09:42:42'),
(7, 'He is alright, I guess', 1, 4, '131155', '2013-09-30 09:43:24'),
(8, 'Yeah, I am awesome. Hey Thijs, suck my left one.', 2, 4, '131155', '2013-09-30 09:43:36'),
(9, 'YOUR DEAD', 3, 1, '131155', '2013-09-30 10:24:38');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `day2_post`
--

CREATE TABLE IF NOT EXISTS `day2_post` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `text` varchar(1024) NOT NULL,
  `author` int(8) NOT NULL,
  `ipaddress` varchar(64) NOT NULL,
  `datewritten` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Gegevens worden uitgevoerd voor tabel `day2_post`
--

INSERT INTO `day2_post` (`id`, `title`, `text`, `author`, `ipaddress`, `datewritten`) VALUES
(1, 'Design is cool', 'Anyone that doesn''t like Design can not understand the world.', 1, '131.155.238.75', '2013-09-30 09:38:30'),
(2, 'The Rabbit', 'In a land far, far away there was a rabbit called Rabbit...\r\n\r\nThe end.', 2, '131.155.238.75', '2013-09-30 09:41:35'),
(3, 'The Monkey', 'In a land far, far away there was a monkey called Monkey...\r\n\r\nThe end.', 2, '131.155.238.75', '2013-09-30 09:42:05'),
(4, 'Stephen K is the best', 'He is the best', 3, '131.155.238.75', '2013-09-30 09:43:14'),
(5, 'PHP zuigt', 'PHP is kut', 1, '131.155.239.235', '2013-10-02 14:08:29'),
(6, 'test', 'test', 2, '127.0.0.1', '2013-10-13 00:25:37');
--
-- Databank: `thijste_dg239`
--
CREATE DATABASE IF NOT EXISTS `thijste_dg239` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `thijste_dg239`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `fileID` int(16) NOT NULL AUTO_INCREMENT,
  `snumber` varchar(8) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_extension` varchar(32) NOT NULL,
  `modify_time` int(11) NOT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `subfolder` varchar(255) NOT NULL,
  `version` int(4) DEFAULT NULL,
  `githubID` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`fileID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `temp_reg`
--

CREATE TABLE IF NOT EXISTS `temp_reg` (
  `entry` int(8) NOT NULL AUTO_INCREMENT,
  `snumber` varchar(32) NOT NULL,
  `unhashed_password` varchar(32) NOT NULL COMMENT 'bad practice, but needed until I can find a more elegant way',
  PRIMARY KEY (`entry`),
  KEY `username` (`snumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `temp_reg`
--

INSERT INTO `temp_reg` (`entry`, `snumber`, `unhashed_password`) VALUES
(4, 's0912312', '123123'),
(5, 's0191919', '123123'),
(6, 's8106123', '123123'),
(7, 's1111111', '123123'),
(8, 's097397', '123123'),
(9, 's000000', 'abcdefg'),
(10, 's0918273', '123123');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `snumber` varchar(8) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `email_code` varchar(32) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timelastseen` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ipaddress` varchar(46) NOT NULL,
  `active` int(11) DEFAULT '0',
  `type` int(1) DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `first_name`, `last_name`, `snumber`, `email`, `email_code`, `regdate`, `timelastseen`, `ipaddress`, `active`, `type`) VALUES
(1, 'BlogDay2', '4297f44b13955235245b2497399d7a93', 'Blog', 'Day2', 's8106123', 'bear@thijstervelde.com', '1c27c119f080711da598ad6301fba9a0', '2013-10-20 22:05:22', '0000-00-00 00:00:00', '127.0.0.1', 1, 0),
(2, 'FamilyDay1', '4297f44b13955235245b2497399d7a93', 'Family', 'Insert', 's1111111', 'mail@thijstervelde.com', '289926403c96cf281493eb99a1712a55', '2013-10-20 22:17:01', '0000-00-00 00:00:00', '127.0.0.1', 1, 0),
(3, 'thijsiee', '4297f44b13955235245b2497399d7a93', 'Thijs', 'ter Velde', 's097397', 'thijsiee.tv@gmail.com', 'a4a351f8ac8aa5f7d22f66640570e016', '2013-10-20 22:32:33', '2013-10-22 23:14:10', '127.0.0.1', 1, 0),
(4, 'test1', '7ac66c0f148de9519b8bd264312c4d64', 'Justa', 'Test', 's000000', 'test@test.com', '1ee23746de6b8b78a74c44b65fff61ba', '2013-10-20 22:50:29', '2013-10-20 22:50:41', '127.0.0.1', 1, 0),
(5, 'Filecontroltest', '4297f44b13955235245b2497399d7a93', '123123', '123123', 's0918273', '123123@123123.com', 'b5ef73981b3d7ce30efcb82ba8dadb97', '2013-10-21 14:39:28', '0000-00-00 00:00:00', '127.0.0.1', 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users_login`
--

CREATE TABLE IF NOT EXISTS `users_login` (
  `entry` int(16) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `ipaddress` varchar(46) NOT NULL,
  `login_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `success` int(1) NOT NULL DEFAULT '0',
  `locked` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`entry`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Gegevens worden uitgevoerd voor tabel `users_login`
--

INSERT INTO `users_login` (`entry`, `username`, `ipaddress`, `login_timestamp`, `success`, `locked`) VALUES
(1, 'asd', '127.0.0.1', '2013-10-18 21:04:05', 0, 0),
(2, 'asd', '127.0.0.1', '2013-10-18 21:04:06', 0, 0),
(3, 'asd', '127.0.0.1', '2013-10-18 21:04:08', 0, 0),
(4, 'asd', '127.0.0.1', '2013-10-18 21:04:09', 0, 0),
(5, 'asd', '127.0.0.1', '2013-10-18 21:04:10', 0, 0),
(6, '', '127.0.0.1', '2013-10-18 21:04:10', 1, 1),
(7, '', '127.0.0.1', '2013-10-19 14:05:06', 1, 1),
(8, 'thijsiee', '127.0.0.1', '2013-10-19 16:59:42', 1, 0),
(9, 'test1', '127.0.0.1', '2013-10-20 22:50:38', 1, 0),
(10, 'thijsiee', '127.0.0.1', '2013-10-20 23:04:50', 0, 0),
(11, 'thijsiee', '127.0.0.1', '2013-10-20 23:04:50', 0, 0),
(12, 'thijsiee', '127.0.0.1', '2013-10-20 23:04:57', 1, 0),
(13, 'thijsiee', '127.0.0.1', '2013-10-22 18:30:03', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
