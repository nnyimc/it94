window.onload = function() {
	imageCouv();
}

function imageCouv() { 
	var images = ["../images/couverturea_300.jpg", "../images/couvertureb_300.jpg", "../images/couverturec_300.jpg"];
	document.getElementById("illustration").src = images[Math.floor(Math.random()*images.length)];
}