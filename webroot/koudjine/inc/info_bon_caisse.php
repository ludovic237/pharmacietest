<?php
require_once('database.php');
require_once('../Class/bon_caisse.php');

global $pdo;


$manager = new BonCaisseManager($pdo);


$code = $_POST['code'];
if ($code != "") {
    $codeCheck = $manager->checkBonNumber($code);
    $bon = $manager->get($codeCheck->id());
}

$donnees = array('data' => $bon->montant(), 'etat' => $bon->type());
echo json_encode($donnees);


// D'abord, on se connecte ?ySQL
