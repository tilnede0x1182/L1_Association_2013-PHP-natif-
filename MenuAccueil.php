<?php

	include 'VerifieConnection.php';
	include 'VerifieConnectionMembre.php';
	include 'Fonctions/AdresseServeur.php';

    echo '    <img class="principale" src="'.$serveur.'Images/untitl10.jpg" alt="Paris Diderot">'."\n".'	<div class="clear"></div>'."\n";
    echo '    <h1 class="titre">Bienvenue sur le site des Anciens de Paris 7</h1>'."\n";

	if (verifieConnection()) $b=1;
	else $b=0;

	$bb=0;
	

		echo '    <nav id="menuAcceuil"><ul><li><a href="'.$serveur.'Accueil%20%281%29.php">Accueil</a></li>
    <li><a href="'.$serveur.'Presentation.php">A propos</a></li>
    <li><a href="'.$serveur.'Contact.php">Nous contacter</a></li>'."\n";

	echo '	 <li><a href="'.$serveur.'ModifierStyle.php?couleur=1"><img src="'.$serveur.'Images/Orangebicolore4.jpg" title="Style : &quot;Coucher de soleil&quot;" alt="Style orangé"></a></li>'."\n";
	echo '	 <li><a href="'.$serveur.'ModifierStyle.php?couleur=2"><img src="'.$serveur.'Images/vertbicolore2.jpg" title="Style : &quot;Rosée du matin&quot;" alt="Style vert clair"></a></li>'."\n";


	if ($b==0) {

		echo '    <li><a href="'.$serveur.'PageRedirectionVerslInscription.php">Projets</a></li>'."\n";

		echo '	 <div class="accesMembre">
	    <p>Accès membres : </p>
	
	    <form action="Connection1.php" method="POST">
		<label>Identifiant : <input type="text" name="id"></label><br>
		<label>Mot de passe : <input type="password" name="motdepasse"></label><br>
		<input type="submit" value="Se connecter"><br>
		<a href="'.$serveur.'NouveauMembre3.php">S'."'inscrire</a>
	    </form>
	    </nav></ul></div>";
	}
	else {
		echo '    <li><a href="'.$serveur.'Deconnection.php">Se déconnecter</a></li>'."\n";
		echo '    <li><a href="'.$serveur.'ModifierInformationMembre.php">Modifier mes informations</a></li>'."\n";
		echo '    <li><a href="'.$serveur.'ListeDesMembres.php">Voir la liste des membres</a></li></ul></nav>'."\n";
		echo '    <ul><nav class="listeGauche"<li><a href="'.$serveur.'NouveauProjet.php">Projets</a></li>';
		if (verifieConnectionMembre())	echo "\n".'    <li><a href="'.$serveur.'EcritureNouveauPost.php">Ecrire un nouvel article</a></ul></li>';
	}

	echo "\n";	


	//session_destroy();
?>