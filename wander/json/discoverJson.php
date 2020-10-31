<?php
include "../modele/userModele.php";

session_start();

$modele = new RegisterModele();
$tab = $modele->selectUsers($_SESSION['id']);

$json = json_encode($tab);
echo $json;
?>