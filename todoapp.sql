/*
SQLyog Community Edition- MySQL GUI v6.07
Host - 5.6.17 : Database - todoapp
*********************************************************************
Server version : 5.6.17
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `todoapp`;

USE `todoapp`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `todolist` */

DROP TABLE IF EXISTS `todolist`;

CREATE TABLE `todolist` (
  `todoId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `todoName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `taskCompltd` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`todoId`),
  KEY `FK_todolist` (`userId`),
  CONSTRAINT `FK_todolist` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `todolist` */

insert  into `todolist`(`todoId`,`userId`,`todoName`,`taskCompltd`) values (17,1,'test','0'),(18,1,'test2','0');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`userId`,`userName`) values (1,'ravi');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
