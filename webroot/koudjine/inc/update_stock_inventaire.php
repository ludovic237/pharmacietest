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

$inventaire = $manager->getFini();
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
$count=0;
if (is_array($listeProduitIds)) {
    foreach ($listeProduitIds as $k => $v){
        //$inventaire_par_produit = $managerPI->getListProduit($v);
        //$inventaire_par_produit->
        $count++;
        $produit = $managerPr->get($v);
        if (is_array($rayon_par_produit[$v])) {
            foreach ($rayon_par_produit[$v] as $a => $b){
                $en_rayon1 = $managerEn->get($b);
                $dataListRayon[$v][] = array(
                    "DT_RowId" => $en_rayon1->id(),
                    "id" =>  $en_rayon1->id(),
                    "nom" =>  $produit->nom(),
                    "qte" => $en_rayon1->quantiteRestante(),
                    "dateL" => $en_rayon1->dateLivraison(),
                    "dateP" => $en_rayon1->datePeremption()
                );
            }
        }else{
            $en_rayon1 = $managerEn->get($rayon_par_produit[$v]);
            $dataListRayon[$v][] = array(
                "DT_RowId" => $en_rayon1->id(),
                "id" =>  $en_rayon1->id(),
                "nom" =>  $produit->nom(),
                "qte" => $en_rayon1->quantiteRestante(),
                "dateL" => $en_rayon1->dateLivraison(),
                "dateP" => $en_rayon1->datePeremption()
            );
        }

        $tableau = ($dataListRayon[$v]) ;
        $dataListProduit[] = array(
            "DT_RowId" => $v,
            "id" => $v,
            "nom" => $produit->nom(),
            "stock" => $produit->stock(),
            "listeRayon" => $dataListRayon[$v]

        );

    }
}else{
    $count++;
    $produit = $managerPr->get($listeProduitIds);
    if (is_array($rayon_par_produit[$listeProduitIds])) {
        foreach ($rayon_par_produit[$listeProduitIds] as $a => $b){
            $en_rayon1 = $managerEn->get($b);
            $dataListRayon[$listeProduitIds][] = array(
                "DT_RowId" => $en_rayon1->id(),
                "id" =>  $en_rayon1->id(),
                "nom" =>  $produit->nom(),
                "qte" => $en_rayon1->quantiteRestante(),
                "dateL" => $en_rayon1->dateLivraison(),
                "dateP" => $en_rayon1->datePeremption()
            );
        }
    }else{
        $en_rayon1 = $managerEn->get($rayon_par_produit[$listeProduitIds]);
        $dataListRayon[$listeProduitIds][] = array(
            "DT_RowId" => $en_rayon1->id(),
            "id" =>  $en_rayon1->id(),
            "nom" =>  $produit->nom(),
            "qte" => $en_rayon1->quantiteRestante(),
            "dateL" => $en_rayon1->dateLivraison(),
            "dateP" => $en_rayon1->datePeremption()
        );
    }

    //$tableau = ($dataListRayon[$listeProduitIds]) ;
    $dataListProduit[] = array(
        "DT_RowId" => $listeProduitIds,
        "id" => $listeProduitIds,
        "nom" => $produit->nom(),
        "stock" => $produit->stock(),
        "listeRayon" => $dataListRayon[$listeProduitIds]

    );
}

/*$inventaire->setetat("Presque fini");
$manager->update($inventaire);*/

$donnees = array(
    'data' => $dataListProduit,
    'data1' => $dataListRayon,
);
echo json_encode($donnees);


// D'abord, on se connecte ?ySQL




