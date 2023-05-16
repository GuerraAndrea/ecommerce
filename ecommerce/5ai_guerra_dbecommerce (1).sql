-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 12, 2023 alle 03:07
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `5ai_guerra_dbecommerce`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

CREATE TABLE `articoli` (
  `Id` int(11) NOT NULL,
  `Titolo` varchar(254) NOT NULL,
  `Descrizione` text NOT NULL,
  `Venditore` varchar(254) NOT NULL,
  `Condizione` enum('New','Usage') NOT NULL,
  `Prezzo` float NOT NULL,
  `Sconto` int(3) NOT NULL DEFAULT 0,
  `Pezzi` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `articoli`
--

INSERT INTO `articoli` (`Id`, `Titolo`, `Descrizione`, `Venditore`, `Condizione`, `Prezzo`, `Sconto`, `Pezzi`, `IdCategoria`) VALUES
(1, 'Balisong', 'sbdiuasbciubdhiubfiahdsubisabfiusabfiubffau\r\niffuiabiusabiubfiuabafiuasbcadbcjdanciabcui\r\ndlsbcisniudhfidbiudbvuyhjfbuvoidsfhbhdvkbsd\r\niuvjfduvhosdihvluifhvhudhvoidbvudhvildbhvoi\r\nefbvuidvurfehivbfuvhdfuybnfdiovbsdujeqkufho\r\npsdkgdusivudsjvoisdyudsjivlfdiojvhhvoidhviu\r\nsdhviulbvudbfiuvdfiuvhdfiubdfuiv.', 'WarZon', 'New', 10, 10, 0, 1),
(2, 'AK-47', 'efigfsuigcuicbauibcuiabciubcuisbiubciusabci\r\nsbckjsadbcicbsjacbjsbjscbjsacbjsacbjcbjksac\r\nbkjsacbjsacbjsacbjhscbsjacbshjcbjsbcsjbcjsa\r\ncbkjhclkdscòldsmvòldsvldsvldsvldsvlkdsnodsn\r\nvdsvkjdsbvjkdsbvkjdsbvjdsbvjkdsbvkjdsbjvbds\r\nkovndsklvndskovndskonvdskovnd\r\n', 'WarZon', 'New', 125, 0, 2, 2),
(3, 'C4', 'fsducdsiudsiubdoòifhsduicbsaoicoudsbdhuhsoi\r\ndhosdhvudscjihsdicsjicnjkdsbvsacluyhvdhkhds\r\nuvbaskchludshckjshfbiudshvuldskjvdhuuhvdjsl\r\nhvbjdsoivbhiudsjvhfdbhjodvnuidsovjhfujvipod\r\nshujiodshgosbduyiupiofiudsouhdiuh\r\n', 'WarZon', 'New', 70, 10, 20, 3),
(5, 'Coltello a scatto', 'fbfblsafkjdbfkckjdbjbvsdhvhbiubsdyvubeuifbs\r\nkncjksnclkxzklcnjkxcnvlkxnvjsdnvndskfndsknv\r\nifdiovdsuifoafnoisdnfoidshoidsnjsdinsdovhds\r\nknvlkxcnlkmcòlxzcòlksdpojfoidshfuiheiufgius\r\nhfojsdbfuisdguifgsui\r\n', 'WarZon', 'New', 250, 20, 5, 1),
(6, 'mp40', 'Fai un tuffo nel passato con il nostro mp40!\r\nL\'mp40 (abbreviazione del tedesco Maschinenpistole 1940,in italiano \'pistola mitragliatrice 1940\')impropriamente soprannominato Schmeisser, è una pistola mitragliatrice sviluppata e prodotta in massicce quantità durante la seconda guerra mondiale dalla Germania.', 'WarZon', 'New', 400, 30, 10, 2),
(18, 'Glock G19', 'dfiuhsdibdsindsuivbiudsnvdsuinibdunuidsbiud\r\nsbvuibdsuivbiubdvibdivbdubvudbvudbvisndiugn\r\nvihnvgueihngiunhgiuhgmuimhgfudfmecoeirghmiv\r\ngjinruvhricgmifsgisegihsgufnhrgmciesrhgsvrn\r\ngiucmegcisuhvligclivebhsv\r\n', 'WarZon', 'New', 310, 10, 2, 2),
(24, 'gsfd', 'gfdgfsg', 'sdgd', 'New', 342, 0, 4, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `Id` int(11) NOT NULL,
  `IdUtente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`Id`, `IdUtente`) VALUES
(1, NULL),
(6, NULL),
(16, NULL),
(17, NULL),
(18, NULL),
(19, NULL),
(20, NULL),
(21, NULL),
(22, NULL),
(24, NULL),
(25, NULL),
(26, NULL),
(27, NULL),
(28, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `Idc` int(11) NOT NULL,
  `Tipo` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`Idc`, `Tipo`) VALUES
(1, 'Armi Bianche'),
(2, 'Armi Da Fuoco'),
(3, 'Esplosivi'),
(4, 'Veleni'),
(5, 'Armi di precisione'),
(6, 'Mezzi');

-- --------------------------------------------------------

--
-- Struttura della tabella `contenuto`
--

CREATE TABLE `contenuto` (
  `IdArticolo` int(11) NOT NULL,
  `IdCarrello` int(11) NOT NULL,
  `Quantità` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `contenuto`
--

INSERT INTO `contenuto` (`IdArticolo`, `IdCarrello`, `Quantità`) VALUES
(2, 24, 1),
(2, 25, 1),
(3, 28, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `includi`
--

CREATE TABLE `includi` (
  `IdLista` int(11) NOT NULL,
  `IdArticolo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `lista_desideri`
--

CREATE TABLE `lista_desideri` (
  `Id` int(11) NOT NULL,
  `IdUtente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `lista_desideri`
--

INSERT INTO `lista_desideri` (`Id`, `IdUtente`) VALUES
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, NULL),
(8, NULL),
(1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `metodi_pagamento`
--

CREATE TABLE `metodi_pagamento` (
  `Id` int(11) NOT NULL,
  `Tipo` enum('PayPal','Credit Card') NOT NULL,
  `Email` varchar(319) DEFAULT NULL,
  `NumeroCarta` varchar(16) DEFAULT NULL,
  `NomeSuCarta` varchar(100) DEFAULT NULL,
  `Data` varchar(7) DEFAULT NULL,
  `IdUtente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `metodi_pagamento`
--

INSERT INTO `metodi_pagamento` (`Id`, `Tipo`, `Email`, `NumeroCarta`, `NomeSuCarta`, `Data`, `IdUtente`) VALUES
(2, 'Credit Card', NULL, '1234567812345678', 'Guerra Andrea', '2030-07', 1),
(3, 'PayPal', 'Guerra.andrea04@gmail.com', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `Id` int(11) NOT NULL,
  `Data2` timestamp NOT NULL DEFAULT current_timestamp(),
  `DataConsegna` timestamp NOT NULL DEFAULT current_timestamp(),
  `MetodoPagamento` varchar(255) NOT NULL,
  `IndirizzoConsegna` varchar(255) NOT NULL,
  `CostoSpedizione` float NOT NULL,
  `IdCarrello` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`Id`, `Data2`, `DataConsegna`, `MetodoPagamento`, `IndirizzoConsegna`, `CostoSpedizione`, `IdCarrello`) VALUES
(11, '2022-05-19 08:22:03', '2022-05-26 06:00:00', 'Paypal', 'Via Nando 2', 10, 16),
(12, '2022-05-23 11:18:22', '2022-05-24 03:22:18', 'Paypal', 'Via Nino 10', 6, 21);

-- --------------------------------------------------------

--
-- Struttura della tabella `recensioni`
--

CREATE TABLE `recensioni` (
  `Id` int(11) NOT NULL,
  `IdArticolo` int(11) NOT NULL,
  `IdUtente` int(11) NOT NULL,
  `Titolo` varchar(50) NOT NULL,
  `Stelle` enum('1','2','3','4','5') NOT NULL,
  `Commento` text NOT NULL,
  `DataComm` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `Id` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `BirthDate` date NOT NULL,
  `Email` varchar(319) NOT NULL,
  `MobilePhoneNumber` varchar(12) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Venditore` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`Id`, `Username`, `FirstName`, `LastName`, `BirthDate`, `Email`, `MobilePhoneNumber`, `Password`, `Venditore`) VALUES
(1, 'lilgue', 'Andrea', 'Guerra', '2004-01-02', 'andreaguerra2004@gmail.com', '3891236103', 'fcf1701b9d843d180c0cf69d7de5c58f', 0),
(2, 'martina', '', '', '0000-00-00', 'martina02@gmail.com', '', 'a32afbe54e4fbab0c8c44c01f5b90792', 0),
(3, 'pippo', '', '', '0000-00-00', 'pippoguge@gmail.com', '', '13fe706c5e31cd1199f863f510ea7b42', 0),
(5, 'WarZon', '', '', '0000-00-00', 'WarZon@gmail.com', '', 'e4aa8dff3ce4ce552a2508a76291776a', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ArticleCategory` (`IdCategoria`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdUser` (`IdUtente`),
  ADD KEY `CartUser` (`IdUtente`);

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`Idc`);

--
-- Indici per le tabelle `contenuto`
--
ALTER TABLE `contenuto`
  ADD PRIMARY KEY (`IdArticolo`,`IdCarrello`),
  ADD KEY `ContainCart` (`IdCarrello`);

--
-- Indici per le tabelle `includi`
--
ALTER TABLE `includi`
  ADD PRIMARY KEY (`IdLista`,`IdArticolo`),
  ADD KEY `IncludeArticle` (`IdArticolo`);

--
-- Indici per le tabelle `lista_desideri`
--
ALTER TABLE `lista_desideri`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `WishlistUser` (`IdUtente`);

--
-- Indici per le tabelle `metodi_pagamento`
--
ALTER TABLE `metodi_pagamento`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `PaymentMethodUser` (`IdUtente`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OrderCart` (`IdCarrello`);

--
-- Indici per le tabelle `recensioni`
--
ALTER TABLE `recensioni`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ReviewUser` (`IdUtente`),
  ADD KEY `ReviewArticle` (`IdArticolo`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articoli`
--
ALTER TABLE `articoli`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `Idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `lista_desideri`
--
ALTER TABLE `lista_desideri`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `metodi_pagamento`
--
ALTER TABLE `metodi_pagamento`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articoli`
--
ALTER TABLE `articoli`
  ADD CONSTRAINT `ArticleCategory` FOREIGN KEY (`IdCategoria`) REFERENCES `categorie` (`Idc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `CartUser` FOREIGN KEY (`IdUtente`) REFERENCES `utenti` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `contenuto`
--
ALTER TABLE `contenuto`
  ADD CONSTRAINT `ContainArticle` FOREIGN KEY (`IdArticolo`) REFERENCES `articoli` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ContainCart` FOREIGN KEY (`IdCarrello`) REFERENCES `carrello` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `includi`
--
ALTER TABLE `includi`
  ADD CONSTRAINT `IncludeArticle` FOREIGN KEY (`IdArticolo`) REFERENCES `articoli` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IncludeWishlist` FOREIGN KEY (`IdLista`) REFERENCES `lista_desideri` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `lista_desideri`
--
ALTER TABLE `lista_desideri`
  ADD CONSTRAINT `WishlistUser` FOREIGN KEY (`IdUtente`) REFERENCES `utenti` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `metodi_pagamento`
--
ALTER TABLE `metodi_pagamento`
  ADD CONSTRAINT `PaymentMethodUser` FOREIGN KEY (`IdUtente`) REFERENCES `utenti` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `OrderCart` FOREIGN KEY (`IdCarrello`) REFERENCES `carrello` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  ADD CONSTRAINT `ReviewArticle` FOREIGN KEY (`IdArticolo`) REFERENCES `articoli` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ReviewUser` FOREIGN KEY (`IdUtente`) REFERENCES `utenti` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
