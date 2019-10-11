-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 10, 2019 at 04:05 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `artist_table`
--

CREATE TABLE `artist_table` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `timestamp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_table`
--

INSERT INTO `artist_table` (`id`, `name`, `description`, `timestamp`) VALUES
(2, 'Arijit Singh', 'He is one of the most popular singer of India', '2019-09-06 20:41:24'),
(4, 'Sonu Nigam', 'He is one of the most popular singer of India', '2019-09-07 15:22:55'),
(5, 'Rahat Fateh Ali Khan', 'He is one of the best classical singer of India', '2019-09-07 15:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `favorites_table`
--

CREATE TABLE `favorites_table` (
  `user_id` varchar(10) NOT NULL,
  `song_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites_table`
--

INSERT INTO `favorites_table` (`user_id`, `song_id`) VALUES
('1', '24'),
('2', '25'),
('3', '25');

-- --------------------------------------------------------

--
-- Table structure for table `genre_table`
--

CREATE TABLE `genre_table` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `timestamp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre_table`
--

INSERT INTO `genre_table` (`id`, `name`, `description`, `timestamp`) VALUES
(2, 'Blues', 'This is a blues genre', '2019-08-26 14:55:41'),
(8, 'Melody', 'This is a melody genre', '2019-09-07 16:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `home_table`
--

CREATE TABLE `home_table` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `artist` varchar(150) NOT NULL,
  `song_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_table`
--

INSERT INTO `home_table` (`id`, `name`, `artist`, `song_id`) VALUES
(1, 'Liar', 'Camila Cabello', '24'),
(2, 'Shameless', 'Camila Cabello', '25'),
(3, 'K-12', 'Melanie Martinez', '26'),
(4, 'The Highwomen', 'The Highwomen', '25'),
(5, 'Feel It Too', 'Tainy', '24'),
(6, 'Get Over It', 'John Lenon', '26');

-- --------------------------------------------------------

--
-- Table structure for table `mood_table`
--

CREATE TABLE `mood_table` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `timestamp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mood_table`
--

INSERT INTO `mood_table` (`id`, `name`, `description`, `timestamp`) VALUES
(1, 'Romantic', 'This is a Romantic Mood Category', '2019-09-06 19:43:03'),
(3, 'Sad', 'This is a sad mood which is very common.', '2019-09-07 16:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `songs_table`
--

CREATE TABLE `songs_table` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `length` varchar(10) NOT NULL,
  `artist_id` varchar(50) NOT NULL,
  `genre_id` varchar(50) NOT NULL,
  `mood_id` varchar(50) NOT NULL,
  `path` varchar(1000) DEFAULT NULL,
  `timestamp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs_table`
--

INSERT INTO `songs_table` (`id`, `name`, `description`, `length`, `artist_id`, `genre_id`, `mood_id`, `path`, `timestamp`) VALUES
(24, 'Afreen-Afreen.mp3', 'This is a Popular Song of India', '05:30', '5', '8', '1', 'files/songs/AfreenAfreen-(Raag.Fm).mp3', '2019-09-07 12:56:53'),
(25, 'Teri Meri.mp3', 'This is a Popular Song of India', '04:40', '5', '8', '3', 'files/songs/TeriMeri-Bodyguard(2011)RahatFatehAliKhan-256.mp3', '2019-09-07 17:35:08'),
(26, 'Ringtone.mp3', 'He is one of the most popular song of India', '02:35', '4', '8', '3', 'files/songs/RobbieWilliams-She\'sTheOne(SaxCover)-256.mp3', '2019-09-07 18:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `number` varchar(50) NOT NULL,
  `path` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`id`, `name`, `email`, `password`, `gender`, `number`, `path`) VALUES
(1, 'Saksham Sir', 'saksham@lco.com', '123', 'Male', '8777588261', 'files/images/img.jpg'),
(2, 'Hitesh Sir', 'hitesh@hiteshchoudhary.com', '123', 'Male', '8547256356', 'files/images/sir.jpg'),
(3, 'Samprit Sarkar', 'sam@samprit.in', '123', 'Male', '9563286365', '../images/profile-pic/home3.jpg'),
(4, 'Amit Roy', 'amit@gmail.com', '12345', 'Male', '8563256365', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist_table`
--
ALTER TABLE `artist_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre_table`
--
ALTER TABLE `genre_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_table`
--
ALTER TABLE `home_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mood_table`
--
ALTER TABLE `mood_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs_table`
--
ALTER TABLE `songs_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artist_table`
--
ALTER TABLE `artist_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genre_table`
--
ALTER TABLE `genre_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `home_table`
--
ALTER TABLE `home_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mood_table`
--
ALTER TABLE `mood_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `songs_table`
--
ALTER TABLE `songs_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
