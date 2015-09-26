<?php require '../LinkID.php' ?>
<html>
<html lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE-9" />
<meta name= "New Customer Test" content= "This is a test website for comp199" />
<title>View Shopping Cart</title>
<link rel="stylesheet" type="text/css" href="css/form.css">
</head>

<body>

<!-- Set the customer ID to $customerID then delete all entries from the database where customers_custID_Temp = $customerID -->

<?php
session_start(); 
if(isset($_SESSION['custID']))
	$_SESSION['custID']=$_SESSION['custID'];
else
	$_SESSION['custID']="";


$custID=$_SESSION['custID'];
$productID=$_GET['productID'];
	if (!$LinkID) {
		die('Could not connect: ' . mysql_error());
	}
	// Get the quantity of the product you're deleting
	$quant=0;
	$getNums = "SELECT Quantity_Purchased_Temp FROM TempCart Where Customers_CustID_Temp =".$custID." AND Products_ProductID_Temp =".$productID.";";
	mysql_select_db("c199grp10", $LinkID);
	$resultOfNum = mysql_query($getNums ,$LinkID);
	$valueName=mysql_fetch_row($resultOfNum);
	if($valueName){
		foreach ($valueName as $v) {
			$quant = $v;
		}
	}
	// Put the correct quantity of that product back into the database
	$subQuery = 'UPDATE Products set ProductQuantity = ProductQuantity + '.$quant.' Where ProductID ='.$productID.';';
	mysql_select_db("c199grp10", $LinkID);
	$resultUpdate = mysql_query($subQuery ,$LinkID);
		
	// Delete the item from your cart
	$query = 'DELETE FROM TempCart WHERE Customers_CustID_Temp = '.$custID.' AND Products_ProductID_Temp = '.$productID.';';
	mysql_select_db("c199grp10", $LinkID);
	$result2 = mysql_query( $query ,$LinkID);


?>

<!-- Calls upon shoppingCart.php to redisplay the cart -->

<?php @require 'shoppingCart.php' ?>

</body>
</html>