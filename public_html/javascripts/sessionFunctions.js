setTimeout(function(){timeOut()}, 60000 * 240); 

function login() {
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
	// Internet Explorer of several flavors
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// or nothing works.  Punt.
				alert("Your browser does not support AJAX!");
			return false;
		}
	}
}
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==4) {
			document.getElementById("cookiesplash").innerHTML=xmlHttp.responseText;
		}
	}
	
	var fileName = "checkLogin.php";

	
	//different variables set
	var selectEmail = document.getElementById('login').value;
	var nameEmail =  document.getElementById('login').name;
	selectEmail = escape(selectEmail);

  
	// Open the connection and create the URL as a get. 
	xmlHttp.open("POST", "checkLogin.php?" + nameEmail+'='+selectEmail, true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send(null);

}

function addToCart(){
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
	// Internet Explorer of several flavors
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// or nothing works.  Punt.
				alert("Your browser does not support AJAX!");
			return false;
			}
		}
	}
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==4) {
			document.getElementById("shoppingCartDisplay").innerHTML=xmlHttp.responseText;
		}
	}

	document.getElementById("addToCart").submit();
	
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send(null);

}

function removeFromCart(productID){
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
	// Internet Explorer of several flavors
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// or nothing works.  Punt.
				alert("Your browser does not support AJAX!");
			return false;
			}
		}
	}
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==4) {
			document.getElementById("shoppingCartDisplay").innerHTML=xmlHttp.responseText;
		}
	}

	
	xmlHttp.open("GET", "removeFromCart.php?productID=" + productID , true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send(null);

}

function removeFromCart2(productID){
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
	// Internet Explorer of several flavors
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// or nothing works.  Punt.
				alert("Your browser does not support AJAX!");
			return false;
			}
		}
	}

	
	xmlHttp.open("GET", "checkout.php?productID=" + productID , true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send();

	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==4) {
			document.getElementById("container").innerHTML=xmlHttp.responseText;
		}
	}



}


function emptyCart(){
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
	// Internet Explorer of several flavors
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// or nothing works.  Punt.
				alert("Your browser does not support AJAX!");
			return false;
			}
		}
	}
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==4) {
			document.getElementById("shoppingCartDisplay").innerHTML=xmlHttp.responseText;
		}
	}
	
	
	xmlHttp.open("GET", "emptyCart.php", true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send(null);


}

function emptyCart2(abandon){
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
	// Internet Explorer of several flavors
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// or nothing works.  Punt.
				alert("Your browser does not support AJAX!");
			return false;
			}
		}
	}
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==4) {
			document.getElementById("container").innerHTML=xmlHttp.responseText;
		}
	}
	
	
	xmlHttp.open("GET", "checkout.php?abandon=" + abandon, true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send();


}


function newCustomer() {
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
	// Internet Explorer of several flavors
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// or nothing works.  Punt.
				alert("Your browser does not support AJAX!");
			return false;
		}
	}
}
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==4) {
			document.getElementById("logindisplay").innerHTML=xmlHttp.responseText;
		}
	}
	
	// Open the connection and create the URL as a get. 
	xmlHttp.open("GET", "newCustomer.html", true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send(null);

}

function showShoppingCart() {
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
	// Internet Explorer of several flavors
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// or nothing works.  Punt.
				alert("Your browser does not support AJAX!");
			return false;
			}
		}
	}
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==4) {
			document.getElementById("shoppingCartDisplay").innerHTML=xmlHttp.responseText;
		}
	}
	
	// Open the connection and create the URL as a get. 
	xmlHttp.open("GET", "shoppingCart.php", true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send(null);

}



function removeCart() {
	
	// Remove the div
	var elem = document.getElementById("shoppingCartDisplay");
	elem.parentNode.removeChild(elem);

	//Recreate the div
	var element = document.createElement('div');
	element.id = "shoppingCartDisplay";
	document.body.appendChild(element);
}

function removeForm() {
	
	// Remove the div
	var elem = document.getElementById("logindisplay");
	elem.parentNode.removeChild(elem);

	//Recreate the div
	var element = document.createElement('div');
	element.id = "logindisplay";
	document.body.appendChild(element);
}

function logout() {
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
	// Internet Explorer of several flavors
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// or nothing works.  Punt.
				alert("Your browser does not support AJAX!");
			return false;
		}
	}
}
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==4) {
			document.getElementById("cookiesplash").innerHTML=xmlHttp.responseText;
		}
	}
	
	// Open the connection and create the URL as a get. 
	xmlHttp.open("GET", "logout.php", true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send(null);

}

function timeOut() {
	var xmlHttp;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	} catch (e) {
	// Internet Explorer of several flavors
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// or nothing works.  Punt.
				alert("Your browser does not support AJAX!");
			return false;
			}
		}
	}
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState==4) {
			document.getElementById("shoppingCartDisplay").innerHTML=xmlHttp.responseText;
		}
	}
	
	// Open the connection and create the URL as a get. 
	xmlHttp.open("GET", "timeOut.php", true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send(null);

}