-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2019 a las 01:29:14
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

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
-- Estructura de tabla para la tabla `acciones_pedagogicas`
--

CREATE TABLE `acciones_pedagogicas` (
  `id_accion_pedagogica` int(11) NOT NULL,
  `accion_pedagogica` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acciones_pedagogicas`
--

INSERT INTO `acciones_pedagogicas` (`id_accion_pedagogica`, `accion_pedagogica`) VALUES
(1, 'Amonestación Verbal En Privado'),
(2, 'Amonestación Escrita'),
(3, 'Suspensión De Clases');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id_actividad` int(11) NOT NULL,
  `descripcion_actividad` varchar(300) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `periodo` varchar(8) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `ano_lectivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `descripcion_actividad`, `id_profesor`, `id_curso`, `id_asignatura`, `periodo`, `fecha_registro`, `ano_lectivo`) VALUES
(1, 'Trabajo Escrito Sobre La Poesia', 3, 1, 11, 'Primero', '2018-10-24 03:28:41', 1),
(2, 'Esposicion Sobre La Poesia', 3, 1, 11, 'Primero', '2018-10-24 03:33:22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acudientes`
--

CREATE TABLE `acudientes` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `ocupacion` varchar(45) NOT NULL,
  `telefono_trabajo` varchar(10) NOT NULL,
  `direccion_trabajo` varchar(45) NOT NULL,
  `estado_acudiente` varchar(8) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acudientes`
--

INSERT INTO `acudientes` (`id`, `id_persona`, `ocupacion`, `telefono_trabajo`, `direccion_trabajo`, `estado_acudiente`) VALUES
(1, 53, 'Profesor', '3126573421', 'Sempegua, Barrio La Paz', 'Activo'),
(2, 54, 'Ama De Casa', '3126753428', 'Sempegua, Barrio La Paz', 'Activo'),
(3, 55, 'Ama De Casa', '3126784523', 'Sempegua, Barrio La Paz', 'Activo'),
(4, 56, 'Profesora', '3126542390', 'Sempegua, Barrio La Paz', 'Activo'),
(5, 57, 'Agricultor', '3145692310', 'Sempegua, Barrio La Paz', 'Activo'),
(6, 58, 'Ama De Casa', '3167564312', 'Sempegua, Barrio La Paz', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_persona` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_persona`, `fecha_registro`) VALUES
(1, '2018-10-22 18:04:44'),
(33, '2018-10-24 05:11:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anos_lectivos`
--

CREATE TABLE `anos_lectivos` (
  `id_ano_lectivo` int(11) NOT NULL,
  `nombre_ano_lectivo` year(4) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado_ano_lectivo` varchar(8) NOT NULL,
  `seleccionado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anos_lectivos`
--

INSERT INTO `anos_lectivos` (`id_ano_lectivo`, `nombre_ano_lectivo`, `fecha_inicio`, `fecha_fin`, `estado_ano_lectivo`, `seleccionado`) VALUES
(1, 2018, '2018-01-13', '2018-12-10', 'Activo', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `nombre_area` varchar(45) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `estado_area` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `nombre_area`, `ano_lectivo`, `estado_area`) VALUES
(1, ' ', 0, 'Activo'),
(2, 'Matematica', 1, 'Activo'),
(3, 'Ciencias Sociales', 1, 'Activo'),
(4, 'Ciencias Naturales', 1, 'Activo'),
(5, 'Humanidades', 1, 'Activo'),
(6, 'Religion', 1, 'Activo'),
(8, 'Educacion Fisica', 1, 'Activo'),
(13, 'Educacion Artistica', 1, 'Activo'),
(16, 'Educacion Etica Y Val', 1, 'Activo'),
(18, 'Informatica', 1, 'Activo'),
(19, 'Emprendimiento', 1, 'Activo'),
(20, 'Comportamiento', 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id_asignatura` int(11) NOT NULL,
  `nombre_asignatura` varchar(45) NOT NULL,
  `id_area` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `estado_asignatura` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id_asignatura`, `nombre_asignatura`, `id_area`, `ano_lectivo`, `estado_asignatura`) VALUES
(1, ' ', 1, 0, 'Activo'),
(2, 'Matematica', 2, 1, 'Activo'),
(3, 'Geografia', 3, 1, 'Activo'),
(4, 'Historia', 3, 1, 'Activo'),
(5, 'Competencia Ciudadana', 3, 1, 'Activo'),
(6, 'Catedra Afrocolombiana', 3, 1, 'Activo'),
(7, 'Quimica', 4, 1, 'Activo'),
(8, 'Fisica', 4, 1, 'Activo'),
(9, 'Biologia', 4, 1, 'Activo'),
(10, 'Ecologia', 4, 1, 'Activo'),
(11, 'Lengua Castellana', 5, 1, 'Activo'),
(12, 'Lengua Extrangera', 5, 1, 'Activo'),
(13, 'Religion', 6, 1, 'Activo'),
(14, 'Educacion Fisica', 8, 1, 'Activo'),
(15, 'Educacion Artistica', 13, 1, 'Activo'),
(16, 'Educacion Etica Y Val', 16, 1, 'Activo'),
(17, 'Informatica', 18, 1, 'Activo'),
(18, 'Emprendimiento', 19, 1, 'Activo'),
(19, 'Comportamiento Escolar', 20, 1, 'Activo'),
(20, 'Ciencias Naturales', 4, 1, 'Activo'),
(21, 'Ciencias Sociales', 3, 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id_asistencia` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `periodo` varchar(8) NOT NULL,
  `fecha` date NOT NULL,
  `asistencia` varchar(45) NOT NULL,
  `horas` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidatos_eleccion`
--

CREATE TABLE `candidatos_eleccion` (
  `id_candidato_eleccion` int(11) NOT NULL,
  `id_eleccion` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `partido` varchar(45) NOT NULL,
  `votos` varchar(45) NOT NULL,
  `estado_candidato` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `candidatos_eleccion`
--

INSERT INTO `candidatos_eleccion` (`id_candidato_eleccion`, `id_eleccion`, `id_estudiante`, `numero`, `partido`, `votos`, `estado_candidato`) VALUES
(1, 1, 2, '00', 'En Blanco', '4', 'Activo'),
(2, 1, 15, '002', 'Movimiento En Busca De La Excelencia', '14', 'Activo'),
(3, 1, 20, '001', 'Todos Por Una Mejor Educacion', '11', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargas_academicas`
--

CREATE TABLE `cargas_academicas` (
  `id_carga_academica` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargas_academicas`
--

INSERT INTO `cargas_academicas` (`id_carga_academica`, `id_profesor`, `id_curso`, `id_asignatura`, `ano_lectivo`) VALUES
(1, 3, 1, 11, 1),
(2, 3, 2, 11, 1),
(3, 27, 1, 7, 1),
(4, 27, 2, 7, 1),
(5, 31, 1, 17, 1),
(6, 31, 2, 17, 1),
(7, 17, 1, 3, 1),
(8, 17, 2, 3, 1),
(9, 27, 2, 10, 1),
(10, 27, 1, 9, 1),
(11, 27, 2, 9, 1),
(12, 5, 1, 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'periodo academico'),
(2, 'votacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causales`
--

CREATE TABLE `causales` (
  `id_causal` int(11) NOT NULL,
  `causal` varchar(500) NOT NULL,
  `id_tipo_causal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `causales`
--

INSERT INTO `causales` (`id_causal`, `causal`, `id_tipo_causal`) VALUES
(1, 'Asistir puntualmente a clases y demás actividades programadas por el Centro Educativo.', 1),
(2, 'Permanecer dentro del plantel durante la jornada escolar y en los sitios    programados por cada actividad.', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos_pagos`
--

CREATE TABLE `conceptos_pagos` (
  `id_concepto_pago` int(11) NOT NULL,
  `nombre_concepto` varchar(25) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterios`
--

CREATE TABLE `criterios` (
  `id_criterio` int(11) NOT NULL,
  `nombre_criterio` varchar(500) NOT NULL,
  `codigo_criterio` int(11) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `categoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `criterios`
--

INSERT INTO `criterios` (`id_criterio`, `nombre_criterio`, `codigo_criterio`, `prioridad`, `categoria`) VALUES
(1, 'Número De Áreas o Asignaturas Reprobadas', 1, 3, 'Estudiante'),
(2, 'Porcentaje Total De Inasistencias', 2, 1, 'Estudiante'),
(3, 'Reprobación Por Perdida De Asignaturas Especificas', 3, 2, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterios_asignados`
--

CREATE TABLE `criterios_asignados` (
  `id_criterio_asignado` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_criterio` int(11) NOT NULL,
  `numero_areas_asignaturas` int(11) DEFAULT NULL,
  `porcentaje_inasistencias` int(11) DEFAULT NULL,
  `asignatura_especifica` int(11) DEFAULT NULL,
  `promedio_general` decimal(11,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cronogramas`
--

CREATE TABLE `cronogramas` (
  `id_actividad` int(11) NOT NULL,
  `nombre_actividad` varchar(45) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `descripcion_actividad` varchar(100) NOT NULL,
  `fecha_inicial` date NOT NULL,
  `fecha_final` date NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `estado_actividad` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cronogramas`
--

INSERT INTO `cronogramas` (`id_actividad`, `nombre_actividad`, `id_categoria`, `descripcion_actividad`, `fecha_inicial`, `fecha_final`, `ano_lectivo`, `estado_actividad`) VALUES
(1, 'Primero', 1, 'Fechas Para El Ingreso De Calificaciones.', '2018-10-20', '2018-11-09', 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `director` int(11) NOT NULL,
  `cupo_maximo` int(11) NOT NULL,
  `jornada` varchar(6) NOT NULL,
  `ano_lectivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `id_grado`, `id_grupo`, `id_salon`, `director`, `cupo_maximo`, `jornada`, `ano_lectivo`) VALUES
(1, 9, 1, 9, 3, 30, 'Mañana', 1),
(2, 10, 1, 10, 17, 30, 'Mañana', 1),
(3, 8, 1, 8, 31, 30, 'Mañana', 1),
(4, 7, 1, 7, 21, 30, 'Mañana', 1),
(5, 6, 1, 6, 19, 30, 'Mañana', 1),
(6, 5, 1, 5, 12, 30, 'Mañana', 1),
(7, 4, 1, 4, 23, 30, 'Mañana', 1),
(8, 3, 1, 3, 25, 30, 'Mañana', 1),
(9, 2, 1, 2, 14, 30, 'Mañana', 1),
(10, 1, 1, 1, 4, 30, 'Mañana', 1),
(11, 4, 2, 11, 5, 30, 'Mañana', 1),
(12, 1, 2, 12, 16, 30, 'Mañana', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_institucion`
--

CREATE TABLE `datos_institucion` (
  `id` int(11) NOT NULL,
  `nombre_institucion` varchar(100) NOT NULL,
  `niveles_educacion` varchar(200) NOT NULL,
  `resolucion` varchar(100) NOT NULL,
  `dane` varchar(45) NOT NULL,
  `nit` varchar(45) NOT NULL,
  `ultimo_grado` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `barrio` varchar(45) NOT NULL,
  `pais_ubicacion` int(11) NOT NULL,
  `departamento_ubicacion` int(11) NOT NULL,
  `municipio_ubicacion` int(11) NOT NULL,
  `corregimiento_ubicacion` varchar(100) DEFAULT NULL,
  `responsable` varchar(100) NOT NULL,
  `cargo_responsable` varchar(45) NOT NULL,
  `escudo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_institucion`
--

INSERT INTO `datos_institucion` (`id`, `nombre_institucion`, `niveles_educacion`, `resolucion`, `dane`, `nit`, `ultimo_grado`, `telefono`, `email`, `direccion`, `barrio`, `pais_ubicacion`, `departamento_ubicacion`, `municipio_ubicacion`, `corregimiento_ubicacion`, `responsable`, `cargo_responsable`, `escudo`) VALUES
(1, 'CENTRO EDUCATIVO NUESTRA SEÑORA DEL CARMEN', 'Educación Prescolar, Básica Primaria, Básica Secundaria Y Media', 'Aprobado Según Resolucion 000209 Del 29 De Octubre De 2015', 'Registro DANE N° 120001001219', 'Nit: 892,300,306-2', 'Noveno', '5807659', 'cenuestrasenoradelcarmen@gmail.com', 'Calle 7 # 29-90', 'Nueva Esperanza', 1, 20, 410, '', 'Jesus Aldo Nobles Mendez', 'Director', 'escudo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(45) NOT NULL,
  `id_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre_departamento`, `id_pais`) VALUES
(5, 'ANTIOQUIA', 1),
(8, 'ATLANTICO', 1),
(11, 'BOGOTA', 1),
(13, 'BOLIVAR', 1),
(15, 'BOYACA', 1),
(17, 'CALDAS', 1),
(18, 'CAQUETA', 1),
(19, 'CAUCA', 1),
(20, 'CESAR', 1),
(23, 'CORDOBA', 1),
(25, 'CUNDINAMARCA', 1),
(27, 'CHOCO', 1),
(41, 'HUILA', 1),
(44, 'LA GUAJIRA', 1),
(47, 'MAGDALENA', 1),
(50, 'META', 1),
(52, 'NARIÑO', 1),
(54, 'N. DE SANTANDER', 1),
(63, 'QUINDIO', 1),
(66, 'RISARALDA', 1),
(68, 'SANTANDER', 1),
(70, 'SUCRE', 1),
(73, 'TOLIMA', 1),
(76, 'VALLE DEL CAUCA', 1),
(81, 'ARAUCA', 1),
(85, 'CASANARE', 1),
(86, 'PUTUMAYO', 1),
(88, 'SAN ANDRES', 1),
(91, 'AMAZONAS', 1),
(94, 'GUAINIA', 1),
(95, 'GUAVIARE', 1),
(97, 'VAUPES', 1),
(99, 'VICHADA', 1),
(100, 'OTRO', 2),
(101, 'OTRO', 3),
(102, 'OTRO', 4),
(103, 'OTRO', 5),
(104, 'OTRO', 6),
(105, 'OTRO', 7),
(106, 'OTRO', 8),
(107, 'OTRO', 9),
(108, 'OTRO', 10),
(109, 'OTRO', 11),
(110, 'OTRO', 12),
(111, 'OTRO', 13),
(112, 'OTRO', 14),
(113, 'OTRO', 15),
(114, 'OTRO', 16),
(115, 'OTRO', 17),
(116, 'OTRO', 18),
(117, 'OTRO', 19),
(118, 'OTRO', 20),
(119, 'OTRO', 21),
(120, 'OTRO', 22),
(121, 'OTRO', 23),
(122, 'OTRO', 24),
(123, 'OTRO', 25),
(124, 'OTRO', 26),
(125, 'OTRO', 27),
(126, 'OTRO', 28),
(127, 'OTRO', 29),
(128, 'OTRO', 30),
(129, 'OTRO', 31),
(130, 'OTRO', 32),
(131, 'OTRO', 33),
(132, 'OTRO', 34),
(133, 'OTRO', 35),
(134, 'OTRO', 36),
(135, 'OTRO', 37),
(136, 'OTRO', 38),
(137, 'OTRO', 39),
(138, 'OTRO', 40),
(139, 'OTRO', 41),
(140, 'OTRO', 42),
(141, 'OTRO', 43),
(142, 'OTRO', 44),
(143, 'OTRO', 45),
(144, 'OTRO', 46),
(145, 'OTRO', 47),
(146, 'OTRO', 48),
(147, 'OTRO', 49),
(148, 'OTRO', 50),
(149, 'OTRO', 51),
(150, 'OTRO', 52),
(151, 'OTRO', 53),
(152, 'OTRO', 54),
(153, 'OTRO', 55),
(154, 'OTRO', 56),
(155, 'OTRO', 57),
(156, 'OTRO', 58),
(157, 'OTRO', 59),
(158, 'OTRO', 60),
(159, 'OTRO', 61),
(160, 'OTRO', 62),
(161, 'OTRO', 63),
(162, 'OTRO', 64),
(163, 'OTRO', 65),
(164, 'OTRO', 66),
(165, 'OTRO', 67),
(166, 'OTRO', 68),
(167, 'OTRO', 69),
(168, 'OTRO', 70),
(169, 'OTRO', 71),
(170, 'OTRO', 72),
(171, 'OTRO', 73),
(172, 'OTRO', 74),
(173, 'OTRO', 75),
(174, 'OTRO', 76),
(175, 'OTRO', 77),
(176, 'OTRO', 78),
(177, 'OTRO', 79),
(178, 'OTRO', 80),
(179, 'OTRO', 81),
(180, 'OTRO', 82),
(181, 'OTRO', 83),
(182, 'OTRO', 84),
(183, 'OTRO', 85),
(184, 'OTRO', 86),
(185, 'OTRO', 87),
(186, 'OTRO', 88),
(187, 'OTRO', 89),
(188, 'OTRO', 90),
(189, 'OTRO', 91),
(190, 'OTRO', 92),
(191, 'OTRO', 93),
(192, 'OTRO', 94),
(193, 'OTRO', 95),
(194, 'OTRO', 96),
(195, 'OTRO', 97),
(196, 'OTRO', 98),
(197, 'OTRO', 99),
(198, 'OTRO', 100),
(199, 'OTRO', 101),
(200, 'OTRO', 102),
(201, 'OTRO', 103),
(202, 'OTRO', 104),
(203, 'OTRO', 105),
(204, 'OTRO', 106),
(205, 'OTRO', 107),
(206, 'OTRO', 108),
(207, 'OTRO', 109),
(208, 'OTRO', 110),
(209, 'OTRO', 111),
(210, 'OTRO', 112),
(211, 'OTRO', 113),
(212, 'OTRO', 114),
(213, 'OTRO', 115),
(214, 'OTRO', 116),
(215, 'OTRO', 117),
(216, 'OTRO', 118),
(217, 'OTRO', 119),
(218, 'OTRO', 120),
(219, 'OTRO', 121),
(220, 'OTRO', 122),
(221, 'OTRO', 123),
(222, 'OTRO', 124),
(223, 'OTRO', 125),
(224, 'OTRO', 126),
(225, 'OTRO', 127),
(226, 'OTRO', 128),
(227, 'OTRO', 129),
(228, 'OTRO', 130),
(229, 'OTRO', 131),
(230, 'OTRO', 132),
(231, 'OTRO', 133),
(232, 'OTRO', 134),
(233, 'OTRO', 135),
(234, 'OTRO', 136),
(235, 'OTRO', 137),
(236, 'OTRO', 138),
(237, 'OTRO', 139),
(238, 'OTRO', 140),
(239, 'OTRO', 141),
(240, 'OTRO', 142),
(241, 'OTRO', 143),
(242, 'OTRO', 144),
(243, 'OTRO', 145),
(244, 'OTRO', 146),
(245, 'OTRO', 147),
(246, 'OTRO', 148),
(247, 'OTRO', 149),
(248, 'OTRO', 150),
(249, 'OTRO', 151),
(250, 'OTRO', 152),
(251, 'OTRO', 153),
(252, 'OTRO', 154),
(253, 'OTRO', 155),
(254, 'OTRO', 156),
(255, 'OTRO', 157),
(256, 'OTRO', 158),
(257, 'OTRO', 159),
(258, 'OTRO', 160),
(259, 'OTRO', 161),
(260, 'OTRO', 162),
(261, 'OTRO', 163),
(262, 'OTRO', 164),
(263, 'OTRO', 165),
(264, 'OTRO', 166),
(265, 'OTRO', 167),
(266, 'OTRO', 168),
(267, 'OTRO', 169),
(268, 'OTRO', 170),
(269, 'OTRO', 171),
(270, 'OTRO', 172),
(271, 'OTRO', 173),
(272, 'OTRO', 174),
(273, 'OTRO', 175),
(274, 'OTRO', 176),
(275, 'OTRO', 177),
(276, 'OTRO', 178),
(277, 'OTRO', 179),
(278, 'OTRO', 180),
(279, 'OTRO', 181),
(280, 'OTRO', 182),
(281, 'OTRO', 183),
(282, 'OTRO', 184),
(283, 'OTRO', 185),
(284, 'OTRO', 186),
(285, 'OTRO', 187),
(286, 'OTRO', 188),
(287, 'OTRO', 189),
(288, 'OTRO', 190),
(289, 'OTRO', 191),
(290, 'OTRO', 192),
(291, 'OTRO', 193),
(292, 'OTRO', 194);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desempenos`
--

CREATE TABLE `desempenos` (
  `id_desempeno` int(11) NOT NULL,
  `nombre_desempeno` varchar(45) NOT NULL,
  `rango_inicial` decimal(11,1) NOT NULL,
  `rango_final` decimal(11,1) NOT NULL,
  `ano_lectivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `desempenos`
--

INSERT INTO `desempenos` (`id_desempeno`, `nombre_desempeno`, `rango_inicial`, `rango_final`, `ano_lectivo`) VALUES
(1, 'Superior', '4.6', '5.0', 1),
(2, 'Alto', '4.0', '4.5', 1),
(3, 'Básico', '3.0', '3.9', 1),
(4, 'Bajo', '0.0', '2.9', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `descripcion_documento` varchar(500) NOT NULL,
  `nombre_documento` varchar(300) NOT NULL,
  `fecha_subida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `descripcion_documento`, `nombre_documento`, `fecha_subida`) VALUES
(1, 'Proyecto Educativo Institucional', 'PROYECTO_EDUCATIVO_INSTITUCIONAL.docx', '2018-10-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elecciones`
--

CREATE TABLE `elecciones` (
  `id_eleccion` int(11) NOT NULL,
  `nombre_eleccion` varchar(100) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `fecha_fin` date NOT NULL,
  `hora_fin` time NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `estado_eleccion` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `elecciones`
--

INSERT INTO `elecciones` (`id_eleccion`, `nombre_eleccion`, `descripcion`, `fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`, `ano_lectivo`, `estado_eleccion`) VALUES
(1, 'Personero Estudiantil 2018-prueba Piloto', 'Prueba Piloto  Eleccion De Personero', '2018-10-24', '06:00:00', '2018-10-24', '23:59:00', 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id_persona` int(11) NOT NULL,
  `discapacidad` varchar(45) NOT NULL,
  `institucion_procedencia` varchar(45) NOT NULL,
  `grado_cursado` varchar(45) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `estado_estudiante` varchar(15) NOT NULL DEFAULT 'Inscrito',
  `fecha_estado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_persona`, `discapacidad`, `institucion_procedencia`, `grado_cursado`, `anio`, `estado_estudiante`, `fecha_estado`) VALUES
(6, 'Ninguna', 'Ninguna', 'Transición', '2017', 'Inscrito', '2018-10-24'),
(7, 'Ninguna', 'Ninguna', 'Ninguno', '', 'Inscrito', '2018-10-24'),
(8, 'Ninguna', 'Ninguna', 'Ninguno', '', 'Inscrito', '2018-10-24'),
(9, 'Ninguna', 'Ninguna', 'Ninguno', '', 'Inscrito', '2018-10-24'),
(10, 'Ninguna', '', 'Ninguno', '', 'Inscrito', '2018-10-24'),
(11, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(13, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(15, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(18, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(20, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(22, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(24, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(26, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(28, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(29, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(30, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(34, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(35, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(36, 'Ninguna', 'N/a', 'Cuarto', '2017', 'Matriculado', '2018-10-24'),
(37, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(38, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(39, 'Ninguna', 'Na', 'Séptimo', '2017', 'Matriculado', '2018-10-24'),
(40, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(41, 'Ninguna', 'Na', 'Séptimo', '2017', 'Matriculado', '2018-10-24'),
(42, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(43, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(44, 'Ninguna', 'N/a', 'Séptimo', '2017', 'Matriculado', '2018-10-24'),
(45, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(46, 'Ninguna', 'Na', 'Séptimo', '2017', 'Matriculado', '2018-10-24'),
(47, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(48, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(49, 'Ninguna', 'N/a', 'Séptimo', '2017', 'Matriculado', '2018-10-24'),
(50, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(51, 'Ninguna', '', 'Ninguno', '', 'Matriculado', '2018-10-24'),
(52, 'Ninguna', 'Na', 'Séptimo', '2017', 'Matriculado', '2018-10-24'),
(59, 'Ninguna', 'N/a', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(60, 'Ninguna', 'Ninguno', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(61, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(62, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(63, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(64, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(65, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(66, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(67, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(68, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(69, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(70, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(71, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(72, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(73, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(74, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(75, 'Ninguna', 'Ninguna', 'Séptimo', '2017', 'Matriculado', '2018-11-04'),
(76, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(77, 'Ninguna', 'Ninguno', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(78, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(79, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(80, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(81, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(82, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(83, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(84, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(85, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(86, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(87, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(88, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(89, 'Ninguna', 'Ninguno', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(90, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(91, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(92, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(93, 'Ninguna', 'Ninguna', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(94, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(95, 'Ninguna', 'Ninguno', 'Sexto', '2017', 'Matriculado', '2018-11-04'),
(96, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(97, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(98, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(99, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(100, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(101, 'Ninguna', '', 'Quinto', '2017', 'Matriculado', '2018-11-04'),
(102, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(103, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(104, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(105, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(106, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(107, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(108, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(109, 'Ninguna', '', 'Ninguno', '', 'Inscrito', '2018-11-05'),
(110, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(111, 'Ninguna', '', 'Ninguno', '', 'Inscrito', '2018-11-05'),
(112, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(113, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(114, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(115, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(116, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(117, 'Ninguna', 'Ninguna', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(118, 'Ninguna', 'Ninguno', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(119, 'Ninguna', 'Ninguno', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(120, 'Ninguna', 'Ninguno', 'Cuarto', '2017', 'Inscrito', '2018-11-05'),
(121, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(122, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(123, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(124, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(125, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(126, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(127, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(128, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(129, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(130, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(131, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(132, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(133, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(134, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(135, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(136, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(137, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(138, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(139, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(140, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(141, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(142, 'Ninguna', '', 'Ninguno', '', 'Inscrito', '2018-11-06'),
(143, 'Ninguna', '', 'Tercero', '2017', 'Inscrito', '2018-11-06'),
(144, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(145, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(146, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(147, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(148, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(149, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(150, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(151, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(152, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(153, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(154, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(155, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(156, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(157, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(158, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(159, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(160, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(161, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(162, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(163, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(164, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(165, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(166, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(167, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(168, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(169, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(170, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(171, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(172, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(173, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(174, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(175, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(176, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(177, 'Ninguna', '', 'Segundo', '2017', 'Inscrito', '2018-11-14'),
(178, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(179, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(180, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(181, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(182, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(183, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(184, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(185, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(186, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(187, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(188, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(189, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(190, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(191, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(192, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-15'),
(193, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-21'),
(194, 'Ninguna', '', 'Primero', '2017', 'Inscrito', '2018-11-21'),
(195, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(196, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(197, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(198, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(199, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(200, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(201, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(202, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(203, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(204, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(205, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(206, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(207, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(208, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(209, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(210, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(211, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(212, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(213, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(214, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(215, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(216, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(217, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(218, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(219, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29'),
(220, 'Ninguna', '', 'Transición', '2017', 'Inscrito', '2018-11-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_acudientes`
--

CREATE TABLE `estudiantes_acudientes` (
  `idestudiantes_acudientes` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_acudiente` int(11) NOT NULL,
  `parentesco` varchar(45) NOT NULL,
  `ano_lectivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiantes_acudientes`
--

INSERT INTO `estudiantes_acudientes` (`idestudiantes_acudientes`, `id_estudiante`, `id_acudiente`, `parentesco`, `ano_lectivo`) VALUES
(1, 34, 56, 'Madre', 1),
(2, 35, 53, 'Tio(a)', 1),
(3, 37, 58, 'Tio(a)', 1),
(4, 38, 55, 'Tio(a)', 1),
(5, 40, 55, 'Madrina', 1),
(6, 42, 57, 'Padrino', 1),
(7, 43, 57, 'Cuñado(a)', 1),
(8, 45, 57, 'Tio(a)', 1),
(9, 47, 56, 'Tio(a)', 1),
(10, 48, 58, 'Tio(a)', 1),
(11, 50, 56, 'Hermano(a)', 1),
(12, 51, 58, 'Madre', 1),
(13, 52, 54, 'Madrina', 1),
(14, 49, 55, 'Cuñado(a)', 1),
(15, 46, 58, 'Cuñado(a)', 1),
(16, 44, 55, 'Madre', 1),
(17, 41, 57, 'Tio(a)', 1),
(18, 39, 55, 'Madrina', 1),
(19, 36, 55, 'Tio(a)', 1),
(20, 11, 56, 'Tio(a)', 1),
(21, 13, 58, 'Tio(a)', 1),
(22, 15, 58, 'Madre', 1),
(23, 18, 58, 'Madrina', 1),
(24, 20, 57, 'Tio(a)', 1),
(25, 22, 58, 'Madre', 1),
(26, 24, 53, 'Abuelo(a)', 1),
(27, 26, 58, 'Tio(a)', 1),
(28, 28, 58, 'Tio(a)', 1),
(29, 29, 58, 'Madrina', 1),
(30, 30, 58, 'Tio(a)', 1),
(31, 59, 53, 'Tio(a)', 1),
(32, 65, 56, 'Tio(a)', 1),
(33, 67, 54, 'Tio(a)', 1),
(34, 69, 55, 'Primo(a)', 1),
(35, 70, 57, 'Tio(a)', 1),
(36, 72, 55, 'Tio(a)', 1),
(37, 73, 54, 'Tio(a)', 1),
(38, 75, 56, 'Tio(a)', 1),
(39, 77, 55, 'Hermano(a)', 1),
(40, 78, 56, 'Tio(a)', 1),
(41, 79, 53, 'Tio(a)', 1),
(42, 80, 58, 'Tio(a)', 1),
(43, 81, 56, 'Tio(a)', 1),
(44, 83, 56, 'Tio(a)', 1),
(45, 85, 56, 'Primo(a)', 1),
(46, 87, 57, 'Tio(a)', 1),
(47, 89, 55, 'Primo(a)', 1),
(48, 91, 55, 'Tio(a)', 1),
(49, 93, 53, 'Tio(a)', 1),
(50, 95, 54, 'Primo(a)', 1),
(51, 60, 56, 'Tio(a)', 1),
(52, 61, 56, 'Madre', 1),
(53, 62, 58, 'Tio(a)', 1),
(54, 63, 57, 'Tio(a)', 1),
(55, 64, 54, 'Madrina', 1),
(56, 66, 58, 'Primo(a)', 1),
(57, 68, 54, 'Primo(a)', 1),
(58, 71, 53, 'Tio(a)', 1),
(59, 74, 53, 'Padrino', 1),
(60, 76, 57, 'Tio(a)', 1),
(62, 82, 54, 'Tio(a)', 1),
(63, 84, 55, 'Primo(a)', 1),
(64, 86, 54, 'Primo(a)', 1),
(65, 88, 57, 'Tio(a)', 1),
(66, 90, 54, 'Tio(a)', 1),
(67, 92, 53, 'Tio(a)', 1),
(68, 94, 58, 'Tio(a)', 1),
(69, 96, 53, 'Tio(a)', 1),
(70, 97, 54, 'Madrina', 1),
(72, 99, 55, 'Primo(a)', 1),
(73, 100, 58, 'Tio(a)', 1),
(74, 101, 54, 'Padrino', 1),
(75, 98, 55, 'Primo(a)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_padres`
--

CREATE TABLE `estudiantes_padres` (
  `idestudiantes_padres` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_padre` int(11) NOT NULL,
  `id_madre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiantes_padres`
--

INSERT INTO `estudiantes_padres` (`idestudiantes_padres`, `id_estudiante`, `id_padre`, `id_madre`) VALUES
(1, 6, 1, 1),
(2, 7, 2, 2),
(3, 8, 3, 3),
(4, 9, 4, 4),
(5, 10, 5, 5),
(6, 11, 6, 6),
(7, 13, 7, 7),
(8, 15, 8, 8),
(9, 18, 9, 9),
(10, 20, 10, 10),
(11, 22, 11, 11),
(12, 24, 12, 12),
(13, 26, 13, 13),
(14, 28, 14, 14),
(15, 29, 15, 15),
(16, 30, 16, 16),
(17, 34, 17, 17),
(18, 35, 18, 18),
(19, 36, 19, 19),
(20, 37, 20, 20),
(21, 38, 21, 21),
(22, 39, 22, 22),
(23, 40, 23, 23),
(24, 41, 24, 24),
(25, 42, 25, 25),
(26, 43, 26, 26),
(27, 44, 27, 27),
(28, 45, 28, 28),
(29, 46, 29, 29),
(30, 47, 30, 30),
(31, 48, 31, 31),
(32, 49, 32, 32),
(33, 50, 33, 33),
(34, 51, 34, 34),
(35, 52, 35, 35),
(36, 59, 36, 36),
(37, 60, 37, 37),
(38, 61, 38, 38),
(39, 62, 39, 39),
(40, 63, 40, 40),
(41, 64, 41, 41),
(42, 65, 42, 42),
(43, 66, 43, 43),
(44, 67, 44, 44),
(45, 68, 45, 45),
(46, 69, 46, 46),
(47, 70, 47, 47),
(48, 71, 48, 48),
(49, 72, 49, 49),
(50, 73, 50, 50),
(51, 74, 51, 51),
(52, 75, 52, 52),
(53, 76, 53, 53),
(54, 77, 54, 54),
(55, 78, 55, 55),
(56, 79, 56, 56),
(57, 80, 57, 57),
(58, 81, 58, 58),
(59, 82, 59, 59),
(60, 83, 60, 60),
(61, 84, 61, 61),
(62, 85, 62, 62),
(63, 86, 63, 63),
(64, 87, 64, 64),
(65, 88, 65, 65),
(66, 89, 66, 66),
(67, 90, 67, 67),
(68, 91, 68, 68),
(69, 92, 69, 69),
(70, 93, 70, 70),
(71, 94, 71, 71),
(72, 95, 72, 72),
(73, 96, 73, 73),
(74, 97, 74, 74),
(75, 98, 75, 75),
(76, 99, 76, 76),
(77, 100, 77, 77),
(78, 101, 78, 78),
(79, 102, 79, 79),
(80, 103, 80, 80),
(81, 104, 81, 81),
(82, 105, 82, 82),
(83, 106, 83, 83),
(84, 107, 84, 84),
(85, 108, 85, 85),
(86, 109, 86, 86),
(87, 110, 87, 87),
(88, 111, 88, 88),
(89, 112, 89, 89),
(90, 113, 90, 90),
(91, 114, 91, 91),
(92, 115, 92, 92),
(93, 116, 93, 93),
(94, 117, 94, 94),
(95, 118, 95, 95),
(96, 119, 96, 96),
(97, 120, 97, 97),
(98, 121, 98, 98),
(99, 122, 99, 99),
(100, 123, 100, 100),
(101, 124, 101, 101),
(102, 125, 102, 102),
(103, 126, 103, 103),
(104, 127, 104, 104),
(105, 128, 105, 105),
(106, 129, 106, 106),
(107, 130, 107, 107),
(108, 131, 108, 108),
(109, 132, 109, 109),
(110, 133, 110, 110),
(111, 134, 111, 111),
(112, 135, 112, 112),
(113, 136, 113, 113),
(114, 137, 114, 114),
(115, 138, 115, 115),
(116, 139, 116, 116),
(117, 140, 117, 117),
(118, 141, 118, 118),
(119, 142, 119, 119),
(120, 143, 120, 120),
(121, 144, 121, 121),
(122, 145, 122, 122),
(123, 146, 123, 123),
(124, 147, 124, 124),
(125, 148, 125, 125),
(126, 149, 126, 126),
(127, 150, 127, 127),
(128, 151, 128, 128),
(129, 152, 129, 129),
(130, 153, 130, 130),
(131, 154, 131, 131),
(132, 155, 132, 132),
(133, 156, 133, 133),
(134, 157, 134, 134),
(135, 158, 135, 135),
(136, 159, 136, 136),
(137, 160, 137, 137),
(138, 161, 138, 138),
(139, 162, 139, 139),
(140, 163, 140, 140),
(141, 164, 141, 141),
(142, 165, 142, 142),
(143, 166, 143, 143),
(144, 167, 144, 144),
(145, 168, 145, 145),
(146, 169, 146, 146),
(147, 170, 147, 147),
(148, 171, 148, 148),
(149, 172, 149, 149),
(150, 173, 150, 150),
(151, 174, 151, 151),
(152, 175, 152, 152),
(153, 176, 153, 153),
(154, 177, 154, 154),
(155, 178, 155, 155),
(156, 179, 156, 156),
(157, 180, 157, 157),
(158, 181, 158, 158),
(159, 182, 159, 159),
(160, 183, 160, 160),
(161, 184, 161, 161),
(162, 185, 162, 162),
(163, 186, 163, 163),
(164, 187, 164, 164),
(165, 188, 165, 165),
(166, 189, 166, 166),
(167, 190, 167, 167),
(168, 191, 168, 168),
(169, 192, 169, 169),
(170, 193, 170, 170),
(171, 194, 171, 171),
(172, 195, 172, 172),
(173, 196, 173, 173),
(174, 197, 174, 174),
(175, 198, 175, 175),
(176, 199, 176, 176),
(177, 200, 177, 177),
(178, 201, 178, 178),
(179, 202, 179, 179),
(180, 203, 180, 180),
(181, 204, 181, 181),
(182, 205, 182, 182),
(183, 206, 183, 183),
(184, 207, 184, 184),
(185, 208, 185, 185),
(186, 209, 186, 186),
(187, 210, 187, 187),
(188, 211, 188, 188),
(189, 212, 189, 189),
(190, 213, 190, 190),
(191, 214, 191, 191),
(192, 215, 192, 192),
(193, 216, 193, 193),
(194, 217, 194, 194),
(195, 218, 195, 195),
(196, 219, 196, 196),
(197, 220, 197, 197);

--
-- Disparadores `estudiantes_padres`
--
DELIMITER $$
CREATE TRIGGER `eliminar_padres_madres` AFTER DELETE ON `estudiantes_padres` FOR EACH ROW begin
DELETE FROM padres where id_padre=old.id_padre;
DELETE FROM madres where id_madre=old.id_madre;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id_grado` int(11) NOT NULL,
  `nombre_grado` varchar(30) NOT NULL,
  `nivel_educacion` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `estado_grado` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id_grado`, `nombre_grado`, `nivel_educacion`, `ano_lectivo`, `estado_grado`) VALUES
(1, 'Transición', 1, 1, 'Activo'),
(2, 'Primero', 2, 1, 'Activo'),
(3, 'Segundo', 2, 1, 'Activo'),
(4, 'Tercero', 2, 1, 'Activo'),
(5, 'Cuarto', 2, 1, 'Activo'),
(6, 'Quinto', 2, 1, 'Activo'),
(7, 'Sexto', 3, 1, 'Activo'),
(8, 'Séptimo', 3, 1, 'Activo'),
(9, 'Octavo', 3, 1, 'Activo'),
(10, 'Noveno', 3, 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados_educacion`
--

CREATE TABLE `grados_educacion` (
  `id_grado_educacion` int(11) NOT NULL,
  `nombre_grado` varchar(45) NOT NULL,
  `nivel_educacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grados_educacion`
--

INSERT INTO `grados_educacion` (`id_grado_educacion`, `nombre_grado`, `nivel_educacion`) VALUES
(1, 'Primero', 2),
(2, 'Segundo', 2),
(3, 'Tercero', 2),
(4, 'Cuarto', 2),
(5, 'Quinto', 2),
(6, 'Sexto', 3),
(7, 'Séptimo', 3),
(8, 'Octavo', 3),
(9, 'Noveno', 3),
(10, 'Décimo', 4),
(11, 'Undécimo', 4),
(12, 'Prejardín', 1),
(13, 'Jardín', 1),
(14, 'Transición', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(30) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `estado_grupo` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre_grupo`, `ano_lectivo`, `estado_grupo`) VALUES
(1, 'A', 1, 'Activo'),
(2, 'B', 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_estados`
--

CREATE TABLE `historial_estados` (
  `id_historial` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `observaciones` varchar(300) NOT NULL,
  `fecha_estado` date NOT NULL,
  `ano_lectivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historial_estados`
--

INSERT INTO `historial_estados` (`id_historial`, `id_persona`, `estado`, `observaciones`, `fecha_estado`, `ano_lectivo`) VALUES
(1, 6, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(2, 7, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(3, 8, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(4, 9, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(5, 10, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(6, 11, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(7, 13, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(8, 15, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(9, 18, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(10, 20, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(11, 22, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(12, 24, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(13, 26, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(14, 28, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(15, 29, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(16, 30, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(17, 34, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(18, 35, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(19, 36, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(20, 37, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(21, 38, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(22, 39, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(23, 40, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(24, 41, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(25, 42, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(26, 43, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(27, 44, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(28, 45, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(29, 46, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(30, 47, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(31, 48, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(32, 49, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(33, 50, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(34, 51, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(35, 52, 'Inscrito', 'Estudiante Inscrito.', '2018-10-24', 1),
(36, 34, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(37, 35, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(38, 37, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(39, 38, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(40, 40, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(41, 42, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(42, 43, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(43, 45, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(44, 47, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(45, 48, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(46, 50, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(47, 51, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(48, 52, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(49, 49, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(50, 46, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(51, 44, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(52, 41, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(53, 39, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(54, 36, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(55, 11, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(56, 13, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(57, 15, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(58, 18, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(59, 20, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(60, 22, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(61, 24, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(62, 26, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(63, 28, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(64, 29, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(65, 30, 'Matriculado', 'Estudiante Matriculado.', '2018-10-24', 1),
(66, 59, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(67, 60, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(68, 61, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(69, 62, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(70, 63, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(71, 64, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(72, 65, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(73, 66, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(74, 67, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(75, 68, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(76, 69, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(77, 70, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(78, 71, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(79, 72, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(80, 73, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(81, 74, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(82, 75, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(83, 76, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(84, 77, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(85, 78, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(86, 79, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(87, 80, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(88, 81, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(89, 82, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(90, 83, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(91, 84, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(92, 85, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(93, 86, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(94, 87, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(95, 88, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(96, 89, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(97, 90, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(98, 91, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(99, 92, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(100, 93, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(101, 94, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(102, 95, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(103, 96, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(104, 97, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(105, 98, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(106, 99, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(107, 100, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(108, 59, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(109, 65, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(110, 67, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(111, 69, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(112, 70, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(113, 72, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(114, 73, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(115, 75, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(116, 77, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(117, 78, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(118, 79, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(119, 101, 'Inscrito', 'Estudiante Inscrito.', '2018-11-04', 1),
(120, 80, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(121, 81, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(122, 83, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(123, 85, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(124, 87, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(125, 89, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(126, 91, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(127, 93, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(128, 95, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(129, 60, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(130, 61, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(131, 62, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(132, 63, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(133, 64, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(134, 66, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(135, 68, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(136, 71, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(137, 74, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(138, 76, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(140, 82, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(141, 84, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(142, 86, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(143, 88, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(144, 90, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(145, 92, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(146, 94, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(147, 96, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(148, 97, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(150, 99, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(151, 100, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(152, 101, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(153, 98, 'Matriculado', 'Estudiante Matriculado.', '2018-11-04', 1),
(154, 102, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(155, 103, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(156, 104, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(157, 105, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(158, 106, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(159, 107, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(160, 108, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(161, 109, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(162, 110, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(163, 111, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(164, 112, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(165, 113, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(166, 114, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(167, 115, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(168, 116, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(169, 117, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(170, 118, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(171, 119, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(172, 120, 'Inscrito', 'Estudiante Inscrito.', '2018-11-05', 1),
(173, 121, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(174, 122, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(175, 123, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(176, 124, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(177, 125, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(178, 126, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(179, 127, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(180, 128, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(181, 129, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(182, 130, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(183, 131, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(184, 132, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(185, 133, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(186, 134, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(187, 135, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(188, 136, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(189, 137, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(190, 138, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(191, 139, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(192, 140, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(193, 141, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(194, 142, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(195, 143, 'Inscrito', 'Estudiante Inscrito.', '2018-11-06', 1),
(196, 144, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(197, 145, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(198, 146, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(199, 147, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(200, 148, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(201, 149, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(202, 150, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(203, 151, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(204, 152, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(205, 153, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(206, 154, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(207, 155, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(208, 156, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(209, 157, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(210, 158, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(211, 159, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(212, 160, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(213, 161, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(214, 162, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(215, 163, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(216, 164, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(217, 165, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(218, 166, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(219, 167, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(220, 168, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(221, 169, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(222, 170, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(223, 171, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(224, 172, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(225, 173, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(226, 174, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(227, 175, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(228, 176, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(229, 177, 'Inscrito', 'Estudiante Inscrito.', '2018-11-14', 1),
(230, 178, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(231, 179, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(232, 180, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(233, 181, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(234, 182, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(235, 183, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(236, 184, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(237, 185, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(238, 186, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(239, 187, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(240, 188, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(241, 189, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(242, 190, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(243, 191, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(244, 192, 'Inscrito', 'Estudiante Inscrito.', '2018-11-15', 1),
(245, 193, 'Inscrito', 'Estudiante Inscrito.', '2018-11-21', 1),
(246, 194, 'Inscrito', 'Estudiante Inscrito.', '2018-11-21', 1),
(247, 195, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(248, 196, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(249, 197, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(250, 198, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(251, 199, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(252, 200, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(253, 201, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(254, 202, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(255, 203, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(256, 204, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(257, 205, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(258, 206, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(259, 207, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(260, 208, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(261, 209, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(262, 210, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(263, 211, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(264, 212, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(265, 213, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(266, 214, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(267, 215, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(268, 216, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(269, 217, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(270, 218, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(271, 219, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1),
(272, 220, 'Inscrito', 'Estudiante Inscrito.', '2018-11-29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `hora` int(11) NOT NULL,
  `lunes` int(11) NOT NULL DEFAULT '1',
  `martes` int(11) NOT NULL DEFAULT '1',
  `miercoles` int(11) NOT NULL DEFAULT '1',
  `jueves` int(11) NOT NULL DEFAULT '1',
  `viernes` int(11) NOT NULL DEFAULT '1',
  `sabado` int(11) NOT NULL DEFAULT '1',
  `domingo` int(11) NOT NULL DEFAULT '1',
  `ano_lectivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `id_curso`, `hora`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `domingo`, `ano_lectivo`) VALUES
(1, 1, 1, 10, 17, 15, 14, 12, 1, 1, 1),
(2, 1, 2, 9, 7, 17, 14, 12, 1, 1, 1),
(3, 1, 3, 2, 11, 8, 16, 5, 1, 1, 1),
(4, 1, 4, 2, 11, 6, 18, 13, 1, 1, 1),
(5, 1, 5, 4, 12, 2, 2, 13, 1, 1, 1),
(6, 1, 6, 3, 15, 18, 11, 11, 1, 1, 1),
(7, 1, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(8, 1, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(9, 1, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(10, 1, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(11, 2, 1, 11, 6, 2, 10, 3, 1, 1, 1),
(12, 2, 2, 11, 5, 13, 9, 11, 1, 1, 1),
(13, 2, 3, 7, 12, 17, 14, 15, 1, 1, 1),
(14, 2, 4, 8, 12, 11, 14, 2, 1, 1, 1),
(15, 2, 5, 12, 2, 16, 4, 2, 1, 1, 1),
(16, 2, 6, 17, 13, 15, 18, 18, 1, 1, 1),
(17, 2, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(18, 2, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(19, 2, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(20, 2, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(21, 3, 1, 3, 11, 6, 17, 13, 1, 1, 1),
(22, 3, 2, 5, 11, 18, 4, 2, 1, 1, 1),
(23, 3, 3, 12, 2, 16, 9, 14, 1, 1, 1),
(24, 3, 4, 12, 2, 12, 11, 14, 1, 1, 1),
(25, 3, 5, 7, 13, 15, 11, 10, 1, 1, 1),
(26, 3, 6, 8, 18, 17, 2, 15, 1, 1, 1),
(27, 3, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(28, 3, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(29, 3, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(30, 3, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(31, 4, 1, 2, 18, 16, 17, 14, 1, 1, 1),
(32, 4, 2, 2, 12, 7, 13, 14, 1, 1, 1),
(33, 4, 3, 6, 4, 3, 2, 12, 1, 1, 1),
(34, 4, 4, 11, 9, 2, 12, 8, 1, 1, 1),
(35, 4, 5, 11, 10, 11, 15, 5, 1, 1, 1),
(36, 4, 6, 13, 12, 11, 15, 12, 1, 1, 1),
(37, 4, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(38, 4, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(39, 4, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(40, 4, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(41, 5, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(42, 5, 2, 1, 1, 1, 1, 1, 1, 1, 1),
(43, 5, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(44, 5, 4, 1, 1, 1, 1, 1, 1, 1, 1),
(45, 5, 5, 1, 1, 1, 1, 1, 1, 1, 1),
(46, 5, 6, 1, 1, 1, 1, 1, 1, 1, 1),
(47, 5, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(48, 5, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(49, 5, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(50, 5, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(51, 6, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(52, 6, 2, 1, 1, 1, 1, 1, 1, 1, 1),
(53, 6, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(54, 6, 4, 1, 1, 1, 1, 1, 1, 1, 1),
(55, 6, 5, 1, 1, 1, 1, 1, 1, 1, 1),
(56, 6, 6, 1, 1, 1, 1, 1, 1, 1, 1),
(57, 6, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(58, 6, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(59, 6, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(60, 6, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(61, 7, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(62, 7, 2, 1, 1, 1, 1, 1, 1, 1, 1),
(63, 7, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(64, 7, 4, 1, 1, 1, 1, 1, 1, 1, 1),
(65, 7, 5, 1, 1, 1, 1, 1, 1, 1, 1),
(66, 7, 6, 1, 1, 1, 1, 1, 1, 1, 1),
(67, 7, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(68, 7, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(69, 7, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(70, 7, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(71, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(72, 8, 2, 1, 1, 1, 1, 1, 1, 1, 1),
(73, 8, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(74, 8, 4, 1, 1, 1, 1, 1, 1, 1, 1),
(75, 8, 5, 1, 1, 1, 1, 1, 1, 1, 1),
(76, 8, 6, 1, 1, 1, 1, 1, 1, 1, 1),
(77, 8, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(78, 8, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(79, 8, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(80, 8, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(81, 9, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(82, 9, 2, 1, 1, 1, 1, 1, 1, 1, 1),
(83, 9, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(84, 9, 4, 1, 1, 1, 1, 1, 1, 1, 1),
(85, 9, 5, 1, 1, 1, 1, 1, 1, 1, 1),
(86, 9, 6, 1, 1, 1, 1, 1, 1, 1, 1),
(87, 9, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(88, 9, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(89, 9, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(90, 9, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(91, 10, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(92, 10, 2, 1, 1, 1, 1, 1, 1, 1, 1),
(93, 10, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(94, 10, 4, 1, 1, 1, 1, 1, 1, 1, 1),
(95, 10, 5, 1, 1, 1, 1, 1, 1, 1, 1),
(96, 10, 6, 1, 1, 1, 1, 1, 1, 1, 1),
(97, 10, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(98, 10, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(99, 10, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(100, 10, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(101, 11, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(102, 11, 2, 1, 1, 1, 1, 1, 1, 1, 1),
(103, 11, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(104, 11, 4, 1, 1, 1, 1, 1, 1, 1, 1),
(105, 11, 5, 1, 1, 1, 1, 1, 1, 1, 1),
(106, 11, 6, 1, 1, 1, 1, 1, 1, 1, 1),
(107, 11, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(108, 11, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(109, 11, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(110, 11, 10, 1, 1, 1, 1, 1, 1, 1, 1),
(111, 12, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(112, 12, 2, 1, 1, 1, 1, 1, 1, 1, 1),
(113, 12, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(114, 12, 4, 1, 1, 1, 1, 1, 1, 1, 1),
(115, 12, 5, 1, 1, 1, 1, 1, 1, 1, 1),
(116, 12, 6, 1, 1, 1, 1, 1, 1, 1, 1),
(117, 12, 7, 1, 1, 1, 1, 1, 1, 1, 1),
(118, 12, 8, 1, 1, 1, 1, 1, 1, 1, 1),
(119, 12, 9, 1, 1, 1, 1, 1, 1, 1, 1),
(120, 12, 10, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listado_votantes`
--

CREATE TABLE `listado_votantes` (
  `id_listado` int(11) NOT NULL,
  `id_eleccion` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `codigo_voto` varchar(45) NOT NULL,
  `fecha_voto` datetime DEFAULT NULL,
  `estado_votante` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `listado_votantes`
--

INSERT INTO `listado_votantes` (`id_listado`, `id_eleccion`, `id_curso`, `id_estudiante`, `codigo_voto`, `fecha_voto`, `estado_votante`) VALUES
(1, 1, 1, 34, '1im001cu', '2018-10-24 12:29:27', 'si'),
(2, 1, 1, 35, '1ar011ab', '2018-10-24 12:31:10', 'si'),
(3, 1, 1, 37, '1la021ab', '2018-10-24 12:33:23', 'si'),
(4, 1, 1, 38, '1al031ar', '2018-10-24 12:34:46', 'si'),
(5, 1, 1, 40, '1ir041e ', '2018-10-24 12:49:38', 'si'),
(6, 1, 1, 42, '1ha051lo', '2018-10-24 12:38:06', 'si'),
(7, 1, 1, 43, '1ar061ue', '2018-10-24 12:38:57', 'si'),
(8, 1, 1, 45, '1ar071ar', '2018-10-24 12:40:28', 'si'),
(9, 1, 1, 47, '1ho081ar', '2018-10-24 12:41:29', 'si'),
(10, 1, 1, 48, '1es091ed', '2018-10-24 12:42:32', 'si'),
(11, 1, 1, 50, '1ar0101ed', '2018-10-24 12:43:38', 'si'),
(12, 1, 1, 51, '1ay0111ob', '2018-10-24 12:43:51', 'si'),
(13, 1, 1, 52, '1as0121ea', '2018-10-24 12:57:35', 'si'),
(14, 1, 1, 49, '1ho0131oc', '2018-10-24 12:56:26', 'si'),
(15, 1, 1, 46, '1ua0141oc', '2018-10-24 12:46:53', 'si'),
(16, 1, 1, 44, '1ar0151oc', '2018-10-24 12:48:32', 'si'),
(17, 1, 1, 41, '1ui0161oc', '2018-10-24 12:47:47', 'si'),
(18, 1, 1, 39, '1ur0171ol', '2018-10-24 12:49:03', 'si'),
(19, 1, 1, 36, '1na0181ol', '2018-10-24 12:49:09', 'si'),
(20, 1, 2, 11, '1ua101ar', '2018-10-24 12:28:37', 'si'),
(21, 1, 2, 13, '1dr111ue', '2018-10-24 12:31:00', 'si'),
(22, 1, 2, 15, '1os121ue', '2018-10-24 12:33:19', 'si'),
(23, 1, 2, 18, '1ua131ut', '2018-10-24 12:36:30', 'si'),
(24, 1, 2, 20, '1ng141en', '2018-10-24 12:37:54', 'si'),
(25, 1, 2, 22, '1ho151ob', '2018-10-24 12:39:28', 'si'),
(26, 1, 2, 24, '1or161ob', '2018-10-24 12:40:21', 'si'),
(27, 1, 2, 26, '1na171rt', '2018-10-24 12:41:18', 'si'),
(28, 1, 2, 28, '1ar181ac', NULL, 'no'),
(29, 1, 2, 29, '1ar191am', '2018-10-24 12:45:00', 'si'),
(30, 1, 2, 30, '1ua1101ic', '2018-10-24 12:48:18', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logros`
--

CREATE TABLE `logros` (
  `id_logro` int(11) NOT NULL,
  `nombre_logro` varchar(30) NOT NULL,
  `descripcion_logro` varchar(200) NOT NULL,
  `periodo` varchar(45) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `secuencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logros_asignados`
--

CREATE TABLE `logros_asignados` (
  `id_logro_asignacion` int(11) NOT NULL,
  `ano_lectivo` int(11) DEFAULT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  `periodo` varchar(8) DEFAULT NULL,
  `id_grado` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `id_logro1` int(11) DEFAULT NULL,
  `id_logro2` int(11) DEFAULT NULL,
  `id_logro3` int(11) DEFAULT NULL,
  `id_logro4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `madres`
--

CREATE TABLE `madres` (
  `id_madre` int(11) NOT NULL,
  `identificacion_m` varchar(10) NOT NULL,
  `nombres_m` varchar(50) NOT NULL,
  `apellido1_m` varchar(50) NOT NULL,
  `apellido2_m` varchar(45) NOT NULL,
  `parentesco_m` varchar(45) NOT NULL DEFAULT 'Madre',
  `sexo_m` varchar(1) NOT NULL DEFAULT 'f',
  `telefono_m` varchar(10) NOT NULL,
  `direccion_m` varchar(45) NOT NULL,
  `barrio_m` varchar(45) NOT NULL,
  `ocupacion_m` varchar(45) NOT NULL,
  `telefono_trabajo_m` varchar(10) NOT NULL,
  `direccion_trabajo_m` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `madres`
--

INSERT INTO `madres` (`id_madre`, `identificacion_m`, `nombres_m`, `apellido1_m`, `apellido2_m`, `parentesco_m`, `sexo_m`, `telefono_m`, `direccion_m`, `barrio_m`, `ocupacion_m`, `telefono_trabajo_m`, `direccion_trabajo_m`) VALUES
(1, '4100000000', 'Claudia', 'Ospino', 'Bravo', 'Madre', 'f', '3145677854', 'Sempegua', 'La Paz', 'Ama De Casa', '3145677854', 'Sempegua La Paz'),
(2, '4100000000', 'Claudia', 'Ospino', 'Bravo', 'Madre', 'f', '3145677854', 'Sempegua', 'La Paz', 'Ama De Casa', '3145677854', 'Sempegua La Paz'),
(3, '4100000000', 'Marcela', 'Lopez', 'Medina', 'Madre', 'f', '3145673421', 'Sempegua', 'La Paz', 'Ama De Casa', '3145673221', 'Sempegua La Paz'),
(4, '4100000000', 'Laura', 'Toloza', 'Diaz', 'Madre', 'f', '3156759876', 'Sempegua', 'La Paz', 'Ama De Casa', '3156759876', '3156759876'),
(5, '41000', 'Sandra', 'Gamarra', 'Lopez', 'Madre', 'f', '312456789', 'Sempegua', 'La Paz', 'Ama De Casa', '3127895788', 'Sempegua La Paz'),
(6, '5000000000', 'Dilia', 'Castaneda', 'Perez', 'Madre', 'f', '3120000000', 'Sempegua', 'La Paz', 'Ama De Casa', '3120000000', 'Sempegua La Paz'),
(7, '500000000', 'Bertha', 'Cadena', 'Gomez', 'Madre', 'f', '3129999999', 'Sempegua', 'La Paz', 'Ama De Casa', '3129999999', 'Sempegua La Paz'),
(8, '500000000', 'Liliana', 'Martinez', 'Ochoa', 'Madre', 'f', '3146789088', 'Sempegua', 'La Paz', 'Ama De Casa', '3146789078', 'Semepgua La Paz'),
(9, '50000000', 'Luisa', 'Obregon', 'Villa', 'Madre', 'f', '31456890', 'Sempegua', 'La Paz', 'Comerciante', '315567890', 'Sempegua La Paz'),
(10, '3456789', 'Luisa', 'Cavas', 'Cavas', 'Madre', 'f', '313456789', 'Sempegua', 'La Paz', 'Ama De Casa', '312444444', 'Sempegua'),
(11, '345678', 'Lina', 'Mendez', 'M', 'Madre', 'f', '2345678', 'Sempegua', 'La Paz', 'Vendedora', '2345678', 'La Paz'),
(12, '3343434', 'Miriam', 'Quevedo', 'Q', 'Madre', 'f', '323232', 'Ffff', 'Fff', 'Fff', '4444', 'Ffff'),
(13, '4567890', 'Milena', 'Mendez', 'M', 'Madre', 'f', '4567890', 'Dfghjk', 'Fghjk', 'Fghjk', '6789', '6789'),
(14, '4567890', 'Marina', 'Nobles', 'Dfghjk', 'Madre', 'f', '567890', 'Fghjkl', 'Fghjkl', 'Fghjkl', '67890', 'Fghjkl'),
(15, '4567890', 'Lorena', 'Mendez', 'Dfg', 'Madre', 'f', '56789', 'Fghjk', 'Fghjk', 'Fghjk', '555', 'Dfghjklñ'),
(16, '456789', 'Lina', 'Nobles', 'Fghjk', 'Madre', 'f', '67890', 'Fghjk', 'Ghjkl', 'Ghjkl', '67890', 'Ghjkl'),
(17, '4567890', 'Luisa', 'Toloza', 'Sdfghjkl', 'Madre', 'f', '4567890', 'Dfghjkl', 'Fghjkl', 'Fghjkl', '567890', 'Cvbnm,'),
(18, '3456789', 'Camila', 'Crespo', 'Crespo', 'Madre', 'f', '567890', 'Cvbnm,', 'Dfghjk', 'Fghjkl', '567890', 'Fghjkl'),
(19, '1066', 'Eva', 'Diaz', 'Picon', 'Madre', 'f', '3206919220', 'Sempegua', 'Sempegua', 'Ama De Casa', '3206919220', 'Sempegua'),
(20, '4567890', 'Lourdes', 'Toloza', 'Toloza', 'Madre', 'f', '3456789', 'Dfghjkl', 'Dfghjk', 'Fghjkl', '456789', '3456789'),
(21, '456789', 'Fghjk', 'Fghjk', 'Fghjk', 'Madre', 'f', '567890', 'Dfghjkl', 'Fghjkl', 'Fghjkl', '567890', 'Fghjk'),
(22, '1066', 'Eva', 'Picon', 'Diaz', 'Madre', 'f', '3206919220', 'Sempegua', 'Sempegua', 'Ama De Casa', '3206919220', 'Sempegua'),
(23, '456789', 'Fghjk', 'Vbnm', 'Vbnm', 'Madre', 'f', '567890', 'Fghjkl', 'Fghjkl', 'Fghjk', '6789', 'Ghjk'),
(24, '1066', 'Eva', 'Picon', 'Diaz', 'Madre', 'f', '3206919220', 'Calle 30a 32-86', 'Sempegua', 'Ama De Casa', '3206919220', 'Sempegua'),
(25, '456789', 'Dfghjk', 'Fghjk', 'Ghjk', 'Madre', 'f', '56789', 'Bnm', 'Dfghj', 'Dfghj', '6789', 'Fghjk'),
(26, '2323232', 'Frrf', 'Frfr', 'Rfrfr', 'Madre', 'f', '333333', 'Dfghjk', 'Dfghjkl', 'Dfghjkl', '456789', 'Fghkl??'),
(27, '1066', 'Eva', 'Picon', 'Diaz', 'Madre', 'f', '3206919220', 'Calle 30a 32-86', 'Sempegua', 'Ama De Casa', '3206919220', 'Calle 30a 32-86'),
(28, '456789', 'Fghjkl', 'Fghjk', 'Fghjk', 'Madre', 'f', '567890', 'Dfghjk', 'Fghjk', 'Dfghjk', '45678', 'Dfghk'),
(29, '1066', 'Eva', 'Picon', 'Diaz', 'Madre', 'f', '3206919220', 'Calle 30a 32-86', 'Sempegua', 'Ama De Casa', '3206919220', 'Calle 30a 32-86'),
(30, '456789', 'Dfghjk', 'Dfghjk', 'Fghjk', 'Madre', 'f', '567890', 'Dfghjk', 'Cvbnm', 'Cvbnm', '5689', 'Cvbn'),
(31, '456789', 'Dfghjkl', 'Fghjk', 'Ghjk', 'Madre', 'f', '567890', 'Dfghjk', 'Ghjkl', 'Ghjkl', '67890', 'Ghjkl??'),
(32, '1065', 'Eva', 'Picon', 'Diaz', 'Madre', 'f', '3206919220', 'Calle 30a 32-86', 'Sempegua', 'Ama De Casa', '3206919220', 'Calle 30a 32-86'),
(33, '3456789', 'Dfghjkl', 'Fghjkl', 'Fghjkl', 'Madre', 'f', '56890', 'Cvbnm', 'Fghjkl', 'Fghjk', '5689', 'Fghkl'),
(34, '456789', 'Dfghjkl', 'Fghjkl', 'Vbnm', 'Madre', 'f', '56789', 'Dfghjkl??', 'Cvbnm', 'Cvbnm,', '67890', 'Ghjkl'),
(35, '1066', 'Eva', 'Picon', 'Diaz', 'Madre', 'f', '3206919220', 'Calle 30a 32-86', 'Sempegua', 'Ama De Casa', '3206919220', 'Calle 30a 32-86'),
(36, '1011', 'Ana Milena', 'Martinez', 'Contreras', 'Madre', 'f', '3206919220', 'Calle 30a 32-86', 'Sempegua', 'Ama De Casa', '3206919220', 'Calle 30a 32-86'),
(37, '133234565', 'Maria Angela', 'Toloza', 'Toloza', 'Madre', 'f', '318675755', 'Sempegua', 'Barrio Arriba', 'Ama De Casa', '434565445', 'Sempegua'),
(38, '4312123454', 'Rosa', 'Toloza', 'Martinez', 'Madre', 'f', '32245656', 'Sempegua', 'El Campo', 'Enfermera', '432222535', 'Chimichagua'),
(39, '132456456', 'Cristina', 'Nunez', 'Toloza', 'Madre', 'f', '321566786', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '434436333', 'Sempegua'),
(40, '1454433', 'Margoris', 'Valle', 'Ramirez', 'Madre', 'f', '32245565', 'Sempegua', 'El Bronx', 'Ama De Casa', '32242565', 'Sempegua'),
(41, '153446756', 'Socnis Victoria', 'Cadena', 'Parra', 'Madre', 'f', '3256545', 'Sempegua', 'La Playa', 'Ama De Casa', '32345665', 'Sempegua'),
(42, '101020', 'Neil', 'Cardenas', 'Martinez', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', '3116845721'),
(43, '11145676', 'Martha', 'Martinez', 'Luqueta', 'Madre', 'f', '3213468', 'Sempegua', 'La Central', 'Ama De Casa', '3223234', 'Sempegua'),
(44, '103145755', 'Eva', 'Picon', 'Diaz', 'Madre', 'f', '3116478443', 'Sempegua', 'Centro', 'Ama De Casa', '3116478443', 'Sempegua'),
(45, '213237878', 'Isabel Saray', 'Martinez', 'Nobles', 'Madre', 'f', '313454657', 'Sempegua', 'La Central', 'Ama De Casa', '3454546', 'Sempegua'),
(46, '1054754545', 'Ana Milena', 'Valle', 'Nobles', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(47, '2745446541', 'Aura', 'Contreras', 'Fuentes', 'Madre', 'f', '3206919220', 'Sempegua', 'Centro', 'Comericante', '3206919220', 'Sempegua'),
(48, '1334546', 'Carmen', 'Contreras', 'Rocha', 'Madre', 'f', '3255667767', 'Sempegua', 'La Plaza', 'Ama De Casa', '2123454', 'Sempegua'),
(49, '497168114', 'Maria', 'Miranda', 'Guerrero', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(50, '541444121', 'Ena Luz', 'Obregon', 'Lascarro', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(51, '12469907', 'Eugenia', 'Munoz', 'Hernandez', 'Madre', 'f', '332567888', 'Sempegua', 'Barrio Arriba', 'Ama De Casa', '2454667', 'Sempegua'),
(52, '482345121', 'Milena', 'Mendez', 'Ortiz', 'Madre', 'f', '3206919220', 'Sempegua', 'Centro', 'Comerciante', '3206919220', 'Sempegua'),
(53, '12698785', 'Alicia', 'Salazar', 'Martinez', 'Madre', 'f', '2253675', 'Sempegua', 'La Esquina', 'Ama De Casa', '14457586', 'Sempegua'),
(54, '26729304', 'Nereida', 'Palomino', 'Cerpa', 'Madre', 'f', '3188866092', 'Sempegua', 'La Paz', 'Director Centro E', '3188866092', 'Sempegua'),
(55, '26759454', 'Diamaris', 'Palomino', 'Cerpa', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(56, '27993482', 'Madeleine', 'Nobles', 'Martinez', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(57, '26729345', 'Daniela', 'Nobles', 'Martinez', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(58, '492454815', 'Andrea', 'Rincon', 'Perez', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(59, '24546897', 'Maria Jose', 'Lopez', 'Quiroga', 'Madre', 'f', '329389839', 'Sempegua', 'Chimichagua', 'Ama De Casa', '232356436', 'Sempegua'),
(60, '1063245857', 'Sandy', 'Palomino', 'Gutierrez', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(61, '1434790098', 'Diana Isabel', 'Alvarez', 'Fernandez', 'Madre', 'f', '32124465', 'Sempegua', 'La Plaza', 'Ama De Casa', '243575', 'Sempegua'),
(62, '1065648524', 'Milena', 'Lopez', 'Cadena', 'Madre', 'f', '3116845721', 'Sempegua', 'La Paz', 'Ama De Casa', '3116845721', 'Sempegua'),
(63, '12167657', 'Ana Sofia', 'Mendez', 'Salazar', 'Madre', 'f', '318809905', 'Sempegua', 'La Esquina', 'Ama De Casa', '23435457', 'Sempegua'),
(64, '264714545', 'Cielo', 'Toloza', 'Paez', 'Madre', 'f', '', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(65, '234357665', 'Luz Mery', 'Obregon', 'Martinez', 'Madre', 'f', '24457687', 'Sempegua', 'Las Palmas', 'Ama De Casa', '3545765', 'Sempegua'),
(66, '26729165', 'Mireya', 'Palomino', 'Cerpa', 'Madre', 'f', '3052452651', 'Sempegua', 'Centro', 'Ama De Casa', '3052452651', 'Sempegua'),
(67, '10987165', 'Nelis', 'Jimenez', 'Cadena', 'Madre', 'f', '378368610', 'Sempegua', 'La Paz', 'Costurera', '214583274', 'Sempegua'),
(68, '4975815452', 'Milena', 'Quevedo', 'Nobles', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Ama De Casa', '3116845721', 'Sempegua'),
(69, '100787665', 'Rubis Isabel', 'Rocha', 'Cabas', 'Madre', 'f', '3287890', 'Sempegua', 'Barrio Arriba', 'Ama De Casa', '32343565', 'Sempegua'),
(70, '267296315', 'Maria', 'Vasquez', 'Mejia', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(71, '10117673', 'Maria Cristina', 'Rincon', 'Perez', 'Madre', 'f', '325879967', 'Sempegua', 'La Central', 'Ama De Casa', '545465767', 'Sempegua'),
(72, '26746484', 'Edelma', 'Martinez', 'Cogollo', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Ama De Casa', '3116845721', 'Sempegua'),
(73, '1098963', 'Luz Mary', 'Pacheco', 'Lopez', 'Madre', 'f', '214345435', 'Sempegua', 'La Central', 'Ama De Casa', '1334453', 'Sempegua'),
(74, '1087655343', 'Ana De Jesus', 'Santos', 'Cadena', 'Madre', 'f', '2344567558', 'Sempegua', 'La Central', 'Ama De Casa', '1234576576', 'Sempegua'),
(75, '1087876353', 'Marbelis', 'Martinez', 'Nobles', 'Madre', 'f', '3123878374', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '317835432', 'Sempegua'),
(76, '100647323', 'Sofia', 'Martinez', 'Perez', 'Madre', 'f', '324354353', 'Sempegua', 'La Carretera', 'Ama De Casa', '244534534', 'Sempegua'),
(77, '112397874', 'Josefina', 'Arroyo', 'Mendez', 'Madre', 'f', '3455667567', 'Sempegua', 'La Plaza', 'Ama De Casa', '342345543', 'Sempegua'),
(78, '19789334', 'Leonilda', 'Pacheco', 'Lopez', 'Madre', 'f', '34449543', 'Sempegua', 'La Roca', 'Ama De Casa', '23454354', 'Sempegua'),
(79, '267415715', 'Maria', 'Palomino', 'Estrada', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Comerciante', '3116845721', 'Sempegua'),
(80, '26729351', 'Andrea', 'Diaz', 'Gutierrez', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Ama De Casa', '3116845721', 'Sempegua'),
(81, '416725454', 'Mabe', 'Suarez', 'Gutierrez', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Ama De Casa', '3116845721', 'Sempegua'),
(82, '2674584154', 'Patricia', 'Contreras', 'Martinez', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(83, '1063548245', 'Daniela', 'Infante', 'Andrade', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(84, '265245785', 'Laura', 'Rodriguez', 'Paez', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Ama De Casa', '3116845721', 'Sempegua'),
(85, '1063254745', 'Yeni', 'Gutierrez', 'Toloza', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Ama De Casa', '3116845721', 'Sempegua'),
(86, '1606844855', 'Orianis', 'Mejia', 'Lopez', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(87, '1063254584', 'Claudia', 'Cadena', 'Perez', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(88, '102645455', 'Edelmira', 'Mendoza', 'Mendez', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Ama De Casa', '3116845721', 'Sempegua'),
(89, '26712458', 'Nayeth', 'Nobles', 'Berruecos', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(90, '1065481451', 'Veronica', 'Martinez', 'Contreras', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(91, '1065478215', 'Laura', 'Martinez', 'Lobo', 'Madre', 'f', '3116845721', 'Sempegua', 'La Paz', 'Comerciante', '3116845721', 'Sempegua'),
(92, '1065485455', 'Uldis', 'Hernandez', 'Paba', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Comerciante', '3116845721', 'Sempegua'),
(93, '267414584', 'Nelly Cecilia', 'Nobles', 'Mendez', 'Madre', 'f', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(94, '1065482454', 'Cristina', 'Toloza', 'Cabas', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Ama De Casa', '3116845721', 'Sempegua'),
(95, '1067452155', 'Rosa', 'Nobles', 'Cadena', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Comerciante', '3116845721', 'Sempegua'),
(96, '1021445452', 'Anacentih', 'Silva', 'Mendez', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Ama De Casa', '3116845721', 'Sempegua'),
(97, '106548245', 'Milena', 'Acosta', 'Soraca', 'Madre', 'f', '3116845721', 'Sempegua', 'La Plaza', 'Ama De Casa', '3116845721', 'Sempegua'),
(98, '1076557567', 'Nidia', 'Martinez', 'Lopez', 'Madre', 'f', '328767578', 'Sempegua', 'La Plaza', 'Ama De Casa', '42345667', 'Sempegua'),
(99, '10876556', 'Maria Isabel', 'Mendez', 'Contreras', 'Madre', 'f', '32567788', 'Sempegua', 'La Central', 'Ama De Casa', '245467', 'Sempegua'),
(100, '10453637', 'Juana', 'Toloza', 'Rocha', 'Madre', 'f', '327889776', 'Sempegua', 'La Playa', 'Ama De Casa', '2673673', 'Sempegua'),
(101, '1903673763', 'Margoris', 'Valle', 'Nobles', 'Madre', 'f', '5442463257', 'Sempegua', 'El Bronx', 'Ama De Casa', '342455265', 'Sempegua'),
(102, '107635', 'Juliana', 'Cadena', 'Toloza', 'Madre', 'f', '3215676', 'Sempegua', 'La Paz', 'Ama De Casa', '24534563', 'Sempegua'),
(103, '10987635', 'Kendry Jhoana', 'Moncada', 'Ruiz', 'Madre', 'f', '325568768', 'Sempegua', 'Divino  NiÑo', 'Ama  De Casa', '23456789', 'Sempegua'),
(104, '186898474', 'Luisa Maria', 'Pacheco', 'Lopez', 'Madre', 'f', '322676788', 'Sempegua', 'Las Palmas', 'Ama De Casa', '35462762', 'Sempegua'),
(105, '1268897', 'Mayra', 'Hernandez', 'Ramirez', 'Madre', 'f', '2563674', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '23455354', 'Sempegua'),
(106, '16376763', 'Rosa Maria', 'Martinez', 'Rocha', 'Madre', 'f', '327687689', 'Sempegua', 'La Plaza', 'Ama De Casa', '23567656', 'Sempegua'),
(107, '109867445', 'Luisa  Fernanda', 'Cardenas', 'Florez', 'Madre', 'f', '312348458', 'Sempegua', 'La Plaza', 'Ama De Casa', '32454656', 'Sempegua'),
(108, '24546575', 'Rosa', 'Quevedo', 'Aragon', 'Madre', 'f', '21354546', 'Sempegua', 'La Plaza', 'Ama De Casa', '23432534', 'Sempegua'),
(109, '12390742', 'Rosa', 'Quevedo', 'Aragon', 'Madre', 'f', '345465464', 'Sempegua', 'La Plaza', 'Ama De Casa', '23543643', 'Sempegua'),
(110, '29879390', 'Disneila', 'Nobles', 'Contreras', 'Madre', 'f', '21432432', 'Sempegua', 'La Paz', 'Ama De Casa', '3454464', 'Sempegua'),
(111, '12434353', 'Ana Maria', 'Obregon', 'Cadena', 'Madre', 'f', '327887992', 'Sempegua', 'Barrio Arriba', 'Ama De Casa', '243535', 'Sempegua'),
(112, '123908024', 'Cristina', 'Luquetta', 'Lopez', 'Madre', 'f', '2342353', 'Sempegua', 'La Roca', 'Ama De Casa', '3123453463', 'Sempegua'),
(113, '123284923', 'Laura', 'Berruecos', 'Nobles', 'Madre', 'f', '3222555677', 'Sempegua', 'La Paz', 'Ama De Casa', '346354532', 'Sempegua'),
(114, '106544378', 'Andrea', 'Luqueta', 'Ruiz', 'Madre', 'f', '566783243', 'Sempegua', 'La Playa', 'Ama De Casa', '324353534', 'Sempegua'),
(115, '109773687', 'Nuris Isabel', 'Perez', 'Mojica', 'Madre', 'f', '3243546', 'Sempegua', 'La Roca', 'Ama De Casa', '23445433', 'Sempegua'),
(116, '243365675', 'Karol Yuliana', 'Quevedo', 'Aragon', 'Madre', 'f', '3245666765', 'Sempegua', 'La Plaza', 'Ama De Casa', '3453543', 'Sempegua'),
(117, '1073453243', 'Rosmery', 'Vasquez', 'Garrido', 'Madre', 'f', '3145464564', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '312321424', 'Sempegua'),
(118, '130985785', 'Milena', 'Arroyo', 'Paez', 'Madre', 'f', '3253254353', 'Sempegua', 'La Playa', 'Ama De Casa', '313455465', 'Sempegua'),
(119, '1073633433', 'Ana Judith', 'Padilla', 'Martinez', 'Madre', 'f', '324546456', 'Sempegua', 'La Plaza', 'Ama De Casa', '243243534', 'Sempegua'),
(120, '10854654', 'Eva Maria', 'Nobles', 'Cardenas', 'Madre', 'f', '3224353543', 'Sempegua', 'La Central', 'Ama De Casa', '3234545654', 'Sempegua'),
(121, '106544353', 'Marilin', 'Toloza', 'Vasquez', 'Madre', 'f', '321567676', 'Sempegua', 'La Plaza', 'Ama De Casa', '32543436', 'Sempegua'),
(122, '109878686', 'Antonella', 'Cabas', 'Obregon', 'Madre', 'f', '322378799', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '32456878', 'Sempegua'),
(123, '1007542323', 'Juliana', 'Contreras', 'Guzman', 'Madre', 'f', '3214565657', 'Sempegua', 'La Central', 'Ama De Casa', '3214655665', 'Sempegua'),
(124, '1007542323', 'Juliana', 'Contreras', 'Guzman', 'Madre', 'f', '3214565657', 'Sempegua', 'La Central', 'Ama De Casa', '3214655665', 'Sempegua'),
(125, '19087786', 'Maria Alejandra', 'Lopez', 'Miranda', 'Madre', 'f', '312343343', 'Sempegua', 'La Paz', 'Ama De Casa', '234353243', 'Sempegua'),
(126, '108545678', 'Nereida', 'Zambrano', 'Nobles', 'Madre', 'f', '3235346546', 'Sempegua', 'La Central', 'Ama De Casa', '3234365465', 'Sempegua'),
(127, '1124234234', 'Sandra Milena', 'Obregon', 'Sarmiento', 'Madre', 'f', '314667878', 'Sempegua', 'La Plaza', 'Ama De Casa', '23423535', 'Sempegua'),
(128, '1064543778', 'Cristina', 'Toloza', 'Paez', 'Madre', 'f', '3123454654', 'Sempegua', 'La Paz', 'Ama De Casa', '31456546', 'Sempegua'),
(129, '108973676', 'Lucelis', 'Rangel', 'Perez', 'Madre', 'f', '312454545', 'Sempegua', 'La Roca', 'Ama De Casa', '312234578', 'Sempegua'),
(130, '1390897648', 'Solmaira', 'Hernandez', 'Florez', 'Madre', 'f', '3114546454', 'Sempegua', 'La Plaza', 'Ama De Casa', '3124534554', 'Sempegua'),
(131, '102376678', 'Yane', 'Contreras', 'Ibanez', 'Madre', 'f', '312343245', 'Sempegua', 'Barrio Arriba', 'Ama De Casa', '323435355', 'Sempegua'),
(132, '1053425657', 'Zeneth', 'Pinto', 'Cadena', 'Madre', 'f', '312343545', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '32345345', 'Sempegua'),
(133, '190878685', 'Zeneth', 'Pinto', 'Cadena', 'Madre', 'f', '342344232', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '323465756', 'Sempegua'),
(134, '198976723', 'Angelica', 'Ruiz', 'Paez', 'Madre', 'f', '312344545', 'Sempegua', 'La Central', 'Ama De Casa', '2342343', 'Sempegua'),
(135, '127363893', 'Juana', 'Martinez', 'Berrio', 'Madre', 'f', '3234545', 'Sempegua', 'La Playa', 'Ama De Casa', '1223434545', 'Sempegua'),
(136, '12234243', 'Paulina', 'Nobles', 'Vides', 'Madre', 'f', '3246554', 'Sempegua', 'Las Palmas', 'Ama De Casa', '23534534', 'Sempegua'),
(137, '10764356', 'Gerogina', 'Alvarez', 'Rodriguez', 'Madre', 'f', '32157878', 'Sempegua', 'El Campo', 'Ama De Casa', '3354354', 'Sempegua'),
(138, '198976565', 'Mercedes', 'Caballero', 'Chavez', 'Madre', 'f', '245435435', 'Sempegua', 'La Roca', 'Ama De Casa', '2343423', 'Sempegua'),
(139, '187554656', 'Ana Sofia', 'Mendez', 'Lopez', 'Madre', 'f', '31465756', 'Sempegua', 'La Esquina', 'Ama De Casa', '34353242', 'Sempegua'),
(140, '1078675576', 'Yamaris', 'Palomino', 'Cerpa', 'Madre', 'f', '3134545', 'Sempegua', 'La Paz', 'Ama De Casa', '3234353534', 'Sempegua'),
(141, '17857545', 'Diana Liz', 'Cadena', 'Rocha', 'Madre', 'f', '321244355', 'Sempegua', 'La Playa', 'Ama De Casa', '3265464', 'Sempegua'),
(142, '10987665', 'Khaterin', 'Luna', 'Hernandez', 'Madre', 'f', '344546546', 'Sempegua', 'Barrio Arriba', 'Ama De Casa', '23543534', 'Sempegua'),
(143, '1087654635', 'Luz Mery', 'Obregon', 'Cadena', 'Madre', 'f', '323556556', 'Sempegua', 'La Palmas', 'Ama De Casa', '3254645', 'Sempegua'),
(144, '187988363', 'Luz Enith', 'Rocha', 'Cabas', 'Madre', 'f', '32423355', 'Sempegua', 'La Playa', 'Ama De Casa', '324546464', 'Sempegua'),
(145, '1908655445', 'Luzmary', 'Pacheco', 'Lopez', 'Madre', 'f', '32354645', 'Sempegua', 'La Central', 'Ama De Casa', '3243564564', 'Sempegua'),
(146, '0445256373', 'Martha Sofia', 'Hernandez', 'Jimenez', 'Madre', 'f', '3267876786', 'Sempegua', 'El Campo', 'Ama De Casa', '35434534', 'Sempegua'),
(147, '1098767', 'Norelis', 'Contreras', 'Ibanez', 'Madre', 'f', '224234234', 'Sempegua', 'La Playa', 'Ama De Casa', '234354354', 'Sempegua'),
(148, '1233543556', 'Eva Sandrith', 'Martinez', 'Meza', 'Madre', 'f', '32565475', 'Sempegua', 'La Plaza', 'Ama De Casa', '21434544', 'Sempegua'),
(149, '123890709', 'Yeinis', 'Martinez', 'Obregon', 'Madre', 'f', '3234222', 'Sempegua', 'La Central', 'Ama De Casa', '323544454', 'Sempegua'),
(150, '13434533', 'Katrina', 'Jimenez', 'Cadena', 'Madre', 'f', '334543654', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '3243453543', 'Sempegua'),
(151, '1054787437', 'Dayana', 'Luqueta', 'Mallorca', 'Madre', 'f', '325454566', 'Sempegua', 'A Plaza', 'Ama De Casa', '313453535', 'Sempegua'),
(152, '1324656657', 'Mariana', 'Mieles', 'Ramirez', 'Madre', 'f', '2343543543', 'Sempegua', 'La Esquina', 'Ama De Casa', '124343', 'Sempegua'),
(153, '1006563636', 'Miriam', 'Mieles', 'Ramirez', 'Madre', 'f', '312445435', 'Sempegua', 'La Esquina', 'Ama De Casa', '234335', 'Sempegua'),
(154, '1066478584', 'Leonelda', 'Pacheco', 'Lopez', 'Madre', 'f', '323435534', 'Sempegua', 'La Roca', 'Ama De Casa', '3235435234', 'Sempegua'),
(155, '100646743', 'Ana Maria', 'Mendez', 'Ruiz', 'Madre', 'f', '323435433', 'Sempegua', 'La Plaza', 'Ama De Casa', '312435345', 'Sempegua'),
(156, '105063737', 'Sabrina', 'Toloza', 'Miranda', 'Madre', 'f', '3124546546', 'Sempegua', 'La Central', 'Ama De Casa', '3124353453', 'Sempegua'),
(157, '109876342', 'Elena Judith', 'Reales', 'Yanez', 'Madre', 'f', '24323533', 'Sempeua', 'La Playa', 'Ama De Casa', '32424232', 'Sempegua'),
(158, '19877353', 'Cecilia', 'Contreras', 'Diaz', 'Madre', 'f', '254654645', 'Sempegua', 'La Central', 'Ama De Casa', '3243640843', 'Sempegua'),
(159, '187839795', 'Greys', 'Ramirez', 'Hernandez', 'Madre', 'f', '3254354', 'Sempegua', 'La Central', 'Ama De Casa', '325435464', 'Sempegua'),
(160, '1007644643', 'Lorena', 'Contreras', 'Florez', 'Madre', 'f', '32435454', 'Sempegua', 'La Central', 'Ama De Casa', '234353453', 'Sempegua'),
(161, '209876567', 'Patricia', 'Toloza', 'Mendez', 'Madre', 'f', '234454645', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '32543635', 'Sempegua'),
(162, '109968534', 'Yadis Adriana', 'Martinez', 'Vasquez', 'Madre', 'f', '234354354', 'Sempegua', 'La Playa', 'Ama De Casa', '324325432', 'Sempegua'),
(163, '1656634874', 'Centih', 'Martinez', 'Lopez', 'Madre', 'f', '322576575', 'Sempegua', 'La Esquina', 'Ama De Casa', '321435435', 'Sempegua'),
(164, '1766457344', 'Yadira', 'Viloria', 'Mendez', 'Madre', 'f', '242366756', 'Sempegua', 'La Paz', 'Ama De Casa', '246574323', 'Sempegua'),
(165, '2234547709', 'Fabiola', 'Nobles', 'Fernandez', 'Madre', 'f', '3146547654', 'Sempegua', 'Las Palmas', 'Ama De Casa', '1335435433', 'Sempegua'),
(166, '897523342', 'Yulieth Maria', 'Cabas', 'Gonzales', 'Madre', 'f', '323543654', 'Sempegua', 'Divino NiÑo', 'Docente', '32544353', 'Sempegua'),
(167, '23874365', 'Isabel Cristina', 'Martinez', 'Garrido', 'Madre', 'f', '323565656', 'Sempegua', 'La Paz', 'Ama De Casa', '33454654', 'Sempegua'),
(168, '13567544', 'Ana Idalides', 'Cerpa', 'Mallorca', 'Madre', 'f', '335445636', 'Sempegua', 'La Paz', 'Ama De Casa', '24342342', 'Sempegua'),
(169, '1897673478', 'Gil Maria', 'De La Cruz', 'Santos', 'Madre', 'f', '32565756', 'Sempegua', 'La Central', 'Ama De Casa', '234645645', 'Sempegua'),
(170, '1006537632', 'Diana Luz', 'Martinez', 'Obregon', 'Madre', 'f', '31245433', 'Sempegua', 'Barrio Arriba', 'Ama De Casa', '33234353', 'Sempegua'),
(171, '108646534', 'Renata Maria', 'Arroyo', 'Pertuz', 'Madre', 'f', '3251287565', 'Sempegua', 'La Plaza', 'Ama De Casa', '3124545645', 'Sempegua'),
(172, '19087356', 'Dina Luz', 'Obregon', 'Perez', 'Madre', 'f', '316788003', 'Sempegua', 'La Central', 'Ama De Casa', '3124343543', 'Sempegua'),
(173, '109829765', 'Sara Cristina', 'Martinez', 'Ramirez', 'Madre', 'f', '3124454664', 'Sempegua', 'La Plaza', 'Sempegua', '323432534', 'Sempegua'),
(174, '10939649', 'Josefina', 'Nobles', 'Lopez', 'Madre', 'f', '23443646', 'Sempegua', 'La Paz', 'Ama De Casa', '31344534', 'Sempegua'),
(175, '1009864785', 'Sandrith Maria', 'Toloza', 'Fernandez', 'Madre', 'f', '343253543', 'Sempegua', 'La Playa', 'Ama De Casa', '32346454', 'Sempegua'),
(176, '1390784430', 'Abril Maria', 'Miranda', 'Torres', 'Madre', 'f', '315346450', 'Sempegua', 'Barrio Arriba', 'Ama De Casa', '313425546', 'Sempegua'),
(177, '109475834', 'Yaniris', 'Cardenas', 'Perez', 'Madre', 'f', '323435436', 'Sempegua', 'El Campo', 'Ama De Casa', '31245436', 'Sempegua'),
(178, '10987465', 'Yoledis', 'Florez', 'Chavez', 'Madre', 'f', '3124325436', 'Sempegua', 'La Paz', 'Ama De Casa', '312443643', 'Sempegua'),
(179, '109734984', 'Yajaira Helena', 'Padilla', 'Rocha', 'Madre', 'f', '3342357063', 'Sempegu', 'La Playa', 'Ama De Casa', '312432535', 'Sempegua'),
(180, '1374234329', 'Yajaira Helena', 'Padilla', 'Rocha', 'Madre', 'f', '312365765', 'Sempegua', 'La Playa', 'Ama De Casa', '32343543', 'Sempegua'),
(181, '408879463', 'Helena Jhoana', 'Martinez', 'Toloza', 'Madre', 'f', '312343253', 'Sempegua', 'La Plaza', 'Ama De Casa', '3233543', 'Sempegua'),
(182, '107436762', 'Helena Jhoana', 'Martinez', 'Toloza', 'Madre', 'f', '3152897643', 'Sempegua', 'La Plaza', 'Ama De Casa', '32132423', 'Sempegua'),
(183, '1243465464', 'Vanessa', 'Munoz', 'Jimenez', 'Madre', 'f', '312354343', 'Sempegua', 'La Central', 'Ama De Casa', '312369007', 'Sempegua'),
(184, '90878436', 'Selena Maria', 'Mayorga', 'De Hoyos', 'Madre', 'f', '32276108', 'Sempegua', 'La Roca', 'Ama De Casa', '312435345', 'Sempegua'),
(185, '1087857689', 'Natalia', 'Hernandez', 'Mendez', 'Madre', 'f', '234345464', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '31243534', 'Sempegua'),
(186, '1943957435', 'Tatiana', 'Luqueta', 'Mejia', 'Madre', 'f', '312546545', 'Sempegua', 'La Central', 'Ama De Casa', '312654765', 'Sempegua'),
(187, '1093473245', 'Tatiana', 'Luqueta', 'Mejia', 'Madre', 'f', '3245654754', 'Sempegua', 'La Central', 'Ama De Casa', '312434534', 'Sempegua'),
(188, '3284932432', 'Samanta', 'Martinez', 'Escobar', 'Madre', 'f', '312423534', 'Sempegua', 'Barrio Arriba', 'Ama De Casa', '3177867753', 'Sempegua'),
(189, '19328749', 'Ana Maria', 'Quevedo', 'Nobles', 'Madre', 'f', '3115466575', 'Sempegua', 'La Plaza', 'Ama De Casa', '31234454', 'Sempegua'),
(190, '1999874332', 'Sandra Milena', 'Velasquez', 'Torres', 'Madre', 'f', '31243534', 'Sempegua', 'La  Playa', 'Ama De Casa', '312445345', 'Sempegua'),
(191, '197242346', 'Sandra Milena', 'Velasquez', 'Torres', 'Madre', 'f', '3169865445', 'Sempegua', 'La Playa', 'Ama De Casa', '31234575', 'Sempegua'),
(192, '184732423', 'Patricia', 'Acosta', 'Martinez', 'Madre', 'f', '323546457', 'Sempegua', 'Las Palmas', 'Ama De Casa', '3126876453', 'Sempegua'),
(193, '107634763', 'Marisol', 'Mendez', 'Rocha', 'Madre', 'f', '3257897665', 'Sempegua', 'Divino NiÑo', 'Ama De Casa', '3124325435', 'Sempegua'),
(194, '2230957353', 'Sol', 'Rico', 'Marquez', 'Madre', 'f', '3146687698', 'Sempegua', 'El Campo', 'Ama De Casa', '3168765546', 'Sempegua'),
(195, '8364523842', 'Norfalia', 'Arroyo', 'Jimenez', 'Madre', 'f', '32435436', 'Sempegua', 'La Paz', 'Ama De Casa', '3235756', 'Sempegua'),
(196, '465687443', 'Isabela', 'Palomino', 'Gutierrez', 'Madre', 'f', '322689790', 'Sempegua', 'La Plaza', 'Ama De Casa', '32536544', 'Sempegua'),
(197, '364327583', 'Leonelda', 'Pacheco', 'Lopez', 'Madre', 'f', '312346547', 'Sempegua', 'La Roca', 'Ama De Casa', '323546657', 'Sempegua');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id_matricula` int(11) NOT NULL,
  `fecha_matricula` date NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `jornada` varchar(6) NOT NULL,
  `id_acudiente` int(11) NOT NULL,
  `parentesco` varchar(45) NOT NULL,
  `observaciones` varchar(45) NOT NULL,
  `estado_matricula` varchar(15) NOT NULL,
  `situacion_academica` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`id_matricula`, `fecha_matricula`, `ano_lectivo`, `id_estudiante`, `id_curso`, `jornada`, `id_acudiente`, `parentesco`, `observaciones`, `estado_matricula`, `situacion_academica`) VALUES
(1, '2018-10-24', 1, 34, 1, 'Mañana', 56, 'Madre', 'Ninguna', 'Activo', 'No Definida'),
(2, '2018-10-24', 1, 35, 1, 'Mañana', 53, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(3, '2018-10-24', 1, 37, 1, 'Mañana', 58, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(4, '2018-10-24', 1, 38, 1, 'Mañana', 55, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(5, '2018-10-24', 1, 40, 1, 'Mañana', 55, 'Madrina', 'Ninguna', 'Activo', 'No Definida'),
(6, '2018-10-24', 1, 42, 1, 'Mañana', 57, 'Padrino', 'Ninguna', 'Activo', 'No Definida'),
(7, '2018-10-24', 1, 43, 1, 'Mañana', 57, 'Cuñado(a)', 'Ninguna', 'Activo', 'No Definida'),
(8, '2018-10-24', 1, 45, 1, 'Mañana', 57, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(9, '2018-10-24', 1, 47, 1, 'Mañana', 56, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(10, '2018-10-24', 1, 48, 1, 'Mañana', 58, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(11, '2018-10-24', 1, 50, 1, 'Mañana', 56, 'Hermano(a)', 'Ninguna\r\n', 'Activo', 'No Definida'),
(12, '2018-10-24', 1, 51, 1, 'Mañana', 58, 'Madre', 'Ninguna', 'Activo', 'No Definida'),
(13, '2018-10-24', 1, 52, 1, 'Mañana', 54, 'Madrina', 'Ninguna', 'Activo', 'No Definida'),
(14, '2018-10-24', 1, 49, 1, 'Mañana', 55, 'Cuñado(a)', 'Ninguna', 'Activo', 'No Definida'),
(15, '2018-10-24', 1, 46, 1, 'Mañana', 58, 'Cuñado(a)', 'Ninguna', 'Activo', 'No Definida'),
(16, '2018-10-24', 1, 44, 1, 'Mañana', 55, 'Madre', 'Ninguna\r\n', 'Activo', 'No Definida'),
(17, '2018-10-24', 1, 41, 1, 'Mañana', 57, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(18, '2018-10-24', 1, 39, 1, 'Mañana', 55, 'Madrina', 'Ninguna', 'Activo', 'No Definida'),
(19, '2018-10-24', 1, 36, 1, 'Mañana', 55, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(20, '2018-10-24', 1, 11, 2, 'Mañana', 56, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(21, '2018-10-24', 1, 13, 2, 'Mañana', 58, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(22, '2018-10-24', 1, 15, 2, 'Mañana', 58, 'Madre', 'Ninguna', 'Activo', 'No Definida'),
(23, '2018-10-24', 1, 18, 2, 'Mañana', 58, 'Madrina', 'Ninguna', 'Activo', 'No Definida'),
(24, '2018-10-24', 1, 20, 2, 'Mañana', 57, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(25, '2018-10-24', 1, 22, 2, 'Mañana', 58, 'Madre', 'Ninguna', 'Activo', 'No Definida'),
(26, '2018-10-24', 1, 24, 2, 'Mañana', 53, 'Abuelo(a)', 'Ninguna\r\n', 'Activo', 'No Definida'),
(27, '2018-10-24', 1, 26, 2, 'Mañana', 58, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(28, '2018-10-24', 1, 28, 2, 'Mañana', 58, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(29, '2018-10-24', 1, 29, 2, 'Mañana', 58, 'Madrina', 'Ninguna', 'Activo', 'No Definida'),
(30, '2018-10-24', 1, 30, 2, 'Mañana', 58, 'Tio(a)', 'Ninguna', 'Activo', 'No Definida'),
(31, '2018-11-04', 1, 59, 3, 'Mañana', 53, 'Tio(a)', '..', 'Activo', 'No Definida'),
(32, '2018-11-04', 1, 65, 3, 'Mañana', 56, 'Tio(a)', '..', 'Activo', 'No Definida'),
(33, '2018-11-04', 1, 67, 3, 'Mañana', 54, 'Tio(a)', '...', 'Activo', 'No Definida'),
(34, '2018-11-04', 1, 69, 3, 'Mañana', 55, 'Primo(a)', '...', 'Activo', 'No Definida'),
(35, '2018-11-04', 1, 70, 3, 'Mañana', 57, 'Tio(a)', '...', 'Activo', 'No Definida'),
(36, '2018-11-04', 1, 72, 3, 'Mañana', 55, 'Tio(a)', '...', 'Activo', 'No Definida'),
(37, '2018-11-04', 1, 73, 3, 'Mañana', 54, 'Tio(a)', '...', 'Activo', 'No Definida'),
(38, '2018-11-04', 1, 75, 3, 'Mañana', 56, 'Tio(a)', '...', 'Activo', 'No Definida'),
(39, '2018-11-04', 1, 77, 3, 'Mañana', 55, 'Hermano(a)', '...', 'Activo', 'No Definida'),
(40, '2018-11-04', 1, 78, 3, 'Mañana', 56, 'Tio(a)', '...', 'Activo', 'No Definida'),
(41, '2018-11-04', 1, 79, 3, 'Mañana', 53, 'Tio(a)', '....', 'Activo', 'No Definida'),
(42, '2018-11-04', 1, 80, 3, 'Mañana', 58, 'Tio(a)', '...', 'Activo', 'No Definida'),
(43, '2018-11-04', 1, 81, 3, 'Mañana', 56, 'Tio(a)', '....', 'Activo', 'No Definida'),
(44, '2018-11-04', 1, 83, 3, 'Mañana', 56, 'Tio(a)', '...', 'Activo', 'No Definida'),
(45, '2018-11-04', 1, 85, 3, 'Mañana', 56, 'Primo(a)', '...', 'Activo', 'No Definida'),
(46, '2018-11-04', 1, 87, 3, 'Mañana', 57, 'Tio(a)', '...', 'Activo', 'No Definida'),
(47, '2018-11-04', 1, 89, 3, 'Mañana', 55, 'Primo(a)', '..', 'Activo', 'No Definida'),
(48, '2018-11-04', 1, 91, 3, 'Mañana', 55, 'Tio(a)', '...', 'Activo', 'No Definida'),
(49, '2018-11-04', 1, 93, 3, 'Mañana', 53, 'Tio(a)', '....', 'Activo', 'No Definida'),
(50, '2018-11-04', 1, 95, 3, 'Mañana', 54, 'Primo(a)', '...', 'Activo', 'No Definida'),
(51, '2018-11-04', 1, 60, 4, 'Mañana', 56, 'Tio(a)', '...', 'Activo', 'No Definida'),
(52, '2018-11-04', 1, 61, 4, 'Mañana', 56, 'Madre', '...', 'Activo', 'No Definida'),
(53, '2018-11-04', 1, 62, 4, 'Mañana', 58, 'Tio(a)', '..', 'Activo', 'No Definida'),
(54, '2018-11-04', 1, 63, 4, 'Mañana', 57, 'Tio(a)', '...', 'Activo', 'No Definida'),
(55, '2018-11-04', 1, 64, 4, 'Mañana', 54, 'Madrina', '....', 'Activo', 'No Definida'),
(56, '2018-11-04', 1, 66, 4, 'Mañana', 58, 'Primo(a)', '...', 'Activo', 'No Definida'),
(57, '2018-11-04', 1, 68, 4, 'Mañana', 54, 'Primo(a)', '...', 'Activo', 'No Definida'),
(58, '2018-11-04', 1, 71, 4, 'Mañana', 53, 'Tio(a)', '...', 'Activo', 'No Definida'),
(59, '2018-11-04', 1, 74, 4, 'Mañana', 53, 'Padrino', '...', 'Activo', 'No Definida'),
(60, '2018-11-04', 1, 76, 4, 'Mañana', 57, 'Tio(a)', '...', 'Activo', 'No Definida'),
(61, '2018-11-04', 1, 82, 4, 'Mañana', 54, 'Tio(a)', '...', 'Activo', 'No Definida'),
(62, '2018-11-04', 1, 84, 4, 'Mañana', 55, 'Primo(a)', '...', 'Activo', 'No Definida'),
(63, '2018-11-04', 1, 86, 4, 'Mañana', 54, 'Primo(a)', '...', 'Activo', 'No Definida'),
(64, '2018-11-04', 1, 88, 4, 'Mañana', 57, 'Tio(a)', '..', 'Activo', 'No Definida'),
(65, '2018-11-04', 1, 90, 4, 'Mañana', 54, 'Tio(a)', '...', 'Activo', 'No Definida'),
(66, '2018-11-04', 1, 92, 4, 'Mañana', 53, 'Tio(a)', '...', 'Activo', 'No Definida'),
(67, '2018-11-04', 1, 94, 4, 'Mañana', 58, 'Tio(a)', '...', 'Activo', 'No Definida'),
(68, '2018-11-04', 1, 96, 4, 'Mañana', 53, 'Tio(a)', '...', 'Activo', 'No Definida'),
(69, '2018-11-04', 1, 97, 4, 'Mañana', 54, 'Madrina', '...', 'Activo', 'No Definida'),
(71, '2018-11-04', 1, 99, 4, 'Mañana', 55, 'Primo(a)', '...', 'Activo', 'No Definida'),
(72, '2018-11-04', 1, 100, 4, 'Mañana', 58, 'Tio(a)', '...', 'Activo', 'No Definida'),
(73, '2018-11-04', 1, 101, 4, 'Mañana', 54, 'Padrino', '...', 'Activo', 'No Definida'),
(74, '2018-11-04', 1, 98, 4, 'Mañana', 55, 'Primo(a)', '...', 'Activo', 'No Definida');

--
-- Disparadores `matriculas`
--
DELIMITER $$
CREATE TRIGGER `denegar_acceso_usuario` AFTER DELETE ON `matriculas` FOR EACH ROW begin
UPDATE usuarios set acceso="0" where id_persona=old.id_estudiante;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `permitir_acceso_usuario` AFTER INSERT ON `matriculas` FOR EACH ROW begin
UPDATE usuarios set acceso="1" where id_persona=new.id_estudiante;
UPDATE usuarios set acceso="1" where id_persona=new.id_acudiente and id_rol="4";
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL,
  `nombre_municipio` varchar(45) NOT NULL,
  `id_departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municipio`, `nombre_municipio`, `id_departamento`) VALUES
(1, 'MEDELLIN', 5),
(2, 'ABEJORRAL', 5),
(3, 'ABRIAQUI', 5),
(4, 'ALEJANDRIA', 5),
(5, 'AMAGA', 5),
(6, 'AMALFI', 5),
(7, 'ANDES', 5),
(8, 'ANGELOPOLIS', 5),
(9, 'ANGOSTURA', 5),
(10, 'ANORI', 5),
(11, 'SANTAFE DE ANTIOQUIA', 5),
(12, 'ANZA', 5),
(13, 'APARTADO', 5),
(14, 'ARBOLETES', 5),
(15, 'ARGELIA', 5),
(16, 'ARMENIA', 5),
(17, 'BARBOSA', 5),
(18, 'BELMIRA', 5),
(19, 'BELLO', 5),
(20, 'BETANIA', 5),
(21, 'BETULIA', 5),
(22, 'CIUDAD BOLIVAR', 5),
(23, 'BRICEÑO', 5),
(24, 'BURITICA', 5),
(25, 'CACERES', 5),
(26, 'CAICEDO', 5),
(27, 'CALDAS', 5),
(28, 'CAMPAMENTO', 5),
(29, 'CAÑASGORDAS', 5),
(30, 'CARACOLI', 5),
(31, 'CARAMANTA', 5),
(32, 'CAREPA', 5),
(33, 'EL CARMEN DE VIBORAL', 5),
(34, 'CAROLINA', 5),
(35, 'CAUCASIA', 5),
(36, 'CHIGORODO', 5),
(37, 'CISNEROS', 5),
(38, 'COCORNA', 5),
(39, 'CONCEPCION', 5),
(40, 'CONCORDIA', 5),
(41, 'COPACABANA', 5),
(42, 'DABEIBA', 5),
(43, 'DON MATIAS', 5),
(44, 'EBEJICO', 5),
(45, 'EL BAGRE', 5),
(46, 'ENTRERRIOS', 5),
(47, 'ENVIGADO', 5),
(48, 'FREDONIA', 5),
(49, 'FRONTINO', 5),
(50, 'GIRALDO', 5),
(51, 'GIRARDOTA', 5),
(52, 'GOMEZ PLATA', 5),
(53, 'GRANADA', 5),
(54, 'GUADALUPE', 5),
(55, 'GUARNE', 5),
(56, 'GUATAPE', 5),
(57, 'HELICONIA', 5),
(58, 'HISPANIA', 5),
(59, 'ITAGUI', 5),
(60, 'ITUANGO', 5),
(61, 'JARDIN', 5),
(62, 'JERICO', 5),
(63, 'LA CEJA', 5),
(64, 'LA ESTRELLA', 5),
(65, 'LA PINTADA', 5),
(66, 'LA UNION', 5),
(67, 'LIBORINA', 5),
(68, 'MACEO', 5),
(69, 'MARINILLA', 5),
(70, 'MONTEBELLO', 5),
(71, 'MURINDO', 5),
(72, 'MUTATA', 5),
(73, 'NARIÑO', 5),
(74, 'NECOCLI', 5),
(75, 'NECHI', 5),
(76, 'OLAYA', 5),
(77, 'PEÐOL', 5),
(78, 'PEQUE', 5),
(79, 'PUEBLORRICO', 5),
(80, 'PUERTO BERRIO', 5),
(81, 'PUERTO NARE', 5),
(82, 'PUERTO TRIUNFO', 5),
(83, 'REMEDIOS', 5),
(84, 'RETIRO', 5),
(85, 'RIONEGRO', 5),
(86, 'SABANALARGA', 5),
(87, 'SABANETA', 5),
(88, 'SALGAR', 5),
(89, 'SAN ANDRES DE CUERQUIA', 5),
(90, 'SAN CARLOS', 5),
(91, 'SAN FRANCISCO', 5),
(92, 'SAN JERONIMO', 5),
(93, 'SAN JOSE DE LA MONTAÑA', 5),
(94, 'SAN JUAN DE URABA', 5),
(95, 'SAN LUIS', 5),
(96, 'SAN PEDRO', 5),
(97, 'SAN PEDRO DE URABA', 5),
(98, 'SAN RAFAEL', 5),
(99, 'SAN ROQUE', 5),
(100, 'SAN VICENTE', 5),
(101, 'SANTA BARBARA', 5),
(102, 'SANTA ROSA DE OSOS', 5),
(103, 'SANTO DOMINGO', 5),
(104, 'EL SANTUARIO', 5),
(105, 'SEGOVIA', 5),
(106, 'SONSON', 5),
(107, 'SOPETRAN', 5),
(108, 'TAMESIS', 5),
(109, 'TARAZA', 5),
(110, 'TARSO', 5),
(111, 'TITIRIBI', 5),
(112, 'TOLEDO', 5),
(113, 'TURBO', 5),
(114, 'URAMITA', 5),
(115, 'URRAO', 5),
(116, 'VALDIVIA', 5),
(117, 'VALPARAISO', 5),
(118, 'VEGACHI', 5),
(119, 'VENECIA', 5),
(120, 'VIGIA DEL FUERTE', 5),
(121, 'YALI', 5),
(122, 'YARUMAL', 5),
(123, 'YOLOMBO', 5),
(124, 'YONDO', 5),
(125, 'ZARAGOZA', 5),
(126, 'BARRANQUILLA', 8),
(127, 'BARANOA', 8),
(128, 'CAMPO DE LA CRUZ', 8),
(129, 'CANDELARIA', 8),
(130, 'GALAPA', 8),
(131, 'JUAN DE ACOSTA', 8),
(132, 'LURUACO', 8),
(133, 'MALAMBO', 8),
(134, 'MANATI', 8),
(135, 'PALMAR DE VARELA', 8),
(136, 'PIOJO', 8),
(137, 'POLONUEVO', 8),
(138, 'PONEDERA', 8),
(139, 'PUERTO COLOMBIA', 8),
(140, 'REPELON', 8),
(141, 'SABANAGRANDE', 8),
(142, 'SABANALARGA', 8),
(143, 'SANTA LUCIA', 8),
(144, 'SANTO TOMAS', 8),
(145, 'SOLEDAD', 8),
(146, 'SUAN', 8),
(147, 'TUBARA', 8),
(148, 'USIACURI', 8),
(149, 'BOGOTA, D.C.', 11),
(150, 'CARTAGENA', 13),
(151, 'ACHI', 13),
(152, 'ALTOS DEL ROSARIO', 13),
(153, 'ARENAL', 13),
(154, 'ARJONA', 13),
(155, 'ARROYOHONDO', 13),
(156, 'BARRANCO DE LOBA', 13),
(157, 'CALAMAR', 13),
(158, 'CANTAGALLO', 13),
(159, 'CICUCO', 13),
(160, 'CORDOBA', 13),
(161, 'CLEMENCIA', 13),
(162, 'EL CARMEN DE BOLIVAR', 13),
(163, 'EL GUAMO', 13),
(164, 'EL PEÑON', 13),
(165, 'HATILLO DE LOBA', 13),
(166, 'MAGANGUE', 13),
(167, 'MAHATES', 13),
(168, 'MARGARITA', 13),
(169, 'MARIA LA BAJA', 13),
(170, 'MONTECRISTO', 13),
(171, 'MOMPOS', 13),
(172, 'NOROSI', 13),
(173, 'MORALES', 13),
(174, 'PINILLOS', 13),
(175, 'REGIDOR', 13),
(176, 'RIO VIEJO', 13),
(177, 'SAN CRISTOBAL', 13),
(178, 'SAN ESTANISLAO', 13),
(179, 'SAN FERNANDO', 13),
(180, 'SAN JACINTO', 13),
(181, 'SAN JACINTO DEL CAUCA', 13),
(182, 'SAN JUAN NEPOMUCENO', 13),
(183, 'SAN MARTIN DE LOBA', 13),
(184, 'SAN PABLO', 13),
(185, 'SANTA CATALINA', 13),
(186, 'SANTA ROSA', 13),
(187, 'SANTA ROSA DEL SUR', 13),
(188, 'SIMITI', 13),
(189, 'SOPLAVIENTO', 13),
(190, 'TALAIGUA NUEVO', 13),
(191, 'TIQUISIO', 13),
(192, 'TURBACO', 13),
(193, 'TURBANA', 13),
(194, 'VILLANUEVA', 13),
(195, 'ZAMBRANO', 13),
(196, 'TUNJA', 15),
(197, 'ALMEIDA', 15),
(198, 'AQUITANIA', 15),
(199, 'ARCABUCO', 15),
(200, 'BELEN', 15),
(201, 'BERBEO', 15),
(202, 'BETEITIVA', 15),
(203, 'BOAVITA', 15),
(204, 'BOYACA', 15),
(205, 'BRICEÑO', 15),
(206, 'BUENAVISTA', 15),
(207, 'BUSBANZA', 15),
(208, 'CALDAS', 15),
(209, 'CAMPOHERMOSO', 15),
(210, 'CERINZA', 15),
(211, 'CHINAVITA', 15),
(212, 'CHIQUINQUIRA', 15),
(213, 'CHISCAS', 15),
(214, 'CHITA', 15),
(215, 'CHITARAQUE', 15),
(216, 'CHIVATA', 15),
(217, 'CIENEGA', 15),
(218, 'COMBITA', 15),
(219, 'COPER', 15),
(220, 'CORRALES', 15),
(221, 'COVARACHIA', 15),
(222, 'CUBARA', 15),
(223, 'CUCAITA', 15),
(224, 'CUITIVA', 15),
(225, 'CHIQUIZA', 15),
(226, 'CHIVOR', 15),
(227, 'DUITAMA', 15),
(228, 'EL COCUY', 15),
(229, 'EL ESPINO', 15),
(230, 'FIRAVITOBA', 15),
(231, 'FLORESTA', 15),
(232, 'GACHANTIVA', 15),
(233, 'GAMEZA', 15),
(234, 'GARAGOA', 15),
(235, 'GUACAMAYAS', 15),
(236, 'GUATEQUE', 15),
(237, 'GUAYATA', 15),
(238, 'GsICAN', 15),
(239, 'IZA', 15),
(240, 'JENESANO', 15),
(241, 'JERICO', 15),
(242, 'LABRANZAGRANDE', 15),
(243, 'LA CAPILLA', 15),
(244, 'LA VICTORIA', 15),
(245, 'LA UVITA', 15),
(246, 'VILLA DE LEYVA', 15),
(247, 'MACANAL', 15),
(248, 'MARIPI', 15),
(249, 'MIRAFLORES', 15),
(250, 'MONGUA', 15),
(251, 'MONGUI', 15),
(252, 'MONIQUIRA', 15),
(253, 'MOTAVITA', 15),
(254, 'MUZO', 15),
(255, 'NOBSA', 15),
(256, 'NUEVO COLON', 15),
(257, 'OICATA', 15),
(258, 'OTANCHE', 15),
(259, 'PACHAVITA', 15),
(260, 'PAEZ', 15),
(261, 'PAIPA', 15),
(262, 'PAJARITO', 15),
(263, 'PANQUEBA', 15),
(264, 'PAUNA', 15),
(265, 'PAYA', 15),
(266, 'PAZ DE RIO', 15),
(267, 'PESCA', 15),
(268, 'PISBA', 15),
(269, 'PUERTO BOYACA', 15),
(270, 'QUIPAMA', 15),
(271, 'RAMIRIQUI', 15),
(272, 'RAQUIRA', 15),
(273, 'RONDON', 15),
(274, 'SABOYA', 15),
(275, 'SACHICA', 15),
(276, 'SAMACA', 15),
(277, 'SAN EDUARDO', 15),
(278, 'SAN JOSE DE PARE', 15),
(279, 'SAN LUIS DE GACENO', 15),
(280, 'SAN MATEO', 15),
(281, 'SAN MIGUEL DE SEMA', 15),
(282, 'SAN PABLO DE BORBUR', 15),
(283, 'SANTANA', 15),
(284, 'SANTA MARIA', 15),
(285, 'SANTA ROSA DE VITERBO', 15),
(286, 'SANTA SOFIA', 15),
(287, 'SATIVANORTE', 15),
(288, 'SATIVASUR', 15),
(289, 'SIACHOQUE', 15),
(290, 'SOATA', 15),
(291, 'SOCOTA', 15),
(292, 'SOCHA', 15),
(293, 'SOGAMOSO', 15),
(294, 'SOMONDOCO', 15),
(295, 'SORA', 15),
(296, 'SOTAQUIRA', 15),
(297, 'SORACA', 15),
(298, 'SUSACON', 15),
(299, 'SUTAMARCHAN', 15),
(300, 'SUTATENZA', 15),
(301, 'TASCO', 15),
(302, 'TENZA', 15),
(303, 'TIBANA', 15),
(304, 'TIBASOSA', 15),
(305, 'TINJACA', 15),
(306, 'TIPACOQUE', 15),
(307, 'TOCA', 15),
(308, 'TOGsI', 15),
(309, 'TOPAGA', 15),
(310, 'TOTA', 15),
(311, 'TUNUNGUA', 15),
(312, 'TURMEQUE', 15),
(313, 'TUTA', 15),
(314, 'TUTAZA', 15),
(315, 'UMBITA', 15),
(316, 'VENTAQUEMADA', 15),
(317, 'VIRACACHA', 15),
(318, 'ZETAQUIRA', 15),
(319, 'MANIZALES', 17),
(320, 'AGUADAS', 17),
(321, 'ANSERMA', 17),
(322, 'ARANZAZU', 17),
(323, 'BELALCAZAR', 17),
(324, 'CHINCHINA', 17),
(325, 'FILADELFIA', 17),
(326, 'LA DORADA', 17),
(327, 'LA MERCED', 17),
(328, 'MANZANARES', 17),
(329, 'MARMATO', 17),
(330, 'MARQUETALIA', 17),
(331, 'MARULANDA', 17),
(332, 'NEIRA', 17),
(333, 'NORCASIA', 17),
(334, 'PACORA', 17),
(335, 'PALESTINA', 17),
(336, 'PENSILVANIA', 17),
(337, 'RIOSUCIO', 17),
(338, 'RISARALDA', 17),
(339, 'SALAMINA', 17),
(340, 'SAMANA', 17),
(341, 'SAN JOSE', 17),
(342, 'SUPIA', 17),
(343, 'VICTORIA', 17),
(344, 'VILLAMARIA', 17),
(345, 'VITERBO', 17),
(346, 'FLORENCIA', 18),
(347, 'ALBANIA', 18),
(348, 'BELEN DE LOS ANDAQUIES', 18),
(349, 'CARTAGENA DEL CHAIRA', 18),
(350, 'CURILLO', 18),
(351, 'EL DONCELLO', 18),
(352, 'EL PAUJIL', 18),
(353, 'LA MONTAÑITA', 18),
(354, 'MILAN', 18),
(355, 'MORELIA', 18),
(356, 'PUERTO RICO', 18),
(357, 'SAN JOSE DEL FRAGUA', 18),
(358, 'SAN VICENTE DEL CAGUAN', 18),
(359, 'SOLANO', 18),
(360, 'SOLITA', 18),
(361, 'VALPARAISO', 18),
(362, 'POPAYAN', 19),
(363, 'ALMAGUER', 19),
(364, 'ARGELIA', 19),
(365, 'BALBOA', 19),
(366, 'BOLIVAR', 19),
(367, 'BUENOS AIRES', 19),
(368, 'CAJIBIO', 19),
(369, 'CALDONO', 19),
(370, 'CALOTO', 19),
(371, 'CORINTO', 19),
(372, 'EL TAMBO', 19),
(373, 'FLORENCIA', 19),
(374, 'GUACHENE', 19),
(375, 'GUAPI', 19),
(376, 'INZA', 19),
(377, 'JAMBALO', 19),
(378, 'LA SIERRA', 19),
(379, 'LA VEGA', 19),
(380, 'LOPEZ', 19),
(381, 'MERCADERES', 19),
(382, 'MIRANDA', 19),
(383, 'MORALES', 19),
(384, 'PADILLA', 19),
(385, 'PAEZ', 19),
(386, 'PATIA', 19),
(387, 'PIAMONTE', 19),
(388, 'PIENDAMO', 19),
(389, 'PUERTO TEJADA', 19),
(390, 'PURACE', 19),
(391, 'ROSAS', 19),
(392, 'SAN SEBASTIAN', 19),
(393, 'SANTANDER DE QUILICHAO', 19),
(394, 'SANTA ROSA', 19),
(395, 'SILVIA', 19),
(396, 'SOTARA', 19),
(397, 'SUAREZ', 19),
(398, 'SUCRE', 19),
(399, 'TIMBIO', 19),
(400, 'TIMBIQUI', 19),
(401, 'TORIBIO', 19),
(402, 'TOTORO', 19),
(403, 'VILLA RICA', 19),
(404, 'VALLEDUPAR', 20),
(405, 'AGUACHICA', 20),
(406, 'AGUSTIN CODAZZI', 20),
(407, 'ASTREA', 20),
(408, 'BECERRIL', 20),
(409, 'BOSCONIA', 20),
(410, 'CHIMICHAGUA', 20),
(411, 'CHIRIGUANA', 20),
(412, 'CURUMANI', 20),
(413, 'EL COPEY', 20),
(414, 'EL PASO', 20),
(415, 'GAMARRA', 20),
(416, 'GONZALEZ', 20),
(417, 'LA GLORIA', 20),
(418, 'LA JAGUA DE IBIRICO', 20),
(419, 'MANAURE', 20),
(420, 'PAILITAS', 20),
(421, 'PELAYA', 20),
(422, 'PUEBLO BELLO', 20),
(423, 'RIO DE ORO', 20),
(424, 'LA PAZ', 20),
(425, 'SAN ALBERTO', 20),
(426, 'SAN DIEGO', 20),
(427, 'SAN MARTIN', 20),
(428, 'TAMALAMEQUE', 20),
(429, 'MONTERIA', 23),
(430, 'AYAPEL', 23),
(431, 'BUENAVISTA', 23),
(432, 'CANALETE', 23),
(433, 'CERETE', 23),
(434, 'CHIMA', 23),
(435, 'CHINU', 23),
(436, 'CIENAGA DE ORO', 23),
(437, 'COTORRA', 23),
(438, 'LA APARTADA', 23),
(439, 'LORICA', 23),
(440, 'LOS CORDOBAS', 23),
(441, 'MOMIL', 23),
(442, 'MONTELIBANO', 23),
(443, 'MOÑITOS', 23),
(444, 'PLANETA RICA', 23),
(445, 'PUEBLO NUEVO', 23),
(446, 'PUERTO ESCONDIDO', 23),
(447, 'PUERTO LIBERTADOR', 23),
(448, 'PURISIMA', 23),
(449, 'SAHAGUN', 23),
(450, 'SAN ANDRES SOTAVENTO', 23),
(451, 'SAN ANTERO', 23),
(452, 'SAN BERNARDO DEL VIENTO', 23),
(453, 'SAN CARLOS', 23),
(454, 'SAN PELAYO', 23),
(455, 'TIERRALTA', 23),
(456, 'VALENCIA', 23),
(457, 'AGUA DE DIOS', 25),
(458, 'ALBAN', 25),
(459, 'ANAPOIMA', 25),
(460, 'ANOLAIMA', 25),
(461, 'ARBELAEZ', 25),
(462, 'BELTRAN', 25),
(463, 'BITUIMA', 25),
(464, 'BOJACA', 25),
(465, 'CABRERA', 25),
(466, 'CACHIPAY', 25),
(467, 'CAJICA', 25),
(468, 'CAPARRAPI', 25),
(469, 'CAQUEZA', 25),
(470, 'CARMEN DE CARUPA', 25),
(471, 'CHAGUANI', 25),
(472, 'CHIA', 25),
(473, 'CHIPAQUE', 25),
(474, 'CHOACHI', 25),
(475, 'CHOCONTA', 25),
(476, 'COGUA', 25),
(477, 'COTA', 25),
(478, 'CUCUNUBA', 25),
(479, 'EL COLEGIO', 25),
(480, 'EL PEÑON', 25),
(481, 'EL ROSAL', 25),
(482, 'FACATATIVA', 25),
(483, 'FOMEQUE', 25),
(484, 'FOSCA', 25),
(485, 'FUNZA', 25),
(486, 'FUQUENE', 25),
(487, 'FUSAGASUGA', 25),
(488, 'GACHALA', 25),
(489, 'GACHANCIPA', 25),
(490, 'GACHETA', 25),
(491, 'GAMA', 25),
(492, 'GIRARDOT', 25),
(493, 'GRANADA', 25),
(494, 'GUACHETA', 25),
(495, 'GUADUAS', 25),
(496, 'GUASCA', 25),
(497, 'GUATAQUI', 25),
(498, 'GUATAVITA', 25),
(499, 'GUAYABAL DE SIQUIMA', 25),
(500, 'GUAYABETAL', 25),
(501, 'GUTIERREZ', 25),
(502, 'JERUSALEN', 25),
(503, 'JUNIN', 25),
(504, 'LA CALERA', 25),
(505, 'LA MESA', 25),
(506, 'LA PALMA', 25),
(507, 'LA PEÑA', 25),
(508, 'LA VEGA', 25),
(509, 'LENGUAZAQUE', 25),
(510, 'MACHETA', 25),
(511, 'MADRID', 25),
(512, 'MANTA', 25),
(513, 'MEDINA', 25),
(514, 'MOSQUERA', 25),
(515, 'NARIÑO', 25),
(516, 'NEMOCON', 25),
(517, 'NILO', 25),
(518, 'NIMAIMA', 25),
(519, 'NOCAIMA', 25),
(520, 'VENECIA', 25),
(521, 'PACHO', 25),
(522, 'PAIME', 25),
(523, 'PANDI', 25),
(524, 'PARATEBUENO', 25),
(525, 'PASCA', 25),
(526, 'PUERTO SALGAR', 25),
(527, 'PULI', 25),
(528, 'QUEBRADANEGRA', 25),
(529, 'QUETAME', 25),
(530, 'QUIPILE', 25),
(531, 'APULO', 25),
(532, 'RICAURTE', 25),
(533, 'SAN ANTONIO DEL TEQUENDAMA', 25),
(534, 'SAN BERNARDO', 25),
(535, 'SAN CAYETANO', 25),
(536, 'SAN FRANCISCO', 25),
(537, 'SAN JUAN DE RIO SECO', 25),
(538, 'SASAIMA', 25),
(539, 'SESQUILE', 25),
(540, 'SIBATE', 25),
(541, 'SILVANIA', 25),
(542, 'SIMIJACA', 25),
(543, 'SOACHA', 25),
(544, 'SOPO', 25),
(545, 'SUBACHOQUE', 25),
(546, 'SUESCA', 25),
(547, 'SUPATA', 25),
(548, 'SUSA', 25),
(549, 'SUTATAUSA', 25),
(550, 'TABIO', 25),
(551, 'TAUSA', 25),
(552, 'TENA', 25),
(553, 'TENJO', 25),
(554, 'TIBACUY', 25),
(555, 'TIBIRITA', 25),
(556, 'TOCAIMA', 25),
(557, 'TOCANCIPA', 25),
(558, 'TOPAIPI', 25),
(559, 'UBALA', 25),
(560, 'UBAQUE', 25),
(561, 'VILLA DE SAN DIEGO DE UBATE', 25),
(562, 'UNE', 25),
(563, 'UTICA', 25),
(564, 'VERGARA', 25),
(565, 'VIANI', 25),
(566, 'VILLAGOMEZ', 25),
(567, 'VILLAPINZON', 25),
(568, 'VILLETA', 25),
(569, 'VIOTA', 25),
(570, 'YACOPI', 25),
(571, 'ZIPACON', 25),
(572, 'ZIPAQUIRA', 25),
(573, 'QUIBDO', 27),
(574, 'ACANDI', 27),
(575, 'ALTO BAUDO', 27),
(576, 'ATRATO', 27),
(577, 'BAGADO', 27),
(578, 'BAHIA SOLANO', 27),
(579, 'BAJO BAUDO', 27),
(580, 'BOJAYA', 27),
(581, 'EL CANTON DEL SAN PABLO', 27),
(582, 'CARMEN DEL DARIEN', 27),
(583, 'CERTEGUI', 27),
(584, 'CONDOTO', 27),
(585, 'EL CARMEN DE ATRATO', 27),
(586, 'EL LITORAL DEL SAN JUAN', 27),
(587, 'ISTMINA', 27),
(588, 'JURADO', 27),
(589, 'LLORO', 27),
(590, 'MEDIO ATRATO', 27),
(591, 'MEDIO BAUDO', 27),
(592, 'MEDIO SAN JUAN', 27),
(593, 'NOVITA', 27),
(594, 'NUQUI', 27),
(595, 'RIO IRO', 27),
(596, 'RIO QUITO', 27),
(597, 'RIOSUCIO', 27),
(598, 'SAN JOSE DEL PALMAR', 27),
(599, 'SIPI', 27),
(600, 'TADO', 27),
(601, 'UNGUIA', 27),
(602, 'UNION PANAMERICANA', 27),
(603, 'NEIVA', 41),
(604, 'ACEVEDO', 41),
(605, 'AGRADO', 41),
(606, 'AIPE', 41),
(607, 'ALGECIRAS', 41),
(608, 'ALTAMIRA', 41),
(609, 'BARAYA', 41),
(610, 'CAMPOALEGRE', 41),
(611, 'COLOMBIA', 41),
(612, 'ELIAS', 41),
(613, 'GARZON', 41),
(614, 'GIGANTE', 41),
(615, 'GUADALUPE', 41),
(616, 'HOBO', 41),
(617, 'IQUIRA', 41),
(618, 'ISNOS', 41),
(619, 'LA ARGENTINA', 41),
(620, 'LA PLATA', 41),
(621, 'NATAGA', 41),
(622, 'OPORAPA', 41),
(623, 'PAICOL', 41),
(624, 'PALERMO', 41),
(625, 'PALESTINA', 41),
(626, 'PITAL', 41),
(627, 'PITALITO', 41),
(628, 'RIVERA', 41),
(629, 'SALADOBLANCO', 41),
(630, 'SAN AGUSTIN', 41),
(631, 'SANTA MARIA', 41),
(632, 'SUAZA', 41),
(633, 'TARQUI', 41),
(634, 'TESALIA', 41),
(635, 'TELLO', 41),
(636, 'TERUEL', 41),
(637, 'TIMANA', 41),
(638, 'VILLAVIEJA', 41),
(639, 'YAGUARA', 41),
(640, 'RIOHACHA', 44),
(641, 'ALBANIA', 44),
(642, 'BARRANCAS', 44),
(643, 'DIBULLA', 44),
(644, 'DISTRACCION', 44),
(645, 'EL MOLINO', 44),
(646, 'FONSECA', 44),
(647, 'HATONUEVO', 44),
(648, 'LA JAGUA DEL PILAR', 44),
(649, 'MAICAO', 44),
(650, 'MANAURE', 44),
(651, 'SAN JUAN DEL CESAR', 44),
(652, 'URIBIA', 44),
(653, 'URUMITA', 44),
(654, 'VILLANUEVA', 44),
(655, 'SANTA MARTA', 47),
(656, 'ALGARROBO', 47),
(657, 'ARACATACA', 47),
(658, 'ARIGUANI', 47),
(659, 'CERRO SAN ANTONIO', 47),
(660, 'CHIBOLO', 47),
(661, 'CIENAGA', 47),
(662, 'CONCORDIA', 47),
(663, 'EL BANCO', 47),
(664, 'EL PIÑON', 47),
(665, 'EL RETEN', 47),
(666, 'FUNDACION', 47),
(667, 'GUAMAL', 47),
(668, 'NUEVA GRANADA', 47),
(669, 'PEDRAZA', 47),
(670, 'PIJIÑO DEL CARMEN', 47),
(671, 'PIVIJAY', 47),
(672, 'PLATO', 47),
(673, 'PUEBLOVIEJO', 47),
(674, 'REMOLINO', 47),
(675, 'SABANAS DE SAN ANGEL', 47),
(676, 'SALAMINA', 47),
(677, 'SAN SEBASTIAN DE BUENAVISTA', 47),
(678, 'SAN ZENON', 47),
(679, 'SANTA ANA', 47),
(680, 'SANTA BARBARA DE PINTO', 47),
(681, 'SITIONUEVO', 47),
(682, 'TENERIFE', 47),
(683, 'ZAPAYAN', 47),
(684, 'ZONA BANANERA', 47),
(685, 'VILLAVICENCIO', 50),
(686, 'ACACIAS', 50),
(687, 'BARRANCA DE UPIA', 50),
(688, 'CABUYARO', 50),
(689, 'CASTILLA LA NUEVA', 50),
(690, 'CUBARRAL', 50),
(691, 'CUMARAL', 50),
(692, 'EL CALVARIO', 50),
(693, 'EL CASTILLO', 50),
(694, 'EL DORADO', 50),
(695, 'FUENTE DE ORO', 50),
(696, 'GRANADA', 50),
(697, 'GUAMAL', 50),
(698, 'MAPIRIPAN', 50),
(699, 'MESETAS', 50),
(700, 'LA MACARENA', 50),
(701, 'URIBE', 50),
(702, 'LEJANIAS', 50),
(703, 'PUERTO CONCORDIA', 50),
(704, 'PUERTO GAITAN', 50),
(705, 'PUERTO LOPEZ', 50),
(706, 'PUERTO LLERAS', 50),
(707, 'PUERTO RICO', 50),
(708, 'RESTREPO', 50),
(709, 'SAN CARLOS DE GUAROA', 50),
(710, 'SAN JUAN DE ARAMA', 50),
(711, 'SAN JUANITO', 50),
(712, 'SAN MARTIN', 50),
(713, 'VISTAHERMOSA', 50),
(714, 'PASTO', 52),
(715, 'ALBAN', 52),
(716, 'ALDANA', 52),
(717, 'ANCUYA', 52),
(718, 'ARBOLEDA', 52),
(719, 'BARBACOAS', 52),
(720, 'BELEN', 52),
(721, 'BUESACO', 52),
(722, 'COLON', 52),
(723, 'CONSACA', 52),
(724, 'CONTADERO', 52),
(725, 'CORDOBA', 52),
(726, 'CUASPUD', 52),
(727, 'CUMBAL', 52),
(728, 'CUMBITARA', 52),
(729, 'CHACHAGsI', 52),
(730, 'EL CHARCO', 52),
(731, 'EL PEÑOL', 52),
(732, 'EL ROSARIO', 52),
(733, 'EL TABLON DE GOMEZ', 52),
(734, 'EL TAMBO', 52),
(735, 'FUNES', 52),
(736, 'GUACHUCAL', 52),
(737, 'GUAITARILLA', 52),
(738, 'GUALMATAN', 52),
(739, 'ILES', 52),
(740, 'IMUES', 52),
(741, 'IPIALES', 52),
(742, 'LA CRUZ', 52),
(743, 'LA FLORIDA', 52),
(744, 'LA LLANADA', 52),
(745, 'LA TOLA', 52),
(746, 'LA UNION', 52),
(747, 'LEIVA', 52),
(748, 'LINARES', 52),
(749, 'LOS ANDES', 52),
(750, 'MAGsI', 52),
(751, 'MALLAMA', 52),
(752, 'MOSQUERA', 52),
(753, 'NARIÑO', 52),
(754, 'OLAYA HERRERA', 52),
(755, 'OSPINA', 52),
(756, 'FRANCISCO PIZARRO', 52),
(757, 'POLICARPA', 52),
(758, 'POTOSI', 52),
(759, 'PROVIDENCIA', 52),
(760, 'PUERRES', 52),
(761, 'PUPIALES', 52),
(762, 'RICAURTE', 52),
(763, 'ROBERTO PAYAN', 52),
(764, 'SAMANIEGO', 52),
(765, 'SANDONA', 52),
(766, 'SAN BERNARDO', 52),
(767, 'SAN LORENZO', 52),
(768, 'SAN PABLO', 52),
(769, 'SAN PEDRO DE CARTAGO', 52),
(770, 'SANTA BARBARA', 52),
(771, 'SANTACRUZ', 52),
(772, 'SAPUYES', 52),
(773, 'TAMINANGO', 52),
(774, 'TANGUA', 52),
(775, 'SAN ANDRES DE TUMACO', 52),
(776, 'TUQUERRES', 52),
(777, 'YACUANQUER', 52),
(778, 'CUCUTA', 54),
(779, 'ABREGO', 54),
(780, 'ARBOLEDAS', 54),
(781, 'BOCHALEMA', 54),
(782, 'BUCARASICA', 54),
(783, 'CACOTA', 54),
(784, 'CACHIRA', 54),
(785, 'CHINACOTA', 54),
(786, 'CHITAGA', 54),
(787, 'CONVENCION', 54),
(788, 'CUCUTILLA', 54),
(789, 'DURANIA', 54),
(790, 'EL CARMEN', 54),
(791, 'EL TARRA', 54),
(792, 'EL ZULIA', 54),
(793, 'GRAMALOTE', 54),
(794, 'HACARI', 54),
(795, 'HERRAN', 54),
(796, 'LABATECA', 54),
(797, 'LA ESPERANZA', 54),
(798, 'LA PLAYA', 54),
(799, 'LOS PATIOS', 54),
(800, 'LOURDES', 54),
(801, 'MUTISCUA', 54),
(802, 'OCAÑA', 54),
(803, 'PAMPLONA', 54),
(804, 'PAMPLONITA', 54),
(805, 'PUERTO SANTANDER', 54),
(806, 'RAGONVALIA', 54),
(807, 'SALAZAR', 54),
(808, 'SAN CALIXTO', 54),
(809, 'SAN CAYETANO', 54),
(810, 'SANTIAGO', 54),
(811, 'SARDINATA', 54),
(812, 'SILOS', 54),
(813, 'TEORAMA', 54),
(814, 'TIBU', 54),
(815, 'TOLEDO', 54),
(816, 'VILLA CARO', 54),
(817, 'VILLA DEL ROSARIO', 54),
(818, 'ARMENIA', 63),
(819, 'BUENAVISTA', 63),
(820, 'CALARCA', 63),
(821, 'CIRCASIA', 63),
(822, 'CORDOBA', 63),
(823, 'FILANDIA', 63),
(824, 'GENOVA', 63),
(825, 'LA TEBAIDA', 63),
(826, 'MONTENEGRO', 63),
(827, 'PIJAO', 63),
(828, 'QUIMBAYA', 63),
(829, 'SALENTO', 63),
(830, 'PEREIRA', 66),
(831, 'APIA', 66),
(832, 'BALBOA', 66),
(833, 'BELEN DE UMBRIA', 66),
(834, 'DOSQUEBRADAS', 66),
(835, 'GUATICA', 66),
(836, 'LA CELIA', 66),
(837, 'LA VIRGINIA', 66),
(838, 'MARSELLA', 66),
(839, 'MISTRATO', 66),
(840, 'PUEBLO RICO', 66),
(841, 'QUINCHIA', 66),
(842, 'SANTA ROSA DE CABAL', 66),
(843, 'SANTUARIO', 66),
(844, 'BUCARAMANGA', 68),
(845, 'AGUADA', 68),
(846, 'ALBANIA', 68),
(847, 'ARATOCA', 68),
(848, 'BARBOSA', 68),
(849, 'BARICHARA', 68),
(850, 'BARRANCABERMEJA', 68),
(851, 'BETULIA', 68),
(852, 'BOLIVAR', 68),
(853, 'CABRERA', 68),
(854, 'CALIFORNIA', 68),
(855, 'CAPITANEJO', 68),
(856, 'CARCASI', 68),
(857, 'CEPITA', 68),
(858, 'CERRITO', 68),
(859, 'CHARALA', 68),
(860, 'CHARTA', 68),
(861, 'CHIMA', 68),
(862, 'CHIPATA', 68),
(863, 'CIMITARRA', 68),
(864, 'CONCEPCION', 68),
(865, 'CONFINES', 68),
(866, 'CONTRATACION', 68),
(867, 'COROMORO', 68),
(868, 'CURITI', 68),
(869, 'EL CARMEN DE CHUCURI', 68),
(870, 'EL GUACAMAYO', 68),
(871, 'EL PEÑON', 68),
(872, 'EL PLAYON', 68),
(873, 'ENCINO', 68),
(874, 'ENCISO', 68),
(875, 'FLORIAN', 68),
(876, 'FLORIDABLANCA', 68),
(877, 'GALAN', 68),
(878, 'GAMBITA', 68),
(879, 'GIRON', 68),
(880, 'GUACA', 68),
(881, 'GUADALUPE', 68),
(882, 'GUAPOTA', 68),
(883, 'GUAVATA', 68),
(884, 'GsEPSA', 68),
(885, 'HATO', 68),
(886, 'JESUS MARIA', 68),
(887, 'JORDAN', 68),
(888, 'LA BELLEZA', 68),
(889, 'LANDAZURI', 68),
(890, 'LA PAZ', 68),
(891, 'LEBRIJA', 68),
(892, 'LOS SANTOS', 68),
(893, 'MACARAVITA', 68),
(894, 'MALAGA', 68),
(895, 'MATANZA', 68),
(896, 'MOGOTES', 68),
(897, 'MOLAGAVITA', 68),
(898, 'OCAMONTE', 68),
(899, 'OIBA', 68),
(900, 'ONZAGA', 68),
(901, 'PALMAR', 68),
(902, 'PALMAS DEL SOCORRO', 68),
(903, 'PARAMO', 68),
(904, 'PIEDECUESTA', 68),
(905, 'PINCHOTE', 68),
(906, 'PUENTE NACIONAL', 68),
(907, 'PUERTO PARRA', 68),
(908, 'PUERTO WILCHES', 68),
(909, 'RIONEGRO', 68),
(910, 'SABANA DE TORRES', 68),
(911, 'SAN ANDRES', 68),
(912, 'SAN BENITO', 68),
(913, 'SAN GIL', 68),
(914, 'SAN JOAQUIN', 68),
(915, 'SAN JOSE DE MIRANDA', 68),
(916, 'SAN MIGUEL', 68),
(917, 'SAN VICENTE DE CHUCURI', 68),
(918, 'SANTA BARBARA', 68),
(919, 'SANTA HELENA DEL OPON', 68),
(920, 'SIMACOTA', 68),
(921, 'SOCORRO', 68),
(922, 'SUAITA', 68),
(923, 'SUCRE', 68),
(924, 'SURATA', 68),
(925, 'TONA', 68),
(926, 'VALLE DE SAN JOSE', 68),
(927, 'VELEZ', 68),
(928, 'VETAS', 68),
(929, 'VILLANUEVA', 68),
(930, 'ZAPATOCA', 68),
(931, 'SINCELEJO', 70),
(932, 'BUENAVISTA', 70),
(933, 'CAIMITO', 70),
(934, 'COLOSO', 70),
(935, 'COROZAL', 70),
(936, 'COVEÑAS', 70),
(937, 'CHALAN', 70),
(938, 'EL ROBLE', 70),
(939, 'GALERAS', 70),
(940, 'GUARANDA', 70),
(941, 'LA UNION', 70),
(942, 'LOS PALMITOS', 70),
(943, 'MAJAGUAL', 70),
(944, 'MORROA', 70),
(945, 'OVEJAS', 70),
(946, 'PALMITO', 70),
(947, 'SAMPUES', 70),
(948, 'SAN BENITO ABAD', 70),
(949, 'SAN JUAN DE BETULIA', 70),
(950, 'SAN MARCOS', 70),
(951, 'SAN ONOFRE', 70),
(952, 'SAN PEDRO', 70),
(953, 'SAN LUIS DE SINCE', 70),
(954, 'SUCRE', 70),
(955, 'SANTIAGO DE TOLU', 70),
(956, 'TOLU VIEJO', 70),
(957, 'IBAGUE', 73),
(958, 'ALPUJARRA', 73),
(959, 'ALVARADO', 73),
(960, 'AMBALEMA', 73),
(961, 'ANZOATEGUI', 73),
(962, 'ARMERO', 73),
(963, 'ATACO', 73),
(964, 'CAJAMARCA', 73),
(965, 'CARMEN DE APICALA', 73),
(966, 'CASABIANCA', 73),
(967, 'CHAPARRAL', 73),
(968, 'COELLO', 73),
(969, 'COYAIMA', 73),
(970, 'CUNDAY', 73),
(971, 'DOLORES', 73),
(972, 'ESPINAL', 73),
(973, 'FALAN', 73),
(974, 'FLANDES', 73),
(975, 'FRESNO', 73),
(976, 'GUAMO', 73),
(977, 'HERVEO', 73),
(978, 'HONDA', 73),
(979, 'ICONONZO', 73),
(980, 'LERIDA', 73),
(981, 'LIBANO', 73),
(982, 'MARIQUITA', 73),
(983, 'MELGAR', 73),
(984, 'MURILLO', 73),
(985, 'NATAGAIMA', 73),
(986, 'ORTEGA', 73),
(987, 'PALOCABILDO', 73),
(988, 'PIEDRAS', 73),
(989, 'PLANADAS', 73),
(990, 'PRADO', 73),
(991, 'PURIFICACION', 73),
(992, 'RIOBLANCO', 73),
(993, 'RONCESVALLES', 73),
(994, 'ROVIRA', 73),
(995, 'SALDAÑA', 73),
(996, 'SAN ANTONIO', 73),
(997, 'SAN LUIS', 73),
(998, 'SANTA ISABEL', 73),
(999, 'SUAREZ', 73),
(1000, 'VALLE DE SAN JUAN', 73),
(1001, 'VENADILLO', 73),
(1002, 'VILLAHERMOSA', 73),
(1003, 'VILLARRICA', 73),
(1004, 'CALI', 76),
(1005, 'ALCALA', 76),
(1006, 'ANDALUCIA', 76),
(1007, 'ANSERMANUEVO', 76),
(1008, 'ARGELIA', 76),
(1009, 'BOLIVAR', 76),
(1010, 'BUENAVENTURA', 76),
(1011, 'GUADALAJARA DE BUGA', 76),
(1012, 'BUGALAGRANDE', 76),
(1013, 'CAICEDONIA', 76),
(1014, 'CALIMA', 76),
(1015, 'CANDELARIA', 76),
(1016, 'CARTAGO', 76),
(1017, 'DAGUA', 76),
(1018, 'EL AGUILA', 76),
(1019, 'EL CAIRO', 76),
(1020, 'EL CERRITO', 76),
(1021, 'EL DOVIO', 76),
(1022, 'FLORIDA', 76),
(1023, 'GINEBRA', 76),
(1024, 'GUACARI', 76),
(1025, 'JAMUNDI', 76),
(1026, 'LA CUMBRE', 76),
(1027, 'LA UNION', 76),
(1028, 'LA VICTORIA', 76),
(1029, 'OBANDO', 76),
(1030, 'PALMIRA', 76),
(1031, 'PRADERA', 76),
(1032, 'RESTREPO', 76),
(1033, 'RIOFRIO', 76),
(1034, 'ROLDANILLO', 76),
(1035, 'SAN PEDRO', 76),
(1036, 'SEVILLA', 76),
(1037, 'TORO', 76),
(1038, 'TRUJILLO', 76),
(1039, 'TULUA', 76),
(1040, 'ULLOA', 76),
(1041, 'VERSALLES', 76),
(1042, 'VIJES', 76),
(1043, 'YOTOCO', 76),
(1044, 'YUMBO', 76),
(1045, 'ZARZAL', 76),
(1046, 'ARAUCA', 81),
(1047, 'ARAUQUITA', 81),
(1048, 'CRAVO NORTE', 81),
(1049, 'FORTUL', 81),
(1050, 'PUERTO RONDON', 81),
(1051, 'SARAVENA', 81),
(1052, 'TAME', 81),
(1053, 'YOPAL', 85),
(1054, 'AGUAZUL', 85),
(1055, 'CHAMEZA', 85),
(1056, 'HATO COROZAL', 85),
(1057, 'LA SALINA', 85),
(1058, 'MANI', 85),
(1059, 'MONTERREY', 85),
(1060, 'NUNCHIA', 85),
(1061, 'OROCUE', 85),
(1062, 'PAZ DE ARIPORO', 85),
(1063, 'PORE', 85),
(1064, 'RECETOR', 85),
(1065, 'SABANALARGA', 85),
(1066, 'SACAMA', 85),
(1067, 'SAN LUIS DE PALENQUE', 85),
(1068, 'TAMARA', 85),
(1069, 'TAURAMENA', 85),
(1070, 'TRINIDAD', 85),
(1071, 'VILLANUEVA', 85),
(1072, 'MOCOA', 86),
(1073, 'COLON', 86),
(1074, 'ORITO', 86),
(1075, 'PUERTO ASIS', 86),
(1076, 'PUERTO CAICEDO', 86),
(1077, 'PUERTO GUZMAN', 86),
(1078, 'LEGUIZAMO', 86),
(1079, 'SIBUNDOY', 86),
(1080, 'SAN FRANCISCO', 86),
(1081, 'SAN MIGUEL', 86),
(1082, 'SANTIAGO', 86),
(1083, 'VALLE DEL GUAMUEZ', 86),
(1084, 'VILLAGARZON', 86),
(1085, 'SAN ANDRES', 88),
(1086, 'PROVIDENCIA', 88),
(1087, 'LETICIA', 91),
(1088, 'EL ENCANTO', 91),
(1089, 'LA CHORRERA', 91),
(1090, 'LA PEDRERA', 91),
(1091, 'LA VICTORIA', 91),
(1092, 'MIRITI - PARANA', 91),
(1093, 'PUERTO ALEGRIA', 91),
(1094, 'PUERTO ARICA', 91),
(1095, 'PUERTO NARIÑO', 91),
(1096, 'PUERTO SANTANDER', 91),
(1097, 'TARAPACA', 91),
(1098, 'INIRIDA', 94),
(1099, 'BARRANCO MINAS', 94),
(1100, 'MAPIRIPANA', 94),
(1101, 'SAN FELIPE', 94),
(1102, 'PUERTO COLOMBIA', 94),
(1103, 'LA GUADALUPE', 94),
(1104, 'CACAHUAL', 94),
(1105, 'PANA PANA', 94),
(1106, 'MORICHAL', 94),
(1107, 'SAN JOSE DEL GUAVIARE', 95),
(1108, 'CALAMAR', 95),
(1109, 'EL RETORNO', 95),
(1110, 'MIRAFLORES', 95),
(1111, 'MITU', 97),
(1112, 'CARURU', 97),
(1113, 'PACOA', 97),
(1114, 'TARAIRA', 97),
(1115, 'PAPUNAUA', 97),
(1116, 'YAVARATE', 97),
(1117, 'PUERTO CARREÑO', 99),
(1118, 'LA PRIMAVERA', 99),
(1119, 'SANTA ROSALIA', 99),
(1120, 'CUMARIBO', 99),
(1121, 'OTRO', 100),
(1122, 'OTRO', 101),
(1123, 'OTRO', 102),
(1124, 'OTRO', 103),
(1125, 'OTRO', 104),
(1126, 'OTRO', 105),
(1127, 'OTRO', 106),
(1128, 'OTRO', 107),
(1129, 'OTRO', 108),
(1130, 'OTRO', 109),
(1131, 'OTRO', 110),
(1132, 'OTRO', 111),
(1133, 'OTRO', 112),
(1134, 'OTRO', 113),
(1135, 'OTRO', 114),
(1136, 'OTRO', 115),
(1137, 'OTRO', 116),
(1138, 'OTRO', 117),
(1139, 'OTRO', 118),
(1140, 'OTRO', 119),
(1141, 'OTRO', 120),
(1142, 'OTRO', 121),
(1143, 'OTRO', 122),
(1144, 'OTRO', 123),
(1145, 'OTRO', 124),
(1146, 'OTRO', 125),
(1147, 'OTRO', 126),
(1148, 'OTRO', 127),
(1149, 'OTRO', 128),
(1150, 'OTRO', 129),
(1151, 'OTRO', 130),
(1152, 'OTRO', 131),
(1153, 'OTRO', 132),
(1154, 'OTRO', 133),
(1155, 'OTRO', 134),
(1156, 'OTRO', 135),
(1157, 'OTRO', 136),
(1158, 'OTRO', 137),
(1159, 'OTRO', 138),
(1160, 'OTRO', 139),
(1161, 'OTRO', 140),
(1162, 'OTRO', 141),
(1163, 'OTRO', 142),
(1164, 'OTRO', 143),
(1165, 'OTRO', 144),
(1166, 'OTRO', 145),
(1167, 'OTRO', 146),
(1168, 'OTRO', 147),
(1169, 'OTRO', 148),
(1170, 'OTRO', 149),
(1171, 'OTRO', 150),
(1172, 'OTRO', 151),
(1173, 'OTRO', 152),
(1174, 'OTRO', 153),
(1175, 'OTRO', 154),
(1176, 'OTRO', 155),
(1177, 'OTRO', 156),
(1178, 'OTRO', 157),
(1179, 'OTRO', 158),
(1180, 'OTRO', 159),
(1181, 'OTRO', 160),
(1182, 'OTRO', 161),
(1183, 'OTRO', 162),
(1184, 'OTRO', 163),
(1185, 'OTRO', 164),
(1186, 'OTRO', 165),
(1187, 'OTRO', 166),
(1188, 'OTRO', 167),
(1189, 'OTRO', 168),
(1190, 'OTRO', 169),
(1191, 'OTRO', 170),
(1192, 'OTRO', 171),
(1193, 'OTRO', 172),
(1194, 'OTRO', 173),
(1195, 'OTRO', 174),
(1196, 'OTRO', 175),
(1197, 'OTRO', 176),
(1198, 'OTRO', 177),
(1199, 'OTRO', 178),
(1200, 'OTRO', 179),
(1201, 'OTRO', 180),
(1202, 'OTRO', 181),
(1203, 'OTRO', 182),
(1204, 'OTRO', 183),
(1205, 'OTRO', 184),
(1206, 'OTRO', 185),
(1207, 'OTRO', 186),
(1208, 'OTRO', 187),
(1209, 'OTRO', 188),
(1210, 'OTRO', 189),
(1211, 'OTRO', 190),
(1212, 'OTRO', 191),
(1213, 'OTRO', 192),
(1214, 'OTRO', 193),
(1215, 'OTRO', 194),
(1216, 'OTRO', 195),
(1217, 'OTRO', 196),
(1218, 'OTRO', 197),
(1219, 'OTRO', 198),
(1220, 'OTRO', 199),
(1221, 'OTRO', 200),
(1222, 'OTRO', 201),
(1223, 'OTRO', 202),
(1224, 'OTRO', 203),
(1225, 'OTRO', 204),
(1226, 'OTRO', 205),
(1227, 'OTRO', 206),
(1228, 'OTRO', 207),
(1229, 'OTRO', 208),
(1230, 'OTRO', 209),
(1231, 'OTRO', 210),
(1232, 'OTRO', 211),
(1233, 'OTRO', 212),
(1234, 'OTRO', 213),
(1235, 'OTRO', 214),
(1236, 'OTRO', 215),
(1237, 'OTRO', 216),
(1238, 'OTRO', 217),
(1239, 'OTRO', 218),
(1240, 'OTRO', 219),
(1241, 'OTRO', 220),
(1242, 'OTRO', 221),
(1243, 'OTRO', 222),
(1244, 'OTRO', 223),
(1245, 'OTRO', 224),
(1246, 'OTRO', 225),
(1247, 'OTRO', 226),
(1248, 'OTRO', 227),
(1249, 'OTRO', 228),
(1250, 'OTRO', 229),
(1251, 'OTRO', 230),
(1252, 'OTRO', 231),
(1253, 'OTRO', 232),
(1254, 'OTRO', 233),
(1255, 'OTRO', 234),
(1256, 'OTRO', 235),
(1257, 'OTRO', 236),
(1258, 'OTRO', 237),
(1259, 'OTRO', 238),
(1260, 'OTRO', 239),
(1261, 'OTRO', 240),
(1262, 'OTRO', 241),
(1263, 'OTRO', 242),
(1264, 'OTRO', 243),
(1265, 'OTRO', 244),
(1266, 'OTRO', 245),
(1267, 'OTRO', 246),
(1268, 'OTRO', 247),
(1269, 'OTRO', 248),
(1270, 'OTRO', 249),
(1271, 'OTRO', 250),
(1272, 'OTRO', 251),
(1273, 'OTRO', 252),
(1274, 'OTRO', 253),
(1275, 'OTRO', 254),
(1276, 'OTRO', 255),
(1277, 'OTRO', 256),
(1278, 'OTRO', 257),
(1279, 'OTRO', 258),
(1280, 'OTRO', 259),
(1281, 'OTRO', 260),
(1282, 'OTRO', 261),
(1283, 'OTRO', 262),
(1284, 'OTRO', 263),
(1285, 'OTRO', 264),
(1286, 'OTRO', 265),
(1287, 'OTRO', 266),
(1288, 'OTRO', 267),
(1289, 'OTRO', 268),
(1290, 'OTRO', 269),
(1291, 'OTRO', 270),
(1292, 'OTRO', 271),
(1293, 'OTRO', 272),
(1294, 'OTRO', 273),
(1295, 'OTRO', 274),
(1296, 'OTRO', 275),
(1297, 'OTRO', 276),
(1298, 'OTRO', 277),
(1299, 'OTRO', 278),
(1300, 'OTRO', 279),
(1301, 'OTRO', 280),
(1302, 'OTRO', 281),
(1303, 'OTRO', 282),
(1304, 'OTRO', 283),
(1305, 'OTRO', 284),
(1306, 'OTRO', 285),
(1307, 'OTRO', 286),
(1308, 'OTRO', 287),
(1309, 'OTRO', 288),
(1310, 'OTRO', 289),
(1311, 'OTRO', 290),
(1312, 'OTRO', 291),
(1313, 'OTRO', 292);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivelaciones`
--

CREATE TABLE `nivelaciones` (
  `id_nivelacion` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `periodo` varchar(8) NOT NULL,
  `nota` decimal(11,1) NOT NULL,
  `nivelacion` decimal(11,1) NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  `fecha_nivelacion` date NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivelaciones_finales`
--

CREATE TABLE `nivelaciones_finales` (
  `id_nivelacion_final` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `nota` decimal(11,1) NOT NULL,
  `nivelacion` decimal(11,1) NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  `fecha_nivelacion` date NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_educacion`
--

CREATE TABLE `niveles_educacion` (
  `id_nivel` int(11) NOT NULL,
  `nombre_nivel` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `niveles_educacion`
--

INSERT INTO `niveles_educacion` (`id_nivel`, `nombre_nivel`) VALUES
(1, 'Preescolar'),
(2, 'Básica Primaria'),
(3, 'Básica Secundaria'),
(4, 'Media');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_nota` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `p1` decimal(11,1) DEFAULT NULL,
  `p2` decimal(11,1) DEFAULT NULL,
  `p3` decimal(11,1) DEFAULT NULL,
  `p4` decimal(11,1) DEFAULT NULL,
  `nota_final` decimal(11,1) DEFAULT NULL,
  `nivelacion` decimal(11,1) DEFAULT NULL,
  `definitiva` decimal(11,1) DEFAULT NULL,
  `id_desempeno` int(11) DEFAULT NULL,
  `fallas` varchar(2) NOT NULL,
  `estado_nota` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id_nota`, `ano_lectivo`, `id_estudiante`, `id_grado`, `id_asignatura`, `p1`, `p2`, `p3`, `p4`, `nota_final`, `nivelacion`, `definitiva`, `id_desempeno`, `fallas`, `estado_nota`) VALUES
(1, 1, 34, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(2, 1, 34, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(3, 1, 34, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(4, 1, 34, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(5, 1, 34, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(6, 1, 34, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(7, 1, 34, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(8, 1, 34, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(9, 1, 34, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(10, 1, 34, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(11, 1, 34, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(12, 1, 34, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(13, 1, 34, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(14, 1, 34, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(15, 1, 34, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(16, 1, 34, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(17, 1, 34, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(18, 1, 35, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(19, 1, 35, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(20, 1, 35, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(21, 1, 35, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(22, 1, 35, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(23, 1, 35, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(24, 1, 35, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(25, 1, 35, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(26, 1, 35, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(27, 1, 35, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(28, 1, 35, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(29, 1, 35, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(30, 1, 35, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(31, 1, 35, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(32, 1, 35, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(33, 1, 35, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(34, 1, 35, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(35, 1, 37, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(36, 1, 37, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(37, 1, 37, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(38, 1, 37, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(39, 1, 37, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(40, 1, 37, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(41, 1, 37, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(42, 1, 37, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(43, 1, 37, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(44, 1, 37, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(45, 1, 37, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(46, 1, 37, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(47, 1, 37, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(48, 1, 37, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(49, 1, 37, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(50, 1, 37, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(51, 1, 37, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(52, 1, 38, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(53, 1, 38, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(54, 1, 38, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(55, 1, 38, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(56, 1, 38, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(57, 1, 38, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(58, 1, 38, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(59, 1, 38, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(60, 1, 38, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(61, 1, 38, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(62, 1, 38, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(63, 1, 38, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(64, 1, 38, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(65, 1, 38, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(66, 1, 38, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(67, 1, 38, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(68, 1, 38, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(69, 1, 40, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(70, 1, 40, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(71, 1, 40, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(72, 1, 40, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(73, 1, 40, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(74, 1, 40, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(75, 1, 40, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(76, 1, 40, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(77, 1, 40, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(78, 1, 40, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(79, 1, 40, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(80, 1, 40, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(81, 1, 40, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(82, 1, 40, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(83, 1, 40, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(84, 1, 40, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(85, 1, 40, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(86, 1, 42, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(87, 1, 42, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(88, 1, 42, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(89, 1, 42, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(90, 1, 42, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(91, 1, 42, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(92, 1, 42, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(93, 1, 42, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(94, 1, 42, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(95, 1, 42, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(96, 1, 42, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(97, 1, 42, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(98, 1, 42, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(99, 1, 42, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(100, 1, 42, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(101, 1, 42, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(102, 1, 42, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(103, 1, 43, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(104, 1, 43, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(105, 1, 43, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(106, 1, 43, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(107, 1, 43, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(108, 1, 43, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(109, 1, 43, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(110, 1, 43, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(111, 1, 43, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(112, 1, 43, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(113, 1, 43, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(114, 1, 43, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(115, 1, 43, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(116, 1, 43, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(117, 1, 43, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(118, 1, 43, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(119, 1, 43, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(120, 1, 45, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(121, 1, 45, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(122, 1, 45, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(123, 1, 45, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(124, 1, 45, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(125, 1, 45, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(126, 1, 45, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(127, 1, 45, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(128, 1, 45, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(129, 1, 45, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(130, 1, 45, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(131, 1, 45, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(132, 1, 45, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(133, 1, 45, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(134, 1, 45, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(135, 1, 45, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(136, 1, 45, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(137, 1, 47, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(138, 1, 47, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(139, 1, 47, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(140, 1, 47, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(141, 1, 47, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(142, 1, 47, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(143, 1, 47, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(144, 1, 47, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(145, 1, 47, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(146, 1, 47, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(147, 1, 47, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(148, 1, 47, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(149, 1, 47, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(150, 1, 47, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(151, 1, 47, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(152, 1, 47, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(153, 1, 47, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(171, 1, 50, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(172, 1, 50, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(173, 1, 50, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(174, 1, 50, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(175, 1, 50, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(176, 1, 50, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(177, 1, 50, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(178, 1, 50, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(179, 1, 50, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(180, 1, 50, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(181, 1, 50, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(182, 1, 50, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(183, 1, 50, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(184, 1, 50, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(185, 1, 50, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(186, 1, 50, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(187, 1, 50, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(188, 1, 51, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(189, 1, 51, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(190, 1, 51, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(191, 1, 51, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(192, 1, 51, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(193, 1, 51, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(194, 1, 51, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(195, 1, 51, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(196, 1, 51, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(197, 1, 51, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(198, 1, 51, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(199, 1, 51, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(200, 1, 51, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(201, 1, 51, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(202, 1, 51, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(203, 1, 51, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(204, 1, 51, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(205, 1, 52, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(206, 1, 52, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(207, 1, 52, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(208, 1, 52, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(209, 1, 52, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(210, 1, 52, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(211, 1, 52, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(212, 1, 52, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(213, 1, 52, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(214, 1, 52, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(215, 1, 52, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(216, 1, 52, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(217, 1, 52, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(218, 1, 52, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(219, 1, 52, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(220, 1, 52, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(221, 1, 52, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(222, 1, 49, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(223, 1, 49, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(224, 1, 49, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(225, 1, 49, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(226, 1, 49, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(227, 1, 49, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(228, 1, 49, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(229, 1, 49, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(230, 1, 49, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(231, 1, 49, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(232, 1, 49, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(233, 1, 49, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(234, 1, 49, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(235, 1, 49, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(236, 1, 49, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(237, 1, 49, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(238, 1, 49, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(239, 1, 46, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(240, 1, 46, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(241, 1, 46, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(242, 1, 46, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(243, 1, 46, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(244, 1, 46, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(245, 1, 46, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(246, 1, 46, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(247, 1, 46, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(248, 1, 46, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(249, 1, 46, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(250, 1, 46, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(251, 1, 46, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(252, 1, 46, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(253, 1, 46, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(254, 1, 46, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(255, 1, 46, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(256, 1, 44, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(257, 1, 44, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(258, 1, 44, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(259, 1, 44, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(260, 1, 44, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(261, 1, 44, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(262, 1, 44, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(263, 1, 44, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(264, 1, 44, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(265, 1, 44, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(266, 1, 44, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(267, 1, 44, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(268, 1, 44, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(269, 1, 44, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(270, 1, 44, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(271, 1, 44, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(272, 1, 44, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(273, 1, 41, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(274, 1, 41, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(275, 1, 41, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(276, 1, 41, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(277, 1, 41, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(278, 1, 41, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(279, 1, 41, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(280, 1, 41, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(281, 1, 41, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(282, 1, 41, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(283, 1, 41, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(284, 1, 41, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(285, 1, 41, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(286, 1, 41, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(287, 1, 41, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(288, 1, 41, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(289, 1, 41, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(290, 1, 39, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(291, 1, 39, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(292, 1, 39, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(293, 1, 39, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(294, 1, 39, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(295, 1, 39, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(296, 1, 39, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(297, 1, 39, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(298, 1, 39, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(299, 1, 39, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(300, 1, 39, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(301, 1, 39, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(302, 1, 39, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(303, 1, 39, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(304, 1, 39, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(305, 1, 39, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(306, 1, 39, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(307, 1, 36, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(308, 1, 36, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(309, 1, 36, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(310, 1, 36, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(311, 1, 36, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(312, 1, 36, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(313, 1, 36, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(314, 1, 36, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(315, 1, 36, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(316, 1, 36, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(317, 1, 36, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(318, 1, 36, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(319, 1, 36, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(320, 1, 36, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(321, 1, 36, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(322, 1, 36, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(323, 1, 36, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(324, 1, 11, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(325, 1, 11, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(326, 1, 11, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(327, 1, 11, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(328, 1, 11, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(329, 1, 11, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(330, 1, 11, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(331, 1, 11, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(332, 1, 11, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(333, 1, 11, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(334, 1, 11, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(335, 1, 11, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(336, 1, 11, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(337, 1, 11, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(338, 1, 11, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(339, 1, 11, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(340, 1, 13, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(341, 1, 13, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(342, 1, 13, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(343, 1, 13, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(344, 1, 13, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(345, 1, 13, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(346, 1, 13, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(347, 1, 13, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(348, 1, 13, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(349, 1, 13, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(350, 1, 13, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(351, 1, 13, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(352, 1, 13, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(353, 1, 13, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(354, 1, 13, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(355, 1, 13, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(356, 1, 15, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(357, 1, 15, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(358, 1, 15, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(359, 1, 15, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(360, 1, 15, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(361, 1, 15, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(362, 1, 15, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(363, 1, 15, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(364, 1, 15, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(365, 1, 15, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(366, 1, 15, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(367, 1, 15, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(368, 1, 15, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(369, 1, 15, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(370, 1, 15, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(371, 1, 15, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(372, 1, 18, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(373, 1, 18, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(374, 1, 18, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(375, 1, 18, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(376, 1, 18, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(377, 1, 18, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(378, 1, 18, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(379, 1, 18, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(380, 1, 18, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(381, 1, 18, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(382, 1, 18, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(383, 1, 18, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(384, 1, 18, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(385, 1, 18, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(386, 1, 18, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(387, 1, 18, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(388, 1, 20, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(389, 1, 20, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(390, 1, 20, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(391, 1, 20, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(392, 1, 20, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(393, 1, 20, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(394, 1, 20, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(395, 1, 20, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(396, 1, 20, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(397, 1, 20, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(398, 1, 20, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(399, 1, 20, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(400, 1, 20, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(401, 1, 20, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(402, 1, 20, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(403, 1, 20, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(404, 1, 22, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(405, 1, 22, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(406, 1, 22, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(407, 1, 22, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(408, 1, 22, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(409, 1, 22, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(410, 1, 22, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(411, 1, 22, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(412, 1, 22, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(413, 1, 22, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(414, 1, 22, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(415, 1, 22, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(416, 1, 22, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(417, 1, 22, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(418, 1, 22, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(419, 1, 22, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(420, 1, 24, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(421, 1, 24, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(422, 1, 24, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(423, 1, 24, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(424, 1, 24, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(425, 1, 24, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(426, 1, 24, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(427, 1, 24, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(428, 1, 24, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(429, 1, 24, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(430, 1, 24, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(431, 1, 24, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(432, 1, 24, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(433, 1, 24, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(434, 1, 24, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(435, 1, 24, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(436, 1, 26, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(437, 1, 26, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(438, 1, 26, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(439, 1, 26, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(440, 1, 26, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(441, 1, 26, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(442, 1, 26, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(443, 1, 26, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(444, 1, 26, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(445, 1, 26, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(446, 1, 26, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(447, 1, 26, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(448, 1, 26, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(449, 1, 26, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(450, 1, 26, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(451, 1, 26, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(452, 1, 28, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(453, 1, 28, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(454, 1, 28, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(455, 1, 28, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(456, 1, 28, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(457, 1, 28, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(458, 1, 28, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(459, 1, 28, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(460, 1, 28, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(461, 1, 28, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(462, 1, 28, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(463, 1, 28, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(464, 1, 28, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(465, 1, 28, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(466, 1, 28, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(467, 1, 28, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(468, 1, 29, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(469, 1, 29, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(470, 1, 29, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(471, 1, 29, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(472, 1, 29, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(473, 1, 29, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(474, 1, 29, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(475, 1, 29, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(476, 1, 29, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(477, 1, 29, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(478, 1, 29, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(479, 1, 29, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(480, 1, 29, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(481, 1, 29, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(482, 1, 29, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(483, 1, 29, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(484, 1, 30, 10, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(485, 1, 30, 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(486, 1, 30, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(487, 1, 30, 10, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(488, 1, 30, 10, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(489, 1, 30, 10, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(490, 1, 30, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(491, 1, 30, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(492, 1, 30, 10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(493, 1, 30, 10, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(494, 1, 30, 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(495, 1, 30, 10, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(496, 1, 30, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(497, 1, 30, 10, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(498, 1, 30, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(499, 1, 30, 10, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(500, 1, 48, 9, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(501, 1, 48, 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(502, 1, 48, 9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(503, 1, 48, 9, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(504, 1, 48, 9, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(505, 1, 48, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(506, 1, 48, 9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(507, 1, 48, 9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(508, 1, 48, 9, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(509, 1, 48, 9, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(510, 1, 48, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(511, 1, 48, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(512, 1, 48, 9, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(513, 1, 48, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(514, 1, 48, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(515, 1, 48, 9, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(516, 1, 48, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(517, 1, 59, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(518, 1, 59, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(519, 1, 59, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(520, 1, 59, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(521, 1, 59, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(522, 1, 59, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(523, 1, 59, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(524, 1, 59, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(525, 1, 59, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(526, 1, 59, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(527, 1, 59, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(528, 1, 59, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(529, 1, 59, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(530, 1, 59, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(531, 1, 59, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(532, 1, 59, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(533, 1, 59, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(534, 1, 59, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(535, 1, 65, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(536, 1, 65, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(537, 1, 65, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(538, 1, 65, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(539, 1, 65, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(540, 1, 65, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(541, 1, 65, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(542, 1, 65, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(543, 1, 65, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(544, 1, 65, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(545, 1, 65, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(546, 1, 65, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(547, 1, 65, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(548, 1, 65, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(549, 1, 65, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(550, 1, 65, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(551, 1, 65, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(552, 1, 65, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(553, 1, 67, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(554, 1, 67, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(555, 1, 67, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(556, 1, 67, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(557, 1, 67, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(558, 1, 67, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(559, 1, 67, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(560, 1, 67, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(561, 1, 67, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(562, 1, 67, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(563, 1, 67, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(564, 1, 67, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(565, 1, 67, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(566, 1, 67, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(567, 1, 67, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(568, 1, 67, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(569, 1, 67, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(570, 1, 67, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(571, 1, 69, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(572, 1, 69, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(573, 1, 69, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(574, 1, 69, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(575, 1, 69, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(576, 1, 69, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(577, 1, 69, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(578, 1, 69, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(579, 1, 69, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(580, 1, 69, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(581, 1, 69, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(582, 1, 69, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(583, 1, 69, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(584, 1, 69, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(585, 1, 69, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(586, 1, 69, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(587, 1, 69, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(588, 1, 69, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(589, 1, 70, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(590, 1, 70, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(591, 1, 70, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(592, 1, 70, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(593, 1, 70, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(594, 1, 70, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(595, 1, 70, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(596, 1, 70, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(597, 1, 70, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(598, 1, 70, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(599, 1, 70, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(600, 1, 70, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(601, 1, 70, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(602, 1, 70, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(603, 1, 70, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(604, 1, 70, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(605, 1, 70, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(606, 1, 70, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(607, 1, 72, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(608, 1, 72, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(609, 1, 72, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(610, 1, 72, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(611, 1, 72, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(612, 1, 72, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(613, 1, 72, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(614, 1, 72, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(615, 1, 72, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(616, 1, 72, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(617, 1, 72, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(618, 1, 72, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(619, 1, 72, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(620, 1, 72, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(621, 1, 72, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(622, 1, 72, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(623, 1, 72, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(624, 1, 72, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(625, 1, 73, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(626, 1, 73, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(627, 1, 73, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(628, 1, 73, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(629, 1, 73, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(630, 1, 73, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(631, 1, 73, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(632, 1, 73, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(633, 1, 73, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(634, 1, 73, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(635, 1, 73, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(636, 1, 73, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(637, 1, 73, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(638, 1, 73, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(639, 1, 73, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(640, 1, 73, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(641, 1, 73, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(642, 1, 73, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(643, 1, 75, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(644, 1, 75, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(645, 1, 75, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(646, 1, 75, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(647, 1, 75, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(648, 1, 75, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(649, 1, 75, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(650, 1, 75, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(651, 1, 75, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(652, 1, 75, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(653, 1, 75, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(654, 1, 75, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(655, 1, 75, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(656, 1, 75, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(657, 1, 75, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(658, 1, 75, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(659, 1, 75, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(660, 1, 75, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(661, 1, 77, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(662, 1, 77, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(663, 1, 77, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(664, 1, 77, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(665, 1, 77, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(666, 1, 77, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(667, 1, 77, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(668, 1, 77, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(669, 1, 77, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(670, 1, 77, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(671, 1, 77, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(672, 1, 77, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(673, 1, 77, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(674, 1, 77, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(675, 1, 77, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(676, 1, 77, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(677, 1, 77, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(678, 1, 77, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(679, 1, 78, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(680, 1, 78, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(681, 1, 78, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(682, 1, 78, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(683, 1, 78, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(684, 1, 78, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '');
INSERT INTO `notas` (`id_nota`, `ano_lectivo`, `id_estudiante`, `id_grado`, `id_asignatura`, `p1`, `p2`, `p3`, `p4`, `nota_final`, `nivelacion`, `definitiva`, `id_desempeno`, `fallas`, `estado_nota`) VALUES
(685, 1, 78, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(686, 1, 78, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(687, 1, 78, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(688, 1, 78, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(689, 1, 78, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(690, 1, 78, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(691, 1, 78, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(692, 1, 78, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(693, 1, 78, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(694, 1, 78, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(695, 1, 78, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(696, 1, 78, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(697, 1, 79, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(698, 1, 79, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(699, 1, 79, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(700, 1, 79, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(701, 1, 79, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(702, 1, 79, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(703, 1, 79, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(704, 1, 79, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(705, 1, 79, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(706, 1, 79, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(707, 1, 79, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(708, 1, 79, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(709, 1, 79, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(710, 1, 79, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(711, 1, 79, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(712, 1, 79, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(713, 1, 79, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(714, 1, 79, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(715, 1, 80, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(716, 1, 80, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(717, 1, 80, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(718, 1, 80, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(719, 1, 80, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(720, 1, 80, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(721, 1, 80, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(722, 1, 80, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(723, 1, 80, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(724, 1, 80, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(725, 1, 80, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(726, 1, 80, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(727, 1, 80, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(728, 1, 80, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(729, 1, 80, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(730, 1, 80, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(731, 1, 80, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(732, 1, 80, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(733, 1, 81, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(734, 1, 81, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(735, 1, 81, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(736, 1, 81, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(737, 1, 81, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(738, 1, 81, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(739, 1, 81, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(740, 1, 81, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(741, 1, 81, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(742, 1, 81, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(743, 1, 81, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(744, 1, 81, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(745, 1, 81, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(746, 1, 81, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(747, 1, 81, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(748, 1, 81, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(749, 1, 81, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(750, 1, 81, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(751, 1, 83, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(752, 1, 83, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(753, 1, 83, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(754, 1, 83, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(755, 1, 83, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(756, 1, 83, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(757, 1, 83, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(758, 1, 83, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(759, 1, 83, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(760, 1, 83, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(761, 1, 83, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(762, 1, 83, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(763, 1, 83, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(764, 1, 83, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(765, 1, 83, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(766, 1, 83, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(767, 1, 83, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(768, 1, 83, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(769, 1, 85, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(770, 1, 85, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(771, 1, 85, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(772, 1, 85, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(773, 1, 85, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(774, 1, 85, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(775, 1, 85, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(776, 1, 85, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(777, 1, 85, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(778, 1, 85, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(779, 1, 85, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(780, 1, 85, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(781, 1, 85, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(782, 1, 85, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(783, 1, 85, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(784, 1, 85, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(785, 1, 85, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(786, 1, 85, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(787, 1, 87, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(788, 1, 87, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(789, 1, 87, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(790, 1, 87, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(791, 1, 87, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(792, 1, 87, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(793, 1, 87, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(794, 1, 87, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(795, 1, 87, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(796, 1, 87, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(797, 1, 87, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(798, 1, 87, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(799, 1, 87, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(800, 1, 87, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(801, 1, 87, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(802, 1, 87, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(803, 1, 87, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(804, 1, 87, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(805, 1, 89, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(806, 1, 89, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(807, 1, 89, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(808, 1, 89, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(809, 1, 89, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(810, 1, 89, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(811, 1, 89, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(812, 1, 89, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(813, 1, 89, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(814, 1, 89, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(815, 1, 89, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(816, 1, 89, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(817, 1, 89, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(818, 1, 89, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(819, 1, 89, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(820, 1, 89, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(821, 1, 89, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(822, 1, 89, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(823, 1, 91, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(824, 1, 91, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(825, 1, 91, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(826, 1, 91, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(827, 1, 91, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(828, 1, 91, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(829, 1, 91, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(830, 1, 91, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(831, 1, 91, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(832, 1, 91, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(833, 1, 91, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(834, 1, 91, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(835, 1, 91, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(836, 1, 91, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(837, 1, 91, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(838, 1, 91, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(839, 1, 91, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(840, 1, 91, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(841, 1, 93, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(842, 1, 93, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(843, 1, 93, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(844, 1, 93, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(845, 1, 93, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(846, 1, 93, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(847, 1, 93, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(848, 1, 93, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(849, 1, 93, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(850, 1, 93, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(851, 1, 93, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(852, 1, 93, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(853, 1, 93, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(854, 1, 93, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(855, 1, 93, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(856, 1, 93, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(857, 1, 93, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(858, 1, 93, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(859, 1, 95, 8, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(860, 1, 95, 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(861, 1, 95, 8, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(862, 1, 95, 8, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(863, 1, 95, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(864, 1, 95, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(865, 1, 95, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(866, 1, 95, 8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(867, 1, 95, 8, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(868, 1, 95, 8, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(869, 1, 95, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(870, 1, 95, 8, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(871, 1, 95, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(872, 1, 95, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(873, 1, 95, 8, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(874, 1, 95, 8, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(875, 1, 95, 8, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(876, 1, 95, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(877, 1, 60, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(878, 1, 60, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(879, 1, 60, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(880, 1, 60, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(881, 1, 60, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(882, 1, 60, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(883, 1, 60, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(884, 1, 60, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(885, 1, 60, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(886, 1, 60, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(887, 1, 60, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(888, 1, 60, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(889, 1, 60, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(890, 1, 60, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(891, 1, 60, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(892, 1, 60, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(893, 1, 60, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(894, 1, 60, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(895, 1, 61, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(896, 1, 61, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(897, 1, 61, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(898, 1, 61, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(899, 1, 61, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(900, 1, 61, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(901, 1, 61, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(902, 1, 61, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(903, 1, 61, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(904, 1, 61, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(905, 1, 61, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(906, 1, 61, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(907, 1, 61, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(908, 1, 61, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(909, 1, 61, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(910, 1, 61, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(911, 1, 61, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(912, 1, 61, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(913, 1, 62, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(914, 1, 62, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(915, 1, 62, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(916, 1, 62, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(917, 1, 62, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(918, 1, 62, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(919, 1, 62, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(920, 1, 62, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(921, 1, 62, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(922, 1, 62, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(923, 1, 62, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(924, 1, 62, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(925, 1, 62, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(926, 1, 62, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(927, 1, 62, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(928, 1, 62, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(929, 1, 62, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(930, 1, 62, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(931, 1, 63, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(932, 1, 63, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(933, 1, 63, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(934, 1, 63, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(935, 1, 63, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(936, 1, 63, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(937, 1, 63, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(938, 1, 63, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(939, 1, 63, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(940, 1, 63, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(941, 1, 63, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(942, 1, 63, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(943, 1, 63, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(944, 1, 63, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(945, 1, 63, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(946, 1, 63, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(947, 1, 63, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(948, 1, 63, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(949, 1, 64, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(950, 1, 64, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(951, 1, 64, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(952, 1, 64, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(953, 1, 64, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(954, 1, 64, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(955, 1, 64, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(956, 1, 64, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(957, 1, 64, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(958, 1, 64, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(959, 1, 64, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(960, 1, 64, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(961, 1, 64, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(962, 1, 64, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(963, 1, 64, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(964, 1, 64, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(965, 1, 64, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(966, 1, 64, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(967, 1, 66, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(968, 1, 66, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(969, 1, 66, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(970, 1, 66, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(971, 1, 66, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(972, 1, 66, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(973, 1, 66, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(974, 1, 66, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(975, 1, 66, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(976, 1, 66, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(977, 1, 66, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(978, 1, 66, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(979, 1, 66, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(980, 1, 66, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(981, 1, 66, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(982, 1, 66, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(983, 1, 66, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(984, 1, 66, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(985, 1, 68, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(986, 1, 68, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(987, 1, 68, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(988, 1, 68, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(989, 1, 68, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(990, 1, 68, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(991, 1, 68, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(992, 1, 68, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(993, 1, 68, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(994, 1, 68, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(995, 1, 68, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(996, 1, 68, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(997, 1, 68, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(998, 1, 68, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(999, 1, 68, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1000, 1, 68, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1001, 1, 68, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1002, 1, 68, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1003, 1, 71, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1004, 1, 71, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1005, 1, 71, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1006, 1, 71, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1007, 1, 71, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1008, 1, 71, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1009, 1, 71, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1010, 1, 71, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1011, 1, 71, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1012, 1, 71, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1013, 1, 71, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1014, 1, 71, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1015, 1, 71, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1016, 1, 71, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1017, 1, 71, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1018, 1, 71, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1019, 1, 71, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1020, 1, 71, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1021, 1, 74, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1022, 1, 74, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1023, 1, 74, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1024, 1, 74, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1025, 1, 74, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1026, 1, 74, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1027, 1, 74, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1028, 1, 74, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1029, 1, 74, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1030, 1, 74, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1031, 1, 74, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1032, 1, 74, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1033, 1, 74, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1034, 1, 74, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1035, 1, 74, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1036, 1, 74, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1037, 1, 74, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1038, 1, 74, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1039, 1, 76, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1040, 1, 76, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1041, 1, 76, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1042, 1, 76, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1043, 1, 76, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1044, 1, 76, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1045, 1, 76, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1046, 1, 76, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1047, 1, 76, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1048, 1, 76, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1049, 1, 76, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1050, 1, 76, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1051, 1, 76, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1052, 1, 76, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1053, 1, 76, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1054, 1, 76, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1055, 1, 76, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1056, 1, 76, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1057, 1, 82, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1058, 1, 82, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1059, 1, 82, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1060, 1, 82, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1061, 1, 82, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1062, 1, 82, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1063, 1, 82, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1064, 1, 82, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1065, 1, 82, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1066, 1, 82, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1067, 1, 82, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1068, 1, 82, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1069, 1, 82, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1070, 1, 82, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1071, 1, 82, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1072, 1, 82, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1073, 1, 82, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1074, 1, 82, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1075, 1, 84, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1076, 1, 84, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1077, 1, 84, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1078, 1, 84, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1079, 1, 84, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1080, 1, 84, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1081, 1, 84, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1082, 1, 84, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1083, 1, 84, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1084, 1, 84, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1085, 1, 84, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1086, 1, 84, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1087, 1, 84, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1088, 1, 84, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1089, 1, 84, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1090, 1, 84, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1091, 1, 84, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1092, 1, 84, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1093, 1, 86, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1094, 1, 86, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1095, 1, 86, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1096, 1, 86, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1097, 1, 86, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1098, 1, 86, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1099, 1, 86, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1100, 1, 86, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1101, 1, 86, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1102, 1, 86, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1103, 1, 86, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1104, 1, 86, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1105, 1, 86, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1106, 1, 86, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1107, 1, 86, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1108, 1, 86, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1109, 1, 86, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1110, 1, 86, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1111, 1, 88, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1112, 1, 88, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1113, 1, 88, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1114, 1, 88, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1115, 1, 88, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1116, 1, 88, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1117, 1, 88, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1118, 1, 88, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1119, 1, 88, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1120, 1, 88, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1121, 1, 88, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1122, 1, 88, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1123, 1, 88, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1124, 1, 88, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1125, 1, 88, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1126, 1, 88, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1127, 1, 88, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1128, 1, 88, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1129, 1, 90, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1130, 1, 90, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1131, 1, 90, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1132, 1, 90, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1133, 1, 90, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1134, 1, 90, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1135, 1, 90, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1136, 1, 90, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1137, 1, 90, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1138, 1, 90, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1139, 1, 90, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1140, 1, 90, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1141, 1, 90, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1142, 1, 90, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1143, 1, 90, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1144, 1, 90, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1145, 1, 90, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1146, 1, 90, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1147, 1, 92, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1148, 1, 92, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1149, 1, 92, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1150, 1, 92, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1151, 1, 92, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1152, 1, 92, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1153, 1, 92, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1154, 1, 92, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1155, 1, 92, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1156, 1, 92, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1157, 1, 92, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1158, 1, 92, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1159, 1, 92, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1160, 1, 92, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1161, 1, 92, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1162, 1, 92, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1163, 1, 92, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1164, 1, 92, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1165, 1, 94, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1166, 1, 94, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1167, 1, 94, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1168, 1, 94, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1169, 1, 94, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1170, 1, 94, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1171, 1, 94, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1172, 1, 94, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1173, 1, 94, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1174, 1, 94, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1175, 1, 94, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1176, 1, 94, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1177, 1, 94, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1178, 1, 94, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1179, 1, 94, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1180, 1, 94, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1181, 1, 94, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1182, 1, 94, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1183, 1, 96, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1184, 1, 96, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1185, 1, 96, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1186, 1, 96, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1187, 1, 96, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1188, 1, 96, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1189, 1, 96, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1190, 1, 96, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1191, 1, 96, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1192, 1, 96, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1193, 1, 96, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1194, 1, 96, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1195, 1, 96, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1196, 1, 96, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1197, 1, 96, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1198, 1, 96, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1199, 1, 96, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1200, 1, 96, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1201, 1, 97, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1202, 1, 97, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1203, 1, 97, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1204, 1, 97, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1205, 1, 97, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1206, 1, 97, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1207, 1, 97, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1208, 1, 97, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1209, 1, 97, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1210, 1, 97, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1211, 1, 97, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1212, 1, 97, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1213, 1, 97, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1214, 1, 97, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1215, 1, 97, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1216, 1, 97, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1217, 1, 97, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1218, 1, 97, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1237, 1, 99, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1238, 1, 99, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1239, 1, 99, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1240, 1, 99, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1241, 1, 99, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1242, 1, 99, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1243, 1, 99, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1244, 1, 99, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1245, 1, 99, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1246, 1, 99, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1247, 1, 99, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1248, 1, 99, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1249, 1, 99, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1250, 1, 99, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1251, 1, 99, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1252, 1, 99, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1253, 1, 99, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1254, 1, 99, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1255, 1, 100, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1256, 1, 100, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1257, 1, 100, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1258, 1, 100, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1259, 1, 100, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1260, 1, 100, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1261, 1, 100, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1262, 1, 100, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1263, 1, 100, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1264, 1, 100, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1265, 1, 100, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1266, 1, 100, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1267, 1, 100, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1268, 1, 100, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1269, 1, 100, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1270, 1, 100, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1271, 1, 100, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1272, 1, 100, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1273, 1, 101, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1274, 1, 101, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1275, 1, 101, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1276, 1, 101, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1277, 1, 101, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1278, 1, 101, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1279, 1, 101, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1280, 1, 101, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1281, 1, 101, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1282, 1, 101, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1283, 1, 101, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1284, 1, 101, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1285, 1, 101, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1286, 1, 101, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1287, 1, 101, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1288, 1, 101, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1289, 1, 101, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1290, 1, 101, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1309, 1, 98, 7, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1310, 1, 98, 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1311, 1, 98, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1312, 1, 98, 7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1313, 1, 98, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1314, 1, 98, 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1315, 1, 98, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1316, 1, 98, 7, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1317, 1, 98, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1318, 1, 98, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1319, 1, 98, 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1320, 1, 98, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1321, 1, 98, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1322, 1, 98, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1323, 1, 98, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1324, 1, 98, 7, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1325, 1, 98, 7, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1326, 1, 98, 7, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1327, 1, 34, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1328, 1, 35, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1329, 1, 37, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1330, 1, 38, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1331, 1, 40, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1332, 1, 42, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1333, 1, 43, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1334, 1, 45, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1335, 1, 47, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1336, 1, 48, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1337, 1, 50, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1338, 1, 51, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1339, 1, 52, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1340, 1, 49, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1341, 1, 46, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1342, 1, 44, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1343, 1, 41, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1344, 1, 39, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1345, 1, 36, 9, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1346, 1, 11, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1347, 1, 13, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1348, 1, 15, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1349, 1, 18, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1350, 1, 20, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1351, 1, 22, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1352, 1, 24, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1353, 1, 26, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1354, 1, 28, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1355, 1, 29, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1356, 1, 30, 10, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1357, 1, 11, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1358, 1, 13, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1359, 1, 15, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1360, 1, 18, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1361, 1, 20, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1362, 1, 22, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1363, 1, 24, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1364, 1, 26, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1365, 1, 28, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1366, 1, 29, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(1367, 1, 30, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_actividades`
--

CREATE TABLE `notas_actividades` (
  `id_planilla` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `nota` decimal(11,1) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notas_actividades`
--

INSERT INTO `notas_actividades` (`id_planilla`, `id_estudiante`, `id_actividad`, `nota`, `fecha_registro`) VALUES
(1, 34, 1, '4.0', '2018-10-24 03:31:56'),
(2, 35, 1, '4.0', '2018-10-24 03:31:56'),
(3, 37, 1, '4.0', '2018-10-24 03:31:56'),
(4, 38, 1, '4.0', '2018-10-24 03:31:56'),
(5, 40, 1, '4.0', '2018-10-24 03:31:56'),
(6, 42, 1, '4.0', '2018-10-24 03:31:56'),
(7, 43, 1, '4.0', '2018-10-24 03:31:56'),
(8, 45, 1, '4.0', '2018-10-24 03:31:56'),
(9, 47, 1, '4.0', '2018-10-24 03:31:56'),
(10, 48, 1, '4.0', '2018-10-24 03:31:56'),
(11, 50, 1, '4.0', '2018-10-24 03:31:56'),
(12, 51, 1, '4.0', '2018-10-24 03:31:56'),
(13, 52, 1, '4.0', '2018-10-24 03:31:56'),
(14, 49, 1, '4.0', '2018-10-24 03:31:56'),
(15, 46, 1, '4.0', '2018-10-24 03:31:56'),
(16, 44, 1, '4.0', '2018-10-24 03:31:56'),
(17, 41, 1, '4.0', '2018-10-24 03:31:56'),
(18, 39, 1, '4.0', '2018-10-24 03:31:56'),
(19, 36, 1, '4.0', '2018-10-24 03:31:56'),
(20, 34, 2, NULL, '0000-00-00 00:00:00'),
(21, 35, 2, NULL, '0000-00-00 00:00:00'),
(22, 37, 2, NULL, '0000-00-00 00:00:00'),
(23, 38, 2, NULL, '0000-00-00 00:00:00'),
(24, 40, 2, NULL, '0000-00-00 00:00:00'),
(25, 42, 2, NULL, '0000-00-00 00:00:00'),
(26, 43, 2, NULL, '0000-00-00 00:00:00'),
(27, 45, 2, NULL, '0000-00-00 00:00:00'),
(28, 47, 2, NULL, '0000-00-00 00:00:00'),
(29, 48, 2, NULL, '0000-00-00 00:00:00'),
(30, 50, 2, NULL, '0000-00-00 00:00:00'),
(31, 51, 2, NULL, '0000-00-00 00:00:00'),
(32, 52, 2, NULL, '0000-00-00 00:00:00'),
(33, 49, 2, NULL, '0000-00-00 00:00:00'),
(34, 46, 2, NULL, '0000-00-00 00:00:00'),
(35, 44, 2, NULL, '0000-00-00 00:00:00'),
(36, 41, 2, NULL, '0000-00-00 00:00:00'),
(37, 39, 2, NULL, '0000-00-00 00:00:00'),
(38, 36, 2, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `codigo_notificacion` int(11) NOT NULL,
  `categoria_notificacion` varchar(45) NOT NULL,
  `remitente` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `tipo_notificacion` varchar(45) NOT NULL,
  `contenido` varchar(300) NOT NULL,
  `destinatario` varchar(45) NOT NULL,
  `rol_destinatario` varchar(45) NOT NULL,
  `id_estudiante` int(11) DEFAULT '1',
  `id_asignatura` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `fecha_envio` datetime NOT NULL,
  `estado_lectura` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_notificacion`, `codigo_notificacion`, `categoria_notificacion`, `remitente`, `titulo`, `tipo_notificacion`, `contenido`, `destinatario`, `rol_destinatario`, `id_estudiante`, `id_asignatura`, `fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`, `fecha_envio`, `estado_lectura`) VALUES
(1, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '34', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(2, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '35', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(3, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '37', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(4, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '38', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(5, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '40', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(6, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '42', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(7, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '43', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(8, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '45', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(9, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '47', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(10, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '48', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(11, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '50', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(12, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '51', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(13, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '52', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(14, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '49', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(15, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '46', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(16, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '44', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(17, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '41', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(18, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '39', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(19, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '36', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(20, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '11', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(21, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '13', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(22, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '15', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(23, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '18', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(24, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '20', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(25, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '22', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(26, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '24', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(27, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '26', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(28, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '28', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(29, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '29', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(30, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '30', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(31, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '56', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(32, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '53', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(33, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(34, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '55', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(35, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '55', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(36, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '57', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(37, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '57', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(38, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '57', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(39, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '56', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(40, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(41, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '56', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(42, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(43, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '54', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(44, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '55', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(45, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(46, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '55', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(47, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '57', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(48, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '55', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(49, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '55', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(50, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '56', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(51, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(52, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(53, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(54, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '57', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(55, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(56, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '53', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(57, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(58, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(59, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(60, 1, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bievenidos Estudiantes', '58', '1', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 11:53:25', '0'),
(121, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '3', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '1'),
(122, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '4', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(123, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '5', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(124, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '12', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(125, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '14', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(126, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '16', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(127, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '17', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(128, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '19', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '1'),
(129, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '21', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(130, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '23', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(131, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '25', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(132, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '27', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(133, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '31', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(134, 2, 'Mensajes', 1, 'Bienvenida', 'Mensaje General', 'Bienvenido Queridos Profesores.\r\nSocializacion Proyecto Siescolar.', '32', '2', 1, NULL, NULL, NULL, NULL, NULL, '2018-10-24 03:05:17', '0'),
(135, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 34, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(136, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '53', '4', 35, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(137, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 37, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(138, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 38, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(139, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 40, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(140, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 42, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(141, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 43, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(142, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 45, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(143, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 47, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(144, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 48, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(145, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 50, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(146, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 51, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(147, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '54', '4', 52, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(148, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 49, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(149, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 46, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(150, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 44, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(151, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 41, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(152, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 39, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(153, 3, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 36, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:21', '0'),
(154, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 34, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(155, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '53', '4', 35, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(156, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 37, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(157, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 38, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(158, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 40, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(159, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 42, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(160, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 43, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(161, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 45, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(162, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 47, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(163, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 48, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(164, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 50, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(165, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 51, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(166, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '54', '4', 52, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(167, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 49, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(168, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 46, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(169, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 44, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(170, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 41, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(171, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 39, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(172, 4, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 36, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:34', '0'),
(173, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 34, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(174, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '53', '4', 35, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(175, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 37, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(176, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 38, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(177, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 40, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(178, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 42, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(179, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 43, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(180, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 45, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(181, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 47, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(182, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 48, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(183, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 50, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(184, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 51, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(185, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '54', '4', 52, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(186, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 49, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(187, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 46, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(188, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 44, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(189, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 41, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(190, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 39, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(191, 5, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 36, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:39', '0'),
(192, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 34, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(193, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '53', '4', 35, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(194, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 37, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(195, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 38, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(196, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 40, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(197, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 42, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(198, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 43, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(199, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 45, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(200, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 47, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(201, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 48, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(202, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 50, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(203, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 51, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(204, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '54', '4', 52, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(205, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 49, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(206, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 46, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(207, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 44, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(208, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 41, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(209, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 39, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(210, 6, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 36, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(211, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 34, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(212, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '53', '4', 35, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(213, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 37, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(214, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 38, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(215, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 40, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(216, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 42, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(217, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 43, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(218, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 45, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(219, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 47, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(220, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 48, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(221, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 50, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(222, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 51, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(223, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '54', '4', 52, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(224, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 49, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(225, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 46, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(226, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 44, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(227, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 41, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(228, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 39, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(229, 7, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 36, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:43', '0'),
(230, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 34, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(231, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '53', '4', 35, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(232, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 37, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(233, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 38, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(234, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 40, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(235, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 42, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(236, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 43, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(237, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 45, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(238, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 47, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(239, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 48, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(240, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 50, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(241, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 51, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(242, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '54', '4', 52, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(243, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 49, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(244, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 46, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(245, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 44, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(246, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 41, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(247, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 39, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(248, 8, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 36, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:10:49', '0'),
(249, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 34, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(250, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 34, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(251, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '53', '4', 35, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(252, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '53', '4', 35, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(253, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 37, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(254, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 37, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(255, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 38, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(256, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 38, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(257, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 40, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(258, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 40, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(259, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 42, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(260, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 42, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(261, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 43, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(262, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 43, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(263, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 45, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(264, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 45, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(265, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 47, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(266, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 47, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(267, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 48, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(268, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 48, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(269, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 50, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(270, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '56', '4', 50, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(271, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 51, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(272, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 51, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(273, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '54', '4', 52, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(274, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '54', '4', 52, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(275, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 49, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(276, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 49, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(277, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 46, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(278, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '58', '4', 46, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(279, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 44, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '1'),
(280, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 44, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(281, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 41, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(282, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '57', '4', 41, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(283, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 39, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(284, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 39, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(285, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 36, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0'),
(286, 9, 'Mensajes', 3, 'Reunion Urgente', 'Importante', 'Reunion Sobre El Paro Academico', '55', '4', 36, 11, NULL, NULL, NULL, NULL, '2018-10-24 03:12:48', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padres`
--

CREATE TABLE `padres` (
  `id_padre` int(11) NOT NULL,
  `identificacion_p` varchar(10) NOT NULL,
  `nombres_p` varchar(50) NOT NULL,
  `apellido1_p` varchar(50) NOT NULL,
  `apellido2_p` varchar(45) NOT NULL,
  `parentesco_p` varchar(45) NOT NULL DEFAULT 'Padre',
  `sexo_p` varchar(1) NOT NULL DEFAULT 'm',
  `telefono_p` varchar(10) NOT NULL,
  `direccion_p` varchar(45) NOT NULL,
  `barrio_p` varchar(45) NOT NULL,
  `ocupacion_p` varchar(45) NOT NULL,
  `telefono_trabajo_p` varchar(10) NOT NULL,
  `direccion_trabajo_p` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `padres`
--

INSERT INTO `padres` (`id_padre`, `identificacion_p`, `nombres_p`, `apellido1_p`, `apellido2_p`, `parentesco_p`, `sexo_p`, `telefono_p`, `direccion_p`, `barrio_p`, `ocupacion_p`, `telefono_trabajo_p`, `direccion_trabajo_p`) VALUES
(1, '4000000000', 'Jose', 'Bello', 'Mejia', 'Padre', 'm', '3145677854', 'Sempegua', 'La Paz', 'Agricultor', '3145677854', 'Sempegua La Paz'),
(2, '4000000000', 'Jose', 'Bello', 'Mejia', 'Padre', 'm', '3145677854', 'Sempegua', 'La Paz', 'Agricultor', '3145677854', 'Sempegua La Paz'),
(3, '4000000000', 'Carlos', 'Cabas', 'Cabas', 'Padre', 'm', '3128687679', 'Sempegua', 'La Paza', 'Agricultor', '3126767777', 'Sempegua La Paz'),
(4, '4000000000', 'Pablo', 'Cardenas', 'Villa', 'Padre', 'm', '3124569832', 'Sempegua', 'La Paz', 'Agricultor', '3124569832', 'Sempegua La Paz'),
(5, '410000', 'Ovidio', 'Guerrero', 'Perez', 'Padre', 'm', '3147869986', 'Sempegua', 'La Paz', 'Agricultor', '3123456789', 'Sempegua'),
(6, '4000000000', 'Luis', 'Castaneda', 'Villa', 'Padre', 'm', '3120000000', 'Sempegua', 'La Paz', 'Comerciante', '3120000000', 'Sempegua La Paz'),
(7, '400000000', 'Luis', 'Guerrero', 'Lopez', 'Padre', 'm', '3129876432', 'Sempegua', 'La Paz', 'Comerciante', '3126543219', 'Sempegua La Paz'),
(8, '4000000000', 'Juan', 'Guerrero', 'Fernandez', 'Padre', 'm', '3127777777', 'Sempegua', 'La Paz', 'Comerciante', '3145555555', 'Sempegua La Paz'),
(9, '400000000', 'Pedro', 'Gutierrez', 'Velez', 'Padre', 'm', '3143456789', 'Sempegua', 'La Paz', 'Albañil', '31245689', 'Sempegua La Paz'),
(10, '23456799', 'Luis', 'Mendez', 'Mendez', 'Padre', 'm', '314567890', 'Sempegua', 'La Paz', 'Constructor', '314567899', 'Sempegua La Paz'),
(11, '34568', 'Felipe', 'Nobles', 'N', 'Padre', 'm', '3456789', 'Sempegua', 'La Paz', 'Soldador', '456789', 'Sempegua'),
(12, '234567', 'Mario', 'Nobles', 'N', 'Padre', 'm', '323232323', 'Gtgtg', 'Gtgt', 'Gtgt', '5555', 'Hhhh'),
(13, '3456789', 'Daniel', 'Ortiz', 'O', 'Padre', 'm', '456789', 'Sssss', 'La Paz', 'Dfghjk', '67890', 'Fghjkl'),
(14, '34567890', 'Sergio', 'Pacheco', 'P', 'Padre', 'm', '567890', 'Dfghjk', 'Fghjk', 'Fghjkl', '567890', 'Fghjklñ'),
(15, '456789', 'Lian', 'Ramirez', 'Dfgh', 'Padre', 'm', '456789', 'Fghjk', 'Tyui', 'Fghjk', '56789', 'Fghjkl'),
(16, '34567890', 'Jose', 'Rico', 'Rtyui', 'Padre', 'm', '56789', 'Fghjk', 'Fghjk', 'Fghjk', '67890', 'Fghjkl'),
(17, '34567890', 'Lino', 'Acuna', 'Sdfghjk', 'Padre', 'm', '4567890', 'Dfghjkl', 'Dfghjkl', 'Dfghjkl', '456789', 'Sdfghjk'),
(18, '456789', 'Camilo', 'Cabas', 'Cabas', 'Padre', 'm', '4567890', 'Ghjkl', 'Fghjk', 'Ghjkl', '7890', 'Ghjk'),
(19, '1065', 'Miguel', 'Palomino', 'Cerpa', 'Padre', 'm', '3206919220', 'Sempegua', 'Sempegua', 'Estudiante', '3206919220', 'Sempegua'),
(20, '3456789', 'Luis', 'Cabas', 'Cabas', 'Padre', 'm', '3456789', 'Dfghjkl', 'Fghjkl??', 'Fghjkl', '67890', 'Fghjkl'),
(21, '3456789', 'Dfghjkl', 'Fghjkl', 'Fghjkl', 'Padre', 'm', '567890', 'Dfghjk', 'Fghjk', 'Fghjk', '567890', 'Ghjk'),
(22, '1065', 'Miguel', 'Palomino', 'Cerpa', 'Padre', 'm', '3206919220', 'Sempegua', 'Sempegua', 'Estudiante', '3206919220', 'Sempegua'),
(23, '4567890', 'Fghjkl', 'Vbnm', 'Ghjk', 'Padre', 'm', '567890', 'Dfghjk', 'Fghjk', 'Fghj', '567890', 'Fghjkl'),
(24, '1065', 'Miguel', 'Palomino', 'Cerpa', 'Padre', 'm', '3206919220', 'Sempegua', 'Sempegua', 'Estudiante', '3206919220', 'Sempegua'),
(25, '567890', 'Fghjkl', 'Vbnm', 'Dfghjk', 'Padre', 'm', '567890', 'Dfghjkl', 'Fghjk', 'Fghjk', '67890', 'Vbnm'),
(26, '343434', 'Fgfgfg', 'Fgfgfg', 'Fgfgfg', 'Padre', 'm', '343434', 'Dfghjkl', 'Dfdfdfd', 'Lllehaha', '232323', 'Rgrtrt'),
(27, '1065', 'Miguel', 'Palomino', 'Cerpa', 'Padre', 'm', '3206919220', 'Calle 30a 32-86', 'Sempegua', 'Estudiante', '3206919220', 'Calle 30a 32-86'),
(28, '345689', 'Ddsdsd', 'Ertyui', 'Dfgk', 'Padre', 'm', '3456789', 'Dfghjk', 'Dfghjk', 'Dfghk', '45689', 'Dfghjk'),
(29, '1065', 'Miguel', 'Palomino', 'Cerpa', 'Padre', 'm', '3206919220', 'Calle 30a 32-86', 'Sempegua', 'Estudiante', '3206919220', 'Calle 30a 32-86'),
(30, '456890', 'Dfghjkl', 'Dfghjkl', 'Fghk', 'Padre', 'm', '4567890', '456789', 'Fghjkl', 'Ghjkl', '56789', 'Cvbnm'),
(31, '456789', 'Fghjk', 'Fghjk', 'Fghjk', 'Padre', 'm', '5689', 'Dfghj', 'Fghjk', 'Fghjk', '5678', 'Fghjk'),
(32, '1065', 'Miguel Jose', 'Palomino', 'Cerpa', 'Padre', 'm', '320691922', 'Calle 30a 32-86', 'Sempegua', 'Estudiante', '3206919220', 'Calle 30a 32-86'),
(33, '456890', 'Dfghjkl', 'Fghjkl', 'Dfghjk', 'Padre', 'm', '57890', 'Dfghjkl', 'Fghjkl', '456890', '3456789', 'Dfghjkl??'),
(34, '456789', 'Dfghjkl', 'Fghjk', 'Fghjk', 'Padre', 'm', '45689', '456789', 'Dfghjk', 'Fghjk', '56789', 'Ghjkl??'),
(35, '1065', 'Migue', 'Palomino', 'Cerpa', 'Padre', 'm', '3206919220', 'Calle 30a 32-86', 'Sempegua', 'Estudiante', '3206919220', 'Calle 30a 32-86'),
(36, '1010', 'Marielis', 'Chamorro', 'Hernandez', 'Padre', 'm', '3206919220', 'Sempegua', 'Sempegua', 'Ama De Casa', '3206919220', 'Calle 30a 32-86'),
(37, '12432434', 'Jose Alberto', 'Berrueco', 'Martinez', 'Padre', 'm', '3214455656', 'Sempegua', 'Barrio Arriba', 'Pescador', '24234577', 'Sempegua'),
(38, '132343454', 'Neil', 'Cardenas', 'Cabas', 'Padre', 'm', '321657899', 'Sempegua', 'Barrio Arriba', 'Ganadero', '343535435', 'Sempegua'),
(39, '12123236', 'Manuel Andres', 'Florez', 'Contreras', 'Padre', 'm', '3244556446', 'Sempegua', 'Divino NiÑo', 'Pescador', '323454555', 'Sempegua'),
(40, '133444554', 'Antonio Jose', 'Florian', 'Nobles', 'Padre', 'm', '32454556', 'Sempegua', 'El Bronx', 'Pescador', '234324', 'Sempegua'),
(41, '1244567568', 'Estevinson', 'Guerrero', 'Contreras', 'Padre', 'm', '322345566', 'Sempegua', 'La Playa', 'Pescador', '3454464232', 'Sempegua'),
(42, '1010', 'Nelly', 'Nobles', 'Mendez', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Ama De Casa', '3116845721', 'Sempegua'),
(43, '113244546', 'Jose Angel', 'Guerrero', 'Toloza', 'Padre', 'm', '3214544657', 'Sempegua', 'La Central', 'Pescador', '233545', 'Sempegua'),
(44, '10202121', 'Juan Pablo', 'Ortiz', 'Mendez', 'Padre', 'm', '3115674845', 'Sempegua', 'Centro', 'Comerciante', '3206919220', 'Sempegua'),
(45, '145657876', 'Enrique Alberto', 'Gutierrez', 'Palomino', 'Padre', 'm', '3234677868', 'Sempegua', 'La Central', 'Agricultor', '2323455', 'Sempegua'),
(46, '1063435424', 'David', 'Florian', 'Fuentes', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(47, '267292316', 'Daniel', 'Hernandez', 'Perez', 'Padre', 'm', '3206919220', 'Sempegua', 'Centro', 'Comericante', '3206919220', 'Sempegua'),
(48, '125676787', 'Victor Manuel', 'Hernandez', 'Nobles', 'Padre', 'm', '3179090956', 'Sempegua', 'La Plaza', 'Comerciante', '23443565', 'Sempegua'),
(49, '4957835645', 'Juan', 'Martinez', 'Andrade', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(50, '478554125', 'Elver', 'Cogollo', 'Obregon', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(51, '1234887987', 'Victor', 'Infante', 'Martinez', 'Padre', 'm', '3223447', 'Sempegua', 'Barrio Arriba', 'Agricultor', '236657', 'Sempegua'),
(52, '4981211', 'Adelmo', 'Rocha', 'Meza', 'Padre', 'm', '3206919220', 'Calle 30a 32-86', 'Centro', 'Comerciante', '3206919220', 'Sempegua'),
(53, '1566898', 'Mario Andres', 'Luqueta', 'Obregon', 'Padre', 'm', '32567668', 'Sempegua', 'La Esquina', 'Pescador', '35455457', 'Sempegua'),
(54, '145215421', 'Jesus Aldo', 'Nobles', 'Mendez', 'Padre', 'm', '3188866092', 'Sempegua', 'La Paz', 'Docente', '3188866092', 'Sempegua'),
(55, '459785468', 'Alfonso', 'Nobles', 'Martinez', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(56, '4934352334', 'Daniel', 'Palomino', 'Lobo', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(57, '26749535', 'Alberto', 'Palomino', 'Perez', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Pescador', '3116845721', 'Sempegua'),
(58, '26794544', 'Andres', 'Pineda', 'Ojeda', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Pescador', '3116845721', 'Sempegua'),
(59, '2435465678', 'Mauricio Andres', 'Martinez', 'Rocha', 'Padre', 'm', '322544869', 'Sempegua', 'Divino NiÑo', 'Ganadero', '363536645', 'Sempegua'),
(60, '1065518512', 'Jaime', 'Rangel', 'Martinez', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Pescador', '3116845721', 'Sempegua'),
(61, '232458965', 'Alberto', 'Miranda', 'Nobles', 'Padre', 'm', '321445576', 'Sempegua', 'La Plaza', 'Comerciante', '446778643', 'Sempegua'),
(62, '1063484554', 'Rafael', 'Rocha', 'Andrade', 'Padre', 'm', '3116845721', 'Sempegua', 'La Paz', 'Ganadero', '3116845721', 'Sempegua'),
(63, '246554634', 'Jesus Alberto', 'Nobles', 'Blanco', 'Padre', 'm', '321445778', 'Sempegua', 'La Esquina', 'Agricultor', '2352432', 'Sempegua'),
(64, '26729548', 'Yolvi', 'Rocha', 'Cavas', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(65, '100665478', 'Lenis', 'Pacheco', 'Lopez', 'Padre', 'm', '31234288', 'Sempegua', 'Las Palmas', 'Pescador', '214243543', 'Sempegua'),
(66, '26729155', 'Humberto', 'Soto', 'Mercado', 'Padre', 'm', '3116845721', 'Caracas, Venezuela', 'Carapita', 'Comerciante', '3116845721', 'Caracas, Venezuela'),
(67, '123445667', 'Beimar', 'Palomino', 'Mendez', 'Padre', 'm', '325276790', 'Sempegua', 'La Paz', 'Comerciante', '5453124', 'Sempegua'),
(68, '497583155', 'Alveiro', 'Toloza', 'Toloza', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Pescador', '3116845721', 'Sempegua'),
(69, '100776463', 'Misael', 'Pastrana', 'Martinez', 'Padre', 'm', '32609869', 'Sempegua', 'Barrio Arriba', 'Ganadero', '43232544', 'Sempegua'),
(70, '49784524', 'Osmel', 'Toloza', 'Perez', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Ganadero', '3116845721', 'Sempegua'),
(71, '108766454', 'Fernando Luis', 'Pineda', 'Ruiz', 'Padre', 'm', '3212970089', 'Sempegua', 'La Central', 'Comerciante', '3286494938', 'Sempegua'),
(72, '45785461', 'Luis', 'Valle', 'Nobles', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Ganadero', '3116845721', 'Sempegua'),
(73, '109876434', 'Neil Jose', 'Ramirez', 'Toloza', 'Padre', 'm', '3212435565', 'Sempegua', 'La Central', 'Mototaxista', '233443543', 'Sempegua'),
(74, '1097967', 'Alberto', 'Ramirez', 'Perez', 'Padre', 'm', '3229789', 'Sempegua', 'La Central', 'Agricultor', '32556546', 'Sempegua'),
(75, '1088789667', 'Alonso', 'Ramos', 'Perez', 'Padre', 'm', '32234328', 'Sempegua', 'Divino NiÑo', 'Pescador', '234453', 'Sempegua'),
(76, '1099965433', 'Jesus David', 'Santos', 'Rincon', 'Padre', 'm', '321978700', 'Sempegua', 'La Carretera', 'Pescador', '3279655475', 'Sempegua'),
(77, '1278787420', 'Cristian Jose', 'Villar', 'Salcedo', 'Padre', 'm', '321908789', 'Sempegua', 'La Plaza', 'Agricultor', '2344533', 'Sempegua'),
(78, '1019864677', 'Enrique Jose', 'Waltero', 'Diaz', 'Padre', 'm', '32398954', 'Sempegua', 'La Roca', 'Agricultor', '214324353', 'Sempegua'),
(79, '475128154', 'Michael', 'Andrade', 'Gutierrez', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Comerciante', '3116845721', 'Sempegua'),
(80, '26897152', 'Jose', 'Cadena', 'Perez', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Ganadero', '3116845721', 'Sempegua'),
(81, '524781515', 'Julio', 'De Hoyos', 'Centeno', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Pescador', '3116845721', 'Sempegua'),
(82, '49521354', 'Manuel', 'Gomez', 'Gomez', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Pescador', '3116845721', 'Sempegua'),
(83, '106568452', 'Jose', 'Herrera', 'Nobles', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(84, '106548278', 'Daniel', 'Leon', 'Nobles', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Albanil', '3116845721', 'Sempegua'),
(85, '106521354', 'Yiri', 'Mendez', 'Cabas', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Pescador', '3116845721', 'Sempegua'),
(86, '1063452878', 'Jesus', 'Miranda', 'Cujia', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(87, '1065488947', 'Jose David', 'Nobles', 'Palomino', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Ganadero', '3116845721', 'Sempegua'),
(88, '1065525455', 'Manuel', 'Ortiz', 'Silgado', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Comerciante', '3116845721', 'Sempegua'),
(89, '26729314', 'Wilson', 'Pacheco', 'Cabas', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Albanil', '3116845721', 'Sempegua'),
(90, '102456455', 'Jaime', 'Parra', 'Parra', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Pescador', '3116845721', 'Sempegua'),
(91, '106547484', 'Luis', 'Rangel', 'Gutierrez', 'Padre', 'm', '3116845721', 'Sempegua', 'La Paz', 'Mecanico', '3116845721', 'Sempegua'),
(92, '26725485', 'Jose', 'Reales', 'Cadena', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Pescador', '3116845721', 'Sempegua'),
(93, '497518544', 'Guadith', 'Rico', 'Meza', 'Padre', 'm', '3116845721', 'Sempegua', 'Centro', 'Comerciante', '3116845721', 'Sempegua'),
(94, '264718457', 'Luis', 'Rocha', 'Mendez', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Pescador', '3116845721', 'Sempegua'),
(95, '106548725', 'Danilo', 'Santos', 'Mejia', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Ganadero', '3116845721', 'Sempegua'),
(96, '1062546455', 'Aldair', 'Toloza', 'Palomino', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Pescador', '3116845721', 'Sempegua'),
(97, '1065482416', 'Andres', 'Torres', 'Parra', 'Padre', 'm', '3116845721', 'Sempegua', 'La Plaza', 'Comerciante', '3116845721', 'Sempegua'),
(98, '1209876535', 'Eduardo Andres', 'Amaya', 'Perez', 'Padre', 'm', '327578688', 'Sempegua', 'La Plaza', 'Comerciante', '55656757', 'Sempegua'),
(99, '10065643', 'Fernando Jose', 'Avila', 'Pertuz', 'Padre', 'm', '32018675', 'Sempegua', 'La Central', 'Agricultor', '24532676', 'Sempegua'),
(100, '108763553', 'Manuel Francisco', 'Berrueco', 'Meza', 'Padre', 'm', '327836387', 'Sempegua', 'La Playa', 'Pescador', '234245453', 'Sempegua'),
(101, '1097574574', 'Jose Alberto', 'Florian', 'Martinez', 'Padre', 'm', '321289988', 'Sempegua', 'El Bronx', 'Pescador', '14263637', 'Sempegua'),
(102, '10765343', 'Miguel David', 'Guerrero', 'Aragon', 'Padre', 'm', '32267878', 'Sempegua', 'La Paz', 'Mototaxista', '32324453', 'Sempegua'),
(103, '1873499429', 'Simon', 'Gutierrez', 'Meza', 'Padre', 'm', '329076744', 'Sempegua', 'Divino NiÑo', 'Pastor', '3244654645', 'Sempegua'),
(104, '107654447', 'Jesus', 'Hernandez', 'Jimenez', 'Padre', 'm', '321774764', 'Sempegua', 'Las Palmas', 'Pescador', '42567838', 'Sempegua'),
(105, '190767565', 'Adanies', 'Mayorga', 'Chavez', 'Padre', 'm', '31433965', 'Sempegua', 'Divino NiÑo', 'Electricista', '234545246', 'Sempegua'),
(106, '106536378', 'Juan Jose', 'Medina', 'Arrieta', 'Padre', 'm', '3243768779', 'Sempegua', 'La Plaza', 'Pescador', '53624546', 'Sempegua'),
(107, '190836476', 'Andres', 'Nobles', 'Perez', 'Padre', 'm', '3289789787', 'Sempegua', 'La Plaza', 'Agricultura', '2345466', 'Sempegua'),
(108, '2433655476', 'Luis', 'Nobles', 'Cabas', 'Padre', 'm', '312467657', 'Sempegua', 'La Plaza', 'AlbaÑil', '2433543', 'Sempegua'),
(109, '139087849', 'Luis', 'Nobles', 'Cabas', 'Padre', 'm', '32896983', 'Sempegua', 'La Plaza', 'AlbaÑil', '24353556', 'Sempegua'),
(110, '123900712', 'Rolando', 'Palomino', 'Cerpa', 'Padre', 'm', '235645754', 'Sempegua', 'La Paz', 'Electricista', '2423523', 'Sempegua'),
(111, '1076657', 'Arturo', 'Perez', 'Cabrera', 'Padre', 'm', '3245546554', 'Sempegua', 'Barrio Arriba', 'Pescador', '324325345', 'Sempegua'),
(112, '109877861', 'Jainer', 'Rangel', 'Ruiz', 'Padre', 'm', '233536543', 'Sempegua', 'La Roca', 'Pescador', '2433243', 'Sempegua'),
(113, '109087633', 'Humberto Andres', 'Soto', 'Mercado', 'Padre', 'm', '312432235', 'Sempegua', 'La Paz', 'Pizzero', '1387242', 'Sempegua'),
(114, '1087928966', 'Julian', 'Toloza', 'Mendez', 'Padre', 'm', '321445465', 'Sempegua', 'La Playa', 'Pescador', '2343453', 'Sempegua'),
(115, '109798798', 'Wiliam Jose', 'Toloza', 'Rocha', 'Padre', 'm', '32379327', 'Sempegua', 'La Roca', 'Mototaxista', '325434654', 'Sempegua'),
(116, '1909785672', 'Deiner', 'Toloza', 'Marquez', 'Padre', 'm', '32126879', 'Sempegua', 'La Plaza', 'Pescador', '2343543', 'Sempegua'),
(117, '1075353747', 'Plinio', 'Toloza', 'Rocha', 'Padre', 'm', '3127665354', 'Sempegua', 'Divino NiÑo', 'Pescador', '3243534', 'Sempegua'),
(118, '124356665', 'Alexander', 'Villar', 'Gutierrez', 'Padre', 'm', '3215577888', 'Sempegua', 'La Playa', 'Pescador', '3235465634', 'Sempegua'),
(119, '1224645654', 'Jose', 'Ortega', 'Salazar', 'Padre', 'm', '24335435', 'Sempegua', 'La Plaza', 'Agricultor', '334454464', 'Sempegua'),
(120, '109765557', 'Francisco Jose', 'Pabon', 'Hernandez', 'Padre', 'm', '315897987', 'Sempegua', 'La Central', 'Comerciante', '23432423', 'Sempegua'),
(121, '1007657465', 'Gilberto', 'Acuna', 'Martinez', 'Padre', 'm', '325435345', 'Sempegua', 'La Plaza', 'Pescador', '32345445', 'Sempegua'),
(122, '1089745435', 'Alain Jose', 'Aragon', 'Toloza', 'Padre', 'm', '324556456', 'Sempegua', 'Divino NiÑo', 'Pescador', '3235645454', 'Sempegua'),
(123, '125076757', 'Daniel Andres', 'Berrueco', 'Santos', 'Padre', 'm', '3146657634', 'Sempegua', 'La Central', 'Comerciante', '3145756876', 'Sempegua'),
(124, '125076757', 'Daniel Andres', 'Berrueco', 'Santos', 'Padre', 'm', '3146657634', 'Sempegua', 'La Central', 'Comerciante', '3145756876', 'Sempegua'),
(125, '107655454', 'Jose Luis', 'Cabas', 'Zambrano', 'Padre', 'm', '33234534', 'Sempegua', 'La Paz', 'Guardia De Seguridad', '24234345', 'Sempegua'),
(126, '1098207', 'David Jose', 'Cavas', 'Gutierrez', 'Padre', 'm', '312235534', 'Sempegua', 'La Central', 'Agricultor', '32343453', 'Sempegua'),
(127, '109075564', 'Andres', 'Cuadro', 'Cadena', 'Padre', 'm', '31254353', 'Sempegua', 'La Plaza', 'Electricista', '31235435', 'Sempegua'),
(128, '109798677', 'Jose', 'Fernandez', 'Rocha', 'Padre', 'm', '318979789', 'Sempegua', 'La Paz', 'Pescador', '3243232323', 'Sempegua'),
(129, '1094525363', 'Santiago', 'Gomez', 'Pina', 'Padre', 'm', '3255436', 'Sempegua', 'La Roca', 'Pescador', '312456657', 'Sempegua'),
(130, '10897686', 'Luis', 'Gonzalez', 'Sarabia', 'Padre', 'm', '3212445454', 'Sempegua', 'La Plaza', 'Pescador', '3123455434', 'Sempegua'),
(131, '1087667454', 'Jose Miguel', 'Hernandez', 'Chamorro', 'Padre', 'm', '3124565654', 'Sempegua', 'Barrio Arriba', 'Locutor', '312454543', 'Sempegua'),
(132, '1037766554', 'Jhon', 'Hernandez', 'Jimenez', 'Padre', 'm', '3124743432', 'Sempegua', 'Divino NiÑo', 'AlbaÑil', '3132476534', 'Sempegua'),
(133, '1076765634', 'Jhon', 'Hernandez', 'Nobles', 'Padre', 'm', '2124543534', 'Sempegua', 'Divino NiÑo', 'AlbaÑil', '334453453', 'Sempegua'),
(134, '199087373', 'Ulices', 'Infante', 'Munoz', 'Padre', 'm', '312345543', 'Sempegua', 'La Central', 'Agricultor', '3124245', 'Sempegua'),
(135, '112355435', 'Alejandro', 'Leon', 'Pava', 'Padre', 'm', '3244325354', 'Sempegua', 'La Playa', 'Pescador', '2342423', 'Sempegua'),
(136, '10986286', 'David Andres', 'Mendez', 'Palomino', 'Padre', 'm', '2334534543', 'Sempegua', 'Las Palmas', 'Mototaxista', '24324234', 'Sempegua'),
(137, '106553453', 'Alberto', 'Miranda', 'Ramirez', 'Padre', 'm', '32354564', 'Sempegua', 'El Campo', 'Agricultor', '2345656', 'Sempegua'),
(138, '1906754442', 'Enrique', 'Nobles', 'Mendez', 'Padre', 'm', '32435345', 'Sempegua', 'La Roca', 'Pescador', '31323543', 'Sempegua'),
(139, '1244657989', 'Fabio', 'Nobles', 'Martinez', 'Padre', 'm', '324554645', 'Sempegua', 'La Esquina', 'Contratista', '3124566545', 'Sempegua'),
(140, '1873653736', 'Alfonso', 'Nobles', 'Martinez', 'Padre', 'm', '34345454', 'Sempegua', 'La Paz', 'AlbaÑil', '2343434', 'Sempegua'),
(141, '18976556', 'Humberto', 'Obregon', 'Contreras', 'Padre', 'm', '323435455', 'Sempegua', 'La Playa', 'Pescador', '3254656', 'Sempegua'),
(142, '1087657', 'Leonardo David', 'Otalora', 'Rocha', 'Padre', 'm', '312454466', 'Sempegua', 'Barrio Arriba', 'Eectricista', '2455654645', 'Sempegua'),
(143, '19897654', 'Lenin', 'Pacheco', 'Lopez', 'Padre', 'm', '123453455', 'Sempegua', 'Las Palmas', 'Pescador', '34354353', 'Sempegua'),
(144, '10987566', 'Misael', 'Pastrana', 'Paez', 'Padre', 'm', '32234353', 'Sempegua', 'La Playa', 'Ganadero', '3233535', 'Sempegua'),
(145, '1907875673', 'Neil', 'Ramirez', 'Perez', 'Padre', 'm', '3265565465', 'Sempegua', 'La Central', 'Mototaxista', '2345453', 'Sempegua'),
(146, '108765433', 'Luis Andres', 'Reales', 'Yanez', 'Padre', 'm', '2355464', 'Sempegua', 'El Campo', 'Comerciante', '234354343', 'Sempegua'),
(147, '1977686655', 'Enrique David', 'Reyna', 'Pedrozo', 'Padre', 'm', '32343535', 'Sempegua', 'La Playa', 'Pescador', '24454353', 'Sempegua'),
(148, '13535835', 'Roberto', 'Rico', 'Bolanos', 'Padre', 'm', '325354354', 'Sempegua', 'La Plaza', 'AlbaÑil', '3253534', 'Sempegua'),
(149, '19876844', 'Romario', 'Rocha', 'Toloza', 'Padre', 'm', '3254546', 'Sempegua', 'La Central', 'Pescador', '2343253', 'Sempegua'),
(150, '1989863443', 'Aramis', 'Toloza', 'Vides', 'Padre', 'm', '3254365464', 'Sempegua', 'Divino NiÑo', 'Pescador', '3124543543', 'Sempegua'),
(151, '1228087767', 'Mario', 'Toloza', 'Amaris', 'Padre', 'm', '325465654', 'Sempegua', 'La Plaza', 'Comerciante', '32343532', 'Sempegua'),
(152, '1076455744', 'Libardo Jose', 'Toloza', 'Nobles', 'Padre', 'm', '243543543', 'Sempegua', 'La Esquina', 'Comerciante', '24324343', 'Sempegua'),
(153, '1229473842', 'Yair', 'Toloza', 'Martinez', 'Padre', 'm', '315745444', 'Sempegua', 'La Esquina', 'Pescador', '3245445645', 'Sempegua'),
(154, '1046786857', 'Alberto', 'Waltero', 'Perez', 'Padre', 'm', '312455667', 'Sempegua', 'La Roca', 'Ganadero', '312245435', 'Sempegua'),
(155, '1057326667', 'Jose', 'Avila', 'Camacho', 'Padre', 'm', '3124354564', 'Sempegua', 'La Plaza', 'Agricultor', '321456567', 'Sempegua'),
(156, '1088967678', 'Angel David', 'Barrios', 'Guzman', 'Padre', 'm', '315678876', 'Sempegua', 'La Central', 'Docente', '3235676567', 'Sempegua'),
(157, '076373233', 'Julio', 'Cadena', 'Perez', 'Padre', 'm', '3157687087', 'Sempegua', 'La Playa', 'Pescador', '32546544', 'Sempegua'),
(158, '1947345673', 'Armando Jose', 'Cardenas', 'Escobar', 'Padre', 'm', '3123465464', 'Sempegua', 'La Central', 'Pescador', '324345435', 'Sempegua'),
(159, '1987856575', 'Santiago Jose', 'Diaz', 'Garcia', 'Padre', 'm', '32334546', 'Sempegua', 'La Central', 'Electricista', '325435433', 'Sempegua'),
(160, '190626785', 'Libardo', 'Florez', 'Nobles', 'Padre', 'm', '323244789', 'Sempegua', 'La Central', 'Comerciante', '233543534', 'Sempegua'),
(161, '108876354', 'Luis Jose', 'Infante', 'Martinez', 'Padre', 'm', '3256575657', 'Sempegua', 'Divino NiÑo', 'Electricista', '3255465507', 'Sempegua'),
(162, '1836546433', 'Ramiro', 'Leon', 'Nunez', 'Padre', 'm', '332435345', 'Sempegua', 'La Playa', 'Pescador', '3543543543', 'Sempegua'),
(163, '1076563275', 'Marcos', 'Medina', 'Rocha', 'Padre', 'm', '3124546546', 'Sempegua', 'La Esquina', 'Agricultor', '312435454', 'Sempegua'),
(164, '190734632', 'Pablo Emilio', 'Miranda', 'Gaviria', 'Padre', 'm', '323435435', 'Sempegua', 'La Paz', 'AlbaÑil', '321343534', 'Sempegua'),
(165, '2078478443', 'Sadith', 'Pabon', 'Cerpa', 'Padre', 'm', '3124565654', 'Sempegua', 'Las Palmas', 'Pescador', '312465465', 'Sempegua'),
(166, '352332398', 'Daniel Andres', 'Perez', 'Caballero', 'Padre', 'm', '3223898797', 'Sempegua', 'Divino NiÑo', 'Agricultor', '235345345', 'Sempegua'),
(167, '289093536', 'Juan', 'Rangel', 'Toloza', 'Padre', 'm', '312566786', 'Sempegua', 'La Paz', 'Pescador', '323565464', 'Sempegua'),
(168, '190389632', 'Edinson', 'Rondon', 'Ruiz', 'Padre', 'm', '323543345', 'Sempegua', 'La Paz', '´pescador', '325543554', 'Sempegua'),
(169, '189677387', 'Saul', 'Toloza', 'Lascarro', 'Padre', 'm', '323545343', 'Sempegua', 'La Central', 'Pescador', '3243245532', 'Sempegua'),
(170, '1098764385', 'Jamer', 'Valle', 'Nobles', 'Padre', 'm', '3167567776', 'Sempegua', 'Barrio Arriba', 'Pescador', '3124455676', 'Sempegua'),
(171, '3255678087', 'Arnaldo', 'Villar', 'Jimenez', 'Padre', 'm', '3125698047', 'Sempegua', 'La Plaza', 'Pescador', '314804034', 'Sempegua'),
(172, '1987683654', 'Danilo', 'Gutierrez', 'Silva', 'Padre', 'm', '324356675', 'Sempegua', 'La Central', 'Agricultor', '2342352423', 'Sempegua'),
(173, '1907654654', 'Eidilson', 'Leon', 'Garrido', 'Padre', 'm', '3176778034', 'Sempegua', 'La Plaza', 'Pescador', '32534645', 'Sempegua'),
(174, '1087653824', 'Daniel Andres', 'Martinez', 'Hernandez', 'Padre', 'm', '3235435645', 'Sempegua', 'La Paz', 'Agricultor', '2346554645', 'Sempegua'),
(175, '190897763', 'Saul Andres', 'Martinez', 'Rocha', 'Padre', 'm', '32348963', 'Sempegua', 'La Playa', 'Pescador', '3123545676', 'Sempegua'),
(176, '1097736433', 'Dario', 'Mejia', 'Ramos', 'Padre', 'm', '312345464', 'Sempegua', 'Barrio Arriba', 'Pescador', '324342425', 'Sempegua'),
(177, '109879363', 'Ivaldo', 'Nobles', 'Lopez', 'Padre', 'm', '312354364', 'Sempegua', 'El Campo', 'Agricultor', '3129505644', 'Sempegua'),
(178, '190364323', 'Juvenal', 'Nobles', 'Martinez', 'Padre', 'm', '314325345', 'Sempegua', 'La Paz', 'Plomero', '3124387537', 'Sempegua'),
(179, '109873643', 'Pablo Cesar', 'Ortega', 'Diaz', 'Padre', 'm', '3128768743', 'Sempegua', 'La Playa', 'Pescador', '312432235', 'Sempegua'),
(180, '198763542', 'Pablo Cesar', 'Ortega', 'Diaz', 'Padre', 'm', '323584357', 'Sempegua', 'La Playa', 'Pescador', '323353535', 'Sempegua'),
(181, '1903742334', 'Sergio Alberto', 'Rico', 'Ramirez', 'Padre', 'm', '343254325', 'Sempegua', 'La Plaza', 'Agricultor', '3124353534', 'Sempegua'),
(182, '1000973643', 'Sergio Alberto', 'Rico', 'Ramirez', 'Padre', 'm', '3121453454', 'Sempegua', 'La Plaza', 'Agricultor', '3124436686', 'Sempegua'),
(183, '1097382343', 'Dairo', 'Rodriguez', 'Medina', 'Padre', 'm', '31254543', 'Sempegua', 'La Central', 'Comerciante', '32354654', 'Sempegua'),
(184, '124983842', 'Luis Andres', 'Suarez', 'Caballero', 'Padre', 'm', '312435435', 'Sempegua', 'La Roca', 'Pescador', '3234543543', 'Sempegua'),
(185, '10984754', 'Luis Angel', 'Toloza', 'Rocha', 'Padre', 'm', '312345446', 'Sempegua', 'Divino NiÑo', 'Agricultor', '33123432', 'Sempegua'),
(186, '1987634543', 'David Jose', 'Toloza', 'Palomino', 'Padre', 'm', '312432874', 'Sempegua', 'La Central', 'Agricultor', '31245436', 'Sempegua'),
(187, '1807532563', 'David Jose', 'Toloza', 'Palomino', 'Padre', 'm', '3124436547', 'Sempegua', 'La Central', 'Agricultor', '213432523', 'Sempegua'),
(188, '9083476835', 'Andres Fernando', 'Toloza', 'Nobles', 'Padre', 'm', '312446456', 'Sempegua', 'Barrio Arriba', 'Pescador', '32343543', 'Sempegua'),
(189, '20976253', 'Albeiro Enrique', 'Toloza', 'Rocha', 'Padre', 'm', '31245646', 'Sempegua', 'La Plaza', 'Pescador', '31233543', 'Sempegua'),
(190, '109876443', 'Raul Jose', 'Toloza', 'Sarmiento', 'Padre', 'm', '312435436', 'Sempegua', 'La Playa', 'Pescador', '3157888975', 'Sempegua'),
(191, '1038763', 'Raul Jose', 'Toloza', 'Sarmiento', 'Padre', 'm', '31243225', 'Sempegua', 'La Playa', 'Pescador', '3135464', 'Sempegua'),
(192, '1087365432', 'Yamith', 'Torres', 'Gamez', 'Padre', 'm', '326768238', 'Sempegua', 'Las Palmas', 'Comerciante', '3124863265', 'Sempegua'),
(193, '1937849634', 'Yesid', 'Vega', 'Ruiz', 'Padre', 'm', '315894332', 'Sempegua', 'Divino NiÑo', 'Pescador', '3254645723', 'Sempegua'),
(194, '1837436376', 'Martin', 'Velasquez', 'Luna', 'Padre', 'm', '31895745', 'Sempegua', 'El Campo', 'Pescador', '34546452', 'Sempegua'),
(195, '1023743535', 'Luis Alberto', 'Villar', 'Lobos', 'Padre', 'm', '3123434564', 'Sempegua', 'La Paz', 'Pescador', '3325435436', 'Sempegua'),
(196, '184347343', 'Denis Jose', 'Villarreal', 'Toloza', 'Padre', 'm', '323554564', 'Sempegua', 'La Plaza', 'Agricultor', '3126547756', 'Sempegua'),
(197, '347767565', 'Carlos Alberto', 'Waltero', 'Jaramillo', 'Padre', 'm', '313766878', 'Sempegua', 'La Roca', 'Agricultor', '3126457654', 'Sempegua');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_concepto_pago` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `mes_liquidado` varchar(25) NOT NULL,
  `fecha_pago` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id_pais` int(11) NOT NULL,
  `nombre_pais` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id_pais`, `nombre_pais`) VALUES
(1, 'Colombia'),
(2, 'Afganistán'),
(3, 'Albania'),
(4, 'Alemania'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Antigua y Barbuda'),
(8, 'Arabia Saudita'),
(9, 'Argelia'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Australia'),
(13, 'Austria'),
(14, 'Azerbaiyán'),
(15, 'Bahamas'),
(16, 'Bangladés'),
(17, 'Barbados'),
(18, 'Baréin'),
(19, 'Bélgica'),
(20, 'Belice'),
(21, 'Benín'),
(22, 'Bielorrusia'),
(23, 'Birmania'),
(24, 'Bolivia'),
(25, 'Bosnia y Herzegovina'),
(26, 'Botsuana'),
(27, 'Brasil'),
(28, 'Brunéi'),
(29, 'Bulgaria'),
(30, 'Burkina Faso'),
(31, 'Burundi'),
(32, 'Bután'),
(33, 'Cabo Verde'),
(34, 'Camboya'),
(35, 'Camerún'),
(36, 'Canadá'),
(37, 'Catar'),
(38, 'Chad'),
(39, 'Chile'),
(40, 'China'),
(41, 'Chipre'),
(42, 'Ciudad del Vaticano'),
(43, 'Comoras'),
(44, 'Corea del Norte'),
(45, 'Corea del Sur'),
(46, 'Costa de Marfil'),
(47, 'Costa Rica'),
(48, 'Croacia'),
(49, 'Cuba'),
(50, 'Dinamarca'),
(51, 'Dominica'),
(52, 'Ecuador'),
(53, 'Egipto'),
(54, 'El Salvador'),
(55, 'Emiratos Árabes Unidos'),
(56, 'Eritrea'),
(57, 'Eslovaquia'),
(58, 'Eslovenia'),
(59, 'España'),
(60, 'Estados Unidos'),
(61, 'Estonia'),
(62, 'Etiopía'),
(63, 'Filipinas'),
(64, 'Finlandia'),
(65, 'Fiyi'),
(66, 'Francia'),
(67, 'Gabón'),
(68, 'Gambia'),
(69, 'Georgia'),
(70, 'Ghana'),
(71, 'Granada'),
(72, 'Grecia'),
(73, 'Guatemala'),
(74, 'Guyana'),
(75, 'Guinea'),
(76, 'Guinea-Bisáu'),
(77, 'Guinea Ecuatorial'),
(78, 'Haití'),
(79, 'Honduras'),
(80, 'Hungría'),
(81, 'India'),
(82, 'Indonesia'),
(83, 'Irak'),
(84, 'Irán'),
(85, 'Irlanda'),
(86, 'Islandia'),
(87, 'Islas Marshall'),
(88, 'Islas Salomón'),
(89, 'Israel'),
(90, 'Italia'),
(91, 'Jamaica'),
(92, 'Japón'),
(93, 'Jordania'),
(94, 'Kazajistán'),
(95, 'Kenia'),
(96, 'Kirguistán'),
(97, 'Kiribati'),
(98, 'Kuwait'),
(99, 'Laos'),
(100, 'Lesoto'),
(101, 'Letonia'),
(102, 'Líbano'),
(103, 'Liberia'),
(104, 'Libia'),
(105, 'Liechtenstein'),
(106, 'Lituania'),
(107, 'Luxemburgo'),
(108, 'Madagascar'),
(109, 'Malasia'),
(110, 'Malaui'),
(111, 'Maldivas'),
(112, 'Malí'),
(113, 'Malta'),
(114, 'Marruecos'),
(115, 'Mauricio'),
(116, 'Mauritania'),
(117, 'México'),
(118, 'Micronesia'),
(119, 'Moldavia'),
(120, 'Mónaco'),
(121, 'Mongolia'),
(122, 'Montenegro'),
(123, 'Mozambique'),
(124, 'Namibia'),
(125, 'Nauru'),
(126, 'Nepal'),
(127, 'Nicaragua'),
(128, 'Níger'),
(129, 'Nigeria'),
(130, 'Noruega'),
(131, 'Nueva Zelanda'),
(132, 'Omán'),
(133, 'Países Bajos'),
(134, 'Pakistán'),
(135, 'Palaos'),
(136, 'Panamá'),
(137, 'Papúa Nueva Guinea'),
(138, 'Paraguay'),
(139, 'Perú'),
(140, 'Polonia'),
(141, 'Portugal'),
(142, 'Reino Unido de Gran Bretaña e Irlanda del Nor'),
(143, 'República Centroafricana'),
(144, 'República Checa'),
(145, 'República de Macedonia'),
(146, 'República del Congo'),
(147, 'República Democrática del Congo'),
(148, 'República Dominicana'),
(149, 'República Sudafricana'),
(150, 'Ruanda'),
(151, 'Rumanía'),
(152, 'Rusia'),
(153, 'Samoa'),
(154, 'San Cristóbal y Nieves'),
(155, 'San Marino'),
(156, 'San Vicente y las Granadinas'),
(157, 'Santa Lucía'),
(158, 'Santo Tomé y Príncipe'),
(159, 'Senegal'),
(160, 'Serbia'),
(161, 'Seychelles'),
(162, 'Sierra Leona'),
(163, 'Singapur'),
(164, 'Siria'),
(165, 'Somalia'),
(166, 'Sri Lanka'),
(167, 'Suazilandia'),
(168, 'Sudán'),
(169, 'Sudán del Sur'),
(170, 'Suecia'),
(171, 'Suiza'),
(172, 'Surinam'),
(173, 'Tailandia'),
(174, 'Tanzania'),
(175, 'Tayikistán'),
(176, 'Timor Oriental'),
(177, 'Togo'),
(178, 'Tonga'),
(179, 'Trinidad y Tobago'),
(180, 'Túnez'),
(181, 'Turkmenistán'),
(182, 'Turquía'),
(183, 'Tuvalu'),
(184, 'Ucrania'),
(185, 'Uganda'),
(186, 'Uruguay'),
(187, 'Uzbekistán'),
(188, 'Vanuatu'),
(189, 'Venezuela'),
(190, 'Vietnam'),
(191, 'Yemen'),
(192, 'Yibuti'),
(193, 'Zambia'),
(194, 'Zimbabue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pensum`
--

CREATE TABLE `pensum` (
  `id_pensum` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `intensidad_horaria` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `estado_pensum` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pensum`
--

INSERT INTO `pensum` (`id_pensum`, `id_grado`, `id_asignatura`, `intensidad_horaria`, `ano_lectivo`, `estado_pensum`) VALUES
(1, 9, 4, 1, 1, 'Activo'),
(2, 9, 3, 1, 1, 'Activo'),
(3, 9, 5, 1, 1, 'Activo'),
(4, 9, 6, 1, 1, 'Activo'),
(5, 9, 7, 1, 1, 'Activo'),
(6, 9, 8, 1, 1, 'Activo'),
(7, 9, 10, 1, 1, 'Activo'),
(8, 9, 9, 1, 1, 'Activo'),
(9, 9, 11, 4, 1, 'Activo'),
(10, 9, 12, 3, 1, 'Activo'),
(11, 9, 2, 4, 1, 'Activo'),
(12, 9, 13, 2, 1, 'Activo'),
(13, 9, 14, 2, 1, 'Activo'),
(14, 9, 15, 2, 1, 'Activo'),
(15, 9, 16, 1, 1, 'Activo'),
(16, 9, 17, 2, 1, 'Activo'),
(17, 9, 18, 2, 1, 'Activo'),
(18, 10, 4, 1, 1, 'Activo'),
(19, 10, 3, 1, 1, 'Activo'),
(20, 10, 5, 1, 1, 'Activo'),
(21, 10, 6, 1, 1, 'Activo'),
(22, 10, 9, 1, 1, 'Activo'),
(23, 10, 7, 1, 1, 'Activo'),
(24, 10, 10, 1, 1, 'Activo'),
(25, 10, 8, 1, 1, 'Activo'),
(26, 10, 11, 4, 1, 'Activo'),
(27, 10, 12, 3, 1, 'Activo'),
(28, 10, 2, 4, 1, 'Activo'),
(29, 10, 13, 2, 1, 'Activo'),
(30, 10, 15, 2, 1, 'Activo'),
(31, 10, 16, 2, 1, 'Activo'),
(32, 10, 17, 2, 1, 'Activo'),
(33, 10, 18, 2, 1, 'Activo'),
(34, 7, 4, 1, 1, 'Activo'),
(35, 7, 3, 1, 1, 'Activo'),
(36, 7, 5, 1, 1, 'Activo'),
(37, 7, 6, 1, 1, 'Activo'),
(38, 7, 7, 1, 1, 'Activo'),
(39, 7, 8, 1, 1, 'Activo'),
(40, 7, 9, 1, 1, 'Activo'),
(41, 7, 10, 1, 1, 'Activo'),
(42, 7, 11, 4, 1, 'Activo'),
(43, 7, 12, 5, 1, 'Activo'),
(44, 7, 2, 4, 1, 'Activo'),
(45, 7, 13, 2, 1, 'Activo'),
(46, 7, 14, 2, 1, 'Activo'),
(47, 7, 15, 2, 1, 'Activo'),
(48, 7, 16, 2, 1, 'Activo'),
(49, 7, 17, 2, 1, 'Activo'),
(50, 7, 18, 2, 1, 'Activo'),
(51, 7, 19, 1, 1, 'Activo'),
(52, 8, 4, 1, 1, 'Activo'),
(53, 8, 3, 1, 1, 'Activo'),
(54, 8, 5, 1, 1, 'Activo'),
(55, 8, 6, 1, 1, 'Activo'),
(56, 8, 7, 1, 1, 'Activo'),
(57, 8, 8, 1, 1, 'Activo'),
(58, 8, 9, 1, 1, 'Activo'),
(59, 8, 10, 1, 1, 'Activo'),
(60, 8, 11, 4, 1, 'Activo'),
(61, 8, 12, 3, 1, 'Activo'),
(62, 8, 2, 4, 1, 'Activo'),
(63, 8, 13, 2, 1, 'Activo'),
(64, 8, 14, 2, 1, 'Activo'),
(65, 8, 15, 2, 1, 'Activo'),
(66, 8, 16, 2, 1, 'Activo'),
(67, 8, 17, 2, 1, 'Activo'),
(68, 8, 18, 2, 1, 'Activo'),
(69, 8, 19, 1, 1, 'Activo'),
(70, 5, 20, 4, 1, 'Activo'),
(71, 5, 2, 5, 1, 'Activo'),
(72, 5, 11, 5, 1, 'Activo'),
(73, 5, 12, 1, 1, 'Activo'),
(74, 5, 14, 2, 1, 'Activo'),
(75, 5, 15, 1, 1, 'Activo'),
(76, 5, 13, 1, 1, 'Activo'),
(77, 5, 16, 1, 1, 'Activo'),
(78, 5, 17, 1, 1, 'Activo'),
(79, 5, 19, 1, 1, 'Activo'),
(80, 5, 21, 4, 1, 'Activo'),
(81, 9, 19, 1, 1, 'Activo'),
(82, 10, 19, 1, 1, 'Activo'),
(83, 10, 14, 2, 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `identificacion` varchar(15) NOT NULL,
  `tipo_id` varchar(2) NOT NULL,
  `fecha_expedicion` date DEFAULT NULL,
  `pais_expedicion` int(11) DEFAULT NULL,
  `departamento_expedicion` int(11) DEFAULT NULL,
  `municipio_expedicion` int(11) DEFAULT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellido1` varchar(45) NOT NULL,
  `apellido2` varchar(45) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `pais_nacimiento` int(11) DEFAULT NULL,
  `departamento_nacimiento` int(11) DEFAULT NULL,
  `municipio_nacimiento` int(11) DEFAULT NULL,
  `tipo_sangre` varchar(2) DEFAULT NULL,
  `eps` varchar(45) DEFAULT NULL,
  `poblacion` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `barrio` varchar(45) DEFAULT NULL,
  `pais_residencia` int(11) DEFAULT NULL,
  `departamento_residencia` int(11) DEFAULT NULL,
  `municipio_residencia` int(11) DEFAULT NULL,
  `estrato` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `identificacion`, `tipo_id`, `fecha_expedicion`, `pais_expedicion`, `departamento_expedicion`, `municipio_expedicion`, `nombres`, `apellido1`, `apellido2`, `sexo`, `fecha_nacimiento`, `pais_nacimiento`, `departamento_nacimiento`, `municipio_nacimiento`, `tipo_sangre`, `eps`, `poblacion`, `telefono`, `email`, `direccion`, `barrio`, `pais_residencia`, `departamento_residencia`, `municipio_residencia`, `estrato`) VALUES
(1, '0902-73301', 'cc', '2017-04-10', 1, 20, 404, 'Siescolar', ' ', ' ', 'm', '2017-04-10', 1, 20, 404, 'o+', 'ninguna', 'ninguna', '3135028786', 'siescolar@gmail.com', 'calle 7 # 29-90', 'nueva esperanza', 1, 20, 404, '1'),
(2, '0901-72200', 'cc', '2018-01-25', 1, 20, 404, 'Voto', 'En', 'Blanco', 'm', '2018-01-25', 1, 20, 404, 'o+', 'ninguna', 'ninguna', '3000000000', 'blanco@gmail.com', 'calle 123', 'blanco', 1, 20, 404, '1'),
(3, '26729304', 'cc', '1991-07-27', 1, 20, 404, 'Nereida', 'Palomino', 'Cerpa', 'f', '1973-04-12', 1, 20, 404, NULL, NULL, NULL, '3206919220', 'nepace@outlook.com', 'Sempegua', 'La Paz', 1, 20, 404, '1'),
(4, '49752209', 'cc', '1991-07-07', 1, 20, 410, 'Elsa Elena', 'Cardiles', 'Fragozo', 'f', '1971-03-11', 1, 20, 404, NULL, NULL, NULL, '3135417974', 'elsa@outlook.com', 'Chimichagua', 'Chimichagua', 1, 20, 410, '2'),
(5, '77142026', 'cc', '1991-07-07', 1, 20, 410, 'Humberto', 'Reales', 'Rodriguez', 'f', '1962-09-27', 1, 20, 410, NULL, NULL, NULL, '3182827796', 'humberto@outlook.com', 'Sempegua', 'Sempegua', 1, 20, 410, '2'),
(6, '1065618575', 'ti', '2000-01-01', 1, 20, 410, 'Jeimar David', 'Bello', 'Ospino', 'm', '2008-07-14', 1, 20, 410, 'o+', 'Ninguna', 'Ninguna', '3145677854', 'jeimar@hotmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(7, '1066287536', 'ti', '2000-01-01', 1, 20, 410, 'Liliana Martha', 'Bello', 'Ospino', 'f', '2010-02-13', 1, 20, 410, 'o+', 'Ninguna', 'Ninguna', '3145677854', 'liliana@gmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(8, '1063491322', 'rc', '2000-01-01', 1, 20, 410, 'Andres Felipe', 'Cabas', 'Lopez', 'm', '2011-09-16', 1, 20, 410, 'o+', 'Ninguna', 'Ninguna', '3145097856', 'andresf@gmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(9, '1063491643', 'rc', '2000-01-01', 1, 20, 410, 'Danna Paola', 'Cardenas', 'Toloza', 'f', '2012-02-22', 1, 20, 410, 'o+', 'Salud Total', 'Ninguna', '3134567892', 'danna@gmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(10, '1063490292', 'rc', '2000-01-01', 1, 20, 410, 'Sara Patricia', 'Guerrero', 'Gamarra', 'f', '2018-10-18', 1, 20, 410, 'o+', 'Ninguna', 'Ninguna', '3129999999', 'sara@gmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(11, '1064707136', 'ti', '2000-01-01', 1, 20, 410, 'Juan David', 'Barragan', 'Castaneda', 'm', '2004-08-03', 1, 20, 410, 'o+', 'Ninguna', 'Ninguna', '3126789056', 'juanda@hotmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(12, '19655049', 'cc', '1991-07-07', 1, 20, 410, 'Alvaro', 'Morales', 'Mendoza', 'm', '1952-12-30', 1, 20, 410, NULL, NULL, NULL, '3125327605', 'alvaro@outlook.com', 'Chimichagua', 'Chimichagua', 1, 20, 410, '2'),
(13, '1063480243', 'ti', '2000-01-01', 1, 20, 410, 'Adriana Yesmith', 'Guerrero', 'Cadena', 'f', '2003-12-01', 1, 20, 410, 'o+', 'Ninguna', 'Ninguna', '314000000', 'adriana@hotmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(14, '26723432', 'cc', '1991-07-07', 1, 20, 410, 'Ana Julia', 'Palomino', 'Paba', 'f', '1960-12-18', 1, 20, 410, NULL, NULL, NULL, '3135157938', 'ana@outlook.com', 'Chimichagua', 'Chimichagua', 1, 20, 410, '2'),
(15, '1063480230', 'ti', '2000-01-01', 1, 20, 410, 'Jose Gregorio', 'Guerrero', 'Martinez', 'm', '2003-05-07', 1, 20, 410, 'o+', 'Ninguna', 'Ninguna', '3120000000', 'jj@hotmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(16, '26723477', 'cc', '1991-08-07', 1, 20, 410, 'Melva Felicia', 'Lopez', 'Reales', 'f', '1959-09-09', 1, 20, 410, NULL, NULL, NULL, '3107042123', 'melva@outlook.com', 'Chimichagua', 'Chimichagua', 1, 20, 410, '2'),
(17, '33213766', 'cc', '1991-07-07', 1, 13, 152, 'Edelmira', 'Mendez', 'Hernandez', 'f', '1971-11-22', 1, 13, 152, NULL, NULL, NULL, '3116794066', 'edelmira@outlook.com', 'Sempegua', 'Sempegua', 1, 20, 410, '2'),
(18, '1007593618', 'ti', '2001-01-01', 1, 20, 410, 'Juan Jose', 'Gutierrez', 'Obregon', 'm', '2002-02-07', 1, 20, 410, 'o+', 'Ninguna', 'Ninguna', '3145678967', 'juanjo@gmail.com', 'Sempegua', 'La Paz', 1, 20, 404, '1'),
(19, '33218816', 'cc', '1991-07-07', 1, 20, 410, 'Bilmaris', 'Berruecos', 'Reales', 'f', '1976-06-03', 1, 20, 410, NULL, NULL, NULL, '3107193176', 'bilmaris@outlook.com', 'Sempgua', 'Sempgua', 1, 20, 410, '2'),
(20, '1063482013', 'ti', '2000-01-01', 1, 20, 404, 'Angel David', 'Mendez', 'Cabas', 'm', '2003-03-04', 1, 20, 404, 'o+', 'Ninguna', 'Ninguna', '3155678905', 'angel@hotmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '2'),
(21, '1148198927', 'cc', '1991-07-07', 1, 20, 410, 'Danixa', 'Alfaro', 'Miranda', 'f', '1992-08-24', 1, 20, 410, NULL, NULL, NULL, '3108418652', 'danixa@outlook.com', 'Sempegua', 'Sempegua', 1, 20, 410, '2'),
(22, '32492228', 'ti', '2000-01-01', 1, 20, 404, 'Jholger', 'Nobles', 'Mendez', 'm', '2018-10-18', 1, 20, 404, 'o+', 'Ninguna', 'Ninguna', '12345678', 'jnobles@gmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(23, '77142630', 'cc', '1991-07-07', 1, 20, 410, 'Marcial', 'Barros', 'Lopez', 'm', '1965-08-23', 1, 20, 410, NULL, NULL, NULL, '3135349627', 'marcial@outlook.com', 'Chimichagua', 'Chimichagua', 1, 20, 410, '2'),
(24, '1063482622', 'ti', '2018-10-23', 1, 20, 404, 'Doris Adriana', 'Nobles', 'Quevedo', 'f', '2018-10-23', 1, 20, 410, 'o+', 'N', 'Ninguna', '1234567', 'dra@gmail.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(25, '49751873', 'cc', '1991-07-07', 1, 20, 410, 'Aracelis', 'Martinez', 'Vergel', 'f', '1970-02-05', 1, 20, 404, NULL, NULL, NULL, '3126301747', 'aracelis@outlook.com', 'Chimichagua', 'Chimichagua', 1, 20, 410, '2'),
(26, '0300131', 'rc', '2018-10-23', 1, 20, 404, 'Ana Karina', 'Ortiz', 'Mendez', 'f', '2018-10-23', 1, 20, 404, 'o+', 'N', 'Ninguna', '23456', 'anak@gmail.com', 'S', 'La Paz', 1, 20, 404, '3'),
(27, '49751761', 'cc', '1991-07-07', 1, 20, 410, 'Laudith Cristina', 'Queruz', 'Amaris', 'f', '1970-11-06', 1, 20, 410, NULL, NULL, NULL, '3126925793', 'laudith@outlook.com', 'Chimichagua', 'Chimichagua', 1, 20, 410, '2'),
(28, '10432262', 'rc', '2000-01-01', 1, 17, 319, 'Carol Nathalia', 'Pacheco', 'Nobles', 'f', '2018-10-23', 1, 17, 319, 'o+', 'N', 'Ninguna', '34567890', 'pacheco@hotmail.com', 'Sdfghjk', 'Fghjklñ', 1, 20, 410, '2'),
(29, '32547604', 'ti', '2018-10-23', 1, 20, 404, 'Karen Paola', 'Ramirez', 'Mendez', 'f', '2018-10-23', 1, 20, 404, 'o+', 'N', 'Ninguna', '4567890', 'pao@gmail.com', 'Dfghjkl', '67890', 1, 20, 410, '2'),
(30, '1003238580', 'ti', '2018-10-23', 1, 20, 404, 'Juan Jose', 'Rico', 'Nobles', 'm', '2018-10-23', 1, 20, 404, 'o+', 'N', 'Ninguna', '45690', 'juacho@hotmail.com', 'Calle 34', 'Ddddd', 1, 20, 404, '1'),
(31, '49724561', 'cc', '1991-07-07', 1, 20, 410, 'Irina Judith', 'Florez', 'Cardenas', 'f', '1984-01-08', 1, 20, 410, NULL, NULL, NULL, '3114298452', 'irina@outlook.com', 'Chimichagua', 'Chimichagua', 1, 20, 410, '2'),
(32, '7152010', 'cc', '1991-07-07', 1, 20, 410, 'Olger E', 'Florez', 'Vanegas', 'm', '1991-10-14', 1, 20, 410, NULL, NULL, NULL, '3003587067', 'olger@outlook.com', 'Sempegua', 'Sempegua', 1, 20, 410, '2'),
(33, '7151495', 'ti', NULL, NULL, NULL, NULL, 'Jesus Aldo', 'Nobles', 'Mendez', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, '3114143649', 'jesus@outlook.com', 'Sempegua', 'Sempegua', NULL, NULL, NULL, NULL),
(34, '1063482612', 'ti', '2018-10-12', 3, 101, 1122, 'Ximena', 'Acuna', 'Toloza', 'f', '2018-10-24', 1, 20, 404, 'o+', 'Ninguna', 'Ninguna', '3456789', 'ximena@gmail.com', 'Sdfghjk', 'Sdfghjkl', 2, 100, 1121, '2'),
(35, '1003087700', 'ti', '2018-10-24', 2, 100, 1121, 'Maria Camila', 'Cabas', 'Crespo', 'f', '2018-10-25', 15, 113, 1134, 'o+', 'N', 'Ninguna', '34567890', 'mca@gmail.com', 'Dfghjkl', 'Fghjkl??', 2, 100, 1121, '3'),
(36, '1063481522', 'ti', '2011-02-07', 1, 20, 410, 'Ana Karina', 'Toloza', 'Silva', 'f', '2003-09-07', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'jesus@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 410, '1'),
(37, '1063481489', 'ti', '2018-10-24', 6, 104, 1125, 'Elais', 'Cabas', 'Toloza', 'f', '2018-10-18', 2, 100, 1121, 'o+', 'N', 'Ninguna', '4567890', 'elaisc@gmail.com', 'Sdfghjkl', 'Dfghjk', 1, 52, 714, '3'),
(38, '1002354085', 'ti', '2018-10-24', 2, 100, 1121, 'Dallanis', 'Cardenas', 'Raad', 'f', '2018-10-24', 1, 5, 1, 'o+', 'N', 'Ninguna', '34567890', 'louve@gmail.com', 'Dfghjkl', '567890', 2, 100, 1121, '2'),
(39, '1063482078', 'ti', '2011-04-06', 1, 20, 410, 'Yureinis Tatiana', 'Toloza', 'Mieles', 'f', '2004-04-06', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'jesus@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 410, '1'),
(40, '1007593353', 'ti', '2018-10-24', 2, 100, 1121, 'Virginia Mayela', 'De Hoyos', 'Suarez', 'f', '2018-10-22', 1, 8, 126, 'o+', 'N', 'Ninguna', '3456789', 'vg@hotmail.com', 'Fgkl', 'Fghjkl', 1, 52, 714, '2'),
(41, '1063482864', 'ti', '2012-11-05', 1, 20, 410, 'Luis Mario', 'Rocha', 'Toloza', 'm', '2004-11-05', 1, 20, 404, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'jesus@outlook.com', 'Sempegua', 'Sempegua', 1, 20, 410, '1'),
(42, '1063481496', 'ti', '2018-10-24', 2, 100, 1121, 'Zharik Alejandra', 'Florez', 'Nunez', 'f', '2018-10-16', 3, 101, 1122, 'o+', 'N', 'Ninguna', '34567890', 'zh@hotmail.com', 'Ertyui', 'Dfghjk', 1, 47, 655, '2'),
(43, '1063480248', 'ti', '2018-10-23', 3, 101, 1122, 'Maria Alejandra', 'Guerrero', 'Gamarra', 'f', '2018-10-10', 2, 100, 1121, 'o+', 'N', 'Ninguna', '33434', 'mj@hotmail.ccom', 'Dddfdf', 'Fdfdfd', 2, 100, 1121, '3'),
(44, '1063480824', 'ti', '2011-07-07', 1, 20, 410, 'Karol Juliana', 'Rocha', 'Toloza', 'f', '2006-07-07', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'jesus@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 410, '2'),
(45, '1063481180', 'cc', '2018-10-17', 1, 8, 126, 'Marloys', 'Martinez', 'Contreras', 'f', '2018-10-17', 1, 54, 778, 'o+', 'Nnn', 'Ninguna', '323232', 'marloys@hotmail.com', '23232323', '3232323', 2, 100, 1121, '2'),
(46, '0255084', 'rc', '2011-07-07', 1, 20, 410, 'Juan Camilo', 'Rocha', 'Toloza', 'm', '2006-07-07', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'jesus@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 404, '2'),
(47, '1063481789', 'ti', '2018-10-25', 2, 44, 650, 'Jhon Deivis', 'Martinez', 'Miranda', 'm', '2018-10-12', 1, 11, 149, 'o+', 'N', 'Ninguna', '45689', 'jjj@gmail.com', '3456789', '3456789', 1, 8, 126, '3'),
(48, '1007247399', 'ti', '2018-10-16', 2, 100, 1121, 'Jesus Manuel', 'Medina', 'Martinez', 'm', '2018-10-23', 2, 100, 1121, 'o+', 'Rererer', 'Ninguna', '567890', 'jesys@hotmail.com', 'Sdfghjk', 'Fghjkl', 1, 5, 1, '3'),
(49, '0255092', 'rc', '2011-07-07', 1, 20, 410, 'Jhonatan David', 'Rocha', 'Garcia', 'm', '2006-07-07', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'jesus@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 410, '2'),
(50, '1063482030', 'ti', '2018-10-17', 15, 113, 1134, 'Sarays', 'Medina', 'Martinez', 'm', '2018-10-09', 2, 100, 1121, 'o+', '4567890', 'Ninguna', '456789', 'saray@hotmail.com', '3456789', 'Fghkl', 1, 41, 603, '2'),
(51, '1063480826', 'ti', '2018-10-08', 16, 114, 1135, 'Dayana', 'Nobles', 'Jimenes', 'f', '2018-10-09', 3, 101, 1122, 'o+', 'Rrrtrt', 'Ninguna', '4567890', 'nobles@gmail.com', '456789', 'Fghjkl', 1, 50, 685, '2'),
(52, '1063482620', 'ti', '2011-04-28', 1, 20, 410, 'Yasir Alejandro', 'Reales', 'Cadena', 'm', '2004-04-28', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'jesus@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 410, '1'),
(53, '77175911', 'cc', NULL, NULL, NULL, NULL, 'Jose Miguel', 'Hernandez', 'Chamorro', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, '3126573421', 'josemiguel@gmail.com', 'Semepgua', 'La Paz', NULL, NULL, NULL, NULL),
(54, '77175912', 'cc', NULL, NULL, NULL, NULL, 'Marielis', 'Hernandez', 'Chamorro', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, '3126753428', 'marielis@gmail.com', 'Sempegua', 'La Paz', NULL, NULL, NULL, NULL),
(55, '77175913', 'cc', NULL, NULL, NULL, NULL, 'Adriana Gisella', 'Nobles', 'Palomino', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, '3126784523', 'adriana@gmail.com', 'Semepgua', 'La Paz', NULL, NULL, NULL, NULL),
(56, '77175914', 'cc', NULL, NULL, NULL, NULL, 'Ana Milena', 'Contreras', 'Martinez', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, '3126542390', 'anam@gmail.com', 'Sempegua', 'La Paz', NULL, NULL, NULL, NULL),
(57, '77175915', 'cc', NULL, NULL, NULL, NULL, 'Flaminio', 'Ortiz', 'Ortiz', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, '3145692310', 'flaminio@gmail.com', 'Sempegua', 'La Paz', NULL, NULL, NULL, NULL),
(58, '77175916', 'cc', NULL, NULL, NULL, NULL, 'Nellys Cecilia', 'Nobles', 'Mendez', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, '3167564312', 'nellys@gmail.com', 'Sempegua', 'La Paz', NULL, NULL, NULL, NULL),
(59, '1063488419', 'ti', '2010-12-12', 1, 20, 404, 'Juan Sebastian', 'Cabas', 'Crespo', 'm', '2005-12-12', 1, 20, 404, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'jesus@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 404, '1'),
(60, '1063482611', 'ti', '2004-08-27', 1, 20, 410, 'Yeiser Arturo', 'Berrueco', 'Toloza', 'm', '2004-08-27', 1, 20, 410, 'o+', 'Barrios Unidos', 'Ninguna', '3178674508', 'YEISER@OUTLOOK.COM', 'Sempegua', 'Barrio Arriba', 1, 20, 410, '1'),
(61, '1063485385', 'ti', '2007-02-01', 1, 20, 410, 'Maicol David', 'Cardenas', 'Toloza', 'm', '2007-02-01', 1, 20, 410, 'a-', 'Cajacopi', 'Ninguna', '318098983', 'MAICOL34@GMAIL.COM', 'Sempegua', 'Barrio Arriba', 1, 20, 410, '1'),
(62, '1063487072', 'ti', '2007-11-25', 1, 20, 410, 'Victoria Milena', 'Florez', 'Nunez', 'f', '2007-11-25', 1, 20, 410, 'b+', 'Emdisalud', 'Ninguna', '3217897998', 'VICTORIAM@GMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(63, '1063485594', 'ti', '2005-09-29', 1, 20, 410, 'Estrella Isabel', 'Florian', 'Valle', 'f', '2005-09-29', 1, 20, 410, 'a+', 'Cajacopi', 'Ninguna', '322337686', 'ESTRELLAISA@HOTMAIL.COM', 'Sempegua', 'El Bronx', 1, 20, 410, '1'),
(64, '1063481520', 'ti', '2004-06-26', 1, 20, 410, 'Jose Daniel', 'Guerrero', 'Cadena', 'm', '2004-06-26', 1, 20, 410, 'o+', 'Cajacopi', 'Ninguna', '314565767', 'JOSEDANI@GMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(65, '1063484312', 'ti', '2012-02-28', 1, 20, 410, 'Adrian Jose', 'Cadena', 'Diaz', 'm', '2006-02-28', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'daviddiaz@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(66, '1063481518', 'ti', '2004-06-15', 1, 20, 410, 'Carelis', 'Guerrero', 'Martinez', 'f', '2004-06-15', 1, 20, 410, 'b-', 'Salud Total', 'Ninguna', '322787980', 'KRELIS@OUTLOOK.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(67, '1063481533', 'ti', '2015-07-20', 1, 20, 410, 'Yelitza', 'Contreras', 'Vides', 'f', '2004-07-20', 1, 20, 410, 'o+', 'Asmesalud', 'Ninguna', '3206919220', 'videscontreras@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(68, '1063484071', 'ti', '2006-02-07', 1, 20, 410, 'Angeles Sarays', 'Guitierrez', 'Obregon', 'f', '2006-02-07', 1, 20, 410, 'a-', 'Barrios Unidos', 'Ninguna', '31436878', 'ANGES@HOTMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(69, '1063485593', 'ti', '2016-03-19', 1, 20, 410, 'Joan David', 'Florian', 'Valle', 'm', '2004-12-19', 1, 20, 410, 'o+', 'Asmetsalud', 'Ninguna', '3206919220', 'joandavid@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 410, '1'),
(70, '1193102820', 'ti', '2016-08-15', 1, 20, 410, 'Isad Elias', 'Hernandez', 'Contreras', 'm', '2001-08-15', 1, 20, 410, 'o+', 'Caprecom', 'Ninguna', '3206919220', 'isadelias@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 410, '1'),
(71, '107247158', 'ti', '2003-08-31', 1, 20, 410, 'Gerson Manuel', 'Hernandez', 'Contreras', 'm', '2003-08-31', 1, 20, 410, 'b+', 'Cajacopi', 'Ninguna', '3186443235', 'GERSON@HOTMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(72, '1063484197', 'rc', '2018-11-26', 1, 20, 410, 'Vivian Camila', 'Martinez', 'Miranda', 'f', '2006-11-26', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'viviancamila@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 410, '1'),
(73, '1063430173', 'ti', '2016-01-03', 1, 20, 410, 'Jose Alejandro', 'Martinez', 'Obregon', 'm', '2004-01-03', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'josealjandro@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(74, '1063482624', 'ti', '2004-06-29', 1, 20, 410, 'Natalia', 'Infante', 'Munoz', 'f', '2004-06-20', 1, 20, 410, 'o+', 'Emdisalud', 'Ninguna', '32346567', 'NATIINAF@GMAIL.COM', 'Sempegua', 'Barrio Arriba', 1, 20, 410, '1'),
(75, '1063481523', 'ti', '2016-05-08', 1, 20, 410, 'Iberia Helena', 'Rocha', 'Mendez', 'f', '2004-05-08', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'iberiahelena@outlook.com', 'Calle 30a 32-86', 'Sempegua', 1, 20, 410, '1'),
(76, '1063485972', 'ti', '2004-09-15', 1, 20, 410, 'Shaira', 'Luqueta', 'Salazar', 'f', '2004-09-15', 1, 20, 410, 'o+', 'Salud Total', 'Ninguna', '32342669', 'SHAIRA@HOTMAIL.COM', 'Sempegua', 'La Esquina', 1, 20, 410, '1'),
(77, '1065597318', 'ti', '2018-08-03', 1, 20, 410, 'Andres Jesus', 'Nobles', 'Palomino', 'm', '2006-08-03', 1, 20, 404, 'o+', 'Medico Preventiva', 'Ninguna', '3188866092', 'jesusandres@outlook.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(78, '1063482614', 'ti', '2016-09-05', 1, 20, 410, 'Saray Alaejandra', 'Nobles', 'Palomino', 'f', '2004-09-05', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'saryalejandra@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(79, '1063482619', 'ti', '2017-11-21', 1, 20, 410, 'Daniel', 'Palomino', 'Nolbles', 'm', '2004-11-21', 1, 20, 410, 'o+', 'Asmesalud', 'Ninguna', '3116845721', 'daniel@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(80, '1063482613', 'ti', '2016-11-30', 1, 20, 410, 'Luisana', 'Palomino', 'Restrepo', 'f', '2004-11-30', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'luisana@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(81, '1063481994', 'ti', '2017-03-08', 1, 20, 410, 'Danna Tatiana', 'Pineda', 'Rincon', 'f', '2003-03-08', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'dannatatina@outlook.com', 'Calle 30a 32-86', 'Centro', 1, 20, 410, '2'),
(82, '1063480238', 'ti', '2002-11-02', 1, 20, 410, 'Latiel Maria', 'Martinez', 'Lopez', 'f', '2002-11-02', 1, 20, 410, 'o+', 'Cajacopi', 'Ninguna', '3224568768', 'LATIMARI@GMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(83, '1063488172', 'ti', '2016-07-07', 1, 20, 410, 'Luis Alfonso', 'Rangel', 'Palomino', 'm', '2003-07-07', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'luialfonso@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(84, '1063483882', 'ti', '2005-07-21', 1, 20, 410, 'Jorge Luis', 'Miranda', 'Alvarez', 'm', '2005-07-21', 1, 20, 410, 'b-', 'Emdisalud', 'Ninguna', '3186468556', 'JORLUIS@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(85, '1063481535', 'ti', '0000-00-00', 1, 20, 410, 'Kendry Yuliana', 'Rocha', 'Lopez', 'f', '2004-09-15', 1, 20, 410, 'o+', 'Asmetsalud', 'Ninguna', '3116845721', 'kendri@outlook.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(86, '1063484222', 'ti', '2006-02-27', 1, 20, 410, 'Jhorlen Yesith', 'Nobles', 'Mendez', 'm', '2006-02-27', 1, 20, 410, 'a-', 'Cafesalud', 'Ninguna', '3242426757', 'JHORLYE@HOTMAIL.COM', 'Sempegua', 'La Esquina', 1, 20, 410, '1'),
(87, '1063485614', 'ti', '0000-00-00', 1, 20, 410, 'Alina Maria', 'Rocha', 'Toloza', 'm', '2007-02-16', 1, 20, 410, 'o+', 'Asmetsalud', 'Ninguna', '3116845721', 'alina@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(88, '32547894', 'rc', '2002-06-07', 1, 20, 410, 'Maria Camila', 'Pacheco', 'Obregon', 'f', '2002-06-07', 1, 20, 410, 'a+', 'Coosalud', 'Ninguna', '322455535', 'MARICAMI@OUTLOOK.COM', 'Sempegua', 'Las Palmas', 1, 20, 410, '1'),
(89, '1127584727', 'ti', '2010-07-23', 1, 20, 410, 'Orianis', 'Soto', 'Palomino', 'f', '2005-07-23', 189, 287, 1308, 'o+', 'Asmetsalud', 'Ninguna', '3152931328', 'orianis@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(90, '1063488053', 'ti', '2002-06-05', 1, 20, 410, 'Dainer Jose', 'Palomino', 'Jimenez', 'm', '2002-06-05', 1, 20, 410, 'a+', 'Ambuq', 'Ninguna', '32543542', 'DAINERJOSE@GMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(91, '1063480825', 'ti', '2010-02-09', 1, 20, 410, 'Valentina', 'Toloza', 'Quevedo', 'f', '2004-02-09', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'valentina@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(92, '1066269415', 'ti', '2005-08-15', 1, 20, 410, 'Andres Alberto', 'Pastrana', 'Rocha', 'm', '2005-08-15', 1, 20, 410, 'o-', 'Saludvida', 'Ninguna', '13453464', 'ANDRESAL@GMAIL.COM', 'Sempegua', 'Barrio Arriba', 1, 20, 410, '1'),
(93, '1063482610', 'ti', '2016-07-31', 1, 20, 410, 'Kenia De Dios', 'Toloza', 'Vasquez', 'f', '2004-07-31', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'kenia@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(94, '1101202752', 'ti', '2007-08-13', 1, 20, 410, 'Edinson David', 'Pineda', 'Rincon', 'm', '2007-08-13', 1, 20, 410, 'b+', 'Cafesalud', 'Ninguna', '3187579890', 'EDINSON@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(95, '1063481534', 'ti', '2016-05-10', 1, 20, 410, 'Luis Mario', 'Valle', 'Martinez', 'm', '2004-05-10', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'luismario@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(96, '1063482623', 'rc', '2004-12-14', 1, 20, 410, 'Leonar David', 'Ramirez', 'Pacheco', 'm', '2004-12-14', 1, 20, 410, 'b-', 'Barrios Unidos', 'Ninguna', '345465654', 'LEODAVID@GMAIL.COM', 'Sempegua', 'Las Palmas', 1, 20, 410, '1'),
(97, '1063480224', 'ti', '2003-10-08', 1, 20, 410, 'Oscar David', 'Ramirez', 'Santos', 'm', '2003-10-08', 1, 20, 410, 'a-', 'Cajacopi', 'Ninguna', '3234243567', 'OSCARD@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(98, '1063484430', 'ti', '2005-06-19', 1, 20, 410, 'Juan Armando', 'Ramos', 'Martinez', 'm', '2005-06-19', 1, 20, 410, 'a+', 'Cafesalud', 'Ninguna', '3284974290', 'ARMNADO@GMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(99, '1116772950', 'ti', '2006-10-17', 1, 20, 410, 'Roxana', 'Santos', 'Martinez', 'f', '2006-10-17', 1, 20, 410, 'o-', 'Salud Total', 'Ninguna', '431232454', 'ROXAN@GMAIL.COM', 'Sempegua', 'La Carretera', 1, 20, 404, '1'),
(100, '1068348639', 'ti', '2005-07-03', 1, 20, 410, 'Camila Andrea', 'Villar', 'Arroyo', 'f', '2005-07-03', 1, 20, 410, 'o+', 'Emdisalud', 'Ninguna', '3146789797', 'CAMIANDRE@HOTMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(101, '1063481528', 'rc', '2004-07-23', 1, 20, 410, 'Yesmith Adriana', 'Waltero', 'Pacheco', 'f', '2004-07-23', 1, 20, 410, 'a+', 'Saludvida', 'Ninguna', '323977209', 'YESMITHADRI@GMAIL.COM', 'Sempegua', 'La Roca', 1, 20, 410, '1'),
(102, '4225309716', 'rc', '2016-03-26', 1, 20, 410, 'Jose Miguel', 'Andrade', 'Palomino', 'm', '2006-06-23', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'josemiguel@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(103, '1063486996', 'ti', '2018-12-21', 1, 20, 410, 'Mateo', 'Cadena', 'Diaz', 'm', '2007-12-21', 1, 20, 410, 'o+', 'Asmetsalud', 'Ninguna', '3116845721', 'mateo@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(104, '1063483559', 'ti', '2015-09-14', 1, 20, 410, 'Jhonatan Manuel', 'De Hoyos', 'Suarez', 'm', '2005-06-14', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3206919220', 'jhonatan@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(105, '1063487110', 'ti', '2018-01-22', 1, 20, 410, 'Nacira Angelica', 'Gomez', 'Contreras', 'f', '2008-01-22', 1, 20, 410, 'o+', 'Asmetsalud', 'Ninguna', '3116845721', 'nacira@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(106, '1085047722', 'ti', '2018-04-10', 1, 20, 410, 'Jose David', 'Herrera', 'Infante', 'm', '2006-04-10', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'josedavidh@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(107, '1067602647', 'ti', '2017-02-02', 1, 20, 410, 'Laura Vanessa', 'Leon', 'Rodriguez', 'f', '2007-02-02', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'lauravanessa@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(108, '1063488325', 'rc', '2018-11-23', 1, 20, 410, 'Melani', 'Mendez', 'Gutierrez', 'm', '2008-11-23', 1, 20, 410, 'a+', 'Asmetsalud', 'Ninguna', '3116845721', 'melani@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(109, '31574031', 'ti', '2018-11-05', 1, 20, 410, 'Naicir David', 'Miranda', 'Mejia', 'm', '2003-11-05', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'naicirdavid@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(110, '1063486711', 'ti', '2017-09-22', 1, 20, 410, 'Ricardo', 'Nobles', 'Cadena', 'm', '2007-09-22', 1, 20, 410, 'o+', 'Salud Vida', 'Ninguna', '3116845721', 'ricardo@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(111, '1063480227', 'rc', '2009-08-15', 1, 20, 404, 'Reinel', 'Ortiz', 'Mendoza', 'm', '2002-08-15', 1, 20, 410, 'b+', 'Salud Vida', 'Ninguna', '3116845721', 'reinel@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(112, '1127586369', 'ti', '2018-04-27', 1, 20, 410, 'Vanessa Karolina', 'Pacheco', 'Nobles', 'f', '2008-04-27', 1, 20, 410, 'o+', 'Caprecom', 'Ninguna', '3116845721', 'vanessa@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(113, '1063485247', 'ti', '2018-06-16', 1, 20, 410, 'Orianis', 'Parra', 'Martinez', 'f', '2008-06-16', 1, 20, 410, 'a+', 'Asmetsalud', 'Ninguna', '3116845721', 'oranisparra@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(114, '1063480242', 'ti', '2014-01-18', 1, 20, 410, 'Mandris', 'Rangel', 'Martinez', 'f', '2004-01-18', 1, 20, 410, 'b+', 'Caprecom', 'Ninguna', '3116845721', 'mandris@outlook.com', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(115, '1063484390', 'ti', '2015-09-27', 1, 20, 410, 'Jose Luis', 'Reales', 'Hernandez', 'm', '2004-09-27', 1, 20, 410, 'a+', 'Salud Vida', 'Ninguna', '3116845721', 'joseluis@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(116, '1063487507', 'ti', '2019-04-15', 1, 20, 410, 'Maria Ugenia', 'Rico', 'Nobles', 'f', '2008-04-15', 1, 20, 410, 'a+', 'Salud Vida', 'Ninguna', '3116845721', 'mariaeugenia@outlook.com', 'Sempegua', 'Centro', 1, 20, 410, '1'),
(117, '1063486970', 'ti', '2018-11-03', 1, 20, 410, 'Luis Alberto', 'Rocha', 'Toloza', 'm', '2007-11-03', 1, 20, 410, 'o+', 'Asmetsalud', 'Ninguna', '3116845721', 'luisalberto@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(118, '32547899', 'ti', '2018-09-02', 1, 20, 410, 'Rosa Maria', 'Santos', 'Nobles', 'f', '2002-09-02', 1, 20, 410, 'o-', 'Salud Vida', 'Ninguna', '3116845721', 'rosamaria@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(119, '1063485444', 'ti', '2015-09-30', 1, 20, 410, 'Ana', 'Toloza', 'Silva', 'm', '2006-09-30', 1, 20, 410, 'a-', 'Caprecom', 'Ninguna', '3116845721', 'anatoloza@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(120, '1067598671', 'ti', '2015-08-09', 1, 20, 410, 'Edwin Andres', 'Torres', 'Acosta', 'm', '2005-08-09', 1, 20, 410, 'o-', 'Salud Vida', 'Ninguna', '3116845721', 'edwinandres@outlook.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(121, '1063488067', 'ti', '2008-10-29', 1, 20, 410, 'Yessica', 'Amaya', 'Martinez', 'f', '2008-10-29', 1, 20, 410, 'o-', 'Barrios Unidos', 'Ninguna', '3245578786', 'YESSIK@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(122, '42938506', 'ti', '2009-05-14', 1, 20, 410, 'Luisa Fernanda', 'Avila', 'Mendez', 'f', '2009-05-14', 1, 20, 410, 'a+', 'Salud Total', 'Ninguna', '234324376', 'LUISAFER@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(123, '1063485460', 'ti', '2006-09-11', 1, 20, 410, 'Yeimis Manuel', 'Berrueco', 'Toloza', 'm', '2006-09-11', 1, 20, 410, 'o+', 'Saludvida', 'Ninguna', '8642564563', 'YEIMANUEL@HOTMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(124, '1063488501', 'ti', '2007-10-11', 1, 20, 410, 'Alix David', 'Florian', 'Valle', 'm', '2007-10-11', 1, 20, 410, 'b-', 'Ambuq', 'Ninguna', '328936476', 'ALIX@GMAI.LCOM', 'Sempegua', 'El Bronx', 1, 20, 410, '1'),
(125, '1063484310', 'ti', '2007-12-20', 1, 20, 410, 'Luis Carlos', 'Guerrero', 'Cadena', 'm', '2007-12-20', 1, 20, 410, 'a-', 'Emdisalud', 'Ninguna', '322267883', 'LUISK@GAMIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(126, '1064111254', 'rc', '2006-08-01', 1, 20, 410, 'Simoney', 'Gutierrez', 'Moncada', 'm', '2006-08-01', 1, 20, 410, 'o+', 'Cajacopi', 'Ninguna', '3298763', 'NEYSIMO@HOTMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(127, '1063486277', 'ti', '2007-06-07', 1, 20, 410, 'Yudis Elena', 'Hernandez', 'Pacheco', 'f', '2007-06-07', 1, 20, 410, 'a-', 'Salud Total', 'Ninguna', '3107454776', 'YUDIS@GMAIL.COM', 'Sempegua', 'Las Palmas', 1, 20, 410, '1'),
(128, '1063489630', 'ti', '2007-08-05', 1, 20, 410, 'Carlos Cesar', 'Mayorga', 'Hernandez', 'm', '2007-08-05', 1, 20, 410, 'o+', 'Cajacopi', 'Ninguna', '329079866', 'CARLOSC@GMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(129, '1063488487', 'ti', '2009-02-01', 1, 20, 410, 'Nohelia', 'Medina', 'Martinez', 'f', '2009-02-01', 1, 20, 410, 'b-', 'Barrios Unidos', 'Ninguna', '310989637', 'NOHELIA@HOTMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(130, '1063489265', 'ti', '2009-04-25', 1, 20, 410, 'Dulce Analia', 'Nobles', 'Cardenas', 'f', '2009-04-25', 1, 20, 410, 'o+', 'Salud Total', 'Ninguna', '321545856', 'DULCE@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(131, '1063486333', 'ti', '2007-06-30', 1, 20, 410, 'Luisa Margarita', 'Nobles', 'Quevedo', 'f', '2007-06-30', 1, 20, 410, 'o+', 'Cajacopi', 'Ninguna', '312897898', 'LUISAMAR@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(132, '1063484945', 'ti', '2005-10-01', 1, 20, 410, 'Maria Teresa', 'Nobles', 'Quevedo', 'f', '2005-10-01', 1, 20, 410, 'b+', 'Emdisalud', 'Ninguna', '563426767', 'MARIAT@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(133, '1063490455', 'ti', '2007-08-24', 1, 20, 410, 'Ronald Andres', 'Palomino', 'Nobles', 'm', '2007-08-24', 1, 20, 410, 'o+', 'Barrios Unidos', 'Ninguna', '324556456', 'RONALD@GMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(134, '1063484813', 'ti', '2005-05-02', 1, 20, 410, 'Diley Jose', 'Pere', 'Obregon', 'm', '2005-05-02', 1, 20, 410, 'b+', 'Ambuq', 'Ninguna', '3124546554', 'DILEYJ@HOTMAIL.COM', 'Sempegua', 'Barrio Arriba', 1, 20, 410, '1'),
(135, '1063488003', 'ti', '2008-10-25', 1, 20, 410, 'Yarelis', 'Rangel', 'Luqueta', 'f', '2008-10-25', 1, 20, 404, 'b-', 'Saludvida', 'Ninguna', '32445363', 'YARELISRL@GMAIL.COM', 'Sempegua', 'La Roca', 1, 20, 410, '1'),
(136, '1127695723', 'ti', '2008-06-20', 1, 20, 410, 'Humberto Junior', 'Soto', 'Berrueco', 'm', '2008-06-20', 1, 20, 410, 'a+', 'Emdisalud', 'Ninguna', '321244667', 'JUNIORH@GMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(137, '1063486142', 'rc', '2007-03-24', 1, 20, 410, 'Valeri', 'Toloza', 'Luqueta', 'f', '2007-03-24', 1, 20, 410, 'b-', 'Barrios Unidos', 'Ninguna', '324235454', 'VALERI@HOTMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(138, '1063488115', 'ti', '2008-09-09', 1, 20, 410, 'Mario Jose', 'Toloza', 'Perez', 'm', '2008-09-09', 1, 20, 410, 'b-', 'Ambuq', 'Ninguna', '31265878', 'MARIOJ@GMAIL.COM', 'Sempegua', 'La Roca', 1, 20, 410, '1'),
(139, '1063488488', 'ti', '2007-12-10', 1, 20, 410, 'Yuliana', 'Toloza', 'Quevedo', 'f', '2007-12-10', 1, 20, 410, 'a+', 'Salud Total', 'Ninguna', '3325467657', 'YULI@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(140, '1063485580', 'ti', '2006-09-15', 1, 20, 410, 'Valmer', 'Toloza', 'Vasquez', 'm', '2006-09-15', 1, 20, 410, 'o+', 'Salud Total', 'Ninguna', '3143534656', 'VALMER@OTLOOK.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(141, '1068385858', 'rc', '2007-04-19', 1, 20, 410, 'Katty Yulieth', 'Villar', 'Arroyo', 'f', '2007-04-19', 1, 20, 410, 'a+', 'Cajacopi', 'Ninguna', '3123454645', 'KATTYYULI@HOTMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(142, '4225388013', 'ti', '2005-08-30', 1, 20, 410, 'Iliana Maria', 'Ortega', 'Padilla', 'f', '2005-05-30', 1, 20, 410, 'b+', 'Asmet Salud', 'Ninguna', '323435465', 'ILIANA@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(143, '4225388102', 'ti', '2007-03-04', 1, 20, 410, 'Samir Jose', 'Pabon', 'Nobles', 'm', '2007-04-04', 1, 20, 410, 'b+', 'Cajacopi', 'Ninguna', '3124543578', 'SAMIRJ@OUTLOOK.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(144, '1063486249', 'ti', '2005-10-23', 1, 20, 410, 'Vanessa', 'Acuna', 'Toloza', 'f', '2005-10-23', 1, 20, 410, 'o+', 'Barrios Unidos', 'Ninguna', '335465465', 'VANEACU@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(145, '1063488406', 'ti', '2008-10-18', 1, 20, 404, 'Aran Jose', 'Aragon', 'Cabas', 'm', '2008-10-18', 1, 20, 410, 'o+', 'Saludvida', 'Ninguna', '3216877689', 'ARANJ@HOTMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(146, '1127610214', 'ti', '2008-09-20', 1, 20, 410, 'Camila Andrea', 'Berrueco', 'Contreras', 'f', '2008-09-20', 1, 20, 410, 'b+', 'Emdisalud', 'Ninguna', '3115476756', 'CAMILAA@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(147, '1127610211', 'ti', '2007-08-06', 1, 20, 410, 'Gisel Patricia', 'Berrueco', 'Contreras', 'f', '2007-08-06', 1, 20, 410, 'o-', 'Ambuq', 'Ninguna', '314767665', 'GISELP@HOTMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(148, '1048872697', 'ti', '2009-11-26', 1, 20, 410, 'Jose Alejandro', 'Cabas', 'Lopez', 'm', '2009-11-26', 1, 20, 410, 'b-', 'Ambuq', 'Ninguna', '322444564', 'JOSEALEJO@GMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(149, '1063489277', 'ti', '2009-11-06', 1, 20, 410, 'Jose David', 'Cavas', 'Zambrano', 'm', '2009-11-06', 1, 20, 410, 'o+', 'Salud Total', 'Ninguna', '3152898980', 'JOSEDAVID@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(150, '163488382', 'rc', '2006-11-19', 1, 20, 410, 'Yesica	Dayanis', 'Cuadro', 'Obregon', 'f', '2006-11-19', 1, 20, 410, 'a+', 'Cajacopi', 'Ninguna', '3115575675', 'YESICA@OUTLOOK.COM', 'Sempegua', 'La  Plaza', 1, 20, 410, '1'),
(151, '1063487456', 'ti', '2008-05-26', 1, 20, 410, 'Cristian David', 'Fernandez', 'Toloza', 'm', '2008-05-26', 1, 20, 410, 'a-', 'Ambuq', 'Ninguna', '316786876', 'CRISTIAND@GMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(152, '1063487031', 'ti', '2007-12-19', 1, 20, 410, 'Santiago', 'Gomez', 'Rangel', 'm', '2007-12-19', 1, 20, 410, 'o-', 'Emdisalud', 'Ninguna', '31245656', 'SANTIGR@GMAIL.COM', 'Sempegua', 'La Roca', 1, 20, 410, '1'),
(153, '1082591261', 'ti', '2007-09-12', 1, 20, 410, 'Luis Adulfo', 'Gonzalez', 'Hernandez', 'm', '2007-09-12', 1, 20, 410, 'b+', 'Ambuq', 'Ninguna', '3142332432', 'LUISADU@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(154, '1063488492', 'ti', '2009-02-22', 1, 20, 410, 'Yanelis Jhoana', 'Hernandez', 'Contreras', 'f', '2009-02-22', 1, 20, 410, 'b+', 'Cajacopi', 'Ninguna', '3122434454', 'YNELIS@GMAIL.COM', 'Sempegua', 'Barrio Arriba', 1, 20, 410, '1'),
(155, '1085099464', 'ti', '2010-01-03', 1, 20, 410, 'Pablo', 'Hernandez', 'Pinto', 'm', '2010-01-03', 1, 20, 410, 'o-', 'Salud Total', 'Ninguna', '324535645', 'PABLO@HOTMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(156, '1085050190', 'ti', '2008-03-07', 1, 20, 410, 'Victoria', 'Hernandez', 'Pinto', 'f', '2008-03-07', 1, 20, 410, 'a-', 'Saludvida', 'Ninguna', '31245654', 'VICTORIA@OUTLOOK.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(157, '1063489650', 'ti', '2008-11-23', 1, 20, 410, 'Valentina', 'Infante', 'Ruiz', 'f', '2008-11-23', 1, 20, 410, 'b-', 'Ambuq', 'Ninguna', '3123543554', 'VALENTINAA@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(158, '1063488527', 'ti', '2007-02-17', 1, 20, 410, 'Alexander', 'Leon', 'Martinez', 'm', '2007-02-17', 1, 20, 410, 'b+', 'Barrios Unidos', 'Ninguna', '312435453', 'ALEX@GMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(159, '1141322108', 'rc', '2008-09-11', 1, 20, 410, 'Eneys Patricia', 'Mendez', 'Nobles', 'f', '2008-09-11', 1, 20, 410, 'o+', 'Barrios Unidos', 'Ninguna', '31665756', 'ENEYSPAT@GMAIL.COM', 'Sempegua', 'Las Palmas', 1, 20, 410, '1'),
(160, '1063485761', 'rc', '2006-08-19', 1, 20, 410, 'Omar David', 'Miranda', 'Alvarez', 'm', '2006-08-19', 1, 20, 410, 'a-', 'Ambuq', 'Ninguna', '3238978947', 'OMARDVD@GMAIL.COM', 'Sempegua', 'El Campo', 1, 20, 410, '1'),
(161, '1063488431', 'ti', '2008-12-29', 1, 20, 410, 'Ilme Jose', 'Nobles', 'Caballero', 'm', '2008-12-29', 1, 20, 410, 'b+', 'Cajacopi', 'Ninguna', '3132454545', 'ILME@HOTMAIL.COM', 'Sempegua', 'La Roca', 1, 20, 410, '1'),
(162, '1063489111', 'ti', '2009-10-20', 1, 20, 410, 'Jheynis Patricia', 'Nobles', 'Mendez', 'f', '2009-10-20', 1, 20, 410, 'o+', 'Salud Total', 'Ninguna', '323434543', 'JHEYNIS@GMAIL.COM', 'Sempegua', 'La Esquina', 1, 20, 410, '1'),
(163, '1063485965', 'ti', '2007-04-19', 1, 20, 410, 'Andres Vicente', 'Nobles', 'Palomino', 'm', '2007-04-19', 1, 20, 410, 'b-', 'Cajacopi', 'Ninguna', '312445656', 'CHENTE@HOTMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(164, '1063492342', 'ti', '2009-06-03', 1, 20, 410, 'Dileydis Nicolle', 'Obregon', 'Cadena', 'f', '2009-06-03', 1, 20, 410, 'a+', 'Emdisalud', 'Ninguna', '3124565676', 'DILEDYS@GMAL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(165, '1030604392', 'ti', '2009-12-30', 1, 20, 410, 'Matias', 'Otalora', 'Luna', 'm', '2009-12-30', 1, 20, 410, 'b+', 'Saludvida', 'Ninguna', '3254545657', 'MATIAS@HOTMAIL.COM', 'Sempegua', 'Barrio Arriba', 1, 20, 410, '1'),
(166, '1063488432', 'ti', '2009-02-05', 1, 20, 410, 'Luis Fabian', 'Pacheco', 'Obregon', 'm', '2009-02-05', 1, 20, 410, 'o+', 'Ambuq', 'Ninguna', '10768343', 'LUISFAB@OUTLOOK.COM', 'Sempegua', 'Las Palmas', 1, 20, 410, '1'),
(167, '1063488627', 'ti', '2007-12-21', 1, 20, 410, 'Valentina', 'Pastrana', 'Rocha', 'f', '2007-12-21', 1, 20, 410, 'o-', 'Cajacopi', 'Ninguna', '3124455546', 'VALENTINAPR@GMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(168, '1063487869', 'ti', '2008-01-07', 1, 20, 410, 'Juan Luis', 'Ramirez', 'Pacheco', 'm', '2008-01-07', 1, 20, 410, 'b+', 'Cafesalud', 'Ninguna', '3214545645', 'JUANLUIS@HOTMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(169, '1063486739', 'ti', '2007-06-29', 1, 20, 410, 'Jorge Luis', 'Reales', 'Hernandez', 'm', '2007-06-29', 1, 20, 410, 'o+', 'Coomeva', 'Ninguna', '32146521', 'JORLUIS@OUTLOOK.COM', 'Sempegua', 'El Campo', 1, 20, 410, '1'),
(170, '1127614212', 'ti', '2009-11-02', 1, 20, 410, 'Ana Sofia', 'Reyna', 'Contreras', 'f', '2009-11-02', 1, 20, 410, 'o+', 'Cafesalud', 'Ninguna', '3253534534', 'ANASOFI@GMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(171, '1063480236', 'ti', '2004-01-15', 1, 20, 410, 'Robinson', 'Rico', 'Martinez', 'm', '2004-01-15', 1, 20, 410, 'a-', 'Emdisalud', 'Ninguna', '312343543', 'ROBIN@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(172, '1063489209', 'ti', '2009-08-01', 1, 20, 410, 'Mateo', 'Rocha', 'Martinez', 'm', '2009-08-01', 1, 20, 410, 'o+', 'Salud Total', 'Ninguna', '31234453', 'mateo@gmail.com', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(173, '1063489741', 'rc', '2008-08-13', 1, 20, 410, 'Sergio David', 'Toloza', 'Jimenez', 'm', '2008-08-13', 1, 20, 410, 'a+', 'Cafesalud', 'Ninguna', '314435434', 'SERGIO@GMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(174, '1063488320', 'ti', '2008-11-24', 1, 20, 404, 'Neifer Jose', 'Toloza', 'Luqueta', 'm', '2008-11-24', 1, 20, 410, 'o+', 'Asmet Salud', 'Ninguna', '3214654765', 'NEIFERJ@OUTLOOK.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(175, '1063485369', 'ti', '2006-12-23', 1, 20, 410, 'Keiner Jose', 'Toloza', 'Mieles', 'm', '2006-12-23', 1, 20, 410, 'a+', 'Cajacopi', 'Ninguna', '3124543543', 'KEINERJ@HOTMAIL.COM', 'Sempegua', 'La Esquina', 1, 20, 410, '1'),
(176, '1063489990', 'ti', '2010-01-22', 1, 20, 410, 'Julio Alberto', 'Toloza', 'Mieles', 'm', '2010-01-22', 1, 20, 410, 'b+', 'Cajacopi', 'Ninguna', '323544353', 'JULIOALB@GMAIL.COM', 'Sempegua', 'La Esquina', 1, 20, 410, '1'),
(177, '37895770', 'ti', '2006-09-21', 1, 20, 410, 'Lenis Alberto', 'Waltero', 'Pacheco', 'm', '2006-09-21', 1, 20, 410, 'o+', 'Amet Salud', 'Ninguna', '31590324', 'lenis@gmail.com', 'Sempegua', 'La Roca', 1, 20, 410, '1'),
(178, '1064777243', 'ti', '2011-02-06', 1, 20, 410, 'Laura Vanessa', 'Avila', 'Mendez', 'f', '2011-02-06', 1, 20, 410, 'o+', 'Ambuq', 'Ninguna', '3145878647', 'lauvane@gmail.com', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(179, '1063494530', 'ti', '2010-07-23', 1, 20, 410, 'Juan David', 'Barrios', 'Toloza', 'm', '2010-07-23', 1, 20, 410, 'o-', 'Cafesalud', 'Ninguna', '3157687687', 'JUANDA@OUTLOOK.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(180, '1127587282', 'ti', '2007-11-27', 1, 20, 410, 'Mario Andres', 'Cadena', 'Reales', 'm', '2007-11-27', 1, 20, 410, 'b+', 'Cajacopi', 'Ninguna', '312435454', 'marioa@hotmail.com', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(181, '1063490528', 'ti', '2010-12-26', 1, 20, 410, 'Andrea Carolina', 'Cardenas', 'Contreras', 'f', '2010-12-26', 1, 20, 410, 'a+', 'Emdisalud', 'Ninguna', '3115660087', 'ANDREAK@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(182, '1063489572', 'ti', '2009-09-10', 1, 20, 410, 'Santiago', 'Diaz', 'Ramirez', 'm', '2009-09-10', 1, 20, 410, 'b+', 'Cajacopi', 'Ninguna', '321454564', 'SANTIDIAZ@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(183, '1063490476', 'ti', '2010-10-14', 1, 20, 410, 'Naslyn Lorena', 'Florez', 'Contreras', 'f', '2010-10-14', 1, 20, 410, 'b-', 'Ambuq', 'Ninguna', '2343443455', 'NASLYN@OUTLOOK.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(184, '1063489036', 'ti', '2009-08-31', 1, 20, 410, 'Geronimo', 'Infante', 'Toloza', 'm', '2009-08-31', 1, 20, 410, 'a+', 'Ambuq', 'Ninguna', '312789393', 'GERONIMO@HOTMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(185, '1063488528', 'ti', '2008-07-24', 1, 20, 410, 'Yesmit Adriana', 'Leon', 'Martinez', 'f', '2008-07-24', 1, 20, 410, 'o+', 'Cajacopi', 'Ninguna', '312479876', 'YESMITADR@HOTMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(186, '1063489737', 'ti', '2010-04-06', 1, 20, 410, 'Carlos Alberto', 'Medina', 'Martinez', 'm', '2010-04-06', 1, 20, 410, 'b+', 'Barrios Unidos', 'Ninguna', '3131354543', 'CARLOS@HOTMAIL.COM', 'Sempegua', 'La Esquina', 1, 20, 410, '1'),
(187, '1082372525', 'ti', '2008-06-28', 1, 20, 410, 'Rosa Emilia', 'Miranda', 'Viloria', 'f', '2008-06-28', 1, 20, 410, 'a+', 'Ambuq', 'Ninguna', '312445546', 'ROSAEMI@HOTMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(188, '4225388012', 'ti', '2009-10-03', 1, 20, 410, 'Luis Jose', 'Pabon', 'Nobles', 'm', '2009-10-03', 1, 20, 410, 'a+', 'Salud Total', 'Ninguna', '3214544654', 'LUIJOSE@GMAIL.COM', 'Sempegua', 'Las Palmas', 1, 20, 410, '1'),
(189, '1127592274', 'ti', '2011-04-01', 1, 20, 410, 'Sihao Daniel', 'Perez', 'Cabas', 'f', '2011-04-01', 1, 20, 410, 'o-', 'Saludvida', 'Ninguna', '3213347989', 'SHIADANI@GMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(190, '1063484043', 'ti', '2005-12-28', 1, 20, 410, 'Janner', 'Rangel', 'Martinez', 'm', '2005-12-28', 1, 20, 410, 'b+', 'Asmet Salud', 'Ninguna', '312334546', 'JANNER@HOTMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(191, '4225388273', 'ti', '2010-02-22', 1, 20, 410, 'Daikaroly', 'Rondon', 'Cerpa', 'f', '2010-05-22', 1, 20, 410, 'a+', 'Ambuq', 'Ninguna', '315465464', 'DAIKAR@OUTLOOK.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(192, '1085103301', 'ti', '2008-06-27', 1, 20, 410, 'Saul Alfonso', 'Toloza', 'De La Cruz', 'm', '2008-06-27', 1, 20, 410, 'a+', 'Cajacopi', 'Ninguna', '343456576', 'SAUL@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(193, '1063484571', 'ti', '2006-05-06', 1, 20, 410, 'Cindy Jhoana', 'Valle', 'Martinez', 'f', '2006-05-06', 1, 20, 410, 'a+', 'Ambuq', 'Ninguna', '31156809', 'CINDYJHO@GMAIL.COM', 'Sempegua', 'Barrio Arriba', 1, 20, 410, '1'),
(194, '1085098357', 'ti', '2009-09-10', 1, 20, 410, 'Karol Dayana', 'Villar', 'Arroyo', 'f', '2009-09-10', 1, 20, 410, 'a+', 'Cajacopi', 'Ninguna', '3123548045', 'KAROLDAY@HOTMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(195, '1063489156', 'ti', '2009-10-10', 1, 20, 410, 'Silvia Juliana', 'Gutierrez', 'Obregon', 'f', '2009-10-10', 1, 20, 410, 'o+', 'Ambuq', 'Ninguna', '312445765', 'SILVIAJUL@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(196, '1064801671', 'ti', '2010-05-01', 1, 20, 410, 'Ediober', 'Leon', 'Martinez', 'm', '2010-05-01', 1, 20, 410, 'a-', 'Cajacopi', 'Ninguna', '3123478098', 'EDIOBER@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(197, '1063491057', 'ti', '2011-07-02', 1, 20, 410, 'Luz Danellys', 'Martinez', 'Nobles', 'f', '2011-07-02', 1, 20, 410, 'a+', 'Saludvida', 'Ninguna', '331235676', 'LUZDANE@HOTMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(198, '1083491721', 'ti', '2012-02-24', 1, 20, 410, 'Saul Jose', 'Martinez', 'Toloza', 'm', '2012-02-24', 1, 20, 410, 'o+', 'Salud Total', 'Ninguna', '324644575', 'SAULJ@GMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(199, '8052855', 'ti', '2010-12-05', 1, 20, 410, 'Yonathan Dario', 'Mejia', 'Miranda', 'm', '2010-12-05', 1, 20, 410, 'a+', 'Ambuq', 'Ninguna', '3234455436', 'YONATHAN@OUTLOOK.COM', 'Sempegua', 'Barrio Arriba', 1, 20, 410, '1'),
(200, '1063490949', 'ti', '2011-07-06', 1, 20, 410, 'Adrian David', 'Nobles', 'Cardenas', 'm', '2011-07-06', 1, 20, 410, 'o-', 'Emdisalud', 'Ninguna', '217926429', 'ADRIAND@GMAIL.COM', 'Sempegua', 'El Campo', 1, 20, 410, '1'),
(201, '1063490995', 'ti', '2011-07-18', 1, 20, 410, 'Regina Isabel', 'Nobles', 'Florez', 'f', '2011-07-18', 1, 20, 410, 'b+', 'Saludvida', 'Ninguna', '3128479843', 'REGINAISA@GMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(202, '4225388278', 'ti', '2009-04-25', 1, 20, 410, 'Clarixa Isabel', 'Ortega', 'Padilla', 'f', '2009-04-25', 1, 20, 411, 'a+', 'Asmet Salud', 'Ninguna', '3129408045', 'CLARIXA@GMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(203, '4225387972', 'ti', '2007-11-10', 1, 20, 410, 'Miguel Antonio', 'Ortega', 'Padilla', 'm', '2007-11-10', 1, 20, 410, 'o+', 'Asmet Salud', 'Ninguna', '31234346', 'MIGUELA.@GMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(204, '1063486601', 'ti', '2007-08-17', 1, 20, 410, 'Jesus Alberto', 'Rico', 'Martinez', 'm', '2007-08-17', 1, 20, 410, 'a+', 'Ambuq', 'Ninguna', '3190838732', 'JESUSALBER@OUTLOOK.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(205, '1063489742', 'ti', '2009-06-26', 1, 20, 410, 'Luis Mario', 'Rico', 'Martinez', 'm', '2009-06-26', 1, 20, 410, 'a+', 'Ambuq', 'Ninguna', '312423532', 'LUISMA@HOTMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(206, '1067619905', 'ti', '2012-03-23', 1, 20, 410, 'Shaireth Michel', 'Rodriguez', 'Munoz', 'f', '2012-03-23', 1, 20, 410, 'a+', 'Cajacopi', 'Ninguna', '312903358', 'SHAIMCHEL@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(207, '1100085494', 'ti', '2009-07-25', 1, 20, 410, 'Carlos Mario', 'Suarez', 'Mayorga', 'm', '2009-07-25', 1, 20, 410, 'b+', 'Salud Total', 'Ninguna', '12247932', 'CARLOSMARIO@HOTMAIL.COM', 'Sempegua', 'La Roca', 1, 20, 410, '1'),
(208, '1063491955', 'ti', '2012-05-16', 1, 20, 410, 'Jeronimo Jose', 'Toloza', 'Hernandez', 'm', '2012-05-16', 1, 20, 410, 'b+', 'Asmet Salud', 'Ninguna', '3124465409', 'JEROJOSE@OUTLOOK.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(209, '1063491156', 'ti', '2011-08-28', 1, 20, 410, 'Yisel', 'Toloza', 'Luqueta', 'f', '2011-08-28', 1, 20, 410, 'b-', 'Coomeva', 'Ninguna', '3118674608', 'YISEL@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(210, '1063491155', 'ti', '2011-08-28', 1, 20, 410, 'Yisela', 'Toloza', 'Luqueta', 'f', '2011-08-28', 1, 20, 410, 'b+', 'Ambuq', 'Ninguna', '3123254534', 'YISELA@GMAIL.COM', 'Sempegua', 'La Central', 1, 20, 410, '1'),
(211, '1127603262', 'ti', '2012-10-02', 1, 20, 410, 'Oriana', 'Toloza', 'Martinez', 'f', '2012-10-02', 1, 20, 410, 'o-', 'Asmet Salud', 'Ninguna', '312544645', 'ORIANA@HOTMAIL.COM', 'Sempegua', 'Barrio Arriba', 1, 20, 410, '1'),
(212, '1063488489', 'ti', '2008-11-27', 1, 20, 410, 'Alber Jose', 'Toloza', 'Quevedo', 'm', '2008-11-27', 1, 20, 410, 'b+', 'Cajacopi', 'Ninguna', '312354543', 'ALBER@GMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(213, '1063489035', 'ti', '2009-08-22', 1, 20, 410, 'Jose Raul', 'Toloza', 'Velasquez', 'm', '2009-08-22', 1, 20, 410, 'a+', 'Saludvida', 'Ninguna', '31537593', 'JOSERAUL@GMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(214, '1063490477', 'ti', '2011-01-15', 1, 20, 410, 'Mayte', 'Toloza', 'Velasquez', 'f', '2011-01-15', 1, 20, 410, 'b-', 'Ambuq', 'Ninguna', '312564454', 'MAYTE.@GMAIL.COM', 'Sempegua', 'La Playa', 1, 20, 410, '1'),
(215, '1119817251', 'ti', '2010-10-25', 1, 20, 410, 'Jesus David', 'Torres', 'Acosta', 'm', '2010-10-25', 1, 20, 410, 'o-', 'Coomeva', 'Ninguna', '3165690554', 'JESUSDA@HOTMAIL.COM', 'Sempegua', 'Las Palmas', 1, 20, 410, '1'),
(216, '1063489993', 'ti', '2010-07-02', 1, 20, 410, 'Andres Yesid', 'Vega', 'Mendez', 'm', '2010-07-02', 1, 20, 410, 'a+', 'Asmet Salud', 'Ninguna', '322365756', 'ANDRESYESID@GMAIL.COM', 'Sempegua', 'Divino NiÑo', 1, 20, 410, '1'),
(217, '1216964092', 'ti', '2010-12-10', 1, 20, 410, 'Morelia', 'Velasquez', 'Rico', 'f', '2010-12-10', 1, 20, 410, 'a+', 'Cajacopi', 'Ninguna', '3132334654', 'MORELIA@GMAIL.COM', 'Sempegua', 'El Campo', 1, 20, 410, '1'),
(218, '1068387803', 'ti', '2011-10-24', 1, 20, 410, 'Luis Felipe', 'Villar', 'Arroyo', 'm', '2011-10-24', 1, 20, 410, 'a+', 'Ambuq', 'Ninguna', '325820937', 'LUISFELIPE@HOTMAIL.COM', 'Sempegua', 'La Paz', 1, 20, 410, '1'),
(219, '1063491282', 'ti', '2011-09-30', 1, 20, 410, 'Adriana Lucia', 'Villarreal', 'Palomino', 'f', '2011-09-30', 1, 20, 410, 'a+', 'Cajacopi', 'Ninguna', '315678768', 'ADRIANALUCI@HOTMAIL.COM', 'Sempegua', 'La Plaza', 1, 20, 410, '1'),
(220, '1063490048', 'ti', '2010-08-03', 1, 20, 410, 'Carlos Daniel', 'Waltero', 'Pacheco', 'm', '2010-08-03', 1, 20, 410, 'b+', 'Saludvida', 'Ninguna', '310748684', 'CARLOSDANI@OUTLOOK.COM', 'Sempegua', 'La Roca', 1, 20, 410, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_persona` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `escalafon` varchar(3) NOT NULL,
  `fecha_vinculacion` date NOT NULL,
  `tipo_vinculacion` varchar(50) NOT NULL,
  `decreto_nombramiento` varchar(100) NOT NULL,
  `estado_profesor` varchar(8) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_persona`, `titulo`, `escalafon`, `fecha_vinculacion`, `tipo_vinculacion`, `decreto_nombramiento`, `estado_profesor`) VALUES
(3, 'Lic. Lengua Castellana', '14', '2000-04-10', 'En propiedad', 'Decreto 041 de 06/04/94', 'Activo'),
(4, 'Lic. Preescolar', '2', '2004-04-12', 'En propiedad', 'Decreto 000410 de 13/05/10', 'Activo'),
(5, 'Lic.basica Primaria', '14', '1994-08-10', 'En propiedad', 'Decreto. 023 de 10/08/94', 'Activo'),
(12, 'Lic.educ. Artistica', '12', '1979-03-05', 'En propiedad', 'Res. 00845 de 03/05/79', 'Activo'),
(14, 'Lic. Basica Primaria', '12', '1993-02-17', 'En propiedad', 'Decreto 008 de 17/02/93', 'Activo'),
(16, 'Normalista Superior', '6', '1995-01-24', 'En propiedad', 'Res. 000084 de 24/01/95', 'Activo'),
(17, 'Lic. Basica Primaria', '14', '1994-12-20', 'En propiedad', 'Res. 002223 de 26/07/94', 'Activo'),
(19, 'Normalista Superior', '1', '2010-08-30', 'En propiedad', 'Decreto.000495 de 30/08/2010', 'Activo'),
(21, 'Lic. Lengua Castellana', '2', '2017-01-17', 'En propiedad', 'Res.000151 de 17/01/ 2017', 'Activo'),
(23, 'Administrador Empresa', '2', '0000-00-00', 'En propiedad', 'Res.000151 de 17/01/ 2017', 'Activo'),
(25, 'Bachiller', '1', '2000-04-10', 'En propiedad', 'Decreto. 039 de 06/04/2000', 'Activo'),
(27, 'Lic. Ciencias Naturales', '14', '1997-07-08', 'En propiedad', 'Decreto 83 de 08/07/97', 'Activo'),
(31, 'Ingeniera Sistema', '2', '2011-06-03', 'En provisionalidad', 'Deto.000240 de 27/05/2011', 'Activo'),
(32, 'Lic. Matematica', '2', '2007-05-30', 'En propiedad', 'Decreto.000181 de 30/05/2007', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiros`
--

CREATE TABLE `retiros` (
  `id_retiro` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  `fecha_retiro` date NOT NULL,
  `fecha_registro` datetime NOT NULL
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
(4, 'acudiente', NULL),
(5, 'votante', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salones`
--

CREATE TABLE `salones` (
  `id_salon` int(11) NOT NULL,
  `nombre_salon` varchar(30) NOT NULL,
  `observacion` varchar(45) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `estado_salon` varchar(8) NOT NULL,
  `disponibilidad` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `salones`
--

INSERT INTO `salones` (`id_salon`, `nombre_salon`, `observacion`, `ano_lectivo`, `estado_salon`, `disponibilidad`) VALUES
(1, 'Salon 000', 'Piso 1', 1, 'Activo', 'si'),
(2, 'Salon 001', 'Piso 1', 1, 'Activo', 'si'),
(3, 'Salon 002', 'Piso 1', 1, 'Activo', 'si'),
(4, 'Salon 003', 'Piso 1', 1, 'Activo', 'si'),
(5, 'Salon 004', 'Piso 1', 1, 'Activo', 'si'),
(6, 'Salon 005', 'Piso 1', 1, 'Activo', 'si'),
(7, 'Salon 006', 'Piso 1', 1, 'Activo', 'si'),
(8, 'Salon 007', 'Piso 1', 1, 'Activo', 'si'),
(9, 'Salon 008', 'Piso 1', 1, 'Activo', 'si'),
(10, 'Salon 009', 'Piso 1', 1, 'Activo', 'si'),
(11, 'Salon 010', 'Piso 1', 1, 'Activo', 'si'),
(12, 'Salon 011', 'Piso 1', 1, 'Activo', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos_disciplinarios`
--

CREATE TABLE `seguimientos_disciplinarios` (
  `id_seguimiento` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_curso` varchar(45) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_tipo_causal` int(11) NOT NULL,
  `id_causal` int(11) NOT NULL,
  `descripcion_situacion` varchar(500) NOT NULL,
  `fecha_causal` date NOT NULL,
  `id_accion_pedagogica` int(11) NOT NULL,
  `descripcion_accion_pedagogica` varchar(500) NOT NULL,
  `compromiso_estudiante` varchar(500) NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  `estado_seguimiento` varchar(8) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seguimientos_disciplinarios`
--

INSERT INTO `seguimientos_disciplinarios` (`id_seguimiento`, `ano_lectivo`, `id_profesor`, `id_curso`, `id_asignatura`, `id_estudiante`, `id_tipo_causal`, `id_causal`, `descripcion_situacion`, `fecha_causal`, `id_accion_pedagogica`, `descripcion_accion_pedagogica`, `compromiso_estudiante`, `observaciones`, `estado_seguimiento`, `fecha_registro`) VALUES
(1, 1, 3, '2', 11, 15, 1, 1, 'El Estudiante Frecuentemente Sale De Clases', '2018-10-24', 1, 'Se Dialoga Con El Estudiante', 'Se Compromete Asistir A Clases Normalmente', '', 'Cerrado', '2018-10-24 03:20:18'),
(2, 1, 3, '2', 11, 15, 1, 1, 'El Estudiante Frecuentemente Sale De Clases', '2018-10-24', 1, 'Se Dialoga Con El Estudiante', 'Se Compromete Asistir A Clases Normalmente', '', 'Abierto', '2018-10-24 03:20:21'),
(3, 1, 3, '2', 11, 15, 1, 1, 'El Estudiante Frecuentemente Sale De Clases', '2018-10-24', 1, 'Se Dialoga Con El Estudiante', 'Se Compromete Asistir A Clases Normalmente', '', 'Abierto', '2018-10-24 03:20:22'),
(4, 1, 3, '2', 11, 15, 1, 1, 'El Estudiante Frecuentemente Sale De Clases', '2018-10-24', 1, 'Se Dialoga Con El Estudiante', 'Se Compromete Asistir A Clases Normalmente', '', 'Abierto', '2018-10-24 03:20:22'),
(5, 1, 3, '2', 11, 15, 1, 1, 'El Estudiante Frecuentemente Sale De Clases', '2018-10-24', 1, 'Se Dialoga Con El Estudiante', 'Se Compromete Asistir A Clases Normalmente', '', 'Abierto', '2018-10-24 03:20:25'),
(6, 1, 3, '2', 11, 15, 1, 1, 'El Estudiante Frecuentemente Sale De Clases', '2018-10-24', 1, 'Se Dialoga Con El Estudiante', 'Se Compromete Asistir A Clases Normalmente', '', 'Abierto', '2018-10-24 03:20:26'),
(7, 1, 3, '2', 11, 15, 1, 1, 'El Estudiante Frecuentemente Sale De Clases', '2018-10-24', 1, 'Se Dialoga Con El Estudiante', 'Se Compromete Asistir A Clases Normalmente', '', 'Abierto', '2018-10-24 03:21:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_causales`
--

CREATE TABLE `tipos_causales` (
  `id_tipo_causal` int(11) NOT NULL,
  `tipo_causal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_causales`
--

INSERT INTO `tipos_causales` (`id_tipo_causal`, `tipo_causal`) VALUES
(1, 'Orden Academico'),
(2, 'Orden Disciplinario'),
(3, 'De Orden Moral'),
(4, 'De Orden Social.');

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
  `acceso` varchar(1) NOT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_persona`, `id_rol`, `username`, `password`, `acceso`, `token`) VALUES
(1, 1, 1, 'siescolar', '8cb2237d0679ca88db6464eac60da96345513964', '1', NULL),
(2, 2, 5, 'adminvotante', '8cb2237d0679ca88db6464eac60da96345513964', '1', NULL),
(3, 3, 3, 'nepalomino3', '2a01fe4dc93784387454dd6ee8e5c747bcdc1ba4', '1', NULL),
(4, 4, 3, 'elcardiles4', 'a972cbbcbc6d6a9d30c820e879d8466238c9579a', '1', NULL),
(5, 5, 3, 'hureales5', '0e84d572b7333fa546986efebf32b90a63edeeed', '1', NULL),
(6, 6, 2, 'jebello6', '450987936f853e4fad9146f448a0f4f96d52fae5', '0', NULL),
(7, 7, 2, 'libello7', 'c30dd1d276c14f77e82fbfc77e440b918c32f170', '0', NULL),
(8, 8, 2, 'ancabas8', 'fe9e60be3a0543623bd658fe31329843f26dfe74', '0', NULL),
(9, 9, 2, 'dacardenas9', '23a0f5bbd3e8bdd3023dd9e35bef8cd18389e953', '0', NULL),
(10, 10, 2, 'saguerrero10', '7ec6433069d6b4da9e4e3b49f698064a65229867', '0', NULL),
(11, 11, 2, 'jubarragan11', '8eb1206f062361c54284437453bb0a0808ccdcae', '1', NULL),
(12, 12, 3, 'almorales12', '8a9164fe338482f77bd97f23fb85fe6685053eb2', '1', NULL),
(13, 13, 2, 'adguerrero13', 'f42a0c944ba9de775a22d43f10a5f13457123ea8', '1', NULL),
(14, 14, 3, 'anpalomino14', 'd1d6fa64fb614e67dd21da27fb9a2fb626c8e286', '1', NULL),
(15, 15, 2, 'joguerrero15', '56989deed91656cc2cb6a04b6dcfb9b60c1166cc', '1', NULL),
(16, 16, 3, 'melopez16', '30eefd8ed5c43feb7e5ad7e775b952adb7851d97', '1', NULL),
(17, 17, 3, 'edmendez17', '75a26819087f006d7a7526decffa3522693c69db', '1', NULL),
(18, 18, 2, 'jugutierrez18', 'fa9539fbfcd223f722690799e5bcfa32eef38032', '1', NULL),
(19, 19, 3, 'biberruecos19', 'c4401bfb23fb9e8d901c496c52a0196fa2f2d684', '1', NULL),
(20, 20, 2, 'anmendez20', 'fc4aa5559d637a97c25955f4bd71edf262663ba0', '1', NULL),
(21, 21, 3, 'daalfaro21', '95e02e97fda8fca8fee81b0001d8b1fcf4815526', '1', NULL),
(22, 22, 2, 'jhnobles22', '93cf1ac6dc121698d994061c93c2fc4d347441d5', '1', NULL),
(23, 23, 3, 'mabarros23', '9672617f6d08887e43325df29be194e22b5eea28', '1', NULL),
(24, 24, 2, 'donobles24', 'b93921ff3ecb6efd1d1e66157ffa58c0570dd08e', '1', NULL),
(25, 25, 3, 'armartinez25', 'a72e5025ea3c7b6424e3d8c535e24ad029d63e6a', '1', NULL),
(26, 26, 2, 'anortiz26', 'bf9b3acc5a5b97b3dd12c42f367ad32e70e7d2ee', '1', NULL),
(27, 27, 3, 'laqueruz27', '2276b4f2f9ce3a0dbec9a5085260c54cc78e4c49', '1', NULL),
(28, 28, 2, 'capacheco28', '955dda1ee2e2398e3698aa64910c353c6087c36d', '1', NULL),
(29, 29, 2, 'karamirez29', '4a2f6bdb5e85d0f39887643a1526a780ac13e7c4', '1', NULL),
(30, 30, 2, 'jurico30', 'c3f5da513e4acf814bbc2f8e093e733e55d35e1e', '1', NULL),
(31, 31, 3, 'irflorez31', '3fd3e1cecb415343e6eabdd4c6c5918f7845395b', '1', NULL),
(32, 32, 3, 'olflorez32', 'f3d1e09acd17ea92dbf658ac9ca5aea2ef535de1', '1', NULL),
(33, 33, 1, 'jenoblesad33', '99fbef4717adbe20034bac459a15d58e2e8d0582', '1', NULL),
(34, 34, 2, 'xiacuna34', '1ed6113f7201d5cdecc7ac7c4cc7dafe9dec48b7', '1', NULL),
(35, 35, 2, 'macabas35', '9228d29e344d7127c6ec2374aebf22e8ac95ab86', '1', NULL),
(36, 36, 2, 'antoloza 36', 'b42d3a17b78355ee7bda199bca127238c327dc0f', '1', NULL),
(37, 37, 2, 'elcabas37', '0e666e6bdc471e4ac1f9bc4fface15044f176150', '1', NULL),
(38, 38, 2, 'dacardenas 38', '5cf4f9f21fb71160d51babab3e5a8ed4d9ec7bae', '1', NULL),
(39, 39, 2, 'yutoloza 39', '04b3f2c4aee7a8f3671561e7da0d83926bf78bdf', '1', NULL),
(40, 40, 2, 'vide hoyos40', '3cc1444bde17f6813afc873a0f8bfe01af4e1364', '1', NULL),
(41, 41, 2, 'lurocha 41', '41f2a31452730cb73c76204773afce25f6714580', '1', NULL),
(42, 42, 2, 'zhflorez42', '8092ec3405bff63fbb04c398692f97684cf6ba87', '1', NULL),
(43, 43, 2, 'maguerrero43', 'd0e50b73471e9c4c92b2ab3102c0715b7354d7e7', '1', NULL),
(44, 44, 2, 'karocha44', '512d250abfffff298be6f82765a8d3fef6194acf', '1', NULL),
(45, 45, 2, 'mamartinez45', '92fd49db50c6834cd7ea75c6720a97b5d0b227fb', '1', NULL),
(46, 46, 2, 'jurocha 46', 'c3ad9a0c64b3502e478b1170db1e2887ecc7cf09', '1', NULL),
(47, 47, 2, 'jhmartinez47', '4f86a103d1a2450457ace5bb20f4278498921ea1', '1', NULL),
(48, 48, 2, 'jemedina48', 'b42b5e68c2b728a82f8727e10e120e459ebcc41a', '1', NULL),
(49, 49, 2, 'jhrocha49', '1ae82da6e3c6fd417e14d8dbf3e6108711d178b4', '1', NULL),
(50, 50, 2, 'samedina50', '3f96c795e2207679fead882e2a34c8c974270c09', '1', NULL),
(51, 51, 2, 'danobles51', '8a93ebf9030a045e467bc7c97d54356bbb09b805', '1', NULL),
(52, 52, 2, 'yareales52', '8bea421b79d8269d7730d6d7ace9595e4eb0fade', '1', NULL),
(53, 53, 4, 'johernandezac53', '7b5d28ed9e66a24ab5a52ab898603aad5eea562a', '1', NULL),
(54, 54, 4, 'mahernandezac54', 'ae4ec3d0e7717d0c9f32e56627b2713d6f797430', '1', NULL),
(55, 55, 4, 'adnoblesac55', 'd5795ace62726bb64416a2e56f5ed2056f16347e', '1', NULL),
(56, 56, 4, 'ancontrerasac56', '4a9967e8f08005e848d5c739dfbdca15b09c5f7f', '1', NULL),
(57, 57, 4, 'flortizac57', 'e07deb5ca227a486bcfa6e13573c159b985cef15', '1', NULL),
(58, 58, 4, 'nenoblesac58', 'b29e1a5c7d50f42526b541254b9a548831b0c9a7', '1', NULL),
(59, 59, 2, 'jucabas59', '286b9c22825c6f81c66807c7d9e4a592a6837ece', '1', NULL),
(60, 60, 2, 'yeberrueco60', 'd8ce390e97b1e0129650154a141e9a032d14c804', '1', NULL),
(61, 61, 2, 'macardenas61', '75d101cfcf626d86a780597dc6ce8449273a98c0', '1', NULL),
(62, 62, 2, 'viflorez62', '90057bc7d0b09362667758bf10a9430c9abc287f', '1', NULL),
(63, 63, 2, 'esflorian63', '179c526a94ae2832f0835424f5050f5eaf36a8e4', '1', NULL),
(64, 64, 2, 'joguerrero64', 'dd6cf1fa5f58dbf1c0e0bb58ffc5e0c10120eaae', '1', NULL),
(65, 65, 2, 'adcadena65', '74fdedbfacd64e2d4128fd79605f76e376b5d944', '1', NULL),
(66, 66, 2, 'caguerrero 66', '3d8e50f53c9f59b568832fb4f64eca97829d98b3', '1', NULL),
(67, 67, 2, 'yecontreras67', '4b6c096f83508d5b996defffa40a569d930f9911', '1', NULL),
(68, 68, 2, 'anguitierrez 68', '2e4387ce442c3c82166ff0575448728da78e8069', '1', NULL),
(69, 69, 2, 'joflorian69', '85622cce4ea5de0a127798c09f93926b94cd96a2', '1', NULL),
(70, 70, 2, 'ishernandez70', '4333a2469892b4dadbc6a567f242ab7e7828910e', '1', NULL),
(71, 71, 2, 'gehernandez71', 'fb7922602a36d239b68671613d56e99b296a3ec3', '1', NULL),
(72, 72, 2, 'vimartinez72', 'cae39bd925f5b17d6425614ca7d8103a37c67e3d', '1', NULL),
(73, 73, 2, 'jomartinez73', '0b46f33a0e9319edb5a1a2413d04b08b13a11a61', '1', NULL),
(74, 74, 2, 'nainfante74', 'eca0677cdea516fedaada35958f7ad5d87b9ac70', '1', NULL),
(75, 75, 2, 'ibrocha75', '4ff480e3454a9c07c8b0411235912bae8b1604f0', '1', NULL),
(76, 76, 2, 'shluqueta76', 'acafd621acc7f71069125870832fde1e4667cb83', '1', NULL),
(77, 77, 2, 'annobles77', 'e8299bda429b7c7e1912e10d976f157a18620632', '0', NULL),
(78, 78, 2, 'sanobles 78', 'b61df0c668426a502bca61b563b633b60ea0fb42', '1', NULL),
(79, 79, 2, 'dapalomino79', 'd910d8b0af5900865254596ec62fb7904a416666', '1', NULL),
(80, 80, 2, 'lupalomino80', 'f572af8eded8dbbebf2e0503bf068633bc34fc0e', '1', NULL),
(81, 81, 2, 'dapineda81', 'd82ff61e1c78a47742b3421a963ac9fa36cd7d3c', '1', NULL),
(82, 82, 2, 'lamartinez82', 'b8da50b74b7453ceccb5e6dd2f6bb310e7a7d2b6', '1', NULL),
(83, 83, 2, 'lurangel 83', 'f93310f231e18e9124b1adb9d58757a114879fc3', '1', NULL),
(84, 84, 2, 'jomiranda84', '16ec3b06b00f685c1c412a4f854d1133f779a751', '1', NULL),
(85, 85, 2, 'kerocha85', '6c96a1633e9a225dbae997d86d75460492f87660', '1', NULL),
(86, 86, 2, 'jhnobles86', '7b995a9b67ae8da79a5f3e866393a75bc658fa92', '1', NULL),
(87, 87, 2, 'alrocha87', 'e75af39048c19f5597bc5c32c24ee3b7d0a22c18', '1', NULL),
(88, 88, 2, 'mapacheco 88', '75b65458b781c92e973cd11f30e671ddcb3d2278', '1', NULL),
(89, 89, 2, 'orsoto89', 'd11bcc0cbaf2eaf51588e363d6797574dd80da32', '1', NULL),
(90, 90, 2, 'dapalomino90', 'eff9aa32cb272534e79440bdbc89274e5e09d20b', '1', NULL),
(91, 91, 2, 'vatoloza91', '17dd5edc0dc3d95f026b070b3e25cc95f2f804f3', '1', NULL),
(92, 92, 2, 'anpastrana92', '6944de5b2fcb68d1cf1413787d9094d2278492f6', '1', NULL),
(93, 93, 2, 'ketoloza93', '514daf801335be77eaa2a9c6fa18945973a73ed7', '1', NULL),
(94, 94, 2, 'edpineda94', 'b5dd0cfcebda1193691b5a31ccacfe3ee09a5e69', '1', NULL),
(95, 95, 2, 'luvalle95', 'e8058e478f4aa28b76531e7754671ac7ffa14cdd', '1', NULL),
(96, 96, 2, 'leramirez 96', '9f6820858c8de671d264a78897f6a108eb50039e', '1', NULL),
(97, 97, 2, 'osramirez97', '17bb51c32a33f427fc3d36d525f6e90f916131b2', '1', NULL),
(98, 98, 2, 'juramos98', '9326dc2425664bf0f306ec9e81beee2644b85277', '1', NULL),
(99, 99, 2, 'rosantos99', '78007e657635fbe7de285e08ec450b5b04d12671', '1', NULL),
(100, 100, 2, 'cavillar100', '01539bc2e9297343554d21736381d53fadd33586', '1', NULL),
(101, 101, 2, 'yewaltero101', 'd0846fac38898a353d6f1514f4b5253bf24cb335', '1', NULL),
(102, 102, 2, 'joandrade102', '50f968dc3e6e8368f64b947beadbd37a1c782df7', '0', NULL),
(103, 103, 2, 'macadena103', 'd0aec6f30c73bc1ffc56fdffc2b6f2a9b25e936b', '0', NULL),
(104, 104, 2, 'jhde hoyos104', '2b50b65c1ede135d7dcd45ce9b0d6d67b532b593', '0', NULL),
(105, 105, 2, 'nagomez105', '5ab15300f4228755c83e869bec524a0c534f7545', '0', NULL),
(106, 106, 2, 'joherrera 106', '91184b1eb9e9c7c8bc5c1c1fc8c4b0bebcebee6d', '0', NULL),
(107, 107, 2, 'laleon107', 'dd352c82ca2e61329e2eac8d722887b6cd53e7b4', '0', NULL),
(108, 108, 2, 'memendez108', '94bae3dae73de4950f01ace41a2a974b7759a025', '0', NULL),
(109, 109, 2, 'namiranda109', 'dae3ecab99cbcfc5c5986de43d225ab7d3981ea9', '0', NULL),
(110, 110, 2, 'rinobles110', '7cd3384cec8ba622218809416dba588e21f2dc74', '0', NULL),
(111, 111, 2, 'reortiz111', '5cf15eb640769df28fbdf9555951d6a12205a247', '0', NULL),
(112, 112, 2, 'vapacheco112', '66eb1bd182245db836ebd0ebd0f1017c42ed60a6', '0', NULL),
(113, 113, 2, 'orparra113', 'bf4f28b301db1b75d4a784bb448d72c21aa36ce5', '0', NULL),
(114, 114, 2, 'marangel114', '44699faf7ff013d9f3056b07f50859f8d63473f1', '0', NULL),
(115, 115, 2, 'joreales115', '76e029b2f0db835f0f2dfae889c965ba9022d558', '0', NULL),
(116, 116, 2, 'marico116', '3841c6f6b9c5a6c47b93734fc324c982c5bcbb72', '0', NULL),
(117, 117, 2, 'lurocha117', 'f2726e880e5b63c1086ca9160a28a30fab7cfe97', '0', NULL),
(118, 118, 2, 'rosantos118', '2dd6c728b05fb3607dd43569eae155ca6f98758d', '0', NULL),
(119, 119, 2, 'antoloza119', '5c7dbb8c2507f962dd05a4f2dc825a8ea3e467e3', '0', NULL),
(120, 120, 2, 'edtorres120', '649eda43894660f9b398d84149a559400815f792', '0', NULL),
(121, 121, 2, 'yeamaya121', '1a7f905c477ffba509d982358656acaf5408f64a', '0', NULL),
(122, 122, 2, 'luavila122', '1adfae7cae6a3b7b70d90ceb22a095dac7409779', '0', NULL),
(123, 123, 2, 'yeberrueco123', '8a1cc7e9b8a58905d145220ff4b0599763a6c372', '0', NULL),
(124, 124, 2, 'alflorian124', 'ee3ec94f039d28fa8b447c777ffb05c22a740561', '0', NULL),
(125, 125, 2, 'luguerrero125', '04369022b540907b8c4441d15e20a71853585b95', '0', NULL),
(126, 126, 2, 'sigutierrez 126', 'd1226c73e662e410c82720ab72823c9202998e27', '0', NULL),
(127, 127, 2, 'yuhernandez127', 'a57822e7ddcc98d4862f190f0a14e8434f496ff3', '0', NULL),
(128, 128, 2, 'camayorga128', 'f8fdc8159e7e34b878bf18c0dd1c6561854ee1a6', '0', NULL),
(129, 129, 2, 'nomedina129', 'd4e38c723a0ff499605481fa561de8e375771cc3', '0', NULL),
(130, 130, 2, 'dunobles130', '21d9af7232eaa73d075b87f6cff7518166d2bdfa', '0', NULL),
(131, 131, 2, 'lunobles131', '8ff823f98811841db28a3aa308868bcea15c390b', '0', NULL),
(132, 132, 2, 'manobles 132', '806250c2e59b1658dbb434a90b3e518ad651ee08', '0', NULL),
(133, 133, 2, 'ropalomino133', 'f4aaafea5fb71345159f187edfa4d81043828056', '0', NULL),
(134, 134, 2, 'dipere134', 'fd403f223854c061aed97f4ba4ee9bd624f0e8cb', '0', NULL),
(135, 135, 2, 'yarangel135', '540b91fcd47504f8bf055300868c5f1abf338df0', '0', NULL),
(136, 136, 2, 'husoto136', '9948cb999aa81e238a70368a86e495446d5cd4ff', '0', NULL),
(137, 137, 2, 'vatoloza137', '61f3b44199bfe27a24639a9c93598bc2ec1ddef7', '0', NULL),
(138, 138, 2, 'matoloza 138', '29f21e551cc4427a0f902538ee3b6bff56aa21fa', '0', NULL),
(139, 139, 2, 'yutoloza139', '91d445f5679379878006ac72c7ee72a939ff2cda', '0', NULL),
(140, 140, 2, 'vatoloza140', '8cb0ffa0ec67213db3addde05d37ad19f4fa8735', '0', NULL),
(141, 141, 2, 'kavillar 141', 'c829ae676f28f6bb7634b40ff31d5c0575ee25de', '0', NULL),
(142, 142, 2, 'ilortega142', '2ca27f9b8cd6c81abf9e755ee0c3a8019a3acdb7', '0', NULL),
(143, 143, 2, 'sapabon143', '817bed8983706dd6a44aaabe12551894928f48c0', '0', NULL),
(144, 144, 2, 'vaacuna144', '643cf7d15f5071d5655bbb57aeb055ea7a55ec6f', '0', NULL),
(145, 145, 2, 'araragon145', '7e8915e4af35356f80e931903956b9fa64581b97', '0', NULL),
(146, 146, 2, 'caberrueco146', '2cbad3b3ea1e8d9ddf09039eeca90810c7d07e50', '0', NULL),
(147, 147, 2, 'giberrueco147', '13ee3677a4f5d6db0526e9643129f4e2d7477f0d', '0', NULL),
(148, 148, 2, 'jocabas148', 'bf2b5c70f024689947d11bb87fea6d1249452322', '0', NULL),
(149, 149, 2, 'jocavas149', '8a76fb61eeff062d09e2c54b7bb5bf54b5ce1f28', '0', NULL),
(150, 150, 2, 'yecuadro150', '64aa84e7c4e9e0854907e3a70f03ac3437f5edf8', '0', NULL),
(151, 151, 2, 'crfernandez151', 'ee083ae43475f1fa48220d71fd3af809e0d0bd55', '0', NULL),
(152, 152, 2, 'sagomez 152', '93e08b7ac1a7ad6920b98b16f9dad2d742a7047c', '0', NULL),
(153, 153, 2, 'lugonzalez153', '6d6791353dc5ab07e23dbe090d9cfefd9438d4f8', '0', NULL),
(154, 154, 2, 'yahernandez154', '9de99ee47e16d926421ac8d3777543a4255f7f86', '0', NULL),
(155, 155, 2, 'pahernandez155', '0e1a276552d4b4d6c9cdd222c51697b60cceb356', '0', NULL),
(156, 156, 2, 'vihernandez 156', '4e912fae41f7c62a188567e2caf10c0f5cea8e70', '0', NULL),
(157, 157, 2, 'vainfante157', 'f1cb740fb8f220a2e8dbd4106d0b99f5947c2ab7', '0', NULL),
(158, 158, 2, 'alleon158', 'c33af22f739f2d14aaa31a8b0a015ead23c49116', '0', NULL),
(159, 159, 2, 'enmendez159', '4aeba2bffa4729d31411115803f2221a700420f2', '0', NULL),
(160, 160, 2, 'ommiranda160', '64f03deed3cb583d91003e7ea994758c0f651a69', '0', NULL),
(161, 161, 2, 'ilnobles161', 'cb58836196d1a3c6fd6d2c5b80427a81c1fa0a2d', '0', NULL),
(162, 162, 2, 'jhnobles162', '323e448fcb1f4e2564affcb113302881f00551d0', '0', NULL),
(163, 163, 2, 'annobles163', '98f536e6e3db6570dad8e46bee11afdc4bb66cc4', '0', NULL),
(164, 164, 2, 'diobregon164', 'd013138bdfb8899bcf102f32da4f0fb1f5c58245', '0', NULL),
(165, 165, 2, 'maotalora165', '1bb432b739b726769975b7535fd042e62e030001', '0', NULL),
(166, 166, 2, 'lupacheco166', 'fc4f7f90d04a999489387720ca868412152a0ac5', '0', NULL),
(167, 167, 2, 'vapastrana167', '53ba2eb50c6f1610bba45f20709f15bc4afb5ea0', '0', NULL),
(168, 168, 2, 'juramirez168', '77a4e22c0f902c1c0948e5e9ab714c89da84f603', '0', NULL),
(169, 169, 2, 'joreales169', '45a8a4e1e4154a57fb685c69a0538fb5ddb57456', '0', NULL),
(170, 170, 2, 'anreyna170', 'bf99b767b53845ce29da1069a617c087ecaf83a5', '0', NULL),
(171, 171, 2, 'rorico171', '62e3dcdf94228fb2c0b06bef26d21604ea96d755', '0', NULL),
(172, 172, 2, 'marocha172', '03635cd2090d529fcff19d67171c64b276c016ae', '0', NULL),
(173, 173, 2, 'setoloza173', '30e02d3b326a2b208b20c4d6c1133e52bdd4796c', '0', NULL),
(174, 174, 2, 'netoloza174', 'f1aa8c3152ee5eb5a01d493769200e4daa780d3b', '0', NULL),
(175, 175, 2, 'ketoloza175', '9ddf4c75115fb4be7dd869bde0f68237d33f55d8', '0', NULL),
(176, 176, 2, 'jutoloza176', '39c384ea0e511f8e7595eb4b00f48483a9943488', '0', NULL),
(177, 177, 2, 'lewaltero177', '4681f9735f5034b02bc86ba48c9c58476f7eb09f', '0', NULL),
(178, 178, 2, 'laavila178', '8b58ae06ddba1f6284586430393e2fab48f4e0df', '0', NULL),
(179, 179, 2, 'jubarrios179', '708dae5f9d858a555c72b3a98a5fa9f91825d0cf', '0', NULL),
(180, 180, 2, 'macadena180', '64942e73410658d4ae46b6083698b4dc00270b8b', '0', NULL),
(181, 181, 2, 'ancardenas181', '7164a55bb3cd90782ab10b916fb2f5e7612ce2db', '0', NULL),
(182, 182, 2, 'sadiaz182', '4b0f9c4caec28eb03b1e384e48af778b27bd73c7', '0', NULL),
(183, 183, 2, 'naflorez183', 'd24436d3a3222a23eacc4e18f78730c4b2897e67', '0', NULL),
(184, 184, 2, 'geinfante184', '5bca0416dc03ec00378c47b36357ae4f07481344', '0', NULL),
(185, 185, 2, 'yeleon185', '2b44f9598826e14fbcb095cc0afefe201506ee9e', '0', NULL),
(186, 186, 2, 'camedina186', '10d89cf81b08c508f015bd8ba9458463806a3887', '0', NULL),
(187, 187, 2, 'romiranda187', 'f1f09b4307ec327568e23f5920f42c3cb9f601a3', '0', NULL),
(188, 188, 2, 'lupabon188', '2ddbfae3e8836b0956de8f95265b4d82796e7852', '0', NULL),
(189, 189, 2, 'siperez189', '90d0886360536d2e804ac88f7a06e0cb0a1c1e83', '0', NULL),
(190, 190, 2, 'jarangel 190', '1da7d199713f1c0eae442fde739a05aa8e8c9dfe', '0', NULL),
(191, 191, 2, 'darondon191', '6074dd2ae7d478c274877a834f5d72acaae44105', '0', NULL),
(192, 192, 2, 'satoloza192', '8812a3349caa7ac137915dacc0818211107dd029', '0', NULL),
(193, 193, 2, 'civalle 193', '6be249f376e16a2b9038a0812acb169542daa604', '0', NULL),
(194, 194, 2, 'kavillar194', '5bebce609759f3dda0122c2a3e3eae1940eb4c1a', '0', NULL),
(195, 195, 2, 'sigutierrez195', '519f950328ba6c1cc2a7755a7f0b2509a96367c1', '0', NULL),
(196, 196, 2, 'edleon196', '91978e588c131668b3cc52e60ce0d0cb9d583408', '0', NULL),
(197, 197, 2, 'lumartinez197', '0a0164359f35dab05182c71b92625e670425d46b', '0', NULL),
(198, 198, 2, 'samartinez198', '0a7d4f455b7b67a78117f0c50c3fe98a401f1100', '0', NULL),
(199, 199, 2, 'yomejia199', 'c6b2f3cf422fc58599d1b37e513e932f6dc349c8', '0', NULL),
(200, 200, 2, 'adnobles 200', 'e1d515273ac140a6ba3100252c1a06044c57012f', '0', NULL),
(201, 201, 2, 'renobles201', 'bbdb60ab11036fc2dd166ff6c9c9b2f1ea27ca4a', '0', NULL),
(202, 202, 2, 'clortega 202', 'c05a50d54561dcc6d95bb1f15f0c4cf0e8aceb66', '0', NULL),
(203, 203, 2, 'miortega 203', 'f3a2756f78720c9430d6c620a46f4213d6fe3bdc', '0', NULL),
(204, 204, 2, 'jerico204', '613e652a85a59723aeff04bbb4ad794545d0c228', '0', NULL),
(205, 205, 2, 'lurico205', 'c6c30ab6234dbe6a3bf5b9a231c665263301f182', '0', NULL),
(206, 206, 2, 'shrodriguez206', 'b893ac9b8d2f093b9140ffa5040944afc8764a94', '0', NULL),
(207, 207, 2, 'casuarez207', 'ff88c7ac28858492480cce5d66c8c85baaa88bdc', '0', NULL),
(208, 208, 2, 'jetoloza208', '9162ba5f42f311fd38cd93df1164679ff301d2ec', '0', NULL),
(209, 209, 2, 'yitoloza209', 'ace622b269a3f5674253aac89b84e0db7bac47ad', '0', NULL),
(210, 210, 2, 'yitoloza210', 'b52ef45c4c5028288ce751d22de5392c39d62052', '0', NULL),
(211, 211, 2, 'ortoloza 211', '2224215b399d31750a0595921c4d12055b80b1da', '0', NULL),
(212, 212, 2, 'altoloza212', '8547781bc53e56b5e950e858d9150d047281d300', '0', NULL),
(213, 213, 2, 'jotoloza213', '4f7f3a1d34f96adaff9614d3261000419051d2a7', '0', NULL),
(214, 214, 2, 'matoloza214', 'ff28428955742ce5522cec6cb4be8cc761fdf876', '0', NULL),
(215, 215, 2, 'jetorres 215', '7fd50e1febcc325ebe92c0fbe048a0ec36daeb6c', '0', NULL),
(216, 216, 2, 'anvega216', '39e7a83329c897e3f296adbe7814bf7108092ef9', '0', NULL),
(217, 217, 2, 'movelasquez217', '15856fd6d610061dc23cdfe68176ce1ab7276a02', '0', NULL),
(218, 218, 2, 'luvillar218', '542e0a3b2c3a28c903a290b138265cfc331f8c95', '0', NULL),
(219, 219, 2, 'advillarreal 219', 'd081b14f65919929261f437ffaa564e65696141e', '0', NULL),
(220, 220, 2, 'cawaltero220', '6d7a54d3efce9cc760b70d396d9186356889ea2a', '0', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones_pedagogicas`
--
ALTER TABLE `acciones_pedagogicas`
  ADD PRIMARY KEY (`id_accion_pedagogica`);

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `acudientes`
--
ALTER TABLE `acudientes`
  ADD PRIMARY KEY (`id`,`id_persona`);

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `anos_lectivos`
--
ALTER TABLE `anos_lectivos`
  ADD PRIMARY KEY (`id_ano_lectivo`),
  ADD UNIQUE KEY `año_lectivo_UNIQUE` (`nombre_ano_lectivo`);

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
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id_asistencia`);

--
-- Indices de la tabla `candidatos_eleccion`
--
ALTER TABLE `candidatos_eleccion`
  ADD PRIMARY KEY (`id_candidato_eleccion`),
  ADD KEY `fk_candidatos_elecciones` (`id_eleccion`);

--
-- Indices de la tabla `cargas_academicas`
--
ALTER TABLE `cargas_academicas`
  ADD PRIMARY KEY (`id_carga_academica`),
  ADD UNIQUE KEY `id_cargaacademica_UNIQUE` (`id_carga_academica`),
  ADD KEY `fk_cargas_personas_idx` (`id_profesor`),
  ADD KEY `fk_cargas_asignaturas_idx` (`id_asignatura`),
  ADD KEY `fk_cargas_cursos_idx` (`id_curso`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `causales`
--
ALTER TABLE `causales`
  ADD PRIMARY KEY (`id_causal`),
  ADD KEY `fk_tipo_causal_idx` (`id_tipo_causal`);

--
-- Indices de la tabla `conceptos_pagos`
--
ALTER TABLE `conceptos_pagos`
  ADD PRIMARY KEY (`id_concepto_pago`);

--
-- Indices de la tabla `criterios`
--
ALTER TABLE `criterios`
  ADD PRIMARY KEY (`id_criterio`),
  ADD UNIQUE KEY `codigo_criterio_UNIQUE` (`codigo_criterio`);

--
-- Indices de la tabla `criterios_asignados`
--
ALTER TABLE `criterios_asignados`
  ADD PRIMARY KEY (`id_criterio_asignado`),
  ADD KEY `fk_criteriosasignados_criterios_idx` (`id_criterio`);

--
-- Indices de la tabla `cronogramas`
--
ALTER TABLE `cronogramas`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `fk_cronogramas_categorias_idx` (`id_categoria`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `fk_salones_idx` (`id_salon`),
  ADD KEY `fk_grados_idx` (`id_grado`),
  ADD KEY `fk_grupos_idx` (`id_grupo`);

--
-- Indices de la tabla `datos_institucion`
--
ALTER TABLE `datos_institucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`),
  ADD KEY `fk_departamentos_paises_idx` (`id_pais`);

--
-- Indices de la tabla `desempenos`
--
ALTER TABLE `desempenos`
  ADD PRIMARY KEY (`id_desempeno`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`);

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
-- Indices de la tabla `estudiantes_acudientes`
--
ALTER TABLE `estudiantes_acudientes`
  ADD PRIMARY KEY (`idestudiantes_acudientes`);

--
-- Indices de la tabla `estudiantes_padres`
--
ALTER TABLE `estudiantes_padres`
  ADD PRIMARY KEY (`idestudiantes_padres`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `grados_educacion`
--
ALTER TABLE `grados_educacion`
  ADD PRIMARY KEY (`id_grado_educacion`),
  ADD KEY `fk_niveles_idx` (`nivel_educacion`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `historial_estados`
--
ALTER TABLE `historial_estados`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `listado_votantes`
--
ALTER TABLE `listado_votantes`
  ADD PRIMARY KEY (`id_listado`),
  ADD KEY `fk_votantes_elecciones` (`id_eleccion`);

--
-- Indices de la tabla `logros`
--
ALTER TABLE `logros`
  ADD PRIMARY KEY (`id_logro`);

--
-- Indices de la tabla `logros_asignados`
--
ALTER TABLE `logros_asignados`
  ADD PRIMARY KEY (`id_logro_asignacion`),
  ADD KEY `fk_logros_estudiantes_idx` (`id_estudiante`),
  ADD KEY `fk_logros_grados_idx` (`id_grado`),
  ADD KEY `fk_logros_asignaturas_idx` (`id_asignatura`),
  ADD KEY `fk_logros_logros_idx` (`id_logro1`);

--
-- Indices de la tabla `madres`
--
ALTER TABLE `madres`
  ADD PRIMARY KEY (`id_madre`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `fk_salones_grupo_idx` (`id_curso`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `fk_municpios_departamentos_idx` (`id_departamento`);

--
-- Indices de la tabla `nivelaciones`
--
ALTER TABLE `nivelaciones`
  ADD PRIMARY KEY (`id_nivelacion`);

--
-- Indices de la tabla `nivelaciones_finales`
--
ALTER TABLE `nivelaciones_finales`
  ADD PRIMARY KEY (`id_nivelacion_final`);

--
-- Indices de la tabla `niveles_educacion`
--
ALTER TABLE `niveles_educacion`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `fk_notas_estudiantes_idx` (`id_estudiante`),
  ADD KEY `fk_notas_asignaturas_idx` (`id_asignatura`),
  ADD KEY `fk_notas_desempeños_idx` (`id_desempeno`),
  ADD KEY `fk_notas_grados_idx` (`id_grado`);

--
-- Indices de la tabla `notas_actividades`
--
ALTER TABLE `notas_actividades`
  ADD PRIMARY KEY (`id_planilla`),
  ADD KEY `fk_actividades_idx` (`id_actividad`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `padres`
--
ALTER TABLE `padres`
  ADD PRIMARY KEY (`id_padre`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD UNIQUE KEY `id_pago_UNIQUE` (`id_pago`),
  ADD KEY `fk_conceptos_pagos_idx` (`id_concepto_pago`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id_pais`);

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
-- Indices de la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD PRIMARY KEY (`id_retiro`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `salones`
--
ALTER TABLE `salones`
  ADD PRIMARY KEY (`id_salon`);

--
-- Indices de la tabla `seguimientos_disciplinarios`
--
ALTER TABLE `seguimientos_disciplinarios`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD KEY `fk_tipo_causal_idx` (`id_tipo_causal`),
  ADD KEY `fk_causal_idx` (`id_causal`),
  ADD KEY `fk_acciones_pedagogicas_idx` (`id_accion_pedagogica`);

--
-- Indices de la tabla `tipos_causales`
--
ALTER TABLE `tipos_causales`
  ADD PRIMARY KEY (`id_tipo_causal`);

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
-- AUTO_INCREMENT de la tabla `acciones_pedagogicas`
--
ALTER TABLE `acciones_pedagogicas`
  MODIFY `id_accion_pedagogica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `acudientes`
--
ALTER TABLE `acudientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `anos_lectivos`
--
ALTER TABLE `anos_lectivos`
  MODIFY `id_ano_lectivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `candidatos_eleccion`
--
ALTER TABLE `candidatos_eleccion`
  MODIFY `id_candidato_eleccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `cargas_academicas`
--
ALTER TABLE `cargas_academicas`
  MODIFY `id_carga_academica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `causales`
--
ALTER TABLE `causales`
  MODIFY `id_causal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `criterios`
--
ALTER TABLE `criterios`
  MODIFY `id_criterio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `criterios_asignados`
--
ALTER TABLE `criterios_asignados`
  MODIFY `id_criterio_asignado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `cronogramas`
--
ALTER TABLE `cronogramas`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `datos_institucion`
--
ALTER TABLE `datos_institucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;
--
-- AUTO_INCREMENT de la tabla `desempenos`
--
ALTER TABLE `desempenos`
  MODIFY `id_desempeno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `elecciones`
--
ALTER TABLE `elecciones`
  MODIFY `id_eleccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `estudiantes_acudientes`
--
ALTER TABLE `estudiantes_acudientes`
  MODIFY `idestudiantes_acudientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT de la tabla `estudiantes_padres`
--
ALTER TABLE `estudiantes_padres`
  MODIFY `idestudiantes_padres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `grados_educacion`
--
ALTER TABLE `grados_educacion`
  MODIFY `id_grado_educacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `historial_estados`
--
ALTER TABLE `historial_estados`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT de la tabla `listado_votantes`
--
ALTER TABLE `listado_votantes`
  MODIFY `id_listado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `logros`
--
ALTER TABLE `logros`
  MODIFY `id_logro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `logros_asignados`
--
ALTER TABLE `logros_asignados`
  MODIFY `id_logro_asignacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `madres`
--
ALTER TABLE `madres`
  MODIFY `id_madre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1314;
--
-- AUTO_INCREMENT de la tabla `nivelaciones`
--
ALTER TABLE `nivelaciones`
  MODIFY `id_nivelacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `nivelaciones_finales`
--
ALTER TABLE `nivelaciones_finales`
  MODIFY `id_nivelacion_final` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `niveles_educacion`
--
ALTER TABLE `niveles_educacion`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1368;
--
-- AUTO_INCREMENT de la tabla `notas_actividades`
--
ALTER TABLE `notas_actividades`
  MODIFY `id_planilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;
--
-- AUTO_INCREMENT de la tabla `padres`
--
ALTER TABLE `padres`
  MODIFY `id_padre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;
--
-- AUTO_INCREMENT de la tabla `pensum`
--
ALTER TABLE `pensum`
  MODIFY `id_pensum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;
--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `id_retiro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `salones`
--
ALTER TABLE `salones`
  MODIFY `id_salon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `seguimientos_disciplinarios`
--
ALTER TABLE `seguimientos_disciplinarios`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tipos_causales`
--
ALTER TABLE `tipos_causales`
  MODIFY `id_tipo_causal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;
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
  ADD CONSTRAINT `fk_cargas_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cargas_personas` FOREIGN KEY (`id_profesor`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `causales`
--
ALTER TABLE `causales`
  ADD CONSTRAINT `fk_tipo_causal` FOREIGN KEY (`id_tipo_causal`) REFERENCES `tipos_causales` (`id_tipo_causal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `criterios_asignados`
--
ALTER TABLE `criterios_asignados`
  ADD CONSTRAINT `fk_criteriosasignados_criterios` FOREIGN KEY (`id_criterio`) REFERENCES `criterios` (`id_criterio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cronogramas`
--
ALTER TABLE `cronogramas`
  ADD CONSTRAINT `fk_cronogramas_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_grados` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grupos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salones` FOREIGN KEY (`id_salon`) REFERENCES `salones` (`id_salon`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `fk_departamentos_paises` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grados_educacion`
--
ALTER TABLE `grados_educacion`
  ADD CONSTRAINT `fk_niveles` FOREIGN KEY (`nivel_educacion`) REFERENCES `niveles_educacion` (`id_nivel`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `listado_votantes`
--
ALTER TABLE `listado_votantes`
  ADD CONSTRAINT `fk_votantes_elecciones` FOREIGN KEY (`id_eleccion`) REFERENCES `elecciones` (`id_eleccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logros_asignados`
--
ALTER TABLE `logros_asignados`
  ADD CONSTRAINT `fk_logros_asignaturas` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logros_estudiantes` FOREIGN KEY (`id_estudiante`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logros_grados` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_logros_logros` FOREIGN KEY (`id_logro1`) REFERENCES `logros` (`id_logro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `fk_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `fk_municpios_departamentos` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `fk_notas_asignaturas` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_desempeños` FOREIGN KEY (`id_desempeno`) REFERENCES `desempenos` (`id_desempeno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_estudiantes` FOREIGN KEY (`id_estudiante`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_grados` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notas_actividades`
--
ALTER TABLE `notas_actividades`
  ADD CONSTRAINT `fk_actividades` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_conceptos_pagos` FOREIGN KEY (`id_concepto_pago`) REFERENCES `conceptos_pagos` (`id_concepto_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pensum`
--
ALTER TABLE `pensum`
  ADD CONSTRAINT `fk_pensum_asignaturas` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pensum_grados` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seguimientos_disciplinarios`
--
ALTER TABLE `seguimientos_disciplinarios`
  ADD CONSTRAINT `fk_acciones_pedagogicas` FOREIGN KEY (`id_accion_pedagogica`) REFERENCES `acciones_pedagogicas` (`id_accion_pedagogica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_causal` FOREIGN KEY (`id_causal`) REFERENCES `causales` (`id_causal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_causall` FOREIGN KEY (`id_tipo_causal`) REFERENCES `tipos_causales` (`id_tipo_causal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
