<?php
	
	if(!defined ("INC")){
		
		header("location:index.php?maj_portails");
		exit;
	}
	
	include ("connexion_bd.php");
	$liste_portails = $bdd->query('SELECT * FROM portails');
	if (isset($_POST['valider'])){
		$req2 = $bdd->prepare('UPDATE portails SET pos_x=?, pos_y=?, zone_portail=?, nbr_utilisation=?, date_time=?, modificateur=?  WHERE ID_portail=?');
		$req2->execute(array($_POST['pos_x'],$_POST['pos_y'],$_POST['zone_portail'],$_POST['utilisation'],$_POST['date'],$_POST['modificateur'],$_POST['id']));	
		echo '<div class="alert alert-success"><strong>Succes! </strong>La mise à jour est une reussite!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
	}
	echo '<fieldset><legend>Portails</legend>';
	
	echo '<table class="table table-striped">';
	echo '<tr  class="success"><td>Nom</td><td>Position</td><td>Zone ou sous zone</td><td>Places</td><td>Date & heure</td><td>Modificateur</td><td></td></tr>';
	$portail = $bdd->query('SELECT * FROM portails ');
	while ( $donnees_personne = $portail->fetch(PDO::FETCH_ASSOC ))
	{
		$modifier=0;
		if(isset($_POST['id_select']))
		{
			$modifier=$_POST['id_select'];
		}
		if($modifier==$donnees_personne['ID_portail'])
		{
			echo '<form method="post" class="form-inline" action ="index.php?maj_portails">';
			echo '<tr><input type="hidden" name="id" value="'.$donnees_personne['ID_portail'].'" /><td>'.$donnees_personne['nom_portail'].'</td><td align="center">';
			echo '
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">[</span>
				<input type="text" size="2" class="form-control" name="pos_x" value="'.$donnees_personne['pos_x'].'" aria-describedby="basic-addon1">
				<span class="input-group-addon" id="basic-addon1">,</span>
				<input type="text" size="2" class="form-control" name="pos_y" value="'.$donnees_personne['pos_y'].'" aria-describedby="basic-addon1">
				<span class="input-group-addon" id="basic-addon1">]</span>
			</div>';
			echo '</div></td>';
			echo '<td><input type="text" size="17"  class="form-control"name="zone_portail" value="'.$donnees_personne['zone_portail'].'"/></td><td align="center"><input type="text" size="3"class="form-control"  name="utilisation" value="'.$donnees_personne['nbr_utilisation'].'"/></td><td>'.date('Y-m-d H:i:s').'<input type="hidden" name="date" value="'.date('Y-m-d H:i:s').'" /></td><td><input type="text" class="form-control" size="20" name="modificateur" value="'.$donnees_personne['modificateur'].'"/></td>';
			echo'<td><input class="btn btn-success btn-s btn-block" type="submit" name="valider" value="Valider"/></td></tr>';
			echo '</form>';
		}
		else
		{
			echo '<form method="post" action ="index.php?maj_portails"><tr><input type="hidden" name="id_select" value="'.$donnees_personne['ID_portail'].'" /><td>'.$donnees_personne['nom_portail'].'</td><td align="center">['.$donnees_personne['pos_x'].','.$donnees_personne['pos_y'].']</td><td>'.$donnees_personne['zone_portail'].'</td><td align="center">'.$donnees_personne['nbr_utilisation'].'</td><td>'.$donnees_personne['date_time'].'</td><td>'.$donnees_personne['modificateur'].'</td>';
			echo'<td><input class="btn btn-info btn-s btn-block" type="submit" name="modifier" value="Modifier"/></form></td></tr>';
		}
	}							
	echo '</table>';
	echo '</fieldset>';	
	
	
?>