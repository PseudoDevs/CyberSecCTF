-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2020 at 03:04 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pncrtg`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `privacy` varchar(100) NOT NULL,
  `thumbnails` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `post_time` varchar(30) NOT NULL,
  `hashes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_messages`
--

CREATE TABLE `group_messages` (
  `id` int(11) NOT NULL,
  `privacy` varchar(100) NOT NULL,
  `team_id` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `create_date` varchar(100) NOT NULL,
  `hashes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `user_id` int(11) NOT NULL,
  `bio` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `hackerone` varchar(100) NOT NULL,
  `bugcrowd` varchar(100) NOT NULL,
  `github` varchar(100) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `rank` varchar(11) NOT NULL,
  `active` varchar(1) NOT NULL,
  `joined_time` varchar(30) NOT NULL,
  `total_points` varchar(11) NOT NULL,
  `total_solved` varchar(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `session` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`user_id`, `bio`, `email`, `fullname`, `username`, `password`, `profile`, `facebook`, `twitter`, `hackerone`, `bugcrowd`, `github`, `team_name`, `rank`, `active`, `joined_time`, `total_points`, `total_solved`, `role`, `status`, `session`) VALUES
(10100, '', 'ph.hitachi@gmail.com', 'justin lee', 'Ph.Hitachi', 'qZXdWIoww1nRsqZlQd1vGC569/qJajXrt5YxWdzTAlo=', '39700927075352_04072020120506_120506_4807f04b6e5776f3be485dd335ed7435.png', 'https://facebook.com/ph.hitachi.phtml', '', 'asdadsa', 'asdadsa', 'asdadada', '10100', '1', '', '18/03/2020', '150', '1', 'Stuff', 'veryfied', 'y8Hsp3sc0yqA5FG8+HSrc24B9Z0R9R8qNkiuT1lkAwf3B20+Gh+fdCe4Qo4bVsExkbro7GIuwkps2R9G4vmyc3h5PNoeLDpMGd1DtX711XeNhRrU3GzHq+A3XuGnwXPLhxypKQ=='),
(10101, 'Security Researcher', '', 'Joshua Alcantara', 'IamPseudoX', '53YQ/VwkUhnYx9ulhHHwdW/oPgS6+jcuZqj/hDw6Mis=', '15258966554250_04012020_070254_f7f0bbdb094d0b83d7561fc5ec2130d7.png', 'https://facebook.com/ph.hitachi.phtml', 'https://facebook.com/ph.hitachi.phtml', 'https://facebook.com/ph.hitachi.phtml', 'https://facebook.com/ph.hitachi.phtml', 'https://facebook.com/ph.hitachi.phtml', '10101', '2', '', '18/03/2020', '120', '1', 'member', 'veryfied', ''),
(10102, 'Security Researcher', '', 'Tite', 'Mr.KaitoX', 'RAnFc3Q7ho2r/wReeqgVNBpvEwRSzBfKTxnRXdgdFkQ=', 'avatar.png', 'facebook.com', 'twitter', 'twitter', 'bugcrowd', 'github', '10102', '3', '', '18/03/2020', '100', '', 'member', 'veryfied', '');

-- --------------------------------------------------------

--
-- Table structure for table `posted_challenges`
--

