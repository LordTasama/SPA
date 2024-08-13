-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2024 a las 13:41:03
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
-- Base de datos: `spa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_cliente` bigint(20) NOT NULL,
  `id_servicio` int(3) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id`, `fecha`, `id_cliente`, `id_servicio`, `estado`) VALUES
(1, '2024-06-18 07:00:00', 1234567890, 2, 0),
(2, '2024-05-25 11:00:00', 987654321, 2, 0),
(3, '2024-05-24 10:00:00', 1234567890, 1, 0),
(4, '2024-05-25 11:00:00', 987654321, 1, 0),
(7, '2024-06-19 07:00:00', 1234567890, 1, 0),
(8, '2024-06-18 20:47:00', 1234567890, 1, 0),
(9, '2024-06-18 08:45:00', 1234567890, 3, 0),
(10, '2024-06-20 07:24:00', 1234567890, 4, 0),
(11, '2024-06-18 11:57:00', 1234567890, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` bigint(20) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `direccion` varchar(85) DEFAULT 'SIN REGISTRAR',
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(85) DEFAULT 'SIN REGISTRAR',
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombres`, `apellidos`, `direccion`, `telefono`, `correo`, `estado`) VALUES
(987654321, 'Ana', 'Gómez', 'Avenida Siempre Viva 742', '3117654321', 'ana.gomez@gmail.com', 1),
(1234567890, 'Juan', 'Pérez', 'Calle Falsa 123', '3111234567', 'juan.perez@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id` bigint(20) NOT NULL,
  `id_registro_sesion` bigint(20) NOT NULL,
  `id_factura` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_sesion`
--

CREATE TABLE `detalle_sesion` (
  `id` bigint(20) NOT NULL,
  `id_registro_sesion` bigint(20) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `metodo_pago` varchar(30) NOT NULL,
  `id_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `stock`, `nombre`, `tipo`, `precio`, `estado`) VALUES
(1, 25, 'Crema Facial', 'Crema', 25000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_sesion`
--

CREATE TABLE `registro_sesion` (
  `id` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `duracion` varchar(45) NOT NULL,
  `id_cliente` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `id_servicio` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` tinyint(1) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Secretaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(3) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `duracion` varchar(45) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `id_terapeuta` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `tipo`, `duracion`, `precio`, `estado`, `id_terapeuta`) VALUES
(1, 'Masaje Relajante', 'Masaje', '60 minutos', 50000.00, 1, 21212),
(2, 'Terapia Física', 'Terapia', '45 minutos', 70000.00, 1, 21212),
(3, 'Masaje Deportivo', 'Masaje', '90 minutos', 100000.00, 1, 12),
(4, 'Facial Rejuvenecedor', 'Facial', '30 minutos', 40000.00, 1, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terapeuta`
--

CREATE TABLE `terapeuta` (
  `id` bigint(20) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `terapeuta`
--

INSERT INTO `terapeuta` (`id`, `nombres`, `apellidos`, `telefono`, `correo`, `password`, `hora_inicio`, `hora_fin`, `estado`) VALUES
(12, 'Jhon', 'Narvaez', 212121, 'alexnarvaez981@gmail.com', 'sena2024', '08:00:00', '01:00:00', 1),
(21212, 'Freddy', 'Lopez', 3000212, 'alexlopez981@gmail.com', 'sena2024', '08:00:00', '01:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `id_rol` tinyint(1) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombres`, `apellidos`, `telefono`, `correo`, `password`, `id_rol`, `hora_inicio`, `hora_fin`, `estado`) VALUES
(1006322117, 'Héctor', 'Restrepo Soto', 3146125812, 'hector.soto@gmail.com', '$2y$10$dF4DZz84BG6g92Vzkx5iduRyWy1OU9k/qN12oMWxTPTV8L1Dv101y', 1, '02:14:16', '12:00:00', 1),
(2345678901, 'María', 'Rodríguez', 3001234567, 'maria.rodriguez@gmail.com', '$2y$10$dF4DZz84BG6g92Vzkx5iduRyWy1OU9k/qN12oMWxTPTV8L1Dv101y', 2, '00:00:00', '00:00:00', 1),
(3456789012, 'Carlos', 'López', 3007654321, 'carlos.lopez@gmail.com', '$2y$10$dF4DZz84BG6g92Vzkx5iduRyWy1OU9k/qN12oMWxTPTV8L1Dv101y', 2, '00:00:00', '00:00:00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Citas_Clientes1_idx` (`id_cliente`),
  ADD KEY `fk_Citas_Servicios1_idx` (`id_servicio`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_DetalleFactura_RegistroSesiones1_idx` (`id_registro_sesion`),
  ADD KEY `fk_DetalleFactura_Facturacion1_idx` (`id_factura`);

--
-- Indices de la tabla `detalle_sesion`
--
ALTER TABLE `detalle_sesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_registro_sesion_producto_idx` (`id_producto`),
  ADD KEY `fk_registro_sesion_idx` (`id_registro_sesion`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Facturacion_Empleados1_idx` (`id_usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_sesion`
--
ALTER TABLE `registro_sesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_RegistroSesiones_Clientes1_idx` (`id_cliente`),
  ADD KEY `fk_RegistroSesiones_Terapeutas1_idx` (`id_usuario`),
  ADD KEY `fk_RegistroSesiones_Servicios1_idx` (`id_servicio`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servicio_terapeuta` (`id_terapeuta`);

--
-- Indices de la tabla `terapeuta`
--
ALTER TABLE `terapeuta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Usuario_Roles1_idx` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_sesion`
--
ALTER TABLE `detalle_sesion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `registro_sesion`
--
ALTER TABLE `registro_sesion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_Citas_Clientes1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `fk_Citas_Servicios1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`);

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `fk_DetalleFactura_Facturacion1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id`),
  ADD CONSTRAINT `fk_DetalleFactura_RegistroSesiones1` FOREIGN KEY (`id_registro_sesion`) REFERENCES `registro_sesion` (`id`);

--
-- Filtros para la tabla `detalle_sesion`
--
ALTER TABLE `detalle_sesion`
  ADD CONSTRAINT `fk_RegistroSesiones_has_ProductosUtilizados_ProductosUtilizad1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `fk_RegistroSesiones_has_ProductosUtilizados_RegistroSesiones1` FOREIGN KEY (`id_registro_sesion`) REFERENCES `registro_sesion` (`id`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_Facturacion_Usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `registro_sesion`
--
ALTER TABLE `registro_sesion`
  ADD CONSTRAINT `fk_RegistroSesiones_Clientes1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `fk_RegistroSesiones_Servicios1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `fk_RegistroSesiones_Terapeutas1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_servicio_terapeuta` FOREIGN KEY (`id_terapeuta`) REFERENCES `terapeuta` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Empleados_Roles1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
