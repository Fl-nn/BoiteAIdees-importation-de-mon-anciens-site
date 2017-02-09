<?php
	if(!defined ("INC")){
		
		header("location:index.php?rapport");
		exit;
	}
	function verif(){
{
	//On verifie que chaque information a bien été entré et on stocke ces infos dans des variables 
	if ((isset($_POST['pseudo'])) && (isset($_POST['email'])) && (isset($_POST['subject'])) && (isset($_POST['comments'])))
	{
		$pseudo=(isset($_POST['pseudo']))?$_POST['pseudo']:NULL;
		$email=(isset($_POST['email']))?$_POST['email']:NULL;
		$subject=(isset($_POST['subject']))?$_POST['subject']:NULL;
		$comments=(isset($_POST['comments']))?$_POST['comments']:NULL;
	} 
	else {return false;}
		include('connexion_bd.php');


	//envoye des données à la bdd 'Personne'
	$req = $bdd->prepare('INSERT INTO rapport(Pseudonyme,Email,Sujet,Explications)
	VALUES(:Pseudonyme,:Email,:Sujet,:Explications)');
	$req->execute(array(
		'Pseudonyme'=>$pseudo,
		'Email'=>$email,
		'Sujet'=>$subject,
		'Explications'=>$comments
		)); 
	return true;
}
}
?>
<p  align="center" class="text-warning">Envoyez-nous le formulaire suivant concernant un bug éventuel!</p> 
</br>
</br>
<p class="text-danger">Notre adresse mail en cas de soucis : (non disponible pour le moment)</p> <!--Textes apportant des informations à l'utilisateur-->
</br>
<?php
	if (verif())
	{
		echo "<h1 align='center' class='text-danger'>Le mail a bien été envoyé!</h1>";
		echo "<h3 align='center' class='text-muted'>Vous allez être redirigé...</h3>";
		header("Refresh: 2;URL=index.php");
	} //Si la fonction verif() renvoie le booleen true, on confirme l'envoi du mail et on charge la page d'accueille. 
	else {
?> <!-- Si la fonction verif() renvoie false, on charge le formulaire d'envoi de message-->
	<div align=center>
		<form method="post" class="form-inline" action="index.php?rapport" >
			<table>
				<tr><td>Votre Pseudo:</td>
					<td><?php if($connecter){ echo '<input type="hidden" name="pseudo" value="'.$_SESSION['user'].'" />'; echo $_SESSION['user'];}else{ echo'<input type="text" class="form-control" name="pseudo" size=30 required>';} ?></td></tr>
				<?php
					if($connecter){
						
					}		
				?>
				<tr><td>Votre Email:</td>
					<td><?php 
					if ($connecter){
						$req = $bdd->prepare('SELECT email FROM membres WHERE user=?');
						$req->execute(array($_SESSION['user']));
						while ( $donnees = $req->fetch())
						{
							$mail= $donnees['email'];
						}
						echo '<input type="hidden" name="email" value="'.$mail.'" /> '.$mail.'';
					}else{echo '<input type="text" class="form-control" name="email" size=30 required>';} 
					?></td></tr>
				<tr><td>Sujet du bug :</td>
					<td><input type="text" class="form-control" name="subject" size=30 required></td></tr>
				<tr><td colspan=2>Explications du bug:<br>
					<textarea COLS=80 ROWS=6 name="comments" class="form-control"  required></textarea> <!--le terme "required" oblige
					l'utilisateur à entrer une valeur dans chaque textbox avant de pouvoir appeler la fonction verif()-->
				</td></tr>
			</table>
			<br> <input type="submit" class="btn  btn-primary-outline" value="Envoyer" name="send">
			<input type="reset" value="Annuler" class="btn  btn-danger-outline" name="cancel" action="index.php?rapport">
		</form>
	</div> 
<?php
	}
?>