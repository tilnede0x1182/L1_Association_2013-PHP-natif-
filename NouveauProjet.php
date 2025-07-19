﻿<?php session_start();
	include 'Fonctions/AdresseServeur.php';
	if (empty($_SESSION['id'])) $_SESSION['id']=80;
	if (empty($_SESSION['motdepasse'])) $_SESSION['motdepasse']=80;
	$_SESSION['pageCourante']=$serveur."NouveauProjet.php";
	if (empty($_SESSION['style'])) $_SESSION['style']=1;
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Nouveau Projet</title>
<?php
	include 'Fonctions/includeStylesheet.php';
?>
  </head>

  <body>

<?php
	include 'MenuAccueil.php';
	include 'Fonctions/detectlId.php';
	include 'Fonctions/ConversionDate.php';
	include 'Fonctions/AdresseServeur.php';

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

				$requete = 'SELECT * FROM projets ORDER by date DESC, heure DESC';
				$resultat = mysql_query($requete,$connexion);

				echo '    <table border="1">
				<tr>
					<th>Auteur</th>
					<th>Derniers projets</th>
					<th>Date de publication</th>
				<th>Modification</th>
				</tr>';

				$tmp=0;

				while (true) {
					$tmp=$tmp+1;
					$ligne = mysql_fetch_array($resultat);

					if (($ligne==false) || ($tmp>15)) break;

					$idmembre = $ligne['id'];
					$idprojet = $ligne['idprojet'];
					
					echo "\n<tr>";
					
					echo "<td>".'<a href="'.$serveur.'InformationMembre.php?idmembre='.$ligne['id'].'">'.$ligne['id']."</a></td>\n";
					echo "<td><h4>".$ligne['Objet']." : <br></h4>".nl2br(detectlId ($ligne['Texte']), false)."</td>\n";
					echo "<td>".substr($ligne["date"],0,2)."/".substr($ligne["date"],2,2)."/".substr($ligne["date"],4,4)."</td>\n";
					if ($idmembre==$_SESSION['id']) echo '<td><div class="lien"><a href="'.$serveur.'ModifierProjet.php?idprojet='.$idprojet.'">modifier</a></div><br><br><br>'."\n".'<div class="lien"><a href="'.$serveur.'SupprimerProjet.php?idprojet='.$idprojet.'">supprimer</a></div></td>';
					else echo "<td></td>";
					
					echo "      </tr>\n";
				}

				echo '    </table>';
				
			}

		}

		echo'    <p><div class="lien"><a href="'.$serveur.'CreationNouveauProjet.php">Nouveau projet</a></p></div>    
		</body>';

	}

	include 'Fonctions/footer.php';

?>

</html>
