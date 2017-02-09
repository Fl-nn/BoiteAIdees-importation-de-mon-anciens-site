<?php
	
	if(!defined ("INC")){
		
		header("location:index.php?addguildes");
		exit;
	}
	include("connexion_bd.php");
	$liste_guildes = $bdd->query('SELECT * FROM guildes');
?>

<table class="table table-striped" align='center'>
	<tr>
		<td width='75%'>
			<fieldset><legend>Ajouter une guilde</legend>
				<form action='index.php?addguildes' method='POST'>
					<?php	
							echo '<table class="table table-striped">';								
							echo '<tr  class="success"><td>Nom de guilde</td><td>Meneur</td><td>Nombre de membres</td></tr>';
							echo '<form method="post" class="form-inline" action ="index.php?addguildes"><tr><td><input type="text" class="form-control" size="17" name="nom" value="" required/></td>';
							echo '<td>';
								$liste_perso = $bdd->query('SELECT * FROM nom_personnage');
								echo '<select name="ID_meneur" class="selectpicker" data-live-search="true" title="Sélectionnez un meneur..." required>';
									while ( $donnees_liste_perso = $liste_perso->fetch(PDO::FETCH_ASSOC ))
										{
										echo '<option value=' .$donnees_liste_perso['ID_Personnage'].'>' .$donnees_liste_perso['Pseudonyme'].'</option>';
										}
								echo '</select>';
							echo '</td>';

							echo '<td><input type="text" class="form-control" size="2" name="nombre_joueur" value="" required/></td><td align="center"></tr>';		
							echo '<tr><td><input class="btn btn-primary-outline btn-block" type="submit" name="addmore" value="Ajouter une de plus"/></td>';
							echo '<td><input class="btn btn-warning-outline btn-block" type="submit" name="addone" value="Ajouter et quitter"/></td>';
							echo '<td><input class="btn btn-secondary-outline btn-block	" type="submit" name="back" value="Annuler"/></td></tr></form>';
							echo '</table>';
					?>
				</form>
			</fieldset>
		</td>
		<td width="25%">
			<center>
				<?php
					if (isset ($_POST['addmore'])){
						if ((isset($_POST['nom'])) && (isset($_POST['ID_meneur'])) && (isset($_POST['nombre_joueur'])))
						{
							$var1=(isset($_POST['nom']))?$_POST['nom']:NULL;
							$var2=(isset($_POST['ID_meneur']))?$_POST['ID_meneur']:NULL;
							$var3=(isset($_POST['nombre_joueur']))?$_POST['nombre_joueur']:NULL;
							
							$ok=1;
						} 
						else {}
						if($ok==1){
							$req = $bdd->prepare('INSERT INTO guildes(nom,ID_meneur,nombre_joueur)
							VALUES(:nom,:ID_meneur,:nombre_joueur)');
							$req->execute(array(
								'nom'=>$var1,
								'ID_meneur'=>$var2,
								'nombre_joueur'=>$var3
								)); 
								}
						$_POST['nom']=null;$_POST['ID_meneur']==null;$_POST=null;				
						$liste_guildes = $bdd->query('SELECT * FROM guildes');
						echo '<div class="alert alert-success"><strong>Succes!</strong>La mise à jour est une reussite!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
			
					}
					if (isset ($_POST['addone'])){

						if ((isset($_POST['nom'])) && (isset($_POST['ID_meneur'])) && (isset($_POST['nombre_joueur'])))
						{
							$var1=(isset($_POST['nom']))?$_POST['nom']:NULL;
							$var2=(isset($_POST['ID_meneur']))?$_POST['ID_meneur']:NULL;
							$var3=(isset($_POST['nombre_joueur']))?$_POST['nombre_joueur']:NULL;
							
							$ok=1;
						} 
						else {}
						if($ok==1){
							$req = $bdd->prepare('INSERT INTO guildes(nom,ID_meneur,nombre_joueur)
							VALUES(:nom,:ID_meneur,:nombre_joueur)');
							$req->execute(array(
								'nom'=>$var1,
								'ID_meneur'=>$var2,
								'nombre_joueur'=>$var3
								)); 
								}
						$_POST['nom']=null;$_POST['ID_meneur']==null;$_POST=null;
						echo '<div class="alert alert-success"><strong>Succes!</strong>La mise à jour est une reussite!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
			
						echo "<h5 align='center' class='text-muted'>Vous allez être redirigé...</h5>";	

						$liste_guildes = $bdd->query('SELECT * FROM guildes');						
						header('refresh:3;url=index.php?guildes');
					}
					if (isset($_POST['back'])){						
						header('refresh:1;url=index.php?guildes');
					}
					echo '<fieldset><legend>Liste de guildes déjà créé</legend>';
					while ( $donnees_liste_guildes = $liste_guildes->fetch(PDO::FETCH_ASSOC ))
							{
								echo $donnees_liste_guildes['nom'];
								echo '<br/>';
							}
					echo '</fieldset>';
				?>
			</center>
		</td>
	</tr>
</table>