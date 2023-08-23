-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2023 at 04:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ada`
--

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `matric` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `weight` int(255) NOT NULL,
  `info` int(255) NOT NULL,
  `medications` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`medications`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`id`, `fname`, `lname`, `email`, `phone`, `age`, `matric`, `gender`, `height`, `weight`, `info`, `medications`) VALUES
(1, 'Muyiwa', 'Obaremi', 'obaremimuyiwa@gmail.com', '08097587364', 18, 'CLU190223-234', 'male', '24', 44, 0, '[{\"Name\":\"Muyiwa\",\"temp\":\"56\",\"bp\":\"112\",\"pm\":\"Paracetamol\",\"treatment\":\"Maleria\",\"frequency\":\"3\",\"duration\":\"3\",\"info\":\"Nill\",\"datetime\":\"2023-08-19T12:30\",\"end\":\"2023-08-22 12:30 PM\"}]'),
(2, 'Delight', 'Elisha', 'elisha.delight5@gmail.com', '07066547997', 19, 'CLU190225-271', 'male', '14', 55, 0, '[{\"Name\":\"Delight\",\"temp\":\"60\",\"bp\":\"50\",\"pm\":\"Paracetamol\",\"treatment\":\"Headache\",\"frequency\":\"3\",\"duration\":\"3\",\"info\":\"Nill\",\"datetime\":\"2023-08-19T12:50\",\"end\":\"2023-08-22 12:50 PM\"}]'),
(3, 'Adachukwu', 'Ezekwem', 'adachukwu5@gmail.com', '0874856268', 19, 'CLU167885-452', 'male', '16', 40, 0, '[{\"Name\":\"Adachukwu\",\"temp\":\"38\",\"bp\":\"112\",\"pm\":\"Ibuprofen\",\"treatment\":\"Cold\",\"frequency\":\"3\",\"duration\":\"3\",\"info\":\"Nill\",\"datetime\":\"2023-08-19T05:00\",\"end\":\"2023-08-22 05:00 AM\"}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
