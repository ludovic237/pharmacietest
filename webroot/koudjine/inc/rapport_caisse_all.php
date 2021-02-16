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
require_once('../Class/fournisseur.php');

global $pdo;


$managerCaisse = new CaisseManager($pdo);
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
$datas = [];


if (isset($_POST['id']))
    $id = $_POST['id'];


$ventes = $managerVente->getListCaisseComplete($id);



//Recap vente fournisseur
foreach ($ventes as $k => $v){
    $concernce = $managerCo->getList($v->id());
    foreach ($concernce as $a => $b){
        $en_rayon = $managerEn->getList($b->en_rayon_id());
        foreach ($en_rayon as $c => $d){
            $fournisseur = $managerFournisseur->getByStatut($d->fournisseur_id(),"Grossiste");


            $fournisseurDetaillant = $managerFournisseur->getByStatut($d->fournisseur_id(),"Grossiste");
        }
    }
}

//recap vente par type de vente
$ventesComptant = $managerVente->getListCaisseCompleteByEtat($id, "Comptant");
$totalVenteComptant = 0;
foreach ($ventesComptant as $k => $v) :
    $totalVenteComptant = $totalVenteComptant + ($v->prixTotal());
endforeach;

$ventesCredit = $managerVente->getListCaisseCompleteByEtat($id, "Crédit");
$totalVenteCredit = 0;
foreach ($ventesCredit as $k => $v) :
    $totalVenteCredit = $totalVenteCredit + ($v->prixTotal());
endforeach;

$ventesAssurance = $managerVente->getListCaisseCompleteByEtat($id, "Assurance");
$totalVenteAssurance = 0;
foreach ($ventesAssurance as $k => $v) :
    $totalVenteAssurance = $totalVenteAssurance + ($v->prixTotal());
endforeach;

$totalVenteTypeVente = $totalVenteAssurance + $totalVenteComptant + $totalVenteCredit;



//encaissement vente
$facturationEspece = $managerFa->getListCaisseType($id,"Espèce");
$totalfacturationEspece = 0;
foreach ($facturationEspece as $k => $v) :
    $totalfacturationEspece = $totalfacturationEspece + ($v->montantTtc());
endforeach;

$facturationElectronique = $managerFa->getListCaisseType($id,"Electronique");
$totalfacturationElectronique = 0;
foreach ($facturationElectronique as $k => $v) :
    $totalfacturationElectronique = $totalfacturationElectronique + ($v->montantTtc());
endforeach;

$facturationBonCaisse = $managerFa->getListCaisseType($id,"Bon");
$totalfacturationBonCaisse = 0;
foreach ($facturationBonCaisse as $k => $v) :
    $totalfacturationBonCaisse = $totalfacturationBonCaisse + ($v->montantTtc());
endforeach;

$totalEncaissementVente = $totalfacturationBonCaisse + $totalfacturationElectronique + $totalfacturationEspece;


//encaissement vente facture credit


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

//etat de la caisse

$montantFermeture = $managerCaisse->getId($v->id())->fondCaisseFerme();
$montantSystem = (+$totalboncaisseGenerer) - ($totalboncaisseEncaisser + $totalDepense);
$differnce  = $montantFermeture-$montantSystem;


$donnees = array(
    'vente_fg' => 0,
    'vente_fd' => 0,
    'vente_ft' => 0,
    'vente_comptant' => $totalVenteComptant,
    'vente_credit' => $totalVenteCredit,
    'vente_assurance' => $totalVenteAssurance,
    'vente_total' => $totalVenteTypeVente,
    'ev_espece' => $totalfacturationEspece,
    'ev_electronique' => $totalfacturationElectronique,
    'ev_boncaisse' => $totalfacturationBonCaisse,
    'ev_total' => $totalEncaissementVente,
    'efc_espece' => 0,
    'efc_total' => 0,
    'bc_genere' => $dataBoncaisseGenerer,
    'bc_total' => $totalboncaisseGenerer,
    'bc_encaisse' => $dataBoncaisseEncaisser,
    'bc_total_genere' => $totalboncaisseEncaisser,
    'depense' => $dataDepense,
    'total_depense' => $totalDepense,
    'ec_solde_reel' => $montantFermeture,
    'ec_solde_system' => $montantSystem,
    'ec_difference' => $differnce,
);
echo json_encode($donnees);


?>
