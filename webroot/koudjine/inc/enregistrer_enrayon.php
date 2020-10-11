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


if (isset($_POST['id'])) {

    $id = $_POST['id'];
    if ($manager->existsId($id)) {
        $prod = $manager->get($id);
        $prixAchat = $prod->prixAchat();
        $prixVente = $prod->prixVente();
        $datePeremption = $prod->datePeremption();
        $quantite = $prod->quantite();
        $donnees = array('prixAchat' => $prixAchat, 'datePeremption' => $datePeremption, 'quantite' => $quantite, 'prixVente' => $prixVente);
        echo json_encode($donnees);
    } else {

        echo 'ok';
    }
} else {



    $id = $_POST['id'];
    $prixAchat = $_POST['prixAchat'];
    $prixVente = $_POST['prixVente'];
    $datePeremption = $_POST['datePeremption'];
    $quantite = $_POST['quantite'];
    if ($manager->existsId($id)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if ($prod->id() == $id) {
            $prod->prixAchat($prixAchat);
            $prod->prixVente($prixVente);
            $prod->datePeremption($datePeremption);
            $prod->quantite($quantite);
            $manager->update($prod);
            echo 'ok';
        } else {
            echo 'Ce nom de rayon existe déjà';
        }
    } else {
        $prod = $manager->get($id);
        $prod->prixAchat($prixAchat);
        $prod->prixVente($prixVente);
        $prod->datePeremption($datePeremption);
        $prod->quantite($quantite);
        $manager->update($prod);
        echo 'ok';
    }
}


// D'abord, on se connecte ?ySQL
