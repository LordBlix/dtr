/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.6.21 : Database - ci_demo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`ci_demo` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ci_demo`;

/*Table structure for table `mobiles` */

DROP TABLE IF EXISTS `mobiles`;

CREATE TABLE `mobiles` (
  `id` int(11) NOT NULL,
  `model_no` varchar(30) NOT NULL,
  `mobile_name` varchar(30) NOT NULL,
  `company` varchar(40) NOT NULL,
  `mobile_category` text NOT NULL,
  `price` double(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mobiles` */

insert  into `mobiles`(id,model_no,mobile_name,company,mobile_category,price) values (13,'SM-G615FZKUINS','Samsung Galaxy On Max (Black, ','Samsung','Smartphones',20800.00),(14,' SM-G955FZKGINS','Samsung Galaxy S8 Plus (Midnig','Samsung','Smartphones',18300.00),(15,'MN0X2HN/A','Apple iPhone 6s (Silver, 32 GB','Apple','Smartphones',50000.00),(16,'MQ8E2HN/A','Apple iPhone 8 Plus (Silver, 6','Apple','Smartphones',60200.00),(17,' R1 R829','OPPO R1 R829 (Black, 16 GB) (','OPPO','Smartphones',19000.00),(18,'F1','OPPO F1 (Gold, 16 GB) (3 GB R','OPPO','Smartphones',15500.00),(19,'MZB5602IN','Redmi 4A (Gold, 32 GB) (3 GB ','Xiomi','Smartphones',5999.00),(20,'MZB5653IN','Mi A1','Xiomi','Smartphones',17500.00);

/*Table structure for table `mobiles_copy` */

DROP TABLE IF EXISTS `mobiles_copy`;

CREATE TABLE `mobiles_copy` (
  `id` int(11) NOT NULL,
  `model_no` varchar(30) NOT NULL,
  `mobile_name` varchar(30) NOT NULL,
  `company` varchar(40) NOT NULL,
  `mobile_category` text NOT NULL,
  `price` double(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mobiles_copy` */

insert  into `mobiles_copy`(id,model_no,mobile_name,company,mobile_category,price) values (13,'SM-G615FZKUINS','Samsung Galaxy On Max (Black, ','Samsung','Smartphones',20800.00),(14,' SM-G955FZKGINS','Samsung Galaxy S8 Plus (Midnig','Samsung','Smartphones',18300.00),(15,'MN0X2HN/A','Apple iPhone 6s (Silver, 32 GB','Apple','Smartphones',50000.00),(16,'MQ8E2HN/A','Apple iPhone 8 Plus (Silver, 6','Apple','Smartphones',60200.00),(17,' R1 R829','OPPO R1 R829 (Black, 16 GB) (','OPPO','Smartphones',19000.00),(18,'F1','OPPO F1 (Gold, 16 GB) (3 GB R','OPPO','Smartphones',15500.00),(19,'MZB5602IN','Redmi 4A (Gold, 32 GB) (3 GB ','Xiomi','Smartphones',5999.00),(20,'MZB5653IN','Mi A1','Xiomi','Smartphones',17500.00);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
