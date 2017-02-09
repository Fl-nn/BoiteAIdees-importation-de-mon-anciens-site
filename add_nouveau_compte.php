<?php
	if(!defined ("INC")){
		
		header("location:?liste_noir");
		exit;
		
	}
	if (!isset ($_POST['add_personnage_bl'])){
					echo '<form method="post" action ="index.php?liste_noir"><p align="center"><input class="btn btn-lg btn-default" type="submit" name="add_personnage_bl" value="Ajouter un personnage non enregistré"/></p></form>';
				}
	if (isset ($_POST['add_personnage_bl'])){
	echo "<h3 align='center' class='text-danger'>Création du personnage...</h3>";
	?>
	<form method="post" class="form-inline" action ="index.php?liste_noir">
		<table class="table table-striped">
			<tr>
				<td><input type='text' class="form-control" placeholder="Pseudonyme" name="Pseudonyme"/></td>
				<td><input type='text' class="form-control" placeholder="Niveau" name="Niveau"/></td>
				<td><?php 
					$liste_guildes = $bdd->query('SELECT * FROM guildes');
					echo '<select name="ID_Guilde" class="selectpicker" data-live-search="true" title="Sélectionnez une guilde..." required>';
						while ( $donnees_liste_guildes = $liste_guildes->fetch(PDO::FETCH_ASSOC ))
							{
							echo '<option value=' .$donnees_liste_guildes['ID'].'>' .$donnees_liste_guildes['nom'].'</option>';
							}
					echo '</select>';
				?></td>
				<td><input id="recherche_liste_noir2" type='text'  class="form-control" placeholder="Autre pseudonyme lié" name="personne_liee"></td>
				<td><input align="center" class="btn btn-s btn-danger-outline" type="submit" name="add_new_personnage" value="Créer" /></td>
			</tr>
		</table>
	</form>
	<?php
	}
	if (isset ($_POST['add_new_personnage'])){
		$req = $bdd->query("SELECT ID_Membres_Liee FROM nom_personnage WHERE  Pseudonyme='".$_POST['Pseudonyme']."'");
		if(count($req->fetchAll(PDO::FETCH_ASSOC)) != 0) {
			echo "<h3 align='center' class='text-danger'>Pseudonyme non disponible, il est déjà utilisé! Veuillez faire une demande à un modérateur si vous être sûre qu'il n'est pas utilisé!</h3>";
		}
		else{
		if ($_POST['ID_Guilde']!=0) {
			if ((ctype_digit($_POST['Niveau'])) &&($_POST['Niveau']!="")) {
				if (preg_match("#^[a-z0-9]+$#i" , $_POST['Pseudonyme']))
				{
				    if ($_POST['personne_liee']=="") {
				    	$req = $bdd->prepare('INSERT INTO membres(user,rang,compte_inscrit) 
						VALUES(:user,:rang,:compte_inscrit)');
						$req->execute(array(
						'user' => $_POST['Pseudonyme'],
						'rang' => 0,
						'compte_inscrit' => 0
						));
						$personnage = $bdd->query("SELECT ID_membre FROM membres WHERE  user='".$_POST['Pseudonyme']."'");
						while ( $donnees_personnage = $personnage->fetch(PDO::FETCH_ASSOC) )
						{
							$req = $bdd->prepare('INSERT INTO nom_personnage(Pseudonyme,Niveau,Banni,ID_Membres_Liee,ID_Guilde) 
							VALUES(:pseudonyme,:niveau,:banni,:id_membre,:id_guilde)');
							$req->execute(array(
							'pseudonyme' => $_POST['Pseudonyme'],
							'niveau' => $_POST['Niveau'],
							'banni' => 0,
							'id_membre' => $donnees_personnage['ID_membre'],
							'id_guilde' => $_POST['ID_Guilde']
							));
						}
				    }
				    else{
				    	$req = $bdd->query("SELECT ID_Membres_Liee FROM nom_personnage WHERE  Pseudonyme LIKE '%".$_POST['personne_liee']."%' ORDER BY Pseudonyme ASC");
						if(count($req->fetchAll(PDO::FETCH_ASSOC)) == 0) {
							echo "<h3 align='center' class='text-danger'>Le personnage lié n'exsiste pas encore dans la base de données! Le lien est donc impossible!</h3>";
						}
						else
						{
							$personnage = $bdd->query("SELECT ID_Membres_Liee FROM nom_personnage WHERE Pseudonyme='".$_POST['personne_liee']."'");
							while ( $donnees_personnage = $personnage->fetch(PDO::FETCH_ASSOC) )
							{
								$req = $bdd->prepare('INSERT INTO nom_personnage(Pseudonyme,Niveau,Banni,ID_Membres_Liee,ID_Guilde) 
								VALUES(:pseudonyme,:niveau,:banni,:id_membre,:id_guilde)');
								$req->execute(array(
								'pseudonyme' => $_POST['Pseudonyme'],
								'niveau' => $_POST['Niveau'],
								'banni' => 0,
								'id_membre' => $donnees_personnage['ID_Membres_Liee'],
								'id_guilde' => $_POST['ID_Guilde']
								));
							}
						}
					}
				}
				else
				{

				     echo "<div class='alert alert-danger'>Impossible d'entrer des caractères spéciaux! Le champ doit être rempli!</div>";
				}
			}
			else
			{
				echo "<div class='alert alert-danger'>Le numéro doit être écrit en chiffre!</div>";
			}
		}
		else
		{
			echo "<div class='alert alert-danger'>Veuillez choisir une guilde</div>";
		}
	}
}
?>
