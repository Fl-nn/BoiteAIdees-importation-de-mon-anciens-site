<?php
	if(!defined ("INC")){
		
		header("location:index.php");
		exit;
	}
?>
<?php
	echo '<table class="table table-striped table-sm">';
	echo '<thead class="thead-inverse"><tr><th>Statut</th><th align="center"></th><th>Nom de compte</th><th></th><th>Personnages<th align="center">Raison</th><th align="center">Date</th></tr></thead>';
	
		$blackliste = $bdd->query('SELECT * FROM nom_de_compte');
		while ( $donnees = $blackliste->fetch(PDO::FETCH_ASSOC ))
		{
			if ($donnees['Statut']==2){
				$color="danger";
			}
			if ($donnees['Statut']==1){
					$color="warning";
				}
			if ($donnees['Statut']==0){
					$color="success";
			}
			echo '<form method="post" action ="index.php?liste_noir"><tr class="table-'.$color.'">';
			echo '<td style="vertical-align:middle"><input type="hidden" name="ID_Select" value="'.$donnees['ID_Compte'].'"/>';
			if ($donnees['Statut']==2){
				echo '<div class="btn-group btn-block">
					  <button type="button" class="btn btn-danger">Banni</button>
					  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span class="caret "></span>
					  </button>
					  <div class="dropdown-menu">
					    <button type="submit" name="mute" class="btn btn-xs btn-block btn-warning">Mute</button>
					    <div class="dropdown-divider"></div>
					    <button type="submit" name="deban" class="btn  btn-xs btn-block btn-success">Déban</button>
					  </div>
					</div>';

			}
			if ($donnees['Statut']==1){
				echo '<div class="btn-group btn-block">
					  <button type="button" class="btn btn-warning">Mute</button>
					  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span class="caret "></span>
					  </button>
					  <div class="dropdown-menu">
					    <button type="submit" name="ban" class="btn btn-xs btn-block btn-danger">Bannir</button>
					    <div class="dropdown-divider"></div>
					    <button type="submit" name="deban" class="btn  btn-xs btn-block btn-success">Déban</button>
					  </div>
					</div>';
			}
			if ($donnees['Statut']==0){
				echo '<div class="btn-group btn-block">
					  <button type="button" class="btn btn-success">Safe</button>
					  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span class="caret "></span>
					  </button>
					  <div class="dropdown-menu">
					    <button type="submit" name="mute" class="btn btn-xs btn-block btn-warning">Mute</button>
					    <button type="submit" name="ban"  class="btn btn-xs btn-block btn-danger">Bannir</button>
					  </div>
					</div>';
			}

			echo '</td><td style="vertical-align:middle"><input type="checkbox" name="tous"/></td><td style="vertical-align:middle"> '.$donnees['Nom_Compte'].'</td><td style="vertical-align:middle">';
			$req3 = $bdd->query('SELECT Nom_Compte FROM  nom_de_compte WHERE ID_Membre_Liee='.$donnees['ID_Membre_Liee'].' AND ID_Compte<>'.$donnees['ID_Compte'].' ');
			if(count($req3->fetchAll(PDO::FETCH_ASSOC)) == 0) {;
			}
			else
			{
				echo'<select class="selectpicker" data-style="btn-'.$color.'"data-width="fit" title="Autres comptes">';
					$req3 = $bdd->query('SELECT Nom_Compte FROM  nom_de_compte WHERE ID_Membre_Liee='.$donnees['ID_Membre_Liee'].' AND ID_Compte<>'.$donnees['ID_Compte'].' ');		
						while ( $donnees2 = $req3->fetch(PDO::FETCH_ASSOC ))
						{
							echo '<option disabled>'.$donnees2['Nom_Compte'].'</option>';
						}
				echo '</select>';
			}
					
				echo '</td><td style="vertical-align:middle">
				<ul class="list-group" >';
				$req4 = $bdd->query('SELECT * FROM  nom_personnage WHERE ID_Compte_Liee='.$donnees['ID_Compte'].'');		
					while ( $donnees3 = $req4->fetch(PDO::FETCH_ASSOC ))
					{
					    echo '<li  class="list-group-item list-group-item-'.$color.'">'.$donnees3['Pseudonyme'].' '.$donnees3['Niveau'].' '.$donnees3['ID_Race'].'</li>';
					}
				echo '</ul>';
			echo '</td><td align="center" style="vertical-align:middle">'.$donnees['Raison'].'</td><td style="vertical-align:middle">'.$donnees['Date_Modif'].'</td></tr></form>';
		}		
	
	
		echo '</table>';