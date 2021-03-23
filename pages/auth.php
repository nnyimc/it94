<?php
	session_start();
	var_dump($_SESSION);
	  
	  include("../includes/inclEntete-auth.php");
	  
	  #Vérification du referer
	  if(isset($_SERVER['HTTP_REFERER'])) {
	    $referer = $_SERVER['HTTP_REFERER'];
	    $urlValide1 = 'compo.php';
		$position1 = strpos($referer, $urlValide1);
	  }

	  
	  #Si le formulaire d'authentification est transmis
	  if(isset($_POST['auth'])){
		  
		#Vérification que les champs ident et mdp ne sont pas vides
		if((empty($_POST['ident']) == FALSE && empty($_POST['mdp']) == FALSE)){
			echo "<body>";
			
			include "connexionServMySQL.php";
			$co = connexion();
			$ident = mysqli_real_escape_string($co, $_POST['ident']);
			$mdp = mysqli_real_escape_string($co, $_POST['mdp']);
			
            #Vérification de la présence de l'identifiant et du mot de passe dans la base de données
			$sql1 ="SELECT * FROM personnel WHERE ident = '" . $ident . "';";
			$req1 = mysqli_query($co, $sql1);
			$numLigne = mysqli_num_rows($req1);
			
			if ($numLigne < 1) {
			  header("Location: index.php?ident=erreur");
	          exit();
			} else {
              if ($ligne1 = mysqli_fetch_assoc($req1)){
				#dechiffrer le mot de passe
				$mdpVerif = password_verify($mdp, $ligne1['mdp']);
	
				#Si le mot de passe est faux renvoyer l'utilisateur
				if ($mdpVerif == false){
				  header("Location: index.php?authentification=erreur");
	              exit();
				} #sinon autoriser l'accès
			    else if ($mdpVerif == true){
				  $_SESSION['ident'] = $ligne1['ident'];
				  $_SESSION['mdp'] = $ligne1['mdp'];
				  echo "<div id='header'>
						 <div id='bandeau'>
						   <a href='../html/auth.html' class='lienlogo'><img id='logo' src='../images/insert-tech94.png' width='200pt' height='67pt' alt='Insert-Tech 94'/></a>
						   <p id='membres'>Administration | Gestion</p>
						 </div>
					  </div>"; 
			  
				   echo "<div id='main'>
						  <div id='couverture'>
						";
							echo "<a style='margin:4% 30%;' href='formuCompoArticle.php'><button style='margin:0 15%;'>Créer un Article</button></a>";
							echo "<a style='margin:4% 30%;' href='modsupArticle.php'><button style='margin:0 15%;'>Corriger un Article</button></a>";
					
				   echo    "</div>";		   
				   echo  "</div>";
				   
			    }
			  } 
			}				
		  }	
		  
	   # Si la requête provient de compo.php, afficher le formulaire	
	   } else if ($position1 !== FALSE ) {
		  echo "<div id='header'>
				 <div id='bandeau'>
				   <a href='../html/auth.html' class='lienlogo'><img id='logo' src='../images/insert-tech94.png' width='200pt' height='67pt' alt='Insert-Tech 94'/></a>
				   <p id='membres'>Administration | Gestion</p>
				 </div>
			   </div>"; 
		
		  echo "<div id='main'>
				  <div id='couverture'>
				";
					echo "<a style='margin:4% 30%;' href='formuCompoArticle.php'><button style='margin:0 15%;'>Créer un Article</button></a>";
					echo "<a style='margin:4% 30%;' href='modsupArticle.php'><button style='margin:0 15%;'>Corriger un Article</button></a>";
					
		  echo    "</div>";		  
		  echo  "</div>";
		  
		  
	   # Si la requête fait suite à un échec afficher le formulaire	
	   } else if ($_SESSION['retry'] = 1) {
		  echo "<div id='header'>
				 <div id='bandeau'>
				   <a href='../html/auth.html' class='lienlogo'><img id='logo' src='../images/insert-tech94.png' width='200pt' height='67pt' alt='Insert-Tech 94'/></a>
				   <p id='membres'>Administration | Gestion</p>
				 </div>
			   </div>"; 
		
		  echo "<div id='main'>
				  <div id='couverture'>
				";
					echo "<a style='margin:4% 30%;' href='formuCompoArticle.php'><button style='margin:0 15%;'>Créer un Article</button></a>";
							echo "<a style='margin:4% 30%;' href='modsupArticle.php'><button style='margin:0 15%;'>Corriger un Article</button></a>";
					
		  echo    "</div>";		  
		  echo  "</div>";
          

	   #Sinon message d'avertissement, renvoi vers la page d'accueil.		
	   } else {
	       echo "<div id='header'>
			       <div id='bandeau'>
			         <a href='../html/auth.html' class='lienlogo'><img id='logo' src='../images/insert-tech94.png' width='200pt' height='67pt' alt='Insert-Tech 94'/></a>
			         <span class='nonmembres'>Accès restreint. <a href='../html/index.html'>Retour</a></span>
			       </div>
		         </div>"; 
	
	       echo "<div id='main'>
			      <div id='couverture'>
				    <img id='illustration' src='' alt='Insert-Tech 94' width='100%' height='100%'/>
			      </div>   
			     </div>   	  
		      </body>
		    </html>";
			
	       header("Location: index.php?access=forbidden");
	       exit();
	   }
?>