-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-12-2017 a las 01:48:39
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
-- Estructura de tabla para la tabla `acudientes`
--

CREATE TABLE `acudientes` (
  `id_persona` int(11) NOT NULL,
  `parentesco` varchar(45) NOT NULL,
  `ocupacion` varchar(45) NOT NULL,
  `telefono_trabajo` varchar(10) NOT NULL,
  `direccion_trabajo` varchar(45) NOT NULL,
  `estado_acudiente` varchar(8) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anos_lectivos`
--

CREATE TABLE `anos_lectivos` (
  `id_ano_lectivo` int(11) NOT NULL,
  `nombre_ano_lectivo` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anos_lectivos`
--

INSERT INTO `anos_lectivos` (`id_ano_lectivo`, `nombre_ano_lectivo`) VALUES
(1, 2010),
(2, 2011),
(3, 2012),
(4, 2013),
(5, 2014),
(6, 2015),
(7, 2016),
(8, 2017),
(9, 2018);

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
  `id_curso` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `ano_lectivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Primero', 1, 'apertura para ingreso de notas para el primer periodo', '2017-09-05', '2017-09-15', 8, 'activo'),
(2, 'Segundo', 1, 'apertura para ingreso de notas para el segundo periodo', '2017-09-05', '2017-09-05', 8, 'inactivo'),
(3, 'Tercero', 1, 'apertura para ingreso de notas para el tercer periodo', '2017-09-05', '2017-09-05', 8, 'inactivo'),
(4, 'Cuarto', 1, 'apertura para ingreso de notas para el cuarto periodo', '2017-09-05', '2017-09-05', 8, 'inactivo');

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
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `escudo` varchar(45) NOT NULL,
  `rector` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_institucion`
--

INSERT INTO `datos_institucion` (`id`, `nombre_institucion`, `niveles_educacion`, `resolucion`, `dane`, `nit`, `direccion`, `telefono`, `email`, `escudo`, `rector`) VALUES
(1, 'CENTRO EDUCATIVO NUESTRA SEÑORA DEL CARMEN', 'Educación Prescolar, Básica Primaria, Básica Secundaria y Media', 'Aprobado según Resolucion 000209 del 29 de octubre de 2015', 'Registro DANE N° 120001001219', 'Nit: 892,300,306-2', 'calle 7 # 29-90', '5807659', 'cenuestraseñoradelcarmen@gmail.com', 'logo_example.jpg', 'Alvaro Araujo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre_departamento`) VALUES
(5, 'ANTIOQUIA'),
(8, 'ATLANTICO'),
(11, 'BOGOTA'),
(13, 'BOLIVAR'),
(15, 'BOYACA'),
(17, 'CALDAS'),
(18, 'CAQUETA'),
(19, 'CAUCA'),
(20, 'CESAR'),
(23, 'CORDOBA'),
(25, 'CUNDINAMARCA'),
(27, 'CHOCO'),
(41, 'HUILA'),
(44, 'LA GUAJIRA'),
(47, 'MAGDALENA'),
(50, 'META'),
(52, 'NARIÑO'),
(54, 'N. DE SANTANDER'),
(63, 'QUINDIO'),
(66, 'RISARALDA'),
(68, 'SANTANDER'),
(70, 'SUCRE'),
(73, 'TOLIMA'),
(76, 'VALLE DEL CAUCA'),
(81, 'ARAUCA'),
(85, 'CASANARE'),
(86, 'PUTUMAYO'),
(88, 'SAN ANDRES'),
(91, 'AMAZONAS'),
(94, 'GUAINIA'),
(95, 'GUAVIARE'),
(97, 'VAUPES'),
(99, 'VICHADA');

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
(1, 'Superior', '4.6', '5.0', 8),
(2, 'Alto', '4.0', '4.5', 8),
(3, 'Básico', '3.0', '3.9', 8),
(4, 'Bajo', '1.0', '2.9', 8),
(5, 'Bajo', '0.0', '0.9', 8);

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
  `discapacidad` varchar(45) NOT NULL,
  `institucion_procedencia` varchar(45) NOT NULL,
  `grado_cursado` varchar(45) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `estado_estudiante` varchar(8) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_persona`, `discapacidad`, `institucion_procedencia`, `grado_cursado`, `anio`, `estado_estudiante`) VALUES
(2, 'ninguna', 'manuela beltran', 'Primero', '2007', 'Activo'),
(3, 'ninguna', 'cotez queruz', 'Quinto', '2007', 'Activo'),
(4, 'ninguna', 'la esperanza', 'Quinto', '2008', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_acudientes`
--

CREATE TABLE `estudiantes_acudientes` (
  `idestudiantes_acudientes` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_acudiente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 2, 1, 1),
(2, 3, 2, 2),
(3, 4, 3, 3);

--
-- Disparadores `estudiantes_padres`
--
DELIMITER $$
CREATE TRIGGER `eliminar_padres_madres` AFTER DELETE ON `estudiantes_padres` FOR EACH ROW -- Edit trigger body code below this line. Do not edit lines above this one
begin
-- Edit trigger body code below this line. Do not edit lines above this one
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
  `ciclo_grado` varchar(45) NOT NULL,
  `jornada` varchar(30) NOT NULL,
  `ano_lectivo` int(11) NOT NULL,
  `estado_grado` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, '456', 'Lola', 'Lopez', 'Lopez', 'Madre', 'f', '322', 'Calle 4', 'Popa', 'D', '32', 'Calle 3'),
(2, '457', 'Lina', 'Caceres', 'Caceres', 'Madre', 'f', '321', 'Calle 4', 'Popa', 'D', '23', 'Calle 3'),
(3, '457', 'Laura', 'Diaz', 'Diaz', 'Madre', 'f', '320', 'Calle 4', 'Nevada', 'D', '32', 'Calle 4');

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
  `observaciones` varchar(45) NOT NULL,
  `estado_matricula` varchar(8) NOT NULL,
  `jornada` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `matriculas`
--
DELIMITER $$
CREATE TRIGGER `denegar_acceso_usuario` AFTER DELETE ON `matriculas` FOR EACH ROW begin
-- Edit trigger body code below this line. Do not edit lines above this one
UPDATE usuarios set acceso="0" where id_persona=old.id_estudiante;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `permitir_acceso_usuario` AFTER INSERT ON `matriculas` FOR EACH ROW -- Edit trigger body code below this line. Do not edit lines above this one
begin
-- Edit trigger body code below this line. Do not edit lines above this one
UPDATE usuarios set acceso="1" where id_persona=new.id_estudiante;
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
(1120, 'CUMARIBO', 99);

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
  `id_desempeno` int(11) DEFAULT NULL,
  `fallas` varchar(2) NOT NULL,
  `estado_nota` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `autor` varchar(45) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `mensaje` varchar(300) NOT NULL,
  `destinatario` varchar(45) NOT NULL,
  `fecha_evento` date NOT NULL,
  `hora_evento` time NOT NULL,
  `fecha_envio` datetime NOT NULL,
  `estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, '1010', 'Flavio', 'Mindiola', 'Suarez', 'Padre', 'm', '678', 'calle 4', 'El Prado1', 'yui', '678', 'ghj'),
(2, '1011', 'Pedro', 'Martinez', 'Mejia', 'Padre', 'm', '678', 'calle 5', 'El Prado2', 'yui', '678', 'ghj'),
(3, '1012', 'Juan', 'Suarez', 'Diaz', 'Padre', 'm', '678', 'calle 4', 'El Prado3', 'yui', '678', 'ghj');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `tipo_id` varchar(2) NOT NULL,
  `fecha_expedicion` date DEFAULT NULL,
  `departamento_expedicion` int(11) DEFAULT NULL,
  `municipio_expedicion` int(11) DEFAULT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellido1` varchar(45) NOT NULL,
  `apellido2` varchar(45) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `departamento_nacimiento` int(11) DEFAULT NULL,
  `municipio_nacimiento` int(11) DEFAULT NULL,
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

INSERT INTO `personas` (`id_persona`, `identificacion`, `tipo_id`, `fecha_expedicion`, `departamento_expedicion`, `municipio_expedicion`, `nombres`, `apellido1`, `apellido2`, `sexo`, `fecha_nacimiento`, `departamento_nacimiento`, `municipio_nacimiento`, `tipo_sangre`, `eps`, `poblacion`, `telefono`, `email`, `direccion`, `barrio`) VALUES
(1, '12345', 'cc', '2017-04-10', 20, 404, 'Siescolar', 'Siescolar', 'Siescolar', 'm', '2017-04-10', 20, 404, 'o+', 'ninguna', 'ninguna', '3135028786', 'siescolar@gmail.com', 'calle 7 # 29-90', 'nueva esperanza'),
(2, '1065', 'ti', '2000-04-10', 20, 404, 'Julio', 'Cesar', 'Frias', 'm', '2000-04-10', 20, 404, 'o+', 'ninguna', 'ninguna', '3126874534', 'juliocfrias@gmail.com', 'calle 7 # 29-87', 'garupal'),
(3, '1066', 'cc', '1990-05-05', 20, 404, 'Hugo', 'Mairon', 'Sosa', 'm', '1990-05-05', 20, 404, 'o+', 'ninguna', 'ninguna', '3004567891', 'hugososa@gmail.com', 'calle 7c # 29-31', 'villa concha'),
(4, '1067', 'ti', '1998-06-06', 20, 404, 'Sebastian', 'Andres', 'Romero', 'm', '1998-06-06', 20, 404, 'o+', 'ninguna', 'ninguna', '3012345678', 'sebasromero@gmail.com', 'calle 8 # 31-39', 'esperanza'),
(5, '323', 'cc', '1990-06-07', 20, 404, 'Omar', 'Trujillo', 'Varilla', 'm', '1990-06-07', 20, 404, 'o+', 'ninguna', 'ninguna', '3145123412', 'omartt@gmail.com', 'carrera 9 #12-14', 'altagracia'),
(6, '324', 'cc', '1990-05-10', 20, 404, 'Yoalis', 'Suarez', 'Saumeth', 'f', '1990-05-10', 20, 404, 'o-', 'ninguna', 'ninguna', '3123123434', 'yocesusa@gmail.com', 'calle 6c # 29-86', 'arizona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_persona` int(11) NOT NULL,
  `perfil` varchar(45) NOT NULL,
  `escalafon` varchar(45) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `tipo_contrato` varchar(45) NOT NULL,
  `estado_profesor` varchar(8) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_persona`, `perfil`, `escalafon`, `fecha_inicio`, `tipo_contrato`, `estado_profesor`) VALUES
(5, 'profesional', '10', '2017-01-01', '2017-12-12', 'Activo'),
(6, 'profesional', '10', '2017-01-01', '2017-12-12', 'Activo');

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
  `ano_lectivo` int(11) NOT NULL,
  `estado_salon` varchar(8) NOT NULL,
  `disponibilidad` varchar(2) NOT NULL
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
(2, 2, 2, 'jfirias', '8cb2237d0679ca88db6464eac60da96345513964', '1'),
(3, 3, 2, 'hsosa', '8cb2237d0679ca88db6464eac60da96345513964', '1'),
(4, 4, 2, 'sromero', '8cb2237d0679ca88db6464eac60da96345513964', '1'),
(5, 5, 3, 'omartt', '8cb2237d0679ca88db6464eac60da96345513964', '1'),
(6, 6, 3, 'yoaliss', '8cb2237d0679ca88db6464eac60da96345513964', '1');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `eliminar_estudiantes_personas` AFTER DELETE ON `usuarios` FOR EACH ROW begin
-- Edit trigger body code below this line. Do not edit lines above this one
DELETE FROM estudiantes where id_persona=old.id_persona;
DELETE FROM personas where id_persona=old.id_persona;
DELETE FROM profesores where id_persona=old.id_persona;
DELETE FROM estudiantes_padres where id_estudiante=old.id_persona;
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
  ADD KEY `fk_cargas_cursos_idx` (`id_curso`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `conceptos_pagos`
--
ALTER TABLE `conceptos_pagos`
  ADD PRIMARY KEY (`id_concepto_pago`);

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
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `desempenos`
--
ALTER TABLE `desempenos`
  ADD PRIMARY KEY (`id_desempeno`);

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
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `fk_notas_estudiantes_idx` (`id_estudiante`),
  ADD KEY `fk_notas_asignaturas_idx` (`id_asignatura`),
  ADD KEY `fk_notas_desempeños_idx` (`id_desempeno`),
  ADD KEY `fk_notas_grados_idx` (`id_grado`);

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
  ADD PRIMARY KEY (`id_salon`);

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
-- AUTO_INCREMENT de la tabla `anos_lectivos`
--
ALTER TABLE `anos_lectivos`
  MODIFY `id_ano_lectivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `cronogramas`
--
ALTER TABLE `cronogramas`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `datos_institucion`
--
ALTER TABLE `datos_institucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT de la tabla `desempenos`
--
ALTER TABLE `desempenos`
  MODIFY `id_desempeno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `elecciones`
--
ALTER TABLE `elecciones`
  MODIFY `id_eleccion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estudiantes_acudientes`
--
ALTER TABLE `estudiantes_acudientes`
  MODIFY `idestudiantes_acudientes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estudiantes_padres`
--
ALTER TABLE `estudiantes_padres`
  MODIFY `idestudiantes_padres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id_madre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1121;
--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `padres`
--
ALTER TABLE `padres`
  MODIFY `id_padre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pensum`
--
ALTER TABLE `pensum`
  MODIFY `id_pensum` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
