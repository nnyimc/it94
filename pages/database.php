<?php 
	//Vérification de la transmission du formulaire depuis index.html
	if(isset($_POST['submit'])){
	include("connexion_BDD_Contacts.php");
	include("table_contactInfos.php");
	}
?> 