<?php
function matchDesc($prodName){
	// coffees
	if($prodName=="Causeway Fantastico"){
		return "Our house espresso. Rich, complex and balanced. Chocolate and caramel along with warm nut and buttery elements. Complimented by hints of dried fruit and spice.";
	}elseif($prodName=="Decaf Fantastico"){
		return "Full, rich and sweet. Caramel, warm nuttiness. Suitable for all brewing methods.";
	}elseif($prodName=="Ethiopia Kaffa Forest"){
		return "As close to the source as you can get! Dark chocolate, molasses,exotic spices with a hint of stone fruit and jasmine scented coffee flower. Vibrant citrus acidity.";
	}elseif($prodName=="Sumatra Mandheling"){
		return "Intrigue, depth and character. Cocoa and earthy elements with undertones of dried plum and date.";
	}elseif($prodName=="Colombia San Agustin"){
		return "Richly and roundly tart. The taste of fresh coffee fruit (think tart cherry) and pungent grapefruit dominate in aroma and cup, with softening suggestions of cocoa, almond and caramel. Sweet-toned acidity; lightly syrupy mouthfeel. Dry, resonant finish.";
	}elseif($prodName=="Guatemala Finca Jauja"){
		return "This coffee is elegant, sweet-toned and balanced. Toffee, chocolate and raisin notes dominate over hints of sweet spice. The body is very full and richly textured with a well integrated acidity. A smooth butteriness and subtle spice tones linger on the finish.";
	}elseif($prodName=="Guatemala Carrizal"){
		return "Approachable and easy drinking. Round and full textured, soft acidity, chocolate, praline, caramel with subtle dried fruit. Long and rich lingering finish.";
	}elseif($prodName=="Guatemala San Agustin"){
		return "Nougat and subtle floral aromas between honeysuckle and orange blossom. Bright, well structured acidity, balanced by a full buttery mouth feel, a subtle red current note and wrapped in a caramel sweetness. It evolves from crisp and lively to lush and juicy.";
	}elseif($prodName=="Mexico Malinal Nayarita"){
		return "Full bodied and smooth. Dark chocolate and spicy, with a brown sugar sweetness and a hint of smokiness.";
	}elseif($prodName=="Sun-Dried Malinal"){
		return "Fruit forward sweet jammy strawberry/cherry notes, subtle spice and custard undertones.";
	}elseif($prodName=="Espresso Malinal"){
		return "Sweet, full bodied and balanced, with bittersweet chocolate and toffee notes laced with rich dried-fruit undertones.";
	}elseif($prodName=="Sulawesi Toraja"){
		return "Another fantastic Indonesia coffee is back. Syrupy, rich, super smooth with just a slight Vienna Roast. Full, full bodied, clean flavor. This coffee is a huge favorite.";
	// accessories 
	}elseif($prodName=="Bodum Press 'Chambord 8 Cup'"){
		return "Glass thing with the plunger.";
	}else{
		return "";
		}
		}
?>