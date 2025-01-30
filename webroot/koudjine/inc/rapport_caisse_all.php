<?php
require_once('database.php');
require_once('../Class/facturation.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/bon_caisse.php');
require_once('../Class/vente.php');
require_once('../Class/viewrapportvente.php');
require_once('../Class/en_rayon.php');
require_once('../Class/depense.php');
require_once('../Class/concerner.php');
require_once('../Class/user.php');
require_once('../Class/produit.php');
require_once('../Class/fournisseur1.php');
require_once('../Class/facture_espece.php');
require_once('../Class/facture_electronique.php');
require_once('../Class/facture_ticket.php');

require_once('../Class/retour_produit.php');
require_once('../Class/produit_retour.php');

global $pdo;


$managerRetourProduit = new RetourProduitManager($pdo);
$managerPrRetour = new ProduitRetourManager($pdo);
$managerCa = new CaisseManager($pdo);
$managerFa = new FacturationManager($pdo);
$managerEm = new EmployeManager($pdo);
$managerUs = new UserManager($pdo);
$managerDepense = new DepenseManager($pdo);
$managerVente = new VenteManager($pdo);
$managerVenteView = new VenteviewViewManager($pdo);
$managerEn = new En_rayonManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerBonCaisse = new BonCaisseManager($pdo);
$managerFournisseur = new FournisseurManager($pdo);
$managerFes = new FactureEspeceManager($pdo);
$managerFel = new FactureElectroniqueManager($pdo);
$managerFtk = new FactureTicketManager($pdo);


$data = [];
$dataDepense = [];
$dataBonCaisse = [];
$dataBonGeneré = [];
$dataBoncaisseGenerer = [];
$dataBoncaisseEncaisser = [];
$dataProduitRetour = [];
$datas = [];
$dataVenteACredit = [];
$dataVenteACredit1 = [];
$grandTotalCaisse = 0;

$dataListReduction = [];
$totalReduction = 0;

if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    $id = $_GET['id'];
}


$ventes = $managerVente->getListCaisseComplete($id);

$prixGrossite = 0;
$prixDetaillant = 0;
$prixTotalConcerne = 0;
$prixTotalProduitDetail = 0;

//echo json_encode($ventes);
//Recap vente fournisseur
foreach ($ventes as $key => $v) {
    $reduction= $v->reduction();
    $concernce = $managerCo->getList($v->id());
    foreach ($concernce as $a => $b) {
        if ($b->type()=="detail"){
            $prixTotalProduitDetail = ((int)$b->prixUnit()*(int)$b->quantite()) + $prixTotalProduitDetail;
        }
        else {
            $prixTotalConcerne = ($b->prixUnit() * $b->quantite()) - $b->reduction();
            $en_rayon = $managerEn->get($b->en_rayon_id());
            if (!$en_rayon->fournisseur_id() || $en_rayon->fournisseur_id()==false) {
//            echo "Erreur : Aucun produit trouvé pour l'ID en rayon " . $b->en_rayon_id() . "<br>";
                continue; // Passe à l'itération suivante pour éviter les erreurs
            }
            $fournisseur = $managerFournisseur->get($en_rayon->fournisseur_id());

            if ($fournisseur->statut() == "Grossiste") {
                $prixGrossite = $prixTotalConcerne + $prixGrossite;
            } else if ($fournisseur->statut() == "Detaillant") {
                $prixDetaillant = $prixTotalConcerne + $prixDetaillant;
            }

            // On calcule le total des produits detailles
            $produit = $managerPr->get($en_rayon->produit_id());
        }
    }
    if ($reduction>0){
        if ($managerRetourProduit->existsVente_id($v->id())==true){
            $retourProduit = $managerRetourProduit->getVente_id($v->id());
            $produitRetourList = $managerPrRetour->getListRetourProduitId($retourProduit->id());
            foreach ($produitRetourList as $c => $d) {
                $concerner = $managerCo->get($d->concerner_id());
                $singleReduction = $concerner->reduction()/$concerner->quantite();
                if ($singleReduction>0){
                    $reduction = $reduction - $singleReduction*$d->quantite();
                }
            }

        }

        $dataListReduction[] = array(
            "DT_RowId" => $v->id(),
            "id" => $v->id(),
            "reference" => $v->reference(),
            "prixPercu" => $v->prixTotal(),
            "reduction" => $reduction,
            'dateVente' => $v->dateVente()
        );
        $totalReduction = $totalReduction + $reduction;
    }

}

