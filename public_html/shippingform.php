<!DOCTYPE html>
<html lang="en">
<head>

<title>
  Form results
</title>
<style type="text/css">

.formval { font-size:14px;
		   font-weight: 900;
		   font-family:Verdana, Arial, Helvetica, sans-serif;
           color: blue;
         }
</style>
</head>
<body>
  <h1>Form data entered by client</h1>

<?php
	include '../LinkID.php';
	if (!$LinkID) {
		die('Could not connect: ' . mysql_error());
	}

session_start(); 
if(isset($_SESSION['custID']))
	$_SESSION['custID']=$_SESSION['custID'];
else
	$_SESSION['custID']="";
	/* In PHP the assignment operator is the equals sign.  */

	/* PHP variable names appear on the left of the equals sign */

	/* The $_REQUEST is one of the PHP predefined variables.

	    Through $_REQUEST the form information is passed more securely to the
               PHP script handler (like this one).

	     http://ca.php.net/manual/en/language.variables.predefined.php

               Other variables such as $_GET and $POST are no longer used because they
               cause the form information to appear in the URL to the PHP script.

           */
	/* The names appearing within the $_REQUEST[  ] are the
	      form element names. */

    /* The form element values are assigned to the PHP variables below.   */

    $firstname  = $_REQUEST[ 'firstname'  ];   /* text box   */
    $lastname   = $_REQUEST[ 'lastname'   ];   /* text box   */
    $phone      = $_REQUEST[ 'phone'     ];   /* radio        */
    $province     = $_REQUEST[ 'province'      ];   /* checkbox */
    $postalcode     = $_REQUEST[ 'postalcode'    ];   /* select       */
    $streetaddress     = $_REQUEST[ 'streetaddress'     ];
    $city      = $_REQUEST[ 'city'      ];
$custID=$_SESSION['custID'];


		mysql_select_db("c199grp10", $LinkID);
		$queryInsert = 'INSERT INTO AltShipping (CustID, FName, LName, Street, City, Prov, PCode, Phone) VALUES ("'.$custID.'","'.$firstname.'", "'.$lastname.'", "'.$streetaddress.'", "'.$city.'", "'.$province.'", "'.$postalcode.'", '.$phone.');';
		$resultInsert = mysql_query( $queryInsert ,$LinkID);
    		echo mysql_error($LinkID);
      

	  /*  PHP can include an e-mail function so that you may optionally email the form information. */

        //imap_mail("zz@shaw.ca", "Test Message", $outputString, "From:Ghostly");

?>
<p>Shipping address added</p>
 <a href="checkout.php">Return to the form</a>
</p>
</body>
</html>
