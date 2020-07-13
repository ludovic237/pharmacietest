<?php
require_once('database.php');
require_once('../Class/inventaire.php');
require_once('../Class/produit_inventaire.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');

global $pdo;


$manager = new InventaireManager($pdo);
$managerPi = new Produit_inventaireManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerEr = new En_rayonManager($pdo);

$action = $_POST['action'];
echo 'passe';

if ($action == "lancer"){

    $inventaire = new Inventaire(array(
        'etat' => 'En cours'
    ));
    $manager->add($inventaire);

}
else{
    $inventaire = $manager->get();
    $inventaire->setetat('Clot');
    $manager->update($inventaire);
    $entrees = $managerPi->getList($inventaire->id());
    $produits = $managerPr->getList();
    foreach ($produits as $k => $v) :
        $act = 0;
        foreach ($entrees as $i => $j) :
            $entre = $managerEr->get($j->en_rayon_id());
        if($v->id() == $entre->produit_id()){
            $act = 1;
            break;
        }
        endforeach;
        if($act == 0){
            $v->setetat('Non utile');
            $managerPr->update($v);
        }
    endforeach;


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