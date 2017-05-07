-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 07, 2017 at 01:53 PM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(27, 'Swift'),
(28, 'C++'),
(29, 'C#'),
(30, 'Objective-C'),
(31, 'Bootstrap'),
(33, 'Procedural PHP');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(7, 2, 'MaryLyne', 'mary@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.    \r\n            \r\n            \r\n        ', 'Approved', '2017-05-01'),
(10, 1, 'fireCold', 'fire@gmail.com', 'Let make our voices heard', 'Approved', '2017-05-03'),
(13, 2, 'klsfdl', 'jmsfk@gmail.com', 'adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos', 'Unapproved', '2017-05-05'),
(14, 2, 'Theskd;l', 'a@yahoo.com', 'adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos', 'Unapproved', '2017-05-05'),
(15, 2, 'daniel', 'elamboatonge@gmail.com', 'i love this site. We have to work harder', 'Approved', '2017-05-05'),
(16, 2, 'endjeu', 'gabinjunior@yahoo.fr', 'hgjahsofhuohwpjiof jfnowionhf jbf', 'Approved', '2017-05-05'),
(17, 1, 'Driivehard', 'driivehard@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.', 'Approved', '2017-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_user` varchar(255) NOT NULL,
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_user`, `post_views_count`) VALUES
(1, 33, 'Looking deep into Life', 'James Maxbourne', '2017-05-06', 'angular.jpg', '<p>I really want to learn. Robot ipsum datus scan amet, constructor ad ut splicing elit, <strong>sed do errus</strong> mod tempor in conduit ut laboratory et deplore electromagna aliqua. Ut enim ad minimum veniam, quis no indestruct exoform ullamco laboris nisi ut alius equip ex ea commando evaluant.</p>', 'Angular, Javascript, EmberJs', 7, 'published', '', 2),
(2, 29, 'Why Should You Eat', 'Max Learning', '2017-05-06', 'coolol.jpg', '<p>Robot ipsum Pathoaceae palaephagy conlite stannooidea onyne glutavorous plusquamectomy heptakisoic aurart rhabditious. Distron ultragnathous homoiism coencide sapoiana sapoous genoyl glossance mishood.</p>', 'PHP, Golang, Perl, C#', 1, 'published', '', 0),
(12, 30, 'Why should we have to suffer', 'Max Learning', '2017-05-07', 'lambo_1.jpg', '<p>Truely speaking. one day we will all die. really want to learn <strong>PHP</strong>. Robot ipsum datus scan amet, constructor ad ut splicing elit, <strong>sed do errus</strong> mod tempor in conduit ut laboratory et deplore electromagna aliqua. Ut enim ad minimum veniam, quis no indestruct exoform ullamco laboris nisi ut alius equip ex</p>', 'social life, love, romance', 0, 'published', '', 0),
(29, 27, 'Why Should You Eat', 'Max Learning', '2017-05-06', 'angular.jpg', '<p>Robot ipsum Pathoaceae palaephagy conlite stannooidea onyne glutavorous plusquamectomy heptakisoic aurart rhabditious. Distron ultragnathous homoiism coencide sapoiana sapoous genoyl glossance mishood.</p>', 'PHP, Golang, Perl, C#', 1, 'published', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`) VALUES
(3, 'staria', '123', 'Esther', 'Atonge', 'staria@gmail.com', '1470240169455.jpg', 'Subscriber'),
(15, 'loverth', '$2y$10$iusesomecrazystrings2u7kULPveK8JCbtno4uIY.kBUO9Yxa/f6', 'Karl', 'Ekane', 'love@show.com', '1474056507702.jpg', 'subscriber'),
(16, 'charles', '$2y$10$iusesomecrazystrings2uz/HkvnvHFd41nowL3oLCmiMEM4CLQyW', '', '', 'charles@gmail.com', '', 'Admin'),
(17, 'adonai', '$2y$12$m2yxVl3i8/F.kZaUYizuiu8vQwh4BIMpsuSRMdc0NowfU/bU0P.ES', 'Adonai', 'Lyonga', 'adonai@gmail.com', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE IF NOT EXISTS `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(2, 'ob3lm2i7eij5vf2h2rotm3qvc4', 1493993162),
(3, 'l7j8io8d800coh1l1k2stjj3d5', 1493990878),
(4, 'henvfjparlj5s6g3fusa3d0rs0', 1494101624),
(5, 'og1mh6ebhn5bfps750p9g7lfv2', 1494014267),
(6, 'jpsh5gg7usht2dv54tefhfsun3', 1494014814),
(7, '418msqrenmtgpkleg5dbrem6q1', 1494087104),
(8, 'lgn1t4e4o25lp980f02n8efpa5', 1494165113);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
