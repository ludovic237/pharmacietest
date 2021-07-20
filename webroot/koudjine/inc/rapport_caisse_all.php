<?php
require_once('database.php');
require_once('../Class/facturation.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/bon_caisse.php');
require_once('../Class/vente.php');
require_once('../Class/en_rayon.php');
require_once('../Class/depense.php');
require_once('../Class/concerner.php');
require_once('../Class/user.php');
require_once('../Class/produit.php');
require_once('../Class/fournisseur1.php');

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
$managerEn = new En_rayonManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerBonCaisse = new BonCaisseManager($pdo);
$managerFournisseur = new FournisseurManager($pdo);


$data = [];
$dataDepense = [];
$dataBonCaisse = [];
$dataBonGeneré = [];
$dataBoncaisseGenerer = [];
$dataBoncaisseEncaisser = [];
$dataProduitRetour = [];
$datas = [];
$dataVenteACredit = [];
$grandTotalCaisse = 0;

if (isset($_POST['id']))
    $id = $_POST['id'];


$ventes = $managerVente->getListCaisseComplete($id);

$prixGrossite = 0;
$prixDetaillant = 0;
$prixTotalConcerne = 0;
$prixTotalProduitDetail = 0;
//Recap vente fournisseur
foreach ($ventes as $k => $v) {
    $concernce = $managerCo->getList($v->id());
    foreach ($concernce as $a => $b) {

        $prixTotalConcerne = ($b->prixUnit()) * ($b->quantite()) - $b->reduction();
        $en_rayon = $managerEn->get($b->en_rayon_id());
        $fournisseur = $managerFournisseur->get($en_rayon->fournisseur_id());

        if ($fournisseur->statut() == "Grossiste") {
            $prixGrossite = $prixTotalConcerne + $prixGrossite;
        } else if ($fournisseur->statut() == "Detaillant") {
            $prixDetaillant = $prixTotalConcerne + $prixDetaillant;
        }
        // On calcule le total des produits detailles
        $produit = $managerPr->get($en_rayon->produit_id());
        if ($produit->grossiste_id() != ''){
            $prixTotalProduitDetail = $prixTotalConcerne + $prixTotalProduitDetail;
            //echo 'passe';
        }
    }
}

$caisse = $managerCa->getId($id);
//recap vente par type de vente
if($caisse->etat() != 'Ouvert')
$ventesComptant = $managerVente->getListCaisseCompleteByEtat($id, "Comptant");
else
    $ventesComptant = $managerVente->getListCaisseCompleteByEtatOuvert($id, "Comptant");
$totalVenteComptant = 0;
foreach ($ventesComptant as $k => $v) :
    $totalVenteComptant = $totalVenteComptant + ($v->prixPercu());
endforeach;

if($caisse->etat() != 'Ouvert')
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

if($caisse->etat() != 'Ouvert')
$ventesAssurance = $managerVente->getListCaisseCompleteByEtat($id, "Assurance");
else
    $ventesAssurance = $managerVente->getListCaisseCompleteByEtat($id, "Assurance");
$totalVenteAssurance = 0;
foreach ($ventesAssurance as $k => $v) :
    $totalVenteAssurance = $totalVenteAssurance + ($v->prixTotal());
endforeach;

$totalVenteTypeVente = $totalVenteAssurance + $totalVenteComptant + $totalVenteCredit;



//encaissement vente
$facturationEspece = $managerFa->getListCaisseType($id, "Espèce");
$totalfacturationEspece = 0;
foreach ($facturationEspece as $k => $v) :
    $totalfacturationEspece = $totalfacturationEspece + ($v->montantTtc());
endforeach;

$facturationElectronique = $managerFa->getListCaisseType($id, "Electronique");
$totalfacturationElectronique = 0;
foreach ($facturationElectronique as $k => $v) :
    $totalfacturationElectronique = $totalfacturationElectronique + ($v->montantTtc());
endforeach;

$facturationBonCaisse = $managerFa->getListCaisseType($id, "Bon");
$totalfacturationBonCaisse = 0;
foreach ($facturationBonCaisse as $k => $v) :
    $totalfacturationBonCaisse = $totalfacturationBonCaisse + ($v->montantTtc());
endforeach;

$totalEncaissementVente = $totalfacturationBonCaisse + $totalfacturationElectronique + $totalfacturationEspece;


//encaissement vente credit

if($caisse->etat() != 'Ouvert')
    $ventesCreditFacture = $managerVente->getListCaisseCompleteByEtat($id, "Crédit");
else
    $ventesCreditFacture = $managerVente->getListCaisseCompleteByEtatOuvert($id, "Crédit");
