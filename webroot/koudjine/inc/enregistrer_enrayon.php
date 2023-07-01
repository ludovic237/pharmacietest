<?php
require_once('database.php');
require_once('../Class/rayon.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new En_rayonManager($pdo);
$managerPr = new ProduitManager($pdo);

$prixAchat;
$prixVente;
$datePeremption;
$quantite;
$quantiteRestante ;
$reduction ;

$id = $_POST['id'];
$prixAchat = $_POST['prixAchat'];
$prixVente = $_POST['prixVente'];
$datePeremption = $_POST['datePeremption'];
//$quantite = $_POST['quantite'];
$quantiteRestante = $_POST['quantiteRestante'];
$reduction = $_POST['reduction'];

if ($prixAchat == 0) {

    $id = $_POST['id'];
    if ($manager->existsId($id)) {
        $prod = $manager->gets($id);
        $donnees = array('data' => $prod);
        echo json_encode($donnees);
    } else {

        echo 'ok';
    }
} else {

    echo $datePeremption;
    
    if ($manager->existsId($id)) {
        $manager->myupdate2($datePeremption, $prixAchat, $prixVente, $id,$quantiteRestante,$reduction);
        echo 'success';
    } else {
        $manager->myupdate2($datePeremption, $prixAchat, $prixVente, $id,$quantiteRestante,$reduction);
        echo 'ok';
    }
    $stock = 0;
    $en_rayon = $manager->get($id);
    $en_rayons = $manager->getList($en_rayon->produit_id());
    foreach ($en_rayons as $k => $v) :
        $stock = $stock + ($v->quantiteRestante());
    endforeach;
    $prd = $managerPr->get($en_rayon->produit_id());
    $prd->setstock($stock);
    $managerPr->update($prd);
}


// D'abord, on se connecte ?ySQL
