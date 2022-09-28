<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Association - Connection (Membres)</title>
<?php
	include 'Fonctions/includeStylesheet.php';
?>
  </head>

  <body>
<?php

	include 'Fonctions/AdresseServeur.php';

    if (isset($_POST['id'])){
	echo "<p>Identifiant : ".$_POST['id']."<br>";
    }
    else {
	if (isset($_POST['id'])){
	    echo "<p>";
	}
    }

    if (isset($_POST['id'])){
	echo "Mot de passe : ".$_POST['motdepasse']."</p>";
    }

?>
  </body>
</html>
