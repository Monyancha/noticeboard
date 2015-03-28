-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2015 at 11:08 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `usiuboard`
--
CREATE DATABASE IF NOT EXISTS `usiuboard` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `usiuboard`;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `type` enum('apns','gcm') DEFAULT NULL,
  `uuid` varchar(512) NOT NULL,
  `phone` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `type`, `uuid`, `phone`) VALUES
  (7, 'gcm', 'APA91bHM4apVH7_Mg4QNrLVCFgxzfaf6wyPDpWnceg3EVdjRbTkDqDhy-7E7GGlUGey0BjJydGw23qQVxy4QLMD8n9Bz18FSHQbHUqhtfvIisqlTx2xKH9UECFLghaOqcvOwNv-6BBDKiL53mUtrnPROBTZau8AuOQ', '+254731034588'),
  (8, NULL, 'null', '+254718769882');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`id`, `title`, `description`, `url`, `date`, `slug`) VALUES
  (1, 'Alerts', 'Notice board alerts', 'http://usiu.aksalj.me/api/feed/alerts', '2015-03-03 05:00:00', 'alerts'),
  (9, 'Sign Up Sheets', 'Notice board sign up sheets', 'http://usiu.aksalj.me/api/feed/sign-up-sheets', '2015-03-24 04:00:00', 'sign-up-sheets'),
  (10, 'Timetables', 'Notice timetables and schedules', 'http://usiu.aksalj.me/api/feed/timetables', '2015-03-01 05:00:00', 'timetables'),
  (11, 'Announcements', 'Notice board announcements', 'http://usiu.aksalj.me/api/feed/announcements', '2015-03-06 05:00:00', 'announcements'),
  (12, 'Adverts', 'Notice board adverts', 'http://usiu.aksalj.me/api/feed/adverts', '2015-03-01 05:00:00', 'adverts');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `feed`, `title`, `description`, `link`, `image`, `content`, `author`, `date`, `notified`) VALUES
  (1, 1, 'PRSK Recognizes USIU-Africa Student as Young Communicator of the Year', 'Samuel Waitathu Kariuki, a senior majoring in Journalism with a concentration in Public Relations at USIU-Africa’s School of Science and Technology, was recognized as the Young Communicator of the Year at the 2014 Public Relations Society of Kenya (PRSK) Awards for Excellence. The gala event was held at the Safari Park Hotel in Nairobi on December 5, 2014.', 'http://www.usiu.ac.ke/index/on-campus/news/prsk-recognizes-usiu-africa-student-as-young-communicator-of-the-year', 'http://www.usiu.ac.ke/index/images/News/Sam-Kariuki-2.jpg', '<p>\r\n                                    This year, the awards received fifty nine entries and following adjudication by a panel of judges, thirteen winners were drawn from academia, private and public organizations. <br /><br />Samuel’s entry was inspired by a class project that required him to integrate Marketing and Communications tactics for the success of his campaign whose goal was to encourage the youth to apply for loans from the Uwezo Fund. His campaign dubbed YOLO (You Only Live One) encouraged the youth to follow their dreams and in so doing, view entrepreneurship as a viable option. This in turn would create the need for funding for their enterprises, encouraging the youth to approach the Uwezo fund for loans. <br /><br />The approach of the campaign was to use print, electronic and digital platforms to promote the key messages. With the increased popularity of digital platforms amongst the youth, Sam integrated the use of a hashtag in his campaign #iStarted for easier adoption of his message.<br /><br />Kariuki is excited at the possibilities that lie ahead of him. One of his career goals is to help the region understand the key role Public Relations plays in the economy as he believes that the profession is often misunderstood. “Countries and Organizations at large must understand that the right messages communicated at the right time through the right channels can spur an economy in the right direction,” explains Samuel.<br /><br />The faculty at the School of Science and Technology were given special recognition by Samuel for their special support in preparing him for his submission to the 2014 PRSK Awards and for their efforts in helping bridge the gap between the Journalism program course work and the real work environment.<br /><br />This is the fourth time a USIU-Africa student has scooped the award with Amanda Gicharu having been recognized twice consecutively in 2005 and 2006 and Wanjiku Wainaina having been recognized in 2009. <br /><br />The Digital Media Boot Camp that USIU-Africa partnered with Globetrack International in July 2014 was also awarded the New Media PR Campaign of the Year.<br />\r\n                                </p>', 'Zakaria Davis', '2015-03-02 14:28:56', 1),
  (2, 11, 'USIU-Africa Opens Event Related Potential Laboratory for Research ', 'USIU-Africa has opened an Event Related Potential (ERP) Laboratory in an effort to enhance its Psychology programs by making them more practical through research. This makes the Laboratory the second of its kind in Kenya after one owned by the Kenya Medical Research Institute (KEMRI) in Kilifi.', 'http://www.usiu.ac.ke/index/on-campus/news/usiu-africa-opens-event-related-potential-laboratory-for-research', 'http://www.usiu.ac.ke/index/images/News/erp-lab-main.jpg', '<p>Activities that will be carried out in the research laboratory will \ninvolve measuring the electrical activity of the brain by use of scalp \nelectrodes. This helps track the time it takes for the brain to \nrecognize change related to selective attention from audio and visual \nexperiments.</p>\n<p>The equipment is easy to use as there are no cultural bias or fear \nfactors associated with it allowing for experiments to be carried out on\n children as young as 2 weeks.</p>\n<p>Dr. Michael Kihara, an Associate Professor of Psychology spearheading\n the initiative at USIU-Africa sites that this is a major milestone for \nresearch in Africa in relation to understanding the effects on the brain\n from exposure to infectious diseases such as cerebral malaria and \npneumococcal meningitis, neonatal jaundice and epilepsy as well as \nchildren with HIV.</p>\n<p>While ERP laboratories have proved to be of significant benefit in \nthe developed countries, the high cost of the equipment required to make\n the laboratory operational is a hindrance to its penetration in Africa.\n The USIU-Africa laboratory equipment that was donated by KEMRI at a \ncost of 13,000 Sterling Pounds for a single operating license for the \nsoftware and 10,000 Sterling pounds for an amplifier is exclusive of the\n cost of the monitors used to display the readings of the experiments.</p>\n<p>Dr. Kihara who has been involved in extensive scientific research \nassociated with clinical psychology at KEMRI Wellcome Trust Research \nProgramme in Kilifi hopes to compare his findings from past research \nwith that of a sample from Nairobi. “This will contribute to \nunderstanding how the brain responds in different environments and \nperhaps predict future cognitive performance,” said Dr. Kihara.</p>\n<p>Research using ERP has been used to determine the effect on the brain\n if compromised by cerebral Malaria. Results from tests carried out have\n found that 1 out of every 4 people do not fully heal from the effects \nof the disease on the brain. This accounts to approximately 26% of those\n who contract cerebral malaria.</p>\n<p>ERP research has also been instrumental in determining the integrity \nof the brain in relation to speech impairment. “Many times, when the ERP\n experiment is carried out on a person to understand their speech \ndeficiency, it has been found that they require a speech therapist and \nthat the brain is actually not compromised,” adds Dr. Kihara.</p>\n<p>Other ERP laboratories in Africa can be found in Alexandre, Cape Town and Pretoria.</p>\nPsychology programs offered at USIU-Africa include Bachelor of Arts \nin Psychology, Masters of Arts in Clinical Psychology, Master of Arts in\n Counselling Psychology and the Doctor of Psychology (Psy.D), Clinical \nPsychology.?<br>', 'Joe Mbarga', '2015-03-02 18:52:50', 0),
  (3, 12, 'Celebrating The Black History Month', 'USIU-Africa has for the past 24 years celebrated the Black History Month with a series of forums and events scheduled on different days of the month of February. This year, the institution marked the celebrations with an official launch ceremony on 3rd February under the theme; The impact of independence in Kenya: The changing lifestyle of the Kenyan people.', 'http://www.usiu.ac.ke/index/on-campus/news/celebrating-the-black-history-month', 'http://www.usiu.ac.ke/index/images/News/black-history.jpg', '<p>The month long celebrations are aimed at informing, educating and \nengaging its audience on matters concerning African History and \ncelebrating not only those whom history recognizes as heroes but also \nthose amongst us who overcome unique obstacles to realize success.</p>\n<p>This year, the Black History Month committee organized for \ninspirational speakers such as Mr. Edward Buri and Dr. Ron Archer to \nengage with the university community. In his talk, Mr. Buri emphasized \nthe importance of merit and character as qualities of culture that were \nrelevant then and appropriate now as we strife to be freedom fighters of\n choice for a better future for generations to come.<br></p>\nDr. Ron Archer in his talk stressed the need for the Africans, \nregardless of their skin tone, to eradicate from our society envy and \njealousy if we were to realize true progress. Dr. Archer also encouraged\n Africans to be proud writers of their own story if they were to be part\n of history.?<br>', 'Salama AB', '2015-03-02 18:05:44', 0),
  (4, 9, 'AIDS Conference Sign up', 'Bacon ipsum dolor amet ball tip prosciutto shank kevin tenderloin frankfurter. Tail frankfurter beef ribs cupim pig boudin biltong shank. Tail short ribs hamburger rump corned beef turducken. Rump pig tri-tip jerky cow ham hock ground round t-bone meatball tenderloin short loin sirloin.', '', 'http://fm.cnbc.com/applications/cnbc.com/resources/img/editorial/2014/07/18/101847539-452309982.530x298.jpg', 'Bacon ipsum dolor amet ball tip prosciutto shank kevin tenderloin frankfurter. Tail frankfurter beef ribs cupim pig boudin biltong shank. Tail short ribs hamburger rump corned beef turducken. Rump pig tri-tip jerky cow ham hock ground round t-bone meatball tenderloin short loin sirloin. Picanha cow turkey pork loin. Drumstick prosciutto sausage, tenderloin capicola chicken shank hamburger corned beef leberkas porchetta bresaola landjaeger short ribs.<br><br>Short ribs pancetta pork chop tongue porchetta bresaola. Doner porchetta pork belly salami. Alcatra venison bresaola frankfurter, strip steak chuck turkey. Corned beef jerky flank ribeye, kevin drumstick tri-tip jowl doner pancetta meatloaf ground round landjaeger prosciutto pork loin. Chuck pastrami short loin drumstick tri-tip flank chicken filet mignon rump swine corned beef ham shankle bresaola. Pork chop picanha pork loin short loin venison leberkas. Corned beef ribeye pork fatback, salami chicken pork loin.<br><br><a href="https://docs.google.com/spreadsheet/ccc?key=0Amy6HEJ-KOmEdElmaERnWGpKR0dDMlVXX2FzN2plNUE&amp;usp=sharing#gid=0">Sign up here?</a><br><br>', 'Salama AB', '2015-03-02 17:40:19', 1),
  (5, 11, 'USIU to host African Union Youth conference', 'United States International University (USIU) is to host the region’s inaugural model African Union in partnership with the Youth Alliance for Leadership and Development in Africa (YALDA). Model African Union (MAU) conference is an academic conference where participants simulate proceedings of the African Union, just like the United Nations Youth Model.', 'http://www.capitalfm.co.ke/campus/usiu-to-host-african-union-youth-conference/', 'http://www.capitalfm.co.ke/campus/wp-content/uploads/2013/05/YALDA-mau.jpg', '<p>he conference is set to take place from <strong>17- 20th July 2013</strong>&nbsp;at the United States International University with the support of African Union and Oxfam.</p><p>The conference dubbed “Youth in policy making: Empowering for sustainable development in Africa” is the first of its kind in East and Central Africa and will be hosting over 200 youths from across Africa.</p><p>The conference will be graced by top AU diplomats, youth leaders, and passionate panafricanists such as Dr. Willie Butler among other distinguished guests. The head of youth programs in African Union Dr. Raymonde Aggossou will deliver a keynote address. The conference aims to bring youth closer to the continent’s biggest policy making body by providing them with a unique opportunity to give their inputs on various challenges Africa is facing.</p><p>Participants will be expected to put on their best thinking caps and discuss critical questions such as; ‘is military intervention in Mali Justified?’ The four committees being simulated include that on economic matters, social matters, Democracy, Governance and Human Rights and that on Peace and Security. Delegates will tackle contemporary issues that are of importance to the African continent such as debt and foreign aid, human rights abuses, self determination, democracy and war on terror on the continent.?</p>', 'Salama AB', '2015-03-06 12:06:04', 0);

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
  (6, 'push', '{"GCM":{"API_KEY":"AIzaSyBtRrTpXNpQtiYEJfdSU41R9ZT2WF_1Ajw"},"APNS":{"token":""}}');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `feeds`
--
ALTER TABLE `feeds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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