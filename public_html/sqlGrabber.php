<?php
session_start();
if(isset($_SESSION['views']))
$_SESSION['views']=$_SESSION['views']+1;
else
$_SESSION['views']=1;
echo "Views=". $_SESSION['views'];
?>
<!--
Lab #5 part 2 (php side)
lab5_2.php
Joel Schwabe 
schwabejr@gmail.com
Feb 7th 2014
Estimated Time to Complete: 5 Hours
Actual Time: 3 hours
This program shows a tables made from text send from lab5_2.html being converted into data from a SQL database
Nothing special needed besides a browser and a web connection however, if run from another server, LinkID.php must be placed 3 levels above this file with appropriate login info
-->
<html>
<head>
<title>Test MySQL for COMP199</title>
</head>
<body>
<?php

   // Connect to the MySQL server.
   include '../LinkID.php';
   // Die if no connect
   if (!$LinkID) {
      die('Could not connect: ' . mysql_error());
   }
   
   //put the form inputs into variables
   $preSelect = $_POST['select'];
   $preFrom = $_POST['from'];
   $preMaybeWhere = $_POST['where'];
   
   //use for denying suspicious inputs
   $pattern = '/(script)|(&lt;)|(&gt;)|(%3c)|(%3e)|(SELECT) |(UPDATE) |(INSERT) |(DELETE)|(GRANT) |(REVOKE)|(UNION)|(&amp;lt;)|(&amp;gt;)|(;)|/';
	$replace = "";
   
   //set up default strings
   $where = "";
   $whereString = ";";
   $ending = "";
   
   //set cleaned inputs  
   $select = preg_replace($pattern, $replace, $preSelect);
   $from = preg_replace($pattern, $replace, $preFrom);
   $maybeWhere = preg_replace($pattern, $replace, $preMaybeWhere);
   
   //If valid Where clause, reset string ending variables
   if($maybeWhere){
	$where = $maybeWhere;
	$whereString = " WHERE ";
	$ending = ";";
	}
	//Print out total statment
	print "SELECT " . $select .  " FROM " . $from . $whereString . $where . $ending;
   //set total statement to be valid SQL query
   $query = "SELECT " . $select .  " FROM " . $from . $whereString . $where . $ending; 
   
      // Choose the DB and run first query 1999.
   mysql_select_db("c199grp10", $LinkID);
   $result = mysql_query( $query ,$LinkID);
   echo mysql_error($LinkID);
   
     if ($result) {
		print "<p>";

     // Fetch a row with the column labels
      $x=mysql_fetch_assoc($result);
   // Print the column labels
      print "<table border=1><tr>";
      foreach (array_keys($x) as $k) {
         print "<td><b>$k</b></td>";
      }
      print "</tr><tr>";
    // Print the values for the first row
      foreach ($x as $v) {
         print "<td>$v</td>";
      }
      print "</tr><tr>";
    // Print the rest of the rows.
      while ($x=mysql_fetch_row($result)) {
         foreach ($x as $v) {
            print "<td>$v</td>";
         }
         print "</tr><tr>";
      }
	  print "</tr></table>";
   }
 	print "<br>";
	print "Pageviews=". $_SESSION['views'];
 ?>
 </body>
 </html>