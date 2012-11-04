# HeidiSQL Dump 
#
# --------------------------------------------------------
# Host:                 127.0.0.1
# Database:             estgube
# Server version:       5.0.45-community-nt
# Server OS:            Win32
# Target-Compatibility: MySQL 4.0
# Extended INSERTs:     Y
# max_allowed_packet:   1048576
# HeidiSQL version:     3.0 Revision: 572
# --------------------------------------------------------

/*!40100 SET CHARACTER SET latin1*/;


#
# Database structure for database 'estgube'
#

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `estgube` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `estgube`;


#
# Table structure for table 'users'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `users` (
  `UID` int(11) NOT NULL auto_increment,
  `NOME` varchar(200) NOT NULL,
  `DATANASC` date NOT NULL,
  `GENERO` enum('M','F') NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `USRLVL` enum('N','S') NOT NULL default 'N',
  `LOGIN` varchar(20) NOT NULL,
  `PASS` varchar(32) NOT NULL,
  `DATACRIADO` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;



#
# Table structure for table 'videos'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `videos` (
  `VID` int(11) NOT NULL auto_increment,
  `UID` int(11) NOT NULL,
  `TITULO` varchar(50) NOT NULL,
  `DESCRICAO` text NOT NULL,
  `FILENAME` varchar(255) NOT NULL,
  `VEZES` int(11) NOT NULL default '0',
  `DATAINS` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `status` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`VID`),
  KEY `FK_USERVIDEO` (`UID`),
  CONSTRAINT `FK_USERVIDEO` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;




#
# Table structure for table 'comentarios'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `comentarios` (
  `VID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `CID` int(11) unsigned NOT NULL auto_increment,
  `COMENTARIO` text NOT NULL,
  `DATACOM` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`CID`),
  KEY `FK_USERCOM` (`UID`),
  KEY `FK_VIDEOCOM` (`VID`),
  CONSTRAINT `FK_USERCOM` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
  CONSTRAINT `FK_VIDEOCOM` FOREIGN KEY (`VID`) REFERENCES `videos` (`VID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;



#
# Table structure for table 'favoritos'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `favoritos` (
  `VID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  PRIMARY KEY  (`VID`,`UID`),
  KEY `FK_FAVID` (`UID`),
  CONSTRAINT `FK_FAVID` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
  CONSTRAINT `FK_USERFAV` FOREIGN KEY (`VID`) REFERENCES `videos` (`VID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



#
# Table structure for table 'ratings'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `ratings` (
  `VID` int(11) NOT NULL,
  `RATING` smallint(6) NOT NULL default '0',
  `VOTOS` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`VID`),
  CONSTRAINT `FK_VIDEORATING` FOREIGN KEY (`VID`) REFERENCES `videos` (`VID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



#
# Table structure for table 'reports'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `reports` (
  `VID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `RID` int(11) unsigned NOT NULL auto_increment,
  `REPORT` text NOT NULL,
  `DATAREP` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `TRATADO` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`RID`),
  KEY `FK_USERREP` (`UID`),
  KEY `FK_VIDEOREP` (`VID`),
  CONSTRAINT `FK_USERREP` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
  CONSTRAINT `FK_VIDEOREP` FOREIGN KEY (`VID`) REFERENCES `videos` (`VID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;




#
# CRIAÇÂO DO SUPERUTILIZADOR
#
INSERT INTO users (NOME, DATANASC, GENERO, EMAIL, USRLVL, LOGIN, PASS) VALUES ('SUPERUTILIZADOR','0000-00-00','M','root@localhost','S','root','827ccb0eea8a706c4c34a16891f84e7b');
