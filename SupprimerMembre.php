﻿<?php session_start();
	include 'Fonctions/AdresseServeur.php';
	if (empty($_SESSION['id'])) $_SESSION['id']=80;
	if (empty($_SESSION['motdepasse'])) $_SESSION['motdepasse']=80;
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Suppression d'un membre</title>
<?php
	include 'Fonctions/includeStylesheet.php';
?>
  </head>

  <body>

<?php
	include 'Fonctions/AdresseServeur.php';

	$idmembre = $_SESSION['id'];
	$motdepasse = $_SESSION['motdepasse'];

	include 'MenuAccueil.php';
	include 'Fonctions/detectlId.php';
	include 'Fonctions/ConversionDate.php';

	if (verifieConnection()){

		echo "\n".'    <div class="lien"><p><a href="'.$serveur.'CreationNouveauProjet.php">Nouveau projet</a></p></div>'."\n\n";

		include 'Fonctions/ConnectionBaseDonnees.php';
		
		$connexion = mysql_pconnect($server,$user,$motdepasse) ;
		if (!$connexion) {
			echo "Pas de connexion au serveur" ;
		}else {
			if (!mysql_select_db($base, $connexion)) {
				echo "Pas d'accès à la base" ;
			}else {


				if (empty($_POST)) {
					echo "	 <h4>Attention, vous êtes sur le point de supprimer votre compte.<br>\nLa suppression de votre compte entraînera la perte de tous vos projets.<br><br>\nSouhaitez-vous réellement supprimer votre compte ?</h4>\n";


					echo '	 <form action="" method="POST"><input name="choix" value="1" hidden><input type="submit" value="Oui"></form>&nbsp;&nbsp;';
					echo '	 <form action="" method="POST"><input name="choix" value="0" hidden><input type="submit" value="Annuler"></form>';
				}
				else {
					if ($_POST['choix']==1) {
						$sql ='DELETE from asso WHERE id="'.$idmembre.'" AND motdepasse="'.$motdepasse.'"'; 
						mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());


						$sql ='DELETE from projets WHERE id="'.$idmembre.'"'; 
						mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

						
						$sql ='DELETE from dataposts WHERE idmembre="'.$idmembre.'"'; 
						mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());    


						$sql ='DELETE from dataprojets WHERE idmembre="'.$idmembre.'"'; 
						mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());


						echo '	 <h4>Votre compte, ainsi que tous les projets que vous avez postés ont étés supprimés.</h4>'."\n";
						echo '	 <p><a href="'.$serveur.'Accueil%20%281%29.php">Retour à la page d'."'".'acceuil</a>.'."</p>";

					}
					else {
						if (!empty($_SESSION['pageCourante'])) header('Location: '.$_SESSION['pageCourante']);
						else header('Location: '.$serveur.'Accueil%20%281%29.php');

						echo '	 <p><a href="'.$serveur.'Accueil%20%281%29.php">Retour à la page d'."'".'acceuil</a>.'."</p>";

					}
				}   
			}
		}
	}

?>
  </body>
</html>



