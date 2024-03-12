-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 12:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admini`
--

CREATE TABLE `admini` (
  `ime` varchar(255) NOT NULL,
  `lozinka` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admini`
--

INSERT INTO `admini` (`ime`, `lozinka`) VALUES
('viktor', '$2y$10$WjmaG6Z9gkI7N5/5Blkj8OzThICmeRDaHCxBN3tUGLmWqpcYp6NCu');

-- --------------------------------------------------------

--
-- Table structure for table `diskusije`
--

CREATE TABLE `diskusije` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `putanjaSlike` varchar(255) NOT NULL,
  `id_teme` int(11) DEFAULT NULL,
  `korisnicko_ime` varchar(255) DEFAULT NULL,
  `kreirana` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diskusije`
--

INSERT INTO `diskusije` (`id`, `naslov`, `text`, `putanjaSlike`, `id_teme`, `korisnicko_ime`, `kreirana`) VALUES
(4, 'jhdfdfh', 'dfhghfd', '/images/skull-vector-png-33.jpg', 7, 'Viktor', '2024-03-12 11:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(11) NOT NULL,
  `tekst` text DEFAULT NULL,
  `roditeljski_komentar_id` int(11) DEFAULT NULL,
  `korisnicko_ime` varchar(255) DEFAULT NULL,
  `id_diskusije` int(11) DEFAULT NULL,
  `kreiran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `tekst`, `roditeljski_komentar_id`, `korisnicko_ime`, `id_diskusije`, `kreiran`) VALUES
(27, 'gsdsdgsdgsgd', NULL, 'Viktor', 4, '2024-03-12 11:09:08'),
(28, 'gsdgsd', 27, 'Viktor', 4, '2024-03-12 11:09:13'),
(29, 'gsdgs', 27, 'Viktor', 4, '2024-03-12 11:09:17'),
(30, 'gsdgsdsd', NULL, 'Viktor', 4, '2024-03-12 11:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `korisnicko_ime` varchar(255) NOT NULL,
  `ime_za_prikaz` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `lozinka` varchar(255) DEFAULT NULL,
  `kreiran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`korisnicko_ime`, `ime_za_prikaz`, `email`, `lozinka`, `kreiran`) VALUES
('jk', 'neki random lik', 'gg@gmail.com', '$2y$10$29Iscvakm.5btqh3dpltyOUtp5398hftugSze3nBcWNWj5j0c/Alu', '2024-03-09 20:12:12'),
('Viktor', 'vicooo', 'viktor.vico05@gmail.com', '$2y$10$JGuxUf93Os8GNT0dPQxLR.ZkFqp178Fhj8FdwPrbSdE1yA54Dxz4S', '2024-03-09 20:45:27');

-- --------------------------------------------------------

--
-- Table structure for table `teme`
--

CREATE TABLE `teme` (
  `id_teme` int(11) NOT NULL,
  `naslov` varchar(255) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `putanjaSlike` varchar(100) NOT NULL,
  `kreirana` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ime_admina` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teme`
--

INSERT INTO `teme` (`id_teme`, `naslov`, `opis`, `putanjaSlike`, `kreirana`, `ime_admina`) VALUES
(4, 'hdfsfhdhdfdfh', 'dhfhdfdhfhdfdfhhdfhdfdfdfhdfhdd', '/images/skrin.png', '2024-03-11 22:40:50', 'viktor'),
(5, 'Priroda', 'Priroda je, u najširem smislu, ekvivalent za prirodni, fizički ili materijalni svijet ili svemir. Priroda označava fenomene fizičkog svijeta, ali i život uopće. Njezin raspon seže od subatomskog do kozmičkog.', '/images/priroda.jpg', '2024-03-12 02:05:25', 'viktor'),
(6, 'Televizijske Serije', 'Televizijska serija (skraćeno: TV serija) je deo sadržaja televizijsklog programa koji se sastoji od pojedinačnih, a tematski i sadržajno povezanih televizijskih emisija koje čine jednu celinu i emituju se u redovnim intervalima. Pojedinačne emisije TV serije se zovu epizode i obično su grupisane su u godišnje serijale, odnosno televizijske sezone. Serije, najčešće kraće, koje su namenjene da se emituju određeni broj epizoda zovu se miniserije', '/images/serije.jpg', '2024-03-12 07:50:49', 'viktor'),
(7, 'Istorijske ličnosti', 'ljudi koji su promenili svet je istorijsko-obrazovni časopis koji opisuje živote poznatih istorijskih ličnosti koje su promenile svet u raznim oblastima života, i iznosi zanimljive činjenice iz života ljudi koji su u mnogo čemu uobličili današnji svet.', '/images/istorijske.jpeg', '2024-03-12 08:55:52', 'viktor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admini`
--
ALTER TABLE `admini`
  ADD PRIMARY KEY (`ime`);

--
-- Indexes for table `diskusije`
--
ALTER TABLE `diskusije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`korisnicko_ime`);

--
-- Indexes for table `teme`
--
ALTER TABLE `teme`
  ADD PRIMARY KEY (`id_teme`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diskusije`
--
ALTER TABLE `diskusije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `teme`
--
ALTER TABLE `teme`
  MODIFY `id_teme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
