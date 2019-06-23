-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2019 at 06:53 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.2.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 1;
START TRANSACTION;
SET time_zone = "+00:00";

USE `mysql` ;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vnetprom_team4`
--

DROP SCHEMA IF EXISTS `vnetprom_team4`;

CREATE SCHEMA IF NOT EXISTS `vnetprom_team4` DEFAULT CHARACTER SET UTF8MB4 ;

DROP DATABASE IF EXISTS `vnetprom_team4`;

DROP USER IF EXISTS `vnetprom_team4`@`localhost`;
DROP USER IF EXISTS `vnetprom_team4user`@`localhost`; 
CREATE USER `vnetprom_team4`@`localhost` IDENTIFIED BY 'cmsc495!!';
CREATE USER `vnetprom_team4user`@`localhost` IDENTIFIED BY '!!cmsc495';
GRANT ALL PRIVILEGES ON * . * TO `vnetprom_team4`@`localhost`;
GRANT SELECT, DELETE, UPDATE, EXECUTE, INSERT ON `vnetprom_team4` . * TO `vnetprom_team4user`@`localhost`;

--
-- Database: `vnetprom_team4`
--

CREATE DATABASE IF NOT EXISTS `vnetprom_team4` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;

USE `vnetprom_team4`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE IF NOT EXISTS `animals` (
  `animalID` int(11) NOT NULL AUTO_INCREMENT,
  `species_name` varchar(8) DEFAULT '',
  `classification` varchar(24) DEFAULT 'pup',
  `sex` varchar(10) DEFAULT NULL,
  `entered_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `tag_date` date DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `wean_date` date DEFAULT NULL,
  `genotype` varchar(128) DEFAULT NULL,
  `generation` varchar(128) DEFAULT NULL,
  `location` varchar(128) DEFAULT NULL,
  `strain_ID` int(11) DEFAULT NULL,
  `tagNumber` int(11) DEFAULT NULL,
  `deceased` bit(1) NOT NULL DEFAULT b'0',
  `transferred` bit(1) NOT NULL DEFAULT b'0',
  `comments` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`animalID`),
  UNIQUE KEY `tagNumber_UNIQUE` (`animalID`,`tagNumber`),
  KEY `location_idx` (`location`),
  KEY `strain_ID_idx` (`strain_ID`),
  KEY `generation_idx` (`generation`),
  KEY `genotype_idx` (`genotype`),
  KEY `birth_date_idx` (`birth_date`),
  KEY `wean_date_idx` (`wean_date`),
  KEY `entered_date_idx` (`entered_date`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animalID`, species_name, `classification`, `sex`, `entered_date`, `tag_date`, `birth_date`, `wean_date`, `genotype`, `generation`, `location`, `tagNumber`, `deceased`, `transferred`, `comments`, strain_ID) VALUES
(1, 'Mouse', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-12-12', '2019-11-14', '2019-12-05', 'wt', 'F', 'B1C110', 10000, b'0', b'0', 'No notes', 9),
(2, 'Mouse', 'breeder', 'Female', '2019-06-05 00:00:00', '2019-12-20', '2019-12-01', '2019-11-9', 'het', 'F', 'B1C110', 10010, b'0', b'0', 'No notes', 8),
(3, 'Mouse', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10100, b'0', b'0', 'No notes', 8),
(4, 'Mouse', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10101, b'0', b'0', 'No notes', 8),
(5, 'Mouse', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10102, b'0', b'0', 'No notes', 8),
(6, 'Mouse', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'wt', '1', 'B1C111', 10103, b'0', b'0', 'No notes', 8),
(7, 'Mouse', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10104, b'0', b'0', 'No notes', 8),
(8, 'Mouse', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'wt', '1', 'B1C111', 10105, b'0', b'0', 'No notes', 8),
(9, 'Mouse', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'wt', '1', 'B1C111', 10106, b'0', b'0', 'No notes', 8),
(10, 'Mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10107, b'0', b'0', 'No notes', 8),
(11, 'Mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'wt', '1', 'B1C111', 10108, b'0', b'0', 'No notes', 8),
(12, 'Mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'wt', '1', 'B1C111', 10109, b'0', b'0', 'No notes', 8),
(13, 'Mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10110, b'0', b'0', 'No notes', 8),
(16, 'Rat', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-05-12', '2019-04-14', '2019-05-05', 'het', '2', 'B1C110', 23000, b'0', b'0', 'No notes', 4),
(17, 'Rat', 'breeder', 'Female', '2019-06-05 00:00:00', '2019-05-20', '2019-04-14', NULL, 'wt', '2', 'B1C110', 23455, b'0', b'0', 'CRL Rat', 2),
(14, 'Mouse', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-01-21', NULL, NULL, '1', 'B1C110',NULL , b'1', b'0', 'runted', 8),
(15, 'Mouse', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-01-21', NULL, NULL, '1', 'B1C110',NULL, b'1', b'0', 'runted', 8),
(18, 'Rat', 'pup`', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110',NULL , b'0', b'0', 'No notes', 4),
(19, 'Rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 4),
(20, 'Rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 4),
(21, 'Rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 4),
(22, 'Rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 4),
(23, 'Rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 4),
(24, 'Rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 4),
(100, 'Rat', 'breeder', 'Female', '2019-06-05 00:00:00', '2019-06-12', '2018-06-05', '2018-07-05', 'wt', '3', 'B1C110', 2347, b'0', b'0', 'No notes',13),
(101, 'Rat', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2018-10-05', '2018-11-15', 'wt', '3', 'B1C110', 9037, b'0', b'0', 'none',14),
(102, 'Rat', 'breeder', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2018-12-15', '2019-01-18', 'het', '3', 'B1C110', 4836, b'0', b'0', 'none',1),
(103, 'Rat', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-02-26', '2019-03-09', 'wt', '3', 'B1C110', 5213, b'0', b'1', 'none',2),
(104, 'Rat', 'breeder', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-06-01', '2019-06-21', 'het', '4', 'B1C112', 1256, b'0', b'0', 'none',2),
(105, 'Rat', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-06-08', '2019-06-22', 'wt', '4', 'B1C112', 6425, b'0', b'0', 'none',3),
(106, 'Rat', 'weanling', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-05-31', '2019-06-15', 'het', '5', 'B1C112', 1234, b'0', b'0', 'none',5),
(107, 'Rat', 'pup', 'Female', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '4', NULL, NULL, b'0', b'0', 'none',24),
(108, 'Rat', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '5', NULL, NULL, b'0', b'0', 'none',8),
(109, 'Rat', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '5', NULL, NULL, b'0', b'0', 'No notes',4),
(110, 'Rat', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-04-08', '2019-04-22', 'wt', '4', 'B1C112', 6425, b'0', b'0', 'none',26),
(111, 'Rat', 'weanling', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-04-14', '2019-04-30', 'het', '4', 'B1C112', 1234, b'0', b'0', 'none',2),
(112, 'Rat', 'breeder', 'Female', '2019-06-05 00:00:00', '2019-06-12', '2018-06-05', '2018-07-05', 'hom', '3', 'B1C112', 2347, b'0', b'0', 'No notes',16),
(113, 'Mouse', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2018-10-05', '2018-11-15', 'hom', '3', 'B1C112', 9037, b'0', b'0', 'none',23),
(114, 'Mouse', 'breeder', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2018-12-15', '2019-01-18', 'het', '3', 'B1C112', 4836, b'0', b'0', 'none',10),
(115, 'Rat', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-02-26', '2019-03-09', 'wt', '3', 'B1C112', 5213, b'0', b'1', 'none',2),
(116, 'Rat', 'breeder', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-06-01', '2019-06-21', 'het', '4', 'B1C112', 1256, b'0', b'0', 'none',24),
(117, 'Mouse', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-06-08', '2019-06-22', 'hom', '4', 'B1C112', 6425, b'0', b'0', 'none',21),
(118, 'Mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-05-31', '2019-06-15', 'het', '5', 'B1C112', 1234, b'0', b'0', 'none',9),
(119, 'Rat', 'pup', 'Female', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '4', NULL, NULL, b'0', b'0', 'none',2),
(120, 'Rat', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '5', NULL, NULL, b'0', b'0', 'none',24),
(121, 'Rat', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '5', NULL, NULL, b'0', b'0', 'No notes',24),
(122, 'Mouse', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-04-08', '2019-04-22', 'wt', '4', 'B1C113', 6425, b'0', b'0', 'none',10),
(123, 'Mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-04-14', '2019-04-30', 'hom', '4', 'B1C111', 1234, b'0', b'0', 'none',20),
(124, 'Rat', 'breeder', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2018-12-15', '2019-01-18', 'het', '3', 'B1C111', 4836, b'0', b'0', 'none',22),
(125, 'Rat', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-02-26', '2019-03-09', 'wt', '3', 'B1C111', 5213, b'0', b'1', 'none',18),
(126, 'Rat', 'breeder', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-06-01', '2019-06-21', 'hom', '4', 'B1C111', 1256, b'0', b'0', 'none',3),
(127, 'Mouse', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-06-08', '2019-06-22', 'wt', '4', 'B1C113', 6425, b'0', b'0', 'none',6),
(128, 'Mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-05-31', '2019-06-15', 'het', '5', 'B1C113', 1234, b'0', b'0', 'none',6),
(129, 'Mouse', 'breeder', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-06-01', '2019-06-21', 'het', '4', 'B1C113', 1256, b'0', b'0', 'none',10),
(130, 'Mouse', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '5', NULL, NULL, b'0', b'0', 'none',12),
(131, 'Mouse', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'hom', '5', NULL, NULL, b'0', b'0', 'No notes',2),
(132, 'Rat', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-04-08', '2019-04-22', 'wt', '4', 'B1C113', 6425, b'0', b'0', 'none',1),
(133, 'Rat', 'weanling', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-04-14', '2019-04-30', 'het', '4', 'B1C113', 1234, b'0', b'0', 'none',2),
(134, 'Mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2018-06-12', '2019-04-14', '2019-04-30', 'het', '4', 'B1C113', 1234, b'0', b'0', 'none',8),
(135, 'Mouse', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'hom', '5', NULL, NULL, b'0', b'0', 'none',25),
(136, 'Rat', 'pup', 'Female', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '5', NULL, NULL, b'0', b'0', 'No notes',1),
(137, 'Mouse', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '5', NULL, NULL, b'0', b'0', 'none',6),
(138, 'Mouse', 'pup', 'Female', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'hom', '5', NULL, NULL, b'0', b'0', 'No notes',6),
(139, 'Mouse', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '5', NULL, NULL, b'0', b'0', 'none',6),
(140, 'Mouse', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '5', NULL, NULL, b'0', b'0', 'No notes',6),
(141, 'Mouse', 'pup', 'Male', '2019-06-05 00:00:00', NULL, '2019-06-20', NULL, 'het', '5', NULL, NULL, b'0', b'0', 'No notes',6);

-- --------------------------------------------------------

--
-- Table structure for table `breeding_pairs`
--

DROP TABLE IF EXISTS `breeding_pairs`;
CREATE TABLE IF NOT EXISTS `breeding_pairs` (
  `pairID` int(11) NOT NULL AUTO_INCREMENT,
  `maleID` int(11) DEFAULT NULL,
  `femaleID` int(11) DEFAULT NULL,
  `desiredStrain` varchar(45) DEFAULT NULL,
  `offspringGen` varchar(128) DEFAULT NULL,
  `pair_date` date DEFAULT NULL,
  `notes` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`pairID`),
  UNIQUE KEY `pairID_UNIQUE` (`pairID`),
  KEY `offspringGen_idx` (`offspringGen`),
  KEY `male_idx` (`maleID`),
  KEY `female_idx` (`femaleID`),
  KEY `desiredStrain_idx` (`desiredStrain`),
  KEY `pair_date_idx` (`pair_date`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `breeding_pairs`
--

INSERT INTO `breeding_pairs` (`pairID`, `maleID`, `femaleID`, `desiredStrain`, `offspringGen`, `pair_date`, `notes`) VALUES
(1, 100, 101, '5', '4', '2019-06-05', 'na'),
(2, 102, 103, '13', '4', '2019-06-05', 'na'),
(3, 104, 105, '24', '5', '2018-06-05', 'na'),
(4, 127, 129, '21', '6', '2018-06-05', 'na'),
(5, 112, 125, '22', '6', '2018-06-05', 'na');

-- --------------------------------------------------------

--
-- Stand-in structure for view `filtered_return`
-- (See below for the actual view)
--
DROP TABLE IF EXISTS `filtered_return`;
DROP VIEW IF EXISTS `filtered_return`;
CREATE TABLE IF NOT EXISTS `filtered_return` (
`animalID` int(11)
,`classification` varchar(24)
,`sex` varchar(10)
,`entered_date` datetime
,`tag_date` date
,`birth_date` date
,`wean_date` date
,`genotype` varchar(128)
,`generation` varchar(128)
,`location` varchar(128)
,`tagNumber` int(11)
,`deceased` bit(1)
,`transferred` bit(1)
,`comments` varchar(512)
,`id` int(11)
,`litterID` int(11)
,`animalID_pup` int(11)
,`breedingPair` int(11)
,`id_PI` int(11)
,`PI_username` varchar(64)
,`PI_strain_ID` int(11)
,`PI_animalID` int(11)
,`id_strain` int(11)
,`strain_name` varchar(45)
,`strain_species` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `animals_join_litters`
-- (See below for the actual view)
--
DROP TABLE IF EXISTS `animals_join_litters`;
DROP VIEW IF EXISTS `animals_join_litters`;
CREATE TABLE IF NOT EXISTS `animals_join_litters` (
`animalID` int(11)
,`classification` varchar(24)
,`sex` varchar(10)
,`entered_date` datetime
,`tag_date` date
,`birth_date` date
,`wean_date` date
,`genotype` varchar(128)
,`generation` varchar(128)
,`location` varchar(128)
,`tagNumber` int(11)
,`deceased` bit(1)
,`transferred` bit(1)
,`comments` varchar(512)
,`id` int(11)
,`litterID` int(11)
,`animalID_pup` int(11)
,`breedingPair` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `generations`
--

DROP TABLE IF EXISTS `generations`;
CREATE TABLE IF NOT EXISTS `generations` (
  `generation_name` varchar(128) NOT NULL,
  `animalID_gen` int(11) DEFAULT NULL,
  PRIMARY KEY (`generation_name`),
  UNIQUE KEY `generation_name_UNIQUE` (`generation_name`),
  KEY `animalID_gen_idx` (`animalID_gen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `generations`
--

INSERT INTO `generations` (`generation_name`, `animalID_gen`) VALUES
('1', NULL),
('2', NULL),
('3', NULL),
('4', NULL),
('5', NULL),
('6', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genotypes`
--

DROP TABLE IF EXISTS `genotypes`;
CREATE TABLE IF NOT EXISTS `genotypes` (
  `genotype_name` varchar(128) NOT NULL,
  `animalID_geno` int(11) DEFAULT NULL,
  PRIMARY KEY (`genotype_name`),
  UNIQUE KEY `genotype_name_UNIQUE` (`genotype_name`),
  KEY `animalID_idx` (`animalID_geno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genotypes`
--

INSERT INTO `genotypes` (`genotype_name`, `animalID_geno`) VALUES
('het', NULL),
('hom', NULL),
('wt', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `litters`
--

DROP TABLE IF EXISTS `litters`;
CREATE TABLE IF NOT EXISTS `litters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `litterID` int(11) DEFAULT NULL,
  `animalID_pup` int(11) DEFAULT NULL,
  `breedingPair` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `animalID_idx` (`animalID_pup`),
  KEY `breedingPair_idx` (`breedingPair`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `litters`
--

INSERT INTO `litters` (`id`, `litterID`, `animalID_pup`, `breedingPair`) VALUES
(1, 6, 104, 6),
(2, 6, 107, 6),
(3, 6, 111, 6),
(4, 6, 122, 6),
(5, 2, 116, 2),
(6, 2, 108, 2),
(7, 3, 133, 4),
(8, 3, 134, 4),
(9, 3, 105, 4),
(10, 4, 112, 3),
(11, 4, 113, 3),
(12, 5, 121, 5),
(13, 1, 4, 1),
(14, 1, 5, 1),
(15, 1, 6, 1),
(16, 1, 7, 1),
(17, 1, 8, 1),
(18, 1, 9, 1),
(19, 1, 10, 1),
(20, 1, 11, 1),
(21, 1, 12, 1),
(22, 1, 13, 1),
(23, 1, 15, 1),
(24, 1, 14, 1),
(25, 6, 18, 2),
(27, 6, 19, 2),
(28, 6, 20, 2),
(29, 7, 21, 2),
(30, 7, 22, 2),
(31, 7, 23, 2),
(32, 7, 24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `location_name` varchar(128) NOT NULL,
  `animalID_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`location_name`),
  UNIQUE KEY `location_name_UNIQUE` (`location_name`),
  KEY `animalID_idx` (`animalID_location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_name`, `animalID_location`) VALUES
('B1C110', 88),
('B1C111', 99),
('B1C112', 101),
('B1C113', 102),
('B1C114', 103);

-- --------------------------------------------------------

--
-- Table structure for table `PI_assigned_animals`
--

DROP TABLE IF EXISTS `PI_assigned_animals`;
CREATE TABLE IF NOT EXISTS `PI_assigned_animals` (
  `id_PI` int(11) NOT NULL AUTO_INCREMENT,
  `PI_username` varchar(64) DEFAULT NULL,
  `PI_strain_ID` int(11) NOT NULL,
  `PI_animalID` int(11) NOT NULL,
  PRIMARY KEY (`id_PI`),
  UNIQUE KEY `PI_animalID_UNIQUE` (`PI_animalID`),
  UNIQUE KEY `id_PI_UNIQUE` (`id_PI`),
  KEY `PI_username_idx` (`PI_username`),
  KEY `strain_idx` (`PI_strain_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PI_assigned_animals`
--

INSERT INTO `PI_assigned_animals` (`id_PI`, `PI_username`, `PI_strain_ID`, `PI_animalID`) VALUES
(1, 'tmatthew', 13, 100),
(2, 'tmatthew', 14, 101),
(3, 'tmatthew', 24, 107),
(4, 'tmatthew', 2, 111),
(5, 'tmatthew', 2, 133),
(6, 'tmatthew', 16, 112),
(7, 'jhatcher', 1, 102),
(8, 'jhatcher', 2, 103),
(9, 'jhatcher', 3, 105),
(10, 'jhatcher', 4, 109),
(11, 'jhatcher', 5, 106),
(12, 'jhatcher', 6, 127),
(13, 'jhatcher', 7, 131),
(14, 'jhatcher', 8, 134),
(15, 'kmabry', 6, 128),
(16, 'kmabry', 10, 129),
(17, 'kmabry', 11, 132),
(18, 'kmabry', 12, 130),
(19, 'csapp', 1, 136),
(20, 'csapp', 2, 104),
(21, 'csapp', 3, 126),
(22, 'csapp', 24, 120),
(23, 'csapp', 18, 125),
(24, 'csapp', 24, 121),
(25, 'msharma', 9, 118),
(26, 'msharma', 10, 122),
(27, 'msharma', 20, 123),
(28, 'msharma', 21, 117),
(29, 'msharma', 2, 119),
(30, 'msharma', 22, 124),
(31, 'mendel', 23, 113),
(32, 'mendel', 10, 114),
(33, 'mendel', 2, 115),
(34, 'mendel', 24, 116),
(35, 'mendel', 25, 135),
(36, 'jhatcher', 8, 108),
(37, NULL, 26, 137),
(38, NULL, 25, 138),
(39, NULL, 26, 139),
(40, NULL, 25, 140),
(41, NULL, 26, 141),
(42, 'jhatcher', 9, 1),
(43, 'jhatcher', 8, 2),
(44, 'kmabry', 8, 3),
(45, 'kmabry', 8, 4),
(46, 'msharma', 8, 5),
(47, 'msharma', 8, 6),
(48, 'tmatthew', 8, 7),
(49, 'tmatthew', 8, 8),
(50, 'tmatthew', 8, 9),
(51, 'csapp', 8, 10),
(52, 'csapp', 8, 11),
(53, 'csapp', 8, 12),
(54, 'jhatcher', 8, 13),
(55, 'csapp', 8, 14),
(56, 'jhatcher', 8, 15),
(57, 'tmatthew', 4, 16),
(58, 'tmatthew', 2, 17),
(59, 'tmatthew', 4, 18),
(60, 'msharma', 4, 19),
(61, 'msharma', 4, 20),
(62, 'msharma', 4, 21),
(63, 'csapp', 4, 22),
(64, 'jhatcher', 4, 23),
(65, 'jhatcher', 4, 24);


-- --------------------------------------------------------

--
-- Table structure for table `PI_authorized_strains`
--

DROP TABLE IF EXISTS `PI_authorized_strains`;
CREATE TABLE IF NOT EXISTS `PI_authorized_strains` (
  `idPI_authorizations` int(11) NOT NULL AUTO_INCREMENT,
  `authPI_username` varchar(64) NOT NULL,
  `authPI_strain_ID` int(11) NOT NULL,
  PRIMARY KEY (`idPI_authorizations`),
  KEY `authPI_username_idx` (`authPI_username`),
  KEY `authPI_strain_ID_idx` (`authPI_strain_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PI_authorized_strains`
--

INSERT INTO `PI_authorized_strains` (`idPI_authorizations`, `authPI_username`, `authPI_strain_ID`) VALUES
(1, 'Hatcher', 1),
(2, 'Hatcher', 2),
(3, 'Hatcher', 3),
(4, 'Hatcher', 4),
(5, 'Hatcher', 5),
(6, 'Hatcher', 6),
(7, 'Hatcher', 7),
(8, 'Hatcher', 8),
(9, 'Hatcher', 25),
(10, 'Hatcher', 26),
(11, 'Mabry', 6),
(12, 'Mabry', 10),
(13, 'Mabry', 11),
(14, 'Mabry', 12),
(15, 'Mabry', 25),
(16, 'Mabry', 26),
(17, 'Matthew', 13),
(18, 'Matthew', 14),
(19, 'Matthew', 15),
(20, 'Matthew', 2),
(21, 'Matthew', 3),
(22, 'Matthew', 16),
(23, 'Matthew', 25),
(24, 'Matthew', 26),
(25, 'Sapp', 1),
(26, 'Sapp', 2),
(27, 'Sapp', 3),
(28, 'Sapp', 17),
(29, 'Sapp', 18),
(30, 'Sapp', 19),
(31, 'Sapp', 25),
(32, 'Sapp', 26),
(33, 'Sharma', 6),
(34, 'Sharma', 10),
(35, 'Sharma', 20),
(36, 'Sharma', 21),
(37, 'Sharma', 2),
(38, 'Sharma', 22),
(39, 'Sharma', 25),
(40, 'Sharma', 26),
(41, 'Mendel', 23),
(42, 'Mendel', 10),
(43, 'Mendel', 2),
(44, 'Mendel', 24),
(45, 'Mendel', 25),
(46, 'Mendel', 26),
(47, 'Mabry', 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `animals_join_litters_join_pi`
-- (See below for the actual view)
--
DROP TABLE IF EXISTS `animals_join_litters_join_pi`;
DROP VIEW IF EXISTS `animals_join_litters_join_pi`;
CREATE TABLE IF NOT EXISTS `animals_join_litters_join_pi` (
`animalID` int(11)
,`classification` varchar(24)
,`sex` varchar(10)
,`entered_date` datetime
,`tag_date` date
,`birth_date` date
,`wean_date` date
,`genotype` varchar(128)
,`generation` varchar(128)
,`location` varchar(128)
,`tagNumber` int(11)
,`deceased` bit(1)
,`transferred` bit(1)
,`comments` varchar(512)
,`id` int(11)
,`litterID` int(11)
,`animalID_pup` int(11)
,`breedingPair` int(11)
,`id_PI` int(11)
,`PI_username` varchar(64)
,`PI_strain_ID` int(11)
,`PI_animalID` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `strains`
--

DROP TABLE IF EXISTS `strains`;
CREATE TABLE IF NOT EXISTS `strains` (
  `id_strain` int(11) NOT NULL,
  `strain_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_strain`),
  UNIQUE KEY `id_UNIQUE` (`id_strain`),
  KEY `strain_name_UNIQUE` (`strain_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `strains`
--

INSERT INTO `strains` (`id_strain`, `strain_name`) VALUES
(1, 'Sprague-Dawley'),
(2, 'LongEvans'),
(3, 'Wistar'),
(4, 'Th-Cre'),
(5, 'Drd-Cre'),
(6, 'C57BL/6'),
(7, 'Vglut7'),
(8, 'Dat-Tomato'),
(9, 'C57BL/6'),
(10, 'BALB/c'),
(11, 'Thor-dat'),
(12, 'Vgat3'),
(13, 'Vglut7'),
(14, 'GHS'),
(15, 'Cfos-Lacz'),
(16, 'PDYN-IRES-iCre'),
(17, 'GHSR'),
(18, 'Rosa-iHIVxSD'),
(19, 'Cfos-NIMH'),
(20, 'Th-cre'),
(21, 'Cfos-Lacz'),
(22, 'R26-TeTR-fos-T-iCre'),
(23, 'Trp53'),
(24, 'Tr-fos-MFRP 1'),
(25, 'Unassigned'),
(26, 'Unassigned');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(64) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(512) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_name` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `user_role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `create_time`, `last_name`, `first_name`, `user_role`) VALUES
('admin', 'NULL', '$2y$12$CBwE4S.u7OKW9D0EkGIljO3qAGzfgOQijjXikS0V3kV76hJ61Ye82', '2019-06-19 22:04:45', 'Admin', 'Adam', 'Admin'),
('csapp', NULL, '', '2019-06-19 10:45:53', 'Sapp', 'Casey', 'Investigator'),
('jbaker', NULL, '', '2019-06-19 10:45:53', 'Baker', 'June', 'Geneticist'),
('jdoe', NULL, '', '2019-06-19 10:45:53', 'Doe', 'John', 'Investigator'),
('jhatcher', NULL, '', '2019-06-19 10:45:53', 'Hatcher', 'Jake', 'Investigator'),
('jjohnson', NULL, '', '2019-06-19 10:45:53', 'Johnson', 'Jim', 'Breeder Tech'),
('jsmith', NULL, '', '2019-06-19 10:45:53', 'Smith', 'Jane', 'Investigator'),
('kmabry', NULL, '', '2019-06-19 10:45:53', 'Mabry', 'Ken', 'Investigator'),
('mendel', NULL, '', '2019-06-19 10:45:53', 'Mendel', 'Mendel', 'Investigator'),
('msharma', NULL, '', '2019-06-19 10:45:53', 'Sharma', 'Mili', 'Investigator'),
('rinvest', 'NULL', '$2y$12$mK/rWvoZm/SWiFrw0W7TYeJO8V5OBqO79djzH0hxqh7Opzwr2djty', '2019-06-19 22:02:23', 'Invest', 'Ronald', 'Investigator'),
('tdavis', NULL, '', '2019-06-19 10:45:53', 'Davis', 'Tom', 'Investigator'),
('tmatthew', NULL, '', '2019-06-19 10:45:53', 'Matthew', 'Tiffany', 'Investigator');



--
-- Structure for view `animals_join_litters`
--
DROP TABLE IF EXISTS `animals_join_litters`;

CREATE VIEW `animals_join_litters`  AS  
(select 
    `animals`.`animalID` AS `animalID`,
    `animals`.`species_name` AS `species_name`,
    `animals`.`classification` AS `classification`,
    `animals`.`sex` AS `sex`,
    `animals`.`entered_date` AS `entered_date`,
    `animals`.`tag_date` AS `tag_date`,
    `animals`.`birth_date` AS `birth_date`,
    `animals`.`wean_date` AS `wean_date`,
    `animals`.`genotype` AS `genotype`,
    `animals`.`generation` AS `generation`,
    `animals`.`location` AS `location`,
    `animals`.`tagNumber` AS `tagNumber`,
    `animals`.`deceased` AS `deceased`,
    `animals`.`transferred` AS `transferred`,
    `animals`.`comments` AS `comments`,
    `litters`.`id` AS `id`,
    `litters`.`litterID` AS `litterID`,
    `litters`.`animalID_pup` AS `animalID_pup`,
    `litters`.`breedingPair` AS `breedingPair` 
    from (`animals` left join `litters` on((`animals`.`animalID` = `litters`.`animalID_pup`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `animals_join_litters_join_pi`
--
DROP TABLE IF EXISTS `animals_join_litters_join_pi`;

CREATE VIEW `animals_join_litters_join_pi`  AS  
(select 
    `animals_join_litters`.`animalID` AS `animalID`,
    `animals_join_litters`.`species_name` AS `species_name`,
    `animals_join_litters`.`classification` AS `classification`,
    `animals_join_litters`.`sex` AS `sex`,
    `animals_join_litters`.`entered_date` AS `entered_date`,
    `animals_join_litters`.`tag_date` AS `tag_date`,
    `animals_join_litters`.`birth_date` AS `birth_date`,
    `animals_join_litters`.`wean_date` AS `wean_date`,
    `animals_join_litters`.`genotype` AS `genotype`,
    `animals_join_litters`.`generation` AS `generation`,
    `animals_join_litters`.`location` AS `location`,
    `animals_join_litters`.`tagNumber` AS `tagNumber`,
    `animals_join_litters`.`deceased` AS `deceased`,
    `animals_join_litters`.`transferred` AS `transferred`,
    `animals_join_litters`.`comments` AS `comments`,
    `animals_join_litters`.`id` AS `id`,
    `animals_join_litters`.`litterID` AS `litterID`,
    `animals_join_litters`.`animalID_pup` AS `animalID_pup`,
    `animals_join_litters`.`breedingPair` AS `breedingPair`,
    `PI_assigned_animals`.`id_PI` AS `id_PI`,
    `PI_assigned_animals`.`PI_username` AS `PI_username`,
    `PI_assigned_animals`.`PI_strain_ID` AS `PI_strain_ID`,
    `PI_assigned_animals`.`PI_animalID` AS `PI_animalID` 
    from (`animals_join_litters` left join `PI_assigned_animals` on((`animals_join_litters`.`animalID` = `PI_assigned_animals`.`PI_animalID`)))) ;
    
-- --------------------------------------------------------


--
-- Structure for view `filtered_return`
--
DROP TABLE IF EXISTS `filtered_return`;

CREATE VIEW `filtered_return`  AS  
(select 
    `animals_join_litters_join_pi`.`animalID` AS `animalID`,
    `animals_join_litters_join_pi`.`species_name` AS `species_name`,
    `animals_join_litters_join_pi`.`classification` AS `classification`,
    `animals_join_litters_join_pi`.`sex` AS `sex`,
    `animals_join_litters_join_pi`.`entered_date` AS `entered_date`,
    `animals_join_litters_join_pi`.`tag_date` AS `tag_date`,
    `animals_join_litters_join_pi`.`birth_date` AS `birth_date`,
    `animals_join_litters_join_pi`.`wean_date` AS `wean_date`,
    `animals_join_litters_join_pi`.`genotype` AS `genotype`,
    `animals_join_litters_join_pi`.`generation` AS `generation`,
    `animals_join_litters_join_pi`.`location` AS `location`,
    `animals_join_litters_join_pi`.`tagNumber` AS `tagNumber`,
    `animals_join_litters_join_pi`.`deceased` AS `deceased`,
    `animals_join_litters_join_pi`.`transferred` AS `transferred`,
    `animals_join_litters_join_pi`.`comments` AS `comments`,
    `animals_join_litters_join_pi`.`id` AS `id`,
    `animals_join_litters_join_pi`.`litterID` AS `litterID`,
    `animals_join_litters_join_pi`.`animalID_pup` AS `animalID_pup`,
    `animals_join_litters_join_pi`.`breedingPair` AS `breedingPair`,
    `animals_join_litters_join_pi`.`id_PI` AS `id_PI`,
    `animals_join_litters_join_pi`.`PI_username` AS `PI_username`,
    `animals_join_litters_join_pi`.`PI_strain_ID` AS `PI_strain_ID`,
    `animals_join_litters_join_pi`.`PI_animalID` AS `PI_animalID`,
    `strains`.`id_strain` AS `id_strain`,
    `strains`.`strain_name` AS `strain_name`
    from (`animals_join_litters_join_pi` left join `strains` on((`animals_join_litters_join_pi`.`PI_strain_ID` = `strains`.`id_strain`)))) ;

-- --------------------------------------------------------

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `strain_ID` FOREIGN KEY (`strain_ID`) REFERENCES `strains` (`id_strain`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `generation` FOREIGN KEY (`generation`) REFERENCES `generations` (`generation_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `location` FOREIGN KEY (`location`) REFERENCES `location` (`location_name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `breeding_pairs`
--
ALTER TABLE `breeding_pairs`
  ADD CONSTRAINT `desiredStrain` FOREIGN KEY (`desiredStrain`) REFERENCES `strains` (`strain_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `female_ID` FOREIGN KEY (`femaleID`) REFERENCES `animals` (`animalID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `male_ID` FOREIGN KEY (`maleID`) REFERENCES `animals` (`animalID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offspringGen` FOREIGN KEY (`offspringGen`) REFERENCES `generations` (`generation_name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `generations`
--
ALTER TABLE `generations`
  ADD CONSTRAINT `animalID_gen` FOREIGN KEY (`animalID_gen`) REFERENCES `animals` (`animalID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `litters`
--
ALTER TABLE `litters`
  ADD CONSTRAINT `animalID_pup` FOREIGN KEY (`animalID_pup`) REFERENCES `animals` (`animalID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `breedingPair` FOREIGN KEY (`breedingPair`) REFERENCES `breeding_pairs` (`pairID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `animalID_location` FOREIGN KEY (`animalID_location`) REFERENCES `animals` (`animalID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PI_assigned_animals`
--
ALTER TABLE `PI_assigned_animals`
  ADD CONSTRAINT `PI_animalID` FOREIGN KEY (`PI_animalID`) REFERENCES `animals` (`animalID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PI_strain_ID` FOREIGN KEY (`PI_strain_ID`) REFERENCES `strains` (`id_strain`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PI_username` FOREIGN KEY (`PI_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PI_authorized_strains`
--
ALTER TABLE `PI_authorized_strains`
  ADD CONSTRAINT `authPI_strain_ID` FOREIGN KEY (`authPI_strain_ID`) REFERENCES `strains` (`id_strain`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authPI_username` FOREIGN KEY (`authPI_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
