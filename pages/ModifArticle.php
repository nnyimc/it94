<?php
  session_start();
  #Affichage du formulaire de modification
  #Envoi des données vers modif.php
   
  include("../includes/inclEntete-auth.php");
  
	  #Bandeau 
	  echo "<div id='header'>
			 <div id='bandeau'>
			   <a href='../html/auth.html' class='lienlogo'><img id='logo' src='../images/insert-tech94.png' width='200pt' height='67pt' alt='Insert-Tech 94'/></a>
			   <p id='membres'>Administration | Gestion</p>
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
  
	  #Formulaire de modification
	   #Titre et chapeau
	   $sql1 = "SELECT * FROM ARTICLE where idArt = $id;";
	   $req1 = mysqli_query($co, $sql1);
	 

		 if($ligne1 = mysqli_fetch_assoc($req1)){
		   echo" 
				<form id='compo' action='../pages/modif.php' method='POST' enctype='multipart/form-data' style='margin-top: 8%; background-color: purple'>
				  
				  <h1 style='text-align:center'>Modification d'article</h1>
				  
				  <p><label for='titre'>Titre</label></p>";
		   echo" 	  <input type='text' id='titre' name='titre' size='50' value='" .$ligne1['titre'] ."'/>";
		   
		   
		   echo"  <p><label for='chapeau'>Chapeau</label></p>
				  <textarea rows='4' cols='40' id='chapeau' name='chapeau'>" . $ligne1['chapeau']. "</textarea>";
		 
		 }
		 
		#Photo
		echo "<p><label for='photo'> Photo </label></p>
			  <input type='file' id='photo' name='photo' />";
	 
	 
		#Paragraphes
		$sql2 = "SELECT * FROM composition WHERE idaut = $id;";
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
					echo "<p><label for ='parag" . $label . "'> Paragraphe " . $label . "</label></p>";
					echo "<textarea  rows='25' cols='40' id='parag" . $label . "' name='parag" . $label . "'>";
					  echo $tabParag[$prg];
					echo "</textarea>";
				  }
				  echo "</div>";
			  }
			
			}
			
		#Mots clés
		  $sql3 = "SELECT * FROM article WHERE idart = $id;";
		  $req3 =  mysqli_query($co, $sql3);
			
		  if ($ligne3 = mysqli_fetch_assoc($req3)){
			$motsCles =  explode(" ", htmlentities($ligne3['motsCles']));
			$nombreMots = count($motsCles);
			echo "<p><label for ='motsCles'> Mots Clés </label></p>";
			echo "<textarea  rows='5' cols='30' id='motsCles' name='motsCles'>";
			
			for($c = 0; $c < $nombreMots ; $c++){
				echo $motsCles[$c]." "; 			
			}
			
			echo "</textarea>";
		  }	
			  
			  
		#Auteur
		  $sql4 = "SELECT * FROM auteur WHERE idaut = $id;";
		  $req4 =  mysqli_query($co, $sql4);
		  if ($ligne4 = mysqli_fetch_assoc($req4)){
			echo	"<p><label for='auteur'> Auteur </label></p>";
			echo "<input type ='text' id='auteur' name='auteur' value='".$ligne4['nom']."'/>";
		  }
		  
		 echo "<p><input type='submit' value='Modifier' id='modifSubmit' name='validation'/></p>";
		 
		 echo "</form>";
		
?>		  
