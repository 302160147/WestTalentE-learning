-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 nov 2026 om 14:55
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

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
('App\\Migrations\\Version20261110120151', '2026-11-10 12:05:02', 96);

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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `niveau`
--

CREATE TABLE `niveau` (
  `id` int(11) NOT NULL,
  `niveau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `user_id` int(11) DEFAULT NULL
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
  `answer_option_id` int(11) DEFAULT NULL
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
(2, 'Joshua@gmail.com', '[]', '$2y$13$Y.jYHfsnKbHIbMvtdKPiL.qfZ7gOzSc3WQK7tUX.Meaydy0wCabJi', 'Joshua', 0, 'Soebhag');

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
-- Indexen voor tabel `studentprogress`
--
ALTER TABLE `studentprogress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BB7FA6C3AFC2B591` (`module_id`),
  ADD KEY `IDX_BB7FA6C3A76ED395` (`user_id`);

--
-- Indexen voor tabel `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DB055AF3A76ED395` (`user_id`),
  ADD KEY `IDX_DB055AF3D19302F8` (`assignment_id`),
  ADD KEY `IDX_DB055AF39A3BC2B9` (`answer_option_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `studentprogress`
--
ALTER TABLE `studentprogress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `vak`
--
ALTER TABLE `vak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Beperkingen voor tabel `studentprogress`
--
ALTER TABLE `studentprogress`
  ADD CONSTRAINT `FK_BB7FA6C3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_BB7FA6C3AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Beperkingen voor tabel `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `FK_DB055AF39A3BC2B9` FOREIGN KEY (`answer_option_id`) REFERENCES `answer_option` (`id`),
  ADD CONSTRAINT `FK_DB055AF3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_DB055AF3D19302F8` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
