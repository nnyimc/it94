<?php
  function connexion(){
	#connexion au serveur MySQL
    $co = mysqli_connect("localhost", "root", "Feel2019") or 
      die("Erreur de connexion");
	
	#sélection de la bdd it94
    mysqli_select_db($co, "it94");
  return($co);
  }
?>