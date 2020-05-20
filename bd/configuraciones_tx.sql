-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2020 a las 07:49:34
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `spoc_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones_tx`
--
DROP TABLE `configuraciones_tx`;

CREATE TABLE `configuraciones_tx` (
  `id` int(5) NOT NULL,
  `id_producto` int(5) NOT NULL,
  `id_banner` int(5) NOT NULL,
  `id_tienda` int(5) NOT NULL,
  `id_exhibicion` int(5) NOT NULL,
  `precio` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `configuraciones_tx`
--

INSERT INTO `configuraciones_tx` (`id`, `id_producto`, `id_banner`, `id_tienda`, `id_exhibicion`, `precio`) VALUES
(1, 1, 2, 1, 1, 20.00),
(2, 1, 2, 1, 2, 20.00),
(3, 1, 2, 2, 3, 20.00),
(4, 1, 1, 4, 3, 26.00),
(5, 2, 2, 1, 4, 19.99),
(6, 3, 3, 9, 3, 19.00),
(7, 4, 3, 10, 3, 19.00),
(8, 5, 3, 11, 1, 17.90),
(9, 6, 2, 1, 3, 19.99),
(10, 1, 2, 1, 5, NULL),
(11, 1, 2, 1, 6, NULL),
(12, 1, 2, 2, 5, NULL),
(13, 2, 2, 1, 5, NULL),
(14, 5, 3, 11, 5, NULL),
(15, 6, 2, 1, 6, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuraciones_tx`
--
ALTER TABLE `configuraciones_tx`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuraciones_tx`
--
ALTER TABLE `configuraciones_tx`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
