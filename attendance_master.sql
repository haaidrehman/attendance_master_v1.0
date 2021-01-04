-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 05:59 PM
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
(1, 5, 1, 2, 2021),
(4, 5, 2, 1, 2021),
(5, 6, 2, 1, 2021);

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
(1, 1, 5, 2, 1, 1, 1, 1, 0, '2021-01-04'),
(2, 1, 5, 2, 10, 10, 1, 0, 1, '2021-01-04'),
(3, 1, 5, 2, 9, 2, 1, 0, 1, '2021-01-04'),
(4, 1, 5, 2, 8, 3, 1, 0, 1, '2021-01-04'),
(5, 1, 5, 2, 7, 4, 1, 1, 0, '2021-01-04'),
(6, 1, 5, 2, 2, 9, 1, 1, 0, '2021-01-04'),
(7, 1, 5, 2, 3, 8, 1, 1, 0, '2021-01-04'),
(8, 1, 5, 2, 4, 7, 1, 1, 0, '2021-01-04'),
(9, 1, 5, 2, 6, 5, 1, 1, 0, '2021-01-04'),
(10, 1, 5, 2, 5, 6, 1, 0, 1, '2021-01-04'),
(11, 4, 5, 1, 1, 1, 2, 1, 0, '2021-01-04'),
(12, 4, 5, 1, 10, 10, 2, 0, 1, '2021-01-04'),
(13, 4, 5, 1, 4, 7, 2, 1, 0, '2021-01-04'),
(14, 4, 5, 1, 8, 3, 2, 0, 1, '2021-01-04'),
(15, 4, 5, 1, 7, 4, 2, 1, 0, '2021-01-04'),
(16, 4, 5, 1, 2, 9, 2, 0, 1, '2021-01-04'),
(17, 4, 5, 1, 6, 5, 2, 1, 0, '2021-01-04'),
(18, 5, 6, 1, 13, 1, 2, 0, 1, '2021-01-04'),
(19, 5, 6, 1, 22, 10, 2, 1, 0, '2021-01-04'),
(20, 5, 6, 1, 16, 7, 2, 1, 0, '2021-01-04'),
(21, 5, 6, 1, 14, 9, 2, 0, 1, '2021-01-04'),
(22, 5, 6, 1, 21, 2, 2, 0, 1, '2021-01-04'),
(23, 5, 6, 1, 20, 3, 2, 0, 1, '2021-01-04'),
(24, 5, 6, 1, 19, 4, 2, 1, 0, '2021-01-04'),
(25, 5, 6, 1, 18, 5, 2, 1, 0, '2021-01-04'),
(26, 5, 6, 1, 17, 6, 2, 1, 0, '2021-01-04'),
(27, 5, 6, 1, 15, 8, 2, 1, 0, '2021-01-04');

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
(1, 'Mario', 'Speedwagon', '13', 'Male', '5', '9876754321', 'Mario_speedwagon@gmail.com', 'Ahsok Nagar, New Delhi, India', '$2y$10$pihLndMnxUMYyWrh3SdYS.OkhB3TyHEUvHtv.eIwQl7aK.o3E5AtK', '5feb81fef0bdb1609269', 1, '2020-12-30 00:52:39'),
(2, 'Petey', 'Cruiser', '15', 'Male', '5', '7654343212', 'PeteyCruiser23@gmail.com', 'Rohini, New Delhi, India', '$2y$10$kZSt9ET4jou3wUsRU2K3JOZ3roCZ6UA4Gr36jQ/vH8MOiEEnBHkmG', '5feb83da908461609270', 1, '2020-12-30 01:00:34'),
(3, 'Anna', 'Sthesia', '12', 'Female', '5', '8765654343', 'AnnaSthesia78426@gmail.com', 'Hauz Khas, Malviya Nagar, India', '$2y$10$GMuevJVA/8BXgbkZeejT9.Rpxz6G4i8lEvkHyv4JRP2WhNon0V1GO', '5feb851483e6d1609270', 1, '2020-12-30 01:05:48'),
(4, 'Paul', 'Molive', '11', 'Male', '5', '5643232167', 'PaulMolive43789@gmail.com', 'Jamia Nagar, New Delhi, India', '$2y$10$zGFbbJoJIv707Zx6pwTaaeZ2B9IhxwVmxiZDCI.rJgIRSoHLm67PO', '5feb85b90f9201609270', 1, '2020-12-30 01:08:33'),
(5, 'Anna', 'Mull', '14', 'Female', '5', '6754543231', 'Anna_Mull@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$VaXK2cUJ1/Mnk/ef/6sa0uAxwxuRkE7WePFAm9mQNSiVFECDZJ/wW', '5feb8641951051609270', 1, '2020-12-30 01:10:49'),
(6, 'Gail', 'Forcewind', '10', 'Male', '5', '8976564310', 'GailForcewind@gmail.com', 'New Friends Colony, New Delhi, India', '$2y$10$Br0DV8C20EbopE738Owf1OMsHELgOXR777X.Y0SIUa5hWaSvfsJi6', '5feb86ff64d301609271', 1, '2020-12-30 01:13:59'),
(7, 'Paige', 'Turner', '15', 'Female', '5', '7865432321', 'PaigeTurner@gmail.com', 'Ashok Nagar, New Delhi, India', '$2y$10$F7l8CMpZqgX1XfY4d4wk0umhrh0oYdhMiBxLa8C3YI48hpz069wGO', '5feb87a5575f61609271', 1, '2020-12-30 01:16:45'),
(8, 'Bob', 'Frapples', '13', 'Male', '5', '7985432123', 'BobFrapples@gmail.com', 'Nehru Place, New Delhi, India', '$2y$10$cYCs1J0xZeBCHUPahq7ZguchsVUQS002sgg7TmV1QWX4aMrzSopoS', '5feb89736e3ac1609271', 1, '2020-12-30 01:24:27'),
(9, 'Walter', 'Melon', '15', 'Male', '5', '8765432121', 'WalterMelon@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$ictq3ClnWPM.mKHhlAvxde63.CQ0t78oSPQt09Bk4Vhea86oI2j3C', '5feb8a30ab8de1609271', 1, '2020-12-30 01:27:36'),
(10, 'Nick R.', 'Bocker', '13', 'Male', '5', '6754320987', 'Nick_r_Bocker@gmail.com', 'Vasant Vihar, New Delhi, India', '$2y$10$.APT9kNtj2.iuhuIZOuMnew0yYXdJZifZX7p0P6V5nnbO5023qs4C', '5feb8abc254db1609271', 1, '2020-12-30 01:29:56'),
(11, 'Barb', 'Ackue', '11', 'Male', '6', '6754321209', 'BarbAckue@gmail.com', 'Hauz Khas,New Delhi, India', '$2y$10$NuAGVXPTVSpLFuJOJPRch.qpszo8qFVPDkRp8F5IRVMiS1.lIR0yi', '5ff1f580b2d961609692', 1, '2021-01-03 22:19:04'),
(12, 'Buck', 'Kinnear', '12', 'Male', '6', '5467898761', 'BuckKinnear@gmail.com', 'Nehru Place, New Delhi, India', '$2y$10$qOhi9tbxxvvsxzljFlauneOhNU2R01P/.eKx7D.ZgFSJ3ZuitExLe', '5ff1f69db3ac11609692', 1, '2021-01-03 22:23:49'),
(13, 'Greta', 'Life', '14', 'Male', '6', '7845321009', 'GretaLife@gmail.com', 'Laxmi Nagar, New Delhi, India', '$2y$10$8IN6cf4/IMCjsDtoP8NGI.WhgykGVKDeaVJg0lBYNBsqQfwNRrOb6', '5ff1f7eae57c01609693', 1, '2021-01-03 22:29:22'),
(14, 'Ira', 'Membrit', '13', 'Male', '6', '8866710091', 'IraMembrit@gmail.com', 'Ashram, New Delhi, India', '$2y$10$wCj2ph4mE23GwMlr3ENSyOFBzUbMgI6hNiNR2YsRpWJ7a2bRN.Kom', '5ff1f8fb140e91609693', 1, '2021-01-03 22:33:55'),
(15, 'Shonda', 'Leer', '14', 'Male', '6', '6755443287', 'ShondaLeer@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$LLQ.SGFgMxnjKRa4rigrX.1HVb5WgN7kkHaF4wL3XKuk8yHDJzbAi', '5ff1f96886cc61609693', 1, '2021-01-03 22:35:44'),
(16, 'Brock', 'Lee', '14', 'Male', '6', '7654545400', 'BrockLee@gmail.com', 'Hauz Khas, New Delhi, India', '$2y$10$Pc7ZbcyfTI8n2HmgzuXwOuxT1Y44px45AOLa.7xWM/tr9ZB3i1JT6', '5ff1fa5705cc41609693', 1, '2021-01-03 22:39:43'),
(17, 'Maya', 'Didas', '15', 'Male', '6', '8890076541', 'MayaDidas@gmail.com', 'Zakir Nagar, New Delhi, Delhi', '$2y$10$TBo/l4FlOo9XKdOzEnuYveK2xpf9J5eAp/t2.5AOShvjdGwO95mU2', '5ff1fb0ac0c751609693', 1, '2021-01-03 22:42:42'),
(18, 'Rick', 'O&#39;Shea', '12', 'Male', '6', '4009876123', 'RickOShea@gmail.com', 'Jamia Nagar, New Delhi, Delhi', '$2y$10$zHEUz.MnGgxQJF2k1YMAs.GYHFiBUulRhTqseuNRUy4lO/nHAOM/O', '5ff1fb806f0be1609694', 1, '2021-01-03 22:44:40'),
(19, 'Pete', 'Sariya', '11', 'Male', '6', '7000932123', 'Pete_Sariya@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$7Vmex5Rg6F.7CHGHce/Z3eYABnVlyEE/2neTf/XwCz46ol81Z0tVG', '5ff1fc379df611609694', 1, '2021-01-03 22:47:43'),
(20, 'Monty ', 'Carlo', '14', 'Male', '6', '5789000987', 'Monty_carlo@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$0j7wZvyNV6/XlDh/lgJYtO//NyeEFY9z9kc7c88c0i6RHwGSZxn6i', '5ff1fc97677ba1609694', 1, '2021-01-03 22:49:19'),
(21, 'Sal', 'Monella ', '11', 'Male', '8', '6000981212', 'Sal_Monella@gmail.com', 'Hauz Khas, New Delhi, India', '$2y$10$WlIvFPC/O1VYRkcibxFiO..4sFjjZI7ZU9dIRHkjA9d./csQxk5AS', '5ff1fd190f06c1609694', 1, '2021-01-03 22:51:29'),
(22, 'Sue  ', 'Vaneer', '12', 'Male', '8', '9054123212', 'SueVaneer@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$3dbBhhG5/FkxZH75f3n.rOunsP5Q4/yRDF/A4x3/PKC584W1wszSy', '5ff1fd68937c71609694', 1, '2021-01-03 22:52:48'),
(23, 'Cliff', 'Hanger', '16', 'Male', '8', '8765432100', 'CliffHanger@gmail.com', 'Hauz Khas, Malviya Nagar, India', '$2y$10$kt6KmwOiw/eGpby.5jyC7OIm98dovqtWOD4nSy/Hy3dUcKwkxBtrS', '5ff1fdb80a6dd1609694', 1, '2021-01-03 22:54:08'),
(24, 'Barb', 'Dwyer', '15', 'Male', '8', '6000981234', 'BarbDwyer@gmail.com', 'Ashok Nagar, New Delhi, India', '$2y$10$lLCb1EX2KS6I5sxyBxuuw.vB7ZlPfq5c47n9H8Q40U07dcBunFO9q', '5ff1fef4d4bc01609694', 1, '2021-01-03 22:59:24'),
(25, 'Terry', 'Aki', '13', 'Male', '8', '8009812345', 'TerryAki@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$DEte5jeX26nYbJ.gJAKIiulNhTva53PTEJRDB/Tk5/CQYGs4pKLRO', '5ff1ff56ae2121609695', 1, '2021-01-03 23:01:02'),
(26, 'Cory  ', 'Ander', '14', 'Male', '8', '6009876543', 'CoryAnder@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$CXXl04YJ6ftqaf44bta/SuwPJnjHkSGyp53iiYZUvTBBrGxCIjXp6', '5ff1ffefca77b1609695', 1, '2021-01-03 23:03:35'),
(27, 'Robin', 'Banks', '13', 'Male', '8', '7009876543', 'RobinBanks@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$e.DRjTg72/IY3x3SgfHbjug3TOyygWSfIbYvVgvlkPFpC/ux8W8Ky', '5ff20088c65d61609695', 1, '2021-01-03 23:06:08'),
(28, 'Jimmy', 'Changa', '11', 'Male', '8', '7890091212', 'Jimmy_Changa@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$ciscH1Kw13iHZvgOJtI0uuBleuqDJjuizuvO6vgjo8eO1EOA5LtYe', '5ff200fd46c321609695', 1, '2021-01-03 23:08:05'),
(29, 'Barry ', 'Wine', '14', 'Male', '8', '8000900985', 'BarryWine@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$EIAtdtX6jXFRyhnq5xI0cOFZJXZoGh9YVCpi4k4une9QnWWNz4Mw.', '5ff20153a47011609695', 1, '2021-01-03 23:09:31'),
(30, 'Wilma ', 'Mumduya', '16', 'Male', '8', '7676765431', 'WilmaMumduya@gmail.com', 'Malviya Nagar, New Delhi, India', '$2y$10$HyrjcENSVTQ2lsSNGuL4J.j9/sMd2J7/l4Exwa/L95oTF0zcLbhTS', '5ff201ae4a43e1609695', 1, '2021-01-03 23:11:02'),
(31, 'Buster ', 'Hyman', '14', 'Male', '8', '7898761200', 'BusterHyman@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$lls6jVHJcbrGhNYXxyCzPe3pE4vbpPK10yj3/GAktGQu84BW04aEm', '5ff201ea7a48b1609695', 1, '2021-01-03 23:12:02'),
(32, 'Poppa ', 'Cherry', '15', 'Male', '10', '6754443211', 'PoppaCherry@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$C.3kREgXgEdGBAM7d8fLzO7TJ/RYJpxBA2ecTA7U2KF0K.bA0knv.', '5ff20a64951041609697', 1, '2021-01-03 23:48:12'),
(33, 'Zack', 'Lee', '14', 'Male', '10', '4098765412', 'ZackLee@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$CDSjQjYsyWD24hak0wB7m.PhsFoews6iknei9.UNv3Wy5D1hYOBxm', '5ff20ab6576521609697', 1, '2021-01-03 23:49:34'),
(34, 'Don ', 'Stairs', '15', 'Male', '10', '8997765111', 'DonStairs@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$jP1P53BLY442L6cuB3kWOuv1T4wLqF7iZ2m7Gg.zuPRDYTrWBysOK', '5ff20afb94b111609698', 1, '2021-01-03 23:50:43'),
(35, 'Saul', 'T. Balls', '14', 'Male', '10', '6667887609', 'SaulT.Balls@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$GePeh3RWdlCZAvKIqOU7QulBCczp4KtvkPiq2JvOfEe1flNb1hk7u', '5ff20b4689da91609698', 1, '2021-01-03 23:51:58'),
(36, 'Peter', 'Pants', '14', 'Male', '10', '8889990798', 'PeterPants@gmail.com', 'Zakir Nagar, New Delhi, Delhi', '$2y$10$phYgHm/k.Bs3HhAt46zycubJZIJ.JQNSLSf1HE68JCkjz8XeGmNNe', '5ff20bc8ca0f51609698', 1, '2021-01-03 23:54:08'),
(37, 'Hal ', 'Appeno', '17', 'Male', '10', '9996754123', 'HalAppeno@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$8XzT0ckJkKrmvVWCLG2bMeEaOMUPwvKLPqQqcRlh6L4YkJIhdRH2q', '5ff20c1658df71609698', 1, '2021-01-03 23:55:26'),
(38, 'Otto ', 'Matic', '15', 'Male', '10', '9999453212', 'OttoMatic@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$GWvMgsRs/2Q3DwNtmHdrW./c4lv.zwQiFQLdi84ElGAmACCtGezWy', '5ff20c900a7031609698', 1, '2021-01-03 23:57:28'),
(39, 'Moe', 'Fugga', '14', 'Male', '10', '7777654120', 'MoeFugga@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$GBbZq3zQ2Oq/4Jv5sEui4.eN4w1Fl6yL3DgoeVYNJan7DU0FpDHVG', '5ff20d2cc87491609698', 1, '2021-01-04 00:00:04'),
(40, 'Graham', 'Cracker', '14', 'Male', '10', '6677789001', 'GrahamCracker@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$UbQjNa.M7n0w5MMdgWcT4.Jr40W1.TdAesfvG8Ok6nfRlgppoEx6K', '5ff20d65beb121609698', 1, '2021-01-04 00:01:01'),
(41, 'Tom', 'Foolery', '15', 'Male', '10', '9000987654', 'TomFoolery@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$KpAkkv7TeZsjTjdczG6j4O7BDXpNk1/0Ovxw8qe7s4W19BHudotcy', '5ff20dc7b74311609698', 1, '2021-01-04 00:02:39');

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
(1, 'Mario', 'Speedwagon', '13', 'Male', '5', '1', '9876754321', 'Mario_speedwagon@gmail.com', 'Ahsok Nagar, New Delhi, India', '$2y$10$pihLndMnxUMYyWrh3SdYS.OkhB3TyHEUvHtv.eIwQl7aK.o3E5AtK', 'null', '5feb81fef0bdb1609269', '2020-12-30 01:33:57'),
(2, 'Petey', 'Cruiser', '15', 'Male', '5', '9', '7654343212', 'PeteyCruiser23@gmail.com', 'Rohini, New Delhi, India', '$2y$10$kZSt9ET4jou3wUsRU2K3JOZ3roCZ6UA4Gr36jQ/vH8MOiEEnBHkmG', 'null', '5feb83da908461609270', '2021-01-04 00:06:08'),
(3, 'Anna', 'Sthesia', '12', 'Female', '5', '8', '8765654343', 'AnnaSthesia78426@gmail.com', 'Hauz Khas, Malviya Nagar, India', '$2y$10$GMuevJVA/8BXgbkZeejT9.Rpxz6G4i8lEvkHyv4JRP2WhNon0V1GO', 'null', '5feb851483e6d1609270', '2021-01-04 00:06:37'),
(4, 'Paul', 'Molive', '11', 'Male', '5', '7', '5643232167', 'PaulMolive43789@gmail.com', 'Jamia Nagar, New Delhi, India', '$2y$10$zGFbbJoJIv707Zx6pwTaaeZ2B9IhxwVmxiZDCI.rJgIRSoHLm67PO', 'null', '5feb85b90f9201609270', '2021-01-04 00:06:45'),
(5, 'Anna', 'Mull', '14', 'Female', '5', '6', '6754543231', 'Anna_Mull@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$VaXK2cUJ1/Mnk/ef/6sa0uAxwxuRkE7WePFAm9mQNSiVFECDZJ/wW', 'null', '5feb8641951051609270', '2021-01-04 00:06:51'),
(6, 'Bob', 'Frapples', '13', 'Male', '5', '5', '7985432123', 'BobFrapples@gmail.com', 'Nehru Place, New Delhi, India', '$2y$10$cYCs1J0xZeBCHUPahq7ZguchsVUQS002sgg7TmV1QWX4aMrzSopoS', 'null', '5feb89736e3ac1609271', '2021-01-04 00:06:58'),
(7, 'Gail', 'Forcewind', '10', 'Male', '5', '4', '8976564310', 'GailForcewind@gmail.com', 'New Friends Colony, New Delhi, India', '$2y$10$Br0DV8C20EbopE738Owf1OMsHELgOXR777X.Y0SIUa5hWaSvfsJi6', 'null', '5feb86ff64d301609271', '2021-01-04 00:07:04'),
(8, 'Paige', 'Turner', '15', 'Female', '5', '3', '7865432321', 'PaigeTurner@gmail.com', 'Ashok Nagar, New Delhi, India', '$2y$10$F7l8CMpZqgX1XfY4d4wk0umhrh0oYdhMiBxLa8C3YI48hpz069wGO', 'null', '5feb87a5575f61609271', '2021-01-04 00:07:07'),
(9, 'Nick R.', 'Bocker', '13', 'Male', '5', '2', '6754320987', 'Nick_r_Bocker@gmail.com', 'Vasant Vihar, New Delhi, India', '$2y$10$.APT9kNtj2.iuhuIZOuMnew0yYXdJZifZX7p0P6V5nnbO5023qs4C', 'null', '5feb8abc254db1609271', '2021-01-04 00:07:11'),
(10, 'Walter', 'Melon', '15', 'Male', '5', '10', '8765432121', 'WalterMelon@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$ictq3ClnWPM.mKHhlAvxde63.CQ0t78oSPQt09Bk4Vhea86oI2j3C', 'null', '5feb8a30ab8de1609271', '2021-01-04 00:07:14'),
(13, 'Barb', 'Ackue', '11', 'Male', '6', '1', '6754321209', 'BarbAckue@gmail.com', 'Hauz Khas,New Delhi, India', '$2y$10$NuAGVXPTVSpLFuJOJPRch.qpszo8qFVPDkRp8F5IRVMiS1.lIR0yi', 'null', '5ff1f580b2d961609692', '2021-01-04 00:12:02'),
(14, 'Buck', 'Kinnear', '12', 'Male', '6', '9', '5467898761', 'BuckKinnear@gmail.com', 'Nehru Place, New Delhi, India', '$2y$10$qOhi9tbxxvvsxzljFlauneOhNU2R01P/.eKx7D.ZgFSJ3ZuitExLe', 'null', '5ff1f69db3ac11609692', '2021-01-04 00:12:04'),
(15, 'Greta', 'Life', '14', 'Male', '6', '8', '7845321009', 'GretaLife@gmail.com', 'Laxmi Nagar, New Delhi, India', '$2y$10$8IN6cf4/IMCjsDtoP8NGI.WhgykGVKDeaVJg0lBYNBsqQfwNRrOb6', 'null', '5ff1f7eae57c01609693', '2021-01-04 00:12:06'),
(16, 'Shonda', 'Leer', '14', 'Male', '6', '7', '6755443287', 'ShondaLeer@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$LLQ.SGFgMxnjKRa4rigrX.1HVb5WgN7kkHaF4wL3XKuk8yHDJzbAi', 'null', '5ff1f96886cc61609693', '2021-01-04 00:12:07'),
(17, 'Maya', 'Didas', '15', 'Male', '6', '6', '8890076541', 'MayaDidas@gmail.com', 'Zakir Nagar, New Delhi, Delhi', '$2y$10$TBo/l4FlOo9XKdOzEnuYveK2xpf9J5eAp/t2.5AOShvjdGwO95mU2', 'null', '5ff1fb0ac0c751609693', '2021-01-04 00:12:09'),
(18, 'Monty ', 'Carlo', '14', 'Male', '6', '5', '5789000987', 'Monty_carlo@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$0j7wZvyNV6/XlDh/lgJYtO//NyeEFY9z9kc7c88c0i6RHwGSZxn6i', 'null', '5ff1fc97677ba1609694', '2021-01-04 00:12:11'),
(19, 'Brock', 'Lee', '14', 'Male', '6', '4', '7654545400', 'BrockLee@gmail.com', 'Hauz Khas, New Delhi, India', '$2y$10$Pc7ZbcyfTI8n2HmgzuXwOuxT1Y44px45AOLa.7xWM/tr9ZB3i1JT6', 'null', '5ff1fa5705cc41609693', '2021-01-04 00:12:14'),
(20, 'Ira', 'Membrit', '13', 'Male', '6', '3', '8866710091', 'IraMembrit@gmail.com', 'Ashram, New Delhi, India', '$2y$10$wCj2ph4mE23GwMlr3ENSyOFBzUbMgI6hNiNR2YsRpWJ7a2bRN.Kom', 'null', '5ff1f8fb140e91609693', '2021-01-04 00:12:16'),
(21, 'Rick', 'O&#39;Shea', '12', 'Male', '6', '2', '4009876123', 'RickOShea@gmail.com', 'Jamia Nagar, New Delhi, Delhi', '$2y$10$zHEUz.MnGgxQJF2k1YMAs.GYHFiBUulRhTqseuNRUy4lO/nHAOM/O', 'null', '5ff1fb806f0be1609694', '2021-01-04 00:12:19'),
(22, 'Pete', 'Sariya', '11', 'Male', '6', '10', '7000932123', 'Pete_Sariya@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$7Vmex5Rg6F.7CHGHce/Z3eYABnVlyEE/2neTf/XwCz46ol81Z0tVG', 'null', '5ff1fc379df611609694', '2021-01-04 00:12:21'),
(23, 'Sal', 'Monella ', '11', 'Male', '8', 'null', '6000981212', 'Sal_Monella@gmail.com', 'Hauz Khas, New Delhi, India', '$2y$10$WlIvFPC/O1VYRkcibxFiO..4sFjjZI7ZU9dIRHkjA9d./csQxk5AS', 'null', '5ff1fd190f06c1609694', '2021-01-04 00:12:34'),
(24, 'Sue  ', 'Vaneer', '12', 'Male', '8', 'null', '9054123212', 'SueVaneer@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$3dbBhhG5/FkxZH75f3n.rOunsP5Q4/yRDF/A4x3/PKC584W1wszSy', 'null', '5ff1fd68937c71609694', '2021-01-04 00:12:36'),
(25, 'Jimmy', 'Changa', '11', 'Male', '8', 'null', '7890091212', 'Jimmy_Changa@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$ciscH1Kw13iHZvgOJtI0uuBleuqDJjuizuvO6vgjo8eO1EOA5LtYe', 'null', '5ff200fd46c321609695', '2021-01-04 00:12:41'),
(26, 'Cliff', 'Hanger', '16', 'Male', '8', 'null', '8765432100', 'CliffHanger@gmail.com', 'Hauz Khas, Malviya Nagar, India', '$2y$10$kt6KmwOiw/eGpby.5jyC7OIm98dovqtWOD4nSy/Hy3dUcKwkxBtrS', 'null', '5ff1fdb80a6dd1609694', '2021-01-04 00:12:44'),
(27, 'Barb', 'Dwyer', '15', 'Male', '8', 'null', '6000981234', 'BarbDwyer@gmail.com', 'Ashok Nagar, New Delhi, India', '$2y$10$lLCb1EX2KS6I5sxyBxuuw.vB7ZlPfq5c47n9H8Q40U07dcBunFO9q', 'null', '5ff1fef4d4bc01609694', '2021-01-04 00:12:46'),
(28, 'Barry ', 'Wine', '14', 'Male', '8', 'null', '8000900985', 'BarryWine@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$EIAtdtX6jXFRyhnq5xI0cOFZJXZoGh9YVCpi4k4une9QnWWNz4Mw.', 'null', '5ff20153a47011609695', '2021-01-04 00:12:48'),
(29, 'Robin', 'Banks', '13', 'Male', '8', 'null', '7009876543', 'RobinBanks@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$e.DRjTg72/IY3x3SgfHbjug3TOyygWSfIbYvVgvlkPFpC/ux8W8Ky', 'null', '5ff20088c65d61609695', '2021-01-04 00:12:50'),
(30, 'Terry', 'Aki', '13', 'Male', '8', 'null', '8009812345', 'TerryAki@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$DEte5jeX26nYbJ.gJAKIiulNhTva53PTEJRDB/Tk5/CQYGs4pKLRO', 'null', '5ff1ff56ae2121609695', '2021-01-04 00:12:52'),
(31, 'Cory  ', 'Ander', '14', 'Male', '8', 'null', '6009876543', 'CoryAnder@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$CXXl04YJ6ftqaf44bta/SuwPJnjHkSGyp53iiYZUvTBBrGxCIjXp6', 'null', '5ff1ffefca77b1609695', '2021-01-04 00:12:54'),
(32, 'Wilma ', 'Mumduya', '16', 'Male', '8', 'null', '7676765431', 'WilmaMumduya@gmail.com', 'Malviya Nagar, New Delhi, India', '$2y$10$HyrjcENSVTQ2lsSNGuL4J.j9/sMd2J7/l4Exwa/L95oTF0zcLbhTS', 'null', '5ff201ae4a43e1609695', '2021-01-04 00:12:56'),
(33, 'Buster ', 'Hyman', '14', 'Male', '8', 'null', '7898761200', 'BusterHyman@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$lls6jVHJcbrGhNYXxyCzPe3pE4vbpPK10yj3/GAktGQu84BW04aEm', 'null', '5ff201ea7a48b1609695', '2021-01-04 00:12:57'),
(34, 'Tom', 'Foolery', '15', 'Male', '10', 'null', '9000987654', 'TomFoolery@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$KpAkkv7TeZsjTjdczG6j4O7BDXpNk1/0Ovxw8qe7s4W19BHudotcy', 'null', '5ff20dc7b74311609698', '2021-01-04 00:13:14'),
(35, 'Saul', 'T. Balls', '14', 'Male', '10', 'null', '6667887609', 'SaulT.Balls@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$GePeh3RWdlCZAvKIqOU7QulBCczp4KtvkPiq2JvOfEe1flNb1hk7u', 'null', '5ff20b4689da91609698', '2021-01-04 00:13:16'),
(36, 'Peter', 'Pants', '14', 'Male', '10', 'null', '8889990798', 'PeterPants@gmail.com', 'Zakir Nagar, New Delhi, Delhi', '$2y$10$phYgHm/k.Bs3HhAt46zycubJZIJ.JQNSLSf1HE68JCkjz8XeGmNNe', 'null', '5ff20bc8ca0f51609698', '2021-01-04 00:13:17'),
(37, 'Hal ', 'Appeno', '17', 'Male', '10', 'null', '9996754123', 'HalAppeno@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$8XzT0ckJkKrmvVWCLG2bMeEaOMUPwvKLPqQqcRlh6L4YkJIhdRH2q', 'null', '5ff20c1658df71609698', '2021-01-04 00:13:20'),
(38, 'Otto ', 'Matic', '15', 'Male', '10', 'null', '9999453212', 'OttoMatic@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$GWvMgsRs/2Q3DwNtmHdrW./c4lv.zwQiFQLdi84ElGAmACCtGezWy', 'null', '5ff20c900a7031609698', '2021-01-04 00:13:22'),
(39, 'Poppa ', 'Cherry', '15', 'Male', '10', 'null', '6754443211', 'PoppaCherry@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$C.3kREgXgEdGBAM7d8fLzO7TJ/RYJpxBA2ecTA7U2KF0K.bA0knv.', 'null', '5ff20a64951041609697', '2021-01-04 00:13:26'),
(40, 'Zack', 'Lee', '14', 'Male', '10', 'null', '4098765412', 'ZackLee@gmail.com', 'Zakir Nagar, New Delhi, India', '$2y$10$CDSjQjYsyWD24hak0wB7m.PhsFoews6iknei9.UNv3Wy5D1hYOBxm', 'null', '5ff20ab6576521609697', '2021-01-04 00:13:29'),
(41, 'Moe', 'Fugga', '14', 'Male', '10', 'null', '7777654120', 'MoeFugga@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$GBbZq3zQ2Oq/4Jv5sEui4.eN4w1Fl6yL3DgoeVYNJan7DU0FpDHVG', 'null', '5ff20d2cc87491609698', '2021-01-04 00:13:32'),
(42, 'Don ', 'Stairs', '15', 'Male', '10', 'null', '8997765111', 'DonStairs@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$jP1P53BLY442L6cuB3kWOuv1T4wLqF7iZ2m7Gg.zuPRDYTrWBysOK', 'null', '5ff20afb94b111609698', '2021-01-04 00:13:35'),
(43, 'Graham', 'Cracker', '14', 'Male', '10', 'null', '6677789001', 'GrahamCracker@gmail.com', 'Lajpat Nagar, New Delhi, India', '$2y$10$UbQjNa.M7n0w5MMdgWcT4.Jr40W1.TdAesfvG8Ok6nfRlgppoEx6K', 'null', '5ff20d65beb121609698', '2021-01-04 00:13:40');

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
(1, 'Akash', 'Kumar', 'Male', '9999000765', 'akashKumar65@gmail.com', 'akash_kumar6248', '$2y$10$MwG/mjCYSRf7/2pJ3OwjzOmLno94qLHG91vQz.WSW5qPw2WuISUQa', 'Lajpat Nagar, New Delhi, India', 'active', 5, 2, '77447d6323cde0bded27978ce6371afe', '2021-01-04 00:31:25', '2021-01-04 12:31:25'),
(2, 'Akram ', 'Khan', 'Male', '6754000987', 'akram3877@gmali.com', 'akram949978 ', '$2y$10$Tm2JOlpzTnyQaOrKwBrafOWdlUfVjTBVvIUV.CQ/aatXmB7yn8y8O', 'Lajpat Nagar, New Delhi, India', 'active', 5, 1, 'c11c6f1526ba48e57e879c300c4ad452', '2021-01-04 20:53:16', '2021-01-04 08:53:17');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `new_registration`
--
ALTER TABLE `new_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
