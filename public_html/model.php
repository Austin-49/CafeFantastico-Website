<?php

function getCoffeeDB(){
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
	
	$postFields = "SELECT * FROM Products WHERE ProductType NOT LIKE 'Beans';";
	$result1 = mysql_query($postFields ,$LinkID);
}
	
	
?>