$totalVenteCreditFacture = 0;
foreach ($ventesCreditFacture as $k => $v) :
    //print_r($v);

    if ($v->user_id() != NULL) {
        $user = $managerUs->get($managerEm->get($v->user_id())->user_id()) ;
        $client = $user->nom() . ' ' . $user->prenom();
    } else {
        $client = 'Client pas enregistré';
    }
    $concernce = $managerCo->getList($v->id());
    foreach ($concernce as $a => $b) {

        $prixTotalConcerne = ($b->prixUnit()) * ($b->quantite()) - $b->reduction();
        $en_rayon = $managerEn->get($b->en_rayon_id());
        $fournisseur = $managerFournisseur->get($en_rayon->fournisseur_id());

        if ($fournisseur->statut() == "Grossiste") {
            $prixGrossite = $prixTotalConcerne + $prixGrossite;
        } else if ($fournisseur->statut() == "Detaillant") {
            $prixDetaillant = $prixTotalConcerne + $prixDetaillant;
        }
        // On calcule le total des produits detailles
        $produit = $managerPr->get($en_rayon->produit_id());
        if ($produit->grossiste_id() != ''){
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
    $totalVenteCreditFacture= $v->prixTotal() + $totalVenteCreditFacture;
endforeach;

//encaissement facture credit
$ventesCreditFacture1 = $managerVente->getListCaisseCompleteByEtat_2($id, "Crédit");
$totalVenteCreditFacture1 = 0;
foreach ($ventesCreditFacture1 as $k => $v) :

    if ($v->user_id() != NULL) {
        $user1 = $managerUs->get($managerEm->get($v->user_id())->user_id()) ;
        $client1 = $user->nom() . ' ' . $user->prenom();
    } else {
        $client1 = 'Client pas enregistré';
    }
    $concernce = $managerCo->getList($v->id());
    foreach ($concernce as $a => $b) {

        $prixTotalConcerne = ($b->prixUnit()) * ($b->quantite()) - $b->reduction();
        $en_rayon = $managerEn->get($b->en_rayon_id());
        $fournisseur = $managerFournisseur->get($en_rayon->fournisseur_id());

        if ($fournisseur->statut() == "Grossiste") {
            $prixGrossite = $prixTotalConcerne - $prixGrossite;
        } else if ($fournisseur->statut() == "Detaillant") {
            $prixDetaillant = $prixTotalConcerne - $prixDetaillant;
        }
        // On calcule le total des produits detailles
        $produit = $managerPr->get($en_rayon->produit_id());
        if ($produit->grossiste_id() != ''){
            $prixTotalProduitDetail = $prixTotalConcerne + $prixTotalProduitDetail;
            //echo 'passe';
        }
    }
    $dataVenteACredit1[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->id(),
        "reference" => $v->reference(),
        "prixPercu" => $v->prixPercu(),
        "client" => $client1,
        'dateVente' => $v->dateVente()
    );
    $totalVenteCreditFacture1= $v->prixPercu() + $totalVenteCreditFacture1;
endforeach;

if(!isset($dataVenteACredit1)) $dataVenteACredit1 = 0;

$totalVentFournisseur = $prixGrossite + $prixDetaillant;


// bon caisse genere
$totalboncaisseGenerer = 0;
$boncaisseGenerer = $managerBonCaisse->getListBonGenerer($id);
foreach ($boncaisseGenerer as $k => $v) :
    $totalboncaisseGenerer = $totalboncaisseGenerer + ($v->montant());
    $dataBoncaisseGenerer[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->id(),
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
        "id" => $v->id(),
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
$prixTotalRetourProduit=0;
foreach ($retourproduit as $k => $v) :

    $caisse_userid = $managerCa->getId($v->caisse_id())->user_id();
    $employe_userid = $managerEm->get($caisse_userid)->user_id();
    $user_nom = $managerUs->get($employe_userid)->nom();
    $user_prenom = $managerUs->get($employe_userid)->prenom();

    $produitretour = $managerPrRetour->getListRetourProduitId($v->id());
    $quantite_produitRetour=0;
    $quantite_total_produitRetour=0;
    $prixTotal=0;
    $List_produitRetour="";
    foreach ($produitretour as $k => $c){
        $quantite_produitRetour = $quantite_produitRetour + $c->quantite();
        $concerner_produitId = $managerCo->get($c->concerner_id())->en_rayon_id();
        $en_rayon_produitId = $managerEn->get($concerner_produitId)->produit_id();
        $produit_nom = $managerPr->get($en_rayon_produitId)->nom();
        $List_produitRetour = $List_produitRetour . " " . $produit_nom . " " . $c->quantite()." - ";
        $prixTotal = $prixTotal + ($c->quantite()*$managerEn->get($concerner_produitId)->prixVente());
    }
    $quantite_total_produitRetour = $quantite_produitRetour;
    $prixTotalRetourProduit = $prixTotal + $prixTotalRetourProduit;
    $dataProduitRetour[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->id(),
        "vente_id" => $v->vente_id(),
        "employe_id" => $user_nom . ' ' . $user_prenom,
        "dateRetour" => $v->dateRetour(),
        "caisse_id" => $v->caisse_id(),
        "quantite_total_produitRetour" => $quantite_total_produitRetour,
        "list" => $List_produitRetour,
        "prix" => $prixTotal,
    );
endforeach;

//etat de la caisse

$montantFermeture = $managerCa->getId($id)->fondCaisseFerme();
$montantSystem = ($totalfacturationEspece + $totalboncaisseGenerer) - ($totalboncaisseEncaisser + $totalDepense + $prixTotalRetourProduit);
$differnce  = $montantFermeture - $montantSystem;


$donnees = array(
    'vente_fg' => $prixGrossite,
    'vente_fd' => $prixDetaillant,
    'vente_fpd' => $prixTotalProduitDetail,
    'vente_ft' => $totalVentFournisseur,
    'vente_comptant' => $totalVenteComptant,
    'vente_credit' => $totalVenteCredit,
    'vente_assurance' => $totalVenteAssurance,
    'vente_total' => $totalVenteTypeVente,
    'ev_espece' => $totalfacturationEspece,
    'ev_electronique' => $totalfacturationElectronique,
    'ev_boncaisse' => $totalfacturationBonCaisse,
    'ev_total' => $totalEncaissementVente,
    'efc_espece' => $dataVenteACredit1,
    'efc_total' => $totalVenteCredit1,
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
    'tf_retourtotal' => $prixTotalRetourProduit

);
echo json_encode($donnees);
