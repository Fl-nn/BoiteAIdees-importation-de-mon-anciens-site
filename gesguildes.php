<?php
	
	if(!defined ("INC")){
		
		header("location:index.php?guildes");
		exit;
	}
	include("connexion_bd.php");
	$liste_guildes = $bdd->query('SELECT * FROM guildes');
	if (isset($_POST['delete'])){
	$guilde_clear = $bdd->query("DELETE FROM guildes WHERE ID='".$_POST['guilde_selectionne']."'");
	$personnages_refresh= $bdd ->query('UPDATE nom_personnage SET ID_Guilde=6  WHERE ID_Guilde='.$_POST['guilde_selectionne'].'');
		echo '<div class="alert alert-danger"><strong>Suppression réussi!</strong>La guilde à bien été supprimé!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
	}
	if (isset($_POST['valider'])){
						$req2 = $bdd->prepare('UPDATE guildes SET nom=?, ID_meneur=?, nombre_joueur=?  WHERE ID=?');
						$req2->execute(array($_POST['nom'],$_POST['ID_meneur'],$_POST['nombre_joueur'],$_POST['id']));
						echo "<h1 align='center' class='text-danger'>La mise à jour est une réussite!</h1>";
						echo "<h3 align='center' class='text-muted'>Vous allez être redirigé...</h3>";
						header('refresh:1;url=index.php?guildes');
					}
?>

