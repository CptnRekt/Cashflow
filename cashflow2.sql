-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Sty 2022, 16:29
-- Wersja serwera: 10.4.20-MariaDB
-- Wersja PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `cashflow2`
--
CREATE DATABASE IF NOT EXISTS `cashflow2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cashflow2`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie_transakcji`
--

CREATE TABLE `kategorie_transakcji` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) DEFAULT NULL,
  `id_konta_uzytkownika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kategorie_transakcji`
--

INSERT INTO `kategorie_transakcji` (`id`, `nazwa`, `id_konta_uzytkownika`) VALUES
(4, 'Leczenie', NULL),
(84, 'Rodzina', 24),
(85, 'Transport', 24),
(86, 'Rachunki', 24),
(87, 'Opłaty oraz podatki', 24),
(88, 'Rozrywka', 24),
(89, 'Edukacja', 24),
(90, 'Dom', 24),
(91, 'Zdrowie', 24);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta_kredytowe`
--

CREATE TABLE `konta_kredytowe` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `opis` varchar(1000) DEFAULT NULL,
  `rodzaj_konta` varchar(100) DEFAULT NULL,
  `data_otwarcia` date DEFAULT NULL,
  `archiwum` tinyint(1) DEFAULT NULL,
  `wykres` mediumtext DEFAULT NULL,
  `saldo_poczatkowe` float(12,2) NOT NULL,
  `saldo_koncowe` float(12,2) NOT NULL,
  `laczne_przychody` float(12,2) DEFAULT NULL,
  `laczne_wydatki` float(12,2) DEFAULT NULL,
  `id_uzytkownika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `konta_kredytowe`
--

INSERT INTO `konta_kredytowe` (`id`, `nazwa`, `opis`, `rodzaj_konta`, `data_otwarcia`, `archiwum`, `wykres`, `saldo_poczatkowe`, `saldo_koncowe`, `laczne_przychody`, `laczne_wydatki`, `id_uzytkownika`) VALUES
(43, 'Firma', 'Handel samochodami', 'karta kredytowa', '2022-01-07', 0, NULL, 100000.00, 105799.49, 553000.00, 447200.50, 24),
(56, 'Gry hazardowe', 'gra w pokera, blackjacka i ruletkę', 'karta kredytowa', '2021-12-16', 0, NULL, 100.00, 200.00, 350.00, 150.00, 24),
(57, 'Giełda akcji', 'Akcje firm samochodowych', 'inwestycja', '2022-01-01', 0, NULL, 10000.00, 11499.50, 14999.50, 3500.00, 24);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta_uzytkownikow`
--

