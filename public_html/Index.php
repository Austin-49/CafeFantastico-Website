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
</head>

<body>

<!-- Display Header bar with navigation buttons -->

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
</div>

<div id="rightbox">
</div>

<div style="margin-top:60px;">
<?php
    // Connect to the MySQL server.
    // Grab $LinkID with connection information from secure location
    require('../LinkID.php');
    // Die if no connect
    if (!$LinkID) {
      die('Could not connect: ' . mysql_error());
    }
    // Choose the DB and run a query.
    mysql_select_db("c199grp10", $LinkID);
	// Report error if encountered
	echo mysql_error($LinkID);
	
	$postFields = "SELECT * FROM Products;";
	$result1 = mysql_query($postFields ,$LinkID);
    
    // Display the results
    if ($result1) {      
		// Fetch a row with the column labels
		$x=mysql_fetch_assoc($result1);
		// Print the column labels
		print '<table border=1><tr bgcolor="#FFFFFF">';
		foreach (array_keys($x) as $k) {
			print "<td><b>$k</b></td>";
        }
        print '</tr><tr bgcolor="#FFFFFF">';
		// Print the values for the first row
		foreach ($x as $v) {
			print "<td>$v</td>";
        }
        print '</tr><tr bgcolor="#FFFFFF">';
		// Print the rest of the rows.
		while ($x=mysql_fetch_row($result1)) {
			foreach ($x as $v) {
				print "<td>$v</td>";
			}
			print '</tr><tr bgcolor="#FFFFFF">';
		}
    }

?>
</div>
<!-- Reference external javascript -->

<script src="javascripts/sessionFunctions.js" type="text/javascript"> </script>
</body>
</html>
