<?php
	if(!defined ("INC")){
		
		header("location:?ges_liste_noir");
		exit;
		
	}
	?>
		


<div class="ui-widget" align="center">
	<form class="form-inline" action='index.php?liste_noir' method='POST'>
		<p class='text-muted'>Recherchez un pseudonyme :<input id="recherche_liste_noir" type='text'  class="form-control" placeholder="Nom de compte" name="personne_rechercher">	<input align="center" class="btn btn-xs btn-info-outline" type="submit" name="send" value="rechercher" /> <input align="center" class="btn-xs btn btn-info-outline" type="submit" name="que_les_banni" value="Afficher que les bannis"/></p>
	</form>
</div>
<br/>
<?php
if (isset($_POST['ban']) || isset($_POST['mute'])|| isset($_POST['deban']))
{
	if (isset($_POST['ban']))
	{
		$ban=2;
	}
	if (isset($_POST['mute']))
	{
		$ban=1;
	}
	if (isset($_POST['deban']))
	{
		$ban=0;
	}
	if (isset($_POST['tous'])) 
	{
		$req3 = $bdd->prepare('SELECT ID_Membre_Liee FROM  nom_de_compte WHERE ID_Compte=? ');
		$req3->execute(array($_POST['ID_Select']));
		while ( $donnees = $req3->fetch(PDO::FETCH_ASSOC ))
		{
			$req4 = $bdd->prepare('UPDATE nom_de_compte SET Statut=?  WHERE ID_Membre_Liee=?');
			$req4->execute(array($ban,$donnees['ID_Membre_Liee']));
		}
		
	}
	else
	{
		$req2 = $bdd->prepare('UPDATE nom_de_compte SET Statut=?  WHERE ID_Compte=?');
		$req2->execute(array($ban,$_POST['ID_Select']));
	}
	echo '<div class="alert alert-success"><strong>Succes! </strong>La mise à jour est une reussite!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
			
}
if (isset ($_POST['personne_rechercher']) && ($_POST['personne_rechercher']!="" )){
	$req = $bdd->query("SELECT ID_Compte FROM nom_de_compte WHERE  Nom_Compte LIKE '%".$_POST['personne_rechercher']."%' ORDER BY Nom_Compte ASC");
	if(count($req->fetchAll(PDO::FETCH_ASSOC)) == 0) {
		echo '<fieldset><legend>La recherche pour trouver "'.$_POST['personne_rechercher'].'" n\'a rien donné...</legend>';
			include("tout_ges_liste_noir.php");
		echo '</fieldset>';
	}
	else
	{
	$req = $bdd->query("SELECT * FROM nom_de_compte WHERE  Nom_Compte LIKE'%".$_POST['personne_rechercher']."%' ORDER BY Nom_Compte ASC");

		echo '<fieldset><legend>Recherche de : '.$_POST['personne_rechercher'].'</legend>';
		echo '<table class="table table-striped">';
		echo '<thead class="thead-inverse"><tr><th>Statut</th><th>Nom de compte</th><th></th><th>Personnages<th align="center">Raison</th><th align="center">Date_Ban</th></tr></thead>';
	
		while ( $donnees = $req->fetch(PDO::FETCH_ASSOC ))
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
			echo '</td><td align="center" style="vertical-align:middle">'.$donnees['Raison'].'</td><td style="vertical-align:middle">'.$donnees['Date_Ban'].'</td></tr></form>';
		}		
	
	
		echo '</table>';
			echo '</fieldset>';
	}
	
}
elseif( isset($_POST['que_les_banni'])){
	
	$blackliste = $bdd->query('SELECT * FROM nom_de_compte WHERE Statut=2');
	if(count($blackliste->fetchAll(PDO::FETCH_ASSOC)) == 0) {
		echo '<fieldset><legend>Il n\'y a personne de banni.</legend>';
		include("tout_ges_liste_noir.php");
		echo '</fieldset>';
	}
	else{
		echo '<fieldset><legend>Liste des bannis</legend>';
		echo '<table class="table table-striped">';
		echo '<thead class="thead-inverse"><tr><th>Statut</th><th>Nom de compte</th><th></th><th>Personnages<th align="center">Raison</th><th align="center">Date_Ban</th></tr></thead>';
	
		$blackliste = $bdd->query('SELECT * FROM nom_de_compte WHERE Statut=2');
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
			echo '</td><td align="center" style="vertical-align:middle">'.$donnees['Raison'].'</td><td style="vertical-align:middle">'.$donnees['Date_Ban'].'</td></tr></form>';
		}		
	
	
		echo '</table>';
		echo '</fieldset>';
	}
				
	
}
else{

	echo '<fieldset><legend>Liste des personnages enregistré dans la base</legend>';
		include("tout_ges_liste_noir.php");
	echo '</fieldset>';
}
echo '<form method="post" action ="index.php?ajout_compte"><p align="center"><input class="btn btn-lg btn-default" type="submit" name="add_personnage_bl" value="Ajouter un personnage non enregistré"/></p></form>';
?>
