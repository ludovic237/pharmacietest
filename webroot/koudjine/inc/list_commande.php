<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');
require_once('../Class/facturation.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/produit_detail.php');

global $pdo;

$data = [];
$datas = [];
$totalEncaisse = 0;
$total = 0;

$manager = new VenteManager($pdo);
$managerCa = new CaisseManager($pdo);
$managerFa = new FacturationManager($pdo);
$managerPrDetail = new Produit_detailManager($pdo);

$managerEn = new EmployeManager($pdo);
$managerUser = new UserManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerEnr = new En_rayonManager($pdo);


$start = $_POST['start'];
$end = $_POST['end'];

if($start == ''){
    $VenteCaisse = $manager->getDateVenteRangeBegin($end);
}elseif ($end == ''){
    $VenteCaisse = $manager->getDateVenteRangeEnd($start);
}else{
    $VenteCaisse = $manager->getDateVenteRange($start, $end);
}

$prds = array();
$qte = 0;
foreach ($VenteCaisse as $key => $v) {
    $employeName = $managerUser->get(($managerEn->get($v->employe_id()))->user_id());
    $produits = $managerCo->getList($v->id());
    $nameProduit = "";
    foreach ($produits as $k => $c) :
        //echo $v->en_rayon_id();
        $qte = $qte + $c->quantite();

        if ($c->type() == "detail"){
            $nom = $managerPrDetail->get($c->en_rayon_id())->nom();
        }
        else {
            $nom = $managerPr->get($managerEnr->get($c->en_rayon_id())->produit_id())->nom();
        }
        $prd = $managerPr->get($managerEnr->get($c->en_rayon_id())->produit_id())->id();
        if (array_key_exists($nom,$prds))
        {
            $prds[$nom] = $prds[$nom] + $c->quantite();
        }
        else
        {
            $prds[$nom] = $c->quantite();
        }
        $nameProduit = $nom.'['.$prds[$nom].']'. "," . $nameProduit;
    endforeach;

    if ($managerFa->existsvente_id($v->id())) {
        $fact = $managerFa->getVente($v->id());
        $typePaiement = $fact->typePaiement();
    } else {
        $typePaiement = 'Inachevée';
    }

    $data[] = array(
        "id" => $v->id(),
        "reference" => $v->reference(),
        "nameProduit" => $nameProduit,
        "prixTotal" => $v->prixTotal(),
        "prixPercu" => $v->prixPercu(),
        "nom" => $employeName->nom(),
        "prenom" => $employeName->prenom(),
        "dateVente" => $v->dateVente(),
        "etat" => $v->etat(),
        "typePaiement" => $typePaiement
    );

}
//echo  " Voici la qte".$qte."\n";
//print_r($prds);
$datas = array('data' => $data, 'totalEncaisse' => $total);
echo json_encode($datas);