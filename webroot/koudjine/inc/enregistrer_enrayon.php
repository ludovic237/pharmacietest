<?php
require_once('database.php');
require_once('../Class/rayon.php');
require_once('../Class/en_rayon.php');

global $pdo;


$manager = new En_rayonManager($pdo);

$prixAchat;
$prixVente;
$datePeremption;
$quantite;

$id = $_POST['id'];
$prixAchat = $_POST['prixAchat'];
$prixVente = $_POST['prixVente'];
$datePeremption = $_POST['datePeremption'];
$quantite = $_POST['quantite'];

if ($prixAchat == 0) {

    $id = $_POST['id'];
    if ($manager->existsId($id)) {
        $prod = $manager->get($id);
        $prixAchat = $prod->prixAchat();
        $prixVente = $prod->prixVente();
        $datePeremption = $prod->datePeremption();
        $quantite = $prod->quantite();
        $donnees = array('id' => $id, 'prixAchat' => $prixAchat, 'datePeremption' => $datePeremption, 'quantite' => $quantite, 'prixVente' => $prixVente);
        echo json_encode($donnees);
    } else {

        echo 'ok';
    }
} else {

    if ($manager->existsId($id)) {
        $manager->myupdate($datePeremption, $prixAchat, $prixVente, $quantite, $id);
        echo 'success';
    } else {
        $prod = $manager->get($id);
        $manager->myupdate($datePeremption, $prixAchat, $prixVente, $quantite, $id);
        echo 'ok';
    }
}


// D'abord, on se connecte ?ySQL
