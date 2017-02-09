<?php
	include ("connexion_bd.php");

$searchTerm = $_GET['term'];
//'SELECT * FROM nom_personnage WHERE Pseudonyme LIKE
$statement = $bdd->query("SELECT * FROM guildes WHERE  ID<>6 AND nom LIKE '%".$searchTerm."%' ORDER BY nom ASC");


while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row['nom'];
}
echo json_encode($data);
?>