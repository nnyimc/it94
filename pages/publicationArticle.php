<?php
#AFFICHAGE DES ARTICLES
    $co = connexion();
	$k = '';
	  
     #S'il y a des articles, afficher l'article le plus récent dans la div article_spotlight
	      if($totalIds > 0){
		    $indice = '';
            $indice = $totalIds - 1;	
			
		    echo  "<div id='articles'>";
			echo    "<div id='article_spotlight'>";	   
			
			#Affichage du titre et du chapeau 	 
			$sql9 = "SELECT * FROM article ORDER BY idart DESC LIMIT 1;";
			$req9 = mysqli_query($co, $sql9);
			if ($ligne9 = mysqli_fetch_assoc($req9)){
				$titre = str_replace(' ','',$ligne9['titre']);
				echo "<h1><a href='lectureArticle.php?idArt=" . $listeIds[0] . "'>".$ligne9['titre']."</a></h1>";
				echo "<h2>" . $ligne9['chapeau'] . "</h2>";
			}
			
			#Affichage de la photo
			$sql10 = "SELECT * FROM photo WHERE idpht = $listeIds[0];";
			$req10 = mysqli_query($co, $sql10);
			if ($ligne10 = mysqli_fetch_assoc($req10)){
				echo "<img src='../uploads/" . $ligne10['nom'] . "'/>";
			}
			
			#Affichage des paragraphes
			$sql11 = "SELECT * FROM composition WHERE idaut = $listeIds[0];";
			$req11 =  mysqli_query($co, $sql11);
			if ($ligne11 = mysqli_fetch_assoc($req11)){
				$parags = array($ligne11['parag1'],$ligne11['parag2'],$ligne11['parag3'],$ligne11['parag4']);
				
				  if ($parags != ""){
				   for($p = 0; $p < count($parags); $p++){
					echo "<p>" . $parags[$p] . "</p>";
				  }
				}
			}
			
			#Affichage de l'auteur
			$sql12 = "SELECT * FROM auteur WHERE idaut = $listeIds[0];";
			$req12 =  mysqli_query($co, $sql12);
			if ($ligne12 = mysqli_fetch_assoc($req12)){
				echo "<p> auteur: " . $ligne12['nom'] . "</p>";
			}
			
			#Affichage des mots clés
			$sql13 = "SELECT * FROM article WHERE idart = $listeIds[0];";
			$req13 =  mysqli_query($co, $sql13);
			
			if ($ligne13 = mysqli_fetch_assoc($req13)){
				$motsCles =  explode(" ", $ligne13['motsCles']);
				$nombreMots = count($motsCles);
				echo "<span> mots-clés: </span>";
				for($c = 0; $c < $nombreMots ; $c++){
					echo "<span> <a href='lectureArticle.php?idArt=" . $listeIds[0] . "'>". $motsCles[$c] ." </a></span>"; 			
				}
			}
			
		    echo     "</div>";
		 
			  #S'ils existent, afficher les 4 articles suivants dans la div article_4pack;		 
			  if($totalIds > 1){
						
				echo    "<div id='article_4pack'>";	
				
				#Paginer les résultats, en groupant les articles de la div article_4pack par lots de 4
          
			    $nombreArticlesParPage = '';
			    $nombreArticlesParPage = 4;
			    $nombreDePages = ceil($totalIds / $nombreArticlesParPage);
			   
				   #Définir la page courante et l'article de départ
				   if (!isset($_GET['page'])){
					 $page = 1;
				   } else {
					 $page = $_GET['page'];
				   }
				   
				   $articleDeDepart = ($page+(3*($page - 1))) ;
					
                   #Requête d'affichage des résultats
                   $sql14 = "SELECT article.idArt, titre, chapeau, nom FROM article, photo WHERE article.idArt = photo.idArt ORDER BY idArt DESC LIMIT " . $articleDeDepart . "," . $nombreArticlesParPage . " ;";
                   
                   $req14 = mysqli_query($co , $sql14);
				   while ($ligne14 = mysqli_fetch_assoc($req14)){
					echo "<h3><a href='lectureArticle.php?idArt=" . $ligne14['idArt'] . "'>".$ligne14['titre']."</a></h3>";
					echo "<h4>" . substr($ligne14['chapeau'], 0, 30) . "...</h4>";
					echo "<img src='../uploads/" . $ligne14['nom'] . "' style='width: 100%'/>";
				    }
				   
				   #Génération de liens pour chaque page
				   echo "Page(s): ";
				   for ($page = 1; $page <= $nombreDePages; $page++){
					 echo "<a href='articles.php?page=" . $page . "'> " . $page . " </a>";
				   }
						  
					echo  "</div>";
					echo  "</div>";
					
				  } 
				  
		  echo  "</div>";
		  echo  "</div>";
			
		  $req = array($req9, $req10, $req11, $req12, $req13);
		     for ($j = 0; $j < count($req); $j++){
			 mysqli_free_result($req[$j]);
		  } 
	    }		  
?>