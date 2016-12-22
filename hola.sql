-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 22, 2016 at 10:05 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `hola`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `user_name`, `user_email`, `user_pass`, `joining_date`) VALUES
(2, 'baydiwo', 'matakucoklat@yahoo.com', '$2y$10$fLsoc0QKmKahGX0x.AOnnOaD0vvcdLwS18Gvb3KjEf.mb9iXG6fCS', '2016-08-17 05:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `dataId` int(3) NOT NULL,
  `orderId` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `photoFileName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` int(3) NOT NULL,
  `clientName` varchar(100) NOT NULL,
  `orderDate` varchar(15) NOT NULL,
  `hashtag` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderId`, `clientName`, `orderDate`, `hashtag`) VALUES
(1, 'Bayu', '', ''),
(2, 'Bayu', '2015-11-30', 'sikidang'),
(3, 'Bayu', '2015-11-29', 'sikidang'),
(4, 'Bayu', '2015-11-29', 'sikidang'),
(5, 'Bayu', '2015-11-29', 'sikidang'),
(6, 'Bayu', '2014-11-29', 'sikidang'),
(7, 'Bayu Wedding', '2014-10-28', 'dieng'),
(8, 'Bayu Wedding 2', '2010-10-22', 'sikidang'),
(9, 'baydiwo', '2016-12-24', 'allah'),
(10, 'stmik bidakara', '', 'sidang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`dataId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `dataId` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderId` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
