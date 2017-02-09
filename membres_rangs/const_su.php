<?php
	if(!defined ("INC")){
		
		header("location:index.php");
		exit;
	}
?>
<?php
function super_user()
{
	include ("connexion_bd.php");
$table = $bdd->query("SELECT rang FROM membres WHERE user='".$_SESSION['user']."'");
while ($donnees = $table->fetch())
		{
			if($donnees['rang']==2){
				return true;
				
			}
			else{
				return false;
			}
		}
return false;
}