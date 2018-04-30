-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2018 a las 19:05:16
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dwes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `precio` varchar(6) NOT NULL,
  `stock` varchar(6) NOT NULL,
  `cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripcion`, `imagen`, `precio`, `stock`, `cantidad`) VALUES
(1, 'Figura BB8', 'imagenes/1.png', '25', '10', 0),
(2, 'Chewbacca con AT-ST', 'imagenes/2.png', '35', '10', 0),
(3, 'Darth Vader', 'imagenes/3.jpg', '35', '10', 0),
(4, 'Luke & Leia', 'imagenes/4.jpg', '34', '10', 0),
(5, 'Splatoon 2', 'imagenes/5.jpg', '51', '10', 0),
(6, 'Dark Souls: Remastered', 'imagenes/6.jpg', '52', '10', 0),
(7, 'Monopoly', 'imagenes/7.jpg', '30', '10', 0),
(8, 'Rayman Legend', 'imagenes/8.jpg', '35', '10', 0),
(9, 'Poster Regreso al Futuro', 'imagenes/9.jpg', '25', '10', 0),
(10, 'Poster Juego de Tronos', 'imagenes/10.jpg', '35', '10', 0),
(11, 'The Legend of Zelda Arco y Flecha', 'imagenes/11.jpg', '35', '10', 0),
(12, 'Poster Harry Potter', 'imagenes/12.jpg', '34', '10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'pedro', 'pedro'),
(2, 'rosa', 'rosa'),
(3, 'antonio', 'antonio'),
(4, 'juanmi', 'juanmi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
