<?php

require('descriptions.php');


// Login function
function checkLogin($LinkID) {
	if($_SESSION['custID'] > 0){
		//$_SESSION['custID']=$_SESSION['custID'];
		$custName = "";
		$query = 'SELECT FName, LName FROM Customers WHERE CustID = ' . $_SESSION['custID'] . ';';
		mysql_select_db("c199grp10", $LinkID);
		$result = mysql_query( $query ,$LinkID);
		$value4=mysql_fetch_row($result);
		foreach ($value4 as $v) {
			$custName .= ($v." ") ;
		}
		echo "Logged in as: " . $custName;
	}
	else{
		$_SESSION['custID']="";  	
		@$email  = $_REQUEST[ 'login'  ];
		@$password = $_REQUEST[ 'password' ];
		//$getHash = 'SELECT Hash FROM Customers WHERE Email LIKE "' . $email . '";';
		//mysql_select_db("c199grp10", $LinkID);
		//$result = mysql_query( $getHash ,$LinkID);
		//$returnedHash=mysql_fetch_row($result);
		//foreach ($returnedHash as $h) {
		//		$hash = $h;
		//		}
		//$validPass = password_verify($password, $hash);
		//$validPass = true;
		$custID = "";	

	
		//if($validPass){

		$query = 'SELECT CustID FROM Customers WHERE Email LIKE "' . $email . '" And Hash LIKE "'.$password.'";';
		mysql_select_db("c199grp10", $LinkID);
		$result = mysql_query( $query ,$LinkID);
		$value3=mysql_fetch_row($result);

			if($value3){
				foreach ($value3 as $v) {
				$custID = $v;
				}

				echo "Login Successful!";
				$_SESSION['custID']=$custID;
				echo "<br>";

				if(isset($_SESSION['custID'])){
					$custName = "";
					$query = 'SELECT FName, LName FROM Customers WHERE CustID = ' . $_SESSION['custID'] . ';';
					mysql_select_db("c199grp10", $LinkID);
					$result = mysql_query( $query ,$LinkID);
					$value=mysql_fetch_row($result);
						foreach ($value as $v) {
						$custName .= ($v." ") ;
					}
					echo "Logged in as: " . $custName;
				}

				else{
					echo "Please login.";
					
				}
			}

			else{
				echo "Please login.";
			}
		//}
		//else{
		//	echo "Invalid password.";
		//}
	}
}


// Product display from database query
/*function productDisplay($results){
	$count = 1;
	while ($x=mysql_fetch_row($results)){
		if(($count + 2) % 2 == 1){
			print '<div id="productBoxLeft">';
		}else{
			print '<div id="productBoxRight">';
		}
		print "<br>";
		print "Name: ".$x[1]."<br>";
		print "Price: ".$x[3]."<br>";
		print "Description: ".matchDesc($x[1])."<br>";
		//Add "Add to Cart" buttons to each product, set the id of each button to the product id
		echo  '<button type="button" id="'.$x[0].'"> Add To Cart </button>';
		print "<br></div><br>";
		$count += 1;
	}
}*/


function productDisplay($results, $type){
	while ($x=mysql_fetch_row($results)){
		print '<div id="grid" >';
		print "<br>";
		print "Name: ".$x[1]."<br>";
		print "Price: ".$x[3]."<br>";
		print "Description: ".matchDesc($x[1])."<br>";
		$value = $x[0];
		
		//echo '<form id="addToCart">';
		if($type == 'beans'){
			echo '<form method="post" action="coffeeBeans.php">';
		}
		if($type == 'products'){
			echo '<form method="post" action="coffeeProducts.php">';
		}
		//(Works)echo '<button class="add_to_cart">Add To Cart</button>';
		echo '<input type="hidden" name="productID" id="productID" value="'.$value.'" />';
		echo 'Quantity:<input type="text" placeholder= "1-99"name="quantity" id="quantity" pattern="\d{1}|\d{2}"size="1" maxlength="2"/>';

		echo '<button class="add_to_cart" name="add" onclick="addToCart()">Add To Cart</button>';
		//echo '<button class="add_to_cart" name="add" onclick="addToCart2()">Add To Cart</button>';

		echo '</form>';	
		//Add "Add to Cart" buttons to each product, set the id of each button to the product id
		//echo  '<button type="button" id="add'.$value.'" name="add'.$value.'" value="'.$value.'" onclick="addToCart()" > Add To Cart </button>';
		//echo 'ProductID = ' . $x[0];
		print "<br></div>";
	}
}


// Query the database for products
function fetchProducts($type){
	// Connect to the MySQL server.
	require('../LinkID.php');
	// Die if no connect
	if (!$LinkID) {
		die('Could not connect: ' . mysql_error());
	}
	// Choose the DB and run a query.
	mysql_select_db("c199grp10", $LinkID);
	// Report error if encountered
	echo mysql_error($LinkID);
	
	if($type == "beans"){
		$postFields = "SELECT * FROM Products WHERE ProductType LIKE 'Beans';";
	}
	if($type == "products"){
		$postFields = "SELECT * FROM Products WHERE ProductType NOT LIKE 'Beans';";
	}
	$result1 = mysql_query($postFields ,$LinkID);
	return $result1;
}


function startSession() {
	session_start(); 
	if(isset($_SESSION['custID'])) 
		$_SESSION['custID']=$_SESSION['custID'];

	else
		$_SESSION['custID']="";
	
	if(isset($_SESSION['cart']))
		$_SESSION['cart']=$_SESSION['cart'];
	else
		$_SESSION['cart'] = array();
		
 	include '../LinkID.php';
  	if (!$LinkID) {
      		die('Could not connect: ' . mysql_error());
   	}

}


?>