$caisse = $managerCa->getId($id);
//recap vente par type de vente
if ($caisse->etat() != 'Ouvert')
    $ventesComptant = $managerVente->getListCaisseCompleteByEtat($id, "Comptant");
else
    $ventesComptant = $managerVente->getListCaisseCompleteByEtatOuvert($id, "Comptant");
$totalVenteComptant = 0;
foreach ($ventesComptant as $k => $v) :
    if ($v->prixPercu()>0){
        $totalVenteComptant = $totalVenteComptant + ($v->prixTotal());
    }
endforeach;

if ($caisse->etat() != 'Ouvert')
    $ventesCredit = $managerVente->getListCaisseCompleteByEtat($id, "Crédit");
else
    $ventesCredit = $managerVente->getListCaisseCompleteByEtatOuvert($id, "Crédit");
$totalVenteCredit = 0;
foreach ($ventesCredit as $k => $v) :
    $totalVenteCredit = $totalVenteCredit + ($v->prixTotal());
endforeach;

$ventesCreditFact = $managerVente->getListCaisseCompleteByEtat_2($id, "Crédit");

$totalVenteCredit1 = 0;
foreach ($ventesCreditFact as $k => $v) :
    $totalVenteCredit1 = $totalVenteCredit1 + ($v->prixTotal());
endforeach;

if ($caisse->etat() != 'Ouvert')
    $ventesAssurance = $managerVente->getListCaisseCompleteByEtat($id, "Assurance");
else
    $ventesAssurance = $managerVente->getListCaisseCompleteByEtat($id, "Assurance");
$totalVenteAssurance = 0;
foreach ($ventesAssurance as $k => $v) :
    $totalVenteAssurance = $totalVenteAssurance + ($v->prixTotal());
endforeach;

$totalVenteTypeVente = $totalVenteAssurance + $totalVenteComptant + $totalVenteCredit;


//encaissement vente
$facturation = $managerFa->getListByCaisse($id);

$totalfacturationEspece = 0;
$totalfacturationElectronique = 0;
$totalfacturationTicket = 0;
foreach ($facturation as $k => $v) :
    if ($managerFes->existsfacturation_id($v->id())) {
        $facturaEspece = $managerFes->getFacture(($v->id()));
//        echo '- '.($managerFes->existsfacturation_id($v->id()));
//        echo json_encode($facturaEspece);
        foreach ($facturaEspece as $a => $b) :
//            echo json_encode($facturaEspece);
            $totalfacturationEspece = $totalfacturationEspece + ($b->montant());
        endforeach;
//        echo ''.$totalfacturationEspece;
    }

    if ($managerFel->existsfacturation_id($v->id())) {
        $facturaElectronique = $managerFel->getFacture($v->id());
        foreach ($facturaElectronique as $a => $b):
            $totalfacturationElectronique = $totalfacturationElectronique + ($b->montant());
        endforeach;
    }

    if ($managerFtk->existsfacturation_id($v->id())) {
        $facturaTicket = $managerFtk->getFacture($v->id());
        foreach ($facturaTicket as $a => $b)  :
            $totalfacturationTicket = $totalfacturationTicket + ($b->montant());
        endforeach;
    }

endforeach;


$totalEncaissementVente = $totalfacturationTicket + $totalfacturationElectronique + $totalfacturationEspece;


//encaissement vente credit

if ($caisse->etat() != 'Ouvert')
    $ventesCreditFacture = $managerVente->getListCaisseCompleteByEtat($id, "Crédit");
else
    $ventesCreditFacture = $managerVente->getListCaisseCompleteByEtatOuvert($id, "Crédit");
$totalVenteCreditFacture = 0;
foreach ($ventesCreditFacture as $k => $v) :
    //print_r($v);

    if ($v->user_id() != NULL) {
        $user = $managerUs->get($managerEm->get($v->user_id())->user_id());
        $client = $user->nom() . ' ' . $user->prenom();
    } else {
        $client = 'Client pas enregistré';
    }
    $concernce = $managerCo->getList($v->id());
    foreach ($concernce as $a => $b) {

        $prixTotalConcerne = ($b->prixUnit()) * ($b->quantite()) - $b->reduction();
        $en_rayon = $managerEn->get($b->en_rayon_id());
        $fournisseur = $managerFournisseur->get($en_rayon->fournisseur_id());

//        if ($fournisseur->statut() == "Grossiste") {
////            $prixGrossite = $prixTotalConcerne + $prixGrossite;
////        } else if ($fournisseur->statut() == "Detaillant") {
////            $prixDetaillant = $prixTotalConcerne + $prixDetaillant;
////        }
        // On calcule le total des produits detailles
        $produit = $managerPr->get($en_rayon->produit_id());
        if ($produit->grossiste_id() != '') {
            $prixTotalProduitDetail = $prixTotalConcerne + $prixTotalProduitDetail;
            //echo 'passe';
        }
    }

    $dataVenteACredit[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->id(),
        "reference" => $v->reference(),
        "prixPercu" => $v->prixTotal(),
        "client" => $client,
        'dateVente' => $v->dateVente()
    );
    $totalVenteCreditFacture = $v->prixTotal() + $totalVenteCreditFacture;
