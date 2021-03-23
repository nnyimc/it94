<?php
 session_start();
 
 #Récupération des données transmises par le formulaire de modif

 
     if(isset($_SESSION['id']) == TRUE || isset($_POST['validation']) == TRUE){
		  include("../includes/inclEntete-auth.php");
		  require("connexionServMySQL.php");
		  $co = connexion();
		  
		  $colonnes = '';
		  
			  #Récupérer les valeurs des colonnes pour la requête SQL
			  foreach($_POST as $index=>$valeur){
				if($index != 'validation' && $index != 'auteur'){
				$colonnes .= $index . "¤";
				} else if ($index != 'validation' && $index == 'auteur'){
				$colonnes .= $index;
				} 
			  }
			  
			  $colonnesAccord = htmlspecialchars(mysqli_real_escape_string($co , $colonnes));
			  $tabColonnesOK = explode("¤", $colonnesAccord);
			  
			  
		  $valeurs = '';
			  
			  #Récupérer les valeurs à insérer pour la requête SQL
			  foreach($_POST as $index=>$valeur){
				if($index != 'validation' && $index != 'auteur'){
				$valeurs .= $valeur . "¤";
				} else if ($index != 'validation' && $index == 'auteur'){
				$valeurs .= $valeur;
				} 
		       }
		  
		       $valeursAccord = htmlspecialchars(mysqli_real_escape_string($co , $valeurs));
		       $tabValeursOK = explode("¤", $valeursAccord);
        		
				
	#AJUSTEMENT DES VALEURS
		  if (count($tabColonnesOK) == 8 && count($tabValeursOK) == 8){
            if (empty($tabColonnesOK) == FALSE && empty($tabValeursOK) == FALSE){			  
		  #Ajustement de la table ARTICLE
		  #Récupération du mot-Clés car la clé primaire de la table est composée de idArt+mots-Clés
		  $sql1 = "SELECT * FROM article where idArt =" . $_SESSION['id'] . ";";
		  $req1 = mysqli_query($co, $sql1);
		  if ($ligne1 = mysqli_fetch_assoc($req1)){
			  $motsClesPost = $ligne1['motsCles']; 
			  $sql2 = "UPDATE article SET titre ='" . $tabValeursOK[0] . "',chapeau ='" . $tabValeursOK[1] . "',motsCles='" . $tabValeursOK[6] . "' WHERE article.idArt =" . $_SESSION['id'] . " AND article.motsCles='" . $motsClesPost . "';";
		  
		     #Execution de la requête 2
		   $req2 = mysqli_query($co, $sql2);
			var_dump($sql2);
			echo "</br>";
			var_dump($motsClesPost);
			echo "</br>";
		  }
		  
			  #Ajustement la table PHOTO
			  $tabPhoto = '';
			  if (isset($_FILES['photo']) && $_FILES['photo']['error']==0){
				  if ($_FILES['photo']['size'] <= 2000000){
					  
				  $infoPhoto = pathinfo($_FILES['photo']['name']);
				  $extensionPhoto = $infoPhoto['extension'];
				  $extensionAccord = array('jpg','png','bmp','JPG','PNG','BMP');
				  
					if(in_array($extensionPhoto, $extensionAccord)){
					   move_uploaded_file($_FILES['photo']['tmp_name'], '../uploads/' . basename($_FILES['photo']['name']));
					}			
				  }
			  }
			  
			  $nomPhoto = $_FILES['photo']['name'];
		  
		  $motsCles = '';
		  $idArt = '';
		  
		  $sql3 = "SELECT * FROM article WHERE idart =". $_SESSION['id'].";";
		  $req3 = mysqli_query($co, $sql3);
		  if($ligne3 = mysqli_fetch_assoc($req3)){
			  $motsCles = $ligne3['motsCles'];
		  }
			 
		  
		  $sql4 = "SELECT * FROM article WHERE idart =". $_SESSION['id'] .";";
		  $req4 = mysqli_query($co, $sql4);
		  if($ligne4 = mysqli_fetch_assoc($req4)){
			  $idArt = $ligne4['idArt'];
		  }
		  
		  
		  $sql5 = "UPDATE photo SET nom ='" . $nomPhoto . "', motsCles ='" . $tabValeursOK[6] . "',idArt=" . $_SESSION['id'] . " WHERE photo.idPht =". $_SESSION['id'] . ";";
		  $req5 = mysqli_query($co , $sql5);
		  
		  
		  #Ajustement de la table AUTEUR
		  $sql6 ="UPDATE auteur SET nom='"  . $tabValeursOK[7] . "', idart = " . $_SESSION['id'] . ", motscles='" . $tabValeursOK[6] . "' WHERE auteur.idAut = " . $_SESSION['id'] .";";
		  $req6 = mysqli_query($co, $sql6);
		  
		  
		  #Ajustement de la table COMPOSITION
		  $idPht = '';
		  $idAut = '';
		  $sql7 = "SELECT * FROM photo WHERE idpht =". $_SESSION['id'] .";";
		  $req7 = mysqli_query($co, $sql7);
		  if($ligne7 = mysqli_fetch_assoc($req7)){
			  $idPht = $ligne7['idPht'];
		  }
		  
		  
		  $sql8 = "SELECT * FROM auteur WHERE idaut = ". $_SESSION['id'] .";";
		  $req8 = mysqli_query($co, $sql8);
		  if($ligne8 = mysqli_fetch_assoc($req8)){
			  $idAut = $ligne8['idAut'];
		  }
		  
		   
		  $sql9 = "UPDATE composition SET idart =" . $idArt . ",idpht=" . $idPht . ", idaut=" . $idAut . ", parag1='" . mysqli_real_escape_string($co, $tabValeursOK[2]) . "', parag2='" . mysqli_real_escape_string($co, $tabValeursOK[3]) . "',parag3='" . mysqli_real_escape_string($co, $tabValeursOK[4]) . "',parag4='" . mysqli_real_escape_string($co, $tabValeursOK[5]) . "',motscles='" . $tabValeursOK[6] . "' WHERE article.idArt = " . $_SESSION['id'] . " AND article.motsCles ='" . $tabValeursOK[6] . "';"; 
					
		  $req9 = mysqli_query($co, $sql9);


	   
	   $tabReq = array($req1, $req3, $req4, $req7, $req8);
	   $nbreReq = count($tabReq);
	   var_dump($sql9);
	   var_dump($tabReq);
	   echo "</br>";
	   
	   for ($j = 0; $j < $nbreReq; $j++){
		   mysqli_free_result($tabReq[$j]);
	   }
        mysqli_close($co);	   
	  }
	
	 #Boutons d'actions
	 echo "<a href='../html/auth.html'><button>Retour</button></a>";
	 echo "<a href='articles.php'><button>Modifier</button></a>";
	 
	
   }
   $_SESSION = array();
   session_destroy();
 } else {
	
		header("Location: index.php?access=error");
		$_SESSION = array();
        session_destroy();
		exit();
    }   
?>