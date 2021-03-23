<?php
  #Moteur de recherche
  #Affichage des mots clés sous forme de liens
	$sql13 = "SELECT * FROM article ORDER BY idart DESC LIMIT 1";
	$req13 = mysqli_query($co, $sql13);
	if ($ligne13 = mysqli_fetch_assoc($req13)){
	 $motsTrouves = explode(" ",$ligne13['motsCles']);
	 $totalMots = count($motsTrouves);
	 
	 
	 echo "<span> mots-clés:  </span>";	
			 
		for ($m = 0; $m < $totalMots; $m++){
			$sql13b = "SELECT * FROM article WHERE motsCles LIKE '%$motsTrouves[$m]%' ORDER BY idArt DESC";	
			$req13b = mysqli_query($co, $sql13b);
			  
			  while ($ligne13b = mysqli_fetch_assoc($req13b)){
				$idArt = array();
				$idArt[] .= $ligne13b['idArt'];
				$nombreId = count($idArt);						
				  for ($i = 0; $i < $nombreId; $i++){
					echo "<span><a href='lectureArticle.php?idArt=" . $idArt[$i] . "'>". $motsTrouves[$m] ." </a></span>";
				  }
			  }
		}

	}
?>