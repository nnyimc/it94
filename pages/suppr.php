<?php
  session_start();
  #Affichage du formulaire de modification
  #Envoi des données vers modif.php
   
  include("../includes/inclEntete-auth.php");
  
	  #Bandeau 
	  echo "<div id='header'>
			 <div id='bandeau'>
			   <a href='../html/auth.html' class='lienlogo'><img id='logo' src='../images/insert-tech94.png' width='200pt' height='67pt' alt='Insert-Tech 94'/></a>
			   <p id='membres'>Administration | Suppression</p>
			 </div>
		  </div>"; 
	  
	  require('connexionServMySQL.php');
		$co = connexion();
	  
	  require('listerIdArticles.php');
		$listeIds = idArticles();   
		$totalIds = count($listeIds);
  
		#Récupérer l'id dans l'url et l'assigner à la variable $id
		  $url = $_SERVER['REQUEST_URI'];
		  $taburl = '';
		  $id = '';
		  $tabUrl = explode('=',$url);
		  $id = $tabUrl[1];
		  
		  
	
	 $motsCles= '';
	 
	 $sql1 = "SELECT * FROM article WHERE idArt=" . $id . ";";
	 $req1 = mysqli_query($co, $sql1);
	 if ($ligne1 = mysqli_fetch_assoc($req1)){
		 $motsCles = $ligne1['motsCles'];
	 }
	 

	 $sql2 = "DELETE FROM article WHERE idArt=" . $id . " AND motsCles ='" . $motsCles . "';";
	 $req2 = mysqli_query($co, $sql2);
	 
	 
     
	 
	
	 
	 echo "<p style='text-align:center; color:red; margin-top: 8em;'>Article supprimé.</p>";
	
	

    $_SESSION = array();
	session_destroy();
	mysqli_free_result($req1);
	
	
	header("Location: ../html/index.html?article=deleted");
    exit();
	 
?>