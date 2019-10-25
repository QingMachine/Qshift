-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2019 at 09:45 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sft`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `corpID` text NOT NULL,
  `ProjectCode` text NOT NULL,
  `ProjectName` text NOT NULL,
  `ProjectTeam` text NOT NULL,
  `ProjectDescription` text NOT NULL,
  `ProjectReference` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='use for select by shifter';

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`corpID`, `ProjectCode`, `ProjectName`, `ProjectTeam`, `ProjectDescription`, `ProjectReference`) VALUES
('Qing AB', 'P18N01', 'The Projet: Name', '', 'Project Description:\r\n1ã€‚\r\n2.\r\n3.\r\n', 0),
('Qing AB', 'P18N02', 'The Projet: Name', '', 'Project Description:\r\n1.', 0),
('Qing AB', 'P18N03', 'P18N03  JU SPE A', '', 'Project Description:\r\n1.', 0),
('Qing AB', 'P19N01', 'The Projet JU SPE 2019: PDCT 2', '', 'The Project Description:\r\n1.Qingï¼š tester\r\n2.Rehamï¼šanalyst\r\n3.Alfred: Product owner\r\n4.Mihai: Programmer\r\n', 0),
('Qing AB', '18PDCT', '18PDCT', '', 'Deskription:\r\n------------\r\nTEAM: 1.A 2.B 3.C 4.D 5.E/ \r\nSTART TIME:2018.12.10\r\nEND TIME:  2019.11.06\r\nTASKS: TO BUILD A EASY USE SCHEDULER FOR SME(SMALL AND MEDIUM SIZE CORP.)\r\n\r\n\r\n\r\n', 0),
('Qing AB', 'P20N01', 'P20N01', '', 'The Projet: \r\n1.XX\r\n2.YY\r\n3.ZZ', 0),
('Qing AB', 'P20N02', 'P20N02', '', 'The Projet: \r\n1.XX\r\n2.YY\r\n3.ZZ', 0),
('Qing AB', 'P20N03', 'P20N03', '', 'The Projet: \r\n1.XX\r\n2.YY\r\n3.ZZ', 0),
('Qing AB', 'P20N04', 'P20N04', '', 'The Projet: \r\n1.XX\r\n2.YY\r\n3.ZZ', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
