-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2019 at 02:10 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amss`
--

-- --------------------------------------------------------

--
-- Table structure for table `avisos`
--

CREATE TABLE `avisos` (
  `sedeID` varchar(300) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `aviso` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `avisos`
--

INSERT INTO `avisos` (`sedeID`, `titulo`, `aviso`) VALUES
('1233WERT', 'asd', 'asd'),
('1233WERT', 'Se retrasara la maestra', 'La maestra llegara tarde para la clase'),
('1233WERT', 'test', 'test'),
('1233WERT', 'Raza me siento mal', 'Raza me siento mal'),
('1233WERT', 'Raza no quiero ir', 'No clase XD');

-- --------------------------------------------------------

--
-- Table structure for table `entregable`
--

CREATE TABLE `entregable` (
  `entregableID` varchar(300) NOT NULL,
  `titulo` varchar(400) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `sedeID` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `fileID` varchar(300) NOT NULL,
  `fileOwner` varchar(40) NOT NULL,
  `fileName` varchar(200) NOT NULL,
  `fileLocation` varchar(500) NOT NULL,
  `entregableID` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sede`
--

CREATE TABLE `sede` (
  `sedeID` varchar(300) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ubicacion` varchar(200) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `maximoAlumnos` int(11) NOT NULL,
  `instructora` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sede`
--

INSERT INTO `sede` (`sedeID`, `nombre`, `ubicacion`, `telefono`, `maximoAlumnos`, `instructora`) VALUES
('1233WERT', 'Programando Un Mexico Mejor AC', 'San Pedro Garza Garcia', '8443445654', 100, 'martha'),
('IDsede1', 'Escuela de Tamaulipas', 'Tamaulipas', '00000000', 1000, 'tutora1'),
('IDsede2', 'Escuela de Monterrey', 'Monterrey', '00000000', 5000, 'tutora2'),
('IDsede3', 'Escuela de México', 'Ciudad de México', '00000000', 5000, 'tutora3');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(40) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telefonoPadres` varchar(15) DEFAULT NULL,
  `direccion` varchar(200) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `rango` varchar(50) NOT NULL,
  `sedeID` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`username`, `nombre`, `apellido`, `email`, `telefono`, `password`, `telefonoPadres`, `direccion`, `fechaNacimiento`, `rango`, `sedeID`) VALUES
('Admin1', 'Carlos', 'Ruíz', 'carlosruíz@hotmail.com', '00000000', 'ruízpsswd', '00000000', 'viena#123', '0000-00-00', 'Administra', NULL),
('martha', 'Martha', 'Hernandez', 'martha.hernandez@hotmail.com', '855455342', '123', '855455342', 'Avenida Las Americas', '2019-05-01', 'Tutor', NULL),
('niña1', 'Alberta', 'Ruíz', 'albertaruiz@hotmail.com', '00000000', 'albertapsswd', '00000000', 'viena#123', '0000-00-00', 'Alumno', 'IDsede1'),
('niña2', 'Carolina', 'Cortínez', 'carolina@hotmail.com', '00000000', 'carolinapsswd', '00000000', 'mozart#1203', '0000-00-00', 'Alumno', 'IDsede2'),
('niña3', 'Mariana', 'Yahuaca', 'mariana@hotmail.com', '00000000', 'marianapsswd', '00000000', 'morelia#5', '0000-00-00', 'Alumno', 'IDsede3'),
('tutora1', 'Roberta', 'Paes', 'ropaes@hotmail.com', '00000000', 'robertapsswd', '00000000', 'vega#13', '0000-00-00', 'Tutor', NULL),
('tutora2', 'Mireya', 'Antunes', 'mirantunes@hotmail.com', '00000000', 'mireyapsswd', '00000000', 'bach#1', '0000-00-00', 'Tutor', NULL),
('tutora3', 'Carla', 'Martínez', 'carlamartinez@hotmail.com', '00000000', 'carlapsswd', '00000000', 'wagner#120', '0000-00-00', 'Tutor', NULL),
('victoroy', 'Victor Hugo', 'Oyervides Covarrubias', 'victor@oyervid.es', '8442771987', '123', '8442771987', 'Las Americas', '2019-05-08', 'Alumno', '1233WERT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avisos`
--
ALTER TABLE `avisos`
  ADD KEY `sedeID` (`sedeID`);

--
-- Indexes for table `entregable`
--
ALTER TABLE `entregable`
  ADD PRIMARY KEY (`entregableID`),
  ADD KEY `sedeID` (`sedeID`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`fileID`),
  ADD KEY `fileOwner` (`fileOwner`),
  ADD KEY `entregableID` (`entregableID`);

--
-- Indexes for table `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`sedeID`),
  ADD KEY `instructora` (`instructora`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`),
  ADD KEY `sedeID` (`sedeID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avisos`
--
ALTER TABLE `avisos`
  ADD CONSTRAINT `avisos_ibfk_1` FOREIGN KEY (`sedeID`) REFERENCES `sede` (`sedeID`);

--
-- Constraints for table `entregable`
--
ALTER TABLE `entregable`
  ADD CONSTRAINT `entregable_ibfk_1` FOREIGN KEY (`sedeID`) REFERENCES `sede` (`sedeID`);

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`fileOwner`) REFERENCES `usuario` (`username`),
  ADD CONSTRAINT `file_ibfk_2` FOREIGN KEY (`entregableID`) REFERENCES `entregable` (`entregableID`);

--
-- Constraints for table `sede`
--
ALTER TABLE `sede`
  ADD CONSTRAINT `sede_ibfk_1` FOREIGN KEY (`instructora`) REFERENCES `usuario` (`username`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`sedeID`) REFERENCES `sede` (`sedeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
