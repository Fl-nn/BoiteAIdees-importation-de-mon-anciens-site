<?php
	if(!defined ("INC")){
		
		header("location:index.php?deban");
		exit;
	}
	
	include ("connexion_bd.php");
	
	function verif(){
{
	//On verifie que chaque information a bien été entré et on stocke ces infos dans des variables 
	if ((isset($_POST['pseudo'])) && (isset($_POST['email'])) && (isset($_POST['subject'])) && (isset($_POST['comments']))&& (isset($_POST['cible'])))
	{
		$pseudo=(isset($_POST['pseudo']))?$_POST['pseudo']:NULL;
		$email=(isset($_POST['email']))?$_POST['email']:NULL;
		$subject=(isset($_POST['subject']))?$_POST['subject']:NULL;
		$comments=(isset($_POST['comments']))?$_POST['comments']:NULL;
		$cible=(isset($_POST['cible']))?$_POST['cible']:NULL;
	} 
	else {return false;}
		include('connexion_bd.php');


	//envoye des données à la bdd 'Personne'
	$req = $bdd->prepare('INSERT INTO rapport(Pseudonyme,Email,Sujet,Explications, Pseudonyme_deban)
	VALUES(:Pseudonyme,:Email,:Sujet,:Explications,:Pseudonyme_deban)');
	$req->execute(array(
		'Pseudonyme'=>$pseudo,
		'Email'=>$email,
		'Sujet'=>$subject,
		'Explications'=>$comments,
		'Pseudonyme_deban'=>$cible
		)); 
	return true;
}
}
?>
<p  align="center" class="text-warning">Envoyez-nous le formulaire suivant concernant votre demande de débanissement!</p> 
</br>
</br>
<p class="text-danger">Notre adresse mail en cas de soucis : (non disponible pour le moment)</p> <!--Textes apportant des informations à l'utilisateur-->
</br>
<?php
	if (verif())
	{
		echo "<h1 align='center' class='text-danger'>La demande a bien été envoyé!</h1>";
		echo "<h3 align='center' class='text-muted'>Vous allez être redirigé...</h3>";
		header("Refresh: 2;URL=index.php");
	}
	else {
?> <!-- Si la fonction verif() renvoie false, on charge le formulaire d'envoi de message-->
	<div align=center>
		<form method="post" class="form-inline" action="index.php?deban" >
			<table>
				<tr><td>Auteur :</td>
					<td><?php echo $_SESSION['user']; ?></td></tr>
				<tr><td>Pseudo de la personne à débanir	:</td>
					<td><?php echo'<input type="hidden" name="pseudo" value="'.$_SESSION['user'].'" />';?><input type="text" class="form-control" id="recherche_liste_noir" name="cible" size=30 required></td></tr>
				<?php
					
						$req = $bdd->prepare('SELECT email FROM membres WHERE user=?');
						$req->execute(array($_SESSION['user']));
					while ( $donnees = $req->fetch())
					{
						$mail= $donnees['email'];
					}
				?>
				<tr><td>Votre Email :</td>
					<td><?php echo '<input type="hidden" name="email" value="'.$mail.'" /> '.$mail.''; ?></td></tr>
				<tr><td>Sujet de votre demande :</td>
					<td><input type="hidden" name="subject" value="DEBANISSEMENT" />Ne plus être bannis.</td></tr>
				<tr><td colspan=2>Pourquoi le débanir :<br>
					<textarea COLS=80 ROWS=6 class="form-control" name="comments" required></textarea> <!--le terme "required" oblige
					l'utilisateur à entrer une valeur dans chaque textbox avant de pouvoir appeler la fonction verif()-->
				</td></tr>
			</table>
			<br> <input type="submit" class="btn  btn-primary-outline" value="Envoyer" name="send">
			<input type="reset" class="btn  btn-danger-outline" value="Annuler" name="cancel" action="index.php?deban">
		</form>
	</div> 
<?php
	}
?>