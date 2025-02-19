-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2025 a las 20:14:00
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
-- Base de datos: `inmobiliaria`
CREATE DATABASE inmobiliaria;
USE inmobiliaria;
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprados`
--

CREATE TABLE `comprados` (
  `usuario_comprador` int(5) NOT NULL,
  `codigo_piso` int(11) NOT NULL,
  `Precio_final` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pisos`
--

CREATE TABLE `pisos` (
  `codigo_piso` int(11) NOT NULL,
  `calle` varchar(40) NOT NULL,
  `numero` int(11) NOT NULL,
  `piso` int(11) NOT NULL,
  `puerta` varchar(5) NOT NULL,
  `cp` int(11) NOT NULL,
  `metros` int(11) NOT NULL,
  `zona` varchar(15) DEFAULT NULL,
  `precio` float NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `piso_usuario_id` int(5) NOT NULL,
  `comprado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(5) NOT NULL,
  `nombres` varchar(35) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(80) NOT NULL,
  `tipo_usuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nombres`, `correo`, `clave`, `tipo_usuario`) VALUES
(14, 'comprador', 'comprador@gmail.com', '$2y$10$H01oPgMgUdxbcSSqhuC0revJKJZcUy60YlgscLJIIIPjQyKPQIn9a', '1'),
(15, 'Administrador', 'admin@gmail.com', '$2y$10$rBDrToe4nDHf0gWpjYrikuScd9/auPqOa6t5Pk44v1LNXJdUHRvz2', '3'),
(25, 'vendedor cuenta', 'vendedor@gmail.com', '$2y$10$yX1h3dR.XfD491Y8txGjFeRccK1FUSM/x7RvVdnbCt3BUef/ZrCPq', '2'),
(26, 'Daniel Manogil', 'ejemplo@gmail.com', '$2y$10$ERUNP71VQ4ZX.izPdvNqcemjRAQHgK1G2uQN9PUieZQsZZJzOWZDG', '2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comprados`
--
ALTER TABLE `comprados`
  ADD PRIMARY KEY (`usuario_comprador`,`codigo_piso`) USING BTREE,
  ADD KEY `comprado-piso` (`codigo_piso`);

--
-- Indices de la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD PRIMARY KEY (`codigo_piso`),
  ADD KEY `pisos-usuario` (`piso_usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comprados`
--
ALTER TABLE `comprados`
  MODIFY `usuario_comprador` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pisos`
--
ALTER TABLE `pisos`
  MODIFY `codigo_piso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comprados`
--
ALTER TABLE `comprados`
  ADD CONSTRAINT `comprado-piso` FOREIGN KEY (`codigo_piso`) REFERENCES `pisos` (`codigo_piso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comprados-usuario` FOREIGN KEY (`usuario_comprador`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD CONSTRAINT `pisos-usuario` FOREIGN KEY (`piso_usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
