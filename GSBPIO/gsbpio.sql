-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.14 - MySQL Community Server (GPL)
-- SE du serveur:                Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la table gsbpio. adhesion
CREATE TABLE IF NOT EXISTS `adhesion` (
  `idA` int(11) NOT NULL AUTO_INCREMENT,
  `nomA` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `dateDernierPaiement` varchar(50) DEFAULT NULL,
  `idU` int(11) DEFAULT NULL,
  `idCh` int(11) DEFAULT NULL,
  PRIMARY KEY (`idA`),
  KEY `FK_adhesion_utilisateur` (`idU`),
  KEY `FK_adhesion_chien` (`idCh`),
  CONSTRAINT `FK_adhesion_chien` FOREIGN KEY (`idCh`) REFERENCES `chien` (`idCh`),
  CONSTRAINT `FK_adhesion_utilisateur` FOREIGN KEY (`idU`) REFERENCES `utilisateur` (`idU`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Export de données de la table gsbpio.adhesion : ~2 rows (environ)
/*!40000 ALTER TABLE `adhesion` DISABLE KEYS */;
INSERT INTO `adhesion` (`idA`, `nomA`, `date`, `dateDernierPaiement`, `idU`, `idCh`) VALUES
	(1, 'ok', '2017-09-16', '2017-09-16', 6, 1),
	(7, 'soquet', '2017-09-27', NULL, 34, 107);
/*!40000 ALTER TABLE `adhesion` ENABLE KEYS */;

-- Export de la structure de la table gsbpio. chien
CREATE TABLE IF NOT EXISTS `chien` (
  `idCh` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `DateDeNaissance` date DEFAULT NULL,
  `NTatouage` int(11) DEFAULT NULL,
  `DateAdhesion` date DEFAULT NULL,
  `idR` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCh`),
  KEY `FK_chien_race` (`idR`),
  CONSTRAINT `FK_chien_race` FOREIGN KEY (`idR`) REFERENCES `race` (`idR`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

-- Export de données de la table gsbpio.chien : ~4 rows (environ)
/*!40000 ALTER TABLE `chien` DISABLE KEYS */;
INSERT INTO `chien` (`idCh`, `nom`, `DateDeNaissance`, `NTatouage`, `DateAdhesion`, `idR`) VALUES
	(0, 'aa', '2017-01-01', 1, '2018-01-01', 1),
	(1, 'choupy', '2017-09-17', 120, '2017-09-17', 1),
	(2, 'snoopy', '2017-09-20', 30, '2017-09-20', 2),
	(107, 'mizou', '2017-09-20', 20, '2017-09-27', 2);
/*!40000 ALTER TABLE `chien` ENABLE KEYS */;

-- Export de la structure de la table gsbpio. race
CREATE TABLE IF NOT EXISTS `race` (
  `idR` int(11) NOT NULL,
  `race` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table gsbpio.race : ~4 rows (environ)
/*!40000 ALTER TABLE `race` DISABLE KEYS */;
INSERT INTO `race` (`idR`, `race`) VALUES
	(1, 'Berger allemand'),
	(2, 'Labrador'),
	(3, 'Rottweiler'),
	(4, 'Beagle');
/*!40000 ALTER TABLE `race` ENABLE KEYS */;

-- Export de la structure de la table gsbpio. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idU` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `mdp` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `Admin` int(11) NOT NULL DEFAULT '0',
  `Valider` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idU`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Export de données de la table gsbpio.utilisateur : ~1 rows (environ)
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`idU`, `Nom`, `prenom`, `login`, `mdp`, `mail`, `Admin`, `Valider`) VALUES
	(6, 'aydin', 'oktay', 'ooo', 'ooo', NULL, 1, 1),
	(34, 'soquet', 'chloe', 'toto', 'toto', 'chloe.soquet@hotmail.com', 0, 0);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
