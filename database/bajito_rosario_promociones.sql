-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2024 a las 23:12:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bajito_rosario_promociones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `cod_promo` int(11) NOT NULL,
  `texto_promo` varchar(200) NOT NULL,
  `clave_promo` varchar(20) NOT NULL,
  `fecha_desde_promo` date NOT NULL,
  `fecha_hasta_promo` date NOT NULL,
  `categoria_cliente` varchar(10) NOT NULL,
  `dias_semana` varchar(20) NOT NULL,
  `estado_promo` varchar(10) NOT NULL,
  `cantidad_usos` int(11) NOT NULL,
  `cod_local` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`cod_promo`, `texto_promo`, `clave_promo`, `fecha_desde_promo`, `fecha_hasta_promo`, `categoria_cliente`, `dias_semana`, `estado_promo`, `cantidad_usos`, `cod_local`) VALUES
(24, '3x2', '', '2024-04-26', '2024-04-26', 'Inicial', '[1,0,1,0,1,0,1]', 'aprobada', 0, 5),
(25, '50% off', '', '2024-04-22', '2025-02-22', 'Inicial', '[1,1,1,1,1,0,0]', 'eliminado', 0, 1),
(26, 'Promo 4', '', '2024-04-22', '2024-12-22', 'Inicial', '[1,1,0,0,0,1,1]', 'eliminado', 0, 4),
(27, '20% off', '', '2024-04-22', '2025-03-20', 'Inicial', '[1,1,1,1,1,1,1]', 'eliminado', 0, 1),
(28, '3x2', '', '2024-04-22', '2025-04-26', 'Inicial', '[1,1,0,0,1,1,1]', 'aprobada', 0, 2),
(29, '50% off', '', '2024-04-22', '2024-10-19', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 3),
(30, '50% off', '', '2024-04-25', '2024-05-09', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 6),
(31, '50% off', '', '2024-04-26', '2024-05-03', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 1),
(32, '3x2', '', '2024-04-27', '2024-05-30', 'Inicial', '[1,0,0,0,1,1,0]', 'aprobada', 0, 1),
(33, 'Pruieba ale', '', '2024-04-26', '2024-05-24', 'Medium', '[1,0,1,0,1,0,0]', 'aprobada', 0, 1),
(34, 'prueb1', '', '2024-04-12', '2024-04-30', '', 'inicial', '[1,0,0,0,1', 0, 1),
(35, 'prueb1', '', '2024-04-12', '2024-04-30', 'inicial', 'inicial', '[1,0,0,0,1', 0, 1),
(36, 'prueb1', '', '2024-04-12', '2024-04-30', 'inicial', 'inicial', '[1,0,0,0,1', 0, 1),
(37, '50% off', '', '2024-06-16', '2024-12-27', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 1),
(38, '3x2', '', '2024-06-16', '2024-08-23', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 1),
(40, '3x2', '', '2024-06-16', '2024-08-23', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 1),
(41, 'Promo 4', '', '2024-06-16', '2024-06-22', 'Inicial', '[1,1,1,1,1,0,0]', 'denegada', 0, 1),
(42, '50% off', '', '2024-06-17', '2026-10-17', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 1),
(43, '20% off', '', '2024-06-17', '2026-02-17', 'Inicial', '[1,1,1,1,1,0,0]', 'denegada', 0, 1),
(44, 'Promo5', '', '2024-06-30', '2024-09-28', 'Inicial', '[1,1,0,0,0,1,1]', 'aprobada', 0, 1),
(45, 'Promo 6', '', '2024-07-01', '2024-11-29', 'inicial', '[1,0,0,1,0,1,0]', 'aprobada', 0, 7),
(46, '3x2', '21433553493d', '2024-07-01', '2024-10-19', 'inicial', '[1,1,1,1,1,0,0]', 'pendiente', 0, 1),
(47, '3x2', '376763', '2024-07-01', '2024-09-21', 'inicial', '[1,1,1,1,1,0,0]', 'pendiente', 0, 1),
(48, '20% off', '7bef4d', '2024-07-01', '2024-10-11', 'inicial', '[1,1,1,1,1,0,0]', 'pendiente', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`cod_promo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `cod_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
