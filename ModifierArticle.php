﻿<?php session_start();
	include 'Fonctions/AdresseServeur.php';
	if (empty($_SESSION['id'])) $_SESSION['id']=80;
	if (empty($_SESSION['motdepasse'])) $_SESSION['motdepasse']=80;
	if (empty($_SESSION['style'])) $_SESSION['style']=1;
?>
<!DOCTYPE html>
  <html lang="fr" >
  <head>
    <title>Modification d'un article</title>
    <meta charset="utf-8" />
<?php
	include 'Fonctions/includeStylesheet.php';
?>
  </head>
  <body>

<?php

	include 'MenuAccueil.php';
	include 'Fonctions/AdresseServeur.php';

	if (VerifieConnection()) {
		if (!empty($_GET)) {
			$idarticle = $_GET['idarticle'];
		}else $idarticle = "non identifié";
		
		
		include 'Fonctions/ConnectionBaseDonnees.php';
		
		$connexion = mysql_pconnect($server,$user,$motdepasse) ;
		if (!$connexion) {
			echo "Pas de connexion au serveur" ;
		}else {
			if (!mysql_select_db($base, $connexion)) {
				echo "Pas d'accès à la base" ;
			}else {

				$requete1 = 'SELECT * FROM posts WHERE idpost="'.$idarticle.'"';
				$resultat1 = mysql_query($requete1,$connexion) ;
				$ligne1 = mysql_fetch_array($resultat1);

				$date = date("dmY");
				$heure = date("His");

				if (empty($_POST)) {

					//echo $idarticle;

					//echo '"http://localhost/Projet1/ModifierArticle.php?idarticle='.$idarticle;

					echo '	 <form action="'.$serveur.'ModifierArticle.php?idarticle='.$idarticle.'" method="POST">
	  <label>Objet : <input type="text" value="'.$ligne1['Objet'].'" disabled></label><br>
	  <label><p>Contenu de l'."'".'article : </p><textarea rows="25" cols="82" name="article" autofocus>'.$ligne1['Post'].'</textarea></label><br>
	  <input type="submit" value="modifier">
	 </form>'."\n";

					if (!empty($_SESSION['pageCourante'])) echo '<a href="'.$_SESSION['pageCourante'].'">Annuler</a>'."\n";

				}else {

					if($_SERVER["HTTP_REFERER"] !== $serveur."ModifierArticle.php?idarticle=".$idarticle) {
						echo "	<h1>Attention</h1>\n	<h4>Le formulaire est soumis depuis une source externe !</h4>";
					}
					
					else if(empty($_POST["article"])) {	
						echo "<h4>Veuillez entrer quelque chose, ou quitter cette page.</h4>";
					}

					else {
						$sql = 'UPDATE posts SET Post="'.htmlspecialchars($_POST['article']).'" WHERE idpost="'.$idarticle.'"';
						mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
						
						$sql = 'INSERT INTO dataposts (idauteur, idmembre,date,heure,idpost) VALUES ("'.$ligne1['id'].'","'.$_SESSION['id'].'","'.$date.'","'.$heure.'","'.$idarticle.'")';
						mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

						if (!empty($_SESSION['pageCourante'])) header('Location: '.$_SESSION['pageCourante']);
						else header('Location: '.$serveur.'Accueil%20%281%29.php');

						echo '<h4>L'."'".'article a été modifié.</h4>'."\n".'<p>Pour le voir, visitez la page <a href="'.$serveur.'Accueil%20%281%29.php">d'."'".'acceuil</a>.</p>';

					}
				}
			}
		}

	}

	include 'Fonctions/footer.php';