<?php include 'controller.php' ?>
<?php include '../LinkID.php' ?>
<?php startSession(); ?>

<?php
	if(isset($_SESSION['custID']))
		$custID=$_SESSION['custID'];
	else
		$_SESSION['custID']="";
	
	if (!$LinkID) {
		die('Could not connect: ' . mysql_error());
	}

	$prodID = $_POST['productID'];
	$tempQuantity = $_POST['quantity'];
	$quantity = (int)$tempQuantity;
	echo $quantity;
	if($quantity > 0){
		$insert = 'INSERT INTO TempCart (Products_ProductID_Temp,Quantity_Purchased_Temp,Customers_CustID_Temp) VALUES ('.$prodID.','.$quantity.','.$custID.');';
		mysql_select_db("c199grp10", $LinkID);
		$resultInsert = mysql_query( $insert ,$LinkID);


		$query = 'SELECT ProductName From Products WHERE ProductID ='.$prodID.';';
		mysql_select_db("c199grp10", $LinkID);
		$resultQuery = mysql_query( $query ,$LinkID);
		$value=mysql_fetch_row($resultQuery);
		if($value){
			foreach ($value as $v) {
				$productName = $v;
			}
		}
		if($resultInsert){
			echo 'Added '.$quantity. ' ' .$productName.' to cart.';
		}
	}
	else{
		echo 'Failed to add item.';
	}	
?>

