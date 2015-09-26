use c199grp10;
DROP TABLE IF EXISTS `Orders` ;
Create Table `Orders`
(
	`OrderID` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`OrderDate` DATE NOT NULL DEFAULT NOW(), 
	`CustID` int(5) NOT NULL
);