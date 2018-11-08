-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2018 at 04:36 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyecto_cobay`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrativos`
--

CREATE TABLE `administrativos` (
  `matricula` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `cargo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `administrativos`
--

INSERT INTO `administrativos` (`matricula`, `password`, `cargo`, `nombre`) VALUES
('00003', 'petro', '', ''),
('0001', 'admin', 'jefe', 'aaron');

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

CREATE TABLE `alumnos` (
  `matricula` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`matricula`, `password`, `nombre`, `id_status`) VALUES
('15B003000462', '', 'CHALE CHIM SINAI VIRIDIANA', 1),
('17B003000004', '', 'ACOSTA CHUC JOSHUA JONATHAN', 1),
('17B003000014', '', 'ALDANA NAAL JESUS ALFONSO', 1),
('17B003000016', '', 'ALFARO UITZIL SAMUEL ABRAHAM', 1),
('17B003000027', '', 'ARCEO FERREYRA EMILIANO DE JESUS', 2),
('17B003000037', '', 'AZCORRA ORTIZ KAREN ANGELICA', 2),
('17B003000038', '', 'AZUETA PACHECO LUIS ENRIQUE', 2),
('17B003000056', '', 'BUENO QUINO TATIANA', 1),
('17B003000061', '', 'CAB CANUL ISIDRO JAYR', 2),
('17B003000114', '', 'CHI TAMAY BRIGIDA DEL ROSARIO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `alumno_status`
--

CREATE TABLE `alumno_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `alumno_status`
--

INSERT INTO `alumno_status` (`id_status`, `status`) VALUES
(1, 'REGULAR'),
(2, 'IRREGULAR');

-- --------------------------------------------------------

--
-- Table structure for table `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id_asignatura` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `asignatura` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `asignaturas`
--

INSERT INTO `asignaturas` (`id_asignatura`, `asignatura`) VALUES
('17-B211010721A', 'INFORMATICA I'),
('17-B211010721B', 'QUIMICA'),
('17-B211010721C', 'CALCULO'),
('17-B211010721E', 'ETICA'),
('17-B211010721F', 'FISICA'),
('17-B211010721H', 'HISTORIA'),
('17-B211010721I', 'INGLES'),
('17-B211010721M', 'MATEMATICAS'),
('17-B211010721T', 'TALLER DE LECTURA Y REDACCION'),
('17-B211010721U', 'INFORMATICA II'),
('ejemplo', 'prueba');

-- --------------------------------------------------------

--
-- Table structure for table `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id_calificaciones` int(25) NOT NULL,
  `parcial_uno` int(3) NOT NULL,
  `parcial_dos` int(3) NOT NULL,
  `ordinario` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `calificaciones`
--

INSERT INTO `calificaciones` (`id_calificaciones`, `parcial_uno`, `parcial_dos`, `ordinario`) VALUES
(0, 35, 35, 30);

-- --------------------------------------------------------

--
-- Table structure for table `excel`
--

CREATE TABLE `excel` (
  `id_excel` int(11) NOT NULL,
  `id_plantel` int(11) NOT NULL,
  `id_semestre` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `matricula` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `excel`
--

INSERT INTO `excel` (`id_excel`, `id_plantel`, `id_semestre`, `id_grupo`, `matricula`) VALUES
(1, 1, 2, 10, '17B003000004'),
(6, 1, 2, 10, '17B003000037'),
(3, 1, 3, 1, '15B003000462'),
(4, 1, 5, 3, '17B003000027'),
(7, 2, 3, 12, '17B003000056'),
(5, 8, 6, 4, '17B003000061');

-- --------------------------------------------------------

--
-- Table structure for table `excel_asignatura`
--

CREATE TABLE `excel_asignatura` (
  `id_excel_asignatura` int(25) NOT NULL,
  `id_asignatura` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `id_calificaciones` int(25) NOT NULL,
  `matricula_maestro` bigint(20) NOT NULL,
  `id_excel` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `excel_asignatura`
--

INSERT INTO `excel_asignatura` (`id_excel_asignatura`, `id_asignatura`, `id_calificaciones`, `matricula_maestro`, `id_excel`, `id_plan`, `id_periodo`) VALUES
(1, '17-B211010721U', 0, 11003000080, 1, 7, 6),
(3, '17-B211010721C', 0, 11003000080, 3, 7, 6),
(4, '17-B211010721E', 0, 11003000085, 4, 7, 6),
(5, '17-B211010721A', 0, 11003000080, 5, 7, 6),
(6, '17-B211010721H', 0, 11003000080, 6, 7, 6),
(7, '17-B211010721I', 0, 11003000080, 7, 7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `grupo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `grupo`) VALUES
(1, 'AM'),
(2, 'AV'),
(3, 'BM'),
(4, 'BV'),
(5, 'CM'),
(6, 'CV'),
(7, 'DM'),
(8, 'DV'),
(9, 'EM'),
(10, 'EV'),
(11, 'FM'),
(12, 'FV');

-- --------------------------------------------------------

--
-- Table structure for table `maestros`
--

CREATE TABLE `maestros` (
  `matricula_maestro` bigint(20) NOT NULL,
  `password` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `id_status_maestro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `maestros`
--

INSERT INTO `maestros` (`matricula_maestro`, `password`, `nombre`, `id_status_maestro`) VALUES
(11003000080, '', 'MONTERO CASTRO SAKURA MARIA', 1),
(11003000081, '', 'ALVAREZ MARLY', 1),
(11003000082, '', 'CANUL GEMMA', 1),
(11003000083, '', 'GARCIA MAURA', 1),
(11003000084, '', 'SOSA ALICIA', 1),
(11003000085, '', 'BRAGA JOSE', 2);

-- --------------------------------------------------------

--
-- Table structure for table `maestro_status`
--

CREATE TABLE `maestro_status` (
  `id_status_maestro` int(11) NOT NULL,
  `status_maestro` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `maestro_status`
--

INSERT INTO `maestro_status` (`id_status_maestro`, `status_maestro`) VALUES
(1, 'BASE'),
(2, 'CONTRATO');

-- --------------------------------------------------------

--
-- Table structure for table `periodos`
--

CREATE TABLE `periodos` (
  `id_periodo` int(11) NOT NULL,
  `periodo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `id_status_periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `periodos`
--

INSERT INTO `periodos` (`id_periodo`, `periodo`, `id_status_periodo`) VALUES
(1, '2015B', 2),
(2, '2016A', 2),
(3, '2016B', 2),
(4, '2017A', 2),
(5, '2017B', 2),
(6, '2018A', 2),
(7, '2018B', 1),
(8, '2019A', 2);

-- --------------------------------------------------------

--
-- Table structure for table `periodo_status`
--

CREATE TABLE `periodo_status` (
  `id_status_periodo` int(11) NOT NULL,
  `status_periodo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `periodo_status`
--

INSERT INTO `periodo_status` (`id_status_periodo`, `status_periodo`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE `planes` (
  `id_plan` int(11) NOT NULL,
  `plan` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `id_status_plan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id_plan`, `plan`, `id_status_plan`) VALUES
(1, '12-B', 1),
(2, '13-B', 1),
(3, '14-B', 1),
(4, '15-B', 1),
(5, '16-B', 1),
(6, '17-B', 1),
(7, '18-B', 1),
(8, '19-B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `planteles`
--

CREATE TABLE `planteles` (
  `id_plantel` int(11) NOT NULL,
  `plantel` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `planteles`
--

INSERT INTO `planteles` (`id_plantel`, `plantel`) VALUES
(1, 'PROGRESO'),
(2, 'BACA'),
(3, 'CHENKU'),
(4, 'CACALCHEN'),
(5, 'TIZIMIN'),
(6, 'CHOLUL'),
(7, 'AKIL'),
(8, 'CAUCEL'),
(9, 'DZEMUL'),
(10, 'ACANCEH');

-- --------------------------------------------------------

--
-- Table structure for table `plan_status`
--

CREATE TABLE `plan_status` (
  `id_status_plan` int(11) NOT NULL,
  `status_plan` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `plan_status`
--

INSERT INTO `plan_status` (`id_status_plan`, `status_plan`) VALUES
(1, 'ACTIVO'),
(2, 'DESACTIVADO');

-- --------------------------------------------------------

--
-- Table structure for table `semestres`
--

CREATE TABLE `semestres` (
  `id_semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `semestres`
--

INSERT INTO `semestres` (`id_semestre`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrativos`
--
ALTER TABLE `administrativos`
  ADD PRIMARY KEY (`matricula`);

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `id_statusalu` (`id_status`);

--
-- Indexes for table `alumno_status`
--
ALTER TABLE `alumno_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id_asignatura`);

--
-- Indexes for table `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id_calificaciones`);

--
-- Indexes for table `excel`
--
ALTER TABLE `excel`
  ADD PRIMARY KEY (`id_excel`),
  ADD KEY `id_plantel` (`id_plantel`,`id_semestre`,`id_grupo`,`matricula`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_semestre` (`id_semestre`),
  ADD KEY `matricula` (`matricula`);

--
-- Indexes for table `excel_asignatura`
--
ALTER TABLE `excel_asignatura`
  ADD PRIMARY KEY (`id_excel_asignatura`),
  ADD KEY `id_asig` (`id_asignatura`,`id_excel`),
  ADD KEY `id_calificaciones` (`id_calificaciones`),
  ADD KEY `id_excel` (`id_excel`),
  ADD KEY `matricula_d` (`matricula_maestro`),
  ADD KEY `id_plan` (`id_plan`),
  ADD KEY `id_periodo` (`id_periodo`);

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indexes for table `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`matricula_maestro`),
  ADD KEY `id_status` (`id_status_maestro`);

--
-- Indexes for table `maestro_status`
--
ALTER TABLE `maestro_status`
  ADD PRIMARY KEY (`id_status_maestro`);

--
-- Indexes for table `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id_periodo`),
  ADD KEY `id_statusp` (`id_status_periodo`);

--
-- Indexes for table `periodo_status`
--
ALTER TABLE `periodo_status`
  ADD PRIMARY KEY (`id_status_periodo`);

--
-- Indexes for table `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id_plan`),
  ADD KEY `id_status_plan` (`id_status_plan`);

--
-- Indexes for table `planteles`
--
ALTER TABLE `planteles`
  ADD PRIMARY KEY (`id_plantel`);

--
-- Indexes for table `plan_status`
--
ALTER TABLE `plan_status`
  ADD PRIMARY KEY (`id_status_plan`),
  ADD KEY `id_status_plan` (`id_status_plan`);

--
-- Indexes for table `semestres`
--
ALTER TABLE `semestres`
  ADD PRIMARY KEY (`id_semestre`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumno_status`
--
ALTER TABLE `alumno_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id_calificaciones` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `excel`
--
ALTER TABLE `excel`
  MODIFY `id_excel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `excel_asignatura`
--
ALTER TABLE `excel_asignatura`
  MODIFY `id_excel_asignatura` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `maestro_status`
--
ALTER TABLE `maestro_status`
  MODIFY `id_status_maestro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `periodo_status`
--
ALTER TABLE `periodo_status`
  MODIFY `id_status_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `planteles`
--
ALTER TABLE `planteles`
  MODIFY `id_plantel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `plan_status`
--
ALTER TABLE `plan_status`
  MODIFY `id_status_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `semestres`
--
ALTER TABLE `semestres`
  MODIFY `id_semestre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `alumno_status` (`id_status`);

--
-- Constraints for table `excel`
--
ALTER TABLE `excel`
  ADD CONSTRAINT `excel_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`),
  ADD CONSTRAINT `excel_ibfk_4` FOREIGN KEY (`id_plantel`) REFERENCES `planteles` (`id_plantel`),
  ADD CONSTRAINT `excel_ibfk_7` FOREIGN KEY (`id_semestre`) REFERENCES `semestres` (`id_semestre`),
  ADD CONSTRAINT `excel_ibfk_9` FOREIGN KEY (`matricula`) REFERENCES `alumnos` (`matricula`);

--
-- Constraints for table `excel_asignatura`
--
ALTER TABLE `excel_asignatura`
  ADD CONSTRAINT `excel_asignatura_ibfk_1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`),
  ADD CONSTRAINT `excel_asignatura_ibfk_2` FOREIGN KEY (`id_calificaciones`) REFERENCES `calificaciones` (`id_calificaciones`),
  ADD CONSTRAINT `excel_asignatura_ibfk_3` FOREIGN KEY (`id_excel`) REFERENCES `excel` (`id_excel`),
  ADD CONSTRAINT `excel_asignatura_ibfk_4` FOREIGN KEY (`matricula_maestro`) REFERENCES `maestros` (`matricula_maestro`),
  ADD CONSTRAINT `excel_asignatura_ibfk_5` FOREIGN KEY (`id_periodo`) REFERENCES `periodos` (`id_periodo`),
  ADD CONSTRAINT `excel_asignatura_ibfk_6` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id_plan`);

--
-- Constraints for table `maestros`
--
ALTER TABLE `maestros`
  ADD CONSTRAINT `maestros_ibfk_1` FOREIGN KEY (`id_status_maestro`) REFERENCES `maestro_status` (`id_status_maestro`);

--
-- Constraints for table `periodos`
--
ALTER TABLE `periodos`
  ADD CONSTRAINT `periodos_ibfk_1` FOREIGN KEY (`id_status_periodo`) REFERENCES `periodo_status` (`id_status_periodo`);

--
-- Constraints for table `planes`
--
ALTER TABLE `planes`
  ADD CONSTRAINT `planes_ibfk_1` FOREIGN KEY (`id_status_plan`) REFERENCES `plan_status` (`id_status_plan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
