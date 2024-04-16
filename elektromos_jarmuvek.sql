-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 14. 14:20
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `elektromos_jarmuvek`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('car','battery') NOT NULL,
  `user_id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `advertisements`
--

INSERT INTO `advertisements` (`id`, `title`, `description`, `type`, `user_id`, `brand`) VALUES
(1, 'gatya', 'gatygatytagaaa', 'car', 1, ''),
(2, 'eladó, kiadó azt cső', 'balalalalalal', 'car', 2, ''),
(11, 'lalala', 'lalala', 'car', 1, 'Mercedes-Benz'),
(12, 'lalala', 'lalala', 'car', 1, 'Mercedes-Benz'),
(13, 'lalala', 'lalala', 'car', 1, 'Mercedes-Benz'),
(14, 'lalala', 'lalala', 'car', 1, 'Mercedes-Benz'),
(15, 'kakak', 'kakaka', 'car', 1, 'Mercedes-Benz'),
(16, 'sziacica', 'baktalooooooo', 'car', 1, 'Lexus'),
(17, 'zuzz', 'uzzzz', 'car', 1, 'BMW'),
(18, 'zuzz', 'uzzzz', 'car', 1, 'BMW'),
(19, 'bbbba', 'hahaha', 'car', 1, 'Aptera Motors');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Aptera Motors'),
(2, 'Audi'),
(3, 'BMW'),
(4, 'Bollinger Motors'),
(5, 'BYD'),
(6, 'Canoo'),
(7, 'Chevrolet'),
(8, 'Citroën'),
(9, 'Cupra'),
(10, 'DS Automobiles'),
(11, 'Elextra'),
(12, 'Fiat'),
(13, 'Fisker'),
(14, 'Honda'),
(15, 'Hyundai'),
(16, 'Jaguar'),
(17, 'Kia'),
(18, 'Land Rover'),
(19, 'Lexus'),
(20, 'Lordstown Motors'),
(21, 'Mercedes-Benz'),
(22, 'MG Motor'),
(23, 'Mini'),
(24, 'Mitsubishi'),
(25, 'Nissan'),
(26, 'Opel'),
(27, 'Peugeot'),
(28, 'Polestar'),
(29, 'Porsche'),
(30, 'Renault'),
(31, 'Rimac'),
(32, 'Seat'),
(33, 'Seres'),
(34, 'Skoda'),
(35, 'Smart'),
(36, 'Tesla'),
(37, 'Toyota'),
(38, 'Volkswagen'),
(39, 'Volvo');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `images`
--

INSERT INTO `images` (`id`, `ad_id`, `file_path`) VALUES
(1, 13, 'uploads/20211008_150448792_iOS.jpg'),
(2, 13, 'uploads/20211008_150449192_iOS.jpg'),
(3, 13, 'uploads/20211008_150449416_iOS.jpg'),
(4, 13, 'uploads/20211008_150449695_iOS.jpg'),
(5, 13, 'uploads/20211008_150449925_iOS.jpg'),
(6, 13, 'uploads/20211008_150450409_iOS.jpg'),
(7, 14, 'uploads/20211008_150448792_iOS.jpg'),
(8, 14, 'uploads/20211008_150449192_iOS.jpg'),
(9, 14, 'uploads/20211008_150449416_iOS.jpg'),
(10, 14, 'uploads/20211008_150449695_iOS.jpg'),
(11, 14, 'uploads/20211008_150449925_iOS.jpg'),
(12, 14, 'uploads/20211008_150450409_iOS.jpg'),
(13, 15, 'uploads/20211008_150448792_iOS.jpg'),
(14, 15, 'uploads/20211008_150449192_iOS.jpg'),
(15, 15, 'uploads/20211008_150449416_iOS.jpg'),
(16, 15, 'uploads/20211008_150449695_iOS.jpg'),
(17, 15, 'uploads/20211008_150449925_iOS.jpg'),
(18, 15, 'uploads/20211008_150450409_iOS.jpg'),
(19, 16, 'uploads/e 63.jpg'),
(20, 17, 'uploads/20211008_150449192_iOS.jpg'),
(21, 17, 'uploads/20211008_150449416_iOS.jpg'),
(22, 17, 'uploads/20211008_150449695_iOS.jpg'),
(23, 18, 'uploads/20211008_150449192_iOS.jpg'),
(24, 18, 'uploads/20211008_150449416_iOS.jpg'),
(25, 18, 'uploads/20211008_150449695_iOS.jpg'),
(26, 19, 'uploads/20211008_150449192_iOS.jpg'),
(27, 19, 'uploads/20211008_150449416_iOS.jpg'),
(28, 19, 'uploads/20211008_150449695_iOS.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `fullname`, `phone`, `address`) VALUES
(1, 0, '$fullname', '$phone', '$address'),
(2, 1, 'Szitás Péter', '06703642049', 'Tölgyes út 28');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`) VALUES
(1, 'Szitás Péter', 'szitas01', 'petike.if@gmail.com', '$2y$10$ZYFBX4glb/9vfJql5izv6eMNqN66IH.1RHXMHQZE1hYpvES3EwKli'),
(2, 'Gatyás János', 'happyelephant438', 'kicsiatudod@gmail.com', '$2y$10$YzbFgYXuLpgnVTiR0KmBOuRrj2XsouyHNCqdRI.Ze0/cZNEE/bpH6'),
(3, 'Gatyás János', 'gatyasjanos', 'gatyagatya@gmail.com', '$2y$10$i8LC9gFXQFidcijqb93QXuQUhel5CxWSRqrkV1HGI9lFcdRJ9hhCm');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT a táblához `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT a táblához `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
