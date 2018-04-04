-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Kwi 2018, 23:07
-- Wersja serwera: 10.1.16-MariaDB
-- Wersja PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep`
--
CREATE DATABASE IF NOT EXISTS `sklep` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sklep`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `elementy_transakcji`
--

CREATE TABLE `elementy_transakcji` (
  `IDelementy_transakcji` int(11) NOT NULL,
  `IDtransakcje` int(11) NOT NULL,
  `IDprodukty` int(11) NOT NULL,
  `iloscElementow` int(11) NOT NULL,
  `IDstatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Zrzut danych tabeli `elementy_transakcji`
--

INSERT INTO `elementy_transakcji` (`IDelementy_transakcji`, `IDtransakcje`, `IDprodukty`, `iloscElementow`, `IDstatus`) VALUES
(1, 1, 4, 7, 0),
(5, 1, 5, 3, 0),
(17, 3, 2, 2, 0),
(18, 4, 4, 1, 0),
(19, 4, 5, 8, 0),
(20, 5, 5, 1, 0),
(21, 6, 5, 1, 0),
(22, 7, 19, 14, 0),
(23, 8, 4, 4, 0),
(24, 9, 3, 1, 0),
(25, 10, 4, 5, 0),
(26, 11, 18, 1, 0),
(27, 11, 14, 5, 0),
(28, 7, 3, 1, 0),
(29, 12, 6, 1, 0),
(30, 13, 4, 3, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `IDkategoria` int(11) NOT NULL,
  `nazwaKategorii` text COLLATE utf16_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Zrzut danych tabeli `kategoria`
--

INSERT INTO `kategoria` (`IDkategoria`, `nazwaKategorii`) VALUES
(1, 'Noże'),
(2, 'Rewolwery'),
(3, 'Karabiny'),
(4, 'Broń Miotana');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `podkategoria`
--

CREATE TABLE `podkategoria` (
  `IDpodkategoria` int(11) NOT NULL,
  `nazwaPodkategorii` text COLLATE utf16_polish_ci NOT NULL,
  `IDkategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Zrzut danych tabeli `podkategoria`
--

INSERT INTO `podkategoria` (`IDpodkategoria`, `nazwaPodkategorii`, `IDkategoria`) VALUES
(1, 'EDC', 1),
(2, 'Magnum', 2),
(3, 'Motylki', 1),
(4, 'Granaty', 4),
(5, 'Walter', 2),
(6, 'Automatyczne', 3),
(7, 'Półautomatyczne', 3),
(12, 'Noże', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `IDprodukty` int(11) NOT NULL,
  `nazwa` text COLLATE utf16_polish_ci NOT NULL,
  `opisProduktu` text COLLATE utf16_polish_ci NOT NULL,
  `imageLink` text COLLATE utf16_polish_ci NOT NULL,
  `cenaNetto` float NOT NULL,
  `VAT` float NOT NULL,
  `IDkategoria` int(11) NOT NULL,
  `IDpodkategoria` int(11) NOT NULL,
  `ilosc_cala` int(11) NOT NULL,
  `ilosc_zarezerwowana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`IDprodukty`, `nazwa`, `opisProduktu`, `imageLink`, `cenaNetto`, `VAT`, `IDkategoria`, `IDpodkategoria`, `ilosc_cala`, `ilosc_zarezerwowana`) VALUES
(1, 'Model 31', 'Całkiem Niezły pistolet', 'files/images/stock.png', 1000, 0.2, 2, 5, 10, 3),
(2, 'Model 33 8-cali', 'Super Rewolwer Strzylo Jeszcze Lepij i Lepij', 'files/images/2.jpeg', 1500, 0.2, 2, 2, 5, 1),
(3, 'BenchMade 20100', 'Super Nóż Polecam', 'files/images/3.jpeg', 300, 0.1, 1, 3, 10, 4),
(4, 'Sanrenmu 710', 'Super fajny nóż. Mały ale wariat.', 'files/images/4.jpeg', 27, 0.23, 1, 1, 21, 11),
(5, 'Paramilitary 2', 'Dobry nóż ale drogi.', 'files/images/5.jpeg', 670, 0.24, 1, 1, 7, 7),
(6, 'RAT 1', 'Początek dobrych noży', 'files/images/6.jpeg', 120, 0.22, 1, 1, 14, 0),
(7, 'RAT 2', 'Nóż marzenie', 'files/images/7.jpeg', 200, 0.23, 1, 1, 20, 0),
(8, 'RAT 3', 'Całkiem niezły fixed.', 'files/images/stock.png', 130, 0.22, 1, 1, 15, 0),
(9, 'Mora BushCraft', 'Klasyka noży roboczych', 'files/images/stock.png', 120, 0.21, 1, 1, 25, 0),
(10, 'cold steel tanto', 'Fajne ostrze tanto dobrej marki.', 'files/images/stock.png', 180, 0.22, 1, 1, 15, 0),
(11, 'cold steel kudu', 'Dobra marka niskim kosztem', 'files/images/stock.png', 34, 0.23, 1, 1, 25, 0),
(12, ' M4', 'Stary dobry amerykański kolega', 'files/images/stock.png', 2500, 0.23, 3, 6, 5, 0),
(13, 'STURMGEWEHR 44', 'Stary dobry niemiecki okupant.', 'files/images/13.jpeg', 3000, 0.18, 3, 7, 5, 0),
(14, 'Granat Ogłuszający', 'Wybucha i wszystko staje się jasne.', 'files/images/stock.png', 40, 0.2, 4, 4, 30, 5),
(15, 'Kunai Joker 6', 'Bedziesz jak ninja jak to kupisz.', 'files/images/15.jpeg', 15, 0.15, 4, 12, 40, 0),
(16, 'Model 27 7,5-cala', 'Dobry Rewolwer', 'files/images/stock.png', 750, 0.23, 2, 2, 15, 0),
(17, 'BenchMade 2231', 'Nusz jak nóż', 'files/images/stock.png', 500, 0.15, 1, 3, 8, 0),
(18, 'BenchMade 203453', 'tak', 'files/images/18.jpeg', 534, 0.21, 1, 3, 12, 1),
(19, 'Szuriken', 'Do rzucania', 'files/images/19.jpeg', 2.42, 0.22, 4, 12, 11, 0),
(20, 'M4A4', 'dobry karabin', 'files/images/20.jpeg', 2340, 0.23, 3, 6, 15, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE `status` (
  `IDstatus` int(11) NOT NULL,
  `status` text COLLATE utf16_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Zrzut danych tabeli `status`
--

INSERT INTO `status` (`IDstatus`, `status`) VALUES
(0, 'W koszyku'),
(1, 'Przyjeto zamowienie'),
(2, 'Kompletowanie zamowienia'),
(3, 'Przygotowanie do wysylki'),
(4, 'Wyslano'),
(5, 'Brak towaru');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transakcje`
--

CREATE TABLE `transakcje` (
  `IDtransakcje` int(11) NOT NULL,
  `IDuzytkownicy` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `IDstatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Zrzut danych tabeli `transakcje`
--

INSERT INTO `transakcje` (`IDtransakcje`, `IDuzytkownicy`, `data`, `IDstatus`) VALUES
(1, 2, '2017-11-27 22:41:59', 4),
(3, 2, '2017-11-26 17:43:18', 4),
(4, 2, '2017-11-27 22:27:23', 1),
(5, 2, '2017-11-26 18:13:17', 5),
(6, 2, '2017-11-25 16:54:20', 1),
(7, 1, '2018-04-04 22:39:11', 1),
(8, 2, '2017-11-25 21:24:57', 0),
(9, 3, '2017-11-26 01:24:08', 0),
(10, 4, '2017-11-30 00:23:35', 4),
(11, 4, '2017-11-29 00:07:34', 2),
(12, 1, '2017-11-29 00:15:08', 4),
(13, 1, '2017-11-30 00:23:05', 1),
(14, 1, '2018-04-04 22:39:27', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uprawnienia`
--

CREATE TABLE `uprawnienia` (
  `IDuprawnienia` int(11) NOT NULL,
  `uprawnienia` text COLLATE utf16_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Zrzut danych tabeli `uprawnienia`
--

INSERT INTO `uprawnienia` (`IDuprawnienia`, `uprawnienia`) VALUES
(1, 'Administrator'),
(2, 'Uzytkownik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `IDuzytkownicy` int(11) NOT NULL,
  `login` text COLLATE utf16_polish_ci NOT NULL,
  `haslo` text COLLATE utf16_polish_ci NOT NULL,
  `IDuprawnienia` int(11) NOT NULL,
  `imie` text COLLATE utf16_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf16_polish_ci NOT NULL,
  `plec` varchar(1) COLLATE utf16_polish_ci NOT NULL,
  `wiek` tinyint(4) NOT NULL,
  `ulica` text COLLATE utf16_polish_ci NOT NULL,
  `kodPocztowy` text COLLATE utf16_polish_ci NOT NULL,
  `poczta` text COLLATE utf16_polish_ci NOT NULL,
  `miejscowosc` text COLLATE utf16_polish_ci NOT NULL,
  `adres` text COLLATE utf16_polish_ci NOT NULL,
  `wojewodztwo` text COLLATE utf16_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`IDuzytkownicy`, `login`, `haslo`, `IDuprawnienia`, `imie`, `nazwisko`, `plec`, `wiek`, `ulica`, `kodPocztowy`, `poczta`, `miejscowosc`, `adres`, `wojewodztwo`) VALUES
(1, 'admin', 'qwerty', 1, 'Jan', 'Kowalski', 'm', 25, 'Śiaka', '34-600', 'Limanowa', 'Limanowa', '69', 'Małopolskie'),
(2, 'user', 'qwerty', 2, 'Zenon', 'Tagowski', 'm', 54, 'Ilcza', '37-800', 'Kraków', 'Wieliczka', 'Ilcza 65', 'Małopolskie'),
(3, 'admin2', 'qwerty', 1, 'Anka', 'Jucz', 'k', 22, 'Takowa', '34-600', 'Limanowa', 'Limanowa', '89', 'Małopolskie'),
(4, 'user2', 'qwerty', 2, 'Aneczka', 'Juczkiewcz', 'k', 22, 'Takowa', '34-600', 'Limanowa', 'Limanowa', '89', 'Małopolskie');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `elementy_transakcji`
--
ALTER TABLE `elementy_transakcji`
  ADD PRIMARY KEY (`IDelementy_transakcji`),
  ADD KEY `IDtransakcja` (`IDtransakcje`),
  ADD KEY `IDprodukt` (`IDprodukty`),
  ADD KEY `status` (`IDstatus`);

--
-- Indexes for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`IDkategoria`);

--
-- Indexes for table `podkategoria`
--
ALTER TABLE `podkategoria`
  ADD PRIMARY KEY (`IDpodkategoria`),
  ADD KEY `IDkategoria` (`IDkategoria`);

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`IDprodukty`),
  ADD KEY `kategoria` (`IDkategoria`),
  ADD KEY `podkategoria` (`IDpodkategoria`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`IDstatus`);

--
-- Indexes for table `transakcje`
--
ALTER TABLE `transakcje`
  ADD PRIMARY KEY (`IDtransakcje`),
  ADD KEY `IDuzytkownika` (`IDuzytkownicy`),
  ADD KEY `status` (`IDstatus`);

--
-- Indexes for table `uprawnienia`
--
ALTER TABLE `uprawnienia`
  ADD PRIMARY KEY (`IDuprawnienia`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`IDuzytkownicy`),
  ADD KEY `uprawnienia` (`IDuprawnienia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `elementy_transakcji`
--
ALTER TABLE `elementy_transakcji`
  MODIFY `IDelementy_transakcji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `IDkategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `podkategoria`
--
ALTER TABLE `podkategoria`
  MODIFY `IDpodkategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `IDprodukty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT dla tabeli `status`
--
ALTER TABLE `status`
  MODIFY `IDstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `transakcje`
--
ALTER TABLE `transakcje`
  MODIFY `IDtransakcje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  MODIFY `IDuprawnienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `IDuzytkownicy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `elementy_transakcji`
--
ALTER TABLE `elementy_transakcji`
  ADD CONSTRAINT `elementy_transakcji_ibfk_1` FOREIGN KEY (`IDtransakcje`) REFERENCES `transakcje` (`IDtransakcje`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `elementy_transakcji_ibfk_2` FOREIGN KEY (`IDprodukty`) REFERENCES `produkty` (`IDprodukty`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `elementy_transakcji_ibfk_3` FOREIGN KEY (`IDstatus`) REFERENCES `status` (`IDstatus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `podkategoria`
--
ALTER TABLE `podkategoria`
  ADD CONSTRAINT `podkategoria_ibfk_1` FOREIGN KEY (`IDkategoria`) REFERENCES `kategoria` (`IDkategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `produkty_ibfk_1` FOREIGN KEY (`IDkategoria`) REFERENCES `kategoria` (`IDkategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produkty_ibfk_2` FOREIGN KEY (`IDpodkategoria`) REFERENCES `podkategoria` (`IDpodkategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `transakcje`
--
ALTER TABLE `transakcje`
  ADD CONSTRAINT `transakcje_ibfk_2` FOREIGN KEY (`IDuzytkownicy`) REFERENCES `uzytkownicy` (`IDuzytkownicy`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transakcje_ibfk_3` FOREIGN KEY (`IDstatus`) REFERENCES `status` (`IDstatus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`IDuprawnienia`) REFERENCES `uprawnienia` (`IDuprawnienia`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
