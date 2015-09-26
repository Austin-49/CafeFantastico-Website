
USE c199grp10;

DROP TABLE IF EXISTS `Customers` ;
Create Table `Customers`
(
	`CustID` int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`FName` varchar(25) NULL, 
	`LName` varchar(30) NULL, 
	`StreetNum` varchar(6) NULL,
	`StreetName` varchar(30) NULL, 
	`City` varchar(40) NULL, 
	`Prov` char(2) NULL, 
	`PCode` char(6) NULL, 
	`Phone` varchar(10) NULL, 
	`Email` varchar(50) NULL,
	`Hash` varchar(60) NULL
);

DROP TABLE IF EXISTS `Orders` ;
Create Table `Orders`
(
	`OrderID` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`OrderDate` DATETIME NOT NULL DEFAULT NOW, 
	`CustID` int(5) NOT NULL
);

DROP TABLE IF EXISTS `Products` ;
Create Table `Products`
(
	`ProductID` int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`ProductName` varchar(50) NULL, 
	`ProductType` varchar(20) NULL,
	`ProductPrice` decimal(6,2) NULL, 
	`ProductQuantity` int(4) NULL
);

DROP TABLE IF EXISTS `Shipping` ;
Create Table `Shipping`
(
	`Orders_OrderID` int(6) NOT NULL,
	`Products_ProductID` int(4) NOT NULL,
	`Quantity_Purchased` int(2) NOT NULL,
	`Customers_CustID` int(5) NOT NULL,
	`AltShippingID` int(5) NULL,
		
	CONSTRAINT `fk_Shipping_Orders`
    FOREIGN KEY (`Orders_OrderID`)
    REFERENCES `Orders` (`OrderID`),
	
	CONSTRAINT `fk_Shipping_Products`
    FOREIGN KEY (`Products_ProductID`)
    REFERENCES `Products` (`ProductID`),
	
	CONSTRAINT `fk_Shipping_Customers`
    FOREIGN KEY (`Customers_CustID`)
    REFERENCES `Customers` (`CustID`)

);