-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2024 a las 23:30:05
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
-- Estructura de tabla para la tabla `categorias_cliente`
--

CREATE TABLE IF NOT EXISTS `categorias_cliente` (
  `cod_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `promociones_minimas_adquiridas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_cliente`
--

INSERT INTO `categorias_cliente` (`cod_categoria`, `categoria`, `promociones_minimas_adquiridas`) VALUES
(2, 'medium', 1),
(3, 'premium', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cateogrias_locales`
--

CREATE TABLE IF NOT EXISTS `cateogrias_locales` (
  `cod_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cateogrias_locales`
--

INSERT INTO `cateogrias_locales` (`cod_categoria`, `categoria`) VALUES
(1, 'Accesorios'),
(2, 'Bebes y Niños'),
(5, 'Calzado'),
(6, 'Deporte'),
(7, 'Electrónica'),
(8, 'Estética'),
(9, 'Gastronomía'),
(10, 'Servicios'),
(11, 'Varios'),
(12, 'Indumentaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE IF NOT EXISTS `locales` (
  `cod_local` int(11) NOT NULL,
  `nombre_local` varchar(100) NOT NULL,
  `ubicacion_local` varchar(50) NOT NULL,
  `rubro_local` varchar(20) NOT NULL,
  `url_logo` varchar(200) NOT NULL,
  `cod_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `locales`
--

INSERT INTO `locales` (`cod_local`, `nombre_local`, `ubicacion_local`, `rubro_local`, `url_logo`, `cod_usuario`) VALUES
(1, 'Zadig', 'a2', 'Indumentaria', 'https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/ZADIG.webp', 15),
(2, 'Pandora', 'b2', 'Accesorios', 'https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/Pandora.webp', 15),
(3, 'Rapsodia', 'b3', 'Indumentaria', 'https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/Rapsodia.webp', 15),
(4, 'Canterbury', 'b2', 'Deporte', 'https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/Canterbury.webp', 15),
(5, 'Samsung', 'b3', 'Electrónica', 'https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/Samsung.webp', 15),
(6, 'Nike', 'a22', 'Deporte', 'https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/nike.webp', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

CREATE TABLE IF NOT EXISTS `novedades` (
  `cod_novedad` int(11) NOT NULL,
  `texto_novedad` varchar(200) NOT NULL,
  `fecha_desde_novedad` date NOT NULL,
  `fecha_hasta_novedad` date NOT NULL,
  `categoria_cliente` varchar(15) NOT NULL,
  `estado_novedad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `novedades`
--

INSERT INTO `novedades` (`cod_novedad`, `texto_novedad`, `fecha_desde_novedad`, `fecha_hasta_novedad`, `categoria_cliente`, `estado_novedad`) VALUES
(1, 'Planta B cerrada', '2024-04-13', '2024-04-27', 'cliente', 'no activa'),
(2, 'Planta B cerrada', '2024-04-13', '2024-04-27', 'cliente', 'no activa'),
(3, 'Patio de comida abierto', '2024-04-16', '2024-04-25', 'cliente', 'activa'),
(4, 'Local disponible en c3', '2024-04-16', '2024-04-30', 'dueno de local', 'activa'),
(5, 'Nuevo menu interactivo', '2024-04-16', '2024-04-25', 'admin', 'activa'),
(6, 'Inundacion', '2024-04-19', '2024-05-10', 'cliente', 'no activa'),
(7, 'Planta B cerrada', '2024-04-24', '2024-04-27', 'cliente', 'no activa'),
(8, 'Planta B cerrada', '2024-04-26', '2024-06-20', 'cliente', 'no activa'),
(9, 'Planta B cerrada', '2024-05-09', '2024-05-31', 'cliente', 'activa'),
(10, 'Nuevo Local en a22', '2024-05-09', '2024-05-31', 'dueno de local', 'activa'),
(11, 'Planta B cerrada', '2024-06-05', '2025-07-24', 'administrador', 'activa'),
(12, 'Planta B cerrada', '2024-06-29', '2024-11-22', 'medium', 'activa'),
(13, 'Prueba Medium', '2024-06-29', '2024-11-30', 'medium', 'activa'),
(14, 'Prueba Premium', '2024-06-29', '2025-01-04', 'premium', 'activa'),
(15, 'Prueba Inicial', '2024-06-29', '2024-11-30', 'inicial', 'activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE IF NOT EXISTS `promociones` (
  `cod_promo` int(11) NOT NULL,
  `texto_promo` varchar(200) NOT NULL,
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

INSERT INTO `promociones` (`cod_promo`, `texto_promo`, `fecha_desde_promo`, `fecha_hasta_promo`, `categoria_cliente`, `dias_semana`, `estado_promo`, `cantidad_usos`, `cod_local`) VALUES
(23, 'Promo 4', '2024-04-16', '2024-04-18', 'Inicial', '[0,1,2,3,4]', 'eliminado', 0, 1),
(24, '3x2', '2024-04-26', '2024-04-26', 'Inicial', '[1,0,1,0,1,0,1]', 'aprobada', 0, 5),
(25, '50% off', '2024-04-22', '2025-02-22', 'Inicial', '[1,1,1,1,1,0,0]', 'eliminado', 0, 1),
(26, 'Promo 4', '2024-04-22', '2024-12-22', 'Inicial', '[1,1,0,0,0,1,1]', 'aprobada', 0, 4),
(27, '20% off', '2024-04-22', '2025-03-20', 'Inicial', '[1,1,1,1,1,1,1]', 'eliminado', 0, 1),
(28, '3x2', '2024-04-22', '2025-04-26', 'Inicial', '[1,1,0,0,1,1,1]', 'aprobada', 0, 2),
(29, '50% off', '2024-04-22', '2024-10-19', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 3),
(30, '50% off', '2024-04-25', '2024-05-09', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 6),
(31, '50% off', '2024-04-26', '2024-05-03', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 1),
(32, '3x2', '2024-04-27', '2024-05-30', 'Inicial', '[1,0,0,0,1,1,0]', 'aprobada', 0, 1),
(33, 'Pruieba ale', '2024-04-26', '2024-05-24', 'Medium', '[1,0,1,0,1,0,0]', 'aprobada', 0, 1),
(34, 'prueb1', '2024-04-12', '2024-04-30', '', 'inicial', '[1,0,0,0,1', 0, 1),
(35, 'prueb1', '2024-04-12', '2024-04-30', 'inicial', 'inicial', '[1,0,0,0,1', 0, 1),
(36, 'prueb1', '2024-04-12', '2024-04-30', 'inicial', 'inicial', '[1,0,0,0,1', 0, 1),
(37, '50% off', '2024-06-16', '2024-12-27', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 1),
(38, '3x2', '2024-06-16', '2024-08-23', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 1),
(39, '3x2', '2024-06-16', '2024-08-23', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 1),
(40, '3x2', '2024-06-16', '2024-08-23', 'Inicial', '[1,1,1,1,1,0,0]', 'aprobada', 0, 1),
(41, 'Promo 4', '2024-06-16', '2024-06-22', 'Inicial', '[1,1,1,1,1,0,0]', 'denegada', 0, 1),
(42, '50% off', '2024-06-17', '2026-10-17', 'Inicial', '[1,1,1,1,1,0,0]', 'pendiente', 0, 1),
(43, '20% off', '2024-06-17', '2026-02-17', 'Inicial', '[1,1,1,1,1,0,0]', 'pendiente', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uso_promociones`
--

CREATE TABLE IF NOT EXISTS `uso_promociones` (
  `cod_uso` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_promo` int(11) NOT NULL,
  `fecha_uso_promo` date NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `uso_promociones`
--

INSERT INTO `uso_promociones` (`cod_uso`, `cod_cliente`, `cod_promo`, `fecha_uso_promo`, `estado`) VALUES
(14, 16, 24, '2024-04-22', 'enviada'),
(15, 15, 24, '2024-04-25', 'enviada'),
(16, 15, 29, '2024-04-25', 'enviada'),
(17, 32, 24, '2024-04-27', 'enviada'),
(19, 25, 30, '2024-05-04', 'enviada'),
(20, 31, 29, '2024-05-07', 'enviada'),
(21, 51, 30, '2024-05-09', 'enviada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave_usuario` varchar(100) NOT NULL,
  `tipo_usuario` varchar(15) NOT NULL,
  `categoria_cliente` varchar(10) NOT NULL,
  `estado_usuario` varchar(20) NOT NULL,
  `hash_validacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `nombre_usuario`, `email`, `clave_usuario`, `tipo_usuario`, `categoria_cliente`, `estado_usuario`, `hash_validacion`) VALUES
(13, 'pedro', 'pedro@pedro.com', '$2y$10$hEjARIwsafEXnJDh2GrHXOI445E8ZLtXJBlVMpiC3WkdFhgQ3FwqC', 'cliente', 'inicial', 'pendiente', ''),
(14, 'Juan', 'juan@juan.com', '$2y$10$NYK73eAj7aFwYm.lbdOlquBxyIDLA4R2aZpaIzK8dnHwUppaWn2Ui', 'cliente', '', 'pendiente', ''),
(15, 'dueno', 'dueno@dueno.com', '$2y$10$VZDxwbXo5MwDjeFv32/QwuDNnTDfhAb2GWXmfLk02Rk/5DYsoTufm', 'dueno de local', '', 'activa', ''),
(16, 'admin', 'admin@admin.com', '$2y$10$TWMMYm3cYnBcdcF6b2fo9OJcOwT3cSqxfbrok6/sYX/9.zx3msx4O', 'admin', '', 'activa', ''),
(25, 'cliente', 'cliente@cliente.com', '$2y$10$UOI/bL/C10OSdMRK.pQ4VepeJBNbN/n/48WHYL8WSIoU8iql.59j6', 'cliente', 'premium', 'activa', ''),
(31, 'Mateo', 'mateo@gmail.com', '$2y$10$QS3tf1b5hhTQkpBk7Q7DWuN9dfj67MrfbOh4vSB3r1eP016usSAeq', 'cliente', 'inicial', 'activa', ''),
(32, 'juampi', 'juampi@gmail.com', '$2y$10$u9AuIv04qvtsITWsqMz/0eYrIexx9rjjiYhEQQNEyQ87MmZhFrdHm', 'dueno de local', '', 'activa', ''),
(45, 'Juan', 'juan@gmail.com', '$2y$10$D1g/grcDDfp5by5RAOzHf.xxcXI.HwQi0mJ2dz/SDT3lcp60p5QD6', 'dueno de local', '', 'activo', 'cb4df8d63bc834aad4ead82390d525173b85357ab19373bd52e4e47e731bab4a'),
(54, 'Santiago', 'pedemax123@gmail.com', '$2y$10$1Zaal18rmjjuepRv9JdjluY8Kz23eH7TPuAmJJoL5weYf0uNK9jIm', 'cliente', 'inicial', 'activo', '6e8cf073f21c35dc8e3f14b8cb38ebcec4ac13a8c59c6b19ba984d5ac3f6cffe');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_cliente`
--
ALTER TABLE `categorias_cliente`
  ADD PRIMARY KEY (`cod_categoria`);

--
-- Indices de la tabla `cateogrias_locales`
--
ALTER TABLE `cateogrias_locales`
  ADD PRIMARY KEY (`cod_categoria`);

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
-- Indices de la tabla `uso_promociones`
--
ALTER TABLE `uso_promociones`
  ADD PRIMARY KEY (`cod_uso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_cliente`
--
ALTER TABLE `categorias_cliente`
  MODIFY `cod_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cateogrias_locales`
--
ALTER TABLE `cateogrias_locales`
  MODIFY `cod_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `locales`
--
ALTER TABLE `locales`
  MODIFY `cod_local` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `novedades`
--
ALTER TABLE `novedades`
  MODIFY `cod_novedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `cod_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `uso_promociones`
--
ALTER TABLE `uso_promociones`
  MODIFY `cod_uso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
