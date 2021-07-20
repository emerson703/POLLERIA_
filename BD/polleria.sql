-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2021 a las 08:11:47
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `polleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientes`
--

CREATE TABLE `tbclientes` (
  `IdCliente` int(11) NOT NULL,
  `Nombres` varchar(255) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Dni` int(11) DEFAULT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Estado` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbclientes`
--

INSERT INTO `tbclientes` (`IdCliente`, `Nombres`, `Apellidos`, `Dni`, `Direccion`, `Telefono`, `Estado`) VALUES
(1, 'Jesus', 'Cruz Jimenez', 65325346, 'Calle Los olivos', '981924343', 1),
(2, 'Rosa Maria', 'Cruz', 87563454, 'av Jesus', '92842395', 1),
(5, 'Jean', 'Cuba Castro', 85437534, 'los olivos', '984395543', 0),
(8, 'Lucas', 'Jimenez Suarez', 74353455, 'av Brazil', '983143892', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdetalleventa`
--

CREATE TABLE `tbdetalleventa` (
  `IdDetalleVenta` int(11) NOT NULL,
  `IdVenta` int(11) DEFAULT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `SubTotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbprivilegios`
--

CREATE TABLE `tbprivilegios` (
  `IdPrivilegio` int(11) NOT NULL,
  `Privilegio` varchar(20) DEFAULT NULL,
  `Estado` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbprivilegios`
--

INSERT INTO `tbprivilegios` (`IdPrivilegio`, `Privilegio`, `Estado`) VALUES
(1, 'Adminstrador', 1),
(2, 'user', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproductos`
--

CREATE TABLE `tbproductos` (
  `IdProducto` int(11) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Precio` double(10,2) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Detalle` text DEFAULT NULL,
  `Estado` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbproductos`
--

INSERT INTO `tbproductos` (`IdProducto`, `Descripcion`, `Precio`, `Stock`, `Detalle`, `Estado`) VALUES
(1, 'pollo', 8.00, 50, 'pollos enteros', 1),
(2, 'gaseosa Coca Cola', 10.00, 10, '10 cajas de gaseosa', 1),
(3, 'gaseosa Inka Kola', 10.00, 10, '10 cajas de gaseosa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `IdUsuario` int(11) NOT NULL,
  `Dni` varchar(20) DEFAULT NULL,
  `Nombres` varchar(100) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `FechaIngreso` date DEFAULT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `Clave` varchar(100) DEFAULT NULL,
  `IdPrivilegio` int(11) DEFAULT NULL,
  `Estado` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbusuarios`
--

INSERT INTO `tbusuarios` (`IdUsuario`, `Dni`, `Nombres`, `Apellidos`, `Direccion`, `Telefono`, `FechaIngreso`, `Usuario`, `Clave`, `IdPrivilegio`, `Estado`) VALUES
(1, '65423455', 'Victor', 'Fernandez Carrillo', 'Calle Los olivos', '985454666', '2021-04-02', 'admin', 'admin', 1, 1),
(2, '12345', 'Fernanda', 'Lopez Vejar', 'Calle Mirador', '89465466', '2021-07-21', 'fernanda', 'fernanda', 2, 1),
(3, '6472342', 'Emerson ', 'Vilcas', 'Santa Rosa', '98442343', '2021-07-13', 'emerson', 'emerson', 1, 1),
(4, '65325346', 'Lucio', 'Dominguez Chavez', 'los claveles', '981924343', '2021-07-14', 'lucio', 'lucio', 2, 1),
(5, '12345', 'Miriam', 'Cruz Jimenez', 'Calle Puente Arnao', '981242394', '2021-07-19', 'miriam', 'miriam', 2, 1),
(8, '12334', 'Jesus Angel', 'Ortega Llanos', 'Calle monterrey', '928424432', '2021-07-18', 'jesus', 'jesus', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbventas`
--

CREATE TABLE `tbventas` (
  `IdVenta` int(11) NOT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `PrecioTotal` decimal(10,2) DEFAULT NULL,
  `FechaVenta` date DEFAULT NULL,
  `Estado` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbclientes`
--
ALTER TABLE `tbclientes`
  ADD PRIMARY KEY (`IdCliente`);

--
-- Indices de la tabla `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  ADD PRIMARY KEY (`IdDetalleVenta`),
  ADD KEY `IdVenta` (`IdVenta`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `tbprivilegios`
--
ALTER TABLE `tbprivilegios`
  ADD PRIMARY KEY (`IdPrivilegio`);

--
-- Indices de la tabla `tbproductos`
--
ALTER TABLE `tbproductos`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `IdPrivilegio` (`IdPrivilegio`);

--
-- Indices de la tabla `tbventas`
--
ALTER TABLE `tbventas`
  ADD PRIMARY KEY (`IdVenta`),
  ADD KEY `IdCliente` (`IdCliente`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbclientes`
--
ALTER TABLE `tbclientes`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  MODIFY `IdDetalleVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbprivilegios`
--
ALTER TABLE `tbprivilegios`
  MODIFY `IdPrivilegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbproductos`
--
ALTER TABLE `tbproductos`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbventas`
--
ALTER TABLE `tbventas`
  MODIFY `IdVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  ADD CONSTRAINT `IdProducto` FOREIGN KEY (`IdProducto`) REFERENCES `tbproductos` (`IdProducto`),
  ADD CONSTRAINT `IdVenta` FOREIGN KEY (`IdVenta`) REFERENCES `tbventas` (`IdVenta`);

--
-- Filtros para la tabla `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD CONSTRAINT `IdPrivilegio` FOREIGN KEY (`IdPrivilegio`) REFERENCES `tbprivilegios` (`IdPrivilegio`);

--
-- Filtros para la tabla `tbventas`
--
ALTER TABLE `tbventas`
  ADD CONSTRAINT `IdCliente` FOREIGN KEY (`IdCliente`) REFERENCES `tbclientes` (`IdCliente`),
  ADD CONSTRAINT `IdUsuario` FOREIGN KEY (`IdUsuario`) REFERENCES `tbusuarios` (`IdUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
