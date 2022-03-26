CREATE DATABASE IF NOT EXISTS `gamersgarage_db`;
USE `gamersgarage_db`;





CREATE TABLE `games_inventory` (
  `game_id` int(20)   PRIMARY KEY AUTO_INCREMENT,
  `game` varchar(60)   DEFAULT NULL,
  `game_desc` varchar(255)   DEFAULT NULL,
  `game_image` varchar(255)   DEFAULT NULL,
  `cat_name` varchar(255) NOT NULL,
  `game_price` decimal(6,2) NOT NULL,
  `game_quantity` int(20) NOT NULL,
  `game_online` varchar(10) NOT NULL,
  `game_player` int(20) NOT NULL
 
)  ;



CREATE TABLE `customers` (
  `customerid` int(20)  PRIMARY KEY AUTO_INCREMENT,
  `firstname` varchar(60)   NOT NULL,
  `lastname` varchar(60)   NOT NULL,
  `address` varchar(80)   NOT NULL,
  `city` varchar(30)   NOT NULL,
  `province` char(2)   NOT NULL,
  `zip_code` varchar(10)   NOT NULL,
  `country` varchar(60)   NOT NULL
) ;




CREATE TABLE `paymentdetails` (
  `paymentid` int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `customerid` int(20) NOT NULL,
  `cardnumber` varchar(19) NOT NULL,
  `expirydate` varchar(10) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `paymentdate` timestamp NOT NULL DEFAULT current_timestamp(),
  CONSTRAINT `paymentdetails_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`customerid`)
);




CREATE TABLE `gameinventoryorder` (
  `orderid` int(20)   PRIMARY KEY AUTO_INCREMENT,
  `customerid` int(20)  NOT NULL,
  `game_id` int(20)  NOT NULL,
  `amount` decimal(6,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
   CONSTRAINT `gameinventoryorder_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`customerid`),
   CONSTRAINT `gameinventoryorder_ibfk_` FOREIGN KEY (`game_id`) REFERENCES `games_inventory` (`game_id`)
);