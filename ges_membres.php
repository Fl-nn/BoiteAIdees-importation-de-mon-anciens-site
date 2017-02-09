<?php
if(!defined ("INC")){
	
	header("location:?membres");
	exit;
	
}
?>
<div class="ui-widget" align="center">
	<form class="form-inline" action='index.php?membres' method='POST'>
		<p class='text-muted'>Recherchez un pseudonyme :<input id="recherche_liste_noir" type='text'  class="form-control" placeholder="Pseudonyme" name="personne_rechercher">	<input align="center" class="btn btn-xs btn-info-outline" type="submit" name="send" value="rechercher" /></p>
	</form>
</div>
<br/>

<?php

include('add_nouveau_membres.php');
if (isset($_POST['delete'])){
	$personnage = $bdd->query("DELETE FROM nom_personnage WHERE ID_Personnage='".$_POST['personne_selectionne']."'");
	echo '<div class="alert alert-success"><strong>Succes!</strong>La mise à jour est une reussite!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
			
}
if (isset($_POST['valider']))
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
				
					$req2 = $bdd->prepare('UPDATE nom_personnage SET Pseudonyme=?, Niveau=?, ID_Guilde=?  WHERE ID_Personnage=?');
					$req2->execute(array($_POST['Pseudonyme'],$_POST['Niveau'],$_POST['ID_Guilde'],$_POST['personne_selectionne']));
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
	if(! isset($_POST['send'])){
		echo '<fieldset><legendListe des personnages</legend>';	
		echo '<table class="table table-striped">';								
		echo '<tr  class="success"><td></td><td>Nom du personnage</td><td>Nom de guilde</td><td>Niveau</td><td></td><td align="center"></td><td></td><td></td></tr>';
		$i=1;								
	
		$liste_personnage = $bdd->query('SELECT * FROM nom_personnage JOIN guildes ON guildes.ID=nom_personnage.ID_Guilde ');
		while ( $donnees = $liste_personnage->fetch(PDO::FETCH_ASSOC ))
		{	
			echo '<form method="post" action ="?membres"><tr><td>'.$i.'</td><td>'.$donnees['Pseudonyme'].'</td><td>'.$donnees['nom'].'</td><td>'.$donnees['Niveau'].'</td><td>';if($donnees['Banni']==0){echo '';}else{echo 'Banni';}echo'</td><td align="center"><input type="hidden" name="personne_selectionne" value="'.$donnees['ID_Personnage'].'" /> <input class="btn btn-info btn-s" type="submit" name="modifier" value="Modifier"/>';?></td><td><input class="btn btn-danger btn-s" type="submit" name="delete" value="Supprimer" onclick="return confirm('Confimation de la suppression.')"/><?php echo '</td></tr></form>';
		$i++;
		}		
	
	
		echo '</table>';
		echo '</fieldset>';
	}
	else
	{
		echo '<fieldset><legendListe des personnages</legend>';	
			echo '<table class="table table-striped">';								
				echo '<tr  class="success"><td></td><td>Nom du personnage</td><td>Nom de guilde</td><td>Niveau</td><td></td><td align="center"></td><td></td><td></td></tr>';
				$i=1;								
			
				$liste_personnage = $bdd->query("SELECT * FROM nom_personnage JOIN guildes ON guildes.ID=nom_personnage.ID_Guilde  WHERE  Pseudonyme LIKE'%".$_POST['personne_rechercher']."%' ORDER BY Pseudonyme ASC");
				while ( $donnees = $liste_personnage->fetch(PDO::FETCH_ASSOC ))
				{	
					echo '<form method="post" action ="?membres"><tr><td>'.$i.'</td><td>'.$donnees['Pseudonyme'].'</td><td>'.$donnees['nom'].'</td><td>'.$donnees['Niveau'].'</td><td>';if($donnees['Banni']==0){echo '';}else{echo 'Banni';}echo'</td><td align="center"><input type="hidden" name="personne_selectionne" value="'.$donnees['ID_Personnage'].'" /> <input class="btn btn-info btn-s" type="submit" name="modifier" value="Modifier"/>';?></td><td><input class="btn btn-danger btn-s" type="submit" name="delete" value="Supprimer" onclick="return confirm('Confimation de la suppression.')"/><?php echo '</td></tr></form>';
				$i++;
				}		
			
			
			echo '</table>';
		echo '</fieldset>';
	}
}
if( isset($_POST['modifier'])){
	$l_personnage = $bdd->query('SELECT * FROM nom_personnage WHERE ID_Personnage='.$_POST['personne_selectionne'].' ');
		while ( $donnees = $l_personnage->fetch(PDO::FETCH_ASSOC ))
		{
			echo "<h3 align='center' class='text-danger'>Modification du personnage</h3>";
			?>
			<form method="post" class="form-inline" action ="?membres">
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