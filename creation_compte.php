<?php
	if(!defined ("INC")){
		
		header("location:?inscription");
		exit;
	}
	if(isset($_POST['submit']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])  && isset($_POST['conditions'])){
		$pseudo=$_POST['pseudo'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$confirm_password=$_POST['confirm_password'];
		$conditions=$_POST['conditions'];
		$req = $bdd->prepare('SELECT ID_membre FROM membres WHERE user = ?');
		$req->execute(array($pseudo));
		if(($req->rowCount()) == 0) {
			if (preg_match("#^[a-zA-Z0-9\-]+$#i" , $pseudo))
			{
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					if ($password==$confirm_password)
					{
						$password= hash("whirlpool", '1zA$' . $_POST['password'] . '%yU1');
						$req = $bdd->prepare('INSERT INTO membres(user,password,email,compte_inscrit) 
							VALUES(:user,:password,:email,:compte_inscrit)');
						$req->execute(array(
							'user' => $pseudo,
							'password' =>$password,
							'email' =>$email,
							'compte_inscrit' => 1
							));
						echo '<div class="alert alert-success"><strong>L\'inscription est une reussite ! </strong>Bienvenu '.$pseudo.'! Vous alle être redirigé sur la page de connexion...<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
						header("Refresh: 2;URL=?connexion");
					}
					else{
						echo '<div class="alert alert-danger"><strong>Erreur! </strong>Les deux mots de passe sont différents!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
						header("Refresh: 2;URL=?inscription");
					}
				}
				else{
					echo '<div class="alert alert-danger"><strong>Erreur! </strong>Mail non valide!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
					header("Refresh: 2;URL=?inscription");
				}
			}
			else{
				echo '<div class="alert alert-danger"><strong>Erreur! </strong>Caractères spéciaux interdit!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
				header("Refresh: 2;URL=?inscription");
			}
		}
		else{
			echo '<div class="alert alert-danger"><strong>Erreur! </strong>Nom déjà utilisé...<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
			header("Refresh: 2;URL=?inscription");
		}
	}
	if (!isset($_POST['submit'])){
	?>

		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">Inscription au site</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" id="form" method="post" action="?inscription">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Votre nom d'utilisateur</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" minlength="3" maxlength="30" name="pseudo" id="pseudo"  placeholder="Saisissez votre nom d'utilisateur" required/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Votre E-mail</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="email" id="email"  placeholder="Saisissez votre adresse mail" required/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Mot de passe</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password"  minlength="8" maxlength="20" id="password"  placeholder="Saisissez votre mot de passe" required/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirmer le mot de passe</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm_password" minlength="8" maxlength="20" id="confirm_password"  placeholder="Confirmez votre mot de passe" required/>
								</div>
							</div>
						</div>
						<div class="form-group" align="left">
							<div class="ckbox">
								<label for="checkbox3">Accepter les conditions d'utilisation</label>
								<input type="checkbox" name="conditions" required> 
							</div>
						
					  </div>
						<div class="form-group ">
							<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block login-button">S'inscrire</button>
						</div>
						<center><div class="login-register">
				            <a href="?connexion">Se connecter</a>
				         </div></center>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
	?>