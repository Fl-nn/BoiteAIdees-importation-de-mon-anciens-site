<?php
	if(!defined ("INC")){
		
		header("location:?ajout_compte");
		exit;
		
	}
	echo "<h3 align='center' class='text-danger'>Création du compte..</h3>";
	?>
	<form method="post" class="form-inline" action ="index.php?ajout_compte">
		<table class="table table-striped">
			<tr>
				<td><input type='text' class="form-control" placeholder="Nom de compte" name="nom_de_compte" required/></td><td><input id="recherche_liste_noir" type='text'  class="form-control" placeholder="Autre compte lié" name="personne_rechercher"></td>
				<td>
					<select name="ID_Guilde" class="selectpicker"  title="Statut par défaut..." required>';
							<option value="0">Safe</option>
							<option value="1">Mute</option>
							<option value="2">Banni</option>
					</select>
				</td>
				<td><textarea COLS=40 ROWS=4 name="raison" placeholder="Raison du ban / Commentaire" class="form-control"  required></textarea></td>
				<td></td>
				<td><input align="center" class="btn btn-s btn-danger-outline" type="submit" name="add_new_personnage" value="Créer" /></td>
			</tr>
		</table>
	</form>
	<?php
	if (isset ($_POST['add_new_personnage'])){
		$req = $bdd->query("SELECT ID_Membre_Liee FROM nom_de_compte WHERE  Nom_Compte='".$_POST['nom_de_compte']."'");
		if(count($req->fetchAll(PDO::FETCH_ASSOC)) != 0) {
			echo '<div class="alert alert-danger"><strong>Echec! </strong>Le nom de compte est déjà utilisé!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
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

				     echo "<div class='alert alert-danger'>Impossible d'entrer des caractères spéciaux! Le champ doit être rempli!<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
				}
			}
			else
			{
				echo "<div class='alert alert-danger'>Le numéro doit être écrit en chiffre!<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
			}
		}
		else
		{
			echo "<div class='alert alert-danger'>Veuillez choisir une guilde<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
		}
	}
}
?>
