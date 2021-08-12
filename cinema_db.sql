-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2021 at 08:50 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookingtable`
--

CREATE TABLE `bookingtable` (
  `bookingId` int(11) NOT NULL,
  `timeId` int(11) DEFAULT NULL,
  `movieId` int(11) DEFAULT NULL,
  `hallId` int(11) NOT NULL,
  `bookingDate` date NOT NULL,
  `bookingTime` time NOT NULL,
  `bookingFName` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `bookingLName` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `bookingPNumber` varchar(12) COLLATE utf8_polish_ci NOT NULL,
  `place` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `bookingtable`
--

INSERT INTO `bookingtable` (`bookingId`, `timeId`, `movieId`, `hallId`, `bookingDate`, `bookingTime`, `bookingFName`, `bookingLName`, `bookingPNumber`, `place`) VALUES
(53, 11, 1, 2, '2021-06-16', '13:00:00', 'Magda', 'Miłosz', '696009480', 1),
(54, 6, 3, 2, '2021-06-15', '16:00:00', 'Magda', 'Miłosz', '696009480', 21),
(55, 6, 3, 2, '2021-06-15', '16:00:00', 'Magda 2', 'Miłosz', '696009480', 21),
(56, 6, 3, 2, '2021-06-15', '16:00:00', 'Magda 2', 'Miłosz', '696009480', 23);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacktable`
--

CREATE TABLE `feedbacktable` (
  `msgID` int(12) NOT NULL,
  `senderfName` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `senderlName` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `sendereMail` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `senderfeedback` varchar(500) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `feedbacktable`
--

INSERT INTO `feedbacktable` (`msgID`, `senderfName`, `senderlName`, `sendereMail`, `senderfeedback`) VALUES
(1, 'Alicja', 'Kowalska', 'Alicja@wp.pl', 'Aliko'),
(2, 'Adam', 'Kowalski', 'adamkow@wp.pl', 'AdamKow'),
(4, 'Marek', 'Kowalski', 'Mareczko123@o2.pl', 'Mareczek'),
(5, 'Marlena', 'Puzon', 'Marlenka123@wp.pl', 'Marloo'),
(7, 'Paulina', 'Kowalska', 'Paula12@onet.pl', 'Paulinka12'),
(8, 'Natalia', 'Migas', 'mogasnat@wp.pl', 'NatalkaMigas'),
(9, 'Piotr', 'Kowalski', 'Pioter12@wp.pl', 'Pioter12'),
(11, 'xxx', 'xxx', 'xxxx', 'xxx');

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `places` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `name`, `places`) VALUES
(1, 'Sala numer 1', 10),
(2, 'Sala numer 2', 25),
(3, 'Sala numer 3', 15),
(4, 'Sala numer 4', 30);

-- --------------------------------------------------------

--
-- Table structure for table `movietable`
--

