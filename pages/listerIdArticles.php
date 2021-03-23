<?php
 
  #Création d'une fonction qui retourne les Id's de la table Article.
  function idArticles(){
	$co = connexion();
	$sql = "SELECT * FROM article ORDER BY idart DESC";
	$req = mysqli_query($co, $sql);
	$tabId = array();
		while($ligne = mysqli_fetch_assoc($req)){
			$idArt = $ligne['idArt'];
			$tabId[] .= $idArt;   			
		}
	return $tabId;		
	}
	
?>