endforeach;

//encaissement facture credit
$ventesCreditFacture1 = $managerVente->getListCaisseCompleteByEtat_3($id, "Crédit");
$totalVenteCreditFacture1 = 0;
//echo '$ventesCreditFacture1';
//print_r($ventesCreditFacture1);
//echo '$ventesCreditFacture2';
//echo json_encode([]);
//echo '$ventesCreditFacture3';
//echo json_encode($ventesCreditFacture1);
foreach ($ventesCreditFacture1 as $k => $v) :
    if ($v['nom'] != NULL || $v['prenom'] != NULL) {
        $client1 = $v['nom'] . ' ' . $v['prenom'];
    } else {
        $client1 = 'Client pas enregistré';
    }
    $concernce = $managerCo->getList($v['id']);
    foreach ($concernce as $a => $b) {
        if ($b->type()=="detail"){
            $prixTotalProduitDetail = ((int)$b->prixUnit()*(int)$b->quantite()) + $prixTotalProduitDetail;
        }
        else {
            $prixTotalConcerne = ($b->prixUnit()) * ($b->quantite()) - $b->reduction();
            $en_rayon = $managerEn->get($b->en_rayon_id());
            $fournisseur = $managerFournisseur->get($en_rayon->fournisseur_id());

//            if ($fournisseur->statut() == "Grossiste") {
//                $prixGrossite = $prixTotalConcerne - $prixGrossite;
//            } else if ($fournisseur->statut() == "Detaillant") {
//                $prixDetaillant = $prixTotalConcerne - $prixDetaillant;
//            }
            // On calcule le total des produits detailles
            $produit = $managerPr->get($en_rayon->produit_id());
            if ($produit->grossiste_id() != '') {
                $prixTotalProduitDetail = $prixTotalConcerne + $prixTotalProduitDetail;
                //echo 'passe';
            }
        }
    }

    $dataVenteACredit1[] = array(
        "DT_RowId" => $v['id'],
        "id" => $v['id'],
        "reference" => $v['reference'],
        "prixPercu" => $v['prixPercu'],
        "prixTotal" => $v['prixTotal'],
        "client" => $client1,
        'dateVente' => $v['dateVente']
    );
    $totalVenteCreditFacture1 = $v['prixTotal'] + $totalVenteCreditFacture1;
endforeach;

//if (!isset($dataVenteACredit1)) $dataVenteACredit1 = 0;

$totalVentFournisseur = $prixGrossite + $prixDetaillant+$prixTotalProduitDetail;

// bon caisse genere
$totalboncaisseGenerer = 0;
$boncaisseGenerer = $managerBonCaisse->getListBonGenerer($id);
foreach ($boncaisseGenerer as $k => $v) :
    $totalboncaisseGenerer = $totalboncaisseGenerer + ($v->montant());
    $dataBoncaisseGenerer[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->codebarre_id(),
        "nom_client" => $v->nom_client(),
        "montant" => $v->montant(),
        "dateGenerer" => $v->dateGenerer(),
        "type" => $v->type(),
    );
endforeach;
//bon caisse encaisse
$totalboncaisseEncaisser = 0;
$boncaisseEncaisser = $managerBonCaisse->getListBonEncaisser($id);
foreach ($boncaisseEncaisser as $k => $v) :
    $totalboncaisseEncaisser = $totalboncaisseEncaisser + ($v->montant());
    $dataBoncaisseEncaisser[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->codebarre_id(),
        "nom_client" => $v->nom_client(),
        "montant" => $v->montant(),
        "dateGenerer" => $v->dateGenerer(),
        "type" => $v->type(),
    );
endforeach;


//depense
$depense = $managerDepense->getList($id);
$totalDepense = 0;
$i = 0;
foreach ($depense as $k => $v) :
    $totalDepense = $totalDepense + ($v->quantite() * $v->prixUnitaire());
    $i++;
    $dataDepense[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->id(),
        "designation" => $v->designation(),
        "quantite" => $v->quantite(),
        "prixUnitaire" => $v->prixUnitaire(),
        "total" => ($v->quantite() * $v->prixUnitaire()),
    );
