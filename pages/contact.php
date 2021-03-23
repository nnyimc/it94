<?php

//Création d'un tableau d'erreurs dédié aux attributs vides
$errors = array(
    'nom' => null,
	'prenom' => null,
	'societe' => null,
	'telephone' => null,
	'adressemail' => null,
	'message' => null,
);


$errNom = null;

$errors['nom'] = 'Veuillez indiquer votre nom !';
$errors['prenom'] = 'Veuillez indiquer votre prénom !';

//Création d'une fonction qui compare la valeur du champ à l'expression régulière.
function isRegexValid($value, $regex) {
    // Si le champ n'est pas vide
    if(!empty($value)) {
        // Vérifier que l'expression régulière est OK
        preg_match($regex, $value, $matches);
		// Si le champ non vide correspond à l'expr régulière
        if(!empty($matches)) {
			//Retourner true pour valider la valeur du champ testé
            return true;
        }
    }
	//Retourner false pour indiquer que la valeur du champ est inégale à la regexp
    return false;
}

//vérif champ par champ
if( isRegexValid($_POST['nom'], "/^[a-zA-Z][-a-zA-Z]*[a-zA-Z]$/") && 
    isRegexValid($_POST['prenom'], "/^[a-zA-Z][-a-zA-Z]*[a-zA-Z]$/") && 
    !empty($_POST['societe']) &&
    !empty($_POST['telephone']) && !empty($_POST['adressemail']) && !empty($_POST['message'])
) {
    //mail('contact@it94.io', 'contact', )
    echo ('SEND MAIL');
}

?>

<form name="formuContact" method="POST" onsubmit="return verif()" action="pages/contact.php">
    <div id="formuTitre">
        <p>Entrez en contact avec Insert-tech 94:</p>
    </div>
    <div id="formuIdentite">
        <div>
        <label for="nom">Nom</label>
        <input class="error" id="nom" name="nom" placeholder="Votre nom..." type="text"/>
        <span class="errdiv"><?php echo $errors['nom']; ?></span>
        </div>
        <div>
        <label for="prenom">Prénom</label>
        <input class="error" id="prenom" name="prenom" placeholder="Votre prénom..." type="text"/>
        <span class="errdiv"> Veuillez indiquer votre prénom !</span>
        </div>
    </div>
    <div id="formuCoordonnees">
        <div>
        <label for="societe">Sociéte</label>
        <input class="error" id="societe" name="societe" placeholder="Votre société..." type="text" />
        <span class="errdiv"> Veuillez indiquer le nom de la société !</span>
        </div>
        <div>
        <label for="telephone">Téléphone</label>
        <input class="error" id="telephone" name="telephone" placeholder="Votre numéro..." type="text"/>
        <span class="errdiv"> Veuillez indiquer votre numéro !</span>
        </div>
        <div>
        <label for="adressemail">E-mail</label>
        <input class="error" id="adressemail" name="adressemail" placeholder="Votre mail..." type="text" maxlength="40">
        <span class="errdiv"> Veuillez indiquer votre e-mail !</span>
        </div>
    </div>
    <div id="formuMessage">
        <div>
        <label for="message">Message</label>
        </div>
        <div>
        <textarea class="error" id="message" name="message" placeholder="Votre message..." rows="12" cols="40" maxlength="500"></textarea>
        <span class="errdiv"> Veuillez remplir ce champ !</span>
        </div>
    </div>
    <div id="formuSubmit">
        <input id="submit" type="submit" value="Envoyer"/>
    </div>
        <div id="container3">
    </div>
</form>