CREATE TABLE `konta_uzytkownikow` (
  `id` int(11) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `haslo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `konta_uzytkownikow`
--

INSERT INTO `konta_uzytkownikow` (`id`, `login`, `haslo`, `email`) VALUES
(24, 'janKowalski', 'qwerty', 'janKowalski@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaje_kont_kredytowych`
--

CREATE TABLE `rodzaje_kont_kredytowych` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `id_uzytkownika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `rodzaje_kont_kredytowych`
--

INSERT INTO `rodzaje_kont_kredytowych` (`id`, `nazwa`, `id_uzytkownika`) VALUES
(198, 'gotówka', 24),
(199, 'czek', 24),
(200, 'oszczędności', 24),
(201, 'karta kredytowa', 24),
(202, 'inwestycja', 24),
(203, 'pasywa finansowe', 24);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transakcje_kont_kredytowych`
--

CREATE TABLE `transakcje_kont_kredytowych` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `rodzaj_transakcji` varchar(100) NOT NULL,
  `kategoria` varchar(100) DEFAULT NULL,
  `data_transakcji` date NOT NULL,
  `kwota` float(12,2) NOT NULL,
  `wykonane` tinyint(1) DEFAULT NULL,
  `id_konta_kredytowego` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `transakcje_kont_kredytowych`
--

INSERT INTO `transakcje_kont_kredytowych` (`id`, `nazwa`, `rodzaj_transakcji`, `kategoria`, `data_transakcji`, `kwota`, `wykonane`, `id_konta_kredytowego`) VALUES
(70, 'Start', 'Przychód', 'Start', '2022-01-07', 100000.00, 0, 43),
(85, 'Kupno salonu samochodowego', 'Wydatek', 'Nieruchomości', '2022-01-08', 100000.00, 0, 43),
(86, 'Kupno samochodów', 'Wydatek', 'Handel', '2022-01-08', 200000.00, 0, 43),
(87, 'Sprzedaż Audi (id: 7)', 'Przychód', 'Sprzedaż', '2022-01-09', 20000.00, 0, 43),
(88, 'Kupno Mercedesa (id: 5)', 'Wydatek', 'Kupno', '2022-01-09', 10000.00, 0, 43),
(89, 'Sprzedaż Fiata (id: 9)', 'Przychód', 'Sprzedaż', '2022-01-10', 15000.00, 0, 43),
(90, 'Sprzedaż Renault (id:10)', 'Przychód', 'Sprzedaż', '2022-01-14', 30000.00, 0, 43),
(91, 'Naprawa Tesli', 'Wydatek', 'Naprawa', '2022-01-10', 100000.00, 0, 43),
(92, 'Sprzedaż Tesli', 'Przychód', 'Sprzedaż', '2022-01-13', 249999.98, 0, 43),
(93, 'Naprawa Mercedesa', 'Wydatek', 'Naprawa', '2022-01-13', 5000.00, 0, 43),
(94, 'Wypożyczenie pojazdu 15', 'Przychód', 'Wypożyczenie', '2022-01-09', 1500.00, 0, 43),
(97, 'Start', 'Przychód', 'Start', '2021-12-16', 100.00, 0, 56),
(98, 'Wygrana w pokera', 'Przychód', 'Rozrywka', '2021-12-17', 100.00, 0, 56),
(99, 'Przegrana w pokera', 'Wydatek', 'Rozrywka', '2021-12-19', 50.00, 0, 56),
(100, 'Wygrana w ruletkę', 'Przychód', 'Rozrywka', '2021-12-19', 150.00, 0, 56),
(101, 'Przegrana w blackjacka', 'Wydatek', 'Rozrywka', '2021-12-21', 100.00, 0, 56),
(102, 'Start', 'Przychód', 'Start', '2022-01-01', 10000.00, 0, 57),
(103, 'Kupno akcji firmy \"ABC\"', 'Wydatek', 'Kupno', '2022-01-13', 2500.00, 0, 57),
(104, 'Kupno akcji firmy \"ACB\"', 'Wydatek', 'Kupno', '2022-01-21', 1000.00, 0, 57),
(105, 'Sprzedaż akcji \"ABC\"', 'Przychód', 'Sprzedaż', '2022-01-31', 4999.50, 0, 57),
(106, 'Gaz, woda, prąd', 'Wydatek', 'Opłaty oraz podatki', '2022-02-07', 500.00, 0, 43),
(107, 'Utrzymanie strony WWW', 'Wydatek', 'Opłaty oraz podatki', '2022-02-12', 500.00, 0, 43),
(108, 'Wypożyczenie pojazdu 16', 'Przychód', 'Wypożyczenie', '2022-02-10', 2500.00, 0, 43),
(109, 'Czynsz', 'Wydatek', 'Opłaty oraz podatki', '2022-02-06', 3000.00, 0, 43),
(110, 'Sprzedaż BMW', 'Przychód', 'Sprzedaż', '2022-01-17', 15000.00, 0, 43),
(111, 'Kupno BMW (id: 18)', 'Wydatek', 'Kupno', '2022-01-11', 9500.50, 0, 43),
(112, 'Sprzedaż BMW (id: 18)', 'Przychód', 'Sprzedaż', '2022-01-12', 19000.00, 0, 43),
(113, 'Kupno Audi (id: 19)', 'Wydatek', 'Kupno', '2022-01-15', 9800.00, 0, 43),
(114, 'Kupno Volkswagena (id: 7)', 'Wydatek', 'Kupno', '2022-01-16', 8900.00, 0, 43),
(115, '3 samochody (id: 8, 9, 10)', 'Przychód', 'Sprzedaż', '2022-01-18', 100000.00, 0, 43);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie_transakcji`
--
ALTER TABLE `kategorie_transakcji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_konta_uzytkownika` (`id_konta_uzytkownika`);

--
-- Indeksy dla tabeli `konta_kredytowe`
--
ALTER TABLE `konta_kredytowe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `konta_uzytkownikow`
--
ALTER TABLE `konta_uzytkownikow`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `rodzaje_kont_kredytowych`
--
ALTER TABLE `rodzaje_kont_kredytowych`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`);

--
-- Indeksy dla tabeli `transakcje_kont_kredytowych`
--
ALTER TABLE `transakcje_kont_kredytowych`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_konta_kredytowego` (`id_konta_kredytowego`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kategorie_transakcji`
--
ALTER TABLE `kategorie_transakcji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT dla tabeli `konta_kredytowe`
--
ALTER TABLE `konta_kredytowe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT dla tabeli `konta_uzytkownikow`
--
ALTER TABLE `konta_uzytkownikow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT dla tabeli `rodzaje_kont_kredytowych`
--
ALTER TABLE `rodzaje_kont_kredytowych`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT dla tabeli `transakcje_kont_kredytowych`
--
ALTER TABLE `transakcje_kont_kredytowych`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `kategorie_transakcji`
--
ALTER TABLE `kategorie_transakcji`
  ADD CONSTRAINT `kategorie_transakcji_ibfk_1` FOREIGN KEY (`id_konta_uzytkownika`) REFERENCES `konta_uzytkownikow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `konta_kredytowe`
--
ALTER TABLE `konta_kredytowe`
  ADD CONSTRAINT `konta_kredytowe_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `konta_uzytkownikow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `rodzaje_kont_kredytowych`
--
ALTER TABLE `rodzaje_kont_kredytowych`
  ADD CONSTRAINT `rodzaje_kont_kredytowych_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `konta_uzytkownikow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `transakcje_kont_kredytowych`
--
ALTER TABLE `transakcje_kont_kredytowych`
  ADD CONSTRAINT `transakcje_kont_kredytowych_ibfk_1` FOREIGN KEY (`id_konta_kredytowego`) REFERENCES `konta_kredytowe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
