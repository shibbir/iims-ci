CREATE DATABASE  IF NOT EXISTS `iims_app_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `iims_app_db`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: iims_app_db
-- ------------------------------------------------------
-- Server version	5.7.5-m15-log

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
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_customer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerName` varchar(50) NOT NULL,
  `Contact` varchar(50) NOT NULL,
  `Address` varchar(300) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `CreatedDate` varchar(30) NOT NULL,
  `ModifiedDate` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Contact` (`Contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_customer`
--

LOCK TABLES `tbl_customer` WRITE;
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_inventory`
--

DROP TABLE IF EXISTS `tbl_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_inventory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(300) NOT NULL DEFAULT 'Not Available',
  `Quantity` int(11) NOT NULL,
  `Warranty` varchar(30) NOT NULL DEFAULT '0',
  `UnitPrice` varchar(10) NOT NULL,
  `Status` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` varchar(30) NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedDate` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_inventory`
--

LOCK TABLES `tbl_inventory` WRITE;
/*!40000 ALTER TABLE `tbl_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_inventory_category`
--

DROP TABLE IF EXISTS `tbl_inventory_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_inventory_category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(30) NOT NULL,
  `CategoryKey` varchar(50) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` varchar(30) NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedDate` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_inventory_category`
--

LOCK TABLES `tbl_inventory_category` WRITE;
/*!40000 ALTER TABLE `tbl_inventory_category` DISABLE KEYS */;
INSERT INTO `tbl_inventory_category` VALUES (1,'Uncategorized','uncategorized','<p>This is the default category</p>',1,'',1,'2013-03-16 15:27:36');
/*!40000 ALTER TABLE `tbl_inventory_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_invoice`
--

DROP TABLE IF EXISTS `tbl_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_invoice` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `InvoiceNumber` varchar(50) NOT NULL,
  `InvoiceType` varchar(30) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `CustomerNameForCashSale` varchar(30) NOT NULL,
  `CustomerMobileForCashSale` varchar(30) NOT NULL DEFAULT '0',
  `CreatedDate` varchar(30) NOT NULL,
  `ServiceCharge` varchar(10) NOT NULL,
  `TotalCost` varchar(10) NOT NULL,
  `TotalDiscount` varchar(10) NOT NULL,
  `VAT` varchar(10) NOT NULL,
  `GrandTotal` decimal(10,0) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedDate` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_invoice`
--

LOCK TABLES `tbl_invoice` WRITE;
/*!40000 ALTER TABLE `tbl_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_invoice_details`
--

DROP TABLE IF EXISTS `tbl_invoice_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_invoice_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `InvoiceID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `UnitPrice` decimal(10,0) NOT NULL,
  `Warranty` varchar(30) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `SerialNumber` varchar(300) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_invoice_details`
--

LOCK TABLES `tbl_invoice_details` WRITE;
/*!40000 ALTER TABLE `tbl_invoice_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_invoice_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_organization`
--

DROP TABLE IF EXISTS `tbl_organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_organization` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `SubTitle` varchar(100) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Address` varchar(300) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `Phone` varchar(25) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Website` varchar(50) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedDate` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_organization`
--

LOCK TABLES `tbl_organization` WRITE;
/*!40000 ALTER TABLE `tbl_organization` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_todo`
--

DROP TABLE IF EXISTS `tbl_todo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_todo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) NOT NULL,
  `Status` enum('Complete','Incomplete') NOT NULL,
  `CreatedDate` varchar(30) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `ModifiedBy` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ModifiedDate` varchar(30) NOT NULL,
  `FinishedBy` int(11) NOT NULL,
  `FinishedDate` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_todo`
--

LOCK TABLES `tbl_todo` WRITE;
/*!40000 ALTER TABLE `tbl_todo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_todo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Contact` varchar(25) NOT NULL,
  `Address` text NOT NULL,
  `IsActive` tinyint(4) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedDate` varchar(30) NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedDate` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'admin','d700e32e6356642bfcee6aa89f7c7e6fe055da36','Administrator','555777999','Earth',1,1,'01 January, 2013',1,'11 April, 2015 | 3:09 am');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-11  3:35:48
