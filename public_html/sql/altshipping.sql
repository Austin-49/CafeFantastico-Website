USE c199grp10;

DROP TABLE IF EXISTS `AltShipping` ;
Create Table `AltShipping`
(
	`CustID` int(5) NOT NULL,
	`ShippingID` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`FName` varchar(25) NULL, 
	`LName` varchar(30) NULL, 
	`Street` varchar(30) NULL, 
	`City` varchar(40) NULL, 
	`Prov` char(2) NULL, 
	`PCode` char(6) NULL,
	`Phone` varchar(10) NULL
);