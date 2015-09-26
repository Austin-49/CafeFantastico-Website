
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
if(isset($_SESSION['custID'])) {
	$_SESSION['custID']=$_SESSION['custID'];
} else {
	$_SESSION['custID']="";
}

$custID=$_SESSION['custID'];

	include '../LinkID.php';
	if (!$LinkID) {
		die('Could not connect: ' . mysql_error());
	}
	//Grabs data for product re-shelfing
	mysql_select_db("c199grp10", $LinkID);
	$result = mysql_query("SELECT Products_ProductID_Temp, Quantity_Purchased_Temp FROM TempCart Where Customers_CustID_Temp =".$custID.";");
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		//printf("ProdID: %s  Quantity: %s", $row[0], $row[1]);  
		$prodID = $row[0];
		$quant = $row[1];
		//actually adds the product numbers back into the PRoduct db
		$subQuery = 'UPDATE Products set ProductQuantity = ProductQuantity + '.$quant.' Where ProductID ='.$prodID.';';
		mysql_select_db("c199grp10", $LinkID);
		$resultUpdate = mysql_query($subQuery ,$LinkID);
	}
	mysql_free_result($result);
	//deletes the cart info for the current user
	$deleteAll = 'DELETE FROM TempCart WHERE Customers_CustID_Temp = '.$custID.';';
	mysql_select_db("c199grp10", $LinkID);
	$outcome = mysql_query( $deleteAll ,$LinkID);

?>

<!-- Next bit is copy and pasted right from shoppingCart.php, This causes the shopping cart to re-display after clicking clear cart -->

<div id="row" background="images/tableBG.jpg" style="width:340px;">

            	<fieldset>
            	<legend>Your Items</legend>

		<?php
			if(isset($_SESSION['custID'])){
				$custID=$_SESSION['custID'];
				
				if (!$LinkID) {
					die('Could not connect: ' . mysql_error());
				}
				//get full list
				$getCart = 'SELECT Products_ProductID_Temp as ID, ProductName_Temp as Item,Quantity_Purchased_Temp as Quantity, (ProductPrice_Temp * Quantity_Purchased_Temp) as Sum FROM TempCart WHERE Customers_CustID_Temp ='.$custID.';'; 
				mysql_select_db("c199grp10", $LinkID);
				$resultCart = mysql_query( $getCart ,$LinkID);
				
				$productSum = 0;
				$prodID=0;
				$quant=0;
				if (@mysql_num_rows($resultCart)!=0) {
					print "<p>";
					print '<table border=2 background="images/tableBG.jpg"><tr>';
					$x=mysql_fetch_assoc($resultCart);
					$count = 0;
					foreach (array_keys($x) as $k) {
						if ($count >0){
							print "<td><b>$k</b></td>";
						}
						$count += 1;
    				}
					print "</tr><tr>";
					$count = 0;
					foreach ($x as $v) {
						if ($count >0){
							print "<td>$v</td>";
						}
						$count += 1;	
					}
					$productSum +=$x['Sum'];
					echo '<td><input type ="button" id="'.$x['ID'].'" value="Remove" onclick="removeFromCart(this.id)"/></td>';
					print "</tr><tr>";
					while ($row = mysql_fetch_array($resultCart, MYSQL_NUM)) {
						//print_r($row);
						$prodID = $row[0];
						$name = $row[1];
						$quant = $row[2];
						//print "<td>$row[0]</td>";	
						print "<td>$row[1]</td>";	
						print "<td>$row[2]</td>";	
						print "<td>$row[3]</td>";	
						echo '<td><input type ="button" id="'.$prodID.'" value="Remove" onclick="removeFromCart(this.id)"/></td>';
						print "</tr><tr>";
						$productSum+=$row[3];
					}
					print "</tr></table>";
					print "<p>Total: $".$productSum;
					
					
				}
			}
		?>		
		<div class= "row"> 
		<p>Cart Emptied!</p>
		<input type="button" value="Close Shopping Cart" onclick="removeCart()"/>

           
                </div>
                 <br>
        

</div> <!-- end div popin -->

<?php session_destroy(); ?>
</body>
</html>