<?php
  if(isset($_POST['submit'])){
    require("co.php");
	
	#Création de la base de données Contacts
	$co = connexion();
	$sql1 = "CREATE DATABASE IF NOT EXISTS it94;";
	$req1 = mysqli_query($co, $sql1) or
	  die("Erreur lors de la création de la base de données");
	  
	  if ($req1 != TRUE) {
		echo "Echec lors de la transmission de vos coordonées";
      } else {
          $sql2 = "USE it94;";
          $req2 = mysqli_query($co, $sql2) or
		    die ("Erreur lors de la sélection de la base de données.");		  
		  echo "<p>Nous vous confirmons la bonne prise en compte de votre demande.<p>"; 
	require("remplirContacts.php");
	mysqli_close($co);
	$test = remplirContacts();
	}
  }
?>