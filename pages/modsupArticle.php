<?php
session_start();
 #Affichage de tous les articles avec un bouton Modifier et un bouton Supprimer
 #L'utilisateur aura le choix entre modifier ou supprimer un article
  
  #Bandeau 
  echo "<div id='header'>
		 <div id='bandeau'>
		   <a href='../html/auth.html' class='lienlogo'><img id='logo' src='../images/insert-tech94.png' width='200pt' height='67pt' alt='Insert-Tech 94'/></a>
		   <p id='membres'>Administration |  Édition</p>
		 </div>
	  </div>"; 

 
  include("../includes/inclEntete-auth.php");
  include ("connexionServMySQL.php");
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
	 
	 echo  "<div id='articles_8pack' style='margin-top: 8%'>";	
	   echo "<h1 style='text-align:center'>Articles publiés</h1>";   
		   while($ligne = mysqli_fetch_assoc($req)){
			 $idArt = $ligne['idArt'];
			 
			 echo "<div id='$idArt' style='border: 1pt solid teal; width: 18.7%; float: left; margin: 1.5% 3% 0 3%; background-color : white' >";		 
			   echo "<p>". substr($ligne['titre'], 0, 15) . "</p>";
			   echo "<p>". substr($ligne['chapeau'], 0, 25) . "...</p>";
			   echo "<img src='../uploads/" . $ligne['nom'] . "' style='height: 82px; width: 150px;  display:block;'/>";
			
			   #bouton Modifier
			   echo "<a href='modifArticle.php?id=$idArt'><button style='margin: 0 1px font-size: 8px;'>Modifier</button></a>";
		 
			   #bouton Supprimer
			   echo "<a href='supprArticle.php?id=$idArt'><button style='margin: 0 1px font-size: 8px;'>Supprimer</button></a>";
			   
			 echo "</div>";
			}
		echo "</div>";
		
		
			 #Génération de liens pour chaque page
			 echo "<div id='pagination' style='float:left; clear: both; margin: 1% 3%'>";
			   echo "Page(s): ";
			   
			   for ($page = 1; $page <= $nombreDePages; $page++){
				 echo "<a href='modsupArticle.php?page=" . $page . "'> " . $page . " </a>";
			   }
			 echo "</div>";
		 
      		 
?>

