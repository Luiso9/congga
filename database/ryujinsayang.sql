-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 12:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ryujinsayang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(2, 'Admin Name', 'admin@example.com', 'adminuser', 'e3274be5c857fb42ab72d786e281b4b8', '2024-08-06 11:16:39'),
(3, 'Halo Gaes', 'driannsa@1.com', 'driannsa', '202cb962ac59075b964b07152d234b70', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(10, 'Alexandre Dumas', '2024-08-07 09:12:58', NULL),
(11, 'Régine Pernoud', '2024-08-07 09:14:08', NULL),
(12, 'Sir Arthur Conan Doyle', '2024-08-07 09:14:48', NULL),
(17, 'Barbara W. Tuchman', '2024-08-09 18:52:42', '2024-08-27 09:20:16'),
(20, ' Nisio Isin', '2024-09-25 01:44:26', NULL),
(21, 'Say', '2024-09-27 09:50:57', NULL),
(22, 'Say', '2024-09-27 09:51:45', NULL),
(23, 'Say', '2024-09-27 09:51:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` int(11) DEFAULT NULL,
  `BookPrice` int(11) DEFAULT NULL,
  `BookCover` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `BookCover`, `RegDate`, `UpdationDate`) VALUES
(14, 'Count de Monte Cristo', 10, 10, 1, 10, 'bookcovers/images_waifu2x_art_scan_noise3_scale.png', '2024-08-09 11:38:50', NULL),
(15, 'Joan of Arc by Herself and Her Witnesses', 9, 11, 2, 12, 'bookcovers/98996_waifu2x_art_scan_noise3_scale.png', '2024-08-09 11:40:03', NULL),
(16, '	The Sign of the Four', 10, 12, 3, 14, 'bookcovers/9786021142028_cover-sherloc.jpg', '2024-08-09 11:40:52', NULL),
(17, 'The Three Musketeers', 11, 12, 5, 15, 'bookcovers/images_waifu2x_art_scan_noise3_scale (1).png', '2024-08-09 11:41:43', NULL),
(18, 'The Guns of August', 11, 17, 4, 1, 'bookcovers/40779082_waifu2x_art_scan_noise3_scale.png', '2024-09-25 01:43:56', NULL),
(19, 'Kizumonogatari', 8, 20, 6, 1, 'bookcovers/KizumonogatariFUNERAL.webp', '2024-09-25 01:47:14', '2024-09-25 01:49:21'),
(20, 'Bakemonogatari ', 10, 20, 7, 1, 'bookcovers/BakemonogatariENG.webp', '2024-09-25 01:50:26', NULL),
(21, 'Nisemonogatari', 8, 20, 8, 1, 'bookcovers/NisemonogatariENG.webp', '2024-09-25 01:59:01', NULL),
(22, 'Kabukimonogatari', 10, 20, 9, 1, 'bookcovers/KabukimonogatariENG.webp', '2024-09-25 07:20:10', NULL),
(23, 'asu', 10, 11, 31, 122, 'bookcovers/40779082_waifu2x_art_scan_noise3_scale.png', '2024-09-25 11:26:09', NULL),
(24, 'tai', 11, 12, 23, 12, 'bookcovers/__shizuku_murasaki_hunter_x_hunter_drawn_by_shiho_m429__sample-427a145480b6be6211693b9c1e', '2024-09-25 11:28:33', NULL),
(25, 'A', 9, 11, 15, 31, 'bookcovers/__shizuku_murasaki_hunter_x_hunter_drawn_by_shiho_m429__sample-427a145480b6be6211693b9c1e', '2024-09-27 09:42:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblborrow_requests`
--

CREATE TABLE `tblborrow_requests` (
  `RequestId` int(11) NOT NULL,
  `UserId` varchar(100) DEFAULT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  `RequestDate` datetime DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(8, 'Horror', 1, '2024-08-06 13:10:05', '0000-00-00 00:00:00'),
(9, 'Biography', 1, '2024-08-07 09:15:47', '0000-00-00 00:00:00'),
(10, 'Mystery', 1, '2024-08-07 09:16:00', '0000-00-00 00:00:00'),
(11, 'Historical', 1, '2024-08-07 09:16:19', '0000-00-00 00:00:00'),
(13, 'Sci-Fi', 1, '2024-08-09 12:36:15', '0000-00-00 00:00:00'),
(14, 'Thriller', 1, '2024-08-09 12:37:20', '0000-00-00 00:00:00'),
(15, 'Adventure', 1, '2024-08-09 12:37:41', '0000-00-00 00:00:00'),
(44, 'Slice of Life', 1, '2024-08-09 18:45:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `RetrunStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  `ActualReturnDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`, `ActualReturnDate`) VALUES
(1, 16, 'SID001', '2024-08-09 12:08:12', '2024-08-09 15:36:37', NULL, NULL, NULL),
(12, 16, 'SID002', '2024-08-13 11:32:57', '2024-09-25 06:06:34', 1, 12, NULL),
(13, NULL, 'SID002', '2024-08-14 00:52:19', NULL, NULL, NULL, NULL),
(14, 14, 'SID001', '2024-09-10 06:04:43', '2024-09-10 06:05:15', 1, 0, NULL),
(15, 15, 'SID001', '2024-09-25 00:56:01', '2024-09-25 04:31:41', 1, 1, NULL),
(16, 14, 'adjaowidjaw@gmailc.om', '2024-09-24 23:09:08', '2024-10-08 23:09:08', NULL, NULL, NULL),
(17, 19, 'SID001', '2024-09-25 01:05:46', '2024-09-25 06:23:54', 1, 1, NULL),
(18, 20, 'SID001', '2024-09-25 06:21:06', '2024-09-25 06:22:13', 1, 0, NULL),
(19, 21, 'SID001', '2024-09-25 01:24:03', '2024-09-25 06:24:16', 1, 1, NULL),
(20, 18, 'SID001', '2024-09-25 01:24:42', '2024-09-25 06:24:59', 1, 1, NULL),
(21, 20, 'SID001', '2024-09-25 01:39:03', '2024-09-25 12:09:42', 1, NULL, '2024-09-25 14:09:42'),
(22, 16, 'SID001', '2024-09-25 01:39:53', '2024-09-25 06:44:46', 1, 1, '2024-09-25 08:44:46'),
(23, 17, 'SID001', '2024-09-25 01:45:00', '2024-09-25 06:45:09', 1, 1, '2024-09-25 08:45:09'),
(24, 19, 'SID001', '2024-09-25 02:04:33', '2024-09-25 07:04:44', 1, 1, '2024-09-25 09:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `StudentId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(1, 'SID001', 'driannsa', 'adjaowidjaw@gmailc.om', '038012830', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2024-08-06 11:11:37', '2024-09-27 09:54:08'),
(14, 'SID002', NULL, 'jikakamutau@gmail.com', '1234sampai', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2024-08-13 11:05:06', '2024-09-27 09:54:49'),
(15, 'SID003', NULL, 'jquery@gmail.com', '03842870', '73a36b5737a34f31f5bf6aeda9290d28', 0, '2024-08-13 12:59:46', '2024-09-27 09:54:12'),
(16, 'SID004', 'Bob Lenon', 'ugtalkr@yahoo.com', '1204873780', '202cb962ac59075b964b07152d234b70', 1, '2024-08-13 13:02:25', NULL),
(17, 'SID005', 'IEATPEANUTS', 'javaness@hot.com', '0128370831', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2024-08-13 13:08:12', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblauthors`
--
ALTER TABLE `tblauthors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblborrow_requests`
--
ALTER TABLE `tblborrow_requests`
  ADD PRIMARY KEY (`RequestId`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `StudentId` (`StudentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tblborrow_requests`
--
ALTER TABLE `tblborrow_requests`
  MODIFY `RequestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
