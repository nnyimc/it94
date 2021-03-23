  <?php
  //definition des variables
  $host = "localhost";
  $login = "root";
  $password = "";
  $bdd = "Contacts";
  
  //connexion à MySQL
  //creation d'un objet co avec pour paramètres les variables définies précédemment
  $co = new mysqli($host, $login, $password, $bdd);
   
  //verification du bon déroulement de la connexion
  if ($co->connect_error) {
	  die("Erreur de connexion: ". $co->connect_error);
    }
   
   
   //Création de la table formulaires appartenant à la BDD Conctats
  $sql = "CREATE TABLE IF NOT EXISTS contactInfos (
  Id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nom VARCHAR(25) NOT NULL,
  Prenom VARCHAR(25) NOT NULL,
  Societe VARCHAR(25) NOT NULL,
  Visiteur_mail VARCHAR(40) NOT NULL,
  Telephone VARCHAR(30) NOT NULL UNIQUE KEY,
  Message VARCHAR(1000) NOT NULL
  )";
   
   //Verification de la conformité de la table contactInfos
  if ($co->query($sql) == TRUE){
     echo "<p>Vos informations ont bien été enregitrées.</p>";
  } else {
	  echo "<p>Veuillez entrer en contact avec le <a href=\"mailto:feelionnaire@gmail.com\">webmaster</a>.</p>" . $co->error;
	  
  }

  //Fermeture de la connexion
  $co->close();

?>
  
  