	<?php
	if(!defined ("INC")){
		
		header("location:index.php");
		exit;
	}
	 ob_start();
	include ("connexion_bd.php");
		?>
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header page-scroll">
		<button class="navbar-toggle collapsed" type="button" data-toggle="collapse"  data-target=".bs-example-js-navbar-collapse" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			<a class="navbar-brand" href="index.php">Bienvenu sur Meuteinfo</a>
		</div>
		<div class="collapse navbar-collapse bs-example-js-navbar-collapse" id="bs-example-navbar-collapse-1">
		
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Forum<b class="caret"></b></a>
				<ul class="dropdown-menu" aria-labelledby="drop1">
					<li><a href="?forum"><font color='black'><span class="glyphicon glyphicon-eye-open"></span> Voir les sujets</font></a></li>
					<li role="separator" class="divider"></li>
					<li><a href="?candid"><font color='black'><span class="glyphicon glyphicon-flag"></span> Faire une demande</font></a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Portails<b class="caret"></b></a>
				<ul class="dropdown-menu" aria-labelledby="drop1">
					<li><a href="?portails"><font color='black'><span class="glyphicon glyphicon-map-marker"></span> Position des portails</font></a></li>
					<li><a href="?portails_info"><font color='black'><span class="glyphicon glyphicon-pushpin"></span> Informations sur ces portails</font></a></li>
					<?php
					if (($connecter) && ($su))
					{
					?>
						<li role="separator" class="divider"></li>
						<li><a href="?maj_portails"><font color='black'><span class="glyphicon glyphicon-edit"></span> Mettre à jour les portails</font></a></li>
					<?php
					}
					?>
				</ul> 
			</li>
			<?php
			if (($connecter) && ($su))
			{
				echo'<li class="dropdown">';
					echo'<a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestion<b class="caret"></b></a>';
					echo'<ul class="dropdown-menu" aria-labelledby="drop2">';
						echo'<li><a href="index.php?membres"><font color="black"><span class=" glyphicon glyphicon-user"> </span> Gérer les membres</font></a></li>';
						echo'<li role="separator" class="divider"></li>';
						echo'<li><a href="index.php?liste_noir"><font color="black"><span class=" glyphicon glyphicon-user"></span> Gérer la liste noir</font></a></li>';
						echo'<li><a href="index.php?deban"><font color="black"><span class=" glyphicon glyphicon-tint"></span> Demande d\'unban</font></a></li>';
					echo'</ul>';
				echo'</li>';
			}
			if (($connecter) && (!$su))
			{
				echo '<li><a href="index.php?deban"><span class=" glyphicon glyphicon-tint"></span> Demande d\'unban</a></li>';
			}
			if (($connecter) && ($su))
					{
				echo'<li class="dropdown">';
					echo'<a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Guilde<b class="caret"></b></a>';
					echo'<ul class="dropdown-menu" aria-labelledby="drop2">';
						echo'<li><a href="index.php?addguildes"><font color="black"><span class="glyphicon glyphicon-plus-sign"></span> Ajout de guildes</font></a></li>';
						echo'<li role="separator" class="divider"></li>';
						echo'<li><a href="index.php?guildes"><font color="black"><span class="glyphicon glyphicon-book"></span> Gérer les guildes</font></a></li>';
					echo'</ul>';
				echo'</li>';
			}
			  ?>
			<li class="dropdown">
				<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informations<b class="caret"></b></a>
				<ul class="dropdown-menu" aria-labelledby="drop2">
					<li><a href="index.php?qui-sommes-nous"><font color='black'><span class="glyphicon glyphicon-question-sign"></span> Qui sommes-nous?</font></a></li>
					<li><a href="index.php?rapport"><font color='black'><span class="glyphicon glyphicon-exclamation-sign"></span> Rapport de bug</font></a></li>
					<li role="separator" class="divider"></li>
					<li><a href="index.php?condition"><font color='black'><span class="glyphicon glyphicon-asterisk"></span> Condition d'utilisation</font></a></li>
				</ul>
			</li>
		<?php
		if ($connecter)
		{
			?>
			<li id="fat-menu" class="dropdown">
				<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class=" glyphicon glyphicon-cog"></span><b class="caret"></b></a>
				<ul class="dropdown-menu" aria-labelledby="drop3">
					<li><a href="?gestion_de_compte"><font color='black'><span class=" glyphicon glyphicon-pencil"></span> Gestion de compte</font></a></li>
					<li><a href="index.php?perso"><font color="black"><span class=" glyphicon glyphicon-queen"></span> Gérer ses personnages</font></a></li>
					<li role="separator" class="divider"></li>
					<li><a href="deconnexion.php"><font color='black'><span class=" glyphicon glyphicon-off"></span> Déconnexion</font></a></li>
				</ul>
			</li>
			<?php
		}
		if (!$connecter)
		{
		?>
			<li id="fat-menu" class="dropdown">
				<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class=" glyphicon glyphicon-cog"></span><b class="caret"></b></a>
				<ul class="dropdown-menu" aria-labelledby="drop3">
					<li><a href="?connexion"><font color="black"><span class=" glyphicon glyphicon-heart"></span> Se connecter</font></a></li>
					<li role="separator" class="divider"></li>
					<li><a href="?inscription"><font color='black'><span class=" glyphicon glyphicon-heart-empty"></span> S'inscrire</font></a></li>
				</ul>
			</li>
		<?php
		}
		?>
		
		</ul>
	
		</div>
	</div>
</nav>