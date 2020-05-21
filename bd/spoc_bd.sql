-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2020 a las 23:15:45
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
-- Estructura de tabla para la tabla `banner`
--

CREATE TABLE `banner` (
  `id` int(5) NOT NULL,
  `dsc_banner` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `banner`
--

INSERT INTO `banner` (`id`, `dsc_banner`) VALUES
(1, 'WONG'),
(2, 'TOTTUS'),
(3, 'PLAZA VEA'),
(4, 'METRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(5) NOT NULL,
  `dsc_categoria` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `dsc_categoria`) VALUES
(1, 'Café');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencia`
--

CREATE TABLE `competencia` (
  `id` int(5) NOT NULL,
  `dsc_competencia` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_banner` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `competencia`
--

INSERT INTO `competencia` (`id`, `dsc_competencia`, `id_banner`) VALUES
(1, 'Altomayo 170', 1),
(2, 'Altomayo 170', 2),
(3, 'Altomayo 170', 3),
(4, 'Juan Valdez Premium', 1),
(5, 'Juan Valdez Premium', 2),
(6, 'Juan Valdez Premium', 4),
(7, 'Juan Valdez 150gr', 3),
(8, 'Juan Valdez 150gr', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones_tx`
--

CREATE TABLE `configuraciones_tx` (
  `id` int(5) NOT NULL,
  `id_producto` int(5) NOT NULL,
  `id_banner` int(5) NOT NULL,
  `id_tienda` int(5) NOT NULL,
  `id_exhibicion` int(5) NOT NULL,
  `precio` float(10,2) DEFAULT NULL,
  `sku_cadena` varchar(10) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `configuraciones_tx`
--

INSERT INTO `configuraciones_tx` (`id`, `id_producto`, `id_banner`, `id_tienda`, `id_exhibicion`, `precio`, `sku_cadena`) VALUES
(1, 1, 2, 1, 1, 20.00, '105'),
(2, 1, 2, 1, 2, 20.00, '105'),
(3, 1, 2, 2, 3, 20.00, '105'),
(4, 1, 1, 4, 3, 26.00, 'ht001'),
(5, 2, 2, 1, 4, 19.99, '105'),
(6, 3, 3, 9, 3, 19.00, 'T004'),
(7, 4, 3, 10, 3, 19.00, 'T001'),
(8, 5, 3, 11, 1, 17.90, 'T002'),
(9, 6, 2, 1, 3, 19.99, '105'),
(10, 1, 2, 1, 5, NULL, '105'),
(11, 1, 2, 1, 6, NULL, '105'),
(12, 1, 2, 2, 5, NULL, '105'),
(13, 2, 2, 1, 5, NULL, '105'),
(14, 5, 3, 11, 5, NULL, 'T002'),
(15, 6, 2, 1, 6, NULL, '105');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_spoc`
--

CREATE TABLE `detalle_spoc` (
  `id` int(5) NOT NULL,
  `id_tx` int(5) NOT NULL,
  `id_usuario` int(20) NOT NULL,
  `id_tienda` int(5) NOT NULL,
  `id_producto` int(5) NOT NULL,
  `id_exhibicion` int(5) NOT NULL,
  `precio` float DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8_bin NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `flg_competencia` varchar(2) COLLATE utf8_bin NOT NULL,
  `dsc_competencia` varchar(50) COLLATE utf8_bin NOT NULL,
  `flg_existe` varchar(2) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exhibiciones`
--

CREATE TABLE `exhibiciones` (
  `id` int(5) NOT NULL,
  `dsc_exhibicion` varchar(50) COLLATE utf8_bin NOT NULL,
  `tipo` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `exhibiciones`
--

INSERT INTO `exhibiciones` (`id`, `dsc_exhibicion`, `tipo`) VALUES
(1, 'Cabecera', 'EXH'),
(2, 'Ruma', 'EXH'),
(3, 'Lateral', 'EXH'),
(4, 'Cabeceras checkout', 'EXH'),
(5, 'Jalavistas', 'EDV'),
(6, 'Marco de góndola', 'EDV');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(5) NOT NULL,
  `sku_nestle` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `id_categoria` int(5) NOT NULL,
  `dsc_producto` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `sku_nestle`, `id_categoria`, `dsc_producto`) VALUES
(1, '4155678', 1, 'Nescafe 200'),
(2, '4155672', 1, 'Kirma 100'),
(3, '4155676', 1, 'Fina selección 175'),
(4, '7155678', 1, 'Gold 200'),
(5, '8155678', 1, 'Gold 100'),
(6, '9155678', 1, 'Decaf 170gr'),
(999, NULL, 1, 'Competencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id` int(5) NOT NULL,
  `dsc_tienda` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_ubicacion` int(5) NOT NULL,
  `id_banner` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id`, `dsc_tienda`, `id_ubicacion`, `id_banner`) VALUES
(1, 'Tottus Angamos', 1, 2),
(2, 'Tottus San Luis', 1, 2),
(3, 'Tottus Comandante', 3, 2),
(4, 'Wong chacarilla', 1, 1),
(5, 'Wong Tomas marsano', 1, 1),
(6, 'Wong Aurora', 1, 1),
(7, 'Wong 2 de mayo', 3, 1),
(8, 'Wong Ovalo Gutierrez', 3, 1),
(9, 'Plaza vea Bolichera', 2, 3),
(10, 'Plaza Vea Caminos', 1, 3),
(11, 'Plaza Vea Higuereta', 1, 3),
(12, 'Metro Angamos', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id` int(5) NOT NULL,
  `dsc_ubicacion` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id`, `dsc_ubicacion`) VALUES
(1, 'Surco'),
(2, 'Miraflores'),
(3, 'San Isidro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banner`
--
ALTER TABLE `banner`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `competencia`
--
ALTER TABLE `competencia`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `configuraciones_tx`
--
ALTER TABLE `configuraciones_tx`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `detalle_spoc`
--
ALTER TABLE `detalle_spoc`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `exhibiciones`
--
ALTER TABLE `exhibiciones`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `configuraciones_tx`
--
ALTER TABLE `configuraciones_tx`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detalle_spoc`
--
ALTER TABLE `detalle_spoc`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
