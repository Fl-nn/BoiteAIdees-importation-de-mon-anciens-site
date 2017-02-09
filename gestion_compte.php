<?php
	
	if(!defined ("INC")){
		
		header("location:index.php?gestion");
		exit;
	}
	echo'<center>Utilisateur: '.$_SESSION['user'].'<br/>';
		if (isset($_COOKIE['users']))
		{
			echo 'Vous avez décidé de rester connecté.';
		}

?>

<form method="post" action ="index.php?perso" class="form-inline">
	<button type="submit" class="form-control" class="btn btn-default"><span class=" glyphicon glyphicon-queen"></span> Gérer ses personnages</button><br/>
</form>
<form method="post" action ="deconnexion.php" class="form-inline">
<button type="submit" class="form-control" class="btn btn-default"><span class=" glyphicon glyphicon-off"></span> Déconnexion</button><br/>
</form>
</center>