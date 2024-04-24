-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2024 a las 01:52:48
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
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE `locales` (
  `cod_local` int(11) NOT NULL,
  `nombre_local` varchar(100) NOT NULL,
  `ubicacion_local` varchar(50) NOT NULL,
  `rubro_local` varchar(20) NOT NULL,
  `cod_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `locales`
--

INSERT INTO `locales` (`cod_local`, `nombre_local`, `ubicacion_local`, `rubro_local`, `cod_usuario`) VALUES
(1, 'Balenciaga', 'a2', 'indumentaria', 1),
(2, 'Gucci', 'b2', 'Indumentaria', 15),
(3, 'Prada', 'b3', 'Indumentaria', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

CREATE TABLE `novedades` (
  `cod_novedad` int(11) NOT NULL,
  `texto_novedad` varchar(200) NOT NULL,
  `fecha_desde_novedad` date NOT NULL,
  `fecha_hasta_novedad` date NOT NULL,
  `tipo_usuario` varchar(15) NOT NULL,
  `estado_novedad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `novedades`
--

INSERT INTO `novedades` (`cod_novedad`, `texto_novedad`, `fecha_desde_novedad`, `fecha_hasta_novedad`, `tipo_usuario`, `estado_novedad`) VALUES
(1, 'Planta B cerrada', '2024-04-13', '2024-04-27', 'cliente', 'no activa'),
(2, 'Planta B cerrada', '2024-04-13', '2024-04-27', 'cliente', 'activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `cod_promo` int(11) NOT NULL,
  `texto_promo` varchar(200) NOT NULL,
  `fecha_desde_promo` date NOT NULL,
  `fecha_hasta_promo` date NOT NULL,
  `categoria_cliente` varchar(10) NOT NULL,
  `dias_semana` int(11) NOT NULL,
  `estado_promo` varchar(10) NOT NULL,
  `cod_local` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`cod_promo`, `texto_promo`, `fecha_desde_promo`, `fecha_hasta_promo`, `categoria_cliente`, `dias_semana`, `estado_promo`, `cod_local`) VALUES
(1, 'promo 2x1', '2024-04-12', '2024-04-30', 'inicial', 1, 'aprobada', 1),
(2, '3x2', '2024-04-12', '2024-04-26', 'Inicial', 0, 'aprobada', 1),
(3, '4x3', '2024-04-12', '2024-04-26', 'Inicial', 0, 'eliminado', 1),
(4, '50% off', '2024-04-12', '2024-04-25', 'Inicial', 0, 'denegada', 1),
(5, '30% off', '2024-04-12', '2024-04-26', 'Inicial', 0, 'pendiente', 1),
(6, '20% off', '2024-04-12', '2024-04-26', 'Inicial', 0, 'denegada', 1),
(7, '3x2', '2024-04-12', '2024-04-26', 'Inicial', 0, 'denegada', 1),
(8, '4x3', '2024-04-26', '2024-04-19', 'Inicial', 0, 'pendiente', 1),
(9, '3x2', '2024-04-12', '2024-04-19', 'Inicial', 0, 'pendiente', 1),
(10, '3x2', '2024-04-12', '2024-04-26', 'Inicial', 0, 'pendiente', 1),
(11, '4x3', '2024-04-12', '2024-04-26', 'Inicial', 0, 'pendiente', 1),
(12, '75% off', '2024-04-13', '2024-04-27', 'Inicial', 0, 'eliminado', 1),
(13, '77% off', '2024-04-13', '2024-04-27', 'Inicial', 0, 'denegada', 1),
(14, '50% off', '2024-04-13', '2024-04-27', 'Medium', 0, 'aprobada', 1),
(15, '3x2', '2024-04-13', '2024-04-27', 'Inicial', 0, 'pendiente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uso_promociones`
--

CREATE TABLE `uso_promociones` (
  `cod_cliente` int(11) NOT NULL,
  `cod_promo` int(11) NOT NULL,
  `fecha_uso_promo` date NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave_usuario` varchar(100) NOT NULL,
  `tipo_usuario` varchar(15) NOT NULL,
  `categoria_cliente` varchar(10) NOT NULL,
  `estado_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `nombre_usuario`, `email`, `clave_usuario`, `tipo_usuario`, `categoria_cliente`, `estado_usuario`) VALUES
(13, 'pedro', 'pedro@pedro.com', '$2y$10$hEjARIwsafEXnJDh2GrHXOI445E8ZLtXJBlVMpiC3WkdFhgQ3FwqC', 'cliente', '', 'pendiente'),
(14, 'Juan', 'juan@juan.com', '$2y$10$NYK73eAj7aFwYm.lbdOlquBxyIDLA4R2aZpaIzK8dnHwUppaWn2Ui', 'cliente', '', 'pendiente'),
(15, 'dueno', 'dueno@dueno.com', '$2y$10$VZDxwbXo5MwDjeFv32/QwuDNnTDfhAb2GWXmfLk02Rk/5DYsoTufm', 'dueno de local', '', 'pendiente'),
(16, 'admin', 'admin@admin.com', '$2y$10$TWMMYm3cYnBcdcF6b2fo9OJcOwT3cSqxfbrok6/sYX/9.zx3msx4O', 'admin', '', 'pendiente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`cod_local`);

--
-- Indices de la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD PRIMARY KEY (`cod_novedad`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`cod_promo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `locales`
--
ALTER TABLE `locales`
  MODIFY `cod_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `novedades`
--
ALTER TABLE `novedades`
  MODIFY `cod_novedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `cod_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
