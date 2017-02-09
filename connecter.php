<?php
function connecter()
{
	include ("connexion_bd.php");
	if ( isset($_SESSION['user']) OR isset($_COOKIE['users'])) // quand pas encore connecter (formulaire)
	{
		if ( isset( $_COOKIE['users'])) // connecter (formulaire)
		{		
				$_SESSION['user']=$_COOKIE['users'];
				
		}		
		$table = $bdd->query("SELECT * FROM membres WHERE user='".$_SESSION['user']."'");
		while ($donnees = $table->fetch())
		{
			if($_SESSION['user']==$donnees['user'])
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		$table->closeCursor(); // Termine le traitement de la requête*/
	}
	
	
	return false;
}

?>