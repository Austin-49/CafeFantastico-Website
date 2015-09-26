use c199grp10;
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