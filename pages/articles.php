<?php
  session_destroy();
  include('../includes/_inclEntete-article.php');  
   
   require('connexionServMySQL.php');
   $co = connexion();
   
   include('listerIdArticles.php');
   $listeIds = idArticles();   
   $totalIds = count($listeIds);
	
	#S'il y a plusieurs articles , afficher la série de 4 articles
	if ($totalIds > 1) {
		echo "<div id='main'>
      
				<!-- Image de couverture-->
		        <div id='couverture' style='display:none'>
			      <img id='illustration' src='' alt='Insert-Tech 94' width='100%' 
			       height='100%'/>
		        </div>";
		 
		
	        include('publicationArticle.php');    
		   
		echo "</div>";
			   
			   
	#S'il n'y a qu'un seul article, masquer la section articles_4pack		   
	} else if ($totalIds == 1) {
		echo "<div id='main'>
		        
				<!-- Image de couverture-->
		        <div id='couverture' style='display:none'>
			      <img id='illustration' src='' alt='Insert-Tech 94' width='100%' 
			       height='100%'/>
		        </div>";
		 
		 include('publicationArticle.php'); 
		   
		echo "</div>";
	
	#S'il n'y a pas d'article, afficher la couverture
	} else if ($totalIds == 0) {
		echo "<div id='main'> 
		        
				<!-- Image de couverture-->
		        <div id='couverture' style='display:visible'>
			      <img id='illustration' src='' alt='Insert-Tech 94' width='100%' 
			       height='100%'/>
		        </div>";
		 
		 include('publicationArticle.php'); 
		   
		echo "</div>";
	}
?> 
  

<?php
  include('../includes/_inclPied-article.php');
  mysqli_close($co);
?>
