<?php
	try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=meuteinfo', 'root', '');
				//$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
			}
		catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
