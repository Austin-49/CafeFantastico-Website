<?php require 'controller.php' ?>
<?php require '../LinkID.php' ?>
<?php startSession(); ?>

<!DOCTYPE HTML>
<html>

<head>
<meta http-equiv="Content-Type" content= text.html; "charset=iso-8859-1"/>
<meta http-equiv="X-UA-Compatible" content="IE=9" />

<title>Main Page</title>

<link rel="stylesheet" type="text/css" href="css/default.css">
<style type="text/css">
a.mainpage  { font-family: "Times New Roman", Times, serif;
			 color: blue;
		   }
</style>
<script type="text/javascript" src="/js/maintainscroll.jquery.min.js"></script>
<script src="javascripts/sessionFunctions.js" type="text/javascript"> </script>
</head>

<!-- Created by Austin Edwards, Martin Talbot, Joel Schwabe,
	 Created on April 25th, 2014 -->
<body>


<!-- ------------------------------Header with Navigation Buttons----------------------------------- -->

	<header style="margin-top:-60px;">
		<h1> Coffee Beans </h1>
		<a href="Index.php">	  	<input style="left:13%;"   type="button" id="navigation" value="Home">			</a>
		<a href="AboutUs.php">	  	<input style="left:23%;"   type="button" id="navigation" value="About Us">		</a>
		<a href="coffeeBeans.php">	<input style="left:33%;"   type="button" id="navigation" value="Coffee Beans">		</a>
		<a href="coffeeProducts.php">	<input style="right:33%;"  type="button" id="navigation" value="Coffee Products">	</a>
		<a href="checkout.php">	 	<input style="right:21%;"  type="button" id="navigation" value="Checkout">		</a>
						<input style="right:5%;"   type="button" id="navigation" value="View Shopping Cart" onclick="showShoppingCart()" ></a>		
	
<!-- ------------------------Session Login/Logout Text + Login Verification------------------------- -->

	<div id="cookiesplash"> 
	<p>
	<?php checkLogin($LinkID); ?>
	</p>
	</div>

<!-- ----------------------------Login/Logout/New Customer Buttons---------------------------------- -->

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
	
<!-- ----------------------------New Customer Initialization Div------------------------------------ -->

	<div id="logindisplay">
	</div>

<!-- --------------------------Div For Showing Shopping Cart Contents------------------------------- -->

	<div id="shoppingCartDisplay">
	</div>

	</header>                                  

<!-- ----------------------------Left and Right Box Margins----------------------------------------- -->

<div id="leftbox">
</div>

<div id="rightbox">
</div>
  
<div id="container">

<!-- Grab product info from database and display -->

<div id="content" style="margin-top:60px;">
<?php
	
	// Display the results
	$type = 'products';
    productDisplay(fetchProducts("products"), $type);
		
?>
<div id=addToCartDisplay> 

<?php
	if(isset($_SESSION['custID']))
		$custID=$_SESSION['custID'];
	else
		$_SESSION['custID']="";

	if (!$LinkID) {
		die('Could not connect: ' . mysql_error());
	}
	//As long as something was sent via POST then...:
	if ( !empty($_POST) ){
		//Set post variables
		$prodID = $_POST['productID'];
		$tempQuantity = $_POST['quantity'];
		//cast the string from POST into an integer
		$quantity = (int)$tempQuantity;

	if($quantity > 0){

		//get product name
		$getName = 'SELECT ProductName From Products WHERE ProductID ='.$prodID.';';
		mysql_select_db("c199grp10", $LinkID);
		$resultOfName = mysql_query( $getName ,$LinkID);
		$valueName=mysql_fetch_row($resultOfName);
		if($valueName){
			foreach ($valueName as $v) {
				$productName = $v;
			}
		}
		
		
		//get product price
		$getName = 'SELECT ProductPrice From Products WHERE ProductID ='.$prodID.';';
		mysql_select_db("c199grp10", $LinkID);
		$resultOfPrice = mysql_query( $getName ,$LinkID);
		$valuePrice=mysql_fetch_row($resultOfPrice);
		if($valuePrice){
			foreach ($valuePrice as $v) {
				$productPrice = $v;
			}
		}
		
		
		//get product quantity from Products Table
		$getNum = 'SELECT ProductQuantity From Products WHERE ProductID ='.$prodID.';';
		mysql_select_db("c199grp10", $LinkID);
		$resultOfNum = mysql_query( $getNum ,$LinkID);
		$valueNum=mysql_fetch_row($resultOfNum);
		if($valueNum){
			foreach ($valueNum as $v) {
				$productNum = $v;
			}
		}
		//check if the amount in stock is greater or equal to the amount asked for
		if($productNum >= $quantity){
			$oldQuantity = 0;
			//ensure that the same product isn't being ordered
			$checkForDuplicate = 'SELECT Quantity_Purchased_Temp FROM TempCart WHERE Customers_CustID_Temp='.$custID.' and Products_ProductID_Temp ='.$prodID.';';
			mysql_select_db("c199grp10", $LinkID);
			$resultOfDupe = mysql_query( $checkForDuplicate ,$LinkID);
			$valueDupe=@mysql_fetch_row($resultOfDupe);
			//HERE!
			if($valueDupe){
				//will use if it's a dupe to change the amount removed from the products table
				foreach ($valueDupe as $x) {
					$oldQuantity = $x;
				}
			}
			//echo "OldQuantity:".$oldQuantity;
			
			//Remove any rows with empty quantity entries
			$removeEmptyRows = 'DELETE FROM TempCart WHERE Quantity_Purchased_Temp=0;';
			mysql_select_db("c199grp10", $LinkID);
			$resultOfRemove = mysql_query($removeEmptyRows ,$LinkID);
			
			//if the same product is being ordered, we will replace the order with a new order
			if($oldQuantity != 0){
				$changeQuantity = 'update TempCart set Quantity_Purchased_Temp='.$quantity.' Where Products_ProductID_Temp ='.$prodID.';';
				mysql_select_db("c199grp10", $LinkID);
				$resultQuantityChange = mysql_query($changeQuantity ,$LinkID);
				echo 'Updated '.$quantity. ' ' .$productName.' in cart.';
			}
			//it's a new entry, insert onto the tempcart
			else{
				$insert = 'INSERT INTO TempCart (Products_ProductID_Temp,ProductName_Temp,ProductPrice_Temp,Quantity_Purchased_Temp,Customers_CustID_Temp) VALUES ('.$prodID.',"'.$productName.'",'.$productPrice.','.$quantity.','.$custID.');';
				mysql_select_db("c199grp10", $LinkID);
				$resultInsert = mysql_query($insert ,$LinkID);

				if($resultInsert){
					echo 'Added '.$quantity. ' ' .$productName.' to cart.';
				}
				else{
					echo 'Failed to add item.';
				}	
			}
			//update the Product table with new quantities
			$update = 'update Products set ProductQuantity=(ProductQuantity-'.($quantity - $oldQuantity).') Where ProductID ='.$prodID.';';
			mysql_select_db("c199grp10", $LinkID);
			$resultUpdate = mysql_query($update ,$LinkID);
			

		}
		else{
			echo 'Not enough items in stock.';
		}
	}
	else{
		echo 'Enter a quantity';
	}	
	}
?>

                                  
<!-- Reference external javascript -->

</div>
</div>
<script type="text/javascript" src="/js/maintainscroll.jquery.min.js"></script>
</body>
</html>
