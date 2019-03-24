-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 24, 2019 at 12:17 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogger`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `blogid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `text` text NOT NULL,
  `createdon` date NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `comments` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(20) NOT NULL DEFAULT 'blog',
  PRIMARY KEY (`blogid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blogid`, `userid`, `title`, `text`, `createdon`, `likes`, `views`, `comments`, `tag`) VALUES
(1, 3, 'My travel blog', 'Aruba, Bonaire, and Curacao are three southern Caribbean islands in the Lesser Antilles, north of Venezuela. How far off the coast of South America are they? 15 miles for Aruba, 50 miles for Bonaire, and 40 miles for Curacao. That said, they differ greatly from Venezuela because of their history and governmental structure. \r\n\r\nEach of the ABC islands is part of the Kingdom of the Netherlands (though they are not in the European Union, themselves). Bonaire is a special municipality of the Netherlands, while Aruba and Curacao are autonomous. Culturally, all three islands are a mix of Dutch, Caribbean, and South American influences. Yum!\r\n\r\nImportant note: All three ABC Islands lie outside of Hurricane Alley, meaning they are protected from the storms that have devastated much of the Caribbean. This is a huge benefit for their economies, as well as travel planning. Let\'s examine each island.', '2019-03-16', 16, 0, 3, 'travel');

-- --------------------------------------------------------

--
-- Table structure for table `bloguser`
--

DROP TABLE IF EXISTS `bloguser`;
CREATE TABLE IF NOT EXISTS `bloguser` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `blogcount` int(11) NOT NULL DEFAULT '0',
  `authorbio` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bloguser`
--

INSERT INTO `bloguser` (`user_id`, `title`, `blogcount`, `authorbio`) VALUES
(3, 'Travel talks', 1, 'I\'m a traveler and a photographer. Follow me to get interesting updates on new places.'),
(4, 'How I became a coder', 0, 'I am the coder u r looking for. I post tutorials on all languages.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `time` time NOT NULL,
  `blogid` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `userid`, `comment`, `time`, `blogid`, `date`) VALUES
(1, 3, 'Great', '02:00:00', 1, '2013-03-19'),
(4, 4, 'Awesome blog bro! Keep going', '22:38:13', 1, '2019-03-23'),
(5, 7, 'Good one!', '14:02:21', 1, '2019-03-24'),
(6, 5, 'Good one!', '14:03:26', 1, '2019-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `blogid` int(11) NOT NULL,
  `tag` varchar(30) NOT NULL,
  KEY `tags_ibfk_1` (`blogid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `pwd` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `pwd`, `email`) VALUES
(3, 'Shyam_ganesh', 'mayhs', 'shyamganesh1999@gmail.com'),
(4, 'Cruzon', '123', 'praneethcruzon@gmail.com'),
(5, 'Lone_wolf', '123', 'lonewolf229@gmail.com'),
(6, 'Bharath', 'mbk', 'mbk@gmail.com'),
(7, 'Swathi', '123', 'swa@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bloguser`
--
ALTER TABLE `bloguser`
  ADD CONSTRAINT `useridcheck` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`blogid`) REFERENCES `blog` (`blogid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
