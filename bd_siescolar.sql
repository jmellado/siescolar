-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2017 a las 06:24:11
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_siescolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acudientes`
--

CREATE TABLE `acudientes` (
  `id_acudiente` int(11) NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `parentesco` varchar(45) NOT NULL,
  `ocupacion` varchar(45) NOT NULL,
  `direccion_trabajo` varchar(45) NOT NULL,
  `telefono_trabajo` varchar(10) NOT NULL,
  `estado_acudiente` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `nombre_area` varchar(45) NOT NULL,
  `estado_area` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id_asignatura` int(11) NOT NULL,
  `nombre_asignatura` varchar(45) NOT NULL,
  `id_area` int(11) NOT NULL,
  `estado_asignatura` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidatos_eleccion`
--

CREATE TABLE `candidatos_eleccion` (
  `id_eleccion` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `partido` varchar(45) NOT NULL,
  `observaciones` varchar(45) NOT NULL,
  `estado_candidato` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargas_academicas`
--

CREATE TABLE `cargas_academicas` (
  `id_carga_academica` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `año_lectivo` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desempeños`
--

CREATE TABLE `desempeños` (
  `id_desempeño` int(11) NOT NULL,
  `nombre_desempeño` varchar(45) NOT NULL,
  `rango_inicial` int(11) NOT NULL,
  `rango_final` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elecciones`
--

CREATE TABLE `elecciones` (
  `id_eleccion` int(11) NOT NULL,
  `nombre_eleccion` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_eleccion` date NOT NULL,
  `estado_eleccion` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id_persona` int(11) NOT NULL,
  `institucion_procedencia` varchar(45) NOT NULL,
  `discapacidad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_persona`, `institucion_procedencia`, `discapacidad`) VALUES
(2, 'manuela beltran', 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id_grado` int(11) NOT NULL,
  `nombre_grado` varchar(30) NOT NULL,
  `ciclo_grado` varchar(45) NOT NULL,
  `jornada` varchar(30) NOT NULL,
  `año_lectivo` year(4) NOT NULL,
  `estado_grado` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(30) NOT NULL,
  `estado_grupo` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listado_votantes`
--

CREATE TABLE `listado_votantes` (
  `id_eleccion` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `voto` varchar(45) NOT NULL,
  `fecha_voto` date NOT NULL,
  `estado_votante` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id_matricula` int(11) NOT NULL,
  `fecha_matricula` date NOT NULL,
  `año_lectivo` year(4) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_acudiente` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `observaciones` varchar(45) NOT NULL,
  `estado_matricula` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_nota` int(11) NOT NULL,
  `año_lectivo` year(4) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `p1` decimal(10,0) DEFAULT NULL,
  `p2` decimal(10,0) DEFAULT NULL,
  `p3` decimal(10,0) DEFAULT NULL,
  `p4` decimal(10,0) DEFAULT NULL,
  `nota_final` decimal(10,0) DEFAULT NULL,
  `id_desempeño` int(11) NOT NULL,
  `fallas` varchar(45) NOT NULL,
  `estado_nota` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padres`
--

CREATE TABLE `padres` (
  `id_padre` int(11) NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `ocupacion` varchar(45) NOT NULL,
  `direccion_trabajo` varchar(45) NOT NULL,
  `telefono_trabajo` varchar(10) NOT NULL,
  `estado_padre` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pensum`
--

CREATE TABLE `pensum` (
  `id_pensum` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `intensidad_horaria` int(11) NOT NULL,
  `año_lectivo` year(4) NOT NULL,
  `estado_pensum` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `tipo_id` varchar(2) NOT NULL,
  `fecha_expedicion` date DEFAULT NULL,
  `departamento_expedicion` varchar(45) DEFAULT NULL,
  `municipio_expedicion` varchar(45) DEFAULT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellido1` varchar(45) NOT NULL,
  `apellido2` varchar(45) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `lugar_nacimiento` varchar(45) DEFAULT NULL,
  `tipo_sangre` varchar(2) DEFAULT NULL,
  `eps` varchar(45) DEFAULT NULL,
  `poblacion` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `barrio` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `identificacion`, `tipo_id`, `fecha_expedicion`, `departamento_expedicion`, `municipio_expedicion`, `nombres`, `apellido1`, `apellido2`, `sexo`, `fecha_nacimiento`, `lugar_nacimiento`, `tipo_sangre`, `eps`, `poblacion`, `telefono`, `email`, `direccion`, `barrio`) VALUES
(1, '12345', 'cc', '2017-04-10', 'Cesar', 'Valledupar', 'Siescolar', 'Siescolar', 'Siescolar', 'm', '2017-04-10', 'Valledupar', 'o+', 'ninguna', 'ninguna', '3135028786', 'siescolar@gmail.com', 'calle 7 # 29-90', 'nueva esperanza'),
(2, '1065656097', 'cc', '2017-04-22', 'Cesar', 'Valledupar', 'Jeiner Enrique', 'Mellado', 'Valencia', 'm', '2017-04-22', 'valledupar', 'o+', 'coosalud', 'ninguna', '3135028786', 'je_in_er@hotmail.com', 'calle 7 # 29-90', 'nueva esperanza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_persona` int(11) NOT NULL,
  `perfil` varchar(45) NOT NULL,
  `escalafon` varchar(45) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `tipo_contrato` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'administrador', NULL),
(2, 'estudiante', NULL),
(3, 'profesor', NULL),
(4, 'acudiente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salones`
--

CREATE TABLE `salones` (
  `id_salon` int(11) NOT NULL,
  `nombre_salon` varchar(30) NOT NULL,
  `observacion` varchar(45) NOT NULL,
  `estado_salon` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salones_grupo`
--

CREATE TABLE `salones_grupo` (
  `id_salon` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `acceso` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_persona`, `id_rol`, `username`, `password`, `acceso`) VALUES
(1, 1, 1, 'siescolar', '8cb2237d0679ca88db6464eac60da96345513964', '1'),
(2, 2, 2, 'JeMellado2', '929ebab87f27a5b353ad388ebfc63dbbd369c71a', '1');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `eliminar_estudiantes_personas` AFTER DELETE ON `usuarios` FOR EACH ROW begin
DELETE FROM estudiantes where id_persona=old.id_persona;
DELETE FROM personas where id_persona=old.id_persona;
end
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acudientes`
--
ALTER TABLE `acudientes`
  ADD PRIMARY KEY (`id_acudiente`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id_asignatura`),
  ADD KEY `fk_asignaturas_areas_idx` (`id_area`);

--
-- Indices de la tabla `candidatos_eleccion`
--
ALTER TABLE `candidatos_eleccion`
  ADD PRIMARY KEY (`id_eleccion`);

--
-- Indices de la tabla `cargas_academicas`
--
ALTER TABLE `cargas_academicas`
  ADD PRIMARY KEY (`id_carga_academica`),
  ADD UNIQUE KEY `id_cargaacademica_UNIQUE` (`id_carga_academica`),
  ADD KEY `fk_cargas_personas_idx` (`id_profesor`),
  ADD KEY `fk_cargas_asignaturas_idx` (`id_asignatura`),
  ADD KEY `fk_cargas_grados_idx` (`id_grado`),
  ADD KEY `fk_cargas_grupos_idx` (`id_grupo`);

--
-- Indices de la tabla `desempeños`
--
ALTER TABLE `desempeños`
  ADD PRIMARY KEY (`id_desempeño`);

--
-- Indices de la tabla `elecciones`
--
ALTER TABLE `elecciones`
  ADD PRIMARY KEY (`id_eleccion`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id_grado`),
  ADD UNIQUE KEY `nombre_grado_UNIQUE` (`nombre_grado`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `listado_votantes`
--
ALTER TABLE `listado_votantes`
  ADD PRIMARY KEY (`id_eleccion`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id_matricula`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `fk_notas_estudiantes_idx` (`id_estudiante`),
  ADD KEY `fk_notas_asignaturas_idx` (`id_asignatura`),
  ADD KEY `fk_notas_desempeños_idx` (`id_desempeño`);

--
-- Indices de la tabla `padres`
--
ALTER TABLE `padres`
  ADD PRIMARY KEY (`id_padre`);

--
-- Indices de la tabla `pensum`
--
ALTER TABLE `pensum`
  ADD PRIMARY KEY (`id_pensum`),
  ADD UNIQUE KEY `id_pensum_UNIQUE` (`id_pensum`),
  ADD KEY `fk_pensum_grados_idx` (`id_grado`),
  ADD KEY `fk_pensum_asignaturas_idx` (`id_asignatura`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `id_persona_UNIQUE` (`id_persona`),
  ADD UNIQUE KEY `identificacion_UNIQUE` (`identificacion`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `salones`
--
ALTER TABLE `salones`
  ADD PRIMARY KEY (`id_salon`),
  ADD UNIQUE KEY `nombre_salon_UNIQUE` (`nombre_salon`);

--
-- Indices de la tabla `salones_grupo`
--
ALTER TABLE `salones_grupo`
  ADD UNIQUE KEY `id_salon_UNIQUE` (`id_salon`),
  ADD KEY `fk_salones_idx` (`id_salon`),
  ADD KEY `fk_grados_idx` (`id_grado`),
  ADD KEY `fk_grupos_idx` (`id_grupo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `fk_usuarios_personas_idx` (`id_persona`),
  ADD KEY `fk_usuarios_roles_idx` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acudientes`
--
ALTER TABLE `acudientes`
  MODIFY `id_acudiente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cargas_academicas`
--
ALTER TABLE `cargas_academicas`
  MODIFY `id_carga_academica` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `desempeños`
--
ALTER TABLE `desempeños`
  MODIFY `id_desempeño` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `elecciones`
--
ALTER TABLE `elecciones`
  MODIFY `id_eleccion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pensum`
--
ALTER TABLE `pensum`
  MODIFY `id_pensum` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `salones`
--
ALTER TABLE `salones`
  MODIFY `id_salon` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `fk_asignaturas_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `candidatos_eleccion`
--
ALTER TABLE `candidatos_eleccion`
  ADD CONSTRAINT `fk_candidatos_elecciones` FOREIGN KEY (`id_eleccion`) REFERENCES `elecciones` (`id_eleccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cargas_academicas`
--
ALTER TABLE `cargas_academicas`
  ADD CONSTRAINT `fk_cargas_asignaturas` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cargas_grados` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cargas_grupos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cargas_personas` FOREIGN KEY (`id_profesor`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `listado_votantes`
--
ALTER TABLE `listado_votantes`
  ADD CONSTRAINT `fk_votantes_elecciones` FOREIGN KEY (`id_eleccion`) REFERENCES `elecciones` (`id_eleccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `fk_notas_asignaturas` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_desempeños` FOREIGN KEY (`id_desempeño`) REFERENCES `desempeños` (`id_desempeño`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_estudiantes` FOREIGN KEY (`id_estudiante`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pensum`
--
ALTER TABLE `pensum`
  ADD CONSTRAINT `fk_pensum_asignaturas` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pensum_grados` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `salones_grupo`
--
ALTER TABLE `salones_grupo`
  ADD CONSTRAINT `fk_grados` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grupos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salones` FOREIGN KEY (`id_salon`) REFERENCES `salones` (`id_salon`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
