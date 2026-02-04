-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 04 feb 2026 om 16:52
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verrukkulluk`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

CREATE TABLE `artikel` (
  `id` int(30) NOT NULL,
  `naam` varchar(30) DEFAULT NULL,
  `omschrijving` varchar(5000) DEFAULT NULL,
  `prijs` int(30) DEFAULT NULL,
  `eenheid` varchar(30) DEFAULT NULL,
  `verpakking` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikel`
--

INSERT INTO `artikel` (`id`, `naam`, `omschrijving`, `prijs`, `eenheid`, `verpakking`) VALUES
(1, 'Kaas', 'Parmezaanse kaas', 250, 'gram', '400'),
(2, 'Tomaten', 'Tros van 6 tomaten', 150, 'gram', '500'),
(3, 'kipfilet', 'verse kipfilet', 649, 'gram', '500'),
(4, 'Rundergehakt', 'mager rundergehakt', 599, 'gram', '400'),
(5, 'Ui', 'Gele Ui', 199, 'stuk', '6'),
(6, 'Knoflook', 'Verse Knoflook', 99, 'stuk', '1'),
(7, 'Paprika', 'Rode paprika', 249, 'gram', '400'),
(8, 'Olijfolie', 'Extra vierge', 599, 'ml', '500'),
(9, 'Rijst', 'witte rijst', 289, 'gram', '1000'),
(10, 'Pasta ', 'Penne', 149, 'gram', '500'),
(11, 'Melk', 'Halfvol', 109, 'ml', '1000');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerecht`
--

CREATE TABLE `gerecht` (
  `id` int(11) NOT NULL,
  `keuken_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `datum_toegevoegd` date NOT NULL,
  `titel` varchar(255) NOT NULL,
  `korte_omschrijving` text NOT NULL,
  `lange_omschrijving` text NOT NULL,
  `afbeelding` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gerecht`
--

INSERT INTO `gerecht` (`id`, `keuken_id`, `type_id`, `user_Id`, `datum_toegevoegd`, `titel`, `korte_omschrijving`, `lange_omschrijving`, `afbeelding`) VALUES
(1, 1, 6, 1, '2026-02-03', 'Falafel', 'Knapperig van buiten en zacht van binnen: falafel zijn hartige kikkererwtenballetjes met kruiden en specerijen, goudbruin gebakken en heerlijk in pita, wraps of salades.', 'Falafel komt oorspronkelijk uit het Midden-Oosten, met wortels in Egypte. Van daaruit verspreidde het zich naar landen als Israël, Libanon en Palestina, waar het nu een echte klassieker is.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPi37T8QAa8pYGDrOr7hB1xXqVj5JhPrNZkA&s'),
(2, 3, 5, 2, '2026-01-01', 'Oliebollen', 'Oliebollen zijn luchtige, goudbruine deeghapjes, gefrituurd in olie en bestrooid met poedersuiker. Ze zijn zacht van binnen, knapperig van buiten en typisch voor de winter, vooral rond oud en nieuw.', 'Oliebollen zijn luchtige, goudbruine deeghapjes die in olie worden gefrituurd. Ze zijn knapperig van buiten, zacht en fluffy van binnen, vaak gevuld met rozijnen of appel, en worden traditioneel bestrooid met poedersuiker. Een echte winterklassieker, vooral rond oud en nieuw', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTlm46u3y7ionMKM7-biaS0SQNhGNT7nuLKQ&s'),
(3, 4, 2, 1, '2025-12-11', 'Stroopwafels', 'Dunne, knapperige wafels met een warme karamelsiroopvulling ertussen.', 'Stroopwafels bestaan uit twee dunne, knapperige wafels die aan elkaar worden geplakt met een warme, kleverige vulling van karamelstroop, suiker en specerijen. Ze worden traditioneel vers gebakken, waardoor de stroop zacht en licht vloeibaar blijft. Stroopwafels staan bekend om hun perfecte balans tussen knapperig en chewy, zoet maar niet overheersend. Extra lekker is om ze even op een kop warme thee of koffie te leggen, zodat de stroop van binnen zacht smelt.', 'https://cdn.stroopwafels.com/content/uploads/2020/06/seo-banner-image-left-1.png'),
(4, 1, 4, 1, '2025-11-03', 'Bitterballen', 'Kleine, krokante snacks met een romige ragoutvulling, perfect bij een borrel.', 'Bitterballen zijn kleine, ronde snacks met een krokante paneerlaag en een romige vulling van rundvleesragout, op smaak gebracht met kruiden zoals nootmuskaat en peper. Ze worden heet gefrituurd, waardoor de buitenkant knapperig is en de binnenkant zacht en smeuïg. Bitterballen worden meestal geserveerd met mosterd en zijn onmisbaar bij borrels, cafés en feestjes. Ze staan symbool voor gezelligheid en samen snacken.', 'https://www.laurasbakery.nl/wp-content/uploads/2019/09/bitterballen-uitgelicht.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerecht_info`
--

