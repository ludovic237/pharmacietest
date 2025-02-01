<?php
require_once('database.php');
require_once('../Class/inventaire.php');
require_once('../Class/produit_inventaire.php');
require_once('../Class/en_rayon.php');

global $pdo;


$manager = new InventaireManager($pdo);
$managerPI = new Produit_inventaireManager($pdo);
$managerEn = new En_rayonManager($pdo);

$action = $_POST['action'];
$id = $_POST['id'];
$inventaire = $manager->get();


if($action == "creer"){
    //$qte = $_POST['qte'];
    $employe_id = $_POST['employe_id'];
    $qteRestante = $_POST['qteRestante'];

    $produit = new Produit_inventaire(array(
        'inventaire_id' => $inventaire->id(),
        'employe_id' => $employe_id,
        'en_rayon_id' => $id,
        'stockAvant' => $qteRestante,
        'stockValide' => 0,
        'type' => 'rayon',
        'statut' => 'non valide'
    ));
    $managerPI->add($produit);
    $donnees = array('erreur' =>'nouveau produit en inventaire');
    echo json_encode($donnees);
}else if ($action == "valider"){

    $qte = $_POST['qte'];
    $date_fin = $_POST['date_fin'];

    if($managerPI->existsEn_rayon($inventaire->id(), $id)){
        $produit = $managerPI->getEn_rayon($inventaire->id(), $id);
        $produit->setstockValide($produit->stockValide()+$qte);
        $produit->setdate_fin($date_fin);
        $produit->setstatut("valide");
        $managerPI->update($produit);
        /*$en_rayon = $managerEn->get($id);
        $en_rayon->setquantiteRestante($en_rayon->quantiteRestante() + $qte);
        $managerEn->update($en_rayon);*/
    }

}
else{
    $qte = $_POST['qte'];
    if($managerPI->existsEn_rayon($inventaire->id(), $id)){
        $produit = $managerPI->getEn_rayon($inventaire->id(), $id);
        $produit->setstockValide($produit->stockValide()+$qte);
        $managerPI->update($produit);
        /*$en_rayon = $managerEn->get($id);
        $en_rayon->setquantiteRestante($en_rayon->quantiteRestante() + $qte);
        $managerEn->update($en_rayon);*/
    }

    if(true){
        $donnees = array('erreur' =>'ok');
        echo json_encode($donnees);
    }
    else{
        $donnees = array('erreur' =>'Veuillez vérifier vos quantités et d\'autres paramètres liés à la vente !!!');
        echo json_encode($donnees);
    }



}


// D'abord, on se connecte ?ySQL




?>