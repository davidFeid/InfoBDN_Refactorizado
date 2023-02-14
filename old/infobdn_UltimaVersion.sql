-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2022 a las 12:45:06
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infobdn`
--
CREATE DATABASE IF NOT EXISTS `infobdn` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `infobdn`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `dni` varchar(9) NOT NULL,
  `contraseña` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`dni`, `contraseña`) VALUES
('54907494p', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `edad` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`dni`, `nombre`, `apellido`, `edad`, `foto`, `mail`, `contraseña`, `activo`) VALUES
('12345678a', 'alberto', 'agil', 21, '../fotos_alumnos/foto_12345678a.jpg', 'a@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
('12345678u', 'daniel', 'jara', 21, '../fotos_alumnos/foto_12345678u.jpg', 'da@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
('54907494p', 'david2', 'raigoza', 19, '../fotos_alumnos/foto_54907494p.jpg', 'david@da.com', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `horas` int(11) NOT NULL,
  `fecha inicio` date NOT NULL,
  `fecha final` date NOT NULL,
  `foto` varchar(30) NOT NULL,
  `profesor` varchar(9) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`codigo`, `nombre`, `descripcion`, `horas`, `fecha inicio`, `fecha final`, `foto`, `profesor`, `activo`) VALUES
(2, 'Programación Python', '¿Qué es Python? Si has llegado hasta aquí, es probable que ya tengas algunas nociones sobre programación, aunque no estés especializado en Python. Python es un lenguaje de programación de alto nivel que se puede usar para prácticamente cualquier cosa, incluso existen videojuegos que emplean este lenguaje de programación', 20, '2022-10-18', '2022-11-01', '../fotos_cursos/foto_2.jpg', '54785478y', 1),
(3, 'Programador Java', 'El mundo de internet, el comercio digital, la comunicación y el marketing está cambiando y modernizándose cada vez más, por eso es importante estar al día y saber adaptarse a las novedades en estos sectores.\r\n\r\nEn este contexto, cada vez es más necesario contar con un sitio web que cubra las necesidades de cada empresa, y este sitio web deben diseñarlo especialistas en programación.', 45, '2022-10-10', '2022-11-06', '../fotos_cursos/foto_3.jpg', '54785478y', 1),
(4, 'Ciberseguridad', 'Internet está cada vez más presente en nuestras vidas. Y no solo en el área personal, sino también en las empresas, que se han lanzado de cabeza a la digitalización de sus procesos y servicios. Las posibilidades en este ámbito no tienen límites, pero tampoco los peligros a los que se exponen los usuarios. Es por eso por lo que, con el mundo online, han llegado para quedarse los “guardaespaldas” de las redes. ¿Quiénes? Tú, si optas por un curso de Ciberseguridad y te formas para convertirte en un especialista.', 25, '2022-10-26', '2022-11-06', '../fotos_cursos/foto_4.jpg', '87654321t', 0),
(5, 'Auditor de Seguridad Informáti', 'La digitalización de la vida privada y pública está poniendo sobre la mesa una serie de problemáticas que conciernen a nuestra seguridad e intimidad, y que en los últimos años ha llevado a que las empresas implementen sistemas de seguridad y estrategias preventivas para resistir todo tipo de ciberataques.', 30, '2022-10-20', '2022-11-06', '../fotos_cursos/foto_5.jpg', '12345678t', 1),
(6, 'Prestashop', 'Si quieres construir tiendas online completamente funcionales partiendo de cero, de la nada, estás en el lugar adecuado. Quédate en Cursos.com porque te vamos a ayudar a conseguirlo.\r\n\r\nPara que aprendas a diseñar, usar la tecnología, dominar los catálogos y temas que precisan los posibles clientes, necesitas una formación especializada como un Curso de Prestashop.', 20, '2022-10-01', '2022-10-05', '../fotos_cursos/foto_6.jpg', '54785478y', 1),
(7, 'Unity 3D 2', 'Algunos videojuegos de éxito como Cuphead, Hearthstone, Ori and the Blind Forest o Pokemon GO han sido creados con un mismo programa informático: Unity 3D. Se trata de un motor gráfico de código abierto muy utilizado en la industria del desarrollo de videojuegos.', 30, '2022-10-18', '2022-11-04', '../fotos_cursos/foto_7.jpg', '12345678t', 1),
(8, 'Modelado 3D', '¿Disfrutas admirando los modelados en tres dimensiones en películas de animación o videojuegos? ¿Te gustaría ser capaz de realizar tus propios diseños y animarlos en un mundo completamente imaginado por ti? Lo que necesitas es un curso en Modelado 3D.', 25, '2022-10-29', '2022-11-11', '../fotos_cursos/foto_8.jpg', '12345678t', 1),
(9, 'Machine Learning', 'Como expertos en formación podemos ayudarte a encontrar el mejor curso de Machine learning que te permitirá dar un salto cualitativo en tu currículum.\r\n\r\nNo pierdas la oportunidad de formarte en las tecnologías que ya forman parte del presente en el sector de la programación y cuya demanda de profesionales especializados aumenta cada día. Encuentra con nuestra ayuda el curso de Machine learning perfecto para ti, que te permitirá dar un giro a tu futuro profesional.', 30, '2022-11-04', '2022-11-23', '../fotos_cursos/foto_9.jpg', '54785478y', 1),
(10, 'grafista de videojuegos', 'El sector de los videojuegos está en claro auge, y uno de los puestos de trabajo más demandados y mejor valorados es el de grafista de videojuegos. Si te apasiona el mundo de las tecnologías esta puede ser una oportunidad única para que comiences a formarte en un área que te apasiona.', 30, '2022-10-19', '2022-11-05', '../fotos_cursos/foto_10.jpg', '87654321t', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `dni_alumno` varchar(9) NOT NULL,
  `curso` int(11) NOT NULL,
  `nota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`dni_alumno`, `curso`, `nota`) VALUES
('12345678u', 2, NULL),
('12345678u', 3, NULL),
('12345678u', 4, NULL),
('12345678u', 6, 4),
('12345678u', 7, NULL),
('54907494p', 3, 0),
('54907494p', 5, NULL),
('54907494p', 6, 7),
('54907494p', 7, NULL),
('54907494p', 8, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `titulo academico` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`dni`, `nombre`, `apellido`, `titulo academico`, `foto`, `contraseña`, `activo`) VALUES
('12345678t', 'Raul', 'Murillo', 'Trigonometria', '/InfoBDN/fotos/foto_12345678t.jpg', '21232f297a57a5a743894a0e4a801fc3', 1),
('54785478y', 'Iker', 'Romero', 'DAW', '/InfoBDN/fotos/foto_54785478y.jpg', '21232f297a57a5a743894a0e4a801fc3', 1),
('87654321t', 'Laura', 'Jaramillo', 'Ingeniera Aeronautica', '/InfoBDN/fotos/foto_87654321t.jpg', '21232f297a57a5a743894a0e4a801fc3', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `profesor` (`profesor`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`dni_alumno`,`curso`),
  ADD KEY `curso` (`curso`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`profesor`) REFERENCES `profesores` (`dni`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`dni_alumno`) REFERENCES `alumnos` (`dni`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`curso`) REFERENCES `cursos` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
