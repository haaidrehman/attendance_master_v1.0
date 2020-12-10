-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 09:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Haaid Rehamn', 'admin_236873', '$2y$10$df5Xg0fQT5HZL8GlcTlXK.WVEql8B2xGCQS.TEOkp7knkwwZV8pf2');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_detail`
--

CREATE TABLE `attendance_detail` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `year` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_detail`
--

INSERT INTO `attendance_detail` (`id`, `class_id`, `teacher_id`, `subject_id`, `year`) VALUES
(1, 8, 5, 1, 2020),
(2, 4, 5, 1, 2020),
(3, 3, 5, 1, 2020),
(4, 2, 5, 1, 2020),
(5, 1, 5, 1, 2020),
(6, 5, 5, 1, 2020),
(7, 9, 5, 1, 2020),
(8, 7, 5, 1, 2020),
(9, 6, 5, 1, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `present` tinyint(1) NOT NULL,
  `absent` tinyint(1) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_tbl`
--

INSERT INTO `attendance_tbl` (`id`, `ad_id`, `class_id`, `subject_id`, `std_id`, `roll_no`, `teacher_id`, `present`, `absent`, `date`) VALUES
(1, 2, 4, 1, 9, 1, 5, 0, 1, '2020-12-04'),
(2, 2, 4, 1, 11, 2, 5, 1, 0, '2020-12-04'),
(3, 2, 4, 1, 9, 1, 5, 0, 1, '2020-12-05'),
(4, 2, 4, 1, 11, 2, 5, 0, 1, '2020-12-05'),
(5, 2, 4, 1, 9, 1, 5, 0, 1, '2020-12-03'),
(6, 2, 4, 1, 11, 2, 5, 1, 0, '2020-12-03'),
(7, 2, 4, 1, 11, 2, 5, 0, 1, '2020-12-06'),
(8, 2, 4, 1, 9, 1, 5, 1, 0, '2020-12-06'),
(9, 2, 4, 1, 9, 1, 5, 1, 0, '2020-12-07'),
(10, 2, 4, 1, 11, 2, 5, 1, 0, '2020-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class`) VALUES
(1, 'Class 1'),
(2, 'Class 2'),
(3, 'Class 3'),
(4, 'Class 4'),
(5, 'Class 5'),
(6, 'Class 6'),
(7, 'Class 7'),
(8, 'Class 8'),
(9, 'Class 9'),
(10, 'Class 10'),
(11, 'Class 11'),
(12, 'Class 12');

-- --------------------------------------------------------

--
-- Table structure for table `new_registration`
--

CREATE TABLE `new_registration` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `uniqid` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_registration`
--

INSERT INTO `new_registration` (`id`, `fname`, `lname`, `age`, `gender`, `class_id`, `phone`, `email`, `address`, `password`, `uniqid`, `status`, `created_at`) VALUES
(1, 'Rakesh', 'Roshan', '14', 'Female', '9', '7865434500', 'rakesh_roshan_5436@gmail.com', 'Haji Colony, Jamia Nagar', '$2y$10$uFTCKSr8/1wOxK43Z3of2.UCu2MBfojYRwX.qVJfH8wv.as1WDTHa', '5fbbb53ceed491606137', 1, '2020-11-23 18:42:29'),
(2, 'Mohan', 'Sharma', '15', 'Male', '7', '7865456798', 'mohanSharma15@gmail.com', 'Hauz Khas, Malviya Nagar', '$2y$10$Nmt9.SlIi4GcEmmRSJPDZ.CJxN2caKc7gAdPVGTDBgQWj4HJWPqBS', '5fbbb59f3e3711606137', 1, '2020-11-23 18:44:07'),
(3, 'Mukesh', 'Kumar', '9', 'Male', '5', '7276565432', 'mukesh_kumar345@gmail.com', 'Zakir Nagar, Okhla', '$2y$10$oFYEQfrbxLsZuKUks2iiWO5eoD63tfh2h87.4K2muKuDpCO4uP4MO', '5fbbb6167c2211606137', 1, '2020-11-23 18:46:06'),
(4, 'Anil', 'Singh', '16', 'Male', '9', '8765654378', 'anil_singh@gmail.com', 'Bandra, Mumbai', '$2y$10$OdDKC6O5gUNYYgQiLv5.EOdiUtx2C.1KUTzkJHsim1yjLfSAYWMUa', '5fbbb6986c81e1606137', 1, '2020-11-23 18:48:16'),
(5, 'Rohan', 'Srivastav', '18', 'Male', '11', '8765785121', 'rohanShrivastav67@gmail.com', 'Andheri East, Mumbai, Maharashtra', '$2y$10$oW54NC/hiz0lA67/hg2h4O0WOfhIsVfDxoLF7b8khXy3enjkiJls.', '5fbbb6eb9468d1606137', 1, '2020-11-23 18:49:39'),
(6, 'Sunil', 'Sharma', '17', 'Male', '11', '7643908780', 'sunilsharma@gmail.com', 'Jamia Nagar, Okhla, New Delhi, Delhi', '$2y$10$uWcSDmkvHHVOn51Z0JFWJehn7aHtGElkY3ueE9zZ7WprpUl5eB5Zi', '5fbbb744ad50d1606137', 1, '2020-11-23 18:51:08'),
(7, 'Shyam', 'Kumar', '14', 'Male', '10', '7765476798', 'shyam_kumar387@gmail.com', '65/2, Ashok Nagar', '$2y$10$jfM8HPlhUheQlGtXd.LyieD6dLdBjJHRc8jrVFKmtSPb.OqqsJeda', '5fbbbd61313e41606139', 1, '2020-11-23 19:17:13'),
(8, 'Rohit', 'Kumar', '17', 'Male', '10', '7643900700', 'rohitkumar5732@gmail.com', 'Zakir Nagar, Okhla', '$2y$10$ZvRYRwSJe/K/9V0EFSeY0O3K90kNd86qv9nzHu2Pp0q0tjZUWUeEi', '5fbbbf4bcc00e1606139', 1, '2020-11-23 19:25:23'),
(9, 'Sumit', 'Kumar', '15', 'Male', '10', '9898343445', 'sumit346@gmail.com', 'Haji Colony, Jamia Nagar', '$2y$10$SkjgpZKkO9f2kvbFi8JslejuN5/PMlvmw82zkmp1Yb13fVzeRPv3K', '5fbbc1092211f1606140', 1, '2020-11-23 19:32:49'),
(10, 'Shahid', 'Kapoor', '17', 'Male', '7', '7854543232', 'shahid76576@gmail.com', 'Zakir Nagar, Okhla', '$2y$10$NJelwxw8ZWXotwskf3rKO.kd2rMW2Ykeq40Cf2w.FzhFrNOvQxOWG', '5fbbc44209ef51606140', 1, '2020-11-23 19:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `roll_no` varchar(10) DEFAULT 'null',
  `phone` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profile_pic` varchar(200) NOT NULL DEFAULT 'null',
  `reg_id` varchar(20) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fname`, `lname`, `age`, `gender`, `class_id`, `roll_no`, `phone`, `email`, `address`, `password`, `profile_pic`, `reg_id`, `added_on`) VALUES
(1, 'Mukesh', 'Kumar', '9', 'Male', '5', '1', '7276565432', 'mukesh_kumar345@gmail.com', 'Zakir Nagar, Okhla', '$2y$10$oFYEQfrbxLsZuKUks2iiWO5eoD63tfh2h87.4K2muKuDpCO4uP4MO', 'null', '5fbbb6167c2211606137', '2020-11-23 19:36:07'),
(2, 'Mohan', 'Sharma', '15', 'Male', '8', '1', '7865456798', 'mohanSharma15@gmail.com', 'Hauz Khas, Malviya Nagar', '$2y$10$Nmt9.SlIi4GcEmmRSJPDZ.CJxN2caKc7gAdPVGTDBgQWj4HJWPqBS', 'null', '5fbbb59f3e3711606137', '2020-11-23 19:36:21'),
(3, 'Rakesh', 'Roshan', '14', 'Female', '8', '2', '7865434500', 'rakesh_roshan_5436@gmail.com', 'Haji Colony, Jamia Nagar', '$2y$10$uFTCKSr8/1wOxK43Z3of2.UCu2MBfojYRwX.qVJfH8wv.as1WDTHa', 'null', '5fbbb53ceed491606137', '2020-11-23 19:36:57'),
(4, 'Anil', 'Singh', '16', 'Male', '8', '3', '8765654378', 'anil_singh@gmail.com', 'Bandra, Mumbai', '$2y$10$OdDKC6O5gUNYYgQiLv5.EOdiUtx2C.1KUTzkJHsim1yjLfSAYWMUa', 'null', '5fbbb6986c81e1606137', '2020-11-23 19:37:01'),
(5, 'Sumit', 'Kumar', '15', 'Male', '10', '1', '9898343445', 'sumit346@gmail.com', 'Haji Colony, Jamia Nagar', '$2y$10$SkjgpZKkO9f2kvbFi8JslejuN5/PMlvmw82zkmp1Yb13fVzeRPv3K', 'null', '5fbbc1092211f1606140', '2020-11-23 19:37:11'),
(6, 'Rohit', 'Kumar', '17', 'Male', '10', '2', '7643900700', 'rohitkumar5732@gmail.com', 'Zakir Nagar, Okhla', '$2y$10$ZvRYRwSJe/K/9V0EFSeY0O3K90kNd86qv9nzHu2Pp0q0tjZUWUeEi', 'null', '5fbbbf4bcc00e1606139', '2020-11-23 19:37:15'),
(7, 'Shyam', 'Kumar', '14', 'Male', '10', '3', '7765476798', 'shyam_kumar387@gmail.com', '65/2, Ashok Nagar', '$2y$10$jfM8HPlhUheQlGtXd.LyieD6dLdBjJHRc8jrVFKmtSPb.OqqsJeda', 'null', '5fbbbd61313e41606139', '2020-11-23 19:37:18'),
(8, 'Rohan', 'Srivastav', '18', 'Male', '3', '2', '8765785121', 'rohanShrivastav67@gmail.com', 'Andheri East, Mumbai, Maharashtra', '$2y$10$oW54NC/hiz0lA67/hg2h4O0WOfhIsVfDxoLF7b8khXy3enjkiJls.', 'null', '5fbbb6eb9468d1606137', '2020-11-23 19:37:27'),
(9, 'Sunil', 'Sharma', '17', 'Male', '4', '1', '7643908780', 'sunilsharma@gmail.com', 'Jamia Nagar, Okhla, New Delhi, Delhi', '$2y$10$uWcSDmkvHHVOn51Z0JFWJehn7aHtGElkY3ueE9zZ7WprpUl5eB5Zi', 'null', '5fbbb744ad50d1606137', '2020-11-23 19:37:30'),
(11, 'Shahid', 'Kapoor', '17', 'Male', '4', '2', '7854543232', 'shahid76576@gmail.com', 'Zakir Nagar, Okhla', '$2y$10$NJelwxw8ZWXotwskf3rKO.kd2rMW2Ykeq40Cf2w.FzhFrNOvQxOWG', 'null', '5fbbc44209ef51606140', '2020-11-23 19:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Hindi'),
(2, 'English'),
(3, 'Maths'),
(4, 'Science'),
(5, 'Social Studies');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'inactive',
  `class` int(10) NOT NULL DEFAULT 0,
  `subject_id` int(10) NOT NULL DEFAULT 0,
  `token` varchar(32) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp(),
  `activation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `fname`, `lname`, `gender`, `phone`, `email`, `username`, `password`, `address`, `status`, `class`, `subject_id`, `token`, `added_on`, `activation_date`) VALUES
