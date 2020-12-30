-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2020 a las 21:34:58
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `negocio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `idcaja` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `importecaja` decimal(9,2) NOT NULL,
  `fechacaja` date NOT NULL,
  `horacaja` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idcaja`, `idusuario`, `importecaja`, `fechacaja`, `horacaja`) VALUES
(2, 1, '300.00', '2020-08-23', '09:41:05'),
(10, 1, '1.00', '2020-08-24', '17:16:54'),
(11, 1, '180.00', '2020-08-24', '17:18:06'),
(13, 1, '589.00', '2020-08-25', '23:06:14'),
(17, 1, '5.00', '2020-08-26', '17:59:05'),
(19, 1, '5.00', '2020-09-02', '18:25:43'),
(21, 1, '10.00', '2020-09-03', '00:44:56'),
(22, 1, '1.00', '2020-09-05', '19:25:56'),
(23, 1, '50.00', '2020-09-06', '16:48:16'),
(24, 1, '1500.00', '2020-09-10', '08:55:55'),
(25, 1, '500.00', '2020-11-21', '21:28:17'),
(26, 1, '100000.00', '2020-11-22', '00:55:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `iddetalleventa` int(11) NOT NULL,
  `idfactura` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidadventa` int(11) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `subtotal` decimal(9,2) NOT NULL,
  `idregistrante` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`iddetalleventa`, `idfactura`, `idproducto`, `cantidadventa`, `precio`, `subtotal`, `idregistrante`) VALUES
(414, 0, 55, 1, '150.00', '150.00', 1),
(413, 0, 54, 1, '100.00', '100.00', 1),
(412, 0, 27, 1, '60.00', '60.00', 1),
(418, 1, 54, 1, '100.00', '100.00', 1),
(416, 1, 2, 1, '200.99', '200.99', 1),
(415, 1, 1, 1, '40.00', '40.00', 1),
(417, 1, 55, 1, '150.00', '150.00', 1),
(411, 0, 1, 1, '40.00', '40.00', 1),
(410, 401, 402, 300, '530.00', '550.00', 200),
(400, 401, 402, 300, '530.00', '550.00', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idfactura` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idvendedor` int(11) NOT NULL,
  `totalventa` decimal(9,2) NOT NULL,
  `condicionventa` int(3) NOT NULL,
  `comprobantetarjeta` varchar(200) NOT NULL,
  `fechaventa` datetime NOT NULL,
  `idregistrante` int(11) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idfactura`, `idcliente`, `idvendedor`, `totalventa`, `condicionventa`, `comprobantetarjeta`, `fechaventa`, `idregistrante`, `estado`) VALUES
(0, 1, 4, '5000.00', 1, '381', '2020-11-01 16:43:17', 33, '40'),
(1, 28, 24, '490.99', 1, '982', '2020-11-25 17:31:38', 1, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `idgastos` int(11) NOT NULL,
  `detalle` varchar(255) NOT NULL,
  `totalgastos` decimal(9,2) NOT NULL,
  `fechagastos` date NOT NULL,
  `horagastos` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`idgastos`, `detalle`, `totalgastos`, `fechagastos`, `horagastos`) VALUES
(7, 'Salario Empleados', '20000.00', '2020-09-06', '16:48:30'),
(11, 'factura de luz', '1000.00', '2020-09-10', '08:55:39'),
(12, 'factura de agua', '500.00', '2020-11-21', '17:10:22'),
(13, 'Impuesto al cheque', '300.00', '2020-11-22', '01:01:02'),
(14, 'Impuesto a respirar', '500.00', '2020-11-22', '01:01:15'),
(15, 'Factura de Gas', '1500.00', '2020-11-22', '01:02:11'),
(16, 'Impuestos restantes', '70000.00', '2020-11-22', '01:03:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `codigo` text NOT NULL,
  `stock` int(10) NOT NULL,
  `preciocompra` decimal(9,2) NOT NULL,
  `precioventa` decimal(9,2) NOT NULL,
  `fechaproducto` datetime NOT NULL,
  `idrubro` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `producto`, `descripcion`, `codigo`, `stock`, `preciocompra`, `precioventa`, `fechaproducto`, `idrubro`, `idusuario`) VALUES
