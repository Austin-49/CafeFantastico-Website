<?php
// Controller module
require_once "model.php";
require_once "toXml.inc";

// Get data from view. 
$input = $_POST['input'];
// if (isset($_POST['input'])) {
	// $input = $_POST['input'];
// } else {
	// die('Nothing selected <br>
			// <a href="javascript:history.back()">Back</a>');
// }


//Set input to logical variables
$select = $input[0];
$from = $input[1];
$where = $input[2];
echo $where;

$wherePattern = '/\;|\-\-|\$/i';
// Check WHERE for possible malicious characters
if(preg_match($wherePattern, $where)){
	// Cancel query if found
	die('Improper WHERE field <br>
			<a href="javascript:history.back()">Back</a>' . mysql_error());
}

// Pattern of acceptable fields in the SELECT statement
//$selectPattern = '/\w(id|date|title|alary|name|mail|number|pct|address|code|ity|province)$/i';
$selectPattern = '/(id|date|\*|title|alary|name|mail|number|pct|address|code|ity|province)$/i';

// Check SELECT for proper fields
if(!preg_match($selectPattern, $select)){
	// Cancel query if not authorized input
	die('Improper SELECT field <br>
		<a href="javascript:history.back()">Back</a>' . mysql_error());
}

// Pattern of acceptable fields in the FROM statement
$fromPattern = '/^(job_history|jobs|departments|employees|locations|countries|regions)$/';
// Check FROM for proper fields

if(!preg_match($fromPattern, $from)){
	// Cancel query if not authorized input
	die('Improper FROM field <br>
		<a href="javascript:history.back()">Back</a>' . mysql_error());
}

// Pass it to the model
$things = sqlQuery($input[0], $input[1], $input[2]);

// Convert data from the model to xml
$xml = toXml($things);

// Output the xml to the view;
header('Content-Type: text/xml');
echo $xml;
?>
