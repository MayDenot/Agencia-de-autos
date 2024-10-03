-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 06:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_agencia_autos`
--

-- --------------------------------------------------------

--
-- Table structure for table `alquileres`
--

CREATE TABLE `alquileres` (
  `ID` int(11) NOT NULL,
  `ID_Vehiculo` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Fecha_de_entrega` date NOT NULL,
  `Fecha_de_vencimiento` date NOT NULL,
  `Precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alquileres`
--

INSERT INTO `alquileres` (`ID`, `ID_Vehiculo`, `ID_Usuario`, `Fecha_de_entrega`, `Fecha_de_vencimiento`, `Precio`) VALUES
(5, 1, 2, '2024-09-04', '2024-09-11', 6000),
(7, 5, 2, '2024-10-02', '2024-10-09', 4500);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Usuario` varchar(250) NOT NULL,
  `Contraseña` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `Usuario`, `Contraseña`) VALUES
(2, 'webadmin', '$2y$10$coasoo4/KT2t88RTP6WHEeYHQ1YFNRsEydcMIwsL.84TWMLaIaHmm');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE `vehiculos` (
  `ID_Vehiculo` int(11) NOT NULL,
  `Patente` varchar(45) NOT NULL,
  `Modelo` varchar(45) NOT NULL,
  `Marca` varchar(45) NOT NULL,
  `Año_de_Modelo` year(4) NOT NULL,
  `Color` varchar(40) NOT NULL,
  `Imagen` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehiculos`
--

INSERT INTO `vehiculos` (`ID_Vehiculo`, `Patente`, `Modelo`, `Marca`, `Año_de_Modelo`, `Color`, `Imagen`) VALUES
(1, 'WET784', 'Corsa', 'Chevrolet', '2011', 'Gris', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQD_I820zEB6Aju3Lde_is6WHtNVPHZtGnffA&s'),
(2, 'AD652FG', 'Cronos', 'Fiat', '2022', 'Gris', 'https://cdn.motor1.com/images/mgl/gZjbE/s1/lanzamiento-fiat-cronos-s-design-ii-2022.jpg'),
(5, 'AC-345-FP', 'Corolla', 'Toyota', '2015', 'Blanco', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOP88qtc-3oSLow_KfQmCEsG2SvhNVnd2bJg&s');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_id_vehiculo` (`ID_Vehiculo`),
  ADD KEY `fk_id_usuario` (`ID_Usuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD UNIQUE KEY `Usuario` (`Usuario`);

--
-- Indexes for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`ID_Vehiculo`),
  ADD KEY `ID_Vehiculo` (`ID_Vehiculo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `ID_Vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `alquileres_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`),
  ADD CONSTRAINT `fk_id_vehiculo` FOREIGN KEY (`ID_Vehiculo`) REFERENCES `vehiculos` (`ID_Vehiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
