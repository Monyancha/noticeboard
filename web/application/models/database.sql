-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 28, 2015 at 02:24 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `usiuboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `uuid` varchar(512) NOT NULL,
  `phone` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `uuid`, `phone`) VALUES
  (6, 'APA91bEVpQGsgPjf5TgAhOi1b2eLPQZhGx2-dVkApFbWnLOthQBBvtZYGGahQ4_tDw0bB5x1Zhc2kuy1XyIUZwm-d2BtjAmWKwWNTZVPt5PHc_0HyLRPm31Q93VGc2r3aRK_v_tG5gOzfIfagWkglPlXWpMUc3F21w', '+254731034588');

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

DROP TABLE IF EXISTS `feeds`;
CREATE TABLE `feeds` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `url` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`id`, `title`, `description`, `url`, `date`, `slug`) VALUES
  (1, 'Alerts', 'Notice board alerts', 'http://usiu.aksalj.me/cms/index.php/notice-board/alerts?format=feed&type=rss', '0000-00-00 00:00:00', 'alerts'),
  (9, 'Sign Up Sheets', 'Notice board sign up sheets', 'http://usiu.aksalj.me/cms/index.php/notice-board/sing-up-sheets?format=feed&type=rss', '0000-00-00 00:00:00', 'sign-up-sheets'),
  (10, 'Timetables', 'Notice timetables and schedules', 'http://usiu.aksalj.me/cms/index.php/notice-board/timetables?format=feed&type=rss', '0000-00-00 00:00:00', 'timetables'),
  (11, 'Announcements', 'Notice board announcements', 'http://usiu.aksalj.me/cms/index.php/notice-board/announcements?format=feed&type=rss', '0000-00-00 00:00:00', 'announcements'),
  (12, 'Adverts', 'Notice board adverts', 'http://usiu.aksalj.me/cms/index.php/notice-board/adverts?format=feed&type=rss', '0000-00-00 00:00:00', 'adverts'),
  (21, 'Some Nice Internal Feed', 'Some Nice Internal Feed', 'http://board.usiu.local/feed/some-nice-internal-feed', '2015-02-27 17:32:00', 'some-nice-internal-feed');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `feed` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `link` text NOT NULL,
  `image` text NOT NULL,
  `content` text NOT NULL,
  `author` varchar(256) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notified` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `feed`, `title`, `description`, `link`, `image`, `content`, `author`, `date`, `notified`) VALUES
  (1, 1, 'PRSK Recognizes USIU-Africa Student as Young Communicator of the Year', 'Samuel Waitathu Kariuki, a senior majoring in Journalism with a concentration in Public Relations at USIU-Africa’s School of Science and Technology, was recognized as the Young Communicator of the Year at the 2014 Public Relations Society of Kenya (PRSK) Awards for Excellence. The gala event was held at the Safari Park Hotel in Nairobi on December 5, 2014.', 'http://www.usiu.ac.ke/index/on-campus/news/prsk-recognizes-usiu-africa-student-as-young-communicator-of-the-year', 'http://www.usiu.ac.ke/index/images/News/Sam-Kariuki-2.jpg', '<p>\r\n                                    This year, the awards received fifty nine entries and following adjudication by a panel of judges, thirteen winners were drawn from academia, private and public organizations. <br /><br />Samuel’s entry was inspired by a class project that required him to integrate Marketing and Communications tactics for the success of his campaign whose goal was to encourage the youth to apply for loans from the Uwezo Fund. His campaign dubbed YOLO (You Only Live One) encouraged the youth to follow their dreams and in so doing, view entrepreneurship as a viable option. This in turn would create the need for funding for their enterprises, encouraging the youth to approach the Uwezo fund for loans. <br /><br />The approach of the campaign was to use print, electronic and digital platforms to promote the key messages. With the increased popularity of digital platforms amongst the youth, Sam integrated the use of a hashtag in his campaign #iStarted for easier adoption of his message.<br /><br />Kariuki is excited at the possibilities that lie ahead of him. One of his career goals is to help the region understand the key role Public Relations plays in the economy as he believes that the profession is often misunderstood. “Countries and Organizations at large must understand that the right messages communicated at the right time through the right channels can spur an economy in the right direction,” explains Samuel.<br /><br />The faculty at the School of Science and Technology were given special recognition by Samuel for their special support in preparing him for his submission to the 2014 PRSK Awards and for their efforts in helping bridge the gap between the Journalism program course work and the real work environment.<br /><br />This is the fourth time a USIU-Africa student has scooped the award with Amanda Gicharu having been recognized twice consecutively in 2005 and 2006 and Wanjiku Wainaina having been recognized in 2009. <br /><br />The Digital Media Boot Camp that USIU-Africa partnered with Globetrack International in July 2014 was also awarded the New Media PR Campaign of the Year.<br />\r\n                                </p>', 'Zakaria Davis', '2015-02-27 16:28:56', 1),
  (2, 12, 'PRSK Recognizes USIU-Africa Student as Young Communicator of the Year', 'Samuel Waitathu Kariuki, a senior majoring in Journalism with a concentration in Public Relations at USIU-Africa’s School of Science and Technology, was recognized as the Young Communicator of the Year at the 2014 Public Relations Society of Kenya (PRSK) Awards for Excellence. The gala event was held at the Safari Park Hotel in Nairobi on December 5, 2014.', 'http://www.usiu.ac.ke/index/on-campus/news/prsk-recognizes-usiu-africa-student-as-young-communicator-of-the-year', 'http://www.usiu.ac.ke/index/images/News/Sam-Kariuki-2.jpg', '<p>\r\n                                    This year, the awards received fifty nine entries and following adjudication by a panel of judges, thirteen winners were drawn from academia, private and public organizations. <br /><br />Samuel’s entry was inspired by a class project that required him to integrate Marketing and Communications tactics for the success of his campaign whose goal was to encourage the youth to apply for loans from the Uwezo Fund. His campaign dubbed YOLO (You Only Live One) encouraged the youth to follow their dreams and in so doing, view entrepreneurship as a viable option. This in turn would create the need for funding for their enterprises, encouraging the youth to approach the Uwezo fund for loans. <br /><br />The approach of the campaign was to use print, electronic and digital platforms to promote the key messages. With the increased popularity of digital platforms amongst the youth, Sam integrated the use of a hashtag in his campaign #iStarted for easier adoption of his message.<br /><br />Kariuki is excited at the possibilities that lie ahead of him. One of his career goals is to help the region understand the key role Public Relations plays in the economy as he believes that the profession is often misunderstood. “Countries and Organizations at large must understand that the right messages communicated at the right time through the right channels can spur an economy in the right direction,” explains Samuel.<br /><br />The faculty at the School of Science and Technology were given special recognition by Samuel for their special support in preparing him for his submission to the 2014 PRSK Awards and for their efforts in helping bridge the gap between the Journalism program course work and the real work environment.<br /><br />This is the fourth time a USIU-Africa student has scooped the award with Amanda Gicharu having been recognized twice consecutively in 2005 and 2006 and Wanjiku Wainaina having been recognized in 2009. <br /><br />The Digital Media Boot Camp that USIU-Africa partnered with Globetrack International in July 2014 was also awarded the New Media PR Campaign of the Year.<br />\r\n                                </p>', 'Joe Mbarga', '2015-02-28 08:52:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `data`) VALUES
  (4, 'notification', '{"sms":true,"push":true}'),
  (5, 'sms', '{"twilio":{"sid":"AC1dc0655380af766bf0eac6ed19721990","token":"19947e9a1b561e22a7f706f2861989d0","sender":"+17043259534"}}'),
  (6, 'push', '{"GCM":{"API_KEY":"AIzaSyBtRrTpXNpQtiYEJfdSU41R9ZT2WF_1Ajw"},"APNS":{"token":null}}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pwd` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `pwd`) VALUES
  (1, 'aksalj@aksalj.me', 'Salama AB', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `feeds`
--
ALTER TABLE `feeds`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `feeds`
--
ALTER TABLE `feeds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;