﻿<?php session_start();
	include 'Fonctions/AdresseServeur.php';
	if (empty($_SESSION['id'])) $_SESSION['id']=80;
	if (empty($_SESSION['motdepasse'])) $_SESSION['motdepasse']=80;
	$_SESSION['pageCourante']=$serveur."PageRedirectionVerslInscription.php";
	if (empty($_SESSION['style'])) $_SESSION['style']=1;
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>A propos</title>
<?php
	include 'Fonctions/includeStylesheet.php';
?>
  </head>

  <body>

<?php
	include 'MenuAccueil.php';
	include 'Fonctions/ConversionDate.php';

	echo '<h2 class="texte">Contenu privé : </h2>

	<h3 class="texte1">Pour voir cette page vous devez vous <a href="'.$serveur.'NouveauMembre3.php">inscrire</a> ou, si c'."'".'est déjà fait, vous identifer.</h3>'; 

	if (verifieConnection()) header('Location: '.$serveur.'NouveauProjet.php');

?>

  </body>
</html>

