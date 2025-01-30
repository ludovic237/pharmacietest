<?php
require_once('database.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
require_once('../Class/produit_detail.php');

global $pdo;


$managerProduitDetail = new Produit_detailManager($pdo);
$managerConcerner = new ConcernerManager($pdo);
$manager = new En_rayonManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerVe = new VenteManager($pdo);

$id=$_POST['id'];
$qte=$_POST['qte'];
$vente_id=$_POST['vente_id'];

//echo $id;

$vente = $managerVe->get($vente_id);
$concerner = $managerConcerner->getByVenteIdAndEnRayonId($vente_id,$id);
if($vente->etat() == 'Comptant'){
    if ($concerner->type()=='detail'){
        $produitDetail = $managerProduitDetail->get($concerner->en_rayon_id());
        $produitDetail->setstock(($produitDetail->stock() - $qte));
        $managerProduitDetail->update($produitDetail);
        echo "quantité restante ok";
    }
    elseif (isset($_POST['id'])){
        $en_rayon = $manager->get($id);
        $en_rayon->setquantiteRestante(($en_rayon->quantiteRestante()-$qte));
        $manager->update($en_rayon);

        $produit = $managerPr->get($en_rayon->produit_id());
        $produit->setstock(($produit->stock() - $qte));
        $managerPr->update($produit);
        echo "quantité restante ok";


    }
    else{

        echo "Ne passe pas";

    }

}else{
    // deja destocke a la vente
}


// D'abord, on se connecte ?ySQL




?>