<?php
if(!defined ("INC")){
	
	header("location:?perso");
	exit;
	
}

if (isset($_POST['delete'])){
	$personnage = $bdd->query("DELETE FROM nom_personnage WHERE ID_Personnage='".$_POST['personne_selectionne']."'");
	echo '<div class="alert alert-success"><strong>Succes!</strong>La mise à jour est une reussite!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
			
}
if (isset($_POST['valider_ajout']) || isset($_POST['valider']))
{
	if (isset($_POST['ex_Pseudonyme'])){
		$req = $bdd->query("SELECT ID_Membres_Liee FROM nom_personnage WHERE  Pseudonyme='".$_POST['Pseudonyme']."' AND Pseudonyme<>'".$_POST['ex_Pseudonyme']."'");
	}
	else
	{
		$req = $bdd->query("SELECT ID_Membres_Liee FROM nom_personnage WHERE  Pseudonyme='".$_POST['Pseudonyme']."' ");
	}
	if(count($req->fetchAll(PDO::FETCH_ASSOC)) != 0) {
		echo '<div class="alert alert-danger"><strong>Champs Niveau invalide</strong>Pseudonyme non disponible, il est déjà utilisé! Veuillez faire une demande à un modérateur si vous être sûre qu\'il n\'est pas utilisé!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';	
	}
	else
	{
		if ((ctype_digit($_POST['Niveau'])) &&($_POST['Niveau']!="") &&($_POST['Niveau']<=200)) {
			if (preg_match("#^[a-zA-Z0-9\-]+$#i" , $_POST['Pseudonyme']))
			{
				if (isset($_POST['valider_ajout'])){
					$personnage = $bdd->query("SELECT ID_membre FROM membres WHERE user='".$_SESSION['user']."'");
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
				else
				{
					$req2 = $bdd->prepare('UPDATE nom_personnage SET Pseudonyme=?, Niveau=?, ID_Guilde=?  WHERE ID_Personnage=?');
					$req2->execute(array($_POST['Pseudonyme'],$_POST['Niveau'],$_POST['ID_Guilde'],$_POST['personne_selectionne']));
				}
				
				echo '<div class="alert alert-success"><strong>Succes!</strong>La mise à jour est une reussite!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
			}
			else
			{
				echo '<div class="alert alert-danger"><strong>Champs Pseudonyme invalide</strong>Vous utilisez des caractères interdit!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
			}
		}
		else
		{
			echo '<div class="alert alert-danger"><strong>Champs Niveau invalide</strong>Le niveau doit être un chiffre ; il ne doit pas dépasser 200 et être inférieur à 0 ; le champs ne peut pas être vide<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
			
		}
	}
	
}
if(! isset($_POST['modifier'])){
	$personnage = $bdd->query("SELECT ID_membre FROM membres WHERE user='".$_SESSION['user']."'");
	echo '<fieldset><legendListe de vos personnages</legend>';	
					echo '<table class="table table-striped">';								
					echo '<tr  class="success"><td></td><td>Nom du personnage</td><td>Nom de guilde</td><td>Niveau</td><td></td><td align="center"></td><td></td><td></td></tr>';
					$i=1;								
				while ( $donnees_personnage = $personnage->fetch(PDO::FETCH_ASSOC) )
				{
					$liste_personnage = $bdd->query('SELECT * FROM nom_personnage JOIN guildes ON guildes.ID=nom_personnage.ID_Guilde WHERE ID_Membres_Liee='.$donnees_personnage['ID_membre'].' ');
					while ( $donnees = $liste_personnage->fetch(PDO::FETCH_ASSOC ))
					{	
						echo '<form method="post" action ="index.php?perso"><tr><td>'.$i.'</td><td>'.$donnees['Pseudonyme'].'</td><td>'.$donnees['nom'].'</td><td>'.$donnees['Niveau'].'</td><td>';if($donnees['Banni']==0){echo '';}else{echo 'Banni';}echo'</td><td align="center"><input type="hidden" name="personne_selectionne" value="'.$donnees['ID_Personnage'].'" /> <input class="btn btn-info btn-s" type="submit" name="modifier" value="Modifier"/>';?></td><td><input class="btn btn-danger btn-s" type="submit" name="delete" value="Supprimer" onclick="return confirm('Confimation de la suppression.')"/><?php echo '</td></tr></form>';
					$i++;
					}		
				}
				
					echo '</table>';
					echo '</fieldset>';

				if (!isset ($_POST['add_personnage'])){
					echo '<form method="post" action ="index.php?perso"><p align="center"><input class="btn btn-default" type="submit" name="add_personnage" value="Ajouter un personnage"/></p></form>';
				}
}
if( isset($_POST['modifier'])){
	$l_personnage = $bdd->query('SELECT * FROM nom_personnage WHERE ID_Personnage='.$_POST['personne_selectionne'].' ');
		while ( $donnees = $l_personnage->fetch(PDO::FETCH_ASSOC ))
		{
			echo "<h3 align='center' class='text-danger'>Modification du personnage</h3>";
			?>
			<form method="post" class="form-inline" action ="index.php?perso">
				<table class="table table-striped">
					<tr><?php
					
						echo'<td><input type="hidden" name="ex_Pseudonyme" value="'.$donnees['Pseudonyme'].'" /><input type="text" class="form-control" placeholder="Pseudonyme" name="Pseudonyme" value="'.$donnees['Pseudonyme'].'" required/></td>';
						echo'<td><input type="text" class="form-control" placeholder="Niveau" name="Niveau" value="'.$donnees['Niveau'].'" required/>';
						?></td>
						<td><?php 
							$liste_guildes = $bdd->query('SELECT * FROM guildes');
							echo '<select name="ID_Guilde" class="selectpicker" data-live-search="true" title="Sélectionnez une guilde..." required>';
								while ( $donnees_liste_guildes = $liste_guildes->fetch(PDO::FETCH_ASSOC ))
									{
									echo '<option value=' .$donnees_liste_guildes['ID'].'>' .$donnees_liste_guildes['nom'].'</option>';
									}
							echo '</select>';
							echo '</td><td>';
							if($donnees['Banni']==0){echo '';}else{echo 'Banni';}
						?></td>
						<?php echo '<td align="center"><input type="hidden" name="personne_selectionne" value="'.$donnees['ID_Personnage'].'" />'; ?><input class=" btn-info-outline btn btn-s" type="submit" name="valider" value="Ajouter"/></td><td><input class=" btn btn-secondary-outline btn-s" type="submit" name="annuler" value="Annuler"/></td>
					</tr>
				</table>
			</form><?php
		}			
	
}
if (isset ($_POST['add_personnage'])){
	echo "<h3 align='center' class='text-danger'>Création du personnage...</h3>";
	?>
	<form method="post" class="form-inline" action ="index.php?perso">
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
				<td align="center"><input class=" btn-info-outline btn btn-s" type="submit" name="valider_ajout" value="Ajouter"/></td><td><input class=" btn btn-secondary-outline btn-s" type="submit" name="annuler" value="Annuler"/></td>
			</tr>
		</table>
	</form>
<?php
}
?>
