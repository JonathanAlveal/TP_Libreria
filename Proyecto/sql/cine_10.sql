-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2023 a las 02:17:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cine_10`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `id_funcion` int(11) NOT NULL,
  `id_peli` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `cant_max` int(11) DEFAULT NULL,
  `cant_actual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`id_funcion`, `id_peli`, `fecha`, `hora`, `cant_max`, `cant_actual`) VALUES
(1, 1, '2023-10-16', '20:30:00', 30, 11),
(2, 1, '2023-10-16', '22:00:00', 30, 16),
(3, 2, '2023-10-18', '20:10:00', 30, 17),
(4, 3, '2023-10-19', '12:30:00', 30, 23),
(5, 4, '2023-10-19', '13:45:00', 30, 18),
(6, 5, '2023-10-20', '20:00:00', 30, 10),
(7, 5, '2023-10-20', '23:30:00', 30, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_peli` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `trailer` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_peli`, `nombre`, `precio`,`trailer`,`imagen`) VALUES
(1, 'John Wick 4', 1600,'https://www.youtube.com/watch?v=L0anWmmd8TI','../img/jonk_wick4.jpeg'),
(2, 'Oppenheimer', 1800,'https://www.youtube.com/watch?v=MVvGSBKV504','../img/openhaimer.jpg'),
(3, 'Saw X', 1400,'https://www.youtube.com/watch?v=0Nth2F7KCD8','../img/SawX.jpg'),
(4, 'Avatar the way of water', 1900,'https://www.youtube.com/watch?v=L0anWmmd8TI','../img/avatar-the-way-of-water.webp'),
(5, 'Tortugas Ninjas Caos mutante', 1500,'https://www.youtube.com/watch?v=Ae5_Sm_b8Wc','../img/tortugasNinjas.webp');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`id_funcion`),
  ADD KEY `id_peli` (`id_peli`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_peli`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD CONSTRAINT `funciones_ibfk_1` FOREIGN KEY (`id_peli`) REFERENCES `peliculas` (`id_peli`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
