-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 19 nov 2026 om 12:17
-- Serverversie: 10.11.16-MariaDB
-- PHP-versie: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `westtalent`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `answer_option`
--

CREATE TABLE `answer_option` (
  `id` int(11) NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `is_correct` int(11) DEFAULT NULL,
  `assignment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `answer_option`
--

INSERT INTO `answer_option` (`id`, `option_text`, `is_correct`, `assignment_id`) VALUES
(1, 'Functie.,\r\nReiskostenvergoeding.,\r\nAfspraken over fooien en extra\'s.,\r\nDe plaats waar je je werk doet.,\r\nSalaris.,\r\nHoeveel uur je werkt.,\r\nAantal vakantiedagen.,\r\nSancties bij te laat komen.', NULL, 1),
(2, 'Ja.,\nNee.', NULL, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `question_type` varchar(50) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `assignment`
--

INSERT INTO `assignment` (`id`, `question`, `question_type`, `lesson_id`) VALUES
(1, 'Kruis aan welke zaken in elk geval in je\narbeidsovereenkomst moetenstaan.', 'Meerkeuze vraag', 1),
(2, 'Waarvoor zou een persoon willen werken?', 'Open vraag', 1),
(3, 'Je hebt recht op een inspraak in de vorm van een\nondernemingsraad als je in een bedrijf werk met meer dan 50 mensen.', 'Juist onjuist vraag', 1),
(4, 'testing', 'Open vraag', 2),
(5, 'Welke personen horen bij de beroepsbevolking?\nSelecteer de juiste antwoord:,\n*Layla (22) zorgt de hele week voor kinderen en huishouden.,\n*Annette (79) stond 40 jaar voor de klas.,\n*Ivan (19) werkt naast zijn studie 14 uur in een café.,\n*Shanti (32) werkt 40 uur per week in haar eigen reclamebureau.,\n*Esther (14) is scholier en past 12 uur in de week op haar buurmeisje.', 'Juist onjuist vraag', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('App\\Migrations\\Version20261102074832', '2026-11-02 10:22:23', 65),
('App\\Migrations\\Version20261102075430', '2026-11-02 10:22:23', 7),
('App\\Migrations\\Version20261102110155', '2026-11-02 11:55:19', 16),
('App\\Migrations\\Version20261102110432', '2026-11-02 11:55:19', 5),
('App\\Migrations\\Version20261109102236', '2026-11-10 09:29:18', 52),
('App\\Migrations\\Version20261110092059', '2026-11-10 09:29:18', 67),
('App\\Migrations\\Version20261110092906', '2026-11-10 11:57:26', 1),
('App\\Migrations\\Version20261110114912', '2026-11-10 11:57:26', 549),
('App\\Migrations\\Version20261110120151', '2026-11-10 12:05:02', 96),
('App\\Migrations\\Version20261116100533', '2026-11-16 11:05:47', 383),
('App\\Migrations\\Version20261116112645', '2026-11-16 13:01:31', 109);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `contents` longtext NOT NULL,
  `module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lesson`
--

INSERT INTO `lesson` (`id`, `name`, `description`, `contents`, `module_id`) VALUES
(1, 'Les 1 Economie', 'De eerste les voor Economie', 'WERK EN INKOMEN', 1),
(2, 'Les 2 Economie', 'De tweede les voor Economie', 'DE OVERHEID EN HET SOCIALE VANGNET', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `vak_id` int(11) DEFAULT NULL,
  `niveau_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `module`
--

INSERT INTO `module` (`id`, `name`, `created_at`, `vak_id`, `niveau_id`) VALUES
(1, 'Economische dimensie', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `niveau`
--

CREATE TABLE `niveau` (
  `id` int(11) NOT NULL,
  `niveau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `niveau`
--

INSERT INTO `niveau` (`id`, `niveau`) VALUES
(1, '2'),
(2, '3'),
(3, '4');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `info` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `page`
--

INSERT INTO `page` (`id`, `title`, `info`, `content`, `img`, `lesson_id`) VALUES
(1, 'Eerste les', 'Deze les gaat werknemers', 'Werknemer zijn: een afspraak\nHet hebben van een baan is eigenlijk een simpele afspraak: jij levert arbeid aan je werkgever en je werkgever betaalt je daarvoor. Meestal kom je aan een baan via een sollicitatie op een vacature. Als je het na een sollicitatiegesprek met je werkgever eens wordt, sluiten jullie een arbeidsovereenkomst.\nDaarin worden deze dingen altijd vastgelegd:\n* je functie\n* je salaris\n* hoeveel uur je werkt\n* de plaats waar je je werk doet.\nVaak staan er in de arbeidsovereenkomst ook nog afspraken over vakantietoeslag, reiskostenvergoeding en soms nog andere zaken. Een arbeidsovereenkomst betekent dat er een gezagsverhouding is tussen jou en de werkgever. De leidinggevende heeft gezag over jou: hij vertelt jou wat je moet doen en hoe je dat moet doen. De arbeidsovereenkomst kan gelden voor bepaalde tijd (oftewel ‘tijdelijk’, bijvoorbeeld voor zes maanden) of voor onbepaalde tijd vaste dienst”). Je kunt ook een oproep-contract of nulurencontract krijgen. Hierin staat niet hoeveel uur je gaat werken. Volg je een BBL-opleiding, dan heb je een leerovereenkomst en meestal ook een arbeidsovereenkomst met het bedrijf waar je (drie of) vier dagen in de week werkt.', 'HI.png', 1),
(2, 'andere les', 'informatie', 'inhoud', NULL, 1),
(3, 'andere tweede les', 'informatie 2', 'inhoud 2', NULL, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `studentprogress`
--

CREATE TABLE `studentprogress` (
  `id` int(11) NOT NULL,
  `completed_lesson` int(11) NOT NULL,
  `total_lessons` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `submission`
--

CREATE TABLE `submission` (
  `id` int(11) NOT NULL,
  `answer_text` longtext DEFAULT NULL,
  `is_correct` int(11) DEFAULT NULL,
  `feedback` longtext DEFAULT NULL,
  `submitted_at` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `answer_option_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `is_verified` tinyint(4) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `is_verified`, `last_name`) VALUES
(2, 'Joshua@gmail.com', '[]', '$2y$13$Y.jYHfsnKbHIbMvtdKPiL.qfZ7gOzSc3WQK7tUX.Meaydy0wCabJi', 'Joshua', 0, 'Soebhag'),
(3, 'Test@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$mHS9OTW3uRVSaO1GEafBtOtPpVtvT5x/I6lt8xD6s8MjNEJK3LyAa', 'test', 0, 'test'),
(4, 'best@gmail.com', '[\"ROLE_TEACHER\"]', '$2y$13$dpT8HUngJCGNG8d6yEguwOmo8ZDIworBzRJWf2iSZO//guiw.4B5m', 'Best', 0, 'test'),
(5, 'west@gmail.com', '[\"ROLE_STUDENT\"]', '$2y$13$jVcBeH9Zs9rwyRi43S/tGOglEMP9rQ2f53mJ7DCB5oyI7khq4E5vO', 'west', 0, 'Test'),
(6, 'pest@gmail.com', '[]', '$2y$13$d7RPjosoJmqmIAEsF1puVOLvTnek0N6Oi/ucXMKsUxChofy2OxRI.', 'pest', 0, 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vak`
--

CREATE TABLE `vak` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `vak`
--

INSERT INTO `vak` (`id`, `name`, `description`, `image`) VALUES
(1, 'Burgerschap', 'Burgerschap', '/assets/images/Maatschappij-Y_d9khv.jpg'),
(2, 'Engels', 'Engels', ''),
(3, 'Nederlands', 'Nederlands', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `answer_option`
--
ALTER TABLE `answer_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A87F3A17D19302F8` (`assignment_id`);

--
-- Indexen voor tabel `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_30C544BACDF80196` (`lesson_id`);

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F87474F3AFC2B591` (`module_id`);

--
-- Indexen voor tabel `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C242628BDCC7DA2` (`vak_id`),
  ADD KEY `IDX_C242628B3E9C81` (`niveau_id`);

--
-- Indexen voor tabel `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_140AB620CDF80196` (`lesson_id`);

--
-- Indexen voor tabel `studentprogress`
--
ALTER TABLE `studentprogress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BB7FA6C3AFC2B591` (`module_id`),
  ADD KEY `IDX_BB7FA6C3A76ED395` (`user_id`),
  ADD KEY `IDX_BB7FA6C3CDF80196` (`lesson_id`);

--
-- Indexen voor tabel `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DB055AF3A76ED395` (`user_id`),
  ADD KEY `IDX_DB055AF3D19302F8` (`assignment_id`),
  ADD KEY `IDX_DB055AF39A3BC2B9` (`answer_option_id`),
  ADD KEY `IDX_DB055AF3CDF80196` (`lesson_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Indexen voor tabel `vak`
--
ALTER TABLE `vak`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `answer_option`
--
ALTER TABLE `answer_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `studentprogress`
--
ALTER TABLE `studentprogress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `vak`
--
ALTER TABLE `vak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `answer_option`
--
ALTER TABLE `answer_option`
  ADD CONSTRAINT `FK_A87F3A17D19302F8` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`id`);

--
-- Beperkingen voor tabel `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `FK_30C544BACDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);

--
-- Beperkingen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F3AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Beperkingen voor tabel `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `FK_C242628B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`),
  ADD CONSTRAINT `FK_C242628BDCC7DA2` FOREIGN KEY (`vak_id`) REFERENCES `vak` (`id`);

--
-- Beperkingen voor tabel `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_140AB620CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);

--
-- Beperkingen voor tabel `studentprogress`
--
ALTER TABLE `studentprogress`
  ADD CONSTRAINT `FK_BB7FA6C3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_BB7FA6C3AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`),
  ADD CONSTRAINT `FK_BB7FA6C3CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);

--
-- Beperkingen voor tabel `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `FK_DB055AF39A3BC2B9` FOREIGN KEY (`answer_option_id`) REFERENCES `answer_option` (`id`),
  ADD CONSTRAINT `FK_DB055AF3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_DB055AF3CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`),
  ADD CONSTRAINT `FK_DB055AF3D19302F8` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
