-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2017 at 07:11 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(32) NOT NULL,
  `admin_name` varchar(32) NOT NULL,
  `admin_user_name` varchar(32) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_user_name`, `admin_email`, `admin_password`, `admin_branch`) VALUES
(1, 'Mr. Admin', 'admin', 'admin@gym.com', 'admin', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(32) NOT NULL,
  `user_email` varchar(32) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `user_password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_email`, `user_name`, `user_password`) VALUES
(11, 'jashim@yahoo.com', 'jashim', '123456'),
(12, 'firoj@hotmail.com', 'firoj', '123456'),
(13, 'sudip@gmail.com', 'sudip', '123456'),
(14, 'nila@live.com', 'nila', '123456'),
(16, 'tuni@gamil.com', 'tuni', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `users_information`
--

CREATE TABLE `users_information` (
  `user_name` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `contact_number` varchar(14) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `image_path` varchar(100) NOT NULL DEFAULT 'default.png',
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_information`
--

INSERT INTO `users_information` (`user_name`, `name`, `contact_number`, `date_of_birth`, `gender`, `image_path`, `address`) VALUES
('firoj', 'Firoj Khan', '01749999444', '1990-01-01', 'Male', 'person_3.jpg', 'House 543, Road 12, Rome, Italy'),
('jashim', 'Jashim Uddin', '01821666333', '1971-01-01', 'Male', 'person_2.jpg', 'House 3, Road 34, Berlin, Germany'),
('nila', 'Nilanjona Nila', '01991144888', '1996-01-01', 'Female', 'person_5.jpg', 'House 35, Road 1, Rangpur, Bangladesh'),
('sudip', 'Sudip Sarker', '01771155999', '1992-01-01', 'Male', 'person_4.jpg', 'House 32, Road 5, London, UK'),
('tuni', 'Tun Tuni', '01711122211', '1994-01-01', 'Female', 'person_1.jpg', 'House 5, Road 2, Washington, D.C., USA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_name` (`admin_name`),
  ADD UNIQUE KEY `admin_email` (`admin_email`),
  ADD UNIQUE KEY `admin_user_name` (`admin_user_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `users_information`
--
ALTER TABLE `users_information`
  ADD PRIMARY KEY (`user_name`),
  ADD UNIQUE KEY `image_path` (`image_path`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
