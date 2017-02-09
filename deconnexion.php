<?php

	header("location:index.php"); // on retourne sur index.php

	session_start();	// Suppression de toutes les variables et destruction de la session
	$_SESSION = array();
	setcookie('users',NULL,-1); //suppression du cookie
	session_destroy();
?>