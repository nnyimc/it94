/*empty vs isset
  if(isset($_POST['submit'])){
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$visiteur_mail = $_POST['adressemail'];
	$telephone = $_POST['telephone'];
	$message = $_POST['message'];
	$objet = "Prise de contact - Insert-tech94";
	$dest = "psikojambe@live.fr";
	$entete = "From:".$visiteur_mail;
	$messageAutomatique = "Vous avez reçu un message de la part de ".$nom." ".$prenom.".\n\n".$message.
	"Vous pouvez le contactez au: ".$telephone." ou ".$visiteur_mail;
	mail($dest, $objet, $messageAutomatique, $entete);
	header("Location: index.php?mailsend");
  }
 */
