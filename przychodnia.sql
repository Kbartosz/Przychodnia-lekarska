-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 12:29 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `przychodnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `choroby`
--

CREATE TABLE `choroby` (
  `id_choroby` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `choroby`
--

INSERT INTO `choroby` (`id_choroby`, `nazwa`, `opis`) VALUES
(1, 'Nadciśnienie', 'Podwyższone ciśnienie krwi.'),
(2, 'Cukrzyca typu 2', 'Zaburzenie metabolizmu glukozy.'),
(3, 'Zapalenie oskrzeli', 'Infekcja dolnych dróg oddechowych.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekarz`
--

CREATE TABLE `lekarz` (
  `id_lekarza` int(11) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `specjalizacja` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lekarz`
--

INSERT INTO `lekarz` (`id_lekarza`, `imie`, `nazwisko`, `specjalizacja`, `email`, `telefon`) VALUES
(1, 'Adam', 'Wiśniewski', 'Kardiolog', 'abc@gmail.com', '333333333'),
(2, 'Maria', 'Zielińska', 'Dermatolog', 'kardio@tlen.pl', '123456789');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `leki`
--

CREATE TABLE `leki` (
  `id_leku` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `dawka` varchar(50) NOT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leki`
--

INSERT INTO `leki` (`id_leku`, `nazwa`, `dawka`, `opis`) VALUES
(1, 'Ibuprofen', '200 mg', 'fajny lek'),
(2, 'Amoxicillin', '500 mg', 'spooko lek amo'),
(3, 'Metformin', '850 mg', 'meta mocna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pacjent`
--

CREATE TABLE `pacjent` (
  `id_pacjenta` int(11) NOT NULL,
  `pesel` varchar(11) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `wiek` int(11) DEFAULT NULL CHECK (`wiek` > 0 and `wiek` < 150),
  `plec` enum('M','K') NOT NULL,
  `mail` varchar(100) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pacjent`
--

INSERT INTO `pacjent` (`id_pacjenta`, `pesel`, `imie`, `nazwisko`, `wiek`, `plec`, `mail`, `haslo`) VALUES
(1, '12345678901', 'Jan', 'Kowalski', 45, 'M', 'jan.kowalski@example.com', 'haslo123'),
(2, '98765432109', 'Anna', 'Nowak', 38, 'K', 'anna.nowak@example.com', 'tajnehaslo'),
(4, '66666666666', 'eryk', 'wiekli', 55, 'M', 'eryk@ekyk.gra', '$2y$10$LIep4POladHNaMaC4ah4oez78Y3ZqSIz4EtemtuDnedqnqjPjqMse'),
(5, '22222222222', 'radek', 'wiekli', 55, 'K', 'eryk@ekyk.gramofony', '$2y$10$urLl4NmVWQPdIqE76Cc88umKdDUU1RgoklWMMolTsTY/EDwq4xMz6'),
(6, '78787878787', 'toemk', 'radny', 55, 'M', 'tom@tom.tom', '$2y$10$w0yxeqNQrw2snRjLeaEvwODZYSg/yX0nK1jc1DziUAc3nFMzHzRVO'),
(7, '23423423423', 'erym', 'tt', 76, 'M', 'rr@rr.r', '$2y$10$HxrdUAaLuLAhGIng8PkLUOmz1peZB4CbZURFAbeSuUHM1LreN3g6.'),
(8, '67867867867', 'darek', 'spoko', 56, 'M', '123@r.r', '$2y$10$32dy.Uo5inN/rcGbRpzMvOi8IfMtjLq1Fd63PbO.RqKXbRYc9K52O'),
(9, '56744567458', 'kinga', 'spoko', 88, 'K', 'kk@kk.k', '$2y$10$WbSVT50XI1UegSur6AM1SOd61CkfFDKXvE2pw4TuPSBTWyX/DkEMS');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pacjent_choroby`
--

CREATE TABLE `pacjent_choroby` (
  `id_pacjenta` int(11) NOT NULL,
  `id_choroby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pacjent_choroby`
--

INSERT INTO `pacjent_choroby` (`id_pacjenta`, `id_choroby`) VALUES
(1, 1),
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recepta_leki`
--

CREATE TABLE `recepta_leki` (
  `id_recepty` int(11) NOT NULL,
  `id_leku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recepta_leki`
--

INSERT INTO `recepta_leki` (`id_recepty`, `id_leku`) VALUES
(1, 1),
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recepty`
--

CREATE TABLE `recepty` (
  `id_recepty` int(11) NOT NULL,
  `id_pacjenta` int(11) NOT NULL,
  `id_lekarza` int(11) NOT NULL,
  `id_leku` int(11) NOT NULL,
  `data_wystawienia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recepty`
--

INSERT INTO `recepty` (`id_recepty`, `id_pacjenta`, `id_lekarza`, `id_leku`, `data_wystawienia`) VALUES
(1, 1, 1, 1, '2025-03-05'),
(2, 2, 2, 3, '2025-03-06');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wizyty`
--

CREATE TABLE `wizyty` (
  `id_wizyty` int(11) NOT NULL,
  `id_pacjenta` int(11) NOT NULL,
  `id_lekarza` int(11) NOT NULL,
  `data_wizyty` date NOT NULL,
  `godzina` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wizyty`
--

INSERT INTO `wizyty` (`id_wizyty`, `id_pacjenta`, `id_lekarza`, `data_wizyty`, `godzina`) VALUES
(3, 1, 1, '2025-03-10', '10:00:00'),
(4, 2, 2, '2025-03-12', '14:30:00'),
(5, 1, 1, '2025-04-06', '12:00:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `choroby`
--
ALTER TABLE `choroby`
  ADD PRIMARY KEY (`id_choroby`);

--
-- Indeksy dla tabeli `lekarz`
--
ALTER TABLE `lekarz`
  ADD PRIMARY KEY (`id_lekarza`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `leki`
--
ALTER TABLE `leki`
  ADD PRIMARY KEY (`id_leku`);

--
-- Indeksy dla tabeli `pacjent`
--
ALTER TABLE `pacjent`
  ADD PRIMARY KEY (`id_pacjenta`),
  ADD UNIQUE KEY `pesel` (`pesel`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indeksy dla tabeli `pacjent_choroby`
--
ALTER TABLE `pacjent_choroby`
  ADD PRIMARY KEY (`id_pacjenta`,`id_choroby`),
  ADD KEY `id_choroby` (`id_choroby`);

--
-- Indeksy dla tabeli `recepta_leki`
--
ALTER TABLE `recepta_leki`
  ADD PRIMARY KEY (`id_recepty`,`id_leku`),
  ADD KEY `id_leku` (`id_leku`);

--
-- Indeksy dla tabeli `recepty`
--
ALTER TABLE `recepty`
  ADD PRIMARY KEY (`id_recepty`),
  ADD KEY `id_pacjenta` (`id_pacjenta`),
  ADD KEY `id_lekarza` (`id_lekarza`),
  ADD KEY `id_leku` (`id_leku`);

--
-- Indeksy dla tabeli `wizyty`
--
ALTER TABLE `wizyty`
  ADD PRIMARY KEY (`id_wizyty`),
  ADD KEY `id_pacjenta` (`id_pacjenta`),
  ADD KEY `id_lekarza` (`id_lekarza`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choroby`
--
ALTER TABLE `choroby`
  MODIFY `id_choroby` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lekarz`
--
ALTER TABLE `lekarz`
  MODIFY `id_lekarza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leki`
--
ALTER TABLE `leki`
  MODIFY `id_leku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pacjent`
--
ALTER TABLE `pacjent`
  MODIFY `id_pacjenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `recepty`
--
ALTER TABLE `recepty`
  MODIFY `id_recepty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wizyty`
--
ALTER TABLE `wizyty`
  MODIFY `id_wizyty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pacjent_choroby`
--
ALTER TABLE `pacjent_choroby`
  ADD CONSTRAINT `pacjent_choroby_ibfk_1` FOREIGN KEY (`id_pacjenta`) REFERENCES `pacjent` (`id_pacjenta`),
  ADD CONSTRAINT `pacjent_choroby_ibfk_2` FOREIGN KEY (`id_choroby`) REFERENCES `choroby` (`id_choroby`);

--
-- Constraints for table `recepta_leki`
--
ALTER TABLE `recepta_leki`
  ADD CONSTRAINT `recepta_leki_ibfk_1` FOREIGN KEY (`id_recepty`) REFERENCES `recepty` (`id_recepty`),
  ADD CONSTRAINT `recepta_leki_ibfk_2` FOREIGN KEY (`id_leku`) REFERENCES `leki` (`id_leku`);

--
-- Constraints for table `recepty`
--
ALTER TABLE `recepty`
  ADD CONSTRAINT `recepty_ibfk_1` FOREIGN KEY (`id_pacjenta`) REFERENCES `pacjent` (`id_pacjenta`),
  ADD CONSTRAINT `recepty_ibfk_2` FOREIGN KEY (`id_lekarza`) REFERENCES `lekarz` (`id_lekarza`),
  ADD CONSTRAINT `recepty_ibfk_3` FOREIGN KEY (`id_leku`) REFERENCES `leki` (`id_leku`);

--
-- Constraints for table `wizyty`
--
ALTER TABLE `wizyty`
  ADD CONSTRAINT `wizyty_ibfk_1` FOREIGN KEY (`id_pacjenta`) REFERENCES `pacjent` (`id_pacjenta`),
  ADD CONSTRAINT `wizyty_ibfk_2` FOREIGN KEY (`id_lekarza`) REFERENCES `lekarz` (`id_lekarza`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
