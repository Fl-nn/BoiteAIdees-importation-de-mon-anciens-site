<?php
	if (isset ($_GET['forum'])){
		echo "<h1 align='center' class='text-danger'>Le forum n'est pas encore disponible!</h1>";
		echo "<h3 align='center' class='text-muted'>Vous allez être redirigé vers un forum de la meute dans quelques secondes...</h3>";
		header("Refresh: 15;URL=http://lameutedillmatar.forumactif.org/");
	}
	elseif (isset ($_GET['candid'])){
		echo "<h1 align='center' class='text-danger'>Le forum n'est pas encore disponible!</h1>";
		echo "<h2 align='center' class='text-muted'>Si vous souhaitez faire une demande sur ce site, c'est <a class='underline' href='index.php?rapport'>ICI</a>.</h2>";
		echo "<h4 align='center' class='text-muted'>Vous allez être redirigé vers un forum de la meute dans quelques secondes...</h4>";
		header("Refresh: 15;URL=http://lameutedillmatar.forumactif.org/f3-candidatures");
	}
		