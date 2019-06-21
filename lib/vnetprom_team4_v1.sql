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

INSERT INTO `animals` (`animalID`, `species`, `classification`, `sex`, `entered_date`, `tag_date`, `birth_date`, `wean_date`, `genotype`, `generation`, `location`, `tagNumber`, `deceased`, `transferred`, `comments`, `strain`) VALUES
(88, 'mouse', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-06-05', '2019-06-05', 'type1', 'gen1', 'location1', 2876, b'0', b'0', 'No notes', 'strain1'),
(99, 'mouse', 'breeder', 'Female', '2019-06-05 00:00:00', '2019-06-12', '2019-06-05', '2019-06-05', 'type8', 'gen1', 'location1', 2347, b'0', b'0', 'No notes', 'strain1'),
(101, 'mouse', 'weanling', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-06-05', '2019-06-05', 'type4', 'gen2', 'location2', 9037, b'0', b'0', 'none', 'strain3'),
(102, 'mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2019-06-12', '2019-06-05', '2019-06-05', 'type3', 'gen2', 'location2', 4836, b'0', b'0', 'none', 'strain1'),
(103, 'mouse', 'breeder', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-06-05', '2019-06-05', 'type2', 'gen2', 'location2', 5213, b'0', b'1', 'none', 'strain2'),
(104, 'mouse', 'breeder', 'Female', '2019-06-05 00:00:00', '2019-06-12', '2019-06-05', '2019-06-05', 'type1', 'gen2', 'location2', 1256, b'0', b'0', 'none', 'strain4'),
(105, 'mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2019-06-12', '2019-06-05', '2019-06-05', 'type8', 'gen3', 'location3', 6425, b'0', b'0', 'none', 'strain4'),
(106, 'mouse', 'weanling', 'Female', '2019-06-05 00:00:00', '2019-06-12', '2019-06-05', '2019-06-05', 'type3', 'gen3', 'location3', 1234, b'0', b'0', 'none', 'strain6'),
(107, 'mouse', 'pup', 'Female', '2019-06-05 00:00:00', '2019-06-12', '2019-06-05', '2019-06-05', 'type3', 'gen3', 'location3', 3433, b'0', b'0', 'none', 'strain6'),
(108, 'mouse', 'pup', 'Male', '2019-06-05 00:00:00', '2019-06-12', '2019-06-05', '2019-06-05', 'type3', 'gen3', 'location3', 3434, b'0', b'0', 'none', 'strain6');

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

INSERT INTO `breeding_pairs` (`pairID`, `maleID`, `femaleID`, `desiredStrain`, `offspringGen`, `pair_date`, `notes`) VALUES
(1, 88, 99, NULL, 'gen2', '2019-06-05', 'na'),
(2, 103, 102, NULL, 'gen3', '2019-06-05', 'na'),
(3, 103, 102, NULL, 'gen3', '2018-06-05', 'na');

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
('type1', NULL),
('type2', NULL),
('type3', NULL),
('type4', NULL),
('type5', NULL),
('type6', NULL),
('type7', NULL),
('type8', NULL);

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

INSERT INTO `litters` (`id`, `litterID`, `animalID_pup`, `breedingPair`) VALUES
(1, 1, 101, 1),
(2, 1, 102, 1),
(3, 2, 105, 2),
(4, 3, 106, 2),
(5, 3, 107, 2),
(6, 3, 108, 2);

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
  `PI_strain` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PI_strains`
--

INSERT INTO `PI_strains` (`id_PI`, `PI_username`, `PI_strain`) VALUES
(1, 'jdoe', 'strain1'),
(2, 'jsmith', 'strain2'),
(3, 'jsmith', 'strain3'),
(4, 'jdoe', 'strain3'),
(5, 'tdavis', 'strain3'),
(6, 'jdoe', 'strain4'),
(7, 'jsmith', 'strain4'),
(8, 'jsmith', 'strain5'),
(9, 'tdavis', 'strain6'),
(10, 'jsmith', 'strain7'),
(11, 'tdavid', 'strain8'),
(12, 'jdoe', 'strain8');

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