<table class="table table-striped" align='center'>
	<tr>
		<td width='45%'>
			<div class="panel panel-warning">
				<div class="panel-heading">Rechercher une guilde</div>
				<div class="panel-body">
					<form  class="form-inline" action='index.php?guildes' method='POST'>
					<div class="col-sm-25">
					    <div class="input-group has-warning has-feedback">
					      <input type="text" name="nom" id="recherche_guilde" id="inputWarning"  class="form-control left-rounded">
					      <span class="input-group-btn"><input align="center" class=" btn btn-warning-outline"type="submit" value="Rechercher"/></span>
					    </div>
					  </div>
				</form>
				</div>
		    </div>
		    <?php 
		    if (isset ($_POST['guilde_selectionne'])){
		    ?>
		    <div class="panel panel-warning"><?php
		    	$req = $bdd->prepare('SELECT nom, ID FROM guildes WHERE ID = ?');
				$req->execute(array($_POST['guilde_selectionne']));
				while ( $donnees_guilde = $req->fetch() )
				{
					?>
					<div class="panel-heading">Modification de la guilde "<?php echo $donnees_guilde['nom'];?>"</div>
					<div class="panel-body">
						<form  class="form-inline" action='index.php?guildes' method='POST'>
						<div class="col-sm-15">
						    <div class="input-group has-warning has-feedback"><?php
						     $guilde = $bdd->query('SELECT * FROM guildes WHERE ID='.$donnees_guilde['ID'].'');
								while ( $donnees = $guilde->fetch(PDO::FETCH_ASSOC ))
								{	echo '<table>';
									echo '<form method="post" class="form-inline" action ="index.php?guildes"><tr><td><input class="form-control" type="text" size="17" name="nom" value="'.$donnees['nom'].'" required/></td>';
									echo '<td>';
										$liste_perso = $bdd->query('SELECT * FROM nom_personnage');
										echo '<select name="ID_meneur" class="selectpicker" data-live-search="true" title="Sélectionnez un meneur..." required>';
											while ( $donnees_liste_perso = $liste_perso->fetch(PDO::FETCH_ASSOC ))
												{
												echo '<option value=' .$donnees_liste_perso['ID_Personnage'].'>' .$donnees_liste_perso['Pseudonyme'].'</option>';
												}
										echo '</select>';
									echo '</td>';
									echo '<td><input type="text" size="2" name="nombre_joueur" class="form-control" value="'.$donnees['nombre_joueur'].'" /></td></tr><tr><td align="center"><input type="hidden" name="id" value="'.$donnees['ID'].'" /> <input class="btn btn-info btn-xs" type="submit" name="valider" value="Valider"/></td></tr></table></form>';
									
								}	
						    ?></div>
						  </div>
					</form>
					</div>
		    		</div>
		    		<?php
				}
			}
		    		?>

		</td>
		<td width="55%">
			<center>
				<?php
					if (isset ($_POST['nom']) && ($_POST['nom']!="" )){
							$req = $bdd->prepare('SELECT ID FROM guildes WHERE nom = ?');
							$req->execute(array($_POST['nom']));
							if(count($req->fetchAll()) == 0) {
								echo '<div class="panel panel-danger">';
							      echo '<div class="panel-heading">Recherche pour '.$_POST['nom'].'</div>';
							      echo '<div class="panel-body">Il n\'y a pas de guilde du nom de '.$_POST['nom'].'!</div>';
							    echo '</div>';
							}
							else
							{
							echo '<div class="panel panel-info">';
						      echo '<div class="panel-heading">'.$_POST['nom'].'</div>';
						      echo ' <div class="panel-body">';
							      echo '<table class="table table-striped">';
									$i=1;
									echo '<tr  class="success"><td></td><td>Nom de guilde</td><td>Meneur</td><td>Nombre de membres</td><td align="center"></td><td></td></tr>';
									$req->execute(array($_POST['nom']));
									while ( $donnees_guilde = $req->fetch() )
									{
										$guilde = $bdd->query('SELECT * FROM guildes WHERE ID='.$donnees_guilde['ID'].' AND ID<>6 ');
										while ( $donnees = $guilde->fetch(PDO::FETCH_ASSOC ))
										{
											echo '<form method="post" action ="index.php?guildes"><tr><td>'.$i.'</td><td>'.$donnees['nom'].'</td>';
											$membre = $bdd->query('SELECT Pseudonyme FROM  nom_personnage WHERE ID_Personnage='.$donnees['ID_meneur'].'');
												while ( $donnees2 = $membre->fetch(PDO::FETCH_ASSOC ))
												{
												echo'<td>'.$donnees2['Pseudonyme'].'</td>';
												}

											echo '<td>'.$donnees['nombre_joueur'].'</td><td align="center"><input type="hidden" name="guilde_selectionne" value="'.$donnees['ID'].'" /> <input class="btn btn-info btn-xs btn-block" type="submit" name="modifier" value="Modifier"/>';?></td><td><input class="btn btn-block btn-danger btn-xs" type="submit" name="delete" value="Supprimer" onclick="return confirm('Confimation de la suppression? Attention les personnages lié à cette guilde seront SGF (Sans Guilde Fix)')"/><?php echo '</td></tr></form>';
											$i++;
										}		
									}
									
							}
						
					}
					else{
						$req = $bdd->query('SELECT ID FROM guildes');
						
						echo '<div class="panel panel-info">';
						      echo '<div class="panel-heading">Liste des guildes</div>';
						      echo ' <div class="panel-body">';
							      echo '<table class="table table-striped">';
										$i=1;
										echo '<tr  class="success"><td></td><td>Nom de guilde</td><td>Meneur</td><td>Nombre de membres</td><td align="center"></td><td></td></tr>';
										while ( $donnees_guilde = $req->fetch() )
										{
											$guilde = $bdd->query('SELECT * FROM guildes WHERE ID='.$donnees_guilde['ID'].' AND ID<>6 ');
											while ( $donnees = $guilde->fetch(PDO::FETCH_ASSOC ))
											{
												echo '<form method="post" action ="index.php?guildes"><tr><td>'.$i.'</td><td>'.$donnees['nom'].'</td>';
												$membre = $bdd->query('SELECT Pseudonyme FROM  nom_personnage WHERE ID_Personnage='.$donnees['ID_meneur'].'');
												while ( $donnees2 = $membre->fetch(PDO::FETCH_ASSOC ))
												{
												echo'<td>'.$donnees2['Pseudonyme'].'</td>';
												}
												echo'<td>'.$donnees['nombre_joueur'].'</td><td align="center"><input type="hidden" name="guilde_selectionne" value="'.$donnees['ID'].'" /> <input class="btn btn-info btn-xs btn-block" type="submit" name="modifier" value="Modifier"/>';?></td><td><input class="btn btn-block btn-danger btn-xs" type="submit" name="delete" value="Supprimer" onclick="return confirm('Confirmer la suppression? Attention les personnages lié à cette guilde seront SGF (Sans Guilde Fix)')"/><?php echo '</td></tr></form>';
												$i++;
											}		
										}
									echo '</table>';
						      echo'</div>';
						    echo '</div>';
					}
					
					
				?>
			</center>
		</td>
	</tr>
</table>