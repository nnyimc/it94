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
	      $_SESSION['id'] = $id;
  
	   #Titre et chapeau
	   $sql1 = "SELECT * FROM ARTICLE where idArt =" . $id . ";";
	   $req1 = mysqli_query($co, $sql1);
	 

		 if($ligne1 = mysqli_fetch_assoc($req1)){
		   echo" 
				<form id='compo' action='suppr.php?id=$id' method='POST' enctype='multipart/form-data' style='margin-top: 8%; background-color: darkred'>
				  
				  <h1 style='text-align:center'>Suppression d'article</h1>";
				  
				  
		   echo"	  <h2>" . $ligne1['titre'] . "</h2>";
		   
		   
		   echo"  <h3>" . $ligne1['chapeau']. "</h3>";
		 
		 }
		 
		#Photo
		$sql2 = "SELECT * FROM photo WHERE idPht =". $id .";";
		$req2 =  mysqli_query($co, $sql2);
		if ($ligne2 = mysqli_fetch_assoc($req2)){
		echo" <img style='width:100%' src='../uploads/" . $ligne2['nom'] . "'/>";
		}
	 
		#Paragraphes
		$sql2 = "SELECT * FROM composition WHERE idaut =" . $id . ";";
		$req2 =  mysqli_query($co, $sql2);
		
		$prg = '';
		$parags	= ''; 
		
		
			if ($ligne2 = mysqli_fetch_assoc($req2)){
			  $parags = array($ligne2['parag1'], $ligne2['parag2'], $ligne2['parag3'], $ligne2['parag4']);
			  
			  if ($parags != ''){			
				$nombreParags = count($parags);
				$tabParag = array();
				
				  echo "<div id ='modifParag'>";			
				  for($prg =0; $prg < $nombreParags; $prg++){
					$label= $prg+1;  
					$tabParag[] .= $parags[$prg];
					echo "<p>";
					
					  echo $tabParag[$prg];
					  
					echo "</p>";
				  }
				  echo "</div>";
			  }
			
			}
			
		#Mots clés
		  $sql3 = "SELECT * FROM article WHERE idart =". $id . ";";
		  $req3 =  mysqli_query($co, $sql3);
			
		  if ($ligne3 = mysqli_fetch_assoc($req3)){
			$motsCles =  explode(" ", htmlentities($ligne3['motsCles']));
			$nombreMots = count($motsCles);
			
			for($c = 0; $c < $nombreMots ; $c++){
				echo $motsCles[$c]." "; 			
			}
			
			
		  }	
			  
			  
		#Auteur
		  $sql4 = "SELECT * FROM auteur WHERE idaut =" . $id . ";";
		  $req4 =  mysqli_query($co, $sql4);
		  if ($ligne4 = mysqli_fetch_assoc($req4)){
			  
			echo "<p>" .$ligne4['nom']. "</p>";
		  }
		  
		 echo "<p><input type='submit' value='Supprimer' id='modifSubmit' name='validation'/></p>";
		 
		 echo "</form>";
		
?>		  
