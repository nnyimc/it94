<?php
  require('connexionServMySQL.php');
	$co = connexion();
	
    #Paginer les résultats, en groupant les articles de la div article_8pack par lots de 8
	require('listerIdArticles.php');
		  $listeIds = idArticles();   
		  $totalIds = count($listeIds);
	
	#Définir la page courante et l'article de départ
	   if (!isset($_GET['page'])){
		 $page = 1;
	   } else {
		 $page = $_GET['page'];
	   }
	   
		$nombreArticlesParPage = '';
		$nombreArticlesParPage = 8;
		$nombreDePages = ceil($totalIds / $nombreArticlesParPage);
		$articleDeDepart = ($page - 1) * $nombreArticlesParPage;
		
	$sql = "SELECT article.idArt, titre, chapeau, nom FROM article, photo WHERE article.idArt = photo.idArt ORDER BY idArt DESC LIMIT " . $articleDeDepart . "," . $nombreArticlesParPage . ";";
	$req = mysqli_query($co, $sql);
	$tabId = array();
	 
	 echo    "<div id='articles_8pack'>";	
		   
	   while($ligne = mysqli_fetch_assoc($req)){
		 $idArt = $ligne['idArt'];
		 
		 echo "<div id='$idArt' style='border: 1pt solid teal; width: 18.5%; float: left; margin: 1.5% 3% 0 3%;'  >";		 
		   echo "<p>". substr($ligne['titre'], 0, 15) . "</p>";
		   echo "<p>". substr($ligne['chapeau'], 0, 25) . "...</p>";
		   echo "<img src='../uploads/" . $ligne['nom'] . "' style='height: 10%; padding: 15% 20%'/>";
		
		   #bouton Modifier
		   echo "<a href='auth.php?action=modifArt$idArt'><button>Modifier</button></a>";
	 
		   #bouton Supprimer
		   echo "<a href='auth.php?action=supprArt$idArt'><button>Supprimer</button></a>";
		   
		 echo "</div>";
		}
		
		 #Génération de liens pour chaque page
		 echo "<div id='pagination' style='float:left; clear: both; margin: 1% 3%'>";
		   echo "Page(s): ";
		   
		   for ($page = 1; $page <= $nombreDePages; $page++){
		     echo "<a href='auth.php?page=" . $page . "'> " . $page . " </a>";
		   }
		 echo "</div>"; 
				   
			    }
			  } 
			}				
			
	   # Si la requête provient de compo.php, afficher le formulaire	
	   } else if ($position !== FALSE) {
		  echo "<div id='header'>
				 <div id='bandeau'>
				   <a href='../html/auth.html' class='lienlogo'><img id='logo' src='../images/insert-tech94.png' width='200pt' height='67pt' alt='Insert-Tech 94'/></a>
				   <p id='membres'>Administration | Gestion</p>
				 </div>
			   </div>"; 
		
		  echo "<div id='main'>
				  <div id='couverture'>
					<img id='illustration' src='' alt='Insert-Tech 94' width='100%' height='100%'/>";
					include("formuCompoArticle.php"); 
		  echo    "</div>";			  
		  echo  "</div>";
  
?>