(1, 'Akash', 'Kumar', 'Male', '9087543232', 'akashKumar65@gmail.com', 'akash_kumar6248', '$2y$10$bon3Y03rj2RrKpdZhp79suWHI21EtFYa1d0mUfwEuHwWUZphdLXae', 'Rohini, New Delhi, Delhi', 'active', 1, 1, '9cef22e4837008e7bb84d47cb7bc6418', '2020-11-24 13:36:46', '2020-11-24 01:36:46'),
(2, 'Akram', 'Khan', 'Male', '9987875434', 'akram3877@gmali.com', 'akram949978', '$2y$10$9QgU83f7Zl3rjICjYjy6Z.XPZPdnQPUjBXx20jjvH8n9YrByzkk4K', '43, Ashok Nagar, New Delhi, Delhi', 'active', 2, 2, '98172d260252e1bb7d9bc1101ffc026f', '2020-11-24 13:39:40', '2020-11-24 01:40:32'),
(3, 'Manoj', 'Kumar', 'Male', '8876565432', 'manojkumar74276@gmail.com', 'manoj_kumar6576', '$2y$10$68utrZzSTEaUuTfNzldJeuS6MGyRxhxYoZZPk1PQR3GuI72HuImoS', '27, Hauz Khas, Malviya Nagar, New Delhi, Delhi', 'active', 3, 3, '8104808c2689d4e1643c4dab189f39b7', '2020-11-24 13:44:04', '2020-11-24 01:44:05'),
(4, 'Praveen', 'Kumar', 'Male', '7654367890', 'praveen358@gmail.com', 'praveen_39839', '$2y$10$mwktimhfnqoSlfKZJYR25uGhSI8YfcXnyiYY3vl1BO/7uCtb3YieW', 'Zakir Nagar, Okhla, New Delhi, Delhi', 'active', 4, 4, '00bee658120c0b2b951e9a3373740e72', '2020-11-24 13:47:09', '2020-11-24 01:52:54'),
(5, 'Aditya', 'Sharma', 'Male', '7990876734', 'adity87468@gmail.com', 'adityasharma878', '$2y$10$/dkxfGznGRALC.tOJPwBxeZ1zR8QdwjRNPtQsgAz33TpLlej3PPCO', '12/3, Saket, New Delhi, Delhi', 'active', 5, 5, '6bb144b15ac276028f7d3de9d06095f7', '2020-11-24 13:50:11', '2020-11-24 01:53:31'),
(6, 'Zaid', 'Jameel', 'Male', '9876543210', 'jmiid25@gmail.com', 'zaid3479849', '$2y$10$04v1Onp4igoYzHnp7LKIseoFwl/8sUi77tODkzHxBObMCIoqU.u66', 'Haji Colony, Jamia Nagar', 'active', 0, 0, '24ed0377cc3b44b11cd91c8d49cf84b3', '2020-11-29 12:17:47', '2020-11-29 12:17:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_detail`
--
ALTER TABLE `attendance_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_registration`
--
ALTER TABLE `new_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_detail`
--
ALTER TABLE `attendance_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `new_registration`
--
ALTER TABLE `new_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
