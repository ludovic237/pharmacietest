<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/facturation.php');
require_once('../Class/facture_ticket.php');
require_once('../Class/facture_electronique.php');
require_once('../Class/facture_espece.php');

global $pdo;


$manager = new VenteManager($pdo);
$managerEn = new En_rayonManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerCaisse = new CaisseManager($pdo);
$managerFacturation = new FacturationManager($pdo);
$managerFactureEspece = new FactureEspeceManager($pdo);
$managerFactureElectronique = new FactureElectroniqueManager($pdo);
$managerFactureTicket = new FactureTicketManager($pdo);

//echo $id;
$caisseOuvert = $managerCaisse->get();
$venteActifCaisse = $manager->getListCaisseVente($caisseOuvert->id());
$venteAll = $manager->getList();

$dataAll = [];
$produitName = '';
foreach ($venteAll as $k => $c) {
    /*$facture = new Facturation();*/
    if ($managerFacturation->existsvente_id($c->id())) {
        $facture = $managerFacturation->getVente($c->id());
        $reste = $facture->reste();
        $typefacturation = $facture->typePaiement();
        if ($managerFactureEspece->existsfacturation_id($facture->id())) {
            $factureEspece = $managerFactureEspece->getFacture($facture->id());
            $montantfactureEspece = $factureEspece->montant();
        }
        if ($managerFactureElectronique->existsfacturation_id($facture->id())) {
            $factureElectronique = $managerFactureElectronique->getFacture($facture->id());
            $montantfactureElectronique = $factureElectronique->montant();
        }
        if ($managerFactureTicket->existsfacturation_id($facture->id())) {
            $factureTicket = $managerFactureTicket->getFacture($facture->id());
            $montantfactureTicket = $factureTicket->montant();
        }
    } else {
        $reste=0;
        $typefacturation = "No exist";
        $montantfactureEspece = 0;
        $montantfactureElectronique = 0;
        $montantfactureTicket = 0;
    }


    $listConcerner = [];
    if ($managerCo->getList($c->id())) {
        $listConcerner = $managerCo->getList($c->id());
    }
    foreach ($listConcerner as $d => $v) {
        $listConcerner[] = array(
            "id" => $v->id(),
            "vente_id" => $v->vente_id(),
            "en_rayon_id" => $v->en_rayon_id(),
            "produit_id" => $v->produit_id(),
            "produit_name" => "",
            "prixUnit" => $v->prixUnit(),
            "quantite" => $v->quantite(),
            "reduction" => $v->reduction(),
            "supprimer" => $v->supprimer(),
        );
    }
    $dataAll[] = array(
        "DT_RowId" => $c->id(),
        "id" => $c->id(),
        "employe_id" => $c->employe_id(),
        "caisse_id" => $c->caisse_id(),
        "malade_id" => $c->malade_id(),
        "user_id" => $c->user_id(),
        "prescripteur_id" => $c->prescripteur_id(),
        "prixTotal" => $c->prixTotal(),
        "reference" => $c->reference(),
        "prixPercu" => $c->prixPercu(),
        "produitName" => $produitName,
        "dateVente" => $c->dateVente(),
        "commentaire" => $c->commentaire(),
        "reduction" => $c->reduction(),
        "reste"=>$reste,
        "type_paiement" => $typefacturation,
        'montantfactureEspece' => $montantfactureEspece,
        'montantfactureElectronique' => $montantfactureElectronique,
        'montantfactureTicket' => $montantfactureTicket,
        "etat" => $c->etat(),
        "concernerList"=>$listConcerner
    );
}
foreach ($venteActifCaisse as $k => $c) {
    if ($managerFacturation->existsvente_id($c->id())) {
        $facture = $managerFacturation->getVente($c->id());
        $reste = $facture->reste();
        $typefacturation = $facture->typePaiement();
        if ($managerFactureEspece->existsfacturation_id($facture->id())) {
            $factureEspece = $managerFactureEspece->getFacture($facture->id());
            $montantfactureEspece = $factureEspece->montant();
        }
        if ($managerFactureElectronique->existsfacturation_id($facture->id())) {
            $factureElectronique = $managerFactureElectronique->getFacture($facture->id());
            $montantfactureElectronique = $factureElectronique->montant();
        }
        if ($managerFactureTicket->existsfacturation_id($facture->id())) {
            $factureTicket = $managerFactureTicket->getFacture($facture->id());
            $montantfactureTicket = $factureTicket->montant();
        }
    } else {
        $reste=0;
        $typefacturation = "No exist";
        $montantfactureEspece = 0;
        $montantfactureElectronique = 0;
        $montantfactureTicket = 0;
    }
    $listConcerner = [];
    if ($managerCo->getList($c->id())) {
        $listConcerner = $managerCo->getList($c->id());
    }
    foreach ($listConcerner as $d => $v) {
        $listConcerner[] = array(
            "id" => $v->id(),
            "vente_id" => $v->vente_id(),
            "en_rayon_id" => $v->en_rayon_id(),
            "produit_id" => $v->produit_id(),
            "produit_name" => "",
            "prixUnit" => $v->prixUnit(),
            "quantite" => $v->quantite(),
            "reduction" => $v->reduction(),
            "supprimer" => $v->supprimer(),
        );
    }
    $dataActif[] = array(
        "DT_RowId" => $c->id(),
        "id" => $c->id(),
        "employe_id" => $c->employe_id(),
        "caisse_id" => $c->caisse_id(),
        "malade_id" => $c->malade_id(),
        "user_id" => $c->user_id(),
        "prescripteur_id" => $c->prescripteur_id(),
        "prixTotal" => $c->prixTotal(),
        "reference" => $c->reference(),
        "prixPercu" => $c->prixPercu(),
        "produitName" => $produitName,
        "reste"=>$reste,
        "dateVente" => $c->dateVente(),
        "commentaire" => $c->commentaire(),
        "reduction" => $c->reduction(),
        "type_paiement" => $typefacturation,
        'montantfactureEspece' => $montantfactureEspece,
        'montantfactureElectronique' => $montantfactureElectronique,
        'montantfactureTicket' => $montantfactureTicket,
        "etat" => $c->etat(),
        "concernerList"=>$listConcerner
    );
}


$donnees = array('venteActifCaisse' => $dataActif, 'venteAll' => $dataAll);
echo json_encode($donnees);


// D'abord, on se connecte ?ySQL


?>