CREATE TABLE `posted_challenges` (
  `challenge_id` int(11) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `target` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `rules` text NOT NULL,
  `privacy` varchar(100) NOT NULL,
  `posted_date` varchar(100) NOT NULL,
  `timestamp` varchar(100) NOT NULL,
  `challenge_status` varchar(100) NOT NULL,
  `solver` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posted_challenges`
--

INSERT INTO `posted_challenges` (`challenge_id`, `author_name`, `target`, `category`, `level`, `rules`, `privacy`, `posted_date`, `timestamp`, `challenge_status`, `solver`) VALUES
(10129, 'Ph.Hitachi', 'https://target.com', 'Web Pentesting', 'Easy', '%23+Rules%0D%0A%0D%0A%2A%2ADescription%2A%2A%0D%0A%0D%0A%2A%2ADon%27t+use+the+following%2A%2A%0D%0A%0D%0A1.+%0D%0A%0D%0A2.+%0D%0A%0D%0A3.+%0D%0A%0D%0A-+list+1%0D%0A-+list+2%0D%0A-+list+3%0D%0A%0D%0A%2A%2ANote%2A%2A%3A+note+here', 'Private', 'April 10, 2020', '20200410181737', 'Open', '5'),
(10130, 'Ph.Hitachi', 'https://target.com', 'Web Pentesting', 'Easy', '%23+Rules%0D%0A%0D%0A%2A%2ADescription%2A%2A%0D%0A%0D%0A%2A%2ADon%27t+use+the+following%2A%2A%0D%0A%0D%0A1.+%0D%0A%0D%0A2.+%0D%0A%0D%0A3.+%0D%0A%0D%0A-+list+1%0D%0A-+list+2%0D%0A-+list+3%0D%0A%0D%0A%2A%2ANote%2A%2A%3A+note+here', 'Public', 'April 10, 2020', '20200410190013', 'Open', '5'),
(10131, 'Ph.Hitachi', 'https://target.com', 'SQL injection', 'Hard', '%23+Rules%0D%0A%0D%0A%2A%2ADescription%2A%2A%0D%0A%0D%0A%2A%2ADon%27t+use+the+following%2A%2A%0D%0A%0D%0A1.+%0D%0A%0D%0A2.+%0D%0A%0D%0A3.+%0D%0A%0D%0A-+list+1%0D%0A-+list+2%0D%0A-+list+3%0D%0A%0D%0A%2A%2ANote%2A%2A%3A+note+here', 'Private', 'April 21, 2020', '20200421145947', 'Open', '5'),
(10132, 'Ph.Hitachi', 'https://target.com', 'SQL injection', 'Easy', '%23+Rules%0D%0A%0D%0A%2A%2ADescription%2A%2A%0D%0A%0D%0A%2A%2ADon%27t+use+the+following%2A%2A%0D%0A%0D%0A1.+%0D%0A%0D%0A2.+%0D%0A%0D%0A3.+%0D%0A%0D%0A-+list+1%0D%0A-+list+2%0D%0A-+list+3%0D%0A%0D%0A%2A%2ANote%2A%2A%3A+note+here', 'Public', 'April 21, 2020', '20200421154212', 'Open', '5');

-- --------------------------------------------------------

--
-- Table structure for table `stuff`
--

CREATE TABLE `stuff` (
  `id` int(11) NOT NULL,
  `bio` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `hackerone` varchar(100) NOT NULL,
  `bugcrowd` varchar(100) NOT NULL,
  `github` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stuff`
--

INSERT INTO `stuff` (`id`, `bio`, `email`, `fullname`, `username`, `password`, `profile`, `facebook`, `twitter`, `hackerone`, `bugcrowd`, `github`) VALUES
(1000, '', '', 'justin lee', 'Ph.Hitachi', 'Ph.Hitachi', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `submited_challenges`
--

CREATE TABLE `submited_challenges` (
  `report_id` int(11) NOT NULL,
  `challenger_name` varchar(11) NOT NULL,
  `start_time` varchar(30) NOT NULL,
  `start_date` varchar(30) NOT NULL,
  `end_time` varchar(30) NOT NULL,
  `end_date` varchar(30) NOT NULL,
  `points` varchar(30) NOT NULL,
  `solution` text NOT NULL,
  `duration` varchar(30) NOT NULL,
  `submited_status` varchar(100) NOT NULL,
  `invitation_status` varchar(100) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `solver_rank` varchar(100) NOT NULL,
  `target_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submited_challenges`
--

INSERT INTO `submited_challenges` (`report_id`, `challenger_name`, `start_time`, `start_date`, `end_time`, `end_date`, `points`, `solution`, `duration`, `submited_status`, `invitation_status`, `challenge_id`, `solver_rank`, `target_status`) VALUES
(10149, 'Mr.KaitoX', '', '', '', '', '', '', '', '', 'Invited', 10129, '', ''),
(10150, 'IamPseudoX', '', '', '', '', '', '', '', '', 'Invited', 10129, '', ''),
(10151, 'Ph.Hitachi', '', '', '', '', '', '', '', '', 'Invited', 10129, '', ''),
(10160, 'IamPseudoX', '', '', '', '', '', '', '', '', 'Invited', 10130, '', ''),
(10161, 'IamPseudoX', '', '', '', '', '', '', '', '', 'Invited', 10130, '', ''),
(10162, 'IamPseudoX', '', '', '', '', '', '', '', '', 'Invited', 10130, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `rank` int(11) NOT NULL,
  `cover_photo` varchar(100) NOT NULL,
  `total_points` varchar(100) NOT NULL,
  `total_members` varchar(100) NOT NULL,
  `hashes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `profile`, `rank`, `cover_photo`, `total_points`, `total_members`, `hashes`) VALUES
(10100, 'Unirises', 'avatar.png', 1, 'avatar.png', '150', '1', ''),
(10101, 'EutSec', 'avatar.png', 2, 'avatar.png', '120', '1', ''),
(10102, 'ClownSec', 'avatar.png', 3, 'avatar.png', '100', '1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_messages`
--
ALTER TABLE `group_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `posted_challenges`
--
ALTER TABLE `posted_challenges`
  ADD PRIMARY KEY (`challenge_id`);

--
-- Indexes for table `stuff`
--
ALTER TABLE `stuff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submited_challenges`
--
ALTER TABLE `submited_challenges`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_messages`
--
ALTER TABLE `group_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10128;

--
-- AUTO_INCREMENT for table `posted_challenges`
--
ALTER TABLE `posted_challenges`
  MODIFY `challenge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10133;

--
-- AUTO_INCREMENT for table `stuff`
--
ALTER TABLE `stuff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `submited_challenges`
--
ALTER TABLE `submited_challenges`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10163;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
