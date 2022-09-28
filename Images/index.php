<?php
	include 'Fonctions/AdresseServeur.php';

	echo '	<p>redirection vers la <a href="'.$serveur.'Accueil%20%281%29.php">page d'."'".'acceuil</a>...</p>'."\n";  

	header('Location: '.$serveur.'../Accueil%20%281%29.php'); 
?>