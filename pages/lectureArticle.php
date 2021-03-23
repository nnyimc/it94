<?php
  include('../includes/_inclEntete-article.php'); 
  
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

  
       #Afficher l'article complet
	   echo  "<div id='article_auto'>";
	   $sql13 = "SELECT * FROM ARTICLE where idArt = $id;";
	   $req13 = mysqli_query($co, $sql13);
		   
		   #Affichage titre et chapeau
		   if($ligne13 = mysqli_fetch_assoc($req13)){
			  $titreUrl = htmlentities($ligne13['titre']); 
			  
			  $titreArticle = htmlentities($ligne13['titre']);
			  $chapeauArticle = htmlentities($ligne13['chapeau']);
			  echo "<h1><a href='lectureArticle.php?idArt=" . $id . "'>".$ligne13['titre']."</a></h1>";
			  echo "<h2>". $chapeauArticle . "</h2>";
		   }
		   
            #Affichage photo
			$sql14 = "SELECT * FROM PHOTO where idPht = $id;";
	        $req14 = mysqli_query($co, $sql14);
			if ($ligne14 = mysqli_fetch_assoc($req14)){
			   $urlPhoto = htmlentities($ligne14['nom']);
			  echo "<img src='../uploads/" . $urlPhoto . "'/>";
			}
			
			#Affichage paragraphes
			$sql15 = "SELECT * FROM composition WHERE idaut = $id;";
			$req15 =  mysqli_query($co, $sql15);
            
			$prg = '';
            $parags	= ''; 
			
			
				if ($ligne15 = mysqli_fetch_assoc($req15)){
				  $parags = array( str_replace("'","\'",$ligne15['parag1']), str_replace("'","\'",$ligne15['parag2']), str_replace("'","\'",$ligne15['parag3']), str_replace("'","\'",$ligne15['parag4']));
				  
				  if ($parags != ''){
					$prg = '';
                    					
				    $nombreParags = count($parags);
				    $tabParag = array();		  
					  for($prg = 0; $prg < $nombreParags; $prg++){
					    $tabParag[] .= htmlentities($parags[$prg]);
						echo "<p>". $tabParag[$prg] . "</p>";
					  }
				  }
				}
		    
			#Affichage des mots clés
			$sql16 = "SELECT * FROM article WHERE idart = $id;";
			$req16 =  mysqli_query($co, $sql16);
			
			if ($ligne16 = mysqli_fetch_assoc($req16)){
				$motsCles =  explode(" ", $ligne16['motsCles']);
				$nombreMots = count($motsCles);
				echo "<span> mots-clés: </span>";
				for($c = 0; $c < $nombreMots ; $c++){
					echo "<span> <a href='lectureArticle.php?idArt=" . $id . "'>". $motsCles[$c] ." </a></span>"; 			
				}
			}
			
			#Affichage de l'auteur
			$sql17 = "SELECT * FROM auteur WHERE idaut = $id;";
			$req17 =  mysqli_query($co, $sql17);
			if ($ligne17 = mysqli_fetch_assoc($req17)){
				$auteur =  $ligne17['nom'];
				echo "<p> auteur: " . $auteur . "</p>";
			}
			
			
			
  
  include('../includes/_inclPied-article.php'); 			
?>