<?php
require_once('database.php');
require_once('../Class/retour_produit.php');
require_once('../Class/produit_retour.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');
require_once('../Class/vente.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/concerner.php');
global $pdo;


$managerRetourProduit = new RetourProduitManager($pdo);
$managerProduitRetour = new ProduitRetourManager($pdo);
$managerConcerner = new ConcernerManager($pdo);
$managerCa = new CaisseManager($pdo);
$managerEmploye = new EmployeManager($pdo);
$managerUser = new UserManager($pdo);
$managerVente = new VenteManager($pdo);
$managerEn_rayon = new En_rayonManager($pdo);
$managerProduit = new ProduitManager($pdo);

$data = [];
$datas = [];

// Arrondi vers le haut
function getFinalReduction($reductionRayon) {
    $reductionData = ceil($reductionRayon / 5) * 5;
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

// Arrondi vers le bas
function getFinalReductionBas($reductionRayon) {
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





if (isset($_POST['id']))
    $id = $_POST['id'];

//$retourproduit = $managerRetourProduit->getListCaisseId($id);
$retourproduit = $managerRetourProduit->getList();
foreach ($retourproduit as $k => $v) :

    $caisse_userid = $managerCa->getId($v->caisse_id())->user_id();
    $employe_userid = $managerEmploye->get($caisse_userid)->user_id();
    $user_nom = $managerUser->get($employe_userid)->nom();
    $user_prenom = $managerUser->get($employe_userid)->prenom();

    $produitretour = $managerProduitRetour->getListRetourProduitId($v->id());
    $quantite_produitRetour = 0;
    $quantite_total_produitRetour = 0;
    $prixTotal=0;
    $List_produitRetour = "";
    foreach ($produitretour as $b => $c) {
        $quantite_produitRetour = $quantite_produitRetour + $c->quantite();
        $concerner_produitId = $managerConcerner->get($c->concerner_id())->en_rayon_id();
        $concerner = $managerConcerner->get((int)$c->concerner_id());
        $en_rayon_produitId = $managerEn_rayon->get($concerner_produitId)->produit_id();
        $produit_nom = $managerProduit->get($en_rayon_produitId)->nom();
        $List_produitRetour = $List_produitRetour . " " . $produit_nom . " (" . $c->quantite().") <br> ";
        if($concerner->reduction() != 0){
            $reductionRayon = (($concerner->prixUnit())*$concerner->reduction()/100);
            $reductionRayon = getFinalReduction($reductionRayon);
            $prixTotal = $prixTotal + (($c->quantite()*$concerner->prixUnit()) - ($c->quantite()*$reductionRayon));
        }else{
            $prixTotal = $prixTotal + (($c->quantite()*$concerner->prixUnit()));
        }
    }
    $quantite_total_produitRetour = $quantite_produitRetour;
    $data[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->id(),
        "vente_id" => $managerVente->get($v->vente_id())->reference(),
        "employe_id" => $user_nom . ' ' . $user_prenom,
        "dateRetour" => $v->dateRetour(),
        "caisse_id" => $v->caisse_id(),
        "quantite_total_produitRetour" => $quantite_total_produitRetour,
        "list" => $List_produitRetour,
        "prix" => $prixTotal,
    );
endforeach;

$donnees = array(
    'data' => $data,
);
echo json_encode($donnees);

?>