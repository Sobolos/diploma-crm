-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: torex
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Clients`
--

DROP TABLE IF EXISTS `Clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Clients` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `house` varchar(100) NOT NULL,
  `entrance` varchar(100) DEFAULT NULL,
  `apartment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clients`
--

LOCK TABLES `Clients` WRITE;
/*!40000 ALTER TABLE `Clients` DISABLE KEYS */;
INSERT INTO `Clients` VALUES (11,'test','user',89061504326,'germansobol@yandex.ru','Russia','Саратов','street','43','51','22');
/*!40000 ALTER TABLE `Clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Items`
--

DROP TABLE IF EXISTS `Items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Items` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Count` int(11) NOT NULL,
  `Price` float NOT NULL,
  `Description` text NOT NULL,
  `DateLastArrival` datetime NOT NULL,
  `OnSale` tinyint(1) NOT NULL DEFAULT '0',
  `SalePercent` int(2) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Items`
--

LOCK TABLES `Items` WRITE;
/*!40000 ALTER TABLE `Items` DISABLE KEYS */;
INSERT INTO `Items` VALUES (1,'Товар 1',0,1000,'Описание первого товара','2020-02-04 13:25:00',0,0),(2,'Товар 2',2,2000,'Второй товар','2020-02-04 13:25:00',1,10),(3,'Товар 3',23,500,'Описание третьего товара','2020-02-04 13:25:00',0,100),(4,'Товар 4',5,5000,'Это пятый товар','2020-04-04 13:25:00',1,2),(5,'Товар 5',1,5000,'Это пятый товар','2020-04-04 13:25:00',1,2);
/*!40000 ALTER TABLE `Items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Log`
--

DROP TABLE IF EXISTS `Log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL,
  `Date` datetime NOT NULL,
  `message` varchar(100) DEFAULT NULL,
  `initiator` int(11) DEFAULT NULL,
  `OrderId` int(11) DEFAULT NULL,
  `ItemId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Log_FK` (`type`),
  KEY `Log_FK_1` (`initiator`),
  KEY `Orders` (`OrderId`),
  KEY `Log_Items` (`ItemId`),
  CONSTRAINT `Log_FK` FOREIGN KEY (`type`) REFERENCES `Operations` (`Id`),
  CONSTRAINT `Log_FK_1` FOREIGN KEY (`initiator`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Log_Items` FOREIGN KEY (`ItemId`) REFERENCES `Items` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Orders` FOREIGN KEY (`OrderId`) REFERENCES `Orders` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Log`
--

LOCK TABLES `Log` WRITE;
/*!40000 ALTER TABLE `Log` DISABLE KEYS */;
INSERT INTO `Log` VALUES (38,30,'2020-04-29 15:04:52','Добавлен пользователь 11',NULL,NULL,NULL),(39,1,'2020-04-29 15:04:52','Добавлен заказ',NULL,13,NULL),(43,2,'2020-04-29 15:23:03','Заказ принят дилером',2,13,NULL),(46,11,'2020-04-29 15:35:30','Товар укомплектован',2,13,1),(47,6,'2020-04-29 15:36:48','Заказ укомплектован',2,13,NULL),(48,7,'2020-04-29 15:41:31','Заказ выдан',2,13,NULL),(49,1,'2020-04-29 15:49:17','Добавлен заказ',NULL,14,NULL),(50,2,'2020-04-29 15:49:51','Заказ принят дилером',2,14,NULL),(51,11,'2020-04-29 15:50:27','Товар укомплектован',2,14,3),(52,11,'2020-04-29 15:50:28','Товар укомплектован',2,14,5),(53,3,'2020-04-29 15:53:54','Заказ на производство 10 едениц отправлен производителю',2,14,1),(54,4,'2020-04-29 15:56:04','Заказ принят на производство',3,NULL,NULL),(55,5,'2020-04-29 15:59:58','Заказ отправлен дилеру',3,NULL,NULL),(56,11,'2020-04-29 16:02:52','Товар укомплектован',2,14,1),(57,6,'2020-04-29 16:03:12','Заказ укомплектован',2,14,NULL),(58,7,'2020-04-29 16:03:27','Заказ выдан',2,14,NULL);
/*!40000 ALTER TABLE `Log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Manuf_Item`
--

DROP TABLE IF EXISTS `Manuf_Item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Manuf_Item` (
  `manufacturingId` int(11) DEFAULT NULL,
  `ItemId` int(11) DEFAULT NULL,
  KEY `Manuf_Item_FK_1` (`ItemId`),
  KEY `Manuf_Item_FK` (`manufacturingId`),
  CONSTRAINT `Manuf_Item_FK` FOREIGN KEY (`manufacturingId`) REFERENCES `Manufacturing` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Manuf_Item_FK_1` FOREIGN KEY (`ItemId`) REFERENCES `Items` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Manuf_Item`
--

LOCK TABLES `Manuf_Item` WRITE;
/*!40000 ALTER TABLE `Manuf_Item` DISABLE KEYS */;
INSERT INTO `Manuf_Item` VALUES (8,1);
/*!40000 ALTER TABLE `Manuf_Item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Manufacturing`
--

DROP TABLE IF EXISTS `Manufacturing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Manufacturing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemId` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `dealerId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `manufacturer` int(11) DEFAULT NULL,
  `ItemCompleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Manufacture_FK` (`itemId`),
  KEY `Manufacture_FK_1` (`dealerId`),
  KEY `Manufacture_FK_2` (`manufacturer`),
  KEY `Manufacturing_FK` (`orderId`),
  CONSTRAINT `Manufacture_FK_1` FOREIGN KEY (`dealerId`) REFERENCES `Users` (`id`),
  CONSTRAINT `Manufacture_FK_2` FOREIGN KEY (`manufacturer`) REFERENCES `Users` (`id`),
  CONSTRAINT `Manufacturing_FK` FOREIGN KEY (`orderId`) REFERENCES `Orders` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Manufacturing`
--

LOCK TABLES `Manufacturing` WRITE;
/*!40000 ALTER TABLE `Manufacturing` DISABLE KEYS */;
INSERT INTO `Manufacturing` VALUES (8,1,10,2,14,3,1);
/*!40000 ALTER TABLE `Manufacturing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Operations`
--

DROP TABLE IF EXISTS `Operations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Operations` (
  `Id` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Operations`
--

LOCK TABLES `Operations` WRITE;
/*!40000 ALTER TABLE `Operations` DISABLE KEYS */;
INSERT INTO `Operations` VALUES (1,'Оформле заказ'),(2,'Заказ взят в работу'),(3,'Заказ отправлен производителю'),(4,'Заказ принят на производство'),(5,'Заказ отправлен дилеру'),(6,'Заказ укомплектован'),(7,'Заказ завершен'),(8,'Товар добавден в заказ'),(9,'Товар удален из заказа'),(10,'Заказ удален'),(11,'Товар укомплектован'),(30,'Добавлен клиент');
/*!40000 ALTER TABLE `Operations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Order_Item`
--

DROP TABLE IF EXISTS `Order_Item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Order_Item` (
  `OrderId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `ItemCount` int(11) DEFAULT NULL,
  `Completed` tinyint(1) NOT NULL DEFAULT '0',
  KEY `Order_Item_FK` (`OrderId`),
  KEY `Items` (`ItemId`),
  CONSTRAINT `Items` FOREIGN KEY (`ItemId`) REFERENCES `Items` (`Id`),
  CONSTRAINT `Order_Item_FK` FOREIGN KEY (`OrderId`) REFERENCES `Orders` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Order_Item`
--

LOCK TABLES `Order_Item` WRITE;
/*!40000 ALTER TABLE `Order_Item` DISABLE KEYS */;
INSERT INTO `Order_Item` VALUES (13,1,1,1),(14,1,17,1),(14,3,1,1),(14,5,3,1);
/*!40000 ALTER TABLE `Order_Item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ClientId` int(11) DEFAULT NULL,
  `DateCreated` datetime NOT NULL,
  `Status` int(11) DEFAULT NULL,
  `responsible` int(11) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `house` varchar(100) DEFAULT NULL,
  `entrance` varchar(100) DEFAULT NULL,
  `apartment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Orders_FK_1` (`Status`),
  KEY `Orders_FK_2` (`responsible`),
  KEY `Orders_FK` (`ClientId`),
  CONSTRAINT `Orders_FK` FOREIGN KEY (`ClientId`) REFERENCES `Clients` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Orders_FK_1` FOREIGN KEY (`Status`) REFERENCES `Operations` (`Id`),
  CONSTRAINT `Orders_FK_2` FOREIGN KEY (`responsible`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (13,11,'2020-04-29 15:04:52',7,2,'Russia','Саратов','street','43','51','22'),(14,11,'2020-04-29 15:49:17',7,2,'Россия','Саратов','Билинова','31','3','129');
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'admin',1,'1234567890'),(2,'dealer',2,'123456789'),(3,'manufacturer',3,'12345');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-30 17:43:23
