<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/caisse.php');
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

$id = $_POST['id'];
//echo $id;


if (isset($_POST['id'])) {
    $ventes = $manager->getListCaisseComplete($id);
    $count = 0;

    foreach ($ventes as $k => $v) :
        //echo $v->en_rayon_id();
        if ($count == 10) break;
        $produits = $managerCo->getList($v->id());
        $nom = "";
        foreach ($produits as $p => $q) :
            $produit = $managerPr->get($managerEn->get($q->en_rayon_id())->produit_id())->nom();
            if ($nom == "") {
                $nom = $nom . $produit;
            } else {
                $nom = $nom . "\n" . $produit;
            }
        endforeach;
        if ($managerFacturation->existsvente_id($v->id())) {
            $facture = $managerFacturation->getVente($v->id());
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
        $dataAll[] = array(
            "DT_RowId" => $v->id(),
            "id" => $v->id(),
            "prixTotal" => $v->prixTotal(),
            "prixPercu" => $v->prixPercu(),
            "dateVente" => $v->dateVente(),
            "reste"=>$reste,
            "etat" => $v->etat(),
            "reference" =>  $v->reference(),
            "type_paiement" => $typefacturation,
            'montantfactureEspece' => $montantfactureEspece,
            'montantfactureElectronique' => $montantfactureElectronique,
            'montantfactureTicket' => $montantfactureTicket,
            "nom" => $nom,
        );

        $count++;
    endforeach;
    $donnees = array('vente' => $dataAll);
    echo json_encode($donnees);
}


// D'abord, on se connecte ?ySQL


?>
