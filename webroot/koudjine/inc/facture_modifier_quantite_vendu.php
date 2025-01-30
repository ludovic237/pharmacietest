<?php
require_once('database.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/vente.php');

global $pdo;


$manager = new En_rayonManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerVe = new VenteManager($pdo);

$id=$_POST['id'];
$qte=$_POST['qte'];
$vente_id=$_POST['vente_id'];

//echo $id;
echo $qte;
$vente = $managerVe->get($vente_id);
print_r($vente);
echo $vente->etat();
if($vente->etat() == 'Comptant'){
    if (isset($_POST['id'])){
        $en_rayon = $manager->get($id);
        print_r($en_rayon);
        $en_rayon->setquantiteRestante(($en_rayon->quantiteRestante()-$qte));
        $manager->update($en_rayon);
        print_r($en_rayon);
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