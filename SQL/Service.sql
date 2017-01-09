-- phpMyAdmin SQL Dump
-- version 4.6.5.2deb1+deb.cihar.com~xenial.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 09 Sty 2017, 10:05
-- Wersja serwera: 5.7.16-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `Service`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `done` tinyint(1) DEFAULT '0',
  `serviceOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `actions`
--

INSERT INTO `actions` (`id`, `name`, `price`, `done`, `serviceOrder`) VALUES
(2, 'bbb', 18.78, NULL, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneNo` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postalCode` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `houseNo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aptNo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `customer`
--

INSERT INTO `customer` (`id`, `name`, `surname`, `phoneNo`, `postalCode`, `street`, `city`, `houseNo`, `aptNo`) VALUES
(6, 'user', 'user', '123456', NULL, NULL, NULL, NULL, NULL),
(8, 'manager', 'manager', '2', NULL, NULL, NULL, NULL, NULL),
(9, 'manager', 'manager', '2', NULL, NULL, NULL, NULL, NULL),
(10, 'test', 'test', '2', NULL, NULL, NULL, NULL, NULL),
(11, 'user2', 'user2', '2', NULL, NULL, NULL, NULL, NULL),
(12, 'test2', 'test2', 'test', NULL, NULL, NULL, NULL, NULL),
(13, 'test2', 'test2', 'test', NULL, NULL, NULL, NULL, NULL),
(14, 'test2', 'test2', 'test', NULL, NULL, NULL, NULL, NULL),
(15, 'test5', 'test5', '22', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneNo` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `employee`
--

INSERT INTO `employee` (`id`, `name`, `surname`, `phoneNo`) VALUES
(5, 'qq', 'qq', '22'),
(7, 'employee', 'employee', '1234'),
(16, 'admin', 'admin', 'admin'),
(17, 'mechanic2', 'mechanic2', '2'),
(18, 'manager5', 'manager5', 'manager5'),
(19, 'mechanic4', 'mechanic4', '44');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `type`) VALUES
(6, 'user', 'user', 'user@user.pl', 'user@user.pl', 1, NULL, '$2y$13$Kc1YBhXzyH/bLWnVCdv/ueJJfDQ3pfbPe5ww2f8WYR/dXIs7x8irK', '2017-01-08 09:13:21', NULL, NULL, 'a:0:{}', 'customer'),
(7, 'employee', 'employee', 'employee@employee.pl', 'employee@employee.pl', 1, NULL, '$2y$13$V58HMuH/tG0agyRHdKVhkOHZdzmm.c5raEf4DU75HLbnHz4iCEhV6', '2017-01-05 09:58:32', NULL, NULL, 'a:0:{}', 'employee'),
(8, 'manager', 'manager', 'manager@manager.pl', 'manager@manager.pl', 1, NULL, '$2y$13$nvc1YW3JL7ZvAgAkMyJ9b.LS7eo8Q9cQlMcHly8xVqH3RseroawB2', '2017-01-07 10:03:41', NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_MANAGER\";}', 'customer'),
(9, 'manager2', 'manager2', 'manager2@manager.pl', 'manager2@manager.pl', 1, NULL, '$2y$13$e8CjueQ1CbyYa7mDfjj7OeUOk6kHcoIBLrt3JjiuHApKEDej/kR.K', NULL, NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_MANAGER\";}', 'customer'),
(10, 'test', 'test', 'test@manager.pl', 'test@manager.pl', 1, NULL, '$2y$13$Gy.8O0pnJMCqmXS2liMDDOn5IcaRuDNS00GEaBKHPV1ZWLVVeuzD2', NULL, NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_MANAGER\";}', 'customer'),
(11, 'user2', 'user2', 'user2@user.pl', 'user2@user.pl', 1, NULL, '$2y$13$vDIeXWMaMwG50hle89neAO48bo7u5/nmXUDPPfy1n68amWWW6eWDy', NULL, NULL, NULL, 'a:1:{i:0;s:9:\"ROLE_USER\";}', 'customer'),
(12, 'test2', 'test2', 'test@user.pl2', 'test@user.pl2', 1, NULL, '$2y$13$hFtlYKJOVm2Bb7HCCvv0l.eH2073HGpSDh/BesBB1zmRk9v/Gmdi.', NULL, NULL, NULL, 'a:1:{i:0;s:9:\"ROLE_USER\";}', 'customer'),
(13, 'test3', 'test3', 'test3@user.pl3', 'test3@user.pl3', 1, NULL, '$2y$13$xToDX7yxyHcjf6pnSynW5OVaDYyd.rk3iSIztDev5//TT6C9Sewb2', NULL, NULL, NULL, 'a:1:{i:0;s:9:\"ROLE_USER\";}', 'customer'),
(14, 'test4', 'test4', 'test4@user.pl3', 'test4@user.pl3', 1, NULL, '$2y$13$pAfE/YEKIMCwnk7WscDadu2misxJVrfAk3hcLy0p17XWKnEqH8bE6', NULL, NULL, NULL, 'a:1:{i:0;s:9:\"ROLE_USER\";}', 'customer'),
(15, 'test5', 'test5', 'test5@user.pl', 'test5@user.pl', 1, NULL, '$2y$13$LyQVlB9.uJFCOy57yf4InuGFJpI26SiqN.0Sly5Ul4meTCQIoJOgC', NULL, NULL, NULL, 'a:1:{i:0;s:9:\"ROLE_USER\";}', 'customer'),
(16, 'admin', 'admin', 'admin@admin.pl', 'admin@admin.pl', 1, NULL, '$2y$13$kw/1FO.uSfTPeirsmeRghudgZQbRQgTRzOVDuX9EnUUGFeJ8gicA.', '2017-01-09 08:50:16', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'employee'),
(17, 'mechanic2', 'mechanic2', 'mechanic2@mechanic.pl', 'mechanic2@mechanic.pl', 1, NULL, '$2y$13$sPuVCC11F/ujo6c4.qxPdODjewABz7.R7PFRomnQwXO89UvjifEbW', NULL, NULL, NULL, 'a:1:{i:0;s:13:\"ROLE_MECHANIC\";}', 'employee'),
(18, 'manager5', 'manager5', 'manager5@manager5.pl', 'manager5@manager5.pl', 1, NULL, '$2y$13$RvofkeardPnFM5x6YR7hB.SP7bxAH0s0I9wuTXpbqzRGB9A4cwg0S', NULL, NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_MANAGER\";}', 'employee'),
(19, 'mechanic4', 'mechanic4', 'mechanic4@mechanic.pl', 'mechanic4@mechanic.pl', 1, NULL, '$2y$13$jvy55GTQANuibq/53sEL2uDGf8zbGBEDbwkxBTm2Dh3sRe5fArDwm', NULL, NULL, NULL, 'a:1:{i:0;s:13:\"ROLE_MECHANIC\";}', 'employee');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `motorcycle`
--

CREATE TABLE `motorcycle` (
  `id` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `make` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `regPlate` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vin` varchar(17) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `motorcycle`
--

INSERT INTO `motorcycle` (`id`, `type`, `make`, `model`, `capacity`, `regPlate`, `vin`, `year`, `mileage`, `status`, `userId`) VALUES
(1, 'motocykl', 'Honda', 'CBF', 499, 'WB8885', 'ZCPCZ', 2004, 85000, 'aktywny', 6),
(4, 'motocykl', 'Honda', 'CBF', 499, 'WB8885A', 'ZCPC34', 2004, 85000, 'aktywny', 6),
(6, 'motocykl', 'Honda', 'CBF', 499, 'WB8885Aa', 'ZCPC34a', 2004, 85000, 'aktywny', 6),
(7, 'motocykl', 'Honda', 'CBF', 499, 'WB8885Aaa', 'ZCPC34aa', 2004, 86000, 'aktywny', 6),
(9, 'motocykl', 'Honda', 'CBF', 499, 'WA8885Aaaa', 'ZCPC34aaa', 2004, 85000, 'aktywny', 6),
(10, 'motocykl', 'Honda', 'CB', 500, 'WA', 'JH2', 1999, 1000000, 'Aktywny', 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(6, 'Do odbioru'),
(5, 'Gotowe'),
(4, 'Oczekujące'),
(3, 'Otwarte'),
(1, 'Planowane'),
(2, 'Przyjęte'),
(7, 'Zakończone');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` double NOT NULL,
  `serviceOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `parts`
--

INSERT INTO `parts` (`id`, `name`, `price`, `quantity`, `serviceOrder`) VALUES
(1, 'cześć', 60, 2, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `service_order`
--

CREATE TABLE `service_order` (
  `id` int(11) NOT NULL,
  `motorcycle` int(11) DEFAULT NULL,
  `mechanic` int(11) DEFAULT NULL,
  `manager` int(11) DEFAULT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `dateOfAcceptance` datetime DEFAULT NULL,
  `dateOfRelase` datetime DEFAULT NULL,
  `mileage` int(11) NOT NULL,
  `userComments` longtext COLLATE utf8_unicode_ci,
  `managerComments` longtext COLLATE utf8_unicode_ci,
  `mechanicComments` longtext COLLATE utf8_unicode_ci,
  `orderStatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `service_order`
--

INSERT INTO `service_order` (`id`, `motorcycle`, `mechanic`, `manager`, `startDate`, `endDate`, `dateOfAcceptance`, `dateOfRelase`, `mileage`, `userComments`, `managerComments`, `mechanicComments`, `orderStatus`) VALUES
(1, 1, 7, 7, '2014-03-04 17:15:00', '2015-05-13 16:00:00', '2015-03-17 16:00:00', '2021-10-21 16:15:00', 85000, 'Nie ruszaj instalacji elektrycznej', 'motocykl przy przyjęciu ma uszkodzony zbiornik', NULL, 1),
(2, 7, 17, 18, '2017-01-09 09:15:00', '2017-01-09 09:00:00', '2017-01-09 09:00:00', '2017-01-09 09:00:00', 86000, 'komentarz użytkownika', 'komentarz managera', NULL, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_548F1EFA78E786B` (`serviceOrder`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Indexes for table `motorcycle`
--
ALTER TABLE `motorcycle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_21E380E131551A66` (`regPlate`),
  ADD UNIQUE KEY `UNIQ_21E380E1B1085141` (`vin`),
  ADD KEY `IDX_21E380E164B64DCC` (`userId`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B88F75C95E237E06` (`name`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6940A7FEA78E786B` (`serviceOrder`);

--
-- Indexes for table `service_order`
--
ALTER TABLE `service_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5C5B7E7F21E380E1` (`motorcycle`),
  ADD KEY `IDX_5C5B7E7F7137DE79` (`mechanic`),
  ADD KEY `IDX_5C5B7E7FFA2425B9` (`manager`),
  ADD KEY `IDX_5C5B7E7F750AF84B` (`orderStatus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT dla tabeli `motorcycle`
--
ALTER TABLE `motorcycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT dla tabeli `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `service_order`
--
ALTER TABLE `service_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `FK_548F1EFA78E786B` FOREIGN KEY (`serviceOrder`) REFERENCES `service_order` (`id`);

--
-- Ograniczenia dla tabeli `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_81398E09BF396750` FOREIGN KEY (`id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_5D9F75A1BF396750` FOREIGN KEY (`id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `motorcycle`
--
ALTER TABLE `motorcycle`
  ADD CONSTRAINT `FK_21E380E164B64DCC` FOREIGN KEY (`userId`) REFERENCES `customer` (`id`);

--
-- Ograniczenia dla tabeli `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `FK_6940A7FEA78E786B` FOREIGN KEY (`serviceOrder`) REFERENCES `service_order` (`id`);

--
-- Ograniczenia dla tabeli `service_order`
--
ALTER TABLE `service_order`
  ADD CONSTRAINT `FK_5C5B7E7F21E380E1` FOREIGN KEY (`motorcycle`) REFERENCES `motorcycle` (`id`),
  ADD CONSTRAINT `FK_5C5B7E7F7137DE79` FOREIGN KEY (`mechanic`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `FK_5C5B7E7F750AF84B` FOREIGN KEY (`orderStatus`) REFERENCES `order_status` (`id`),
  ADD CONSTRAINT `FK_5C5B7E7FFA2425B9` FOREIGN KEY (`manager`) REFERENCES `employee` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
