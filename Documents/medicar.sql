-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2017 a las 18:33:10
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `medicar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleta`
--

CREATE TABLE `boleta` (
  `num_boleta` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `boleta`
--

INSERT INTO `boleta` (`num_boleta`, `solicitud_id`, `nombre`, `monto`, `created_at`) VALUES
(2, 6, 'jean carlo', '1100.00', '2017-04-10'),
(3, 7, 'jean carlo', '350.00', '2017-04-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `garantia`
--

CREATE TABLE `garantia` (
  `solicitud_id` int(11) NOT NULL,
  `f_inicio` date NOT NULL,
  `f_final` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '1=>activo\n2=>inactivo\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `garantia`
--

INSERT INTO `garantia` (`solicitud_id`, `f_inicio`, `f_final`, `estado`) VALUES
(6, '2017-04-10', '2017-07-09', 2),
(7, '2017-04-10', '2017-05-10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `garantia_mecanico`
--

CREATE TABLE `garantia_mecanico` (
  `id` int(11) NOT NULL,
  `garantia_id` int(11) NOT NULL,
  `mecanico_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '1=>Ejecutando\n2=>Terminado\n3=>Cancelado',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `garantia_mecanico`
--

INSERT INTO `garantia_mecanico` (`id`, `garantia_id`, `mecanico_id`, `estado`, `created_at`) VALUES
(1, 6, 2, 3, '2017-04-10'),
(2, 6, 2, 2, '2017-04-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `origen` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`, `origen`) VALUES
(1, 'Toyota', 'Japón'),
(2, 'Hyundai', 'Korea'),
(3, 'Mazda', 'Japón'),
(4, 'Honda', 'Japón'),
(5, 'Chevrolet', 'Americano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mecanico`
--

CREATE TABLE `mecanico` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `dni` varchar(8) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '1=>activo\n2=>inactivo',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mecanico`
--

INSERT INTO `mecanico` (`id`, `nombre`, `apellidos`, `edad`, `dni`, `estado`, `created_at`) VALUES
(1, 'Básico', 'canevello', 26, '46611156', 1, '2017-04-09'),
(2, 'Roberto', 'De Paz', 40, '46611155', 1, '2017-04-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `marca_id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `version` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id`, `marca_id`, `nombre`, `version`) VALUES
(2, 1, 'Yaris', 'Sedán LT'),
(3, 1, 'Yaris', 'Hatchback GLS'),
(4, 2, 'Sonata', 'Sedán GLS'),
(5, 2, 'Sonata', 'Sedán GL'),
(6, 3, 'Mazda 3', 'Sedán'),
(7, 3, 'Mazda 3', 'Hatchback');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '1=>S. general\n2=>S. especial',
  `tiempo_garantia` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '1=>activo\n2=>inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `precio`, `tipo`, `tiempo_garantia`, `estado`) VALUES
(1, 'Básico', '350.00', 1, 1, 1),
(2, 'Medio', '450.00', 1, 2, 1),
(3, 'Integral', '600.00', 1, 3, 1),
(4, 'Premium', '1200.00', 1, 6, 1),
(5, 'Paquete 1', '200.00', 2, NULL, 1),
(6, 'Paquete 2', '500.00', 2, NULL, 1),
(7, 'Paquete 3', '700.00', 2, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id` int(11) NOT NULL,
  `placa` varchar(6) NOT NULL,
  `mecanico_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '1=>Ejecutando\n2=>pagado\n3=>cancelado',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id`, `placa`, `mecanico_id`, `estado`, `created_at`) VALUES
(6, 'b0z391', 2, 2, '2017-04-09'),
(7, 'b0z391', 1, 2, '2017-04-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_servicio`
--

CREATE TABLE `solicitud_servicio` (
  `solicitud_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud_servicio`
--

INSERT INTO `solicitud_servicio` (`solicitud_id`, `servicio_id`, `precio`) VALUES
(6, 3, '600.00'),
(6, 6, '500.00'),
(7, 1, '350.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `table_table`
--

CREATE TABLE `table_table` (
  `id` int(11) NOT NULL,
  `tabla` varchar(150) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `table_table`
--

INSERT INTO `table_table` (`id`, `tabla`, `name`, `value`) VALUES
(1, 'status', 'activo', 1),
(2, 'status', 'inactivo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_action`
--

CREATE TABLE `usr_action` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `action` varchar(100) NOT NULL,
  `controller` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usr_action`
--

INSERT INTO `usr_action` (`id`, `name`, `action`, `controller`) VALUES
(1, 'Listar mecánicos', 'index', 'mecanico'),
(2, 'Registrar nuevo mecánico', 'new', 'mecanico'),
(3, 'Editar mecánico', 'edit', 'mecanico'),
(4, 'Página bienvenida', 'index', 'Dashboard');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_profile`
--

CREATE TABLE `usr_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=>activo\n2=>inactivo',
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usr_profile`
--

INSERT INTO `usr_profile` (`id`, `name`, `status`, `value`) VALUES
(1, 'all', 1, 1),
(2, 'Cajero', 1, 2),
(3, 'Asesor', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_profile_action`
--

CREATE TABLE `usr_profile_action` (
  `id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usr_profile_action`
--

INSERT INTO `usr_profile_action` (`id`, `action_id`, `profile_id`) VALUES
(1, 4, 2),
(2, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_try_login`
--

CREATE TABLE `usr_try_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_user`
--

CREATE TABLE `usr_user` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(150) NOT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=>activo\n2=>inactivo\n',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usr_user`
--

INSERT INTO `usr_user` (`id`, `profile_id`, `key`, `username`, `password`, `name`, `last_name`, `status`, `created_at`) VALUES
(4, 1, '991b456bbae665f2ef51e37d54cce0baf24ae9c18da6f8316499a4fadf9f2d3a', 'master', 'eefd98a67e521b8cd74571adbf6b5fb4f7f98f5eabcc747fa8a8a5b101de7fab', 'Administrador', 'Sistema', 1, '2017-04-08'),
(5, 2, '617ce72da3777e1a1a4c131c00561832df82b7822f5a49b4e5c8367b3eeac53e', 'jramirezp', '01b866c2bfc3545de6611f23992592f162814ff30647d29e836e7b0930307561', 'Juan', 'Ramirez Perez', 1, '2017-04-08'),
(6, 3, '48430597722e04fb3f542a04975e54dd2b084733aca9fd4e4b228bad92357bf9', 'gsotoco', 'daa80638e66b71e6c3573e71521d0e9cc09479ac73f11f8fd01a880d8082f713', 'Guillermo', 'Soto Cordoba', 1, '2017-04-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `placa` varchar(6) NOT NULL,
  `modelo_id` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`placa`, `modelo_id`, `anio`, `created_at`) VALUES
('aaaaaa', 5, 21, '2017-04-09'),
('as.asd', 3, 2006, '2017-04-09'),
('asdasd', 4, 12, '2017-04-09'),
('b0z391', 4, 1997, '2017-04-09'),
('b0z396', 3, 2012, '2017-04-09'),
('sdfasd', 2, 2006, '2017-04-09'),
('xvzvcx', 2, 20, '2017-04-09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD PRIMARY KEY (`num_boleta`),
  ADD KEY `fk_boleta_solicitud1_idx` (`solicitud_id`);

--
-- Indices de la tabla `garantia`
--
ALTER TABLE `garantia`
  ADD PRIMARY KEY (`solicitud_id`);

--
-- Indices de la tabla `garantia_mecanico`
--
ALTER TABLE `garantia_mecanico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_table1_garantia1_idx` (`garantia_id`),
  ADD KEY `fk__mecanico1_idx` (`mecanico_id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mecanico`
--
ALTER TABLE `mecanico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_modelo_marca_idx` (`marca_id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_vehiculo1_idx` (`placa`),
  ADD KEY `fk_pedido_mecanico1_idx` (`mecanico_id`);

--
-- Indices de la tabla `solicitud_servicio`
--
ALTER TABLE `solicitud_servicio`
  ADD KEY `fk_pedido_servicio_pedido1_idx` (`solicitud_id`),
  ADD KEY `fk_pedido_servicio_servicio1_idx` (`servicio_id`);

--
-- Indices de la tabla `table_table`
--
ALTER TABLE `table_table`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usr_action`
--
ALTER TABLE `usr_action`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usr_profile`
--
ALTER TABLE `usr_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usr_profile_action`
--
ALTER TABLE `usr_profile_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_table1_accion1_idx` (`action_id`),
  ADD KEY `fk_perfil_accion_perfil1_idx` (`profile_id`);

--
-- Indices de la tabla `usr_try_login`
--
ALTER TABLE `usr_try_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usr_try_login_usr_user1_idx` (`user_id`);

--
-- Indices de la tabla `usr_user`
--
ALTER TABLE `usr_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_UNIQUE` (`username`),
  ADD KEY `fk_usuario_perfil1_idx` (`profile_id`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`placa`),
  ADD KEY `fk_vehiculo_modelo1_idx` (`modelo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boleta`
--
ALTER TABLE `boleta`
  MODIFY `num_boleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `garantia_mecanico`
--
ALTER TABLE `garantia_mecanico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `mecanico`
--
ALTER TABLE `mecanico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `table_table`
--
ALTER TABLE `table_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usr_action`
--
ALTER TABLE `usr_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usr_profile`
--
ALTER TABLE `usr_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usr_profile_action`
--
ALTER TABLE `usr_profile_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usr_try_login`
--
ALTER TABLE `usr_try_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usr_user`
--
ALTER TABLE `usr_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD CONSTRAINT `fk_boleta_solicitud1` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `garantia`
--
ALTER TABLE `garantia`
  ADD CONSTRAINT `fk_garantia_pedido1` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `garantia_mecanico`
--
ALTER TABLE `garantia_mecanico`
  ADD CONSTRAINT `fk__mecanico1` FOREIGN KEY (`mecanico_id`) REFERENCES `mecanico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table1_garantia1` FOREIGN KEY (`garantia_id`) REFERENCES `garantia` (`solicitud_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `fk_modelo_marca` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `fk_pedido_mecanico1` FOREIGN KEY (`mecanico_id`) REFERENCES `mecanico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_vehiculo1` FOREIGN KEY (`placa`) REFERENCES `vehiculo` (`placa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud_servicio`
--
ALTER TABLE `solicitud_servicio`
  ADD CONSTRAINT `fk_pedido_servicio_pedido1` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_servicio_servicio1` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usr_profile_action`
--
ALTER TABLE `usr_profile_action`
  ADD CONSTRAINT `fk_perfil_accion_perfil1` FOREIGN KEY (`profile_id`) REFERENCES `usr_profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table1_accion1` FOREIGN KEY (`action_id`) REFERENCES `usr_action` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usr_try_login`
--
ALTER TABLE `usr_try_login`
  ADD CONSTRAINT `fk_usr_try_login_usr_user1` FOREIGN KEY (`user_id`) REFERENCES `usr_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usr_user`
--
ALTER TABLE `usr_user`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`profile_id`) REFERENCES `usr_profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `fk_vehiculo_modelo1` FOREIGN KEY (`modelo_id`) REFERENCES `modelo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
