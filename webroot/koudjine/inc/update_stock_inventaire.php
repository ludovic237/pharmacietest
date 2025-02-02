<?php

require_once('database.php');
require_once('../Class/inventaire.php');
require_once('../Class/produit_inventaire.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new InventaireManager($pdo);
$managerPI = new Produit_inventaireManager($pdo);
$managerEn = new En_rayonManager($pdo);
$managerPr = new ProduitManager($pdo);
$listeProduitIds = [];
$rayon_par_produit = [];
$dataListProduit = [];

$inventaire = $manager->get();
$prd_inventaire = $managerPI->get(2);
$produit_inventaire = $managerPI->getList($inventaire->id());
foreach ($produit_inventaire as $k => $v){
    if($v->statut() == 'valide'){
        $en_rayon = $managerEn->get($v->en_rayon_id());
        $en_rayon->setquantiteRestante($v->stockValide());
        $managerEn->update($en_rayon);
        $produit = $managerPr->get($en_rayon->produit_id());
        if (!in_array($en_rayon->produit_id(), $listeProduitIds)) {
            // Si l'ID n'est pas déjà dans la liste, on l'ajoute
            $listeProduitIds[] = $en_rayon->produit_id();
            $produit->setstock($v->stockValide());
            $managerPr->update($produit);
            $rayon_par_produit[$en_rayon->produit_id()] = $v->en_rayon_id();
        }else{
            $produit->setstock($produit->stock()+$v->stockValide());
            $managerPr->update($produit);
            $rayon_par_produit[$en_rayon->produit_id()] = $v->en_rayon_id();
        }
    }
}
foreach ($listeProduitIds as $k => $v){
    $inventaire_par_produit = $managerPI->getListProduit($v);
    $inventaire_par_produit->
    $produit = $managerPr->get($v);

    foreach ($rayon_par_produit[$v] as $a => $b){
        $en_rayon1 = $managerEn->get($b);
        $dataListRayon[] = array(
            "DT_RowId" => $en_rayon1->id(),
            "id" =>  $en_rayon1->id(),
            "qte" => $en_rayon1->quantiteRestante(),
            "dateL" => $en_rayon1->dateLivraison(),
            "dateP" => $en_rayon1->datePeremption()
        );
    }
    $dataListProduit[] = array(
        "DT_RowId" => $v,
        "id" => $v,
        "nom" => $produit->nom(),
        "stock" => $produit->stock(),
        "listeRayon" => $dataListRayon

    );

}
$donnees = array(
    'data' => $dataListProduit,
);
echo json_encode($donnees);


// D'abord, on se connecte ?ySQL




