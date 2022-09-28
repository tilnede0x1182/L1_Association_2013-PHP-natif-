<?php session_start();
	include 'Fonctions/AdresseServeur.php';
	if (empty($_SESSION['id'])) $_SESSION['id']=80;
	if (empty($_SESSION['motdepasse'])) $_SESSION['motdepasse']=80;
	if (!empty($_SESSION['pageCourante'])) if (substr($_SESSION['pageCourante'],0,43)!=$serveur."AfficheArticle.php") $pageprecedente = $_SESSION['pageCourante'];
	else $pageprecedente = "";
	$_SESSION['pageCourante']=$serveur."AfficheArticle.php";
	if (empty($_SESSION['style'])) $_SESSION['style']=1;
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Article de </title>
<?php
	include 'Fonctions/includeStylesheet.php';
?>
  </head>

  <body>

<?php
	include 'Fonctions/AdresseServeur.php';

	if (!empty($_GET['idpost'])) $idpost = $_GET['idpost'];
	else $idpost = "incunnu";

	$_SESSION['pageCourante']=$serveur."AfficheArticle.php?idpost=".$idpost."";

	$un=1;

	include 'MenuAccueil.php';
	include 'Fonctions/detectlId.php';
	include 'Fonctions/ConversionDate.php';

	include 'Fonctions/ConnectionBaseDonnees.php';

	$connexion = mysql_pconnect($server,$user,$motdepasse) ;

	if (!$connexion) {
		echo "Pas de connexion au serveur" ;
	}else {
		if (!mysql_select_db($base, $connexion)) {
			echo "Pas d'accès à la base" ;
		}else {

			$requete1 = 'SELECT * FROM posts WHERE idpost="'.$idpost.'"';
			$resultat1 = mysql_query($requete1,$connexion);

			include 'Fonctions/VerifieCompetence.php';

			if ($competence==1) {

			echo '    <table border="1">
			      <tr>
			        <th>Auteurs et dates de modification</th>
			        <th>Contenu de l'."'".'article</th>'."\n";
			echo '   <th>Modifications</th>'."\n";
			echo '      </tr>';

				$ligne = mysql_fetch_array($resultat1);

				//echo '$ligne['."'".'idpost'."'".'] = '.$ligne['idpost']."<br>\n";

				$idpost=$ligne['idpost'];

				$requete2 = 'SELECT idmembre, date FROM dataposts WHERE idpost="'.$idpost.'" ORDER BY date DESC';
				$resultat2 = mysql_query($requete2,$connexion);

				$dataposts = mysql_fetch_array($resultat2);

				if ($dataposts!=false) $affdataposts = "<br>Dernière modification : <br>\n".'<a href="'.$serveur.'InformationMembre.php?idmembre='.$dataposts['idmembre'].'">'.$dataposts['idmembre']."</a> (".convertDate($dataposts['date']).")<br>";
				else $affdataposts="";

				if (!empty($ligne['Objet'])) $titrearticle = "<h4>".$ligne['Objet']." : </h4>";
				else $titrearticle = "";

				echo "\n<tr>";
				echo "<td>".$affdataposts."<br>\nPublication : \n<br>".'<a href="'.$serveur.'InformationMembre.php?idmembre='.$ligne['id'].'">'.$ligne['id']."</a> (".convertDate($ligne['date']).") \n";
				if ($affdataposts!="") echo '<br><br><a href="'.$serveur.'ListeAuteursPost.php?idpost='.$idpost.'">Afficher la liste</a>&nbsp;&nbsp;</td>'."\n";					
				echo "<td>".$titrearticle."".nl2br(detectlId ($ligne['Post']),false)."</td>\n";

				echo '<td><a href="'.$serveur.'ModifierArticle.php?idarticle='.$idpost.'">modifier</a><br><br><br>'."\n".'<a href="'.$serveur.'SupprimerArticle.php?idpost='.$idpost.'">supprimer</a></td>';

				echo "      </tr>\n";
							

			echo '    </table>';

			} else {

			$requete5 = 'SELECT Post, Objet, date, id FROM posts ORDER by date DESC';
			$resultat5 = mysql_query($requete5,$connexion);

			echo '    <table border="1">
			      <tr>
			        <th>Auteur</th>
			        <th>Contenu de l'."'".'article</th>
			        <th>Date de publication</th>
			      </tr>';

				$ligne = mysql_fetch_array($resultat5);

				if (!empty($ligne['Objet'])) $titrearticle = "<h4>".$ligne['Objet']." : </h4>";
				else $titrearticle = "";
	
				echo "\n<tr>";
	
					echo "<td>".'<a href="'.$serveur.'InformationMembre.php?idmembre='.$ligne['id'].'">'.$ligne['id']."</a></td>\n";
					echo "<td>".$titrearticle."".nl2br(detectlId ($ligne['Post']), false)."</td>\n";
					echo "<td>".convertDate($ligne['date'])."</td>\n";
	
					echo "      </tr>\n";
			}

			echo '    </table>'."\n";
			
			if ($pageprecedente!="") echo '	 <p><a href="'.$pageprecedente.'">Retour</a></p>';

			//echo '	 <p><a href="'.$serveur.'ListeCompletePosts.php">Liste des articles</a></p>';
		}
	}

	include 'Fonctions/footer.php';

?>

  </body>
</html>