endforeach;


//retour produit


$retourproduit = $managerRetourProduit->getListCaisseId($id);
$prixTotalRetourProduit = 0;
foreach ($retourproduit as $k => $v) :

    $caisse_userid = $managerCa->getId($v->caisse_id())->user_id();
    $employe_userid = $managerEm->get($caisse_userid)->user_id();
    $user_nom = $managerUs->get($employe_userid)->nom();
    $user_prenom = $managerUs->get($employe_userid)->prenom();

    $produitretour = $managerPrRetour->getListRetourProduitId($v->id());
    $quantite_produitRetour = 0;
    $quantite_total_produitRetour = 0;
    $prixTotal = 0;
    $List_produitRetour = "";
    foreach ($produitretour as $k => $c) {
        $quantite_produitRetour = $quantite_produitRetour + $c->quantite();
        $concerner_produitId = $managerCo->get($c->concerner_id())->en_rayon_id();
        $en_rayon_produitId = $managerEn->get($concerner_produitId)->produit_id();
        $produit_nom = $managerPr->get($en_rayon_produitId)->nom();
        $List_produitRetour = $List_produitRetour . " " . $produit_nom . " " . $c->quantite() . "";
        $prixTotal = $prixTotal + ($c->quantite() * $managerEn->get($concerner_produitId)->prixVente());
        $reference = $managerVente->get($v->vente_id())->reference();
        $dataProduitRetour[] = array(
            "DT_RowId" => $v->id(),
            "id" => $v->id(),
            "vente_id" => $v->vente_id(),
            "reference" => $reference,
            "employe_id" => $user_nom . ' ' . $user_prenom,
            "dateRetour" => $v->dateRetour(),
            "caisse_id" => $v->caisse_id(),
            "quantite_total_produitRetour" => $c->quantite(),
            "produit" => $List_produitRetour,
            "prix" => $prixTotal,
        );
    }
    $quantite_total_produitRetour = $quantite_produitRetour;
    $prixTotalRetourProduit = $prixTotal + $prixTotalRetourProduit;
//    $dataProduitRetour[] = array(
//        "DT_RowId" => $v->id(),
//        "id" => $v->id(),
//        "vente_id" => $v->vente_id(),
//        "employe_id" => $user_nom . ' ' . $user_prenom,
//        "dateRetour" => $v->dateRetour(),
//        "caisse_id" => $v->caisse_id(),
//        "quantite_total_produitRetour" => $quantite_total_produitRetour,
//        "list" => $List_produitRetour,
//        "prix" => $prixTotal,
//    );
endforeach;

//etat de la caisse

$montantFermeture = $managerCa->getId($id)->fondCaisseFerme();
$montantSystem = ($totalfacturationEspece + $totalboncaisseGenerer) - ($totalboncaisseEncaisser + $totalDepense + $prixTotalRetourProduit);
$differnce = $montantFermeture - $montantSystem;


$donnees = array(
    'vente_fg' => $prixGrossite,
    'vente_fd' => $prixDetaillant,
    'vente_fpd' => $prixTotalProduitDetail,
    'vente_ft' => $totalVentFournisseur,
    'vente_comptant' => $totalVenteComptant,
    'vente_credit' => $totalVenteCredit,
    'vente_assurance' => $totalVenteAssurance,
    'vente_total' => $totalVenteTypeVente,
    'reduction_list' => $dataListReduction,
    'reduction_total' => $totalReduction,
    'ev_espece' => $totalfacturationEspece,
    'ev_electronique' => $totalfacturationElectronique,
    'ev_boncaisse' => $totalfacturationTicket,
    'ev_total' => $totalEncaissementVente,
    'efc_espece' => $dataVenteACredit1,
    'efc_total' => $totalVenteCreditFacture1,
    'bc_genere' => $dataBoncaisseGenerer,
    'bc_total' => $totalboncaisseGenerer,
    'bc_encaisse' => $dataBoncaisseEncaisser,
    'bc_total_genere' => $totalboncaisseEncaisser,
    'depense' => $dataDepense,
    'total_depense' => $totalDepense,
    'ec_solde_reel' => $montantFermeture,
    'ec_solde_system' => $montantSystem,
    'ec_difference' => $differnce,
    'tf_retourproduit' => $dataProduitRetour,
    'tf_retourtotal' => $prixTotalRetourProduit,
    'date_ouverture' => $caisse->dateOuvert(),
    'date_fermeture' => $caisse->dateFerme(),
    'etat' => $caisse->etat(),

);
echo json_encode($donnees);
