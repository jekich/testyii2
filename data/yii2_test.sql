-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.38-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table testdev.group
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table testdev.group: ~4 rows (approximately)
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`id`, `name`) VALUES
	(1, '1'),
	(2, '2'),
	(3, '3'),
	(4, '4');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;


-- Dumping structure for table testdev.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table testdev.migration: ~2 rows (approximately)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1431694337),
	('m150515_124856_init', 1431695589);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;


-- Dumping structure for table testdev.skill
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table testdev.skill: ~3 rows (approximately)
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
INSERT INTO `skill` (`id`, `name`) VALUES
	(1, 'a'),
	(2, 'b'),
	(3, 'c');
/*!40000 ALTER TABLE `skill` ENABLE KEYS */;


-- Dumping structure for table testdev.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `in_place` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table testdev.staff: ~3 rows (approximately)
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`id`, `name`, `in_place`) VALUES
	(1, 'Test 1', 0),
	(2, 'Test 2', 1),
	(3, 'Test 3', 0),
	(4, 'Test 4', 0),
	(5, 'Test 5', 1),
	(6, 'Test 6', 0);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;


-- Dumping structure for table testdev.staff_group
CREATE TABLE IF NOT EXISTS `staff_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_staff_group_staff` (`staff_id`),
  KEY `FK_staff_group_group` (`group_id`),
  CONSTRAINT `FK_staff_group_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_staff_group_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table testdev.staff_group: ~3 rows (approximately)
/*!40000 ALTER TABLE `staff_group` DISABLE KEYS */;
INSERT INTO `staff_group` (`id`, `staff_id`, `group_id`) VALUES
	(1, 1, 2),
	(2, 1, 4),
	(3, 2, 3),
	(4, 6, 1),
	(5, 5, 2),
	(7, 4, 3),
	(8, 3, 4),
	(9, 5, 3),
	(10, 5, 4);
/*!40000 ALTER TABLE `staff_group` ENABLE KEYS */;


-- Dumping structure for table testdev.staff_skill
CREATE TABLE IF NOT EXISTS `staff_skill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) unsigned NOT NULL,
  `skill_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_staff_skill_staff` (`staff_id`),
  KEY `FK_staff_skill_skill` (`skill_id`),
  CONSTRAINT `FK_staff_skill_skill` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_staff_skill_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table testdev.staff_skill: ~1 rows (approximately)
/*!40000 ALTER TABLE `staff_skill` DISABLE KEYS */;
INSERT INTO `staff_skill` (`id`, `staff_id`, `skill_id`) VALUES
	(1, 1, 2),
	(3, 2, 2),
	(4, 3, 2),
	(5, 3, 3),
	(6, 4, 1),
	(7, 5, 3),
	(8, 6, 2),
	(9, 1, 1),
	(10, 6, 1),
	(11, 6, 3);
/*!40000 ALTER TABLE `staff_skill` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
