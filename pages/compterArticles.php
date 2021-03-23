<?php
  require('connexionServMySQL.php');
  
  
  function compterArticles(){
	$co = connexion();
	$sql = "SELECT * FROM article";
	$req = mysqli_query($co, $sql);
	$nombreArticles = mysqli_num_rows($req);	
	return $nombreArticles;
	}
 
?>