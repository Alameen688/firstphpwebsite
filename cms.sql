-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2014 at 12:22 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `publicationDate` date NOT NULL,
  `categoryId` smallint(5) unsigned NOT NULL,
  `title` varchar(225) character set utf8 NOT NULL,
  `summary` text character set utf8 NOT NULL,
  `content` mediumtext character set utf8 NOT NULL,
  `articleImage` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `publicationDate`, `categoryId`, `title`, `summary`, `content`, `articleImage`) VALUES
(1, '2014-03-09', 1, 'Osteoid medical cast is better than the convenctional Plaster cast(POP) and also enhances healing', 'Designer Deniz Karashin has designed a customizable 3D printed medical cast .Unlike convectional medical cast made of plaster(also known as POP, plaster of paris) the osteoid is easy to build and fully customizeable to the patients needs, it is also lighter in weight and also provides enough ventilation for the broken or fractured limb, the osteoid is designed to allow air flow using the cancellous spongy bone geometry structure', 'To be honest, I know what it is like carrying an heavy plaster molded on a broken or fractured limb, I broke my right arm while I was in High School (Senior Secondary School). I had the doctor mold an heavy plaster on my arm. During the period you don''t get enough ventilation and you even suffer from itching an a bad smell over time due to limited exposure to water and after carrying the bulky plaster for months and getting such experience you go back to the clinic for the doctor to rip the plaster appart, the next feeling you get is a lifeless and shrinked limb ready to be blown off by the slightest wind. Okay, enough of the story telling, thanks to Deniz for designing the new light and durable alternative. When osteoid is combined with Low Intensity Pulsed Ultrasound bone Simulator (LIPUS) sytem, for a single 20 minute session this system promises to reduce the healing process up to 38% and increases the heal rate up to 80% in non-union fractures. However, for this to happen the LIPUS probes has to be placed on the injured area with direct skin contact. By the rule of thumb this system cannot be used with convectional medical casts(POP). The size of the osteoid medical cast solely depends on the case of the patient but the dimension of the model is 130 x 108 x 315mms while the size of the simulator is 130 x 145 x 40mms. Okay, you want to shove around stylishly flaunting your broken or fracture arm in the osteoid, the osteoid is available in variety of colors. ', 'Osteoid medical cast is better than the convenctional Plaster cast(POP) and also enhances healing.jpg'),
(2, '2014-03-13', 2, 'Electric Skateboard Balaboard', 'Electric Skateboard', 'Electric Skateboard', 'Electric Skateboard Balaboard.jpg'),
(3, '2014-03-16', 2, 'Threaded vehicle named Shredder', 'Shredder was', 'Shredder was', 'Threaded vehicle named Shredder.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(225) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Good Thinking', 'List of All Innovations as a result of good thinking'),
(2, 'How to', 'All articles that teach how to do a particular sruff. ');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `commentDate` date NOT NULL,
  `commentBy` varchar(255) NOT NULL,
  `commentContent` text NOT NULL,
  `aId` smallint(5) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `commentDate`, `commentBy`, `commentContent`, `aId`) VALUES
(1, '2014-04-19', 'hellypee', 'nice  one', 1),
(16, '2014-04-20', 'alameen688', 'nice job\r\n', 1),
(17, '2014-04-20', 'alameen688', 'AWESOME TIME', 1),
(18, '2014-04-23', 'Xander J', 'baba na you oooooo\r\n', 1),
(19, '2014-04-25', '6packscrasher', 'awesome article', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_subscribers`
--

DROP TABLE IF EXISTS `email_subscribers`;
CREATE TABLE `email_subscribers` (
  `id` smallint(5) NOT NULL auto_increment,
  `fullName` varchar(100) NOT NULL,
  `emailAddress` varchar(70) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `email_subscribers`
--

INSERT INTO `email_subscribers` (`id`, `fullName`, `emailAddress`) VALUES
(1, 'Ogundiran Al-Ameen', 'ogundiran12@gmail.com'),
(2, 'Ogundiran Adeniyi', 'ogundiran12@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `imageName` varchar(225) NOT NULL,
  `aId` smallint(5) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `images`
--


-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

DROP TABLE IF EXISTS `navigation`;
CREATE TABLE `navigation` (
  `id` int(11) NOT NULL auto_increment,
  `menuName` varchar(30) NOT NULL,
  `position` int(5) NOT NULL,
  `visible` int(1) NOT NULL,
  `heading` varchar(250) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id`, `menuName`, `position`, `visible`, `heading`, `content`) VALUES
(1, 'Home', 1, 1, '', ''),
(2, 'About', 2, 1, 'About the webbuilder , freelancer ', 'After completing secondary school (High School) education in 2013, Ogundiran Al-Ameen (born in 1997, Nigeria) wrote an entry examination (post-utme) to his desired University (College). While he and every other applicant waited for their name to reflect on the university admission list for that year, his webdesign adventure began. His PC was just a windows machine for playing music and watching videos with his brother - but by the time he discovered how to design and program webpages, he defended his cluncky DELL LATITUDE D810 computer against insults from himself and his brother that he now sees his computer as a device that could help him build his dream website (www.weinvent.com), where he now shares with the world his ever existing passion for tech stuffs, inventions, latest electronic gadjets, how things work, how to`s, computer related stuff, and loads of other fun stuffs to know.            '),
(3, 'Contact', 3, 1, 'Contact info', ''),
(4, 'Categories', 4, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `userName` varchar(30) NOT NULL,
  `hashedPassword` varchar(40) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `avatar` varchar(80) NOT NULL default 'avatar.gif',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `hashedPassword`, `emailAddress`, `avatar`) VALUES
(1, 'hellypee', 'fcb112b3c3023917ce449b4be8afa4dea4951e51', 'hellypee.hp@gmail.com', 'hellypee.jpg'),
(10, 'alameen688', '27284bcbea800d1660ad30972f58bcc2aa28aa6a', 'ogundiran2315@gmail.com', 'avatar.gif'),
(11, 'Xander J', '0ecc97af058bcaa66b67bb02611dfc940d067c1b', 'jolawke@gmail.com', 'Xander J.jpg'),
(12, '6packscrasher', '27284bcbea800d1660ad30972f58bcc2aa28aa6a', 'ogundiran2315@gmail.com', '6packscrasher.jpg');
