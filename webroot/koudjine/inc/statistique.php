<?php
require_once('database.php');
require_once('../Class/fournisseur.php');

$id;
$nom;
global $pdo;
$datas = [];
$managerFo = new FournisseurManager($pdo);
$groupFournisseur = null;
$type =  $_POST['type'];
$start =  $_POST['start'];
$end =  $_POST['end'];

if ($type == "Tous"){
    $groupFournisseur = $managerFo->getGroupFournisseurRangeAll($start,$end);
}
else{
    $groupFournisseur = $managerFo->getGroupFournisseurRange($type,$start,$end);
}

$datas = array('data' => $groupFournisseur);
echo json_encode($datas);


// D'abord, on se connecte ?ySQL
