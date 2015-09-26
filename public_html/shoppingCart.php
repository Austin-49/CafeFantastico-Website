<?php require 'controller.php' ?>
<?php require '../LinkID.php' ?>
<?php startSession(); ?>
<!DOCTYPE HTML>
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

<!-- ----------------------------Drawup Shoppingcart----------------------------------------- -->

<div id="row" background="images/tableBG.jpg">

            	<fieldset>
            	<legend>Your Items</legend>
		<br>
		<?php
			if(isset($_SESSION['custID'])){
				$custID=$_SESSION['custID'];
				
				if (!$LinkID) {
					die('Could not connect: ' . mysql_error());
				}
				// Grab neccessary information from tempcart
				$getCart = 'SELECT Products_ProductID_Temp as ID, ProductName_Temp as Item,Quantity_Purchased_Temp as Quantity, (ProductPrice_Temp * Quantity_Purchased_Temp) as Sum FROM TempCart WHERE Customers_CustID_Temp ='.$custID.';'; 
				mysql_select_db("c199grp10", $LinkID);
				$resultCart = mysql_query( $getCart ,$LinkID);
				
				$productSum = 0;
				$prodID=0;
				$quant=0;
				
				// Execute SQL Query to grab shoppingcart contents
				
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
					
					// Special foreach to grab the first row
					
					foreach ($x as $v) {
						if ($count >0){
							print "<td>$v</td>";
						}
						$count += 1;	
					}
					$productSum +=$x['Sum'];
					echo '<td><input type ="button" id="'.$x['ID'].'" value="Remove" onclick="removeFromCart(this.id)"/></td>';			
					print "</tr><tr>";
					
					// Retrieve the rest of the rows from temp cart
					
					while ($row = mysql_fetch_array($resultCart, MYSQL_NUM)) {
						$prodID = $row[0];
						$name = $row[1];
						$quant = $row[2];
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
				else{
					echo "Nothing in cart.";
				}
			}
			else{
				echo "Login to display cart.";
			}
		?>
		<br>		
		<div class= "row"> 
		
		<input type="button" value="Close Shopping Cart" onclick="removeCart()"/>
		<a href="checkout.php"> <input type="button" value="Checkout"> </a>
		<input type="button" id="emptyCart" name="'$x[4]'" value="Empty Cart" onclick="emptyCart()"/>

           
                </div>
                 <br>
        

</div>

<!-- Reference external javascript -->

<script src="javascripts/sessionFunctions.js" type="text/javascript"> </script>

</body>
</html>
