﻿<?php

		$g=0;

		include 'Fonctions/AdresseServeur.php';
		include 'Fonctions/includeStylesheet.php';

		//if($_SERVER["HTTP_REFERER"] !== $serveur."Projet1/Accueil%20%281%29.php") {
		//	echo "	<h1>Attention</h1>\n	<h4>Le formulaire est soumis depuis une source externe !</h4>";
		//}
		
		//else 
		if(empty($_POST["id"]) || empty($_POST["motdepasse"])) {
		    	echo "<p>Entrez votre identifiant et votre mot de passe.</p>";
		}
		
		else if((!preg_match('/^[a-zA-Z0-9-_]+$/', $_POST["id"])) || (!preg_match('/^[a-zA-Z0-9-_]+$/', $_POST["motdepasse"]))) {
			echo "<h1>Erreur</h1><h4>L'un des champs entrés contiens des caractères spéciaux ou accentués.</h4>";
		}
		
		else {
			$g=1;

		    	$_SESSION['id']=$_POST['id'];
		    	$_SESSION['motdepasse']=$_POST['motdepasse'];

			if (verifieConnection()) {
				echo '<h4>La connection s'."'".'est bien passée.</h4>';
				echo '<p><a href="'.$serveur.'Accueil%20%281%29.php">Retour à la page d'."'".'accueil</a></p>';
			

				include 'Fonctions/ConnectionBaseDonnees.php';

				$connexion = mysql_pconnect($server,$user,$motdepasse) ;

				if (!$connexion) {
					echo "Pas de connexion au serveur" ;
				}else {
					if (!mysql_select_db($base, $connexion)) {
						echo "Pas d'accès à la base" ;
					}else {
	
						$date = date("dmY");
						//echo $date;
	
						$sql = 'UPDATE asso SET datedederniereconnection="'.$date.'" WHERE id="'.$_SESSION['id'].'" AND motdepasse="'.$_SESSION['motdepasse'].'"';
						mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
	
	
						$sql = 'UPDATE asso SET Connecte="1" WHERE id="'.$_SESSION['id'].'" AND motdepasse="'.$_SESSION['motdepasse'].'"';
						mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
					}
				}

			}

			else $g=0;
		}
	
		if ($g==0) {
			echo '    <div class="Accès membres">
		    <p>Accès membres : </p>
		
		    <form action="Connection1.php" method="POST">
			Identifiant : <input type="text" name="id"><br>
			Mot de passe : <input type="password" name="motdepasse"><br>
			<input type="submit" value="Se connecter"><br>
			<a href="'.$serveur.'NouveauMembre3.php">S'."'inscrire</a>
		    </form>
		    </div>";

		if (!empty($_SESSION['pageCourante'])) echo '<p><a href="'.$_SESSION['pageCourante'].'">Retour</a></p>';

		echo '<p><a href="'.$serveur.'Accueil%20%281%29.php">Aller à la page d'."'".'accueil</a></p>';

		}
?>