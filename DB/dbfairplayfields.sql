-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 04, 2024 at 03:36 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbfairplayfields`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each event player',
  `user_id` int(32) NOT NULL COMMENT 'References the user participating in the event',
  `match_id` int(32) NOT NULL COMMENT 'References the match associated with the event',
  `primary_position` varchar(2) NOT NULL COMMENT 'Primary position of the player (e.g., GK, DF, MF, AT)',
  `secondary_position` varchar(2) NOT NULL COMMENT 'Secondary position of the player (e.g., GK, DF, MF, AT)',
  `personal_rating` decimal(3,2) DEFAULT NULL,
  `admin_rating` decimal(3,2) DEFAULT NULL,
  `team_number` varchar(5) NOT NULL COMMENT 'Team assignment (e.g., Team A, Team B)',
  `scored_goals` int(2) DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  UNIQUE KEY `uid` (`user_id`,`match_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `user_id`, `match_id`, `primary_position`, `secondary_position`, `personal_rating`, `admin_rating`, `team_number`, `scored_goals`) VALUES
(1, 6, 3, '', '', NULL, '2.00', '40', 4);

-- --------------------------------------------------------

--
-- Table structure for table `match`
--

DROP TABLE IF EXISTS `match`;
CREATE TABLE IF NOT EXISTS `match` (
  `match_id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each match',
  `user_id` int(32) NOT NULL COMMENT 'References the user associated with the match',
  `match_location_id` int(32) NOT NULL COMMENT 'References the location where the match is held',
  `match_name` varchar(100) NOT NULL COMMENT 'Name or description of the match',
  `match_date` date NOT NULL COMMENT 'Date on which the match is scheduled',
  `start_time` time NOT NULL COMMENT 'Starting time of the match',
  `end_time` time NOT NULL COMMENT 'Ending time of the match',
  `min_players` int(2) NOT NULL COMMENT 'Minimum number of players required',
  `max_players` int(2) NOT NULL COMMENT 'Maximum number of players allowed',
  `match_status` varchar(10) NOT NULL COMMENT 'Current status of the match (e.g., Active, Cancelled)',
  `player_list` varchar(500) NOT NULL DEFAULT '',
  `team_a_players` varchar(500) NOT NULL DEFAULT '',
  `team_b_players` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`match_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `match`
--

INSERT INTO `match` (`match_id`, `user_id`, `match_location_id`, `match_name`, `match_date`, `start_time`, `end_time`, `min_players`, `max_players`, `match_status`, `player_list`, `team_a_players`, `team_b_players`) VALUES
(1, 8, 1, 'match 1 on the Beatch', '2024-02-03', '17:32:00', '18:32:00', 12, 14, 'Active', ',Ali,Hassan,u1', '', ''),
(2, 8, 2, 'Al-shmal Smal playground', '2024-02-08', '16:00:00', '18:00:00', 12, 14, 'Active', ',u1', '', ''),
(3, 7, 2, 'Match 2 Majees Beatch', '2024-02-23', '16:00:00', '17:00:00', 8, 10, 'Active', ',u1', '', ''),
(4, 6, 1, 'M10', '2024-02-15', '13:19:00', '14:21:00', 4, 12, 'Active', 'Yousuf,Hassan,Ali,u1,Ammmad,Salim,Qais,Khalid,Abdulah,Fahad,Mohamad,Hmaid,', 'Ammmad,Yousuf,Ali,Hmaid,Hassan,Abdulah,', 'Khalid,u1,Qais,Fahad,Salim,Mohamad'),
(5, 6, 1, 'M2', '2024-02-22', '09:05:00', '11:05:00', 4, 4, 'Active', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `match_location`
--

DROP TABLE IF EXISTS `match_location`;
CREATE TABLE IF NOT EXISTS `match_location` (
  `match_location_id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each match location',
  `venue_name` varchar(100) NOT NULL COMMENT 'Name of the venue where the match will take place',
  `venue_address` varchar(100) NOT NULL COMMENT 'Complete physical address of the venue',
  `facilities_description` varchar(255) NOT NULL COMMENT 'Description of facilities available on-site',
  `owner_name` varchar(100) NOT NULL COMMENT 'Name of the owner or person in charge',
  `owner_phone` varchar(8) NOT NULL COMMENT 'Contact number of the owner',
  PRIMARY KEY (`match_location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `match_location`
--

INSERT INTO `match_location` (`match_location_id`, `venue_name`, `venue_address`, `facilities_description`, `owner_name`, `owner_phone`) VALUES
(1, 'loc1', 'add1', 'Boall, Goals', 'Mohammed', '95400611'),
(2, 'Loc_2', 'Sohar/Teraf', 'Massjed/Swiming pool', 'ALi-Alajmi', '99008877');

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

DROP TABLE IF EXISTS `performance`;
CREATE TABLE IF NOT EXISTS `performance` (
  `performance_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `primary_position` varchar(255) NOT NULL,
  `secondary_position` varchar(255) NOT NULL,
  `personal_rating` decimal(5,2) NOT NULL,
  PRIMARY KEY (`performance_id`),
  KEY `user_id` (`user_id`),
  KEY `game_match_id` (`match_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `player_info`
--

DROP TABLE IF EXISTS `player_info`;
CREATE TABLE IF NOT EXISTS `player_info` (
  `player_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `primary_position` varchar(50) NOT NULL,
  `secondary_position` varchar(50) NOT NULL,
  `personal_rating` int(11) NOT NULL,
  PRIMARY KEY (`player_info_id`),
  KEY `user_id` (`user_id`),
  KEY `match_id` (`match_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'UserID (PK)',
  `user_name` varchar(100) NOT NULL COMMENT 'Name of the user',
  `user_email` varchar(100) NOT NULL COMMENT 'User''s email address',
  `user_phone` varchar(8) NOT NULL COMMENT 'User''s phone number',
  `user_password` varchar(60) NOT NULL COMMENT 'User''s password',
  `user_birth_date` date NOT NULL COMMENT 'User''s date of birth',
  `user_address` varchar(100) NOT NULL COMMENT 'User''s physical address',
  `user_type` varchar(8) NOT NULL COMMENT 'Type of user (Player, Admin)',
  `user_picture` varchar(255) NOT NULL COMMENT 'Link or path to user''s picture',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_password`, `user_birth_date`, `user_address`, `user_type`, `user_picture`) VALUES
(6, 'Ali', 'ali@gmail.com', '91234567', '111', '2020-01-07', 'Shinas', 'Player', '.img/default_picture.jpg'),
(7, 'Hassan', 'hassan@gmauil.com', '91234567', '123', '2024-02-08', 'sss', 'admin', '.img/default_picture.jpg'),
(8, 'u1', 'u1@gmail.com', '98765432', 'qwe', '2024-02-01', '', 'admin', '.img/default_picture.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
