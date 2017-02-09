<?php
	include ("connexion_bd.php");

$searchTerm = $_GET['term'];
//'SELECT * FROM nom_personnage WHERE Pseudonyme LIKE
$statement = $bdd->query("SELECT * FROM nom_de_compte WHERE Nom_Compte LIKE '%".$searchTerm."%' ORDER BY Nom_Compte ASC");


while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row['Nom_Compte'];
}
echo json_encode($data);
?>