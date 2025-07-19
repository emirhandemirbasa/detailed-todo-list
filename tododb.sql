-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 19 Tem 2025, 13:27:13
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `tododb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cinsiyetler`
--

CREATE TABLE `cinsiyetler` (
  `id` int(11) NOT NULL,
  `cinsiyet_adi` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `cinsiyetler`
--

INSERT INTO `cinsiyetler` (`id`, `cinsiyet_adi`) VALUES
(1, 'Erkek'),
(2, 'Kadın');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hesaplar`
--

CREATE TABLE `hesaplar` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hesap_detay`
--

CREATE TABLE `hesap_detay` (
  `id` int(11) NOT NULL,
  `isim` varchar(25) NOT NULL,
  `soyisim` varchar(25) NOT NULL,
  `profil_url` varchar(255) NOT NULL,
  `cinsiyet` int(11) NOT NULL,
  `hesap_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notlar`
--

CREATE TABLE `notlar` (
  `id` int(11) NOT NULL,
  `not_baslik` varchar(150) NOT NULL,
  `not_detay` mediumtext NOT NULL,
  `not_renk` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `not_sahip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cinsiyetler`
--
ALTER TABLE `cinsiyetler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hesaplar`
--
ALTER TABLE `hesaplar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hesap_detay`
--
ALTER TABLE `hesap_detay`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cinsiyetler`
--
ALTER TABLE `cinsiyetler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `hesaplar`
--
ALTER TABLE `hesaplar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `hesap_detay`
--
ALTER TABLE `hesap_detay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `notlar`
--
ALTER TABLE `notlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
