
USE c199grp10;

DROP TABLE IF EXISTS `TempCart` ;
Create Table `TempCart`
(
	`Products_ProductID_Temp` int(4) NOT NULL,
	`ProductName_Temp` varchar(50) NULL, 
	`ProductPrice_Temp` decimal(6,2) NULL,
	`Quantity_Purchased_Temp` int(2) NOT NULL,
	`Customers_CustID_Temp` int(5) NOT NULL	
);

