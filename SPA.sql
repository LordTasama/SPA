-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2024 a las 02:34:07
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
-- Base de datos: `bd_spa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacionesservicios`
--

CREATE TABLE `asignacion_servicio` (
  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `horario` varchar(45) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `id_servicio` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `cita` (
  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `id_cliente` bigint(20) NOT NULL,
  `id_servicio` int(3) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `cita` VALUES
(NULL, '2024-05-24 10:00:00', 1234567890, 1, 0),
(NULL, '2024-05-25 11:00:00', 987654321, 2, 0),
(NULL, '2024-05-24 10:00:00', 1234567890, 1, 0),
(NULL, '2024-05-25 11:00:00', 987654321, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `cliente` (
  `id` bigint(20) NOT NULL PRIMARY KEY,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `direccion` varchar(85) DEFAULT "SIN REGISTRAR",
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(85) DEFAULT "SIN REGISTRAR",
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `cliente` VALUES
(1234567890, 'Juan', 'Pérez','Calle Falsa 123', '3111234567', 'juan.perez@gmail.com',1),
(987654321, 'Ana', 'Gómez','Avenida Siempre Viva 742', '3117654321', 'ana.gomez@gmail.com',1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detalle_factura` (
  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_registro_sesion` bigint(20) NOT NULL,
  `id_factura` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL PRIMARY KEY,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `horario` varchar(45) NOT NULL,
  `id_rol` tinyint(1) NOT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `usuario` VALUES
(1006322117, 'Héctor', 'Restrepo Soto', 3146125812,'hector.soto@gmail.com','$2y$10$dF4DZz84BG6g92Vzkx5iduRyWy1OU9k/qN12oMWxTPTV8L1Dv101y','6:00 am a 12:00 pm', 1, 1),
(2345678901, 'María', 'Rodríguez', 3001234567, 'maria.rodriguez@gmail.com','$2y$10$dF4DZz84BG6g92Vzkx5iduRyWy1OU9k/qN12oMWxTPTV8L1Dv101y','6:00 am a 12:00 pm', 3, 1 ),
(3456789012, 'Carlos', 'López',  3007654321, 'carlos.lopez@gmail.com','$2y$10$dF4DZz84BG6g92Vzkx5iduRyWy1OU9k/qN12oMWxTPTV8L1Dv101y', '6:00 am a 12:00 pm', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `factura` (
  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `total` DECIMAL(11, 2) NOT NULL,
  `metodo_pago` varchar(30) NOT NULL,
  `id_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias`
--

CREATE TABLE `preferencia` (
  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_cliente` bigint(20) NOT NULL,
  `id_servicio` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `stock` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `precio` DECIMAL(9, 2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `producto`VALUES
(NULL, 25, 'Crema Facial', 'Crema',25000.00,1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrosesiones`
--

CREATE TABLE `registro_sesion` (
  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `duracion` varchar(45) NOT NULL,
  `id_cliente` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `id_servicio` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `registrosesiones`
--

-- INSERT INTO `registro_sesion` VALUES
-- (1, '2024-05-28 10:00:00', '1 Hora', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrosesiones_has_productosutilizados`
--

CREATE TABLE `detalle_sesion` (
  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_registro_sesion` bigint(20) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `rol` (
  `id` tinyint(1) NOT NULL PRIMARY KEY,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `rol` VALUES
(1, 'Administrador'),
(2, 'Secretaria'),
(3,'Terapeuta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicio` (
  `id` int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `duracion` varchar(45) NOT NULL,
  `precio` DECIMAL(9, 2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicio` VALUES
(NULL, 'Masaje Relajante', 'Masaje', '60 minutos', 50000.00,1),
(NULL, 'Terapia Física', 'Terapia', '45 minutos', 70000.00,1),
(NULL, 'Masaje Deportivo', 'Masaje', '90 minutos', 100000.00,1),
(NULL, 'Facial Rejuvenecedor', 'Facial', '30 minutos', 40000.00,1);

-- --------------------------------------------------------

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacionesservicios`
--
ALTER TABLE `asignacion_servicio`
  ADD KEY `fk_asignacion_usuario_idx` (`id_usuario`),
  ADD KEY `fk_asignacion_servicio_idx` (`id_servicio`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `cita`
  ADD KEY `fk_Citas_Clientes1_idx` (`id_cliente`),
  ADD KEY `fk_Citas_Servicios1_idx` (`id_servicio`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detalle_factura`
  ADD KEY `fk_DetalleFactura_RegistroSesiones1_idx` (`id_registro_sesion`),
  ADD KEY `fk_DetalleFactura_Facturacion1_idx` (`id_factura`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `usuario`
  ADD KEY `fk_Usuario_Roles1_idx` (`id_rol`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `factura`
  ADD KEY `fk_Facturacion_Empleados1_idx` (`id_usuario`);

--
-- Indices de la tabla `preferencias`
--
ALTER TABLE `preferencia`
  ADD KEY `fk_Preferencias_Clientes_idx` (`id_cliente`),
  ADD KEY `fk_Preferencias_Servicios1_idx` (`id_servicio`);


--
-- Indices de la tabla `registrosesiones`
--
ALTER TABLE `registro_sesion`
  ADD KEY `fk_RegistroSesiones_Clientes1_idx` (`id_cliente`),
  ADD KEY `fk_RegistroSesiones_Terapeutas1_idx` (`id_usuario`),
  ADD KEY `fk_RegistroSesiones_Servicios1_idx` (`id_servicio`);

--
-- Indices de la tabla `registrosesiones_has_productosutilizados`
--
ALTER TABLE `detalle_sesion`
  ADD KEY `fk_registro_sesion_producto_idx` (`id_producto`),
  ADD KEY `fk_registro_sesion_idx` (`id_registro_sesion`);
--
-- Indices de la tabla `roles`

--
-- Indices de la tabla `servicios`
--

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacionesservicios`
--
ALTER TABLE `asignacion_servicio`
  ADD CONSTRAINT `fk_AsignacionesServicios_Servicios1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `fk_AsignacionesServicios_Terapeutas1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_Citas_Clientes1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `fk_Citas_Servicios1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`);

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `fk_DetalleFactura_Facturacion1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id`),
  ADD CONSTRAINT `fk_DetalleFactura_RegistroSesiones1` FOREIGN KEY (`id_registro_sesion`) REFERENCES `registro_sesion` (`id`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Empleados_Roles1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `facturacion`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_Facturacion_Usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `preferencias`
--
ALTER TABLE `preferencia`
  ADD CONSTRAINT `fk_Preferencias_Clientes` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `fk_Preferencias_Servicios1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`);

--
-- Filtros para la tabla `registrosesiones`
--
ALTER TABLE `registro_sesion`
  ADD CONSTRAINT `fk_RegistroSesiones_Clientes1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `fk_RegistroSesiones_Servicios1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `fk_RegistroSesiones_Terapeutas1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `registrosesiones_has_productosutilizados`
--
ALTER TABLE `detalle_sesion`
  ADD CONSTRAINT `fk_RegistroSesiones_has_ProductosUtilizados_ProductosUtilizad1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `fk_RegistroSesiones_has_ProductosUtilizados_RegistroSesiones1` FOREIGN KEY (`id_registro_sesion`) REFERENCES `registro_sesion` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
