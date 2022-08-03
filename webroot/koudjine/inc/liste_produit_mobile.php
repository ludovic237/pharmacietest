<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');


global $pdo;
global $conndb;
$managerProduit = new ProduitManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

$produit = $managerProduit->getList();


$datas = [];

foreach ($produit as $a => $b) {
    if ($b->grossiste_id() != '') {
        $enrayon = $managerEnRayon->getListDetail($b->id());
    } else {
        $enrayon = $managerEnRayon->getList($b->id());
    }
    $datasRayon = [];
    foreach ($enrayon as $k => $v) :
        $datelivraison = $v->dateLivraison();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
        $datel = $date->format('d-m-Y');
        $datasRayon[] = array(
            "id" => $v->id(),
            "produit_id" => $v->produit_id(),
            "fournisseur_id" => $v->fournisseur_id(),
            "commande_id" => $v->commande_id(),
            "dateLivraison" => $v->dateLivraison(),
            "datePeremption" => $v->datePeremption(),
            "prixAchat" => $v->prixAchat(),
            "prixVente" => $v->prixVente(),
            "quantite" => $v->quantite(),
            "quantiteRestante" => $v->quantiteRestante(),
            "reduction" => $v->reduction(),
            "supprimer" => $v->supprimer()
        );
    endforeach;
    $datas[] = array(
        "reductionMax" => $b->reductionMax(),
        "codeLaborex" => $b->codeLaborex(),
        "stockMax" => $b->stockMax(),
        "ean13" => $b->ean13(),
        "fabriquant_id" => $b->fabriquant_id(),
        "contenuDetail" => $b->contenuDetail(),
        "etagere" => $b->etagere(),
        "etat" => $b->etat(),
        "nom" => $b->nom(),
        "categorie_id" => $b->categorie_id(),
        "codeUbipharm" => $b->codeUbipharm(),
        "grossiste_id" => $b->grossiste_id(),
        "reference" => $b->reference(),
        "magasin_id" => $b->magasin_id(),
        "prixDetail" => $b->prixDetail(),
        "stockMin" => $b->stockMin(),
        "supprimer" => $b->supprimer(),
        "forme_id" => $b->forme_id(),
        "id" => $b->id(),
        "stock" => $b->stock(),
        "rayon_id" => $b->rayon_id(),
        "rayonList" => $datasRayon
    );
}


echo json_encode($datas);

