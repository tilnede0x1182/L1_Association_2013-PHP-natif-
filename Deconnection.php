<?php
	session_start();

	include 'VerifieConnection.php';
	include 'Fonctions/AdresseServeur.php';

	if (VerifieConnection()) {


		include 'Fonctions/ConnectionBaseDonnees.php';

		$connexion = mysql_pconnect($server,$user,$motdepasse) ;

		if (!$connexion) {
			echo "Pas de connexion au serveur" ;
		}else {
			if (!mysql_select_db($base, $connexion)) {
				echo "Pas d'accès à la base" ;
			}else {
				$sql = 'UPDATE asso SET Connecte="0" WHERE id="'.$_SESSION['id'].'" AND motdepasse="'.$_SESSION['motdepasse'].'"';
				mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
			}
		}	

		$_SESSION['id']=80;
		$_SESSION['motdepasse']=80;
	
	 	echo '<h4>La déconnection s'."'".'est bien passée.</h4>';

		if (!empty($_SESSION['pageCourante'])) header('Location: '.$_SESSION['pageCourante']);
		else header('Location: '.$serveur.'Accueil%20%281%29.php');
	
		if (!empty($_SESSION['pageCourante'])) echo '<p><a href="'.$_SESSION['pageCourante'].'">Retour</a></p>';
	
		echo '<p><a href="'.$serveur.'Accueil%20%281%29.php">Aller à la page d'."'".'accueil</a></p>';

		//if (!empty($_SESSION['pageCourante'])) include $_SESSION['pageCourante'];

	}

?>
	