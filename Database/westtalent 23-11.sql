-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 nov 2026 om 12:17
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
(9, 'Ja', NULL, 3),
(10, 'Nee', NULL, 3),
(11, 'Functie', NULL, 1),
(12, 'Reiskostenvergoeding', NULL, 1),
(13, 'Afspraken over fooien en extra\'s', NULL, 1),
(14, 'De plaats waar je je werk doet', NULL, 1),
(15, 'Salaris', NULL, 1),
(16, 'Hoeveel uur je werkt', NULL, 1),
(17, 'Aantal vakantiedagen', NULL, 1),
(18, 'Sancties bij te laat komen', NULL, 1),
(19, 'Layla (22) zorgt de hele week voor kinderen en huishouden', NULL, 5),
(20, 'Annette (79) stond 40 jaar voor de klas', NULL, 5),
(21, 'Ivan (19) werkt naast zijn studie 14 uur in een café', NULL, 5),
(22, 'Shanti (32) werkt 40 uur per week in haar eigen reclamebureau', NULL, 5),
(23, 'Esther (14) is scholier en past 12 uur in de week op haar buurmeisje', NULL, 5);

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
(5, 'Welke personen horen bij de beroepsbevolking?', 'Juist onjuist vraag', 2);

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
('App\\Migrations\\Version20261116112645', '2026-11-16 13:01:31', 109),
('App\\Migrations\\Version20261120083516', '2026-11-20 09:35:33', 403);

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
(1, 'Les 1 Economie', 'De eerste hoofdstuk van het economische dimensie', 'WERK EN INKOMEN', 1),
(2, 'Les 2 Economie', 'De tweede hoofdstuk van het economische dimensie', 'DE OVERHEID EN HET SOCIALE VANGNET', 1);

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
(1, 'Het nut van werken', 'De redens om te werken', 'Voor je basisbehoeften zoals eten, woonruimte en kleding, heb je geld nodig. Dat geld krijgen de meeste mensen door betaald werk te doen. Dat kan in loondienst zijn, of als ondernemer met een eigen zaak. Kortom: je werkt om geld te verdienen. Voor een deel klopt dat natuurlijk, maar dat betaalde werk levert ook iets op dat niets\nmet geld te maken heeft. Werk kan ervoor zorgen dat je je nuttig voelt en waardering krijgt voor wat je doet. Als je je werk goed doet, geeft dat zelfvertrouwen. En doordat je collega\'s hebt, heb je er sociale contacten bij. De piramide die je op de afbeelding ziet, is een soort top 5 van menselijke behoeften. De psycholoog Maslow heeft deze piramide\nbedacht. Hij gaat ervan uit dat je pas aan ‘hogere’ behoeften kunt werken, als de lagen eronder al in orde zijn. Het hebben van werk kan in al deze behoeften een rol spelen: door je inkomen kun je zorgen voor je lichamelijke behoeften, en voor veiligheid en zekerheid. Dit staat in de onderste twee lagen. Maar het hebben van werk kan je meer geven, zoals sociaal contact, erkenning, waardering en persoonlijke ontwikkeling. En niet alleen jij hebt er belang bij om te werken: je bent als werknemer ook van belang voor het bedrijf of de organisatie waarvoor je werkt. Zonder werknemers kan een bedrijf zijn doelstellingen niet bereiken. Tot slot is werk ook nuttig voor de samenleving als geheel. Door jouw inzet in de zorg, landbouw, industrie, dienstverlening of het transport draag je bij aan onze\nmaatschappij en onze welvaart.', 'HI.png', 1),
(2, 'Werknemer zijn: een afspraak', 'Belangrijke informatie over werken', 'Het hebben van een baan is eigenlijk een simpele afspraak: jij levert arbeid aan je werkgever en je werkgever betaalt je daarvoor. Meestal kom je aan een baan via een sollicitatie op een vacature. Als je het na een sollicitatiegesprek met je werkgever eens wordt, sluiten jullie een arbeidsovereenkomst.\nDaarin worden deze dingen altijd vastgelegd:\n* je functie\n* je salaris\n* hoeveel uur je werkt\n* de plaats waar je je werk doet.\nVaak staan er in de arbeidsovereenkomst ook nog afspraken over vakantietoeslag, reiskostenvergoeding en soms nog andere zaken. Een arbeidsovereenkomst betekent dat er een gezagsverhouding is tussen jou en de werkgever. De leidinggevende heeft gezag over jou: hij vertelt jou wat je moet doen en hoe je dat moet doen. De arbeidsovereenkomst kan gelden voor bepaalde tijd (oftewel ‘tijdelijk’, bijvoorbeeld voor zes maanden) of voor onbepaalde tijd vaste dienst”). Je kunt ook een oproep-contract of nulurencontract krijgen. Hierin staat niet hoeveel uur je gaat werken. Volg je een BBL-opleiding, dan heb je een leerovereenkomst en meestal ook een arbeidsovereenkomst met het bedrijf waar je (drie of) vier dagen in de week werkt.', NULL, 1),
(4, 'Cao', 'overeenkomst met afspraken tussen werke nemers en werkgevers in een bepaalde bedrijfstak', 'In veel bedrijfstakken — denk bijvoorbeeld aan horeca, gezondheidszorg of transport — worden algemene afspraken gemaakt over arbeidsvoorwaarden zoals salaris, toeslagen, vakantiedagen, werktijden, reiskostenvergoeding, scholing. Die afspraken worden vastgelegd in een cao, (collectieve arbeidsovereenkomst). Als de cao algemeen bindend is, moet elke werkgever in de branche zich eraan houden. De cao\'s worden afgesloten na onderhandelingen tussen werknemers en werkgevers in de bedrijfstak. Vakbonden onderhandelen uit naam van de werknemers.', NULL, 1),
(5, 'De vakbond', 'vereniging van werknemers in een bepaalde branche, die ookomt voor de belangen van haar leden', 'Op veel punten hebben werkgevers en werknemers hetzelfde belang. Ze willen allemaal dat het goed gaat met hun bedrijf of organisatie, dat er voldoende geld binnenkomt en dat er goed en veilig gewerkt wordt. Maar soms hebben ze tegenstrijdige belangen: een werkgever wil niet te veel geld uitgeven, maar een werknemer wil graag zoveel mogelijk verdienen. Zowel werkgevers als werknemers hebben organisaties die voor hun belangen opkomen.\nDe vakbonden onderhandelen met werkgevers over een zo goed mogelijke cao. Als je lid bent van een vakbond, kun je daar vaak ook terecht voor individuele hulp, bijvoorbeeld als je een conflict hebt met je werkgever. Als een vakbond het niet eens is met het beleid van een bedrijf of ontwikkelingen in een branche, kan de vakbond druk uitoefenen. Het belangrijkste middel daarvoor is een staking. Werknemers stoppen dan enige tijd met hun werk.', NULL, 1),
(6, 'Rechten en plichten', 'Arbowet » afkorting van Arbeidsomstandighedenwet bevat regels voor werkgevers en werk- nemers om gezondheid, veiligheid en welzijn te bevorderen Ondernemingsraad » inspraak- en medezeggenschapsorgaan in een organisatie', 'Je hebt als werknemer in Nederland veel rechten. Je hebt onder andere recht op een redelijk salaris en een veilige en gezonde werkplek. Dat laatste staat in de Arbowet. In veel branches gelden naast de Arbowet nog meer eisen over veiligheid en gezondheid. Als het bedrijf waar je werkt meer dan 50 mensen in dienst heeft, heb je recht op inspraak in de vorm van een ondernemingsraad (OR). In bedrijven met 10 tot 50 medewerkers kunnen de werknemers zelf een OR of personeelsvertegenwoordiging (PVT) opzetten. Als de meerderheid van de werknemers daar om vraagt, moet de werkgever hiermee akkoord gaan. Een PVT heeft minder rechten dan de OR. Zo kan de OR zelf met een voorstel komen, de PVT kan dat niet. Als de medewerkers geen OR of PVT opzetten, moet de werkgever personeelsvergaderingen (PV) houden. In bedrijven vanaf 10 werknemers, zonder PVT, moet de werkgever tenminste twee keer per jaar een PV houden met de medewerkers. Als werknemer heb je ook veel plichten, die je kunt samenvatten met de term ‘goed werknemerschap’. Bijvoorbeeld op tijd komen, de instructies van je werkgever opvolgen, je aan de regels van het bedrijf houden, met respect over het bedrijf spreken (ook op sociale media), en voorzichtig omgaan met informatie over het bedrijf of over klanten van het bedrijf.', NULL, 1),
(7, 'Bruto- en nettoloon', 'Werkgeverslasten: de premies voor werknemersverzekeringen die voor rekening van de werkgever komen, de bijdrage van de werkgever aan de sociale zekerheid.', 'Wat jij aan loon op je bankrekening krijgt, is niet gelijk aan wat jouw werkgever kwijt is aan jouw loonkosten. De werkgever betaalt de zogenaamde ‘werkgeverslasten’. Dit zijn: delen van de premies voor sociale verzekeringen, een reservering voor je vakantiegeld en een pensioenpremie. Wat de werkgever jou betaalt is het brutoloon. Daarvan gaan de belastingen en premies af die jij als werknemer moet betalen. De werkgever houdt die in op je loon en draagt ze af aan de overheid. Het bedrag dat overblijft, is het nettoloon. Dat krijg jij uitbetaald. Als je ouder bent dan 21 jaar betaal je in de meeste branches ook pensioenpremie.', 'afbeelding_2026-11-23_121245776.png', 1),
(8, 'Meer verdienen', NULL, 'De meeste werkgevers betalen je salaris per maand. Je krijgt het bedrag dat je met je werkgever hebt afgesproken toen je in dienst kwam. Daarnaast kun je toeslagen krijgen, bijvoorbeeld als je onregelmatig werkt of als je werk gevaarlijk is. Ook kun je recht hebben op vergoedingen zoals reiskosten vergoeding. Als je goed functioneert, gaat je\nsalaris vaak elk jaar iets omhoog. Als je een nieuwe functie krijgt met meer verantwoordelijkheden, bijvoorbeeld leiding geven, ga je vaak naar een hogere salarisschaal. Maar je kunt ook extra opleidingen doen, zodat je nieuwe taken kunt krijgen in je huidige baan of een nieuwe functie kunt krijgen. Denk aan een nieuwe specialisatie of een BHV-diploma (bedrijfshulpverlening).', NULL, 1);

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
  `lesson_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `submission`
--

INSERT INTO `submission` (`id`, `answer_text`, `is_correct`, `feedback`, `submitted_at`, `user_id`, `assignment_id`, `lesson_id`) VALUES
(82, 'Ja', NULL, NULL, '2026-11-20 14:41:00', 3, 3, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `submission_answer_option`
--

CREATE TABLE `submission_answer_option` (
  `submission_id` int(11) NOT NULL,
  `answer_option_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `submission_answer_option`
--

INSERT INTO `submission_answer_option` (`submission_id`, `answer_option_id`) VALUES
(82, 9);

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
  ADD KEY `IDX_DB055AF3CDF80196` (`lesson_id`);

--
-- Indexen voor tabel `submission_answer_option`
--
ALTER TABLE `submission_answer_option`
  ADD PRIMARY KEY (`submission_id`,`answer_option_id`),
  ADD KEY `IDX_955A4AFDE1FD4933` (`submission_id`),
  ADD KEY `IDX_955A4AFD9A3BC2B9` (`answer_option_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `studentprogress`
--
ALTER TABLE `studentprogress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
  ADD CONSTRAINT `FK_DB055AF3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_DB055AF3CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`),
  ADD CONSTRAINT `FK_DB055AF3D19302F8` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`id`);

--
-- Beperkingen voor tabel `submission_answer_option`
--
ALTER TABLE `submission_answer_option`
  ADD CONSTRAINT `FK_955A4AFD9A3BC2B9` FOREIGN KEY (`answer_option_id`) REFERENCES `answer_option` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_955A4AFDE1FD4933` FOREIGN KEY (`submission_id`) REFERENCES `submission` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
