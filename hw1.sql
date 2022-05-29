-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 28, 2022 alle 17:23
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `codCreator` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`id`, `codCreator`, `text`, `time`) VALUES
(114, 28, 'Primo', '2022-05-26 20:57:52'),
(115, 28, 'Secondo', '2022-05-26 20:57:59'),
(116, 28, 'Terzo', '2022-05-26 20:58:07'),
(117, 28, 'Quarto', '2022-05-26 20:58:11'),
(118, 28, 'Quinto', '2022-05-26 20:58:15'),
(119, 28, 'Sesto', '2022-05-26 20:58:19'),
(120, 28, 'Settimo', '2022-05-26 20:58:24'),
(121, 28, 'Ottavo', '2022-05-26 20:58:27'),
(122, 28, 'Nono', '2022-05-26 20:58:30'),
(125, 29, 'Io sono Giorgia', '2022-05-26 20:59:37'),
(126, 29, 'Sono una madre', '2022-05-26 20:59:42'),
(127, 29, 'Sono cristiana', '2022-05-26 20:59:47'),
(128, 29, 'Vogliono che siamo', '2022-05-26 20:59:52'),
(129, 29, 'Genitore 1', '2022-05-26 20:59:57'),
(130, 29, 'Genitore 2', '2022-05-26 21:00:02'),
(131, 30, '1 solo post', '2022-05-26 21:02:13'),
(135, 28, 'bel post', '2022-05-27 14:04:54');

--
-- Trigger `post`
--
DELIMITER $$
CREATE TRIGGER `deposted` AFTER DELETE ON `post` FOR EACH ROW BEGIN
	UPDATE
    	users
     SET
     	postnumber=postnumber-1
     WHERE
     	users.id= old.codCreator;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `posted` AFTER INSERT ON `post` FOR EACH ROW BEGIN
    UPDATE
        users
    SET
        postnumber = postnumber +1
    WHERE
        users.id = NEW.codCreator;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `pref`
--

CREATE TABLE `pref` (
  `id` int(11) NOT NULL,
  `preferente` int(11) NOT NULL,
  `preferito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `pref`
--

INSERT INTO `pref` (`id`, `preferente`, `preferito`) VALUES
(50, 29, 28),
(51, 30, 29),
(52, 30, 28),
(53, 31, 28),
(54, 31, 30),
(57, 28, 31),
(58, 28, 30);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `postnumber` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `postnumber`) VALUES
(28, 'lecci@giulio.com', 'Leccii', '$2y$10$a5Oqnkbd6zUdR4/3zSZqIOgLVNBubHkurK.94eWFC38xdeRPZvLcS', 10),
(29, 'gio@dipa.com', 'Giorgina', '$2y$10$etrgTgsi0VT2M8La8VRV0OJaT3o0gZBSaH8tMS6fQVpe4resd9Rh6', 6),
(30, 'ale@merli.com', 'Ale_Merlin', '$2y$10$A1zIasBNfl1ZtfniFZJ2qOn.d7T7p4GMce6uCy/.8JERHUeWFi4dm', 1),
(31, 'andrimau@gmail.com', 'Siunju', '$2y$10$Z3Ze.DNIWD7oOt0XIsLeOujGkYMLrwNCWCL52dyevH3SGTPstoZoW', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codCreator` (`codCreator`);

--
-- Indici per le tabelle `pref`
--
ALTER TABLE `pref`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preferente` (`preferente`),
  ADD KEY `preferito` (`preferito`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT per la tabella `pref`
--
ALTER TABLE `pref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`codCreator`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `pref`
--
ALTER TABLE `pref`
  ADD CONSTRAINT `pref_ibfk_1` FOREIGN KEY (`preferente`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pref_ibfk_2` FOREIGN KEY (`preferito`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
