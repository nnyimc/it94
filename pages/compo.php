<?php
 session_start();
     if(isset($_SESSION['auth']) == TRUE || isset($_POST['validation']) == TRUE){
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
			 
        $caseVide =''; 			 
        		
	#INSERTION DES VALEURS
			  if (count($tabColonnesOK) == 5 && count($tabValeursOK) == 5){
				 
				for ($i = 0 ; $i < count($tabValeursOK); $i++){
					if ($tabValeursOK[$i] == ""){
						$caseVide = TRUE;
					   }
				}
				
				#Si aucun champ n'est vide éxecuter la requête SQL
				if ($caseVide !== TRUE)  {		 	
			  #Insertion dans la table ARTICLE
			  
			  $sql1 = "INSERT INTO article (" . $tabColonnesOK[0] . "," . $tabColonnesOK[1] . "," . $tabColonnesOK[3] . ") 
					  VALUES ('" . $tabValeursOK[0] . "','" . $tabValeursOK[1] . "','" . $tabValeursOK[3] . "');";
			  mysqli_query($co, $sql1);
			  
			  $last_id = mysqli_insert_id($co);
			  
				  #Insertion dans la table PHOTO
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
			  
			  $sql2 = "SELECT * FROM article WHERE idart = $last_id;";
			  $req2 = mysqli_query($co, $sql2);
			  if($ligne1 = mysqli_fetch_assoc($req2)){
				  $motsCles = $ligne1['motsCles'];
			  }
				 
			  
			  $sql3 = "SELECT * FROM article WHERE idart = $last_id;";
			  $req3 = mysqli_query($co, $sql3);
			  if($ligne2 = mysqli_fetch_assoc($req3)){
				  $idArt = $ligne2['idArt'];
			  }
			  
			  
			  $sql4 = "INSERT INTO photo (nom, idart, motscles) VALUES ('" . $nomPhoto . "','" . $idArt . "','" . $motsCles . "');";
			  $req4 = mysqli_query($co , $sql4);
			  
			  
			  #Insertion dans la table AUTEUR
			  
			  $sql5 ="INSERT INTO auteur (nom, idart, motscles) VALUES ('" . $tabValeursOK[4] . "','" . $idArt . "', '" . $tabValeursOK[3] . "');";
			  $req5 = mysqli_query($co, $sql5);
			  
			  
			  #Insertion dans la table COMPOSITION
			  $idPht = '';
			  $idAut = '';
			  $sql6 = "SELECT * FROM photo WHERE idpht = $last_id;";
			  $req6 = mysqli_query($co, $sql6);
			  if($ligne3 = mysqli_fetch_assoc($req6)){
				  $idPht = $ligne3['idPht'];
			  }
			  
			  
			  $sql7 = "SELECT * FROM auteur WHERE idaut = $last_id;";
			  $req7 = mysqli_query($co, $sql7);
			  if($ligne4 = mysqli_fetch_assoc($req7)){
				  $idAut = $ligne4['idAut'];
			  }
			  
			  $sql8 = "INSERT INTO composition (idart, idpht, idaut, parag1, motscles) 
						VALUES ('" . $idArt . "','" . $idPht . "','" . $idAut . "','" . $tabValeursOK[2] . "', '" . $tabValeursOK[3] . "');";
			  $req8 = mysqli_query($co, $sql8);


		#AFFICHAGE DE L'ARTICLE-TEST 


			 
				#Affichage du titre et du chapeau 	 
				$sql9 = "SELECT * FROM article WHERE idart = $last_id;";
				$req9 = mysqli_query($co, $sql9);
				if ($ligne9 = mysqli_fetch_assoc($req9)){
					echo "<h1>" . $ligne9['titre'] . "</h1>";
					echo "<h2>" . $ligne9['chapeau'] ."</h2>";
				}
				
				#Affichage de la photo
				$sql10 = "SELECT * FROM photo WHERE idpht = $last_id;";
				$req10 = mysqli_query($co, $sql10);
				if ($ligne10 = mysqli_fetch_assoc($req10)){
					echo "<img src='../uploads/" . $ligne10['nom'] . "'/>";
				}
				
				#Affichage des paragraphes
				$sql11 = "SELECT * FROM composition WHERE idaut = $last_id;";
				$req11 =  mysqli_query($co, $sql11);
				if ($ligne11 = mysqli_fetch_assoc($req11)){
					$parags = $ligne11['parag1'];
					
					  if ($parags != ""){
						echo "<p>" . $parags . "</p>";
					  }
				
				}
				
				#Affichage de l'auteur
				$sql12 = "SELECT * FROM auteur WHERE idaut = $last_id;";
				$req12 =  mysqli_query($co, $sql12);
				if ($ligne12 = mysqli_fetch_assoc($req12)){
					echo "<p>" . $ligne12['nom'] . "</p>";
				}
				
				#Affichage des mots clés
				$sql13 = "SELECT * FROM article WHERE idart = $last_id;";
				$req13 = mysqli_query($co, $sql13);
				if ($ligne13 = mysqli_fetch_assoc($req13)){
					echo "<p>" . $ligne13['motsCles'] . "</p>";
				}
			   
			   $req = array($req2, $req3, $req6, $req7, $req9, $req10, $req11, $req12, $req13);
			   mysqli_close($co);
			   for ($j = 0; $j < 8; $j++){
				   mysqli_free_result($req[$j]);
			   }
			   
			   #Affichage du bouton de publication
			   echo "<a href='articles.php'><button>Publier</button></a>";
			   $_SESSION = array();
			   session_destroy();
		  
		  }
		  
		}  else if (count($tabColonnesOK) == 6 && count($tabValeursOK) == 6){
				  
				for ($i = 0 ; $i < count($tabValeursOK); $i++){
					if ($tabValeursOK[$i] == ""){
						$caseVide;
						$caseVide = TRUE;
					   }
				}
				
				#Si aucun champ n'est vide éxecuter la requête SQL
				if ($caseVide !== TRUE)  {		 	
			  #Insertion dans la table ARTICLE
			  
			  $sql1 = "INSERT INTO article (" . $tabColonnesOK[0] . "," . $tabColonnesOK[1] . "," . $tabColonnesOK[4] . ") 
					  VALUES ('" . $tabValeursOK[0] . "','" . $tabValeursOK[1] . "','" . $tabValeursOK[4] . "');";
			  mysqli_query($co, $sql1);
			  
			  $last_id = mysqli_insert_id($co);
			  
				  #Insertion dans la table PHOTO
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
			  
			  $sql2 = "SELECT * FROM article WHERE idart = $last_id;";
			  $req2 = mysqli_query($co, $sql2);
			  if($ligne1 = mysqli_fetch_assoc($req2)){
				  $motsCles = $ligne1['motsCles'];
			  }
				 
			  
			  $sql3 = "SELECT * FROM article WHERE idart = $last_id;";
			  $req3 = mysqli_query($co, $sql3);
			  if($ligne2 = mysqli_fetch_assoc($req3)){
				  $idArt = $ligne2['idArt'];
			  }
			  
			  
			  $sql4 = "INSERT INTO photo (nom, idart, motscles) VALUES ('" . $nomPhoto . "','" . $idArt . "','" . $motsCles . "');";
			  $req4 = mysqli_query($co , $sql4);
			  
			  
			  #Insertion dans la table AUTEUR
			  
			  $sql5 ="INSERT INTO auteur (nom, idart, motscles) VALUES ('" . $tabValeursOK[5] . "','" . $idArt . "', '" . $tabValeursOK[4] . "');";
			  $req5 = mysqli_query($co, $sql5);
			  
			  
			  #Insertion dans la table COMPOSITION
			  $idPht = '';
			  $idAut = '';
			  $sql6 = "SELECT * FROM photo WHERE idpht = $last_id;";
			  $req6 = mysqli_query($co, $sql6);
			  if($ligne3 = mysqli_fetch_assoc($req6)){
				  $idPht = $ligne3['idPht'];
			  }
			  
			  
			  $sql7 = "SELECT * FROM auteur WHERE idaut = $last_id;";
			  $req7 = mysqli_query($co, $sql7);
			  if($ligne4 = mysqli_fetch_assoc($req7)){
				  $idAut = $ligne4['idAut'];
			  }
			  
			  $sql8 = "INSERT INTO composition (idart, idpht, idaut, parag1, parag2, motscles) 
						VALUES ('" . $idArt . "','" . $idPht . "','" . $idAut . "','" . $tabValeursOK[2] . "', '" . $tabValeursOK[3] . "', '" . $tabValeursOK[4] . "');";
			  $req8 = mysqli_query($co, $sql8);


		#AFFICHAGE DE L'ARTICLE-TEST 


			 
				#Affichage du titre et du chapeau 	 
				$sql9 = "SELECT * FROM article WHERE idart = $last_id;";
				$req9 = mysqli_query($co, $sql9);
				if ($ligne9 = mysqli_fetch_assoc($req9)){
					echo "<h1>" . $ligne9['titre'] . "</h1>";
					echo "<h2>" . $ligne9['chapeau'] ."</h2>";
				}
				
				#Affichage de la photo
				$sql10 = "SELECT * FROM photo WHERE idpht = $last_id;";
				$req10 = mysqli_query($co, $sql10);
				if ($ligne10 = mysqli_fetch_assoc($req10)){
					echo "<img src='../uploads/" . $ligne10['nom'] . "'/>";
				}
				
				#Affichage des paragraphes
				$sql11 = "SELECT * FROM composition WHERE idaut = $last_id;";
				$req11 =  mysqli_query($co, $sql11);
				if ($ligne11 = mysqli_fetch_assoc($req11)){
					$parags = $ligne11['parag1'];
					
					  if ($parags != ""){
						echo "<p>" . $parags . "</p>";
					  }
				
				}
				
				#Affichage de l'auteur
				$sql12 = "SELECT * FROM auteur WHERE idaut = $last_id;";
				$req12 =  mysqli_query($co, $sql12);
				if ($ligne12 = mysqli_fetch_assoc($req12)){
					echo "<p>" . $ligne12['nom'] . "</p>";
				}
				
				#Affichage des mots clés
				$sql13 = "SELECT * FROM article WHERE idart = $last_id;";
				$req13 = mysqli_query($co, $sql13);
				if ($ligne13 = mysqli_fetch_assoc($req13)){
					echo "<p>" . $ligne13['motsCles'] . "</p>";
				}
			   
			   $req = array($req2, $req3, $req6, $req7, $req9, $req10, $req11, $req12, $req13);
			   mysqli_close($co);
			   for ($j = 0; $j < 8; $j++){
				   mysqli_free_result($req[$j]);
			   }
			   
			   #Affichage du bouton de publication
			   echo "<a href='articles.php'><button>Publier</button></a>";
			   $_SESSION = array();
			   session_destroy();
		  
		  }
		 
		  
		}  else if (count($tabColonnesOK) == 7 && count($tabValeursOK) == 7){
				  
				for ($i = 0 ; $i < count($tabValeursOK); $i++){
					if ($tabValeursOK[$i] == ""){
						$caseVide;
						$caseVide = TRUE;
					   }
				}
				
				#Si aucun champ n'est vide éxecuter la requête SQL
				if ($caseVide !== TRUE)  {		 	
			  #Insertion dans la table ARTICLE
			  
			  $sql1 = "INSERT INTO article (" . $tabColonnesOK[0] . "," . $tabColonnesOK[1] . "," . $tabColonnesOK[5] . ") 
					  VALUES ('" . $tabValeursOK[0] . "','" . $tabValeursOK[1] . "','" . $tabValeursOK[5] . "');";
			  mysqli_query($co, $sql1);
			  
			  $last_id = mysqli_insert_id($co);
			  
				  #Insertion dans la table PHOTO
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
			  
			  $sql2 = "SELECT * FROM article WHERE idart = $last_id;";
			  $req2 = mysqli_query($co, $sql2);
			  if($ligne1 = mysqli_fetch_assoc($req2)){
				  $motsCles = $ligne1['motsCles'];
			  }
				 
			  
			  $sql3 = "SELECT * FROM article WHERE idart = $last_id;";
			  $req3 = mysqli_query($co, $sql3);
			  if($ligne2 = mysqli_fetch_assoc($req3)){
				  $idArt = $ligne2['idArt'];
			  }
			  
			  
			  $sql4 = "INSERT INTO photo (nom, idart, motscles) VALUES ('" . $nomPhoto . "','" . $idArt . "','" . $motsCles . "');";
			  $req4 = mysqli_query($co , $sql4);
			  
			  
			  #Insertion dans la table AUTEUR
			  
			  $sql5 ="INSERT INTO auteur (nom, idart, motscles) VALUES ('" . $tabValeursOK[6] . "','" . $idArt . "', '" . $tabValeursOK[5] . "');";
			  $req5 = mysqli_query($co, $sql5);
			  
			  
			  #Insertion dans la table COMPOSITION
			  $idPht = '';
			  $idAut = '';
			  $sql6 = "SELECT * FROM photo WHERE idpht = $last_id;";
			  $req6 = mysqli_query($co, $sql6);
			  if($ligne3 = mysqli_fetch_assoc($req6)){
				  $idPht = $ligne3['idPht'];
			  }
			  
			  
			  $sql7 = "SELECT * FROM auteur WHERE idaut = $last_id;";
			  $req7 = mysqli_query($co, $sql7);
			  if($ligne4 = mysqli_fetch_assoc($req7)){
				  $idAut = $ligne4['idAut'];
			  }
			  
			  $sql8 = "INSERT INTO composition (idart, idpht, idaut, parag1, parag2, parag3, motscles) 
						VALUES ('" . $idArt . "','" . $idPht . "','" . $idAut . "','" . $tabValeursOK[2] . "', '" . $tabValeursOK[3] . "', '" . $tabValeursOK[4] . "','" . $tabValeursOK[5] . "');";
			  $req8 = mysqli_query($co, $sql8);


		#AFFICHAGE DE L'ARTICLE-TEST 


			 
				#Affichage du titre et du chapeau 	 
				$sql9 = "SELECT * FROM article WHERE idart = $last_id;";
				$req9 = mysqli_query($co, $sql9);
				if ($ligne9 = mysqli_fetch_assoc($req9)){
					echo "<h1>" . $ligne9['titre'] . "</h1>";
					echo "<h2>" . $ligne9['chapeau'] ."</h2>";
				}
				
				#Affichage de la photo
				$sql10 = "SELECT * FROM photo WHERE idpht = $last_id;";
				$req10 = mysqli_query($co, $sql10);
				if ($ligne10 = mysqli_fetch_assoc($req10)){
					echo "<img src='../uploads/" . $ligne10['nom'] . "'/>";
				}
				
				#Affichage des paragraphes
				$sql11 = "SELECT * FROM composition WHERE idaut = $last_id;";
				$req11 =  mysqli_query($co, $sql11);
				if ($ligne11 = mysqli_fetch_assoc($req11)){
					$parags = $ligne11['parag1'];
					
					  if ($parags != ""){
						echo "<p>" . $parags . "</p>";
					  }
				
				}
				
				#Affichage de l'auteur
				$sql12 = "SELECT * FROM auteur WHERE idaut = $last_id;";
				$req12 =  mysqli_query($co, $sql12);
				if ($ligne12 = mysqli_fetch_assoc($req12)){
					echo "<p>" . $ligne12['nom'] . "</p>";
				}
				
				#Affichage des mots clés
				$sql13 = "SELECT * FROM article WHERE idart = $last_id;";
				$req13 = mysqli_query($co, $sql13);
				if ($ligne13 = mysqli_fetch_assoc($req13)){
					echo "<p>" . $ligne13['motsCles'] . "</p>";
				}
			   
			   $req = array($req2, $req3, $req6, $req7, $req9, $req10, $req11, $req12, $req13);
			   mysqli_close($co);
			   for ($j = 0; $j < 8; $j++){
				   mysqli_free_result($req[$j]);
			   }
			   
			   #Affichage du bouton de publication
			   echo "<a href='articles.php'><button>Publier</button></a>";
			   $_SESSION = array();
			   session_destroy();
		  
		  } 
		  
		}  else if (count($tabColonnesOK) == 8 && count($tabValeursOK) == 8) {
				  
				for ($i = 0 ; $i < count($tabValeursOK); $i++){
					if ($tabValeursOK[$i] == ""){
						$caseVide;
						$caseVide = TRUE;
					   }
				}
				
				#Si aucun champ n'est vide éxecuter la requête SQL
				if ($caseVide !== TRUE)  {		 	
			  #Insertion dans la table ARTICLE
			  
			  $sql1 = "INSERT INTO article (" . $tabColonnesOK[0] . "," . $tabColonnesOK[1] . "," . $tabColonnesOK[6] . ") 
					  VALUES ('" . $tabValeursOK[0] . "','" . $tabValeursOK[1] . "','" . $tabValeursOK[6] . "');";
			  mysqli_query($co, $sql1);
			  
			  $last_id = mysqli_insert_id($co);
			  
				  #Insertion dans la table PHOTO
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
			  
			  $sql2 = "SELECT * FROM article WHERE idart = $last_id;";
			  $req2 = mysqli_query($co, $sql2);
			  if($ligne1 = mysqli_fetch_assoc($req2)){
				  $motsCles = $ligne1['motsCles'];
			  }
				 
			  
			  $sql3 = "SELECT * FROM article WHERE idart = $last_id;";
			  $req3 = mysqli_query($co, $sql3);
			  if($ligne2 = mysqli_fetch_assoc($req3)){
				  $idArt = $ligne2['idArt'];
			  }
			  
			  
			  $sql4 = "INSERT INTO photo (nom, idart, motscles) VALUES ('" . $nomPhoto . "','" . $idArt . "','" . $motsCles . "');";
			  $req4 = mysqli_query($co , $sql4);
			  
			  
			  #Insertion dans la table AUTEUR
			  
			  $sql5 ="INSERT INTO auteur (nom, idart, motscles) VALUES ('" . $tabValeursOK[7] . "','" . $idArt . "', '" . $tabValeursOK[6] . "');";
			  $req5 = mysqli_query($co, $sql5);
			  
			  
			  #Insertion dans la table COMPOSITION
			  $idPht = '';
			  $idAut = '';
			  $sql6 = "SELECT * FROM photo WHERE idpht = $last_id;";
			  $req6 = mysqli_query($co, $sql6);
			  if($ligne3 = mysqli_fetch_assoc($req6)){
				  $idPht = $ligne3['idPht'];
			  }
			  
			  
			  $sql7 = "SELECT * FROM auteur WHERE idaut = $last_id;";
			  $req7 = mysqli_query($co, $sql7);
			  if($ligne4 = mysqli_fetch_assoc($req7)){
				  $idAut = $ligne4['idAut'];
			  }
			  
			  $sql8 = "INSERT INTO composition (idart, idpht, idaut, parag1, parag2, parag3, parag4, motscles) 
						VALUES ('" . $idArt . "','" . $idPht . "','" . $idAut . "','" . $tabValeursOK[2] . "', '" . $tabValeursOK[3] . "', '" . $tabValeursOK[4] . "','" . $tabValeursOK[5] . "','" . $tabValeursOK[6] . "');";
			  $req8 = mysqli_query($co, $sql8);


		#AFFICHAGE DE L'ARTICLE-TEST 


			 
				#Affichage du titre et du chapeau 	 
				$sql9 = "SELECT * FROM article WHERE idart = $last_id;";
				$req9 = mysqli_query($co, $sql9);
				if ($ligne9 = mysqli_fetch_assoc($req9)){
					echo "<h1>" . $ligne9['titre'] . "</h1>";
					echo "<h2>" . $ligne9['chapeau'] ."</h2>";
				}
				
				#Affichage de la photo
				$sql10 = "SELECT * FROM photo WHERE idpht = $last_id;";
				$req10 = mysqli_query($co, $sql10);
				if ($ligne10 = mysqli_fetch_assoc($req10)){
					echo "<img src='../uploads/" . $ligne10['nom'] . "'/>";
				}
				
				#Affichage des paragraphes
				$sql11 = "SELECT * FROM composition WHERE idaut = $last_id;";
				$req11 =  mysqli_query($co, $sql11);
				if ($ligne11 = mysqli_fetch_assoc($req11)){
					$parags = $ligne11['parag1'];
					
					  if ($parags != ""){
						echo "<p>" . $parags . "</p>";
					  }
				
				}
				
				#Affichage de l'auteur
				$sql12 = "SELECT * FROM auteur WHERE idaut = $last_id;";
				$req12 =  mysqli_query($co, $sql12);
				if ($ligne12 = mysqli_fetch_assoc($req12)){
					echo "<p>" . $ligne12['nom'] . "</p>";
				}
				
				#Affichage des mots clés
				$sql13 = "SELECT * FROM article WHERE idart = $last_id;";
				$req13 = mysqli_query($co, $sql13);
				if ($ligne13 = mysqli_fetch_assoc($req13)){
					echo "<p>" . $ligne13['motsCles'] . "</p>";
				}
			   
			   $req = array($req2, $req3, $req6, $req7, $req9, $req10, $req11, $req12, $req13);
			   mysqli_close($co);
			   for ($j = 0; $j < 8; $j++){
				   mysqli_free_result($req[$j]);
			   }
			   
			   #Affichage du bouton de publication
			   echo "<a href='articles.php'><button>Publier</button></a>";
			   $_SESSION = array();
			   session_destroy();
		  
		  } 


		  else {
			  
			  echo "<p style='text-align:center;'>Erreur détectée lors du traitement de votre demande. Veillez à remplir tous les champs du formulaire.</p>";
			   echo "<a style='margin:0 40%;' href='auth.php'><button>Retour</button></a>";
			   $_SESSION['retry'] = 1;
			}
		}

	
} else {
	    
		header("Location: index.php?access=error");
		$_SESSION = array();
		session_destroy();
		exit();
}

?>