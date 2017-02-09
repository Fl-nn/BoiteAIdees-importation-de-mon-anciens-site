<?php
	if(!defined ("INC")){
		
		header("location:index.php");
		exit;
	}
		if ( isset ( $_POST['connexion']) OR isset ($_GET['connexion'])){
			include ('connexion.php');
			echo "<hr/>";
		}
		else
		{
			echo ("<h3>Accueil</h3><p>Nous vous rappelons qu'en utilisant ce site, vous acceptez les <a class='underline' href='index.php?condition'>conditions d'utilisation</a>.<br/><br/>
			Vous avez trouvé un bug? <a class='underline' href='index.php?rapport'>Faites un rapport</a>! </p>");
			echo ("<h4>Le site est actuellement en phase de construction...</h4>");
			echo 'À venir : Forum adapté.<br/>';
			echo "C'est trop gros? Nous vous conseillons de faire : <img src='img/CtrlMolette.jpg' alt='CtrlMolette'/><br/><br/>";
			echo "<center><img widht='50%' class='img-rounded' src='img/meute.png' alt='meute'/></center>";
		}
?>