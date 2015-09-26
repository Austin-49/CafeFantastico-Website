<?php
session_start(); 
if(isset($_SESSION['custID']))
	$_SESSION['custID']=$_SESSION['custID'];
else
	$_SESSION['custID']="";

echo "<html><body>";
 include '../LinkID.php';
   if (!$LinkID) {
      die('Could not connect: ' . mysql_error());
   }
   
   $email  = $_REQUEST[ 'login'  ];
   $custID = "";
   
   $query = 'SELECT CustID FROM Customers WHERE Email LIKE "' . $email . '";';

   mysql_select_db("c199grp10", $LinkID);
   $result = mysql_query( $query ,$LinkID);
   
 	  $value=mysql_fetch_row($result);



   
   if($value){
		foreach ($value as $v) {
			$custID = $v;
		}
	echo "Login Successful!" . $_SESSION['custID'] ;
	
	// Emptys shopping cart upon login
	
	// Grabs data for product re-shelfing
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
   echo "Login Failed - Customer Not Found.";

   }
   echo mysql_error($LinkID);
   echo "</body></html>";
?>