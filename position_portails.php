<?php
	
	if(!defined ("INC")){
		
		header("location:index.php?portails");
		exit;
	}
?>
			<center>
				<?php
					
						include ("connexion_bd.php");
							echo '<fieldset><legend>Portails</legend>';
							echo '';
							echo '<table class="table table-striped">';
							$i=1;
							echo '<tr  class="success"><td></td><td>Nom</td><td>Position</td><td>Zone ou sous zone</td><td>Passage restant</td><td>Date & heure</td><td>Modificateur</td></tr>';
							$portail = $bdd->query('SELECT * FROM portails');
							while ( $donnees_personne = $portail->fetch(PDO::FETCH_ASSOC ))
							{
							echo '<form method="post" action ="index.php?page_personne"><tr><td>'.$i.'</td><td>'.$donnees_personne['nom_portail'].'</td><td align="center">['.$donnees_personne['pos_x'].','.$donnees_personne['pos_y'].']</td><td>'.$donnees_personne['zone_portail'].'</td><td align="center">'.$donnees_personne['nbr_utilisation'].'</td><td>'.$donnees_personne['date_time'].'</td><td>'.$donnees_personne['modificateur'].'</td></tr></form>';
								$i++;
							}
							echo '</table>';
							echo 'Droit de modification pour le moment redistribué: Artemis, Lokis, King-hans, fleurdange, warz, intellogime, Shoanana, Maitre-mayaa, Jojo-ombre,Amcirox, Megalonef<br/><br/><br/>';	
							echo "<center><img  class='img-circle' src='img/dofus2.png' alt='oeuf'/></center>";
							echo '</fieldset>';		
					
				?>
			</center>