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



if ($action == "creer"){

    $qte = $_POST['qte'];
    $employe_id = $_POST['employe_id'];
    $qteRestante = $_POST['qteRestante'];
    $inventaire = $manager->get();

    $produit = new Produit_inventaire(array(
        'inventaire_id' => $inventaire->id(),
        'employe_id' => $employe_id,
        'en_rayon_id' => $id,
        'stockAvant' => $qteRestante,
        'stockValide' => $qte
    ));
    $managerPI->add($produit);
    $en_rayon = $managerEn->get($id);
    $en_rayon->setquantiteRestante($qte);
    $managerEn->update($en_rayon);

}
else{
    $qte = $_POST['qte'];
    $inventaire = $manager->get();
    if($managerPI->existsEn_rayon($inventaire->id(), $id)){
        $produit = $managerPI->getEn_rayon($inventaire->id(), $id);
        $produit->setstockValide($qte);
        $managerPI->update($produit);
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