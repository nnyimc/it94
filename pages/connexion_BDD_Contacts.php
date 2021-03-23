<?php
  //definition des variables
  $host = "localhost";
  $login = "root";
  $password = "";
  
  //connexion à MySQL
  //creation d'un objet co avec pour paramètres les variables définies précédemment
  $co = new mysqli($host, $login, $password);
   
  //verification du bon déroulement de la connexion
  if ($co->connect_error) {
	  die("Erreur de connexion: ". $co->connect_error);
    }
   
   
   //Création de la base de données SQL 
   $sql= "CREATE DATABASE IF NOT EXISTS Contacts"; 
   
   //Verification de la conformité de la base de données
  if ($co->query($sql) == TRUE){
     echo "<p>Nous vous confirmons la bonne prise en compte de votre sollicitation.</p>";
  } else {
	  echo "<p>Une erreur a été constatée lors de la transmission de votre demande.</p>" . $co->error;
	  
  }

  //Fermeture de la connexion
  $co->close();

?>