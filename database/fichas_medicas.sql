_-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2022 a las 03:05:11
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `moon.app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas_medicas`
--

CREATE TABLE `fichas_medicas` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Paciente_ID` int(10) UNSIGNED NOT NULL,
  `Medico_ID` int(10) UNSIGNED NOT NULL,
  `Centromedico_ID` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `nro` int(11) NOT NULL,
  `turno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fichas_medicas`
--
ALTER TABLE `fichas_medicas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fichas_medicas_paciente_id_foreign` (`Paciente_ID`),
  ADD KEY `fichas_medicas_medico_id_foreign` (`Medico_ID`),
  ADD KEY `fichas_medicas_centromedico_id_foreign` (`Centromedico_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fichas_medicas`
--
ALTER TABLE `fichas_medicas`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fichas_medicas`
--
ALTER TABLE `fichas_medicas`
  ADD CONSTRAINT `fichas_medicas_centromedico_id_foreign` FOREIGN KEY (`Centromedico_ID`) REFERENCES `centros_medicos` (`ID`),
  ADD CONSTRAINT `fichas_medicas_medico_id_foreign` FOREIGN KEY (`Medico_ID`) REFERENCES `medicos` (`ID`),
  ADD CONSTRAINT `fichas_medicas_paciente_id_foreign` FOREIGN KEY (`Paciente_ID`) REFERENCES `pacientes` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
