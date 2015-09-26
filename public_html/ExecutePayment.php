<?php require 'controller.php' ?>
<?php require '../LinkID.php' ?>
<?php startSession(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Execution</title>
<link rel="stylesheet" type="text/css" href="css/default.css">
<style type="text/css">
a.mainpage  { font-family: "Times New Roman", Times, serif;
			 color: blue;
		   }
</style>
</head>

<body>
	<header style="margin-top:-60px;">
		<h1> Index </h1>
		<a href="Index.php">		 <input style="left:13%;"   type="button" id="navigation" value="Home">			</a>
		<a href="AboutUs.php">	 <input style="left:23%;"   type="button" id="navigation" value="About Us">			</a>
		<a href="coffeeBeans.php">	 <input style="left:33%;"   type="button" id="navigation" value="Coffee Beans">		</a>
		<a href="coffeeProducts.php"><input style="right:33%;"  type="button" id="navigation" value="Coffee Products">		</a>
		<a href="checkout.php">	 <input style="right:21%;"  type="button" id="navigation" value="Checkout">			</a>
						 <input style="right:5%;"   type="button" id="navigation" value="View Shopping Cart" onclick="showShoppingCart()" ></a>		
	<div id="cookiesplash"> 
	<p>
	<?php checkLogin($LinkID); ?>
	</p>
	</div>

	<div id="loginsplash">
		Email: 
		<input type= "text" name ="login" id= "login" size="7" placeholder= "name@domain.com">



		Password:
		<input type= "password" name ="password" id= "password" size="5" placeholder= "********">


		<input value="Login!" onclick="login()" type="button">
		<input value="LogOut" name= "LogOut" onclick="logout()" type="button">
		<br>
		<input value="New Customer? Click Here!" onclick="newCustomer()" type="button">
	</div>
	
	<!-- Div for creating a new customer -->
	<div id="logindisplay">
	</div>
	
	<!-- Div for showing shopping cart contents -->
	<div id="shoppingCartDisplay">
	</div>

	</header>  
                  


<!-- Display database Info -->
<div id="leftbox">
<?php
	$shippingID = 0;
	$orderID = 0;
	$totalprice = $_SESSION['totalprice'];
	if(isset($_SESSION['custID']))
			$custID=$_SESSION['custID'];
	if(isset($_SESSION['shippingID']))		
			$shippingID = $_SESSION['shippingID'];
			
	if (isset($_GET['success'])){
		//Do all of this if the payment went through
		if ($_GET['success']){
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<p>Payment successful!</p>";
			echo "<br>";
			echo "<p>A receipt has been emailed to you.</p>";
			
			//Create an order number for the current order
			mysql_select_db("c199grp10", $LinkID);
			$insert = 'INSERT INTO Orders (CustID,OrderDate,OrderTime) VALUES ('.$custID.',curdate(),curtime());';
			$resultInsert = mysql_query($insert ,$LinkID);
			
			//Get the -just created- orderID from the order table
			$getOrderID = "SELECT OrderID FROM Orders WHERE CustID=".$custID." AND OrderDate=curdate() AND MINUTE(OrderTime)=MINUTE(curtime());";
			$resultGetOrderID = mysql_query($getOrderID ,$LinkID);
			if($resultGetOrderID){
				$row = mysql_fetch_array($resultGetOrderID, MYSQL_NUM);
				$orderID = $row[0];		
			}
			
			//Grab the productID and quantities from the temp cart
			mysql_select_db("c199grp10", $LinkID);
			$result = mysql_query("SELECT Products_ProductID_Temp, Quantity_Purchased_Temp FROM TempCart Where Customers_CustID_Temp =".$custID.";");
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$prodID = $row[0];
				$quantity = $row[1];
				// If there was an alternate shipping address stored in the Session variable, use it in the insert onto the shipping table
				if($shippingID > 0)
					$insert = 'INSERT INTO Shipping (Orders_OrderID,Products_ProductID,Quantity_Purchased,Customers_CustID, AltShippingID) VALUES ('.$orderID.','.$prodID.','.$quantity.','.$custID.','.$shippingID.');';
				//or else it will have a null value, and we will assume that the customer is shipping to their own address from the Customers table
				else
					$insert = 'INSERT INTO Shipping (Orders_OrderID,Products_ProductID,Quantity_Purchased,Customers_CustID) VALUES ('.$orderID.','.$prodID.','.$quantity.','.$custID.');';
				mysql_select_db("c199grp10", $LinkID);
				$resultInsert = mysql_query($insert ,$LinkID);
			}

			
			$fname = "default";
			$lname = "default";
			$streetnum = 0;
			$streetname ="default";
			$city = "";
			$prov = "";
			$pcode ="";
			$phone = 0;
			$email = "";
			$prodName = "";
			$prodPrice = 0;
			$quant = 0;
			
			$shippingAddress = "";
			
			$getCust = 'SELECT FName,LName,StreetNum,StreetName,City,Prov,PCode,Phone,Email from Customers WHERE CustID = '.$custID.';';
			mysql_select_db("c199grp10", $LinkID);
			$outcomeCust = mysql_query( $getCust ,$LinkID);
			while ($row = mysql_fetch_array($outcomeCust, MYSQL_NUM)) {
				$fname = $row[0];
				$lname = $row[1];
				$streetnum = $row[2];
				$streetname = $row[3];
				$city = $row[4];
				$prov = $row[5];
				$pcode =$row[6];
				$phone = $row[7];
				$email = $row[8];
				$shippingAddress = $streetnum." ".$streetname."\n".$city." ".$prov."\n".$pcode."\n\n";
			}
			
			$productOutput = "";
			
			$getProducts = "SELECT ProductName_Temp, Quantity_Purchased_Temp,ProductPrice_Temp FROM TempCart Where Customers_CustID_Temp =$custID;" ;	
			mysql_select_db("c199grp10", $LinkID);		
			$result = mysql_query($getProducts, $LinkID);


			while($row = mysql_fetch_array($result, MYSQL_NUM)){
				$prodName = $row[0];
				$quant = $row[1];
				$prodPrice = $row[2];
				$productOutput .= "$prodName x $quant @ $$prodPrice \r\n";
			}
			
			if(isset($_SESSION['shippingID'])){		
				$shippingID = $_SESSION['shippingID'];
				$getCust = "SELECT FName,LName,Street,City,Prov,PCode,Phone FROM AltShipping WHERE ShippingID = $shippingID;";
				mysql_select_db("c199grp10", $LinkID);

				$outcomeCust = mysql_query($getCust ,$LinkID);
				$street = "";
				$city = "";
				$prov = "";
				$pcode ="";
				$phone = 0;	
				while ($row = mysql_fetch_array($outcomeCust, MYSQL_NUM)) {
					$fname = $row[0];
					$lname = $row[1];
					$street = $row[2];
					$city = $row[3];
					$prov = $row[4];
					$pcode =$row[5];
					$phone = $row[6];	
					$shippingAddress = $street."\r\n".$city."\r\n".$prov."\r\n".$pcode."\r\n";
				}
								
			}

			
			$subject = 'Caffe Fantastico Coffee Order';
			$line1 = "Dear  ".$fname." ".$lname.":\r\n\n";
			$line2 = "Your order of:\n";
			$line3 = "Total: $".$totalprice." \n\n";
			$line4 = "Has shipped to the address: \n";
			$line6 = "Your order should arrive in 2-4 business days.\n Thank you for shopping at Caffe Fantastico!";
			$message = $line1.$line2.$productOutput.$line3.$line4.$shippingAddress.$line6;
			$headers = 'From: info@caffefantastico.com' . "\r\n" .
				'Reply-To: info@caffefantastico.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

			mail($email, $subject, $message, $headers);
			
			
			
			
			
			
			
			
		//deletes the temp cart info for the current user
		$deleteAll = 'DELETE FROM TempCart WHERE Customers_CustID_Temp = '.$custID.';';
		mysql_select_db("c199grp10", $LinkID);
		$outcome = mysql_query( $deleteAll ,$LinkID);	

			
		}
		else
			echo "<p>Payment unsuccessful.<p>";
	}
	
	
	
?>
</div>

<div id="rightbox">
</div>
<div style="margin-top:60px;">

</div>
<!-- Reference external javascript -->

<script src="javascripts/sessionFunctions.js" type="text/javascript"> </script>
</body>
</html>