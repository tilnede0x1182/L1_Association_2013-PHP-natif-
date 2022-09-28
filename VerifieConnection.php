<?php
	function verifieConnection() {

		include 'Fonctions/ConnectionBaseDonnees.php';
	
		$connexion = mysql_pconnect($server,$user,$motdepasse) ;
		if (!$connexion) {
			echo "Pas de connexion au serveur" ;
		}else {
			if (!mysql_select_db($base, $connexion)) {
				echo "Pas d'accès à la base" ;
			}else {
	
				$requete = 'SELECT id,motdepasse FROM asso WHERE id="'.$_SESSION['id'].'"';
				$resultat = mysql_query($requete,$connexion);
	
				$ligne = mysql_fetch_array($resultat);


				//echo "<p>id = ".$_SESSION['id']."\n<br>Mot de passe = ".$_SESSION['motdepasse']."</p>";
	
				if ($ligne==false) {
					//echo "<h4>L'utilisateur n'existe pas.</h4>";
					return false;
				}

				//echo "<p>id = ".$ligne['id']."\n<br>Mot de passe = ".$ligne['motdepasse']."</p>";

				if ($ligne['id']!=$_SESSION['id']) return false;
	
				if ($ligne['motdepasse']!=$_SESSION['motdepasse']) return false;
	
				return true;			
			}
		}
	}

?>