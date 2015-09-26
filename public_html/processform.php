<!DOCTYPE html>
<html lang="en">
<head>

<title>
  New Customer Info
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

   // Connect to the MySQL server.
   include '../LinkID.php';
   // Die if no connect
   if (!$LinkID) {
      die('Could not connect: ' . mysql_error());
   }
   
date_default_timezone_set('America/Vancouver');

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
	$streetNum = $_REQUEST[ 'streetNum'  ];
	$streetName = $_REQUEST[ 'streetName'  ];
	$city = $_REQUEST[ 'city'  ];
	$province = $_REQUEST[ 'province'  ];
	$postal = $_REQUEST[ 'postal'  ];
    $phone      = $_REQUEST[ 'phone'     ];   /* radio        */
	$email  = $_REQUEST[ 'email'  ];
	$password  = $_REQUEST[ 'password'  ];
	

	/* Information for using dates in PHP is at  http://ca3.php.net/date   */
	$date = date('D j M Y G:i');
   
   
    /* Check if the $firstname was not entered on the form.  Note that \" is a way of providing double quotes
	    inside double quotes.
          */
      if ( empty($email) or empty($password) ) {

  	     echo "<p><strong>You didn't enter an email/password." .
              "<br />" .
              "Please <a href=\"http://deepblue.cs.camosun.bc.ca/~comp19910/Index.php\">go back</a> and re-enter your info." .
              "</strong></p></body></html>";
         exit;
      }
	

	
	//$hash = password_hash($password, PASSWORD_DEFAULT);
     

      echo "The current time and date is " . date("H:i, jS F");

	  echo "<br />";

    echo "First name is <span class=\"formval\">" . $firstname  . "</span><br />";

	echo "Last name is <span class=\"formval\">"  . $lastname   . "</span><br />";
	
	echo "Street Address is <span class=\"formval\">"  . $streetNum . " "   . $streetName . "</span><br />";
	
	echo "City is <span class=\"formval\">"  . $city   . "</span><br />";
	
	echo "Province is <span class=\"formval\">"  . $province   . "</span><br />";
	
	echo "Postal Code is <span class=\"formval\">"  . $postal   . "</span><br />";

    echo "phone is <span class=\"formval\">" . $phone . "</span><br />";
	
	echo "Email is <span class=\"formval\">"  . $email   . "</span><br />";
	echo "Password is <span class=\"formval\">"  . $password   . "</span><br />";

	mysql_select_db("c199grp10", $LinkID);
	$queryCheckEmail = 'SELECT CustID FROM Customers WHERE Email LIKE "' . $email . '";';
	$resultCheckEmail = mysql_query( $queryCheckEmail ,$LinkID);
	$taken=mysql_fetch_row($resultCheckEmail);
	
	if(!$taken){
		echo "<p>Customer Added!<br />";
		$queryInsert = 'INSERT INTO Customers (FName, LName, StreetNum, StreetName, City, Prov, PCode, Phone, Email, Hash) VALUES ("'.$firstname.'", "'.$lastname.'", '.$streetNum.', "'.$streetName.'", "'.$city.'", "'.$province.'", "'.$postal.'", '.$phone.', "'.$email.'", "'.$password.'");';
		$resultInsert = mysql_query( $queryInsert ,$LinkID);
    }
	else{
		 echo "<p>Email already taken!<br />";
		 echo "<p>Customer Not Added. Please Login.<br />";
	}
    echo mysql_error($LinkID);
   
   


?>
<p>
 <a href="http://deepblue.cs.camosun.bc.ca/~comp19910/Index.php">Login!</a>
</p>
</body>
</html>