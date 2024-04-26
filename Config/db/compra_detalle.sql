-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 20-02-2024 a las 04:43:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `_sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_detalle`
--

CREATE TABLE `compra_detalle` (
  `detalle_id` int(11) NOT NULL,
  `proveedores_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `compra` varchar(50) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `sub_total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra_detalle`
--

INSERT INTO `compra_detalle` (`detalle_id`, `proveedores_id`, `usuario_id`, `compra`, `descripcion`, `precio`, `cantidad`, `sub_total`) VALUES
(12, 7, 1, 'Tela en yarda', 'Tela para camisas', 87, 6, 522),
(13, 8, 1, 'Hilos', 'Hilos al por mayor', 100, 10, 1000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD PRIMARY KEY (`detalle_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `proveedores_id` (`proveedores_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  MODIFY `detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD CONSTRAINT `compra_detalle_ibfk_1` FOREIGN KEY (`proveedores_id`) REFERENCES `proveedores` (`proveedores_id`),
  ADD CONSTRAINT `compra_detalle_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `_usuarios` (`id`),
  ADD CONSTRAINT `fk_compra_detalle_proveedores` FOREIGN KEY (`proveedores_id`) REFERENCES `proveedores` (`proveedores_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
