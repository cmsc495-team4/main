-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2019 at 12:09 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.2.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

USE `mysql` ;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP SCHEMA IF EXISTS `vnetprom_team4v2`;
DROP SCHEMA IF EXISTS `vnetprom_team4`;

CREATE SCHEMA IF NOT EXISTS `vnetprom_team4` DEFAULT CHARACTER SET UTF8MB4 ;

DROP DATABASE IF EXISTS `vnetprom_team4v2`;
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
CREATE TABLE `animals` (
  `animalID` int(11) NOT NULL,
  `PI_username` varchar(64) DEFAULT NULL,
  `species` varchar(10) DEFAULT NULL,
  `classification` varchar(24) DEFAULT 'weanling',
  `sex` varchar(10) DEFAULT NULL,
  `entered_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `tag_date` date DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `wean_date` date DEFAULT NULL,
  `genotype` varchar(128) DEFAULT NULL,
  `generation` varchar(128) DEFAULT NULL,
  `location` varchar(128) DEFAULT NULL,
  `tagNumber` int(11) DEFAULT NULL,
  `deceased` bit(1) NOT NULL DEFAULT b'0',
  `transferred` bit(1) NOT NULL DEFAULT b'0',
  `comments` varchar(512) DEFAULT NULL,
  `strain` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animals`
--

--animalID 1-2 breeding pair, 3-13 weanlings from first litter, 16-17 rat breeding pair, 14-15 runted deceased pups. 18-24 pups for 16 and 17's first litter 
INSERT INTO `animals` (`animalID`,`PI_username` ,`species`, `classification`, `sex`, `entered_date`, `tag_date`, `birth_date`, `wean_date`, `genotype`, `generation`, `location`, `tagNumber`, `deceased`, `transferred`, `comments`, `strain`) VALUES
(1,'Hatcher', 'mouse', 'breeder', 'M', '2019-06-05 00:00:00', '2019-12-12', '2019-11-14', '2019-12-05', 'wt', 'F', 'B1C110', 10000, b'0', b'0', 'No notes', 'C57BL/6'),
(2, 'Hatcher','mouse', 'breeder', 'F', '2019-06-05 00:00:00', '2019-12-20', '2019-12-01', '2019-11-9', 'het', 'F', 'B1C110', 10010, b'0', b'0', 'No notes', 'Dat-Tomato'),
(3, 'Hatcher','mouse', 'weanling', 'M', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10100, b'0', b'0', 'No notes', 'Dat-Tomato'),
(4, 'Hatcher','mouse', 'weanling', 'M', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10101, b'0', b'0', 'No notes', 'Dat-Tomato'),
(5, 'Hatcher','mouse', 'weanling', 'M', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10102, b'0', b'0', 'No notes', 'Dat-Tomato'),
(6, 'Hatcher','mouse', 'weanling', 'M', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'wt', '1', 'B1C111', 10103, b'0', b'0', 'No notes', 'Dat-Tomato'),
(7, 'Hatcher','mouse', 'weanling', 'M', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10104, b'0', b'0', 'No notes', 'Dat-Tomato'),
(8, 'Hatcher','mouse', 'weanling', 'M', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'wt', '1', 'B1C111', 10105, b'0', b'0', 'No notes', 'Dat-Tomato'),
(9, 'Hatcher','mouse', 'weanling', 'M', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'wt', '1', 'B1C111', 10106, b'0', b'0', 'No notes', 'Dat-Tomato'),
(10, 'Hatcher','mouse', 'weanling', 'F', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10107, b'0', b'0', 'No notes', 'Dat-Tomato'),
(11, 'Hatcher','mouse', 'weanling', 'F', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'wt', '1', 'B1C111', 10108, b'0', b'0', 'No notes', 'Dat-Tomato'),
(12, 'Hatcher','mouse', 'weanling', 'F', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'wt', '1', 'B1C111', 10109, b'0', b'0', 'No notes', 'Dat-Tomato'),
(13, 'Hatcher','mouse', 'weanling', 'F', '2019-06-05 00:00:00', '2019-02-05', '2019-01-21', '2019-02-12', 'het', '1', 'B1C111', 10110, b'0', b'0', 'No notes', 'Dat-Tomato');
(16,'Hatcher', 'rat', 'breeder', 'M', '2019-06-05 00:00:00', '2019-05-12', '2019-04-14', '2019-05-05', 'het', '2', 'B1C110', 23000, b'0', b'0', 'No notes', 'Th-Cre'),
(17,'Hatcher', 'rat', 'breeder', 'F', '2019-06-05 00:00:00', '2019-05-20', '2019-04-14', NULL, 'wt', '2', 'B1C110', 23455, b'0', b'0', 'CRL Rat', 'Long Evans')
(14, 'Hatcher','mouse', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-01-21', NULL, NULL, '1', 'B1C110',NULL , b'1', b'0', 'runted', 'Dat-Tomato'),
(15, 'Hatcher','mouse', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-01-21', NULL, NULL, '1', 'B1C110',NULL, b'1', b'0', 'runted', 'Dat-Tomato'),
(18,'Hatcher', 'rat', 'pup`', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110',NULL , b'0', b'0', 'No notes', 'Th-Cre'),
(19,'Hatcher', 'rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 'Th-Cre'),
(20,'Hatcher', 'rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 'Th-Cre'),
(21,'Hatcher', 'rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 'Th-Cre'),
(22,'Hatcher', 'rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 'Th-Cre'),
(23,'Hatcher', 'rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 'Th-Cre'),
(24,'Hatcher', 'rat', 'pup', NULL, '2019-06-05 00:00:00', NULL, '2019-06-21', NULL, NULL, '3', 'B1C110', NULL, b'0', b'0', 'No notes', 'Th-Cre');

-- --------------------------------------------------------

--
-- Table structure for table `breeding_pairs`
--

DROP TABLE IF EXISTS `breeding_pairs`;
CREATE TABLE `breeding_pairs` (
  `pairID` int(11) NOT NULL,
  `maleID` int(11) DEFAULT NULL,
  `femaleID` int(11) DEFAULT NULL,
  `desiredStrain` varchar(128) DEFAULT NULL,
  `offspringGen` varchar(128) DEFAULT NULL,
  `pair_date` date DEFAULT NULL,
  `notes` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breeding_pairs`
--
--Two pairs for hatcher PI
INSERT INTO `breeding_pairs` (`pairID`, `maleID`, `femaleID`, `desiredStrain`, `offspringGen`, `pair_date`, `notes`) VALUES
(1, 1, 2, 'Dat-Tomato', '1', '2019-01-05', 'founder'),
(2, 16, 17, 'Th-Cre', '3', '2019-06-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `generations`
--

DROP TABLE IF EXISTS `generations`;
CREATE TABLE `generations` (
  `generation_name` varchar(128) NOT NULL,
  `animalID_gen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `generations`
--

INSERT INTO `generations` (`generation_name`, `animalID_gen`) VALUES
('gen1', NULL),
('gen2', NULL),
('gen3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genotypes`
--

DROP TABLE IF EXISTS `genotypes`;
CREATE TABLE `genotypes` (
  `genotype_name` varchar(128) NOT NULL,
  `animalID_geno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
CREATE TABLE `litters` (
  `id` int(11) NOT NULL,
  `litterID` int(11) DEFAULT NULL,
  `animalID_pup` int(11) DEFAULT NULL,
  `breedingPair` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `litters`
--

--litters from two existing pairs for Hatcher
INSERT INTO `litters` (`id`, `litterID`, `animalID_pup`, `breedingPair`) VALUES
(1, 1, 4, 1),
(2, 1, 5, 1),
(3, 1, 6, 1),
(4, 1, 7, 1),
(5, 1, 8, 1),
(6, 1, 9, 1),
(7, 1, 10, 1),
(8, 1, 11, 1),
(9, 1, 12, 1),
(10, 1, 13, 1),
(11, 1, 15, 1),
(12, 1, 14, 1),
(13, 1, 18, 2),
(14, 1, 19, 2),
(15, 1, 20, 2),
(16, 1, 21, 2),
(17, 1, 22, 2),
(18, 1, 23, 2),
(19, 1, 24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `location_name` varchar(128) NOT NULL,
  `animalID_location` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_name`, `animalID_location`) VALUES
('loc1', 88),
('loc2', 99),
('loc3', 101),
('loc4', 102),
('loc5', 103),
('loc6', 104),
('loc7', 105),
('loc8', 106);

-- --------------------------------------------------------

--
-- Table structure for table `PI_strains`
--

DROP TABLE IF EXISTS `PI_strains`;
CREATE TABLE `PI_strains` (
  `id_PI` int(11) NOT NULL,
  `PI_username` varchar(64) DEFAULT NULL,
  `PI_strain` varchar(45) DEFAULT NULL,
  'PI_species' varchar(45) DEFAUL NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PI_strains`
--

INSERT INTO `PI_strains` (`id_PI`, `PI_username`, `PI_strain`, 'PI_species') VALUES
(1, 'Hatcher', 'Sprague-Dawley','Rat'),
(2, 'Hatcher', 'Long Evans', 'Rat'),
(3, 'Hatcher', 'Wistar','Rat'),
(4, 'Hatcher', 'Th-Cre','Rat'),
(5, 'Hatcher', 'Drd-Cre','Rat'),
(6, 'Hatcher', 'C57BL/6','Mouse'),
(7, 'Hatcher', 'Vglut7','Mouse'),
(8, 'Hatcher', 'Dat-Tomato','Mouse'),
(9, 'Mabry', 'C57BL/6','Mouse'),
(10, 'Mabry', 'BALB/c','Mouse'),
(11, 'Mabry', 'Thor-dat','Mouse'),
(12, 'Mabry', 'Vgat3','Mouse'),
(13, 'Matthew', 'Vglut7','Rat'),
(14, 'Matthew', 'GHS','Rat'),
(15, 'Matthew', 'Cfos-Lacz','Rat'),
(16, 'Matthew', 'Long Evans','Rat'),
(17, 'Matthew', 'Wistar','Rat'),
(18, 'Matthew', 'PDYN-IRES-iCre','Rat'),
(19, 'Sapp', 'Sprague-Dawley','Rat'),
(20, 'Sapp', 'Long Evans','Rat'),
(21, 'Sapp', 'Wistar','Rat'),
(22, 'Sapp', 'GHSR','Rat'),
(23, 'Sapp', 'Rosa-iHIV x SD','Rat'),
(24, 'Sapp', 'Cfos-NIMH','Rat'),
(25, 'Sharma', 'C57BL/6','Mouse'),
(26, 'Sharma', 'BALB/c','Mouse'),
(27, 'Sharma', 'Th-cre','Mouse'),
(28, 'Sharma', 'Cfos-Lacz','Mouse'),
(29, 'Sharma', 'Long Evans','Rat'),
(30, 'Sharma', 'R26-TeTR-fos-T-iCre','Rat'),
(31, 'Mendel', 'Trp53','Mouse'),
(32, 'Mendel', 'BALB/c','Mouse'),
(33, 'Mendel', 'Long Evans','Rat'),
(34, 'Mendel', 'TR-fos-MFRP 1','Rat');

-- --------------------------------------------------------

--
-- Table structure for table `species`
--

DROP TABLE IF EXISTS `species`;
CREATE TABLE `species` (
  `species_name` varchar(10) NOT NULL,
  `animalID_species` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `species`
--

INSERT INTO `species` (`species_name`, `animalID_species`) VALUES
('mouse', NULL),
('rat', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `strains`
--

DROP TABLE IF EXISTS `strains`;
CREATE TABLE `strains` (
  `id_strain` int(11) NOT NULL,
  `strain_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strains`
--

INSERT INTO `strains` (`id_strain`, `strain_name`) VALUES
(1, 'strain1'),
(2, 'strain2'),
(3, 'strain3'),
(4, 'strain4'),
(5, 'strain5'),
(6, 'strain6'),
(7, 'strain7'),
(8, 'strain8');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(64) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_name` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `user_role` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `create_time`, `last_name`, `first_name`, `user_role`) VALUES
('admin', 'NULL', '$2y$12$CBwE4S.u7OKW9D0EkGIljO3qAGzfgOQijjXikS0V3kV76hJ61Ye82', '2019-06-19 18:04:45', 'Admin', 'Adam', 'Admin'),
('jbaker', NULL, '', '2019-06-19 06:45:53', 'Baker', 'June', 'Geneticist'),
('jdoe', NULL, '', '2019-06-19 06:45:53', 'Doe', 'John', 'Investigator'),
('jjohnson', NULL, '', '2019-06-19 06:45:53', 'Johnson', 'Jim', 'Breeder Tech'),
('jsmith', NULL, '', '2019-06-19 06:45:53', 'Smith', 'Jane', 'Investigator'),
('rinvest', 'NULL', '$2y$12$mK/rWvoZm/SWiFrw0W7TYeJO8V5OBqO79djzH0hxqh7Opzwr2djty', '2019-06-19 18:02:23', 'Invest', 'Ronald', 'Investigator'),
('tdavis', NULL, '', '2019-06-19 06:45:53', 'Davis', 'Tom', 'Investigator');

DROP VIEW IF EXISTS combined_search;
CREATE VIEW combined_search AS (SELECT animals.*, litters.* FROM animals LEFT JOIN litters ON animals.animalID=litters.animalID_pup);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animalID`),
  ADD UNIQUE KEY `tagNumber_UNIQUE` (`animalID`,`tagNumber`),
  ADD KEY `location_idx` (`location`),
  ADD KEY `generation_idx` (`generation`),
  ADD KEY `genotype_idx` (`genotype`),
  ADD KEY `species_idx` (`species`),
  ADD KEY `birth_date_idx` (`birth_date`),
  ADD KEY `wean_date_idx` (`wean_date`),
  ADD KEY `entered_date_idx` (`entered_date`),
  ADD KEY `strain_idx` (`strain`);

--
-- Indexes for table `breeding_pairs`
--
ALTER TABLE `breeding_pairs`
  ADD PRIMARY KEY (`pairID`),
  ADD UNIQUE KEY `pairID_UNIQUE` (`pairID`),
  ADD KEY `offspringGen_idx` (`offspringGen`),
  ADD KEY `male_idx` (`maleID`),
  ADD KEY `female_idx` (`femaleID`),
  ADD KEY `desiredStrain_idx` (`desiredStrain`),
  ADD KEY `pair_date_idx` (`pair_date`);

--
-- Indexes for table `generations`
--
ALTER TABLE `generations`
  ADD PRIMARY KEY (`generation_name`),
  ADD UNIQUE KEY `generation_name_UNIQUE` (`generation_name`),
  ADD KEY `animalID_gen_idx` (`animalID_gen`);

--
-- Indexes for table `genotypes`
--
ALTER TABLE `genotypes`
  ADD PRIMARY KEY (`genotype_name`),
  ADD UNIQUE KEY `genotype_name_UNIQUE` (`genotype_name`),
  ADD KEY `animalID_idx` (`animalID_geno`);

--
-- Indexes for table `litters`
--
ALTER TABLE `litters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `animalID_idx` (`animalID_pup`),
  ADD KEY `breedingPair_idx` (`breedingPair`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_name`),
  ADD UNIQUE KEY `location_name_UNIQUE` (`location_name`),
  ADD KEY `animalID_idx` (`animalID_location`);

--
-- Indexes for table `PI_strains`
--
ALTER TABLE `PI_strains`
  ADD PRIMARY KEY (`id_PI`),
  ADD UNIQUE KEY `id_PI_UNIQUE` (`id_PI`),
  ADD KEY `PI_username_idx` (`PI_username`),
  ADD KEY `strain_idx` (`PI_strain`);

--
-- Indexes for table `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`species_name`),
  ADD UNIQUE KEY `species_name_UNIQUE` (`species_name`),
  ADD KEY `animalID_species_idx` (`animalID_species`);

--
-- Indexes for table `strains`
--
ALTER TABLE `strains`
  ADD PRIMARY KEY (`id_strain`),
  ADD UNIQUE KEY `id_UNIQUE` (`id_strain`),
  ADD KEY `strain_name_UNIQUE` (`strain_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `breeding_pairs`
--
ALTER TABLE `breeding_pairs`
  MODIFY `pairID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `litters`
--
ALTER TABLE `litters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `PI_strains`
--
ALTER TABLE `PI_strains`
  MODIFY `id_PI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `strains`
--
ALTER TABLE `strains`
  MODIFY `id_strain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `generation` FOREIGN KEY (`generation`) REFERENCES `generations` (`generation_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `genotype` FOREIGN KEY (`genotype`) REFERENCES `genotypes` (`genotype_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `location` FOREIGN KEY (`location`) REFERENCES `location` (`location_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `species` FOREIGN KEY (`species`) REFERENCES `species` (`species_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `strain` FOREIGN KEY (`strain`) REFERENCES `strains` (`strain_name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Constraints for table `genotypes`
--
ALTER TABLE `genotypes`
  ADD CONSTRAINT `animalID_geno` FOREIGN KEY (`animalID_geno`) REFERENCES `animals` (`animalID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `PI_strains`
--
ALTER TABLE `PI_strains`
  ADD CONSTRAINT `PI_strain` FOREIGN KEY (`PI_strain`) REFERENCES `strains` (`strain_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PI_username` FOREIGN KEY (`PI_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `species`
--
ALTER TABLE `species`
  ADD CONSTRAINT `animalID_species` FOREIGN KEY (`animalID_species`) REFERENCES `animals` (`animalID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
