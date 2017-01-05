-- phpMyAdmin SQL Dump
-- version 4.6.5.2deb1+deb.cihar.com~xenial.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 05 Sty 2017, 13:44
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `postalCode` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `houseNo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aptNo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneNo` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `customer`
--

INSERT INTO `customer` (`id`, `name`, `surname`, `phoneNo`) VALUES
(6, 'user', 'user', '123456'),
(8, 'manager', 'manager', '2'),
(9, 'manager', 'manager', '2'),
(10, 'test', 'test', '2');

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
(7, 'employee', 'employee', '1234');

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
(6, 'user', 'user', 'user@user.pl', 'user@user.pl', 1, NULL, '$2y$13$qjFaVJKUaNiJe0oX7trHYO80veQ.T2UtyFNuphLma2Mk.iUWJOQs2', '2017-01-05 12:30:23', NULL, NULL, 'a:0:{}', 'customer'),
(7, 'employee', 'employee', 'employee@employee.pl', 'employee@employee.pl', 1, NULL, '$2y$13$V58HMuH/tG0agyRHdKVhkOHZdzmm.c5raEf4DU75HLbnHz4iCEhV6', '2017-01-05 09:58:32', NULL, NULL, 'a:0:{}', 'employee'),
(8, 'manager', 'manager', 'manager@manager.pl', 'manager@manager.pl', 1, NULL, '$2y$13$nvc1YW3JL7ZvAgAkMyJ9b.LS7eo8Q9cQlMcHly8xVqH3RseroawB2', '2017-01-05 12:30:50', NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_MANAGER\";}', 'customer'),
(9, 'manager2', 'manager2', 'manager2@manager.pl', 'manager2@manager.pl', 1, NULL, '$2y$13$e8CjueQ1CbyYa7mDfjj7OeUOk6kHcoIBLrt3JjiuHApKEDej/kR.K', NULL, NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_MANAGER\";}', 'customer'),
(10, 'test', 'test', 'test@manager.pl', 'test@manager.pl', 1, NULL, '$2y$13$Gy.8O0pnJMCqmXS2liMDDOn5IcaRuDNS00GEaBKHPV1ZWLVVeuzD2', NULL, NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_MANAGER\";}', 'customer');

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
(1, 'motocykl', 'Honda', 'CBF', 499, 'WB8885', 'ZCPC', 2004, 85000, 'aktywny', NULL),
(4, 'motocykl', 'Honda', 'CBF', 499, 'WB8885A', 'ZCPC34', 2004, 85000, 'aktywny', NULL),
(6, 'motocykl', 'Honda', 'CBF', 499, 'WB8885Aa', 'ZCPC34a', 2004, 85000, 'aktywny', NULL),
(7, 'motocykl', 'Honda', 'CBF', 499, 'WB8885Aaa', 'ZCPC34aa', 2004, 85000, 'aktywny', NULL),
(9, 'motocykl', 'Honda', 'CBF', 499, 'WA8885Aaaa', 'ZCPC34aaa', 2004, 85000, 'aktywny', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_548F1EFA78E786B` (`serviceOrder`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D4E6F818D93D649` (`user`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT dla tabeli `motorcycle`
--
ALTER TABLE `motorcycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `service_order`
--
ALTER TABLE `service_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `FK_548F1EFA78E786B` FOREIGN KEY (`serviceOrder`) REFERENCES `service_order` (`id`);

--
-- Ograniczenia dla tabeli `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_D4E6F818D93D649` FOREIGN KEY (`user`) REFERENCES `customer` (`id`);

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
