<?php
	if(!defined ("INC")){
		
		header("location:index.php?connexion");
		exit;
	}
?>
<?php
function connecte()
{
	include ("connexion_bd.php");
	
	
	if ( isset($_POST['user']) && isset($_POST['password']) ) // vérifie quand pas encore connecter et connecte
	{	
		$passwd= hash("whirlpool", '1zA$' . $_POST['password'] . '%yU1');
		$table = $bdd->query("SELECT * FROM membres WHERE user='".$_POST['user']."' AND password='".$passwd."'");
		while ($donnees = $table->fetch())
		{
			if($passwd==$donnees['password'] && $_POST['user']==$donnees['user'])
			{
				$_SESSION['user']=$_POST['user'];
				if (isset($_POST['rester_connecter']))
				{
					setcookie("users",$_SESSION['user'],(time() + 3600*24*7));
				}
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