(1, ' lavandina ayudin 1litro', 'Botella', '288', 8, '40.00', '50.55', '2020-05-14 09:05:10', 3, 2),
(2, ' bonobom caja x 20 unidades', 'Caja amarilla', '456', 1, '200.99', '251.88', '2020-05-14 09:05:10', 5, 1),
(31, 'aceite girasol', '2lt', '245', 34, '34.00', '34.00', '2020-06-30 21:22:13', 1, 1),
(50, 'sugus', 'caramelo', '22342', 2, '20.00', '30.00', '2020-09-05 19:15:12', 5, 1),
(30, 'chocolate milka choco pause ', '2 unidades', '123', 0, '20.00', '25.00', '2020-06-10 19:18:23', 5, 1),
(49, 'Fideos', 'Moñitos', '3333', 3, '3232.00', '350.00', '2020-09-05 18:57:03', 2, 1),
(27, ' gaseosa manaos', '3lt', '555', 53, '60.00', '65.00', '2020-06-03 23:37:56', 2, 1),
(51, 'Galleta', 'rumba', '030300', 500, '90.00', '110.00', '2020-11-21 17:12:26', 8, 1),
(52, 'Desodorante', 'Axe', '483', 0, '150.00', '200.00', '2020-11-21 21:30:14', 3, 1),
(53, 'Manteca', 'caja', '0200', 100, '75.00', '95.00', '2020-11-23 21:25:21', 9, 1),
(54, 'Beldent', 'Menta', '80', 98, '100.00', '110.00', '2020-11-25 00:00:30', 17, 1),
(55, 'Galletas', 'Tody', '120', 498, '150.00', '170.00', '2020-11-25 16:48:20', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idproveedor` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `actividad` text NOT NULL,
  `debe` decimal(9,2) NOT NULL,
  `haber` decimal(9,2) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idproveedor`, `idusuario`, `actividad`, `debe`, `haber`, `fecha`) VALUES
(1, 25, 'Coca Cola 3L', '700.00', '300.00', '2020-11-24 22:11:10'),
(2, 25, 'Coca Cola 2.5L', '700.00', '1000.00', '2020-11-24 22:11:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `idrubro` int(11) NOT NULL,
  `nombrerubro` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`idrubro`, `nombrerubro`) VALUES
(12, 'Panificacion'),
(11, 'Congelados'),
(10, 'Fiambres y Quesos'),
(9, 'Lacteos'),
(13, 'Pescaderia'),
(14, 'Jugueteria'),
(15, 'Libreria'),
(16, 'Bebidas'),
(17, 'Bazar'),
(18, 'Perfumeria'),
(19, 'Limpieza'),
(20, 'Verduleria'),
(21, 'Carniceria'),
(22, 'Pollos'),
(23, 'Pastas Frescas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(10) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` int(10) NOT NULL,
  `nacimiento` date NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `privilegio` int(1) NOT NULL,
  `idregistrante` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `usuario`, `password`, `nombre`, `apellido`, `dni`, `nacimiento`, `domicilio`, `localidad`, `provincia`, `telefono`, `email`, `sexo`, `privilegio`, `idregistrante`) VALUES
(1, 'gabriel', '1234', ' Gabriel', 'Luques', 987654321, '2020-05-06', 'uruguay 115', 'san miguel', 'tucuman', '38134242', 'gl@gmail.com', 'm', 1, 0),
(27, '', '', 'Susana', 'Guillen', 545325435, '1970-12-11', 'monteagudo 280', 'Capital', 'Tucuman', '7897987', 'susanag@gmail.com', 'F', 3, 33),
(26, '', '', 'Juana', 'Torres', 4797979, '1983-12-11', 'junin 320', 'Capital', 'Tucuman', '4589798', 'juanatorres@gmail.com', 'F', 6, 9),
(25, '', '', 'Chapo', 'Guzman', 49878787, '1973-03-11', 'mate de luna 1200', 'Yerba Buena', 'Tucuman', '4798779', 'chapoguzman@gmail.com', 'M', 5, 1000),
(24, '', '', 'Luciana', 'Villalva', 489563, '1989-03-11', 'america 233', 'Simoca', 'Tucuman', '4897987', 'luciavillalba@gmail.com', 'F', 2, 200),
(23, '', '', 'Lionel', 'Messi', 36987412, '1989-08-22', 'san juan 200', 'Burruyacu', 'Tucuman', '157412369', 'liomesi@gmail.com', 'M', 4, 10),
(22, '', '', 'Gustavo', 'Lopez', 3574696, '1989-01-18', 'la plata 1230', 'Capital', 'Tucuman', '4395741', 'glopez@gmail.com', 'M', 3, 1),
(28, '', '', 'Agus', 'Bob', 977978122, '1999-12-02', 'saenz peña 700', 'Yerba Buena', 'Tucuman', '49879789', 'agusbob@gmail.com', 'M', 5, 77);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idcaja`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`iddetalleventa`),
  ADD KEY `iddetalleventa` (`iddetalleventa`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idfactura`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`idgastos`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`idrubro`),
  ADD KEY `idrubro` (`idrubro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idusuario` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `idcaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idgastos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `idrubro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