CREATE TABLE `movietable` (
  `movieID` int(11) NOT NULL,
  `movieImg` varchar(150) COLLATE utf8_polish_ci NOT NULL,
  `movieTitle` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `movieCountry` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `movieDuration` int(11) NOT NULL,
  `movieYearofProd` int(11) NOT NULL,
  `movieGenre` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `movieDescription` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `movieRelDate` date NOT NULL,
  `hall` int(11) NOT NULL,
  `seansTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `movietable`
--

INSERT INTO `movietable` (`movieID`, `movieImg`, `movieTitle`, `movieCountry`, `movieDuration`, `movieYearofProd`, `movieGenre`, `movieDescription`, `movieRelDate`, `hall`, `seansTime`) VALUES
(1, 'img/movie-poster-1.jpg', 'Parasite', 'Stany Zjednoczone', 144, 2019, 'Dramat', 'Kiedy Ki-woo dostaje pracę jako korepetytor córki zamożnego małżeństwa, wymyśla sposób na zapewnienie zatrudnienia również reszcie swojej rodziny.', '2021-06-16', 1, '12:00:00'),
(2, 'img/movie-poster-2.jpg', 'Historia Małżeńska', 'Wielka Brytania', 100, 2019, 'Dramat', 'Po dziesięciu latach małżeństwo Nicole i Charliego zaczyna się rozpadać, gdy pojawiaja się przed nimi nowe opcje kariery.', '2021-07-16', 2, '17:00:00'),
(3, 'img/movie-poster-3.jpg', 'Le Mans 66', 'Holandia', 120, 2019, 'Biograficzny', 'Na zlecenie Henryego Forda II amerykański projektant Carroll Shelby i brytyjski kierowca Ken Miles podejmują wyzwanie pokonania samochodów ekipy Ferrari w 24-godzinnym wyścigu Le Mans. ', '2021-07-15', 2, '16:00:00'),
(4, 'img/movie-poster-4.jpg', 'Pewnego razu… w Hollywood', 'Stany Zjednoczone', 170, 2019, 'Krymina?', 'Aktor Rick Dalton i jego przyjaciel kaskader powracaja do Hollywood. Mężczyżni próbuja odnaleźć się w przemyśle filmowym, który ewoluował podczas ich nieobecności.', '2021-07-16', 3, '14:00:00'),
(5, 'img/movie-poster-5.jpg', 'Nomadland', 'Wielka Brytania', 130, 2021, 'Dramat', 'Kobieta po sześćdziesiątce wybiera wedrowne zycie współczesnego nomady, po tym jak w wyniku recesji straciła swój dobytek.', '2021-07-16', 2, '17:00:00'),
(6, 'img/movie-poster-6.jpg', 'Obiecująca. Młoda. Kobieta', 'Stany Zjednoczone', 110, 2021, 'Kryminał', 'Po tym jak tragiczne wydarzenia przekreśliły przyszłość Cassandry, młoda kobieta szuka zemsty na tych, którzy stają jej na drodze. ', '2021-07-16', 2, '18:00:00'),
(7, 'img/movie-poster-7.jpg', 'Proces Siódemki z Chicago', 'Stany Zjednoczone', 190, 2021, 'Dramat', 'Pokojowy protest przerodził się w brutalne starcie z policja, a jego organizatorzy stanęli przed sądem. Tak rozpoczął się jeden z najgłośniejszych procesów w historii. ', '2021-07-16', 3, '19:00:00'),
(8, 'img/movie-poster-8.jpg', 'Palm Springs', 'Wielka Brytania', 110, 2020, 'Komedia', 'Dwoje gości weselnych zostaje uwiezionych w pętli czasowej. Pomiedzy skazanymi na siebie ludźmi zaczyna rodzić się uczucie.', '2021-07-16', 2, '13:00:00'),
(9, 'img/movie-poster-9.jpg', 'Co w duszy gra', 'Polska', 120, 2020, 'Animowany', 'Joe Gardner prowadzi zespół muzyczny w gimnazjum. Jego prawdziwą pasja jest jednak jazz. Joe przeżywa kryzys - zaczyna zadawać sobie pytania: \"Po co tu jestem? Jaki jest cel mojego życia?\". ', '2021-07-16', 1, '20:00:00'),
(10, 'img/movie-poster-10.jpg', 'Doktor Dolittle', 'Wielka Brytania', 110, 2020, 'Familijny', 'Dr Dolittle wyrusza na mityczną wyspę, by z pomoca zwierzat,zdobyć lekarstwo na chorobę królowej Anglii. ', '2021-09-07', 3, '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `movie__halls`
--

CREATE TABLE `movie__halls` (
  `timeId` int(10) UNSIGNED NOT NULL,
  `movieID` int(11) NOT NULL,
  `halls` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `movie__halls`
--

INSERT INTO `movie__halls` (`timeId`, `movieID`, `halls`, `date`, `time`) VALUES
(1, 1, 1, '2021-06-16', '12:00:00'),
(5, 2, 2, '2021-07-16', '17:00:00'),
(6, 3, 2, '2021-07-15', '16:00:00'),
(7, 4, 3, '2021-07-16', '14:00:00'),
(8, 5, 2, '2021-07-16', '17:00:00'),
(9, 6, 2, '2021-07-16', '18:00:00'),
(10, 7, 3, '2021-07-16', '19:00:00'),
(11, 8, 2, '2021-07-16', '13:00:00'),
(12, 9, 1, '2021-07-16', '20:00:00'),
(16, 10, 3, '2021-09-07', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`) VALUES
(1, 'czajo', 'czajo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookingtable`
--
ALTER TABLE `bookingtable`
  ADD PRIMARY KEY (`bookingId`);

--
-- Indexes for table `feedbacktable`
--
ALTER TABLE `feedbacktable`
  ADD PRIMARY KEY (`msgID`),
  ADD UNIQUE KEY `msgID` (`msgID`);

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movietable`
--
ALTER TABLE `movietable`
  ADD PRIMARY KEY (`movieID`),
  ADD UNIQUE KEY `movieID` (`movieID`);

--
-- Indexes for table `movie__halls`
--
ALTER TABLE `movie__halls`
  ADD PRIMARY KEY (`timeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`user`(20));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookingtable`
--
ALTER TABLE `bookingtable`
  MODIFY `bookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `feedbacktable`
--
ALTER TABLE `feedbacktable`
  MODIFY `msgID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movietable`
--
ALTER TABLE `movietable`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `movie__halls`
--
ALTER TABLE `movie__halls`
  MODIFY `timeId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
