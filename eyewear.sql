-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 12:10 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eyewear`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `sunglassId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `rate` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `sunglassId` int(11) NOT NULL,
  `quan` int(11) NOT NULL,
  `totalPrice` double NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `sunglassId`, `quan`, `totalPrice`, `status`) VALUES
(1, 0, 0, 2, 451.5, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `sunglasses`
--

CREATE TABLE `sunglasses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `rates` tinyint(4) NOT NULL,
  `price` double NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sunglasses`
--

INSERT INTO `sunglasses` (`id`, `name`, `brand`, `description`, `rates`, `price`, `img`) VALUES
(1, 'Marvel', 'EYE’M Cheeky', 'EYE’M Cheeky is designed exclusively for children, with an incredible attention to safety, comfort, and performance. The children brand by EYE’M does not skimp on style and innovation.', 4, 225.75, 'images/glass1.png'),
(2, 'Dash', 'Carrera', 'Since their introduction in the \'50s, Carrera\'s signature oversized shades have graced famous faces aplenty; the brand helped make Tony Montana a legend in Scarface and has been a perennial go-to for Tinseltown\'s A-list ever since.', 3, 450.75, 'images/glass2.png'),
(3, 'Elegent', 'Oliver Peoples', 'Oliver Peoples began life as a small boutique on Hollywood Boulevard peddling vintage American shades. Since setting up shop in the late \'80s.', 5, 350.5, 'images/glass3.png'),
(4, 'The cool', 'Moscot', 'For over five generations, Moscot has outfitted discerning New Yorkers—along with an increasingly global customer base—with eyewear that\'d make its founder, the Belarusian immigrant Hyman Moscot, proud. The family-run NYC institution makes some of th', 3, 150.5, 'images/glass4.png'),
(5, 'Mystery', 'Parker', 'A little over a decade ago, Warby Parker sent Big Glasses into a panic with its promise of middleman-less, affordable eyewear made with the same standards as its luxury counterparts.', 3, 200, 'images/glass5.png'),
(6, 'Steve Jobs', 'Randolph', 'Randolph Engineering has been the prime aviator plug for the Department of Defense since the \'80s. The company is still based in the small Massachusetts town it\'s named for, and its sunglasses are still manufactured with the type of military-grade pr', 4, 400, 'images/glass6.png'),
(7, 'Butterfly', 'Jacques Marie Mage', 'Eyewear obssessive Jerome Mage founded the cult-loved label in 2014, and it\'s racked up an impressive roster of high-profile clients since. (Loki scene-stealer Jonathan Majors is also a devoted fan.) Yes, these small-batch, primo-quality shades will ', 5, 435.3, 'images/glass7.png'),
(8, 'Race', 'Lexxola', 'Lexxola makes retro-inflected shades for the extremely online set, the type of tinted sunglasses algorithmically guaranteed to give you a serious bump in followers.', 3, 335.3, 'images/glass8.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `createdAt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `avatar`, `createdAt`) VALUES
(1, 'Osama Abdelhameed', 'osamaabdelhameed41@gmail.com', '0b1a9b55c74543abb1e0aaa4dc36fdea3923a42e', 'images/Osama Abdelhameed.jpg', '25-07-2022'),
(2, 'Hassan Mohamed', 'hassan@gmail.com', '0b1a9b55c74543abb1e0aaa4dc36fdea3923a42e', 'https://bit.ly/3b5dGIF', '25-07-2022');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sunglasses`
--
ALTER TABLE `sunglasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sunglasses`
--
ALTER TABLE `sunglasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
