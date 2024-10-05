-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 12:45 AM
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
(3, 'Halo Gaes', 'driannsa@1.com', 'driannsa', '202cb962ac59075b964b07152d234b70', '0000-00-00 00:00:00'),
(5, 'John Doe', 'admin@gmail.com', 'johndoe', '202cb962ac59075b964b07152d234b70', '0000-00-00 00:00:00');

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
(1867, 'Urasawa, Naoki', '2024-10-05 22:06:17', NULL),
(1868, 'Miura, Kentarou', '2024-10-05 22:16:35', NULL),
(1874, 'Arakawa, Hiromu', '2024-10-05 22:22:22', NULL),
(1881, 'Oda, Eiichiro', '2024-10-05 22:22:22', NULL),
(1911, 'Inoue, Takehiko', '2024-10-05 22:16:35', NULL),
(1939, 'Azuma, Kiyohiko', '2024-10-05 22:20:22', NULL),
(2034, 'Yukimura, Makoto', '2024-10-05 22:22:22', NULL),
(2139, 'Akasaka, Aka', '2024-10-05 22:20:22', NULL),
(2318, 'Fujisawa, Tooru', '2024-10-05 22:20:22', NULL),
(2619, 'Araki, Hirohiko', '2024-10-05 22:16:35', NULL),
(2836, 'Asano, Inio', '2024-10-05 22:22:22', NULL),
(2891, 'Umino, Chica', '2024-10-05 22:20:22', NULL),
(3751, 'Natsumi, Kei', '2024-10-05 22:20:22', NULL),
(4017, 'Kajiwara, Ikki', '2024-10-05 22:22:22', NULL),
(5092, 'Ryukishi07', '2024-10-05 22:20:22', NULL),
(5254, 'NISIO, ISIN', '2024-10-05 22:20:22', NULL),
(5760, 'Yoshikawa, Eiji', '2024-10-05 22:16:35', NULL),
(6217, 'Chiba, Tetsuya', '2024-10-05 22:22:22', NULL),
(7108, 'Inoue, Kenji', '2024-10-05 22:22:22', NULL),
(8260, 'Furudate, Haruichi', '2024-10-05 22:20:22', NULL),
(8594, 'VOFAN', '2024-10-05 22:20:22', NULL),
(10951, 'Ooima, Yoshitoki', '2024-10-05 22:20:22', NULL),
(14715, 'Hara, Yasuhisa', '2024-10-05 22:22:22', NULL),
(16441, 'Yoshioka, Kimitake', '2024-10-05 22:22:22', NULL),
(16515, 'Ichikawa, Haruko', '2024-10-05 22:22:22', NULL),
(41857, 'Miaki, Sugaru', '2024-10-05 22:20:22', NULL),
(48825, 'Mo Xiang Tong Xiu', '2024-10-05 22:20:22', NULL),
(49592, 'Studio Gaga', '2024-10-05 22:16:35', NULL),
(53209, 'sing N song', '2024-10-05 22:22:22', NULL),
(56093, 'STARember', '2024-10-05 22:20:22', NULL),
(67763, 'Ai Qianshui de Wuzei', '2024-10-05 22:22:22', NULL);

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
(40, 'Berserk', 1, 1868, 2, NULL, 'https://cdn.myanimelist.net/images/manga/1/157897.jpg', '2024-10-05 22:34:04', NULL),
(41, 'JoJo no Kimyou na Bouken Part 7: Steel Ball Run', 1, 2619, 1706, NULL, 'https://cdn.myanimelist.net/images/manga/3/179882.jpg', '2024-10-05 22:35:13', NULL),
(42, 'Vagabond', 1, 1911, 656, NULL, 'https://cdn.myanimelist.net/images/manga/1/259070.jpg', '2024-10-05 22:35:13', NULL),
(43, 'One Piece', 1, 1881, 13, NULL, 'https://cdn.myanimelist.net/images/manga/2/253146.jpg', '2024-10-05 22:35:13', NULL),
(44, 'Monster', 46, 1867, 1, NULL, 'https://cdn.myanimelist.net/images/manga/3/258224.jpg', '2024-10-05 22:35:13', NULL),
(45, 'Vinland Saga', 1, 2034, 642, NULL, 'https://cdn.myanimelist.net/images/manga/2/188925.jpg', '2024-10-05 22:35:13', NULL),
(46, 'Slam Dunk', 46, 1911, 51, NULL, 'https://cdn.myanimelist.net/images/manga/2/258749.jpg', '2024-10-05 22:35:13', NULL),
(47, 'Tian Guan Cifu', 1, 48825, 130826, NULL, 'https://cdn.myanimelist.net/images/manga/3/258775.jpg', '2024-10-05 22:35:13', NULL),
(48, 'Fullmetal Alchemist', 1, 1874, 25, NULL, 'https://cdn.myanimelist.net/images/manga/3/243675.jpg', '2024-10-05 22:35:13', NULL),
(49, 'Grand Blue', 4, 7108, 70345, NULL, 'https://cdn.myanimelist.net/images/manga/2/166124.jpg', '2024-10-05 22:35:13', NULL),
(50, 'Guimi Zhi Zhu', 1, 67763, 162032, NULL, 'https://cdn.myanimelist.net/images/manga/2/287344.jpg', '2024-10-05 22:35:13', NULL),
(51, 'Omniscient Reader\'s Viewpoint', 1, 53209, 143441, NULL, 'https://cdn.myanimelist.net/images/manga/1/265768.jpg', '2024-10-05 22:35:13', NULL),
(52, 'Kingdom', 1, 14715, 16765, NULL, 'https://cdn.myanimelist.net/images/manga/2/171872.jpg', '2024-10-05 22:35:13', NULL),
(53, 'Oyasumi Punpun', 8, 2836, 4632, NULL, 'https://cdn.myanimelist.net/images/manga/3/266834.jpg', '2024-10-05 22:35:13', NULL),
(54, 'Houseki no Kuni', 1, 16515, 44489, NULL, 'https://cdn.myanimelist.net/images/manga/1/115443.jpg', '2024-10-05 22:35:13', NULL),
(55, 'Real', 46, 1911, 657, NULL, 'https://cdn.myanimelist.net/images/manga/2/115969.jpg', '2024-10-05 22:35:13', NULL),
(56, '20th Century Boys', 46, 1867, 3, NULL, 'https://cdn.myanimelist.net/images/manga/5/260006.jpg', '2024-10-05 22:35:13', NULL),
(57, 'Ashita no Joe', 8, 4017, 1303, NULL, 'https://cdn.myanimelist.net/images/manga/1/268827.jpg', '2024-10-05 22:35:13', NULL),
(58, 'Mo Dao Zu Shi', 1, 48825, 121405, NULL, 'https://cdn.myanimelist.net/images/manga/3/258745.jpg', '2024-10-05 22:35:13', NULL),
(59, 'Monogatari Series: First Season', 1, 5254, 14893, NULL, 'https://cdn.myanimelist.net/images/manga/2/279887.jpg', '2024-10-05 22:35:13', NULL),
(60, 'Monogatari Series: Second Season', 4, 5254, 23751, NULL, 'https://cdn.myanimelist.net/images/manga/2/181553.jpg', '2024-10-05 22:35:13', NULL),
(61, 'Yotsuba to!', 46, 1939, 104, NULL, 'https://cdn.myanimelist.net/images/manga/5/259524.jpg', '2024-10-05 22:35:13', NULL),
(62, 'Kaguya-sama wa Kokurasetai: Tensai-tachi no Renai Zunousen', 46, 2139, 90125, NULL, 'https://cdn.myanimelist.net/images/manga/3/188896.jpg', '2024-10-05 22:35:13', NULL),
(63, 'Mikkakan no Koufuku', 8, 41857, 126479, NULL, 'https://cdn.myanimelist.net/images/manga/3/248674.jpg', '2024-10-05 22:35:13', NULL),
(64, 'Umineko no Naku Koro ni Chiru - Episode 8: Twilight of the Golden Witch', 8, 3751, 34053, NULL, 'https://cdn.myanimelist.net/images/manga/3/206205.jpg', '2024-10-05 22:35:13', NULL),
(65, 'Yokohama Kaidashi Kikou', 46, 1869, 4, NULL, 'https://cdn.myanimelist.net/images/manga/1/171813.jpg', '2024-10-05 22:35:56', NULL),
(66, 'Hajime no Ippo', 46, 1876, 7, NULL, 'https://cdn.myanimelist.net/images/manga/2/250313.jpg', '2024-10-05 22:35:56', NULL),
(67, 'Full Moon wo Sagashite', 4, 1878, 8, NULL, 'https://cdn.myanimelist.net/images/manga/3/175970.jpg', '2024-10-05 22:35:56', NULL),
(68, 'Tsubasa: RESERVoir CHRoNiCLE', 1, 1877, 9, NULL, 'https://cdn.myanimelist.net/images/manga/1/272410.jpg', '2024-10-05 22:35:56', NULL),
(69, 'xxxHOLiC', 4, 1877, 10, NULL, 'https://cdn.myanimelist.net/images/manga/3/217533.jpg', '2024-10-05 22:35:56', NULL),
(70, 'Naruto', 1, 1879, 11, NULL, 'https://cdn.myanimelist.net/images/manga/3/249658.jpg', '2024-10-05 22:35:56', NULL),
(71, 'Bleach', 1, 1880, 12, NULL, 'https://cdn.myanimelist.net/images/manga/3/180031.jpg', '2024-10-05 22:35:56', NULL),
(72, 'Rave', 2, 1882, 14, NULL, 'https://cdn.myanimelist.net/images/manga/3/255624.jpg', '2024-10-05 22:35:56', NULL),
(73, 'Mahou Sensei Negima!', 1, 1883, 15, NULL, 'https://cdn.myanimelist.net/images/manga/1/259286.jpg', '2024-10-05 22:35:56', NULL),
(74, 'Love Hina', 46, 1883, 16, NULL, 'https://cdn.myanimelist.net/images/manga/1/259287.jpg', '2024-10-05 22:35:56', NULL),
(75, 'Kareshi Kanojo no Jijou', 4, 1885, 17, NULL, 'https://cdn.myanimelist.net/images/manga/1/267780.jpg', '2024-10-05 22:35:56', NULL),
(76, 'Kodomo no Omocha', 46, 1884, 18, NULL, 'https://cdn.myanimelist.net/images/manga/1/267715.jpg', '2024-10-05 22:35:56', NULL),
(77, 'GetBackers', 1, 1886, 19, NULL, 'https://cdn.myanimelist.net/images/manga/1/169369.jpg', '2024-10-05 22:35:56', NULL),
(78, 'Hikaru no Go', 46, 1888, 20, NULL, 'https://cdn.myanimelist.net/images/manga/2/170574.jpg', '2024-10-05 22:35:56', NULL),
(79, 'Death Note', 37, 1888, 21, NULL, 'https://cdn.myanimelist.net/images/manga/1/258245.jpg', '2024-10-05 22:35:56', NULL),
(80, 'Rurouni Kenshin: Meiji Kenkaku Romantan', 1, 1890, 22, NULL, 'https://cdn.myanimelist.net/images/manga/2/127583.jpg', '2024-10-05 22:35:56', NULL),
(81, 'Ranma ½', 1, 1891, 23, NULL, 'https://cdn.myanimelist.net/images/manga/1/156534.jpg', '2024-10-05 22:35:56', NULL),
(82, 'D.Gray-man', 1, 1892, 24, NULL, 'https://cdn.myanimelist.net/images/manga/3/240470.jpg', '2024-10-05 22:35:56', NULL),
(83, 'Hunter x Hunter', 1, 1893, 26, NULL, 'https://cdn.myanimelist.net/images/manga/2/253119.jpg', '2024-10-05 22:35:56', NULL),
(84, 'X', 1, 1877, 27, NULL, 'https://cdn.myanimelist.net/images/manga/2/267781.jpg', '2024-10-05 22:35:56', NULL),
(85, 'Nana', 46, 1894, 28, NULL, 'https://cdn.myanimelist.net/images/manga/1/262324.jpg', '2024-10-05 22:38:35', NULL),
(86, 'Paradise Kiss', 8, 1894, 29, NULL, 'https://cdn.myanimelist.net/images/manga/1/262323.jpg', '2024-10-05 22:38:35', NULL),
(87, 'Ouran Koukou Host Club', 4, 1895, 30, NULL, 'https://cdn.myanimelist.net/images/manga/3/267782.jpg', '2024-10-05 22:38:35', NULL),
(88, 'Lovely?Complex', 46, 1896, 31, NULL, 'https://cdn.myanimelist.net/images/manga/1/209659.jpg', '2024-10-05 22:38:35', NULL),
(89, '666 Satan', 1, 1897, 32, NULL, 'https://cdn.myanimelist.net/images/manga/3/267783.jpg', '2024-10-05 22:38:35', NULL),
(90, 'Pita-Ten', 4, 1898, 33, NULL, 'https://cdn.myanimelist.net/images/manga/3/191236.jpg', '2024-10-05 22:38:35', NULL),
(91, 'Di Gi Charat: Koushiki Comic Anthology', 4, 1898, 34, NULL, 'https://cdn.myanimelist.net/images/manga/1/267784.jpg', '2024-10-05 22:38:35', NULL),
(92, 'Kamichama Karin', 4, 1898, 35, NULL, 'https://cdn.myanimelist.net/images/manga/2/267789.jpg', '2024-10-05 22:38:35', NULL),
(93, 'Kamikaze Kaitou Jeanne', 1, 1878, 36, NULL, 'https://cdn.myanimelist.net/images/manga/2/267790.jpg', '2024-10-05 22:38:35', NULL),
(94, 'Shinshi Doumei Cross', 4, 1878, 37, NULL, 'https://cdn.myanimelist.net/images/manga/3/257940.jpg', '2024-10-05 22:38:35', NULL),
(95, '+Anima', 2, 1899, 38, NULL, 'https://cdn.myanimelist.net/images/manga/2/267791.jpg', '2024-10-05 22:38:35', NULL),
(96, 'Zombie Powder.', 1, 1880, 39, NULL, 'https://cdn.myanimelist.net/images/manga/3/180035.jpg', '2024-10-05 22:38:35', NULL),
(97, 'Black Cat', 1, 1900, 40, NULL, 'https://cdn.myanimelist.net/images/manga/2/186071.jpg', '2024-10-05 22:38:35', NULL),
(98, 'Busou Renkin', 1, 1890, 41, NULL, 'https://cdn.myanimelist.net/images/manga/2/149583.jpg', '2024-10-05 22:38:35', NULL),
(99, 'Dragon Ball', 1, 1901, 42, NULL, 'https://cdn.myanimelist.net/images/manga/1/267793.jpg', '2024-10-05 22:38:35', NULL),
(100, 'Eyeshield 21', 30, 1902, 43, NULL, 'https://cdn.myanimelist.net/images/manga/2/165586.jpg', '2024-10-05 22:38:35', NULL),
(101, 'Gintama', 1, 1904, 44, NULL, 'https://cdn.myanimelist.net/images/manga/3/267795.jpg', '2024-10-05 22:38:35', NULL),
(102, 'Ichigo 100%', 4, 1905, 45, NULL, 'https://cdn.myanimelist.net/images/manga/2/259714.jpg', '2024-10-05 22:38:35', NULL),
(103, 'Kannade', 1, 1906, 46, NULL, 'https://cdn.myanimelist.net/images/manga/3/267796.jpg', '2024-10-05 22:38:35', NULL),
(104, 'Katekyou Hitman Reborn!', 1, 1907, 47, NULL, 'https://cdn.myanimelist.net/images/manga/2/253085.jpg', '2024-10-05 22:38:35', NULL),
(105, 'Pretty Face', 4, 1908, 48, NULL, 'https://cdn.myanimelist.net/images/manga/1/123699.jpg', '2024-10-05 22:38:35', NULL),
(106, 'Tennis no Oujisama', 30, 1909, 49, NULL, 'https://cdn.myanimelist.net/images/manga/3/153238.jpg', '2024-10-05 22:38:35', NULL),
(107, 'Shaman King', 1, 1910, 50, NULL, 'https://cdn.myanimelist.net/images/manga/2/255376.jpg', '2024-10-05 22:38:35', NULL),
(108, 'Whistle!', 8, 1912, 52, NULL, 'https://cdn.myanimelist.net/images/manga/1/267799.jpg', '2024-10-05 22:38:35', NULL),
(109, 'Yuu?Yuu?Hakusho', 1, 1893, 53, NULL, 'https://cdn.myanimelist.net/images/manga/3/250027.jpg', '2024-10-05 22:38:40', NULL),
(110, 'Yu?Gi?Oh!', 1, 1913, 54, NULL, 'https://cdn.myanimelist.net/images/manga/2/262097.jpg', '2024-10-05 22:38:40', NULL),
(111, 'Aishiteruze Baby??', 4, 1914, 55, NULL, 'https://cdn.myanimelist.net/images/manga/1/166559.jpg', '2024-10-05 22:38:40', NULL),
(112, 'Caramel Diary', 4, 1915, 56, NULL, 'https://cdn.myanimelist.net/images/manga/3/261021.jpg', '2024-10-05 22:38:40', NULL),
(113, 'Hanazakari no Kimitachi e', 4, 1916, 57, NULL, 'https://cdn.myanimelist.net/images/manga/3/262555.jpg', '2024-10-05 22:38:40', NULL),
(114, 'W-Juliet', 4, 1917, 58, NULL, 'https://cdn.myanimelist.net/images/manga/3/256786.jpg', '2024-10-05 22:38:40', NULL),
(115, '?W.P.B.', 1, 1918, 59, NULL, 'https://cdn.myanimelist.net/images/manga/2/169856.jpg', '2024-10-05 22:38:40', NULL),
(116, '?', 4, 1919, 60, NULL, 'https://cdn.myanimelist.net/images/manga/1/267899.jpg', '2024-10-05 22:38:40', NULL),
(117, 'Seito no Shucho Kyoushi no Honbun', 28, 1920, 61, NULL, 'https://cdn.myanimelist.net/images/manga/2/267900.jpg', '2024-10-05 22:38:40', NULL),
(118, '± Junkie', 8, 1921, 62, NULL, 'https://cdn.myanimelist.net/images/manga/2/112127.jpg', '2024-10-05 22:38:40', NULL),
(119, '\"Aruto\" no \"A\"', 8, 1922, 63, NULL, 'https://cdn.myanimelist.net/images/manga/2/164540.jpg', '2024-10-05 22:38:40', NULL),
(120, '13 Nichi wa Kinyoubi?', 7, 1923, 64, NULL, 'https://cdn.myanimelist.net/images/manga/3/83691.jpg', '2024-10-05 22:38:40', NULL),
(121, '17-sai: Hajimete no H', 8, 2190, 65, NULL, 'https://cdn.myanimelist.net/images/manga/3/267903.jpg', '2024-10-05 22:38:40', NULL),
(122, 'Ninin ga Shinobuden', 4, 1924, 66, NULL, 'https://cdn.myanimelist.net/images/manga/3/143955.jpg', '2024-10-05 22:38:40', NULL),
(123, '2001-ya Monogatari', 8, 1925, 67, NULL, 'https://cdn.myanimelist.net/images/manga/1/267904.jpg', '2024-10-05 22:38:40', NULL),
(124, '3.3.7 Byooshi!!', 4, 1926, 68, NULL, 'https://cdn.myanimelist.net/images/manga/1/267905.jpg', '2024-10-05 22:38:40', NULL),
(125, '\"Suki\" to Ienai.', 22, 1927, 69, NULL, 'https://cdn.myanimelist.net/images/manga/2/267906.jpg', '2024-10-05 22:38:40', NULL),
(126, 'Übel Blatt', 1, 1928, 70, NULL, 'https://cdn.myanimelist.net/images/manga/2/55347.jpg', '2024-10-05 22:38:40', NULL),
(127, 'Zettai Kareshi.', 4, 1930, 71, NULL, 'https://cdn.myanimelist.net/images/manga/1/185981.jpg', '2024-10-05 22:38:40', NULL),
(128, 'Abenobashi Mahou?Shoutengai', 2, 2460, 72, NULL, 'https://cdn.myanimelist.net/images/manga/1/267907.jpg', '2024-10-05 22:38:40', NULL),
(129, 'Tenjou Tenge', 1, 1932, 73, NULL, 'https://cdn.myanimelist.net/images/manga/3/267909.jpg', '2024-10-05 22:38:40', NULL),
(130, 'Air Gear', 1, 1932, 74, NULL, 'https://cdn.myanimelist.net/images/manga/1/167489.jpg', '2024-10-05 22:38:40', NULL),
(131, 'Ai yori Aoshi', 4, 1933, 75, NULL, 'https://cdn.myanimelist.net/images/manga/3/184631.jpg', '2024-10-05 22:38:40', NULL),
(132, 'Akachan to Boku', 46, 1934, 76, NULL, 'https://cdn.myanimelist.net/images/manga/3/179184.jpg', '2024-10-05 22:38:40', NULL),
(133, 'Alice 19th', 4, 1930, 77, NULL, 'https://cdn.myanimelist.net/images/manga/3/258981.jpg', '2024-10-05 22:38:40', NULL),
(134, 'Alichino', 10, 1935, 78, NULL, 'https://cdn.myanimelist.net/images/manga/3/267910.jpg', '2024-10-05 22:38:56', NULL),
(135, 'Sora wa Akai Kawa no Hotori', 1, 1936, 79, NULL, 'https://cdn.myanimelist.net/images/manga/2/260695.jpg', '2024-10-05 22:38:56', NULL),
(136, 'Angelic Layer', 1, 1877, 80, NULL, 'https://cdn.myanimelist.net/images/manga/3/179060.jpg', '2024-10-05 22:38:56', NULL),
(137, 'Aria', 2, 1937, 81, NULL, 'https://cdn.myanimelist.net/images/manga/2/202644.jpg', '2024-10-05 22:38:56', NULL),
(138, 'Ayashi no Ceres', 46, 1930, 83, NULL, 'https://cdn.myanimelist.net/images/manga/3/160959.jpg', '2024-10-05 22:38:56', NULL),
(139, 'Fushigi Yuugi', 1, 1930, 84, NULL, 'https://cdn.myanimelist.net/images/manga/3/267911.jpg', '2024-10-05 22:38:56', NULL),
(140, 'Azumanga Daioh', 4, 1939, 85, NULL, 'https://cdn.myanimelist.net/images/manga/2/259651.jpg', '2024-10-05 22:38:56', NULL),
(141, 'Time Stranger Kyoko', 2, 1878, 86, NULL, 'https://cdn.myanimelist.net/images/manga/2/175908.jpg', '2024-10-05 22:38:56', NULL),
(142, 'Tactics', 7, 1940, 87, NULL, 'https://cdn.myanimelist.net/images/manga/3/158123.jpg', '2024-10-05 22:38:56', NULL),
(143, 'Angel/Dust', 10, 1942, 88, NULL, 'https://cdn.myanimelist.net/images/manga/1/179773.jpg', '2024-10-05 22:38:56', NULL),
(144, 'Gals!', 4, 1943, 89, NULL, 'https://cdn.myanimelist.net/images/manga/3/267912.jpg', '2024-10-05 22:38:56', NULL),
(145, 'Loveless', 28, 1944, 90, NULL, 'https://cdn.myanimelist.net/images/manga/2/171051.jpg', '2024-10-05 22:38:56', NULL),
(146, 'Marmalade Boy', 4, 1945, 91, NULL, 'https://cdn.myanimelist.net/images/manga/1/262987.jpg', '2024-10-05 22:38:56', NULL),
(147, 'Bishoujo Senshi Sailor Moon', 46, 1946, 92, NULL, 'https://cdn.myanimelist.net/images/manga/4/260613.jpg', '2024-10-05 22:38:56', NULL),
(148, 'Megami Kouhosei', 2, 1947, 93, NULL, 'https://cdn.myanimelist.net/images/manga/1/180628.jpg', '2024-10-05 22:38:56', NULL),
(149, 'D.N.Angel', 4, 1947, 94, NULL, 'https://cdn.myanimelist.net/images/manga/2/145023.jpg', '2024-10-05 22:38:56', NULL),
(150, 'Lagoon Engine', 1, 1947, 95, NULL, 'https://cdn.myanimelist.net/images/manga/2/179821.jpg', '2024-10-05 22:38:56', NULL),
(151, 'Lagoon Engine Einsatz', 1, 1947, 96, NULL, 'https://cdn.myanimelist.net/images/manga/2/179820.jpg', '2024-10-05 22:38:56', NULL),
(152, 'DearS', 4, 1948, 97, NULL, 'https://cdn.myanimelist.net/images/manga/3/265668.jpg', '2024-10-05 22:38:56', NULL),
(153, 'Rozen Maiden', 4, 1948, 98, NULL, 'https://cdn.myanimelist.net/images/manga/2/271890.jpg', '2024-10-05 22:38:56', NULL),
(154, 'Zombie-Loan', 1, 1948, 99, NULL, 'https://cdn.myanimelist.net/images/manga/3/267914.jpg', '2024-10-05 22:38:56', NULL),
(155, 'Prism Palette', 4, 1948, 100, NULL, 'https://cdn.myanimelist.net/images/manga/3/267915.jpg', '2024-10-05 22:38:56', NULL),
(156, 'Shugo Chara!', 46, 1948, 101, NULL, 'https://cdn.myanimelist.net/images/manga/2/135293.jpg', '2024-10-05 22:38:56', NULL),
(157, 'Fruits Basket', 46, 1873, 102, NULL, 'https://cdn.myanimelist.net/images/manga/3/269697.jpg', '2024-10-05 22:38:56', NULL),
(158, 'Never Give Up!', 4, 1949, 103, NULL, 'https://cdn.myanimelist.net/images/manga/1/270458.jpg', '2024-10-05 22:38:56', NULL);

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
(1, 'Action', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(2, 'Adventure', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(3, 'Racing', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(4, 'Comedy', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(5, 'Avant Garde', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(6, 'Mythology', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(7, 'Mystery', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(8, 'Drama', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(9, 'Ecchi', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(10, 'Fantasy', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(11, 'Strategy Game', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(12, 'Hentai', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(13, 'Historical', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(14, 'Horror', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(15, 'Kids', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(17, 'Martial Arts', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(18, 'Mecha', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(19, 'Music', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(20, 'Parody', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(21, 'Samurai', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(22, 'Romance', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(23, 'School', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(24, 'Sci-Fi', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(25, 'Shoujo', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(26, 'Girls Love', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(27, 'Shounen', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(28, 'Boys Love', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(29, 'Space', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(30, 'Sports', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(31, 'Super Power', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(32, 'Vampire', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(35, 'Harem', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(36, 'Slice of Life', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(37, 'Supernatural', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(38, 'Military', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(39, 'Detective', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(40, 'Psychological', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(41, 'Seinen', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(42, 'Josei', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(44, 'Crossdressing', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(45, 'Suspense', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(46, 'Award Winning', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(47, 'Gourmet', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(48, 'Workplace', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(49, 'Erotica', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(50, 'Adult Cast', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(51, 'Anthropomorphic', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(52, 'CGDCT', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(53, 'Childcare', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(54, 'Combat Sports', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(55, 'Delinquents', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(56, 'Educational', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(57, 'Gag Humor', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(58, 'Gore', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(59, 'High Stakes Game', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(60, 'Idols (Female)', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(61, 'Idols (Male)', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(62, 'Isekai', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(63, 'Iyashikei', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(64, 'Love Polygon', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(65, 'Magical Sex Shift', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(66, 'Mahou Shoujo', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(67, 'Medical', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(68, 'Memoir', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(69, 'Organized Crime', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(70, 'Otaku Culture', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(71, 'Performing Arts', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(72, 'Pets', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(73, 'Reincarnation', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(74, 'Reverse Harem', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(75, 'Love Status Quo', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(76, 'Showbiz', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(77, 'Survival', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(78, 'Team Sports', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(79, 'Time Travel', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(80, 'Video Game', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(81, 'Villainess', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(82, 'Visual Arts', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00'),
(83, 'Urban Fantasy', 1, '2024-10-05 21:53:29', '0000-00-00 00:00:00');

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
(14, 'SID002', NULL, 'jikakamutau@gmail.com', '1234sampai', '81dc9bdb52d04dc20036dbd8313ed055', 0, '2024-08-13 11:05:06', '2024-10-05 09:18:55'),
(15, 'SID003', NULL, 'jquery@gmail.com', '03842870', '73a36b5737a34f31f5bf6aeda9290d28', 0, '2024-08-13 12:59:46', '2024-09-27 09:54:12'),
(16, 'SID004', 'Bob Lenon', 'ugtalkr@yahoo.com', '1204873780', '202cb962ac59075b964b07152d234b70', 1, '2024-08-13 13:02:25', NULL),
(17, 'SID005', 'IEATPEANUTS', 'javaness@hot.com', '0128370831', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2024-08-13 13:08:12', NULL),
(18, 'SID006', 'TNT', 'tnt@tnt.com', '1234', '202cb962ac59075b964b07152d234b70', 1, '2024-10-05 05:59:50', NULL),
(19, 'SID007', 'tnt', 'tnt1@tnt1.com', '124', '202cb962ac59075b964b07152d234b70', 1, '2024-10-05 06:05:57', NULL),
(20, 'SID008', 'ACDC', 'acdc@acdc.com', '839', 'acdf11f13df3520b2accef73bc97476e', 1, '2024-10-05 06:06:27', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67764;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `tblborrow_requests`
--
ALTER TABLE `tblborrow_requests`
  MODIFY `RequestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
