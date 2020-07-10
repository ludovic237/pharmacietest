<?php
require_once('database.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new En_rayonManager($pdo);
$managerPr = new ProduitManager($pdo);

$id=$_POST['id'];
$qte=$_POST['qte'];

echo $id;
echo $qte;

if (isset($_POST['id'])){
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


// D'abord, on se connecte ?ySQL




?>