CREATE TABLE `gerecht_info` (
  `id` int(11) NOT NULL,
  `record_type_id` varchar(1) DEFAULT NULL,
  `gerecht_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `nummeriekveld` int(11) DEFAULT NULL,
  `tekstveld` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gerecht_info`
--

INSERT INTO `gerecht_info` (`id`, `record_type_id`, `gerecht_id`, `user_id`, `datum`, `nummeriekveld`, `tekstveld`) VALUES
(17, 'B', 2, 1, '2026-02-01', 1, 'Week 250 g rozijnen 10–15 minuten in warm water, giet af en dep droog (optioneel).\r\nVerwarm 300 ml melk tot lauwwarm.\r\nMeng 7 g droge gist met 1 el suiker door de melk.\r\nLaat dit 5–10 minuten staan tot het begint te schuimen.\r\nDoe 500 g bloem in een grote kom.\r\nVoeg 1 tl zout toe en meng kort.\r\nVoeg 1 ei toe aan de bloem.\r\nGiet het gistmengsel erbij.\r\n'),
(18, 'B', 2, 1, '2026-02-01', 2, 'Meng alles tot een dik, plakkerig beslag.\r\nSpatel de rozijnen door het beslag.\r\nDek de kom af en laat het beslag ± 1 uur rijzen tot het volume verdubbeld is.\r\nVerhit zonnebloemolie tot 180 °C.\r\nSchep met twee lepels bolletjes beslag in de olie en bak 4–6 minuten goudbruin, regelmatig keren.\r\nLaat uitlekken op keukenpapier en bestrooi met poedersuiker.'),
(19, 'F', 3, 1, NULL, NULL, NULL),
(20, 'O', 3, 1, NULL, NULL, 'Echt lekker! Echt een aanrader'),
(21, 'W', 3, 1, '2026-02-01', 5, NULL),
(22, 'B', 4, 1, '2026-02-01', 1, 'melt 60 g boter in een pan op middelhoog vuur.\r\nVoeg 60 g bloem toe en roer tot een gladde roux.\r\nLaat de roux 2–3 minuten garen zonder te kleuren.\r\nVoeg geleidelijk 500 ml warme runderbouillon toe en blijf roeren.\r\nLaat de ragout indikken tot zeer stevig.\r\nMeng 200 g fijngehakt gekookt rundvlees erdoor.\r\nBreng op smaak met zout, peper en nootmuskaat.\r\nSpreid de ragout uit in een schaal en laat volledig afkoelen (min. 2 uur).\r\nRol kleine balletjes van de koude ragout.\r\nHaal ze eerst door bloem.\r\nHaal ze daarna door losgeklopt ei.\r\nHaal ze tenslotte door paneermeel.\r\nVerhit zonnebloemolie tot 180 °C en frituur de bitterballen 3–4 minuten goudbruin.\r\nLaat uitlekken op keukenpapier en serveer heet met mosterd.'),
(23, 'B', 3, 2, '2026-02-01', 1, 'Meng gist met lauwwarme melk en laat 5 minuten staan.\r\nDoe bloem, suiker en zout in een kom.\r\nVoeg ei, gesmolten boter en het gistmengsel toe.\r\nKneed tot een soepel deeg.\r\nDek af en laat 45–60 minuten rijzen.\r\nSmelt voor de stroop boter, suiker en stroop in een pan.\r\nRoer kaneel erdoor en laat zachtjes indikken.\r\nVerdeel het deeg in kleine balletjes.\r\nVerhit een stroopwafelijzer (of wafelijzer).\r\nBak elke bol tot een dunne goudbruine wafel.\r\n'),
(24, 'B', 3, 2, '2026-02-02', 2, 'Snijd de warme wafel horizontaal doormidden.\r\nBestrijk de onderkant met warme stroop.\r\nLeg de bovenkant erop en druk licht aan.\r\nLaat even rusten zodat de stroop kan zetten.'),
(25, 'B', 1, 2, '2026-02-02', 1, 'Week 250 g gedroogde kikkererwten 12 uur in ruim koud water (niet uit blik).\r\nGiet af en dep de kikkererwten goed droog.\r\nDoe ze in een keukenmachine.\r\nVoeg 1 kleine ui en 3 teentjes knoflook toe.\r\nVoeg een handje peterselie en koriander toe.\r\nVoeg 1 tl komijn, 1 tl korianderpoeder en ½ tl cayenne toe.\r\nVoeg 1 tl zout en ½ tl bakpoeder toe.\r\nPulseer tot een grof, samenhangend mengsel (geen puree).\r\nLaat het mengsel 30 minuten rusten in de koelkast.\r\n'),
(26, 'B', 1, 2, '2026-02-02', 2, 'Vorm kleine balletjes of schijfjes met vochtige handen.\r\nVerhit zonnebloemolie tot 170–180 °C.\r\nFrituur de falafel in porties 3–4 minuten goudbruin.\r\nLaat uitlekken op keukenpapier.\r\nServeer warm in pita of wrap met sla, tomaat en tahinsaus.'),
(27, 'B', 3, 1, '2026-02-02', 1, 'Meng gist met lauwwarme melk en laat 5 minuten staan.\r\nDoe bloem, suiker en zout in een kom.\r\nVoeg ei, gesmolten boter en het gistmengsel toe.\r\nKneed tot een soepel deeg.\r\nDek af en laat 45–60 minuten rijzen.\r\nSmelt voor de stroop boter, suiker en stroop in een pan.\r\n'),
(28, 'B', 3, 1, '2026-02-02', 2, 'Roer kaneel erdoor en laat zachtjes indikken.\r\nVerdeel het deeg in kleine balletjes.\r\nVerhit een stroopwafelijzer (of wafelijzer).\r\nBak elke bol tot een dunne goudbruine wafel.\r\nSnijd de warme wafel horizontaal doormidden.\r\nBestrijk de onderkant met warme stroop.\r\nLeg de bovenkant erop en druk licht aan.\r\nLaat even rusten zodat de stroop kan zetten.'),
(29, 'F', 1, 1, '2026-02-02', NULL, 'Niet te happen!'),
(30, 'W', 2, 1, '2026-02-02', 1, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `gerecht_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `ingredient`
--

INSERT INTO `ingredient` (`id`, `gerecht_id`, `artikel_id`, `aantal`) VALUES
(1, 1, 6, 6),
(2, 1, 8, 1),
(3, 1, 1, 2),
(4, 4, 10, 1),
(5, 4, 2, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `keuken_type`
--

CREATE TABLE `keuken_type` (
  `id` int(11) NOT NULL,
  `keuken_type_record_type` char(1) NOT NULL,
  `keuken_type_omschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `keuken_type`
--

INSERT INTO `keuken_type` (`id`, `keuken_type_record_type`, `keuken_type_omschrijving`) VALUES
(1, 'K', 'Indisch'),
(2, 'K', 'Frans'),
(3, 'K', 'Malawisch'),
(4, 'T', 'Vlees'),
(5, 'T', 'Vis'),
(6, 'T', 'Vegetarisch');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_naam` varchar(250) DEFAULT NULL,
  `user_email` varchar(250) DEFAULT NULL,
  `user_wachtwoord` varchar(250) DEFAULT NULL,
  `user_afbeelding` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `user_naam`, `user_email`, `user_wachtwoord`, `user_afbeelding`) VALUES
(1, 'Jeroen', 'Jeroen@educom.com', 'asdjlfrkalfew', 'https://cdn.shopify.com/s/files/1/1061/1924/files/Hugging_Face_Emoji_2028ce8b-c213-4d45-94aa-21e1a0842b4d_large.png?15202324258887420558'),
(2, 'René', 'rene@educom.nl', 'fsjafkwa', 'https://img.freepik.com/premium-vector/photographer-emoji-emoticon-taking-photo-with-his-camera_1303870-244.jpg');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gerecht`
--
ALTER TABLE `gerecht`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `user_fK` (`user_Id`),
  ADD KEY `keuken_FK` (`keuken_id`);

--
-- Indexen voor tabel `gerecht_info`
--
ALTER TABLE `gerecht_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerecht_id` (`gerecht_id`);

--
-- Indexen voor tabel `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_id` (`artikel_id`),
  ADD KEY `gerecht_id` (`gerecht_id`);

--
-- Indexen voor tabel `keuken_type`
--
ALTER TABLE `keuken_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `gerecht`
--
ALTER TABLE `gerecht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `gerecht_info`
--
ALTER TABLE `gerecht_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT voor een tabel `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `keuken_type`
--
ALTER TABLE `keuken_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `gerecht`
--
ALTER TABLE `gerecht`
  ADD CONSTRAINT `gerecht_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `keuken_type` (`id`),
  ADD CONSTRAINT `keuken_FK` FOREIGN KEY (`keuken_id`) REFERENCES `keuken_type` (`id`),
  ADD CONSTRAINT `user_fK` FOREIGN KEY (`user_Id`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `gerecht_info`
--
ALTER TABLE `gerecht_info`
  ADD CONSTRAINT `gerecht_info_ibfk_1` FOREIGN KEY (`gerecht_id`) REFERENCES `gerecht` (`id`);

--
-- Beperkingen voor tabel `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`),
  ADD CONSTRAINT `ingredient_ibfk_2` FOREIGN KEY (`gerecht_id`) REFERENCES `gerecht` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
