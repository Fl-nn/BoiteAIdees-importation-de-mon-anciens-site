<?php
	
	if(!defined ("INC")){
		
		header("location:index.php?connexion");
		exit;
	}
?>
<?php
	if(isset($_POST['user']) && isset($_POST['password']))// ON LE CONNECTE SI ENVOI DE FORMULAIRE
	{
		if(!connecte())// SI RENSEIGNEMENTS PAS BONS 
		{
			echo '<div class="alert alert-danger"><strong>Connexion impossible</strong>l\'identifiant ou le mot de passe sont incorrecte<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
		}
	}
	if (!$connecte){
	?>
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">Connexion</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
		<form class="form-horizontal"  method='post' action='index.php?connexion'>
		  <div class="form-group">
			<label for="inputEmail3"  class="cols-sm-2 control-label">Nom d'utilisateur</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
				<input type="text" class="form-control" name="user" id="user"  placeholder="Nom d'utilisateur" />
			</div>
		  </div>
		  <div class="form-group">
			<label for="inputPassword3"  class="cols-sm-2 control-label">Mot de passe</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
				<input type="password" class="form-control" name="password" id="password"  placeholder="Votre mot de passe"/>
			</div>
		  </div>
		  <div class="form-group" align="left">
				<div class="ckbox">
					<input type="checkbox" name="rester_connecter"> 
					<label for="checkbox3">Se souvenir de moi</label>
				</div>
			
		  </div>
		  <div class="form-group">
			  <button type="submit" class="btn btn-primary-outline btn-lg btn-block login-button" name="connexion">Connexion</button>
			
		  </div>
		</form>
		</div>
			</div>
		</div>
<?php
	}
	else {
		header("location:index.php");
	}
?>