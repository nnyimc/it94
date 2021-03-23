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
   
   
   //Création de la table formulaires appartenant à la BDD Contacts
  $creation_table = "CREATE TABLE IF NOT EXISTS contactInfos
  (
  Id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nom VARCHAR(25) NOT NULL,
  Prenom VARCHAR(25) NOT NULL,
  Societe VARCHAR(25) NOT NULL,
  Visiteur_mail VARCHAR(50) NOT NULL,
  Telephone TEXT NOT NULL UNIQUE KEY,
  Message TEXT NOT NULL
  )";
  
   
   //Verification de la conformité de la table contactInfos
  if ($co->query($creation_table) == TRUE){
     echo "<p>Vos informations ont bien été enregistrées.</p>";
  } else {
	  echo "<p>Veuillez entrer en contact avec le <a href=\"mailto:feelionnaire@gmail.com\">webmaster</a>.</p>" . $co->error; 
  }
  
  //Prise en charge des valeurs entrées par un usager
  $nom = $co->real_escape_string($_POST['nom']);
  $prenom = $co->real_escape_string($_POST['prenom']);
  $societe = $co->real_escape_string($_POST['societe']);
  $visiteur_mail = $co->real_escape_string($_POST['adressemail']);
  $telephone = $co ->real_escape_string($_POST['telephone']);
  $message = $co ->real_escape_string($_POST['message']);
  
  
  //Insertion des valeurs
  $insertion_valeurs = $co->query("INSERT INTO contactInfos (Nom, Prenom, Societe, Visiteur_mail, Telephone, Message) VALUES ('$nom', '$prenom', '$societe', '$visiteur_mail', '$telephone', '$message')");
  
  if (!$insertion_valeurs){
	  echo "<p>".$co->error."</p>";
	  echo "<p>Signalez cette erreur au <a href=\"mailto:feelionnaire@gmail.com\">webmaster</a>. Cela nous permettra de résoudre l'incident prochainement.</p>";
  } else {
	  echo "<p>Nous reviendrons vers vous prochainement.</p>";
  }
  
  //Fermeture de la connexion
  $co->close();

?>
  
  