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

<!-- --------------------------------Coffee Shop Description----------------------------------------- -->

<div style = "margin-top:35px; color:white; margin-left:775px; width:500px; position:fixed;">
Caffe Fantastico is a local family business owned and operated by Ryan and Kristy Taylor. It all began in 1993 when Ryan opened Espresso Fantastico, a small coffee cart in Victoria's Inner Harbour. From day one the business was driven by the pursuit of quality and the love of coffee.
In 1995 Ryan began roasting the Causeway Fantastico our signature blend which to this day is our top selling coffee and used in all of our espresso bars. Our beloved roastery location was humbly opened in 1998 with Ryan roasting new single origin coffees and brewing these amazing coffee's to the Specialty Coffee Association's Golden Cup standards.
It was at the roastery that he met Kristy and they fell in love over one particular latte with a lovely heart poured on top. Together Ryan and Kristy began to expand Caffe Fantastico to new locations around Victoria. The Espresso Fantastico coffee cart was sold to friends and the Cook Street Village Coffee Kiosk was developed in 2001. The beautiful sustainable location at Dockside Green became available in 2007 and a great relationship was formed with our neighboring bakery Fol Epi. 2011 was an exciting year where Ryan and Kristy were able to bring there love of espresso wine and ale together in Tre Fantastico at the hotel Parkside Victoria. Each store has been developed and grown to contribute to the Victoria neighbourhoods where they are located. Although our staff now number over 35, we are still a close knit family.
Sustainability and the environment are very close to the hearts of Ryan and Kristy with all coffee grounds composted and all plastics recycled since day one. Having a successful business with ethical practices is key the Caffe Fantastico family.
</div>

<!-- --------------------------------Google Maps Location-------------------------------------------- -->

<div id="mapDiv" style="margin-top:60px; color:white;">
Our Location:
<br>
<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5294.108087177264!2d-123.35451087933919!3d48.43630253055898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x548f74919ef647ad%3A0x601f97029bb29493!2sCaffe+Fantastico!5e0!3m2!1sen!2sca!4v1399316605524"</iframe><br /><small><a href="https://www.google.ca/maps/place/Caffe+Fantastico/@48.43742,-123.359033,17z/data=!3m1!4b1!4m2!3m1!1s0x548f74919ef647ad:0x601f97029bb29493" style="color:#0000FF;text-align:left">View Larger Map</a></small> 
</div>


                               
<!-- Reference external javascript -->

<script src="javascripts/sessionFunctions.js" type="text/javascript"> </script>

</body>
</html>
