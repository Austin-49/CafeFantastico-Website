<!--
	Lab Number 5 Part 1
	SQL Search form
    Martin Talbot talbot063@hotmail.com
    8 Feb 2014
    Estimated time 10 hours
    Actual time taken 7 hours
    Submit simple SQL queries through a web form
 -->

<html><head><title>Test MySQL</title></head><body>
<?php
    // Connect to the MySQL server.
    // Grab $LinkID with connection information from secure location
    require('../../../COMP170/LinkID170.php');
    // Die if no connect
    if (!$LinkID) {
      die('Could not connect: ' . mysql_error());
    }
    // Choose the DB and run a query.
    mysql_select_db("comp170", $LinkID);
	// Report error if encountered
	echo mysql_error($LinkID);
    // Check the WHERE statement if empty and therefore false
	if($_POST['where'] == false){
		// Omit WHERE if empty
		$postFields = "SELECT ".$_POST['select']." FROM ".$_POST['from'].";";
		// If WHERE is not empty
		}else{
		// Include WHERE in the query
		$postFields = "SELECT ".$_POST['select']." FROM ".$_POST['from']." WHERE ".$_POST['where'].";";
		// Pattern of inappropriate characters in the WHERE statement
		$wherePattern = '/.(;|--|$|TRUNCATE|DROP|CASE WHEN|EXEC)$/i';
		// Check WHERE for possible malicious characters
		if(preg_match($wherePattern, $_POST['where'])){
			// Cancel query if found
			die('Improper WHERE field <br>
			<a href="javascript:history.back()">Back</a>' . mysql_error());
			}
		}
	// Pattern of acceptable fields in the SELECT statement
	$selectPattern = '/\w(id|date|title|alary|name|mail|number|pct|address|code|ity|province)$/i';
	// Check SELECT for proper fields
	if(!preg_match($selectPattern, $_POST['select'])){
		// Cancel query if not authorized input
		die('Improper SELECT field <br>
		<a href="javascript:history.back()">Back</a>' . mysql_error());
		}
	// Pattern of acceptable fields in the FROM statement
	$fromPattern = '/^(job_history|jobs|departments|employees|locations|countries|regions)$/';
	// Check FROM for proper fields
	if(!preg_match($fromPattern, $_POST['from'])){
		// Cancel query if not authorized input
		die('Improper FROM field <br>
		<a href="javascript:history.back()">Back</a>' . mysql_error());
		}
	// Print the query for user reference					
	echo $postFields;
    // Variable with validated query fields 
	$result1 = mysql_query($postFields ,$LinkID);
    
    // Display the results
    if ($result1) {      
		// Fetch a row with the column labels
		$x=mysql_fetch_assoc($result1);
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
		while ($x=mysql_fetch_row($result1)) {
			foreach ($x as $v) {
				print "<td>$v</td>";
			}
			print "</tr><tr>";
		}
    }
?>
	
</tr></table></body></html>