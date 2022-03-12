-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 09. Mrz 2022 um 16:36
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `terminkalender`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `statusmoeglichkeiten`
--

CREATE TABLE `statusmoeglichkeiten` (
  `status_pk` tinyint(2) UNSIGNED NOT NULL,
  `beschreibung` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `statusmoeglichkeiten`
--

INSERT INTO `statusmoeglichkeiten` (`status_pk`, `beschreibung`) VALUES
(3, 'abgesagt'),
(2, 'abgeschlossen'),
(1, 'unerledigt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `termine`
--

CREATE TABLE `termine` (
  `termin_pk` int(10) UNSIGNED NOT NULL,
  `beschreibung` varchar(300) NOT NULL,
  `datum` date NOT NULL,
  `zeit` time NOT NULL,
  `status_fk` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `termine`
--

INSERT INTO `termine` (`termin_pk`, `beschreibung`, `datum`, `zeit`, `status_fk`) VALUES
(1, 'Vorstellungsgespräch mit SkateDeluxe', '2022-02-09', '10:00:00', 2),
(2, 'Physiotherapie', '2022-03-04', '16:00:00', 2),
(3, 'PCR Test', '2022-03-13', '11:30:00', 1),
(4, 'BBQ Party', '2022-03-26', '15:00:00', 3);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `statusmoeglichkeiten`
--
ALTER TABLE `statusmoeglichkeiten`
  ADD PRIMARY KEY (`status_pk`),
  ADD KEY `statusindex` (`beschreibung`);

--
-- Indizes für die Tabelle `termine`
--
ALTER TABLE `termine`
  ADD PRIMARY KEY (`termin_pk`),
  ADD KEY `beschreibungindex` (`beschreibung`),
  ADD KEY `datumindex` (`datum`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `termine`
--
ALTER TABLE `termine`
  MODIFY `termin_pk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
