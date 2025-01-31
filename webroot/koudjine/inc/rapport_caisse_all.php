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

function getFinalReduction($reductionRayon) {
    $reductionData = floor($reductionRayon / 5) * 5; // Arrondi vers le bas au multiple de 5
    $lastTwoDigits = $reductionData % 100;

    if ($lastTwoDigits >= 75) {
        $lastData = 75;
    } elseif ($lastTwoDigits >= 50) {
        $lastData = 50;
    } elseif ($lastTwoDigits >= 25) {
        $lastData = 25;
    } else {
        $lastData = 0;
    }

    $finalReductionTotal = floor($reductionData / 100) * 100 + $lastData + 25;
    return $finalReductionTotal;
}


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
$totalVenteComptant = 0;
$totalVenteCredit = 0;
$totalVenteAssurance = 0;
$totalVenteEncaissementCredit = 0;

if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    $id = $_GET['id'];
}


$ventes = $managerVente->getListCaisseCompleteLast($id);

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
            $prixTotalProduitDetail = ((int)$b->prixUnit()*(int)$b->quantite() - (($b->prixUnit() * $b->quantite())*$b->reduction()/100)) + $prixTotalProduitDetail;
        }
        else {
            $prixTotalConcerne = ($b->prixUnit() * $b->quantite()) - (($b->prixUnit() * $b->quantite())*$b->reduction()/100);
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
            }else{
                $prixTotalProduitDetail = $prixTotalConcerne + $prixTotalProduitDetail;
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
                $singleReduction = (($concerner->prixUnit() * $concerner->quantite())*$concerner->reduction()/100);
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

if($caisse->dateFerme() != null || $caisse->dateFerme() != ''){
    $ventesCredit = $managerVente->getListCaisseCompleteCreditdateF($caisse->dateOuvert(),$caisse->dateFerme());
}else{
    $ventesCredit = $managerVente->getListCaisseCompleteCreditdateNow($caisse->dateOuvert());
}

foreach ($ventesCredit as $k => $v) :
    $reduction= $v->reduction();
    $concernce = $managerCo->getList($v->id());
    foreach ($concernce as $a => $b) {
        if ($b->type()=="detail"){
            $prixTotalProduitDetail = ((int)$b->prixUnit()*(int)$b->quantite() - (($b->prixUnit() * $b->quantite())*$b->reduction()/100)) + $prixTotalProduitDetail;
        }
        else {
            $prixTotalConcerne = ($b->prixUnit() * $b->quantite()) - (($b->prixUnit() * $b->quantite())*$b->reduction()/100);
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
            }else{
                $prixTotalProduitDetail = $prixTotalConcerne + $prixTotalProduitDetail;
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
                $singleReduction = (($concerner->prixUnit() * $concerner->quantite())*$concerner->reduction()/100);
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

    //if ($v->prixPercu()>0){
    //$totalVenteCredit = $totalVenteCredit + ($v->prixTotal());
    //}
endforeach;


//recap vente par type de vente
// vente Comptant

$ventesComptant = $managerVente->getListCaisseCompleteComptant($id);
foreach ($ventesComptant as $k => $v) :
    //if ($v->prixPercu()>0){
        $totalVenteComptant = $totalVenteComptant + ($v->prixTotal());
    //}
endforeach;
if($caisse->dateFerme() != null || $caisse->dateFerme() != ''){
    $ventesCredit = $managerVente->getListCaisseCompleteCreditdateF($caisse->dateOuvert(),$caisse->dateFerme());
}else{
    $ventesCredit = $managerVente->getListCaisseCompleteCreditdateNow($caisse->dateOuvert());
}

foreach ($ventesCredit as $k => $v) :
    //if ($v->prixPercu()>0){
    $totalVenteCredit = $totalVenteCredit + ($v->prixTotal());
    //}
endforeach;

$ventesAssurance = $managerVente->getListCaisseCompleteAssurance($id);
foreach ($ventesAssurance as $k => $v) :
    //if ($v->prixPercu()>0){
    $totalVenteAssurance = $totalVenteAssurance + ($v->prixTotal());
    //}
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

$ventesEncaissementCredit = $managerVente->getListCaisseCompleteEncaissementCredit($id);
foreach ($ventesEncaissementCredit as $k => $v) :
    //if ($v->prixPercu()>0){
    $totalVenteEncaissementCredit = $totalVenteEncaissementCredit + ($v->prixTotal());
    //}
    if ($v->user_id() != NULL) {
//        if (!$managerEm->get($v->user_id())){
//            $user = $managerUs->get($managerEm->get($v->user_id())->user_id());
//            $client = $user->nom() . ' ' . $user->prenom();
//        }
//        else{
            $user = $managerUs->get($v->user_id());
            $client = $user->nom() . ' ' . $user->prenom();
//        }

    } else {
        $client = 'Client pas enregistré';
    }
    $dataVenteACredit[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->id(),
        "reference" => $v->reference(),
        "prixPercu" => $v->prixTotal(),
        "prixTotal" => $v->prixTotal(),
        "client" => $client,
        'dateVente' => $v->dateVente()
    );
endforeach;

$totalVenteCreditFacture = $totalVenteEncaissementCredit;

/*foreach ($ventesCreditFacture as $k => $v) :
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
endforeach;*/

//encaissement facture credit
$ventesCreditFacture1 = $managerVente->getListCaisseCompleteByEtat_3($id, "Crédit");
$totalVenteCreditFacture1 = 0;
//echo '$ventesCreditFacture1';
//print_r($ventesCreditFacture1);
//echo '$ventesCreditFacture2';
//echo json_encode([]);
//echo '$ventesCreditFacture3';
//echo json_encode($ventesCreditFacture1);
/*foreach ($ventesCreditFacture1 as $k => $v) :
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
endforeach;*/

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
        $concerner = $managerCo->get((int)$c->concerner_id());
        $en_rayon_produitId = $managerEn->get($concerner_produitId)->produit_id();
        $produit_nom = $managerPr->get($en_rayon_produitId)->nom();
        $List_produitRetour = $List_produitRetour . " " . $produit_nom . " " . $c->quantite() . "";
        if($concerner->reduction() != 0){
            $reductionRayon = (($concerner->prixUnit())*$concerner->reduction()/100);
            $reductionRayon = getFinalReduction($reductionRayon);
            $prixTotal = $prixTotal + (($c->quantite()*$concerner->prixUnit()) - ($c->quantite()*$reductionRayon));
        }else{
            $prixTotal = $prixTotal + (($c->quantite()*$concerner->prixUnit()));
        }

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

$solde_reel_espece=0;
$solde_systeme_espece=$totalfacturationEspece+$totalboncaisseGenerer-($totalDepense+$prixTotalProduitDetail+($totalboncaisseEncaisser-$totalfacturationTicket));
$solde_diff_espece=0;
$solde_reel_electronique=0;
$solde_systeme_electronique=$totalfacturationElectronique;
$solde_diff_electronique=0;
$solde_reel_ticket=0;
$solde_systeme_ticket=$totalboncaisseEncaisser;
$solde_diff_ticket=0;
$solde_reel_total=$solde_reel_espece+$solde_reel_electronique+$solde_reel_ticket;
$solde_systeme_total=$solde_systeme_espece+$solde_systeme_electronique+$solde_systeme_ticket;
$solde_diff_total=$solde_diff_espece+$solde_diff_electronique+$solde_diff_ticket;

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
    'efc_espece' => $dataVenteACredit,
    'efc_total' => $totalVenteCreditFacture,
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
    'solde_systeme_espece' => $solde_systeme_espece,
    'solde_systeme_electronique' => $solde_systeme_electronique,
    'solde_systeme_ticket' => $solde_systeme_ticket,
    'solde_reel_espece' => $solde_reel_espece,
    'solde_reel_electronique' => $solde_reel_electronique,
    'solde_reel_ticket' => $solde_reel_ticket,
    'solde_diff_espece' => $solde_diff_espece,
    'solde_diff_electronique' => $solde_diff_electronique,
    'solde_diff_ticket' => $solde_diff_ticket,
    'solde_reel_total' => $solde_reel_total,
    'solde_systeme_total' => $solde_systeme_total,
    'solde_diff_total' => $solde_diff_total,

);
echo json_encode($donnees);
